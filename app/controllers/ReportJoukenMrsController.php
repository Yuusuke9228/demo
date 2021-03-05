<?php
 


class ReportJoukenMrsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        ControllerBase::indexCd("ReportJoukenMrs", "レポート条件見出し"); //簡易検索付き一覧表示
    }

    /**
     * Searches for report_jouken_mrs
     */
    public function searchAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Displays the creation form
     */
    public function newAction($id=null, $dataname="ReportJoukenMrs")
    {
        $this->view->imax = 0;

        if ($id) {
            $nameDts = $dataname;
            $report_jouken_mr = $nameDts::findFirstByid($id);
            if (!$report_jouken_mr) {
                $this->flash->error("レポート条件見出しが見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "report_jouken_mrs",
                    'action' => 'index'
                ));

                return;
            }
            $this->_setDefault($report_jouken_mr, "new", $dataname);
            $this->tag->setDefault("id", null);
            $this->tag->setDefault("cd", null);
        }

    }

    /**
     * 修正画面から「次へ」ボタンを押したら次のコードの修正画面になる。
     */
    public function nextAction($id)
    {
        ControllerBase::nextCd($id, "report_jouken_mrs", "ReportJoukenMrs", "レポート条件見出し");
    }

    /**
     * 修正画面から「前へ」ボタンを押したら前のコードの修正画面になる。
     */
    public function prevAction($id)
    {
        ControllerBase::prevCd($id, "report_jouken_mrs", "ReportJoukenMrs", "レポート条件見出し");
    }

    /**
     * Edits a report_jouken_mr
     *
     * @param string $id
     */
    public function editAction($id)
    {
//        if (!$this->request->isPost()) {

            $report_jouken_mr = ReportJoukenMrs::findFirstByid($id);
            if (!$report_jouken_mr) {
                $this->flash->error("レポート条件見出しが見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "report_jouken_mrs",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->id = $report_jouken_mr->id;

            $this->_setDefault($report_jouken_mr, "edit");
//        }
    }

    /**
     * 画面に表示するデータをセットする
     */
    public function _setDefault($report_jouken_mr, $action="edit", $meisai="ReportJoukenMrs")
    {
        $setdts = ["id",
            "cd",
            "name",
            "table_mr_cd",
            "koukai_kbn",
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
            if (property_exists($report_jouken_mr, $setdt)) {
                $this->tag->setDefault($setdt, $report_jouken_mr->$setdt);
            }
        }
    }

    /**
     * Creates a new report_jouken_mr
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "report_jouken_mrs",
                'action' => 'index'
            ));

            return;
        }

        $report_jouken_mr = new ReportJoukenMrs();

        $post_flds = [];
        $post_flds = ["cd",
            "name",
            "table_mr_cd",
            "koukai_kbn",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        foreach ($post_flds as $post_fld) {
            $report_jouken_mr->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$report_jouken_mr->save()) {
            foreach ($report_jouken_mr->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "report_jouken_mrs",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("レポート条件見出しの作成が完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "report_jouken_mrs",
            'action' => 'edit',
            'params' => array($report_jouken_mr->id)
        ));
    }

    /**
     * Saves a report_jouken_mr edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "report_jouken_mrs",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $report_jouken_mr = ReportJoukenMrs::findFirstByid($id);

        if (!$report_jouken_mr) {
            $this->flash->error("レポート条件見出しが見つからなくなりました。" . $id);

            $this->dispatcher->forward(array(
                'controller' => "report_jouken_mrs",
                'action' => 'index'
            ));

            return;
        }

        if ($report_jouken_mr->updated !== $this->request->getPost("updated")) {
            $this->flash->error("他のプロセスからレポート条件見出しが変更されたため更新を中止しました。"
                . $id . ",uid=" . $report_jouken_mr->kousin_user_id . " tb=" . $report_jouken_mr->updated ." pt=" . $this->request->getPost("updated"));

            $this->dispatcher->forward(array(
                'controller' => "report_jouken_mrs",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $post_flds = [];
        $post_flds = ["cd",
            "name",
            "table_mr_cd",
            "koukai_kbn",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        $chg_flg = 0;
        foreach ($post_flds as $post_fld) {
            if ((array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld)) !== $report_jouken_mr->$post_fld) {
                $chg_flg = 1;
                break;
            }
        }
        if ($chg_flg === 0) {
            $this->flash->error("変更がありません。" . $id);

            $this->dispatcher->forward(array(
                "controller" => "report_jouken_mrs",
                "action" => "edit",
                "params" => array($report_jouken_mr->id)
            ));

            return;
        }

        $this->_bakOut($report_jouken_mr);

        foreach ($post_flds as $post_fld) {
            $report_jouken_mr->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$report_jouken_mr->save()) {

            foreach ($report_jouken_mr->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "report_jouken_mrs",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $this->flash->success("レポート条件見出しの情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "report_jouken_mrs",
            'action' => 'edit',
            'params' => array($report_jouken_mr->id)
        ));
    }

    /**
     * Deletes a report_jouken_mr
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $report_jouken_mr = ReportJoukenMrs::findFirstByid($id);
        if (!$report_jouken_mr) {
            $this->flash->error("レポート条件見出しが見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "report_jouken_mrs",
                'action' => 'index'
            ));

            return;
        }

        $this->_bakOut($report_jouken_mr, 1);

        if (!$report_jouken_mr->delete()) {

            foreach ($report_jouken_mr->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "report_jouken_mrs",
                'action' => 'search'
            ));

            return;
        }

        $this->flash->success("レポート条件見出しの削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "report_jouken_mrs",
            'action' => "index"
        ));
    }

    /**
     * Back Out a report_jouken_mr
     *
     * @param string $report_jouken_mr, $dlt_flg
     */
    public function _bakOut($report_jouken_mr, $dlt_flg = 0)
    {

        $bak_report_jouken_mr = new BakReportJoukenMrs();
        foreach ($report_jouken_mr as $fld => $value) {
            $bak_report_jouken_mr->$fld = $report_jouken_mr->$fld;
        }
        $bak_report_jouken_mr->id = NULL;
        $bak_report_jouken_mr->id_moto = $report_jouken_mr->id;
        $bak_report_jouken_mr->hikae_dltflg = $dlt_flg;
        $bak_report_jouken_mr->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_report_jouken_mr->hikae_nichiji = date("Y-m-d H:i:s");
        if (!$bak_report_jouken_mr->save()) {
            foreach ($bak_report_jouken_mr->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
    }

}
