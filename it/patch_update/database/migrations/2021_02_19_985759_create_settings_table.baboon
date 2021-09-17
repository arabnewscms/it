<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('settings', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('sitename_ar');
			$table->string('sitename_en');
			$table->string('sitename_fr');
			$table->string('email')->nullable();
			$table->string('logo')->nullable();
			$table->string('icon')->nullable();
			$table->enum('system_status', ['open', 'close'])->default('open');
			$table->longtext('system_message')->nullable();
			$table->longtext('theme_setting')->nullable();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('settings');
	}
}
