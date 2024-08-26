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
        $files = File::with('project')->paginate(3);

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

        $reciver = new FileReceiver($request->file, $request, ResumableJSUploadHandler::class);

        $save = $reciver->receive();

        if($save->isFinished()) {

            $file = $save->getFile();

            $image = $request->fileImage;

            $imgName = Str::uuid() . '.' . $image->getClientOriginalExtension();

            $newFileName = $file->hashName();

            $image->move(storage_path('app/public/files/images'), $imgName);

            $file->move(storage_path('app/public/files/videos'), $newFileName);

            

            // // get duration
            // $getID3 = new \getID3;
            // $file = $getID3->analyze(storage_path('app/public/files/videos'. $newFileName));

            // $playtime_seconds = $file['playtime_seconds'];

            // $hour = date('H', $playtime_seconds);
            // $minutes = date('i', $playtime_seconds);
            // $seconds = date('s', $playtime_seconds);
            
            File::create([
                'project_id'   => $request->fileCategory,
                'name'          => $request->fileName,
                'image'         => $imgName,
                'video'         => $newFileName,
                'description'   => $request->fileDescription,
                'hours'   => '1',
                'minutes'   => '1',
                'seconds'   => '1',
            ]);

            return response()->json(['message' => 'Your file uploaded']);

        }

        $handler = $save->handler();

        return response()->json(['progress' => $handler->getPercentageDone()]);

        //     // get duration
        //     $getID3 = new \getID3;
        //     $file = $getID3->analyze(storage_path('app/public/'.$path));

        //     $playtime_seconds = $file['playtime_seconds'];

        //     $hour = date('H', $playtime_seconds);
        //     $minutes = date('i', $playtime_seconds);
        //     $seconds = date('s', $playtime_seconds);


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
            'image'         => ['nullable', 'image', 'mimes:jpg,jpeg,png,gif,svg'], 
            'video'         => ['nullable', 'mimes:mp4','mimetypes:video/mp4'],
            'project_id'    => ['required', 'int', 'exists:projects,id'],
            'name'          => ['required', 'string', 'min:3', 'max:255'],
            'description'   => ['required', 'string'],
            'info'          => ['string'],
        ]);

        // If user upload Image

        $data = $request->except('image', 'video');

        // $proccess = new FileFactory();

        // $proccessImage = $proccess->processImage($request, $file, $data);

        // $proccessVideo = $proccess->processVideo($request, $file, $data);


        if($request->hasFile('image')) {


            // check if file has image then remove it.
            if($file->image) {
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


        if($request->hasFile('video')) {

            if($file->image) {
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

        return to_route('dashboard.file.index');



    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(File $file)
    {
        $file->delete();

        Storage::disk('public')->delete('files/images/'.$file->image);
        Storage::disk('public')->delete('files/videos/'.$file->video);

        return to_route('dashboard.file.index');
    }

}
