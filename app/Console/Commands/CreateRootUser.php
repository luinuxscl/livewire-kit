<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class CreateRootUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'likeplatform:root
                            {name? : Nombre del usuario}
                            {email? : Correo electrónico del usuario}
                            {password? : Contraseña del usuario}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crear o actualizar un usuario con rol root';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $name = $this->argument('name') ?? $this->ask('Nombre del usuario');
        $email = $this->argument('email') ?? $this->ask('Correo electrónico');
        $password = $this->argument('password') ?? $this->secret('Contraseña');

        $roleName = 'root';
        // Crear el rol si no existe
        Role::firstOrCreate(['name' => $roleName]);

        // Buscar usuario existente o crear uno nuevo
        $user = User::firstOrNew(['email' => $email]);
        
        // Actualizar atributos
        $user->name = $name;
        $user->email_verified_at = now();
        
        // Solo actualizar la contraseña si se proporcionó una
        if (!empty($password)) {
            $user->password = Hash::make($password);
        }
        
        $user->save();

        // Asignar rol
        $user->assignRole($roleName);

        $this->info("Usuario root creado o actualizado: {$user->email}");

        return 0;
    }
}
