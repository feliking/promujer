<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'last_name' => 'Administrador',
            'first_name' => 'Administrador',
            'city_id' => 1,
            'status' => true,
            'gender' => 'M',
            'username' => 'admin',
            'password' => bcrypt('admin')
        ]);
    }
}
