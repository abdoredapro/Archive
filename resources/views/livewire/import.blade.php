<div>
    <div class="upload-excel">
        <div class="container">
            <div class="h2">تحميل ملف اكسيل</div>

            <div class="upload">
                <form wire:submit.prevent="import" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="excel-file" class="form-label"></label>
                        <input type="file" wire:model="importFile">

                        @error('importFile')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <button class="btn btn-primary d-block mt-3">تحميل</button>
                    </div>

                    
                    @if ($importing && !$importFinished)
                        <div class="mt-3" wire:poll.1000ms="updateImportProgress">جارى الرفع ...</div>
                    @endif

                    @if($importFinished)
                        <div class="mt-3">تم الرفع بنجاح</div>
                    @endif

                </form>
            </div>
        </div>
    </div>

</div>
