$('#fieldCd').change(function () { //条件売上順位を索引
    $.ajax({
        type: "POST",
        url: jouken_uriage_ajaxGet,
        data: {'cd': $(this).val(),},
        async: true,
        dataType: 'json',
        success: function (data) {
        	console.log(data);
            if (data.length == 0) {
                alert('>>エラー:条件未登録');
            } else {
                for (var i in jouken_flds) {
                    if (jouken_flds[i] != "kikan_sitei_kbn_cd" && jouken_flds[i] != "kikan_from" && jouken_flds[i] != "kikan_to") {
                        $("[name=" + jouken_flds[i] + "]").val(data[0][jouken_flds[i]]);
                    }
                }
                if (data[0].kikan_sitei_kbn_cd != 0 && data[0].simekiri_kbn == "0") {
                    $("[name='kikan_sitei_kbn_cd']").val(data[0].kikan_sitei_kbn_cd);
                    if (data[0].kikan_from != "0000-00-00") {
                        $("[name='kikan_from']").val(data[0].kikan_from);
                    }
                    if (data[0].kikan_to != "0000-00-00") {
                        $("[name='kikan_to']").val(data[0].kikan_to);
                    }
                    $("[name='kikan_sitei_kbn_cd']").change();
                }
                if ($("[name='hanni_from']").val() == "") {
                    $("[name='junjo_kbn_cd']").change();
                }
            }
        },
        error: function (xhr, status, err) {
            alert('>エラー1:' + status + '/' + err);
        },
    });
});

window.onload = function() {
	$('#fieldKikanSiteiKbnCd').val('1507');
	$('#fieldKikanSiteiKbnCd').change();
}

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
			if (data.kikan_to != "0000-00-00") {
                $("[name='kikan_to']").val(data.kikan_to)
            }
		},
        error: function (xhr, status, err) {
            alert('>エラー2:' + status + '/' + err);
        },
    });
});

/* モーダルダイヤログ部分 */
function f8key() {
    if (lastfocusin == "fieldCd") { /* 条件名選択 */
        modalstart(jouken_uriage_modal); //条件設定画面を表示
    } else if (lastfocusin == "fieldKikanFrom") { /* 期間自選択 */
        open_datepicker();
    } else if (lastfocusin == "fieldKikanTo") { /* 期間至選択 */
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

function modalstart(url) {
    $('#iframe-wrap').fadeIn();
    $('#iframe-body').html('<iframe src="' + url + '" width="100%" height="100%" style="border: none;">');
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
    $("[name='kikan_from']").attr('readonly', 1 * $(this).val() != 0); // 0:期間指定ならfalse（入力可）
    $("[name='kikan_to']").attr('readonly', 1 * $(this).val() != 0); // 0:期間指定ならfalse（入力可）
});

$("#fieldKikanFrom").change(function () { //期間からが変更されたら
    $("[name='kikan_sitei_kbn_cd']").val($("[name='kikan_sitei_kbn_cd']").val().substr(0, 2) + '19'); // 1213:任意の期間
});

$("#fieldKikanTo").change(function () { //期間からが変更されたら
    $("[name='kikan_sitei_kbn_cd']").val($("[name='kikan_sitei_kbn_cd']").val().substr(0, 2) + '19'); // 1213:任意の期間
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

/* 横見出をクリックするとその明細表示を呼ぶ */
$(".zoom_meisai").click(function () {
    $("#zoom_meisai_kikan_from").val($(this).text());
    $("#zoom_meisai_kikan_to").val($(this).text());
    $("#zoom_meisai_post").submit();
});

$('table tbody tr').click(function () { // クリックした行を目立たせる。table-stripedと共存できない
    $('tr').removeClass('activetr');
    $(this).addClass('activetr');
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
            if (!isNumber(cells.eq(j).text().replace(/,/g, ''))) {
                data[i][j] = cells.eq(j).text();
            } else {
                data[i][j] = cells.eq(j).text().replace(/,/g, '') * 1;
            }
        }
    }
    data.splice(2, 1); //空行
    var write_opts = {
        type: 'binary'
    };
    var wb = aoa_to_workbook(data);
    var wb_out = XLSX.write(wb, write_opts);
    var blob = new Blob([s2ab(wb_out)], {type: 'application/octet-stream'});
    saveAs(blob, 'uriage_junis.xlsx');
    return false;
});

function isNumber(val){
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