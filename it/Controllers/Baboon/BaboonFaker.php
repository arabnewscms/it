<?php
namespace Phpanonymous\It\Controllers\Baboon;
use App\Http\Controllers\Controller;
use File;

class BaboonFaker extends Controller {
	public $local;
	public $folder_name;
	public $model_name;

	protected static $defaultProviders = ['Address', 'Barcode', 'Biased', 'Color', 'Company', 'DateTime', 'File', 'HtmlLorem', 'Image', 'Internet', 'Lorem', 'Medical', 'Miscellaneous', 'Payment', 'Person', 'PhoneNumber', 'Text', 'UserAgent', 'Uuid'];

	public function __construct() {
		$this->local = request('faker_local');
		$this->folder_name = strtolower(request('controller_name')) . '/faker';

		$this->model_name = '\\' . request('model_namespace') . '\\' . request('model_name');
	}

	public function runModel($code) {
		$model_explode = explode('::', $code);
		$data = $model_explode[0]::inRandomOrder()->first();
		return !empty($data) && !empty($data->id) ? $data->id : null;
	}

	public function create() {
		$model = $this->model_name;
		$faker = \Faker\Factory::create($this->local);
		$path = base_path('storage/app/public/' . $this->folder_name);
		if (!is_dir($path)) {
			File::makeDirectory($path, $mode = 0755, true, true);
		} else {
			File::cleanDirectory($path);
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
							if (preg_match('/' . $conv . '/', 'name|username|full_name|fullname|firstname|lastname|middlename|middle|first|last')) {
								$data['' . $conv . ''] = $faker->title . ' ' . $faker->name . ' ' . $faker->firstname . ' ' . $faker->lastname;
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
						}

					} elseif ($col_type == 'file') {

						if (!empty(request('image' . $i))) {
							$data['' . $conv . ''] = $this->folder_name . '/' . $faker->image($path, 640, 480, null, false);
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
						if (preg_match('/' . $conv . '/', 'total|quantity|price|count|item|pass|number|fat|vat|width|height|weight|code|mob|zipcode|zip|zip_code|key|serial|license')) {
							$data['' . $conv . ''] = $faker->randomNumber(2);
						} else {
							$data['' . $conv . ''] = $faker->bothify('##########');
						}
					}

				}

				$i++;
			}
			//return $data;
			if (!empty(request('auto_migrate'))) {
				$this->model_name::create($data);
			}
		}

	}

	/**
	 * @param string $provider
	 * @param string $locale
	 *
	 * @return string
	 */
	protected static function getProviderClassname($provider, $locale = '') {
		if ($providerClass = self::findProviderClassname($provider, $locale)) {
			return $providerClass;
		}
		// fallback to default locale
		if ($providerClass = self::findProviderClassname($provider, static::DEFAULT_LOCALE)) {
			return $providerClass;
		}
		// fallback to no locale
		if ($providerClass = self::findProviderClassname($provider)) {
			return $providerClass;
		}

		throw new \InvalidArgumentException(sprintf('Unable to find provider "%s" with locale "%s"', $provider, $locale));
	}

	/**
	 * @param string $provider
	 * @param string $locale
	 *
	 * @return string|null
	 */
	protected static function findProviderClassname($provider, $locale = '') {
		$providerClass = 'Faker\\' . ($locale ? sprintf('Provider\%s\%s', $locale, $provider) : sprintf('Provider\%s', $provider));

		if (class_exists($providerClass, true)) {
			return $providerClass;
		}

		return null;
	}

}