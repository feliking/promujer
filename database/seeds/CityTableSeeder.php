<?php

use Illuminate\Database\Seeder;

class CityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cities')->insert([
            'name' => 'LA PAZ',
        ]);
        DB::table('cities')->insert([
            'name' => 'CHUQUISACA',
        ]);
        DB::table('cities')->insert([
            'name' => 'COCHABAMBA',
        ]);
        DB::table('cities')->insert([
            'name' => 'BENI',
        ]);
        DB::table('cities')->insert([
            'name' => 'ORURO',
        ]);
        DB::table('cities')->insert([
            'name' => 'PANDO',
        ]);
        DB::table('cities')->insert([
            'name' => 'POTOSI',
        ]);
        DB::table('cities')->insert([
            'name' => 'SANTA CRUZ',
        ]);
        DB::table('cities')->insert([
            'name' => 'TARIJA',
        ]);
    }
}
