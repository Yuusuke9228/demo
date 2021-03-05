<?php
 


class ZaikoHenkanMeisaiDtsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        ControllerBase::indexCd("ZaikoHenkanMeisaiDts", "在庫変換明細データ"); //簡易検索付き一覧表示
    }

    /**
     * Searches for zaiko_henkan_meisai_dts
     */
    public function searchAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Displays the creation form
     */
    public function new1Action($id=null, $dataname="ZaikoHenkanMeisaiDts")
    {
        $this->view->imax = 0;

        if ($id) {
            $nameDts = $dataname;
            $zaiko_henkan_meisai_dt = $nameDts::findFirstByid($id);
            if (!$zaiko_henkan_meisai_dt) {
                $this->flash->error("在庫変換明細データが見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "zaiko_henkan_meisai_dts",
                    'action' => 'index'
                ));

                return;
            }
            $this->_setDefault($zaiko_henkan_meisai_dt, "new", $dataname);
            $this->tag->setDefault("id", null);
            $this->tag->setDefault("cd", null);
        }

    }

    /**
     * 修正画面から「次へ」ボタンを押したら次のコードの修正画面になる。
     */
    public function nextAction($id)
    {
        ControllerBase::nextCd($id, "zaiko_henkan_meisai_dts", "ZaikoHenkanMeisaiDts", "在庫変換明細データ");
    }

    /**
     * 修正画面から「前へ」ボタンを押したら前のコードの修正画面になる。
     */
    public function prevAction($id)
    {
        ControllerBase::prevCd($id, "zaiko_henkan_meisai_dts", "ZaikoHenkanMeisaiDts", "在庫変換明細データ");
    }

    /**
     * Edits a zaiko_henkan_meisai_dt
     *
     * @param string $id
     */
    public function editAction($id)
    {
//        if (!$this->request->isPost()) {

            $zaiko_henkan_meisai_dt = ZaikoHenkanMeisaiDts::findFirstByid($id);
            if (!$zaiko_henkan_meisai_dt) {
                $this->flash->error("在庫変換明細データが見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "zaiko_henkan_meisai_dts",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->id = $zaiko_henkan_meisai_dt->id;

            $this->_setDefault($zaiko_henkan_meisai_dt, "edit");
//        }
    }

    /**
     * 画面に表示するデータをセットする
     */
    public function _setDefault($zaiko_henkan_meisai_dt, $action="edit", $meisai="ZaikoHenkanMeisaiDts")
    {
        $setdts = ["id",
            "cd",
            "bikou",
            "zaiko_henkan_dt_id",
            "henkansaki_flg",
            "tantou_mr_cd",
            "shouhin_mr_cd",
            "tanni_mr_cd",
            "kousei",
            "irisuu",
            "keisu",
            "tekiyou",
            "lot",
            "kobetucd",
            "hinsitu_kbn_cd",
            "souko_mr_cd",
            "kikaku",
            "iro",
            "size",
            "suuryou",
            "tanka",
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
            if (property_exists($zaiko_henkan_meisai_dt, $setdt)) {
                $this->tag->setDefault($setdt, $zaiko_henkan_meisai_dt->$setdt);
            }
        }
    }

    /**
     * Creates a new zaiko_henkan_meisai_dt
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "zaiko_henkan_meisai_dts",
                'action' => 'index'
            ));

            return;
        }

        $zaiko_henkan_meisai_dt = new ZaikoHenkanMeisaiDts();

        $post_flds = [];
        $post_flds = ["cd",
            "bikou",
            "zaiko_henkan_dt_id",
            "henkansaki_flg",
            "tantou_mr_cd",
            "shouhin_mr_cd",
            "tanni_mr_cd",
            "kousei",
            "irisuu",
            "keisu",
            "tekiyou",
            "lot",
            "kobetucd",
            "hinsitu_kbn_cd",
            "souko_mr_cd",
            "kikaku",
            "iro",
            "size",
            "suuryou",
            "tanka",
            "kingaku",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        foreach ($post_flds as $post_fld) {
            $zaiko_henkan_meisai_dt->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$zaiko_henkan_meisai_dt->save()) {
            foreach ($zaiko_henkan_meisai_dt->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "zaiko_henkan_meisai_dts",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("在庫変換明細データの作成が完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "zaiko_henkan_meisai_dts",
            'action' => 'edit',
            'params' => array($zaiko_henkan_meisai_dt->id)
        ));
    }

    /**
     * Saves a zaiko_henkan_meisai_dt edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "zaiko_henkan_meisai_dts",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $zaiko_henkan_meisai_dt = ZaikoHenkanMeisaiDts::findFirstByid($id);

        if (!$zaiko_henkan_meisai_dt) {
            $this->flash->error("在庫変換明細データが見つからなくなりました。" . $id);

            $this->dispatcher->forward(array(
                'controller' => "zaiko_henkan_meisai_dts",
                'action' => 'index'
            ));

            return;
        }

        if ($zaiko_henkan_meisai_dt->updated !== $this->request->getPost("updated")) {
            $this->flash->error("他のプロセスから在庫変換明細データが変更されたため更新を中止しました。"
                . $id . ",uid=" . $zaiko_henkan_meisai_dt->kousin_user_id . " tb=" . $zaiko_henkan_meisai_dt->updated ." pt=" . $this->request->getPost("updated"));

            $this->dispatcher->forward(array(
                'controller' => "zaiko_henkan_meisai_dts",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $post_flds = [];
        $post_flds = ["cd",
            "bikou",
            "zaiko_henkan_dt_id",
            "henkansaki_flg",
            "tantou_mr_cd",
            "shouhin_mr_cd",
            "tanni_mr_cd",
            "kousei",
            "irisuu",
            "keisu",
            "tekiyou",
            "lot",
            "kobetucd",
            "hinsitu_kbn_cd",
            "souko_mr_cd",
            "kikaku",
            "iro",
            "size",
            "suuryou",
            "tanka",
            "kingaku",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        $chg_flg = 0;
        foreach ($post_flds as $post_fld) {
            if ((array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld)) !== $zaiko_henkan_meisai_dt->$post_fld) {
                $chg_flg = 1;
                break;
            }
        }
        if ($chg_flg === 0) {
            $this->flash->error("変更がありません。" . $id);

            $this->dispatcher->forward(array(
                "controller" => "zaiko_henkan_meisai_dts",
                "action" => "edit",
                "params" => array($zaiko_henkan_meisai_dt->id)
            ));

            return;
        }

        $this->_bakOut($zaiko_henkan_meisai_dt);

        foreach ($post_flds as $post_fld) {
            $zaiko_henkan_meisai_dt->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$zaiko_henkan_meisai_dt->save()) {

            foreach ($zaiko_henkan_meisai_dt->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "zaiko_henkan_meisai_dts",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $this->flash->success("在庫変換明細データの情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "zaiko_henkan_meisai_dts",
            'action' => 'edit',
            'params' => array($zaiko_henkan_meisai_dt->id)
        ));
    }

    /**
     * Deletes a zaiko_henkan_meisai_dt
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $zaiko_henkan_meisai_dt = ZaikoHenkanMeisaiDts::findFirstByid($id);
        if (!$zaiko_henkan_meisai_dt) {
            $this->flash->error("在庫変換明細データが見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "zaiko_henkan_meisai_dts",
                'action' => 'index'
            ));

            return;
        }

        $this->_bakOut($zaiko_henkan_meisai_dt, 1);

        if (!$zaiko_henkan_meisai_dt->delete()) {

            foreach ($zaiko_henkan_meisai_dt->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "zaiko_henkan_meisai_dts",
                'action' => 'search'
            ));

            return;
        }

        $this->flash->success("在庫変換明細データの削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "zaiko_henkan_meisai_dts",
            'action' => "index"
        ));
    }

    /**
     * Back Out a zaiko_henkan_meisai_dt
     *
     * @param string $zaiko_henkan_meisai_dt, $dlt_flg
     */
    public function _bakOut($zaiko_henkan_meisai_dt, $dlt_flg = 0)
    {

        $bak_zaiko_henkan_meisai_dt = new BakZaikoHenkanMeisaiDts();
        foreach ($zaiko_henkan_meisai_dt as $fld => $value) {
            $bak_zaiko_henkan_meisai_dt->$fld = $zaiko_henkan_meisai_dt->$fld;
        }
        $bak_zaiko_henkan_meisai_dt->id = NULL;
        $bak_zaiko_henkan_meisai_dt->id_moto = $zaiko_henkan_meisai_dt->id;
        $bak_zaiko_henkan_meisai_dt->hikae_dltflg = $dlt_flg;
        $bak_zaiko_henkan_meisai_dt->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_zaiko_henkan_meisai_dt->hikae_nichiji = date("Y-m-d H:i:s");
        if (!$bak_zaiko_henkan_meisai_dt->save()) {
            foreach ($bak_zaiko_henkan_meisai_dt->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
    }

    /*
     * 伝票明細行削除処理 Test中
     * トリガー未定
     * 井浦さんに要相談
     * 実際に明細を消してしまうのでコメントアウト    西山
     */
    public function ajaxDeleteAction()
    {
        header("Content-type: text/plain; charset=UTF-8");
        $this->view->disable();
        $response = new \Phalcon\Http\Response();
        if (!$this->request->isAjax()) {
            echo "is not Ajax !! ";
        }
        if (!$this->request->isPost()) {
            echo "is not Post !! ";
        }
        $id = $this->request->getPost('del_id');
        //$id = $obj['id'];
        /*
        $zaiko_henkan_meisai_dt = ZaikoHenkanMeisaiDts::findFirstByid($id);
        if (!$zaiko_henkan_meisai_dt) {
            $this->flash->error("在庫変換明細データが見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "zaiko_henkan_meisai_dts",
                'action' => 'index'
            ));
            return;
        }

        $this->_bakOut($zaiko_henkan_meisai_dt, 1);

        if (!$zaiko_henkan_meisai_dt->delete()) {

            foreach ($zaiko_henkan_meisai_dt->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "zaiko_henkan_meisai_dts",
                'action' => 'search'
            ));

            return;
        }
        */
        //Set the content of the response*/
        $response->setContent(json_encode($id));
        //Return the response
        return $response;
    }
}
