@extends('dashboard.master')


@section('page_title')
{{ __('dashboard.category') }}
@endsection
@section('content')

<div class="categories">
    {{-- <div class="stack-head">
    <h3 class="title">{{ __('dashboard.category_add') }}</h3>
    </div> --}}


    <div class="text-center">
        <div class="first-white-board hz-padding">
            <h3 class="title">{{ __('dashboard.category_add') }}</h3>

            <div class="sec-white-board">

                <form action="{{ route('dashboard.category.store') }}" method="POST">
                    @csrf
                    <div class="second-sec">
                        <div class="row g-4">
                            <div class="col-sm-12 col-md-12 col-lg-6">
                                <div class="package">
                                    <div class="main-text">{{ __('dashboard.name') }}</div>
                                    <input placeholder="{{ __('dashboard.category_placeholder') }}" class="field-inpuut" type="text"
                                        id="email" name="name">
                                </div>
                                @error('name')
                                    <div class="text-danger text-end mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
    
                        <div class="stack">
                            <button type="submit" class="saveBtn custom">{{ __('dashboard.category_add') }}</button>
                        </div>
    
    
                    </div>
                </form>


            </div>
        </div>
    </div>
</div>

@endsection