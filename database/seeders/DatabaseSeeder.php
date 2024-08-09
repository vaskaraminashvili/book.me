<?php

namespace Database\Seeders;

use App\Models\Rent;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        //        Flat::factory(10)->create();
        Rent::factory(100)->create();

        User::factory()->create([
            'name'     => 'Test User',
            'email'    => 'user@user.com',
            'password' => Hash::make('password'),
        ]);
    }

}
