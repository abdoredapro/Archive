<?php

namespace App\Exports;

use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class VideoExport implements FromCollection, WithHeadings
{
    use Exportable;
    public $videos;

    public function __construct($videos)
    {
        $this->videos = $videos;
    }
    
    public function collection()
    {
        $files = $this->videos;

        $videoDetails = [];

        foreach ($files as $file) {
            $videoDetails[] = [
                'name' => $file['name'],
                'filepath' => $file['path'],
                'size' => $file['size'],
            ];
        }

        foreach ($videoDetails as &$video) {
            $video['size'] = number_format($video['size'] / 1048576, 2) . ' MB';
        }

        return collect($videoDetails);
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
