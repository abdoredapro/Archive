<?php

namespace App\Http\Controllers;

use App\Http\Requests\FilmRequest;
use App\Jobs\UploadVideo;
use App\Models\Category;
use App\Models\Film;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use Pion\Laravel\ChunkUpload\Exceptions\UploadFailedException;
use Pion\Laravel\ChunkUpload\Handler\AbstractHandler;
use Pion\Laravel\ChunkUpload\Handler;
use Pion\Laravel\ChunkUpload\Handler\HandlerFactory;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;

class FilmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $films = Film::paginate(2);
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
        
        $image = $request->file('image');

        $video = $request->file('video');

        try {
            $imgName = time() . Str::random(10) . '.' . $image->getClientOriginalExtension();

            $videoName = time() . Str::random(10) . '.' . $video->getClientOriginalExtension();

            $image->storeAs('films/images', $imgName, [
                'disk' => 'public'
            ]);

            $video->storeAs('films/videos', $videoName, [
                'disk' => 'public'
            ]);

            Film::create([
                'category_id'   => $request->category_id,
                'name'          => $request->name,
                'image'         => $imgName,
                'video'         => $videoName,
                'film_script'   => $request->film_script,
                'info'          => $request->editor1,
            ]);

            return to_route('dashboard.film.index')->with([
                
                'message' => 'تم اضافه الفيلم بنجاح.'
            ]);

        } catch (Exception $e) {

            return to_route('dashboard.film.index')->with([
                'message' => 'Error'
            ]);
        }

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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Film $film)
    {
        //
    }
}
