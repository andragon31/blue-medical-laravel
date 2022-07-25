<?php

namespace Database\Seeders;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\vehicle;

class VehiclesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //VEHICULOS OFICIALES
        vehicle::create([
            'plate' => 'FGO4312',
            'id_Contract' => 1,
            'state' => true
        ]);

        vehicle::create([
            'plate' => 'ACH1057',
            'id_Contract' => 1,
            'state' => true
        ]);

        vehicle::create([
            'plate' => 'YTH1745',
            'id_Contract' => 1,
            'state' => true
        ]);

        vehicle::create([
            'plate' => 'KTG7890',
            'id_Contract' => 1,
            'state' => true
        ]);

        vehicle::create([
            'plate' => 'LPM8923',
            'id_Contract' => 1,
            'state' => true
        ]);

        //VEHICULOS RESIDENTES
        vehicle::create([
            'plate' => 'QWE2345',
            'id_Contract' => 2,
            'state' => true
        ]);

        vehicle::create([
            'plate' => 'QAZ1234',
            'id_Contract' => 2,
            'state' => true
        ]);

        vehicle::create([
            'plate' => 'PLO7896',
            'id_Contract' => 2,
            'state' => true
        ]);

        vehicle::create([
            'plate' => 'TGB5678',
            'id_Contract' => 2,
            'state' => true
        ]);
    }
}
