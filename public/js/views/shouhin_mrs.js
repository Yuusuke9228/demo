$('#fieldCd').change(function () { //商品台帳索引
//	alert($(this).val()); //''の場合、'0'など1桁の場合または結果が複数の場合、結果が1個の場合、結果が0個の場合
    if ($(this).val() != '') {
        $.ajax({
            type: "POST",
            url: shouhin_mrs_ajaxGet,
            data: {'cd': $(this).val(),},
            async: true,
            dataType: 'json',
            success: function (data) {
                if (data.length >= 1 && $('#fieldCd').val() === data[0].cd) {
                    location.href = shouhin_mrs_edit + data[0].id;
                } else if ($('#fieldId').val()) {
                    alert('商品コード：' + $('#fieldCd').val() + ' は未登録です。');
                    location.href = shouhin_mrs_edit + $('#fieldId').val();
                } else {
                    $('#fieldName').focus().select();
                }
            },
            error: function (xhr, status, err) {
                alert('エラー Cd.change.ajax ' + status + '/' + err);
            },
        });
    }
});

/*
 * フリガナ取得 Add By Nishiyama 2019-10-23
*/
$('#fieldName').change(function() {
    var input = $(this).val();
    input = toHalfWidth(input);
    input = zenkakuToHankaku(input);
    if (input !== '') {
        $.ajax({
            type: "POST",
            url: shouhin_mrs_getKana,
            data: {'input': input,},
            async: true,
            dataType: 'json',
            success: function (data) {
                $('#fieldKana').val(data['kana'].slice(0, -3)); //EOSが入るので消す
            },
            error: function(xhr, status, err) {
                alert('Error: Name.Change.Ajax ' + status + '/' + err);
            },
        });
    }
});

$('#fieldTanniMrCd').change(function () { //単位と数単位は同じになれない
    if ($(this).val() == $('#fieldSuuTanniMrCd').val()) {
        $('#fieldSuuTanniMrCd').val("");
    }
});

$('#fieldSuuTanniMrCd').change(function () { //単位と数単位は同じになれない
    if ($(this).val() == $('#fieldTanniMrCd').val()) {
        $('#fieldSuuTanniMrCd').val("");
    }
});

/* モーダルダイヤログ部分 */
function f8key() {
    if (lastfocusin == "fieldCd") { /* 商品コード選択 */
        modalstart(shouhin_mrs_modal, "商品選択");
    }
}

function modalstart(url, title) {
    $('#iframe-title').text(title);
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

function final_check() { // 最終チェック…F12登録を押したときにエラーがあれば戻る。onsubmit
    $("#F12").focus();
    var res = confirm('よろしいですか?');
    if (res) {
        if (!final_souko_check()) {
            window.alert("倉庫が選択されていないので、登録できません!!");
            return false;
        }
        if (!final_utiwake_check()) {
            window.alert("内訳区分が選択されていないので、登録できません!!");
            return false;
        }
        return true;
    } else {
        return false;
    }

}

function final_check() { // 最終チェック…F12登録を押したときにエラーがあれば戻る。onsubmit
    $("#F12").focus();
    var res = confirm('よろしいですか?');
    if (res) {
        if (!final_tani1_check()) {
            window.alert("単位１が選択されていないので、登録できません!!");
            return false;
        }
        if (!final_tani2_check()) {
            window.alert("単位２が選択されていないので、登録できません!!");
            return false;
        }
        if (!final_Hinshitu_check()) {
            window.alert("標準品質が選択されていないので、登録できません!!");
            return false;
        }
        return true;
    } else {
        return false;
    }

}
//fieldTanniMr1Cd
function final_Hinshitu_check() {
    if  (!($("#fieldHinsituKbnCd").val())) {
        return false;
    } else {
        return true;
    }
}
function final_tani1_check() {
    if  (!($("#fieldTanniMr1Cd").val())) {
        return false;
    } else {
        return true;
    }
}
function final_TanniMr2_check() {
    if  (!($("#fieldTanniMr2Cd").val())) {
        return false;
    } else {
        return true;
    }
}
