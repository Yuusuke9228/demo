<?php
 


class ChouhyouKbnsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        ControllerBase::indexCd("ChouhyouKbns", "帳票種別"); //簡易検索付き一覧表示
    }

    /**
     * Searches for chouhyou_kbns
     */
    public function searchAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Displays the creation form
     */
    public function newAction($id=null, $dataname="ChouhyouKbns")
    {
        $this->view->imax = 0;

        if ($id) {
            $nameDts = $dataname;
            $chouhyou_kbn = $nameDts::findFirstByid($id);
            if (!$chouhyou_kbn) {
                $this->flash->error("帳票種別が見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "chouhyou_kbns",
                    'action' => 'index'
                ));

                return;
            }
            $this->_setDefault($chouhyou_kbn, "new", $dataname);
            $this->tag->setDefault("id", null);
            $this->tag->setDefault("cd", null);
        }

    }

    /**
     * 修正画面から「次へ」ボタンを押したら次のコードの修正画面になる。
     */
    public function nextAction($id)
    {
        ControllerBase::nextCd($id, "chouhyou_kbns", "ChouhyouKbns", "帳票種別");
    }

    /**
     * 修正画面から「前へ」ボタンを押したら前のコードの修正画面になる。
     */
    public function prevAction($id)
    {
        ControllerBase::prevCd($id, "chouhyou_kbns", "ChouhyouKbns", "帳票種別");
    }

    /**
     * Edits a chouhyou_kbn
     *
     * @param string $id
     */
    public function editAction($id)
    {
//        if (!$this->request->isPost()) {

            $chouhyou_kbn = ChouhyouKbns::findFirstByid($id);
            if (!$chouhyou_kbn) {
                $this->flash->error("帳票種別が見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "chouhyou_kbns",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->id = $chouhyou_kbn->id;

            $this->_setDefault($chouhyou_kbn, "edit");
//        }
    }

    /**
     * 画面に表示するデータをセットする
     */
    public function _setDefault($chouhyou_kbn, $action="edit", $meisai="ChouhyouKbns")
    {
        $setdts = ["id",
            "cd",
            "name",
            "denpyou_mr_cd",
            "jun",
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
            if (property_exists($chouhyou_kbn, $setdt)) {
                $this->tag->setDefault($setdt, $chouhyou_kbn->$setdt);
            }
        }
    }

    /**
     * Creates a new chouhyou_kbn
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "chouhyou_kbns",
                'action' => 'index'
            ));

            return;
        }

        $chouhyou_kbn = new ChouhyouKbns();

        $post_flds = [];
        $post_flds = ["cd",
            "name",
            "denpyou_mr_cd",
            "jun",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        foreach ($post_flds as $post_fld) {
            $chouhyou_kbn->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$chouhyou_kbn->save()) {
            foreach ($chouhyou_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "chouhyou_kbns",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("帳票種別の作成が完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "chouhyou_kbns",
            'action' => 'edit',
            'params' => array($chouhyou_kbn->id)
        ));
    }

    /**
     * Saves a chouhyou_kbn edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "chouhyou_kbns",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $chouhyou_kbn = ChouhyouKbns::findFirstByid($id);

        if (!$chouhyou_kbn) {
            $this->flash->error("帳票種別が見つからなくなりました。" . $id);

            $this->dispatcher->forward(array(
                'controller' => "chouhyou_kbns",
                'action' => 'index'
            ));

            return;
        }

        if ($chouhyou_kbn->updated !== $this->request->getPost("updated")) {
            $this->flash->error("他のプロセスから帳票種別が変更されたため更新を中止しました。"
                . $id . ",uid=" . $chouhyou_kbn->kousin_user_id . " tb=" . $chouhyou_kbn->updated ." pt=" . $this->request->getPost("updated"));

            $this->dispatcher->forward(array(
                'controller' => "chouhyou_kbns",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $post_flds = [];
        $post_flds = ["cd",
            "name",
            "denpyou_mr_cd",
            "jun",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        $chg_flg = 0;
        foreach ($post_flds as $post_fld) {
            if ((array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld)) !== $chouhyou_kbn->$post_fld) {
                $chg_flg = 1;
                break;
            }
        }
        if ($chg_flg === 0) {
            $this->flash->error("変更がありません。" . $id);

            $this->dispatcher->forward(array(
                "controller" => "chouhyou_kbns",
                "action" => "edit",
                "params" => array($chouhyou_kbn->id)
            ));

            return;
        }

        $this->_bakOut($chouhyou_kbn);

        foreach ($post_flds as $post_fld) {
            $chouhyou_kbn->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$chouhyou_kbn->save()) {

            foreach ($chouhyou_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "chouhyou_kbns",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $this->flash->success("帳票種別の情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "chouhyou_kbns",
            'action' => 'edit',
            'params' => array($chouhyou_kbn->id)
        ));
    }

    /**
     * Deletes a chouhyou_kbn
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $chouhyou_kbn = ChouhyouKbns::findFirstByid($id);
        if (!$chouhyou_kbn) {
            $this->flash->error("帳票種別が見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "chouhyou_kbns",
                'action' => 'index'
            ));

            return;
        }

        $this->_bakOut($chouhyou_kbn, 1);

        if (!$chouhyou_kbn->delete()) {

            foreach ($chouhyou_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "chouhyou_kbns",
                'action' => 'search'
            ));

            return;
        }

        $this->flash->success("帳票種別の削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "chouhyou_kbns",
            'action' => "index"
        ));
    }

    /**
     * Back Out a chouhyou_kbn
     *
     * @param string $chouhyou_kbn, $dlt_flg
     */
    public function _bakOut($chouhyou_kbn, $dlt_flg = 0)
    {

        $bak_chouhyou_kbn = new BakChouhyouKbns();
        foreach ($chouhyou_kbn as $fld => $value) {
            $bak_chouhyou_kbn->$fld = $chouhyou_kbn->$fld;
        }
        $bak_chouhyou_kbn->id = NULL;
        $bak_chouhyou_kbn->id_moto = $chouhyou_kbn->id;
        $bak_chouhyou_kbn->hikae_dltflg = $dlt_flg;
        $bak_chouhyou_kbn->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_chouhyou_kbn->hikae_nichiji = date("Y-m-d H:i:s");
        if (!$bak_chouhyou_kbn->save()) {
            foreach ($bak_chouhyou_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
    }

}