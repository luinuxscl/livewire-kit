{{-- Credit: Lucide (https://lucide.dev) --}}

@props([
    'variant' => 'outline',
])

@php
if ($variant === 'solid') {
    throw new \Exception('The "solid" variant is not supported in Lucide.');
}

$classes = Flux::classes('shrink-0')
    ->add(match($variant) {
        'outline' => '[:where(&)]:size-6',
        'solid' => '[:where(&)]:size-6',
        'mini' => '[:where(&)]:size-5',
        'micro' => '[:where(&)]:size-4',
    });

$strokeWidth = match ($variant) {
    'outline' => 2,
    'mini' => 2.25,
    'micro' => 2.5,
};
@endphp

<svg
    {{ $attributes->class($classes) }}
    data-flux-icon
    xmlns="http://www.w3.org/2000/svg"
    viewBox="0 0 24 24"
    fill="none"
    stroke="currentColor"
    stroke-width="{{ $strokeWidth }}"
    stroke-linecap="round"
    stroke-linejoin="round"
    aria-hidden="true"
    data-slot="icon"
>
  <path d="M8 2v4" />
  <path d="M12 2v4" />
  <path d="M16 2v4" />
  <path d="M16 4h2a2 2 0 0 1 2 2v2" />
  <path d="M20 12v2" />
  <path d="M20 18v2a2 2 0 0 1-2 2h-1" />
  <path d="M13 22h-2" />
  <path d="M7 22H6a2 2 0 0 1-2-2v-2" />
  <path d="M4 14v-2" />
  <path d="M4 8V6a2 2 0 0 1 2-2h2" />
  <path d="M8 10h6" />
  <path d="M8 14h8" />
  <path d="M8 18h5" />
</svg>
