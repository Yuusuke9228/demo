<?php
 


class GyoumuMeisaiDtsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        ControllerBase::indexCd("GyoumuMeisaiDts", "業務明細データ"); //簡易検索付き一覧表示
    }

    /**
     * Searches for gyoumu_meisai_dts
     */
    public function searchAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Displays the creation form
     */
    public function newAction($id=null, $dataname="GyoumuMeisaiDts")
    {
        $this->view->imax = 0;

        if ($id) {
            $nameDts = $dataname;
            $gyoumu_meisai_dt = $nameDts::findFirstByid($id);
            if (!$gyoumu_meisai_dt) {
                $this->flash->error("業務明細データが見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "gyoumu_meisai_dts",
                    'action' => 'index'
                ));

                return;
            }
            $this->_setDefault($gyoumu_meisai_dt, "new", $dataname);
            $this->tag->setDefault("id", null);
            $this->tag->setDefault("cd", null);
        }

    }

    /**
     * 修正画面から「次へ」ボタンを押したら次のコードの修正画面になる。
     */
    public function nextAction($id)
    {
        ControllerBase::nextCd($id, "gyoumu_meisai_dts", "GyoumuMeisaiDts", "業務明細データ");
    }

    /**
     * 修正画面から「前へ」ボタンを押したら前のコードの修正画面になる。
     */
    public function prevAction($id)
    {
        ControllerBase::prevCd($id, "gyoumu_meisai_dts", "GyoumuMeisaiDts", "業務明細データ");
    }

    /**
     * Edits a gyoumu_meisai_dt
     *
     * @param string $id
     */
    public function editAction($id)
    {
//        if (!$this->request->isPost()) {

            $gyoumu_meisai_dt = GyoumuMeisaiDts::findFirstByid($id);
            if (!$gyoumu_meisai_dt) {
                $this->flash->error("業務明細データが見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "gyoumu_meisai_dts",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->id = $gyoumu_meisai_dt->id;

            $this->_setDefault($gyoumu_meisai_dt, "edit");
//        }
    }

    /**
     * 画面に表示するデータをセットする
     */
    public function _setDefault($gyoumu_meisai_dt, $action="edit", $meisai="GyoumuMeisaiDts")
    {
        $setdts = ["id",
            "cd",
            "utiwake_kbn_cd",
            "gyoumu_dt_id",
            "kousei",
            "kaisou",
            "oya_meisai_cd",
            "chuumon_kanryoubi",
            "zaiko_kanryoubi",
            "shouhin_mr_cd",
            "tekiyou",
            "lot",
            "iro",
            "iromei",
            "kobetucd",
            "hinsitu_kbn_cd",
            "souko_mr_cd",
            "tanaban",
            "barcode",
            "tantou_mr_cd",
            "suuryou",
            "keisu",
            "irisuu",
            "tanni_mr1_cd",
            "tanni_mr2_cd",
            "juch_zan_ryou1",
            "juch_zan_ryou2",
            "hach_zan_ryou1",
            "hach_zan_ryou2",
            "zaiko_henka_ryou1",
            "zaiko_henka_ryou2",
            "azu_henka_ryou1",
            "azu_henka_ryou2",
            "mitu_ryou1",
            "mitu_ryou2",
            "juch_ryou1",
            "juch_ryou2",
            "hach_ryou1",
            "hach_ryou2",
            "shiire_ryou1",
            "shiire_ryou2",
            "uriage_ryou1",
            "uriage_ryou2",
            "shukkairai_ryou1",
            "shukkairai_ryou2",
            "idou_ryou1",
            "idou_ryou2",
            "zaiko_kbn",
            "tanka_kbn",
            "gentanka",
            "tanka",
            "kingaku",
            "genkagaku",
            "zeinukigaku",
            "zeigaku",
            "project_mr_cd",
            "zeiritu_mr_cd",
            "bikou",
            "nouki",
            "oya_meisai_id",
            "shouhin_kakou_cd",
            "h_kishu_mr_cd",
            "gouki",
            "juchuu_nasi_flg",
            "moto_juch_ryou1",
            "moto_juch_ryou2",
            "zaikoseisan_ryou1",
            "zaikoseisan_ryou2",
            "loss_ryou1",
            "loss_ryou2",
            "keikaku_ryou1",
            "keikaku_ryou2",
            "kagi",
            "kouritu",
            "kouritu_tanni",
            "heiretu_suu",
            "kadou_nissuu",
            "kaisi_hiduke",
            "shuuryou_hiduke",
            "json_params",
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
            if (property_exists($gyoumu_meisai_dt, $setdt)) {
                $this->tag->setDefault($setdt, $gyoumu_meisai_dt->$setdt);
            }
        }
    }

    /**
     * Creates a new gyoumu_meisai_dt
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "gyoumu_meisai_dts",
                'action' => 'index'
            ));

            return;
        }

        $gyoumu_meisai_dt = new GyoumuMeisaiDts();

        $post_flds = ["cd",
            "utiwake_kbn_cd",
            "gyoumu_dt_id",
            "kousei",
            "kaisou",
            "oya_meisai_cd",
            "chuumon_kanryoubi",
            "zaiko_kanryoubi",
            "shouhin_mr_cd",
            "tekiyou",
            "lot",
            "iro",
            "iromei",
            "kobetucd",
            "hinsitu_kbn_cd",
            "souko_mr_cd",
            "tanaban",
            "barcode",
            "tantou_mr_cd",
            "suuryou",
            "keisu",
            "irisuu",
            "tanni_mr1_cd",
            "tanni_mr2_cd",
            "juch_zan_ryou1",
            "juch_zan_ryou2",
            "hach_zan_ryou1",
            "hach_zan_ryou2",
            "zaiko_henka_ryou1",
            "zaiko_henka_ryou2",
            "azu_henka_ryou1",
            "azu_henka_ryou2",
            "mitu_ryou1",
            "mitu_ryou2",
            "juch_ryou1",
            "juch_ryou2",
            "hach_ryou1",
            "hach_ryou2",
            "shiire_ryou1",
            "shiire_ryou2",
            "uriage_ryou1",
            "uriage_ryou2",
            "shukkairai_ryou1",
            "shukkairai_ryou2",
            "idou_ryou1",
            "idou_ryou2",
            "zaiko_kbn",
            "tanka_kbn",
            "gentanka",
            "tanka",
            "kingaku",
            "genkagaku",
            "zeinukigaku",
            "zeigaku",
            "project_mr_cd",
            "zeiritu_mr_cd",
            "bikou",
            "nouki",
            "oya_meisai_id",
            "shouhin_kakou_cd",
            "h_kishu_mr_cd",
            "gouki",
            "juchuu_nasi_flg",
            "moto_juch_ryou1",
            "moto_juch_ryou2",
            "zaikoseisan_ryou1",
            "zaikoseisan_ryou2",
            "loss_ryou1",
            "loss_ryou2",
            "keikaku_ryou1",
            "keikaku_ryou2",
            "kagi",
            "kouritu",
            "kouritu_tanni",
            "heiretu_suu",
            "kadou_nissuu",
            "kaisi_hiduke",
            "shuuryou_hiduke",
            "json_params",
            "updated",
            ];
        

        foreach ($post_flds as $post_fld) {
            $gyoumu_meisai_dt->$post_fld = $this->request->getPost($post_fld);
        }

        if (!$gyoumu_meisai_dt->save()) {
            foreach ($gyoumu_meisai_dt->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "gyoumu_meisai_dts",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("業務明細データの作成が完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "gyoumu_meisai_dts",
            'action' => 'edit',
            'params' => array($gyoumu_meisai_dt->id)
        ));
    }

    /**
     * Saves a gyoumu_meisai_dt edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "gyoumu_meisai_dts",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $gyoumu_meisai_dt = GyoumuMeisaiDts::findFirstByid($id);

        if (!$gyoumu_meisai_dt) {
            $this->flash->error("業務明細データが見つからなくなりました。" . $id);

            $this->dispatcher->forward(array(
                'controller' => "gyoumu_meisai_dts",
                'action' => 'index'
            ));

            return;
        }

        if ($gyoumu_meisai_dt->updated !== $this->request->getPost("updated")) {
            $this->flash->error("他のプロセスから業務明細データが変更されたため更新を中止しました。"
                . $id . ",uid=" . $gyoumu_meisai_dt->kousin_user_id . " tb=" . $gyoumu_meisai_dt->updated ." pt=" . $this->request->getPost("updated"));

            $this->dispatcher->forward(array(
                'controller' => "gyoumu_meisai_dts",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $post_flds = ["cd",
            "utiwake_kbn_cd",
            "gyoumu_dt_id",
            "kousei",
            "kaisou",
            "oya_meisai_cd",
            "chuumon_kanryoubi",
            "zaiko_kanryoubi",
            "shouhin_mr_cd",
            "tekiyou",
            "lot",
            "iro",
            "iromei",
            "kobetucd",
            "hinsitu_kbn_cd",
            "souko_mr_cd",
            "tanaban",
            "barcode",
            "tantou_mr_cd",
            "suuryou",
            "keisu",
            "irisuu",
            "tanni_mr1_cd",
            "tanni_mr2_cd",
            "juch_zan_ryou1",
            "juch_zan_ryou2",
            "hach_zan_ryou1",
            "hach_zan_ryou2",
            "zaiko_henka_ryou1",
            "zaiko_henka_ryou2",
            "azu_henka_ryou1",
            "azu_henka_ryou2",
            "mitu_ryou1",
            "mitu_ryou2",
            "juch_ryou1",
            "juch_ryou2",
            "hach_ryou1",
            "hach_ryou2",
            "shiire_ryou1",
            "shiire_ryou2",
            "uriage_ryou1",
            "uriage_ryou2",
            "shukkairai_ryou1",
            "shukkairai_ryou2",
            "idou_ryou1",
            "idou_ryou2",
            "zaiko_kbn",
            "tanka_kbn",
            "gentanka",
            "tanka",
            "kingaku",
            "genkagaku",
            "zeinukigaku",
            "zeigaku",
            "project_mr_cd",
            "zeiritu_mr_cd",
            "bikou",
            "nouki",
            "oya_meisai_id",
            "shouhin_kakou_cd",
            "h_kishu_mr_cd",
            "gouki",
            "juchuu_nasi_flg",
            "moto_juch_ryou1",
            "moto_juch_ryou2",
            "zaikoseisan_ryou1",
            "zaikoseisan_ryou2",
            "loss_ryou1",
            "loss_ryou2",
            "keikaku_ryou1",
            "keikaku_ryou2",
            "kagi",
            "kouritu",
            "kouritu_tanni",
            "heiretu_suu",
            "kadou_nissuu",
            "kaisi_hiduke",
            "shuuryou_hiduke",
            "json_params",
            "updated",
            ];
        

        $chg_flg = 0;
        foreach ($post_flds as $post_fld) {
            if ($this->request->getPost($post_fld) !== $gyoumu_meisai_dt->$post_fld) {
                $chg_flg = 1;
                break;
            }
        }
        if ($chg_flg === 0) {
            $this->flash->error("変更がありません。" . $id);

            $this->dispatcher->forward(array(
                "controller" => "gyoumu_meisai_dts",
                "action" => "edit",
                "params" => array($gyoumu_meisai_dt->id)
            ));

            return;
        }

        $this->_bakOut($gyoumu_meisai_dt, 0);

        $thisPost=[];
        foreach ($post_flds as $post_fld) {
            $gyoumu_meisai_dt->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$gyoumu_meisai_dt->save()) {

            foreach ($gyoumu_meisai_dt->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "gyoumu_meisai_dts",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $this->flash->success("業務明細データの情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "gyoumu_meisai_dts",
            'action' => 'edit',
            'params' => array($gyoumu_meisai_dt->id)
        ));
    }

    /**
     * Deletes a gyoumu_meisai_dt
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $gyoumu_meisai_dt = GyoumuMeisaiDts::findFirstByid($id);
        if (!$gyoumu_meisai_dt) {
            $this->flash->error("業務明細データが見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "gyoumu_meisai_dts",
                'action' => 'index'
            ));

            return;
        }

        if (!$gyoumu_meisai_dt->delete()) {

            foreach ($gyoumu_meisai_dt->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "gyoumu_meisai_dts",
                'action' => 'search'
            ));

            return;
        }

        $this->_bakOut($gyoumu_meisai_dt, 1);

        $this->flash->success("業務明細データの削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "gyoumu_meisai_dts",
            'action' => "index"
        ));
    }

    /**
     * Back Out a gyoumu_meisai_dt
     *
     * @param string $gyoumu_meisai_dt, $dlt_flg
     */
    public function _bakOut($gyoumu_meisai_dt, $dlt_flg = 0)
    {

        $bak_gyoumu_meisai_dt = new BakGyoumuMeisaiDts();
        foreach ($gyoumu_meisai_dt as $fld => $value) {
            $bak_gyoumu_meisai_dt->$fld = $gyoumu_meisai_dt->$fld;
        }
        $bak_gyoumu_meisai_dt->id = NULL;
        $bak_gyoumu_meisai_dt->id_moto = $gyoumu_meisai_dt->id;
        $bak_gyoumu_meisai_dt->hikae_dltflg = $dlt_flg;
        $bak_gyoumu_meisai_dt->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_gyoumu_meisai_dt->hikae_nichiji = date("Y-m-d H:i:s");
        if (!$bak_gyoumu_meisai_dt->save()) {
            foreach ($bak_gyoumu_meisai_dt->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
    }

}
