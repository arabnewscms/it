<?php
namespace Phpanonymous\It\Controllers\Baboon;
use App\Http\Controllers\Controller;

class Statistics extends Controller {
	protected $domain = 'https://baboonstatistics.tagatsoft.com';

	public function url_exists() {
		return curl_init($this->domain) !== false;
	}

	public function init() {
		if ($this->url_exists()) {
			$elements = $this->elements();
			$elements = array_merge($elements, $this->public_elements());
			$elements = array_merge($elements, $this->relation_type());
			$elements = array_merge($elements, $this->schema());
			$elements = array_merge($elements, $this->col_width());
			$this->sendStatistics($elements);
		}
	}

	private function public_elements() {
		return [
			'project_id' => env('APP_KEY'),
			'os' => $this->os(),
			'browser' => $this->browser(),
			'soft_delete' => !empty(request('enable_soft_delete')) ? 1 : 0,
			'has_admin' => !empty(request('has_user_id')) ? 1 : 0,
			'views' => !empty(request('make_views')) ? (1 * 5) : 0, // index create edit show DT.buttons
			'datatable' => !empty(request('make_datatable')) ? 1 : 0,
			'controller' => !empty(request('make_controller')) ? 1 : 0,
			'migration' => !empty(request('make_migration')) ? 1 : 0,
			'model' => !empty(request('make_model')) ? 1 : 0,
			'auto_migrate' => !empty(request('auto_migrate')) ? 1 : 0,
			'laravelcollective' => !empty(request('use_collective')) ? 1 : 0,
			'linkatmodel' => !empty(request('linkatmodel')) ? count(request('linkatmodel')) : 0,
		];
	}

	private function elements() {
		$number = 0;
		$email = 0;
		$url = 0;
		$text = 0;
		$textarea = 0;
		$textarea_ckeditor = 0;
		$checkbox = 0;
		$select = 0;
		$file = 0;
		$password = 0;
		$radio = 0;
		$date = 0;
		$date_time = 0;
		$time = 0;
		$timestamp = 0;
		$color = 0;
		$dropzone = 0;
		$file = 0;
		$link_ajax = 0;
		$i = 0;
		foreach (request('col_type') as $col) {
			if ($col == 'number') {
				$number++;
			} elseif ($col == 'email') {
				$email++;
			} elseif ($col == 'url') {
				$url++;
			} elseif ($col == 'text') {
				$text++;
			} elseif ($col == 'textarea') {
				$textarea++;
			} elseif ($col == 'textarea_ckeditor') {
				$textarea_ckeditor++;
			} elseif ($col == 'select') {
				$select++;
			} elseif ($col == 'file') {
				$file++;
			} elseif ($col == 'password') {
				$password++;
			} elseif ($col == 'checkbox') {
				$checkbox++;
			} elseif ($col == 'radio') {
				$radio++;
			} elseif ($col == 'date') {
				$date++;
			} elseif ($col == 'date_time') {
				$date_time++;
			} elseif ($col == 'time') {
				$time++;
			} elseif ($col == 'timestamp') {
				$timestamp++;
			} elseif ($col == 'color') {
				$color++;
			} elseif ($col == 'dropzone') {
				$dropzone++;
			} elseif (!empty(request('link_ajax' . $i))) {
				$link_ajax++;
			}

			$i++;
		}
		return [
			'number' => $number,
			'email' => $email,
			'url' => $url,
			'text' => $text,
			'textarea' => $textarea,
			'textarea_ckeditor' => $textarea_ckeditor,
			'select' => $select,
			'file' => $file,
			'dropzone' => $dropzone,
			'password' => $password,
			'radio' => $radio,
			'date' => $date,
			'date_time' => $date_time,
			'time' => $time,
			'timestamp' => $timestamp,
			'color' => $color,
			'link_ajax' => $link_ajax,
			'checkbox' => $checkbox,
		];
	}

	private function relation_type() {
		$hasOne = 0;
		$hasMany = 0;
		$belongsToMany = 0;
		$hasManyThrough = 0;
		$belongsTo = 0;
		$morphMap = 0;
		$morphMany = 0;
		if (!empty(request('relation_type'))) {
			foreach (request('relation_type') as $relation_type) {
				if ($relation_type == 'hasOne') {
					$hasOne++;
				} elseif ($relation_type == 'hasMany') {
					$hasMany++;
				} elseif ($relation_type == 'belongsToMany') {
					$belongsToMany++;
				} elseif ($relation_type == 'hasManyThrough') {
					$hasManyThrough++;
				} elseif ($relation_type == 'belongsTo') {
					$belongsTo++;
				} elseif ($relation_type == 'morphMap') {
					$morphMap++;
				} elseif ($relation_type == 'morphMany') {
					$morphMany++;
				}
			}
		}
		return [
			'hasone' => $hasOne,
			'hasmany' => $hasMany,
			'belongstomany' => $belongsToMany,
			'hasmanythrough' => $hasManyThrough,
			'belongsto' => $belongsTo,
			'morphmap' => $morphMap,
			'morphmany' => $morphMany,
		];
	}

	private function schema() {
		$forginkeyto = 0;
		$func_nullable = 0;
		$onDelete = 0;
		$onUpdate = 0;
		$col_name_null = 0;
		$col_name_has = 0;
		$i = 0;
		foreach (request('col_type') as $schema) {
			if (!empty(request('forginkeyto' . $i))) {
				$forginkeyto++;
			}

			if (!empty(request('func_nullable' . $i))) {
				$func_nullable++;
			}

			if (!empty(request('onDelete' . $i))) {
				$onDelete++;
			}
			if (!empty(request('onUpdate' . $i))) {
				$onUpdate++;
			}
			if (!empty(request('col_name_null' . $i)) && request('col_name_null' . $i) == 'null') {
				$col_name_null++;
			}
			if (!empty(request('col_name_null' . $i)) && request('col_name_null' . $i) == 'has') {
				$col_name_has++;
			}
			$i++;
		}
		return [
			'forginkeyto' => $forginkeyto,
			'func_nullable' => $func_nullable,
			'on_delete' => $onDelete,
			'on_update' => $onUpdate,
			'col_name_has' => $col_name_has,
			'col_name_null' => $col_name_null,
		];
	}

	private function col_width() {
		return [
			'col_width_lg_count' => count(request('col_width_lg')),
			'col_width_md_count' => count(request('col_width_md')),
			'col_width_sm_count' => count(request('col_width_sm')),
			'col_width_xs_count' => count(request('col_width_xs')),
		];
	}

	private function sendStatistics($data) {
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => $this->domain . '/api/v1/push/statistics',
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_SSL_VERIFYHOST => 0,
			CURLOPT_SSL_VERIFYPEER => 0,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'POST',
			CURLOPT_POSTFIELDS => $data,
			CURLOPT_HTTPHEADER => array(
				'Accept: application/json',
			),
		));

		$response = curl_exec($curl);

		curl_close($curl);
		//echo $response;
	}
	private function os() {
		return PHP_OS_FAMILY;
	}

	private function browser() {
		$user_agent = $_SERVER['HTTP_USER_AGENT'];
		$browser = "Unknown Browser";
		$browser_array = array(
			'/msie/i' => 'internet explorer',
			'/firefox/i' => 'firefox',
			'/safari/i' => 'safari',
			'/chrome/i' => 'chrome',
			'/edge/i' => 'edge',
			'/opera/i' => 'opera',
			'/netscape/i' => 'netscape',
			'/maxthon/i' => 'maxthon',
			'/konqueror/i' => 'konqueror',
			'/mobile/i' => 'handheld Browser',
		);

		foreach ($browser_array as $regex => $value) {
			if (preg_match($regex, $user_agent)) {
				$browser = $value;
			}
		}
		return $browser;
	}

}