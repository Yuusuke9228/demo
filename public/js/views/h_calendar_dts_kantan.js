//簡単カレンダー 2020/3/7 作成 井浦

var g1 = {}; // 共通の格納領域

// =================================================================
window.onload = function(){
// -----------------------------------------------------------------
	ajaxAnyDo('read', 'g1_to_GAMEN');
}

// =================================================================
$("#fieldCd").change(function(){ // パターンの変化
// -----------------------------------------------------------------
	g1.cd = $(this).val();
	if ($('#fieldCopy').val()==0) {
		ajaxAnyDo('read', 'g1_to_GAMEN');
	}
});

// =================================================================
$("#fieldNen").change(function(){ // 年の変化
// -----------------------------------------------------------------
	g1.nen = $(this).val();
	if ($('#fieldCopy').val()==0) {
		ajaxAnyDo('read', 'g1_to_GAMEN');
	}
});

// =================================================================
$(document).on('click',".hiduke",function(){ // 日付をクリックしたら休日反転
// -----------------------------------------------------------------
	var thisid=$(this).attr('id');
	var thisymd=thisid.slice(1);
	if (g1.calendar[thisymd].kadou_flg == 1) {
		g1.calendar[thisymd].kadou_flg = 0;
		$(this).addClass('kyuugyou'); // toggleClassでも可
	} else {
		g1.calendar[thisymd].kadou_flg = 1;
		$(this).removeClass('kyuugyou');
	}
	nissuu();
	$('#dispEmsg').text('').removeClass('alert');
});

// =================================================================
$(document).on('click',".bikou",function(){ // 日付をクリックしたら備考入力
// -----------------------------------------------------------------
	var parentid=$(this).parent().attr('id');
	var thisymd=parentid.slice(1);
	var temp = prompt("備考:"+thisymd+":"+g1.calendar[thisymd]['shuk_bikou'], g1.calendar[thisymd]['bikou']);
	if (temp != null) g1.calendar[thisymd]['bikou'] = temp;
	$(this).attr('title',g1.calendar[thisymd]['bikou']);
	if (g1.calendar[thisymd]['bikou']) {
		$(this).addClass('ul');
	} else {
		$(this).removeClass('ul');
	}
	return false; // 休日反転しない。
});
// =================================================================
function save(){ // 保存
// -----------------------------------------------------------------
	$('#dispEmsg').text('登録しています...').addClass('alert alert-success');
	ajaxAnyDo('save', 'g1_to_GAMEN');
}

// *****************************************************************
function ajaxAnyDo(TODO, CALLBACK) { // 現在グループのチェック等
// *----------------------------------------------------------------
 try {
	g1.errflg = 0;
	g1.emsg = '';
	g1.errfld = '';
	$.ajax({
		type:"POST",
		url:this_url_base+'h_calendar_dts/ajaxAnyDo',
		data:{'todo':TODO,'g1':g1,},
		async:true,
		dataType:'json',
		success: function (data) {
			g1=data;
			if (CALLBACK) window[CALLBACK](); // 呼び出し指定のfunctionを呼ぶ。例：ANSWER()
//			$('#point_1').text('');
//			for (var i=0;i<g1.point_1.length;i++) {
//				$('#point_1').append(g1.point_1[i]+'<br>');
//			}
		},
		error: function(xhr, status, err) {
			alert('エラー '+this_url_base+'h_calendar_dts/ajaxAnyDo'+status+'/'+err);
		},
	});
 } catch(error) {alert("エラー17内容："+error);}
}

// *****************************************************************
function g1_to_GAMEN() { // 表示。
// *----------------------------------------------------------------
 try {
	$('#dispEmsg').text(g1.emsg).removeClass(); // エラーメッセージ表示
	if (g1.errflg == 1) {
		if ($('#dispEmsg').text()!='') $('#dispEmsg').addClass('alert alert-danger');
		audio.play();
		return;
	}
	g1_to_calendar();
	$('#fieldCopy').val(0);
	if ($('#dispEmsg').text()!='') $('#dispEmsg').addClass('alert alert-'+(g1.errflg==2?'warning':'info'));
 } catch(error) {alert("エラー6内容："+error);}
}

// *****************************************************************
function g1_to_calendar() {
// *----------------------------------------------------------------
	$('#fieldCd').val(g1.cd);
	$('#fieldNen').val(g1.nen);
	var startDate = new Date(g1.nen, 0, 1) // 年の最初の日を取得
	var youbi = startDate.getDay() // 月の最初の日の曜日を取得
	var buf='<table><tbody>';
	for (var tate=0;tate<4;tate++) {
		buf+='<tr>';
		for (var yoko=0;yoko<3;yoko++) {
			var m=1+yoko+tate*3;
			var mm=('0'+m).slice(-2);
			buf+="<td class='tuki'><div width=100%><div class='col-sm-6 text-left h4'>"+m+" 月"+"</div><div id='mkadou"+m+"' class='col-sm-6 text-right h5'></div><table><thead>";
			buf+="<tr><th class='sunday'>日</th><th>月</th><th>火</th><th>水</th><th>木</th><th>金</th><th class='sataday'>土</th></tr></thead><tbody>";
			var kongetu=true;
			var d=1;
			for (var shuu=0;shuu<6 && kongetu; shuu++) {
				buf+='<tr>';
				for (var i=0;i<youbi && shuu==0; i++) {buf+='<td></td>';}
				for (; youbi<7 && kongetu; youbi++) {
					dd=('0'+d).slice(-2);
					key=''+g1.nen+'-'+mm+'-'+dd;
					if (key in g1.calendar) {
						buf += "<td id='D"+key+"' class='hiduke";
						if (g1.calendar[key]['kadou_flg']==0) buf+=' kyuugyou';
						if (g1.calendar[key]['kadou_flg']==2) buf+=' kyuugyou';
						buf += "'><a class='bikou";
						if (youbi==0) buf+=' sunday';
						if (youbi==6) buf+=' sataday';
						if (g1.calendar[key]['shuk_flg']==0) buf+=' shuk';
						buf += (g1.calendar[key]['bikou']?' ul':'')+"' title='"+g1.calendar[key]['bikou']+"'>"+d+"</a></td>";
						d++;
					} else {
						youbi--;
						kongetu=false;
					}
				}
				if (youbi >= 7) youbi = 0;
				buf+='</tr>';
			}
			buf+='</tbody></table></td>';
		}
		buf+='</tr>';
	}
	buf+='</tbody></table>';
	buf+="<div class='footer'><div id='ykadou' class='col-sm-3 text-left'></div><div id='yyasumi' class='col-sm-3 text-right'></div>";
	buf+="<div class='col-sm-6 text-center'>"+g1.patan_bikou+"</div></div>";
	$('#calendar').empty();
	$('#calendar').append(buf);    // append関数で指定先の要素へ出力
	
	nissuu();
}
// *****************************************************************
function nissuu() {
// *----------------------------------------------------------------
	var mkadou=[];
	var mnissuu=[];
	for (var m=1;m<=12;m++){
		mkadou[m] = 0;
		mnissuu[m] = 0;
	}
//	g1.calendar.forEach(function(aday, key){
	$.each(g1.calendar,function(key,aday){
		var keys=key.split('-');
		var m=1*keys[1];
		mkadou[m] += (1*aday.kadou_flg);
		mnissuu[m]++;
	});
	var ykadou = 0;
	var ynissuu = 0;
	for (var m=1;m<=12;m++){
		ykadou += mkadou[m];
		ynissuu += mnissuu[m];
		$('#mkadou'+m).text(mkadou[m]+" 日");
	}
	$('#ykadou').text("年間稼働日数 "+ykadou+" 日");
	$('#yyasumi').text("年間休日日数 "+(ynissuu-ykadou)+" 日");
	
}
