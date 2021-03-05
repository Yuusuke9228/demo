<?php
 


class ShiharaiKbnsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        ControllerBase::indexCd("ShiharaiKbns", "支払区分"); //簡易検索付き一覧表示
    }

    /**
     * Searches for shiharai_kbns
     */
    public function searchAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Displays the creation form
     */
    public function newAction($id=null, $dataname="ShiharaiKbns")
    {
        $this->view->imax = 0;

        if ($id) {
            $nameDts = $dataname;
            $shiharai_kbn = $nameDts::findFirstByid($id);
            if (!$shiharai_kbn) {
                $this->flash->error("支払区分が見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "shiharai_kbns",
                    'action' => 'index'
                ));

                return;
            }
            $this->_setDefault($shiharai_kbn, "new", $dataname);
            $this->tag->setDefault("id", null);
            $this->tag->setDefault("cd", null);
        }

    }

    /**
     * 修正画面から「次へ」ボタンを押したら次のコードの修正画面になる。
     */
    public function nextAction($id)
    {
        ControllerBase::nextCd($id, "shiharai_kbns", "ShiharaiKbns", "支払区分");
    }

    /**
     * 修正画面から「前へ」ボタンを押したら前のコードの修正画面になる。
     */
    public function prevAction($id)
    {
        ControllerBase::prevCd($id, "shiharai_kbns", "ShiharaiKbns", "支払区分");
    }

    /**
     * Edits a shiharai_kbn
     *
     * @param string $id
     */
    public function editAction($id)
    {
//        if (!$this->request->isPost()) {

            $shiharai_kbn = ShiharaiKbns::findFirstByid($id);
            if (!$shiharai_kbn) {
                $this->flash->error("支払区分が見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "shiharai_kbns",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->id = $shiharai_kbn->id;

            $this->_setDefault($shiharai_kbn, "edit");
//        }
    }

    /**
     * 画面に表示するデータをセットする
     */
    public function _setDefault($shiharai_kbn, $action="edit", $meisai="ShiharaiKbns")
    {
        $setdts = ["id",
            "cd",
            "name",
            "shiharai_bunrui_kbn_cd",
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
            if (property_exists($shiharai_kbn, $setdt)) {
                $this->tag->setDefault($setdt, $shiharai_kbn->$setdt);
            }
        }
    }

    /**
     * Creates a new shiharai_kbn
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "shiharai_kbns",
                'action' => 'index'
            ));

            return;
        }

        $shiharai_kbn = new ShiharaiKbns();

        $post_flds = [];
        $post_flds = ["cd",
            "name",
            "shiharai_bunrui_kbn_cd",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        foreach ($post_flds as $post_fld) {
            $shiharai_kbn->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$shiharai_kbn->save()) {
            foreach ($shiharai_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "shiharai_kbns",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("支払区分の作成が完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "shiharai_kbns",
            'action' => 'edit',
            'params' => array($shiharai_kbn->id)
        ));
    }

    /**
     * Saves a shiharai_kbn edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "shiharai_kbns",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $shiharai_kbn = ShiharaiKbns::findFirstByid($id);

        if (!$shiharai_kbn) {
            $this->flash->error("支払区分が見つからなくなりました。" . $id);

            $this->dispatcher->forward(array(
                'controller' => "shiharai_kbns",
                'action' => 'index'
            ));

            return;
        }

        if ($shiharai_kbn->updated !== $this->request->getPost("updated")) {
            $this->flash->error("他のプロセスから支払区分が変更されたため更新を中止しました。"
                . $id . ",uid=" . $shiharai_kbn->kousin_user_id . " tb=" . $shiharai_kbn->updated ." pt=" . $this->request->getPost("updated"));

            $this->dispatcher->forward(array(
                'controller' => "shiharai_kbns",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $post_flds = [];
        $post_flds = ["cd",
            "name",
            "shiharai_bunrui_kbn_cd",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        $chg_flg = 0;
        foreach ($post_flds as $post_fld) {
            if ((array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld)) !== $shiharai_kbn->$post_fld) {
                $chg_flg = 1;
                break;
            }
        }
        if ($chg_flg === 0) {
            $this->flash->error("変更がありません。" . $id);

            $this->dispatcher->forward(array(
                "controller" => "shiharai_kbns",
                "action" => "edit",
                "params" => array($shiharai_kbn->id)
            ));

            return;
        }

        $this->_bakOut($shiharai_kbn);

        foreach ($post_flds as $post_fld) {
            $shiharai_kbn->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$shiharai_kbn->save()) {

            foreach ($shiharai_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "shiharai_kbns",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $this->flash->success("支払区分の情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "shiharai_kbns",
            'action' => 'edit',
            'params' => array($shiharai_kbn->id)
        ));
    }

    /**
     * Deletes a shiharai_kbn
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $shiharai_kbn = ShiharaiKbns::findFirstByid($id);
        if (!$shiharai_kbn) {
            $this->flash->error("支払区分が見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "shiharai_kbns",
                'action' => 'index'
            ));

            return;
        }

        $this->_bakOut($shiharai_kbn, 1);

        if (!$shiharai_kbn->delete()) {

            foreach ($shiharai_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "shiharai_kbns",
                'action' => 'search'
            ));

            return;
        }

        $this->flash->success("支払区分の削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "shiharai_kbns",
            'action' => "index"
        ));
    }

    /**
     * Back Out a shiharai_kbn
     *
     * @param string $shiharai_kbn, $dlt_flg
     */
    public function _bakOut($shiharai_kbn, $dlt_flg = 0)
    {

        $bak_shiharai_kbn = new BakShiharaiKbns();
        foreach ($shiharai_kbn as $fld => $value) {
            $bak_shiharai_kbn->$fld = $shiharai_kbn->$fld;
        }
        $bak_shiharai_kbn->id = NULL;
        $bak_shiharai_kbn->id_moto = $shiharai_kbn->id;
        $bak_shiharai_kbn->hikae_dltflg = $dlt_flg;
        $bak_shiharai_kbn->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_shiharai_kbn->hikae_nichiji = date("Y-m-d H:i:s");
        if (!$bak_shiharai_kbn->save()) {
            foreach ($bak_shiharai_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
    }

}
