$('#shouhin_bunrui').change(() => {
    $.ajax({
        type: "post",
        url: junjoKbnsAjaxHanni,
        data: {'cd': $('#shouhin_bunrui').val(),},
        async: true,
        dataType: 'json',
        success: (data) => {
            $('#shouhin_bunrui_from').val(data.from);
            $('#shouhin_bunrui_to').val(data.to);
        },
        error: (xhr, status, err) => {
            alert('Error -> JunjoKbnsAjaxGet: ' + status + '/' + err);
        },
    });
})

function getMikanryouData () {
    $.ajax({
        type: "post",
        url: getHoukokuData,
        data: {'tokuisaki_mr_cd': $('#tokuisaki_mr_cd').val(), 'shiiresaki_mr_cd': $('#shiiresaki_mr_cd'), 'shouhin_bunrui_from': $('#shouhin_bunrui_from').val(), 'shouhin_bunrui_to': $('#shouhin_bunrui_to').val(),},
        async: true,
        dataType: 'json',
        success: (data) => {
            // tableを作る
        },
        error: (xhr, status, err) => {
            alert('Error -> getMikanryouData: ' + status + '/' + err);
        },
    });
}

function printHoukokuData () {

}

/* モーダルダイヤログ部分 */
function f8key() {
	if (lastfocusin === "fieldHanniFrom" || lastfocusin === "fieldHanniTo") { /*  範囲からまで  */
		hanni_modal = base_uri+$("#junjo_kbn_table").val()+"/modal";
		modalstart(hanni_modal);
	}
}

function modalstart(url) {
	$('#iframe-wrap').fadeIn();
	$('#iframe-body').html('<iframe src="' + url + '?cd=' + $('#'+lastfocusin).val() + '" width="100%" height="100%" style="border: none;">');
	$('#iframe-bg').fadeTo('normal', 0.5);
    $('#iframe-body iframe').load(function () {
        $(this).contents().find('#header, #footer').hide();
    });
	return false;
}

$('#iframe-wrap button').click(function () {
	$('#iframe-bg, #iframe-wrap').fadeOut();
});

function fromModal(retval) {
    $('#iframe-wrap').fadeOut(
      function(){
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


function return_value() {
	for (i in flds) {
		window.parent.document.getElementsByName(flds[i])[0].value = ""+$("[name='"+flds[i]+"']").val();
	}
	window.parent.fromModal("submit");
}
