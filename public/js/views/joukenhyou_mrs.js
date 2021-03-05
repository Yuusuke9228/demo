$('#fieldShouhinMrCd').change(function() { //商品台帳索引
//	alert($(this).val()); //''の場合、'0'など1桁の場合または結果が複数の場合、結果が1個の場合、結果が0個の場合
	if ($(this).val() != '') {
		$.ajax({
			type:"POST",
			url:shouhin_mrs_ajaxGet,
			data:{'cd':$(this).val(),},
			async:true,
			dataType:'json',
			success: function (data) {
				if(data.length >= 1 && $('#fieldShouhinMrCd').val() === data[0].cd){
					if ($('#fieldShouhinMrName').val()=="") { // 複写で新規のとき
						if (data[0].joukenhyou_cnt == 0) {
							$('#fieldShouhinMrName').val(data[0].name);
							$('#id').val(data[0].id);
							$('#F12').prop('disabled',false);
						} else {
							alert("条件表の登録があります。削除後にしてください。");
						}
					} else {
						location.href = joukenhyou_mrs_editg + data[0].id;
					}
				} else {
					$('#fieldShouhinMrCd').focus().select();
				}
			},
			error: function(xhr, status, err) {
				alert('エラー Cd.change.ajax '+status+'/'+err);
			},
		});
	}
});

/* モーダルダイヤログ部分 */
function f8key() {
	if (lastfocusin == "fieldShouhinMrCd") { /* 商品コード選択 */
		modalstart(shouhin_mrs_modal,"商品選択");
	}
}

function modalstart(url,title) {
	$('#iframe-title').text(title);
    $('#iframe-wrap').fadeIn();
    $('#iframe-body').html('<iframe src="' + url + '?cd=' + $('#'+lastfocusin).val() + '" width="100%" height="100%" style="border: none;">');
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
