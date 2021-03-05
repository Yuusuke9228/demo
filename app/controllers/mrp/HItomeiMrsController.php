<?php
 


class HItomeiMrsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        ControllerBase::indexCd("HItomeiMrs", "糸名マスタ"); //簡易検索付き一覧表示
    }

    /**
     * Searches for h_itomei_mrs
     */
    public function searchAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Displays the creation form
     */
    public function newAction($id=null, $dataname="HItomeiMrs")
    {
        $this->view->imax = 0;

        if ($id) {
            $nameDts = $dataname;
            $h_itomei_mr = $nameDts::findFirstByid($id);
            if (!$h_itomei_mr) {
                $this->flash->error("糸名マスタが見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "h_itomei_mrs",
                    'action' => 'index'
                ));

                return;
            }
            $this->_setDefault($h_itomei_mr, "new", $dataname);
            $this->tag->setDefault("id", null);
            $this->tag->setDefault("cd", null);
        }

    }

    /**
     * 修正画面から「次へ」ボタンを押したら次のコードの修正画面になる。
     */
    public function nextAction($id)
    {
        ControllerBase::nextCd($id, "h_itomei_mrs", "HItomeiMrs", "糸名マスタ");
    }

    /**
     * 修正画面から「前へ」ボタンを押したら前のコードの修正画面になる。
     */
    public function prevAction($id)
    {
        ControllerBase::prevCd($id, "h_itomei_mrs", "HItomeiMrs", "糸名マスタ");
    }

    /**
     * Edits a h_itomei_mr
     *
     * @param string $id
     */
    public function editAction($id)
    {
//        if (!$this->request->isPost()) {

            $h_itomei_mr = HItomeiMrs::findFirstByid($id);
            if (!$h_itomei_mr) {
                $this->flash->error("糸名マスタが見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "h_itomei_mrs",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->id = $h_itomei_mr->id;

            $this->_setDefault($h_itomei_mr, "edit");
//        }
    }

    /**
     * 画面に表示するデータをセットする
     */
    public function _setDefault($h_itomei_mr, $action="edit", $meisai="HItomeiMrs")
    {
        $setdts = ["id",
            "cd",
            "eda",
            "ishu",
            "gumu",
            "itme",
            "ktak",
            "kden",
            "kfil",
            "biko",
            "itm2",
            "meik",
            "dtex",
            "rykg",
            "shin",
            "hana",
            "turi",
            "gaic",
            "hnyk",
            "bnam",
            "symd",
            "stnk",
            "tate",
            "tank",
            "kohi",
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
            if (property_exists($h_itomei_mr, $setdt)) {
                $this->tag->setDefault($setdt, $h_itomei_mr->$setdt);
            }
        }
    }

    /**
     * Creates a new h_itomei_mr
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "h_itomei_mrs",
                'action' => 'index'
            ));

            return;
        }

        $h_itomei_mr = new HItomeiMrs();

        $post_flds = [];
        $post_flds = ["cd",
            "eda",
            "ishu",
            "gumu",
            "itme",
            "ktak",
            "kden",
            "kfil",
            "biko",
            "itm2",
            "meik",
            "dtex",
            "rykg",
            "shin",
            "hana",
            "turi",
            "gaic",
            "hnyk",
            "bnam",
            "symd",
            "stnk",
            "tate",
            "tank",
            "kohi",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        foreach ($post_flds as $post_fld) {
            $h_itomei_mr->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$h_itomei_mr->save()) {
            foreach ($h_itomei_mr->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "h_itomei_mrs",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("糸名マスタの作成が完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "h_itomei_mrs",
            'action' => 'edit',
            'params' => array($h_itomei_mr->id)
        ));
    }

    /**
     * Saves a h_itomei_mr edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "h_itomei_mrs",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $h_itomei_mr = HItomeiMrs::findFirstByid($id);

        if (!$h_itomei_mr) {
            $this->flash->error("糸名マスタが見つからなくなりました。" . $id);

            $this->dispatcher->forward(array(
                'controller' => "h_itomei_mrs",
                'action' => 'index'
            ));

            return;
        }

        if ($h_itomei_mr->updated !== $this->request->getPost("updated")) {
            $this->flash->error("他のプロセスから糸名マスタが変更されたため更新を中止しました。"
                . $id . ",uid=" . $h_itomei_mr->kousin_user_id . " tb=" . $h_itomei_mr->updated ." pt=" . $this->request->getPost("updated"));

            $this->dispatcher->forward(array(
                'controller' => "h_itomei_mrs",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $post_flds = [];
        $post_flds = ["cd",
            "eda",
            "ishu",
            "gumu",
            "itme",
            "ktak",
            "kden",
            "kfil",
            "biko",
            "itm2",
            "meik",
            "dtex",
            "rykg",
            "shin",
            "hana",
            "turi",
            "gaic",
            "hnyk",
            "bnam",
            "symd",
            "stnk",
            "tate",
            "tank",
            "kohi",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        $chg_flg = 0;
        foreach ($post_flds as $post_fld) {
            if ((array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld)) !== $h_itomei_mr->$post_fld) {
                $chg_flg = 1;
                break;
            }
        }
        if ($chg_flg === 0) {
            $this->flash->error("変更がありません。" . $id);

            $this->dispatcher->forward(array(
                "controller" => "h_itomei_mrs",
                "action" => "edit",
                "params" => array($h_itomei_mr->id)
            ));

            return;
        }

        $this->_bakOut($h_itomei_mr);

        foreach ($post_flds as $post_fld) {
            $h_itomei_mr->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$h_itomei_mr->save()) {

            foreach ($h_itomei_mr->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "h_itomei_mrs",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $this->flash->success("糸名マスタの情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "h_itomei_mrs",
            'action' => 'edit',
            'params' => array($h_itomei_mr->id)
        ));
    }

    /**
     * Deletes a h_itomei_mr
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $h_itomei_mr = HItomeiMrs::findFirstByid($id);
        if (!$h_itomei_mr) {
            $this->flash->error("糸名マスタが見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "h_itomei_mrs",
                'action' => 'index'
            ));

            return;
        }

        $this->_bakOut($h_itomei_mr, 1);

        if (!$h_itomei_mr->delete()) {

            foreach ($h_itomei_mr->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "h_itomei_mrs",
                'action' => 'search'
            ));

            return;
        }

        $this->flash->success("糸名マスタの削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "h_itomei_mrs",
            'action' => "index"
        ));
    }

    /**
     * Back Out a h_itomei_mr
     *
     * @param string $h_itomei_mr, $dlt_flg
     */
    public function _bakOut($h_itomei_mr, $dlt_flg = 0)
    {

        $bak_h_itomei_mr = new BakHItomeiMrs();
        foreach ($h_itomei_mr as $fld => $value) {
            $bak_h_itomei_mr->$fld = $h_itomei_mr->$fld;
        }
        $bak_h_itomei_mr->id = NULL;
        $bak_h_itomei_mr->id_moto = $h_itomei_mr->id;
        $bak_h_itomei_mr->hikae_dltflg = $dlt_flg;
        $bak_h_itomei_mr->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_h_itomei_mr->hikae_nichiji = date("Y-m-d H:i:s");
        if (!$bak_h_itomei_mr->save()) {
            foreach ($bak_h_itomei_mr->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
    }

}
