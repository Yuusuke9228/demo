<?php
 


class TorihikiKbnMidasisController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        ControllerBase::indexCd("TorihikiKbnMidasis", "取引区分別見出"); //簡易検索付き一覧表示
    }

    /**
     * Searches for torihiki_kbn_midasis
     */
    public function searchAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Displays the creation form
     */
    public function newAction($id=null, $dataname="TorihikiKbnMidasis")
    {
        $this->view->imax = 0;

        if ($id) {
            $nameDts = $dataname;
            $torihiki_kbn_midasi = $nameDts::findFirstByid($id);
            if (!$torihiki_kbn_midasi) {
                $this->flash->error("取引区分別見出が見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "torihiki_kbn_midasis",
                    'action' => 'index'
                ));

                return;
            }
            $this->_setDefault($torihiki_kbn_midasi, "new", $dataname);
            $this->tag->setDefault("id", null);
            $this->tag->setDefault("cd", null);
        }

    }

    /**
     * 修正画面から「次へ」ボタンを押したら次のコードの修正画面になる。
     */
    public function nextAction($id)
    {
        ControllerBase::nextCd($id, "torihiki_kbn_midasis", "TorihikiKbnMidasis", "取引区分別見出");
    }

    /**
     * 修正画面から「前へ」ボタンを押したら前のコードの修正画面になる。
     */
    public function prevAction($id)
    {
        ControllerBase::prevCd($id, "torihiki_kbn_midasis", "TorihikiKbnMidasis", "取引区分別見出");
    }

    /**
     * Edits a torihiki_kbn_midasi
     *
     * @param string $id
     */
    public function editAction($id)
    {
//        if (!$this->request->isPost()) {

            $torihiki_kbn_midasi = TorihikiKbnMidasis::findFirstByid($id);
            if (!$torihiki_kbn_midasi) {
                $this->flash->error("取引区分別見出が見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "torihiki_kbn_midasis",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->id = $torihiki_kbn_midasi->id;

            $this->_setDefault($torihiki_kbn_midasi, "edit");
//        }
    }

    /**
     * 画面に表示するデータをセットする
     */
    public function _setDefault($torihiki_kbn_midasi, $action="edit", $meisai="TorihikiKbnMidasis")
    {
        $setdts = ["id",
            "cd",
            "name",
            "torihiki_kbn_cd",
            "utiwake_kbn_cd",
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
            if (property_exists($torihiki_kbn_midasi, $setdt)) {
                $this->tag->setDefault($setdt, $torihiki_kbn_midasi->$setdt);
            }
        }
    }

    /**
     * Creates a new torihiki_kbn_midasi
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "torihiki_kbn_midasis",
                'action' => 'index'
            ));

            return;
        }

        $torihiki_kbn_midasi = new TorihikiKbnMidasis();

        $post_flds = [];
        $post_flds = ["cd",
            "name",
            "torihiki_kbn_cd",
            "utiwake_kbn_cd",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        foreach ($post_flds as $post_fld) {
            $torihiki_kbn_midasi->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$torihiki_kbn_midasi->save()) {
            foreach ($torihiki_kbn_midasi->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "torihiki_kbn_midasis",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("取引区分別見出の作成が完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "torihiki_kbn_midasis",
            'action' => 'edit',
            'params' => array($torihiki_kbn_midasi->id)
        ));
    }

    /**
     * Saves a torihiki_kbn_midasi edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "torihiki_kbn_midasis",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $torihiki_kbn_midasi = TorihikiKbnMidasis::findFirstByid($id);

        if (!$torihiki_kbn_midasi) {
            $this->flash->error("取引区分別見出が見つからなくなりました。" . $id);

            $this->dispatcher->forward(array(
                'controller' => "torihiki_kbn_midasis",
                'action' => 'index'
            ));

            return;
        }

        if ($torihiki_kbn_midasi->updated !== $this->request->getPost("updated")) {
            $this->flash->error("他のプロセスから取引区分別見出が変更されたため更新を中止しました。"
                . $id . ",uid=" . $torihiki_kbn_midasi->kousin_user_id . " tb=" . $torihiki_kbn_midasi->updated ." pt=" . $this->request->getPost("updated"));

            $this->dispatcher->forward(array(
                'controller' => "torihiki_kbn_midasis",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $post_flds = [];
        $post_flds = ["cd",
            "name",
            "torihiki_kbn_cd",
            "utiwake_kbn_cd",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        $chg_flg = 0;
        foreach ($post_flds as $post_fld) {
            if ((array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld)) !== $torihiki_kbn_midasi->$post_fld) {
                $chg_flg = 1;
                break;
            }
        }
        if ($chg_flg === 0) {
            $this->flash->error("変更がありません。" . $id);

            $this->dispatcher->forward(array(
                "controller" => "torihiki_kbn_midasis",
                "action" => "edit",
                "params" => array($torihiki_kbn_midasi->id)
            ));

            return;
        }

        $this->_bakOut($torihiki_kbn_midasi);

        foreach ($post_flds as $post_fld) {
            $torihiki_kbn_midasi->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$torihiki_kbn_midasi->save()) {

            foreach ($torihiki_kbn_midasi->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "torihiki_kbn_midasis",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $this->flash->success("取引区分別見出の情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "torihiki_kbn_midasis",
            'action' => 'edit',
            'params' => array($torihiki_kbn_midasi->id)
        ));
    }

    /**
     * Deletes a torihiki_kbn_midasi
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $torihiki_kbn_midasi = TorihikiKbnMidasis::findFirstByid($id);
        if (!$torihiki_kbn_midasi) {
            $this->flash->error("取引区分別見出が見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "torihiki_kbn_midasis",
                'action' => 'index'
            ));

            return;
        }

        if (!$torihiki_kbn_midasi->delete()) {

            foreach ($torihiki_kbn_midasi->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "torihiki_kbn_midasis",
                'action' => 'search'
            ));

            return;
        }

        $this->_bakOut($torihiki_kbn_midasi, 1);

        $this->flash->success("取引区分別見出の削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "torihiki_kbn_midasis",
            'action' => "index"
        ));
    }

    /**
     * Back Out a torihiki_kbn_midasi
     *
     * @param string $torihiki_kbn_midasi, $dlt_flg
     */
    public function _bakOut($torihiki_kbn_midasi, $dlt_flg = 0)
    {

        $bak_torihiki_kbn_midasi = new BakTorihikiKbnMidasis();
        foreach ($torihiki_kbn_midasi as $fld => $value) {
            $bak_torihiki_kbn_midasi->$fld = $torihiki_kbn_midasi->$fld;
        }
        $bak_torihiki_kbn_midasi->id = NULL;
        $bak_torihiki_kbn_midasi->id_moto = $torihiki_kbn_midasi->id;
        $bak_torihiki_kbn_midasi->hikae_dltflg = $dlt_flg;
        $bak_torihiki_kbn_midasi->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_torihiki_kbn_midasi->hikae_nichiji = date("Y-m-d H:i:s");
        if (!$bak_torihiki_kbn_midasi->save()) {
            foreach ($bak_torihiki_kbn_midasi->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
    }

}
