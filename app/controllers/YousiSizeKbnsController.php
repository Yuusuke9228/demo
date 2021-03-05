<?php
 


class YousiSizeKbnsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        ControllerBase::indexCd("YousiSizeKbns", "用紙サイズ区分"); //簡易検索付き一覧表示
    }

    /**
     * Searches for yousi_size_kbns
     */
    public function searchAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Displays the creation form
     */
    public function newAction($id=null, $dataname="YousiSizeKbns")
    {
        $this->view->imax = 0;

        if ($id) {
            $nameDts = $dataname;
            $yousi_size_kbn = $nameDts::findFirstByid($id);
            if (!$yousi_size_kbn) {
                $this->flash->error("用紙サイズ区分が見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "yousi_size_kbns",
                    'action' => 'index'
                ));

                return;
            }
            $this->_setDefault($yousi_size_kbn, "new", $dataname);
            $this->tag->setDefault("id", null);
            $this->tag->setDefault("cd", null);
        }

    }

    /**
     * 修正画面から「次へ」ボタンを押したら次のコードの修正画面になる。
     */
    public function nextAction($id)
    {
        ControllerBase::nextCd($id, "yousi_size_kbns", "YousiSizeKbns", "用紙サイズ区分");
    }

    /**
     * 修正画面から「前へ」ボタンを押したら前のコードの修正画面になる。
     */
    public function prevAction($id)
    {
        ControllerBase::prevCd($id, "yousi_size_kbns", "YousiSizeKbns", "用紙サイズ区分");
    }

    /**
     * Edits a yousi_size_kbn
     *
     * @param string $id
     */
    public function editAction($id)
    {
//        if (!$this->request->isPost()) {

            $yousi_size_kbn = YousiSizeKbns::findFirstByid($id);
            if (!$yousi_size_kbn) {
                $this->flash->error("用紙サイズ区分が見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "yousi_size_kbns",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->id = $yousi_size_kbn->id;

            $this->_setDefault($yousi_size_kbn, "edit");
//        }
    }

    /**
     * 画面に表示するデータをセットする
     */
    public function _setDefault($yousi_size_kbn, $action="edit", $meisai="YousiSizeKbns")
    {
        $setdts = ["id",
            "cd",
            "name",
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
            if (property_exists($yousi_size_kbn, $setdt)) {
                $this->tag->setDefault($setdt, $yousi_size_kbn->$setdt);
            }
        }
    }

    /**
     * Creates a new yousi_size_kbn
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "yousi_size_kbns",
                'action' => 'index'
            ));

            return;
        }

        $yousi_size_kbn = new YousiSizeKbns();

        $post_flds = [];
        $post_flds = ["cd",
            "name",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        foreach ($post_flds as $post_fld) {
            $yousi_size_kbn->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$yousi_size_kbn->save()) {
            foreach ($yousi_size_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "yousi_size_kbns",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("用紙サイズ区分の作成が完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "yousi_size_kbns",
            'action' => 'edit',
            'params' => array($yousi_size_kbn->id)
        ));
    }

    /**
     * Saves a yousi_size_kbn edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "yousi_size_kbns",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $yousi_size_kbn = YousiSizeKbns::findFirstByid($id);

        if (!$yousi_size_kbn) {
            $this->flash->error("用紙サイズ区分が見つからなくなりました。" . $id);

            $this->dispatcher->forward(array(
                'controller' => "yousi_size_kbns",
                'action' => 'index'
            ));

            return;
        }

        if ($yousi_size_kbn->updated !== $this->request->getPost("updated")) {
            $this->flash->error("他のプロセスから用紙サイズ区分が変更されたため更新を中止しました。"
                . $id . ",uid=" . $yousi_size_kbn->kousin_user_id . " tb=" . $yousi_size_kbn->updated ." pt=" . $this->request->getPost("updated"));

            $this->dispatcher->forward(array(
                'controller' => "yousi_size_kbns",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $post_flds = [];
        $post_flds = ["cd",
            "name",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        $chg_flg = 0;
        foreach ($post_flds as $post_fld) {
            if ((array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld)) !== $yousi_size_kbn->$post_fld) {
                $chg_flg = 1;
                break;
            }
        }
        if ($chg_flg === 0) {
            $this->flash->error("変更がありません。" . $id);

            $this->dispatcher->forward(array(
                "controller" => "yousi_size_kbns",
                "action" => "edit",
                "params" => array($yousi_size_kbn->id)
            ));

            return;
        }

        $this->_bakOut($yousi_size_kbn);

        foreach ($post_flds as $post_fld) {
            $yousi_size_kbn->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$yousi_size_kbn->save()) {

            foreach ($yousi_size_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "yousi_size_kbns",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $this->flash->success("用紙サイズ区分の情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "yousi_size_kbns",
            'action' => 'edit',
            'params' => array($yousi_size_kbn->id)
        ));
    }

    /**
     * Deletes a yousi_size_kbn
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $yousi_size_kbn = YousiSizeKbns::findFirstByid($id);
        if (!$yousi_size_kbn) {
            $this->flash->error("用紙サイズ区分が見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "yousi_size_kbns",
                'action' => 'index'
            ));

            return;
        }

        $this->_bakOut($yousi_size_kbn, 1);

        if (!$yousi_size_kbn->delete()) {

            foreach ($yousi_size_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "yousi_size_kbns",
                'action' => 'search'
            ));

            return;
        }

        $this->flash->success("用紙サイズ区分の削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "yousi_size_kbns",
            'action' => "index"
        ));
    }

    /**
     * Back Out a yousi_size_kbn
     *
     * @param string $yousi_size_kbn, $dlt_flg
     */
    public function _bakOut($yousi_size_kbn, $dlt_flg = 0)
    {

        $bak_yousi_size_kbn = new BakYousiSizeKbns();
        foreach ($yousi_size_kbn as $fld => $value) {
            $bak_yousi_size_kbn->$fld = $yousi_size_kbn->$fld;
        }
        $bak_yousi_size_kbn->id = NULL;
        $bak_yousi_size_kbn->id_moto = $yousi_size_kbn->id;
        $bak_yousi_size_kbn->hikae_dltflg = $dlt_flg;
        $bak_yousi_size_kbn->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_yousi_size_kbn->hikae_nichiji = date("Y-m-d H:i:s");
        if (!$bak_yousi_size_kbn->save()) {
            foreach ($bak_yousi_size_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
    }

}
