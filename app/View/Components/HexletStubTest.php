<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class HexletStubTest extends Component
{
    public object $objects;
    /**
     * Create a new component instance.
     */
    public function __construct(object $objects)
    {
        $this->objects = $objects;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.hexlet-stub-test');
    }
}
