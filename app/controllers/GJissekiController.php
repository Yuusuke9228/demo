<?php

// @TODO 実績登録ページ及び機能を作成する

use Phalcon\Http\Response;

class GJissekiController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        ControllerBase::indexCd("GJisseki", "計画に対する生産実績一覧");
    }

    /**
     * Searches for g_jisseki
     */
    public function searchAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Displays the creation form
     *
     * @param null $id
     * @param string $dataname
     */
    public function newAction($id = null, $dataname = "GJisseki")
    {
        $this->view->imax = 0;

        if ($id) {
            $nameDts = $dataname;
            $g_jisseki = $nameDts::findFirstByid($id);
            if (!$g_jisseki) {
                $this->flash->error("エラーが発生しました。/ newAction()");
                $this->dispatcher->forward([
                    'controller' => "g_jisseki",
                    'action' => 'index'
                ]);
                return;
            }
            $this->_setDefault($g_jisseki, "new", $dataname);
            $this->tag->setDefault("id", null);
            $this->tag->setDefault("cd", null);
        }
    }

    /**
     * 次へ
     * @param int $id
     */
    public function nextAction($id = 0)
    {
       if ($id != 0 || $id != '') {
            ControllerBase::nextCd($id, "g_jisseki", "GJisseki", "計画に対する生産実績一覧");
        } else {
            $this->flash->warning("データが見つかりません。/ nextAction()");
            $this->dispatcher->forward([
                'controller' => "g_jisseki",
                'action' => 'index'
            ]);
            return;
        }
    }

    /**
     * 前へ
     * @param int $id
     */
    public function prevAction($id = 0)
    {
        if ($id != 0 || $id != '') {
            ControllerBase::prevCd($id, "g_jisseki", "GJisseki", "計画に対する生産実績一覧");
        } else {
            $this->flash->warning("データが見つかりません。/ prevAction()");
            $this->dispatcher->forward([
                'controller' => "g_jisseki",
                'action' => 'index'
            ]);
            return;
        }
    }

    /**
     * 編集画面表示
     *
     * @param integer $id
     */
    public function editAction($id)
    {
        $g_jisseki = GJisseki::findFirstByid($id);
        if (!$g_jisseki) {
            $this->flash->error("データが見つかりませんでした。/ editAction");
            $this->dispatcher->forward([
                'controller' => "g_jisseki",
                'action' => 'index'
            ]);
            return;
        }

        $this->view->id = $g_jisseki->id;
        $this->_setDefault($g_jisseki, "edit");
    }

    /**
     * 画面に表示するデータをセットする
     *
     * @param $g_jisseki
     * @param string $action
     * @param string $meisai
     */
    public function _setDefault($g_jisseki, $action = "edit", $meisai = "GJisseki")
    {
        $setdts = [];
        $this->tag->setDefault("id", $g_jisseki->id);
        $this->tag->setDefault("cd", $g_jisseki->cd);
        $this->tag->setDefault("jissekibi", $g_jisseki->jissekibi);
        $this->tag->setDefault("hacchuu_dt_id", $g_jisseki->hacchuu_dt_id);
        $this->tag->setDefault("hacchuu_dt_cd", $g_jisseki->HacchuuDts->cd);
        $this->tag->setDefault("gyoumu_dt_id", $g_jisseki->gyoumu_dt_id);
        $this->tag->setDefault("gyoumu_dt_cd", $g_jisseki->GyoumuDts->cd);
        $this->tag->setDefault("jisseki_suu", $g_jisseki->jisseki_suu);
        $this->tag->setDefault("jisseki_ryou", $g_jisseki->jisseki_ryou);
        $this->tag->setDefault("hinsitsu_kbn_cd", $g_jisseki->hinsitsu_kbn_cd);
        $this->tag->setDefault("kanryou_flg", $g_jisseki->kanryou_flg);
        $this->tag->setDefault("memo", $g_jisseki->memo);

        $this->tag->setDefault("sakusei_user_id", $g_jisseki->sakusei_user_id);
        $this->tag->setDefault("created", $g_jisseki->created);
        $this->tag->setDefault("kousin_user_id", $g_jisseki->kousin_user_id);
        $this->tag->setDefault("updated", $g_jisseki->updated);

        // この処理いるの？
        foreach ($setdts as $setdt) {
            if (property_exists($g_jisseki, $setdt)) {
                $this->tag->setDefault($setdt, $g_jisseki->$setdt);
            }
        }
    }

    /**
     * 新規登録
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "g_jisseki",
                'action' => 'index'
            ]);
            return;
        }
        $post_flds = [];

        $g_jisseki = new GJisseki();
        $g_jisseki->cd = $this->request->getPost("cd");
        $g_jisseki->jissekibi = $this->request->getPost("jissekibi");
        $g_jisseki->hacchuu_dt_id = $this->request->getPost("hacchuu_dt_id");
        $g_jisseki->gyoumu_dt_id = $this->request->getPost("gyoumu_dt_id");
        $g_jisseki->jisseki_suu = $this->request->getPost("jisseki_suu");
        $g_jisseki->jisseki_ryou = $this->request->getPost("jisseki_ryou");
        $g_jisseki->hinsitsu_kbn_cd = $this->request->getPost("hinsitsu_kbn_cd");
        $g_jisseki->memo = $this->request->getPost("memo");
        $g_jisseki->kanryou_flg = $this->request->getPost("kanryou_flg");

        $thisPost = [];
        foreach ($post_flds as $post_fld) {
            $g_jisseki->$post_fld = array_key_exists($post_fld, $thisPost) ? $thisPost[$post_fld] : $this->request->getPost($post_fld);
        }
        // 伝票番号付番
        $den_ban_ctrl = new DenpyouBangouMrsController();
        $nendo_ban = $den_ban_ctrl->countup('jisseki', 0, $g_jisseki->jissekibi);
        $g_jisseki->cd = $nendo_ban['bangou']; // 伝票番号代入

        if (!$g_jisseki->save()) {
            foreach ($g_jisseki->getMessages() as $message) {
                $this->flash->error($message);
            }
            $this->dispatcher->forward([
                'controller' => "g_jisseki",
                'action' => 'new'
            ]);
            return;
        }

        $this->flash->success("実績データを登録しました。/ createAction");

        $this->dispatcher->forward([
            'controller' => "g_jisseki",
            'action' => 'edit',
            'params' => [$g_jisseki->id]
        ]);
    }

    /**
     * 保存
     *
     */
    public function saveAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "g_jisseki",
                'action' => 'index'
            ]);
            return;
        }

        $id = $this->request->getPost("id");
        $g_jisseki = GJisseki::findFirstByid($id);

        if (!$g_jisseki) {
            $this->flash->error("指定IDの実績データはありません。/ saveAction" . $id);
            $this->dispatcher->forward([
                'controller' => "g_jisseki",
                'action' => 'index'
            ]);
            return;
        }

        if ($g_jisseki->updated !== $this->request->getPost("updated")) {
            $this->flash->error("他プロセスからデータの変更があったので、中止しました。"
                . $id . ",uid=" . $g_jisseki->kousin_user_id . " tb=" . $g_jisseki->updated . " pt=" . $this->request->getPost("updated"));

            $this->dispatcher->forward([
                'controller' => "g_jisseki",
                'action' => 'edit',
                'params' => [$id]
            ]);
            return;
        }

        $post_flds = [];
        $g_jisseki->cd = $this->request->getPost("cd");
        $g_jisseki->jissekibi = $this->request->getPost("jissekibi");
        $g_jisseki->hacchuu_dt_id = $this->request->getPost("hacchuu_dt_id");
        $g_jisseki->gyoumu_dt_id = $this->request->getPost("gyoumu_dt_id");
        $g_jisseki->jisseki_suu = $this->request->getPost("jisseki_suu");
        $g_jisseki->jisseki_ryou = $this->request->getPost("jisseki_ryou");
        $g_jisseki->hinsitsu_kbn_cd = $this->request->getPost("hinsitsu_kbn_cd");
        $g_jisseki->memo = $this->request->getPost("memo");
        $g_jisseki->kanryou_flg = $this->request->getPost("kanryou_flg");

        $chg_flg = 1; //更新テストの為（下のループ意味わからんから、全て更新する）
        $thisPost = [];
        foreach ($post_flds as $post_fld) {
            if ((array_key_exists($post_fld, $thisPost) ? $thisPost[$post_fld] : $this->request->getPost($post_fld)) !== $g_jisseki->$post_fld) {
                $chg_flg = 1;
                break;
            }
        }
        if ($chg_flg === 0) {
            $this->flash->error("変更がありませんでした。" . $id);
            $this->dispatcher->forward([
                "controller" => "g_jisseki",
                "action" => "edit",
                "params" => [$g_jisseki->id]
            ]);
            return;
        }

        // 面倒くさいので、取り敢えずバックアウトは用意していない
//        $this->_bakOut($g_jisseki, 0, $chg_flgs);

        foreach ($post_flds as $post_fld) {
            $g_jisseki->$post_fld = array_key_exists($post_fld, $thisPost) ? $thisPost[$post_fld] : $this->request->getPost($post_fld);
        }

        if (!$g_jisseki->save()) {
            foreach ($g_jisseki->getMessages() as $message) {
                $this->flash->error($message);
            }
            $this->dispatcher->forward([
                'controller' => "g_jisseki",
                'action' => 'edit',
                'params' => [$id]
            ]);
            return;
        }
        $this->flash->success("実績データを更新しました。");

        $this->dispatcher->forward([
            'controller' => "g_jisseki",
            'action' => 'edit',
            'params' => [$g_jisseki->id]
        ]);
    }

    /**
     * Deletes a g_jisseki
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $g_jisseki = GJisseki::findFirstByid($id);
        if (!$g_jisseki) {
            $this->flash->error("実績データが見つかりませんでした。");
            $this->dispatcher->forward([
                'controller' => "g_jisseki",
                'action' => 'index'
            ]);
            return;
        }

        if (!$g_jisseki->delete()) {
            foreach ($g_jisseki->getMessages() as $message) {
                $this->flash->error($message);
            }
            $this->dispatcher->forward([
                'controller' => "g_jisseki",
                'action' => 'search'
            ]);
            return;
        }

        // 面倒くさいので、バックアウトは取り敢えず用意していない
        //$this->_bakOut($g_jisseki, 1);
        $this->flash->success("データの削除しました。");

        $this->dispatcher->forward([
            'controller' => "g_jisseki",
            'action' => "index"
        ]);
    }

    /**
     * 実績データと紐づく計画データも併せて取得・返却
     *
     * @return Response|\Phalcon\Http\ResponseInterface
     */
    public function ajaxGetAction()
    {
        header("Content-type: text/plain; charset=UTF-8");
        $this->view->disable();
        $response = new Response();
        $db = \Phalcon\DI::getDefault()->get('db');

        $cd = $this->request->getPost('cd');
        $jisseki_rows = GJisseki::find("cd = $cd");
        $jisseki_rows = $jisseki_rows->toArray();
        $h_id = $jisseki_rows[0]['hacchuu_dt_id'];

        // 計画詳細
        $phql = "
            SELECT 
                a.id AS hacchuu_dt_id,
                b.id AS gyoumu_dt_id,
                b.cd AS gyoumu_dt_cd,
                c.shouhin_mr_cd AS shouhin_mr_cd,
                c.tekiyou AS tekiyou,
                c.lot AS lot,
                c.iro AS iro,
                c.keikaku_ryou1 AS keikakusuu,
                c.keikaku_ryou2 AS keikakuryou,
                d.name AS model_name,
                c.heiretu_suu AS sui_suu,
                c.kaisi_hiduke AS start_date,
                c.shuuryou_hiduke AS end_date
            FROM hacchuu_dts AS a
            LEFT JOIN gyoumu_dts AS b ON b.hacchuu_dt_id = a.id
            LEFT JOIN gyoumu_meisai_dts AS c ON c.gyoumu_dt_id = b.id
            LEFT JOIN h_kishu_mrs AS d ON c.h_kishu_mr_cd = d.cd
            WHERE a.id = ${h_id}
            ORDER BY b.id DESC
            LIMIT 1
        ";

        $stmt = $db->prepare($phql);
        $stmt->execute();
        $keikaku_rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $rows['keikaku_rows'] = $keikaku_rows;
        $rows['jisseki_rows'] = $jisseki_rows;

        return $response->setContent(json_encode($rows));
    }

    /**
     * 既存の明細データをエクセル出力
     *
     * @return Response|\Phalcon\Http\ResponseInterface
     * @throws PHPExcel_Exception
     * @throws PHPExcel_Reader_Exception
     * @throws PHPExcel_Writer_Exception
     */
    public function printAction()
    {
        $data = $this->request->getPost();

        // Excel出力用ライブラリ
        include __DIR__ . '/../vendor/PHPExcel/Classes/PHPExcel.php';
        include __DIR__ . '/../vendor/PHPExcel/Classes/PHPExcel/Writer/Excel5.php';
        include __DIR__ . '/../vendor/PHPExcel/Classes/PHPExcel/IOFactory.php';

        //テンプレート
        $objReader = PHPExcel_IOFactory::createReader('Excel5');
        $objReader->setIncludeCharts(TRUE);
        $temp_dir = __DIR__ . '/temp/'; // テンプレート
        $temp_path = $temp_dir . 'jisseki.xls';
        $PHPExcel = $objReader->load($temp_path);

        $PHPExcel->setActiveSheetIndex(1);  // データシート
        $sheet = $PHPExcel->getActiveSheet();
        $gyou = 2;
        $sheet->setCellValueByColumnAndRow(0, $gyou, '実績伝票№');
        $sheet->setCellValueByColumnAndRow(1, $gyou, '実績日');
        $sheet->setCellValueByColumnAndRow(2, $gyou, '商品コード');
        $sheet->setCellValueByColumnAndRow(3, $gyou, '摘要');
        $sheet->setCellValueByColumnAndRow(4, $gyou, 'ロット');
        $sheet->setCellValueByColumnAndRow(5, $gyou, '数量１');
        $sheet->setCellValueByColumnAndRow(6, $gyou, '数量２');
        $sheet->setCellValueByColumnAndRow(7, $gyou, 'メモ');
        $sheet->setCellValueByColumnAndRow(8, $gyou, '発注№');
        $sheet->setCellValueByColumnAndRow(9, $gyou, '計画№');
        $sheet->setCellValueByColumnAndRow(10, $gyou, '数1計');
        $sheet->setCellValueByColumnAndRow(11, $gyou, '数2計');
        $sheet->setCellValueByColumnAndRow(12, $gyou, '差異１');
        $sheet->setCellValueByColumnAndRow(13, $gyou, '差異２');
        $sheet->setCellValueByColumnAndRow(14, $gyou, '計画数１');
        $sheet->setCellValueByColumnAndRow(15, $gyou, '計画数２');

        $gyou += 1;
        $sheet->setCellValueByColumnAndRow(0, $gyou, $data['jisseki_cd']);
        $sheet->setCellValueByColumnAndRow(1, $gyou, $data['jissekibi']);
        $sheet->setCellValueByColumnAndRow(2, $gyou, $data['shouhin_mr_cd']);
        $sheet->setCellValueByColumnAndRow(3, $gyou, $data['tekiyou']);
        $sheet->setCellValueByColumnAndRow(4, $gyou, $data['lot']);
        $sheet->setCellValueByColumnAndRow(5, $gyou, $data['num1']);
        $sheet->setCellValueByColumnAndRow(6, $gyou, $data['num2']);
        $sheet->setCellValueByColumnAndRow(7, $gyou, $data['memo']);
        $sheet->setCellValueByColumnAndRow(8, $gyou, $data['hacchuu_dt_cd']);
        $sheet->setCellValueByColumnAndRow(9, $gyou, $data['keikaku_dt_cd']);
        $sheet->setCellValueByColumnAndRow(10, $gyou, $data['suu1_kei']);
        $sheet->setCellValueByColumnAndRow(11, $gyou, $data['suu2_kei']);
        $sheet->setCellValueByColumnAndRow(12, $gyou, $data['sai1']);
        $sheet->setCellValueByColumnAndRow(13, $gyou, $data['sai2']);
        $sheet->setCellValueByColumnAndRow(14, $gyou, $data['keikakusuu']);
        $sheet->setCellValueByColumnAndRow(15, $gyou, $data['keikakuryou']);

        // Excelファイルの保存 ------------------------------------------
        $PHPExcel->setActiveSheetIndex(0);  // 印刷用

        //保存ファイル名
        $filename = uniqid("jisseki_", true) . time() . '.xls'; // ユニーク
        $filename1 = "jisseki" . '.xls';

        $upload = __DIR__ . '/temp/';
        $path = $upload . $filename;

        $objWriter = PHPExcel_IOFactory::createWriter($PHPExcel, 'Excel5'); //2007形式で保存
        $objWriter->setIncludeCharts(TRUE);
        $objWriter->save($path);

        // Excelファイルをクライアントに出力 ----------------------------
        $response = new \Phalcon\Http\Response(); // Redirect output to a client's web browser (Excel2005)
        $response->setHeader('Content-Type', 'application/octet-stream'); //vnd.ms-excel');
        $response->setHeader('Content-Disposition', 'attachment;filename="' . $filename1 . '"');
        $response->setHeader('Cache-Control', 'max-age=0');
        $response->setHeader('Cache-Control', 'max-age=1'); // If you're serving to IE 9, then the following may be needed
        $response->setContent(file_get_contents($path)); //Set the content of the response
        unlink($path); // delete temp file
        return $response; //Return the response
    }

    /**
     * Back Out a g_jisseki
     * 面倒くさいので、取り敢えず実装しない
     *
     * @param string $g_jisseki , $dlt_flg
     */
//    public function _bakOut($g_jisseki, $dlt_flg = 0)
//    {
//
//        $bak_g_jisseki = new BakGJisseki();
//        foreach ($g_jisseki as $fld => $value) {
//            $bak_g_jisseki->$fld = $g_jisseki->$fld;
//        }
//        $bak_g_jisseki->id = NULL;
//        $bak_g_jisseki->id_moto = $g_jisseki->id;
//        $bak_g_jisseki->hikae_dltflg = $dlt_flg;
//        $bak_g_jisseki->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
//        $bak_g_jisseki->hikae_nichiji = date("Y-m-d H:i:s");
//        if (!$bak_g_jisseki->save()) {
//            foreach ($bak_g_jisseki->getMessages() as $message) {
//                $this->flash->error($message);
//            }
//        }
//    }

}
