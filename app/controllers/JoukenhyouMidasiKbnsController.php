<?php
 


class JoukenhyouMidasiKbnsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        ControllerBase::indexCd("JoukenhyouMidasiKbns", "条件表見出し"); //簡易検索付き一覧表示
    }

    /**
     * Searches for joukenhyou_midasi_kbns
     */
    public function searchAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Displays the creation form
     */
    public function newAction($id=null, $dataname="JoukenhyouMidasiKbns")
    {
        $this->view->imax = 0;

        if ($id) {
            $nameDts = $dataname;
            $joukenhyou_midasi_kbn = $nameDts::findFirstByid($id);
            if (!$joukenhyou_midasi_kbn) {
                $this->flash->error("条件表見出しが見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "joukenhyou_midasi_kbns",
                    'action' => 'index'
                ));

                return;
            }
            $this->_setDefault($joukenhyou_midasi_kbn, "new", $dataname);
            $this->tag->setDefault("id", null);
            $this->tag->setDefault("cd", null);
        }

    }

    /**
     * 修正画面から「次へ」ボタンを押したら次のコードの修正画面になる。
     */
    public function nextAction($id)
    {
        ControllerBase::nextCd($id, "joukenhyou_midasi_kbns", "JoukenhyouMidasiKbns", "条件表見出し");
    }

    /**
     * 修正画面から「前へ」ボタンを押したら前のコードの修正画面になる。
     */
    public function prevAction($id)
    {
        ControllerBase::prevCd($id, "joukenhyou_midasi_kbns", "JoukenhyouMidasiKbns", "条件表見出し");
    }

    /**
     * Edits a joukenhyou_midasi_kbn
     *
     * @param string $id
     */
    public function editAction($id)
    {
//        if (!$this->request->isPost()) {

            $joukenhyou_midasi_kbn = JoukenhyouMidasiKbns::findFirstByid($id);
            if (!$joukenhyou_midasi_kbn) {
                $this->flash->error("条件表見出しが見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "joukenhyou_midasi_kbns",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->id = $joukenhyou_midasi_kbn->id;

            $this->_setDefault($joukenhyou_midasi_kbn, "edit");
//        }
    }

    /**
     * 画面に表示するデータをセットする
     */
    public function _setDefault($joukenhyou_midasi_kbn, $action="edit", $meisai="JoukenhyouMidasiKbns")
    {
        $setdts = ["id",
            "cd",
            "name",
            "shouhin_bunrui1_kbn_cd",
            "type_kbn_cd",
            "ketasuu",
            "gyousuu",
            "shousuu",
            "tuika_max",
            "memo",
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
            if (property_exists($joukenhyou_midasi_kbn, $setdt)) {
                $this->tag->setDefault($setdt, $joukenhyou_midasi_kbn->$setdt);
            }
        }
    }

    /**
     * Creates a new joukenhyou_midasi_kbn
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "joukenhyou_midasi_kbns",
                'action' => 'index'
            ));

            return;
        }

        $joukenhyou_midasi_kbn = new JoukenhyouMidasiKbns();

        $post_flds = [];
        $post_flds = ["cd",
            "name",
            "shouhin_bunrui1_kbn_cd",
            "type_kbn_cd",
            "ketasuu",
            "gyousuu",
            "shousuu",
            "tuika_max",
            "memo",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        foreach ($post_flds as $post_fld) {
            $joukenhyou_midasi_kbn->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$joukenhyou_midasi_kbn->save()) {
            foreach ($joukenhyou_midasi_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "joukenhyou_midasi_kbns",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("条件表見出しの作成が完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "joukenhyou_midasi_kbns",
            'action' => 'edit',
            'params' => array($joukenhyou_midasi_kbn->id)
        ));
    }

    /**
     * Saves a joukenhyou_midasi_kbn edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "joukenhyou_midasi_kbns",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $joukenhyou_midasi_kbn = JoukenhyouMidasiKbns::findFirstByid($id);

        if (!$joukenhyou_midasi_kbn) {
            $this->flash->error("条件表見出しが見つからなくなりました。" . $id);

            $this->dispatcher->forward(array(
                'controller' => "joukenhyou_midasi_kbns",
                'action' => 'index'
            ));

            return;
        }

        if ($joukenhyou_midasi_kbn->updated !== $this->request->getPost("updated")) {
            $this->flash->error("他のプロセスから条件表見出しが変更されたため更新を中止しました。"
                . $id . ",uid=" . $joukenhyou_midasi_kbn->kousin_user_id . " tb=" . $joukenhyou_midasi_kbn->updated ." pt=" . $this->request->getPost("updated"));

            $this->dispatcher->forward(array(
                'controller' => "joukenhyou_midasi_kbns",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $post_flds = [];
        $post_flds = ["cd",
            "name",
            "shouhin_bunrui1_kbn_cd",
            "type_kbn_cd",
            "ketasuu",
            "gyousuu",
            "shousuu",
            "tuika_max",
            "memo",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        $chg_flg = 0;
        foreach ($post_flds as $post_fld) {
            if ((array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld)) !== $joukenhyou_midasi_kbn->$post_fld) {
                $chg_flg = 1;
                break;
            }
        }
        if ($chg_flg === 0) {
            $this->flash->error("変更がありません。" . $id);

            $this->dispatcher->forward(array(
                "controller" => "joukenhyou_midasi_kbns",
                "action" => "edit",
                "params" => array($joukenhyou_midasi_kbn->id)
            ));

            return;
        }

        $this->_bakOut($joukenhyou_midasi_kbn);

        foreach ($post_flds as $post_fld) {
            $joukenhyou_midasi_kbn->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$joukenhyou_midasi_kbn->save()) {

            foreach ($joukenhyou_midasi_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "joukenhyou_midasi_kbns",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $this->flash->success("条件表見出しの情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "joukenhyou_midasi_kbns",
            'action' => 'edit',
            'params' => array($joukenhyou_midasi_kbn->id)
        ));
    }

    /**
     * Deletes a joukenhyou_midasi_kbn
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $joukenhyou_midasi_kbn = JoukenhyouMidasiKbns::findFirstByid($id);
        if (!$joukenhyou_midasi_kbn) {
            $this->flash->error("条件表見出しが見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "joukenhyou_midasi_kbns",
                'action' => 'index'
            ));

            return;
        }

        $this->_bakOut($joukenhyou_midasi_kbn, 1);

        if (!$joukenhyou_midasi_kbn->delete()) {

            foreach ($joukenhyou_midasi_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "joukenhyou_midasi_kbns",
                'action' => 'search'
            ));

            return;
        }

        $this->flash->success("条件表見出しの削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "joukenhyou_midasi_kbns",
            'action' => "index"
        ));
    }

    /**
     * Back Out a joukenhyou_midasi_kbn
     *
     * @param string $joukenhyou_midasi_kbn, $dlt_flg
     */
    public function _bakOut($joukenhyou_midasi_kbn, $dlt_flg = 0)
    {

        $bak_joukenhyou_midasi_kbn = new BakJoukenhyouMidasiKbns();
        foreach ($joukenhyou_midasi_kbn as $fld => $value) {
            $bak_joukenhyou_midasi_kbn->$fld = $joukenhyou_midasi_kbn->$fld;
        }
        $bak_joukenhyou_midasi_kbn->id = NULL;
        $bak_joukenhyou_midasi_kbn->id_moto = $joukenhyou_midasi_kbn->id;
        $bak_joukenhyou_midasi_kbn->hikae_dltflg = $dlt_flg;
        $bak_joukenhyou_midasi_kbn->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_joukenhyou_midasi_kbn->hikae_nichiji = date("Y-m-d H:i:s");
        if (!$bak_joukenhyou_midasi_kbn->save()) {
            foreach ($bak_joukenhyou_midasi_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
    }

}
