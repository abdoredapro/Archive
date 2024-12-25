<?php

namespace App\Jobs;

use App\Exports\VideoExport;
use Illuminate\Bus\Batchable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class ExportJob implements ShouldQueue
{
    use Queueable, Batchable;

    public function handle()
    {
        (new VideoExport)->store('orders.xlsx');
    }
}
