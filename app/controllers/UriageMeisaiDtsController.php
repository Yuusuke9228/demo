<?php
 


class UriageMeisaiDtsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        ControllerBase::indexCd("UriageMeisaiDts", "売上明細データ"); //簡易検索付き一覧表示
    }

    /**
     * Searches for uriage_meisai_dts
     */
    public function searchAction()
    {
        $this->persistent->parameters = null;
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
        $tokuisaki = $this->request->getQuery('tokuisaki');
        $where = " WHERE (a.shouhin_mr_cd = :cd: AND b.tokuisaki_mr_cd = :tokuisaki:)";
        $phql = "
        SELECT
            a.uriage_dt_id AS uriage_dt_id,
            a.shouhin_mr_cd AS shouhin_mr_cd,
            a.tekiyou AS tekiyou,
            a.souko_mr_cd AS souko_mr_cd,
            a.kikaku AS kikaku,
            a.iro AS iro,
            a.size AS size,
            a.suuryou AS suuryou,
            a.tanka AS tanka,
            a.kingaku AS kingaku,
            a.bikou AS bikou,
            a.updated AS updated
        FROM UriageMeisaiDts AS a
        LEFT JOIN UriageDts AS b ON b.id = a.uriage_dt_id
        " . $where . "
        ORDER BY a.updated DESC
        ";
        $uriage_meisai_dts = $mgr->executeQuery($phql, [
            "cd" => $cd,
            "tokuisaki" => $tokuisaki,
        ]);
        $this->view->uriage_meisai_dts = $uriage_meisai_dts;
    }

    /**
     * Displays the creation form
     */
    public function newAction($id=null, $dataname="UriageMeisaiDts")
    {
        $this->view->imax = 0;

        if ($id) {
            $nameDts = $dataname;
            $uriage_meisai_dt = $nameDts::findFirstByid($id);
            if (!$uriage_meisai_dt) {
                $this->flash->error("売上明細データが見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "uriage_meisai_dts",
                    'action' => 'index'
                ));

                return;
            }
            $this->_setDefault($uriage_meisai_dt, "new", $dataname);
            $this->tag->setDefault("id", null);
            $this->tag->setDefault("cd", null);
        }

    }

    /**
     * 修正画面から「次へ」ボタンを押したら次のコードの修正画面になる。
     */
    public function nextAction($id)
    {
        ControllerBase::nextCd($id, "uriage_meisai_dts", "UriageMeisaiDts", "売上明細データ");
    }

    /**
     * 修正画面から「前へ」ボタンを押したら前のコードの修正画面になる。
     */
    public function prevAction($id)
    {
        ControllerBase::prevCd($id, "uriage_meisai_dts", "UriageMeisaiDts", "売上明細データ");
    }

    /**
     * Edits a uriage_meisai_dt
     *
     * @param string $id
     */
    public function editAction($id)
    {
//        if (!$this->request->isPost()) {

            $uriage_meisai_dt = UriageMeisaiDts::findFirstByid($id);
            if (!$uriage_meisai_dt) {
                $this->flash->error("売上明細データが見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "uriage_meisai_dts",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->id = $uriage_meisai_dt->id;

            $this->_setDefault($uriage_meisai_dt, "edit");
//        }
    }

    /**
     * 画面に表示するデータをセットする
     */
    public function _setDefault($uriage_meisai_dt, $action="edit", $meisai="UriageMeisaiDts")
    {
        $setdts = ["id",
            "cd",
            "utiwake_kbn_cd",
            "uriage_dt_id",
            "shukka_kbn_cd",
            "shouhin_mr_cd",
            "tanni_mr_cd",
            "kousei",
            "irisuu",
            "keisu",
            "tekiyou",
            "lot",
            "kobetucd",
            "hinsitu_kbn_cd",
            "souko_mr_cd",
            "kikaku",
            "iro",
            "iromei",
            "size",
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
            if (property_exists($uriage_meisai_dt, $setdt)) {
                $this->tag->setDefault($setdt, $uriage_meisai_dt->$setdt);
            }
        }
    }

    /**
     * Creates a new uriage_meisai_dt
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "uriage_meisai_dts",
                'action' => 'index'
            ));

            return;
        }

        $uriage_meisai_dt = new UriageMeisaiDts();

        $post_flds = [];
        $post_flds = ["cd",
            "utiwake_kbn_cd",
            "uriage_dt_id",
            "shukka_kbn_cd",
            "shouhin_mr_cd",
            "tanni_mr_cd",
            "kousei",
            "irisuu",
            "keisu",
            "tekiyou",
            "lot",
            "kobetucd",
            "hinsitu_kbn_cd",
            "souko_mr_cd",
            "kikaku",
            "iro",
            "iromei",
            "size",
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
            $uriage_meisai_dt->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$uriage_meisai_dt->save()) {
            foreach ($uriage_meisai_dt->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "uriage_meisai_dts",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("売上明細データの作成が完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "uriage_meisai_dts",
            'action' => 'edit',
            'params' => array($uriage_meisai_dt->id)
        ));
    }

    /**
     * Saves a uriage_meisai_dt edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "uriage_meisai_dts",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $uriage_meisai_dt = UriageMeisaiDts::findFirstByid($id);

        if (!$uriage_meisai_dt) {
            $this->flash->error("売上明細データが見つからなくなりました。" . $id);

            $this->dispatcher->forward(array(
                'controller' => "uriage_meisai_dts",
                'action' => 'index'
            ));

            return;
        }

        if ($uriage_meisai_dt->updated !== $this->request->getPost("updated")) {
            $this->flash->error("他のプロセスから売上明細データが変更されたため更新を中止しました。"
                . $id . ",uid=" . $uriage_meisai_dt->kousin_user_id . " tb=" . $uriage_meisai_dt->updated ." pt=" . $this->request->getPost("updated"));

            $this->dispatcher->forward(array(
                'controller' => "uriage_meisai_dts",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $post_flds = [];
        $post_flds = ["cd",
            "utiwake_kbn_cd",
            "uriage_dt_id",
            "shukka_kbn_cd",
            "shouhin_mr_cd",
            "tanni_mr_cd",
            "kousei",
            "irisuu",
            "keisu",
            "tekiyou",
            "lot",
            "kobetucd",
            "hinsitu_kbn_cd",
            "souko_mr_cd",
            "kikaku",
            "iro",
            "iromei",
            "size",
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
            if ((array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld)) !== $uriage_meisai_dt->$post_fld) {
                $chg_flg = 1;
                break;
            }
        }
        if ($chg_flg === 0) {
            $this->flash->error("変更がありません。" . $id);

            $this->dispatcher->forward(array(
                "controller" => "uriage_meisai_dts",
                "action" => "edit",
                "params" => array($uriage_meisai_dt->id)
            ));

            return;
        }

        $this->_bakOut($uriage_meisai_dt);

        foreach ($post_flds as $post_fld) {
            $uriage_meisai_dt->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$uriage_meisai_dt->save()) {

            foreach ($uriage_meisai_dt->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "uriage_meisai_dts",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $this->flash->success("売上明細データの情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "uriage_meisai_dts",
            'action' => 'edit',
            'params' => array($uriage_meisai_dt->id)
        ));
    }

    /**
     * Deletes a uriage_meisai_dt
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $uriage_meisai_dt = UriageMeisaiDts::findFirstByid($id);
        if (!$uriage_meisai_dt) {
            $this->flash->error("売上明細データが見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "uriage_meisai_dts",
                'action' => 'index'
            ));

            return;
        }

        $this->_bakOut($uriage_meisai_dt, 1);

        if (!$uriage_meisai_dt->delete()) {

            foreach ($uriage_meisai_dt->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "uriage_meisai_dts",
                'action' => 'search'
            ));

            return;
        }

        $this->flash->success("売上明細データの削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "uriage_meisai_dts",
            'action' => "index"
        ));
    }

    /**
     * Back Out a uriage_meisai_dt
     *
     * @param string $uriage_meisai_dt, $dlt_flg
     */
    public function _bakOut($uriage_meisai_dt, $dlt_flg = 0)
    {

        $bak_uriage_meisai_dt = new BakUriageMeisaiDts();
        foreach ($uriage_meisai_dt as $fld => $value) {
            $bak_uriage_meisai_dt->$fld = $uriage_meisai_dt->$fld;
        }
        $bak_uriage_meisai_dt->id = NULL;
        $bak_uriage_meisai_dt->id_moto = $uriage_meisai_dt->id;
        $bak_uriage_meisai_dt->hikae_dltflg = $dlt_flg;
        $bak_uriage_meisai_dt->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_uriage_meisai_dt->hikae_nichiji = date("Y-m-d H:i:s");
        if (!$bak_uriage_meisai_dt->save()) {
            foreach ($bak_uriage_meisai_dt->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
    }

}
