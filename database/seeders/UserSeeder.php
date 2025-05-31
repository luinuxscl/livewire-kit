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
            $now = now();

            $users = [
                [
                    'email' => 'luis@like.cl',
                    'first_name' => 'Luis',
                    'last_name' => 'Sepulveda',
                    'phone' => '56933594534',
                    'address' => 'Ramon Toro Ibanez 5100, Macul',
                    'birthday' => '1979-03-05',
                    'bio' => 'Un pobre y triste weon',
                    'role' => 'root',
                    'avatar' => 'avatars/examples/luinux.jpeg'
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
                    'avatar' => 'avatars/examples/acidburn.jpg'
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
                    'avatar' => 'avatars/examples/oracle.jpeg'
                ],
                [
                    'email' => 'gaby@like.cl',
                    'first_name' => 'Gaby',
                    'last_name' => 'Mordoj',
                    'role' => 'admin',
                    'phone' => '56933594534',
                    'address' => 'Amador Neghme Rodriguez 3714, Macul',
                    'birthday' => '1979-03-05',
                    'bio' => 'La mas pulenta vendedora',
                    'avatar' => 'avatars/examples/gaby.png'
                ],
                [
                    'email' => 'black_widow@like.cl',
                    'first_name' => 'Black',
                    'last_name' => 'Widow',
                    'role' => 'admin',
                    'phone' => '56933594534',
                    'address' => 'Amador Neghme Rodriguez 3714, Macul',
                    'birthday' => '1979-03-05',
                    'bio' => 'La mas pulenta vendedora',
                    'avatar' => 'avatars/examples/black_widow.jpg'
                ],
                [
                    'email' => 'mr_robot@like.cl',
                    'first_name' => 'Mr',
                    'last_name' => 'Robot',
                    'role' => 'admin',
                    'phone' => '56933594534',
                    'address' => 'Amador Neghme Rodriguez 3714, Macul',
                    'birthday' => '1979-03-05',
                    'bio' => 'La mas pulenta vendedora',
                    'avatar' => 'avatars/examples/mr-robot.jpg'
                ],
                [
                    'email' => 'standard@like.cl',
                    'first_name' => 'Penelope',
                    'last_name' => 'Cruz',
                    'phone' => '56933594534',
                    'address' => 'Madrid, España',
                    'birthday' => '1974-04-28',
                    'bio' => 'Penélope Cruz nació el 28 de abril de 1974 en Madrid, España. Es una actriz y productora, conocida por Vicky Cristina Barcelona (2008), Vanilla Sky (2001) y Volver (2006). Está casada con Javier Bardem desde julio de 2010',
                    'avatar' => 'avatars/examples/penelope.jpg'
                ],
            ];

            foreach ($users as $userData) {
                $newUser = User::updateOrCreate(
                    ['email' => $userData['email']],
                    [
                        'name' => $userData['first_name'] . ' ' . $userData['last_name'],
                        'password' => $password,
                        'email_verified_at' => $now,
                    ]
                );

                $newUser->profile()->update([
                    'first_name' => $userData['first_name'],
                    'last_name'  => $userData['last_name'],
                    'phone' => $userData['phone'],
                    'address' => $userData['address'],
                    'birthday' => $userData['birthday'],
                    'bio' => $userData['bio'],
                    'avatar' => $userData['avatar'],
                ]);

                if (!empty($userData['role'])) {
                    $newUser->syncRoles($userData['role']);
                }
            }

            User::factory()->count(98)->create();
        }
    }
}
