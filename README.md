# LikePlatform

**Starterkit para Laravel 12 + Livewire + FluxUI Essentials**

LikePlatform es una base moderna para iniciar proyectos en Laravel 12, integrando Livewire y FluxUI (solo componentes Essentials), DaisyUI y TailwindCSS, diseñada para acelerar el desarrollo, mantener buenas prácticas y ofrecer una experiencia de usuario avanzada desde el inicio.

---

## 🚀 Instalación Rápida

```bash
git clone https://github.com/luinuxscl/livewire-kit.git
cd livewire-kit
composer config --global --auth github-oauth.github.com TU_TOKEN
composer install
npm install && npm run dev
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan likeplatform:install
composer run dev
```

Accede a la app en: http://localhost:8000

---

## 📦 Características Principales

-   **Livewire + FluxUI Essentials**: Interfaz reactiva y moderna solo usando componentes gratuitos de FluxUI.
-   **Gestión avanzada de posts**: Interfaz de dos columnas para visualizar y editar posts de forma eficiente.
-   **Sistema de notificaciones toast** reutilizable en toda la app (éxito, error, info, etc.).
-   **Auditoría de acciones sensibles**: Registro de logs de usuario y acciones críticas.
-   **Personalización centralizada**: Configura branding, idioma, zona horaria y más desde la interfaz.
-   **Comandos Artisan personalizados**: Todos los comandos propios usan el prefijo `likeplatform:` (ubicados en `app/Console/Commands`).
-   **Buenas prácticas y convenciones Laravel**: Código limpio, mantenible y alineado a PSR-12/PSR-4.

---

## 🛠️ Requisitos

-   PHP >= 8.2
-   Node.js >= 18
-   Composer >= 2.0
-   MySQL/MariaDB o SQLite

---

## 🖥️ Estructura y Arquitectura

-   **Livewire** para componentes interactivos.
-   **FluxUI Essentials** para UI (no se usan componentes Advanced).
-   **DaisyUI** para el diseño y utilidades.
-   **Comandos Artisan propios** con prefijo `likeplatform:`.
-   **Organización clara** de servicios, acciones y recursos siguiendo las convenciones de Laravel.

---

## 📝 Funcionalidades Destacadas

### Notificaciones Toast Globales

-   Sistema Livewire + FluxUI para mostrar mensajes de éxito, error, info, etc., desde cualquier componente.

### Auditoría de Acciones

-   Registro de acciones sensibles por usuario, con fecha y tipo de acción.
-   Interfaz para revisar historial de auditoría.

### Comandos Artisan Personalizados

-   Todos los comandos propios usan el prefijo `likeplatform:`.
-   Ubicados en `app/Console/Commands`.
-   Ejemplo:
    ```bash
    php artisan likeplatform:your-command
    ```

---

## 🧑‍💻 Buenas Prácticas y Convenciones

-   Código en inglés, comentarios relevantes en español.
-   Respeto a PSR-12/PSR-4 y convenciones de Laravel.
-   Uso exclusivo de componentes Essentials de FluxUI.
-   Documentación de lógica compleja y decisiones arquitectónicas.
-   Organización clara de servicios, acciones y recursos.

---

## 📚 Documentación Adicional

-   Documentación extendida en [`/docs`](./docs).
-   Ejemplos de uso de FluxUI Essentials y modales en `/docs/ui-examples.md`.

---

## 🔄 Versionado

Este proyecto sigue [Versionado Semántico 2.0.0](https://semver.org/lang/es/). Para ver las versiones disponibles, mira los [tags en este repositorio](https://github.com/luinuxscl/livewire-kit/tags).

### Estructura de versionado

Dado un número de versión MAYOR.MENOR.PARCHE, incrementar:

1. **MAYOR** cuando hay cambios incompatibles en la API.
2. **MENOR** cuando se añade funcionalidad de forma retrocompatible.
3. **PARCHE** cuando se corrigen errores de forma retrocompatible.

### Changelog

Los cambios detallados para cada versión se documentan en el archivo [CHANGELOG.md](CHANGELOG.md).

## 📄 Licencia

Este proyecto está bajo la Licencia MIT - ver el archivo [LICENSE](LICENSE) para más detalles.

## 👤 Autor

-   **Luis Sepulveda** — [luinuxscl](https://github.com/luinuxscl) — luis@like.cl — [like.cl](https://like.cl)
