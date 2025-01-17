<?php

namespace App\Http\Controllers;

use App\FileStatus;
use App\Http\Requests\FilmRequest;
use App\Models\Category;
use App\Models\Film;
use App\Models\FilmClip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;


class FilmController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    private $pages = 18;

    public function index()
    {

        $query = Film::query();

        if(request()->query('category')) {
            $query->where('category_id', request()->query('category'));
        }
        
        $films = $query->paginate($this->pages);

        return view('dashboard.film.index', compact('films'));
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
        
        $video = $request->file('video');

        $image = $request->image;

        $imgName = Str::uuid() . '.' . $image->getClientOriginalExtension();

        $videoName = uniqid() . '.' . $video->getClientOriginalExtension();

        $video->storeAs(FileStatus::FILMVIDEO, $videoName, [
            'disk' => 'public'
        ]);

        $image->storeAs(FileStatus::FILMIMAGE, $imgName, [
            'disk' => 'public'
        ]);

        
        Film::create([
            'category_id'   => $request->category_id,
            'name'          => $request->name,
            'image'         => $imgName,
            'video'         => $videoName,
            'film_script'   => $request->description,
        ]);

        return to_route('dashboard.film.index')
            ->with(['message' => 'تم اضافه الفيلم بنجاح']);



    }



    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $film = Film::with('category', 'clips')->findOrFail($id);


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
            'foot_description' => ['nullable', 'string'],

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

            FilmClip::create([
                'film_id'   => $film->id,
                'name'      => $request->file_clip_name,
                'clip'      => $clipName,
                'minute'    => $request->minute,
                'second'    => $request->second,
                'description' => $request->foot_description
            ]);
        }

        
        return to_route('dashboard.film.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Film $film)
    {
        $clips = $film->clips;


        
        // Delete All clips
        foreach($clips as $clip) {

            Storage::disk('public')->delete('films/clips/' . $clip->clip);

            $clip->delete();
        }


        $film->delete();

        Storage::disk('public')->delete('films/images/' . $film->image);
        Storage::disk('public')->delete('films/videos/' . $film->video);

        

        return to_route('dashboard.file.index');


    }
}
