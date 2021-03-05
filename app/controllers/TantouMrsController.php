<?php

class TantouMrsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        ControllerBase::indexCd("TantouMrs", "担当者マスタ"); //簡易検索付き一覧表示
    }

    /**
     * Index action AJAX test
     */
    public function index_2Action()
    {
        ControllerBase::indexCd("TantouMrs", "担当者マスタ"); //簡易検索付き一覧表示
    }

    /**
     * Searches for tantou_mrs
     */
    public function searchAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Displays the creation form
     */
    public function newAction($id=null, $dataname="TantouMrs")
    {
        $this->view->imax = 0;

        if ($id) {
            $nameDts = $dataname;
            $tantou_mr = $nameDts::findFirstByid($id);
            if (!$tantou_mr) {
                $this->flash->error("担当者マスタが見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "tantou_mrs",
                    'action' => 'index'
                ));

                return;
            }
            $this->_setDefault($tantou_mr, "new", $dataname);
            $this->tag->setDefault("id", null);
            $this->tag->setDefault("cd", null);
        }

    }

    /**
     * 修正画面から「次へ」ボタンを押したら次のコードの修正画面になる。
     */
    public function nextAction($id)
    {
        ControllerBase::nextCd($id, "tantou_mrs", "TantouMrs", "担当者マスタ");
    }

    /**
     * 修正画面から「前へ」ボタンを押したら前のコードの修正画面になる。
     */
    public function prevAction($id)
    {
        ControllerBase::prevCd($id, "tantou_mrs", "TantouMrs", "担当者マスタ");
    }


    /**
     * モーダル 2019/11/6 Nishiyama
     */
    public function modalAction()
    {
        ControllerBase::indexCd("TantouMrs", "担当者台帳");
    }

    /*
     * Ajax 2019/11/6 Nishiyama
     */
    public function ajaxGetAction()
    {
        $this->view->disable();
        $response = new \Phalcon\Http\Response();
        if (!$this->request->isAjax()) {
            echo "is not Ajax ! ";
        }
        if (!$this->request->isPost()) {
            echo "is not Post ! ";
        }
        $tantons = TantouMrs::find(array(
            'order' => 'cd',
            'conditions' => ' cd LIKE ?1 ',
            'bind' => array(1 => $this->request->getPost('cd').'%')
        ));
        $res_flds = ["id","cd","name",];
        $resData = array();
        foreach ($tantons as $tanton) {
            $resAdata = array();
            foreach ($res_flds as $res_fld) {
                $resAdata[$res_fld] = $tanton->$res_fld;
            }
            $resData[] = $resAdata;
        }
        $response->setContent(json_encode($resData));
        return $response;
    }

    /**
     * Edits a tantou_mr
     *
     * @param string $id
     */
    public function editAction($id)
    {
//        if (!$this->request->isPost()) {

            $tantou_mr = TantouMrs::findFirstByid($id);
            if (!$tantou_mr) {
                $this->flash->error("担当者マスタが見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "tantou_mrs",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->id = $tantou_mr->id;

            $this->_setDefault($tantou_mr, "edit");
//        }
    }

    /**
     * 画面に表示するデータをセットする
     */
    public function _setDefault($tantou_mr, $action="edit", $meisai="TantouMrs")
    {
        $setdts = ["id",
            "cd",
            "name",
            "kana_mei",
            "bumon_mr_cd",
            "user_cd",
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
            if (property_exists($tantou_mr, $setdt)) {
                $this->tag->setDefault($setdt, $tantou_mr->$setdt);
            }
        }
    }

    /**
     * Creates a new tantou_mr
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "tantou_mrs",
                'action' => 'index'
            ));

            return;
        }

        $tantou_mr = new TantouMrs();

        $post_flds = [];
        $post_flds = ["cd",
            "name",
            "kana_mei",
            "bumon_mr_cd",
            "user_cd",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        foreach ($post_flds as $post_fld) {
            $tantou_mr->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$tantou_mr->save()) {
            foreach ($tantou_mr->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "tantou_mrs",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("担当者マスタの作成が完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "tantou_mrs",
            'action' => 'edit',
            'params' => array($tantou_mr->id)
        ));
    }

    /**
     * Saves a tantou_mr edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "tantou_mrs",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $tantou_mr = TantouMrs::findFirstByid($id);

        if (!$tantou_mr) {
            $this->flash->error("担当者マスタが見つからなくなりました。" . $id);

            $this->dispatcher->forward(array(
                'controller' => "tantou_mrs",
                'action' => 'index'
            ));

            return;
        }

        if ($tantou_mr->updated !== $this->request->getPost("updated")) {
            $this->flash->error("他のプロセスから担当者マスタが変更されたため更新を中止しました。"
                . $id . ",uid=" . $tantou_mr->kousin_user_id . " tb=" . $tantou_mr->updated ." pt=" . $this->request->getPost("updated"));

            $this->dispatcher->forward(array(
                'controller' => "tantou_mrs",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $post_flds = [];
        $post_flds = ["cd",
            "name",
            "kana_mei",
            "bumon_mr_cd",
            "user_cd",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        $chg_flg = 0;
        foreach ($post_flds as $post_fld) {
            if ((array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld)) !== $tantou_mr->$post_fld) {
                $chg_flg = 1;
                break;
            }
        }
        if ($chg_flg === 0) {
            $this->flash->error("変更がありません。" . $id);

            $this->dispatcher->forward(array(
                "controller" => "tantou_mrs",
                "action" => "edit",
                "params" => array($tantou_mr->id)
            ));

            return;
        }

        $this->_bakOut($tantou_mr);

        foreach ($post_flds as $post_fld) {
            $tantou_mr->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$tantou_mr->save()) {

            foreach ($tantou_mr->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "tantou_mrs",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $this->flash->success("担当者マスタの情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "tantou_mrs",
            'action' => 'edit',
            'params' => array($tantou_mr->id)
        ));
    }

    /*
     * カナを取得 Add By Nishiyama 2019-10-23
     */
    public function ajaxGetHuriganaAction()
    {
        $this->view->disable();
        $response = new \Phalcon\Http\Response();
        if (!$this->request->isAjax()) echo "Request is not Ajax!";
        if (!$this->request->isPost()) echo "Request is not Post!";
        $mecab = \Phalcon\DI::getDefault()->get('mecab');
        $input_data = $this->request->getPost('input');
        $res = $mecab->mecab_parse($input_data);
        $yomi = $mecab->return_kana($res);
        $res_data = ['kana' => $yomi];
        $response->setContent(json_encode($res_data));
        return $response;
    }

    /*
     * Ajaxで保存させる Add By Nishiyama 2018/1/11
     * index_2 の teble の値変更時に呼び出し。
     * test中(更新処理が出来てしまうので本実装許可が出るまで、コメント化で処理を流す。）
     */
    public function saveAjaxAction()
    {
        header("Content-type: text/plain; charset=UTF-8");
        $this->view->disable();
        $response = new \Phalcon\Http\Response();
        if (!$this->request->isAjax()) {
            echo "is not Ajax !! ";
        }
        if (!$this->request->isPost()) {
            echo "is not Post !! ";
        }

        $obj = $this->request->getPost();
        $id = $obj['id'];
        /*
        $tantou_mr = TantouMrs::findFirstByid($id);
        if (!$tantou_mr) {
            $this->flash->error("担当者マスタが見つからなくなりました。" . $id);
            $this->dispatcher->forward(array(
                'controller' => "tantou_mrs",
                'action' => 'index'
            ));
            return;
        }
        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        $chg_flg = 0;
        foreach ($obj as $post_fld) {
            if ((array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld)) !== $tantou_mr->$post_fld) {
                $chg_flg = 1;
                break;
            }
        }
        if ($chg_flg === 0) {
            $this->flash->error("変更がありません。" . $id);

            $this->dispatcher->forward(array(
                "controller" => "tantou_mrs",
                "action" => "edit",
                "params" => array($tantou_mr->id)
            ));
            return;
        }
        $this->_bakOut($tantou_mr);
        foreach ($obj as $post_fld) {
            $tantou_mr->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }
        if (!$tantou_mr->save()) {
            foreach ($tantou_mr->getMessages() as $message) {
                $this->flash->error($message);
            }
            $this->dispatcher->forward(array(
                'controller' => "tantou_mrs",
                'action' => 'edit',
                'params' => array($id)
            ));
            return;
        }
        //Set the content of the response*/
        $response->setContent(json_encode($id));
        //Return the response
        return $response;
    }
    //================================================================================================================================
    /**
     * Deletes a tantou_mr
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $tantou_mr = TantouMrs::findFirstByid($id);
        if (!$tantou_mr) {
            $this->flash->error("担当者マスタが見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "tantou_mrs",
                'action' => 'index'
            ));

            return;
        }

        $this->_bakOut($tantou_mr, 1);

        if (!$tantou_mr->delete()) {

            foreach ($tantou_mr->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "tantou_mrs",
                'action' => 'search'
            ));

            return;
        }

        $this->flash->success("担当者マスタの削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "tantou_mrs",
            'action' => "index"
        ));
    }

    /**
     * Back Out a tantou_mr
     *
     * @param string $tantou_mr, $dlt_flg
     */
    public function _bakOut($tantou_mr, $dlt_flg = 0)
    {

        $bak_tantou_mr = new BakTantouMrs();
        foreach ($tantou_mr as $fld => $value) {
            $bak_tantou_mr->$fld = $tantou_mr->$fld;
        }
        $bak_tantou_mr->id = NULL;
        $bak_tantou_mr->id_moto = $tantou_mr->id;
        $bak_tantou_mr->hikae_dltflg = $dlt_flg;
        $bak_tantou_mr->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_tantou_mr->hikae_nichiji = date("Y-m-d H:i:s");
        if (!$bak_tantou_mr->save()) {
            foreach ($bak_tantou_mr->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
    }

}
