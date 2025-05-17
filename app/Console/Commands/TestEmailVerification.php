<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class TestEmailVerification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:verification-email {email} {--resend}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Enviar un correo de verificación de prueba';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->argument('email');
        $resend = $this->option('resend');

        // Buscar usuario por email o crear uno de prueba
        $user = User::firstOrNew(['email' => $email]);
        
        if (!$user->exists) {
            $user->name = 'Usuario de Prueba';
            $user->password = bcrypt('password');
            $user->save();
            $this->info("Usuario de prueba creado con email: $email");
        }

        if ($resend || !$user->hasVerifiedEmail()) {
            $user->sendEmailVerificationNotification();
            $this->info("Correo de verificación enviado a: $email");
        } else {
            $this->info("El usuario ya ha verificado su correo. Usa --resend para forzar el reenvío.");
        }
    }
}
