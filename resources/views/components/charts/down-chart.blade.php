<div class="donutchart">
    <canvas id="myDonutChart"></canvas>
</div>


<script>
    document.addEventListener("DOMContentLoaded", function() {
        var ctx = document.getElementById("myDonutChart").getContext("2d");
        var myDonutChart = new Chart(ctx, {
            type: "doughnut",
            data: {
                labels: @json($categories),
                datasets: [{
                    label: "My First Dataset",
                    data: [300, 150, 100],
                    backgroundColor: ["#FA8382", "#FE971B", "#1B1F50"],
                    hoverOffset: 4,
                }, ],
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: "bottom",
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return (
                                    tooltipItem.label +
                                    ": " +
                                    tooltipItem.raw.toFixed(2)
                                );
                            },
                        },
                    },
                },
            },
        });
    });
</script>
