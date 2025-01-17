@extends('dashboard.master')

@section('page_title')
    {{ $file->name }}
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('css/show.css') }}">
    
@endsection
@section('content')
    <!-- video -->
    <div class="white-board hz-padding">
        <div class="stack-head align-items-end justify-content-between file-controll">

            <a href="{{ route('dashboard.file.edit', $file->id) }}">
                <button class="addBtn custom">

                    <span class="text-dark">تعديل الملف</span>
                </button>
            </a>

            <form action="{{ route('dashboard.file.destroy', $file->id) }}" method="POST">
                @csrf
                @method('DELETE')

                <button class="btn btn-sm btn-danger delete">حذف</button>
            </form>

        </div>


        <div class="video">


            <video class="js-player" controls preload="auto" height="450" poster="{{ $file->image_url }}" data-setup="{}">
                <source src="{{ $file->video_url }}" type="video/mp4" />
                <source src="{{ $file->video_url }}" type="video/webm" />

            </video>

        </div>

        <div class="footage">
            <div class="main-header">
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24">
                    <path fill="currentColor"
                        d="m19.65 6.5l-2.74-3.54l3.93-.78l.78 3.92zm-2.94.57l-2.74-3.53l-1.97.39l2.75 3.53zM19 13c1.1 0 2.12.3 3 .81V10H2v10a2 2 0 0 0 2 2h9.81c-.51-.88-.81-1.9-.81-3c0-3.31 2.69-6 6-6m-7.19-4.95L9.07 4.5l-1.97.41l2.75 3.53zM4.16 5.5l-.98.19a2.01 2.01 0 0 0-1.57 2.35L2 10l4.9-.97zM20 18v-3h-2v3h-3v2h3v3h2v-3h3v-2z" />
                </svg>
                <h3 class="title">اللقطات</h3>
            </div>
            <div class="text-center">
                <div class="row">
                    <x-shorts :clips="$file->clips" :file="$file" />
                </div>
            </div>
        </div>

        <div class="file-describtion-subject">
            <h3 class="title">{{ $file->name }}</h3>
            <div class="stack">
                <span class="cate">{{ $file->category?->name }}</span>
                {{-- <span class="dure">{{ $file->FileDuration() }}</span> --}}
            </div>
            <p class="describe">
                {{ $file->description }}
            </p>

            <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-6">
                    <div class="directors">
                        <div class="black">سنة الإصدار : </div>
                        <div class="blue">{{ $file->release_year }}</div>
                    </div>
                    <div class="directors">
                        <div class="black">اسم المجلد : </div>
                        <div class="blue">{{ $file->project_category }}</div>
                    </div>
                    <div class="directors">
                        <div class="black">ملاحظات : </div>
                        <div class="blue">.................................</div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6">
                    <div class="directors">
                        <div class="black">مشروع / مستفيد : </div>
                        <div class="blue">{{ $file->project_beneficiary }}</div>
                    </div>
                    <div class="directors">
                        <div class="black">مدير الأنتاج : </div>
                        <div class="blue">{{ $file->production_manager }}</div>
                    </div>
                    <div class="directors">
                        <div class="black">مهندس الصوت : </div>
                        <div class="blue">{{ $file->sound }}</div>
                    </div>
                    <div class="directors">
                        <div class="black">نوع الشريط : </div>
                        <div class="blue">{{ $file->tap_type }}</div>
                    </div>
                    <div class="directors">
                        <div class="black">رقم الشريط : </div>
                        <div class="blue">{{ $file->tap_number }}</div>
                    </div>
                </div>
            </div>

        </div>




    </div>
@endsection

@section('script')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const videos = document.querySelectorAll("video.clip-video");

            videos.forEach(video => {
                const startTime = video.getAttribute("data-start-time");

                if (startTime) {
                    const [hours, minutes, seconds] = startTime.split(":").map(Number);
                    const startSeconds = (hours * 3600) + (minutes * 60) + seconds;
                    video.currentTime = startSeconds;
                }
            });
        });
    </script>
@endsection
