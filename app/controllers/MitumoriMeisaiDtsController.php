<?php
 


class MitumoriMeisaiDtsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        ControllerBase::indexCd("MitumoriMeisaiDts", "見積り明細データ"); //簡易検索付き一覧表示
    }

    /**
     * Searches for mitumori_meisai_dts
     */
    public function searchAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Displays the creation form
     */
    public function newAction($id=null, $dataname="MitumoriMeisaiDts")
    {
        $this->view->imax = 0;

        if ($id) {
            $nameDts = $dataname;
            $mitumori_meisai_dt = $nameDts::findFirstByid($id);
            if (!$mitumori_meisai_dt) {
                $this->flash->error("見積り明細データが見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "mitumori_meisai_dts",
                    'action' => 'index'
                ));

                return;
            }
            $this->_setDefault($mitumori_meisai_dt, "new", $dataname);
            $this->tag->setDefault("id", null);
            $this->tag->setDefault("cd", null);
        }

    }

    /**
     * 修正画面から「次へ」ボタンを押したら次のコードの修正画面になる。
     */
    public function nextAction($id)
    {
        ControllerBase::nextCd($id, "mitumori_meisai_dts", "MitumoriMeisaiDts", "見積り明細データ");
    }

    /**
     * 修正画面から「前へ」ボタンを押したら前のコードの修正画面になる。
     */
    public function prevAction($id)
    {
        ControllerBase::prevCd($id, "mitumori_meisai_dts", "MitumoriMeisaiDts", "見積り明細データ");
    }

    /**
     * Edits a mitumori_meisai_dt
     *
     * @param string $id
     */
    public function editAction($id)
    {
//        if (!$this->request->isPost()) {

            $mitumori_meisai_dt = MitumoriMeisaiDts::findFirstByid($id);
            if (!$mitumori_meisai_dt) {
                $this->flash->error("見積り明細データが見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "mitumori_meisai_dts",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->id = $mitumori_meisai_dt->id;

            $this->_setDefault($mitumori_meisai_dt, "edit");
//        }
    }

    /**
     * 画面に表示するデータをセットする
     */
    public function _setDefault($mitumori_meisai_dt, $action="edit", $meisai="MitumoriMeisaiDts")
    {
        $setdts = ["id",
            "cd",
            "utiwake_kbn_cd",
            "mitumori_dt_id",
            "shouhin_mr_cd",
            "tanni_mr_cd",
            "kousei",
            "irisuu",
            "keisu",
            "tekiyou",
            "lot",
            "kobetucd",
            "hinsitu_kbn_cd",
            "kikaku",
            "iro",
            "size",
            "suuryou",
            "gentanka",
            "tanka",
            "kingaku",
            "genkagaku",
            "project_mr_cd",
            "zeiritu_mr_cd",
            "bikou",
            "hacchuurendou_flg",
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
            if (property_exists($mitumori_meisai_dt, $setdt)) {
                $this->tag->setDefault($setdt, $mitumori_meisai_dt->$setdt);
            }
        }
    }

    /**
     * Creates a new mitumori_meisai_dt
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "mitumori_meisai_dts",
                'action' => 'index'
            ));

            return;
        }

        $mitumori_meisai_dt = new MitumoriMeisaiDts();

        $post_flds = [];
        $post_flds = ["cd",
            "utiwake_kbn_cd",
            "mitumori_dt_id",
            "shouhin_mr_cd",
            "tanni_mr_cd",
            "kousei",
            "irisuu",
            "keisu",
            "tekiyou",
            "lot",
            "kobetucd",
            "hinsitu_kbn_cd",
            "kikaku",
            "iro",
            "size",
            "suuryou",
            "gentanka",
            "tanka",
            "kingaku",
            "genkagaku",
            "project_mr_cd",
            "zeiritu_mr_cd",
            "bikou",
            "hacchuurendou_flg",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        foreach ($post_flds as $post_fld) {
            $mitumori_meisai_dt->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$mitumori_meisai_dt->save()) {
            foreach ($mitumori_meisai_dt->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "mitumori_meisai_dts",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("見積り明細データの作成が完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "mitumori_meisai_dts",
            'action' => 'edit',
            'params' => array($mitumori_meisai_dt->id)
        ));
    }

    /**
     * Saves a mitumori_meisai_dt edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "mitumori_meisai_dts",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $mitumori_meisai_dt = MitumoriMeisaiDts::findFirstByid($id);

        if (!$mitumori_meisai_dt) {
            $this->flash->error("見積り明細データが見つからなくなりました。" . $id);

            $this->dispatcher->forward(array(
                'controller' => "mitumori_meisai_dts",
                'action' => 'index'
            ));

            return;
        }

        if ($mitumori_meisai_dt->updated !== $this->request->getPost("updated")) {
            $this->flash->error("他のプロセスから見積り明細データが変更されたため更新を中止しました。"
                . $id . ",uid=" . $mitumori_meisai_dt->kousin_user_id . " tb=" . $mitumori_meisai_dt->updated ." pt=" . $this->request->getPost("updated"));

            $this->dispatcher->forward(array(
                'controller' => "mitumori_meisai_dts",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $post_flds = [];
        $post_flds = ["cd",
            "utiwake_kbn_cd",
            "mitumori_dt_id",
            "shouhin_mr_cd",
            "tanni_mr_cd",
            "kousei",
            "irisuu",
            "keisu",
            "tekiyou",
            "lot",
            "kobetucd",
            "hinsitu_kbn_cd",
            "kikaku",
            "iro",
            "size",
            "suuryou",
            "gentanka",
            "tanka",
            "kingaku",
            "genkagaku",
            "project_mr_cd",
            "zeiritu_mr_cd",
            "bikou",
            "hacchuurendou_flg",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        $chg_flg = 0;
        foreach ($post_flds as $post_fld) {
            if ((array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld)) !== $mitumori_meisai_dt->$post_fld) {
                $chg_flg = 1;
                break;
            }
        }
        if ($chg_flg === 0) {
            $this->flash->error("変更がありません。" . $id);

            $this->dispatcher->forward(array(
                "controller" => "mitumori_meisai_dts",
                "action" => "edit",
                "params" => array($mitumori_meisai_dt->id)
            ));

            return;
        }

        $this->_bakOut($mitumori_meisai_dt);

        foreach ($post_flds as $post_fld) {
            $mitumori_meisai_dt->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$mitumori_meisai_dt->save()) {

            foreach ($mitumori_meisai_dt->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "mitumori_meisai_dts",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $this->flash->success("見積り明細データの情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "mitumori_meisai_dts",
            'action' => 'edit',
            'params' => array($mitumori_meisai_dt->id)
        ));
    }

    /**
     * Deletes a mitumori_meisai_dt
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $mitumori_meisai_dt = MitumoriMeisaiDts::findFirstByid($id);
        if (!$mitumori_meisai_dt) {
            $this->flash->error("見積り明細データが見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "mitumori_meisai_dts",
                'action' => 'index'
            ));

            return;
        }

        $this->_bakOut($mitumori_meisai_dt, 1);

        if (!$mitumori_meisai_dt->delete()) {

            foreach ($mitumori_meisai_dt->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "mitumori_meisai_dts",
                'action' => 'search'
            ));

            return;
        }

        $this->flash->success("見積り明細データの削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "mitumori_meisai_dts",
            'action' => "index"
        ));
    }

    /**
     * Back Out a mitumori_meisai_dt
     *
     * @param string $mitumori_meisai_dt, $dlt_flg
     */
    public function _bakOut($mitumori_meisai_dt, $dlt_flg = 0)
    {

        $bak_mitumori_meisai_dt = new BakMitumoriMeisaiDts();
        foreach ($mitumori_meisai_dt as $fld => $value) {
            $bak_mitumori_meisai_dt->$fld = $mitumori_meisai_dt->$fld;
        }
        $bak_mitumori_meisai_dt->id = NULL;
        $bak_mitumori_meisai_dt->id_moto = $mitumori_meisai_dt->id;
        $bak_mitumori_meisai_dt->hikae_dltflg = $dlt_flg;
        $bak_mitumori_meisai_dt->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_mitumori_meisai_dt->hikae_nichiji = date("Y-m-d H:i:s");
        if (!$bak_mitumori_meisai_dt->save()) {
            foreach ($bak_mitumori_meisai_dt->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
    }

}
