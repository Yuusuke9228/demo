/* モーダルダイヤログ部分 */
function f8key() {
	if (lastfocusin == "fieldKikanFrom") { /* 期間自 */
		open_datepicker();
	}else if (lastfocusin == "fieldKikanTo") { /* 期間至 */
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
