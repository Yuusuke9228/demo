//クリックした倉庫コードと名称をsubimit用formに乗せ、submit
$(".zoom_nyuushukko").click(function() {
    $("#souko_name").val($(this).next('td').text());
    $("#souko_cd").val($(this).text());
    $("#souko_shouhin_lot").submit();
});
