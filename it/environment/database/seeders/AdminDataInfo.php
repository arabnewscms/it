<?php

use Illuminate\Database\Seeder;

class AdminDataInfo extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		return \App\Models\Admin::create([
			'name' => 'admin',
			'email' => 'test@test.com',
			'group_id' => 1,
			'password' => bcrypt(123456),
		]);
	}
}
