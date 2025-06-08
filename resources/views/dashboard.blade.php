<x-layouts.likeplatform 
:title="__('Dashboard')"
icon="layout-grid">

{{-- @php
    $webhookUrl = "https://likeplatform-n8n.lwroij.easypanel.host/webhook/3c585c67-ab50-4cdb-9878-47514c4a3a84";
@endphp


<livewire:textarea-improver
    :systemPrompt="Prompts::get('system_editorial_line')->content"
    :webhookUrl="$webhookUrl"
    label="Línea Editorial"
    placeholder="Escribe aquí la línea editorial..."
    wire:key="editorial-textarea"
/> --}}

{{-- <livewire:content-profile-table/> --}}

<x-test />

{{-- <livewire:prompt-press.content-seed-chat-form 
    :webhook-url="'https://likeplatform-n8n.lwroij.easypanel.host/webhook/f724468b-8e74-445b-a3f4-50259bc28076'" /> --}}
    
</x-layouts.likeplatform>