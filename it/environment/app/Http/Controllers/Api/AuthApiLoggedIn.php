<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

// Auto Configured by (IT) Baboon maker (phpanonymous/it package)

class AuthApiLoggedIn extends Controller {

	/**
	 * Create a new AuthController instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware('auth:api', ['except' => ['login']]);
	}

	/**
	 * Get the token array structure.
	 *
	 * @param  string $token
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	protected function respondWithToken($token) {
		return [
			'access_token' => $token,
			'token_type'   => 'bearer',
			'expires_in'   => auth()->factory()->getTTL()*60,
		];
	}

	/**
	 * Get a JWT via given credentials.
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function login() {
		$credentials = request(['email', 'password']);
		if (!$token = auth()->attempt($credentials)) {
			return errorResponseJson(['error' => 'Unauthorized'], 401);
		}
		return successResponseJson(['data' => $this->respondWithToken($token)]);
	}

	/**
	 * Get the authenticated User.
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function me() {
		return successResponseJson(['data' => auth()->user()]);
	}

	/**
	 * Log the user out (Invalidate the token).
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function logout() {
		auth()->logout();
		return successResponseJson(['message' => 'Successfully logged out']);
	}

	/**
	 * Refresh a token.
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function refresh() {
		return successResponseJson(['data' => $this->respondWithToken(auth()->refresh())]);
	}

}