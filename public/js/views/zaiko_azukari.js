/* モーダルダイヤログ部分 */
function f8key()
{
    if (lastfocusin === "fieldShouhinMrCd")
    {
        modalstart(shouhin_mrs_modal, "商品一覧");
    } else if (lastfocusin === "fieldTorihikisakiCd")
    {
        modalstart(tokuisaki_mrs_modal, "得意先一覧");
    }
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
{
    $('#iframe-bg, #iframe-wrap').fadeOut();
});

function fromModal(retval)
{
    $('#iframe-wrap').fadeOut(
        function ()
        {//alert("フェードアウト完了")
        }
    );
    $('#iframe-bg').fadeOut();
    $('#' + lastfocusin).focus().select();
    if (retval)
    {
        $('#' + lastfocusin).val(retval);
    }
}

$(function ()
{ // モーダルウィンドウをドラッグで移動できる
    $("#iframe-wrap").draggable({
        handle: ".modal-header"
    });
});

/* 商品コードをクリックするとその明細表示を呼ぶ */
$(".zoom_nyuushukko").click(function ()
{
    $("#nyuushukkoCd").val($(this).text());
    $("#nyuushukkoSoukoMrCd").val($(this).next('td').find('.souko_mr_cd').text()); // 倉庫絞り込み状態で明細表示2019/02/18追加　井浦
    $("#nyuushukko_post").submit();
});

/*
* 商品名をクリックするとその明細表示
*/
$(".zoom_nyuushukko_name").click(function ()
{
    $("#nyuushukkoCd").val($(this).prev('td').text());
    $("#nyuushukkoSoukoMrCd").val($(this).find('.souko_mr_cd').text()); // 倉庫絞り込み状態で明細表示2019/02/18追加　井浦
    $("#nyuushukko_post").submit();
});
