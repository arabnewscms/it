<?php
namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Response;
use Throwable;
use \Illuminate\Validation\ValidationException;

class Handler extends ExceptionHandler {
	/**
	 * A list of the exception types that are not reported.
	 *
	 * @var array
	 */
	protected $dontReport = [
		//
	];

	/**
	 * A list of the inputs that are never flashed for validation exceptions.
	 *
	 * @var array
	 */
	protected $dontFlash = [
		'current_password',
		'password',
		'password_confirmation',
	];

	protected function invalidJson($request, ValidationException $exception) {
		return response()->json([
			'status' => false,
			'StatusCode' => $exception->status,
			'StatusType' => 'Unprocessable Entity',
			'explainError' => 'The request was well-formed but was unable to be followed due to semantic errors.',
			'message' => 'The given data is invalid',
			'errors' => $exception->errors(),
		], $exception->status);
	}

	protected function unauthenticated($request, AuthenticationException $exception) {
		if ($request->expectsJson()) {
			return response()->json([
				'status' => false,
				'authorized' => false,
				'message' => 'Unauthenticated',
				'StatusType' => 'Unauthorized',
				'StatusCode' => 401,
				'explainError' => 'Similar to 403 Forbidden, but specifically for use when authentication is possible but has failed or not yet been provided. The response must include a WWW-Authenticate header field containing a challenge applicable to the requested resource.',

			], 401);
		}

		return redirect()->guest('login');
	}

	/**
	 * Register the exception handling callbacks for the application.
	 *
	 * @return void
	 */
	public function register() {

		$this->reportable(function (Throwable $e) {
			//
		});
	}
}