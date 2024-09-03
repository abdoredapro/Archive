@extends('dashboard.master')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/movie-details.css') }}">
@endsection

@section('page_title')

@endsection

@section('content')


<!-- video -->
<div class="white-board hz-padding film-show">

    <div class="pos-btn">
        <a href="{{ route('dashboard.film.edit', $film->id) }}" class="edit">تعديل</a>
    </div>


    


    <div class="trailer">
        <div class="stack">
            <img src="{{ $film->image_url }}" alt="" style="width: 250px">
            <div class="feat">
                <h2>{{ $film->name }}</h2>
                <div class="stack">
                    <div class="cat">{{ $film->category->name }}</div>
                    {{-- <div class="duration"></div> --}}
                </div>
                <p>{{ $film->film_script }}</p>
            </div>
        </div> 
        <div class="video">
            <video width="450px" height="100%" style="max-width: 100%;" controls muted>
                <source src="{{ $film->video_url }}" type="video/mp4" />
            </video>

            

        </div>
        
    </div>

    <x-shorts :clips='$film->clips' />

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
                {{-- <div class="directors">
                    <div class="black">سيناريو وحوار : </div>
                    <div class="blue"></div>
                </div> --}}
            </div>
        </div>
    </div>


</div>
<!-- video -->


@endsection