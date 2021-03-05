<?php
 


class ExportYyLogsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        ControllerBase::indexCd("ExportYyLogs", "移出記録"); //簡易検索付き一覧表示
    }

    /**
     * Searches for export_yy_logs
     */
    public function searchAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Displays the creation form
     */
    public function newAction($id=null, $dataname="ExportYyLogs")
    {
        $this->view->imax = 0;

        if ($id) {
            $nameDts = $dataname;
            $export_yy_log = $nameDts::findFirstByid($id);
            if (!$export_yy_log) {
                $this->flash->error("移出記録が見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "export_yy_logs",
                    'action' => 'index'
                ));

                return;
            }
            $this->_setDefault($export_yy_log, "new", $dataname);
            $this->tag->setDefault("id", null);
            $this->tag->setDefault("cd", null);
        }

    }

    /**
     * 修正画面から「次へ」ボタンを押したら次のコードの修正画面になる。
     */
    public function nextAction($id)
    {
        ControllerBase::nextCd($id, "export_yy_logs", "ExportYyLogs", "移出記録");
    }

    /**
     * 修正画面から「前へ」ボタンを押したら前のコードの修正画面になる。
     */
    public function prevAction($id)
    {
        ControllerBase::prevCd($id, "export_yy_logs", "ExportYyLogs", "移出記録");
    }

    /**
     * Edits a export_yy_log
     *
     * @param string $id
     */
    public function editAction($id)
    {
//        if (!$this->request->isPost()) {

            $export_yy_log = ExportYyLogs::findFirstByid($id);
            if (!$export_yy_log) {
                $this->flash->error("移出記録が見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "export_yy_logs",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->id = $export_yy_log->id;

            $this->_setDefault($export_yy_log, "edit");
//        }
    }

    /**
     * 画面に表示するデータをセットする
     */
    public function _setDefault($export_yy_log, $action="edit", $meisai="ExportYyLogs")
    {
        $setdts = ["id",
            "cd",
            "name",
            "time_from",
            "time_to",
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
            if (property_exists($export_yy_log, $setdt)) {
                $this->tag->setDefault($setdt, $export_yy_log->$setdt);
            }
        }
    }

    /**
     * Creates a new export_yy_log
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "export_yy_logs",
                'action' => 'index'
            ));

            return;
        }

        $export_yy_log = new ExportYyLogs();

        $post_flds = [];
        $post_flds = ["cd",
            "name",
            "time_from",
            "time_to",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        foreach ($post_flds as $post_fld) {
            $export_yy_log->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$export_yy_log->save()) {
            foreach ($export_yy_log->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "export_yy_logs",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("移出記録の作成が完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "export_yy_logs",
            'action' => 'edit',
            'params' => array($export_yy_log->id)
        ));
    }

    /**
     * Saves a export_yy_log edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "export_yy_logs",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $export_yy_log = ExportYyLogs::findFirstByid($id);

        if (!$export_yy_log) {
            $this->flash->error("移出記録が見つからなくなりました。" . $id);

            $this->dispatcher->forward(array(
                'controller' => "export_yy_logs",
                'action' => 'index'
            ));

            return;
        }

        if ($export_yy_log->updated !== $this->request->getPost("updated")) {
            $this->flash->error("他のプロセスから移出記録が変更されたため更新を中止しました。"
                . $id . ",uid=" . $export_yy_log->kousin_user_id . " tb=" . $export_yy_log->updated ." pt=" . $this->request->getPost("updated"));

            $this->dispatcher->forward(array(
                'controller' => "export_yy_logs",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $post_flds = [];
        $post_flds = ["cd",
            "name",
            "time_from",
            "time_to",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        $chg_flg = 0;
        foreach ($post_flds as $post_fld) {
            if ((array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld)) !== $export_yy_log->$post_fld) {
                $chg_flg = 1;
                break;
            }
        }
        if ($chg_flg === 0) {
            $this->flash->error("変更がありません。" . $id);

            $this->dispatcher->forward(array(
                "controller" => "export_yy_logs",
                "action" => "edit",
                "params" => array($export_yy_log->id)
            ));

            return;
        }

        $this->_bakOut($export_yy_log);

        foreach ($post_flds as $post_fld) {
            $export_yy_log->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$export_yy_log->save()) {

            foreach ($export_yy_log->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "export_yy_logs",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $this->flash->success("移出記録の情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "export_yy_logs",
            'action' => 'edit',
            'params' => array($export_yy_log->id)
        ));
    }

    /**
     * Deletes a export_yy_log
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $export_yy_log = ExportYyLogs::findFirstByid($id);
        if (!$export_yy_log) {
            $this->flash->error("移出記録が見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "export_yy_logs",
                'action' => 'index'
            ));

            return;
        }

        $this->_bakOut($export_yy_log, 1);

        if (!$export_yy_log->delete()) {

            foreach ($export_yy_log->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "export_yy_logs",
                'action' => 'search'
            ));

            return;
        }

        $this->flash->success("移出記録の削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "export_yy_logs",
            'action' => "index"
        ));
    }

    /**
     * Back Out a export_yy_log
     *
     * @param string $export_yy_log, $dlt_flg
     */
    public function _bakOut($export_yy_log, $dlt_flg = 0)
    {

        $bak_export_yy_log = new BakExportYyLogs();
        foreach ($export_yy_log as $fld => $value) {
            $bak_export_yy_log->$fld = $export_yy_log->$fld;
        }
        $bak_export_yy_log->id = NULL;
        $bak_export_yy_log->id_moto = $export_yy_log->id;
        $bak_export_yy_log->hikae_dltflg = $dlt_flg;
        $bak_export_yy_log->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_export_yy_log->hikae_nichiji = date("Y-m-d H:i:s");
        if (!$bak_export_yy_log->save()) {
            foreach ($bak_export_yy_log->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
    }

}
