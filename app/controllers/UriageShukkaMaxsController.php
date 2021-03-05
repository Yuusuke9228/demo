<?php
 


class UriageShukkaMaxsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        ControllerBase::indexCd("UriageShukkaMaxs", "VIEW"); //簡易検索付き一覧表示
    }

    /**
     * Searches for uriage_shukka_maxs
     */
    public function searchAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Displays the creation form
     */
    public function newAction($id=null, $dataname="UriageShukkaMaxs")
    {
        $this->view->imax = 0;

        if ($id) {
            $nameDts = $dataname;
            $uriage_shukka_max = $nameDts::findFirstByid($id);
            if (!$uriage_shukka_max) {
                $this->flash->error("VIEWが見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "uriage_shukka_maxs",
                    'action' => 'index'
                ));

                return;
            }
            $this->_setDefault($uriage_shukka_max, "new", $dataname);
            $this->tag->setDefault("juchuu_dt_id", null);
            $this->tag->setDefault("cd", null);
        }

    }

    /**
     * 修正画面から「次へ」ボタンを押したら次のコードの修正画面になる。
     */
    public function nextAction($id)
    {
        ControllerBase::nextCd($id, "uriage_shukka_maxs", "UriageShukkaMaxs", "VIEW");
    }

    /**
     * 修正画面から「前へ」ボタンを押したら前のコードの修正画面になる。
     */
    public function prevAction($id)
    {
        ControllerBase::prevCd($id, "uriage_shukka_maxs", "UriageShukkaMaxs", "VIEW");
    }

    /**
     * Edits a uriage_shukka_max
     *
     * @param string $juchuu_dt_id
     */
    public function editAction($juchuu_dt_id)
    {
//        if (!$this->request->isPost()) {

            $uriage_shukka_max = UriageShukkaMaxs::findFirstByjuchuu_dt_id($juchuu_dt_id);
            if (!$uriage_shukka_max) {
                $this->flash->error("VIEWが見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "uriage_shukka_maxs",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->juchuu_dt_id = $uriage_shukka_max->juchuu_dt_id;

            $this->_setDefault($uriage_shukka_max, "edit");
//        }
    }

    /**
     * 画面に表示するデータをセットする
     */
    public function _setDefault($uriage_shukka_max, $action="edit", $meisai="UriageShukkaMaxs")
    {
        $setdts = ["juchuu_dt_id",
            "shouhin_mr_cd",
            "iro",
            "shukka_kbn_max",
            ];
            
        foreach ($setdts as $setdt) {
            if (property_exists($uriage_shukka_max, $setdt)) {
                $this->tag->setDefault($setdt, $uriage_shukka_max->$setdt);
            }
        }
    }

    /**
     * Creates a new uriage_shukka_max
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "uriage_shukka_maxs",
                'action' => 'index'
            ));

            return;
        }

        $uriage_shukka_max = new UriageShukkaMaxs();

        $post_flds = [];
        $post_flds = ["juchuu_dt_id",
            "shouhin_mr_cd",
            "iro",
            "shukka_kbn_max",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        foreach ($post_flds as $post_fld) {
            $uriage_shukka_max->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$uriage_shukka_max->save()) {
            foreach ($uriage_shukka_max->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "uriage_shukka_maxs",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("VIEWの作成が完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "uriage_shukka_maxs",
            'action' => 'edit',
            'params' => array($uriage_shukka_max->juchuu_dt_id)
        ));
    }

    /**
     * Saves a uriage_shukka_max edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "uriage_shukka_maxs",
                'action' => 'index'
            ));

            return;
        }

        $juchuu_dt_id = $this->request->getPost("juchuu_dt_id");
        $uriage_shukka_max = UriageShukkaMaxs::findFirstByjuchuu_dt_id($juchuu_dt_id);

        if (!$uriage_shukka_max) {
            $this->flash->error("VIEWが見つからなくなりました。" . $juchuu_dt_id);

            $this->dispatcher->forward(array(
                'controller' => "uriage_shukka_maxs",
                'action' => 'index'
            ));

            return;
        }

        if ($uriage_shukka_max->updated !== $this->request->getPost("updated")) {
            $this->flash->error("他のプロセスからVIEWが変更されたため更新を中止しました。"
                . $juchuu_dt_id . ",uid=" . $uriage_shukka_max->kousin_user_id . " tb=" . $uriage_shukka_max->updated ." pt=" . $this->request->getPost("updated"));

            $this->dispatcher->forward(array(
                'controller' => "uriage_shukka_maxs",
                'action' => 'edit',
                'params' => array($juchuu_dt_id)
            ));

            return;
        }

        $post_flds = [];
        $post_flds = ["juchuu_dt_id",
            "shouhin_mr_cd",
            "iro",
            "shukka_kbn_max",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        $chg_flg = 0;
        foreach ($post_flds as $post_fld) {
            if ((array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld)) !== $uriage_shukka_max->$post_fld) {
                $chg_flg = 1;
                break;
            }
        }
        if ($chg_flg === 0) {
            $this->flash->error("変更がありません。" . $juchuu_dt_id);

            $this->dispatcher->forward(array(
                "controller" => "uriage_shukka_maxs",
                "action" => "edit",
                "params" => array($uriage_shukka_max->juchuu_dt_id)
            ));

            return;
        }

        $this->_bakOut($uriage_shukka_max);

        foreach ($post_flds as $post_fld) {
            $uriage_shukka_max->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$uriage_shukka_max->save()) {

            foreach ($uriage_shukka_max->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "uriage_shukka_maxs",
                'action' => 'edit',
                'params' => array($juchuu_dt_id)
            ));

            return;
        }

        $this->flash->success("VIEWの情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "uriage_shukka_maxs",
            'action' => 'edit',
            'params' => array($uriage_shukka_max->juchuu_dt_id)
        ));
    }

    /**
     * Deletes a uriage_shukka_max
     *
     * @param string $juchuu_dt_id
     */
    public function deleteAction($juchuu_dt_id)
    {
        $uriage_shukka_max = UriageShukkaMaxs::findFirstByjuchuu_dt_id($juchuu_dt_id);
        if (!$uriage_shukka_max) {
            $this->flash->error("VIEWが見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "uriage_shukka_maxs",
                'action' => 'index'
            ));

            return;
        }

        $this->_bakOut($uriage_shukka_max, 1);

        if (!$uriage_shukka_max->delete()) {

            foreach ($uriage_shukka_max->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "uriage_shukka_maxs",
                'action' => 'search'
            ));

            return;
        }

        $this->flash->success("VIEWの削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "uriage_shukka_maxs",
            'action' => "index"
        ));
    }

    /**
     * Back Out a uriage_shukka_max
     *
     * @param string $uriage_shukka_max, $dlt_flg
     */
    public function _bakOut($uriage_shukka_max, $dlt_flg = 0)
    {

        $bak_uriage_shukka_max = new BakUriageShukkaMaxs();
        foreach ($uriage_shukka_max as $fld => $value) {
            $bak_uriage_shukka_max->$fld = $uriage_shukka_max->$fld;
        }
        $bak_uriage_shukka_max->juchuu_dt_id = NULL;
        $bak_uriage_shukka_max->moto_juchuu_dt_id = $uriage_shukka_max->juchuu_dt_id;
        $bak_uriage_shukka_max->hikae_dltflg = $dlt_flg;
        $bak_uriage_shukka_max->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_uriage_shukka_max->hikae_nitiji = date("Y-m-d H:i:s");
        if (!$bak_uriage_shukka_max->save()) {
            foreach ($bak_uriage_shukka_max->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
    }

}
