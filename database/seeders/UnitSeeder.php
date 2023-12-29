<?php

namespace Database\Seeders;

use App\Models\Unit;
use App\Models\UnitConversion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Unit
        Unit::create([
            'name' => 'Pcs',
            'short_name' => 'pcs',
            'active' => true
        ]);
        Unit::create([
            'name' => 'Lusin',
            'short_name' => 'lusin',
            'active' => true
        ]);
        Unit::create([
            'name' => 'Box',
            'short_name' => 'box',
            'active' => true
        ]);

        // Unit conversion
        UnitConversion::create([
            'origin_id' => 1,
            'result_id' => 2,
            'factor' => (1 / 12)
        ]);
        UnitConversion::create([
            'origin_id' => 2,
            'result_id' => 1,
            'factor' => 12
        ]);
        UnitConversion::create([
            'origin_id' => 1,
            'result_id' => 3,
            'factor' => (1 / 120)
        ]);
        UnitConversion::create([
            'origin_id' => 3,
            'result_id' => 1,
            'factor' => 120
        ]);
        UnitConversion::create([
            'origin_id' => 2,
            'result_id' => 3,
            'factor' => (1 / 10)
        ]);
        UnitConversion::create([
            'origin_id' => 3,
            'result_id' => 2,
            'factor' => 10
        ]);
    }
}
