<div>
    <form wire:submit.prevent="save" class="space-y-4">
        <livewire:image-card-uploader
            table="options"
            field="site_logo_light"
            folder="logos"
        />
        <livewire:image-card-uploader
            table="options"
            field="site_logo_dark"
            folder="logos"
        />

        <flux:input label="Título del Sitio" wire:model="title" />
        <p class="text-xl text-gray-500 dark:text-gray-400">{{ $title }}</p>
        <flux:input label="Descripción Corta" multiline wire:model="description" />
        <flux:input label="Icono del Sitio (URL)" wire:model="icon" />
        <flux:input label="Correo Electrónico" type="email" wire:model="email" />

        <flux:select label="Idioma Predeterminado" wire:model="locale">
            @foreach(config('app.locales', ['en','es']) as $lang)
                <option value="{{ $lang }}">{{ strtoupper($lang) }}</option>
            @endforeach
        </flux:select>

        <flux:select label="Zona Horaria" wire:model="timezone">
            @foreach(\DateTimeZone::listIdentifiers() as $tz)
                <option value="{{ $tz }}">{{ $tz }}</option>
            @endforeach
        </flux:select>

        <flux:input type="checkbox" label="Registro Habilitado" wire:model="registrationEnabled" />

        <flux:button type="submit" variant="filled">Guardar Cambios</flux:button>
    </form>
</div>