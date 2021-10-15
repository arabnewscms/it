<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Departments extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('departments', function (Blueprint $table) {
				$table->increments('id');

				$table->string('name_ar');
				$table->string('name_en');
				$table->string('name_fr');
				$table->string('icon')->nullable();
				$table->string('color')->nullable();
				$table->integer('parent')->unsigned()->nullable();
				$table->foreign('parent')->references('id')->on('departments')->onDelete('cascade');

				$table->integer('admin_id')->unsigned()->nullable();
				$table->foreign('admin_id')->references('id')->on('admins');
				$table->softDeletes();
				$table->timestamps();
			});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('departments');
	}
}
