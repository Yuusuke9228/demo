<?php
 


class KonnnenndoController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        ControllerBase::indexCd("Konnnenndo", "会計年度"); //簡易検索付き一覧表示
    }

    /**
     * Searches for konnnenndo
     */
    public function searchAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Displays the creation form
     */
    public function newAction($id=null, $dataname="Konnnenndo")
    {
        $this->view->imax = 0;

        if ($id) {
            $nameDts = $dataname;
            $konnnenndo = $nameDts::findFirstByid($id);
            if (!$konnnenndo) {
                $this->flash->error("会計年度が見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "konnnenndo",
                    'action' => 'index'
                ));

                return;
            }
            $this->_setDefault($konnnenndo, "new", $dataname);
            $this->tag->setDefault("id", null);
            $this->tag->setDefault("cd", null);
        }

    }

    /**
     * 修正画面から「次へ」ボタンを押したら次のコードの修正画面になる。
     */
    public function nextAction($id)
    {
        ControllerBase::nextCd($id, "konnnenndo", "Konnnenndo", "今年度");
    }

    /**
     * 修正画面から「前へ」ボタンを押したら前のコードの修正画面になる。
     */
    public function prevAction($id)
    {
        ControllerBase::prevCd($id, "konnnenndo", "Konnnenndo", "今年度");
    }

    /**
     * Edits a konnnenndo
     *
     * @param string $id
     */
    public function editAction($id)
    {
//        if (!$this->request->isPost()) {

            $konnnenndo = Konnnenndo::findFirstByid($id);
            if (!$konnnenndo) {
                $this->flash->error("会計年度が見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "konnnenndo",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->id = $konnnenndo->id;

            $this->_setDefault($konnnenndo, "edit");
//        }
    }

    /**
     * 画面に表示するデータをセットする
     */
    public function _setDefault($konnnenndo, $action="edit", $meisai="Konnnenndo")
    {
        $setdts = ["id",
            "cd",
            "name",
            "touki_flg",
            "kikan_from",
            "kikan_to",
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
            if (property_exists($konnnenndo, $setdt)) {
                $this->tag->setDefault($setdt, $konnnenndo->$setdt);
            }
        }
    }

    /**
     * Creates a new konnnenndo
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "konnnenndo",
                'action' => 'index'
            ));

            return;
        }

        $konnnenndo = new Konnnenndo();

        $post_flds = [];
        $post_flds = ["cd",
            "name",
            "touki_flg",
            "kikan_from",
            "kikan_to",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        foreach ($post_flds as $post_fld) {
            $konnnenndo->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$konnnenndo->save()) {
            foreach ($konnnenndo->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "konnnenndo",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("今年度の作成が完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "konnnenndo",
            'action' => 'edit',
            'params' => array($konnnenndo->id)
        ));
    }

    /**
     * Saves a konnnenndo edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "konnnenndo",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $konnnenndo = Konnnenndo::findFirstByid($id);

        if (!$konnnenndo) {
            $this->flash->error("今年度が見つからなくなりました。" . $id);

            $this->dispatcher->forward(array(
                'controller' => "konnnenndo",
                'action' => 'index'
            ));

            return;
        }

        if ($konnnenndo->updated !== $this->request->getPost("updated")) {
            $this->flash->error("他のプロセスから会計年度が変更されたため更新を中止しました。"
                . $id . ",uid=" . $konnnenndo->kousin_user_id . " tb=" . $konnnenndo->updated ." pt=" . $this->request->getPost("updated"));

            $this->dispatcher->forward(array(
                'controller' => "konnnenndo",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $post_flds = [];
        $post_flds = ["cd",
            "name",
            "touki_flg",
            "kikan_from",
            "kikan_to",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        $chg_flg = 0;
        foreach ($post_flds as $post_fld) {
            if ((array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld)) !== $konnnenndo->$post_fld) {
                $chg_flg = 1;
                break;
            }
        }
        if ($chg_flg === 0) {
            $this->flash->error("変更がありません。" . $id);

            $this->dispatcher->forward(array(
                "controller" => "konnnenndo",
                "action" => "edit",
                "params" => array($konnnenndo->id)
            ));

            return;
        }

        $this->_bakOut($konnnenndo);

        foreach ($post_flds as $post_fld) {
            $konnnenndo->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$konnnenndo->save()) {

            foreach ($konnnenndo->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "konnnenndo",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $this->flash->success("会計年度の情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "konnnenndo",
            'action' => 'edit',
            'params' => array($konnnenndo->id)
        ));
    }

    /**
     * Deletes a konnnenndo
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $konnnenndo = Konnnenndo::findFirstByid($id);
        if (!$konnnenndo) {
            $this->flash->error("会計年度が見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "konnnenndo",
                'action' => 'index'
            ));

            return;
        }

        if (!$konnnenndo->delete()) {

            foreach ($konnnenndo->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "konnnenndo",
                'action' => 'search'
            ));

            return;
        }

        $this->_bakOut($konnnenndo, 1);

        $this->flash->success("会計年度の削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "konnnenndo",
            'action' => "index"
        ));
    }

    /**
     * Back Out a konnnenndo
     *
     * @param string $konnnenndo, $dlt_flg
     */
    public function _bakOut($konnnenndo, $dlt_flg = 0)
    {

        $bak_konnnenndo = new BakKonnnenndo();
        foreach ($konnnenndo as $fld => $value) {
            $bak_konnnenndo->$fld = $konnnenndo->$fld;
        }
        $bak_konnnenndo->id = NULL;
        $bak_konnnenndo->id_moto = $konnnenndo->id;
        $bak_konnnenndo->hikae_dltflg = $dlt_flg;
        $bak_konnnenndo->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_konnnenndo->hikae_nichiji = date("Y-m-d H:i:s");
        if (!$bak_konnnenndo->save()) {
            foreach ($bak_konnnenndo->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
    }

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
        $konnnendos = Konnnenndo::find(array(
            'order' => 'cd',
            'conditions' => ' cd LIKE ?1 ',
            'bind' => array(1 => $this->request->getPost('cd').'%')
        ));
        $res_flds = ["id","cd","name","kikan_from","kikan_to",];
        $resData = array();
        foreach ($konnnendos as $konnnendo) {
            $resAdata = array();
            foreach ($res_flds as $res_fld) {
                $resAdata[$res_fld] = $konnnendo->$res_fld;
            }
            $resData[] = $resAdata;
        }
        $response->setContent(json_encode($resData));
        return $response;
    }
}
