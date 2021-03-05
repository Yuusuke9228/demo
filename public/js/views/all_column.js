//対象クリックで検索条件を入れる※検索はしない
$('.souko').click(function() {
    $("#souko_cd").val($(this).text());
    $('input[name="souko_group"]').prop("checked",true);
});

$('.shouhin').click(function() {
    $("#shouhin_cd").val($(this).text());
    $('input[name="shouhin_group"]').prop("checked",true);
    $('input[name="lot_group"]').prop("checked",true);
    $('input[name="iro_group"]').prop("checked",true);
    $('input[name="kobetsucd_group"]').prop("checked",true);
    $('input[name="hinsitsu_group"]').prop("checked",true);
});
$('.tantou').click(function() {
    $("#tantou_cd_from").val($(this).text());
    $('input[name="tantou_group"]').prop("checked",true);
});
$('.lot').click(function() {
    $("#lot_from").val($(this).text());
    $('input[name="lot_group"]').prop("checked",true);
});
$('.iro').click(function() {
    $("#iro_from").val($(this).text());
    $('input[name="iro_group"]').prop("checked",true);
});
$('.kobetucd').click(function() {
    $("#kobetucd_from").val($(this).text());
    $('input[name="kobetsucd_group"]').prop("checked",true);
});
$('.hinshitu_name').click(function() {
    $("#hinshitu_from").val($(this).text());
    $('input[name="hinsitsu_group"]').prop("checked",true);
});
//対象ダブルクリックで絞り込み検索
$('.souko').dblclick(function() {
    $("#souko_cd").val($(this).text());
    console.log($(this).text());
    $('input[name="shouhin_group"]').prop("checked",true);
    $('#all_column_zaiko_post').submit();
});

$('.shouhin').dblclick(function() {
    $("#shouhin_cd").val($(this).text());
    console.log($(this).text());
    $("#souko_cd").val('');
    $('input[name="shouhin_group"]').prop("checked",true);
    $('input[name="lot_group"]').prop("checked",true);
    $('input[name="iro_group"]').prop("checked",true);
    $('input[name="kobetsucd_group"]').prop("checked",true);
    $('input[name="hinsitsu_group"]').prop("checked",true);
    $('#all_column_zaiko_post').submit();
});

//入出庫へ移動(対象商品対象倉庫)
$('.rowno').click(function() {
    id = $(this).text();
    souko = $('#souko' + id).text();
    shouhin = $('#shouhin' + id).text();
    $("#nyuushukkoCd").val(shouhin);
    $("#nyuushukkoSoukoMrCd").val(souko);
    $("#nyuushukko_post").submit();
});
//検索条件初期化（倉庫グルーピング検索)
$('#initialize').click(function() {
    $("#souko_cd").val('');
    $("#souko_name_from").val('');
    $("#tantou_cd_from").val('');
    $("#tantou_name_from").val('');
    $("#shouhin_cd").val('');
    $("#shouhin_name_from").val('');
    $("#lot_from").val('');
    $("#iro_from").val('');
    $("#iromei_from").val('');
    $("#kobetucd_from").val('');
    $("#hinshitu_from").val('');
    $("#zaiko1_from").val('');
    $("#zaiko2_from").val('');
    $('input[name="souko_group"]').prop("checked",true);
    $('input[name="tantou_group"]').prop("checked",false);
    $('input[name="shouhin_group"]').prop("checked",false);
    $('input[name="lot_group"]').prop("checked",false);
    $('input[name="iro_group"]').prop("checked",false);
    $('input[name="kobetsucd_group"]').prop("checked",false);
    $('input[name="hinsitsu_group"]').prop("checked",false);
    $('#all_column_zaiko_post').submit();
});

$("#zaiko1_from").change(function() {
    if ($(this).val() == '') { return; }
    var pattern = /^[-]?([1-9]\d*|0)(\.\d+)?$/;
    if ($(this).val().search(pattern)) {
        window.alert('在庫数は、数値のみ入力してください。');
        $(this).val('');
    }
});
$("#zaiko2_from").change(function() {
    if ($(this).val() == '') { return; }
    var pattern = /^[-]?([1-9]\d*|0)(\.\d+)?$/;
    if ($(this).val().search(pattern)) {
        window.alert('在庫量は、数値のみ入力してください。');
        $(this).val('');
    }
});

//右クリックした商品コードと名称をsubimit用formに乗せ、submit
$(function() {
    $(".shouhin").bind('contextmenu', function() {
        modalstart(shouhin_lot_modal,"全倉庫選択商品在庫",$(this).text(),$(this).next('td').text())
        return false;
    });
});

$('#iframe-wrap button').click(function () { /* 中止して終わる (X) */
    $('#iframe-bg, #iframe-wrap').fadeOut();
});

function modalstart(url,title,shouhin_cd,shouhin_name) {
    $('#iframe-title').text(title);
    $('#iframe-wrap').fadeIn();
    $('#iframe-body').html('<iframe src="' + url + '?cd=' + shouhin_cd + '&name=' + shouhin_name + '" width="100%" height="100%" style="border: none;">');
    $('#iframe-bg').fadeTo('normal', 0.5);
    $('#iframe-body iframe').load(function () {
        $(this).contents().find('#header, #footer').hide();
    });
    return false;
}


/*
 *  現在の表示テーブルをExcel出力 Add BY Nishiyama 2019/11/7
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
    //不要列削除
    var exe = [0, 1];
    for(var i = 0; i< data.length; i++){
        for(var j = 0; j < exe.length; j++){
            data[i].splice(exe[j]-j, 1);
        }
    }
    data.splice(1,2); //空行
    var write_opts = {
        type: 'binary'
    };
    var wb = aoa_to_workbook(data);
    var wb_out = XLSX.write(wb, write_opts);
    var blob = new Blob([s2ab(wb_out)], {type: 'application/octet-stream'});
    saveAs(blob, 'zaiko_data_table.xlsx');
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