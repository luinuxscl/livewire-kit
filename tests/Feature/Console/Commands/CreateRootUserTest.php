<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

beforeEach(function () {
    // Configurar la base de datos en memoria para pruebas
    config(['database.default' => 'sqlite']);
    config(['database.connections.sqlite.database' => ':memory:']);
    
    // Asegurarse de que el rol 'root' existe
    Role::firstOrCreate(['name' => 'root']);
    
    // Limpiar usuarios existentes
    User::truncate();
    
    // Verificar que la base de datos está vacía
    $this->assertEquals(0, User::count(), 'La base de datos no está vacía al inicio de la prueba');
});

test('crea un nuevo usuario root con todos los parámetros', function () {
    // Ejecutar el comando con parámetros
    $email = 'test@example.com';
    $name = 'Test User';
    $password = 'password123';

    // Verificar que el usuario no existe antes de la prueba
    $this->assertNull(User::where('email', $email)->first(), 'El usuario ya existe antes de la prueba');

    // Ejecutar el comando con captura de salida
    $this->artisan('likeplatform:root', [
        'name' => $name,
        'email' => $email,
        'password' => $password,
    ])->assertExitCode(0);
    
    // Verificar que el comando no generó errores
    $this->assertDatabaseHas('users', [
        'email' => $email,
    ]);

    // Verificar que el usuario se creó correctamente
    $user = User::where('email', $email)->first();
    
    // Depuración
    if ($user) {
        echo "\n[DEBUG] Usuario encontrado:";
        echo "\n- ID: " . $user->id;
        echo "\n- Nombre: " . $user->name;
        echo "\n- Email: " . $user->email;
        echo "\n- Email verificado: " . ($user->email_verified_at ? $user->email_verified_at->toDateTimeString() : 'NULL');
        echo "\n- Contraseña: " . ($user->password ? '***' : 'NULL');
        echo "\n- Roles: " . json_encode($user->getRoleNames()->toArray());
        
        // Verificar los datos en bruto de la base de datos
        $rawUser = \DB::table('users')->where('email', $email)->first();
        if ($rawUser) {
            echo "\n\n[DEBUG] Datos en bruto de la base de datos:";
            echo "\n- email_verified_at: " . ($rawUser->email_verified_at ?: 'NULL');
            echo "\n- created_at: " . $rawUser->created_at;
            echo "\n- updated_at: " . $rawUser->updated_at;
        }
        
        echo "\n";
    } else {
        echo "\n[ERROR] No se encontró el usuario después de ejecutar el comando\n";
        
        // Mostrar todos los usuarios en la base de datos para depuración
        $allUsers = User::all();
        if ($allUsers->isNotEmpty()) {
            echo "\n[DEBUG] Usuarios en la base de datos:";
            foreach ($allUsers as $u) {
                echo "\n- ID: {$u->id}, Email: {$u->email}, Verificado: " . ($u->email_verified_at ? 'Sí' : 'No');
            }
            echo "\n";
        } else {
            echo "\n[DEBUG] No hay usuarios en la base de datos\n";
        }
    }

    // Verificaciones
    $this->assertNotNull($user, 'El usuario no se creó correctamente');
    $this->assertEquals($name, $user->name, 'El nombre del usuario no coincide');
    $this->assertTrue(Hash::check($password, $user->password), 'La contraseña no coincide');
    $this->assertNotNull($user->email_verified_at, 'El correo no está verificado');
    $this->assertTrue($user->hasRole('root'), 'El usuario no tiene el rol root');
});

test('actualiza un usuario existente', function () {
    // Crear un usuario existente
    $email = 'existing@example.com';
    $user = User::factory()->create([
        'email' => $email,
        'email_verified_at' => null, // No verificado inicialmente
    ]);

    // Ejecutar el comando para actualizar el usuario
    $newName = 'Updated Name';
    $newPassword = 'newpassword123';

    $this->artisan('likeplatform:root', [
        'name' => $newName,
        'email' => $email,
        'password' => $newPassword,
    ])->assertSuccessful();

    // Recargar el usuario de la base de datos
    $user->refresh();
    
    // Verificar que los datos se actualizaron correctamente
    expect($user->name)->toBe($newName)
        ->and(Hash::check($newPassword, $user->password))->toBeTrue()
        ->and($user->email_verified_at)->not->toBeNull()
        ->and($user->hasRole('root'))->toBeTrue();
});

test('solicita datos faltantes de forma interactiva', function () {
    // Simular entradas del usuario
    $this->artisan('likeplatform:root')
         ->expectsQuestion('Nombre del usuario', 'Interactive User')
         ->expectsQuestion('Correo electrónico', 'interactive@example.com')
         ->expectsQuestion('Contraseña', 'interactive123')
         ->assertSuccessful();

    // Verificar que el usuario se creó correctamente
    $user = User::where('email', 'interactive@example.com')->first();
    
    expect($user)->not->toBeNull()
        ->and($user->name)->toBe('Interactive User')
        ->and($user->email_verified_at)->not->toBeNull()
        ->and($user->hasRole('root'))->toBeTrue();
});

test('actualiza usuario existente sin cambiar la contraseña si no se proporciona', function () {
    // Crear un usuario existente con contraseña conocida
    $email = 'nopasswordchange@example.com';
    $originalPassword = 'original123';
    $user = User::factory()->create([
        'email' => $email,
        'password' => Hash::make($originalPassword),
        'email_verified_at' => null,
    ]);

    // Ejecutar el comando sin proporcionar contraseña
    $this->artisan('likeplatform:root', [
        'name' => 'No Password Change',
        'email' => $email,
    ])
    ->expectsQuestion('Contraseña', '') // Simular que no se proporciona contraseña
    ->assertSuccessful();

    // Recargar el usuario de la base de datos
    $user->refresh();
    
    // Verificar que la contraseña no cambió
    expect(Hash::check($originalPassword, $user->password))->toBeTrue()
        ->and($user->email_verified_at)->not->toBeNull();
});
