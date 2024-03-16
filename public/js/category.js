function pCategoryChange() {
    var p_id = $('#pCategorySelect').val() ?  $('#pCategorySelect').val(): $('#pCategoryDSelect').val();
    var s_id = $('#sCategorySelect').val() ?  $('#sCategorySelect').val(): $('#sCategoryDSelect').val();
    if(p_id) {
        $("#sCategorySelect option").remove();
        $("#categorySelect option").remove();
        $.ajax({
            type: "GET",
            url: "/api/category/get_secondaries/" + p_id,
            dataType: "json"
        }).done(function (data) {
            $('#sCategorySelect').append("<option value=''></option>");
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
            console.log("エラーが発生しました。");
        });
    }
}

function sCategoryChange() {
    var s_id =  $('#sCategorySelect').val() ?  $('#sCategorySelect').val(): $('#sCategoryDSelect').val();
    var c_id = $('#categorySelect').val() ?  $('#categorySelect').val(): $('#categoryDSelect').val();
    if(s_id != ''){
        $("#categorySelect option").remove();
        $.ajax({
            type: "GET",
            url: "/api/category/get_children/" + s_id,
            dataType: "json"
        }).done(function (data) {
            str = "";
            $('#categorySelect').append("<option value=''></option>");
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
            console.log("エラーが発生しました。");
        });
    }
}
function categoryChange() {
    var c_id = $('#categorySelect').val() ?  $('#categorySelect').val(): $('#categoryDSelect').val();
    if(c_id) {
        $.ajax({
            type: "GET",
            url: "/api/category/get_gpt/" + c_id,
            dataType: "json"
        }).done(function (data) {
            $('#categoryGPT').val(data);
        }).fail(function (XMLHttpRequest, textStatus, error) {
            console.log("エラーが発生しました。");
        });
        $.ajax({
            type: "GET",
            url: "/api/category/get_gpt2/" + c_id,
            dataType: "json"
        }).done(function (data) {
            $('#categoryGPT2').val(data);
        }).fail(function (XMLHttpRequest, textStatus, error) {
            console.log("エラーが発生しました。");
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

$(function () {
    $('#button-copygpt').click(function () {
        // data-urlの値を取得
        //const url = $(this).data('url');
        const gpt = $('#categoryGPT').val();
        // クリップボードにコピー
        navigator.clipboard.writeText(gpt);

        // フラッシュメッセージ表示
        $('.success-msg').fadeIn("slow", function () {
            $(this).delay(2000).fadeOut("slow");
        });
    });
});



