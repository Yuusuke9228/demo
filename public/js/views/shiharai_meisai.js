/* モーダルダイヤログ部分 */
function f8key() {
    if (lastfocusin === "fieldShiiresakiMrCd") {
        modalstart(shiiresaki_dts_modal, "仕入先選択");
    } else if (lastfocusin === "fieldSimeHiduke") {
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

function modalstart(url, title, shiiresaki_mr_cd = '') {
    $('#iframe-title').text(title);
    $('#iframe-wrap').fadeIn();
    if (shiiresaki_mr_cd === '') {
        $('#iframe-body').html('<iframe src="' + url + '" width="100%" height="100%" style="border: none;">');
    } else {
        $('#iframe-body').html('<iframe src="' + url + '?shiiresaki_mr_cd=' + shiiresaki_mr_cd + '" width="100%" height="100%" style="border: none;">');
    }
    $('#iframe-bg').fadeTo('normal', 0.5);
    $('#iframe-body iframe').load(function () {
        $(this).contents().find('#header, #footer').hide();
    });
    return false;
}

function rireki (shiiresaki_mr_cd) {
    if (shiiresaki_mr_cd === '') {
        window.alert('仕入先を入力して下さい。');
        return false;
    }
    modalstart(shime_rireki, '締切履歴', shiiresaki_mr_cd);
}

$('#fieldShiiresakiMrCd').change(function() {
    if ($(this).val() !== '') {
        $.ajax({
            type: "POST",
            url: shiiresaki_mrs_ajaxGet,
            data: {'cd': $(this).val(),},
            async: true,
            dataType: 'json',
            success: function (data) {
                $('#fieldShiiresakiMrCd').val(data[0]['cd']);
                $('#fieldShiiresakiName').val(data[0]['name']);
                $('#fieldShiharaishoBangou').val('');

                $.ajax({
                    type: "POST",
                    url: getShiiresakiShimeHiduke,
                    data: { 'cd': $("#fieldShiiresakiMrCd").val() },
                    async: true,
                    dataType: 'json',
                    success: function (res) {
                        $('#fieldSimebi').val(res.sime_hiduke)
                    },
                    error: function (xhr, status, err) {
                        console.log(err);
                    }
                })
            },
            error: function (xhr, status, err) {
                alert('Error: Cd.change.ajax ' + status + '/' + err);
            },
        });
    }
});

$('#iframe-wrap button').click(function () { /* 中止して終わる (X) */
    $('#iframe-bg, #iframe-wrap').fadeOut();
});

function fromModal(retval) {
    $('#iframe-wrap').fadeOut(
        function () {
            if (retval) {
                $('#' + lastfocusin).val(retval);
                $('#' + lastfocusin).change();
            }
        }
    );
    $('#iframe-bg').fadeOut();
    $('#' + lastfocusin).focus().select();
}
$(function () {
    $("#iframe-wrap").draggable({
        handle: ".modal-header"
    });
});

$('#PgUp').click(function () { //ページアップキー(Ctrl+Shift+Enter)を押したら前行へ移動
    var index = $targetElm.index($("#" + lastfocusin));//alert(index);
    for (i = index - 1; i >= 0 && (!$targetElm.eq(i).isVisible() || typeof ($targetElm.eq(i).attr("id")) == "undefined" || $targetElm.eq(i).attr("name").substr(0, 5) != "code_"); i--) {
    }
    if (i >= 0) {
        index = i;
    }
    $targetElm.eq(index).focus().select();
});

$('#PgDn').click(function () { //ページダウンキー(Ctrl+Enter)を押したら次行へ移動
    var index = $targetElm.index($("#" + lastfocusin));//alert(index);
    for (i = index + 1; i <= $targetElm.length && (!$targetElm.eq(i).isVisible() || typeof ($targetElm.eq(i).attr("id")) == "undefined" || $targetElm.eq(i).attr("name").substr(0, 5) != "code_"); i++) {
    }
    if (i <= $targetElm.length) {
        index = i;
    }
    $targetElm.eq(index).focus().select();
});

$(function () {
    $('#dl-xlsx').on('click', function () {
        const form = $(this).parents('form');
        form.attr('action', $(this).data('action'));
        var hoge = $(this).data('hoge');
        $('<input>').attr({
            'type': 'hidden',
            'name': 'hoge',
            'value': hoge
        }).appendTo(form);
        form.submit();
        form.attr('action', 'shiharai_meisai')
    });
});

$('#fieldSimebi').change(function () {
    $('#fieldShiharaishoBangou').val('');
    $('#sime_joutai').text('');
});

$('#fieldSimebi').click(function () {
    $(this).select();
});