window.onload = function(){
	var titles=$('#fieldId option:selected').text().split('=',2);
	$('#title').text(titles[1]);
	imax = 0;
}

$('#fieldId').change(function() {
	var titles=$('#fieldId option:selected').text().split('=',2);
	$('#title').text(titles[1]);
});


$('#END').click(function() { //エンドキー(END)を押したら最下行へ移動
        var index = $targetElm.index($("#"+lastfocusin));//alert(index);
        var thisname = $("#"+lastfocusin).attr('name');
        var partsname = thisname.split(/[\[|\]]+/);// '['か']'かその連続にマッチする文字で分割する。例：data[nyuukin_meisai_dts][0][shouhin_mr_cd]は、['data','nyuukin_meisai_dts','0','shouhin_mr_cd','']となる。
        var findend = '[sentaku_chk]';
        if (imax > 1 && partsname.length == 5) {
        	findend = '['+partsname[3]+']';
        }
        var findlen = -findend.length;
        index = $targetElm.index($("#fieldNyuukinMeisaiDts"+(imax-1)+"Cd"))-1;
        for (i = index + 1; i <= $targetElm.length && (!$targetElm.eq(i).isVisible() || typeof($targetElm.eq(i).attr("id")) == "undefined" || $targetElm.eq(i).attr("name").substr(findlen) != findend) ; i++) { }
        if (i <= $targetElm.length) {index = i;}
        $targetElm.eq(index).focus().select();
});

$('#PgUp').click(function() { //ページアップキー(Ctrl+Shift+Enter)を押したら前行へ移動
        var index = $targetElm.index($("#"+lastfocusin));//alert(index);
        var thisname = $("#"+lastfocusin).attr('name');
        var partsname = thisname.split(/[\[|\]]+/);// '['か']'かその連続にマッチする文字で分割する。例：data[nyuukin_meisai_dts][0][shouhin_mr_cd]は、['data','nyuukin_meisai_dts','0','shouhin_mr_cd','']となる。
        var findend = '[sentaku_chk]';
        if (imax > 1 && partsname.length == 5) {
        	findend = '['+partsname[3]+']';
        }
        var findlen = -findend.length;
        for (i = index - 1; i >= 0 && (!$targetElm.eq(i).isVisible() || typeof($targetElm.eq(i).attr("id")) == "undefined" || $targetElm.eq(i).attr("name").substr(findlen) != findend) ; i--) { }
        if (i >= 0) {index=i; }
        $targetElm.eq(index).focus().select();
});

$('#PgDn').click(function() { //ページダウンキー(Ctrl+Enter)を押したら次行へ移動
        var index = $targetElm.index($("#"+lastfocusin));//alert(index);
        var thisname = $("#"+lastfocusin).attr('name');
        var partsname = thisname.split(/[\[|\]]+/);// '['か']'かその連続にマッチする文字で分割する。例：data[nyuukin_meisai_dts][0][shouhin_mr_cd]は、['data','nyuukin_meisai_dts','0','shouhin_mr_cd','']となる。
        var findend = '[sentaku_chk]';
        if (imax > 1 && partsname.length == 5) {
        	findend = '['+partsname[3]+']';
        }
        var findlen = -findend.length;
        for (i = index + 1; i <= $targetElm.length && (!$targetElm.eq(i).isVisible() || typeof($targetElm.eq(i).attr("id")) == "undefined" || $targetElm.eq(i).attr("name").substr(findlen) != findend) ; i++) { }
        if (i <= $targetElm.length) {index = i;}
        $targetElm.eq(index).focus().select();
});

$(':checkbox').change(function() { //チェックボックスが変更されたら
	//次の項目へ自動移動
	var index = $targetElm.index(this);
	for (var i = index + 1;
		i <= $targetElm.length && (!$targetElm.eq(i).isVisible()
			|| $targetElm.eq(i).attr("readonly")=="readonly"
			|| typeof($targetElm.eq(i).attr("tabindex")) != "undefined"
		);
		i++) { }
	if (i <= $targetElm.length) {index = i;}
	$targetElm.eq(index).focus().select();//alert(index);
});


/* モーダルダイヤログ部分 */
function f8key() {
	if (lastfocusin == "fieldDenpyouCdFrom") { /* 売上伝票選択 */
		modalstart(uriage_dts_modal,"売上伝票選択");
	}else if (lastfocusin == "fieldDenpyouCdTo") { /* 売上伝票選択 */
		modalstart(uriage_dts_modal,"売上伝票選択");
	}else if (lastfocusin == "fieldTokuisakiMrCd") { /* 得意先コード選択 */
		modalstart(tokuisaki_mrs_modal,"得意先選択");
	}else if (lastfocusin == "fieldNounyuusakiMrCd") { /* 納入先コード選択 */
		modalstart(nounyuusaki_mrs_modal,"納入先選択");
	}else if (lastfocusin == "fieldUriagebiFrom") { /* 売上日自選択 */
		open_datepicker();
	}else if (lastfocusin == "fieldUriagebiTo") { /* 売上日至選択 */
		open_datepicker();
	}
}

$('#fieldTokuisakiMrCd').change(function() { //得意先マスター索引
	//alert("AAA:".$(this).attr("id")); //''の場合、'0'など1桁の場合または結果が複数の場合、結果が1個の場合、結果が0個の場合
	if ($(this).val()=='') {
		$("#fieldTokuisakiMrName").val("");
	}else{
		$.ajax({
			type:"POST",
			url:tokuisaki_mrs_ajaxGet,
			data:{'cd':$(this).val(),},
			async:true,
			dataType:'json',
			success: function (data) {
				if(data.length==0){
					$("#fieldTokuisakiMrName").val('>>エラー:未登録');
				}else if(data.length==1 || $("#fieldTokuisakiMrCd").val() === data[0].cd){
					$('#TokuisakiMrsOptions > option').remove();
					for ( var i = 0; i < data.length; i++ ) {
						$('#TokuisakiMrsOptions').append('<option value="' + data[i].cd + '">' + data[i].cd + ':' + data[i].name + '</option>');
					}
					$("#fieldTokuisakiMrCd").val(data[0].cd);
					$("#fieldTokuisakiMrName").val(data[0].name);

				}else{
					//選択肢をクリアしてから追加する
					$('#TokuisakiMrsOptions > option').remove();
					for ( var i = 0; i < data.length; i++ ) {
						$('#TokuisakiMrsOptions').append('<option value="' + data[i].cd + '">' + data[i].cd + ':' + data[i].name + '</option>');
					}
					$("#fieldTokuisakiMrName").val('>>エラー:未登録');
					$("#fieldTokuisakiMrCd").focus().select();
				}
			},
			error: function(xhr, status, err) {
				$("#fieldTokuisakiMrName").val('>エラー'+status+'/'+err);
			},
		});
	}
});

$('#fieldNounyuusakiMrCd').change(function() { //納入先マスター索引
	//alert("AAA:".$(this).attr("id")); //''の場合、'0'など1桁の場合または結果が複数の場合、結果が1個の場合、結果が0個の場合
	if ($(this).val()=='') {
		$("#fieldNounyuusakiMrName").val("");
	}else{
		$.ajax({
			type:"POST",
			url:nounyuusaki_mrs_ajaxGet,
			data:{'cd':$(this).val(),},
			async:true,
			dataType:'json',
			success: function (data) {
				if(data.length==0){
					$("#fieldNounyuusakiMrName").val('>>エラー:未登録');
				}else if(data.length==1 || $("#fieldNounyuusakiMrCd").val() === data[0].cd){
					//選択肢をクリアしてから追加する
					$('#NounyuusakiMrsOptions > option').remove();
					for ( var i = 0; i < data.length; i++ ) {
						$('#NounyuusakiMrsOptions').append('<option value="' + data[i].cd + '">' + data[i].cd + ':' + data[i].name + '</option>');
					}
					$("#fieldNounyuusakiMrCd").val(data[0].cd);
					$("#fieldNounyuusakiMrName").val(data[0].name);
				}else{
					//選択肢をクリアしてから追加する
					$('#NounyuusakiMrsOptions > option').remove();
					for ( var i = 0; i < data.length; i++ ) {
						$('#NounyuusakiMrsOptions').append('<option value="' + data[i].cd + '">' + data[i].cd + ':' + data[i].name + '</option>');
					}
					$("#fieldNounyuusakiMrName").val('>>エラー:未登録');
					$("#fieldNounyuusakiMrCd").focus().select();
				}
			},
			error: function(xhr, status, err) {
				$("#fieldNounyuusaki").val('>エラー'+status+'/'+err);
			},
		});
	}
});

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

function kensaku() {
	$('table#tb_uriage tbody tr').remove();
	imax = 0;
	$.ajax({
		type:"POST",
		url:uriage_dts_ajaxRenzoku,
		data:{
			'hanni_flg'			:$('#fieldHanniFlg').val(),
			'nyuuryokusha_flg'	:$('#fieldNyuuryokushaFlg').val(),
			'uriagebi_from'		:$('#fieldUriagebiFrom').val(),
			'uriagebi_to'		:$('#fieldUriagebiTo').val(),
			'denpyou_cd_from'	:$('#fieldDenpyouCdFrom').val(),
			'denpyou_cd_to'		:$('#fieldDenpyouCdTo').val(),
			'id_de'				:$('#fieldIdDe').prop('checked')?1:0,
			'id'				:$('#fieldId').val(),
			'tantou_mr_cd'		:$('#fieldTantouMrCd').val(),
			'tokuisaki_mr_cd'	:$('#fieldTokuisakiMrCd').val(),
			'nounyuusaki_mr_cd'	:$('#fieldNounyuusakiMrCd').val(),
			'torihiki_kbn1'		:$('#fieldTorihikiKbn1').prop('checked')?1:0,
			'torihiki_kbn2'		:$('#fieldTorihikiKbn2').prop('checked')?1:0,
			'torihiki_kbn3'		:$('#fieldTorihikiKbn3').prop('checked')?1:0,
			'torihiki_kbn4'		:$('#fieldTorihikiKbn4').prop('checked')?1:0,
			'sakusei_users_order':$('#fieldSakuseiUsersOrder').prop('checked')?1:0,
			'tokuisaki_mrs_order':$('#fieldTokuisakiMrsOrder').prop('checked')?1:0
		},
		async:true,
		dataType:'json',
		success: function (data) {
			if (data.length==0) {
				alert('検索の結果０件でした。');
			} else {
				for ( var i = 0; i < data.length; i++ ) {
					$("#tr_uriage_hidden").clone(true).attr('id','tr_uriage_'+i).attr('class','tr_uriage').removeAttr('style').appendTo($('table#tb_uriage tbody'));
					$('#tr_uriage_'+i+" #hiddenSentakuChk").attr('id','fieldUriageDts'+i+'SentakuChk').attr('name','data[uriage_dts]['+i+'][sentaku_chk]').val(data[i].id).prop('checked','true');
					var newtr=$('#tr_uriage_'+i);
					$('td',newtr).eq(1).text(data[i].uriagebi);
					$('td',newtr).eq(2).text(data[i].cd);
					$('td',newtr).eq(3).text(data[i].tokuisaki_mr_cd);
					$('td',newtr).eq(4).text(data[i].tokuisaki_mr_name);
					$('td',newtr).eq(5).text(data[i].meisai_kensuu);
					$('td',newtr).eq(6).text(data[i].sakusei_user_name);
				}
				imax = i - 1;
				$targetElm = $( targetElm );
			}
		},
		error: function(xhr, status, err) {
			$("#fieldNounyuusaki").val('>エラー'+status+'/'+err);
		},
	});
}

function renzokugo() {
	$('#form1').submit();
    setTimeout(function(){
		window.open('about:blank','_self').close();
    },10000000);
}

function torikesi() {
	window.open('about:blank','_self').close();
}

function modalstart(url,title,para) {
	$('#iframe-title').text(title);
    $('#iframe-wrap').fadeIn();
    if (!para) {para='?cd=' + $('#'+lastfocusin).val();}
    $('#iframe-body').html('<iframe src="' + url + para + '" width="100%" height="100%" style="border: none;">');
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

$(function(){ // テーブルのヘッドを消えなくする
  $('table.head_fix').floatThead({
  	top: 50
  });
});

