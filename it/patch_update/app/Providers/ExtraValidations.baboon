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

		// Office Validation //

		$this->app['validator']->extend('office', function ($attribute, $value, $parameters) {
			$office_mimes = ['application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/vnd.openxmlformats-officedocument.spreadsheetml.template', 'application/vnd.ms-powerpoint', 'application/vnd.ms-powerpoint.addin.macroenabled.12', 'application/vnd.ms-powerpoint.presentation.macroenabled.12', 'application/vnd.ms-powerpoint.slide.macroenabled.12', 'application/vnd.ms-powerpoint.slideshow.macroenabled.12', 'application/vnd.ms-powerpoint.template.macroenabled.12'];
			if (is_array($value) && count($value) > 0) {
				foreach ($value as $data) {
					return $data->isValid() ?
					in_array($data->getMimetype(), $office_mimes) : false;
				}
			} else {
				return $value->isValid() ?
				in_array($value->getMimetype(), $office_mimes) : false;
			}
		}, trans('validation.office'));

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

		$this->app['validator']->extend('xls', function ($attribute, $value, $parameters) {
			if (is_array($value) && count($value) > 0) {
				foreach ($value as $data) {
					return $data->isValid() ?
					$data->getMimetype() == 'application/vnd.ms-excel' : false;
				}
			} else {
				return $value->isValid() ?
				$value->getMimetype() == 'application/vnd.ms-excel' : false;
			}
		}, trans('validation.xls'));

		$this->app['validator']->extend('xlsx', function ($attribute, $value, $parameters) {
			if (is_array($value) && count($value) > 0) {
				foreach ($value as $data) {
					return $data->isValid() ?
					$data->getMimetype() == 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' : false;
				}
			} else {
				return $value->isValid() ?
				$value->getMimetype() == 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' : false;
			}
		}, trans('validation.xlsx'));

		$this->app['validator']->extend('xltx', function ($attribute, $value, $parameters) {
			if (is_array($value) && count($value) > 0) {
				foreach ($value as $data) {
					return $data->isValid() ?
					$data->getMimetype() == 'application/vnd.openxmlformats-officedocument.spreadsheetml.template' : false;
				}
			} else {
				return $value->isValid() ?
				$value->getMimetype() == 'application/vnd.openxmlformats-officedocument.spreadsheetml.template' : false;
			}
		}, trans('validation.xltx'));

		$this->app['validator']->extend('ppt', function ($attribute, $value, $parameters) {
			if (is_array($value) && count($value) > 0) {
				foreach ($value as $data) {
					return $data->isValid() ?
					$data->getMimetype() == 'application/vnd.ms-powerpoint' : false;
				}
			} else {
				return $value->isValid() ?
				$value->getMimetype() == 'application/vnd.ms-powerpoint' : false;
			}
		}, trans('validation.ppt'));

		$this->app['validator']->extend('ppam', function ($attribute, $value, $parameters) {
			if (is_array($value) && count($value) > 0) {
				foreach ($value as $data) {
					return $data->isValid() ?
					$data->getMimetype() == 'application/vnd.ms-powerpoint.addin.macroenabled.12' : false;
				}
			} else {
				return $value->isValid() ?
				$value->getMimetype() == 'application/vnd.ms-powerpoint.addin.macroenabled.12' : false;
			}
		}, trans('validation.ppam'));

		$this->app['validator']->extend('pptm', function ($attribute, $value, $parameters) {
			if (is_array($value) && count($value) > 0) {
				foreach ($value as $data) {
					return $data->isValid() ?
					$data->getMimetype() == 'application/vnd.ms-powerpoint.presentation.macroenabled.12' : false;
				}
			} else {
				return $value->isValid() ?
				$value->getMimetype() == 'application/vnd.ms-powerpoint.presentation.macroenabled.12' : false;
			}
		}, trans('validation.pptm'));

		$this->app['validator']->extend('sldm', function ($attribute, $value, $parameters) {
			if (is_array($value) && count($value) > 0) {
				foreach ($value as $data) {
					return $data->isValid() ?
					$data->getMimetype() == 'application/vnd.ms-powerpoint.slide.macroenabled.12' : false;
				}
			} else {
				return $value->isValid() ?
				$value->getMimetype() == 'application/vnd.ms-powerpoint.slide.macroenabled.12' : false;
			}
		}, trans('validation.sldm'));

		$this->app['validator']->extend('ppsm', function ($attribute, $value, $parameters) {
			if (is_array($value) && count($value) > 0) {
				foreach ($value as $data) {
					return $data->isValid() ?
					$data->getMimetype() == 'application/vnd.ms-powerpoint.slideshow.macroenabled.12' : false;
				}
			} else {
				return $value->isValid() ?
				$value->getMimetype() == 'application/vnd.ms-powerpoint.slideshow.macroenabled.12' : false;
			}
		}, trans('validation.ppsm'));

		$this->app['validator']->extend('potm', function ($attribute, $value, $parameters) {
			if (is_array($value) && count($value) > 0) {
				foreach ($value as $data) {
					return $data->isValid() ?
					$data->getMimetype() == 'application/vnd.ms-powerpoint.template.macroenabled.12' : false;
				}
			} else {
				return $value->isValid() ?
				$value->getMimetype() == 'application/vnd.ms-powerpoint.template.macroenabled.12' : false;
			}
		}, trans('validation.potm'));
		// Office Validation //
		// Audio Validation //
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

		$this->app['validator']->extend('adp', function ($attribute, $value, $parameters) {
			if (is_array($value) && count($value) > 0) {
				foreach ($value as $data) {
					return $data->isValid() ?
					$data->getMimetype() == 'audio/adpcm' : false;
				}
			} else {
				return $value->isValid() ?
				$value->getMimetype() == 'audio/adpcm' : false;
			}
		}, trans('validation.adp'));

		$this->app['validator']->extend('ogg', function ($attribute, $value, $parameters) {
			if (is_array($value) && count($value) > 0) {
				foreach ($value as $data) {
					return $data->isValid() ?
					$data->getMimetype() == 'audio/ogg' : false;
				}
			} else {
				return $value->isValid() ?
				$value->getMimetype() == 'audio/ogg' : false;
			}
		}, trans('validation.ogg'));

		$this->app['validator']->extend('wav', function ($attribute, $value, $parameters) {
			if (is_array($value) && count($value) > 0) {
				foreach ($value as $data) {
					return $data->isValid() ?
					$data->getMimetype() == 'audio/x-wav' : false;
				}
			} else {
				return $value->isValid() ?
				$value->getMimetype() == 'audio/x-wav' : false;
			}
		}, trans('validation.wav'));

		$this->app['validator']->extend('xm', function ($attribute, $value, $parameters) {
			if (is_array($value) && count($value) > 0) {
				foreach ($value as $data) {
					return $data->isValid() ?
					$data->getMimetype() == 'audio/xm' : false;
				}
			} else {
				return $value->isValid() ?
				$value->getMimetype() == 'audio/xm' : false;
			}
		}, trans('validation.xm'));

		$this->app['validator']->extend('audio', function ($attribute, $value, $parameters) {
			$audio_mimes = ['audio/xm', 'audio/x-wav', 'audio/ogg', 'audio/adpcm', 'audio/mpeg'];
			if (is_array($value) && count($value) > 0) {
				foreach ($value as $data) {
					return $data->isValid() ?
					in_array($data->getMimetype(), $audio_mimes) : false;
				}
			} else {
				return $value->isValid() ?
				in_array($value->getMimetype(), $audio_mimes) : false;
			}
		}, trans('validation.audio'));

		// Audio Validation //
		$this->app['validator']->extend('video', function ($attribute, $value, $parameters) {
			$video_mimes = ['video/mp4', 'video/3gpp', 'video/mpeg', 'video/quicktime', 'video/webm', 'video/x-matroska', 'video/x-ms-wmv', 'video/x-msvideo', 'video/video/x-ms-vob'];
			if (is_array($value) && count($value) > 0) {
				foreach ($value as $data) {
					return $data->isValid() ?
					in_array($data->getMimetype(), $video_mimes) : false;
				}
			} else {
				return $value->isValid() ?
				in_array($value->getMimetype(), $video_mimes) : false;
			}
		}, trans('validation.video'));

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
