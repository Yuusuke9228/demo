<?php
 


class NyuukinKbnsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        ControllerBase::indexCd("NyuukinKbns", "入金区分"); //簡易検索付き一覧表示
    }

    /**
     * Searches for nyuukin_kbns
     */
    public function searchAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Displays the creation form
     */
    public function newAction($id=null, $dataname="NyuukinKbns")
    {
        $this->view->imax = 0;

        if ($id) {
            $nameDts = $dataname;
            $nyuukin_kbn = $nameDts::findFirstByid($id);
            if (!$nyuukin_kbn) {
                $this->flash->error("入金区分が見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "nyuukin_kbns",
                    'action' => 'index'
                ));

                return;
            }
            $this->_setDefault($nyuukin_kbn, "new", $dataname);
            $this->tag->setDefault("id", null);
            $this->tag->setDefault("cd", null);
        }

    }

    /**
     * 修正画面から「次へ」ボタンを押したら次のコードの修正画面になる。
     */
    public function nextAction($id)
    {
        ControllerBase::nextCd($id, "nyuukin_kbns", "NyuukinKbns", "入金区分");
    }

    /**
     * 修正画面から「前へ」ボタンを押したら前のコードの修正画面になる。
     */
    public function prevAction($id)
    {
        ControllerBase::prevCd($id, "nyuukin_kbns", "NyuukinKbns", "入金区分");
    }

    /**
     * Edits a nyuukin_kbn
     *
     * @param string $id
     */
    public function editAction($id)
    {
//        if (!$this->request->isPost()) {

            $nyuukin_kbn = NyuukinKbns::findFirstByid($id);
            if (!$nyuukin_kbn) {
                $this->flash->error("入金区分が見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "nyuukin_kbns",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->id = $nyuukin_kbn->id;

            $this->_setDefault($nyuukin_kbn, "edit");
//        }
    }

    /**
     * 画面に表示するデータをセットする
     */
    public function _setDefault($nyuukin_kbn, $action="edit", $meisai="NyuukinKbns")
    {
        $setdts = ["id",
            "cd",
            "name",
            "nyuukin_bunrui_kbn_cd",
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
            if (property_exists($nyuukin_kbn, $setdt)) {
                $this->tag->setDefault($setdt, $nyuukin_kbn->$setdt);
            }
        }
    }

    /**
     * Creates a new nyuukin_kbn
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "nyuukin_kbns",
                'action' => 'index'
            ));

            return;
        }

        $nyuukin_kbn = new NyuukinKbns();

        $post_flds = [];
        $post_flds = ["cd",
            "name",
            "nyuukin_bunrui_kbn_cd",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        foreach ($post_flds as $post_fld) {
            $nyuukin_kbn->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$nyuukin_kbn->save()) {
            foreach ($nyuukin_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "nyuukin_kbns",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("入金区分の作成が完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "nyuukin_kbns",
            'action' => 'edit',
            'params' => array($nyuukin_kbn->id)
        ));
    }

    /**
     * Saves a nyuukin_kbn edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "nyuukin_kbns",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $nyuukin_kbn = NyuukinKbns::findFirstByid($id);

        if (!$nyuukin_kbn) {
            $this->flash->error("入金区分が見つからなくなりました。" . $id);

            $this->dispatcher->forward(array(
                'controller' => "nyuukin_kbns",
                'action' => 'index'
            ));

            return;
        }

        if ($nyuukin_kbn->updated !== $this->request->getPost("updated")) {
            $this->flash->error("他のプロセスから入金区分が変更されたため更新を中止しました。"
                . $id . ",uid=" . $nyuukin_kbn->kousin_user_id . " tb=" . $nyuukin_kbn->updated ." pt=" . $this->request->getPost("updated"));

            $this->dispatcher->forward(array(
                'controller' => "nyuukin_kbns",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $post_flds = [];
        $post_flds = ["cd",
            "name",
            "nyuukin_bunrui_kbn_cd",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        $chg_flg = 0;
        foreach ($post_flds as $post_fld) {
            if ((array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld)) !== $nyuukin_kbn->$post_fld) {
                $chg_flg = 1;
                break;
            }
        }
        if ($chg_flg === 0) {
            $this->flash->error("変更がありません。" . $id);

            $this->dispatcher->forward(array(
                "controller" => "nyuukin_kbns",
                "action" => "edit",
                "params" => array($nyuukin_kbn->id)
            ));

            return;
        }

        $this->_bakOut($nyuukin_kbn);

        foreach ($post_flds as $post_fld) {
            $nyuukin_kbn->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$nyuukin_kbn->save()) {

            foreach ($nyuukin_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "nyuukin_kbns",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $this->flash->success("入金区分の情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "nyuukin_kbns",
            'action' => 'edit',
            'params' => array($nyuukin_kbn->id)
        ));
    }

    /**
     * Deletes a nyuukin_kbn
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $nyuukin_kbn = NyuukinKbns::findFirstByid($id);
        if (!$nyuukin_kbn) {
            $this->flash->error("入金区分が見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "nyuukin_kbns",
                'action' => 'index'
            ));

            return;
        }

        $this->_bakOut($nyuukin_kbn, 1);

        if (!$nyuukin_kbn->delete()) {

            foreach ($nyuukin_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "nyuukin_kbns",
                'action' => 'search'
            ));

            return;
        }

        $this->flash->success("入金区分の削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "nyuukin_kbns",
            'action' => "index"
        ));
    }

    /**
     * Back Out a nyuukin_kbn
     *
     * @param string $nyuukin_kbn, $dlt_flg
     */
    public function _bakOut($nyuukin_kbn, $dlt_flg = 0)
    {

        $bak_nyuukin_kbn = new BakNyuukinKbns();
        foreach ($nyuukin_kbn as $fld => $value) {
            $bak_nyuukin_kbn->$fld = $nyuukin_kbn->$fld;
        }
        $bak_nyuukin_kbn->id = NULL;
        $bak_nyuukin_kbn->id_moto = $nyuukin_kbn->id;
        $bak_nyuukin_kbn->hikae_dltflg = $dlt_flg;
        $bak_nyuukin_kbn->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_nyuukin_kbn->hikae_nichiji = date("Y-m-d H:i:s");
        if (!$bak_nyuukin_kbn->save()) {
            foreach ($bak_nyuukin_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
    }

}
