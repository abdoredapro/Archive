<?php

namespace App\Jobs;

use App\Models\Category;
use App\Models\File;
use App\Models\Project;
use Illuminate\Bus\Batchable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ImportJob implements ShouldQueue
{
    use Queueable, Batchable, SerializesModels;

    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function handle()
    {
        try {
            foreach ($this->data[0] as $row) {
                $this->processRow($row);
            }
        } catch (\Exception $e) {
            Log::error("Import Job Error: " . $e->getMessage());
        }
    }

    private function isRowValid(array $row): bool
    {
        return isset($row['name'], $row['filepath'], $row['project'], $row['category'], $row['script']);
    }

    private function processRow(array $row): void
    {
        if (!$this->isRowValid($row)) {
            return; 
        }

        $projectName = $row['project'];
        $categoryName = $row['category'];

        $project_id = $this->getOrCreateProject($projectName);
        $category_id = $this->getOrCreateCategory($categoryName);

        File::create([
            'project_id'  => $project_id,
            'category_id' => $category_id,
            'name'        => $row['name'],
            'video'       => $row['filepath'],
            'description' => $row['script'] ?? null,
            'tap_type'    => $row['tapetype'] ?? null,
            'tap_number'  => $row['tapeno'] ?? null,
            'director'    => $row['director'] ?? null,
            'producer'    => $row['producer'] ?? null,
            'sound'       => $row['sound'] ?? null,
            'camera_man'  => $row['cameraman'] ?? null,
        ]);
    }

    private function getOrCreateProject(string $name): int
    {
        return Project::firstOrCreate(['name' => $name])->id;
    }

    private function getOrCreateCategory(string $name): int
    {
        return Category::firstOrCreate(['name' => $name])->id;
    }
}
