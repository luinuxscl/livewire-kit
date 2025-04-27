# Documentación de paquetes requeridos

Esta aplicación utiliza los siguientes paquetes principales. Aquí se documenta su propósito y utilidad de manera sencilla para referencia del equipo de desarrollo.

---

## Paquetes base de Laravel 12
- **laravel/framework**: Framework principal de la aplicación, provee toda la estructura MVC, routing, Eloquent, etc.
- **laravel/tinker**: Permite interactuar con la app vía consola (REPL) para pruebas y debugging.

---

## UI y componentes
- **livewire/flux**: Permite construir interfaces reactivas y modernas usando componentes Livewire y sintaxis declarativa.
- **livewire/volt**: Facilita la creación de componentes Livewire usando sintaxis simplificada y moderna.

---

## Gestión de roles y permisos
- **spatie/laravel-permission**  
  [github.com/spatie/laravel-permission](https://github.com/spatie/laravel-permission)
  - Permite asignar roles y permisos a usuarios de manera sencilla y flexible.
  - Es el estándar de facto en Laravel para control de acceso.

---

## Tablas dinámicas y avanzadas
- **rappasoft/laravel-livewire-tables**  
  [github.com/rappasoft/laravel-livewire-tables](https://github.com/rappasoft/laravel-livewire-tables)
  - Permite crear tablas interactivas, ordenables, filtrables y paginadas usando Livewire.
  - Útil para paneles de administración y vistas de datos complejos.

---

## Testing y desarrollo
- **pestphp/pest**: Framework de testing moderno y expresivo para PHP.
- **fakerphp/faker**: Genera datos de prueba aleatorios para testing y seeders.
- **mockery/mockery**: Herramienta para mocks y pruebas unitarias.
- **laravel/pint**: Formateador de código automático para mantener estilo consistente.
- **nunomaduro/collision**: Mejora la visualización de errores en consola.
- **laravel/sail**: Entorno de desarrollo Docker para Laravel (opcional).
- **laravel/pail**: Visualización de logs en tiempo real (opcional).

---

> Si se agrega un nuevo paquete relevante, recuerda actualizar este archivo y justificar brevemente su inclusión.
