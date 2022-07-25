<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\daily_log;

class DailyLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //VEHICULOS OFICIALES
        daily_log::create([
            'plate_vehicle' => 'FGO4312',
            'check_in' => Carbon::parse('2022-07-20 06:00:00.0'),
            'check_out' => Carbon::parse('2022-07-20 08:00:00.0'),
            'duration' => 120,
            'paid' => true,
            'total_pay' => 0
        ]);

        daily_log::create([
            'plate_vehicle' => 'ACH1057',
            'check_in' => Carbon::parse('2022-07-20 06:00:00.0'),
            'check_out' => Carbon::parse('2022-07-20 08:00:00.0'),
            'duration' => 120,
            'paid' => true,
            'total_pay' => 0
        ]);

        daily_log::create([
            'plate_vehicle' => 'YTH1745',
            'check_in' => Carbon::parse('2022-07-20 06:00:00.0'),
            'check_out' => Carbon::parse('2022-07-20 08:00:00.0'),
            'duration' => 120,
            'paid' => true,
            'total_pay' => 0
        ]);

        daily_log::create([
            'plate_vehicle' => 'KTG7890',
            'check_in' => Carbon::parse('2022-07-20 06:00:00.0'),
            'check_out' => Carbon::parse('2022-07-20 08:00:00.0'),
            'duration' => 120,
            'paid' => true,
            'total_pay' => 0
        ]);

        daily_log::create([
            'plate_vehicle' => 'LPM8923',
            'check_in' => Carbon::parse('2022-07-20 06:00:00.0'),
            'check_out' => Carbon::parse('2022-07-20 08:00:00.0'),
            'duration' => 120,
            'paid' => true,
            'total_pay' => 0
        ]);

        //VEHICULOS RESIDENTES
        daily_log::create([
            'plate_vehicle' => 'QWE2345',
            'check_in' => Carbon::parse('2022-07-20 06:00:00.0'),
            'check_out' => Carbon::parse('2022-07-20 08:00:00.0'),
            'duration' => 120,
            'paid' => true,
            'total_pay' => 6
        ]);

        daily_log::create([
            'plate_vehicle' => 'QAZ1234',
            'check_in' => Carbon::parse('2022-07-20 06:00:00.0'),
            'check_out' => Carbon::parse('2022-07-20 08:00:00.0'),
            'duration' => 120,
            'paid' => true,
            'total_pay' => 6
        ]);

        daily_log::create([
            'plate_vehicle' => 'PLO7896',
            'check_in' => Carbon::parse('2022-07-20 06:00:00.0'),
            'check_out' => Carbon::parse('2022-07-20 08:00:00.0'),
            'duration' => 120,
            'paid' => true,
            'total_pay' => 6
        ]);

        daily_log::create([
            'plate_vehicle' => 'TGB5678',
            'check_in' => Carbon::parse('2022-07-20 06:00:00.0'),
            'check_out' => Carbon::parse('2022-07-20 08:00:00.0'),
            'duration' => 120,
            'paid' => true,
            'total_pay' => 6
        ]);
    }
}
