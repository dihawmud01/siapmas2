<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class InputMultipleFiles extends Component
{
    public string $label;
    public string $name;
    public ?string $accept;
    public bool $required;

    /**
     * Create a new component instance.
     */
    public function __construct(string $label, string $name, ?string $accept = null, bool $required = true)
    {
        $this->label = $label;
        $this->name = $name;
        $this->accept = $accept ?? '*/*';
        $this->required = $required;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.input-multiple-files');
    }
}