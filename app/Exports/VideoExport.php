<?php

namespace App\Exports;

use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class VideoExport implements FromArray, WithHeadings
{
    use Exportable;

    public function __construct(protected $files) {}

    public function array(): array
    {
        return $this->files;
    }


    public function headings(): array
    {
        return [
            'AssetId',
            'Name',
            'filepath',
            'Size',
            'ShotDate',
            'Duration',
            'Category',
            'Project',
            'Lang',
            'TapeType',
            'TapeNo',
            'GENRE',
            'DIRECTOR',
            'PRODUCER',
            'MUSIC',
            'SOUND',
            'CAMERAMAN',
            'EDITOR',
            'AWARDS',
            'LOCATION',
            'VOICEOVER',
            'CHARACTERS',
            'WRITER',
            'Notes',
            'Script'
        ];
    }
}
