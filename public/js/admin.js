//user chart
let userChartCanvas = $("#usersChart").get(0).getContext("2d");
let userData = {
    labels: ["Free", "Paid"],
    datasets: [{
        data: [freeUsers, paidUsers],
        backgroundColor: ["#f56954", "#f39c12"],
    }, ],
};

let userOptions = {
    maintainAspectRatio: false,
    responsive: true,
    plugins: {
        labels: {
            fontColor: "#fff",
        },
    },
};

new Chart(userChartCanvas, {
    type: "doughnut",
    data: userData,
    options: userOptions,
});

//gender chart
let genderChartCanvas = $("#genderChart").get(0).getContext("2d");
let genderData = {
    labels: ["Male", "Female"],
    datasets: [{
        data: [maleUsers, femaleUsers],
        backgroundColor: ["#f56954", "#f39c12"],
    }, ],
};

let genderOptions = {
    maintainAspectRatio: false,
    responsive: true,
    plugins: {
        labels: {
            fontColor: "#fff",
        },
    },
};

new Chart(genderChartCanvas, {
    type: "doughnut",
    data: genderData,
    options: genderOptions,
});

//income chart
let incomeChartData = {
    labels: [
        "Jan",
        "Feb",
        "Mar",
        "Apr",
        "May",
        "June",
        "Jul",
        "Aug",
        "Sep",
        "Oct",
        "Nov",
        "Dec",
    ],
    datasets: [{
        label: "Income" + currentYear,
        backgroundColor: "#f39c12",
        borderColor: "#f39c12",
        data: [],
    }, ],
};

for (let i = 1; i <= 12; i++) {
    incomeChartData.datasets[0].data[i - 1] = montlyIncome[i] || 0;
}

let incomeChartCanvas = $("#incomeChart").get(0).getContext("2d");
let incomeChart_ = $.extend(true, {}, incomeChartData);
incomeChart_.datasets[0] = incomeChartData.datasets[0];

let chartOptions = {
    responsive: true,
    maintainAspectRatio: false,
    datasetFill: false,
    plugins: {
        labels: {
            render: function() {
                return "";
            },
            fontColor: "#000",
        },
    },
};

new Chart(incomeChartCanvas, {
    type: "bar",
    data: incomeChart_,
    options: chartOptions,
});

//user registration
let userGraphData = {
    labels: [
        "Jan",
        "Feb",
        "Mar",
        "Apr",
        "May",
        "June",
        "Jul",
        "Aug",
        "Sep",
        "Oct",
        "Nov",
        "Dec",
    ],
    datasets: [{
        label: "User Registration" + currentYear,
        backgroundColor: "#f39c12",
        borderColor: "#f39c12",
        data: [],
    }, ],
};

for (let i = 1; i <= 12; i++) {
    userGraphData.datasets[0].data[i - 1] = userGraph[i] || 0;
}

let userGraphCanvas = $("#userGraph").get(0).getContext("2d");
let userGraph_ = $.extend(true, {}, userGraphData);
userGraph_.datasets[0] = userGraphData.datasets[0];

new Chart(userGraphCanvas, {
    type: "bar",
    data: userGraph_,
    options: chartOptions,
});