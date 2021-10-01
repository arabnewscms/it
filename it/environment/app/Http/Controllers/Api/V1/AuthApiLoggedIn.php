<?php
namespace App\Http\Controllers\Api\V1;

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
		$this->middleware('jwt.auth', ['except' => ['login']]);
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
			'token_type' => 'bearer',
			'expires_in' => auth()->factory()->getTTL() * 60,
		];
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

	public function account() {
		return successResponseJson(['data' => auth()->user()]);
	}

	/**
	 * Get a JWT via given credentials.
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function login() {
		$this->validate(request(), [
			'email' => 'required|email',
			'password' => 'required',
		], [], [
			'email' => trans('admin.email'),
			'password' => trans('admin.password'),
		]);
		$credentials = request(['email', 'password']);
		if (!$token = auth()->attempt($credentials)) {
			return errorResponseJson(['error' => 'Unauthorized', 'message' => trans('auth.failed')], 401);
		}
		return successResponseJson(['data' => $this->respondWithToken($token)]);
	}

}