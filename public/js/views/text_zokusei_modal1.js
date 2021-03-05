//モーダル
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

window.onload = function(){
	getParentTr(trgyou);
}

function getParentTr(trgyou) {
	var tds=$('#KoumokuMeisai tbody tr',parent.document).eq(trgyou-1).find("td");
	for (i in flds) {
		$("[name='"+flds[i]+"']").val(tds.eq(i).text());
	}
}

function prevTr() {
	setParentTr();
	if (trgyou > 0) {
		trgyou--;
		getParentTr(trgyou);
	}
}

function nextTr() {
	setParentTr();
	if (trgyou < $('#KoumokuMeisai tbody tr',parent.document).length) {
		trgyou++;
		getParentTr(trgyou);
	}
}

function retParentTr() {
	setParentTr();
	window.parent.fromModal();
}

function setParentTr() {
	if (trgyou) {
		var tds=$('#KoumokuMeisai tbody tr',parent.document).eq(trgyou-1).find("td");
		for (i in flds) {
			tds.eq(i).text($("[name='"+flds[i]+"']").val());
		}
		window.parent.updrect('fb'+('0000'+trgyou).slice(-4));
	}
}
