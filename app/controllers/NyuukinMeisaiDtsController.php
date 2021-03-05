<?php
 


class NyuukinMeisaiDtsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        ControllerBase::indexCd("NyuukinMeisaiDts", "入金明細"); //簡易検索付き一覧表示
    }

    /**
     * Searches for nyuukin_meisai_dts
     */
    public function searchAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Displays the creation form
     */
    public function newAction($id=null, $dataname="NyuukinMeisaiDts")
    {
        $this->view->imax = 0;

        if ($id) {
            $nameDts = $dataname;
            $nyuukin_meisai_dt = $nameDts::findFirstByid($id);
            if (!$nyuukin_meisai_dt) {
                $this->flash->error("入金明細が見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "nyuukin_meisai_dts",
                    'action' => 'index'
                ));

                return;
            }
            $this->_setDefault($nyuukin_meisai_dt, "new", $dataname);
            $this->tag->setDefault("id", null);
            $this->tag->setDefault("cd", null);
        }

    }

    /**
     * 修正画面から「次へ」ボタンを押したら次のコードの修正画面になる。
     */
    public function nextAction($id)
    {
        ControllerBase::nextCd($id, "nyuukin_meisai_dts", "NyuukinMeisaiDts", "入金明細");
    }

    /**
     * 修正画面から「前へ」ボタンを押したら前のコードの修正画面になる。
     */
    public function prevAction($id)
    {
        ControllerBase::prevCd($id, "nyuukin_meisai_dts", "NyuukinMeisaiDts", "入金明細");
    }

    /**
     * Edits a nyuukin_meisai_dt
     *
     * @param string $id
     */
    public function editAction($id)
    {
//        if (!$this->request->isPost()) {

            $nyuukin_meisai_dt = NyuukinMeisaiDts::findFirstByid($id);
            if (!$nyuukin_meisai_dt) {
                $this->flash->error("入金明細が見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "nyuukin_meisai_dts",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->id = $nyuukin_meisai_dt->id;

            $this->_setDefault($nyuukin_meisai_dt, "edit");
//        }
    }

    /**
     * 画面に表示するデータをセットする
     */
    public function _setDefault($nyuukin_meisai_dt, $action="edit", $meisai="NyuukinMeisaiDts")
    {
        $setdts = ["id",
            "cd",
            "name",
            "nyuukin_dt_id",
            "nyuukin_kbn_cd",
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
            if (property_exists($nyuukin_meisai_dt, $setdt)) {
                $this->tag->setDefault($setdt, $nyuukin_meisai_dt->$setdt);
            }
        }
    }

    /**
     * Creates a new nyuukin_meisai_dt
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "nyuukin_meisai_dts",
                'action' => 'index'
            ));

            return;
        }

        $nyuukin_meisai_dt = new NyuukinMeisaiDts();

        $post_flds = [];
        $post_flds = ["cd",
            "name",
            "nyuukin_dt_id",
            "nyuukin_kbn_cd",
            "tegata_kijitu",
            "kingaku",
            "bikou",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        foreach ($post_flds as $post_fld) {
            $nyuukin_meisai_dt->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$nyuukin_meisai_dt->save()) {
            foreach ($nyuukin_meisai_dt->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "nyuukin_meisai_dts",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("入金明細の作成が完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "nyuukin_meisai_dts",
            'action' => 'edit',
            'params' => array($nyuukin_meisai_dt->id)
        ));
    }

    /**
     * Saves a nyuukin_meisai_dt edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "nyuukin_meisai_dts",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $nyuukin_meisai_dt = NyuukinMeisaiDts::findFirstByid($id);

        if (!$nyuukin_meisai_dt) {
            $this->flash->error("入金明細が見つからなくなりました。" . $id);

            $this->dispatcher->forward(array(
                'controller' => "nyuukin_meisai_dts",
                'action' => 'index'
            ));

            return;
        }

        if ($nyuukin_meisai_dt->updated !== $this->request->getPost("updated")) {
            $this->flash->error("他のプロセスから入金明細が変更されたため更新を中止しました。"
                . $id . ",uid=" . $nyuukin_meisai_dt->kousin_user_id . " tb=" . $nyuukin_meisai_dt->updated ." pt=" . $this->request->getPost("updated"));

            $this->dispatcher->forward(array(
                'controller' => "nyuukin_meisai_dts",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $post_flds = [];
        $post_flds = ["cd",
            "name",
            "nyuukin_dt_id",
            "nyuukin_kbn_cd",
            "tegata_kijitu",
            "kingaku",
            "bikou",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        $chg_flg = 0;
        foreach ($post_flds as $post_fld) {
            if ((array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld)) !== $nyuukin_meisai_dt->$post_fld) {
                $chg_flg = 1;
                break;
            }
        }
        if ($chg_flg === 0) {
            $this->flash->error("変更がありません。" . $id);

            $this->dispatcher->forward(array(
                "controller" => "nyuukin_meisai_dts",
                "action" => "edit",
                "params" => array($nyuukin_meisai_dt->id)
            ));

            return;
        }

        $this->_bakOut($nyuukin_meisai_dt);

        foreach ($post_flds as $post_fld) {
            $nyuukin_meisai_dt->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$nyuukin_meisai_dt->save()) {

            foreach ($nyuukin_meisai_dt->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "nyuukin_meisai_dts",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $this->flash->success("入金明細の情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "nyuukin_meisai_dts",
            'action' => 'edit',
            'params' => array($nyuukin_meisai_dt->id)
        ));
    }

    /**
     * Deletes a nyuukin_meisai_dt
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $nyuukin_meisai_dt = NyuukinMeisaiDts::findFirstByid($id);
        if (!$nyuukin_meisai_dt) {
            $this->flash->error("入金明細が見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "nyuukin_meisai_dts",
                'action' => 'index'
            ));

            return;
        }

        $this->_bakOut($nyuukin_meisai_dt, 1);

        if (!$nyuukin_meisai_dt->delete()) {

            foreach ($nyuukin_meisai_dt->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "nyuukin_meisai_dts",
                'action' => 'search'
            ));

            return;
        }

        $this->flash->success("入金明細の削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "nyuukin_meisai_dts",
            'action' => "index"
        ));
    }

    /**
     * Back Out a nyuukin_meisai_dt
     *
     * @param string $nyuukin_meisai_dt, $dlt_flg
     */
    public function _bakOut($nyuukin_meisai_dt, $dlt_flg = 0)
    {

        $bak_nyuukin_meisai_dt = new BakNyuukinMeisaiDts();
        foreach ($nyuukin_meisai_dt as $fld => $value) {
            $bak_nyuukin_meisai_dt->$fld = $nyuukin_meisai_dt->$fld;
        }
        $bak_nyuukin_meisai_dt->id = NULL;
        $bak_nyuukin_meisai_dt->id_moto = $nyuukin_meisai_dt->id;
        $bak_nyuukin_meisai_dt->hikae_dltflg = $dlt_flg;
        $bak_nyuukin_meisai_dt->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_nyuukin_meisai_dt->hikae_nichiji = date("Y-m-d H:i:s");
        if (!$bak_nyuukin_meisai_dt->save()) {
            foreach ($bak_nyuukin_meisai_dt->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
    }

}