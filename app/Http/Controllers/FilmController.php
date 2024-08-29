<?php

namespace App\Http\Controllers;

use App\FileStatus;
use App\Http\Requests\FilmRequest;
use App\Jobs\UploadVideo;
use App\Models\Category;
use App\Models\Film;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Pion\Laravel\ChunkUpload\Exceptions\UploadFailedException;
use Pion\Laravel\ChunkUpload\Handler\AbstractHandler;
use Pion\Laravel\ChunkUpload\Handler;
use Pion\Laravel\ChunkUpload\Handler\HandlerFactory;
use Pion\Laravel\ChunkUpload\Handler\ResumableJSUploadHandler;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;

class FilmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $films = Film::paginate(30);
        $categories = Category::all();

        return view('dashboard.film.index', compact('films','categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $films = Film::paginate();
        $categories = Category::all();
        return view('dashboard.film.create', compact('films','categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FilmRequest $request)
    {

        $reciver = new FileReceiver($request->file, $request, ResumableJSUploadHandler::class);

        $save = $reciver->receive();

        if($save->isFinished()) {

            $file = $save->getFile();

            $image = $request->fileImage;

            $imgName = Str::uuid() . '.' . $image->getClientOriginalExtension();

            $newFileName = $file->hashName();

            $image->move(storage_path('app/public/films/images'), $imgName);

            $file->move(storage_path('app/public/films/videos'), $newFileName);

            
            Film::create([
                'category_id'   => $request->fileCategory,
                'name'          => $request->fileName,
                'image'         => $imgName,
                'video'         => $newFileName,
                'film_script'   => $request->fileDescription,
            ]);

            return response()->json(['message' => 'Your Film uploaded']);

        }

        $handler = $save->handler();

        return response()->json(['progress' => $handler->getPercentageDone()]);
        

    }



    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $film = Film::with('category')->findOrFail($id);

        return view('dashboard.film.show', compact('film'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Film $film)
    {
        $categories = Category::all();
        
        return view('dashboard.film.edit', compact('film', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Film $film)
    {
        $request->validate([
            'category_id'   => ['required', 'int', 'exists:categories,id'],
            'name'          => ['required', 'string'],
            'image'         => ['image', 'mimes:jpeg,jpg,png,gif,svg'],
            'video'         => ['mimes:mp4','mimetypes:video/mp4'],
            'film_script'   => ['required', 'string'],
            'file_clip_name' => [
                Rule::requiredIf(function () use($request) {
                    return $request->has('file_clip_clip');
                }),
                'max:255'
            ],
            'minute' => [
                Rule::requiredIf(function () use($request) {
                    return $request->has('file_clip_clip');
                }),
            ],
            'second' => [
                Rule::requiredIf(function () use($request) {
                    return $request->has('file_clip_clip');
                }),
            ],

        ]);

        // If user upload Image

        $data = $request->all();




        if($request->hasFile('image')) {

            // check if file has image then remove it.
            if($film->image) {
                Storage::disk('public')->delete(FileStatus::FILMIMAGE . $film->image);
            }


            // uploading Image
            $image = $request->file('image');

            $imageName = Str::uuid() . '.' . $image->getClientOriginalExtension();

            $image->storeAs('films/images', $imageName, [
                'disk' => 'public'
            ]);
        
            $data['image']  = $imageName;
        }


        if($request->hasFile('video')) {

            if($film->image) {
                Storage::disk('public')->delete(FileStatus::FILMVIDEO . $film->video);
            }

            $video = $request->file('video');

            $videoName = Str::uuid() . '.' . $video->getClientOriginalExtension();

            $video->storeAs('films/videos', $videoName, [
                'disk' => 'public'
            ]);

            $data['video']  = $videoName;
        }
    

        $film->update($data);

        if($request->file('file_clip_clip')) {

            $clip = $request->file('file_clip_clip');

            $clipName = Str::uuid() . '.' . $clip->getClientOriginalExtension();

            $clip->storeAs('films/clips', $clipName, [
                'disk' => 'public'
            ]);

            // FilmCl::create([
            //     'file_id'   => $file->id, 
            //     'name'      => $request->file_clip_name,
            //     'clip'      => $clipName, 
            //     'minute'    => $request->minute,
            //     'second'    => $request->second,
            // ]);
        }
        return to_route('dashboard.film.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Film $film)
    {
        //
    }
}
