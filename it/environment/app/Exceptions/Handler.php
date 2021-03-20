<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
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