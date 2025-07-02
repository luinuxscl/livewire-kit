<x-layouts.likeplatform :title="__('Prompts')" icon="layout-grid">

    <flux:heading level="2" size="lg" class="mb-4">Aqui abajo deberia verse el markdown resaltado:</flux:heading>

    <div class="rounded-lg bg-[#272822] p-4 overflow-hidden">
        <pre class="markdown-display"><code class="language-markdown"># Prompts

## Ejemplo de código Markdown

### Características

- Lista de elementos
- *Texto en cursiva*
- **Texto en negrita**

```php
// Ejemplo de código PHP dentro de markdown
function ejemplo() {
    return "Esto es un ejemplo";
}
```

> Este es un blockquote

[Link de ejemplo](https://ejemplo.com)</code></pre>
    </div>

    @push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/monokai-sublime.min.css">
    <style>
        .markdown-display {
            background: transparent !important;
            margin: 0;
        }
        .markdown-display code {
            font-family: 'JetBrains Mono', 'Fira Code', monospace;
            font-size: 0.95rem;
            background: transparent !important;
        }
        /* Ajustes finos para mejor apariencia */
        pre {
            padding: 0;
            margin: 0;
        }
    </style>
    @endpush

    @push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/languages/markdown.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/languages/php.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            hljs.configure({
                languages: ['markdown', 'php']
            });
            hljs.highlightAll();
        });
    </script>
    @endpush

</x-layouts.likeplatform>
