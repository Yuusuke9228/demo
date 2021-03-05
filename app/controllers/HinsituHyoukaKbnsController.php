<?php
 


class HinsituHyoukaKbnsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        ControllerBase::indexCd("HinsituHyoukaKbns", "品質評価区分"); //簡易検索付き一覧表示
    }

    /**
     * Searches for hinsitu_hyouka_kbns
     */
    public function searchAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Displays the creation form
     */
    public function newAction($id=null, $dataname="HinsituHyoukaKbns")
    {
        $this->view->imax = 0;

        if ($id) {
            $nameDts = $dataname;
            $hinsitu_hyouka_kbn = $nameDts::findFirstByid($id);
            if (!$hinsitu_hyouka_kbn) {
                $this->flash->error("品質評価区分が見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "hinsitu_hyouka_kbns",
                    'action' => 'index'
                ));

                return;
            }
            $this->_setDefault($hinsitu_hyouka_kbn, "new", $dataname);
            $this->tag->setDefault("id", null);
            $this->tag->setDefault("cd", null);
        }

    }

    /**
     * 修正画面から「次へ」ボタンを押したら次のコードの修正画面になる。
     */
    public function nextAction($id)
    {
        ControllerBase::nextCd($id, "hinsitu_hyouka_kbns", "HinsituHyoukaKbns", "品質評価区分");
    }

    /**
     * 修正画面から「前へ」ボタンを押したら前のコードの修正画面になる。
     */
    public function prevAction($id)
    {
        ControllerBase::prevCd($id, "hinsitu_hyouka_kbns", "HinsituHyoukaKbns", "品質評価区分");
    }

    /**
     * Edits a hinsitu_hyouka_kbn
     *
     * @param string $id
     */
    public function editAction($id)
    {
//        if (!$this->request->isPost()) {

            $hinsitu_hyouka_kbn = HinsituHyoukaKbns::findFirstByid($id);
            if (!$hinsitu_hyouka_kbn) {
                $this->flash->error("品質評価区分が見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "hinsitu_hyouka_kbns",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->id = $hinsitu_hyouka_kbn->id;

            $this->_setDefault($hinsitu_hyouka_kbn, "edit");
//        }
    }

    /**
     * 画面に表示するデータをセットする
     */
    public function _setDefault($hinsitu_hyouka_kbn, $action="edit", $meisai="HinsituHyoukaKbns")
    {
        $setdts = ["id",
            "cd",
            "name",
            "jousuu",
            "biboutanka",
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
            if (property_exists($hinsitu_hyouka_kbn, $setdt)) {
                $this->tag->setDefault($setdt, $hinsitu_hyouka_kbn->$setdt);
            }
        }
    }

    /**
     * Creates a new hinsitu_hyouka_kbn
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "hinsitu_hyouka_kbns",
                'action' => 'index'
            ));

            return;
        }

        $hinsitu_hyouka_kbn = new HinsituHyoukaKbns();

        $post_flds = [];
        $post_flds = ["cd",
            "name",
            "jousuu",
            "biboutanka",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        foreach ($post_flds as $post_fld) {
            $hinsitu_hyouka_kbn->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$hinsitu_hyouka_kbn->save()) {
            foreach ($hinsitu_hyouka_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "hinsitu_hyouka_kbns",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("品質評価区分の作成が完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "hinsitu_hyouka_kbns",
            'action' => 'edit',
            'params' => array($hinsitu_hyouka_kbn->id)
        ));
    }

    /**
     * Saves a hinsitu_hyouka_kbn edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "hinsitu_hyouka_kbns",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $hinsitu_hyouka_kbn = HinsituHyoukaKbns::findFirstByid($id);

        if (!$hinsitu_hyouka_kbn) {
            $this->flash->error("品質評価区分が見つからなくなりました。" . $id);

            $this->dispatcher->forward(array(
                'controller' => "hinsitu_hyouka_kbns",
                'action' => 'index'
            ));

            return;
        }

        if ($hinsitu_hyouka_kbn->updated !== $this->request->getPost("updated")) {
            $this->flash->error("他のプロセスから品質評価区分が変更されたため更新を中止しました。"
                . $id . ",uid=" . $hinsitu_hyouka_kbn->kousin_user_id . " tb=" . $hinsitu_hyouka_kbn->updated ." pt=" . $this->request->getPost("updated"));

            $this->dispatcher->forward(array(
                'controller' => "hinsitu_hyouka_kbns",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $post_flds = [];
        $post_flds = ["cd",
            "name",
            "jousuu",
            "biboutanka",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        $chg_flg = 0;
        foreach ($post_flds as $post_fld) {
            if ((array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld)) !== $hinsitu_hyouka_kbn->$post_fld) {
                $chg_flg = 1;
                break;
            }
        }
        if ($chg_flg === 0) {
            $this->flash->error("変更がありません。" . $id);

            $this->dispatcher->forward(array(
                "controller" => "hinsitu_hyouka_kbns",
                "action" => "edit",
                "params" => array($hinsitu_hyouka_kbn->id)
            ));

            return;
        }

        $this->_bakOut($hinsitu_hyouka_kbn);

        foreach ($post_flds as $post_fld) {
            $hinsitu_hyouka_kbn->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$hinsitu_hyouka_kbn->save()) {

            foreach ($hinsitu_hyouka_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "hinsitu_hyouka_kbns",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $this->flash->success("品質評価区分の情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "hinsitu_hyouka_kbns",
            'action' => 'edit',
            'params' => array($hinsitu_hyouka_kbn->id)
        ));
    }

    /**
     * Deletes a hinsitu_hyouka_kbn
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $hinsitu_hyouka_kbn = HinsituHyoukaKbns::findFirstByid($id);
        if (!$hinsitu_hyouka_kbn) {
            $this->flash->error("品質評価区分が見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "hinsitu_hyouka_kbns",
                'action' => 'index'
            ));

            return;
        }

        $this->_bakOut($hinsitu_hyouka_kbn, 1);

        if (!$hinsitu_hyouka_kbn->delete()) {

            foreach ($hinsitu_hyouka_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "hinsitu_hyouka_kbns",
                'action' => 'search'
            ));

            return;
        }

        $this->flash->success("品質評価区分の削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "hinsitu_hyouka_kbns",
            'action' => "index"
        ));
    }

    /**
     * Back Out a hinsitu_hyouka_kbn
     *
     * @param string $hinsitu_hyouka_kbn, $dlt_flg
     */
    public function _bakOut($hinsitu_hyouka_kbn, $dlt_flg = 0)
    {

        $bak_hinsitu_hyouka_kbn = new BakHinsituHyoukaKbns();
        foreach ($hinsitu_hyouka_kbn as $fld => $value) {
            $bak_hinsitu_hyouka_kbn->$fld = $hinsitu_hyouka_kbn->$fld;
        }
        $bak_hinsitu_hyouka_kbn->id = NULL;
        $bak_hinsitu_hyouka_kbn->id_moto = $hinsitu_hyouka_kbn->id;
        $bak_hinsitu_hyouka_kbn->hikae_dltflg = $dlt_flg;
        $bak_hinsitu_hyouka_kbn->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_hinsitu_hyouka_kbn->hikae_nichiji = date("Y-m-d H:i:s");
        if (!$bak_hinsitu_hyouka_kbn->save()) {
            foreach ($bak_hinsitu_hyouka_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
    }

}
