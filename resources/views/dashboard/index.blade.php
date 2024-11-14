@extends('dashboard.master')

@section('page_title')
    {{ __('dashboard.home') }}
@endsection

@section('content')

    <x-statics />

    <!-- line chart -->
    <div class="chart-container hz-padding">

        <div class="first-chart">

            <x-barchart />

        </div>

        <div class="second-chart">
            <div class="row row-gap-3">
                <div class="col-sm-12 col-md-12 col-lg-7 col-xl-8">

                    <x-charts.speed />

                </div>

                <div class="col-sm-12 col-md-12 col-lg-5 col-xl-4">

                    <x-charts.down-chart />

                </div>
            </div>
        </div>

    </div>
    <!-- line chart -->


    <!-- Files Suggests -->

    <x-file-suggest></x-file-suggest>

    <!-- Files Suggests -->

@endsection


@section('script')
<script>
    const FilesStatics = @json($monthlyFileCounts);

    const ctx = document.getElementById("animationChart").getContext("2d");


const myPolarAreaChart = new Chart(ctx, {
    type: "line",
    data: {
        labels: [
            "يناير",
            "فبراير",
            "مارس",
            "ابريل",
            "مايو",
            "يونيو",
            "يوليو",
            "اغسطس",
            "سبتمبر",
            "اكتوبر",
            "نوفمبر",
            "ديسمبر",
        ],
        datasets: [
            {
                label: "عدد الملفات خلال الشهر",
                data: FilesStatics,
                fill: false,
                borderColor: "rgb(75, 192, 192)",
            },
        ],
    },
    options: {
        animations: {
            tension: {
                duration: 1000,
                easing: "linear",
                from: 1,
                to: 0,
                loop: true,
            },
        },
        scales: {
            y: {
                min: 0,
                max: 100,
            },
        },
    },
});


</script>

@endsection
