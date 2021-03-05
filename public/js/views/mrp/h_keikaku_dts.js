idmeisaif = 'fieldHKeikakuMeisaiDts';
jqmeisaif = '#' + idmeisaif;

var meisai_ary={cd:'Cd',id:'Id',updated:'Updated',kaisou:'Kaisou',suu1_shousuu:'Suu1Shousuu',suu2_shousuu:'Suu2Shousuu'
	,tanni_mr1_cd:'TanniMr1Cd',tanni_mr2_cd:'TanniMr2Cd',tanni_mr1_name:'TanniMr1Name',tanni_mr2_name:'TanniMr2Name'
	,kousei:'Kousei',shouhin_mr_cd:'ShouhinMrCd',shouhin_kakou_cd:'ShouhinKakouCd',kouritu:'Kouritu',kouritu_tanni:'KourituTanni',tekiyou:'Tekiyou'
	,lot:'Lot',h_kishu_mr_cd:'HKishuMrCd',h_kishu_mr_name:'HKishuMrName',h_kishu_mr_irowake:'HKishuMrIrowake',oya_meisai_cd:'OyaMeisaiCd',suuryou:'Suuryou',keisu:'Keisu',irisuu:'Irisuu'
	,hituyou_suu:'HituyouSuu',juchuu_suu:'JuchuuSuu',zaikoseisan_suu:'ZaikoseisanSuu',zaikoseisan_suu:'ZaikoseisanSuu',loss_suu:'LossSuu'
	,deme_suu:'DemeSuu',zaikosiyou_suu:'ZaikosiyouSuu',keikaku_suu:'KeikakuSuu',zaiko_kbn:'ZaikoKbn',kagi:'Kagi',daisuu:'Daisuu',suisuu:'Suisuu'
	,kaisi_hiduke:'KaisiHiduke',shuuryou_hiduke:'ShuuryouHiduke',bikou:'Bikou',kadou_nissuu:'KadouNisuu'};

function addHKeikakuMeisaiDt() { // alert(imax);
	tr_id = '#tr_h_keikaku_meisai_dt_'+imax;
	id_head = 'fieldHKeikakuMeisaiDts'+imax;
	name_head = 'data[h_keikaku_meisai_dts]['+imax+']';
	$("#tr_h_keikaku_meisai_dt_hidden").clone(true).attr('id','tr_h_keikaku_meisai_dt_'+imax).removeAttr('style').insertAfter('#tr_h_keikaku_meisai_dt_'+((imax>0)?imax-1:'hidden'));
	for (var key in meisai_ary) {
		$(tr_id+" #hidden"+meisai_ary[key]).attr('id',id_head+meisai_ary[key]).attr('name',name_head+'['+key+']');
	}
	$("#"+id_head+'Cd').val(imax+1); 
	$("#"+id_head+'Id').val(0); 
	imax++; //alert($("#"+id_head+'Id').val());
	$targetElm = $( targetElm );
}

window.onload = function(){
//	$(window).resize();
	tbl_new_width=0;
	$('#meisaiTable thead tr th').each(function(i){tbl_new_width += 1+$(this).width();});
	$('#meisaiTable').css({ width: tbl_new_width + 'px' });
	addHKeikakuMeisaiDt();
	addForm1(); // モーダル呼出post用フォームを追加
	$("[id$='Hiduke']").scrollLeft(100); // 全ての日付を右詰めにして見えやすくする。
	jsgant(); // ガントチャート表示
}

function addForm1(){ // モーダル呼出post用フォームを追加
	var form1 = $('<form></form>',{
		id:'form1',
		action:''+den_modal,
		target:'iframe1',
		method:'POST',
		name:'iframe1form'
	}).hide();
	$('body').append(form1);
	form1.append($('<input>',{type:'hidden',name:'sakusei_user_id',value:my_id}));
	form1.append($('<input>',{type:'hidden',name:'denpyou_mr_cd',value:'h_keikaku'}));
}

/*
$('#PgDn').click(function() { //ページダウンキー(Ctrl+Enter)を押したら
    var index = $targetElm.index($("#"+lastfocusin));//alert(index);
    var thisname = $("#"+lastfocusin).attr('name');
    var partsname = thisname.split(/[\[|\]]+/);// '['か']'かその連続にマッチする文字で分割する。例：data[h_keikaku_meisai_dts][0][shouhin_mr_cd]は、['data','h_keikaku_meisai_dts','0','shouhin_mr_cd','']となる。
    var findend = '[shouhin_mr_cd]';
    if (imax > 1 && partsname.length == 5) {
    	findend = '['+partsname[3]+']';
	    if (1 * partsname[2] + 1 == imax) {
	        for (var key in meisai_ary) {
	            if (key!='id' && (!$("#" + lastfocusin).val() || 'fieldHKeikakuMeisaiDts' + partsname[2] + meisai_ary[key] != lastfocusin)) {
	                $('#fieldHKeikakuMeisaiDts' + partsname[2] + meisai_ary[key]).val($('#fieldHKeikakuMeisaiDts' + (1 * partsname[2] - 1) + meisai_ary[key]).val());
	            }
	        }
	        addHKeikakuMeisaiDt();//新規行を追加
	    }
    }
    var findlen = -findend.length;
    for (i = index + 1; i <= $targetElm.length && (!$targetElm.eq(i).isVisible() || typeof($targetElm.eq(i).attr("id")) == "undefined" || $targetElm.eq(i).attr("name").substr(findlen) != findend) ; i++) { }
    if (i <= $targetElm.length) {index = i;}
    $targetElm.eq(index).focus().select();
});
*/

$('#fieldCd').change(function() { //計画伝票索引
//	alert($(this).val()); //''の場合、'0'など1桁の場合または結果が複数の場合、結果が1個の場合、結果が0個の場合
	if ($(this).val() != '') {
		$.ajax({
			type:"POST",
			url:h_keikaku_dts_ajaxGet,
			data:{'cd':$(this).val(),},
			async:true,
			dataType:'json',
			success: function (data) {
				if(data.length >= 1 && $('#fieldCd').val() === data[0].cd){
					location.href = h_keikaku_dts_edit + data[0].id;
				} else {
					$('#fieldCd').focus().select();
				}
			},
			error: function(xhr, status, err) {
				alert('エラー Cd.change.ajax '+status+'/'+err);
			},
		});
	}
});

$("[id$='ShouhinMrCd']").dblclick(function() { //商品マスター索引
	$(this).change();
});

$("[id$='Tekiyou']").change(function() {
	var idleft=$(this).attr("id").slice(0,-7);
	var gyou=idleft.slice(23); //fieldHKeikakuMeisaiDts0 左から23桁消す
	if (1*gyou+1 >= imax) {addHKeikakuMeisaiDt();}//新規行を追加しておく
});

$("[id$='ShouhinMrCd']").change(function() { //商品マスター索引
	//alert("AAA:".$(this).attr("id")); //''の場合、'0'など1桁の場合または結果が複数の場合、結果が1個の場合、結果が0個の場合
	var idleft=$(this).attr("id").slice(0,-11); //fieldHKeikakuMeisaiDts0ShouhinMrCd 右から11桁消す
	var gyou=idleft.slice(22); //fieldHKeikakuMeisaiDts0 左から22桁消す
	if ($(this).val()=='') {
		$("#"+idleft+"Tekiyou").val("");
	}else{
		$.ajax({
			type:"POST",
			url:shouhin_mrs_ajaxGet,
			data:{'cd':$(this).val(),},
			async:true,
			dataType:'json',
			success: function (data) {
				if(data.length==0){
					$("#"+idleft+"Tekiyou").val('>>エラー:未登録');
				}else if(data.length==1 || $("#"+idleft+"ShouhinMrCd").val() === data[0].cd){
					//選択肢をクリアしてから追加する
					//$('#ShouhinMrsOptions > option').remove();
					//for ( var i = 0; i < data.length; i++ ) {
					//	$('#ShouhinMrsOptions').append('<option value="' + data[i].cd + '">' + data[i].cd + ':' + data[i].name + '</option>');
					//}
					$("#"+idleft+"ShouhinMrCd").val(data[0].cd);
					$("#"+idleft+"Tekiyou").val(data[0].name);
					$("#"+idleft+"Irisuu").val(data[0].irisuu);
					$("#"+idleft+"TanniMr1Cd").val(data[0].tanni_mr1_cd);
					$("#"+idleft+"TanniMr1Name").val(data[0].tanni_mr1_name);
					$("#"+idleft+"TanniMr2Cd").val(data[0].tanni_mr2_cd);
					$("#"+idleft+"TanniMr2Name").val(data[0].tanni_mr2_name);
					$("#"+idleft+"Suu1Shousuu").val(data[0].suu1_shousuu);
					$("#"+idleft+"Suu2Shousuu").val(data[0].suu2_shousuu);
					$("#"+idleft+"ZaikoKbn").val(data[0].zaiko_kbn);
					tanni_sel(gyou);
					$("#"+idleft+"HKishuMrCd").val(data[0].shu_h_kishu_mr_cd);
					if (1*gyou+1 >= imax) {addHKeikakuMeisaiDt();}//新規行を追加しておく
				}else{
					//選択肢をクリアしてから追加する
					$('#ShouhinMrsOptions > option').remove();
					for ( var i = 0; i < data.length; i++ ) {
						$('#ShouhinMrsOptions').append('<option value="' + data[i].cd + '">' + data[i].cd + ':' + data[i].name + '</option>');
					}
					$("#"+idleft+"Tekiyou").val('>>エラー:未登録');
//alert(';'+$("#"+idleft+"ShouhinMrCd").val()+';'+data[0].cd+';');
					$("#"+idleft+"ShouhinMrCd").focus().select();
				}
			},
			error: function(xhr, status, err) {
				$("#"+idleft+"Tekiyou").val('>エラー'+status+'/'+err);
			},
		});
	}
});

$("[id$='HKishuMrCd']").change(function() { //機種マスター索引
	//alert("AAA:".$(this).attr("id")); //''の場合、'0'など1桁の場合または結果が複数の場合、結果が1個の場合、結果が0個の場合
	var idleft=$(this).attr("id").slice(0,-10); //fieldHKeikakuMeisaiDts0HKishuMrCd 右から9桁消す
	var gyou=idleft.slice(22); //fieldHKeikakuMeisaiDts0 左から22桁消す
	if ($(this).val()=='') {
		$("#"+idleft+"HKishuMrName").val("");
	}else{
		$.ajax({
			type:"POST",
			url:h_kishu_mrs_ajaxGet,
			data:{'cd':$(this).val(),},
			async:true,
			dataType:'json',
			success: function (data) {
				if(data.length==0){
					$("#"+idleft+"HKishuMrName").val('>>エラー:未登録');
				}else if(data.length==1 || $("#"+idleft+"HKishuMrCd").val() === data[0].cd){
					//選択肢をクリアしてから追加する
					$('#HKishuMrsOptions > option').remove();
					for ( var i = 0; i < data.length; i++ ) {
						$('#HKishuMrsOptions').append('<option value="' + data[i].cd + '">' + data[i].cd + ':' + data[i].name + '</option>');
					}
					$("#"+idleft+"HKishuMrCd").val(data[0].cd);
					$("#"+idleft+"HKishuMrName").val(data[0].name);
				}else{
					//選択肢をクリアしてから追加する
					$('#HKishuMrsOptions > option').remove();
					for ( var i = 0; i < data.length; i++ ) {
						$('#HKishuMrsOptions').append('<option value="' + data[i].cd + '">' + data[i].cd + ':' + data[i].name + '</option>');
					}
					$("#"+idleft+"HKishuMrName").val('>>エラー:未登録');
					$("#"+idleft+"HKishuMrCd").focus().select();
				}
			},
			error: function(xhr, status, err) {
				$("#"+idleft+"HKishuMrName").val('>エラー'+status+'/'+err);
			},
		});
	}
});

function tenkai(only1) { // 単展開、全展開
	// 1行目で定義済み idmeisaif='fieldHKeikakuMeisaiDts'
	var gyou=0
    if (lastfocusin == 'F7') {
        lastfocusin = lastfocusout;
    }
	if (lastfocusin.substr(0,22) == idmeisaif) {
		gyou=1*(lastfocusin.substr(22,10).match(/^\d+/)); // alert(gyou); // 22桁目から連続した数字を得る正規表現
	}
	if ($(jqmeisaif+gyou+"ShouhinMrCd").val()=='') {
		$(jqmeisaif+gyou+"Tekiyou").val("ありません");
	}else{
		var zaiko_kbn = $(jqmeisaif+gyou+'ZaikoKbn').val();
		$.ajax({
			type:"POST",
			url:kousei_buhin_mrs_ajaxTenkai,
			data:{'shouhin_mr_cd':$(jqmeisaif+gyou+"ShouhinMrCd").val(),
				'shouhin_mr_id':0,
				'suuryou':$(jqmeisaif+gyou+"KeikakuSuu").val(),
				'tanni_mr_cd':$(jqmeisaif+gyou+"TanniMr"+zaiko_kbn+"Cd").val(),
				'only1':only1,
				'fullo':1,
			},
			async:true,
			dataType:'json',
			success: function (data) {
				if(data.length==0){
					alert('>>エラー:構成部品未登録');
					$("#" + idmeisaif + gyou + "ShouhinMrCd").focus().select();
				}else {
					$(jqmeisaif+gyou+'Kousei').val('┬');
					$(jqmeisaif+gyou+'Kousei').addClass('kousei_oya');
					var i1=gyou;
					var kaisou_ary={0:i1};
					for ( var i = 0; i < data.length; i++ ) {
						if (data[i].gen_shouhin_mr.zaikokanri == 1) {
							i1 += 1;
							kaisou_ary[data[i].kaisou] = i1;
							if (i1 >= imax) { //新規行を追加
								addHKeikakuMeisaiDt();
							}
							$('#tr_h_keikaku_meisai_dt_'+(i+gyou)).addClass('kodomo'+gyou);
							$(jqmeisaif+(i1)+'Kousei').val(data[i].kousei);
							$(jqmeisaif+(i1)+'Kaisou').val(data[i].kaisou);
							$(jqmeisaif+(i1)+'SuuShousuu').val(data[i].gen_shouhin_mr.suu_shousuu);
							$(jqmeisaif+(i1)+'Suu1Shousuu').val(data[i].gen_shouhin_mr.suu1_shousuu);
							$(jqmeisaif+(i1)+'Suu2Shousuu').val(data[i].gen_shouhin_mr.suu2_shousuu);
							$(jqmeisaif+(i1)+'ShouhinMrCd').val(data[i].gen_shouhin_mr_cd);
							$(jqmeisaif+(i1)+'OyaMeisaiCd').val(kaisou_ary[data[i].kaisou - 1] + 1); // cd行番は1から
							$(jqmeisaif+(i1)+'Keisu').val(data[i].suuryou);
							$(jqmeisaif+(i1)+'Suuryou').val($(jqmeisaif+gyou+'KeikakuSuu'+$(jqmeisaif+gyou+'ZaikoKbn').val()).val());
							$(jqmeisaif+(i1)+'Irisuu').val(data[i].gen_shouhin_mr.irisuu);
							$(jqmeisaif+(i1)+'TanniMr1Cd').val(data[i].gen_shouhin_mr.tanni_mr1_cd);
							$(jqmeisaif+(i1)+'TanniMr1Name').val(data[i].gen_shouhin_mr.tanni_mr1_name);
							$(jqmeisaif+(i1)+'Tekiyou').val(data[i].gen_shouhin_mr.name);
							$(jqmeisaif+(i1)+'TanniMr2Cd').val(data[i].gen_shouhin_mr.tanni_mr2_cd);
							$(jqmeisaif+(i1)+'TanniMr2Name').val(data[i].gen_shouhin_mr.tanni_mr2_name);
							$(jqmeisaif+(i1)+'ZaikoKbn').val(data[i].gen_shouhin_mr.zaiko_kbn);
						//	$(jqmeisaif+(i1)+'HKishuMrCd').val($(jqmeisaif + gyou + "HKishuMrCd").val());
							tanni_sel(i1);
						}
					}
					kishu_set(gyou, i1);
					mugen_sosi=[]; // 無限ループ阻止
					suu_keisu_change(gyou); // ループ計算する
					if (i1 + 1 >= imax) {
						addHKeikakuMeisaiDt();
					}//新規行を追加しておく
				}
			},
			error: function(xhr, status, err) {
				alert('>ajax展開エラー'+status+'/'+err);
			},
		});
	}
};

function kishu_set(from_i, to_i) {
	ary_shouhin_mr_cd = [];
	for (var i = from_i; i < to_i; i++) {
		ary_shouhin_mr_cd[i - from_i] = $(jqmeisaif+(i)+"ShouhinMrCd").val();
	}
	$.ajax({
		type:"POST",
		url:h_shouhin_jouken_mrs_ajaxKishu,
		data:{'ary_shouhin_mr_cd':ary_shouhin_mr_cd,
		},
		async:true,
		dataType:'json',
		success: function (data) {
			for ( var i = 0; i < data.length; i++ ) {
				$(jqmeisaif+(i + from_i)+"ShouhinKakouCd").val(data[i].shouhin_kakou_cd);
				if (Object.keys(data[i].junni).length > 0) {
					$(jqmeisaif+(i + from_i)+"HKishuMrCd").val(data[i].junni[0].h_kishu_mr_cd);
					$(jqmeisaif+(i + from_i)+"HKishuMrName").val(data[i].junni[0].h_kishu_mr_name);
					$(jqmeisaif+(i + from_i)+"HKishuMrIrowake").val(data[i].junni[0].h_kishu_mr_irowake);
					$(jqmeisaif+(i + from_i)+"Suisuu").val(data[i].junni[0].h_kishu_mr_suisuu);
					$(jqmeisaif+(i + from_i)+"Kouritu").val(data[i].junni[0].kouritu);
					$(jqmeisaif+(i + from_i)+"KourituTanni").val(data[i].junni[0].kouritu_tanni);
					if (1*$(jqmeisaif+(i + from_i)+"Daisuu").val()==0) {
						$(jqmeisaif+(i + from_i)+"Daisuu").val('1');
					}
				} else {
					$(jqmeisaif+(i + from_i)+"HKishuMrCd").val('');
					$(jqmeisaif+(i + from_i)+"HKishuMrName").val('');
					$(jqmeisaif+(i + from_i)+"HKishuMrIrowake").val('404040');
					$(jqmeisaif+(i + from_i)+"Suisuu").val('');
					$(jqmeisaif+(i + from_i)+"Kouritu").val('');
					$(jqmeisaif+(i + from_i)+"KourituTanni").val('');
				}
			}
		},
		error: function(xhr, status, err) {
			alert('>ajax機種エラー'+status+'/'+err);
		},
	});
}

function saitan_after() { // 今日以降最短日程
	var dy = new Date();
	var today1 = dy.getFullYear()+'-'+("00" + (dy.getMonth()+1)).slice(-2)+'-'+("00" + dy.getDate()).slice(-2);
	var max_kaisou = 0;
	for (var i=0;i<imax-1;i++) { // 最終原料に今日
		$(jqmeisaif+i+'KaisiHiduke').val(today1);
		$(jqmeisaif+i+'ShuuryouHiduke').val(today1);
		if (1*$(jqmeisaif+i+'Kaisou').val() > max_kaisou) {
			max_kaisou = 1*$(jqmeisaif+i+'Kaisou').val();
		}
	}
	for (var i_kaisou = max_kaisou; i_kaisou >= 0; i_kaisou--) {
		for (var i=0;i<imax-1;i++) {
			if (i_kaisou == $(jqmeisaif+i+'Kaisou').val()) {
				var daisuu = 1*$(jqmeisaif+i+'Daisuu').val(); // 台数
				if (daisuu == 0) {daisuu=1;} // 0台なら1台
				var suisuu = 1*$(jqmeisaif+i+'Suisuu').val(); // 総錘数
				if (suisuu == 0) {suisuu=1;} // 0錘なら1錘
				var nissuu = 0;
				if (1*$(jqmeisaif+i+'Kouritu').val()>0) {
					var nissuu = Math.ceil(1 * $(jqmeisaif+i+'KeikakuSuu').val().replace(/,/g, '') / $(jqmeisaif+i+'Kouritu').val() / suisuu / daisuu);
				}
				var dx = $(jqmeisaif+i+'KaisiHiduke').val().replace(/-/g, '/');
				var d1 = new Date(dx);
				d1.setDate(d1.getDate() + nissuu);
				var datex = d1.getFullYear()+'-'+("00" + (d1.getMonth()+1)).slice(-2)+'-'+("00" + d1.getDate()).slice(-2);
				$(jqmeisaif+i+'ShuuryouHiduke').val(datex);
				$(jqmeisaif+i+'KadouNissuu').val(nissuu);
				if (i_kaisou > 0) {
					i_oya = $(jqmeisaif+i+'OyaMeisaiCd').val() - 1;
					if ($(jqmeisaif+i_oya+'KaisiHiduke').val() == '' || $(jqmeisaif+i_oya+'KaisiHiduke').val() < $(jqmeisaif+i+'ShuuryouHiduke').val()) {
						$(jqmeisaif+i_oya+'KaisiHiduke').val($(jqmeisaif+i+'ShuuryouHiduke').val());
					}
				} else {
					if ($('#fieldNounyuuKijitu').val() == '' || $('#fieldNounyuuKijitu').val() < $(jqmeisaif+i+'ShuuryouHiduke').val()) {
						$('#fieldNounyuuKijitu').val($(jqmeisaif+i+'ShuuryouHiduke').val());
					}
				}
			}
		}
	}
	saitan_befor(); // 納期以前最短日程
}

function saitan_befor() { // 納期以前最短日程
	var dy = new Date();
	var today1 = dy.getFullYear()+'-'+("00" + (dy.getMonth()+1)).slice(-2)+'-'+("00" + dy.getDate()).slice(-2);
	var max_kaisou = 0;
	for (var i=0;i<imax-1;i++) { // 階層最大算出
		$(jqmeisaif+i+'KaisiHiduke').val(''); // 開始日クリア
		$(jqmeisaif+i+'ShuuryouHiduke').val('');
		if (1*$(jqmeisaif+i+'Kaisou').val() > max_kaisou) {
			max_kaisou = 1*$(jqmeisaif+i+'Kaisou').val();
		}
	}
	for (var i_kaisou = 0; i_kaisou <= max_kaisou; i_kaisou++) {
		for (var i=0;i<imax-1;i++) {
			if (i_kaisou == $(jqmeisaif+i+'Kaisou').val()) {
				if (i_kaisou > 0) {
					i_oya = $(jqmeisaif+i+'OyaMeisaiCd').val() - 1;
					if ($(jqmeisaif+i+'ShuuryouHiduke').val() == '' || $(jqmeisaif+i_oya+'KaisiHiduke').val() < $(jqmeisaif+i+'ShuuryouHiduke').val()) {
						$(jqmeisaif+i+'ShuuryouHiduke').val($(jqmeisaif+i_oya+'KaisiHiduke').val());
					}
				} else {
					$(jqmeisaif+i+'ShuuryouHiduke').val($('#fieldNounyuuKijitu').val());
				}
				var daisuu = 1*$(jqmeisaif+i+'Daisuu').val(); // 台数
				if (daisuu == 0) {daisuu=1;} // 0台なら1台
				var suisuu = 1*$(jqmeisaif+i+'Suisuu').val(); // 総錘数
				if (suisuu == 0) {suisuu=1;} // 0錘なら1錘
				var nissuu = 0;
				if (1*$(jqmeisaif+i+'Kouritu').val()>0) {
					var nissuu = Math.ceil(1 * $(jqmeisaif+i+'KeikakuSuu').val().replace(/,/g, '') / $(jqmeisaif+i+'Kouritu').val() / suisuu / daisuu);
				}
				var dx = $(jqmeisaif+i+'ShuuryouHiduke').val().replace(/-/g, '/');
				var d1 = new Date(dx);
				d1.setDate(d1.getDate() - nissuu);
				var datex = d1.getFullYear()+'-'+("00" + (d1.getMonth()+1)).slice(-2)+'-'+("00" + d1.getDate()).slice(-2);
				$(jqmeisaif+i+'KaisiHiduke').val(datex);
				$(jqmeisaif+i+'KadouNissuu').val(nissuu);
			}
		}
	}
	$("[id$='Hiduke']").scrollLeft(100);
	jsgant();
}

var g;
var gFormat = 'week';
function jsgant() {
	g = new JSGantt.GanttChart('g', document.getElementById('GanttChartDIV'), gFormat);
	g.setShowRes(0);              // リソースの表示/非表示（0/1）
	g.setShowDur(0);              // 期間の表示/非表示（0/1）
	g.setShowComp(0);             // 完了率を表示/非表示（0/1）
	g.setCaptionType('Resource'); // キャプションを表示（None、Caption、Resource、Duration、Complete）に設定
	g.setShowStartDate(0);        // 開始日を表示/非表示（0/1）
	g.setShowEndDate(0);          // 終了日を表示/非表示（0/1）
	g.setDateInputFormat('yyyy-mm-dd');  // 入力日付の形式を設定 ('mm/dd/yyyy', 'dd/mm/yyyy', 'yyyy-mm-dd')
	g.setDateDisplayFormat('yy/mm/dd');  // 日付を表示する形式を設定 ('mm/dd/yyyy', 'dd/mm/yyyy', 'yyyy-mm-dd')
	g.setFormatArr("day","week","month"); // 書式オプションを設定します（最大4つ : "minute","hour","day","week","month","quarter")
	for (var i = 0; i < imax - 1; i++) {
		g.AddTaskItem(new JSGantt.TaskItem(
			$(jqmeisaif+i+'Cd').val(),             // pID ：（必須）は、親関数の各行を識別し、非表示/表示のdom idを設定するために使用される一意のIDです
			$(jqmeisaif+i+'ShouhinMrCd').val(),    // pName ：（必須）はタスクラベルです
			$(jqmeisaif+i+'KaisiHiduke').val(),    // pStart ：（必須）タスクの開始日。グループの空の日付（ ''）を入力できます。 また、特定の時間（2/10/2008 12:00）を入力して、追加の精度または半日にすることもできます。
			$(jqmeisaif+i+'ShuuryouHiduke').val(), // pEnd ：（必須）タスクの終了日。グループの空の日付（ ''）を入力できます
			$(jqmeisaif+i+'HKishuMrIrowake').val(),// pColor ：（必須）このタスクのhtmlカラー。 例： '00ff00'
			'http://google.com',                   // pLink ：（オプション）タスクバーがクリックされたときに移動するhttpリンク。
			0,                                     // pMile :(オプション）マイルストーンを表します
			$(jqmeisaif+i+'HKishuMrCd').val(),     // pRes ：（オプション）リソース名
			0, // pComp ：（必須）完了率
			0, // pGroup ：（オプション）これがグループ（親）かどうかを示します-0 = NOT親; 1 = IS親
			$(jqmeisaif+i+'OyaMeisaiCd').val(), // pParent ：（必須）親pIDを識別します。これにより、このタスクは識別されたタスクの子になります。
			0, // pOpen ：チャートが最初に描画されるときに最初にフォルダーを閉じるように設定できます
			1*$(jqmeisaif+i+'OyaMeisaiCd').val(), // pDepend ：このタスクが依存するidのオプションのリスト...依存からこのアイテムに引かれた線
			$(jqmeisaif+i+'Tekiyou').val()  // pCaption ：CaptionTypeが「Caption」に設定されている場合、タスクバーの後に追加されるオプションのキャプション
		));
	}
	g.Draw();
	g.DrawDependencies();
}

$(document).on('click', '.kousei_oya', function(){
	var gyou=1*(lastfocusin.substr(21,10).match(/^\d+/));
	if ($(this).val() == '-') {
		$("#meisaiTable tr[class='kodomo"+gyou+"']").hide();
		$(this).val('+');
	} else {
		$("#meisaiTable tr[class='kodomo"+gyou+"']").show();
		$(this).val('-');
	}
});

/* モーダルダイヤログ部分 */
function f8key() {
	if (lastfocusin == "fieldCd") { /* 発注データ選択 */
		modalstart1(den_modal,"発注データ選択");
	}else if (lastfocusin.slice(-11) == "ShouhinMrCd") { /* 商品コード選択 */
		modalstart(shouhin_mrs_modal,"商品選択");
	}else if (lastfocusin.slice(-10) == "HKishuMrCd") { /* 機種コード選択 */
		modalstart(h_kishu_mrs_modal,"機種選択");
	}else if (lastfocusin == "fieldHKeikakubi") { /* 発注日選択 */
		open_datepicker();
	}else if (lastfocusin == "fieldNounyuuKijitu") { /* 納入期日選択 */
		open_datepicker();
	}else if (lastfocusin.slice(-6) == "Hiduke") { /* 日付選択 */
		open_datepicker();
	}
}

/* モーダル印刷ダイヤログ部分 */
function f5key() {
    modalstart(chouhyou_mrs_modal, "発注伝票印刷", "/h_keikaku"); // hachuu=発注伝票
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

function modalstart(url,title,para) {
	$('#iframe-title').text(title);
    $('#iframe-wrap').fadeIn();
    if (!para) {
        para = '?cd=' + $('#' + lastfocusin).val();
    }
    $('#iframe-body').html('<iframe src="' + url + para + '" width="100%" height="100%" style="border: none;">');
    $('#iframe-bg').fadeTo('normal', 0.5);
    $('#iframe-body iframe').load(function () {
        $(this).contents().find('#header, #footer').hide();
    });
    return false;
}

function modalstart1(url,title) {
	$('#iframe-title').text(title);
    $('#iframe-wrap').fadeIn();
    $('#iframe-body').html('<iframe src="" width="100%" height="100%" style="border: none;" name="iframe1">');
    $('#iframe-bg').fadeTo('normal', 0.5);
    $('#iframe-body iframe').load(function () {
        $(this).contents().find('#header, #footer').hide();
    });
    document.iframe1form.submit();
    return false;
}

$('#iframe-wrap button').click(function () { /* 中止して終わる (X) */
  $('#iframe-bg, #iframe-wrap').fadeOut();
});

function fromModal(retval) {
    // alert('親ページの関数が実行されました。'+retval);
    $('#iframe-wrap').fadeOut(
      function(){//alert("フェードアウト完了")
        if (retval){
          $('#'+lastfocusin).val(retval);
          $('#'+lastfocusin).change();
        }
      }
    );
    $('#iframe-bg').fadeOut();
    $('#'+lastfocusin).focus().select();
}

function fromModal1(retval) { // 印刷モーダルからの帰り
    // alert('親ページの関数が実行されました。'+retval);
    $('#iframe-wrap').fadeOut(
        function () {//alert("フェードアウト完了")
            if (retval) {
                $('#formTouroku').submit(); // 更新実行
            }
        }
    );
    $('#iframe-bg').fadeOut();
    $('#' + lastfocusin).focus().select();
}

$(function() { // モーダルウィンドウをドラッグで移動できる
    $("#iframe-wrap").draggable({
        handle: ".modal-header"
    });
});

/* 画面内計算 */

$("[id$='Suuryou']").change(function () { //元数量が変更されたら
    var idleft = $(this).attr("id").slice(0, -7); //fieldShiireMeisaiDts0Suuryou 右から7桁消す
	var gyou=idleft.slice(22); //fieldHKeikakuMeisaiDts0 左から22桁消す
    suu_keisu_change(gyou);
});

$("[id$='Keisu']").change(function () { //係数が変更されたら
    var idleft = $(this).attr("id").slice(0, -5); //fieldShiireMeisaiDts0Keisu 右から5桁消す
	var gyou=idleft.slice(22); //fieldHKeikakuMeisaiDts0 左から22桁消す
    suu_keisu_change(gyou);
});

function suu_keisu_change(gyou) { //元数量か係数が変更された時の共通処理
	var suuryou = 1*$(jqmeisaif+gyou+"Suuryou").val().replace(/,/g, '');
	var keisu = 1*$(jqmeisaif+gyou+"Keisu").val().replace(/,/g, '');
	var zaiko_kbn = $(jqmeisaif+gyou+"ZaikoKbn").val();
	var irisuu = 1*$(jqmeisaif+gyou+"Irisuu").val().replace(/,/g, '');
	var suufld = $(jqmeisaif+gyou+"HituyouSuu");
	var sh1 = $(jqmeisaif+gyou+"Suu"+zaiko_kbn+"Shousuu").val(); // 小数桁を揃える
	suufld.val(keisu * suuryou);//カンマ編集
	gyou_keisan(gyou, suufld);
}

$("[id$='JuchuuSuu']").change(function() {
	var idleft=$(this).attr("id").slice(0,-9);
	var gyou=idleft.slice(22); //fieldHKeikakuMeisaiDts0 左から22桁消す
	mugen_sosi=[]; // 無限ループ阻止
	gyou_keisan(gyou, this);
	if ($('#fieldNounyuuKijitu').val() == '') {
		saitan_after();
	} else {
		saitan_befor();
	}
});

$("[id$='ZaikoseisanSuu']").change(function() {
	var idleft=$(this).attr("id").slice(0,-14);
	var gyou=idleft.slice(22); //fieldHKeikakuMeisaiDts0 左から22桁消す
	mugen_sosi=[]; // 無限ループ阻止
	gyou_keisan(gyou, this);
});

$("[id$='LossSuu']").change(function() {
	var idleft=$(this).attr("id").slice(0,-7);
	var gyou=idleft.slice(22); //fieldHKeikakuMeisaiDts0 左から22桁消す
	mugen_sosi=[]; // 無限ループ阻止
	gyou_keisan(gyou, this);
});

$("[id$='DemeSuu']").change(function() {
	var idleft=$(this).attr("id").slice(0,-7);
	var gyou=idleft.slice(22); //fieldHKeikakuMeisaiDts0 左から22桁消す
	mugen_sosi=[]; // 無限ループ阻止
	gyou_keisan(gyou, this);
});

$("[id$='ZaikosiyouSuu']").change(function() {
	var idleft=$(this).attr("id").slice(0,-13);
	var gyou=idleft.slice(22); //fieldHKeikakuMeisaiDts0 左から22桁消す
	mugen_sosi=[]; // 無限ループ阻止
	gyou_keisan(gyou, this);
});

$("[id$='Hiduke']").change(function() {
	$(this).blur();
	$(this).scrollLeft(100);
	jsgant();
});

function gyou_keisan(gyou, this0) { // 行内数量計算
    var sh1 = $(jqmeisaif+gyou+"Suu"+$(jqmeisaif+gyou+"ZaikoKbn").val()+"Shousuu").val(); // 小数桁を揃える
    var suu = 1*$(this0).val().replace(/,/g, '');
	$(this0).val(suu==0?'':Intl.NumberFormat("ja-JP", {minimumFractionDigits: sh1, maximumFractionDigits: sh1}).format(suu));//カンマ編集
	var keikaku_suu=0
		+1*$(jqmeisaif+gyou+"HituyouSuu").val().replace(/,/g, '')
		+1*$(jqmeisaif+gyou+"JuchuuSuu").val().replace(/,/g, '')
		+1*$(jqmeisaif+gyou+"ZaikoseisanSuu").val().replace(/,/g, '')
		+1*$(jqmeisaif+gyou+"LossSuu").val().replace(/,/g, '')
		-1*$(jqmeisaif+gyou+"DemeSuu").val().replace(/,/g, '')
		-1*$(jqmeisaif+gyou+"ZaikosiyouSuu").val().replace(/,/g, '');
	$(jqmeisaif+gyou+"KeikakuSuu").val(Intl.NumberFormat("ja-JP", {minimumFractionDigits: sh1, maximumFractionDigits: sh1}).format(keikaku_suu));//カンマ編集
	eikyou_keisan(gyou);
}

var mugen_sosi=[];

function eikyou_keisan(gyou) { // 計画数変化による影響
	mugen_sosi[imax]=0; // 無限ループ阻止
	mugen_sosi[gyou]=1; // 自己ループ阻止
	for (var i=0; i<imax; i++) {
		if ($(jqmeisaif+gyou+"Cd").val()==$(jqmeisaif+i+"OyaMeisaiCd").val() && typeof mugen_sosi[i] === 'undefined') {
			mugen_sosi[i]=1; // 無限ループ阻止
			$(jqmeisaif+i+"Suuryou").val(1*$(jqmeisaif+gyou+"KeikakuSuu").val().replace(/,/g, ''));
			suu_keisu_change(i);
		}
	}
}

function tanni_sel(gyou) { //単位が変更
    var zaiko_kbn = $(jqmeisaif+gyou+'ZaikoKbn');
    var zaiko_kbn_sel = zaiko_kbn.val();
    zaiko_kbn.children().remove();
    zaiko_kbn.append($("<option>").val('1').text($(jqmeisaif+gyou+'TanniMr1Name').val()));
    zaiko_kbn.append($("<option>").val('2').text($(jqmeisaif+gyou+'TanniMr2Name').val()));
    zaiko_kbn.val(zaiko_kbn_sel);
}


$(function(){ // テーブルのヘッドを消えなくする
  $('table.head_fix').floatThead({
  	top: 50
  });
});


(function($){ //$=JQuery
        var sheet_nm = "#meisaiTable";
        var drag_target = null;
        var tbl_width = $(sheet_nm).width();
        var org_width = 0;
        $(sheet_nm + " th").unbind('mousemove', null);
        $(sheet_nm + " th").unbind('mousedown', null);
        $(window).unbind('mousemove', null);
        $(window).unbind('mouseup', null);
        $(window).mousemove(function(e) {
                if (drag_target != null) {
                        //ドラッグ中による列幅変更。
                        var th_width = e.clientX - parseInt($(drag_target).offset().left);
                        if (th_width < 10) {th_width = 10;}
                        if (drag_target.hasClass('ot-fixed')) {
                            $('.ot-fixed').css({ width: th_width + 'px' });
                        } else {
                            drag_target.css({ width: th_width + 'px' });
                        }
                        //tableのサイズも変更する。
                        //var tbl_width = th_width - parseInt(drag_target.css("width"));
                        //var tbl_new_width = parseInt($(sheet_nm).css("width")) + tbl_width;
                        var tbl_new_width = tbl_width - org_width + th_width;
                        $(sheet_nm).css({ width: tbl_new_width + 'px' });
                        return false;
                }
                return true;
        });//[[ mousemove
        $(sheet_nm + " th").mousemove(function(e) {
                var right = parseInt($(this).offset().left) + parseInt($(this).css("width"));
                //マウスカーソルの図柄変更。
                if ((right - 10) < e.clientX) {
                        if (e.clientX < (right + 10)) {
                                //右端に位置する場合はリサイズカーソルにする。
                                $(this).css({ cursor: 'col-resize' });
                                return false;
                        }
                }
                $(this).css({ cursor: 'default' });
                return true;
        });//[[ mousemove
        $(sheet_nm + " th").mousedown(function(e) {
                //マウスカーソルの図柄変更。
                if ($(this).css('cursor') == 'col-resize') {
                        //ドラッグ開始。
                        drag_target = $(this);
                        $(document.body).css({ cursor: 'col-resize' });
                        tbl_width = $(sheet_nm).width();
                        org_width = $(this).width() + 1;
                        return false;
                }
                return true;
        });//[[ mousedown
        $(window).mouseup(function(e) {
                //ドラッグ解除。
                drag_target = null;
                $(document.body).css({ cursor: '' });
                var tbl_new_width = 0;
        });//[[ mouseup
})(jQuery); //[[ onload.


function switch_roa(fieldx) { // 項目制御readonly設定(主)
	if ($("#field"+fieldx).attr("readonly")==="readonly") {
		$("#field"+fieldx).removeAttr("readonly");
	} else {
		$("#field"+fieldx).attr("readonly","readonly");
	}
	$targetElm = $( targetElm );
}

function switch_ros(fieldx) { // 項目制御readonly設定(明細)
	if ($("#hidden"+fieldx).attr("readonly")==="readonly") {
		$("#hidden"+fieldx).removeAttr("readonly");
		for (var i=0; i<imax; i++) {
			$("#fieldHKeikakuMeisaiDts"+i+fieldx).removeAttr("readonly");
		}
	} else {
		$("#hidden"+fieldx).attr("readonly","readonly");
		for (var i=0; i<imax; i++) {
			$("#fieldHKeikakuMeisaiDts"+i+fieldx).attr("readonly","readonly");
		}
	}
	$targetElm = $( targetElm );
}

var ro_fields=[
	'cd','h_keikakubi','juchuu_dt_cd','nounyuu_kijitu','zeiritu_tekiyoubi','torihiki_kbn_cd',
	'zei_tenka_kbn_cd','hassousaki_kbn_cd','tekiyou','shounin_joutai_flg','shounin_sha_mr_cd',
	'[cd','[utiwake_kbn_cd','[kousei','[nyuuka_kbn_cd','[shouhin_mr_cd','[tekiyou','[iro','[iromei','[lot','[kobetucd','[h_kishu_mr_cd','[hinsitu_kbn_cd','[suuryou','[keisu','[irisuu','[suuryou1',
	'[tanni_mr1_cd','[suuryou2','[tanni_mr2_cd','[h_keikakuzan','[zaiko_kbn','[genzaiko','[zaiko','[kingaku','[zeiritu_mr_cd','[nouki','[bikou'
	]; // 閉じ角カッコはajaxで渡すときに欠落するので初めから入れない。

function save_ros() {
	$("#save_ros").text("(→「入力制御の保存中!....」)").css('color','red');
	var readonlys = {}; // 連想配列初期化
	var rewidths = {}; // 連想配列初期化
	for (var j in ro_fields) {
		var ro_field_name = ro_fields[j];
		if (ro_fields[j].substr(0,1) == '[') {
			ro_field_name = 'hidden' + ro_fields[j] + ']';
		}
		readonlys[ro_fields[j]] = $("[name='" + ro_field_name + "']").attr('readonly')==='readonly';
		if (ro_fields[j].substr(0,1) == '[') {
			ro_field_name = 'data[h_keikaku_meisai_dts][0]'+ro_fields[j]+']';
			rewidths[ro_fields[j]] = $("[name='"+ro_field_name+"']").outerWidth();
		}
	}
	$.ajax({
		type:"POST",
		url:readonlys_ajaxSave,
		data:{'controller_cd':'HKeikakuDts','gamen_cd':'inputfields','readonlys':readonlys,'rewidths':rewidths,},
		async:true,
		dataType:'json',
		success: function (error_count) {
			alert('入力制御の保存完了！'+error_count);
			$("#save_ros").text('(click→「入力制御の保存」)').css('color','pink');
		},
		error: function(xhr, status, err) {
			alert('入力制御の保存でエラー Cd.change.ajax '+status+'/'+err);
			$("#save_ros").text('(click→「入力制御の保存」)').css('color','pink');
		},
	});

}
