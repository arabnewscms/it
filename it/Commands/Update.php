<?php
namespace Phpanonymous\It\Commands;
use Illuminate\Console\Command;
use Phpanonymous\It\Controllers\Baboon\MasterBaboon as Baboon;

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
	public function delete_list() {
		return [
			'app/Http/Controllers/Api/AuthApiLoggedIn.php',
		];
	}

	public function patch_list() {
		return [
			__DIR__ .'/../patch_update/resources/views/admin/ajax.baboon'                                  => 'resources/views/admin/ajax.blade.php',
			__DIR__ .'/../patch_update/resources/views/admin/dropzone.blade.baboon'                        => 'resources/views/admin/dropzone.blade.php',
			__DIR__ .'/../patch_update/resources/views/admin/layouts/footer.baboon'                        => 'resources/views/admin/layouts/footer.blade.php',
			__DIR__ .'/../patch_update/resources/views/admin/layouts/header.baboon'                        => 'resources/views/admin/layouts/header.blade.php',
			__DIR__ .'/../patch_update/resources/views/admin/layouts/navbar.baboon'                        => 'resources/views/admin/layouts/navbar.blade.php',
			__DIR__ .'/../patch_update/public/it_des/it/css/baboon.baboon'                                 => 'public/it_des/it/css/baboon.css',
			__DIR__ .'/../patch_update/public/assets/css/adminlte-rtl.css'                                 => 'public/assets/css/adminlte-rtl.css',
			__DIR__ .'/../patch_update/public/assets/css/custom.css'                                       => 'public/assets/css/custom.css',
			__DIR__ .'/../patch_update/public/assets/css/adminlte.css'                                     => 'public/assets/css/adminlte.css',
			__DIR__ .'/../patch_update/resources/lang/ar/validation.baboon'                                => 'resources/lang/ar/validation.php',
			__DIR__ .'/../patch_update/resources/lang/en/validation.baboon'                                => 'resources/lang/en/validation.php',
			__DIR__ .'/../patch_update/resources/lang/fr/validation.baboon'                                => 'resources/lang/fr/validation.php',
			__DIR__ .'/../patch_update/app/Providers/ExtraValidations.baboon'                              => 'app/Providers/ExtraValidations.php',
			__DIR__ .'/../patch_update/app/Providers/AppServiceProvider.baboon'                            => 'app/Providers/AppServiceProvider.php',
			__DIR__ .'/../patch_update/public/assets/img/audio.jpeg'                                       => 'public/assets/img/audio.jpeg',
			__DIR__ .'/../patch_update/public/assets/img/xls.jpeg'                                         => 'public/assets/img/xls.jpeg',
			__DIR__ .'/../patch_update/public/assets/img/zip.jpeg'                                         => 'public/assets/img/zip.jpeg',
			__DIR__ .'/../patch_update/public/assets/img/file.png'                                         => 'public/assets/img/file.png',
			__DIR__ .'/../patch_update/public/assets/img/pdf.png'                                          => 'public/assets/img/pdf.png',
			__DIR__ .'/../patch_update/public/assets/img/power_point.png'                                  => 'public/assets/img/power_point.png',
			__DIR__ .'/../patch_update/public/assets/img/text.png'                                         => 'public/assets/img/text.png',
			__DIR__ .'/../patch_update/public/assets/img/video.png'                                        => 'public/assets/img/video.png',
			__DIR__ .'/../patch_update/public/assets/js/demo.js'                                           => 'public/assets/js/demo.js',
			__DIR__ .'/../patch_update/app/Http/Controllers/FileUploader.baboon'                           => 'app/Http/Controllers/FileUploader.php',
			__DIR__ .'/../patch_update/resources/views/admin/layouts/statistics/module_counters.baboon'    => 'resources/views/admin/layouts/statistics/module_counters.blade.php',
			__DIR__ .'/../patch_update/resources/views/admin/home.baboon'                                  => 'resources/views/admin/home.blade.php',
			__DIR__ .'/../patch_update/resources/views/admin/show_image.baboon'                            => 'resources/views/admin/show_image.blade.php',
			__DIR__ .'/../patch_update/database/migrations/2021_02_19_985759_create_settings_table.baboon' => 'database/migrations/2021_02_19_985759_create_settings_table.php',
			__DIR__ .'/../patch_update/app/Models/Setting.baboon'                                          => 'app/Models/Setting.php',
			__DIR__ .'/../patch_update/routes/configurations.baboon'                                       => 'routes/configurations.php',
			__DIR__ .'/../patch_update/routes/api.baboon'                                                  => 'routes/api.php',
			__DIR__ .'/../patch_update/routes/web.baboon'                                                  => 'routes/web.php',
			__DIR__ .'/../patch_update/app/Http/Controllers/Api/V1/Auth/AuthAndLogin.baboon'               => 'app/Http/Controllers/Api/V1/Auth/AuthAndLogin.php',
			__DIR__ .'/../patch_update/app/Http/Controllers/Api/V1/Auth/Register.baboon'                   => 'app/Http/Controllers/Api/V1/Auth/Register.php',
			__DIR__ .'/../patch_update/storage/collections/login_postman_collection.json'                  => 'storage/collections/login_postman_collection.json',
			__DIR__ .'/../patch_update/app/Http/Controllers/Admin/Dashboard.baboon'                        => 'app/Http/Controllers/Admin/Dashboard.php',

			// Api start//
			__DIR__ .'/../patch_update/app/Http/Controllers/ValidationsApi/V1/Auth/RegisterRequest.baboon' => 'app/Http/Controllers/ValidationsApi/V1/Auth/RegisterRequest.php',

			__DIR__ .'/../patch_update/app/Http/Controllers/ValidationsApi/V1/Auth/LoginRequest.baboon' => 'app/Http/Controllers/ValidationsApi/V1/Auth/LoginRequest.php',

			__DIR__ .'/../patch_update/app/Http/Controllers/ValidationsApi/V1/Auth/ChangePasswordRequest.baboon' => 'app/Http/Controllers/ValidationsApi/V1/Auth/ChangePasswordRequest.php',
			// Api start//

			__DIR__ .'/../patch_update/resources/views/admin/layouts/components/submit_form_ajax.blade.baboon' => 'resources/views/admin/layouts/components/submit_form_ajax.blade.php',
			__DIR__ .'/../patch_update/public/assets/plugins/icheck-bootstrap/icheck-bootstrap.min-rtl.css'    => 'public/assets/plugins/icheck-bootstrap/icheck-bootstrap.min-rtl.css',
			__DIR__ .'/../patch_update/public/assets/js/pages/dashboard.js'                                    => 'public/assets/js/pages/dashboard.js',
			__DIR__ .'/../patch_update/config/app.baboon'                                                      => 'config/app.php',
			__DIR__ .'/../patch_update/config/auth.baboon'                                                     => 'config/auth.php',
			__DIR__ .'/../patch_update/config/jwt.baboon'                                                      => 'config/jwt.php',
			__DIR__ .'/../patch_update/config/lfm.baboon'                                                      => 'config/lfm.php',
		];
	}

	public function Makelang($lang_dir = 'ar') {
		$checklang = base_path('resources/lang/'.$lang_dir.'/admin.php');
		if (file_exists($checklang)) {
			$baboonLang = include $checklang;
		}
		$the_master_lang = [];
		$lang            = '<?php
		return ['."\n";
		if (!empty($baboonLang)) {
			foreach ($baboonLang as $k => $v) {
				$the_master_lang += [$k   => $v];
			}
		}

		if ($lang_dir == 'ar') {
			$the_master_lang += ['start'                => "ابداء"];
			$the_master_lang += ['drag_drop_files_here' => "قم بسحب وافلات الملفات هنا او قم باختيار ملفات"];
			$the_master_lang += ["add_files"            => "إضافة ملفات"];
			$the_master_lang += ["start_upload"         => "ابداء رفع الكل"];
			$the_master_lang += ["cancel_upload"        => "إلغاء رفع الكل"];
			$the_master_lang += ["multi_upload"         => "تحميل متعدد"];
			$the_master_lang += ["file_too_big"         => "حجم الملف كبير جدا يجب ان لا يتعدي :size م.ج"];
		} elseif ($lang_dir == 'en') {
			$the_master_lang += ["start"                => "Start"];
			$the_master_lang += ["drag_drop_files_here" => "Drag and drop files here or choose files"];
			$the_master_lang += ["add_files"            => "choose files"];
			$the_master_lang += ["start_upload"         => "upload all"];
			$the_master_lang += ["cancel_upload"        => "cancel upload all"];
			$the_master_lang += ["multi_upload"         => "Multiple upload"];
			$the_master_lang += ["file_too_big"         => "The file size is very large, it should not exceed :size MB"];
		} elseif ($lang_dir == 'fr') {
			$the_master_lang += ["start"                => "Début"];
			$the_master_lang += ["drag_drop_files_here" => "Glissez et déposez des fichiers ici ou choisissez des fichiers"];
			$the_master_lang += ["add_files"            => "choisir des fichiers"];
			$the_master_lang += ["start_upload"         => "télécharger tout"];
			$the_master_lang += ["cancel_upload"        => "annuler tout télécharger"];
			$the_master_lang += ["multi_upload"         => "Téléchargement multiple"];
			$the_master_lang += ["file_too_big"         => "La taille du fichier est très grande, elle ne doit pas dépasser :size MB"];
		}

		foreach ($the_master_lang as $k => $v) {
			$lang .= '		"'.$k.'"	=>		"'.$v.'"';
			$lang .= ','."\n";
		}
		$lang .= "\n".'];';
		return $lang;
	}

	public function updateLanguage() {
		////////////////// Language Files ////////////////////

		$lang_ar = $this->Makelang('ar');
		Baboon::write($lang_ar, 'admin', 'resources\\lang\\ar\\');
		$this->info('resources/lang/ar/admin.php File updated successfully');

		if (is_dir(base_path('resources/lang/en'))) {
			$lang_en = $this->Makelang('en');
			Baboon::write($lang_en, 'admin', 'resources\\lang\\en\\');
			$this->info('resources/lang/en/admin.php File updated successfully');
		}

		if (is_dir(base_path('resources/lang/fr'))) {
			$lang_fr = $this->Makelang('fr');
			Baboon::write($lang_fr, 'admin', 'resources\\lang\\fr\\');
			$this->info('resources/lang/fr/admin.php File updated successfully');
		}

		////////////////// Language Files ////////////////////
	}
	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle() {

		$this->warn('Any updates will not affect your previous files, it only works with the new features');
		$ASK_UPDATE = $this->confirm('do you want apply patch update to publish new files from version '.it_version().' ?');

		if ($ASK_UPDATE) {

			// Update Loop File List
			foreach ($this->patch_list() as $key => $value) {
				if (file_exists($key)) {
					$ajax_baboon = file_get_contents($key);
					if (\Storage::disk('it')->put($value, $ajax_baboon)) {
						$this->info($value.' File updated successfully');
					} else {
						$this->warn($value.' Update Failed');
					}
				}
			}
			// Update Lang Files
			$this->updateLanguage();

			// Delete Loop File List
			foreach ($this->delete_list() as $delete_list) {
				if (file_exists(base_path($delete_list))) {
					\Storage::disk('it')->delete($delete_list);
					$this->warn($delete_list.' File Deleted successfully');
				}
			}

		} else {
			$this->warn('The Update is Canceled');
		}

	}

}
