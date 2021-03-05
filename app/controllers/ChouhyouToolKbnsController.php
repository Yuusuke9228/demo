<?php
 


class ChouhyouToolKbnsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        ControllerBase::indexCd("ChouhyouToolKbns", "帳票種別"); //簡易検索付き一覧表示
    }

    /**
     * Searches for chouhyou_tool_kbns
     */
    public function searchAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Displays the creation form
     */
    public function newAction($id=null, $dataname="ChouhyouToolKbns")
    {
        $this->view->imax = 0;

        if ($id) {
            $nameDts = $dataname;
            $chouhyou_tool_kbn = $nameDts::findFirstByid($id);
            if (!$chouhyou_tool_kbn) {
                $this->flash->error("帳票種別が見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "chouhyou_tool_kbns",
                    'action' => 'index'
                ));

                return;
            }
            $this->_setDefault($chouhyou_tool_kbn, "new", $dataname);
            $this->tag->setDefault("id", null);
            $this->tag->setDefault("cd", null);
        }

    }

    /**
     * 修正画面から「次へ」ボタンを押したら次のコードの修正画面になる。
     */
    public function nextAction($id)
    {
        ControllerBase::nextCd($id, "chouhyou_tool_kbns", "ChouhyouToolKbns", "帳票種別");
    }

    /**
     * 修正画面から「前へ」ボタンを押したら前のコードの修正画面になる。
     */
    public function prevAction($id)
    {
        ControllerBase::prevCd($id, "chouhyou_tool_kbns", "ChouhyouToolKbns", "帳票種別");
    }

    /**
     * Edits a chouhyou_tool_kbn
     *
     * @param string $id
     */
    public function editAction($id)
    {
//        if (!$this->request->isPost()) {

            $chouhyou_tool_kbn = ChouhyouToolKbns::findFirstByid($id);
            if (!$chouhyou_tool_kbn) {
                $this->flash->error("帳票種別が見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "chouhyou_tool_kbns",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->id = $chouhyou_tool_kbn->id;

            $this->_setDefault($chouhyou_tool_kbn, "edit");
//        }
    }

    /**
     * 画面に表示するデータをセットする
     */
    public function _setDefault($chouhyou_tool_kbn, $action="edit", $meisai="ChouhyouToolKbns")
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
            if (property_exists($chouhyou_tool_kbn, $setdt)) {
                $this->tag->setDefault($setdt, $chouhyou_tool_kbn->$setdt);
            }
        }
    }

    /**
     * Creates a new chouhyou_tool_kbn
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "chouhyou_tool_kbns",
                'action' => 'index'
            ));

            return;
        }

        $chouhyou_tool_kbn = new ChouhyouToolKbns();

        $post_flds = [];
        $post_flds = ["cd",
            "name",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        foreach ($post_flds as $post_fld) {
            $chouhyou_tool_kbn->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$chouhyou_tool_kbn->save()) {
            foreach ($chouhyou_tool_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "chouhyou_tool_kbns",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("帳票種別の作成が完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "chouhyou_tool_kbns",
            'action' => 'edit',
            'params' => array($chouhyou_tool_kbn->id)
        ));
    }

    /**
     * Saves a chouhyou_tool_kbn edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "chouhyou_tool_kbns",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $chouhyou_tool_kbn = ChouhyouToolKbns::findFirstByid($id);

        if (!$chouhyou_tool_kbn) {
            $this->flash->error("帳票種別が見つからなくなりました。" . $id);

            $this->dispatcher->forward(array(
                'controller' => "chouhyou_tool_kbns",
                'action' => 'index'
            ));

            return;
        }

        if ($chouhyou_tool_kbn->updated !== $this->request->getPost("updated")) {
            $this->flash->error("他のプロセスから帳票種別が変更されたため更新を中止しました。"
                . $id . ",uid=" . $chouhyou_tool_kbn->kousin_user_id . " tb=" . $chouhyou_tool_kbn->updated ." pt=" . $this->request->getPost("updated"));

            $this->dispatcher->forward(array(
                'controller' => "chouhyou_tool_kbns",
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
            if ((array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld)) !== $chouhyou_tool_kbn->$post_fld) {
                $chg_flg = 1;
                break;
            }
        }
        if ($chg_flg === 0) {
            $this->flash->error("変更がありません。" . $id);

            $this->dispatcher->forward(array(
                "controller" => "chouhyou_tool_kbns",
                "action" => "edit",
                "params" => array($chouhyou_tool_kbn->id)
            ));

            return;
        }

        $this->_bakOut($chouhyou_tool_kbn);

        foreach ($post_flds as $post_fld) {
            $chouhyou_tool_kbn->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$chouhyou_tool_kbn->save()) {

            foreach ($chouhyou_tool_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "chouhyou_tool_kbns",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $this->flash->success("帳票種別の情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "chouhyou_tool_kbns",
            'action' => 'edit',
            'params' => array($chouhyou_tool_kbn->id)
        ));
    }

    /**
     * Deletes a chouhyou_tool_kbn
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $chouhyou_tool_kbn = ChouhyouToolKbns::findFirstByid($id);
        if (!$chouhyou_tool_kbn) {
            $this->flash->error("帳票種別が見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "chouhyou_tool_kbns",
                'action' => 'index'
            ));

            return;
        }

        $this->_bakOut($chouhyou_tool_kbn, 1);

        if (!$chouhyou_tool_kbn->delete()) {

            foreach ($chouhyou_tool_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "chouhyou_tool_kbns",
                'action' => 'search'
            ));

            return;
        }

        $this->flash->success("帳票種別の削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "chouhyou_tool_kbns",
            'action' => "index"
        ));
    }

    /**
     * Back Out a chouhyou_tool_kbn
     *
     * @param string $chouhyou_tool_kbn, $dlt_flg
     */
    public function _bakOut($chouhyou_tool_kbn, $dlt_flg = 0)
    {

        $bak_chouhyou_tool_kbn = new BakChouhyouToolKbns();
        foreach ($chouhyou_tool_kbn as $fld => $value) {
            $bak_chouhyou_tool_kbn->$fld = $chouhyou_tool_kbn->$fld;
        }
        $bak_chouhyou_tool_kbn->id = NULL;
        $bak_chouhyou_tool_kbn->id_moto = $chouhyou_tool_kbn->id;
        $bak_chouhyou_tool_kbn->hikae_dltflg = $dlt_flg;
        $bak_chouhyou_tool_kbn->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_chouhyou_tool_kbn->hikae_nichiji = date("Y-m-d H:i:s");
        if (!$bak_chouhyou_tool_kbn->save()) {
            foreach ($bak_chouhyou_tool_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
    }

}
