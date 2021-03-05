<?php
 


class HinsituKbnsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        ControllerBase::indexCd("HinsituKbns", "品質区分"); //簡易検索付き一覧表示
    }

    /**
     * Searches for hinsitu_kbns
     */
    public function searchAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Displays the creation form
     */
    public function newAction($id=null, $dataname="HinsituKbns")
    {
        $this->view->imax = 0;

        if ($id) {
            $nameDts = $dataname;
            $hinsitu_kbn = $nameDts::findFirstByid($id);
            if (!$hinsitu_kbn) {
                $this->flash->error("品質区分が見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "hinsitu_kbns",
                    'action' => 'index'
                ));

                return;
            }
            $this->_setDefault($hinsitu_kbn, "new", $dataname);
            $this->tag->setDefault("id", null);
            $this->tag->setDefault("cd", null);
        }

    }

    /**
     * 修正画面から「次へ」ボタンを押したら次のコードの修正画面になる。
     */
    public function nextAction($id)
    {
        ControllerBase::nextCd($id, "hinsitu_kbns", "HinsituKbns", "品質区分");
    }

    /**
     * 修正画面から「前へ」ボタンを押したら前のコードの修正画面になる。
     */
    public function prevAction($id)
    {
        ControllerBase::prevCd($id, "hinsitu_kbns", "HinsituKbns", "品質区分");
    }

    /**
     * Edits a hinsitu_kbn
     *
     * @param string $id
     */
    public function editAction($id)
    {
//        if (!$this->request->isPost()) {

            $hinsitu_kbn = HinsituKbns::findFirstByid($id);
            if (!$hinsitu_kbn) {
                $this->flash->error("品質区分が見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "hinsitu_kbns",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->id = $hinsitu_kbn->id;

            $this->_setDefault($hinsitu_kbn, "edit");
//        }
    }

    /**
     * 画面に表示するデータをセットする
     */
    public function _setDefault($hinsitu_kbn, $action="edit", $meisai="HinsituKbns")
    {
        $setdts = ["id",
            "cd",
            "name",
            "daibunrui",
            "hinsitu_hyouka_kbn_cd",
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
            if (property_exists($hinsitu_kbn, $setdt)) {
                $this->tag->setDefault($setdt, $hinsitu_kbn->$setdt);
            }
        }
    }

    /**
     * Creates a new hinsitu_kbn
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "hinsitu_kbns",
                'action' => 'index'
            ));

            return;
        }

        $hinsitu_kbn = new HinsituKbns();

        $post_flds = [];
        $post_flds = ["cd",
            "name",
            "daibunrui",
            "hinsitu_hyouka_kbn_cd",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        foreach ($post_flds as $post_fld) {
            $hinsitu_kbn->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$hinsitu_kbn->save()) {
            foreach ($hinsitu_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "hinsitu_kbns",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("品質区分の作成が完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "hinsitu_kbns",
            'action' => 'edit',
            'params' => array($hinsitu_kbn->id)
        ));
    }

    /**
     * Saves a hinsitu_kbn edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "hinsitu_kbns",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $hinsitu_kbn = HinsituKbns::findFirstByid($id);

        if (!$hinsitu_kbn) {
            $this->flash->error("品質区分が見つからなくなりました。" . $id);

            $this->dispatcher->forward(array(
                'controller' => "hinsitu_kbns",
                'action' => 'index'
            ));

            return;
        }

        if ($hinsitu_kbn->updated !== $this->request->getPost("updated")) {
            $this->flash->error("他のプロセスから品質区分が変更されたため更新を中止しました。"
                . $id . ",uid=" . $hinsitu_kbn->kousin_user_id . " tb=" . $hinsitu_kbn->updated ." pt=" . $this->request->getPost("updated"));

            $this->dispatcher->forward(array(
                'controller' => "hinsitu_kbns",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $post_flds = [];
        $post_flds = ["cd",
            "name",
            "daibunrui",
            "hinsitu_hyouka_kbn_cd",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        $chg_flg = 0;
        foreach ($post_flds as $post_fld) {
            if ((array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld)) !== $hinsitu_kbn->$post_fld) {
                $chg_flg = 1;
                break;
            }
        }
        if ($chg_flg === 0) {
            $this->flash->error("変更がありません。" . $id);

            $this->dispatcher->forward(array(
                "controller" => "hinsitu_kbns",
                "action" => "edit",
                "params" => array($hinsitu_kbn->id)
            ));

            return;
        }

        $this->_bakOut($hinsitu_kbn);

        foreach ($post_flds as $post_fld) {
            $hinsitu_kbn->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$hinsitu_kbn->save()) {

            foreach ($hinsitu_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "hinsitu_kbns",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $this->flash->success("品質区分の情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "hinsitu_kbns",
            'action' => 'edit',
            'params' => array($hinsitu_kbn->id)
        ));
    }

    /**
     * Deletes a hinsitu_kbn
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $hinsitu_kbn = HinsituKbns::findFirstByid($id);
        if (!$hinsitu_kbn) {
            $this->flash->error("品質区分が見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "hinsitu_kbns",
                'action' => 'index'
            ));

            return;
        }

        $this->_bakOut($hinsitu_kbn, 1);

        if (!$hinsitu_kbn->delete()) {

            foreach ($hinsitu_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "hinsitu_kbns",
                'action' => 'search'
            ));

            return;
        }

        $this->flash->success("品質区分の削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "hinsitu_kbns",
            'action' => "index"
        ));
    }

    /**
     * Back Out a hinsitu_kbn
     *
     * @param string $hinsitu_kbn, $dlt_flg
     */
    public function _bakOut($hinsitu_kbn, $dlt_flg = 0)
    {

        $bak_hinsitu_kbn = new BakHinsituKbns();
        foreach ($hinsitu_kbn as $fld => $value) {
            $bak_hinsitu_kbn->$fld = $hinsitu_kbn->$fld;
        }
        $bak_hinsitu_kbn->id = NULL;
        $bak_hinsitu_kbn->id_moto = $hinsitu_kbn->id;
        $bak_hinsitu_kbn->hikae_dltflg = $dlt_flg;
        $bak_hinsitu_kbn->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_hinsitu_kbn->hikae_nichiji = date("Y-m-d H:i:s");
        if (!$bak_hinsitu_kbn->save()) {
            foreach ($bak_hinsitu_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
    }

}
