<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\contract;
use Carbon\Carbon;

class ContractSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        contract::create([
            'contract' => 'Oficial',
            'price' => 0,
            'state' => true,
            'created_at' => Carbon::now()
        ]);

        contract::create([
            'contract' => 'Residente',
            'price' => 0.05,
            'state' => true,
            'created_at' => Carbon::now()
        ]);

        contract::create([
            'contract' => 'No residente',
            'price' => 0.5,
            'state' => true,
            'created_at' => Carbon::now()
        ]);
    }
}
