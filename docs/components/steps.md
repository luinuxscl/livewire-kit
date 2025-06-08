# Componente Steps y casos avanzados (Livewire)

Este documento describe el uso, personalización y ejemplos avanzados del componente `Steps` y sus integraciones con Livewire para flujos interactivos y adaptables a distintos casos de negocio.

---

## 1. Uso básico de `<x-steps>`

Muestra un proceso por pasos visual, con soporte para modo claro/oscuro y variantes de tamaño:

```blade
<x-steps :steps="['Register', 'Choose plan', 'Purchase', 'Receive Product']" :current="2" />
```

Props principales:
- `steps`: array de strings o arrays con `label` y `desc`.
- `current`: paso activo (base 1).
- `size`: 'normal' o 'small'.

---

## 2. Ejemplo avanzado: pasos dinámicos y descripciones

```blade
@php
    $advancedSteps = [
        ['label' => 'Datos personales', 'desc' => 'Completa tu información básica'],
        ['label' => 'Dirección', 'desc' => 'Agrega tu dirección de envío'],
        ['label' => 'Pago', 'desc' => 'Selecciona método de pago'],
        ['label' => 'Confirmación', 'desc' => 'Revisa y confirma tu pedido'],
    ];
@endphp
<x-steps :steps="$advancedSteps" :current="3" />
```

---

## 3. Integración con Livewire: wizard interactivo

Puedes controlar el paso activo y la lógica del flujo desde un componente Livewire.

### 3.1. Ejemplo de componente Livewire básico

**Clase:**
```php
namespace App\Http\Livewire;

use Livewire\Component;

class WizardExample extends Component
{
    public $current = 1;
    public $steps = [
        ['label' => 'Datos personales', 'desc' => 'Completa tu información básica'],
        ['label' => 'Dirección', 'desc' => 'Agrega tu dirección de envío'],
        ['label' => 'Pago', 'desc' => 'Selecciona método de pago'],
        ['label' => 'Confirmación', 'desc' => 'Revisa y confirma tu pedido'],
    ];
    public function nextStep() { if ($this->current < count($this->steps)) $this->current++; }
    public function prevStep() { if ($this->current > 1) $this->current--; }
    public function render() { return view('livewire.wizard-example'); }
}
```

**Vista:**
```blade
<div>
    <x-steps :steps="$steps" :current="$current" />
    <button wire:click="prevStep">Anterior</button>
    <button wire:click="nextStep">Siguiente</button>
</div>
```

---

## 4. Caso real avanzado: SeedProcessSteps

Un componente Livewire especializado para flujos con pasos fijos y animaciones de trabajo.

### 4.1. Clase Livewire
```php
namespace App\Livewire;

use Livewire\Component;

class SeedProcessSteps extends Component
{
    public $currentStep = 1;
    public $working = false;
    public $steps = [
        ['label' => 'Inicio', 'desc' => 'Esperando inicio del proceso'],
        ['label' => 'Proceso en N8N', 'desc' => 'Automatización en ejecución'],
        ['label' => 'Seed Creada', 'desc' => 'La seed fue generada exitosamente'],
        ['label' => 'Seed Utilizada', 'desc' => 'La seed fue usada en destino'],
    ];
    protected $listeners = [
        'seed-process:advance' => 'nextStep',
        'seed-process:working' => 'setWorking',
        'seed-process:set' => 'setStep',
    ];
    public function nextStep() { if ($this->currentStep < count($this->steps)) { $this->currentStep++; $this->working = false; } }
    public function setStep($step) { if ($step >= 1 && $step <= count($this->steps)) { $this->currentStep = $step; $this->working = false; } }
    public function setWorking($bool = true) { $this->working = (bool) $bool; }
    public function startWorking() { $this->working = true; }
    public function stopWorking() { $this->working = false; }
    public function render() { return view('livewire.seed-process-steps'); }
}
```

### 4.2. Vista Blade
```blade
<div x-data="{ listen() { window.Livewire.on('seed-process:advance', () => $wire.nextStep()); window.Livewire.on('seed-process:working', v => $wire.setWorking(v)); window.Livewire.on('seed-process:set', step => $wire.setStep(step)); } }" x-init="listen()">
    <x-steps :steps="$steps" :current="$currentStep" />
    <!-- Botones y animaciones personalizadas -->
</div>
```

#### Efectos y animaciones:
- El paso activo puede mostrar spinner y pulso (`animate-pulse`), sombra y escala.
- Puedes avanzar con botones o emitiendo eventos Livewire desde backend o JS:
```js
Livewire.emit('seed-process:advance');
Livewire.emit('seed-process:working', true);
Livewire.emit('seed-process:set', 3);
```

---

## 5. Adaptación a otros casos de uso

- Cambia los pasos (`steps`) según el flujo de tu negocio.
- Usa la API de eventos para controlar el avance desde cualquier parte de tu app.
- Personaliza los efectos visuales y la lógica según lo requiera tu proceso.

---

## 6. Consideraciones técnicas

- El componente base utiliza TailwindCSS y un CSS mínimo para detalles de tamaño.
- Es compatible con modo claro/oscuro y accesible por teclado.
- Los componentes Livewire pueden ser anidados y reutilizados.
- Puedes extender el componente para agregar íconos, validaciones, slots, etc.

---

¿Dudas o necesitas adaptar este patrón a otro flujo? Copia este documento como contexto y pide a tu asistente que lo personalice para tu caso de negocio.