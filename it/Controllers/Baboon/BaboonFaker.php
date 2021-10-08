<?php
namespace Phpanonymous\It\Controllers\Baboon;
use App\Http\Controllers\Controller;
use Faker\Factory as Faker;
use Faker\Provider\DateTime;
use Faker\Provider\Image;
use Faker\Provider\Uuid;
use File;

class BaboonFaker extends Controller {
	public $local;
	public $folder_name;
	public $model_name;

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
		$faker = Faker::create($this->local);
		$path = base_path('storage/app/public/' . $this->folder_name);
		File::cleanDirectory($path);
		//Storage::deleteDirectory($folder_name);
		if (!is_dir($path)) {
			File::makeDirectory($path, $mode = 0755, true, true);
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
						$data['' . $conv . ''] = $faker->words(200, true);
					} elseif ($col_type == 'textarea_ckeditor') {
						$data['' . $conv . ''] = $this->loremHtml();
					} elseif ($col_type == 'number') {
						$data['' . $conv . ''] = $faker->e164PhoneNumber();
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

	public function loremHtml() {
		return "<H1>QUID ENIM DE AMICITIA STATUERIS UTILITATIS CAUSA EXPETENDA VIDES.</H1>

<P>LOREM IPSUM DOLOR SIT AMET, CONSECTETUR ADIPISCING ELIT. EODEM MODO IS ENIM TIBI NEMO DABIT, QUOD, EXPETENDUM SIT, ID ESSE LAUDABILE. ATQUE HIS DE REBUS ET SPLENDIDA EST EORUM ET ILLUSTRIS ORATIO. ILLE ENIM OCCURRENTIA NESCIO QUAE COMMINISCEBATUR; ET QUIDEM ILLUD IPSUM NON NIMIUM PROBO ET TANTUM PATIOR, PHILOSOPHUM LOQUI DE CUPIDITATIBUS FINIENDIS. DUO REGES: CONSTRUCTIO INTERRETE. </P>

<UL>
	<LI>FATEBUNTUR STOICI HAEC OMNIA DICTA ESSE PRAECLARE, NEQUE EAM CAUSAM ZENONI DESCISCENDI FUISSE.</LI>
	<LI>VERUM HOC LOCO SUMO VERBIS HIS EANDEM CERTE VIM VOLUPTATIS EPICURUM NOSSE QUAM CETEROS.</LI>
	<LI>NONDUM AUTEM EXPLANATUM SATIS, ERAT, QUID MAXIME NATURA VELLET.</LI>
	<LI>DOLERE MALUM EST: IN CRUCEM QUI AGITUR, BEATUS ESSE NON POTEST.</LI>
	<LI>NON EST IGITUR SUMMUM MALUM DOLOR.</LI>
	<LI>QUI ENIM EXISTIMABIT POSSE SE MISERUM ESSE BEATUS NON ERIT.</LI>
</UL>


<BLOCKQUOTE CITE='HTTP://LORIPSUM.NET'>
	IN OMNI ENIM ANIMANTE EST SUMMUM ALIQUID ATQUE OPTIMUM, UT IN EQUIS, IN CANIBUS, QUIBUS TAMEN ET DOLORE VACARE OPUS EST ET VALERE;
</BLOCKQUOTE>


<OL>
	<LI>AB HOC AUTEM QUAEDAM NON MELIUS QUAM VETERES, QUAEDAM OMNINO RELICTA.</LI>
	<LI>NAM SI QUAE SUNT ALIAE, FALSUM EST OMNIS ANIMI VOLUPTATES ESSE E CORPORIS SOCIETATE.</LI>
	<LI>TANTUM DICO, MAGIS FUISSE VESTRUM AGERE EPICURI DIEM NATALEM, QUAM ILLIUS TESTAMENTO CAVERE UT AGERETUR.</LI>
	<LI>AT IAM DECIMUM ANNUM IN SPELUNCA IACET.</LI>
</OL>



";
	}
}
