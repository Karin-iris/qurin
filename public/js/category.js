function pCategoryChange() {
    var p_id = $('#pCategorySelect').val();
    if(p_id) {
        $("#sCategorySelect option").remove();
        $.ajax({
            type: "GET",
            url: "/api/category/get_secondaries/" + p_id,
            dataType: "json"
        }).done(function (data) {
            str = "";

            $.map(data, function (element, index) {
                $('#sCategorySelect').append("<option value=" + element.id + ">" + "[" + element.code + "]" + element.name + "</option>");
            });

        }).fail(function (XMLHttpRequest, textStatus, error) {
            alert("エラーが発生しました。");
        });
    }
}

function sCategoryChange() {
    var s_id = $('#sCategorySelect').val();
    if(s_id){
        $("#categorySelect option").remove();
        $.ajax({
            type: "GET",
            url: "/api/category/get_children/" + s_id,
            dataType: "json"
        }).done(function (data) {
            str = "";

            $.map(data, function (element, index) {
                $('#categorySelect').append("<option value=" + element.id + ">" + "[" + element.code + "]" + element.name + "</option>");
            });
        }).fail(function (XMLHttpRequest, textStatus, error) {
            alert("エラーが発生しました。");
        });
    }

}

$(function () {
    if ($('#pCategorySelect').length && $('#sCategorySelect').length) {
        if ($('#pCategorySelect').val()) {
            pCategoryChange();
        }
    }else{
        pCategoryChange();
    }


});

