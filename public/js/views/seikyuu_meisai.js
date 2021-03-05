$("#fieldSeikyuusakiMrCd").change(function () {
    if ($(this).val() === '') {
        $("#fieldSeikyuusakiName").val('');
    } else {
        $.ajax({
            type: "POST",
            url: tokuisaki_mrs_ajaxget,
            data: {'cd': $(this).val(),},
            async: true,
            dataType: 'json',
            success: function (data) {
                if (data.length === 0) {
                    $("#fieldSeikyuusakiName").val('>> Error : Not Code...');
                } else if (data.length === 1 || $("#fieldSeikyuusakiMrCd").val() === data[0].cd) {
                    $("#fieldSeikyuusakiMrCd").val(data[0].cd);
                    $("#fieldSeikyuusakiName").val(data[0].name);
                    $('#fieldSeikyuushoBangou').val('');

                    $.ajax({
                        type: "POST",
                        url: getTokuisakiShimeHiduke,
                        data: { 'cd': $("#fieldSeikyuusakiMrCd").val() },
                        async: true,
                        dataType: 'json',
                        success: function (res) {
                            $('#fieldSimebi').val(res.sime_hiduke)
                        },
                        error: function (xhr, status, err) {
                            console.log(err);
                        }
                    })
                }
            },
            error: function (xhr, status, err) {
                $("#fieldSeikyuusakiName").val('Error: ' + status + '/' + err);
            },
        });
    }
});

function f8key() {
    if (lastfocusin === 'fieldSimebi') {
        open_datepicker();
    } else if (lastfocusin === 'fieldSeikyuusakiMrCd') {
        modalstart(tokuisaki_mrs_modal, '得意先選択');
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

function modalstart(url, title, tokuisaki_mr_cd = '') {
    $('#iframe-title').text(title);
    $('#iframe-wrap').fadeIn();
    if (tokuisaki_mr_cd === '') {
        $('#iframe-body').html('<iframe src="' + url + '?cd=' + lastfocusin.substr(5) + '" width="100%" height="100%" style="border: none;">');
    } else {
        $('#iframe-body').html('<iframe src="' + url + '?tokuisaki_mr_cd=' + tokuisaki_mr_cd + '" width="100%" height="100%" style="border: none;">');
    }
    $('#iframe-bg').fadeTo('normal', 0.5);
    $('#iframe-body iframe').load(function () {
        $(this).contents().find('#header, #footer').hide();
    });
    return false;
}

function rireki (tokuisaki_mr_cd) {
    if (tokuisaki_mr_cd === '') {
        window.alert('得意先を入力して下さい。');
        return false;
    }
    modalstart(shime_rireki, '締切履歴', tokuisaki_mr_cd);
}

$('#iframe-wrap button').click(function () {
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

$('#PgUp').click(function () {
    var index = $targetElm.index($("#" + lastfocusin));
    for (i = index - 1; i >= 0 && (!$targetElm.eq(i).isVisible() || typeof ($targetElm.eq(i).attr("id")) == "undefined" || $targetElm.eq(i).attr("name").substr(0, 5) != "code_"); i--) {
    }
    if (i >= 0) {
        index = i;
    }
    $targetElm.eq(index).focus().select();
});

$('#PgDn').click(function () {
    var index = $targetElm.index($("#" + lastfocusin));
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
        form.attr('action', 'seikyuu_meisai')
    });
});

$('#fieldSimebi').change(function () {
    $('#sime_joutai').text('');
    $('#fieldSeikyuushoBangou').val('');
});

$('#fieldSimebi').click(function () {
    $(this).select();
});
