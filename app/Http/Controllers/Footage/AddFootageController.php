<?php

namespace App\Http\Controllers\Footage;

use App\Http\Controllers\Controller;
use App\Models\File;
use Carbon\Carbon;
use FFMpeg\Coordinate\TimeCode;
use FFMpeg\FFMpeg;
use FFMpeg\Format\Video\X264;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

final class AddFootageController extends Controller
{

    public function store(Request $request)
    {
        $StartTime = $request->post('StartTime');
        $EndTime = $request->post('EndTime');
        $FootageName = $request->post('FootageName');
        $fileId = $request->post('fileId');

        $file = File::find($fileId);

        $file->clips()->create([
            'name' => $FootageName ?? 'مقطع جديد',
            'time' => $StartTime,
            'clip' => $file->video,
        ]);

        return 'done';
    }

}
