window.onload = function() {
    //初期日付範囲
    var date = new Date();
    date .setDate(1);
    $('#fieldKikanFrom').val(getISODateTime(date));
    date.setMonth(date.getMonth() + 1);
    date.setDate(0);
    $('#fieldKikanTo').val(getISODateTime(date));
};

//Modal
function f8key() {
    if (lastfocusin === "ShouhinMrsOptions") { /* 商品コードFrom選択 */
        modalstart(shouhin_mrs_modal, "商品From選択");
    } else if (lastfocusin === "fieldKikanFrom") { /* 期間From選択 */
        open_datepicker();
    } else if (lastfocusin === "fieldKikanTo") { /* 期間To選択 */
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
    $('#iframe-body').html('<iframe src="' + url + '" width="100%" height="100%" style="border: none;">');
    $('#iframe-bg').fadeTo('normal', 0.5);
    $('#iframe-body iframe').load(function () {
        $(this).contents().find('#header, #footer').hide();
    });
    return false;
}

function fromModal(retval) {
       $('#iframe-wrap').fadeOut(
        function(){
            if (retval){
                $('#'+lastfocusin).val(retval);
                $('#'+lastfocusin).change();
            }
        }
    );
    $('#iframe-bg').fadeOut();
    $('#'+lastfocusin).focus().select();
}

$(function() {
    $("#iframe-wrap").draggable({
        handle: ".modal-header"
    });
});

function getISODateTime(d){
    var s = function(a,b){return(1e15+a+"").slice(-b)};
    if (typeof d === 'undefined'){
        d = new Date();
    }
    // return ISO datetime
    return d.getFullYear() + '-' +
        s(d.getMonth()+1,2) + '-' +
        s(d.getDate(),2) + ' '
}

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
    data.splice(1,1); //空行
    var write_opts = {
        type: 'binary'
    };
    var wb = aoa_to_workbook(data);
    var wb_out = XLSX.write(wb, write_opts);
    var blob = new Blob([s2ab(wb_out)], {type: 'application/octet-stream'});
    saveAs(blob, 'uri_shiire_hikaku.xlsx');
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