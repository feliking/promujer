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
            'ext_1' => 'LP'
        ]);
        DB::table('cities')->insert([
            'name' => 'CHUQUISACA',
            'ext_1' => 'CH'
        ]);
        DB::table('cities')->insert([
            'name' => 'COCHABAMBA',
            'ext_1' => 'CB'
        ]);
        DB::table('cities')->insert([
            'name' => 'BENI',
            'ext_1' => 'BN'
        ]);
        DB::table('cities')->insert([
            'name' => 'ORURO',
            'ext_1' => 'OR'
        ]);
        DB::table('cities')->insert([
            'name' => 'PANDO',
            'ext_1' => 'PA'
        ]);
        DB::table('cities')->insert([
            'name' => 'POTOSI',
            'ext_1' => 'PO'
        ]);
        DB::table('cities')->insert([
            'name' => 'SANTA CRUZ',
            'ext_1' => 'SC'
        ]);
        DB::table('cities')->insert([
            'name' => 'TARIJA',
            'ext_1' => 'TA'
        ]);
    }
}
