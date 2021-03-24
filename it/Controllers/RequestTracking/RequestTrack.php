<?php
// namespace Phpanonymous\It\Controllers\RequestTracking;
// use Illuminate\Support\Facades\Log;

// //$request->fullUrl()
// class RequestTrack {
// 	public function handle($request, \Closure $next) {
// 		return $next($request);
// 	}
// 	public function terminate($request, $response) {

// 		Log::info('app.requests', [
// 			'fullUrl' => $request->fullUrl(),
// 			'ip' => $request->ip(),
// 			// 'response' => $response
// 		]);
// 		// $url = $request->fullUrl();
// 		// $ip = $request->ip();
// 		// $r = new \App\Models\Request();
// 		// $r->ip = $ip;
// 		// $r->url = $url;
// 		// $r->request = json_encode($request->all());
// 		// $r->response = $response;
// 		// $r->save();
// 	}
// }