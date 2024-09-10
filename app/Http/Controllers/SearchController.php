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
        $type = $request->get('type');

        $request->validate([
            'keyword' => 'nullable|string',
            'release_year' => 'nullable|integer',
            'from_date' => 'nullable|date',
            'to_date' => 'nullable|date',
            'project_category' => 'nullable|string',
        ]);

        $query = $request->toArray();

        if ($type === 'films') {
            $films = $searchService->searchFilms($query);
        } elseif ($type === 'files') {
            $files = $searchService->searchFiles($query);
        } else {
            $results = $searchService->search($query);
            $films = $results['films'];
            $files = $results['files'];
        }

        return view('dashboard.search', [
            'films' => $films ?? collect([]),
            'files' => $files ?? collect([]),
        ]);
    }
}
