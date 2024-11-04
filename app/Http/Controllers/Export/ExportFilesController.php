<?php

namespace App\Http\Controllers\Export;

use App\Exports\VideoExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

final class ExportFilesController extends Controller
{
    public function index() {
        return view('dashboard.exports.index');
    }
    public function export()
    {
        return Excel::download(new VideoExport(), 'data.xlsx');
    }
}
