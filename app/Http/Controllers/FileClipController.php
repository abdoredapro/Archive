<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClipRequest;
use App\Models\FileClip;
use Illuminate\Http\Request;
use Pion\Laravel\ChunkUpload\Handler\ResumableJSUploadHandler;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;

class FileClipController extends Controller
{

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        return view('dashboard.file.clip_create', compact('id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClipRequest $request, $id)
    {


        $reciver = new FileReceiver($request->file, $request, ResumableJSUploadHandler::class);

        $save = $reciver->receive();

        if($save->isFinished()) {

            $file = $save->getFile();

            $newFileName = $file->hashName();

            $file->move(storage_path('app/public/files/clips'), $newFileName);

            FileClip::create([
                'file_id' => $id, 
                'name' => $request->name,
                'clip' => $newFileName,
            ]);

            return response()->json(['message' => 'تم اضافه المقطع']);

        }

        
        $handler = $save->handler();

        return response()->json(['progress' => $handler->getPercentageDone()]);

    }

    /**
     * Display the specified resource.
     */
    public function show(FileClip $fileClip)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FileClip $fileClip)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FileClip $fileClip)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FileClip $fileClip)
    {
        //
    }
}
