<?php
namespace Phpanonymous\It\Controllers\Baboon;
use App\Http\Controllers\Controller;
use Faker\Factory as Faker;
use Faker\Provider\DateTime;
use Faker\Provider\Image;
use Faker\Provider\Uuid;

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
		$data = $model_explode[0]::inRandomOrder()->first();
		return !empty($data) && !empty($data->id) ? $data->id : null;
	}

	public function create() {
		$model = $this->model_name;
		$faker = Faker::create($this->local);
		$cols = [];
		for ($x = 0; $x < 100; $x++) {
			$data = [];
			$i = 0;
			foreach (request('col_type') as $col_type) {

				$conv = request('col_name_convention')[$i];

				if ($col_type == 'select' && preg_match('/(\d+)\+(\d+)|,/i', $conv)) {
					$pre_conv = explode('|', $conv);
					// get dynamic data
					if (!empty(request('forginkeyto' . $i)) || preg_match('/App/i', $pre_conv[1])) {
						$val = $this->runModel($pre_conv[1]);
					} else {
						$enum_val = explode('/', $pre_conv[1]);
						$enum_val = explode(',', $enum_val[0]);
						$val = $enum_val[0];
					}
					$data['' . $pre_conv[0] . ''] = $val;

				} elseif ($col_type == 'checkbox' || $col_type == 'radio') {
					if (preg_match('/#/i', $conv)) {
						$pre_conv = explode('#', $conv);
						if (!in_array($pre_conv[0], $data)) {
							$data['' . $pre_conv[0] . ''] = $pre_conv[1];
						}
					}
				} elseif ($col_type != 'dropzone') {
					if ($col_type == 'email') {
						$data['' . $conv . ''] = $faker->safeEmail();
					} elseif ($col_type == 'text') {
						if (!empty(request('integer' . $i)) || !empty(request('numeric' . $i))) {
							$data['' . $conv . ''] = $faker->randomNumber(10);
						} elseif (!empty(request('string' . $i)) || !empty(request('alpha' . $i))) {
							$data['' . $conv . ''] = $faker->text(50);
						} elseif (!empty(request('alpha-dash' . $i))) {
							$data['' . $conv . ''] = $faker->bothify('?###??##');
						} elseif (!empty(request('alpha_num' . $i))) {
							$data['' . $conv . ''] = $faker->bothify('?###??##');
						} elseif (!empty(request('ipv6' . $i))) {
							$data['' . $conv . ''] = $faker->ipv6();
						} elseif (!empty(request('ipv4' . $i))) {
							$data['' . $conv . ''] = $faker->ipv4();
						} elseif (!empty(request('ip' . $i))) {
							$data['' . $conv . ''] = $faker->localIpv4();
						} elseif (!empty(request('uuid' . $i))) {
							$data['' . $conv . ''] = $faker->uuid();
						} elseif (!empty(request('timezone' . $i))) {
							$data['' . $conv . ''] = $faker->timezone();
						} elseif (!empty(request('url' . $i))) {
							$data['' . $conv . ''] = bcrypt(123456);
						} elseif (!empty(request('password' . $i))) {
							$data['' . $conv . ''] = $faker->url();
						}

					} elseif ($col_type == 'file') {
						$folder_name = strtolower(request('controller_name')) . '/faker';
						$path = base_path('storage/app/public/' . $folder_name);

						if (!is_dir($path)) {
							mkdir($path);
						}

						if (!empty(request('image' . $i))) {
							$data['' . $conv . ''] = 'storage/' . $folder_name . '/' . $faker->image($path, 640, 480, null, false);
						}

					} elseif ($col_type == 'date_time') {
						$data['' . $conv . ''] = $faker->dateTime('now');
					} elseif ($col_type == 'timestamp') {
						$data['' . $conv . ''] = $faker->dateTime('now');
					} elseif ($col_type == 'date') {
						$data['' . $conv . ''] = $faker->date();
					} elseif ($col_type == 'time') {
						$data['' . $conv . ''] = date('H:i:s');
					} elseif ($col_type == 'color') {
						$data['' . $conv . ''] = $faker->hexColor();
					} elseif ($col_type == 'password') {
						$data['' . $conv . ''] = bcrypt(123456);
					} elseif ($col_type == 'textarea') {
						$data['' . $conv . ''] = $faker->words(200, true);
					} elseif ($col_type == 'textarea_ckeditor') {
						$data['' . $conv . ''] = $faker->randomHtml();
					}

				}

				$i++;
			}
			return $data;
			//$this->model_name::create($data);
		}

	}
}
