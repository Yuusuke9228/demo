<?php
 


class DenpyouMrsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        ControllerBase::indexCd("DenpyouMrs", "伝票マスタ"); //簡易検索付き一覧表示
    }

    /**
     * Searches for denpyou_mrs
     */
    public function searchAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Displays the creation form
     */
    public function newAction($id=null, $dataname="DenpyouMrs")
    {
        $this->view->imax = 0;

        if ($id) {
            $nameDts = $dataname;
            $denpyou_mr = $nameDts::findFirstByid($id);
            if (!$denpyou_mr) {
                $this->flash->error("伝票マスタが見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "denpyou_mrs",
                    'action' => 'index'
                ));

                return;
            }
            $this->_setDefault($denpyou_mr, "new", $dataname);
            $this->tag->setDefault("id", null);
            $this->tag->setDefault("cd", null);
        }

    }

    /**
     * 修正画面から「次へ」ボタンを押したら次のコードの修正画面になる。
     */
    public function nextAction($id)
    {
        ControllerBase::nextCd($id, "denpyou_mrs", "DenpyouMrs", "伝票マスタ");
    }

    /**
     * 修正画面から「前へ」ボタンを押したら前のコードの修正画面になる。
     */
    public function prevAction($id)
    {
        ControllerBase::prevCd($id, "denpyou_mrs", "DenpyouMrs", "伝票マスタ");
    }

    /**
     * Edits a denpyou_mr
     *
     * @param string $id
     */
    public function editAction($id)
    {
//        if (!$this->request->isPost()) {

            $denpyou_mr = DenpyouMrs::findFirstByid($id);
            if (!$denpyou_mr) {
                $this->flash->error("伝票マスタが見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "denpyou_mrs",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->id = $denpyou_mr->id;

            $this->_setDefault($denpyou_mr, "edit");
//        }
    }

    /**
     * 画面に表示するデータをセットする
     */
    public function _setDefault($denpyou_mr, $action="edit", $meisai="DenpyouMrs")
    {
        $setdts = ["id",
            "cd",
            "name",
            "table_id",
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
            if (property_exists($denpyou_mr, $setdt)) {
                $this->tag->setDefault($setdt, $denpyou_mr->$setdt);
            }
        }
    }

    /**
     * Creates a new denpyou_mr
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "denpyou_mrs",
                'action' => 'index'
            ));

            return;
        }

        $denpyou_mr = new DenpyouMrs();

        $post_flds = [];
        $post_flds = ["cd",
            "name",
            "table_id",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        foreach ($post_flds as $post_fld) {
            $denpyou_mr->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$denpyou_mr->save()) {
            foreach ($denpyou_mr->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "denpyou_mrs",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("伝票マスタの作成が完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "denpyou_mrs",
            'action' => 'edit',
            'params' => array($denpyou_mr->id)
        ));
    }

    /**
     * Saves a denpyou_mr edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "denpyou_mrs",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $denpyou_mr = DenpyouMrs::findFirstByid($id);

        if (!$denpyou_mr) {
            $this->flash->error("伝票マスタが見つからなくなりました。" . $id);

            $this->dispatcher->forward(array(
                'controller' => "denpyou_mrs",
                'action' => 'index'
            ));

            return;
        }

        if ($denpyou_mr->updated !== $this->request->getPost("updated")) {
            $this->flash->error("他のプロセスから伝票マスタが変更されたため更新を中止しました。"
                . $id . ",uid=" . $denpyou_mr->kousin_user_id . " tb=" . $denpyou_mr->updated ." pt=" . $this->request->getPost("updated"));

            $this->dispatcher->forward(array(
                'controller' => "denpyou_mrs",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $post_flds = [];
        $post_flds = ["cd",
            "name",
            "table_id",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        $chg_flg = 0;
        foreach ($post_flds as $post_fld) {
            if ((array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld)) !== $denpyou_mr->$post_fld) {
                $chg_flg = 1;
                break;
            }
        }
        if ($chg_flg === 0) {
            $this->flash->error("変更がありません。" . $id);

            $this->dispatcher->forward(array(
                "controller" => "denpyou_mrs",
                "action" => "edit",
                "params" => array($denpyou_mr->id)
            ));

            return;
        }

        $this->_bakOut($denpyou_mr);

        foreach ($post_flds as $post_fld) {
            $denpyou_mr->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$denpyou_mr->save()) {

            foreach ($denpyou_mr->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "denpyou_mrs",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $this->flash->success("伝票マスタの情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "denpyou_mrs",
            'action' => 'edit',
            'params' => array($denpyou_mr->id)
        ));
    }

    /**
     * Deletes a denpyou_mr
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $denpyou_mr = DenpyouMrs::findFirstByid($id);
        if (!$denpyou_mr) {
            $this->flash->error("伝票マスタが見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "denpyou_mrs",
                'action' => 'index'
            ));

            return;
        }

        $this->_bakOut($denpyou_mr, 1);

        if (!$denpyou_mr->delete()) {

            foreach ($denpyou_mr->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "denpyou_mrs",
                'action' => 'search'
            ));

            return;
        }

        $this->flash->success("伝票マスタの削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "denpyou_mrs",
            'action' => "index"
        ));
    }

    /**
     * Back Out a denpyou_mr
     *
     * @param string $denpyou_mr, $dlt_flg
     */
    public function _bakOut($denpyou_mr, $dlt_flg = 0)
    {

        $bak_denpyou_mr = new BakDenpyouMrs();
        foreach ($denpyou_mr as $fld => $value) {
            $bak_denpyou_mr->$fld = $denpyou_mr->$fld;
        }
        $bak_denpyou_mr->id = NULL;
        $bak_denpyou_mr->id_moto = $denpyou_mr->id;
        $bak_denpyou_mr->hikae_dltflg = $dlt_flg;
        $bak_denpyou_mr->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_denpyou_mr->hikae_nichiji = date("Y-m-d H:i:s");
        if (!$bak_denpyou_mr->save()) {
            foreach ($bak_denpyou_mr->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
    }

}
