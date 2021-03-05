$('#END').click(function() { //エンドキー(END)を押したら
        index = $targetElm.index($('#fieldMeisai'+(imax - 1)+"Selchk"));
        $targetElm.eq(index).focus().select();
});

$('#PgUp').click(function() { //ページアップキー(Ctrl+Shift+Enter)を押したら
        var index = $targetElm.index($("#"+lastfocusin));//alert(index);
        var thisname = $("#"+lastfocusin).attr('name');
        var partsname = thisname.split(/[\[|\]]+/);// '['か']'かその連続にマッチする文字で分割する。例：data[meisai][0][selchk]は、['data','meisai','0','selchk','']となる。
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
        var partsname = thisname.split(/[\[|\]]+/);// '['か']'かその連続にマッチする文字で分割する。例：data[meisai][0][selchk]は、['data','meisai','0','selchk','']となる。
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
	var thisChk = this;
	//次の項目へ自動移動
	var index = $targetElm.index(thisChk);
	for (var i = index + 1;
		i <= $targetElm.length && (!$targetElm.eq(i).isVisible()
			|| $targetElm.eq(i).attr("readonly")=="readonly"
			|| typeof($targetElm.eq(i).attr("tabindex")) != "undefined"
		);
		i++) { }
	if (i <= $targetElm.length) {index = i;}
	$targetElm.eq(index).focus().select();//alert(index);
});

// 転記ボタンを押したらデータをセットして親に戻る
$('.returnto').click(function () {
	var retary=[];
	$('input:checked').each(function() {
		var ary1=[];
		ary1.name=$(this).parent().nextAll().eq(0).text();
		ary1.cd=$(this).parent().nextAll().eq(1).text();
		ary1.id=$(this).parent().prevAll().eq(0).text();
		ary1.type=$(this).parent().nextAll().eq(2).text();
		retary.push(ary1);
	});
	window.parent.fromModal(retary);
});

$(function(){ // テーブルのヘッドを消えなくする
  $('table.head_fix').floatThead({
  	top: '0'
  });
});
