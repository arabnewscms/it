<?php
namespace Phpanonymous\It\Controllers;
use App\Http\Controllers\Controller;

class WorkFlow extends Controller {

	public function loading() {
		return view('workflow');
	}
}
