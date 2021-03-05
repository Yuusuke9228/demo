<?php
 


class UtiwakeKbnsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        ControllerBase::indexCd("UtiwakeKbns", "取引内訳区分"); //簡易検索付き一覧表示
    }

    /**
     * Searches for utiwake_kbns
     */
    public function searchAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Displays the creation form
     */
    public function newAction($id=null, $dataname="UtiwakeKbns")
    {
        $this->view->imax = 0;

        if ($id) {
            $nameDts = $dataname;
            $utiwake_kbn = $nameDts::findFirstByid($id);
            if (!$utiwake_kbn) {
                $this->flash->error("取引内訳区分が見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "utiwake_kbns",
                    'action' => 'index'
                ));

                return;
            }
            $this->_setDefault($utiwake_kbn, "new", $dataname);
            $this->tag->setDefault("id", null);
            $this->tag->setDefault("cd", null);
        }

    }

    /**
     * 修正画面から「次へ」ボタンを押したら次のコードの修正画面になる。
     */
    public function nextAction($id)
    {
        ControllerBase::nextCd($id, "utiwake_kbns", "UtiwakeKbns", "取引内訳区分");
    }

    /**
     * 修正画面から「前へ」ボタンを押したら前のコードの修正画面になる。
     */
    public function prevAction($id)
    {
        ControllerBase::prevCd($id, "utiwake_kbns", "UtiwakeKbns", "取引内訳区分");
    }

    /**
     * Edits a utiwake_kbn
     *
     * @param string $id
     */
    public function editAction($id)
    {
//        if (!$this->request->isPost()) {

            $utiwake_kbn = UtiwakeKbns::findFirstByid($id);
            if (!$utiwake_kbn) {
                $this->flash->error("取引内訳区分が見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "utiwake_kbns",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->id = $utiwake_kbn->id;

            $this->_setDefault($utiwake_kbn, "edit");
//        }
    }

    /**
     * 画面に表示するデータをセットする
     */
    public function _setDefault($utiwake_kbn, $action="edit", $meisai="UtiwakeKbns")
    {
        $setdts = ["id",
            "cd",
            "name",
            "bikou",
            "juchuu_flg",
            "hacchuu_flg",
            "uriage_flg",
            "shiire_flg",
            "uriage_zaiko_flg",
            "shiire_zaiko_flg",
            "uriage_azukari_flg",
            "shiire_azukari_flg",
            "juchuu_zan_flg",
            "hacchuu_zan_flg",
            "yayoi_kbn",
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
            if (property_exists($utiwake_kbn, $setdt)) {
                $this->tag->setDefault($setdt, $utiwake_kbn->$setdt);
            }
        }
    }

    /**
     * Creates a new utiwake_kbn
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "utiwake_kbns",
                'action' => 'index'
            ));

            return;
        }

        $utiwake_kbn = new UtiwakeKbns();

        $post_flds = [];
        $post_flds = ["cd",
            "name",
            "bikou",
            "juchuu_flg",
            "hacchuu_flg",
            "uriage_flg",
            "shiire_flg",
            "uriage_zaiko_flg",
            "shiire_zaiko_flg",
            "uriage_azukari_flg",
            "shiire_azukari_flg",
            "juchuu_zan_flg",
            "hacchuu_zan_flg",
            "yayoi_kbn",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        foreach ($post_flds as $post_fld) {
            $utiwake_kbn->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$utiwake_kbn->save()) {
            foreach ($utiwake_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "utiwake_kbns",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("取引内訳区分の作成が完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "utiwake_kbns",
            'action' => 'edit',
            'params' => array($utiwake_kbn->id)
        ));
    }

    /**
     * Saves a utiwake_kbn edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "utiwake_kbns",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $utiwake_kbn = UtiwakeKbns::findFirstByid($id);

        if (!$utiwake_kbn) {
            $this->flash->error("取引内訳区分が見つからなくなりました。" . $id);

            $this->dispatcher->forward(array(
                'controller' => "utiwake_kbns",
                'action' => 'index'
            ));

            return;
        }

        if ($utiwake_kbn->updated !== $this->request->getPost("updated")) {
            $this->flash->error("他のプロセスから取引内訳区分が変更されたため更新を中止しました。"
                . $id . ",uid=" . $utiwake_kbn->kousin_user_id . " tb=" . $utiwake_kbn->updated ." pt=" . $this->request->getPost("updated"));

            $this->dispatcher->forward(array(
                'controller' => "utiwake_kbns",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $post_flds = [];
        $post_flds = ["cd",
            "name",
            "bikou",
            "juchuu_flg",
            "hacchuu_flg",
            "uriage_flg",
            "shiire_flg",
            "uriage_zaiko_flg",
            "shiire_zaiko_flg",
            "uriage_azukari_flg",
            "shiire_azukari_flg",
            "juchuu_zan_flg",
            "hacchuu_zan_flg",
            "yayoi_kbn",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        $chg_flg = 0;
        foreach ($post_flds as $post_fld) {
            if ((array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld)) !== $utiwake_kbn->$post_fld) {
                $chg_flg = 1;
                break;
            }
        }
        if ($chg_flg === 0) {
            $this->flash->error("変更がありません。" . $id);

            $this->dispatcher->forward(array(
                "controller" => "utiwake_kbns",
                "action" => "edit",
                "params" => array($utiwake_kbn->id)
            ));

            return;
        }

        $this->_bakOut($utiwake_kbn);

        foreach ($post_flds as $post_fld) {
            $utiwake_kbn->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$utiwake_kbn->save()) {

            foreach ($utiwake_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "utiwake_kbns",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $this->flash->success("取引内訳区分の情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "utiwake_kbns",
            'action' => 'edit',
            'params' => array($utiwake_kbn->id)
        ));
    }

    /**
     * Deletes a utiwake_kbn
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $utiwake_kbn = UtiwakeKbns::findFirstByid($id);
        if (!$utiwake_kbn) {
            $this->flash->error("取引内訳区分が見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "utiwake_kbns",
                'action' => 'index'
            ));

            return;
        }

        $this->_bakOut($utiwake_kbn, 1);

        if (!$utiwake_kbn->delete()) {

            foreach ($utiwake_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "utiwake_kbns",
                'action' => 'search'
            ));

            return;
        }

        $this->flash->success("取引内訳区分の削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "utiwake_kbns",
            'action' => "index"
        ));
    }

    /**
     * Back Out a utiwake_kbn
     *
     * @param string $utiwake_kbn, $dlt_flg
     */
    public function _bakOut($utiwake_kbn, $dlt_flg = 0)
    {

        $bak_utiwake_kbn = new BakUtiwakeKbns();
        foreach ($utiwake_kbn as $fld => $value) {
            $bak_utiwake_kbn->$fld = $utiwake_kbn->$fld;
        }
        $bak_utiwake_kbn->id = NULL;
        $bak_utiwake_kbn->id_moto = $utiwake_kbn->id;
        $bak_utiwake_kbn->hikae_dltflg = $dlt_flg;
        $bak_utiwake_kbn->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_utiwake_kbn->hikae_nichiji = date("Y-m-d H:i:s");
        if (!$bak_utiwake_kbn->save()) {
            foreach ($bak_utiwake_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
    }

}
