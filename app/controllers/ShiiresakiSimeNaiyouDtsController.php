<?php
 


class ShiiresakiSimeNaiyouDtsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        ControllerBase::indexCd("ShiiresakiSimeNaiyouDts", "仕入先締内容データ"); //簡易検索付き一覧表示
    }

    /**
     * Searches for shiiresaki_sime_naiyou_dts
     */
    public function searchAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Displays the creation form
     */
    public function newAction($id=null, $dataname="ShiiresakiSimeNaiyouDts")
    {
        $this->view->imax = 0;

        if ($id) {
            $nameDts = $dataname;
            $shiiresaki_sime_naiyou_dt = $nameDts::findFirstByid($id);
            if (!$shiiresaki_sime_naiyou_dt) {
                $this->flash->error("仕入先締内容データが見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "shiiresaki_sime_naiyou_dts",
                    'action' => 'index'
                ));

                return;
            }
            $this->_setDefault($shiiresaki_sime_naiyou_dt, "new", $dataname);
            $this->tag->setDefault("id", null);
            $this->tag->setDefault("cd", null);
        }

    }

    /**
     * 修正画面から「次へ」ボタンを押したら次のコードの修正画面になる。
     */
    public function nextAction($id)
    {
        ControllerBase::nextCd($id, "shiiresaki_sime_naiyou_dts", "ShiiresakiSimeNaiyouDts", "仕入先締内容データ");
    }

    /**
     * 修正画面から「前へ」ボタンを押したら前のコードの修正画面になる。
     */
    public function prevAction($id)
    {
        ControllerBase::prevCd($id, "shiiresaki_sime_naiyou_dts", "ShiiresakiSimeNaiyouDts", "仕入先締内容データ");
    }

    /**
     * Edits a shiiresaki_sime_naiyou_dt
     *
     * @param string $id
     */
    public function editAction($id)
    {
//        if (!$this->request->isPost()) {

            $shiiresaki_sime_naiyou_dt = ShiiresakiSimeNaiyouDts::findFirstByid($id);
            if (!$shiiresaki_sime_naiyou_dt) {
                $this->flash->error("仕入先締内容データが見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "shiiresaki_sime_naiyou_dts",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->id = $shiiresaki_sime_naiyou_dt->id;

            $this->_setDefault($shiiresaki_sime_naiyou_dt, "edit");
//        }
    }

    /**
     * 画面に表示するデータをセットする
     */
    public function _setDefault($shiiresaki_sime_naiyou_dt, $action="edit", $meisai="ShiiresakiSimeNaiyouDts")
    {
        $setdts = ["id",
            "cd",
            "name",
            "shiharai_kbn_cd",
            "kingaku",
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
            if (property_exists($shiiresaki_sime_naiyou_dt, $setdt)) {
                $this->tag->setDefault($setdt, $shiiresaki_sime_naiyou_dt->$setdt);
            }
        }
    }

    /**
     * Creates a new shiiresaki_sime_naiyou_dt
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "shiiresaki_sime_naiyou_dts",
                'action' => 'index'
            ));

            return;
        }

        $shiiresaki_sime_naiyou_dt = new ShiiresakiSimeNaiyouDts();

        $post_flds = [];
        $post_flds = ["cd",
            "name",
            "shiharai_kbn_cd",
            "kingaku",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        foreach ($post_flds as $post_fld) {
            $shiiresaki_sime_naiyou_dt->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$shiiresaki_sime_naiyou_dt->save()) {
            foreach ($shiiresaki_sime_naiyou_dt->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "shiiresaki_sime_naiyou_dts",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("仕入先締内容データの作成が完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "shiiresaki_sime_naiyou_dts",
            'action' => 'edit',
            'params' => array($shiiresaki_sime_naiyou_dt->id)
        ));
    }

    /**
     * Saves a shiiresaki_sime_naiyou_dt edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "shiiresaki_sime_naiyou_dts",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $shiiresaki_sime_naiyou_dt = ShiiresakiSimeNaiyouDts::findFirstByid($id);

        if (!$shiiresaki_sime_naiyou_dt) {
            $this->flash->error("仕入先締内容データが見つからなくなりました。" . $id);

            $this->dispatcher->forward(array(
                'controller' => "shiiresaki_sime_naiyou_dts",
                'action' => 'index'
            ));

            return;
        }

        if ($shiiresaki_sime_naiyou_dt->updated !== $this->request->getPost("updated")) {
            $this->flash->error("他のプロセスから仕入先締内容データが変更されたため更新を中止しました。"
                . $id . ",uid=" . $shiiresaki_sime_naiyou_dt->kousin_user_id . " tb=" . $shiiresaki_sime_naiyou_dt->updated ." pt=" . $this->request->getPost("updated"));

            $this->dispatcher->forward(array(
                'controller' => "shiiresaki_sime_naiyou_dts",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $post_flds = [];
        $post_flds = ["cd",
            "name",
            "shiharai_kbn_cd",
            "kingaku",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        $chg_flg = 0;
        foreach ($post_flds as $post_fld) {
            if ((array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld)) !== $shiiresaki_sime_naiyou_dt->$post_fld) {
                $chg_flg = 1;
                break;
            }
        }
        if ($chg_flg === 0) {
            $this->flash->error("変更がありません。" . $id);

            $this->dispatcher->forward(array(
                "controller" => "shiiresaki_sime_naiyou_dts",
                "action" => "edit",
                "params" => array($shiiresaki_sime_naiyou_dt->id)
            ));

            return;
        }

        $this->_bakOut($shiiresaki_sime_naiyou_dt);

        foreach ($post_flds as $post_fld) {
            $shiiresaki_sime_naiyou_dt->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$shiiresaki_sime_naiyou_dt->save()) {

            foreach ($shiiresaki_sime_naiyou_dt->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "shiiresaki_sime_naiyou_dts",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $this->flash->success("仕入先締内容データの情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "shiiresaki_sime_naiyou_dts",
            'action' => 'edit',
            'params' => array($shiiresaki_sime_naiyou_dt->id)
        ));
    }

    /**
     * Deletes a shiiresaki_sime_naiyou_dt
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $shiiresaki_sime_naiyou_dt = ShiiresakiSimeNaiyouDts::findFirstByid($id);
        if (!$shiiresaki_sime_naiyou_dt) {
            $this->flash->error("仕入先締内容データが見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "shiiresaki_sime_naiyou_dts",
                'action' => 'index'
            ));

            return;
        }

        $this->_bakOut($shiiresaki_sime_naiyou_dt, 1);

        if (!$shiiresaki_sime_naiyou_dt->delete()) {

            foreach ($shiiresaki_sime_naiyou_dt->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "shiiresaki_sime_naiyou_dts",
                'action' => 'search'
            ));

            return;
        }

        $this->flash->success("仕入先締内容データの削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "shiiresaki_sime_naiyou_dts",
            'action' => "index"
        ));
    }

    /**
     * Back Out a shiiresaki_sime_naiyou_dt
     *
     * @param string $shiiresaki_sime_naiyou_dt, $dlt_flg
     */
    public function _bakOut($shiiresaki_sime_naiyou_dt, $dlt_flg = 0)
    {

        $bak_shiiresaki_sime_naiyou_dt = new BakShiiresakiSimeNaiyouDts();
        foreach ($shiiresaki_sime_naiyou_dt as $fld => $value) {
            $bak_shiiresaki_sime_naiyou_dt->$fld = $shiiresaki_sime_naiyou_dt->$fld;
        }
        $bak_shiiresaki_sime_naiyou_dt->id = NULL;
        $bak_shiiresaki_sime_naiyou_dt->id_moto = $shiiresaki_sime_naiyou_dt->id;
        $bak_shiiresaki_sime_naiyou_dt->hikae_dltflg = $dlt_flg;
        $bak_shiiresaki_sime_naiyou_dt->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_shiiresaki_sime_naiyou_dt->hikae_nichiji = date("Y-m-d H:i:s");
        if (!$bak_shiiresaki_sime_naiyou_dt->save()) {
            foreach ($bak_shiiresaki_sime_naiyou_dt->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
    }

}