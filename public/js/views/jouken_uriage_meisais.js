$('#fieldCd').change(function() { //条件売上明細を索引
	$("#name").val($("#fieldCd option:selected").text());
	$.ajax({
		type:"POST",
		url:jouken_uriage_meisais_ajaxGet,
		data:{'cd':$(this).val(),},
		async:true,
		dataType:'json',
		success: function (data) {
			if(data.length==0){
				alert('>>エラー:条件未登録');
			}else {
				for (i in flds) {
					if (flds[i].substr(6)!='kikan_') {
						$("[name="+flds[i]+"]").val(data[0][flds[i]]);
					}
				}
				if (data[0].kikan_sitei_kbn_cd && data[0].simekiri_kbn == "0") {
					$("[name='kikan_sitei_kbn_cd']").val(data[0].kikan_sitei_kbn_cd);
					if (data[0].kikan_from != "0000-00-00") {$("[name='kikan_from']").val(data[0].kikan_from);}
					if (data[0].kikan_to != "0000-00-00") {$("[name='kikan_to']").val(data[0].kikan_to);}
					$("[name='kikan_sitei_kbn_cd']").change();
				}
				flg_selUtiwakeKbns();
				$("[name='junjo_kbn_cd']").change();
			}
		},
		error: function(xhr, status, err) {
			alert('>エラー0'+status+'/'+err);
		},
	});
});

$('#fieldKikanSiteiKbnCd').change(function() { //期間指定区分を索引
	$.ajax({
		type:"POST",
		url:kikan_sitei_kbns_ajaxGet,
		data:{'cd':$(this).val(),},
		async:true,
		dataType:'json',
		success: function (data) {
			if (data.kikan_from != "0000-00-00") {$("[name='kikan_from']").val(data.kikan_from)};
			if (data.kikan_to != "0000-00-00") {$("[name='kikan_to']").val(data.kikan_to)};
		},
		error: function(xhr, status, err) {
			alert('>エラー1'+status+'/'+err);
		},
	});
});

$('#fieldJunjoKbnCd').change(function() { //順序区分コード
	if ($(this).val().substr(-2) == "01" || $(this).val().substr(-2) == "02") {
		$("[name='hanni_from']").val("");
		$("[name='hanni_from_name']").val("");
		$("[name='hanni_to']").val("");
		$("[name='hanni_to_name']").val("");
		$("[name='junjo_kbn_table']").val("");
	} else {
		$.ajax({
			type:"POST",
			url:junjo_kbns_ajaxHanni,
			data:{'cd':$(this).val(),},
			async:true,
			dataType:'json',
			success: function (data) {
				$("[name='hanni_from']").val(data.from);
				$("[name='hanni_from_name']").val(data.from_name);
				$("[name='hanni_to']").val(data.to);
				$("[name='hanni_to_name']").val(data.to_name);
				$("[name='junjo_kbn_table']").val(data.junjo_kbn_table);
			},
			error: function(xhr, status, err) {
				alert('>エラー2'+status+'/'+err);
			},
		});
	}
});

$('#fieldHanniFrom, #fieldHanniTo').change(function() { //範囲から,まで
	kore = $(this).attr('id');
	if ($(this).val()=='') {
		$("#"+kore+"Name").val("");
	}else{
		$.ajax({
			type:"POST",
			url:junjo_kbns_ajaxGet,
			data:{'cd':$(this).val(),'target_cd':$('#fieldJunjoKbnCd').val(),},
			async:true,
			dataType:'json',
			success: function (data) {
				if(data.length == 0){
					$('#'+kore+'Name').val('>>エラー:未登録');
				}else if(data.length == 1 || $('#'+kore).val() == data[0].cd) {
					$('#'+kore+'Options > option').remove(); //選択肢をクリアしてから追加する
					for ( var i = 0; i < data.length; i++ ) {
						$('#'+kore+'Options').append('<option value="' + data[i].cd + '">' + data[i].cd + ':' + data[i].name + '</option>');
					}
					$('#'+kore).val(data[0].cd);
					$('#'+kore+'Name').val(data[0].name);
				}else {
					$('#'+kore+'Options > option').remove(); //選択肢をクリアしてから追加する
					for ( var i = 0; i < data.length; i++ ) {
						$('#'+kore+'Options').append('<option value="' + data[i].cd + '">' + data[i].cd + ':' + data[i].name + '</option>');
					}
					$('#'+kore+'Name').val('>>エラー:未登録');
					$('#'+kore).focus().select();
				}
			},
			error: function(xhr, status, err) {
				$('#'+kore+'Name').val('>エラー3'+status+'/'+err);
			},
		});
	}
});

/* モーダルダイヤログ部分 */
function f8key() {
	if (lastfocusin == "fieldHanniFrom" || lastfocusin == "fieldHanniTo") { /*  範囲からまで  */
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
$("#fieldSimekiriKbn").change(function() { //締切区分が変更されたら
	if (1*$(this).val() != 0) { // 0:期間指定ならfalse（入力可）
		$("[name='kikan_sitei_kbn_cd']").disableSelection().attr('readonly', true);
	} else {
		$("[name='kikan_sitei_kbn_cd']").enableSelection().attr('readonly', false);
	}
	$("[name='kikan_from']").attr('readonly', 1*$(this).val() != 0); // 0:期間指定ならfalse（入力可）
	$("[name='kikan_to']").attr('readonly', 1*$(this).val() != 0); // 0:期間指定ならfalse（入力可）
});

$("#fieldKikanFrom").change(function() { //期間からが変更されたら
	$("[name='kikan_sitei_kbn_cd']").val('1213'); // 1213:任意の期間
});

$("#fieldKikanTo").change(function() { //期間からが変更されたら
	$("[name='kikan_sitei_kbn_cd']").val('1213'); // 1213:任意の期間
});

$("input[type='checkbox']").change(function() { // チェックボックスをチェックしたら
	$(this).val($(this).is(':checked')?1:0);
});


var flds = ["cd"
		,'junjo_kbn_cd'
		,'junjo_kbn_table'
		,'koujun_flg'
		,'hanni_from'
		,'hanni_from_name'
		,'hanni_to'
		,'hanni_to_name'
		,'tokuisaki_mr_cd'
		,'shouhin_mr_cd'
		,'tantou_mr_cd'
		,'souko_mr_cd'
		,'project_mr_cd'
		,'project_sub_cd'
		,'kikan_sitei_kbn_cd'
		,'kikan_from'
		,'kikan_to'
		,'cd_from'
		,'cd_to'
		,'simekiri_kbn'
		,'tuujou_flg'
		,'henpin_flg'
		,'nebiki_flg'
		,'shokeihi_flg'
		,'urisikiri_flg'
		,'seisan_flg'
		,'shouhi_flg'
		,'azukari_flg'
		,'kakousikiri_flg'
		,'tekiyou_flg'
		,'memo_flg'
		,'shouhizei_flg'
		,'jinyuuryoku_flg'
		,'keitekiyou_flg'
		,'goukeigyou_flg'
];

window.onload = function(){
	if (!$("#id").val()) {
		for (i in flds) {
			$("[name='"+flds[i]+"']").val(flg=""+window.parent.document.getElementsByName(flds[i])[0].value);
		}
	}
	flg_selUtiwakeKbns();
	$("#name").val($("#fieldCd option:selected").text());
}

function flg_selUtiwakeKbns(){
	$("input[type='checkbox']").each(function(){
		$(this).prop('checked', $(this).val()==1);
	});
	$('#fieldUtiwakeKbns option').each(function(){
		$(this).prop('selected', $('#'+$(this).attr('value')).val()==1);
	});
}

$('#fieldUtiwakeKbns').change(function() { // 内訳区分を変更したら
	$('#fieldUtiwakeKbns option').each(function(){
		$('#'+$(this).val()).val($(this).prop('selected')?1:0);
	});
});

function return_value() {
	for (i in flds) {
		window.parent.document.getElementsByName(flds[i])[0].value = ""+$("[name='"+flds[i]+"']").val();
	}
	window.parent.fromModal("submit");
}

function new_name() {
	ret = prompt("選択条件名",$("#fieldCd option:selected").text());
	if (ret) {
		$("#fieldCd").val("");
		$("#name").val(ret);
		return;
	}
	return false;
}

function init_del() {
	ret = confirm("初期化/削除します。");
	if (ret) {
		location.href=jouken_uriage_meisais+"/modaldel/"+$("#fieldCd").val();
	}
}