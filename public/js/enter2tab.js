$.fn.isVisible = function() {
    return $.expr.filters.visible(this[0]);
};
undocount=0;
undocountmax=0;
undoarry={};
lastfocusval='';
lastfocusoutval='';
// 移動先の対象 http://se.ykysd.com/2015/11/10/jquery_enter_tab/
// var targetElm = "input[type=text]:enabled:not([readonly]),input[type=number]:enabled,input[type=password]:enabled,input[type=submit]:enabled,select:enabled,input[type=button]:enabled,input[type=checkbox]:enabled,input[type=date]:enabled:not([readonly]),input[type=tel]:enabled:not([readonly]),textarea:enabled,a:enabled,button:enabled";
var targetElm = "input[type=text]:enabled,input[type=number]:enabled,input[type=password]:enabled,input[type=submit]:enabled,select:enabled,input[type=button]:enabled,input[type=checkbox]:enabled,input[type=date]:enabled,input[type=tel]:enabled,textarea:enabled,a:enabled,button:enabled";
$targetElm = $( targetElm );
if ($targetElm.length <= 1){
  var targetElm = "a";
  $targetElm = $( targetElm );
}
for (i = 0; i <= $targetElm.length && (!$targetElm.eq(i).isVisible() || $targetElm.eq(i).attr("readonly")=="readonly"  || typeof($targetElm.eq(i).attr("tabindex")) != "undefined"); i++) {}
if (i < $targetElm.length) {lastfocusin = $targetElm.eq(i).attr('id'); lastfocusval=$targetElm.eq(i).val(); $targetElm.eq(i).focus().select();}//最初の入力項目文字全選択
var lastfocusin;
var lastfocusout;
var lastkeypress;
$(function () {
  $targetElm.keydown(function (e) { // 当初keypress
  	lastkeypress=e;
    var c = e.which ? e.which : e.keyCode;
    if (c === 13 && !e.altKey && !e.ctrlKey && ($(this).attr("type") != "submit" || e.shiftKey) && $(this).prop("tagName") != "A") {
      var tabindex = $( this ).attr( "tabindex" );
      if( typeof( tabindex ) != "undefined" && tabindex > -2 && $( "[tabindex='" + ( tabindex - 0 + 1 ) + "']" ).size() > 0 ){
        $( "[tabindex='" + ( tabindex - 0 + 1 ) + "']" ).focus().select();
      }else{
        var index = $targetElm.index(this);//alert(index);
        if (e.shiftKey) {
          for (i = index - 1; i >= 0 && (!$targetElm.eq(i).isVisible() || $targetElm.eq(i).attr("readonly")=="readonly" || typeof($targetElm.eq(i).attr("tabindex")) != "undefined") ; i--) { }
          if (i >= 0) {index=i; }
        } else {
          for (i = index + 1; i <= $targetElm.length && (!$targetElm.eq(i).isVisible() || $targetElm.eq(i).attr("readonly")=="readonly"  || typeof($targetElm.eq(i).attr("tabindex")) != "undefined") ; i++) { }
          if (i <= $targetElm.length) {index = i;}
        }
        $targetElm.eq(index).focus().select();//alert(index);
      }
      e.preventDefault();
    }
    else if(e.keyCode === 112){$("#F1")[0].click();return false;}//F1
    else if(e.keyCode === 113){$("#F2")[0].click();return false;}//F2
    else if(e.keyCode === 114){$("#F3")[0].click();return false;}//F3
    else if(e.keyCode === 115){$("#F4")[0].click();return false;}//F4
    else if(e.keyCode === 116){$("#F5")[0].click();return false;}//F5
    else if(e.keyCode === 117){$("#F6")[0].click();return false;}//F6
    else if(e.keyCode === 118){$("#F7")[0].click();return false;}//F7
    else if(e.keyCode === 119){f8key();return false;}	//$("#"+document.activeElement.id+"F8")[0].click();return false;}//F8
    else if(e.keyCode === 120){$("#F9")[0].click();return false;}//F9
    else if(e.keyCode === 121){$("#F10")[0].click();return false;}//F10
    else if(e.keyCode === 122){$("#F11")[0].click();return false;}//F11
    else if(e.keyCode === 123){//F12
      if ($(this).attr("type") == "a") {
        $(this).click();return false;
      } else {
        $("#F12")[0].click();return false;
      }
    }
    else if(e.keyCode === 13 && e.ctrlKey && e.shiftKey){$("#PgUp")[0].click();return false;}//Ctrl+Shift+Enter
    else if(e.keyCode === 13 && e.ctrlKey){$("#PgDn")[0].click();return false;}//Ctrl+Enter
    else if(e.keyCode === 27){$("#ESC")[0].click();return false;}//ESC
    else if(e.keyCode === 38){$("#PgUp")[0].click();return false;}//PgUp
    else if(e.keyCode === 40){$("#PgDn")[0].click();return false;}//PgDn
    else if(e.keyCode === 35){$("#END")[0].click();return false;}//END
    else if(e.keyCode === 36){$("#HOME")[0].click();return false;}//HOME
    else if((e.keyCode === 90 || e.keyCode === 122) && e.ctrlKey && e.shiftKey && undocount>0){ // shift+ctrl+z 戻す
    	undocount--;
    	lastfocusval = undoarry[undocount].val;
    	lastfocusin = undoarry[undocount].id;
    	undoarry[undocount].val=$('#'+lastfocusin).val();
    	$('#'+lastfocusin).val(lastfocusval);
    	$('#'+lastfocusin).focus().select();
    	return false;
    }
    else if((c === 89 || c === 121) && e.ctrlKey && e.shiftKey && undocount<undocountmax){ // shift+ctrl+y 進める
    	lastfocusval = undoarry[undocount].val;
    	lastfocusin = undoarry[undocount].id;
    	undoarry[undocount].val=$('#'+lastfocusin).val();
    	$('#'+lastfocusin).val(lastfocusval);
    	$('#'+lastfocusin).focus().select();
    	undocount++;
    	return false;
    }
    else if(e.keyCode === 13 && e.altKey && $(this).prop('type')=='textarea'){//alert($(this).prop('type'));
		// テキストボックスでALT+ENTERなら改行を挿入
		var field=$(this)[0];
		var pos = field.selectionStart; // テキスト選択の開始インデックス（キャレット位置）
		// 開始インデックスの所に "\n" を追加
		field.value = field.value.substr(0, pos) + "\n" + field.value.substr(pos, field.value.length);
		// 新しいキャレット位置
		field.focus();
		var newCaret = pos + "\n".length;
		field.setSelectionRange(newCaret, newCaret);
		return false;
    }
  });	//	<div id="PgUp"></div>などページに埋め込みが必要
  $targetElm.focusin(function (e) {
  	if($(this).attr('id')){
		if ($('#'+lastfocusin).val() !== lastfocusval) {
			undocountmax=undocount;
			undoarry[undocount++]={id:lastfocusin,val:lastfocusval}
		}
		lastfocusout = lastfocusin;
		lastfocusoutval = lastfocusval;
    	lastfocusin = $(this).attr('id');//alert(lastfocusin);
    	lastfocusval = $(this).val();
    }
  });
});
/*日付カレンダー選択を自動では出さない。F8で出すようにhacchuu_dts.js参照
$('input[type="tel"]').datepicker({
	dateFormat:'yy-m-d',
	autoclose :true,
	onSelect:function(dateText, inst) {
		$(this).datepicker('hide');
		$('#'+lastfocusin).val(dateText).select();  //date
	}
});
*/
$('input[type="tel"]').blur( function () {
    if ($(this).val().length < 1) {return;}
    now = new Date();
    $(this).val($(this).val().replace('/','-').replace('/','-'));
    if ($(this).val().length <= 2) {$(this).val(now.getFullYear()+'-'+('0'+(now.getMonth()+1)).slice(-2)+'-'+('0'+$(this).val()).slice(-2));}
    else if ($(this).val().length <= 5) {
    	if ($(this).val().indexOf('-') == -1) {
    		$(this).val($(this).val().slice(-4,-2)+'-'+$(this).val().slice(-2));
    	}
    	$(this).val(now.getFullYear()+'-'+$(this).val());
    }
    else {
    	if ($(this).val().indexOf('-') == -1) {
    		$(this).val($(this).val().slice(-8,-4)+'-'+$(this).val().slice(-4,-2)+'-'+$(this).val().slice(-2));
    	}
    	if ($(this).val().length == 8) {
    		$(this).val('20'+$(this).val());
    	}
    }
    var ymd = $(this).val().split('-');
    $(this).val(ymd[0]+'-'+('0'+ymd[1]).slice(-2)+'-'+('0'+ymd[2]).slice(-2));
});
String.prototype.ltrim = function() {
    return this.replace(/^\s+/, "");
}
String.prototype.rtrim = function() {
    return this.replace(/\s+$/, "");
}


$('select').change(function() { // 入力できないはずのセレクタを変更したら元に戻す。2019/3/21井浦
	if ($(this).attr('readonly')=="readonly") {
console.log($(this).attr('id') +' = ' + $(this).val() + ' <= ' + lastfocusin + ' ' + lastfocusout + ' ' + undocount);
		if ($(this).attr('id') == lastfocusin) $(this).val(lastfocusval);
		if ($(this).attr('id') == lastfocusout) $(this).val(lastfocusoutval);
	}
});

$(function(){
    history.pushState(null, null, null);
    $(window).on("popstate", function (event) {
        history.pushState(null, null, null);
        window.alert('アンドゥボタンは使えないよ!！');
    });
});

$('input').click(function () {
    $(this).select();
});