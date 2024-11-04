@extends('dashboard.master')


@section('page_title')
{{ __('dashboard.files') }}
@endsection

@section('style')
    <style>
        .upload-excel {
            max-width: 600px;
            margin: auto;
            margin-top: 40px;
            text-align: center;
            background-color: #EDF2F6;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0px 0px 9px 0px #00000029;
        }
        .upload-excel .upload button{
            background-color: #00ff0a;
        }
    </style>
@endsection
@section('content')


    <div class="upload-excel">
        <div class="container">
            <div class="h2">تحميل ملف اكسيل</div>

            <div class="upload">
                <form action="{{ route('excel.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="excel-file" class="form-label"></label>
                        <input type="file" name="excel-file" value="اضافه الملف">
                    </div>

                    @error('file')
                        <div class="text-center text-danger">{{ $message }}</div>
                    @enderror

                    <div class="form-group">
                        <button type="submit" class="btn mt-3">تحميل</button>
                    </div>

                </form>
            </div>
        </div>
    </div>


    



@endsection
