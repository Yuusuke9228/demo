$('#fieldCd').change(function () { //得意先台帳索引
//	alert($(this).val()); //''の場合、'0'など1桁の場合または結果が複数の場合、結果が1個の場合、結果が0個の場合
    if ($(this).val() != '') {
        $.ajax({
            type: "POST",
            url: tokuisaki_mrs_ajaxGet,
            data: {'cd': $(this).val(),},
            async: true,
            dataType: 'json',
            success: function (data) {
                if (data.length >= 1 && $('#fieldCd').val() === data[0].cd) {
                    location.href = tokuisaki_mrs_edit + data[0].id;
                } else {
                    $('#fieldCd').focus().select();
                }
            },
            error: function (xhr, status, err) {
                alert('エラー Cd.change.ajax ' + status + '/' + err);
            },
        });
    }
});
/*
 * フリガナ取得 Add By Nishiyama 2019-10-23
*/
$('#fieldName').change(function () {
    var input = $(this).val();
    input = toHalfWidth(input);
    input = zenkakuToHankaku(input);
    if (input !== '') {
        $.ajax({
            type: "POST",
            url: tokuisakimrs_ajaxKana,
            data: {'input': input,},
            async: true,
            dataType: 'json',
            success: function (data) {
                $('#fieldKana').val(data['kana'].slice(0, -3)); //EOSが入るので消す
            },
            error: function (xhr, status, err) {
                alert('Error: Name.Change.Ajax ' + status + '/' + err);
            },
        });
    }
    $('#fieldRyakushou').val(make_ryakushou(input));
});

//英数全角→半角 Add By Nishiyama 2019-10-23
function toHalfWidth(elm) {
    return elm.replace(/[Ａ-Ｚａ-ｚ０-９！-～]/g, function (s) {
        return String.fromCharCode(s.charCodeAt(0) - 0xFEE0);
    });
}

//カナ全角→半角 Add By Nishiyama 2019-10-23
function zenkakuToHankaku(mae) {
    let zen = ['ア', 'イ', 'ウ', 'エ', 'オ', 'カ', 'キ', 'ク', 'ケ', 'コ'
        , 'サ', 'シ', 'ス', 'セ', 'ソ', 'タ', 'チ', 'ツ', 'テ', 'ト'
        , 'ナ', 'ニ', 'ヌ', 'ネ', 'ノ', 'ハ', 'ヒ', 'フ', 'ヘ', 'ホ'
        , 'マ', 'ミ', 'ム', 'メ', 'モ', 'ヤ', 'ヰ', 'ユ', 'ヱ', 'ヨ'
        , 'ラ', 'リ', 'ル', 'レ', 'ロ', 'ワ', 'ヲ', 'ン'
        , 'ガ', 'ギ', 'グ', 'ゲ', 'ゴ', 'ザ', 'ジ', 'ズ', 'ゼ', 'ゾ'
        , 'ダ', 'ヂ', 'ヅ', 'デ', 'ド', 'バ', 'ビ', 'ブ', 'ベ', 'ボ'
        , 'パ', 'ピ', 'プ', 'ペ', 'ポ'
        , 'ァ', 'ィ', 'ゥ', 'ェ', 'ォ', 'ャ', 'ュ', 'ョ', 'ッ'
        , '゛', '°', '、', '。', '「', '」', 'ー', '・'];
    let han = ['ｱ', 'ｲ', 'ｳ', 'ｴ', 'ｵ', 'ｶ', 'ｷ', 'ｸ', 'ｹ', 'ｺ'
        , 'ｻ', 'ｼ', 'ｽ', 'ｾ', 'ｿ', 'ﾀ', 'ﾁ', 'ﾂ', 'ﾃ', 'ﾄ'
        , 'ﾅ', 'ﾆ', 'ﾇ', 'ﾈ', 'ﾉ', 'ﾊ', 'ﾋ', 'ﾌ', 'ﾍ', 'ﾎ'
        , 'ﾏ', 'ﾐ', 'ﾑ', 'ﾒ', 'ﾓ', 'ﾔ', 'ｲ', 'ﾕ', 'ｴ', 'ﾖ'
        , 'ﾗ', 'ﾘ', 'ﾙ', 'ﾚ', 'ﾛ', 'ﾜ', 'ｦ', 'ﾝ'
        , 'ｶﾞ', 'ｷﾞ', 'ｸﾞ', 'ｹﾞ', 'ｺﾞ', 'ｻﾞ', 'ｼﾞ', 'ｽﾞ', 'ｾﾞ', 'ｿﾞ'
        , 'ﾀﾞ', 'ﾁﾞ', 'ﾂﾞ', 'ﾃﾞ', 'ﾄﾞ', 'ﾊﾞ', 'ﾋﾞ', 'ﾌﾞ', 'ﾍﾞ', 'ﾎﾞ'
        , 'ﾊﾟ', 'ﾋﾟ', 'ﾌﾟ', 'ﾍﾟ', 'ﾎﾟ'
        , 'ｧ', 'ｨ', 'ｩ', 'ｪ', 'ｫ', 'ｬ', 'ｭ', 'ｮ', 'ｯ'
        , 'ﾞ', 'ﾟ', '､', '｡', '｢', '｣', 'ｰ', '･'];
    let ato = "";
    for (let i = 0; i < mae.length; i++) {
        let maechar = mae.charAt(i);
        let zenindex = zen.indexOf(maechar);
        if (zenindex >= 0) {
            maechar = han[zenindex];
        }
        ato += maechar;
    }
    return ato;
}

/*
 * 略称を作成 Add By Nishiyama 2019/10/23
 */
function make_ryakushou(input) {
    if (input.indexOf('') !== -1) {
        replaced = input.replace(/株式会社/g, '(株)');
    } else if (input.indexOf('') !== -1) {
        replaced = input.replace(/有限会社/g, '(有)');
    } else {
        replaced = input;	//そのまま返却
    }
    return replaced.slice(0, 23);
}

$('#fieldShiiresakiMrCd').change(function () { //仕入先台帳索引
//	alert($(this).val()); //''の場合、'0'など1桁の場合または結果が複数の場合、結果が1個の場合、結果が0個の場合
    if ($(this).val() != '') {
        $.ajax({
            type: "POST",
            url: shiiresaki_mrs_ajaxGet,
            data: {'cd': $(this).val(),},
            async: true,
            dataType: 'json',
            success: function (data) {
                if (data.length == 0) {
                    $("#fieldShiiresakiMrName").val('>>エラー:未登録');
                    $("#fieldShiiresakiMrCd").focus().select();
                } else if (data.length == 1 || $("#fieldShiiresakiMrCd").val() === data[0].cd) {
                    $('#ShiiresakiMrsOptions > option').remove();
                    for (var i = 0; i < data.length; i++) {
                        $('#ShiiresakiMrsOptions').append('<option value="' + data[i].cd + '">' + data[i].cd + ':' + data[i].name + '</option>');
                    }
                    $("#fieldShiiresakiMrCd").val(data[0].cd);
                    $("#fieldShiiresakiMrName").val(data[0].name);
                } else {
                    //選択肢をクリアしてから追加する
                    $('#ShiiresakiMrsOptions > option').remove();
                    for (var i = 0; i < data.length; i++) {
                        $('#ShiiresakiMrsOptions').append('<option value="' + data[i].cd + '">' + data[i].cd + ':' + data[i].name + '</option>');
                    }
                    $("#fieldShiiresakiMrName").val('>>エラー:未登録');
                    $("#fieldShiiresakiMrCd").focus().select();
                }
            },
            error: function (xhr, status, err) {
                alert('エラー Shiiresaki.ajax ' + status + '/' + err);
            },
        });
    }
});

/* モーダルダイヤログ部分 */
function f8key() {
    if (lastfocusin == "fieldCd") { /* 得意先コード選択 */
        modalstart(tokuisaki_mrs_modal, "得意先選択");
    } else if (lastfocusin == "fieldShiiresakiMrCd") { /* 仕入先コード選択 */
        modalstart(shiiresaki_mrs_modal, "仕入先選択");
    }
}

function modalstart(url, title) {
    $('#iframe-title').text(title);
    $('#iframe-wrap').fadeIn();
    $('#iframe-body').html('<iframe src="' + url + '?cd=' + $('#' + lastfocusin).val() + '" width="100%" height="100%" style="border: none;">');
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
        function () {//alert("フェードアウト完了")
            if (retval) {
                $('#' + lastfocusin).val(retval);
                $('#' + lastfocusin).change();
            }
        }
    );
    $('#iframe-bg').fadeOut();
    $('#' + lastfocusin).focus().select();
}

$(function () { // モーダルウィンドウをドラッグで移動できる
    $("#iframe-wrap").draggable({
        handle: ".modal-header"
    });
});
