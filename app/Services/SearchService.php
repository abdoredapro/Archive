<?php

namespace App\Services;

use App\Models\File;
use App\Models\Film;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

final class SearchService
{
    /**
     * Perform a generic search on any model.
     */
    private function searchModel(Builder $query, array $searchCriteria): Collection
    {
        return $query
            ->when(data_get($searchCriteria, 'keyword'), function (Builder $query, $keyword) {
                $query->where(function ($query) use ($keyword) {
                    $query->where('name', 'like', "%$keyword%")
                        ->orWhere('info', 'like', "%$keyword%")
                        ->orWhere('project_category', 'like', "%$keyword%")
                        ->orWhere('production_manager', 'like', "%$keyword%")
                        ->orWhere('sound_engineer', 'like', "%$keyword%");
                });
            })
            ->when(data_get($searchCriteria, 'releaseYear'), function (Builder $query, $releaseYear) {
                $query->where('release_year', $releaseYear);
            })
            ->when(data_get($searchCriteria, 'fromDate') && data_get($searchCriteria, 'toDate'), function (Builder $query) use ($searchCriteria) {
                $query->whereBetween('release_year', [data_get($searchCriteria, 'fromDate'), data_get($searchCriteria, 'toDate')]);
            })
            ->when(data_get($searchCriteria, 'project_category'), function (Builder $query, $projectCategory) {
                $query->where('project_category', $projectCategory);
            })
            ->when(data_get($searchCriteria, 'team'), function (Builder $query, $team) {
                $query->where('production_manager', 'like', "%$team%")
                    ->orWhere('sound_engineer', 'like', "%$team%");
            })
            ->get();
    }

    /**
     * Search for films.
     */
    public function searchFilms(array $query): Collection
    {
        return $this->searchModel(Film::query(), $query);
    }

    /**
     * Search for files.
     */
    public function searchFiles(array $query): Collection
    {
        return $this->searchModel(File::query(), $query);
    }

    /**
     * Search both films and files.
     */
    public function search(array $query): array
    {
        return [
            'films' => $this->searchFilms($query),
            'files' => $this->searchFiles($query),
        ];
    }
}
