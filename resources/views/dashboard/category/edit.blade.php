@extends('dashboard.master')


@section('page_title')
{{ __('dashboard.category') }}
@endsection
@section('content')

<div class="categories">


    <div class="text-center">
        <div class="first-white-board hz-padding">
            <h3 class="title">{{ __('dashboard.category_add') }}</h3>

            <div class="sec-white-board">

                <form action="{{ route('dashboard.category.update', $category->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="second-sec">
                        <div class="row g-4">
                            <div class="col-sm-12 col-md-12 col-lg-6">
                                <div class="package">
                                    <div class="main-text">{{ __('dashboard.name') }}</div>
                                    <input placeholder="{{ __('dashboard.category_placeholder') }}" class="field-inpuut" type="text"
                                        id="email" name="name" value="{{ $category->name }}">
                                </div>
                                @error('name')
                                    {{ $message }}
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