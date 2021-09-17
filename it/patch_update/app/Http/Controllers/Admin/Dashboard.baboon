<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Setting;

class Dashboard extends Controller {

	public function home() {
		return view('admin.home', ['title' => trans('admin.dashboard')]);
	}

	public function prepareKey($key) {
		$setting = setting()->theme_setting;
		if (!empty($setting) && !empty($setting->{$key})) {
			$$key = $setting->{$key};
		} else {
			$$key = '';
		}

		if (request()->has($key)) {
			if (!empty(request($key))) {
				return [$key => request($key)];
			} else {
				return [$key => ''];
			}
		} else {
			return [$key => $$key];
		}

	}

	public function theme_setting() {
		$data_setting = [];
		$data_setting = array_merge($data_setting, $this->prepareKey('brand_color'));
		$data_setting = array_merge($data_setting, $this->prepareKey('sidebar_class'));
		$data_setting = array_merge($data_setting, $this->prepareKey('main_header'));
		$data_setting = array_merge($data_setting, $this->prepareKey('navbar'));
		//return print_r($data_setting);
		return json_encode($data_setting);
	}

	public function theme($id) {
		if (request()->ajax()) {
			$update = Setting::find(setting()->id);
			$update->theme_setting = $this->theme_setting();
			$update->save();
			return setting()->theme_setting;
		} else {
			return 'no ajax request';
		}
	}
}