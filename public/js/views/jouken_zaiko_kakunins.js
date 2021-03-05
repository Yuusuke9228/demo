$('#fieldCd').change(function () {  //条件在庫一覧を索引
    $("#name").val($("#fieldCd option:selected").text());
    $.ajax({
        type: "POST",
        url: jouken_zaiko_kakunins_ajaxGet,
        data: {'cd': $(this).val(),},
        async: true,
        dataType: 'json',
        success: function (data) {
            if (data.length === 0) {
                alert('>>Error : 条件未登録');
            } else {
                $('#cd').val(data[0]['cd']);
                $('#fieldJunjoKbnCd').val(data[0]['junjo_kbn_cd']);
                $('#fieldJunjo2KbnCd').val(data[0]['junjo2_kbn_cd']);
                $('#fieldHanniFrom').val(data[0]['hanni_from']);
                $('#fieldHanniTo').val(data[0]['hanni_to']);
                $('#fieldHanni2From').val(data[0]['hanni2_from']);
                $('#fieldHanni2To').val(data[0]['hanni2_to']);
                $('#fieldHusokuRyou').val(data[0]['husoku_ryou']);
                $('#fieldKajouRyou').val(data[0]['kajou_ryou']);
                $('#fieldKijunikaRyou').val(data[0]['kijunika_ryou']);
				//明示的にチェックボックスを操作する(チェック状態が変化しない為)
				if (data[0]['koujun_flg'] === '1') {
					$('#fieldKoujunFlg').val(data[0]['koujun_flg']);
					$('#fieldKoujunFlg').prop('checked', true);
				} else {
					$('#fieldKoujunFlg').val(data[0]['koujun_flg']);
					$('#fieldKoujunFlg').prop('checked', false);
				}
				if (data[0]['meisaigyou_flg'] === '1') {
					$('#fieldMeisaigyouFlg').val(data[0]['meisaigyou_flg']);
					$('#fieldMeisaigyouFlg').prop('checked', true);
				} else {
					$('#fieldMeisaigyouFlg').val(data[0]['meisaigyou_flg']);
					$('#fieldMeisaigyouFlg').prop('checked', false);
				}
				if (data[0]['soukohyouji_flg'] === '1') {
					$('#fieldSoukohyoujiFlg').val(data[0]['soukohyouji_flg']);
					$('#fieldSoukohyoujiFlg').prop('checked', true);
				} else {
					$('#fieldSoukohyoujiFlg').val(data[0]['soukohyouji_flg']);
					$('#fieldSoukohyoujiFlg').prop('checked', false);
				}
				if (data[0]['kabusoku_check_flg'] === '1') {
					$('#fieldKabusokuCheckFlg').val(data[0]['kabusoku_check_flg']);
					$('#fieldKabusokuCheckFlg').prop('checked', true);
				} else {
					$('#fieldKabusokuCheckFlg').val(data[0]['zaiko0_flg']);
					$('#fieldKabusokuCheckFlg').prop('checked', false);
				}
				if (data[0]['zaikoari_flg'] === '1') {
					$('#fieldZaikoariFlg').val(data[0]['zaikoari_flg']);
					$('#fieldZaikoariFlg').prop('checked', true);
				} else {
					$('#fieldZaikoariFlg').val(data[0]['zaikoari_flg']);
					$('#fieldZaikoariFlg').prop('checked', false);
				}
				if (data[0]['zaikonasi_flg'] === '1') {
					$('#fieldZaikonasiFlg').val(data[0]['zaikonasi_flg']);
					$('#fieldZaikonasiFlg').prop('checked', true);
				} else {
					$('#fieldZaikonasiFlg').val(data[0]['zaikonasi_flg']);
					$('#fieldZaikonasiFlg').prop('checked', false);
				}
                //以下Ajaxが複数走るとボケるので空欄
                $('#fieldHanniFromName').val('');
                $('#fieldHanniToName').val('');
                $('#fieldHanni2FromName').val('');
                $('#fieldHanni2ToName').val('');
            }
        },
        error: function (xhr, status, err) {
            alert('>エラー0' + status + '/' + err);
        },
    });
});

$('#fieldJunjoKbnCd').change(function () { //順序区分コード
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
            if ($('#fieldJunjoKbnCd').val() === '1409') { // 倉庫なら
                if ($('#fieldJunjo2KbnCd').val() === '1409') {
                    $('#fieldJunjo2KbnCd').val('1402');
                    $('#fieldJunjo2KbnCd').change();
                }
            } else { // 倉庫でなかったら、２は倉庫にする
                if ($('#fieldJunjo2KbnCd').val() !== '1409') {
                    $('#fieldJunjo2KbnCd').val('1409');
                    $('#fieldJunjo2KbnCd').change();
                }
            }
        },
        error: function (xhr, status, err) {
            alert('>エラー2a:' + status + '/' + err);
        },
    });
});

$('#fieldJunjo2KbnCd').change(function () { //順序2区分コード
    $.ajax({
        type: "POST",
        url: junjo_kbns_ajaxHanni,
        data: {'cd': $(this).val(),},
        async: true,
        dataType: 'json',
        success: function (data) {
            $("[name='hanni2_from']").val(data.from);
            $("[name='hanni2_from_name']").val(data.from_name);
            $("[name='hanni2_to']").val(data.to);
            $("[name='hanni2_to_name']").val(data.to_name);
            $("[name='junjo2_kbn_table']").val(data.junjo_kbn_table);
            if ($('#fieldJunjo2KbnCd').val() === '1409') { // 倉庫なら
                if ($('#fieldJunjoKbnCd').val() == '1409') {
                    $('#fieldJunjoKbnCd').val('1402');
                    $('#fieldJunjoKbnCd').change();
                }
            } else { // 倉庫でなかったら、1は倉庫にする
                if ($('#fieldJunjoKbnCd').val() !== '1409') {
                    $('#fieldJunjoKbnCd').val('1409');
                    $('#fieldJunjoKbnCd').change();
                }
            }
        },
        error: function (xhr, status, err) {
            alert('>エラー2b:' + status + '/' + err);
        },
    });
});

$('#fieldHanniFrom, #fieldHanniTo, #fieldHanni2From, #fieldHanni2To').change(function () { //範囲から,まで
    kore = $(this).attr('id');
    if ($(this).val() == '') {
        $("#" + kore + "Name").val("");
    } else {
        $.ajax({
            type: "POST",
            url: junjo_kbns_ajaxGet,
            data: {
                'cd': $(this).val(),
                'target_cd': $('#fieldJunjo' + (kore.substr(10, 1) == '2' ? '2' : '') + 'KbnCd').val(),
            },
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
        modalstart(hanni_modal, "選択");
    } else if (lastfocusin == "fieldHanni2From" || lastfocusin == "fieldHanni2To") { /*  範囲からまで  */
        hanni_modal = base_uri + $("#junjo2_kbn_table").val() + "/modal";
        modalstart(hanni_modal, "選択");
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


/* 画面内計算 */
$("input[type='checkbox']").change(function () { // チェックボックスをチェックしたら
    $(this).val($(this).is(':checked') ? 1 : 0);
});

//2019/10/04
var flds = [
    "id",
    "cd",
    "name",
    "junjo_kbn_cd",
    "hanni_from",
    "hanni_to",
    "junjo2_kbn_cd",
    "hanni2_from",
    "hanni2_to",
    "koujun_flg",
    "meisaigyou_flg",
    "soukohyouji_flg",
    "goukeigyou_flg",
    "zaikoari_flg",
    "zaikonasi_flg",
    "kabusoku_check_flg",
    "kajou_ryou",
    "husoku_ryou",
    "kijunika_ryou",
];

//2019/10/04
window.onload = function () {
    for (i in flds) {
        $("[name='" + flds[i] + "']").val(window.parent.$("[name='" + flds[i] + "']").val());
    }
    $("input[type='checkbox']").each(function () {
        $(this).prop('checked', $(this).val() == 1);
    });
    $('#fieldJunjoKbnCd').change();
    $('#fieldJunjo2KbnCd').change();
    $("#name").val($("#fieldCd option:selected").text());
    $("#fieldKijunikaRyou").val(0);
};

$("#fieldKijunikaRyou").change(function () {
    $("#fieldHusokuRyou").val(0.01);
    $("#fieldKajouRyou").val(0.01);
});
$("#fieldHusokuRyou").change(function () {
    $("#fieldKijunikaRyou").val(0);
});
$("#fieldKajouRyou").change(function () {
    $("#fieldKijunikaRyou").val(0);
});

$('#fieldUtiwakeKbns').change(function () { // 内訳区分を変更したら
    $('#fieldUtiwakeKbns option').each(function () {
        $('#' + $(this).attr('option')).val($(this).prop('selected') ? 1 : 0);
    });
});

//=========================================================

function return_value() {
    for (i in flds) {
        window.parent.document.getElementsByName(flds[i])[0].value = "" + $("[name='" + flds[i] + "']").val();
    }
    window.parent.fromModal("submit");
}

function new_name() {
    ret = prompt("選択条件名", $("#fieldCd option:selected").text());
    if (ret) {
        $("#cd").val("");
        $("#name").val(ret);
        return;
    }
    return false;
}

function init_del() {
    ret = confirm("初期化/削除します。");
    if (ret) {
        $('#fieldCd').change();
        location.href = jouken_zaiko_kakunins + "/modaldel?cd=" + $("#cd").val();
    }
}
