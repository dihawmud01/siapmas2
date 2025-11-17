<?php

namespace App\View\Components;

use Illuminate\View\Component;

class InputFilter extends Component
{
    public string $name;
    public string $label;
    public string $type;
    public ?string $value;

    /**
     * Create a new component instance.
     */
    public function __construct(string $name, string $label, string $type = 'text', ?string $value = null)
    {
        $this->name = $name;
        $this->label = $label;
        $this->type = $type;
        $this->value = $value ?? old($name);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('components.input-filter');
    }
}