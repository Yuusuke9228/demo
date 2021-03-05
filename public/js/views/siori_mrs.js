window.onload = function(){
	showNowDate();
	setInterval("showNowDate()", 100000);
	midashi();
	HEAD_READ();
	addForm1(); // モーダル呼出post用フォームを追加
}
 
//現在時刻を表示する関数
function showNowDate(){
  var now = new Date();
  $('#dispYMDHM').text(now.getFullYear()+'-'+
	('0'+(now.getMonth()+1)).slice(-2)+'-'+
	('0'+now.getDate()).slice(-2)+' '+
	('0'+now.getHours()).slice(-2)+':'+
	('0'+now.getMinutes()).slice(-2));
}

function addForm1(){ // モーダル呼出post用フォームを追加
	var form1 = $('<form></form>',{id:'form1',action:''+modal_ito,target:'iframe1',method:'POST',name:'iframe1form'}).hide();
	$('body').append(form1);
//	form1.append($('<input>',{type:'hidden',name:'kousin_user_id',value:my_id}));
//	form1.append($('<input>',{type:'hidden',name:'denpyou_mr_cd',value:'shiire'}));
}

var data0={}; // 連想配列：画面全体の項目：phpのcontrollerとajaxでヤリトリして共通の格納領域とする。
var work0={}; // 連想配列：javascriptだけの作業領域
var grpNOW='';
var bpage=0;

function p2c_grpNOW() { // モーダルウインドウから実行する関数（現在入力グループ名を返す）
	return grpNOW;
}

function p2c_data0() { // モーダルウインドウから実行する関数（共通の格納領域を返す）
	return data0;
}

function c2p_data0(c_data0) { // モーダルウインドウから実行する関数（共通の格納領域を戻す）
	data0 = c_data0;
}

function midashi() { // 見出し設定
	if ($('#fieldSnagx').val() == '') {
		$('#fieldSnag').val(0);
		$('#dispSnag').text('0');
	}
	if ($('#fieldSnag').val() < 20) {
		$('#dispTitle').text("試織設計書画面");
		$('#dispMisino').text("試織番号");
		$('#dispMikibo').text("　　納期"); 
		$('#dispMiinou').text("発行");
		$('#dispMisnou').text("糸割");
		$('#dispMitnou').text("整経");
		$('#dispMiynou').text("綾通");
		$('#dispMianou').text("織上");
		$('#dispMikai').text("回");
		$('#dispMiahab').text("㎝");
		$('#dispMianag').text("㎝");
	} else {
		$('#dispTitle').text("織物設計書画面");
		$('#dispMisino').text("生機番号");
		$('#dispMikibo').text("　登録日"); 
		$('#dispMiinou').text("上玉");
		$('#dispMisnou').text("上糸");
		$('#dispMitnou').text("ロス");
		$('#dispMiynou').text("試転");
		$('#dispMianou').text("手入");
		$('#dispMikai').text("ｍ");
		if ($('#fieldAhab').val() > 70 || $('#fieldAhab').val() == 0) {
		   $('#dispMiahab').text("㎝");
		   $('#dispMianag').text("ｍ");
		} else {
		   $('#dispMiahab').text("ｉ");
		   $('#dispMianag').text("ｙ");
		}
	}
}

function grp_READ() {
	window[grpNOW+'_read'](); // []内の名前の関数を実行する。例：grpNOWが'HEAD'なら、HEAD_READ()が実行される。
}

function grp_read_ctl() { // 現在グループの表示と非表示を設定する。
	$('.fALLF').prop('disabled',true);
	$('.f'+grpNOW).prop('disabled',false);
	$('input.ALLF').not('.'+grpNOW).css('display','none');
	$('span.xALLF').not('.x'+grpNOW).css('display','inline');
	$('input.'+grpNOW).css('display','inline');
	$('span.x'+grpNOW).css('display','none');
}

function HEAD_READ() {
	grpNOW='HEAD';
	grp_read_ctl(); // 現在グループの表示と非表示を設定する。
	$('#fieldSino').focus().select();
}

function BODY_READ() {
	grpNOW='BODY';
	grp_read_ctl(); // 現在グループの表示と非表示を設定する。
	$('#fieldMoku').focus().select();
}

function TAIL_READ() {
	grpNOW='TAIL';
	grp_read_ctl(); // 現在グループの表示と非表示を設定する。
	$('#fieldKaku').focus().select();
}

$('#ESC').click(function() {
	CANCEL();
});

$('#F0').focusin(function(e) {
	var c = lastkeypress.which ? lastkeypress.which : lastkeypress.keyCode;
	if (c==13 && !lastkeypress.shiftKey) {
		ENTER();
	} else {
		grp_READ();
	}
});

function ENTER() {
	window[grpNOW+'_ENTER'](); // []内の名前の関数を実行する。例：grpNOWが'HEAD'なら、HEAD_ENTER()が実行される。
}

function CANCEL() {
	window[grpNOW+'_CANCEL'](); // []内の名前の関数を実行する。例：grpNOWが'HEAD'なら、HEAD_CANSEL()が実行される。
}

function GRPinput2span(grp) { // (省略時=現在)グループの<input>データを表示用<span>データに複写する。
	if (!grp) {grp=grpNOW;}
	formGRP[grp].forEach (function(fldName) {
		if ($('#field'+fldName).length) {
			$('#disp'+fldName).text($.htmlspecialchars($('#field'+fldName).val()));
		}
	});
}

function HEAD_CANCEL() {
	$('.ALLF').val('');
	$('.ALLF,.xALLF').text('');
	HEAD_READ();
}

function HEAD_ENTER() {
	GRPinput2span(); // 現在グループの<input>データを表示用<span>データに複写する。

	if($('#fieldSied').val().trim()==''){
		data0['cd']=$('#fieldSino').val().trim();
	}else{
		data0['cd']=($('#fieldSino').val().trim()+'      ').substr(0,6)+$('#fieldSied').val().replace(/\s+$/, ""); // rtrim同等
	}
	if ($('#fieldSino').val().trim()=='') {
		audio.play();
		$('#dispEmsg').text("試織コードを入力してください！");
		HEAD_READ();
	} else {
		ajaxGet();
	}
}

function HEAD_CHECK() {
	if($('#fieldSkbn').val()<='0'){
		if(ajaxGetCount!=1){
			audio.play();
			$('#dispEmsg').text("未登録の試織番号です。");
		}
		TAIL_READ();
	} else if($('#fieldSkbn').val()=='1'){
		if(ajaxGetCount==1){
			audio.play();
			$('#dispEmsg').text("既に登録のある試織番号です。");
			HEAD_READ();
		} else {
			BODY_READ();
		}
	} else if($('#fieldSkbn').val()=='2'){
		if(ajaxGetCount!=1){
			audio.play();
			$('#dispEmsg').text("未登録の試織番号です。");
			HEAD_READ();
		} else {
			BODY_READ();
		}
	} else if($('#fieldSkbn').val()=='3'){
		if(ajaxGetCount!=1){
			audio.play();
			$('#dispEmsg').text("未登録の試織番号です。");
			HEAD_READ();
		} else {
			TAIL_READ();
		}
	} else if($('#fieldSkbn').val()=='4'){
		if(ajaxGetCount!=1){
			audio.play();
			$('#dispEmsg').text("未登録の試織番号です。");
			HEAD_READ();
		} else {
			TAIL_READ();
		}
	} else if($('#fieldSkbn').val()=='9'){
		if(ajaxGetCount!=1){
			audio.play();
			$('#dispEmsg').text("未登録の試織番号です。");
			HEAD_READ();
		} else {
			TAIL_READ();
		}
	}else{
		audio.play();
		$('#dispEmsg').text("処理区分は０～４と９です！");
		$('#fieldSkbn').focus().select();
	}
}

function BODY_CANCEL() {
	HEAD_READ();
}

function BODY_ENTER() {
	GRPinput2span(); // 現在グループの<input>データを表示用<span>データに複写する。

	TAIL_READ();
}

function TAIL_CANCEL() {
	$('.TAIL').val('');
	$('.xTAIL').text('');
	if ($('#fieldSkbn').val()=='1' || $('#fieldSkbn').val()=='2') {
		BODY_READ();
	} else {
		HEAD_READ();
	}
}

function TAIL_ENTER() {
	GRPinput2span(); // 現在グループの<input>データを表示用<span>データに複写する。

	HEAD_READ();
}

var ajaxGetCount=0;

function ajaxGet() { //試織マスタ索引
//alert("AAA"); //''の場合、'0'など1桁の場合または結果が複数の場合、結果が1個の場合、結果が0個の場合
	$.ajax({
		type:"POST",
		url:siori_mrs_ajaxGet,
		data:{'cd':data0['cd'],},
		async:true,
		dataType:'json',
		success: function (data) {
			if(data.length == 0){
				ajaxGetCount=0;
			}else if(data.length == 1 || data0['cd'] == data[0].cd){
				data0 = data[0]; // 共有領域にセット
				get_data_set();
				ajaxGetCount=1;
			} else {
				ajaxGetCount=2;
			}
			midashi();
			HEAD_CHECK();
		},
		error: function(xhr, status, err) {
			alert('エラー siori_mrs_ajaxGet '+status+'/'+err);
		},
	});
}

function ajaxNext() { //試織マスタ次へ
	$('#dispEmsg').text("");
	$.ajax({
		type:"POST",
		url:siori_mrs_ajaxNext,
		data:{'cd':$('#fieldSino').val()+$('#fieldSied').val(),},
		async:true,
		dataType:'json',
		success: function (data) {
			if(data.length == 0){
				audio.play();
				$('#dispEmsg').text("次の試織番号は登録されていません。");
			} else {
				data0 = data[0]; // 共有領域にセット
				get_data_set();
				ajaxGetCount=1;
				midashi();
			}
		},
		error: function(xhr, status, err) {
			alert('エラー siori_mrs_ajaxNext '+status+'/'+err);
		},
	});
}

function ajaxBack() { //試織マスタ前へ
	$('#dispEmsg').text("");
	$.ajax({
		type:"POST",
		url:siori_mrs_ajaxBack,
		data:{'cd':$('#fieldSino').val()+$('#fieldSied').val(),},
		async:true,
		dataType:'json',
		success: function (data) {
			if(data.length == 0){
				audio.play();
				$('#dispEmsg').text("前の試織番号は登録されていません。");
			} else {
				data0 = data[0]; // 共有領域に再セット
				get_data_set();
				ajaxGetCount=1;
				midashi();
			}
		},
		error: function(xhr, status, err) {
			alert('エラー siori_mrs_ajaxBack '+status+'/'+err);
		},
	});
}

function ajaxSave() { //試織マスタへ書込み
	save_data_set();	
	$.ajax({
		type:"POST",
		url:siori_mrs_ajaxSave,
		data:{'data':data0,}, // 共有領域をそのまま送り込む
		async:true,
		dataType:'json',
		success: function (data) {
			if(data.length == 0){
				alert('エラー 更新失敗');
			}else {
				if (data[1]['chgcnt']==0) {
					alert('変更がありませんので「登録」を中止しました。');
				} else {
					data0 = data[0]; // 共有領域にセット
					get_data_set();
					hyouji();
				}
			}
		},
		error: function(xhr, status, err) {
			alert('エラー ajaxSave '+status+'/'+err);
		},
	});
}

function get_data_set(){
	$('.BODY').val('');
	$('.xBODY').text('');
	$('.BODY').text('');
	data0['sino']=data0['cd'].substr(0,6);
	data0['sied']=data0['cd'].substr(6);
	for (key in data0) {
		if ($.isArray(data0[key])) { // テーブルリンクの場合
			for (row1 in data0[key]) {
				var col2 = data0[key][row1]['cd'];
				for (key1 in data0[key][row1]) {
					key2 = key1+'_'+col2
					if (koumokus[key2]) {
						var keyid = koumokus[key2][0];
						var props = koumokus[key2];
						if(props[2]==0) { // 文字列なら
							$('#disp'+keyid).text($.htmlspecialchars(data0[key][row1][key1]?data0[key][row1][key1]:''));
						} else if(props[2]==2) { // 日付なら
							var d0 = new Date(data0[key][row1][key1]);
							var d1 = isNaN(d0)?'':(d0.getFullYear()+'-'+('0'+(d0.getMonth()+1)).slice(-2)+'-'+('0'+(d0.getDay()+1)).slice(-2));
							$('#field'+keyid).val(data0[key][row1][key1]?data0[key][row1][key1].substr(0,10):'');
							$('#disp'+keyid).text(d1);
						} else if(props[2]==1) { // 数値なら
							$('#disp'+keyid).text(data0[key][row1][key1]);
						}
						if(props[1]==1) {//入力項目なら
							$('#field'+keyid).val(data0[key][row1][key1]);
						}
					}
				}
			}
		} else { // テーブル項目の場合
			if (koumokus[key]) {
				var keyid = koumokus[key][0];
				var props = koumokus[key];
				if(props[2]==0) { // 文字列なら
					$('#disp'+keyid).text($.htmlspecialchars(data0[key]?data0[key]:''));
				} else if(props[2]==2) { // 日付なら
					var d0 = new Date(data0[key]);
					var d1 = isNaN(d0)?'':(d0.getFullYear()+'-'+('0'+(d0.getMonth()+1)).slice(-2)+'-'+('0'+(d0.getDay()+1)).slice(-2));
					$('#field'+keyid).val(data0[key]?data0[key].substr(0,10):'');
					$('#disp'+keyid).text(d1);
				} else if(props[2]==1) { // 数値なら
					$('#disp'+keyid).text(data0[key]);
				}
				if(props[1]==1) {//入力項目なら
					$('#field'+keyid).val(data0[key]);
				}
			}
		}
	}
}

/* 糸使いモーダルダイヤログ部分 */
function f5key() {
	modalstart(modal_ito, "糸構成登録");
}

/* 配列モーダルダイヤログ部分 */
function f6key() {
	modalstart(modal_hairetu, "配列登録");
}

/* 組織モーダルダイヤログ部分 */
function f7key() {
	modalstart(modal_sosiki, "組織登録");
}

/* モーダルダイヤログ部分 */
function f8key() {
	if (lastfocusin == "fieldCd") { /* 仕入伝票選択 */
		modalstart1(den_modal, "仕入伝票選択");
	}else if (lastfocusin == "fieldHacchuuDtCd") { /* 発注伝票選択 */
		modalstart(hacchuu_dts_modal, "発注伝票選択");
	}else if (lastfocusin == "fieldShiirebi") { /* 仕入日選択 */
		open_datepicker();
	}else if (lastfocusin == "fieldZeirituTekiyoubi") { /* 税率適用日選択 */
		open_datepicker();
	}
}

function modalstart(url,title,para) {
	$('#iframe-title').text(title);
    $('#iframe-wrap').fadeIn();
    if (!para) {para='?cd=' + $('#'+lastfocusin).val();}
    $('#iframe-body').html('<iframe src="' + url + para + '" width="100%" height="100%" style="border: none;">');
    $('#iframe-bg').fadeTo('normal', 0.2);
    $('#iframe-body iframe').load(function () {
        $(this).contents().find('#header').hide();
    });
    return false;
}

function modalstart1(url,title,para) {
	$('#iframe-title').text(title);
    $('#iframe-wrap').fadeIn();
    $('#iframe-body').html('<iframe src="" width="100%" height="100%" style="border: none;" name="iframe1">');
    $('#iframe-bg').fadeTo('normal', 0.2);
    $('#iframe-body iframe').load(function () {
        $(this).contents().find('#header').hide();
    });
    document.iframe1form.submit();
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

(function($) {
    $.extend({
		htmlspecialchars: function htmlspecialchars(ch){
				ch = ch.replace(/&/g,"&amp;") ;
			    ch = ch.replace(/"/g,"&quot;") ;
			    ch = ch.replace(/'/g,"&#039;") ;
			    ch = ch.replace(/</g,"&lt;") ;
			    ch = ch.replace(/>/g,"&gt;") ;
			    ch = ch.replace(/\r?\n/g, '<br>') ;
			    return ch ;
			}
	});
})(jQuery);
