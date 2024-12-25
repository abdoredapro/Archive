<?php

namespace App\Livewire;

use App\Exports\VideoExport;
use App\Jobs\ExportJob;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class Export extends Component
{
    public $exporting = false;
    public $exportFinished = false;
    public $batchId;

    public function export()
    {
        $this->exporting = true;

        $batch = Bus::batch([
            new ExportJob()
        ])->dispatch();

        $this->batchId = $batch->id;
    }

    public function getExportBatchProperty()
    {
        if (! $this->batchId) {
            return null;
        }

        return Bus::findBatch($this->batchId);
    }

    public function updateExportProgress()
    {
        $this->exportFinished = $this->exportBatch->finished();
        if ($this->exportFinished) {
            $this->exporting = false;
        }
    }

    public function downloadExport()
    {
        return Storage::download('orders.xlsx');
    }

    public function render()
    {
        return view('livewire.export');
    }
}
