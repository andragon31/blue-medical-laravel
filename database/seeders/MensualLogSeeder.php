<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\mensual_log;
use Carbon\Carbon;

class MensualLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        mensual_log::create([
            'start_date' => Carbon::parse('2022-07-01 00:00:00.0')
        ]);
    }
}
