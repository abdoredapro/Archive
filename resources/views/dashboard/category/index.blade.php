@extends('dashboard.master')


@section('page_title')
{{ __('dashboard.category') }}
@endsection
@section('content')

<div class="categories hz-padding">
    <div class="stack-head">
    <h3 class="title">{{ __('dashboard.category') }}</h3>

        <a href="{{ route('dashboard.category.create') }}">
            <button class="addBtn" style="background-color:#00ff00">
                {{-- <svg  xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <g fill="none" stroke="white" stroke-width="1.5">
                        <circle cx="12" cy="12" r="10"></circle>
                        <path stroke-linecap="round" d="M15 12h-3m0 0H9m3 0V9m0 3v3"></path>
                    </g>
                </svg> --}}
            
            <span class="text-dark">{{ __('dashboard.category_add') }}</span>
            </button>
        </a>
    </div>


    <div class="text-center">
        <div class="row g-4">
            @foreach ($categories as $category)
                <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3">
                    <div class="form">
                        <a href="{{ route('dashboard.category.edit', $category->id) }}" class="text-primary">تعديل</a> |
                        <form method="POST" action="{{ route('dashboard.category.destroy', $category->id) }}" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <input  type="submit" value="حذف" class="text-danger bg-transparent border-0 delete b-none">
                        </form>
                    </div>
                <div class="box {{ $category->background_color }}" 
                    >
                    <div class="stack">
                        <img src="{{ asset('assets/video.png') }}" alt="">
                        <div class="feat">
                            <span><a href="{{ route('dashboard.film.index') }}?category={{$category->id}}" class="text-white">{{ $category->name }}</a></span>
                            <span class="number">{{ $category->films_count }}</span>
                        </div>
                    </div>
                    
                </div>
            </div>
            @endforeach
          
        </div>
    </div>
</div>


@endsection