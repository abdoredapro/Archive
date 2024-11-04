<?php

namespace App\View\Components\charts;

use App\Models\Category;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DownChart extends Component
{
    /**
     * Create a new component instance.
     */
    public $categories;
    public function __construct()
    {
        $this->categories = Category::limit(3)->pluck('name');
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.charts.down-chart');
    }
}
