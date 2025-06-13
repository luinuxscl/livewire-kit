<?php

use Laravel\Sanctum\Sanctum;

return [

    /*
    |--------------------------------------------------------------------------
    | Stateful Domains
    |--------------------------------------------------------------------------
    |
    | Requests from the following domains / hosts will receive stateful API
    | authentication cookies. Typically, these should include your local
    | and production domains which access your API via a frontend SPA.
    |
    */

    'stateful' => explode(',', env('SANCTUM_STATEFUL_DOMAINS', sprintf(
        '%s%s',
        'localhost,localhost:3000,127.0.0.1,127.0.0.1:8000,::1',
        Sanctum::currentApplicationUrlWithPort(),
        // Sanctum::currentRequestHost(),
    ))),

    /*
    |--------------------------------------------------------------------------
    | Sanctum Guards
    |--------------------------------------------------------------------------
    |
    | Este array contiene los Guards de autenticación que serán verificados cuando
    | Sanctum intente autenticar una solicitud. Si ninguno de estos guardias
    | puede autenticar la solicitud, Sanctum utilizará el token bearer
    | que está presente en una solicitud entrante para la autenticación.
    |
    */

    'guard' => ['web'],

    /*
    |--------------------------------------------------------------------------
    | Expiration Minutes
    |--------------------------------------------------------------------------
    |
    | Este valor controla el número de minutos hasta que un token emitido se
    | considerará expirado. Esto anulará cualquier valor establecido en el atributo
    | "expires_at" del token, pero las sesiones de primera parte no se ven afectadas.
    |
    */

    'expiration' => null,

    /*
    |--------------------------------------------------------------------------
    | Token Prefix
    |--------------------------------------------------------------------------
    |
    | Sanctum puede prefijar nuevos tokens para aprovechar numerosos
    | iniciativas de escaneo de seguridad mantenidas por plataformas de código abierto
    | que notifican a los desarrolladores si cometen tokens en repositorios.
    |
    | Ver: https://docs.github.com/en/code-security/secret-scanning/about-secret-scanning
    |
    */

    'token_prefix' => env('SANCTUM_TOKEN_PREFIX', ''),

    /*
    |--------------------------------------------------------------------------
    | Middleware de Sanctum
    |--------------------------------------------------------------------------
    |
    | Cuando autenticas tu primera parte SPA con Sanctum, puedes necesitar
    | personalizar algunos de los middleware que Sanctum utiliza mientras
    | procesa la solicitud. Puedes cambiar el middleware listado a continuación
    | según sea necesario.
    |
    */

    'middleware' => [
        'authenticate_session' => Laravel\Sanctum\Http\Middleware\AuthenticateSession::class,
        'encrypt_cookies' => Illuminate\Cookie\Middleware\EncryptCookies::class,
        'validate_csrf_token' => Illuminate\Foundation\Http\Middleware\ValidateCsrfToken::class,
    ],

];
