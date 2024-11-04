const ctx1 = document.getElementById("myChart1");
const ctx2 = document.getElementById("myBarChart");




 
  createChart(ctx1, data, "line");
  createChart(ctx2, data, "bar");

  function createChart(ctx, data, type) {
    const isBarChart = type === "bar";
    const totalViews = isBarChart ? data.reduce((acc, item) => acc + item.views, 0) : 1;
    const chartData = data.map(item => isBarChart ? (item.views / totalViews) * 100 : item.views);

    const colors = ['#FF5733', '#C70039', '#900C3F', '#581845', '#2C3E50', '#D68910', '#27AE60'];

  new Chart(ctx, {
    type: type,
    data: {
      labels: data.map((item) => item.month),
      datasets: [
        {
          label: type === "line" ? "المشاهدات بالشهر" : "الحصة",
          data: chartData,
          backgroundColor: isBarChart ? colors.slice(0, data.length) : "#FD5DEF0A",
          borderColor: isBarChart ? colors.slice(0, data.length) : '#FF5BEF',
          borderWidth: 1,
          fill: isBarChart ? false : true,
        },
      ],
    },
    options: {
      responsive: true,
      scales: {
        y: {
          beginAtZero: true,
          grid: {
            display: isBarChart ? true : false, // Hide grid lines for x-axis
          },
          ticks: {
            callback: function (value) {
              return isBarChart ? value + '%' : value;
            }
          },
        },
        x: {
          grid: {
            display: isBarChart ? true : false, // Hide grid lines for x-axis
          },
        },
      },
      plugins: {
        legend: {
          display: isBarChart ? true : false, // Hide the legend
        },
      },
      maintainAspectRatio: false,
    },
  });
}


// speed chart
const data = {
  labels: ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"],
  datasets: [
    {
      label: "Weekly Sales",
      data: items,
      backgroundColor: [
        "rgba(255, 26, 104, 0.2)",
        "rgba(54, 162, 235, 0.2)",
        "rgba(255, 206, 86, 0.2)",
        "rgba(75, 192, 192, 0.2)",
        "rgba(153, 102, 255, 0.2)",
        "rgba(255, 159, 64, 0.2)",
        "rgba(0, 0, 0, 0.2)",
      ],
      borderColor: [
        "rgba(255, 26, 104, 1)",
        "rgba(54, 162, 235, 1)",
        "rgba(255, 206, 86, 1)",
        "rgba(75, 192, 192, 1)",
        "rgba(153, 102, 255, 1)",
        "rgba(255, 159, 64, 1)",
        "rgba(0, 0, 0, 1)",
      ],
      borderWidth: 1,
      circumference: 180,
      rotation: 270,
      cutout: "80%",
      angleValue: 30
    },
  ],
};

const gaugeNeedle = {
  id: "gaugeNeedle",
  afterDatasetsDraw(chart, args, options) {
    const { ctx, data } = chart;

    ctx.save();
    const xCenter = chart.getDatasetMeta(0).data[0].x;
    const yCenter = chart.getDatasetMeta(0).data[0].y;
    const outerRadius = chart.getDatasetMeta(0).data[0].outerRadius;
    const innerRadius = chart.getDatasetMeta(0).data[0].innerRadius;
    const widthSlice = (outerRadius - innerRadius) / 2;
    const radius = 15;
    const angle = Math.PI / 180;

    const needleValue = data.datasets[0].angleValue;
    const dataTotal = data.datasets[0].data.reduce((a, b) => a + b, 0);
    const circumference = ((chart.getDatasetMeta(0).data[0].circumference / Math.PI) / data.datasets[0].data[0]) * needleValue;

    ctx.translate(xCenter, yCenter);
    ctx.rotate(Math.PI * (circumference + 1.5));

    ctx.beginPath();
    ctx.strokeStyle = "#0051EC";
    ctx.fillStyle = "#0051EC";
    ctx.lineWidth = 1;
    ctx.moveTo(0 - radius, 0);
    ctx.lineTo(0, 0 - innerRadius + widthSlice);
    ctx.lineTo(0 + radius, 0);
    ctx.closePath();
    ctx.stroke();
    ctx.fill();

    //   dot
    ctx.beginPath();
    ctx.arc(0, 0, radius, 0, angle * 360, false);
    ctx.fill();

    ctx.restore();
  },
};

// gaugeFlowMeter plugin block
const gaugeFlowMeter = {
    id: 'gaugeFlowMeter',
    afterDatasetsDraw(chart, args, options) {
        const { ctx, data } = chart;
        ctx.save();
        const needleValue = data.datasets[0].angleValue;
        const xCenter = chart.getDatasetMeta(0).data[0].x;
        const yCenter = chart.getDatasetMeta(0).data[0].y;
        const circumference = ((chart.getDatasetMeta(0).data[0].circumference / Math.PI) / data.datasets[0].data[0]) * needleValue;
        const percentageValue = circumference * 100;

        // flowMeter
        ctx.font = 'bold 30px sans-serif';
        ctx.fillStyle = '#0051EC';
        ctx.textAlign = 'center';
        ctx.fillText(`${percentageValue.toFixed(1)}%`, xCenter, yCenter + 45);
    }
}


// config
const config = {
  type: "doughnut",
  data,
  options: {
    responsive: true,
    layout: {
      padding: {
        bottom: 20,
      }
    },
    aspectRatio: 1.5,
    plugins: {
      legend: {
        display: false,
      },
      tooltip: {
        enabled: false,
      },
    },
  },
  plugins: [gaugeNeedle, gaugeFlowMeter],
};

// Check if the screen width is at least 768px
if (window.matchMedia("(max-width: 768px)").matches) {
  // Override padding in options for larger screens
  config.options.layout.padding = {
    bottom: 50,
  };
}

// render init block
const myChart = new Chart(document.getElementById("myChart"), config);

// Instantly assign Chart.js version
const chartVersion = document.getElementById("chartVersion");
chartVersion.innerText = Chart.version;

