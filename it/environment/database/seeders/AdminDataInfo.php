<?php

use Illuminate\Database\Seeder;

class AdminDataInfo extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        return \App\Admin::create([
            'name'     => 'admin',
            'email'    => 'test@test.com',
            'password' => bcrypt(123456),
        ]);
    }
}
