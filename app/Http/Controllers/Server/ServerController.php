<?php

namespace App\Http\Controllers\Server;

use App\Exports\VideoExport;
use App\Http\Controllers\Controller;
use App\Services\ManageServer;
use Illuminate\Support\Facades\Response;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ServerController extends Controller
{
    public function __construct(
        public ManageServer $server
    )
    {
    }

    public function index()
    {
        return view('dashboard.server.index', [
            'servers' => $this->server->servers()->toArray()
        ]);
    }

    public function show()
    {
        $dir = request('path');
        $id = request('id');

        return view('dashboard.server.show', [
            'files' => $this->server->getDirectory(dir: $dir, id: $id)->toArray()
        ]);
    }

    public function getFiles()
    {
        $dir = request('path');
        $id = request('id');

        return view('dashboard.server.files', [
            'files' => $this->server->getFiles(dir: $dir, id: $id)->toArray(),
        ]);
    }

    public function exportFiles(): BinaryFileResponse
    {
        $path = request('path', '/');
        $id = request('id');

        $array = $this->server->exportFormat($path, $id);

        return Excel::download(new VideoExport($array), 'data.xlsx');
    }
}
