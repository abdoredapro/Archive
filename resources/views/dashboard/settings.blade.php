@extends('dashboard.master')


@section('page_title')
    Settings
@endsection

@section('style')
    <style>
        .uploaded-image {
            width: 150px;
        }
    </style>
@endsection
@section('content')

<!-- body -->
<div class="first-white-board hz-padding settings">
    
    <div class="d-flex align-items-center justify-space-evenly">
        
        <ul class="list-unstyled d-flex items">
            <li class="me-2"><h3 class="title">اعدادات الحساب </h3></li>
            @role('Super-admin')
            <li class="me-4"><a href="{{ route('dashboard.roles.index') }}"><h3 class="title">الصلاحيات </h3></a></li>
            <li class="me-4"><a href="{{ route('dashboard.users.index') }}"><h3 class="title">الاعضاء </h3></a></li>
            @endrole
        </ul>
        
        
    </div>
    
    @if (Session::has('message'))
    <div class="alert alert-success">{{ Session::get('message') }}</div>
    @endif
    <div class="sec-white-board">
        <form action="{{ route('dashboard.update_profile', $user->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="first-sec">
                <div>صورة الملف الشخصي</div>
                <input type="file" name="photo" id="picture" onchange="UploadImage(this)" class="hidden-input" />
                <div class="img-box" onclick="document.getElementById('picture').click();">
                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24">
                        <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-width="1.5">
                            <path
                                d="M22 12c0 4.714 0 7.071-1.465 8.535C19.072 22 16.714 22 12 22s-7.071 0-8.536-1.465C2 19.072 2 16.714 2 12s0-7.071 1.464-8.536C4.93 2 7.286 2 12 2" />
                            <path
                                d="m2 12.5l1.752-1.533a2.3 2.3 0 0 1 3.14.105l4.29 4.29a2 2 0 0 0 2.564.222l.299-.21a3 3 0 0 1 3.731.225L21 18.5m-6-13h3.5m0 0H22m-3.5 0V9m0-3.5V2" />
                        </g>
                    </svg>
                    <div class="download">تحميل الصورة</div>
                    
                </div>
                <img src="" class="uploaded-image" >
            </div>
    
            <hr />
    
            <div class="second-sec">
                <div class="row g-4">
                    <div class="col-sm-12 col-md-12 col-lg-6">
                        <div class="package">
                            <div class="main-text">البريد الالكتروني</div>
                            <input placeholder="من فضلك ادخل بريدك الالكتروني" class="field-inpuut" type="text"
                                id="email" name="email" value="{{ $user->email }}">
                        </div>
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-6">
                        <div class="package">
                            <div class="main-text">الاسم بالكامل</div>
                            <input placeholder="من فضلك ادخل الاسم بالكامل" class="field-inpuut" type="text"
                                id="name" name="name" value="{{ $user->name }}">
                        </div>
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-6">
                        <div class="package">
                            <div class="main-text">رقم الهاتف</div>
                            <input placeholder="من فضلك ادخل رقم الهاتف" class="field-inpuut" type="text"
                                id="phone" name="phone_number" value="{{ $user?->phone_number }}"> 
                        </div>
                        @error('phone')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-6">
                        <div class="package">
                            <div class="main-text">اسم المستخدم</div>
                            <input placeholder="من فضلك ادخل اسم المستخدم" class="field-inpuut" type="text"
                                id="user" name="username" value="{{ $user?->username }}">
                        </div>
                        @error('username')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-sm-12">
                        <div class="package">
                            <div class="main-text">البايو</div>
                            <textarea rows="10" name="bio" id="">{{ $user?->bio }}</textarea>
                        </div>
                        @error('username')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
    
                <div class="stack">
                    <button class="saveBtn">تحديث الملف الشخصي</button>
                    <button class="cancelBtn">اعاده تعيين</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- body -->


@endsection

@section('script')
    <script>
        // Uploaded Image 
        function UploadImage(input) {
            
            let img = document.querySelector('.uploaded-image');

            let reader = new FileReader();
            
            reader.onload = function(e) {

                img.src = e.target.result;

            }

            reader.readAsDataURL(input.files[0])

        }
        

    </script>
@endsection