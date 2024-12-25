<div>
    <a href="{{ route('dashboard.file.create') }}">
        <button class="addBtn add-btn custom">
            <span class="text-dark">اضافه ملف يدوى</span>
        </button>
    </a>

    <a href="{{ route('excel.import.index') }}">
        <button class="addBtn add-btn custom" >
            <span class="text-dark">تصدير ملف اكسل</span>
        </button>
    </a>


    <a wire:click="export">
        <button class="addBtn add-btn custom">
            <span class="text-dark">استيراد ملف اكسل</span>
        </button>
    </a>

    @if ($exporting && !$exportFinished)
        <div class="text-dark mt-3" style="text-align: left" wire:poll="updateExportProgress">جارى التحميل</div>
    @endif

    @if ($exportFinished)
        <div class="text-dark mt-3" style="text-align: left; cursor: pointer" wire:click="downloadExport" >للتحميل اضغط هنا</div>
    @endif
    
</div>
