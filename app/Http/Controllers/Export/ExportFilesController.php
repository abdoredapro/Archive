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

        $folderPath = $request->input('files');

        if (!File::isDirectory($folderPath)) {
            return response()->json(['error' => 'المسار المدخل غير صحيح أو الفولدر غير موجود.'], 400);
        }

        $videoFiles = File::allFiles($folderPath);


        $videoExtensions = ['mp4', 'avi', 'mkv', 'flv', 'wmv'];
        $videos = [];

        foreach ($videoFiles as $file) {
            if (in_array(strtolower($file->getExtension()), $videoExtensions)) {
                $videos[] = [
                    'name' => $file->getFilename(),
                    'path' => $file->getRealPath(),
                    'size' => $file->getSize(),
                ];
            }
        }

        if (count($videos) === 0) {
            return response()->json(['message' => 'لا توجد فيديوهات في هذا الفولدر.']);
        }

        return Excel::download(new VideoExport($videos), 'vieos.xlsx');


    }
}
