<?php

namespace App\View\Components;

use App\Models\Category;
use App\Models\File;
use App\Models\Film;
use App\Models\Project;
use App\Services\ManageServer;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class statics extends Component
{
    /**
     * Create a new component instance.
     */
    public $films;
    public $files;
    public $projects;
    public $categories;

    public function __construct(
        ManageServer $server
    )
    {
        $this->films = Film::count();

        $this->files = $server->getAllSpace();

        $this->projects = Project::count();

        $this->categories = Category::count();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.statics');
    }
}
