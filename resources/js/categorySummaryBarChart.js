import {
    Chart,
    initTE,
} from "tw-elements";

initTE({ Chart });

var key=[];
var va=[];

const optionsBarCustomOptions = {
    options: {
        plugins: {
            legend: {
                position: "top",
                labels: {
                    color: "green",
                },
            },
        },
        scales: {
            x: {
                ticks: {
                    color: "#4285F4",
                },
            },
            y: {
                ticks: {
                    color: "#f44242",
                },
            },
        },
    },
};

$.ajax({
    type: "GET",
    url: "/api/question/get_secondary_category_summary/",
    dataType: "json"
}).done(function (data) {
    $.map(data, function (element, index) {
        key.push(element.s_c_name);
        va.push(element.count_questions);
    });
    const dataBarCustomOptions = {
        type: "bar",
        data: {
            labels: key,
            datasets: [
                {
                    label: "Traffic",
                    data: va,
                    backgroundColor: [
                        "rgba(255, 99, 132, 0.2)",
                        "rgba(54, 162, 235, 0.2)",
                        "rgba(255, 206, 86, 0.2)",
                        "rgba(75, 192, 192, 0.2)",
                        "rgba(153, 102, 255, 0.2)",
                        "rgba(255, 159, 64, 0.2)",
                    ],
                    borderColor: [
                        "rgba(255,99,132,1)",
                        "rgba(54, 162, 235, 1)",
                        "rgba(255, 206, 86, 1)",
                        "rgba(75, 192, 192, 1)",
                        "rgba(153, 102, 255, 1)",
                        "rgba(255, 159, 64, 1)",
                    ],
                    borderWidth: 1,
                },
            ],
        },
    };
    new Chart(
        document.getElementById("bar-chart-custom-options"),
        dataBarCustomOptions,
        optionsBarCustomOptions
    );
}).fail(function (XMLHttpRequest, textStatus, error) {
    alert("エラーが発生しました。");
});







