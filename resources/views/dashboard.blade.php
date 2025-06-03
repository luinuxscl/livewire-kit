<x-layouts.likeplatform 
:title="__('Dashboard')"
icon="layout-grid">

@php
    $webhookUrl = "https://likeplatform-n8n.lwroij.easypanel.host/webhook/3c585c67-ab50-4cdb-9878-47514c4a3a84";
@endphp


<livewire:textarea-improver
    :systemPrompt="Prompts::get('system_editorial_line')->content"
    :webhookUrl="$webhookUrl"
    label="Línea Editorial"
    placeholder="Escribe aquí la línea editorial..."
    wire:key="editorial-textarea"
/>
    
</x-layouts.likeplatform>