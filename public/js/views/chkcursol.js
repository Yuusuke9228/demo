$('#END').click(function() { //エンドキー(END)を押したら最下行へ移動
    var index = $targetElm.index($("#"+lastfocusin));//alert(index);
    var thisname = $("#"+lastfocusin).attr('name');
    var partsname = thisname.split(/[\[|\]]+/);// '['か']'かその連続にマッチする文字で分割する。例：data[nyuukin_meisai_dts][0][shouhin_mr_cd]は、['data','nyuukin_meisai_dts','0','shouhin_mr_cd','']となる。
    if (partsname.length == 5) {
        var findtop = partsname[0]+'['+partsname[1]+']';
        var findlead = findtop.length;
        var findend = '['+partsname[3]+']';
        var findlen = -findend.length;
        for (i = index + 1;
            i < $targetElm.length-1;
            i++) {
            if (!(!$targetElm.eq(i).isVisible() ||
                  typeof($targetElm.eq(i).attr("id")) == "undefined" ||
                  $targetElm.eq(i).attr("id") == "undefined" ||
                  $targetElm.eq(i).attr("name").substr(findlen) != findend
                 )
               ) {
                index = i;
            }
        }
        $targetElm.eq(index).focus().select();
    } else {
        for (i=index;i<=$targetElm.length;i++) {
            thisname = $("#"+lastfocusin).attr('name');
            partsname = thisname.split(/[\[|\]]+/);// '['か']'かその連続にマッチする文字で分割する。例：data[nyuukin_meisai_dts][0][shouhin_mr_cd]は、['data','nyuukin_meisai_dts','0','shouhin_mr_cd','']となる。
            if (partsname.length == 5) {
                $targetElm.eq(i).focus().select();
                break;
            } else {
                break;
            }
        }
    }
});

$('#PgUp').click(function() { //ページアップキー(Ctrl+Shift+Enter)を押したら前行へ移動
    var index = $targetElm.index($("#"+lastfocusin));//alert(index);
    var thisname = $("#"+lastfocusin).attr('name');
    var partsname = thisname.split(/[\[|\]]+/);// '['か']'かその連続にマッチする文字で分割する。例：data[nyuukin_meisai_dts][0][shouhin_mr_cd]は、['data','nyuukin_meisai_dts','0','shouhin_mr_cd','']となる。
    if (partsname.length == 5) {
        var findend = '['+partsname[3]+']';
        var findlen = -findend.length;
        for (i = index - 1;
            i >= 0 &&
            (!$targetElm.eq(i).isVisible() ||
             typeof($targetElm.eq(i).attr("id")) == "undefined" ||
             $targetElm.eq(i).attr("name").substr(findlen) != findend
            ) ;
            i--) {
        }
        if (i >= 0) {index=i; }
        $targetElm.eq(index).focus().select();
    } else {
        for (i = index; i >= 0; i--) {
            thisname = $("#"+lastfocusin).attr('name');
            partsname = thisname.split(/[\[|\]]+/);// '['か']'かその連続にマッチする文字で分割する。例：data[nyuukin_meisai_dts][0][shouhin_mr_cd]は、['data','nyuukin_meisai_dts','0','shouhin_mr_cd','']となる。
            if (partsname.length == 5) {
                $targetElm.eq(i).focus().select();
                break;
            } else {
                break;
            }
        }
    }
});

$('#PgDn').click(function() { //ページダウンキー(Ctrl+Enter)を押したら次行へ移動
    var index = $targetElm.index($("#"+lastfocusin));//alert(lastfocusin);
    var thisname = $("#"+lastfocusin).attr('name');
    var partsname = thisname.split(/[\[|\]]+/);// '['か']'かその連続にマッチする文字で分割する。例：data[nyuukin_meisai_dts][0][shouhin_mr_cd]は、['data','nyuukin_meisai_dts','0','shouhin_mr_cd','']となる。
    if (partsname.length == 5) {
        var findend = '['+partsname[3]+']';
        var findlen = -findend.length;
        for (i = index + 1;
            i <= $targetElm.length &&
            (!$targetElm.eq(i).isVisible() ||
             typeof($targetElm.eq(i).attr("id")) == "undefined" ||
             $targetElm.eq(i).attr("name").substr(findlen) != findend
            ) ;
            i++) {
        }
        if (i <= $targetElm.length) {index = i;}
        $targetElm.eq(index).focus().select();
    } else {
        for (i=index;i<=$targetElm.length;i++) {
            thisname = $("#"+lastfocusin).attr('name');
            partsname = thisname.split(/[\[|\]]+/);// '['か']'かその連続にマッチする文字で分割する。例：data[nyuukin_meisai_dts][0][shouhin_mr_cd]は、['data','nyuukin_meisai_dts','0','shouhin_mr_cd','']となる。
            if (partsname.length == 5) {
                $targetElm.eq(i).focus().select();
                break;
            } else {
                break;
            }
        }
    }
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
