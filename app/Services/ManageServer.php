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
                'link' => 'E:\\',
                'name' => 'Server 1',
                'asset' => 'server1/'
            ],
            2 => [
                'link' => 'D:\\',
                'name' => 'Server 2',
                'asset' => 'server2/',
            ],

        ]);
    }

    public function getDirectory(string $dir, int $id): Collection
    {
        $dirs = collect(File::directories($dir));

        $directories = $dirs->map(function ($dir) use ($id) {
            return [
                'server_id' => $id,
                'type' => 'directory',
                'name' => File::name($dir),
                'link' => $dir
            ];
        });

        return $directories->sortBy('name');
    }

    public function getFiles(string $dir, int $id): Collection
    {
        $files = collect(File::files($dir))->map(function ($file) use ($id) {
            return [
                'server_id' => $id,
                'type' => 'file',
                'name' => $file->getFilename(),
                'link' => $this->servers()[$id]['asset'] . substr($file->getPathname(), 3),
                'size' => $this->formatFileSize($file->getSize()),
                'last_modified' => Carbon::createFromTimestamp($file->getMTime())->diffForHumans(),
            ];
        });

        $dirs = $this->getDirectory($dir, $id);

        return collect([
            'files' => $files,
            'dirs' => $dirs
        ]);
    }

    private function formatFileSize(int $bytes): string
    {
        return Number::fileSize($bytes);
    }

    /**
     * @param string|null $folderPath
     * @param int $id
     *
     * @return array
     */
    public function exportFormat(?string $folderPath, int $id): array
    {
        return array_map(fn($file) => $this->format($file), collect(File::files($folderPath))->map(function ($file) use ($id) {
            return [
                'server_id' => $id,
                'type' => 'file',
                'name' => $file->getFilename(),
                'link' => asset($this->servers()[$id]['asset'] . substr($file->getPathname(), 3)),
                'size' => $this->formatFileSize($file->getSize()),
                'last_modified' => Carbon::createFromTimestamp($file->getMTime())->diffForHumans(),
            ];
        })->toArray());
    }

    private function format($file)
    {
        return [
            '#' => uniqid(),
            'name' => data_get($file, 'name'),
            'path' => data_get($file, 'link'),
            'size' => data_get($file, 'size'),
        ];
    }

    /**
     * Get total used space of all servers
     *
     * @return int $GB
     */
    public function getAllSpace(): int
    {
        $data = $this->servers()->map(function ($server) {
            return [
                'space' => $this->getSpace($server['link']),
            ];
        });

        return $data->sum('space');

    }

    public function getSpace(string $dir): int
    {
        $totalSpace = disk_total_space($dir);
        $freeSpace = disk_free_space($dir);

        $usedSpace = $totalSpace - $freeSpace;

        return $usedSpace / (1024 * 1024 * 1024);
    }
}
