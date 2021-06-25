<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Model\Department as Dep;
use Illuminate\Http\Request;

class Departments extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */

	public static function load_dep($did = null, $attr = []) {
		$departments = Dep::selectRaw('name_'.app('l').' as text_'.app('l'))
			->selectRaw('id as id')
			->selectRaw('parent as parent')
			->get(['text_'.app('l'), 'parent', 'id']);

		$final = [];
		foreach ($departments as $dep) {
			$dep_list = [];
			if (count($attr) > 0) {
				if (!empty($attr['icon'])) {
					$dep_list['icon'] = $attr['icon'];
				}

				if (!empty($attr['li_attr'])) {
					$dep_list['li_attr'] = $attr['li_attr'];
				}

				if (!empty($attr['a_attr'])) {
					$dep_list['a_attr'] = $attr['a_attr'];
				}

				if (!empty($attr['children']) && count($attr['children']) > 0) {
					$dep_list['children'] = $attr['children'];
				}

			}
			if ($did !== null and $did == $dep->id) {

				$dep_list['state'] = [
					'opened'   => true,
					'selected' => true,
					//	'disabled' => true,
				];
			}
			$dep_list['id']     = $dep->id;
			$dep_list['parent'] = $dep->parent === null?'#':$dep->parent;
			$dep_list['text']   = $dep->{'text_'.app('l')};
			array_push($final, $dep_list);

		}
		return json_encode($final, JSON_UNESCAPED_UNICODE);
	}

	public static function master($dep) {
		$department = Dep::find($dep);
		$deps       = Dep::where('id', $department->parent)->first();
		if ($deps->parent !== null) {
			return self::master($deps->id);
		} else {
			return $deps->id;
		}
	}

	public function index(Request $request) {
		if ($request->has('department') and is_numeric($request->input('department'))) {
			$alldep = Dep::where('parent', '=', $request->input('department'))
			                                            ->orderBy('id', 'desc')->paginate(10);
			if ($request->input('department') > 0) {
				$master = Dep::find($request->input('department'));
				$href   = '<a href="'.aurl('departments?department='.$master->parent).'">'.$master->en_name.'</a>';
			} else {
				$href = '';
			}
		} else {
			$alldep = Dep::where('parent', null)->orderBy('id', 'desc')->paginate(10);
			$href   = '';
		}
		return view('admin.department.index',
			['title'  => trans('admin.departments'),
				'alldep' => $alldep,
				'master' => $href,
			]);
	}

	public static function get_parent($id) {
		$parent_html = '';
		foreach (Dep::where('parent', $id)->get() as $parent) {
			$parent_html .= view('admin.department.getparent_type_view_tow', ['dep' => $parent])->render();
		}
		return $parent_html;
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		$department = Dep::where('parent', null)->pluck('name_'.app('l'), 'id');
		return view('admin.department.create', ['title' => trans('admin.add'), 'department' => $department]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store() {

		$rules    = [];
		$nicename = [];
		foreach (\L::all() as $l) {
			$nicename['name_'.$l] = trans('admin.name_'.$l);
			$rules['name_'.$l]    = 'required';
		}
		$data = $this->validate(request(), $rules, [], $nicename);
		//$data            = request()->except(['_token', 'method']);
		$data['admin_id'] = admin()->user()->id;
		if (request('parent') == null) {
			$data['parent'] = null;
		}
		if (request()->hasFile('icon')) {
			$data['icon'] = it()->upload(request()->file('icon'), 'departments/'.time(), 'icon');
		}

		if (request()->has('color')) {
			$data['color'] = request('color');
		}
		if (request()->has('parent')) {
			$data['parent'] = request('parent');
		}
		Dep::create($data);
		session()->flash('success', trans('admin.added'));
		return back();
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */

	public function show($id) {
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		$dep        = Dep::find($id);
		$department = Dep::where('parent', null)->pluck('name_'.app('l'), 'id');
		return view('admin.department.edit', ['title' => trans('admin.edit'),
				'department'                                => $department,
				'edit'                                      => $dep,
			]);
	}

	public function check_parent(Request $request) {
		if ($request->ajax()) {
			if ($request->has('parent') && $request->input('parent') > 0) {
				$dep = Dep::where('parent', $request->input('parent'))->where(function ($q) {
						if (request()->has('not')) {
							return $q->where('id', '!=', request('not'));
						}
					})->get();
				$data = view('admin.department.sub', ['department' => $dep, 'parent' => $request->input('parent')])->render();
				if (!empty($data)) {
					return response()->json($data);
				} else {
					return response()->json('false');
				}
			}
		}
	}

	public static function get_sub_master($id) {
		$first_dep = Dep::find($id);
		if ($first_dep->parent > 0) {
			$data = '';
			$data .= self::get_sub_master($first_dep->parent);
			$dep = Dep::where('parent', $first_dep->parent)->get();
			$data .= view('admin.department.sub_load', [
					'department' => $dep,
					'parent'     => $id
				])
				->render();
			return $data;
		}
	}

	public function get_master(Request $request) {
		if ($request->ajax()) {
			if ($request->has('id') && $request->input('id') > 0) {
				$data = self::get_sub_master($request->input('id'));
				return response()->json(!empty($data)?$data:'false');
			}
		}
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update($id) {
		$rules    = [];
		$nicename = [];
		foreach (\L::all() as $l) {
			$nicename['name_'.$l] = trans('admin.name_'.$l);
			$rules['name_'.$l]    = 'required';
		}
		$this->validate(request(), $rules, [], $nicename);
		session()->flash('success', trans('admin.updated'));
		$data = request()->except(['_token', '_method', 'parent']);
		if (request()->input('parent') != null) {
			$data['parent'] = request('parent');
		} else {
			$data['parent'] = null;
		}
		$data['admin_id'] = admin()->user()->id;

		if (request()->hasFile('icon')) {
			$dep = Dep::find($id);
			!empty($dep->icon)?Up::del_icon($dep->icon):'';// Delete Icon If Has File
			$data['icon'] = it()->upload(request()->file('icon'), 'departments/'.time(), 'icon');
		}

		if (request()->has('color')) {
			$data['color'] = request('color');
		}

		Dep::where('id', $id)->update($data);
		return back();
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public static function DeleteParent($id) {
		$getparent = Dep::where('parent', '=', $id)->get();
		foreach ($getparent as $parent) {
			$check = Dep::find($parent->id);

			if ($check->parent > 0) {
				self::DeleteParent($check->id);
				@Up::del_icon($check->icon);
				$check->delete();
			} else {
				@Up::del_icon($check->icon);
				$check->delete();
			}

		}
	}

	public function destroy($id) {
		$dep = Dep::find($id);
		Up::del_icon($dep->icon);
		$dep->delete();
		self::DeleteParent($id);
		session()->flash('success', trans('admin.deleted'));
		return back();
	}
}
