<?php

namespace Database\Seeders;

use App\Models\Branch;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Branch::create([
            'partner_id' => 1,
            'branch_name' => 'Branch One',
            'open_time' => '08:00:00',
            'close_time' => '20:00:00',
            'lat' => null,
            'long' => null,
            'activated_at' => now()->toDateTimeString()
        ]);
        Branch::create([
            'partner_id' => 2,
            'branch_name' => 'Branch Two',
            'open_time' => '08:00:00',
            'close_time' => '20:00:00',
            'lat' => null,
            'long' => null,
            'activated_at' => now()->toDateTimeString()
        ]);
    }
}
