<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
	/**
	 * Seed the application's database.
	 *
	 * @return void
	 */
	public function run() {

		\App\Models\Admin::create([
			'name' => 'admin',
			'email' => 'test@test.com',
			'group_id' => 1,
			'password' => bcrypt(123456),
		]);
	}
}
