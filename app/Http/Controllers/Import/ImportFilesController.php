<?php

namespace App\Http\Controllers\Import;

use App\Http\Controllers\Controller;
use App\Imports\FileImport;
use App\Jobs\ImportJob;
use App\Livewire\Import;
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

            ImportJob::dispatch($data);

            return redirect()->route('dashboard.file.index')
                ->with(['info' => 'جارى معالجه الملف']);

        } catch (\Throwable $e) {
            return redirect()->route('dashboard.file.index')
            ->with(['error' => 'الرجاء اكمال البيانات واعاده المحاوله لاحقا.']);
        }
    }
}
