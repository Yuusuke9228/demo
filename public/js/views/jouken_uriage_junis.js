$('#fieldCd').change(function () { //条件売上順位を索引
    $("#name").val($("#fieldCd option:selected").text());
    $.ajax({
        type: "POST",
        url: jouken_uriage_junis_ajaxGet,
        data: {'cd': $(this).val(),},
        async: true,
        dataType: 'json',
        success: function (data) {
            if (data.length == 0) {
                alert('>>エラー:条件未登録');
            } else {
                $("[name='junjo_kbn_cd']").val(data[0].junjo_kbn_cd);
                $("[name='junjo_kbn_table']").val(data[0].junjo_kbn_table);
                $("[name='koujun_flg']").val(flg = data[0].koujun_flg).prop("checked", (flg == 1));
                $("[name='hanni_from']").val(data[0].hanni_from);
                $("[name='hanni_to']").val(data[0].hanni_to);
                $("[name='zeikomi_flg']").val(flg = data[0].zeikomi_flg).prop("checked", (flg == 1));
                $("[name='meisaigyou_flg']").val(flg = data[0].meisaigyou_flg).prop("checked", (flg == 1));
                $("[name='goukeigyou_flg']").val(flg = data[0].goukeigyou_flg).prop("checked", (flg == 1));
                $("[name='torihikiari_flg']").val(flg = data[0].torihikiari_flg).prop("checked", (flg == 1));
                $("[name='torihikinasi_flg']").val(flg = data[0].torihikinasi_flg).prop("checked", (flg == 1));
                $("[name='hokakei_flg']").val(flg = data[0].hokakei_flg).prop("checked", (flg == 1));
                $("[name='zennnen_flg']").val(flg = data[0].Zennnen_flg).prop("checked", (flg == 1));
                if (data[0].kikan_sitei_kbn_cd && data[0].simekiri_kbn == "0") {
                    $("[name='kikan_sitei_kbn_cd']").val(data[0].kikan_sitei_kbn_cd);
                    if (data[0].kikan_from != "0000-00-00") {
                        $("[name='kikan_from']").val(data[0].kikan_from);
                    }
                    if (data[0].kikan_to != "0000-00-00") {
                        $("[name='kikan_to']").val(data[0].kikan_to);
                    }
                    $("[name='kikan_sitei_kbn_cd']").change();
                }
                $("[name='junjo_kbn_cd']").change();
            }
        },
        error: function (xhr, status, err) {
            alert('>エラー0' + status + '/' + err);
        },
    });
});

$('#fieldKikanSiteiKbnCd').change(function () { //期間指定区分を索引
    $.ajax({
        type: "POST",
        url: kikan_sitei_kbns_ajaxGet,
        data: {'cd': $(this).val(),},
        async: true,
        dataType: 'json',
        success: function (data) {
            if (data.kikan_from != "0000-00-00") {
                $("[name='kikan_from']").val(data.kikan_from)
            }
            ;
            if (data.kikan_to != "0000-00-00") {
                $("[name='kikan_to']").val(data.kikan_to)
            }
            ;
        },
        error: function (xhr, status, err) {
            alert('>エラー1' + status + '/' + err);
        },
    });
});

$('#fieldJunjoKbnCd').change(function () { //順序区分コード
    if ($(this).val().substr(-2) == "01") {
        $("[name='hanni_from']").val("");
        $("[name='hanni_from_name']").val("");
        $("[name='hanni_to']").val("");
        $("[name='hanni_to_name']").val("");
        $("[name='junjo_kbn_table']").val("");
    } else {
        $.ajax({
            type: "POST",
            url: junjo_kbns_ajaxHanni,
            data: {'cd': $(this).val(),},
            async: true,
            dataType: 'json',
            success: function (data) {
                $("[name='hanni_from']").val(data.from);
                $("[name='hanni_from_name']").val(data.from_name);
                $("[name='hanni_to']").val(data.to);
                $("[name='hanni_to_name']").val(data.to_name);
                $("[name='junjo_kbn_table']").val(data.junjo_kbn_table);
            },
            error: function (xhr, status, err) {
                alert('>エラー2' + status + '/' + err);
            },
        });
    }
});

$('#fieldHanniFrom, #fieldHanniTo').change(function () { //範囲から,まで
    kore = $(this).attr('id');
    if ($(this).val() == '') {
        $("#" + kore + "Name").val("");
    } else {
        $.ajax({
            type: "POST",
            url: junjo_kbns_ajaxGet,
            data: {'cd': $(this).val(), 'target_cd': $('#fieldJunjoKbnCd').val(),},
            async: true,
            dataType: 'json',
            success: function (data) {
                if (data.length == 0) {
                    $('#' + kore + 'Name').val('>>エラー:未登録');
                } else if (data.length == 1 || $('#' + kore).val() == data[0].cd) {
                    $('#' + kore + 'Options > option').remove(); //選択肢をクリアしてから追加する
                    for (var i = 0; i < data.length; i++) {
                        $('#' + kore + 'Options').append('<option value="' + data[i].cd + '">' + data[i].cd + ':' + data[i].name + '</option>');
                    }
                    $('#' + kore).val(data[0].cd);
                    $('#' + kore + 'Name').val(data[0].name);
                } else {
                    $('#' + kore + 'Options > option').remove(); //選択肢をクリアしてから追加する
                    for (var i = 0; i < data.length; i++) {
                        $('#' + kore + 'Options').append('<option value="' + data[i].cd + '">' + data[i].cd + ':' + data[i].name + '</option>');
                    }
                    $('#' + kore + 'Name').val('>>エラー:未登録');
                    $('#' + kore).focus().select();
                }
            },
            error: function (xhr, status, err) {
                $('#' + kore + 'Name').val('>エラー3' + status + '/' + err);
            },
        });
    }
});

/* モーダルダイヤログ部分 */
function f8key() {
    if (lastfocusin == "fieldHanniFrom" || lastfocusin == "fieldHanniTo") { /*  範囲からまで  */
        hanni_modal = base_uri + $("#junjo_kbn_table").val() + "/modal";
        modalstart(hanni_modal);
    }
}

function modalstart(url) {
    $('#iframe-wrap').fadeIn();
    $('#iframe-body').html('<iframe src="' + url + '?cd=' + $('#' + lastfocusin).val() + '" width="100%" height="100%" style="border: none;">');
    $('#iframe-bg').fadeTo('normal', 0.5);
    $('#iframe-body iframe').load(function () {
        $(this).contents().find('#header, #footer').hide();
    });
    return false;
}

$('#iframe-wrap button').click(function () { /* 中止して終わる (X) */
    $('#iframe-bg, #iframe-wrap').fadeOut();
});

function fromModal(retval) {
    //alert('親ページの関数が実行されました。');
    $('#iframe-wrap').fadeOut(
        function () {//alert("フェードアウト完了")
            if (retval) {
                $('#' + lastfocusin).val(retval);
                $('#' + lastfocusin).change();
            }
        }
    );
    $('#iframe-bg').fadeOut();
    $('#' + lastfocusin).focus().select();
}

$(function () { // モーダルウィンドウをドラッグで移動できる
    $("#iframe-wrap").draggable({
        handle: ".modal-header"
    });
});


/* 画面内計算 */

$("#fieldKikanFrom").change(function () { //期間からが変更されたら
    $("[name='kikan_sitei_kbn_cd']").val('1719'); // 1719:任意の期間
});

$("#fieldKikanTo").change(function () { //期間からが変更されたら
    $("[name='kikan_sitei_kbn_cd']").val('1719'); // 1719:任意の期間
});

$("input[type='checkbox']").change(function () { // チェックボックスをチェックしたら
    $(this).val($(this).is(':checked') ? 1 : 0);
});


var flds = [
    "cd",
    "junjo_kbn_cd",
    "koujun_flg",
    "hanni_from",
    "hanni_to",
    "kikan_sitei_kbn_cd",
    "kikan_from",
    "kikan_to",
    "zeikomi_flg",
    "meisaigyou_flg",
    "goukeigyou_flg",
    "torihikiari_flg",
    "torihikinasi_flg",
    "hokakei_flg",
    "zennen_flg",
];
window.onload = function () {
    if (!$("#id").val()) {
        for (i in flds) {
            $("[name='" + flds[i] + "']").val(flg = "" + window.parent.document.getElementsByName(flds[i])[0].value);
        }
    }
    $("input[type='checkbox']").each(function () {
        $(this).prop('checked', $(this).val() == 1);
    });
    $("#name").val($("#fieldCd option:selected").text());
    $('#fieldJunjoKbnCd').change();
}

function return_value() {
    for (i in flds) {
        window.parent.document.getElementsByName(flds[i])[0].value = "" + $("[name='" + flds[i] + "']").val();
    }
    window.parent.fromModal("submit");
}

function new_name() {
    alert($("#fieldTorihikinasiFlg").val());
    ret = prompt("選択条件名", $("#fieldCd option:selected").text());
    if (ret) {
        $("#fieldCd").val("");
        $("#name").val(ret);
        return;
    }
    return false;
}

// function init_del() {
// 	ret = confirm("初期化/削除します。");
// 	if (ret) {
// 		location.href=jouken_uriage_geppous+"/modaldel/"+$("#fieldCd").val();
// 	}
// }
