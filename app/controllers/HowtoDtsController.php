<?php
 


class HowtoDtsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        ControllerBase::indexCd("HowtoDts", "ハウツーデータ"); //簡易検索付き一覧表示
    }

    /**
     * Searches for howto_dts
     */
    public function searchAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Displays the creation form
     */
    public function newAction($id=null, $dataname="HowtoDts")
    {
        $this->view->imax = 0;

        if ($id) {
            $nameDts = $dataname;
            $howto_dt = $nameDts::findFirstByid($id);
            if (!$howto_dt) {
                $this->flash->error("ハウツーデータが見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "howto_dts",
                    'action' => 'index'
                ));

                return;
            }
            $this->_setDefault($howto_dt, "new", $dataname);
            $this->tag->setDefault("id", null);
            $this->tag->setDefault("cd", null);
        }

    }

    /**
     * 修正画面から「次へ」ボタンを押したら次のコードの修正画面になる。
     */
    public function nextAction($id)
    {
        ControllerBase::nextCd($id, "howto_dts", "HowtoDts", "ハウツーデータ");
    }

    /**
     * 修正画面から「前へ」ボタンを押したら前のコードの修正画面になる。
     */
    public function prevAction($id)
    {
        ControllerBase::prevCd($id, "howto_dts", "HowtoDts", "ハウツーデータ");
    }

    /**
     * Edits a howto_dt
     *
     * @param string $id
     */
    public function editAction($id)
    {
//        if (!$this->request->isPost()) {

            $howto_dt = HowtoDts::findFirstByid($id);
            if (!$howto_dt) {
                $this->flash->error("ハウツーデータが見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "howto_dts",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->id = $howto_dt->id;

            $this->_setDefault($howto_dt, "edit");
//        }
    }

    /**
     * 画面に表示するデータをセットする
     */
    public function _setDefault($howto_dt, $action="edit", $meisai="HowtoDts")
    {
        $setdts = ["id",
            "cd",
            "name",
            "bikou",
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
            if (property_exists($howto_dt, $setdt)) {
                $this->tag->setDefault($setdt, $howto_dt->$setdt);
            }
        }
        $this->tag->setDefault('kousin_user_name', $howto_dt->KousinUsers->name);
        $this->tag->setDefault('sakusei_user_name', $howto_dt->SakuseiUsers->name);
    }

    /**
     * Creates a new howto_dt
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "howto_dts",
                'action' => 'index'
            ));

            return;
        }

        $howto_dt = new HowtoDts();

        $post_flds = [];
        $post_flds = ["cd",
            "name",
            "bikou",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        foreach ($post_flds as $post_fld) {
            $howto_dt->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$howto_dt->save()) {
            foreach ($howto_dt->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "howto_dts",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("ハウツーデータの作成が完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "howto_dts",
            'action' => 'edit',
            'params' => array($howto_dt->id)
        ));
    }

    /**
     * Saves a howto_dt edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "howto_dts",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $howto_dt = HowtoDts::findFirstByid($id);

        if (!$howto_dt) {
            $this->flash->error("ハウツーデータが見つからなくなりました。" . $id);

            $this->dispatcher->forward(array(
                'controller' => "howto_dts",
                'action' => 'index'
            ));

            return;
        }

        if ($howto_dt->updated !== $this->request->getPost("updated")) {
            $this->flash->error("他のプロセスからハウツーデータが変更されたため更新を中止しました。"
                . $id . ",uid=" . $howto_dt->kousin_user_id . " tb=" . $howto_dt->updated ." pt=" . $this->request->getPost("updated"));

            $this->dispatcher->forward(array(
                'controller' => "howto_dts",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $post_flds = [];
        $post_flds = ["cd",
            "name",
            "bikou",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        $chg_flg = 0;
        foreach ($post_flds as $post_fld) {
            if ((array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld)) !== $howto_dt->$post_fld) {
                $chg_flg = 1;
                break;
            }
        }
        if ($chg_flg === 0) {
            $this->flash->error("変更がありません。" . $id);

            $this->dispatcher->forward(array(
                "controller" => "howto_dts",
                "action" => "edit",
                "params" => array($howto_dt->id)
            ));

            return;
        }

        $this->_bakOut($howto_dt);

        foreach ($post_flds as $post_fld) {
            $howto_dt->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$howto_dt->save()) {

            foreach ($howto_dt->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "howto_dts",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $this->flash->success("ハウツーデータの情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "howto_dts",
            'action' => 'edit',
            'params' => array($howto_dt->id)
        ));
    }

    /**
     * Deletes a howto_dt
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $howto_dt = HowtoDts::findFirstByid($id);
        if (!$howto_dt) {
            $this->flash->error("ハウツーデータが見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "howto_dts",
                'action' => 'index'
            ));

            return;
        }

        $this->_bakOut($howto_dt, 1);

        if (!$howto_dt->delete()) {

            foreach ($howto_dt->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "howto_dts",
                'action' => 'search'
            ));

            return;
        }

        $this->flash->success("ハウツーデータの削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "howto_dts",
            'action' => "index"
        ));
    }

    /**
     * Back Out a howto_dt
     *
     * @param string $howto_dt, $dlt_flg
     */
    public function _bakOut($howto_dt, $dlt_flg = 0)
    {

        $bak_howto_dt = new BakHowtoDts();
        foreach ($howto_dt as $fld => $value) {
            $bak_howto_dt->$fld = $howto_dt->$fld;
        }
        $bak_howto_dt->id = NULL;
        $bak_howto_dt->id_moto = $howto_dt->id;
        $bak_howto_dt->hikae_dltflg = $dlt_flg;
        $bak_howto_dt->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_howto_dt->hikae_nichiji = date("Y-m-d H:i:s");
        if (!$bak_howto_dt->save()) {
            foreach ($bak_howto_dt->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
    }

}
