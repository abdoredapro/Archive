@extends('dashboard.master')

@section('page_title')
    {{ __('dashboard.home') }}
@endsection

@section('content')
    <div class="container">
        <div class="row">
            @foreach ($servers as $server)
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{ route('server.show', ['path' => $server['link'] ]) }}">
                                {{ data_get($server, 'name') }}
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
