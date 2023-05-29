function pCategoryChange() {
    var p_id = $('#pCategorySelect').val();
    var s_id = $('#sCategorySelect').val();
    if(p_id) {
        $("#sCategorySelect option").remove();
        $.ajax({
            type: "GET",
            url: "/api/category/get_secondaries/" + p_id,
            dataType: "json"
        }).done(function (data) {
            var str = "";

            $.map(data, function (element, index) {
                var selected = '';
                if(s_id == element.id){
                    selected = ' selected';
                    selectValue = element.id;
                }else if(!s_id &&index == 0){
                    selected = ' selected';
                    selectValue = element.id;
                }

                $('#sCategorySelect').append("<option value=" + element.id + "" + selected + ">" + "[" + element.code + "]" + element.name + "</option>");
            });
            sCategoryChange();
        }).fail(function (XMLHttpRequest, textStatus, error) {
            alert("エラーが発生しました。");
        });
    }
}

function sCategoryChange() {
    var s_id = $('#sCategorySelect').val();
    var c_id = $('#categorySelect').val();
    if(s_id != ''){
        $("#categorySelect option").remove();
        $.ajax({
            type: "GET",
            url: "/api/category/get_children/" + s_id,
            dataType: "json"
        }).done(function (data) {
            str = "";

            $.map(data, function (element, index) {
                var selected = '';
                if(c_id == element.id){
                    selected = ' selected';
                }else if(!c_id && index == 0){
                    selected = ' selected';
                }
                $('#categorySelect').append("<option value=" + element.id + "" + selected + ">" + "[" + element.code + "]" + element.name + "</option>");
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
    }
});

