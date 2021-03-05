idmeisaif = 'fieldHacchuuMeisaiDts';
jqmeisaif = '#' + idmeisaif;

function addHacchuuMeisaiDt() { // alert(imax);
    tr_id = '#tr_hacchuu_meisai_dt_' + imax;
    id_head = 'fieldHacchuuMeisaiDts' + imax;
    name_head = 'data[hacchuu_meisai_dts][' + imax + ']';
    $("#tr_hacchuu_meisai_dt_hidden").clone(true).attr('id', 'tr_hacchuu_meisai_dt_' + imax).removeAttr('style').insertAfter('#tr_hacchuu_meisai_dt_' + ((imax > 0) ? imax - 1 : 'hidden'));
    $(tr_id + " #hiddenCd").attr('id', id_head + 'Cd').attr('name', name_head + '[cd]');
    $(tr_id + " #hiddenId").attr('id', id_head + 'Id').attr('name', name_head + '[id]');
    $(tr_id + " #hiddenUpdated").attr('id', id_head + 'Updated').attr('name', name_head + '[updated]');
    $(tr_id + " #hiddenZeinukigaku").attr('id', id_head + 'Zeinukigaku').attr('name', name_head + '[zeinukigaku]');
    $(tr_id + " #hiddenZeigaku").attr('id', id_head + 'Zeigaku').attr('name', name_head + '[zeigaku]');
    $(tr_id + " #hiddenUtiwakeKbnCd").attr('id', id_head + 'UtiwakeKbnCd').attr('name', name_head + '[utiwake_kbn_cd]');
    $(tr_id + " #hiddenKousei").attr('id', id_head + 'Kousei').attr('name', name_head + '[kousei]');
    $(tr_id + " #hiddenShiireKbnCd").attr('id', id_head + 'NyuukaKbnCd').attr('name', name_head + '[nyuuka_kbn_cd]');
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
    $(tr_id + " #hiddenHacchuuzan").attr('id', id_head + 'Hacchuuzan').attr('name', name_head + '[hacchuuzan]');
    $(tr_id + " #hiddenSuuryou2").attr('id', id_head + 'Suuryou2').attr('name', name_head + '[suuryou2]');
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
    $("#" + id_head + 'Cd').val(imax + 1);
    $("#" + id_head + 'Id').val(0);
    imax++;
    $("#" + id_head + 'KazeiKbnCd').val(1);
    $targetElm = $(targetElm);
}

window.onload = function () {
    tbl_new_width = 0;
    $('#meisaiTable thead tr th').each(function (i) {
        tbl_new_width += 1 + $(this).width();
    });
    $('#meisaiTable').css({width: tbl_new_width + 'px'});
    addHacchuuMeisaiDt();
    //2019/1/23 元の税率等を保持するため
    if ($('#id').val() === '') {
        $('#fieldHacchuubi').change();
    }
    zeiritu_kettei_imax(); // 税抜額なども再計算する
    denpyou_goukei_saikeisan(); // 伝票合計再計算（税抜額などをControllerから送り込んであるならこちらが良い）
    hassousaki_mrs_modal = hassousaki_mrs_modals[$("#fieldHassousakiKbnCd").val()];
    hassousaki_mrs_ajaxGet = hassousaki_mrs_ajaxGets[$("#fieldHassousakiKbnCd").val()];
    //$('#fieldHassousakiMrCd').change();
    addForm1(); // モーダル呼出post用フォームを追加
}

$('#fieldHacchuubi').change(function () { // 発注日付が変ったら
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
    //税率税率を取得させる 西山 2019/9/30
    var idleft = $(this).attr("id").slice(0, -11);
    if (imax !== '1') {
        for (var i = 0; i < imax - 1; i++) {
            $("#" + idleft + i + 'ZeirituMrCd').val('');
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
    form1.append($('<input>', {type: 'hidden', name: 'denpyou_mr_cd', value: 'hacchuu'}));
}

$('#END').click(function () { //エンドキー(END)を押したら
    var index = $targetElm.index($("#" + lastfocusin));//alert(index);
    var thisname = $("#" + lastfocusin).attr('name');
    var partsname = thisname.split(/[\[|\]]+/);// '['か']'かその連続にマッチする文字で分割する。例：data[hacchuu_meisai_dts][0][shouhin_mr_cd]は、['data','hacchuu_meisai_dts','0','shouhin_mr_cd','']となる。
    var findend = '[shouhin_mr_cd]';
    if (imax > 1 && partsname.length == 5) {
        findend = '[' + partsname[3] + ']';
    }
    var findlen = -findend.length;
    index = $targetElm.index($("#fieldHacchuuMeisaiDts" + (imax - 1) + "Cd")) - 1;
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
    var partsname = thisname.split(/[\[|\]]+/);// '['か']'かその連続にマッチする文字で分割する。例：data[hacchuu_meisai_dts][0][shouhin_mr_cd]は、['data','hacchuu_meisai_dts','0','shouhin_mr_cd','']となる。
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
    'Zeinukigaku', 'Zeigaku', 'UtiwakeKbnCd', 'NyuukaKbnCd', 'ShouhinMrCd', 'TanniMr1Cd', 'TanniMr2Cd', 'TankaKbn', 'ZaikoKbn', 'Irisuu', 'Suuryou1', 'Tekiyou',
    'Iro', 'Iromei', 'Lot', 'Kobetucd', 'HinsituKbnCd', 'SoukoMrCd', 'Suuryou2', 'MotoTanniMr2Cd', 'SuuShousuu', 'Suu1Shousuu', 'Suu2Shousuu', 'TankaShousuu', 'Gentanka', 'Tanka', 'Kingaku', 'Genkagaku',
    'ProjectMrCd', 'ZeirituMrCd', 'KazeiKbnCd', 'Bikou'
];
$('#PgDn').click(function () { //ページダウンキー(Ctrl+Enter)を押したら
    var index = $targetElm.index($("#" + lastfocusin));//alert(index);
    var thisname = $("#" + lastfocusin).attr('name');
    var partsname = thisname.split(/[\[|\]]+/);// '['か']'かその連続にマッチする文字で分割する。例：data[hacchuu_meisai_dts][0][shouhin_mr_cd]は、['data','hacchuu_meisai_dts','0','shouhin_mr_cd','']となる。
    var findend = '[shouhin_mr_cd]';
    if (imax > 1 && partsname.length == 5) {
        findend = '[' + partsname[3] + ']';
        if (1 * partsname[2] + 1 == imax) {
            for (var i in cpyary) {
                if (!$("#" + lastfocusin).val() || 'fieldHacchuuMeisaiDts' + partsname[2] + cpyary[i] != lastfocusin) {
                    $('#fieldHacchuuMeisaiDts' + partsname[2] + cpyary[i]).val($('#fieldHacchuuMeisaiDts' + (1 * partsname[2] - 1) + cpyary[i]).val());
                }
            }
            $("#fieldHacchuuMeisaiDts" + partsname[2] + "Suuryou" + $("#fieldHacchuuMeisaiDts" + partsname[2] + "TankaKbn").val()).change();
            $("#fieldHacchuuMeisaiDts" + partsname[2] + "TanniMr1Cd").change();
            addHacchuuMeisaiDt();//新規行を追加
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

$('#fieldCd').change(function () { //発注伝票索引
//	alert($(this).val()); //''の場合、'0'など1桁の場合または結果が複数の場合、結果が1個の場合、結果が0個の場合
    if ($(this).val() != '') {
        $.ajax({
            type: "POST",
            url: hacchuu_dts_ajaxGet,
            data: {'cd': $(this).val(),},
            async: true,
            dataType: 'json',
            success: function (data) {
                if (data.length >= 1 && $('#fieldCd').val() === data[0].cd) {
                    location.href = hacchuu_dts_edit + data[0].id;
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

$('#fieldShiiresakiMrCd').change(function () { //仕入先マスター索引
    //alert("AAA:".$(this).attr("id")); //''の場合、'0'など1桁の場合または結果が複数の場合、結果が1個の場合、結果が0個の場合
    if ($(this).val() == '') {
        $("#rdonlyShiiresakiMrName").val("");
    } else {
        $.ajax({
            type: "POST",
            url: shiiresaki_mrs_ajaxGet,
            data: {'cd': $(this).val(),},
            async: true,
            dataType: 'json',
            success: function (data) {
                if (data.length == 0) {
                    $("#rdonlyShiiresakiMrName").val('>>エラー:未登録');
                } else if (data.length == 1 || $("#fieldShiiresakiMrCd").val() === data[0].cd) {
                    $('#ShiiresakiMrsOptions > option').remove();
                    for (var i = 0; i < data.length; i++) {
                        $('#ShiiresakiMrsOptions').append('<option value="' + data[i].cd + '">' + data[i].cd + ':' + data[i].name + '</option>');
                    }
                    $("#fieldShiiresakiMrCd").val(data[0].cd);
                    $("#rdonlyShiiresakiMrName").val(data[0].name);
                    $("#fieldSeikyuusakiName").val(data[0].seikyuusaki_name);
                    $("#fieldTorihikiKbnCd").val(data[0].torihiki_kbn_cd);
                    $("#fieldZeiTenkaKbnCd").val(data[0].zei_tenka_kbn_cd);
                    $("#fieldTankaShuruiKbnName").val(data[0].tanka_shurui_kbn_name);
                    $("#fieldTankaShuruiKbnKoumokumei").val(data[0].tanka_shurui_kbn_koumokumei);
                    $("#fieldKakeritu").val(data[0].kakeritu);
                    if ($("#fieldTantouMrCd").val() == "") {
                        $("#fieldTantouMrCd").val(data[0].tantou_mr_cd);
                    }
                    $("#fieldKaikakeZandaka").val(Intl.NumberFormat("ja-JP", {
                        minimumFractionDigits: 0,
                        maximumFractionDigits: 0
                    }).format(data[0].kake_zandaka));//数値カンマ編集
                    $("#fieldShiiresakiMrYoshingendogaku").val(data[0].yoshin_gendogaku);
                    $("#gaku_hasuu_shori_kbn_cd").val(data[0].gaku_hasuu_shori_kbn_cd);
                    $("#zei_hasuu_shori_kbn_cd").val(data[0].zei_hasuu_shori_kbn_cd);
                    $("#fieldTorihikiKbnCd").change();
                    zeiritu_kettei_imax(); // 税抜額なども再計算する。追加2019/4/15井浦
                    denpyou_goukei_saikeisan(); // 伝票合計再計算
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
                $("#rdonlyShiiresakiMrName").val('>エラー' + status + '/' + err);
            },
        });
    }
});

$('#fieldHassousakiMrCd').change(function () { //発送先マスター(得意先マスターか納入先マスターか倉庫マスター)の索引
    //alert("AAA:".$(this).attr("id")); //''の場合、'0'など1桁の場合または結果が複数の場合、結果が1個の場合、結果が0個の場合
    if ($(this).val() == '') {
        $("#rdonlyHassousakiMrName").val("");
    } else {
        $.ajax({
            type: "POST",
            url: hassousaki_mrs_ajaxGet,
            data: {'cd': $(this).val(),},
            async: true,
            dataType: 'json',
            success: function (data) {
                if (data.length == 0) {
                    $("#rdonlyHassousakiMrName").val('>>エラー:未登録');
                } else if (data.length == 1 || $("#fieldHassousakiMrCd").val() === data[0].cd) {
                    //選択肢をクリアしてから追加する
                    $('#HassousakiMrsOptions > option').remove();
                    for (var i = 0; i < data.length; i++) {
                        $('#HassousakiMrsOptions').append('<option value="' + data[i].cd + '">' + data[i].cd + ':' + data[i].name + '</option>');
                    }
                    $("#fieldHassousakiMrCd").val(data[0].cd);
                    $("#rdonlyHassousakiMrName").val(data[0].name);
                } else {
                    //選択肢をクリアしてから追加する
                    $('#HassousakiMrsOptions > option').remove();
                    for (var i = 0; i < data.length; i++) {
                        $('#HassousakiMrsOptions').append('<option value="' + data[i].cd + '">' + data[i].cd + ':' + data[i].name + '</option>');
                    }
                    $("#rdonlyHassousakiMrName").val('>>エラー:未登録');
                    $("#fieldHassousakiMrCd").focus().select();
                }
            },
            error: function (xhr, status, err) {
                $("#rdonlyHassousakiMrName").val('>エラー' + status + '/' + err);
            },
        });
    }
});

$('#fieldJuchuuDtCd').change(function () { //受注伝票の索引
    //alert("AAA:".$(this).attr("id")); //''の場合、'0'など1桁の場合または結果が複数の場合、結果が1個の場合、結果が0個の場合
    if ($(this).val() == '') {
    } else {
        $.ajax({
            type: "POST",
            url: juchuu_dts_ajaxGet,
            data: {'cd': $(this).val(),},
            async: true,
            dataType: 'json',
            success: function (data) {
                if (data.length == 0) {
                    $("#fieldHacchuuMeisaiDts0Tekiyou").val('>>元受注エラー:未登録');
                } else if (data.length == 1 || $("#fieldJuchuuDtCd").val() === data[0].cd) {
                    //選択肢をクリアしてから追加する
                    $('#JuchuuDtsOptions > option').remove();
                    for (var i = 0; i < data.length; i++) {
                        $('#JuchuuDtsOptions').append('<option value="' + data[i].cd + '">' + data[i].cd + ':' + data[i]["meisai"][1].tekiyou + '</option>');
                    }
                    //商品コードの選択肢をクリアしてから追加する
                    $('#ShouhinMrsOptions > option').remove();
                    for (m_cd in data[0]["meisai"]) {
                        $('#ShouhinMrsOptions').append('<option value="' + data[0]["meisai"][m_cd].shouhin_mr_cd + '">' + data[0]["meisai"][m_cd].shouhin_mr_cd + ':' + data[0]["meisai"][m_cd].tekiyou + '</option>');
                    }
                    $('#fieldJuchuuDtCd').val(data[0].cd);
                    $('#fieldTantouMrCd').val(data[0].tantou_mr_cd);
                    $('#fieldHassousakiKbnCd').val(3); // 受注は納入先のみ入力している
                    $('#fieldHassousakiMrCd').val(data[0]['nounyuusaki_mr_cd']);
                    $('#rdonlyHassousakiMrName').val(data[0]['nounyuusaki']);
//					$("#fieldHacchuuMeisaiDts0ShouhinMrCd").val(data[0]["meisai"][1].shouhin_mr_cd);
//					$("#fieldHacchuuMeisaiDts0Tekiyou").val(data[0]["meisai"][1].tekiyou);
                } else {
                    //選択肢をクリアしてから追加する
                    $('#JuchuuDtsOptions > option').remove();
                    for (var i = 0; i < data.length; i++) {
                        $('#JuchuuDtsOptions').append('<option value="' + data[i].cd + '">' + data[i].cd + ':' + data[i]["meisai"][1].tekiyou + '</option>');
                    }
                    $("#fieldHacchuuMeisaiDts0Tekiyou").val('>>元受注エラー:未登録');
                    $("#fieldJuchuuDtCd").focus().select();
                }
            },
            error: function (xhr, status, err) {
                $("#fieldHacchuuMeisaiDts0Tekiyou").val('>元受注エラー' + status + '/' + err);
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
        addHacchuuMeisaiDt();
    }//新規行を追加しておく
});

$("[id$='ShouhinMrCd']").change(function () { //商品マスター索引
    var idleft = $(this).attr("id").slice(0, -11); //fieldHacchuuMeisaiDts0ShouhinMrCd 右から11桁消す
    var gyou = idleft.slice(21); //fieldHacchuuMeisaiDts0 左から20桁消す
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
                    $("#" + idleft + "ShouhinMrCd").val(data[0].cd);
                    $("#" + idleft + "Tekiyou").val(data[0].name);
                    $("#" + idleft + "Iro").val(data[0].iro);
                    $("#" + idleft + "Iromei").val(data[0].iromei);
                    $("#" + idleft + "Lot").val(data[0].lot);
                    $("#" + idleft + "Irisuu").val(data[0].irisuu);
                    $("#" + idleft + "TanniMr1Cd").val(data[0].tanni_mr1_cd);
                    $("#" + idleft + "TanniMr2Cd").val(data[0].tanni_mr2_cd);
                    $("#" + idleft + "MotoTanniMr2Cd").val(data[0].tanni_mr2_cd);
                    $("#" + idleft + "HinsituKbnCd").val(data[0].hinsitu_kbn_cd);
                    $("#" + idleft + "SuuShousuu").val(data[0].suu_shousuu);
                    $("#" + idleft + "Suu1Shousuu").val(data[0].suu1_shousuu);
                    $("#" + idleft + "Suu2Shousuu").val(data[0].suu2_shousuu);
                    $("#" + idleft + "TankaShousuu").val(data[0].tanka_shousuu);
                    $("#" + idleft + "TankaKbn").val(data[0].tanka_kbn);
                    $("#" + idleft + "ZaikoKbn").val(data[0].zaiko_kbn);
                    $("#" + idleft + "Irisuu").val(data[0].irisuu);	//コード変えたとき入数変更されないので 2019/7/16
                    $("#" + idleft + "SoukoMrCd").val(data[0].shu_souko_mr_cd);
                    if ($("#" + idleft + "UtiwakeKbnCd").val() == '20') { // 委託生産の製品は生産と同等なので
                        $("#" + idleft + "Gentanka").val(data[0]["shiire_tanka"]); // 評価単価を仕入単価
                        $("#" + idleft + "Tanka").val(0); // 買い単価は0
                    } else if ($("#" + idleft + "UtiwakeKbnCd").val() == '21') { // 委託生産の原料は消費と同等なので
                        $("#" + idleft + "Gentanka").val(data[0]["shiire_tanka"]); // 評価単価を売上原価  2020-03-07 問題があるので、仕入単価を入れる様に変更　西山
                        $("#" + idleft + "Tanka").val(0); // 買い単価は0
                    } else { // 他の通常・返品などは
                        $("#" + idleft + "Gentanka").val(data[0]["shiire_tanka"]); // 評価単価を仕入単価
                        $("#" + idleft + "Tanka").val($("#" + idleft + "Gentanka").val()); // 同じ
                    }
                    $("#" + idleft + "KazeiKbnCd").val(data[0].kazei_kbn_cd);
                    if (data[0].kazei_kbn_cd == 2) {
                        $("#" + idleft + "ZeirituMrCd").val('80');
                    }
                    zeiritu_kettei(idleft,true); //商品変更時バグるので応急処置(引数flg)

                    // 数量を受注から複写します
                    if ($('#' + idleft + 'UtiwakeKbnCd').val() == '' && $("#fieldJuchuuDtCd").val() != "" && $("#fieldJuchuuDtCd").val() != "0") { // 元受注から数量を得る
                        $.ajax({
                            type: "POST",
                            url: juchuu_meisai_dts_ajaxGet,
                            data: {
                                'cd': $("#fieldJuchuuDtCd").val(),
                                'shouhin_mr_cd': $('#' + idleft + 'ShouhinMrCd').val(),
                            },
                            async: true,
                            dataType: 'json',
                            success: function (data) {
                                if (data.length != 0) {
                                    $("#" + idleft + "Suuryou2").val(data.suuryou2);
                                    $("#" + idleft + "Tanni_mr_cd").val(data.tanni_mr2_cd);
                                }
                            },
                            error: function (xhr, status, err) {
                                alert('>エラー' + status + '/' + err);
                                $("#" + idleft + "Tekiyou").val('>エラー' + status + '/' + err);
                            },
                        });
                    }

                    if ($("#" + idleft + "UtiwakeKbnCd").val() == '') {
                        $("#" + idleft + "UtiwakeKbnCd").val('10');
                    } // 通常は通常とする
                    $("#" + idleft + "Tanka").change();
                    if (1 * gyou + 1 >= imax) {
                        addHacchuuMeisaiDt();
                    }//新規行を追加しておく

                    try {
                        var souko_cd = $("#" + idleft + 'SoukoMrCd').val();
                        var zaiko_kbn = $("#" + idleft + 'ZaikoKbn').val();
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

var id_ends = [
    'Cd', 'Id', 'Updated', 'Genkagaku', 'Zeinukigaku', 'Zeigaku', 'KazeiKbnCd', 'SuuShousuu', 'Suu1Shousuu', 'Suu2Shousuu',
    'TankaShousuu', 'ZaikoKbn', 'MotoTanniMrCd', 'ProjectMrCd',
    'UtiwakeKbnCd', 'NyuukaKbnCd', 'Kousei', 'ShouhinMrCd', 'Lot', 'Tekiyou', 'Iro', 'Iromei', 'Kobetucd', 'HinsituKbnCd', 'SoukoMrCd',
    'Hacchuuzan', 'Suuryou', 'Keisu', 'Irisuu', 'Suuryou1', 'TanniMr1Cd', 'Suuryou2', 'TanniMr2Cd',
    'Gentanka', 'Tanka', 'TankaKbn', 'Kingaku',
    'ZeirituMrCd', 'Bikou'
];
var name_ends = [
    '[cd]', '[id]', '[updated]', '[genkagaku]', '[zeinukigaku]', '[zeigaku]', '[kazei_kbn_cd]', '[suu_shousuu]', '[suu1_shousuu]',
    '[suu2_shousuu]', '[tanka_shousuu]', '[zaiko_kbn]', '[moto_tanni_mr_cd]', '[project_mr_cd]',
    '[utiwake_kbn_cd]', '[nyuuka_kbn_cd]', '[kousei]', '[shouhin_mr_cd]', '[lot]', '[tekiyou]', '[iro]', '[iromei]', '[kobetucd]', '[hinsitu_kbn_cd]', '[souko_mr_cd]',
    '[hacchuuzan]', '[suuryou]', '[keisu]', '[irisuu]', '[suuryou1]', '[tanni_mr1_cd]', '[suuryou2]', '[tanni_mr2_cd]',
    '[gentanka]', '[tanka]', '[tanka_kbn]', '[kingaku]',
    '[zeiritu_mr_cd]', '[bikou]'
];

/*
 * 空行削除 Add By Nishiyama 2019/10/28
 */
$("[id$=Cd]").dblclick(function () {
    var idleft = 'fieldHacchuuMeisaiDts';
    var gyou = 1 * (lastfocusin.substr(21, 10).match(/^\d+/));
    if ($('#' + idleft + gyou + "ShouhinMrCd").val() !== '' &&
        $('#' + idleft + gyou + 'UtiwakeKbnCd').val() !== '') {
        window.alert('空行のみ削除可能です。');
        return false;
    }
    var result = window.confirm('選択行を削除しても宜しいですか??');
    if (result) {
        let row = $(this).closest("tr").remove();
        $(row).remove();
        //行削除後 id,nameを修正
        var counter = 0;	//各ノードへ連番を附番する
        var str = '';		//id,nameを編集するための一時変数
        var r = 0;			//周回抜け用、フラグ変数
        $('tbody tr').each(function () {
            if (r === 0) {
                r++;
                return true;
            }
            $(this).removeClass();
            tr_id = 'tr_hacchuu_meisai_dt_' + (counter);
            $(this).attr('id', tr_id);
            id_head = 'fieldHacchuuMeisaiDts' + (counter);
            name_head = 'data[hacchuu_meisai_dts][' + (counter) + ']';
            $(this).children().each(function (i) {
                str = $(this).children().attr('id');
                if (str !== undefined) {
                    str = str.substr(0, 25);
                    str = $(this).children().attr('name');
                    str = str.substr(0, 31);
                    $(this).children().attr('id', id_head + id_ends[i]).attr('name', name_head + name_ends[i]);
                }
                //構造は孫階層を処理(他の<tr>は孫階層がない為、例外処理)
                try {
                    if ($(this).children().prop("tagName") === 'SPAN') {
                        str = $(this).children().children().attr('id');
                        if (str !== undefined) {
                            str = str.substr(0, 25);
                            str = $(this).children().children().attr('name');
                            str = str.substr(0, 31);
                            $(this).children().children().attr('id', id_head + 'Kousei').attr('name', name_head + '[kousei]');
                        }
                    }
                } catch (e) {
                    //例外発生時、次の<tr>へ(何もしない)
                }
            });
            counter++;
        });
        imax -= 1;
        //行番号附番
        for (k = 0; k < imax; k++) {
            $("#fieldHacchuuMeisaiDts" + (k) + "Cd").val(k + 1);
        }
    } else {
        window.alert('行削除をキャンセルしました。');
        return false;
    }
    return false;
});

/*
 * 行挿入 Add By Nishiyama 2019/10/28
 * 内訳20が無い場合のみ処理する(class="kodomo[n]"の役割不明の為)
 */
$("[id$='Cd']").contextmenu(function () {
    for (k = 0; k < imax; k++) {
        if ($("#fieldHacchuuMeisaiDts" + (k) + "UtiwakeKbnCd").val() === '20') {
            window.alert('加工生産を含む明細に対し、行挿入は出来ません。');
            return false;
        }
    }
    $('#tr_hacchuu_meisai_dt_' + (imax - 1)).closest('tr').clone(true).insertAfter($(this).closest('tr')); //空行クローン(中身のクリアが面倒なため)

    var counter = 0;	//各ノードへ連番を附番する
    var str = '';		//id,nameを編集するための一時変数
    var r = 0;			//周回抜け用、フラグ変数
    $('tbody tr').each(function () {
        //先頭行は隠行の為処理無
        if (r === 0) {
            r++;
            return true;
        }
        $(this).removeClass();
        tr_id = 'tr_hacchuu_meisai_dt_' + (counter);
        $(this).attr('id', tr_id);
        id_head = 'fieldHacchuuMeisaiDts' + (counter);
        name_head = 'data[hacchuu_meisai_dts][' + (counter) + ']';
        $(this).children().each(function (i) {
            str = $(this).children().attr('id');
            if (str !== undefined) {
                str = str.substr(0, 25);
                str = $(this).children().attr('name');
                str = str.substr(0, 31);
                $(this).children().attr('id', id_head + id_ends[i]).attr('name', name_head + name_ends[i]);
            }
            //構造は孫階層を処理(他の<tr>は孫階層がない為、例外処理)
            try {
                if ($(this).children().prop("tagName") === 'SPAN') {
                    str = $(this).children().children().attr('id');
                    if (str !== undefined) {
                        str = str.substr(0, 25);
                        str = $(this).children().children().attr('name');
                        str = str.substr(0, 31);
                        $(this).children().children().attr('id', id_head + 'Kousei').attr('name', name_head + '[kousei]');
                    }
                }
            } catch (e) {
                //例外発生時、次の<tr>へ(何もしない)
            }
        });
        counter++;
        $targetElm = $(targetElm); //イベントを引き継ぐ為必要
    });
    imax += 1;
    //行番号附番
    for (k = 0; k < imax; k++) {
        $("#fieldHacchuuMeisaiDts" + (k) + "Cd").val(k + 1);
    }
    return false;
});


function tenkai(only1) { // 単展開、全展開
    var idleft = 'fieldHacchuuMeisaiDts';
    var gyou = 0
    if (lastfocusin == 'F7') {
        lastfocusin = lastfocusout;
    }
    if (lastfocusin.substr(0, 21) == idleft) {
        gyou = 1 * (lastfocusin.substr(21, 10).match(/^\d+/)); // alert(gyou); // 20桁目から連続した数字を得る正規表現
    }
    if ($("#" + idleft + gyou + "ShouhinMrCd").val() == '') {
        $("#" + idleft + gyou + "Tekiyou").val("ありません");
    } else {
        var zaiko_kbn = $('#' + idleft + gyou + 'ZaikoKbn').val();
        $.ajax({
            type: "POST",
            url: kousei_buhin_mrs_ajaxTenkai,
            data: {
                'shouhin_mr_cd': $("#" + idleft + gyou + "ShouhinMrCd").val(),
                'shouhin_mr_id': 0,
                'suuryou': $("#" + idleft + gyou + "Suuryou" + zaiko_kbn).val(),
                'tanni_mr_cd': $("#" + idleft + gyou + "TanniMr" + zaiko_kbn + "Cd").val(),
                'only1': only1,
            },
            async: true,
            dataType: 'json',
            success: function (data) {
                if (data.length == 0) {
                    alert('>>エラー:構成部品未登録');
                    $("#" + idleft + gyou + "ShouhinMrCd").focus().select();
                } else {
                    if ($("#" + idleft + gyou + "UtiwakeKbnCd").val() == 20) { // 1行目が委託加工生産
                        $("#" + idleft + gyou + "Tanka").val(0); // 買い単価は0
                        $("#" + idleft + gyou + "Kingaku").val(0); // 買い金額は0
                        $("#" + idleft + gyou + "ZeirituMrCd").val(90); // 税率対象外
                    }
                    $('#' + idleft + gyou + 'Kousei').val('-');
                    $('#' + idleft + gyou + 'Kousei').addClass('kousei_oya');
                    for (var i = 1; i - 1 < data.length; i++) {
                        if (gyou + i >= imax) { //新規行を追加
                            addHacchuuMeisaiDt();
                        }
                        $('#tr_hacchuu_meisai_dt_' + (i + gyou)).addClass('kodomo' + gyou);
                        $('#' + idleft + (gyou + i) + 'Kousei').val(data[i - 1].kousei);
                        $('#' + idleft + (gyou + i) + 'SuuShousuu').val(data[i - 1].gen_shouhin_mr.suu_shousuu);
                        $('#' + idleft + (gyou + i) + 'Suu1Shousuu').val(data[i - 1].gen_shouhin_mr.suu1_shousuu);
                        $('#' + idleft + (gyou + i) + 'Suu2Shousuu').val(data[i - 1].gen_shouhin_mr.suu2_shousuu);
                        $('#' + idleft + (gyou + i) + 'TankaShousuu').val(data[i - 1].gen_shouhin_mr.tanka_shousuu);
                        $('#' + idleft + (gyou + i) + 'ShouhinMrCd').val(data[i - 1].gen_shouhin_mr_cd);
                        $('#' + idleft + (gyou + i) + 'KazeiKbnCd').val(data[i - 1].gen_shouhin_mr.kazei_kbn_cd);
                        if ($("#" + idleft + gyou + "UtiwakeKbnCd").val() == 20) { // 1行目が委託加工生産
                            if (data[i - 1].koutin_flg == 1) {
                                $('#' + idleft + (gyou + i) + 'UtiwakeKbnCd').val(10); // 通常（発注）
                                $('#' + idleft + (gyou + i) + 'ZeirituMrCd').val(''); // 税対象外
                                zeiritu_kettei(idleft + (gyou + i)); // 税率決定
                            } else {
                                $('#' + idleft + (gyou + i) + 'UtiwakeKbnCd').val(21); // 委託原料支給
                                $('#' + idleft + (gyou + i) + 'ZeirituMrCd').val(90); // 税対象外
                            }
                        } else {
                            $('#' + idleft + (gyou + i) + 'UtiwakeKbnCd').val(30); // 内部積算
                            $('#' + idleft + (gyou + i) + 'ZeirituMrCd').val(90); // 税対象外
                        }
                        //$('#'+idleft+(gyou+i)+'ShouhinMrCd').change();
                        $('#' + idleft + (gyou + i) + 'Keisu').val(data[i - 1].irisuu);
                        $('#' + idleft + (gyou + i) + 'Suuryou').val($("#" + idleft + gyou + "Suuryou" + $('#' + idleft + gyou + 'ZaikoKbn').val()).val()); //
                        $('#' + idleft + (gyou + i) + 'Irisuu').val(data[i - 1].gen_shouhin_mr.irisuu);
                        $('#' + idleft + (gyou + i) + 'TanniMr1Cd').val(data[i - 1].gen_shouhin_mr.tanni_mr1_cd);

                        $('#' + idleft + (gyou + i) + "Tekiyou").val(data[i - 1].gen_shouhin_mr.name);
                        $('#' + idleft + (gyou + i) + "Iro").val(data[i - 1].gen_shouhin_mr.iro);
                        $('#' + idleft + (gyou + i) + "Iromei").val(data[i - 1].gen_shouhin_mr.iromei);
                        $('#' + idleft + (gyou + i) + "Lot").val(data[i - 1].gen_shouhin_mr.lot);
                        $('#' + idleft + (gyou + i) + "TanniMr2Cd").val(data[i - 1].gen_shouhin_mr.tanni_mr2_cd);
                        $('#' + idleft + (gyou + i) + "TankaKbn").val(data[i - 1].gen_shouhin_mr.tanka_kbn);
                        $('#' + idleft + (gyou + i) + "ZaikoKbn").val(data[i - 1].gen_shouhin_mr.zaiko_kbn);
                        $('#' + idleft + (gyou + i) + "MotoTanniMr2Cd").val(data[i - 1].gen_shouhin_mr.tanni_mr2_cd);
                        $('#' + idleft + (gyou + i) + "HinsituKbnCd").val(data[i - 1].gen_shouhin_mr.hinsitu_kbn_cd);
                        $('#' + idleft + (gyou + i) + "SoukoMrCd").val($('#' + idleft + gyou + "SoukoMrCd").val());
                        if ($('#' + idleft + (gyou + i) + "UtiwakeKbnCd").val() == '20') { // 委託生産の製品は生産と同等なので
                            $('#' + idleft + (gyou + i) + "Gentanka").val(data[i - 1].gen_shouhin_mr.shiire_tanka); // 評価単価を仕入単価
                            $('#' + idleft + (gyou + i) + "Tanka").val(0); // 買い単価は0
                        } else if ($('#' + idleft + (gyou + i) + "UtiwakeKbnCd").val() == '21') { // 委託生産の原料は消費と同等なので
                            $('#' + idleft + (gyou + i) + "Gentanka").val(data[i - 1].gen_shouhin_mr.shiire_tanka); // 評価単価を売上原価 2020-03-07 問題があるので、仕入単価を入れる様に変更　西山
                            $('#' + idleft + (gyou + i) + "Tanka").val(0); // 買い単価は0
                        } else { // 他の通常・返品などは
                            //10通常の行にコスト入らなかった為 2019/8/5
                            //$('#'+idleft+(gyou+i)+"Gentanka").val(data[i - 1].gen_shouhin_mr[$("#fieldTankaShuruiKbnKoumokumei").val()]);//tanka_shurui_kbn_cdによって選ぶ
                            $('#' + idleft + (gyou + i) + "Gentanka").val(data[i - 1].gen_shouhin_mr.shiire_tanka); // 評価単価を仕入単価
                            $('#' + idleft + (gyou + i) + "Tanka").val($('#' + idleft + (gyou + i) + "Gentanka").val()); // 同じ
                        }
                        $('#' + idleft + (gyou + i) + "KazeiKbnCd").val(data[i - 1].gen_shouhin_mr.kazei_kbn_cd);
                        zeiritu_kettei(idleft + (gyou + i));
                        $('#' + idleft + (gyou + i) + "Tanka").change();
                        $('#' + idleft + (gyou + i) + 'Suuryou').change();
                    }
                    if (gyou + i >= imax) {
                        addHacchuuMeisaiDt();
                    }//新規行を追加しておく
                }
            },
            error: function (xhr, status, err) {
                alert('>ajax展開エラー' + status + '/' + err);
            },
        });
    }
};

$(document).on('click', '.kousei_oya', function () {
    var gyou = 1 * (lastfocusin.substr(21, 10).match(/^\d+/));
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
    if (lastfocusin == "fieldCd") { /* 発注データ選択 */
        modalstart1(den_modal, "発注データ選択");
    } else if (lastfocusin == "fieldShiiresakiMrCd") { /* 仕入先コード選択 */
        modalstart(shiiresaki_mrs_modal, "仕入先選択");
    } else if (lastfocusin == "fieldHassousakiMrCd" && hassousaki_mrs_modal != "") { /* 発送先コード選択 */
        modalstart(hassousaki_mrs_modal, "発送先選択");
    } else if (lastfocusin == "fieldJuchuuDtCd" && juchuu_dts_modal != "") { /* 元受注伝票選択 */
        modalstart(juchuu_dts_modal, "元受注選択");
    } else if (lastfocusin.slice(-11) == "ShouhinMrCd") { /* 商品コード選択 */
        modalstart(shouhin_mrs_modal, "商品選択");
    } else if (lastfocusin.slice(-3) == "Lot") { /* ロット別在庫選択 */
        modalstart(lot_summary_modal, "ロット別在庫", "?cd=" + $('#' + lastfocusin.slice(0, -3) + "ShouhinMrCd").val().replace('+', '%2B'));
    } else if (lastfocusin == "fieldHacchuubi") { /* 発注日選択 */
        open_datepicker();
    } else if (lastfocusin == "fieldNounyuuKijitu") { /* 納入期日選択 */
        open_datepicker();
    } else if (lastfocusin.slice(-5) == "Nouki") { /* 納期選択 */
        open_datepicker();
    } else if (lastfocusin.slice(-5) === "Tanka") {	/* 単価選択 Add By Nishiyama 2019/5/9/ */
        //商品コードをパラメータークエリへ投げる。
        let currntId = document.activeElement.id;
        let rowIndex = currntId.replace(/[^0-9^\.]/g, "");
        let rowId = '#fieldHacchuuMeisaiDts' + rowIndex + 'ShouhinMrCd';
        let product_code = $(rowId).val();
        let shiiresaki_code = $('#fieldShiiresakiMrCd').val();
        if (shiiresaki_code == '') {
            alert('仕入先を選択してください。');
            return;
        }
        modalstart(hacchuu_history, "発注伝票単価履歴", "?cd=" + product_code.replace('+', '%2B') + "&shiiresaki=" + shiiresaki_code);
    }
}

$('#fieldShiiresakiMrCd').focusout(function () { /* 仕入先コード選択 */
    if ($('#fieldShiiresakiMrCd').val() == '') {
        modalstart(shiiresaki_mrs_modal, "仕入先選択");
        setTimeout(function () {
            lastfocusin = "fieldShiiresakiMrCd";
        }, 1000); // 1秒後フォーカス設定し直し
    }
});

/* モーダル印刷ダイヤログ部分 */
function f5key() {
    modalstart(chouhyou_mrs_modal, "発注伝票印刷", "/hacchuu"); // hachuu=発注伝票
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
                let rowId = '#fieldHacchuuMeisaiDts' + rowIndex + 'SoukoMrCd';
                $(rowId).val(souko_code);
            }
            //LOT在庫数量
            if (zaikosuu !== '') {
                let zaiko = parseFloat(zaikosuu);
                $("#fieldGenzaiko").val(zaiko);
            }
            //色番
            if (iro !== '') {
                let iroID = '#fieldHacchuuMeisaiDts' + rowIndex + 'Iro';
                $(iroID).val(iro);
            }
            //色名
            if (iromei !== '') {
                let iroName = '#fieldHacchuuMeisaiDts' + rowIndex + 'Iromei';
                $(iroName).val(iromei);
            }

            if (hinsitu_kbn_cd !== '') {
                let hinshitu = '#fieldHacchuuMeisaiDts' + rowIndex + 'HinsituKbnCd';
                $(hinshitu).val(hinsitu_kbn_cd);
                $(hinshitu +  'option[value=' + hinsitu_kbn_cd + ']').prop('selected',true);
            }

        }
    );
    $('#iframe-bg').fadeOut();
    $('#' + lastfocusin).focus().select();
}

function fromModal1(retval) { // 印刷モーダルからの帰り
    // alert('親ページの関数が実行されました。'+retval);
    $('#iframe-wrap').fadeOut(
        function () {//alert("フェードアウト完了")
            if (retval) {
                $('#formTouroku').submit(); // 更新実行
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
$("#fieldHassousakiKbnCd").change(function () { //発送先区分が変更されたら
    hassousaki_mrs_modal = hassousaki_mrs_modals[$("#fieldHassousakiKbnCd").val()];
    hassousaki_mrs_ajaxGet = hassousaki_mrs_ajaxGets[$("#fieldHassousakiKbnCd").val()];
    $("#fieldHassousakiMrCd").val("");
    $("#rdonlyHassousakiMrName").val("");
});

$("#fieldZeirituTekiyoubi").change(function () { //税適用日が変更されたら
    for (var i = 0; i < imax - 1; i++) {
        $('#fieldHacchuuMeisaiDts' + i + 'ZeirituMrCd').val('');
    }
    zeiritu_kettei_imax();// 明細の課税区分を再設定する
});

$("#fieldZeiTenkaKbnCd").change(function () { //税転嫁区分が変更されたら
    zeiritu_kettei_imax();// 明細の課税区分を再設定する
});

function zeiritu_kettei(idleft,flg = false) { //税率決定（行指定） //商品変更時バグるので応急処置(引数flg)
    try {

        if ($('#' + idleft + 'UtiwakeKbnCd').val() >= 20 && $('#' + idleft + 'UtiwakeKbnCd').val() <= 50) { // 加工支給預りメモ等は税率は外０
            $("#" + idleft + "ZeirituMrCd").children().remove(); //option消去
            $("#" + idleft + "ZeirituMrCd").append($("<option>").val("90").text("90=外0%"));
        } else if ($('#fieldZeiTenkaKbnCd').val() == '30') { //輸出なら
            $("#" + idleft + "ZeirituMrCd").children().remove(); //option消去
            $("#" + idleft + "ZeirituMrCd").append($("<option>").val("70").text("70=輸出"));
        } else {
            var kijunbi = $("#fieldHacchuubi").val();
            if ($("#fieldZeirituTekiyoubi").val() != '' && $("#fieldKijunbi").val() != '0000-00-00') {
                kijunbi = $("#fieldZeirituTekiyoubi").val();
            }
            var date_kijunbi = new Date(kijunbi.replace(/-/g, '/'));
            var selected_cd = ''; // $("#"+idleft+"ZeirituMrCd").val(); 前の状態を引き継ぐと間違えの元となるので削除2019/4/11井浦
            var kazei_kbn_cd = $('#' + idleft + 'KazeiKbnCd').val();
            if ($("#" + idleft + "UtiwakeKbnCd").val() == '22') {
                kazei_kbn_cd = 3;
            } else if ($("#" + idleft + "UtiwakeKbnCd").val() == '20') { // 委託生産の製品は生産と同等なので
                kazei_kbn_cd = 3;
            } else if ($("#" + idleft + "UtiwakeKbnCd").val() == '21') { // 委託生産の原料は消費と同等なので
                kazei_kbn_cd = 3;
            }
            var select_cd = '';
            //税率バグ修正 西山 2019/9/30
            if (kazei_kbn_cd === '2') {
                $("#" + idleft + "ZeirituMrCd").val('80');
                $("#" + idleft + "ZeirituMrCd").append($("<option>").val("80").text("80=非0%"));
            } else {
                $("#" + idleft + "ZeirituMrCd").val('');
                $("#" + idleft + "ZeirituMrCd").children().remove();
            }
            for (var i in zeiritu_mrs) {
                if (zeiritu_mrs[i]['cd'] != '70') { //輸出以外を追加
                    $("#" + idleft + "ZeirituMrCd").append($("<option>").val(zeiritu_mrs[i]['cd']).text(zeiritu_mrs[i]['disp']));
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
                $("#" + idleft + "ZeirituMrCd").val(select_cd);
            }
        }
        gyou_kingaku_kanma(idleft); // 行金額端数処理カンマ編集
        $('#' + idleft + 'TanniMr1Cd').change();
    } catch (e) {

    }
}

function zeiritu_kettei_imax() {
    for (var i = 0; i < imax - 1; i++) {
        zeiritu_kettei("fieldHacchuuMeisaiDts" + i);
    }
    denpyou_goukei_saikeisan(); // 伝票合計再計算
}

$("[id$='Cd']").change(function () { //行番号が変更されたら
    var idleft = $(this).attr("id").slice(0, -2); //fieldHacchuuMeisaiDts0Cd 右から2桁消す
    if (idleft.length < 27 && idleft.slice(0, 21) == 'fieldHacchuuMeisaiDts') {
        var jqleft = '#' + idleft;
        if ($(this).val() == 0) { // 行番号＝０なら数量０金額０
            $(jqleft + "Suuryou1").val(0);
            $(jqleft + "Suuryou2").val(0);
            suu1or2change(idleft); // 行金額再計算
        }
    }
});

$("[id$='UtiwakeKbnCd']").change(function () { //内訳区分が変更されたら
    var idleft = $(this).attr("id").slice(0, -12); //fieldHacchuuMeisaiDts0UtiwakeKbnCd 右から12桁消す
    $("#" + idleft + "ZeirituMrCd").val("");
    if ($("#" + idleft + "UtiwakeKbnCd").val() === '40' || $("#" + idleft + "UtiwakeKbnCd").val() === '41') {	//暫定処理 登録時、明細が消える為
        $("#" + idleft + "ShouhinMrCd").val("996");
        var gyou = idleft.slice(21); //fieldHacchuuMeisaiDts0 左から20桁消す
        $("#" + idleft + "ShouhinMrCd").change();
        if (1 * gyou + 1 >= imax) {
            addHacchuuMeisaiDt();
        }//新規行を追加しておく
    }
    zeiritu_kettei(idleft); // 税率を設定し直し
    denpyou_goukei_saikeisan(); // 総合計も変わる
});

$("[id$='Suuryou']").change(function () { //元数量が変更されたら
    var idleft = $(this).attr("id").slice(0, -7); //fieldHacchuuMeisaiDts0Suuryou 右から7桁消す
    suu_keisu_change(idleft);
});

$("[id$='Keisu']").change(function () { //係数が変更されたら
    var idleft = $(this).attr("id").slice(0, -5); //fieldHacchuuMeisaiDts0Keisu 右から5桁消す
    suu_keisu_change(idleft);
});

function suu_keisu_change(idleft) { //元数量か係数が変更された時の共通処理
    if (1 * $("#" + idleft + "Keisu").val() !== 0 && 1 * $("#" + idleft + "Suuryou").val().replace(/,/g, '') !== 0) {
        var suufld = $("#" + idleft + "Suuryou" + $("#" + idleft + "ZaikoKbn").val());
        suufld.val(1 * $("#" + idleft + "Keisu").val().replace(/,/g, '') * $("#" + idleft + "Suuryou").val().replace(/,/g, ''));
        if (1 * $("#" + idleft + "Irisuu").val().replace(/,/g, '') !== 0) {
            if ($("#" + idleft + "ZaikoKbn").val() == 1) {
                $("#" + idleft + "Suuryou2").val($("#" + idleft + "Suuryou1").val().replace(/,/g, '') * $("#" + idleft + "Irisuu").val().replace(/,/g, ''));
            } else {
                $("#" + idleft + "Suuryou1").val($("#" + idleft + "Suuryou2").val().replace(/,/g, '') / $("#" + idleft + "Irisuu").val().replace(/,/g, ''));
            }
        }
        gyou_kingaku_saikeisan(idleft); // 行金額再計算
        denpyou_goukei_saikeisan(); // 伝票合計再計算
    }
}

$("[id$='Irisuu']").change(function () { //入数が変更されたら
    var idleft = $(this).attr("id").slice(0, -6); //fieldHacchuuMeisaiDts0Irisuu 右から6桁消す
    if (1 * $("#" + idleft + "Suuryou2").replace(/,/g, '') == 0) {
        $("#" + idleft + "Suuryou2").val(1 * $(this).val().replace(/,/g, '') * $("#" + idleft + "Suuryou1").val().replace(/,/g, ''));
        $("#" + idleft + "Suuryou2").change();
    }
});

$("[id$='Suuryou1']").change(function () {
    var idleft = $(this).attr("id").slice(0, -8); //fieldShiireMeisaiDts0Suuryou1 右から8桁消す
    var suu1 = 1 * $(this).val().replace(/,/g, '');
    if (1 * $("#" + idleft + "Irisuu").val().replace(/,/g, '') !== 0) {
        $("#" + idleft + "Suuryou2").val(suu1 * $("#" + idleft + "Irisuu").val().replace(/,/g, ''));
        $("#" + idleft + "Suuryou2").change();
    }
    var sh1 = $("#" + idleft + "Suu1Shousuu").val(); // 小数桁を揃える
    $(this).val(Intl.NumberFormat("ja-JP", {minimumFractionDigits: sh1, maximumFractionDigits: sh1}).format(suu1));//カンマ編集
    if ($("#" + idleft + "TankaKbn").val() == 1) {
        suu1or2change(idleft);
    }
    $("#" + idleft + "Suuryou2").change();
    denpyou_goukei_saikeisan();
});

$("[id$='Suuryou2']").change(function () { //数量2が変更されたら
    var idleft = $(this).attr("id").slice(0, -8); //fieldHacchuuMeisaiDts0Suuryou2 右から8桁消す
    var suu2 = $(this).val().replace(/,/g, '');//カンマ編集を一旦戻す
    var sh2 = $("#" + idleft + "Suu2Shousuu").val(); // 小数桁を揃える
    $(this).val(Intl.NumberFormat("ja-JP", {minimumFractionDigits: sh2, maximumFractionDigits: sh2}).format(suu2));//カンマ編集
    suu1or2change(idleft);
});

function suu1or2change(idleft) {

    var jqleft = '#' + idleft;
    if ($(jqleft + "UtiwakeKbnCd").val() == 20 || $(jqleft + "UtiwakeKbnCd").val() == 24) { // 内部生産
        var tanka_kbn0 = $(jqleft + "TankaKbn").val();
        var tanka_kbn0x = 3 - tanka_kbn0;
        var zaiko_kbn0 = $(jqleft + "ZaikoKbn").val();
        var zaiko_kbn0x = 3 - zaiko_kbn0;
        var gyou = 1 * idleft.slice(22); //fieldHacchuuMeisaiDts0
        var goukeisuuryou = 0;
        var goukeisuuryou1 = $(jqleft + "Suuryou1").val().replace(/,/g, '');
        var goukeisuuryou2 = $(jqleft + "Suuryou2").val().replace(/,/g, '');
        goukeisuuryou = zaiko_kbn0 == 1 ? goukeisuuryou1 : goukeisuuryou2;
        var i0 = 1 * idleft.slice(21);
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
    var idleft = $(this).attr("id").slice(0, -8); //fieldHacchuuMeisaiDts0TankaKbn 右から8桁消す
    gyou_kingaku_saikeisan(idleft); // 行金額再計算
    denpyou_goukei_saikeisan(); // 伝票合計再計算
});

function gyou_kingaku_saikeisan(idleft) { // 行金額再計算
    var suufld = $("#" + idleft + "Suuryou" + $("#" + idleft + "TankaKbn").val());
    $("#" + idleft + "Kingaku").val(Math.round(1000 * suufld.val().replace(/,/g, '')) * Math.round(1000 * $("#" + idleft + "Tanka").val().replace(/,/g, '')) / 1000000); //金額=数量*単価
    $("#" + idleft + "Genkagaku").val(Math.round(1000 * suufld.val().replace(/,/g, '')) * Math.round(1000 * $("#" + idleft + "Gentanka").val().replace(/,/g, '')) / 1000000); //評価額=数量*評価単価
    $('#' + idleft + 'TanniMr1Cd').change();
    gyou_kingaku_kanma(idleft); // 行金額端数処理カンマ編集
}

$("[id$='TanniMr1Cd']").change(function () { //単位1が変更されたら
    var idleft = $(this).attr("id").slice(0, -10); //fieldUriageMeisaiDts0TanniMr1Cd 右から10桁消す
    var tanka_kbn = $('#' + idleft + 'TankaKbn');
    var tanka_kbn_sel = tanka_kbn.val();
    tanka_kbn.children().remove();
    tanka_kbn.append($("<option>").val('1').text('/' + $('#' + idleft + 'TanniMr1Cd option:selected').text()));
    tanka_kbn.append($("<option>").val('2').text('/' + $('#' + idleft + 'TanniMr2Cd option:selected').text()));
    tanka_kbn.val(tanka_kbn_sel);
});

$("[id$='TanniMr2Cd']").change(function () { //単位2が変更されたら
    var idleft = $(this).attr("id").slice(0, -10); //fieldUriageMeisaiDts0TanniMr1Cd 右から10桁消す
    $('#' + idleft + 'TanniMr1Cd').change();
});

$("[id$='Tanka']").change(function () { //単価が変更されたら
    var idleft = $(this).attr("id").slice(0, -5); //fieldHacchuuMeisaiDts0Tanka 右から5桁消す
    $(this).val($(this).val().replace(/,/g, ''));//カンマ編集を一旦戻す
    sh2 = $("#" + idleft + "TankaShousuu").val();
    if ($("#" + idleft + "MotoTanniMr2Cd").val() == $("#" + idleft + "TanniMr2Cd").val()) {
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
    var idleft = $(this).attr("id").slice(0, -7); //fieldHacchuuMeisaiDts0Kingaku 右から7桁消す
    gyou_kingaku_kanma(idleft); // 行金額端数処理カンマ編集
    denpyou_goukei_saikeisan(); // 伝票合計再計算
});

function gyou_kingaku_kanma(idleft) { // 行金額端数処理カンマ編集
    try {
        var kingaku = 1.0 * $("#" + idleft + "Kingaku").val().replace(/,/g, ''); //カンマ編集を一旦戻す
        var hkbn = 1 * $("#gaku_hasuu_shori_kbn_cd").val();
        if (hkbn == 1 && kingaku >= 0 || hkbn == 2 && kingaku < 0) {
            kingaku = Math.trunc(kingaku); //切り捨て
        } else if (hkbn == 1 && kingaku < 0 || hkbn == 2 && kingaku >= 0) {
            kingaku = Math.ceil(kingaku); //切り上げ
        } else {
            kingaku = Math.round(kingaku); //四捨五入
        }
        $("#" + idleft + "Kingaku").val(Intl.NumberFormat("ja-JP", {
            minimumFractionDigits: 0,
            maximumFractionDigits: 0
        }).format(kingaku));//カンマ編集
        zeiritu = 0.01 * cd_zeiritu[$("#" + idleft + "ZeirituMrCd").val()];
        if ($("#fieldZeiTenkaKbnCd").val().substr(0, 1) == "2") { //内税
            hkbn = 1 * $("#zei_hasuu_shori_kbn_cd").val();
            if (hkbn == 1 && kingaku >= 0 || hkbn == 2 && kingaku < 0) {
                $("#" + idleft + "Zeigaku").val(Math.trunc(kingaku / (1 + zeiritu) * zeiritu)); //切り捨て
            } else if (hkbn == 1 && kingaku < 0 || hkbn == 2 && kingaku >= 0) {
                $("#" + idleft + "Zeigaku").val(Math.ceil(kingaku / (1 + zeiritu) * zeiritu)); //切り上げ
            } else {
                $("#" + idleft + "Zeigaku").val(Math.round(kingaku / (1 + zeiritu) * zeiritu)); //四捨五入
            }
            $("#" + idleft + "Zeinukigaku").val(kingaku - $("#" + idleft + "Zeigaku").val());
        } else if ($("#fieldZeiTenkaKbnCd").val() == "40") { // 税額手入力なら
            if ($("#" + idleft + "Utiwake").val() == "90") { // 消費税手入力行なら
                $("#" + idleft + "Zeigaku").val(kingaku); // 金額を全て消費税にする…税抜額が０円になる
                $("#" + idleft + "Zeinukigaku").val(0);
            } else {
                $("#" + idleft + "Zeigaku").val(0);
                $("#" + idleft + "Zeinukigaku").val(kingaku);
            }
        } else {										//外税など
            hkbn = 1 * $("#zei_hasuu_shori_kbn_cd").val();
            if (hkbn == 1 && kingaku >= 0 || hkbn == 2 && kingaku < 0) {
                $("#" + idleft + "Zeigaku").val(Math.trunc(kingaku * zeiritu)); //切り捨て
            } else if (hkbn == 1 && kingaku < 0 || hkbn == 2 && kingaku >= 0) {
                $("#" + idleft + "Zeigaku").val(Math.ceil(kingaku * zeiritu)); //切り上げ
            } else {
                $("#" + idleft + "Zeigaku").val(Math.round(kingaku * zeiritu)); //四捨五入
            }
            $("#" + idleft + "Zeinukigaku").val(kingaku);
        }
    } catch (e) {

    }
}

function denpyou_goukei_saikeisan() { // 伝票合計再計算
    try {
        zeinukigaku = 0;
        shouhizeigaku = 0;
        genkagaku = 0;
        sekisangaku = 0;
        var ritubetugaku = {};
        var idleft = "fieldHacchuuMeisaiDts";
        for (i = 0; i < imax - 1; i++) {
            var tanka_kbn = $('#' + idleft + i + 'TankaKbn').val();
            var suufld = $('#' + idleft + i + 'Suuryou' + tanka_kbn);
            if (1 * $('#' + idleft + i + 'UtiwakeKbnCd').val() < 20) { // 通常、返品、値引き、諸経費のみ
                zeinukigaku += 1 * $('#' + idleft + i + 'Zeinukigaku').val();
                shouhizeigaku += 1 * $('#' + idleft + i + 'Zeigaku').val();
                $('#' + idleft + i + 'Genkagaku').val(Math.round($('#' + idleft + i + 'Gentanka').val().replace(/,/g, '') * $('#' + idleft + i + 'Suuryou' + tanka_kbn).val().replace(/,/g, ''))); //四捨五入
                genkagaku += 1 * $('#' + idleft + i + 'Genkagaku').val();
                if (!ritubetugaku[$('#' + idleft + i + 'ZeirituMrCd').val()]) {
                    ritubetugaku[$('#' + idleft + i + 'ZeirituMrCd').val()] = 0
                }
                ritubetugaku[$('#' + idleft + i + 'ZeirituMrCd').val()] += 1 * $('#' + idleft + i + 'Kingaku').val().replace(/,/g, ''); // 税別額[税率キー]+=金額
            }
            if (i > 0) {
                sekisangaku += $('#' + idleft + i + 'Gentanka').val().replace(/,/g, '') * $('#' + idleft + i + 'Suuryou' + tanka_kbn).val().replace(/,/g, '');//alert(sekisangaku);
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
        $("#fieldGoukeigaku").val(Intl.NumberFormat("ja-JP", {
            minimumFractionDigits: 0,
            maximumFractionDigits: 0
        }).format(goukeigaku));//カンマ編集
        var tanka_kbn = $('#' + idleft + '0' + 'TankaKbn').val();
        $("#fieldSekisanGoukeigaku").val(Intl.NumberFormat("ja-JP", {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        }).format((sekisangaku) / $('#' + idleft + '0Suuryou' + tanka_kbn).val().replace(/,/g, '')));//カンマ編集
    } catch (e) {

    }
}

$("[id$='ShouhinMrCd']").focusin(function (e) { //商品在庫索引
    if ($(this).val() == '') {
        $('#fieldGenzaiko').val('');
    } else {
        let idleft = $(this).attr("id").slice(0, -11);
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
    $targetElm = $(targetElm);
}

function switch_ros(fieldx) { // 項目制御readonly設定(明細)
    if ($("#hidden" + fieldx).attr("readonly") === "readonly") {
        $("#hidden" + fieldx).removeAttr("readonly");
        for (var i = 0; i < imax; i++) {
            $("#fieldHacchuuMeisaiDts" + i + fieldx).removeAttr("readonly");
        }
    } else {
        $("#hidden" + fieldx).attr("readonly", "readonly");
        for (var i = 0; i < imax; i++) {
            $("#fieldHacchuuMeisaiDts" + i + fieldx).attr("readonly", "readonly");
        }
    }
    $targetElm = $(targetElm);
}

var ro_fields = [
    'cd', 'hacchuubi', 'juchuu_dt_cd', 'nounyuu_kijitu', 'zeiritu_tekiyoubi', 'torihiki_kbn_cd',
    'zei_tenka_kbn_cd', 'hassousaki_kbn_cd', 'tekiyou', 'shounin_joutai_flg', 'shounin_sha_mr_cd',
    '[cd', '[utiwake_kbn_cd', '[kousei', '[nyuuka_kbn_cd', '[shouhin_mr_cd', '[tekiyou', '[iro', '[iromei', '[lot', '[kobetucd', '[souko_mr_cd', '[hinsitu_kbn_cd', '[suuryou', '[keisu', '[irisuu', '[suuryou1',
    '[tanni_mr1_cd', '[suuryou2', '[tanni_mr2_cd', '[hacchuuzan', '[tanka_kbn', '[gentanka', '[tanka', '[kingaku', '[zeiritu_mr_cd', '[nouki', '[bikou'
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
            ro_field_name = 'data[hacchuu_meisai_dts][0]' + ro_fields[j] + ']';
            rewidths[ro_fields[j]] = $("[name='" + ro_field_name + "']").outerWidth();
        }
    }
    $.ajax({
        type: "POST",
        url: readonlys_ajaxSave,
        data: {'controller_cd': 'HacchuuDts', 'gamen_cd': 'inputfields', 'readonlys': readonlys, 'rewidths': rewidths,},
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

/**
 * 納期の確認
 *
 * @returns {boolean}
 */
function finalNoukiCheck() {
    try {
        const hacchuubi = new Date($('#fieldHacchuubi').val());
        console.log(hacchuubi);
        const nouki = new Date($('#fieldNounyuuKijitu').val());
        console.log(nouki);

        if (hacchuubi >= nouki) {
            $("#dispErrMsg").text('希望納期が発注日より前に設定されています。');
            return false;
        } else {
            return true;
        }
    } catch (e) {
        console.log(e.message);
        $('#dispErrMsg').text('発注日か納期が不正です。');
        return false;
    }
}

function final_check() { // Focusを外す 2019/9/5
    $("#F12").focus();
    denpyou_goukei_saikeisan(); // 伝票合計再計算
    if (!final_meisai_check()) return false;
    if (!finalNoukiCheck()) return false;
    var res = confirm('登録しても、よろしいですか?');
    if (res === true) {
        $('#formTouroku').submit();
    }
    return false;
}

function final_meisai_check() {
    var jqleft = '#fieldHacchuuMeisaiDts';
    for (var i = 0; i < (imax - 1); i++) {
        $(jqleft + i + "Lot").val($(jqleft + i + "Lot").val().trim()); // 空白除去
        $(jqleft + i + "Iro").val($(jqleft + i + "Iro").val().trim()); // 空白除去
        $(jqleft + i + "Iromei").val($(jqleft + i + "Iromei").val().trim()); // 空白除去
        $(jqleft + i + "Kobetucd").val($(jqleft + i + "Kobetucd").val().trim()); // 空白除去
        if (!($(jqleft + i + "SoukoMrCd").val())) {
            $("#dispErrMsg").text("" + (1 + i) + "行目の倉庫を入力してください。");
            return false;
        }
        if (!$(jqleft + i + "Cd").val() || $(jqleft + i + "Cd").val() == 0) {
            //console.log('Cd:' + $(jqleft + i + "Cd").val());
            continue;
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
