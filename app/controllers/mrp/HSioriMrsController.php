<?php
 


class HSioriMrsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        ControllerBase::indexCd("HSioriMrs", "織設計マスタ"); //簡易検索付き一覧表示
    }

    /**
     * Searches for h_siori_mrs
     */
    public function searchAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Displays the creation form
     */
    public function newAction($id=null, $dataname="HSioriMrs")
    {
        $this->view->imax = 0;

        if ($id) {
            $nameDts = $dataname;
            $h_siori_mr = $nameDts::findFirstByid($id);
            if (!$h_siori_mr) {
                $this->flash->error("織設計マスタが見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "h_siori_mrs",
                    'action' => 'index'
                ));

                return;
            }
            $this->_setDefault($h_siori_mr, "new", $dataname);
            $this->tag->setDefault("id", null);
            $this->tag->setDefault("cd", null);
        }

    }

    /**
     * 修正画面から「次へ」ボタンを押したら次のコードの修正画面になる。
     */
    public function nextAction($id)
    {
        ControllerBase::nextCd($id, "h_siori_mrs", "HSioriMrs", "織設計マスタ");
    }

    /**
     * 修正画面から「前へ」ボタンを押したら前のコードの修正画面になる。
     */
    public function prevAction($id)
    {
        ControllerBase::prevCd($id, "h_siori_mrs", "HSioriMrs", "織設計マスタ");
    }

    /**
     * Edits a h_siori_mr
     *
     * @param string $id
     */
    public function editAction($id)
    {
//        if (!$this->request->isPost()) {

            $h_siori_mr = HSioriMrs::findFirstByid($id);
            if (!$h_siori_mr) {
                $this->flash->error("織設計マスタが見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "h_siori_mrs",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->id = $h_siori_mr->id;

            $this->_setDefault($h_siori_mr, "edit");
//        }
    }

    /**
     * 画面に表示するデータをセットする
     */
    public function _setDefault($h_siori_mr, $action="edit", $meisai="HSioriMrs")
    {
        $setdts = ["id",
            "cd",
            "moku",
            "symd",
            "kymd",
            "type",
            "irai",
            "etnt",
            "ktnt",
            "kibo",
            "inou",
            "snou",
            "tnou",
            "ynou",
            "anou",
            "tken",
            "yken",
            "socd",
            "htkb",
            "htho",
            "htsi",
            "hykb",
            "hyho",
            "ayma",
            "aycd",
            "ayho",
            "shab",
            "snag",
            "osa",
            "uti",
            "miha",
            "mihk",
            "miho",
            "jiha",
            "jihk",
            "dohk",
            "jiho",
            "khab",
            "knag",
            "tiji",
            "ahab",
            "anag",
            "auti",
            "jury",
            "kkoh",
            "nkoh",
            "tkoh",
            "ykoh",
            "dkoh",
            "skoh",
            "nnfk",
            "gjur",
            "ecod1",
            "ecod2",
            "ecod3",
            "ecod4",
            "ecod5",
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
            if (property_exists($h_siori_mr, $setdt)) {
                $this->tag->setDefault($setdt, $h_siori_mr->$setdt);
            }
        }
    }

    /**
     * Creates a new h_siori_mr
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "h_siori_mrs",
                'action' => 'index'
            ));

            return;
        }

        $h_siori_mr = new HSioriMrs();

        $post_flds = [];
        $post_flds = ["cd",
            "moku",
            "symd",
            "kymd",
            "type",
            "irai",
            "etnt",
            "ktnt",
            "kibo",
            "inou",
            "snou",
            "tnou",
            "ynou",
            "anou",
            "tken",
            "yken",
            "socd",
            "htkb",
            "htho",
            "htsi",
            "hykb",
            "hyho",
            "ayma",
            "aycd",
            "ayho",
            "shab",
            "snag",
            "osa",
            "uti",
            "miha",
            "mihk",
            "miho",
            "jiha",
            "jihk",
            "dohk",
            "jiho",
            "khab",
            "knag",
            "tiji",
            "ahab",
            "anag",
            "auti",
            "jury",
            "kkoh",
            "nkoh",
            "tkoh",
            "ykoh",
            "dkoh",
            "skoh",
            "nnfk",
            "gjur",
            "ecod1",
            "ecod2",
            "ecod3",
            "ecod4",
            "ecod5",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        foreach ($post_flds as $post_fld) {
            $h_siori_mr->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$h_siori_mr->save()) {
            foreach ($h_siori_mr->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "h_siori_mrs",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("織設計マスタの作成が完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "h_siori_mrs",
            'action' => 'edit',
            'params' => array($h_siori_mr->id)
        ));
    }

    /**
     * Saves a h_siori_mr edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "h_siori_mrs",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $h_siori_mr = HSioriMrs::findFirstByid($id);

        if (!$h_siori_mr) {
            $this->flash->error("織設計マスタが見つからなくなりました。" . $id);

            $this->dispatcher->forward(array(
                'controller' => "h_siori_mrs",
                'action' => 'index'
            ));

            return;
        }

        if ($h_siori_mr->updated !== $this->request->getPost("updated")) {
            $this->flash->error("他のプロセスから織設計マスタが変更されたため更新を中止しました。"
                . $id . ",uid=" . $h_siori_mr->kousin_user_id . " tb=" . $h_siori_mr->updated ." pt=" . $this->request->getPost("updated"));

            $this->dispatcher->forward(array(
                'controller' => "h_siori_mrs",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $post_flds = [];
        $post_flds = ["cd",
            "moku",
            "symd",
            "kymd",
            "type",
            "irai",
            "etnt",
            "ktnt",
            "kibo",
            "inou",
            "snou",
            "tnou",
            "ynou",
            "anou",
            "tken",
            "yken",
            "socd",
            "htkb",
            "htho",
            "htsi",
            "hykb",
            "hyho",
            "ayma",
            "aycd",
            "ayho",
            "shab",
            "snag",
            "osa",
            "uti",
            "miha",
            "mihk",
            "miho",
            "jiha",
            "jihk",
            "dohk",
            "jiho",
            "khab",
            "knag",
            "tiji",
            "ahab",
            "anag",
            "auti",
            "jury",
            "kkoh",
            "nkoh",
            "tkoh",
            "ykoh",
            "dkoh",
            "skoh",
            "nnfk",
            "gjur",
            "ecod1",
            "ecod2",
            "ecod3",
            "ecod4",
            "ecod5",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        $chg_flg = 0;
        foreach ($post_flds as $post_fld) {
            if ((array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld)) !== $h_siori_mr->$post_fld) {
                $chg_flg = 1;
                break;
            }
        }
        if ($chg_flg === 0) {
            $this->flash->error("変更がありません。" . $id);

            $this->dispatcher->forward(array(
                "controller" => "h_siori_mrs",
                "action" => "edit",
                "params" => array($h_siori_mr->id)
            ));

            return;
        }

        $this->_bakOut($h_siori_mr);

        foreach ($post_flds as $post_fld) {
            $h_siori_mr->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$h_siori_mr->save()) {

            foreach ($h_siori_mr->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "h_siori_mrs",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $this->flash->success("織設計マスタの情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "h_siori_mrs",
            'action' => 'edit',
            'params' => array($h_siori_mr->id)
        ));
    }

    /**
     * Deletes a h_siori_mr
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $h_siori_mr = HSioriMrs::findFirstByid($id);
        if (!$h_siori_mr) {
            $this->flash->error("織設計マスタが見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "h_siori_mrs",
                'action' => 'index'
            ));

            return;
        }

        $this->_bakOut($h_siori_mr, 1);

        if (!$h_siori_mr->delete()) {

            foreach ($h_siori_mr->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "h_siori_mrs",
                'action' => 'search'
            ));

            return;
        }

        $this->flash->success("織設計マスタの削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "h_siori_mrs",
            'action' => "index"
        ));
    }

    /**
     * Back Out a h_siori_mr
     *
     * @param string $h_siori_mr, $dlt_flg
     */
    public function _bakOut($h_siori_mr, $dlt_flg = 0)
    {
$h_siori_mr->backOut($dlt_flg);
return;
        $bak_h_siori_mr = new BakHSioriMrs();
        foreach ($h_siori_mr as $fld => $value) {
            $bak_h_siori_mr->$fld = $h_siori_mr->$fld;
        }
        $bak_h_siori_mr->id = NULL;
        $bak_h_siori_mr->id_moto = $h_siori_mr->id;
        $bak_h_siori_mr->hikae_dltflg = $dlt_flg;
        $bak_h_siori_mr->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_h_siori_mr->hikae_nichiji = date("Y-m-d H:i:s");
        if (!$bak_h_siori_mr->save()) {
            foreach ($bak_h_siori_mr->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
    }

}
