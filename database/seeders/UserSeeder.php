<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Make Administrator
        User::create([
            'branch_id' => null,
            'name' => 'Administrator',
            'email' => 'admin@mail.com',
            'password' => Hash::make('12345678'),
            'role' => 'admin',
            'active' => true
        ]);
        // Make Mitra 1
        User::create([
            'branch_id' => 1,
            'name' => fake('id_ID')->name(),
            'email' => 'mitra1@mail.com',
            'password' => Hash::make('12345678'),
            'role' => 'mitra',
            'active' => true
        ]);
        // Make Cashier 1
        User::create([
            'branch_id' => 1,
            'name' => fake('id_ID')->name(),
            'email' => 'cashier1@mail.com',
            'password' => Hash::make('12345678'),
            'role' => 'mitra',
            'active' => true
        ]);
        // Make Mitra 2
        User::create([
            'branch_id' => 2,
            'name' => fake('id_ID')->name(),
            'email' => 'mitra2@mail.com',
            'password' => Hash::make('12345678'),
            'role' => 'mitra',
            'active' => true
        ]);
        // Make Cashier 2
        User::create([
            'branch_id' => 2,
            'name' => fake('id_ID')->name(),
            'email' => 'cashier2@mail.com',
            'password' => Hash::make('12345678'),
            'role' => 'mitra',
            'active' => true
        ]);
    }
}
