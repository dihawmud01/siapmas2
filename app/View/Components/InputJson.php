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
    public string $layout;

    /**
     * Create a new component instance.
     */
    public function __construct(
        string $label,
        string $name,
        int $count = 5,
        array $values = [],
        string $layout = 'horizontal',
    ) {
        $this->name = $name;
        $this->label = $label;
        $this->count = intval($count);
        $this->values = is_array($values) ? $values : [];
        $this->layout = $layout;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.input-json');
    }
}
