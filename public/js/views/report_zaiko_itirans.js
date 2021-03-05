var jouken_flds = [
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
    "kikan_tuki",
    "zaiko0_flg",
    "torihikiari_flg",
    "torihikinasi_flg",
    "meisaigyou_flg",
    "soukohyouji_flg",
    "goukeigyou_flg",
];

$('#fieldCd').change(function () { //条件在庫一覧を索引
    $.ajax({
        type: "POST",
        url: jouken_zaiko_itirans_ajaxGet,
        data: {'cd': $(this).val(),},
        async: true,
        dataType: 'json',
        success: function (data) {
            if (data.length == 0) {
                alert('>>エラー:条件未登録');
            } else {
                for (var i in jouken_flds) {
                    if (jouken_flds[i] != "cd" && jouken_flds[i] != "kikan_tuki") {
                        $("[name=" + jouken_flds[i] + "]").val(data[0][jouken_flds[i]]);
                    }
                }
                if (data[0].kikan_tuki != "0000-00-00") {
                    $("[name='kikan_tuki']").val(data[0].kikan_tuki);
                }
            }
        },
        error: function (xhr, status, err) {
            alert('>エラー1:' + status + '/' + err);
        },
    });
});

/* 商品コードをクリックするとその明細表示を呼ぶ */
$(".zoom_nyuushukko").click(function () {
    $("#nyuushukkoCd").val($(this).text());
    $("#nyuushukkoSoukoMrCd").val($(this).next('td').find('.souko_mr_cd').text()); // 倉庫絞り込み状態で明細表示2019/02/18追加　井浦
    $("#nyuushukko_post").submit();
});

/* 商品名クリック 明細表示 Add By Nishiyama 2018/11/27
*/
$(".zoom_nyuushukko_name").click(function () {
    $("#nyuushukkoCd").val($(this).prev('td').text());
    $("#nyuushukkoSoukoMrCd").val($(this).find('.souko_mr_cd').text()); // 倉庫絞り込み状態で明細表示2019/02/18追加　井浦
    $("#nyuushukko_post").submit();
});

//Add By Nishiyama 2019/3/14
$(".souko").click(function () {
    var soukoCd = $(this).text();
    var soukoId = $(this).attr('id');
    var sid = document.getElementById('sid' + soukoId);
    modalstart1(lot_summary_modal, "個別ロット在庫表", "?cd=" + sid.innerText + '&souko_mr_cd=' + soukoCd);
});

$(".souko").bind('contextmenu', function () {
    var soukoCd = $(this).text();
    var soukoId = $(this).attr('id');
    var sid = document.getElementById('sid' + soukoId);
    modalstart1(lot_zaiko_modal, "個別ロット出入表", "?cd=" + sid.innerText + '&souko_mr_cd=' + soukoCd);
    return false;
});
//=============================================

/* モーダルダイヤログ部分 */
function f8key() {
    if (lastfocusin == "fieldCd") { /* 条件名選択 */
        modalstart(jouken_zaiko_itirans_modal, "在庫一覧条件設定"); //条件設定画面を表示
    } else if (lastfocusin == "fieldKikanTuki") { /* 期間月選択 */
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

//Add By Nishiyama 2019/2/4
function modalstart1(url, title, para, scode, souko) {
    $('#iframe-title').text(title);
    $('#iframe-wrap').fadeIn();
    if (!para) {
        para = '?cd=' + scode + '&soukocd' + souko;
    }
    console.log(url + para);
    $('#iframe-body').html('<iframe src="' + url + para + '" width="100%" height="100%" style="border: none;" name="iframe1">');
    $('#iframe-bg').fadeTo('normal', 0.5);
    $('#iframe-body iframe').load(function () {
        $(this).contents().find('#header, #footer').hide();
    });
    //document.iframe1form.submit();
    return false;
}

$('#iframe-wrap button').click(function () { /* 中止して終わる (X) */
    $('#iframe-bg, #iframe-wrap').fadeOut();
});

function fromModal(retval) {
    //alert('親ページの関数が実行されました。');
    $('#iframe-wrap').fadeOut(
        function () {//alert("フェードアウト完了")
        }
    );
    $('#iframe-bg').fadeOut();
    $('#' + lastfocusin).focus().select();
    if (retval) {
        document.form_jouken.submit();
    }
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
    $("[name='kikan_sitei_kbn_cd']").val($("[name='kikan_sitei_kbn_cd']").val().substr(0, 2) + '13'); // 1213:任意の期間
});

$("#fieldKikanTo").change(function () { //期間からが変更されたら
    $("[name='kikan_sitei_kbn_cd']").val($("[name='kikan_sitei_kbn_cd']").val().substr(0, 2) + '13'); // 1213:任意の期間
});

$('#junjo_kbn_cd').change(function () { //順序区分コード
    if ($(this).val().substr(-2) == "01" || $(this).val().substr(-2) == "02") {
        return;
    }
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
            alert('>エラー3:' + status + '/' + err);
        },
    });
});

/*
 *  現在の表示テーブルをExcel出力 Add BY Nishiyama 2019/11/4
 */
$('#dl-xlsx').on('click', function () {
    //Table全行列取得
    var data = [];
    var tr = $("table tr");
    for (var i = 0, l = tr.length; i < l; i++) {
        var cells = tr.eq(i).children();
        for (var j = 0, m = cells.length; j < m; j++) {
            if (typeof data[i] == "undefined")
                data[i] = [];
            //何故か改行文字が入るため対策
            buff = cells.eq(j).text().replace(/,/g, '');
            buff = buff.replace(/\r?\n/g, '');
            if (!isNumber(parseFloat(buff))) {
                data[i][j] = cells.eq(j).text().trim();
            } else {
                if (buff.indexOf('/') != -1 || buff.indexOf('+') != -1) {
                    data[i][j] = cells.eq(j).text();
                } else {
                    data[i][j] = parseFloat(buff);
                }
            }
            buff = "";
        }
    }
    data.splice(1, 1); //空行

    var write_opts = {
        type: 'binary'
    };
    var wb = aoa_to_workbook(data);
    var wb_out = XLSX.write(wb, write_opts);
    var blob = new Blob([s2ab(wb_out)], {type: 'application/octet-stream'});
    saveAs(blob, 'zaiko_kakunin.xlsx');
    return false;
});

function isNumber(val) {
    var regex = new RegExp(/^[-+]?[0-9]+(\.[0-9]+)?$/);
    return regex.test(val);
}

//Sheetをbookに追加
function sheet_to_workbook(sheet/*:Worksheet*/, opts)/*:Workbook*/ {
    var n = opts && opts.sheet ? opts.sheet : "Sheet1";
    var sheets = {};
    sheets[n] = sheet;
    return {SheetNames: [n], Sheets: sheets};
}

//配列をbookに変換
function aoa_to_workbook(data/*:Array<Array<any> >*/, opts)/*:Workbook*/ {
    return sheet_to_workbook(XLSX.utils.aoa_to_sheet(data, opts), opts);
}

//stringをArrayBufferに変換
function s2ab(s) {
    var buf = new ArrayBuffer(s.length);
    var view = new Uint8Array(buf);
    for (var i = 0; i != s.length; ++i) view[i] = s.charCodeAt(i) & 0xFF;
    return buf;
}

//=================================================================================

$(function () { // テーブルのヘッドを消えなくする
    $('table.head_fix').floatThead({
        top: 50
    });
});

$('table tbody tr').click(function () { // クリックした行を目立たせる。table-stripedと共存できない
    $('tr').removeClass('activetr');
    $(this).addClass('activetr');
});

$('#fieldKikanTuki').click(function () {
    $(this).select();
})