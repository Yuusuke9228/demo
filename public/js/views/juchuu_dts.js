idmeisaif = 'fieldJuchuuMeisaiDts';
jqmeisaif = '#' + idmeisaif;

function addJuchuuMeisaiDt() { // alert(imax);
    tr_id = '#tr_juchuu_meisai_dt_' + imax;
    id_head = idmeisaif + imax;
    name_head = 'data[juchuu_meisai_dts][' + imax + ']';
    $("#tr_juchuu_meisai_dt_hidden").clone(true).attr('id', 'tr_juchuu_meisai_dt_' + imax).removeAttr('style').insertAfter('#tr_juchuu_meisai_dt_' + ((imax > 0) ? imax - 1 : 'hidden'));
    $(tr_id + " #hiddenCd").attr('id', id_head + 'Cd').attr('name', name_head + '[cd]');
    $(tr_id + " #hiddenId").attr('id', id_head + 'Id').attr('name', name_head + '[id]');
    $(tr_id + " #hiddenUpdated").attr('id', id_head + 'Updated').attr('name', name_head + '[updated]');
    $(tr_id + " #hiddenZeinukigaku").attr('id', id_head + 'Zeinukigaku').attr('name', name_head + '[zeinukigaku]');
    $(tr_id + " #hiddenZeigaku").attr('id', id_head + 'Zeigaku').attr('name', name_head + '[zeigaku]');
    $(tr_id + " #hiddenUtiwakeKbnCd").attr('id', id_head + 'UtiwakeKbnCd').attr('name', name_head + '[utiwake_kbn_cd]');
    $(tr_id + " #hiddenKousei").attr('id', id_head + 'Kousei').attr('name', name_head + '[kousei]');
    $(tr_id + " #hiddenNouhinKbn").attr('id', id_head + 'NouhinKbn').attr('name', name_head + '[nouhin_kbn]');
    $(tr_id + " #hiddenShouhinMrCd").attr('id', id_head + 'ShouhinMrCd').attr('name', name_head + '[shouhin_mr_cd]');
    $(tr_id + " #hiddenLot").attr('id', id_head + 'Lot').attr('name', name_head + '[lot]');
    $(tr_id + " #hiddenTekiyou").attr('id', id_head + 'Tekiyou').attr('name', name_head + '[tekiyou]');
    $(tr_id + " #hiddenIro").attr('id', id_head + 'Iro').attr('name', name_head + '[iro]');
    $(tr_id + " #hiddenIromei").attr('id', id_head + 'Iromei').attr('name', name_head + '[iromei]');
    $(tr_id + " #hiddenKobetucd").attr('id', id_head + 'Kobetucd').attr('name', name_head + '[kobetucd]');
    $(tr_id + " #hiddenHinsituKbnCd").attr('id', id_head + 'HinsituKbnCd').attr('name', name_head + '[hinsitu_kbn_cd]');
    $(tr_id + " #hiddenSoukoMrCd").attr('id', id_head + 'SoukoMrCd').attr('name', name_head + '[souko_mr_cd]');
    $(tr_id + " #hiddenJuchuuzan").attr('id', id_head + 'Juchuuzan').attr('name', name_head + '[juchuuzan]');
    $(tr_id + " #hiddenSuuryou").attr('id', id_head + 'Suuryou').attr('name', name_head + '[suuryou]');
    $(tr_id + " #hiddenKeisu").attr('id', id_head + 'Keisu').attr('name', name_head + '[keisu]');
    $(tr_id + " #hiddenIrisuu").attr('id', id_head + 'Irisuu').attr('name', name_head + '[irisuu]');
    $(tr_id + " #hiddenSuuryou1").attr('id', id_head + 'Suuryou1').attr('name', name_head + '[suuryou1]');
    $(tr_id + " #hiddenTanniMr1Cd").attr('id', id_head + 'TanniMr1Cd').attr('name', name_head + '[tanni_mr1_cd]');
    $(tr_id + " #hiddenSuuryou2").attr('id', id_head + 'Suuryou2').attr('name', name_head + '[suuryou2]');
    $(tr_id + " #hiddenTanniMr2Cd").attr('id', id_head + 'TanniMr2Cd').attr('name', name_head + '[tanni_mr2_cd]');
    $(tr_id + " #hiddenMotoTanniMr2Cd").attr('id', id_head + 'MotoTanniMr2Cd').attr('name', name_head + '[moto_tanni_mr2_cd]');
    $(tr_id + " #hiddenSuuShousuu").attr('id', id_head + 'SuuShousuu').attr('name', name_head + '[suu_shousuu]');
    $(tr_id + " #hiddenSuu1Shousuu").attr('id', id_head + 'Suu1Shousuu').attr('name', name_head + '[suu1_shousuu]');
    $(tr_id + " #hiddenSuu2Shousuu").attr('id', id_head + 'Suu2Shousuu').attr('name', name_head + '[suu2_shousuu]');
    $(tr_id + " #hiddenTankaShousuu").attr('id', id_head + 'TankaShousuu').attr('name', name_head + '[tanka_shousuu]');
    $(tr_id + " #hiddenTankaKbn").attr('id', id_head + 'TankaKbn').attr('name', name_head + '[tanka_kbn]');
    $(tr_id + " #hiddenZaikoKbn").attr('id', id_head + 'ZaikoKbn').attr('name', name_head + '[zaiko_kbn]');
    $(tr_id + " #hiddenGentanka").attr('id', id_head + 'Gentanka').attr('name', name_head + '[gentanka]');
    $(tr_id + " #hiddenTanka").attr('id', id_head + 'Tanka').attr('name', name_head + '[tanka]');
    $(tr_id + " #hiddenKingaku").attr('id', id_head + 'Kingaku').attr('name', name_head + '[kingaku]');
    $(tr_id + " #hiddenGenkagaku").attr('id', id_head + 'Genkagaku').attr('name', name_head + '[genkagaku]');
    $(tr_id + " #hiddenProjectMrCd").attr('id', id_head + 'ProjectMrCd').attr('name', name_head + '[project_mr_cd]');
    $(tr_id + " #hiddenZeirituMrCd").attr('id', id_head + 'ZeirituMrCd').attr('name', name_head + '[zeiritu_mr_cd]');
    $(tr_id + " #hiddenKazeiKbnCd").attr('id', id_head + 'KazeiKbnCd').attr('name', name_head + '[kazei_kbn_cd]');
    $(tr_id + " #hiddenNouki").attr('id', id_head + 'Nouki').attr('name', name_head + '[nouki]');
    $(tr_id + " #hiddenBikou").attr('id', id_head + 'Bikou').attr('name', name_head + '[bikou]');
    $(tr_id + " #hiddenHacchuurendouFlg").attr('id', id_head + 'HacchuurendouFlg').attr('name', name_head + '[hacchuurendou_flg]');
    $("#" + id_head + 'Cd').val(imax + 1);
    $("#" + id_head + 'Id').val(0);
    imax++; //alert($("#"+id_head+'Id').val());
    $("#" + id_head + 'KazeiKbnCd').val(1); // 初期値を課税とする。
    $targetElm = $(targetElm);
}

window.onload = function () {
    addJuchuuMeisaiDt();
    //2019/1/23 元の税率等を保持するため
    if ($('#id').val() === '') {
        $('#fieldJuchuubi').change(); //2019/10/01
    }
    zeiritu_kettei_imax(); // 税抜額なども再計算する
    denpyou_goukei_saikeisan(); // 伝票合計再計算（税抜額などをControllerから送り込んであるならこちらが良い）

    tbl_new_width = 0;
    $('#meisaiTable thead tr th').each(function (i) {
        tbl_new_width += 1 + $(this).width();
    });
    $('#meisaiTable').css({width: tbl_new_width + 'px'});
    addForm1(); // モーダル呼出post用フォームを追加
}

$('#fieldJuchuubi').change(function () { // 受注日付が変ったら
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
    //税率を取得させる 西山 2019/10/01
    if (imax !== '1') {
        for (var i = 0; i < imax - 1; i++) {
            $(jqmeisaif + i + 'ZeirituMrCd').val('');
        }
        zeiritu_kettei_imax();
    }
});

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
    form1.append($('<input>', {type: 'hidden', name: 'denpyou_mr_cd', value: 'juchuu'}));
}

$('#END').click(function () { //エンドキー(END)を押したら
    var index = $targetElm.index($("#" + lastfocusin));//alert(index);
    var thisname = $("#" + lastfocusin).attr('name');
    var partsname = thisname.split(/[\[|\]]+/);// '['か']'かその連続にマッチする文字で分割する。例：data[juchuu_meisai_dts][0][shouhin_mr_cd]は、['data','juchuu_meisai_dts','0','shouhin_mr_cd','']となる。
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
    var partsname = thisname.split(/[\[|\]]+/);// '['か']'かその連続にマッチする文字で分割する。例：data[juchuu_meisai_dts][0][shouhin_mr_cd]は、['data','juchuu_meisai_dts','0','shouhin_mr_cd','']となる。
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
    var partsname = thisname.split(/[\[|\]]+/);// '['か']'かその連続にマッチする文字で分割する。例：data[juchuu_meisai_dts][0][shouhin_mr_cd]は、['data','juchuu_meisai_dts','0','shouhin_mr_cd','']となる。
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
            addJuchuuMeisaiDt();//新規行を追加
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

$('#fieldCd').change(function () { //受注データ索引
//	alert($(this).val()); //''の場合、'0'など1桁の場合または結果が複数の場合、結果が1個の場合、結果が0個の場合
    if ($(this).val() != '') {
        $.ajax({
            type: "POST",
            url: juchuu_dts_ajaxGet,
            data: {'cd': $(this).val(),},
            async: true,
            dataType: 'json',
            success: function (data) {
                if (data.length >= 1 && $('#fieldCd').val() === data[0].cd) {
                    location.href = juchuu_dts_edit + data[0].id;
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

$('#fieldMitumoriDtCd').change(function () { //見積伝票の索引
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
                } else if (data.length == 1 || $("#fieldMitumoriDtCd").val() === data[0].cd) {
                    //選択肢をクリアしてから追加する
                    $('#MitumoriDtsOptions > option').remove();
                    for (var i = 0; i < data.length; i++) {
                        $('#MitumoriDtsOptions').append('<option value="' + data[i].cd + '">' + data[i].cd + ':' + data[i]["meisai"][1].tekiyou + '</option>');
                    }
                    $('#fieldMitumoriDtId').val(data[0].id);
                    $('#fieldMitumoriDtCd').val(data[0].cd);
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
//						if (data[0]["meisai"][m_cd].utiwake_kbn_cd != 30) { // 内部積算は除く
                        if (i >= imax) { //新規行を追加
                            addJuchuuMeisaiDt();
                        }
                        $(jqmeisaif + i + 'UtiwakeKbnCd').val(data[0]["meisai"][m_cd].utiwake_kbn_cd); // 内訳区分
                        $(jqmeisaif + i + 'Kousei').val(data[0]["meisai"][m_cd].kousei); // 構造
                        if (data[0]["meisai"][m_cd].kousei == '-' || data[0]["meisai"][m_cd].kousei == '+') {
                            $(jqmeisaif + i + 'Kousei').addClass('kousei_oya');
                            gyou = i;
                        } else if (data[0]["meisai"][m_cd].kousei.length > 0 && gyou >= 0) {
                            $('#tr_juchuu_meisai_dt_' + i).addClass('kodomo' + gyou);
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
                        $(jqmeisaif + i + 'TankaKbn').val(data[0]["meisai"][m_cd].tanka_kbn);
                        $(jqmeisaif + i + 'ZaikoKbn').val(data[0]["meisai"][m_cd].zaiko_kbn);
                        $(jqmeisaif + i + 'MotoTanniMr2Cd').val(data[0]["meisai"][m_cd].moto_tanni_mr2_cd);
                        $(jqmeisaif + i + 'Gentanka').val(data[0]["meisai"][m_cd].gentanka);
                        $(jqmeisaif + i + 'Tanka').val(data[0]["meisai"][m_cd].tanka);
                        $(jqmeisaif + i + 'Kingaku').val(data[0]["meisai"][m_cd].kingaku);
                        $(jqmeisaif + i + 'Nouki').val(data[0]["meisai"][m_cd].nouki);
                        $(jqmeisaif + i + 'Bikou').val(data[0]["meisai"][m_cd].bikou);
                        $(jqmeisaif + i + 'ZeirituMrCd').val(data[0]["meisai"][m_cd].zeiritu_mr_cd);
                        gyou_kingaku_saikeisan(idmeisaif + i); // 行金額再計算
                        i++;
                    }
//					}
                    if (i >= imax) {
                        addJuchuuMeisaiDt();
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
                    $("#fieldTorihikiKbnCd").val(data[0].torihiki_kbn_cd);
                    $("#fieldZeiTenkaKbnCd").val(data[0].zei_tenka_kbn_cd);
                    $("#fieldTankaShuruiKbnName").val(data[0].tanka_shurui_kbn_name);
                    $("#fieldTankaShuruiKbnKoumokumei").val(data[0].tanka_shurui_kbn_koumokumei);
                    $("#fieldKakeritu").val(data[0].kakeritu);
                    $("#fieldTantouMrCd").val(data[0].tantou_mr_cd);
                    $("#fieldUrikakeZandaka").val(Intl.NumberFormat("ja-JP", {
                        minimumFractionDigits: 0,
                        maximumFractionDigits: 0
                    }).format(data[0].kake_zandaka));//数値カンマ編集
                    $("#fieldTokuisakiMrYoshingendogaku").val(data[0].yoshin_gendogaku);
                    $("#gaku_hasuu_shori_kbn_cd").val(data[0].gaku_hasuu_shori_kbn_cd);
                    $("#zei_hasuu_shori_kbn_cd").val(data[0].zei_hasuu_shori_kbn_cd);
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

$("[id$='Tekiyou']").change(function () {
    var idleft = $(this).attr("id").slice(0, -7);
    var gyou = idleft.slice(21); //fieldHacchuuMeisaiDts0 左から20桁消す
    if (1 * gyou + 1 >= imax) {
        addJuchuuMeisaiDt();
    }//新規行を追加しておく
});

$("[id$='ShouhinMrCd']").change(function () { //商品マスター索引
    var idleft = $(this).attr("id").slice(0, -11); //fieldJuchuuMeisaiDts0ShouhinMrCd 右から11桁消す
    var jqleft = '#' + idleft;
    var gyou = idleft.slice(20); //fieldJuchuuMeisaiDts0 左から20桁消す
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
                    $(jqleft + "TanniMr1Cd").val(data[0].tanni_mr1_cd);
                    $(jqleft + "TanniMr2Cd").val(data[0].tanni_mr2_cd);
                    $(jqleft + "MotoTanniMr2Cd").val(data[0].tanni_mr2_cd);
                    $(jqleft + "Irisuu").val(data[0].irisuu);
                    $(jqleft + "HinsituKbnCd").val(data[0].hinsitu_kbn_cd);
                    $(jqleft + "SuuShousuu").val(data[0].suu_shousuu);
                    $(jqleft + "Suu1Shousuu").val(data[0].suu1_shousuu);
                    $(jqleft + "Suu2Shousuu").val(data[0].suu2_shousuu);
                    $(jqleft + "TankaShousuu").val(data[0].tanka_shousuu);
                    $(jqleft + "TankaKbn").val(data[0].tanka_kbn);
                    $(jqleft + "ZaikoKbn").val(data[0].zaiko_kbn);
                    if (1 * $(jqleft + "Irisuu").val() == 0) { // 新規
                        $(jqleft + "Irisuu").val(data[0].irisuu);
                        $(jqleft + "TanniMr1Cd").val(data[0].tanni_mr1_cd);
                    }
                    if ($(jqleft + "UtiwakeKbnCd").val() == 20 || $(jqleft + "UtiwakeKbnCd").val() == 24 || $(jqleft + "UtiwakeKbnCd").val() == 21) { // 受託加工生産か支給原料
                        $(jqleft + "Gentanka").val(0);
                        $(jqleft + "Tanka").val(0);
                    } else if ($(jqleft + "UtiwakeKbnCd").val() == '30') { // 積算の時
                        $(jqleft + "Gentanka").val(data[0].shiire_tanka);
                        $(jqleft + "Tanka").val(0);//data[0].hyoujun_genka);
                    } else {
                        $(jqleft + "Gentanka").val(data[0].uri_genka);
                        $(jqleft + "Tanka").val(data[0][$("#fieldTankaShuruiKbnKoumokumei").val()]);//tanka_shurui_kbn_cdによって選ぶ

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
                    $(jqleft + "SoukoMrCd").val(data[0].shu_souko_mr_cd);
                    if ($(jqleft + "UtiwakeKbnCd").val() == '') {
                        $(jqleft + "UtiwakeKbnCd").val('10');
                    }
                    $(jqleft + "KazeiKbnCd").val(data[0].kazei_kbn_cd);
                    //様子見
                    if (data[0].kazei_kbn_cd == 2) {
                        $(jqleft + "ZeirituMrCd").val('80');
                    }
                    zeiritu_kettei(idleft,true); //商品変更時バグるので応急処置(引数flg)
                    $(jqleft + "Tanka").change();
                    //alert("/"+data[0].uri_genka+"/");
                    if (1 * gyou + 1 >= imax) {
                        addJuchuuMeisaiDt();
                    }//新規行を追加しておく

                    try {
                        var souko_cd = $(jpleft + 'SoukoMrCd').val();
                        var zaiko_kbn = $(jpleft + 'ZaikoKbn').val();
                    } catch (e) {
                        console.log('倉庫空白');
                    }
                    if (typeof souko_cd !== "undefined") {
                        getZaiko(data[0].cd, souko_cd, zaiko_kbn);
                    } else {
                        try {
                            getZaiko(data[0].cd, '', zaiko_kbn);
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
    var gyou = 0
    if (lastfocusin.substr(0, 20) == idmeisaif) {
        gyou = 1 * (lastfocusin.substr(20, 10).match(/^\d+/)); // alert(gyou); // 20桁目から連続した数字を得る正規表現
    }
    if ($("#" + idmeisaif + gyou + "ShouhinMrCd").val() == '') {
        alert('エラー:商品が未入力');
    } else {
        var tanka_kbn = $(jqmeisaif + gyou + 'TankaKbn').val();
        var tanka_kbn0x = 3 - tanka_kbn;
        var zaiko_kbn = $(jqmeisaif + gyou + 'ZaikoKbn').val();
        var zaiko_kbn0x = 3 - zaiko_kbn;
        $.ajax({
            type: "POST",
            url: kousei_buhin_mrs_ajaxTenkai,
            data: {
                'shouhin_mr_cd': $("#" + idmeisaif + gyou + "ShouhinMrCd").val(),
                'shouhin_mr_id': 0,
                'suuryou': $("#" + idmeisaif + gyou + "Suuryou" + zaiko_kbn).val(),
                'tanni_mr_cd': $("#" + idmeisaif + gyou + "TanniMr" + zaiko_kbn + "Cd").val(),
                'only1': only1,
            },
            async: true,
            dataType: 'json',
            success: function (data) {
                if (data.length == 0) {
                    alert('エラー:構成部品が未登録');
                } else {
                    if ($(jqmeisaif + gyou + 'UtiwakeKbnCd').val() == 20 || $(jqmeisaif + gyou + 'UtiwakeKbnCd').val() == 24) { // 1行目が内部生産
                        //	$(jqmeisaif+gyou+'Gentanka').val(0); // 買い単価は0
                        $(jqmeisaif + gyou + 'Tanka').val(0); // 買い単価は0
                        $(jqmeisaif + gyou + 'Kingaku').val(0); // 買い金額は0
                        $(jqmeisaif + gyou + 'ZeirituMrCd').val(90); // 税率対象外
                    }
                    $(jqmeisaif + gyou + 'Kousei').val('-');
                    $(jqmeisaif + gyou + 'Kousei').addClass('kousei_oya');
                    for (var i = 1; i - 1 < data.length; i++) {
                        if (i + gyou >= imax) { //新規行を追加
                            addJuchuuMeisaiDt();
                        }
                        $('#tr_juchuu_meisai_dt_' + (i + gyou)).addClass('kodomo' + gyou);
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
                        $(jqmeisaif + (i + gyou) + 'Suuryou').val($("#" + idmeisaif + gyou + "Suuryou" + $(jqmeisaif + gyou + 'ZaikoKbn').val()).val()); //
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
                            $(jqmeisaif + (i + gyou) + 'Tanka').val(data[i - 1].gen_shouhin_mr[$("#fieldTankaShuruiKbnKoumokumei").val()]);//tanka_shurui_kbn_cdによって選ぶ
                        }
                        $(jqmeisaif + (i + gyou) + 'SoukoMrCd').val($(jqmeisaif + gyou + "SoukoMrCd").val());
                        if ($(jqmeisaif + (i + gyou) + 'UtiwakeKbnCd').val() == '') {
                            $(jqmeisaif + i + "UtiwakeKbnCd").val('10');
                        }
                        var zaiko_kbnx = 3 - $(jqmeisaif + (i + gyou) + 'ZaikoKbn').val();
                        if (data[i - 1].keisu == 1 && $(jqmeisaif + (i + gyou) + 'TanniMr' + zaiko_kbnx + 'Cd').val() == $(jqmeisaif + gyou + 'TanniMr' + zaiko_kbn0x + 'Cd').val()) {
                            $(jqmeisaif + (i + gyou) + 'Suuryou' + zaiko_kbnx).val($(jqmeisaif + gyou + 'Suuryou' + zaiko_kbn0x).val());
                            $(jqmeisaif + (i + gyou) + 'Lot').val($(jqmeisaif + gyou + 'Lot').val());
                            $(jqmeisaif + (i + gyou) + 'Iro').val($(jqmeisaif + gyou + 'Iro').val());
                            $(jqmeisaif + (i + gyou) + 'Iromei').val($(jqmeisaif + gyou + 'Iromei').val());
                            $(jqmeisaif + (i + gyou) + 'HinsituKbnCd').val($(jqmeisaif + gyou + 'HinsituKbnCd').val());
                        }
                        $(jqmeisaif + (i + gyou) + 'Tanka').change();
                        $(jqmeisaif + (i + gyou) + 'Suuryou').change();
                    }
                    if (i + gyou >= imax) {
                        addJuchuuMeisaiDt();
                    }//新規行を追加しておく
                    $(jqmeisaif + gyou + 'Suuryou2').change();
                }
            },
            error: function (xhr, status, err) {
                alert('>システムエラー' + status + '/' + err);
            },
        });
    }
};

$(document).on('click', '.kousei_oya', function () {
    var gyou = 1 * (lastfocusin.substr(20, 10).match(/^\d+/));
    if ($(this).val() == '-') {
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
    if (lastfocusin == "fieldCd") { /* 受注コード選択 */
        modalstart1(den_modal, "受注伝票選択");
    } else if (lastfocusin == "fieldMitumoriDtCd") { /* 見積コード選択 */
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
        modalstart(lot_summary_modal, "ロット別在庫", "?cd=" + $('#' + lastfocusin.slice(0, -3) + "ShouhinMrCd").val().replace('+', '%2B'));
    } else if (lastfocusin == "fieldJuchuubi") { /* 受注日選択 */
        open_datepicker();
    } else if (lastfocusin == "fieldNounyuuKijitu") { /* 納入期日選択 */
        open_datepicker();
    } else if (lastfocusin.slice(-5) == "Nouki") { /* 納期選択 */
        open_datepicker();
    } else if (lastfocusin.slice(-5) === 'Tanka') {	/* 単価選択 Add By Nishiyama 2019/5/8/ */
        //商品コードをパラメータークエリへ投げる。
        let currntId = document.activeElement.id;
        let rowIndex = currntId.replace(/[^0-9^\.]/g, "");
        let rowId = '#fieldJuchuuMeisaiDts' + rowIndex + 'ShouhinMrCd';
        let product_code = $(rowId).val();
        let tokuisaki_code = $('#fieldTokuisakiMrCd').val();
        if (tokuisaki_code == '') {
            alert('得意先を選択してください。');
            return;
        }
        //console.log(tokuisaki_code);
        modalstart(juchuu_meisai_dts_modal, "受注単価履歴", "?cd=" + product_code.replace('+', '%2B') + "&tokuisaki=" + tokuisaki_code);
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
            if (retsouko !== '') {
                var currntId = document.activeElement.id;
                var rowIndex = currntId.replace(/[^0-9^\.]/g, "");
                var souko_code = retsouko.toString();
                let rowId = '#fieldJuchuuMeisaiDts' + rowIndex + 'SoukoMrCd';
                $(rowId).val(souko_code);
            }
            //LOT在庫数量
            if (zaikosuu !== '') {
                let zaiko = parseFloat(zaikosuu);
                $("#fieldGenzaiko").val(zaiko);
            }
            //色番
            if (iro !== '') {
                let iroID = '#fieldJuchuuMeisaiDts' + rowIndex + 'Iro';
                $(iroID).val(iro);
            }
            //色名
            if (iromei !== '') {
                let iroName = '#fieldJuchuuMeisaiDts' + rowIndex + 'Iromei';
                $(iroName).val(iromei);
            }

            if (hinsitu_kbn_cd !== '') {
                let hinshitu = '#fieldJuchuuMeisaiDts' + rowIndex + 'HinsituKbnCd';
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

/* 画面内計算 */
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
    if ($(jqleft + 'UtiwakeKbnCd').val() >= 20 && $(jqleft + 'UtiwakeKbnCd').val() <= 50) { // 加工支給預りメモ等は税率は外０
        $(jqleft + "ZeirituMrCd").children().remove(); //option消去
        $(jqleft + "ZeirituMrCd").append($("<option>").val("90").text("90=外0%"));
    } else if ($('#fieldZeiTenkaKbnCd').val() == '30') { //輸出なら
        $(jqleft + "ZeirituMrCd").children().remove(); //option消去
        $(jqleft + "ZeirituMrCd").append($("<option>").val("70").text("70=輸出"));
    } else {
        var kijunbi = $("#fieldJuchuubi").val();
        if ($("#fieldZeirituTekiyoubi").val() != '' && $("#fieldKijunbi").val() != '0000-00-00') {
            kijunbi = $("#fieldZeirituTekiyoubi").val();
        }
        var date_kijunbi = new Date(kijunbi.replace(/-/g, '/'));
        var selected_cd = $(jqleft + "ZeirituMrCd").val();
        var kazei_kbn_cd = $(jqleft + 'KazeiKbnCd').val();
        var select_cd = '';
        //税率バグ修正 西山 2019/9/30
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
                    select_cd = zeiritu_mrs[i]['cd']; // 該当がまだなく'' 課税区分が一致して 基準日を比較して満たしていれば 選択する
                }
            }
        }
        if (select_cd != '') {
            $(jqleft + "ZeirituMrCd").val(select_cd);
        }
    }
    gyou_kingaku_kanma(idleft); // 行金額端数処理カンマ編集
    $(jqleft + 'TanniMr1Cd').change();
}

function zeiritu_kettei_imax() {
    for (var i = 0; i < imax - 1; i++) {
        zeiritu_kettei(idmeisaif + i);
    }
    denpyou_goukei_saikeisan(); // 伝票合計再計算
}

$("[id$='Cd']").change(function () { //行番号が変更されたら
    var idleft = $(this).attr("id").slice(0, -2); //fieldJuchuuMeisaiDts0Cd 右から2桁消す
//	console.log(idleft+idleft.length);
    if (idleft.length < 26 && idleft.slice(0, 20) == 'fieldJuchuuMeisaiDts') {
        var jqleft = '#' + idleft;
        if ($(this).val() == 0) { // 行番号＝０なら数量０金額０
//	console.log($(jqleft + "Suuryou2").val());
            $(jqleft + "Suuryou1").val(0);
            $(jqleft + "Suuryou2").val(0);
            suu1or2change(idleft); // 行金額再計算
        }
    }
});

$("[id$='UtiwakeKbnCd']").change(function () { //内訳区分が変更されたら
    var idleft = $(this).attr("id").slice(0, -12); //fieldJuchuuMeisaiDts0UtiwakeKbnCd 右から12桁消す
    var jqleft = '#' + idleft;
    $(jqleft + "ZeirituMrCd").val("");
    if ($("#" + idleft + "UtiwakeKbnCd").val() === '40' || $("#" + idleft + "UtiwakeKbnCd").val() === '41') {	//暫定処理 登録時、明細が消える為
        $("#" + idleft + "ShouhinMrCd").val("996");
        $(jqleft + "ShouhinMrCd").change();
    }
    zeiritu_kettei(idleft); // 税率を設定し直し
    gyou_kingaku_saikeisan(idleft); // 行金額再計算
});

$("[id$='Suuryou']").change(function () { //元数量が変更されたら
    var idleft = $(this).attr("id").slice(0, -7); //fieldJuchuuMeisaiDts0Suuryou 右から7桁消す
    suu_keisu_change(idleft);
});

$("[id$='Keisu']").change(function () { //係数が変更されたら
    var idleft = $(this).attr("id").slice(0, -5); //fieldJuchuuMeisaiDts0Keisu 右から5桁消す
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
    var idleft = $(this).attr("id").slice(0, -6); //fieldJuchuuMeisaiDts0Irisuu 右から6桁消す
    var jqleft = '#' + idleft;
    if ($(this).val() * 1 !== 0) {
        $(jqleft + "Suuryou2").val(1 * $(this).val().replace(/,/g, '') * $(jqleft + "Suuryou1").val().replace(/,/g, ''));
        $(jqleft + "Suuryou2").change();
    }
});

$("[id$='Suuryou1']").change(function () { //数量1が変更されたら
    var idleft = $(this).attr("id").slice(0, -8); //fieldJuchuuMeisaiDts0Suuryou1 右から8桁消す
    var jqleft = '#' + idleft;
    var suu1 = 1 * $(this).val().replace(/,/g, '');
    //コメントアウトした方は数量2が変更されない 2019/7/4 西山
    if (1 * $(jqleft + "Irisuu").val().replace(/,/g, '') !== 0) {
        $(jqleft + "Suuryou2").val(suu1 * $(jqleft + "Irisuu").val());
        $(jqleft + "Suuryou2").change();
    }
    // if (1*$(jqleft+"Suuryou2").val().replace(/,/g,'') == 0) {
    // 	$(jqleft+"Suuryou2").val(suu1*$(jqleft+"Irisuu").val().replace(/,/g,''));
    // }
    // $(jqleft+"Suuryou2").change();
    sh1 = $(jqleft + "Suu1Shousuu").val(); // 小数桁を揃える
    $(this).val(Intl.NumberFormat("ja-JP", {minimumFractionDigits: sh1, maximumFractionDigits: sh1}).format(suu1));//カンマ編集
    suu1or2change(idleft);		//金額計算されない為
    denpyou_goukei_saikeisan();
});

$("[id$='Suuryou2']").change(function () { //数量2が変更されたら
    var idleft = $(this).attr("id").slice(0, -8); //fieldJuchuuMeisaiDts0Suuryou2 右から8桁消す
    var jqleft = '#' + idleft;
    var suu2 = 1 * $(this).val().replace(/,/g, '');//カンマ編集を一旦戻す
    sh2 = $(jqleft + "Suu2Shousuu").val(); // 小数桁を揃える
    $(this).val(Intl.NumberFormat("ja-JP", {minimumFractionDigits: sh2, maximumFractionDigits: sh2}).format(suu2));//カンマ編集
    suu1or2change(idleft);
});

function suu1or2change(idleft) {
// console.log('idleft = '+idleft);
    var jqleft = '#' + idleft;
    if ($(jqleft + "UtiwakeKbnCd").val() == 20 || $(jqleft + "UtiwakeKbnCd").val() == 24) { // 内部生産
        var tanka_kbn0 = $(jqleft + "TankaKbn").val();
        var tanka_kbn0x = 3 - tanka_kbn0;
        var zaiko_kbn0 = $(jqleft + "ZaikoKbn").val();
        var zaiko_kbn0x = 3 - zaiko_kbn0;
        var gyou = 1 * idleft.slice(21); //fieldJuchuuMeisaiDts0
        var goukeisuuryou = 0;
        var goukeisuuryou1 = $(jqleft + "Suuryou1").val().replace(/,/g, '');
        var goukeisuuryou2 = $(jqleft + "Suuryou2").val().replace(/,/g, '');
        goukeisuuryou = zaiko_kbn0 == 1 ? goukeisuuryou1 : goukeisuuryou2;
        var i0 = 1 * idleft.slice(20);
        for (i = i0 + 1; i < imax; i++) {
            if ($(jqmeisaif + i + "UtiwakeKbnCd").val() == 10 || $(jqmeisaif + i + "UtiwakeKbnCd").val() == 21 || $(jqmeisaif + i + "UtiwakeKbnCd").val() == 15) {
                $(jqmeisaif + i + 'Suuryou').val(goukeisuuryou);
                var tanka_kbn = $(jqmeisaif + i + 'TankaKbn').val();
                var zaiko_kbn = $(jqmeisaif + i + 'ZaikoKbn').val();
                var sh = $(jqmeisaif + i + "Suu" + tanka_kbn + "Shousuu").val(); // 小数桁を揃える
                $(jqmeisaif + i + 'Suuryou' + tanka_kbn).val(Intl.NumberFormat("ja-JP", {
                    minimumFractionDigits: sh,
                    maximumFractionDigits: sh
                }).format($(jqmeisaif + i + "Keisu").val().replace(/,/g, '') * goukeisuuryou));
                $(jqmeisaif + i + 'Kingaku').val($(jqmeisaif + i + "Suuryou" + tanka_kbn).val().replace(/,/g, '') * $(jqmeisaif + i + "Tanka").val().replace(/,/g, ''));
                var tanka_kbnx = 3 - tanka_kbn;
                var zaiko_kbnx = 3 - zaiko_kbn;
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
    var idleft = $(this).attr("id").slice(0, -8); //fieldJuchuuMeisaiDts0TankaKbn 右から8桁消す
    gyou_kingaku_saikeisan(idleft); // 行金額再計算
    denpyou_goukei_saikeisan(); // 伝票合計再計算
});

function gyou_kingaku_saikeisan(idleft) { // 行金額再計算
    var jqleft = '#' + idleft;
    if ($(jqleft + 'UtiwakeKbnCd').val() == 21 || $(jqleft + 'UtiwakeKbnCd').val() == 20 || $(jqleft + 'UtiwakeKbnCd').val() == 24) { // 支給預りと内部生産のときは金額は０
        $(jqleft + "Kingaku").val(0); //金額=数量*単価
    } else {
        if (!$(jqleft + "TankaKbn").val()) {
            $(jqleft + "TankaKbn").val(2)
        }
        var suufld = $(jqleft + "Suuryou" + $(jqleft + "TankaKbn").val());
        $(jqleft + "Kingaku").val(Math.round(1000 * suufld.val().replace(/,/g, '')) * Math.round(1000 * $(jqleft + "Tanka").val().replace(/,/g, '')) / 1000000); //金額=数量*単価
    }
    $(jqleft + 'TanniMr1Cd').change();
    gyou_kingaku_kanma(idleft); // 行金額端数処理カンマ編集
}

$("[id$='TanniMr1Cd']").change(function () { //単位1が変更されたら
    var idleft = $(this).attr("id").slice(0, -10); //fieldJuchuuMeisaiDts0TanniMr1Cd 右から10桁消す
    var jqleft = '#' + idleft;
    var tanka_kbn = $(jqleft + 'TankaKbn');
    var tanka_kbn_sel = tanka_kbn.val();
    tanka_kbn.children().remove();
    tanka_kbn.append($("<option>").val('1').text('/' + $(jqleft + 'TanniMr1Cd option:selected').text()));
    tanka_kbn.append($("<option>").val('2').text('/' + $(jqleft + 'TanniMr2Cd option:selected').text()));
    tanka_kbn.val(tanka_kbn_sel);
});

$("[id$='TanniMr2Cd']").change(function () { //単位2が変更されたら
    var idleft = $(this).attr("id").slice(0, -10); //fieldJuchuuMeisaiDts0TanniMr1Cd 右から10桁消す
    var jqleft = '#' + idleft;
    $(jqleft + 'TanniMr1Cd').change();
});

$("[id$='Gentanka']").change(function () { //原単価が変更されたら
    var idleft = $(this).attr("id").slice(0, -8); //fieldJuchuuMeisaiDts0Gentanka 右から8桁消す
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

$("[id$='TankaKbn']").change(function () { //単価区分が変更されたら
    var idleft = $(this).attr("id").slice(0, -8); //fieldJuchuuMeisaiDts0TankaKbn 右から8桁消す
    gyou_kingaku_saikeisan(idleft); // 行金額再計算
    denpyou_goukei_saikeisan(); // 伝票合計再計算
});

$("[id$='Tanka']").change(function () { //単価が変更されたら
    var idleft = $(this).attr("id").slice(0, -5); //fieldJuchuuMeisaiDts0Tanka 右から5桁消す
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
    var idleft = $(this).attr("id").slice(0, -7); //fieldJuchuuMeisaiDts0Kingaku 右から7桁消す
    gyou_kingaku_kanma(idleft); // 行金額端数処理カンマ編集
    denpyou_goukei_saikeisan(); // 伝票合計再計算
});

function gyou_kingaku_kanma(idleft) { // 行金額端数処理カンマ編集
    var jqleft = '#' + idleft;
    var kingaku = 1.0 * $(jqleft + "Kingaku").val().replace(/,/g, ''); //カンマ編集を一旦戻す
    var hkbn = 1 * $("#gaku_hasuu_shori_kbn_cd").val();
    if (hkbn == 1 && kingaku >= 0 || hkbn == 2 && kingaku < 0) {
        kingaku = Math.trunc(kingaku); //切り捨て
    } else if (hkbn == 2 && kingaku >= 0 || hkbn == 1 && kingaku < 0) {
        kingaku = Math.ceil(kingaku); //切り上げ
    } else {
        kingaku = Math.round(kingaku); //四捨五入
    }
    $(jqleft + "Kingaku").val(Intl.NumberFormat("ja-JP", {
        minimumFractionDigits: 0,
        maximumFractionDigits: 0
    }).format(kingaku));//カンマ編集
    zeiritu = 0.01 * cd_zeiritu[$(jqleft + "ZeirituMrCd").val()];
    if ($("#fieldZeiTenkaKbnCd").val().substr(0, 1) == "2") { //内税
        hkbn = 1 * $("#zei_hasuu_shori_kbn_cd").val();
        if (hkbn == 1 && kingaku >= 0 || hkbn == 2 && kingaku < 0) {
            $(jqleft + "Zeigaku").val(Math.trunc(kingaku / (1 + zeiritu) * zeiritu)); //切り捨て
        } else if (hkbn == 2 && kingaku >= 0 || hkbn == 1 && kingaku < 0) {
            $(jqleft + "Zeigaku").val(Math.ceil(kingaku / (1 + zeiritu) * zeiritu)); //切り上げ
        } else {
            $(jqleft + "Zeigaku").val(Math.round(kingaku / (1 + zeiritu) * zeiritu)); //四捨五入
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
        hkbn = 1 * $("#zei_hasuu_shori_kbn_cd").val();
        if (hkbn == 1 && kingaku >= 0 || hkbn == 2 && kingaku < 0) {
            $(jqleft + "Zeigaku").val(Math.trunc(kingaku * zeiritu)); //切り捨て
        } else if (hkbn == 2 && kingaku >= 0 || hkbn == 1 && kingaku < 0) {
            $(jqleft + "Zeigaku").val(Math.ceil(kingaku * zeiritu)); //切り上げ
        } else {
            $(jqleft + "Zeigaku").val(Math.round(kingaku * zeiritu)); //四捨五入
        }
        $(jqleft + "Zeinukigaku").val(kingaku);
    }
}

function denpyou_goukei_saikeisan() { // 伝票合計再計算
    zeinukigaku = 0;
    shouhizeigaku = 0;
    genkagaku = 0;
    sekisangaku = 0;
    var ritubetugaku = {};
    for (i = 0; i < imax - 1; i++) {
        var tanka_kbn = $(jqmeisaif + i + 'TankaKbn').val();
        var suufld = $(jqmeisaif + i + 'Suuryou' + tanka_kbn);
        if (1 * $(jqmeisaif + i + 'UtiwakeKbnCd').val() < 20) { // 通常、返品、値引き、諸経費のみ
            zeinukigaku += 1 * $(jqmeisaif + i + 'Zeinukigaku').val();
            shouhizeigaku += 1 * $(jqmeisaif + i + 'Zeigaku').val();
            $(jqmeisaif + i + 'Genkagaku').val(Math.round($(jqmeisaif + i + 'Gentanka').val().replace(/,/g, '') * suufld.val().replace(/,/g, ''))); //四捨五入
            genkagaku += 1 * $(jqmeisaif + i + 'Genkagaku').val();
            if (!ritubetugaku[$(jqmeisaif + i + 'ZeirituMrCd').val()]) {
                ritubetugaku[$(jqmeisaif + i + 'ZeirituMrCd').val()] = 0
            }
            ritubetugaku[$(jqmeisaif + i + 'ZeirituMrCd').val()] += 1 * $(jqmeisaif + i + 'Kingaku').val().replace(/,/g, ''); // 税別額[税率キー]+=金額
        } else if (1 * $(jqmeisaif + i + 'UtiwakeKbnCd').val() == 30) { // 積算のみ
            sekisangaku += 1 * $(jqmeisaif + i + 'Gentanka').val().replace(/,/g, '') * suufld.val().replace(/,/g, '');//alert(sekisangaku);
        }
    }
    goukeigaku = zeinukigaku + shouhizeigaku;
    if ($("#fieldZeiTenkaKbnCd") != 20 && $("#fieldZeiTenkaKbnCd") != 30 && $("#fieldZeiTenkaKbnCd") != 40) { // 内税と輸出と税手入力は伝票合計の税額を再計算しない
        shouhizeigaku2 = 0;
        if ($("#fieldZeiTenkaKbnCd").val().substr(0, 1) == "2") { //内税(総額など)
            for (var ritukey in ritubetugaku) {
                zeiritu = 0.01 * cd_zeiritu[ritukey];
                var hkbn = 1 * $("#zei_hasuu_shori_kbn_cd").val();
                if (hkbn == 1 && 1 * ritubetugaku[ritukey] >= 0 || hkbn == 2 && 1 * ritubetugaku[ritukey] < 0) {
                    zeigaku = Math.trunc(1 * ritubetugaku[ritukey] / (1 + zeiritu) * zeiritu); //切り捨て
                } else if (hkbn == 2 && 1 * ritubetugaku[ritukey] >= 0 || hkbn == 1 && 1 * ritubetugaku[ritukey] < 0) {
                    zeigaku = Math.ceil(1 * ritubetugaku[ritukey] / (1 + zeiritu) * zeiritu); //切り上げ
                } else {
                    zeigaku = Math.round(1 * ritubetugaku[ritukey] / (1 + zeiritu) * zeiritu); //四捨五入
                }
                shouhizeigaku2 += zeigaku;
            }
            zeinukigaku = goukeigaku - shouhizeigaku2; // 税抜額を再計算
            $("#zei_chousei_gaku").val(shouhizeigaku2 - shouhizeigaku);
            $("#zeinuki_chousei_gaku").val(shouhizeigaku - shouhizeigaku2);
        } else {										//外税
            for (var ritukey in ritubetugaku) {
                zeiritu = 0.01 * cd_zeiritu[ritukey];
                var hkbn = 1 * $("#zei_hasuu_shori_kbn_cd").val();
                if (hkbn == 1 && 1 * ritubetugaku[ritukey] >= 0 || hkbn == 2 && 1 * ritubetugaku[ritukey] < 0) {
                    zeigaku = Math.trunc(1 * ritubetugaku[ritukey] * zeiritu); //切り捨て
                } else if (hkbn == 2 && 1 * ritubetugaku[ritukey] >= 0 || hkbn == 1 && 1 * ritubetugaku[ritukey] < 0) {
                    zeigaku = Math.ceil(1 * ritubetugaku[ritukey] * zeiritu); //切り上げ
                } else {
                    zeigaku = Math.round(1 * ritubetugaku[ritukey] * zeiritu); //四捨五入
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
    var tanka_kbn = $(jqmeisaif + '0' + 'TankaKbn').val();
    $("#fieldSekisanGoukeigaku").val(Intl.NumberFormat("ja-JP", {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    }).format(sekisangaku / $(jqmeisaif + '0Suuryou' + tanka_kbn).val().replace(/,/g, '')));//カンマ編集
}

$("[id$='ShouhinMrCd']").focusin(function (e) { //商品在庫索引
    if ($(this).val() == '') {
        $('#fieldGenzaiko').val('');
    } else {
        var idleft = $(this).attr("id").slice(0, -11);
        try {
            var zaiko_kbn = $('#' + idleft + 'ZaikoKbn').val();
            var souko_cd = $('#' + idleft + 'SoukoMrCd').val();
        } catch (e) {
            console.log('倉庫空白');
        }
        if (typeof souko_cd !== "undefined") {
            getZaiko($(this).val(), souko_cd, zaiko_kbn);
        } else {
            getZaiko($(this).val(), '', zaiko_kbn);
        }
    }
});

//商品在庫索引
function getZaiko(shouhin_cd, souko_cd, zaiko_kbn) {
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
                console.log(data);
                if (zaiko_kbn === '1') {
                    $('#fieldGenzaiko1').val(data[1]);
                } else {
                    $('#fieldGenzaiko').val(data[0]);
                }
            },
            error: function (xhr, status, err) {
                console.log('Error : Cd.change.ajax => ' + status + '/' + err);
            },
        });
    }
}

$(function () { // テーブルのヘッドを消えなくする
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
    'cd', 'juchuubi', 'nounyuu_kijitu', 'mitumori_dt_cd', 'zeiritu_tekiyoubi', 'torihiki_kbn_cd',
    'zei_tenka_kbn_cd', 'nounyuusaki_mr_cd', 'kidukesaki_mr_cd', 'tekiyou', 'hassousaki_kbn_cd', 'saki_hacchuu_cd',
    '[cd', '[utiwake_kbn_cd', '[kousei', '[shukka_kbn_cd', '[shouhin_mr_cd', '[tekiyou', '[iro', '[iromei', '[lot', '[kobetucd', '[hinsitu_kbn_cd', '[souko_mr_cd', '[suuryou', '[keisu', '[irisuu', '[suuryou1',
    '[tanni_mr1_cd', '[suuryou2', '[tanni_mr2_cd', '[juchuuzan', '[tanka_kbn', '[gentanka', '[tanka', '[kingaku', '[zeiritu_mr_cd', '[nouki', '[bikou'
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
            ro_field_name = 'data[juchuu_meisai_dts][0]' + ro_fields[j] + ']';
            rewidths[ro_fields[j]] = $("[name='" + ro_field_name + "']").outerWidth();
        }
    }
    $.ajax({
        type: "POST",
        url: readonlys_ajaxSave,
        data: {'controller_cd': 'JuchuuDts', 'gamen_cd': 'inputfields', 'readonlys': readonlys, 'rewidths': rewidths,},
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

//2019/7/6 明細テーブルが見にくいらしいのでzoomするテキストボックスをテスト的に追加
// $('#meisaiTable')
//     .focusin(function (e) {
//         var current = document.activeElement;
//         var selection =
//             current.value.substring(current.selectionStart, current.selectionEnd);
//         $("#zoom_text").val(current.value);
//     });

function final_check() { // Focusを外す 2019/9/5
    $("#F12").focus();
    denpyou_goukei_saikeisan(); // 伝票合計再計算
    if (!final_meisai_check()) return false;    // 明細内チェック
    var res = confirm('登録しても、よろしいですか?');
    if (res === true) {
        $('#formTouroku').submit();
    }
    return false;
}

function final_meisai_check() {
    var jqleft = '#fieldJuchuuMeisaiDts';
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