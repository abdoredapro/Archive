<?php

namespace App\Exports;

use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class VideoExport implements FromCollection, WithHeadings
{
    use Exportable;
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $files = Storage::disk('public')->allFiles('folders');

        $videoDetails = [];

        foreach ($files as $file) {

            if (preg_match('/\.(mp4|avi|mkv|mov|flv|wmv)$/i', $file)) {

                $name = pathinfo(basename($file), PATHINFO_FILENAME);

                $videoDetails[] = [
                    'AssetId' => uniqid(),
                    'name' => $name,
                    'filepath' => Storage::disk('public')->url($file),
                    'size' => '1 MB',
                ];
            }
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
