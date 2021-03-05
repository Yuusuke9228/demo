window.onload = function(){
	if ($('#fieldCd').val()=='') {
		shuusei();
	} else {
		$('#fieldCd').change();
	}
}

function hyouji() {
	$('.inputedit').css('display','none');
	$('.showdisp').css('display','inline');
	$('#fieldCd').focus().select()
}
function shuusei() {
	$('.inputedit').css('display','inline');
	$('.showdisp').css('display','none');
	if (!$('#fieldHacchuubi').val()) {
		d0 = new Date();
		$('#fieldHacchuubi').val(d0.getFullYear() + "-" + ('00'+(d0.getMonth() + 1)).substr(-2) + "-"+ ('00'+d0.getDate()).substr(-2));
	}
	if (!$('#fieldTantouMrCd').val()) {
		$('#fieldTantouMrCd').val(user_me['tantou_cd']);
	}
	$('#fieldHacchuubi').focus().select();
}

$('#fieldCd').change(function() { //加工依頼データ索引
//	alert($(this).val()); //''の場合、'0'など1桁の場合または結果が複数の場合、結果が1個の場合、結果が0個の場合
	if ($(this).val() != '') {
		$.ajax({
			type:"POST",
			url:kakou_irai_dts_ajaxGet,
			data:{'cd':$(this).val(),},
			async:true,
			dataType:'json',
			success: function (data) {
				console.log(data);
				if(data.length == 0){
					$('#dispCd').text($('#fieldCd').val());
					$('#fieldCd').focus().select();
				}else if(data.length == 1 || $('#fieldCd').val() == data[0].cd){
					get_data_set(data[0]);
					$("#fieldCd").focus().select();
				} else {
					//選択肢をクリアしてから追加する
					$('#CdOptions > option').remove();
					for ( var i = 0; i < data.length; i++ ) {
						$('#CdOptions').append('<option value="' + data[i].cd + '">' + data[i].cd + ':' + data[i].name + '</option>');
					}
					$("#fieldShiresakiName").val('>>選択肢から選んでください');
					$("#fieldCd").focus().select();
				}

			},
			error: function(xhr, status, err) {
				alert('エラー Cd.change.ajax '+status+'/'+err);
			},
		});
	}
});

save_data = [];
function ajaxSave() { //加工依頼データへ書込み
	save_data_set();	
	$.ajax({
		type:"POST",
		url:kakou_irai_dts_ajaxSave,
		data:{'data':save_data,},
		async:true,
		dataType:'json',
		success: function (data) {
			if(data.length == 0){
				alert('エラー 更新失敗');
			}else {
				if (data[1]['chgcnt']==0) {
					alert('変更がありませんので「登録」を中止しました。');
				} else {
					get_data_set(data[0]);
					hyouji();
				}
			}
			window.alert('登録しました。');
		},
		error: function(xhr, status, err) {
			alert('エラー ajaxSave '+status+'/'+err);
		},
	});
}
						//	0は出力しない。1はforEachで出力、2は日付、3は手書きで出力
hacchuu_dts={
		id				:	'1Id',
		cd				:	'1Cd',
		hacchuubi		:	'2Hacchuubi',
		nounyuu_kijitu	:	'2NounyuuKijitu',
		tekiyou			:	'1Tekiyou',
		shiiresaki_mr_cd:	'1ShiiresakiMrCd',
		tantou_mr_cd	:	'1TantouMrCd',
	};
irai_dts={
		id				:	'0Id',
		name			:	'0Name',
		hacchuu_dt_id	:	'0HacchuuDtId',
		gotantou		:	'1Gotantou',
		keishou			:	'1Keishou',
		seisan_kanri_user_cd:'1SeisanKanriUserCd',
		seisan_kanri_user_name:'1SeisanKanriUserName',
		assistant_user_cd:	'1AssistantUserCd',
		assistant_user_name:'1AssistantUserName',
		loss_ritu		:	'1LossRitu',
		kibou_nouki		:	'2KibouNouki',
		kouki			:	'1Kouki',
		kakou_shu		:	'1KakouShu',
		kishu			:	'1Kishu',
		yori_houkou		:	'1YoriHoukou',
		yorisuu			:	'1Yorisuu',
		yori_tanni		:	'1YoriTanni',
		makiryou		:	'1Makiryou',
		makiryou_tanni	:	'1MakiryouTanni',
		seimaki_mae		:	'1SeimakiMae',
		seimaki_suu		:	'1SeimakiSuu',
		seimaki_tanni	:	'1SeimakiTanni',
		sikan_sitei		:	'1SikanSitei',
		set_umu			:	'1SetUmu',
		set_ondo		:	'1SetOndo',
		set_hun			:	'1SetHun',
		tail_kbn		:	'1TailKbn',
		komaki_kbn		:	'1KomakiKbn',
		tunagi_kbn		:	'1TunagiKbn',
		youto			:	'1Youto',
		case_kbn		:	'1CaseKbn',
		irihonsuu		:	'1Irihonsuu',
		zansi_kbn		:	'1ZansiKbn',
		shukka_kbn		:	'1ShukkaKbn',
		sonota1			:	'1Sonota1',
		sonota2			:	'1Sonota2',
		sonota3			:	'1Sonota3',
		bikou_ka		:	'1BikouKa',
		bikou_yor		:	'1BikouYor',
		bikou_ma		:	'1BikouMa',
		bikou_si		:	'1BikouSi',
		bikou_se		:	'1BikouSe',
		bikou_ta		:	'1BikouTa',
		bikou_ko		:	'1BikouKo',
		bikou_tu		:	'1BikouTu',
		bikou_you		:	'1BikouYou',
		bikou_ca		:	'1BikouCa',
		bikou_za		:	'1BikouZa',
		bikou_sh		:	'1BikouSh',
		bikou_so1		:	'1BikouSo1',
		bikou_so2		:	'1BikouSo2',
		bikou_so3		:	'1BikouSo3',
		tokki			:	'1Tokki',
		id_moto			:	'0IdMoto',
		hikae_dltflg	:	'0HikaeDltflg',
		hikae_user_id	:	'0HikaeUser_Id',
		hikae_nichiji	:	'0HikaeNichiji',
		sakusei_user_id	:	'0SakuseiUser_Id',
		created			:	'0Created',
		kousin_user_id	:	'0KousinUserId',
		updated			:	'0Updated',
	};

function get_data_set(data0){
	for (key in hacchuu_dts) {
		var val = hacchuu_dts[key];
		if(val.substr(0,1)=='1') {
			$('#field'+val.substr(1)).val(data0[key]);
			$('#disp'+val.substr(1)).text(data0[key]);
		} else if(val.substr(0,1)=='2') {
			var d0 = new Date(data0[key]);
			var d1 = isNaN(d0)?'':(d0.getMonth() + 1) + '月' + d0.getDate() + '日';
			$('#field'+val.substr(1)).val(data0[key]?data0[key].substr(0,10):'');
			$('#disp'+val.substr(1)).text(d1);
		}
	}
	$('#dispTantouName').text(data0['tantou_name']);
	
	for (key in irai_dts) {
		var val = irai_dts[key];
		if(val.substr(0,1)=='1') {
			$('#field'+val.substr(1)).val(data0[key]);
			$('#disp'+val.substr(1)).text(data0[key]);
		} else if(val.substr(0,1)=='2') {
			var d0 = new Date(data0[key]);
			var d1 = isNaN(d0)?'':(d0.getMonth() + 1) + '月' + d0.getDate() + '日';
			$('#field'+val.substr(1)).val(data0[key]?data0[key].substr(0,10):'');
			$('#disp'+val.substr(1)).text(d1);
		}
	}
	$('#dispSeisanKanriUserName').text(data0['seisan_kanri_user_name']);
	$('#dispAssistantUserName').text(data0['assistant_user_name']);
	$('#dispYori').text(data0['yori_houkou']+data0['yorisuu']+data0['yori_tanni']);
	$('#dispMakiryou').text(data0['makiryou']+data0['makiryou_tanni']);
	$('#dispSeimakiKijun').text(data0['seimaki_mae']+data0['seimaki_suu']+data0['seimaki_tanni']);
	if (data0['set_umu'] == 0) { // セット無しなら非表示
		$('#dispSetUmu').text('無');
		$('#dispSetOndo').text('');
		$('#dispSetHun').text('');
	} else {
		$('#dispSetUmu').text('有');
	}
	$('#dispTailKbn').text(data0['tail_kbn']?'有':'無');
	$('#dispKomakiKbn').text(data0['komaki_kbn']?'可':'不可');
	$('#dispTunagiKbn').text(data0['tunagi_kbn']?'可':'不可');
	//$('#dispTokki').html($.htmlspecialchars(data0['tokki']).replace(/\r?\n/g, '<br>'));
	$('#dispTokki').text(data0['tokki']);


	var i=0;
	for (key in data0['mei']) {
		var val = data0['mei'][key];
		var d0 = new Date(val['nouki']);
		var d1 = isNaN(d0)?'':(d0.getMonth() + 1) + '月' + d0.getDate() + '日';
		$('#fieldMei'+i+'Nouki').val(val['nouki']?val['nouki'].substr(0,10):'');
		$('#dispMei'+i+'Nouki').text(d1);
		$('#fieldMei'+i+'Tekiyou').val(val['tekiyou']);
		$('#dispMei'+i+'Tekiyou').text(val['tekiyou']);
		$('#fieldMei'+i+'Lot').val(val['lot']);
		$('#dispMei'+i+'Lot').text(val['lot']);
		$('#fieldMei'+i+'Keisu').val(100*val['keisu']);
		$('#dispMei'+i+'Keisu').text(100*val['keisu']);
		$('#fieldMei'+i+'Irisuu').val(val['irisuu']);
		$('#dispMei'+i+'Irisuu').text(val['irisuu']);
		$('#fieldMei'+i+'Suuryou').val(val['suuryou2']);
		$('#dispMei'+i+'Suuryou').text(val['suuryou2']);
		$('#fieldMei'+i+'Tanni').val(val['tanni_mr2_cd']);
		$('#dispMei'+i+'Tanni').text(val['tanni_mr2_cd']);
		$('#fieldMei'+i+'Tanka').val(val['tanka']);
		$('#dispMei'+i+'Tanka').text(val['tanka']);
		i++;
	}
	$('#dispMei0TanniName').text('/'+data0['mei'][0]['tanni_name']);
	for ( ; i < 4 ; i++) {
		$('#fieldMei'+i+'Nouki').val('');
		$('#dispMei'+i+'Nouki').text('');
		$('#fieldMei'+i+'Tekiyou').val('');
		$('#dispMei'+i+'Tekiyou').text('');
		$('#fieldMei'+i+'Lot').val('');
		$('#dispMei'+i+'Lot').text('');
		$('#fieldMei'+i+'Keisu').val('');
		$('#dispMei'+i+'Keisu').text('');
		$('#fieldMei'+i+'Irisuu').val('');
		$('#dispMei'+i+'Irisuu').text('');
		$('#fieldMei'+i+'Suuryou').val('');
		$('#dispMei'+i+'Suuryou').text('');
		$('#fieldMei'+i+'Tanni').val('');
		$('#dispMei'+i+'Tanni').text('');
		$('#fieldMei'+i+'Tanka').val('');
		$('#dispMei'+i+'Tanka').text('');
	}

	var i=0;
	for (key in data0['fax']) {
		var val = data0['fax'][key];
		var d0 = new Date(val['hiduke']);
		var d1 = isNaN(d0)?'':(d0.getMonth() + 1) + '月' + d0.getDate() + '日';
		$('#fieldFax'+i+'Hiduke').val(val['hiduke']?val['hiduke'].substr(0,10):'');
		$('#dispFax'+i+'Hiduke').text(d1);
		$('#fieldFax'+i+'UserCd').val(val['user_cd']);
		$('#fieldFax'+i+'UserName').val(val['user_name']);
		$('#dispFax'+i+'UserName').text(val['user_name']);
		$('#fieldFax'+i+'Name').val(val['name']);
		$('#dispFax'+i+'Name').text(val['name']);
		i++;
	}
	for ( ; i < 5 ; i++) {
		$('#fieldFax'+i+'Hiduke').val('');
		$('#dispFax'+i+'Hiduke').text('');
		$('#fieldFax'+i+'UserCd').val('');
		$('#fieldFax'+i+'UserName').val('');
		$('#dispFax'+i+'UserName').text('');
		$('#fieldFax'+i+'Name').val('');
		$('#dispFax'+i+'Name').text('');
	}

	var i=0;
	for (key in data0['cho']) {
		var val = data0['cho'][key];
		var d0 = new Date(val['hiduke']);
		var d1 = isNaN(d0)?'':(d0.getMonth() + 1) + '月' + d0.getDate() + '日';
		$('#fieldCho'+i+'Hiduke').val(val['hiduke']?val['hiduke'].substr(0,10):'');
		$('#dispCho'+i+'Hiduke').text(d1);
		$('#fieldCho'+i+'UserCd').val(val['user_cd']);
		$('#fieldCho'+i+'UserName').val(val['user_name']);
		$('#dispCho'+i+'UserName').text(val['user_name']);
		$('#fieldCho'+i+'Name').val(val['name']);
		$('#dispCho'+i+'Name').text(val['name']);
		$('#fieldCho'+i+'KakuninKbn').val(val['kakunin_kbn']);
		$('#dispCho'+i+'KakuninKbn').text(val['kakunin_kbn']==0?'－':'済');
		i++;
	}
	for ( ; i < 9 ; i++) {
		$('#fieldCho'+i+'Hiduke').val('');
		$('#dispCho'+i+'Hiduke').text('');
		$('#fieldCho'+i+'UserCd').val('');
		$('#fieldCho'+i+'UserName').val('');
		$('#dispCho'+i+'UserName').text('');
		$('#fieldCho'+i+'Name').val('');
		$('#dispCho'+i+'Name').text('');
		$('#fieldCho'+i+'KakuninKbn').val('');
		$('#dispCho'+i+'KakuninKbn').text('');
	}

	for (i=0; i<11; i++) {
		try {
			if (data0['nag'][i]) {
				var val = data0['nag'][i];
				$('#fieldNag'+i+'Name').val(val['name']);
				$('#dispNag'+i+'Name').text(val['name']);
				$('#fieldNag'+i+'Bikou').val(val['bikou']);
				$('#dispNag'+i+'Bikou').text(val['bikou']);
				$('#fieldNag'+i+'KakuninKbn').val(val['kakunin_kbn']);
				$('#dispNag'+i+'KakuninKbn').text(val['kakunin_kbn']==0?'－':'済');
			} else {
				$('#fieldNag'+i+'Name').val('');
				$('#dispNag'+i+'Name').text('');
				$('#fieldNag'+i+'Bikou').val('');
				$('#dispNag'+i+'Bikou').text('');
				$('#fieldNag'+i+'KakuninKbn').val('');
				$('#dispNag'+i+'KakuninKbn').text('');
			}
		} catch (e) {
			console.log(e.message);
		}

	}

	var i=0;
	for (key in data0['mok']) {
		var val = data0['mok'][key];
		var d0 = new Date(val['hiduke']);
		var d1 = isNaN(d0)?'':(d0.getMonth() + 1) + '月' + d0.getDate() + '日';
		$('#fieldMok'+i+'Hiduke').val(val['hiduke']?val['hiduke'].substr(0,10):'');
		$('#dispMok'+i+'Hiduke').text(d1);
		$('#fieldMok'+i+'UserCd').val(val['user_cd']);
		$('#fieldMok'+i+'UserName').val(val['user_name']);
		$('#dispMok'+i+'UserName').text(val['user_name']);
		$('#fieldMok'+i+'Name').val(val['name']);
		$('#dispMok'+i+'Name').text(val['name']);
		i++;
	}
	for ( ; i < 9 ; i++) {
		$('#fieldMok'+i+'Hiduke').val('');
		$('#dispMok'+i+'Hiduke').text('');
		$('#fieldMok'+i+'UserCd').val('');
		$('#fieldMok'+i+'UserName').val('');
		$('#dispMok'+i+'UserName').text('');
		$('#fieldMok'+i+'Name').val('');
		$('#dispMok'+i+'Name').text('');
	}
}

save_data = {};
function save_data_set(){
	for (key in hacchuu_dts) {
		var val = hacchuu_dts[key];
		if(val.substr(0,1)=='1' || val.substr(0,1)=='2') {
			save_data[key] = $('#field'+val.substr(1)).val();
		}
	}
	
	for (key in irai_dts) {
		var val = irai_dts[key];
		if(val.substr(0,1)=='1' || val.substr(0,1)=='2') {
			save_data[key] = $('#field'+val.substr(1)).val();
		}
	}
	
	save_data['mei'] = [];
	for (i=0; i<5; i++) {
		var j=i?i-1:i; // i=0,1,2,3,4 -> j=0,0,1,2,3
		save_data['mei'][i] = {};
		save_data['mei'][i]['tekiyou'] = $('#fieldMei'+j+'Tekiyou').val();
		save_data['mei'][i]['lot'] = $('#fieldMei'+j+'Lot').val();
		save_data['mei'][i]['keisu'] = $('#fieldMei'+j+'Keisu').val()*0.01;
		save_data['mei'][i]['nouki'] = $('#fieldMei'+j+'Nouki').val();
		save_data['mei'][i]['suuryou'] = $('#fieldMei'+j+'Suuryou').val();
		save_data['mei'][i]['tanni'] = $('#fieldMei'+j+'Tanni').val();
		save_data['mei'][i]['tanka'] = $('#fieldMei'+j+'Tanka').val();
		save_data['mei'][i]['irisuu'] = $('#fieldMei'+j+'Irisuu').val();
	}
	
	save_data['fax'] = [];
	for (i=0; i<5; i++) {
		save_data['fax'][i] = {};
		save_data['fax'][i]['hiduke'] = $('#fieldFax'+i+'Hiduke').val();
		save_data['fax'][i]['user_cd'] = $('#fieldFax'+i+'UserCd').val();
		save_data['fax'][i]['name'] = $('#fieldFax'+i+'Name').val();
	}
	
	save_data['cho'] = [];
	for (i=0; i<9; i++) {
		save_data['cho'][i] = {};
		save_data['cho'][i]['hiduke'] = $('#fieldCho'+i+'Hiduke').val();
		save_data['cho'][i]['user_cd'] = $('#fieldCho'+i+'UserCd').val();
		save_data['cho'][i]['name'] = $('#fieldCho'+i+'Name').val();
		save_data['cho'][i]['kakunin_kbn'] = $('#fieldCho'+i+'KakuninKbn').val();
	}
	
	save_data['nag'] = [];
	for (i=0; i<11; i++) {
		save_data['nag'][i] = {};
		save_data['nag'][i]['name'] = $('#fieldNag'+i+'Name').val();
		save_data['nag'][i]['bikou'] = $('#fieldNag'+i+'Bikou').val();
		save_data['nag'][i]['kakunin_kbn'] = $('#fieldNag'+i+'KakuninKbn').val();
	}
	
	save_data['mok'] = [];
	for (i=0; i<9; i++) {
		save_data['mok'][i] = {};
		save_data['mok'][i]['hiduke'] = $('#fieldMok'+i+'Hiduke').val();
		save_data['mok'][i]['user_cd'] = $('#fieldMok'+i+'UserCd').val();
		save_data['mok'][i]['name'] = $('#fieldMok'+i+'Name').val();
	}
}

$('#fieldTekiyou').change(function() { //仕入先マスター索引
	//alert("AAA:"+$(this).attr("id")); //''の場合、'0'など1桁の場合または結果が複数の場合、結果が1個の場合、結果が0個の場合
	if ($(this).val()=='') {
		// modalへ
	}else{
		$.ajax({
			type:"POST",
			url:shiiresaki_name_ajaxGet,
			data:{'name':$(this).val(),},
			async:true,
			dataType:'json',
			success: function (data) {
				if(data.length==0){
					// なにもしない
				}else if(data.length==1 || $("#fieldTekiyou").val() === data[0].name){
					$("#fieldTekiyou").val(data[0].name);
					$("#fieldShiiresakiMrCd").val(data[0].cd);
					$("#fieldGotantousha").val(data[0].gotantousha);
					$("#fieldKeishou").val(data[0].keishou);
				}else{
					//選択肢をクリアしてから追加する
					$('#TekiyouOptions > option').remove();
					for ( var i = 0; i < data.length; i++ ) {
						$('#TekiyouOptions').append('<option value="' + data[i].name + '">' + data[i].cd + ':' + data[i].name + '</option>');
					}
					$("#fieldTekiyou").focus().select();
				}
			},
			error: function(xhr, status, err) {
				alert('エラー Tekiyou.name.ajax '+status+'/'+err);
			},
		});
	}
});

$('.UserName').change(function() { //ユーザー索引クラス
	var thisName = $(this);
	if ($(this).val()=='') {
		// modalへ
	}else{
		$.ajax({
			type:"POST",
			url:user_name_ajaxGet,
			data:{'name':thisName.val(),},
			async:true,
			dataType:'json',
			success: function (data) {
				if(data.length==0){
					// なにもしない
				}else if(data.length==1 || thisName.val() === data[0].name){
					$('#UserNameOptions > option').remove();
					for ( var i = 0; i < data.length; i++ ) {
						$('#UserNameOptions').append('<option value="' + data[i].name + '">' + data[i].cd + ':' + data[i].name + '</option>');
					}
					thisName.val(data[0].name);
					var thisCd = thisName.attr('id').slice(0,-4)+'Cd';
					$("#"+thisCd).val(data[0].cd);
				}else{
					//選択肢をクリアしてから追加する
					$('#UserNameOptions > option').remove();
					for ( var i = 0; i < data.length; i++ ) {
						$('#UserNameOptions').append('<option value="' + data[i].name + '">' + data[i].cd + ':' + data[i].name + '</option>');
					}
					thisName.focus().select();
				}
			},
			error: function(xhr, status, err) {
				alert('エラー '+thisName.sttr('id')+'.ajax '+status+'/'+err);
			},
		});
	}
});
// (function($) {
//     $.extend({
// 		htmlspecialchars: function htmlspecialchars(ch){
// 				if (ch) {
// 					ch = ch.replace(/&/g,"&amp;") ;
// 					ch = ch.replace(/"/g,"&quot;") ;
// 					ch = ch.replace(/'/g,"&#039;") ;
// 					ch = ch.replace(/</g,"&lt;") ;
// 					ch = ch.replace(/>/g,"&gt;") ;
// 					return ch ;
// 				}
// 			}
// 	});
// })(jQuery);
