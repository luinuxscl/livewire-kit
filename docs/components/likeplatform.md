# Layout LikePlatform

Un layout base para construir vistas, que envuelve el contenido en una estructura consistente con navegación y botones de acción.

## Props

- `title` (string): Título principal que aparece en el header.
- `subtitle` (string): Subtítulo descriptivo bajo el título.
- `icon` (string): Nombre del icono de Flux que acompaña al título (por defecto `panel-top`).

## Slots

- **Default slot**: Contenido principal de la página.
- **Slot** `buttons` (opcional): Botones de acción que se muestran en la parte superior derecha del header.

## Estructura Interna

1. **Layout padre**: `<x-layouts.app>` recibe la prop `title` para la etiqueta `<title>` y envuelve todo.
2. **Contenedor**: `<div class="mx-auto w-full h-full [:where(&)]:max-w-7xl px-6 lg:px-8">` centra y limita el ancho.
3. **Header**:
   - Flex conteniendo:
     - Grupo de título e icono:  `<flux:icon>` + `<h2>{{ $title }}</h2>` + `<p>{{ $subtitle }}</p>`
     - Área de botones: íconos de Dashboard, Settings y el slot `buttons`.
4. **Contenido**: Renderiza el slot por defecto.

## Uso

```blade
<x-layouts.likeplatform
    title="Dashboard"
    subtitle="Bienvenido a tu panel"
    icon="layout-grid">
    <x-slot name="buttons">
        <flux:button icon="plus" variant="filled">Crear</flux:button>
    </x-slot>

    <!-- Contenido de la página -->
    <div>
        Aquí van tus componentes y secciones.
    </div>
</x-layouts.likeplatform>
```

Este layout garantiza una cabecera uniforme y un contenedor responsivo para todas las vistas nuevas.
