<?php

use Phalcon\Paginator\Adapter\Model as Paginator;

class ShiiresakiSimeDtsController extends ControllerBase
{
    /**
     * Kakunin action
     */
    public function kakuninAction()
    {
        if ($this->request->isPost()) {
            $kikan_flg = $this->request->getPost("kikan_flg");
            $kikan_from = $this->request->getPost("kikan_from");
            $kikan_to = $this->request->getPost("kikan_to");
            $shimegrp_kbn_cd = $this->request->getPost("shimegrp_kbn_cd");
            $shiharai_kbn_cd = $this->request->getPost("shiharai_kbn_cd");

            $shukkin_naiyous = ShiiresakiSimeDts::findShukkinNaiyou($shimegrp_kbn_cd, $kikan_flg, $kikan_from, $kikan_to);
            $this->tag->setDefault("shimegrp_kbn_cd", $shimegrp_kbn_cd);
            $this->tag->setDefault("kikan_flg", $kikan_flg);
            $this->tag->setDefault("kikan_from", $kikan_from);
            $this->tag->setDefault("kikan_to", $kikan_to);
            $this->tag->setDefault("shiharai_kbn_cd", $shiharai_kbn_cd);
            $this->view->shukkin_naiyous = $shukkin_naiyous;
        }
    }

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
			        a.nendo,
			        a.cd,
			        a.name,
			        a.shiiresaki_mr_cd,
			        b.name,
			        a.sime_hiduke,
			        a.shiharai_yoteibi,
			        a.zenkai_siiregaku,
			        a.shukkingaku,
			        a.konkai_siiregaku,
			        a.uti_shouhizeigaku,
			        a.updated
			        FROM ShiiresakiSimeDts as a
                    LEFT JOIN ShiiresakiMrs as b ON b.cd = a.shiiresaki_mr_cd
                    " . $where . "
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
            $shiiresaki_mr_cd = $this->request->getQuery('shiiresaki_mr_cd');
            $where = "";
            $conditions = [];
            if ($shiiresaki_mr_cd !== '') {
                $where = " WHERE a.shiiresaki_mr_cd = :shiiresaki_mr_cd:";
                $conditions = ["shiiresaki_mr_cd" => $shiiresaki_mr_cd,];
            }
            $phql = "
			        SELECT
			        a.id,
			        a.nendo,
			        a.cd,
			        a.name,
			        a.shiiresaki_mr_cd,
			        b.name,
			        a.sime_hiduke,
			        a.shiharai_yoteibi,
			        a.zenkai_siiregaku,
			        a.shukkingaku,
			        a.konkai_siiregaku,
			        a.uti_shouhizeigaku,
			        a.updated
			        FROM ShiiresakiSimeDts as a
                    LEFT JOIN ShiiresakiMrs as b ON b.cd = a.shiiresaki_mr_cd
                    " . $where . "
                    ORDER BY a.sime_hiduke DESC
            ";
            $rows = $mgr->executeQuery($phql, $conditions);
            $this->view->rows = $rows;
        }
    }

    /**
     * 簡易検索付き一覧表。共通部分
     */
    protected function summaryCd($TableId, $table_name, $orgkey = "cd", $columns = "cd", $conditions = "1 ", $having = "") // 例：ControllerBase::indexCd("UriageDts", "売上伝票", $query) 標準キーがcdで無いとき指定できる
    {
        $numberPage = 1;
        $sort = $orgkey;
        $order = "ASC";
        $addlimit = ""; // postからの場合TableSortの機能ではlimitを付加してくれないため、自前で付加する。→view\common\indexsort.phtml
        if ($this->request->isPost()) {
            $pagelimit = $this->request->getPost("pagelimit");
            if ($pagelimit !== 50) {
                $addlimit = "&limit=" . $pagelimit;
            }
        } else {
            $sort = $this->request->getQuery("sort") ?? $sort;
            $sort .= ' ' . $this->request->getQuery("order") ?? $order;
            $numberPage = $this->request->getQuery("page", "int");
            $wherecd = $this->request->getQuery('shiiresaki_mr_cd');
            $pagelimit = $this->request->getQuery("limit", "int");
            if (count($this->request->getQuery()) > 2) {
                $parameters = $this->persistent->parameters;
            } else {
                if ($wherecd) { /* 現在のコードのページを開く */
                    $parameters1 = [];
                    $parameters1["conditions"] = "shiiresaki_mr_cd < ?1";
                    $parameters1["bind"] = [1 => $wherecd];
                    $numberPage = ShiiresakiSimeDts::count($parameters1) / 50 + 1;
                }
            }
        }
        if (!$pagelimit) {
            $pagelimit = 50;
        }
        if (isset($parameters) && !is_array($parameters)) {
            $parameters = array();
        }
        if ($this->request->getPost("shiiresaki_mr_cd")) {
            $parameters["bind"]["shiiresaki_mr_cd"] = $this->request->getPost("shiiresaki_mr_cd");
        }
        if ($this->request->getPost("nendo")) {
            $parameters['bind']['nendo'] = $this->request->getPost('nendo');
        }
        $parameters["order"] = $sort;
        $parameters["columns"] = $columns;
        $parameters["conditions"] = $conditions;
        $this->persistent->parameters = $parameters;
        $criteria = $TableId::query();
        $criteria->where($conditions);
        if (isset($parameters['bind']) && $parameters['bind']) {
            if (isset($parameters['bind']['shiiresaki_mr_cd'])) {
                $criteria->andWhere(" shiiresaki_mr_cd LIKE :shiiresaki_mr_cd:");
                if (isset($parameters['bind']['nendo'])) {
                    $criteria->andWhere(" nendo LIKE :nendo:");
                }
            } else if (isset($parameters['bind']['nendo'])) {
                $criteria->andWhere(" nendo LIKE :nendo:");
            }
            $criteria->bind($parameters["bind"]);
        }
        $criteria->orderBy($sort);
        $criteria->columns($columns);
        $tblrows = $criteria->execute();

        if (count($tblrows) == 0) {
            $this->flash->notice("検索の結果、" . $table_name . "は0件でした。");
        }
        $this->view->parasort = $this->request->getQuery("sort") ? '&sort=' . $this->request->getQuery("sort") : '';
        $this->view->parasort .= $this->request->getQuery("order") ? '&order=' . $this->request->getQuery("order") : '';
        $this->view->parasort .= $pagelimit !== 50 ? '&limit=' . $pagelimit : '';
        $this->view->addlimit = $addlimit;

        $paginator = new Paginator(array(
            'data' => $tblrows,
            'limit' => $pagelimit,
            'page' => $numberPage
        ));
        $this->view->page = $paginator->getPaginate();
        $this->tag->setDefault("pagelimit", $pagelimit);
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
			        a.nendo,
			        a.cd,
			        a.name,
			        a.shiiresaki_mr_cd,
			        b.name,
			        a.sime_hiduke,
			        a.shiharai_yoteibi,
			        a.zenkai_siiregaku,
			        a.shukkingaku,
			        a.konkai_siiregaku,
			        a.uti_shouhizeigaku,
			        a.updated
			        FROM ShiiresakiSimeDts as a
                    LEFT JOIN ShiiresakiMrs as b ON b.cd = a.shiiresaki_mr_cd
                    " . $where . "
                    ORDER BY a.shiiresaki_mr_cd
            ";
            $rows = $mgr->executeQuery($phql, $conditions);
            $this->view->rows = $rows;
        }
    }

    /**
     * Searches for shiiresaki_sime_dts
     */
    public function searchAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Displays the creation form
     */
    public function newAction($id = null, $dataname = "ShiiresakiSimeDts")
    {
        $this->view->imax = 0;

        if ($id) {
            $nameDts = $dataname;
            $shiiresaki_sime_dt = $nameDts::findFirstByid($id);
            if (!$shiiresaki_sime_dt) {
                $this->flash->error("仕入先締データが見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "shiiresaki_sime_dts",
                    'action' => 'index'
                ));

                return;
            }
            $this->_setDefault($shiiresaki_sime_dt, "new", $dataname);
            $this->tag->setDefault("id", null);
            $this->tag->setDefault("cd", null);
        }

    }

    /**
     * 修正画面から「次へ」ボタンを押したら次のコードの修正画面になる。
     */
    public function nextAction($id)
    {
        ControllerBase::nextCd($id, "shiiresaki_sime_dts", "ShiiresakiSimeDts", "仕入先締データ");
    }

    /**
     * 修正画面から「前へ」ボタンを押したら前のコードの修正画面になる。
     */
    public function prevAction($id)
    {
        ControllerBase::prevCd($id, "shiiresaki_sime_dts", "ShiiresakiSimeDts", "仕入先締データ");
    }

    /**
     * Edits a shiiresaki_sime_dt
     *
     * @param string $id
     */
    public function editAction($id)
    {
//        if (!$this->request->isPost()) {

        $shiiresaki_sime_dt = ShiiresakiSimeDts::findFirstByid($id);
        if (!$shiiresaki_sime_dt) {
            $this->flash->error("仕入先締データが見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "shiiresaki_sime_dts",
                'action' => 'index'
            ));

            return;
        }

        $this->view->id = $shiiresaki_sime_dt->id;

        $this->_setDefault($shiiresaki_sime_dt, "edit");
//        }
    }

    /**
     * 画面に表示するデータをセットする
     */
    public function _setDefault($shiiresaki_sime_dt, $action = "edit", $meisai = "ShiiresakiSimeDts")
    {
        $setdts = ["id",
            "cd",
            "name",
            "shiiresaki_mr_cd",
            "sime_hiduke",
            "nendo",
            "shiharai_yoteibi",
            "zenkai_siiregaku",
            "shukkingaku",
            "konkai_siiregaku",
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
            if (property_exists($shiiresaki_sime_dt, $setdt)) {
                $this->tag->setDefault($setdt, $shiiresaki_sime_dt->$setdt);
            }
        }
    }

    /**
     * Creates a new shiiresaki_sime_dt
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "shiiresaki_sime_dts",
                'action' => 'index'
            ));

            return;
        }

        $shiiresaki_sime_dt = new ShiiresakiSimeDts();

        $post_flds = [];
        $post_flds = ["cd",
            "name",
            "shiiresaki_mr_cd",
            "sime_hiduke",
            "nendo",
            "shiharai_yoteibi",
            "zenkai_siiregaku",
            "shukkingaku",
            "konkai_siiregaku",
            "uti_shouhizeigaku",
            "updated",
        ];


        $thisPost = []; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        foreach ($post_flds as $post_fld) {
            $shiiresaki_sime_dt->$post_fld = array_key_exists($post_fld, $thisPost) ? $thisPost[$post_fld] : $this->request->getPost($post_fld);
        }

        if (!$shiiresaki_sime_dt->save()) {
            foreach ($shiiresaki_sime_dt->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "shiiresaki_sime_dts",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("仕入先締データの作成が完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "shiiresaki_sime_dts",
            'action' => 'edit',
            'params' => array($shiiresaki_sime_dt->id)
        ));
    }

    /**
     * Saves a shiiresaki_sime_dt edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "shiiresaki_sime_dts",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $shiiresaki_sime_dt = ShiiresakiSimeDts::findFirstByid($id);

        if (!$shiiresaki_sime_dt) {
            $this->flash->error("仕入先締データが見つからなくなりました。" . $id);

            $this->dispatcher->forward(array(
                'controller' => "shiiresaki_sime_dts",
                'action' => 'index'
            ));

            return;
        }

        if ($shiiresaki_sime_dt->updated !== $this->request->getPost("updated")) {
            $this->flash->error("他のプロセスから仕入先締データが変更されたため更新を中止しました。"
                . $id . ",uid=" . $shiiresaki_sime_dt->kousin_user_id . " tb=" . $shiiresaki_sime_dt->updated . " pt=" . $this->request->getPost("updated"));

            $this->dispatcher->forward(array(
                'controller' => "shiiresaki_sime_dts",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $post_flds = [];
        $post_flds = ["cd",
            "name",
            "shiiresaki_mr_cd",
            "sime_hiduke",
            "nendo",
            "shiharai_yoteibi",
            "zenkai_siiregaku",
            "shukkingaku",
            "konkai_siiregaku",
            "uti_shouhizeigaku",
            "updated",
        ];


        $thisPost = []; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        $chg_flg = 0;
        foreach ($post_flds as $post_fld) {
            if ((array_key_exists($post_fld, $thisPost) ? $thisPost[$post_fld] : $this->request->getPost($post_fld)) !== $shiiresaki_sime_dt->$post_fld) {
                $chg_flg = 1;
                break;
            }
        }
        if ($chg_flg === 0) {
            $this->flash->error("変更がありません。" . $id);

            $this->dispatcher->forward(array(
                "controller" => "shiiresaki_sime_dts",
                "action" => "edit",
                "params" => array($shiiresaki_sime_dt->id)
            ));

            return;
        }

        $this->_bakOut($shiiresaki_sime_dt);

        foreach ($post_flds as $post_fld) {
            $shiiresaki_sime_dt->$post_fld = array_key_exists($post_fld, $thisPost) ? $thisPost[$post_fld] : $this->request->getPost($post_fld);
        }

        if (!$shiiresaki_sime_dt->save()) {

            foreach ($shiiresaki_sime_dt->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "shiiresaki_sime_dts",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $this->flash->success("仕入先締データの情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "shiiresaki_sime_dts",
            'action' => 'edit',
            'params' => array($shiiresaki_sime_dt->id)
        ));
    }

    /**
     * Deletes a shiiresaki_sime_dt
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $shiiresaki_sime_dt = ShiiresakiSimeDts::findFirstByid($id);
        if (!$shiiresaki_sime_dt) {
            $this->flash->error("仕入先締データが見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "shiiresaki_sime_dts",
                'action' => 'index'
            ));

            return;
        }

        $this->_bakOut($shiiresaki_sime_dt, 1);

        if (!$shiiresaki_sime_dt->delete()) {

            foreach ($shiiresaki_sime_dt->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "shiiresaki_sime_dts",
                'action' => 'search'
            ));

            return;
        }

        $this->flash->success("仕入先締データの削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "shiiresaki_sime_dts",
            'action' => "index"
        ));
    }

    /**
     * Back Out a shiiresaki_sime_dt
     *
     * @param string $shiiresaki_sime_dt , $dlt_flg
     */
    public function _bakOut($shiiresaki_sime_dt, $dlt_flg = 0)
    {

        $bak_shiiresaki_sime_dt = new BakShiiresakiSimeDts();
        foreach ($shiiresaki_sime_dt as $fld => $value) {
            $bak_shiiresaki_sime_dt->$fld = $shiiresaki_sime_dt->$fld;
        }
        $bak_shiiresaki_sime_dt->id = NULL;
        $bak_shiiresaki_sime_dt->id_moto = $shiiresaki_sime_dt->id;
        $bak_shiiresaki_sime_dt->hikae_dltflg = $dlt_flg;
        $bak_shiiresaki_sime_dt->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_shiiresaki_sime_dt->hikae_nichiji = date("Y-m-d H:i:s");
        if (!$bak_shiiresaki_sime_dt->save()) {
            foreach ($bak_shiiresaki_sime_dt->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
    }

    /**
     * 締切画面
     *
     */
    public function shiharai_simekiriAction()
    {
        if ($this->request->isPost()) {
            $sime_hiduke = $this->request->getPost("sime_hiduke");
            $shiharai_yoteibi = $this->request->getPost("shiharai_yoteibi");
            if (!empty($_POST['simekiri_btn'])) {
                $this->simekiri_shori();
            }
            $shimegrp_kbn_cd = $this->request->getPost("shimegrp_kbn_cd");
        } else {
            $shimegrp_kbn_cd = 31;
            $sime_hiduke = date('Y-m-d', strtotime('last day of previous month'));
        }
        $shiiresaki_mrs = ShiiresakiSimeDts::findKonkaiShiharai($shimegrp_kbn_cd, $sime_hiduke, '');
        $this->tag->setDefault("shimegrp_kbn_cd", $shimegrp_kbn_cd);
        $this->tag->setDefault("sime_hiduke", $sime_hiduke);
        $this->tag->setDefault("shiharai_yoteibi", $shiharai_yoteibi);
        $this->view->shiiresaki_mrs = $shiiresaki_mrs;
    }

    /**
     * 締切処理
     *
     */
    public function simekiri_shori()
    {
        $sime_hiduke = $this->request->getPost("sime_hiduke");
        $shiharai_yoteibi = $this->request->getPost("shiharai_yoteibi");
        $shimegrp_kbn_cd = $this->request->getPost("shimegrp_kbn_cd");
        foreach (array_keys($_POST) as $key) {
            if (substr($key, 0, 5) == 'code_') {
                $cd = substr($key, 5);
                $rows = ShiiresakiSimeDts::findKonkaiShiharai($shimegrp_kbn_cd, $sime_hiduke, $cd);
                $row = $rows[0];
                /** デバッグ
                 * echo "<pre>";
                 * var_dump($rows);
                 * return;
                 */
                $shiiresaki_sime_dt = new ShiiresakiSimeDts();
                /* 伝票番号付番または再設定 */
                $den_ban_ctrl = new DenpyouBangouMrsController(); //伝票番号マスタコントローラ
                $nendo_ban = $den_ban_ctrl->countup('shiharaisho', 0, $sime_hiduke);
                if (!$nendo_ban['nendo']) {
                    $this->flash->error("エラー:年度が未登録（日付が今年か昨年以外は不可）。" . $sime_hiduke);
                }
                $shiiresaki_sime_dt->cd = $nendo_ban['bangou'];
                $shiiresaki_sime_dt->nendo = $nendo_ban['nendo'];
                $shiiresaki_sime_dt->shiiresaki_mr_cd = $cd;
                $shiiresaki_sime_dt->sime_hiduke = $sime_hiduke;
                if ($shiharai_yoteibi) {
                    $shiiresaki_sime_dt->shiharai_yoteibi = $shiharai_yoteibi;
                } else {
                    $shiiresaki_sime_dt->shiharai_yoteibi =
                        date("Y-m-" . ($row["haraibi"] > 28 ? "t" : $row["haraibi"]),
                            strtotime($sime_hiduke . "+" . ($row["harai_saikuru_kbn_cd"] - 1) . " month"));
                }
                $shiiresaki_sime_dt->zenkai_siiregaku = $row['zenkai_siiregaku'];
                $shiiresaki_sime_dt->shukkingaku = $row['shukkingaku'];
                $shiiresaki_sime_dt->konkai_siiregaku = $row['siiregaku'];
                $shiiresaki_sime_dt->uti_shouhizeigaku = $row['shouhizeigaku'];
                $shiiresaki_sime_naiyou_dts = [];
                $shiiresaki_sime_dt->ShiiresakiSimeNaiyouDts = [];
                $shiiresaki_sime_naiyou_dts[0] = new ShiiresakiSimeNaiyouDts();
                $shiiresaki_sime_naiyou_dts[0]->cd = 1;
                $shiiresaki_sime_naiyou_dts[0]->shiharai_kbn_cd = $row->shiharai_kbn_cd;
                $shiiresaki_sime_naiyou_dts[0]->kingaku =
                    $row['zenkai_siiregaku'] - $row['shukkingaku'] + $row['siiregaku'] + $row['shouhizeigaku'];
                if ($row->wakekata == 0 && $row->yoshin_gendogaku > 0 && $shiiresaki_sime_naiyou_dts[0]->kingaku > $row->yoshin_gendogaku) {
                    $shiiresaki_sime_naiyou_dts[1] = new ShiiresakiSimeNaiyouDts();
                    $shiiresaki_sime_naiyou_dts[1]->cd = 2;
                    $shiiresaki_sime_naiyou_dts[1]->shiharai_kbn_cd = $row->shiharai2_kbn_cd;
                    $shiiresaki_sime_naiyou_dts[1]->kingaku = $shiiresaki_sime_naiyou_dts[0] - $row->yoshin_gendogaku;
                    $shiiresaki_sime_naiyou_dts[0]->kingaku = $row->yoshin_gendogaku;
                }
                $shiiresaki_sime_dt->ShiiresakiSimeNaiyouDts = $shiiresaki_sime_naiyou_dts;
//echo "\n<br>kingaku=".count($shiiresaki_sime_dt->ShiiresakiSimeNaiyouDts);
                if (!$shiiresaki_sime_dt->save()) {
                    foreach ($shiiresaki_sime_dt->getMessages() as $message) {
                        $this->flash->error($message);
                    }
                }
            }
        }
    }

    /**
     * 支払明細画面 編集2019-11-13
     * param: 支払先、締日、集計単位、支払書番号
     */
    public function shiharai_meisaiAction($id = '')
    {
        if ($id) {
            $row_konkai = ShiiresakiSimeDts::findFirstByid($id);
            if ($row_konkai) {
                $shiiresaki_mr_cd = $row_konkai->shiiresaki_mr_cd;
                $simebi = $row_konkai->sime_hiduke;
                $shuukei_tanni = 0;
                $shiiresho_bangou = $row_konkai->cd;
            }
        } elseif ($this->request->isPost()) {
            $shiiresaki_mr_cd = $this->request->getPost("shiiresaki_mr_cd");
            $simebi = $this->request->getPost("simebi");
            $shuukei_tanni = $this->request->getPost("shuukei_tanni");
            $shiharaisho_bangou = $this->request->getPost("shiharaisho_bangou");
        } else {
            $shiiresaki_mr_cd = $this->request->getQuery("shiiresaki_mr_cd");
            $simebi = $this->request->getQuery("simebi");
            $shuukei_tanni = $this->request->getQuery("shuukei_tanni");
            $shiharaisho_bangou = $this->request->getQuery("shiharaisho_bangou");
        }
        if ($shiharaisho_bangou) { // 支払書番号があれば今回締日を得る
            $row_konkai = ShiiresakiSimeDts::findFirst([
                "conditions" => "shiiresaki_mr_cd=?1 and cd=?2",
                "bind" => [1 => $shiiresaki_mr_cd, 2 => $shiharaisho_bangou]
            ]);
            if ($row_konkai) {
                $simebi = $row_konkai->sime_hiduke;
            } else {
                $shiharaisho_bangou = "";
            }
        }
        if (!$simebi && $shiiresaki_mr_cd) { // 締日が無ければ、仕入先の締日条件の締日を得る
            $simebi = ShiiresakiMrs::findSimebi($shiiresaki_mr_cd);
        }
        if (!$shiharaisho_bangou) { // 支払書番号が無ければ今回締日の発行済み支払書番号があれば支払書番号を表示する
            $row_konkai = ShiiresakiSimeDts::findFirst([
                "conditions" => "shiiresaki_mr_cd=?1 and sime_hiduke=?2",
                "bind" => [1 => $shiiresaki_mr_cd, 2 => $simebi]
            ]);
            if ($row_konkai) {
                $shiharaisho_bangou = $row_konkai->cd;
            }
        }
        $row = ShiiresakiMrs::findFirst();
        if ($shiiresaki_mr_cd) {
            $shiiresaki_mr = ShiiresakiMrs::findFirst(["conditions" => "cd = ?1", "bind" => [1 => $shiiresaki_mr_cd]]);
            if ($shiiresaki_mr) {
                $this->tag->setDefault("shiiresaki_name", $shiiresaki_mr->name);
            }
            $row_zenkais = ShiiresakiSimeDts::find([
                "conditions" => "shiiresaki_mr_cd=?1 and sime_hiduke<?2",
                "order" => "sime_hiduke DESC",
                "bind" => [1 => $shiiresaki_mr_cd, 2 => $simebi]
            ]);

            $date_from = "0000-00-00";
            $zenzen_from = "0000-00-00";
            if (count($row_zenkais) > 0) {
                $date_from = $row_zenkais[0]->sime_hiduke;
            }
            if (count($row_zenkais) > 1) {
                $zenzen_from = $row_zenkais[1]->sime_hiduke;
            }
            $shiharai_meisais = ShiiresakiSimeDts::findShiharaiMeisai($shiiresaki_mr_cd, $zenzen_from, $date_from, $simebi);
        }
        if ($shiharaisho_bangou != '') {
            $sime_joutai = '締切済';
        } else {
            $sime_joutai = '';
        }

        $this->tag->setDefault("shiiresaki_mr_cd", $shiiresaki_mr_cd);
        $this->tag->setDefault("simebi", $simebi);
        $this->tag->setDefault("shuukei_tanni", $shuukei_tanni);
        $this->tag->setDefault("shiharaisho_bangou", $shiharaisho_bangou);
        $this->view->row_zenkai = count($row_zenkais) > 0 ? $row_zenkais[0] : null;
        $this->view->shiharai_meisais = $shiharai_meisais;
        $this->view->sime_joutai = $sime_joutai;
    }

    /**
     * 最終締日取得
     */
    public function ajax_shimebiAction()
    {
        $this->view->disable();
        $response = new \Phalcon\Http\Response();

        $dates = ShiiresakiSimeDts::find([
            'columns' => array('shiiresaki_mr_cd, sime_hiduke'),
            'order' => 'id DESC',
            'conditions' => 'shiiresaki_mr_cd LIKE ?1 ',
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
        $shiiresaki_mr_cd = $this->request->getPost('shiiresaki_mr_cd');
        $sime_hiduke = $this->request->getPost('sime_hiduke');
        // 取り消したいデータよりも未来の締めデータの存在を確認する
        $dataCount = ShiiresakiSimeDts::count([
            "shiiresaki_mr_cd = '${shiiresaki_mr_cd}' AND sime_hiduke > '${sime_hiduke}'"
        ]);

        if ($dataCount !== 0) {
            $response->setContent(json_encode('現在取消を行おうとしているデータより新しいデータがあります。件数：' . $dataCount));
            return $response;
        }

        // 締切確認が締まっていないかの確認
        $kihonCd = KihonMrs::findFirst();
        $tmpCd = $kihonCd->cd;
        if ($shiiresaki_mr_cd !== $tmpCd) {
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
        }

        $responseString = ''; // response
        $shiiresaki_sime_dt = ShiiresakiSimeDts::findFirstByid($id);
        if (!$shiiresaki_sime_dt) {
            $responseString = "仕入先データが見つからなくなりました。";
        }
//        取り敢えずバックアウトしない
//        $this->_bakOut($tokuisaki_sime_dt, 1);
        if (!$shiiresaki_sime_dt->delete()) {
            foreach ($shiiresaki_sime_dt->getMessages() as $message) {
                $responseString .= $message;
            }
        }

        if ($responseString === '') {
            $responseString = '取消処理完了!';
        }
        $response->setContent(json_encode($responseString));
        return $response;
    }

    /*
     * 支払明細表
     * @param $frmid = 23:支払明細表
     */
    public function print_meisaiAction($id = null, $frmid = 23)
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
            $row_konkai = ShiiresakiSimeDts::findFirstByid($id);
            if ($row_konkai) {
                $shiiresaki_mr_cd = $row_konkai->shiiresaki_mr_cd;
                $simebi = $row_konkai->sime_hiduke;
                $shuukei_tanni = 0;
                $shiiresho_bangou = $row_konkai->cd;
            }
        } elseif ($this->request->isPost()) {
            $shiiresaki_mr_cd = $this->request->getPost("shiiresaki_mr_cd");
            $simebi = $this->request->getPost("simebi");
            $shuukei_tanni = $this->request->getPost("shuukei_tanni");
            $shiharaisho_bangou = $this->request->getPost("shiharaisho_bangou");
        } else {
            $shiiresaki_mr_cd = $this->request->getQuery("shiiresaki_mr_cd");
            $simebi = $this->request->getQuery("simebi");
            $shuukei_tanni = $this->request->getQuery("shuukei_tanni");
            $shiharaisho_bangou = $this->request->getQuery("shiharaisho_bangou");
        }
        if ($shiharaisho_bangou) { // 支払書番号があれば今回締日を得る
            $row_konkai = ShiiresakiSimeDts::findFirst([
                "conditions" => "shiiresaki_mr_cd=?1 and cd=?2",
                "bind" => [1 => $shiiresaki_mr_cd, 2 => $shiharaisho_bangou]
            ]);
            if ($row_konkai) {
                $simebi = $row_konkai->sime_hiduke;
            } else {
                $shiharaisho_bangou = "";
            }
        }
        if (!$simebi && $shiiresaki_mr_cd) { // 締日が無ければ、仕入先の締日条件の締日を得る
            $simebi = ShiiresakiMrs::findSimebi($shiiresaki_mr_cd);
        }
        if (!$shiharaisho_bangou) { // 支払書番号が無ければ今回締日の発行済み支払書番号があれば支払書番号を表示する
            $row_konkai = ShiiresakiSimeDts::findFirst([
                "conditions" => "shiiresaki_mr_cd=?1 and sime_hiduke=?2",
                "bind" => [1 => $shiiresaki_mr_cd, 2 => $simebi]
            ]);
            if ($row_konkai) {
                $shiharaisho_bangou = $row_konkai->cd;
            }
        }
        $row = ShiiresakiMrs::findFirst();
        if ($shiiresaki_mr_cd) {
            $shiiresaki_mr = ShiiresakiMrs::findFirst(["conditions" => "cd = ?1", "bind" => [1 => $shiiresaki_mr_cd]]);
            if ($shiiresaki_mr) {
                $this->tag->setDefault("shiiresaki_name", $shiiresaki_mr->name);
            }
            $row_zenkais = ShiiresakiSimeDts::find([
                "conditions" => "shiiresaki_mr_cd=?1 and sime_hiduke<?2",
                "order" => "sime_hiduke DESC",
                "bind" => [1 => $shiiresaki_mr_cd, 2 => $simebi]
            ]);
            $date_from = "0000-00-00";
            $zenzen_from = "0000-00-00";
            if (count($row_zenkais) > 0) {
                $date_from = $row_zenkais[0]->sime_hiduke;
            }
            if (count($row_zenkais) > 1) {
                $zenzen_from = $row_zenkais[1]->sime_hiduke;
            }
            $shiharai_meisais = ShiiresakiSimeDts::findShiharaiMeisai($shiiresaki_mr_cd, $zenzen_from, $date_from, $simebi);
        }

        $row_zenkai = count($row_zenkais) > 0 ? $row_zenkais[0] : null;
        $last_row = count($shiharai_meisais) - 1;

        $zenkai_table = [];
//        $zenkai_table['zenkaigaku'] = $row_zenkai->zenkai_siiregaku - $row_zenkai->shukkingaku + $row_zenkai->konkai_shiiregaku;
        $zenkai_table['zenkaigaku'] = $row_zenkai->zenkai_siiregaku - $row_zenkai->shukkingaku + $row_zenkai->konkai_siiregaku;
//        $zenkai_table['zenkaigaku'] = $row_zenkai->konkai_siiregaku - $row_zenkai->shukkingaku;
        $zenkai_table['shukkingaku'] = $shiharai_meisais[$last_row]["shukkingakuk"];
        $zenkai_table['kurikosigaku'] = $zenkai_table['zenkaigaku'] - $zenkai_table['shukkingaku'];
        $zenkai_table['konkai_siire'] = $shiharai_meisais[$last_row]["zeinukigakuk"] + $shiharai_meisais[$last_row]["zeigakuk"];
        $zenkai_table['utishouhizei'] = $shiharai_meisais[$last_row]["zeigakuk"];
        $zenkai_table['konkai_shiharai'] = $zenkai_table['kurikosigaku'] + $zenkai_table['konkai_siire'];
        $zenkai_table['shiharai_zan'] = $zenkai_table['kurikosigaku'] + $zenkai_table['konkai_siire'];

        // 印刷用に明細テーブルを作り直す
        $sotozei = 0;
        $i = 0;
        $meisai_dts = [];
        foreach ($shiharai_meisais as $shiharai_meisai) {
            if ($shiharai_meisai['denpyou_bangou']) {
                if ($shiharai_meisai['gyou']) {
                    $meisai_dts[$i]['1'] = $shiharai_meisai['hiduke'];
                    $meisai_dts[$i]['2'] = $shiharai_meisai['denpyou_bangou'];
                    $meisai_dts[$i]['3'] = $shiharai_meisai['kubun'];
                    $meisai_dts[$i]['4'] = $shiharai_meisai['naiyou'];
                    $meisai_dts[$i]['5'] = $shiharai_meisai['kazeikubun'];
                    $meisai_dts[$i]['6'] = number_format($shiharai_meisai['suuryouk'], 2) !== '0.00' ? number_format($shiharai_meisai['suuryouk'], 2) : '';
                    $meisai_dts[$i]['7'] = number_format($shiharai_meisai['tanka'], 2) !== '0.00' ? number_format($shiharai_meisai['tanka'], 2) : '';
                    if ($shiharai_meisai['zei_tenka_kbn_cd'] < 20) {
                        $sotozei += $shiharai_meisai['zeigakuk'];
                    } else {
                        $utizei = $shiharai_meisai['zeigakuk'];
                    }
                    $meisai_dts[$i]['8'] = number_format($shiharai_meisai['zeinukigakuk'] + $utizei + $shiharai_meisai['shukkingakuk']);
                    $meisai_dts[$i]['9'] = $shiharai_meisai['tani'];
                    $meisai_dts[$i]['10'] = $shiharai_meisai['shouhin_mr_cd'];
                    $i++;
                } else {
                    if ($shiharai_meisai['denpyou_kbn'] == 1 && (int)$shiharai_meisai['zei_tenka_kbn_cd'] < 20) {
                        $meisai_dts[$i]['1'] = $shiharai_meisai['hiduke'];
                        $meisai_dts[$i]['2'] = $shiharai_meisai['denpyou_bangou'];
                        $meisai_dts[$i]['3'] = '';
                        $meisai_dts[$i]['4'] = '消費税';
                        $meisai_dts[$i]['5'] = '';
                        $meisai_dts[$i]['6'] = '';
                        $meisai_dts[$i]['7'] = '';
                        $meisai_dts[$i]['8'] = number_format($sotozei);
                        $meisai_dts[$i]['9'] = '';
                        $meisai_dts[$i]['10'] = '';
                        $sotozei = 0;
                        $i++;
                    }
                }

            }
        }
        if ($chouhyou_mr->ChouhyouToolKbns->name === 'PDF') {
            return $this->_denpyou_pdf($meisai_dts, $chouhyou_mr, $shiiresaki_mr_cd,$simebi,$zenkai_table, $shiharaisho_bangou);
        }
    }

    public function _denpyou_pdf($meisaidt, $chouhyou_mr, $shiiresaki_mr_cd, $simebi, $zenkai_table, $shiharaisho_bangou, $pdf = null){
        require_once(__DIR__ . '/../vendor/tcpdf/tcpdf.php');
        require_once(__DIR__ . '/../vendor/tcpdf/fpdi.php');
        $goukeis = [];
        $goukeis['meisai_cnt'] = 0;
        foreach ($meisaidt as $meisai) {
            if ($chouhyou_mr->meisai_lvl == 0) {
                $goukeis['meisai_cnt']++;
            }
        }
//        var_dump($meisaidt);
//        exit;
        $goukeis['maxpage'] = (ceil(count($meisaidt) / $chouhyou_mr->meisai_pp)) ?? 1;
        if ($pdf) {
            $renzoku = true;
        } else {
            $renzoku = false;
            $pdf = new FPDI($chouhyou_mr->yousi_houkou, 'mm', $chouhyou_mr->yousi_size, true, 'UTF-8');
        }
//        $kihon_mr = KihonMrs::findFirstByid(1);
        $shiiresaki_mr = ShiiresakiMrs::findFirst("cd = '{$shiiresaki_mr_cd}'"); //請求先情報
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
                if ($zokusei->kmk_table === 'shiharai_meisai') {
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
                for ($gyou = 0; $gyou < $gyousuu && $page * $gyousuu - $gyousuu + $gyou < $goukeis['meisai_cnt'] && $zokusei->kmk_table === 'shiharai_meisai' || $gyou < 1; $gyou++) {
                    if ($zokusei->kmk_table === 'shiiresaki_mrs') {
                        $target = $shiiresaki_mr;
                    } else if ($zokusei->kmk_table === 'shiharai_meisai') {
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
                        case 't_cd':
                            $text = $shiiresaki_mr_cd;
                            break;
                        case 'hakkoubi' :
                            $text = date('m/d');
                            break;
                        case 'shimebi':
                            $text =  date('m/d', strtotime($simebi));
                            break;
                        case 'page':
                            $text = $page;
                            break;
                        case 't_yuubin':
                            $text = $shiiresaki_mr->yuubin_bangou;
                            break;
                        case 't_jusho1':
                            $text = $shiiresaki_mr->juusho1;
                            break;
                        case 't_jusho2':
                            $text = $shiiresaki_mr->juusho2;
                            break;
                        case 't_name':
                            $text = $shiiresaki_mr->name;
                            break;
                        case 't_tel':
                            $text = $shiiresaki_mr->tel;
                            break;
                        case 't_fax':
                            $text = $shiiresaki_mr->fax;
                            break;
                        case 'zen_gaku':
                            $text = $page === 1 ? number_format($zenkai_table['zenkaigaku']) : '************';
                            break;
                        case 'shi_gaku':
                            $text = $page === 1 ? number_format($zenkai_table['shukkingaku']) : '************';
                            break;
                        case 'kurikosi':
                            $text = $page === 1 ? number_format($zenkai_table['kurikosigaku']) : '************';
                            break;
//                        case 'shi_gaku':
//                            $text = $page === 1 ? number_format($zenkai_table['konkai_siire']) : '************';
//                            break;
                        case 'uti_zei':
                            $text = $page === 1 ? number_format($zenkai_table['utishouhizei']) : '************';
                            break;
                        case 'kon_si':
                            $text = $page === 1 ? number_format($zenkai_table['konkai_siire']) : '************';
                            break;
                        case 'shi_zan':
                            $text = $page === 1 ? number_format($zenkai_table['shiharai_zan']) : '************';
                            break;
                        case 'siirebi':
                            $text = $meisaidt[$dtgyou]['1'];
                            break;
                        case 'den_no':
                            if ($meisaidt[$dtgyou - 1]['2'] === $meisaidt[$dtgyou]['2']) {
                                $text = '';
                            } else {
                                $text = $meisaidt[$dtgyou]['2'];
                            }
                            break;
                        case 'cd':
                            $text = $meisaidt[$dtgyou]['10'];
                            break;
                        case 'tekiyou':
                            if ($meisaidt[$dtgyou]['4'] === '消費税') {
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
            $filename = uniqid("shiharai_meisai_", false) . '.pdf';
            $path = __DIR__ . '/temp/' . $filename;
            $pdf->Output($path, 'F');
            $response = new \Phalcon\Http\Response();
            $response->setHeader('Content-Type', 'application/pdf');
            $response->setHeader('Content-Disposition', 'attachment;filename="shiharai_meisai_"');
            $response->setHeader('Cache-Control', 'max-age=0');
            $response->setHeader('Cache-Control', 'max-age=1');
            $response->setContent(file_get_contents($path));
            unlink($path);
            $this->flash->success("支払明細表のPDFを出力しました。");
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

    public function shiharai_joukyouAction ()
    {
        if ($this->request->isPost()) {
            $getsudo = $this->request->getPost('getsudo');
            $rangeFrom = $this->request->getPost('range_from');
            $rangeTo = $this->request->getPost('range_to');
            // 月初日月末日を求める
            $firstDate = date('Y-m-d', strtotime('first day of ' . $getsudo));
            $yokugetsu = date('Y-m-d', strtotime('1 month ' . $getsudo));
            $lastDate = date('Y-m-d', strtotime('last day of ' . $getsudo));
            $harai1Date = date('Y-m-d', strtotime('-1 month ' . $firstDate));
            $harai2Date = date('Y-m-d', strtotime('-2 month ' . $firstDate));
            $harai3Date = date('Y-m-d', strtotime('-3 month ' . $firstDate));
            $harai4Date = date('Y-m-d', strtotime('-4 month ' . $firstDate));

            // 当月
            $tmp = explode('-', (string)$firstDate);
            $whereFirstDate = $tmp[0] . '-' . $tmp[1];
            // 翌月
            $tmp = explode('-', (string)$yokugetsu);
            $whereNextDate = $tmp[0] . '-' . $tmp[1];
            // 前月
            $tmp = explode('-', (string)$harai1Date);
            $whereHarai1Date = $tmp[0] . '-' . $tmp[1];
            // 前々月
            $tmp = explode('-', (string)$harai2Date);
            $whereHarai2Date = $tmp[0] . '-' . $tmp[1];

            $db = \Phalcon\DI::getDefault()->get('db');
            $phql = "
                SELECT
                    shiiresaki.cd as shiiresaki_mr_cd, shiiresaki.name as shiiresaki_name,
                   case when shiiresaki.harai_saikuru_kbn_cd = '2' then a.zen_konkai_siiregaku + a.zen_kurikoshigaku
                        when shiiresaki.harai_saikuru_kbn_cd = '3' then a.zen_kurikoshigaku
                        else 0 end as tougetsu_you_shiharaigaku,
                    g.tougetsukan_shukkingaku as tougetsu_shiharaigaku,
                    case when shiiresaki.harai_saikuru_kbn_cd = '2' then a.zen_konkai_siiregaku + a.zen_kurikoshigaku - g.tougetsukan_shukkingaku
                         when shiiresaki.harai_saikuru_kbn_cd = '3' then a.zen_kurikoshigaku - g.tougetsukan_shukkingaku
                        else 0 end as tougetsu_bun,
                   case when shiiresaki.harai_saikuru_kbn_cd = '2' then a.zen_konkai_siiregaku +  + a.zen_kurikoshigaku
                         when shiiresaki.harai_saikuru_kbn_cd = '3' then e.tougetsu_konkai_siiregaku
                        else 0 end as tougetsu_shiharai_yotei,
                   f.yokugetsu_konkai_siiregaku as yokugetsu_shiharai_yotei
                FROM (select cd, name, harai_saikuru_kbn_cd from shiiresaki_mrs) AS shiiresaki
                LEFT JOIN(
                    SELECT
                        zen.shiiresaki_mr_cd AS zen_shiiresaki_mr_cd,
                        sum(zen.zenkai_siiregaku) AS zen_zenkai_siiregaku,
                        sum(zen.shukkingaku) AS zen_shukkingaku,
                        sum(zen.konkai_siiregaku) AS zen_konkai_siiregaku,
                        sum(zen.zenkai_siiregaku) - sum(zen.shukkingaku) AS zen_kurikoshigaku
                    FROM shiiresaki_sime_dts AS zen
                    WHERE (DATE_FORMAT(zen.sime_hiduke, '%Y-%m') = '{$whereHarai1Date}')
                    group by shiiresaki_mr_cd
                ) AS a ON a.zen_shiiresaki_mr_cd = shiiresaki.cd
                LEFT JOIN(
                    SELECT
                        temp.shiiresaki_mr_cd AS dummy_shiiresaki_mr_cd,
                        sum(temp.zenkai_siiregaku) AS dummy_zenkai_siiregaku,
                        sum(temp.shukkingaku) AS dummy_shukkingaku,
                        sum(temp.konkai_siiregaku) AS dummy_konkai_siiregaku,
                        sum(temp.zenkai_siiregaku) - sum(temp.shukkingaku) AS dummy_kurikoshigaku
                    FROM shiiresaki_sime_dts AS temp
                    WHERE (DATE_FORMAT(temp.sime_hiduke, '%Y-%m') < '{$whereHarai1Date}')
                    group by shiiresaki_mr_cd
                ) AS dummy ON dummy.dummy_shiiresaki_mr_cd = shiiresaki.cd
                LEFT JOIN(
                    SELECT
                        zenzen.shiiresaki_mr_cd AS zenzen_shiiresaki_mr_cd,
                        sum(zenzen.zenkai_siiregaku) AS zenzen_zenkai_siiregaku,
                        sum(zenzen.shukkingaku) AS zenzen_shukkingaku,
                        sum(zenzen.konkai_siiregaku) AS zenzen_konkai_siiregaku,
                        sum(zenzen.zenkai_siiregaku) - sum(zenzen.shukkingaku) AS zenzen_kurikoshigaku
                    FROM shiiresaki_sime_dts AS zenzen
                    WHERE (DATE_FORMAT(zenzen.sime_hiduke, '%Y-%m') < '{$harai2Date}')
                    group by shiiresaki_mr_cd
                ) AS c ON c.zenzen_shiiresaki_mr_cd = shiiresaki.cd
                LEFT JOIN(
                    SELECT
                        zenzenzen.shiiresaki_mr_cd AS zenzenzen_shiiresaki_mr_cd,
                        sum(zenzenzen.zenkai_siiregaku) AS zenzenzen_zenkai_siiregaku,
                        sum(zenzenzen.shukkingaku) AS zenzenzen_shukkingaku,
                        sum(zenzenzen.konkai_siiregaku) AS zenzenzen_konkai_siiregaku,
                        sum(zenzenzen.zenkai_siiregaku) - sum(zenzenzen.shukkingaku) AS zenzenzen_kurikoshigaku
                    FROM shiiresaki_sime_dts AS zenzenzen
                    WHERE (DATE_FORMAT(zenzenzen.sime_hiduke, '%Y-%m') < '{$harai3Date}')
                    group by shiiresaki_mr_cd
                ) AS d ON d.zenzenzen_shiiresaki_mr_cd = shiiresaki.cd
                LEFT JOIN(
                    SELECT
                        tougetsu.shiiresaki_mr_cd AS tougetsu_shiiresaki_mr_cd,
                        tougetsu.zenkai_siiregaku AS tougetsu_zenkai_siiregaku,
                        tougetsu.shukkingaku AS tougetsu_shukkingaku,
                        tougetsu.konkai_siiregaku AS tougetsu_konkai_siiregaku,
                        tougetsu.zenkai_siiregaku - tougetsu.shukkingaku AS tougetsu_kurikoshigaku
                    FROM shiiresaki_sime_dts AS tougetsu
                    WHERE (DATE_FORMAT(tougetsu.shiharai_yoteibi , '%Y-%m') = '{$whereFirstDate}')
                ) AS e ON e.tougetsu_shiiresaki_mr_cd = shiiresaki.cd
                LEFT JOIN(
                    SELECT
                        yokugetsu.shiiresaki_mr_cd AS yokugetsu_shiiresaki_mr_cd,
                        yokugetsu.zenkai_siiregaku AS yokugetsu_zenkai_siiregaku,
                        yokugetsu.shukkingaku AS yokugetsu_shukkingaku,
                        yokugetsu.konkai_siiregaku AS yokugetsu_konkai_siiregaku,
                        yokugetsu.zenkai_siiregaku - yokugetsu.shukkingaku AS yokugetsu_kurikoshigaku
                    FROM shiiresaki_sime_dts AS yokugetsu
                    WHERE (DATE_FORMAT(yokugetsu.shiharai_yoteibi , '%Y-%m') = '{$whereNextDate}')
                ) AS f ON f.yokugetsu_shiiresaki_mr_cd = shiiresaki.cd
                left join(
                    SELECT
                        shu.shiiresaki_mr_cd,
                        sum(shu_m.kingaku) as tougetsukan_shukkingaku
                    from shukkin_dts as shu 
                    LEFT join shukkin_meisai_dts as shu_m on shu_m.shukkin_dt_id = shu.id
                    where shu.shukkinbi BETWEEN '{$firstDate}' and '{$lastDate}'
                    group by shu.shiiresaki_mr_cd
                ) AS g ON g.shiiresaki_mr_cd = shiiresaki.cd
                where shiiresaki.cd between '{$rangeFrom}' and '{$rangeTo}'
                ORDER BY cd
            ";
//            echo '<pre>';
//            echo $phql;
//            echo '</pre>';
            $stmt = $db->prepare($phql);
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
//            echo '<pre>';
//            print_r($rows);
//            echo '</pre>';

            $this->view->rows = $rows;
            $defaultGetsudo = $getsudo;
        } else {
            $today = date("Y-m-d H:i:s");
            $defaultGetsudo = substr((string)$today, 0, 7);
            $rangeFrom = ShiiresakiMrs::minimum(["column" => "cd",]);
            $rangeTo = ShiiresakiMrs::maximum(["column" => "cd",]);
        }
        $this->tag->setDefault('getsudo', $defaultGetsudo);
        $this->tag->setDefault('range_from', $rangeFrom);
        $this->tag->setDefault('range_to', $rangeTo);
    }

}
