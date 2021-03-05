//クリックした倉庫コードと名称をsubimit用formに乗せ、submit
$(".zoom_nyuushukko").click(function() {
    modalstart(shouhin_lot_modal,"全倉庫選択商品在庫",$(this).text(),$(this).next('td').text())
});

$('#iframe-wrap button').click(function () { /* 中止して終わる (X) */
    $('#iframe-bg, #iframe-wrap').fadeOut();
});

function modalstart(url,title,shouhin_cd,shouhin_name) {
    $('#iframe-title').text(title);
    $('#iframe-wrap').fadeIn();
    $('#iframe-body').html('<iframe src="' + url + '?cd=' + shouhin_cd + '&name=' + shouhin_name + '" width="100%" height="100%" style="border: none;">');
    $('#iframe-bg').fadeTo('normal', 0.5);
    $('#iframe-body iframe').load(function () {
        $(this).contents().find('#header, #footer').hide();
    });
    return false;
}

