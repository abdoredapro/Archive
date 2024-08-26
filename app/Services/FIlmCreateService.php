<?php

namespace App\Services;

class FilmCreate {
    public function __construct()
    {
        
        $image = $request->file('image');

        // $myUnique = Str::uuid();
        // Start Chunk Upload
        $fileReceiver = new FileReceiver('video', $request, HandlerFactory::classFromRequest($request));

        // $fileReceiver->chunkSize(2 * 1024 * 1024); // Optional, default 2MB

        $save = $fileReceiver->receive();

        try {
            
            if ($save->isFinished()) {
                
                $file = $save->getFile();
                
                $imageName = time() . Str::random(5) . '.' . $image->getClientOriginalExtension();
                
                $videoName = time() . Str::random(5) . '.' . $file->getClientOriginalExtension();
                

                $image->storeAs('films/images', $imageName, [
                    'disk' => 'public',
                ]);
        
                $file->storeAs('films/videos', $videoName, [
                    'disk' => 'public',
                ]);


                Film::create([
                    'category_id' => $request->category_id,
                    'name' => $request->name,
                    'image' => $imageName,
                    'video' => $videoName,
                    'film_script' => $request->film_script,
                ]);

                return redirect()->route('dashboard.film.index')
                    ->with('video Uploaded');

            }

        } catch (UploadFailedException $exception) {

            return redirect()->route('dashboard.film.index')
                    ->with([
                        'message' => 'Error Please try again'
                    ]);
        }

    }
}