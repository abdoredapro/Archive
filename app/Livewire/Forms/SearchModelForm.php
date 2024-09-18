<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class SearchModelForm extends Form
{
    #[Validate('string|max:255|nullable')]
    public string $keyword = '';

    #[Validate('string|max:255|nullable')]
    public ?int $filterType = null;

    #[Validate('string|max:255|nullable')]
    public string $releaseYear = '';

    #[Validate('string|max:255|nullable')]
    public string $team = '';

    #[Validate('string|max:255|nullable')]
    public string $projectCategory = '';

    #[Validate('string|max:255|nullable')]
    public string $fromDate = '';

    #[Validate('string|max:255|nullable')]
    public string $toDate = '';
}
