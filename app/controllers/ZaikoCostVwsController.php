<?php
 


class ZaikoCostVwsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        ControllerBase::indexCd("ZaikoCostVws", "VIEW"); //簡易検索付き一覧表示
    }

    /**
     * Searches for zaiko_cost_vws
     */
    public function searchAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Displays the creation form
     */
    public function newAction($id=null, $dataname="ZaikoCostVws")
    {
        $this->view->imax = 0;

        if ($id) {
            $nameDts = $dataname;
            $zaiko_cost_vw = $nameDts::findFirstByid($id);
            if (!$zaiko_cost_vw) {
                $this->flash->error("VIEWが見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "zaiko_cost_vws",
                    'action' => 'index'
                ));

                return;
            }
            $this->_setDefault($zaiko_cost_vw, "new", $dataname);
            $this->tag->setDefault("shouhin_mr_cd", null);
            $this->tag->setDefault("cd", null);
        }

    }

    /**
     * 修正画面から「次へ」ボタンを押したら次のコードの修正画面になる。
     */
    public function nextAction($id)
    {
        ControllerBase::nextCd($id, "zaiko_cost_vws", "ZaikoCostVws", "VIEW");
    }

    /**
     * 修正画面から「前へ」ボタンを押したら前のコードの修正画面になる。
     */
    public function prevAction($id)
    {
        ControllerBase::prevCd($id, "zaiko_cost_vws", "ZaikoCostVws", "VIEW");
    }

    /**
     * Edits a zaiko_cost_vw
     *
     * @param string $shouhin_mr_cd
     */
    public function editAction($shouhin_mr_cd)
    {
//        if (!$this->request->isPost()) {

            $zaiko_cost_vw = ZaikoCostVws::findFirstByshouhin_mr_cd($shouhin_mr_cd);
            if (!$zaiko_cost_vw) {
                $this->flash->error("VIEWが見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "zaiko_cost_vws",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->shouhin_mr_cd = $zaiko_cost_vw->shouhin_mr_cd;

            $this->_setDefault($zaiko_cost_vw, "edit");
//        }
    }

    /**
     * 画面に表示するデータをセットする
     */
    public function _setDefault($zaiko_cost_vw, $action="edit", $meisai="ZaikoCostVws")
    {
        $setdts = ["shouhin_mr_cd",
            "cost",
            ];
            
        foreach ($setdts as $setdt) {
            if (property_exists($zaiko_cost_vw, $setdt)) {
                $this->tag->setDefault($setdt, $zaiko_cost_vw->$setdt);
            }
        }
    }

    /**
     * Creates a new zaiko_cost_vw
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "zaiko_cost_vws",
                'action' => 'index'
            ));

            return;
        }

        $zaiko_cost_vw = new ZaikoCostVws();

        $post_flds = [];
        $post_flds = ["shouhin_mr_cd",
            "cost",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        foreach ($post_flds as $post_fld) {
            $zaiko_cost_vw->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$zaiko_cost_vw->save()) {
            foreach ($zaiko_cost_vw->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "zaiko_cost_vws",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("VIEWの作成が完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "zaiko_cost_vws",
            'action' => 'edit',
            'params' => array($zaiko_cost_vw->shouhin_mr_cd)
        ));
    }

    /**
     * Saves a zaiko_cost_vw edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "zaiko_cost_vws",
                'action' => 'index'
            ));

            return;
        }

        $shouhin_mr_cd = $this->request->getPost("shouhin_mr_cd");
        $zaiko_cost_vw = ZaikoCostVws::findFirstByshouhin_mr_cd($shouhin_mr_cd);

        if (!$zaiko_cost_vw) {
            $this->flash->error("VIEWが見つからなくなりました。" . $shouhin_mr_cd);

            $this->dispatcher->forward(array(
                'controller' => "zaiko_cost_vws",
                'action' => 'index'
            ));

            return;
        }

        if ($zaiko_cost_vw->updated !== $this->request->getPost("updated")) {
            $this->flash->error("他のプロセスからVIEWが変更されたため更新を中止しました。"
                . $shouhin_mr_cd . ",uid=" . $zaiko_cost_vw->kousin_user_id . " tb=" . $zaiko_cost_vw->updated ." pt=" . $this->request->getPost("updated"));

            $this->dispatcher->forward(array(
                'controller' => "zaiko_cost_vws",
                'action' => 'edit',
                'params' => array($shouhin_mr_cd)
            ));

            return;
        }

        $post_flds = [];
        $post_flds = ["shouhin_mr_cd",
            "cost",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        $chg_flg = 0;
        foreach ($post_flds as $post_fld) {
            if ((array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld)) !== $zaiko_cost_vw->$post_fld) {
                $chg_flg = 1;
                break;
            }
        }
        if ($chg_flg === 0) {
            $this->flash->error("変更がありません。" . $shouhin_mr_cd);

            $this->dispatcher->forward(array(
                "controller" => "zaiko_cost_vws",
                "action" => "edit",
                "params" => array($zaiko_cost_vw->shouhin_mr_cd)
            ));

            return;
        }

        $this->_bakOut($zaiko_cost_vw);

        foreach ($post_flds as $post_fld) {
            $zaiko_cost_vw->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$zaiko_cost_vw->save()) {

            foreach ($zaiko_cost_vw->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "zaiko_cost_vws",
                'action' => 'edit',
                'params' => array($shouhin_mr_cd)
            ));

            return;
        }

        $this->flash->success("VIEWの情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "zaiko_cost_vws",
            'action' => 'edit',
            'params' => array($zaiko_cost_vw->shouhin_mr_cd)
        ));
    }

    /**
     * Deletes a zaiko_cost_vw
     *
     * @param string $shouhin_mr_cd
     */
    public function deleteAction($shouhin_mr_cd)
    {
        $zaiko_cost_vw = ZaikoCostVws::findFirstByshouhin_mr_cd($shouhin_mr_cd);
        if (!$zaiko_cost_vw) {
            $this->flash->error("VIEWが見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "zaiko_cost_vws",
                'action' => 'index'
            ));

            return;
        }

        $this->_bakOut($zaiko_cost_vw, 1);

        if (!$zaiko_cost_vw->delete()) {

            foreach ($zaiko_cost_vw->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "zaiko_cost_vws",
                'action' => 'search'
            ));

            return;
        }

        $this->flash->success("VIEWの削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "zaiko_cost_vws",
            'action' => "index"
        ));
    }

    /**
     * Back Out a zaiko_cost_vw
     *
     * @param string $zaiko_cost_vw, $dlt_flg
     */
    public function _bakOut($zaiko_cost_vw, $dlt_flg = 0)
    {

        $bak_zaiko_cost_vw = new BakZaikoCostVws();
        foreach ($zaiko_cost_vw as $fld => $value) {
            $bak_zaiko_cost_vw->$fld = $zaiko_cost_vw->$fld;
        }
        $bak_zaiko_cost_vw->shouhin_mr_cd = NULL;
        $bak_zaiko_cost_vw->moto_shouhin_mr_cd = $zaiko_cost_vw->shouhin_mr_cd;
        $bak_zaiko_cost_vw->hikae_dltflg = $dlt_flg;
        $bak_zaiko_cost_vw->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_zaiko_cost_vw->hikae_nitiji = date("Y-m-d H:i:s");
        if (!$bak_zaiko_cost_vw->save()) {
            foreach ($bak_zaiko_cost_vw->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
    }

}
