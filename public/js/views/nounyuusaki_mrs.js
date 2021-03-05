$('#fieldCd').change(function() { //納入先台帳索引
//	alert($(this).val()); //''の場合、'0'など1桁の場合または結果が複数の場合、結果が1個の場合、結果が0個の場合
	if ($(this).val() != '') {
		$.ajax({
			type:"POST",
			url:nounyuusaki_mrs_ajaxGet,
			data:{'cd':$(this).val(),},
			async:true,
			dataType:'json',
			success: function (data) {
				if(data.length >= 1 && $('#fieldCd').val() === data[0].cd){
					location.href = nounyuusaki_mrs_edit + data[0].id;
				} else {
					$('#fieldCd').focus().select();
				}
			},
			error: function(xhr, status, err) {
				alert('エラー Cd.change.ajax '+status+'/'+err);
			},
		});
	}
});

/*
 * フリガナ取得 Add By Nishiyama 2019-10-23
*/
$('#fieldName').change(function() {
	var input = $(this).val();
	input = toHalfWidth(input);
	input = zenkakuToHankaku(input);
	if (input !== '') {
		$.ajax({
			type: "POST",
			url: nounyuusakimrs_ajaxKana,
			data: {'input': input,},
			async: true,
			dataType: 'json',
			success: function (data) {
				$('#fieldKana').val(data['kana'].slice(0, -3)); //EOSが入るので消す
			},
			error: function(xhr, status, err) {
				alert('Error: Name.Change.Ajax ' + status + '/' + err);
			},
		});
	}
	$('#fieldRyakushou').val(make_ryakushou(input));
});

/* モーダルダイヤログ部分 */
function f8key() {
	if (lastfocusin == "fieldCd") { /* 納入先コード選択 */
		modalstart(nounyuusaki_mrs_modal,"納入先選択");
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
