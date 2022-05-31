<?php
namespace App\Http\Controllers\ValidationsApi\V1\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class LoginRequest extends FormRequest {

	/**
	 * Baboon Script By [it v 1.6.31]
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize() {
		return true;
	}

	public function rules() {
		return [
			'email' => 'required|email',
			'password' => [
				'required',
				'string', Password::min(6)->mixedCase()->numbers()->symbols()->uncompromised(),
			],
		];
	}

	/**
	 * Baboon Script By [it v 1.6.31]
	 * Get the validation attributes that apply to the request.
	 *
	 * @return array
	 */
	public function attributes() {
		return [
			'email' => trans('admin.email'),
			'password' => trans('admin.password'),
		];
	}

	/**
	 * Baboon Script By [it v 1.6.31]
	 * response redirect if fails or failed request
	 *
	 * @return redirect
	 */
	public function response(array $errors) {
		return $this->ajax() || $this->wantsJson() ?
		response([
			'status' => false,
			'StatusCode' => 422,
			'StatusType' => 'Unprocessable',
			'errors' => $errors,
		], 422) :
		back()->withErrors($errors)->withInput(); // Redirect back
	}

}