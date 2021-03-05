window.onload = function(){
//	if ($('#fieldChouhyouMrIdOrg',parent.document).val()) {
//		$('#fieldId').val($('#fieldChouhyouMrIdOrg',parent.document).val()); // 親画面の帳票IDを得る。a||6 = a?:6 js的３項演算子
//	} else {
		$("#fieldId").prop("selectedIndex", 0); // なければ1番目
//	}
	var titles=$('#fieldId option:selected').text().split('=',2);
	$('#title').text(titles[1]);
}

$('#fieldId').change(function() {
	var titles=$('#fieldId option:selected').text().split('=',2);
	$('#title').text(titles[1]);
});

$('#fieldChouhyouKbnCd').change(function() {
	$.ajax({
		type:"POST",
		url:chouhyou_mrs_ajaxGet,
		data:{'chouhyou_kbn_cd':$(this).val(),},
		async:true,
		dataType:'json',
		success: function (data) {
			if(data.length){
				$('#fieldId > option').remove();
				for ( var i = 0; i < data.length; i++ ) {
					$('#fieldId').append('<option value="' + data[i].id + '">' + data[i]['id'] + '=' + data[i]['name'] + '</option>');
				}
				$('#fieldId').change();
			}
		},
		error: function(xhr, status, err) {
			alert('>システムエラー'+status+'/'+err);
		},
	});
});

function setChouhyou() { // submitボタンで帳票IDをセットして親に戻る
	$('#fieldChouhyouMrId',parent.document).val($('#fieldId').val());
	window.parent.fromModal1($('#fieldId').val());
	return false;
}

function f5key() { // 連続印刷へ推移
	$('#formToRenzoku').submit();
	window.parent.fromModal1();
}
