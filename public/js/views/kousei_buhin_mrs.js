function addKouseiBuhinMr() { // alert(imax);
    tr_id = '#tr_kousei_buhin_mr_' + imax;
    id_head = 'fieldKouseiBuhinMrs' + imax;
    name_head = 'data[kousei_buhin_mrs][' + imax + ']';
    $("#tr_kousei_buhin_mr_hidden").clone(true).attr('id', 'tr_kousei_buhin_mr_' + imax).removeAttr('style').insertAfter('#tr_kousei_buhin_mr_' + ((imax > 0) ? imax - 1 : 'hidden'));
    $(tr_id + " #hiddenCd").attr('id', id_head + 'Cd').attr('name', name_head + '[cd]');
    $(tr_id + " #hiddenId").attr('id', id_head + 'Id').attr('name', name_head + '[id]');
    $(tr_id + " #hiddenUpdated").attr('id', id_head + 'Updated').attr('name', name_head + '[updated]');
    $(tr_id + " #hiddenGenShouhinMrId").attr('id', id_head + 'GenShouhinMrId').attr('name', name_head + '[gen_shouhin_mr_id]');
    $(tr_id + " #hiddenGenShouhinMrCd").attr('id', id_head + 'GenShouhinMrCd').attr('name', name_head + '[gen_shouhin_mr_cd]');
    $(tr_id + " #hiddenGenShouhinMrName").attr('id', id_head + 'GenShouhinMrName').attr('name', name_head + '[gen_shouhin_mr_name]');
    $(tr_id + " #hiddenTanniMrCd").attr('id', id_head + 'TanniMrCd').attr('name', name_head + '[tanni_mr_cd]');
    $(tr_id + " #hiddenSuuryou").attr('id', id_head + 'Suuryou').attr('name', name_head + '[suuryou]');
    $(tr_id + " #hiddenMotoTanniMrCd").attr('id', id_head + 'MotoTanniMrCd').attr('name', name_head + '[moto_tanni_mr_cd]');
    $(tr_id + " #hiddenSuuShousuu").attr('id', id_head + 'SuuShousuu').attr('name', name_head + '[suu_shousuu]');
    $(tr_id + " #hiddenHyoujunGenka").attr('id', id_head + 'HyoujunGenka').attr('name', name_head + '[hyoujun_genka]');
    $(tr_id + " #hiddenShiireTanka").attr('id', id_head + 'ShiireTanka').attr('name', name_head + '[shiire_tanka]');
    $(tr_id + " #hiddenUriGenka").attr('id', id_head + 'UriGenka').attr('name', name_head + '[uri_genka]');
    $(tr_id + " #hiddenHyoujunGenkagaku").attr('id', id_head + 'HyoujunGenkagaku').attr('name', name_head + '[hyoujun_genkagaku]');
    $(tr_id + " #hiddenShiireTankagaku").attr('id', id_head + 'ShiireTankagaku').attr('name', name_head + '[shiire_tankagaku]');
    $(tr_id + " #hiddenUriGenkagaku").attr('id', id_head + 'UriGenkagaku').attr('name', name_head + '[uri_genkagaku]');
    $("#" + id_head + 'Cd').val(imax + 1);
    $("#" + id_head + 'Id').val(0);
    $("#fieldBuhinsuu").val(imax);
    imax++; //alert($("#"+id_head+'Id').val());
    $targetElm = $(targetElm);
}

window.onload = function () {
    $(window).resize();
    addKouseiBuhinMr();
    goukei_saikeisan();
}

$('#PgUp').click(function () { //ページアップキーを押したら
    var index = $targetElm.index($("#" + lastfocusin));//alert(index);
    for (i = index - 1; i >= 0 && (!$targetElm.eq(i).isVisible() || $targetElm.eq(i).attr("id").substr(-11) != "ShouhinMrCd"); i--) {
    }
    if (i >= 0) {
        index = i;
    }
    $targetElm.eq(index).focus().select();
})

$('#PgDn').click(function () { //ページダウンキーを押したら
    var index = $targetElm.index($("#" + lastfocusin));//alert(index);
    for (i = index + 1; i <= $targetElm.length && (!$targetElm.eq(i).isVisible() || $targetElm.eq(i).attr("id").substr(-11) != "ShouhinMrCd"); i++) {
    }
    if (i <= $targetElm.length) {
        index = i;
    }
    $targetElm.eq(index).focus().select();
})

$(window).resize(function () { // 印刷で右端が欠けるのでテーブルサイズ可変とした
    var x = $(window).width(); //windowの幅をxに代入
    var y = 740; //windowの分岐幅をyに代入
    if (x <= y + 20) {
        $('#meisaiTable').width(y);
    } else {
        $('#meisaiTable').removeAttr('style');
    }
});

$("[id$='ShouhinMrCd']").change(function () { //商品マスター索引
    //alert("AAA:".$(this).attr("id")); //''の場合、'0'など1桁の場合または結果が複数の場合、結果が1個の場合、結果が0個の場合
    var idleft = $(this).attr("id").slice(0, -11); //fieldKouseiBuhinMrs0GenShouhinMrCd 右から11桁消す
    var gyou = idleft.slice(0, -3).slice(19); //fieldKouseiBuhinMrs0 左から18桁消す
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
                    $("#" + idleft + "ShouhinMrName").val('>>エラー:未登録');
                } else if (data.length == 1 || $("#" + idleft + "ShouhinMrCd").val() === data[0].cd) {
                    //選択肢をクリアしてから追加する
                    $('#ShouhinMrsOptions > option').remove();
                    for (var i = 0; i < data.length; i++) {
                        $('#ShouhinMrsOptions').append('<option value="' + data[i].cd + '">' + data[i].cd + ':' + data[i].name + '</option>');
                    }
                    if (idleft == "field") {
                        $('#fieldShouhinMrName').val(data[0].name);
                        if ($('#id').val() !== '' || ($('#id').val() === '' && data[0].kousei_buhin_cnt > 0)) {
                            location.href = kousei_buhin_mrs_edit + data[0].id;
                        }
                        $('#id').val(data[0].id);   //idを入れないと登録出来ない 2019-11-30
//						$("#"+idleft+"ShouhinMrCd").val(data[0].cd);
//						$("#"+idleft+"ShouhinMrName").val(data[0].name);
//						$("#id").val(data[0].id);
//						$("#fieldTanniMrName").val(data[0].tanni_mr2_cd);
//						$("#fieldHyoujunGenka").val(data[0].hyoujun_genka);
//						$("#fieldShiireTanka").val(data[0].shiire_tanka);
//						$("#fieldUriGenka").val(data[0].uri_genka);
                    } else {
                        console.log(data);
                        $("#" + idleft + "ShouhinMrId").val(data[0].id);
                        $("#" + idleft + "ShouhinMrCd").val(data[0].cd);
                        $("#" + idleft + "ShouhinMrName").val(data[0].name);
                        $("#" + idleft.slice(0, -3) + "TanniMrCd").val(data[0].tanni_mr2_cd);
                        $("#" + idleft.slice(0, -3) + "HyoujunGenka").val(data[0].hyoujun_genka);
                        $("#" + idleft.slice(0, -3) + "ShiireTanka").val(data[0].shiire_tanka);
                        $("#" + idleft.slice(0, -3) + "UriGenka").val(data[0].uri_genka);
                        $("#" + idleft.slice(0, -3) + "SuuShousuu").val(data[0].suu2_shousuu);
                        $("#" + idleft.slice(0, -3) + "Suuryou").change();
                        if (1 * gyou + 1 >= imax) {
                            addKouseiBuhinMr();
                        }//新規行を追加しておく
                    }
                } else {
                    //選択肢をクリアしてから追加する
                    $('#ShouhinMrsOptions > option').remove();
                    for (var i = 0; i < data.length; i++) {
                        $('#ShouhinMrsOptions').append('<option value="' + data[i].cd + '">' + data[i].cd + ':' + data[i].name + '</option>');
                    }
                    $("#" + idleft + "Tekiyou").val('>>エラー:未登録');
//alert(';'+$("#"+idleft+"ShouhinMrCd").val()+';'+data[0].cd+';');
                    $("#" + idleft + "ShouhinMrCd").focus().select();
                }
            },
            error: function (xhr, status, err) {
                $("#" + idleft + "Tekiyou").val('>エラー' + status + '/' + err);
            },
        });
    }
});

/* モーダルダイヤログ部分 */
function f8key() {
    if (lastfocusin.slice(-11) == "ShouhinMrCd") { /* 商品コード選択 */
        modalstart(shouhin_mrs_modal, "商品選択");
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

/* 構成部品画面へ */
function f7key() {
    if (lastfocusin == "fieldShouhinMrCd") {
        $("#fieldGenShouhinMrCd").val($("#fieldShouhinMrCd").val());
        document.index_post.submit();
    } else if (lastfocusin.slice(-11) == "ShouhinMrCd") { /* 商品コード選択 */
        var idleft = lastfocusin.slice(0, -11); //fieldKouseiBuhinMrs0Gen+ShouhinMrCd 右から11桁消す
        location.href = kousei_buhin_mrs_edit + $("#" + idleft + "ShouhinMrId").val();
    }
}


/* 画面内計算 */
$("[id$='Suuryou']").change(function () { //数量が変更されたら
    var idleft = $(this).attr("id").slice(0, -7); //fieldKouseiBuhinMrs0Suuryou 右から7桁消す
    $(this).val($(this).val().replace(/,/g, ''));//カンマ編集を一旦戻す
    sh2 = $("#" + idleft + "SuuShousuu").val(); // 小数桁を揃える
    if ($("#" + idleft + "MotoTanniMrCd").val() == $("#" + idleft + "TanniMrCd").val()) {
        sh1 = sh2;
    } else {
        sh1 = 0;
    }
    $(this).val(Intl.NumberFormat("ja-JP", {
        minimumFractionDigits: sh1,
        maximumFractionDigits: sh2
    }).format($(this).val()));//カンマ編集
    gyou_kingaku_saikeisan(idleft); // 行金額再計算
    goukei_saikeisan(); // 合計再計算
});

function gyou_kingaku_saikeisan(idleft) { // 行金額再計算
    sh0 = $("#tanka_shousuu").val();
    gaku = 1.0 * $("#" + idleft + "Suuryou").val().replace(/,/g, '') * $("#" + idleft + "HyoujunGenka").val().replace(/,/g, ''); //金額=数量*単価
    $("#" + idleft + "HyoujunGenkagaku").val(Intl.NumberFormat("ja-JP", {
        minimumFractionDigits: sh0,
        maximumFractionDigits: sh0
    }).format(gaku)); //カンマ編集
    gaku = 1.0 * $("#" + idleft + "Suuryou").val().replace(/,/g, '') * $("#" + idleft + "ShiireTanka").val().replace(/,/g, ''); //金額=数量*単価
    $("#" + idleft + "ShiireTankagaku").val(Intl.NumberFormat("ja-JP", {
        minimumFractionDigits: sh0,
        maximumFractionDigits: sh0
    }).format(gaku)); //カンマ編集
    gaku = 1.0 * $("#" + idleft + "Suuryou").val().replace(/,/g, '') * $("#" + idleft + "UriGenka").val().replace(/,/g, ''); //金額=数量*単価
    $("#" + idleft + "UriGenkagaku").val(Intl.NumberFormat("ja-JP", {
        minimumFractionDigits: sh0,
        maximumFractionDigits: sh0
    }).format(gaku)); //カンマ編集
}

function goukei_saikeisan() { // 伝票合計再計算
    sh0 = $("#tanka_shousuu").val();
    hyoujun_kei = 0;
    shiire_kei = 0;
    uri_kei = 0;
    for (i = 0; i < imax - 1; i++) {
        hyoujun_kei += 1 * $('#fieldKouseiBuhinMrs' + i + 'HyoujunGenkagaku').val().replace(/,/g, '');
        shiire_kei += 1 * $('#fieldKouseiBuhinMrs' + i + 'ShiireTankagaku').val().replace(/,/g, '');
        uri_kei += 1 * $('#fieldKouseiBuhinMrs' + i + 'UriGenkagaku').val().replace(/,/g, '');
    }
    $("#fieldHyoujunGenkakei").val(Intl.NumberFormat("ja-JP", {
        minimumFractionDigits: sh0,
        maximumFractionDigits: sh0
    }).format(hyoujun_kei));//カンマ編集
    $("#fieldShiireTankakei").val(Intl.NumberFormat("ja-JP", {
        minimumFractionDigits: sh0,
        maximumFractionDigits: sh0
    }).format(shiire_kei));//カンマ編集
    $("#fieldUriGenkakei").val(Intl.NumberFormat("ja-JP", {
        minimumFractionDigits: sh0,
        maximumFractionDigits: sh0
    }).format(uri_kei));//カンマ編集
}

/*
*商品名を入力して移動しようとするとページ推移と取られてしまう。
*Ajaxで別ページを非同期で読んでいるためだと思う。
* 上記理由でコメントアウト Add By Nishiyama 2019/2/15
$(function(){ // 入力途中アラート2019/02/14 井浦
	$("input[type=text]").change(function() {
		$(window).on('beforeunload', function() {
			return '入力途中です。このまま移動しますか？';
		});
	});
	$("input[type=submit]").click(function() {
		$(window).off('beforeunload');
	});
});

*/