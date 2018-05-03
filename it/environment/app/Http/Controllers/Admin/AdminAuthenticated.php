<?php

namespace App\Http\Controllers\Admin;
use App\Admin;
use App\Http\Controllers\Controller;
use App\Mail\AdminResetPassword;
use Carbon\Carbon;
use DB;
use Mail;

class AdminAuthenticated extends Controller {

	public function login_page() {
		return view('admin.login', ['title' => trans('admin.login_page')]);
	}

	public function login_post() {
		$rememberme = request('rememberme') == 1?true:false;
		if (admin()->attempt(['email' => request('email'), 'password' => request('password')], $rememberme)) {
			return redirect(aurl(''));
		} else {
			session()->flash('error', trans('admin.error_loggedin'));
			return redirect(aurl('login'));
		}
	}

	public function logout() {
		admin()->logout();
		return redirect(aurl(''));
	}

	public function reset_password_change($token) {
		$this->validate(request(),
			[
				'password'              => 'required|min:6|confirmed',
				'password_confirmation' => 'required',
				'email'                 => 'required|email'
			], [], [
				'password'              => trans('admin.password'),
				'password_confirmation' => trans('admin.password_confirmation'),
			]);
		$token = DB::table('password_resets')->where('token', $token)->where('created_at', '>', Carbon::now()->subHours(2))->first();

		if (!empty($token)) {
			$admin = Admin::where('email', $token->email)->update(['password' => bcrypt(request('password'))]);
			session()->flash('success', trans('admin.password_is_changed'));
			if (request()->has('andlogin')) {
				auth()      ->guard('admin')->attempt(['email' => $token->email, 'password' => request('password')]);
				return redirect(aurl('/'));
			}
			DB::table('password_resets')->where('token', $token)->delete();
			return redirect(aurl('login'));
		} else {
			session()->flash('error', trans('admin.time_token_ended'));
			return redirect(aurl('login'));
		}
	}

	public function reset_password_final($token) {
		$token = DB::table('password_resets')->where('token', $token)->where('created_at', '>', Carbon::now()->subHours(2))->first();

		empty($token)?session()->flash('error', trans('admin.time_token_ended')):'';

		return !empty($token)?view('admin.reset_password', ['token' => $token]):
		redirect(aurl('login'));

	}
	public function reset_password() {
		$user = Admin::where('email', request('email'))->first();
		if (!empty($user)) {
			$token = app('auth.password.broker')->createToken($user);
			$data  = DB::table('password_resets')->insert([
					'email'      => request('email'),
					'token'      => $token,
					'created_at' => Carbon::now(),
				]);
			$sendmail = Mail::to(request('email'))->send(new AdminResetPassword([
						'url'  => aurl('password/reset/'.$token),
						'data' => $user,
					]));
			session()->flash('success', trans('admin.reset_link_sent'));
			return redirect(aurl('login'));
		} else {
			session()->flash('error', trans('admin.email_not_found'));
			return redirect(aurl('login'));
		}
	}
}
