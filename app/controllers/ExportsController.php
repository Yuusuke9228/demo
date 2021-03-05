<?php

use Phalcon\Mvc\Controller;

class ExportsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction($exp = null)
    {

        $export_yy_logs = ExportYyLogs::find([
            'conditions' => 'cd = "shiire"',
            'order' => 'created DESC',
            'limit' => 5]);
        if ($export_yy_logs) {
            $this->tag->setDefault('time_from', $export_yy_logs[0]->time_to);
        } else {
            $this->tag->setDefault('time_from', date('Y-m-01 00:00:00', time()));
        }
        $uri_export_yy_logs = ExportYyLogs::find([
            'conditions' => 'cd = "uriage"',
            'order' => 'created DESC',
            'limit' => 5]);
        if ($uri_export_yy_logs) {
            $this->tag->setDefault('uri_time_from', $uri_export_yy_logs[0]->time_to);
        } else {
            $this->tag->setDefault('uri_time_from', date('Y-m-01 00:00:00', time()));
        }
        if ($this->request->isPost()) {
            if ($exp == 'shiire') {
                $time_from = $this->request->getPost('time_from');
                $time_to = $this->request->getPost('time_to');
                $yayoi_den_no = $this->request->getPost('yayoi_den_no');
                $this->view->exp = $this->url->get('exports/shiire')
                    . '?time_from=' . $time_from
                    . '&time_to=' . $time_to
                    . '&yayoi_den_no=' . $yayoi_den_no; // index画面を表示と同時にexportする。仕組み→app/views/index.volt
                $this->tag->setDefault('time_from', $time_from);
                $this->tag->setDefault('time_to', $time_to);
                $this->tag->setDefault('yayoi_den_no', $yayoi_den_no);
                $this->tag->setDefault('uri_time_to', $time_to);
                $this->flash->notice("弥生向け仕入エクスポートを作成しました。");
            } else if ($exp == 'uriage') {
                $uri_time_from = $this->request->getPost('uri_time_from');
                $uri_time_to = $this->request->getPost('uri_time_to');
                $uri_yayoi_den_no = $this->request->getPost('uri_yayoi_den_no');
                $this->view->exp = $this->url->get('exports/uriage')
                    . '?uri_time_from=' . $uri_time_from
                    . '&uri_time_to=' . $uri_time_to
                    . '&uri_yayoi_den_no=' . $uri_yayoi_den_no; // index画面を表示と同時にexportする。仕組み→app/views/index.volt
                $this->tag->setDefault('uri_time_from', $uri_time_from);
                $this->tag->setDefault('uri_time_to', $uri_time_to);
                $this->tag->setDefault('uri_yayoi_den_no', $uri_yayoi_den_no);
                $this->tag->setDefault('time_to', $uri_time_to);
                $this->flash->notice("弥生向け売上を作成しました。");
            }
        } else {
            $this->tag->setDefault('time_to', date('Y-m-d H:i:s'));
            $this->tag->setDefault('uri_time_to', date('Y-m-d H:i:s'));
        }
        $this->view->export_yy_logs = $export_yy_logs;
        $this->view->uri_export_yy_logs = $uri_export_yy_logs;
    }

    /**
     * 仕入 action
     */
    public function shiireAction()
    {

        if ($this->request->isPost()) {
            $time_from = $this->request->getPost('time_from');
            $time_to = $this->request->getPost('time_to');
            $yayoi_den_no = $this->request->getPost('yayoi_den_no');
        } else {
            $time_from = $this->request->getQuery('time_from');
            $time_to = $this->request->getQuery('time_to');
            $yayoi_den_no = $this->request->getQuery('yayoi_den_no');
        }
        $time_from = $time_from ?? "2018-08-01 12:30:00";
        $time_to = $time_to ?? "2018-08-10 23:00:00";
//		$yayoi_den_no = $yayoi_den_no??51000;

        $config = $this->db->getDescriptor();
        $filePath = __DIR__ . '/temp/';
        $fileName = "Shinlist_Ph" . date("Ymd", strtotime($time_to)) . ".csv";

        $csvarys = [];
//		削除マーク,締めフラグ,消込チェック,日付,伝票№,伝票種別,取引区分,税転嫁,金額は数処理,税端数処理,得意先,納入先,担当コード,行番号,明細区分,商品コード,支払区分コード,商品名,課税区分,単位,入り数,ケース,倉庫コード,数量,単価,金額,回収予定日,税抜額,原価,原単価,備考,数量小数桁,単価小数桁,企画,色,サイズ,空白,空白,空白,得意先略称,プロジェクト,プロジェクト副,予備1,予備2,予備3,予備4,予備5,予備6,予備7,予備8,予備9,予備10,得意先名称

        $shiire_dts = ShiireDts::find([
            'order' => 'cd',
            'conditions' => 'created > ?1 and created <= ?2',
            'bind' => [1 => $time_from, 2 => $time_to],
        ]);
//		$csvarys[]=[$time_from,$time_to,$yayoi_den_no,count($shiire_dts)]; // デバッグ行。本番ではコメントアウト。

        $yayoi_den_no_s = $yayoi_den_no; // $shiire_dts[0]->cd;
        $yayoi_den_no += 1;
        foreach ($shiire_dts as $shiire_dt) {
            $yayoi_gyou = 0;
            $yayoi99zeigaku = 0;
            foreach ($shiire_dt->ShiireMeisaiDts as $meisai_dt) {
                if ($meisai_dt->UtiwakeKbns->yayoi_kbn) { // 通常など弥生区分該当のときだけ出力
                    $yayoi_gyou += 1;
                    $csvary = []; // 初期化
                    $csvary[0] = 1; // 削除マーク
                    $csvary[1] = 1 + $shiire_dt->shimekiri_flg; // 締めフラグ
                    $csvary[2] = 0; // 消込チェック
                    $csvary[3] = date('Ymd', strtotime($shiire_dt->shiirebi)); // 日付
                    $csvary[4] = $yayoi_den_no; // 伝票№ $shiire_dt->cd;
                    $csvary[5] = 14; // 伝票種別:14=仕入
                    $csvary[6] = $shiire_dt->torihiki_kbn_cd; // 取引区分
                    $csvary[7] = $shiire_dt->ZeitenkaKbns->yayoi_kbn; // 税転嫁
                    $csvary[8] = $shiire_dt->ShiiresakiMrs->gaku_hasuu_shori_kbn_cd; // 金額端数処理
                    $csvary[9] = $shiire_dt->ShiiresakiMrs->zei_hasuu_shori_kbn_cd; // 税端数処理
                    $csvary[10] = $shiire_dt->shiiresaki_mr_cd; // 得意先
                    $csvary[11] = ''; // 納入先(売上用)
                    $csvary[12] = $shiire_dt->tantou_mr_cd; // 担当コード
                    $csvary[13] = $yayoi_gyou; // 行番号
                    $csvary[14] = $meisai_dt->UtiwakeKbns->yayoi_kbn; // 明細区分
                    $csvary[15] = $meisai_dt->shouhin_mr_cd; // 商品コード
                    $csvary[16] = ''; // 支払区分コード
                    $csvary[17] = $meisai_dt->tekiyou; // 商品名
                    $csvary[18] = $meisai_dt->zeiritu_mr_cd; // 課税区分,
                    $TanniMrCd = 'TanniMr' . $meisai_dt->tanka_kbn . 's';
                    $csvary[20] = $meisai_dt->$TanniMrCd->name; // 単位,
                    $csvary[21] = 0; // $meisai_dt->irisuu; // 入り数,小数点がエラーなので送らない
                    $csvary[22] = 0; // ケース,
                    $csvary[23] = $meisai_dt->souko_mr_cd; // 倉庫コード,
                    $suuryou = 'suuryou' . $meisai_dt->tanka_kbn;
                    $csvary[24] = $meisai_dt->$suuryou; // 数量,
                    $csvary[25] = $meisai_dt->tanka; // 単価,
                    $csvary[26] = $meisai_dt->kingaku; // 金額,
                    $csvary[27] = ''; // 回収予定日,
                    $csvary[28] = $meisai_dt->zeinukigaku; // 税抜額,
                    $csvary[29] = ''; // 原価,
                    $csvary[30] = ''; // 原単価,
                    $csvary[31] = $meisai_dt->bikou; // 備考,
                    $suu_shousuu = 'suu' . $meisai_dt->tanka_kbn . '_shousuu';
                    $csvary[32] = $meisai_dt->ShouhinMrs->$suu_shousuu; // 数量小数桁,
                    $csvary[33] = $meisai_dt->ShouhinMrs->tanka_shousuu; // 単価小数桁,
                    $csvary[34] = $shiire_dt->cd; // 企画,隼伝票番号
                    $csvary[35] = $meisai_dt->iro; // 色,
                    $csvary[36] = $meisai_dt->size; // サイズ,
                    $csvary[37] = ''; // 空白,
                    $csvary[38] = ''; // 空白,
                    $csvary[39] = ''; // 空白,
                    $csvary[40] = $shiire_dt->ShiiresakiMrs->name; // 得意先名称
                    $csvary[41] = ''; // プロジェクト,
                    $csvary[42] = ''; // プロジェクト副,
                    $csvary[43] = ''; // 予備1,
                    $csvary[44] = ''; // 予備2,
                    $csvary[45] = ''; // 予備3,
                    $csvary[46] = ''; // 予備4,
                    $csvary[47] = ''; // 予備5,
                    $csvary[48] = ''; // 予備6,
                    $csvary[49] = ''; // 予備7,
                    $csvary[50] = ''; // 予備8,
                    $csvary[51] = ''; // 予備9,
                    $csvary[52] = ''; // 予備10,
                    $csvary[53] = $shiire_dt->ShiiresakiMrs->ryakushou; // 得意先略称,
                    $yayoi99zeigaku += $meisai_dt->zeigaku;
                    $csvarys[] = $csvary;
                }
            }
            if ($yayoi99zeigaku) {
                $yayoi_gyou += 1;
                $csvary = []; // 初期化
                $csvary[0] = 1; // 削除マーク
                $csvary[1] = 1 + $shiire_dt->shimekiri_flg; // 締めフラグ
                $csvary[2] = 0; // 消込チェック
                $csvary[3] = date('Ymd', strtotime($shiire_dt->shiirebi)); // 日付
                $csvary[4] = $yayoi_den_no; // 伝票№ $shiire_dt->cd;
                $csvary[5] = 14; // 伝票種別:14=仕入
                $csvary[6] = $shiire_dt->torihiki_kbn_cd; // 取引区分
                $csvary[7] = $shiire_dt->ZeitenkaKbns->yayoi_kbn; // 税転嫁
                $csvary[8] = $shiire_dt->ShiiresakiMrs->gaku_hasuu_shori_kbn_cd; // 金額端数処理
                $csvary[9] = $shiire_dt->ShiiresakiMrs->zei_hasuu_shori_kbn_cd; // 税端数処理
                $csvary[10] = $shiire_dt->shiiresaki_mr_cd; // 得意先
                $csvary[11] = ''; // 納入先(売上用)
                $csvary[12] = $shiire_dt->tantou_mr_cd; // 担当コード
                $csvary[13] = $yayoi_gyou; // 行番号
                $csvary[14] = 99; // 明細区分
                $csvary[15] = ''; // 商品コード
                $csvary[16] = ''; // 支払区分コード
                $csvary[17] = '消費税'; // 商品名
                $csvary[18] = 0; // 課税区分,
                $csvary[20] = ''; // 単位,
                $csvary[21] = 0; // 入り数,
                $csvary[22] = 0; // ケース,
                $csvary[23] = ''; // 倉庫コード,
                $csvary[24] = 0; // 数量,
                $csvary[25] = 0; // 単価,
                $csvary[26] = $yayoi99zeigaku; // 金額,
                $csvary[27] = ''; // 回収予定日,
                $csvary[28] = 0; // 税抜額,
                $csvary[29] = 0; // 原価,
                $csvary[30] = 0; // 原単価,
                $csvary[31] = ''; // 備考,
                $csvary[32] = 0; // 数量小数桁,
                $csvary[33] = 0; // 単価小数桁,
                $csvary[34] = ''; // 企画,隼伝票番号
                $csvary[35] = ''; // 色,
                $csvary[36] = ''; // サイズ,
                $csvary[37] = ''; // 空白,
                $csvary[38] = ''; // 空白,
                $csvary[39] = ''; // 空白,
                $csvary[40] = $shiire_dt->ShiiresakiMrs->name; // 得意先名称
                $csvary[41] = ''; // プロジェクト,
                $csvary[42] = ''; // プロジェクト副,
                $csvary[43] = ''; // 予備1,
                $csvary[44] = ''; // 予備2,
                $csvary[45] = ''; // 予備3,
                $csvary[46] = ''; // 予備4,
                $csvary[47] = ''; // 予備5,
                $csvary[48] = ''; // 予備6,
                $csvary[49] = ''; // 予備7,
                $csvary[50] = ''; // 予備8,
                $csvary[51] = ''; // 予備9,
                $csvary[52] = ''; // 予備10,
                $csvary[53] = $shiire_dt->ShiiresakiMrs->ryakushou; // 得意先略称,
                $csvarys[] = $csvary;
            }
            if ($yayoi_gyou && trim($shiire_dt->tekiyou)) {
                $yayoi_gyou += 1;
                $csvary = []; // 初期化
                $csvary[0] = 1; // 削除マーク
                $csvary[1] = 1 + $shiire_dt->shimekiri_flg; // 締めフラグ
                $csvary[2] = 0; // 消込チェック
                $csvary[3] = date('Ymd', strtotime($shiire_dt->shiirebi)); // 日付
                $csvary[4] = $yayoi_den_no; // 伝票№ $shiire_dt->cd;
                $csvary[5] = 14; // 伝票種別:14=仕入
                $csvary[6] = $shiire_dt->torihiki_kbn_cd; // 取引区分
                $csvary[7] = $shiire_dt->ZeitenkaKbns->yayoi_kbn; // 税転嫁
                $csvary[8] = $shiire_dt->ShiiresakiMrs->gaku_hasuu_shori_kbn_cd; // 金額端数処理
                $csvary[9] = $shiire_dt->ShiiresakiMrs->zei_hasuu_shori_kbn_cd; // 税端数処理
                $csvary[10] = $shiire_dt->shiiresaki_mr_cd; // 得意先
                $csvary[11] = ''; // 納入先(売上用)
                $csvary[12] = $shiire_dt->tantou_mr_cd; // 担当コード
                $csvary[13] = $yayoi_gyou; // 行番号
                $csvary[14] = 0; // 明細区分
                $csvary[15] = ''; // 商品コード
                $csvary[16] = ''; // 支払区分コード
                $csvary[17] = $shiire_dt->tekiyou; // 商品名
                $csvary[18] = 0; // 課税区分,
                $csvary[20] = ''; // 単位,
                $csvary[21] = 0; // 入り数,
                $csvary[22] = 0; // ケース,
                $csvary[23] = ''; // 倉庫コード,
                $csvary[24] = 0; // 数量,
                $csvary[25] = 0; // 単価,
                $csvary[26] = 0; // 金額,
                $csvary[27] = ''; // 回収予定日,
                $csvary[28] = 0; // 税抜額,
                $csvary[29] = 0; // 原価,
                $csvary[30] = 0; // 原単価,
                $csvary[31] = ''; // 備考,
                $csvary[32] = 0; // 数量小数桁,
                $csvary[33] = 0; // 単価小数桁,
                $csvary[34] = ''; // 企画,隼伝票番号
                $csvary[35] = ''; // 色,
                $csvary[36] = ''; // サイズ,
                $csvary[37] = ''; // 空白,
                $csvary[38] = ''; // 空白,
                $csvary[39] = ''; // 空白,
                $csvary[40] = $shiire_dt->ShiiresakiMrs->name; // 得意先名称
                $csvary[41] = ''; // プロジェクト,
                $csvary[42] = ''; // プロジェクト副,
                $csvary[43] = ''; // 予備1,
                $csvary[44] = ''; // 予備2,
                $csvary[45] = ''; // 予備3,
                $csvary[46] = ''; // 予備4,
                $csvary[47] = ''; // 予備5,
                $csvary[48] = ''; // 予備6,
                $csvary[49] = ''; // 予備7,
                $csvary[50] = ''; // 予備8,
                $csvary[51] = ''; // 予備9,
                $csvary[52] = ''; // 予備10,
                $csvary[53] = $shiire_dt->ShiiresakiMrs->ryakushou; // 得意先略称,
                $csvarys[] = $csvary;
            }
            if ($yayoi_gyou) {
                $yayoi_den_no += 1;
            }
        }

        /*
        echo "\n<pre>";
        print_r($csvarys);
        echo "\n</pre>";
        */

        stream_filter_register('crlf', 'crlf_filter');
        $file = fopen($filePath . $fileName, "w");
        if ($file) {
            stream_filter_prepend($file, 'convert.iconv.utf-8/cp932'); // 文字化け防止
            stream_filter_append($file, 'crlf');
            foreach ($csvarys as $csvary) {
                fputcsv($file, $csvary);
            }
            fclose($file);

            // csvファイルをクライアントに出力 ----------------------------
            $response = new \Phalcon\Http\Response(); // Redirect output to a client's web browser (csv)
            $response->setHeader('Content-Disposition', 'attachment;filename="' . $fileName . '"');
            $response->setHeader('Cache-Control', 'max-age=0');
            //	$response->setHeader('Cache-Control', 'max-age=1'); // If you're serving to IE 9, then the following may be needed
            $response->setContent(file_get_contents($filePath . $fileName)); //Set the content of the response
            unlink($filePath . $fileName); // delete temp file
            $this->flash->notice("弥生向け仕入エクスポートを作成しました。" . $fileName);

            $export_yy_log = new ExportYyLogs(); // 移出記録に書きだし
            $export_yy_log->cd = 'shiire';
            $export_yy_log->time_from = $time_from;
            $export_yy_log->time_to = $time_to;
            $export_yy_log->name = $yayoi_den_no_s;
            $export_yy_log->den_no_to = $yayoi_den_no - 1;
            if (!$export_yy_log->save()) {
                foreach ($export_yy_log->getMessages() as $message) {
                    $this->flash->error($message);
                }
            }

            return $response; //Return the response

        } else {
            $this->flash->error("仕入エクスポートに失敗しました。(" . $fileName . ")");
            $this->view->exp = null;
        }

    }

    /**
     * 売上 action
     */
    public function uriageAction()
    {
        if ($this->request->isPost()) {
            $time_from = $this->request->getPost('uri_time_from');
            $time_to = $this->request->getPost('uri_time_to');
            $yayoi_den_no = $this->request->getPost('uri_yayoi_den_no');
        } else {
            $time_from = $this->request->getQuery('uri_time_from');
            $time_to = $this->request->getQuery('uri_time_to');
            $yayoi_den_no = $this->request->getQuery('uri_yayoi_den_no');
        }
        $time_from = $time_from ?? "2018-08-01 12:30:00";
        $time_to = $time_to ?? "2018-08-10 16:00:00";
        $yayoi_den_no = $yayoi_den_no ?? 51000;

//echo "\n<br>start";
        $config = $this->db->getDescriptor();
        $filePath = __DIR__ . '/temp/';
        $fileName = "Urinlist_Ph" . date("Ymd", strtotime($time_to)) . ".csv";

        $csvarys = [];
//		削除マーク,締めフラグ,消込チェック,日付,伝票№,伝票種別,取引区分,税転嫁,金額は数処理,税端数処理,得意先,納入先,担当コード,行番号,明細区分,商品コード,支払区分コード,商品名,課税区分,単位,入り数,ケース,倉庫コード,数量,単価,金額,回収予定日,税抜額,原価,原単価,備考,数量小数桁,単価小数桁,企画,色,サイズ,空白,空白,空白,得意先略称,プロジェクト,プロジェクト副,予備1,予備2,予備3,予備4,予備5,予備6,予備7,予備8,予備9,予備10,得意先名称

        $uriage_dts = UriageDts::find(
            ['order' => 'cd'
                , 'conditions' => 'created > ?1 and created <= ?2',
                'bind' => [1 => $time_from, 2 => $time_to]]);

//		$csvarys[]=[$time_from,$time_to,$yayoi_den_no,count($uriage_dts)]; // デバッグ行。本番ではコメントアウト。

        $yayoi_den_no_s = $yayoi_den_no;
        $yayoi_den_no += 1;
        foreach ($uriage_dts as $uriage_dt) {
            $yayoi_gyou = 0;
            $yayoi99zeigaku = 0;
            foreach ($uriage_dt->UriageMeisaiDts as $meisai_dt) {
                if ($meisai_dt->UtiwakeKbns->yayoi_kbn) { // 通常など弥生区分該当のときだけ出力
                    $yayoi_gyou += 1;
                    $csvary = []; // 初期化
                    $csvary[0] = 1; // 削除マーク
                    $csvary[1] = 1 + $uriage_dt->shimekiri_flg; // 締めフラグ
                    $csvary[2] = 0; // 消込チェック
                    $csvary[3] = date('Ymd', strtotime($uriage_dt->uriagebi)); // 日付
                    $csvary[4] = $yayoi_den_no; // 伝票№
                    $csvary[5] = 24; // 伝票種別:24=売上
                    $csvary[6] = $uriage_dt->torihiki_kbn_cd; // 取引区分
                    $csvary[7] = $uriage_dt->ZeitenkaKbns->yayoi_kbn; // 税転嫁
                    $csvary[8] = $uriage_dt->TokuisakiMrs->gaku_hasuu_shori_kbn_cd; // 金額端数処理
                    $csvary[9] = $uriage_dt->TokuisakiMrs->zei_hasuu_shori_kbn_cd; // 税端数処理
                    $csvary[10] = $uriage_dt->tokuisaki_mr_cd; // 得意先
                    $csvary[11] = $uriage_dt->nounyuusaki_mr_cd; // 納入先(売上用)
                    $csvary[12] = $uriage_dt->tantou_mr_cd; // 担当コード
                    $csvary[13] = $yayoi_gyou; // 行番号
                    $csvary[14] = $meisai_dt->UtiwakeKbns->yayoi_kbn; // 明細区分
                    $csvary[15] = $meisai_dt->shouhin_mr_cd; // 商品コード
                    $csvary[16] = '2'; // 入金区分コード
                    $csvary[17] = $meisai_dt->tekiyou; // 商品名
                    $csvary[18] = $meisai_dt->zeiritu_mr_cd; // 課税区分,
                    $TanniMrCd = 'TanniMr' . $meisai_dt->tanka_kbn . 's';
                    $csvary[20] = $meisai_dt->$TanniMrCd->name; // 単位,
                    $csvary[21] = 0; // $meisai_dt->irisuu; // 入り数,小数点がエラーなので送らない
                    $csvary[22] = 0; // ケース,
                    $csvary[23] = $meisai_dt->souko_mr_cd; // 倉庫コード,
                    $suuryou = 'suuryou' . $meisai_dt->tanka_kbn;
                    $csvary[24] = $meisai_dt->$suuryou; // 数量,
                    $csvary[25] = $meisai_dt->tanka; // 単価,
                    $csvary[26] = $meisai_dt->kingaku; // 金額,
                    $csvary[27] = ''; // 回収予定日,
                    $csvary[28] = $meisai_dt->zeinukigaku; // 税抜額,
                    $csvary[29] = ''; // 原価 (インポートの場合は「空白」)
                    $csvary[30] = $meisai_dt->gentanka; // 原単価,
                    $csvary[31] = $meisai_dt->bikou; // 備考,
                    $suu_shousuu = 'suu' . $meisai_dt->tanka_kbn . '_shousuu';
                    $csvary[32] = $meisai_dt->ShouhinMrs->$suu_shousuu; // 数量小数桁,
                    $csvary[33] = $meisai_dt->ShouhinMrs->tanka_shousuu; // 単価小数桁,
                    $csvary[34] = $uriage_dt->cd; // 企画,隼伝票番号
                    $csvary[35] = $meisai_dt->iro; // 色,
                    $csvary[36] = $meisai_dt->size; // サイズ,
                    $csvary[37] = $uriage_dt->nounyuu_kijitu; // 納入期日,
                    $csvary[38] = ''; // 統一伝票などに印刷する分類コード,
                    $csvary[39] = $uriage_dt->denpyou_kbn; // 伝票区分,
                    $csvary[40] = $uriage_dt->TokuisakiMrs->name; // 得意先名称
                    $csvary[41] = ''; // プロジェクト,
                    $csvary[42] = ''; // プロジェクト副,
                    $csvary[43] = ''; // 予備1,
                    $csvary[44] = ''; // 予備2,
                    $csvary[45] = ''; // 予備3,
                    $csvary[46] = ''; // 予備4,
                    $csvary[47] = ''; // 予備5,
                    $csvary[48] = ''; // 予備6,
                    $csvary[49] = ''; // 予備7,
                    $csvary[50] = ''; // 予備8,
                    $csvary[51] = ''; // 予備9,
                    $csvary[52] = ''; // 予備10,
                    $csvary[53] = $uriage_dt->TokuisakiMrs->ryakushou; // 得意先略称,
                    $yayoi99zeigaku += $meisai_dt->zeigaku;
                    $csvarys[] = $csvary;
                }
            }
            if ($yayoi99zeigaku) {
                $yayoi_gyou += 1;
                $csvary = []; // 初期化
                $csvary[0] = 1; // 削除マーク
                $csvary[1] = 1 + $uriage_dt->shimekiri_flg; // 締めフラグ
                $csvary[2] = 0; // 消込チェック
                $csvary[3] = date('Ymd', strtotime($uriage_dt->uriagebi)); // 日付
                $csvary[4] = $yayoi_den_no; // 伝票№
                $csvary[5] = 24; // 伝票種別:24=売上
                $csvary[6] = $uriage_dt->torihiki_kbn_cd; // 取引区分
                $csvary[7] = $uriage_dt->ZeitenkaKbns->yayoi_kbn; // 税転嫁
                $csvary[8] = $uriage_dt->TokuisakiMrs->gaku_hasuu_shori_kbn_cd; // 金額端数処理
                $csvary[9] = $uriage_dt->TokuisakiMrs->zei_hasuu_shori_kbn_cd; // 税端数処理
                $csvary[10] = $uriage_dt->tokuisaki_mr_cd; // 得意先
                $csvary[11] = $uriage_dt->nounyuusaki_mr_cd; // 納入先(売上用)
                $csvary[12] = $uriage_dt->tantou_mr_cd; // 担当コード
                $csvary[13] = $yayoi_gyou; // 行番号
                $csvary[14] = 99; // 明細区分
                $csvary[15] = ''; // 商品コード
                $csvary[16] = ''; // 支払区分コード
                $csvary[17] = '消費税'; // 商品名
                $csvary[18] = 0; // 課税区分,
                $csvary[20] = ''; // 単位,
                $csvary[21] = 0; // 入り数,
                $csvary[22] = 0; // ケース,
                $csvary[23] = ''; // 倉庫コード,
                $csvary[24] = 0; // 数量,
                $csvary[25] = 0; // 単価,
                $csvary[26] = $yayoi99zeigaku; // 金額,
                $csvary[27] = ''; // 回収予定日,
                $csvary[28] = 0; // 税抜額,
                $csvary[29] = 0; // 原価,
                $csvary[30] = 0; // 原単価,
                $csvary[31] = ''; // 備考,
                $csvary[32] = 0; // 数量小数桁,
                $csvary[33] = 0; // 単価小数桁,
                $csvary[34] = ''; // 企画,隼伝票番号
                $csvary[35] = ''; // 色,
                $csvary[36] = ''; // サイズ,
                $csvary[37] = $uriage_dt->nounyuu_kijitu; // 納入期日,
                $csvary[38] = ''; // 統一伝票などに印刷する分類コード,
                $csvary[39] = $uriage_dt->denpyou_kbn; // 伝票区分,
                $csvary[40] = $uriage_dt->TokuisakiMrs->name; // 得意先名称
                $csvary[41] = ''; // プロジェクト,
                $csvary[42] = ''; // プロジェクト副,
                $csvary[43] = ''; // 予備1,
                $csvary[44] = ''; // 予備2,
                $csvary[45] = ''; // 予備3,
                $csvary[46] = ''; // 予備4,
                $csvary[47] = ''; // 予備5,
                $csvary[48] = ''; // 予備6,
                $csvary[49] = ''; // 予備7,
                $csvary[50] = ''; // 予備8,
                $csvary[51] = ''; // 予備9,
                $csvary[52] = ''; // 予備10,
                $csvary[53] = $uriage_dt->TokuisakiMrs->ryakushou; // 得意先略称,
                $csvarys[] = $csvary;
            }
            if ($yayoi_gyou && trim($uriage_dt->tekiyou)) {
                $yayoi_gyou += 1;
                $csvary = []; // 初期化
                $csvary[0] = 1; // 削除マーク
                $csvary[1] = 1 + $uriage_dt->shimekiri_flg; // 締めフラグ
                $csvary[2] = 0; // 消込チェック
                $csvary[3] = date('Ymd', strtotime($uriage_dt->uriagebi)); // 日付
                $csvary[4] = $yayoi_den_no; // 伝票№
                $csvary[5] = 24; // 伝票種別:24=売上
                $csvary[6] = $uriage_dt->torihiki_kbn_cd; // 取引区分
                $csvary[7] = $uriage_dt->ZeitenkaKbns->yayoi_kbn; // 税転嫁
                $csvary[8] = $uriage_dt->TokuisakiMrs->gaku_hasuu_shori_kbn_cd; // 金額端数処理
                $csvary[9] = $uriage_dt->TokuisakiMrs->zei_hasuu_shori_kbn_cd; // 税端数処理
                $csvary[10] = $uriage_dt->tokuisaki_mr_cd; // 得意先
                $csvary[11] = $uriage_dt->nounyuusaki_mr_cd; // 納入先(売上用)
                $csvary[12] = $uriage_dt->tantou_mr_cd; // 担当コード
                $csvary[13] = $yayoi_gyou; // 行番号
                $csvary[14] = 0; // 明細区分
                $csvary[15] = ''; // 商品コード
                $csvary[16] = ''; // 支払区分コード
                $csvary[17] = $uriage_dt->tekiyou; // 商品名
                $csvary[18] = 0; // 課税区分,
                $csvary[20] = ''; // 単位,
                $csvary[21] = 0; // 入り数,
                $csvary[22] = 0; // ケース,
                $csvary[23] = ''; // 倉庫コード,
                $csvary[24] = 0; // 数量,
                $csvary[25] = 0; // 単価,
                $csvary[26] = 0; // 金額,
                $csvary[27] = ''; // 回収予定日,
                $csvary[28] = 0; // 税抜額,
                $csvary[29] = 0; // 原価,
                $csvary[30] = 0; // 原単価,
                $csvary[31] = ''; // 備考,
                $csvary[32] = 0; // 数量小数桁,
                $csvary[33] = 0; // 単価小数桁,
                $csvary[34] = ''; // 企画,隼伝票番号
                $csvary[35] = ''; // 色,
                $csvary[36] = ''; // サイズ,
                $csvary[37] = $uriage_dt->nounyuu_kijitu; // 納入期日,
                $csvary[38] = ''; // 統一伝票などに印刷する分類コード,
                $csvary[39] = $uriage_dt->denpyou_kbn; // 伝票区分,
                $csvary[40] = $uriage_dt->TokuisakiMrs->name; // 得意先名称
                $csvary[41] = ''; // プロジェクト,
                $csvary[42] = ''; // プロジェクト副,
                $csvary[43] = ''; // 予備1,
                $csvary[44] = ''; // 予備2,
                $csvary[45] = ''; // 予備3,
                $csvary[46] = ''; // 予備4,
                $csvary[47] = ''; // 予備5,
                $csvary[48] = ''; // 予備6,
                $csvary[49] = ''; // 予備7,
                $csvary[50] = ''; // 予備8,
                $csvary[51] = ''; // 予備9,
                $csvary[52] = ''; // 予備10,
                $csvary[53] = $uriage_dt->TokuisakiMrs->ryakushou; // 得意先略称,
                $csvarys[] = $csvary;
            }
            if ($yayoi_gyou) {
                $yayoi_den_no += 1;
            }
        }
        /*
        echo "\n<pre>";
        print_r($csvarys);
        echo "\n</pre>";
        */

        stream_filter_register('crlf', 'crlf_filter');
        $file = fopen($filePath . $fileName, "w");
        if ($file) {
            stream_filter_prepend($file, 'convert.iconv.utf-8/cp932'); // 文字化け防止
            stream_filter_append($file, 'crlf');
            foreach ($csvarys as $csvary) {
                fputcsv($file, $csvary);
            }
            fclose($file);

            // csvファイルをクライアントに出力 ----------------------------
            $response = new \Phalcon\Http\Response(); // Redirect output to a client's web browser (csv)
            $response->setHeader('Content-Disposition', 'attachment;filename="' . $fileName . '"');
            $response->setHeader('Cache-Control', 'max-age=0');
            //	$response->setHeader('Cache-Control', 'max-age=1'); // If you're serving to IE 9, then the following may be needed
            $response->setContent(file_get_contents($filePath . $fileName)); //Set the content of the response
            unlink($filePath . $fileName); // delete temp file
            $this->flash->success("弥生向け売上エクスポートを作成しました。" . $fileName);

            $export_yy_log = new ExportYyLogs(); // 移出記録に書きだし
            $export_yy_log->cd = 'uriage';
            $export_yy_log->time_from = $time_from;
            $export_yy_log->time_to = $time_to;
            $export_yy_log->name = $yayoi_den_no_s;
            $export_yy_log->den_no_to = $yayoi_den_no - 1;
            if (!$export_yy_log->save()) {
                foreach ($export_yy_log->getMessages() as $message) {
                    $this->flash->error($message);
                }
            }

            return $response; //Return the response

        } else {
            $this->flash->error("売上エクスポートに失敗しました。(" . $fileName . ")");
            $this->view->exp = null;
        }

    }

    /**
     * Yayoi action
     */
    public function yayoiAction($exp = null)
    {
        $export_yy_logs = ExportYyLogs::find([
            'conditions' => 'cd = "shiire"',
            'order' => 'created DESC',
            'limit' => 5]);
        if ($export_yy_logs) {
            $this->tag->setDefault('time_from', $export_yy_logs[0]->time_to);
        } else {
            $this->tag->setDefault('time_from', date('Y-m-01 00:00:00', time()));
        }
        $uri_export_yy_logs = ExportYyLogs::find([
            'conditions' => 'cd = "uriage"',
            'order' => 'created DESC',
            'limit' => 5]);
        if ($uri_export_yy_logs) {
            $this->tag->setDefault('uri_time_from', $uri_export_yy_logs[0]->time_to);
        } else {
            $this->tag->setDefault('uri_time_from', date('Y-m-01 00:00:00', time()));
        }
        if ($this->request->isPost()) {
            if ($exp == 'shiire') {
                $time_from = $this->request->getPost('time_from');
                $time_to = $this->request->getPost('time_to');
                //	$yayoi_den_no = $this->request->getPost('yayoi_den_no');
                $this->view->exp = $this->url->get('exports/shiire0')
                    . '?time_from=' . $time_from
                    . '&time_to=' . $time_to;
                //		.'&yayoi_den_no='.$yayoi_den_no; // index画面を表示と同時にexportする。仕組み→app/views/index.volt
                $this->tag->setDefault('time_from', $time_from);
                $this->tag->setDefault('time_to', $time_to);
                //	$this->tag->setDefault('yayoi_den_no', $yayoi_den_no);
                $this->tag->setDefault('uri_time_to', $time_to);
                $this->flash->notice("弥生向け仕入エクスポートを作成しました。");
            } else if ($exp == 'uriage') {
                $uri_time_from = $this->request->getPost('uri_time_from');
                $uri_time_to = $this->request->getPost('uri_time_to');
                //	$uri_yayoi_den_no = $this->request->getPost('uri_yayoi_den_no');
                $this->view->exp = $this->url->get('exports/uriage0')
                    . '?uri_time_from=' . $uri_time_from
                    . '&uri_time_to=' . $uri_time_to;
                //	.'&uri_yayoi_den_no='.$uri_yayoi_den_no; // index画面を表示と同時にexportする。仕組み→app/views/index.volt
                $this->tag->setDefault('uri_time_from', $uri_time_from);
                $this->tag->setDefault('uri_time_to', $uri_time_to);
                //	$this->tag->setDefault('uri_yayoi_den_no', $uri_yayoi_den_no);
                $this->tag->setDefault('time_to', $uri_time_to);
                $this->flash->notice("弥生向け売上を作成しました。");
            }
        } else {
            $this->tag->setDefault('time_to', date('Y-m-d H:i:s'));
            $this->tag->setDefault('uri_time_to', date('Y-m-d H:i:s'));
        }
        $this->view->export_yy_logs = $export_yy_logs;
        $this->view->uri_export_yy_logs = $uri_export_yy_logs;
    }

    /**
     * 仕入0 action 伝票番号同一バージョン
     */
    public function shiire0Action()
    {

        if ($this->request->isPost()) {
            $time_from = $this->request->getPost('time_from');
            $time_to = $this->request->getPost('time_to');
        } else {
            $time_from = $this->request->getQuery('time_from');
            $time_to = $this->request->getQuery('time_to');
        }
        $time_from = $time_from ?? "2018-08-01 12:30:00";
        $time_to = $time_to ?? "2018-08-10 23:00:00";
        $config = $this->db->getDescriptor();
        $filePath = __DIR__ . '/temp/';
        $fileName = "Shinlist_Ph" . date("Ymd", strtotime($time_to)) . ".csv";

        $csvarys = [];
//		削除マーク,締めフラグ,消込チェック,日付,伝票№,伝票種別,取引区分,税転嫁,金額は数処理,税端数処理,得意先,納入先,担当コード,行番号,明細区分,商品コード,支払区分コード,商品名,課税区分,単位,入り数,ケース,倉庫コード,数量,単価,金額,回収予定日,税抜額,原価,原単価,備考,数量小数桁,単価小数桁,企画,色,サイズ,空白,空白,空白,得意先略称,プロジェクト,プロジェクト副,予備1,予備2,予備3,予備4,予備5,予備6,予備7,予備8,予備9,予備10,得意先名称

        $shiire_dts = ShiireDts::find([
            'order' => 'cd',
            'conditions' => 'created > ?1 and created <= ?2',
            'bind' => [1 => $time_from, 2 => $time_to],
        ]);

        foreach ($shiire_dts as $shiire_dt) {
            if (!$yayoi_den_no_s) $yayoi_den_no_s = $shiire_dt->cd;
            $yayoi_den_no = $shiire_dt->cd;
            $yayoi_gyou = 0;
            $yayoi99zeigaku = 0;
            foreach ($shiire_dt->ShiireMeisaiDts as $meisai_dt) {
                if ($meisai_dt->UtiwakeKbns->yayoi_kbn) { // 通常など弥生区分該当のときだけ出力
                    $yayoi_gyou += 1;
                    $csvary = []; // 初期化
                    $csvary[0] = 1; // 削除マーク
                    $csvary[1] = 1 + $shiire_dt->shimekiri_flg; // 締めフラグ
                    $csvary[2] = 0; // 消込チェック
                    $csvary[3] = date('Ymd', strtotime($shiire_dt->shiirebi)); // 日付
                    $csvary[4] = $yayoi_den_no; // 伝票№ $shiire_dt->cd;
                    $csvary[5] = 14; // 伝票種別:14=仕入
                    $csvary[6] = $shiire_dt->torihiki_kbn_cd; // 取引区分
                    $csvary[7] = $shiire_dt->ZeitenkaKbns->yayoi_kbn; // 税転嫁
                    $csvary[8] = $shiire_dt->ShiiresakiMrs->gaku_hasuu_shori_kbn_cd; // 金額端数処理
                    $csvary[9] = $shiire_dt->ShiiresakiMrs->zei_hasuu_shori_kbn_cd; // 税端数処理
                    $csvary[10] = $shiire_dt->shiiresaki_mr_cd; // 得意先
                    $csvary[11] = ''; // 納入先(売上用)
                    $csvary[12] = $shiire_dt->tantou_mr_cd; // 担当コード
                    $csvary[13] = $yayoi_gyou; // 行番号
                    $csvary[14] = $meisai_dt->UtiwakeKbns->yayoi_kbn; // 明細区分
                    $csvary[15] = $meisai_dt->shouhin_mr_cd; // 商品コード
                    $csvary[16] = ''; // 支払区分コード
                    $csvary[17] = $meisai_dt->tekiyou; // 商品名
                    $csvary[18] = $meisai_dt->zeiritu_mr_cd; // 課税区分,
                    $TanniMrCd = 'TanniMr' . $meisai_dt->tanka_kbn . 's';
                    $csvary[20] = $meisai_dt->$TanniMrCd->name; // 単位,
                    $csvary[21] = 0; // $meisai_dt->irisuu; // 入り数,小数点がエラーなので送らない
                    $csvary[22] = 0; // ケース,
                    $csvary[23] = $meisai_dt->souko_mr_cd; // 倉庫コード,
                    $suuryou = 'suuryou' . $meisai_dt->tanka_kbn;
                    $csvary[24] = $meisai_dt->$suuryou; // 数量,
                    $csvary[25] = $meisai_dt->tanka; // 単価,
                    $csvary[26] = $meisai_dt->kingaku; // 金額,
                    $csvary[27] = ''; // 回収予定日,
                    $csvary[28] = $meisai_dt->zeinukigaku; // 税抜額,
                    $csvary[29] = ''; // 原価,
                    $csvary[30] = ''; // 原単価,
                    $csvary[31] = $meisai_dt->bikou; // 備考,
                    $suu_shousuu = 'suu' . $meisai_dt->tanka_kbn . '_shousuu';
                    $csvary[32] = $meisai_dt->ShouhinMrs->$suu_shousuu; // 数量小数桁,
                    $csvary[33] = $meisai_dt->ShouhinMrs->tanka_shousuu; // 単価小数桁,
                    $csvary[34] = $meisai_dt->kobetucd; // 企画型番がないので個別
                    $csvary[35] = $meisai_dt->iro; // 色,
                    $csvary[36] = $meisai_dt->size; // サイズ,
                    $csvary[37] = ''; // 空白,
                    $csvary[38] = ''; // 空白,
                    $csvary[39] = ''; // 空白,
                    $csvary[40] = $shiire_dt->ShiiresakiMrs->name; // 得意先名称
                    $csvary[41] = $meisai_dt->project_mr_cd; // プロジェクト,
                    $csvary[42] = ''; // プロジェクト副,
                    $csvary[43] = ''; // 予備1,
                    $csvary[44] = ''; // 予備2,
                    $csvary[45] = ''; // 予備3,
                    $csvary[46] = ''; // 予備4,
                    $csvary[47] = ''; // 予備5,
                    $csvary[48] = ''; // 予備6,
                    $csvary[49] = ''; // 予備7,
                    $csvary[50] = ''; // 予備8,
                    $csvary[51] = ''; // 予備9,
                    $csvary[52] = ''; // 予備10,
                    $csvary[53] = $shiire_dt->ShiiresakiMrs->ryakushou; // 得意先略称,
                    $yayoi99zeigaku += $meisai_dt->zeigaku;
                    $csvarys[] = $csvary;
                }
            }

            if ($yayoi99zeigaku) {
                $yayoi_gyou += 1;
                $csvary = []; // 初期化
                $csvary[0] = 1; // 削除マーク
                $csvary[1] = 1 + $shiire_dt->shimekiri_flg; // 締めフラグ
                $csvary[2] = 0; // 消込チェック
                $csvary[3] = date('Ymd', strtotime($shiire_dt->shiirebi)); // 日付
                $csvary[4] = $yayoi_den_no; // 伝票№ $shiire_dt->cd;
                $csvary[5] = 14; // 伝票種別:14=仕入
                $csvary[6] = $shiire_dt->torihiki_kbn_cd; // 取引区分
                $csvary[7] = $shiire_dt->ZeitenkaKbns->yayoi_kbn; // 税転嫁
                $csvary[8] = $shiire_dt->ShiiresakiMrs->gaku_hasuu_shori_kbn_cd; // 金額端数処理
                $csvary[9] = $shiire_dt->ShiiresakiMrs->zei_hasuu_shori_kbn_cd; // 税端数処理
                $csvary[10] = $shiire_dt->shiiresaki_mr_cd; // 得意先
                $csvary[11] = ''; // 納入先(売上用)
                $csvary[12] = $shiire_dt->tantou_mr_cd; // 担当コード
                $csvary[13] = $yayoi_gyou; // 行番号
                $csvary[14] = 99; // 明細区分
                $csvary[15] = ''; // 商品コード
                $csvary[16] = ''; // 支払区分コード
                $csvary[17] = '消費税'; // 商品名
                $csvary[18] = 0; // 課税区分,
                $csvary[20] = ''; // 単位,
                $csvary[21] = 0; // 入り数,
                $csvary[22] = 0; // ケース,
                $csvary[23] = ''; // 倉庫コード,
                $csvary[24] = 0; // 数量,
                $csvary[25] = 0; // 単価,
                $csvary[26] = $yayoi99zeigaku; // 金額,
                $csvary[27] = ''; // 回収予定日,
                $csvary[28] = 0; // 税抜額,
                $csvary[29] = 0; // 原価,
                $csvary[30] = 0; // 原単価,
                $csvary[31] = ''; // 備考,
                $csvary[32] = 0; // 数量小数桁,
                $csvary[33] = 0; // 単価小数桁,
                $csvary[34] = ''; // 企画,隼伝票番号
                $csvary[35] = ''; // 色,
                $csvary[36] = ''; // サイズ,
                $csvary[37] = ''; // 空白,
                $csvary[38] = ''; // 空白,
                $csvary[39] = ''; // 空白,
                $csvary[40] = $shiire_dt->ShiiresakiMrs->name; // 得意先名称
                $csvary[41] = ''; // プロジェクト,
                $csvary[42] = ''; // プロジェクト副,
                $csvary[43] = ''; // 予備1,
                $csvary[44] = ''; // 予備2,
                $csvary[45] = ''; // 予備3,
                $csvary[46] = ''; // 予備4,
                $csvary[47] = ''; // 予備5,
                $csvary[48] = ''; // 予備6,
                $csvary[49] = ''; // 予備7,
                $csvary[50] = ''; // 予備8,
                $csvary[51] = ''; // 予備9,
                $csvary[52] = ''; // 予備10,
                $csvary[53] = $shiire_dt->ShiiresakiMrs->ryakushou; // 得意先略称,
                $csvarys[] = $csvary;
            }
            if ($yayoi_gyou && trim($shiire_dt->tekiyou)) {
                $yayoi_gyou += 1;
                $csvary = []; // 初期化
                $csvary[0] = 1; // 削除マーク
                $csvary[1] = 1 + $shiire_dt->shimekiri_flg; // 締めフラグ
                $csvary[2] = 0; // 消込チェック
                $csvary[3] = date('Ymd', strtotime($shiire_dt->shiirebi)); // 日付
                $csvary[4] = $yayoi_den_no; // 伝票№ $shiire_dt->cd;
                $csvary[5] = 14; // 伝票種別:14=仕入
                $csvary[6] = $shiire_dt->torihiki_kbn_cd; // 取引区分
                $csvary[7] = $shiire_dt->ZeitenkaKbns->yayoi_kbn; // 税転嫁
                $csvary[8] = $shiire_dt->ShiiresakiMrs->gaku_hasuu_shori_kbn_cd; // 金額端数処理
                $csvary[9] = $shiire_dt->ShiiresakiMrs->zei_hasuu_shori_kbn_cd; // 税端数処理
                $csvary[10] = $shiire_dt->shiiresaki_mr_cd; // 得意先
                $csvary[11] = ''; // 納入先(売上用)
                $csvary[12] = $shiire_dt->tantou_mr_cd; // 担当コード
                $csvary[13] = $yayoi_gyou; // 行番号
                $csvary[14] = 0; // 明細区分
                $csvary[15] = ''; // 商品コード
                $csvary[16] = ''; // 支払区分コード
                $csvary[17] = $shiire_dt->tekiyou; // 商品名
                $csvary[18] = 0; // 課税区分,
                $csvary[20] = ''; // 単位,
                $csvary[21] = 0; // 入り数,
                $csvary[22] = 0; // ケース,
                $csvary[23] = ''; // 倉庫コード,
                $csvary[24] = 0; // 数量,
                $csvary[25] = 0; // 単価,
                $csvary[26] = 0; // 金額,
                $csvary[27] = ''; // 回収予定日,
                $csvary[28] = 0; // 税抜額,
                $csvary[29] = 0; // 原価,
                $csvary[30] = 0; // 原単価,
                $csvary[31] = ''; // 備考,
                $csvary[32] = 0; // 数量小数桁,
                $csvary[33] = 0; // 単価小数桁,
                $csvary[34] = ''; // 企画,隼伝票番号
                $csvary[35] = ''; // 色,
                $csvary[36] = ''; // サイズ,
                $csvary[37] = ''; // 空白,
                $csvary[38] = ''; // 空白,
                $csvary[39] = ''; // 空白,
                $csvary[40] = $shiire_dt->ShiiresakiMrs->name; // 得意先名称
                $csvary[41] = $meisai_dt->project_mr_cd; // プロジェクト,
                $csvary[42] = ''; // プロジェクト副,
                $csvary[43] = ''; // 予備1,
                $csvary[44] = ''; // 予備2,
                $csvary[45] = ''; // 予備3,
                $csvary[46] = ''; // 予備4,
                $csvary[47] = ''; // 予備5,
                $csvary[48] = ''; // 予備6,
                $csvary[49] = ''; // 予備7,
                $csvary[50] = ''; // 予備8,
                $csvary[51] = ''; // 予備9,
                $csvary[52] = ''; // 予備10,
                $csvary[53] = $shiire_dt->ShiiresakiMrs->ryakushou; // 得意先略称,
                $csvarys[] = $csvary;
            }

            // if ($yayoi_gyou) {
            //	$yayoi_den_no += 1;
            // }
        }

        /*
        echo "\n<pre>";
        print_r($csvarys);
        echo "\n</pre>";
        */

        stream_filter_register('crlf', 'crlf_filter');
        $file = fopen($filePath . $fileName, "w");
        if ($file) {
            stream_filter_prepend($file, 'convert.iconv.utf-8/cp932'); // 文字化け防止
            stream_filter_append($file, 'crlf');
            foreach ($csvarys as $csvary) {
                fputcsv($file, $csvary);
            }
            fclose($file);

            // csvファイルをクライアントに出力 ----------------------------
            $response = new \Phalcon\Http\Response(); // Redirect output to a client's web browser (csv)
            $response->setHeader('Content-Disposition', 'attachment;filename="' . $fileName . '"');
            $response->setHeader('Cache-Control', 'max-age=0');
            //	$response->setHeader('Cache-Control', 'max-age=1'); // If you're serving to IE 9, then the following may be needed
            $response->setContent(file_get_contents($filePath . $fileName)); //Set the content of the response
            unlink($filePath . $fileName); // delete temp file
            $this->flash->notice("弥生向け仕入エクスポートを作成しました。" . $fileName);

            $export_yy_log = new ExportYyLogs(); // 移出記録に書きだし
            $export_yy_log->cd = 'shiire';
            $export_yy_log->time_from = $time_from;
            $export_yy_log->time_to = $time_to;
            $export_yy_log->name = $yayoi_den_no_s;
            $export_yy_log->den_no_to = $yayoi_den_no;
            if (!$export_yy_log->save()) {
                foreach ($export_yy_log->getMessages() as $message) {
                    $this->flash->error($message);
                }
            }

            return $response; //Return the response

        } else {
            $this->flash->error("仕入エクスポートに失敗しました。(" . $fileName . ")");
            $this->view->exp = null;
        }

    }

    /**
     * 売上0 action 伝票番号同一バージョン
     */
    public function uriage0Action()
    {
        if ($this->request->isPost()) {
            $time_from = $this->request->getPost('uri_time_from');
            $time_to = $this->request->getPost('uri_time_to');
            // $yayoi_den_no = $this->request->getPost('uri_yayoi_den_no');
        } else {
            $time_from = $this->request->getQuery('uri_time_from');
            $time_to = $this->request->getQuery('uri_time_to');
            // $yayoi_den_no = $this->request->getQuery('uri_yayoi_den_no');
        }
        $time_from = $time_from ?? "2018-08-01 12:30:00";
        $time_to = $time_to ?? "2018-08-10 16:00:00";
        // $yayoi_den_no = $yayoi_den_no??51000;

//echo "\n<br>start";
        $config = $this->db->getDescriptor();
        $filePath = __DIR__ . '/temp/';
        $fileName = "Urinlist_Ph" . date("Ymd", strtotime($time_to)) . ".csv";

        $csvarys = [];
//		削除マーク,締めフラグ,消込チェック,日付,伝票№,伝票種別,取引区分,税転嫁,金額は数処理,税端数処理,得意先,納入先,担当コード,行番号,明細区分,商品コード,支払区分コード,商品名,課税区分,単位,入り数,ケース,倉庫コード,数量,単価,金額,回収予定日,税抜額,原価,原単価,備考,数量小数桁,単価小数桁,企画,色,サイズ,空白,空白,空白,得意先略称,プロジェクト,プロジェクト副,予備1,予備2,予備3,予備4,予備5,予備6,予備7,予備8,予備9,予備10,得意先名称

        $uriage_dts = UriageDts::find(
            ['order' => 'cd'
                , 'conditions' => 'created > ?1 and created <= ?2',
                'bind' => [1 => $time_from, 2 => $time_to]]);

//		$csvarys[]=[$time_from,$time_to,count($uriage_dts)]; // デバッグ行。本番ではコメントアウト。

        // $yayoi_den_no += 1;
        foreach ($uriage_dts as $uriage_dt) {
            if (!$yayoi_den_no_s) $yayoi_den_no_s = $uriage_dt->cd;
            $yayoi_den_no = $uriage_dt->cd;
            $yayoi_gyou = 0;
            $yayoi99zeigaku = 0;
            foreach ($uriage_dt->UriageMeisaiDts as $meisai_dt) {
                if ($meisai_dt->UtiwakeKbns->yayoi_kbn) { // 通常など弥生区分該当のときだけ出力
                    $yayoi_gyou += 1;
                    $csvary = []; // 初期化
                    $csvary[0] = 1; // 削除マーク
                    $csvary[1] = 1 + $uriage_dt->shimekiri_flg; // 締めフラグ
                    $csvary[2] = 0; // 消込チェック
                    $csvary[3] = date('Ymd', strtotime($uriage_dt->uriagebi)); // 日付
                    $csvary[4] = $yayoi_den_no; // 伝票№
                    $csvary[5] = 24; // 伝票種別:24=売上
                    $csvary[6] = $uriage_dt->torihiki_kbn_cd; // 取引区分
                    $csvary[7] = $uriage_dt->ZeitenkaKbns->yayoi_kbn; // 税転嫁
                    $csvary[8] = $uriage_dt->TokuisakiMrs->gaku_hasuu_shori_kbn_cd; // 金額端数処理
                    $csvary[9] = $uriage_dt->TokuisakiMrs->zei_hasuu_shori_kbn_cd; // 税端数処理
                    $csvary[10] = $uriage_dt->tokuisaki_mr_cd; // 得意先
                    $csvary[11] = $uriage_dt->nounyuusaki_mr_cd; // 納入先(売上用)
                    $csvary[12] = $uriage_dt->tantou_mr_cd; // 担当コード
                    $csvary[13] = $yayoi_gyou; // 行番号
                    $csvary[14] = $meisai_dt->UtiwakeKbns->yayoi_kbn; // 明細区分
                    $csvary[15] = $meisai_dt->shouhin_mr_cd; // 商品コード
                    $csvary[16] = '2'; // 入金区分コード
                    $csvary[17] = $meisai_dt->tekiyou; // 商品名
                    $csvary[18] = $meisai_dt->zeiritu_mr_cd; // 課税区分,
                    $TanniMrCd = 'TanniMr' . $meisai_dt->tanka_kbn . 's';
                    $csvary[20] = $meisai_dt->$TanniMrCd->name; // 単位,
                    $csvary[21] = 0; // $meisai_dt->irisuu; // 入り数,小数点がエラーなので送らない
                    $csvary[22] = 0; // ケース,
                    $csvary[23] = $meisai_dt->souko_mr_cd; // 倉庫コード,
                    $suuryou = 'suuryou' . $meisai_dt->tanka_kbn;
                    $csvary[24] = $meisai_dt->$suuryou; // 数量,
                    $csvary[25] = $meisai_dt->tanka; // 単価,
                    $csvary[26] = $meisai_dt->kingaku; // 金額,
                    $csvary[27] = ''; // 回収予定日,
                    $csvary[28] = $meisai_dt->zeinukigaku; // 税抜額,
                    $csvary[29] = ''; // 原価 (インポートの場合は「空白」)
                    $csvary[30] = $meisai_dt->gentanka; // 原単価,
                    $csvary[31] = $meisai_dt->bikou; // 備考,
                    $suu_shousuu = 'suu' . $meisai_dt->tanka_kbn . '_shousuu';
                    $csvary[32] = $meisai_dt->ShouhinMrs->$suu_shousuu; // 数量小数桁,
                    $csvary[33] = $meisai_dt->ShouhinMrs->tanka_shousuu; // 単価小数桁,
                    $csvary[34] = $meisai_dt->kikaku; // 企画型番
                    $csvary[35] = $meisai_dt->iro; // 色,
                    $csvary[36] = $meisai_dt->size; // サイズ,
                    $csvary[37] = $uriage_dt->nounyuu_kijitu; // 納入期日,
                    $csvary[38] = ''; // 統一伝票などに印刷する分類コード,
                    $csvary[39] = $uriage_dt->denpyou_kbn; // 伝票区分,
                    $csvary[40] = $uriage_dt->TokuisakiMrs->name; // 得意先名称
                    $csvary[41] = $meisai_dt->project_mr_cd; // プロジェクト,
                    $csvary[42] = ''; // プロジェクト副,
                    $csvary[43] = ''; // 予備1,
                    $csvary[44] = ''; // 予備2,
                    $csvary[45] = ''; // 予備3,
                    $csvary[46] = ''; // 予備4,
                    $csvary[47] = ''; // 予備5,
                    $csvary[48] = ''; // 予備6,
                    $csvary[49] = ''; // 予備7,
                    $csvary[50] = ''; // 予備8,
                    $csvary[51] = ''; // 予備9,
                    $csvary[52] = ''; // 予備10,
                    $csvary[53] = $uriage_dt->TokuisakiMrs->ryakushou; // 得意先略称,
                    $yayoi99zeigaku += $meisai_dt->zeigaku;
                    $csvarys[] = $csvary;
                }
            }
            if ($yayoi99zeigaku) {
                $yayoi_gyou += 1;
                $csvary = []; // 初期化
                $csvary[0] = 1; // 削除マーク
                $csvary[1] = 1 + $uriage_dt->shimekiri_flg; // 締めフラグ
                $csvary[2] = 0; // 消込チェック
                $csvary[3] = date('Ymd', strtotime($uriage_dt->uriagebi)); // 日付
                $csvary[4] = $yayoi_den_no; // 伝票№
                $csvary[5] = 24; // 伝票種別:24=売上
                $csvary[6] = $uriage_dt->torihiki_kbn_cd; // 取引区分
                $csvary[7] = $uriage_dt->ZeitenkaKbns->yayoi_kbn; // 税転嫁
                $csvary[8] = $uriage_dt->TokuisakiMrs->gaku_hasuu_shori_kbn_cd; // 金額端数処理
                $csvary[9] = $uriage_dt->TokuisakiMrs->zei_hasuu_shori_kbn_cd; // 税端数処理
                $csvary[10] = $uriage_dt->tokuisaki_mr_cd; // 得意先
                $csvary[11] = $uriage_dt->nounyuusaki_mr_cd; // 納入先(売上用)
                $csvary[12] = $uriage_dt->tantou_mr_cd; // 担当コード
                $csvary[13] = $yayoi_gyou; // 行番号
                $csvary[14] = 99; // 明細区分
                $csvary[15] = ''; // 商品コード
                $csvary[16] = ''; // 支払区分コード
                $csvary[17] = '消費税'; // 商品名
                $csvary[18] = 0; // 課税区分,
                $csvary[20] = ''; // 単位,
                $csvary[21] = 0; // 入り数,
                $csvary[22] = 0; // ケース,
                $csvary[23] = ''; // 倉庫コード,
                $csvary[24] = 0; // 数量,
                $csvary[25] = 0; // 単価,
                $csvary[26] = $yayoi99zeigaku; // 金額,
                $csvary[27] = ''; // 回収予定日,
                $csvary[28] = 0; // 税抜額,
                $csvary[29] = 0; // 原価,
                $csvary[30] = 0; // 原単価,
                $csvary[31] = ''; // 備考,
                $csvary[32] = 0; // 数量小数桁,
                $csvary[33] = 0; // 単価小数桁,
                $csvary[34] = ''; // 企画,隼伝票番号
                $csvary[35] = ''; // 色,
                $csvary[36] = ''; // サイズ,
                $csvary[37] = $uriage_dt->nounyuu_kijitu; // 納入期日,
                $csvary[38] = ''; // 統一伝票などに印刷する分類コード,
                $csvary[39] = $uriage_dt->denpyou_kbn; // 伝票区分,
                $csvary[40] = $uriage_dt->TokuisakiMrs->name; // 得意先名称
                $csvary[41] = ''; // プロジェクト,
                $csvary[42] = ''; // プロジェクト副,
                $csvary[43] = ''; // 予備1,
                $csvary[44] = ''; // 予備2,
                $csvary[45] = ''; // 予備3,
                $csvary[46] = ''; // 予備4,
                $csvary[47] = ''; // 予備5,
                $csvary[48] = ''; // 予備6,
                $csvary[49] = ''; // 予備7,
                $csvary[50] = ''; // 予備8,
                $csvary[51] = ''; // 予備9,
                $csvary[52] = ''; // 予備10,
                $csvary[53] = $uriage_dt->TokuisakiMrs->ryakushou; // 得意先略称,
                $csvarys[] = $csvary;
            }
            if ($yayoi_gyou && trim($uriage_dt->tekiyou)) {
                $yayoi_gyou += 1;
                $csvary = []; // 初期化
                $csvary[0] = 1; // 削除マーク
                $csvary[1] = 1 + $uriage_dt->shimekiri_flg; // 締めフラグ
                $csvary[2] = 0; // 消込チェック
                $csvary[3] = date('Ymd', strtotime($uriage_dt->uriagebi)); // 日付
                $csvary[4] = $yayoi_den_no; // 伝票№
                $csvary[5] = 24; // 伝票種別:24=売上
                $csvary[6] = $uriage_dt->torihiki_kbn_cd; // 取引区分
                $csvary[7] = $uriage_dt->ZeitenkaKbns->yayoi_kbn; // 税転嫁
                $csvary[8] = $uriage_dt->TokuisakiMrs->gaku_hasuu_shori_kbn_cd; // 金額端数処理
                $csvary[9] = $uriage_dt->TokuisakiMrs->zei_hasuu_shori_kbn_cd; // 税端数処理
                $csvary[10] = $uriage_dt->tokuisaki_mr_cd; // 得意先
                $csvary[11] = $uriage_dt->nounyuusaki_mr_cd; // 納入先(売上用)
                $csvary[12] = $uriage_dt->tantou_mr_cd; // 担当コード
                $csvary[13] = $yayoi_gyou; // 行番号
                $csvary[14] = 0; // 明細区分
                $csvary[15] = ''; // 商品コード
                $csvary[16] = ''; // 支払区分コード
                $csvary[17] = $uriage_dt->tekiyou; // 商品名
                $csvary[18] = 0; // 課税区分,
                $csvary[20] = ''; // 単位,
                $csvary[21] = 0; // 入り数,
                $csvary[22] = 0; // ケース,
                $csvary[23] = ''; // 倉庫コード,
                $csvary[24] = 0; // 数量,
                $csvary[25] = 0; // 単価,
                $csvary[26] = 0; // 金額,
                $csvary[27] = ''; // 回収予定日,
                $csvary[28] = 0; // 税抜額,
                $csvary[29] = 0; // 原価,
                $csvary[30] = 0; // 原単価,
                $csvary[31] = ''; // 備考,
                $csvary[32] = 0; // 数量小数桁,
                $csvary[33] = 0; // 単価小数桁,
                $csvary[34] = ''; // 企画,隼伝票番号
                $csvary[35] = ''; // 色,
                $csvary[36] = ''; // サイズ,
                $csvary[37] = $uriage_dt->nounyuu_kijitu; // 納入期日,
                $csvary[38] = ''; // 統一伝票などに印刷する分類コード,
                $csvary[39] = $uriage_dt->denpyou_kbn; // 伝票区分,
                $csvary[40] = $uriage_dt->TokuisakiMrs->name; // 得意先名称
                $csvary[41] = $meisai_dt->project_mr_cd; // プロジェクト,
                $csvary[42] = ''; // プロジェクト副,
                $csvary[43] = ''; // 予備1,
                $csvary[44] = ''; // 予備2,
                $csvary[45] = ''; // 予備3,
                $csvary[46] = ''; // 予備4,
                $csvary[47] = ''; // 予備5,
                $csvary[48] = ''; // 予備6,
                $csvary[49] = ''; // 予備7,
                $csvary[50] = ''; // 予備8,
                $csvary[51] = ''; // 予備9,
                $csvary[52] = ''; // 予備10,
                $csvary[53] = $uriage_dt->TokuisakiMrs->ryakushou; // 得意先略称,
                $csvarys[] = $csvary;
            }
            // if ($yayoi_gyou) {
            // 	$yayoi_den_no += 1;
            // }
        }
        /*
        echo "\n<pre>";
        print_r($csvarys);
        echo "\n</pre>";
        */

        stream_filter_register('crlf', 'crlf_filter');
        $file = fopen($filePath . $fileName, "w");
        if ($file) {
            stream_filter_prepend($file, 'convert.iconv.utf-8/cp932'); // 文字化け防止
            stream_filter_append($file, 'crlf');
            foreach ($csvarys as $csvary) {
                fputcsv($file, $csvary);
            }
            fclose($file);

            // csvファイルをクライアントに出力 ----------------------------
            $response = new \Phalcon\Http\Response(); // Redirect output to a client's web browser (csv)
            $response->setHeader('Content-Disposition', 'attachment;filename="' . $fileName . '"');
            $response->setHeader('Cache-Control', 'max-age=0');
            //	$response->setHeader('Cache-Control', 'max-age=1'); // If you're serving to IE 9, then the following may be needed
            $response->setContent(file_get_contents($filePath . $fileName)); //Set the content of the response
            unlink($filePath . $fileName); // delete temp file
            $this->flash->success("弥生向け売上エクスポートを作成しました。" . $fileName);

            $export_yy_log = new ExportYyLogs(); // 移出記録に書きだし
            $export_yy_log->cd = 'uriage';
            $export_yy_log->time_from = $time_from;
            $export_yy_log->time_to = $time_to;
            $export_yy_log->name = $yayoi_den_no_s;
            $export_yy_log->den_no_to = $yayoi_den_no;
            if (!$export_yy_log->save()) {
                foreach ($export_yy_log->getMessages() as $message) {
                    $this->flash->error($message);
                }
            }

            return $response; //Return the response

        } else {
            $this->flash->error("売上エクスポートに失敗しました。(" . $fileName . ")");
            $this->view->exp = null;
        }

    }

    /*
     * 入出金データエクスポート画面
     */
    public function nyuushu_exportsAction($exp = '')
    {
        ini_set('display_errors', 'on');
        error_reporting(E_ALL | E_NOTICE);
        $export_yy_logs = ExportYyLogs::find([
            'conditions' => 'cd = "shukkin"',
            'order' => 'created DESC',
            'limit' => 5]);

        if (count($export_yy_logs) !== 0) {
            $this->tag->setDefault('shukkin_time_from', $export_yy_logs[0]->time_to);
        } else {
            $this->tag->setDefault('shukkin_time_from', date('Y-m-01 00:00:00', time()));
        }

        $nyuukin_export_yy_logs = ExportYyLogs::find([
            'conditions' => 'cd = "nyuukin"',
            'order' => 'created DESC',
            'limit' => 5]);
        if (count($nyuukin_export_yy_logs) !== 0) {
            $this->tag->setDefault('nyuukin_time_from', $nyuukin_export_yy_logs[0]->time_to);
        } else {
            $this->tag->setDefault('nyuukin_time_from', date('Y-m-01 00:00:00', time()));
        }

        if ($this->request->isPost()) {
            if ($exp === 'nyuukin') {
                $nyuukin_time_from = $this->request->getPost('nyuukin_time_from');
                $nyuukin_time_to = $this->request->getPost('nyuukin_time_to');
                $this->view->exp = $this->url->get('exports/nyuukin')
                    . '?nyuukin_time_from=' . $nyuukin_time_from
                    . '&nyuukin_time_to=' . $nyuukin_time_to;
                $this->tag->setDefault('nyuukin_time_from', $nyuukin_time_from);
                $this->tag->setDefault('nyuukin_time_to', $nyuukin_time_to);
                $this->tag->setDefault('shukkin_time_to', $nyuukin_time_to);
                $this->flash->notice("弥生向け入金データを作成しました。");
            } else if ($exp === 'shukkin') {
                $shukkin_time_from = $this->request->getPost('shukkin_time_from');
                $shukkin_time_to = $this->request->getPost('shukkin_time_to');
                $this->view->exp = $this->url->get('exports/shukkin')
                    . '?shukkin_time_from=' . $shukkin_time_from
                    . '&shukkin_time_to=' . $shukkin_time_to;
                $this->tag->setDefault('shukkin_time_from', $shukkin_time_from);
                $this->tag->setDefault('shukkin_time_to', $shukkin_time_to);
                $this->tag->setDefault('nyuukin_time_to', $shukkin_time_to);
                $this->flash->notice("弥生向け出金データを作成しました。");
            }
        } else {
            $this->tag->setDefault('shukkin_time_to', date('Y-m-d H:i:s'));
            $this->tag->setDefault('nyuukin_time_to', date('Y-m-d H:i:s'));
        }
        $this->view->export_yy_logs = $export_yy_logs;
        $this->view->nyuukin_export_yy_logs = $nyuukin_export_yy_logs;
    }

    /*
     * 送り状データエクスポート画面
     */
    public function okurijouAction($exp = '')
    {
        $export_sagawa_logs = ExportYyLogs::find([
            'conditions' => 'cd = "sagawa"',
            'order' => 'created DESC',
            'limit' => 5]);

        if (count($export_sagawa_logs) !== 0) {
            $this->tag->setDefault('time_from', $export_sagawa_logs[0]->time_to);
        } else {
            $this->tag->setDefault('time_from', date('Y-m-01 00:00:00', time()));
        }

        if ($this->request->isPost()) {
            if ($exp === 'sagawa') {
                $time_from = $this->request->getPost('time_from');
                $time_to = $this->request->getPost('time_to');
                $this->view->exp = $this->url->get('exports/sagawa')
                    . '?time_from=' . $time_from
                    . '&time_to=' . $time_to;
                $this->tag->setDefault('time_from', $time_from);
                $this->tag->setDefault('time_to', $time_to);
                $this->flash->notice("佐川急便向け送り状データを作成しました。");
            }
        } else {
            $this->tag->setDefault('time_to', date('Y-m-d H:i:s'));
        }
        $this->view->export_sagawa_logs = $export_sagawa_logs;
    }

    /*
     * 佐川急便 飛伝Ⅱ 送り状データ作成
     * @TODO TEST中
     */
    public function sagawaAction()
    {
        ini_set('display_errors', 'on');
        error_reporting(E_ALL|E_NOTICE);
        if ($this->request->isPost()) {
            $time_from = $this->request->getPost('time_from');
            $time_to = $this->request->getPost('time_to');
        } else {
            $time_from = $this->request->getQuery('time_from');
            $time_to = $this->request->getQuery('time_to');
        }
        $time_from = $time_from ?? "2018-08-01 12:30:00";
        $time_to = $time_to ?? "2018-08-10 16:00:00";
        $config = $this->db->getDescriptor();
        $filePath = __DIR__ . '/temp/';
        $fileName = "Sagawa_Okurijou_Ph" . date("Ymd", strtotime($time_to)) . ".csv";
        $csvarys = [];

        $kihon_mr = KihonMrs::findFirst();
        //納入先コードが入っている伝票のみ抽出する
        $uriage_dts = UriageDts::find(
            ['order' => 'cd'
                , 'conditions' => "created > ?1 and created <= ?2 and nounyuusaki_mr_cd <> '' and nounyuusaki_mr_cd <> '9999'" ,
                'bind' => [1 => $time_from, 2 => $time_to]]);
        foreach ($uriage_dts as $uriage_dt) {
            if (!$yayoi_den_no_s) $yayoi_den_no_s = $uriage_dt->cd;
            $yayoi_den_no = $uriage_dt->cd;
            $yayoi_gyou = 0;
            $yayoi_gyou += 1;
            $csvary = []; // 初期化
            $csvary[0] = ''; //住所録ｺｰﾄﾞ
            if ($uriage_dt->nounyuusaki_mr_cd === '0000') {
                $csvary[1] = $uriage_dt->TokuisakiMrs->tel; // お届け先電話番号
                $csvary[2] = $uriage_dt->TokuisakiMrs->yuubin_bangou; // お届け先郵便番号
                $csvary[3] = $uriage_dt->TokuisakiMrs->juusho1; // お届け先住所1
                // @TODO 住所２と住所３は住所２を分割して作る
                $csvary[4] = $uriage_dt->TokuisakiMrs->juusho2; // お届け先住所2
                $csvary[5] = $uriage_dt->TokuisakiMrs->juusho2; // お届け先住所3
                //--------------------------------------------------------------
                $csvary[6] = $uriage_dt->TokuisakiMrs->name; // お届け先名称１
                $csvary[7] = $uriage_dt->TokuisakiMrs->bushomei . ' ' . $uriage_dt->TokuisakiMrs->gotantousha; //
            } else {
                $csvary[1] = $uriage_dt->NounyuusakiMrs->tel; // お届け先電話番号
                $csvary[2] = $uriage_dt->NounyuusakiMrs->yuubin_bangou; // お届け先郵便番号
                $csvary[3] = $uriage_dt->NounyuusakiMrs->juusho1; // お届け先住所1
                // @TODO 住所２と住所３は住所２を分割して作る
                $csvary[4] = $uriage_dt->NounyuusakiMrs->juusho2; // お届け先住所2
                $csvary[5] = $uriage_dt->NounyuusakiMrs->juusho2; // お届け先住所3
                //--------------------------------------------------------------
                $csvary[6] = $uriage_dt->NounyuusakiMrs->name; // お届け先名称１
                $csvary[7] = $uriage_dt->NounyuusakiMrs->bushomei . ' ' . $uriage_dt->NounyuusakiMrs->gotantousha; // お届け先名称2
            }
            $csvary[8] = ''; // お客様管理ナンバー (何入れるか不明)
            $csvary[9] = ''; // お客様コード (何入れるか不明)
            $csvary[10] = $uriage_dt->TantouMrs->UserGroupMrs->name . ' ' . $uriage_dt->TantouMrs->name; // 部署担当者
            $csvary[11] = $kihon_mr->tel; // 荷送人電話番号
            $csvary[12] = $kihon_mr->tel; // 依頼主電話番号
            $csvary[13] = $kihon_mr->yuubin_bangou; // 依頼主郵便番号
            $csvary[14] = $kihon_mr->juusho1; // 依頼主住所1
            $csvary[15] = $kihon_mr->juusho2; // 依頼主住所2
            $csvary[16] = $uriage_dt->SakuseiUsers->UserGroupMrs->name; // 依頼主名称1
            $csvary[17] = $uriage_dt->SakuseiUsers->name; // ご依頼主名称2
            $csvary[18] = '001'; // 荷姿コード,
            //品名展開
//            $counter = 0;
//            foreach ($uriage_dt->UriageMeisaiDts as $meisai_dt) {
//                if ($meisai_dt->UtiwakeKbns->yayoi_kbn) {
//                    $csvary[$counter + 19] = $meisai_dt->tekiyou;
//                }
//                $counter++;
//                if ($counter !== 0) break;
//            }
            //-------------------------------------------
            $csvary[19] = $uriage_dt->cd; //品名欄1に伝票ナンバーを入れる
            $csvary[20] = ''; //品名欄2
            $csvary[21] = ''; //品名欄3
            $csvary[22] = ''; //品名欄4
            $csvary[23] = ''; //品名欄5
            $csvary[24] = 1; //出荷個数
            $csvary[25] = 000; // 便種（スピードで選択）,
            $csvary[26] = 001; // 便種（商品）,
            $csvary[27] = ''; // 配達指定日,
            $csvary[28] = ''; // 配達指定時間,
            $csvary[29] = 0; // 代引き金額,
            $csvary[30] = 0; // 消費税
            $csvary[31] = 0; // 決済種別,
            $csvary[32] = 0; // 保険金額,
            $csvary[33] = 0; // 保険金額印字
            $csvary[34] = ''; // 指定シール1,
            $csvary[35] = ''; // 指定シール2,
            $csvary[36] = ''; // 指定シール3
            $csvary[37] = 0; // 営業店止め,
            $csvary[38] = 0; // SRC区分,
            $csvary[39] = ''; // 営業店ｺｰﾄﾞ,
            $csvary[40] = 1; // 元着区分,
            $csvarys[] = $csvary;
        }
        stream_filter_register('crlf', 'crlf_filter');
        $file = fopen($filePath . $fileName, "w");
        if ($file) {
            stream_filter_prepend($file, 'convert.iconv.utf-8/cp932'); // 文字化け防止
            stream_filter_append($file, 'crlf');
            foreach ($csvarys as $csvary) {
                fputcsv($file, $csvary);
            }
            fclose($file);
            $response = new \Phalcon\Http\Response(); // Redirect output to a client's web browser (csv)
            $response->setHeader('Content-Disposition', 'attachment;filename="' . $fileName . '"');
            $response->setHeader('Cache-Control', 'max-age=0');
            $response->setContent(file_get_contents($filePath . $fileName)); //Set the content of the response
            unlink($filePath . $fileName); // delete temp file
            $this->flash->success("佐川急便送り状データを作成しました。" . $fileName);

            $export_yy_log = new ExportYyLogs();
            $export_yy_log->cd = 'sagawa';
            $export_yy_log->time_from = $time_from;
            $export_yy_log->time_to = $time_to;
            $export_yy_log->name = $yayoi_den_no_s;
            $export_yy_log->den_no_to = $yayoi_den_no;
            if (!$export_yy_log->save()) {
                foreach ($export_yy_log->getMessages() as $message) {
                    $this->flash->error($message);
                }
            }

            return $response;

        } else {
            $this->flash->error("CSVの作成に失敗しました。(" . $fileName . ")");
            $this->view->exp = null;
        }
    }

    /*
     * 出金CSV作成 作成開始(データが無くて良く分からない)
     * @TODO testしてないので、確認必要
     */
    public function shukkinAction()
    {
        if ($this->request->isPost()) {
            $time_from = $this->request->getPost('shukkin_time_from');
            $time_to = $this->request->getPost('shukkin_time_to');
        } else {
            $time_from = $this->request->getQuery('shukkin_time_from');
            $time_to = $this->request->getQuery('shukkin_time_to');
        }

        $time_from = $time_from ?? "2018-08-01 12:30:00";
        $time_to = $time_to ?? "2018-08-10 23:00:00";
        $filePath = __DIR__ . '/temp/';
        $fileName = "Shukkin_Ph" . date("Ymd", strtotime($time_to)) . ".csv";
        $csvarys = [];
        $yayoi_den_no_s = '';
        $shukkin_dts = ShukkinDts::find([
            'order' => 'cd',
            'conditions' => 'created > ?1 and created <= ?2',
            'bind' => [1 => $time_from, 2 => $time_to],
        ]);

        foreach ($shukkin_dts as $shukkin_dt) {
            if (!$yayoi_den_no_s) $yayoi_den_no_s = $shukkin_dt->cd;
            $yayoi_den_no = $shukkin_dt->cd;
            $yayoi_gyou = 0;
            foreach ($shukkin_dt->ShukkinMeisaiDts as $meisai_dt) {
                if ($meisai_dt) {
                    $yayoi_gyou += 1;
                    $csvary = [];
                    $csvary[0] = 1; // 削除マーク
                    $csvary[1] = 0; // 締めフラグ
                    $csvary[2] = 0; // チェック
                    $csvary[3] = date('Ymd', strtotime($shukkin_dt->shukkinbi)); // 日付
                    $csvary[4] = $yayoi_den_no; // 伝票番号
                    $csvary[5] = 13; // 伝票区分→13:出金
                    $csvary[6] = 0; // 取引区分
                    $csvary[7] = 0; // 税転嫁
                    $csvary[8] = $shukkin_dt->ShiiresakiMrs->gaku_hasuu_shori_kbn_cd; // 金額端数処理
                    $csvary[9] = $shukkin_dt->ShiiresakiMrs->zei_hasuu_shori_kbn_cd; // 税端数処理
                    $csvary[10] = $shukkin_dt->shiiresaki_mr_cd; // 仕入先
                    $csvary[11] = ''; //
                    $csvary[12] = $shukkin_dt->tantou_mr_cd; // 担当コード
                    $csvary[13] = $yayoi_gyou; // 行番号
                    $csvary[14] = 0; // 明細区分
                    $csvary[15] = $meisai_dt->shukkin_kbn; // 出金区分
                    $csvary[16] = ''; // 空白,
                    $csvary[17] = $meisai_dt->name; // 内容
                    $csvary[18] = 0; // 課税区分,
                    $csvary[20] = 0; // 単位,
                    $csvary[21] = 0; // 空白,
                    $csvary[22] = 0; // ケース,
                    $csvary[23] = 0; // 倉庫コード,
                    $csvary[24] = 0; // 数量,
                    $csvary[25] = 0; // 単価,
                    $csvary[26] = $meisai_dt->kingaku; // 金額,
                    $csvary[27] = $meisai_dt->tegata_kijitu; // 回収予定日,
                    $csvary[28] = 0; // 税抜額,
                    $csvary[29] = 0; // 原価,
                    $csvary[30] = 0; // 原単価,
                    $csvary[31] = $meisai_dt->bikou; // 備考,
                    $csvary[32] = 0; // 数量小数桁,
                    $csvary[33] = 0; // 単価小数桁,
                    $csvary[34] = 0; // 企画型番がないので個別
                    $csvary[35] = 0; // 色,
                    $csvary[36] = 0; // サイズ,
                    $csvary[37] = ''; // 空白,
                    $csvary[38] = ''; // 空白,
                    $csvary[39] = ''; // 空白,
                    $csvary[40] = $shukkin_dt->ShiiresakiMrs->name; // 仕入先名称
                    $csvary[41] = ''; // プロジェクト,
                    $csvary[42] = ''; // プロジェクト副,
                    $csvary[43] = ''; // 予備1,
                    $csvary[44] = ''; // 予備2,
                    $csvary[45] = ''; // 予備3,
                    $csvary[46] = ''; // 予備4,
                    $csvary[47] = ''; // 予備5,
                    $csvary[48] = ''; // 予備6,
                    $csvary[49] = ''; // 予備7,
                    $csvary[50] = ''; // 予備8,
                    $csvary[51] = ''; // 予備9,
                    $csvary[52] = ''; // 予備10,
                    $csvarys[] = $csvary;
                }
            }
        }
        stream_filter_register('crlf', 'crlf_filter');
        $file = fopen($filePath . $fileName, "w");
        if ($file) {
            stream_filter_prepend($file, 'convert.iconv.utf-8/cp932');
            stream_filter_append($file, 'crlf');
            foreach ($csvarys as $csvary) {
                fputcsv($file, $csvary);
            }
            fclose($file);
            $response = new \Phalcon\Http\Response();
            $response->setHeader('Content-Disposition', 'attachment;filename="' . $fileName . '"');
            $response->setHeader('Cache-Control', 'max-age=0');
            $response->setContent(file_get_contents($filePath . $fileName));
            unlink($filePath . $fileName); // delete temp file
            $this->flash->notice("弥生向け出金データを作成しました。" . $fileName);

            $export_yy_log = new ExportYyLogs();
            $export_yy_log->cd = 'shukkin';
            $export_yy_log->time_from = $time_from;
            $export_yy_log->time_to = $time_to;
            $export_yy_log->name = $yayoi_den_no_s;
            $export_yy_log->den_no_to = $yayoi_den_no;
            if (!$export_yy_log->save()) {
                foreach ($export_yy_log->getMessages() as $message) {
                    $this->flash->error($message);
                }
            }

            return $response;
        } else {
            $this->flash->error("出金データのエクスポートに失敗しました。(" . $fileName . ")");
            $this->view->exp = null;
        }
    }

    /*
     * 入金CSV作成 作成開始(データが無くて良く分からない)
     * @TODO testしてないので、確認必要
     */
    public function nyuukinAction()
    {
        if ($this->request->isPost()) {
            $time_from = $this->request->getPost('nyuukin_time_from');
            $time_to = $this->request->getPost('nyuukin_time_to');
        } else {
            $time_from = $this->request->getQuery('nyuukin_time_from');
            $time_to = $this->request->getQuery('nyuukin_time_to');
        }

        $time_from = $time_from ?? "2018-08-01 12:30:00";
        $time_to = $time_to ?? "2018-08-10 23:00:00";
        $filePath = __DIR__ . '/temp/';
        $fileName = "Nyuukin_Ph" . date("Ymd", strtotime($time_to)) . ".csv";
        $csvarys = [];
        $yayoi_den_no_s = '';
        $nyuukin_dts = NyuukinDts::find([
            'order' => 'cd',
            'conditions' => 'created > ?1 and created <= ?2',
            'bind' => [1 => $time_from, 2 => $time_to],
        ]);

        foreach ($nyuukin_dts as $nyuukin_dt) {
            if (!$yayoi_den_no_s) $yayoi_den_no_s = $nyuukin_dt->cd;
            $yayoi_den_no = $nyuukin_dt->cd;
            $yayoi_gyou = 0;
            foreach ($nyuukin_dt->NyuukinMeisaiDts as $meisai_dt) {
                if ($meisai_dt) {
                    $yayoi_gyou += 1;
                    $csvary = [];
                    $csvary[0] = 1; // 削除マーク
                    $csvary[1] = 0; // 締めフラグ
                    $csvary[2] = 0; // チェック
                    $csvary[3] = date('Ymd', strtotime($nyuukin_dt->nyuukinbi)); // 日付
                    $csvary[4] = $yayoi_den_no; // 伝票番号
                    $csvary[5] = 23; // 伝票区分→23:入金
                    $csvary[6] = 0; // 取引区分
                    $csvary[7] = 0; // 税転嫁
                    $csvary[8] = $nyuukin_dt->TokuisakiMrs->gaku_hasuu_shori_kbn_cd; // 金額端数処理
                    $csvary[9] = $nyuukin_dt->TokuisakiMrs->zei_hasuu_shori_kbn_cd; // 税端数処理
                    $csvary[10] = $nyuukin_dt->seikyuusaki_mr_cd; // 得意先
                    $csvary[11] = ''; //
                    $csvary[12] = $nyuukin_dt->tantou_mr_cd; // 担当コード
                    $csvary[13] = $yayoi_gyou; // 行番号
                    $csvary[14] = 0; // 明細区分
                    $csvary[15] = $meisai_dt->nyuukin_kbn; // 入金区分
                    $csvary[16] = ''; // 空白,
                    $csvary[17] = $meisai_dt->name; // 内容
                    $csvary[18] = 0; // 課税区分,
                    $csvary[20] = 0; // 単位,
                    $csvary[21] = 0; // $meisai_dt->irisuu;
                    $csvary[22] = 0; // ケース,
                    $csvary[23] = 0; // 倉庫コード,
                    $csvary[24] = 0; // 数量,
                    $csvary[25] = 0; // 単価,
                    $csvary[26] = $meisai_dt->kingaku; // 金額,
                    $csvary[27] = $meisai_dt->tegata_kijitu; // 回収予定日,
                    $csvary[28] = 0; // 税抜額,
                    $csvary[29] = 0; // 原価,
                    $csvary[30] = 0; // 原単価,
                    $csvary[31] = $meisai_dt->bikou; // 備考,
                    $csvary[32] = 0; // 数量小数桁,
                    $csvary[33] = 0; // 単価小数桁,
                    $csvary[34] = 0; // 企画型番がないので個別
                    $csvary[35] = 0; // 色,
                    $csvary[36] = 0; // サイズ,
                    $csvary[37] = ''; // 空白,
                    $csvary[38] = ''; // 空白,
                    $csvary[39] = ''; // 空白,
                    $csvary[40] = $nyuukin_dt->TokuisakiMrs->name; // 得意先名称
                    $csvary[41] = ''; // プロジェクト,
                    $csvary[42] = ''; // プロジェクト副,
                    $csvary[43] = ''; // 予備1,
                    $csvary[44] = ''; // 予備2,
                    $csvary[45] = ''; // 予備3,
                    $csvary[46] = ''; // 予備4,
                    $csvary[47] = ''; // 予備5,
                    $csvary[48] = ''; // 予備6,
                    $csvary[49] = ''; // 予備7,
                    $csvary[50] = ''; // 予備8,
                    $csvary[51] = ''; // 予備9,
                    $csvary[52] = ''; // 予備10,
                    $csvary[53] = $nyuukin_dt->TokuisakiMrs->ryakushou; // 得意先略称,
                    $csvary[54] = $nyuukin_dt->TokuisakiMrs->yuubin_bangou; // 郵便番号,
                    $csvary[55] = $nyuukin_dt->TokuisakiMrs->juusho1; // 住所1,
                    $csvary[56] = $nyuukin_dt->TokuisakiMrs->juusho2; // 住所2,
                    $csvary[57] = $nyuukin_dt->TokuisakiMrs->tel; // TEL,
                    $csvary[58] = $nyuukin_dt->TokuisakiMrs->fax; // FAX,
                    $csvarys[] = $csvary;
                }
            }
        }
        stream_filter_register('crlf', 'crlf_filter');
        $file = fopen($filePath . $fileName, "w");
        if ($file) {
            stream_filter_prepend($file, 'convert.iconv.utf-8/cp932');
            stream_filter_append($file, 'crlf');
            foreach ($csvarys as $csvary) {
                fputcsv($file, $csvary);
            }
            fclose($file);
            $response = new \Phalcon\Http\Response();
            $response->setHeader('Content-Disposition', 'attachment;filename="' . $fileName . '"');
            $response->setHeader('Cache-Control', 'max-age=0');
            $response->setContent(file_get_contents($filePath . $fileName));
            unlink($filePath . $fileName); // delete temp file
            $this->flash->notice("弥生向け入金データを作成しました。" . $fileName);

            $export_yy_log = new ExportYyLogs();
            $export_yy_log->cd = 'nyuukin';
            $export_yy_log->time_from = $time_from;
            $export_yy_log->time_to = $time_to;
            $export_yy_log->name = $yayoi_den_no_s;
            $export_yy_log->den_no_to = $yayoi_den_no;
            if (!$export_yy_log->save()) {
                foreach ($export_yy_log->getMessages() as $message) {
                    $this->flash->error($message);
                }
            }

            return $response;
        } else {
            $this->flash->error("入金データのエクスポートに失敗しました。(" . $fileName . ")");
            $this->view->exp = null;
        }
    }
}

// filter class that applies CRLF line endings
class crlf_filter extends php_user_filter
{
    function filter($in, $out, &$consumed, $closing)
    {
        while ($bucket = stream_bucket_make_writeable($in)) {
            // make sure the line endings aren't already CRLF
            $bucket->data = preg_replace("/(?<!\r)\n/", "\r\n", $bucket->data);
            $consumed += $bucket->datalen;
            stream_bucket_append($out, $bucket);
        }
        return PSFS_PASS_ON;
    }
}

