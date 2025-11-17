<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Breadcrumb extends Component
{
    public array $values;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($values = [])
    {
        $this->values = $values;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return Application|Factory|\Illuminate\Foundation\Application|View
     */
    public function render()
    {
        return view('components.breadcrumb');
    }
}
