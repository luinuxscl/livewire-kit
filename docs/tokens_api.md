# Sistema de Gestión de Tokens API con Laravel Sanctum

Este documento describe la arquitectura y uso del sistema de gestión de tokens API implementado en este proyecto usando Laravel Sanctum, Livewire y PowerGrid.

---

## ¿Qué es Laravel Sanctum?
Sanctum es un paquete oficial de Laravel para autenticación de APIs mediante tokens personales, ideal para SPAs y aplicaciones móviles.

## Funcionalidades implementadas
- **Generación de tokens personales**: cada usuario puede crear múltiples tokens con nombre y expiración personalizada.
- **Revocación individual y masiva**: puedes revocar un token específico o todos los tokens desde la interfaz.
- **Visualización y gestión**: tabla interactiva con PowerGrid mostrando nombre, fecha de creación, expiración y acciones.
- **Notificaciones**: confirmaciones visuales mediante toast.
- **Modal seguro para mostrar tokens**: el token generado solo se muestra una vez y de forma segura en un modal.
- **Soporte para modo claro y oscuro**: integración visual total con Tailwind y FluxUI.

## Estructura técnica
- **Backend**: Laravel 12, Sanctum, Livewire 3
- **Frontend**: Livewire PowerGrid, FluxUI Essentials (modals, toasts)

## Flujos principales
### 1. Generar un token
- El usuario ingresa nombre y expiración.
- Al hacer clic en "Generate Token", se valida y crea el token usando Sanctum.
- El token se muestra en un modal seguro y se puede copiar.
- Aparece una notificación toast de éxito.

### 2. Revocar un token
- En la tabla, cada token tiene un botón "Revocar".
- Al hacer clic, se elimina el token y la tabla se refresca automáticamente.
- Se muestra una notificación toast de advertencia.

### 3. Revocar todos los tokens
- Botón "Revoke All" debajo de la tabla.
- Elimina todos los tokens del usuario y refresca la tabla.
- Notificación toast de advertencia.

## Seguridad
- Los tokens solo pueden ser gestionados por el usuario autenticado.
- El valor del token solo se muestra una vez tras su creación.
- Expiración configurable para mayor control.

## Código relevante
- **Componente principal**: `App/Livewire/ApiTokenManager.php`
- **Tabla PowerGrid**: `App/Livewire/TokenTable.php`
- **Vista principal**: `resources/views/livewire/api-token-manager.blade.php`
- **Modal y Toast**: Usando FluxUI Essentials

## Personalización
Puedes modificar la expiración, estilos visuales y lógica de revocación según tus necesidades. Toda la interfaz es responsiva y compatible con modo oscuro.

---

## Referencias
- [Laravel Sanctum](https://laravel.com/docs/12.x/sanctum)
- [Livewire](https://livewire.laravel.com/)
- [PowerGrid](https://livewire-powergrid.com/)
- [FluxUI](https://fluxui.dev/components/modal)
