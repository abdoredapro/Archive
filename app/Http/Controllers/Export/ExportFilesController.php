<?php

namespace App\Http\Controllers\Export;

use App\Exports\VideoExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

final class ExportFilesController extends Controller
{
    public function index()
    {
        return view('dashboard.exports.index');
    }

    public function export(Request $request)
    {
        $request->validate([
            'files' => 'required',
        ]);

            $uploadedFiles = $request->file('files');
            $filePaths = [];

            foreach ($uploadedFiles as $file) {

                $relativePath = $file->getClientOriginalName();

                $path = $file->storeAs('folders', $relativePath, 'public');

                $filePaths[] = Storage::url($path);
            }

        

        $Excel = Excel::download(new VideoExport(), 'files.xlsx');
        
        return $Excel;



    }
}
