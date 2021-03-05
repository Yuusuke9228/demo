function addNyuukinMeisaiDt() { // alert(imax);
    tr_id = '#tr_nyuukin_meisai_dt_' + imax;
    id_head = 'fieldNyuukinMeisaiDts' + imax;
    name_head = 'data[nyuukin_meisai_dts][' + imax + ']';
    $("#tr_nyuukin_meisai_dt_hidden").clone(true).attr('id', 'tr_nyuukin_meisai_dt_' + imax).removeAttr('style').insertAfter('#tr_nyuukin_meisai_dt_' + ((imax > 0) ? imax - 1 : 'hidden'));
    $(tr_id + " #hiddenCd").attr('id', id_head + 'Cd').attr('name', name_head + '[cd]');
    $(tr_id + " #hiddenId").attr('id', id_head + 'Id').attr('name', name_head + '[id]');
    $(tr_id + " #hiddenUpdated").attr('id', id_head + 'Updated').attr('name', name_head + '[updated]');
    $(tr_id + " #hiddenNyuukinKbnCd").attr('id', id_head + 'NyuukinKbnCd').attr('name', name_head + '[nyuukin_kbn_cd]');
    $(tr_id + " #hiddenName").attr('id', id_head + 'Name').attr('name', name_head + '[name]');
    $(tr_id + " #hiddenTegataKijitu").attr('id', id_head + 'TegataKijitu').attr('name', name_head + '[tegata_kijitu]');
    $(tr_id + " #hiddenKingaku").attr('id', id_head + 'Kingaku').attr('name', name_head + '[kingaku]');
    $(tr_id + " #hiddenBikou").attr('id', id_head + 'Bikou').attr('name', name_head + '[bikou]');
    $("#" + id_head + 'Cd').val(imax + 1);
    $("#" + id_head + 'Id').val(0);
    imax++; //alert($("#"+id_head+'Id').val());
    $targetElm = $(targetElm);
}

org_urikake_zandaka = 0;
org_tougetu_kaishuugaku = 0;
org_goukei = 0;
window.onload = function () {
    addNyuukinMeisaiDt();
    goukei_saikeisan();
    org_goukei = 1 * $('#fieldGoukei').val().replace(/,/g, '');
    $('#fieldSeikyuusakiMrCd').change();
    goukei_saikeisan(); // 伝票合計再計算（税抜額などをControllerから送り込んであるならこちらが良い）
    const path = location.pathname;
    if (path.match(/new/) || path.match(/create/)) {
        $('#fieldKonkaiKesikomiKei').val(0);
        $('#fieldNokori').val(0);
    }
}

$('#END').click(function () { //エンドキー(END)を押したら最下行へ移動
    var index = $targetElm.index($("#" + lastfocusin));//alert(index);
    var thisname = $("#" + lastfocusin).attr('name');
    var partsname = thisname.split(/[\[|\]]+/);// '['か']'かその連続にマッチする文字で分割する。例：data[nyuukin_meisai_dts][0][shouhin_mr_cd]は、['data','nyuukin_meisai_dts','0','shouhin_mr_cd','']となる。
    var findend = '[nyuukin_kbn_cd]';
    if (imax > 1 && partsname.length == 5) {
        findend = '[' + partsname[3] + ']';
    }
    var findlen = -findend.length;
    index = $targetElm.index($("#fieldNyuukinMeisaiDts" + (imax - 1) + "Cd")) - 1;
    for (i = index + 1; i <= $targetElm.length && (!$targetElm.eq(i).isVisible() || typeof ($targetElm.eq(i).attr("id")) == "undefined" || $targetElm.eq(i).attr("name").substr(findlen) != findend); i++) {
    }
    if (i <= $targetElm.length) {
        index = i;
    }
    $targetElm.eq(index).focus().select();
});

$('#PgUp').click(function () { //ページアップキー(Ctrl+Shift+Enter)を押したら前行へ移動
    var index = $targetElm.index($("#" + lastfocusin));//alert(index);
    var thisname = $("#" + lastfocusin).attr('name');
    var partsname = thisname.split(/[\[|\]]+/);// '['か']'かその連続にマッチする文字で分割する。例：data[nyuukin_meisai_dts][0][shouhin_mr_cd]は、['data','nyuukin_meisai_dts','0','shouhin_mr_cd','']となる。
    var findend = '[nyuukin_kbn_cd]';
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

$('#PgDn').click(function () { //ページダウンキー(Ctrl+Enter)を押したら次行へ移動
    var index = $targetElm.index($("#" + lastfocusin));//alert(index);
    var thisname = $("#" + lastfocusin).attr('name');
    var partsname = thisname.split(/[\[|\]]+/);// '['か']'かその連続にマッチする文字で分割する。例：data[nyuukin_meisai_dts][0][shouhin_mr_cd]は、['data','nyuukin_meisai_dts','0','shouhin_mr_cd','']となる。
    var findend = '[nyuukin_kbn_cd]';
    if (imax > 1 && partsname.length == 5) {
        findend = '[' + partsname[3] + ']';
    }
    var findlen = -findend.length;
    for (i = index + 1; i <= $targetElm.length && (!$targetElm.eq(i).isVisible() || typeof ($targetElm.eq(i).attr("id")) == "undefined" || $targetElm.eq(i).attr("name").substr(findlen) != findend); i++) {
    }
    if (i <= $targetElm.length) {
        index = i;
    }
    $targetElm.eq(index).focus().select();
});

$('#fieldNyuukinbi').change(function () {
    if ($('#fieldNyuukinbi').val() <= $("#fieldShimezumibi").val()) {
        $('#F12').prop('disabled', true);
        $('#del').hide();
    } else {
        $('#F12').prop('disabled', false);
        $('#del').show();
    }
});

$('#fieldCd').change(function () { //入金データ索引
    const nyuukinbi = $('#fieldNyuukinbi').val();
    if ($(this).val() != '') {
        $.ajax({
            type: "POST",
            url: nyuukin_dts_ajaxGet,
            data: {'cd': $(this).val(), 'nyuukinbi': nyuukinbi,},
            async: true,
            dataType: 'json',
            success: function (data) {
                if (data.length >= 1 && $('#fieldCd').val() === data[0].cd) {
                    location.href = nyuukin_dts_edit + data[0].id;
                } else {
                    $('#fieldCd').focus().select();
                }
            },
            error: function (xhr, status, err) {
                alert('エラーが発生しました。');
            },
        });
    }
});

// 無駄に手形期日へカーソルを入れない
$(function () {
    $('.tegata_kijitu').on("focus", function (e) {
        let row_index = $(this).attr('id').replace(/[^0-9^.]/g, "");
        let row_id = '#fieldNyuukinMeisaiDts' + row_index + 'Name';
        let nyuukin_kbn = $(row_id).val();
        // 再帰呼び出しが発生しInternal Errorが発生する
        if (nyuukin_kbn.match(/手形/)) {
            try {
                $('#fieldNyuukinMeisaiDts' + row_index + 'TegataKijitu').focus();
                return true
            } catch (e) {

            }
        } else {
            try {
                $('#fieldNyuukinMeisaiDts' + row_index + 'Kingaku').focus();
                return true
            } catch (e) {

            }
        }
    });
});

/*
 * 特定の得意先のデータが多すぎて読み込めない問題があるので、
 * 一旦、チェンジイベント外で取得するように変更
 */
$('#getKeshikomiData').on('click', function () {
    if ($('#fieldSeikyuusakiMrCd').val !== '') {
        if (imax <= 1) {
            window.alert('入金明細が入力されていません。');
            return;
        }
        get_kesikomi();
    } else {
        window.alert('請求先が選択されていません。');
    }
});

$('#fieldSeikyuusakiMrCd').change(function () { //請求先マスター索引
//	alert("AAA:".$(this).attr("id")); //''の場合、'0'など1桁の場合または結果が複数の場合、結果が1個の場合、結果が0個の場合
    if ($(this).val() == '') {
        $("#rdonlySeikyuusakiMrName").val("");
    } else {
        $.ajax({
            type: "POST",
            url: seikyuusaki_mrs_ajaxGet,
            data: {'cd': $(this).val(), 'tougetu': $("#fieldNyuukinbi").val(),},
            async: true,
            dataType: 'json',
            success: function (data) {
                console.log(data);
                if (data.length == 0) {
                    $("#rdonlySeikyuusakiMrName").val('>>エラー:未登録');
                } else if (data.length == 1 || $("#fieldSeikyuusakiMrCd").val() === data[0].cd) {
                    $('#SeikyuusakiMrsOptions > option').remove();
                    for (var i = 0; i < data.length; i++) {
                        $('#SeikyuusakiMrsOptions').append('<option value="' + data[i].cd + '">' + data[i].cd + ':' + data[i].name + '</option>');
                    }
                    $("#fieldSeikyuusakiMrCd").val(data[0].cd);
                    $("#rdonlySeikyuusakiMrName").val(data[0].name);
                    $("#fieldSeikyuusakiName").val(data[0].seikyuusaki_name);
                    $("#fieldTantouMrCd").val(data[0].tantou_mr_cd);
                    $("#fieldHaraiHouhouKbnCd").val(data[0].harai_houhou_kbn_cd);
                    $("#fieldHaraiSaikuruKbnCd").val(data[0].harai_saikuru_kbn_cd);
                    $("#fieldHaraibi").val(data[0].haraibi);
                    $("#fieldShimegrpKbnCd").val(data[0].shimegrp_kbn_cd);
                    $("#fieldTesuuryouHutanFlg").val(data[0].tesuuryou_hutan_flg);
                    org_urikake_zandaka = data[0].uriage_ruikeigaku - data[0].nyuukin_ruikeigaku;
                    $("#fieldUrikakeZandaka").val(Intl.NumberFormat("ja-JP").format(1 * data[0].kake_zandaka + 1 * data[0].uriage_ruikeigaku - 1 * data[0].nyuukin_ruikeigaku));
                    org_tougetu_kaishuugaku = 1 * data[0].nyuukin_tougetugaku;
                    $("#fieldTougetuKaishuugaku").val(Intl.NumberFormat("ja-JP").format(data[0].nyuukin_tougetugaku));
                    $("#fieldShimezumibi").val(data[0].simezumibi);
                    if ($('#fieldNyuukinbi').val() <= $("#fieldShimezumibi").val()) {
                        $('#F12').prop('disabled', true);
                        $('#del').hide();
                    } else {
                        $('#F12').prop('disabled', false);
                        $('#del').show();
                    }
                    // get_kesikomi();
                } else {
                    //選択肢をクリアしてから追加する
                    $('#SeikyuusakiMrsOptions > option').remove();
                    for (var i = 0; i < data.length; i++) {
                        $('#SeikyuusakiMrsOptions').append('<option value="' + data[i].cd + '">' + data[i].cd + ':' + data[i].name + '</option>');
                    }
                    $("#rdonlySeikyuusakiMrName").val('>>エラー:未登録');
                    $("#fieldSeikyuusakiMrCd").focus().select();
                }
            },
            error: function (xhr, status, err) {
                alert('請求先の選択が不正です。');
            },
        });
    }
});

function get_kesikomi() {
    $.ajax({
        type: "POST",
        url: uriagegaku_vws_ajaxGet,
        data: {'cd': $("#fieldSeikyuusakiMrCd").val(), 'meisai_flg': $("#meisai_flg").val(),},
        async: true,
        dataType: 'json',
        success: function (data) {
            $('table#tb_kesikomi tbody .tr_kesikomi').remove();
            $('#fieldKonkaiKesikomiKei').val(0);
            nokori_saikeisan();

            // viewでグルーピング出来ないので、jsでグルーピング
            const group = data.reduce((result, current) => {
                const element = result.find((p) => p.cd === current.cd);
                if (element) {
                    element.count++; // count debug用
                    element.kingaku += parseInt(current.kingaku) | 0;
                    element.kesikomi_gaku += parseInt(current.kesikomi_gaku) | 0;
                } else {
                    result.push({
                        id: current.id,
                        uriagebi: current.uriagebi,
                        torihiki_kbn_name: current.torihiki_kbn_name,
                        kesikomi_id: current.kesikomi_id,
                        cd: current.cd,
                        count: 1,
                        kingaku: parseInt(current.kingaku) | 0,
                        kesikomi_gaku: parseInt(current.kesikomi_gaku) | 0,
                    });
                }
                return result;
            }, []);
            data = group;

            for (var i = 0; i < data.length; i++) {
                if ((data[i].kingaku === data[i].kesikomi_gaku) && data[i].kesikomi_id !== null) {
                    continue;
                }
                $("#tr_kesikomi_hidden").clone(true).attr('id', 'tr_kesikomi_' + i).attr('class', 'tr_kesikomi').removeAttr('style').appendTo($('table#tb_kesikomi tbody'));
                $('#tr_kesikomi_' + i + " #hiddenKesikomiChk").attr('id', 'dataKesikomi' + i + 'Chk').attr('name', 'data[kesikomi][' + i + '][chk]').val(data[i].id);
                thisTr = $('#tr_kesikomi_' + i);
                $('td', thisTr).eq(1).text(data[i].uriagebi);			//<!--伝票日付-->
                $('td', thisTr).eq(2).text(data[i].cd);					//<!--伝票番-->
                $('td', thisTr).eq(3).text(data[i].torihiki_kbn_name);	//<!--取引区-->
                var joutai = '一部消込';

                if (data[i].kesikomi_gaku === 0) {
                    if (data[i].kesikomi_id === null) {
                        joutai = '未消込';
                    }
                } else if ((data[i].kingaku === data[i].kesikomi_gaku)) {
                    if (data[i].kesikomi_id !== null) {
                        joutai = '消込済';
                    }
                }
                $('td', thisTr).eq(4).text(joutai);					//<!--伝票状-->
                $('td', thisTr).eq(5).text(Intl.NumberFormat("ja-JP").format(data[i].kingaku));							//<!--売上額-->
                $('td', thisTr).eq(6).text(Intl.NumberFormat("ja-JP").format(data[i].kesikomi_gaku));					//<!--消済額-->
                $('td', thisTr).eq(7).text(Intl.NumberFormat("ja-JP").format(data[i].kingaku - data[i].kesikomi_gaku));	//<!--未消額-->
            }
            $targetElm = $(targetElm);
        },
        error: function (xhr, status, err) {
            alert('Error->getKeshikomi: ' + status + '/' + err);
        },
    });
}


/* モーダルダイヤログ部分 */
function f8key() {
    if (lastfocusin == "fieldCd") { /* 入金伝票選択 */
        modalstart(nyuukin_dts_modal, "入金伝票選択");
    } else if (lastfocusin == "fieldSeikyuusakiMrCd") { /* 請求先コード選択 */
        modalstart(seikyuusaki_mrs_modal, "請求先選択");
    } else if (lastfocusin == "fieldNyuukinbi") { /* 入金日選択 */
        open_datepicker();
    } else if (lastfocusin.slice(-12) == "TegataKijitu") { /* 手形期日選択 */
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

function modalstart(url, title, para) {
    $('#iframe-title').text(title);
    $('#iframe-wrap').fadeIn();
    if (!para) {
        para = '?cd=' + $('#' + lastfocusin).val();
    }
    $('#iframe-body').html('<iframe src="' + url + para + '" width="100%" height="100%" style="border: none;">');
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
    //alert('親ページの関数が実行されました。');
    $('#iframe-wrap').fadeOut(
        function () {//alert("フェードアウト完了")
            if (retval) {
                $('#' + lastfocusin).val(retval);
                $('#' + lastfocusin).change();
            }
        }
    );
    $('#iframe-bg').fadeOut();
    $('#' + lastfocusin).focus().select();
}

$(function () { // モーダルウィンドウをドラッグで移動できる
    $("#iframe-wrap").draggable({
        handle: ".modal-header"
    });
});

/* 画面内計算 */
$("[id$='NyuukinKbnCd']").dblclick(function () { //入金区分索引
    $(this).change();
});

$("[id$='NyuukinKbnCd']").change(function () { //入金区分変化→内容
    var idleft = $(this).attr("id").slice(0, -12); //fieldNyuukinMeisaiDts0NyuukinKbnCd 右から12桁消す
    var gyou = idleft.slice(21); //fieldNyuukinMeisaiDts0 左から21桁消す
    if ($(this).val().slice(0, 1) !== "4") { // 手形で無かったら手形期日を消す
        $("#" + idleft + "TegatKijitu").val("");
    }
    $(this).next().val("");
    if ($(this).val() !== '') {
        options = $("#NyuukinKbnsOptions").children();
        for (var i = 0; i < options.length; i++) {
            if (options.eq(i).val() == $(this).val()) {
                $("#" + idleft + "Name").val(options.eq(i).text().slice(4));
                if (1 * gyou + 1 >= imax) {
                    addNyuukinMeisaiDt();
                }//新規行を追加しておく
                break;
            }
        }
    }
});

$("[id$='Kingaku']").change(function () { //金額が変更されたら
    $(this).val(Intl.NumberFormat("ja-JP").format(1 * ($(this).val().replace(/,/g, ''))));
    goukei_saikeisan(); // 合計再計算
});

function goukei_saikeisan() { // 合計再計算
    var goukeigaku = 0;
    var idleft = "fieldNyuukinMeisaiDts";
    for (var i = 0; i < imax; i++) {
        goukeigaku += 1 * ($("#" + idleft + i + "Kingaku").val().replace(/,/g, ''));
    }
    $("#fieldGoukei").val(Intl.NumberFormat("ja-JP").format(goukeigaku));
    $("#fieldNyuukinKingaku").val($("#fieldGoukei").val());

    $("#fieldUrikakeZandaka").val(Intl.NumberFormat("ja-JP").format(org_urikake_zandaka - goukeigaku + org_goukei));
    $("#fieldTougetuKaishuugaku").val(Intl.NumberFormat("ja-JP").format(goukeigaku - org_goukei + org_tougetu_kaishuugaku));
    kesikomi_zandaka_saikeisan();
}

function kesikomi_zandaka_saikeisan() { // 消込残高再計算
    $("#fieldKesikomiZandaka").val(
        Intl.NumberFormat("ja-JP").format(
            1 * ($("#fieldNyuukinKingaku").val().replace(/,/g, ''))
            - 1 * ($("#fieldZenkaiKesikomiGaku").val().replace(/,/g, ''))
        )
    );
    nokori_saikeisan();
}

function nokori_saikeisan() { // 残り再計算
    $("#fieldNokori").val(
        Intl.NumberFormat("ja-JP").format(
            1 * ($("#fieldKesikomiZandaka").val().replace(/,/g, ''))
            - 1 * ($("#fieldKonkaiKesikomiKei").val().replace(/,/g, ''))
        )
    );
}

$(':checkbox').change(function () { //チェックボックスが変更されたら
    if (kesikomi_kei() <= 0) { /* return; */
    } // 残り額がプラスの間は次へ移動もできるが、しない。

    //次の項目へ自動移動
    var index = $targetElm.index(this);
    for (var i = index + 1;
         i <= $targetElm.length && (!$targetElm.eq(i).isVisible()
             || $targetElm.eq(i).attr("readonly") == "readonly"
             || typeof ($targetElm.eq(i).attr("tabindex")) != "undefined"
         );
         i++) {
    }
    if (i <= $targetElm.length) {
        index = i;
    }
    $targetElm.eq(index).focus().select();//alert(index);
});

function kesikomi_kei() {
    var goukei = 0;
    $('.kesuchk:checked').each(function (i, thisChk) {
        goukei += 1 * ($(thisChk).parent().nextAll().eq(6).text().replace(/,/g, ''));
    });
    $('#fieldKonkaiKesikomiKei').val(Intl.NumberFormat("ja-JP").format(goukei));
    var nokori = 1 * $('#fieldKesikomiZandaka').val().replace(/,/g, '') - goukei;
    $('#fieldNokori').val(Intl.NumberFormat("ja-JP").format(nokori));
    return nokori;
}

function switch_roa(fieldx) { // 項目制御readonly設定(主)
    if ($("#field" + fieldx).attr("readonly") === "readonly") {
        $("#field" + fieldx).removeAttr("readonly");
    } else {
        $("#field" + fieldx).attr("readonly", "readonly");
    }
    if (fieldx == 'KidukesakiMrCd') {
        if ($("#field" + fieldx).attr("readonly") === "readonly") {
            $("#fieldKiduke").attr("readonly", "readonly");
        } else {
            $("#fieldKiduke").removeAttr("readonly");
        }
    }
    $targetElm = $(targetElm);
}

function switch_ros(fieldx) { // 項目制御readonly設定(明細)
    if ($("#hidden" + fieldx).attr("readonly") === "readonly") {
        $("#hidden" + fieldx).removeAttr("readonly");
        for (var i = 0; i < imax; i++) {
            $("#fieldNyuukinMeisaiDts" + i + fieldx).removeAttr("readonly");
        }
    } else {
        $("#hidden" + fieldx).attr("readonly", "readonly");
        for (var i = 0; i < imax; i++) {
            $("#fieldNyuukinMeisaiDts" + i + fieldx).attr("readonly", "readonly");
        }
    }
    $targetElm = $(targetElm);
}

var ro_fields = [
    'nyuukinbi', 'cd', 'tantou_mr_cd', 'name',
    '[cd', '[name', '[tegata_kijitu', '[bikou'
];

function save_ros() {
    $("#save_ros").text("(→「入力制御の保存中!....」)").css('color', 'red');
    var readonlys = {}; // 連想配列初期化
    for (var j in ro_fields) {
        var ro_field_name = ro_fields[j];
        if (ro_fields[j].substr(0, 1) == '[') {
            ro_field_name = 'hidden' + ro_fields[j] + ']';
        }
        readonlys[ro_fields[j]] = $("[name='" + ro_field_name + "']").attr('readonly') === 'readonly';
    }
    $.ajax({
        type: "POST",
        url: readonlys_ajaxSave,
        data: {'controller_cd': 'NyuukinDts', 'gamen_cd': 'inputfields', 'readonlys': readonlys,},
        async: true,
        dataType: 'json',
        success: function (error_count) {
            $("#save_ros").text('(click→「入力制御の保存」)').css('color', 'pink');
        },
        error: function (xhr, status, err) {
            $("#save_ros").text('(click→「入力制御の保存」)').css('color', 'pink');
        },
    });

}
