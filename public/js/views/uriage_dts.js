idmeisaif = 'fieldUriageMeisaiDts';
jqmeisaif = '#' + idmeisaif;

function addUriageMeisaiDt() {
    tr_id = '#tr_uriage_meisai_dt_' + imax;
    id_head = idmeisaif + imax;
    name_head = 'data[uriage_meisai_dts][' + imax + ']';
    $("#tr_uriage_meisai_dt_hidden").clone(true).attr('id', 'tr_uriage_meisai_dt_' + imax).removeAttr('style').insertAfter('#tr_uriage_meisai_dt_' + ((imax > 0) ? imax - 1 : 'hidden'));
    $(tr_id + " #hiddenCd").attr('id', id_head + 'Cd').attr('name', name_head + '[cd]');
    $(tr_id + " #hiddenId").attr('id', id_head + 'Id').attr('name', name_head + '[id]');
    $(tr_id + " #hiddenUpdated").attr('id', id_head + 'Updated').attr('name', name_head + '[updated]');
    $(tr_id + " #hiddenZeinukigaku").attr('id', id_head + 'Zeinukigaku').attr('name', name_head + '[zeinukigaku]');
    $(tr_id + " #hiddenZeigaku").attr('id', id_head + 'Zeigaku').attr('name', name_head + '[zeigaku]');
    $(tr_id + " #hiddenUtiwakeKbnCd").attr('id', id_head + 'UtiwakeKbnCd').attr('name', name_head + '[utiwake_kbn_cd]');
    $(tr_id + " #hiddenKousei").attr('id', id_head + 'Kousei').attr('name', name_head + '[kousei]');
    $(tr_id + " #hiddenShukkaKbnCd").attr('id', id_head + 'ShukkaKbnCd').attr('name', name_head + '[shukka_kbn_cd]');
    $(tr_id + " #hiddenShouhinMrCd").attr('id', id_head + 'ShouhinMrCd').attr('name', name_head + '[shouhin_mr_cd]');
    $(tr_id + " #hiddenTanniMr1Cd").attr('id', id_head + 'TanniMr1Cd').attr('name', name_head + '[tanni_mr1_cd]');
    $(tr_id + " #hiddenTanniMr2Cd").attr('id', id_head + 'TanniMr2Cd').attr('name', name_head + '[tanni_mr2_cd]');
    $(tr_id + " #hiddenSuuryou").attr('id', id_head + 'Suuryou').attr('name', name_head + '[suuryou]');
    $(tr_id + " #hiddenKeisu").attr('id', id_head + 'Keisu').attr('name', name_head + '[keisu]');
    $(tr_id + " #hiddenIrisuu").attr('id', id_head + 'Irisuu').attr('name', name_head + '[irisuu]');
    $(tr_id + " #hiddenSuuryou1").attr('id', id_head + 'Suuryou1').attr('name', name_head + '[suuryou1]');
    $(tr_id + " #hiddenTekiyou").attr('id', id_head + 'Tekiyou').attr('name', name_head + '[tekiyou]');
    $(tr_id + " #hiddenIro").attr('id', id_head + 'Iro').attr('name', name_head + '[iro]');
    $(tr_id + " #hiddenIromei").attr('id', id_head + 'Iromei').attr('name', name_head + '[iromei]');
    $(tr_id + " #hiddenLot").attr('id', id_head + 'Lot').attr('name', name_head + '[lot]');
    $(tr_id + " #hiddenKobetucd").attr('id', id_head + 'Kobetucd').attr('name', name_head + '[kobetucd]');
    $(tr_id + " #hiddenHinsituKbnCd").attr('id', id_head + 'HinsituKbnCd').attr('name', name_head + '[hinsitu_kbn_cd]');
    $(tr_id + " #hiddenSoukoMrCd").attr('id', id_head + 'SoukoMrCd').attr('name', name_head + '[souko_mr_cd]');
    $(tr_id + " #hiddenJuchuuzan").attr('id', id_head + 'Juchuuzan').attr('name', name_head + '[juchuuzan]');
    $(tr_id + " #hiddenSuuryou2").attr('id', id_head + 'Suuryou2').attr('name', name_head + '[suuryou2]');
    $(tr_id + " #hiddenMotoTanniMr2Cd").attr('id', id_head + 'MotoTanniMr2Cd').attr('name', name_head + '[moto_tanni_mr2_cd]');
    $(tr_id + " #hiddenSuuShousuu").attr('id', id_head + 'SuuShousuu').attr('name', name_head + '[suu_shousuu]');
    $(tr_id + " #hiddenSuu1Shousuu").attr('id', id_head + 'Suu1Shousuu').attr('name', name_head + '[suu1_shousuu]');
    $(tr_id + " #hiddenSuu2Shousuu").attr('id', id_head + 'Suu2Shousuu').attr('name', name_head + '[suu2_shousuu]');
    $(tr_id + " #hiddenTankaKbn").attr('id', id_head + 'TankaKbn').attr('name', name_head + '[tanka_kbn]');
    $(tr_id + " #hiddenZaikoKbn").attr('id', id_head + 'ZaikoKbn').attr('name', name_head + '[zaiko_kbn]');
    $(tr_id + " #hiddenTankaShousuu").attr('id', id_head + 'TankaShousuu').attr('name', name_head + '[tanka_shousuu]');
    $(tr_id + " #hiddenGentanka").attr('id', id_head + 'Gentanka').attr('name', name_head + '[gentanka]');
    $(tr_id + " #hiddenTanka").attr('id', id_head + 'Tanka').attr('name', name_head + '[tanka]');
    $(tr_id + " #hiddenKingaku").attr('id', id_head + 'Kingaku').attr('name', name_head + '[kingaku]');
    $(tr_id + " #hiddenGenkagaku").attr('id', id_head + 'Genkagaku').attr('name', name_head + '[genkagaku]');
    $(tr_id + " #hiddenProjectMrCd").attr('id', id_head + 'ProjectMrCd').attr('name', name_head + '[project_mr_cd]');
    $(tr_id + " #hiddenZeirituMrCd").attr('id', id_head + 'ZeirituMrCd').attr('name', name_head + '[zeiritu_mr_cd]');
    $(tr_id + " #hiddenKazeiKbnCd").attr('id', id_head + 'KazeiKbnCd').attr('name', name_head + '[kazei_kbn_cd]');
    $(tr_id + " #hiddenBikou").attr('id', id_head + 'Bikou').attr('name', name_head + '[bikou]');
    $("#" + id_head + 'Cd').val(imax + 1);
    $("#" + id_head + 'Id').val(0);
    imax++;
    $("#" + id_head + 'KazeiKbnCd').val(1); // 初期値を課税とする。
    //Add By Nishiyama 2019/2/18 倉庫初期値
    if ($("#" + id_head + 'HinsituKbnCd').val() !== '') {
        $("#" + id_head + 'SoukoMrCd').val('0000');
    } else {
        $("#" + id_head + 'SoukoMrCd').val('');
    }
    $targetElm = $(targetElm);
}

window.onload = function () {
    addUriageMeisaiDt();
    //2019/1/23 元の税率等を保持するため
    if ($('#id').val() === '') {
        $('#fieldUriagebi').change();
        //古い受注から転写した場合、税率が8%になるので税区分を最新の物にする 2020-02-27
        if (imax !== 1) {
            for (let i = 0; i < imax; i++) {
                if ($('#fieldUriageMeisaiDts' + i + 'UtiwakeKbnCd').val() === '10') {
                    $('#fieldUriageMeisaiDts' + i + 'UtiwakeKbnCd').change();
                }
            }
        }
    }

    if ($('#fieldShimekiriStatus').val('')) {
        if ($('#fieldUriagebi').val() <= $("#fieldSimezumibi").val()) {
            $('#fieldShimekiriStatus').val('請求済み');
            $('#fieldShimekiriStatus').css({'color': 'blue', 'text-align': 'center'});
        } else {
            $('#fieldShimekiriStatus').val('未請求');
            $('#fieldShimekiriStatus').css({'color': 'red', 'text-align': 'center'});
        }
    }
    zeiritu_kettei_imax(); // 税抜額なども再計算する
    denpyou_goukei_saikeisan(); // 伝票合計再計算（税抜額などをControllerから送り込んであるならこちらが良い）税額1円間違い多いので注釈外す2019/3/26井浦

    tbl_new_width = 0;
    $('#meisaiTable thead tr th').each(function (i) {
        tbl_new_width += 1 + $(this).width();
    });
    $('#meisaiTable').css({width: tbl_new_width + 'px'});
    addForm1(); // モーダル呼出post用フォームを追加

}

// モーダル呼出post用フォームを追加
function addForm1() {
    var form1 = $('<form></form>', {
        id: 'form1',
        action: '' + den_modal,
        target: 'iframe1',
        method: 'POST',
        name: 'iframe1form'
    }).hide();
    $('body').append(form1);
    form1.append($('<input>', {type: 'hidden', name: 'sakusei_user_id', value: my_id}));
    form1.append($('<input>', {type: 'hidden', name: 'denpyou_mr_cd', value: 'uriage'}));
}

$('#END').click(function () { //エンドキー(END)を押したら
    var index = $targetElm.index($("#" + lastfocusin));//alert(index);
    var thisname = $("#" + lastfocusin).attr('name');
    var partsname = thisname.split(/[\[|\]]+/);// '['か']'かその連続にマッチする文字で分割する。例：data[uriage_meisai_dts][0][shouhin_mr_cd]は、['data','uriage_meisai_dts','0','shouhin_mr_cd','']となる。
    var findend = '[shouhin_mr_cd]';
    if (imax > 1 && partsname.length == 5) {
        findend = '[' + partsname[3] + ']';
    }
    var findlen = -findend.length;
    index = $targetElm.index($(jqmeisaif + (imax - 1) + "Cd")) - 1;
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
    var partsname = thisname.split(/[\[|\]]+/);// '['か']'かその連続にマッチする文字で分割する。例：data[uriage_meisai_dts][0][shouhin_mr_cd]は、['data','uriage_meisai_dts','0','shouhin_mr_cd','']となる。
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

var cpyary = [
    'Zeinukigaku', 'Zeigaku', 'UtiwakeKbnCd', 'ShukkaKbnCd', 'ShouhinMrCd', 'TanniMr1Cd', 'TanniMr2Cd', 'Suuryou', 'Keisu', 'Irisuu',
    'Suuryou1', 'Tekiyou', 'Iro', 'Iromei', 'Lot', 'Kobetucd', 'HinsituKbnCd', 'SoukoMrCd', 'Juchuuzan', 'Suuryou2', 'MotoTanniMr2Cd',
    'SuuShousuu', 'Suu1Shousuu', 'Suu2Shousuu', 'TankaKbn', 'ZaikoKbn', 'TankaShousuu', 'Gentanka', 'Tanka', 'Kingaku', 'Genkagaku',
    'ProjectMrCd', 'ZeirituMrCd', 'KazeiKbnCd', 'Bikou'
];

$('#PgDn').click(function () { //ページダウンキー(Ctrl+Enter)を押したら
    var index = $targetElm.index($("#" + lastfocusin));//alert(index);
    var thisname = $("#" + lastfocusin).attr('name');
    var partsname = thisname.split(/[\[|\]]+/);// '['か']'かその連続にマッチする文字で分割する。例：data[uriage_meisai_dts][0][shouhin_mr_cd]は、['data','uriage_meisai_dts','0','shouhin_mr_cd','']となる。
    var findend = '[shouhin_mr_cd]';
    if (imax > 1 && partsname.length == 5) {
        findend = '[' + partsname[3] + ']';
        if (1 * partsname[2] + 1 == imax) {
            for (var i in cpyary) {
                if (!$("#" + lastfocusin).val() || idmeisaif + partsname[2] + cpyary[i] != lastfocusin) {
                    $(jqmeisaif + partsname[2] + cpyary[i]).val($(jqmeisaif + (1 * partsname[2] - 1) + cpyary[i]).val());
                }
            }
            $(jqmeisaif + partsname[2] + "Suuryou" + $(jqmeisaif + partsname[2] + "TankaKbn").val()).change();
            $(jqmeisaif + partsname[2] + "TanniMr1Cd").change();
            addUriageMeisaiDt();//新規行を追加
            denpyou_goukei_saikeisan();
        }
    }
    var findlen = -findend.length;
    for (i = index + 1; i <= $targetElm.length && (!$targetElm.eq(i).isVisible() || typeof ($targetElm.eq(i).attr("id")) == "undefined" || $targetElm.eq(i).attr("name").substr(findlen) != findend); i++) {
    }
    if (i <= $targetElm.length) {
        index = i;
    }
    $targetElm.eq(index).focus().select();
});

$('#F11').click(function () { //を押したら
    $('#F11').focus().select();
});

$('#fieldCd').change(function () { //売上データ索引
    //	alert($(this).val()); //''の場合、'0'など1桁の場合または結果が複数の場合、結果が1個の場合、結果が0個の場合
    if ($(this).val() != '') {
        $.ajax({
            type: "POST",
            url: uriage_dts_ajaxGet,
            data: {'cd': $(this).val(),},
            async: true,
            dataType: 'json',
            success: function (data) {
                if (data.length >= 1 && $('#fieldCd').val() === data[0].cd) {
                    location.href = uriage_dts_edit + data[0].id;
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

$('#fieldJuchuuDtCd').change(function () { //受注伝票の索引
    //alert("AAA:".$(this).attr("id")); //''の場合、'0'など1桁の場合または結果が複数の場合、結果が1個の場合、結果が0個の場合
    if ($(this).val() === '') {
        $('#fieldJuchuuDtId').val('');
    } else {
        $.ajax({
            type: "POST",
            url: juchuu_dts_ajaxGet,
            data: {'cd': $(this).val(),},
            async: true,
            dataType: 'json',
            success: function (data) {
                if (data.length == 0) {
                    $("#fieldTekiyou").val('>>元受注エラー:未登録');
                } else if (data.length == 1 || $("#fieldJuchuuDtCd").val() === data[0].cd) {
                    //選択肢をクリアしてから追加する
                    $('#JuchuuDtsOptions > option').remove();
                    for (var i = 0; i < data.length; i++) {
                        $('#JuchuuDtsOptions').append('<option value="' + data[i].cd + '">' + data[i].cd + ':' + data[i]["meisai"][1].tekiyou + '</option>');
                    }
                    $('#fieldJuchuuDtCd').val(data[0].cd);
                    $('#fieldJuchuuDtId').val(data[0].id);
                    if (data[0].zeiritu_tekiyoubi == '0000-00-00') {
                        $('#fieldZeirituTekiyoubi').val('');
                    } else {
                        $('#fieldZeirituTekiyoubi').val(data[0].zeiritu_tekiyoubi);
                    }
                    $('#fieldMitumoriDtId').val(data[0].mitumori_dt_id);
                    $('#fieldMitumoriDtCd').val(data[0].mitumori_dt_cd);
                    $('#fieldTokuisakiMrCd').val(data[0].tokuisaki_mr_cd);
                    $('#fieldTokuisakiMrCd').change();
                    $('#fieldTorihikiKbnCd').val(data[0].torihiki_kbn_cd);
                    $('#fieldZeiTenkaKbnCd').val(data[0].zei_tenka_kbn_cd);
                    $('#fieldNounyuusakiMrCd').val(data[0].nounyuusaki_mr_cd);
                    $('#fieldNounyuusaki').val(data[0].nounyuusaki);
                    $('#fieldKidukesakiMrCd').val(data[0].kidukesaki_mr_cd);
                    $('#fieldKiduke').val(data[0].kiduke);
                    $('#fieldTantouMrCd').val(data[0].tantou_mr_cd);
                    $('#fieldTekiyou').val(data[0].tekiyou);
                    $('#fieldSakiHacchuuCd').val(data[0].saki_hacchuu_cd);
                    var i = 0;
                    var gyou = -1;
                    for (m_cd in data[0]["meisai"]) {
                        if (data[0]["meisai"][m_cd].utiwake_kbn_cd != 30) { // 内部積算は除く
                            if (i >= imax) { //新規行を追加
                                addUriageMeisaiDt();
                            }
                            $(jqmeisaif + i + 'UtiwakeKbnCd').val(data[0]["meisai"][m_cd].utiwake_kbn_cd); // 内訳区分
                            $(jqmeisaif + i + 'Kousei').val(data[0]["meisai"][m_cd].kousei); // 構造
                            if (data[0]["meisai"][m_cd].kousei == '-' || data[0]["meisai"][m_cd].kousei == '+') {
                                $(jqmeisaif + i + 'Kousei').addClass('kousei_oya');
                                gyou = i;
                            } else if (data[0]["meisai"][m_cd].kousei.length > 0 && gyou >= 0) {
                                $('#tr_uriage_meisai_dt_' + i).addClass('kodomo' + gyou);
                            } else {
                                gyou = -1;
                            }
                            $(jqmeisaif + i + 'ShouhinMrCd').val(data[0]["meisai"][m_cd].shouhin_mr_cd);
                            $(jqmeisaif + i + 'Tekiyou').val(data[0]["meisai"][m_cd].tekiyou);
                            $(jqmeisaif + i + 'Iro').val(data[0]["meisai"][m_cd].iro);
                            $(jqmeisaif + i + 'Iromei').val(data[0]["meisai"][m_cd].iromei);
                            $(jqmeisaif + i + 'Lot').val(data[0]["meisai"][m_cd].lot);
                            $(jqmeisaif + i + 'Kobetucd').val(data[0]["meisai"][m_cd].kobetucd);
                            $(jqmeisaif + i + 'SoukoMrCd').val(data[0]["meisai"][m_cd].souko_mr_cd);
                            $(jqmeisaif + i + 'HinsituKbnCd').val(data[0]["meisai"][m_cd].hinsitu_kbn_cd);
                            $(jqmeisaif + i + 'Suuryou').val(data[0]["meisai"][m_cd].suuryou);
                            $(jqmeisaif + i + 'Keisu').val(data[0]["meisai"][m_cd].keisu);
                            $(jqmeisaif + i + 'Irisuu').val(data[0]["meisai"][m_cd].irisuu);
                            var sh1 = data[0]["meisai"][m_cd].suu1_shousuu;
                            var sh2 = data[0]["meisai"][m_cd].suu2_shousuu;
                            $(jqmeisaif + i + 'Suuryou1').val(Intl.NumberFormat("ja-JP", {
                                minimumFractionDigits: sh1,
                                maximumFractionDigits: sh1
                            }).format(data[0]["meisai"][m_cd].suuryou1));
                            $(jqmeisaif + i + 'TanniMr1Cd').val(data[0]["meisai"][m_cd].tanni_mr1_cd);
                            $(jqmeisaif + i + 'TanniMr2Cd').val(data[0]["meisai"][m_cd].tanni_mr2_cd);
                            $(jqmeisaif + i + 'Suuryou2').val(Intl.NumberFormat("ja-JP", {
                                minimumFractionDigits: sh2,
                                maximumFractionDigits: sh2
                            }).format(data[0]["meisai"][m_cd].suuryou2));
                            $(jqmeisaif + i + 'SuuShousuu').val(data[0]["meisai"][m_cd].suu_shousuu);
                            $(jqmeisaif + i + 'Suu1Shousuu').val(sh1);
                            $(jqmeisaif + i + 'Suu2Shousuu').val(sh2);
                            $(jqmeisaif + i + 'TankaShousuu').val(data[0]["meisai"][m_cd].tanka_shousuu);
                            $(jqmeisaif + i + 'MotoTanniMr2Cd').val(data[0]["meisai"][m_cd].moto_tanni_mr2_cd);
                            $(jqmeisaif + i + 'TankaKbn').val(data[0]["meisai"][m_cd].tanka_kbn);
                            $(jqmeisaif + i + 'ZaikoKbn').val(data[0]["meisai"][m_cd].zaiko_kbn);
                            $(jqmeisaif + i + 'Gentanka').val(data[0]["meisai"][m_cd].gentanka);
                            $(jqmeisaif + i + 'Tanka').val(data[0]["meisai"][m_cd].tanka);
                            $(jqmeisaif + i + 'Kingaku').val(Math.floor(data[0]["meisai"][m_cd].kingaku));
                            $(jqmeisaif + i + 'Bikou').val(data[0]["meisai"][m_cd].bikou);
                            $(jqmeisaif + i + 'KazeiKbnCd').val(data[0]["meisai"][m_cd].kazei_kbn_cd);
                            $(jqmeisaif + i + 'ZeirituMrCd').val(data[0]["meisai"][m_cd].zeiritu_mr_cd);
                            //gyou_kingaku_saikeisan(idmeisaif + i); // 行金額再計算  2019/7/31 切り捨て計算がおかしい
                            i++;
                        }
                    }
                    if (i >= imax) {
                        addUriageMeisaiDt();
                    }//新規行を追加しておく
                    denpyou_goukei_saikeisan(); // 伝票合計再計算
                } else {
                    //選択肢をクリアしてから追加する
                    $('#JuchuuDtsOptions > option').remove();
                    for (var i = 0; i < data.length; i++) {
                        $('#JuchuuDtsOptions').append('<option value="' + data[i].cd + '">' + data[i].cd + ':' + data[i]["meisai"][1].tekiyou + '</option>');
                    }
                    $("#fieldTekiyou").val('>>元受注エラー:未登録');
                    $("#fieldJuchuuDtId").focus().select();
                }
            },
            error: function (xhr, status, err) {
                $("#fieldTekiyou").val('>元受注エラー' + status + '/' + err);
            },
        });
    }
});

$('#fieldMitumoriDtId').change(function () { //見積伝票の索引
    //alert("AAA:".$(this).attr("id")); //''の場合、'0'など1桁の場合または結果が複数の場合、結果が1個の場合、結果が0個の場合
    if ($(this).val() == '') {

    } else {
        $.ajax({
            type: "POST",
            url: mitumori_dts_ajaxGet,
            data: {'cd': $(this).val(),},
            async: true,
            dataType: 'json',
            success: function (data) {
                if (data.length == 0) {
                    $("#fieldTekiyou").val('>>元見積エラー:未登録');
                } else if (data.length == 1 || $("#fieldMitumoriDtId").val() === data[0].cd) {
                    //選択肢をクリアしてから追加する
                    $('#MitumoriDtsOptions > option').remove();
                    for (var i = 0; i < data.length; i++) {
                        $('#MitumoriDtsOptions').append('<option value="' + data[i].cd + '">' + data[i].cd + ':' + data[i]["meisai"][1].tekiyou + '</option>');
                    }
                    $('#fieldMitumoriDtId').val(data[0].cd);
                    if (data[0].zeiritu_tekiyoubi == '0000-00-00') {
                        $('#fieldZeirituTekiyoubi').val('');
                    } else {
                        $('#fieldZeirituTekiyoubi').val(data[0].zeiritu_tekiyoubi);
                    }
                    $('#fieldTokuisakiMrCd').val(data[0].tokuisaki_mr_cd);
                    $('#fieldTokuisakiMrCd').change();
                    $('#fieldTorihikiKbnCd').val(data[0].torihiki_kbn_cd);
                    $('#fieldZeiTenkaKbnCd').val(data[0].zei_tenka_kbn_cd);
                    $('#fieldTantouMrCd').val(data[0].tantou_mr_cd);
                    $('#fieldTekiyou').val(data[0].tekiyou);
                    var i = 0;
                    var gyou = -1;
                    for (m_cd in data[0]["meisai"]) {
                        if (data[0]["meisai"][m_cd].utiwake_kbn_cd != 30) { // 内部積算は除く
                            if (i >= imax) { //新規行を追加
                                addUriageMeisaiDt();
                            }
                            $(jqmeisaif + i + 'UtiwakeKbnCd').val(data[0]["meisai"][m_cd].utiwake_kbn_cd); // 内訳区分
                            $(jqmeisaif + i + 'Kousei').val(data[0]["meisai"][m_cd].kousei); // 構造
                            if (data[0]["meisai"][m_cd].kousei == '-' || data[0]["meisai"][m_cd].kousei == '+') {
                                $(jqmeisaif + i + 'Kousei').addClass('kousei_oya');
                                gyou = i;
                            } else if ((data[0]["meisai"][m_cd].kousei + '').length > 0 && gyou >= 0) {
                                $('#tr_uriage_meisai_dt_' + i).addClass('kodomo' + gyou);
                            } else {
                                gyou = -1;
                            }
                            $(jqmeisaif + i + 'ShouhinMrCd').val(data[0]["meisai"][m_cd].shouhin_mr_cd);
                            $(jqmeisaif + i + 'Tekiyou').val(data[0]["meisai"][m_cd].tekiyou);
                            $(jqmeisaif + i + 'Iro').val(data[0]["meisai"][m_cd].iro);
                            $(jqmeisaif + i + 'Iromei').val(data[0]["meisai"][m_cd].iromei);
                            $(jqmeisaif + i + 'Lot').val(data[0]["meisai"][m_cd].lot);
                            $(jqmeisaif + i + 'Kobetucd').val(data[0]["meisai"][m_cd].kobetucd);
                            $(jqmeisaif + i + 'SoukoMrCd').val(data[0]["meisai"][m_cd].souko_mr_cd);
                            $(jqmeisaif + i + 'HinsituKbnCd').val(data[0]["meisai"][m_cd].hinsitu_kbn_cd);
                            $(jqmeisaif + i + 'Suuryou').val(data[0]["meisai"][m_cd].suuryou);
                            $(jqmeisaif + i + 'Keisu').val(data[0]["meisai"][m_cd].keisu);
                            $(jqmeisaif + i + 'Irisuu').val(data[0]["meisai"][m_cd].irisuu);
                            $(jqmeisaif + i + 'Suuryou1').val(data[0]["meisai"][m_cd].suuryou1);
                            $(jqmeisaif + i + 'TanniMr1Cd').val(data[0]["meisai"][m_cd].tanni_mr1_cd);
                            $(jqmeisaif + i + 'TanniMr2Cd').val(data[0]["meisai"][m_cd].tanni_mr2_cd);
                            $(jqmeisaif + i + 'Suuryou2').val(data[0]["meisai"][m_cd].suuryou2);
                            $(jqmeisaif + i + 'SuuShousuu').val(data[0]["meisai"][m_cd].suu_shousuu);
                            $(jqmeisaif + i + 'Suu1Shousuu').val(data[0]["meisai"][m_cd].suu1_shousuu);
                            $(jqmeisaif + i + 'Suu2Shousuu').val(data[0]["meisai"][m_cd].suu2_shousuu);
                            $(jqmeisaif + i + 'TankaShousuu').val(data[0]["meisai"][m_cd].tanka_shousuu);
                            $(jqmeisaif + i + 'MotoTanniMr2Cd').val(data[0]["meisai"][m_cd].moto_tanni_mr2_cd);
                            $(jqmeisaif + i + 'TankaKbn').val(data[0]["meisai"][m_cd].tanka_kbn);
                            $(jqmeisaif + i + 'ZaikoKbn').val(data[0]["meisai"][m_cd].zaiko_kbn);
                            $(jqmeisaif + i + 'Gentanka').val(data[0]["meisai"][m_cd].gentanka);
                            $(jqmeisaif + i + 'Tanka').val(data[0]["meisai"][m_cd].tanka);
                            $(jqmeisaif + i + 'Kingaku').val(data[0]["meisai"][m_cd].kingaku);
                            $(jqmeisaif + i + 'Bikou').val(data[0]["meisai"][m_cd].bikou);
                            $(jqmeisaif + i + 'ZeirituMrCd').val(data[0]["meisai"][m_cd].zeiritu_mr_cd);
                            gyou_kingaku_saikeisan(idmeisaif + i); // 行金額再計算
                            i++;
                        }
                    }
                    if (i >= imax) {
                        addUriageMeisaiDt();
                    }//新規行を追加しておく
                    denpyou_goukei_saikeisan(); // 伝票合計再計算
                } else {
                    //選択肢をクリアしてから追加する
                    $('#MitumoriDtsOptions > option').remove();
                    for (var i = 0; i < data.length; i++) {
                        $('#MitumoriDtsOptions').append('<option value="' + data[i].cd + '">' + data[i].cd + ':' + data[i]["meisai"][1].tekiyou + '</option>');
                    }
                    $("#fieldTekiyou").val('>>元見積エラー:未登録');
                    $("#fieldMitumoriDtId").focus().select();
                }
            },
            error: function (xhr, status, err) {
                $("#fieldTekiyou").val('>元見積エラー' + status + '/' + err);
            },
        });
    }
});

$('#fieldTokuisakiMrCd').change(function () { //得意先マスター索引
    //alert("AAA:".$(this).attr("id")); //''の場合、'0'など1桁の場合または結果が複数の場合、結果が1個の場合、結果が0個の場合
    if ($(this).val() == '') {
        $("#rdonlyTokuisakiMrName").val("");
    } else {
        $.ajax({
            type: "POST",
            url: tokuisaki_mrs_ajaxGet,
            data: {'cd': $(this).val(),},
            async: true,
            dataType: 'json',
            success: function (data) {
                if (data.length == 0) {
                    $("#rdonlyTokuisakiMrName").val('>>エラー:未登録');
                } else if (data.length == 1 || $("#fieldTokuisakiMrCd").val() === data[0].cd) {
                    $('#TokuisakiMrsOptions > option').remove();
                    for (var i = 0; i < data.length; i++) {
                        $('#TokuisakiMrsOptions').append('<option value="' + data[i].cd + '">' + data[i].cd + ':' + data[i].name + '</option>');
                    }
                    $("#fieldTokuisakiMrCd").val(data[0].cd);
                    $("#rdonlyTokuisakiMrName").val(data[0].name);
                    $("#fieldSeikyuusakiName").val(data[0].seikyuusaki_name);
                    $("#fieldTorihikiKbnCd").val(data[0].torihiki_kbn_cd);
                    $("#fieldZeiTenkaKbnCd").val(data[0].zei_tenka_kbn_cd);
                    $("#fieldTankaShuruiKbnCd").val(data[0].tanka_shurui_kbn_cd);
                    $("#fieldKakeritu").val(data[0].kakeritu);
                    $("#fieldTantouMrCd").val(data[0].tantou_mr_cd);
                    $("#fieldUrikakeZandaka").val(Intl.NumberFormat("ja-JP", {
                        minimumFractionDigits: 0,
                        maximumFractionDigits: 0
                    }).format(data[0].kake_zandaka));//数値カンマ編集
                    $("#fieldTokuisakiMrYoshingendogaku").val(data[0].yoshin_gendogaku);
                    $("#gaku_hasuu_shori_kbn_cd").val(data[0].gaku_hasuu_shori_kbn_cd);
                    $("#zei_hasuu_shori_kbn_cd").val(data[0].zei_hasuu_shori_kbn_cd);
                    $("#chouhyou_mr_id_org").val(data[0].shitei_uriden_kbn_cd); // 指定売上伝票
                    $("#fieldSimezumibi").val(data[0].simezumibi);
                    $('#fieldUriagebi').change();
                    $("#fieldTorihikiKbnCd").change();

                    zeiritu_kettei_imax(); // 税抜額なども再計算する。追加2019/04/09井浦
                    denpyou_goukei_saikeisan(); // 伝票合計再計算（税抜額などをControllerから送り込んであるならこちらが良い）税額1円間違い多いので注釈外す2019/3/26井浦
                } else {
                    //選択肢をクリアしてから追加する
                    $('#TokuisakiMrsOptions > option').remove();
                    for (var i = 0; i < data.length; i++) {
                        $('#TokuisakiMrsOptions').append('<option value="' + data[i].cd + '">' + data[i].cd + ':' + data[i].name + '</option>');
                    }
                    $("#rdonlyTokuisakiMrName").val('>>エラー:未登録');
                    $("#fieldTokuisakiMrCd").focus().select();
                }
            },
            error: function (xhr, status, err) {
                $("#rdonlyTokuisakiMrName").val('>エラー' + status + '/' + err);
            },
        });
    }
});

$('#fieldUriagebi').change(function () { // 売上日付が変ったら
    if ($(this).val().length < 1) {
        return;
    }
    now = new Date();
    $(this).val($(this).val().replace('/', '-').replace('/', '-'));
    if ($(this).val().length <= 2) {
        $(this).val(now.getFullYear() + '-' + ('0' + (now.getMonth() + 1)).slice(-2) + '-' + ('0' + $(this).val()).slice(-2));
    } else if ($(this).val().length <= 5) {
        if ($(this).val().indexOf('-') == -1) {
            $(this).val($(this).val().slice(-4, -2) + '-' + $(this).val().slice(-2));
        }
        $(this).val(now.getFullYear() + '-' + $(this).val());
    } else {
        if ($(this).val().indexOf('-') == -1) {
            $(this).val($(this).val().slice(-8, -4) + '-' + $(this).val().slice(-4, -2) + '-' + $(this).val().slice(-2));
        }
        if ($(this).val().length == 8) {
            $(this).val('20' + $(this).val());
        }
    }
    var ymd = $(this).val().split('-');
    $(this).val(ymd[0] + '-' + ('0' + ymd[1]).slice(-2) + '-' + ('0' + ymd[2]).slice(-2));
    //税率を取得させる 西山 2019/9/30
    if (imax !== '1') {
        for (var i = 0; i < imax - 1; i++) {
            $(jqmeisaif + i + 'ZeirituMrCd').val('');
        }
        zeiritu_kettei_imax();
    }

    if ($('#fieldUriagebi').val() <= $("#fieldSimezumibi").val()) {
        $('#fieldShimekiriStatus').val('請求済み');
        $('#fieldShimekiriStatus').css({'color': 'blue', 'text-align': 'center'});
    } else {
        $('#fieldShimekiriStatus').val('未請求');
        $('#fieldShimekiriStatus').css({'color': 'red', 'text-align': 'center'});
    }
});

$('#fieldNounyuusakiMrCd').change(function () { //納入先マスター索引
    //alert("AAA:".$(this).attr("id")); //''の場合、'0'など1桁の場合または結果が複数の場合、結果が1個の場合、結果が0個の場合
    if ($(this).val() == '') {
        $("#fieldNounyuusaki").val("");
    } else {
        $.ajax({
            type: "POST",
            url: nounyuusaki_mrs_ajaxGet,
            data: {'cd': $(this).val(),},
            async: true,
            dataType: 'json',
            success: function (data) {
                if (data.length == 0) {
                    $("#fieldNounyuusaki").val('>>エラー:未登録');
                } else if (data.length == 1 || $("#fieldNounyuusakiMrCd").val() === data[0].cd) {
                    //選択肢をクリアしてから追加する
                    $('#NounyuusakiMrsOptions > option').remove();
                    for (var i = 0; i < data.length; i++) {
                        $('#NounyuusakiMrsOptions').append('<option value="' + data[i].cd + '">' + data[i].cd + ':' + data[i].name + '</option>');
                    }
                    $("#fieldNounyuusakiMrCd").val(data[0].cd);
                    $("#fieldNounyuusaki").val(data[0].name);
                } else {
                    //選択肢をクリアしてから追加する
                    $('#NounyuusakiMrsOptions > option').remove();
                    for (var i = 0; i < data.length; i++) {
                        $('#NounyuusakiMrsOptions').append('<option value="' + data[i].cd + '">' + data[i].cd + ':' + data[i].name + '</option>');
                    }
                    $("#fieldNounyuusaki").val('>>エラー:未登録');
                    $("#fieldNounyuusakiMrCd").focus().select();
                }
            },
            error: function (xhr, status, err) {
                $("#fieldNounyuusaki").val('>エラー' + status + '/' + err);
            },
        });
    }
});

$('#fieldKidukesakiMrCd').change(function () { //気付先マスター索引
    //alert("AAA:".$(this).attr("id")); //''の場合、'0'など1桁の場合または結果が複数の場合、結果が1個の場合、結果が0個の場合
    if ($(this).val() == '') {
        $("#fieldKiduke").val("");
    } else {
        $.ajax({
            type: "POST",
            url: nounyuusaki_mrs_ajaxGet,
            data: {'cd': $(this).val(),},
            async: true,
            dataType: 'json',
            success: function (data) {
                if (data.length == 0) {
                    $("#fieldKiduke").val('>>エラー:未登録');
                } else if (data.length == 1 || $("#fieldKidukesakiMrCd").val() === data[0].cd) {
                    //選択肢をクリアしてから追加する
                    $('#KidukesakiMrsOptions > option').remove();
                    for (var i = 0; i < data.length; i++) {
                        $('#KidukesakiMrsOptions').append('<option value="' + data[i].cd + '">' + data[i].cd + ':' + data[i].name + '</option>');
                    }
                    $("#fieldKidukesakiMrCd").val(data[0].cd);
                    $("#fieldKiduke").val(data[0].name);
                } else {
                    //選択肢をクリアしてから追加する
                    $('#KidukesakiMrsOptions > option').remove();
                    for (var i = 0; i < data.length; i++) {
                        $('#KidukesakiMrsOptions').append('<option value="' + data[i].cd + '">' + data[i].cd + ':' + data[i].name + '</option>');
                    }
                    $("#fieldKiduke").val('>>エラー:未登録');
                    $("#fieldKidukesakiMrCd").focus().select();
                }
            },
            error: function (xhr, status, err) {
                $("#fieldKiduke").val('>エラー' + status + '/' + err);
            },
        });
    }
});

$("[id$='ShouhinMrCd']").dblclick(function () { //商品マスター索引
    $(this).change();
});

$("[id$='ShouhinMrCd']").change(function () { //商品マスター索引
    var idleft = $(this).attr("id").slice(0, -11); //fieldUriageMeisaiDts0ShouhinMrCd 右から11桁消す
    var jqleft = '#' + idleft;
    var gyou = idleft.slice(20); //fieldUriageMeisaiDts0 左から20桁消す
    if ($(this).val() == '') {
        $(jqleft + "Tekiyou").val("");
    } else {
        $.ajax({
            type: "POST",
            url: shouhin_mrs_ajaxGet,
            data: {'cd': $(this).val(),},
            async: true,
            dataType: 'json',
            success: function (data) {
                if (data.length == 0) {
                    $(jqleft + "Tekiyou").val('>>エラー:未登録');
                } else if (data.length == 1 || $(jqleft + "ShouhinMrCd").val() === data[0].cd) {
                    //選択肢をクリアしてから追加する
                    $('#ShouhinMrsOptions > option').remove();
                    for (var i = 0; i < data.length; i++) {
                        $('#ShouhinMrsOptions').append('<option value="' + data[i].cd + '">' + data[i].cd + ':' + data[i].name + '</option>');
                    }
                    $(jqleft + "ShouhinMrCd").val(data[0].cd);
                    $(jqleft + "Tekiyou").val(data[0].name);
                    $(jqleft + "Iro").val(data[0].iro);
                    $(jqleft + "Iromei").val(data[0].iromei);
                    $(jqleft + "Lot").val(data[0].lot);
                    $(jqleft + "HinsituKbnCd").val(data[0].hinsitu_kbn_cd);
                    $(jqleft + "TanniMr1Cd").val(data[0].tanni_mr1_cd);
                    $(jqleft + "TanniMr2Cd").val(data[0].tanni_mr2_cd);
                    $(jqleft + "MotoTanniMr2Cd").val(data[0].moto_tanni_mr2_cd);
                    $(jqleft + "SuuShousuu").val(data[0].suu_shousuu);
                    $(jqleft + "Suu1Shousuu").val(data[0].suu1_shousuu);
                    $(jqleft + "Suu2Shousuu").val(data[0].suu2_shousuu);
                    $(jqleft + "TankaShousuu").val(data[0].tanka_shousuu);
                    $(jqleft + "Irisuu").val(data[0].irisuu);
                    $(jqleft + "SoukoMrCd").val(data[0].shu_souko_mr_cd);
                    $(jqleft + "TankaKbn").val(data[0].tanka_kbn);
                    $(jqleft + "ZaikoKbn").val(data[0].zaiko_kbn);
                    $(jqleft + "Gentanka").val(data[0].uri_genka);
                    $(jqleft + "Tanka").val(data[0][tanka_shurui_kbns[$("#fieldTankaShuruiKbnCd").val()]]);//tanka_shurui_kbn_cdによって選ぶ
                    if ($(jqleft + "UtiwakeKbnCd").val() == '') {
                        $(jqleft + "UtiwakeKbnCd").val('10');
                    }
                    $(jqleft + "KazeiKbnCd").val(data[0].kazei_kbn_cd);
                    if (data[0].kazei_kbn_cd === '2') {
                        $(jqleft + "ZeirituMrCd").val('80');
                    } else {
                        //商品変更時バグるので応急処置(引数flg)
                        zeiritu_kettei(idleft,true); //バグ2019/9/30修正 元:$(jqleft + "ZeirituMrCd").val('12');
                    }

                    if ($(jqleft + 'UtiwakeKbnCd').val() === '10') {
                        //得意先別単価取得
                        var cd = $(jqleft + "ShouhinMrCd").val(); //$(this)で取得できないのでノードを指定
                        var tokuisaki_mr_cd = $('#fieldTokuisakiMrCd').val();
                        $.ajax({
                            type: "POST",
                            url: get_tokuisaki_tanka,
                            data: {'cd': cd, 'tokuisaki_mr_cd': tokuisaki_mr_cd,},
                            async: true,
                            dataType: 'json',
                            success: function (res) {
                                if (res.length !== 0) {
                                    //console.log('-----------get-tanka--------');
                                    //console.log(res);
                                    //console.log('-----------------------------');
                                    $(jqleft + "Tanka").val(res[0]['tanka']);
                                }
                            },
                            error: function (xhr, status, err) {
                                console.log(stats + '/' + err);
                            },
                        });

                    }
                    $(jqleft + "Tanka").change();
                    if (1 * gyou + 1 >= imax) {
                        addUriageMeisaiDt();
                    }

                    try {
                        var souko_cd = $(jpleft + 'SoukoMrCd').val();
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
                } else {
                    //選択肢をクリアしてから追加する
                    $('#ShouhinMrsOptions > option').remove();
                    for (var i = 0; i < data.length; i++) {
                        $('#ShouhinMrsOptions').append('<option value="' + data[i].cd + '">' + data[i].cd + ':' + data[i].name + '</option>');
                    }
                    $(jqleft + "Tekiyou").val('>>エラー:未登録');
                    $(jqleft + "ShouhinMrCd").focus().select();
                }
            },
            error: function (xhr, status, err) {
                $(jqleft + "Tekiyou").val('>エラー' + status + '/' + err);
            },
        });
    }
});

function tenkai(only1) { // 単展開、全展開
    var gyou = 0;
    if (lastfocusin === 'F7') {
        lastfocusin = lastfocusout;
    }
    if (lastfocusin.substr(0, 20) === idmeisaif) {
        gyou = 1 * (lastfocusin.substr(20, 10).match(/^\d+/)); // 20桁目から連続した数字を得る
    }
    if ($(jqmeisaif + gyou + "ShouhinMrCd").val() === '') {
        alert('エラー:商品CD未入力');
    } else {
        var tanka_kbn = $(jqmeisaif + gyou + 'TankaKbn').val();
        var tanka_kbn0x = 3 - tanka_kbn;
        var zaiko_kbn = $(jqmeisaif + gyou + 'ZaikoKbn').val();
        var zaiko_kbn0x = 3 - zaiko_kbn;
        $.ajax({
            type: "POST",
            url: kousei_buhin_mrs_ajaxTenkai,
            data: {
                'shouhin_mr_cd': $(jqmeisaif + gyou + "ShouhinMrCd").val(),
                'shouhin_mr_id': 0,
                'suuryou': $(jqmeisaif + gyou + "Suuryou" + zaiko_kbn).val(),
                'tanni_mr_cd': $(jqmeisaif + gyou + "TanniMr" + zaiko_kbn + "Cd").val(),
                'only1': only1,
            },
            async: true,
            dataType: 'json',
            success: function (data) {
                if (data.length == 0) {
                    alert('エラー:構成部品未登録');
                } else {
                    if ($(jqmeisaif + gyou + 'UtiwakeKbnCd').val() == 20 || $(jqmeisaif + gyou + 'UtiwakeKbnCd').val() == 24) { // 1行目が内部生産
                        //  $(jqmeisaif + gyou + 'Gentanka').val(0); // 売り原価はそのまま
                        $(jqmeisaif + gyou + 'Tanka').val(0); // 売り単価は0
                        $(jqmeisaif + gyou + 'Kingaku').val(0); // 売り金額は0
                        $(jqmeisaif + gyou + 'ZeirituMrCd').val(90); // 税率対象外
                    }
                    $(jqmeisaif + gyou + 'Kousei').val('-');
                    $(jqmeisaif + gyou + 'Kousei').addClass('kousei_oya');
                    for (var i = 1; i - 1 < data.length; i++) {
                        if (i + gyou >= imax) { //新規行を追加
                            addUriageMeisaiDt();
                        }
                        $('#tr_uriage_meisai_dt_' + (i + gyou)).addClass('kodomo' + gyou);
                        $(jqmeisaif + (i + gyou) + 'Kousei').val(data[i - 1].kousei);
                        $(jqmeisaif + (i + gyou) + 'KazeiKbnCd').val(data[i - 1].gen_shouhin_mr.kazei_kbn_cd);
                        if ($(jqmeisaif + gyou + 'UtiwakeKbnCd').val() == 20 || $(jqmeisaif + gyou + 'UtiwakeKbnCd').val() == 24) { // 1行目が内部生産
                            if (data[i - 1].koutin_flg == 1) {
                                $(jqmeisaif + (i + gyou) + 'UtiwakeKbnCd').val(10); // 通常（見積）
                                $(jqmeisaif + (i + gyou) + 'ZeirituMrCd').val(''); // 消去
                                zeiritu_kettei(idmeisaif + (i + gyou)); // 税率決定
                            } else {
                                $(jqmeisaif + (i + gyou) + 'UtiwakeKbnCd').val(21); // 受託支給原料
                                $(jqmeisaif + (i + gyou) + 'ZeirituMrCd').val(90); // 税対象外
                            }
                        } else {
                            $(jqmeisaif + (i + gyou) + 'UtiwakeKbnCd').val(30); // 内部積算
                            $(jqmeisaif + (i + gyou) + 'ZeirituMrCd').val(90); // 税対象外
                        }
                        $(jqmeisaif + (i + gyou) + 'ShouhinMrCd').val(data[i - 1].gen_shouhin_mr_cd);
                        //	$(jqmeisaif+(i+gyou)+'ShouhinMrCd').change();
                        $(jqmeisaif + (i + gyou) + 'Keisu').val(data[i - 1].irisuu);
                        $(jqmeisaif + (i + gyou) + 'Suuryou').val($(jqmeisaif + gyou + "Suuryou" + $(jqmeisaif + gyou + 'ZaikoKbn').val()).val()); //
                        $(jqmeisaif + (i + gyou) + 'Tekiyou').val(data[i - 1].gen_shouhin_mr.name);
                        $(jqmeisaif + (i + gyou) + 'Iro').val(data[i - 1].gen_shouhin_mr.iro);
                        $(jqmeisaif + (i + gyou) + 'Iromei').val(data[i - 1].gen_shouhin_mr.iromei);
                        $(jqmeisaif + (i + gyou) + 'Lot').val(data[i - 1].gen_shouhin_mr.lot);
                        $(jqmeisaif + (i + gyou) + 'Irisuu').val(data[i - 1].gen_shouhin_mr.irisuu);
                        $(jqmeisaif + (i + gyou) + 'TanniMr1Cd').val(data[i - 1].gen_shouhin_mr.tanni_mr1_cd);
                        $(jqmeisaif + (i + gyou) + 'TanniMr2Cd').val(data[i - 1].gen_shouhin_mr.tanni_mr2_cd);
                        $(jqmeisaif + (i + gyou) + 'TankaKbn').val(data[i - 1].gen_shouhin_mr.tanka_kbn);
                        $(jqmeisaif + (i + gyou) + 'ZaikoKbn').val(data[i - 1].gen_shouhin_mr.zaiko_kbn);
                        $(jqmeisaif + (i + gyou) + 'MotoTanniMr2Cd').val(data[i - 1].gen_shouhin_mr.tanni_mr2_cd);
                        $(jqmeisaif + (i + gyou) + 'HinsituKbnCd').val(data[i - 1].gen_shouhin_mr.hinsitu_kbn_cd);
                        $(jqmeisaif + (i + gyou) + 'SuuShousuu').val(data[i - 1].gen_shouhin_mr.suu_shousuu);
                        $(jqmeisaif + (i + gyou) + 'Suu1Shousuu').val(data[i - 1].gen_shouhin_mr.suu1_shousuu);
                        $(jqmeisaif + (i + gyou) + 'Suu2Shousuu').val(data[i - 1].gen_shouhin_mr.suu2_shousuu);
                        $(jqmeisaif + (i + gyou) + 'TankaShousuu').val(data[i - 1].gen_shouhin_mr.tanka_shousuu);
                        if ($(jqmeisaif + (i + gyou) + 'UtiwakeKbnCd').val() == 20 || $(jqmeisaif + (i + gyou) + 'UtiwakeKbnCd').val() == 24 || $(jqmeisaif + (i + gyou) + 'UtiwakeKbnCd').val() == 21) { // 受託加工生産か支給原料
                            $(jqmeisaif + (i + gyou) + 'Gentanka').val(0);
                            $(jqmeisaif + (i + gyou) + 'Tanka').val(0);
                        } else if ($(jqmeisaif + (i + gyou) + 'UtiwakeKbnCd').val() == '30') { // 積算の時
                            $(jqmeisaif + (i + gyou) + 'Gentanka').val(data[i - 1].gen_shouhin_mr.shiire_tanka);
                            $(jqmeisaif + (i + gyou) + 'Tanka').val(0);//data[i - 1].gen_shouhin_mr.hyoujun_genka);
                        } else {
                            $(jqmeisaif + (i + gyou) + 'Gentanka').val(data[i - 1].gen_shouhin_mr.uri_genka);
                            $(jqmeisaif + (i + gyou) + 'Tanka').val(data[i - 1].gen_shouhin_mr[tanka_shurui_kbns[$("#fieldTankaShuruiKbnCd").val()]]);//tanka_shurui_kbn_cdによって選ぶ
                        }
                        $(jqmeisaif + (i + gyou) + 'SoukoMrCd').val($(jqmeisaif + gyou + 'SoukoMrCd').val());
                        if ($(jqmeisaif + (i + gyou) + 'UtiwakeKbnCd').val() == '') {
                            $(jqmeisaif + i + "UtiwakeKbnCd").val('10');
                        }
                        var zaiko_kbnx = 3 - $(jqmeisaif + (i + gyou) + 'ZaikoKbn').val();
                        if (data[i - 1].keisu == 1 && $($(jqmeisaif + (i + gyou) + 'TanniMr' + zaiko_kbnx + 'Cd' == jqmeisaif + gyou + 'TanniMr' + zaiko_kbn0x + 'Cd').val()).val()) {
                            $(jqmeisaif + (i + gyou) + 'Suuryou' + zaiko_kbnx).val($(jqmeisaif + gyou + 'Suuryou' + zaiko_kbn0x).val());
                            $(jqmeisaif + (i + gyou) + 'Lot').val($(jqmeisaif + gyou + 'Lot').val());
                            $(jqmeisaif + (i + gyou) + 'Iro').val($(jqmeisaif + gyou + 'Iro').val());
                            $(jqmeisaif + (i + gyou) + 'Iromei').val($(jqmeisaif + gyou + 'Iromei').val());
                            //    $(jqmeisaif + (i + gyou) + 'HinsituKbnCd').val($(jqmeisaif + gyou + 'HinsituKbnCd').val()); // 品質は元から複写しない2019/3/26井浦
                        }
                        $(jqmeisaif + (i + gyou) + 'Tanka').change();
                        $(jqmeisaif + (i + gyou) + 'Suuryou').change();
                    }
                    if (i + gyou >= imax) {
                        addUriageMeisaiDt();//新規行を追加
                    }
                    $(jqmeisaif + gyou + 'Suuryou2').change();
                }
            },
            error: function (xhr, status, err) {
                alert('>システムエラー: ' + status + '/' + err);
            },
        });
    }
}

$(document).on('click', '.kousei_oya', function () {
    var gyou = 1 * (lastfocusin.substr(20, 10).match(/^\d+/));
    if ($(this).val() === '-') {
        $("#meisaiTable tr[class='kodomo" + gyou + "']").hide();
        $(this).val('+');
    } else {
        $("#meisaiTable tr[class='kodomo" + gyou + "']").show();
        $(this).val('-');
    }
});

$("[id$='Lot']").dblclick(function () { //商品マスター索引 lot_summary_modal
    modalstart(lot_summary_modal, "ロット別在庫", "?cd=" + $('#' + lastfocusin.slice(0, -3) + "ShouhinMrCd").val().replace('+', '%2B'));
});

/* モーダルダイヤログ部分 */
function f8key() {
    if (lastfocusin == "fieldCd") { /* 売上伝票選択 */
        modalstart1(den_modal, "売上伝票選択");
    } else if (lastfocusin == "fieldJuchuuDtCd") { /* 受注伝票選択 */
        modalstart(juchuu_dts_modal, "受注伝票選択");
    } else if (lastfocusin == "fieldMitumoriDtId") { /* 見積伝票選択 */
        modalstart(mitumori_dts_modal, "見積伝票選択");
    } else if (lastfocusin == "fieldTokuisakiMrCd") { /* 得意先コード選択 */
        modalstart(tokuisaki_mrs_modal, "得意先選択");
    } else if (lastfocusin == "fieldNounyuusakiMrCd") { /* 納入先コード選択 */
        modalstart(nounyuusaki_mrs_modal, "納入先選択");
    } else if (lastfocusin == "fieldKidukesakiMrCd") { /* 気付先コード選択 */
        modalstart(nounyuusaki_mrs_modal, "気付先選択");
    } else if (lastfocusin.slice(-11) == "ShouhinMrCd") { /* 商品コード選択 */
        modalstart(shouhin_mrs_modal, "商品選択");
    } else if (lastfocusin.slice(-3) == "Lot") { /* ロット別在庫選択 */
        modalstart(lot_zaiko_modal, "ロット別在庫", "?cd=" + $('#' + lastfocusin.slice(0, -3) + "ShouhinMrCd").val().replace('+', '%2B'));
    } else if (lastfocusin.slice(-11) === 'ProjectMrCd') {
        modalstart(project_mrs_modal, "プロジェクト選択");
    } else if (lastfocusin.slice(-8) == "Kobetucd") { /* 個別在庫選択 */
        modalstart(kobetu_zaiko_modal, "個別在庫", "?cd=" + $('#' + lastfocusin.slice(0, -8) + "ShouhinMrCd").val().replace('+', '%2B'));
    } else if (lastfocusin.slice(-5) === 'Tanka') {	/* 単価選択 Add By Nishiyama 2019/1/8/ */
        //商品コードをパラメータークエリへ投げる。
        let currntId = document.activeElement.id;
        let rowIndex = currntId.replace(/[^0-9^\.]/g, "");
        let rowId = '#fieldUriageMeisaiDts' + rowIndex + 'ShouhinMrCd';
        let product_code = $(rowId).val();
        let tokuisaki_code = $('#fieldTokuisakiMrCd').val();
        if (tokuisaki_code === '') {
            alert('得意先を選択してください。');
            return;
        }
        modalstart(uriage_meisai_dts_modal, "売上単価履歴", "?cd=" + product_code.replace('+', '%2B') + "&tokuisaki=" + tokuisaki_code);
    } else if (lastfocusin == "fieldUriagebi") { /* 売上日選択 */
        open_datepicker();
    } else if (lastfocusin == "fieldZeirituTekiyoubi") { /* 税率適用日選択 */
        open_datepicker();
    } else if (lastfocusin == "fieldShukkabi") { /* 出荷日選択 */
        open_datepicker();
    }
}

$('#fieldTokuisakiMrCd').focusout(function () { /* 得意先コード選択 */
    if ($('#fieldTokuisakiMrCd').val() == '') {
        modalstart(tokuisaki_mrs_modal, "得意先選択");
        setTimeout(function () {
            lastfocusin = "fieldTokuisakiMrCd";
        }, 1000); // 1秒後フォーカス設定し直し
    }
});

/* モーダル印刷ダイヤログ部分 */
function f5key() {
    modalstart(chouhyou_mrs_modal, "売上伝票印刷", "/uriage"); // uriage=売上伝票
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

function modalstart1(url, title, para) {
    $('#iframe-title').text(title);
    $('#iframe-wrap').fadeIn();
    if (!para) {
        para = '?cd=' + $('#' + lastfocusin).val();
    }
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

/*
* LOT選択時に、倉庫コードまで入れるように変更 Add By Nishiyama 2019/2/22
 */
function fromModal(retval, retsouko = '', zaikosuu = '', iro = '', iromei = '', hinsitu_kbn_cd = '') {
    $('#iframe-wrap').fadeOut(function () {
            $('#' + lastfocusin).val(retval);
            $('#' + lastfocusin).change();
            //倉庫コードを選択するために追加
            if (retsouko !== '') {
                var currntId = document.activeElement.id;
                var rowIndex = currntId.replace(/[^0-9^\.]/g, "");
                var souko_code = retsouko.toString();
                let rowId = '#fieldUriageMeisaiDts' + rowIndex + 'SoukoMrCd';
                $(rowId).val(souko_code);
            }
            //LOT在庫数量
            if (zaikosuu !== '') {
                let zaiko = parseFloat(zaikosuu);
                $("#fieldGenzaiko").val(zaiko);
            }
            //色番
            if (iro !== '') {
                let iroID = '#fieldUriageMeisaiDts' + rowIndex + 'Iro';
                $(iroID).val(iro);
            }
            //色名
            if (iromei !== '') {
                let iroName = '#fieldUriageMeisaiDts' + rowIndex + 'Iromei';
                $(iroName).val(iromei);
            }
            if (hinsitu_kbn_cd !== '') {
                let hinshitu = '#fieldUriageMeisaiDts' + rowIndex + 'HinsituKbnCd';
                $(hinshitu).val(hinsitu_kbn_cd);
                $(hinshitu +  'option[value=' + hinsitu_kbn_cd + ']').prop('selected',true);
            }
        }
    );
    $('#iframe-bg').fadeOut();
    $('#' + lastfocusin).focus().select();
}

function fromModalKobetu(retval) {
    $('#iframe-wrap').fadeOut(
        function () {//alert("フェードアウト完了")
            if (retval) {
                var i0 = 1 * lastfocusin.slice(0, -8).slice(20); //fieldUriageMeisaiDts0Kobetucd 右から8桁消し左から20桁消す
                $('#' + lastfocusin).val(retval[0].kobetucd);
                $(jqmeisaif + i0 + 'Suuryou1').val(retval[0].suuryou1);
                $(jqmeisaif + i0 + 'Suuryou2').val(retval[0].suuryou2);
                $(jqmeisaif + i0 + 'HinsituKbnCd').val(retval[0].hinsitucd);
                $(jqmeisaif + i0 + 'Lot').val(retval[0].lot);
                $(jqmeisaif + i0 + 'Iro').val(retval[0].iroban);
                $(jqmeisaif + i0 + 'Iromei').val(retval[0].iromei);
                $(jqmeisaif + i0 + 'SoukoMrCd').val(retval[0].soukocd);
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
                    $(jqmeisaif + i1 + 'SuuShousuu').val($(jqmeisaif + i0 + 'SuuShousuu').val());
                    $(jqmeisaif + i1 + 'Suu1Shousuu').val($(jqmeisaif + i0 + 'Suu1Shousuu').val());
                    $(jqmeisaif + i1 + 'Suu2Shousuu').val($(jqmeisaif + i0 + 'Suu2Shousuu').val());
                    $(jqmeisaif + i1 + 'TankaKbn').val($(jqmeisaif + i0 + 'TankaKbn').val());
                    $(jqmeisaif + i1 + 'ZaikoKbn').val($(jqmeisaif + i0 + 'ZaikoKbn').val());
                    $(jqmeisaif + i1 + 'TankaShousuu').val($(jqmeisaif + i0 + 'TankaShousuu').val());
                    $(jqmeisaif + i1 + 'Gentanka').val($(jqmeisaif + i0 + 'Gentanka').val());
                    $(jqmeisaif + i1 + 'Tanka').val($(jqmeisaif + i0 + 'Tanka').val());
                    $(jqmeisaif + i1 + 'ProjectMrCd').val($(jqmeisaif + i0 + 'ProjectMrCd').val());
                    $(jqmeisaif + i1 + 'ZeirituMrCd').val($(jqmeisaif + i0 + 'ZeirituMrCd').val());
                    $(jqmeisaif + i1 + 'KazeiKbnCd').val($(jqmeisaif + i0 + 'KazeiKbnCd').val());
                    $(jqmeisaif + i1 + 'Kobetucd').val(retval[i].kobetucd);
                    $(jqmeisaif + i1 + 'Suuryou1').val(retval[i].suuryou1);
                    $(jqmeisaif + i1 + 'Suuryou2').val(retval[i].suuryou2);
                    $(jqmeisaif + i1 + 'HinsituKbnCd').val(retval[i].hinsitucd);
                    $(jqmeisaif + i1 + 'Lot').val(retval[i].lot);
                    $(jqmeisaif + i1 + 'Iro').val(retval[i].iroban);
                    $(jqmeisaif + i1 + 'Iromei').val(retval[i].iromei);
                    $(jqmeisaif + i1 + 'SoukoMrCd').val(retval[i].soukocd);
                    $(jqmeisaif + i1 + 'TanniMr1Cd').val(retval[i].tanni1cd);
                    $(jqmeisaif + i1 + 'TanniMr2Cd').val(retval[i].tanni2cd);
                    $(jqmeisaif + i1 + 'TanniMr1Cd').change();
                    gyou_kingaku_saikeisan(idmeisaif + i1); // 行金額再計算
                    addUriageMeisaiDt();//新規行を追加
                }
                denpyou_goukei_saikeisan();
            }
        }
    );
    $('#iframe-bg').fadeOut();
    $('#' + lastfocusin).focus().select();
}

function fromModal1(retval) { // 印刷モーダルからの帰り
    $('#iframe-wrap').fadeOut(
        function () {//alert("フェードアウト完了")
            if (retval) {
                //2019/8/21 Nishiyama 印刷同時更新を禁止する
                $('#fieldChouhyouMrId').val('');
                location.href = server_name + $("#id").val() + "/" + retval
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
$("#fieldTorihikiKbnCd").change(function () { //取引区分が変更されたら
    $("#fieldKaishuuYoteibi").attr('readonly', $(this).val() * 1 != 3); // 3:都度請求ならfalse
});

$("#fieldZeirituTekiyoubi").change(function () { //税適用日が変更されたら
    for (var i = 0; i < imax - 1; i++) {
        $(jqmeisaif + i + 'ZeirituMrCd').val('');
    }
    zeiritu_kettei_imax();// 明細の課税区分を再設定する
});

$("#fieldZeiTenkaKbnCd").change(function () { //税転嫁区分が変更されたら
    zeiritu_kettei_imax();// 明細の課税区分を再設定する
});

function zeiritu_kettei(idleft,flg = false) { //税率決定（行指定） //商品変更時バグるので応急処置(引数flg)
    var jqleft = '#' + idleft;
    /* 税率バグ修正 西山 2019/9/30 */
    // 加工支給預りメモ等は税率は外０
    if ($(jqleft + 'UtiwakeKbnCd').val() >= 20 && $(jqleft + 'UtiwakeKbnCd').val() <= 50) {
        $(jqleft + "ZeirituMrCd").children().remove(); //option消去
        $(jqleft + "ZeirituMrCd").append($("<option>").val("90").text("90=外0%"));
    } else if ($('#fieldZeiTenkaKbnCd').val() == '30') { //輸出なら
        $(jqleft + "ZeirituMrCd").children().remove(); //option消去
        $(jqleft + "ZeirituMrCd").append($("<option>").val("70").text("70=輸出"));
    } else {
        var kijunbi = $("#fieldUriagebi").val();
        if ($("#fieldZeirituTekiyoubi").val() !== '' && $("#fieldKijunbi").val() !== '0000-00-00') {
            kijunbi = $("#fieldZeirituTekiyoubi").val();
            //Add By Nishiyama 2019-10-29
            {
                alert('指定税率日の日付形式が正しくない為、売上日を基準とします。');
                $("#fieldZeirituTekiyoubi").val('');
                kijunbi = $("#fieldUriagebi").val();
            }
        }
        var date_kijunbi = new Date(kijunbi.replace(/-/g, '/'));
        var selected_cd = '';
        selected_cd = $(jqleft + "ZeirituMrCd").val(); //前の状態を引き継ぐと間違えの元となるので削除2019/4/11井浦  //税率バグ対策 2019/8/26
        var kazei_kbn_cd = $('#' + idleft + 'KazeiKbnCd').val();
        var select_cd = '';
        /* 税率バグ修正 西山 2019/9/30 */
        if (kazei_kbn_cd === '2') {
            $(jqleft + "ZeirituMrCd").val('80');
            $(jqleft + "ZeirituMrCd").append($("<option>").val("80").text("80=非0%"));
        } else {
            $(jqleft + "ZeirituMrCd").val('');
            $(jqleft + "ZeirituMrCd").children().remove();
        }

        for (var i in zeiritu_mrs) {
            if (zeiritu_mrs[i]['cd'] != '70') { //輸出以外を追加
                $(jqleft + "ZeirituMrCd").append($("<option>").val(zeiritu_mrs[i]['cd']).text(zeiritu_mrs[i]['disp']));
                //商品変更時バグるので応急処置(引数flg)
                if (!flg) {
                    if (selected_cd == zeiritu_mrs[i]['cd']) {
                        select_cd = selected_cd
                    }
                } else {
                    if (selected_cd == zeiritu_mrs[i]['cd'] && kazei_kbn_cd === zeiritu_mrs[i]['kazei_kbn_cd']) {
                        select_cd = selected_cd
                    }
                }

                var date_mr_kijunbi = new Date(zeiritu_mrs[i]['kijunbi'].replace(/-/g, '/')); //基準日を日付オブジェクトに変換して
                if (select_cd == '' && zeiritu_mrs[i]['kazei_kbn_cd'] == kazei_kbn_cd && date_kijunbi >= date_mr_kijunbi) {
                    //該当がまだなく'' 課税区分が一致して 基準日を比較して満たしていれば選択する
                    select_cd = zeiritu_mrs[i]['cd'];
                }
            }
        }
        if (select_cd != '') {
            $(jqleft + "ZeirituMrCd").val(select_cd);
        }
    }
    gyou_kingaku_kanma(idleft); // 行金額端数処理カンマ編集
    $('#' + idleft + 'TanniMr1Cd').change();
}

/*
 * 日付の妥当性のチェック Add By Nishiyama 2019-10-29
 */
function check_date(s) {
    if (typeof s == "string") {
        if (s.match(/^(\d+)\/(\d+)\/(\d+)$/)) {
            return true
        } else if (s.match(/^(\d+)-(\d+)-(\d+)$/)) {
            return true
        }
    }
    return false;
}

function zeiritu_kettei_imax() {
    for (var i = 0; i < imax - 1; i++) {
        zeiritu_kettei(idmeisaif + i);
    }
    denpyou_goukei_saikeisan(); // 伝票合計再計算
}

$("[id$='Cd']").change(function () { //行番号が変更されたら
    var idleft = $(this).attr("id").slice(0, -2); //fieldUriageMeisaiDts0Cd 右から2桁消す
    if (idleft.length < 26 && idleft.slice(0, 20) == 'fieldUriageMeisaiDts') {
        var jqleft = '#' + idleft;
        if ($(this).val() == 0) { // 行番号＝０なら数量０金額０
            $(jqleft + "Suuryou1").val(0);
            $(jqleft + "Suuryou2").val(0);
            suu1or2change(idleft); // 行金額再計算
        }
    }
});

$("[id$='UtiwakeKbnCd']").change(function () { //内訳区分が変更されたら
    var idleft = $(this).attr("id").slice(0, -12); //fieldUriageMeisaiDts0UtiwakeKbnCd 右から12桁消す
    var jqleft = '#' + idleft;
    $(jqleft + "ZeirituMrCd").val("");
    zeiritu_kettei(idleft); // 税率を設定し直し
    gyou_kingaku_saikeisan(idleft); // 行金額再計算
});

$("[id$='Suuryou']").change(function () { //元数量が変更されたら
    var idleft = $(this).attr("id").slice(0, -7); //fieldUriageMeisaiDts0Suuryou 右から7桁消す
    suu_keisu_change(idleft);
});

$("[id$='Keisu']").change(function () { //係数が変更されたら
    var idleft = $(this).attr("id").slice(0, -5); //fieldUriageMeisaiDts0Keisu 右から5桁消す
    suu_keisu_change(idleft);
});

function suu_keisu_change(idleft) { //元数量か係数が変更された時の共通処理
    var jqleft = '#' + idleft;
    if (1 * $(jqleft + "Keisu").val() !== 0 && 1 * $(jqleft + "Suuryou").val().replace(/,/g, '') !== 0) {
        var suufld = $(jqleft + "Suuryou" + $(jqleft + "ZaikoKbn").val());
        suufld.val(1 * $(jqleft + "Keisu").val().replace(/,/g, '') * $(jqleft + "Suuryou").val().replace(/,/g, ''));
        if (1 * $(jqleft + "Irisuu").val().replace(/,/g, '') !== 0) {
            if ($(jqleft + "ZaikoKbn").val() == 1) {
                $(jqleft + "Suuryou2").val($(jqleft + "Suuryou1").val().replace(/,/g, '') * $(jqleft + "Irisuu").val().replace(/,/g, ''));
            } else {
                $(jqleft + "Suuryou1").val($(jqleft + "Suuryou2").val().replace(/,/g, '') / $(jqleft + "Irisuu").val().replace(/,/g, ''));
            }
        }
        suufld.change();
    }
}

$("[id$='Irisuu']").change(function () { //入数が変更されたら
    var idleft = $(this).attr("id").slice(0, -6); //fieldUriageMeisaiDts0Irisuu 右から6桁消す
    var jqleft = '#' + idleft;
    if (1 * $(jqleft + "Suuryou2").replace(/,/g, '') == 0) {
        $(jqleft + "Suuryou2").val(1 * $(this).val().replace(/,/g, '') * $(jqleft + "Suuryou1").val().replace(/,/g, ''));
        $(jqleft + "Suuryou2").change();
    }
});

$("[id$='Suuryou1']").change(function () { //数量1が変更されたら
    var idleft = $(this).attr("id").slice(0, -8); //fieldUriageMeisaiDts0Suuryou1 右から8桁消す
    var jqleft = '#' + idleft;
    var suu1 = 1 * $(this).val().replace(/,/g, '');
    if (1 * $("#" + idleft + "Irisuu").val().replace(/,/g, '') !== 0) {
        $("#" + idleft + "Suuryou2").val(suu1 * $(jqleft + "Irisuu").val());
        $("#" + idleft + "Suuryou2").change();
    }
    var sh1 = $(jqleft + "Suu1Shousuu").val(); // 小数桁を揃える
    $(this).val(Intl.NumberFormat("ja-JP", {minimumFractionDigits: sh1, maximumFractionDigits: sh1}).format(suu1));//カンマ編集
    if ($(jqleft + "TankaKbn").val() == 1 || $(jqleft + "ZaikoKbn").val() == 1) { // バグZaikoKbnを見ていたので修正2019/3/6井浦
        suu1or2change(idleft);
    }
    $("#" + idleft + "Suuryou2").change();
    denpyou_goukei_saikeisan();
});

$("[id$='Suuryou2']").change(function () { //数量2が変更されたら
    var idleft = $(this).attr("id").slice(0, -8); //fieldUriageMeisaiDts0Suuryou2
    gyou_suuryou_change(idleft);    //小数桁を揃える
    suu1or2change(idleft);
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

function suu1or2change(idleft) {
    var jqleft = '#' + idleft;
    if ($(jqleft + "UtiwakeKbnCd").val() == 20 || $(jqleft + "UtiwakeKbnCd").val() == 24) { // 内部生産
        var tanka_kbn0 = $(jqleft + "TankaKbn").val();
        var tanka_kbn0x = 3 - tanka_kbn0;
        var zaiko_kbn0 = $(jqleft + "ZaikoKbn").val();
        var zaiko_kbn0x = 3 - zaiko_kbn0;
        var gyou = 1 * idleft.slice(20);
        var goukeisuuryou = 0;
        var goukeisuuryou1 = $(jqleft + "Suuryou1").val().replace(/,/g, '');
        var goukeisuuryou2 = $(jqleft + "Suuryou2").val().replace(/,/g, '');
        //		※明細の合計をしないように変更。2019/2/5 井浦
        //		for (i = 0; i<imax; i++) {
        //			if ($(jqmeisaif+i+"UtiwakeKbnCd").val() == $(jqleft+"UtiwakeKbnCd").val() && $(jqmeisaif+i+"Cd").val() != 0) {
        //				goukeisuuryou1 += 1*$(jqmeisaif+i+"Suuryou1").val().replace(/,/g,'');
        //				goukeisuuryou2 += 1*$(jqmeisaif+i+"Suuryou2").val().replace(/,/g,'');
        //			}
        //		}
        goukeisuuryou = zaiko_kbn0 == 1 ? goukeisuuryou1 : goukeisuuryou2;
        var i0 = 1 * idleft.slice(20);
        for (i = i0 + 1; i < imax; i++) {
            if ($(jqmeisaif + i + "UtiwakeKbnCd").val() == 10 || $(jqmeisaif + i + "UtiwakeKbnCd").val() == 21 || $(jqmeisaif + i + "UtiwakeKbnCd").val() == 15) {
                $(jqmeisaif + i + 'Suuryou').val(goukeisuuryou);
                var tanka_kbn = $(jqmeisaif + i + 'TankaKbn').val();
                var zaiko_kbn = $(jqmeisaif + i + 'ZaikoKbn').val();
                var sh = $(jqmeisaif + i + "Suu" + zaiko_kbn + "Shousuu").val(); // 小数桁を揃える

                $(jqmeisaif + i + 'Suuryou' + zaiko_kbn).val(Intl.NumberFormat("ja-JP", {
                    minimumFractionDigits: sh,
                    maximumFractionDigits: sh
                }).format($(jqmeisaif + i + "Keisu").val().replace(/,/g, '') * goukeisuuryou));
                if (zaiko_kbn == 1 && $(jqmeisaif + i + 'Irisuu').val().replace(/,/g, '') != 0) {
                    var sh2 = $(jqmeisaif + i + "Suu2Shousuu").val();
                    $(jqmeisaif + i + 'Suuryou2').val(Intl.NumberFormat("ja-JP", {
                        minimumFractionDigits: sh2,
                        maximumFractionDigits: sh2
                    }).format($(jqmeisaif + i + "Suuryou1").val().replace(/,/g, '') * $(jqmeisaif + i + 'Irisuu').val().replace(/,/g, '')));
                }
                $(jqmeisaif + i + 'Kingaku').val($(jqmeisaif + i + "Suuryou" + tanka_kbn).val().replace(/,/g, '') * $(jqmeisaif + i + "Tanka").val().replace(/,/g, ''));
                var tanka_kbnx = 3 - tanka_kbn;
                var zaiko_kbnx = 3 - zaiko_kbn;
                if ($(jqmeisaif + i + 'Keisu').val() == 1 && $(jqleft + 'TanniMr' + zaiko_kbn0x + 'Cd').val() == $(jqmeisaif + i + 'TanniMr' + zaiko_kbnx + 'Cd').val()) {
                    //以下の項目を対象行より引っ張ると、間違えの元なのでコメントアウト Add By Nishiyama 2019/3/7
                    //$(jqmeisaif + i + 'Suuryou' + zaiko_kbnx).val($(jqleft + 'Suuryou' + zaiko_kbn0x).val());
                    //$(jqmeisaif + i + 'Lot').val($(jqleft + 'Lot').val());
                    //$(jqmeisaif + i + 'Iro').val($(jqleft + 'Iro').val());
                    //$(jqmeisaif + i + 'Iromei').val($(jqleft + 'Iromei').val());
                    //===========================================================================
                    $(jqmeisaif + i + 'HinsituKbnCd').val($(jqleft + 'HinsituKbnCd').val());
                }
                gyou_kingaku_saikeisan(idmeisaif + i); // 行金額再計算
            } else {
                break; // ※該当元行に関連する部分が終ったらやめる。2019/2/5 井浦
            }
        }
    } else {
        gyou_kingaku_saikeisan(idleft); // 行金額再計算
    }
    denpyou_goukei_saikeisan(); // 伝票合計再計算
}

$("[id$='TankaKbn']").change(function () { //単価区分が変更されたら
    var idleft = $(this).attr("id").slice(0, -8); //fieldUriageMeisaiDts0TankaKbn 右から8桁消す
    gyou_kingaku_saikeisan(idleft); // 行金額再計算
    denpyou_goukei_saikeisan(); // 伝票合計再計算
});

function gyou_kingaku_saikeisan(idleft) { // 行金額再計算
    var jqleft = '#' + idleft;
    if ($(jqleft + "UtiwakeKbnCd").val() < 20) {
        if (!$(jqleft + "TankaKbn").val()) {
            $(jqleft + "TankaKbn").val(2)
        }
        var suufld = $(jqleft + "Suuryou" + $(jqleft + "TankaKbn").val());
        $(jqleft + "Kingaku").val(Math.round(1000 * suufld.val().replace(/,/g, '')) * Math.round(1000 * $(jqleft + "Tanka").val().replace(/,/g, '')) / 1000000); //金額=数量*単価
    } else {
        $(jqleft + "Kingaku").val(0);
    }
    $(jqleft + 'TanniMr1Cd').change();
    gyou_kingaku_kanma(idleft); // 行金額端数処理カンマ編集
}

$("[id$='TanniMr1Cd']").change(function () { //単位1が変更されたら
    var idleft = $(this).attr("id").slice(0, -10); //fieldUriageMeisaiDts0TanniMr1Cd 右から10桁消す
    var jqleft = '#' + idleft;
    var tanka_kbn = $(jqleft + 'TankaKbn');
    var tanka_kbn_sel = tanka_kbn.val();
    tanka_kbn.children().remove();
    tanka_kbn.append($("<option>").val('1').text('/' + $(jqleft + 'TanniMr1Cd option:selected').text()));
    tanka_kbn.append($("<option>").val('2').text('/' + $(jqleft + 'TanniMr2Cd option:selected').text()));
    tanka_kbn.val(tanka_kbn_sel);
});

$("[id$='TanniMr2Cd']").change(function () { //単位2が変更されたら
    var idleft = $(this).attr("id").slice(0, -10); //fieldUriageMeisaiDts0TanniMr1Cd 右から10桁消す
    var jqleft = '#' + idleft;
    $(jqleft + 'TanniMr1Cd').change();
});

$("[id$='Gentanka']").change(function () { //原単価が変更されたら
    var idleft = $(this).attr("id").slice(0, -8); //fieldUriageMeisaiDts0Gentanka 右から8桁消す
    var jqleft = '#' + idleft;
    $(this).val($(this).val().replace(/,/g, ''));//カンマ編集を一旦戻す
    sh2 = $(jqleft + "TankaShousuu").val();
    if ($(jqleft + "MotoTanniMr2Cd").val() == $(jqleft + "TanniMr2Cd").val()) {
        sh1 = sh2;
    } else {
        sh1 = 0;
    }
    $(this).val(Intl.NumberFormat("ja-JP", {
        minimumFractionDigits: sh1,
        maximumFractionDigits: sh2
    }).format($(this).val()));//カンマ編集
    denpyou_goukei_saikeisan(); // 伝票合計再計算
});

$("[id$='Tanka']").change(function () { //単価が変更されたら
    var idleft = $(this).attr("id").slice(0, -5); //fieldUriageMeisaiDts0Tanka 右から5桁消す
    var jqleft = '#' + idleft;
    $(this).val($(this).val().replace(/,/g, ''));//カンマ編集を一旦戻す
    sh2 = $(jqleft + "TankaShousuu").val();
    if ($(jqleft + "MotoTanniMr2Cd").val() == $(jqleft + "TanniMr2Cd").val()) {
        sh1 = sh2;
    } else {
        sh1 = 0;
    }
    $(this).val(Intl.NumberFormat("ja-JP", {
        minimumFractionDigits: sh1,
        maximumFractionDigits: sh2
    }).format($(this).val()));//カンマ編集
    gyou_kingaku_saikeisan(idleft); // 行金額再計算
    denpyou_goukei_saikeisan(); // 伝票合計再計算
});

$("[id$='Kingaku']").change(function () { //金額が変更されたら
    var idleft = $(this).attr("id").slice(0, -7); //fieldUriageMeisaiDts0Kingaku 右から7桁消す
    gyou_kingaku_kanma(idleft); // 行金額端数処理カンマ編集
    denpyou_goukei_saikeisan(); // 伝票合計再計算
});

$("[id$='ZeirituMrCd']").change(function () { //税率が変更されたら
    var idleft = $(this).attr("id").slice(0, -11); //fieldUriageMeisaiDts0ZeirituMrCd 右から11桁消す
    gyou_kingaku_kanma(idleft); // 行金額端数処理カンマ編集
    denpyou_goukei_saikeisan(); // 伝票合計再計算
});

function gyou_kingaku_kanma(idleft) { // 行金額端数処理カンマ編集,切り上げ切り捨てサインで分ける2019/4/4井浦
    var jqleft = '#' + idleft;
    var kingaku = 1.0 * $(jqleft + "Kingaku").val().replace(/,/g, ''); //カンマ編集を一旦戻す
    switch (1 * $("#gaku_hasuu_shori_kbn_cd").val()) {
        case 1:
            if (kingaku >= 0) {
                kingaku = Math.floor(kingaku);
            } else {
                kingaku = Math.ceil(kingaku);
            }
            break;//切り捨てtruncはfirefoxだけ
        case 2:
            //切り上げ、マイナスの場合、0より遠い方へ切り上げられる為
            if (kingaku >= 0) {
                kingaku = Math.ceil(kingaku);
            } else {
                kingaku = Math.floor(kingaku);
            }
            break;
        default:
            kingaku = Math.round(kingaku);
            break;//四捨五入
    }
    $(jqleft + "Kingaku").val(Intl.NumberFormat("ja-JP", {
        minimumFractionDigits: 0,
        maximumFractionDigits: 0
    }).format(kingaku));//カンマ編集
    zeiritu = 0.01 * cd_zeiritu[$(jqleft + "ZeirituMrCd").val()];
    if ($("#fieldZeiTenkaKbnCd").val().substr(0, 1) == "2") { //内税
        switch (1 * $("#zei_hasuu_shori_kbn_cd").val()) {
            case 1:
                if (kingaku >= 0) {
                    $(jqleft + "Zeigaku").val(Math.floor(kingaku / (1 + zeiritu) * zeiritu));
                } else {
                    $(jqleft + "Zeigaku").val(Math.ceil(kingaku / (1 + zeiritu) * zeiritu));
                }
                break;//切り捨てtruncはfirefoxだけ
            case 2:
                if (kingaku >= 0) {
                    $(jqleft + "Zeigaku").val(Math.ceil(kingaku / (1 + zeiritu) * zeiritu));
                } else {
                    $(jqleft + "Zeigaku").val(Math.floor(kingaku / (1 + zeiritu) * zeiritu));
                }
                break;
            default:
                $(jqleft + "Zeigaku").val(Math.round(kingaku / (1 + zeiritu) * zeiritu));
                break;//四捨五入
        }
        $(jqleft + "Zeinukigaku").val(kingaku - $(jqleft + "Zeigaku").val());
    } else if ($("#fieldZeiTenkaKbnCd").val() == "40") { // 税額手入力なら
        if ($(jqleft + "Utiwake").val() == "90") { // 消費税手入力行なら
            $(jqleft + "Zeigaku").val(kingaku); // 金額を全て消費税にする…税抜額が０円になる
            $(jqleft + "Zeinukigaku").val(0);
        } else {
            $(jqleft + "Zeigaku").val(0);
            $(jqleft + "Zeinukigaku").val(kingaku);
        }
    } else {										//外税など
        switch (1 * $("#zei_hasuu_shori_kbn_cd").val()) {
            case 1:
                if (kingaku >= 0) {
                    $(jqleft + "Zeigaku").val(Math.floor(kingaku * zeiritu));
                } else {
                    $(jqleft + "Zeigaku").val(Math.ceil(kingaku * zeiritu));
                }
                break;//切り捨てtruncはfirefoxだけ
            case 2:
                //切り上げ
                if (kingaku >= 0) {
                    $(jqleft + "Zeigaku").val(Math.ceil(kingaku * zeiritu));
                } else {
                    $(jqleft + "Zeigaku").val(Math.floor(kingaku * zeiritu));
                }
                break;

            default:
                $(jqleft + "Zeigaku").val(Math.round(kingaku * zeiritu));
                break;//四捨五入
        }
        $(jqleft + "Zeinukigaku").val(kingaku);
    }
}

function denpyou_goukei_saikeisan() { // 伝票合計再計算
    zeinukigaku = 0;
    shouhizeigaku = 0;
    genkagaku = 0;
    gsuuryou1 = 0;
    gsuuryou2 = 0;
    var ritubetugaku = {};
    var idleft = idmeisaif;
    var jqleft = '#' + idleft;
    for (i = 0; i < imax - 1; i++) {
        var tanka_kbn = $(jqleft + i + 'TankaKbn').val();
        var suufld = $(jqleft + i + 'Suuryou' + tanka_kbn);
        zeinukigaku += 1 * $(jqleft + i + 'Zeinukigaku').val();
        shouhizeigaku += 1 * $(jqleft + i + 'Zeigaku').val();
        gsuuryou1 += 1 * $(jqleft + i + 'Suuryou1').val().replace(/,/g, '');
        gsuuryou2 += 1 * $(jqleft + i + 'Suuryou2').val().replace(/,/g, '');
        if ($(jqleft + i + 'UtiwakeKbnCd').val() < 20) { // 通常などのみ計算truncはfirefoxだけ
            if (1 * suufld.val().replace(/,/g, '') >= 0) {
                $(jqleft + i + 'Genkagaku').val(Math.floor(Math.round($(jqleft + i + 'Gentanka').val().replace(/,/g, '') * suufld.val().replace(/,/g, '') * 1000) / 1000)); //切り捨て20190729変更100→1000
            } else {
                $(jqleft + i + 'Genkagaku').val(Math.ceil(Math.round($(jqleft + i + 'Gentanka').val().replace(/,/g, '') * suufld.val().replace(/,/g, '') * 1000) / 1000)); //切り捨て
            }
        } else {
            $(jqleft + i + 'Genkagaku').val(0);
        }
        genkagaku += 1 * $(jqleft + i + 'Genkagaku').val();
        if (!ritubetugaku[$(jqleft + i + 'ZeirituMrCd').val()]) {
            ritubetugaku[$(jqleft + i + 'ZeirituMrCd').val()] = 0
        }
        ritubetugaku[$(jqleft + i + 'ZeirituMrCd').val()] += 1 * $(jqleft + i + 'Kingaku').val().replace(/,/g, ''); // 税別額[税率キー]+=金額
    }
    goukeigaku = zeinukigaku + shouhizeigaku;

    if ($("#fieldZeiTenkaKbnCd") != 20 && $("#fieldZeiTenkaKbnCd") != 30 && $("#fieldZeiTenkaKbnCd") != 40) { // 内税と輸出と税手入力は伝票合計の税額を再計算しない
        shouhizeigaku2 = 0;
        if ($("#fieldZeiTenkaKbnCd").val().substr(0, 1) == "2") { //内税(総額など)
            for (var ritukey in ritubetugaku) {
                zeiritu = 0.01 * cd_zeiritu[ritukey];
                switch (1 * $("#zei_hasuu_shori_kbn_cd").val()) {
                    case 1:
                        if (1 * ritubetugaku[ritukey] >= 0) {
                            zeigaku = Math.floor(1 * ritubetugaku[ritukey] / (1 + zeiritu) * zeiritu);
                        } else {
                            zeigaku = Math.ceil(1 * ritubetugaku[ritukey] / (1 + zeiritu) * zeiritu);
                        }
                        break;//切り捨てtruncはfirefoxだけ
                    case 2:
                        if (1 * ritubetugaku[ritukey] >= 0) {
                            zeigaku = Math.ceil(1 * ritubetugaku[ritukey] / (1 + zeiritu) * zeiritu);
                        } else {
                            zeigaku = Math.floor(1 * ritubetugaku[ritukey] / (1 + zeiritu) * zeiritu);
                        }
                        break;//切り上げ、マイナスは別が良い
                    default:
                        zeigaku = Math.round(1 * ritubetugaku[ritukey] / (1 + zeiritu) * zeiritu);
                        break;//四捨五入
                }
                shouhizeigaku2 += zeigaku;
            }
            zeinukigaku = goukeigaku - shouhizeigaku2; // 税抜額を再計算
            $("#zei_chousei_gaku").val(shouhizeigaku2 - shouhizeigaku);
            $("#zeinuki_chousei_gaku").val(shouhizeigaku - shouhizeigaku2);
        } else { //外税
            for (var ritukey in ritubetugaku) {
                zeiritu = 0.01 * cd_zeiritu[ritukey];
                switch (1 * $("#zei_hasuu_shori_kbn_cd").val()) {
                    case 1:
                        if (1 * ritubetugaku[ritukey] >= 0) {
                            zeigaku = Math.floor(1 * ritubetugaku[ritukey] * zeiritu);
                        } else {
                            zeigaku = Math.ceil(1 * ritubetugaku[ritukey] * zeiritu);
                        }
                        break;//切り捨てtruncはfirefoxだけ
                    case 2:
                        if (1 * ritubetugaku[ritukey] >= 0) {
                            zeigaku = Math.ceil(1 * ritubetugaku[ritukey] * zeiritu);
                        } else {
                            zeigaku = Math.floor(1 * ritubetugaku[ritukey] * zeiritu);
                        }
                        break;//切り上げ、マイナスは別が良い
                    default:
                        zeigaku = Math.round(1 * ritubetugaku[ritukey] * zeiritu);
                        break;//四捨五入
                }
                shouhizeigaku2 += zeigaku;
            }
            goukeigaku = zeinukigaku + shouhizeigaku2;
            $("#zei_chousei_gaku").val(shouhizeigaku2 - shouhizeigaku);
            $("#zeinuki_chousei_gaku").val(0);
        }
        shouhizeigaku = shouhizeigaku2;
    } else {
        $("#zei_chousei_gaku").val(0);
        $("#zeinuki_chousei_gaku").val(0);
    }
    $("#fieldZeinukigaku").val(Intl.NumberFormat("ja-JP", {
        minimumFractionDigits: 0,
        maximumFractionDigits: 0
    }).format(zeinukigaku));//カンマ編集
    $("#fieldShouhizeigaku").val(Intl.NumberFormat("ja-JP", {
        minimumFractionDigits: 0,
        maximumFractionDigits: 0
    }).format(shouhizeigaku));//カンマ編集
    $("#fieldGoukeigaku").val(Intl.NumberFormat("ja-JP", {
        minimumFractionDigits: 0,
        maximumFractionDigits: 0
    }).format(goukeigaku));//カンマ編集
    $("#fieldArarieki").val(Intl.NumberFormat("ja-JP", {
        minimumFractionDigits: 0,
        maximumFractionDigits: 0
    }).format(zeinukigaku - genkagaku));//カンマ編集
    $("#fieldArariekiritu").val(Intl.NumberFormat("ja-JP", {
        minimumFractionDigits: 1,
        maximumFractionDigits: 1
    }).format(100 * (zeinukigaku - genkagaku) / zeinukigaku));//カンマ編集
    $("#fieldGsuuryou1").val(Intl.NumberFormat("ja-JP", {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    }).format(gsuuryou1));//カンマ編集
    $("#fieldGsuuryou2").val(Intl.NumberFormat("ja-JP", {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    }).format(gsuuryou2));//カンマ編集
}

$("[id$='ShouhinMrCd']").focusin(function (e) {
    if ($(this).val() == '') {
        $('#fieldGenzaiko').val('');
    } else {
        var idleft = $(this).attr("id").slice(0, -11);
        try {
            var souko_cd = $('#' + idleft + 'SoukoMrCd').val();
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

//商品在庫索引
function getZaiko(shouhin_cd, souko_cd) {
    if (shouhin_cd === '') {
        $('#fieldGenzaiko').val('');
    } else {
        $.ajax({
            type: "POST",
            url: report_zaiko_vws_ajaxGet,
            data: {'cd': shouhin_cd, 'souko': souko_cd,},
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

$(function () { // テーブルのヘッドを消えなくする
    $('table.head_fix').floatThead({
        top: '50'
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
            //var tbl_width = th_width - parseInt(drag_target.css("width"));
            //var tbl_new_width = parseInt($(sheet_nm).css("width")) + tbl_width;
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
    if (fieldx == 'KidukesakiMrCd') {
        if ($("#field" + fieldx).attr("readonly") === "readonly") {
            $("#fieldKiduke").attr("readonly", "readonly");
        } else {
            $("#fieldKiduke").removeAttr("readonly");
        }
    } else if (fieldx == 'NounyuusakiMrCd') {
        if ($("#field" + fieldx).attr("readonly") === "readonly") {
            $("#fieldNounyuusaki").attr("readonly", "readonly");
        } else {
            $("#fieldNounyuusaki").removeAttr("readonly");
        }
    }
    $targetElm = $(targetElm);
}

function switch_ros(fieldx) { // 項目制御readonly設定(明細)
    if ($("#hidden" + fieldx).attr("readonly") === "readonly") {
        $("#hidden" + fieldx).removeAttr("readonly");
        for (var i = 0; i < imax; i++) {
            $(jqmeisaif + i + fieldx).removeAttr("readonly");
        }
    } else {
        $("#hidden" + fieldx).attr("readonly", "readonly");
        for (var i = 0; i < imax; i++) {
            $(jqmeisaif + i + fieldx).attr("readonly", "readonly");
        }
    }
    $targetElm = $(targetElm);
}

var ro_fields = [
    'uriagebi', 'cd', 'juchuu_dt_cd', 'mitumori_dt_cd', 'saki_hacchuu_cd', 'zeiritu_tekiyoubi', 'torihiki_kbn_cd', 'shimekiri_flg',
    'zei_tenka_kbn_cd', 'tanka_shurui_kbn_cd', 'nounyuusaki_mr_cd', 'kidukesaki_mr_cd', 'shukkabi', 'tekiyou', 'shounin_joutai_flg', 'shounin_sha_mr_cd',
    '[cd', '[utiwake_kbn_cd', '[kousei', '[shukka_kbn_cd', '[shouhin_mr_cd', '[tekiyou', '[iro', '[iromei', '[lot', '[kobetucd', '[souko_mr_cd', '[hinsitu_kbn_cd', '[suuryou', '[keisu', '[irisuu', '[suuryou1',
    '[tanni_mr1_cd', '[suuryou2', '[tanni_mr2_cd', '[juchuuzan', '[gentanka', '[tanka', '[kingaku', '[zeiritu_mr_cd', '[bikou', '[tanka_kbn', '[project_mr_cd'
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
            ro_field_name = 'data[uriage_meisai_dts][0]' + ro_fields[j] + ']';
            rewidths[ro_fields[j]] = $("[name='" + ro_field_name + "']").outerWidth();
        }
    }
    $.ajax({
        type: "POST",
        url: readonlys_ajaxSave,
        data: {'controller_cd': 'UriageDts', 'gamen_cd': 'inputfields', 'readonlys': readonlys, 'rewidths': rewidths,},
        async: true,
        dataType: 'json',
        success: function (error_count) {
            $("#save_ros").text('(click→「入力制御の保存」)').css('color', 'pink');
        },
        error: function (xhr, status, err) {
            alert('入力制御の保存でエラー Cd.change.ajax ' + status + '/' + err);
            $("#save_ros").text('(click→「入力制御の保存」)').css('color', 'pink');
        },
    });

}

function final_check() { // 最終チェック…F12登録を押したときにエラーがあれば戻る。onsubmit
    $("#F12").focus();
    f5_flg = 0;                                 // 印刷モーダルを呼ぶためのフラグ
    denpyou_goukei_saikeisan();                 // 伝票合計再計算
    if (!final_juchuu_check()) {
        if (!confirm("金額がマイナスの明細がある伝票に、受注番号が入っています。\nこのまま登録してもよろしいですか？")) {
            alert('処理を中止しました。');
            return false;
        }
    }
    $("#dispErrMsg").text("");                  // エラーメッセージクリア
    if (!final_tantou_check()) return false;    // 担当者チェック
    if (!final_meisaisuu_check()) return false; // 明細数チェック
    if (!final_meisai_check()) return false;    // 明細内チェック
    if (!final_sime_check()) return false;      // 売上日チェック
    final_meisai_zaikocheck();                  //在庫チェック
    return false;
}

function final_check_test() { // 最終チェック…F5登録を押したときにエラーがあれば戻る。onsubmit
    $("#F5").focus();
    f5_flg = 1;                                 // 印刷モーダルを呼ぶためのフラグ
    denpyou_goukei_saikeisan();                 // 伝票合計再計算
    $("#dispErrMsg").text("");                  // エラーメッセージクリア
    if (!final_tantou_check()) return false;    // 担当者チェック
    if (!final_tokuisaki_check()) return false;    // 得意先チェック
    if (!final_meisaisuu_check()) return false; // 明細数チェック
    if (!final_meisai_check()) return false;    // 明細内チェック
    f5key();                                    // 帳票モーダル
    return false;
}

//伝票削除時の在庫確認
function final_del_check(del_id = 0) {
    $("#dispErrMsg").text('');
    if (!final_meisai_zaikocheck(true, del_id)) return false;
    return false;
}

function final_tantou_check() {
    if (!($("#fieldTantouMrCd").val())) {
        $("#dispErrMsg").text("担当者を入力してください。");
        return false;
    }
    return true;
}

function final_tokuisaki_check() {
    if (!($("#fieldTokuisakiMrCd").val())) {
        $("#dispErrMsg").text("得意先を入力してください。");
        return false;
    }
    return true;
}


function final_meisaisuu_check() {
    if (imax <= 1) {
        $("#dispErrMsg").text("明細がないので、登録できません!!");
        return false;
    }
    return true;
}

function final_juchuu_check() {
    var juchuu_cd = $('#fieldJuchuuDtCd').val();
    if (juchuu_cd === '') return true;

    var jqleft = '#fieldUriageMeisaiDts';
    // 明細にマイナス金額があるかないか確認（赤伝の場合、発注受注番号があれば警告）
    for (let i = 0; i < (imax - 1); i++) {
        if ($(jqleft + i + 'Kingaku').val().indexOf('-') !== -1) {
            return false;
        }
    }
    return true;
}

function final_meisai_check() {
    var jqleft = '#fieldUriageMeisaiDts';
    for (var i = 0; i < (imax - 1); i++) {
        $(jqleft + i + "Lot").val($(jqleft + i + "Lot").val().trim()); // 空白除去
        $(jqleft + i + "Iro").val($(jqleft + i + "Iro").val().trim()); // 空白除去
        $(jqleft + i + "Iromei").val($(jqleft + i + "Iromei").val().trim()); // 空白除去
        $(jqleft + i + "Kobetucd").val($(jqleft + i + "Kobetucd").val().trim()); // 空白除去
        if (!$(jqleft + i + "Cd").val() || $(jqleft + i + "Cd").val() == 0) {
            continue;
        }
        if (!($(jqleft + i + "SoukoMrCd").val())) {
            $("#dispErrMsg").text("" + (1 + i) + "行目の倉庫を入力してください。");
            return false;
        }
        if (!($(jqleft + i + "UtiwakeKbnCd").val())) {
            $("#dispErrMsg").text("" + (1 + i) + "行目の内訳区分を入力してください。");
            return false;
        }
        if (!($(jqleft + i + "HinsituKbnCd").val())) {
            $("#dispErrMsg").text("" + (1 + i) + "行目の品質を入力してください。");
            return false;
        }
        if (!($(jqleft + i + "TanniMr1Cd").val()) || !($(jqleft + i + "TanniMr2Cd").val())) {
            $("#dispErrMsg").text("" + (1 + i) + "行目の単位を入力してください。");
            return false;
        }
        if ($(jqleft + i + "TanniMr1Cd").val() == $(jqleft + i + "TanniMr2Cd").val()) {
            $("#dispErrMsg").text("" + (1 + i) + "行目の単位1と2は別の単位を入力してください。");
            return false;
        }
        if ($(jqleft + i + "UtiwakeKbnCd").val() >= 15 && $(jqleft + i + "UtiwakeKbnCd").val() < 90
            && ($(jqleft + i + "Tanka").val() != 0 || $(jqleft + i + "Kingaku").val() != 0)) {
            $("#dispErrMsg").text("" + (1 + i) + "行目の内訳区分なら単価・金額は０円を入力してください。");
            return false;
        }
    }
    return true;
}

function final_sime_check() {
    var ymd = $('#fieldUriagebi').val().split('-');
    if (ymd.length != 3) {
        $("#dispErrMsg").text("売上日付区切り記号が正しくありません!!");
        return false;
    }
    var date = new Date(ymd[0], ymd[1] - 1, ymd[2]);
    if (ymd[0] != date.getFullYear() ||
        ymd[1] != ('0' + (date.getMonth() + 1)).slice(-2) ||
        ymd[2] != ('0' + date.getDate()).slice(-2)) {
        $("#dispErrMsg").text("売上日付年月日が正しくありません!!");
        return false;
    }
    if ($('#fieldUriagebi').val() <= $("#fieldSimezumibi").val()) {
        $("#dispErrMsg").text("締済なので登録・変更できません!!");
        return false;
    }
    return true;
}

//在庫チェック
var f5_flg = 0;         // 印刷モーダルを呼ぶためのフラグ
var zaikotable = {};

function final_meisai_zaikocheck(del_flg = false, del_id = 0) {
    var jqleft = '#fieldUriageMeisaiDts';
    var den_id = $("#id").val();
    if (del_flg) den_id = undefined;
    var den_mr_cd = 'uriage';
    var cd = '';
    var souko = '';
    var lot = '';
    var hinshitu = '';
    var iro = '';
    var iromei = '';
    var dic_key = 'key';
    //明細集計
    for (var i = 0; i < imax - 1; i++) {
        cd = $(jqleft + i + 'ShouhinMrCd').val();
        lot = $(jqleft + i + 'Lot').val();
        souko = $(jqleft + i + 'SoukoMrCd').val();
        hinshitu = $(jqleft + i + 'HinsituKbnCd').val();
        iro = $(jqleft + i + 'Iro').val();
        iromei = $(jqleft + i + 'Iromei').val();
        if (typeof iro === 'undefined') {
            iro = '';
        }
        if (typeof iromei === 'undefined') {
            iromei = '';
        }
        dic_key = cd + "," + lot + "," + souko + "," + hinshitu + "," + iro + "," + iromei;
        if (!(dic_key in zaikotable)) {//新規キー
            zaikotable[dic_key] = [cd, lot, souko, hinshitu, iro, iromei, 0.00, 0.00];
        }
        switch ($(jqleft + i + 'UtiwakeKbnCd').val()) {
            case '10':  //通常
            case '20':  //生産
            case '23':  //預り
                if (!del_flg) {
                    zaikotable[dic_key][6] += -1 * $(jqleft + i + 'Suuryou1').val().replace(/,/g, '');
                    zaikotable[dic_key][7] += -1 * $(jqleft + i + 'Suuryou2').val().replace(/,/g, '');
                } else {
                    zaikotable[dic_key][6] += 1 * $(jqleft + i + 'Suuryou1').val().replace(/,/g, '');
                    zaikotable[dic_key][7] += 1 * $(jqleft + i + 'Suuryou2').val().replace(/,/g, '');
                }
                break;
            case '11':   //返品
            case '15':  //仕切在庫
                if (!del_flg) {
                    zaikotable[dic_key][6] += 1 * $(jqleft + i + 'Suuryou1').val().replace(/,/g, '');
                    zaikotable[dic_key][7] += 1 * $(jqleft + i + 'Suuryou2').val().replace(/,/g, '');
                } else {
                    zaikotable[dic_key][6] += -1 * $(jqleft + i + 'Suuryou1').val().replace(/,/g, '');
                    zaikotable[dic_key][7] += -1 * $(jqleft + i + 'Suuryou2').val().replace(/,/g, '');
                }
                break;
        }
    }
    var msg = '';
    $.ajax({
        type: "POST",
        url: report_zaiko_vws_ajaxZaikoCheck,
        data: {'den_mr_cd': den_mr_cd, 'den_id': den_id, 'zaikotable': zaikotable,},
        async: true,
        dataType: 'json',
        success: function (data) {
            msg = data;
            zaikotable = {};
            if (msg === 'OK') {
                if (!del_flg) {
                    var res = confirm('よろしいですか?');
                    if (res && $("#fieldShimekiriFlg").val() != 0) {
                        res = confirm("締切が「次回」で、本当によろしいですか？");
                    }
                    if (res === true) {
                        if (f5_flg === 0) {
                            $('#formTouroku').submit();
                        } else {
                            f5key();
                        }
                    }
                } else {
                    let res = confirm('削除してもよろしいですか？');
                    if (res === true) {
                        window.location.href = uriage_dts_delete + del_id;
                    }
                }
            } else {
                $("#dispErrMsg").text(msg);
            }
        },
        error: function (xhr, status, err) {
            $("#dispErrMsg").text('Error => zaiko_check_draft :' + status + '/' + err);
        }
    })
}

//預り在庫チェック
function final_azukari_zaiko_check(f5_flg) {
    var den_id = $("#id").val();
    var den_mr_cd = 'uriage';
    var jqleft = '#fieldUriageMeisaiDts';
    var shouhin_mr_cd = '';
    var tokuisaki_mr_cd = $('#fieldTokuisakiMrCd').val();
    var dic_key = 'key';
    var azukari_meisai = {};
    for (let i = 0; i < imax - 1; i++) {
        shouhin_mr_cd = $(jqleft + i + 'ShouhinMrCd').val();
        dic_key = shouhin_mr_cd.trim();
        if (!(dic_key in azukari_meisai)) {
            azukari_meisai[dic_key] = [shouhin_mr_cd, tokuisaki_mr_cd, 0.00, 0.00];
        }
        switch ($(jqleft + i + 'UtiwakeKbnCd').val()) {
            case '21':  //支給消費
            case '23':  //預り
                azukari_meisai[dic_key][2] += -1 * $(jqleft + i + 'Suuryou1').val().replace(/,/g, '');
                azukari_meisai[dic_key][3] += -1 * $(jqleft + i + 'Suuryou2').val().replace(/,/g, '');
                break;
            case '15':  //仕切在庫
                azukari_meisai[dic_key][2] += 1 * $(jqleft + i + 'Suuryou1').val().replace(/,/g, '');
                azukari_meisai[dic_key][3] += 1 * $(jqleft + i + 'Suuryou2').val().replace(/,/g, '');
                break;
            default:
                delete azukari_meisai[dic_key]; //預り対象以外は、チェック不要なので削除。
                break;
        }
    }
    if (isEmpty(azukari_meisai)) {
        final_meisai_zaikocheck();   //在庫チェック。在庫チェックよりsubmit
        return;
    }
    $.ajax({
        type: "POST",
        url: ajax_azukari_get,
        data: {'den_mr_cd': den_mr_cd, 'den_id': den_id, 'azukari_meisai': azukari_meisai,},
        async: true,
        dataType: 'json',
        success: function (data) {
            msg = data;
            if (msg === 'OK') {
                final_meisai_zaikocheck();   //在庫チェック。在庫チェックよりsubmit
            } else {
                $("#dispErrMsg").text(msg);
            }
        },
        error: function (xhr, status, err) {
            //console.log('Error : azukari_zaiko_check ' + status + '/' + err);
        },
    });
}

//オブジェクトが空かどうか
function isEmpty(obj) {
    return !Object.keys(obj).length;
}
