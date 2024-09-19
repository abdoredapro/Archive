@extends('dashboard.master')

@section('style')
<link rel="stylesheet" href="{{ asset('css/movies.css') }}">
@endsection
@section('page_title')
    اضافه فيلم
@endsection
@section('content')

<div class="categories">

    <div class="text-center">
        <div class="first-white-board hz-padding">
            <h3 class="title">اضافه فيلم</h3>

            <form action="{{ route('dashboard.film.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                
                <div class="sec-white-board create-file">
                    <div class="stack">
                        <div class="form-group">
                            <input type="file" class="form-control hidden-input" id="photo" name="image"
                                accept="image/*" onchange="displayImage(event)" required>
                            <div class="custom-button" onclick="document.getElementById('photo').click();">
                                <p class="up">قم برفع صورة للملف</p>
                            </div>
                            @error('image')
                                <div class="text-center text-end">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="text-module">
                            <div class="one-content text-end">
                                <h3>اسم الفيلم</h3>
                                <input type="text" id="movie-name" name="name" placeholder="اسم الفيلم" value="{{ old('name') }}" style="border: 1px solid #ccc" required>

                                <div class="name-error text-center text-danger"  style="display: none">يرجى وضع اسم</div>
                                @error('name')
                                    <div class="text-center text-end">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="first-group-here">
                                    <h3>تصينف الفيلم</h3>
                                </div>
    
                                <select name="category_id" id="category" class="form-control" required>
                                    <option value="">اختر الفئه</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" @selected(old('project_id') == $category->id) >{{ $category->name }}</option>
                                    @endforeach
                                </select>


                                @error('category_id')
                                    <div class="text-center text-end">{{ $message }}</div>
                                @enderror

                            </div>
                        </div>
                    </div>
    
                    <div class="dummy-div">
                        <input required type="file" class="form-control hidden-input" id="video" name="video" onchange="displayVideo(event)">

                        
                        <div class="section video-section" onclick="document.getElementById('video').click();">
                            <div class="stack-section">
                                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24">
                                    <g fill="none">
                                        <path
                                            d="M24 0v24H0V0zM12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035q-.016-.005-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427q-.004-.016-.017-.018m.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093q.019.005.029-.008l.004-.014l-.034-.614q-.005-.019-.02-.022m-.715.002a.02.02 0 0 0-.027.006l-.006.014l-.034.614q.001.018.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01z" />
                                        <path fill="currentColor"
                                            d="M13.586 2a2 2 0 0 1 1.284.467l.13.119L19.414 7a2 2 0 0 1 .578 1.238l.008.176V20a2 2 0 0 1-1.85 1.995L18 22H6a2 2 0 0 1-1.995-1.85L4 20V4a2 2 0 0 1 1.85-1.995L6 2zM12 4H6v16h12V10h-4.5A1.5 1.5 0 0 1 12 8.5zm-.707 7.173a1 1 0 0 1 1.32-.083l.094.083l2.121 2.121a1 1 0 0 1-1.32 1.498l-.094-.084l-.414-.414V17a1 1 0 0 1-1.993.117L11 17v-2.706l-.414.414a1 1 0 0 1-1.498-1.32l.084-.094zM14 4.414V8h3.586z" />
                                    </g>
                                </svg>
                                <div class="title-section">رفع الملفات</div>
                            </div>
                            <p class="text-section">الملفات التي يتم تحميلها كجزء من المشروع</p>
                            <div class="feat-section">
                                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24">
                                    <path fill="currentColor" fill-rule="evenodd"
                                        d="M4.25 5A2.75 2.75 0 0 1 7 2.25h7.987a1.75 1.75 0 0 1 1.422.73l3.013 4.197c.213.298.328.655.328 1.02V19A2.75 2.75 0 0 1 17 21.75H7A2.75 2.75 0 0 1 4.25 19zM7 3.75c-.69 0-1.25.56-1.25 1.25v14c0 .69.56 1.25 1.25 1.25h10c.69 0 1.25-.56 1.25-1.25V8.897H15a.75.75 0 0 1-.75-.75V3.75z"
                                        clip-rule="evenodd" />
                                    <path fill="currentColor"
                                        d="M15.086 13.219a.75.75 0 0 1-1.055.117l-1.28-1.026v3.44a.75.75 0 0 1-1.5 0v-3.44l-1.282 1.026a.75.75 0 0 1-.937-1.172l2.497-1.998a.747.747 0 0 1 .465-.166h.008c.18 0 .344.064.473.17l2.494 1.994a.75.75 0 0 1 .117 1.055" />
                                </svg>
                                <div>قم بسحب واسقاط ملفاتك هنا أو قم باختيار الملف</div>
                            </div>
                        </div>
                        
                            @error('video')
                                <div class="text-center text-end">{{ $message }}</div>
                            @enderror
                    </div>
    
                    <div class="uploaded-section uploaded-video">
                        <h3>الملفات التي تم تحمليها</h3>
                        <div class="white-sec">
                            <div class="stack">
    
                                <video controls id="uploaded-video" src="" alt="Uploaded Video"
                                style="display:none; max-width: 100%; height: auto; margin-top: 10px;">

                            </div>
                            
                        </div>
                        <span class="video-remove" style="display: none">X</span>
                    </div>
    
                    <div class="sinario">
                        <div class="stack">
                            <i class="fa-solid fa-file"></i>
                            <h3>سيناريو الفيلم</h3>
                        </div>
                        <div class="white-sec">

                            <textarea rows="6" cols="50" name="description" id="sinario"
                                placeholder="تفاصيل الملف">{{ old('description') }}</textarea>
                                
                            
                            @error('description')
                                <div class="text-center text-end">{{ $message }}</div>
                            @enderror

                        </div>
    
                        
                    </div>
    
                    <div class="modal-footer">
                        <button class="confirm" type="submit" id="save">حفظ الفيلم</button>
                    </div>
    
                </div>
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
        let word = document.querySelector('.up');

        const file = event.target.files[0];
        const reader = new FileReader();

        reader.onload = function (e) {
            imageC.style.backgroundImage = `url(${e.target.result})`;
            word.style.display = 'none';
            image.style.display = 'block';
            
            // word.style.display = 'none';
        };

        if (file) {
            reader.readAsDataURL(file);
        }
    }
    function displayVideo(event) {
        const video = document.getElementById('uploaded-video');
        let up = document.querySelector('.up');
        const uVideo = document.querySelector('.uploaded-video');
        let videoSection = document.querySelector('.video-section');
        let closeBtn = document.querySelector('.video-remove');
        const file = event.target.files[0];
        const reader = new FileReader();

        reader.onload = function (e) {
            up.style.display = 'none';
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

<script>


    // Add event listener to open select on click anywhere on the select box for categories
    document.getElementById('medical').parentElement.addEventListener('click', function () {
        const toggleButton = document.querySelector('#medical + .mult-select-tag .btn-container button');
        if (toggleButton) {
            toggleButton.click();
        }
    });


</script>

@endsection