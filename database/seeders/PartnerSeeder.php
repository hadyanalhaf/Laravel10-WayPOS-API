<?php

namespace Database\Seeders;

use App\Models\Partner;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PartnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Partner::create([
            'name' => fake('id_ID')->name(),
            'photo' => null,
            'address' => fake('id_ID')->address()
        ]);
        Partner::create([
            'name' => fake('id_ID')->name(),
            'photo' => null,
            'address' => fake('id_ID')->address()
        ]);
    }
}
