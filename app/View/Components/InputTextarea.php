<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class InputTextarea extends Component
{
    public string $name;
    public string $label;
    public ?string $value;
    public int $rows;

    /**
     * Create a new component instance.
     */
    public function __construct(string $name, string $label, ?string $value = null, int $rows = 4)
    {
        $this->name = $name;
        $this->label = $label;
        $this->value = $value ?? old($name);
        $this->rows = intval($rows);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.input-textarea');
    }
}
