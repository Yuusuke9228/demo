idmeisaif = 'fieldShukkairaiMeisaiDts';
jqmeisaif = '#' + idmeisaif;

function addShukkairaiMeisaiDt() { // alert(imax);
    tr_id = '#tr_shukkairai_meisai_dt_' + imax;
    id_head = 'fieldShukkairaiMeisaiDts' + imax;
    name_head = 'data[shukkairai_meisai_dts][' + imax + ']';
    $("#tr_shukkairai_meisai_dt_hidden").clone(true).attr('id', 'tr_shukkairai_meisai_dt_' + imax).removeAttr('style').insertAfter('#tr_shukkairai_meisai_dt_' + ((imax > 0) ? imax - 1 : 'hidden'));
    $(tr_id + " #hiddenCd").attr('id', id_head + 'Cd').attr('name', name_head + '[cd]');
    $(tr_id + " #hiddenId").attr('id', id_head + 'Id').attr('name', name_head + '[id]');
    $(tr_id + " #hiddenUpdated").attr('id', id_head + 'Updated').attr('name', name_head + '[updated]');
    $(tr_id + " #hiddenUtiwakeKbnCd").attr('id', id_head + 'UtiwakeKbnCd').attr('name', name_head + '[utiwake_kbn_cd]');
    $(tr_id + " #hiddenShukkaKbnCd").attr('id', id_head + 'ShukkaKbnCd').attr('name', name_head + '[shukka_kbn_cd]');
    $(tr_id + " #hiddenShouhinMrCd").attr('id', id_head + 'ShouhinMrCd').attr('name', name_head + '[shouhin_mr_cd]');
    $(tr_id + " #hiddenTanniMr1Cd").attr('id', id_head + 'TanniMr1Cd').attr('name', name_head + '[tanni_mr1_cd]');
    $(tr_id + " #hiddenTanniMr2Cd").attr('id', id_head + 'TanniMr2Cd').attr('name', name_head + '[tanni_mr2_cd]');
    $(tr_id + " #hiddenIrisuu").attr('id', id_head + 'Irisuu').attr('name', name_head + '[irisuu]');
    $(tr_id + " #hiddenSuuryou1").attr('id', id_head + 'Suuryou1').attr('name', name_head + '[suuryou1]');
    $(tr_id + " #hiddenTekiyou").attr('id', id_head + 'Tekiyou').attr('name', name_head + '[tekiyou]');
    $(tr_id + " #hiddenIro").attr('id', id_head + 'Iro').attr('name', name_head + '[Iro]');
    $(tr_id + " #hiddenIromei").attr('id', id_head + 'Iromei').attr('name', name_head + '[Iromei]');
    $(tr_id + " #hiddenLot").attr('id', id_head + 'Lot').attr('name', name_head + '[lot]');
    $(tr_id + " #hiddenKobetucd").attr('id', id_head + 'Kobetucd').attr('name', name_head + '[kobetucd]');
    $(tr_id + " #hiddenHinsituKbnCd").attr('id', id_head + 'HinsituKbnCd').attr('name', name_head + '[hinsitu_kbn_cd]');
    $(tr_id + " #hiddenSoukoMrCd").attr('id', id_head + 'SoukoMrCd').attr('name', name_head + '[souko_mr_cd]');
    $(tr_id + " #hiddenShukkairaizan").attr('id', id_head + 'Shukkairaizan').attr('name', name_head + '[shukkairaizan]');
    $(tr_id + " #hiddenSuuryou2").attr('id', id_head + 'Suuryou2').attr('name', name_head + '[suuryou2]');
    $(tr_id + " #hiddenMotoTanniMr2Cd").attr('id', id_head + 'MotoTanniMr2Cd').attr('name', name_head + '[moto_tanni_mr2_cd]');
    $(tr_id + " #hiddenSuu1Shousuu").attr('id', id_head + 'Suu1Shousuu').attr('name', name_head + '[suu1_shousuu]');
    $(tr_id + " #hiddenSuu2Shousuu").attr('id', id_head + 'Suu2Shousuu').attr('name', name_head + '[suu2_shousuu]');
    $(tr_id + " #hiddenTankaShousuu").attr('id', id_head + 'TankaShousuu').attr('name', name_head + '[tanka_shousuu]');
    $(tr_id + " #hiddenTankaKbn").attr('id', id_head + 'TankaKbn').attr('name', name_head + '[tanka_kbn]');
    $(tr_id + " #hiddenZaikoKbn").attr('id', id_head + 'ZaikoKbn').attr('name', name_head + '[zaiko_kbn]');
    $(tr_id + " #hiddenGentanka").attr('id', id_head + 'Gentanka').attr('name', name_head + '[gentanka]');
    $(tr_id + " #hiddenGenkagaku").attr('id', id_head + 'Genkagaku').attr('name', name_head + '[genkagaku]');
    $(tr_id + " #hiddenProjectMrCd").attr('id', id_head + 'ProjectMrCd').attr('name', name_head + '[project_mr_cd]');
    $(tr_id + " #hiddenNouki").attr('id', id_head + 'Nouki').attr('name', name_head + '[nouki]');
    $(tr_id + " #hiddenBikou").attr('id', id_head + 'Bikou').attr('name', name_head + '[bikou]');
    $("#" + id_head + 'Cd').val(imax + 1);
    $("#" + id_head + 'Id').val(0);
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
    addShukkairaiMeisaiDt();
    hassousaki_mrs_modal = hassousaki_mrs_modals[$("#fieldHassousakiKbnCd").val()];
    hassousaki_mrs_ajaxGet = hassousaki_mrs_ajaxGets[$("#fieldHassousakiKbnCd").val()];
    //$('#fieldHassousakiMrCd').change();
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
    form1.append($('<input>', {type: 'hidden', name: 'denpyou_mr_cd', value: 'shukkairai'}));
}

$('#END').click(function () { //エンドキー(END)を押したら
    var index = $targetElm.index($("#" + lastfocusin));//alert(index);
    var thisname = $("#" + lastfocusin).attr('name');
    var partsname = thisname.split(/[\[|\]]+/);// '['か']'かその連続にマッチする文字で分割する。例：data[shukkairai_meisai_dts][0][shouhin_mr_cd]は、['data','shukkairai_meisai_dts','0','shouhin_mr_cd','']となる。
    var findend = '[shouhin_mr_cd]';
    if (imax > 1 && partsname.length == 5) {
        findend = '[' + partsname[3] + ']';
    }
    var findlen = -findend.length;
    index = $targetElm.index($("#fieldShukkairaiMeisaiDts" + (imax - 1) + "Cd")) - 1;
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

var cpyary = [
    'UtiwakeKbnCd', 'ShukkaKbnCd', 'ShouhinMrCd', 'TanniMr1Cd', 'TanniMr2Cd', 'TankaKbn', 'ZaikoKbn', 'Irisuu', 'Suuryou1', 'Tekiyou',
    'Iro', 'Iromei', 'Lot', 'Kobetucd', 'HinsituKbnCd', 'SoukoMrCd', 'Suuryou2', 'MotoTanniMr2Cd', 'Suu1Shousuu', 'Suu2Shousuu', 'TankaShousuu', 'Gentanka', 'Genkagaku',
    'ProjectMrCd', 'Nouki', 'Bikou'
];

$('#PgDn').click(function () { //ページダウンキー(Ctrl+Enter)を押したら
    var index = $targetElm.index($("#" + lastfocusin));//alert(index);
    var thisname = $("#" + lastfocusin).attr('name');
    var partsname = thisname.split(/[\[|\]]+/);// '['か']'かその連続にマッチする文字で分割する。例：data[shukkairai_meisai_dts][0][shouhin_mr_cd]は、['data','shukkairai_meisai_dts','0','shouhin_mr_cd','']となる。
    var findend = '[shouhin_mr_cd]';
    if (imax > 1 && partsname.length == 5) {
        findend = '[' + partsname[3] + ']';
        if (1 * partsname[2] + 1 == imax) {
            for (var i in cpyary) {
                if (!$("#" + lastfocusin).val() || 'fieldShukkairaiMeisaiDts' + partsname[2] + cpyary[i] != lastfocusin) {
                    $('#fieldShukkairaiMeisaiDts' + partsname[2] + cpyary[i]).val($('#fieldShukkairaiMeisaiDts' + (1 * partsname[2] - 1) + cpyary[i]).val());
                }
            }
            $("#fieldShukkairaiMeisaiDts" + partsname[2] + "Suuryou" + $("#fieldShukkairaiMeisaiDts" + partsname[2] + "TankaKbn").val()).change();
            $("#fieldShukkairaiMeisaiDts" + partsname[2] + "TanniMr1Cd").change();
            addShukkairaiMeisaiDt();//新規行を追加
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

$('#fieldCd').change(function () { //出荷依頼伝票索引
    //	alert($(this).val()); //''の場合、'0'など1桁の場合または結果が複数の場合、結果が1個の場合、結果が0個の場合
    if ($(this).val() != '') {
        $.ajax({
            type: "POST",
            url: shukkairai_dts_ajaxGet,
            data: {'cd': $(this).val(),},
            async: true,
            dataType: 'json',
            success: function (data) {
                if (data.length >= 1 && $('#fieldCd').val() === data[0].cd) {
                    location.href = shukkairai_dts_edit + data[0].id;
                } else {
                    $('#fieldCd').focus().select();
                }
            },
            error: function (xhr, status, err) {
                alert('エラー Cd.change.ajax ' + status + '/' + err);
            },
        });
    } else {
        //alert("新規");
        location.href = shukkairai_dts_new;
    }
});

$('#fieldJuchuuDtCd').change(function () { //受注伝票の索引
    //alert("AAA:".$(this).attr("id")); //''の場合、'0'など1桁の場合または結果が複数の場合、結果が1個の場合、結果が0個の場合
    if ($(this).val() == '') {
        $('#fieldJuchuuDtId').val(0);
        $('#fieldTokuisakiMrCd').val('');
        $('#fieldTokuisakiMrName').val('');
    } else {
        $("#fieldSoukoMrCd").val('');
        $.ajax({
            type: "POST",
            url: juchuu_dts_ajaxGet,
            data: {'cd': $(this).val(),},
            async: true,
            dataType: 'json',
            success: function (data) {
                if (data.length == 0) {
                    $("#fieldSoukoMrName").val('>>受注エラー:未登録');
                } else if (data.length == 1 || $("#fieldJuchuuDtCd").val() === data[0].cd) {
                    //選択肢をクリアしてから追加する
                    $('#JuchuuDtsOptions > option').remove();
                    for (var i = 0; i < data.length; i++) {
                        $('#JuchuuDtsOptions').append('<option value="' + data[i].cd + '">' + data[i].cd + ':' + data[i]["meisai"][1].tekiyou + '</option>');
                    }
                    console.log(data[0]);
                    //展開出来ていない項目が多かったので、内容修正 2019/8/13
                    $('#fieldIraiKbnCd').val(2); // 2=売上
                    $('#fieldJuchuuDtId').val(data[0].id);
                    $('#fieldJuchuuDtCd').val(data[0].cd);
                    $('#fieldTokuisakiMrCd').val(data[0].tokuisaki_mr_cd);
                    $('#fieldTokuisakiMrName').val(data[0].tokuisaki_mr_name);
                    $("#fieldSoukoMrCd").val(data[0]["meisai"][1].souko_mr_cd);
                    $("#fieldSoukoMrName").val(data[0]["meisai"][1].souko_mr_name);
                    $('#fieldHassousakiKbnCd').val(3); // 3=納入先
                    $('#fieldHassousakiMrCd').val(data[0].nounyuusaki_mr_cd);
                    $('#fieldHassousaki').val(data[0].nounyuusaki);
                    $('#fieldKidukesakiMrCd').val(data[0].kidukesaki_mr_cd);	//気付先コード 2019/7/11
                    $('#fieldKiduke').val(data[0].kiduke);						//気付先       2019/7/11
                    $('#fieldTantouMrCd').val(data[0].tantou_mr_cd);
                    $('#fieldTekiyou').val(data[0].tekiyou);
                    var i = 0;
                    for (m_dt in data[0]["meisai"]) {
                        //if (data[0]["meisai"][m_dt].zaikokanri == 1 && data[0]["meisai"][m_dt].utiwake_kbn_cd != 21 && data[0]["meisai"][m_dt].utiwake_kbn_cd != 30) //試作が複写されない為
                        if (data[0]["meisai"][m_dt].shouhin_mr_cd !== '999' && data[0]["meisai"][m_dt].utiwake_kbn_cd != 21 && data[0]["meisai"][m_dt].utiwake_kbn_cd != 30) {
                            $(jqmeisaif + i + 'UtiwakeKbnCd').val(data[0]["meisai"][m_dt].utiwake_kbn_cd);
                            $(jqmeisaif + i + 'ShouhinMrCd').val(data[0]["meisai"][m_dt].shouhin_mr_cd);
                            $(jqmeisaif + i + 'Tekiyou').val(data[0]["meisai"][m_dt].tekiyou);
                            $(jqmeisaif + i + 'Lot').val(data[0]["meisai"][m_dt].lot);
                            $(jqmeisaif + i + 'Iro').val(data[0]["meisai"][m_dt].iro);
                            $(jqmeisaif + i + 'Iromei').val(data[0]["meisai"][m_dt].iromei);
                            $(jqmeisaif + i + 'Kobetucd').val(data[0]["meisai"][m_dt].kobetucd);
                            $(jqmeisaif + i + 'HinsituKbnCd').val(data[0]["meisai"][m_dt].hinsitu_kbn_cd);
                            $(jqmeisaif + i + 'SoukoMrCd').val($("#fieldSoukoMrCd").val());
                            $(jqmeisaif + i + 'Irisuu').val(data[0]["meisai"][m_dt].irisuu);
                            $(jqmeisaif + i + 'Suuryou1').val(data[0]["meisai"][m_dt].suuryou1);
                            $(jqmeisaif + i + 'TanniMr1Cd').val(data[0]["meisai"][m_dt].tanni_mr1_cd);
                            $(jqmeisaif + i + 'Suuryou2').val(data[0]["meisai"][m_dt].suuryou2);
                            $(jqmeisaif + i + 'TanniMr2Cd').val(data[0]["meisai"][m_dt].tanni_mr2_cd);
                            $(jqmeisaif + i + 'Gentanka').val(data[0]["meisai"][m_dt].gentanka);
                            $(jqmeisaif + i + 'TankaKbn').val(data[0]["meisai"][m_dt].tanka_kbn);
                            $(jqmeisaif + i + 'Bikou').val(data[0]["meisai"][m_dt].bikou);
                            $(jqmeisaif + i + 'Suu1Shousuu').val(data[0]["meisai"][m_dt].suu1_shousuu);	//2019/8/27
                            $(jqmeisaif + i + 'Suu2Shousuu').val(data[0]["meisai"][m_dt].suu2_shousuu);	//2019/8/27
                            i++;
                            if (i >= imax) {
                                addShukkairaiMeisaiDt();
                            }//新規行を追加しておく
                        }
                    }
                } else {
                    //選択肢をクリアしてから追加する
                    $('#JuchuuDtsOptions > option').remove();
                    for (var i = 0; i < data.length; i++) {
                        $('#JuchuuDtsOptions').append('<option value="' + data[i].cd + '">' + data[i].cd + ':' + data[i]["meisai"][1].tekiyou + '</option>');
                    }
                    $("#fieldSoukoMrName").val('>>受注複数エラー:選択可');
                    $("#fieldJuchuuDtCd").focus().select();
                }
            },
            error: function (xhr, status, err) {
                $("#fieldSoukoMrName").val('>受注エラー' + status + '/' + err);
            },
        });
    }
});

$('#fieldHacchuuDtCd').change(function () { //発注伝票の索引
    //alert("AAA:".$(this).attr("id")); //''の場合、'0'など1桁の場合または結果が複数の場合、結果が1個の場合、結果が0個の場合
    if ($(this).val() == '') {
    } else {
        $("#fieldSoukoMrCd").val('');
        $.ajax({
            type: "POST",
            url: hacchuu_dts_ajaxGet,
            data: {'cd': $(this).val(),},
            async: true,
            dataType: 'json',
            success: function (data) {
                if (data.length == 0) {
                    $("#fieldSoukoMrName").val('>>発注エラー:未登録');
                } else if (data.length == 1 || $("#fieldHacchuuDtCd").val() === data[0].cd) {
                    //選択肢をクリアしてから追加する
                    $('#HacchuuDtsOptions > option').remove();
                    for (var i = 0; i < data.length; i++) {
                        $('#HacchuuDtsOptions').append('<option value="' + data[i].cd + '">' + data[i].cd + ':' + data[i]["meisai"][1].tekiyou + '</option>');
                    }
                    console.log(data[0]);
                    $('#fieldIraiKbnCd').val(data[0].juchuu_dt_cd == 0 ? 1 : 2); // 2=売上
                    $('#fieldHacchuuDtId').val(data[0].id);
                    $('#fieldHacchuuDtCd').val(data[0].cd);
                    $('#fieldJuchuuDtId').val(data[0].juchuu_dt_id);
                    $('#fieldJuchuuDtCd').val(data[0].juchuu_dt_cd);
                    $('#fieldTokuisakiMrCd').val(data[0].juchuu_tokuisaki_mr_cd);
                    $('#fieldTokuisakiMrName').val(data[0].juchuu_tokuisaki_mr_name);
                    $("#fieldSoukoMrCd").val(data[0]["meisai"][1].souko_mr_cd);
                    $("#fieldSoukoMrName").val(data[0]["meisai"][1].souko_mr_name);
                    $('#fieldHassousakiKbnCd').val(data[0].hassousaki_kbn_cd); // 3=納入先
                    $('#fieldHassousaki').val(data[0].hassousaki_mr_name);//追加2019/8/31
                    $('#fieldHassousakiMrCd').val(data[0].hassousaki_mr_cd);
                    //$('#fieldHassousaki').val(data[0].hassousaki);	//2019/8/31コメントアウト
                    $('#fieldTantouMrCd').val(data[0].tantou_mr_cd);
                    $('#fieldTekiyou').val(data[0].tekiyou);
                    var i = 0;
                    for (m_dt in data[0]["meisai"]) {
                        if (data[0]["meisai"][m_dt].zaikokanri == 1 && data[0]["meisai"][m_dt].utiwake_kbn_cd != 21 && data[0]["meisai"][m_dt].utiwake_kbn_cd != 30) {
                            $(jqmeisaif + i + 'UtiwakeKbnCd').val(data[0]["meisai"][m_dt].utiwake_kbn_cd);
                            $(jqmeisaif + i + 'ShouhinMrCd').val(data[0]["meisai"][m_dt].shouhin_mr_cd);
                            $(jqmeisaif + i + 'Tekiyou').val(data[0]["meisai"][m_dt].tekiyou);
                            $(jqmeisaif + i + 'Lot').val(data[0]["meisai"][m_dt].lot);
                            $(jqmeisaif + i + 'Iro').val(data[0]["meisai"][m_dt].iro);
                            $(jqmeisaif + i + 'Iromei').val(data[0]["meisai"][m_dt].iromei);
                            $(jqmeisaif + i + 'Kobetucd').val(data[0]["meisai"][m_dt].kobetucd);
                            $(jqmeisaif + i + 'HinsituKbnCd').val(data[0]["meisai"][m_dt].hinsitu_kbn_cd);
                            $(jqmeisaif + i + 'SoukoMrCd').val($("#fieldSoukoMrCd").val());
                            $(jqmeisaif + i + 'Irisuu').val(data[0]["meisai"][m_dt].irisuu);
                            $(jqmeisaif + i + 'Suuryou1').val(data[0]["meisai"][m_dt].suuryou1);
                            $(jqmeisaif + i + 'TanniMr1Cd').val(data[0]["meisai"][m_dt].tanni_mr1_cd);
                            $(jqmeisaif + i + 'Suuryou2').val(data[0]["meisai"][m_dt].suuryou2);
                            $(jqmeisaif + i + 'TanniMr2Cd').val(data[0]["meisai"][m_dt].tanni_mr2_cd);
                            $(jqmeisaif + i + 'Gentanka').val(data[0]["meisai"][m_dt].gentanka);
                            $(jqmeisaif + i + 'TankaKbn').val(data[0]["meisai"][m_dt].tanka_kbn);
                            $(jqmeisaif + i + 'Bikou').val(data[0]["meisai"][m_dt].bikou);
                            $(jqmeisaif + i + 'Suu1Shousuu').val(data[0]["meisai"][m_dt].suu1_shousuu);	//2019/8/27
                            $(jqmeisaif + i + 'Suu2Shousuu').val(data[0]["meisai"][m_dt].suu2_shousuu);	//2019/8/27
                            //	$(jqmeisaif+i+'Nouki').val(data[0]["meisai"][m_dt].nouki);
                            i++;
                            if (i >= imax) {
                                addShukkairaiMeisaiDt();
                            }//新規行を追加しておく
                        }
                    }
                } else {
                    //選択肢をクリアしてから追加する
                    $('#HacchuuDtsOptions > option').remove();
                    for (var i = 0; i < data.length; i++) {
                        $('#HacchuuDtsOptions').append('<option value="' + data[i].cd + '">' + data[i].cd + ':' + data[i].shiiresaki_mr_name + '</option>');
                    }
                    $("#fieldSoukoMrName").val('>>発注複数エラー:選択可');
                    $("#fieldHacchuuDtCd").focus().select();
                }
            },
            error: function (xhr, status, err) {
                $("#fieldSoukoMrName").val('>発注エラー' + status + '/' + err);
            },
        });
    }
});

$('#fieldSoukoMrCd').change(function () { //依頼先マスター索引
    //alert("AAA:".$(this).attr("id")); //''の場合、'0'など1桁の場合または結果が複数の場合、結果が1個の場合、結果が0個の場合
    if ($(this).val() == '') {
        $("#fieldSoukoMrName").val("");
    } else {
        $.ajax({
            type: "POST",
            url: souko_mrs_ajaxGet,
            data: {'cd': $(this).val(),},
            async: true,
            dataType: 'json',
            success: function (data) {
                if (data.length == 0) {
                    $("#fieldSoukoMrName").val('>>エラー:未登録');
                } else if (data.length == 1 || $("#fieldSoukoMrCd").val() === data[0].cd) {
                    $('#SoukoMrsOptions > option').remove();
                    for (var i = 0; i < data.length; i++) {
                        $('#SoukoMrsOptions').append('<option value="' + data[i].cd + '">' + data[i].cd + ':' + data[i].name + '</option>');
                    }
                    $("#fieldSoukoMrCd").val(data[0].cd);
                    $("#fieldSoukoMrName").val(data[0].name);
                    if ($("#fieldTantouMrCd").val() == "") {
                        $("#fieldTantouMrCd").val(data[0].tantou_mr_cd);
                    }
                } else {
                    //選択肢をクリアしてから追加する
                    $('#SoukoMrsOptions > option').remove();
                    for (var i = 0; i < data.length; i++) {
                        $('#SoukoMrsOptions').append('<option value="' + data[i].cd + '">' + data[i].cd + ':' + data[i].name + '</option>');
                    }
                    $("#fieldSoukoMrName").val('>>エラー:未登録');
                    $("#fieldSoukoMrCd").focus().select();
                }
            },
            error: function (xhr, status, err) {
                $("#fieldSoukoMrName").val('>エラー' + status + '/' + err);
            },
        });
    }
});

$('#fieldHassousakiMrCd').change(function () { //発送先マスター(得意先マスターか納入先マスターか倉庫マスター)の索引
    //alert("AAA:".$(this).attr("id")); //''の場合、'0'など1桁の場合または結果が複数の場合、結果が1個の場合、結果が0個の場合
    //if ($("#fieldHassousaki").val() !== '') return;
    if ($(this).val() == '') {
        $("#fieldHassousaki").val("");
    } else {
        $.ajax({
            type: "POST",
            url: hassousaki_mrs_ajaxGet,
            data: {'cd': $(this).val(),},
            async: true,
            dataType: 'json',
            success: function (data) {
                if (data.length == 0) {
                    $("#fieldHassousaki").val('>>エラー:未登録');
                } else if (data.length == 1 || $("#fieldHassousakiMrCd").val() === data[0].cd) {
                    //選択肢をクリアしてから追加する
                    $('#HassousakiMrsOptions > option').remove();
                    for (var i = 0; i < data.length; i++) {
                        $('#HassousakiMrsOptions').append('<option value="' + data[i].cd + '">' + data[i].cd + ':' + data[i].name + '</option>');
                    }
                    $("#fieldHassousakiMrCd").val(data[0].cd);
                    $("#fieldHassousaki").val(data[0].name);
                } else {
                    //選択肢をクリアしてから追加する
                    $('#HassousakiMrsOptions > option').remove();
                    for (var i = 0; i < data.length; i++) {
                        $('#HassousakiMrsOptions').append('<option value="' + data[i].cd + '">' + data[i].cd + ':' + data[i].name + '</option>');
                    }
                    $("#fieldHassousaki").val('>>エラー:未登録');
                    $("#fieldHassousakiMrCd").focus().select();
                }
            },
            error: function (xhr, status, err) {
                $("#fieldHassousak").val('>エラー' + status + '/' + err);
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
    var gyou = idleft.slice(24); //fieldShukkairaiMeisaiDts0 左から20桁消す
    if (1 * gyou + 1 >= imax) {
        addShukkairaiMeisaiDt();
    }//新規行を追加しておく
});

$("[id$='ShouhinMrCd']").change(function () { //商品マスター索引
    //alert("AAA:".$(this).attr("id")); //''の場合、'0'など1桁の場合または結果が複数の場合、結果が1個の場合、結果が0個の場合
    var idleft = $(this).attr("id").slice(0, -11); //fieldShukkairaiMeisaiDts0ShouhinMrCd 右から11桁消す
    var gyou = idleft.slice(24); //fieldShukkairaiMeisaiDts0 左から20桁消す
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
                    //$('#ShouhinMrsOptions > option').remove();
                    //for ( var i = 0; i < data.length; i++ ) {
                    //	$('#ShouhinMrsOptions').append('<option value="' + data[i].cd + '">' + data[i].cd + ':' + data[i].name + '</option>');
                    //}
                    console.log(data[0]);
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
                    $("#" + idleft + "Suu1Shousuu").val(data[0].suu1_shousuu);
                    $("#" + idleft + "Suu2Shousuu").val(data[0].suu2_shousuu);
                    $("#" + idleft + "TankaShousuu").val(data[0].tanka_shousuu);
                    $("#" + idleft + "TankaKbn").val(data[0].tanka_kbn);
                    $("#" + idleft + "ZaikoKbn").val(data[0].zaiko_kbn);
                    $("#" + idleft + "SoukoMrCd").val($("#fieldSoukoMrCd").val());
                    //$("#"+idleft+"Gentanka").val(data[0][$("#fieldTankaShuruiKbnKoumokumei").val()]);//tanka_shurui_kbn_cdによって選ぶ
                    $('#' + idleft + "Gentanka").val(data[0].shiire_tanka);

                    if ($("#" + idleft + "UtiwakeKbnCd").val() == '') {
                        $("#" + idleft + "UtiwakeKbnCd").val($("#fieldIraiKbnCd").val() == 1 ? '2' : '10');
                    } // 通常は通常とする
                    if (1 * gyou + 1 >= imax) {
                        addShukkairaiMeisaiDt();
                    }//新規行を追加しておく

                    try {
                        var souko_cd = $("#" + idleft + +'SoukoMrCd').val();
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

$("[id$='Lot']").dblclick(function () { //商品マスター索引 lot_summary_modal
    modalstart(lot_summary_modal, "ロット別在庫", "?cd=" + $('#' + lastfocusin.slice(0, -3) + "ShouhinMrCd").val().replace('+', '%2B'));
});

/* モーダルダイヤログ部分 */
function f8key() {
    if (lastfocusin == "fieldCd") { /* 出荷依頼データ選択 */
        modalstart(shukkairai_dts_modal, "出荷依頼データ選択");
    } else if (lastfocusin == "fieldSoukoMrCd") { /* 依頼先コード選択 */
        modalstart(souko_mrs_modal, "依頼先選択");
    } else if (lastfocusin == "fieldHassousakiMrCd" && hassousaki_mrs_modal != "") { /* 発送先コード選択 */
        //複写した初回、hassousaki_mrs_modalがundefinedなので、チェンジイベントを起こしurlを作成	Add By Nishiyama 2019/6/26
        if (typeof hassousaki_mrs_modal === 'undefined') {
            $("#fieldHassousakiKbnCd").change();
        }
        modalstart(hassousaki_mrs_modal, "発送先選択");
    } else if (lastfocusin == "fieldKidukesakiMrCd") { /* 気付先コード選択 */
        modalstart(nounyuusaki_mrs_modal, "気付先選択");
    } else if (lastfocusin == "fieldJuchuuDtCd" && juchuu_dts_modal != "") { /* 受注伝票選択 */
        modalstart(juchuu_dts_modal, "受注選択");
    } else if (lastfocusin == "fieldHacchuuDtCd" && hacchuu_dts_modal != "") { /* 発注伝票選択 */
        modalstart(hacchuu_dts_modal, "発注選択");
    } else if (lastfocusin.slice(-11) == "ShouhinMrCd") { /* 商品コード選択 */
        modalstart(shouhin_mrs_modal, "商品選択");
    } else if (lastfocusin.slice(-3) == "Lot") { /* ロット別在庫選択 */
        modalstart(lot_summary_modal, "ロット別在庫", "?cd=" + $('#' + lastfocusin.slice(0, -3) + "ShouhinMrCd").val().replace('+', '%2B'));
    } else if (lastfocusin == "fieldIraibi") { /* 発行日選択 */
        open_datepicker();
    } else if (lastfocusin == "fieldShukkabi") { /* 出荷日選択 */
        open_datepicker();
    } else if (lastfocusin.slice(-5) == "Nouki") { /* 納期選択 */
        open_datepicker();
    }
}

$('#fieldSoukoMrCd').focusout(function () { /* 依頼先コード選択 */
    if ($('#fieldSoukoMrCd').val() == '') {
        modalstart(souko_mrs_modal, "依頼先選択");
        setTimeout(function () {
            lastfocusin = "fieldSoukoMrCd";
        }, 1000); // 1秒後フォーカス設定し直し
    }
});

/* モーダル印刷ダイヤログ部分 */
function f5key() {
    modalstart(chouhyou_mrs_modal, "出荷依頼伝票印刷", "/shukkairai"); // hachuu=出荷依頼伝票
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
                let rowId = '#fieldShukkairaiMeisaiDts' + rowIndex + 'SoukoMrCd';
                $(rowId).val(souko_code);
            }
            //LOT在庫数量
            if (zaikosuu !== '') {
                let zaiko = parseFloat(zaikosuu);
                $("#fieldGenzaiko").val(zaiko);
            }
            //色番
            if (iro !== '') {
                let iroID = '#fieldShukkairaiMeisaiDts' + rowIndex + 'Iro';
                $(iroID).val(iro);
            }
            //色名
            if (iromei !== '') {
                let iroName = '#fieldShukkairaiMeisaiDts' + rowIndex + 'Iromei';
                $(iroName).val(iromei);
            }

            if (hinsitu_kbn_cd !== '') {
                let hinshitu = '#fieldShukkairaiMeisaiDts' + rowIndex + 'HinsituKbnCd';
                $(hinshitu).val(hinsitu_kbn_cd);
                $(hinshitu +  'option[value=' + hinsitu_kbn_cd + ']').prop('selected',true);
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
                //2019/12/19 Iura 印刷同時更新を禁止する
                location.href = server_name + $("#id").val() + "/" + retval
                //$('#formTouroku').submit(); // 更新実行
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
    $("#fieldHassousaki").val("");
});

$("[id$='Cd']").change(function () { //行番号が変更されたら
    var idleft = $(this).attr("id").slice(0, -2); //fieldShukkairaiMeisaiDts0Cd 右から2桁消す
    //	console.log(idleft+idleft.length);
    if (idleft.length < 27 && idleft.slice(0, 21) == 'fieldShukkairaiMeisaiDts') {
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
    var idleft = $(this).attr("id").slice(0, -12); //fieldShukkairaiMeisaiDts0UtiwakeKbnCd 右から12桁消す
    $("#" + idleft + "ZeirituMrCd").val("");
    if ($("#" + idleft + "UtiwakeKbnCd").val() === '40' || $("#" + idleft + "UtiwakeKbnCd").val() === '41') {	//暫定処理 登録時、明細が消える為
        $("#" + idleft + "ShouhinMrCd").val("996");
        var gyou = idleft.slice(24); //fieldShukkairaiMeisaiDts0 左から20桁消す
        $("#" + idleft + "ShouhinMrCd").change();
        if (1 * gyou + 1 >= imax) {
            addShukkairaiMeisaiDt();
        }//新規行を追加しておく
    }
    denpyou_goukei_saikeisan(); // 総合計も変わる
});

$("[id$='Irisuu']").change(function () { //入数が変更されたら
    var idleft = $(this).attr("id").slice(0, -6); //fieldShukkairaiMeisaiDts0Irisuu 右から6桁消す
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
    var idleft = $(this).attr("id").slice(0, -8); //fieldShukkairaiMeisaiDts0Suuryou2 右から8桁消す
    var suu2 = $(this).val().replace(/,/g, '');//カンマ編集を一旦戻す
    var sh2 = $("#" + idleft + "Suu2Shousuu").val(); // 小数桁を揃える
    console.log(sh2);
    $(this).val(Intl.NumberFormat("ja-JP", {minimumFractionDigits: sh2, maximumFractionDigits: sh2}).format(suu2));//カンマ編集
    //suu1or2change(idleft); //2019/8/27
});

function suu1or2change(idleft) {
    // console.log('idleft = '+idleft);
    var jqleft = '#' + idleft;
    gyou_kingaku_saikeisan(idleft); // 行金額再計算
    denpyou_goukei_saikeisan(); // 伝票合計再計算
}

$("[id$='TankaKbn']").change(function () { //単価区分が変更されたら
    var idleft = $(this).attr("id").slice(0, -8); //fieldShukkairaiMeisaiDts0TankaKbn 右から8桁消す
    gyou_kingaku_saikeisan(idleft); // 行金額再計算
    denpyou_goukei_saikeisan(); // 伝票合計再計算
});

function gyou_kingaku_saikeisan(idleft) { // 行金額再計算
    var suufld = $("#" + idleft + "Suuryou" + $("#" + idleft + "TankaKbn").val());
    $("#" + idleft + "Genkagaku").val(Math.round(1000 * suufld.val().replace(/,/g, '')) * Math.round(1000 * $("#" + idleft + "Gentanka").val().replace(/,/g, '')) / 1000000); //評価額=数量*評価単価
    $('#' + idleft + 'TanniMr1Cd').change();
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

function denpyou_goukei_saikeisan() { // 伝票合計再計算
    for (i = 0; i < imax - 1; i++) {
        var tanka_kbn = $('#' + idleft + i + 'TankaKbn').val();
        var suufld = $('#' + idleft + i + 'Suuryou' + tanka_kbn);
        if (1 * $('#' + idleft + i + 'UtiwakeKbnCd').val() < 20) { // 通常、返品、値引き、諸経費のみ
            $('#' + idleft + i + 'Genkagaku').val(Math.round($('#' + idleft + i + 'Gentanka').val().replace(/,/g, '') * $('#' + idleft + i + 'Suuryou' + tanka_kbn).val().replace(/,/g, ''))); //四捨五入
        }
    }
}

$("[id$='ShouhinMrCd']").focusin(function (e) { //商品在庫索引
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
            $("#fieldShukkairaiMeisaiDts" + i + fieldx).removeAttr("readonly");
        }
    } else {
        $("#hidden" + fieldx).attr("readonly", "readonly");
        for (var i = 0; i < imax; i++) {
            $("#fieldShukkairaiMeisaiDts" + i + fieldx).attr("readonly", "readonly");
        }
    }
    $targetElm = $(targetElm);
}

var ro_fields = [
    'cd', 'iraibi', 'juchuu_dt_cd', 'hacchuu_dt_cd', 'shukkabi', 'nouki_memo', 'irai_kbn_cd',
    'hassousaki_kbn_cd', 'kidukesaki_mr_cd', 'assistant', 'tekiyou',
    '[cd', '[utiwake_kbn_cd', '[shukka_kbn_cd', '[shouhin_mr_cd', '[tekiyou', '[iro', '[iromei', '[lot', '[kobetucd', '[souko_mr_cd', '[hinsitu_kbn_cd', '[irisuu', '[suuryou1',
    '[tanni_mr1_cd', '[suuryou2', '[tanni_mr2_cd', '[shukkairaizan', '[tanka_kbn', '[gentanka', '[nouki', '[bikou'
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
            ro_field_name = 'data[shukkairai_meisai_dts][0]' + ro_fields[j] + ']';
            rewidths[ro_fields[j]] = $("[name='" + ro_field_name + "']").outerWidth();
        }
    }
    $.ajax({
        type: "POST",
        url: readonlys_ajaxSave,
        data: {
            'controller_cd': 'ShukkairaiDts',
            'gamen_cd': 'inputfields',
            'readonlys': readonlys,
            'rewidths': rewidths,
        },
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

function final_check() { // 最終チェック…F12登録を押したときにエラーがあれば戻る。onsubmit
    $("#F12").focus();
    $("#dispErrMsg").text("");                  // エラーメッセージクリア
    if (!final_souko_check()) return false;     // 依頼先チェック
    if (!final_tantou_check()) return false;    // 担当者チェック
    if (!final_meisaisuu_check()) return false; // 明細数チェック
    if (!final_meisai_check()) return false;    // 明細内チェック
    if (!final_shukkabi_check()) return false;	//出荷日チェック 2019/8/28
    return confirm("よろしいですか？");
}

function final_souko_check() {
    if (!($("#fieldSoukoMrCd").val())) {
        $("#dispErrMsg").text("依頼先を入力してください。");
        return false;
    }
    return true;
}

//入力チェック追加 2019/8/28
function final_shukkabi_check() {
    if (!isDate($("#fieldShukkabi").val())) {
        $("#dispErrMsg").text("出荷日の入力が正しくありません。");
        return false;
    }
    return true;
}

//日付妥当性チェック 2019/8/28
function isDate(strDate) {
    if (strDate === "") {
        return false;
    }
    return strDate.match(/^(\d{4})-(0[1-9]|1[0-2])-(0[1-9]|[12][0-9]|3[01])$/);
}

function final_tantou_check() {
    if (!($("#fieldTantouMrCd").val())) {
        $("#dispErrMsg").text("担当者を入力してください。");
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

function final_meisai_check() {
    for (var i = 0; i < (imax - 1); i++) {
        $(jqmeisaif + i + "Lot").val($(jqmeisaif + i + "Lot").val().trim()); // 空白除去
        $(jqmeisaif + i + "Iro").val($(jqmeisaif + i + "Iro").val().trim()); // 空白除去
        $(jqmeisaif + i + "Iromei").val($(jqmeisaif + i + "Iromei").val().trim()); // 空白除去
        $(jqmeisaif + i + "Kobetucd").val($(jqmeisaif + i + "Kobetucd").val().trim()); // 空白除去
        if (!$(jqmeisaif + i + "Cd").val() || $(jqmeisaif + i + "Cd").val() == 0) {
            //console.log('cd:' + $(jqmeisaif + i + "Cd").val());
            continue;
        }
        if (!($(jqmeisaif + i + "UtiwakeKbnCd").val())) {
            $("#dispErrMsg").text("" + (1 + i) + "行目の内訳区分を入力してください。");
            return false;
        }
        if (!($(jqmeisaif + i + "SoukoMrCd").val()) && $(jqmeisaif + i + "UtiwakeKbnCd").val() < 40) {
            $("#dispErrMsg").text("" + (1 + i) + "行目の倉庫を入力してください。");
            return false;
        }
        if (!($(jqmeisaif + i + "HinsituKbnCd").val()) && $(jqmeisaif + i + "UtiwakeKbnCd").val() < 40) {
            $("#dispErrMsg").text("" + (1 + i) + "行目の品質を入力してください。");
            return false;
        }
        if ((!($(jqmeisaif + i + "TanniMr1Cd").val()) || !($(jqmeisaif + i + "TanniMr2Cd").val())) && $(jqmeisaif + i + "UtiwakeKbnCd").val() < 40) {
            $("#dispErrMsg").text("" + (1 + i) + "行目の単位を入力してください。");
            return false;
        }
        if ($(jqmeisaif + i + "TanniMr1Cd").val() == $(jqmeisaif + i + "TanniMr2Cd").val() && $(jqmeisaif + i + "UtiwakeKbnCd").val() < 40) {
            $("#dispErrMsg").text("" + (1 + i) + "行目の単位1と2は別の単位を入力してください。");
            return false;
        }
    }
    return true;
}


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
