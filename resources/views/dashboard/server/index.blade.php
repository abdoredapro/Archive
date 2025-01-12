@extends('dashboard.master', [
    'navigation' => 'server'
])

@section('page_title')
    {{ __('dashboard.home') }}
@endsection

<style>
    .card {
        margin-top:20px; 
        border: 1px solid #ddd;
        border-radius: 8px;
        margin-bottom: 20px;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .card-body {
        display: flex;
        align-items: center;
    }

    .icon {
        font-size: 24px;
        margin-right: 10px;
        color: #00ff00;
    }

    .card a {
        text-decoration: none;
        font-weight: bold;
        color: #333;
        margin: 0 10px 0 10px;
    }

    .card a:hover {
        color: #00ff00;
    }
</style>

@section('content')
    <div class="container">
        <div class="row">
            @foreach ($servers as $key => $server)
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                        <img src="{{  asset('database-storage.png') }}" width="50px">
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
