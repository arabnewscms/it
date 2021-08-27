<?php
namespace Phpanonymous\It\Commands;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class Update extends Command {
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'it:update {option?}';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Update New files';
	public function patch_list() {
		return [
			__DIR__ . '/../patch_update/resources/views/admin/ajax.baboon' => 'resources/views/admin/ajax.blade.php',
			__DIR__ . '/../patch_update/public/it_des/it/css/baboon.baboon' => 'public/it_des/it/css/baboon.css',
			__DIR__ . '/../patch_update/public/assets/css/adminlte-rtl.css' => 'public/assets/css/adminlte-rtl.css',
			__DIR__ . '/../patch_update/public/assets/css/adminlte.css' => 'public/assets/css/adminlte.css',
			__DIR__ . '/../patch_update/resources/lang/ar/validation.baboon' => 'resources/lang/ar/validation.php',
			__DIR__ . '/../patch_update/resources/lang/en/validation.baboon' => 'resources/lang/en/validation.php',
			__DIR__ . '/../patch_update/resources/lang/fr/validation.baboon' => 'resources/lang/fr/validation.php',
			__DIR__ . '/../patch_update/app/Providers/ExtraValidations.baboon' => 'app/Providers/ExtraValidations.php',
		];
	}
	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle() {
		// $arguments = $this->arguments();
		// dd($arguments);
		$this->warn('Any updates will not affect your previous files, it only works with the new features');
		$ASK_UPDATE = $this->confirm('do you want apply patch update to publish new files from version ' . it_version() . ' ?');

		if ($ASK_UPDATE) {
			// Update Loop File List
			foreach ($this->patch_list() as $key => $value) {
				if (file_exists($key)) {
					$ajax_baboon = file_get_contents($key);
					if (\Storage::disk('it')->put($value, $ajax_baboon)) {
						$this->info($value . ' File updated successfully');
					} else {
						$this->warn($value . ' Update Failed');
					}
				}
			}

		} else {
			$this->warn('The Update is Canceled');
		}

	}

}
