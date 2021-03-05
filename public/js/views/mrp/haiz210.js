window.onload = function(){
	showNowDate();
	setInterval("showNowDate()", 10000);
	parent_grpNOW=window.parent.p2c_grpNOW(); // 親ウインドウの関数を実行（現在入力グループ名を得る）
	g1=window.parent.p2c_g1(); // 親ウインドウの関数を実行（共通の格納領域を得る）
	get_data_set(); // 共通の格納領域から画面フォームへ表示
	if (parent_grpNOW == 'TAIL') {
		grp_READ('TAIL');
	} else {
		grp_READ('BODY1');
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
var g1={}; // 連想配列：javascriptとphp連絡の作業領域

var grpNOW='';
var b1page=0; // 現時点MAX=2
var b2page=0;
var b3page=0;

function grp_READ(grp) {
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
		$('#F12').focus();
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
			case "BODY1":
				grp_READ('BODY2');
				break;
			case "BODY2":
				grp_READ('BODY3');
				break;
			case "BODY3":
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
		case "BODY1":
			window.parent.fromModal(); // 親に戻る
			break;
		case "BODY2":
			grp_READ('BODY1');
			break;
		case "BODY3":
			grp_READ('BODY2');
			break;
		case "TAIL":
				switch (g1.skbn) {
					case '1':
					case '2':
						grp_READ('BODY3');
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
		case "BODY1":
			BODY1_to_g1();
			if (b1page<2) {
				b1page++;
				g1_to_BODY1();
			}
			break;
		case "BODY2":
			BODY2_to_g1();
			if (b2page<2) {
				b2page++;
				g1_to_BODY2();
			}
			break;
		case "BODY3":
			BODY3_to_g1();
			if (b3page<2) {
				b3page++;
				g1_to_BODY3();
			}
			break;
		case "TAIL":
			if (b1page<2) {
				b1page++;
			}
			if (b2page<2) {
				b2page++;
			}
			if (b3page<2) {
				b3page++;
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
		case "BODY1":
			BODY1_to_g1();
			if (b1page>0) {
				b1page--;
				g1_to_BODY1();
			}
			break;
		case "BODY2":
			BODY2_to_g1();
			if (b2page>0) {
				b2page--;
				g1_to_BODY2();
			}
			break;
		case "BODY3":
			BODY3_to_g1();
			if (b3page>0) {
				b3page--;
				g1_to_BODY3();
			}
			break;
		case "TAIL":
			if (b1page>0) {
				b1page--;
			}
			if (b2page>0) {
				b2page--;
			}
			if (b3page>0) {
				b3page--;
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

function BODY1_CHECK() { // 単純チェック
}

function BODY1_to_g1() {
	if (!g1.HSigenMrs) {g1.HSigenMrs = [];}
	for (var i=1;i<=6;i++) {
		var i1 = b1page * 6 + i - 1;
		g1.HSigenMrs[i1] = {};
		g1.HSigenMrs[i1].gno = i1 + 1;
		g1.HSigenMrs[i1].gito = $('#fieldGito_'+i).val().rtrim().toUpperCase();
		g1.HSigenMrs[i1].kota = $('#fieldKota_'+i).val().rtrim().toUpperCase();
		g1.HSigenMrs[i1].kik1 = Math.floor(1*$('#fieldKik1_'+i).val());
		g1.HSigenMrs[i1].ktni = $('#fieldKtni_'+i).val().rtrim().toUpperCase();
		g1.HSigenMrs[i1].kik2 = 1000*$('#fieldKk2t_'+i).val()+Math.floor(1*$('#fieldKk2_'+i).val());
		g1.HSigenMrs[i1].biko = $('#fieldBiko_'+i).val().rtrim().toUpperCase();
		g1.HSigenMrs[i1].HSigenKonMrs=[];
		for (j=1;j<=4;j++) {
			var j0 = j - 1;
			g1.HSigenMrs[i1].HSigenKonMrs[j0]={};
			g1.HSigenMrs[i1].HSigenKonMrs[j0].kon = $('#fieldKon_'+i+'_'+j).val().rtrim().toUpperCase();
			g1.HSigenMrs[i1].HSigenKonMrs[j0].rit = Math.floor(1*$('#fieldRit_'+i+'_'+j).val());
		}
	}
}

function BODY2_CHECK() { // 単純チェック
}

function BODY2_to_g1() {
	if (!g1.HSinenMrs) {g1.HSinenMrs = [];}
	for (var i=1;i<=12;i++) {
		var i1 = b2page * 12 + i - 1;
		g1.HSinenMrs[i1] = {};
		g1.HSinenMrs[i1].kno = i1+30+1;
		g1.HSinenMrs[i1].ijun = $('#fieldIjun_'+i).val().rtrim().toUpperCase();
		g1.HSinenMrs[i1].ito1 = Math.floor(1*$('#fieldIto1_'+i).val());
		g1.HSinenMrs[i1].hon1 = Math.floor(1*$('#fieldHon1_'+i).val());
		g1.HSinenMrs[i1].ito2 = Math.floor(1*$('#fieldIto2_'+i).val());
		g1.HSinenMrs[i1].hon2 = Math.floor(1*$('#fieldHon2_'+i).val());
		g1.HSinenMrs[i1].kote = Math.floor(1*$('#fieldKote_'+i).val());
		g1.HSinenMrs[i1].hoko = $('#fieldHoko_'+i).val().rtrim().toUpperCase();
		g1.HSinenMrs[i1].yori = Math.floor(1*$('#fieldYori_'+i).val());
		g1.HSinenMrs[i1].kbn1 = $('#fieldKbn1_'+i).val().rtrim().toUpperCase();
		g1.HSinenMrs[i1].kbn2 = $('#fieldKbn2_'+i).val().rtrim().toUpperCase();
		g1.HSinenMrs[i1].kako = $('#fieldKako_'+i).val().rtrim().toUpperCase();
//		g1.HSinenMrs[i1].kohi = Math.floor(1*$('#fieldKohi_'+i).text());
	}
}

function BODY3_CHECK() { // 単純チェック
}

function BODY3_to_g1() {
	if (!g1.HSiitoMrs) {g1.HSiitoMrs = [];}
	for (var i=1;i<=5;i++) {
		var i1 = b3page * 5 + i - 1;
		if (!g1.HSiitoMrs[i1]) {g1.HSiitoMrs[i1] = {}; }
		g1.HSiitoMrs[i1].denl = Math.floor(1*$('#fieldDenl_'+i).val());
		g1.HSiitoMrs[i1].ondo = Math.floor(1*$('#fieldOndo_'+i).val());
		g1.HSiitoMrs[i1].hun = Math.floor(1*$('#fieldHun_'+i).val());
		g1.HSiitoMrs[i1].nori = $('#fieldNori_'+i).val().rtrim();
//		g1.HSiitoMrs[i1].imei = $('#dispImei_'+i).text().rtrim();
	}
	if (!g1.chuj) {g1.chuj = [];}
	for (var i=1;i<=2;i++) {
		var i1 = b3page * 2 + i - 1;
		g1.chuj[i1] = $('#fieldChuj_'+i).val().rtrim();
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
		url:haiz210_ajaxGrpDo,
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
			alert('エラー haiz210_ajaxGrpDo '+status+'/'+err);
		},
	});
}

// 糸使いモーダルダイヤログ部分
function f5key() {
	modalstart(modal_ito, "糸構成登録");
}

// モーダルダイヤログ部分
function f8key() {
	if (lastfocusin == "fieldCd") { // 仕入伝票選択 //
		modalstart1(den_modal, "仕入伝票選択");
	}else if (lastfocusin == "fieldHacchuuDtCd") { // 発注伝票選択 //
		modalstart(hacchuu_dts_modal, "発注伝票選択");
	}else if (lastfocusin == "fieldShiirebi") { // 仕入日選択 //
		open_datepicker();
	}else if (lastfocusin == "fieldZeirituTekiyoubi") { // 税率適用日選択 
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

$('#iframe-wrap button').click(function () { // 中止して終わる (X)
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

function Chuij2g1() { // 親から受けたg1の注意事項の中の「糸使い」をワークに複写
	g1.chuj=[];
	g1.chui_cnt1=0;
	if (g1.HSichuiMrs) {
		var i=0; // 始めは0
		g1.HSichuiMrs.forEach(function(HSichuiMr) {
			if (HSichuiMr.tais == '糸使い') {
				g1.chuj[i++]=HSichuiMr.chui;
			} else {
				g1.chui_cnt1++;
			}
		});
		g1.chui_cnt1 -= i;
	}
}

function get_data_set() {
	$('#fieldSino').val(g1.cd.substr(0,6));
	$('#fieldSied').val(g1.cd.substr(6));
	Chuij2g1();
	//ijun
	g1.HSinenMrs.forEach(function(HSinenMr, i) {
		g1.HSinenMrs[i].ijun = ((HSinenMr.tjun + ' ').substr(0,1) + HSinenMr.yjun).rtrim();
	});
	//mjun
	g1.HSiitoMrs.forEach(function(HSiitoMr, i) {
		g1.HSiitoMrs[i].mjun = ((HSiitoMr.tjun + ' ').substr(0,1) + HSiitoMr.yjun).rtrim();
	});
	g1_to_GAMEN();
}

function g1_to_GAMEN() { // 画面データを表示する。ページを使う。
	$('input.BODY1').val('');
	$('span.BODY1,span.xBODY1').text('');
	if (!g1.HSigenMrs) {g1.HSigenMrs = [];}
	for (var i=1;i<=6;i++) {
		$('#dispGno_'+i).text(b1page*6+i);
		var i_1=b1page*6+i-1; // 最初は0
		if (g1.HSigenMrs.length > i_1) {
			$('#fieldGito_'+i).val(g1.HSigenMrs[i_1].gito);
			$('#fieldKota_'+i).val(g1.HSigenMrs[i_1].kota);
			var n=g1.HSigenMrs[i_1].kik1;	$('#fieldKik1_'+i).val(n>0?n:"");
			$('#fieldKtni_'+i).val(g1.HSigenMrs[i_1].ktni);
			var kk2t=Math.floor(g1.HSigenMrs[i_1].kik2/1000);
			$('#fieldKk2t_'+i).val(kk2t>0?kk2t:"");
			var kk2=1*g1.HSigenMrs[i_1].kik2-1000*kk2t;
			$('#fieldKk2_'+i).val(kk2>0?kk2:"");
			$('#fieldBiko_'+i).val(g1.HSigenMrs[i_1].biko);
			var j=1;
			g1.HSigenMrs[i_1].HSigenKonMrs.forEach(function(HSigenKonMr) {
				if (j<=4) {
					$('#fieldKon_'+i+'_'+j).val(HSigenKonMr.kon);
					$('#fieldRit_'+i+'_'+j).val(HSigenKonMr.rit>0?HSigenKonMr.rit:"");
				}
				j++;
			});
		}
	}
	// 画面BODY2へデータを表示する。ページはb2pageを使う。
	$('input.BODY2').val('');
	$('span.BODY2,span.xBODY2').text('');
	if (!g1.HSinenMrs) {g1.HSinenMrs = [];}
	for (var i=1;i<=12;i++) {
		$('#dispKno_'+i).text(b2page*12+i+30);
		var i_1=b2page*12+i-1; // 最初は0
		if (g1.HSinenMrs.length > i_1) {
			$('#fieldIjun_'+i).val(g1.HSinenMrs[i_1]['ijun']);
			var n='';
			n=g1.HSinenMrs[i_1].ito1;$('#fieldIto1_'+i).val(n>0?n:"");
			n=g1.HSinenMrs[i_1].hon1;	$('#fieldHon1_'+i).val(n>0?n:"");
			n=g1.HSinenMrs[i_1].ito2;	$('#fieldIto2_'+i).val(n>0?n:"");
			n=g1.HSinenMrs[i_1].hon2;	$('#fieldHon2_'+i).val(n>0?n:"");
			n=g1.HSinenMrs[i_1].kote;	$('#fieldKote_'+i).val(n>0?n:"");
			$('#fieldHoko_'+i).val(g1.HSinenMrs[i_1].hoko);
			n=g1.HSinenMrs[i_1].yori;	$('#fieldYori_'+i).val(n>0?n:"");
			$('#fieldKbn1_'+i).val(g1.HSinenMrs[i_1].kbn1);
			$('#fieldKbn2_'+i).val(g1.HSinenMrs[i_1].kbn2);
			$('#fieldKako_'+i).val(g1.HSinenMrs[i_1].kako);
			n=g1.HSinenMrs[i_1].kohi;	$('#dispKohi_'+i).text(n>0?n:"");
		}
	}
	// 画面BODY3へデータを表示する。ページはb3pageを使う。
	$('input.BODY3').val('');
	$('span.BODY3,span.xBODY3').text('');
	if (!g1.HSiitoMrs) {g1.HSiitoMrs = [];}
	for (var i=1;i<=5;i++) {
		var i_1=b3page*5+i-1; // 最初は0
		if (g1.HSiitoMrs.length > i_1) {
			$('#dispMjun_'+i).text(g1.HSiitoMrs[i_1].mjun);
			var n='';
			n=g1.HSiitoMrs[i_1].denl;	$('#fieldDenl_'+i).val(n>0?n:"");
			n=g1.HSiitoMrs[i_1].ondo;		$('#fieldOndo_'+i).val(n>0?n:"");
			n=g1.HSiitoMrs[i_1].hun;		$('#fieldHun_'+i).val(n>0?n:"");
			$('#fieldNori_'+i).val(g1.HSiitoMrs[i_1].nori);
			$('#dispImei_'+i).text(g1.HSiitoMrs[i_1].imei);
		} else {
			$('#dispMjun_'+i).text('');
		}
	}
	if (!g1.chuj) {g1.chuj = [];}
	for (var i=1;i<=2;i++) {
		var i_1=b3page*2+i-1; // 最初は0
		if (g1.chuj.length > i_1) {
			$('#fieldChuj_'+i).val(g1.chuj[i_1]);
		} else {
			$('#fieldChuj_'+i).val('');
		}
	}
	GRPinput2span('ALLF'); // <input>データを表示用<span>データに複写する。
}

function g1_to_parent() { // g1データを親に返すために整形する。
	// 注意事項を合成
	if (!g1.HSichuiMrs) {
		g1.HSichuiMrs = [];
	}
	for (var i = 0; i < g1.HSichuiMrs.length; i++) {
		if (g1.HSichuiMrs[i].tais == '糸使い') {
			g1.HSichuiMrs[i].tacd = '';
			g1.HSichuiMrs[i].tais = '';
			g1.HSichuiMrs[i].chui = '';
		}
	}
	var i1 = 0;
	for (var i = 0; i < g1.chuj.length; i++) {
		if (g1.chuj[i]) {
			for (; i1 < g1.HSichuiMrs.length; i1++) {
				if (g1.HSichuiMrs[i1].tais == '') {break;}
			}
			if (i1 >= g1.HSichuiMrs.length) {
				g1.HSichuiMrs[i1]={};
			}
			g1.HSichuiMrs[i1].tais='糸使い';
			g1.HSichuiMrs[i1].kbn='I';
			g1.HSichuiMrs[i1].chui=g1.chuj[i];
		}
	}
	//ijun
	g1.HSinenMrs.forEach(function(HSinenMr, i) {
		if (HSinenMr.ijun) {
			g1.HSinenMrs[i].tjun = HSinenMr.ijun.substr(0,1).trim();
			g1.HSinenMrs[i].yjun = HSinenMr.ijun.substr(1,1).trim();
		} else {
			g1.HSinenMrs[i].tjun = '';
			g1.HSinenMrs[i].yjun = '';
		}
	});
	//mjun
	g1.HSiitoMrs.forEach(function(HSiitoMr, i) {
		g1.HSiitoMrs[i].tjun = HSiitoMr.mjun.substr(-1).trim();
		g1.HSiitoMrs[i].yjun = HSiitoMr.mjun.substr(1,1).trim();
	});

}
