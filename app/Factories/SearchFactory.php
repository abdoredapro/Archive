<?php

namespace App\Factories;

use App\Services\SearchService;

class SearchFactory
{

    public $searchService;
    public function __construct()
    {
        $this->searchService = new SearchService;
    }
    public function process($search, $type)
    {

        if ($type == 'file') {
            
            return $this->searchService->getFiles($search);
            
        } else if ($type == 'film') {
            return $this->searchService->getFilms($search);
        } else {
            $files =
                $this->searchService->getFilms($search);

            $films =
                $this->searchService->getFiles($search);

                return $files . $films;
        }
    }
}
