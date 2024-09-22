@extends('dashboard.master')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/movie-details.css') }}">
    <style>
        #my_video_1 {
            width: 100%
        }
        .footage .video {
            max-width: 100%;
            max-height: 100%;
            overflow: hidden;
        }
    </style>
@endsection

@section('page_title')

@endsection

@section('content')


<!-- video -->
<div class="white-board hz-padding film-show">

    <div class="pos-btn d-flex justify-content-between align-items-center">
        <a href="{{ route('dashboard.film.edit', $film->id) }}" class="edit custom">تعديل</a>

        <form action="{{ route('dashboard.film.destroy', $film->id) }}" method="POST">
            @csrf
            @method('DELETE')

            <button class="btn btn-sm btn-danger">حذف</button>
        </form>
    </div>

    <div class="trailer">
        <div class="stack">
            <img src="{{ $film->image_url }}" alt="" style="width: 200px">
            <div class="feat">
                <h2>{{ $film->name }}</h2>
                <div class="stack">
                    <div class="cat">{{ $film->category->name }}</div>
                    {{-- <div class="duration"></div> --}}
                </div>
                
                <p> {{ $film->film_script }}</p>
            </div>
        </div> 
        <div class="video">
            <video width="450px" height="100%" style="max-width: 100%;" controls muted>
                <source src="{{ $film->video_url }}" type="video/mp4" />
            </video>

            
            

        </div>
        
    </div>


    {{-- Start Footage  --}}
    <div class="footage">
        <div class="main-header">
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24">
                <path fill="currentColor"
                    d="m19.65 6.5l-2.74-3.54l3.93-.78l.78 3.92zm-2.94.57l-2.74-3.53l-1.97.39l2.75 3.53zM19 13c1.1 0 2.12.3 3 .81V10H2v10a2 2 0 0 0 2 2h9.81c-.51-.88-.81-1.9-.81-3c0-3.31 2.69-6 6-6m-7.19-4.95L9.07 4.5l-1.97.41l2.75 3.53zM4.16 5.5l-.98.19a2.01 2.01 0 0 0-1.57 2.35L2 10l4.9-.97zM20 18v-3h-2v3h-3v2h3v3h2v-3h3v-2z" />
            </svg>
            <h3 class="title">اللقطات</h3>
        </div>
        <div class="text-center footage">
            <div class="row">
                {{-- @foreach ($film->clips as $clip) --}}

                <x-shorts :clips="$film->clips" :file="$film" />

                {{-- @endforeach --}}
            </div>
        </div>
    </div>
    {{-- End Footage  --}}



    <div class="file-describtion-subject">
        <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="directors">
                    <div class="black">سنة الإصدار : </div>
                    <div class="blue">{{ $film->release_year }}</div>
                </div>
                <div class="directors">
                    <div class="black">اسم المجلد : </div>
                    <div class="blue">{{ $film->project_category }}</div>
                </div>
                <div class="directors">
                    <div class="black">ملاحظات : </div>
                    <div class="blue">.................................</div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="directors">
                    <div class="black">مشروع / مستفيد : </div>
                    <div class="blue">{{ $film->project_beneficiary }}</div>
                </div>
                <div class="directors">
                    <div class="black">مدير الأنتاج : </div>
                    <div class="blue">{{ $film->production_manager }}</div>
                </div>
                <div class="directors">
                    <div class="black">مهندس الصوت : </div>
                    <div class="blue">{{ $film->sound_engineer }}</div>
                </div>
                <div class="directors">
                    <div class="black">نوع الشريط : </div>
                    <div class="blue">{{ $film->tap_type }}</div>
                </div>
                <div class="directors">
                    <div class="black">رقم الشريط : </div>
                    <div class="blue">{{ $film->tap_number }}</div>
                </div>
            </div>
        </div>
    </div>


</div>
<!-- video -->


@endsection

@section('script')
<script>
    const player = new Plyr('#player');
</script>
@endsection