<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Ejecuta los seeders de roles y usuarios
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            OptionsTableSeeder::class,
            // TestUserWithApiTokenSeeder::class, // Seeder para usuario con token API de prueba
            //PromptsSeeder::class,
        ]);
    }
}
