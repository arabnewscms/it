<?php
if (!function_exists('disable_folder_list')) {
	function disable_folder_list() {
		return ['App\Console', 'App\DataTables', 'App\Exceptions', 'App\Http', 'App\Mail', 'App\Providers', 'App\it'];
	}
}

if (!function_exists('getnamespace')) {
	function getnamespace($namespaces) {
		$namespaces = str_replace('App/Http/Controllers/', '', str_replace('\\', '/', $namespaces));
		$namespaces = app_path('Http/Controllers/' . $namespaces);
		foreach (array_filter(glob($namespaces . '/*'), 'is_dir') as $namespace) {
			$controller_namespace_prefix = str_replace('/', '\\', 'App\\' . explode('app', $namespace)[1]);
			$controller_namespace_prefix = str_replace('\\\\', '\\', $controller_namespace_prefix);
			echo getnamespace($namespaces);
			echo $namespace;
			echo '<option value="' . $controller_namespace_prefix . '">' . $controller_namespace_prefix . '</option>';
		}

	}
}

if (!function_exists('get_model_baboon')) {
	function get_model_baboon($model_list) {
		$model_list = str_replace('App/Http/Controllers/', '', str_replace('\\', '/', $model_list));
		$model_list = app_path('Http/Controllers/' . $model_list);
		foreach (array_filter(glob($model_list . '/*'), 'is_dir') as $namespace) {
			$model_list_files = str_replace('/', '\\', 'App\\' . explode('app', $namespace)[1]);
			$model_list_files = str_replace('\\\\', '\\', $model_list_files);
			echo get_model_baboon($model_list);
			echo $namespace;
			echo '<optgroup label="' . $model_list_files . '">' . $model_list_files . '</optgroup>';
		}
	}
}

if (!function_exists('check_package')) {
	function check_package($packageName) {
		$file = base_path('composer.lock');
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
		$baboonModule = (new \Phpanonymous\It\Controllers\Baboon\CurrentModuleMaker\BaboonModule);
		// Load all Modules
		$getAllModule = $baboonModule->getAllModules();

		$data['getAllModule'] = $getAllModule;
		if (!empty(request('module')) && !is_null(request('module'))) {
			$Modulefile = 'baboon/' . request('module');
			// Edit Modules
			$readmodule = $baboonModule->read($Modulefile);
			if ($readmodule === false) {
				// redirect if fails load Files
				header('Location: ' . url('it/baboon-sd'));
				exit;
			} else {
				$data['module_data'] = $readmodule;
				$data['module_last_modified'] = date('Y-m-d h:i:s A T', $baboonModule->lastModified($Modulefile));
			}
		} else {
			$data['module_data'] = null;
			$data['module_last_modified'] = null;
		}
		return view('it::' . $view, $data);
	}
}

if (!function_exists('it_version_message')) {
	function it_version_message() {
		$version = '[It V ' . it_version() . ' | https://it.phpanonymous.com]';
		app()->singleton('it_version_message', function () use ($version) {
			return $version;
		});
		return $version;
	}
}

if (!function_exists('it_version')) {
	function it_version() {
		$version = '1.5.9';
		app()->singleton('it_version', function () use ($version) {
			return $version;
		});
		return $version;
	}
}

if (!function_exists('it_trans')) {
	function it_trans($trans) {
		//	\Lang::addNamespace('it', base_path('app/it/lang'));
		return Lang::get('it::' . $trans);
	}
}

if (!function_exists('it_des')) {
	function it_des($path) {
		return url('it_des/' . $path);
	}
}

if (!function_exists('it_permissions')) {
	function it_permissions($path) {
		$perms = fileperms($path);
		switch ($perms & 0xF000) {
		case 0xC000: // socket
			$info = 's';
			break;
		case 0xA000: // symbolic link
			$info = 'l';
			break;
		case 0x8000: // regular
			$info = 'r';
			break;
		case 0x6000: // block special
			$info = 'b';
			break;
		case 0x4000: // directory
			$info = 'd';
			break;
		case 0x2000: // character special
			$info = 'c';
			break;
		case 0x1000: // FIFO pipe
			$info = 'p';
			break;
		default: // unknown
			$info = 'u';
		}

		// Owner
		$info .= (($perms & 0x0100) ? 'r' : '-');
		$info .= (($perms & 0x0080) ? 'w' : '-');
		$info .= (($perms & 0x0040) ?
			(($perms & 0x0800) ? 's' : 'x') :
			(($perms & 0x0800) ? 'S' : '-'));

		// Group
		$info .= (($perms & 0x0020) ? 'r' : '-');
		$info .= (($perms & 0x0010) ? 'w' : '-');
		$info .= (($perms & 0x0008) ?
			(($perms & 0x0400) ? 's' : 'x') :
			(($perms & 0x0400) ? 'S' : '-'));

		// World
		$info .= (($perms & 0x0004) ? 'r' : '-');
		$info .= (($perms & 0x0002) ? 'w' : '-');
		$info .= (($perms & 0x0001) ?
			(($perms & 0x0200) ? 't' : 'x') :
			(($perms & 0x0200) ? 'T' : '-'));

		return $info;
	}
}
