<?php
 


class MaxJuchuuIdVwsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        ControllerBase::indexCd("MaxJuchuuIdVws", "VIEW"); //簡易検索付き一覧表示
    }

    /**
     * Searches for max_juchuu_id_vws
     */
    public function searchAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Displays the creation form
     */
    public function newAction($id=null, $dataname="MaxJuchuuIdVws")
    {
        $this->view->imax = 0;

        if ($id) {
            $nameDts = $dataname;
            $max_juchuu_id_vw = $nameDts::findFirstByid($id);
            if (!$max_juchuu_id_vw) {
                $this->flash->error("VIEWが見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "max_juchuu_id_vws",
                    'action' => 'index'
                ));

                return;
            }
            $this->_setDefault($max_juchuu_id_vw, "new", $dataname);
            $this->tag->setDefault("max_id", null);
            $this->tag->setDefault("cd", null);
        }

    }

    /**
     * 修正画面から「次へ」ボタンを押したら次のコードの修正画面になる。
     */
    public function nextAction($id)
    {
        ControllerBase::nextCd($id, "max_juchuu_id_vws", "MaxJuchuuIdVws", "VIEW");
    }

    /**
     * 修正画面から「前へ」ボタンを押したら前のコードの修正画面になる。
     */
    public function prevAction($id)
    {
        ControllerBase::prevCd($id, "max_juchuu_id_vws", "MaxJuchuuIdVws", "VIEW");
    }

    /**
     * Edits a max_juchuu_id_vw
     *
     * @param string $max_id
     */
    public function editAction($max_id)
    {
//        if (!$this->request->isPost()) {

            $max_juchuu_id_vw = MaxJuchuuIdVws::findFirstBymax_id($max_id);
            if (!$max_juchuu_id_vw) {
                $this->flash->error("VIEWが見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "max_juchuu_id_vws",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->max_id = $max_juchuu_id_vw->max_id;

            $this->_setDefault($max_juchuu_id_vw, "edit");
//        }
    }

    /**
     * 画面に表示するデータをセットする
     */
    public function _setDefault($max_juchuu_id_vw, $action="edit", $meisai="MaxJuchuuIdVws")
    {
        $setdts = ["max_id",
            "sub_cd",
            ];
            
        foreach ($setdts as $setdt) {
            if (property_exists($max_juchuu_id_vw, $setdt)) {
                $this->tag->setDefault($setdt, $max_juchuu_id_vw->$setdt);
            }
        }
    }

    /**
     * Creates a new max_juchuu_id_vw
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "max_juchuu_id_vws",
                'action' => 'index'
            ));

            return;
        }

        $max_juchuu_id_vw = new MaxJuchuuIdVws();

        $post_flds = [];
        $post_flds = ["max_id",
            "sub_cd",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        foreach ($post_flds as $post_fld) {
            $max_juchuu_id_vw->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$max_juchuu_id_vw->save()) {
            foreach ($max_juchuu_id_vw->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "max_juchuu_id_vws",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("VIEWの作成が完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "max_juchuu_id_vws",
            'action' => 'edit',
            'params' => array($max_juchuu_id_vw->max_id)
        ));
    }

    /**
     * Saves a max_juchuu_id_vw edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "max_juchuu_id_vws",
                'action' => 'index'
            ));

            return;
        }

        $max_id = $this->request->getPost("max_id");
        $max_juchuu_id_vw = MaxJuchuuIdVws::findFirstBymax_id($max_id);

        if (!$max_juchuu_id_vw) {
            $this->flash->error("VIEWが見つからなくなりました。" . $max_id);

            $this->dispatcher->forward(array(
                'controller' => "max_juchuu_id_vws",
                'action' => 'index'
            ));

            return;
        }

        if ($max_juchuu_id_vw->updated !== $this->request->getPost("updated")) {
            $this->flash->error("他のプロセスからVIEWが変更されたため更新を中止しました。"
                . $max_id . ",uid=" . $max_juchuu_id_vw->kousin_user_id . " tb=" . $max_juchuu_id_vw->updated ." pt=" . $this->request->getPost("updated"));

            $this->dispatcher->forward(array(
                'controller' => "max_juchuu_id_vws",
                'action' => 'edit',
                'params' => array($max_id)
            ));

            return;
        }

        $post_flds = [];
        $post_flds = ["max_id",
            "sub_cd",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        $chg_flg = 0;
        foreach ($post_flds as $post_fld) {
            if ((array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld)) !== $max_juchuu_id_vw->$post_fld) {
                $chg_flg = 1;
                break;
            }
        }
        if ($chg_flg === 0) {
            $this->flash->error("変更がありません。" . $max_id);

            $this->dispatcher->forward(array(
                "controller" => "max_juchuu_id_vws",
                "action" => "edit",
                "params" => array($max_juchuu_id_vw->max_id)
            ));

            return;
        }

        $this->_bakOut($max_juchuu_id_vw);

        foreach ($post_flds as $post_fld) {
            $max_juchuu_id_vw->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$max_juchuu_id_vw->save()) {

            foreach ($max_juchuu_id_vw->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "max_juchuu_id_vws",
                'action' => 'edit',
                'params' => array($max_id)
            ));

            return;
        }

        $this->flash->success("VIEWの情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "max_juchuu_id_vws",
            'action' => 'edit',
            'params' => array($max_juchuu_id_vw->max_id)
        ));
    }

    /**
     * Deletes a max_juchuu_id_vw
     *
     * @param string $max_id
     */
    public function deleteAction($max_id)
    {
        $max_juchuu_id_vw = MaxJuchuuIdVws::findFirstBymax_id($max_id);
        if (!$max_juchuu_id_vw) {
            $this->flash->error("VIEWが見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "max_juchuu_id_vws",
                'action' => 'index'
            ));

            return;
        }

        $this->_bakOut($max_juchuu_id_vw, 1);

        if (!$max_juchuu_id_vw->delete()) {

            foreach ($max_juchuu_id_vw->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "max_juchuu_id_vws",
                'action' => 'search'
            ));

            return;
        }

        $this->flash->success("VIEWの削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "max_juchuu_id_vws",
            'action' => "index"
        ));
    }

    /**
     * Back Out a max_juchuu_id_vw
     *
     * @param string $max_juchuu_id_vw, $dlt_flg
     */
    public function _bakOut($max_juchuu_id_vw, $dlt_flg = 0)
    {

        $bak_max_juchuu_id_vw = new BakMaxJuchuuIdVws();
        foreach ($max_juchuu_id_vw as $fld => $value) {
            $bak_max_juchuu_id_vw->$fld = $max_juchuu_id_vw->$fld;
        }
        $bak_max_juchuu_id_vw->max_id = NULL;
        $bak_max_juchuu_id_vw->moto_max_id = $max_juchuu_id_vw->max_id;
        $bak_max_juchuu_id_vw->hikae_dltflg = $dlt_flg;
        $bak_max_juchuu_id_vw->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_max_juchuu_id_vw->hikae_nitiji = date("Y-m-d H:i:s");
        if (!$bak_max_juchuu_id_vw->save()) {
            foreach ($bak_max_juchuu_id_vw->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
    }

}
