@extends('dashboard.master')


@section('style')
<link rel="stylesheet" href="{{ asset('css/movies.css') }}">
@endsection

@section('page_title')
اضافه ملف
@endsection

@section('content')

<div class="categories">

    <div class="text-center">

        <div class="first-white-board hz-padding">
            <h3 class="title">اضافه ملف</h3>

            <form action="{{ route('dashboard.file.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                @include('dashboard.file._form', [
                'btn' => __('dashboard.add_file')
                ])

            </form>

        </div>

    </div>
</div>

@endsection

@section('script')


<script>
    // to display the upload image
    function displayImage(event) {
        
        const image = document.getElementById('uploaded-image');
        let imageC = document.querySelector('.custom-button');
        let up = document.querySelector('.up');
        const file = event.target.files[0];
        const reader = new FileReader();

        reader.onload = function (e) {

            imageC.style.backgroundImage = `url(${e.target.result})`;
            
            up.style.display = 'none';
            image.style.display = 'block';
        };

        if (file) {
            reader.readAsDataURL(file);
        }
    }
    function displayVideo(event) {
        const video = document.getElementById('uploaded-video');
        
        const uVideo = document.querySelector('.uploaded-video');
        let videoSection = document.querySelector('.video-section');
        let closeBtn = document.querySelector('.video-remove');
        const file = event.target.files[0];
        const reader = new FileReader();

        reader.onload = function (e) {
            uVideo.style.display = 'block';
            videoSection.style.display = 'none';
            video.src = e.target.result;
            closeBtn.style.display = 'block';
            video.style.display = 'block';
        };

        if (file) {
            reader.readAsDataURL(file);
        }

        closeBtn.addEventListener('click', () => {
            videoSection.style.display = 'block';
            
            uVideo.style.display = 'none'

        });
    }

</script>

@endsection