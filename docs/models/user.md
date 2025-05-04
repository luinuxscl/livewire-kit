# Modelo User

Este documento describe el modelo `User` y sus características.

## Descripción

El modelo `User` representa a los usuarios del sistema. Al crearse un usuario, automáticamente se crea un `Profile` asociado.

## Campos

- `id` (auto-incremental)
- `name` (string)
- `email` (string)
- `password` (string)
- `created_at` y `updated_at`

## Relaciones

- `User` tiene una relación `hasOne` con `Profile`.

## Comportamiento

- Al crearse un `User`, se dispara el evento `created` que genera un `Profile` vacío.

## Uso en Código

```php
// Crear un usuario y se crea su profile automáticamente
$user = User::create([    
    'name' => 'María Pérez',
    'email' => 'maria@example.com',
    'password' => bcrypt('secret'),
]);

// Acceder al profile
$profile = $user->profile;
```
