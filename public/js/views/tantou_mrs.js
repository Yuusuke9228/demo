/*
 * フリガナ取得 Add By Nishiyama 2019-10-23
*/
$('#fieldName').change(function() {
    var input = $(this).val();
    input = toHalfWidth(input);
    input = zenkakuToHankaku(input);
    if (input !== '') {
        $.ajax({
            type: "POST",
            url: tantoumrs_ajaxKana,
            data: {'input': input,},
            async: true,
            dataType: 'json',
            success: function (data) {
                $('#fieldKanaMei').val(data['kana'].slice(0, -3)); //EOSが入るので消す
            },
            error: function(xhr, status, err) {
                alert('Error: Name.Change.Ajax ' + status + '/' + err);
            },
        });
    }
});
