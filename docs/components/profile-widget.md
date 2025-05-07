# ProfileWidget

Componente para mostrar los datos del usuario y su perfil.

## Props

- `user` (App\Models\User|null): Instancia de usuario. Si no se pasa, utiliza `auth()->user()`.

## Uso

```blade
<x-ui.profile-widget :user="$user" />
```

Este componente renderiza dentro de un `<x-ui.card>` la siguiente información:

- Nombre completo (`$user->name`)
- Email (`$user->email`)
- Teléfono (`$user->profile->phone`)
- Dirección (`$user->profile->address`)
- Fecha de cumpleaños (`$user->profile->birthday`)
- Biografía (`$user->profile->bio`)
