{{-- <div>
        <div class="upload-excel">
        <div class="container">
            <div class="h2">تحميل الملف المطلوب</div>

            <div class="upload">
                <form wire:submit.prevent="import" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="excel-file" class="form-label"></label>
                        <input type="file" wire:model="importFile" webkitdirectory multiple>

                        @error('importFile')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <button class="btn btn-primary d-block mt-3">تحميل</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    @if ($exporting && !$exportFinished)
        <div class="text-dark mt-3" style="text-align: left" wire:poll="updateExportProgress">جارى التحميل</div>
    @endif

    @if ($exportFinished)
        <div class="text-dark mt-3" style="text-align: left; cursor: pointer" wire:click="downloadExport" >للتحميل اضغط هنا</div>
    @endif
    
</div> --}}
