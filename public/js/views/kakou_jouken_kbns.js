idmeisaif = 'fieldKakouJoukenMidasis';
jqmeisaif = '#' + idmeisaif;

function addKakouJoukenMidasisDt() {
    tr_id = '#tr_kakou_jouken_midasis_dt_' + imax;
    id_head = 'fieldKakouJoukenMidasisDts' + imax;
    name_head = 'data[kakou_jouken_midasis_dts][' + imax + ']';
    $("#tr_kakou_jouken_midasis_dt_hidden").clone(true).attr('id', 'tr_kakou_jouken_midasis_dt_' + imax).removeAttr('style').insertAfter('#tr_kakou_jouken_midasis_dt_' + ((imax > 0) ? imax - 1 : 'hidden'));
    $(tr_id + " #hiddenCd").attr('id', id_head + 'Cd').attr('name', name_head + '[cd]');
    $(tr_id + " #hiddenname").attr('id', id_head + 'Name').attr('name', name_head + '[name]');
    $(tr_id + " #hiddensuuti_flg").attr('id', id_head + 'SuutiFlg').attr('name', name_head + '[suuti_flg]');
    $("#" + id_head + 'Cd').val(imax + 1);
    imax++;
    $targetElm = $(targetElm);
}

window.onload = function () {
    addKakouJoukenMidasisDt();
};

$('#END').click(function () { //エンドキー(END)を押したら
    var index = $targetElm.index($("#" + lastfocusin));//alert(index);
    var thisname = $("#" + lastfocusin).attr('name');
    var partsname = thisname.split(/[\[|\]]+/);// '['か']'かその連続にマッチする文字で分割する。例：data[kakou_jouken_midasis_dts][0][cd]は、['data','kakou_jouken_midasis_dts','0','cd','']となる。
    var findend = '[shouhin_mr_cd]';
   
    index = $targetElm.index($("#fieldKakouJoukenMidasis" + (imax - 1) + "Cd")) - 1;
    for (i = index + 1; i <= $targetElm.length && (!$targetElm.eq(i).isVisible() || typeof ($targetElm.eq(i).attr("id")) == "undefined" || $targetElm.eq(i).attr("name").substr(findlen) != findend); i++) {
    }
    if (i <= $targetElm.length) {
        index = i;
    }
    $targetElm.eq(index).focus().select();
});

$('#PgUp').click(function () { //ページアップキー(Ctrl+Shift+Enter)を押したら
    var index = $targetElm.index($("#" + lastfocusin));//alert(index);
    var thisname = $("#" + lastfocusin).attr('name');
    var partsname = thisname.split(/[\[|\]]+/);// '['か']'かその連続にマッチする文字で分割する。例：data[shukkairai_meisai_dts][0][shouhin_mr_cd]は、['data','shukkairai_meisai_dts','0','shouhin_mr_cd','']となる。
    var findend = '[shouhin_mr_cd]';
    if (imax > 1 && partsname.length == 5) {
        findend = '[' + partsname[3] + ']';
    }
    var findlen = -findend.length;
    for (i = index - 1; i >= 0 && (!$targetElm.eq(i).isVisible() || typeof ($targetElm.eq(i).attr("id")) == "undefined" || $targetElm.eq(i).attr("name").substr(findlen) != findend); i--) {
    }
    if (i >= 0) {
        index = i;
    }
    $targetElm.eq(index).focus().select();
});


$('#PgDn').click(function () { //ページダウンキー(Ctrl+Enter)を押したら
    addKakouJoukenMidasisDt();//新規行を追加
    for (i = index + 1; i <= $targetElm.length && (!$targetElm.eq(i).isVisible() || typeof ($targetElm.eq(i).attr("id")) == "undefined" || $targetElm.eq(i).attr("name").substr(findlen) != findend); i++) {
    }
    if (i <= $targetElm.length) {
        index = i;
    }
    $targetElm.eq(index).focus().select();
});

$('#fieldCd').change(function () {
    var str = $('#fieldCd option:selected').text();
    var cut_str = '=';
    var index = str.indexOf(cut_str);
    str = str.slice(index + 1);
    $('#fieldName').val(str);
    var rows = $("#meisaiTable tbody").children();
    var rowsNum= rows.length;

    for (var i = 3; i < rowsNum; i++) {
        $(rows[i]).remove();
    }
    imax = 1;
    if ($(this).val() !== '') {
        var idleft = '#fieldKakouJoukenMidasisDts';
        $.ajax({
            type: "POST",
            url: kakou_jouken_midasis_ajaxGet,
            data: {'cd': $(this).val(),},
            async: true,
            dataType: 'json',
            success: function (data) {
                for (let i = 0; i < data.length;i++) {
                    $(idleft + i + 'Cd').val(data[i].cd)
                    $(idleft + i + 'Name').val(data[i].name);
                    $(idleft + i + 'SuutiFlg').val(data[i].suuti_flg);
                    addKakouJoukenMidasisDt();
                }
            },
            error: function (xhr, status, err) {
                alert('エラー Cd.change.ajax ' + status + '/' + err);
            },
        });
    }
});

$(function () {
    $('table.head_fix').floatThead({
        top: 50
    });
});


(function ($) { //$=JQuery
    var sheet_nm = "#meisaiTable";
    var drag_target = null;
    var tbl_width = $(sheet_nm).width();
    var org_width = 0;
    $(sheet_nm + " th").unbind('mousemove', null);
    $(sheet_nm + " th").unbind('mousedown', null);
    $(window).unbind('mousemove', null);
    $(window).unbind('mouseup', null);
    $(window).mousemove(function (e) {
        if (drag_target != null) {
            var th_width = e.clientX - parseInt($(drag_target).offset().left);
            if (th_width < 10) {
                th_width = 10;
            }
            if (drag_target.hasClass('ot-fixed')) {
                $('.ot-fixed').css({width: th_width + 'px'});
            } else {
                drag_target.css({width: th_width + 'px'});
            }
            var tbl_new_width = tbl_width - org_width + th_width;
            $(sheet_nm).css({width: tbl_new_width + 'px'});
            return false;
        }
        return true;
    });
    $(sheet_nm + " th").mousemove(function (e) {
        var right = parseInt($(this).offset().left) + parseInt($(this).css("width"));
        if ((right - 10) < e.clientX) {
            if (e.clientX < (right + 10)) {
                $(this).css({cursor: 'col-resize'});
                return false;
            }
        }
        $(this).css({cursor: 'default'});
        return true;
    });
    $(sheet_nm + " th").mousedown(function (e) {
        if ($(this).css('cursor') === 'col-resize') {
            drag_target = $(this);
            $(document.body).css({cursor: 'col-resize'});
            tbl_width = $(sheet_nm).width();
            org_width = $(this).width() + 1;
            return false;
        }
        return true;
    });
    $(window).mouseup(function (e) {
        drag_target = null;
        $(document.body).css({cursor: ''});
        var tbl_new_width = 0;
    });
})(jQuery);
