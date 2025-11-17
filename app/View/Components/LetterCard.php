<?php

namespace App\View\Components;

use App\Models\Letter;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class LetterCard extends Component
{
    public Letter $letter;
    /**
     * Create a new component instance.
     */
    public function __construct(Letter $letter)
    {
        $this->letter = $letter;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.letter-card');
    }
}