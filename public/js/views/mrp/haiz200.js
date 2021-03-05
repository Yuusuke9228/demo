window.onload = function(){
	showNowDate();
	setInterval("showNowDate()", 100000);
	midashi();
	grp_READ('HEAD');
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

var g1={}; // 連想配列：画面全体の項目：phpのcontrollerとajaxでヤリトリして共通の格納領域とする。
var grpNOW='';
var bpage=0;

function p2c_grpNOW() { // モーダルウインドウから実行する関数（現在入力グループ名を返す）
	return grpNOW;
}

function p2c_g1() { // モーダルウインドウから実行する関数（共通の格納領域を返す）
	return g1;
}

function c2p_g1(c_g1) { // モーダルウインドウから実行する関数（共通の格納領域を戻す）
	g1 = c_g1;
	g1_to_GAMEN();
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

function grp_READ(grp) { // 指定グループを入力モードにする。
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

$('#F0').focusin(function(e) { // グループ最終項目でエンターしたらF12同様の動作する
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
			case "HEAD":
				switch (g1.skbn) {
					case '0':
						grp_READ('TAIL');
						break;
					case '1':
						grp_READ('BODY');
						break;
					case '2':
						grp_READ('BODY');
						break;
					case '3':
						grp_READ('TAIL');
						break;
					case '4':
						grp_READ('TAIL');
						break;
					case '9':
						grp_READ('TAIL');
						break;
				}
				break;
			case "BODY":
				grp_READ('TAIL');
				break;
			case "TAIL":
				switch (g1.skbn) {
					case '3':
						modalprint(); // window.open(print_out + '/?cd=' + g1.cd, '_blank'); // 設計書印刷データ出力モーダルへ
						break;
				}
				grp_READ('HEAD');
				break;
		}
	}
}

function CANCEL() {
	g1_to_GAMEN(); // 入力中データを戻す。
	$('#dispEmsg').text("");
	switch (grpNOW) {
		case "HEAD":
			$('.ALLF').val('');
			$('.ALLF,.xALLF').text('');
			g1 = {};
			grp_READ('HEAD');
			break;
		case "BODY":
			grp_READ('HEAD');
			break;
		case "TAIL":
				switch (g1.skbn) {
					case '0':
						grp_READ('HEAD');
						break;
					case '1':
						grp_READ('BODY');
						break;
					case '2':
						grp_READ('BODY');
						break;
					case '3':
						grp_READ('HEAD');
						break;
					case '4':
						grp_READ('HEAD');
						break;
					case '9':
						grp_READ('HEAD');
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
		case "HEAD":
			window[grpNOW+'_to_g1']();
			g1.errflg = 2; // 次グループへは進まないで、通常エラーにしない。
			ajaxGrpDo('NEXT');
			grp_READ();
			break;
		case "BODY":
			window[grpNOW+'_to_g1']();
			if (bpage < 2) {
				bpage++;
				g1_to_GAMEN();
			}
			grp_READ();
			break;
		case "TAIL":
			if (bpage < 2) {
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
		case "HEAD":
			window[grpNOW+'_to_g1']();
			g1.errflg = 2; // 次グループへは進まないで、通常エラーにしない。
			ajaxGrpDo('BACK');
			grp_READ();
			break;
		case "BODY":
			window[grpNOW+'_to_g1']();
			if (bpage > 0) {
				bpage--;
				g1_to_GAMEN();
			}
			grp_READ();
			break;
		case "TAIL":
			if (bpage > 0) {
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

function HEAD_to_g1() {
	g1.cd=($('#fieldSino').val()+$('#fieldSied').val()).toUpperCase().replace(/\s+$/, ""); // rtrim同等
	g1.skbn = ''+(1*$('#fieldSkbn').val());
}

function HEAD_CHECK() {
	if (g1.cd == '      ') {
		audio.play();
		g1.errflg = 1;
		g1.emsg = "試織コードを入力してください！";
		g1.errfld = 'Sino';
	} else {
		switch (g1.skbn) {
			case '0':
			case '1':
			case '2':
			case '3':
			case '4':
			case '9':
				break;
			default:
				audio.play();
				g1.errflg = 1;
				g1.emsg = "処理区分は０～４と９です！";
				g1.errfld = 'Skbn';
				break;
		}
	}
}

function BODY_to_g1() {
	g1.moku = $('#fieldMoku').val().replace(/\s+$/g, '');
	g1.symd = $('#fieldSymd').val();
	g1.kymd = $('#fieldKymd').val();
	g1.type = $('#fieldType').val().replace(/\s+$/g, '');
	g1.irai = $('#fieldIrai').val().replace(/\s+$/g, '');
	g1.etnt = $('#fieldEtnt').val().toUpperCase();
	g1.ktnt = $('#fieldKtnt').val().replace(/\s+$/g, '').toUpperCase();
	g1.kibo = $('#fieldKibo').val().replace(/\s+$/g, '');
	g1.inou = $('#fieldInou').val().replace(/\s+$/g, '');
	g1.snou = $('#fieldSnou').val().replace(/\s+$/g, '');
	g1.tnou = $('#fieldTnou').val().replace(/\s+$/g, '');
	g1.ynou = $('#fieldYnou').val().replace(/\s+$/g, '');
	g1.anou = $('#fieldAnou').val().replace(/\s+$/g, '');
	g1.shab = $('#fieldShab').val();
	g1.snag = $('#fieldSnag').val();
	g1.osa  = $('#fieldOsa' ).val();
	g1.uti  = $('#fieldUti' ).val();
	g1.auti = $('#fieldAuti').val();
	g1.miha = $('#fieldMiha').val();
	g1.mihk = $('#fieldMihk').val();
	g1.miho = $('#fieldMiho').val();
	g1.jihk = $('#fieldJihk').val();
	g1.dohk = $('#fieldDohk').val();
	g1.khab = $('#fieldKhab').val();
	g1.knag = $('#fieldKnag').val();
	g1.tiji = $('#fieldTiji').val();
	g1.ahab = $('#fieldAhab').val();
	g1.anag = $('#fieldAnag').val();
	g1.jury = $('#fieldJury').val();
	g1.tkoh = $('#fieldTkoh').val();
	g1.ykoh = $('#fieldYkoh').val();
	g1.dkoh = $('#fieldDkoh').val();
	g1.skoh = $('#fieldSkoh').val();
	if (!g1.HSiitoMrs) {g1.HSiitoMrs = [];}
	for (var i = 1; i <= 5; i++) {
		var j = i - 1 + bpage * 5;
		if (j >= g1.HSiitoMrs.length) {
			g1.HSiitoMrs[j] = {};
		}
		g1.HSiitoMrs[j].iryo = $('#fieldIryo_'+i).val();
	}
	if (!g1.HSioriKakouMrs) {g1.HSioriKakouMrs = [];}
	for (var i = 1; i <= 8; i++) {
		var j = i - 1 + bpage * 8;
		if (j >= g1.HSioriKakouMrs.length) {
			g1.HSioriKakouMrs[j] = {};
		}
		g1.HSioriKakouMrs[j].kote = $('#fieldKako_'+i).val();
	}
	if (!g1.HSichuiMrs) {g1.HSichuiMrs = [];}
	for (var i = 1; i <= 8; i++) {
		var j = i - 1 + bpage * 8;
		if (j >= g1.HSichuiMrs.length) {
			g1.HSichuiMrs[j] = {};
		}
		g1.HSichuiMrs[j].tais = $('#fieldTais_'+i).val().replace(/\s+$/g, '');
		g1.HSichuiMrs[j].chui = $('#fieldChui_'+i).val().replace(/\s+$/g, '');
	}
}

// *****************************************************************
function BODY_CHECK() {
// *----------------------------------------------------------------
}

// *----------------------------------------------------------------
function TAIL_to_g1() {
	g1.kaku = $('#fieldKaku').val();
}

function TAIL_CHECK() {
}

function save_data_set() { // ajaxでsaveする前にデータ整経必要ならここに記述
}

function g1_to_GAMEN() { // 画面へデータを表示する。ページを使う。
	$('#fieldSino').val(g1.cd.substr(0,6));
	$('#fieldSied').val(g1.cd.substr(6));
	$('#dispPage').text(bpage + 1);

	$('#fieldMoku').val(g1.moku);
	$('#fieldSymd').val(g1.symd);
	$('#fieldKymd').val(g1.kymd);
	$('#fieldType').val(g1.type);
	$('#fieldIrai').val(g1.irai);
	$('#fieldEtnt').val(g1.etnt);
	$('#fieldKtnt').val(g1.ktnt);
	$('#fieldKibo').val(g1.kibo);
	$('#fieldInou').val(g1.inou);
	$('#fieldSnou').val(g1.snou);
	$('#fieldTnou').val(g1.tnou);
	$('#fieldYnou').val(g1.ynou);
	$('#fieldAnou').val(g1.anou);
	$('#fieldShab').val(g1.shab);
	$('#fieldSnag').val(g1.snag);
	$('#fieldOsa' ).val(g1.osa );
	$('#fieldUti' ).val(g1.uti );
	$('#fieldAuti').val(g1.auti);
	$('#fieldMiha').val(g1.miha);
	$('#fieldMihk').val(g1.mihk);
	$('#fieldMiho').val(g1.miho);
	$('#fieldJihk').val(g1.jihk);
	$('#fieldDohk').val(g1.dohk);
	$('#fieldKhab').val(g1.khab);
	$('#fieldKnag').val(g1.knag);
	$('#fieldTiji').val(g1.tiji);
	$('#fieldAhab').val(g1.ahab);
	$('#fieldAnag').val(g1.anag);
	$('#fieldJury').val(g1.jury);
	$('#fieldTkoh').val(g1.tkoh);
	$('#fieldYkoh').val(g1.ykoh);
	$('#fieldDkoh').val(g1.dkoh);
	$('#fieldSkoh').val(g1.skoh);

	$('#dispHtme').text(g1.htme);
	if (!g1.htkg) {g1.htkg = [];}
	$('#dispHtkg').text(g1.htkg[0]);
	$('#dispHyme').text(g1.hyme);
	if (!g1.hykg) {g1.hykg = [];}
	$('#dispHykg').text(g1.hykg[0]);
	if (!g1.HSosikiMr) {g1.HSosikiMr = [];}
	if (!g1.HSosikiMr[0]) {g1.HSosikiMr[0] = {};}
	$('#dispSome').text(g1.socd?g1.HSosikiMr[0].type:'');
	$('#dispSocd').text(g1.socd);
	$('#dispAyma').text(g1.ayma);
	$('#dispAyme').text(g1.ayme);
	$('#dispAykb').text(g1.aykb);
	$('#dispJiha').text(g1.jiha);
	$('#dispHiki').text(g1.hiki);
	$('#dispJiho').text(g1.jiho);
//	$('#dispNnfk').text(g1.nnfk);
//	$('#dispItry').text(g1.itry);
//	$('#dispKjur').text(g1.kjur);
//	$('#dispMetk').text(g1.metk);
//	$('#dispSaid').text(g1.said);

	if ( g1.nnfk > 0 && g1.shab > 0 && g1.ahab > 0 && g1.uti > 0 && g1.tiji > 0) {
		if ( g1.snag < 20) {
			$('#dispNnfk').text(Math.round(g1.nnfk * 150 / g1.ahab * 52 * g1.auti / g1.uti * 100 / g1.tiji * 1.05));
		} else {
			$('#dispNnfk').text(g1.nnfk * g1.snag);
		}
	} else {
		$('#dispNnfk').text(0);
	}
	if ( g1.jury > 0 && g1.ahab > 0 && g1.anag > 0) {
		if ( g1.snag < 20) {
			$('#dispKjur').text(Math.round(g1.jury * 150 / g1.ahab * 5200 / g1.anag / 1000 * 1.08));
			$('#dispMetk').text(Math.round(g1.jury * 10000 / g1.ahab / g1.anag + 0.5));
		} else {
			$('#dispKjur').text(Math.round(g1.jury * g1.snag / 1000));
			$('#dispMetk').text(Math.round($('#dispKjur').text() * 1000 / g1.anag * 100 / g1.ahab));
		}
	} else {
		$('#dispKjur').text(0);
		$('#dispMetk').text(0);
	}
	if ( g1.shab > 0 && g1.ahab > 0) {
		$('#dispSaid').text(Math.round(52.5 * g1.ahab / g1.shab));
		if ( $('#dispSaid').text() >= 148) {
			$('#dispSaid').text(148);
		} else {
			$('#dispSaid').text(Math.round($('#dispSaid').text() / 5));
			$('#dispSaid').text(Math.round($('#dispSaid').text() * 5));
		}
	} else {
		$('#dispSaid').text(0);
	}


	$('#dispEmsg').text(g1.emsg);

	if (!g1.HSiitoMrs) {g1.HSiitoMrs = [];}

	$('#dispItry').text(g1.itry);
	for (var i = 1; i <= 5; i++) {
		var j = i - 1 + bpage * 5;
		if (j < g1.HSiitoMrs.length) {
			$('#fieldIryo_'+i).val(g1.HSiitoMrs[j].iryo);
			$('#dispTjun_'+i).text(g1.HSiitoMrs[j].tjun=='X'?'':g1.HSiitoMrs[j].tjun);
			$('#dispYjun_'+i).text(g1.HSiitoMrs[j].yjun=='X'?'':g1.HSiitoMrs[j].yjun);
			$('#dispItcd_'+i).text(g1.HSiitoMrs[j].h_itomei_mr_cd);
			$('#dispImei_'+i).text(g1.HSiitoMrs[j].imei);
		} else {
			$('#fieldIryo_'+i).val('');
			$('#dispTjun_'+i).text('');
			$('#dispYjun_'+i).text('');
			$('#dispItcd_'+i).text('');
			$('#dispImei_'+i).text('');
		}
	}
	if (!g1.HSioriKakouMrs) {g1.HSioriKakouMrs = [];}
	for (var i = 1; i <= 8; i++) {
		var j = i - 1 + bpage * 8;
		if (j < g1.HSioriKakouMrs.length) {
			$('#fieldKako_'+i).val(g1.HSioriKakouMrs[j].kote);
		} else {
			$('#fieldKako_'+i).val('');
		}
	}
	if (!g1.HSichuiMrs) {g1.HSichuiMrs = [];}
	for (var i = 1; i <= 8; i++) {
		var j = i - 1 + bpage * 8;
		if (j < g1.HSichuiMrs.length) {
			$('#fieldTais_'+i).val(g1.HSichuiMrs[j].tais);
			$('#fieldChui_'+i).val(g1.HSichuiMrs[j].chui);
		} else {
			$('#fieldTais_'+i).val('');
			$('#fieldChui_'+i).val('');
		}
	}

	if (!g1.HSioriKonrituMrs) {g1.HSioriKonrituMrs = [];}
	for (var i = 1; i <= 5; i++) {
		var j = i - 1;
		if (!g1.HSioriKonrituMrs) {g1.HSioriKonrituMrs = [];}
		if (j < g1.HSioriKonrituMrs.length) {
			$('#dispKon_'+i).text(g1.HSioriKonrituMrs[j].kon);
			$('#dispRit_'+i).text(g1.HSioriKonrituMrs[j].rit);
		} else {
			$('#dispKon_'+i).text('');
			$('#dispRit_'+i).text('');
		}
	}

	midashi(); // 見出し設定

	GRPinput2span('ALLF'); // 全グループの<input>データを表示用<span>データに複写する。
}

var ajaxGetCount=0;

function ajaxGrpDo(TODO) { // 現在グループのチェック等
	bpage = 0;
	$.ajax({
		type:"POST",
		url:haiz200_ajaxGrpDo,
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
			alert('エラー haiz200_ajaxGrpDo '+status+'/'+err);
		},
	});
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

/* 印刷モーダルダイヤログ部分 */
function modalprint() { // 変数名と関数名が同じと変になる
	modalstart(modal_print, "試織設計書印刷", '3');
}

/* モーダルダイヤログ部分 */
function f8key() {
	if (lastfocusin == "fieldSino") { /* 試織番号選択 */
		modalstart1(sino_modal, "試織番号選択");
	}else if (lastfocusin == "fieldSymd") { /* 設計日選択 */
		open_datepicker();
	}else if (lastfocusin == "fieldKymd") { /* 改訂日選択 */
		open_datepicker();
	}
}

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
