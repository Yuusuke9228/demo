$('#fieldCd').change(function () { //条件在庫一覧を索引
    $("#name").val($("#fieldCd option:selected").text());
    $.ajax({
        type: "POST",
        url: jouken_zaiko_itirans_ajaxGet,
        data: {'cd': $(this).val(),},
        async: true,
        dataType: 'json',
        success: function (data) {
            if (data.length === 0) {
                alert('>>エラー: 条件未登録');
            } else {
				$('#cd').val(data[0]['cd']);
				$('#fieldJunjoKbnCd').val(data[0]['junjo_kbn_cd']);
				$('#fieldJunjo2KbnCd').val(data[0]['junjo2_kbn_cd']);
				$('#fieldHanniFrom').val(data[0]['hanni_from']);
				$('#fieldHanniTo').val(data[0]['hanni_to']);
				$('#fieldHanni2From').val(data[0]['hanni2_from']);
				$('#fieldHanni2To').val(data[0]['hanni2_to']);
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
				if (data[0]['zaiko0_flg'] === '1') {
					$('#fieldZaiko0Flg').val(data[0]['zaiko0_flg']);
					$('#fieldZaiko0Flg').prop('checked', true);
				} else {
					$('#fieldZaiko0Flg').val(data[0]['zaiko0_flg']);
					$('#fieldZaiko0Flg').prop('checked', false);
				}
				if (data[0]['torihikiari_flg'] === '1') {
					$('#fieldTorihikiariFlg').val(data[0]['torihikiari_flg']);
					$('#fieldTorihikiariFlg').prop('checked', true);
				} else {
					$('#fieldTorihikiariFlg').val(data[0]['torihikiari_flg']);
					$('#fieldTorihikiariFlg').prop('checked', false);
				}
				if (data[0]['torihikinasi_flg'] === '1') {
					$('#fieldTorihikinasiFlg').val(data[0]['torihikinasi_flg']);
					$('#fieldTorihikinasiFlg').prop('checked', true);
				} else {
					$('#fieldTorihikinasiFlg').val(data[0]['torihikinasi_flg']);
					$('#fieldTorihikinasiFlg').prop('checked', false);
				}
				if (data[0]['goukeigyou_flg'] === '1') {
					$('#fieldGoukeigyouFlg').val(data[0]['goukeigyou_flg']);
					$('#fieldGoukeigyouFlg').prop('checked', true);
				} else {
					$('#fieldGoukeigyouFlg').val(data[0]['goukeigyou_flg']);
					$('#fieldGoukeigyouFlg').prop('checked', false);
				}
				//以下Ajaxが複数走るとボケるので空欄
				$('#fieldHanniFromName').val('');
				$('#fieldHanniToName').val('');
				$('#fieldHanni2FromName').val('');
				$('#fieldHanni2ToName').val('');
				//日付が再現され条件保存時の在庫を取得してしまう為
                if (data[0].kikan_tuki !== "0000-00-00") {
                    $("[name='kikan_tuki']").val(data[0].kikan_tuki);
                }
            }
        },
        error: function (xhr, status, err) {
            alert('>エラー0: ' + status + '/' + err);
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
            if ($('#fieldJunjoKbnCd').val() === '1309') { // 倉庫なら
                if ($('#fieldJunjo2KbnCd').val() == '1309') {
                    $('#fieldJunjo2KbnCd').val('1302');
                    $('#fieldJunjo2KbnCd').change();
                }
            } else { // 倉庫でなかったら、２は倉庫にする
                if ($('#fieldJunjo2KbnCd').val() !== '1309') {
                    $('#fieldJunjo2KbnCd').val('1309');
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
            if ($('#fieldJunjo2KbnCd').val() === '1309') { // 倉庫なら
                if ($('#fieldJunjoKbnCd').val() == '1309') {
                    $('#fieldJunjoKbnCd').val('1302');
                    $('#fieldJunjoKbnCd').change();
                }
            } else { // 倉庫でなかったら、1は倉庫にする
                if ($('#fieldJunjoKbnCd').val() !== '1309') {
                    $('#fieldJunjoKbnCd').val('1309');
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
$("#fieldSimekiriKbn").change(function () { //締切区分が変更されたら
    if (1 * $(this).val() != 0) { // 0:期間指定ならfalse（入力可）
        $("[name='kikan_sitei_kbn_cd']").disableSelection().attr('readonly', true);
    } else {
        $("[name='kikan_sitei_kbn_cd']").enableSelection().attr('readonly', false);
    }
    $("[name='kikan_tuki']").attr('readonly', 1 * $(this).val() != 0); // 0:期間指定ならfalse（入力可）
    $("[name='kikan_to']").attr('readonly', 1 * $(this).val() != 0); // 0:期間指定ならfalse（入力可）
});

$("#fieldKikanTuki").change(function () { //期間からが変更されたら
    $("[name='kikan_sitei_kbn_cd']").val('1213'); // 1213:任意の期間
});

$("#fieldKikanTo").change(function () { //期間からが変更されたら
    $("[name='kikan_sitei_kbn_cd']").val('1213'); // 1213:任意の期間
});

$("input[type='checkbox']").change(function () { // チェックボックスをチェックしたら
    $(this).val($(this).is(':checked') ? 1 : 0);
});


var flds = [
    "id",
    "cd",
    "name",
    "junjo_kbn_cd",
    "hanni_from",
    "hanni_from_name",
    "hanni_to",
    "hanni_to_name",
    "junjo2_kbn_cd",
    "hanni2_from",
    "hanni2_from_name",
    "hanni2_to",
    "hanni2_to_name",
    "koujun_flg",
    "kikan_tuki",
    "zaiko0_flg",
    "torihikiari_flg",
    "torihikinasi_flg",
    "meisaigyou_flg",
    "soukohyouji_flg",
    "goukeigyou_flg",
];

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
}

$('#fieldUtiwakeKbns').change(function () { // 内訳区分を変更したら
    $('#fieldUtiwakeKbns option').each(function () {
        $('#' + $(this).attr('option')).val($(this).prop('selected') ? 1 : 0);
    });
});

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
        location.href = jouken_zaiko_itirans + "/modaldel?cd=" + $("#cd").val();
    }
}
