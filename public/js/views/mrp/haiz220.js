window.onload = function(){
	showNowDate();
    setInterval("showNowDate()", 10000);
	parent_grpNOW=window.parent.p2c_grpNOW(); // 親ウインドウの関数を実行（現在入力グループ名を得る）
	g1=window.parent.p2c_g1(); // 親ウインドウの関数を実行（共通の格納領域を得る）
	get_data_set(); // 共通の格納領域から画面フォームへ表示
	if (parent_grpNOW === 'TAIL') {
		grp_READ('TAIL');
	} else {
		grp_READ('BODY');
	}
	addForm1(); // モーダル呼出post用フォームを追加
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

function addForm1(){ // モーダル呼出post用フォームを追加
//	var form1 = $('<form></form>',{id:'form1',action:''+modal_ito,target:'iframe1',method:'POST',name:'iframe1form'}).hide();
//	$('body').append(form1);
//	form1.append($('<input>',{type:'hidden',name:'kousin_user_id',value:my_id}));
//	form1.append($('<input>',{type:'hidden',name:'denpyou_mr_cd',value:'shiire'}));
}

var parent_grpNOW; // 親ウインドウの現在入力グループ名
var g1={}; // 連想配列：javascriptとphp連絡の作業領域

var grpNOW='';
var bpage=0; // 現時点MAX=2

function grp_READ(grp) {
console.log('grp_READ('+grp);
	if (grp) {grpNOW=grp;}
	grp_read_ctl(); // 現在グループの表示と非表示を設定する。
	$("input."+grpNOW)[0].focus(); // 最初の項目を選択する。
	$("input."+grpNOW)[0].select(); // 前行とつなげると変になるので、面倒でも分けた。
}

function grp_read_ctl() { // 現在グループの表示と非表示を設定する。
	$('.fALLF').prop('disabled',true);
	$('.f'+grpNOW).prop('disabled',false);
	$('input.ALLF').not('.'+grpNOW).css('display','none');
	$('span.xALLF').not('.x'+grpNOW).css('display','inline');
	$('input.'+grpNOW).css('display','inline');
	$('span.x'+grpNOW).css('display','none');
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
	GRPinput2span(); // 現在グループの<input>データを表示用<span>データに複写する。
	window[grpNOW+'_to_g1'](); // 画面データをg1へ複写する。
	g1.errflg = 0;
	g1.emsg = '';
	g1.errfld = '';
	window[grpNOW+'_CHECK'](); // 単純チェック [].内の名前の関数を実行する。例：grpNOWが'HEAD'なら、HEAD_CHECK()が実行される。
	if (g1.errflg == 1) {
		ANSWER();
	} else {
		ajaxGrpDo('CHECK'); // 複雑チェック、マスターチェック等
	}
}

function ANSWER() {
	$('#dispEmsg').text(g1.emsg); // エラーメッセージ表示
	if (g1.errflg != 0) {
		if (g1.errflg == 1) {
			audio.play();
			grp_READ();
		}
		if (g1.errfld) {	// エラー項目を指定してあればカーソルをそこにする
			$('#field'+g1.errfld).focus().select();
		} //	grp_READ();に戻る
	} else {
		switch (grpNOW) {
			case "BODY":
				grp_READ('TAIL');
				break;
			case "TAIL":
				switch (g1.skbn) {
					case '1':
					case '2':
						g1_to_parent();
						window.parent.c2p_g1(g1); // 親ウインドウの関数を実行（共通の格納領域を返す）
						break;
					case '0':
					case '3':
					case '4':
					case '9':
						break;
				}
				window.parent.fromModal(); // 親に戻る
				break;
		}
	}
}

function CANCEL() {
	g1_to_GAMEN(); // 入力中データを戻す。
	switch (grpNOW) {
		case "BODY":
			window.parent.fromModal(); // 親に戻る
			break;
		case "TAIL":
				switch (g1.skbn) {
					case '1':
					case '2':
						grp_READ('BODY');
						break;
					case '0':
					case '3':
					case '4':
					case '9':
						window.parent.fromModal(); // 親に戻る
						break;
				}
			break;
	}
}

function NEXT() {
	g1.errflg = 0;
	g1.emsg = '';
	g1.errfld = '';
	switch (grpNOW) {
		case "BODY":
			BODY_to_g1();
			if (bpage<2) {
				bpage++;
				g1_to_BODY();
			}
			break;
		case "TAIL":
			if (bpage<2) {
				bpage++;
			}
			g1_to_GAMEN();
			grp_READ();
			break;
	}
}

function BACK() {
	g1.errflg = 0;
	g1.emsg = '';
	g1.errfld = '';
	switch (grpNOW) {
		case "BODY":
			BODY_to_g1();
			if (bpage>0) {
				bpage--;
				g1_to_BODY();
			}
			break;
		case "TAIL":
			if (bpage>0) {
				bpage--;
			}
			g1_to_GAMEN();
			grp_READ();
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

function BODY_CHECK() { // 単純チェック
}

function BODY_to_g1() {
	g1.htkb = $('#fieldHtkb').val();
	g1.htsi = $('#fieldHtsi').val();
	g1.hykb = $('#fieldHykb').val();
	for (var i=1;i<=2;i++) {
		var i1 = bpage * 2 + i - 1;
		g1.chui[0][i1] = $('#fieldTchu_'+i).val().replace(/\s+$/, ""); // rtrim同等
		g1.chui[1][i1] = $('#fieldYchu_'+i).val().replace(/\s+$/, ""); // rtrim同等
		g1.chui[2][i1] = $('#fieldMchu_'+i).val().replace(/\s+$/, ""); // rtrim同等
	}
	for (var i=1;i<=8;i++) {
		var i1 = bpage * 8 + i - 1;
		g1.htkg[i1] = $('#fieldHtkg_'+i).val().replace(/\s+$/, ""); // rtrim同等
		g1.hykg[i1] = $('#fieldHykg_'+i).val().replace(/\s+$/, ""); // rtrim同等
	}
}

function TAIL_CHECK() { // 単純チェック
}

function TAIL_to_g1() {
}

function ajaxGrpDo(TODO) { // 現在グループのチェック等
	bpage = 0;
	$.ajax({
		type:"POST",
		url:haiz220_ajaxGrpDo,
		data:{'todo':grpNOW+'_'+TODO,'g1':g1,},
		async:true,
		dataType:'json',
		success: function (data) {
			g1=data;
			if (g1.errflg != '1') {
				g1_to_GAMEN();
			}
			if (TODO == 'CHECK') {
				ANSWER();
			}
			$('#point_1').text('');
			for (var i=0;i<g1.point_1.length;i++) {
				$('#point_1').append(g1.point_1[i]+'<br>');
			}
		},
		error: function(xhr, status, err) {
			alert('エラー haiz220_ajaxGrpDo '+status+'/'+err);
		},
	});
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
	$('#dispSino').text(g1.cd.substr(0,6));
	$('#dispSied').text(g1.cd.substr(6));

	g1.chui = []; // このhaiz220用にchuiはクリアする。
	subIfNonCrt(); // 未定義配列を作る
	g1.chui_cnt1=0;
	var i0=0; // 始めは0
	var i1=0; // 始めは0
	var i2=0; // 始めは0
	g1.HSichuiMrs.forEach(function(HSichuiMr) {
		if (HSichuiMr.tais == '経糸配列') {
			g1.chui[0][i0++]=HSichuiMr.chui;
		} else if (HSichuiMr.tais == '緯糸配列') {
			g1.chui[1][i1++]=HSichuiMr.chui;
		} else if (HSichuiMr.tais == '耳糸配列') {
			g1.chui[2][i2++]=HSichuiMr.chui;
		} else {
			g1.chui_cnt1++;
		}
	});
	grpNOW = 'ALLF'; // ALLFということにする。
	ajaxGrpDo('SET'); // ALLF_SET をPHP側で実行

	g1_to_GAMEN();
}

function subIfNonCrt() { // 未定義配列を作る
	if (!g1.tkig) {g1.tkig=[];}
	if (!g1.ykig) {g1.ykig=[];}
	if (!g1.douk) {g1.douk=[];}
	if (!g1.kais) {g1.kais=[];}
	if (!g1.htkg) {g1.htkg=[];}
	if (!g1.tkur) {g1.tkur=[];}
	if (!g1.ykur) {g1.ykur=[];}
	if (!g1.EHq) {g1.EHq=[];}
	if (!g1.chui) {g1.chui=[];}
	if (!g1.chui[0]) {g1.chui[0]=[];}
	if (!g1.chui[1]) {g1.chui[1]=[];}
	if (!g1.chui[2]) {g1.chui[2]=[];}
	if (!g1.HSiitoMrs) {g1.HSiitoMrs = [];}
	if (!g1.HSichuiMrs) {g1.HSichuiMrs = [];}
}

function g1_to_GAMEN() { // 画面BODYへデータを表示する。ページはbpageを使う。
	$('input.BODY').val('');
	$('span.BODY,span.xBODY').text('');
	$('#dispPage').text(bpage + 1);
	$('#fieldHtkb').val(g1.htkb);
	$('#fieldHtsi').val(g1.htsi);
	$('#fieldHykb').val(g1.hykb);
	subIfNonCrt(); // 未定義配列を作る
	for (var i= 1; i <= 2;i++ ) {
		var i0 = i - 1 + bpage * 2;
		$('#fieldTchu_'+i).val(g1.chui[0][i0]);
		$('#fieldYchu_'+i).val(g1.chui[1][i0]);
		$('#fieldMchu_'+i).val(g1.chui[2][i0]);
	}
	for (var i= 1; i <= 4; i++) {
		var i0 = i - 1 + bpage * 4;
		$('#dispTkig_'+i).text($.htmlspecialchars(g1.tkig[i0]||''));
		$('#dispTkur_'+i).text($.htmlspecialchars(g1.tkur[i0]||''));
		$('#dispYkig_'+i).text($.htmlspecialchars(g1.ykig[i0]||''));
		$('#dispYkur_'+i).text($.htmlspecialchars(g1.ykur[i0]||''));
	}
	for (var i= 1; i <= 8; i++) {
		var i0 = i - 1 + bpage * 8;
		$('#fieldHtkg_'+i).val(g1.htkg[i0]||'');
		$('#fieldHykg_'+i).val(g1.hykg[i0]||'');
		$('#dispTjun_'+i).text(i<=g1.EHq.length?g1.EHq[i - 1].tjun||'':'');
		$('#dispThon_'+i).text(i<=g1.EHq.length?g1.EHq[i - 1].thon||'':'');
		$('#dispYjun_'+i).text(i<=g1.EHq.length?g1.EHq[i - 1].yjun||'':'');
		$('#dispYhon_'+i).text(i<=g1.EHq.length?g1.EHq[i - 1].yhon||'':'');
	}
	$('#dispHtme').text(g1.htme);
	$('#dispHtho').text(g1.htho);
	$('#dispHyme').text(g1.hyme);
	$('#dispHyho').text(g1.hyho);

	GRPinput2span('ALLF'); // 全グループの<input>データを表示用<span>データに複写する。
}

function g1_to_parent() {
	if (!g1.HSichuiMrs) {
		g1.HSichuiMrs = [];
	}
	for (var i = 0; i < g1.HSichuiMrs.length; i++) {
		if (g1.HSichuiMrs[i].tais == '経糸配列'
		 || g1.HSichuiMrs[i].tais == '緯糸配列'
		 || g1.HSichuiMrs[i].tais == '耳糸配列') {
			g1.HSichuiMrs[i].tacd = '';
			g1.HSichuiMrs[i].tais = '';
			g1.HSichuiMrs[i].chui = '';
		}
	}
	var tacd = ['G','H','J'];
	var i1 = 0;
	for (var i = 0; i < 3; i++) {
		for (var i0 = 0; i0 < g1.chui[i].length; i0++) {
			for (; i1 < g1.HSichuiMrs.length; i1++) {
				if (g1.HSichuiMrs[i1].tais == '') {break;}
			}
			if (i1 >= g1.HSichuiMrs.length) {
				g1.HSichuiMrs[i1]={};
			}
			g1.HSichuiMrs[i1].tais=g1.chui[i][i0].tais;
			g1.HSichuiMrs[i1].tacd=tacd[i];
			g1.HSichuiMrs[i1].chui=g1.chui[i][i0].chui;
		}
	}
}
