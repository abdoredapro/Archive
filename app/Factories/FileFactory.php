<?php

namespace App\Factories;

use App\Services\FileService;

class FileFactory {

    public function processImage($request, $file)
    {
        if($request->hasFile('image')) {

            $service = new FileService();

            $service->uploadImage($request, $file);

        }
    }

    public function processVideo($request, $file)
    {
        if($request->hasFile('video')) {

            $service = new FileService();

            $service->uploadImage($request, $file,);

        }
    }

}