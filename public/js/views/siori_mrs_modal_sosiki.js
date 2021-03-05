window.onload = function(){
	showNowDate();
	setInterval("showNowDate()", 10000);
	parent_grpNOW=window.parent.p2c_grpNOW(); // 親ウインドウの関数を実行（現在入力グループ名を得る）
	data0=window.parent.p2c_data0(); // 親ウインドウの関数を実行（共通の格納領域を得る）
	get_data_set(); // 共通の格納領域から画面フォームへ表示
	if (parent_grpNOW == 'TAIL') {
		TAIL_READ();
	} else {
		HEAD_READ();
	}
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
var parent_grpNOW;

function addForm1(){ // モーダル呼出post用フォームを追加
	var form1 = $('<form></form>',{id:'form1',action:''+modal_ito,target:'iframe1',method:'POST',name:'iframe1form'}).hide();
	$('body').append(form1);
//	form1.append($('<input>',{type:'hidden',name:'kousin_user_id',value:my_id}));
//	form1.append($('<input>',{type:'hidden',name:'denpyou_mr_cd',value:'shiire'}));
}

var work0={}; // 連想配列：javascriptだけの作業領域

var grpNOW='';

function grp_READ() {
	window[grpNOW.toLowerCase()+'_read'](); // []内の名前の関数を実行する。例：grpNOWが'HEAD'なら、HEAD_READ()が実行される。
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
	$('#fieldSocd').focus().select();
}

function BODY1_READ() {
	grpNOW='BODY1';
	grp_read_ctl(); // 現在グループの表示と非表示を設定する。
	$('#fieldSoth').focus().select();
}

function BODY2_READ() {
	grpNOW='BODY2';
	grp_read_ctl(); // 現在グループの表示と非表示を設定する。
	$('#fieldPatn_1').focus().select();
}

function BODY3_READ() {
	grpNOW='BODY3';
	grp_read_ctl(); // 現在グループの表示と非表示を設定する。
	$('#fieldCmd').focus().select();
}

function BODY3A_READ() {
	grpNOW='BODY3A';
	grp_read_ctl(); // 現在グループの表示と非表示を設定する。
	$('#fieldTori').focus().select();
}

function BODY4_READ() {
	grpNOW='BODY4';
	grp_read_ctl(); // 現在グループの表示と非表示を設定する。
	$('#fieldAykb').focus().select();
}

function BODY5_READ() {
	grpNOW='BODY5';
	grp_read_ctl(); // 現在グループの表示と非表示を設定する。
	$('#fieldAyme').focus().select();
}

function BODY6_READ() {
	grpNOW='BODY6';
	grp_read_ctl(); // 現在グループの表示と非表示を設定する。
	$('#fieldAych_1').focus().select();
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
	window.parent.fromModal();
}

function HEAD_ENTER() {
	GRPinput2span(); // 現在グループの<input>データを表示用<span>データに複写する。

	BODY1_READ();
}

function BODY1_CANCEL() {
	HEAD_READ();
}

function BODY1_ENTER() {
	GRPinput2span(); // 現在グループの<input>データを表示用<span>データに複写する。

	if (work0['ptnupd']) {
		BODY4_READ();
	} else {
		BODY2_READ();
	}
}

function BODY2_CANCEL() {
	BODY1_READ();
}

function BODY2_ENTER() {
	GRPinput2span(); // 現在グループの<input>データを表示用<span>データに複写する。

	BODY4_READ();
}

function BODY3_CANCEL() {
	BODY2_READ();
}

function BODY3_ENTER() {
	GRPinput2span(); // 現在グループの<input>データを表示用<span>データに複写する。

	BODY2_READ();
}

function BODY3A_CANCEL() {
	BODY3_READ();
}

function BODY3A_ENTER() {
	GRPinput2span(); // 現在グループの<input>データを表示用<span>データに複写する。

	BODY4_READ();
}

function BODY4_CANCEL() {
	if (work0['ptnupd']) {
		BODY1_READ();
	} else {
		BODY2_READ();
	}
}

function BODY4_ENTER() {
	GRPinput2span(); // 現在グループの<input>データを表示用<span>データに複写する。

	if (work0['ayaupd']) {
		BODY6_READ();
	} else {
		BODY5_READ();
	}
}

function BODY5_CANCEL() {
	BODY4_READ();
}

function BODY5_ENTER() {
	GRPinput2span(); // 現在グループの<input>データを表示用<span>データに複写する。

	BODY6_READ();
}

function BODY6_CANCEL() {
	BODY4_READ();
}

function BODY6_ENTER() {
	GRPinput2span(); // 現在グループの<input>データを表示用<span>データに複写する。

	TAIL_READ();
}

function TAIL_CANCEL() {
	$('.TAIL').val('');
	$('.xTAIL').text('');
	if (parent_grpNOW == 'TAIL') {
		window.parent.fromModal();;
	} else {
		BODY3_READ();
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

function get_data_set(){
	$('.BODY').val('');
	$('.xBODY').text('');
	$('.aBODY').text('');
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
    $('#iframe-bg').fadeTo('normal', 0.5);
    $('#iframe-body iframe').load(function () {
        $(this).contents().find('#header, #footer').hide();
    });
    return false;
}

function modalstart1(url,title,para) {
	$('#iframe-title').text(title);
    $('#iframe-wrap').fadeIn();
    $('#iframe-body').html('<iframe src="" width="100%" height="100%" style="border: none;" name="iframe1">');
    $('#iframe-bg').fadeTo('normal', 0.5);
    $('#iframe-body iframe').load(function () {
        $(this).contents().find('#header, #footer').hide();
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
