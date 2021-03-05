<?php
 


class KakouIraiLogDtsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        ControllerBase::indexCd("KakouIraiLogDts", "加工依頼変更ログ"); //簡易検索付き一覧表示
    }

    /**
     * Searches for kakou_irai_log_dts
     */
    public function searchAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Displays the creation form
     */
    public function newAction($id=null, $dataname="KakouIraiLogDts")
    {
        $this->view->imax = 0;

        if ($id) {
            $nameDts = $dataname;
            $kakou_irai_log_dt = $nameDts::findFirstByid($id);
            if (!$kakou_irai_log_dt) {
                $this->flash->error("加工依頼変更ログが見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "kakou_irai_log_dts",
                    'action' => 'index'
                ));

                return;
            }
            $this->_setDefault($kakou_irai_log_dt, "new", $dataname);
            $this->tag->setDefault("id", null);
            $this->tag->setDefault("cd", null);
        }

    }

    /**
     * 修正画面から「次へ」ボタンを押したら次のコードの修正画面になる。
     */
    public function nextAction($id)
    {
        ControllerBase::nextCd($id, "kakou_irai_log_dts", "KakouIraiLogDts", "加工依頼変更ログ");
    }

    /**
     * 修正画面から「前へ」ボタンを押したら前のコードの修正画面になる。
     */
    public function prevAction($id)
    {
        ControllerBase::prevCd($id, "kakou_irai_log_dts", "KakouIraiLogDts", "加工依頼変更ログ");
    }

    /**
     * Edits a kakou_irai_log_dt
     *
     * @param string $id
     */
    public function editAction($id)
    {
//        if (!$this->request->isPost()) {

            $kakou_irai_log_dt = KakouIraiLogDts::findFirstByid($id);
            if (!$kakou_irai_log_dt) {
                $this->flash->error("加工依頼変更ログが見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "kakou_irai_log_dts",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->id = $kakou_irai_log_dt->id;

            $this->_setDefault($kakou_irai_log_dt, "edit");
//        }
    }

    /**
     * 画面に表示するデータをセットする
     */
    public function _setDefault($kakou_irai_log_dt, $action="edit", $meisai="KakouIraiLogDts")
    {
        $setdts = ["id",
            "cd",
            "name",
            "hacchuu_dt_id",
            "table_ryaku",
            "gyou_ix",
            "koumoku_cd",
            "henkou_mae",
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
            if (property_exists($kakou_irai_log_dt, $setdt)) {
                $this->tag->setDefault($setdt, $kakou_irai_log_dt->$setdt);
            }
        }
    }

    /**
     * Creates a new kakou_irai_log_dt
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "kakou_irai_log_dts",
                'action' => 'index'
            ));

            return;
        }

        $kakou_irai_log_dt = new KakouIraiLogDts();

        $post_flds = [];
        $post_flds = ["cd",
            "name",
            "hacchuu_dt_id",
            "table_ryaku",
            "gyou_ix",
            "koumoku_cd",
            "henkou_mae",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        foreach ($post_flds as $post_fld) {
            $kakou_irai_log_dt->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$kakou_irai_log_dt->save()) {
            foreach ($kakou_irai_log_dt->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "kakou_irai_log_dts",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("加工依頼変更ログの作成が完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "kakou_irai_log_dts",
            'action' => 'edit',
            'params' => array($kakou_irai_log_dt->id)
        ));
    }

    /**
     * Saves a kakou_irai_log_dt edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "kakou_irai_log_dts",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $kakou_irai_log_dt = KakouIraiLogDts::findFirstByid($id);

        if (!$kakou_irai_log_dt) {
            $this->flash->error("加工依頼変更ログが見つからなくなりました。" . $id);

            $this->dispatcher->forward(array(
                'controller' => "kakou_irai_log_dts",
                'action' => 'index'
            ));

            return;
        }

        if ($kakou_irai_log_dt->updated !== $this->request->getPost("updated")) {
            $this->flash->error("他のプロセスから加工依頼変更ログが変更されたため更新を中止しました。"
                . $id . ",uid=" . $kakou_irai_log_dt->kousin_user_id . " tb=" . $kakou_irai_log_dt->updated ." pt=" . $this->request->getPost("updated"));

            $this->dispatcher->forward(array(
                'controller' => "kakou_irai_log_dts",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $post_flds = [];
        $post_flds = ["cd",
            "name",
            "hacchuu_dt_id",
            "table_ryaku",
            "gyou_ix",
            "koumoku_cd",
            "henkou_mae",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        $chg_flg = 0;
        foreach ($post_flds as $post_fld) {
            if ((array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld)) !== $kakou_irai_log_dt->$post_fld) {
                $chg_flg = 1;
                break;
            }
        }
        if ($chg_flg === 0) {
            $this->flash->error("変更がありません。" . $id);

            $this->dispatcher->forward(array(
                "controller" => "kakou_irai_log_dts",
                "action" => "edit",
                "params" => array($kakou_irai_log_dt->id)
            ));

            return;
        }

        $this->_bakOut($kakou_irai_log_dt);

        foreach ($post_flds as $post_fld) {
            $kakou_irai_log_dt->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$kakou_irai_log_dt->save()) {

            foreach ($kakou_irai_log_dt->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "kakou_irai_log_dts",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $this->flash->success("加工依頼変更ログの情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "kakou_irai_log_dts",
            'action' => 'edit',
            'params' => array($kakou_irai_log_dt->id)
        ));
    }

    /**
     * Deletes a kakou_irai_log_dt
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $kakou_irai_log_dt = KakouIraiLogDts::findFirstByid($id);
        if (!$kakou_irai_log_dt) {
            $this->flash->error("加工依頼変更ログが見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "kakou_irai_log_dts",
                'action' => 'index'
            ));

            return;
        }

        $this->_bakOut($kakou_irai_log_dt, 1);

        if (!$kakou_irai_log_dt->delete()) {

            foreach ($kakou_irai_log_dt->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "kakou_irai_log_dts",
                'action' => 'search'
            ));

            return;
        }

        $this->flash->success("加工依頼変更ログの削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "kakou_irai_log_dts",
            'action' => "index"
        ));
    }

    /**
     * Back Out a kakou_irai_log_dt
     *
     * @param string $kakou_irai_log_dt, $dlt_flg
     */
    public function _bakOut($kakou_irai_log_dt, $dlt_flg = 0)
    {

        $bak_kakou_irai_log_dt = new BakKakouIraiLogDts();
        foreach ($kakou_irai_log_dt as $fld => $value) {
            $bak_kakou_irai_log_dt->$fld = $kakou_irai_log_dt->$fld;
        }
        $bak_kakou_irai_log_dt->id = NULL;
        $bak_kakou_irai_log_dt->id_moto = $kakou_irai_log_dt->id;
        $bak_kakou_irai_log_dt->hikae_dltflg = $dlt_flg;
        $bak_kakou_irai_log_dt->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_kakou_irai_log_dt->hikae_nichiji = date("Y-m-d H:i:s");
        if (!$bak_kakou_irai_log_dt->save()) {
            foreach ($bak_kakou_irai_log_dt->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
    }

}
