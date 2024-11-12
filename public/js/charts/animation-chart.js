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
        ],
        datasets: [
            {
                label: "Looping tension",
                data: [65, 59, 80, 81, 26, 55, 40],
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
                // defining min and max so hiding the dataset does not change scale range
                min: 0,
                max: 100,
            },
        },
    },
});
