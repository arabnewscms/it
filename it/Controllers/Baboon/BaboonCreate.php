<?php
namespace Phpanonymous\It\Controllers\Baboon;
use App\Http\Controllers\Controller;

class BaboonCreate extends Controller {

	public static function indexMethod($r) {
		$index = '
            /**
             * Baboon Script By ' . it_version_message() . '
             * Display a listing of the resource.
             * @return \Illuminate\Http\Response
             */
            public function index({ClassName}DataTable ${ClassName2})
            {
               return ${ClassName2}->render(\'{path}.{ClassName2}.index\',[\'title\'=>trans(\'{lang}.{ClassName2}\')]);
            }' . "\n";
		$folder = str_replace('controller', '', strtolower($r->input('controller_name')));
		$folder2 = str_replace('Controller', '', $r->input('controller_name'));
		$folder2 = str_replace('controller', '', $folder2);
		$index = str_replace('{ClassName}', $folder2, $index);
		$index = str_replace('{ClassName2}', $folder, $index);
		$index = str_replace('{path}', str_replace('resources/views/', '', $r->input('admin_folder_path')), $index);
		$index = str_replace('{lang}', $r->input('lang_file'), $index);

		return $index;
	}

	public static function createMethod($r) {
		$temp_id_dropzone = '';
		foreach ($r->input('col_type') as $col_type) {
			if ($col_type == 'dropzone') {
				//(time()*rand(0000,9999))
				// Add Temp Link for dropzone
				$temp_id_dropzone = '
            $temp_id = (time()*rand(0000,9999));
            if(empty(request("temp_id")) || !request()->has("temp_id")){
					return redirect(aurl("{ClassName}/create?temp_id=".$temp_id));
				}' . "\n";
			}
		}

		$create = '
            /**
             * Baboon Script By ' . it_version_message() . '
             * Show the form for creating a new resource.
             * @return \Illuminate\Http\Response
             */
            public function create()
            {
            	' . $temp_id_dropzone . '
               return view(\'{path}.{ClassName}.create\',[\'title\'=>trans(\'{lang}.create\')]);
            }';

		$folder2 = str_replace('controller', '', strtolower($r->input('controller_name')));
		$create = str_replace('{ClassName}', $folder2, $create);
		$create = str_replace('{lang}', $r->input('lang_file'), $create);
		$create = str_replace('{path}', str_replace('resources/views/', '', $r->input('admin_folder_path')), $create);
		return $create;
	}

	public static function createPath($folder) {
		if (!file_exists(base_path('baboon/' . request('project_title')))) {
			mkdir(base_path('baboon/' . request('project_title')));
		}

		if (!file_exists(base_path('baboon/' . request('project_title') . '/upload'))) {
			mkdir(base_path('baboon/' . request('project_title') . '/upload'));
		}

		if (!file_exists(base_path('baboon/' . request('project_title') . '/upload') . '/' . $folder)) {
			mkdir(base_path('baboon/' . request('project_title') . '/upload') . '/' . $folder);
		}
		if (!file_exists(base_path('baboon/' . request('project_title') . '/upload' . '/' . $folder . '/index.html'))) {
			$domain = url('/');
			$content = '<?php  header("Location: ' . $domain . '");  exit(); ?>';
			$index = fopen(base_path('baboon/' . request('project_title') . '/upload' . '/' . $folder . '/index.php'), 'w');
			fwrite($index, '');
			fclose($index);
			$htmlcontent = '<meta http-equive="refresh" content=0;' . $domain . ' " />';
			$html = fopen(base_path('baboon/' . request('project_title') . '/upload' . '/' . $folder . '/index.html'), 'w');
			fwrite($html, '');
			fclose($html);
		}
	}

	public static function storeMethod($r) {
		$objectlist = [];
		$store = '
            /**
             * Baboon Script By ' . it_version_message() . '
             * Store a newly created resource in storage.
             * @param  \Illuminate\Http\Request  $request
             * @return \Illuminate\Http\Response Or Redirect
             */
            public function store(' . $r->input('controller_name') . 'Request $request)
            {
                $data = $request->except("_token", "_method");
            	';
		// Dropzone Checks start //
		$dropzone_checks = false;
		$d = 0;
		foreach ($r->input('col_type') as $col) {
			if ($col == 'dropzone') {
				$dropzone_checks = true;

			}
			$d++;
		}
		if ($dropzone_checks) {
			$store .= '
		// Unset or Remove Dropzone request
		$dz_path = request("dz_path");
		$dz_type = request("dz_type");
		$dz_id = request("dz_id");
		unset($data["dz_id"], $data["dz_type"], $data["dz_type"]);
		' . "\n";
		}
		// Dropzone Checks end //

		$i = 0;
		foreach ($r->input('col_name_convention') as $conv) {
			$objectlist = [];
			if ($r->input('col_type')[$i] == 'file') {
				$store .= '$data[\'' . $conv . '\'] = "";' . "\n";
			} elseif ($r->input('col_type')[$i] == 'time') {
				$store .= '              $data[\'' . $conv . '\'] = date(\'H:i\', strtotime(request(\'' . $conv . '\')));' . "\n";
			} elseif ($r->input('col_type')[$i] == 'date_time') {
				$store .= '              $data[\'' . $conv . '\'] = date(\'Y-m-d H:i\', strtotime(request(\'' . $conv . '\')));' . "\n";
			}
			$i++;
		}

		if ($r->has('has_user_id')) {
			$store .= '$data[\'admin_id\'] = admin()->id(); ' . "\n";
		}

		$store .= '		  		${Name} = {ModelName}::create($data); ' . "\n";

		// Standard File Checks Start//
		$i = 0;
		foreach ($r->input('col_name_convention') as $conv) {
			$objectlist = [];
			if ($r->input('col_type')[$i] == 'file') {
				$store .= '               if(request()->hasFile(\'' . $conv . '\')){' . "\n";
				$folder = str_replace('controller', '', strtolower($r->input('controller_name')));

				$store .= '              ${Name}->' . $conv . ' = it()->upload(\'' . $conv . '\',\'' . $folder . '/\'.${Name}->id);' . "\n";
				$store .= '              ${Name}->save();' . "\n";
				$store .= '              }' . "\n";
			}
			$i++;
		}
		// Standard File Checks End//

		if ($dropzone_checks) {
			$store .= '
		// rename or move files from tempfile Folder after Add record
		if ($dz_type == "create") {
			it()->rename("{Name}", $dz_id, ${Name}->id);
		}
		' . "\n";
		}
		if (!empty(request('ajax_request')) && request('ajax_request') == 'yes') {
			$store .= '
			return successResponseJson([
				"message" => trans("{lang}.added"),
				"data" => ${Name},
			]);
			';
		} else {
			$store .= '                $redirect = isset($request["add_back"])?"/create":"";';
			$store .= '
                return redirectWithSuccess(aurl(\'{Name}\'.$redirect), trans(\'{lang}.added\'));';
		}

		$store .= ' }';
		$Name = str_replace('controller', '', strtolower($r->input('controller_name')));
		$store = str_replace('{ModelName}', $r->input('model_name'), $store);
		$store = str_replace('{lang}', $r->input('lang_file'), $store);
		$store = str_replace('{Name}', $Name, $store);
		return $store;
	}

	public static function text($data) {
		return view('baboon.elements.create.text', ['data' => $data]);
	}

	public static function dropzone($data) {
		return view('baboon.elements.create.dropzone', ['data' => $data]);
	}

	public static function email($data) {
		return view('baboon.elements.create.email', ['data' => $data]);
	}

	public static function url($data) {
		return view('baboon.elements.create.url', ['data' => $data]);
	}

	public static function textarea($data) {
		return view('baboon.elements.create.textarea', ['data' => $data]);
	}

	public static function textarea_ckeditor($data) {
		return view('baboon.elements.create.textarea_ckeditor', ['data' => $data]);
	}

	public static function radio($data) {
		return view('baboon.elements.create.radio', ['data' => $data]);
	}

	public static function checkbox($data) {
		return view('baboon.elements.create.checkbox', ['data' => $data]);
	}

	public static function select($data) {
		return view('baboon.elements.create.select', ['data' => $data]);
	}

	public static function file($data) {
		return view('baboon.elements.create.file', ['data' => $data]);
	}

	public static function password($data) {
		return view('baboon.elements.create.password', ['data' => $data]);
	}

	public static function color($data) {
		return view('baboon.elements.create.color', ['data' => $data]);
	}

	public static function date($data) {
		return view('baboon.elements.create.date', ['data' => $data]);
	}

	public static function date_time($data) {
		return view('baboon.elements.create.date_time', ['data' => $data]);
	}

	public static function time($data) {
		return view('baboon.elements.create.time', ['data' => $data]);
	}
	public static function addbutton($data) {
		return view('baboon.elements.create.addbtn', ['data' => $data]);
	}
}
