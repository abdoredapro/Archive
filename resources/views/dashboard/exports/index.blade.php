@extends('dashboard.master')



@section('page_title')
    {{ __('dashboard.category') }}
@endsection

@section('content')
    <div class="exports">

        <div class="text-center">
            <a href="{{ route('dashboard.export-files') }}"
                class="export-btn p-2 text-dark cursor-pointer w-20 mt-5 d-inline-block bg-dark text-white">استيراد
                الملفات</a>
        </div>
    </div>
@endsection
