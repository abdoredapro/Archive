<?php

namespace App\Exports;

use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

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
                    'id' => uniqid(),
                    'name' => basename($file),
                    'path' => Storage::disk('files')->url($file),
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
            'ID', 
            'Name',
            'path',
            'Size', 
        ];
    }
}
