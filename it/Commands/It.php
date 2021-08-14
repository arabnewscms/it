<?php

namespace Phpanonymous\It\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;

class It extends Command {
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */

	protected $signature  = 'it:fix {option?}';
	protected $query      = "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME =  ?";
	protected $exisistsdb = false;
	protected $pathes     = [
		'storage',
		'storage/app',
		'storage/app/public',
		'storage/framework',
		'storage/framework/cache',
		'storage/framework/sessions',
		'storage/framework/testing',
		'storage/framework/views',
		'storage/logs',
	];

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Restart && Clear Cach && Rebuild File  System';
	protected $beer        = "";
	protected $ops         = "";
	protected $like        = "";
	protected $dislike     = "";
	protected $love        = "";
	protected $heart       = "";
	/*
	\360\237\215\272
	\xF0\x9F\x98\xB1
	\xF0\x9F\x91\x8D
	\xF0\x9F\x91\x8E
	\xF0\x9F\x98\x8D
	\xE2\x9D\xA4
	 */
	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct() {
		parent::__construct();
		//$this->files      = $files;
		//$this->exisistsdb = !empty(DB::select($this->query, [env('DB_DATABASE')]))?true:false;
	}

	/*
	exec('cd code && composer create-project laravel/laravel my-project');
	// or
	shell_exec('cd code && composer create-project laravel/laravel my-project');
	 */

	private function progress($length) {
		$bar = $this->output->createProgressBar(0);
		$bar->setFormat('[<fg=magenta>%bar%</>] <info>%elapsed%</info>');
		$bar->setEmptyBarCharacter('..');
		$bar->setProgressCharacter("\xf0\x9f\x8c\x80");
		$bar->advance($length);
		$bar->finish();
		echo "\r\n";
	}

	private function decoct($path) {
		return decoct(fileperms(base_path($path))&0777);
	}
	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle() {
		\Config::set('filesystems.default', 'it');
		$option = $this->argument('option');
		$this->progress(100);
		Artisan::call('route:clear', []);
		$this->info("It".$this->beer."' .::. route cache file removed");

		$this->progress(100);
		//Artisan::call('route:cache', []);
		$this->line("It".$this->beer."' .::. route cache file created");

		if ($this->exisistsdb == true) {
			if (\Schema::hasTable('jobs') && Schema::hasTable('failed_jobs')) {
				$this->progress(100);
				Artisan::call('queue:flush', []);
				$this->info("It".$this->beer."' .::. Flushed all of the failed queue jobs");

				$this->progress(100);
				Artisan::call('queue:forget', []);
				$this->info("It".$this->beer."' .::. Deleted a failed queue job");

			}
		}

		//$this->progress(100);
		///	Artisan::call('config:clear', []);
		//$this->info("It".$this->beer."' .::. Remove the configuration cache file");

		$this->progress(100);
		Artisan::call('package:discover', []);
		$this->line("It".$this->beer."' .::. Rebuilded the cached package manifest");

		$this->progress(100);
		Artisan::call('cache:clear', []);
		$this->info("It".$this->beer."' .::. Flush the application cache");

		//$this->progress(100);
		//Artisan::call('config:cache', []);
		//$this->line("It".$this->beer."' .::. Create a cache file for faster configuration loading");

		//$this->progress(100);
		//Artisan::call('cache:forget', []);
		//$this->info("It".$this->beer."' .::. Remove an item from the cache");

		if ($this->exisistsdb == true) {
			if (Schema::hasTable('password_resets')) {
				$this->progress(100);
				Artisan::call('auth:clear-resets', []);
				$this->info("It".$this->beer."' .::. Flush expired password reset tokens");
			}
		}

		$this->progress(100);
		Artisan::call('clear-compiled', []);
		$this->info("It".$this->beer."' .::. Remove the compiled class file");

		$this->progress(100);
		Artisan::call('view:clear', []);
		$this->info("It".$this->beer."' .::. Clear all compiled view files is done");

		$this->progress(100);

		///// Check Permissions By It //////////////////////
		foreach ($this->pathes as $path) {
			if (is_dir(base_path($path))) {
				$storage_number = $this->decoct($path);
				$storage_string = it_permissions(base_path($path));

				if (!in_array($this->decoct($path), [755, 777])) {
					$msg = "It".$this->beer."' .::. Warning !! ".$this->ops." Path Folder  (".$path.") CHMOD \r\n is =>".$storage_string.'| CHMOD is = ('.$this->decoct($path).')';
					$this->error($msg);
				} else {
					$msg = "It".$this->beer."' .::. ".$this->like." Path Folder (".$path.")  =>".$storage_string.'| CHMOD is = ('.$this->decoct($path).')';
					$this->line($msg);
				}

				if (!in_array($this->decoct($path), [755, 777])) {
					if ($this->confirm('Do You Want Fix ('.$path.') Folder To CHMOD  => 755 ?')) {
						chmod(base_path($path), 0755);
						$this->info('it '.$this->beer.' Folder ('.$path.') is CHMOD 755');
					} elseif ($this->confirm('Do You Want Fix ('.$path.')Folder To CHMOD => 777 ?')) {
						chmod(base_path($path), 0777);
						$this->info('it '.$this->beer.' Folder ('.$path.') is CHMOD 777');
					}
				} else {
					$this->info('it'.$this->beer.' Good Job '.$this->like.' Folder Permission '.$this->love.' ('.$path.') is CHMOD '.$this->decoct($path));
				}
			}
		}
		///// Check Permissions By It //////////////////////
		if (count(glob(base_path('storage/framework/sessions').'/*')) > 0) {
			if ($this->confirm('do you want clear sessions ?')) {
				array_map('unlink', glob(base_path('storage/framework/sessions').'/*'));
				$this->info('it '.$this->beer.' Sessions cleared');
			}
		}

		if (file_exists(base_path('storage/logs/laravel.log'))) {
			if ($this->confirm('Do You Want Clear laravel.log ?')) {
				@unlink(base_path('storage/logs/laravel.log'))?
				$this->info("It".$this->beer."' .::. The laravel.log is Deleted"):'';
			}
		}

		if ($option == 'dump') {
			shell_exec('composer dump-autoload');
		}

		if ($option == 'update') {
			shell_exec('composer update');
		}

		echo "\r\n";

		$this->line("Laravel Version ".app()->version());
		$this->line("It Version 1.6.3");
		if (phpversion() < 8.0) {
			$this->error("PHP Version is Not Supported ".$this->dislike." ".phpversion());
		} else {
			$this->line("PHP Version is Supported ".$this->like." ".phpversion());
		}

		echo "\r\n";
		$this->line("<(Thank You For Choosing (It) - ".$this->love."  A Simple Track To make sense)>");
		$this->line("<(Copyright reserved @ Mahmoud Ibrahim  Phpanonymous LTS Script - (It) 2018 it.phpanonymous.com)>");
		echo "\r\n";

	}
}
