<?php
namespace Phpanonymous\It\Controllers\Docs;

use App\Http\Controllers\Controller;

class Docs extends Controller {

	public function index() {
		return view('it::docs.index', ['title' => it_trans('it.docs')]);
	}
}