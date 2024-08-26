@extends('dashboard.master')


@section('page_title')
{{ __('dashboard.category') }}
@endsection
@section('content')

<div class="categories">

    <div class="text-center">
        <div class="first-white-board hz-padding">
            <h3 class="title">تعديل مستخدم</h3>

            <div class="sec-white-board">

                <form action="{{ route('dashboard.users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="second-sec">
                        <div class="row g-4">
                            <div class="col-sm-12 col-md-12 col-lg-6">
                                <div class="package">
                                    <div class="main-text">الاسم</div>
                                    <input placeholder="ادخل اسمك" class="field-inpuut" type="text"
                                        id="email" name="name" value="{{ old('name', $user->name) }}">
                                </div>
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-sm-12 col-md-12 col-lg-6">
                                <div class="package">
                                    <div class="main-text">الايميل</div>
                                    <input placeholder="ادخل الايميل" class="field-inpuut" type="text"
                                        id="email" name="email" value="{{ old('email', $user->email) }}">
                                </div>
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-sm-12 col-md-12 col-lg-6">
                                <div class="package">
                                    <div class="main-text">تعديل الدور</div>
                                    <select name="role" id="" class="form-control">
                                        @forelse ($roles as $role)
                                            <option value="{{ $role->id }}" >{{ $role->name }}</option>
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
                            <button type="submit" class="saveBtn">تعديل العضو</button>
                        </div>

                    </div>
                </form>


            </div>
        </div>
    </div>
</div>

@endsection