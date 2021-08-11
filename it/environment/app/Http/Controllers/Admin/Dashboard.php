<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

class Dashboard extends Controller {

	public function home() {
		return view('admin.home', ['title' => trans('admin.dashboard')]);
	}

	public function theme($id) {
		if (session()->has('theme')) {
			session()   ->forget('theme');
		}
		session()->put('theme', $id);
	}
}
