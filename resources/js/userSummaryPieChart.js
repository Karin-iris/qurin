import {
    Chart,
    initTE,
} from "tw-elements";

initTE({ Chart });
var key=[];
var va=[];
    $.ajax({
        type: "GET",
        url: "/api/question/get_user_summary/",
        dataType: "json"
    }).done(function (data) {
        $.map(data, function (element, index) {
            key.push(element.user_id);
            va.push(element.count_questions);
        });
        const dataPie = {
            type: 'pie',
            data: {
                labels: key,
                datasets: [
                    {
                        label: 'Traffic',
                        data: va,
                        backgroundColor: [
                            'rgba(63, 81, 181, 0.5)',
                            'rgba(77, 182, 172, 0.5)',
                            'rgba(66, 133, 244, 0.5)',
                            'rgba(156, 39, 176, 0.5)',
                            'rgba(233, 30, 99, 0.5)',
                            'rgba(66, 73, 244, 0.4)',
                            'rgba(66, 133, 244, 0.2)',
                        ],
                    },
                ],
            },
        };
        new Chart(document.getElementById('pie-chart'), dataPie);
    }).fail(function (XMLHttpRequest, textStatus, error) {
        alert("エラーが発生しました。");
    });


