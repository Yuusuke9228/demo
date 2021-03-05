function addShukkinMeisaiDt() { // alert(imax);
    tr_id = '#tr_shukkin_meisai_dt_' + imax;
    id_head = 'fieldShukkinMeisaiDts' + imax;
    name_head = 'data[shukkin_meisai_dts][' + imax + ']';
    $("#tr_shukkin_meisai_dt_hidden").clone(true).attr('id', 'tr_shukkin_meisai_dt_' + imax).removeAttr('style').insertAfter('#tr_shukkin_meisai_dt_' + ((imax > 0) ? imax - 1 : 'hidden'));
    $(tr_id + " #hiddenCd").attr('id', id_head + 'Cd').attr('name', name_head + '[cd]');
    $(tr_id + " #hiddenId").attr('id', id_head + 'Id').attr('name', name_head + '[id]');
    $(tr_id + " #hiddenUpdated").attr('id', id_head + 'Updated').attr('name', name_head + '[updated]');
    $(tr_id + " #hiddenShiharaiKbnCd").attr('id', id_head + 'ShiharaiKbnCd').attr('name', name_head + '[shiharai_kbn_cd]');
    $(tr_id + " #hiddenName").attr('id', id_head + 'Name').attr('name', name_head + '[name]');
    $(tr_id + " #hiddenTegataKijitu").attr('id', id_head + 'TegataKijitu').attr('name', name_head + '[tegata_kijitu]');
    $(tr_id + " #hiddenKingaku").attr('id', id_head + 'Kingaku').attr('name', name_head + '[kingaku]');
    $(tr_id + " #hiddenBikou").attr('id', id_head + 'Bikou').attr('name', name_head + '[bikou]');
    $("#" + id_head + 'Cd').val(imax + 1);
    $("#" + id_head + 'Id').val(0);
    imax++; //alert($("#"+id_head+'Id').val());
    $targetElm = $(targetElm);
}

org_kaikake_zandaka = 0;
org_tougetu_kaishuugaku = 0;
org_goukei = 0;

window.onload = function () {
    addShukkinMeisaiDt();
    goukei_saikeisan();
    org_goukei = 1 * $('#fieldGoukei').val().replace(/,/g, '');
    $('#fieldShiiresakiMrCd').change();
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
    var partsname = thisname.split(/[\[|\]]+/);// '['か']'かその連続にマッチする文字で分割する。例：data[shukkin_meisai_dts][0][shouhin_mr_cd]は、['data','shukkin_meisai_dts','0','shouhin_mr_cd','']となる。
    var findend = '[shiharai_kbn_cd]';
    if (imax > 1 && partsname.length == 5) {
        findend = '[' + partsname[3] + ']';
    }
    var findlen = -findend.length;
    index = $targetElm.index($("#fieldShukkinMeisaiDts" + (imax - 1) + "Cd")) - 1;
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
    var partsname = thisname.split(/[\[|\]]+/);// '['か']'かその連続にマッチする文字で分割する。例：data[shukkin_meisai_dts][0][shouhin_mr_cd]は、['data','shukkin_meisai_dts','0','shouhin_mr_cd','']となる。
    var findend = '[shiharai_kbn_cd]';
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
    var partsname = thisname.split(/[\[|\]]+/);// '['か']'かその連続にマッチする文字で分割する。例：data[shukkin_meisai_dts][0][shouhin_mr_cd]は、['data','shukkin_meisai_dts','0','shouhin_mr_cd','']となる。
    var findend = '[shiharai_kbn_cd]';
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

$('#fieldCd').change(function () { //出金データ索引
    const shukkinbi = $('#fieldShukkinbi').val();
    if ($(this).val() != '') {
        $.ajax({
            type: "POST",
            url: shukkin_dts_ajaxGet,
            data: {'cd': $(this).val(), 'shukkinbi': shukkinbi,},
            async: true,
            dataType: 'json',
            success: function (data) {
                if (data.length >= 1 && $('#fieldCd').val() === data[0].cd) {
                    location.href = shukkin_dts_edit + data[0].id;
                } else {
                    $('#fieldCd').focus().select();
                }
            },
            error: function (xhr, status, err) {
                alert('エラーA Cd.change.ajax ' + status + '/' + err);
            },
        });
    }
});

// 無駄に手形期日へカーソルを入れない
$(function () {
    $('.tegata_kijitu').on("focus", function (e) {
        let row_index = $(this).attr('id').replace(/[^0-9^.]/g, "");
        let row_id = '#fieldShukkinMeisaiDts' + row_index + 'Name';
        let shukkin_kbn = $(row_id).val();
        // 再帰呼び出しが発生しInternal Errorが発生する
        if (shukkin_kbn.match(/手形/)) {
            try {
                $('#fieldShukkinMeisaiDts' + row_index + 'TegataKijitu').focus();
                return true
            } catch (e) {

            }
        } else {
            try {
                $('#fieldShukkinMeisaiDts' + row_index + 'Kingaku').focus();
                return true
            } catch (e) {

            }
        }
    });
});

/*
 * 特定の仕入先のデータが多すぎて読み込めない問題があるので、
 * 一旦、チェンジイベント外で取得するように変更
 */
$('#getKeshikomiData').on('click', function () {
    if ($('#fieldShiiresakiMrCd').val !== '') {
        if (imax <= 1) {
            window.alert('出金明細が入力されていません。');
            return;
        }
        get_kesikomi();
    } else {
        window.alert('仕入先が選択されていません。');
    }
});

$('#fieldShukkinbi').change(function () {
    if ($('#fieldShukkinbi').val() <= $("#fieldShimezumibi").val()) {
        $('#F12').prop('disabled', true);
        $('#del').hide();
    } else {
        $('#F12').prop('disabled', false);
        $('#del').show();
    }
})

$('#fieldShiiresakiMrCd').change(function () { //支払先マスター索引
//	alert("AAA:".$(this).attr("id")); //''の場合、'0'など1桁の場合または結果が複数の場合、結果が1個の場合、結果が0個の場合
    if ($(this).val() == '') {
        $("#rdonlyShiiresakiMrName").val("");
    } else {
        console.log($("#fieldShukkinbi").val())
        $.ajax({
            type: "POST",
            url: shiiresaki_mrs_ajaxGet,
            data: {'cd': $(this).val(), 'tougetu': $("#fieldShukkinbi").val(),},
            async: true,
            dataType: 'json',
            success: function (data) {
                console.log(data);
                if (data.length == 0) {
                    $("#rdonlyShiiresakiMrName").val('>>エラー:未登録');
                } else if (data.length == 1 || $("#fieldShiiresakiMrCd").val() === data[0].cd) {
                    $('#ShiiresakiMrsOptions > option').remove();
                    for (var i = 0; i < data.length; i++) {
                        $('#ShiiresakiMrsOptions').append('<option value="' + data[i].cd + '">' + data[i].cd + ':' + data[i].name + '</option>');
                    }
                    $("#fieldShiiresakiMrCd").val(data[0].cd);
                    $("#rdonlyShiiresakiMrName").val(data[0].name);
                    $("#fieldShiiresakiName").val(data[0].shiiresaki_name);
                    $("#fieldTantouMrCd").val(data[0].tantou_mr_cd);
                    $("#fieldHaraiHouhouKbnCd").val(data[0].harai_houhou_kbn_cd);
                    $("#fieldHaraiSaikuruKbnCd").val(data[0].harai_saikuru_kbn_cd);
                    $("#fieldHaraibi").val(data[0].haraibi);
                    $("#fieldShimegrpKbnCd").val(data[0].shimegrp_kbn_cd);
                    $("#fieldTesuuryouHutanFlg").val(data[0].tesuuryou_hutan_flg);
                    org_kaikake_zandaka = data[0].shiire_ruikeigaku - data[0].shukkin_ruikeigaku;
                    $("#fieldKaikakeZandaka").val(Intl.NumberFormat("ja-JP").format(1 * data[0].kake_zandaka + 1 * data[0].shiire_ruikeigaku - 1 * data[0].shukkin_ruikeigaku));
                    org_tougetu_kaishuugaku = 1 * data[0].shukkin_tougetugaku;
                    $("#fieldTougetuKaishuugaku").val(Intl.NumberFormat("ja-JP").format(data[0].shukkin_tougetugaku));
                    $("#fieldShimezumibi").val(data[0].simezumibi);
                    if ($('#fieldShukkinbi').val() <= $("#fieldShimezumibi").val()) {
                        $('#F12').prop('disabled', true);
                        $('#del').hide();
                    } else {
                        $('#F12').prop('disabled', false);
                        $('#del').show();
                    }
                    // get_kesikomi(); // 読み込み遅延が発生する
                } else {
                    //選択肢をクリアしてから追加する
                    $('#ShiiresakiMrsOptions > option').remove();
                    for (var i = 0; i < data.length; i++) {
                        $('#ShiiresakiMrsOptions').append('<option value="' + data[i].cd + '">' + data[i].cd + ':' + data[i].name + '</option>');
                    }
                    $("#rdonlyShiiresakiMrName").val('>>エラー:未登録');
                    $("#fieldShiiresakiMrCd").focus().select();
                }
            },
            error: function (xhr, status, err) {
                alert('>エラーB ' + status + '/' + err);
            },
        });
    }
});


function get_kesikomi() {
    $.ajax({
        type: "POST",
        url: shiiregaku_vws_ajaxGet,
        data: {'cd': $("#fieldShiiresakiMrCd").val(), 'meisai_flg': $("#meisai_flg").val(),},
        async: true,
        dataType: 'json',
        success: function (data) {
            $('table#tb_kesikomi tbody .tr_kesikomi').remove();
            $('#fieldKonkaiKesikomiKei').val(0);
            nokori_saikeisan();

            // viewでグルーピング出来ないのでjsでグルーピング
            const group = data.reduce((result, current) => {
                const element = result.find((p) => p.cd === current.cd);
                if (element) {
                    element.count++; // count debug用
                    element.kingaku += parseInt(current.kingaku) | 0;
                    element.kesikomi_gaku += parseInt(current.kesikomi_gaku) | 0;
                } else {
                    result.push({
                        id: current.id,
                        shiirebi: current.shiirebi,
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
            console.log(data);

            for (var i = 0; i < data.length; i++) {
                if ((parseInt(data[i].kingaku) === parseInt(data[i].kesikomi_gaku)) && data[i].kesikomi_id !== null) {
                    continue;
                }
                let joutai = '一部消込';

                if (parseInt(data[i].kesikomi_gaku) === 0) {
                    if (data[i].kesikomi_id == null) {
                        joutai = '未消込';
                    }
                } else if ((parseInt(data[i].kingaku) === parseInt(data[i].kesikomi_gaku))) {
                    joutai = '消込済';
                    continue;
                }
                $("#tr_kesikomi_hidden").clone(true).attr('id', 'tr_kesikomi_' + i).attr('class', 'tr_kesikomi').removeAttr('style').appendTo($('table#tb_kesikomi tbody'));
                $('#tr_kesikomi_' + i + " #hiddenKesikomiChk").attr('id', 'dataKesikomi' + i + 'Chk').attr('name', 'data[kesikomi][' + i + '][chk]').val(data[i].id);
                thisTr = $('#tr_kesikomi_' + i);
                $('td', thisTr).eq(1).text(data[i].shiirebi);			//<!--伝票日付-->
                $('td', thisTr).eq(2).text(data[i].cd);					//<!--伝票番-->
                $('td', thisTr).eq(3).text(data[i].torihiki_kbn_name);	//<!--取引区-->
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
    if (lastfocusin == "fieldCd") { /* 出金伝票選択 */
        modalstart(shukkin_dts_modal, "出金伝票選択");
    } else if (lastfocusin == "fieldShiiresakiMrCd") { /* 支払先コード選択 */
        modalstart(shiiresaki_mrs_modal, "支払先選択");
    } else if (lastfocusin == "fieldShukkinbi") { /* 出金日選択 */
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
$("[id$='ShiharaiKbnCd']").dblclick(function () { //出金区分索引
    $(this).change();
});

$("[id$='ShiharaiKbnCd']").change(function () { //出金区分変化→内容
    var idleft = $(this).attr("id").slice(0, -13); //fieldShukkinMeisaiDts0ShiharaiKbnCd 右から13桁消す
    var gyou = idleft.slice(21); //fieldShukkinMeisaiDts0 左から21桁消す
    if ($(this).val().slice(0, 1) !== "4") { // 手形で無かったら手形期日を消す
        $("#" + idleft + "TegatKijitu").val("");
    }
    $(this).next().val("");
    if ($(this).val() !== '') {
        options = $("#ShiharaiKbnsOptions").children();
        for (var i = 0; i < options.length; i++) {
            if (options.eq(i).val() == $(this).val()) {
                $("#" + idleft + "Name").val(options.eq(i).text().slice(4));
                if (1 * gyou + 1 >= imax) {
                    addShukkinMeisaiDt();
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
    var idleft = "fieldShukkinMeisaiDts";
    for (var i = 0; i < imax; i++) {
        goukeigaku += 1 * ($("#" + idleft + i + "Kingaku").val().replace(/,/g, ''));
    }
    $("#fieldGoukei").val(Intl.NumberFormat("ja-JP").format(goukeigaku));
    $("#fieldShukkinKingaku").val($("#fieldGoukei").val());

    $("#fieldKaikakeZandaka").val(Intl.NumberFormat("ja-JP").format(org_kaikake_zandaka - goukeigaku + org_goukei));
    $("#fieldTougetuKaishuugaku").val(Intl.NumberFormat("ja-JP").format(goukeigaku - org_goukei + org_tougetu_kaishuugaku));
    kesikomi_zandaka_saikeisan();
}

function kesikomi_zandaka_saikeisan() { // 消込残高再計算
    $("#fieldKesikomiZandaka").val(
        Intl.NumberFormat("ja-JP").format(
            1 * ($("#fieldShukkinKingaku").val().replace(/,/g, ''))
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
            $("#fieldShukkinMeisaiDts" + i + fieldx).removeAttr("readonly");
        }
    } else {
        $("#hidden" + fieldx).attr("readonly", "readonly");
        for (var i = 0; i < imax; i++) {
            $("#fieldShukkinMeisaiDts" + i + fieldx).attr("readonly", "readonly");
        }
    }
    $targetElm = $(targetElm);
}

var ro_fields = [
    'shukkinbi', 'cd', 'tantou_mr_cd', 'name',
    '[cd', '[name', '[tegata_kijitu', '[bikou'
]; // 閉じ角カッコはajaxで渡すときに欠落するので初めから入れない。

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
        data: {'controller_cd': 'ShukkinDts', 'gamen_cd': 'inputfields', 'readonlys': readonlys,},
        async: true,
        dataType: 'json',
        success: function (error_count) {
            alert('入力制御の保存完了！' + error_count);
            $("#save_ros").text('(click→「入力制御の保存」)').css('color', 'pink');
        },
        error: function (xhr, status, err) {
            alert('入力制御の保存でエラー Cd.change.ajax ' + status + '/' + err);
            $("#save_ros").text('(click→「入力制御の保存」)').css('color', 'pink');
        },
    });

}
