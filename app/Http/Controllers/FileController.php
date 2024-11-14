<?php

namespace App\Http\Controllers;

use App\Assets;
use App\FileStatus;
use App\Helpers\ImageHelper;
use App\Http\Requests\FileRequest;
use App\Http\Requests\UpdateFileRequest;
use App\Models\File;
use App\Models\FileClip;
use App\Models\Project;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $project_id = request()->query('project');

        $files = File::when($project_id, fn(Builder $query) => $query->where('project_id', $project_id))
            ->paginate(2);

        return view('dashboard.file.index', compact('files'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $projects = Project::all();

        return view('dashboard.file.create', compact('projects'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FileRequest $request)
    {

        $image = $request->file('image');

        $video = $request->file('video');

        $image = ImageHelper::uploadImage($image, FileStatus::FILMIMAGE);

        $video = ImageHelper::uploadImage($video, FileStatus::FILMVIDEO);

        File::create([
            'project_id'   => $request->project_id,
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
                ImageHelper::removeImage(FileStatus::IMAGE . $file->image);
            }

            $image = $request->file('image');

            $imageName = ImageHelper::uploadImage($image, FileStatus::IMAGE);

            $data['image']  = $imageName;
        }


        if ($request->hasFile('video')) {

            if ($file->image) {

                ImageHelper::removeImage(FileStatus::VIDEO . $file->video);

            }

            $video = $request->file('video');

            $videoName = ImageHelper::uploadImage($video, FileStatus::VIDEO);

            $data['video']  = $videoName;

        }

        $file->update($data);


        if ($request->hasFile('file_clip_clip')) {

            $clip = $request->file('file_clip_clip');

            $clipName = ImageHelper::uploadImage($clip, FileStatus::FILECLIP);

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

        ImageHelper::removeImage(FileStatus::IMAGE . $file->image);
        ImageHelper::removeImage(FileStatus::VIDEO . $file->video);

        return to_route('dashboard.file.index');
    }
}
