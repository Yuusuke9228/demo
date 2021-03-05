window.onload = function () {
    if (!$("#id").val()) {
        for (let i in flds) {
            $("[name='" + flds[i] + "']").val(flg = "" + window.parent.document.getElementsByName(flds[i])[0].value);
        }
    }
    $("input[type='checkbox']").each(function () {
        $(this).prop('checked', $(this).val() == 1);
    });
    $("#name").val($("#fieldCd option:selected").text());
	$('#fieldCd').change();

}

$('#fieldCd').change(function () {  //条件仕入分析を索引
    $("#name").val($("#fieldCd option:selected").text());
    $.ajax({
        type: "POST",
        url: jouken_shiire_bunsekis_ajaxGet,
        data: {'cd': $(this).val(),},
        async: true,
        dataType: 'json',
        success: function (data) {
            if (data.length === 0) {
                console.log('Error::Cd_Change : 条件未登録');
            } else {
                $('#cd').val(data[0]['cd']);
                $('#fieldJunjoKbnCd').val(data[0]['junjo_kbn_cd']);
                $('#fieldJunjoKbnCd').change();
                $('#fieldJunjo2KbnCd').val(data[0]['junjo2_kbn_cd']);
                $('#fieldJunjo2KbnCd').change();
                $('#fieldKikanSiteiKbnCd').val(data[0]['kikan_sitei_kbn_cd']);
                $('#fieldKikanSiteiKbnCd').change();

                if (data[0]['koujun_flg'] === '1') {
                    $('#fieldKoujunFlg').val(data[0]['koujun_flg']);
                    $('#fieldKoujunFlg').prop('checked', true);
                } else {
                    $('#fieldKoujunFlg').val(data[0]['koujun_flg']);
                    $('#fieldKoujunFlg').prop('checked', false);
                }
                if (data[0]['meisaigyou_flg'] === '1') {
                    $('#fieldMeisaigyouFlg').val(data[0]['meisaigyou_flg']);
                    $('#fieldMeisaigyouFlg').prop('checked', true);
                } else {
                    $('#fieldMeisaigyouFlg').val(data[0]['meisaigyou_flg']);
                    $('#fieldMeisaigyouFlg').prop('checked', false);
                }
                if (data[0]['torihikiari_flg'] === '1') {
                    $('#fieldTorihikiariFlg').val(data[0]['torihikiari_flg']);
                    $('#fieldTorihikiariFlg').prop('checked', true);
                } else {
                    $('#fieldTorihikiariFlg').val(data[0]['torihikiari_flg']);
                    $('#fieldTorihikiariFlg').prop('checked', false);
                }
                if (data[0]['torihikinashi_flg'] === '1') {
                    $('#fieldTorihikinashiFlg').val(data[0]['torihikinashi_flg']);
                    $('#fieldTorihikinashiFlg').prop('checked', true);
                } else {
                    $('#fieldTorihikinashiFlg').val(data[0]['torihikinashi_flg']);
                    $('#fieldTorihikinashiFlg').prop('checked', false);
                }
                //以下空欄
                $('#fieldHanniFromName').val('');
                $('#fieldHanniToName').val('');
                $('#fieldHanni2FromName').val('');
                $('#fieldHanni2ToName').val('');
            }
        },
        error: function (xhr, status, err) {
            console.log('Error::fieldCd_Change: ' + status + '/' + err);
        },
    });
});

$('#fieldJunjoKbnCd').change(function () {
	if ($(this).val() === $('#fieldJunjo2KbnCd').val()) {
		$(this).val('');
		$("[name='hanni_from']").val('');
		$("[name='hanni_from_name']").val('');
		$("[name='hanni_to']").val('');
		$("[name='hanni_to_name']").val('');
        console.log('順序１と順序２で同一の区分を選択することは出来ません。');
		return;
	}
    $.ajax({
        type: "POST",
        url: junjo_kbns_ajaxHanni,
        data: {'cd': $(this).val(),},
        async: true,
        dataType: 'json',
        success: function (data) {
            $("[name='hanni_from']").val(data.from);
            $("[name='hanni_from_name']").val(data.from_name);
            $("[name='hanni_to']").val(data.to);
            $("[name='hanni_to_name']").val(data.to_name);
            $("[name='junjo_kbn_table']").val(data.junjo_kbn_table);
        },
        error: function (xhr, status, err) {
            console.log('Error::JunjoKbnCd_Change : ' + status + '/' + err);
        },
    });
});

$('#fieldJunjo2KbnCd').change(function () {
	if ($(this).val() === $('#fieldJunjoKbnCd').val()) {
		$(this).val('');
		$("[name='hanni2_from']").val('');
		$("[name='hanni2_from_name']").val('');
		$("[name='hanni2_to']").val('');
		$("[name='hanni2_to_name']").val('');
        console.log('順序１と順序２で同一の区分を選択することは出来ません。');
		return;
	}
    $.ajax({
        type: "POST",
        url: junjo_kbns_ajaxHanni,
        data: {'cd': $(this).val(),},
        async: true,
        dataType: 'json',
        success: function (data) {
            $("[name='hanni2_from']").val(data.from);
            $("[name='hanni2_from_name']").val(data.from_name);
            $("[name='hanni2_to']").val(data.to);
            $("[name='hanni2_to_name']").val(data.to_name);
            $("[name='junjo2_kbn_table']").val(data.junjo_kbn_table);
        },
        error: function (xhr, status, err) {
            console.log('Error::Junjo2KbnCd_Change : ' + status + '/' + err);
        },
    });
});

$('#fieldKikanSiteiKbnCd').change(function () { //期間指定区分を索引
    $.ajax({
        type: "POST",
        url: kikan_sitei_kbns_ajaxGet,
        data: {'cd': $(this).val(),},
        async: true,
        dataType: 'json',
        success: function (data) {
            if (data.kikan_from != "0000-00-00") {
                $("[name='kikan_from']").val(data.kikan_from)
            }
            ;
            if (data.kikan_to != "0000-00-00") {
                $("[name='kikan_to']").val(data.kikan_to)
            }
            ;
        },
        error: function (xhr, status, err) {
            console.log('Error::KikanSiteiKbnCd_Change : ' + status + '/' + err);
        },
    });
});

$('#fieldHanniFrom, #fieldHanniTo, #fieldHanni2From, #fieldHanni2To').change(function () { //範囲から,まで
    kore = $(this).attr('id');
    if ($(this).val() == '') {
        $("#" + kore + "Name").val("");
    } else {
        $.ajax({
            type: "POST",
            url: junjo_kbns_ajaxGet,
            data: {
                'cd': $(this).val(),
                'target_cd': $('#fieldJunjo' + (kore.substr(10, 1) == '2' ? '2' : '') + 'KbnCd').val(),
            },
            async: true,
            dataType: 'json',
            success: function (data) {
                if (data.length == 0) {
                    $('#' + kore + 'Name').val('>>エラー:未登録');
                } else if (data.length === 1 || $('#' + kore).val() === data[0].cd) {
                    $('#' + kore + 'Options > option').remove();
                    for (var i = 0; i < data.length; i++) {
                        $('#' + kore + 'Options').append('<option value="' + data[i].cd + '">' + data[i].cd + ':' + data[i].name + '</option>');
                    }
                    $('#' + kore).val(data[0].cd);
                    $('#' + kore + 'Name').val(data[0].name);
                } else {
                    $('#' + kore + 'Options > option').remove();
                    for (var i = 0; i < data.length; i++) {
                        $('#' + kore + 'Options').append('<option value="' + data[i].cd + '">' + data[i].cd + ':' + data[i].name + '</option>');
                    }
                    $('#' + kore + 'Name').val('>>エラー:未登録');
                    $('#' + kore).focus().select();
                }
            },
            error: function (xhr, status, err) {
                $('#' + kore + 'Name').val('Error::HanniCd_Change : ' + status + '/' + err);
            },
        });
    }
});

/* モーダルダイヤログ部分 */
function f8key() {
    if (lastfocusin === "fieldHanniFrom" || lastfocusin === "fieldHanniTo") { /*  範囲からまで  */
        hanni_modal = base_uri + $("#junjo_kbn_table").val() + "/modal";
        modalstart(hanni_modal, "選択");
    } else if (lastfocusin === "fieldHanni2From" || lastfocusin === "fieldHanni2To") { /*  範囲からまで  */
        hanni_modal = base_uri + $("#junjo2_kbn_table").val() + "/modal";
        modalstart(hanni_modal, "選択");
    }
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

$("input[type='checkbox']").change(function () {
    $(this).val($(this).is(':checked') ? 1 : 0);
});

var flds = [
    "id",
    "cd",
    "name",
    "junjo_kbn_cd",
    "hanni_from",
    "hanni_to",
    "junjo2_kbn_cd",
    "hanni2_from",
    "hanni2_to",
    "kikan_sitei_kbn_cd",
    "kikan_from",
    "kikan_to",
    "koujun_flg",
    "meisaigyou_flg",
    "goukeigyou_flg",
    "torihikiari_flg",
    "torihikinashi_flg",
];

function return_value() {
    for (let i in flds) {
        window.parent.document.getElementsByName(flds[i])[0].value = "" + $("[name='" + flds[i] + "']").val();
    }
    window.parent.fromModal("submit");
}
