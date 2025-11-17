<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class InputJson extends Component
{
    public string $label;
    public string $name;
    public int $count;
    public array $values;

    /**
     * Create a new component instance.
     */
    public function __construct(string $label, string $name, int $count = 5, array $values = [])
    {
        $this->name = $name;
        $this->label = $label;
        $this->count = intval($count);
        $this->values = is_array($values) ? $values : [];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.input-json');
    }
}
