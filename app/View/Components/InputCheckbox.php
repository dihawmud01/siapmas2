<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class InputCheckbox extends Component
{
    public string $id;
    public string $name;
    public string $label;
    public ?string $xModel;
    public ?string $value;
    public bool $checked;

    /**
     * Create a new component instance.
     */
    public function __construct(
        string $id,
        string $name,
        string $label,
        ?string $xModel = '',
        ?string $value = null,
        bool $checked = false,
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->label = $label;
        $this->xModel = $xModel;
        $this->value = $value ?? old($name); // Ambil old value jika ada
        $this->checked = boolval($checked); // Pastikan selalu boolean
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.input-checkbox');
    }
}
