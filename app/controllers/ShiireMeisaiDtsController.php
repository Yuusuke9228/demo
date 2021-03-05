<?php
 


class ShiireMeisaiDtsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        ControllerBase::indexCd("ShiireMeisaiDts", "仕入明細データ"); //簡易検索付き一覧表示
    }

    /**
     * 単価の履歴を確認するためのアクション
     * Add By Nishiyama 2019/1/9
     */
    public function historyAction()
    {
        $di = \Phalcon\DI::getDefault();
        $mgr = $di->get('modelsManager');
        $cd = $this->request->getQuery('cd');
        $shiiresaki = $this->request->getQuery('shiiresaki');
        $where = " WHERE (a.shouhin_mr_cd = :cd: AND b.shiiresaki_mr_cd = :shiiresaki:)";
        $phql = "
        SELECT
            a.shiire_dt_id AS shiire_dt_id,
            a.shouhin_mr_cd AS shouhin_mr_cd,
            a.tekiyou AS tekiyou,
            a.souko_mr_cd AS souko_mr_cd,
            a.lot AS lot,
            a.suuryou2 AS suuryou2,
            a.tanka AS tanka,
            a.kingaku AS kingaku,
            a.bikou AS bikou,
            a.updated AS updated
        FROM ShiireMeisaiDts AS a
        LEFT JOIN ShiireDts AS b ON b.id = a.shiire_dt_id
        " . $where . "
        ORDER BY a.updated DESC
        ";
        $shiire_meisai_dts = $mgr->executeQuery($phql, [
            "cd" => $cd,
            "shiiresaki" => $shiiresaki,
        ]);

        $this->view->shiire_meisai_dts = $shiire_meisai_dts;
    }

    /**
     * Searches for shiire_meisai_dts
     */
    public function searchAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Displays the creation form
     */
    public function newAction($id=null, $dataname="ShiireMeisaiDts")
    {
        $this->view->imax = 0;

        if ($id) {
            $nameDts = $dataname;
            $shiire_meisai_dt = $nameDts::findFirstByid($id);
            if (!$shiire_meisai_dt) {
                $this->flash->error("仕入明細データが見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "shiire_meisai_dts",
                    'action' => 'index'
                ));

                return;
            }
            $this->_setDefault($shiire_meisai_dt, "new", $dataname);
            $this->tag->setDefault("id", null);
            $this->tag->setDefault("cd", null);
        }

    }

    /**
     * 修正画面から「次へ」ボタンを押したら次のコードの修正画面になる。
     */
    public function nextAction($id)
    {
        ControllerBase::nextCd($id, "shiire_meisai_dts", "ShiireMeisaiDts", "仕入明細データ");
    }

    /**
     * 修正画面から「前へ」ボタンを押したら前のコードの修正画面になる。
     */
    public function prevAction($id)
    {
        ControllerBase::prevCd($id, "shiire_meisai_dts", "ShiireMeisaiDts", "仕入明細データ");
    }

    /**
     * Edits a shiire_meisai_dt
     *
     * @param string $id
     */
    public function editAction($id)
    {
//        if (!$this->request->isPost()) {

            $shiire_meisai_dt = ShiireMeisaiDts::findFirstByid($id);
            if (!$shiire_meisai_dt) {
                $this->flash->error("仕入明細データが見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "shiire_meisai_dts",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->id = $shiire_meisai_dt->id;

            $this->_setDefault($shiire_meisai_dt, "edit");
//        }
    }

    /**
     * 画面に表示するデータをセットする
     */
    public function _setDefault($shiire_meisai_dt, $action="edit", $meisai="ShiireMeisaiDts")
    {
        $setdts = ["id",
            "cd",
            "utiwake_kbn_cd",
            "shiire_dt_id",
            "nyuuka_kbn_cd",
            "shouhin_mr_cd",
            "tanni_mr_cd",
            "kousei",
            "irisuu",
            "keisu",
            "tekiyou",
            "lot",
            "kobetucd",
            "hinsitu_kbn_cd",
            "iro",
            "iromei",
            "size",
            "souko_mr_cd",
            "suuryou",
            "suuryou1",
            "tanni_mr1_cd",
            "suuryou2",
            "tanni_mr2_cd",
            "tanka_kbn",
            "gentanka",
            "tanka",
            "kingaku",
            "genkagaku",
            "zeinukigaku",
            "zeigaku",
            "project_mr_cd",
            "zeiritu_mr_cd",
            "bikou",
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
            if (property_exists($shiire_meisai_dt, $setdt)) {
                $this->tag->setDefault($setdt, $shiire_meisai_dt->$setdt);
            }
        }
    }

    /**
     * Creates a new shiire_meisai_dt
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "shiire_meisai_dts",
                'action' => 'index'
            ));

            return;
        }

        $shiire_meisai_dt = new ShiireMeisaiDts();

        $post_flds = [];
        $post_flds = ["cd",
            "utiwake_kbn_cd",
            "shiire_dt_id",
            "nyuuka_kbn_cd",
            "shouhin_mr_cd",
            "tanni_mr_cd",
            "kousei",
            "irisuu",
            "keisu",
            "tekiyou",
            "lot",
            "kobetucd",
            "hinsitu_kbn_cd",
            "iro",
            "iromei",
            "size",
            "souko_mr_cd",
            "suuryou",
            "suuryou1",
            "tanni_mr1_cd",
            "suuryou2",
            "tanni_mr2_cd",
            "tanka_kbn",
            "gentanka",
            "tanka",
            "kingaku",
            "genkagaku",
            "zeinukigaku",
            "zeigaku",
            "project_mr_cd",
            "zeiritu_mr_cd",
            "bikou",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        foreach ($post_flds as $post_fld) {
            $shiire_meisai_dt->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$shiire_meisai_dt->save()) {
            foreach ($shiire_meisai_dt->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "shiire_meisai_dts",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("仕入明細データの作成が完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "shiire_meisai_dts",
            'action' => 'edit',
            'params' => array($shiire_meisai_dt->id)
        ));
    }

    /**
     * Saves a shiire_meisai_dt edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "shiire_meisai_dts",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $shiire_meisai_dt = ShiireMeisaiDts::findFirstByid($id);

        if (!$shiire_meisai_dt) {
            $this->flash->error("仕入明細データが見つからなくなりました。" . $id);

            $this->dispatcher->forward(array(
                'controller' => "shiire_meisai_dts",
                'action' => 'index'
            ));

            return;
        }

        if ($shiire_meisai_dt->updated !== $this->request->getPost("updated")) {
            $this->flash->error("他のプロセスから仕入明細データが変更されたため更新を中止しました。"
                . $id . ",uid=" . $shiire_meisai_dt->kousin_user_id . " tb=" . $shiire_meisai_dt->updated ." pt=" . $this->request->getPost("updated"));

            $this->dispatcher->forward(array(
                'controller' => "shiire_meisai_dts",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $post_flds = [];
        $post_flds = ["cd",
            "utiwake_kbn_cd",
            "shiire_dt_id",
            "nyuuka_kbn_cd",
            "shouhin_mr_cd",
            "tanni_mr_cd",
            "kousei",
            "irisuu",
            "keisu",
            "tekiyou",
            "lot",
            "kobetucd",
            "hinsitu_kbn_cd",
            "iro",
            "iromei",
            "size",
            "souko_mr_cd",
            "suuryou",
            "suuryou1",
            "tanni_mr1_cd",
            "suuryou2",
            "tanni_mr2_cd",
            "tanka_kbn",
            "gentanka",
            "tanka",
            "kingaku",
            "genkagaku",
            "zeinukigaku",
            "zeigaku",
            "project_mr_cd",
            "zeiritu_mr_cd",
            "bikou",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        $chg_flg = 0;
        foreach ($post_flds as $post_fld) {
            if ((array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld)) !== $shiire_meisai_dt->$post_fld) {
                $chg_flg = 1;
                break;
            }
        }
        if ($chg_flg === 0) {
            $this->flash->error("変更がありません。" . $id);

            $this->dispatcher->forward(array(
                "controller" => "shiire_meisai_dts",
                "action" => "edit",
                "params" => array($shiire_meisai_dt->id)
            ));

            return;
        }

        $this->_bakOut($shiire_meisai_dt);

        foreach ($post_flds as $post_fld) {
            $shiire_meisai_dt->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$shiire_meisai_dt->save()) {

            foreach ($shiire_meisai_dt->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "shiire_meisai_dts",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $this->flash->success("仕入明細データの情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "shiire_meisai_dts",
            'action' => 'edit',
            'params' => array($shiire_meisai_dt->id)
        ));
    }

    /**
     * Deletes a shiire_meisai_dt
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $shiire_meisai_dt = ShiireMeisaiDts::findFirstByid($id);
        if (!$shiire_meisai_dt) {
            $this->flash->error("仕入明細データが見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "shiire_meisai_dts",
                'action' => 'index'
            ));

            return;
        }

        $this->_bakOut($shiire_meisai_dt, 1);

        if (!$shiire_meisai_dt->delete()) {

            foreach ($shiire_meisai_dt->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "shiire_meisai_dts",
                'action' => 'search'
            ));

            return;
        }

        $this->flash->success("仕入明細データの削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "shiire_meisai_dts",
            'action' => "index"
        ));
    }

    /**
     * Back Out a shiire_meisai_dt
     *
     * @param string $shiire_meisai_dt, $dlt_flg
     */
    public function _bakOut($shiire_meisai_dt, $dlt_flg = 0)
    {

        $bak_shiire_meisai_dt = new BakShiireMeisaiDts();
        foreach ($shiire_meisai_dt as $fld => $value) {
            $bak_shiire_meisai_dt->$fld = $shiire_meisai_dt->$fld;
        }
        $bak_shiire_meisai_dt->id = NULL;
        $bak_shiire_meisai_dt->id_moto = $shiire_meisai_dt->id;
        $bak_shiire_meisai_dt->hikae_dltflg = $dlt_flg;
        $bak_shiire_meisai_dt->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_shiire_meisai_dt->hikae_nichiji = date("Y-m-d H:i:s");
        if (!$bak_shiire_meisai_dt->save()) {
            foreach ($bak_shiire_meisai_dt->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
    }

}
