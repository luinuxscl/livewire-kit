<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Crea los roles base
        Role::firstOrCreate(['name' => 'root']);
        Role::firstOrCreate(['name' => 'admin']);
        Role::firstOrCreate(['name' => 'standard']);
    }
}
