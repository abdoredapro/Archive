<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/normalize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>

<body>


    <div class="page">
        <div class="row">
            <div class="col-md-6 col-lg-6 no d-none d-md-block">
                <div class="background"></div>
            </div>

            <div class="col-sm-12 col-md-6 col-lg-6 no">
                <div class="box">
                    <div class="logo-container">
                        <img src="assets/Logo.png" alt="">
                    </div>
                    <div class="allfields">
                        <h2>انشاء حساب جديد</h2>
                        <p>انشاء حساب جديد للمتابعة إلى حسابك.</p>
                        <form action="{{ route('register') }}" method="POST">
                            @csrf 
                            <div class="form-group">
                                <label for=""></label>
                                <input type="text" placeholder="الاسم" class="form-control" value="{{ old('name') }}" id="name" name="name">
                            </div>
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <div class="form-group">
                                <label for=""></label>
                                <input type="text" placeholder="البريد الالكتروني" class="form-control" value="{{ old('email') }}" id="email" name="email">
                            </div>
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <div class="form-group">
                                <label for=""></label>
                                <input type="password" placeholder="كلمة المرور" class="form-control" id="password" name="password">
                                <i class="fa-regular fa-eye-slash"></i>
                            </div>
                            @error('password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <div class="form-group">
                                <label for=""></label>
                                <input type="password" class="form-control" placeholder="تأكيد كلمة المرور" id="password-confirm" name="password_confirmation">
                                <i class="fa-regular fa-eye-slash"></i>
                            </div>
                            @error('password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror

                            <button type="submit" class="submit-btn">انشاء حساب جديد</button>
                            <p><a href="{{ route('login') }}">تسجيل دخول</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/all.min.js') }}"></script>
</body>

</html>