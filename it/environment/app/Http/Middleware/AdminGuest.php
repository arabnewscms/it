<?php

namespace App\Http\Middleware;

use Closure;

class AdminGuest {
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @param  string|null  $guard
	 * @return mixed
	 */
	public function handle($request, Closure $next, $guard = null) {
		if (admin()->user()) {
			return redirect(aurl('/'));
		}
		return $next($request);

	}
}
