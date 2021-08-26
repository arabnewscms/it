<?php
namespace Phpanonymous\It\Commands;
use Config;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

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

	private function progress($length) {
		$bar = $this->output->createProgressBar(0);
		$bar->setFormat('[<fg=magenta>%bar%</>] <info>%elapsed%</info>');
		$bar->setEmptyBarCharacter('..');
		$bar->setProgressCharacter("\xf0\x9f\x8c\x80");
		$bar->advance($length);
		$bar->finish();
		echo "\r\n";
	}

	public static function changeEnv($key, $value) {
		$value = preg_replace('/\s+/', '', $value);
		$key = strtoupper($key);
		$env = file_get_contents(base_path('.env'));
		$env = str_replace("$key=" . env($key), "$key=" . $value, $env, $counter);
		if ($counter < 1) {
			$env .= "\n\r\n\r{$key}={$value}\n\r";
		}
		$env = file_put_contents(base_path('.env'), $env);
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle() {
		\Config::set('filesystems.default', 'it');

		$this->warn("attention please: If an event with you (No such file or directory) OR (Connection refused) You should make sure that you have network access validity to ip 127.0.0.1 and default port and access to your mysql check your Apache if you are use MAMP or Xampp Or Wamp Or Lamp ");

		$this->line("Hello Developer thank you for choosing Our Package  \r\n & Welcome to (IT) Super package \r\n Please Answer this questions to auto create your database !!");
		if (PHP_OS == 'Darwin') {
			$mamp_pro = $this->confirm("you are using mamp pro ?");
			if ($mamp_pro) {
				if ($this->confirm("you want auto insert this path (/Applications/MAMP/tmp/mysql/mysql.sock) in DB_SOCKET in .Env file ")) {
					self::changeEnv('DB_SOCKET', '/Applications/MAMP/tmp/mysql/mysql.sock');

					\Config::set('database.connections.mysql.unix_socket', '/Applications/MAMP/tmp/mysql/mysql.sock');
				}
			}
		}

		// auto add jwt options
		self::changeEnv('JWT_TTL', 'null');
		self::changeEnv('JWT_SECRET', Str::random(72));

		// App Name Question
		$APP_NAME = $this->ask('What is Your APP NAME ?');
		self::changeEnv('APP_NAME', $APP_NAME);

		// Set Project URL //
		$NEED_APP_URL = $this->confirm('Enter Full Project URL default is http://localhost');

		// Set CUSTOM PORT //
		$NEED_PORT = $this->confirm('You Want Add A Custom Port To Your localhost ?');
		if ($NEED_PORT) {
			$HAVE_PORT = $this->ask('What is Your Custom Domain Port (Default Port is 80) ?');

		}

		if (!empty($HAVE_PORT) && !empty($NEED_APP_URL)) {
			self::changeEnv('APP_URL', $NEED_APP_URL . ':' . $HAVE_PORT);
		} elseif (!empty($NEED_APP_URL)) {
			self::changeEnv('APP_URL', $NEED_APP_URL);
		} else {
			self::changeEnv('APP_URL', 'http://localhost');
		}

		// Set  CUSTOM PORT //

		// Set DB CUSTOM PORT //
		$NEED_PORT_DB_PORT = $this->confirm('You Want Add A Custom Port To Your Database ?');
		if ($NEED_PORT_DB_PORT) {
			$HAVE_DB_PORT = $this->ask('What is Your Custom Database Port (Default Port is 3306) ?');
			if (!empty($HAVE_DB_PORT)) {
				self::changeEnv('DB_PORT', $HAVE_DB_PORT);
			} else {
				self::changeEnv('DB_PORT', '3306');
			}
		}
		// Set DB CUSTOM PORT //

		$CREATE_DATABASE = $this->confirm('You Want create A new Database ?');

		if ($CREATE_DATABASE == 'yes') {
			$DB_DATABASE = $this->ask('What is your DATABASE Name ?');
			if (!empty($DB_DATABASE)) {
				self::changeEnv('DB_DATABASE', $DB_DATABASE);
			}

			$DB_USERNAME = $this->anticipate('What is your DATABASE Username ?', ['root', 'admin']);
			//$DB_USERNAME = $this->ask('What is your DATABASE Username ?');
			if (!empty($DB_USERNAME)) {
				self::changeEnv('DB_USERNAME', $DB_USERNAME);
			}

			$DB_PASSWORD = $this->anticipate('What is your DATABASE Password ?', ['root', 'pwd', 'password', '123456', 'password', 'secret']);
			//$DB_PASSWORD = $this->ask('What is your DATABASE Password ?');
			if (!empty($DB_PASSWORD)) {
				self::changeEnv('DB_PASSWORD', $DB_PASSWORD);
			}

			if (!empty($DB_DATABASE)) {

				$auto_create_DB = $this->confirm("do you want me to create a database in your engine or you have already created database with name " . $DB_DATABASE . "? ");
				if ($auto_create_DB) {
					if (!empty($HAVE_DB_PORT)) {
						$DB_PORT = $HAVE_DB_PORT;
					} else {
						$DB_PORT = 3306;
					}

					$pdo = $this->getPDOConnection(
						'localhost',
						$DB_PORT,
						$DB_USERNAME,
						$DB_PASSWORD
					);

					$pdo->exec(sprintf(
						'CREATE DATABASE IF NOT EXISTS %s CHARACTER SET %s COLLATE %s;',
						$DB_DATABASE,
						config('database.connections.mysql.charset'),
						config('database.connections.mysql.collation')
					));

					shell_exec('php artisan config:clear');
					shell_exec('php artisan cache:clear');

					$this->info("DATABAES " . $DB_DATABASE . " Created & is ready now");
					$this->progress(100);
				}
			}

		}
		$this->line("we are build your admin panel and downloading default packages this new version is super fast please wait ...");
		//$phpversion = explode('.', phpversion())[1];

		// if ($phpversion == '2' && check_package("mockery/mockery") === null) {
		// 	$this->info("Downloading mockery Package....");
		// 	shell_exec('composer require mockery/mockery "1.3.2"');
		// }
		

		$pakcages = array_filter([
		    'langnonymous/lang', 'spatie/laravel-honeypot',
		    'laravel/ui', 'intervention/image',
		    'laravelcollective/html', 'maatwebsite/excel',
		    'tecnickcom/tcpdf', 'mpdf/mpdf',
		    'barryvdh/laravel-snappy', 'dompdf/dompdf',
		    'unisharp/laravel-filemanager', 'phpoffice/phpspreadsheet',
		    'tymon/jwt-auth', 'phpanonymous/c3js',
		], function ($package) {
		    return check_package($package) === null;
		});
		
		if(count($packages) > 0)
		{
		    $this->info("Downloading Package....");
		    shell_exec('composer require '. implode(' ', $packages));
		}

		if (check_package("yajra/laravel-datatables-oracle") === null) {
			$this->info("Downloading Datatable Yajra Package....");
			shell_exec('php artisan it:install yajra');
			$this->progress(100);
		}

		$this->warn("Link Storage Automatically....");
		shell_exec('php artisan storage:link');
		$this->progress(100);

		$this->warn("Auto Publishable Files And Folders....");
		//shell_exec('php artisan vendor:publish --tag=0 --force');
		\Artisan::call('vendor:publish --tag=0 --force');
		$this->progress(100);
		$this->info("Publish Files And Folders is Done");

		$this->warn("Auto Dump And Compile autoload....");
		shell_exec('composer dump-autoload');
		//$this->progress(50);
		shell_exec('php artisan config:clear');
		$this->progress(100);

		//$this->warn("Auto generate kwt secret key or use manual command (php artisan jwt:secret)....");
		//shell_exec('php artisan jwt:secret --force');
		//$this->progress(100);
		//\Artisan::call('jwt:secret');

		$this->warn("to Install (wkhtmltopdf) please visit this link urgently (https://github.com/barryvdh/laravel-snappy) to explort PDF Files with YajraDatatable");

		$this->warn("To Install (wkhtmltopdf) with brew on macosx brew install wkhtmltopdf");

		$this->info("your admin panel now is ready ");
		$this->info("don't forget to rate us on github visit link: https://github.com/arabnewscms/it ");
		$this->info("auth types \r\n1 - php artisan ui:auth --views");
		$this->info("2 - php artisan ui:auth");
		$this->info("3 - php artisan ui bootstrap --auth");
		$this->info("4 - php artisan ui vue --auth");
		$this->info("5 - php artisan ui react --auth");
		$this->info("please run this command php artisan migrate also");
		$this->info("please run this command php artisan db:seed to fetch admin data (email: test@test.com) - (password: 123456) also");

		$this->info("Login your Admin Panel with (email: test@test.com) - (password: 123456)");

		$this->warn("to use big inputs data with baboon edit your php.ini and set max_input_vars=500000 Because the default limits for the basic settings are var and set yor max_input_time = 6000 & memory_limit = 3000M max_execution_time = 300 & post_max_size = 2000M & max_file_uploads = 200 & upload_max_filesize = 2000M ");

		$this->warn("Do not forget that after you have finished using the package, return values depending on what you want");

		$this->info("thank you for using my package (Mahmoud Ibrahim) if you want ask me something text me   php.anonymous1@gmail.com or php.anonymous@outlock.com");

		$this->info("Enjoy <3");
		$this->info("regards and i can assist you now");
		if (date('m') == 1) {
			$this->info("Happy New Year " . date('Y'));
		}
	}

	// Connection PDO Library Native
	public function getPDOConnection($host, $port, $username, $password) {
		$pdo = new \PDO('mysql:port=' . $port . ';host=' . $host, $username, $password);
		return $pdo;
	}

}
