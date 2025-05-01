# Tablas con PowerGrid: Estándar y mejores prácticas

En este proyecto, todas las tablas deben implementarse utilizando **PowerGrid v6+** (`power-components/livewire-powergrid`). A continuación se documenta el patrón recomendado, tomando como ejemplo la tabla de usuarios (`UserTable.php`), que integra vistas personalizadas, componentes y modales.

---

## 1. Estructura básica de una tabla PowerGrid

La clase debe extender `PowerGridComponent` e implementar los métodos principales:

```php
final class UserTable extends PowerGridComponent
{
    public function datasource(): Builder
    {
        return User::query();
    }
    // ...
}
```

---

## 2. Columnas con componentes Blade

Puedes usar componentes Blade personalizados en las columnas. Ejemplo: mostrar el rol del usuario con un badge visual.

```php
public function fields(): PowerGridFields
{
    return PowerGrid::fields()
        ->add('role', function(User $user) {
            return Blade::render('<x-role-badge :role="$role" />', [
                'role' => $user->getRoleNames()->first(),
            ]);
        });
}
```

---

## 3. Acciones desde vistas personalizadas

Las acciones pueden renderizarse usando una vista Blade, permitiendo incluir botones, iconos y lógica Alpine/FluxUI:

```php
public function actionsFromView($row): View
{
    return view('partials.tables.users-actions', ['row' => $row]);
}
```

Ejemplo de la vista (`partials.tables.users-actions.blade.php`):

```blade
<div class="flex justify-end">
    <flux:button
        size="xs"
        x-data
        x-on:click="$dispatch('openEditUserModal', { userId: {{ $row->id }} }); $flux.modal('edit-user').show();"
    >
        <svg ...></svg>
        {{ __('Edit') }}
    </flux:button>
</div>
```

---

## 4. Integración con modales FluxUI

Para editar registros, se recomienda usar modales declarados con `<flux:modal>`. Ejemplo de integración:

- El botón de acción dispara el modal y pasa el ID del usuario.
- El modal (`user-edit-modal.blade.php`) usa `wire:model` para enlazar datos.

```blade
<flux:modal name="edit-user">
    <flux:input wire:model="name" ... />
    <flux:input wire:model="email" ... />
    <flux:select wire:model="role">...</flux:select>
    <flux:modal.close>
        <flux:button>{{ __('Cancel') }}</flux:button>
    </flux:modal.close>
    <flux:button wire:click="updateUser">{{ __('Save') }}</flux:button>
</flux:modal>
```

---

## 5. Buenas prácticas

- **Siempre usar PowerGrid v6+ para nuevas tablas.**
- **Centralizar acciones en vistas Blade** para mayor flexibilidad.
- **Integrar componentes visuales** (como badges) para mejorar la UX.
- **Usar modales para edición** y flujos complejos, conectando con Livewire.
- **Mantener la documentación actualizada** con cada mejora o nuevo flujo.

---

> El archivo `UserTable.php` es el estándar a seguir para futuras tablas. Se recomienda revisarlo y mejorarlo continuamente para incorporar las mejores prácticas del proyecto.
