<?php

namespace App\View\Components;

use App\Models\SP;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SPCard extends Component
{
    public SP $letter;
    /**
     * Create a new component instance.
     */
    public function __construct(SP $letter)
    {
        $this->letter = $letter;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.sp-card');
    }
}