@extends('dashboard.master')


@section('page_title')
    مشاريع / مستفيدون
@endsection
@section('content')

<div class="categories">

    <div class="text-center">
        <div class="first-white-board hz-padding">
            <h3 class="title">اضافه مشاريع / مستفيدون</h3>

            <div class="sec-white-board">

                <form action="{{ route('dashboard.projects.update', $project->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="second-sec">
                        <div class="row g-4">
                            <div class="col-sm-12 col-md-12 col-lg-6">
                                <div class="package">
                                    <div class="main-text">مشاريع / مستفيدون</div>
                                    <input placeholder="اضافه الاسم" class="field-inpuut" type="text"
                                        id="email" name="name" value="{{ $project->name }}">
                                </div>
                                @error('name')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                        </div>
    
                        <div class="stack">
                            <button type="submit" class="saveBtn custom">حفظ</button>
                        </div>
    
    
                    </div>
                </form>


            </div>
        </div>
    </div>
</div>

@endsection