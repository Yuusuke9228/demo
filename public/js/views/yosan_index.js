window.onload=function() {
    if ($('#fieldJunjoFlg').val() === '0') {
        $('#fieldJunjoFlg').val("2");
        $('#fieldJunjoFlg').change();
    }
    if ($('#fieldKikanSiteiKbnCd').val() !== '') {
        $('#fieldKikanSiteiKbnCd').change();
    }
    if ($('#fieldKikan2SiteiKbnCd').val() !== '') {
        $('#fieldKikan2SiteiKbnCd').change();
    }
}

// データ更新部分-----------------------------------------------
$('.yosan-input').change(function() {
    // 数値チェック
    const isNumber = (value) => {
        return Number.isFinite(value);
    }
    if (!isNumber(parseInt($(this).val()))) {
        $(this).val('0');
        alert("予算は整数値のみ入力してください!!");
        return;
    }

    // 更新に必要なキー項目を作る
    const this_id = $(this).attr('id');
    const split_id = this_id.split('_'); // 予算入力欄のid: "tuki_<?php echo $row; ?>_1" を分解して使用する
    const row_no = split_id['1'];   // 行番
    const tuki_col = split_id['2']; // 月ごとの列

    const nendo = $('#nendo').val();
    const tuki = $(`#tuki_${tuki_col}`).text().replace(/[^0-9^\.]/g, "");
    const key_cd = $(`#key_cd_${row_no}`).val();
    const hyouji_flg = $('#fieldHyoujiKbn').val();
    const junjo_flg = $('#fieldJunjoFlg').val();
    const yosan = $(this).val();

    const post_data = {
        'yosan_junjo_flg': junjo_flg,
        'yosan_junjo_cd': key_cd,
        'kingaku_arari_flg': hyouji_flg,
        'nendo': nendo,
        'tuki': tuki,
        'yosan': yosan,
    }

    $.ajax({
        type: 'post',
        url: yosan_dts_ajaxSave,
        data: post_data,
        async: true,
        dataType: 'json',
        success: function(response) {
            console.log(response);
            // 更新成功時、合計行を再計算
            getSoukei(yosan, tuki_col, row_no);
        },
        error: function(xhr, status, err) {
            console.log(`Error > yosan-input.change(): ${status}/${err}`);
            alert('予算データの更新が失敗しました。');
        }
    });
});

/**
 * 予算の縦横計を計算
 *
 * @param yosan
 * @param tuki_col
 * @param row_no
 * @returns {boolean}
 */
function getSoukei(yosan, tuki_col, row_no) {
    let yosan_kei = $(`#tmp${tuki_col}kei`).text().replace(/,/g, "");
    yosan_kei = parseInt(yosan_kei) + parseInt(yosan);
    $(`#tmp${tuki_col}kei`).text(yosan_kei.toLocaleString());

    let row_kei = $(`#kikan_goukei${row_no}`).val().replace(/,/g, "");
    row_kei = parseInt(row_kei) + parseInt(yosan);
    $(`#kikan_goukei${row_no}`).val(row_kei.toLocaleString());

    return true;
}
//--------------------------------------------------------------

// 条件設定フォーム---------------------------------------------
$('#fieldJunjoFlg').change(function () {
    $.ajax({
        type:"post",
        url: junjo_kbns_ajaxHanni,
        data: {'cd': $(this).val(),},
        async: true,
        dataType: 'json',
        success: function (data) {
            $("#fieldHanniFrom").val(data.from);
            $("#fieldHanniFromName").val(data.from_name);
            $("#fieldHanniTo").val(data.to);
            $("#fieldHanniToName").val(data.to_name);
        },
        error: function(xhr, status, err) {
            console.log(`Error > fieldJunjoFlg.change(): ${status}/${err}`);
            $("#fieldHanniFrom").val('');
            $("#fieldHanniFromName").val('');
            $("#fieldHanniTo").val('');
            $("#fieldHanniToName").val('');
        },
    });
    const title = $('#fieldJunjo1Flg option:selected').text();
    $('#th_sankou_cd').text(`${title}CD`);
    $('#th_sankou_name').text(`${title}名称`);
});


$('#fieldKikanSiteiKbnCd').change(function () {
    const thisVal = $(this).val();
    $.ajax({
       type: 'post',
       url: konnnendo_ajaxGet,
       data: {'cd': thisVal},
       dataType: 'json',
       success: function(data) {
           $('#fieldKikanFrom').val(data[0]['kikan_from']);
           $('#fieldKikanTo').val(data[0]['kikan_to']);
       },
       error: function (xhr, status, err) {
           console.log(`Error > fieldKikanSiteiKbnCd.change(): ${status}/${err}`);
       },
   });
});

$('#fieldKikan2SiteiKbnCd').change(function () {
    const thisVal = $(this).val();
    $.ajax({
        type: 'post',
        url: konnnendo_ajaxGet,
        data: {'cd': thisVal},
        dataType: 'json',
        success: function(data) {
            $('#fieldKikan2From').val(data[0]['kikan_from']);
            $('#fieldKikan2To').val(data[0]['kikan_to']);
        },
        error: function (xhr, status, err) {
            console.log(`Error > fieldKikan2SiteiKbnCd.change(): ${status}/${err}`);
        },
    });
});

/**
 * 範囲From
 */
$('#fieldHanniFrom').change(function () {
    const junjo_flg = parseInt($('#fieldJunjoFlg').val());
    if (!junjo_flg) {
        alert('予算設定の基準区分を選択してください。');
        return;
    }
    let url = '';
    if (junjo_flg === 1) {
        url = tokuisaki_mrs_ajaxGet;
    } else if (junjo_flg === 2) {
        url = tantou_mrs_ajaxGet;
    } else {
        url = shouhin_mrs_ajaxGet;
    }
    $.ajax({
        type: "post",
        url: url,
        data: {'cd': $(this).val(),},
        async: true,
        dataType: 'json',
        success: function (data) {
            $('#fieldHanniFromName').val(data[0]['name']);
        },
        error: function (xhr, status, err) {
            console.log(`Error > fieldHanniFrom.change(): ${status}/${err}`);
        },
    });
});

/**
 * 範囲To
 */
$('#fieldHanniTo').change(function () {
    const junjo_flg = parseInt($('#fieldJunjoFlg').val());
    if (!junjo_flg) {
        alert('予算設定の基準区分を選択してください。');
        return;
    }
    let url = '';
    if (junjo_flg === 1) {
        url = tokuisaki_mrs_ajaxGet;
    } else if (junjo_flg === 2) {
        url = tantou_mrs_ajaxGet;
    } else {
        url = shouhin_mrs_ajaxGet;
    }
    $.ajax({
        type: "post",
        url: url,
        data: {'cd': $(this).val(),},
        async: true,
        dataType: 'json',
        success: function (data) {
            $('#fieldHanniToName').val(data[0]['name']);
        },
        error: function (xhr, status, err) {
            console.log(`Error > fieldHanniTo.change(): ${status}/${err}`);
        },
    });
});

// ------------------------------------------------------------------

// 予算入力関連------------------------------------------------------


// ------------------------------------------------------------------

// table 装飾--------------------------------------------------------
$('table tbody tr').click(function () {
    $('tr').removeClass('activetr');
    $(this).addClass('activetr');
});

$(function () {
    $('table.head_fix').floatThead({
        top: 50
    });
});
// -----------------------------------------------------------------

// モーダル----------------------------------------------------------
function f8key() {
    let url = '';
    if (lastfocusin === "fieldHanniFrom" || lastfocusin === "fieldHanniTo") {
        if (parseInt($('#fieldJunjoFlg').val()) === 1) {
            url = tokuisaki_mrs_modal;
        } else if (parseInt($('#fieldJunjoFlg').val()) === 2) {
            url = tantou_mrs_modal;
        } else if (parseInt($('#fieldJunjoFlg').val()) === 3) {
            url = shouhin_mrs_modal;
        } else {
            url = '';
        }
    }

    if (url !== '') {
        modalstart(url);
    }
}

function modalstart(url) {
    $('#iframe-wrap').fadeIn();
    $('#iframe-body').html(`<iframe src="${url}" width="100%" height="100%" style="border: none;">`);
    $('#iframe-bg').fadeTo('normal', 0.5);
    $('#iframe-body iframe').load(function () {
        $(this).contents().find('#header, #footer').hide();
    });
    return false;
}

$('#iframe-wrap button').click(function () {
    $('#iframe-bg, #iframe-wrap').fadeOut();
});

function fromModal(retval) {
    $(`#${lastfocusin}`).val(retval);
    $('#iframe-bg, #iframe-wrap').fadeOut();
    $(`#${lastfocusin}`).change();
    $(`#${lastfocusin}`).focus().select();
}

$(function () {
    $("#iframe-wrap").draggable({
        handle: ".modal-header"
    });
});
// -------------------------------------------------------------

// 入力値チェック
function form_validation() {
    if ($('#fieldJunjoFlg').val() === '0') {
        alert('予算設定の基準区分が指定されていません。');
        return false;
    }
    // 年度でまとめて取得するので、From側のみ日付データがあれば良い
    if ($('#fieldKikanFrom').val() === '') {
        alert('予算設定年度が指定されていません。');
        return false;
    }
    if ($('#fieldKikan2From').val() === '') {
        alert('参考実績年度が指定されていません。');
        return false;
    }

    return true;
}