@extends('dashboard.master')


@section('page_title')
{{ __('dashboard.films') }}
@endsection
@section('content')

<div class="movies hz-padding">
    <div class="stack">
        <h3 class="title">أفلام</h3>
        <a href="{{ route('dashboard.film.create') }}">
            <button class="addBtn" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <g fill="none" stroke="white" stroke-width="1.5">
                        <circle cx="12" cy="12" r="10" />
                        <path stroke-linecap="round" d="M15 12h-3m0 0H9m3 0V9m0 3v3" />
                    </g>
                </svg>
                <span>اضافة فيلم</span>
            </button>
        </a>
    </div>

    @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif

    <div class="text-center movie-collection">
        <div class="row g-4">

            @forelse ($films as $film)
                <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 col-xxl-2">
                    <a href="{{ route('dashboard.film.show', $film->id) }}" class="img-container">
                        <img src="{{ $film->image_url }}" alt="" style="max-width:250px">
                    </a>
                </div>
            @empty
                <div class="text-center text-primary">{{ __('dashboard.no_film') }}</div>
            @endforelse



        </div>

    </div>
    <div class="text-center p-4">{{ $films->links() }}</div>
</div>







@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/resumablejs@1.1.0/resumable.min.js">
    
</script>
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