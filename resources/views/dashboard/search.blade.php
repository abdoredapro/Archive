@extends('dashboard.master')

@section('page_title')
    بحث
@endsection

@section('style')
    <style>
        .movies {
            padding: 20px;
        }

        .movie-collection {
            margin-top: 20px;
        }

        .movie-collection .card {
            height: 100%;
        }

        .movie-collection .card img {
            height: 400px;
            object-fit: cover;
            width: 100%;
        }

        .movie-collection .card-footer {
            background-color: #fff;
        }

        .movie-collection .card-footer h5 {
            font-size: 1.25rem;
        }

        .movie-collection .card-footer p {
            font-size: 1rem;
        }

        .movie-collection .card-footer a {
            font-size: 1rem;
        }

        #card-footer {
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-evenly;
            align-items: center;
        }
    </style>
@endsection

@php
    /** @var \App\Models\Film[] $films */
    /** @var \App\Models\File[] $files */
@endphp

@section('content')
    <div class="movies hz-padding">

        <div class="text-center movie-collection">
            <div class="row g-4">

                @forelse ($films as $film)
                    <div class="col-md-3">
                        <div class="card" style="height: 100%;">
                            <a href="{{ route('dashboard.film.show', $film->id) }}">
                                <img src="{{ $film->image_url }}"
                                     class="card-img-top"
                                     alt="{{ $film->name }}"
                                     style="height: 400px; object-fit: cover; width: 100%;"
                                />
                            </a>
                            <div class="card-footer" id="card-footer">
                                <h5 class="card-title">{{ $film->name }}</h5>
                                <p class="card-text">{{ Str::limit($film->film_script, 10) }}</p>
                                <a href="{{ route('dashboard.film.show', $film->id) }}" class="btn btn-primary">
                                    المزيد
                                </a>
                            </div>
                        </div>
                    </div>
                @empty

                @endforelse

                @foreach ($files as $file)
                    <div class="col-md-3">
                        <div class="card" style="height: 100%;">
                            <a href="{{ route('dashboard.file.show', $file->id) }}">
                                <img src="{{ $file->image_url }}"
                                     class="card-img-top"
                                     alt="{{ $file->name }}"
                                     style="height: 400px; object-fit: cover; width: 100%;"
                                />
                            </a>
                            <div class="card-footer" id="card-footer">
                                <h5 class="card-title">{{ $file->name }}</h5>
                                <p class="card-text">{{ Str::limit($file->description, 10) }}</p>
                                <a href="{{ route('dashboard.file.show', $file->id) }}" class="btn btn-primary">
                                    المزيد
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>

    </div>

@endsection
