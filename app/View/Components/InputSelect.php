<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class InputSelect extends Component
{
    public string $name;
    public string $label;
    public array $options;
    public ?string $selected;
    public bool $required;

    /**
     * Create a new component instance.
     */
    public function __construct(
        string $name,
        string $label,
        array $options = [],
        ?string $selected = null,
        bool $required = true,
    ) {
        $this->name = $name;
        $this->label = $label;
        $this->options = is_array($options) ? $options : [];
        $this->selected = $selected ?? old($name);
        $this->required = $required;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.input-select');
    }
}
