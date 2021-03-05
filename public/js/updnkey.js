// ↑キーと↓キーでテーブル構造の入力項目を上下に移動できるようにする。
// html内に<div id="PgDn"></div><div id="PgUp"></div>を埋めておくこと。
$(document).$('#PgUp').click(function() { //上矢キー(↑)を押したら
	var thistd=$("#"+lastfocusin).parent();
	var thistr=thistd.parent();
	var prevtr=thistr.prevAll('tr:first');
	var sumcol=0;
	var i=0;
	for(i=0;i<thistd.index();i++) {
		sumcol += 1*($("td",thistr).eq(i).attr('colspan')?$("td",thistr).eq(i).attr('colspan'):1);
	}
	sumcol += 1*($("td",thistr).eq(i).attr('colspan')?$("td",thistr).eq(i).attr('colspan'):1)/2+0.4;	
	for(i=0;i<100 && sumcol>1*($("td",prevtr).eq(i).attr('colspan')?$("td",prevtr).eq(i).attr('colspan'):1);i++) {
		sumcol -= 1*($("td",prevtr).eq(i).attr('colspan')?$("td",prevtr).eq(i).attr('colspan'):1);
	}
	$("td",prevtr).eq(i).children('input').focus().select();
});

$('#PgDn').click(function() { //下矢キー(↓)を押したら
	var thistd=$("#"+lastfocusin).parent();
	var thistr=thistd.parent();
	var nexttr=thistr.nextAll('tr:first');
	var sumcol=0;
	var i=0;
	for(i=0;i<thistd.index();i++) {
		sumcol += 1*($("td",thistr).eq(i).attr('colspan')?$("td",thistr).eq(i).attr('colspan'):1);
	}
	sumcol += 1*($("td",thistr).eq(i).attr('colspan')?$("td",thistr).eq(i).attr('colspan'):1)/2+0.4;	
	for(i=0;i<100 && sumcol>1*($("td",nexttr).eq(i).attr('colspan')?$("td",nexttr).eq(i).attr('colspan'):1);i++) {
		sumcol -= 1*($("td",nexttr).eq(i).attr('colspan')?$("td",nexttr).eq(i).attr('colspan'):1);
	}
	$("td",nexttr).eq(i).children('input').focus().select();
});
