<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('countries')->insert([
            ['name' => 'Estonia', 'code' => '+372'],
            ['name' => 'Latvia', 'code' => '+371'],
            ['name' => 'Lithuania', 'code' => '+370'],
        ]);
    }
}
