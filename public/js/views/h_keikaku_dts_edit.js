// *****************************************************************
// title:生産計画登録画面
// creater:井浦
// created:2020/01/13
// note:画面表示内容や計算や更新は極力ajaxでcontrollerに渡して行う。
// *****************************************************************

// =================================================================
// 画面特有の定数
// -----------------------------------------------------------------
var idmeisaif = 'fieldHKeikakuMeisaiDts';
var jqmeisaif = '#' + idmeisaif;
var idmeisaix = 'xdisp' + idmeisaif.substr(5);
var meisai_hd = 'h_keikaku_meisai_dts';
var meisai_hd_length = meisai_hd.length;
var tr_meisai_hd = 'tr_' + meisai_hd + '_';
var tr_meisai_jq = '#' + tr_meisai_hd;

// =================================================================
// 画面のデータの配列
// -----------------------------------------------------------------
var g1 = {}; // 連想配列：画面全体の項目：phpのcontrollerとajaxでヤリトリして共通の格納領域とする。
var m1 = {}; // 明細1行分の画面項目、g1の子テーブルの明細に追加する用。
var ro_fields = []; // 項目制御の項目列記
var grpNOW = '';
var g1n = {}; // カンマ編集数値項目を指定。
var m1n = {}; // カンマ編集数値項目を指定。
var g1f = {}; // name別fieldid。
var m1f = {}; // 明細のname別fieldidの後半。
var g1d = {}; // name別dispid。
var m1d = {}; // 明細のname別dispidカンマ編集数値項目を指定。

// =================================================================
// カンマ編集数値項目の少数桁を指定
// -----------------------------------------------------------------
g1n['genzaiko'] = 2;
g1n['ararieki'] = 0;
g1n['arariekiritu'] = 1;
g1n['zeinukigaku'] = 0;
g1n['shouhizeigaku'] = 0;
g1n['goukeigaku'] = 0;
m1n['suuryou'] = 2;
m1n['keisu'] = 2;
m1n['moto_juch_ryou'] = 2;
m1n['hituyou_ryou'] = 2; // 後で変更
m1n['zaikoseisan_ryou'] = 2;
m1n['loss_ryou'] = 2;
m1n['deme_ryou'] = 2;
m1n['zaikosiyou_ryou'] = 2;
m1n['keikaku_ryou'] = 2; // 後で変更

// =================================================================
$("[id^='field']").each(function (index, element) { // g1連想配列生成
// -----------------------------------------------------------------
    var name1 = $(element).attr('name');
    if (name1.slice(0, 7) != 'hidden[') {
        g1[name1] = '';
        g1f[name1] = $(this).attr('id');
        ro_fields += name1;
    }
});

// =================================================================
$("[id^='disp']").each(function (index, element) { // g1連想配列生成
// -----------------------------------------------------------------
    var name1 = $(element).attr('name');
    if (name1.slice(0, 6) != 'field0') {
        g1[name1] = '';
        g1d[name1] = $(this).attr('id');
    }
});

// =================================================================
$(tr_meisai_jq + "hidden").find("[id^='field0hidden']").each(function (index, element) { // 明細配列生成
// -----------------------------------------------------------------
    var name1 = $(element).attr('name'); // hidden[cd]
    var name2 = name1.substr(6);
    var index1 = $(element).attr('id'); // field0hidden...
    var index2 = index1.substr(12);
    var name3 = name2.slice(1, -1);
    m1[name3] = '';
    m1f[name3] = index2;
    ro_fields += '[' + name3; // 閉じ角カッコはajaxで渡すときに欠落するので初めから入れない。
});

// =================================================================
$(tr_meisai_jq + "hidden").find("[id^='disp0hidden']").each(function (index, element) { // 明細配列生成
// -----------------------------------------------------------------
    var name1 = $(element).attr('name'); // hidden[kousei]
    var name2 = name1.substr(6);
    var index1 = $(element).attr('id'); // disp0hidden...
    var index2 = index1.substr(11);
    var name3 = name2.slice(1, -1);
    m1[name3] = '';
    m1d[name3] = index2;
});

// =================================================================
// 非表示変数
// -----------------------------------------------------------------
g1['denpyou_mr_id'] = denpyou_mr_id;
g1['keikaku_dt_id'] = '';
g1['hacchuu_dt_id'] = ''; // 発注と紐づける為、追加
g1['id'] = ''; // dbテーブルのidキー
g1['skbn'] = '0'; // 処理区分:'0'=照会,'1'=新規,'2'=修正,'9'=削除
g1['on_row'] = 0;
g1['imax'] = 0;
g1[meisai_hd] = [];

// =================================================================
// 非表示変数
// -----------------------------------------------------------------
m1['id'] = '';
m1['updated'] = '';
m1['kaisou'] = '';
m1['suu_shousuu'] = '';
m1['zaiko_kbn'] = '';
m1['tanni_mr1_cd'] = '';
m1['tanni_mr2_cd'] = '';
m1['zaiko_tanni'] = '';
m1['kadou_nissuu'] = '';
m1['h_kishu_mr_irowake'] = '';
m1['h_calendar_patan_dt_cd'] = '';

// *****************************************************************
function addMeisaiDt() { // alert(g1.imax); // 明細1行追加
// *----------------------------------------------------------------
    try {
        g1.imax = 1 * g1.imax; // 整数化
        var tr_jq = tr_meisai_jq + g1.imax;
        var id_head = idmeisaif + g1.imax;
        var id_xdisp = idmeisaix + g1.imax;
        var id_disp = id_xdisp.slice(1);
        var name_head = 'data[' + meisai_hd + '][' + g1.imax + ']';
        $(tr_meisai_jq + "hidden").clone(true).attr('id', tr_meisai_hd + g1.imax).removeAttr('style').insertAfter(tr_meisai_jq + ((g1.imax > 0) ? g1.imax - 1 : 'hidden')).addClass("tr_meisai");
        for (var key in m1f) {
            $(tr_jq + " #field0hidden" + m1f[key]).attr('id', id_head + m1f[key]).attr('name', name_head + "[" + key + "]"); // 入力域を構成
            $(tr_jq + " #xdisp0hidden" + m1f[key]).attr('id', id_xdisp + m1f[key]); // 表示域を構成
        }
        for (var key in m1d) {
            $(tr_jq + " #disp0hidden" + m1d[key]).attr('id', id_disp + m1d[key]).attr('name', name_head + "[" + key + "]"); // 表示域を構成
        }
        if (!g1[meisai_hd][g1.imax]) g1[meisai_hd][g1.imax] = Object.create(m1); // 要注意
        g1[meisai_hd][g1.imax]['cd'] = g1.imax + 1;
        $("#" + id_head + 'Cd').val(g1.imax + 1);
        $("#" + id_xdisp + 'Cd').text(g1.imax + 1);
        // $("#"+id_head+'Id').val(0);
        g1.imax++; //alert($("#"+id_head+'Id').val());
        $targetElm = $(targetElm);
    } catch (error) {
        alert("エラー1内容：" + error);
    }
}

var audio = new Audio(this_url_base + 'js/views/beep.mp3');

// *****************************************************************
window.onload = function () {
// *----------------------------------------------------------------
    try {
        tbl_new_width = 0;
        $('#meisaiTable thead tr th').each(function (i) {
            tbl_new_width += 1 + $(this).width();
        });
        $('#meisaiTable').css({width: tbl_new_width + 'px'});
        addMeisaiDt();
        grp_READ('HEAD');
        if ($('#id').val()) {
            g1.id = $('#id').val();
            ajaxAnyDo('id', 'ANSWER'); // 編集モード
        }
    } catch (error) {
        alert("エラー2内容：" + error);
    }
}

// *****************************************************************
function p2c_grpNOW() { // モーダルウインドウから実行する関数（現在入力グループ名を返す）
// *----------------------------------------------------------------
    return grpNOW;
}

// *****************************************************************
function p2c_g1() { // モーダルウインドウから実行する関数（共通の格納領域を返す）
// *----------------------------------------------------------------
    return g1;
}

// *****************************************************************
function c2p_g1(c_g1) { // モーダルウインドウから実行する関数（共通の格納領域を戻す）
// *----------------------------------------------------------------
    g1 = c_g1;
    g1_to_GAMEN();
}

// *****************************************************************
function grp_READ(grp) { // 指定グループを入力モードにする。
// *----------------------------------------------------------------
    try {
        if (grp) {
            grpNOW = grp;
        }
        grp_read_ctl(); // 現在グループの表示と非表示を設定する。
        if ($("input." + grpNOW + ',select.' + grpNOW).length > 0) {
            $("input." + grpNOW + ',select.' + grpNOW)[0].focus(); // 最初の項目を選択する。
            $("input." + grpNOW + ',select.' + grpNOW)[0].select(); // 前行とつなげると変になるので、面倒でも分けた。
        } else {
            $('#F12').focus();
        }
    } catch (error) {
        alert("エラー3内容：" + error);
    }
}

// *****************************************************************
function grp_read_ctl() { // 現在グループの表示と非表示を設定する。
// *----------------------------------------------------------------
    try {
        $('.fALLF').prop('disabled', true); // ファンクションキー制御
        $('.f' + grpNOW).prop('disabled', false);
        $('input.ALLF,select.ALLF').not('.' + grpNOW).css('display', 'none'); // インプット制御
        $('div.xALLF').not('.x' + grpNOW).css('display', 'BLOCK'); // 表示域制御
        $('input.' + grpNOW).css('display', 'inline');
        $('select.' + grpNOW).css('display', 'BLOCK');
        $('div.x' + grpNOW).css('display', 'none');
    } catch (error) {
        alert("エラー4内容：" + error);
    }
}

// *****************************************************************
$('#ESC').click(function () {
// *----------------------------------------------------------------
    CANCEL();
});

// *****************************************************************
function ENTER() { // F12(アクション)で各グループ別に処理を始める入口
// *----------------------------------------------------------------
    try {
        if (lastfocusin != 'F12' &&
            $('#' + lastfocusin).val() !== $('#xdisp' + lastfocusin.substr(5)).text()) { // 入力途中でENTERされたらchange処理だけする。
            $('#' + lastfocusin).change();
            return;
        }
        g1.errflg = 0; // 0=エラーなし、1=エラーあり、2=ワーニング又はメッセージ,-1=エラーなしajaxスキップ
        g1.emsg = '';
        g1.errfld = '';
        window[grpNOW + '_CHECK'](); // 単純チェック [].内の名前の関数を実行する。例：grpNOWが'HEAD'なら、HEAD_CHECK()が実行される。
        if (g1.errflg == 1) {
            ANSWER();
        } else {
            if (g1.errflg == -1) {
                ANSWER();
            } else if (grpNOW == 'HEAD') {
                ajaxAnyDo(grpNOW + '_CHECK', 'shouhin_juchuu'); // 複雑チェック、マスターチェック等
            } else {
                ajaxAnyDo(grpNOW + '_CHECK', 'ANSWER'); // 複雑チェック、マスターチェック等
            }
        }
    } catch (error) {
        alert("エラー5内容：" + error);
    }
}

// *****************************************************************
function ANSWER() { // 各グループチェックやajaxチェックの結果の処理、正常なら処理と次の入力グループを指定する。
// *----------------------------------------------------------------
    try {
        $('#dispEmsg').text(g1.emsg).removeClass(); // エラーメッセージ表示
        if (g1.errflg == 1) {
            if ($('#dispEmsg').text() != '') $('#dispEmsg').addClass('alert alert-danger');
            audio.play();
            grp_READ(); // 現在グループにカーソル設定
            if (g1.errfld) {	// エラー項目を指定してあればカーソルをそこに設定
                $('#field' + g1.errfld).focus().select();
            } //	grp_READ();に戻る
        } else {
            if ($('#dispEmsg').text() != '') $('#dispEmsg').addClass('alert alert-' + (g1.errflg == 2 ? 'warning' : 'info'));
            switch (grpNOW) {
                case "HEAD":
                    switch (g1.skbn) {
                        case '1':
                            grp_READ('BODY');
                            break;
                        default: // '0'だけのはず
                            grp_READ('TAIL'); // 修正しますか？
                            break;
                    }
                    break;
                case "BODY":
                    grp_READ('TAIL'); // 登録しますか？
                    break;
                case "TAIL":
                    switch (g1.skbn) {
                        case '0': // 修正しますか？の結果、修正へ
                            g1.skbn = '2'; // 修正状態
                            grp_READ('BODY');
                            $("[id$='Hiduke']").scrollLeft(100);
                            break;
                        case '1': // or
                        case '2': // セーブ処理は終わっている
                            grp_READ('HEAD');
                            break;
                        default: // 他はない
                            grp_READ('HEAD');
                            break;
                    }
                    break;
            }
        }
    } catch (error) {
        alert("エラー6内容：" + error);
    }
}

// *****************************************************************
function CANCEL() {
// *----------------------------------------------------------------
    try {
        $('#dispEmsg').text("");
        switch (grpNOW) {
            case "HEAD": // 画面クリアしたい
                g1[meisai_hd] = [];
                $('.tr_meisai').remove();
                g1.imax = 0;
                addMeisaiDt();

                $("[id^='field']").each(function (index, element) { // g1連想配列生成
                    var name1 = $(element).attr('name');
                    var id1 = $(element).attr('id');
                    if (name1.slice(0, 7) != 'hidden[') {
                        g1[name1] = '';
                        $(element).val('');
                        $('#xdisp' + id1.substr(5)).text('');
                    }
                });

                $("[id^='disp']").each(function (index, element) { // g1連想配列生成
                    var name1 = $(element).attr('name');
                    if (name1.slice(0, 6) != 'field0') {
                        g1[name1] = '';
                        $(element).text('');
                    }
                });
                jsgant(true); // ガントチャート表示
                $('#juchuu').empty(); // 受注クリア

                g1.skbn = 0;
                grp_READ('HEAD');
                break;
            case "BODY":
                grp_READ('HEAD');
                g1.skbn = 0;
                break;
            case "TAIL":
                switch (g1.skbn) {
                    case '0': // 修正しますか？の途中
                        grp_READ('HEAD');
                        break;
                    case '1': // or
                    case '2': // 登録確認の途中
                        grp_READ('BODY');
                        $("[id$='Hiduke']").scrollLeft(100);
                        break;
                }
                break;
        }
    } catch (error) {
        alert("エラー7内容：" + error);
    }
}

// *****************************************************************
function NEXT() {
// *----------------------------------------------------------------
    try {
        g1.errflg = 0;
        g1.emsg = '';
        g1.errfld = '';
        switch (grpNOW) {
            case "HEAD":
                break;
            case "BODY":
                break;
            case "TAIL":
                switch (g1.skbn) {
                    case '0': // 修正しますか？の途中
                        g1[meisai_hd] = [];
                        $('.tr_meisai').remove();
                        g1.imax = 0;
                        addMeisaiDt();
                        ajaxAnyDo('TAIL_NEXT', 'shouhin_juchuu');
                        break; // TAILのまま
                }
                break;
        }
    } catch (error) {
        alert("エラー8内容：" + error);
    }
}

// *****************************************************************
function BACK() {
// *----------------------------------------------------------------
    try {
        g1.errflg = 0;
        g1.emsg = '';
        g1.errfld = '';
        switch (grpNOW) {
            case "HEAD":
                ajaxAnyDo('HEAD_BACK', 'shouhin_juchuu');
                grp_READ('TAIL');
                break;
            case "BODY":
                break;
            case "TAIL":
                switch (g1.skbn) {
                    case '0': // 修正しますか？の途中
                        g1[meisai_hd] = [];
                        $('.tr_meisai').remove();
                        g1.imax = 0;
                        addMeisaiDt();
                        ajaxAnyDo('TAIL_BACK', 'shouhin_juchuu');
                        break; // TAILのまま
                }
                break;
        }
    } catch (error) {
        alert("エラー9内容：" + error);
    }
}

// *****************************************************************
function TENKAI(tan = 0) { // 展開、tan=1:単展開、tan=0:全展開
// *----------------------------------------------------------------
    try {
        g1.errflg = 0;
        g1.emsg = '';
        g1.errfld = '';
        switch (grpNOW) { // ボディのみ
            case "BODY":
                var ary_name1 = $('#' + lastfocusin).prop('name').split('[');
                var name2 = ary_name1[2].slice(0, -1);
                g1.on_row = 1 * name2; // 現在行を設定
                ajaxAnyDo(tan == 1 ? 'TAN_TENKAI' : 'ZEN_TENKAI'); // ajax呼出,callback無し
                break;
        }
    } catch (error) {
        alert("エラー9A内容：" + error);
    }
}

// *****************************************************************
function GRPinput2span(grp) { // (省略時=現在)グループの<input>データを表示用<span>データに複写する。
// *----------------------------------------------------------------
    try {
        if (!grp) {
            grp = grpNOW;
        }
        formGRP[grp].forEach(function (fldName) {
            if ($('#field' + fldName).length) {
                $('#disp' + fldName).text($.htmlspecialchars($('#field' + fldName).val()));
            }
        });
    } catch (error) {
        alert("エラー10内容：" + error);
    }
}

// *****************************************************************
String.prototype.rtrim = function () { // 右空白削除
// *----------------------------------------------------------------
    return this.replace(/\s+$/, "");
}

// *****************************************************************
$("[id^='field']").change(function () { // 項目入力したら編集してg1配列に格納する
// *----------------------------------------------------------------
    try {
        var type1 = $(this).attr('type');
        if (type1 == 'tel') $(this).blur(); // 日付項目なら編集を先にする。
        var name1 = $(this).attr('name');
        var temp1 = $(this).val().rtrim();
        if (name1.slice(5, 5 + meisai_hd_length) == meisai_hd) { // data[h_keikaku_meisai_dts][0][cd]
            var ary_name1 = name1.split('[');
            var name2 = ary_name1[2].slice(0, -1);
            var name3 = ary_name1[3].slice(0, -1);
            if (name3 in m1n) {
                var keta = m1n[name3];
                if (name3 == 'suuryou' ||
                    name3 == 'hituyou_ryou' ||
                    name3 == 'moto_juch_ryou' ||
                    name3 == 'zaikoseisan_ryou' ||
                    name3 == 'rosu_ryou' ||
                    name3 == 'deme_ryou' ||
                    name3 == 'zaikosiyou_ryou' ||
                    name3 == 'keikaku_ryou') {
                    keta = g1[meisai_hd][1 * name2]['suu_shousuu'];
                }
                temp1 = temp1.replace(/,/g, '');
                temp1 = Intl.NumberFormat("ja-JP", {
                    minimumFractionDigits: keta,
                    maximumFractionDigits: keta
                }).format(temp1); //カンマ編集
                $(this).val(temp1);
                g1[meisai_hd][1 * name2][name3] = temp1.replace(/,/g, '');
            } else {
                g1[meisai_hd][1 * name2][name3] = temp1;
            }
            if ($(this).prop('tagName') == 'SELECT') {
                var temp2 = $('option:selected', this).text();
                $("#xdisp" + jqmeisaif.slice(6) + name2 + m1f[name3]).text(temp2);
            } else if (type1 == 'tel') {
                $("#xdisp" + jqmeisaif.slice(6) + name2 + m1f[name3]).text(temp1.slice(-5));
            } else {
                $("#xdisp" + jqmeisaif.slice(6) + name2 + m1f[name3]).text(temp1);
            }
//バグ？		$("#xdisp"+jqmeisaif.slice(6)+name2+m1f[name3]).text(temp1);
            var name4 = '[' + name3 + ']';
            g1.on_row = 1 * name2;
            switch (name4) {
                case "[shouhin_mr_cd]": // 商品コードなら
                    ajaxAnyDo(name4, 'shouhin_CALLBACK'); // 即、商品取得する。
                    break;
                case "[h_kishu_mr_cd]": // 機種コードなら
                    ajaxAnyDo(name4, 'error_CALLBACK'); // 即
                    break;
                case "[oya_meisai_cd]": // 親行なら
                case "[keisu]": // 係数なら
                case "[moto_juch_ryou]": // 受注量なら
                case "[zaikoseisan_ryou]": // 備蓄生産量なら
                case "[loss_ryou]": // ロス量なら
                case "[deme_ryou]": // 出目量なら
                case "[zaikosiyou_ryou]": // 備蓄使用量なら
                case "[kouritu]": // 効率なら
                case "[heiretu_suu]": // 錘数なら
                    if ($(`#field${name2}hiddenKaisiHiduke`).val() != null) {
                        ajaxAnyDo(name4, 'error_CALLBACK'); // 即
                        break;
                    }

                case "[kaisi_hiduke]": // 開始日なら
                case "[shuuryou_hiduke]": // 終了日なら
                    // 試作などを手入力させるため
                    if ($(`#fieldHKeikakuMeisaiDts${name2}Kouritu`).val() !== '') {
                        ajaxAnyDo(name4, 'error_CALLBACK'); // 即
                    } else {
                        g1.errflg = 0;
                    }
                    break;

            }
        } else { // 通常(明細でない）ならこちら
            if (name1 in g1n) {
                temp1 = temp1.replace(/,/g, '');
                temp1 = Intl.NumberFormat("ja-JP", {
                    minimumFractionDigits: g1n[name1],
                    maximumFractionDigits: g1n[name1]
                }).format(temp1); //カンマ編集
                $(this).val(temp1);
                g1[name1] = temp1.replace(/,/g, '');
            } else {
                g1[name1] = temp1;
            }
            if ($(this).prop('tagName') == 'SELECT') {
                var temp2 = $('option:selected', this).text();
                $("#xdisp" + g1f[name1].slice(5)).text(temp2);
            } else {
                $("#xdisp" + g1f[name1].slice(5)).text(temp1);
            }
            switch (name1) {
                case "cd": // 伝票番号なら
                    ENTER(); // 即チェックする。
                    break;
                case "tokuisaki_mr_cd": // 得意先コードなら
                case "nounyuusaki_mr_cd": // 納入先コードなら
                case "kidukesaki_mr_cd": // 気付先コードなら
                    ajaxAnyDo(name1, 'error_CALLBACK'); // 即、気付先取得する。
                    break;
            }
        }
    } catch (error) {
        alert("エラー11内容：" + error);
    }
});

// *****************************************************************
function error_CALLBACK() { // ajaxのエラー後処理
// *----------------------------------------------------------------
    if (g1.errflg == 1) {
        ANSWER();
    }
}

// *****************************************************************
function shouhin_CALLBACK() { // ajaxの行後処理
// *----------------------------------------------------------------
    if (g1.errflg == 1) {
        ANSWER();
    } else {
        if (1 * g1.on_row == 0) shouhin_juchuu(g1.on_row);
        if (1 * g1.on_row + 1 >= 1 * g1.imax) addMeisaiDt();
    }
}

// *****************************************************************
function shouhin_juchuu(row = 0) { // ajaxで受注情報表示
// *----------------------------------------------------------------
    $.ajax({
        url: this_url_base + 'g_juchuu_dts/modal',    // 表示させたいコンテンツがあるページURL
        data: {
            shouhin_mr_cd: g1[meisai_hd][row]['shouhin_mr_cd'],
        },
        cache: false,
        datatype: 'html',
        success: function (html) {
            var h = $(html).find('#tbl1');    // 表示させたいコンテンツの要素を指定
            $('#juchuu').empty();
            $('#juchuu').append(h);    // append関数で指定先の要素へ出力
        }
    });
}

// *****************************************************************
function name_to_row(name1) { // nameから行を得る
// *----------------------------------------------------------------
    var ary_name1 = name1.split('[');
    return 1 * (ary_name1[2].slice(0, -1));
}

// *****************************************************************
$('#fieldTokuisakiMrCd').focusout(function () { /* 得意先コード選択 */
// *----------------------------------------------------------------
    if (!$('#fieldTokuisakiMrCd').val()) {
        modalstart(this_url_base + "tokuisaki_mrs/modal", "得意先選択");
        setTimeout(function () {
            lastfocusin = "fieldTokuisakiMrCd";
        }, 1000); // 1秒後フォーカス設定し直し
    }
});

// *****************************************************************
function HEAD_CHECK() {
// *----------------------------------------------------------------
    try {
        switch (1 * g1.cd) { // 伝票番号あるか？
            case 0: // 伝票番号無しなら新規BODY入力へ
                g1.skbn = '1';
                g1.id = '';
                g1.errflg = -1; // ajaxAnyDo不要
                if (!$('#fieldHakkoubi').val()) {
                    var dt = new Date();
                    var y = dt.getFullYear();
                    var m = ("00" + (dt.getMonth() + 1)).slice(-2);
                    var d = ("00" + dt.getDate()).slice(-2);
                    g1.hakkoubi = y + "-" + m + "-" + d;
                    $('#fieldHakkoubi').val(g1.hakkoubi);
                    $('#xdispHakkoubi').val(g1.hakkoubi);
                }
                break;
            default: // 伝票番号ありならajaxAnyDoで読込みへ
                $('.tr_meisai').remove();
                g1.imax = 0;
                addMeisaiDt();
                g1[meisai_hd] = [];
                g1.skbn = '0'; // 修正か表示か未定
                g1.emsg = "修正しますか？(Yes)=[ENTER]or[F12],(No)=[ESC]";
                break;
        }
    } catch (error) {
        alert("エラー13内容：" + error);
    }
}

// *****************************************************************
function BODY_CHECK() {
// *----------------------------------------------------------------
    try {
        g1.emsg = "更新します。確認してください。"; // 本当はajaxで入れる
    } catch (error) {
        alert("エラー14内容：" + error);
    }
}

// *****************************************************************
function TAIL_CHECK() {
// *----------------------------------------------------------------
    try {
        switch (g1.skbn) {
            case '0': // 伝票修正か確認中
                g1.errflg = -1; // ajax不要
                g1.emsg = "";
                break;
            case '1': // 伝票新規 or
            case '2': // 伝票修正の登録か確認中
                break;
            default: // 伝票修正か確認中
                break;
        }
    } catch (error) {
        alert("エラー15内容：" + error);
    }
}

// *****************************************************************
function g1_to_GAMEN() { // 画面へデータを表示する。
// *----------------------------------------------------------------
    try {
        for (var key in g1f) {
            $("#" + g1f[key]).val(g1[key]); // 入力用へ代入
            $("#xdisp" + g1f[key].slice(5)).text(g1[key]); // 裏表示用へ代入
            if ($("#" + g1f[key]).prop('tagName') == 'SELECT') {
                var temp2 = $("#" + g1f[key] + ' option:selected').text();
                $("#xdisp" + g1f[key].slice(5)).text(temp2);
            } else if ($("#" + g1f[key]).attr('type') == 'tel' && g1[key] == '0000-00-00') {
                $("#xdisp" + g1f[key].slice(5)).text(''); // 裏表示用へ代入
                $("#" + g1f[key]).val(''); // 入力用へ代入
            } else {
                $("#xdisp" + g1f[key].slice(5)).text(g1[key]); // 裏表示用へ代入
            }
        }
        for (var key in g1d) {
            if (key in g1n) {
                var temp1 = '';
                if (1 * g1[key] != 0) {
                    temp1 = Intl.NumberFormat("ja-JP", {
                        minimumFractionDigits: g1n[key],
                        maximumFractionDigits: g1n[key]
                    }).format(g1[key]); //カンマ編集
                }
                $("#" + g1d[key]).text(temp1); // 表示用へ代入
            } else {
                $("#" + g1d[key]).text(g1[key]); // 表示用へ代入
            }
        }
        if (!g1[meisai_hd]) g1[meisai_hd] = [];
        for (var key1 in g1[meisai_hd]) {
            if (1 * key1 >= g1.imax) addMeisaiDt();
            for (var key2 in m1f) {
                if (key2 in m1n) {
                    var keta = m1n[key2];
                    if (key2 == 'suuryou' ||
                        key2 == 'hituyou_ryou' ||
                        key2 == 'moto_juch_ryou' ||
                        key2 == 'zaikoseisan_ryou' ||
                        key2 == 'rosu_ryou' ||
                        key2 == 'deme_ryou' ||
                        key2 == 'zaikosiyou_ryou' ||
                        key2 == 'keikaku_ryou') {
                        keta = g1[meisai_hd][1 * 1 * key1]['suu_shousuu'];
                    }
                    // コードが鬱陶しいので強制で飛ばす
                    if (key2 === 'moto_juch_ryou') continue;

                    var temp1 = '';
                    if (1 * g1[meisai_hd][1 * key1][key2] != 0) {
                        temp1 = Intl.NumberFormat("ja-JP", {
                            minimumFractionDigits: keta,
                            maximumFractionDigits: keta
                        }).format(g1[meisai_hd][1 * key1][key2]); //カンマ編集
                    }
                    $(jqmeisaif + key1 + m1f[key2]).val(temp1); // 入力用へ代入
                    $("#xdisp" + jqmeisaif.slice(6) + key1 + m1f[key2]).text(temp1); // 裏表示用へ代入
                } else {
                    if (key2 == 'zaiko_kbn') {
                        var zaiko_kbn = $(jqmeisaif + key1 + m1f[key2]);
                        zaiko_kbn.children().remove();
                        zaiko_kbn.append($("<option>").val('1').text('/' + $(jqmeisaif + key1 + m1f['tanni_mr1_cd'] + ' option:selected').text()));
                        zaiko_kbn.append($("<option>").val('2').text('/' + $(jqmeisaif + key1 + m1f['tanni_mr2_cd'] + ' option:selected').text()));
                    }
                    $(jqmeisaif + key1 + m1f[key2]).val(g1[meisai_hd][1 * key1][key2]); // 入力用へ代入
                    if ($(jqmeisaif + key1 + m1f[key2]).prop('tagName') == 'SELECT') {
                        var temp2 = $(jqmeisaif + key1 + m1f[key2] + ' option:selected').text();
                        $("#xdisp" + jqmeisaif.slice(6) + key1 + m1f[key2]).text(temp2);
                    } else if ($(jqmeisaif + key1 + m1f[key2]).attr('type') == 'tel') {
                        if (g1[meisai_hd][1 * key1][key2] == '0000-00-00') {
                            $("#xdisp" + jqmeisaif.slice(6) + key1 + m1f[key2]).text(''); // 裏表示用へ代入
                            $(jqmeisaif + key1 + m1f[key2]).val(''); // 入力用へ代入
                        } else {
                            $("#xdisp" + jqmeisaif.slice(6) + key1 + m1f[key2]).text(g1[meisai_hd][1 * key1][key2].slice(-5)); // 月日のみ
                        }
                    } else {
                        $("#xdisp" + jqmeisaif.slice(6) + key1 + m1f[key2]).text(g1[meisai_hd][1 * key1][key2]); // 裏表示用へ代入
                    }

                }
            }
            for (var key2 in m1d) {
                if (key2 in m1n) {
                    var keta = m1n[key2];
                    if (key2 == 'suuryou' ||
                        key2 == 'hituyou_ryou' ||
                        key2 == 'moto_juch_ryou' ||
                        key2 == 'zaikoseisan_ryou' ||
                        key2 == 'rosu_ryou' ||
                        key2 == 'deme_ryou' ||
                        key2 == 'zaikosiyou_ryou' ||
                        key2 == 'keikaku_ryou') {
                        keta = g1[meisai_hd][1 * 1 * key1]['suu_shousuu'];
                    }
                    var temp1 = '';
                    if (1 * g1[meisai_hd][1 * key1][key2] != 0) {
                        temp1 = Intl.NumberFormat("ja-JP", {
                            minimumFractionDigits: keta,
                            maximumFractionDigits: keta
                        }).format(g1[meisai_hd][1 * key1][key2]); //カンマ編集
                    }
                    $("#disp" + jqmeisaif.slice(6) + key1 + m1d[key2]).text(temp1); // 表示用へ代入
                } else {
                    $("#disp" + jqmeisaif.slice(6) + key1 + m1d[key2]).text(g1[meisai_hd][1 * key1][key2]); // 表示用へ代入
                }
            }

            if (1 * key1 + 1 >= g1.imax && g1[meisai_hd][1 * key1]['shouhin_mr_cd'] != '') addMeisaiDt();
        }

        // 発注と紐づける
        if (g1['hacchuu_dt_id'] !== '') {
            $('#tmp_hacchuu_id').val(g1['hacchuu_dt_id']);
            $('#hacchuu_no').val(g1['dummy_hacchuu_no']);
            $('#shiiresaki_mr_cd').val(g1['shiiresaki_mr_cd']);
            $('#xdisphachuusaki_mr_cd').text($('#shiiresaki_mr_cd option:selected').text());
            $('#shiiresaki_mr_cd').change();
        }

        if (!g1['tokuisaki_option']) g1['tokuisaki_option'] = {};
        $('#TokuisakiMrsOptions > option').remove(); //選択肢をクリアしてから追加する
        $.each(g1['tokuisaki_option'], function (key4, text4) {
            $('#TokuisakiMrsOptions').append($("<option>").val(key4).text(text4));
        });

        if (!g1['nounyuusaki_option']) g1['nounyuusaki_option'] = {};
        $('#NounyuusakiMrsOptions > option').remove(); //選択肢をクリアしてから追加する
        $.each(g1['nounyuusaki_option'], function (key4, text4) {
            $('#NounyuusakiMrsOptions').append($("<option>").val(key4).text(text4));
        });

        if (!g1['kidukesaki_option']) g1['kidukesaki_option'] = {};
        $('#KidukesakiMrsOptions > option').remove(); //選択肢をクリアしてから追加する
        $.each(g1['kidukesaki_option'], function (key4, text4) {
            $('#KidukesakiMrsOptions').append($("<option>").val(key4).text(text4));
        });

        if (!g1['shouhin_option']) g1['shouhin_option'] = {};
        $('#ShouhinMrsOptions > option').remove(); //選択肢をクリアしてから追加する
        $.each(g1['shouhin_option'], function (key4, text4) {
            $('#ShouhinMrsOptions').append($("<option>").val(key4).text(text4));
        });

        if (!g1['souko_option']) g1['souko_option'] = {};
        $('#SoukoMrsOptions > option').remove(); //選択肢をクリアしてから追加する
        $.each(g1['souko_option'], function (key4, text4) {
            $('#SoukoMrsOptions').append($("<option>").val(key4).text(text4));
        });

        $("[id$='Hiduke']").scrollLeft(100);
        jsgant();

        $('#dispEmsg').removeClass();
    } catch (error) {
        alert("エラー16内容：" + error);
    }

    // @TEST
    try {
        ProductionPlanByModel();
    } catch (error) {
        console.log('G1_To_Gamen(): エラーを握りつぶす ');
    }
}

// *****************************************************************
$("[id$='Hiduke']").focusout(function () { // 日付右寄せ
// *----------------------------------------------------------------
    $(this).scrollLeft(100);
});

var g;
var gFormat = 'week';

// *****************************************************************
function jsgant(clear = false) { // ガントチャート表示。
// *----------------------------------------------------------------
    try {
        g = new JSGantt.GanttChart('g', document.getElementById('GanttChartDIV'), gFormat);
        g.setShowRes(0);              // リソースの表示/非表示（0/1）
        g.setShowDur(0);              // 期間の表示/非表示（0/1）
        g.setShowComp(0);             // 完了率を表示/非表示（0/1）
        g.setCaptionType('Resource'); // キャプションを表示（None、Caption、Resource、Duration、Complete）に設定
        g.setShowStartDate(0);        // 開始日を表示/非表示（0/1）
        g.setShowEndDate(0);          // 終了日を表示/非表示（0/1）
        g.setDateInputFormat('yyyy-mm-dd');  // 入力日付の形式を設定 ('mm/dd/yyyy', 'dd/mm/yyyy', 'yyyy-mm-dd')
        g.setDateDisplayFormat('yy/mm/dd');  // 日付を表示する形式を設定 ('mm/dd/yyyy', 'dd/mm/yyyy', 'yyyy-mm-dd')
        g.setFormatArr("day", "week", "month"); // 書式オプションを設定します（最大4つ : "minute","hour","day","week","month","quarter")
        if (clear) {
            g.AddTaskItem(new JSGantt.TaskItem(0, '', '', '', '', '', 0, '', 0, 0, 0, 0, 0, ''));
        }
        for (var i = 0; i < g1.imax - 1; i++) {
            g.AddTaskItem(new JSGantt.TaskItem(
                g1[meisai_hd][i]['cd'],              // pID ：（必須）は、親関数の各行を識別し、非表示/表示のdom idを設定するために使用される一意のIDです
                g1[meisai_hd][i]['shouhin_mr_cd'],   // pName ：（必須）はタスクラベルです
                g1[meisai_hd][i]['kaisi_hiduke'],    // pStart ：（必須）タスクの開始日。グループの空の日付（ ''）を入力できます。 また、特定の時間（2/10/2008 12:00）を入力して、追加の精度または半日にすることもできます。
                g1[meisai_hd][i]['shuuryou_hiduke'], // pEnd ：（必須）タスクの終了日。グループの空の日付（ ''）を入力できます
                g1[meisai_hd][i]['h_kishu_mr_irowake'],// pColor ：（必須）このタスクのhtmlカラー。 例： '00ff00'
                '',                                  // pLink ：（オプション）タスクバーがクリックされたときに移動するhttpリンク。
                0,                                   // pMile :(オプション）マイルストーンを表します
                g1[meisai_hd][i]['h_kishu_mr_cd'],   // pRes ：（オプション）リソース名
                0,                                   // pComp ：（必須）完了率
                0,                                   // pGroup ：（オプション）これがグループ（親）かどうかを示します-0 = NOT親; 1 = IS親
                g1[meisai_hd][i]['oya_meisai_cd'],   // pParent ：（必須）親pIDを識別します。これにより、このタスクは識別されたタスクの子になります。
                0,                                   // pOpen ：チャートが最初に描画されるときに最初にフォルダーを閉じるように設定できます
                1 * g1[meisai_hd][i]['oya_meisai_cd'], // pDepend ：このタスクが依存するidのオプションのリスト...依存からこのアイテムに引かれた線
                g1[meisai_hd][i]['tekiyou']          // pCaption ：CaptionTypeが「Caption」に設定されている場合、タスクバーの後に追加されるオプションのキャプション
            ));
        }
        g.Draw();
        g.DrawDependencies();
    } catch (error) {
        alert("エラー16g内容：" + error);
    }
}

// *****************************************************************
function ajaxAnyDo(TODO, CALLBACK) { // 現在グループのチェック等
// *----------------------------------------------------------------
    try {
        g1.errflg = 0;
        g1.emsg = '';
        g1.errfld = '';
        $.ajax({
            type: "POST",
            url: this_url_base + 'h_keikaku_dts/ajaxAnyDo',
            data: {'todo': TODO, 'g1': g1,},
            async: true,
            dataType: 'json',
            success: function (data) {
                g1 = data;
       //         console.log(data);
                g1_to_GAMEN(); // エラー内容も含めて表示。
                if (CALLBACK) window[CALLBACK](); // 呼び出し指定のfunctionを呼ぶ。例：ANSWER()
                $('#point_1').text('');
                for (var i = 0; i < g1.point_1.length; i++) {
                    $('#point_1').append(g1.point_1[i] + '<br>');
                }
            },
            error: function (xhr, status, err) {
                alert('エラー ' + this_url_base + 'h_keikaku_dts/ajaxAnyDo' + status + '/' + err);
            },
        });
    } catch (error) {
        alert("エラー17内容：" + error);
    }
}

// *****************************************************************
function modalprint() { // 印刷モーダルダイヤログ部分(変数名と関数名が同じと変になる)
// *----------------------------------------------------------------
    modalstart(modal_print, "試織設計書印刷", '3');
}

// *****************************************************************
$("[id$='Lot']").dblclick(function () { //商品マスター索引 lot_summary
// *----------------------------------------------------------------
    modalstart(this_url_base + "g_report_zaiko_dts/lot_summary", "ロット別在庫"
        , "?cd=" + $('#' + lastfocusin.slice(0, -3) + "ShouhinMrCd").val().replace('+', '%2B'));
});

// *****************************************************************
function f8key() { // モーダルダイヤログ部分
// *----------------------------------------------------------------
    try {
        if (lastfocusin == "fieldCd") { // 伝票番号選択
            modalstart1(this_url_base + "h_keikaku_dts/modal", "伝票番号選択");
        } else if (lastfocusin == "fieldTokuisakiMrCd") { // 得意先選択
            modalstart(this_url_base + "tokuisaki_mrs/modal", "得意先選択");
        } else if (lastfocusin == "fieldNounyuusakiMrCd") { /* 発送先コード選択 */
            if (1 * g1.hassousaki_kbn_cd > 1) { // 発送先区分が２なら得意先、３なら納入先、４なら倉庫、０～１は何もしない
                modalstart(this_url_base + hassousaki_kbns_sanshou_table[1 * g1.hassousaki_kbn_cd] + "/modal", "発送先選択");
            }
        } else if (lastfocusin == "fieldKidukesakiMrCd") { /* 気付先コード選択 */
            modalstart(this_url_base + "nounyuusaki_mrs/modal", "気付先選択");
        } else if (lastfocusin.slice(-11) == "ShouhinMrCd") { /* 商品コード選択 */
            modalstart(this_url_base + "shouhin_mrs/modal", "商品選択");
        } else if (lastfocusin.slice(-3) == "Lot") { /* ロット別在庫選択 */
            modalstart(this_url_base + "g_report_zaiko_dts/lot_summary", "ロット別在庫"
                , "?cd=" + $('#' + lastfocusin.slice(0, -3) + "ShouhinMrCd").val().replace('+', '%2B'));
        } else if (lastfocusin.slice(-9) == "SoukoMrCd") { /* 倉庫コード選択 */
            modalstart(this_url_base + "souko_mrs/modal", "倉庫選択");
        } else if (lastfocusin == "fieldHakkoubi") { // 発行日選択
            open_datepicker();
        } else if (lastfocusin == "fieldNounyuuKijitu") { // 納入期日選択
            open_datepicker();
        }
    } catch (error) {
        alert("エラー18内容：" + error);
    }
}

// *****************************************************************
function open_datepicker() {
// *----------------------------------------------------------------
    $('#' + lastfocusin).datepicker({
        dateFormat: 'yy-mm-dd',
        onSelect: function () {
            $('#' + lastfocusin).focus();
        },
        onClose: function () {
            $('#' + lastfocusin).datepicker('destroy');
        }
    });
    $('#' + lastfocusin).datepicker('show');
}

// *****************************************************************
function modalstart(url, title, para) {
// *----------------------------------------------------------------
    $('#iframe-title').text(title);
    $('#iframe-wrap').fadeIn();
    if (!para) {
        para = '?cd=' + $('#' + lastfocusin).val();
    }
    $('#iframe-body').html('<iframe src="' + url + para + '" width="100%" height="100%" style="border: none;">');
    $('#iframe-bg').fadeTo('normal', 0.2);
    $('#iframe-body iframe').load(function () {
        $(this).contents().find('#header').hide();
    });
    return false;
}

// *****************************************************************
function modalstart1(url, title, para) {
// *----------------------------------------------------------------
    $('#iframe-title').text(title);
    $('#iframe-wrap').fadeIn();
    $('#iframe-body').html('<iframe src="" width="100%" height="100%" style="border: none;" name="iframe1">');
    $('#iframe-bg').fadeTo('normal', 0.2);
    $('#iframe-body iframe').load(function () {
        $(this).contents().find('#header').hide();
    });
    document.iframe1form.submit();
    return false;
}

// *****************************************************************
$('.open-modal1').dblclick(function () { // 明細入力用モーダルを開く
// *----------------------------------------------------------------
    var ary_name1 = $(this).prop('name').split('[');
    var name2 = ary_name1[2].slice(0, -1);
    g1.on_row = 1 * name2; // 現在行を設定
    modalstart(this_url_base + "h_keikaku_dts/modal1", "計画明細入力");
});

// *****************************************************************
function p2c_g1() { // モーダルウインドウから実行する関数（共通の格納領域を返す）
// *----------------------------------------------------------------
    return g1;
}

// *****************************************************************
function p2c_m1n() { // モーダルウインドウから実行する関数（明細の少数桁数を返す）
// *----------------------------------------------------------------
    return m1n;
}

// *****************************************************************
function c2p_g1(c_g1) { // モーダルウインドウから実行する関数（共通の格納領域を戻す）
// *----------------------------------------------------------------
    g1 = c_g1;
    g1_to_GAMEN();
}

// *****************************************************************
$('#iframe-wrap button').click(function () { /* 中止して終わる (X) */
// *----------------------------------------------------------------
    $('#iframe-bg, #iframe-wrap').fadeOut();
});

// *****************************************************************
function fromModal(retval, retsouko = '', zaikosuu = '', iro = '', iromei = '', soukoname = '') {
// *----------------------------------------------------------------
    //alert('親ページの関数が実行されました。');
    $('#iframe-wrap').fadeOut(
        function () {//alert("フェードアウト完了")
            if (retval != null) {
                $('#' + lastfocusin).val(retval);
                $('#' + lastfocusin).change();
            }
            //倉庫コードを選択するために追加
            if (retsouko !== '') {
                var currntId = document.activeElement.id;
                var rowIndex = currntId.replace(/[^0-9^\.]/g, "");
                var souko_code = retsouko.toString();
                let rowId = jqmeisaif + rowIndex + 'SoukoMrCd';
                $(rowId).val(souko_code);
                $('#xdisp' + rowId.substr(6)).text(souko_code);
                g1[meisai_hd][rowIndex]['souko_mr_cd'] = souko_code;
            }
            //LOT在庫数量
            if (zaikosuu !== '') {
                let zaiko = parseFloat(zaikosuu);
                $("#dispGenzaiko").text(zaiko);
            }
            //色番
            if (iro !== '') {
                let iroID = jqmeisaif + rowIndex + 'Iro';
                $(iroID).val(iro);
                $('#xdisp' + iroID.substr(6)).text(iro);
                g1[meisai_hd][rowIndex]['iro'] = iro;
            }
            //色名
            if (iromei !== '') {
                let iroName = jqmeisaif + rowIndex + 'Iromei';
                $(iroName).val(iromei);
                $('#xdisp' + iroName.substr(6)).text(iromei);
                g1[meisai_hd][rowIndex]['iromei'] = iromei;
            }
            //倉庫名
            if (iromei !== '') {
                let soukoName = jqmeisaif + rowIndex + 'SoukoMrName';
                $(soukoName).val(soukoname);
                $('#xdisp' + soukoName.substr(6)).text(soukoname);
                g1[meisai_hd][rowIndex]['souko_mr_name'] = soukoname;
            }
        }
    );
    $('#iframe-bg').fadeOut();
    $('#' + lastfocusin).focus().select();
}

// *****************************************************************
(function ($) {
    $.extend({
        htmlspecialchars: function htmlspecialchars(ch) {
// *----------------------------------------------------------------
            if (ch) {
                ch = '' + ch;
                ch = ch.replace(/&/g, "&amp;");
                ch = ch.replace(/"/g, "&quot;");
                ch = ch.replace(/'/g, "&#039;");
                ch = ch.replace(/</g, "&lt;");
                ch = ch.replace(/>/g, "&gt;");
                ch = ch.replace(/\r?\n/g, '<br>');
            }
            return ch;
        }
    });
})(jQuery);


// *****************************************************************
$(function () { // テーブルのヘッドを消えなくする
// *----------------------------------------------------------------
    $('table.head_fix').floatThead({
        top: 50
    });
});

// *****************************************************************
$("[id^='field0']").focus(function () { // カーソル位置に合せてスクロールする
// *----------------------------------------------------------------
    var ot_right = $('th.ot-fixed2').offset().left + $('th.ot-fixed2').width();
    if ($(this).offset().left - ot_right < 0) $('#meisaiBody').animate({
        scrollLeft: ($(this).offset().left - ot_right + $('#meisaiBody').scrollLeft())
    });
});

// *****************************************************************
(function ($) { //$=JQuery
// *----------------------------------------------------------------
    var sheet_nm = "#meisaiTable";
    var drag_target = null;
    var tbl_width = $(sheet_nm).width();
    var org_width = 0;
    $(sheet_nm + " th").unbind('mousemove', null);
    $(sheet_nm + " th").unbind('mousedown', null);
    $(window).unbind('mousemove', null);
    $(window).unbind('mouseup', null);
    $(window).mousemove(function (e) {
        if (drag_target != null) {
            //ドラッグ中による列幅変更。
            var th_width = e.clientX - parseInt($(drag_target).offset().left);
            if (th_width < 10) {
                th_width = 10;
            }
            if (drag_target.hasClass('ot-fixed')) {
                $('.ot-fixed').css({width: th_width + 'px'});
                $('.ot-fixed1').css({left: (6 + th_width) + 'px'});
                var th_width1 = $('th.ot-fixed1').width();
                $('.ot-fixed2').css({left: (7 + th_width + th_width1) + 'px'});
            } else if (drag_target.hasClass('ot-fixed1')) {
                $('.ot-fixed1').css({width: th_width + 'px'});
                var th_width0 = $('th.ot-fixed').width();
                $('.ot-fixed2').css({left: (7 + th_width + th_width0) + 'px'});
            } else if (drag_target.hasClass('ot-fixed2')) {
                $('.ot-fixed2').css({width: th_width + 'px'});
            } else {
                drag_target.css({width: th_width + 'px'});
            }
            //tableのサイズも変更する。
            //var tbl_width = th_width - parseInt(drag_target.css("width"));
            //var tbl_new_width = parseInt($(sheet_nm).css("width")) + tbl_width;
            var tbl_new_width = tbl_width - org_width + th_width;
            $(sheet_nm).css({width: tbl_new_width + 'px'});
            return false;
        }
        return true;
    });//[[ mousemove
    $(sheet_nm + " th").mousemove(function (e) {
        var right = parseInt($(this).offset().left) + parseInt($(this).css("width"));
        //マウスカーソルの図柄変更。
        if ((right - 10) < e.clientX) {
            if (e.clientX < (right + 10)) {
                //右端に位置する場合はリサイズカーソルにする。
                $(this).css({cursor: 'col-resize'});
                return false;
            }
        }
        $(this).css({cursor: 'default'});
        return true;
    });//[[ mousemove
    $(sheet_nm + " th").mousedown(function (e) {
        //マウスカーソルの図柄変更。
        if ($(this).css('cursor') == 'col-resize') {
            //ドラッグ開始。
            drag_target = $(this);
            $(document.body).css({cursor: 'col-resize'});
            tbl_width = $(sheet_nm).width();
            org_width = $(this).width() + 1;
            return false;
        }
        return true;
    });//[[ mousedown
    $(window).mouseup(function (e) {
        //ドラッグ解除。
        drag_target = null;
        $(document.body).css({cursor: ''});
        var tbl_new_width = 0;
    });//[[ mouseup
})(jQuery); //[[ onload.


// *****************************************************************
function switch_roa(fieldx) { // 項目制御readonly設定(主)
// *----------------------------------------------------------------
    if ($("#field" + fieldx).attr("readonly") === "readonly") {
        $("#field" + fieldx).removeAttr("readonly");
    } else {
        $("#field" + fieldx).attr("readonly", "readonly");
    }
    if (fieldx == 'KidukesakiMrCd') {
        if ($("#field" + fieldx).attr("readonly") === "readonly") {
            $("#fieldKiduke").attr("readonly", "readonly");
        } else {
            $("#fieldKiduke").removeAttr("readonly");
        }
    } else if (fieldx == 'NounyuusakiMrCd') {
        if ($("#field" + fieldx).attr("readonly") === "readonly") {
            $("#fieldNounyuusaki").attr("readonly", "readonly");
        } else {
            $("#fieldNounyuusaki").removeAttr("readonly");
        }
    }
    $targetElm = $(targetElm);
}

// *****************************************************************
function switch_ros(fieldx) { // 項目制御readonly設定(明細)
// *----------------------------------------------------------------
    if ($("#field0hidden" + fieldx).attr("readonly") === "readonly") {
        $("#field0hidden" + fieldx).removeAttr("readonly");
        for (var i = 0; i < 1 * g1.imax; i++) {
            $(jqmeisaif + i + fieldx).removeAttr("readonly");
        }
    } else {
        $("#field0hidden" + fieldx).attr("readonly", "readonly");
        for (var i = 0; i < 1 * g1.imax; i++) {
            $(jqmeisaif + i + fieldx).attr("readonly", "readonly");
        }
    }
    $targetElm = $(targetElm);
}

// *****************************************************************
function save_ros() {
// *----------------------------------------------------------------
    $("#save_ros").text("(→「入力制御の保存中!....」)").css('color', 'red');
    var readonlys = {}; // 連想配列初期化
    var rewidths = {}; // 連想配列初期化
    try {
        for (var j in ro_fields) {
            var ro_field_name = ro_fields[j];
            if (ro_fields[j].substr(0, 1) == '[') {
                ro_field_name = 'hidden' + ro_fields[j] + ']';
            }
            readonlys[ro_fields[j]] = $("[name='" + ro_field_name + "']").attr('readonly') === 'readonly';
            if (ro_fields[j].substr(0, 1) == '[') {
                ro_field_name = 'data[keikaku_meisai_dts][0]' + ro_fields[j] + ']';
                rewidths[ro_fields[j]] = $("[name='" + ro_field_name + "']").outerWidth();
            }
            // errorの発生個所を特定するため
            console.log('j: ' + j);
        }
    } catch (e) {
        console.log(e.message);
    }
    $.ajax({
        type: "POST",
        url: this_url_base + 'readonly_field_kbns/ajaxSave',
        data: {'controller_cd': 'KeikakuDts', 'gamen_cd': 'inputfields', 'readonlys': readonlys, 'rewidths': rewidths,},
        async: true,
        dataType: 'json',
        success: function (error_count) {
            console.log('入力制御を保存しました。！');
            $("#save_ros").text('(click→「入力制御の保存」)').css('color', 'pink');
        },
        error: function (xhr, status, err) {
            console.log('入力制御の保存でエラー Cd.change.ajax ' + status + '/' + err);
            $("#save_ros").text('(click→「入力制御の保存」)').css('color', 'pink');
        },
    });

}

/**
 * 発注情報を取得
 */
function getOrderData () {
    const supplier = document.querySelector('#shiiresaki_mr_cd');
    const supplier_selected_index = supplier.selectedIndex;
    const supplier_code = supplier[supplier_selected_index].value;
    $.ajax({
        type: "POST",
        url: testAjax,
        data: {'cd': supplier_code,},
        async: true,
        dataType: 'json',
        success: function (data) {
            createOrderTable(data);
        },
        error: function (xhr, status, err) {
           console.error(`getOrderDate→ERROR: ${status}/${err}`);
        },
    });
}

/**
 * 発注情報テーブル描画
 * @param orderData
 */
function createOrderTable (orderData) {
    $('table#hacchuu_table tbody *').remove();
    for (let i = 0; i < orderData.length; i++) {
        $('table#hacchuu_table tbody').append(`
            <tr>
                <input id="hacchuu_id_${i}" type="hidden" value="${orderData[i]['hacchuu_id']}" />
                <td id="${i}" style="text-align: center;cursor: pointer;" onclick="clickOrderNo($(this).attr('id'))">${orderData[i]['hacchuu_no']}</td>
                <td style="text-align: center;">${orderData[i]['nounyuu_kijitu']}</td>
                <td style="text-align: center;">${orderData[i]['tantou_name']}</td>
                <td id="num_${i}" style="text-align: right;">${Math.round(parseFloat(orderData[i]['num']) * 100) / 100}</td>
                <td id="shouhin_mr_cd_${i}" style="text-align: center;">${orderData[i]['shouhin_mr_cd']}</td>
                <td>${orderData[i]['bikou']}</td>
            </tr>
        `);
    }
}

/**
 * 発注テーブルクリックで発注情報を明細に書き込み
 *
 * @param id
 */
function clickOrderNo(id) {
    const orderCd = ($(`#${id}`).text());

    $("#tmp_hacchuu_id").val($(`#hacchuu_id_${id}`).val());
    g1['hacchuu_dt_id'] = $(`#hacchuu_id_${id}`).val();
    g1['dummy_hacchuu_no'] = orderCd;
    $('#hacchuu_no').val(orderCd);
    g1['shiiresaki_mr_cd'] = $('#shiiresaki_mr_cd').val();
    $('#xdispshiiresaki_mr_cd').text($('#shiiresaki_mr_cd').val());
    $("#fieldHKeikakuMeisaiDts0ShouhinMrCd").val($(`#shouhin_mr_cd_${id}`).text());
    $.when (
        $("#fieldHKeikakuMeisaiDts0ShouhinMrCd").change(),
    ).done(function () {
        $("#fieldHKeikakuMeisaiDts0MotoJuchRyou").val($(`#num_${id}`).text());
    });


}



// 一覧ガントチャート用変数
var gantt;
var ganttFormat = 'day'; // 初期表示は日別
/**
 * 選択され、所要量展開時に、加工機種の現在の配台状況を描画する
 *
 * @param clear
 * @constructor
 */
function ProductionPlanByModel(clear = false) {
    const postData = {
        'model_cd' : $('#fieldHKeikakuMeisaiDts0HKishuMrCd').val(), // 機種コード
        'start_date' : $('#fieldHKeikakuMeisaiDts0KaisiHiduke').val(), // クエリ範囲開始日
        'end_date' : $('#fieldHKeikakuMeisaiDts0ShuuryouHiduke').val(),  // クエリ範囲終了日
        'supplier' : $('#shiiresaki_mr_cd').val(),  // 発注先コード
    };

    $.ajax({
        type: "POST",
        url: getModelPlan,
        data: postData,
        async: true,
        dataType: 'json',
        success: function (data) {
            console.log(data)
            const obj = data;
            // APIから受け取ったデータを描画
            $('table#plan_table tbody *').remove();
            for (let i = 0; i < obj.length; i++) {
                $('table#plan_table tbody').append(`
            <tr>
                <td style="text-align: center;">${obj[i]['hacchuu_no']}</td>
                <td style="text-align: center;">${obj[i]['kishu_mei']}</td>
                <td style="text-align: center;">${obj[i]['shouhin_mr_cd']}</td>
                <td style="text-align: left;">${obj[i]['tekiyou']}</td>
                <td style="text-align: center;">${obj[i]['start_date']}</td>
                <td style="text-align: center;">${obj[i]['end_date']}</td>
                <td style="text-align: center;">${obj[i]['gouki']}</td>
            </tr>
        `);
            }

            // APIから受け取ったデータで、GanttChart描画
            try {
                // 設定
                gantt = new JSGantt.GanttChart('obj', document.getElementById('ProcessChart'), 'week');
                gantt.setShowRes(0);              // リソースの表示/非表示（0/1）
                gantt.setShowDur(0);              // 期間の表示/非表示（0/1）
                gantt.setShowComp(0);             // 完了率を表示/非表示（0/1）
                gantt.setCaptionType('Resource'); // キャプションを表示（None、Caption、Resource、Duration、Complete）に設定
                gantt.setShowStartDate(0);        // 開始日を表示/非表示（0/1）
                gantt.setShowEndDate(0);          // 終了日を表示/非表示（0/1）
                gantt.setDateInputFormat('yyyy-mm-dd');  // 入力日付の形式を設定 ('mm/dd/yyyy', 'dd/mm/yyyy', 'yyyy-mm-dd')
                gantt.setDateDisplayFormat('yy/mm/dd');  // 日付を表示する形式を設定 ('mm/dd/yyyy', 'dd/mm/yyyy', 'yyyy-mm-dd')
                gantt.setFormatArr("day", "week", "month"); // 書式オプションを設定します（最大4つ : "minute","hour","day","week","month","quarter")
                if (clear) {
                    gantt.AddTaskItem(new JSGantt.TaskItem(0, '', '', '', '', '', 0, '', 0, 0, 0, 0, 0, ''));
                }
                // 描画
                for (let i = 0; i < obj.length; i++) {
                    gantt.AddTaskItem(new JSGantt.TaskItem(
                        obj[i]['hacch_uo'], // pID:（必須）は、親関数の各行を識別し、非表示/表示のdom idを設定するために使用される一意のIDです
                        obj[i]['kishu_mei'], // pName:（必須）はタスクラベルです
                        obj[i]['start_date'], // pStart:（必須）タスクの開始日。グループの空の日付（ ''）を入力できます。 また、特定の時間（2/10/2008 12:00）を入力して、追加の精度または半日にすることもできます。
                        obj[i]['end_date'], // pEnd:（必須）タスクの終了日。グループの空の日付（ ''）を入力できます
                        obj[i]['pColor'], // pColor:（必須）このタスクのhtmlカラー。 例： '00ff00'
                        '', // pLink ：（オプション）タスクバーがクリックされたときに移動するhttpリンク。
                        0, // pMile :(オプション）マイルストーンを表します
                        obj[i]['pCaption'] + '錘', // pRes:（オプション）リソース名
                        0, // pComp :（必須）完了率
                        0, // pGroup:（オプション）これがグループ（親）かどうかを示します-0 = NOT親; 1 = IS親
                        '', // pParent:必須）親pIDを識別します。これにより、このタスクは識別されたタスクの子になります。
                        0, // pOpen:チャートが最初に描画されるときに最初にフォルダーを閉じるように設定できます
                        '', // pDepend:このタスクが依存するidのオプションのリスト...依存からこのアイテムに引かれた線
                        obj[i]['pCaption'] // pCaption:CaptionTypeが「Caption」に設定されている場合、タスクバーの後に追加されるオプションのキャプション
                    ));
                }
                gantt.Draw();
                gantt.DrawDependencies();
            } catch (error) {
                alert(`Error/ProductionPlanByModel: ${error.message}`);
            }
        },
        error: function (xhr, status, err) {
            console.error(`ProductionPlanByModel→ERROR: ${status}/${err}`);
        },
    });

}

