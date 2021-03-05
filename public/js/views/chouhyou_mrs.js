var flds = [
	"gyou",
	"cd",
	"name",
	"shurui_kbn",
	"kmk_table",
	"sanshou",
	"kmk_cd",
	"yoko_zahyou",
	"tate_zahyou",
	"waku_haba",
	"waku_taka",
	"align",
	"valign",
	"stretch",
	"calign",
	"font_kbn_id",
	"font_style",
	"font_size",
	"inji_houkou",
	"moji_iro",
	"nuri_iro",
	"waku_iro",
	"waku_huto",
	"waku",
	"kmk_shuushoku",
	"suu_minus",
	"suu_comma",
	"suu_zero",
	"suu_shousuuten",
	"suu_percent",
	"suu_yen",
	"suu_seisuuketa",
	"suu_shousuuketa",
];

function setMeisai(){ // F12 submit したときに更新へ行く直前に帳票テキスト属性の明細をcontrollerへ渡せるようにする。
	if (!confirm("よろしいですか？")) {return false;}
	var trs=$('#KoumokuMeisai tbody tr');
	for (var trgyou=0; trgyou < trs.length; trgyou++){
		var tds=trs.eq(trgyou).find('td');
		for (var i=0; i < tds.length; i++){
			tds.eq(i).append($('<input name="data[zokusei_mrs]['+(trgyou+1)+']['+flds[i]+']" type="hidden" />').val(tds.eq(i).text()));
		}
	}
//	return false;
}

window.onload = function(){
	for (var trgyou=0; trgyou<imax; trgyou++) {
		newrect('fb'+(' 0000'+(trgyou+1)).slice(-4));
	}
}

$('#END').click(function() { //エンドキー(END)を押したら
        var index = $targetElm.index($("#"+lastfocusin));//alert(index);
        var thisname = $("#"+lastfocusin).attr('name');
        var partsname = thisname.split(/[\[|\]]+/);// '['か']'かその連続にマッチする文字で分割する。例：data[uriage_meisai_dts][0][selchk]は、['data','uriage_meisai_dts','0','selchk','']となる。
        var findend = '[selchk]';
        if (imax > 1 && partsname.length == 5) {
        	findend = '['+partsname[3]+']';
        }
        var findlen = -findend.length;
        index = $targetElm.index($(jqmeisaif+(imax-1)+"Cd"))-1;
        for (i = index + 1; i <= $targetElm.length && (!$targetElm.eq(i).isVisible() || typeof($targetElm.eq(i).attr("id")) == "undefined" || $targetElm.eq(i).attr("name").substr(findlen) != findend) ; i++) { }
        if (i <= $targetElm.length) {index = i;}
        $targetElm.eq(index).focus().select();
});

$('#PgUp').click(function() { //ページアップキー(Ctrl+Shift+Enter)を押したら
        var index = $targetElm.index($("#"+lastfocusin));//alert(index);
        var thisname = $("#"+lastfocusin).attr('name');
        var partsname = thisname.split(/[\[|\]]+/);// '['か']'かその連続にマッチする文字で分割する。例：data[uriage_meisai_dts][0][selchk]は、['data','uriage_meisai_dts','0','selchk','']となる。
        var findend = '[selchk]';
        if (imax > 1 && partsname.length == 5) {
        	findend = '['+partsname[3]+']';
        }
        var findlen = -findend.length;
        for (i = index - 1; i >= 0 && (!$targetElm.eq(i).isVisible() || typeof($targetElm.eq(i).attr("id")) == "undefined" || $targetElm.eq(i).attr("name").substr(findlen) != findend) ; i--) { }
        if (i >= 0) {index=i; }
        $targetElm.eq(index).focus().select();
});

$('#PgDn').click(function() { //ページダウンキー(Ctrl+Enter)を押したら
        var index = $targetElm.index($("#"+lastfocusin));//alert(index);
        var thisname = $("#"+lastfocusin).attr('name');
        var partsname = thisname.split(/[\[|\]]+/);// '['か']'かその連続にマッチする文字で分割する。例：data[uriage_meisai_dts][0][selchk]は、['data','uriage_meisai_dts','0','selchk','']となる。
        var findend = '[selchk]';
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

// スネークケースへ変換 sample_string
function snakeCase(str){
  var camel = camelCase(str);
  return camel.replace(/[A-Z]/g, function(s){
    return "_" + s.charAt(0).toLowerCase();
  });
}

/* モーダルダイヤログ部分 */
function f8key() {
	if (lastfocusin == "fieldTableMrCd") { /* 項目選択 */
		modalstart(koumoku_mrs_multisel,"項目選択", $('#fieldTableMrCd').val());
	}
	if (lastfocusin == "fieldSanshou") { /* 項目選択 */
		var sanshous = $('#fieldSanshou').val().split('/');
		var last1 = sanshous[sanshous.length-1];
		modalstart(koumoku_mrs_multisel,"項目選択",snakeCase(last1));
	}
}

function modalstart(url,title,table_mr_cd) {
	$('#iframe-title').text(title);
    $('#iframe-wrap').fadeIn();
    $('#iframe-body').html('<iframe src="' + url + '?table_mr_cd=' + table_mr_cd + '" width="100%" height="100%" style="border: none;">');
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
    var cdleft1 = 'D';
    if ($('#fieldTableMrCd').val() == 'kihon_mrs') {
    	cdleft1 = 'A'
    } else if ($('#fieldTableMrCd').val() == 'uriage_dts') {
    	cdleft1 = 'B'
    } else if ($('#fieldTableMrCd').val() == 'uriage_meisai_dts') {
    	cdleft1 = 'C'
    }
    $('#iframe-wrap').fadeOut(
      function(){//alert("フェードアウト完了")
		if (retval){
			for (var i in retval) {
				var newtr=$('<tr />');
				newtr.append($('<td />').html(imax+1));
				newtr.append($('<td />').html(cdleft1+('0000'+retval[i].id).slice(-4)));
				newtr.append($('<td />').html(retval[i].name));
				newtr.append($('<td />').html('0'));
				newtr.append($('<td />').html($('#fieldTableMrCd').val()));
				newtr.append($('<td />').html(''));//参照接続
				newtr.append($('<td />').html(retval[i].cd));//項目CD
				newtr.append($('<td />').html(Math.round(100*((imax%10)*15))/100));//横座標
				newtr.append($('<td />').html(Math.round(100*imax*5)/100));//縦座標
				newtr.append($('<td />').html('50'));//枠幅
				newtr.append($('<td />').html('5'));//枠高
				newtr.append($('<td />').html(''));//横位置
				newtr.append($('<td />').html(''));//縦位置
				newtr.append($('<td />').html(''));//文字間
				newtr.append($('<td />').html(''));//上下間隔
				newtr.append($('<td />').html('0'));//フォント
				newtr.append($('<td />').html(''));//〃スタイル
				newtr.append($('<td />').html('11'));//〃サイズ
				newtr.append($('<td />').html('0'));//方向(1=縦)
				newtr.append($('<td />').html(''));//文字色
				newtr.append($('<td />').html(''));//塗り色
				newtr.append($('<td />').html(''));//枠色
				newtr.append($('<td />').html(''));//枠太さ
				newtr.append($('<td />').html(''));//枠上下左右
				newtr.append($('<td />').html(''));//項目修飾
				newtr.append($('<td />').html(''));//負号
				newtr.append($('<td />').html(''));//カンマ
				newtr.append($('<td />').html(''));//０表示
				newtr.append($('<td />').html(''));//点表示
				newtr.append($('<td />').html(''));//パーセント
				newtr.append($('<td />').html(''));//円記号
				newtr.append($('<td />').html('10'));//整数部
				newtr.append($('<td />').html('0'));//小数部
				newtr.append($('<td />').html('<input name="data[zokusei_mrs]['+(imax+1)+'][selchk]" type="checkbox" id="fieldZokuseiMrs'+(imax+1)+'Selchk" class="form-control selchk" />'));//チェックボックス
				$('#KoumokuMeisai tbody').append(newtr);
				newrect('fb'+('0000'+(imax+1)).slice(-4));
				imax++;
			}
		}
      }
    );
    $('#iframe-bg').fadeOut();
    $('#'+lastfocusin).focus().select();
}

function newrect(idname){
	var newdiv=$('<div />').addClass('floatbox').attr('id',idname);
	newdiv.append($('<div />').addClass('handle').html('NEW'));
	newdiv.append($('<div />').addClass('rhandle').html('///'));
	$('#objHougan').before(newdiv);
	updrect(idname);
}

function updrect(idname){
	var trgyou=1*idname.slice(2);
	var tds=$('#KoumokuMeisai tbody tr').eq(trgyou-1).find('td');
	var upddiv=$('#'+idname);
	var updname=$('#'+idname+' .handle').eq(0);
	var rectHougan = $('#objHougan').offset();
	var xleft=Math.round(100*(10+(rectHougan.left)/96*25.4))/100;   // x座標(絶対座標)mm
	var ytop=Math.round(100*(11+(rectHougan.top)/96*25.4))/100;    // y座標(絶対座標)mm
	updname.text(tds.eq(2).text());
	upddiv.css('left',''+(1*tds.eq(7).text()+xleft)+'mm')
		.css('top',''+(1*tds.eq(8).text()+ytop)+'mm')
		.css('width',(tds.eq(1).text()==''?'1':tds.eq(9).text())+'mm')
		.css('height',tds.eq(10).text()+'mm');
}

function modal1start(trgyou) {
	$('#iframe-title').text('テキスト属性');
    $('#iframe-wrap').fadeIn();
    $('#iframe-body').html('<iframe src="' + text_zokusei_modal1 + '/' + trgyou + '" width="100%" height="100%" style="border: none;">');
    $('#iframe-bg').fadeTo('normal', 0.5);
    $('#iframe-body iframe').load(function () {
        $(this).contents().find('#header, #footer').hide();
    });
    return false;
}

function fromModal1(retval) {
    //alert('親ページの関数が実行されました。');
    $('#iframe-wrap').fadeOut(
      function(){//alert("フェードアウト完了")
		if (retval){
		  //$('#'+lastfocusin).val(retval);
		  //$('#'+lastfocusin).change();
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

jQuery(function ($) {
	var leftDiff, topDiff,
		doc = $(document),
		floatbox = null;
		handle = $(".floatbox .handle");
		rhandle = $(".floatbox .rhandle");

	// ドラッグ中
	function moving(event) {
		floatbox.css("left", (event.pageX - leftDiff) + "px")
			.css("top", (event.pageY - topDiff) + "px")
			.css("opacity", 0.7);
	}

	// ドラッグ終了時
	function dragEnd() {
		doc.off("mousemove mouseup");
		floatbox.css("opacity", 1);
		settrpos(floatbox);
		floatbox=null;
	}

	// マウスダウン時
	$(document).on('mousedown','.handle',function(event) {
//alert(event.target.parentElement.id);
		if (!floatbox) {
			floatbox=$('#'+event.target.parentElement.id);
			leftDiff = event.pageX - floatbox.offset().left;
			topDiff = event.pageY - floatbox.offset().top;
			doc.on("mousemove", moving)
				.on("mouseup", dragEnd);
		}
	});

	// ハンドル部分に対するイベント設定
//	handle.on("mousedown", mouseDown);

	// ドラッグ中
	function Rmoving(event) {
		floatbox.width(event.pageX - leftDiff - floatbox.offset().left)
			.height(event.pageY - topDiff - floatbox.offset().top)
			.css("opacity", 0.7);
	}

	// ドラッグ終了時
	function RdragEnd() {
		doc.off("mousemove mouseup");
		floatbox.css("opacity", 1);
		settrpos(floatbox);
		floatbox=null;
	}

	// マウスダウン時
	$(document).on('mousedown','.rhandle',function(event) {
		if (!floatbox) {
			floatbox=$('#'+event.target.parentElement.id);
			leftDiff = event.pageX - floatbox.offset().left - floatbox.width();
			topDiff = event.pageY - floatbox.offset().top - floatbox.height();
			doc.on("mousemove", Rmoving)
				.on("mouseup", RdragEnd);
		}
	});
	// ハンドル部分に対するイベント設定
//	rhandle.on("mousedown", RmouseDown);

});

function settrpos(floatbox){
	var rectHougan = $('#objHougan').offset();
	var xleft=Math.round(100*(10+rectHougan.left/96*25.4))/100;   // x座標(絶対座標)mm
	var ytop=Math.round(100*(11+rectHougan.top/96*25.4))/100;    // y座標(絶対座標)mm
	var trgyou=1*floatbox.attr('id').slice(2)-1;
	var tds=$('#KoumokuMeisai tbody tr').eq(trgyou).find("td");
	var fbx=Math.round(1.00*floatbox.css('left').slice(0,-2)/96*25.4 - 1.00*xleft)/1.00;
	var fby=Math.round(1.00*floatbox.css('top').slice(0,-2)/96*25.4 - 1.00*ytop)/1.00;
	var fbw=Math.round(1.00*floatbox.css('width').slice(0,-2)/96*25.4)/1.00;
	var fbh=Math.round(1.00*floatbox.css('height').slice(0,-2)/96*25.4)/1.00;
	tds.eq(7).html(fbx);
	tds.eq(8).html(fby);
	tds.eq(9).html(fbw);
	tds.eq(10).html(fbh);
}

// ダブルクリック時
$(document).on('dblclick','.handle',function(event) {
	trgyou=1*event.target.parentElement.id.slice(2);
	modal1start(trgyou);
});

// ダブルクリック時
$(document).on('dblclick','.selchk',function(event) {
	trgyou=$(this).parent().parent().index()+1;
	modal1start(trgyou);
});

$('#fieldTableMrCd').change(function() {
	var cdleft1 = 'D';
	if ($('#fieldTableMrCd').val() == 'kihon_mrs') {
		cdleft1 = 'A'
	} else if ($('#fieldTableMrCd').val() == 'uriage_dts') {
		cdleft1 = 'B'
	} else if ($('#fieldTableMrCd').val() == 'uriage_meisai_dts') {
		cdleft1 = 'C'
	}
	$('#fieldCdleft').val(cdleft1);
});

function fukusha() { // 複写
	var trs=$('#KoumokuMeisai tbody tr');
	var imax0 = imax;
	for (i=1; i <= imax0; i++) {
		if ($('#fieldZokuseiMrs'+i+'Selchk').prop('checked')) {
			var tds=trs.eq(i-1).find('td');
			var newtr=$('<tr />');
			newtr.append($('<td />').html(imax+1));
			newtr.append($('<td />').html($('#fieldCdleft').val()+('0000'+(imax+1)).slice(-4)));
			newtr.append($('<td />').html(tds.eq(2).text()));
			newtr.append($('<td />').html(tds.eq(3).text()));
			newtr.append($('<td />').html(tds.eq(4).text()));
			newtr.append($('<td />').html(tds.eq(5).text()));//参照接続
			newtr.append($('<td />').html(tds.eq(6).text()));//項目CD
			newtr.append($('<td />').html(1*tds.eq(7).text()+1*$('#fieldYokoKasan').val()));//横座標
			newtr.append($('<td />').html(1*tds.eq(8).text()+1*$('#fieldTateKasan').val()));//縦座標
			newtr.append($('<td />').html(tds.eq(9).text()));//枠幅
			newtr.append($('<td />').html(tds.eq(10).text()));//枠高
			newtr.append($('<td />').html(tds.eq(11).text()));//横位置
			newtr.append($('<td />').html(tds.eq(12).text()));//縦位置
			newtr.append($('<td />').html(tds.eq(13).text()));//文字間
			newtr.append($('<td />').html(tds.eq(14).text()));//上下間隔
			newtr.append($('<td />').html(tds.eq(15).text()));//フォント
			newtr.append($('<td />').html(tds.eq(16).text()));//〃スタイル
			newtr.append($('<td />').html(tds.eq(17).text()));//〃サイズ
			newtr.append($('<td />').html(tds.eq(18).text()));//方向(1=縦)
			newtr.append($('<td />').html(tds.eq(19).text()));//文字色
			newtr.append($('<td />').html(tds.eq(20).text()));//塗り色
			newtr.append($('<td />').html(tds.eq(21).text()));//枠色
			newtr.append($('<td />').html(tds.eq(22).text()));//枠太さ
			newtr.append($('<td />').html(tds.eq(23).text()));//枠上下左右
			newtr.append($('<td />').html(tds.eq(24).text()));//項目修飾
			newtr.append($('<td />').html(tds.eq(25).text()));//負号
			newtr.append($('<td />').html(tds.eq(26).text()));//カンマ
			newtr.append($('<td />').html(tds.eq(27).text()));//０表示
			newtr.append($('<td />').html(tds.eq(28).text()));//点表示
			newtr.append($('<td />').html(tds.eq(29).text()));//パーセント
			newtr.append($('<td />').html(tds.eq(30).text()));//円記号
			newtr.append($('<td />').html(tds.eq(31).text()));//整数部
			newtr.append($('<td />').html(tds.eq(32).text()));//小数部
			newtr.append($('<td />').html('<input name="data[zokusei_mrs]['+(imax+1)+'][selchk]" type="checkbox" checked="checked" id="fieldZokuseiMrs'+(imax+1)+'Selchk" class="form-control selchk" />'));//チェックボックス
			$('#KoumokuMeisai tbody').append(newtr);
			newrect('fb'+('0000'+(imax+1)).slice(-4));
			$('#fieldZokuseiMrs'+i+'Selchk').prop('checked',false);
			imax++;
		}
	}
}

function idou() { // 移動
	var trs=$('#KoumokuMeisai tbody tr');
	for (i=1; i <= imax; i++) {
		if ($('#fieldZokuseiMrs'+i+'Selchk').prop('checked')) {
			var tds=trs.eq(i-1).find('td');
			tds.eq(7).text(1*tds.eq(7).text()+1*$('#fieldYokoKasan').val());//横座標
			tds.eq(8).text(1*tds.eq(8).text()+1*$('#fieldTateKasan').val());//縦座標
			updrect('fb'+('0000'+i).slice(-4));
		}
	}
}

function tuika() { // 新規追加
	var newtr=$('<tr />');
	newtr.append($('<td />').html(imax+1));
	newtr.append($('<td />').html($('#fieldCdleft').val()+('0000'+(imax+1)).slice(-4)));
	newtr.append($('<td />').html($('#fieldCdleft').val()+('0000'+(imax+1)).slice(-4)));
	newtr.append($('<td />').html('0'));
	newtr.append($('<td />').html($('#fieldTableMrCd').val()));
	newtr.append($('<td />').html($('#fieldSanshou').val()));//参照接続
	newtr.append($('<td />').html(''));//項目CD
	newtr.append($('<td />').html($('#fieldYokoKasan').val()));//横座標
	newtr.append($('<td />').html($('#fieldTateKasan').val()));//縦座標
	newtr.append($('<td />').html('50'));//枠幅
	newtr.append($('<td />').html('5'));//枠高
	newtr.append($('<td />').html(''));//横位置
	newtr.append($('<td />').html(''));//縦位置
	newtr.append($('<td />').html(''));//文字間
	newtr.append($('<td />').html(''));//上下間隔
	newtr.append($('<td />').html('0'));//フォント
	newtr.append($('<td />').html(''));//〃スタイル
	newtr.append($('<td />').html('11'));//〃サイズ
	newtr.append($('<td />').html('0'));//方向(1=縦)
	newtr.append($('<td />').html(''));//文字色
	newtr.append($('<td />').html(''));//塗り色
	newtr.append($('<td />').html(''));//枠色
	newtr.append($('<td />').html(''));//枠太さ
	newtr.append($('<td />').html(''));//枠上下左右
	newtr.append($('<td />').html(''));//項目修飾
	newtr.append($('<td />').html(''));//負号
	newtr.append($('<td />').html(''));//カンマ
	newtr.append($('<td />').html(''));//０表示
	newtr.append($('<td />').html(''));//点表示
	newtr.append($('<td />').html(''));//パーセント
	newtr.append($('<td />').html(''));//円記号
	newtr.append($('<td />').html('10'));//整数部
	newtr.append($('<td />').html('0'));//小数部
	newtr.append($('<td />').html('<input name="data[zokusei_mrs]['+(imax+1)+'][selchk]" type="checkbox" id="fieldZokuseiMrs'+(imax+1)+'Selchk" class="form-control selchk" />'));//チェックボックス
	$('#KoumokuMeisai tbody').append(newtr);
	newrect('fb'+('0000'+(imax+1)).slice(-4));
	imax++;
}

