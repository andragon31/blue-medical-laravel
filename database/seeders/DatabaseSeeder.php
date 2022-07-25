<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ContractSeeder::class);
        $this->call(VehiclesSeeder::class);
        $this->call(DailyLogSeeder::class);
        $this->call(MensualLogSeeder::class);
    }
}
