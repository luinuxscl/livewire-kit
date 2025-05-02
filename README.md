# LikePlatform

Starterkit para Laravel 12 con Livewire

LikePlatform es una base moderna para iniciar proyectos en Laravel 12 usando Livewire, diseñada para acelerar el desarrollo y mantener buenas prácticas desde el inicio.

## Instalación Rápida

```bash
git clone https://github.com/luinuxscl/livewire-kit.git
cd livewire-kit
composer install
npm install && npm run dev
cp .env.example .env
php artisan key:generate
php artisan migrate
composer run dev
```

Accede a la app en: http://localhost:8000

## Documentación

Encuentra la documentación completa en [`/docs`](./docs).

## Personalización de la Aplicación
La aplicación permite personalizar varios aspectos desde Livewire en la ruta `/settings/customization`:

### Keys disponibles
| Key                  | Descripción                                  | Grupo         | Tipo    |
|----------------------|----------------------------------------------|---------------|---------|
| site_logo_light      | URL del logo en modo claro                   | branding      | string  |
| site_logo_dark       | URL del logo en modo oscuro                  | branding      | string  |
| site_title           | Título del sitio                             | general       | string  |
| site_description     | Descripción corta del sitio                  | general       | text    |
| site_icon            | URL del icono del sitio                      | branding      | string  |
| contact_email        | Correo de contacto                           | general       | string  |
| default_locale       | Idioma predeterminado                        | localization  | string  |
| default_timezone     | Zona horaria predeterminada                  | localization  | string  |
| registration_enabled | Indica si el registro de usuarios está activo| general       | boolean |

### Ejemplo de uso en layouts
```blade
<img src="{{ \App\Models\Option::getValue('site_logo_light') }}" alt="Logo Claro">
<title>{{ \App\Models\Option::getValue('site_title') }}</title>
```

### Formatos de archivo
- **Logos**: JPG, PNG o SVG; tamaño máximo 1 MB; tamaño recomendado: 200×50 px.

## Autor

-   **Luis Sepulveda** — [luinuxscl](https://github.com/luinuxscl) — luis@like.cl — [like.cl](https://like.cl)
