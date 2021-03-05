<?php


class BumonMrsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        ControllerBase::indexCd("BumonMrs", "部門マスタ"); //簡易検索付き一覧表示
    }

    /**
     * Searches for bumon_mrs
     */
    public function searchAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Displays the creation form
     */
    public function newAction($id = null, $dataname = "BumonMrs")
    {
        $this->view->imax = 0;

        if ($id) {
            $nameDts = $dataname;
            $bumon_mr = $nameDts::findFirstByid($id);
            if (!$bumon_mr) {
                $this->flash->error("部門マスタが見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "bumon_mrs",
                    'action' => 'index'
                ));

                return;
            }
            $this->_setDefault($bumon_mr, "new", $dataname);
            $this->tag->setDefault("id", null);
            $this->tag->setDefault("cd", null);
        }

    }

    /**
     * 修正画面から「次へ」ボタンを押したら次のコードの修正画面になる。
     */
    public function nextAction($id)
    {
        ControllerBase::nextCd($id, "bumon_mrs", "BumonMrs", "部門マスタ");
    }

    /**
     * 修正画面から「前へ」ボタンを押したら前のコードの修正画面になる。
     */
    public function prevAction($id)
    {
        ControllerBase::prevCd($id, "bumon_mrs", "BumonMrs", "部門マスタ");
    }

    /**
     * Edits a bumon_mr
     *
     * @param string $id
     */
    public function editAction($id, $error = null)
    {
//        if (!$this->request->isPost()) {

        if ($error == 'error') {
            $this->view->id = $id;
            return;
        }

        $bumon_mr = BumonMrs::findFirstByid($id);
        if (!$bumon_mr) {
            $this->flash->error("部門マスタが見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "bumon_mrs",
                'action' => 'index'
            ));

            return;
        }

        $this->view->id = $bumon_mr->id;

        $this->_setDefault($bumon_mr, "edit");
//        }
    }

    /**
     * 画面に表示するデータをセットする
     */
    public function _setDefault($bumon_mr, $action = "edit", $meisai = "BumonMrs")
    {
        $setdts = ["id",
            "cd",
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
            if (property_exists($bumon_mr, $setdt)) {
                $this->tag->setDefault($setdt, $bumon_mr->$setdt);
            }
        }
    }

    /**
     * Creates a new bumon_mr
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "bumon_mrs",
                'action' => 'index'
            ));

            return;
        }
        /*
        $this->flash->error('失敗のテスト');
        $this->tag->setDefault('name', 'なまえ');
        $this->dispatcher->forward(array(
            'controller' => "bumon_mrs",
            'action' => 'new'
        ));

        return;
        */

        $bumon_mr = new BumonMrs();

        $post_flds = [];
        $post_flds = ["cd",
            "name",
            "updated",
        ];


        $thisPost = []; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        foreach ($post_flds as $post_fld) {
            $bumon_mr->$post_fld = array_key_exists($post_fld, $thisPost) ? $thisPost[$post_fld] : $this->request->getPost($post_fld);
        }

        if (!$bumon_mr->save()) {
            foreach ($bumon_mr->getMessages() as $message) {
                $this->flash->error($message);
            }
            $this->dispatcher->forward(array(
                'controller' => "bumon_mrs",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("部門マスタの作成が完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "bumon_mrs",
            'action' => 'edit',
            'params' => array($bumon_mr->id)
        ));
    }

    /**
     * Saves a bumon_mr edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "bumon_mrs",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $bumon_mr = BumonMrs::findFirstByid($id);

        if (!$bumon_mr) {
            $this->flash->error("部門マスタが見つからなくなりました。" . $id);

            $this->dispatcher->forward(array(
                'controller' => "bumon_mrs",
                'action' => 'index'
            ));

            return;
        }

        if ($bumon_mr->updated !== $this->request->getPost("updated")) {
            $this->flash->error("他のプロセスから部門マスタが変更されたため更新を中止しました。"
                . $id . ",uid=" . $bumon_mr->kousin_user_id . " tb=" . $bumon_mr->updated . " pt=" . $this->request->getPost("updated"));

            $this->dispatcher->forward(array(
                'controller' => "bumon_mrs",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $post_flds = [];
        $post_flds = ["cd",
            "name",
            "updated",
        ];


        $thisPost = []; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        $chg_flg = 0;
        foreach ($post_flds as $post_fld) {
            if ((array_key_exists($post_fld, $thisPost) ? $thisPost[$post_fld] : $this->request->getPost($post_fld)) !== $bumon_mr->$post_fld) {
                $chg_flg = 1;
                break;
            }
        }
        if ($chg_flg === 0) {
            $this->flash->error("変更がありません。" . $id);

            $this->dispatcher->forward(array(
                "controller" => "bumon_mrs",
                "action" => "edit",
                "params" => array($bumon_mr->id)
            ));

            return;
        }

        $this->_bakOut($bumon_mr);

        foreach ($post_flds as $post_fld) {
            $bumon_mr->$post_fld = array_key_exists($post_fld, $thisPost) ? $thisPost[$post_fld] : $this->request->getPost($post_fld);
        }

        if (!$bumon_mr->save()) {

            foreach ($bumon_mr->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "bumon_mrs",
                'action' => 'edit',
                'params' => array($id, 'error')
            ));

            return;
        }

        $this->flash->success("部門マスタの情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "bumon_mrs",
            'action' => 'edit',
            'params' => array($bumon_mr->id)
        ));
    }

    /**
     * Deletes a bumon_mr
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $bumon_mr = BumonMrs::findFirstByid($id);
        if (!$bumon_mr) {
            $this->flash->error("部門マスタが見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "bumon_mrs",
                'action' => 'index'
            ));

            return;
        }

        $this->_bakOut($bumon_mr, 1);

        if (!$bumon_mr->delete()) {

            foreach ($bumon_mr->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "bumon_mrs",
                'action' => 'search'
            ));

            return;
        }

        $this->flash->success("部門マスタの削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "bumon_mrs",
            'action' => "index"
        ));
    }

    /**
     * Back Out a bumon_mr
     *
     * @param string $bumon_mr , $dlt_flg
     */
    public function _bakOut($bumon_mr, $dlt_flg = 0)
    {

        $bak_bumon_mr = new BakBumonMrs();
        foreach ($bumon_mr as $fld => $value) {
            $bak_bumon_mr->$fld = $bumon_mr->$fld;
        }
        $bak_bumon_mr->id = NULL;
        $bak_bumon_mr->id_moto = $bumon_mr->id;
        $bak_bumon_mr->hikae_dltflg = $dlt_flg;
        $bak_bumon_mr->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_bumon_mr->hikae_nichiji = date("Y-m-d H:i:s");
        if (!$bak_bumon_mr->save()) {
            foreach ($bak_bumon_mr->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
    }

    public function ajaxSaveAction()
    {
        $this->view->disable();

        //Create a response instance
        $response = new \Phalcon\Http\Response();

        if (!$this->request->isAjax()) {
            echo "is not Ajax ! ";
            //    return;
        }
        if (!$this->request->isPost()) {
            echo "is not Post ! ";
            //    return;
        }

        $id = $this->request->getPost("id");
        $bumon_mr = BumonMrs::findFirstByid($id);

        if (!$bumon_mr) {
            $bumon_mr = new BumonMrs();
        } else {
            if ($bumon_mr->updated !== $this->request->getPost("updated")) {
                return;
            }
        }

        $post_flds = [];
        $post_flds = ["cd",
            "name",
            "updated",
        ];


        $thisPost = []; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        $chg_flg = 0;
        foreach ($post_flds as $post_fld) {
            if ((array_key_exists($post_fld, $thisPost) ? $thisPost[$post_fld] : $this->request->getPost($post_fld)) !== $bumon_mr->$post_fld) {
                $chg_flg = 1;
                break;
            }
        }
        if ($chg_flg === 0) {
//            $this->flash->error("変更がありません。" . $id);
            return;
        }

        if ($id) {
            $this->_bakOut($bumon_mr);
        }

        foreach ($post_flds as $post_fld) {
            $bumon_mr->$post_fld = array_key_exists($post_fld, $thisPost) ? $thisPost[$post_fld] : $this->request->getPost($post_fld);
        }

        if (!$bumon_mr->save()) {

//            foreach ($bumon_mr->getMessages() as $message) {
//                $this->flash->error($message);
//            }
            return;
        }

//        $this->flash->success("部門マスタの情報を更新しました。");

        $resData = array();
//        $bumon_mr = BumonMrs::findFirstByid($id);
        $resAdata = array();
        $resAdata['id'] = $bumon_mr->id;
        foreach ($post_flds as $res_fld) {
            $resAdata[$res_fld] = $bumon_mr->$res_fld;
        }
        $resData[] = $resAdata;//array('cd' => $hacchuu_dt->cd, 'name' => $hacchuu_dt->name);

        //Set the content of the response
        $response->setContent(json_encode($resData));

        //Return the response
        return $response;
    }

    public function ajaxDeleteAction()
    {
        $this->view->disable();

        //Create a response instance
        $response = new \Phalcon\Http\Response();

        if (!$this->request->isAjax()) {
            echo "is not Ajax ! ";
            //    return;
        }
        if (!$this->request->isPost()) {
            echo "is not Post ! ";
            //    return;
        }

        $id = $this->request->getPost("id");
        $bumon_mr = BumonMrs::findFirstByid($id);
        if (!$bumon_mr) {
            return;
        }

        $this->_bakOut($bumon_mr, 1);

        if (!$bumon_mr->delete()) {
            return;
        }

        $resData = array();
        //Set the content of the response
        $response->setContent(json_encode($resData));

        //Return the response
        return $response;
    }

}
