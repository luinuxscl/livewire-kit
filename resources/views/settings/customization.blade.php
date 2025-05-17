<x-layouts.likeplatform :title="__('Customization')" icon="folder-code">
    <x-slot name="buttons">
        <flux:button icon="refresh-ccw" variant="ghost" :href="route('customization')" />
    </x-slot>
    <div class="flex flex-col gap-4 xl:w-2/3 w-full">
        <livewire:change-option name="site_title" />
        <livewire:change-option name="site_description" />
        <livewire:change-option name="contact_email" type="email" />
    </div>
      
      
      
    
</x-layouts.likeplatform>
