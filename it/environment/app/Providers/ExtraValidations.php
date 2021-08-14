<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ExtraValidations extends ServiceProvider {

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */

	public function boot() {
		$this->app['validator']->extend('pdf', function ($attribute, $value, $parameters) {
			if (is_array($value) && count($value) > 0) {
				foreach ($value as $data) {
					return $data->isValid() ?
					$data->getMimetype() == 'application/pdf' : false;
				}
			} else {
				return $value->isValid() ?
				$value->getMimetype() == 'application/pdf' : false;
			}
		}, trans('validation.pdf'));

		$this->app['validator']->extend('docx', function ($attribute, $value, $parameters) {
			if (is_array($value) && count($value) > 0) {
				foreach ($value as $data) {
					return $data->isValid() ?
					$data->getMimetype() == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document' : false;
				}
			} else {
				return $value->isValid() ?
				$value->getMimetype() == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document' : false;
			}
		}, trans('validation.docx'));

		$this->app['validator']->extend('docx', function ($attribute, $value, $parameters) {
			if (is_array($value) && count($value) > 0) {
				foreach ($value as $data) {
					return $data->isValid() ?
					$data->getMimetype() == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document' : false;
				}
			} else {
				return $value->isValid() ?
				$value->getMimetype() == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document' : false;
			}
		}, trans('validation.docx'));

		$this->app['validator']->extend('mp3', function ($attribute, $value, $parameters) {
			if (is_array($value) && count($value) > 0) {
				foreach ($value as $data) {
					return $data->isValid() ?
					$data->getMimetype() == 'audio/mpeg' : false;
				}
			} else {
				return $value->isValid() ?
				$value->getMimetype() == 'audio/mpeg' : false;
			}
		}, trans('validation.mp3'));

		$this->app['validator']->extend('video', function ($attribute, $value, $parameters) {
			if (is_array($value) && count($value) > 0) {
				foreach ($value as $data) {
					return $data->isValid() ?
					in_array($data->getMimetype(), ['video/mp4', 'video/3gpp', 'video/mpeg', 'video/quicktime', 'video/webm', 'video/x-matroska', 'video/x-ms-wmv', 'video/x-msvideo', 'video/video/x-ms-vob']) : false;
				}
			} else {
				return $value->isValid() ?
				in_array($value->getMimetype(), ['video/mp4', 'video/3gpp', 'video/mpeg', 'video/quicktime', 'video/webm', 'video/x-matroska', 'video/x-ms-wmv', 'video/x-msvideo', 'video/video/x-ms-vob']) : false;
			}
		}, trans('validation.mp4'));

		$this->app['validator']->extend('mp4', function ($attribute, $value, $parameters) {
			if (is_array($value) && count($value) > 0) {
				foreach ($value as $data) {
					return $data->isValid() ?
					$data->getMimetype() == 'video/mp4' : false;
				}
			} else {
				return $value->isValid() ?
				$value->getMimetype() == 'video/mp4' : false;
			}
		}, trans('validation.mp4'));

		$this->app['validator']->extend('3gp', function ($attribute, $value, $parameters) {
			if (is_array($value) && count($value) > 0) {
				foreach ($value as $data) {
					return $data->isValid() ?
					$data->getMimetype() == 'video/3gpp' : false;
				}
			} else {
				return $value->isValid() ?
				$value->getMimetype() == 'video/3gpp' : false;
			}
		}, trans('validation.3gp'));

		$this->app['validator']->extend('mpeg', function ($attribute, $value, $parameters) {
			if (is_array($value) && count($value) > 0) {
				foreach ($value as $data) {
					return $data->isValid() ?
					$data->getMimetype() == 'video/mpeg' : false;
				}
			} else {
				return $value->isValid() ?
				$value->getMimetype() == 'video/mpeg' : false;
			}
		}, trans('validation.mpeg'));

		$this->app['validator']->extend('mov', function ($attribute, $value, $parameters) {
			if (is_array($value) && count($value) > 0) {
				foreach ($value as $data) {
					return $data->isValid() ?
					$data->getMimetype() == 'video/quicktime' : false;
				}
			} else {
				return $value->isValid() ?
				$value->getMimetype() == 'video/quicktime' : false;
			}
		}, trans('validation.mov'));

		$this->app['validator']->extend('webm', function ($attribute, $value, $parameters) {
			if (is_array($value) && count($value) > 0) {
				foreach ($value as $data) {
					return $data->isValid() ?
					$data->getMimetype() == 'video/webm' : false;
				}
			} else {
				return $value->isValid() ?
				$value->getMimetype() == 'video/webm' : false;
			}
		}, trans('validation.webm'));

		$this->app['validator']->extend('mkv', function ($attribute, $value, $parameters) {
			if (is_array($value) && count($value) > 0) {
				foreach ($value as $data) {
					return $data->isValid() ?
					$data->getMimetype() == 'video/x-matroska' : false;
				}
			} else {
				return $value->isValid() ?
				$value->getMimetype() == 'video/x-matroska' : false;
			}
		}, trans('validation.mkv'));

		$this->app['validator']->extend('wmv', function ($attribute, $value, $parameters) {
			if (is_array($value) && count($value) > 0) {
				foreach ($value as $data) {
					return $data->isValid() ?
					$data->getMimetype() == 'video/x-ms-wmv' : false;
				}
			} else {
				return $value->isValid() ?
				$value->getMimetype() == 'video/x-ms-wmv' : false;
			}
		}, trans('validation.wmv'));

		$this->app['validator']->extend('avi', function ($attribute, $value, $parameters) {
			if (is_array($value) && count($value) > 0) {
				foreach ($value as $data) {
					return $data->isValid() ?
					$data->getMimetype() == 'video/x-msvideo' : false;
				}
			} else {
				return $value->isValid() ?
				$value->getMimetype() == 'video/x-msvideo' : false;
			}
		}, trans('validation.avi'));

		$this->app['validator']->extend('vob', function ($attribute, $value, $parameters) {
			if (is_array($value) && count($value) > 0) {
				foreach ($value as $data) {
					return $data->isValid() ?
					$data->getMimetype() == 'video/video/x-ms-vob' : false;
				}
			} else {
				return $value->isValid() ?
				$value->getMimetype() == 'video/video/x-ms-vob' : false;
			}
		}, trans('validation.vob'));

	}

	/**
	 * Register any application services.
	 *
	 * @return void
	 */

	public function register() {

	}
}
