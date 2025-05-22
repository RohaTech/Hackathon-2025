<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {




        User::factory()->create([
            'name' => 'Nahom Abraham',
            'email' => 'nahomrak0916@gmail.com',
            'password' => Hash::make('Pa$$w0rd!'),
            'role' => 'finance',
        ]);

        User::factory()->create([
            'name' => 'Natanel Abebe',
            'email' => 'natanelabebe547@gmail.com',
            'password' => Hash::make('Pa$$w0rd!'),
            'role' => 'head_finance',
        ]);
    }
}
