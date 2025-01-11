<?php

namespace App\Http\Controllers;

use App\Enum\Assets;
use App\Helpers\ImageHelper;
use App\Http\Requests\FileRequest;
use App\Http\Requests\UpdateFileRequest;
use App\Models\Category;
use App\Models\File;
use App\Models\FileClip;
use App\Models\Project;

class FileController extends Controller
{
    public function index()
    {
        $files = File::paginate(2);

        return view('dashboard.file.index', compact('files'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cateogries = Category::all();

        return view('dashboard.file.create', compact('cateogries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FileRequest $request)
    {
        /** Upload file image - video */
        $image = ImageHelper::uploadImage($request->file('image'), Assets::FILE_IMAGE);

        $video = ImageHelper::uploadImage($request->file('video'), Assets::FILE_VIDEO);

        File::create([
            'category_id'   => $request->category_id,
            'name'          => $request->name,
            'image'         => $image,
            'video'         => $video,
            'description'   => $request->description,
        ]);

        return to_route('dashboard.file.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $file = File::with('clips')->findOrFail($id);

        return view('dashboard.file.show', compact('file'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(File $file)
    {

        $projects = Project::all();

        return view('dashboard.file.edit', compact('file', 'projects'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFileRequest $request, File $file)
    {

        $data = $request->except('image', 'video');

        if ($request->hasFile('image')) {

            if ($file->image) {
                ImageHelper::removeImage(Assets::FILE_IMAGE . $file->image);
            }

            $image = $request->file('image');

            $imageName = ImageHelper::uploadImage($image, Assets::FILE_IMAGE);

            $data['image']  = $imageName;
        }


        if ($request->hasFile('video')) {

            if ($file->image) {

                ImageHelper::removeImage(Assets::FILE_VIDEO . $file->video);

            }

            $video = $request->file('video');

            $videoName = ImageHelper::uploadImage($video, Assets::FILE_VIDEO);

            $data['video']  = $videoName;

        }

        $file->update($data);


        if ($request->hasFile('file_clip_clip')) {

            $clip = $request->file('file_clip_clip');

            $clipName = ImageHelper::uploadImage($clip, Assets::FILE_CLIP);

            FileClip::create([
                'file_id'   => $file->id,
                'name'      => $request->file_clip_name,
                'clip'      => $clipName,
                'minute'    => $request->minute,
                'second'    => $request->second,
                'description' =>  $request->foot_description,
            ]);

        }

        return to_route('dashboard.file.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(File $file)
    {
        $file->delete();

        ImageHelper::removeImage(Assets::FILE_IMAGE . $file->image);
        ImageHelper::removeImage(Assets::FILE_VIDEO . $file->video);

        return to_route('dashboard.file.index');
    }
}
