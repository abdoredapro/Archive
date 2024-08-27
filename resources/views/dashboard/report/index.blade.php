@extends('dashboard.master')


@section('page_title')
    {{ __('dashboard.files') }}
@endsection
@section('content')
<div class="chart-container hz-padding">

    <div class="first-chart">
        <h3 class="first-chart-title">حصة كل فئة</h3>
        <!-- Bar chart -->
        <canvas id="barChart"></canvas>
    </div>

    <div class="second-chart">
        <div class="row row-gap-3">
            <div class="col-sm-12 col-md-12 col-lg-7 col-xl-8">

                <div class="area-chart mb-3">
                    <div class="stack-area-chart">
                        <div class="speed">5,03 mbps</div>
                        <div class="second-stack">
                            <div class="color">
                                <i class="fa-solid fa-arrow-up"></i>
                            </div>
                            <div class="main-text-chart">التحميلات</div>
                        </div>
                    </div>
                    <canvas id="firstAreaChart"></canvas>
                </div>

                <div class="area-chart">
                    <div class="stack-area-chart">
                        <div class="speed">14,34 mbps</div>
                        <div class="second-stack">
                            <div class="color blue">
                                <i class="fa-solid fa-arrow-down"></i>
                            </div>
                            <div class="main-text-chart">التنزيلات</div>
                        </div>
                    </div>
                    <canvas id="secondAreaChart"></canvas>
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




<script>
    const filmCount = {{ $films }};
    const fileCount = {{ $files }};

    const projects  = {{ $projects }};


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