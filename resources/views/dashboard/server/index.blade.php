@extends('dashboard.master')

@section('page_title')
    {{ __('dashboard.home') }}
@endsection

<style>

</style>
@section('content')
    <div class="container">
        <div class="row">
            @foreach ($servers as $key => $server)
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{ route('server.show', ['path' => $server['link'], 'id' => $key]) }}">
                                {{ data_get($server, 'name') }}
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
