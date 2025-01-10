@extends('dashboard.master')


@section('page_title')
    الصلاحيات
@endsection
@section('content')

<div class="categories">


    <div class="text-center">
        <div class="first-white-board hz-padding">
            <h3 class="title">اضافه صلاحيه</h3>

            <div class="sec-white-board">

                <form action="{{ route('dashboard.roles.update', $role->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="second-sec">
                        <div class="row g-4">
                            <div class="col-sm-12 col-md-12 col-lg-6">
                                <div class="package">
                                    <div class="main-text">اضافه صلاحيه</div>
                                    <input required placeholder="اضافه صلاحيه" class="field-inpuut" type="text"
                                        id="email" name="name" value="{{ $role->name }}"
                                            >
                                </div>
                                @error('name')
                                    {{ $message }}
                                @enderror
                            </div>

                        </div>

                        <div class="row g-4 p-4">
                            @foreach ($permissions as $permission)
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="package">
                                    <label  class="main-text" for="per_{{$permission->name}}">{{ __('dashboard.'.$permission->name) }}</label>
                                    <input  class="field-inpuut" type="checkbox"
                                        id="per_{{$permission->name}}" name="permissions[{{ $permission->name }}]"
                                        @checked($role->hasPermissionTo($permission->name))>
                                </div>
                            </div>
                            @endforeach
                        </div>
    
                        <div class="stack">
                            <button type="submit" class="saveBtn">تعديل الصلاحيه</button>
                        </div>
    
                    </div>
                </form>


            </div>
        </div>
    </div>
</div>

@endsection