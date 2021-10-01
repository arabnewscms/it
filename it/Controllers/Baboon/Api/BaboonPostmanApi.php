<?php
namespace Phpanonymous\It\Controllers\Baboon\Api;

use App\Http\Controllers\Controller;

class BaboonPostmanApi extends Controller {

	public function postman() {
		$data = [];
		$data['info'] = [
			"_postman_id" => "80ddb3b6-b2ae-4a93-96c0-ca4ec0d9f74c-" . env('APP_NAME'),
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
	public function generate_collection($module_name) {
		$postman = $this->postman();
		$items = [];
		$module_data = '';

		// GET index
		$items[] = $this->Item("GET", $module_data, "get all " . $module_name, $module_name);

		// GET SHOW
		$items[] = $this->Item("GET", $module_data, "show by id " . $module_name, $module_name . '/{PUT_YOUR_ID}');

		// POST ADD New Record
		$items[] = $this->Item("POST", $module_data, "Add Record " . $module_name, $module_name);

		// PUT OR PATCH Record By ID
		$items[] = $this->Item("PUT", $module_data, "Update Record By ID " . $module_name, $module_name . '/{PUT_YOUR_ID}');

		// DELETE Record BY ID
		$items[] = $this->Item("DELETE", $module_data, "DELETE Record By ID " . $module_name, $module_name . '/{PUT_YOUR_ID}');

		// MULTI_DELETE Record BY ID
		$items[] = $this->Item("MULTI_DELETE", $module_data, "Multi Delete Record By IDs " . $module_name, $module_name . '/multi_delete');
		$i = 0;
		foreach (request('col_type') as $col_type) {
			if ($col_type == 'dropzone') {
				$dz_name = request('col_name_convention')[$i];
				// Dropzone Upload
				$items[] = $this->Item("DZ_POST", $module_data, " Multi Upload " . $module_name, $module_name . '/upload/multi', $dz_name);

				// Dropzone Delete File
				$items[] = $this->Item("DZ_DELETE", $module_data, " Delete Multi Upload " . $module_name, $module_name . '/delete/file');
			}
			$i++;
		}

		$postman['item'] = [
			[
				"name" => $module_name,
				"item" => $items,
			],

		];

		return json_encode($postman, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
	}

	public function Item($method_type, $module_data, $module_label, $segments, $param = null) {
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

					$key = $pre_name[0];
					$value = count(explode(',', $values)) > 0 ? explode(',', $values)[0] : 1;
					$type = 'text';
					$description = 'Dropdown data (' . $values . ')';
				} elseif (preg_match('/#/i', $conv)) {
					$pre_conv = explode('#', $conv);
					if (!preg_match('/' . $pre_conv[0] . '/i', $cols)) {
						$name = explode('#', $name);
						$cols .= $name[0] . "\n";

						$key = $name[0];
						$value = '';
						$type = 'text';
						$description = 'checkbox or radio data (' . $pre_name[1] . ' or other-data)';

					}
				} elseif (request('col_type')[$i] == 'file') {
					$key = $conv;
					$value = null;
					$type = 'file';
					$description = 'Upload File Input';
				} elseif (request('col_type')[$i] == 'email') {
					$key = $conv;
					$value = 'email@example.com';
					$type = 'file';
					$description = 'email Input';
				} elseif (request('col_type')[$i] != 'dropzone') {
					$key = $conv;
					$value = 'some string';
					$type = 'text';
					$description = 'normal input text';
				}

				$body_formdata[] = [
					"key" => $key,
					"value" => $value,
					"type" => $type,
					"description" => $description,
				];

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
			$body_formdata[] = [
				"key" => $param,
				"value" => null,
				"type" => 'file',
				"description" => 'Choose File to Upload',
			];
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
