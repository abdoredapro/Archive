<?php

namespace App\Services;

use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileService {

    public function uploadImage(Request $request, File $file, $data) {
        // check if file has image then remove it.
        if($file->image) {
            Storage::disk('public')->delete($file->ImageUrl());
        }

        // uploading Image
        $image = $request->file('image');

        $imageName = Str::uuid() . '.' . $image->getClientOriginalExtension();

        $image->storeAs('files/images', $imageName, [
            'disk' => 'public'
        ]);
    
        $data['image']  = $imageName;


    }


    public function uploadVideo(Request $request, File $file, $data) {
        
        if($file->video) {
            Storage::disk('public')->delete($file->VideoUrl());
        }

        $video = $request->file('video');

        $videoName = Str::uuid() . '.' . $video->getClientOriginalExtension();

        $video->storeAs('files/videos', $videoName, [
            'disk' => 'public'
        ]);

        $data['video']  = $videoName;



    }



}