@extends('dashboard.master')


@section('page_title')
{{ __('dashboard.films') }}
@endsection
@section('content')

<div class="categories">



    <div class="text-center">
        <div class="first-white-board hz-padding">
            <h3 class="title">{{ __('dashboard.film_add') }}</h3>

            <div class="sec-white-board">

                <form action="{{ route('dashboard.store_video', $film->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="second-sec">

                        {{-- Upload video  --}}
                        <div class="col-sm-12 col-md-12 col-lg-6">
                            <div class="form-group">
                                <div class="first-group-here">
                                    <h3>{{ __('dashboard.film_add') }}</h3>
                                </div>

                                <div class="dummy-div">
                                    {{-- <input  type="file" value="{{ old('file') }}" onchange="displayVideo(event)"  class="form-control hidden-input" id="video" name="video"> --}}
                                    <span id="browseFile" class="btn btn-primary">اضافه الفيلم</span>
                                    {{-- <div class="section" onclick="document.getElementById('video').click();">
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
                                    </div> --}}
                                </div>

                                <video controls autoplay src=""  id="uploaded-video"
                                style="display:none; max-width: 100%; height: auto; margin-top: 10px;"></video>
                                

                                <div class="card-footer p-4" style="display: none">
                                    <video id="videoPreview" src="" controls autoplay style="width: 100%; height: auto"></video>
                                </div>


                                <div  style="display: none" class="progress mt-3" style="height: 25px">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%; height: 100%">75%</div>
                                </div>

                            </div>
                            @error('video')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        {{-- End Upload video  --}}





                        </div>

    
                    </div>
                </form>


            </div>
        </div>
    </div>
</div>

@endsection

@section('script')


<script src="https://code.jquery.com/jquery-3.7.1.slim.min.js" integrity="sha256-kmHvs0B+OpCW5GVHUNjv9rOmY0IvSIRcf7zGUDTDQM8=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/resumable.js/1.0.3/resumable.min.js" integrity="sha512-OmtdY/NUD+0FF4ebU+B5sszC7gAomj26TfyUUq6191kbbtBZx0RJNqcpGg5mouTvUh7NI0cbU9PStfRl8uE/rw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>




    function displayVideo(event) {
        const video = document.getElementById('uploaded-video');
        const file = event.target.files[0];
        const reader = new FileReader();

        reader.onload = function (e) {
            video.src = e.target.result;
            video.style.display = 'block';
        };

        if (file) {
            reader.readAsDataURL(file);
        }
    }

</script>

<script type="text/javascript">

    let browseFile = $('#browseFile');
    let resumable = new Resumable({

    target: '{{ route('dashboard.store_video',$film->id) }}',

        query:
        {
            _token:'{{ csrf_token() }}',
            name: 's',
        } ,// CSRF token
        fileType: ['mp4'],
        chunkSize: 10*1024*1024, // default is 1*1024*1024, this should be less than your maximum limit in php.ini
        headers: {
            'Accept' : 'application/json'
        },
        testChunks: false,
        throttleProgressCallbacks: 1,
        });

    resumable.assignBrowse(browseFile[0]);


    resumable.on('fileAdded', function (file) { // trigger when file picked
        showProgress();
        resumable.upload() // to actually start uploading.
    });

    resumable.on('fileProgress', function (file) { // trigger when file progress update
        updateProgress(Math.floor(file.progress() * 100));
    });

    resumable.on('fileSuccess', function (file, response) { // trigger when file upload complete
        response = JSON.parse(response)
        $('#videoPreview').attr('src', response.path);
        $('.card-footer').show();
        console.log(response);
    });

    resumable.on('fileError', function (file, response) { // trigger when there is any error
        alert('file uploading error.')
    });


    let progress = $('.progress');
    function showProgress() {
        progress.find('.progress-bar').css('width', '0%');
        progress.find('.progress-bar').html('0%');
        progress.find('.progress-bar').removeClass('bg-success');
        progress.show();
    }

    function updateProgress(value) {
        progress.find('.progress-bar').css('width', `${value}%`)
        progress.find('.progress-bar').html(`${value}%`)
    }

    function hideProgress() {
        progress.hide();
    }
</script>
@endsection