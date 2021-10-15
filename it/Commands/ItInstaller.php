<?php

namespace Phpanonymous\It\Commands;

use Illuminate\Console\Command;

class ItInstaller extends Command {
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'it:install {plugin?}';
	protected $beer = "-"; //\360\237\215\272
	protected $ops = ""; //\xF0\x9F\x98\xB1
	protected $like = ""; //\xF0\x9F\x91\x8D
	protected $dislike = ""; //\xF0\x9F\x91\x8E
	protected $love = ""; //\xF0\x9F\x98\x8D
	protected $heart = ""; //\xE2\x9D\xA4
	protected $plugins = ['merge', 'baboon', 'laravelcollective', 'yajra', 'intervention']; //'payment', 'editors',
	protected $providers = "'providers' => [";
	protected $aliases = "'aliases' => [";
	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Install Environment & Plugins With (It)';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct() {
		parent::__construct();
	}

	private function laravelcollective() {
		shell_exec('composer require "laravelcollective/html":"^6.0"');
		$app = file_get_contents(base_path('config/app.php'));
		if (!preg_match('/HtmlServiceProvider::class/i', $app)) {
			$final = str_replace($this->providers, $this->providers . "\r\n" . '		Collective\Html\HtmlServiceProvider::class ,', $app);
			$this->info('It' . $this->beer . ' the provider Collective\Html\HtmlServiceProvider::class auto Pushed in array providers');
		}
		if (!preg_match("/'Form' => Collective\Html\FormFacade::class/i", $final)) {
			$final = str_replace($this->aliases, $this->aliases . "\r\n" . "		'Form' => Collective\Html\FormFacade::class ,", $final);
			$this->info('It' . $this->beer . ' the Alias \'Form\' => Collective\Html\FormFacade::class auto Pushed in array Aliases');
		}

		if (!preg_match("/'Html' => Collective\\Html\\HtmlFacade::class/i", $final)) {
			$final = str_replace($this->aliases, $this->aliases . "\r\n" . "		'Html' => Collective\Html\HtmlFacade::class ,", $final);
			\Storage::disk('it')->put('config/app.php', $final);
			$this->info('It' . $this->beer . ' the Alias \'Html\' => Collective\Html\HtmlFacade::class auto Pushed in array Aliases');
		}
	}

	private function intervention() {

		shell_exec('composer require intervention/image');
		$this->info('It' . $this->beer . ' intervention image Package Is Ready Now');

	}
	private function yajra() {
		shell_exec('composer require yajra/laravel-datatables-oracle');
		shell_exec('composer require yajra/laravel-datatables-buttons');
		shell_exec('composer require yajra/laravel-datatables-html');
		shell_exec('composer require yajra/laravel-datatables-fractal');
		shell_exec('composer require yajra/laravel-datatables-editor');

		$this->info('It' . $this->beer . ' Yajra Package Is Ready Now');
	}

	private function merge() {

		shell_exec('composer require barryvdh/laravel-elfinder');
		$elfinder_conf = file_get_contents(__DIR__ . '/../configs/elfinder.php');
		$elfindercontroller = file_get_contents(__DIR__ . '/../configs/elfindercontroller.it');
		$app = file_get_contents(base_path('config/app.php'));

		if (!preg_match('/Barryvdh\Elfinder\ElfinderServiceProvider::class/i', $app)) {
			$final = str_replace($this->providers, $this->providers . "\r\n" . '		Barryvdh\Elfinder\ElfinderServiceProvider::class ,', $app);
			\Storage::disk('it')->put('config/app.php', $final);
			$this->info('It' . $this->beer . ' the provider Barryvdh\Elfinder\ElfinderServiceProvider::class auto Pushed in providers');
		}

		//shell_exec("php artisan vendor:publish --provider='Barryvdh\Elfinder\ElfinderServiceProvider' --tag=config");
		shell_exec("php artisan vendor:publish --provider='Barryvdh\Elfinder\ElfinderServiceProvider' --tag=views");
		shell_exec("php artisan elfinder:publish");
		$this->info('It' . $this->beer . ' Elfinder Published Environments');
		\Storage::disk('it')->put('config/elfinder.php', $elfinder_conf);
		$this->info('It' . $this->beer . ' Elfinder Config generated to config/elfinder.php');
		\Storage::disk('it')->put('vendor/barryvdh/laravel-elfinder/src/ElfinderController.php', $elfindercontroller);
		$this->info('It' . $this->beer . ' Elfinder Auto Configured By (It) - (it merge) Now Is ready to you   ' . $this->love);

	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle() {
		\File::copy(__DIR__ . '/../environment/config/filesystems.php', base_path('config/filesystems.php'));
		\Config::set('filesystems.default', 'it');

		$plugin = $this->argument('plugin');
		if (in_array($plugin, $this->plugins)) {
			if ($plugin == 'merge') {
				$this->info('It' . $this->beer . ' preparing file system merge');
				$this->merge();
			} else if ($plugin == 'laravelcollective') {
				$this->laravelcollective();
			} else if ($plugin == 'yajra') {
				$this->yajra();
			} else if ($plugin == 'intervention') {
				$this->intervention();
			}
		} else {
			$plugg = [];

			$this->error('It' . $this->beer . ' Whoops please choose - plugin from list');
			$headers = [
				'Command (php artisan it:install)',
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
					$title = 'Baboon CRUD System (MVC-SD) Created By Mahmoud Ibrahim v1';
				} elseif ($plug == 'laravelcollective') {
					$title = 'Install Laravel Collective Package (laravelcollective.com) ';
				} elseif ($plug == 'yajra') {
					$title = 'Install yajra datatable Package (yajrabox.com) ';
				} elseif ($plug == 'intervention') {
					$title = 'Install intervention Image Package (image.intervention.io) ';
				}
				array_push($plugg, [$plug, $title]);
			}
			$this->table($headers, $plugg);
		}
	}
}
