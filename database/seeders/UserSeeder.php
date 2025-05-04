<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        if (! app()->isProduction()) {
            $password = Hash::make('password');

            // Usuarios especiales
            $root = User::updateOrCreate(
                ['email' => 'root@like.cl'],
                [
                    'name' => 'Luis Sepulveda',
                    'password' => $password,
                ]
            );
            $root->syncRoles(['root']);

            $admin = User::updateOrCreate(
                ['email' => 'admin@like.cl'],
                [
                    'name' => 'Gabriela Mordor',
                    'password' => $password,
                ]
            );
            $admin->syncRoles(['admin']);

            $standard = User::updateOrCreate(
                ['email' => 'standard@like.cl'],
                [
                    'name' => 'Linus Torvalds',
                    'password' => $password,
                ]
            );
            $standard->syncRoles(['standard']);

            // 25 usuarios sin rol
            User::factory(25)->create([
                'password' => $password,
            ]);

            // 50 usuarios con rol standard
            User::factory(50)->create([
                'password' => $password,
            ])->each(function ($user) {
                $user->syncRoles(['standard']);
            });
        }
    }
}
