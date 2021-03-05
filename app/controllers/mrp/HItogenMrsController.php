<?php
 


class HItogenMrsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        ControllerBase::indexCd("HItogenMrs", "糸原価マスタ"); //簡易検索付き一覧表示
    }

    /**
     * Searches for h_itogen_mrs
     */
    public function searchAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Displays the creation form
     */
    public function newAction($id=null, $dataname="HItogenMrs")
    {
        $this->view->imax = 0;

        if ($id) {
            $nameDts = $dataname;
            $h_itogen_mr = $nameDts::findFirstByid($id);
            if (!$h_itogen_mr) {
                $this->flash->error("糸原価マスタが見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "h_itogen_mrs",
                    'action' => 'index'
                ));

                return;
            }
            $this->_setDefault($h_itogen_mr, "new", $dataname);
            $this->tag->setDefault("id", null);
            $this->tag->setDefault("cd", null);
        }

    }

    /**
     * 修正画面から「次へ」ボタンを押したら次のコードの修正画面になる。
     */
    public function nextAction($id)
    {
        ControllerBase::nextCd($id, "h_itogen_mrs", "HItogenMrs", "糸原価マスタ");
    }

    /**
     * 修正画面から「前へ」ボタンを押したら前のコードの修正画面になる。
     */
    public function prevAction($id)
    {
        ControllerBase::prevCd($id, "h_itogen_mrs", "HItogenMrs", "糸原価マスタ");
    }

    /**
     * Edits a h_itogen_mr
     *
     * @param string $id
     */
    public function editAction($id)
    {
//        if (!$this->request->isPost()) {

            $h_itogen_mr = HItogenMrs::findFirstByid($id);
            if (!$h_itogen_mr) {
                $this->flash->error("糸原価マスタが見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "h_itogen_mrs",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->id = $h_itogen_mr->id;

            $this->_setDefault($h_itogen_mr, "edit");
//        }
    }

    /**
     * 画面に表示するデータをセットする
     */
    public function _setDefault($h_itogen_mr, $action="edit", $meisai="HItogenMrs")
    {
        $setdts = ["id",
            "cd",
            "gyou",
            "gcd",
            "tani",
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
            if (property_exists($h_itogen_mr, $setdt)) {
                $this->tag->setDefault($setdt, $h_itogen_mr->$setdt);
            }
        }
    }

    /**
     * Creates a new h_itogen_mr
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "h_itogen_mrs",
                'action' => 'index'
            ));

            return;
        }

        $h_itogen_mr = new HItogenMrs();

        $post_flds = [];
        $post_flds = ["cd",
            "gyou",
            "gcd",
            "tani",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        foreach ($post_flds as $post_fld) {
            $h_itogen_mr->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$h_itogen_mr->save()) {
            foreach ($h_itogen_mr->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "h_itogen_mrs",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("糸原価マスタの作成が完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "h_itogen_mrs",
            'action' => 'edit',
            'params' => array($h_itogen_mr->id)
        ));
    }

    /**
     * Saves a h_itogen_mr edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "h_itogen_mrs",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $h_itogen_mr = HItogenMrs::findFirstByid($id);

        if (!$h_itogen_mr) {
            $this->flash->error("糸原価マスタが見つからなくなりました。" . $id);

            $this->dispatcher->forward(array(
                'controller' => "h_itogen_mrs",
                'action' => 'index'
            ));

            return;
        }

        if ($h_itogen_mr->updated !== $this->request->getPost("updated")) {
            $this->flash->error("他のプロセスから糸原価マスタが変更されたため更新を中止しました。"
                . $id . ",uid=" . $h_itogen_mr->kousin_user_id . " tb=" . $h_itogen_mr->updated ." pt=" . $this->request->getPost("updated"));

            $this->dispatcher->forward(array(
                'controller' => "h_itogen_mrs",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $post_flds = [];
        $post_flds = ["cd",
            "gyou",
            "gcd",
            "tani",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        $chg_flg = 0;
        foreach ($post_flds as $post_fld) {
            if ((array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld)) !== $h_itogen_mr->$post_fld) {
                $chg_flg = 1;
                break;
            }
        }
        if ($chg_flg === 0) {
            $this->flash->error("変更がありません。" . $id);

            $this->dispatcher->forward(array(
                "controller" => "h_itogen_mrs",
                "action" => "edit",
                "params" => array($h_itogen_mr->id)
            ));

            return;
        }

        $this->_bakOut($h_itogen_mr);

        foreach ($post_flds as $post_fld) {
            $h_itogen_mr->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$h_itogen_mr->save()) {

            foreach ($h_itogen_mr->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "h_itogen_mrs",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $this->flash->success("糸原価マスタの情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "h_itogen_mrs",
            'action' => 'edit',
            'params' => array($h_itogen_mr->id)
        ));
    }

    /**
     * Deletes a h_itogen_mr
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $h_itogen_mr = HItogenMrs::findFirstByid($id);
        if (!$h_itogen_mr) {
            $this->flash->error("糸原価マスタが見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "h_itogen_mrs",
                'action' => 'index'
            ));

            return;
        }

        $this->_bakOut($h_itogen_mr, 1);

        if (!$h_itogen_mr->delete()) {

            foreach ($h_itogen_mr->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "h_itogen_mrs",
                'action' => 'search'
            ));

            return;
        }

        $this->flash->success("糸原価マスタの削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "h_itogen_mrs",
            'action' => "index"
        ));
    }

    /**
     * Back Out a h_itogen_mr
     *
     * @param string $h_itogen_mr, $dlt_flg
     */
    public function _bakOut($h_itogen_mr, $dlt_flg = 0)
    {

        $bak_h_itogen_mr = new BakHItogenMrs();
        foreach ($h_itogen_mr as $fld => $value) {
            $bak_h_itogen_mr->$fld = $h_itogen_mr->$fld;
        }
        $bak_h_itogen_mr->id = NULL;
        $bak_h_itogen_mr->id_moto = $h_itogen_mr->id;
        $bak_h_itogen_mr->hikae_dltflg = $dlt_flg;
        $bak_h_itogen_mr->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_h_itogen_mr->hikae_nichiji = date("Y-m-d H:i:s");
        if (!$bak_h_itogen_mr->save()) {
            foreach ($bak_h_itogen_mr->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
    }

}
