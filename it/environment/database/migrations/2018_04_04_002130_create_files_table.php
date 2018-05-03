<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilesTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('files', function (Blueprint $table) {
				$table->increments('id');
				$table->integer('admin_id')->unsigned()->nullable();
				$table->foreign('admin_id')->references('id')->on('admins');
				$table->integer('user_id')->unsigned()->nullable();
				$table->foreign('user_id')->references('id')->on('users');
				$table->string('file');
				$table->string('full_path');
				$table->string('type_file');
				$table->string('type_id');
				$table->string('path');
				$table->string('ext');
				$table->string('name');
				$table->string('size');
				$table->integer('size_bytes');
				$table->string('mimtype');
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
		Schema::dropIfExists('files');
	}
}
