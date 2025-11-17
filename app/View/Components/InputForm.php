<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class InputForm extends Component
{
    public string $name, $label, $id, $type, $accept, $placeholder;
    public ?string $value;
    public bool $required;
    public ?int $min, $max;

    /**
     * Create a new component instance.
     */
    public function __construct(
        string $name,
        string $label,
        string $id = '',
        string $type = 'text',
        string $placeholder = '',
        ?string $value = null,
        string $accept = '',
        bool $required = true,
        ?int $min = null,
        ?int $max = null,
    ) {
        $this->name = $name;
        $this->label = $label;
        $this->type = $type;
        $this->placeholder = $placeholder;
        $this->value = $value ?? old($name);
        $this->accept = $accept;
        $this->required = $required;
        $this->min = $min;
        $this->max = $max;
        $this->id = $id;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.input-form');
    }
}