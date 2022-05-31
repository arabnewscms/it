<?php
namespace App\Http\Middleware;

use Closure;

class Cors {

	/**
	 * Handle an incoming request.
	 *
	 * @param Request $request
	 * @param Closure $next
	 * @return mixed
	 */
	public function handle($request, Closure $next) {
		$response = $next($request);
		//$response->header('Access-Control-Allow-Methods', 'HEAD, GET, POST, PUT, DELETE');
		//$response->header('Access-Control-Allow-Headers', $request->header('Access-Control-Request-Headers'));
		//$response->header('Access-Control-Allow-Origin', '*');
		return $response;
	}

}
