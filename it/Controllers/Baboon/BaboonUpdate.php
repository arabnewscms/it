<?php
namespace Phpanonymous\It\Controllers\Baboon;
use App\Http\Controllers\Controller;

class BaboonUpdate extends Controller {
	//

	public static $copyright = '[It V 1.5.0 | https://it.phpanonymous.com]';
	public static function indexMethod($r) {
		$index = '
            /**
             * Baboon Script By ' . self::$copyright . '
             * Display a listing of the resource.
             * @return \Illuminate\Http\Response
             */
            public function index({ClassName}DataTable ${ClassName2})
            {
               return ${ClassName2}->render(\'{lang}.{ClassName2}.index\',[\'title\'=>trans(\'{lang}.{ClassName2}\')]);
            }' . "\n";
		$folder = str_replace('controller', '', strtolower($r->input('controller_name')));
		$folder2 = str_replace('Controller', '', $r->input('controller_name'));
		$folder2 = str_replace('controller', '', $folder2);
		$index = str_replace('{ClassName}', $folder2, $index);
		$index = str_replace('{ClassName2}', $folder, $index);
		$index = str_replace('{lang}', $r->input('lang_file'), $index);

		return $index;
	}

	public static function editMethod($r) {
		$edit = '
            /**
             * Baboon Script By ' . self::$copyright . '
             * edit the form for creating a new resource.
             * @return \Illuminate\Http\Response
             */
            public function edit($id)
            {
        		${Name} =  {ModelName}::find($id);' . "\n";
		$edit .= '        		return is_null(${Name}) || empty(${Name})?
        		backWithError(trans("{lang}.undefinedRecord")) :
        		view(\'{path}.{ClassName}.edit\',[
				  \'title\'=>trans(\'{lang}.edit\'),
				  \'{Name}\'=>${Name}
        		]);
            }' . "\n";

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
             * Baboon Script By ' . self::$copyright . '
             * @param  int  $id
             * @return \Illuminate\Http\Response
             */
            public function show($id)
            {
        		${Name} =  {ModelName}::find($id);' . "\n";
		$show .= '        		return is_null(${Name}) || empty(${Name})?
        		backWithError(trans("{lang}.undefinedRecord")) :
        		view(\'{path}.{ClassName}.show\',[
				    \'title\'=>trans(\'{lang}.show\'),
					\'{Name}\'=>${Name}
        		]);
            }' . "\n";

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
		$update = '
            /**
             * Baboon Script By ' . self::$copyright . '
             * update a newly created resource in storage.
             * @param  \Illuminate\Http\Request  $request
             * @return \Illuminate\Http\Response
             */
            public function update(' . $r->input('controller_name') . 'Request $request,$id)
            {
              // Check Record Exists
              ${Name} =  {ModelName}::find($id);
              if(is_null(${Name}) || empty(${Name})){
              	return backWithError(trans("{lang}.undefinedRecord"));
              }
              $data = $request->except("_token", "_method"); ' . "\n";

		if ($r->has('has_user_id')) {
			$update .= '              $data[\'admin_id\'] = admin()->id(); ' . "\n";
		}

		$i = 0;
		foreach ($r->input('col_name_convention') as $conv) {
			$objectlist = [];
			if ($r->input('col_type')[$i] == 'file') {
				$update .= '               if(request()->hasFile(\'' . $conv . '\')){' . "\n";
				$folder = str_replace('controller', '', strtolower($r->input('controller_name')));
				$update .= '              it()->delete(${Name}->' . $conv . ');' . "\n";
				$update .= '              $data[\'' . $conv . '\'] = it()->upload(\'' . $conv . '\',\'' . $folder . '\');' . "\n";
				$update .= '               }else{' . "\n";
				$update .= '              $data[\'' . $conv . '\'] = "";' . "\n";
				$update .= '               }' . "\n";
			}
			$i++;
		}

		$update .= '              {ModelName}::where(\'id\',$id)->update($data);';
		$update .= '
              return redirectWithSuccess(aurl(\'{Name}\'), trans(\'{lang}.updated\'));
            }';
		$Name = str_replace('controller', '', strtolower($r->input('controller_name')));
		$update = str_replace('{ModelName}', $r->input('model_name'), $update);
		$update = str_replace('{lang}', $r->input('lang_file'), $update);
		$update = str_replace('{Name}', $Name, $update);
		return $update;
	}

	public static function destroyMethod($r) {
		$objectlist = [];
		$destroy = '
            /**
             * Baboon Script By ' . self::$copyright . '
             * destroy a newly created resource in storage.
             * @param  $id
             * @return \Illuminate\Http\Response
             */
            public function destroy($id)
            {
               ${Name} = {ModelName}::find($id);
               if(is_null(${Name}) || empty(${Name})){
                return backWithError(trans(\'{lang}.undefinedRecord\'));
               }
               ';
		$i = 0;
		foreach ($r->input('col_name_convention') as $conv) {

			if (!empty($r->input('col_type')[$i]) and $r->input('col_type')[$i] == 'file') {
				$destroy .= '               if(!empty(${Name}->' . $conv . ')){' . "\n";
				$destroy .= '               it()->delete(${Name}->' . $conv . ');' . "\n";
				$destroy .= '               }' . "\n";
			}
			$i++;
		}
		$destroy .= '               it()->delete(\'{Name2}\',$id);' . "\n";
		$destroy .= '

                ${Name}->delete();
                return backWithSuccess(trans(\'{lang}.deleted\'));

            }


 			public function multi_delete()
            {
                $data = request(\'selected_data\');
                if(is_array($data)){
                    foreach($data as $id)
                    {
                    	${Name} = {ModelName}::find($id);
                    	if(is_null(${Name}) || empty(${Name})){
		                 return backWithError(trans(\'{lang}.undefinedRecord\'));
		                }
                    	';
		$i = 0;
		foreach ($r->input('col_name_convention') as $conv) {
			if (!empty($r->input('col_type')[$i]) and $r->input('col_type')[$i] == 'file') {
				$destroy .= '                    	if(!empty(${Name}->' . $conv . ')){' . "\n";
				$destroy .= '                    	it()->delete(${Name}->' . $conv . ');' . "\n";
				$destroy .= '                    	}' . "\n";
			}
			$i++;
		}
		$destroy .= '                    	it()->delete(\'{Name2}\',$id);' . "\n";
		$destroy .= '

		                ${Name}->delete();

                    }
                    return backWithSuccess(trans(\'{lang}.deleted\'));
                }else {
                    ${Name} = {ModelName}::find($data);
                    if(is_null(${Name}) || empty(${Name})){
	                 return backWithError(trans(\'{lang}.undefinedRecord\'));
	                }
                    ' . "\n";
		$i = 0;
		foreach ($r->input('col_name_convention') as $conv) {
			if (!empty($r->input('col_type')[$i]) and $r->input('col_type')[$i] == 'file') {
				$destroy .= '                    	if(!empty(${Name}->' . $conv . ')){' . "\n";
				$destroy .= '                    	it()->delete(${Name}->' . $conv . ');' . "\n";
				$destroy .= '                    	}' . "\n";

			}
			$i++;
		}
		$destroy .= '                    	it()->delete(\'{Name2}\',$data);' . "\n";
		$destroy .= '
	                ${Name}->delete();
	                return backWithSuccess(trans(\'{lang}.deleted\'));
                }
            }
            ';
		$Name = str_replace('controller', '', strtolower($r->input('controller_name')));
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

	public static function textarea_ckeditor($data) {
		return view('baboon.elements.update.textarea_ckeditor', ['data' => $data]);
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

	public static function fileDownload($data) {
		return view('baboon.elements.update.fileDownload', ['data' => $data]);
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
