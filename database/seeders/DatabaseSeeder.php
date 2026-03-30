<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Mauro Ramirez',
            'email' => 'mauro@correo.com',
            'password' => Hash::make('mauro2026')
        ]);

        User::factory()->create([
            'name' => 'Usuario 1',
            'email' => 'user1@correo.com',
            'password' => Hash::make('usuario12026')
        ]);

        User::factory()->create([
            'name' => 'Usuario 2',
            'email' => 'user2@correo.com',
            'password' => Hash::make('usuario22026')
        ]);

        $this->call([
            PharmacovigilanceSeeder::class,
        ]);
    }
}
