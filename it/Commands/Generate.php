<?php

namespace Phpanonymous\It\Commands;

use Config;
use Illuminate\Console\Command;

class Generate extends Command
{
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
    public function __construct()
    {
        parent::__construct();
    }

    public static function changeEnv($key, $value)
    {
        $path = base_path('.env');
        if (file_exists($path)) {
            //Try to read the current content of .env
            $current = file_get_contents($path);

            //Store the key
            $original = [];
            if (preg_match('/^' . $key . '=(.+)$/m', $current, $original)) {

                //Overwrite with new key
                $current = preg_replace('/^' . $key . '=.+$/m', "{$key}={$value}", $current);

            } else {
                //Append the key to the end of file
                $current .= PHP_EOL . "{$key}={$value}";
            }
            file_put_contents($path, $current);
        }
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        \Config::set('filesystems.default', 'it');

        if (!class_exists('ZipArchive')) {
            $this->error("you should be enable the ZipArchive extension On Your Apache To continue ");
            return '';
        }
        $this->line("Welcome to (it) package \r\n Please Answer this questions to auto create your database !!");
        if (PHP_OS == 'Darwin') {
            $mamp_pro = $this->confirm("you are using mamp pro ?");
            if ($mamp_pro) {
                if ($this->confirm("you want auto insert this path (/Applications/MAMP/tmp/mysql/mysql.sock) in DB_SOCKET in .Env file ")) {
                    self::changeEnv('DB_SOCKET', '/Applications/MAMP/tmp/mysql/mysql.sock');

                    \Config::set('database.connections.mysql.unix_socket', '/Applications/MAMP/tmp/mysql/mysql.sock');

                }
            }
        }
        $DB_DATABASE = $this->ask('What is your DATABASE Name ?');
        $DB_USERNAME = $this->ask('What is your DATABASE Username ?');
        $DB_PASSWORD = $this->ask('What is your DATABASE Password ?');
        if (!empty($DB_DATABASE)) {
            self::changeEnv('DB_DATABASE', $DB_DATABASE);
        }
        if (!empty($DB_USERNAME)) {
            self::changeEnv('DB_USERNAME', $DB_USERNAME);
        }
        if (!empty($DB_PASSWORD)) {
            self::changeEnv('DB_PASSWORD', $DB_PASSWORD);
        }

        if (!empty($DB_DATABASE)) {
            $auto_create_DB = $this->confirm("you want me a create database in your engine or you are already created database with name " . $DB_DATABASE . "? ");
            if ($auto_create_DB) {
                $pdo = $this->getPDOConnection(env('DB_HOST'), env('DB_PORT'), $DB_USERNAME, $DB_PASSWORD);

                $pdo->exec(sprintf(
                    'CREATE DATABASE IF NOT EXISTS %s CHARACTER SET %s COLLATE %s;',
                    $DB_DATABASE,
                    config('database.connections.mysql.charset'),
                    config('database.connections.mysql.collation')
                ));

                $this->info("DATABAES " . $DB_DATABASE . " Created and is ready ");
            }

        }

        $this->line("prepare all files and packages please wait...");

        if (check_package("langnonymous/lang") === null) {
            $this->info("Downloading Langnonymous Package....");
            shell_exec('composer require Langnonymous/Lang:dev-master');
        }

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

        $zip = new \ZipArchive;
        $res = $zip->open(__DIR__ . '/../environment/public.zip');
        if ($res === true) {
            $zip->extractTo(base_path('public'));
            $zip->close();
        }
        $this->line("All File Extracted And Published");
        $this->info("Link Storage Automatically....");
        shell_exec('php artisan storage:link');

        $this->info("your admin panel now is ready ");

        $this->info("please run this command php artisan vendor:publish --force and select 0 value to publish all config files");

        $this->info("please run this command php artisan migrate also");

        $this->info("Enjoy <3");
    }

    private function getPDOConnection($host, $port, $username, $password)
    {
        return new \PDO(sprintf('mysql:host=%s;port=%d;', $host, $port), $username, $password);
    }

}
