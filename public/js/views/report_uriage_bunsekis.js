// window.onload=function() {
//     $('#fieldKikanSiteiKbnCd').val('1507'); //今月度
//     $('#fieldKikanSiteiKbnCd').change();
// }

$('#fieldCd').change(function () { //条件売上分析を索引
    $.ajax({
        type: "POST",
        url: jouken_uriage_bunsekis_ajaxGet,
        data: {'cd': $(this).val(),},
        async: true,
        dataType: 'json',
        success: function (data) {
            if (data.length === 0) {
                alert('Error::Cd_Change: 条件未登録');
            } else {
                for (var i in jouken_flds) {
                    if (jouken_flds[i] !== "kikan_sitei_kbn_cd" && jouken_flds[i] !== "kikan_from" && jouken_flds[i] !== "kikan_to") {
                        $("[name=" + jouken_flds[i] + "]").val(data[0][jouken_flds[i]]);
                    }
                }
                if (data[0].kikan_sitei_kbn_cd !== '0') {
                    $("[name='kikan_sitei_kbn_cd']").val(data[0].kikan_sitei_kbn_cd);
                    if (data[0].kikan_from !== "0000-00-00") {
                        $("[name='kikan_from']").val(data[0].kikan_from);
                    }
                    if (data[0].kikan_to !== "0000-00-00") {
                        $("[name='kikan_to']").val(data[0].kikan_to);
                    }
                    $("[name='kikan_sitei_kbn_cd']").change();
                }
                if ($("[name='hanni_from']").val() === '') {
                    $("[name='junjo_kbn_cd']").change();
                }
            }
        },
        error: function (xhr, status, err) {
            alert('Error::Cd_Change: ' + status + '/' + err);
        },
    });
});

$('#fieldKikanSiteiKbnCd').change(function () {
    $.ajax({
        type: "POST",
        url: kikan_sitei_kbns_ajaxGet,
        data: {'cd': $(this).val(),},
        async: true,
        dataType: 'json',
        success: function (data) {
            if (data.kikan_from !== "0000-00-00") {
                $("[name='kikan_from']").val(data.kikan_from)
            }
            if (data.kikan_to !== "0000-00-00") {
                $("[name='kikan_to']").val(data.kikan_to)
            }
        },
        error: function (xhr, status, err) {
            alert('Error::KikanSiteiKbnCd_Change: ' + status + '/' + err);
        },
    });
});

function f8key() {
    if (lastfocusin === "fieldCd") {
        modalstart(jouken_uriage_modal);
    } else if (lastfocusin === "fieldKikanFrom") {
        open_datepicker();
    } else if (lastfocusin === "fieldKikanTo") {
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
        function () {
        }
    );
    $('#iframe-bg').fadeOut();
    $('#' + lastfocusin).focus().select();
    if (retval) {
        document.form_jouken.submit();
    }
}

$(function () {
    $("#iframe-wrap").draggable({
        handle: ".modal-header"
    });
});

$("#fieldKikanFrom").change(function () { //期間からが変更されたら
    $("[name='kikan_sitei_kbn_cd']").val($("[name='kikan_sitei_kbn_cd']").val().substr(0, 2) + '19'); // 1213:任意の期間
});

$("#fieldKikanTo").change(function () { //期間からが変更されたら
    $("[name='kikan_sitei_kbn_cd']").val($("[name='kikan_sitei_kbn_cd']").val().substr(0, 2) + '19'); // 1213:任意の期間
});


$('table tbody tr').click(function () {
    $('tr').removeClass('activetr');
    $(this).addClass('activetr');
});

/*
 *  現在の表示テーブルをExcel出力
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
    data.splice(1, 1); //空行
    var write_opts = {
        type: 'binary'
    };
    var wb = aoa_to_workbook(data);
    var wb_out = XLSX.write(wb, write_opts);
    var blob = new Blob([s2ab(wb_out)], {type: 'application/octet-stream'});
    saveAs(blob, 'uri_bunseki.xlsx');
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

$(function () {
	$('table.head_fix').floatThead({
		top: 50
	});
});