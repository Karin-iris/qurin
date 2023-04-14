function pCategoryChange() {
    var p_id = $('#pCategorySelect').val();
    $("#sCategorySelect option").remove();
    $.ajax({
        type: "GET",
        url: "/api/category/get_secondaries/" + p_id,
        dataType: "json"
    }).done(function (data) {
        str = "";

        $.map(data, function (index, element) {
            $('#sCategorySelect').append("<option value=" + element + ">" + index + "</option>");
        });
        sCategoryChange();

    }).fail(function (XMLHttpRequest, textStatus, error) {
        alert("エラーが発生しました。");
    });
}
function sCategoryChange() {
    var s_id = $('#sCategorySelect').val();
    $("#categorySelect option").remove();
    $.ajax({
        type: "GET",
        url: "/api/category/get_children/" + s_id,
        dataType: "json"
    }).done(function (data) {
        str = "";

        $.map(data, function (index, element) {
            $('#categorySelect').append("<option value=" + element + ">" + index + "</option>");
        });
    }).fail(function (XMLHttpRequest, textStatus, error) {
        alert("エラーが発生しました。");
    });
}
$(function(){
    if($('#pCategorySelect').val()) {
        pCategoryChange();
    }

});

