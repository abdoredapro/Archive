<?php

namespace App\View\Components;

use App\Models\Project;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class barchart extends Component
{
    /**
     * Create a new component instance.
     */
    public $projects;
    public function __construct()
    {
        $this->projects = Project::withCount('files as views')->get()->toArray();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.barchart');
    }
}
