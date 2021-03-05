<?php
 


class KakouNagareDtsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        ControllerBase::indexCd("KakouNagareDts", "加工流れ詳細データ"); //簡易検索付き一覧表示
    }

    /**
     * Searches for kakou_nagare_dts
     */
    public function searchAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Displays the creation form
     */
    public function newAction($id=null, $dataname="KakouNagareDts")
    {
        $this->view->imax = 0;

        if ($id) {
            $nameDts = $dataname;
            $kakou_nagare_dt = $nameDts::findFirstByid($id);
            if (!$kakou_nagare_dt) {
                $this->flash->error("加工流れ詳細データが見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "kakou_nagare_dts",
                    'action' => 'index'
                ));

                return;
            }
            $this->_setDefault($kakou_nagare_dt, "new", $dataname);
            $this->tag->setDefault("id", null);
            $this->tag->setDefault("cd", null);
        }

    }

    /**
     * 修正画面から「次へ」ボタンを押したら次のコードの修正画面になる。
     */
    public function nextAction($id)
    {
        ControllerBase::nextCd($id, "kakou_nagare_dts", "KakouNagareDts", "加工流れ詳細データ");
    }

    /**
     * 修正画面から「前へ」ボタンを押したら前のコードの修正画面になる。
     */
    public function prevAction($id)
    {
        ControllerBase::prevCd($id, "kakou_nagare_dts", "KakouNagareDts", "加工流れ詳細データ");
    }

    /**
     * Edits a kakou_nagare_dt
     *
     * @param string $id
     */
    public function editAction($id)
    {
//        if (!$this->request->isPost()) {

            $kakou_nagare_dt = KakouNagareDts::findFirstByid($id);
            if (!$kakou_nagare_dt) {
                $this->flash->error("加工流れ詳細データが見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "kakou_nagare_dts",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->id = $kakou_nagare_dt->id;

            $this->_setDefault($kakou_nagare_dt, "edit");
//        }
    }

    /**
     * 画面に表示するデータをセットする
     */
    public function _setDefault($kakou_nagare_dt, $action="edit", $meisai="KakouNagareDts")
    {
        $setdts = ["id",
            "cd",
            "name",
            "hacchuu_dt_id",
            "kakou_nagare_kbn_id",
            "naiyou_cd",
            "bikou",
            "kakunin_kbn",
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
            if (property_exists($kakou_nagare_dt, $setdt)) {
                $this->tag->setDefault($setdt, $kakou_nagare_dt->$setdt);
            }
        }
    }

    /**
     * Creates a new kakou_nagare_dt
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "kakou_nagare_dts",
                'action' => 'index'
            ));

            return;
        }

        $kakou_nagare_dt = new KakouNagareDts();

        $post_flds = [];
        $post_flds = ["cd",
            "name",
            "hacchuu_dt_id",
            "kakou_nagare_kbn_id",
            "naiyou_cd",
            "bikou",
            "kakunin_kbn",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        foreach ($post_flds as $post_fld) {
            $kakou_nagare_dt->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$kakou_nagare_dt->save()) {
            foreach ($kakou_nagare_dt->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "kakou_nagare_dts",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("加工流れ詳細データの作成が完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "kakou_nagare_dts",
            'action' => 'edit',
            'params' => array($kakou_nagare_dt->id)
        ));
    }

    /**
     * Saves a kakou_nagare_dt edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "kakou_nagare_dts",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $kakou_nagare_dt = KakouNagareDts::findFirstByid($id);

        if (!$kakou_nagare_dt) {
            $this->flash->error("加工流れ詳細データが見つからなくなりました。" . $id);

            $this->dispatcher->forward(array(
                'controller' => "kakou_nagare_dts",
                'action' => 'index'
            ));

            return;
        }

        if ($kakou_nagare_dt->updated !== $this->request->getPost("updated")) {
            $this->flash->error("他のプロセスから加工流れ詳細データが変更されたため更新を中止しました。"
                . $id . ",uid=" . $kakou_nagare_dt->kousin_user_id . " tb=" . $kakou_nagare_dt->updated ." pt=" . $this->request->getPost("updated"));

            $this->dispatcher->forward(array(
                'controller' => "kakou_nagare_dts",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $post_flds = [];
        $post_flds = ["cd",
            "name",
            "hacchuu_dt_id",
            "kakou_nagare_kbn_id",
            "naiyou_cd",
            "bikou",
            "kakunin_kbn",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        $chg_flg = 0;
        foreach ($post_flds as $post_fld) {
            if ((array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld)) !== $kakou_nagare_dt->$post_fld) {
                $chg_flg = 1;
                break;
            }
        }
        if ($chg_flg === 0) {
            $this->flash->error("変更がありません。" . $id);

            $this->dispatcher->forward(array(
                "controller" => "kakou_nagare_dts",
                "action" => "edit",
                "params" => array($kakou_nagare_dt->id)
            ));

            return;
        }

        $this->_bakOut($kakou_nagare_dt);

        foreach ($post_flds as $post_fld) {
            $kakou_nagare_dt->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$kakou_nagare_dt->save()) {

            foreach ($kakou_nagare_dt->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "kakou_nagare_dts",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $this->flash->success("加工流れ詳細データの情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "kakou_nagare_dts",
            'action' => 'edit',
            'params' => array($kakou_nagare_dt->id)
        ));
    }

    /**
     * Deletes a kakou_nagare_dt
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $kakou_nagare_dt = KakouNagareDts::findFirstByid($id);
        if (!$kakou_nagare_dt) {
            $this->flash->error("加工流れ詳細データが見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "kakou_nagare_dts",
                'action' => 'index'
            ));

            return;
        }

        $this->_bakOut($kakou_nagare_dt, 1);

        if (!$kakou_nagare_dt->delete()) {

            foreach ($kakou_nagare_dt->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "kakou_nagare_dts",
                'action' => 'search'
            ));

            return;
        }

        $this->flash->success("加工流れ詳細データの削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "kakou_nagare_dts",
            'action' => "index"
        ));
    }

    /**
     * Back Out a kakou_nagare_dt
     *
     * @param string $kakou_nagare_dt, $dlt_flg
     */
    public function _bakOut($kakou_nagare_dt, $dlt_flg = 0)
    {

        $bak_kakou_nagare_dt = new BakKakouNagareDts();
        foreach ($kakou_nagare_dt as $fld => $value) {
            $bak_kakou_nagare_dt->$fld = $kakou_nagare_dt->$fld;
        }
        $bak_kakou_nagare_dt->id = NULL;
        $bak_kakou_nagare_dt->id_moto = $kakou_nagare_dt->id;
        $bak_kakou_nagare_dt->hikae_dltflg = $dlt_flg;
        $bak_kakou_nagare_dt->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_kakou_nagare_dt->hikae_nichiji = date("Y-m-d H:i:s");
        if (!$bak_kakou_nagare_dt->save()) {
            foreach ($bak_kakou_nagare_dt->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
    }

}
