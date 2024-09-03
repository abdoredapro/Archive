<?php

namespace App\Services;

use App\Models\File;
use App\Models\Film;
use Illuminate\Database\Eloquent\Collection;

class SearchService
{
    public function getFilms($search)
    {

        $films = Film::whereAny(['name', 'film_script'], 'like', "%$search%")
            ->get();

        return $films;
    }

    public function getFiles($search)
    {

        $files = File::whereAny(['name', 'description'], 'like', "%$search%")
            ->get();

        return $files;
    }

    public function getAll($search) {

        $this->getFilms($search);
        
        $this->getFiles($search);
    }
}
