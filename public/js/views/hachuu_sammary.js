//初期日付範囲
window.onload = function () {
    var date = new Date();
    date.setDate(1);
    if ($('#fieldKikanFrom').val() == '') {
        $('#fieldKikanFrom').val(getISODateTime(date));
        date.setMonth(date.getMonth() + 1);
        date.setDate(0);
    }
    if ($('#fieldKikanTo').val() == '') {
        $('#fieldKikanTo').val(getISODateTime(date));
    }
};

function getISODateTime(d) {
    var s = function (a, b) {
        return (1e15 + a + "").slice(-b)
    };
    if (typeof d === 'undefined') {
        d = new Date();
    }
    // return ISO datetime
    return d.getFullYear() + '-' +
        s(d.getMonth() + 1, 2) + '-' +
        s(d.getDate(), 2)
}

//対象クリックで検索条件を入れる※検索はしない
$('.souko').click(function () {
    $("#souko_cd").val($(this).text());
});
//対象クリックで検索条件を入れる※検索はしない
$('.shiiresaki').click(function () {
    $("#shiire_cd").val($(this).text());
});
//対象クリックで検索条件を入れる※検索はしない
$('.shouhin').click(function () {
    $("#shouhin_cd").val($(this).text());
});
//伝票へ移動
$('.shiire_no').click(function () {
    var id = $(this).attr("id");
    var id_count = id.replace(/[^0-9]/g, '');
    var shiire_id = $('#shiire_id' + id_count).val();
    var url = shiire_edit + '/' + shiire_id;
    window.open(url, "_blank");
});
//伝票へ移動
$('.hacchuu_no').click(function () {
    var id = $(this).attr("id");
    var id_count = id.replace(/[^0-9]/g, '');
    var hacchuu_id = $('#hacchuu_id' + id_count).val();
    var url = hacchuu_edit + '/' + hacchuu_id;
    window.open(url, "_blank");
});
//対象ダブルクリックで絞り込み検索
$('.shiiresaki').dblclick(function () {
    $("#shiire_cd").val($(this).text());
    $('#summary_post').submit();
});
//対象ダブルクリックで絞り込み検索
$('.souko').dblclick(function () {
    $("#souko_cd").val($(this).text());
    $('#summary_post').submit();
});
//対象ダブルクリックで絞り込み検索
$('.shouhin').dblclick(function () {
    $("#shouhin_cd").val($(this).text());
    $('#summary_post').submit();
});
//検索条件初期化
$('#initialize').click(function () {
    $("#shiire_cd").val('');
    $("#shiire_name").val('');
    $("#souko_cd").val('');
    $("#souko_name").val('');
    $("#shouhin_cd").val('');
    $("#shouhin_name").val('');
    $("#hacchuubi").val('');
    $("#nouki").val('');
    $("#kannryou_cd").val('');
    $('#summary_post').submit();
});
//対象発注番号の仕入明細表示
$(function () {
    $('.shiire_no').bind('contextmenu', function () {
        var id = $(this).attr("id");
        var id_count = id.replace(/[^0-9]/g, '');
        modalstart(hacchuu_shiire_list, "対象仕入明細", $('#hacchuu_id' + id_count).val(), $('#shouhin' + id_count).text(), $('#iro' + id_count).text(), $('#souko' + id_count).text());
        return false;
    });
});
$('#iframe-wrap button').click(function () { /* 中止して終わる (X) */
    $('#iframe-bg, #iframe-wrap').fadeOut();
});

function modalstart(url, title, hacchuu_id, shouhin_cd, iro, souko_cd) {
    console.log(iro);
    $('#iframe-title').text(title);
    $('#iframe-wrap').fadeIn();
    $('#iframe-body').html('<iframe src="' + url + '?hacchuu_id=' + hacchuu_id + '&shouhin_mr_cd=' + shouhin_cd + '&iro=' + iro + '&souko_cd=' + souko_cd + '" width="100%" height="100%" style="border: none;">');
    $('#iframe-bg').fadeTo('normal', 0.5);
    $('#iframe-body iframe').load(function () {
        $(this).contents().find('#header, #footer').hide();
    });
    return false;
}

//クリックした行全体に背景色を適用
$('#hacchuu_table td').bind('click', function () {
    var tr = $(this).closest('tr')[0];
    $('#hacchuu_table td').removeClass('activetr');
    $('#' + tr.id + ' td').addClass('activetr');
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
    //不要列削除
    var exe = [0, 1];
    for (var i = 0; i < data.length; i++) {
        for (var j = 0; j < exe.length; j++) {
            data[i].splice(exe[j] - j, 1);
        }
    }
    data.splice(1, 2); //空行
    var write_opts = {
        type: 'binary'
    };
    var wb = aoa_to_workbook(data);
    var wb_out = XLSX.write(wb, write_opts);
    var blob = new Blob([s2ab(wb_out)], {type: 'application/octet-stream'});
    saveAs(blob, 'hacchuu_summary.xlsx');
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


//入荷区分ダブルクリックで完了・未完了の切替
$(function () {
    $('.nyuukakbn').bind('dblclick', function () {
        var id = $(this).attr("id");
        var id_count = id.replace(/[^0-9]/g, '');
        var shiire_dt_id = $('#shiire_id' + id_count).val();
        var shouhin_mr_cd = $('#shouhin' + id_count).text();
        var iro = $('#iro' + id_count).text();
        var zansuu = $('#zansuu' + id_count).text();
        var zanryou = $('#zanryou' + id_count).text();
        var nyuuka_kbn = "";
        if (shiire_dt_id === '') {
            window.alert('この発注には仕入が紐づいていません。');
            return false;
        }
        if (parseFloat(zansuu) !== 0 || parseFloat(zanryou) !== 0.00) {
            window.alert('発注残数があるので変更できません。');
            return false;
        }
        var result = window.confirm('入荷区分を変更しますか?');
        if (!result) {
            return false;
        }
        if ($(this).text() === '完') {
            nyuuka_kbn = 'NULL';
        } else {
            nyuuka_kbn = '5';
        }
        row_data = {'shiire_dt_id': shiire_dt_id, 'shouhin_mr_cd': shouhin_mr_cd, 'iro': iro, 'nyuuka_kbn': nyuuka_kbn};
        $.ajax({
            url: hacchuu_save_ajax,
            dataType: "json",
            type: "POST",
            data: row_data,
            success: function (res) {
                if (nyuuka_kbn === '5') {
                    $('#nyuukakbn_id' + id_count).text('完');
                } else {
                    $('#nyuukakbn_id' + id_count).text('');
                }
                console.log(res);       //更新したidを確認用の返却値として受け取る。
                console.log("updated!!");
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                window.alert('Error:' + textStatus);
            }
        });
        return false;
    });
});

$('#fieldKikanFrom').click(function () {
    $(this).select();
})

$('#fieldKikanTo').click(function () {
    $(this).select();
})