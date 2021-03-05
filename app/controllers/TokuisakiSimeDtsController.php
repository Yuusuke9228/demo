<?php

class TokuisakiSimeDtsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $di = \Phalcon\DI::getDefault();
        $mgr = $di->get('modelsManager');
        if ($this->request->getPost()) {
            $param = $this->request->getPost();
            $where = "";
            $conditions = [];
            if ($param['shimegrp_kbn_cd'] != '') {
                $where = " WHERE b.shimegrp_kbn_cd = :shimegrp_kbn_cd:";
                $conditions = ["shimegrp_kbn_cd" => $param['shimegrp_kbn_cd'],];
                if (!$param['sime_hiduke'] == '') {
                    $where .= " AND a.sime_hiduke = :sime_hiduke:";
                    $conditions += ["sime_hiduke" => $param['sime_hiduke'],];
                }
            } else {
                if ($param['sime_hiduke'] != '') {
                    $where = " WHERE a.sime_hiduke = :sime_hiduke:";
                    $conditions = ["sime_hiduke" => $param['sime_hiduke'],];
                }
            }

            $phql = "
			        SELECT
			        a.id,
			        a.cd,
			        a.nendo,
			        a.tokuisaki_mr_cd,
			        b.name,
			        a.sime_hiduke,
			        a.kaishuu_yoteibi,
			        a.zenkai_seikyuugaku,
			        a.nyuukingaku,
			        a.konkai_uriagegaku,
			        a.uti_shouhizeigaku,
			        a.updated
			        FROM TokuisakiSimeDts as a
                    LEFT JOIN TokuisakiMrs as b ON b.cd = a.tokuisaki_mr_cd
                    " . $where . "
                    ORDER BY b.cd, a.sime_hiduke
            ";
            $rows = $mgr->executeQuery($phql, $conditions);
            $this->view->rows = $rows;
        }
    }

    public function modalAction ()
    {
        $di = \Phalcon\DI::getDefault();
        $mgr = $di->get('modelsManager');
        if ($this->request->isGet()) {
            $tokuisaki_mr_cd = $this->request->getQuery('tokuisaki_mr_cd');
            $where = "";
            $conditions = [];
            if ($tokuisaki_mr_cd !== '') {
                $where = " WHERE a.tokuisaki_mr_cd = :tokuisaki_mr_cd:";
                $conditions = ["tokuisaki_mr_cd" => $tokuisaki_mr_cd,];
            }
            $phql = "
			        SELECT
			        a.id,
			        a.cd,
			        a.nendo,
			        a.tokuisaki_mr_cd,
			        b.name,
			        a.sime_hiduke,
			        a.kaishuu_yoteibi,
			        a.zenkai_seikyuugaku,
			        a.nyuukingaku,
			        a.konkai_uriagegaku,
			        a.uti_shouhizeigaku,
			        a.updated
			        FROM TokuisakiSimeDts as a
                    LEFT JOIN TokuisakiMrs as b ON b.cd = a.tokuisaki_mr_cd
                    " . $where . "
                    ORDER BY a.sime_hiduke DESC
            ";
            $rows = $mgr->executeQuery($phql, $conditions);
            $this->view->rows = $rows;
        }
    }

    /**
     * TODO 請求書発行
     */
    public function seikyuu_hakkouAction()
    {
        $di = \Phalcon\DI::getDefault();
        $mgr = $di->get('modelsManager');
        if ($this->request->getPost()) {
            $param = $this->request->getPost();
            $where = "";
            $conditions = [];
            if ($param['shimegrp_kbn_cd'] != '') {
                $where = " WHERE b.shimegrp_kbn_cd = :shimegrp_kbn_cd:";
                $conditions = ["shimegrp_kbn_cd" => $param['shimegrp_kbn_cd'],];
                if (!$param['sime_hiduke'] == '') {
                    $where .= " AND a.sime_hiduke = :sime_hiduke:";
                    $conditions += ["sime_hiduke" => $param['sime_hiduke'],];
                }
            } else {
                if ($param['sime_hiduke'] != '') {
                    $where = " WHERE a.sime_hiduke = :sime_hiduke:";
                    $conditions = ["sime_hiduke" => $param['sime_hiduke'],];
                }
            }

            $phql = "
			        SELECT
			        a.id,
			        a.cd,
			        a.nendo,
			        a.tokuisaki_mr_cd,
			        b.name,
			        a.sime_hiduke,
			        a.kaishuu_yoteibi,
			        a.zenkai_seikyuugaku,
			        a.nyuukingaku,
			        a.konkai_uriagegaku,
			        a.uti_shouhizeigaku,
			        a.updated
			        FROM TokuisakiSimeDts as a
                    LEFT JOIN TokuisakiMrs as b ON b.cd = a.tokuisaki_mr_cd
                    " . $where . "
                    ORDER BY b.cd, a.sime_hiduke
            ";
            $rows = $mgr->executeQuery($phql, $conditions);
            $this->view->rows = $rows;
        }
    }

    /*
     * Indexでは、消込時条件指定が出来ない為追加 Add By Nishiyama 2019/6/27
     */
    public function torikesiAction()
    {
        $di = \Phalcon\DI::getDefault();
        $mgr = $di->get('modelsManager');
        if ($this->request->getPost()) {
            $param = $this->request->getPost();
            $where = "";
            $conditions = [];
            if ($param['shimegrp_kbn_cd'] != '') {
                $where = " WHERE b.shimegrp_kbn_cd = :shimegrp_kbn_cd:";
                $conditions = ["shimegrp_kbn_cd" => $param['shimegrp_kbn_cd'],];
                if (!$param['sime_hiduke'] == '') {
                    $where .= " AND a.sime_hiduke = :sime_hiduke:";
                    $conditions += ["sime_hiduke" => $param['sime_hiduke'],];
                }
            } else {
                if ($param['sime_hiduke'] != '') {
                    $where = " WHERE a.sime_hiduke = :sime_hiduke:";
                    $conditions = ["sime_hiduke" => $param['sime_hiduke'],];
                }
            }

            $phql = "
			        SELECT
			        a.id,
			        a.cd,
			        a.nendo,
			        a.tokuisaki_mr_cd,
			        b.name,
			        a.sime_hiduke,
			        a.kaishuu_yoteibi,
			        a.zenkai_seikyuugaku,
			        a.nyuukingaku,
			        a.konkai_uriagegaku,
			        a.uti_shouhizeigaku,
			        a.updated
			        FROM TokuisakiSimeDts as a
                    LEFT JOIN TokuisakiMrs as b ON b.cd = a.tokuisaki_mr_cd
                    " . $where . "
                    ORDER BY a.tokuisaki_mr_cd
            ";
            $rows = $mgr->executeQuery($phql, $conditions);
            $this->view->rows = $rows;
        }
    }

    /**
     * Searches for tokuisaki_sime_dts
     */
    public function searchAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Displays the creation form
     */
    public function newAction($id = null, $dataname = "TokuisakiSimeDts")
    {
        $this->view->imax = 0;

        if ($id) {
            $nameDts = $dataname;
            $tokuisaki_sime_dt = $nameDts::findFirstByid($id);
            if (!$tokuisaki_sime_dt) {
                $this->flash->error("得意先締データが見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "tokuisaki_sime_dts",
                    'action' => 'index'
                ));
                return;
            }
            $this->_setDefault($tokuisaki_sime_dt, "new", $dataname);
            $this->tag->setDefault("id", null);
            $this->tag->setDefault("cd", null);
        }

    }

    /**
     * 修正画面から「次へ」ボタンを押したら次のコードの修正画面になる。
     */
    public function nextAction($id)
    {
        ControllerBase::nextCd($id, "tokuisaki_sime_dts", "TokuisakiSimeDts", "得意先締データ");
    }

    /**
     * 修正画面から「前へ」ボタンを押したら前のコードの修正画面になる。
     */
    public function prevAction($id)
    {
        ControllerBase::prevCd($id, "tokuisaki_sime_dts", "TokuisakiSimeDts", "得意先締データ");
    }

    /**
     * Edits a tokuisaki_sime_dt
     *
     * @param string $id
     */
    public function editAction($id)
    {
//        if (!$this->request->isPost()) {

        $tokuisaki_sime_dt = TokuisakiSimeDts::findFirstByid($id);
        if (!$tokuisaki_sime_dt) {
            $this->flash->error("得意先締データが見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "tokuisaki_sime_dts",
                'action' => 'index'
            ));

            return;
        }

        $this->view->id = $tokuisaki_sime_dt->id;

        $this->_setDefault($tokuisaki_sime_dt, "edit");
//        }
    }

    /**
     * 画面に表示するデータをセットする
     */
    public function _setDefault($tokuisaki_sime_dt, $action = "edit", $meisai = "TokuisakiSimeDts")
    {
        $setdts = ["id",
            "cd",
            "name",
            "tokuisaki_mr_cd",
            "sime_hiduke",
            "nendo",
            "kaishuu_yoteibi",
            "zenkai_seikyuugaku",
            "nyuukingaku",
            "konkai_uriagegaku",
            "uti_shouhizeigaku",
            "id_moto",
            "hikae_dltflg",
            "hikae_user_id",
            "hikae_nichiji",
            "sakusei_user_id",
            "created",
            "kousin_user_id",
            "updated",
        ];

        foreach ($setdts as $setdt) {
            if (property_exists($tokuisaki_sime_dt, $setdt)) {
                $this->tag->setDefault($setdt, $tokuisaki_sime_dt->$setdt);
            }
        }
    }

    /**
     * Creates a new tokuisaki_sime_dt
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "tokuisaki_sime_dts",
                'action' => 'index'
            ));

            return;
        }

        $tokuisaki_sime_dt = new TokuisakiSimeDts();

        $post_flds = [];
        $post_flds = ["cd",
            "name",
            "tokuisaki_mr_cd",
            "sime_hiduke",
            "nendo",
            "kaishuu_yoteibi",
            "zenkai_seikyuugaku",
            "nyuukingaku",
            "konkai_uriagegaku",
            "uti_shouhizeigaku",
            "updated",
        ];

        $thisPost = []; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        foreach ($post_flds as $post_fld) {
            $tokuisaki_sime_dt->$post_fld = array_key_exists($post_fld, $thisPost) ? $thisPost[$post_fld] : $this->request->getPost($post_fld);
        }

        if (!$tokuisaki_sime_dt->save()) {
            foreach ($tokuisaki_sime_dt->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "tokuisaki_sime_dts",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("得意先締データの作成が完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "tokuisaki_sime_dts",
            'action' => 'edit',
            'params' => array($tokuisaki_sime_dt->id)
        ));
    }

    /**
     * Saves a tokuisaki_sime_dt edited
     *
     */
    public function saveAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "tokuisaki_sime_dts",
                'action' => 'index'
            ));
            return;
        }

        $id = $this->request->getPost("id");
        $tokuisaki_sime_dt = TokuisakiSimeDts::findFirstByid($id);

        if (!$tokuisaki_sime_dt) {
            $this->flash->error("得意先締データが見つからなくなりました。" . $id);

            $this->dispatcher->forward(array(
                'controller' => "tokuisaki_sime_dts",
                'action' => 'index'
            ));

            return;
        }

        if ($tokuisaki_sime_dt->updated !== $this->request->getPost("updated")) {
            $this->flash->error("他のプロセスから得意先締データが変更されたため更新を中止しました。"
                . $id . ",uid=" . $tokuisaki_sime_dt->kousin_user_id . " tb=" . $tokuisaki_sime_dt->updated . " pt=" . $this->request->getPost("updated"));

            $this->dispatcher->forward(array(
                'controller' => "tokuisaki_sime_dts",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $post_flds = [];
        $post_flds = ["cd",
            "name",
            "tokuisaki_mr_cd",
            "sime_hiduke",
            "nendo",
            "kaishuu_yoteibi",
            "zenkai_seikyuugaku",
            "nyuukingaku",
            "konkai_uriagegaku",
            "uti_shouhizeigaku",
            "updated",
        ];


        $thisPost = []; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        $chg_flg = 0;
        foreach ($post_flds as $post_fld) {
            if ((array_key_exists($post_fld, $thisPost) ? $thisPost[$post_fld] : $this->request->getPost($post_fld)) !== $tokuisaki_sime_dt->$post_fld) {
                $chg_flg = 1;
                break;
            }
        }
        if ($chg_flg === 0) {
            $this->flash->error("変更がありません。" . $id);

            $this->dispatcher->forward(array(
                "controller" => "tokuisaki_sime_dts",
                "action" => "edit",
                "params" => array($tokuisaki_sime_dt->id)
            ));

            return;
        }

        $this->_bakOut($tokuisaki_sime_dt);

        foreach ($post_flds as $post_fld) {
            $tokuisaki_sime_dt->$post_fld = array_key_exists($post_fld, $thisPost) ? $thisPost[$post_fld] : $this->request->getPost($post_fld);
        }

        if (!$tokuisaki_sime_dt->save()) {

            foreach ($tokuisaki_sime_dt->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "tokuisaki_sime_dts",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $this->flash->success("得意先締データの情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "tokuisaki_sime_dts",
            'action' => 'edit',
            'params' => array($tokuisaki_sime_dt->id)
        ));
    }

    /**
     * Deletes a tokuisaki_sime_dt
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $tokuisaki_sime_dt = TokuisakiSimeDts::findFirstByid($id);
        if (!$tokuisaki_sime_dt) {
            $this->flash->error("得意先締データが見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "tokuisaki_sime_dts",
                'action' => 'torikesi'
            ));

            return;
        }

        $this->_bakOut($tokuisaki_sime_dt, 1);

        if (!$tokuisaki_sime_dt->delete()) {

            foreach ($tokuisaki_sime_dt->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "tokuisaki_sime_dts",
                'action' => 'search'
            ));

            return;
        }

        $this->flash->success("得意先締データの削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "tokuisaki_sime_dts",
            'action' => "torikesi"
        ));
    }

    /**
     * Back Out a tokuisaki_sime_dt
     *
     * @param string $tokuisaki_sime_dt , $dlt_flg
     */
    public function _bakOut($tokuisaki_sime_dt, $dlt_flg = 0)
    {

        $bak_tokuisaki_sime_dt = new BakTokuisakiSimeDts();
        foreach ($tokuisaki_sime_dt as $fld => $value) {
            $bak_tokuisaki_sime_dt->$fld = $tokuisaki_sime_dt->$fld;
        }
        $bak_tokuisaki_sime_dt->id = NULL;
        $bak_tokuisaki_sime_dt->id_moto = $tokuisaki_sime_dt->id;
        $bak_tokuisaki_sime_dt->hikae_dltflg = $dlt_flg;
        $bak_tokuisaki_sime_dt->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_tokuisaki_sime_dt->hikae_nichiji = date("Y-m-d H:i:s");
        if (!$bak_tokuisaki_sime_dt->save()) {
            foreach ($bak_tokuisaki_sime_dt->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
    }

    /**
     * 締切画面
     */
    public function seikyuu_simekiriAction()
    {
        if ($this->request->isPost()) {
            $sime_hiduke = $this->request->getPost("sime_hiduke");
            $kaishuu_yoteibi = $this->request->getPost("kaishuu_yoteibi");
            if (!empty($_POST['simekiri_btn'])) {
                $this->simekiri_shori();
            }
            $shimegrp_kbn_cd = $this->request->getPost("shimegrp_kbn_cd");
        } else {
            $shimegrp_kbn_cd = 31;
            // $sime_hiduke = date('Y-m-d', strtotime('last day of previous month'));
        }
        // このクエリも遅い
        $tokuisaki_mrs = TokuisakiSimeDts::findKonkaiSeikyuu($shimegrp_kbn_cd, $sime_hiduke);
        $this->tag->setDefault("shimegrp_kbn_cd", $shimegrp_kbn_cd);
        $this->tag->setDefault("sime_hiduke", $sime_hiduke);
        $this->tag->setDefault("kaishuu_yoteibi", $kaishuu_yoteibi);
        $this->view->tokuisaki_mrs = $tokuisaki_mrs;
    }

    /**
     * 締切処理
     * 遅すぎて使えない
     */
    public function simekiri_shori()
    {
        $sime_hiduke = $this->request->getPost("sime_hiduke");
        $kaishuu_yoteibi = $this->request->getPost("kaishuu_yoteibi");
        $shimegrp_kbn_cd = $this->request->getPost("shimegrp_kbn_cd");
        foreach (array_keys($_POST) as $key) {
            if (substr($key, 0, 5) == 'code_') {
                $cd = substr($key, 5);
                // ここが遅い
                $rows = TokuisakiSimeDts::findKonkaiSeikyuu($shimegrp_kbn_cd, $sime_hiduke, $cd);
                $row = $rows[0];
                $tokuisaki_sime_dt = new TokuisakiSimeDts();
                /* 伝票番号付番または再設定 */
                $den_ban_ctrl = new DenpyouBangouMrsController(); //伝票番号マスタコントローラ
                $nendo_ban = $den_ban_ctrl->countup('seikyuusho', 0, $sime_hiduke);
                if (!$nendo_ban['nendo']) {
                    $this->flash->error("エラー:年度が未登録（日付が今年か昨年以外は不可）。" . $sime_hiduke);
                }
                $tokuisaki_sime_dt->cd = $nendo_ban['bangou'];
                $tokuisaki_sime_dt->nendo = $nendo_ban['nendo'];
                $tokuisaki_sime_dt->tokuisaki_mr_cd = $cd;
                $tokuisaki_sime_dt->sime_hiduke = $sime_hiduke;
                if ($kaishuu_yoteibi) {
                    $tokuisaki_sime_dt->kaishuu_yoteibi = $kaishuu_yoteibi;
                } else {
                    $tokuisaki_sime_dt->kaishuu_yoteibi =
                        date("Y-m-" . ($row["haraibi"] > 28 ? "t" : $row["haraibi"]),
                            strtotime($sime_hiduke . "+" . ($row["harai_saikuru_kbn_cd"] - 1) . " month"));
                }
                $tokuisaki_sime_dt->zenkai_seikyuugaku = $row['zenkai_seikyuugaku'];
                $tokuisaki_sime_dt->nyuukingaku = $row['nyuukingaku'];
                $tokuisaki_sime_dt->konkai_uriagegaku = $row['uriagegaku'];
                $tokuisaki_sime_dt->uti_shouhizeigaku = $row['shouhizeigaku'];
                if (!$tokuisaki_sime_dt->save()) {
                    foreach ($tokuisaki_sime_dt->getMessages() as $message) {
                        $this->flash->error($message);
                    }
                }
            }
        }
    }

    /**
     * 締切処理（元の処理が遅かったので、最初に読み込んだデータを利用して締めをするように変更）
     */
    public function shime_ajaxAction()
    {
        $this->view->disable();
        $response = new \Phalcon\Http\Response();

        $postData = $this->request->getPost('postData');
        $responseString = ''; // response

        for ($i = 0; $i < count($postData); $i++) {
            $tokuisaki_sime_dt = new TokuisakiSimeDts();
            /* 伝票番号付番または再設定 */
            $den_ban_ctrl = new DenpyouBangouMrsController(); //伝票番号マスタコントローラ
            $harai_saikuru_kbn_cd = $postData[(string)$i]['harai_saikuru_kbn_cd'];
            $sime_hiduke = $postData[(string)$i]['sime_hiduke'];
            $temps = explode('-', $sime_hiduke);
            $tempHiduke = $temps[2];
            $lastDate = explode('-', (string)date('Y-m-d', strtotime('last day of ' . $sime_hiduke)));
            $tempLastHiduke = $lastDate[2];
            $kaishuu_yoteibi = $postData[(string)$i]['kaishuu_yoteibi'];
            $shimegrp_kbn_cd = $postData[(string)$i]['shimegrp_kbn_cd'];

            // 締めデータを再取得するか判別する
            $saisyutokuFlg = false;
            if ($shimegrp_kbn_cd === '31') {
                if ($tempHiduke !== $tempLastHiduke) {
                    $saisyutokuFlg = true;
                } else {
                    $saisyutokuFlg = false;
                }
            } else if ($shimegrp_kbn_cd === '99') {
                $saisyutokuFlg = false;
            } else {
                if ($tempHiduke !== $shimegrp_kbn_cd) {
                    $saisyutokuFlg = true;
                } else {
                    $saisyutokuFlg = false;
                }
            }
            if ($saisyutokuFlg) {
                $rows = TokuisakiSimeDts::findKonkaiSeikyuu($shimegrp_kbn_cd, $sime_hiduke, $postData[(string)$i]['tokuisaki_cd']);
                $row = $rows[0];
                $tokuisaki_sime_dt = new TokuisakiSimeDts();
                /* 伝票番号付番または再設定 */
                $den_ban_ctrl = new DenpyouBangouMrsController(); //伝票番号マスタコントローラ
                $nendo_ban = $den_ban_ctrl->countup('seikyuusho', 0, $sime_hiduke);
                if (!$nendo_ban['nendo']) {
                    $this->flash->error("エラー:年度が未登録（日付が今年か昨年以外は不可）。" . $sime_hiduke);
                }
                $tokuisaki_sime_dt->cd = $nendo_ban['bangou'];
                $tokuisaki_sime_dt->nendo = $nendo_ban['nendo'];
                $tokuisaki_sime_dt->tokuisaki_mr_cd = $postData[(string)$i]['tokuisaki_cd'];
                $tokuisaki_sime_dt->sime_hiduke = $sime_hiduke;
                if ($kaishuu_yoteibi) {
                    $tokuisaki_sime_dt->kaishuu_yoteibi = $kaishuu_yoteibi;
                } else {
                    $tokuisaki_sime_dt->kaishuu_yoteibi =
                        date("Y-m-" . ($row["haraibi"] > 28 ? "t" : $row["haraibi"]),
                            strtotime($sime_hiduke . "+" . ($row["harai_saikuru_kbn_cd"] - 1) . " month"));
                }
                $tokuisaki_sime_dt->zenkai_seikyuugaku = $row['zenkai_seikyuugaku'];
                $tokuisaki_sime_dt->nyuukingaku = $row['nyuukingaku'];
                $tokuisaki_sime_dt->konkai_uriagegaku = $row['uriagegaku'];
                $tokuisaki_sime_dt->uti_shouhizeigaku = $row['shouhizeigaku'];
                if (!$tokuisaki_sime_dt->save()) {
                    foreach ($tokuisaki_sime_dt->getMessages() as $message) {
                        $responseString .= ', ' . $message;
                    }
                }
            } else {
                $nendo_ban = $den_ban_ctrl->countup('seikyuusho', 0, $sime_hiduke);
                if (!$nendo_ban['nendo']) {
                    $this->flash->error("エラー:年度が未登録（日付が今年か昨年以外は不可）。" . $sime_hiduke);
                }

                $tokuisaki_sime_dt->cd = $nendo_ban['bangou'];
                $tokuisaki_sime_dt->nendo = $nendo_ban['nendo'];
                $tokuisaki_sime_dt->tokuisaki_mr_cd = $postData[(string)$i]['tokuisaki_cd'];
                $haraibi = $postData[(string)$i]['haraibi'];
                $tokuisaki_sime_dt->sime_hiduke = $sime_hiduke;

                if ($kaishuu_yoteibi) {
                    $tokuisaki_sime_dt->kaishuu_yoteibi = $kaishuu_yoteibi;
                } else {
                    $tokuisaki_sime_dt->kaishuu_yoteibi =
                        date("Y-m-" . ((int)$haraibi > 28 ? "t" : (int)$haraibi),
                            strtotime($sime_hiduke . "+" . ((int)$harai_saikuru_kbn_cd - 1) . " month"));
                }
                $tokuisaki_sime_dt->zenkai_seikyuugaku = $postData[(string)$i]['zenkai_seikyuugaku'];
                $tokuisaki_sime_dt->nyuukingaku = $postData[(string)$i]['nyuukingaku'];
                $tokuisaki_sime_dt->konkai_uriagegaku = $postData[(string)$i]['uriagegaku'];
                $tokuisaki_sime_dt->uti_shouhizeigaku = $postData[(string)$i]['shouhizeigaku'];
                if (!$tokuisaki_sime_dt->save()) {
                    foreach ($tokuisaki_sime_dt->getMessages() as $message) {
                        $responseString .= ', ' . $message;
                    }
                }
            }

        }
        if ($responseString === '') {
            $responseString = '締め処理完了!';
        }
        $response->setContent(json_encode($responseString));
        return $response;
    }



    /**
     * 請求明細画面
     * パラメタ：請求先、締日、集計単位、請求書番号
     *
     */
    public function seikyuu_meisaiAction($id = null)
    {
        if ($id) {
            $row_konkai = TokuisakiSimeDts::findFirstByid($id);
            if ($row_konkai) {
                $seikyuusaki_mr_cd = $row_konkai->tokuisaki_mr_cd;
                $simebi = $row_konkai->sime_hiduke;
                $shuukei_tanni = 0;
                $seikyuusho_bangou = $row_konkai->cd;
            }
        } elseif ($this->request->isPost()) {
            $seikyuusaki_mr_cd = $this->request->getPost("seikyuusaki_mr_cd");
            $simebi = $this->request->getPost("simebi");
            $shuukei_tanni = $this->request->getPost("shuukei_tanni");
            $seikyuusho_bangou = $this->request->getPost("seikyuusho_bangou");
        } else {
            $seikyuusaki_mr_cd = $this->request->getQuery("seikyuusaki_mr_cd");
            $simebi = $this->request->getQuery("simebi");
            $shuukei_tanni = $this->request->getQuery("shuukei_tanni");
            $seikyuusho_bangou = $this->request->getQuery("seikyuusho_bangou");
        }
        if ($seikyuusho_bangou) { // 請求書番号があれば今回締日を得る
            $row_konkai = TokuisakiSimeDts::findFirst([
                "conditions" => "tokuisaki_mr_cd=?1 and cd=?2",
                "bind" => [1 => $seikyuusaki_mr_cd, 2 => $seikyuusho_bangou],
                "order" => "nendo DESC"
            ]);
            if ($row_konkai) {
                $simebi = $row_konkai->sime_hiduke;
            } else {
                $seikyuusho_bangou = "";
            }
        }
        if (!$simebi && $seikyuusaki_mr_cd) { // 締日が無ければ、得意先の締日条件の締日を得る
            $simebi = TokuisakiMrs::findSimebi($seikyuusaki_mr_cd);
        }
        if (!$seikyuusho_bangou) { // 請求書番号が無ければ今回締日の発行済み請求書番号があれば請求書番号を表示する
            $row_konkai = TokuisakiSimeDts::findFirst([
                "conditions" => "tokuisaki_mr_cd=?1 and sime_hiduke=?2",
                "bind" => [1 => $seikyuusaki_mr_cd, 2 => $simebi]
            ]);
            if ($row_konkai) {
                $seikyuusho_bangou = $row_konkai->cd;
            }
        }
        $row = TokuisakiMrs::findFirst();
        if ($seikyuusaki_mr_cd) {
            $tokuisaki_mr = TokuisakiMrs::findFirst(["conditions" => "cd = ?1", "bind" => [1 => $seikyuusaki_mr_cd]]);
            if ($tokuisaki_mr) {
                $this->tag->setDefault("seikyuusaki_name", $tokuisaki_mr->name);
            }
            $row_zenkais = TokuisakiSimeDts::find([
                "conditions" => "tokuisaki_mr_cd=?1 and sime_hiduke<?2",
                "order" => "sime_hiduke DESC",
                "bind" => [1 => $seikyuusaki_mr_cd, 2 => $simebi]
            ]);
            $date_from = "0000-00-00";
            $zenzen_from = "0000-00-00";
            if (count($row_zenkais) > 0) {
                $date_from = $row_zenkais[0]->sime_hiduke;
            }
            if (count($row_zenkais) > 1) {
                $zenzen_from = $row_zenkais[1]->sime_hiduke;
            }

            $seikyuu_meisais = TokuisakiSimeDts::findSeikyuuMeisai($seikyuusaki_mr_cd, $shuukei_tanni, $zenzen_from, $date_from, $simebi);
        }
        if ($seikyuusho_bangou != '') {
            $sime_joutai = '締切済';
        } else {
            $sime_joutai = '';
        }
        $this->tag->setDefault("seikyuusaki_mr_cd", $seikyuusaki_mr_cd);
        $this->tag->setDefault("simebi", $simebi);
        $this->tag->setDefault("shuukei_tanni", $shuukei_tanni);
        $this->tag->setDefault("seikyuusho_bangou", $seikyuusho_bangou);
        $this->view->row_zenkai = count($row_zenkais) > 0 ? $row_zenkais[0] : null;
        $this->view->seikyuu_meisais = $seikyuu_meisais;
        $this->view->sime_joutai = $sime_joutai;
    }


    /*
     * 一括請求書
     * @param $frmid = 21:一括請求書
     */
    public function print_meisaiAction($id = null, $frmid = 21)
    {
        $chouhyou_mr = ChouhyouMrs::findFirstByid($frmid);
        if (!$chouhyou_mr) {
            $this->flash->error("帳票が見つかりません。帳票ID = {$frmid}");
            $this->dispatcher->forward(array(
                'controller' => "tokuisaki_shime_dts",
                'action' => 'seikyuu_meisai',
                'params' => [$id]
            ));
            return;
        }
        if ($id) {
            $row_konkai = TokuisakiSimeDts::findFirstByid($id);
            if ($row_konkai) {
                $seikyuusaki_mr_cd = $row_konkai->tokuisaki_mr_cd;
                $simebi = $row_konkai->sime_hiduke;
                $shuukei_tanni = 0;
                $seikyuusho_bangou = $row_konkai->cd;
            }
        } elseif ($this->request->isPost()) {
            $seikyuusaki_mr_cd = $this->request->getPost("seikyuusaki_mr_cd");
            $simebi = $this->request->getPost("simebi");
            $shuukei_tanni = $this->request->getPost("shuukei_tanni");
            $seikyuusho_bangou = $this->request->getPost("seikyuusho_bangou");
        } else {
            $seikyuusaki_mr_cd = $this->request->getQuery("seikyuusaki_mr_cd");
            $simebi = $this->request->getQuery("simebi");
            $shuukei_tanni = $this->request->getQuery("shuukei_tanni");
            $seikyuusho_bangou = $this->request->getQuery("seikyuusho_bangou");
        }
        if ($seikyuusho_bangou) { // 請求書番号があれば今回締日を得る
            $row_konkai = TokuisakiSimeDts::findFirst([
                "conditions" => "tokuisaki_mr_cd=?1 and cd=?2",
                "bind" => [1 => $seikyuusaki_mr_cd, 2 => $seikyuusho_bangou],
                "order" => "nendo DESC"
            ]);
            if ($row_konkai) {
                $simebi = $row_konkai->sime_hiduke;
            } else {
                $seikyuusho_bangou = "";
            }
        }
        if (!$simebi && $seikyuusaki_mr_cd) {
            $simebi = TokuisakiMrs::findSimebi($seikyuusaki_mr_cd);
        }
        if (!$seikyuusho_bangou) {
            $row_konkai = TokuisakiSimeDts::findFirst([
                "conditions" => "tokuisaki_mr_cd=?1 and sime_hiduke=?2",
                "bind" => [1 => $seikyuusaki_mr_cd, 2 => $simebi]
            ]);
            if ($row_konkai) {
                $seikyuusho_bangou = $row_konkai->cd;
            }
        }
        $row = TokuisakiMrs::findFirst();
        if ($seikyuusaki_mr_cd) {
            $tokuisaki_mr = TokuisakiMrs::findFirst(["conditions" => "cd = ?1", "bind" => [1 => $seikyuusaki_mr_cd]]);
            if ($tokuisaki_mr) {
                $this->tag->setDefault("seikyuusaki_name", $tokuisaki_mr->name);
            }
            $row_zenkais = TokuisakiSimeDts::find([
                "conditions" => "tokuisaki_mr_cd=?1 and sime_hiduke<?2",
                "order" => "sime_hiduke DESC",
                "bind" => [1 => $seikyuusaki_mr_cd, 2 => $simebi]
            ]);
            $date_from = "0000-00-00";
            $zenzen_from = "0000-00-00";
            if (count($row_zenkais) > 0) {
                $date_from = $row_zenkais[0]->sime_hiduke;
            }
            if (count($row_zenkais) > 1) {
                $zenzen_from = $row_zenkais[1]->sime_hiduke;
            }
            $seikyuu_meisais = TokuisakiSimeDts::findSeikyuuMeisai($seikyuusaki_mr_cd, $shuukei_tanni, $zenzen_from, $date_from, $simebi);
        }

        //集計テーブル
        $last_row = count($seikyuu_meisais) - 1;
        $row_zenkais = $row_zenkais->toArray();
        $zenkai_table = [];
        $zenkai_table['zenkai_seikyuu'] = number_format($zenkaigaku = $row_zenkais[0]['zenkai_seikyuugaku'] - $row_zenkais[0]['nyuukingaku'] + $row_zenkais[0]['konkai_uriagegaku']);
        $zenkai_table['gonyuukin'] = number_format($nyuukingaku = $seikyuu_meisais[$last_row]["nyuukingakuk"]);
        $zenkai_table['kurikoshi'] = number_format($kurikosigaku = $zenkaigaku - $nyuukingaku);
        $zenkai_table['konkai_okaiage'] = number_format($konkaiuriage = $seikyuu_meisais[$last_row]["zeinukigakuk"] + $seikyuu_meisais[$last_row]["zeigakuk"]);
        $zenkai_table['uti_zei'] = number_format($utishouhizei = $seikyuu_meisais[$last_row]["zeigakuk"]);
        $zenkai_table['konkai_seikyuu'] = number_format($konkaiseikyuu = $kurikosigaku + $konkaiuriage);

        //明細テーブル
        $sotozei = 0;
        $idx = 0;
        $meisaidt = [];

        foreach ($seikyuu_meisais as $seikyuu_meisai) {
            if (trim($seikyuu_meisai['kubun']) === 'メモ') {
                continue; // メモは印刷しない
            }
            if ($seikyuu_meisai['denpyou_bangou']) {
                if ($seikyuu_meisai['gyou']) {
                        $meisaidt[$idx]['1'] = $seikyuu_meisai['hiduke'];
                        $meisaidt[$idx]['2'] = $seikyuu_meisai['denpyou_bangou'];
                        $meisaidt[$idx]['3'] = $seikyuu_meisai['kubun'];
                        $meisaidt[$idx]['4'] = $seikyuu_meisai['naiyou'];
                        $meisaidt[$idx]['5'] = $seikyuu_meisai['kazeikubun'];
                        $meisaidt[$idx]['6'] = number_format($seikyuu_meisai['suuryouk'], 2) !== '0.00' ? number_format($seikyuu_meisai['suuryouk'], 2) : '';
                        if (!preg_match('/^([1-9]\d*|0)\.(\d+)?$/', $seikyuu_meisai['tanka'])) {
                            $meisaidt[$idx]['7'] = number_format($seikyuu_meisai['tanka']) !== '0' ? number_format($seikyuu_meisai['tanka']) : '';
                        } else {
                            $meisaidt[$idx]['7'] = number_format($seikyuu_meisai['tanka'], 2) !== '0.00' ? number_format($seikyuu_meisai['tanka'], 2) : '';
                        }
                        if ($seikyuu_meisai['zei_tenka_kbn_cd'] < (int)20) {
                            $sotozei += $seikyuu_meisai['zeigakuk'];
                        } else {
                            $utizei = $seikyuu_meisai['zeigakuk'];
                        }
                        $meisaidt[$idx]['8'] = number_format($seikyuu_meisai['zeinukigakuk'] + $utizei + $seikyuu_meisai['nyuukingakuk']);
                        $meisaidt[$idx]['9'] = $seikyuu_meisai['tanni'];
                        $idx++;
                } else {
                    if (trim($seikyuu_meisai['kubun']) === 'メモ') {
                        continue; // メモは印刷しない
                    }
                    if ($seikyuu_meisai['denpyou_kbn'] === '1' && $seikyuu_meisai['zei_tenka_kbn_cd'] < (int)20) {
                        $meisaidt[$idx]['1'] = $seikyuu_meisai['hiduke'];
                        $meisaidt[$idx]['2'] = $seikyuu_meisai['denpyou_bangou'];
                        $meisaidt[$idx]['3'] = '消費税';
                        $meisaidt[$idx]['4'] = '';
                        $meisaidt[$idx]['5'] = '';
                        $meisaidt[$idx]['6'] = '';
                        $meisaidt[$idx]['7'] = '';
                        $meisaidt[$idx]['8'] = number_format($sotozei);
                        $sotozei = 0;
                        $meisaidt[$idx]['9'] = $seikyuu_meisai['tanni'];
                        $idx++;
                    }
                    if ($seikyuu_meisai['denpyou_kbn'] === '1') {
                        if (trim($seikyuu_meisai['uri_memo'] !== '')) {
                            $meisaidt[$idx]['1'] = $seikyuu_meisai['hiduke'];
                            $meisaidt[$idx]['2'] = $seikyuu_meisai['denpyou_bangou'];
                            $meisaidt[$idx]['3'] = '摘要';
                            $meisaidt[$idx]['4'] = $seikyuu_meisai['uri_memo'];
                            $meisaidt[$idx]['5'] = '';
                            $meisaidt[$idx]['6'] = '';
                            $meisaidt[$idx]['7'] = '';
                            $meisaidt[$idx]['8'] = '';
                            $meisaidt[$idx]['9'] = '';
                            $idx++;
                        }
                        $meisaidt[$idx]['1'] = $seikyuu_meisai['hiduke'];
                        $meisaidt[$idx]['2'] = $seikyuu_meisai['denpyou_bangou'];
                        $meisaidt[$idx]['3'] = '納入先';
                        $meisaidt[$idx]['4'] = $seikyuu_meisai['nounyuusaki'];
                        $meisaidt[$idx]['5'] = '';
                        $meisaidt[$idx]['6'] = '';
                        $meisaidt[$idx]['7'] = '';
                        $meisaidt[$idx]['8'] = '';
                        $meisaidt[$idx]['9'] = '';
                        $idx++;
                    }
//                    $meisaidt[$idx]['1'] = $seikyuu_meisai['hiduke'];
//                    $meisaidt[$idx]['2'] = $seikyuu_meisai['denpyou_bangou'];
//                    $meisaidt[$idx]['3'] = '';
//                    $meisaidt[$idx]['4'] = '≪伝票計≫';
//                    $meisaidt[$idx]['5'] = '';
//                    $meisaidt[$idx]['6'] = '';
//                    $meisaidt[$idx]['7'] = '';
//                    $meisaidt[$idx]['8'] = number_format($seikyuu_meisai['zeinukigakuk'] + $seikyuu_meisai['zeigakuk'] + $seikyuu_meisai['nyuukingakuk']);
//                    $meisaidt[$idx]['9'] = $seikyuu_meisai['tanni'];
//                    $idx++;
                }
            }

        }

        if ($chouhyou_mr->ChouhyouToolKbns->name === 'PDF') {
            return $this->_denpyou_pdf($meisaidt, $chouhyou_mr,$seikyuusaki_mr_cd,$simebi,$zenkai_table,$seikyuusho_bangou);
        }
    }

    /**
     * 一括印刷の受け口
     *
     * @return \Phalcon\Http\Response;
     */
    public function ajaxStartAction ()
    {
        $seikyuusaki_mr_cds = $this->request->getPost("seikyuusaki_mr_cds");
        $simebis = $this->request->getPost("simebis");
        $shuukei_tannis = $this->request->getPost("shuukei_tannis");
        $seikyuusho_bangous = $this->request->getPost("seikyuusho_bangous");

        // 発行したPDFを配列に集める
        $pdfFiles = [];
        for ($i = 0; $i < count($seikyuusaki_mr_cds); $i++) {
            $pdfFiles[$i] = $this->_getPrintData($seikyuusaki_mr_cds[$i], $simebis[$i], $shuukei_tannis[$i], $seikyuusho_bangous[$i]);
        }

        // PDFを一つにまとめる
        $resFile = $this->_putTogetherFiles();

        $response = new \Phalcon\Http\Response();
        return $response->setContent(json_encode($resFile));
    }

    /**
     * 一括請求書を一つにまとめる
     *
     * @return array
     */
    private function _putTogetherFiles ()
    {
        require_once(__DIR__ . '/../vendor/tcpdf/tcpdf.php');
        require_once(__DIR__ . '/../vendor/tcpdf/fpdi.php');
        // 生成されている全てのPDFを取得
        $result = glob('/var/www/html/demo/public/temp/seikyuu_meisai/*');

        $pdf = new FPDI();
        $pdf->setPrintHeader( false );
        $pdf->setPrintFooter( false );
        // PDFをひとまとめにする
        foreach($result as $file) {
            $count = $pdf->setSourceFile( $file );
            for ( $i = 1; $i <= $count; $i++ ) {
                $pdf->addPage();
                $pdf->useTemplate( $pdf->importPage( $i ) );
            }
            unlink($file);
        }

        $filename = uniqid("new_seikyuu_meisai_", false) . '.pdf';
        $path = '/var/www/html/demo/public/temp/' . $filename;
        $pdf->Output($path, 'F');

//        $file = file_get_contents($path);
        $path = str_replace('/var/www/html/demo/public', '', $path);

        return $path;
    }

    /*
     * 一括請求書（一つの請求先への請求明細を発行しファイルパスを返却）
     *
     * @param $seikyuusaki_mr_cd
     * @param $simebi
     * @param $shuukei_tanni
     * @param $seikyuusho_bangou
     * @return string
     */
    public function _getPrintData ($seikyuusaki_mr_cd, $simebi, $shuukei_tanni, $seikyuusho_bangou)
    {
        $frmid = 21;
        $chouhyou_mr = ChouhyouMrs::findFirstByid($frmid);
        if (!$chouhyou_mr) {
            $this->flash->error("帳票が見つかりません。帳票ID = {$frmid}");
            return;
        }

        if ($seikyuusho_bangou) { // 請求書番号があれば今回締日を得る
            $row_konkai = TokuisakiSimeDts::findFirst([
                "conditions" => "tokuisaki_mr_cd=?1 and cd=?2",
                "bind" => [1 => $seikyuusaki_mr_cd, 2 => $seikyuusho_bangou],
                "order" => "nendo DESC"
            ]);
            if ($row_konkai) {
                $simebi = $row_konkai->sime_hiduke;
            } else {
                $seikyuusho_bangou = "";
            }
        }
        if (!$simebi && $seikyuusaki_mr_cd) {
            $simebi = TokuisakiMrs::findSimebi($seikyuusaki_mr_cd);
        }
        if (!$seikyuusho_bangou) {
            $row_konkai = TokuisakiSimeDts::findFirst([
                "conditions" => "tokuisaki_mr_cd=?1 and sime_hiduke=?2",
                "bind" => [1 => $seikyuusaki_mr_cd, 2 => $simebi]
            ]);
            if ($row_konkai) {
                $seikyuusho_bangou = $row_konkai->cd;
            }
        }
        $row = TokuisakiMrs::findFirst();
        if ($seikyuusaki_mr_cd) {
            $tokuisaki_mr = TokuisakiMrs::findFirst(["conditions" => "cd = ?1", "bind" => [1 => $seikyuusaki_mr_cd]]);
            if ($tokuisaki_mr) {
                $this->tag->setDefault("seikyuusaki_name", $tokuisaki_mr->name);
            }
            $row_zenkais = TokuisakiSimeDts::find([
                "conditions" => "tokuisaki_mr_cd=?1 and sime_hiduke<?2",
                "order" => "sime_hiduke DESC",
                "bind" => [1 => $seikyuusaki_mr_cd, 2 => $simebi]
            ]);
            $date_from = "0000-00-00";
            $zenzen_from = "0000-00-00";
            if (count($row_zenkais) > 0) {
                $date_from = $row_zenkais[0]->sime_hiduke;
            }
            if (count($row_zenkais) > 1) {
                $zenzen_from = $row_zenkais[1]->sime_hiduke;
            }
            $seikyuu_meisais = TokuisakiSimeDts::findSeikyuuMeisai($seikyuusaki_mr_cd, $shuukei_tanni, $zenzen_from, $date_from, $simebi);
        }

        //集計テーブル
        $last_row = count($seikyuu_meisais) - 1;
        $row_zenkais = $row_zenkais->toArray();
        $zenkai_table = [];
        $zenkai_table['zenkai_seikyuu'] = number_format($zenkaigaku = $row_zenkais[0]['zenkai_seikyuugaku'] - $row_zenkais[0]['nyuukingaku'] + $row_zenkais[0]['konkai_uriagegaku']);
        $zenkai_table['gonyuukin'] = number_format($nyuukingaku = $seikyuu_meisais[$last_row]["nyuukingakuk"]);
        $zenkai_table['kurikoshi'] = number_format($kurikosigaku = $zenkaigaku - $nyuukingaku);
        $zenkai_table['konkai_okaiage'] = number_format($konkaiuriage = $seikyuu_meisais[$last_row]["zeinukigakuk"] + $seikyuu_meisais[$last_row]["zeigakuk"]);
        $zenkai_table['uti_zei'] = number_format($utishouhizei = $seikyuu_meisais[$last_row]["zeigakuk"]);
        $zenkai_table['konkai_seikyuu'] = number_format($konkaiseikyuu = $kurikosigaku + $konkaiuriage);

        //明細テーブル
        $sotozei = 0;
        $idx = 0;
        $meisaidt = [];
        foreach ($seikyuu_meisais as $seikyuu_meisai) {
            if ($seikyuu_meisai['denpyou_bangou']) {
                if (trim($seikyuu_meisai['kubun']) === 'メモ') {
                    continue;
                }
                if ($seikyuu_meisai['gyou']) {
                    $meisaidt[$idx]['1'] = $seikyuu_meisai['hiduke'];
                    $meisaidt[$idx]['2'] = $seikyuu_meisai['denpyou_bangou'];
                    $meisaidt[$idx]['3'] = $seikyuu_meisai['kubun'];
                    $meisaidt[$idx]['4'] = $seikyuu_meisai['naiyou'];
                    $meisaidt[$idx]['5'] = $seikyuu_meisai['kazeikubun'];
                    $meisaidt[$idx]['6'] = number_format($seikyuu_meisai['suuryouk'], 2) !== '0.00' ? number_format($seikyuu_meisai['suuryouk'], 2) : '';
                    if(!preg_match('/^([1-9]\d*|0)\.(\d+)?$/', $seikyuu_meisai['tanka'])) {
                        $meisaidt[$idx]['7'] = number_format($seikyuu_meisai['tanka']) !== '0' ? number_format($seikyuu_meisai['tanka']) : '';
                    } else {
                        $meisaidt[$idx]['7'] = number_format($seikyuu_meisai['tanka'], 2) !== '0.00' ? number_format($seikyuu_meisai['tanka'], 2) : '';
                    }
                    if ($seikyuu_meisai['zei_tenka_kbn_cd'] < (int)20) {
                        $sotozei += $seikyuu_meisai['zeigakuk'];
                    } else {
                        $utizei = $seikyuu_meisai['zeigakuk'];
                    }
                    $meisaidt[$idx]['8'] = number_format($seikyuu_meisai['zeinukigakuk'] + $utizei + $seikyuu_meisai['nyuukingakuk']);
                    $meisaidt[$idx]['9'] = $seikyuu_meisai['tanni'];
                    $idx++;
                } else {
                    if (trim($seikyuu_meisai['kubun']) === 'メモ') {
                        continue;
                    }
                    if ($seikyuu_meisai['denpyou_kbn'] === '1' && $seikyuu_meisai['zei_tenka_kbn_cd'] < (int)20) {
                        $meisaidt[$idx]['1'] = $seikyuu_meisai['hiduke'];
                        $meisaidt[$idx]['2'] = $seikyuu_meisai['denpyou_bangou'];
                        $meisaidt[$idx]['3'] = '消費税';
                        $meisaidt[$idx]['4'] = '';
                        $meisaidt[$idx]['5'] = '';
                        $meisaidt[$idx]['6'] = '';
                        $meisaidt[$idx]['7'] = '';
                        $meisaidt[$idx]['8'] = number_format($sotozei);
                        $sotozei = 0;
                        $meisaidt[$idx]['9'] = $seikyuu_meisai['tanni'];
                        $idx++;
                    }
                    if ($seikyuu_meisai['denpyou_kbn'] === '1') {
                        if (trim($seikyuu_meisai['uri_memo'] !== '')) {
                            $meisaidt[$idx]['1'] = $seikyuu_meisai['hiduke'];
                            $meisaidt[$idx]['2'] = $seikyuu_meisai['denpyou_bangou'];
                            $meisaidt[$idx]['3'] = '摘要';
                            $meisaidt[$idx]['4'] = $seikyuu_meisai['uri_memo'];
                            $meisaidt[$idx]['5'] = '';
                            $meisaidt[$idx]['6'] = '';
                            $meisaidt[$idx]['7'] = '';
                            $meisaidt[$idx]['8'] = '';
                            $meisaidt[$idx]['9'] = '';
                            $idx++;
                        }
                        $meisaidt[$idx]['1'] = $seikyuu_meisai['hiduke'];
                        $meisaidt[$idx]['2'] = $seikyuu_meisai['denpyou_bangou'];
                        $meisaidt[$idx]['3'] = '納入先';
                        $meisaidt[$idx]['4'] = $seikyuu_meisai['nounyuusaki'];
                        $meisaidt[$idx]['5'] = '';
                        $meisaidt[$idx]['6'] = '';
                        $meisaidt[$idx]['7'] = '';
                        $meisaidt[$idx]['8'] = '';
                        $meisaidt[$idx]['9'] = '';
                        $idx++;
                    }
//                    $meisaidt[$idx]['1'] = $seikyuu_meisai['hiduke'];
//                    $meisaidt[$idx]['2'] = $seikyuu_meisai['denpyou_bangou'];
//                    $meisaidt[$idx]['3'] = '';
//                    $meisaidt[$idx]['4'] = '≪伝票計≫';
//                    $meisaidt[$idx]['5'] = '';
//                    $meisaidt[$idx]['6'] = '';
//                    $meisaidt[$idx]['7'] = '';
//                    $meisaidt[$idx]['8'] = number_format($seikyuu_meisai['zeinukigakuk'] + $seikyuu_meisai['zeigakuk'] + $seikyuu_meisai['nyuukingakuk']);
//                    $meisaidt[$idx]['9'] = $seikyuu_meisai['tanni'];
//                    $idx++;
                }
            }

        }

        if ($chouhyou_mr->ChouhyouToolKbns->name === 'PDF') {
            return $resFile = $this->_denpyou_pdf2($meisaidt, $chouhyou_mr, $seikyuusaki_mr_cd, $simebi, $zenkai_table, $seikyuusho_bangou);
        } else {
            return '';
        }
    }

    private function _denpyou_pdf2($meisaidt, $chouhyou_mr, $seikyuusaki_mr_cd, $simebi, $zenkai_table, $seikyuusho_bangou, $pdf = null){
        require_once(__DIR__ . '/../vendor/tcpdf/tcpdf.php');
        require_once(__DIR__ . '/../vendor/tcpdf/fpdi.php');
        $goukeis = [];
        $goukeis['meisai_cnt'] = 0;
        foreach ($meisaidt as $meisai) {
            if ($chouhyou_mr->meisai_lvl == 0) {
                $goukeis['meisai_cnt']++;
            }
        }
        $goukeis['maxpage'] = (ceil(count($meisaidt) / $chouhyou_mr->meisai_pp)) ?? 1;
        if ($pdf) {
            $renzoku = true;
        } else {
            $renzoku = false;
            $pdf = new FPDI($chouhyou_mr->yousi_houkou, 'mm', $chouhyou_mr->yousi_size, true, 'UTF-8');
        }
        $kihon_mr = KihonMrs::findFirstByid(1);
        $tokuisaki_mr = TokuisakiMrs::findFirst("seikyuusaki_mr_cd = {$seikyuusaki_mr_cd}"); //請求先情報
        $pgdtgyou = 0;
        for ($page = 1; $page <= $goukeis['maxpage']; $page++) {
            $pdf->SetFont('ipamp', '', 11);
            $pdf->SetAutoPageBreak(false);
            $pdf->setPrintHeader(false);
            $pdf->setPrintFooter(false);
            $pdf->AddPage();
            if ($chouhyou_mr->hinagata) {
                try {
                    $pdf->setSourceFile(__DIR__ . '/../../public/img/' . $chouhyou_mr->hinagata);
                } catch (Exception $e) {
                    echo $e->getMessage();
                }
                $tplIdx = $pdf->importPage(1);
                $pdf->useTemplate($tplIdx, null, null, null, null, true);
            }

            foreach ($chouhyou_mr->ChouhyouTextZokuseiMrs as $zokusei) {
                $gyousuu = 1;
                if ($zokusei->kmk_table === 'seikyuu_meisai') {
                    $gyousuu = $chouhyou_mr->meisai_pp;
                }
                $dtgyou1 = $pgdtgyou;
                $kmk_cd = $zokusei->kmk_cd;
                $cols = $this->tcpdfcols($zokusei->moji_iro);
                $pdf->SetTextColor($cols[0], $cols[1], $cols[2], $cols[3]);
                $cols = $this->tcpdfcols($zokusei->nuri_iro);
                $pdf->SetFillColor($cols[0], $cols[1], $cols[2], $cols[3]);
                $cols = $this->tcpdfcols($zokusei->waku_iro);
                $pdf->SetDrawColor($cols[0], $cols[1], $cols[2], $cols[3]);
                $pdf->SetLineWidth($zokusei->waku_huto);
                $pdf->SetFont($zokusei->FontKbns->cd, $zokusei->font_style, $zokusei->font_size);
                for ($gyou = 0; $gyou < $gyousuu && $page * $gyousuu - $gyousuu + $gyou < $goukeis['meisai_cnt'] && $zokusei->kmk_table === 'seikyuu_meisai' || $gyou < 1; $gyou++) {
                    if ($zokusei->kmk_table === 'kihon_mrs') {
                        $target = $kihon_mr;
                    } else if ($zokusei->kmk_table === 'tokuisaki_mrs') {
                        $target = $tokuisaki_mr;
                    } else if ($zokusei->kmk_table === 'seikyuu_meisai') {
                        for ($dtgyou = $dtgyou1;
                             $chouhyou_mr->meisai_lvl != 0 &&
                             $dtgyou < count($meisaidt);
                             $dtgyou++) { /* dummy body */ }
                        $dtgyou1 = $dtgyou + 1;
                    }
                    else if ($zokusei->kmk_table === 'zenkai_table') {
                        $target = $zenkai_table;
                    } else {
                        $target = $zokusei;
                        if ($kmk_cd !== 'name') {
                            $target->name = $goukeis[$kmk_cd];
                            $kmk_cd = 'name';
                        }
                    }
                    $pdf->SetXY($zokusei->yoko_zahyou + $gyou * $chouhyou_mr->meisai_yokokan, $zokusei->tate_zahyou + $gyou * $chouhyou_mr->meisai_tatekan);
                    switch ($zokusei->kmk_shuushoku) {
                        case 'shimebi':
                            $text =  date('Y年m月d日', strtotime($simebi)) . "　締切分";
                            break;
                        case 'page':
                            $text = $page;
                            break;
                        case 't_yuubin':
                            $text = $tokuisaki_mr->yuubin_bangou;
                            break;
                        case 't_jusho1':
                            $text = $tokuisaki_mr->juusho1;
                            break;
                        case 't_jusho2':
                            $text = $tokuisaki_mr->juusho2;
                            break;
                        case 't_name':
                            $text = $tokuisaki_mr->name;
                            break;
                        case 't_keisho':
                            $text = $tokuisaki_mr->keishou;
                            break;
                        case 'seik_no':
                            $text = $seikyuusho_bangou;
                            break;
                        case 'j_yuubin':
                            $text = $kihon_mr->yuubin_bangou;
                            break;
                        case 'j_jusho1':
                            $text = $kihon_mr->juusho1;
                            break;
                        case 'j_jusho2':
                            $text = $kihon_mr->juusho2;
                            break;
                        case 'j_name':
                            $text = $kihon_mr->name;
                            break;
                        case 'j_tel':
                            $text = 'TEL:' . $kihon_mr->tel;
                            break;
                        case 'j_fax':
                            $text = 'FAX:' . $kihon_mr->fax;
                            break;
                        case 'j_cho1':
                            $text = $kihon_mr->chouhyou1;
                            break;
                        case 'j_cho2':
                            $text = $kihon_mr->chouhyou2;
                            break;
                        case 'image':
                            $text = '';
                            $pdf->Image(
                                __DIR__ . '/../../public/' . $zokusei->sanshou . '/' . $zokusei->kmk_cd,
                                '', '',
                                $zokusei->waku_haba,
                                $zokusei->waku_taka,
                                '', '', '', true
                            );
                            break;
                        case 'zen_gaku':
                            $text = $page === 1 ? $zenkai_table['zenkai_seikyuu'] : '************';
                            break;
                        case 'nyu_gaku':
                            $text = $page === 1 ? $zenkai_table['gonyuukin'] : '************';
                            break;
                        case 'kurikosi':
                            $text = $page === 1 ? $zenkai_table['kurikoshi'] : '************';
                            break;
                        case 'kon_uri':
                            $text = $page === 1 ? $zenkai_table['konkai_okaiage'] : '************';
                            break;
                        case 'uti_zei':
                            $text = $page === 1 ? $zenkai_table['uti_zei'] : '************';
                            break;
                        case 'seik_gak':
                            $text = $page === 1 ? $zenkai_table['konkai_seikyuu'] : '************';
                            break;
                        case 'uriagebi':
                            if ($meisaidt[$dtgyou - 1]['1'] === $meisaidt[$dtgyou]['1']) {
                                $text = '';
                            } else {
                                $text = date('m.d',  strtotime($meisaidt[$dtgyou]['1']));
                            }
                            break;
                        case 'den_no':
                            if ($meisaidt[$dtgyou - 1]['2'] === $meisaidt[$dtgyou]['2']) {
                                $text = '';
                            } else {
                                $text = $meisaidt[$dtgyou]['2'];
                            }
                            break;
                        case 'tekiyou':
                            if ($meisaidt[$dtgyou]['3'] === '消費税') {
                                $text = '消費税';
                            } else {
                                $text = $meisaidt[$dtgyou]['4'];
                            }
                            break;
                        case 'suuryou':
                            $text = $meisaidt[$dtgyou]['6'];
                            break;
                        case 'tani':
                            $text = $meisaidt[$dtgyou]['6'] !== '' ? $meisaidt[$dtgyou]['9'] : '';
                            break;
                        case 'tanka':
                            $text = $meisaidt[$dtgyou]['7'];
                            break;
                        case 'kingaku':
                            $text = $meisaidt[$dtgyou]['8'];
                            break;
                        default:
                            $text = '';
                            break;
                    }
                    $pdf->Cell(
                        $zokusei->waku_haba,
                        $zokusei->waku_taka,
                        $text,
                        $zokusei->waku,
                        0,
                        $zokusei->align,
                        $zokusei->nuri_iro == '' ? 0 : 1,
                        '',
                        $zokusei->stretch,
                        false,
                        $zokusei->calign,
                        $zokusei->valign
                    );
                }
            }
            $pgdtgyou = $dtgyou + 1;
        }

        if (!$renzoku) {
            $filename = uniqid("seikyuu_meisai_", false) . '.pdf';
            $path = '/var/www/html/demo/public/temp/seikyuu_meisai/' . $filename;
            $pdf->Output($path, 'F');

            $file = file_get_contents($path);
            $path = str_replace('/var/www/html/demo/public', '', $path);
            return $path;
        } else {
            return '';
        }
    }

    public function _denpyou_pdf($meisaidt, $chouhyou_mr, $seikyuusaki_mr_cd, $simebi, $zenkai_table, $seikyuusho_bangou, $pdf = null){
        require_once(__DIR__ . '/../vendor/tcpdf/tcpdf.php');
        require_once(__DIR__ . '/../vendor/tcpdf/fpdi.php');
        $goukeis = [];
        $goukeis['meisai_cnt'] = 0;
        foreach ($meisaidt as $meisai) {
            if ($chouhyou_mr->meisai_lvl == 0) {
                $goukeis['meisai_cnt']++;
            }
        }
        $goukeis['maxpage'] = (ceil(count($meisaidt) / $chouhyou_mr->meisai_pp)) ?? 1;
        if ($pdf) {
            $renzoku = true;
        } else {
            $renzoku = false;
            $pdf = new FPDI($chouhyou_mr->yousi_houkou, 'mm', $chouhyou_mr->yousi_size, true, 'UTF-8');
        }
        $kihon_mr = KihonMrs::findFirstByid(1);
        $tokuisaki_mr = TokuisakiMrs::findFirst("seikyuusaki_mr_cd = {$seikyuusaki_mr_cd}"); //請求先情報
        $pgdtgyou = 0;
        for ($page = 1; $page <= $goukeis['maxpage']; $page++) {
            $pdf->SetFont('ipamp', '', 11);
            $pdf->SetAutoPageBreak(false);
            $pdf->setPrintHeader(false);
            $pdf->setPrintFooter(false);
            $pdf->AddPage();
            if ($chouhyou_mr->hinagata) {
                try {
                    $pdf->setSourceFile(__DIR__ . '/../../public/img/' . $chouhyou_mr->hinagata);
                } catch (Exception $e) {
                    echo $e->getMessage();
                }
                $tplIdx = $pdf->importPage(1);
                $pdf->useTemplate($tplIdx, null, null, null, null, true);
            }

            foreach ($chouhyou_mr->ChouhyouTextZokuseiMrs as $zokusei) {
                $gyousuu = 1;
                if ($zokusei->kmk_table === 'seikyuu_meisai') {
                    $gyousuu = $chouhyou_mr->meisai_pp;
                }
                $dtgyou1 = $pgdtgyou;
                $kmk_cd = $zokusei->kmk_cd;
                $cols = $this->tcpdfcols($zokusei->moji_iro);
                $pdf->SetTextColor($cols[0], $cols[1], $cols[2], $cols[3]);
                $cols = $this->tcpdfcols($zokusei->nuri_iro);
                $pdf->SetFillColor($cols[0], $cols[1], $cols[2], $cols[3]);
                $cols = $this->tcpdfcols($zokusei->waku_iro);
                $pdf->SetDrawColor($cols[0], $cols[1], $cols[2], $cols[3]);
                $pdf->SetLineWidth($zokusei->waku_huto);
                $pdf->SetFont($zokusei->FontKbns->cd, $zokusei->font_style, $zokusei->font_size);
                for ($gyou = 0; $gyou < $gyousuu && $page * $gyousuu - $gyousuu + $gyou < $goukeis['meisai_cnt'] && $zokusei->kmk_table === 'seikyuu_meisai' || $gyou < 1; $gyou++) {
                    if ($zokusei->kmk_table === 'kihon_mrs') {
                        $target = $kihon_mr;
                    } else if ($zokusei->kmk_table === 'tokuisaki_mrs') {
                        $target = $tokuisaki_mr;
                    } else if ($zokusei->kmk_table === 'seikyuu_meisai') {
                        for ($dtgyou = $dtgyou1;
                             $chouhyou_mr->meisai_lvl != 0 &&
                             $dtgyou < count($meisaidt);
                             $dtgyou++) { /* dummy body */ }
                        $dtgyou1 = $dtgyou + 1;
                    }
                    else if ($zokusei->kmk_table === 'zenkai_table') {
                        $target = $zenkai_table;
                    } else {
                        $target = $zokusei;
                        if ($kmk_cd !== 'name') {
                            $target->name = $goukeis[$kmk_cd];
                            $kmk_cd = 'name';
                        }
                    }
                    $pdf->SetXY($zokusei->yoko_zahyou + $gyou * $chouhyou_mr->meisai_yokokan, $zokusei->tate_zahyou + $gyou * $chouhyou_mr->meisai_tatekan);
                    switch ($zokusei->kmk_shuushoku) {
                        case 'shimebi':
                            $text =  date('Y年m月d日', strtotime($simebi)) . "　締切分";
                            break;
                        case 'page':
                            $text = $page;
                            break;
                        case 't_yuubin':
                            $text = $tokuisaki_mr->yuubin_bangou;
                            break;
                        case 't_jusho1':
                            $text = $tokuisaki_mr->juusho1;
                            break;
                        case 't_jusho2':
                            $text = $tokuisaki_mr->juusho2;
                            break;
                        case 't_name':
                            $text = $tokuisaki_mr->name;
                            break;
                        case 't_gotant':
                            $text = $tokuisaki_mr->gotantousha;
                            break;
                        case 't_keisho':
                            $text = $tokuisaki_mr->keishou;
                            break;
                        case 'seik_no':
                            $text = $seikyuusho_bangou;
                            break;
                        case 'j_yuubin':
                            $text = $kihon_mr->yuubin_bangou;
                            break;
                        case 'j_jusho1':
                            $text = $kihon_mr->juusho1;
                            break;
                        case 'j_jusho2':
                            $text = $kihon_mr->juusho2;
                            break;
                        case 'j_name':
                            $text = $kihon_mr->name;
                            break;
                        case 'j_tel':
                            $text = 'TEL:' . $kihon_mr->tel;
                            break;
                        case 'j_fax':
                            $text = 'FAX:' . $kihon_mr->fax;
                            break;
                        case 'j_cho1':
                            $text = $kihon_mr->chouhyou1;
                            break;
                        case 'j_cho2':
                            $text = $kihon_mr->chouhyou2;
                            break;
                        case 'image':
                            $text = '';
                            $pdf->Image(
                                __DIR__ . '/../../public/' . $zokusei->sanshou . '/' . $zokusei->kmk_cd,
                                '', '',
                                $zokusei->waku_haba,
                                $zokusei->waku_taka,
                                '', '', '', true
                            );
                            break;
                        case 'zen_gaku':
                            $text = $page === 1 ? $zenkai_table['zenkai_seikyuu'] : '************';
                            break;
                        case 'nyu_gaku':
                            $text = $page === 1 ? $zenkai_table['gonyuukin'] : '************';
                            break;
                        case 'kurikosi':
                            $text = $page === 1 ? $zenkai_table['kurikoshi'] : '************';
                            break;
                        case 'kon_uri':
                            $text = $page === 1 ? $zenkai_table['konkai_okaiage'] : '************';
                            break;
                        case 'uti_zei':
                            $text = $page === 1 ? $zenkai_table['uti_zei'] : '************';
                            break;
                        case 'seik_gak':
                            $text = $page === 1 ? $zenkai_table['konkai_seikyuu'] : '************';
                            break;
                        case 'uriagebi':
                            if ($meisaidt[$dtgyou - 1]['1'] === $meisaidt[$dtgyou]['1']) {
                                $text = '';
                            } else {
                                $text = date('m.d',  strtotime($meisaidt[$dtgyou]['1']));
                            }
                            break;
                        case 'den_no':
                            if ($meisaidt[$dtgyou - 1]['2'] === $meisaidt[$dtgyou]['2']) {
                                $text = '';
                            } else {
                                $text = $meisaidt[$dtgyou]['2'];
                            }
                            break;
                        case 'tekiyou':
                            if ($meisaidt[$dtgyou]['3'] === '消費税') {
                                $text = '消費税';
                            } else {
                                $text = $meisaidt[$dtgyou]['4'];
                            }
                            break;
                        case 'suuryou':
                            $text = $meisaidt[$dtgyou]['6'];
                            break;
                        case 'tani':
                            $text = $meisaidt[$dtgyou]['6'] !== '' ? $meisaidt[$dtgyou]['9'] : '';
                            break;
                        case 'tanka':
                            $text = $meisaidt[$dtgyou]['7'];
                            break;
                        case 'kingaku':
                            $text = $meisaidt[$dtgyou]['8'];
                            break;
                        default:
                            $text = '';
                            break;
                    }
                    $pdf->Cell(
                        $zokusei->waku_haba,
                        $zokusei->waku_taka,
                        $text,
                        $zokusei->waku,
                        0,
                        $zokusei->align,
                        $zokusei->nuri_iro == '' ? 0 : 1,
                        '',
                        $zokusei->stretch,
                        false,
                        $zokusei->calign,
                        $zokusei->valign
                    );
                }
            }
            $pgdtgyou = $dtgyou + 1;
        }

        if (!$renzoku) {
            $filename = uniqid("seikyuu_meisai_", false) . '.pdf';
            $path = __DIR__ . '/temp/' . $filename;
            $pdf->Output($path, 'F');
            $response = new \Phalcon\Http\Response();
            $response->setHeader('Content-Type', 'application/pdf');
            $response->setHeader('Content-Disposition', 'attachment;filename="seikyuu_meisai_"');
            $response->setHeader('Cache-Control', 'max-age=0');
            $response->setHeader('Cache-Control', 'max-age=1');
            $response->setContent(file_get_contents($path));
            unlink($path);
            $this->flash->success("一括請求書のPDFを出力しました。");
            return $response;
        }
        echo '<br />K ';
    }

    public function tcpdfcols($iro)
    {
        $cols = [0, -1, -1, -1];
        if (strlen($iro) > 0) {
            $col[0] = hexdec(substr($iro, 0, 2));
        }
        if (strlen($iro) > 2) {
            $col[1] = hexdec(substr($iro, 2, 2));
        }
        if (strlen($iro) > 4) {
            $col[2] = hexdec(substr($iro, 4, 2));
        }
        if (strlen($iro) > 6) {
            $col[3] = hexdec(substr($iro, 6, 2));
        }
        return $cols;
    }

    /**
     * 最終締日取得
     */
    public function ajax_shimebiAction()
    {
        $this->view->disable();
        $response = new \Phalcon\Http\Response();

        $dates = TokuisakiSimeDts::find([
	        'columns' => array('tokuisaki_mr_cd, sime_hiduke'),
            'order' => 'id DESC',
            'conditions' => 'tokuisaki_mr_cd LIKE ?1 ',
            'bind' => [1 => $this->request->getPost('cd') . '%']
        ]);
        $responseString = $dates[0]['sime_hiduke'];
        $response->setContent(json_encode(['sime_hiduke' => $responseString]));
        return $response;
    }

    /**
     * 締切取消
     */
    public function ajax_delAction()
    {
        $this->view->disable();
        $response = new \Phalcon\Http\Response();
        $id = $this->request->getPost('id');
        $tokuisaki_mr_cd = $this->request->getPost('tokuisaki_mr_cd');
        $sime_hiduke = $this->request->getPost('sime_hiduke');
        // 取り消したいデータよりも未来の締めデータの存在を確認する
        $dataCount = TokuisakiSimeDts::count([
            "tokuisaki_mr_cd = '${tokuisaki_mr_cd}' AND sime_hiduke > '${sime_hiduke}'"
        ]);

        if ($dataCount !== 0) {
            $response->setContent(json_encode('現在取消を行おうとしているデータより新しいデータがあります。件数：' . $dataCount));
            return $response;
        }

        // 締切確認が締まっていないかの確認
        $kihonCd = KihonMrs::findFirst();
        $tmpCd = $kihonCd->cd;
        $month = substr($sime_hiduke, 0, 7);
        $start_date = date('Y-m-d', strtotime('first day of ' . $month));
        $end_date = date('Y-m-d', strtotime('last day of ' . $month));

        $simeCount = ShiiresakiSimeDts::count([
            "shiiresaki_mr_cd = '${tmpCd}' AND sime_hiduke BETWEEN '${start_date}' AND '${end_date}'"
        ]);

        if ($simeCount !== 0) {
            $response->setContent(json_encode('当月の、締切確認用が締まっている為、締めを外せません!'));
            return $response;
        }

        $responseString = ''; // response
        $tokuisaki_sime_dt = TokuisakiSimeDts::findFirstByid($id);
        if (!$tokuisaki_sime_dt) {
            $responseString = "得意先データが見つからなくなりました。";
        }
//        取り敢えずバックアウトしない
//        $this->_bakOut($tokuisaki_sime_dt, 1);
        if (!$tokuisaki_sime_dt->delete()) {
            foreach ($tokuisaki_sime_dt->getMessages() as $message) {
                $responseString .= $message;
            }
        }

        if ($responseString === '') {
            $responseString = '取消処理完了!';
        }
        $response->setContent(json_encode($responseString));
        return $response;
    }


}
