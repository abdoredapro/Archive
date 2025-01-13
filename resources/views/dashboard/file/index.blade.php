@extends('dashboard.master')

@section('page_title')
    {{ __('dashboard.files') }}
@endsection

@section('style')
    <style>
        .add-btn {
            padding: 14px 12px;
        }
    </style>
@endsection
@section('content')

<!-- card -->
<div class="file-card hz-padding">

    @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif
    
    

    <div class="head d-flex justify-content-between align-items-center pt-4 pb-4" >
        <div class="title">
            <h1 class="h3 text-dark"> ملفات</h1>
        </div>
        <div class="btns">
            <a href="{{ route('dashboard.file.create') }}">
                <button class="addBtn add-btn custom me-2 ms-2" style="border-radius: 5px; border: none;">
                    <i class="fa-solid fa-plus"></i>
                    <span class="text-dark">اضافه ملف يدوى</span>
                </button>
            </a>

        <a href="{{ route('excel.import.index') }}" >
            <button class="addBtn add-btn custom me-2 ms-2" style="border-radius: 5px; border: none;">
                <i class="fa-solid fa-upload"></i>
                <span class="text-dark">رفع ملف اكسيل</span>
            </button>
        </a>

        <a href="{{ route('excel.import.index') }}" >
            <button class="addBtn add-btn custom me-2 ms-2" style="border-radius: 5px; border: none;">
                <i class="fa-regular fa-folder"></i>
                <span class="text-dark">الملفات</span>
            </button>
        </a>



        </div>
    </div>




    @forelse ($files as $file)
        <a href="{{ route('dashboard.file.show', $file->id) }}">
            <div class="white-row " style="cursor: pointer" >
                <div class="img-container">
                    <img src="{{ $file->image_url }}" style="width: 400px;height:300px; max-width:100%" class="image-responsive">
                </div>
                <div class="content-container">
                    <div class="first-row">
                        <h4>{{ Str::limit($file->name, 25, '...') }}</h4>
                        <a href="{{ route('dashboard.file.show', $file->id) }}" class="icon-container">
                            <i class="fa-solid fa-ellipsis-vertical"></i>
                        </a>
                    </div>
    
                    <div class="second-row">
                        <span class="category">{{ $file->category->name }}</span>
                        <span class="other">{{ $file->release_year ?? $file->created_at->year }}</span>
                        {{-- <span class="other">
                                {{ $file->FileDuration() }}
                            </span> --}}
                    </div>
    
                    <div class="third-row text-wrap">
                        {{ Str::limit($file->description, 25, '...') }}
                    </div>
    
                    <div class="forth-row">
                        <a href="{{ route('dashboard.file.show', $file->id) }}">
                            <button class="watchnow">
                                <i class="fa-solid fa-play"></i>
                                <span>المشاهدة الأن</span>
                            </button>
                        </a>
                        <button class="download">
                            <a href="{{ $file->video_url }}" download>
                                <i class="fa-solid fa-cloud-arrow-down"></i>
                                <a href="{{ $file->video_url }}" download>تحميل</a>
                            </a>
                        </button>
                    </div>
                </div>
            </div>
        </a>
    @empty
        <div class="text-dark text-center">لايوجد ملفات الان</div>
    @endforelse


    {{ $files->links() }}

</div>


<!-- card -->

<!-- footer -->
<x-file-suggest />
<!-- footer -->


<x-import.import-excel />


@endsection

@section('script')
<script>


    // to display the upload image
    function displayImage(event) {
        const image = document.getElementById('uploaded-image');
        const file = event.target.files[0];
        const reader = new FileReader();

        reader.onload = function (e) {
            image.src = e.target.result;
            image.style.display = 'block';
        };

        if (file) {
            reader.readAsDataURL(file);
        }
    }

    const signupForm = document.getElementById('submit_btn');

    signupForm.addEventListener("submit", function(event) {
        console.log(event);
        event.preventDefault();
    });
</script>
@endsection