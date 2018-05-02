<?php

namespace Phpanonymous\It\Commands;

use Config;
use Illuminate\Console\Command;

use ZipArchive;

class Generate extends Command {
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'it:generate';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Publish All files related to (it)';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct() {
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle() {

		\Config::set('filesystems.default', 'it');

		if (!class_exists('ZipArchive')) {
			$this->error("you should be enable the ZipArchive extension On Your Apache To continue ");
			return '';
		}
		$this->line("prepare all files please wait...");

		$zip = new ZipArchive;
		$res = $zip->open(__DIR__ .'/../environment/public.zip');
		if ($res === TRUE) {

			$zip->extractTo(base_path('public'));
			$zip->close();
		}
		$this->line("All File Extracted And Published");
		$this->info("Link Storage Automatically....");
		shell_exec('php artisan storage:link');

		if (check_package("intervention/image") === null) {
			$this->info("Downloading intervention Image Package....");
			shell_exec('composer require intervention/image');
		}

		if (check_package("laravelcollective/html") === null) {
			$this->info("Downloading laravelcollective Package....");
			shell_exec('php artisan it:install laravelcollective');
		}

		if (check_package("yajra/laravel-datatables-oracle") === null) {
			$this->info("Downloading Datatable Yajra Package....");
			shell_exec('php artisan it:install yajra');
		}

		if (check_package("langnonymous/lang") === null) {
			$this->info("Downloading Langnonymous Package....");
			shell_exec('composer require Langnonymous/Lang:dev-master');
		}

		$this->info("the admin panel is ready now");

	}
}
