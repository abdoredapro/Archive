@extends('dashboard.master')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/movie-details.css') }}">
@endsection

@section('page_title')

@endsection

@section('content')


<!-- video -->
<div class="white-board hz-padding">

    <div class="pos-btn">
        <a href="{{ route('dashboard.film.edit', $film->id) }}" class="edit">تعديل</a>
    </div>

    <div class="trailer">
        <div class="stack">
            <img src="{{ $film->image_url }}" alt="">
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
            <video width="450px" height="100%" style="max-width: 100%" controls muted>
                <source src="{{ $film->video_url }}" type="video/mp4" />
            </video>

        </div>
        
    </div>



</div>
<!-- video -->


@endsection