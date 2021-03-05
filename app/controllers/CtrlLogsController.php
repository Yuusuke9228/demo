<?php
 


class CtrlLogsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        ControllerBase::indexCd("CtrlLogs", "コントローラーログ", "id DESC"); //簡易検索付き一覧表示
    }

    /**
     * Searches for ctrl_logs
     */
    public function searchAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Displays the creation form
     */
    public function newAction($id=null, $dataname="CtrlLogs")
    {
        $this->view->imax = 0;

        if ($id) {
            $nameDts = $dataname;
            $ctrl_log = $nameDts::findFirstByid($id);
            if (!$ctrl_log) {
                $this->flash->error("コントローラーログが見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "ctrl_logs",
                    'action' => 'index'
                ));

                return;
            }
            $this->_setDefault($ctrl_log, "new", $dataname);
            $this->tag->setDefault("id", null);
            $this->tag->setDefault("cd", null);
        }

    }

    /**
     * 修正画面から「次へ」ボタンを押したら次のコードの修正画面になる。
     */
    public function nextAction($id)
    {
        ControllerBase::nextCd($id, "ctrl_logs", "CtrlLogs", "コントローラーログ");
    }

    /**
     * 修正画面から「前へ」ボタンを押したら前のコードの修正画面になる。
     */
    public function prevAction($id)
    {
        ControllerBase::prevCd($id, "ctrl_logs", "CtrlLogs", "コントローラーログ");
    }

    /**
     * Edits a ctrl_log
     *
     * @param string $id
     */
    public function editAction($id)
    {
//        if (!$this->request->isPost()) {

            $ctrl_log = CtrlLogs::findFirstByid($id);
            if (!$ctrl_log) {
                $this->flash->error("コントローラーログが見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "ctrl_logs",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->id = $ctrl_log->id;

            $this->_setDefault($ctrl_log, "edit");
//        }
    }

    /**
     * 画面に表示するデータをセットする
     */
    public function _setDefault($ctrl_log, $action="edit", $meisai="CtrlLogs")
    {
        $setdts = ["id",
            "cd",
            "name",
            "ctrlr",
            "actn",
            "prms",
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
            if (property_exists($ctrl_log, $setdt)) {
                $this->tag->setDefault($setdt, $ctrl_log->$setdt);
            }
        }
    }

    /**
     * Creates a new ctrl_log
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "ctrl_logs",
                'action' => 'index'
            ));

            return;
        }

        $ctrl_log = new CtrlLogs();

        $post_flds = [];
        $post_flds = ["cd",
            "name",
            "ctrlr",
            "actn",
            "prms",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        foreach ($post_flds as $post_fld) {
            $ctrl_log->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$ctrl_log->save()) {
            foreach ($ctrl_log->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "ctrl_logs",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("コントローラーログの作成が完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "ctrl_logs",
            'action' => 'edit',
            'params' => array($ctrl_log->id)
        ));
    }

    /**
     * Saves a ctrl_log edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "ctrl_logs",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $ctrl_log = CtrlLogs::findFirstByid($id);

        if (!$ctrl_log) {
            $this->flash->error("コントローラーログが見つからなくなりました。" . $id);

            $this->dispatcher->forward(array(
                'controller' => "ctrl_logs",
                'action' => 'index'
            ));

            return;
        }

        if ($ctrl_log->updated !== $this->request->getPost("updated")) {
            $this->flash->error("他のプロセスからコントローラーログが変更されたため更新を中止しました。"
                . $id . ",uid=" . $ctrl_log->kousin_user_id . " tb=" . $ctrl_log->updated ." pt=" . $this->request->getPost("updated"));

            $this->dispatcher->forward(array(
                'controller' => "ctrl_logs",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $post_flds = [];
        $post_flds = ["cd",
            "name",
            "ctrlr",
            "actn",
            "prms",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        $chg_flg = 0;
        foreach ($post_flds as $post_fld) {
            if ((array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld)) !== $ctrl_log->$post_fld) {
                $chg_flg = 1;
                break;
            }
        }
        if ($chg_flg === 0) {
            $this->flash->error("変更がありません。" . $id);

            $this->dispatcher->forward(array(
                "controller" => "ctrl_logs",
                "action" => "edit",
                "params" => array($ctrl_log->id)
            ));

            return;
        }

        $this->_bakOut($ctrl_log);

        foreach ($post_flds as $post_fld) {
            $ctrl_log->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$ctrl_log->save()) {

            foreach ($ctrl_log->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "ctrl_logs",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $this->flash->success("コントローラーログの情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "ctrl_logs",
            'action' => 'edit',
            'params' => array($ctrl_log->id)
        ));
    }

    /**
     * Deletes a ctrl_log
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $ctrl_log = CtrlLogs::findFirstByid($id);
        if (!$ctrl_log) {
            $this->flash->error("コントローラーログが見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "ctrl_logs",
                'action' => 'index'
            ));

            return;
        }

        $this->_bakOut($ctrl_log, 1);

        if (!$ctrl_log->delete()) {

            foreach ($ctrl_log->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "ctrl_logs",
                'action' => 'search'
            ));

            return;
        }

        $this->flash->success("コントローラーログの削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "ctrl_logs",
            'action' => "index"
        ));
    }

    /**
     * Back Out a ctrl_log
     *
     * @param string $ctrl_log, $dlt_flg
     */
    public function _bakOut($ctrl_log, $dlt_flg = 0)
    {

        $bak_ctrl_log = new BakCtrlLogs();
        foreach ($ctrl_log as $fld => $value) {
            $bak_ctrl_log->$fld = $ctrl_log->$fld;
        }
        $bak_ctrl_log->id = NULL;
        $bak_ctrl_log->id_moto = $ctrl_log->id;
        $bak_ctrl_log->hikae_dltflg = $dlt_flg;
        $bak_ctrl_log->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_ctrl_log->hikae_nichiji = date("Y-m-d H:i:s");
        if (!$bak_ctrl_log->save()) {
            foreach ($bak_ctrl_log->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
    }

}
