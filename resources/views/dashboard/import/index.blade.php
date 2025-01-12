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
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        .upload-excel h2 {
            font-size: 24px;
            color: #333;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .upload-excel .upload .form-group {
            display: flex;
            align-items: center;
            flex-direction: column;
        }

        .custom-file-upload {
            display: inline-block;
            padding: 10px 20px;
            color: #fff;
            background-color: #6c63ff;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .custom-file-upload:hover {
            background-color: #5a54d4;
        }

        #fileInput {
            display: none; /* Hide default file input */
        }

        .file-name {
            margin-top: 10px;
            font-size: 14px;
            color: #555;
        }

        .btn-primary {
            margin-top: 20px;
            background-color: #6a5ae0;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #594acd;
        }

        .text-danger {
            color: #e74c3c;
            font-size: 14px;
            margin-top: 10px;
        }
    </style>
@endsection

@section('content')
    <div class="upload-excel">
        <div class="container">
            <h2>تحميل ملف اكسيل</h2>

            <div class="upload">
                <form action="{{ route('excel.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <!-- Custom upload button -->
                        <label for="fileInput" class="custom-file-upload">تحميل الملف</label>
                        <input id="fileInput" type="file" name="file" onchange="updateFileName()">

                        <!-- Display selected file name -->
                        <span class="file-name">لم يتم اختيار ملف</span>

                        @error('file')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror

                        <button type="submit" class="btn btn-primary d-block mt-3">
                            <i class="fa fa-upload"></i> تحميل
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function updateFileName() {
            const input = document.getElementById('fileInput');
            const fileNameSpan = document.querySelector('.file-name');
            fileNameSpan.textContent = input.files.length > 0 ? input.files[0].name : 'لم يتم اختيار ملف';
        }
    </script>
@endsection
