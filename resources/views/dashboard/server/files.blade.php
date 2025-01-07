@extends('dashboard.master')

@section('page_title')
    {{ __('dashboard.home') }}
@endsection

@section('content')
<div class="container mt-3">
    <div class="row">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>الاسم</th>
                    <th>الحجم</th>
                    <th>المسار</th>
                    <th>تاريخ الاضافة</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($files['files'] as $video)
                    <tr>
                        <td>{{ data_get($video,'name') }}</td>
                        <td>{{ data_get($video,'size') }}</td>
                        <td>
                            <video src="{{ asset(data_get($video,'link')) }}" controls></video>
                        </td>
                        <td>{{ data_get($video,'last_modified') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @if(!empty($files['dirs']))
        <div class="row mt-4">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>الاسم</th>
                    <th>المسار</th>
                    <th>الاجراءات</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($files['dirs'] as $video)
                    <tr>
                        <td>{{ data_get($video,'name') }}</td>
                        <td>{{ data_get($video,'link') }}</td>
                        <td>
                            <a href="{{ route('server.files', $video['link']) }}" class="btn btn-primary">عرض</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
