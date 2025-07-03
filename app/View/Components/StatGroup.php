<?php

namespace App\View\Components;

use Illuminate\View\Component;

class StatGroup extends Component
{
    /**
     * Indica si se debe mostrar una sombra.
     *
     * @var bool
     */
    public $shadow;

    /**
     * Clases CSS adicionales.
     *
     * @var string|null
     */
    public $class;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($shadow = true, $class = null)
    {
        $this->shadow = $shadow;
        $this->class = $class;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.stat-group');
    }
}
