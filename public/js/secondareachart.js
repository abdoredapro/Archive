// areachart.js

document.addEventListener("DOMContentLoaded", function () {
    var ctx = document.getElementById("secondAreaChart").getContext("2d");
  
    // Create gradient
    var gradient = ctx.createLinearGradient(0, 0, 0, ctx.canvas.height);
    gradient.addColorStop(0, "#A6C3F0"); // Color at the top (0%)
    gradient.addColorStop(1, "rgba(224, 236, 255, 0.803775)");// rgba(51, 84, 244, 0.0001) at 100%
  
    var myAreaChart = new Chart(ctx, {
      type: "line",
      data: {
        labels: ["يناير", "فبراير", "مارس", "ابريل", "مايو", "يونيو", "يوليو"],
        datasets: [
          {
            label: "التنزيلات",
            data: [10, 20, 45, 15, 10, 30, 0],
            backgroundColor: gradient,
            borderColor: "#74ABFF",
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
  