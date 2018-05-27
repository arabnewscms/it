<?php

use Illuminate\Database\Seeder;

class Admin extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		\App\Admin::create([
				'name'     => 'admin',
				'email'    => 'test@test.com',
				'password' => bcrypt(123456),
			]);
	}
}
