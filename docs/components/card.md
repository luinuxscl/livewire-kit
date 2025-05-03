# Componente Card

Este componente envuelve contenido en una tarjeta con **header**, **body** y **footer** opcionales.

## Props

- `title` (string, opcional): Título de la tarjeta.
- **Slot** `actions` (opcional): Acciones que se muestran en el header a la derecha.
- **Slot** por defecto: Contenido principal de la tarjeta.
- **Slot** `footer` (opcional): Pie de la tarjeta.

## Uso básico

```blade
<x-ui.card title="Ejemplo básico">
    Contenido dentro de la tarjeta.
</x-ui.card>
```

## Header con acciones y footer

```blade
<x-ui.card title="Con acciones y pie">
    <x-slot name="actions">
        <flux:button variant="outline">Editar</flux:button>
    </x-slot>

    Texto de ejemplo en el body.

    <x-slot name="footer">
        <flux:button>Guardar</flux:button>
        <flux:button variant="outline">Cancelar</flux:button>
    </x-slot>
</x-ui.card>
```

## Contenido mixto

```blade
<x-ui.card title="Mixto">
    <img src="/path/to/image.jpg" alt="Ejemplo" class="mb-4 w-full rounded" />
    <p class="mb-4">Texto descriptivo.</p>
    <div class="flex justify-end gap-2">
        <flux:button>Acción 1</flux:button>
        <flux:button variant="outline">Acción 2</flux:button>
    </div>
</x-ui.card>
```
