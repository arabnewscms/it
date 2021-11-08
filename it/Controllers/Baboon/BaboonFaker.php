<?php
namespace Phpanonymous\It\Controllers\Baboon;
use App\Http\Controllers\Controller;
use File;
use Illuminate\Http\UploadedFile;

class BaboonFaker extends Controller {
	public $local;
	public $folder_name;
	public $model_name;
	public $path;

	public function __construct() {
		$this->local = request('faker_local');
		$this->folder_name = strtolower(request('controller_name')) . '/faker';
		$this->path = base_path('storage/app/public/' . $this->folder_name);

		$this->model_name = '\\' . request('model_namespace') . '\\' . request('model_name');
	}

	public function runModel($code) {
		$model_explode = explode('::', $code);
		$data = $model_explode[0]::inRandomOrder()->first();
		return !empty($data) && !empty($data->id) ? $data->id : null;
	}

	public function create() {

		$faker = \Faker\Factory::create($this->local);

		if (!is_dir($this->path)) {
			File::makeDirectory($this->path, $mode = 0755, true, true);
		} else {
			File::cleanDirectory($this->path);
		}

		$cols = [];
		for ($x = 0; $x < 5; $x++) {
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
							$data['' . $conv . ''] = $faker->e164PhoneNumber();
						} elseif (!empty(request('string' . $i)) || !empty(request('alpha' . $i))) {
							if (preg_match('/' . $conv . '/', 'name|username|full_name|fullname|firstname|lastname|middlename|middle|first|last|title')) {
								//$data['' . $conv . ''] = $faker->title . ' ' . $faker->name . ' ' . $faker->firstname . ' ' . $faker->lastname;
								$data['' . $conv . ''] = $faker->title . ' ' . $faker->name;
							} elseif (preg_match('/' . $conv . '/', 'company|company_name|department|category|cat|org|organize|organization')) {
								$data['' . $conv . ''] = $faker->company();
							} elseif (preg_match('/' . $conv . '/', 'job|job_title|work|goods|good')) {
								$data['' . $conv . ''] = $faker->jobTitle();
							} else {
								$data['' . $conv . ''] = $faker->realText(25);
							}
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
						} elseif (!empty(request('json' . $i))) {
							$data['' . $conv . ''] = '{title:"' . $faker->name . '"}';
						} elseif (!empty(request('boolean' . $i))) {
							$data['' . $conv . ''] = rand(0, 1);
						} else {
							$data['' . $conv . ''] = $faker->firstname . ' ' . $faker->lastname;
						}

					} elseif ($col_type == 'file') {

						if (!empty(request('image' . $i))) {
							$data['' . $conv . ''] = $this->folder_name . '/' . $faker->image($this->path, 640, 480, null, false);
						} elseif (!empty(request('pdf' . $i))) {
							$data['' . $conv . ''] = $this->fakeFile('pdf');
						} elseif (!empty(request('office' . $i))) {
							$data['' . $conv . ''] = $this->fakeFile('docx');
						} elseif (!empty(request('docx' . $i))) {
							$data['' . $conv . ''] = $this->fakeFile('docx');
						} elseif (!empty(request('xlsx' . $i))) {
							$data['' . $conv . ''] = $this->fakeFile('xlsx');
						} elseif (!empty(request('xls' . $i))) {
							$data['' . $conv . ''] = $this->fakeFile('xls');
						} elseif (!empty(request('xltx' . $i))) {
							$data['' . $conv . ''] = $this->fakeFile('xltx');
						} elseif (!empty(request('ppt' . $i))) {
							$data['' . $conv . ''] = $this->fakeFile('ppt');
						} elseif (!empty(request('ppam' . $i))) {
							$data['' . $conv . ''] = $this->fakeFile('ppam');
						} elseif (!empty(request('pptm' . $i))) {
							$data['' . $conv . ''] = $this->fakeFile('pptm');
						} elseif (!empty(request('ppsm' . $i))) {
							$data['' . $conv . ''] = $this->fakeFile('ppsm');
						} elseif (!empty(request('potm' . $i))) {
							$data['' . $conv . ''] = $this->fakeFile('potm');
						} elseif (!empty(request('sldm' . $i))) {
							$data['' . $conv . ''] = $this->fakeFile('sldm');
						} elseif (!empty(request('audio' . $i)) || !empty(request('mp3' . $i))) {
							$data['' . $conv . ''] = $this->fakeFile('mp3');
						} elseif (!empty(request('wav' . $i))) {
							$data['' . $conv . ''] = $this->fakeFile('wav');
						} elseif (!empty(request('xm' . $i))) {
							$data['' . $conv . ''] = $this->fakeFile('xm');
						} elseif (!empty(request('ogg' . $i))) {
							$data['' . $conv . ''] = $this->fakeFile('ogg');
						} elseif (!empty(request('video' . $i)) || !empty(request('mp4' . $i))) {
							$data['' . $conv . ''] = $this->fakeFile('mp4');
						} elseif (!empty(request('mp4' . $i))) {
							$data['' . $conv . ''] = $this->fakeFile('mp4');
						} elseif (!empty(request('mpeg' . $i))) {
							$data['' . $conv . ''] = $this->fakeFile('mpeg');
						} elseif (!empty(request('mov' . $i))) {
							$data['' . $conv . ''] = $this->fakeFile('mov');
						} elseif (!empty(request('3gp' . $i))) {
							$data['' . $conv . ''] = $this->fakeFile('3gp');
						} elseif (!empty(request('webm' . $i))) {
							$data['' . $conv . ''] = $this->fakeFile('webm');
						} elseif (!empty(request('mkv' . $i))) {
							$data['' . $conv . ''] = $this->fakeFile('mkv');
						} elseif (!empty(request('wmv' . $i))) {
							$data['' . $conv . ''] = $this->fakeFile('wmv');
						} elseif (!empty(request('avi' . $i))) {
							$data['' . $conv . ''] = $this->fakeFile('avi');
						} elseif (!empty(request('vob' . $i))) {
							$data['' . $conv . ''] = $this->fakeFile('vob');
						} else {
							$data['' . $conv . ''] = $this->folder_name . '/' . $faker->image($this->path, 640, 480, null, false);
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
						$data['' . $conv . ''] = $faker->realText(rand(100, 400));
					} elseif ($col_type == 'textarea_ckeditor') {
						$data['' . $conv . ''] = $faker->realText(rand(100, 700));
					} elseif ($col_type == 'number') {
						if (preg_match('/' . $conv . '/', 'total|quantity|price|count|item|pass|number|fat|vat|width|height|weight|code|mob|zipcode|zip|zip_code|key|serial|license|postalcode|postal|code|mob|mobcode|keys')) {
							$data['' . $conv . ''] = $faker->randomNumber(2);
						} else {
							$data['' . $conv . ''] = $faker->bothify('##########');
						}
					} else {
						$data['' . $conv . ''] = $faker->bothify('##########');
					}

				}

				$i++;
			}
			//return $data;
			if (!empty(request('auto_migrate'))) {
				if (!empty(request('has_user_id'))) {
					$data['admin_id'] = 1;
				}
				$this->model_name::create($data);
			}
		}

	}

	// faker file
	public function fakeFile($ext) {
		$file_name = $ext . '_' . (time() * rand(0000, 99999)) . '.' . $ext;
		$file = UploadedFile::fake()->create($file_name)->store('storage/app/public/' . $this->folder_name);
		return str_replace('storage/app/public/', '', $file);
	}

}
