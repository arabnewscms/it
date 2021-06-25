<?php
namespace Phpanonymous\It\Controllers;
use App\Http\Controllers\Controller;

//use League\Flysystem\Cached\CachedAdapter;
//use League\Flysystem\Cached\Storage\Memory;
//use League\Flysystem\Filesystem;
//use Illuminate\Foundation\Console\RouteListCommand;
use Illuminate\Routing\Router;
use Illuminate\Support\Arr;

class RouteList extends Controller {

	public function RouteListData(Router $router) {
		/*$routelist       = new RouteListCommand();
		$routefinal_data = $routelist->displayRoutes($routelist->getRoutes());*/

		//return dd($router->getRoutes());
		$all = $router->getRoutes();
		//$sort = $this->sortRoutes('methods', $all);
		//return dd($sort);
		return view('routelist', ['title' => it_trans('it.routelist'), 'all' => $all]);
	}

	protected function sortRoutes($sort, $routes) {
		return Arr::sort($routes, function ($route) use ($sort) {
				return $route;
			});
	}
}
