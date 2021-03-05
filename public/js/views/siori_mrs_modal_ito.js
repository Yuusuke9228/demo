window.onload = function(){
	showNowDate();
	setInterval("showNowDate()", 10000);
	parent_grpNOW=window.parent.p2c_grpNOW(); // 親ウインドウの関数を実行（現在入力グループ名を得る）
	data0=window.parent.p2c_data0(); // 親ウインドウの関数を実行（共通の格納領域を得る）
	Chuij2work0();
	get_data_set(); // 共通の格納領域から画面フォームへ表示
	if (parent_grpNOW == 'TAIL') {
		TAIL_READ();
	} else {
		BODY1_READ();
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

function addForm1(){ // モーダル呼出post用フォームを追加
//	var form1 = $('<form></form>',{id:'form1',action:''+modal_ito,target:'iframe1',method:'POST',name:'iframe1form'}).hide();
//	$('body').append(form1);
//	form1.append($('<input>',{type:'hidden',name:'kousin_user_id',value:my_id}));
//	form1.append($('<input>',{type:'hidden',name:'denpyou_mr_cd',value:'shiire'}));
}

var parent_grpNOW; // 親ウインドウの現在入力グループ名
var work0={}; // 連想配列：javascriptだけの作業領域

var grpNOW='';
var b1page=0; // 現時点MAX=2
var b2page=0;
var b3page=0;

function grp_READ() {
	window[grpNOW.toLowerCase()+'_read'](); // []内の名前の関数を実行する。例：grpNOWが'HEAD'なら、head_READ()が実行される。
}

function grp_read_ctl() { // 現在グループの表示と非表示を設定する。
	$('.fALLF').prop('disabled',true);
	$('.f'+grpNOW).prop('disabled',false);
	$('input.ALLF').not('.'+grpNOW).css('display','none');
	$('span.xALLF').not('.x'+grpNOW).css('display','inline');
	$('input.'+grpNOW).css('display','inline');
	$('span.x'+grpNOW).css('display','none');
}

function BODY1_READ() {
	grpNOW='BODY1';
	grp_read_ctl(); // 現在グループの表示と非表示を設定する。
	$('#fieldGito_1').focus().select();
}

function BODY2_READ() {
	grpNOW='BODY2';
	grp_read_ctl(); // 現在グループの表示と非表示を設定する。
	$('#fieldIjun_1').focus().select();
}

function BODY3_READ() {
	grpNOW='BODY3';
	grp_read_ctl(); // 現在グループの表示と非表示を設定する。
	$('#fieldDenl_1').focus().select();
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

function NEXT() {
	window[grpNOW+'_NEXT'](); // []内の名前の関数を実行する。例：grpNOWが'HEAD'なら、HEAD_NEXT()が実行される。
}

function BACK() {
	window[grpNOW+'_BACK'](); // []内の名前の関数を実行する。例：grpNOWが'HEAD'なら、HEAD_BACK()が実行される。
}

function GRPinput2span(grp) { // (省略時=現在)グループの<input>データを表示用<span>データに複写する。
	if (!grp) {grp=grpNOW;}
	formGRP[grp].forEach (function(fldName) {
		if ($('#field'+fldName).length) {
			$('#disp'+fldName).text($.htmlspecialchars($('#field'+fldName).val()));
		}
	});
}

function BODY1_CANCEL() {
	window.parent.fromModal();
}

function BODY1_NEXT() {
	BODY1_data0();
	if (b1page<2) {
		b1page++;
		data0_BODY1();
	}
}

function BODY1_BACK() {
	BODY1_data0();
	if (b1page>0) {
		b1page--;
		data0_BODY1();
	}
}

function BODY1_ENTER() {
	BODY1_data0();
	BODY2_READ();
}

function BODY1_data0() {
	GRPinput2span(); // 現在グループの<input>データを表示用<span>データに複写する。
	if (!data0.SioriGenMrs) {data0.SioriGenMrs = [];}
	for (var i=1;i<=6;i++) {
		var i1 = b1page * 6 + i - 1;
		data0.SioriGenMrs[i1] = {};
		data0.SioriGenMrs[i1].cd = i1 + 1;
		data0.SioriGenMrs[i1]['gito'] = $('#fieldGito_'+i).val();
		data0.SioriGenMrs[i1].kota = $('#fieldKota_'+i).val();
		data0.SioriGenMrs[i1].kik1 = $('#fieldKik1_'+i).val();
		data0.SioriGenMrs[i1].ktni = $('#fieldKtni_'+i).val();
		data0.SioriGenMrs[i1].kk2t = $('#fieldKk2t_'+i).val();
		data0.SioriGenMrs[i1].kk2 = $('#fieldKk2_'+i).val();
		data0.SioriGenMrs[i1].biko = $('#fieldBiko_'+i).val();
		data0.SioriGenMrs[i1].SioriGenKonMrs=[];
		for (j=1;j<=4;j++) {
			data0.SioriGenMrs[i1].SioriGenKonMrs[j]={};
			data0.SioriGenMrs[i1].SioriGenKonMrs[j].kon = $('#fieldKon_'+i+'_'+j).val();
			data0.SioriGenMrs[i1].SioriGenKonMrs[j].rit = $('#fieldRit_'+i+'_'+j).val();
		}
	}
}

function BODY2_CANCEL() {
	BODY1_READ();
}

function BODY2_NEXT() {
	BODY2_data0();
	if (b2page<2) {
		b2page++;
		data0_BODY2();
	}
}

function BODY2_BACK() {
	BODY2_data0();
	if (b2page>0) {
		b2page--;
		data0_BODY2();
	}
}

function BODY2_ENTER() {
	BODY2_data0();
	BODY3_READ();
}

function BODY2_data0() {
	GRPinput2span(); // 現在グループの<input>データを表示用<span>データに複写する。
	if (!data0.SioriNenMrs) {data0.SioriNenMrs = [];}
	for (var i=1;i<=12;i++) {
		var i1 = b2page * 12 + i - 1;
		data0.SioriNenMrs[i1] = {};
		data0.SioriNenMrs[i1].cd = i1+31;
		data0.SioriNenMrs[i1].tjun = $('#fieldIjun_'+i).val().substr(0,1).trim();
		data0.SioriNenMrs[i1].yjun = $('#fieldIjun_'+i).val().substr(1,2).trim();
		data0.SioriNenMrs[i1].ito1 = $('#fieldIto1_'+i).val();
		data0.SioriNenMrs[i1].hon1 = $('#fieldHon1_'+i).val();
		data0.SioriNenMrs[i1].ito2 = $('#fieldIto2_'+i).val();
		data0.SioriNenMrs[i1].hon2 = $('#fieldHon2_'+i).val();
		data0.SioriNenMrs[i1].kote = $('#fieldKote_'+i).val();
		data0.SioriNenMrs[i1].hoko = $('#fieldHoko_'+i).val();
		data0.SioriNenMrs[i1].yori = $('#fieldYori_'+i).val();
		data0.SioriNenMrs[i1].kbn1 = $('#fieldKbn1_'+i).val();
		data0.SioriNenMrs[i1].kbn2 = $('#fieldKbn2_'+i).val();
		data0.SioriNenMrs[i1].kako = $('#fieldKako_'+i).val();
//		data0.SioriNenMrs[i1].kohi = $('#fieldKohi_'+i).text();
	}
}

function BODY3_CANCEL() {
	BODY2_READ();
}

function BODY3_NEXT() {
	BODY3_data0();
	if (b3page<2) {
		b3page++;
		data0_BODY3();
	}
}

function BODY3_BACK() {
	BODY3_data0();
	if (b3page>0) {
		b3page--;
		data0_BODY3();
	}
}

function BODY3_ENTER() {
	BODY3_data0();
	TAIL_READ();
}

function BODY3_data0() {
	GRPinput2span(); // 現在グループの<input>データを表示用<span>データに複写する。
	if (!data0.SioriItoMrs) {data0.SioriItoMrs = [];}
	for (var i=1;i<=5;i++) {
		var i1 = b3page * 5 + i - 1;
		data0.SioriItoMrs[i1] = {};
		data0.SioriItoMrs[i1].cd = i1 + 1;
//		data0.SioriItoMrs[i1].tjun = $('#fieldMjun_'+i).val().substr(0,1).trim();
//		data0.SioriItoMrs[i1].yjun = $('#fieldMjun_'+i).val().substr(1,2).trim();
		data0.SioriItoMrs[i1].denl = $('#fieldDenl_'+i).val();
		data0.SioriItoMrs[i1].ondo = $('#fieldOndo_'+i).val();
		data0.SioriItoMrs[i1].hun = $('#fieldHun_'+i).val();
		data0.SioriItoMrs[i1].nori = $('#fieldNori_'+i).val();
//		data0.SioriItoMrs[i1].itom = $('#fieldItom_'+i).val();
	}
	for (var i=1;i<=2;i++) {
		var i1 = b3page * 2 + i - 1;
		work0.SioriChuijMrs[i1] = {};
		work0.SioriItoMrs[i1].cd = i1 + 1;
		work0.SioriItoMrs[i1].chui = $('#fieldChuj_'+i).val();
	}
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

function Chuij2work0() { // 親から受けたdata0の注意事項の中の「糸使」をワークに複写
	work0.SioriChuijMrs=[];
	if (data0.SioriChuijMrs) {
		data0.SioriChuijMrs.forEach(function(SioriChuijMr) {
			if (SioriChuijMr.tais == '糸使') {
				work0.SioriChuijMrs[SioriChuijMr.eda]=SioriChuijMr;
			}
		});
	}
}

function get_data_set() {
	$('#fieldSino').val(data0.cd.substr(0,6));
	$('#fieldSied').val(data0.cd.substr(6));
	GRPinput2span('HEAD'); // 現在グループの<input>データを表示用<span>データに複写する。
	data0_BODY1();
	data0_BODY2();
	data0_BODY3();
}

function data0_BODY1() { // 画面BODY1へデータを表示する。ページはb1pageを使う。
	$('input.BODY1').val('');
	$('span.BODY1,span.xBODY1').text('');
	for (var i=1;i<=6;i++) {
		$('#dispGno_'+i).text(b1page*6+i);
		var i_1=b1page*6+i-1; // 最初は0
		if (data0.SioriGenMrs && data0.SioriGenMrs[i_1]) {
			$('#fieldGito_'+i).val(data0.SioriGenMrs[i_1]['gito']);
			$('#fieldKota_'+i).val(data0.SioriGenMrs[i_1]['kota']);
			$('#fieldKik1_'+i).val(data0.SioriGenMrs[i_1]['kik1']);
			$('#fieldKtni_'+i).val(data0.SioriGenMrs[i_1]['ktni']);
			$('#fieldKk2t_'+i).val(data0.SioriGenMrs[i_1]['kk2t']);
			$('#fieldKk2_'+i).val(data0.SioriGenMrs[i_1]['kk2']);
			$('#fieldBiko_'+i).val(data0.SioriGenMrs[i_1]['biko']);
			var j=0;
			data0.SioriGenMrs[i_1]['SioriGenKonMrs'].forEach(function(SioriGenKonMr) {
				if (j<4) {
					j++;
					$('#fieldKon_'+i+'_'+j).val(SioriGenKonMr.kon);
					$('#fieldRit_'+i+'_'+j).val(SioriGenKonMr.rit);
				}
			});
		}
	GRPinput2span('BODY1'); // 現在グループの<input>データを表示用<span>データに複写する。
	}
}

function data0_BODY2() { // 画面BODY2へデータを表示する。ページはb2pageを使う。
	$('input.BODY2').val('');
	$('span.BODY2,span.xBODY2').text('');
	for (var i=1;i<=12;i++) {
		$('#dispKno_'+i).text(b2page*12+i+30);
		var i_1=b2page*12+i-1; // 最初は0
		if (data0.SioriNenMrs && data0.SioriNenMrs[i_1]) {
			$('#fieldIjun_'+i).val((data0.SioriNenMrs[i_1]['tjun']+' ').substr(0,1)
									+data0.SioriNenMrs[i_1]['yjun']);
			$('#fieldIto1_'+i).val(data0.SioriNenMrs[i_1]['ito1']);
			$('#fieldHon1_'+i).val(data0.SioriNenMrs[i_1]['hon1']);
			$('#fieldIto2_'+i).val(data0.SioriNenMrs[i_1]['ito2']);
			$('#fieldHon2_'+i).val(data0.SioriNenMrs[i_1]['hon2']);
			$('#fieldKote_'+i).val(data0.SioriNenMrs[i_1]['kote']);
			$('#fieldHoko_'+i).val(data0.SioriNenMrs[i_1]['hoko']);
			$('#fieldYori_'+i).val(data0.SioriNenMrs[i_1]['yori']);
			$('#fieldKbn1_'+i).val(data0.SioriNenMrs[i_1]['kbn2']);
			$('#fieldKbn2_'+i).val(data0.SioriNenMrs[i_1]['kbn2']);
			$('#fieldKako_'+i).val(data0.SioriNenMrs[i_1]['kako']);
			$('#dsipKohi_'+i).text(data0.SioriNenMrs[i_1]['kohi']);
		}
	}
	GRPinput2span('BODY2'); // 現在グループの<input>データを表示用<span>データに複写する。
}

function data0_BODY3() { // 画面BODY3へデータを表示する。ページはb3pageを使う。
	$('input.BODY3').val('');
	$('span.BODY3,span.xBODY3').text('');
	for (var i=1;i<=5;i++) {
		var i_1=b3page*5+i-1; // 最初は0
		if (data0.SioriItoMrs && data0.SioriItoMrs[i_1]) {
			$('#dispMjun_'+i).text((data0.SioriItoMrs[i_1]['tjun']+' ').substr(0,1)
									+data0.SioriItoMrs[i_1]['yjun']);
			$('#fieldDenl_'+i).val(data0.SioriItoMrs[i_1]['denl']);
			$('#fieldOndo_'+i).val(data0.SioriItoMrs[i_1]['ondo']);
			$('#fieldHun_'+i).val(data0.SioriItoMrs[i_1]['hun']);
			$('#fieldNori_'+i).val(data0.SioriItoMrs[i_1]['nori']);
			$('#dispItom_'+i).text(data0.SioriItoMrs[i_1]['itom']);
		}
	}
	for (var i=1;i<=2;i++) {
		var i_1=b3page*2+i-1; // 最初は0
		if (work0.SioriChuijMrs[i_1]) {
			$('#fieldChuj_'+i).val(work0.SioriChuijMrs[i_1].chui);
		}
	}
	GRPinput2span('BODY3'); // 現在グループの<input>データを表示用<span>データに複写する。
}
