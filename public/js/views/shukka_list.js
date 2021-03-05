//初期日付範囲
window.onload = function() {
    var date = new Date();
    date .setDate(1);
    if ($('#fieldKikanFrom').val() == '') {
        $('#fieldKikanFrom').val(getISODateTime(date));
        date.setMonth(date.getMonth() + 1);
        date.setDate(0);
    }
    if ($('#fieldKikanTo').val() == '') {
        $('#fieldKikanTo').val(getISODateTime(date));
    }
};
function getISODateTime(d){
    var s = function(a,b){return(1e15+a+"").slice(-b)};
    if (typeof d === 'undefined'){
        d = new Date();
    }
    // return ISO datetime
    return d.getFullYear() + '-' +
        s(d.getMonth()+1,2) + '-' +
        s(d.getDate(),2)
}

//対象クリックで検索条件を入れる※検索はしない
$('.souko').click(function() {
    $("#souko_cd").val($(this).text());
});
//対象クリックで検索条件を入れる※検索はしない
$('.iraisaki_cd').click(function() {
    $("#iraisaki_cd").val($(this).text());
});
$('.shouhin').click(function() {
    $("#shouhin_mr_cd").val($(this).text());
});
$('.user').click(function() {
    //苗字を切り出す
    let tagetString = $(this).text();
    let separatorString = " ";
    let arrayStrig = tagetString.split(separatorString);
    let user_miyoji = arrayStrig[0];
    $("#user_mei").val(user_miyoji);
});
//伝票へ移動
$('.shukka_cd').click(function() {
    var id =  $(this).attr("id");
    var id_count = id.replace(/[^0-9]/g, '');
    var shukka_id = $('#shukka_id' + id_count).val();
    var url = shukkairai_edit + '/' + shukka_id;
    window.open(url, "_blank");
});

$('.juchuu_no').click(function() {
    let id =  $(this).attr("id");
    let id_count = id.replace(/[^0-9]/g, '');
    let juchuu_id = $('#juchuu_id' + id_count).val();
    let url = juchuu_edit + '/' + juchuu_id;
    window.open(url, "_blank");
});

$('.hacchuu_no').click(function() {
    let id =  $(this).attr("id");
    let id_count = id.replace(/[^0-9]/g, '');
    let hacchuu_id = $('#hacchuu_id' + id_count).val();
    let url = hacchuu_edit + '/' + hacchuu_id;
    window.open(url, "_blank");
});

//対象ダブルクリックで絞り込み検索
$('.iraisaki_cd').dblclick(function() {
    $("#iraisaki_cd").val($(this).text());
    $('#summary_post').submit();
});

//対象ダブルクリックで絞り込み検索
$('.shouhin').dblclick(function() {
    $("#shouhin_mr_cd").val($(this).text());
    $('#summary_post').submit();
});
$('.user').click(function() {
    //苗字を切り出す
    let tagetString = $(this).text();
    let separatorString = " ";
    let arrayStrig = tagetString.split(separatorString);
    let user_miyoji = arrayStrig[0];
    $("#user_mei").val(user_miyoji);
    $('#summary_post').submit();
});

//検索条件初期化
$('#initialize').click(function() {
    $("#iraisaki_cd").val('');
    $("#iraisaki_mei").val('');
    $("#user_mei").val('');
    $("#shouhin_mr_cd").val('');
    $("#shouhin_mei").val('');
    $("#hassousaki").val('');
    $("#urisaki").val('');
});

//クリックした行全体に背景色を適用
$('#shukka_table td').bind('click',function(){
    let tr = $(this).closest('tr')[0];
    $('#shukka_table td').removeClass('activetr');
    $('#' + tr.id + ' td').addClass('activetr');
});

/*
 *  現在の表示テーブルをExcel出力 Add BY Nishiyama 2019/11/4
 */
$('#dl-xlsx').on('click', function () {
    //Table全行列取得
    let data = [];
    let tr = $("table tr");
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
    //不要列削除
    let exe = [0, 1, 2];
    for(let i = 0; i< data.length; i++){
        for(let j =0; j < exe.length; j++){
            data[i].splice(exe[j]-j, 1);
        }
    }
    data.splice(1,2); //空行
    let write_opts = {
        type: 'binary'
    };
    let wb = aoa_to_workbook(data);
    let wb_out = XLSX.write(wb, write_opts);
    let blob = new Blob([s2ab(wb_out)], {type: 'application/octet-stream'});
    saveAs(blob, 'shukka_summary.xlsx');
});

function isNumber(val){
    var regex = new RegExp(/^[-+]?[0-9]+(\.[0-9]+)?$/);
    return regex.test(val);
}

//Sheetをbookに追加
function sheet_to_workbook(sheet/*:Worksheet*/, opts)/*:Workbook*/ {
    let n = opts && opts.sheet ? opts.sheet : "Sheet1";
    let sheets = {};
    sheets[n] = sheet;
    return {SheetNames: [n], Sheets: sheets};
}
//配列をbookに変換
function aoa_to_workbook(data/*:Array<Array<any> >*/, opts)/*:Workbook*/ {
    return sheet_to_workbook(XLSX.utils.aoa_to_sheet(data, opts), opts);
}
//stringをArrayBufferに変換
function s2ab(s) {
    let buf = new ArrayBuffer(s.length);
    let view = new Uint8Array(buf);
    for (let i = 0; i != s.length; ++i) view[i] = s.charCodeAt(i) & 0xFF;
    return buf;
}
