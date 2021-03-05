var jouken_flds = [
	"id",
	"cd",
	"name",
	"junjo_kbn_cd",
	"hanni_from",
	"hanni_to",
	"junjo2_kbn_cd",
	"hanni2_from",
	"hanni2_to",
	"koujun_flg",
	"meisaigyou_flg",
	"soukohyouji_flg",
	"goukeigyou_flg",
	"zaikoari_flg",
	"zaikonasi_flg",
	"kabusoku_check_flg",
	"kajou_ryou",
	"husoku_ryou",
];

$('#fieldCd').change(function() { //条件在庫一覧を索引
	$.ajax({
		type:"POST",
		url:jouken_zaiko_kakunins_ajaxGet,
		data:{'cd':$(this).val(),},
		async:true,
		dataType:'json',
		success: function (data) {
			if(data.length==0){
				alert('>>エラー:条件未登録');
			}else {
				for (var i in jouken_flds) {
					if (jouken_flds[i] != "cd" && jouken_flds[i] != "kikan_tuki") {
						$("[name="+jouken_flds[i]+"]").val(data[0][jouken_flds[i]]);
					}
				}
				if (data[0].kikan_tuki != "0000-00-00") {$("[name='kikan_tuki']").val(data[0].kikan_tuki);}
			}
		},
		error: function(xhr, status, err) {
			alert('>エラー1:'+status+'/'+err);
		},
	});
});

//window.onload = function(){
//	$('#fieldCd').change();
//}

/* 商品コードをクリックするとその明細表示を呼ぶ */
$(".zoom_index").click(function() {
	$("#indexShouhinMrCd").val($(this).text());
	$("#index_post").submit();
});

/* 発注予定量をクリックするとその新規発注画面を呼ぶ */
$(".zoom_hacchuu").click(function() {
	$("#post_hacchuu").empty();
	$("<input>", {type:'hidden', name:'data[hacchuu_meisai_dts][0][shouhin_mr_cd]', id:'hacchuuMeisaiDts0ShouhinMrCd', value:$(this).prevAll().eq(6).text()}).appendTo('#post_hacchuu');
	$("<input>", {type:'hidden', name:'data[hacchuu_meisai_dts][0][suuryou]', id:'hacchuuMeisaiDts0Suuryou', value:$(this).text().replace(/,/g,'')}).appendTo('#post_hacchuu');
	$("<input>", {type:'hidden', name:'data[hacchuu_meisai_dts][0][tanni_mr_cd]', id:'hacchuuMeisaiDts0TanniMrCd', value:$("td",$(this).parent().nextAll(0)).eq($(this).index()-2).text()}).appendTo('#post_hacchuu');
	$("#post_hacchuu").submit();
});

/* 発注予定量をクリックするとその新規発注画面を呼ぶ */
$(".zoom_hacchuu_all").click(function() {
//alert($("td",$(this).parent().prevAll().eq(1)).eq(0).text());
	$("#post_hacchuu").empty();
	var i=0;
	for (i=0; i<=50 && $("td",$(this).parent().prevAll().eq(i*2)).eq(0).text()!='from'; i++) {}
	for (j=0; j<i; j++) {
		$("<input>", {type:'hidden', name:'data[hacchuu_meisai_dts]['+j+'][shouhin_mr_cd]', id:'hacchuuMeisaiDts'+j+'ShouhinMrCd', value:$("td",$(this).parent().prevAll().eq(2*(i-j)-1)).eq($(this).index()-7).text()}).appendTo('#post_hacchuu');
		$("<input>", {type:'hidden', name:'data[hacchuu_meisai_dts]['+j+'][suuryou]', id:'hacchuuMeisaiDts'+j+'Suuryou', value:$("td",$(this).parent().prevAll().eq(2*(i-j)-1)).eq($(this).index()).text().replace(/,/g,'')}).appendTo('#post_hacchuu');
		$("<input>", {type:'hidden', name:'data[hacchuu_meisai_dts]['+j+'][tanni_mr_cd]', id:'hacchuuMeisaiDts'+j+'TanniMrCd', value:$("td",$(this).parent().prevAll().eq(2*(i-j)-2)).eq($(this).index()-2).text()}).appendTo('#post_hacchuu');
	}
	$("#post_hacchuu").submit();
});

/* モーダルダイヤログ部分 */
function f8key() {
	if (lastfocusin == "fieldCd") { /* 条件名選択 */
		modalstart(jouken_zaiko_kakunins_modal,"在庫一覧条件設定"); //条件設定画面を表示
	}else if (lastfocusin == "fieldKikanTuki") { /* 期間月選択 */
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

function modalstart(url,title) {
	$('#iframe-title').text(title);
    $('#iframe-wrap').fadeIn();
    $('#iframe-body').html('<iframe src="' + url + '?cd=' + $('#'+lastfocusin).val() + '" width="100%" height="100%" style="border: none;">');
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
    $('#iframe-wrap').fadeOut(
      function(){//alert("フェードアウト完了")
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

/* 画面内計算 */
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

$('.submit').click(function() { // 宛先変更してSUBMIT 参考：http://qiita.com/naoqoo2/items/f137272f84f9c10f04e6
  bak_action=$(this).parents('form').attr('action');
  $(this).parents('form').attr('action', $(this).data('action'));
  $(this).parents('form').submit();
  $(this).parents('form').attr('action', bak_action);
  $(this).parents('form').removeAttr('target'); 
});

$(function(){ // テーブルのヘッドを消えなくする
  $('table.head_fix').floatThead({
  	top: 50
  });
});

