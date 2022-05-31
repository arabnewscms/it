<?php
if (!function_exists('disable_folder_list')) {
	function disable_folder_list() {
		return ['App\Console', 'App\DataTables', 'App\Exceptions', 'App\Http', 'App\Mail', 'App\Providers', 'App\it'];
	}
}

if (!function_exists('getnamespace')) {
	function getnamespace($namespaces) {
		$namespaces = str_replace('App/Http/Controllers/', '', str_replace('\\', '/', $namespaces));
		$namespaces = app_path('Http/Controllers/'.$namespaces);
		foreach (array_filter(glob($namespaces.'/*'), 'is_dir') as $namespace) {
			$controller_namespace_prefix = str_replace('/', '\\', 'App\\'.explode('app', $namespace)[1]);
			$controller_namespace_prefix = str_replace('\\\\', '\\', $controller_namespace_prefix);
			echo getnamespace($namespaces);
			echo $namespace;
			echo '<option value="'.$controller_namespace_prefix.'">'.$controller_namespace_prefix.'</option>';
		}

	}
}

if (!function_exists('get_model_baboon')) {
	function get_model_baboon($model_list) {
		$model_list = str_replace('App/Http/Controllers/', '', str_replace('\\', '/', $model_list));
		$model_list = app_path('Http/Controllers/'.$model_list);
		foreach (array_filter(glob($model_list.'/*'), 'is_dir') as $namespace) {
			$model_list_files = str_replace('/', '\\', 'App\\'.explode('app', $namespace)[1]);
			$model_list_files = str_replace('\\\\', '\\', $model_list_files);
			echo get_model_baboon($model_list);
			echo $namespace;
			echo '<optgroup label="'.$model_list_files.'">'.$model_list_files.'</optgroup>';
		}
	}
}

if (!function_exists('check_package')) {
	function check_package($packageName) {
		$file     = base_path('composer.lock');
		$packages = json_decode(file_get_contents($file), true)['packages'];
		foreach ($packages as $package) {
			if ($package['name'] == $packageName) {
				return $package['version'];
			}
		}
		return null;
	}
}

if (!function_exists('it_int')) {
	function it_int() {

	}
}

if (!function_exists('it_views')) {
	// Init & RUN Baboon Module Class
	function it_views($view, $data = []) {
		return view('it::'.$view, $data);
	}
}

if (!function_exists('it_version_message')) {
	function it_version_message() {
		$version = '[it v '.it_version().']';
		app()->singleton('it_version_message', function () use ($version) {
				return $version;
			});
		return $version;
	}
}

if (!function_exists('it_version')) {
	function it_version() {
		$version = '1.6.40';
		app()->singleton('it_version', function () use ($version) {
				return $version;
			});
		return $version;
	}
}

if (!function_exists('it_docs_version')) {
	function it_docs_version() {
		return '1.1';
	}
}

if (!function_exists('it_laravelversion')) {
	function it_laravelversion() {
		return app()->version();
	}
}

if (!function_exists('it_trans')) {
	function it_trans($trans, $choose = []) {
		return Lang::get('it::'.$trans, $choose);
	}
}

if (!function_exists('it_des')) {
	function it_des($path) {
		return url('it_des/'.$path);
	}
}

if (!function_exists('it_permissions')) {
	function it_permissions($path) {
		$perms = fileperms($path);

		switch ($perms&0xF000) {
			case 0xC000:// socket
				$info = 's';
				break;
			case 0xA000:// symbolic link
				$info = 'l';
				break;
			case 0x8000:// regular
				$info = 'r';
				break;
			case 0x6000:// block special
				$info = 'b';
				break;
			case 0x4000:// directory
				$info = 'd';
				break;
			case 0x2000:// character special
				$info = 'c';
				break;
			case 0x1000:// FIFO pipe
				$info = 'p';
				break;
			default:// unknown
				$info = 'u';
		}

		// Owner
		$info .= (($perms&0x0100)?'r':'-');
		$info .= (($perms&0x0080)?'w':'-');
		$info .= (($perms&0x0040)?
			(($perms&0x0800)?'s':'x'):
			(($perms&0x0800)?'S':'-'));

		// Group
		$info .= (($perms&0x0020)?'r':'-');
		$info .= (($perms&0x0010)?'w':'-');
		$info .= (($perms&0x0008)?
			(($perms&0x0400)?'s':'x'):
			(($perms&0x0400)?'S':'-'));

		// World
		$info .= (($perms&0x0004)?'r':'-');
		$info .= (($perms&0x0002)?'w':'-');
		$info .= (($perms&0x0001)?
			(($perms&0x0200)?'t':'x'):
			(($perms&0x0200)?'T':'-'));

		return $info;
	}
}

//  Signeture Rules
if (!function_exists('it_rule_convention')) {
	function it_rule_convention($attribute, $value, $fail) {
		$i = explode('.', $attribute)[1];
		// Name Column
		$name = '(<b style="color:#ffa306">'.request('col_name')[$i].' - '.request(explode('.', $attribute)[0])[$i].'</b>)';

		if (in_array(request('col_type')[$i], ['text', 'number', 'email', 'url', 'textarea', 'textarea_ckeditor', 'file', 'dropzone', 'password', 'date', 'date_time', 'time', 'timestamp', 'color'])) {
			preg_match("/[^A-Za-z0-9'_' ']/", $value)?
			$fail($name.'There should not be any signs such as (!@#$%^&*()|><) only numbers and letters')
			:'';
		} elseif (in_array(request('col_type')[$i], ['checkbox', 'radio'])) {
			$secound_value = explode('#', $value);

			!preg_match("/#/i", $value) || empty($secound_value[1])?
			$fail($name.' There should have signs such as (column_name#value)')
			:'';
		} elseif (in_array(request('col_type')[$i], ['select'])) {
			$secound_value = explode('|', $value);
			!preg_match('/(\d+)\+(\d+)|,/i', $value) || empty($secound_value[1])?
			$fail($name.' There should have signs such as (status|accept,Accept/pending,Pending) or ( user_id|App\Models\User::pluck("name","id") )')
			:'';

			// Scan if have forgin key and exisit pluck model
			if (preg_match('/App\\\\/i', request(explode('.', $attribute)[0])[$i])) {
				if (empty(request('references'.$i)) || empty(request('forgin_table_name'.$i))) {
					$fail($name.' Should be complete Schema Relation add References and Table Name');
				} elseif (empty(request('schema_name')) || !in_array($secound_value[0], request('schema_name'))) {
					$fail($name.' click releations tab and add new relation key '.$secound_value[0].' and choose model from dropdown ');
				}
			}
		}

	}
}

if (!function_exists('checkIfExisitValue')) {
	function checkIfExisitValue($request_name, $value) {
		return !empty(request($request_name)) && in_array($value, request($request_name))?true:false;
	}
}
if (!function_exists('api_check')) {
	function api_check($name) {
		$module_data = app('module_data');
		if (!empty($module_data->api)) {
			if (!empty($module_data->api->api_url) && in_array($name, $module_data->api->api_url)) {
				return 'checked';
			} else {
				return '';
			}
		} else {
			return 'checked';
		}
	}
}

if (!function_exists('faker_locale')) {
	function faker_locale($val, $module_data) {
		return !empty($module_data) && !empty($module_data->faker_local) && $module_data->faker_local == $val?true:false;
	}
}