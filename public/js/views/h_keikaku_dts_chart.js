// 一覧ガントチャート用変数
var g;
var gFormat = 'day'; // 初期表示は日別

/**
 * 条件にあったガントチャートを描画する
 *
 * @constructor
 */
function productionPlan() {
    if ($('#startDate').val() === '') {
        alert('日付けを入力してください。');
        return;
    } else if ($('#endDate').val() === '') {
        alert('日付けを入力してください。');
        return;
    }
    const postData = {
        'model_cd' : $('#model_cd').val(), // 機種コード
        'start_date' : $('#startDate').val(), // クエリ範囲開始日
        'end_date' : $('#endDate').val(),  // クエリ範囲終了日
        'supplier' : $('#supplier').val(),  // 発注先コード
    };
    console.log(postData);

    $.ajax({
        type: "POST",
        url: productionsPlanningChart,
        data: postData,
        async: true,
        dataType: 'json',
        success: function (data) {
            if (!data) {
                return;
            }
            const obj = data;
            // APIから受け取ったデータを描画
            $('table#plan_table tbody *').remove();
            for (let i = 0; i < obj.length; i++) {
                $('table#plan_table tbody').append(`
                    <tr>
                        <td nowrap style="text-align: center;">${obj[i]['hacchuu_no']}</td>
                        <td nowrap style="text-align: left;">${obj[i]['kishu_mei']}</td>
                        <td nowrap style="text-align: center;">${obj[i]['shouhin_mr_cd']}</td>
                        <td nowrap style="text-align: left;">${obj[i]['tekiyou']}</td>
                        <td nowrap style="text-align: center;">${obj[i]['start_date']}</td>
                        <td nowrap style="text-align: center;">${obj[i]['end_date']}</td>
                        <td nowrap style="text-align: center;">${obj[i]['gouki']}</td>
                    </tr>
                `);
            }

            let clear = false;
            // APIから受け取ったデータで、GanttChart描画
            try {
                g = new JSGantt.GanttChart('obj', document.getElementById('ProcessChart'), gFormat);
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
                console.log('gFormat:' + gFormat);

                for (var i = 0; i < obj.length; i++) {
                    // Ganttチャートへ時刻単位の表示のテスト
                    if (gFormat  === 'hour') {
                        $obj[i]['start_date'] += '01:00:00';
                        $obj[i]['end_date'] += '03:00:00';
                    }
                    g.AddTaskItem(new JSGantt.TaskItem(
                        obj[i]['hacch_uo'],              // pID ：（必須）は、親関数の各行を識別し、非表示/表示のdom idを設定するために使用される一意のIDです
                        obj[i]['kishu_mei'],   // pName ：（必須）はタスクラベルです
                        obj[i]['start_date'],    // pStart ：（必須）タスクの開始日。グループの空の日付（ ''）を入力できます。 また、特定の時間（2/10/2008 12:00）を入力して、追加の精度または半日にすることもできます。
                        obj[i]['end_date'], // pEnd ：（必須）タスクの終了日。グループの空の日付（ ''）を入力できます
                        obj[i]['pColor'],// pColor ：（必須）このタスクのhtmlカラー。 例： '00ff00'
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
                g.Draw();
                g.DrawDependencies();
            } catch (error) {
                alert("productionPlan -> Error：" + error);
            }
        },
        error: function (xhr, status, err) {
            console.error(`productionPlan → ERROR: ${status}/${err}`);
        },
    });

}
