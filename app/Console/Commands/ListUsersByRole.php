<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Spatie\Permission\Models\Role;

class ListUsersByRole extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'likeplatform:user:list
                            {role? : Nombre del rol}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Listar usuarios por rol específico';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $roleName = $this->argument('role') ?? $this->ask('Nombre del rol a filtrar');

        if (! Role::where('name', $roleName)->exists()) {
            $this->error("El rol '{$roleName}' no existe.");
            return 1;
        }

        $users = User::role($roleName)->get();

        if ($users->isEmpty()) {
            $this->info("No se encontraron usuarios con el rol '{$roleName}'.");
            return 0;
        }

        $headers = ['ID', 'Nombre', 'Email'];
        $data = $users->map(fn($user) => [
            $user->id,
            $user->name,
            $user->email,
        ])->toArray();

        $this->table($headers, $data);
        return 0;
    }
}
