@extends('dashboard.master')

@section('page_title')
    {{ __('dashboard.home') }}
@endsection

@section('content')
    <div class="container">
        <div class="row">
            @foreach ($files as $video)
                <div class="col-md-4">
                    <div class="card">
                        <a class="card-body" href="{{ route('server.files', ['path' => $video['link'] ]) }}">
                            <dd>name: {{ data_get($video,'name') }}</dd>
                            <dd>path: {{ data_get($video,'link') }}</dd>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

