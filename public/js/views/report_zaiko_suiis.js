window.onload = function() {
	var now = new Date();
	var year = now.getFullYear();
	var month = now.getMonth() + 1; //仕様上-1月された値が入る為 +1する
	if (month <= 11) {
		year = year -1;
	}
	$('#fieldKikanSiteiKbnCd').val(year.toString());
	$('#fieldKikanSiteiKbnCd').change();
};

$('#fieldKikanSiteiKbnCd').change(function() { //期間指定
	nendo = $('#fieldKikanSiteiKbnCd option:selected').val();
	$('#fieldKikanFrom').val(Number(nendo) + '-11' + '-01');	//日付べた書き(テスト中)
	$('#fieldKikanTo').val(Number(1* nendo +1) + '-10' + '-31');//日付べた書き(テスト中)
});
/* モーダルダイヤログ部分 */
function f8key() {
	if (lastfocusin == "fieldCd") { /* 条件名選択 */
		modalstart(jouken_uriage_modal); //条件設定画面を表示
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

function modalstart(url) {
    $('#iframe-wrap').fadeIn();
    $('#iframe-body').html('<iframe src="' + url + '" width="100%" height="100%" style="border: none;">');
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
    $('#iframe-wrap').fadeOut(
      function(){
      }
    );
    $('#iframe-bg').fadeOut();
    $('#'+lastfocusin).focus().select();
    if (retval){
      document.form_jouken.submit();
    }
}

$(function() { // モーダルウィンドウをドラッグで移動できる
    $("#iframe-wrap").draggable({
        handle: ".modal-header"
    });
});

$('#junjo_kbn_cd').change(function() { //順序区分コード
	if ($(this).val().substr(-2) == "01" || $(this).val().substr(-2) == "02") {
		return;
	}
	$.ajax({
		type:"POST",
		url:junjo_kbns_ajaxHanni,
		data:{'cd':$(this).val(),},
		async:true,
		dataType:'json',
		success: function (data) {
			$("[name='hanni_from']").val(data.from);
			$("[name='hanni_from_name']").val(data.from_name);
			$("[name='hanni_to']").val(data.to);
			$("[name='hanni_to_name']").val(data.to_name);
			$("[name='junjo_kbn_table']").val(data.junjo_kbn_table);
		},
		error: function(xhr, status, err) {
			alert('>エラー3:'+status+'/'+err);
		},
	});
});

/* 横見出をクリックするとその明細表示を呼ぶ */
$(".zoom_meisai").click(function() {
	$("#zoom_meisai_kikan_from").val($(this).text());
	$("#zoom_meisai_kikan_to").val($(this).text());
	$("#zoom_meisai_post").submit();
});

$('table tbody tr').click(function(){ // クリックした行を目立たせる。
	$('tr').removeClass('activetr');
	$(this).addClass('activetr');
});

/*
 *  現在の表示テーブルをExcel出力 Add BY Nishiyama 2019/11/4
 */
$('#dl-xlsx').on('click', function () {
	//Table全行列取得
	var data = [];
	var tr = $("table tr");
	for (var i = 0, l = tr.length; i < l; i++) {
		var cells = tr.eq(i).children();
		for (var j = 0, m = cells.length; j < m; j++) {
			if (typeof data[i] == "undefined")
				data[i] = [];
			if (!isNumber(cells.eq(j).text().replace(/,/g, ''))) {
				data[i][j] = cells.eq(j).text();
			} else {
				data[i][j] = cells.eq(j).text().replace(/,/g, '') * 1;
			}
		}
	}
	data.splice(2,1); //空行
	var write_opts = {
		type: 'binary'
	};
	var wb = aoa_to_workbook(data);
	var wb_out = XLSX.write(wb, write_opts);
	var blob = new Blob([s2ab(wb_out)], {type: 'application/octet-stream'});
	saveAs(blob, 'zaiko_suiis.xlsx');
	return false;
});

function isNumber(val){
	var regex = new RegExp(/^[-+]?[0-9]+(\.[0-9]+)?$/);
	return regex.test(val);
}

//Sheetをbookに追加
function sheet_to_workbook(sheet/*:Worksheet*/, opts)/*:Workbook*/ {
	var n = opts && opts.sheet ? opts.sheet : "Sheet1";
	var sheets = {};
	sheets[n] = sheet;
	return {SheetNames: [n], Sheets: sheets};
}
//配列をbookに変換
function aoa_to_workbook(data/*:Array<Array<any> >*/, opts)/*:Workbook*/ {
	return sheet_to_workbook(XLSX.utils.aoa_to_sheet(data, opts), opts);
}
//stringをArrayBufferに変換
function s2ab(s) {
	var buf = new ArrayBuffer(s.length);
	var view = new Uint8Array(buf);
	for (var i = 0; i != s.length; ++i) view[i] = s.charCodeAt(i) & 0xFF;
	return buf;
}