$("#fieldCd").change(function () { //商品マスター索引
    //alert("AAA:".$(this).attr("id")); //''の場合、'0'など1桁の場合または結果が複数の場合、結果が1個の場合、結果が0個の場合
    if ($(this).val() == '') {
        $("#fieldName").val("");
    } else {
        $.ajax({
            type: "POST",
            url: shouhin_mrs_ajaxGet,
            data: {'cd': $(this).val(),},
            async: true,
            dataType: 'json',
            success: function (data) {
                if (data.length == 0) {
                    $("#fieldName").val('>>エラー:未登録');
                } else if (data.length == 1 || $("#fieldCd").val() == data[0].cd) {
                    //選択肢をクリアしてから追加する
                    $('#ShouhinMrsOptions > option').remove();
                    for (var i = 0; i < data.length; i++) {
                        $('#ShouhinMrsOptions').append('<option value="' + data[i].cd + '">' + data[i].cd + ':' + data[i].name + '</option>');
                    }
                    $("#fieldCd").val(data[0].cd);
                    $("#fieldName").val(data[0].name);
                } else {
                    //選択肢をクリアしてから追加する
                    $('#ShouhinMrsOptions > option').remove();
                    for (var i = 0; i < data.length; i++) {
                        $('#ShouhinMrsOptions').append('<option value="' + data[i].cd + '">' + data[i].cd + ':' + data[i].name + '</option>');
                    }
                    $("#fieldName").val('>>エラー:未登録');
                    $("#fieldCd").focus().select();
                }
            },
            error: function (xhr, status, err) {
                console.log(xhr);
                $("#fieldName").val('>エラー' + status + '/' + err);
            },
        });
    }
});

$("#fieldSoukoMrCd").change(function () { //倉庫マスター索引2019/02/16追加…井浦
    //alert("AAA:".$(this).attr("id")); //''の場合、'0'など1桁の場合または結果が複数の場合、結果が1個の場合、結果が0個の場合
    if ($(this).val() == '') {
        $("#fieldSoukoName").val("");
    } else {
        $.ajax({
            type: "POST",
            url: souko_mrs_ajaxGet,
            data: {'cd': $(this).val(),},
            async: true,
            dataType: 'json',
            success: function (data) {
                if (data.length == 0) {
                    $("#fieldSoukoName").val('>>エラー:未登録');
                } else if (data.length == 1 || $("#fieldSoukoMrCd").val() == data[0].cd) {
                    //選択肢をクリアしてから追加する
                    $('#SoukoMrsOptions > option').remove();
                    for (var i = 0; i < data.length; i++) {
                        $('#SoukoMrsOptions').append('<option value="' + data[i].cd + '">' + data[i].cd + ':' + data[i].name + '</option>');
                    }
                    $("#fieldSoukoMrCd").val(data[0].cd);
                    $("#fieldSoukoName").val(data[0].name);
                } else {
                    //選択肢をクリアしてから追加する
                    $('#SoukoMrsOptions > option').remove();
                    for (var i = 0; i < data.length; i++) {
                        $('#SoukoMrsOptions').append('<option value="' + data[i].cd + '">' + data[i].cd + ':' + data[i].name + '</option>');
                    }
                    $("#fieldSoukoName").val('>>エラー:未登録');
                    $("#fieldSoukoMrCd").focus().select();
                }
            },
            error: function (xhr, status, err) {
                $("#fieldSoukoName").val('>エラー' + status + '/' + err);
            },
        });
    }
});

/* 月度をクリックするとその月の明細を表示に変える */
$(".zoom_meisai").click(function () {
    $("#hiddenCd").val($("#fieldCd").val());
    $("#hiddenKikanFrom").val($(this).next().text());
    $("#hiddenKikanTo").val($(this).nextAll().eq(1).text());
    $("#hiddenHyoujiFlg").val(1);
    $("#hidden_form").submit();
});

/* モーダルダイヤログ部分 */
function f8key() {
    if (lastfocusin == "fieldCd") { /* 商品コード選択 */
        modalstart(shouhin_mrs_modal, "商品選択");
    } else if (lastfocusin == "fieldSoukoMrCd") { /* 倉庫選択2019/02/16追加…井浦 */
        modalstart(souko_mrs_modal, "倉庫選択");
    } else if (lastfocusin == "fieldKikanFrom") { /* 期間自選択 */
        open_datepicker();
    } else if (lastfocusin == "fieldKikanTo") { /* 期間至選択 */
        open_datepicker();
    }
}

//Add by Nishiyama 2019/2/12
$(".zoom_nyuushukko_name").click(function () {
    var souko = $('#fieldSoukoMrCd').val();
    if (souko === '') {
        window.alert('倉庫名が選択されていません。');
        return;
    }
    var lot = $(this).text();
    var scode = $('#fieldCd').val();
    console.log(scode);
    console.log(lot);
    console.log(souko);
    modalstart1(lot_zaiko_modal, "個別ロット在庫表", "?cd=" + scode + '&souko_mr_cd=' + souko + '&lot=' + lot);
});

//Add By Nishiyama 2019/2/13
function modalstart1(url, title, para, scode, souko, lot) {
    $('#iframe-title').text(title);
    $('#iframe-wrap').fadeIn();
    if (!para) {
        para = '?cd=' + scode + '&soukocd' + souko + '&lot' + lot;
    }
    console.log(url + para);
    $('#iframe-body').html('<iframe src="' + url + para + '" width="100%" height="100%" style="border: none;" name="iframe1">');
    $('#iframe-bg').fadeTo('normal', 0.5);
    $('#iframe-body iframe').load(function () {
        $(this).contents().find('#header, #footer').hide();
    });
    return false;
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
$("#fieldHyoujiFlg").change(function () { //表示フラグが変更されたら
    if ($(this).val() !== "1") {
        $("#fieldKikanFrom").val("2018-11-01"); //
    }
});

$(function () { // テーブルのヘッドを消えなくする
    $('table.head_fix').floatThead({
        top: 50
    });
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
    var tmp = ["", "",]; //テーブル間のスペース
    //入出庫明細の見出しが欠落する為
    var midashi = [[
        ["伝票日付"], ["伝票番号"], ["取引区分"], ["内訳"], ["ロット"], ["色番"], ["色・識別"], ["品質"], ["備考"], ["仕入単価"],
        ["単価単位"], ["入庫数"], [""], ["入庫量"], ["単"], ["出庫数"], ["単"], ["出庫量"], ["単"], ["在庫数"], [""], ["在庫量"], [""],
        ["預り受入"], ["預り払い出し"], ["預り残量"], ["取引先名"], ["倉庫名"],
    ]];
    //3つのテーブルをそれぞれ配列として取得し、マージする
    var data = [];
    var tr = $("#table1 tr");
    for (let i = 0, l = tr.length; i < l; i++) {
        let cells = tr.eq(i).children();
        for (let j = 0, m = cells.length; j < m; j++) {
            if (typeof data[i] == "undefined")
                data[i] = [];
            if (!isNumber(cells.eq(j).text().replace(/,/g, ''))) {
                data[i][j] = cells.eq(j).text();
            } else {
                data[i][j] = cells.eq(j).text().replace(/,/g, '') * 1;
            }
        }
    }
    data = data.concat(tmp);
    var tr2 = $("#table2 tr");
    var data2 = [];
    for (let i = 0, l = tr2.length; i < l; i++) {
        let cells = tr2.eq(i).children();
        for (let j = 0, m = cells.length; j < m; j++) {
            if (typeof data2[i] == "undefined")
                data2[i] = [];
            if (!isNumber(cells.eq(j).text().replace(/,/g, ''))) {
                data2[i][j] = cells.eq(j).text();
            } else {
                data2[i][j] = cells.eq(j).text().replace(/,/g, '') * 1;
            }
        }
    }
    //data2.splice(1, 1); //空行
    data = data.concat(data2);
    data = data.concat(tmp);
    var tr3 = $("#table3 tr");
    var data3 = [];
    for (let i = 0, l = tr3.length; i < l; i++) {
        let cells = tr3.eq(i).children();
        for (let j = 0, m = cells.length; j < m; j++) {
            if (typeof data3[i] == "undefined")
                data3[i] = [];
            if (!isNumber(cells.eq(j).text().replace(/,/g, ''))) {
                data3[i][j] = cells.eq(j).text();
            } else {
                data3[i][j] = cells.eq(j).text().replace(/,/g, '') * 1;
            }
            if (j === 0) {
                if (cells.eq(j).text() !== '') {
                    //jsのDateオブジェクトは1日マイナスされるので1日加算して出力
                    var new_date = new Date(cells.eq(j).text().replace(/-/g, '/'));
                    new_date.setDate(new_date.getDate() + 1)
                    data3[i][j] = new_date;
                }
            }
        }
    }
    data3.splice(0, 1);
    data = data.concat(midashi);
    data = data.concat(data3);

    var write_opts = {
        type: 'binary'
    };
    var wb = aoa_to_workbook(data);
    var wb_out = XLSX.write(wb, write_opts);
    var blob = new Blob([s2ab(wb_out)], {type: 'application/octet-stream'});
    saveAs(blob, $('#fieldCd').val() + '-' + $('#fieldName').val() + '.xlsx');
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

$('#fieldKikanFrom').click(function () {
    $(this).select();
})

$('#fieldKikanTo').click(function () {
    $(this).select();
})