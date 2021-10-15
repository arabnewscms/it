<?php
namespace Phpanonymous\It\Controllers\Baboon\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class BaboonPostmanApi extends Controller {

	public function postman() {
		$data = [];
		$data['info'] = [
			"_postman_id" => (string) Str::uuid(),
			"name" => env("APP_NAME"),
			"schema" => "https://schema.getpostman.com/json/collection/v2.1.0/collection.json",
		];
		$data['variable'] = [
			[
				'key' => 'local',
				'value' => url('api/v1'),
			], [
				'key' => 'token',
				'value' => '',
			],
		];
		$data['event'] = [
			[
				'listen' => 'prerequest',
				'script' => [
					'type' => 'text/javascript',
					'exec' => [""],
				],
			],
		];
		return $data;
	}

	public function aggregation() {
		$path = base_path('storage/collections');
		$info = [
			"_postman_id" => (string) Str::uuid(),
			"name" => env("APP_NAME"),
			"schema" => "https://schema.getpostman.com/json/collection/v2.1.0/collection.json",
		];

		$variable = [
			[
				'key' => 'local',
				'value' => url('api/v1'),
			], [
				'key' => 'token',
				'value' => '',
			],
		];
		$items = [];
		$event = [];
		if (is_dir($path)) {
			$get_all_json = \File::files($path);
			foreach ($get_all_json as $fjson) {
				$file = $fjson->getPath() . '/' . $fjson->getFilename();
				if (file_exists($file)) {
					$content = json_decode(file_get_contents($file));
					$event['event'] = $content->event;
					$items = array_merge($items, $content->item);
				}
			}

			$aggregation = json_encode([
				'info' => $info,
				'variable' => $variable,
				'item' => $items,
				'event' => $event['event'],
			], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
			\Storage::disk('it')->put('storage/collections/aggregation/' . env('APP_NAME') . '_postman_all_collections.json', $aggregation);

		}
	}

	public function generate_collection() {
		$module_name = str_replace('controller', '', strtolower(request('controller_name')));
		$postman = $this->postman();
		$items = [];

		if (checkIfExisitValue('api_url', 'api_index')) {
			// GET index
			$items[] = $this->Item("GET", "get all " . $module_name, $module_name);
		}

		if (checkIfExisitValue('api_url', 'api_show')) {
			// GET SHOW
			$items[] = $this->Item("GET", "show by id " . $module_name, $module_name . '/{PUT_YOUR_ID}');
		}

		if (checkIfExisitValue('api_url', 'api_create')) {
			// POST ADD New Record
			$items[] = $this->Item("POST", "Add Record " . $module_name, $module_name);
		}

		if (checkIfExisitValue('api_url', 'api_update')) {
			// PUT OR PATCH Record By ID
			$items[] = $this->Item("PUT", "Update Record By ID " . $module_name, $module_name . '/{PUT_YOUR_ID}');
		}

		if (checkIfExisitValue('api_url', 'api_delete')) {
			// DELETE Record BY ID
			$items[] = $this->Item("DELETE", "DELETE Record By ID " . $module_name, $module_name . '/{PUT_YOUR_ID}');
		}

		if (checkIfExisitValue('api_url', 'api_multi_delete')) {
			// MULTI_DELETE Record BY ID
			$items[] = $this->Item("MULTI_DELETE", "Multi Delete Record By IDs " . $module_name, $module_name . '/multi_delete');
		}
		$i = 0;
		$dz_name = '';
		foreach (request('col_type') as $col_type) {
			if ($col_type == 'dropzone') {
				$dz_name .= request('col_name_convention')[$i] . ',';
			}
			$i++;
		}
		if (!empty($dz_name)) {
			// Dropzone Upload
			$items[] = $this->Item("DZ_POST", " Multi Upload " . $module_name, $module_name . '/upload/multi', rtrim($dz_name, ','));

			// Dropzone Delete File
			$items[] = $this->Item("DZ_DELETE", " Delete Multi Upload " . $module_name, $module_name . '/delete/file');
		}

		$postman['item'] = [
			[
				"name" => $module_name,
				"item" => $items,
			],

		];

		$collection = json_encode($postman, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
		\Storage::disk('it')->put('storage/collections/' . env('APP_NAME') . '_' . $module_name . '_postman_collection.json', $collection);
	}

	public function Item($method_type, $module_label, $segments, $param = null) {
		// Columns And Parameters
		$body_formdata = [];

		// Master Param Lang
		$body_formdata[] = [
			"key" => "lang",
			"description" => "For Return Language Message default Arabic",
			"type" => "text",
			"value" => "ar",
		];

		$path = [];
		foreach (explode('/', $segments) as $segment) {
			$path[] = $segment;
		}

		if (in_array($method_type, ['POST', 'PUT', 'PATCH'])) {
			$i = 0;
			$cols = '';
			foreach (request('col_name_convention') as $conv) {
				if (preg_match('/(\d+)\+(\d+)|,/i', $conv)) {
					$pre_name = explode('|', $conv);
					$values = '';
					if (count(explode('/', $pre_name[1])) > 0) {
						foreach (explode('/', $pre_name[1]) as $enum) {
							$drop_val = explode(',', $enum);
							$values .= $drop_val[0] . ',';
						}
						$values = rtrim($values, ',');
					} else {
						$values = 'releation with model ' . $pre_name[1];
					}

					if (checkIfExisitValue('api_show_column', $pre_name[0])) {
						$body_formdata[] = [
							"key" => $pre_name[0],
							"value" => count(explode(',', $values)) > 0 ? explode(',', $values)[0] : 1,
							"type" => 'text',
							"description" => 'Dropdown data (' . $values . ')',
						];
					}

				} elseif (preg_match('/#/i', $conv)) {
					$pre_conv = explode('#', $conv);
					if (!preg_match('/' . $pre_conv[0] . '/i', $cols)) {
						$name = explode('#', $name);
						$cols .= $name[0] . "\n";

						if (checkIfExisitValue('api_show_column', $name[0])) {
							$body_formdata[] = [
								"key" => $name[0],
								"value" => null,
								"type" => 'text',
								"description" => 'checkbox or radio data (' . $pre_name[1] . ' or other-data)',
							];
						}
					}
				} elseif (request('col_type')[$i] == 'file' && checkIfExisitValue('api_show_column', $conv)) {

					$body_formdata[] = [
						"key" => $conv,
						"value" => null,
						"type" => 'file',
						"description" => 'Upload File Input',
					];

				} elseif (request('col_type')[$i] == 'email' && checkIfExisitValue('api_show_column', $conv)) {

					$body_formdata[] = [
						"key" => $conv,
						"value" => 'email@example.com',
						"type" => 'text',
						"description" => 'email Input',
					];

				} elseif (request('col_type')[$i] != 'dropzone' && checkIfExisitValue('api_show_column', $conv)) {
					$body_formdata[] = [
						"key" => $conv,
						"value" => 'some string',
						"type" => 'text',
						"description" => 'normal input text',
					];
				}

				$i++;
			}
			// End foreach
		} elseif ($method_type == 'MULTI_DELETE') {
			$method_type = 'POST';
			$body_formdata[] = [
				"key" => 'selected_data[]',
				"value" => '1',
				"type" => 'text',
				"description" => 'Record ID Integer',
			];

			$body_formdata[] = [
				"key" => 'selected_data[]',
				"value" => '2',
				"type" => 'text',
				"description" => 'Record ID Integer',
			];
		} elseif ($method_type == 'DZ_POST') {
			$method_type = 'POST';
			foreach (explode(',', $param) as $paramname) {
				$body_formdata[] = [
					"key" => $paramname,
					"value" => null,
					"type" => 'file',
					"description" => 'Choose File to Upload',
				];
			}
		} elseif ($method_type == 'DZ_DELETE') {
			$method_type = 'POST';

			$body_formdata[] = [
				"key" => 'type_file',
				"value" => $path[0],
				"type" => 'file',
				"description" => 'type file string by type from files table',
			];

			$body_formdata[] = [
				"key" => 'type_id',
				"value" => 'write file id',
				"type" => 'text',
				"description" => 'Write File ID to delete file by type id from files table',
			];
		}
		// End if

		// GET , POST , PUT , PATCH , DELETE , MULTI_DELETE , DZ_POST , DZ_DELETE
		return [
			"name" => $module_label,
			"protocolProfileBehavior" => [
				"disableBodyPruning" => true,
			],
			"request" => [
				"auth" => [
					"type" => "bearer",
					"bearer" => [
						[
							"key" => "token",
							"value" => "{{token}}",
							"type" => "string",
						],
					],
				],
				"method" => $method_type,
				"header" => [
					[
						"key" => "Accept",
						"value" => "application/json",
						"type" => "text",
					],
				],

				"body" => [
					"mode" => "formdata",
					"formdata" => $body_formdata,
				],
				"url" => [
					"raw" => "{{local}}/" . $segments,
					//"protocol" => "https",
					"host" => [
						"{{local}}",
					],
					"path" => $path,

				],
				"description" => "test description",
			],
			"response" => [],

		];
	}

}
