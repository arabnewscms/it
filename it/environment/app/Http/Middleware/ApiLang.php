<?php
namespace App\Http\Middleware;

use Closure;

class ApiLang {
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @param  string|null  $guard
	 * @return mixed
	 */
	public function handle($request, Closure $next, $guard = null) {

		if (request()->has('lang') && in_array(request('lang'), ['ar', 'en'])) {
			app()->setlocale(request('lang'));
		} else {
			app()->setlocale('ar');
		}

		return $next($request);

	}
}
