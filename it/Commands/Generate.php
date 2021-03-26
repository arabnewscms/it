<?php
namespace Phpanonymous\It\Commands;
use Config;
use Illuminate\Console\Command;

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

		if (!class_exists('ZipArchive')) {
			$this->error("you should be enable the ZipArchive extension On Your Apache To continue ");
			return '';
		}
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

		// App Name Question
		$APP_NAME = $this->ask('What is Your APP NAME ?');
		self::changeEnv('APP_NAME', $APP_NAME);

		// Set CUSTOM PORT //
		$NEED_PORT = $this->confirm('You Want Add A Custom Port To Your localhost ?');
		if ($NEED_PORT) {
			$HAVE_PORT = $this->ask('What is Your Custom Domain Port (Default Port is 80) ?');
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
				}
			}

			if (!empty($HAVE_PORT)) {
				self::changeEnv('APP_URL', 'http://localhost:' . $HAVE_PORT);
			} else {
				self::changeEnv('APP_URL', 'http://localhost');
			}
		}
		$this->line("we are build your admin panel and downloading default packages this new version is super fast please wait ...");
		//$phpversion = explode('.', phpversion())[1];

		// if ($phpversion == '2' && check_package("mockery/mockery") === null) {
		// 	$this->info("Downloading mockery Package....");
		// 	shell_exec('composer require mockery/mockery "1.3.2"');
		// }

		if (check_package("langnonymous/lang") === null) {
			$this->info("Downloading Langnonymous Package....");
			shell_exec('composer require Langnonymous/Lang:dev-master');
		}

		if (check_package("spatie/laravel-honeypot") === null) {
			$this->info("Downloading spatie/laravel-honeypot Package....");
			shell_exec('composer require spatie/laravel-honeypot');
		}

		if (check_package("laravel/ui") === null) {
			$this->info("Downloading laravel/ui Package....");
			shell_exec('composer require laravel/ui');
		}
		if (check_package("intervention/image") === null) {
			$this->info("Downloading intervention Image Package....");
			shell_exec('composer require intervention/image');
		}

		if (check_package("laravelcollective/html") === null) {
			$this->info("Downloading laravelcollective Package....");
			shell_exec('php artisan it:install laravelcollective');
		}

		if (check_package("maatwebsite/excel") === null) {
			$this->info("Downloading tcpdf....");
			shell_exec('composer require maatwebsite/excel');
		}

		if (check_package("tecnickcom/tcpdf") === null) {
			$this->info("Downloading tcpdf....");
			shell_exec('composer require tecnickcom/tcpdf');
		}

		if (check_package("mpdf/mpdf") === null) {
			$this->info("Downloading mpdf....");
			shell_exec('composer require mpdf/mpdf');
		}

		if (check_package("barryvdh/laravel-snappy") === null) {
			$this->info("Downloading laravel-snappy....");
			shell_exec('composer require barryvdh/laravel-snappy');
		}

		if (check_package("dompdf/dompdf") === null) {
			$this->info("Downloading dompdf....");
			shell_exec('composer require dompdf/dompdf');
		}

		if (check_package("unisharp/laravel-filemanager") === null) {
			$this->info("Downloading filemanager....");
			shell_exec('composer require unisharp/laravel-filemanager');
		}

		if (check_package("phpoffice/phpspreadsheet") === null) {
			$this->info("Downloading Datatable Yajra Package....");
			shell_exec('composer require phpoffice/phpspreadsheet');
		}

		if (check_package("yajra/laravel-datatables-oracle") === null) {
			$this->info("Downloading Datatable Yajra Package....");
			shell_exec('php artisan it:install yajra');
		}

		$zip = new \ZipArchive;
		$res = $zip->open(__DIR__ . '/../environment/public.zip');
		if ($res === true) {
			$zip->extractTo(base_path('public'));
			$zip->close();
		}

		$this->warn("All File Extracted And Published");
		$this->warn("Link Storage Automatically....");
		shell_exec('php artisan storage:link');

		$this->warn("Auto Publishable Files And Folders....");
		//shell_exec('php artisan vendor:publish --tag=0 --force');
		\Artisan::call('vendor:publish --tag=0 --force');
		$this->info("Publish Files And Folders is Done");

		$this->warn("Auto Dump And Compile autoload....");
		shell_exec('composer dump-autoload');
		shell_exec('php artisan config:clear');

		$this->warn("to Install (wkhtmltopdf) please visit this link urgently (https://github.com/barryvdh/laravel-snappy) to explort PDF Files with YajraDatatable");

		$this->warn("To Install (wkhtmltopdf) with brew on macosx brew install wkhtmltopdf");

		$this->info("thank you for using my package (Mahmoud Ibrahim) if you want ask me something text me   php.anonymous1@gmail.com");

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
