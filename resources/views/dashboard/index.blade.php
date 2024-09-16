@extends('dashboard.master')


@section('page_title')
{{ __('dashboard.home') }}

@endsection
@section('content')


<!-- cards -->
<div class="text-center hz-padding">
    <div class="row row-gap-3">
        <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3">
            <a href="{{ route('dashboard.film.index') }}">
              <div class="box orange">
                <div class="stack">
                    <div class="icon-background">
                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24">
                            <path fill="currentColor" fill-rule="evenodd"
                                d="M11.943 1.25h.114c2.309 0 4.118 0 5.53.19c1.444.194 2.584.6 3.479 1.494c.895.895 1.3 2.035 1.494 3.48c.19 1.411.19 3.22.19 5.529v.114c0 2.309 0 4.118-.19 5.53c-.194 1.444-.6 2.584-1.494 3.479c-.895.895-2.035 1.3-3.48 1.494c-1.411.19-3.22.19-5.529.19h-.114c-2.309 0-4.118 0-5.53-.19c-1.444-.194-2.584-.6-3.479-1.494c-.895-.895-1.3-2.035-1.494-3.48c-.19-1.411-.19-3.22-.19-5.529v-.114c0-2.309 0-4.118.19-5.53c.194-1.444.6-2.584 1.494-3.479c.895-.895 2.035-1.3 3.48-1.494c1.411-.19 3.22-.19 5.529-.19M6.25 2.982c-1.065.183-1.742.5-2.255 1.013c-.514.513-.83 1.19-1.013 2.255H6.25zm1.5-.162v8.43h8.5V2.82c-1.126-.07-2.508-.07-4.25-.07s-3.124 0-4.25.07m10 .162V6.25h3.268c-.183-1.065-.5-1.742-1.013-2.255c-.513-.514-1.19-.83-2.255-1.013m3.43 4.768h-3.43v3.5h3.5c-.002-1.395-.011-2.54-.07-3.5m.07 5h-3.5v3.5h3.43c.059-.96.068-2.105.07-3.5m-.232 5H17.75v3.268c1.065-.183 1.742-.5 2.255-1.013c.514-.513.83-1.19 1.013-2.255m-4.768 3.43v-8.43h-8.5v8.43c1.126.07 2.508.07 4.25.07s3.124 0 4.25-.07m-10-.162V17.75H2.982c.183 1.065.5 1.742 1.013 2.255c.513.514 1.19.83 2.255 1.013M2.82 16.25h3.43v-3.5h-3.5c.002 1.395.011 2.54.07 3.5m-.07-5h3.5v-3.5H2.82c-.059.96-.068 2.105-.07 3.5"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <h4 class="card-title">عدد الأفلام</h4>
                </div>
                <p class="card-text">{{ $films_count }}</p>
            </div>
            </a>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3">
          <a href="{{ route('dashboard.projects.index') }}">
            <div class="box blue">
                <div class="stack">
                    <div class="icon-background">
                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 56 56">
                            <path fill="currentColor"
                                d="M38.446 29.232c4.786 0 8.686-4.263 8.686-9.45c0-5.128-3.88-9.19-8.686-9.19c-4.766 0-8.687 4.122-8.687 9.23c.02 5.167 3.921 9.41 8.687 9.41m-23.164.442c4.142 0 7.54-3.72 7.54-8.284c0-4.464-3.358-8.063-7.54-8.063c-4.142 0-7.56 3.66-7.54 8.103c.02 4.545 3.398 8.244 7.54 8.244m23.164-3.478c-2.936 0-5.45-2.815-5.45-6.374c0-3.5 2.474-6.193 5.45-6.193c2.996 0 5.449 2.654 5.449 6.152c0 3.56-2.473 6.415-5.449 6.415m-23.164.482c-2.453 0-4.544-2.352-4.544-5.248c0-2.835 2.07-5.107 4.544-5.107c2.533 0 4.564 2.232 4.564 5.067c0 2.936-2.091 5.288-4.564 5.288M4.102 48.113h15.785c-.966-.543-1.71-1.75-1.569-2.976H3.6c-.402 0-.603-.16-.603-.543c0-4.986 5.69-9.651 12.266-9.651c2.533 0 4.805.603 6.756 1.749a10.463 10.463 0 0 1 2.272-2.131c-2.594-1.71-5.71-2.594-9.028-2.594C6.837 31.967 0 38.079 0 44.775c0 2.232 1.367 3.338 4.102 3.338m21.716 0h25.256c3.337 0 4.926-1.005 4.926-3.217c0-5.268-6.656-12.89-17.554-12.89c-10.919 0-17.574 7.622-17.574 12.89c0 2.212 1.588 3.217 4.946 3.217m-.965-3.036c-.523 0-.744-.14-.744-.563c0-3.298 5.107-9.47 14.337-9.47c9.21 0 14.316 6.172 14.316 9.47c0 .422-.2.563-.724.563Z" />
                        </svg>
                    </div>
                    <h4 class="card-title">عدد المشاريع</h4>
                </div>
                <p class="card-text">{{ $projects->count() }}</p>
            </div>
          </a>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3">
            <a href="{{ route('dashboard.file.index') }}">
              <div class="box green">
                <div class="stack">
                    <div class="icon-background">
                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24">
                            <path fill="currentColor"
                                d="M12 17q.425 0 .713-.288T13 16t-.288-.712T12 15t-.712.288T11 16t.288.713T12 17m0-4q.425 0 .713-.288T13 12t-.288-.712T12 11t-.712.288T11 12t.288.713T12 13m0-4q.425 0 .713-.288T13 8t-.288-.712T12 7t-.712.288T11 8t.288.713T12 9m8 11H4q-.825 0-1.412-.587T2 18v-4q.825 0 1.413-.587T4 12t-.587-1.412T2 10V6q0-.825.588-1.412T4 4h16q.825 0 1.413.588T22 6v4q-.825 0-1.412.588T20 12t.588 1.413T22 14v4q0 .825-.587 1.413T20 20m0-2v-2.55q-.925-.55-1.463-1.462T18 12t.538-1.987T20 8.55V6H4v2.55q.925.55 1.463 1.463T6 12t-.537 1.988T4 15.45V18zm-8-6" />
                        </svg>
                    </div>
                    <h4 class="card-title">عدد الملفات</h4>
                </div>
                <p class="card-text">{{ $files }}</p>
              </div>
            </a>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3">
            <a href="{{ route('dashboard.category.index') }}">
              <div class="box pink">
                <div class="stack">
                    <div class="icon-background">
                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 32 32">
                            <path fill="currentColor"
                                d="M17 21h-7v-7h7zm-5-2h3v-3h-3zm5 11h-7v-7h7zm-5-2h3v-3h-3zm14-7h-7v-7h7zm-5-2h3v-3h-3zm5 11h-7v-7h7zm-5-2h3v-3h-3z" />
                            <path fill="currentColor"
                                d="M8 28H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h7.586A2 2 0 0 1 13 4.586L16.414 8H28a2 2 0 0 1 2 2v8h-2v-8H15.586l-4-4H4v20h4Z" />
                        </svg>
                    </div>
                    <h4 class="card-title">عدد الفئات</h4>
                </div>
                <p class="card-text">{{ $category }}</p>
            </div>
            </a>
        </div>
    </div>
</div>
<!-- cards -->

<!-- line chart -->
<div class="chart-container hz-padding">

    <div class="first-chart">
        <h3 class="first-chart-title">حصة كل فئة</h3>
        <!-- Bar chart -->
        <canvas id="barChart"></canvas>
    </div>

    <div class="second-chart">
        <div class="row row-gap-3">
            <div class="col-sm-12 col-md-12 col-lg-7 col-xl-8">

                <div class="chartBox">
                    <canvas id="myChart"></canvas>
                    <div class="chartTitle">
                        {{-- <p class="card-revenue">$10,500.00</p> --}}
                        <h3 class="card-goal">الهدف الشهري</h3>
                    </div>
                </div>

                
            </div>

            <div class="col-sm-12 col-md-12 col-lg-5 col-xl-4">
                <!-- Bar chart -->

                <div class="donutchart">
                    <canvas id="myDonutChart"></canvas>
                </div>
            </div>
        </div>
    </div>


</div>
<!-- line chart -->


<!-- footer -->
<x-file-suggest />
<!-- footer -->




<script>
    const filmCount = {{ $films_count }};
    const fileCount = {{ $files }};

    const projects  = {{ $projects->count() }};


document.addEventListener("DOMContentLoaded", function () {
  const ctx = document.getElementById("barChart").getContext("2d");

  var data = [];
  let myD = @json($projectsArray);

myD.forEach(el => {
    data.push({activity: el.name, views: el.files_count });
});

  // Calculate total views to convert to percentage
  const totalViews = data.reduce((acc, curr) => acc + curr.views, 0);

  // Map data to labels and percentage values
  const labels = data.map((item) => item.activity);
  const percentages = data.map((item) =>
    ((item.views / totalViews) * 100).toFixed(2)
  );

  const backgroundColors = [
    "#64B5F6",
    "#7986CB",
    "#9C27B0",
    "#E040FB",
    "#F06292",
    "#E57373",
    "#FBC02D",
  ];

  const borderColors = backgroundColors.map((color) => {
    const rgbaColor = hexToRGBA(color, 0.8); // Adjust the transparency as needed
    return rgbaColor;
  });

  const chartData = {
    labels: labels,
    datasets: [
      {
        label: "حصة كل فئة",
        data: percentages, // Use percentages instead of raw views
        backgroundColor: backgroundColors,
        borderColor: borderColors,
        borderWidth: 1,
      },
    ],
  };

  // Determine canvas height based on screen size
  let canvasHeight = 75; // Default height for large screens
  if (window.innerWidth <= 768) {
    canvasHeight = 300; // Set height for mobile screens
  }

  const config = {
    type: "bar",
    data: chartData,
    options: {
      responsive: true,
      maintainAspectRatio: false,
      scales: {
        y: {
          beginAtZero: true,
          ticks: {
            callback: function (value) {
              return value + "%"; // Append '%' to y-axis ticks
            },
          },
        },
        maintainAspectRatio: false,
      },
      plugins: {
        tooltip: {
          callbacks: {
            label: function (context) {
              let label = context.dataset.label || "";
              if (label) {
                label += ": ";
              }
              if (context.parsed.y !== null) {
                label += context.parsed.y.toFixed(2) + "%"; // Format tooltip value as percentage
              }
              return label;
            },
          },
        },
      },
    },
  };

  // Set canvas height dynamically
  const canvas = document.getElementById("barChart");
  canvas.height = canvasHeight;

  const barChart = new Chart(ctx, config);
});

// Helper function to convert hex color to RGBA
function hexToRGBA(hex, alpha) {
  const r = parseInt(hex.slice(1, 3), 16);
  const g = parseInt(hex.slice(3, 5), 16);
  const b = parseInt(hex.slice(5, 7), 16);
  return `rgba(${r}, ${g}, ${b}, ${alpha})`;
}


</script>


<script>
    const items = [5, 12, 6, 9, 12, 3, 9];
</script>



@endsection
