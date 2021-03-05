window.onload=function() {
    $('#hacchuu_dt_cd').focus();
    if ($('#jissekibi').val() === '') {
        let today = new Date();
        $('#jissekibi').val(dateFormat(today));
    }
    if ($('#hacchuu_dt_cd').val() !== '') {
        $('#hacchuu_dt_cd').change();
    }
}

// 実績伝票を検索
$('#cd').change(function () {
    if ($(this).val() !== '') {
        $.ajax({
            type: "POST",
            url: jisseki_dts_ajaxGet,
            data: {'cd': $(this).val(),},
            async: true,
            dataType: 'json',
            success: function (data) {
                if (data['jisseki_rows'].length >= 1 && $('#cd').val() === data['jisseki_rows'][0].cd) {
                    location.href = jisseki_dts_edit + data['jisseki_rows'][0].id;
                } else {
                    $('#hacchuu_dt_cd').focus().select();
                }
            },
            error: function (xhr, status, err) {
                alert('Error cdChange(): ' + status + '/' + err);
            },
        });
    }
});

// 発注ナンバーに紐づく計画情報を検索
$('#hacchuu_dt_cd').change(function () {
   if ($(this).val() !== '') {
       $.ajax({
           type: "POST",
           url: h_keikaku_dts_ajaxGet,
           data: {
               'hacchuu_dt_cd': $(this).val(),
               'gyoumu_dt_cd': '',
           },
           async: true,
           dataType: 'json',
           success: function (data) {
               console.log(data);
               portrayal(data);
               $('#jissekibi').focus().select();
           },
           error: function (xhr, status, err) {
               console.error('Error hacchuu_dt_cdChange(): ' + status + '/' + err);
           }
       });
   }
});

// 計画ナンバー変更時、計画情報取得
$('#gyoumu_dt_cd').change(function () {
    if ($('#hacchuu_dt_cd').val() !== '') {
        if ($(this).val() !== '') {
            $.ajax({
                type: "POST",
                url: h_keikaku_dts_ajaxGet,
                data: {
                    'hacchuu_dt_cd': $('#hacchuu_dt_cd').val(),
                    'gyoumu_dt_cd': $(this).val(),
                },
                async: true,
                dataType: 'json',
                success: function (data) {
                    console.log(data);
                    portrayal(data);
                    $('#jissekibi').focus().select();
                },
                error: function (xhr, status, err) {
                    console.error('Error gyoumu_dt_cdChange(): ' + status + '/' + err);
                }
            });
        }
    }
});

/**
 * APIから受け取ったデータを描画する
 * @param data
 */
function portrayal (data) {
    // 計画詳細描画
    $('#gyoumu_dt_cd').val(data['keikaku_rows'][0]['gyoumu_dt_cd']);
    $('#gyoumu_dt_id').val(data['keikaku_rows'][0]['gyoumu_dt_id']);
    $('#shouhin_mr_cd').val(data['keikaku_rows'][0]['shouhin_mr_cd']);
    $('#hacchuu_dt_id').val(data['keikaku_rows'][0]['hacchuu_dt_id']);
    $('#tekiyou').val(data['keikaku_rows'][0]['tekiyou']);
    $('#lot').val(data['keikaku_rows'][0]['lot']);
    $('#iro').val(data['keikaku_rows'][0]['iro']);
    $('#model_name').val(data['keikaku_rows'][0]['model_name']);
    $('#suisuu').val(data['keikaku_rows'][0]['sui_suu']);
    $('#start_date').val(data['keikaku_rows'][0]['start_date']);
    $('#end_date').val(data['keikaku_rows'][0]['end_date']);
    $('#keikakusuu').val(data['keikaku_rows'][0]['keikakusuu']);
    $('#keikakuryou').val((data['keikaku_rows'][0]['keikakuryou'] * 1).toLocaleString());
    $('#jisseki_nyuuryoku_suu1').text('数量１：（' + data['keikaku_rows'][0]['tanni1'] + '）');
    $('#jisseki_nyuuryoku_suu2').text('数量２：（' + data['keikaku_rows'][0]['tanni2'] + '）');

    // 実績テーブル描画
    const plan_num1 = $('#keikakusuu').val();
    const plan_num2 = $('#keikakuryou').val();
    let subtotal1 = 0; // 数1計
    let subtotal2 = 0; // 数2計
    let difference = 0; // 差異
    for (let i = 0; i < data['jisseki_rows'].length; i++) {
        subtotal1 += (Math.round(parseFloat(data['jisseki_rows'][i]['jissekisuu']) * 100) / 100);
        subtotal2 += (Math.round(parseFloat(data['jisseki_rows'][i]['jissekiryou']) * 100) / 100);
        $('table#history tbody').append(`
            <tr>
                <input id="jisseki_id_${i}" type="hidden" value="${data['jisseki_rows'][i]['jisseki_id']}" />
                <td id="jisseki_cd_${i}" style="text-align: center;cursor: pointer;" onclick="clickOrderNo($(this).attr('id'))">${data['jisseki_rows'][i]['jisseki_cd']}</td>
                <td style="text-align: center;">${data['jisseki_rows'][i]['jisseki_hinsitu_kbn']}</td>
                <td id="jissekibi_${i}" style="text-align: center;">${data['jisseki_rows'][i]['jissekibi']}</td>
                <td id="num1_${i}" style="text-align: right;">${(Math.round(parseFloat(data['jisseki_rows'][i]['jissekisuu']) * 100) / 100).toLocaleString()}</td>
                <td id="num2_${i}" style="text-align: right;">${(Math.round(parseFloat(data['jisseki_rows'][i]['jissekiryou']) * 100) / 100).toLocaleString()}</td>
                <td id="memo_${i}" style="text-align: center;">${data['jisseki_rows'][i]['memo']}</td>
                <td style="text-align: center;">${data['jisseki_rows'][i]['kanryou_flg'] === '0' ? '' : '完了' }</td>
                <td id="row_print_${i}" class="btn btn-default btn-sm center-block" onclick="meisai_print($(this).attr('id'))">印刷</td>
            </tr>
        `);
    }
    $('#suu1_kei').val((Math.round(parseFloat(subtotal1) * 100) / 100)).toLocaleString();
    $('#suu2_kei').val((Math.round(parseFloat(subtotal2) * 100) / 100)).toLocaleString();
    $('#sai1').val((Math.round(parseFloat(plan_num1) - subtotal1) * 100) / 100).toLocaleString();
    $('#sai2').val((Math.round(parseFloat(plan_num2) - subtotal2) * 100) / 100).toLocaleString();
}

/**
 * 日付けのフォーマット
 *
 * @param date
 * @returns {string}
 */
function dateFormat(date) {
    const y = date.getFullYear();
    let m = date.getMonth() + 1;
    let d = date.getDate();
    if (m < 10) {
        m = '0' + m.toString();
    }
    if (d < 10) {
        d = '0' + d.toString();
    }
    return y.toString() + '-' + m + '-' + d;
}

/*
 *  実績明細エクセル出力
 */
function meisai_print(id)
{
    const rowIndex = id.replace(/[^0-9]/g, '');
    console.log('id' + rowIndex);
    $('<form/>', {action: jisseki_meisai_print, method: 'post'})
        .append($('<input/>', {type: 'hidden', name: 'jisseki_cd', value: $(`#jisseki_cd_${rowIndex}`).text()}))
        .append($('<input/>', {type: 'hidden', name: 'jissekibi', value: $(`#jissekibi_${rowIndex}`).text()}))
        .append($('<input/>', {type: 'hidden', name: 'shouhin_mr_cd', value: $('#shouhin_mr_cd').val()}))
        .append($('<input/>', {type: 'hidden', name: 'tekiyou', value: $('#tekiyou').val()}))
        .append($('<input/>', {type: 'hidden', name: 'lot', value: $('#lot').val()}))
        .append($('<input/>', {type: 'hidden', name: 'num1', value: $(`#num1_${rowIndex}`).text()}))
        .append($('<input/>', {type: 'hidden', name: 'num2', value: $(`#num2_${rowIndex}`).text()}))
        .append($('<input/>', {type: 'hidden', name: 'memo', value: $(`#memo_${rowIndex}`).text()}))
        .append($('<input/>', {type: 'hidden', name: 'hacchuu_dt_cd', value: $('#hacchuu_dt_cd').val()}))
        .append($('<input/>', {type: 'hidden', name: 'keikaku_dt_cd', value: $('#gyoumu_dt_cd').val()}))
        .append($('<input/>', {type: 'hidden', name: 'keikakusuu', value: $('#keikakusuu').val()}))
        .append($('<input/>', {type: 'hidden', name: 'keikakuryou', value: $('#keikakuryou').val()}))
        .append($('<input/>', {type: 'hidden', name: 'suu1_kei', value: $('#suu1_kei').val()}))
        .append($('<input/>', {type: 'hidden', name: 'suu2_kei', value: $('#suu2_kei').val()}))
        .append($('<input/>', {type: 'hidden', name: 'sai1', value: $('#sai1').val()}))
        .append($('<input/>', {type: 'hidden', name: 'sai2', value: $('#sai2').val()}))
        .appendTo(document.body)
        .submit();
}

/**
 * 実績履歴テーブルの印刷
 */
$(function() {
    $('.print-btn').on('click', function() {
        $('.print-btn').addClass('print-off');
        var printPage = $(this).closest('.print-page').html();
        $('body').append('<div id="print"></div>');
        $('#print').append(printPage);
        $('body > :not(#print)').addClass('print-off');
        window.print();
        $('#print').remove();
        $('.print-off').removeClass('print-off');
        $('.print-btn').removeClass('print-off');
    });
});
