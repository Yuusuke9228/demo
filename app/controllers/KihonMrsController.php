<?php
 


class KihonMrsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        ControllerBase::indexCd("KihonMrs", "基本情報"); //簡易検索付き一覧表示
    }

    /**
     * Searches for kihon_mrs
     */
    public function searchAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Displays the creation form
     */
    public function newAction($id=null, $dataname="KihonMrs")
    {
        $this->view->imax = 0;

        if ($id) {
            $nameDts = $dataname;
            $kihon_mr = $nameDts::findFirstByid($id);
            if (!$kihon_mr) {
                $this->flash->error("基本情報が見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "kihon_mrs",
                    'action' => 'index'
                ));

                return;
            }
            $this->_setDefault($kihon_mr, "new", $dataname);
            $this->tag->setDefault("id", null);
            $this->tag->setDefault("cd", null);
        }

    }

    /**
     * 修正画面から「次へ」ボタンを押したら次のコードの修正画面になる。
     */
    public function nextAction($id)
    {
        ControllerBase::nextCd($id, "kihon_mrs", "KihonMrs", "基本情報");
    }

    /**
     * 修正画面から「前へ」ボタンを押したら前のコードの修正画面になる。
     */
    public function prevAction($id)
    {
        ControllerBase::prevCd($id, "kihon_mrs", "KihonMrs", "基本情報");
    }

    /**
     * Edits a kihon_mr
     *
     * @param string $id
     */
    public function editAction($id)
    {
//        if (!$this->request->isPost()) {

            $kihon_mr = KihonMrs::findFirstByid($id);
            if (!$kihon_mr) {
                $this->flash->error("基本情報が見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "kihon_mrs",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->id = $kihon_mr->id;

            $this->_setDefault($kihon_mr, "edit");
//        }
    }

    /**
     * 画面に表示するデータをセットする
     */
    public function _setDefault($kihon_mr, $action="edit", $meisai="KihonMrs")
    {
        $setdts = ["id",
            "cd",
            "name",
            "kana",
            "ryakushou",
            "yuubin_bangou",
            "juusho1",
            "juusho2",
            "yakushoku",
            "gotantousha",
            "tel",
            "fax",
            "email",
            "homepage",
            "chouhyou1",
            "chouhyou2",
            "chouhyou3",
            "chouhyou4",
            "chouhyou5",
            "shimegrp_kbn_cd",
            "gaku_hasuu_shori_kbn_cd",
            "zei_hasuu_shori_kbn_cd",
            "zei_tenka_kbn_cd",
            "harai_houhou_kbn_cd",
            "harai_saikuru_kbn_cd",
            "haraibi",
            "tesuuryou_hutan_kbn_cd",
            "tegata_sight",
            "kigyou_code",
            "memo",
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
            if (property_exists($kihon_mr, $setdt)) {
                $this->tag->setDefault($setdt, $kihon_mr->$setdt);
            }
        }
    }

    /**
     * Creates a new kihon_mr
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "kihon_mrs",
                'action' => 'index'
            ));

            return;
        }

        $kihon_mr = new KihonMrs();

        $post_flds = [];
        $post_flds = ["cd",
            "name",
            "kana",
            "ryakushou",
            "yuubin_bangou",
            "juusho1",
            "juusho2",
            "yakushoku",
            "gotantousha",
            "tel",
            "fax",
            "email",
            "homepage",
            "chouhyou1",
            "chouhyou2",
            "chouhyou3",
            "chouhyou4",
            "chouhyou5",
            "shimegrp_kbn_cd",
            "gaku_hasuu_shori_kbn_cd",
            "zei_hasuu_shori_kbn_cd",
            "zei_tenka_kbn_cd",
            "harai_houhou_kbn_cd",
            "harai_saikuru_kbn_cd",
            "haraibi",
            "tesuuryou_hutan_kbn_cd",
            "tegata_sight",
            "kigyou_code",
            "memo",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        foreach ($post_flds as $post_fld) {
            $kihon_mr->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$kihon_mr->save()) {
            foreach ($kihon_mr->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "kihon_mrs",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("基本情報の作成が完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "kihon_mrs",
            'action' => 'edit',
            'params' => array($kihon_mr->id)
        ));
    }

    /**
     * Saves a kihon_mr edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "kihon_mrs",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $kihon_mr = KihonMrs::findFirstByid($id);

        if (!$kihon_mr) {
            $this->flash->error("基本情報が見つからなくなりました。" . $id);

            $this->dispatcher->forward(array(
                'controller' => "kihon_mrs",
                'action' => 'index'
            ));

            return;
        }

        if ($kihon_mr->updated !== $this->request->getPost("updated")) {
            $this->flash->error("他のプロセスから基本情報が変更されたため更新を中止しました。"
                . $id . ",uid=" . $kihon_mr->kousin_user_id . " tb=" . $kihon_mr->updated ." pt=" . $this->request->getPost("updated"));

            $this->dispatcher->forward(array(
                'controller' => "kihon_mrs",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $post_flds = [];
        $post_flds = ["cd",
            "name",
            "kana",
            "ryakushou",
            "yuubin_bangou",
            "juusho1",
            "juusho2",
            "yakushoku",
            "gotantousha",
            "tel",
            "fax",
            "email",
            "homepage",
            "chouhyou1",
            "chouhyou2",
            "chouhyou3",
            "chouhyou4",
            "chouhyou5",
            "shimegrp_kbn_cd",
            "gaku_hasuu_shori_kbn_cd",
            "zei_hasuu_shori_kbn_cd",
            "zei_tenka_kbn_cd",
            "harai_houhou_kbn_cd",
            "harai_saikuru_kbn_cd",
            "haraibi",
            "tesuuryou_hutan_kbn_cd",
            "tegata_sight",
            "kigyou_code",
            "memo",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        $chg_flg = 0;
        foreach ($post_flds as $post_fld) {
            if ((array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld)) !== $kihon_mr->$post_fld) {
                $chg_flg = 1;
                break;
            }
        }
        if ($chg_flg === 0) {
            $this->flash->error("変更がありません。" . $id);

            $this->dispatcher->forward(array(
                "controller" => "kihon_mrs",
                "action" => "edit",
                "params" => array($kihon_mr->id)
            ));

            return;
        }

        $this->_bakOut($kihon_mr);

        foreach ($post_flds as $post_fld) {
            $kihon_mr->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$kihon_mr->save()) {

            foreach ($kihon_mr->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "kihon_mrs",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $this->flash->success("基本情報の情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "kihon_mrs",
            'action' => 'edit',
            'params' => array($kihon_mr->id)
        ));
    }

    /**
     * Deletes a kihon_mr
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $kihon_mr = KihonMrs::findFirstByid($id);
        if (!$kihon_mr) {
            $this->flash->error("基本情報が見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "kihon_mrs",
                'action' => 'index'
            ));

            return;
        }

        $this->_bakOut($kihon_mr, 1);

        if (!$kihon_mr->delete()) {

            foreach ($kihon_mr->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "kihon_mrs",
                'action' => 'search'
            ));

            return;
        }

        $this->flash->success("基本情報の削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "kihon_mrs",
            'action' => "index"
        ));
    }

    /**
     * Back Out a kihon_mr
     *
     * @param string $kihon_mr, $dlt_flg
     */
    public function _bakOut($kihon_mr, $dlt_flg = 0)
    {

        $bak_kihon_mr = new BakKihonMrs();
        foreach ($kihon_mr as $fld => $value) {
            $bak_kihon_mr->$fld = $kihon_mr->$fld;
        }
        $bak_kihon_mr->id = NULL;
        $bak_kihon_mr->id_moto = $kihon_mr->id;
        $bak_kihon_mr->hikae_dltflg = $dlt_flg;
        $bak_kihon_mr->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_kihon_mr->hikae_nichiji = date("Y-m-d H:i:s");
        if (!$bak_kihon_mr->save()) {
            foreach ($bak_kihon_mr->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
    }

}
