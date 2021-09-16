<?php
namespace Phpanonymous\It\Controllers\Baboon\CurrentModuleMaker;
use App\Http\Controllers\Controller;
//use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Phpanonymous\It\Controllers\Baboon\MasterBaboon as Baboon;

class BaboonDeleteModule extends Controller {
	protected $module;
	protected $file;
	protected $path = 'baboon/';
	protected $ext = '.baboon';

	/**
	 * Initializes the object.
	 */

	//deleteDirectory
	//delete
	public function init() {
		if (!empty(request('delete_module'))) {
			$module_name = request('delete_module');

			$modules = Storage::disk('local')->files($this->path);

			if ($read = $this->read($this->path . $module_name)) {

				// delete From Module Counter
				$this->deleteStatistics($read);

				// delete From Menu
				$this->deleteMenuList($read);

				// delete Model
				$this->deleteModel($read);

				// delete Controller
				$this->deleteController($read);

				// delete Migration
				$this->deleteMigration($read);

				// delete Blades
				$this->deleteBlades($read);

				// delete Validation
				$this->deleteValidation($read);

				// delete Api
				$this->deleteApi($read);

				// delete DataTable
				$this->deleteDataTable($read);

				// delete RouteListPermission
				$this->deleteRouteListPermission($read);

				// delete AdminRoute
				$this->deleteAdminRoute($read);

				// Delete BMaker File
				Storage::disk('local')->delete($this->path . $module_name);
			}
		}
		return redirect(url('it/baboon-sd'));
	}

	public function deleteStatistics($read) {
		$link = strtolower(preg_replace('/Controller|controller/i', '', $read->controller_name));
		$file = 'resources/views/admin/layouts/statistics/module_counters.blade.php';
		$statistics = file_get_contents(base_path($file));

		if (preg_match("/" . $link . "/i", $statistics)) {
			$startPoint = '<!--' . $link . '_start-->';
			$endPoint = '<!--' . $link . '_end-->';
			$result = preg_replace('#(' . preg_quote($startPoint) . ')(.*)(' . preg_quote($endPoint) . ')#siU', '', $statistics);
			\Storage::disk('it')->put($file, $result);
		}
	}

	public function deleteMenuList($read) {
		$link = strtolower(preg_replace('/Controller|controller/i', '', $read->controller_name));
		$file = 'resources/views/admin/layouts/menu.blade.php';
		$admin_menu = file_get_contents(base_path($file));

		if (preg_match("/" . $link . "/i", $admin_menu)) {
			$startPoint = '<!--' . $link . '_start_route-->';
			$endPoint = '<!--' . $link . '_end_route-->';
			$result = preg_replace('#(' . preg_quote($startPoint) . ')(.*)(' . preg_quote($endPoint) . ')#siU', '', $admin_menu);
			\Storage::disk('it')->put($file, $result);
		}
	}

	public function deleteAdminRoute($read) {
		$link = strtolower(preg_replace('/Controller|controller/i', '', $read->controller_name));

		$namespace_single = explode('App\Http\Controllers\\', $read->controller_namespace)[1];

		$route1 = str_replace(' ', '', 'Route::resource(\'' . $link . '\',\'' . $namespace_single . '\\' . $read->controller_name . '\');');

		$route2 = str_replace(' ', '', 'Route::post(\'' . $link . '/multi_delete\',\'' . $namespace_single . '\\' . $read->controller_name . '@multi_delete\');');
		$route3 = str_replace(' ', '', 'Route::post(\'' . $link . '/upload/multi\',\'' . $namespace_single . '\\' . $read->controller_name . '@multi_upload\');');
		$route4 = str_replace(' ', '', 'Route::post(\'' . $link . '/delete/file\',\'' . $namespace_single . '\\' . $read->controller_name . '@delete_file\');');

		$admin_routes = file_get_contents(base_path('routes/admin.php'));
		$admin_routes = str_replace(' ', '', $admin_routes);
		$admin_routes = str_replace('useIlluminate\Support\Facades\Route;', 'use Illuminate\Support\Facades\Route;', $admin_routes);
		$admin_routes = str_replace($route1, "", $admin_routes);
		$admin_routes = str_replace($route2, '', $admin_routes);
		$admin_routes = str_replace($route3, '', $admin_routes);
		$admin_routes = str_replace($route4, '', $admin_routes);
		if (!preg_match("/" . $link . "/i", $admin_routes)) {
			Storage::disk('it')->put('routes/admin.php', $admin_routes);
			//dd($admin_routes);
		}
	}

	public function deleteRouteListPermission($read) {
		$routes = Baboon::RouteListRoles(request());
		$routes = str_replace('"' . $read->convention_name . '",', '', $routes);
		$routes = str_replace('"",', '', $routes);
		Baboon::write($routes, 'AdminRouteList', 'app\\Http\\');
	}

	public function deleteDataTable($read) {
		// Delete Controller
		$DataTables_path = 'app/DataTables';
		$DataTables_name = $read->controller_name . 'DataTable.php';
		$DataTables = $DataTables_path . '/' . $DataTables_name;
		if (Storage::disk('it')->has($DataTables)) {
			Storage::disk('it')->delete($DataTables);
			return true;
		} else {
			return false;
		}
	}
	public function deleteApi($read) {
		// Delete Controller
		$api_path = 'app/Http/Controllers/Api';
		$api_name = $read->controller_name . 'Api.php';
		$api = $api_path . '/' . $api_name;
		if (Storage::disk('it')->has($api)) {
			Storage::disk('it')->delete($api);
			return true;
		} else {
			return false;
		}
	}

	public function deleteValidation($read) {
		// Delete Controller
		$validation_path = 'app/Http/Controllers/validations';
		$validation_name = $read->controller_name . 'Request.php';
		$validation = $validation_path . '/' . $validation_name;
		if (Storage::disk('it')->has($validation)) {
			Storage::disk('it')->delete($validation);
			return true;
		} else {
			return false;
		}
	}

	public function deleteBlades($read) {
		// Delete Controller
		$migration_path = $read->admin_folder_path;
		$migration_name = $read->convention_name;
		$migration = $migration_path . '/' . $migration_name;
		if (Storage::disk('it')->deleteDirectory($migration)) {
			return true;
		} else {
			return false;
		}
	}

	public function deleteMigration($read) {
		// Delete Controller
		$migration_path = 'database/migrations';
		$migration_name = $read->migration_file_name . '.php';
		$migration = $migration_path . '/' . $migration_name;
		if (Storage::disk('it')->has($migration)) {
			Storage::disk('it')->delete($migration);
			\DB::statement('SET FOREIGN_KEY_CHECKS = 0');

			\DB::table('migrations')
				->where('migration', $read->migration_file_name)
				->delete();

			\Schema::dropIfExists($read->convention_name);

			// Enable ForignKey Checks DB
			\DB::statement('SET FOREIGN_KEY_CHECKS = 1');
			return true;
		} else {
			return false;
		}
	}

	public function deleteController($read) {
		// Delete Controller
		$controller_path = str_replace('\\', '/', str_replace('App\\', 'app\\', $read->controller_namespace));
		$controller_name = $read->controller_name . '.php';
		$controller = $controller_path . '/' . $controller_name;
		if (Storage::disk('it')->has($controller)) {
			Storage::disk('it')->delete($controller);
			return true;
		} else {
			return false;
		}
	}

	public function deleteModel($read) {
		// Delete Model
		$path_models = str_replace('\\', '/', str_replace('App\\', 'app\\', $read->model_namespace));
		$model_name = $read->model_name . '.php';
		$model = $path_models . '/' . $model_name;
		if (Storage::disk('it')->has($model)) {
			Storage::disk('it')->delete($model);
			return true;
		} else {
			return false;
		}

	}

	/**
	 * read a module after created
	 *
	 * @return     <string or bool>  ( to read data from baboon File )
	 */
	public function read($file) {
		if ($this->exist($file)) {
			$content = $this->decode(Storage::disk('local')
					->get($file));
			return $content;
		} else {
			return false;
		}
	}

	/**
	 * check to exists file
	 * @return  <bool>
	 */
	public function exist($file) {
		return Storage::disk('local')->exists($file);
	}

	/**
	 * Deletes the file
	 *
	 * @return     <bool>  ( to delete module )
	 */
	public function delete() {
		return Storage::disk('local')->delete($this->file);
	}

	/**
	 * encode String
	 *
	 * @param      <string>  $str    The string
	 *
	 * @return     <string>  ( to Crypt String )
	 */
	public function encode($str) {
		return base64_encode($str);
	}

	/**
	 * decode string
	 *
	 * @param      <string>  $str    The string
	 *
	 * @return     <string>  ( to Decrypt String )
	 */
	public function decode($str) {
		$decode = base64_decode($str);
		return json_decode($decode);
	}

}