<?php
 


class HKeikakuMeisaiDtsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        ControllerBase::indexCd("HKeikakuMeisaiDts", "生産計画明細データ"); //簡易検索付き一覧表示
    }

    /**
     * Searches for h_keikaku_meisai_dts
     */
    public function searchAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Displays the creation form
     */
    public function newAction($id=null, $dataname="HKeikakuMeisaiDts")
    {
        $this->view->imax = 0;

        if ($id) {
            $nameDts = $dataname;
            $h_keikaku_meisai_dt = $nameDts::findFirstByid($id);
            if (!$h_keikaku_meisai_dt) {
                $this->flash->error("生産計画明細データが見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "h_keikaku_meisai_dts",
                    'action' => 'index'
                ));

                return;
            }
            $this->_setDefault($h_keikaku_meisai_dt, "new", $dataname);
            $this->tag->setDefault("id", null);
            $this->tag->setDefault("cd", null);
        }

    }

    /**
     * 修正画面から「次へ」ボタンを押したら次のコードの修正画面になる。
     */
    public function nextAction($id)
    {
        ControllerBase::nextCd($id, "h_keikaku_meisai_dts", "HKeikakuMeisaiDts", "生産計画明細データ");
    }

    /**
     * 修正画面から「前へ」ボタンを押したら前のコードの修正画面になる。
     */
    public function prevAction($id)
    {
        ControllerBase::prevCd($id, "h_keikaku_meisai_dts", "HKeikakuMeisaiDts", "生産計画明細データ");
    }

    /**
     * Edits a h_keikaku_meisai_dt
     *
     * @param string $id
     */
    public function editAction($id)
    {
//        if (!$this->request->isPost()) {

            $h_keikaku_meisai_dt = HKeikakuMeisaiDts::findFirstByid($id);
            if (!$h_keikaku_meisai_dt) {
                $this->flash->error("生産計画明細データが見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "h_keikaku_meisai_dts",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->id = $h_keikaku_meisai_dt->id;

            $this->_setDefault($h_keikaku_meisai_dt, "edit");
//        }
    }

    /**
     * 画面に表示するデータをセットする
     */
    public function _setDefault($h_keikaku_meisai_dt, $action="edit", $meisai="HKeikakuMeisaiDts")
    {
        $setdts = [
            "id",
            "h_keikaku_dt_id",
            "cd",
            "juchuu_meisai_dt_id",
            "oya_meisai_id",
            "utiwake_kbn_cd",
            "kaisou",
            "kousei",
            "kakusi_flg",
            "shouhin_mr_cd",
            "tekiyou",
            "lot",
            "iro",
            "iromei",
            "kobetucd",
            "shouhin_kakou_cd",
            "h_kishu_mr_cd",
            "oya_meisai_cd",
            "souko_mr_cd",
            "suuryou",
            "keisu",
            "zaiko_kbn",
            "hituyou_suu1",
            "juchuu_suu1",
            "zaikoseisan_suu1",
            "loss_suu1",
            "deme_suu1",
            "zaikosiyou_suu1",
            "keikaku_suu1",
            "tanni_mr1_cd",
            "hituyou_suu2",
            "juchuu_suu2",
            "zaikoseisan_suu2",
            "loss_suu2",
            "deme_suu2",
            "zaikosiyou_suu2",
            "keikaku_suu2",
            "tanni_mr2_cd",
            "kagi",
            "kouritu",
            "kouritu_tanni",
            "daisuu",
            "kadou_nissuu",
            "kaisi_hiduke",
            "shuuryou_hiduke",
            "bikou",
            "tanka_kbn",
            "koutin_tanka",
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
            if (property_exists($h_keikaku_meisai_dt, $setdt)) {
                $this->tag->setDefault($setdt, $h_keikaku_meisai_dt->$setdt);
            }
        }
    }

    /**
     * Creates a new h_keikaku_meisai_dt
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "h_keikaku_meisai_dts",
                'action' => 'index'
            ));

            return;
        }

        $h_keikaku_meisai_dt = new HKeikakuMeisaiDts();

        $post_flds = [
            "h_keikaku_dt_id",
            "cd",
            "juchuu_meisai_dt_id",
            "oya_meisai_id",
            "utiwake_kbn_cd",
            "kaisou",
            "kousei",
            "kakusi_flg",
            "shouhin_mr_cd",
            "tekiyou",
            "lot",
            "iro",
            "iromei",
            "kobetucd",
            "shouhin_kakou_cd",
            "h_kishu_mr_cd",
            "oya_meisai_cd",
            "souko_mr_cd",
            "suuryou",
            "keisu",
            "zaiko_kbn",
            "hituyou_suu1",
            "juchuu_suu1",
            "zaikoseisan_suu1",
            "loss_suu1",
            "deme_suu1",
            "zaikosiyou_suu1",
            "keikaku_suu1",
            "tanni_mr1_cd",
            "hituyou_suu2",
            "juchuu_suu2",
            "zaikoseisan_suu2",
            "loss_suu2",
            "deme_suu2",
            "zaikosiyou_suu2",
            "keikaku_suu2",
            "tanni_mr2_cd",
            "kagi",
            "kouritu",
            "kouritu_tanni",
            "daisuu",
            "kadou_nissuu",
            "kaisi_hiduke",
            "shuuryou_hiduke",
            "bikou",
            "tanka_kbn",
            "koutin_tanka",
            "updated",
        ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        foreach ($post_flds as $post_fld) {
            $h_keikaku_meisai_dt->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$h_keikaku_meisai_dt->save()) {
            foreach ($h_keikaku_meisai_dt->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "h_keikaku_meisai_dts",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("生産計画明細データの作成が完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "h_keikaku_meisai_dts",
            'action' => 'edit',
            'params' => array($h_keikaku_meisai_dt->id)
        ));
    }

    /**
     * Saves a h_keikaku_meisai_dt edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "h_keikaku_meisai_dts",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $h_keikaku_meisai_dt = HKeikakuMeisaiDts::findFirstByid($id);

        if (!$h_keikaku_meisai_dt) {
            $this->flash->error("生産計画明細データが見つからなくなりました。" . $id);

            $this->dispatcher->forward(array(
                'controller' => "h_keikaku_meisai_dts",
                'action' => 'index'
            ));

            return;
        }

        if ($h_keikaku_meisai_dt->updated !== $this->request->getPost("updated")) {
            $this->flash->error("他のプロセスから生産計画明細データが変更されたため更新を中止しました。"
                . $id . ",uid=" . $h_keikaku_meisai_dt->kousin_user_id . " tb=" . $h_keikaku_meisai_dt->updated ." pt=" . $this->request->getPost("updated"));

            $this->dispatcher->forward(array(
                'controller' => "h_keikaku_meisai_dts",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $post_flds = [
            "h_keikaku_dt_id",
            "cd",
            "juchuu_meisai_dt_id",
            "oya_meisai_id",
            "utiwake_kbn_cd",
            "kaisou",
            "kousei",
            "kakusi_flg",
            "shouhin_mr_cd",
            "tekiyou",
            "lot",
            "iro",
            "iromei",
            "kobetucd",
            "shouhin_kakou_cd",
            "h_kishu_mr_cd",
            "oya_meisai_cd",
            "souko_mr_cd",
            "suuryou",
            "keisu",
            "zaiko_kbn",
            "hituyou_suu1",
            "juchuu_suu1",
            "zaikoseisan_suu1",
            "loss_suu1",
            "deme_suu1",
            "zaikosiyou_suu1",
            "keikaku_suu1",
            "tanni_mr1_cd",
            "hituyou_suu2",
            "juchuu_suu2",
            "zaikoseisan_suu2",
            "loss_suu2",
            "deme_suu2",
            "zaikosiyou_suu2",
            "keikaku_suu2",
            "tanni_mr2_cd",
            "kagi",
            "kouritu",
            "kouritu_tanni",
            "daisuu",
            "kadou_nissuu",
            "kaisi_hiduke",
            "shuuryou_hiduke",
            "bikou",
            "tanka_kbn",
            "koutin_tanka",
            "updated",
        ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        $chg_flg = 0;
        foreach ($post_flds as $post_fld) {
            if ((array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld)) !== $h_keikaku_meisai_dt->$post_fld) {
                $chg_flg = 1;
                break;
            }
        }
        if ($chg_flg === 0) {
            $this->flash->error("変更がありません。" . $id);

            $this->dispatcher->forward(array(
                "controller" => "h_keikaku_meisai_dts",
                "action" => "edit",
                "params" => array($h_keikaku_meisai_dt->id)
            ));

            return;
        }

        $this->_bakOut($h_keikaku_meisai_dt, 0);

        foreach ($post_flds as $post_fld) {
            $h_keikaku_meisai_dt->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$h_keikaku_meisai_dt->save()) {

            foreach ($h_keikaku_meisai_dt->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "h_keikaku_meisai_dts",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $this->flash->success("生産計画明細データの情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "h_keikaku_meisai_dts",
            'action' => 'edit',
            'params' => array($h_keikaku_meisai_dt->id)
        ));
    }

    /**
     * Deletes a h_keikaku_meisai_dt
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $h_keikaku_meisai_dt = HKeikakuMeisaiDts::findFirstByid($id);
        if (!$h_keikaku_meisai_dt) {
            $this->flash->error("生産計画明細データが見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "h_keikaku_meisai_dts",
                'action' => 'index'
            ));

            return;
        }

        if (!$h_keikaku_meisai_dt->delete()) {

            foreach ($h_keikaku_meisai_dt->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "h_keikaku_meisai_dts",
                'action' => 'search'
            ));

            return;
        }

        $this->_bakOut($h_keikaku_meisai_dt, 1);

        $this->flash->success("生産計画明細データの削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "h_keikaku_meisai_dts",
            'action' => "index"
        ));
    }

    /**
     * Back Out a h_keikaku_meisai_dt
     *
     * @param string $h_keikaku_meisai_dt, $dlt_flg
     */
    public function _bakOut($h_keikaku_meisai_dt, $dlt_flg = 0)
    {

        $bak_h_keikaku_meisai_dt = new BakHKeikakuMeisaiDts();
        foreach ($h_keikaku_meisai_dt as $fld => $value) {
            $bak_h_keikaku_meisai_dt->$fld = $h_keikaku_meisai_dt->$fld;
        }
        $bak_h_keikaku_meisai_dt->id = NULL;
        $bak_h_keikaku_meisai_dt->id_moto = $h_keikaku_meisai_dt->id;
        $bak_h_keikaku_meisai_dt->hikae_dltflg = $dlt_flg;
        $bak_h_keikaku_meisai_dt->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_h_keikaku_meisai_dt->hikae_nichiji = date("Y-m-d H:i:s");
        if (!$bak_h_keikaku_meisai_dt->save()) {
            foreach ($bak_h_keikaku_meisai_dt->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
    }

}
