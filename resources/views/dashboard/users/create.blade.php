@extends('dashboard.master')


@section('page_title')
{{ __('dashboard.category') }}
@endsection
@section('content')

<div class="categories">

    <div class="text-center">
        <div class="first-white-board hz-padding">
            <h3 class="title">اضافه مستخدم</h3>

            <div class="sec-white-board">

                <form action="{{ route('dashboard.users.store') }}" method="POST">
                    @csrf
                    <div class="second-sec">
                        <div class="row g-4">
                            <div class="col-sm-12 col-md-12 col-lg-6">
                                <div class="package">
                                    <div class="main-text">الاسم</div>
                                    <input placeholder="ادخل اسمك" class="field-inpuut" type="text"
                                        id="email" name="name" value="{{ old('name') }}">
                                </div>
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-sm-12 col-md-12 col-lg-6">
                                <div class="package">
                                    <div class="main-text">الايميل</div>
                                    <input placeholder="ادخل الايميل" class="field-inpuut" type="text"
                                        id="email" name="email" value="{{ old('email') }}">
                                </div>
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-sm-12 col-md-12 col-lg-6">
                                <div class="package">
                                    <div class="main-text">الباسورد</div>
                                    <input placeholder="ادخل الباسورد" class="field-inpuut" type="password"
                                        id="email" name="password">
                                </div>
                                @error('password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-sm-12 col-md-12 col-lg-6">
                                <div class="package">
                                    <div class="main-text">تاكيد الباسورد</div>
                                    <input placeholder="اكد الباسورد" class="field-inpuut" type="password"
                                        id="email" name="password_confirmation">
                                </div>
                                @error('password_confirmation')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="col-sm-12 col-md-12 col-lg-6">
                                <div class="package">
                                    <div class="main-text">اختر الدور</div>
                                    <select name="role" id="" class="form-control">
                                        @forelse ($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                                @error('role')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
    
                        <div class="stack">
                            <button type="submit" class="saveBtn">اضافه عضو</button>
                        </div>

                    </div>
                </form>


            </div>
        </div>
    </div>
</div>

@endsection