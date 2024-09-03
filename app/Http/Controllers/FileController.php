<?php

namespace App\Http\Controllers;

use App\Factories\FileFactory;
use App\Factories\ProcessUpload;
use App\FileStatus;
use App\Http\Requests\FileRequest;
use App\Models\File;
use App\Models\FileClip;
use App\Models\Project;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Pion\Laravel\ChunkUpload\Handler\ResumableJSUploadHandler;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = File::query();

        if($project_id = request()->query('project')) {
            $query->where('project_id', $project_id);
        }
        $files = $query->paginate(4);

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

        $imgName = Str::uuid() . '.' . $image->getClientOriginalExtension();

        $vidName = Str::uuid() . '.' . $video->getClientOriginalExtension();


        $image->storeAs('files/images', $imgName, [
            'disk' => 'public',
        ]);

        $video->storeAs('files/videos', $vidName, [
            'disk' => 'public',
        ]);


        File::create([
            'project_id'   => $request->project_id,
            'name'          => $request->name,
            'image'         => $imgName,
            'video'         => $vidName,
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
    public function update(Request $request, File $file)
    {
        $request->validate([
            'image'         => ['image', 'mimes:jpg,jpeg,png,gif,svg'],
            'video'         => ['mimes:mp4', 'mimetypes:video/mp4'],
            'project_id'    => ['required', 'int', 'exists:projects,id'],
            'name'          => ['required', 'string', 'min:3', 'max:255'],
            'description'   => ['required', 'string'],
            'file_clip_name' => [
                Rule::requiredIf(function () use ($request) {
                    return $request->has('file_clip_clip');
                }),
                'max:255'
            ],
            'minute' => [
                Rule::requiredIf(function () use ($request) {
                    return $request->has('file_clip_clip');
                }),
            ],
            'second' => [
                Rule::requiredIf(function () use ($request) {
                    return $request->has('file_clip_clip');
                }),
            ],

        ]);

        // If user upload Image

        $data = $request->except('image', 'video');



        if ($request->hasFile('image')) {


            // check if file has image then remove it.
            if ($file->image) {
                Storage::disk('public')->delete(FileStatus::IMAGE . $file->image);
            }


            // uploading Image
            $image = $request->file('image');

            $imageName = Str::uuid() . '.' . $image->getClientOriginalExtension();

            $image->storeAs('files/images', $imageName, [
                'disk' => 'public'
            ]);

            $data['image']  = $imageName;
        }


        if ($request->hasFile('video')) {

            if ($file->image) {
                Storage::disk('public')->delete(FileStatus::VIDEO . $file->video);
            }

            $video = $request->file('video');

            $videoName = Str::uuid() . '.' . $video->getClientOriginalExtension();

            $video->storeAs('files/videos', $videoName, [
                'disk' => 'public'
            ]);

            $data['video']  = $videoName;
        }


        $file->update($data);



        // upload file clip

        if ($request->hasFile('file_clip_clip')) {
            // $clip = $request->file('file_clip_clip');

            // $clipName = Str::uuid() . '.' . $clip->getClientOriginalExtension();

            // $clip->storeAs('files/clips', $clipName, [
            //     'disk' => 'public'
            // ]);

            // FileClip::create([
            //     'file_id'   => $file->id, 
            //     'name'      => $request->file_clip_name,
            //     'clip'      => $clipName, 
            //     'minute'    => $request->minute,
            //     'second'    => $request->second,
            // ]);

        }

        return to_route('dashboard.file.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(File $file)
    {
        $file->delete();

        Storage::disk('public')->delete('files/images/' . $file->image);
        Storage::disk('public')->delete('files/videos/' . $file->video);

        return to_route('dashboard.file.index');
    }
}
