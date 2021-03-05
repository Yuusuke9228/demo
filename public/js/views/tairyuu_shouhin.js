//入出庫明細表へ移動
$('.shouhin_cd').click(function() {
    var id =  $(this).attr("id");
    var id_count = id.replace(/[^0-9]/g, '');
    var shouhin_cd = $('#shouhin' + id_count).text();
    var souko_cd = $('#souko' + id_count).text();
    var data = {
        'cd': shouhin_cd,
        'souko_mr_cd': souko_cd,
    };
    var url = nyuushukko_meisai;
    var form = document.createElement("form");
    form.setAttribute("action", url);
    form.setAttribute("method", "post");
    form.style.display = "none";
    form.target = "blank";
    document.body.appendChild(form);
    if (data !== undefined) {
        for (var paramName in data) {
            var input = document.createElement('input');
            input.setAttribute('type', 'hidden');
            input.setAttribute('name', paramName);
            input.setAttribute('value', data[paramName]);
            form.appendChild(input);
        }
    }
    form.submit();
});

function f8key() {
   if (lastfocusin === "fieldLastShukko") {
        open_datepicker();
    }
}

function open_datepicker() {
    $('#'+lastfocusin).datepicker({
        dateFormat:'yy-mm-dd',
        onSelect:function(){
            $('#'+lastfocusin).focus();
        },
        onClose:function(){
            $('#'+lastfocusin).datepicker('destroy');
        }
    });
    $('#'+lastfocusin).datepicker('show');
}

$('#dl-xlsx').on('click', function () {
    var data = [];
    var tr = $("table tr");
    for (var i = 0, l = tr.length; i < l; i++) {
        var cells = tr.eq(i).children();
        for (var j = 0, m = cells.length; j < m; j++) {
            if (typeof data[i] == "undefined")
                data[i] = [];
            data[i][j] = cells.eq(j).text();
        }
    }

    data.splice(1,1);
    var write_opts = {
        type: 'binary'
    };
    var wb = aoa_to_workbook(data);
    var wb_out = XLSX.write(wb, write_opts);
    var blob = new Blob([s2ab(wb_out)], {type: 'application/octet-stream'});
    saveAs(blob, 'tairyuu_shouhin.xlsx');
    return false;
});

function sheet_to_workbook(sheet/*:Worksheet*/, opts)/*:Workbook*/ {
    var n = opts && opts.sheet ? opts.sheet : "Sheet1";
    var sheets = {};
    sheets[n] = sheet;
    return {SheetNames: [n], Sheets: sheets};
}

function aoa_to_workbook(data/*:Array<Array<any> >*/, opts)/*:Workbook*/ {
    return sheet_to_workbook(XLSX.utils.aoa_to_sheet(data, opts), opts);
}

function s2ab(s) {
    var buf = new ArrayBuffer(s.length);
    var view = new Uint8Array(buf);
    for (var i = 0; i != s.length; ++i) view[i] = s.charCodeAt(i) & 0xFF;
    return buf;
}