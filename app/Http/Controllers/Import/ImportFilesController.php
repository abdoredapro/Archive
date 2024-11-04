<?php

namespace App\Http\Controllers\Import;

use App\Http\Controllers\Controller;
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
            'excel-file' => 'required|mimes:xlsx,xls',
        ]);

        $data = Excel::toArray(new class implements ToArray {
            public function array(array $array)
            {
                return $array;
            }
        }, $request->file('excel-file'));

        $sheetData = $data[0]; 

        dd($sheetData);
    }
}
