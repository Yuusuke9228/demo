<?php

// TODO 帳票（・予算実績推移表/・予算実績対比表）を作成しなければいけない
class YosanDtsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        if ($this->request->isPost()) {
            $post_data = $this->request->getPost();
            $this->tag->setDefault("hyouji_kbn", $post_data['hyouji_kbn']);

            // 参考実績テーブル(売上実績)
            list($year, $month, $day) = explode('-', $post_data["kikan2_from"]);
            $select = "SELECT ";
            $from = " FROM ";
            $where = " WHERE ";
            $group = " GROUP BY ";
            $order = "";
            switch ($post_data["junjo_flg"]) {
                case '1':    // 得意先別
                    $select .= "c.cd AS 'key',c.name AS 'key_name',";
                    $group .= "c.cd,c.name";
                    $where .= "(c.cd BETWEEN '" . $post_data['hanni_from'] . "' AND '" . $post_data['hanni_to'] . "')";
                    $order = " ORDER BY c.cd ASC";
                    $from .= "
                        tokuisaki_mrs AS c 
                        LEFT JOIN uriage_dts AS b ON b.tokuisaki_mr_cd = c.cd
                        LEFT JOIN uriage_meisai_dts AS a ON a.uriage_dt_id = b.id
                    ";
                    break;
                case '2':    // 担当者別
                    $select .= "e.cd AS 'key',e.name AS 'key_name',";
                    $group .= "e.cd,e.name";
                    $where .= "(e.cd BETWEEN '" . $post_data['hanni_from'] . "' AND '" . $post_data['hanni_to'] . "')";
                    $order = " ORDER BY e.cd ASC";
                    $from .= "
                        tantou_mrs AS e 
                        LEFT JOIN uriage_dts AS b ON b.tantou_mr_cd = e.cd
                        LEFT JOIN uriage_meisai_dts AS a ON a.uriage_dt_id = b.id
                    ";
                    break;
                case '3':    // 商品別
                    $select .= "d.cd AS 'key',d.name AS 'key_name',";
                    $group .= "d.cd, d.name";
                    $where .= "(d.cd BETWEEN '" . $post_data['hanni_from'] . "' AND '" . $post_data['hanni_to'] . "')";
                    $order = " ORDER BY d.cd ASC";
                    $from .= "
                        shouhin_mrs AS d 
                        LEFT JOIN uriage_meisai_dts AS a ON a.shouhin_mr_cd = d.cd
                        LEFT JOIN uriage_dts AS b ON b.id = a.uriage_dt_id
                    ";
                    break;
            }

            switch ($post_data['hyouji_kbn']) {
                case '0':   // 順売上金額
                    $select .= "
                        SUM(if (date_format(b.uriagebi, '%Y%m')='" . $year . sprintf('%02d', $month) . "', a.kingaku, 0)) AS '1',
                        SUM(if (date_format(b.uriagebi, '%Y%m')='" . (((int)$month + 1 > 12) ? ((int)$year + 1) : $year) . sprintf('%02d', (((int)$month + 1 > 12) ? ((int)$month + 1 - 12) : ((int)$month + 1))) . "', a.kingaku, 0)) AS '2',
                        SUM(if (date_format(b.uriagebi, '%Y%m')='" . (((int)$month + 2 > 12) ? ((int)$year + 1) : $year) . sprintf('%02d', (((int)$month + 2 > 12) ? ((int)$month + 2 - 12) : ((int)$month + 2))) . "', a.kingaku, 0)) AS '3',
                        SUM(if (date_format(b.uriagebi, '%Y%m')='" . (((int)$month + 3 > 12) ? ((int)$year + 1) : $year) . sprintf('%02d', (((int)$month + 3 > 12) ? ((int)$month + 3 - 12) : ((int)$month + 3))) . "', a.kingaku, 0)) AS '4',
                        SUM(if (date_format(b.uriagebi, '%Y%m')='" . (((int)$month + 4 > 12) ? ((int)$year + 1) : $year) . sprintf('%02d', (((int)$month + 4 > 12) ? ((int)$month + 4 - 12) : ((int)$month + 4))) . "', a.kingaku, 0)) AS '5',
                        SUM(if (date_format(b.uriagebi, '%Y%m')='" . (((int)$month + 5 > 12) ? ((int)$year + 1) : $year) . sprintf('%02d', (((int)$month + 5 > 12) ? ((int)$month + 5 - 12) : ((int)$month + 5))) . "', a.kingaku, 0)) AS '6',
                        SUM(if (date_format(b.uriagebi, '%Y%m')='" . (((int)$month + 6 > 12) ? ((int)$year + 1) : $year) . sprintf('%02d', (((int)$month + 6 > 12) ? ((int)$month + 6 - 12) : ((int)$month + 6))) . "', a.kingaku, 0)) AS '7',
                        SUM(if (date_format(b.uriagebi, '%Y%m')='" . (((int)$month + 7 > 12) ? ((int)$year + 1) : $year) . sprintf('%02d', (((int)$month + 7 > 12) ? ((int)$month + 7 - 12) : ((int)$month + 7))) . "', a.kingaku, 0)) AS '8',
                        SUM(if (date_format(b.uriagebi, '%Y%m')='" . (((int)$month + 8 > 12) ? ((int)$year + 1) : $year) . sprintf('%02d', (((int)$month + 8 > 12) ? ((int)$month + 8 - 12) : ((int)$month + 8))) . "', a.kingaku, 0)) AS '9',
                        SUM(if (date_format(b.uriagebi, '%Y%m')='" . (((int)$month + 9 > 12) ? ((int)$year + 1) : $year) . sprintf('%02d', (((int)$month + 9 > 12) ? ((int)$month + 9 - 12) : ((int)$month + 9))) . "', a.kingaku, 0)) AS '10',
                        SUM(if (date_format(b.uriagebi, '%Y%m')='" . (((int)$month + 10 > 12) ? ((int)$year + 1) : $year) . sprintf('%02d', (((int)$month + 10 > 12) ? ((int)$month + 10 - 12) : ((int)$month + 11))) . "', a.kingaku, 0)) AS '11',
                        SUM(if (date_format(b.uriagebi, '%Y%m')='" . (((int)$month + 11 > 12) ? ((int)$year + 1) : $year) . sprintf('%02d', (((int)$month + 11 > 12) ? ((int)$month + 11 - 12) : ((int)$month + 11))) . "', a.kingaku, 0)) AS '12'
                    ";
                    break;
                case '1':   // 粗利益
                    $select .= "
                        SUM(if (date_format(b.uriagebi, '%Y%m')='" . $year . sprintf('%02d', $month) . "', a.zeinukigaku, 0)) - SUM(if (date_format(b.uriagebi, '%Y%m')='" . $year . sprintf('%02d', $month) . "', a.genkagaku, 0)) AS '1',
                        SUM(if (date_format(b.uriagebi, '%Y%m')='" . (((int)$month + 1 > 12) ? ((int)$year + 1) : $year) . sprintf('%02d', (((int)$month + 1 > 12) ? ((int)$month + 1 - 12) : ((int)$month + 1))) . "', a.zeinukigaku, 0)) - SUM(if (date_format(b.uriagebi, '%Y%m')='" . (((int)$month + 1 > 12) ? ((int)$year + 1) : $year) . sprintf('%02d', (((int)$month + 1 > 12) ? ((int)$month + 1 - 12) : ((int)$month + 1))) . "', a.genkagaku, 0)) AS  '2',
                        SUM(if (date_format(b.uriagebi, '%Y%m')='" . (((int)$month + 2 > 12) ? ((int)$year + 1) : $year) . sprintf('%02d', (((int)$month + 2 > 12) ? ((int)$month + 2 - 12) : ((int)$month + 2))) . "', a.zeinukigaku, 0)) - SUM(if (date_format(b.uriagebi, '%Y%m')='" . (((int)$month + 2 > 12) ? ((int)$year + 1) : $year) . sprintf('%02d', (((int)$month + 2 > 12) ? ((int)$month + 2 - 12) : ((int)$month + 2))) . "', a.genkagaku, 0)) AS  '3',
                        SUM(if (date_format(b.uriagebi, '%Y%m')='" . (((int)$month + 3 > 12) ? ((int)$year + 1) : $year) . sprintf('%02d', (((int)$month + 3 > 12) ? ((int)$month + 3 - 12) : ((int)$month + 3))) . "', a.zeinukigaku, 0)) - SUM(if (date_format(b.uriagebi, '%Y%m')='" . (((int)$month + 3 > 12) ? ((int)$year + 1) : $year) . sprintf('%02d', (((int)$month + 3 > 12) ? ((int)$month + 3 - 12) : ((int)$month + 3))) . "', a.genkagaku, 0)) AS  '4',
                        SUM(if (date_format(b.uriagebi, '%Y%m')='" . (((int)$month + 4 > 12) ? ((int)$year + 1) : $year) . sprintf('%02d', (((int)$month + 4 > 12) ? ((int)$month + 4 - 12) : ((int)$month + 4))) . "', a.zeinukigaku, 0)) - SUM(if (date_format(b.uriagebi, '%Y%m')='" . (((int)$month + 4 > 12) ? ((int)$year + 1) : $year) . sprintf('%02d', (((int)$month + 4 > 12) ? ((int)$month + 4 - 12) : ((int)$month + 4))) . "', a.genkagaku, 0)) AS  '5',
                        SUM(if (date_format(b.uriagebi, '%Y%m')='" . (((int)$month + 5 > 12) ? ((int)$year + 1) : $year) . sprintf('%02d', (((int)$month + 5 > 12) ? ((int)$month + 5 - 12) : ((int)$month + 5))) . "', a.zeinukigaku, 0)) - SUM(if (date_format(b.uriagebi, '%Y%m')='" . (((int)$month + 5 > 12) ? ((int)$year + 1) : $year) . sprintf('%02d', (((int)$month + 5 > 12) ? ((int)$month + 5 - 12) : ((int)$month + 5))) . "', a.genkagaku, 0)) AS  '6',
                        SUM(if (date_format(b.uriagebi, '%Y%m')='" . (((int)$month + 6 > 12) ? ((int)$year + 1) : $year) . sprintf('%02d', (((int)$month + 6 > 12) ? ((int)$month + 6 - 12) : ((int)$month + 6))) . "', a.zeinukigaku, 0)) - SUM(if (date_format(b.uriagebi, '%Y%m')='" . (((int)$month + 6 > 12) ? ((int)$year + 1) : $year) . sprintf('%02d', (((int)$month + 6 > 12) ? ((int)$month + 6 - 12) : ((int)$month + 6))) . "', a.genkagaku, 0)) AS  '7',
                        SUM(if (date_format(b.uriagebi, '%Y%m')='" . (((int)$month + 7 > 12) ? ((int)$year + 1) : $year) . sprintf('%02d', (((int)$month + 7 > 12) ? ((int)$month + 7 - 12) : ((int)$month + 7))) . "', a.zeinukigaku, 0)) - SUM(if (date_format(b.uriagebi, '%Y%m')='" . (((int)$month + 7 > 12) ? ((int)$year + 1) : $year) . sprintf('%02d', (((int)$month + 7 > 12) ? ((int)$month + 7 - 12) : ((int)$month + 7))) . "', a.genkagaku, 0)) AS  '8',
                        SUM(if (date_format(b.uriagebi, '%Y%m')='" . (((int)$month + 8 > 12) ? ((int)$year + 1) : $year) . sprintf('%02d', (((int)$month + 8 > 12) ? ((int)$month + 8 - 12) : ((int)$month + 8))) . "', a.zeinukigaku, 0)) - SUM(if (date_format(b.uriagebi, '%Y%m')='" . (((int)$month + 8 > 12) ? ((int)$year + 1) : $year) . sprintf('%02d', (((int)$month + 8 > 12) ? ((int)$month + 8 - 12) : ((int)$month + 8))) . "', a.genkagaku, 0)) AS  '9',
                        SUM(if (date_format(b.uriagebi, '%Y%m')='" . (((int)$month + 9 > 12) ? ((int)$year + 1) : $year) . sprintf('%02d', (((int)$month + 9 > 12) ? ((int)$month + 9 - 12) : ((int)$month + 9))) . "', a.zeinukigaku, 0)) - SUM(if (date_format(b.uriagebi, '%Y%m')='" . (((int)$month + 9 > 12) ? ((int)$year + 1) : $year) . sprintf('%02d', (((int)$month + 9 > 12) ? ((int)$month + 9 - 12) : ((int)$month + 9))) . "', a.genkagaku, 0)) AS  '10',
                        SUM(if (date_format(b.uriagebi, '%Y%m')='" . (((int)$month + 10 > 12) ? ((int)$year + 1) : $year) . sprintf('%02d', (((int)$month + 10 > 12) ? ((int)$month + 10 - 12) : ((int)$month + 10))) . "', a.zeinukigaku, 0)) - SUM(if (date_format(b.uriagebi, '%Y%m')='" . (((int)$month + 10 > 12) ? ((int)$year + 1) : $year) . sprintf('%02d', (((int)$month + 10 > 12) ? ((int)$month + 10 - 12) : ((int)$month + 10))) . "', a.genkagaku, 0)) AS  '11',
                        SUM(if (date_format(b.uriagebi, '%Y%m')='" . (((int)$month + 11 > 12) ? ((int)$year + 1) : $year) . sprintf('%02d', (((int)$month + 11 > 12) ? ((int)$month + 11 - 12) : ((int)$month + 11))) . "', a.zeinukigaku, 0)) - SUM(if (date_format(b.uriagebi, '%Y%m')='" . (((int)$month + 11 > 12) ? ((int)$year + 1) : $year) . sprintf('%02d', (((int)$month + 11 > 12) ? ((int)$month + 11 - 12) : ((int)$month + 11))) . "', a.genkagaku, 0)) AS  '12'
                    ";
                    break;
            }
            $db = \Phalcon\DI::getDefault()->get('db');
            $stmt = $db->prepare($select . $from . $where . $group . $order);
            $stmt->execute();
            $jisseki_rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // 予算テーブル
            list($year, $month, $day) = explode('-', $post_data["kikan_from"]);
            $select = "SELECT 
                yosan_junjo_cd AS 'key', 'Null' AS 'key_name',
                SUM(case when tuki = '" . sprintf('%d', $month) . "' then yosan else 0 end) as '1',
                SUM(case when tuki = '" . sprintf('%d',((int)$month + 1 > 12) ? ((int)$month + 1 - 12) : ((int)$month + 1)) . "' then yosan else 0 end) as '2',
                SUM(case when tuki = '" . sprintf('%d',((int)$month + 2 > 12) ? ((int)$month + 2 - 12) : ((int)$month + 2)) . "' then yosan else 0 end) as '3',
                SUM(case when tuki = '" . sprintf('%d',((int)$month + 3 > 12) ? ((int)$month + 3 - 12) : ((int)$month + 3)) . "' then yosan else 0 end) as '4',
                SUM(case when tuki = '" . sprintf('%d',((int)$month + 4 > 12) ? ((int)$month + 4 - 12) : ((int)$month + 4)) . "' then yosan else 0 end) as '5',
                SUM(case when tuki = '" . sprintf('%d',((int)$month + 5 > 12) ? ((int)$month + 5 - 12) : ((int)$month + 5)) . "' then yosan else 0 end) as '6',
                SUM(case when tuki = '" . sprintf('%d',((int)$month + 6 > 12) ? ((int)$month + 6 - 12) : ((int)$month + 6)) . "' then yosan else 0 end) as '7',
                SUM(case when tuki = '" . sprintf('%d',((int)$month + 7 > 12) ? ((int)$month + 7 - 12) : ((int)$month + 7)) . "' then yosan else 0 end) as '8',
                SUM(case when tuki = '" . sprintf('%d',((int)$month + 8 > 12) ? ((int)$month + 8 - 12) : ((int)$month + 8))  . "' then yosan else 0 end) as '9',
                SUM(case when tuki = '" . sprintf('%d',((int)$month + 9 > 12) ? ((int)$month + 9 - 12) : ((int)$month + 9)) . "' then yosan else 0 end) as '10',
                SUM(case when tuki = '" . sprintf('%d',((int)$month + 10 > 12) ? ((int)$month + 10 - 12) : ((int)$month + 10)) . "' then yosan else 0 end) as '11',
                SUM(case when tuki = '" . sprintf('%d',((int)$month + 11 > 12) ? ((int)$month + 11 - 12) : ((int)$month + 11))  . "' then yosan else 0 end) as '12'
            ";
            $from = " FROM yosan_dts AS a";
            $where = " WHERE 
                a.nendo = '{$year}' AND a.kingaku_arari_flg ={$post_data['hyouji_kbn']}
                AND a.yosan_junjo_flg = {$post_data['junjo_flg']}
            ";
            $group  = " GROUP BY yosan_junjo_cd";
            $stmt = $db->prepare($select . $from . $where . $group);
            $stmt->execute();
            $yosan_rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // 結合して、予算入力用配列を作成
            $yosan_settei_rows = []; // Viewへ渡す配列
            $index = 0;             // $rowsのインデックス
            $tmp_key = '';          // キーの比較用に実績のキーを一時保管
            $yosan_flg = false;     // 予算テーブルのキーと実績テーブルのキーの一致

            for ($i = 0; $i < (count($jisseki_rows) * 2); $i++) {
                if ($i % 2 === 0 ) {
                    // 偶数の場合、参考実績を入れる
                    $tmp_key = $jisseki_rows[$i / 2]['key'];
                    $yosan_settei_rows[$index] = $jisseki_rows[$i / 2];
                    $index++;
                } else {
                    // 奇数行は、予算入力行とする
                    for ($j = 0; $j < count($yosan_rows); $j++) {
                        if ($tmp_key === $yosan_rows[$j]['key']) {
                            $yosan_settei_rows[$index] = $yosan_rows[$j];
                            $yosan_settei_rows[$index]['key_name'] = $jisseki_rows[$i / 2]['key_name'];
                            $yosan_flg = true;
                            $index++;
                        }
                    }
                    if (!$yosan_flg) {
                        $yosan_settei_rows[$index] = ['key' => $tmp_key, 'key_name' => "{$jisseki_rows[$i / 2]['key_name']}", '1' => 0, '2' => 0, '3' => 0, '4' => 0, '5' => 0, '6' => 0, '7' => 0, '8' => 0, '9' => 0, '10' => 0, '11' => 0, '12' => 0];
                        $index++;
                    }
                    $yosan_flg = false;
                    $tmp_key = '';
                }
            }
            // 参考実績列計
            $sankou_kei = [
                '1' => array_sum(array_column($jisseki_rows, '1')),
                '2' => array_sum(array_column($jisseki_rows, '2')),
                '3' => array_sum(array_column($jisseki_rows, '3')),
                '4' => array_sum(array_column($jisseki_rows, '4')),
                '5' => array_sum(array_column($jisseki_rows, '5')),
                '6' => array_sum(array_column($jisseki_rows, '6')),
                '7' => array_sum(array_column($jisseki_rows, '7')),
                '8' => array_sum(array_column($jisseki_rows, '8')),
                '9' => array_sum(array_column($jisseki_rows, '9')),
                '10' => array_sum(array_column($jisseki_rows, '10')),
                '11' => array_sum(array_column($jisseki_rows, '11')),
                '12' => array_sum(array_column($jisseki_rows, '12')),
            ];
            // 予算列計
            $yosan_kei = [
                '1' => array_sum(array_column($yosan_rows, '1')),
                '2' => array_sum(array_column($yosan_rows, '2')),
                '3' => array_sum(array_column($yosan_rows, '3')),
                '4' => array_sum(array_column($yosan_rows, '4')),
                '5' => array_sum(array_column($yosan_rows, '5')),
                '6' => array_sum(array_column($yosan_rows, '6')),
                '7' => array_sum(array_column($yosan_rows, '7')),
                '8' => array_sum(array_column($yosan_rows, '8')),
                '9' => array_sum(array_column($yosan_rows, '9')),
                '10' => array_sum(array_column($yosan_rows, '10')),
                '11' => array_sum(array_column($yosan_rows, '11')),
                '12' => array_sum(array_column($yosan_rows, '12')),
            ];
            $this->view->sankou_kei = $sankou_kei;
            $this->view->yosan_kei = $yosan_kei;
            $this->view->year = $year;
            $this->view->month = $month;

            return $this->view->yosan_settei_rows = $yosan_settei_rows;
        }
    }

    /**
     * Upsert処理
     * yosan_index.jsよりPostで予算を受取り、予算データ更新
     *
     * @return \Phalcon\Http\Response
     */
    public function saveAjaxAction()
    {
        header("Content-type: text/plain; charset=UTF-8");
        $this->view->disable();
        $response = new \Phalcon\Http\Response();

        if (!$this->request->isAjax()) {
            echo "Error: Is Not AjaxAccess!!";
        }
        $post_flds = [
            'yosan_junjo_flg',
            'yosan_junjo_cd',
            'kingaku_arari_flg',
            'nendo',
            'tuki',
            'yosan',
        ];
        $post_data = $this->request->getPost();
        // 登録済み予算データの存在確認
        $yosan_dt = YosanDts::findFirst(
            [
                "yosan_junjo_flg = :yosan_junjo_flg: AND yosan_junjo_cd = :yosan_junjo_cd: 
                    AND kingaku_arari_flg = :kingaku_arari_flg: AND nendo = :nendo: AND tuki = :tuki:",
                "bind" => [
                    "yosan_junjo_flg" => $post_data['yosan_junjo_flg'],
                    "yosan_junjo_cd" => $post_data['yosan_junjo_cd'],
                    "kingaku_arari_flg" => $post_data['kingaku_arari_flg'],
                    "nendo" => $post_data['nendo'],
                    "tuki" => $post_data['tuki'],
                ],
            ]
        );

        // 新規-------------------------------------------------------
        if (!$yosan_dt) {
            $new_data = new YosanDts();
            $post_flds = [];
            $new_data->yosan_junjo_flg = $post_data["yosan_junjo_flg"];
            $new_data->yosan_junjo_cd = $post_data['yosan_junjo_cd'];
            $new_data->kingaku_arari_flg = $post_data['kingaku_arari_flg'];
            $new_data->nendo = $post_data['nendo'];
            $new_data->tuki = $post_data['tuki'];
            $new_data->yosan = $post_data['yosan'];
            $thisPost = [];
            foreach ($post_flds as $post_fld) {
                $yosan_dt->$post_fld = array_key_exists($post_fld, $thisPost) ? $thisPost[$post_fld] : $this->request->getPost($post_fld);
            }
            // 失敗
            if (!$new_data->save()) {
                $msg = '';
                foreach ($new_data->getMessages() as $message) {
                    $msg .= ":{$message}";
                }
                $response->setContent(json_encode($msg));
                return $response;
            }
            $response->setContent(json_encode('Insert/OK'));
            return $response;
        }

        // 更新------------------------------------------------------
        // DBより取得した予算データが、POSTデータと一致しなければ変更あり
        $chg_flg = 0;
        foreach ($post_flds as $post_fld) {
            if ($yosan_dt->$post_fld != $this->request->getPost($post_fld)) {
                $chg_flg = 1;
                break;
            }
        }
        if ($chg_flg === 0) {
            $response->setContent(json_encode('NoChange'));
            return $response;
        }
        foreach ($post_flds as $post_fld) {
            $yosan_dt->$post_fld = $this->request->getPost($post_fld);
        }
        if (!$yosan_dt->save()) {
            $response->setContent(json_encode($yosan_dt->getMessage()));
            return $response;
        }

        $this->_bakOut($yosan_dt);

        $response->setContent(json_encode('Update/OK'));
        return $response;
    }

    /**
     * Back Out a yosan_dts
     *
     * @param string $yosan_dt , $dlt_flg
     */
    public function _bakOut($yosan_dt)
    {
        $bak_yosan_dt = new BakYosanDts();
        foreach ($yosan_dt as $fld => $value) {
            $bak_yosan_dt->$fld = $yosan_dt->$fld;
        }
        $bak_yosan_dt->id = NULL;
        $bak_yosan_dt->id_moto = $yosan_dt->id;
        $bak_yosan_dt->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_yosan_dt->hikae_nichiji = date("Y-m-d H:i:s");
        if (!$bak_yosan_dt->save()) {
            foreach ($bak_yosan_dt->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
    }

}
