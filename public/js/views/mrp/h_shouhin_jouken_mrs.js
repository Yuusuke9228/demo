idmeisaif = 'fieldHKeikakuMeisaiDts';
jqmeisaif = '#' + idmeisaif;

window.onload = function(){
	addForm1(); // モーダル呼出post用フォームを追加
	get_shouhin('#fieldShouhinMrCd'); // $('#fieldShouhinMrCd').change();
}

function addForm1(){ // モーダル呼出post用フォームを追加
	var form1 = $('<form></form>',{
		id:'form1',
		action:'',//+den_modal,
		target:'iframe1',
		method:'POST',
		name:'iframe1form'
	}).hide();
	$('body').append(form1);
//	form1.append($('<input>',{type:'hidden',name:'sakusei_user_id',value:my_id}));
//	form1.append($('<input>',{type:'hidden',name:'denpyou_mr_cd',value:'h_keikaku'}));
}

$('#fieldShouhinMrCd').change(function () { //商品台帳索引
	$("#fieldHKishuMrCd").val('');
	get_shouhin(this);
});

function get_shouhin(this0) {
//	alert($(this0).val()); //''の場合、'0'など1桁の場合または結果が複数の場合、結果が1個の場合、結果が0個の場合
    if ($(this0).val() != '') {
        $.ajax({
            type: "POST",
            url: shouhin_mrs_ajaxGet,
            data: {'cd': $(this0).val(), 'pre_p': '%'},
            async: true,
            dataType: 'json',
            success: function (data) {
                if (data.length == 0) {
                    alert('>>エラー:未登録');
                    $(this0).focus().select();
                } else if (data.length == 1 || $("#fieldShouhinMrCd").val() === data[0].cd) {
                    //選択肢をクリアしてから追加する
                    $('#ShouhinMrsOptions > option').remove();
                    for (var i = 0; i < data.length; i++) {
                        $('#ShouhinMrsOptions').append('<option value="' + data[i].cd + '">' + data[i].cd + ':' + data[i].name + '</option>');
                    }
                    $("#fieldShouhinMrCd").val(data[0].cd);
                    $("#fieldShouhinMrName").val(data[0].name);
                    $("#fieldShouhinMrKana").val(data[0].kana);
                    kousei_buhin();
                    get_jouken('#fieldHKishuMrCd'); // $('#fieldHKishuMrCd').change();
                } else {
                    //選択肢をクリアしてから追加する
                    $('#ShouhinMrsOptions > option').remove();
                    for (var i = 0; i < data.length; i++) {
                        $('#ShouhinMrsOptions').append('<option value="' + data[i].cd + '">' + data[i].cd + ':' + data[i].name + '</option>');
                    }
                    $("#fieldShouhinMrName").val('>>さらに選択してください。');
                    $("#fieldShouhinMrCd").focus().select();
                }
            },
            error: function (xhr, status, err) {
                alert('エラー Cd.change.ajax ' + status + '/' + err);
            },
        });
    }
}

function kousei_buhin() { // 単展開
	if ($("#fieldShouhinMrCd").val()=='') {
		$("#fieldShouhinMrName").val("ありません");
	}else{
		$.ajax({
			type:"POST",
			url:kousei_buhin_mrs_ajaxOya,
			data:{'gen_shouhin_mr_cd':$("#fieldShouhinMrCd").val(),
				'shouhin_mr_cd':'',
			},
			async:true,
			dataType:'json',
			success: function (data) {
				if(data.length==0){
					console.log(data);
					$('#kousei_buhin').empty();
					$('#kousei_buhin').append($('<table>', {id:'kousei_tbl'}));
					alert('>>構成部品未登録');
					$('#fieldShouhinMrCd').focus().select();
				}else {
					$('#kousei_buhin').empty();
					$('#kousei_buhin').append($('<table>', {id:'kousei_tbl'}));
					$('#kousei_tbl').append($('<thead>', {id:'kousei_thed'}));
					$('#kousei_thed').append($('<tr>', {id:'kousei_thtr'}));
					$('#kousei_thtr').append('<th>商品コード</th><th>構成量</th><th>単位</th><th>商品名1</th><th>名2</th>');
					$('#kousei_tbl').append($('<tbody>', {id:'kousei_tbdy'}));
					$('#kousei_tbdy').append($('<tr>', {id:'kousei_tbtr'}));
					$('#kousei_tbtr').append('<td>'+data[0].shouhin_mr_cd+'</td>');
					$('#kousei_tbtr').append('<td align="right">1</td>');
					$('#kousei_tbtr').append('<td align="center">'+data[0]['shouhin_mr']['tanni_mr'+data[0].shouhin_mr.zaiko_kbn+'_name']+'</td>');
					$('#kousei_tbtr').append('<td>'+data[0].shouhin_mr.name+'</td>');
					$('#kousei_tbtr').append('<td>'+data[0].shouhin_mr.kana+'</td>');
					for ( var i = 0; i < data[0].kousei0.length; i++ ) {
						$('#kousei_tbdy').append($('<tr>', {id:'kousei_tbtr'+i}));
						var bgcolor = '';
						if (data[0].kousei0[i].gen_shouhin_mr_cd == $("#fieldShouhinMrCd").val()) {
							bgcolor = ' style="background-color: yellow;"';
						}
						$('#kousei_tbtr'+i).append('<td'+bgcolor+'>'+data[0].kousei0[i].gen_shouhin_mr_cd+'</td>');
						$('#kousei_tbtr'+i).append('<td align="right">'+data[0].kousei0[i].suuryou+'</td>');
						$('#kousei_tbtr'+i).append('<td align="center">'+data[0].kousei0[i].tanni_mr_name+'</td>');
						$('#kousei_tbtr'+i).append('<td>'+data[0].kousei0[i].gen_shouhin_mr.name+'</td>');
						$('#kousei_tbtr'+i).append('<td>'+data[0].kousei0[i].gen_shouhin_mr.kana+'</td>');
					}
				}
			},
			error: function(xhr, status, err) {
				alert('>ajax展開エラー'+status+'/'+err);
			},
		});
	}
};

$('#fieldHKishuMrCd').change(function () { //機種索引
	get_jouken(this);
});

function get_jouken(this0) {
//	alert($(this0).val()); //''の場合、'0'など1桁の場合または結果が複数の場合、結果が1個の場合、結果が0個の場合
//    if ($(this0).val() != '') {
        $.ajax({
            type: "POST",
            url: h_shouhin_jouken_mrs_ajaxGet,
            data: {'h_kishu_mr_cd': $(this0).val(), 'shouhin_mr_cd': $("#fieldShouhinMrCd").val(),},
            async: true,
            dataType: 'json',
            success: function (data) {
                if (data.length == 0) {
                    alert('>>エラー:未登録');
                    $(this0).focus().select();
                } else if (data.length == 1 || $("#fieldHKishuMrCd").val() === data[0].cd) {
                    //選択肢をクリアしてから追加する
                    $('#HKishuMrsOptions > option').remove();
                    for (var i = 0; i < data.length; i++) {
                        $('#HKishuMrsOptions').append('<option value="' + data[i].cd + '">' + data[i].cd + ':' + data[i].name + '</option>');
                    }
                    $("#fieldHKishuMrCd").val(data[0].cd);
                    $("#fieldHKishuMrName").val(data[0].name);
                    $("#fieldHKouteimeiMrCd").val(data[0].h_kouteimei_mr_cd);
                    $("#fieldHKouteimeiMrName").val(data[0].h_kouteimei_mr_name);
                    midasi_hyouji(data[0].midasi);
                    $("#fieldSakuseiUserName").val(data[0].sakusei_user_name);
                    $("#fieldCreated").val(data[0].created);
                    $("#fieldKousinUserName").val(data[0].kousin_user_name);
                    $("#fieldUpdated").val(data[0].updated);
                    $("#fieldHKishuMrCd").focus().select();
                } else {
                    //選択肢をクリアしてから追加する
                    $('#HKishuMrsOptions > option').remove();
                    for (var i = 0; i < data.length; i++) {
                        $('#HKishuMrsOptions').append('<option value="' + data[i].cd + '">' + data[i].cd + ':' + data[i].name + '</option>');
                    }
                    $("#fieldHKishuMrName").val('>>さらに選択してください。');
                    $("#fieldHKishuMrCd").focus().select();
                }
            },
            error: function (xhr, status, err) {
                alert('エラー Cd.change.ajax ' + status + '/' + err);
            },
        });
//    }
}

var argn_classes = ['','f-numb','f-numb','ime-a','f-cent'];
var ary_ids = [];
var ary_midasis = [];
function midasi_hyouji(ary_midasi) { // 見出し表示
	ary_midasis = ary_midasi; // 永久保存
	$("#koutei_jouken").empty();
	$("#koutei_jouken").append($("<div>", {id:'jouken_retu1', class:'col-sm-4'}));
	$("#koutei_jouken").append($("<div>", {id:'jouken_retu2', class:'col-sm-4'}));
	$("#koutei_jouken").append($("<div>", {id:'jouken_retu3', class:'col-sm-4'}));
	$("#kishu_jouken").empty();
	$("#kishu_jouken").append($("<div>", {id:'jouken_retu11', class:'col-sm-4'}));
	$("#kishu_jouken").append($("<div>", {id:'jouken_retu12', class:'col-sm-4'}));
	$("#kishu_jouken").append($("<div>", {id:'jouken_retu13', class:'col-sm-4'}));
	for (var i=0;i<ary_midasi.length;i++) {
		var keta=1*ary_midasi[i].seisuuketa+1*ary_midasi[i].shousuuketa+(1*ary_midasi[i].shousuuketa>0?1:0)+(1*ary_midasi[i].val_type<3?4:0);
		var argn_class=argn_classes[1*ary_midasi[i].val_type];
		$("#jouken_retu"+(ary_midasi[i].h_kouteimei_mr_cd==$("#fieldHKishuMrCd").val()?"1":"")+ary_midasi[i].retu).append(
			'<label for="fieldId'+ary_midasi[i].id+'" class="col-sm-6 control-label lbl-grn">'+ary_midasi[i].name+'</label>'
			+'<div class="col-sm-6" id="div_id_'+ary_midasi[i].id+'">'
			+'</div>'
		);
		ary_ids[ary_midasi[i].id] = i;
		if (ary_midasi[i].h_jouken_kouho_mr_cd == '') {
			$("#input_hidden").clone(true).attr('id','fieldId'+ary_midasi[i].id).removeAttr('style').appendTo('#div_id_'+ary_midasi[i].id);
			$("#fieldId"+ary_midasi[i].id).attr('name',"id_"+ary_midasi[i].id).addClass(argn_class).attr('size',keta).attr('maxlength',keta).attr('style',"width: "+(keta*10)+"px;");
			$("#fieldId"+ary_midasi[i].id).val(ary_midasi[i].jouken);
			suuti_henshuu(ary_midasi[i].id);
		} else {
			$("#select_hidden").clone(true).attr('id','fieldId'+ary_midasi[i].id).removeAttr('style').appendTo('#div_id_'+ary_midasi[i].id);
			$("#fieldId"+ary_midasi[i].id).attr('name',"id_"+ary_midasi[i].id);
			var $option = $.map(ary_midasi[i].kouho, function(name1,key1){
				return $('<option>',{value:key1,text:key1+':'+name1});
			});
			$("#fieldId"+ary_midasi[i].id).append($option);
			$("#fieldId"+ary_midasi[i].id).val(ary_midasi[i].jouken);
		}
	}
	$targetElm = $( targetElm );
}

function suuti_henshuu(jx) {
	var i = ary_ids[1*jx];
	if (ary_midasis[i].val_type == 3) {return;}
	var sh1 = 1*ary_midasis[i].shousuuketa;
	var jq_field = "#fieldId"+jx;
	$(jq_field).val(Intl.NumberFormat("ja-JP",{minimumFractionDigits:sh1, maximumFractionDigits:sh1}).format(1*$(jq_field).val().replace(/,/g,'')));
}

$('input[name^="id_"]').change(function () { //
	suuti_henshuu($(this).attr('name').substr(3));
});

$('input').change(function () { //
	$('div.alert').remove();
});
