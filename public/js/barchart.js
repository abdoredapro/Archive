document.addEventListener("DOMContentLoaded", function () {
    const ctx = document.getElementById("barChart").getContext("2d");

    
    // Calculate total views to convert to percentage
    const totalViews = items.reduce((acc, curr) => acc + curr.views, 0);

    // Map data to labels and percentage values
    const labels = items.map((item) => item.name);
    const percentages = items.map((item) =>
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
