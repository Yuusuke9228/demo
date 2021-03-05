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


/* 画面内計算 */
$(':checkbox').change(function () { //チェックボックスが変更されたら
    var thisChk = this;
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
    $targetElm.eq(index).focus().select();
});

$('#PgUp').click(function () {
    var index = $targetElm.index($("#" + lastfocusin));
    for (i = index - 1; i >= 0 && (!$targetElm.eq(i).isVisible() || typeof ($targetElm.eq(i).attr("id")) == "undefined" || $targetElm.eq(i).attr("name").substr(0, 5) != "code_"); i--) {
    }
    if (i >= 0) {
        index = i;
    }
    $targetElm.eq(index).focus().select();
});

$('#PgDn').click(function () {
    var index = $targetElm.index($("#" + lastfocusin));
    for (i = index + 1; i <= $targetElm.length && (!$targetElm.eq(i).isVisible() || typeof ($targetElm.eq(i).attr("id")) == "undefined" || $targetElm.eq(i).attr("name").substr(0, 5) != "code_"); i++) {
    }
    if (i <= $targetElm.length) {
        index = i;
    }
    $targetElm.eq(index).focus().select();
});

// 印刷
$(function () {
    $('#dl-xlsx').on('click', function () {
        const len = $("#meisai tbody").children().length;
        let shuukei_tanni = $('#fieldShuukeiTanni').val();
        let seikyuusaki_mr_cds = [];
        let simebis = [];
        let seikyuusho_bangous = [];
        document.getElementById('wait_msg').style.display='block';
        document.getElementById('wait_msg').style.backgroundColor='pink';

        for (let i = 0; i <= len - 1; i++) {
            if ($('#print_flg' + i).prop('checked')) {
                seikyuusaki_mr_cds.push($('#tokuisaki_mr_cd_' + i).text());
                simebis.push($('#sime_hiduke_' + i).text());
                seikyuusho_bangous.push($('#cd_' + i).text());
            }
        }
        $.ajax({
            url: ajaxStart,
            data: {seikyuusaki_mr_cds: seikyuusaki_mr_cds, simebis: simebis, seikyuusho_bangous: seikyuusho_bangous, shuukei_tanni: shuukei_tanni},
            method: 'post',
            dataType: 'json',
            async: true,
            success: data => {
                console.log(data);
                document.getElementById('wait_msg').style.display='none';
                console.log('http://192.168.11.199/smm' + data);
                let link = 'http://192.168.11.199/smm' + data;

                // pdfWindow = window.open('http://192.168.11.199/smm' + data, 'pdf');
                $('#download').append("<a href='" + link + "' class='btn btn-info' style='' target='_blank'>請求明細書のDownload</a>");
                // pdfWindow.focus();
                window.alert('処理が完了しました。');
                // pdfWindow.print(); // タイミング合わなくて無理
            },
            error: err => {
                document.getElementById('wait_msg').style.display='none';
                console.log(err.message);
            }
        })
    });
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
})