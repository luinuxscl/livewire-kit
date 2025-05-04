<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        if (!app()->isProduction()) {
            $password = Hash::make('password');

            $users = [
                [
                    'email' => 'root@like.cl',
                    'first_name' => 'Luis',
                    'last_name' => 'Sepulveda',
                    'phone' => '56933594534',
                    'address' => 'Ramon Toro Ibanez 5100, Macul',
                    'birthday' => '1979-03-05',
                    'bio' => 'Un pobre y triste weon',
                    'role' => 'root',
                ],
                [
                    'email' => 'admin@like.cl',
                    'first_name' => 'Acid',
                    'last_name' => 'Burn',
                    'phone' => '56933594534',
                    'address' => 'Amador Neghme Rodriguez 3714, Macul',
                    'birthday' => '1979-03-05',
                    'bio' => 'Kate Libby. Hacker experta.',
                    'role' => 'admin',
                ],
                [
                    'email' => 'barby_root@like.cl',
                    'first_name' => 'Barbara',
                    'last_name' => 'Gordon',
                    'role' => 'root',
                    'phone' => '56933594534',
                    'address' => 'Amador Neghme Rodriguez 3714, Macul',
                    'birthday' => '1979-03-05',
                    'bio' => 'Oracle en los cómics de DC (hacker y bibliotecaria badass)',
                ],
            ];

            foreach ($users as $userData) {
                $newUser = User::updateOrCreate(
                    ['email' => $userData['email']],
                    [
                        'name' => $userData['first_name'] . ' ' . $userData['last_name'],
                        'password' => $password,
                    ]
                );

                $newUser->profile()->update([
                    'first_name' => $userData['first_name'],
                    'last_name'  => $userData['last_name'],
                ]);

                if (!empty($userData['role'])) {
                    $newUser->syncRoles($userData['role']);
                }
            }

            User::factory()->count(98)->create();
        }
    }
}
