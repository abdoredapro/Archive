<?php

namespace App\Http\Controllers\Server;

use App\Exports\VideoExport;
use App\Http\Controllers\Controller;
use App\Services\ManageServer;
use Illuminate\Support\Facades\Response;
use Maatwebsite\Excel\Facades\Excel;

class ServerController extends Controller
{
    public function __construct(
        public ManageServer $server
    ) {}

    public function index()
    {
        return view('dashboard.server.index', [
            'servers' => $this->server->servers()->toArray()
        ]);
    }

    public function show()
    {
        $dir = request('path');

        return view('dashboard.server.show', [
            'files' => $this->server->getDirectory(dir: $dir)->toArray()
        ]);
    }

    public function getFiles()
    {
        $dir = request('path');

        return view('dashboard.server.files', [
            'files' => $this->server->getFiles(dir: $dir)->toArray(),
        ]);
    }

    public function exportFiles()
    {
        $path = request('path', '/');

        $array = $this->server->exportFormat($path); 

        return Excel::download(new VideoExport($array), 'data.xlsx');
    }
}
