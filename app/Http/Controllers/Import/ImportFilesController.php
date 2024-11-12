<?php

namespace App\Http\Controllers\Import;

use App\Http\Controllers\Controller;
use App\Imports\FileImport;
use App\Models\Category;
use App\Models\File;
use App\Models\Project;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\ToArray;
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
            'excel-file' => 'required|file|mimes:xlsx,xls',
        ]);

        $file =  $request->file('excel-file');

        $data = Excel::toArray(new FileImport, $file);

        // التكرار عبر البيانات لإضافة المنتجات والفئات
        foreach ($data[0] as $row) {

            $name           = $row['name'];
            $path           = $row['filepath'];
            $size           = $row['size'];
            $shotDate       = $row['shotdate'];
            $duration       = $row['duration'];
            $category       = $row['category'];
            $project        = $row['project'];

            $project_id = Project::firstOrCreate(['name' => $project])->id;

            $category_id = Category::firstOrCreate(['name' => $category])->id;

            $file = File::create([
                'project_id'        => $project_id,
                'category_id'       => $category_id,
                'name'              => $name, 
                'image'             =>  '',
                'video'             => $path,
                'description'       => 'description',
                'type' => 'excel',
            ]);

        }

        return redirect()->route('dashboard.file.index');
    }
}
