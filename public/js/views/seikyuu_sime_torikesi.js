/**
 * 削除クリックで締め済みデーターを削除し、その行を非表示にする
 *
 * @param e
 */
function delRow (e) {
    if (confirm('削除してもよろしいですか？')) {
        const objId = e.id;
        const dataId = objId.replace(/[^0-9]/g, '');
        const hideRow = $('#' + objId).data('row');
        const shime_hiduke = $('#sime_hiduke_' + dataId).text();
        const tokuisaki_mr_cd = $('#tokuisaki_' + dataId).text();

        $.ajax({
            url: delShimeData,
            method: 'post',
            data: {'id': dataId, 'tokuisaki_mr_cd': tokuisaki_mr_cd, 'sime_hiduke': shime_hiduke },
            dataType: 'json',
            async: true,
            success: function (res) {
                console.log('Ok: ' + res);
                if (res === '取消処理完了!') {
                    $('#t-row' + hideRow).hide();
                } else {
                    window.alert(res);
                }
            },
            error: function (xhr, status, err) {
                console.log('Error: ' + xhr + ' / ' + status + ' / ' + err);
            }
        })
    }
}

$('#fieldShimegrpKbnCd').change(function () {
    $.ajax({
        url: getTokuisakiGroupLastShimeHiduke,
        method: 'post',
        data: { 'grp_kbn': $(this).val() },
        dataType: 'json',
        async: true,
        success: function (res) {
            $('#fieldSimeHiduke').val(res.sime_hiduke);
        },
        error: function (xhr, status, err) {
            console.log('Error: ' + xhr + ' / ' + status + ' / ' + err);
        }
    })
})