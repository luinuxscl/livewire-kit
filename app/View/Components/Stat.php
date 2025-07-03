<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Stat extends Component
{
    /**
     * El título de la estadística.
     *
     * @var string
     */
    public $title;

    /**
     * El valor principal de la estadística.
     *
     * @var string|int
     */
    public $value;

    /**
     * El texto descriptivo adicional.
     *
     * @var string|null
     */
    public $description;

    /**
     * El color del texto para el valor y el icono (primary, secondary, accent, info, success, warning, error).
     *
     * @var string
     */
    public $color;

    /**
     * El icono.
     *
     * @var string|null
     */
    public $icon;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        $title,
        $value,
        $description = null,
        $color = 'secondary',
        $icon = null
    ) {
        $this->title = $title;
        $this->value = $value;
        $this->description = $description;
        $this->color = $color;
        $this->icon = $icon;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.stat');
    }
}
