<?php
 


class ShukkinMeisaiDtsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        ControllerBase::indexCd("ShukkinMeisaiDts", "出金明細"); //簡易検索付き一覧表示
    }

    /**
     * Searches for shukkin_meisai_dts
     */
    public function searchAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Displays the creation form
     */
    public function newAction($id=null, $dataname="ShukkinMeisaiDts")
    {
        $this->view->imax = 0;

        if ($id) {
            $nameDts = $dataname;
            $shukkin_meisai_dt = $nameDts::findFirstByid($id);
            if (!$shukkin_meisai_dt) {
                $this->flash->error("出金明細が見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "shukkin_meisai_dts",
                    'action' => 'index'
                ));

                return;
            }
            $this->_setDefault($shukkin_meisai_dt, "new", $dataname);
            $this->tag->setDefault("id", null);
            $this->tag->setDefault("cd", null);
        }

    }

    /**
     * 修正画面から「次へ」ボタンを押したら次のコードの修正画面になる。
     */
    public function nextAction($id)
    {
        ControllerBase::nextCd($id, "shukkin_meisai_dts", "ShukkinMeisaiDts", "出金明細");
    }

    /**
     * 修正画面から「前へ」ボタンを押したら前のコードの修正画面になる。
     */
    public function prevAction($id)
    {
        ControllerBase::prevCd($id, "shukkin_meisai_dts", "ShukkinMeisaiDts", "出金明細");
    }

    /**
     * Edits a shukkin_meisai_dt
     *
     * @param string $id
     */
    public function editAction($id)
    {
//        if (!$this->request->isPost()) {

            $shukkin_meisai_dt = ShukkinMeisaiDts::findFirstByid($id);
            if (!$shukkin_meisai_dt) {
                $this->flash->error("出金明細が見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "shukkin_meisai_dts",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->id = $shukkin_meisai_dt->id;

            $this->_setDefault($shukkin_meisai_dt, "edit");
//        }
    }

    /**
     * 画面に表示するデータをセットする
     */
    public function _setDefault($shukkin_meisai_dt, $action="edit", $meisai="ShukkinMeisaiDts")
    {
        $setdts = ["id",
            "cd",
            "name",
            "shukkin_dt_id",
            "shiharai_kbn_cd",
            "tegata_kijitu",
            "kingaku",
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
            if (property_exists($shukkin_meisai_dt, $setdt)) {
                $this->tag->setDefault($setdt, $shukkin_meisai_dt->$setdt);
            }
        }
    }

    /**
     * Creates a new shukkin_meisai_dt
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "shukkin_meisai_dts",
                'action' => 'index'
            ));

            return;
        }

        $shukkin_meisai_dt = new ShukkinMeisaiDts();

        $post_flds = [];
        $post_flds = ["cd",
            "name",
            "shukkin_dt_id",
            "shiharai_kbn_cd",
            "tegata_kijitu",
            "kingaku",
            "bikou",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        foreach ($post_flds as $post_fld) {
            $shukkin_meisai_dt->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$shukkin_meisai_dt->save()) {
            foreach ($shukkin_meisai_dt->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "shukkin_meisai_dts",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("出金明細の作成が完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "shukkin_meisai_dts",
            'action' => 'edit',
            'params' => array($shukkin_meisai_dt->id)
        ));
    }

    /**
     * Saves a shukkin_meisai_dt edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "shukkin_meisai_dts",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $shukkin_meisai_dt = ShukkinMeisaiDts::findFirstByid($id);

        if (!$shukkin_meisai_dt) {
            $this->flash->error("出金明細が見つからなくなりました。" . $id);

            $this->dispatcher->forward(array(
                'controller' => "shukkin_meisai_dts",
                'action' => 'index'
            ));

            return;
        }

        if ($shukkin_meisai_dt->updated !== $this->request->getPost("updated")) {
            $this->flash->error("他のプロセスから出金明細が変更されたため更新を中止しました。"
                . $id . ",uid=" . $shukkin_meisai_dt->kousin_user_id . " tb=" . $shukkin_meisai_dt->updated ." pt=" . $this->request->getPost("updated"));

            $this->dispatcher->forward(array(
                'controller' => "shukkin_meisai_dts",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $post_flds = [];
        $post_flds = ["cd",
            "name",
            "shukkin_dt_id",
            "shiharai_kbn_cd",
            "tegata_kijitu",
            "kingaku",
            "bikou",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        $chg_flg = 0;
        foreach ($post_flds as $post_fld) {
            if ((array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld)) !== $shukkin_meisai_dt->$post_fld) {
                $chg_flg = 1;
                break;
            }
        }
        if ($chg_flg === 0) {
            $this->flash->error("変更がありません。" . $id);

            $this->dispatcher->forward(array(
                "controller" => "shukkin_meisai_dts",
                "action" => "edit",
                "params" => array($shukkin_meisai_dt->id)
            ));

            return;
        }

        $this->_bakOut($shukkin_meisai_dt);

        foreach ($post_flds as $post_fld) {
            $shukkin_meisai_dt->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$shukkin_meisai_dt->save()) {

            foreach ($shukkin_meisai_dt->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "shukkin_meisai_dts",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $this->flash->success("出金明細の情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "shukkin_meisai_dts",
            'action' => 'edit',
            'params' => array($shukkin_meisai_dt->id)
        ));
    }

    /**
     * Deletes a shukkin_meisai_dt
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $shukkin_meisai_dt = ShukkinMeisaiDts::findFirstByid($id);
        if (!$shukkin_meisai_dt) {
            $this->flash->error("出金明細が見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "shukkin_meisai_dts",
                'action' => 'index'
            ));

            return;
        }

        $this->_bakOut($shukkin_meisai_dt, 1);

        if (!$shukkin_meisai_dt->delete()) {

            foreach ($shukkin_meisai_dt->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "shukkin_meisai_dts",
                'action' => 'search'
            ));

            return;
        }

        $this->flash->success("出金明細の削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "shukkin_meisai_dts",
            'action' => "index"
        ));
    }

    /**
     * Back Out a shukkin_meisai_dt
     *
     * @param string $shukkin_meisai_dt, $dlt_flg
     */
    public function _bakOut($shukkin_meisai_dt, $dlt_flg = 0)
    {

        $bak_shukkin_meisai_dt = new BakShukkinMeisaiDts();
        foreach ($shukkin_meisai_dt as $fld => $value) {
            $bak_shukkin_meisai_dt->$fld = $shukkin_meisai_dt->$fld;
        }
        $bak_shukkin_meisai_dt->id = NULL;
        $bak_shukkin_meisai_dt->id_moto = $shukkin_meisai_dt->id;
        $bak_shukkin_meisai_dt->hikae_dltflg = $dlt_flg;
        $bak_shukkin_meisai_dt->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_shukkin_meisai_dt->hikae_nichiji = date("Y-m-d H:i:s");
        if (!$bak_shukkin_meisai_dt->save()) {
            foreach ($bak_shukkin_meisai_dt->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
    }

}
