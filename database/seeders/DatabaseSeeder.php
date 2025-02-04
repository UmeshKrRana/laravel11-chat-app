<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Dolly Kumari',
            'email' => 'dolly@example.com',
            'password' => Hash::make('123456'),
        ]);

        User::factory()->create([
            'name' => 'Umesh Rana',
            'email' => 'umesh@example.com',
            'password' => Hash::make('123456'),
        ]);

        User::factory()->create([
            'name' => 'Dudu Kumari',
            'email' => 'dudu@example.com',
            'password' => Hash::make('123456'),
        ]);

        User::factory()->create([
            'name' => 'Bubu Kumar',
            'email' => 'bubu@example.com',
            'password' => Hash::make('123456'),
        ]);
    }
}
