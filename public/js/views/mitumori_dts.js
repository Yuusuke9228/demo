idmeisaif = 'fieldMitumoriMeisaiDts';
jqmeisaif = '#' + idmeisaif;

function addMitumoriMeisaiDt() { // alert(imax);
    tr_id = '#tr_mitumori_meisai_dt_' + imax;
    id_head = idmeisaif + imax;
    name_head = 'data[mitumori_meisai_dts][' + imax + ']';
    $("#tr_mitumori_meisai_dt_hidden").clone(true).attr('id', 'tr_mitumori_meisai_dt_' + imax).removeAttr('style').insertAfter('#tr_mitumori_meisai_dt_' + ((imax > 0) ? imax - 1 : 'hidden'));
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
    $(tr_id + " #hiddenMitumorizan").attr('id', id_head + 'Mitumorizan').attr('name', name_head + '[mitumorizan]');
    $(tr_id + " #hiddenTankaShousuu").attr('id', id_head + 'TankaShousuu').attr('name', name_head + '[tanka_shousuu]');
    $(tr_id + " #hiddenGentanka").attr('id', id_head + 'Gentanka').attr('name', name_head + '[gentanka]');
    $(tr_id + " #hiddenTanka").attr('id', id_head + 'Tanka').attr('name', name_head + '[tanka]');
    $(tr_id + " #hiddenTankaKbn").attr('id', id_head + 'TankaKbn').attr('name', name_head + '[tanka_kbn]');
    $(tr_id + " #hiddenZaikoKbn").attr('id', id_head + 'ZaikoKbn').attr('name', name_head + '[zaiko_kbn]');
    $(tr_id + " #hiddenKingaku").attr('id', id_head + 'Kingaku').attr('name', name_head + '[kingaku]');
    $(tr_id + " #hiddenGenkagaku").attr('id', id_head + 'Genkagaku').attr('name', name_head + '[genkagaku]');
    $(tr_id + " #hiddenProjectMrCd").attr('id', id_head + 'ProjectMrCd').attr('name', name_head + '[project_mr_cd]');
    $(tr_id + " #hiddenZeirituMrCd").attr('id', id_head + 'ZeirituMrCd').attr('name', name_head + '[zeiritu_mr_cd]');
    $(tr_id + " #hiddenKazeiKbnCd").attr('id', id_head + 'KazeiKbnCd').attr('name', name_head + '[kazei_kbn_cd]');
    $(tr_id + " #hiddenBikou").attr('id', id_head + 'Bikou').attr('name', name_head + '[bikou]');
    $(tr_id + " #hiddenHacchuurendouFlg").attr('id', id_head + 'HacchuurendouFlg').attr('name', name_head + '[hacchuurendou_flg]');
    $("#" + id_head + 'Cd').val(imax + 1);
    $("#" + id_head + 'Id').val(0);
    imax++; //alert($("#"+id_head+'Id').val());
    $("#" + id_head + 'KazeiKbnCd').val(1); // 初期値を課税とする。
    $targetElm = $(targetElm);
}

window.onload = function () {
//	$(window).resize();
    set_stamp(); // スタンプ表示
    addMitumoriMeisaiDt();
    zeiritu_kettei_imax(); // 税抜額なども再計算する
    //denpyou_goukei_saikeisan(); // 伝票合計再計算（税抜額などをControllerから送り込んであるならこちらが良い）
    tbl_new_width = 0;
    $('#meisaiTable thead tr th').each(function (i) {
        tbl_new_width += 1 + $(this).width();
    });
    $('#meisaiTable').css({width: tbl_new_width + 'px'});
}

$('#END').click(function () { //エンドキー(END)を押したら
    var index = $targetElm.index($("#" + lastfocusin));//alert(index);
    var thisname = $("#" + lastfocusin).attr('name');
    var partsname = thisname.split(/[\[|\]]+/);// '['か']'かその連続にマッチする文字で分割する。例：data[mitumori_meisai_dts][0][shouhin_mr_cd]は、['data','mitumori_meisai_dts','0','shouhin_mr_cd','']となる。
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
    var partsname = thisname.split(/[\[|\]]+/);// '['か']'かその連続にマッチする文字で分割する。例：data[mitumori_meisai_dts][0][shouhin_mr_cd]は、['data','mitumori_meisai_dts','0','shouhin_mr_cd','']となる。
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

$('#PgDn').click(function () { //ページダウンキー(Ctrl+Enter)を押したら
    var index = $targetElm.index($("#" + lastfocusin));//alert(index);
    var thisname = $("#" + lastfocusin).attr('name');
    var partsname = thisname.split(/[\[|\]]+/);// '['か']'かその連続にマッチする文字で分割する。例：data[mitumori_meisai_dts][0][shouhin_mr_cd]は、['data','mitumori_meisai_dts','0','shouhin_mr_cd','']となる。
    var findend = '[shouhin_mr_cd]';
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

$('#fieldCd').change(function () { //見積データ索引
//	alert($(this).val()); //''の場合、'0'など1桁の場合または結果が複数の場合、結果が1個の場合、結果が0個の場合
    if ($(this).val() != '') {
        $.ajax({
            type: "POST",
            url: mitumori_dts_ajaxGet,
            data: {'cd': $(this).val(),},
            async: true,
            dataType: 'json',
            success: function (data) {
                if (data.length >= 1 && $('#fieldCd').val() === data[0].cd) {
                    location.href = mitumori_dts_edit + data[0].id;
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
                    $("#fieldGotantousha").val(data[0].gotantousha);
                    $("#fieldKeishou").val(data[0].keishou);
                    $("#fieldTel").val(data[0].tel);
                    $("#fieldFax").val(data[0].fax);
                    $("#fieldTorihikiKbnCd").change();
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

$("[id$='ShouhinMrCd']").dblclick(function () { //商品マスター索引
    $(this).change();
});

$("[id$='ShouhinMrCd']").change(function () { //商品マスター索引
    //alert("AAA:".$(this).attr("id")); //''の場合、'0'など1桁の場合または結果が複数の場合、結果が1個の場合、結果が0個の場合
    var idleft = $(this).attr("id").slice(0, -11); //fieldMitumoriMeisaiDts0ShouhinMrCd 右から11桁消す
    var jqleft = '#' + idleft;
    var gyou = idleft.slice(22); //fieldMitumoriMeisaiDts0 左から22桁消す
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
                    $(jqleft + "TanniMr2Cd").val(data[0].tanni_mr2_cd);
                    $(jqleft + "MotoTanniMr2Cd").val(data[0].tanni_mr2_cd);
                    $(jqleft + "HinsituKbnCd").val(data[0].hinsitu_kbn_cd);
                    $(jqleft + "SuuShousuu").val(data[0].suu_shousuu);
                    $(jqleft + "Suu1Shousuu").val(data[0].suu1_shousuu);
                    $(jqleft + "Suu2Shousuu").val(data[0].suu2_shousuu);
                    $(jqleft + "TankaShousuu").val(data[0].tanka_shousuu);
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
                    $(jqleft + "TankaKbn").val(data[0].tanka_kbn);
                    $(jqleft + "ZaikoKbn").val(data[0].zaiko_kbn);
                    if ($(jqleft + "UtiwakeKbnCd").val() == '') {
                        $(jqleft + "UtiwakeKbnCd").val('10');
                    }
                    $(jqleft + "KazeiKbnCd").val(data[0].kazei_kbn_cd);
                    zeiritu_kettei(idleft);
                    $(jqleft + "Tanka").change();
                    //alert("/"+data[0].uri_genka+"/");
                    if (1 * gyou + 1 >= imax) {
                        addMitumoriMeisaiDt();
                    }//新規行を追加しておく
                } else {
                    //選択肢をクリアしてから追加する
                    $('#ShouhinMrsOptions > option').remove();
                    for (var i = 0; i < data.length; i++) {
                        $('#ShouhinMrsOptions').append('<option value="' + data[i].cd + '">' + data[i].cd + ':' + data[i].name + '</option>');
                    }
                    $(jqleft + "Tekiyou").val('>>エラー:未登録');
//alert(';'+$(jqleft+"ShouhinMrCd").val()+';'+data[0].cd+';');
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
    var idleft = 'fieldMitumoriMeisaiDts';
    var gyou = 0
    if (lastfocusin == 'F7') {
        lastfocusin = lastfocusout;
    }
    if (lastfocusin.substr(0, 22) == idmeisaif) {
        gyou = 1 * (lastfocusin.substr(22, 10).match(/^\d+/)); // alert(gyou); // 22桁目から連続した数字を得る正規表現
    }
    if ($(jqmeisaif + gyou + "ShouhinMrCd").val() == '') {
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
                    alert('エラー:構成部品が未登録');
                } else {
                    if ($(jqmeisaif + gyou + 'UtiwakeKbnCd').val() == 20 || $(jqmeisaif + gyou + 'UtiwakeKbnCd').val() == 24) { // 1行目が内部生産
                        $(jqmeisaif + gyou + 'Gentanka').val(0); // 買い単価は0
                        $(jqmeisaif + gyou + 'Tanka').val(0); // 買い単価は0
                        $(jqmeisaif + gyou + 'Kingaku').val(0); // 買い金額は0
                        $(jqmeisaif + gyou + 'ZeirituMrCd').val(90); // 税率対象外
                    }
                    $(jqmeisaif + gyou + 'Kousei').val('-');
                    $(jqmeisaif + gyou + 'Kousei').addClass('kousei_oya');
                    for (var i = 1; i - 1 < data.length; i++) {
                        if (i + gyou >= imax) { //新規行を追加
                            addMitumoriMeisaiDt();
                        }
                        $('#tr_mitumori_meisai_dt_' + (i + gyou)).addClass('kodomo' + gyou);
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
                        $(jqmeisaif + (i + gyou) + 'Suuryou').val($(jqmeisaif + gyou + 'Suuryou' + $(jqmeisaif + gyou + 'ZaikoKbn').val()).val()); //
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
                        if ($(jqmeisaif + (i + gyou) + 'UtiwakeKbnCd').val() == 20 ||
                            $(jqmeisaif + (i + gyou) + 'UtiwakeKbnCd').val() == 24 ||
                            $(jqmeisaif + (i + gyou) + 'UtiwakeKbnCd').val() == 21) { // 受託加工生産か支給原料
                            $(jqmeisaif + (i + gyou) + 'Gentanka').val(0);
                            $(jqmeisaif + (i + gyou) + 'Tanka').val(0);
                        } else if ($(jqmeisaif + (i + gyou) + 'UtiwakeKbnCd').val() == '30') { // 積算の時
                            $(jqmeisaif + (i + gyou) + 'Gentanka').val(data[i - 1].gen_shouhin_mr.shiire_tanka);
                            $(jqmeisaif + (i + gyou) + 'Tanka').val(0);//data[i - 1].gen_shouhin_mr.hyoujun_genka);
                        } else {
                            $(jqmeisaif + (i + gyou) + 'Gentanka').val(data[i - 1].gen_shouhin_mr.uri_genka);
                            $(jqmeisaif + (i + gyou) + 'Tanka').val(data[i - 1].gen_shouhin_mr[tanka_shurui_kbns[$("#fieldTankaShuruiKbnCd").val()]]);//tanka_shurui_kbn_cdによって選ぶ
                        }
                        $(jqmeisaif + (i + gyou) + 'SoukoMrCd').val(data[i - 1].gen_shouhin_mr.shu_souko_mr_cd);
                        if ($(jqmeisaif + (i + gyou) + 'UtiwakeKbnCd').val() == '') {
                            $(jqmeisaif + i + "UtiwakeKbnCd").val('10');
                        }
                        var zaiko_kbnx = 3 - $(jqmeisaif + (i + gyou) + 'ZaikoKbn').val();
                        if (data[i - 1].keisu == 1 && $($(jqmeisaif + (i + gyou) + 'TanniMr' + zaiko_kbnx + 'Cd' == jqmeisaif + gyou + 'TanniMr' + zaiko_kbn0x + 'Cd').val()).val()) {
                            $(jqmeisaif + (i + gyou) + 'Suuryou' + zaiko_kbnx).val($(jqmeisaif + gyou + 'Suuryou' + zaiko_kbn0x).val());
                            $(jqmeisaif + (i + gyou) + 'Lot').val($(jqmeisaif + gyou + 'Lot').val());
                            $(jqmeisaif + (i + gyou) + 'Iro').val($(jqmeisaif + gyou + 'Iro').val());
                            $(jqmeisaif + (i + gyou) + 'Iromei').val($(jqmeisaif + gyou + 'Iromei').val());
                            // $(jqmeisaif+(i+gyou)+'HinsituKbnCd').val($(jqmeisaif+gyou+'HinsituKbnCd').val());
                        }
                        $(jqmeisaif + (i + gyou) + 'Tanka').change();
                        $(jqmeisaif + (i + gyou) + 'Suuryou').change();
                    }
                    if (i + gyou >= imax) {
                        addMitumoriMeisaiDt();
                    }//新規行を追加しておく
//					$(jqmeisaif+'Suuryou2').change();
                }
            },
            error: function (xhr, status, err) {
                alert('>システムエラー' + status + '/' + err);
            },
        });
    }
};

$(document).on('click', '.kousei_oya', function () {
    var gyou = 1 * (lastfocusin.substr(22, 10).match(/^\d+/));
    if ($(this).val() == '-') {
        $("#meisaiTable tr[class='kodomo" + gyou + "']").hide();
        $(this).val('+');
    } else {
        $("#meisaiTable tr[class='kodomo" + gyou + "']").show();
        $(this).val('-');
    }
});


/* モーダルダイヤログ部分 */
function f8key() {
    if (lastfocusin == "fieldCd") { /* 見積コード選択 */
        modalstart(mitumori_dts_modal, "見積伝票選択");
    } else if (lastfocusin == "fieldTokuisakiMrCd") { /* 得意先コード選択 */
        modalstart(tokuisaki_mrs_modal, "得意先選択");
    } else if (lastfocusin.slice(-11) == "ShouhinMrCd") { /* 商品コード選択 */
        modalstart(shouhin_mrs_modal, "商品選択");
    } else if (lastfocusin == "fieldMitumoribi") { /* 見積日選択 */
        open_datepicker();
    } else if (lastfocusin == "fieldZeirituTekiyoubi") { /* 税率適用日選択 */
        open_datepicker();
    }
}

function open_datepicker() {
    $("#" + lastfocusin).datepicker({
        dateFormat: 'yy-mm-dd',
        onSelect: function () {
            $("#" + lastfocusin).focus();
        },
        onClose: function () {
            $("#" + lastfocusin).datepicker('destroy');
        }
    });
    $("#" + lastfocusin).datepicker('show');
}

function modalstart(url, title) {
    $('#iframe-title').text(title);
    $('#iframe-wrap').fadeIn();
    $('#iframe-body').html('<iframe src="' + url + '?cd=' + $("#" + lastfocusin).val() + '" width="100%" height="100%" style="border: none;">');
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
                $("#" + lastfocusin).val(retval);
                $("#" + lastfocusin).change();
            }
        }
    );
    $('#iframe-bg').fadeOut();
    $("#" + lastfocusin).focus().select();
}

$(function () { // モーダルウィンドウをドラッグで移動できる
    $("#iframe-wrap").draggable({
        handle: ".modal-header"
    });
});

/* スタンプチェックボックスの動作 */
$(".stamp-btn").children('input').change(function () {
    if ($(this).prop('checked')) {
        $(".stamp-btn").children().not(this).prop('checked', false); // 内部値変化
        $(".stamp-btn").not($(this).parent()).removeClass('active'); // 表示変化
        $("#stamp").val($(this).attr('id').slice(-1)); //右から１文字切り出し
    } else {
        $("#stamp").val(0);
    }
// alert($("#stamp").val()+$(this).attr('id'));
});

function set_stamp() {
    $("#stamp" + $("#stamp").val()).prop('checked', true);
    $("#lbl_stamp" + $("#stamp").val()).addClass('active'); // 表示変化
}

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

function zeiritu_kettei(idleft) { //税率決定（行指定）
    var jqleft = '#' + idleft;
    if ($(jqleft + 'UtiwakeKbnCd').val() >= 20 && $(jqleft + 'UtiwakeKbnCd').val() <= 50) { // 加工支給預りメモ等は税率は外０
        $(jqleft + "ZeirituMrCd").children().remove(); //option消去
        $(jqleft + "ZeirituMrCd").append($("<option>").val("90").text("90=外0%"));
    } else if ($('#fieldZeiTenkaKbnCd').val() == '30') { //輸出なら
        $(jqleft + "ZeirituMrCd").children().remove(); //option消去
        $(jqleft + "ZeirituMrCd").append($("<option>").val("70").text("70=輸出"));
    } else {
        var kijunbi = $("#fieldMitumoribi").val();
        if ($("#fieldZeirituTekiyoubi").val() != '' && $("#fieldKijunbi").val() != '0000-00-00') {
            kijunbi = $("#fieldZeirituTekiyoubi").val();
        }
        var date_kijunbi = new Date(kijunbi.replace(/-/g, '/'));
        var selected_cd = $(jqleft + "ZeirituMrCd").val();
        var kazei_kbn_cd = $(jqleft + 'KazeiKbnCd').val();
        var select_cd = '';
        $(jqleft + "ZeirituMrCd").val('');
        $(jqleft + "ZeirituMrCd").children().remove();
        for (var i in zeiritu_mrs) {
            if (zeiritu_mrs[i]['cd'] != '70') { //輸出以外を追加
                $(jqleft + "ZeirituMrCd").append($("<option>").val(zeiritu_mrs[i]['cd']).text(zeiritu_mrs[i]['disp']));
                if (selected_cd == zeiritu_mrs[i]['cd']) {
                    select_cd = selected_cd;
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

$("[id$='UtiwakeKbnCd']").change(function () { //内訳区分が変更されたら
    var idleft = $(this).attr("id").slice(0, -12); //fieldMitumoriMeisaiDts0UtiwakeKbnCd 右から12桁消す
    var jqleft = '#' + idleft;
    $(jqleft + "ZeirituMrCd").val("");
    zeiritu_kettei(idleft); // 税率を設定し直し
});

$("[id$='Suuryou']").change(function () { //元数量が変更されたら
    var idleft = $(this).attr("id").slice(0, -7); //fieldMitumoriMeisaiDts0Suuryou 右から7桁消す
    suu_keisu_change(idleft);
});

$("[id$='Keisu']").change(function () { //係数が変更されたら
    var idleft = $(this).attr("id").slice(0, -5); //fieldMitumoriMeisaiDts0Keisu 右から5桁消す
    suu_keisu_change(idleft);
});

function suu_keisu_change(idleft) { //元数量か係数が変更された時の共通処理
    var jqleft = '#' + idleft;
    if (1 * $(jqleft + "Keisu").val() !== 0 && 1 * $(jqleft + "Suuryou").val().replace(/,/g, '') !== 0) {
        var suufld = $(jqleft + "Suuryou" + $(jqleft + "TankaKbn").val());
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
    var idleft = $(this).attr("id").slice(0, -6); //fieldMitumoriMeisaiDts0Irisuu 右から6桁消す
    var jqleft = '#' + idleft;
    if (1 * $(jqleft + "Suuryou2").val().replace(/,/g, '') == 0) {
        $(jqleft + "Suuryou2").val(1 * $(this).val().replace(/,/g, '') * $(jqleft + "Suuryou1").val().replace(/,/g, ''));
        $(jqleft + "Suuryou2").change();
    }
});

$("[id$='Suuryou1']").change(function () { //数量1が変更されたら
    var idleft = $(this).attr("id").slice(0, -8); //fieldMitumoriMeisaiDts0Suuryou1 右から8桁消す
    var jqleft = '#' + idleft;
    var suu1 = 1 * $(this).val().replace(/,/g, '');//カンマ編集を一旦戻す
    if (1 * $(jqleft + "Irisuu").val().replace(/,/g, '') != 0) {
        $(jqleft + "Suuryou2").val(suu1 * $(jqleft + "Irisuu").val().replace(/,/g, ''));
    }
    $(jqleft + "Suuryou2").change();
    var sh1 = $(jqleft + "Suu1Shousuu").val(); // 小数桁を揃える
    $(this).val(Intl.NumberFormat("ja-JP", {minimumFractionDigits: sh1, maximumFractionDigits: sh1}).format(suu1));//カンマ編集
});

$("[id$='Suuryou2']").change(function () { //数量2が変更されたら
    var idleft = $(this).attr("id").slice(0, -8); //fieldMitumoriMeisaiDts0Suuryou2 右から8桁消す
    var jqleft = '#' + idleft;
    var suu2 = $(this).val().replace(/,/g, '');//カンマ編集を一旦戻す
    var sh2 = $(jqleft + "Suu2Shousuu").val(); // 小数桁を揃える
    $(this).val(Intl.NumberFormat("ja-JP", {minimumFractionDigits: sh2, maximumFractionDigits: sh2}).format(suu2));//カンマ編集
    suu1or2change(idleft); // 行金額再計算
});

function suu1or2change(idleft) {
    if ($("#" + idleft + "UtiwakeKbnCd").val() == 20 || $("#" + idleft + "UtiwakeKbnCd").val() == 10) { // 内部生産 or通常の積算
        var zaiko_kbn0 = $("#" + idleft + "ZaikoKbn").val();
        var gyou = 1 * idleft.slice(22);
        var goukeisuuryou = 0;
        var goukeisuuryou1 = $("#" + idleft + "Suuryou1").val().replace(/,/g, '');
        var goukeisuuryou2 = $("#" + idleft + "Suuryou2").val().replace(/,/g, '');

        goukeisuuryou = zaiko_kbn0 == 1 ? goukeisuuryou1 : goukeisuuryou2;

        for (i = gyou + 1; i < imax; i++) {

            if (($("#" + idleft + "UtiwakeKbnCd").val() == 20 && ($(jqmeisaif + i + "UtiwakeKbnCd").val() == 10 || $(jqmeisaif + i + "UtiwakeKbnCd").val() == 21)
                || $("#" + idleft + "UtiwakeKbnCd").val() == 10 && $(jqmeisaif + i + "UtiwakeKbnCd").val() == 30)
                && 1 * $(jqmeisaif + i + "Keisu").val() != 0) {
                $(jqmeisaif + i + 'Suuryou').val(goukeisuuryou);
                var tanka_kbn = $(jqmeisaif + i + 'TankaKbn').val();
                var sh = $(jqmeisaif + i + "Suu" + tanka_kbn + "Shousuu").val(); // 小数桁を揃える
                $(jqmeisaif + i + 'Suuryou' + tanka_kbn).val(Intl.NumberFormat("ja-JP", {
                    minimumFractionDigits: sh,
                    maximumFractionDigits: sh
                }).format($(jqmeisaif + i + "Keisu").val().replace(/,/g, '') * goukeisuuryou));
                // $(jqmeisaif + i + 'Kingaku').val($(jqmeisaif + i + "Suuryou" + tanka_kbn).val().replace(/,/g, '') * $(jqmeisaif + i + "Tanka").val().replace(/,/g, ''));
                // $(jqmeisaif + i + "Suuryou2").change();
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
    var idleft = $(this).attr("id").slice(0, -8); //fieldShiireMeisaiDts0TankaKbn 右から8桁消す
    gyou_kingaku_saikeisan(idleft); // 行金額再計算
    denpyou_goukei_saikeisan(); // 伝票合計再計算
});

function gyou_kingaku_saikeisan(idleft) { // 行金額再計算
    var suufld = $("#" + idleft + "Suuryou" + $("#" + idleft + "TankaKbn").val());
    $("#" + idleft + "Kingaku").val(Math.round(1000 * suufld.val().replace(/,/g, '')) * Math.round(1000 * $("#" + idleft + "Tanka").val().replace(/,/g, '')) / 1000000); //金額=数量*単価
    $('#' + idleft + 'TanniMr1Cd').change();
    gyou_kingaku_kanma(idleft); // 行金額端数処理カンマ編集
}

$("[id$='TankaKbn']").change(function () { //単価区分が変更されたら
    var idleft = $(this).attr("id").slice(0, -8); //fieldMitumoriMeisaiDts0TankaKbn 右から8桁消す
    var jqleft = '#' + idleft;
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
    var idleft = $(this).attr("id").slice(0, -10); //fieldMitumoriMeisaiDts0TanniMr1Cd 右から10桁消す
    var jqleft = '#' + idleft;
    var tanka_kbn = $(jqleft + 'TankaKbn');
    var tanka_kbn_sel = tanka_kbn.val();
    tanka_kbn.children().remove();
    tanka_kbn.append($("<option>").val('1').text('/' + $(jqleft + 'TanniMr1Cd option:selected').text()));
    tanka_kbn.append($("<option>").val('2').text('/' + $(jqleft + 'TanniMr2Cd option:selected').text()));
    tanka_kbn.val(tanka_kbn_sel);
});

$("[id$='TanniMr2Cd']").change(function () { //単位2が変更されたら
    var idleft = $(this).attr("id").slice(0, -10); //fieldMitumoriMeisaiDts0TanniMr1Cd 右から10桁消す
    var jqleft = '#' + idleft;
    $(jqleft + 'TanniMr1Cd').change();
});

$("[id$='Gentanka']").change(function () { //原単価が変更されたら
    var idleft = $(this).attr("id").slice(0, -8); //fieldMitumoriMeisaiDts0Gentanka 右から8桁消す
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
    var idleft = $(this).attr("id").slice(0, -5); //fieldMitumoriMeisaiDts0Tanka 右から5桁消す
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
    var idleft = $(this).attr("id").slice(0, -7); //fieldMitumoriMeisaiDts0Kingaku 右から7桁消す
    var jqleft = '#' + idleft;
    gyou_kingaku_kanma(idleft); // 行金額端数処理カンマ編集
    denpyou_goukei_saikeisan(); // 伝票合計再計算
});

function gyou_kingaku_kanma(idleft) { // 行金額端数処理カンマ編集
    var jqleft = '#' + idleft;
    var kingaku = 1.0 * $(jqleft + "Kingaku").val().replace(/,/g, ''); //カンマ編集を一旦戻す
    switch (1 * $("#gaku_hasuu_shori_kbn_cd").val()) {
        case 1:
            kingaku = Math.floor(kingaku);
            break;//切り捨て
        case 2:
            kingaku = Math.ceil(kingaku);
            break;//切り上げ
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
                $(jqleft + "Zeigaku").val(Math.floor(kingaku / (1 + zeiritu) * zeiritu));
                break;//切り捨て
            case 2:
                $(jqleft + "Zeigaku").val(Math.ceil(kingaku / (1 + zeiritu) * zeiritu));
                break;//切り上げ
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
                $(jqleft + "Zeigaku").val(Math.floor(kingaku * zeiritu));
                break;//切り捨て
            case 2:
                $(jqleft + "Zeigaku").val(Math.ceil(kingaku * zeiritu));
                break;//切り上げ
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
                switch (1 * $("#zei_hasuu_shori_kbn_cd").val()) {
                    case 1:
                        zeigaku = Math.floor(1 * ritubetugaku[ritukey] / (1 + zeiritu) * zeiritu);
                        break;//切り捨て
                    case 2:
                        zeigaku = Math.ceil(1 * ritubetugaku[ritukey] / (1 + zeiritu) * zeiritu);
                        break;//切り上げ
                    default:
                        zeigaku = Math.round(1 * ritubetugaku[ritukey] / (1 + zeiritu) * zeiritu);
                        break;//四捨五入
                }
                shouhizeigaku2 += zeigaku;
            }
            zeinukigaku = goukeigaku - shouhizeigaku2; // 税抜額を再計算
            $("#zei_chousei_gaku").val(shouhizeigaku2 - shouhizeigaku);
            $("#zeinuki_chousei_gaku").val(shouhizeigaku - shouhizeigaku2);
        } else {										//外税
            for (var ritukey in ritubetugaku) {
                zeiritu = 0.01 * cd_zeiritu[ritukey];
                switch (1 * $("#zei_hasuu_shori_kbn_cd").val()) {
                    case 1:
                        zeigaku = Math.floor(1 * ritubetugaku[ritukey] * zeiritu);
                        break;//切り捨て
                    case 2:
                        zeigaku = Math.ceil(1 * ritubetugaku[ritukey] * zeiritu);
                        break;//切り上げ
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
        $.ajax({
            type: "POST",
            url: report_zaiko_vws_ajaxGet,
            data: {'cd': $(this).val(),},
            async: true,
            dataType: 'json',
            success: function (data) {
                $('#fieldGenzaiko').val(data);
            },
            error: function (xhr, status, err) {
                alert('エラー Cd.change.ajax ' + status + '/' + err);
            },
        });
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
            org_width = $(this).width();
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
    'cd', 'mitumoribi', 'zeiritu_tekiyoubi', 'gotantousha', 'keishou', 'tel', 'fax', 'torihiki_kbn_cd', 'zei_tenka_kbn_cd',
    'kenmei', 'nounyuu_kigen', 'nounyuu_basho', 'torihiki_houhou', 'yuukou_kigen', 'tekiyou', 'kingaku_meishou',
    '[cd', '[utiwake_kbn_cd', '[kousei', '[shouhin_mr_cd', '[tekiyou', '[iro', '[iromei', '[lot', '[kobetucd', '[hinsitu_kbn_cd', '[suuryou', '[keisu', '[irisuu', '[suuryou1',
    '[tanni_mr1_cd', '[suuryou2', '[tanni_mr2_cd', '[mitumorizan', '[gentanka', '[tanka', '[kingaku', '[zeiritu_mr_cd', '[bikou'
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
            ro_field_name = 'data[mitumori_meisai_dts][0]' + ro_fields[j] + ']';
            rewidths[ro_fields[j]] = $("[name='" + ro_field_name + "']").outerWidth();
        }
    }
    $.ajax({
        type: "POST",
        url: readonlys_ajaxSave,
        data: {
            'controller_cd': 'MitumoriDts',
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

//実験
$('#fieldGoukeigaku').click(function () {
//	document.getElementById('objPDF').src = "http://192.168.22.222/erphalcon/temp/tel20170705.pdf";
    window.print();
});
