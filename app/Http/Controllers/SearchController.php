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

        $type = request()->query('type');

            if ($type == 'file') {
                $files = File::whereAny(['name', 'description'], 'like', "%$search%")
                    ->where('release_year', request()->query('release_year'))
                    ->get();
            } else if ($type == 'film') {
                $films = Film::whereAny(['name', 'film_script'], 'like', "%$search%")
                    ->where('release_year', request()->query('release_year'))
                    ->get();
            } else {
                $files = File::whereAny(['name', 'description'], 'like', "%$search%")
                    ->where('release_year', request()->query('release_year'))
                    ->get();
                
                $films = Film::whereAny(['name', 'film_script'], 'like', "%$search%")
                    ->where('release_year', request()->query('release_year'))
                    ->get();
            }



        return view('dashboard.search', [
            'films' => $films ?? collect([]),
            'files' => $files ?? collect([]),
        ]);
    }
}
