<?php
 


class ShukkairaiMeisaiDtsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        ControllerBase::indexCd("ShukkairaiMeisaiDts", "出荷依頼明細データ"); //簡易検索付き一覧表示
    }

    /**
     * Searches for shukkairai_meisai_dts
     */
    public function searchAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Displays the creation form
     */
    public function newAction($id=null, $dataname="ShukkairaiMeisaiDts")
    {
        $this->view->imax = 0;

        if ($id) {
            $nameDts = $dataname;
            $shukkairai_meisai_dt = $nameDts::findFirstByid($id);
            if (!$shukkairai_meisai_dt) {
                $this->flash->error("出荷依頼明細データが見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "shukkairai_meisai_dts",
                    'action' => 'index'
                ));

                return;
            }
            $this->_setDefault($shukkairai_meisai_dt, "new", $dataname);
            $this->tag->setDefault("id", null);
            $this->tag->setDefault("cd", null);
        }

    }

    /**
     * 修正画面から「次へ」ボタンを押したら次のコードの修正画面になる。
     */
    public function nextAction($id)
    {
        ControllerBase::nextCd($id, "shukkairai_meisai_dts", "ShukkairaiMeisaiDts", "出荷依頼明細データ");
    }

    /**
     * 修正画面から「前へ」ボタンを押したら前のコードの修正画面になる。
     */
    public function prevAction($id)
    {
        ControllerBase::prevCd($id, "shukkairai_meisai_dts", "ShukkairaiMeisaiDts", "出荷依頼明細データ");
    }

    /**
     * Edits a shukkairai_meisai_dt
     *
     * @param string $id
     */
    public function editAction($id)
    {
//        if (!$this->request->isPost()) {

            $shukkairai_meisai_dt = ShukkairaiMeisaiDts::findFirstByid($id);
            if (!$shukkairai_meisai_dt) {
                $this->flash->error("出荷依頼明細データが見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "shukkairai_meisai_dts",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->id = $shukkairai_meisai_dt->id;

            $this->_setDefault($shukkairai_meisai_dt, "edit");
//        }
    }

    /**
     * 画面に表示するデータをセットする
     */
    public function _setDefault($shukkairai_meisai_dt, $action="edit", $meisai="ShukkairaiMeisaiDts")
    {
        $setdts = ["id",
            "cd",
            "utiwake_kbn_cd",
            "shukkairai_dt_id",
            "shukka_kbn_cd",
            "shouhin_mr_cd",
            "tanni_mr_cd",
            "irisuu",
            "keisu",
            "tekiyou",
            "lot",
            "kobetucd",
            "hinsitu_kbn_cd",
            "souko_mr_cd",
            "kikaku",
            "iro",
            "iromei",
            "size",
            "suuryou",
            "suuryou1",
            "tanni_mr1_cd",
            "suuryou2",
            "tanni_mr2_cd",
            "tanka_kbn",
            "gentanka",
            "genkagaku",
            "nouki",
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
            if (property_exists($shukkairai_meisai_dt, $setdt)) {
                $this->tag->setDefault($setdt, $shukkairai_meisai_dt->$setdt);
            }
        }
    }

    /**
     * Creates a new shukkairai_meisai_dt
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "shukkairai_meisai_dts",
                'action' => 'index'
            ));

            return;
        }

        $shukkairai_meisai_dt = new ShukkairaiMeisaiDts();

        $post_flds = [];
        $post_flds = ["cd",
            "utiwake_kbn_cd",
            "shukkairai_dt_id",
            "shukka_kbn_cd",
            "shouhin_mr_cd",
            "tanni_mr_cd",
            "irisuu",
            "keisu",
            "tekiyou",
            "lot",
            "kobetucd",
            "hinsitu_kbn_cd",
            "souko_mr_cd",
            "kikaku",
            "iro",
            "iromei",
            "size",
            "suuryou",
            "suuryou1",
            "tanni_mr1_cd",
            "suuryou2",
            "tanni_mr2_cd",
            "tanka_kbn",
            "gentanka",
            "genkagaku",
            "nouki",
            "bikou",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        foreach ($post_flds as $post_fld) {
            $shukkairai_meisai_dt->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$shukkairai_meisai_dt->save()) {
            foreach ($shukkairai_meisai_dt->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "shukkairai_meisai_dts",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("出荷依頼明細データの作成が完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "shukkairai_meisai_dts",
            'action' => 'edit',
            'params' => array($shukkairai_meisai_dt->id)
        ));
    }

    /**
     * Saves a shukkairai_meisai_dt edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "shukkairai_meisai_dts",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $shukkairai_meisai_dt = ShukkairaiMeisaiDts::findFirstByid($id);

        if (!$shukkairai_meisai_dt) {
            $this->flash->error("出荷依頼明細データが見つからなくなりました。" . $id);

            $this->dispatcher->forward(array(
                'controller' => "shukkairai_meisai_dts",
                'action' => 'index'
            ));

            return;
        }

        if ($shukkairai_meisai_dt->updated !== $this->request->getPost("updated")) {
            $this->flash->error("他のプロセスから出荷依頼明細データが変更されたため更新を中止しました。"
                . $id . ",uid=" . $shukkairai_meisai_dt->kousin_user_id . " tb=" . $shukkairai_meisai_dt->updated ." pt=" . $this->request->getPost("updated"));

            $this->dispatcher->forward(array(
                'controller' => "shukkairai_meisai_dts",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $post_flds = [];
        $post_flds = ["cd",
            "utiwake_kbn_cd",
            "shukkairai_dt_id",
            "shukka_kbn_cd",
            "shouhin_mr_cd",
            "tanni_mr_cd",
            "irisuu",
            "keisu",
            "tekiyou",
            "lot",
            "kobetucd",
            "hinsitu_kbn_cd",
            "souko_mr_cd",
            "kikaku",
            "iro",
            "iromei",
            "size",
            "suuryou",
            "suuryou1",
            "tanni_mr1_cd",
            "suuryou2",
            "tanni_mr2_cd",
            "tanka_kbn",
            "gentanka",
            "genkagaku",
            "nouki",
            "bikou",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        $chg_flg = 0;
        foreach ($post_flds as $post_fld) {
            if ((array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld)) !== $shukkairai_meisai_dt->$post_fld) {
                $chg_flg = 1;
                break;
            }
        }
        if ($chg_flg === 0) {
            $this->flash->error("変更がありません。" . $id);

            $this->dispatcher->forward(array(
                "controller" => "shukkairai_meisai_dts",
                "action" => "edit",
                "params" => array($shukkairai_meisai_dt->id)
            ));

            return;
        }

        $this->_bakOut($shukkairai_meisai_dt);

        foreach ($post_flds as $post_fld) {
            $shukkairai_meisai_dt->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$shukkairai_meisai_dt->save()) {

            foreach ($shukkairai_meisai_dt->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "shukkairai_meisai_dts",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $this->flash->success("出荷依頼明細データの情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "shukkairai_meisai_dts",
            'action' => 'edit',
            'params' => array($shukkairai_meisai_dt->id)
        ));
    }

    /**
     * Deletes a shukkairai_meisai_dt
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $shukkairai_meisai_dt = ShukkairaiMeisaiDts::findFirstByid($id);
        if (!$shukkairai_meisai_dt) {
            $this->flash->error("出荷依頼明細データが見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "shukkairai_meisai_dts",
                'action' => 'index'
            ));

            return;
        }

        $this->_bakOut($shukkairai_meisai_dt, 1);

        if (!$shukkairai_meisai_dt->delete()) {

            foreach ($shukkairai_meisai_dt->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "shukkairai_meisai_dts",
                'action' => 'search'
            ));

            return;
        }

        $this->flash->success("出荷依頼明細データの削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "shukkairai_meisai_dts",
            'action' => "index"
        ));
    }

    /**
     * Back Out a shukkairai_meisai_dt
     *
     * @param string $shukkairai_meisai_dt, $dlt_flg
     */
    public function _bakOut($shukkairai_meisai_dt, $dlt_flg = 0)
    {

        $bak_shukkairai_meisai_dt = new BakShukkairaiMeisaiDts();
        foreach ($shukkairai_meisai_dt as $fld => $value) {
            $bak_shukkairai_meisai_dt->$fld = $shukkairai_meisai_dt->$fld;
        }
        $bak_shukkairai_meisai_dt->id = NULL;
        $bak_shukkairai_meisai_dt->moto_id = $shukkairai_meisai_dt->id;
        $bak_shukkairai_meisai_dt->hikae_dltflg = $dlt_flg;
        $bak_shukkairai_meisai_dt->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_shukkairai_meisai_dt->hikae_nitiji = date("Y-m-d H:i:s");
        if (!$bak_shukkairai_meisai_dt->save()) {
            foreach ($bak_shukkairai_meisai_dt->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
    }

}
