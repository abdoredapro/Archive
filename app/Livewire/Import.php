<?php

namespace App\Livewire;

use App\Imports\FileImport;
use App\Jobs\ImportJob;
use App\Models\File;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class Import extends Component
{
    use WithFileUploads;

    public $importing = false;
    public $importFinished = false;
    public $importFilePath;
    public $batchId;
    public $importFile;


    public function import()
    {

        $this->importing = true;
        
        $this->importFilePath = $this->importFile->store('import');

        $batch = Bus::batch(
            new ImportJob($this->importFilePath),
        )->dispatch();

        $this->batchId = $batch->id;
    }

    public function getImportBatchProperty()
    {
        if (! $this->batchId) {
            return null;
        }

        return Bus::findBatch($this->batchId);
    }

    public function updateImportProgress()
    {
        $this->importFinished = $this->importBatch->finished();
        if ($this->importFinished) {
            Storage::delete($this->importFilePath);
            $this->importing = false;
        }
    }



    public function render()
    {
        return view('livewire.import');
    }
}
