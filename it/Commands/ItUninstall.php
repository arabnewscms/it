<?php
namespace Phpanonymous\It\Commands;

use Illuminate\Console\Command;
use Storage;

class ItUninstall extends Command {
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'it:uninstall {plugin?}';
	protected $beer = "\360\237\215\272";
	protected $ops = "\xF0\x9F\x98\xB1";
	protected $like = "\xF0\x9F\x91\x8D";
	protected $dislike = "\xF0\x9F\x91\x8E";
	protected $love = "\xF0\x9F\x98\x8D";
	protected $heart = "\xE2\x9D\xA4";
	protected $plugins = ['merge', 'baboon', 'laravelcollective', 'yajra', 'intervention']; // 'payment', 'editors',
	protected $app = "'providers' => [";
	protected $providers = "'providers' => [";
	protected $aliases = "'aliases' => [";

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Uninstall Environment Plugins With (It)';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct() {
		parent::__construct();
	}

	public function uninstall_merge() {
		shell_exec('composer remove barryvdh/laravel-elfinder');
		$app = file_get_contents(base_path('config/app.php'));

		$final = str_replace('Barryvdh\Elfinder\ElfinderServiceProvider::class ,', "", $app);
		Storage::disk('it')->put('config/app.php', $final);
		$this->info('It' . $this->beer . '  Barryvdh\Elfinder\ElfinderServiceProvider::class , from app.php is removed');
		Storage::deleteDirectory('public/packages');
		$this->info('It' . $this->beer . ' the public/packages folder is removed');
		Storage::deleteDirectory('resources/views/vendor/elfinder');
		$this->info('It' . $this->beer . ' the resources/views/vendor/elfinder folder is removed');
		Storage::delete('config/elfinder.php');
		$this->info('It' . $this->beer . ' the config/elfinder.php file is removed');
		shell_exec('composer dump-autoload');
	}

	private function yajra() {

		shell_exec('composer remove yajra/laravel-datatables-oracle');

		shell_exec('composer remove yajra/laravel-datatables');

		shell_exec('composer dump-autoload');
		$this->info('It' . $this->beer . ' Yajra Package Is removed');

	}

	private function uninstall_laravelcollective() {
		shell_exec('composer remove laravelcollective/html');
		$app = file_get_contents(base_path('config/app.php'));
		$final = str_replace('		Collective\Html\HtmlServiceProvider::class ,', "", $app);
		$this->info('It' . $this->beer . ' the provider Collective\Html\HtmlServiceProvider::class auto removed from array providers');
		$final = str_replace("'Form' => Collective\Html\FormFacade::class ,", "", $final);
		$final = str_replace("'Form'   => Collective\Html\FormFacade::class ,", "", $final);
		$final = str_replace("'Form'         => Collective\Html\FormFacade::class ,", "", $final);
		$this->info('It' . $this->beer . ' the Alias \'Form\' => Collective\Html\FormFacade::class auto removed from array Aliases');
		$final = str_replace("'Html' => Collective\Html\HtmlFacade::class ,", "", $final);
		$final = str_replace("'Html'   => Collective\Html\HtmlFacade::class ,", "", $final);
		$final = str_replace("'Html'         => Collective\Html\HtmlFacade::class ,", "", $final);
		\Storage::disk('it')->put('config/app.php', $final);
		$this->info('It' . $this->beer . ' the Alias \'Html\' => Collective\Html\HtmlFacade::class, auto removed from array Aliases');
		shell_exec('composer dump-autoload');
	}

	private function intervention() {

		shell_exec('composer remove intervention/image');
		shell_exec('composer dump-autoload');
		$this->info('It' . $this->beer . ' intervention image Package Is removed');

	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle() {
		\Config::set('filesystems.default', 'it');

		//$this->option('plugin');
		$plugin = $this->argument('plugin');
		if (in_array($plugin, $this->plugins)) {
			if ($plugin == 'merge') {
				$this->info('It' . $this->beer . ' preparing file system merge to remove');
				$this->uninstall_merge();

			} else if ($plugin == 'laravelcollective') {
				$this->uninstall_laravelcollective();
			} else if ($plugin == 'yajra') {
				$this->yajra();
			} else if ($plugin == 'intervention') {
				$this->intervention();
			}
		} else {
			$plugg = [];

			$this->error('It' . $this->beer . ' Ops Choose Plugin From List ');
			$headers = [
				'Command (php artisan it:uninstall)',
				'Description',
			];
			foreach ($this->plugins as $plug) {
				if ($plug == 'merge') {
					$title = 'A Controller File Project to merge your files';
				} elseif ($plug == 'payment') {
					$title = 'Payment Getway trusted Packages Paypal,Cashu,payfort & much more ... ';
				} elseif ($plug == 'editors') {
					$title = 'Ckeditor,NiceEdit,jWYSIWYG,summernote,react-rte & much more ...  ';
				} elseif ($plug == 'baboon') {
					$title = 'Baboon CRUD System Created By Mahmoud Ibrahim v1';
				} elseif ($plug == 'yajra') {
					$title = 'Yajra DataTables by yajrabox.com';
				} elseif ($plug == 'intervention') {
					$title = 'intervention Image Package (image.intervention.io) ';
				}
				array_push($plugg, [$plug, $title]);
			}
			$this->table($headers, $plugg);
		}
	}
}
