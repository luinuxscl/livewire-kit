# Sistema de Notificaciones Toast

Este documento describe el sistema de notificaciones toast integrado en la aplicación. Las notificaciones toast proporcionan una forma visual y no intrusiva de comunicar mensajes al usuario.

## Características

- **Tipos de notificación**: Success, Info, Warning, Error
- **Comportamiento inteligente**:
  - Los mensajes de tipo `success` e `info` desaparecen automáticamente después de 8 segundos
  - Los mensajes de tipo `error` y `warning` persisten hasta que el usuario los cierra manualmente
  - Los mensajes de advertencia y error persisten incluso después de recargar la página
- **Estilo visual**:
  - Diseño congruente con FluxUI
  - Soporte para modo claro y oscuro
  - Íconos específicos para cada tipo de notificación
- **Accesibilidad**:
  - Roles ARIA incluidos para compatibilidad con lectores de pantalla
  - Animaciones sutiles para una mejor experiencia de usuario

## Implementación

El sistema está compuesto por:

1. **Componente Livewire**: `ToastManager.php`
2. **Vista Blade**: `livewire.toast-manager.blade.php`
3. **Integración en layout principal**: El componente se incluye automáticamente en `components.layouts.app.header`

## Cómo usar

### Desde un componente Livewire

Puedes disparar notificaciones toast desde cualquier componente Livewire usando el método `dispatch`:

```php
// Notificación de éxito (desaparece a los 8 segundos)
$this->dispatch('showToast', [
    'type' => 'success',
    'message' => __('Usuario creado exitosamente')
]);

// O con la sintaxis de parámetros nombrados
$this->dispatch('showToast', type: 'success', message: __('Usuario creado exitosamente'));

// Notificación de error (persiste hasta cierre manual)
$this->dispatch('showToast', [
    'type' => 'error',
    'message' => __('Ha ocurrido un error. Por favor, inténtelo nuevamente.')
]);

// Notificación de información
$this->dispatch('showToast', [
    'type' => 'info',
    'message' => __('Los cambios se están procesando')
]);

// Notificación de advertencia (persiste hasta cierre manual)
$this->dispatch('showToast', [
    'type' => 'warning',
    'message' => __('Esta acción no se puede deshacer')
]);
```

### Desde JavaScript

También puedes disparar notificaciones toast directamente desde JavaScript:

```javascript
// Versión con objeto
Livewire.dispatch('showToast', {
    type: 'success',
    message: 'Operación completada con éxito'
});

// O con parámetros separados
Livewire.dispatch('showToast', 'success', 'Operación completada con éxito');
```

### Desde controladores

En un controlador Laravel, puedes usar el helper de sesión para mostrar un toast en la siguiente carga de página:

```php
// En un controlador
public function store(Request $request)
{
    // ... lógica de guardado
    
    if ($success) {
        session()->flash('toast', [
            'type' => 'success',
            'message' => __('Registro guardado correctamente')
        ]);
    } else {
        session()->flash('toast', [
            'type' => 'error',
            'message' => __('Error al guardar el registro')
        ]);
    }
    
    return redirect()->route('home');
}
```

Y luego en el método `mount()` de ToastManager, se captura este mensaje de sesión:

```php
public function mount()
{
    // Capturar toast desde sesión (útil para redirects desde controladores)
    if (session()->has('toast')) {
        $this->addToast(session()->get('toast'));
    }
    
    // Restaurar toasts persistentes
    $this->toasts = session()->pull('persistent_toasts', []);
}
```

> **Nota**: Esta funcionalidad desde controladores requiere modificar el método `mount()` del componente ToastManager para capturar el mensaje flash de la sesión.

## Personalización

### Duración de los mensajes

Por defecto, los mensajes de éxito e información se muestran durante 8 segundos (8000ms). Puedes modificar esta duración en el método `addToast` del componente `ToastManager`:

```php
$duration = $persist ? null : 8000; // Cambiar 8000 por la duración deseada en milisegundos
```

### Estilos y apariencia

Los estilos visuales están definidos en `resources/views/livewire/toast-manager.blade.php`. Puedes personalizar:

- Colores y bordes para cada tipo de notificación
- Iconos
- Posición (actualmente aparecen en la esquina superior derecha)
- Animaciones de entrada y salida

## Extensión

Para añadir nuevos tipos de toast, deberías:

1. Modificar el método `addToast` en `ToastManager.php` para reconocer el nuevo tipo
2. Actualizar la lógica de persistencia según corresponda
3. Añadir los estilos para el nuevo tipo en la vista Blade

## Ejemplos de uso

### Formulario de contacto

```php
public function sendContactForm()
{
    try {
        // Lógica para enviar correo...
        
        $this->dispatch('showToast', [
            'type' => 'success',
            'message' => __('Mensaje enviado correctamente. Nos pondremos en contacto pronto.')
        ]);
        
        $this->reset(['name', 'email', 'message']);
    } catch (\Exception $e) {
        $this->dispatch('showToast', [
            'type' => 'error',
            'message' => __('No se pudo enviar el mensaje. Por favor, inténtelo más tarde.')
        ]);
    }
}
```

### Eliminar un registro

```php
public function deleteUser($userId)
{
    try {
        // Verificar permisos...
        // Eliminar usuario...
        
        $this->dispatch('showToast', [
            'type' => 'success',
            'message' => __('Usuario eliminado correctamente')
        ]);
    } catch (\Exception $e) {
        $this->dispatch('showToast', [
            'type' => 'error',
            'message' => __('Error al eliminar el usuario: ') . $e->getMessage()
        ]);
    }
}
```

## Consideraciones técnicas

- Las notificaciones se muestran en el orden en que se disparan
- Si se emiten múltiples notificaciones del mismo tipo, todas se mostrarán
- La vista de las notificaciones tiene un índice z-index alto (z-50) para asegurar que se muestren por encima de otros elementos