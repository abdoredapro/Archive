<div class="footer hz-padding">
    <div class="stack">
        <div class="stack-header">
            <h4>الملفات</h4>
            <p>الملفات المقترحه</p>
        </div>
        <div class="show-all">
            <a href="{{ route('dashboard.file.index') }}">عرض الكل</a>
        </div>
    </div>

    <div class="text-center mt-5">
        <div class="row row-gap-3">
            @forelse ($files as $file)
            <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3">
                <a href="{{ route('dashboard.file.show', $file->id) }}">
                    <div class="card">
                        <img src="{{ $file->imageUrl() }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h6>{{ $file->name }}</h6>
                            <p>{{ $file->created_at->year}} | {{ $file->project->name }}</p>
                        </div>
                    </div>
                </a>
            </div>
            @empty
                <div class="text-center text-dark">لايوجد ملفات حاليا.</div>
            @endforelse
        </div>
    </div>
</div>