<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Film;
use App\Services\SearchService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(SearchService $searchService, Request $request)
    {

        $search = $request->search;

        $films = $searchService->getFilms($search);

        $files = $searchService->getFiles($search);

        return view('dashboard.search', compact('films', 'files'));
    }
}
