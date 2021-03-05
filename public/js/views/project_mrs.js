$('#fieldKikanSiteiKbnCd').change(function() {
	$.ajax({
		type:"POST",
		url:kikan_sitei_kbns_ajaxGet,
		data:{'cd': $(this).val(),},
		async:true,
		dataType:'json',
		success: function (data) {
			console.log(data);
			if (data['kikan_from'] !== "0000-00-00") { $("[name='kikan_from']").val(data['kikan_from']) }
			if (data['kikan_to'] !== "0000-00-00") { $("[name='kikan_to']").val(data['kikan_to']) }
		},
		error: function(xhr, status, err) {
			alert('>エラー1'+ status + ' / ' + err);
		},
	});
});

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

$(function() {
    $("#iframe-wrap").draggable({
        handle: ".modal-header"
    });
});


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
 *  現在の表示テーブルをExcel出力
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
			data[i][j] = cells.eq(j).text();
		}
	}
	data.splice(2,1); //空行
	var write_opts = {
		type: 'binary'
	};
	var wb = aoa_to_workbook(data);
	var wb_out = XLSX.write(wb, write_opts);
	var blob = new Blob([s2ab(wb_out)], {type: 'application/octet-stream'});
	saveAs(blob, 'project_mrs.xlsx');
	return false;
});
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