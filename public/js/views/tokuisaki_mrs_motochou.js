window.onload=function () {
    // 表の金額を取得する(tdの奇数列を取得)
    var pricelist = $("table td[class=price]").map(function(index, val){
        var price = parseInt($(val).text());
        if(price >= 0) {
            return price;
        } else {
            return null;
        }
    });
    // 価格の合計を求める
    var total = 0;
    pricelist.each(function(index, val){
        total = total + val;
    });
}
$("#fieldSeikyuusakiMrCd").change(function ()
{ //請求先マスター索引
    //alert("AAA:".$(this).attr("id")); //''の場合、'0'など1桁の場合または結果が複数の場合、結果が1個の場合、結果が0個の場合
    if ($(this).val() == '')
    {
        $("#fieldSeikyuusakiMrName").val("");
    } else
    {
        $.ajax({
            type: "POST",
            url: tokuisaki_mrs_ajaxGet,
            data: { 'cd': $(this).val(), },
            async: true,
            dataType: 'json',
            success: function (data)
            {
                if (data.length == 0)
                {
                    alert('>>エラーA:未登録');
                } else if (data.length == 1 || $("#fieldSeikyuusakiMrCd").val() === data[0].cd)
                {
                    //選択肢をクリアしてから追加する
                    $('#TokuisakiMrsOptions > option').remove();
                    for (var i = 0; i < data.length; i++)
                    {
                        $('#TokuisakiMrsOptions').append('<option value="' + data[i].cd + '">' + data[i].cd + ':' + data[i].name + '</option>');
                    }
                    $("#fieldSeikyuusakiCd").val(data[0].seikyuusaki_mr_cd);
                    for (var i in data)
                    {
                        if (data[i].cd == data[i].seikyuusaki_mr_cd)
                        {
                            break;
                        }
                    }
                    $("#fieldSeikyuusakiMrName").val(data[i].name);
                } else
                {
                    //選択肢をクリアしてから追加する
                    $('#TokuisakiMrsOptions > option').remove();
                    for (var i = 0; i < data.length; i++)
                    {
                        $('#TokuisakiMrsOptions').append('<option value="' + data[i].cd + '">' + data[i].cd + ':' + data[i].name + '</option>');
                    }
                    $("#fieldSeikyuusakiMrName").val('>>エラー:未登録');
                    $("#fieldSeikyuusakiMrCd").focus().select();
                }
            },
            error: function (xhr, status, err)
            {
                alert('>エラーA' + status + '/' + err);
            },
        });
    }
});

$("#fieldTokuisakiMrCd").change(function ()
{ //得意先マスター索引
    //alert("AAA:".$(this).attr("id")); //''の場合、'0'など1桁の場合または結果が複数の場合、結果が1個の場合、結果が0個の場合
    if ($(this).val() == '')
    {
        $("#fieldTokuisakiName").val("");
    } else
    {
        $.ajax({
            type: "POST",
            url: tokuisaki_mrs_ajaxGet,
            data: { 'cd': $(this).val(), },
            async: true,
            dataType: 'json',
            success: function (data)
            {
                if (data.length == 0)
                {
                    alert('>>エラーB:未登録');
                } else if (data.length == 1 || $("#fieldTokuisakiMrCd").val() === data[0].cd)
                {
                    //選択肢をクリアしてから追加する
                    $('#TokuisakiMrsOptions > option').remove();
                    for (var i = 0; i < data.length; i++)
                    {
                        $('#TokuisakiMrsOptions').append('<option value="' + data[i].cd + '">' + data[i].cd + ':' + data[i].name + '</option>');
                    }
                    $("#fieldTokuisakiMrCd").val(data[0].cd);
                    $("#fieldTokuisakiMrName").val(data[0].name);
                } else
                {
                    //選択肢をクリアしてから追加する
                    $('#TokuisakiMrsOptions > option').remove();
                    for (var i = 0; i < data.length; i++)
                    {
                        $('#TokuisakiMrsOptions').append('<option value="' + data[i].cd + '">' + data[i].cd + ':' + data[i].name + '</option>');
                    }
                    $("#fieldTokuisakiMrName").val('>>エラー:未登録');
                    $("#fieldTokuisakiMrCd").focus().select();
                }
            },
            error: function (xhr, status, err)
            {
                alert('>エラーB' + status + '/' + err);
            },
        });
    }
});

/* 月度をクリックするとその月の明細を表示に変える */
$(".zoom_meisai").click(function ()
{
    $("#hiddenSeikyuusakiMrCd").val($("#fieldSeikyuusakiMrCd").val());
    $("#hiddenTokuisakiMrCd").val($("#fieldTokuisakiMrCd").val());
    $("#hiddenKikanSiteiKbnCd").val("1213");
    $("#hiddenKikanFrom").val($(this).text().substr(0, 10));
    $("#hiddenKikanTo").val($(this).text().substr(-10, 10));
    $("#hiddenHyoujiFlg").val(2);
    $("#hidden_form").submit();
});

$('#fieldKikanSiteiKbnCd').change(function ()
{ //期間指定区分を索引
    $.ajax({
        type: "POST",
        url: kikan_sitei_kbns_ajaxGet,
        data: { 'cd': $(this).val(), },
        async: true,
        dataType: 'json',
        success: function (data)
        {
            if (data.kikan_from != "0000-00-00")
            {
                $("[name='kikan_from']").val(data.kikan_from)
            }
            ;
            if (data.kikan_to != "0000-00-00")
            {
                $("[name='kikan_to']").val(data.kikan_to)
            }
            ;
        },
        error: function (xhr, status, err)
        {
            alert('>エラー2:' + status + '/' + err);
        },
    });
});

$("#fieldKikanFrom").change(function ()
{ //期間からが変更されたら
    $("[name='kikan_sitei_kbn_cd']").val($("[name='kikan_sitei_kbn_cd']").val().substr(0, 2) + '19'); // 1219:任意の期間
});

$("#fieldKikanTo").change(function ()
{ //期間からが変更されたら
    $("[name='kikan_sitei_kbn_cd']").val($("[name='kikan_sitei_kbn_cd']").val().substr(0, 2) + '19'); // 1219:任意の期間
});

/* モーダルダイヤログ部分 */
function f8key()
{
    if (lastfocusin == "fieldSeikyuusakiMrCd")
    { /* 請求先コード選択 */
        modalstart(tokuisaki_mrs_modal, "請求先選択");
    } else if (lastfocusin == "fieldShouhinMrCd")
    { /* 商品コード選択 */
        modalstart(shouhin_mrs_modal, "商品選択");
    } else if (lastfocusin == "fieldToShouhinMrCd")
    { /* 商品至コード選択 */
        modalstart(shouhin_mrs_modal, "至商品選択");
    } else if (lastfocusin == "fieldKikanFrom")
    { /* 期間自選択 */
        open_datepicker();
    } else if (lastfocusin == "fieldKikanTo")
    { /* 期間至選択 */
        open_datepicker();
    }
}

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

function modalstart(url, title)
{
    $('#iframe-title').text(title);
    $('#iframe-wrap').fadeIn();
    $('#iframe-body').html('<iframe src="' + url + '?cd=' + $('#' + lastfocusin).val() + '" width="100%" height="100%" style="border: none;">');
    $('#iframe-bg').fadeTo('normal', 0.5);
    $('#iframe-body iframe').load(function ()
    {
        $(this).contents().find('#header, #footer').hide();
    });
    return false;
}

$('#iframe-wrap button').click(function ()
{ /* 中止して終わる (X) */
    $('#iframe-bg, #iframe-wrap').fadeOut();
});

function fromModal(retval)
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
        }
    );
    $('#iframe-bg').fadeOut();
    $('#' + lastfocusin).focus().select();
}

$(function ()
{ // モーダルウィンドウをドラッグで移動できる
    $("#iframe-wrap").draggable({
        handle: ".modal-header"
    });
});

/* 画面内計算 */
$("#fieldHyoujiFlg").change(function ()
{ //表示フラグが変更されたら
    if ($(this).val() !== '3') {
        $('#joutai').attr('disabled', true);
        $('#keshikomi_joutai').attr('disabled', true);
    } else {
        $('#joutai').attr('disabled', false);
        $('#keshikomi_joutai').attr('disabled', false);
    }
    if ($(this).val() == "1")
    {
        $("#fieldKikanFrom").val("2016-01-01"); //
    }
});

//チェックボックスが変更されたら、消込
$(':checkbox').change(function ()
{
    var thisChk = this;
    if ($(this).attr('id') === 'kesuchk') {
        // if ($(this).prop('checked')) {
        //     $(this).addClass('cs_checkbox')
        // } else {
        //     $(this).removeClass('cs_checkbox')
        // }
        let tmpNyuukingaku = $('#tmpNyuukinKesikomi').text().replace(/,/g, '');
        console.log(tmpNyuukingaku);
        let tmpSai = $('#tmpSai').text().replace(/,/g, '');
        console.log(tmpSai);
        let tmpKesikomi = $('#tmpKesikomi').text().replace(/,/g, '');
        console.log(tmpKesikomi);
        $.ajax({
            type: "POST",
            url: nyuukin_kesikomi_dts_ajaxSet,
            data: {'id': $(this).val(), 'kesi_flg': $(this).prop('checked') ? 1 : 0,},
            async: true,
            dataType: 'json',
            success: function (data) {
                if (data.error_cnt > 0) {
                    var message = "";
                    for (var i in data.error_message) {
                        message += "\n" + data.error_message[i];
                    }
                    alert('>>エラーD:件数=' + data.error_cnt + message);
                } else {
                    chkbx_proc(thisChk, data.henka_gaku);
                }
            },
            error: function (xhr, status, err) {
                alert('>エラーD' + status + '/' + err);
            },
        });
    } else {
        // 伝票計表示の場合
        console.log($(this).attr('id'));
        id = $(this).attr('id');
        id = id.replace(/[^0-9]/g, '');
        console.log(id);
        $.ajax({
            type: "post",
            url: nyuukin_kesikomi_dts_ajaxAllSet,
            data: { 'id': id, 'kesi_flg': $(this).prop('checked') ? 1 : 0, },
            async: true,
            dataType: 'json',
            success: (data) => {
                console.log(data);
                if ($(thisChk).prop('checked')) {
                    henka_gaku = $('#uri_gaku_' + id).text().replace(/,/g, '') * 1;
                } else {
                    henka_gaku = $('#uri_gaku_' + id).text().replace(/,/g, '') * -1;
                }
                chkbx_proc(thisChk, henka_gaku, 2);
            },
            error: (xhr, status, err) => {
                console.log('Error > KesikomiAll: ' + status + '/' + err);
            }
        })
    }
});

function chkbx_proc(thisChk, henka_gaku, col = 5)
{
    console.log(thisChk);
    // 入金額と消込額の差異の計算もさせる
    if ($(thisChk).prop('checked'))
    {
        $("#tmpKesikomi").text(Intl.NumberFormat("ja-JP").format(1 * $("#tmpKesikomi").text().replace(/,/g, '') + henka_gaku));
        $("#tmpSai").text(Intl.NumberFormat("ja-JP").format(1 * $("#tmpSai").text().replace(/,/g, '') - henka_gaku));
        $("td", $(thisChk).parent().parent()).eq(col).text("消込済");
    } else
    {
        $("#tmpKesikomi").text(Intl.NumberFormat("ja-JP").format(1 * $("#tmpKesikomi").text().replace(/,/g, '') + henka_gaku));
        $("#tmpSai").text(Intl.NumberFormat("ja-JP").format(1 * $("#tmpSai").text().replace(/,/g, '') - henka_gaku));
        $("td", $(thisChk).parent().parent()).eq(col).text("");
    }

    //次の項目へ自動移動
    var index = $targetElm.index(thisChk);
    for (var i = index + 1;
        i <= $targetElm.length && (!$targetElm.eq(i).isVisible()
            || $targetElm.eq(i).attr("readonly") == "readonly"
            || typeof ($targetElm.eq(i).attr("tabindex")) != "undefined"
        );
        i++)
    {
    }
    if (i <= $targetElm.length)
    {
        index = i;
    }
    $targetElm.eq(index).focus().select();
}

// 入金の横をクリックで消込金額を入れる（×印）
var kesikomi_batsu_flag = false;

$('.kesikomi').click(function ()
{
    let currntId = $(this).attr('id');
    let rowIndex = currntId.replace(/[^0-9^.]/g, "");
    let current_nyuukingaku = $('#nyuukingaku' + rowIndex).text().replace(/,/g, '');
    let tmpNyuukingaku = $('#tmpNyuukinKesikomi').text().replace(/,/g, '');
    let tmpSai = $('#tmpSai').text().replace(/,/g, '');
    let tmpKesikomi = $('#tmpKesikomi').text().replace(/,/g, '');
    console.log('入金額' + tmpNyuukingaku);
    console.log('差異' + tmpSai);
    console.log('消込額' + tmpKesikomi);

    if ($(this).text() === '×') {
        kesikomi_batsu_flag = false;
        $(this).text('');
        $('#tmpNyuukinKesikomi').text(Intl.NumberFormat("ja-JP").format(parseInt(current_nyuukingaku) - parseInt(tmpNyuukingaku)));
        $('#tmpSai').text(Intl.NumberFormat("ja-JP").format(parseInt(current_nyuukingaku) - parseInt(tmpSai)));
    } else if($(this).text() === '＊') {
        console.log("入金消込確定済み番号");
        return false;
    } else {
        // 複数の入金を選択しての消込を許可しない事にする
        // 複数入金選択できないと困るらしい
        // if (kesikomi_batsu_flag) {
        //     window.alert("選択中の入金伝票の消込が未完了です。");
        //     return false;
        // }
        // kesikomi_batsu_flag = true;
        $(this).text('×');
        $('#tmpNyuukinKesikomi').text(Intl.NumberFormat("ja-JP").format(parseInt(current_nyuukingaku) + parseInt(tmpNyuukingaku)));
        $('#tmpSai').text(Intl.NumberFormat("ja-JP").format(parseInt(current_nyuukingaku) + parseInt(tmpSai)));
    }
    console.log(kesikomi_batsu_flag);
});

$(function ()
{ // テーブルのヘッドを消えなくする
    $('table.head_fix').floatThead({
        top: 50
    });
});

$('table tbody tr').click(function ()
{ // クリックした行を目立たせる。table-stripedと共存できない
    $('tr').removeClass('activetr');
    $(this).addClass('activetr');
});

$('#fieldKikanFrom').click(function () {
    $(this).select();
})

$('#fieldKikanTo').click(function () {
    $(this).select();
})