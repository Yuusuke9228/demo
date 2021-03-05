<?php
 


class KakouNagareKbnsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        ControllerBase::indexCd("KakouNagareKbns", "加工流れ見出し区分"); //簡易検索付き一覧表示
    }

    /**
     * Searches for kakou_nagare_kbns
     */
    public function searchAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Displays the creation form
     */
    public function newAction($id=null, $dataname="KakouNagareKbns")
    {
        $this->view->imax = 0;

        if ($id) {
            $nameDts = $dataname;
            $kakou_nagare_kbn = $nameDts::findFirstByid($id);
            if (!$kakou_nagare_kbn) {
                $this->flash->error("加工流れ見出し区分が見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "kakou_nagare_kbns",
                    'action' => 'index'
                ));

                return;
            }
            $this->_setDefault($kakou_nagare_kbn, "new", $dataname);
            $this->tag->setDefault("id", null);
            $this->tag->setDefault("cd", null);
        }

    }

    /**
     * 修正画面から「次へ」ボタンを押したら次のコードの修正画面になる。
     */
    public function nextAction($id)
    {
        ControllerBase::nextCd($id, "kakou_nagare_kbns", "KakouNagareKbns", "加工流れ見出し区分");
    }

    /**
     * 修正画面から「前へ」ボタンを押したら前のコードの修正画面になる。
     */
    public function prevAction($id)
    {
        ControllerBase::prevCd($id, "kakou_nagare_kbns", "KakouNagareKbns", "加工流れ見出し区分");
    }

    /**
     * Edits a kakou_nagare_kbn
     *
     * @param string $id
     */
    public function editAction($id)
    {
//        if (!$this->request->isPost()) {

            $kakou_nagare_kbn = KakouNagareKbns::findFirstByid($id);
            if (!$kakou_nagare_kbn) {
                $this->flash->error("加工流れ見出し区分が見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "kakou_nagare_kbns",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->id = $kakou_nagare_kbn->id;

            $this->_setDefault($kakou_nagare_kbn, "edit");
//        }
    }

    /**
     * 画面に表示するデータをセットする
     */
    public function _setDefault($kakou_nagare_kbn, $action="edit", $meisai="KakouNagareKbns")
    {
        $setdts = ["id",
            "cd",
            "name",
            "bikou",
            "naiyou_cd_table_id",
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
            if (property_exists($kakou_nagare_kbn, $setdt)) {
                $this->tag->setDefault($setdt, $kakou_nagare_kbn->$setdt);
            }
        }
    }

    /**
     * Creates a new kakou_nagare_kbn
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "kakou_nagare_kbns",
                'action' => 'index'
            ));

            return;
        }

        $kakou_nagare_kbn = new KakouNagareKbns();

        $post_flds = [];
        $post_flds = ["cd",
            "name",
            "bikou",
            "naiyou_cd_table_id",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        foreach ($post_flds as $post_fld) {
            $kakou_nagare_kbn->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$kakou_nagare_kbn->save()) {
            foreach ($kakou_nagare_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "kakou_nagare_kbns",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("加工流れ見出し区分の作成が完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "kakou_nagare_kbns",
            'action' => 'edit',
            'params' => array($kakou_nagare_kbn->id)
        ));
    }

    /**
     * Saves a kakou_nagare_kbn edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "kakou_nagare_kbns",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $kakou_nagare_kbn = KakouNagareKbns::findFirstByid($id);

        if (!$kakou_nagare_kbn) {
            $this->flash->error("加工流れ見出し区分が見つからなくなりました。" . $id);

            $this->dispatcher->forward(array(
                'controller' => "kakou_nagare_kbns",
                'action' => 'index'
            ));

            return;
        }

        if ($kakou_nagare_kbn->updated !== $this->request->getPost("updated")) {
            $this->flash->error("他のプロセスから加工流れ見出し区分が変更されたため更新を中止しました。"
                . $id . ",uid=" . $kakou_nagare_kbn->kousin_user_id . " tb=" . $kakou_nagare_kbn->updated ." pt=" . $this->request->getPost("updated"));

            $this->dispatcher->forward(array(
                'controller' => "kakou_nagare_kbns",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $post_flds = [];
        $post_flds = ["cd",
            "name",
            "bikou",
            "naiyou_cd_table_id",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        $chg_flg = 0;
        foreach ($post_flds as $post_fld) {
            if ((array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld)) !== $kakou_nagare_kbn->$post_fld) {
                $chg_flg = 1;
                break;
            }
        }
        if ($chg_flg === 0) {
            $this->flash->error("変更がありません。" . $id);

            $this->dispatcher->forward(array(
                "controller" => "kakou_nagare_kbns",
                "action" => "edit",
                "params" => array($kakou_nagare_kbn->id)
            ));

            return;
        }

        $this->_bakOut($kakou_nagare_kbn);

        foreach ($post_flds as $post_fld) {
            $kakou_nagare_kbn->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$kakou_nagare_kbn->save()) {

            foreach ($kakou_nagare_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "kakou_nagare_kbns",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $this->flash->success("加工流れ見出し区分の情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "kakou_nagare_kbns",
            'action' => 'edit',
            'params' => array($kakou_nagare_kbn->id)
        ));
    }

    /**
     * Deletes a kakou_nagare_kbn
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $kakou_nagare_kbn = KakouNagareKbns::findFirstByid($id);
        if (!$kakou_nagare_kbn) {
            $this->flash->error("加工流れ見出し区分が見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "kakou_nagare_kbns",
                'action' => 'index'
            ));

            return;
        }

        $this->_bakOut($kakou_nagare_kbn, 1);

        if (!$kakou_nagare_kbn->delete()) {

            foreach ($kakou_nagare_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "kakou_nagare_kbns",
                'action' => 'search'
            ));

            return;
        }

        $this->flash->success("加工流れ見出し区分の削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "kakou_nagare_kbns",
            'action' => "index"
        ));
    }

    /**
     * Back Out a kakou_nagare_kbn
     *
     * @param string $kakou_nagare_kbn, $dlt_flg
     */
    public function _bakOut($kakou_nagare_kbn, $dlt_flg = 0)
    {

        $bak_kakou_nagare_kbn = new BakKakouNagareKbns();
        foreach ($kakou_nagare_kbn as $fld => $value) {
            $bak_kakou_nagare_kbn->$fld = $kakou_nagare_kbn->$fld;
        }
        $bak_kakou_nagare_kbn->id = NULL;
        $bak_kakou_nagare_kbn->id_moto = $kakou_nagare_kbn->id;
        $bak_kakou_nagare_kbn->hikae_dltflg = $dlt_flg;
        $bak_kakou_nagare_kbn->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_kakou_nagare_kbn->hikae_nichiji = date("Y-m-d H:i:s");
        if (!$bak_kakou_nagare_kbn->save()) {
            foreach ($bak_kakou_nagare_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
    }

}
