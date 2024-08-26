// areachart.js

document.addEventListener("DOMContentLoaded", function () {
  var ctx = document.getElementById("firstAreaChart").getContext("2d");

  // Create gradient
  var gradient = ctx.createLinearGradient(0, 0, 0, 400);
  gradient.addColorStop(0, "rgba(51, 84, 244, 1)"); // #3354F4 at 0%
  gradient.addColorStop(0, "rgba(191, 160, 254, 0.992712)"); // rgba(191, 160, 254, 0.992712) at 0%
  gradient.addColorStop(1, "rgba(51, 84, 244, 0.0001)"); // rgba(51, 84, 244, 0.0001) at 100%

  var myAreaChart = new Chart(ctx, {
    type: "line",
    data: {
      labels: ["يناير", "فبراير", "مارس", "ابريل", "مايو", "يونيو", "يوليو"],
      datasets: [
        {
          label: "التحميلات",
          data: [0, 10, 5, 2, 20, 30, 45],
          backgroundColor: gradient,
          borderColor: "#3354F4",
          fill: true, // This is what creates the area effect
          tension: 0.4,
        },
      ],
    },
    options: {
      responsive: true,
      maintainAspectRatio: false, // Allow chart to grow to full width
      scales: {
        x: {
          display: true,
          grid: {
            display: false, // Hide grid lines for x-axis
          },
          title: {
            display: false,
            text: "الشهر",
          },
        },
        y: {
          display: false,
          grid: {
            display: false, // Hide grid lines for y-axis
          },
          title: {
            display: false,
            text: "التحميلات",
          },
        },
      },
      plugins: {
        legend: {
          display: false, // Hide the legend
        },
      },
    },
  });
});
