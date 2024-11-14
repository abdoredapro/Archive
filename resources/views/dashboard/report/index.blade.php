@extends('dashboard.master')


@section('page_title')
    {{ __('dashboard.files') }}
@endsection
@section('content')
<div class="chart-container hz-padding">

    <div class="first-chart">
        <!-- Bar chart -->
        <x-barchart />
    </div>

    <div class="second-chart">
        <div class="row row-gap-3">
            <div class="col-sm-12 col-md-12 col-lg-7 col-xl-8">

            </div>

        </div>
    </div>


</div>


@endsection