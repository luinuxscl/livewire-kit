<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;
use Illuminate\Support\Facades\Http;

class TextareaImprover extends Component
{
    public array $webhookDebug = [];
    public string $text = '';
    public string $systemPrompt;
    public string $webhookUrl;
    public string $label;
    public string $placeholder;
    public bool $debug = false;

    public function mount(string $systemPrompt, string $webhookUrl, string $label = '', string $placeholder = '', string $text = '', bool $debug = false)
    {
        $this->systemPrompt = $systemPrompt;
        $this->webhookUrl = $webhookUrl;
        $this->label = $label;
        $this->placeholder = $placeholder;
        $this->text = $text;
        $this->debug = $debug;
    }

    public function improveText()
    {
        try {
            $response = Http::timeout(30)->post($this->webhookUrl, [
                'text' => $this->text,
                'system_prompt' => $this->systemPrompt,
            ]);
            // Guardar toda la respuesta para depuración
            $this->webhookDebug = $response->json() ?? [];
            if ($response->successful() && isset($this->webhookDebug['improved_text'])) {
                $this->text = $this->webhookDebug['improved_text'];
                $this->dispatch('onImproved', improvedText: $this->text);
            } else {
                $this->dispatch('showToast', ['type' => 'error', 'message' => 'No se pudo mejorar el texto.']);
            }
        } catch (\Exception $e) {
            $this->webhookDebug = ['error' => $e->getMessage()];
            $this->dispatch('showToast', ['type' => 'error', 'message' => 'Error de red: ' . $e->getMessage()]);
        }
    }

    public function render()
    {
        return view('livewire.textarea-improver', [
            'label' => $this->label,
            'placeholder' => $this->placeholder,
            'text' => $this->text,
            'webhookDebug' => $this->webhookDebug,
            'debug' => $this->debug,
        ]);
    }
}
