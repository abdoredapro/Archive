@extends('dashboard.master')


@section('page_title')
    {{ __('dashboard.files') }}
@endsection
@section('content')

<!-- card -->
<div class="file-card hz-padding">

    @if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif
    

    <div class="stack-head">
        <h3 class="title"> ملفات </h3>
            <a href="{{ route('dashboard.file.create') }}">
                <button class="addBtn custom" >
                    {{-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <g fill="none" stroke="white" stroke-width="1.5">
                            <circle cx="12" cy="12" r="10"></circle>
                            <path stroke-linecap="round" d="M15 12h-3m0 0H9m3 0V9m0 3v3"></path>
                        </g>
                    </svg> --}}
                <span class="text-dark">اضافه ملف</span>
                </button>
            </a>
    </div>

    @forelse ($files as $file)
        <a href="{{ route('dashboard.file.show', $file->id) }}">
            <div class="white-row" style="cursor: pointer">
                <div class="img-container">
                    <img src="{{ $file->image_url }}" style="width: 400px;height:300px; max-width:100%" class="image-responsive">
                </div>
                <div class="content-container">
                    <div class="first-row">
                        <h4>{{ $file->name }}</h4>
                        <a href="{{ route('dashboard.file.show', $file->id) }}" class="icon-container">
                            <i class="fa-solid fa-ellipsis-vertical"></i>
                        </a>
                    </div>
    
                    <div class="second-row">
                        <span class="category">{{ $file->project->name }}</span>
                        <span class="other">{{ $file->release_year ?? $file->created_at->year }}</span>
                        {{-- <span class="other">
                                {{ $file->FileDuration() }}
                            </span> --}}
                    </div>
    
                    <div class="third-row text-wrap">
                        {{ $file->description }}
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