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
        <div class="row">
            <div class="col-md-12">
                <table class="table mt-4">
                    <thead>
                        <tr>
                        <th scope="col">الاسم</th>
                        <th scope="col">التحكم</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($files['files'] as $file)
                        <tr>
                            <td>
                                <i class="fa fa-file"></i>
                                <span>{{ $file['name'] }}</span>
                            </td>
                            <td>
                                <a href="{{ route('server.files', ['path' => $file['link'], 'id' => data_get($file,'server_id') ]) }}" class="btn btn-sm btn-primary">تنزيل</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @forelse ($files['dirs'] as $video)
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
                                <a href="{{ route('server.export', ['path' => $video['link'],'id' => data_get($video,'server_id') ]) }}" class="">تنزيل</a>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        @empty
            <div class="text-dark text-center mt-4">لايوجد ملفات الان</div>
            <a href="#" onclick="history.back(); return false;" class="text-center">الرجوع للخلف</a>
        @endforelse
    </div>
@endsection

