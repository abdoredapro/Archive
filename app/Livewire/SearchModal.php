<?php

namespace App\Livewire;

use App\Livewire\Forms\SearchModelForm;
use App\Models\FilmClip;
use App\Services\SearchService;
use Livewire\Component;
use Livewire\WithPagination;

class SearchModal extends Component
{
    public SearchModelForm $form;

    use WithPagination;

    public function render(SearchService $searchService)
    {
        if ($this->form->filterType === 1) {
            
            $films = $searchService->searchFilms($this->form->toArray());

        } elseif ($this->form->filterType === 2) {

            $films = $searchService->searchFiles($this->form->toArray());

        } elseif ($this->form->filterType === 3) {

            $films = $searchService->filmFootage($this->form->toArray());
            $files = $searchService->FileFootage($this->form->toArray());

        } else {
            $data = $searchService->search($this->form->toArray());
            $films = $data['films'];
            $files = $data['files'];
        }
        return view('livewire.search-modal', [
            'films' => $films ?? collect([]),
            'files' => $files ?? collect([]),
        ]);
    }
}
