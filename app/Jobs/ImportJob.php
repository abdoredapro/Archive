<?php

namespace App\Jobs;

use App\Imports\FileImport;
use App\Models\Category;
use App\Models\File;
use App\Models\Project;
use Illuminate\Bus\Batchable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class ImportJob implements ShouldQueue
{
    use Queueable, Batchable;

    public $uploadedFile;

    public function __construct($uploadedFile)
    {
        $this->uploadedFile = $uploadedFile;
    }

    public function handle()
    {
        try {
            $data = Excel::toArray(new FileImport, $this->uploadedFile);

            foreach ($data[0] as $row) {
                $name       = $row['name'];
                $path       = $row['filepath'];
                $size       = $row['size'];
                $shotDate   = $row['shotdate'];
                $duration   = $row['duration'];
                $category   = $row['category'];
                $project    = $row['project'];
                $desctription    = $row['script'];
                $tapType    = $row['tapetype'];
                $tapNumber    = $row['tapeno'];
                $director    = $row['director'];
                $producer    = $row['producer'];
                $music    = $row['music'];
                $sound    = $row['sound'] ?? null;
                $cameraMan    = $row['cameraman'] ?? null;

                $project_id = Project::firstOrCreate(['name' => $project])->id;
                $category_id = Category::firstOrCreate(['name' => $category])->id;
                File::create([
                    'project_id'        => $project_id,
                    'category_id'       => $category_id,
                    'name'              => 'asdsad',
                    'video'             => $path,
                    'description'       => $desctription,
                    'tap_type'          => $tapType,
                    'tap_number'          => $tapNumber,
                    'director'          => $director,
                    'producer'          => $producer,
                    'sound'          => $producer,
                    'camera_man'          => $cameraMan,
                ]);
            }

        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }
}
