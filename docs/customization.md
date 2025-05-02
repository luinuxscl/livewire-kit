# Roadmap de Customización

Esta documentación describe las fases y tareas para el componente genérico de subida de imágenes (`ImageCardUploader`) y su integración en la aplicación.

## Fase 1: Preparación

-   [x] Revisar dependencias de FluxUI para cards e inputs de archivo.
-   [x] Verificar migración y seeder con campos `logo_light` y `logo_dark`.

## Fase 2: Componente genérico ImageCardUploader

-   [x] Crear Livewire component `ImageCardUploader` con props `$table`, `$field`, `$folder`.
-   [x] Implementar `mount()` para cargar valor inicial desde DB usando `Option`.
-   [x] Definir validaciones `image|max:2048` y método `updatedFile()` para almacenar en `$folder`.
-   [x] Integrar UI con HTML/Tailwind puro para card e input de archivo, compatible con modo claro y oscuro.

## Fase 3: Integración en AppCustomization

-   [x] Reemplazar sección de `logo_light` y `logo_dark` con `<livewire:image-card-uploader />`.
-   [x] Probar subida, almacenamiento y ruta en DB `options`.
-   [x] Gestionar eliminación de assets antiguos con `Storage::delete()`.

## Fase 4: UX y feedback

-   [x] Implementar toasts globales usando el sistema personalizado (`dispatch('showToast')`).
-   [x] Añadir spinner SVG con Tailwind dentro del card.
-   [x] Mostrar mensajes de validación y errores in-line.

## Fase 5: Auditoría y seguridad *(postpuesto)*

-   [ ] Registrar acciones de subida en tabla de auditoría con usuario y timestamp.
-   [ ] Validar permisos de acceso basados en roles de usuario.

## Fase 6: Pruebas y documentación

-   [ ] Escribir tests Livewire para simular upload y verificar DB. *(Tests postpuestos)*
-   [ ] Actualizar README con ejemplos de uso del componente y parámetros.
-   [ ] Documentar compatibilidad con temas claros y oscuros.

## Estado actual

-   Fases 1 a 4 completadas.
-   Fase 5 postpuesta.
-   Pruebas de Fase 6 postpuestas; documentación adicional pendiente.
