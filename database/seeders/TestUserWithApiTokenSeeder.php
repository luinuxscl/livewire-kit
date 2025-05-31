<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class TestUserWithApiTokenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Crear o encontrar el usuario de prueba
        $user = User::find(1);

        // Nombre del token (puedes cambiarlo)
        $tokenName = 'test-api-token';
        $plainTextToken = null;

        // Revocar tokens antiguos con el mismo nombre para este usuario, si existen
        $user->tokens()->where('name', $tokenName)->delete();

        // Crear un nuevo token
        $token = $user->createToken($tokenName);
        $plainTextToken = $token->plainTextToken;

        // Mostrar el token en la consola para copiarlo fácilmente
        $this->command->info('Test API User created/found: testapi@example.com');
        $this->command->info('API Token Name: ' . $tokenName);
        $this->command->warn('Plain Text API Token (copiar y guardar en lugar seguro): ' . $plainTextToken);
        Log::info('Test API User Token: ' . $plainTextToken); // También lo guardamos en el log
    }
}
