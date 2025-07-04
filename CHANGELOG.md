# Changelog

Todas las modificaciones importantes del proyecto se documentarán en este archivo siguiendo el formato [Keep a Changelog](https://keepachangelog.com/es/1.0.0/).

## [Unreleased]

### Added
- Sistema de notificaciones toast reutilizable
- Sistema de auditoría de acciones
- Integración con Livewire PowerGrid
- Soporte para Markdown con Spatie Laravel Markdown
- Panel de administración con FluxUI Essentials
- Sistema de autenticación y roles

### Changed
- Mejorada la estructura del proyecto siguiendo las mejores prácticas de Laravel
- Actualizadas dependencias a sus últimas versiones estables
- Optimizado el rendimiento de las consultas a la base de datos

### Fixed
- Corregidos problemas de sincronización en la interfaz de gestión de posts
- Solucionados problemas de rendimiento en la carga de componentes Livewire
- Corregidos errores de validación en formularios

## [1.0.0] - 2025-07-04

### Added
- Versión inicial del proyecto
- Sistema de autenticación completo
- Gestión de usuarios y roles
- Panel de administración con FluxUI Essentials
- Integración con Livewire
- Sistema de notificaciones
- Documentación básica

### Changed
- Actualizado a Laravel 12
- Mejorada la estructura del código siguiendo PSR-12
- Optimizado el rendimiento general

### Fixed
- Corregidos errores de seguridad
- Solucionados problemas de compatibilidad entre paquetes

### Suspendido
- Soporte multi-idioma: El cambio de idioma en tiempo real (español-inglés) fue suspendido tras múltiples intentos fallidos de sincronización entre frontend y backend.
  - Se probaron persistencia en sesión, localStorage y cookie, así como integración con Livewire, sin éxito robusto.
  - Documentación detallada en `/docs/multiidioma.md`
