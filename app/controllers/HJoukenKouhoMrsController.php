<?php
 


class HJoukenKouhoMrsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        ControllerBase::indexCd("HJoukenKouhoMrs", "条件候補マスタ"); //簡易検索付き一覧表示
    }

    /**
     * Searches for h_jouken_kouho_mrs
     */
    public function searchAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Displays the creation form
     */
    public function newAction($id=null, $dataname="HJoukenKouhoMrs")
    {
        $this->view->imax = 0;

        if ($id) {
            $nameDts = $dataname;
            $h_jouken_kouho_mr = $nameDts::findFirstByid($id);
            if (!$h_jouken_kouho_mr) {
                $this->flash->error("条件候補マスタが見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "h_jouken_kouho_mrs",
                    'action' => 'index'
                ));

                return;
            }
            $this->_setDefault($h_jouken_kouho_mr, "new", $dataname);
            $this->tag->setDefault("id", null);
            $this->tag->setDefault("cd", null);
        }

    }

    /**
     * 修正画面から「次へ」ボタンを押したら次のコードの修正画面になる。
     */
    public function nextAction($id)
    {
        ControllerBase::nextCd($id, "h_jouken_kouho_mrs", "HJoukenKouhoMrs", "条件候補マスタ");
    }

    /**
     * 修正画面から「前へ」ボタンを押したら前のコードの修正画面になる。
     */
    public function prevAction($id)
    {
        ControllerBase::prevCd($id, "h_jouken_kouho_mrs", "HJoukenKouhoMrs", "条件候補マスタ");
    }

    /**
     * Edits a h_jouken_kouho_mr
     *
     * @param string $id
     */
    public function editAction($id)
    {
//        if (!$this->request->isPost()) {

            $h_jouken_kouho_mr = HJoukenKouhoMrs::findFirstByid($id);
            if (!$h_jouken_kouho_mr) {
                $this->flash->error("条件候補マスタが見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "h_jouken_kouho_mrs",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->id = $h_jouken_kouho_mr->id;

            $this->_setDefault($h_jouken_kouho_mr, "edit");
//        }
    }

    /**
     * 画面に表示するデータをセットする
     */
    public function _setDefault($h_jouken_kouho_mr, $action="edit", $meisai="HJoukenKouhoMrs")
    {
        $setdts = ["id",
            "cd",
            "jouken",
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
            if (property_exists($h_jouken_kouho_mr, $setdt)) {
                $this->tag->setDefault($setdt, $h_jouken_kouho_mr->$setdt);
            }
        }
    }

    /**
     * Creates a new h_jouken_kouho_mr
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "h_jouken_kouho_mrs",
                'action' => 'index'
            ));

            return;
        }

        $h_jouken_kouho_mr = new HJoukenKouhoMrs();

        $post_flds = ["cd",
            "jouken",
            "name",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        foreach ($post_flds as $post_fld) {
            $h_jouken_kouho_mr->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$h_jouken_kouho_mr->save()) {
            foreach ($h_jouken_kouho_mr->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "h_jouken_kouho_mrs",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("条件候補マスタの作成が完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "h_jouken_kouho_mrs",
            'action' => 'edit',
            'params' => array($h_jouken_kouho_mr->id)
        ));
    }

    /**
     * Saves a h_jouken_kouho_mr edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "h_jouken_kouho_mrs",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $h_jouken_kouho_mr = HJoukenKouhoMrs::findFirstByid($id);

        if (!$h_jouken_kouho_mr) {
            $this->flash->error("条件候補マスタが見つからなくなりました。" . $id);

            $this->dispatcher->forward(array(
                'controller' => "h_jouken_kouho_mrs",
                'action' => 'index'
            ));

            return;
        }

        if ($h_jouken_kouho_mr->updated !== $this->request->getPost("updated")) {
            $this->flash->error("他のプロセスから条件候補マスタが変更されたため更新を中止しました。"
                . $id . ",uid=" . $h_jouken_kouho_mr->kousin_user_id . " tb=" . $h_jouken_kouho_mr->updated ." pt=" . $this->request->getPost("updated"));

            $this->dispatcher->forward(array(
                'controller' => "h_jouken_kouho_mrs",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $post_flds = ["cd",
            "jouken",
            "name",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        $chg_flg = 0;
        foreach ($post_flds as $post_fld) {
            if ((array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld)) !== $h_jouken_kouho_mr->$post_fld) {
                $chg_flg = 1;
                break;
            }
        }
        if ($chg_flg === 0) {
            $this->flash->error("変更がありません。" . $id);

            $this->dispatcher->forward(array(
                "controller" => "h_jouken_kouho_mrs",
                "action" => "edit",
                "params" => array($h_jouken_kouho_mr->id)
            ));

            return;
        }

        $this->_bakOut($h_jouken_kouho_mr, 0);

        foreach ($post_flds as $post_fld) {
            $h_jouken_kouho_mr->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$h_jouken_kouho_mr->save()) {

            foreach ($h_jouken_kouho_mr->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "h_jouken_kouho_mrs",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $this->flash->success("条件候補マスタの情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "h_jouken_kouho_mrs",
            'action' => 'edit',
            'params' => array($h_jouken_kouho_mr->id)
        ));
    }

    /**
     * Deletes a h_jouken_kouho_mr
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $h_jouken_kouho_mr = HJoukenKouhoMrs::findFirstByid($id);
        if (!$h_jouken_kouho_mr) {
            $this->flash->error("条件候補マスタが見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "h_jouken_kouho_mrs",
                'action' => 'index'
            ));

            return;
        }

        if (!$h_jouken_kouho_mr->delete()) {

            foreach ($h_jouken_kouho_mr->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "h_jouken_kouho_mrs",
                'action' => 'search'
            ));

            return;
        }

        $this->_bakOut($h_jouken_kouho_mr, 1);

        $this->flash->success("条件候補マスタの削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "h_jouken_kouho_mrs",
            'action' => "index"
        ));
    }

    /**
     * Back Out a h_jouken_kouho_mr
     *
     * @param string $h_jouken_kouho_mr, $dlt_flg
     */
    public function _bakOut($h_jouken_kouho_mr, $dlt_flg = 0)
    {

        $bak_h_jouken_kouho_mr = new BakHJoukenKouhoMrs();
        foreach ($h_jouken_kouho_mr as $fld => $value) {
            $bak_h_jouken_kouho_mr->$fld = $h_jouken_kouho_mr->$fld;
        }
        $bak_h_jouken_kouho_mr->id = NULL;
        $bak_h_jouken_kouho_mr->id_moto = $h_jouken_kouho_mr->id;
        $bak_h_jouken_kouho_mr->hikae_dltflg = $dlt_flg;
        $bak_h_jouken_kouho_mr->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_h_jouken_kouho_mr->hikae_nichiji = date("Y-m-d H:i:s");
        if (!$bak_h_jouken_kouho_mr->save()) {
            foreach ($bak_h_jouken_kouho_mr->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
    }

}
