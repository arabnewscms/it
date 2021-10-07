<?php
namespace Phpanonymous\It\Controllers\Baboon;
use App\Http\Controllers\Controller;
use Faker\Factory;

class BaboonFaker extends Controller {
	public $local;
	public $model_name;

	public function __construct($local) {
		$this->local = $local;
		$this->model_name = '\\' . request('model_namespace') . '\\' . request('model_name');
	}
/*

{type: "text", name: "title"}
1: {type: "email", name: "email"}
2: {type: "file", name: "photo"}
3: {type: "select", name: "status|active,Active/pending,Pending/refused,Refused"}
4: {type: "dropzone", name: "dz"}
5: {type: "dropzone", name: "dz2"}
6: {type: "select", name: "user_id|App\Models\User::pluck('name','id')"}
7: {type: "number", name: "num_test"}
8: {type: "email", name: "email_test"}
9: {type: "url", name: "test_url"}
10: {type: "textarea", name: "test_textarea"}
11: {type: "textarea_ckeditor", name: "test_ck"}
12: {type: "password", name: "test_pass"}
13: {type: "checkbox", name: "test_checkbox#male"}
14: {type: "radio", name: "test_radio#val"}
15: {type: "date", name: "test_date"}
16: {type: "date_time", name: "test_datetime"}
17: {type: "time", name: "test_time"}
18: {type: "timestamp", name: "test_timestamp"}
19: {type: "color", name: "test_color"}
 */
	public function runModel($code) {
		$model_explode = explode('::', $code);
		$data = $model_explode[0]::first();
		return !empty($data) && !empty($data->id) ? $data->id : null;
	}

	public function create() {
		$model = $this->model_name;
		$faker = Factory::create(request('faker_local'));

		$cols = [];
		for ($x = 0; $x < 100; $x++) {
			$data = [];
			$i = 0;
			foreach (request('col_type') as $col_type) {

				$conv = request('col_name_convention')[$i];

				if (preg_match('/(\d+)\+(\d+)|,/i', $conv)) {
					$pre_conv = explode('|', $conv);
					// get dynamic data
					if (!empty(request('forginkeyto' . $i)) || preg_match('/App/i', $pre_conv[1])) {
						$val = $this->runModel($pre_conv[1]);
						$data['' . $pre_conv[0] . ''] = $val;

					} else {
						$enum_val = explode('/', $pre_conv[1]);
						$enum_val = explode(',', $enum_val[0]);
						$val = $enum_val[0];
					}
					$data['' . $pre_conv[0] . ''] = $val;

				} elseif (preg_match('/#/i', $conv)) {
					// $pre_conv = explode('#', $conv);
					// if (!preg_match('/' . $pre_conv[0] . '/', $SetAttributeNames)) {

					// 	$SetAttributeNames .= '             \'' . $pre_conv[0] . '\'=>trans(\'{lang}.' . $pre_conv[0] . '\'),' . "\n";
					// }
				} elseif ($col_type != 'dropzone') {
					// $SetAttributeNames .= '             \'' . $conv . '\'=>trans(\'{lang}.' . $conv . '\'),' . "\n";
				}

				//$cols[] = ['type' => $col_type, 'name' => request('col_name_convention')[$i]];
				$i++;
			}
			return $data;
			//$this->model_name::create($data);
		}

	}
}
