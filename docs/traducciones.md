# Procedimiento de Traducción y Convenciones

## Regla Obligatoria para Textos en la App

- **Todos los textos visibles para el usuario deben estar en inglés y envueltos en la función `__('Text')`.**
- **Cada vez que se agregue un texto nuevo, debe verificarse que la clave de traducción no exista previamente en `lang/es.json`. Si no existe, se agrega la traducción en español.**
- **No se deben duplicar claves de traducción.**
- **Los comentarios en el código están excluidos de esta regla y deben permanecer en español.**

### Ejemplo en PHP/Blade
```php
// Correcto:
session()->flash('error', __('Only a root user can edit another root user.'));

// Incorrecto:
session()->flash('error', 'Solo un usuario root puede editar a otro root.');
```

### Ejemplo en Blade
```blade
{{ __('Go to Roles') }}
```

## Procedimiento recomendado
1. Escribe el texto en inglés y envuélvelo en `__()`.
2. Busca la clave exacta en `lang/es.json`.
3. Si no existe, agrégala con su traducción en español.

## Notas
- Esta regla aplica a todo el código fuente, tanto PHP como Blade y JS (cuando corresponda).
- Los comentarios y documentación interna pueden permanecer en español.
- No es necesario documentar cada traducción agregada, solo seguir el procedimiento.
- Si tienes dudas, revisa este archivo antes de agregar nuevos textos.

---

Última actualización: 2025-05-01
