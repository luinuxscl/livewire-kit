# Modelo Profile

Este documento describe el modelo `Profile` y sus características.

## Descripción

El modelo `Profile` almacena información adicional del usuario, como nombre, apellido, teléfono, dirección, fecha de nacimiento, biografía y avatar.

## Migraciones

El archivo de migración `create_profiles_table` define la tabla `profiles` con las siguientes columnas:

- `id` (auto-incremental)
- `user_id` (clave foránea a `users`)
- `first_name` (string)
- `last_name` (string)
- `phone` (string, nullable)
- `address` (string, nullable)
- `birthday` (date, nullable)
- `bio` (text, nullable)
- `avatar` (string, nullable)
- `created_at` y `updated_at`

## Relaciones

- `Profile` pertenece a `User`.

## Uso en Código

```php
// Obtener el perfil de un usuario
$profile = $user->profile;

// Crear perfil para un usuario
Profile::create([
    'user_id' => $user->id,
    'first_name' => 'Juan',
    // ... otros campos
]);
```
