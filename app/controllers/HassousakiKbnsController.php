<?php
 


class HassousakiKbnsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        ControllerBase::indexCd("HassousakiKbns", "発送先区分"); //簡易検索付き一覧表示
    }

    /**
     * Searches for hassousaki_kbns
     */
    public function searchAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Displays the creation form
     */
    public function newAction($id=null, $dataname="HassousakiKbns")
    {
        $this->view->imax = 0;

        if ($id) {
            $nameDts = $dataname;
            $hassousaki_kbn = $nameDts::findFirstByid($id);
            if (!$hassousaki_kbn) {
                $this->flash->error("発送先区分が見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "hassousaki_kbns",
                    'action' => 'index'
                ));

                return;
            }
            $this->_setDefault($hassousaki_kbn, "new", $dataname);
            $this->tag->setDefault("id", null);
            $this->tag->setDefault("cd", null);
        }

    }

    /**
     * 修正画面から「次へ」ボタンを押したら次のコードの修正画面になる。
     */
    public function nextAction($id)
    {
        ControllerBase::nextCd($id, "hassousaki_kbns", "HassousakiKbns", "発送先区分");
    }

    /**
     * 修正画面から「前へ」ボタンを押したら前のコードの修正画面になる。
     */
    public function prevAction($id)
    {
        ControllerBase::prevCd($id, "hassousaki_kbns", "HassousakiKbns", "発送先区分");
    }

    /**
     * Edits a hassousaki_kbn
     *
     * @param string $id
     */
    public function editAction($id)
    {
//        if (!$this->request->isPost()) {

            $hassousaki_kbn = HassousakiKbns::findFirstByid($id);
            if (!$hassousaki_kbn) {
                $this->flash->error("発送先区分が見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "hassousaki_kbns",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->id = $hassousaki_kbn->id;

            $this->_setDefault($hassousaki_kbn, "edit");
//        }
    }

    /**
     * 画面に表示するデータをセットする
     */
    public function _setDefault($hassousaki_kbn, $action="edit", $meisai="HassousakiKbns")
    {
        $setdts = ["id",
            "cd",
            "name",
            "sanshou_table",
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
            if (property_exists($hassousaki_kbn, $setdt)) {
                $this->tag->setDefault($setdt, $hassousaki_kbn->$setdt);
            }
        }
    }

    /**
     * Creates a new hassousaki_kbn
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "hassousaki_kbns",
                'action' => 'index'
            ));

            return;
        }

        $hassousaki_kbn = new HassousakiKbns();

        $post_flds = [];
        $post_flds = ["cd",
            "name",
            "sanshou_table",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        foreach ($post_flds as $post_fld) {
            $hassousaki_kbn->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$hassousaki_kbn->save()) {
            foreach ($hassousaki_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "hassousaki_kbns",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("発送先区分の作成が完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "hassousaki_kbns",
            'action' => 'edit',
            'params' => array($hassousaki_kbn->id)
        ));
    }

    /**
     * Saves a hassousaki_kbn edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "hassousaki_kbns",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $hassousaki_kbn = HassousakiKbns::findFirstByid($id);

        if (!$hassousaki_kbn) {
            $this->flash->error("発送先区分が見つからなくなりました。" . $id);

            $this->dispatcher->forward(array(
                'controller' => "hassousaki_kbns",
                'action' => 'index'
            ));

            return;
        }

        if ($hassousaki_kbn->updated !== $this->request->getPost("updated")) {
            $this->flash->error("他のプロセスから発送先区分が変更されたため更新を中止しました。"
                . $id . ",uid=" . $hassousaki_kbn->kousin_user_id . " tb=" . $hassousaki_kbn->updated ." pt=" . $this->request->getPost("updated"));

            $this->dispatcher->forward(array(
                'controller' => "hassousaki_kbns",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $post_flds = [];
        $post_flds = ["cd",
            "name",
            "sanshou_table",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        $chg_flg = 0;
        foreach ($post_flds as $post_fld) {
            if ((array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld)) !== $hassousaki_kbn->$post_fld) {
                $chg_flg = 1;
                break;
            }
        }
        if ($chg_flg === 0) {
            $this->flash->error("変更がありません。" . $id);

            $this->dispatcher->forward(array(
                "controller" => "hassousaki_kbns",
                "action" => "edit",
                "params" => array($hassousaki_kbn->id)
            ));

            return;
        }

        $this->_bakOut($hassousaki_kbn);

        foreach ($post_flds as $post_fld) {
            $hassousaki_kbn->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$hassousaki_kbn->save()) {

            foreach ($hassousaki_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "hassousaki_kbns",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $this->flash->success("発送先区分の情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "hassousaki_kbns",
            'action' => 'edit',
            'params' => array($hassousaki_kbn->id)
        ));
    }

    /**
     * Deletes a hassousaki_kbn
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $hassousaki_kbn = HassousakiKbns::findFirstByid($id);
        if (!$hassousaki_kbn) {
            $this->flash->error("発送先区分が見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "hassousaki_kbns",
                'action' => 'index'
            ));

            return;
        }

        $this->_bakOut($hassousaki_kbn, 1);

        if (!$hassousaki_kbn->delete()) {

            foreach ($hassousaki_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "hassousaki_kbns",
                'action' => 'search'
            ));

            return;
        }

        $this->flash->success("発送先区分の削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "hassousaki_kbns",
            'action' => "index"
        ));
    }

    /**
     * Back Out a hassousaki_kbn
     *
     * @param string $hassousaki_kbn, $dlt_flg
     */
    public function _bakOut($hassousaki_kbn, $dlt_flg = 0)
    {

        $bak_hassousaki_kbn = new BakHassousakiKbns();
        foreach ($hassousaki_kbn as $fld => $value) {
            $bak_hassousaki_kbn->$fld = $hassousaki_kbn->$fld;
        }
        $bak_hassousaki_kbn->id = NULL;
        $bak_hassousaki_kbn->id_moto = $hassousaki_kbn->id;
        $bak_hassousaki_kbn->hikae_dltflg = $dlt_flg;
        $bak_hassousaki_kbn->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_hassousaki_kbn->hikae_nichiji = date("Y-m-d H:i:s");
        if (!$bak_hassousaki_kbn->save()) {
            foreach ($bak_hassousaki_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
    }

}
