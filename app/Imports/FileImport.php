<?php

namespace App\Imports;

use App\Models\File;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Row;

class FileImport implements ToArray, WithHeadingRow, WithMapping
{
    /**
     * @param array $array
     */
    public function array(array $array)
    {
        return $array;
    }

    public function map($row): array
    {
        return [
            'id'    => $row['id'], 
            'name'  => $row['name'], 
            'filepath'  => $row['filepath'], 
            'size'  => $row['size'],
            'shotdate' => isset($row['shotdate']) ? Carbon::parse($row['shotdate'])->toDateString() : null,
            'duration' => isset($row['duration']) ? Carbon::parse($row['duration'])->toTimeString() : null,
            'category' => $row['category'],
            'project' => $row['project'],
        ];
    }

}
