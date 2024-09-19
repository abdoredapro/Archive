<?php

namespace App\View\Components;

use App\Models\File;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FileSuggest extends Component
{
    /**
     * Create a new component instance.
     */
        public $files;
    public function __construct()
    {
        $files = File::inRandomOrder()->limit(5)->get();
        $this->files = $files;
        
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.file-suggest');
    }
}
