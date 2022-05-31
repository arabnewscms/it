<?php
namespace Phpanonymous\It\Controllers\Baboon;
use App\Http\Controllers\Controller;
use Phpanonymous\It\Controllers\Baboon\BaboonRulesAndAttributes as BaboonAttr;

class BaboonUpdate extends Controller {

	public static function indexMethod($r) {
		$index = '
            /**
             * Baboon Script By ' . it_version_message() . '
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
             * Baboon Script By ' . it_version_message() . '
             * edit the form for creating a new resource.
             * @return \Illuminate\Http\Response
             */
            public function edit($id)
            {
        		${Name} =  {ModelName}::find($id);' . "\n";
		$edit .= '        		return is_null(${Name}) || empty(${Name})?
        		backWithError(trans("{lang}.undefinedRecord"),aurl("{Name}")) :
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
             * Baboon Script By ' . it_version_message() . '
             * @param  int  $id
             * @return \Illuminate\Http\Response
             */
            public function show($id)
            {
        		${Name} =  {ModelName}::find($id);' . "\n";
		$show .= '        		return is_null(${Name}) || empty(${Name})?
        		backWithError(trans("{lang}.undefinedRecord"),aurl("{Name}")) :
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
             * Baboon Script By ' . it_version_message() . '
             * update a newly created resource in storage.
             * @param  \Illuminate\Http\Request  $request
             * @return \Illuminate\Http\Response
             */
            public function updateFillableColumns() {
				$fillableCols = [];
				foreach (array_keys((new ' . $r->input('controller_name') . 'Request)->attributes()) as $fillableUpdate) {
					if (!is_null(request($fillableUpdate))) {
						$fillableCols[$fillableUpdate] = request($fillableUpdate);
					}
				}
				return $fillableCols;
			}

            public function update(' . $r->input('controller_name') . 'Request $request,$id)
            {
              // Check Record Exists
              ${Name} =  {ModelName}::find($id);
              if(is_null(${Name}) || empty(${Name})){
              	return backWithError(trans("{lang}.undefinedRecord"),aurl("{Name}"));
              }
              $data = $this->updateFillableColumns(); ' . "\n";

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
				$update .= '               } ' . "\n";

			} elseif ($r->input('col_type')[$i] == 'time') {
				$update .= '              $data[\'' . $conv . '\'] = date(\'H:i\', strtotime(request(\'' . $conv . '\')));' . "\n";
			} elseif ($r->input('col_type')[$i] == 'date_time') {
				$update .= '              $data[\'' . $conv . '\'] = date(\'Y-m-d H:i\', strtotime(request(\'' . $conv . '\')));' . "\n";
			} elseif ($r->input('col_type')[$i] == 'checkbox') {
				$pre_name = explode('#', $conv);
				$update .= '              $data["' . $pre_name[0] . '"] = !empty(request("' . $pre_name[0] . '"))?request("' . $pre_name[0] . '"):null;' . "\n";
			}
			$i++;
		}

		$update .= '              {ModelName}::where(\'id\',$id)->update($data);' . "\n";
		if (!empty(request('ajax_request')) && request('ajax_request') == 'yes') {
			$update .= '
              ${Name} = {ModelName}::find($id);
              return successResponseJson([
               "message" => trans("{lang}.updated"),
               "data" => ${Name},
              ]);
			';
		} else {
			$update .= '              $redirect = isset($request["save_back"])?"/".$id."/edit":"";';
			$update .= '
              return redirectWithSuccess(aurl(\'{Name}\'.$redirect), trans(\'{lang}.updated\'));
            ';
		}
		$update .= '}';
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
             * Baboon Script By ' . it_version_message() . '
             * destroy a newly created resource in storage.
             * @param  $id
             * @return \Illuminate\Http\Response
             */
	public function destroy($id){
		${Name} = {ModelName}::find($id);
		if(is_null(${Name}) || empty(${Name})){
			return backWithSuccess(trans(\'{lang}.undefinedRecord\'),aurl("{Name}"));
		}
               ';
		$i = 0;
		foreach ($r->input('col_name_convention') as $conv) {

			if (!empty($r->input('col_type')[$i]) and $r->input('col_type')[$i] == 'file') {
				$destroy .= '		if(!empty(${Name}->' . $conv . ')){' . "\n";
				$destroy .= '			it()->delete(${Name}->' . $conv . ');';
				$destroy .= '		}' . "\n";
			}
			$i++;
		}

		$destroy .= '
		it()->delete(\'{Name2}\',$id);
		${Name}->delete();
		return redirectWithSuccess(aurl("{Name}"),trans(\'{lang}.deleted\'));
	}


	public function multi_delete(){
		$data = request(\'selected_data\');
		if(is_array($data)){
			foreach($data as $id){
				${Name} = {ModelName}::find($id);
				if(is_null(${Name}) || empty(${Name})){
					return backWithError(trans(\'{lang}.undefinedRecord\'),aurl("{Name}"));
				}
                    	';
		$i = 0;
		foreach ($r->input('col_name_convention') as $conv) {
			if (!empty($r->input('col_type')[$i]) and $r->input('col_type')[$i] == 'file') {
				$destroy .= '				if(!empty(${Name}->' . $conv . ')){' . "\n";
				$destroy .= '				  it()->delete(${Name}->' . $conv . ');' . "\n";
				$destroy .= '				}';
			}
			$i++;
		}

		$destroy .= '
				it()->delete(\'{Name2}\',$id);
				${Name}->delete();
			}
			return redirectWithSuccess(aurl("{Name}"),trans(\'{lang}.deleted\'));
		}else {
			${Name} = {ModelName}::find($data);
			if(is_null(${Name}) || empty(${Name})){
				return backWithError(trans(\'{lang}.undefinedRecord\'),aurl("{Name}"));
			}
                    ' . "\n";
		$i = 0;
		foreach ($r->input('col_name_convention') as $conv) {
			if (!empty($r->input('col_type')[$i]) and $r->input('col_type')[$i] == 'file') {
				$destroy .= '			if(!empty(${Name}->' . $conv . ')){' . "\n";
				$destroy .= '			 it()->delete(${Name}->' . $conv . ');' . "\n";
				$destroy .= '			}';

			}
			$i++;
		}
		$destroy .= '			it()->delete(\'{Name2}\',$data);';
		$destroy .= '
			${Name}->delete();
			return redirectWithSuccess(aurl("{Name}"),trans(\'{lang}.deleted\'));
		}
	}
            ';

		$x = 0;
		$dz_rules = '';
		$dz_attribute = '';
		$dz_uploads = '';
		$dz_exisit = false;
		foreach ($r->input('col_type') as $col_type) {
			if ($col_type == 'dropzone') {
				$dz_exisit = true;
				$valrule = rtrim(BaboonAttr::ruleList($r, $x), '|"');

				$dropzone_name = request('col_name_convention')[$x];
				$dz_rules .= 'if(request()->hasFile("' . $dropzone_name . '")){
				$rules["' . $dropzone_name . '"] = "' . $valrule . '";
			}' . "\n";
				$dz_attribute .= '"' . $dropzone_name . '" => trans("{lang}.' . $dropzone_name . '"),' . "\n";

				$dz_uploads .= 'if(request()->hasFile("' . $dropzone_name . '")){
				it()->upload("' . $dropzone_name . '", request("dz_path"), "{Name}", request("dz_id"));
			}' . "\n";
			}
			$x++;
		}

		if ($dz_exisit) {
			$destroy .= '
	// Delete Files From Dropzone Library
	public function delete_file() {
		if (request("type_file") && request("type_id")) {
			if (it()->getFile(request("type_file"), request("type_id"))) {
				it()->delete(null, null, request("id"));
				return response([
					"status" => true,
				], 200);
			}
		}
	}

	// Multi upload with dropzone
	public function multi_upload() {
		if (request()->ajax()) {
			$rules = [];
			' . $dz_rules . '

			$this->validate(request(), $rules, [], [
				 ' . $dz_attribute . '
			]);

			' . $dz_uploads . '
			return response([
				"status" => true,
				"type" => request("dz_type"),
				"file" => it()->getFile("{Name}", request("dz_id")),
			], 200);
		}

	}';
		}

		$destroy .= self::addAjaxFunc() . "\n";

		$Name = str_replace('controller', '', strtolower($r->input('controller_name')));
		$destroy = str_replace('{ModelName}', $r->input('model_name'), $destroy);
		$destroy = str_replace('{lang}', $r->input('lang_file'), $destroy);
		$destroy = str_replace('{Name}', $Name, $destroy);
		$destroy = str_replace('{Name2}', strtolower($r->input('model_name')), $destroy);
		return $destroy;
	}

	public static function addAjaxFunc() {
		$ajax = '';
		$i = 0;
		foreach (request('col_name_convention') as $input) {
			if (!empty(request('link_ajax' . $i)) && request('link_ajax' . $i) == 'yes') {
				$explode_name = explode('|', $input);
				$col_name = count($explode_name) > 0 ? $explode_name[0] : $input;
				$explode_connect = explode('|', request('select_ajax_link' . $i));
				$connect_name = count($explode_connect) > 0 ? $explode_connect[0] : request('select_ajax_link' . $i);
				$new_pluck = str_replace('::', '::where("' . $connect_name . '",request("' . $connect_name . '"))->', '\\' . $explode_name[1]);
				$ajax .= '
	public function get_' . $col_name . '() {
		if (request()->ajax()) {
			if (request("' . $connect_name . '") > 0) {
				$select = request("select") > 0 ? request("select") : "";
				return \Form::select("' . $col_name . '",' . $new_pluck . ', $select, ["class" => "form-control select2", "placeholder" => trans("{lang}.choose"), "id" => "' . $col_name . '"]);
			}
		} else {
			return "<select class=\'form-control\'></select>";
		}
	}
' . "\n";
			}
			$i++;
		}
		return $ajax;

	}

	public static function text($data) {
		return view('baboon.elements.update.text', ['data' => $data]);
	}

	public static function dropzone($data) {
		return view('baboon.elements.update.dropzone', ['data' => $data]);
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

	public static function date_time($data) {
		return view('baboon.elements.update.date_time', ['data' => $data]);
	}

	public static function time($data) {
		return view('baboon.elements.update.time', ['data' => $data]);
	}
	public static function updatebutton($data) {
		return view('baboon.elements.update.updatebtn', ['data' => $data]);
	}
}
