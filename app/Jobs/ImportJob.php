<?php

namespace App\Jobs;

use App\Imports\FileImport;
use App\Models\Category;
use App\Models\File;
use App\Models\Project;
use Illuminate\Bus\Batchable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
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
                $name       = $row['name'] ?? null;
                $path       = $row['filepath'] ?? null;
                $size       = $row['size'] ?? null;
                $shotDate   = $row['shotdate'] ?? null;
                $duration   = $row['duration'] ?? null;
                $category   = $row['category'] ?? null;
                $project    = $row['project'] ?? null;

                $project_id = Project::firstOrCreate(['name' => $project])->id;
                $category_id = Category::firstOrCreate(['name' => $category])->id;

                File::create([
                    'project_id'        => $project_id,
                    'category_id'       => $category_id,
                    'name'              => $name,
                    'image'             => '',
                    'video'             => $path,
                    'description'       => 'description',
                    'type'              => 'excel',
                ]);
            }
        } catch (\Exception $e) {
            \Log::error("message: " . $e->getMessage());
        }
    }
}
