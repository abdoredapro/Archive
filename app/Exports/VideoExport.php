<?php

namespace App\Exports;

use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class VideoExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $files = Storage::disk('files')->allFiles();

        $videoDetails = [];

        foreach ($files as $file) {
            if (preg_match('/\.(mp4|avi|mkv|mov|flv|wmv)$/i', $file)) {
                $videoDetails[] = [
                    'AssetId' => uniqid(),
                    'name' => pathinfo(basename($file), PATHINFO_FILENAME),
                    'filepath' => Storage::disk('files')->url($file),
                    'size' => Storage::disk('files')->size($file),
                ];
            }
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
