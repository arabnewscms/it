<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminGroupRolesTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void

	'name',
	'show',
	'add',
	'edit',
	'delete',

	 */
	public function up() {
		Schema::create('admin_group_roles', function (Blueprint $table) {
				$table->id();
				$table->string('name');
				$table->bigInteger('admin_groups_id')->unsigned()->nullable();
				$table->foreign('admin_groups_id')->references('id')->on('admin_groups')->onDelete('cascade');
				$table->enum('show', ['yes', 'no'])->default('no');
				$table->enum('add', ['yes', 'no'])->default('no');
				$table->enum('edit', ['yes', 'no'])->default('no');
				$table->enum('delete', ['yes', 'no'])->default('no');
				$table->timestamps();
			});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('admin_group_roles');
	}
}
