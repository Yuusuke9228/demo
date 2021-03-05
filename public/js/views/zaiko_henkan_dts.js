function addZaikoHenkanMeisaiDt() {
    tr_id = '#tr_zaiko_henkan_meisai_dt_' + imax;
    id_head = 'fieldZaikoHenkanMeisaiDts' + imax;
    name_head = 'data[zaiko_henkan_meisai_dts][' + imax + ']';
    $("#tr_zaiko_henkan_meisai_dt_hidden").clone(true).attr('id', 'tr_zaiko_henkan_meisai_dt_' + imax).removeAttr('style').insertAfter('#tr_zaiko_henkan_meisai_dt_' + ((imax > 0) ? imax - 1 : 'hidden'));
    $(tr_id + " #hiddenCd").attr('id', id_head + 'Cd').attr('name', name_head + '[cd]');
    $(tr_id + " #hiddenId").attr('id', id_head + 'Id').attr('name', name_head + '[id]');
    $(tr_id + " #hiddenUpdated").attr('id', id_head + 'Updated').attr('name', name_head + '[updated]');
    $(tr_id + " #hiddenUtiwakeKbnCd").attr('id', id_head + 'UtiwakeKbnCd').attr('name', name_head + '[utiwake_kbn_cd]');
    $(tr_id + " #hiddenHenkansakiFlg").attr('id', id_head + 'HenkansakiFlg').attr('name', name_head + '[henkansaki_flg]');
    $(tr_id + " #hiddenHenkanmotosaki").attr('id', id_head + 'Henkanmotosaki').attr('name', name_head + '[henkanmotosaki]');
    $(tr_id + " #hiddenShouhinMrCd").attr('id', id_head + 'ShouhinMrCd').attr('name', name_head + '[shouhin_mr_cd]');
    $(tr_id + " #hiddenTanniMr1Cd").attr('id', id_head + 'TanniMr1Cd').attr('name', name_head + '[tanni_mr1_cd]');
    $(tr_id + " #hiddenTanniMr2Cd").attr('id', id_head + 'TanniMr2Cd').attr('name', name_head + '[tanni_mr2_cd]');
    $(tr_id + " #hiddenIro").attr('id', id_head + 'Iro').attr('name', name_head + '[iro]');
    $(tr_id + " #hiddenIromei").attr('id', id_head + 'Iromei').attr('name', name_head + '[iromei]');
    $(tr_id + " #hiddenIrisuu").attr('id', id_head + 'Irisuu').attr('name', name_head + '[irisuu]');
    $(tr_id + " #hiddenSuuryou1").attr('id', id_head + 'Suuryou1').attr('name', name_head + '[suuryou1]');
    $(tr_id + " #hiddenTekiyou").attr('id', id_head + 'Tekiyou').attr('name', name_head + '[tekiyou]');
    $(tr_id + " #hiddenLot").attr('id', id_head + 'Lot').attr('name', name_head + '[lot]');
    $(tr_id + " #hiddenKobetucd").attr('id', id_head + 'Kobetucd').attr('name', name_head + '[kobetucd]');
    $(tr_id + " #hiddenHinsituKbnCd").attr('id', id_head + 'HinsituKbnCd').attr('name', name_head + '[hinsitu_kbn_cd]');
    $(tr_id + " #hiddenKouseiSuuryou").attr('id', id_head + 'KouseiSuuryou').attr('name', name_head + '[kousei_suuryou]');
    $(tr_id + " #hiddenSuuryou2").attr('id', id_head + 'Suuryou2').attr('name', name_head + '[suuryou2]');
    $(tr_id + " #hiddenTanka").attr('id', id_head + 'Tanka').attr('name', name_head + '[tanka]');
    $(tr_id + " #hiddenTankaKbn").attr('id', id_head + 'TankaKbn').attr('name', name_head + '[tanka_kbn]');
    $(tr_id + " #hiddenZaikoKbn").attr('id', id_head + 'ZaikoKbn').attr('name', name_head + '[zaiko_kbn]');
    $(tr_id + " #hiddenKingaku").attr('id', id_head + 'Kingaku').attr('name', name_head + '[kingaku]');
    $(tr_id + " #hiddenBikou").attr('id', id_head + 'Bikou').attr('name', name_head + '[bikou]');
    $("#" + id_head + 'Cd').val(imax + 1);
    $("#" + id_head + 'Id').val(0);
    if ($("#fieldZaikoHenkanKbnCd").val() == "1") { // 生産
        $("#fieldZaikoHenkanMeisaiDts" + imax + "HenkansakiFlg").val("0").disableSelection(); // 2行目以降は変換元
    } else if ($("#fieldZaikoHenkanKbnCd").val() == "2") { // 倉庫移動は全て2共通
        $("#fieldZaikoHenkanMeisaiDts" + imax + "HenkansakiFlg").val("2").disableSelection();
    } else if ($("#fieldZaikoHenkanKbnCd").val() == "3") { // 出庫は全て0変換元
        $("#fieldZaikoHenkanMeisaiDts" + imax + "HenkansakiFlg").val("0").disableSelection();
    } else if ($("#fieldZaikoHenkanKbnCd").val() == "4") { // 商品コード変更単位変換
        $("#fieldZaikoHenkanMeisaiDts" + imax + "HenkansakiFlg").val(imax % 2).enableSelection(); // 1行目など奇数行は0変換元、2行目など偶数行は1変換先
    } else if ($("#fieldZaikoHenkanKbnCd").val() == "5") { // 預り投入は全て2共通
        $("#fieldZaikoHenkanMeisaiDts" + imax + "HenkansakiFlg").val("2").disableSelection();
    } else if ($("#fieldZaikoHenkanKbnCd").val() == "6") { // 預り調整は全て0変換元
        $("#fieldZaikoHenkanMeisaiDts" + imax + "HenkansakiFlg").val("0").disableSelection();
    }
    imax++; //alert($("#"+id_head+'Id').val());
    $targetElm = $(targetElm);
}

window.onload = function () {
    //	$(window).resize();
    tbl_new_width = 0;
    $('#meisaiTable thead tr th').each(function (i) {
        tbl_new_width += 1 + $(this).width();
    });
    $('#meisaiTable').css({width: tbl_new_width + 'px'});
    addZaikoHenkanMeisaiDt();
    $("#fieldZaikoHenkanKbnCd").change();
    denpyou_goukei_saikeisan(); // 伝票合計再計算（税抜額などをControllerから送り込んであるならこちらが良い）
    addForm1(); // モーダル呼出post用フォームを追加
}

function addForm1() { // モーダル呼出post用フォームを追加
    var form1 = $('<form></form>', {
        id: 'form1',
        action: '' + den_modal,
        target: 'iframe1',
        method: 'POST',
        name: 'iframe1form'
    }).hide();
    $('body').append(form1);
    form1.append($('<input>', {type: 'hidden', name: 'sakusei_user_id', value: my_id}));
    form1.append($('<input>', {type: 'hidden', name: 'denpyou_mr_cd', value: denpyou_mr_cd}));
}

var cpyary = [
    'UtiwakeKbnCd', 'HenkansakiFlg', 'Henkanmotosaki', 'ShouhinMrCd', 'TanniMr1Cd', 'TanniMr2Cd', 'Irisuu', 'KouseiSuuryou',
    'Suuryou1', 'Tekiyou', 'Iro', 'Iromei', 'Lot', 'Kobetucd', 'HinsituKbnCd', 'Suuryou2',
    'TankaKbn', 'ZaikoKbn', 'Tanka', 'Kingaku',
    'Bikou'
];

$('#PgDn').click(function () { //ページダウンキー(Ctrl+Enter)を押したら
    var idmeisaif = 'fieldZaikoHenkanMeisaiDts';
    var jqmeisaif = '#' + idmeisaif;
    var index = $targetElm.index($("#" + lastfocusin));//alert(index);
    var thisname = $("#" + lastfocusin).attr('name');
    var partsname = thisname.split(/[\[|\]]+/);// '['か']'かその連続にマッチする文字で分割する。例：data[uriage_meisai_dts][0][shouhin_mr_cd]は、['data','uriage_meisai_dts','0','shouhin_mr_cd','']となる。
    if (imax > 1 && partsname.length == 5) {
        if (1 * partsname[2] + 1 == imax) {
            for (var i in cpyary) {
                if (!$("#" + lastfocusin).val() || idmeisaif + partsname[2] + cpyary[i] != lastfocusin) {
                    $(jqmeisaif + partsname[2] + cpyary[i]).val($(jqmeisaif + (1 * partsname[2] - 1) + cpyary[i]).val());
                }
            }
            $(jqmeisaif + partsname[2] + "Suuryou" + $(jqmeisaif + partsname[2] + "TankaKbn").val()).change();
            $(jqmeisaif + partsname[2] + "TanniMr1Cd").change();
            addZaikoHenkanMeisaiDt();//新規行を追加
            denpyou_goukei_saikeisan();
        }
    }
});

$('#fieldCd').change(function () { //在庫変換データ索引
    //alert($(this).val()); //''の場合、'0'など1桁の場合または結果が複数の場合、結果が1個の場合、結果が0個の場合
    if ($(this).val() != '') {
        $.ajax({
            type: "POST",
            url: zaiko_henkan_dts_ajaxGet,
            data: {'cd': $(this).val(), 'zaiko_henkan_kbn_cd': $('#fieldZaikoHenkanKbnCd').val(),},
            async: true,
            dataType: 'json',
            success: function (data) {
                if (data.length >= 1 && $('#fieldCd').val() === data[0].cd) {
                    location.href = zaiko_henkan_dts_edit + data[0].id;
                } else {
                    $('#fieldCd').focus().select();
                }
            },
            error: function (xhr, status, err) {
                alert('エラー Cd.change.ajax ' + status + '/' + err);
            },
        });
    }
});

$('#fieldTokuisakiMrCd').change(function () { //得意先マスター索引
    //alert("AAA:".$(this).attr("id")); //''の場合、'0'など1桁の場合または結果が複数の場合、結果が1個の場合、結果が0個の場合
    if ($(this).val() == '') {
        $("#fieldTokuisakiMrName").val("");
    } else {
        $.ajax({
            type: "POST",
            url: tokuisaki_mrs_ajaxGet,
            data: {'cd': $(this).val(),},
            async: true,
            dataType: 'json',
            success: function (data) {
                if (data.length == 0) {
                    $("#fieldTokuisakiMrName").val('>>エラー:未登録');
                } else if (data.length == 1 || $("#fieldTokuisakiMrCd").val() === data[0].cd) {
                    $('#TokuisakiMrsOptions > option').remove();
                    for (var i = 0; i < data.length; i++) {
                        $('#TokuisakiMrsOptions').append('<option value="' + data[i].cd + '">' + data[i].cd + ':' + data[i].name + '</option>');
                    }
                    $("#fieldTokuisakiMrCd").val(data[0].cd);
                    $("#fieldTokuisakiMrName").val(data[0].name);
                } else {
                    //選択肢をクリアしてから追加する
                    $('#TokuisakiMrsOptions > option').remove();
                    for (var i = 0; i < data.length; i++) {
                        $('#TokuisakiMrsOptions').append('<option value="' + data[i].cd + '">' + data[i].cd + ':' + data[i].name + '</option>');
                    }
                    $("#fieldTokuisakiMrName").val('>>エラー:未登録');
                    $("#fieldTokuisakiMrCd").focus().select();
                }
            },
            error: function (xhr, status, err) {
                $("#fieldTokuisakiMrName").val('>エラー' + status + '/' + err);
            },
        });
    }
});

$("[id$='ShouhinMrCd']").change(function () {
    var idleft = $(this).attr("id").slice(0, -11);
    var gyou = idleft.slice(25);
    if ($(this).val() == '') {
        $("#" + idleft + "Tekiyou").val("");
    } else {
        $.ajax({
            type: "POST",
            url: shouhin_mrs_ajaxGet,
            data: {'cd': $(this).val(),},
            async: true,
            dataType: 'json',
            success: function (data) {
                if (data.length == 0) {
                    $("#" + idleft + "Tekiyou").val('>>エラー:未登録');
                } else if (data.length == 1 || $("#" + idleft + "ShouhinMrCd").val() === data[0].cd) {
                    //選択肢をクリアしてから追加する
                    $('#ShouhinMrsOptions > option').remove();
                    for (var i = 0; i < data.length; i++) {
                        $('#ShouhinMrsOptions').append('<option value="' + data[i].cd + '">' + data[i].cd + ':' + data[i].name + '</option>');
                    }
                    $("#" + idleft + "ShouhinMrCd").val(data[0].cd);
                    $("#" + idleft + "Tekiyou").val(data[0].name);
                    $("#" + idleft + "TanniMr1Cd").val(data[0].tanni_mr1_cd);
                    $("#" + idleft + "TanniMr2Cd").val(data[0].tanni_mr2_cd);
                    $("#" + idleft + "Irisuu").val(data[0].irisuu);
                    $("#" + idleft + "Lot").val(data[0].lot);
                    $("#" + idleft + "HinsituKbnCd").val(data[0].hinsitu_kbn_cd);
                    $("#" + idleft + "Tanka").val(data[0].shiire_tanka);
                    $("#" + idleft + "TankaKbn").val(data[0].tanka_kbn);
                    $("#" + idleft + "ZaikoKbn").val(data[0].zaiko_kbn);
                    $("#" + idleft + "Tanka").change();
                    if (gyou == 0 && $("#fieldZaikoHenkanKbnCd").val() == "1") {
                        seisan_buhin(data[0].id);
                    }
                    if (1 * gyou + 1 >= imax) {
                        addZaikoHenkanMeisaiDt();
                    }

                    try {
                        var souko_cd = $("#fieldMotoSoukoMrCd").val();
                    } catch (e) {
                        console.log('倉庫空白');
                    }

                    if (typeof souko_cd !== "undefined") {
                        getZaiko(data[0].cd, souko_cd);
                    } else {
                        try {
                            getZaiko(data[0].cd, '');
                        } catch (e) {
                            console.log(data[0].cd);
                        }
                    }
                    $('#' + idleft + 'TanniMr1Cd').change();
                } else {
                    //選択肢をクリアしてから追加する
                    $('#ShouhinMrsOptions > option').remove();
                    for (var i = 0; i < data.length; i++) {
                        $('#ShouhinMrsOptions').append('<option value="' + data[i].cd + '">' + data[i].cd + ':' + data[i].name + '</option>');
                    }
                    $("#" + idleft + "Tekiyou").val('>>エラー:未登録');
                    $("#" + idleft + "ShouhinMrCd").focus().select();
                }
            },
            error: function (xhr, status, err) {
                $("#" + idleft + "Tekiyou").val('>エラー' + status + '/' + err);
            },
        });
    }
});

/* 生産で完成品を変更したら構成部品を検索して展開する */
function seisan_buhin(shouhin_mr_id) {
    $.ajax({
        type: "POST",
        url: kousei_buhin_mrs_ajaxGet,
        data: {'shouhin_mr_id': shouhin_mr_id,},
        async: true,
        dataType: 'json',
        success: function (data) {
            if (data.length == 0) {
                $("#" + idleft + "Tekiyou").val('>>エラー:構成部品');
            } else {
                for (var i = 1; i - 1 < data.length; i++) {
                    if (i >= imax) {
                        addZaikoHenkanMeisaiDt()
                    }//新規行を追加
                    $('#fieldZaikoHenkanMeisaiDts' + i + 'ShouhinMrCd').val(data[i - 1].gen_shouhin_mr_cd);
                    //$('#fieldZaikoHenkanMeisaiDts'+i+'ShouhinMrCd').change();
                    $('#fieldZaikoHenkanMeisaiDts' + i + "Tekiyou").val(data[i - 1].gen_shouhin_mr.name);
                    $('#fieldZaikoHenkanMeisaiDts' + i + "TanniMr2Cd").val(data[i - 1].gen_shouhin_mr.tanni_mr2_cd);
                    $('#fieldZaikoHenkanMeisaiDts' + i + "TanniMr1Cd").val(data[i - 1].gen_shouhin_mr.tanni_mr1_cd);
                    $('#fieldZaikoHenkanMeisaiDts' + i + "Irisuu").val(data[i - 1].gen_shouhin_mr.irisuu);
                    $('#fieldZaikoHenkanMeisaiDts' + i + "Lot").val(data[i - 1].gen_shouhin_mr.lot);
                    $('#fieldZaikoHenkanMeisaiDts' + i + "HinsituKbnCd").val(data[i - 1].gen_shouhin_mr.hinsitu_kbn_cd);
                    $('#fieldZaikoHenkanMeisaiDts' + i + "Tanka").val(data[i - 1].gen_shouhin_mr.shiire_tanka);
                    $('#fieldZaikoHenkanMeisaiDts' + i + "TankaKbn").val(data[i - 1].gen_shouhin_mr.tanka_kbn);
                    $('#fieldZaikoHenkanMeisaiDts' + i + "ZaikoKbn").val(data[i - 1].gen_shouhin_mr.zaiko_kbn);
                    //alert("/"+gyou+"/");
                    $('#fieldZaikoHenkanMeisaiDts' + i + "Tanka").change();
                    $('#fieldZaikoHenkanMeisaiDts' + i + 'KouseiSuuryou').val(data[i - 1].suuryou);
                }
                if (i >= imax) {
                    addZaikoHenkanMeisaiDt()
                }//新規行を追加
            }
        },
        error: function (xhr, status, err) {
            $("#fieldZaikoHenkanMeisaiDts0Tekiyou").val('>エラー構成部品' + status + '/' + err);
        },
    });
}

//lotモーダル 集計した画面
$("[id$='Lot']").dblclick(function () {
    let soukoCode = document.getElementById('fieldMotoSoukoMrCd').value;//倉庫絞込の為、コード取得
    //倉庫未選択時、モーダル表示しない。 Add By Nishiyama 2019/3/5
    if (soukoCode === '') {
        window.alert('移動元倉庫が未選択です。');
        return;
    }
    modalstart2(lot_summary_modal, "ロット別在庫", "?cd=" + $('#' + lastfocusin.slice(0, -3) + "ShouhinMrCd").val().replace('+', '%2B'), soukoCode);
});

/* モーダルダイヤログ部分 */
function f8key() {
    if (lastfocusin == "fieldCd") { /* 在庫変換データ選択 */
        modalstart1(den_modal, "在庫変換伝票選択");
    } else if (lastfocusin == "fieldTokuisakiMrCd") { /* 得意先コード選択 */
        modalstart(tokuisaki_mrs_modal, "得意先選択");
    } else if (lastfocusin.slice(-11) == "ShouhinMrCd") { /* 商品コード選択 */
        modalstart(shouhin_mrs_modal, "商品選択");
    } else if (lastfocusin.slice(-3) == "Lot") { /* ロット別在庫選択 */
        let soukoCode = document.getElementById('fieldMotoSoukoMrCd').value;//倉庫絞込の為、コード取得
        //倉庫未選択時、モーダル表示しない。 Add By Nishiyama 2019/3/5
        if (soukoCode === '') {
            window.alert('移動元倉庫が未選択です。');
            return;
        }
        modalstart2(lot_zaiko_modal, "ロット別在庫", "?cd=" + $('#' + lastfocusin.slice(0, -3) + "ShouhinMrCd").val().replace('+', '%2B'), soukoCode);
    } else if (lastfocusin.slice(-8) == "Kobetucd") { /* 個別在庫選択 */
        let soukoCode = document.getElementById('fieldMotoSoukoMrCd').value;//倉庫絞込の為、コード取得
        //倉庫未選択時、モーダル表示しない。 Add By Nishiyama 2019/3/5
        if (soukoCode === '') {
            window.alert('移動元倉庫が未選択です。');
            return;
        }
        modalstart2(kobetu_zaiko_modal, "個別在庫", "?cd=" + $('#' + lastfocusin.slice(0, -8) + "ShouhinMrCd").val().replace('+', '%2B'), soukoCode);

    } else if (lastfocusin == "fieldHenkanbi") { /* 変換日選択 */
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

//
function modalstart2(url, title, para, soukoCode = '') {
    $('#iframe-title').text(title);
    $('#iframe-wrap').fadeIn();

    if (!para) {
        para = '?cd=' + $('#' + lastfocusin).val();
    }
    if (soukoCode !== '') {
        soukoCode = '&souko_mr_cd=' + soukoCode;
        $('#iframe-body').html('<iframe src="' + url + para + soukoCode + '" width="100%" height="100%" style="border: none;">');
    } else {
        $('#iframe-body').html('<iframe src="' + url + para + '" width="100%" height="100%" style="border: none;">');
    }

    $('#iframe-bg').fadeTo('normal', 0.5);
    $('#iframe-body iframe').load(function () {
        $(this).contents().find('#header, #footer').hide();
    });
    return false;
}

//=================================================================================================================

function modalstart1(url, title) {
    $('#iframe-title').text(title);
    $('#iframe-wrap').fadeIn();
    $('#iframe-body').html('<iframe src="" width="100%" height="100%" style="border: none;" name="iframe1">');
    $('#iframe-bg').fadeTo('normal', 0.5);
    $('#iframe-body iframe').load(function () {
        $(this).contents().find('#header, #footer').hide();
    });
    document.iframe1form.submit();
    return false;
}

$('#iframe-wrap button').click(function () { /* 中止して終わる (X) */
    $('#iframe-bg, #iframe-wrap').fadeOut();
});

function fromModal(retval, retsouko = '', zaikosuu = '', iro = '', iromei = '', hinsitu_kbn_cd = '') {
    //alert('親ページの関数が実行されました。');
    $('#iframe-wrap').fadeOut(
        function () {//alert("フェードアウト完了")
            if (retval) {
                $('#' + lastfocusin).val(retval);
                $('#' + lastfocusin).change();
            }
            var currntId = document.activeElement.id;
            var rowIndex = currntId.replace(/[^0-9^\.]/g, "");
            if (retsouko !== '') {
            }
            //LOT在庫数量
            if (zaikosuu !== '') {
                let zaiko = parseFloat(zaikosuu);
            }
            //色番
            if (iro !== '') {
                let iroID = '#fieldZaikoHenkanMeisaiDts' + rowIndex + 'Iro';
                $(iroID).val(iro);
            }
            //色名
            if (iromei !== '') {
                let iroName = '#fieldZaikoHenkanMeisaiDts' + rowIndex + 'Iromei';
                $(iroName).val(iromei);
            }
            if (hinsitu_kbn_cd !== '') {
                let hinshitu = '#fieldZaikoHenkanMeisaiDts' + rowIndex + 'HinsituKbnCd';
                $(hinshitu).val(hinsitu_kbn_cd);
                $(hinshitu +  'option[value=' + hinsitu_kbn_cd + ']').prop('selected',true);
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

function fromModalKobetu(retval) {
    var idmeisaif = 'fieldZaikoHenkanMeisaiDts';
    var jqmeisaif = '#' + idmeisaif;
    $('#iframe-wrap').fadeOut(
        function () {//alert("フェードアウト完了")
            if (retval.length > 0) {
                var i0 = 1 * lastfocusin.slice(0, -8).slice(25); //fieldZaikoHenkanMeisaiDts0Kobetucd 右から8桁消し左から25桁消す
                $('#' + lastfocusin).val(retval[0].kobetucd);
                $(jqmeisaif + i0 + 'Suuryou1').val(retval[0].suuryou1);
                $(jqmeisaif + i0 + 'Suuryou2').val(retval[0].suuryou2);
                $(jqmeisaif + i0 + 'HinsituKbnCd').val(retval[0].hinsitucd);
                $(jqmeisaif + i0 + 'Lot').val(retval[0].lot);
                $(jqmeisaif + i0 + 'Iro').val(retval[0].iroban);
                $(jqmeisaif + i0 + 'Iromei').val(retval[0].iromei);
                $(jqmeisaif + i0 + 'TanniMr1Cd').val(retval[0].tanni1cd);
                $(jqmeisaif + i0 + 'TanniMr2Cd').val(retval[0].tanni2cd);
                gyou_kingaku_saikeisan(idmeisaif + i0); // 行金額再計算
                for (var i = 1; i < retval.length; i++) {
                    var i1 = imax - 1;
                    $(jqmeisaif + i1 + 'UtiwakeKbnCd').val($(jqmeisaif + i0 + 'UtiwakeKbnCd').val());
                    $(jqmeisaif + i1 + 'ShouhinMrCd').val($(jqmeisaif + i0 + 'ShouhinMrCd').val());
                    $(jqmeisaif + i1 + 'Tekiyou').val($(jqmeisaif + i0 + 'Tekiyou').val());
                    $(jqmeisaif + i1 + 'TanniMr1Cd').val($(jqmeisaif + i0 + 'TanniMr1Cd').val());
                    $(jqmeisaif + i1 + 'TanniMr2Cd').val($(jqmeisaif + i0 + 'TanniMr2Cd').val());
                    $(jqmeisaif + i1 + 'Irisuu').val($(jqmeisaif + i0 + 'Irisuu').val());
                    $(jqmeisaif + i1 + 'TankaKbn').val($(jqmeisaif + i0 + 'TankaKbn').val());
                    $(jqmeisaif + i1 + 'ZaikoKbn').val($(jqmeisaif + i0 + 'ZaikoKbn').val());
                    $(jqmeisaif + i1 + 'Tanka').val($(jqmeisaif + i0 + 'Tanka').val());
                    $(jqmeisaif + i1 + 'Kobetucd').val(retval[i].kobetucd);
                    $(jqmeisaif + i1 + 'Suuryou1').val(retval[i].suuryou1);
                    $(jqmeisaif + i1 + 'Suuryou2').val(retval[i].suuryou2);
                    $(jqmeisaif + i1 + 'HinsituKbnCd').val(retval[i].hinsitucd);
                    $(jqmeisaif + i1 + 'Lot').val(retval[i].lot);
                    $(jqmeisaif + i1 + 'Iro').val(retval[i].iroban);
                    $(jqmeisaif + i1 + 'Iromei').val(retval[i].iromei);
                    $(jqmeisaif + i1 + 'TanniMr1Cd').val(retval[i].tanni1cd);
                    $(jqmeisaif + i1 + 'TanniMr2Cd').val(retval[i].tanni2cd);
                    $(jqmeisaif + i1 + 'TanniMr1Cd').change();
                    gyou_kingaku_saikeisan(idmeisaif + i1); // 行金額再計算
                    addZaikoHenkanMeisaiDt();//新規行を追加
                }
                denpyou_goukei_saikeisan();
            }
        }
    );
    $('#iframe-bg').fadeOut();
    $('#' + lastfocusin).focus().select();
}

/* 画面内計算 */
$("#fieldZaikoHenkanKbnCd").change(function () { // 変換区分が変更されたら
    if ($(this).val() == "1") { // 生産
        $('#form1 [name=denpyou_mr_cd]').val('seisan');
        $("#fieldZaikoHenkanMeisaiDts0HenkansakiFlg").val("1").disableSelection(); // 1行目は変換先
        for (i = 1; i < imax; i++) {
            $("#fieldZaikoHenkanMeisaiDts" + i + "HenkansakiFlg").val("0").disableSelection(); // 2行目以降は変換元
        }
    } else if ($(this).val() == "2" || $(this).val() == "7") { // 倉庫移動は全て2共通
        $('#form1 [name=denpyou_mr_cd]').val('soukoidou');
        for (i = 0; i < imax; i++) {
            $("#fieldZaikoHenkanMeisaiDts" + i + "HenkansakiFlg").val("2").disableSelection();
        }
        $("#fieldTantouMrCd").enableSelection();
        $("#fieldSoukoMrCd").enableSelection();
    } else if ($(this).val() == "3") { // 出庫は全て0変換元
        $('#form1 [name=denpyou_mr_cd]').val('shukko');
        for (i = 0; i < imax; i++) {
            $("#fieldZaikoHenkanMeisaiDts" + i + "HenkansakiFlg").val("0").disableSelection();
        }
    } else if ($(this).val() == "4") { // 商品コード変更単位変換
        $('#form1 [name=denpyou_mr_cd]').val('shouhinhenkou');
        for (i = 0; i < 1; i++) {
            $("#fieldZaikoHenkanMeisaiDts" + i + "HenkansakiFlg").val(i % 2).enableSelection(); // 変更2019/7/22井浦:1行目だけ元。以後変更前…1行目など奇数行は0変換元、2行目など偶数行は1変換先
        }
    } else if ($(this).val() == "5") { // 導入時在庫は全て1変換先
        $('#form1 [name=denpyou_mr_cd]').val('dounyuu');
        for (i = 0; i < imax; i++) {
            $("#fieldZaikoHenkanMeisaiDts" + i + "HenkansakiFlg").val("1").disableSelection();
        }
        $("#fieldTantouMrCd").enableSelection();
        $("#fieldSoukoMrCd").enableSelection();
    } else if ($(this).val() == "6") { // 預り調整は全て0変換元
        $('#form1 [name=denpyou_mr_cd]').val('azuchou');
        for (i = 0; i < imax; i++) {
            $("#fieldZaikoHenkanMeisaiDts" + i + "HenkansakiFlg").val("0").disableSelection();
        }
    }

    $("#fieldTokuisakiMrCd").attr("readonly", $(this).val() != "3" && $(this).val() != "6" && $(this).val() != "7");
    if ($(this).val() != "3" && $(this).val() != "6" && $(this).val() != "7") {
        $("#fieldTokuisakiMrCd").val("");
        $("#fieldTokuisakiMrName").val("");
    }
    $("#fieldTantouMrCd").attr("readonly", ($(this).val() != "2" && $(this).val() != "7"));
    $("#fieldSoukoMrCd").attr("readonly", ($(this).val() != "2" && $(this).val() != "7"));
    if ($(this).val() != "2" && $(this).val() != "7") {
        $("#fieldTantouMrCd").val($("#fieldMotoTantouMrCd").val());
        $("#fieldSoukoMrCd").val($("#fieldMotoSoukoMrCd").val());
        $("#fieldTantouMrCd").disableSelection();
        $("#fieldSoukoMrCd").disableSelection();
    }
});

$("#fieldMotoTantouMrCd").change(function () { // 担当が変更されたら
    if ($("#fieldTantouMrCd").attr('readonly') == 'readonly' || $("#fieldTantouMrCd").val() == "") { // 先担当が選択できないか空白の時
        $("#fieldTantouMrCd").val($(this).val());
    }
});

$("#fieldMotoSoukoMrCd").change(function () { // 倉庫が変更されたら
    if ($("#fieldSoukoMrCd").attr('readonly') == 'readonly' || $("#fieldSoukoMrCd").val() == "") { // 先倉庫が選択できないか空白の時
        $("#fieldSoukoMrCd").val($(this).val());
    }
});

$("[id$='Irisuu']").change(function () { // 入数が変更されたら
    var idleft = $(this).attr("id").slice(0, -6); // fieldZaikoHenkanMeisaiDts0Irisuu 右から6桁消す
    if ($(this).val() * 1 !== 0) {
        $("#" + idleft + "Suuryou2").val(1 * $(this).val() * $("#" + idleft + "Suuryou1").val());
        $("#" + idleft + "Suuryou2").change();
    }
});

$("[id$='Suuryou1']").change(function () { //数量1が変更されたら
    var idleft = $(this).attr("id").slice(0, -8); //fieldZaikoHenkanMeisaiDts0Suuryou1 右から5桁消す
    var suu1 = 1 * $(this).val().replace(/,/g, '');
    if (idleft == 'fieldZaikoHenkanMeisaiDts0' && $("#fieldZaikoHenkanKbnCd").val() == "1" && $("#" + idleft + "ZaikoKbn").val() == 1) { // 生産の製品数量が変更されたら
        for (var i = 1; i < imax - 1; i++) {
            var zaiko_kbn = $('#fieldZaikoHenkanMeisaiDts' + i + 'ZaikoKbn').val();
            $('#fieldZaikoHenkanMeisaiDts' + i + 'Suuryou' + zaiko_kbn).val(suu1 * $('#fieldZaikoHenkanMeisaiDts' + i + 'KouseiSuuryou').val());
            $('#fieldZaikoHenkanMeisaiDts' + i + 'Suuryou' + zaiko_kbn).change();
        }
    }
    if (suu1 !== 0) {
        $("#" + idleft + "Suuryou2").val(suu1 * $("#" + idleft + "Irisuu").val());
        $("#" + idleft + "Suuryou2").change();
    }
    var sh1 = $("#" + idleft + "Suu1Shousuu").val(); // 小数桁を揃える
    $(this).val(Intl.NumberFormat("ja-JP", {minimumFractionDigits: sh1, maximumFractionDigits: sh1}).format(suu1)); // カンマ編集
    if ($("#" + idleft + "TankaKbn").val() == 1) {
        gyou_kingaku_saikeisan(idleft); // 行金額再計算
        denpyou_goukei_saikeisan(); // 伝票合計再計算
    }
    $("#" + idleft + "Suuryou2").change();
});

$("[id$='Suuryou2']").change(function () { // 数量2が変更されたら
    var idleft = $(this).attr("id").slice(0, -8); // fieldZaikoHenkanMeisaiDts0Suuryou2 右から7桁消す
    gyou_suuryou_change(idleft);
    gyou_kingaku_saikeisan(idleft); // 行金額再計算
    denpyou_goukei_saikeisan(); // 伝票合計再計算
});

function gyou_suuryou_change(idleft) {
    var jqleft = '#' + idleft;
    var suu2 = 1 * $(jqleft + 'Suuryou2').val().replace(/,/g, '');//カンマ編集を一旦戻す
    sh2 = $(jqleft + "Suu2Shousuu").val(); // 小数桁を揃える
    $(jqleft + 'Suuryou2').val(Intl.NumberFormat("ja-JP", {
        minimumFractionDigits: sh2,
        maximumFractionDigits: sh2
    }).format(suu2));//カンマ編集
}

function gyou_kingaku_saikeisan(idleft) { // 行金額再計算
    var suufld = $("#" + idleft + "Suuryou" + $("#" + idleft + "TankaKbn").val());
    $("#" + idleft + "Kingaku").val(Math.round(1000 * suufld.val().replace(/,/g, '')) * Math.round(1000 * $("#" + idleft + "Tanka").val().replace(/,/g, '')) / 1000000); //金額=数量*単価
    gyou_kingaku_kanma(idleft); // 行金額端数処理カンマ編集
}

$("[id$='Tanka']").change(function () { // 単価が変更されたら
    var idleft = $(this).attr("id").slice(0, -5); //fieldZaikoHenkanMeisaiDts0Tanka 右から5桁消す
    $(this).val($(this).val().replace(/,/g, '')); // カンマ編集を一旦戻す
    sh2 = $("#" + idleft + "TankaShousuu").val();
    if ($("#" + idleft + "MotoTanniMr2Cd").val() == $("#" + idleft + "TanniMr2Cd").val()) {
        sh1 = sh2;
    } else {
        sh1 = 0;
    }
    $(this).val(Intl.NumberFormat("ja-JP", {
        minimumFractionDigits: sh1,
        maximumFractionDigits: sh2
    }).format($(this).val())); // カンマ編集
    gyou_kingaku_saikeisan(idleft); // 行金額再計算
    denpyou_goukei_saikeisan(); // 伝票合計再計算
});

$("[id$='TankaKbn']").change(function () { // 単価区分が変更されたら
    var idleft = $(this).attr("id").slice(0, -8); //fieldZaikoHenkanMeisaiDts0TankaKbn 右から8桁消す
    gyou_kingaku_saikeisan(idleft); // 行金額再計算
    denpyou_goukei_saikeisan(); // 伝票合計再計算
});

$("[id$='Kingaku']").change(function () { // 金額が変更されたら
    var idleft = $(this).attr("id").slice(0, -7); // fieldZaikoHenkanMeisaiDts0Kingaku 右から7桁消す
    gyou_kingaku_kanma(idleft); // 行金額端数処理カンマ編集
    denpyou_goukei_saikeisan(); // 伝票合計再計算
});

function gyou_kingaku_kanma(idleft) { // 行金額端数処理カンマ編集
    var kingaku = 1.0 * $("#" + idleft + "Kingaku").val().replace(/,/g, ''); //カンマ編集を一旦戻す
    kingaku = Math.round(kingaku);//四捨五入
    $("#" + idleft + "Kingaku").val(Intl.NumberFormat("ja-JP", {
        minimumFractionDigits: 0,
        maximumFractionDigits: 0
    }).format(kingaku)); // カンマ編集
}

function denpyou_goukei_saikeisan() { // 伝票合計再計算
    goukeigaku = 0;
    for (i = 0; i < imax; i++) {
        if ($('#fieldZaikoHenkanMeisaiDts' + i + 'HenkansakiFlg').val() == 0) { // 変換元の集計
            goukeigaku += 1 * $('#fieldZaikoHenkanMeisaiDts' + i + 'Kingaku').val().replace(/,/g, '');
        }
    }
    $("#fieldGoukeigaku").val(Intl.NumberFormat("ja-JP", {
        minimumFractionDigits: 0,
        maximumFractionDigits: 0
    }).format(goukeigaku)); // カンマ編集
}

$("[id$='ShouhinMrCd']").focusin(function (e) { //商品在庫索引
    if ($(this).val() == '') {
        $('#fieldGenzaiko').val('');
    } else {
        try {
            var souko_cd = $("#fieldMotoSoukoMrCd").val();
        } catch (e) {
            console.log('倉庫空白');
        }

        if (typeof souko_cd !== "undefined") {
            getZaiko($(this).val(), souko_cd);
        } else {
            getZaiko($(this).val(), '');
        }
    }
});
$("[id$='TanniMr1Cd']").change(function () { //単位1が変更されたら
    var idleft = $(this).attr("id").slice(0, -10); //fieldZaikoHenkanMeisaiDts0TanniMr1Cd 右から10桁消す
    var jqleft = '#' + idleft;
    var tanka_kbn = $(jqleft + 'TankaKbn');
    var tanka_kbn_sel = tanka_kbn.val();
    tanka_kbn.children().remove();
    tanka_kbn.append($("<option>").val('1').text('/' + $(jqleft + 'TanniMr1Cd option:selected').text()));
    tanka_kbn.append($("<option>").val('2').text('/' + $(jqleft + 'TanniMr2Cd option:selected').text()));
    tanka_kbn.val(tanka_kbn_sel);
});


$("[id$='ShouhinMrCd']").dblclick(function () { //商品マスター索引
    $(this).change();
});

function getZaiko(shouhinCd, souko_cd) {
    if (shouhinCd === '') {
        $('#fieldGenzaiko').val('');
    } else {
        $.ajax({
            type: "POST",
            url: report_zaiko_vws_ajaxGet,
            data: {'cd': shouhinCd, 'souko': souko_cd,},
            async: true,
            dataType: 'json',
            success: function (data) {
                $('#fieldGenzaiko').val(data[0]);
                $('#fieldGenzaiko1').val(data[1]);
            },
            error: function (xhr, status, err) {
                console.log('Error : Cd.change.ajax => ' + status + '/' + err);
            },
        });

    }
}

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
            //ドラッグ中による列幅変更。
            var th_width = e.clientX - parseInt($(drag_target).offset().left);
            if (th_width < 10) {
                th_width = 10;
            }
            if (drag_target.hasClass('ot-fixed')) {
                $('.ot-fixed').css({width: th_width + 'px'});
            } else {
                drag_target.css({width: th_width + 'px'});
            }
            //tableのサイズも変更する。
            var tbl_new_width = tbl_width - org_width + th_width;
            $(sheet_nm).css({width: tbl_new_width + 'px'});
            return false;
        }
        return true;
    });//[[ mousemove
    $(sheet_nm + " th").mousemove(function (e) {
        var right = parseInt($(this).offset().left) + parseInt($(this).css("width"));
        //マウスカーソルの図柄変更。
        if ((right - 10) < e.clientX) {
            if (e.clientX < (right + 10)) {
                //右端に位置する場合はリサイズカーソルにする。
                $(this).css({cursor: 'col-resize'});
                return false;
            }
        }
        $(this).css({cursor: 'default'});
        return true;
    });//[[ mousemove
    $(sheet_nm + " th").mousedown(function (e) {
        //マウスカーソルの図柄変更。
        if ($(this).css('cursor') == 'col-resize') {
            //ドラッグ開始。
            drag_target = $(this);
            $(document.body).css({cursor: 'col-resize'});
            tbl_width = $(sheet_nm).width();
            org_width = $(this).width() + 1;
            return false;
        }
        return true;
    });//[[ mousedown
    $(window).mouseup(function (e) {
        //ドラッグ解除。
        drag_target = null;
        $(document.body).css({cursor: ''});
        var tbl_new_width = 0;
    });//[[ mouseup
})(jQuery); //[[ onload.


function switch_roa(fieldx) { // 項目制御readonly設定(主)
    if ($("#field" + fieldx).attr("readonly") === "readonly") {
        $("#field" + fieldx).removeAttr("readonly");
    } else {
        $("#field" + fieldx).attr("readonly", "readonly");
    }
    $targetElm = $(targetElm);
}

function switch_ros(fieldx) { // 項目制御readonly設定(明細)
    if ($("#hidden" + fieldx).attr("readonly") === "readonly") {
        $("#hidden" + fieldx).removeAttr("readonly");
        for (var i = 0; i < imax; i++) {
            $("#fieldZaikoHenkanMeisaiDts" + i + fieldx).removeAttr("readonly");
        }
    } else {
        $("#hidden" + fieldx).attr("readonly", "readonly");
        for (var i = 0; i < imax; i++) {
            $("#fieldZaikoHenkanMeisaiDts" + i + fieldx).attr("readonly", "readonly");
        }
    }
    $targetElm = $(targetElm);
}

var ro_fields = [
    'henkanbi', 'cd', 'sasizu_dt_cd', 'name',
    '[cd', '[henkansaki_flg', '[shouhin_mr_cd', '[tekiyou', '[lot', '[kobetucd', '[hinsitu_kbn_cd', '[irisuu', '[iro', '[iromei', '[suuryou1',
    '[tanni_mr1_cd', '[suuryou2', '[tanni_mr2_cd', '[tanka', '[tanka_kbn', '[kingaku', '[bikou'
]; // 閉じ角カッコはajaxで渡すときに欠落するので初めから入れない。

function save_ros() {
    $("#save_ros").text("(→「入力制御の保存中!....」)").css('color', 'red');
    var readonlys = {}; // 連想配列初期化
    var rewidths = {}; // 連想配列初期化
    for (var j in ro_fields) {
        var ro_field_name = ro_fields[j];
        if (ro_fields[j].substr(0, 1) == '[') {
            ro_field_name = 'hidden' + ro_fields[j] + ']';
        }
        readonlys[ro_fields[j]] = $("[name='" + ro_field_name + "']").attr('readonly') === 'readonly';
        if (ro_fields[j].substr(0, 1) == '[') {
            ro_field_name = 'data[zaiko_henkan_meisai_dts][0]' + ro_fields[j] + ']';
            rewidths[ro_fields[j]] = $("[name='" + ro_field_name + "']").outerWidth();
        }
    }
    $.ajax({
        type: "POST",
        url: readonlys_ajaxSave,
        data: {
            'controller_cd': 'ZaikoHenkanDts',
            'gamen_cd': 'inputfields',
            'readonlys': readonlys,
            'rewidths': rewidths,
        },
        async: true,
        dataType: 'json',
        success: function (error_count) {
            //	alert('入力制御の保存完了！'+error_count);
            $("#save_ros").text('(click→「入力制御の保存」)').css('color', 'pink');
        },
        error: function (xhr, status, err) {
            alert('入力制御の保存でエラー Cd.change.ajax ' + status + '/' + err);
            $("#save_ros").text('(click→「入力制御の保存」)').css('color', 'pink');
        },
    });
}

//最終入力チェック
function final_check() {
    $("#F12").focus();
    if (!final_sime_check()) return false; //締済チェック
    // if (!zaiko_henkan_check()) return false;
    make_mesaitable();  //在庫チェック
    return false;
}

function before_delete_check() {
    if (!final_sime_check()) return false;
    var res = confirm('削除してもよろしいですか？');
    if (res) return true;
}

//商品コード変換伝票で数量や金額を変更する処理がされていないかの確認
function zaiko_henkan_check() {
    if ($('#fieldZaikoHenkanKbnCd').val() !== '4') return true;

    var jqleft = '#fieldZaikoHenkanMeisaiDts';
    for (var i = 0; i < (imax - 1); i++) {
        if (i % 2 === 0) {
            var moto_tani1 = $(jqleft + i + "TanniMr1Cd  option:selected").text();
            var moto_tani2 = $(jqleft + i + "TanniMr2Cd  option:selected").text();
            var moto_suu1 = $(jqleft + i + "Suuryou1").val();
            var moto_suu2 = $(jqleft + i + "Suuryou2").val();
            var moto_tanka = $(jqleft + i + "Tanka").val();
            var moto_kingaku = $(jqleft + i + "Kingaku").val();
        } else {
            var saki_tani1 = $(jqleft + i + "TanniMr1Cd  option:selected").text();
            var saki_tani2 = $(jqleft + i + "TanniMr2Cd  option:selected").text();
            var saki_suu1 = $(jqleft + i + "Suuryou1").val();
            var saki_suu2 = $(jqleft + i + "Suuryou2").val();
            var saki_tanka = $(jqleft + i + "Tanka").val();
            var saki_kingaku = $(jqleft + i + "Kingaku").val();

            //数量比較は単位が変わる場合、計算誤差でずれるので今は抜いておく
            // if (moto_tani1 === 'kg' || moto_tani1 === 'K' || moto_tani1 === 'lb' || moto_tani1 === 'LB' || moto_tani1 === 'M' || moto_tani1 === 'yd' || moto_tani1 === 'Y') {
            //     if (moto_tani1 !== saki_tani1) {
            //         if (unit_conversion(moto_tani1, saki_tani1, saki_suu1) === moto_suu1) {
            //             window.alert('単位変換後の数量1が一致しません。');
            //             return false;
            //         }
            //     }
            // }
            // if (moto_tani2 === 'kg' || moto_tani2 === 'K' || moto_tani2 === 'lb' || moto_tani2 === 'LB' || moto_tani2 === 'M' || moto_tani2 === 'yd' || moto_tani2 === 'Y') {
            //     if (moto_tani2 !== saki_tani2) {
            //         if (unit_conversion(moto_tani2, saki_tani2, saki_suu2) === moto_suu2) {
            //             window.alert('単位変換後の数量2が一致しません。');
            //             return false;
            //         }
            //     }
            // }
            // if (moto_suu1 !== "" && saki_suu1 !== "" && moto_suu1 !== saki_suu1) {
            //     window.alert('コード変換の元数1と先数1が一致しません。');
            //     return false;
            // }
            //
            // if (moto_suu2 !== "" && saki_suu2 !== "" && moto_suu2 !== saki_suu2) {
            //     window.alert('コード変換の元数2と先数2が一致しません。');
            //     return false;
            // }
            if (moto_tanka !== "" && saki_tanka !== "" && moto_tanka !== saki_tanka) {
                window.alert('コード変換の元単価と先単価が一致しません。');
                return false;
            }
            if (moto_kingaku !== "" && saki_kingaku !== "" && moto_kingaku !== saki_kingaku) {
                window.alert('コード変換の元金額と先金額が一致しません。');
                return false;
            }
        }
    }
    return true;
}

/*
 単位変換した数量を返す(四捨五入)
    1lb = 0.45359237kg
    1yd = 0.9144m
    1kg = 2.20462lb
    1m  = 1.09361yd
 */
function unit_conversion(moto_tani, saki_tani, henkan_motosuu) {
    let ret_val = 0;
    switch (moto_tani) {
        case 'kg':
        case 'K':
            switch (saki_tani) {
                case 'lb':
                case 'LB':
                    ret_val = Math.round((henkan_motosuu * 2.20462) * 100) / 100;
                    break;
            }

            break;
        case 'M':
            switch (saki_tani) {
                case 'yd':
                case 'Y':
                    ret_val = Math.round((henkan_motosuu * 1.09361) * 100) / 100;
                    break;
            }
            break;
        case 'lb':
        case 'LB':
            switch (saki_tani) {
                case 'kg':
                case 'K':
                    ret_val = Math.round((henkan_motosuu * 0.45359237) * 100) / 100;
                    break;
            }

            break;
        case 'yd':
        case 'Y':
            if (saki_tani === 'M') {
                ret_val = Math.round((henkan_motosuu * 0.9144) * 100) / 100;
            }
            break;
    }
    return ret_val;
}

function final_sime_check() {
    var ymd = $('#fieldHenkanbi').val().split('-');
    if (ymd.length != 3) {
        $("#dispErrMsg").text("変換日付区切り記号が正しくありません!!");
        return false;
    }
    var date = new Date(ymd[0], ymd[1] - 1, ymd[2]);
    if (ymd[0] != date.getFullYear() ||
        ymd[1] != ('0' + (date.getMonth() + 1)).slice(-2) ||
        ymd[2] != ('0' + date.getDate()).slice(-2)) {
        $("#dispErrMsg").text("変換日付年月日が正しくありません!!");
        return false;
    }
    if ($('#fieldHenkanbi').val() <= $("#fieldSimezumibi").val()) {
        $("#dispErrMsg").text("締済なので登録・変更できません!!");
        return false;
    }
    $("#dispErrMsg").text("");
    return true;
}

//最終在庫チェック(作成中)
var moto_meisaitable = {};
var saki_meisaitable = {};
var azukari_meisaitable = {};

function make_mesaitable() {
    var jqleft = '#fieldZaikoHenkanMeisaiDts';
    var henkan_kbn = $("#fieldZaikoHenkanKbnCd").val(); //変換区分
    var cd = '';
    var lot = '';
    var hinshitu = '';
    var iro = '';
    var iromei = '';
    var moto_souko = $("#fieldMotoSoukoMrCd").val();    //移動元倉庫
    var saki_souko = $("#fieldSoukoMrCd").val();        //移動先倉庫
    var dic_key = 'key';
    //科目ごとに集計
    switch (henkan_kbn) {
        case '2':   //倉庫移動
            for (let i = 0; i < imax - 1; i++) {
                switch ($(jqleft + i + 'HenkansakiFlg').val()) {
                    case '0':   //もと
                        cd = $(jqleft + i + 'ShouhinMrCd').val();
                        lot = $(jqleft + i + 'Lot').val();
                        hinshitu = $(jqleft + i + 'HinsituKbnCd').val();
                        iro = $(jqleft + i + 'Iro').val();
                        iromei = $(jqleft + i + 'Iromei').val();
                        if (typeof iro === 'undefined') {
                            iro = '';
                        }
                        if (typeof iromei === 'undefined') {
                            iromei = '';
                        }
                        dic_key = cd + "," + lot + "," + moto_souko + "," + hinshitu + "," + iro + "," + iromei;
                        if (!(dic_key in moto_meisaitable)) {
                            moto_meisaitable[dic_key] = [cd, lot, moto_souko, hinshitu, iro, iromei, 0.00, 0.00];
                        }
                        moto_meisaitable[dic_key][6] += -1 * $(jqleft + i + 'Suuryou1').val().replace(/,/g, '');
                        moto_meisaitable[dic_key][7] += -1 * $(jqleft + i + 'Suuryou2').val().replace(/,/g, '');
                        break;
                    case '1':   //先
                        cd = $(jqleft + i + 'ShouhinMrCd').val();
                        lot = $(jqleft + i + 'Lot').val();
                        hinshitu = $(jqleft + i + 'HinsituKbnCd').val();
                        iro = $(jqleft + i + 'Iro').val();
                        iromei = $(jqleft + i + 'Iromei').val();
                        if (typeof iro === 'undefined') {
                            iro = '';
                        }
                        if (typeof iromei === 'undefined') {
                            iromei = '';
                        }
                        dic_key = cd + "," + lot + "," + saki_souko + "," + hinshitu + "," + iro + "," + iromei;
                        if (!(dic_key in saki_meisaitable)) {
                            saki_meisaitable[dic_key] = [cd, lot, saki_souko, hinshitu, iro, iromei, 0.00, 0.00];
                        }
                        saki_meisaitable[dic_key][6] += 1 * $(jqleft + i + 'Suuryou1').val().replace(/,/g, '');
                        saki_meisaitable[dic_key][7] += 1 * $(jqleft + i + 'Suuryou2').val().replace(/,/g, '');
                        break;
                    case '2':   //共通
                        cd = $(jqleft + i + 'ShouhinMrCd').val();
                        lot = $(jqleft + i + 'Lot').val();
                        hinshitu = $(jqleft + i + 'HinsituKbnCd').val();
                        iro = $(jqleft + i + 'Iro').val();
                        iromei = $(jqleft + i + 'Iromei').val();
                        if (typeof iro === 'undefined') {
                            iro = '';
                        }
                        if (typeof iromei === 'undefined') {
                            iromei = '';
                        }
                        dic_key = cd + "," + lot + "," + saki_souko + "," + hinshitu + "," + iro + "," + iromei;
                        if (!(dic_key in saki_meisaitable)) {
                            saki_meisaitable[dic_key] = [cd, lot, saki_souko, hinshitu, iro, iromei, 0.00, 0.00];
                        }
                        saki_meisaitable[dic_key][6] += 1 * $(jqleft + i + 'Suuryou1').val().replace(/,/g, '');
                        saki_meisaitable[dic_key][7] += 1 * $(jqleft + i + 'Suuryou2').val().replace(/,/g, '');

                        dic_key = cd + "," + lot + "," + moto_souko + "," + hinshitu + "," + iro + "," + iromei;
                        if (!(dic_key in moto_meisaitable)) {
                            moto_meisaitable[dic_key] = [cd, lot, moto_souko, hinshitu, iro, iromei, 0.00, 0.00];
                        }
                        moto_meisaitable[dic_key][6] += -1 * $(jqleft + i + 'Suuryou1').val().replace(/,/g, '');
                        moto_meisaitable[dic_key][7] += -1 * $(jqleft + i + 'Suuryou2').val().replace(/,/g, '');
                        break;
                }
            }
            break;
        case '3':   //出庫調整
            for (let i = 0; i < imax - 1; i++) {
                switch ($(jqleft + i + 'HenkansakiFlg').val()) {
                    case '0':   //もと
                        cd = $(jqleft + i + 'ShouhinMrCd').val();
                        lot = $(jqleft + i + 'Lot').val();
                        hinshitu = $(jqleft + i + 'HinsituKbnCd').val();
                        iro = $(jqleft + i + 'Iro').val();
                        iromei = $(jqleft + i + 'Iromei').val();
                        if (typeof iro === 'undefined') {
                            iro = '';
                        }
                        if (typeof iromei === 'undefined') {
                            iromei = '';
                        }
                        dic_key = cd + "," + lot + "," + moto_souko + "," + hinshitu + "," + iro + "," + iromei;
                        if (!(dic_key in moto_meisaitable)) {
                            moto_meisaitable[dic_key] = [cd, lot, moto_souko, hinshitu, iro, iromei, 0.00, 0.00];
                        }
                        moto_meisaitable[dic_key][6] += -1 * $(jqleft + i + 'Suuryou1').val().replace(/,/g, '');
                        moto_meisaitable[dic_key][7] += -1 * $(jqleft + i + 'Suuryou2').val().replace(/,/g, '');
                        break;
                    case '1':   //先
                        cd = $(jqleft + i + 'ShouhinMrCd').val();
                        lot = $(jqleft + i + 'Lot').val();
                        hinshitu = $(jqleft + i + 'HinsituKbnCd').val();
                        iro = $(jqleft + i + 'Iro').val();
                        iromei = $(jqleft + i + 'Iromei').val();
                        if (typeof iro === 'undefined') {
                            iro = '';
                        }
                        if (typeof iromei === 'undefined') {
                            iromei = '';
                        }
                        dic_key = cd + "," + lot + "," + saki_souko + "," + hinshitu + "," + iro + "," + iromei;
                        if (!(dic_key in saki_meisaitable)) {
                            saki_meisaitable[dic_key] = [cd, lot, saki_souko, hinshitu, iro, iromei, 0.00, 0.00];
                        }
                        saki_meisaitable[dic_key][6] += 1 * $(jqleft + i + 'Suuryou1').val().replace(/,/g, '');
                        saki_meisaitable[dic_key][7] += 1 * $(jqleft + i + 'Suuryou2').val().replace(/,/g, '');
                        break;
                    case '2':   //共通
                        cd = $(jqleft + i + 'ShouhinMrCd').val();
                        lot = $(jqleft + i + 'Lot').val();
                        hinshitu = $(jqleft + i + 'HinsituKbnCd').val();
                        iro = $(jqleft + i + 'Iro').val();
                        iromei = $(jqleft + i + 'Iromei').val();
                        if (typeof iro === 'undefined') {
                            iro = '';
                        }
                        if (typeof iromei === 'undefined') {
                            iromei = '';
                        }
                        dic_key = cd + "," + lot + "," + saki_souko + "," + hinshitu + "," + iro + "," + iromei;
                        if (!(dic_key in saki_meisaitable)) {
                            saki_meisaitable[dic_key] = [cd, lot, saki_souko, hinshitu, iro, iromei, 0.00, 0.00];
                        }

                        saki_meisaitable[dic_key][6] += 1 * $(jqleft + i + 'Suuryou1').val().replace(/,/g, '');
                        saki_meisaitable[dic_key][7] += 1 * $(jqleft + i + 'Suuryou2').val().replace(/,/g, '');


                        dic_key = cd + "," + lot + "," + moto_souko + "," + hinshitu + "," + iro + "," + iromei;
                        if (!(dic_key in moto_meisaitable)) {
                            moto_meisaitable[dic_key] = [cd, lot, moto_souko, hinshitu, iro, iromei, 0.00, 0.00];
                        }
                        moto_meisaitable[dic_key][6] += -1 * $(jqleft + i + 'Suuryou1').val().replace(/,/g, '');
                        moto_meisaitable[dic_key][7] += -1 * $(jqleft + i + 'Suuryou2').val().replace(/,/g, '');
                        break;
                }
            }
            break;
        case '4':   //商品コード変更
            for (let i = 0; i < imax - 1; i++) {
                switch ($(jqleft + i + 'HenkansakiFlg').val()) {
                    case '0':   //もと
                        cd = $(jqleft + i + 'ShouhinMrCd').val();
                        lot = $(jqleft + i + 'Lot').val();
                        hinshitu = $(jqleft + i + 'HinsituKbnCd').val();
                        iro = $(jqleft + i + 'Iro').val();
                        iromei = $(jqleft + i + 'Iromei').val();
                        if (typeof iro === 'undefined') {
                            iro = '';
                        }
                        if (typeof iromei === 'undefined') {
                            iromei = '';
                        }
                        dic_key = cd + "," + lot + "," + moto_souko + "," + hinshitu + "," + iro + "," + iromei;
                        if (!(dic_key in moto_meisaitable)) {
                            moto_meisaitable[dic_key] = [cd, lot, moto_souko, hinshitu, iro, iromei, 0.00, 0.00];
                        }
                        moto_meisaitable[dic_key][6] += -1 * $(jqleft + i + 'Suuryou1').val().replace(/,/g, '');
                        moto_meisaitable[dic_key][7] += -1 * $(jqleft + i + 'Suuryou2').val().replace(/,/g, '');
                        break;
                    case '1':   //先
                        cd = $(jqleft + i + 'ShouhinMrCd').val();
                        lot = $(jqleft + i + 'Lot').val();
                        hinshitu = $(jqleft + i + 'HinsituKbnCd').val();
                        iro = $(jqleft + i + 'Iro').val();
                        iromei = $(jqleft + i + 'Iromei').val();
                        if (typeof iro === 'undefined') {
                            iro = '';
                        }
                        if (typeof iromei === 'undefined') {
                            iromei = '';
                        }
                        dic_key = cd + "," + lot + "," + saki_souko + "," + hinshitu + "," + iro + "," + iromei;
                        if (!(dic_key in saki_meisaitable)) {
                            saki_meisaitable[dic_key] = [cd, lot, saki_souko, hinshitu, iro, iromei, 0.00, 0.00];
                        }
                        saki_meisaitable[dic_key][6] += 1 * $(jqleft + i + 'Suuryou1').val().replace(/,/g, '');
                        saki_meisaitable[dic_key][7] += 1 * $(jqleft + i + 'Suuryou2').val().replace(/,/g, '');
                        break;
                    case '2':   //共通
                        cd = $(jqleft + i + 'ShouhinMrCd').val();
                        lot = $(jqleft + i + 'Lot').val();
                        hinshitu = $(jqleft + i + 'HinsituKbnCd').val();
                        iro = $(jqleft + i + 'Iro').val();
                        iromei = $(jqleft + i + 'Iromei').val();
                        if (typeof iro === 'undefined') {
                            iro = '';
                        }
                        if (typeof iromei === 'undefined') {
                            iromei = '';
                        }
                        dic_key = cd + "," + lot + "," + saki_souko + "," + hinshitu + "," + iro + "," + iromei;
                        if (!(dic_key in saki_meisaitable)) {
                            saki_meisaitable[dic_key] = [cd, lot, saki_souko, hinshitu, iro, iromei, 0.00, 0.00];
                        }

                        saki_meisaitable[dic_key][6] += 1 * $(jqleft + i + 'Suuryou1').val().replace(/,/g, '');
                        saki_meisaitable[dic_key][7] += 1 * $(jqleft + i + 'Suuryou2').val().replace(/,/g, '');


                        dic_key = cd + "," + lot + "," + moto_souko + "," + hinshitu + "," + iro + "," + iromei;
                        if (!(dic_key in moto_meisaitable)) {
                            moto_meisaitable[dic_key] = [cd, lot, moto_souko, hinshitu, iro, iromei, 0.00, 0.00];
                        }
                        moto_meisaitable[dic_key][6] += -1 * $(jqleft + i + 'Suuryou1').val().replace(/,/g, '');
                        moto_meisaitable[dic_key][7] += -1 * $(jqleft + i + 'Suuryou2').val().replace(/,/g, '');
                        break;
                }
            }
            break;
        case '6':   //預り調整
            var tokuisaki_mr_cd = $("#fieldTokuisakiMrCd").val();   //得意先
            for (let i = 0; i < imax - 1; i++) {
                shouhin_mr_cd = $(jqleft + i + 'ShouhinMrCd').val();
                dic_key = shouhin_mr_cd.trim();
                if (!(dic_key in azukari_meisaitable)) {
                    azukari_meisaitable[dic_key] = [shouhin_mr_cd, tokuisaki_mr_cd, 0.00, 0.00];
                }
                switch ($(jqleft + i + 'HenkansakiFlg').val()) {
                    case '0':  //もと
                        azukari_meisaitable[dic_key][2] += -1 * $(jqleft + i + 'Suuryou1').val().replace(/,/g, '');
                        azukari_meisaitable[dic_key][3] += -1 * $(jqleft + i + 'Suuryou2').val().replace(/,/g, '');
                        break;
                    case '1':  //
                        azukari_meisaitable[dic_key][2] += 1 * $(jqleft + i + 'Suuryou1').val().replace(/,/g, '');
                        azukari_meisaitable[dic_key][3] += 1 * $(jqleft + i + 'Suuryou2').val().replace(/,/g, '');
                        break;
                }
            }
            //預りは単独チェック(預り在庫のみしか動かないため)
            var den_id = $("#id").val();
            var den_mr_cd = $('#form1 [name="denpyou_mr_cd"]').val();   //伝票コード;
            var msg = '';
            if (!isEmpty(azukari_meisaitable)) {
                $.ajax({
                    type: "POST",
                    url: ajax_azukari_get,
                    data: {'den_mr_cd': den_mr_cd, 'den_id': den_id, 'azukari_meisai': azukari_meisaitable,},
                    async: true,
                    dataType: 'json',
                    success: function (data) {
                        msg = data;
                        azukari_meisaitable = {};
                        if (msg === 'OK') {
                            var res = confirm('登録しても、よろしいですか?.');
                            if (res === true) {
                                $('#post_form').submit();
                            }
                        } else {
                            $("#dispErrMsg").text(msg);
                            return; //リターンで終了させないと、後処理が動くので強制終了
                        }
                    },
                    error: function (xhr, status, err) {
                        $("#dispErrMsg").text('Error : azukari_zaiko_check ' + status + '/' + err);
                    },
                });
            }
            return; //リターンで終了させないと、後処理が動くので強制終了
            break;
    }

    final_meisai_zaikocheck();
}

//オブジェクトが空かどうか判定する関数
function isEmpty(obj) {
    return !Object.keys(obj).length;
}

//最終在庫チェック
function final_meisai_zaikocheck() {
    var den_id = $("#id").val();
    var den_mr_cd = $('#form1 [name="denpyou_mr_cd"]').val();   //伝票コード;
    //var zaikotable = {};
    var msg = '';
    var flg = 0;
    if (!isEmpty(moto_meisaitable)) {     //元だけなら０
        if (!isEmpty(saki_meisaitable)) { //元と先なら1
            flg = 1;
        } else {
            flg = 0;
        }
    } else if (!isEmpty(saki_meisaitable)) {   //先のみなら2
        flg = 2;
    }
    switch (flg) {
        case 0: //元のみ
            $.ajax({
                type: "POST",
                url: report_zaiko_vws_ajaxZaikoCheck,
                data: {'den_mr_cd': den_mr_cd, 'den_id': den_id, 'zaikotable': moto_meisaitable,},
                async: true,
                dataType: 'json',
                success: function (data) {
                    msg = data;
                    moto_meisaitable = {};
                    if (msg === 'OK') {
                        var res = confirm('登録しても、よろしいですか?');
                        if (res === true) {
                            $('#post_form').submit();
                        }
                    } else {
                        $("#dispErrMsg").text(msg);
                    }
                },
                error: function (xhr, status, err) {
                    $("#dispErrMsg").text('Error => zaiko_check_draft :' + status + '/' + err);
                }
            });
            break;
        case 1: //元と先
            $.ajax({
                type: "POST",
                url: report_zaiko_vws_ajaxZaikoCheck,
                data: {'den_mr_cd': den_mr_cd, 'den_id': den_id, 'zaikotable': moto_meisaitable,},
                async: true,
                dataType: 'json',
                success: function (data) {
                    msg = data;
                    moto_meisaitable = {};
                    //元倉庫の在庫がオッケーなら先在庫のチェック
                    if (msg === 'OK') {
                        $.ajax({
                            type: "POST",
                            url: report_zaiko_vws_ajaxZaikoCheck,
                            data: {'den_mr_cd': den_mr_cd, 'den_id': den_id, 'zaikotable': saki_meisaitable,},
                            async: true,
                            dataType: 'json',
                            success: function (data) {
                                msg = data;
                                saki_meisaitable = {};
                                if (msg === 'OK') {
                                    var res = confirm('登録しても、よろしいですか?');
                                    if (res === true) {
                                        $('#post_form').submit();
                                    }
                                } else {
                                    $("#dispErrMsg").text(msg);
                                }
                            },
                            error: function (xhr, status, err) {
                                $("#dispErrMsg").text('Error => zaiko_check_draft :' + status + '/' + err);
                            }
                        });
                    } else {
                        $("#dispErrMsg").text(msg);
                    }
                },
                error: function (xhr, status, err) {
                    $("#dispErrMsg").text('Error => zaiko_check_draft :' + status + '/' + err);
                }
            });
            break;
        case 2: //先のみ
            $.ajax({
                type: "POST",
                url: report_zaiko_vws_ajaxZaikoCheck,
                data: {'den_mr_cd': den_mr_cd, 'den_id': den_id, 'zaikotable': saki_meisaitable,},
                async: true,
                dataType: 'json',
                success: function (data) {
                    msg = data;
                    saki_meisaitable = {};
                    if (msg === 'OK') {
                        var res = confirm('登録しても、よろしいですか?');
                        if (res === true) {
                            $('#post_form').submit();
                        }
                    } else {
                        $("#dispErrMsg").text(msg);
                    }
                },
                error: function (xhr, status, err) {
                    $("#dispErrMsg").text('Error => zaiko_check_draft :' + status + '/' + err);
                }
            });
            break;
    }
}
