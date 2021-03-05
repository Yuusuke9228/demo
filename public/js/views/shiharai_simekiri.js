/* モーダルダイヤログ部分 */
function f8key() {
	if (lastfocusin.substr(0,5) == "code_") { /* 操作選択 */
		modalstart(shiiresaki_sime_dts_modal_menu,"操作選択");
	}else if (lastfocusin == "fieldSimeHiduke") { /* 締日選択 */
		open_datepicker();
	}else if (lastfocusin == "fieldShiharaiYoteibi") { /* 支払予定日選択 */
		open_datepicker();
	}
}

function open_datepicker() {
	$('#'+lastfocusin).datepicker({
		dateFormat:'yy-mm-dd',
		onSelect:function(){
			$('#'+lastfocusin).focus();
		},
		onClose:function(){
			$('#'+lastfocusin).datepicker('destroy');
		}
	});
	$('#'+lastfocusin).datepicker('show');
}

function modalstart(url,title, shiiresaki_mr_cd = '') {
	$('#iframe-title').text(title);
    $('#iframe-wrap').fadeIn();
    if (shiiresaki_mr_cd === '') {
        $('#iframe-body').html('<iframe src="' + url + '?cd=' + lastfocusin.substr(5) + '" width="100%" height="100%" style="border: none;">');
    } else {
        $('#iframe-body').html('<iframe src="' + url + '?shiiresaki_mr_cd=' + shiiresaki_mr_cd + '" width="100%" height="100%" style="border: none;">');
    }
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
      function(){//alert("フェードアウト完了")
        if (retval){
          $('#'+lastfocusin).val(retval);
          $('#'+lastfocusin).change();
        }
      }
    );
    $('#iframe-bg').fadeOut();
    $('#'+lastfocusin).focus().select();
}

$(function() { // モーダルウィンドウをドラッグで移動できる
    $("#iframe-wrap").draggable({
        handle: ".modal-header"
    });
});

/* 画面内計算 */

$(':checkbox').change(function() { //チェックボックスが変更されたら
	var thisChk = this;
	//次の項目へ自動移動
	var index = $targetElm.index(thisChk);
	for (var i = index + 1;
		i <= $targetElm.length && (!$targetElm.eq(i).isVisible()
			|| $targetElm.eq(i).attr("readonly")=="readonly"
			|| typeof($targetElm.eq(i).attr("tabindex")) != "undefined"
		);
		i++) { }
	if (i <= $targetElm.length) {index = i;}
	$targetElm.eq(index).focus().select();//alert(index);
});

$('#PgUp').click(function() { //ページアップキー(Ctrl+Shift+Enter)を押したら前行へ移動
        var index = $targetElm.index($("#"+lastfocusin));//alert(index);
        for (i = index - 1; i >= 0 && (!$targetElm.eq(i).isVisible() || typeof($targetElm.eq(i).attr("id")) == "undefined" || $targetElm.eq(i).attr("name").substr(0,5) != "code_") ; i--) { }
        if (i >= 0) {index=i; }
        $targetElm.eq(index).focus().select();
});

$('#PgDn').click(function() { //ページダウンキー(Ctrl+Enter)を押したら次行へ移動
        var index = $targetElm.index($("#"+lastfocusin));//alert(index);
        for (i = index + 1; i <= $targetElm.length && (!$targetElm.eq(i).isVisible() || typeof($targetElm.eq(i).attr("id")) == "undefined" || $targetElm.eq(i).attr("name").substr(0,5) != "code_") ; i++) { }
        if (i <= $targetElm.length) {index = i;}
        $targetElm.eq(index).focus().select();
});

//支払い明細表を開く
$('.shiiresaki_cd').dblclick(function() {
    var id =  $(this).attr("id");
    var id_count = id.replace(/[^0-9]/g, '');
    var shiiresaki_cd = $('#shiiresaki_cd' + id_count).text();
    var data = {
        'shiiresaki_mr_cd': shiiresaki_cd,
        'simebi': $('#fieldSimeHiduke').val(),
    };
    var url = shiharai_meisai;
    var form = document.createElement("form");
    form.setAttribute("action", url);
    form.setAttribute("method", "post");
    form.style.display = "none";
    form.target = "blank";
    document.body.appendChild(form);
    if (data !== undefined) {
        for (var paramName in data) {
            var input = document.createElement('input');
            input.setAttribute('type', 'hidden');
            input.setAttribute('name', paramName);
            input.setAttribute('value', data[paramName]);
            form.appendChild(input);
        }
    }
    form.submit();
});

$('.shiiresaki_cd').bind('contextmenu', function() {
    const id =  $(this).attr("id");
    const id_count = id.replace(/[^0-9]/g, '');
    const shiiresaki_cd = $('#shiiresaki_cd' + id_count).text();
    modalstart(shime_rireki, "締切履歴", shiiresaki_cd);
    return false;
});


$('#fieldShimegrpKbnCd').change(function () {
    $.ajax({
        url: getShiiresakiGroupLastShimeHiduke,
        method: 'post',
        data: { 'grp_kbn': $(this).val() },
        dataType: 'json',
        async: true,
        success: function (res) {
            $('#fieldSimeHiduke').val(res.sime_hiduke);
        },
        error: function (xhr, status, err) {
            console.log('Error: ' + xhr + ' / ' + status + ' / ' + err);
        }
    })
})