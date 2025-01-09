<?php

namespace App\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Carbon;
use Illuminate\Support\Number;

class ManageServer
{
    public function servers(): Collection
    {
        return collect([
            1 => [
                'link' => 'D:\\',
                'name' => 'Server 1',
            ],

        ]);
    }

    public function getDirectory(string $dir): Collection
    {
        $dirs = collect(File::directories($dir));

        $directories = $dirs->map(function ($dir) {
            return [
                'type' => 'directory',
                'name' => File::name($dir),
                'link' => $dir
            ];
        });

        return $directories->sortBy('name');
    }

    public function getFiles(string $dir): Collection
    {
        $files = collect(File::files($dir))->map(function ($file) {
            return [
                'type' => 'file',
                'name' => $file->getFilename(),
                'link' => 'external-videos/' . $file->getFilename(),
                'size' => $this->formatFileSize($file->getSize()),
                'last_modified' => Carbon::createFromTimestamp($file->getMTime())->diffForHumans(),
            ];
        });

        $dirs = $this->getDirectory($dir);

        return collect([
            'files' => $files,
            'dirs' => $dirs
        ]);
    }

    /**
     * Format file size to human readable format
     */
    private function formatFileSize(int $bytes): string
    {
        return Number::fileSize($bytes);
    }

    /** @param string $folderPath */
    public function exportFormat(?string $folderPath): array
    {
        $data = array_map(fn($file) => $this->format($file), File::files($folderPath));

        return $data;
    }

    private function format($file)
    {
        return [
            '#' => uniqid(),
            'name' =>  $file->getFilename(),
            'path' => $file->getPathname(),
            'size' => $this->formatFileSize($file->getSize()),
        ];
    }
}
