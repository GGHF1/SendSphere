<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        if (DB::table('countries')->count() === 0) {
            $this->call(CountriesSeeder::class);
        }

        if (DB::table('cities')->count() === 0) {
            $this->call(CitiesSeeder::class);
        }
    }
}
