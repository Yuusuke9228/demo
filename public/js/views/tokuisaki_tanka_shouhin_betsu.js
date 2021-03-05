var moto_tanka = 0; //元単価保持用

/**
 * 得意先別単価 Ajax更新
 */
$(function () {
    $('.tanka')
        .focusin(function (e) {
            moto_tanka = $(this).text();
        })
        .keypress(function (e) {
            if (e.which == 13) {
                $(this).blur();
                return false;
            }
        })
        .focusout(function (e) {
            var id = $(this).attr("id");
            var id_count = id.replace(/[^0-9]/g, '');
            var tokuisaki_mr_cd = $('#cd' + id_count).text();
            var shouhin_mr_cd = $('#shouhin_mr_cd').val();
            var tanka = $(this).text().trim();

            // focusin時の単価とfocusout時の単価が同じなら更新しない
            if (parseFloat(moto_tanka) === parseFloat(tanka)) {
                return false;
            }
            // 商品未選択時は更新しない
            if (!tokuisaki_mr_cd) {
                window.alert("商品が未選択です。");
                return false;
            }

            row_data = {
                'shouhin_mr_cd': shouhin_mr_cd,
                'tokuisaki_mr_cd': tokuisaki_mr_cd,
                'tanka': tanka
            };
            $.ajax({
                url: tokuisaki_tanka_save_ajax,
                dataType: "json",
                type: "POST",
                data: row_data,
                success: function (res) {
                    //console.log("---------- updated!! ------------");
                    //console.log(res);
                    //console.log("---------------------------------");
                    window.alert(shouhin_mr_cd + " の " + tokuisaki_mr_cd + " 用、単価を設定しました!!");
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    window.alert('Error: Api Error! Controller@saveAjeaxActionを確認してください。');
                }
            });
            return false;
        });
});

/** ---------------------------------- Modal ---------------------------------- */
function f8key() {
    if (lastfocusin === "tokuisaki_mr_cd") {
        modalstart(shouhin_mrs_modal, "商品ん選択");
    }
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

$('#iframe-wrap button').click(function () {
    $('#iframe-bg, #iframe-wrap').fadeOut();
});

function fromModal(retval) {
    $('#iframe-wrap').fadeOut(
        function () {
        }
    );
    $('#iframe-bg').fadeOut();
    $('#' + lastfocusin).focus().select();
    $('#' + lastfocusin).val(retval);
}

$(function () {
    $("#iframe-wrap").draggable({
        handle: ".modal-header"
    });
});

$(function () {
    $('table.head_fix').floatThead({
        top: 50
    });
});

$('table tbody tr').click(function () { // クリックした行を目立たせる。
    $('tr').removeClass('activetr');
    $(this).addClass('activetr');
});

/** --------------------------------------------------*/

/**
 * 商品情報取得
 */
$('#shouhin_mr_cd').change(function () {
    $.ajax({
        type: "POST",
        url: shouhin_mrs_ajaxGet,
        data: {'cd': $(this).val(),},
        async: true,
        dataType: 'json',
        success: function (data) {
            if (data.length === 0) {
                $("#tokuisaki_name").val('Error: 未登録');
            } else if (data.length == 1 || $("#shouhin_mr_cd").val() === data[0].cd) {
                $("#shouhin_name").val(data[0].name);
                $("#joudai").val(data[0].joudai);
                $("#uri_tanka").val(data[0].uri_tanka1);
                if (data[0].tanka_kbn === '1') {
                    $("#shouhin_tani").val(data[0].tanni_mr1_name);
                } else {
                    $("#shouhin_tani").val(data[0].tanni_mr2_name);
                }
            }
        },
        error: function (xhr, status, err) {
            $("#tokuisaki_name").val('Error: Api Error TokuisakiMrsController@AjaxGetAction');
        },
    });
});

/**
 * 得意先編集画面へ遷移
 */
$('.tokuisaki_mr_cd').click(function () {
    var id = $(this).attr("id");
    var id_count = id.replace(/[^0-9]/g, '');
    var tokuisaki_id = $('#tokuisaki_id' + id_count).val();

    window.open(tokuisaki_edit + '/' + tokuisaki_id, "_blank");
});


/**
 * Excel出力
 */
$('#dl-xlsx').on('click', function () {
    var data = [];
    var tr = $("table tr");
    for (var i = 0, l = tr.length; i < l; i++) {
        var cells = tr.eq(i).children();
        for (var j = 0, m = cells.length; j < m; j++) {
            if (typeof data[i] == "undefined")
                data[i] = [];
            if (!isNumber(cells.eq(j).text().replace(/,/g, '').trim())) {
                data[i][j] = cells.eq(j).text().trim();
            } else {
                data[i][j] = cells.eq(j).text().replace(/,/g, '').trim() * 1;
            }
        }
    }

    data.splice(1, 2);
    var write_opts = {
        type: 'binary'
    };
    var wb = aoa_to_workbook(data);
    var wb_out = XLSX.write(wb, write_opts);
    var blob = new Blob([s2ab(wb_out)], {type: 'application/octet-stream'});
    saveAs(blob, 'ShouhinBetsu_UriageTankalist.xlsx');
    return false;
});

function isNumber(val) {
    var regex = new RegExp(/^[-+]?[0-9]+(\.[0-9]+)?$/);
    return regex.test(val);
}

function sheet_to_workbook(sheet/*:Worksheet*/, opts)/*:Workbook*/ {
    var n = opts && opts.sheet ? opts.sheet : "Sheet1";
    var sheets = {};
    sheets[n] = sheet;
    return {SheetNames: [n], Sheets: sheets};
}

function aoa_to_workbook(data/*:Array<Array<any> >*/, opts)/*:Workbook*/ {
    return sheet_to_workbook(XLSX.utils.aoa_to_sheet(data, opts), opts);
}

function s2ab(s) {
    var buf = new ArrayBuffer(s.length);
    var view = new Uint8Array(buf);
    for (var i = 0; i != s.length; ++i) view[i] = s.charCodeAt(i) & 0xFF;
    return buf;
}
