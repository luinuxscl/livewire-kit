# Roadmap de Funcionalidades

## Directriz General
- Siempre consideraremos la posibilidad de crear componentes Livewire, Blade o Flux.
- Elegiremos la mejor opción para cada caso, siguiendo las mejores prácticas de la industria (UX, mantenibilidad, escalabilidad).
- Documentaremos las decisiones arquitectónicas y el porqué de cada elección.

---

## Soporte multi-idioma
**Estado general:** 🔴 Suspendido temporalmente (ver detalles)
**Responsable:**  
**Notas:** Español e Inglés. Cambio de idioma en tiempo real.  
**Implementación:** Se evaluó si el selector de idioma sería un componente Livewire, Blade o Flux, eligiendo la mejor opción según buenas prácticas y experiencia de usuario.  
**Planificación:** Ver fases detalladas y estado en [docs/multiidioma.md](docs/multiidioma.md).

### Fase 1: Preparación y estructura básica
- [x] Verificar existencia de la carpeta `/lang`
- [x] Crear archivos de idioma `/lang/es/messages.php` y `/lang/en/messages.php`
- [x] Configurar idioma predeterminado y fallback en `config/app.php`

### Fase 2: Traducción de textos
- [x] Identificar textos “hardcodeados” en vistas y componentes
- [x] Reemplazar por helpers de traducción (`__()`, `@lang`)
- [x] Completar archivos de idioma con claves y valores

### Fase 3: Cambio de idioma en tiempo real
- [x] Crear componente para seleccionar idioma (Livewire/Blade/Flux)
- [x] Guardar preferencia en sesión, localStorage y cookie
- [x] Middleware `SetLocale` y registro en Kernel
- [x] Intentos de integración robusta frontend-backend
- [x] Pruebas y depuración exhaustivas
- [ ] ✅ Estado: No se logró una solución robusta y universal. Ver bug documentado en `/docs/multiidioma.md`.

### Fase 4: Integración con Livewire
- [x] Se intentó asegurar que los componentes reaccionen al cambio de idioma
- [ ] (Opcional) Mejorar UX con Alpine.js

### Fase 5: Pruebas y documentación
- [x] Pruebas exhaustivas de cambio de idioma
- [x] Documentar funcionamiento y estructura
- [x] Registrar avance y bug en ROADMAP y `/docs/multiidioma.md`

**Estado final:**
> El cambio de idioma en tiempo real está suspendido. No se logró sincronizar la preferencia de idioma entre frontend y backend de manera confiable, pese a múltiples enfoques y pruebas. El bug y los intentos están documentados en `/docs/multiidioma.md` para futuras referencias.

---

---

## Gestión de Roles y Permisos (Spatie)
**Estado general:** 🟡 Pendiente
**Responsable:**  
**Notas:** Cada usuario podrá tener un solo rol. Los roles predefinidos serán: root, admin y standard. Se utilizará el paquete spatie/laravel-permission.
**Implementación:** El sistema debe ser claro, desacoplado y fácil de personalizar para proyectos derivados.
**Planificación:**

### Fase 1: Instalación y configuración
- [ ] Instalar el paquete Spatie y publicar migraciones
- [ ] Ejecutar migraciones de roles y permisos
- [ ] Añadir el trait HasRoles al modelo User
- [ ] Configurar el caché de permisos (opcional)

### Fase 2: Definición de roles y permisos base
- [ ] Definir los roles iniciales (root, admin, standard)
- [ ] Crear un seeder para poblar roles base (solo un rol por usuario)
- [ ] Documentar los roles y su propósito

### Fase 3: Integración en la aplicación
- [ ] Proteger rutas y controladores con middleware de roles
- [ ] Añadir directivas Blade para mostrar/ocultar contenido según rol
- [ ] Ejemplos en vistas y layouts

### Fase 4: Gestión y asignación desde la UI (opcional)
- [ ] Crear componentes/vistas para asignar roles desde el panel
- [ ] Listar usuarios y roles en el panel de administración
- [ ] Permitir edición solo a usuarios autorizados

### Fase 5: Testing y validación
- [ ] Agregar tests para asegurar la protección de rutas y vistas
- [ ] Probar la asignación y revocación de roles

### Fase 6: Documentación
- [ ] Documentar el flujo en /docs/roles_permisos.md
- [ ] Incluir ejemplos de seeders, comandos y uso en Blade/controladores

**Estado final esperado:**
> El sistema de roles y permisos debe ser robusto, fácil de extender y dejar clara la restricción de un solo rol por usuario. Todo debe estar documentado para que futuros proyectos puedan aprovechar y personalizar la solución.

(El resto del roadmap permanece igual)
