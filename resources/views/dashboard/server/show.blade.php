@extends('dashboard.master', [
    'navigation' => true
])

@section('page_title')
    {{ __('dashboard.home') }}
@endsection

<style>
    .folder {
        margin-top: 20px;
        font-size: 18px;
        padding: 15px 10px
    }

    .folder-icon {
        color: #28a745;
        margin: 0 0 0 10px
    }

    .folder .export-btn {
        background-color: #28a745;
        color: #FFF;
        padding: 4px 3px;
        font-size: 16px;
        border-radius: 3px;
    }

    .folder .export-btn a {
        color: #FFF;
        background-color: #28a745;
    }
</style>

@section('content')
    <div class="container">
        @foreach ($files as $video)
            <a href="{{ route('server.files', ['path' => $video['link'], 'id' => data_get($video,'server_id') ]) }}"
               class="text-dark">
                <div class="row">
                    <div class="col-md-12">
                        <div class="folder d-flex ">
                            <div class="folder-item d-flex ">
                                <div class="folder-icon">
                                    <i class="fa fa-folder"></i>
                                </div>
                                <div class="folder-name">
                                    {{ data_get($video,'name') }}
                                </div>

                            </div>
                            <div class="export-btn me-2 ms-2">
                                <a href="{{ route('server.export', ['path' => $video['link'],'id' => data_get($video,'server_id') ]) }}"
                                   class="">استيراد</a>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
@endsection

