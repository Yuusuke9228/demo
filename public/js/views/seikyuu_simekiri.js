/* モーダルダイヤログ部分 */
function f8key() {
    if (lastfocusin.substr(0, 5) === "code_") { /* 操作選択 */
        modalstart(tokuisaki_sime_dts_modal_menu, "操作選択");
    } else if (lastfocusin === "fieldSimeHiduke") { /* 締日選択 */
        open_datepicker();
    } else if (lastfocusin === "fieldKaishuuYoteibi") { /* 回収予定日選択 */
        open_datepicker();
    }
}


function open_datepicker() {
    $('#' + lastfocusin).datepicker({
        dateFormat: 'yy-mm-dd',
        onSelect: function () {
            $('#' + lastfocusin).focus();
        },
        onClose: function () {
            $('#' + lastfocusin).datepicker('destroy');
        }
    });
    $('#' + lastfocusin).datepicker('show');
}

function modalstart(url, title, tokuisaki_mr_cd = '') {
    $('#iframe-title').text(title);
    $('#iframe-wrap').fadeIn();
    if (tokuisaki_mr_cd === '') {
        $('#iframe-body').html('<iframe src="' + url + '?cd=' + lastfocusin.substr(5) + '" width="100%" height="100%" style="border: none;">');
    } else {
        $('#iframe-body').html('<iframe src="' + url + '?tokuisaki_mr_cd=' + tokuisaki_mr_cd + '" width="100%" height="100%" style="border: none;">');
    }
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

$(':checkbox').change(function () { //チェックボックスが変更されたら
    var thisChk = this;
    //次の項目へ自動移動
    var index = $targetElm.index(thisChk);
    for (var i = index + 1;
         i <= $targetElm.length && (!$targetElm.eq(i).isVisible()
             || $targetElm.eq(i).attr("readonly") == "readonly"
             || typeof ($targetElm.eq(i).attr("tabindex")) != "undefined"
         );
         i++) {
    }
    if (i <= $targetElm.length) {
        index = i;
    }
    $targetElm.eq(index).focus().select();//alert(index);
});

$('#PgUp').click(function () { //ページアップキー(Ctrl+Shift+Enter)を押したら前行へ移動
    var index = $targetElm.index($("#" + lastfocusin));//alert(index);
    for (i = index - 1; i >= 0 && (!$targetElm.eq(i).isVisible() || typeof ($targetElm.eq(i).attr("id")) == "undefined" || $targetElm.eq(i).attr("name").substr(0, 5) != "code_"); i--) {
    }
    if (i >= 0) {
        index = i;
    }
    $targetElm.eq(index).focus().select();
});

$('#PgDn').click(function () { //ページダウンキー(Ctrl+Enter)を押したら次行へ移動
    var index = $targetElm.index($("#" + lastfocusin));//alert(index);
    for (i = index + 1; i <= $targetElm.length && (!$targetElm.eq(i).isVisible() || typeof ($targetElm.eq(i).attr("id")) == "undefined" || $targetElm.eq(i).attr("name").substr(0, 5) != "code_"); i++) {
    }
    if (i <= $targetElm.length) {
        index = i;
    }
    $targetElm.eq(index).focus().select();
});


/**
 * ShimeTestActionへ飛ばす
 */
function shimeShori() {
    const tr = $("#shime-table tr");
    var postData = {};
    let objRow = 0;
    var hideRow = []; //更新後、非表示にする行
    for (let i = 0; i < tr.length; i++) {
        if ($("#code_" + i).prop("checked")) {
            postData[objRow] = {
                'tokuisaki_cd': $("#tokuisaki_cd" + i).text(),
                'tokuisaki_name': $("#tokuisaki_name" + i).text(),
                'zenkai_hiduke': $("#zenkai_hiduke" + i).text(),
                'uriagegaku': $("#uriagegaku" + i).text().replace(/,/g, ''),
                'konkaigaku': $("#konkaigaku" + i).text().replace(/,/g, ''),
                'hraibi': $("#haraibi" + i).val(),
                'zenkai_seikyuugaku': $("#zenkai_seikyuugaku" + i).val(),
                'harai_saikuru_kbn_cd': $("#harai_saikuru_kbn_cd" + i).val(),
                'nyuukingaku': $("#nyuukingaku" + i).val(),
                'shouhizeigaku': $("#shouhizeigaku" + i).val(),
                'sime_hiduke': $("#fieldSimeHiduke").val(),
                'kaishuu_yoteibi': $("#fieldKaishuuYoteibi").val(),
                'shimegrp_kbn_cd': $("#fieldShimegrpKbnCd").val()
            }
            $("#code_" + i).prop("checked", false);
            hideRow.push(i);
            objRow++;
        }
    }
    $.ajax({
        url: shimeAjax,
        method: 'post',
        data: {'postData': postData},
        dataType: 'json',
        async: true,
        success: function (response) {
            console.log('Ok: ' + response);
            for (let i = 0; i < hideRow.length; i++) {
                $('#t-row' + (hideRow[i])).hide();
            }
            window.alert('締め処理が完了しました。');
            // $('#F3').trigger("click");
        },
        error: function (xhr, status, err) {
            console.log('Error: ' + xhr + ' / ' + status + ' / ' + err);
        }
    })
}


$('.tokuisaki_cd').dblclick(function() {
    var id =  $(this).attr("id");
    var id_count = id.replace(/[^0-9]/g, '');
    var tokuisaki_cd = $('#tokuisaki_cd' + id_count).text();
    var data = {
        'seikyuusaki_mr_cd': tokuisaki_cd,
        'simebi': $('#fieldSimeHiduke').val(),
    };
    var url = seikyuu_meisai;
    var form = document.createElement("form");
    form.setAttribute("action", url);
    form.setAttribute("method", "post");
    form.style.display = "none";
    form.target = "blank";
    document.body.appendChild(form);
    if (data !== undefined) {
        for (var paramName in data) {
            var input = document.createElement('input');
            input.setAttribute('type', 'hidden');
            input.setAttribute('name', paramName);
            input.setAttribute('value', data[paramName]);
            form.appendChild(input);
        }
    }
    form.submit();
});

$('.tokuisaki_cd').bind('contextmenu', function() {
    const id =  $(this).attr("id");
    const id_count = id.replace(/[^0-9]/g, '');
    const tokuisaki_cd = $('#tokuisaki_cd' + id_count).text();
    modalstart(shime_rireki, "締切履歴", tokuisaki_cd);
    return false;
});


$('#fieldShimegrpKbnCd').change(function () {
    $.ajax({
        url: getTokuisakiGroupLastShimeHiduke,
        method: 'post',
        data: { 'grp_kbn': $(this).val() },
        dataType: 'json',
        async: true,
        success: function (res) {
            $('#fieldSimeHiduke').val(res.sime_hiduke);
        },
        error: function (xhr, status, err) {
            console.log('Error: ' + xhr + ' / ' + status + ' / ' + err);
        }
    })
});
