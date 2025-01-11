<?php

namespace App\Http\Controllers\Import;

use App\Http\Controllers\Controller;
use App\Imports\FileImport;
use App\Models\Category;
use App\Models\File;
use App\Models\Project;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

final class ImportFilesController extends Controller
{
    public function index()
    {
        return view('dashboard.import.index');
    }
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file',
        ]);

        try {

            $file =  $request->file('file');
            
            $data = Excel::toArray(new FileImport, $file);

            foreach ($data[0] as $row) {
                $name       = $row['name'];
                $path       = $row['filepath'];
                $size       = $row['size'];
                $shotDate   = $row['shotdate'];
                $duration   = $row['duration'];
                $category   = $row['category'];
                $project    = $row['project'];
                $desctription    = $row['script'];
                $tapType    = $row['tapetype'];
                $tapNumber    = $row['tapeno'];
                $director    = $row['director'];
                $producer    = $row['producer'];
                $music    = $row['music'];
                $sound    = $row['sound'] ?? null;
                $cameraMan    = $row['cameraman'] ?? null;

                $project_id = Project::firstOrCreate(['name' => $project])->id;
                $category_id = Category::firstOrCreate(['name' => $category])->id;
                File::create([
                    'project_id'        => $project_id,
                    'category_id'       => $category_id,
                    'name'              => 'asdsad',
                    'video'             => $path,
                    'description'       => $desctription,
                    'tap_type'          => $tapType,
                    'tap_number'          => $tapNumber,
                    'director'          => $director,
                    'producer'          => $producer,
                    'sound'          => $producer,
                    'camera_man'          => $cameraMan,
                ]);

            }

            return redirect()->route('dashboard.file.index')
                ->with(['success' => 'تم الاضافه بنجاح']);

        } catch (\Exception $e) {
            throw $e;
            return redirect()->route('dashboard.file.index')
            ->with(['error' => 'الرجاء اكمال البيانات واعاده المحاوله لاحقا.']);
        }
    }
}
