@extends('dashboard.master')


@section('page_title')
    بحث 
@endsection
@section('content')

<div class="movies hz-padding">

    <div class="text-center movie-collection">
        <div class="row g-4">

            @forelse ($films as $film)
                <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 col-xxl-2">
                    <a href="{{ route('dashboard.film.show', $film->id) }}" class="img-container">
                        <img src="{{ $film->image_url }}" alt="" style="max-width:250px">
                    </a>
                </div>
            @empty
                <div class="text-center text-primary">لا توجد افلام بهذا الاسم.</div>
            @endforelse


            @foreach ($files as $file)
                <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 col-xxl-2">
                    <a href="{{ route('dashboard.file.show', $file->id) }}" class="img-container">
                        <img src="{{ $file->ImageUrl() }}" alt="" style="max-width:250px">
                    </a>
                </div>
            
            @endforeach



        </div>

    </div>
    {{-- <div class="text-center p-4">{{ $films->links() }}</div> --}}
</div>







@endsection
