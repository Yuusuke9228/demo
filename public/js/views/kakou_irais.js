window.onload = function ()
{

};
$(function ()
{
    $('.submit').on('click', function ()
    {
        var form = $(this).parents('form');
        form.attr('action', $(this).data('action'));
        var hoge = $(this).data('hoge');
        $('<input>').attr({
            'type': 'hidden',
        }).appendTo(form);
        form.submit();
    });
});

$('#h_cd').click(function ()
{
    const h_id = $('#h_id').val();
    console.log(h_id);
    if (h_id)
    {
        window.open('http://192.168.11.199/demo/hacchuu_dts/edit/' + h_id);
    }
})

$('#juchuu_no').click(function ()
{
    const juchuu_id = $('#juchuu_id').val();
    console.log(juchuu_id);
    if (juchuu_id)
    {
        window.open('http://192.168.11.199/demo/kakou_irais.jsjuchuu_dts/edit/' + juchuu_id);
    }
})


function modalstart(url, title)
{
    $('#iframe-title').text(title);
    $('#iframe-wrap').fadeIn();
    $('#iframe-body').html('<iframe src="' + url + '?shouhin_mr_cd=' + $('#shouhin_mr_cd').val() + '" width="100%" height="100%" style="border: none;">');
    $('#iframe-bg').fadeTo('normal', 0.5);
    $('#iframe-body iframe').load(function ()
    {
        $(this).contents().find('#header, #footer').hide();
    });
    return false;
}

function modalstart2(url, title)
{
    $('#iframe-title').text(title);
    $('#iframe-wrap').fadeIn();
    $('#iframe-body').html('<iframe src="' + url + '?shouhin_mr_cd=' + $('#shouhin_mr_cd').val() + '&h_cd=' + $('#h_cd').val() + '" width="100%" height="100%" style="border: none;">');
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

function fromModal(nai1, nai2, nai3, nai4, nai5, nai6, nai7, nai8, nai9, nai10, nai11, nai12, nai13)
{
    $('#iframe-wrap').fadeOut(
        function ()
        {
            if (nai1)
            {
                $('#naiyou_1').val(nai1);
                $('#naiyou_2').val(nai2);
                $('#naiyou_3').val(nai3);
                $('#naiyou_4').val(nai4);
                $('#naiyou_5').val(nai5);
                $('#naiyou_6').val(nai6);
                $('#naiyou_7').val(nai7);
                $('#naiyou_8').val(nai8);
                $('#naiyou_9').val(nai9);
                $('#naiyou_10').val(nai10);
                $('#naiyou_11').val(nai11);
                $('#naiyou_12').val(nai12);
                $('#naiyou_13').val(nai13);
            }
        }
    );
    $('#iframe-bg').fadeOut();
    $('#' + lastfocusin).focus().select();
}

$(function ()
{
    $("#iframe-wrap").draggable({
        handle: ".modal-header"
    });
});
