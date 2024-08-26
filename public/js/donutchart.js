document.addEventListener("DOMContentLoaded", function() {
    var ctx = document.getElementById('myDonutChart').getContext('2d');
    var myDonutChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['أفلام', 'ملفات', 'مشاريع'],
            datasets: [{
                label: 'My First Dataset',
                data: [filmCount, fileCount, projects],
                backgroundColor: [
                    '#FA8382',
                    '#FE971B',
                    '#1B1F50'
                ],
                hoverOffset: 4
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                },
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.label + ': ' + tooltipItem.raw.toFixed(2);
                        }
                    }
                }
            }
        }
    });
});