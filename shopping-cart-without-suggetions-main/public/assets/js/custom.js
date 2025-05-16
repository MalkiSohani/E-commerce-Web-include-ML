new Chart(document.getElementById("sales_chart"), {
    type: "bar",
    data: {
        labels: xData,
        datasets: [
            {
                label: "Sales of last ten days",
                data: yData,
                backgroundColor: [
                    "rgba(16, 135, 211, 1)",
                    "rgba(255, 115, 24, 1)",
                    "rgba(34, 167, 120, 1)",
                    "rgba(255, 24, 55, 1)",
                    "rgba(16, 135, 211, 1)",
                    "rgba(255, 115, 24, 1)",
                    "rgba(34, 167, 120, 1)",
                    "rgba(255, 24, 55, 1)",
                    "rgba(16, 135, 211, 1)",
                    "rgba(255, 115, 24, 1)",
                ],
                borderColor: [
                    "rgba(16, 135, 211, 1)",
                    "rgba(255, 115, 24, 1)",
                    "rgba(34, 167, 120, 1)",
                    "rgba(255, 24, 55, 1)",
                    "rgba(16, 135, 211, 1)",
                    "rgba(255, 115, 24, 1)",
                    "rgba(34, 167, 120, 1)",
                    "rgba(255, 24, 55, 1)",
                    "rgba(16, 135, 211, 1)",
                    "rgba(255, 115, 24, 1)",
                ],
                borderWidth: 1,
            },
        ],
    },
    options: {
        scales: {
            y: {
                beginAtZero: true,
            },
        },
    },
});
