<?php
namespace Phpanonymous\It\Controllers\Baboon;
use App\Http\Controllers\Controller;

class BaboonUpdate extends Controller {
	//

	public static $copyright = '[It V 1.0 | phpanonymous.com/it]';
	public static function indexMethod($r) {
		$index = '
            /**
             * Baboon Script By '.self::$copyright.'
             * Display a listing of the resource.
             * @return \Illuminate\Http\Response
             */
            public function index({ClassName}DataTable ${ClassName2})
            {
               return ${ClassName2}->render(\'{lang}.{ClassName2}.index\',[\'title\'=>trans(\'{lang}.{ClassName2}\')]);
            }'."\n";
		$folder  = str_replace('controller', '', strtolower($r->input('controller_name')));
		$folder2 = str_replace('Controller', '', $r->input('controller_name'));
		$folder2 = str_replace('controller', '', $folder2);
		$index   = str_replace('{ClassName}', $folder2, $index);
		$index   = str_replace('{ClassName2}', $folder, $index);
		$index   = str_replace('{lang}', $r->input('lang_file'), $index);

		return $index;
	}

	public static function editMethod($r) {
		$edit = '
            /**
             * Baboon Script By '.self::$copyright.'
             * edit the form for creating a new resource.
             * @return \Illuminate\Http\Response
             */
            public function edit($id)
            {
                ${Name} =  {ModelName}::find($id);
';
		$edit .= '                return view(\'{path}.{ClassName}.edit\',[\'title\'=>trans(\'{lang}.edit\'),\'{Name}\'=>${Name}]);
            }'."\n";

		$folder2 = str_replace('controller', '', strtolower($r->input('controller_name')));

		$edit = str_replace('{ClassName}', $folder2, $edit);
		$edit = str_replace('{lang}', $r->input('lang_file'), $edit);
		$edit = str_replace('{path}', str_replace('resources/views/', '', $r->input('admin_folder_path')), $edit);
		$edit = str_replace('{ModelName}', $r->input('model_name'), $edit);
		$edit = str_replace('{lang}', $r->input('lang_file'), $edit);
		$edit = str_replace('{Name}', $folder2, $edit);

		return $edit;
	}

	public static function showMethod($r) {
		$show = '
            /**
             * Display the specified resource.
             * Baboon Script By '.self::$copyright.'
             * @param  int  $id
             * @return \Illuminate\Http\Response
             */
            public function show($id)
            {
                ${Name} =  {ModelName}::find($id);
';
		$show .= '                return view(\'{path}.{ClassName}.show\',[\'title\'=>trans(\'{lang}.show\'),\'{Name}\'=>${Name}]);
            }'."\n";

		$folder2 = str_replace('controller', '', strtolower($r->input('controller_name')));

		$show = str_replace('{ClassName}', $folder2, $show);
		$show = str_replace('{lang}', $r->input('lang_file'), $show);
		$show = str_replace('{path}', str_replace('resources/views/', '', $r->input('admin_folder_path')), $show);
		$show = str_replace('{ModelName}', $r->input('model_name'), $show);
		$show = str_replace('{lang}', $r->input('lang_file'), $show);
		$show = str_replace('{Name}', $folder2, $show);

		return $show;
	}

	public static function updateMethod($r) {
		$objectlist = [];
		$update     = '
            /**
             * Baboon Script By '.self::$copyright.'
             * update a newly created resource in storage.
             * @param  \Illuminate\Http\Request  $r
             * @return \Illuminate\Http\Response
             */
            public function update($id)
            {
                $rules = ['."\n";
		$update .= ''.self::rules($r)."\n";
		$update .= '                         ];
             $data = $this->validate(request(),$rules,[],['."\n";
		$update .= ''.self::SetAttributeNames($r);
		$update .= '                   ]);'."\n";

		if ($r->has('has_user_id')) {
			$update .= '              $data[\'admin_id\'] = admin()->user()->id; '."\n";
		}
		$i = 0;
		foreach ($r->input('col_name_convention') as $conv) {
			$objectlist = [];
			if ($r->input('col_type')[$i] == 'file') {
				$update .= '               if(request()->hasFile(\''.$conv.'\')){'."\n";
				$folder = str_replace('controller', '', strtolower($r->input('controller_name')));
				$update .= '              it()->delete({ModelName}::find($id)->'.$conv.');'."\n";
				$update .= '              $data[\''.$conv.'\'] = it()->upload(\''.$conv.'\',\''.$folder.'\');'."\n";
				$update .= '               }'."\n";
			}
			$i++;
		}

		$update .= '              {ModelName}::where(\'id\',$id)->update($data);'."\n";
		$update .= '
              session()->flash(\'success\',trans(\'{lang}.updated\'));
              return redirect(aurl(\'{Name}\'));
            }';
		$Name   = str_replace('controller', '', strtolower($r->input('controller_name')));
		$update = str_replace('{ModelName}', $r->input('model_name'), $update);
		$update = str_replace('{lang}', $r->input('lang_file'), $update);
		$update = str_replace('{Name}', $Name, $update);
		return $update;
	}

	public static function SetAttributeNames($r) {
		$SetAttributeNames = '';
		foreach ($r->input('col_name_convention') as $conv) {
			if (preg_match('/(\d+)\+(\d+)|,/i', $conv)) {
				$pre_conv = explode('|', $conv);
				$SetAttributeNames .= '             \''.$pre_conv[0].'\'=>trans(\'{lang}.'.$pre_conv[0].'\'),'."\n";
			} elseif (preg_match('/#/i', $conv)) {
				$pre_conv = explode('#', $conv);
				if (!preg_match('/'.$pre_conv[0].'/', $SetAttributeNames)) {

					$SetAttributeNames .= '             \''.$pre_conv[0].'\'=>trans(\'{lang}.'.$pre_conv[0].'\'),'."\n";
				}
			} else {
				$SetAttributeNames .= '             \''.$conv.'\'=>trans(\'{lang}.'.$conv.'\'),'."\n";
			}
		}
		$SetAttributeNames = str_replace('{lang}', $r->input('lang_file'), $SetAttributeNames);
		return $SetAttributeNames;
	}

	public static function rules($r) {
		$rule = '';
		$i    = 0;
		foreach ($r->input('col_name_convention') as $conv) {
			$valrule = '';

			if ($r->input('col_name_null'.$i) == 'has') {

				$r->has('required'.$i)?$valrule .= 'required|':'';
				$r->has('image'.$i)?$valrule .= "'.it()->image().'|":'';
				$r->has('numeric'.$i)?$valrule .= 'numeric|':'';
				$r->has('email'.$i)?$valrule .= 'email|':'';
				$r->has('url'.$i)?$valrule .= 'url|':'';
				$r->has('nullable'.$i)?$valrule .= 'nullable|':'';
				$r->has('sometimes'.$i)?$valrule .= 'sometimes|':'';
				$r->has('confirmed'.$i)?$valrule .= 'confirmed|':'';

			} else {
				if ($r->has('col_type')[$i] == 'email') {
					$valrule .= 'email|';
				}
			}

			if ($r->has('col_type')[$i] == 'password' and $conv == 'password') {
				$valrule .= 'confirmed|';
			}

			if (preg_match('/(\d+)\+(\d+)|,/i', $conv)) {
				$pre_conv = explode('|', $conv);
				$rule .= '             \''.$pre_conv[0].'\'=>\''.rtrim($valrule, '|').'\','."\n";
			} elseif (preg_match('/#/i', $conv)) {

				$pre_conv = explode('#', $conv);
				if (!preg_match('/'.$pre_conv[0].'/i', $rule)) {
					$rule .= '             \''.$pre_conv[0].'\'=>\''.rtrim($valrule, '|').'\','."\n";
				}

			} else {
				if ($r->has('image'.$i) and $r->has('image'.$i) == 1) {
					$rule .= '             \''.$conv.'\'=>\''.rtrim($valrule, '|"').'\','."\n";
				} else {
					$rule .= '             \''.$conv.'\'=>\''.rtrim($valrule, '|').'\','."\n";
				}
			}

			$i++;
		}
		return $rule;
	}

	public static function destroyMethod($r) {
		$objectlist = [];
		$destroy    = '
            /**
             * Baboon Script By '.self::$copyright.'
             * destroy a newly created resource in storage.
             * @param  \Illuminate\Http\Request  $r
             * @return \Illuminate\Http\Response
             */
            public function destroy($id)
            {
               ${Name} = {ModelName}::find($id);
'."\n";
		$i = 0;
		foreach ($r->input('col_name_convention') as $conv) {

			if (!empty($r->input('col_type')[$i]) and $r->input('col_type')[$i] == 'file') {
				$destroy .= '               it()->delete(${Name}->'.$conv.');'."\n";
				$destroy .= '               it()->delete(\'{Name2}\',$id);'."\n";
			}
			$i++;
		}
		$destroy .= '
               @${Name}->delete();
               session()->flash(\'success\',trans(\'{lang}.deleted\'));
               return back();
            }



 			public function multi_delete(Request $r)
            {
                $data = $r->input(\'selected_data\');
                if(is_array($data)){
                    foreach($data as $id)
                    {
                    	${Name} = {ModelName}::find($id);
'."\n";

		$i = 0;
		foreach ($r->input('col_name_convention') as $conv) {
			if (!empty($r->input('col_type')[$i]) and $r->input('col_type')[$i] == 'file') {
				$destroy .= '                    	it()->delete(${Name}->'.$conv.');'."\n";
				$destroy .= '                    	it()->delete(\'{Name2}\',$id);'."\n";

			}
			$i++;
		}
		$destroy .= '                    	@${Name}->delete();
                    }
                    session()->flash(\'success\', trans(\'{lang}.deleted\'));
                   return back();
                }else {
                    ${Name} = {ModelName}::find($data);
 '."\n";
		$i = 0;
		foreach ($r->input('col_name_convention') as $conv) {
			if (!empty($r->input('col_type')[$i]) and $r->input('col_type')[$i] == 'file') {
				$destroy .= '                    	it()->delete(${Name}->'.$conv.');'."\n";
				$destroy .= '                    	it()->delete(\'{Name2}\',$data);'."\n";

			}
			$i++;
		}
		$destroy .= '
                    @${Name}->delete();
                    session()->flash(\'success\', trans(\'{lang}.deleted\'));
                    return back();
                }
            }

            ';
		$Name    = str_replace('controller', '', strtolower($r->input('controller_name')));
		$destroy = str_replace('{ModelName}', $r->input('model_name'), $destroy);
		$destroy = str_replace('{lang}', $r->input('lang_file'), $destroy);
		$destroy = str_replace('{Name}', $Name, $destroy);
		$destroy = str_replace('{Name2}', strtolower($r->input('model_name')), $destroy);
		return $destroy;
	}

	public static function text($data) {
		return view('baboon.elements.update.text', ['data' => $data]);
	}

	public static function email($data) {
		return view('baboon.elements.update.email', ['data' => $data]);
	}

	public static function url($data) {
		return view('baboon.elements.update.url', ['data' => $data]);
	}

	public static function textarea($data) {
		return view('baboon.elements.update.textarea', ['data' => $data]);
	}

	public static function radio($data) {
		return view('baboon.elements.update.radio', ['data' => $data]);
	}

	public static function checkbox($data) {
		return view('baboon.elements.update.checkbox', ['data' => $data]);
	}

	public static function select($data) {
		return view('baboon.elements.update.select', ['data' => $data]);
	}

	public static function file($data) {
		return view('baboon.elements.update.file', ['data' => $data]);
	}

	public static function password($data) {
		return view('baboon.elements.update.password', ['data' => $data]);
	}

	public static function color($data) {
		return view('baboon.elements.update.color', ['data' => $data]);
	}

	public static function date($data) {
		return view('baboon.elements.update.date', ['data' => $data]);
	}

	public static function time($data) {
		return view('baboon.elements.update.time', ['data' => $data]);
	}
	public static function updatebutton($data) {
		return view('baboon.elements.update.updatebtn', ['data' => $data]);
	}
}
