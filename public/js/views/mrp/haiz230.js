window.onload = function(){
	showNowDate();
    setInterval("showNowDate()", 10000);
	parent_grpNOW=window.parent.p2c_grpNOW(); // 親ウインドウの関数を実行（現在入力グループ名を得る）
	g1=window.parent.p2c_g1(); // 親ウインドウの関数を実行（共通の格納領域を得る）
	get_data_set(); // 共通の格納領域から画面フォームへ表示
	if (parent_grpNOW == 'TAIL') {
		grp_READ('TAIL');
	} else {
		grp_READ('HEAD');
	}
};

//現在時刻を表示する関数
function showNowDate(){
  var now = new Date();
  $('#dispYMDHM').text(now.getFullYear()+'-'+
	('0'+(now.getMonth()+1)).slice(-2)+'-'+
	('0'+now.getDate()).slice(-2)+' '+
	('0'+now.getHours()).slice(-2)+':'+
	('0'+now.getMinutes()).slice(-2));
}

var parent_grpNOW; // 親ウインドウの現在入力グループ名
var g1={}; // 連想配列：javascriptとphp連絡の作業領域

var grpNOW='TAIL';
var c1pag = 0;
var c2pag = 0;
var c1pmax = 3; // 現時点MAX
var c2pmax = 29; // 現時点MAX
var PTNUPD = 0;
var AYAUPD = 0;

function grp_READ(grp) { // 指定グループを入力モードにする。
	if (grp) {grpNOW=grp;}
	grp_read_ctl(); // 現在グループの表示と非表示を設定する。
	$("input."+grpNOW)[0].focus(); // 最初の項目を選択する。
	$("input."+grpNOW)[0].select(); // 前行とつなげると変になるので、面倒でも分けた。
}

function grp_read_ctl() { // 現在グループの表示と非表示を設定する。
	$('.fALLF').prop('disabled',true); // ファンクションキー無効
	$('.f'+grpNOW).prop('disabled',false);
	$('input.ALLF').not('.'+grpNOW).css('display','none');
	$('span.xALLF').not('.x'+grpNOW).css('display','inline');
	$('input.'+grpNOW).css('display','inline');
	$('span.x'+grpNOW).css('display','none');
}

$('#ESC').click(function() {
	CANCEL();
});

$('#F0').focusin(function(e) { // グループ最終項目でエンターしたらF12同様の動作する
	var c = lastkeypress.which ? lastkeypress.which : lastkeypress.keyCode;
	if (c==13 && !lastkeypress.shiftKey) {
		$('#F12').focus();
		ENTER();
	} else {
		grp_READ();
	}
});

$('.BODY2').keypress(function(e) {
//alert(e.keyCode);
	if (e.which == 32 || e.which == 42 || e.keyCode == 39) { // 32空白、42*、39→
		var thistd=$("#"+lastfocusin).parent();
		thistd.nextAll().eq(0).children('input').focus().select();
	} else if (e.keyCode == 37) { // 37←
		var thistd=$("#"+lastfocusin).parent();
		thistd.prevAll().eq(0).children('input').focus().select();
	}
	if (e.keyCode == 39 || e.keyCode == 37) {return false;}
});


function ENTER() {
	GRPinput2span(); // 現在グループの<input>データを表示用<span>データに複写する。
	window[grpNOW+'_to_g1'](); // 画面データをg1へ複写する。
	g1.errflg = 0;
	g1.emsg = '';
	g1.errfld = '';
	window[grpNOW+'_CHECK'](); // 単純チェック []内の名前の関数を実行する。例：grpNOWが'HEAD'なら、HEAD_CHECK()が実行される。
	if (g1.errflg == 1) {
		ANSWER();
	} else {
		ajaxGrpDo('CHECK'); // 複雑チェック、マスターチェック等
	}
}

function grp_READ_BODY1() {
	grp_READ('BODY1');
	if (g1.socd) {
		$('#fieldSoth,#fieldSoyh,#fieldSome').css('display','none');
		$('#dispSoth ,#dispSoyh ,#dispSome ').css('display','inline');
		$('#fieldChui_1').focus().select();
	} else { // 組織図名は入力不可で織物ﾀｲﾌﾟを組織図名とする。
		$('#fieldSome').css('display','none');
		$('#dispSome ').css('display','inline');
		$('#fieldSoth').focus().select();
	}
}

function ANSWER() {
	$('#dispEmsg').text(g1.emsg); // エラーメッセージ表示
	if (g1.errflg == 1) {
		audio.play();
		if (g1.errfld) {	// エラー項目を指定してあればカーソルをそこにする
			$('#field'+g1.errfld).focus().select();
		} //	grp_READ();に戻る
	} else {
		switch (grpNOW) {
			case "HEAD":
				grp_READ_BODY1();
				break;
			case "BODY1":
				if (g1.socd != '') { // PTNUPD == 1
					grp_READ('BODY4');
				} else {
					grp_READ('BODY2');
				}
				break;
			case "BODY2":
				grp_READ('BODY4');
				break;
			case "BODY3":
				grp_READ('BODY2');
				break;
			case "BODY3A":
				grp_READ('BODY4');
				break;
			case "BODY4":
				if (g1.aycd) {
					grp_READ('BODY6');
				} else {
					grp_READ('BODY5');
				}
				break;
			case "BODY5":
				grp_READ('TAIL');
				break;
			case "BODY6":
				grp_READ('TAIL');
				break;
			case "TAIL":
				if (parent_grpNOW != 'TAIL') {
					g1_to_parent();
				}
				window.parent.fromModal();
				break;
		}
	}
}

function CANCEL() {
	g1_to_GAMEN(); // 入力中データを戻す。
	switch (grpNOW) {
		case "HEAD":
			window.parent.fromModal(); // 親に戻る
			break;
		case "BODY1":
			grp_READ('HEAD');
			break;
		case "BODY2":
			grp_READ_BODY1();
			break;
		case "BODY3":
			grp_READ('BODY2');
			break;
		case "BODY3A":
			grp_READ('BODY4');
			break;
		case "BODY4":
			if (g1.socd == '') { // PTNUPD == 0
				grp_READ('BODY2');
			} else {
				grp_READ_BODY1();
			}
			break;
		case "BODY5":
			grp_READ('BODY4');
			break;
		case "BODY6":
			grp_READ('BODY4');
			break;
		case "TAIL":
			if (parent_grpNOW == 'TAIL') {
				window.parent.fromModal();;
			} else if (g1.aycd) {
				grp_READ('BODY6');
			} else {
				grp_READ('BODY5');
			}
			break;
	}
}

function NEXT() {
	switch (grpNOW) {
		case "BODY1":
		case "BODY5":
		case "BODY6":
			window[grpNOW+'_to_g1']();
			if (c1pag < c1pmax) {
				c1pag++;
				g1_to_GAMEN();
			}
			break;
		case "BODY2":
		case "BODY3":
			window[grpNOW+'_to_g1']();
			if (c2pag < c2pmax) {
				c2pag++;
				g1_to_GAMEN();
			}
			break;
		case "TAIL":
			if (c1pag < c1pmax) {
				c1pag++;
			}
			if (c2pag < c2pmax) {
				c2pag++;
			}
			g1_to_GAMEN();
			break;
	}
}

function BACK() {
	switch (grpNOW) {
		case "BODY1":
		case "BODY5":
		case "BODY6":
			window[grpNOW+'_to_g1']();
			if (c1pag > 0) {
				c1pag--;
				g1_to_GAMEN();
			}
			break;
		case "BODY2":
		case "BODY3":
			window[grpNOW+'_to_g1']();
			if (c2pag > 0) {
				c2pag--;
				g1_to_GAMEN();
			}
			break;
		case "TAIL":
			if (c1pag > 0) {
				c1pag--;
			}
			if (c2pag > 0) {
				c2pag--;
			}
			g1_to_GAMEN();
			break;
	}
}

function GRPinput2span(grp) { // (省略時=現在)グループの<input>データを表示用<span>データに複写する。
	if (!grp) {grp=grpNOW;}
	formGRP[grp].forEach (function(fldName) {
		if ($('#field'+fldName).length) {
			$('#disp'+fldName).text($.htmlspecialchars($('#field'+fldName).val()));
		}
	});
}

function ajaxGrpDo(TODO) { // 現在グループのチェック等
	bpage = 0;
	$.ajax({
		type:"POST",
		url:haiz230_ajaxGrpDo,
		data:{'todo':grpNOW+'_'+TODO,'g1':g1,},
		async:true,
		dataType:'json',
		success: function (data) {
			g1=data;
			if (g1.errflg != '1') {
				g1_to_GAMEN();
			}
			ANSWER();
			$('#point_1').text('');
			for (var i=0;i<g1.point_1.length;i++) {
				$('#point_1').append(g1.point_1[i]+'<br>');
			}
		},
		error: function(xhr, status, err) {
			alert('エラー haiz230_ajaxGrpDo '+status+'/'+err);
		},
	});
}

function HEAD_to_g1() {
	g1.socd = $('#fieldSocd').val().replace(/\s+$/g, '').toUpperCase(); // rtrim
}

function HEAD_CHECK() { // 単純チェック
//	if () { // エラーチェック
//		g1.errflg = 0;
//		g1.emsg='エラーメッセージ';
//		g1.errfld='XXXXX'; // エラー項目にフォーカス可能
//		return;
//	}
}

function BODY1_to_g1() {
	g1.soth = $('#fieldSoth').val();
	g1.soyh = $('#fieldSoyh').val();
	g1.some = $('#fieldSome').val().replace(/\s+$/g, '').toUpperCase();
	g1.chui[c1pag*2] = $('#fieldChui_1').val().replace(/\s+$/g, '').toUpperCase();
	g1.chui[c1pag*2+1] = $('#fieldChui_2').val().replace(/\s+$/g, '').toUpperCase();
}

function BODY1_CHECK() { // 単純チェック
	if ( g1.socd == '' && (g1.soth == 0 || g1.soth > 16)) { // ZERO …0
		g1.errflg = 1;
		g1.emsg = "経の大きさがおかしい。";
		g1.errfld='Soth'; // エラー項目にフォーカス可能
		return;
	}
	if ( g1.socd == '' && (g1.soyh == 0 || g1.soyh > 600)) { // ZERO …0
		g1.errflg = 1;
		g1.emsg = "緯の大きさがおかしい。";
		g1.errfld='Soyh'; // エラー項目にフォーカス可能
		return;
	}
	chui_ovrf_CHECK();
}

function BODY2_to_g1() {
	for (var i = 1; i <= 20; i++) {
		var w_patn = 0;
		for (var j = 16; j >= 1; j--) {
			w_patn *= 2;
			if ($('#fieldPatn_'+i+'_'+j).val()=='*') {
				w_patn++;
			}
		}
		g1.patn[c2pag*20+i-1] = w_patn;
	}
}

function BODY2_CHECK() { // 単純チェック
	for (var i=1;i<=20;i++) {
		for (var j=1;j<=16;j++) {
			switch($('#fieldPatn_'+i+'_'+j).val()) {
				case '*':
				case ' ':
				case '':
					break;
				default :
					g1.errflg = 1;
					g1.emsg='組織図には*か空白を入れてください。';
					g1.errfld='Patn_'+i+'_'+j; // エラー項目にフォーカス可能
					return;
					break;
			}
		}
	}
}

function BODY3_to_g1() {
}

function BODY3_CHECK() { // 単純チェック
}

function BODY3A_to_g1() {
//	g1.htkb = $('#fieldHtkb').val();
//	g1_to_GAMEN();
}

function BODY3A_CHECK() { // 単純チェック
}

function BODY4_to_g1() {
	g1.aycd = $('#fieldAycd').val();
	g1.ayma = $('#fieldAyma').val();
}

function BODY4_CHECK() { // 単純チェック
}

function BODY5_to_g1() {
	g1.ayme = $('#fieldAyme').val();
	g1.aych[c1pag*2] = $('#fieldAych_1').val().replace(/\s+$/g, '');
	g1.aych[c1pag*2+1] = $('#fieldAych_2').val().replace(/\s+$/g, '');
	if (!g1.HSiayaMrs) {g1.HSiayaMrs = [];}
	for (var i=1; i <= 10; i++) {
		var j = c1pag * 10 + i - 1;
		if (!g1.HSiayaMrs[j]) {g1.HSiayaMrs[j] = {};}
		g1.HSiayaMrs[j].kigo = $('#fieldAykg_'+i).val().replace(/\s+$/g, '');
	}
}

function BODY5_CHECK() { // 単純チェック
	chui_ovrf_CHECK(); // 注釈オーバーチェック
}

function BODY6_to_g1() {
	g1.aych[c1pag*2] = $('#fieldAych_1').val().replace(/\s+$/g, '');
	g1.aych[c1pag*2+1] = $('#fieldAych_2').val().replace(/\s+$/g, '');
}

function BODY6_CHECK() { // 単純チェック
	chui_ovrf_CHECK();
}

function TAIL_to_g1() {
//	g1.htkb = $('#fieldHtkb').val();
//	g1_to_GAMEN();
}

function TAIL_CHECK() { // 単純チェック
}

function chui_ovrf_CHECK() { // 各注意事項の件数オーバーをチェック
	var jj = 0;
	for (var ii = 1; ii > 8; ii++) {
		if ( g1.chui [ ii ] != '') {
			jj++;
		}
		if ( g1.aych [ ii ] != '') {
			jj++;
		}
	}
	if ( jj + g1.cuicnt > 16) {
		g1.errflg = 1;
		g1.emsg = "注意事項が多過ぎます。";
		return;
	}
}



(function($) {
    $.extend({
		htmlspecialchars: function htmlspecialchars(ch){
//				ch = ch.replace(/&/g,"&amp;") ;
//			    ch = ch.replace(/"/g,"&quot;") ;
//			    ch = ch.replace(/'/g,"&#039;") ;
//			    ch = ch.replace(/</g,"&lt;") ;
//			    ch = ch.replace(/>/g,"&gt;") ;
			    ch = ch.replace(/ /g,'\u00a0') ; // $().text(…)では空白を直さないので
//			    ch = ch.replace(/\r?\n/g, '<br>') ;
			    return ch ;
			}
	});
})(jQuery);

function get_data_set() {
	g1.patn = [];
	for(var i=0;i<300;i++){g1.patn[i]=0;} // 有無にかかわらず初期化
	$('#dispSino').text(g1.cd.substr(0,6));
	$('#dispSied').text(g1.cd.substr(6));
	if (!g1.socd) {
		for (var i=0; i<g1.HSisosikiMrs.length; i++) {
			g1.patn[i]=g1.HSisosikiMrs[i].line;
		}
	} else {
		if (g1.HSosikiMr) {
			if (!g1.HSosikiMr[0]) {g1.HSosikiMr[0] = {};}
			g1.soth=g1.HSosikiMr[0].soth;
			g1.soyh=g1.HSosikiMr[0].soyh;
			g1.some=g1.HSosikiMr[0].type;
			if (!g1.HSosikiMr[0].HSisosikiMrs) {g1.HSosikiMr[0].HSisosikiMrs = [];}
			for (var i=0; i<g1.HSosikiMr[0].HSisosikiMrs.length; i++) {
				g1.patn[i]=g1.HSosikiMr[0].HSisosikiMrs[i].line;
			}
		}
	}
	g1.chui_cnt=0;
	g1.chui = [];
	g1.aych = [];
	if (g1.HSichuiMrs) {
		var i1=0; // 始めは0
		var i2=0; // 始めは0
		g1.HSichuiMrs.forEach(function(HSichuiMr) {
			if (HSichuiMr.tais == '組織図') {
				g1.chui[i1++]=HSichuiMr.chui;
			} else if (HSichuiMr.tais == '綾通し順') {
				g1.aych[i2++]=HSichuiMr.chui;
			} else {
				g1.chui_cnt++;
			}
		});
	}

	g1_to_GAMEN();
}

function g1_to_GAMEN() { // 画面へデータを表示する。ページを使う。
	$('#fieldSocd').val(g1.socd);
	$('#fieldSoth').val(g1.soth);
	$('#fieldSoyh').val(g1.soyh);
	$('#fieldSome').val(g1.some);
	if (!g1.patn) {g1.patn = [];}
	for (var i = 1; i <= 20; i++) {
		$('#dispYpag_' + i).text(c2pag * 20 + i);
		if (g1.patn.length > c2pag * 20 + i - 1) {
			var w_patn = '00000000000000000' + (1 * g1.patn[c2pag*20+i-1]).toString(2);
			for (var j = 1; j <= 16; j++) {
				$('#fieldPatn_'+i+'_'+j).val(w_patn.substr(-j,1).replace('0', '').replace('1', '*'));
			}
		} else {
			for (var j = 1; j <= 16; j++) {
				$('#fieldPatn_'+i+'_'+j).val('');
			}
		}
	}
	$('#dispPage').text(c1pag+1);
	if (!g1.chui) {g1.chui = [];}
	if (!g1.aych) {g1.aych = [];}
	for (var i = 1; i <= 2 && g1.chui.length > c1pag * 2 + i - 1; i++) {
		if (g1.chui.length > c1pag * 2 + i - 1) {
			$('#fieldChui_'+i).val(g1.chui[c1pag*2+i-1]);
		} else {
			$('#fieldChui_'+i).val('');
		}
		if (g1.aych.length > c1pag * 2 + i - 1) {
			$('#fieldAych_'+i).val(g1.aych[c1pag*2+i-1]);
		} else {
			$('#fieldAych_'+i).val('');
		}
	}
	if (g1.aycd) { // 参照用綾通し
		if (!g1.HSiayaMr2s) {g1.HSiayaMr2s = [];}
		for (var i = 1; i <= 10; i++) {
			var j = c1pag * 10 + i - 1;
			if (g1.HSiayaMr2s.length > j) {
				$('#fieldAykg_'+i).val(g1.HSiayaMr2s[j].kigo);
			} else {
				$('#fieldAykg_'+i).val('');
			}
		}
	} else { // 独特の綾通し
		if (!g1.HSiayaMrs) {g1.HSiayaMrs = [];}
		for (var i = 1; i <= 10; i++) {
			var j = c1pag * 10 + i - 1;
			if (g1.HSiayaMrs.length > j) {
				$('#fieldAykg_'+i).val(g1.HSiayaMrs[j].kigo);
			} else {
				$('#fieldAykg_'+i).val('');
			}
		}
	}
	$('#fieldAycd').val(g1.aycd);
	$('#fieldAyma').val(g1.ayma);
	$('#fieldAyho').val(g1.ayho);
	$('#fieldAyme').val(g1.ayme);

	GRPinput2span('ALLF'); // 全グループの<input>データを表示用<span>データに複写する。
}

function g1_to_parent() { // 画面データg1を親に複写する。
	if (g1.socd=='') {
		//g1.some=g1.some; // 組織名。まだ項目を作っていない。
		if (g1.HSisosikiMrs) {
			for (var i = 0; i < g1.HSisosikiMrs.length; i++) {
				g1.HSisosikiMrs[i].line = '';
			}
		} else {
			g1.HSisosikiMrs=[];
		}
		for (var i=0; i < g1.patn.length && g1.patn[i] > 0; i++) {
			if (i >= g1.HSisosikiMrs.length) {
				g1.HSisosikiMrs[i] = {};
			}
			g1.HSisosikiMrs[i].line = g1.patn[i];
		}
	}
	if (!g1.HSichuiMrs) {
		g1.HSichuiMrs = [];
	}
	for (var i = 0; i < g1.HSichuiMrs.length; i++) {
		if (g1.HSichuiMrs[i].tais == '組織図' || g1.HSichuiMrs[i].tais == '綾通し順') {
			g1.HSichuiMrs[i].tacd = '';
			g1.HSichuiMrs[i].tais = '';
			g1.HSichuiMrs[i].chui = '';
		}
	}
	var i1 = 0;
	for (var i = 0; i < g1.aych.length; i++) {
		if (g1.aych[i]) {
			for (; i1 < g1.HSichuiMrs.length; i1++) {
				if (g1.HSichuiMrs[i1].tais == '') {break;}
			}
			if (i1 >= g1.HSichuiMrs.length) {
				g1.HSichuiMrs[i1]={};
			}
			g1.HSichuiMrs[i1].tais='綾通し順';
			g1.HSichuiMrs[i1].tacd='E';
			g1.HSichuiMrs[i1].chui=g1.aych[i];
		}
	}
	for (var i = 0; i < g1.chui.length; i++) {
		if (g1.chui[i]) {
			for (; i1 < g1.HSichuiMrs.length; i1++) {
				if (g1.HSichuiMrs[i1].tais == '') {break;}
			}
			if (i1 >= g1.HSichuiMrs.length) {
				g1.HSichuiMrs[i1]={};
			}
			g1.HSichuiMrs[i1].tais='組織図';
			g1.HSichuiMrs[i1].tacd='F';
			g1.HSichuiMrs[i1].chui=g1.chui[i];
		}
	}

	window.parent.c2p_g1(g1); // 親ウインドウの関数を実行（共通の格納領域を返す）
}
