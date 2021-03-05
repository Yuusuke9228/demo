function addShiireMeisaiDt()
{ // alert(imax);
    tr_id = '#tr_shiire_meisai_dt_' + imax;
    id_head = 'fieldShiireMeisaiDts' + imax;
    name_head = 'data[shiire_meisai_dts][' + imax + ']';
    $("#tr_shiire_meisai_dt_hidden").clone(true).attr('id', 'tr_shiire_meisai_dt_' + imax).removeAttr('style').insertAfter('#tr_shiire_meisai_dt_' + ((imax > 0) ? imax - 1 : 'hidden'));
    $(tr_id + " #hiddenCd").attr('id', id_head + 'Cd').attr('name', name_head + '[cd]');
    $(tr_id + " #hiddenId").attr('id', id_head + 'Id').attr('name', name_head + '[id]');
    $(tr_id + " #hiddenUpdated").attr('id', id_head + 'Updated').attr('name', name_head + '[updated]');
    $(tr_id + " #hiddenZeinukigaku").attr('id', id_head + 'Zeinukigaku').attr('name', name_head + '[zeinukigaku]');
    $(tr_id + " #hiddenZeigaku").attr('id', id_head + 'Zeigaku').attr('name', name_head + '[zeigaku]');
    $(tr_id + " #hiddenUtiwakeKbnCd").attr('id', id_head + 'UtiwakeKbnCd').attr('name', name_head + '[utiwake_kbn_cd]');
    $(tr_id + " #hiddenKousei").attr('id', id_head + 'Kousei').attr('name', name_head + '[kousei]');
    $(tr_id + " #hiddenNyuukaKbnCd").attr('id', id_head + 'NyuukaKbnCd').attr('name', name_head + '[nyuuka_kbn_cd]');
    $(tr_id + " #hiddenShouhinMrCd").attr('id', id_head + 'ShouhinMrCd').attr('name', name_head + '[shouhin_mr_cd]');
    $(tr_id + " #hiddenTanniMr1Cd").attr('id', id_head + 'TanniMr1Cd').attr('name', name_head + '[tanni_mr1_cd]');
    $(tr_id + " #hiddenTanniMr2Cd").attr('id', id_head + 'TanniMr2Cd').attr('name', name_head + '[tanni_mr2_cd]');
    $(tr_id + " #hiddenTankaKbn").attr('id', id_head + 'TankaKbn').attr('name', name_head + '[tanka_kbn]');
    $(tr_id + " #hiddenZaikoKbn").attr('id', id_head + 'ZaikoKbn').attr('name', name_head + '[zaiko_kbn]');
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
    $(tr_id + " #hiddenSuuryou2").attr('id', id_head + 'Suuryou2').attr('name', name_head + '[suuryou2]');
    $(tr_id + " #hiddenHacchuuzan").attr('id', id_head + 'Hacchuuzan').attr('name', name_head + '[hacchuuzan]');
    $(tr_id + " #hiddenMotoTanniMr2Cd").attr('id', id_head + 'MotoTanniMr2Cd').attr('name', name_head + '[moto_tanni_mr2_cd]');
    $(tr_id + " #hiddenSuuShousuu").attr('id', id_head + 'SuuShousuu').attr('name', name_head + '[suu_shousuu]');
    $(tr_id + " #hiddenSuu1Shousuu").attr('id', id_head + 'Suu1Shousuu').attr('name', name_head + '[suu1_shousuu]');
    $(tr_id + " #hiddenSuu2Shousuu").attr('id', id_head + 'Suu2Shousuu').attr('name', name_head + '[suu2_shousuu]');
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
    imax++; //alert($("#"+id_head+'Id').val());
    $("#" + id_head + 'KazeiKbnCd').val(1); // 初期値を課税とする。
    //Add By Nishiyama 2019/2/18 倉庫初期値
    if ($("#" + id_head + 'HinsituKbnCd').val() !== '')
    {
        $("#" + id_head + 'SoukoMrCd').val('0000');
    } else
    {
        $("#" + id_head + 'SoukoMrCd').val('');
    }
    $targetElm = $(targetElm);
}

window.onload = function ()
{
    tbl_new_width = 0;
    $('#meisaiTable thead tr th').each(function (i)
    {
        tbl_new_width += 1 + $(this).width();
    });
    $('#meisaiTable').css({ width: tbl_new_width + 'px' });
    addShiireMeisaiDt();
    $('#ShouhinMrsOptions').append('<option value="' + $("#fieldShiireMeisaiDts0ShouhinMrCd").val() + '">' + $("#fieldShiireMeisaiDts0ShouhinMrCd").val() + ':' + $("#fieldShiireMeisaiDts0Tekiyou").val() + '</option>');

    //2019/1/23 元の税率等を保持するため
    if ($('#id').val() == '')
    {
        $('#fieldShiirebi').change();   //2019/10/1
        //古い発注から転写した場合、税率が8%になるので税区分を最新の物にする 2020-02-27
        if (imax !== 1)
        {
            for (let i = 0; i < imax; i++)
            {
                if ($('#fieldShiireMeisaiDts' + i + 'UtiwakeKbnCd').val() === '10')
                {
                    $('#fieldShiireMeisaiDts' + i + 'UtiwakeKbnCd').change();
                }
            }
        }
    }

    if ($('#fieldShimekiriStatus').val(''))
    {
        if ($('#fieldShiirebi').val() <= $("#fieldSimezumibi").val())
        {
            $('#fieldShimekiriStatus').val('締切済み');
            $('#fieldShimekiriStatus').css({ 'color': 'blue', 'text-align': 'center' });
        } else
        {
            $('#fieldShimekiriStatus').val('未締切');
            $('#fieldShimekiriStatus').css({ 'color': 'red', 'text-align': 'center' });
        }
    }
    zeiritu_kettei_imax(); // 税抜額なども再計算する
    denpyou_goukei_saikeisan(); // 伝票合計再計算（税抜額などをControllerから送り込んであるならこちらが良い）税額1円間違い多いので注釈外す2019/3/26井浦
    addForm1(); // モーダル呼出post用フォームを追加
}

function addForm1()
{ // モーダル呼出post用フォームを追加
    var form1 = $('<form></form>', {
        id: 'form1',
        action: '' + den_modal,
        target: 'iframe1',
        method: 'POST',
        name: 'iframe1form'
    }).hide();
    $('body').append(form1);
    form1.append($('<input>', { type: 'hidden', name: 'sakusei_user_id', value: my_id }));
    form1.append($('<input>', { type: 'hidden', name: 'denpyou_mr_cd', value: 'shiire' }));
}

$('#END').click(function ()
{ //エンドキー(END)を押したら
    var index = $targetElm.index($("#" + lastfocusin));//alert(index);
    var thisname = $("#" + lastfocusin).attr('name');
    var partsname = thisname.split(/[\[|\]]+/);// '['か']'かその連続にマッチする文字で分割する。例：data[shiire_meisai_dts][0][shouhin_mr_cd]は、['data','shiire_meisai_dts','0','shouhin_mr_cd','']となる。
    var findend = '[shouhin_mr_cd]';
    if (imax > 1 && partsname.length == 5)
    {
        findend = '[' + partsname[3] + ']';
    }
    var findlen = -findend.length;
    index = $targetElm.index($("#fieldShiireMeisaiDts" + (imax - 1) + "Cd")) - 1;
    for (i = index + 1; i <= $targetElm.length && (!$targetElm.eq(i).isVisible() || typeof ($targetElm.eq(i).attr("id")) == "undefined" || $targetElm.eq(i).attr("name").substr(findlen) != findend); i++)
    {
    }
    if (i <= $targetElm.length)
    {
        index = i;
    }
    $targetElm.eq(index).focus().select();
});

$('#PgUp').click(function ()
{ //ページアップキー(Ctrl+Shift+Enter)を押したら
    var index = $targetElm.index($("#" + lastfocusin));//alert(index);
    var thisname = $("#" + lastfocusin).attr('name');
    var partsname = thisname.split(/[\[|\]]+/);// '['か']'かその連続にマッチする文字で分割する。例：data[shiire_meisai_dts][0][shouhin_mr_cd]は、['data','shiire_meisai_dts','0','shouhin_mr_cd','']となる。
    var findend = '[shouhin_mr_cd]';
    if (imax > 1 && partsname.length == 5)
    {
        findend = '[' + partsname[3] + ']';
    }
    var findlen = -findend.length;
    for (i = index - 1; i >= 0 && (!$targetElm.eq(i).isVisible() || typeof ($targetElm.eq(i).attr("id")) == "undefined" || $targetElm.eq(i).attr("name").substr(findlen) != findend); i--)
    {
    }
    if (i >= 0)
    {
        index = i;
    }
    $targetElm.eq(index).focus().select();
});

var cpyary = [
    'Zeinukigaku', 'Zeigaku', 'UtiwakeKbnCd', 'NyuukaKbnCd', 'ShouhinMrCd', 'TanniMr1Cd', 'TanniMr2Cd', 'TankaKbn', 'ZaikoKbn', 'Irisuu', 'Suuryou1', 'Tekiyou',
    'Iro', 'Iromei', 'Lot', 'Kobetucd', 'HinsituKbnCd', 'SoukoMrCd', 'Suuryou2', 'MotoTanniMr2Cd', 'SuuShousuu', 'Suu1Shousuu', 'Suu2Shousuu', 'TankaShousuu', 'Gentanka', 'Tanka', 'Kingaku', 'Genkagaku',
    'ProjectMrCd', 'ZeirituMrCd', 'KazeiKbnCd', 'Bikou'
];
$('#PgDn').click(function ()
{ //ページダウンキー(Ctrl+Enter)を押したら
    var index = $targetElm.index($("#" + lastfocusin));//alert(index);
    var thisname = $("#" + lastfocusin).attr('name');
    var partsname = thisname.split(/[\[|\]]+/);// '['か']'かその連続にマッチする文字で分割する。例：data[shiire_meisai_dts][0][shouhin_mr_cd]は、['data','shiire_meisai_dts','0','shouhin_mr_cd','']となる。
    var findend = '[shouhin_mr_cd]';
    if (imax > 1 && partsname.length == 5)
    {
        findend = '[' + partsname[3] + ']';
        if (1 * partsname[2] + 1 == imax)
        {
            for (var i in cpyary)
            {
                if (!$("#" + lastfocusin).val() || 'fieldShiireMeisaiDts' + partsname[2] + cpyary[i] != lastfocusin)
                {
                    $('#fieldShiireMeisaiDts' + partsname[2] + cpyary[i]).val($('#fieldShiireMeisaiDts' + (1 * partsname[2] - 1) + cpyary[i]).val());
                }
            }
            $("#fieldShiireMeisaiDts" + partsname[2] + "Suuryou" + $("#fieldShiireMeisaiDts" + partsname[2] + "TankaKbn").val()).change();
            $("#fieldShiireMeisaiDts" + partsname[2] + "TanniMr1Cd").change();
            addShiireMeisaiDt();//新規行を追加
        }
    }
    var findlen = -findend.length;
    for (i = index + 1; i <= $targetElm.length && (!$targetElm.eq(i).isVisible() || typeof ($targetElm.eq(i).attr("id")) == "undefined" || $targetElm.eq(i).attr("name").substr(findlen) != findend); i++)
    {
    }
    if (i <= $targetElm.length)
    {
        index = i;
    }
    $targetElm.eq(index).focus().select();
});

$('#fieldCd').change(function ()
{ //仕入伝票索引
    //	alert($(this).val()); //''の場合、'0'など1桁の場合または結果が複数の場合、結果が1個の場合、結果が0個の場合
    if ($(this).val() != '')
    {
        $.ajax({
            type: "POST",
            url: shiire_dts_ajaxGet,
            data: { 'cd': $(this).val(), },
            async: true,
            dataType: 'json',
            success: function (data)
            {
                if (data.length >= 1 && $('#fieldCd').val() === data[0].cd)
                {
                    location.href = shiire_dts_edit + data[0].id;
                } else
                {
                    $('#fieldCd').focus().select();
                }
            },
            error: function (xhr, status, err)
            {
                alert('エラー Cd.change.ajax ' + status + '/' + err);
            },
        });
    }
});

$('#fieldHacchuuDtCd').change(function ()
{ //発注伝票の索引
    //	alert("AAA:"+$(this).attr("id")); //''の場合、'0'など1桁の場合または結果が複数の場合、結果が1個の場合、結果が0個の場合
    if ($(this).val() === '')
    {
        $('#fieldHacchuuDtId').val('');
    } else
    {
        $.ajax({
            type: "POST",
            url: hacchuu_dts_ajaxGet,
            data: { 'cd': $(this).val(), },
            async: true,
            dataType: 'json',
            success: function (data)
            {
                if (data.length == 0)
                {
                    alert('>>元発注エラー:未登録');
                } else if (data.length == 1 || $("#fieldHacchuuDtCd").val() === data[0].cd)
                {
                    //選択肢をクリアしてから追加する
                    $('#HacchuuDtsOptions > option').remove();
                    for (var i = 0; i < data.length; i++)
                    {
                        $('#HacchuuDtsOptions').append('<option value="' + data[i].cd + '">' + data[i].cd + ':' + data[i]["meisai"][1].tekiyou + '</option>');
                    }
                    $('#fieldHacchuuDtCd').val(data[0].cd);
                    $('#fieldHacchuuDtId').val(data[0].id);
                    if (data[0].zeiritu_tekiyoubi == '0000-00-00')
                    {
                        $('#fieldZeirituTekiyoubi').val('');
                    } else
                    {
                        $('#fieldZeirituTekiyoubi').val(data[0].zeiritu_tekiyoubi);
                    }
                    $('#fieldJuchuuDtCd').val(data[0].juchuu_dt_cd);
                    $('#fieldShiiresakiMrCd').val(data[0].shiiresaki_mr_cd);
                    $('#fieldShiiresakiMrCd').change();
                    $('#fieldTorihikiKbnCd').val(data[0].torihiki_kbn_cd);
                    $('#fieldZeiTenkaKbnCd').val(data[0].zei_tenka_kbn_cd);
                    $('#fieldTantouMrCd').val(data[0].tantou_mr_cd);
                    $('#fieldTekiyou').val(data[0].tekiyou);
                    i = 0;
                    for (m_cd in data[0]["meisai"])
                    {
                        if (data[0]["meisai"][m_cd].utiwake_kbn_cd != 30)
                        { // 内部積算は除く
                            if (i >= imax)
                            { //新規行を追加
                                addShiireMeisaiDt();
                            }
                            $('#fieldShiireMeisaiDts' + i + 'UtiwakeKbnCd').val(data[0]["meisai"][m_cd].utiwake_kbn_cd); // 内訳区分
                            $('#fieldShiireMeisaiDts' + i + 'Kousei').val(data[0]["meisai"][m_cd].kousei); // 構造
                            $('#fieldShiireMeisaiDts' + i + 'ShouhinMrCd').val(data[0]["meisai"][m_cd].shouhin_mr_cd);
                            $('#fieldShiireMeisaiDts' + i + 'Tekiyou').val(data[0]["meisai"][m_cd].tekiyou);
                            $('#fieldShiireMeisaiDts' + i + 'Iro').val(data[0]["meisai"][m_cd].iro);
                            $('#fieldShiireMeisaiDts' + i + 'Iromei').val(data[0]["meisai"][m_cd].iromei);
                            $('#fieldShiireMeisaiDts' + i + 'Lot').val(data[0]["meisai"][m_cd].lot);
                            $('#fieldShiireMeisaiDts' + i + 'Kobetucd').val(data[0]["meisai"][m_cd].kobetucd);
                            $('#fieldShiireMeisaiDts' + i + 'SoukoMrCd').val(data[0]["meisai"][m_cd].souko_mr_cd);
                            $('#fieldShiireMeisaiDts' + i + 'HinsituKbnCd').val(data[0]["meisai"][m_cd].hinsitu_kbn_cd);
                            $('#fieldShiireMeisaiDts' + i + 'Suuryou').val(data[0]["meisai"][m_cd].suuryou);
                            $('#fieldShiireMeisaiDts' + i + 'Keisu').val(data[0]["meisai"][m_cd].keisu);
                            $('#fieldShiireMeisaiDts' + i + 'Irisuu').val(data[0]["meisai"][m_cd].irisuu);
                            var sh1 = data[0]["meisai"][m_cd].suu1_shousuu;
                            var sh2 = data[0]["meisai"][m_cd].suu2_shousuu;
                            $('#fieldShiireMeisaiDts' + i + 'Suuryou1').val(Intl.NumberFormat("ja-JP", {
                                minimumFractionDigits: sh1,
                                maximumFractionDigits: sh1
                            }).format(data[0]["meisai"][m_cd].suuryou1));
                            $('#fieldShiireMeisaiDts' + i + 'TanniMr1Cd').val(data[0]["meisai"][m_cd].tanni_mr1_cd);
                            $('#fieldShiireMeisaiDts' + i + 'TanniMr2Cd').val(data[0]["meisai"][m_cd].tanni_mr2_cd);
                            $('#fieldShiireMeisaiDts' + i + 'Suuryou2').val(Intl.NumberFormat("ja-JP", {
                                minimumFractionDigits: sh2,
                                maximumFractionDigits: sh2
                            }).format(data[0]["meisai"][m_cd].suuryou2));
                            $('#fieldShiireMeisaiDts' + i + 'SuuShousuu').val(data[0]["meisai"][m_cd].suu_shousuu);
                            $('#fieldShiireMeisaiDts' + i + 'Suu1Shousuu').val(sh1);
                            $('#fieldShiireMeisaiDts' + i + 'Suu2Shousuu').val(sh2);
                            $('#fieldShiireMeisaiDts' + i + 'TankaShousuu').val(data[0]["meisai"][m_cd].tanka_shousuu);
                            $('#fieldShiireMeisaiDts' + i + 'MotoTanniMr2Cd').val(data[0]["meisai"][m_cd].moto_tanni_mr2_cd);
                            $('#fieldShiireMeisaiDts' + i + 'TankaKbn').val(data[0]["meisai"][m_cd].tanka_kbn);
                            $('#fieldShiireMeisaiDts' + i + 'ZaikoKbn').val(data[0]["meisai"][m_cd].zaiko_kbn);
                            $('#fieldShiireMeisaiDts' + i + 'Gentanka').val(data[0]["meisai"][m_cd].gentanka);
                            $('#fieldShiireMeisaiDts' + i + 'Tanka').val(data[0]["meisai"][m_cd].tanka);
                            $('#fieldShiireMeisaiDts' + i + 'Kingaku').val(data[0]["meisai"][m_cd].kingaku);
                            $('#fieldShiireMeisaiDts' + i + 'Genkagaku').val(data[0]["meisai"][m_cd].genkagaku);
                            $('#fieldShiireMeisaiDts' + i + 'Bikou').val(data[0]["meisai"][m_cd].bikou);
                            $('#fieldShiireMeisaiDts' + i + 'ZeirituMrCd').val(data[0]["meisai"][m_cd].zeiritu_mr_cd);
                            $('#fieldShiireMeisaiDts' + i + 'KazeiKbnCd').val(data[0]["meisai"][m_cd].kazei_kbn_cd);
                            gyou_kingaku_saikeisan("fieldShiireMeisaiDts" + i); // 行金額再計算
                            i++;
                        }
                    }
                    $('#ShouhinMrsOptions > option').remove();
                    $('#ShouhinMrsOptions').append('<option value="' + data[0]["meisai"][1].shouhin_mr_cd + '">' + data[0]["meisai"][1].shouhin_mr_cd + ':' + data[0]["meisai"][1].tekiyou + '</option>');
                    if (i >= imax)
                    {
                        addShiireMeisaiDt();
                    }//新規行を追加しておく
                    denpyou_goukei_saikeisan(); // 伝票合計再計算
                } else
                {
                    //選択肢をクリアしてから追加する
                    $('#HacchuuDtsOptions > option').remove();
                    for (var i = 0; i < data.length; i++)
                    {
                        $('#HacchuuDtsOptions').append('<option value="' + data[i].cd + '">' + data[i].cd + ':' + data[i]["meisai"][1].tekiyou + '</option>');
                    }
                    alert('>>元発注エラー:未登録');
                    $("#fieldHacchuuDtId").focus().select();
                }
            },
            error: function (xhr, status, err)
            {
                $("#fieldTekiyou").val('>元発注エラー' + status + '/' + err);
            },
        });
    }
});

$('#fieldJuchuuDtCd').change(function ()
{ //受注伝票の索引
    //alert("AAA:".$(this).attr("id")); //''の場合、'0'など1桁の場合または結果が複数の場合、結果が1個の場合、結果が0個の場合
    if ($(this).val() == '')
    {
    } else
    {
        $.ajax({
            type: "POST",
            url: juchuu_dts_ajaxGet,
            data: { 'cd': $(this).val(), },
            async: true,
            dataType: 'json',
            success: function (data)
            {
                if (data.length == 0)
                {
                    alert('>>元受注エラー:未登録');
                } else if (data.length == 1 || $("#fieldJuchuuDtCd").val() === data[0].cd)
                {
                    //選択肢をクリアしてから追加する
                    $('#JuchuuDtsOptions > option').remove();
                    for (var i = 0; i < data.length; i++)
                    {
                        $('#JuchuuDtsOptions').append('<option value="' + data[i].cd + '">' + data[i].cd + ':' + data[i]["meisai"][1].tekiyou + '</option>');
                    }
                    //商品コードの選択肢をクリアしてから追加する
                    $('#ShouhinMrsOptions > option').remove();
                    var i = 0;
                    var jqleft = '#fieldShiireMeisaiDts';
                    for (m_cd in data[0]["meisai"])
                    {
                        if (data[0]["meisai"][m_cd].utiwake_kbn_cd == '21')
                        {
                            //  $('#ShouhinMrsOptions').append('<option value="' + data[0]["meisai"][m_cd].shouhin_mr_cd + '">' + data[0]["meisai"][m_cd].shouhin_mr_cd + ':' + data[0]["meisai"][m_cd].tekiyou + '</option>');
                            if (i >= imax)
                            { //新規行を追加
                                addShiireMeisaiDt();
                            }
                            $(jqleft + i + 'UtiwakeKbnCd').val(22); // 内訳区分:22=支給受入
                            $(jqleft + i + 'Kousei').val(''); // 構造
                            $(jqleft + i + 'ShouhinMrCd').val(data[0]["meisai"][m_cd].shouhin_mr_cd);
                            $(jqleft + i + 'Tekiyou').val(data[0]["meisai"][m_cd].tekiyou);
                            $(jqleft + i + 'Iro').val(data[0]["meisai"][m_cd].iro);
                            $(jqleft + i + 'Iromei').val(data[0]["meisai"][m_cd].iromei);
                            $(jqleft + i + 'Lot').val(data[0]["meisai"][m_cd].lot);
                            $(jqleft + i + 'Kobetucd').val(data[0]["meisai"][m_cd].kobetucd);
                            $(jqleft + i + 'SoukoMrCd').val(data[0]["meisai"][m_cd].souko_mr_cd);
                            $(jqleft + i + 'HinsituKbnCd').val(data[0]["meisai"][m_cd].hinsitu_kbn_cd);
                            $(jqleft + i + 'Suuryou').val(data[0]["meisai"][m_cd].suuryou);
                            $(jqleft + i + 'Keisu').val(data[0]["meisai"][m_cd].keisu);
                            $(jqleft + i + 'Irisuu').val(data[0]["meisai"][m_cd].irisuu);
                            var sh1 = data[0]["meisai"][m_cd].suu1_shousuu;
                            var sh2 = data[0]["meisai"][m_cd].suu2_shousuu;
                            $(jqleft + i + 'Suuryou1').val(Intl.NumberFormat("ja-JP", {
                                minimumFractionDigits: sh1,
                                maximumFractionDigits: sh1
                            }).format(data[0]["meisai"][m_cd].suuryou1));
                            $(jqleft + i + 'TanniMr1Cd').val(data[0]["meisai"][m_cd].tanni_mr1_cd);
                            $(jqleft + i + 'TanniMr2Cd').val(data[0]["meisai"][m_cd].tanni_mr2_cd);
                            $(jqleft + i + 'Suuryou2').val(Intl.NumberFormat("ja-JP", {
                                minimumFractionDigits: sh2,
                                maximumFractionDigits: sh2
                            }).format(data[0]["meisai"][m_cd].suuryou2));
                            $(jqleft + i + 'SuuShousuu').val(data[0]["meisai"][m_cd].suu_shousuu);
                            $(jqleft + i + 'Suu1Shousuu').val(sh1);
                            $(jqleft + i + 'Suu2Shousuu').val(sh2);
                            $(jqleft + i + 'TankaShousuu').val(data[0]["meisai"][m_cd].tanka_shousuu);
                            $(jqleft + i + 'MotoTanniMr2Cd').val(data[0]["meisai"][m_cd].moto_tanni_mr2_cd);
                            $(jqleft + i + 'TankaKbn').val(data[0]["meisai"][m_cd].tanka_kbn);
                            $(jqleft + i + 'ZaikoKbn').val(data[0]["meisai"][m_cd].zaiko_kbn);
                            $(jqleft + i + 'Gentanka').val(0); // data[0]["meisai"][m_cd].gentanka);
                            $(jqleft + i + 'Tanka').val(0); // data[0]["meisai"][m_cd].tanka);
                            $(jqleft + i + 'Kingaku').val(0); // data[0]["meisai"][m_cd].kingaku);
                            $(jqleft + i + 'Zeinukigaku').val(0); // data[0]["meisai"][m_cd].kingaku);
                            $(jqleft + i + 'Zeigaku').val(0); // data[0]["meisai"][m_cd].kingaku);
                            $(jqleft + i + 'Genkagaku').val(0); //data[0]["meisai"][m_cd].genkagaku);
                            $(jqleft + i + 'Bikou').val(data[0]["meisai"][m_cd].bikou);
                            $(jqleft + i + 'ZeirituMrCd').val(90); // data[0]["meisai"][m_cd].zeiritu_mr_cd);
                            gyou_kingaku_saikeisan("fieldShiireMeisaiDts" + i); // 行金額再計算
                            i++;
                            if (i >= imax)
                            { //新規行を追加
                                addShiireMeisaiDt();
                            }
                        }
                    }
                    $('#fieldJuchuuDtCd').val(data[0].cd);
                    $('#fieldShiiresakiMrCd').val(data[0].shiiresaki_mr_cd);
                    // $('#rdonlyShiiresakiMrName').val(data[0].tokuisaki_mr_name);
                    $('#fieldTorihikiKbnCd').val(1);
                    $('#fieldZeiTenkaKbnCd').val(10);
                    $('#fieldTantouMrCd').val(data[0].tantou_mr_cd);
                    $("#fieldTekiyou").val(data[0].tekiyou);
                    $('#fieldShiiresakiMrCd').change();
                } else
                {
                    //選択肢をクリアしてから追加する
                    $('#JuchuuDtsOptions > option').remove();
                    for (var i = 0; i < data.length; i++)
                    {
                        $('#JuchuuDtsOptions').append('<option value="' + data[i].cd + '">' + data[i].cd + ':' + data[i]["meisai"][1].tekiyou + '</option>');
                    }
                    alert('>>元受注エラー:未登録');
                    $("#fieldJuchuuDtCd").focus().select();
                }
            },
            error: function (xhr, status, err)
            {
                $("#fieldShiireMeisaiDts0Tekiyou").val('>元受注エラー' + status + '/' + err);
            },
        });
    }
});

$('#fieldShiiresakiMrCd').change(function ()
{ //仕入先マスター索引
    //alert("AAA:".$(this).attr("id")); //''の場合、'0'など1桁の場合または結果が複数の場合、結果が1個の場合、結果が0個の場合
    if ($(this).val() == '')
    {
        $("#rdonlyShiiresakiMrName").val("");
    } else
    {
        $.ajax({
            type: "POST",
            url: shiiresaki_mrs_ajaxGet,
            data: { 'cd': $(this).val(), },
            async: true,
            dataType: 'json',
            success: function (data)
            {
                if (data.length == 0)
                {
                    alert('>>エラー:未登録');
                    $(this).focus().select();
                } else if (data.length == 1 || $("#fieldShiiresakiMrCd").val() === data[0].cd)
                {
                    $('#ShiiresakiMrsOptions > option').remove();
                    for (var i = 0; i < data.length; i++)
                    {
                        $('#ShiiresakiMrsOptions').append('<option value="' + data[i].cd + '">' + data[i].cd + ':' + data[i].name + '</option>');
                    }
                    $("#fieldShiiresakiMrCd").val(data[0].cd);
                    $("#rdonlyShiiresakiMrName").val(data[0].name);
                    $("#fieldTorihikiKbnCd").val(data[0].torihiki_kbn_cd);
                    $("#fieldZeiTenkaKbnCd").val(data[0].zei_tenka_kbn_cd);
                    $("#fieldTankaShuruiKbnName").val(data[0].tanka_shurui_kbn_name);
                    $("#fieldTankaShuruiKbnKoumokumei").val(data[0].tanka_shurui_kbn_koumokumei);
                    if ($("#fieldTantouMrCd").val() == "")
                    {
                        $("#fieldTantouMrCd").val(data[0].tantou_mr_cd);
                    }
                    $("#fieldKaikakeZandaka").val(Intl.NumberFormat("ja-JP", {
                        minimumFractionDigits: 0,
                        maximumFractionDigits: 0
                    }).format(data[0].kake_zandaka));//数値カンマ編集
                    $("#fieldShiiresakiMrYoshingendogaku").val(data[0].yoshin_gendogaku);
                    $("#gaku_hasuu_shori_kbn_cd").val(data[0].gaku_hasuu_shori_kbn_cd);
                    $("#zei_hasuu_shori_kbn_cd").val(data[0].zei_hasuu_shori_kbn_cd);
                    $("#fieldSimezumibi").val(data[0].simezumibi);
                    $('#fieldShiirebi').change();
                    $("#fieldTorihikiKbnCd").change();
                    zeiritu_kettei_imax(); // 税抜額なども再計算する。追加2019/4/9井浦
                    denpyou_goukei_saikeisan(); // 伝票合計再計算（税抜額などをControllerから送り込んであるならこちらが良い）税額1円間違い多いので注釈外す2019/3/26井浦
                } else
                {
                    //選択肢をクリアしてから追加する
                    $('#ShiiresakiMrsOptions > option').remove();
                    for (var i = 0; i < data.length; i++)
                    {
                        $('#ShiiresakiMrsOptions').append('<option value="' + data[i].cd + '">' + data[i].cd + ':' + data[i].name + '</option>');
                    }
                    alert('>>エラー:未登録');
                    $(this).focus().select();
                }
            },
            error: function (xhr, status, err)
            {
                $("#rdonlyShiiresakiMrName").val('>エラー' + status + '/' + err);
            },
        });
    }
});


$('#fieldShiirebi').change(function ()
{ // 仕入日付が変ったら
    if ($(this).val().length < 1)
    {
        return;
    }
    now = new Date();
    $(this).val($(this).val().replace('/', '-').replace('/', '-'));
    if ($(this).val().length <= 2)
    {
        $(this).val(now.getFullYear() + '-' + ('0' + (now.getMonth() + 1)).slice(-2) + '-' + ('0' + $(this).val()).slice(-2));
    } else if ($(this).val().length <= 5)
    {
        if ($(this).val().indexOf('-') == -1)
        {
            $(this).val($(this).val().slice(-4, -2) + '-' + $(this).val().slice(-2));
        }
        $(this).val(now.getFullYear() + '-' + $(this).val());
    } else
    {
        if ($(this).val().indexOf('-') == -1)
        {
            $(this).val($(this).val().slice(-8, -4) + '-' + $(this).val().slice(-4, -2) + '-' + $(this).val().slice(-2));
        }
        if ($(this).val().length == 8)
        {
            $(this).val('20' + $(this).val());
        }
    }
    var ymd = $(this).val().split('-');
    $(this).val(ymd[0] + '-' + ('0' + ymd[1]).slice(-2) + '-' + ('0' + ymd[2]).slice(-2));
    //税率税率を取得させる 西山 2019/9/30
    var idleft = $(this).attr("id").slice(0, -11);
    if (imax !== '1')
    {
        for (var i = 0; i < imax - 1; i++)
        {
            $("#" + idleft + i + 'ZeirituMrCd').val('');
        }
        zeiritu_kettei_imax();
    }
    if ($('#fieldShiirebi').val() <= $("#fieldSimezumibi").val())
    {
        $('#fieldShimekiriStatus').val('締切済み');
        $('#fieldShimekiriStatus').css({ 'color': 'blue', 'text-align': 'center' });
    } else
    {
        $('#fieldShimekiriStatus').val('未締切');
        $('#fieldShimekiriStatus').css({ 'color': 'red', 'text-align': 'center' });
    }
});

// 2021-01-09 追加
/**
 * 品質評価区分に応じたコストを取得
 */
$("[id$='HinsituKbnCd']").change(function ()
{
    const idleft = $(this).attr("id").slice(0, -12); //fieldShiireMeisaiDts0ShouhinMrCd 右から11桁消す
    const gyou = idleft.slice(20); //fieldShiireMeisaiDts0 左から20桁消す
    $.ajax({
        type: "post",
        url: ajaxCostGet,
        data: { 'hinsitu_kbn_cd': $(this).val(), 'shouhin_mr_cd': $('#' + idleft + 'ShouhinMrCd').val() },
        async: true,
        dataType: 'json',
        success: (data) =>
        {
            console.log(data);
            try
            {
                $('#' + idleft + 'Gentanka').val(data[0]['cost'])
                if ($('#' + idleft + 'UtiwakeKbnCd').val() === '10' || $('#' + idleft + 'UtiwakeKbnCd').val() === '11')
                {
                    $('#' + idleft + 'Tanka').val(data[0]['cost'])
                } else
                {
                    $('#' + idleft + 'Tanka').val(0)
                }
            } catch (e)
            {
                $('#' + idleft + 'Gentanka').val(0);
                $('#' + idleft + 'Tanka').val(0);
            }
            $('#' + idleft + 'Tanka').change();
        },
        error: (xhr, status, err) =>
        {
            console.log(status + '/' + err);
        }
    })
});

$("[id$='ShouhinMrCd']").dblclick(function ()
{ //商品マスター索引
    $(this).change();
});

$("[id$='ShouhinMrCd']").change(function ()
{ //商品マスター索引
    var idleft = $(this).attr("id").slice(0, -11); //fieldShiireMeisaiDts0ShouhinMrCd 右から11桁消す
    var gyou = idleft.slice(20); //fieldShiireMeisaiDts0 左から20桁消す
    if ($(this).val() == '')
    {
        $("#" + idleft + "Tekiyou").val("");
    } else
    {
        $.ajax({
            type: "POST",
            url: shouhin_mrs_ajaxGet,
            data: { 'cd': $(this).val(), },
            async: true,
            dataType: 'json',
            success: function (data)
            {
                if (data.length == 0)
                {
                    alert('>>エラー:未登録');
                    $(this).focus().select();
                } else if (data.length == 1 || $("#" + idleft + "ShouhinMrCd").val() === data[0].cd)
                {
                    //選択肢をクリアしてから追加する
                    $('#ShouhinMrsOptions > option').remove();
                    for (var i = 0; i < data.length; i++)
                    {
                        $('#ShouhinMrsOptions').append('<option value="' + data[i].cd + '">' + data[i].cd + ':' + data[i].name + '</option>');
                    }
                    $("#" + idleft + "ShouhinMrCd").val(data[0].cd);
                    $("#" + idleft + "Tekiyou").val(data[0].name);
                    $("#" + idleft + "TanniMr1Cd").val(data[0].tanni_mr1_cd);
                    $("#" + idleft + "TanniMr2Cd").val(data[0].tanni_mr2_cd);
                    $("#" + idleft + "MotoTanniMr2Cd").val(data[0].tanni_mr2_cd);
                    $("#" + idleft + "HinsituKbnCd").val(data[0].hinsitu_kbn_cd);
                    $("#" + idleft + "Irisuu").val(data[0].irisuu);
                    $("#" + idleft + "SoukoMrCd").val(data[0].shu_souko_mr_cd);
                    if ($("#" + idleft + "UtiwakeKbnCd").val() == '')
                    {
                        $("#" + idleft + "UtiwakeKbnCd").val('10');
                    }
                    if ('' + $("#" + idleft + "UtiwakeKbnCd").val() == '22')
                    {
                        $("#" + idleft + "Tanka").val(0);
                        $("#" + idleft + "Gentanka").val(0);
                        //                        $("#" + idleft + "KazeiKbnCd").val(3);
                    } else if ($("#" + idleft + "UtiwakeKbnCd").val() == '20')
                    { // 委託生産の製品は生産と同等なので
                        $("#" + idleft + "Gentanka").val(data[0]["shiire_tanka"]); // 評価単価を仕入単価
                        $("#" + idleft + "Tanka").val(0); // 買い単価は0
                        //                        $("#" + idleft + "KazeiKbnCd").val(3);
                    } else if ($("#" + idleft + "UtiwakeKbnCd").val() == '21')
                    { // 委託生産の原料は消費と同等なので
                        $("#" + idleft + "Gentanka").val(data[0]["shiire_tanka"]); // 評価単価を売上原価  2020-03-07 問題があるので、仕入単価を入れる様に変更　西山
                        $("#" + idleft + "Tanka").val(0); // 買い単価は0
                        //                        $("#" + idleft + "KazeiKbnCd").val(3);
                    } else
                    { // 他の通常・返品などは
                        //10通常の行にコスト入らなかったので変更 2019/8/5
                        //$("#" + idleft + "Gentanka").val(data[0][$("#fieldTankaShuruiKbnKoumokumei").val()]);//tanka_shurui_kbn_cdによって選ぶ
                        $("#" + idleft + "Gentanka").val(data[0]["shiire_tanka"]); // 評価単価を仕入単価
                        $("#" + idleft + "Tanka").val($("#" + idleft + "Gentanka").val()); // 同じ
                        $("#" + idleft + "KazeiKbnCd").val(data[0].kazei_kbn_cd);
                        if (data[0].kazei_kbn_cd == 2)
                        {
                            $("#" + idleft + "ZeirituMrCd").val('80');
                        }
                    }
                    $("#" + idleft + "TankaKbn").val(data[0].tanka_kbn);
                    $("#" + idleft + "ZaikoKbn").val(data[0].zaiko_kbn);
                    $("#" + idleft + "TankaShousuu").val(data[0].tanka_shousuu);
                    $("#" + idleft + "SuuShousuu").val(data[0].suu_shousuu);
                    $("#" + idleft + "Suu1Shousuu").val(data[0].suu1_shousuu);
                    $("#" + idleft + "Suu2Shousuu").val(data[0].suu2_shousuu);

                    zeiritu_kettei(idleft, true); //商品変更時バグるので応急処置(引数flg)
                    $("#" + idleft + "Tanka").change();
                    if (1 * gyou + 1 >= imax)
                    {
                        addShiireMeisaiDt();
                    }//新規行を追加しておく

                    try
                    {
                        var souko_cd = $("#" + idleft + +'SoukoMrCd').val();
                    } catch (e)
                    {
                        console.log('倉庫空白');
                    }

                    if (typeof souko_cd !== "undefined")
                    {
                        getZaiko(data[0].cd, souko_cd);
                    } else
                    {
                        try
                        {
                            getZaiko(data[0].cd, '');
                        } catch (e)
                        {
                            console.log(data[0].cd);
                        }
                    }
                } else
                {
                    //選択肢をクリアしてから追加する
                    $('#ShouhinMrsOptions > option').remove();
                    for (var i = 0; i < data.length; i++)
                    {
                        $('#ShouhinMrsOptions').append('<option value="' + data[i].cd + '">' + data[i].cd + ':' + data[i].name + '</option>');
                    }
                    $("#" + idleft + "Tekiyou").val('>>さらに選択してください。');
                    $(this).focus().select();
                }
            },
            error: function (xhr, status, err)
            {
                $("#" + idleft + "Tekiyou").val('>エラー' + status + '/' + err);
            },
        });
    }
});

// lot集計モーダル
$("[id$='Lot']").dblclick(function ()
{ //商品マスター索引 lot_summary_modal
    modalstart(lot_summary_modal, "ロット別在庫", "?cd=" + $('#' + lastfocusin.slice(0, -3) + "ShouhinMrCd").val().replace('+', '%2B'));
});

/* モーダルダイヤログ部分 */
function f8key()
{
    if (lastfocusin == "fieldCd")
    { /* 仕入伝票選択 */
        modalstart1(den_modal, "仕入伝票選択");
    } else if (lastfocusin == "fieldHacchuuDtCd")
    { /* 発注伝票選択 */
        modalstart(hacchuu_dts_modal, "発注伝票選択");
    } else if (lastfocusin == "fieldJuchuuDtCd")
    { /* 受注伝票選択 */
        modalstart(juchuu_dts_modal, "受注伝票選択");
    } else if (lastfocusin == "fieldShiiresakiMrCd")
    { /* 仕入先コード選択 */
        modalstart(shiiresaki_mrs_modal, "仕入先選択");
    } else if (lastfocusin.slice(-11) == "ShouhinMrCd")
    { /* 商品コード選択 */
        modalstart(shouhin_mrs_modal, "商品選択");
    } else if (lastfocusin.slice(-3) == "Lot")
    { /* ロット別在庫選択 */
        modalstart(lot_zaiko_modal, "ロット別在庫", "?cd=" + $('#' + lastfocusin.slice(0, -3) + "ShouhinMrCd").val().replace('+', '%2B'));
    } else if (lastfocusin.slice(-11) === 'ProjectMrCd')
    {
        modalstart(project_mrs_modal, "プロジェクト選択");
    } else if (lastfocusin.slice(-5) === "Tanka")
    {	/* 単価選択 Add By Nishiyama 2019/1/8/ */
        //商品コードをパラメータークエリへ投げる。
        let currntId = document.activeElement.id;
        let rowIndex = currntId.replace(/[^0-9^\.]/g, "");
        let rowId = '#fieldShiireMeisaiDts' + rowIndex + 'ShouhinMrCd';
        let product_code = $(rowId).val();
        let shiiresaki_code = $('#fieldShiiresakiMrCd').val();
        if (shiiresaki_code == '')
        {
            alert('仕入先を選択してください。');
            return;
        }
        modalstart(shiire_history, "仕入伝票単価履歴", "?cd=" + product_code.replace('+', '%2B') + "&shiiresaki=" + shiiresaki_code);
    } else if (lastfocusin.slice(-8) == "Kobetucd")
    { /* 個別在庫選択 */
        modalstart(kobetu_zaiko_modal, "個別在庫", "?cd=" + $('#' + lastfocusin.slice(0, -8) + "ShouhinMrCd").val().replace('+', '%2B'));
    } else if (lastfocusin == "fieldShiirebi")
    { /* 仕入日選択 */
        open_datepicker();
    } else if (lastfocusin == "fieldZeirituTekiyoubi")
    { /* 税率適用日選択 */
        open_datepicker();
    }
}

$('#fieldShiiresakiMrCd').focusout(function ()
{ /* 仕入先コード選択 */
    if ($('#fieldShiiresakiMrCd').val() == '')
    {
        modalstart(shiiresaki_mrs_modal, "仕入先選択");
        setTimeout(function ()
        {
            lastfocusin = "fieldShiiresakiMrCd";
        }, 1000); // 1秒後フォーカス設定し直し
    }
});

function open_datepicker()
{
    $('#' + lastfocusin).datepicker({
        dateFormat: 'yy-mm-dd',
        onSelect: function ()
        {
            $('#' + lastfocusin).focus();
        },
        onClose: function ()
        {
            $('#' + lastfocusin).datepicker('destroy');
        }
    });
    $('#' + lastfocusin).datepicker('show');
}

function modalstart(url, title, para)
{
    $('#iframe-title').text(title);
    $('#iframe-wrap').fadeIn();
    if (!para)
    {
        para = '?cd=' + $('#' + lastfocusin).val();
    }
    $('#iframe-body').html('<iframe src="' + url + para + '" width="100%" height="100%" style="border: none;">');
    $('#iframe-bg').fadeTo('normal', 0.5);
    $('#iframe-body iframe').load(function ()
    {
        $(this).contents().find('#header, #footer').hide();
    });
    return false;
}

function modalstart1(url, title, para)
{
    $('#iframe-title').text(title);
    $('#iframe-wrap').fadeIn();
    if (!para)
    {
        para = '?cd=' + $('#' + lastfocusin).val();
    }
    $('#iframe-body').html('<iframe src="" width="100%" height="100%" style="border: none;" name="iframe1">');
    $('#iframe-bg').fadeTo('normal', 0.5);
    $('#iframe-body iframe').load(function ()
    {
        $(this).contents().find('#header, #footer').hide();
    });
    document.iframe1form.submit();
    return false;
}

$('#iframe-wrap button').click(function ()
{ /* 中止して終わる (X) */
    $('#iframe-bg, #iframe-wrap').fadeOut();
});

function fromModal(retval, retsouko = '', zaikosuu = '', iro = '', iromei = '', hinsitu_kbn_cd = '')
{
    //alert('親ページの関数が実行されました。');
    $('#iframe-wrap').fadeOut(
        function ()
        {//alert("フェードアウト完了")
            if (retval)
            {
                $('#' + lastfocusin).val(retval);
                $('#' + lastfocusin).change();
            }
            if (retsouko !== '')
            {
                var currntId = document.activeElement.id;
                var rowIndex = currntId.replace(/[^0-9^\.]/g, "");
                var souko_code = retsouko.toString();
                let rowId = '#fieldShiireMeisaiDts' + rowIndex + 'SoukoMrCd';
                $(rowId).val(souko_code);
            }
            //LOT在庫数量
            if (zaikosuu !== '')
            {
                let zaiko = parseFloat(zaikosuu);
                $("#fieldGenzaiko").val(zaiko);
            }
            //色番
            if (iro !== '')
            {
                let iroID = '#fieldShiireMeisaiDts' + rowIndex + 'Iro';
                $(iroID).val(iro);
            }
            //色名
            if (iromei !== '')
            {
                let iroName = '#fieldShiireMeisaiDts' + rowIndex + 'Iromei';
                $(iroName).val(iromei);
            }

            if (hinsitu_kbn_cd !== '')
            {
                let hinshitu = '#fieldShiireMeisaiDts' + rowIndex + 'HinsituKbnCd';
                $(hinshitu).val(hinsitu_kbn_cd);
                $(hinshitu + 'option[value=' + hinsitu_kbn_cd + ']').prop('selected', true);
            }

        }
    );
    $('#iframe-bg').fadeOut();
    $('#' + lastfocusin).focus().select();
}

function tenkai(only1)
{ // 単展開、全展開
    var idleft = 'fieldShiireMeisaiDts';
    var gyou = 0;
    if (lastfocusin == 'F7')
    {
        lastfocusin = lastfocusout;
    }
    if (lastfocusin.substr(0, 20) == idleft)
    {
        gyou = 1 * (lastfocusin.substr(20, 10).match(/^\d+/)); // alert(gyou); // 20桁目から連続した数字を得る正規表現
    }
    if ($("#" + idleft + gyou + "ShouhinMrCd").val() == '')
    {
        $("#" + idleft + gyou + "Tekiyou").val("ありません");
    } else
    {
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
            success: function (data)
            {
                if (data.length == 0)
                {
                    alert('>>エラー:構成部品未登録');
                    $("#" + idleft + gyou + "ShouhinMrCd").focus().select();
                } else
                {
                    if ($("#" + idleft + gyou + "UtiwakeKbnCd").val() == 20)
                    { // 1行目が委託加工生産
                        $("#" + idleft + gyou + "Tanka").val(0); // 買い単価は0
                        $("#" + idleft + gyou + "Kingaku").val(0); // 買い金額は0
                        $("#" + idleft + gyou + "Zeinukigaku").val(0); // 買い金額は0
                        $("#" + idleft + gyou + "Zeigaku").val(0); // 買い金額は0
                        $("#" + idleft + gyou + "ZeirituMrCd").val(90); // 税率対象外
                    }
                    $('#' + idleft + gyou + 'Kousei').val('-');
                    $('#' + idleft + gyou + 'Kousei').addClass('kousei_oya');
                    var i = 0;
                    for (i = 1; i - 1 < data.length; i++)
                    {
                        if (gyou + i >= imax)
                        { //新規行を追加
                            addShiireMeisaiDt();
                        }
                        $('#tr_shiire_meisai_dt_' + (i + gyou)).addClass('kodomo' + gyou);
                        $('#' + idleft + (gyou + i) + 'Kousei').val(data[i - 1].kousei);
                        $('#' + idleft + (gyou + i) + 'SuuShousuu').val(data[i - 1].gen_shouhin_mr.suu_shousuu);
                        $('#' + idleft + (gyou + i) + 'Suu1Shousuu').val(data[i - 1].gen_shouhin_mr.suu1_shousuu);
                        $('#' + idleft + (gyou + i) + 'Suu2Shousuu').val(data[i - 1].gen_shouhin_mr.suu2_shousuu);
                        $('#' + idleft + (gyou + i) + 'TankaShousuu').val(data[i - 1].gen_shouhin_mr.tanka_shousuu);
                        $('#' + idleft + (gyou + i) + 'ShouhinMrCd').val(data[i - 1].gen_shouhin_mr_cd);
                        $('#' + idleft + (gyou + i) + 'KazeiKbnCd').val(data[i - 1].gen_shouhin_mr.kazei_kbn_cd);
                        if ($("#" + idleft + gyou + "UtiwakeKbnCd").val() == 20)
                        { // 1行目が委託加工生産
                            if (data[i - 1].koutin_flg == 1)
                            {
                                $('#' + idleft + (gyou + i) + 'UtiwakeKbnCd').val(10); // 通常（発注）
                                $('#' + idleft + (gyou + i) + 'ZeirituMrCd').val(''); // 税対象外
                                zeiritu_kettei(idleft + (gyou + i)); // 税率決定
                            } else
                            {
                                $('#' + idleft + (gyou + i) + 'UtiwakeKbnCd').val(21); // 委託原料支給
                                $('#' + idleft + (gyou + i) + 'ZeirituMrCd').val(90); // 税対象外
                            }
                        } else
                        {
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
                        if ($('#' + idleft + (gyou + i) + "UtiwakeKbnCd").val() == '20')
                        { // 委託生産の製品は生産と同等なので
                            $('#' + idleft + (gyou + i) + "Gentanka").val(data[i - 1].gen_shouhin_mr.shiire_tanka); // 評価単価を仕入単価
                            $('#' + idleft + (gyou + i) + "Tanka").val(0); // 買い単価は0
                        } else if ($('#' + idleft + (gyou + i) + "UtiwakeKbnCd").val() == '21')
                        { // 委託生産の原料は消費と同等なので 2020-03-07 問題があるので、仕入単価を入れる様に変更　西山
                            $('#' + idleft + (gyou + i) + "Gentanka").val(data[i - 1].gen_shouhin_mr.shiire_tanka); // 評価単価を売上原価
                            $('#' + idleft + (gyou + i) + "Tanka").val(0); // 買い単価は0
                        } else
                        { // 他の通常・返品などは
                            //10通常の行にコスト入らなかったため、変更 2019/8/5
                            //$('#' + idleft + (gyou + i) + "Gentanka").val(data[i - 1].gen_shouhin_mr[$("#fieldTankaShuruiKbnKoumokumei").val()]);//tanka_shurui_kbn_cdによって選ぶ
                            $('#' + idleft + (gyou + i) + "Gentanka").val(data[i - 1].gen_shouhin_mr.shiire_tanka); // 評価単価を売上原価 2020-03-07 問題があるので、仕入単価を入れる様に変更　西山
                            $('#' + idleft + (gyou + i) + "Tanka").val($('#' + idleft + (gyou + i) + "Gentanka").val()); // 同じ
                        }
                        $('#' + idleft + (gyou + i) + "KazeiKbnCd").val(data[i - 1].gen_shouhin_mr.kazei_kbn_cd);
                        zeiritu_kettei(idleft + (gyou + i));
                        $('#' + idleft + (gyou + i) + "Tanka").change();
                        $('#' + idleft + (gyou + i) + 'Suuryou').change();
                    }
                    if (gyou + i >= imax)
                    {
                        addShiireMeisaiDt();
                    }//新規行を追加しておく
                }
            },
            error: function (xhr, status, err)
            {
                $("#" + idleft + gyou + "Tekiyou").val('>エラー' + status + '/' + err);
            },
        });

    }
};

$(document).on('click', '.kousei_oya', function ()
{
    var gyou = 1 * (lastfocusin.substr(21, 10).match(/^\d+/));
    if ($(this).val() == '-')
    {
        $("#meisaiTable tr[class='kodomo" + gyou + "']").hide();
        $(this).val('+');
    } else
    {
        $("#meisaiTable tr[class='kodomo" + gyou + "']").show();
        $(this).val('-');
    }
});

$(function ()
{ // モーダルウィンドウをドラッグで移動できる
    $("#iframe-wrap").draggable({
        handle: ".modal-header"
    });
});

/* 画面内計算 */
$("#fieldTorihikiKbnCd").change(function ()
{ //取引区分が変更されたら
    $("#fieldKaishuuYoteibi").attr('readonly', $(this).val() * 1 != 3); // 3:都度請求ならfalse
});

$("#fieldZeirituTekiyoubi").change(function ()
{ //税適用日が変更されたら
    for (var i = 0; i < imax - 1; i++)
    {
        $('#fieldShiireMeisaiDts' + i + 'ZeirituMrCd').val('');
    }
    zeiritu_kettei_imax();// 明細の課税区分を再設定する
});

$("#fieldZeiTenkaKbnCd").change(function ()
{ //税転嫁区分が変更されたら
    zeiritu_kettei_imax();// 明細の課税区分を再設定する
});

function zeiritu_kettei(idleft, flg = false)
{ //税率決定（行指定） //商品変更時バグるので応急処置(引数flg)
    //税率バグ修正 西山 2019/9/30
    if ($('#' + idleft + 'UtiwakeKbnCd').val() >= 20 && $('#' + idleft + 'UtiwakeKbnCd').val() <= 50)
    { // 加工支給預りメモ等は税率は外０
        $("#" + idleft + "ZeirituMrCd").children().remove(); //option消去
        $("#" + idleft + "ZeirituMrCd").append($("<option>").val("90").text("90=外0%"));
    } else if ($('#fieldZeiTenkaKbnCd').val() == '30')
    { //輸出なら
        $("#" + idleft + "ZeirituMrCd").children().remove(); //option消去
        $("#" + idleft + "ZeirituMrCd").append($("<option>").val("70").text("70=輸出"));
    } else
    {
        var kijunbi = $("#fieldShiirebi").val();
        if ($("#fieldZeirituTekiyoubi").val() != '' && $("#fieldKijunbi").val() != '0000-00-00')
        {
            kijunbi = $("#fieldZeirituTekiyoubi").val();
            //Add By Nishiyama 2019-10-29
            if (!check_date(kijunbi))
            {
                alert('指定税率日の日付形式が正しくない為、売上日を基準とします。');
                $("#fieldZeirituTekiyoubi").val('');
                kijunbi = $("#fieldShiirebi").val();
            }
        }
        var date_kijunbi = new Date(kijunbi.replace(/-/g, '/'));
        var selected_cd = '';
        selected_cd = $("#" + idleft + "ZeirituMrCd").val();
        var kazei_kbn_cd = $('#' + idleft + 'KazeiKbnCd').val();
        if ($("#" + idleft + "UtiwakeKbnCd").val() == '22')
        {
            kazei_kbn_cd = 3;
        } else if ($("#" + idleft + "UtiwakeKbnCd").val() == '20')
        { // 委託生産の製品は生産と同等なので
            kazei_kbn_cd = 3;
        } else if ($("#" + idleft + "UtiwakeKbnCd").val() == '21')
        { // 委託生産の原料は消費と同等なので
            kazei_kbn_cd = 3;
        }
        var select_cd = '';
        //税率バグ修正 西山 2019/9/30
        if (kazei_kbn_cd === '2')
        {
            $("#" + idleft + "ZeirituMrCd").val('80');
            $("#" + idleft + "ZeirituMrCd").append($("<option>").val("80").text("80=非0%"));
        } else
        {
            $("#" + idleft + "ZeirituMrCd").val('');
            $("#" + idleft + "ZeirituMrCd").children().remove();
        }
        const zeitekiyou_shuuryoubi = new Date('2019-09-30'); //バグ対策 8%の終了日
        for (var i in zeiritu_mrs)
        {
            if (zeiritu_mrs[i]['cd'] != '70')
            { //輸出以外を追加
                var date_mr_kijunbi = new Date(zeiritu_mrs[i]['kijunbi'].replace(/-/g, '/')); //基準日を日付オブジェクトに変換して
                $('#' + idleft + "ZeirituMrCd").append($("<option>").val(zeiritu_mrs[i]['cd']).text(zeiritu_mrs[i]['disp']));
                //商品変更時バグるので応急処置(引数flg)
                if (!flg)
                {
                    if (selected_cd == zeiritu_mrs[i]['cd'] && date_kijunbi >= date_mr_kijunbi)
                    {
                        select_cd = selected_cd;
                    }
                } else
                {
                    if (selected_cd == zeiritu_mrs[i]['cd'] && kazei_kbn_cd === zeiritu_mrs[i]['kazei_kbn_cd'])
                    {
                        select_cd = selected_cd;
                    }
                }

                if (select_cd == '' && zeiritu_mrs[i]['kazei_kbn_cd'] == kazei_kbn_cd && date_kijunbi >= date_mr_kijunbi)
                {
                    //該当がまだなく'' 課税区分が一致して 基準日を比較して満たしていれば選択する
                    select_cd = zeiritu_mrs[i]['cd'];
                }
            }
        }
        if (select_cd != '')
        {
            $('#' + idleft + "ZeirituMrCd").val(select_cd);
        }
    }
    gyou_kingaku_kanma(idleft); // 行金額端数処理カンマ編集
    $('#' + idleft + 'TanniMr1Cd').change();
}

/*
 * 日付の妥当性のチェック Add By Nishiyama 2019-10-29
 */
function check_date(s)
{
    if (typeof s == "string")
    {
        if (s.match(/^(\d+)\/(\d+)\/(\d+)$/))
        {
            return true
        } else if (s.match(/^(\d+)-(\d+)-(\d+)$/))
        {
            return true
        }
    }
    return false;
}

function zeiritu_kettei_imax()
{
    for (var i = 0; i < imax - 1; i++)
    {
        zeiritu_kettei("fieldShiireMeisaiDts" + i);
    }
    denpyou_goukei_saikeisan(); // 伝票合計再計算
}

$("[id$='Cd']").change(function ()
{ //行番号が変更されたら
    var idleft = $(this).attr("id").slice(0, -2); //fieldShiireMeisaiDts0Cd 右から2桁消す
    if (idleft.length < 26 && idleft.slice(0, 20) == 'fieldShiireMeisaiDts')
    {
        var jqleft = '#' + idleft;
        if ($(this).val() == 0)
        { // 行番号＝０なら数量０金額０
            //	console.log($(jqleft + "Suuryou2").val());
            $(jqleft + "Suuryou1").val(0);
            $(jqleft + "Suuryou2").val(0);
            suu1or2change(idleft); // 行金額再計算
        }
    }
});

$("[id$='UtiwakeKbnCd']").change(function ()
{ //内訳区分が変更されたら
    var idleft = $(this).attr("id").slice(0, -12); //fieldShiireMeisaiDts0UtiwakeKbnCd 右から12桁消す
    $('#' + idleft + 'ZeirituMrCd').val('');
    zeiritu_kettei(idleft);
    $("#" + idleft + "Suuryou2").change();
});

$("[id$='Suuryou']").change(function ()
{ //元数量が変更されたら
    var idleft = $(this).attr("id").slice(0, -7); //fieldShiireMeisaiDts0Suuryou 右から7桁消す
    suu_keisu_change(idleft);
    $("#" + idleft + "Suuryou2").change();
});

$("[id$='Keisu']").change(function ()
{ //係数が変更されたら
    var idleft = $(this).attr("id").slice(0, -5); //fieldShiireMeisaiDts0Keisu 右から5桁消す
    suu_keisu_change(idleft);
    $("#" + idleft + "Suuryou2").change();
});

function suu_keisu_change(idleft)
{ //元数量か係数が変更された時の共通処理
    if (1 * $("#" + idleft + "Keisu").val() !== 0 && 1 * $("#" + idleft + "Suuryou").val().replace(/,/g, '') !== 0)
    {
        var suufld = $("#" + idleft + "Suuryou" + $("#" + idleft + "ZaikoKbn").val());
        suufld.val(1 * $("#" + idleft + "Keisu").val().replace(/,/g, '') * $("#" + idleft + "Suuryou").val().replace(/,/g, ''));
        if (1 * $("#" + idleft + "Irisuu").val().replace(/,/g, '') !== 0)
        {
            if ($("#" + idleft + "ZaikoKbn").val() == 1)
            {
                $("#" + idleft + "Suuryou2").val($("#" + idleft + "Suuryou1").val().replace(/,/g, '') * $("#" + idleft + "Irisuu").val().replace(/,/g, ''));
            } else
            {
                $("#" + idleft + "Suuryou1").val($("#" + idleft + "Suuryou2").val().replace(/,/g, '') / $("#" + idleft + "Irisuu").val().replace(/,/g, ''));
            }
        }
        $("#" + idleft + "Suuryou2").change();
        suufld.change();
    }
}

$("[id$='Irisuu']").change(function ()
{ //入数が変更されたら
    var idleft = $(this).attr("id").slice(0, -6); //fieldShiireMeisaiDts0Irisuu 右から6桁消す
    if (1 * $("#" + idleft + "Suuryou2").replace(/,/g, '') == 0)
    {
        $("#" + idleft + "Suuryou2").val(1 * $(this).val() * $("#" + idleft + "Suuryou1").val().replace(/,/g, ''));
        $("#" + idleft + "Suuryou2").change();
    }
});

$("[id$='Suuryou1']").change(function ()
{ //数量1が変更されたら
    var idleft = $(this).attr("id").slice(0, -8); //fieldShiireMeisaiDts0Suuryou1 右から8桁消す
    var suu1 = 1 * $(this).val().replace(/,/g, '');

    if (1 * $("#" + idleft + "Irisuu").val().replace(/,/g, '') !== 0)
    {
        $("#" + idleft + "Suuryou2").val(suu1 * $("#" + idleft + "Irisuu").val().replace(/,/g, ''));
        $("#" + idleft + "Suuryou2").change();
    }
    var sh1 = $("#" + idleft + "Suu1Shousuu").val(); // 小数桁を揃える
    $(this).val(Intl.NumberFormat("ja-JP", { minimumFractionDigits: sh1, maximumFractionDigits: sh1 }).format(suu1));//カンマ編集
    if ($("#" + idleft + "TankaKbn").val() == 1)
    { // バグZaikoKbnを見ていたので修正2019/3/6井浦
        suu1or2change(idleft);
    }
    $("#" + idleft + "Suuryou2").change();

    denpyou_goukei_saikeisan();
});

$("[id$='Suuryou2']").change(function ()
{ //数量2が変更されたら
    var idleft = $(this).attr("id").slice(0, -8);
    if ($("#" + idleft + "TankaKbn").val() == 2)
    {
        suu1or2change(idleft);
    }
    gyou_suuryou_change(idleft);
    gyou_kingaku_saikeisan(idleft);
    denpyou_goukei_saikeisan();
});


function gyou_suuryou_change(idleft)
{
    var suu2 = $('#' + idleft + 'Suuryou2').val().replace(/,/g, '');//カンマ編集を一旦戻す
    var sh2 = $("#" + idleft + "Suu2Shousuu").val(); // 小数桁を揃える
    $('#' + idleft + 'Suuryou2').val(Intl.NumberFormat("ja-JP", {
        minimumFractionDigits: sh2,
        maximumFractionDigits: sh2
    }).format(suu2));//カンマ編集
}

function suu1or2change(idleft)
{
    if ($("#" + idleft + "UtiwakeKbnCd").val() == 20)
    { // 内部生産
        var zaiko_kbn0 = $("#" + idleft + "ZaikoKbn").val();
        var gyou = 1 * idleft.slice(21);
        var idleftx = idleft.slice(0, 20);
        var goukeisuuryou = 0;
        var goukeisuuryou1 = $("#" + idleft + "Suuryou1").val().replace(/,/g, '');
        var goukeisuuryou2 = $("#" + idleft + "Suuryou2").val().replace(/,/g, '');

        let moto_tanka_kbn = $('#' + idleft + 'TankaKbn').val();    //元単価区分を保持 2020-01-22
        let goukeisuuryou_reverse = 0;                              //単価単位の反対の数値を保持 2020-01-22
        goukeisuuryou = zaiko_kbn0 == 1 ? goukeisuuryou1 : goukeisuuryou2;
        goukeisuuryou_reverse = zaiko_kbn0 == 2 ? goukeisuuryou1 : goukeisuuryou2; //2020-01-22

        $("#fieldGoukeisuuryou").val(Intl.NumberFormat("ja-JP", {
            minimumFractionDigits: 1,
            maximumFractionDigits: 2
        }).format(goukeisuuryou));//カンマ編集
        var i0 = 1 * idleft.slice(20);
        for (i = i0 + 1; i < imax; i++)
        {
            if (($("#fieldShiireMeisaiDts" + i + "UtiwakeKbnCd").val() == 10 || $("#fieldShiireMeisaiDts" + i + "UtiwakeKbnCd").val() == 21) && 1 * $("#fieldShiireMeisaiDts" + i + "Keisu").val() != 0)
            {
                $('#' + idleftx + i + 'Suuryou').val(goukeisuuryou);
                var tanka_kbn = $('#' + idleftx + i + 'TankaKbn').val();
                var sh = $("#" + idleftx + i + "Suu" + tanka_kbn + "Shousuu").val(); // 小数桁を揃える
                $('#' + idleftx + i + 'Suuryou' + tanka_kbn).val(Intl.NumberFormat("ja-JP", {
                    minimumFractionDigits: sh,
                    maximumFractionDigits: sh
                }).format($('#' + idleftx + i + "Keisu").val().replace(/,/g, '') * goukeisuuryou));

                //====== 問題が発生した場合、コメントアウトすること 2020-01-22 西山 ==========================
                if (tanka_kbn === moto_tanka_kbn)
                {
                    let tanka_revers = tanka_kbn === '1' ? '2' : '1';
                    $('#' + idleftx + i + 'Suuryou' + tanka_revers).val(goukeisuuryou_reverse);
                } else
                {
                    let tanka_revers = tanka_kbn === '1' ? '2' : '1';
                    $('#' + idleftx + i + 'Suuryou' + tanka_revers).val(Intl.NumberFormat('ja-JP', {
                        minimumFractionDigits: sh,
                        maximumFractionDigits: sh
                    }).format($('#' + idleftx + i + "Irisuu").val().replace(/,/g, '') * goukeisuuryou_reverse));
                }
                //=========================== ここまで 2019-01-22 ====================================

                $('#' + idleftx + i + 'Kingaku').val($('#' + idleftx + i + "Suuryou" + tanka_kbn).val().replace(/,/g, '') * $('#' + idleftx + i + "Tanka").val().replace(/,/g, ''));
                gyou_kingaku_saikeisan("fieldShiireMeisaiDts" + i); // 行金額再計算
            } else
            {
                break; // ※該当元行に関連する部分が終ったらやめる。2019/2/5 井浦
            }
        }
    } else
    {
        gyou_kingaku_saikeisan(idleft); // 行金額再計算
    }

    denpyou_goukei_saikeisan(); // 伝票合計再計算
}

$("[id$='TankaKbn']").change(function ()
{ //単価区分が変更されたら
    var idleft = $(this).attr("id").slice(0, -8); //fieldShiireMeisaiDts0TankaKbn 右から8桁消す
    gyou_kingaku_saikeisan(idleft); // 行金額再計算
    denpyou_goukei_saikeisan(); // 伝票合計再計算
});

function gyou_kingaku_saikeisan(idleft)
{ // 行金額再計算
    var suufld = $("#" + idleft + "Suuryou" + $("#" + idleft + "TankaKbn").val());
    $("#" + idleft + "Kingaku").val(Math.round(1000 * suufld.val().replace(/,/g, '')) * Math.round(1000 * $("#" + idleft + "Tanka").val().replace(/,/g, '')) / 1000000); //金額=数量*単価
    $('#' + idleft + 'TanniMr1Cd').change();
    gyou_kingaku_kanma(idleft); // 行金額端数処理カンマ編集
}

$("[id$='TanniMr1Cd']").change(function ()
{ //単位1が変更されたら
    var idleft = $(this).attr("id").slice(0, -10); //fieldUriageMeisaiDts0TanniMr1Cd 右から10桁消す
    var tanka_kbn = $('#' + idleft + 'TankaKbn');
    var tanka_kbn_sel = tanka_kbn.val();
    tanka_kbn.children().remove();
    tanka_kbn.append($("<option>").val('1').text('/' + $('#' + idleft + 'TanniMr1Cd option:selected').text()));
    tanka_kbn.append($("<option>").val('2').text('/' + $('#' + idleft + 'TanniMr2Cd option:selected').text()));
    tanka_kbn.val(tanka_kbn_sel);
});

$("[id$='TanniMr2Cd']").change(function ()
{ //単位2が変更されたら
    var idleft = $(this).attr("id").slice(0, -10); //fieldUriageMeisaiDts0TanniMr1Cd 右から10桁消す
    $('#' + idleft + 'TanniMr1Cd').change();
});

$("[id$='Tanka']").change(function ()
{ //単価が変更されたら
    var idleft = $(this).attr("id").slice(0, -5); //fieldShiireMeisaiDts0Tanka 右から5桁消す
    $(this).val($(this).val().replace(/,/g, ''));//カンマ編集を一旦戻す
    sh2 = $("#" + idleft + "TankaShousuu").val();
    if ($("#" + idleft + "MotoTanniMr2Cd").val() == $("#" + idleft + "TanniMr2Cd").val())
    {
        sh1 = sh2;
    } else
    {
        sh1 = 0;
    }
    $(this).val(Intl.NumberFormat("ja-JP", {
        minimumFractionDigits: sh1,
        maximumFractionDigits: sh2
    }).format($(this).val()));//カンマ編集
    gyou_kingaku_saikeisan(idleft); // 行金額再計算
    denpyou_goukei_saikeisan(); // 伝票合計再計算
});

$("[id$='Gentanka']").change(function ()
{ //原単価が変更されたら
    var idleft = $(this).attr("id").slice(0, -8); //fieldShiireMeisaiDts0Gentanka 右から8桁消す
    $(this).val($(this).val().replace(/,/g, ''));//カンマ編集を一旦戻す
    sh2 = $("#" + idleft + "TankaShousuu").val();
    if ($("#" + idleft + "MotoTanniMr2Cd").val() == $("#" + idleft + "TanniMr2Cd").val())
    {
        sh1 = sh2;
    } else
    {
        sh1 = 0;
    }
    $(this).val(Intl.NumberFormat("ja-JP", {
        minimumFractionDigits: sh1,
        maximumFractionDigits: sh2
    }).format($(this).val()));//カンマ編集
    denpyou_goukei_saikeisan(); // 伝票合計再計算
});

$("[id$='Kingaku']").change(function ()
{ //金額が変更されたら
    var idleft = $(this).attr("id").slice(0, -7); //fieldShiireMeisaiDts0Kingaku 右から7桁消す
    gyou_kingaku_kanma(idleft); // 行金額端数処理カンマ編集
    denpyou_goukei_saikeisan(); // 伝票合計再計算
});

$("[id$='ZeirituMrCd']").change(function ()
{ //税率が変更されたら
    var idleft = $(this).attr("id").slice(0, -11); //fieldShiireMeisaiDts0ZeirituMrCd 右から11桁消す
    gyou_kingaku_kanma(idleft); // 行金額端数処理カンマ編集
    denpyou_goukei_saikeisan(); // 伝票合計再計算
});

function gyou_kingaku_kanma(idleft)
{ // 行金額端数処理カンマ編集
    var kingaku = 1.0 * $("#" + idleft + "Kingaku").val().replace(/,/g, ''); //カンマ編集を一旦戻す
    switch (1 * $("#gaku_hasuu_shori_kbn_cd").val())
    {
        case 1:
            if (kingaku >= 0)
            {
                kingaku = Math.floor(kingaku);
            } else
            {
                kingaku = Math.ceil(kingaku);
            }
            break;//切り捨てtruncはfirefoxだけ
        case 2:
            if (kingaku >= 0)
            {
                kingaku = Math.ceil(kingaku);
            } else
            {
                kingaku = Math.floor(kingaku);
            }
            break;//切り上げ、マイナスは別が良い
        default:
            kingaku = Math.round(kingaku);
            break;//四捨五入
    }
    $("#" + idleft + "Kingaku").val(Intl.NumberFormat("ja-JP", {
        minimumFractionDigits: 0,
        maximumFractionDigits: 0
    }).format(kingaku));//カンマ編集
    zeiritu = 0.01 * cd_zeiritu[$("#" + idleft + "ZeirituMrCd").val()];
    if ($("#fieldZeiTenkaKbnCd").val().substr(0, 1) == "2")
    { //内税
        switch (1 * $("#zei_hasuu_shori_kbn_cd").val())
        {
            case 1:
                if (kingaku >= 0)
                {
                    $("#" + idleft + "Zeigaku").val(Math.floor(kingaku / (1 + zeiritu) * zeiritu));
                } else
                {
                    $("#" + idleft + "Zeigaku").val(Math.ceil(kingaku / (1 + zeiritu) * zeiritu));
                }
                break;//切り捨てtruncはfirefoxだけ
            case 2:
                if (kingaku >= 0)
                {
                    $("#" + idleft + "Zeigaku").val(Math.ceil(kingaku / (1 + zeiritu) * zeiritu));
                } else
                {
                    $("#" + idleft + "Zeigaku").val(Math.floor(kingaku / (1 + zeiritu) * zeiritu));
                }
                break;//切り上げ、マイナスは別が良い
            default:
                $("#" + idleft + "Zeigaku").val(Math.round(kingaku / (1 + zeiritu) * zeiritu));
                break;//四捨五入
        }
        $("#" + idleft + "Zeinukigaku").val(kingaku - $("#" + idleft + "Zeigaku").val());
    } else if ($("#fieldZeiTenkaKbnCd").val() == "40")
    { // 税額手入力なら
        if ($("#" + idleft + "Utiwake").val() == "90")
        { // 消費税手入力行なら
            $("#" + idleft + "Zeigaku").val(kingaku); // 金額を全て消費税にする…税抜額が０円になる
            $("#" + idleft + "Zeinukigaku").val(0);
        } else
        {
            $("#" + idleft + "Zeigaku").val(0);
            $("#" + idleft + "Zeinukigaku").val(kingaku);
        }
    } else
    {										//外税など
        $("#" + idleft + "Zeinukigaku").val(kingaku);
        switch (1 * $("#zei_hasuu_shori_kbn_cd").val())
        {
            case 1:
                if (kingaku >= 0)
                {
                    $("#" + idleft + "Zeigaku").val(Math.floor(kingaku * zeiritu));
                } else
                {
                    $("#" + idleft + "Zeigaku").val(Math.ceil(kingaku * zeiritu));
                }
                break;//切り捨てはfirefoxだけ
            case 2:
                if (kingaku >= 0)
                {
                    $("#" + idleft + "Zeigaku").val(Math.ceil(kingaku * zeiritu));
                } else
                {
                    $("#" + idleft + "Zeigaku").val(Math.floor(kingaku * zeiritu));
                }
                break;//切り上げ、マイナスは別が良い
            default:
                $("#" + idleft + "Zeigaku").val(Math.round(kingaku * zeiritu));
                break;//四捨五入
        }
    }
}

function denpyou_goukei_saikeisan()
{ // 伝票合計再計算
    zeinukigaku = 0;
    shouhizeigaku = 0;
    genkagaku = 0;
    var goukeisuu = 0;  //数量2の合計 Nishiyama 3/19

    var ritubetugaku = {};
    var idleft = "fieldShiireMeisaiDts";
    for (i = 0; i < imax - 1; i++)
    {
        var tanka_kbn = $('#' + idleft + i + 'TankaKbn').val();
        var suufld = $('#' + idleft + i + 'Suuryou' + tanka_kbn);
        zeinukigaku += 1 * $('#' + idleft + i + 'Zeinukigaku').val();
        shouhizeigaku += 1 * $('#' + idleft + i + 'Zeigaku').val();
        $('#' + idleft + i + 'Genkagaku').val(Math.round($('#' + idleft + i + 'Gentanka').val().replace(/,/g, '') * suufld.val().replace(/,/g, ''))); //四捨五入
        genkagaku += 1 * $('#' + idleft + i + 'Genkagaku').val();
        if (!ritubetugaku[$('#' + idleft + i + 'ZeirituMrCd').val()])
        {
            ritubetugaku[$('#' + idleft + i + 'ZeirituMrCd').val()] = 0
        }
        ritubetugaku[$('#' + idleft + i + 'ZeirituMrCd').val()] += 1 * $('#' + idleft + i + 'Kingaku').val().replace(/,/g, ''); // 税別額[税率キー]+=金額

        //Add By Nishiyama 2019/3/19 伝票合計数量（内訳通常のみ集計）
        var utiwakekbn = $('#' + idleft + i + 'UtiwakeKbnCd').val();
        if (utiwakekbn === '10')
        {
            goukeisuu += 1 * $('#' + idleft + i + 'Suuryou2').val().replace(/,/g, ''); // 桁区切りカンマ除去2019/4/1井浦
        }
    }
    $("#fieldGoukeisuuryou").val(Intl.NumberFormat("ja-JP", {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    }).format(goukeisuu));  //合計数量 Nishiyama 3/19

    goukeigaku = zeinukigaku + shouhizeigaku;
    if ($("#fieldZeiTenkaKbnCd") != 20 && $("#fieldZeiTenkaKbnCd") != 30 && $("#fieldZeiTenkaKbnCd") != 40)
    { // 内税と輸出と税手入力は伝票合計の税額を再計算しない
        shouhizeigaku2 = 0;
        if ($("#fieldZeiTenkaKbnCd").val().substr(0, 1) == "2")
        { //内税(総額など)
            for (var ritukey in ritubetugaku)
            {
                zeiritu = 0.01 * cd_zeiritu[ritukey];
                switch (1 * $("#zei_hasuu_shori_kbn_cd").val())
                {
                    case 1:
                        if (1 * ritubetugaku[ritukey] >= 0)
                        {
                            zeigaku = Math.floor(1 * ritubetugaku[ritukey] / (1 + zeiritu) * zeiritu);
                        } else
                        {
                            zeigaku = Math.ceil(1 * ritubetugaku[ritukey] / (1 + zeiritu) * zeiritu);
                        }
                        break;//切り捨てtruncはfirefoxだけ
                    case 2:
                        if (1 * ritubetugaku[ritukey] >= 0)
                        {
                            zeigaku = Math.ceil(1 * ritubetugaku[ritukey] / (1 + zeiritu) * zeiritu);
                        } else
                        {
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
        } else
        {										//外税
            for (var ritukey in ritubetugaku)
            {
                zeiritu = 0.01 * cd_zeiritu[ritukey];
                switch (1 * $("#zei_hasuu_shori_kbn_cd").val())
                {
                    case 1:
                        if (1 * ritubetugaku[ritukey] >= 0)
                        {
                            zeigaku = Math.floor(1 * ritubetugaku[ritukey] * zeiritu);
                        } else
                        {
                            zeigaku = Math.ceil(1 * ritubetugaku[ritukey] * zeiritu);
                        }
                        break;//切り捨てtruncはfirefoxだけ
                    case 2:
                        if (1 * ritubetugaku[ritukey] >= 0)
                        {
                            zeigaku = Math.ceil(1 * ritubetugaku[ritukey] * zeiritu);
                        } else
                        {
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
    } else
    {
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
}

$("[id$='ShouhinMrCd']").focusin(function (e)
{
    if ($(this).val() == '')
    {
        $('#fieldGenzaiko').val('');
    } else
    {
        var idleft = $(this).attr("id").slice(0, -11);
        try
        {
            var souko_cd = $('#' + idleft + 'SoukoMrCd').val();
        } catch (e)
        {
            console.log('倉庫空白');
        }

        if (typeof souko_cd !== "undefined")
        {
            getZaiko($(this).val(), souko_cd);
        } else
        {
            getZaiko($(this).val(), '');
        }
    }
});

function getZaiko(shouhinCd, souko_cd)
{
    if (shouhinCd === '')
    {
        $('#fieldGenzaiko').val('');
    } else
    {
        $.ajax({
            type: "POST",
            url: report_zaiko_vws_ajaxGet,
            data: { 'cd': shouhinCd, 'souko': souko_cd, },
            async: true,
            dataType: 'json',
            success: function (data)
            {
                $('#fieldGenzaiko').val(data[0]);
                $('#fieldGenzaiko1').val(data[1]);
            },
            error: function (xhr, status, err)
            {
                console.log('Error : Cd.change.ajax => ' + status + '/' + err);
            },
        });

    }
}

$(function ()
{ // テーブルのヘッドを消えなくする
    $('table.head_fix').floatThead({
        top: 50
    });
});

(function ($)
{ //$=JQuery
    var sheet_nm = "#meisaiTable";
    var drag_target = null;
    var tbl_width = $(sheet_nm).width();
    var org_width = 0;
    $(sheet_nm + " th").unbind('mousemove', null);
    $(sheet_nm + " th").unbind('mousedown', null);
    $(window).unbind('mousemove', null);
    $(window).unbind('mouseup', null);
    $(window).mousemove(function (e)
    {
        if (drag_target != null)
        {
            //ドラッグ中による列幅変更。
            var th_width = e.clientX - parseInt($(drag_target).offset().left);
            if (th_width < 10)
            {
                th_width = 10;
            }
            if (drag_target.hasClass('ot-fixed'))
            {
                $('.ot-fixed').css({ width: th_width + 'px' });
            } else
            {
                drag_target.css({ width: th_width + 'px' });
            }
            //tableのサイズも変更する。
            //var tbl_width = th_width - parseInt(drag_target.css("width"));
            //var tbl_new_width = parseInt($(sheet_nm).css("width")) + tbl_width;
            var tbl_new_width = tbl_width - org_width + th_width;
            $(sheet_nm).css({ width: tbl_new_width + 'px' });
            return false;
        }
        return true;
    });//[[ mousemove
    $(sheet_nm + " th").mousemove(function (e)
    {
        var right = parseInt($(this).offset().left) + parseInt($(this).css("width"));
        //マウスカーソルの図柄変更。
        if ((right - 10) < e.clientX)
        {
            if (e.clientX < (right + 10))
            {
                //右端に位置する場合はリサイズカーソルにする。
                $(this).css({ cursor: 'col-resize' });
                return false;
            }
        }
        $(this).css({ cursor: 'default' });
        return true;
    });//[[ mousemove
    $(sheet_nm + " th").mousedown(function (e)
    {
        //マウスカーソルの図柄変更。
        if ($(this).css('cursor') == 'col-resize')
        {
            //ドラッグ開始。
            drag_target = $(this);
            $(document.body).css({ cursor: 'col-resize' });
            tbl_width = $(sheet_nm).width();
            org_width = $(this).width() + 1;
            return false;
        }
        return true;
    });//[[ mousedown
    $(window).mouseup(function (e)
    {
        //ドラッグ解除。
        drag_target = null;
        $(document.body).css({ cursor: '' });
        var tbl_new_width = 0;
    });//[[ mouseup
})(jQuery); //[[ onload.


function switch_roa(fieldx)
{ // 項目制御readonly設定(主)
    if ($("#field" + fieldx).attr("readonly") === "readonly")
    {
        $("#field" + fieldx).removeAttr("readonly");
    } else
    {
        $("#field" + fieldx).attr("readonly", "readonly");
    }
    $targetElm = $(targetElm);
}

function switch_ros(fieldx)
{ // 項目制御readonly設定(明細)
    if ($("#hidden" + fieldx).attr("readonly") === "readonly")
    {
        $("#hidden" + fieldx).removeAttr("readonly");
        for (var i = 0; i < imax; i++)
        {
            $("#fieldShiireMeisaiDts" + i + fieldx).removeAttr("readonly");
        }
    } else
    {
        $("#hidden" + fieldx).attr("readonly", "readonly");
        for (var i = 0; i < imax; i++)
        {
            $("#fieldShiireMeisaiDts" + i + fieldx).attr("readonly", "readonly");
        }
    }
    $targetElm = $(targetElm);
}

var ro_fields = [
    'shiirebi', 'cd', 'hacchuu_dt_cd', 'juchuu_dt_cd', 'zeiritu_tekiyoubi', 'torihiki_kbn_cd', 'shimekiri_flg',
    'zei_tenka_kbn_cd', 'tekiyou', 'shounin_joutai_flg', 'shounin_sha_mr_cd',
    '[cd', '[utiwake_kbn_cd', '[kousei', '[nyuuka_kbn_cd', '[shouhin_mr_cd', '[tekiyou', '[iro', '[iromei', '[lot', '[kobetucd', '[souko_mr_cd', '[hinsitu_kbn_cd', '[suuryou', '[keisu', '[irisuu', '[suuryou1',
    '[tanni_mr1_cd', '[suuryou2', '[tanni_mr2_cd', '[tanka_kbn', '[hacchuuzan', '[gentanka', '[tanka', '[kingaku', '[zeiritu_mr_cd', '[bikou', '[project_mr_cd'
]; // 閉じ角カッコはajaxで渡すときに欠落するので初めから入れない。

function save_ros()
{
    $("#save_ros").text("(→「入力制御の保存中!....」)").css('color', 'red');
    var readonlys = {}; // 連想配列初期化
    var rewidths = {}; // 連想配列初期化
    for (var j in ro_fields)
    {
        var ro_field_name = ro_fields[j];
        if (ro_fields[j].substr(0, 1) == '[')
        {
            ro_field_name = 'hidden' + ro_fields[j] + ']';
        }
        readonlys[ro_fields[j]] = $("[name='" + ro_field_name + "']").attr('readonly') === 'readonly';
        if (ro_fields[j].substr(0, 1) == '[')
        {
            ro_field_name = 'data[shiire_meisai_dts][0]' + ro_fields[j] + ']';
            rewidths[ro_fields[j]] = $("[name='" + ro_field_name + "']").outerWidth();
        }
    }
    $.ajax({
        type: "POST",
        url: readonlys_ajaxSave,
        data: { 'controller_cd': 'ShiireDts', 'gamen_cd': 'inputfields', 'readonlys': readonlys, 'rewidths': rewidths, },
        async: true,
        dataType: 'json',
        success: function (error_count)
        {
            //	alert('入力制御の保存完了！'+error_count);
            $("#save_ros").text('(click→「入力制御の保存」)').css('color', 'pink');
        },
        error: function (xhr, status, err)
        {
            alert('入力制御の保存でエラー Cd.change.ajax ' + status + '/' + err);
            $("#save_ros").text('(click→「入力制御の保存」)').css('color', 'pink');
        },
    });

}

// 最終チェック…F12登録を押したときにエラーがあれば戻る。
function final_check()
{
    $("#F12").focus();
    denpyou_goukei_saikeisan();                 //  2019/7/3
    if (!final_hacchuu_juchuu_check())
    {
        if (!confirm("金額がマイナスの明細がある伝票に、発注か受注番号が入っています。\nこのまま登録してもよろしいですか？"))
        {
            alert('処理を中止しました。');
            return false;
        }
    }

    $("#dispErrMsg").text("");                  // エラーメッセージクリア
    if (!final_tantou_check()) return false;    // 担当者チェック
    if (!final_shiiresaki_check()) return false;    // 仕入先チェック
    if (!final_meisaisuu_check()) return false; // 明細数チェック
    if (!final_meisai_check()) return false;    // 明細チェック
    if (!final_sime_check()) return false;      // 仕入日チェック
    //inal_azukari_zaiko_check();               //預り・在庫両方のチェック（小松は預り管理しない）
    final_meisai_zaikocheck();                  //在庫チェック
    return false;
}

//伝票削除時の在庫確認
function final_del_check(del_id = 0)
{
    $("#dispErrMsg").text('');
    if (!final_meisai_zaikocheck(true, del_id)) return false;
    return false;
}

function final_tantou_check()
{
    if (!($("#fieldTantouMrCd").val()))
    {
        $("#dispErrMsg").text("担当者を入力してください。");
        return false;
    }
    return true;
}

function final_shiiresaki_check()
{
    if (!($("#fieldShiiresakiMrCd").val()))
    {
        $("#dispErrMsg").text("仕入先を入力してください。");
        return false;
    }
    return true;
}

function final_meisaisuu_check()
{
    if (imax <= 1)
    {
        $("#dispErrMsg").text("明細がないので、登録できません!!");
        return false;
    }
    return true;
}

function final_hacchuu_juchuu_check()
{
    var hachuu_cd = $('#fieldHacchuuDtCd').val();
    var juchuu_cd = $('#fieldJuchuuDtCd').val();
    if (hachuu_cd === '') return true;
    if (juchuu_cd === '') return true;

    var jqleft = '#fieldShiireMeisaiDts';
    // 明細にマイナス金額があるかないか確認（赤伝の場合、発注受注番号があれば警告）
    for (let i = 0; i < (imax - 1); i++)
    {
        if ($(jqleft + i + 'Kingaku').val().indexOf('-') !== -1)
        {
            return false;
        }
    }
    return true;
}

function final_meisai_check()
{
    var jqleft = '#fieldShiireMeisaiDts';
    for (var i = 0; i < (imax - 1); i++)
    {
        $(jqleft + i + "Lot").val($(jqleft + i + "Lot").val().trim()); // 空白除去
        $(jqleft + i + "Iro").val($(jqleft + i + "Iro").val().trim()); // 空白除去
        $(jqleft + i + "Iromei").val($(jqleft + i + "Iromei").val().trim()); // 空白除去
        $(jqleft + i + "Kobetucd").val($(jqleft + i + "Kobetucd").val().trim()); // 空白除去
        if (!($(jqleft + i + "SoukoMrCd").val()))
        {
            $("#dispErrMsg").text("" + (1 + i) + "行目の倉庫を入力してください。");
            return false;
        }
        if (!$(jqleft + i + "Cd").val() || $(jqleft + i + "Cd").val() == 0)
        {
            continue;
        }
        if (!($(jqleft + i + "UtiwakeKbnCd").val()))
        {
            $("#dispErrMsg").text("" + (1 + i) + "行目の内訳区分を入力してください。");
            return false;
        }
        if (!($(jqleft + i + "HinsituKbnCd").val()))
        {
            $("#dispErrMsg").text("" + (1 + i) + "行目の品質を入力してください。");
            return false;
        }
        if (!($(jqleft + i + "TanniMr1Cd").val()) || !($(jqleft + i + "TanniMr2Cd").val()))
        {
            $("#dispErrMsg").text("" + (1 + i) + "行目の単位を入力してください。");
            return false;
        }
        if ($(jqleft + i + "TanniMr1Cd").val() == $(jqleft + i + "TanniMr2Cd").val())
        {
            $("#dispErrMsg").text("" + (1 + i) + "行目の単位1と2は別の単位を入力してください。");
            return false;
        }
        if ($(jqleft + i + "UtiwakeKbnCd").val() >= 15 && $(jqleft + i + "UtiwakeKbnCd").val() < 90
            && ($(jqleft + i + "Tanka").val() != 0 || $(jqleft + i + "Kingaku").val() != 0))
        {
            $("#dispErrMsg").text("" + (1 + i) + "行目の内訳区分なら単価・金額は０円を入力してください。");
            return false;
        }
    }
    return true;
}

function final_sime_check()
{
    var ymd = $('#fieldShiirebi').val().split('-');
    if (ymd.length != 3)
    {
        $("#dispErrMsg").text("仕入日付区切り記号が正しくありません!!");
        return false;
    }
    var date = new Date(ymd[0], ymd[1] - 1, ymd[2]);
    if (ymd[0] != date.getFullYear() ||
        ymd[1] != ('0' + (date.getMonth() + 1)).slice(-2) ||
        ymd[2] != ('0' + date.getDate()).slice(-2))
    {
        $("#dispErrMsg").text("仕入日付年月日が正しくありません!!");
        return false;
    }
    if ($('#fieldShiirebi').val() <= $("#fieldSimezumibi").val())
    {
        $("#dispErrMsg").text("締済なので登録・変更できません!!");
        return false;
    }
    return true;
}

//最終在庫チェック
var zaikotable = {};

function final_meisai_zaikocheck(del_flg = false, del_id = 0)
{
    var jqleft = '#fieldShiireMeisaiDts';
    var den_id = $("#id").val();
    if (del_flg) den_id = undefined;
    var den_mr_cd = 'shiire';
    var cd = '';
    var souko = '';
    var lot = '';
    var hinshitu = '';
    var iro = '';
    var iromei = '';
    var dic_key = 'key';
    //明細集計
    for (var i = 0; i < imax - 1; i++)
    {
        cd = $(jqleft + i + 'ShouhinMrCd').val();
        lot = $(jqleft + i + 'Lot').val();
        souko = $(jqleft + i + 'SoukoMrCd').val();
        hinshitu = $(jqleft + i + 'HinsituKbnCd').val();
        iro = $(jqleft + i + 'Iro').val();
        iromei = $(jqleft + i + 'Iromei').val();
        if (typeof iro === 'undefined')
        {
            iro = '';
        }
        if (typeof iromei === 'undefined')
        {
            iromei = '';
        }
        dic_key = cd + "," + lot + "," + souko + "," + hinshitu + "," + iro + "," + iromei;
        if (!(dic_key in zaikotable))
        {   //新規キー
            zaikotable[dic_key] = [cd, lot, souko, hinshitu, iro, iromei, 0.00, 0.00];
        }
        switch ($(jqleft + i + 'UtiwakeKbnCd').val())
        {
            case '10':      //通常
            case '11':      //返品
            case '20':      //生産
            case '22':      //支給受入
            case '23':      //預り
                if (!del_flg)
                {
                    zaikotable[dic_key][6] += 1 * $(jqleft + i + 'Suuryou1').val().replace(/,/g, '');
                    zaikotable[dic_key][7] += 1 * $(jqleft + i + 'Suuryou2').val().replace(/,/g, '');
                } else
                {
                    zaikotable[dic_key][6] += -1 * $(jqleft + i + 'Suuryou1').val().replace(/,/g, '');
                    zaikotable[dic_key][7] += -1 * $(jqleft + i + 'Suuryou2').val().replace(/,/g, '');
                }
                break;
            case '21':      //支給消費
                if (!del_flg)
                {
                    zaikotable[dic_key][6] += -1 * $(jqleft + i + 'Suuryou1').val().replace(/,/g, '');
                    zaikotable[dic_key][7] += -1 * $(jqleft + i + 'Suuryou2').val().replace(/,/g, '');
                } else
                {
                    zaikotable[dic_key][6] += 1 * $(jqleft + i + 'Suuryou1').val().replace(/,/g, '');
                    zaikotable[dic_key][7] += 1 * $(jqleft + i + 'Suuryou2').val().replace(/,/g, '');
                }
                break;
        }
    }
    var msg = '';
    $.ajax({
        type: "POST",
        url: report_zaiko_vws_ajaxZaikoCheck,
        data: { 'den_mr_cd': den_mr_cd, 'den_id': den_id, 'zaikotable': zaikotable, },
        async: true,
        dataType: 'json',
        success: function (data)
        {
            console.log(data);
            msg = data;
            zaikotable = {};
            if (msg === 'OK')
            {
                if (!del_flg)
                {
                    let res = confirm('登録しても、よろしいですか?');
                    if (res === true)
                    {
                        $('#post_form').submit();
                    }
                } else
                {
                    let res = confirm('削除してもよろしいですか？');
                    if (res === true)
                    {
                        window.location.href = shiire_dts_del + del_id;
                    }
                }

            } else
            {
                $("#dispErrMsg").text(msg);
            }
        },
        error: function (xhr, status, err)
        {
            $("#dispErrMsg").text('Error => zaiko_check_draft :' + status + '/' + err);
        }
    })
}

//預り在庫チェック
function final_azukari_zaiko_check()
{
    var den_id = $("#id").val();
    var den_mr_cd = 'shiire';
    var jqleft = '#fieldShiireMeisaiDts';
    var shouhin_mr_cd = '';
    var shiiresaki_mr_cd = $('#fieldShiiresakiMrCd').val();
    var dic_key = 'key';
    var azukari_meisai = {};
    for (let i = 0; i < imax - 1; i++)
    {
        shouhin_mr_cd = $(jqleft + i + 'ShouhinMrCd').val();
        dic_key = shouhin_mr_cd.trim(); //変なブランクが入る為
        if (!(dic_key in azukari_meisai))
        {
            azukari_meisai[dic_key] = [shouhin_mr_cd, shiiresaki_mr_cd, 0.00, 0.00];
        }
        switch ($(jqleft + i + 'UtiwakeKbnCd').val())
        {
            case '22':  //支給受入
            case '23':  //預り
                azukari_meisai[dic_key][2] += 1 * $(jqleft + i + 'Suuryou1').val().replace(/,/g, '');
                azukari_meisai[dic_key][3] += 1 * $(jqleft + i + 'Suuryou2').val().replace(/,/g, '');
                break;
            default:
                delete azukari_meisai[dic_key]; //預り対象以外は、チェック不要なのでhashから削除。
                break;
        }
    }
    if (isEmpty(azukari_meisai))
    {
        final_meisai_zaikocheck();   //在庫チェックを呼び出す。在庫チェックよりsubmit
        return;
    }
    $.ajax({
        type: "POST",
        url: ajax_azukari_get,
        data: { 'den_mr_cd': den_mr_cd, 'den_id': den_id, 'azukari_meisai': azukari_meisai, },
        async: true,
        dataType: 'json',
        success: function (data)
        {
            msg = data;
            if (msg === 'OK')
            {
                final_meisai_zaikocheck();   //在庫チェックを呼び出す。在庫チェックよりsubmit
            } else
            {
                $("#dispErrMsg").text(msg);
            }
        },
        error: function (xhr, status, err)
        {
            console.log('Error : azukari_zaiko_check ' + status + '/' + err);
        },
    });
}

//オブジェクトが空かどうか判定する関数
function isEmpty(obj)
{
    return !Object.keys(obj).length;
}
