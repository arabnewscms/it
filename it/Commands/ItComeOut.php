<?php

namespace Phpanonymous\It\Commands;

use App\Console\Commands\ItUninstall;
use Config;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class ItComeOut extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'it:hey {do}';
    protected $beer      = "";
    protected $ops       = "";
    protected $like      = "";
    protected $dislike   = "";
    protected $love      = "";
    protected $heart     = "";

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install It by come-here or remove it by go-out command';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        \Config::set('filesystems.default', 'it');

        $do = $this->argument('do');
        if ($do == 'come-here') {
            if (!class_exists('ZipArchive')) {
                $this->error("It" . $this->beer . "' tell you - you should be enable the ZipArchive Extention On Your Apache To continue ");
                return '';
            }
            /*$this->line("It".$this->beer."' .::. prepare all files and cloning please wait...");
            shell_exec('git clone https://github.com/arabnewscms/it-come ');

            $zip = new ZipArchive;
            $res = $zip->open(base_path('it-come/it.zip'));
            if ($res === TRUE) {
            $zip->extractTo(base_path('app'));
            $zip->close();
            }
             */
            /*$it_des = $zip->open(base_path('it-come/it_des.zip'));
            if ($it_des === TRUE) {
            $zip->extractTo(base_path('public'));
            $zip->close();
            }*/
            /*$itHelper = file_get_contents(base_path('it-come/it.php'));
            Storage::put('app/itHelpers/it.php', $itHelper);*/

            /*Storage::deleteDirectory('it-come');
        $this->line("It".$this->beer."' .::.  amazing i am ready now to assist you ".$this->love);*/

        } else if ($do == 'go-out') {
            if ($this->confirm('are you sure you want to delete (it) ' . $this->ops . ' ?')) {
                $this->line("It" . $this->beer . "' .::. omg i am sad but okay please wait to delete my files");

                $uninstall = new ItUninstall;
                $uninstall->uninstall_merge();
                shell_exec('composer remove "phpanonymous/it": "^1.2"');
                //$itHelper = file_get_contents(base_path('app/itHelpers/it.php'));
                //Storage::put('app/itHelpers/it.php', '');
                //Storage::deleteDirectory('app/it');
                Storage::deleteDirectory('public/it_des');
                $this->line("It" . $this->beer . "' .::. okay all is done Bye Bye :( ");

            } else {
                $this->line("It" . $this->beer . "' .::.  okay i am still here to assist you " . $this->love);
            }

        }
    }
}
