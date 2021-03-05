$(function(){
    $('.submit').on('click', function(){
        var form = $(this).parents('form');
        form.attr('action', $(this).data('action'));
        var hoge = $(this).data('hoge');
        $('<input>').attr({
            'type': 'hidden',
        }).appendTo(form);
        form.submit();
    });
});

$('#h_cd').click(function () {
    const h_id = $('#h_id').val();
    if (h_id) {
        window.open('http://192.168.11.199/demo/hacchuu_dts/edit/' + h_id);
    }
})

$('#juchuu_no').click(function () {
    const juchuu_id = $('#juchuu_id').val();
    if (juchuu_id) {
        window.open('http://192.168.11.199/demo/juchuu_dts/edit/' + juchuu_id);
    }
})

function exportObject () {
    $.ajax({
        type: "post",
        url: exportHoukokuData,
        data: {data: hot.getData()},
        async: true,
        dataType: 'json',
        success: (data) => {
            console.log(data);
            const fullPath = data.split('/');
            console.log(fullPath);
            const fileName = fullPath[11];
            let newwin = open(this_url_base + '/temp/' + fileName, '_self');
            // window.open(this_url_base + '/temp/' + fileName, '_self');
            // @TODO 削除処理
            // $.ajax({
            //     url: this_url_base + 'h_shouhin_jouken_mrs/delExcel',
            //     data: {path: '/temp/nouki_houkoku.xlsx'},
            //     method: 'post',
            //     dataType: 'json',
            //     async: true,
            //     success: flg => {
            //         console.log(flg);
            //         window.scrollTo(0, 0);
            //     },
            //     error: error => {
            //         console.log(error);
            //         window.scrollTo(0, 0);
            //     }
            // })
        },
        error: (xhr, status, err) => {
            alert('Error -> getMikanryouData: ' + status + '/' + err);
        },
    })
}

function modalstart(url, title)
{
    $('#iframe-title').text(title);
    $('#iframe-wrap').fadeIn();
    $('#iframe-body').html('<iframe src="' + url + '" width="100%" height="100%" style="border: none;" name="iframe1">');
    $('#iframe-bg').fadeTo('normal', 0.5);
    $('#iframe-body iframe').load(function ()
    {
        $(this).contents().find('#header, #footer').hide();
    });
    return false;
}

$('#iframe-wrap button').click(function ()
{
    $('#iframe-bg, #iframe-wrap').fadeOut();
});

function fromModal(retval)
{
    $('#iframe-wrap').fadeOut();
    $('#iframe-bg').fadeOut();
    $('#' + lastfocusin).focus().select();
}
