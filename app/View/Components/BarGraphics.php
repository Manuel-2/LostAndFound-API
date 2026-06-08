<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BarGraphics extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public array $chartData = [],
        public string $title = "",
        public int $indicator = 1000,
        public string $type = "bar",
    ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.bar-graphics');
    }
}
