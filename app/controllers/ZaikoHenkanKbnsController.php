<?php
 


class ZaikoHenkanKbnsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        ControllerBase::indexCd("ZaikoHenkanKbns", "在庫変換区分"); //簡易検索付き一覧表示
    }

    /**
     * Searches for zaiko_henkan_kbns
     */
    public function searchAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Displays the creation form
     */
    public function newAction($id=null, $dataname="ZaikoHenkanKbns")
    {
        $this->view->imax = 0;

        if ($id) {
            $nameDts = $dataname;
            $zaiko_henkan_kbn = $nameDts::findFirstByid($id);
            if (!$zaiko_henkan_kbn) {
                $this->flash->error("在庫変換区分が見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "zaiko_henkan_kbns",
                    'action' => 'index'
                ));

                return;
            }
            $this->_setDefault($zaiko_henkan_kbn, "new", $dataname);
            $this->tag->setDefault("id", null);
            $this->tag->setDefault("cd", null);
        }

    }

    /**
     * 修正画面から「次へ」ボタンを押したら次のコードの修正画面になる。
     */
    public function nextAction($id)
    {
        ControllerBase::nextCd($id, "zaiko_henkan_kbns", "ZaikoHenkanKbns", "在庫変換区分");
    }

    /**
     * 修正画面から「前へ」ボタンを押したら前のコードの修正画面になる。
     */
    public function prevAction($id)
    {
        ControllerBase::prevCd($id, "zaiko_henkan_kbns", "ZaikoHenkanKbns", "在庫変換区分");
    }

    /**
     * Edits a zaiko_henkan_kbn
     *
     * @param string $id
     */
    public function editAction($id)
    {
//        if (!$this->request->isPost()) {

            $zaiko_henkan_kbn = ZaikoHenkanKbns::findFirstByid($id);
            if (!$zaiko_henkan_kbn) {
                $this->flash->error("在庫変換区分が見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "zaiko_henkan_kbns",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->id = $zaiko_henkan_kbn->id;

            $this->_setDefault($zaiko_henkan_kbn, "edit");
//        }
    }

    /**
     * 画面に表示するデータをセットする
     */
    public function _setDefault($zaiko_henkan_kbn, $action="edit", $meisai="ZaikoHenkanKbns")
    {
        $setdts = ["id",
            "cd",
            "name",
            "denpyou_mr_cd",
            "shiire_flg",
            "nyuuko_flg",
            "uriage_flg",
            "shukko_flg",
            "azuchou_flg",
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
            if (property_exists($zaiko_henkan_kbn, $setdt)) {
                $this->tag->setDefault($setdt, $zaiko_henkan_kbn->$setdt);
            }
        }
    }

    /**
     * Creates a new zaiko_henkan_kbn
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "zaiko_henkan_kbns",
                'action' => 'index'
            ));

            return;
        }

        $zaiko_henkan_kbn = new ZaikoHenkanKbns();

        $post_flds = [];
        $post_flds = ["cd",
            "name",
            "denpyou_mr_cd",
            "shiire_flg",
            "nyuuko_flg",
            "uriage_flg",
            "shukko_flg",
            "azuchou_flg",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        foreach ($post_flds as $post_fld) {
            $zaiko_henkan_kbn->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$zaiko_henkan_kbn->save()) {
            foreach ($zaiko_henkan_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "zaiko_henkan_kbns",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("在庫変換区分の作成が完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "zaiko_henkan_kbns",
            'action' => 'edit',
            'params' => array($zaiko_henkan_kbn->id)
        ));
    }

    /**
     * Saves a zaiko_henkan_kbn edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "zaiko_henkan_kbns",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $zaiko_henkan_kbn = ZaikoHenkanKbns::findFirstByid($id);

        if (!$zaiko_henkan_kbn) {
            $this->flash->error("在庫変換区分が見つからなくなりました。" . $id);

            $this->dispatcher->forward(array(
                'controller' => "zaiko_henkan_kbns",
                'action' => 'index'
            ));

            return;
        }

        if ($zaiko_henkan_kbn->updated !== $this->request->getPost("updated")) {
            $this->flash->error("他のプロセスから在庫変換区分が変更されたため更新を中止しました。"
                . $id . ",uid=" . $zaiko_henkan_kbn->kousin_user_id . " tb=" . $zaiko_henkan_kbn->updated ." pt=" . $this->request->getPost("updated"));

            $this->dispatcher->forward(array(
                'controller' => "zaiko_henkan_kbns",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $post_flds = [];
        $post_flds = ["cd",
            "name",
            "denpyou_mr_cd",
            "shiire_flg",
            "nyuuko_flg",
            "uriage_flg",
            "shukko_flg",
            "azuchou_flg",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        $chg_flg = 0;
        foreach ($post_flds as $post_fld) {
            if ((array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld)) !== $zaiko_henkan_kbn->$post_fld) {
                $chg_flg = 1;
                break;
            }
        }
        if ($chg_flg === 0) {
            $this->flash->error("変更がありません。" . $id);

            $this->dispatcher->forward(array(
                "controller" => "zaiko_henkan_kbns",
                "action" => "edit",
                "params" => array($zaiko_henkan_kbn->id)
            ));

            return;
        }

        $this->_bakOut($zaiko_henkan_kbn);

        foreach ($post_flds as $post_fld) {
            $zaiko_henkan_kbn->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$zaiko_henkan_kbn->save()) {

            foreach ($zaiko_henkan_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "zaiko_henkan_kbns",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $this->flash->success("在庫変換区分の情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "zaiko_henkan_kbns",
            'action' => 'edit',
            'params' => array($zaiko_henkan_kbn->id)
        ));
    }

    /**
     * Deletes a zaiko_henkan_kbn
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $zaiko_henkan_kbn = ZaikoHenkanKbns::findFirstByid($id);
        if (!$zaiko_henkan_kbn) {
            $this->flash->error("在庫変換区分が見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "zaiko_henkan_kbns",
                'action' => 'index'
            ));

            return;
        }

        $this->_bakOut($zaiko_henkan_kbn, 1);

        if (!$zaiko_henkan_kbn->delete()) {

            foreach ($zaiko_henkan_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "zaiko_henkan_kbns",
                'action' => 'search'
            ));

            return;
        }

        $this->flash->success("在庫変換区分の削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "zaiko_henkan_kbns",
            'action' => "index"
        ));
    }

    /**
     * Back Out a zaiko_henkan_kbn
     *
     * @param string $zaiko_henkan_kbn, $dlt_flg
     */
    public function _bakOut($zaiko_henkan_kbn, $dlt_flg = 0)
    {

        $bak_zaiko_henkan_kbn = new BakZaikoHenkanKbns();
        foreach ($zaiko_henkan_kbn as $fld => $value) {
            $bak_zaiko_henkan_kbn->$fld = $zaiko_henkan_kbn->$fld;
        }
        $bak_zaiko_henkan_kbn->id = NULL;
        $bak_zaiko_henkan_kbn->id_moto = $zaiko_henkan_kbn->id;
        $bak_zaiko_henkan_kbn->hikae_dltflg = $dlt_flg;
        $bak_zaiko_henkan_kbn->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_zaiko_henkan_kbn->hikae_nichiji = date("Y-m-d H:i:s");
        if (!$bak_zaiko_henkan_kbn->save()) {
            foreach ($bak_zaiko_henkan_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
    }

}
