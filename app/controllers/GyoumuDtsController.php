<?php



class GyoumuDtsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        ControllerBase::indexCd("GyoumuDts", "業務データ"); //簡易検索付き一覧表示
    }

    /**
     * Searches for gyoumu_dts
     */
    public function searchAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Displays the creation form
     */
    public function newAction($id=null, $dataname="GyoumuDts")
    {
        $this->view->imax = 0;

        if ($id) {
            $nameDts = $dataname;
            $gyoumu_dt = $nameDts::findFirstByid($id);
            if (!$gyoumu_dt) {
                $this->flash->error("業務データが見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "gyoumu_dts",
                    'action' => 'index'
                ));

                return;
            }
            $this->_setDefault($gyoumu_dt, "new", $dataname);
            $this->tag->setDefault("id", null);
            $this->tag->setDefault("cd", null);
        }

    }

    /**
     * 修正画面から「次へ」ボタンを押したら次のコードの修正画面になる。
     */
    public function nextAction($id)
    {
        ControllerBase::nextCd($id, "gyoumu_dts", "GyoumuDts", "業務データ");
    }

    /**
     * 修正画面から「前へ」ボタンを押したら前のコードの修正画面になる。
     */
    public function prevAction($id)
    {
        ControllerBase::prevCd($id, "gyoumu_dts", "GyoumuDts", "業務データ");
    }

    /**
     * Edits a gyoumu_dt
     *
     * @param string $id
     */
    public function editAction($id)
    {
//        if (!$this->request->isPost()) {

            $gyoumu_dt = GyoumuDts::findFirstByid($id);
            if (!$gyoumu_dt) {
                $this->flash->error("業務データが見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "gyoumu_dts",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->id = $gyoumu_dt->id;

            $this->_setDefault($gyoumu_dt, "edit");
//        }
    }

    /**
     * 画面に表示するデータをセットする
     */
    public function _setDefault($gyoumu_dt, $action="edit", $meisai="GyoumuDts")
    {
        $setdts = ["id",
            "denpyou_mr_id",
            "cd",
            "hakkoubi",
            "nendo",
            "tekiyou",
            "zeiritu_tekiyoubi",
            "tokuisaki_mr_cd",
            "tokuisaki_name",
            "gotantousha",
            "keishou",
            "tel",
            "fax",
            "torihiki_kbn_cd",
            "zei_tenka_kbn_cd",
            "tantou_mr_cd",
            "shimekiri_flg",
            "nounyuu_kijitu",
            "nounyuusaki_mr_cd",
            "nounyuusaki",
            "kidukesaki_mr_cd",
            "kiduke",
            "kenmei",
            "nouki_memo",
            "nounyuu_basho",
            "torihiki_houhou",
            "yuukou_kigen",
            "kingaku_meishou",
            "saki_hacchuu_cd",
            "mitumori_dt_id",
            "juchuu_dt_id",
            "hacchuu_dt_id",
            "keikaku_meisai_id",
            "sasizu_jun",
            "shiiresaki_mr_cd",
            "hassousaki_kbn_cd",
            "hassousaki_mr_cd",
            "hassousaki",
            "shukkabi",
            "tanka_shurui_kbn_cd",
            "kaishuu_yoteibi",
            "seikyuusho_dt_cd",
            "keshikomi_flg",
            "irai_kbn_cd",
            "souko_mr_cd",
            "assistant",
            "sasizu_dt_cd",
            "moto_souko_mr_cd",
            "moto_tantou_mr_cd",
            "shounin_joutai_flg",
            "shounin_sha_mr_cd",
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
            if (property_exists($gyoumu_dt, $setdt)) {
                $this->tag->setDefault($setdt, $gyoumu_dt->$setdt);
            }
        }
    }

    /**
     * Creates a new gyoumu_dt
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "gyoumu_dts",
                'action' => 'index'
            ));

            return;
        }

        $gyoumu_dt = new GyoumuDts();

        $post_flds = ["denpyou_mr_id",
            "cd",
            "hakkoubi",
            "nendo",
            "tekiyou",
            "zeiritu_tekiyoubi",
            "tokuisaki_mr_cd",
            "tokuisaki_name",
            "gotantousha",
            "keishou",
            "tel",
            "fax",
            "torihiki_kbn_cd",
            "zei_tenka_kbn_cd",
            "tantou_mr_cd",
            "shimekiri_flg",
            "nounyuu_kijitu",
            "nounyuusaki_mr_cd",
            "nounyuusaki",
            "kidukesaki_mr_cd",
            "kiduke",
            "kenmei",
            "nouki_memo",
            "nounyuu_basho",
            "torihiki_houhou",
            "yuukou_kigen",
            "kingaku_meishou",
            "saki_hacchuu_cd",
            "mitumori_dt_id",
            "juchuu_dt_id",
            "hacchuu_dt_id",
            "keikaku_meisai_id",
            "sasizu_jun",
            "shiiresaki_mr_cd",
            "hassousaki_kbn_cd",
            "hassousaki_mr_cd",
            "hassousaki",
            "shukkabi",
            "tanka_shurui_kbn_cd",
            "kaishuu_yoteibi",
            "seikyuusho_dt_cd",
            "keshikomi_flg",
            "irai_kbn_cd",
            "souko_mr_cd",
            "assistant",
            "sasizu_dt_cd",
            "moto_souko_mr_cd",
            "moto_tantou_mr_cd",
            "shounin_joutai_flg",
            "shounin_sha_mr_cd",
            "updated",
            ];


        foreach ($post_flds as $post_fld) {
            $gyoumu_dt->$post_fld = $this->request->getPost($post_fld);
        }

        if (!$gyoumu_dt->save()) {
            foreach ($gyoumu_dt->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "gyoumu_dts",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("業務データの作成が完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "gyoumu_dts",
            'action' => 'edit',
            'params' => array($gyoumu_dt->id)
        ));
    }

    /**
     * Saves a gyoumu_dt edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "gyoumu_dts",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $gyoumu_dt = GyoumuDts::findFirstByid($id);

        if (!$gyoumu_dt) {
            $this->flash->error("業務データが見つからなくなりました。" . $id);

            $this->dispatcher->forward(array(
                'controller' => "gyoumu_dts",
                'action' => 'index'
            ));

            return;
        }

        if ($gyoumu_dt->updated !== $this->request->getPost("updated")) {
            $this->flash->error("他のプロセスから業務データが変更されたため更新を中止しました。"
                . $id . ",uid=" . $gyoumu_dt->kousin_user_id . " tb=" . $gyoumu_dt->updated ." pt=" . $this->request->getPost("updated"));

            $this->dispatcher->forward(array(
                'controller' => "gyoumu_dts",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $post_flds = ["denpyou_mr_id",
            "cd",
            "hakkoubi",
            "nendo",
            "tekiyou",
            "zeiritu_tekiyoubi",
            "tokuisaki_mr_cd",
            "tokuisaki_name",
            "gotantousha",
            "keishou",
            "tel",
            "fax",
            "torihiki_kbn_cd",
            "zei_tenka_kbn_cd",
            "tantou_mr_cd",
            "shimekiri_flg",
            "nounyuu_kijitu",
            "nounyuusaki_mr_cd",
            "nounyuusaki",
            "kidukesaki_mr_cd",
            "kiduke",
            "kenmei",
            "nouki_memo",
            "nounyuu_basho",
            "torihiki_houhou",
            "yuukou_kigen",
            "kingaku_meishou",
            "saki_hacchuu_cd",
            "mitumori_dt_id",
            "juchuu_dt_id",
            "hacchuu_dt_id",
            "keikaku_meisai_id",
            "sasizu_jun",
            "shiiresaki_mr_cd",
            "hassousaki_kbn_cd",
            "hassousaki_mr_cd",
            "hassousaki",
            "shukkabi",
            "tanka_shurui_kbn_cd",
            "kaishuu_yoteibi",
            "seikyuusho_dt_cd",
            "keshikomi_flg",
            "irai_kbn_cd",
            "souko_mr_cd",
            "assistant",
            "sasizu_dt_cd",
            "moto_souko_mr_cd",
            "moto_tantou_mr_cd",
            "shounin_joutai_flg",
            "shounin_sha_mr_cd",
            "updated",
            ];


        $chg_flg = 0;
        foreach ($post_flds as $post_fld) {
            if ($this->request->getPost($post_fld) !== $gyoumu_dt->$post_fld) {
                $chg_flg = 1;
                break;
            }
        }
        if ($chg_flg === 0) {
            $this->flash->error("変更がありません。" . $id);

            $this->dispatcher->forward(array(
                "controller" => "gyoumu_dts",
                "action" => "edit",
                "params" => array($gyoumu_dt->id)
            ));

            return;
        }

        $this->_bakOut($gyoumu_dt, 0);

        $thisPost=[];
        foreach ($post_flds as $post_fld) {
            $gyoumu_dt->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$gyoumu_dt->save()) {

            foreach ($gyoumu_dt->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "gyoumu_dts",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $this->flash->success("業務データの情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "gyoumu_dts",
            'action' => 'edit',
            'params' => array($gyoumu_dt->id)
        ));
    }

    /**
     * Deletes a gyoumu_dt
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $gyoumu_dt = GyoumuDts::findFirstByid($id);
        if (!$gyoumu_dt) {
            $this->flash->error("業務データが見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "gyoumu_dts",
                'action' => 'index'
            ));

            return;
        }

        if (!$gyoumu_dt->delete()) {

            foreach ($gyoumu_dt->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "gyoumu_dts",
                'action' => 'search'
            ));

            return;
        }

        $this->_bakOut($gyoumu_dt, 1);

        $this->flash->success("業務データの削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "gyoumu_dts",
            'action' => "index"
        ));
    }

    /**
     * Back Out a gyoumu_dt
     *
     * @param string $gyoumu_dt, $dlt_flg
     */
    public function _bakOut($gyoumu_dt, $dlt_flg = 0)
    {

        $bak_gyoumu_dt = new BakGyoumuDts();
        foreach ($gyoumu_dt as $fld => $value) {
            $bak_gyoumu_dt->$fld = $gyoumu_dt->$fld;
        }
        $bak_gyoumu_dt->id = NULL;
        $bak_gyoumu_dt->id_moto = $gyoumu_dt->id;
        $bak_gyoumu_dt->hikae_dltflg = $dlt_flg;
        $bak_gyoumu_dt->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_gyoumu_dt->hikae_nichiji = date("Y-m-d H:i:s");
        if (!$bak_gyoumu_dt->save()) {
            foreach ($bak_gyoumu_dt->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
    }

}
