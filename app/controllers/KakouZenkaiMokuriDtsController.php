<?php
 


class KakouZenkaiMokuriDtsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        ControllerBase::indexCd("KakouZenkaiMokuriDts", "前回加工時申し送りデータ"); //簡易検索付き一覧表示
    }

    /**
     * Searches for kakou_zenkai_mokuri_dts
     */
    public function searchAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Displays the creation form
     */
    public function newAction($id=null, $dataname="KakouZenkaiMokuriDts")
    {
        $this->view->imax = 0;

        if ($id) {
            $nameDts = $dataname;
            $kakou_zenkai_mokuri_dt = $nameDts::findFirstByid($id);
            if (!$kakou_zenkai_mokuri_dt) {
                $this->flash->error("前回加工時申し送りデータが見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "kakou_zenkai_mokuri_dts",
                    'action' => 'index'
                ));

                return;
            }
            $this->_setDefault($kakou_zenkai_mokuri_dt, "new", $dataname);
            $this->tag->setDefault("id", null);
            $this->tag->setDefault("cd", null);
        }

    }

    /**
     * 修正画面から「次へ」ボタンを押したら次のコードの修正画面になる。
     */
    public function nextAction($id)
    {
        ControllerBase::nextCd($id, "kakou_zenkai_mokuri_dts", "KakouZenkaiMokuriDts", "前回加工時申し送りデータ");
    }

    /**
     * 修正画面から「前へ」ボタンを押したら前のコードの修正画面になる。
     */
    public function prevAction($id)
    {
        ControllerBase::prevCd($id, "kakou_zenkai_mokuri_dts", "KakouZenkaiMokuriDts", "前回加工時申し送りデータ");
    }

    /**
     * Edits a kakou_zenkai_mokuri_dt
     *
     * @param string $id
     */
    public function editAction($id)
    {
//        if (!$this->request->isPost()) {

            $kakou_zenkai_mokuri_dt = KakouZenkaiMokuriDts::findFirstByid($id);
            if (!$kakou_zenkai_mokuri_dt) {
                $this->flash->error("前回加工時申し送りデータが見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "kakou_zenkai_mokuri_dts",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->id = $kakou_zenkai_mokuri_dt->id;

            $this->_setDefault($kakou_zenkai_mokuri_dt, "edit");
//        }
    }

    /**
     * 画面に表示するデータをセットする
     */
    public function _setDefault($kakou_zenkai_mokuri_dt, $action="edit", $meisai="KakouZenkaiMokuriDts")
    {
        $setdts = ["id",
            "cd",
            "name",
            "hacchuu_dt_id",
            "hiduke",
            "tantou_mr_cd",
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
            if (property_exists($kakou_zenkai_mokuri_dt, $setdt)) {
                $this->tag->setDefault($setdt, $kakou_zenkai_mokuri_dt->$setdt);
            }
        }
    }

    /**
     * Creates a new kakou_zenkai_mokuri_dt
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "kakou_zenkai_mokuri_dts",
                'action' => 'index'
            ));

            return;
        }

        $kakou_zenkai_mokuri_dt = new KakouZenkaiMokuriDts();

        $post_flds = [];
        $post_flds = ["cd",
            "name",
            "hacchuu_dt_id",
            "hiduke",
            "tantou_mr_cd",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        foreach ($post_flds as $post_fld) {
            $kakou_zenkai_mokuri_dt->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$kakou_zenkai_mokuri_dt->save()) {
            foreach ($kakou_zenkai_mokuri_dt->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "kakou_zenkai_mokuri_dts",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("前回加工時申し送りデータの作成が完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "kakou_zenkai_mokuri_dts",
            'action' => 'edit',
            'params' => array($kakou_zenkai_mokuri_dt->id)
        ));
    }

    /**
     * Saves a kakou_zenkai_mokuri_dt edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "kakou_zenkai_mokuri_dts",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $kakou_zenkai_mokuri_dt = KakouZenkaiMokuriDts::findFirstByid($id);

        if (!$kakou_zenkai_mokuri_dt) {
            $this->flash->error("前回加工時申し送りデータが見つからなくなりました。" . $id);

            $this->dispatcher->forward(array(
                'controller' => "kakou_zenkai_mokuri_dts",
                'action' => 'index'
            ));

            return;
        }

        if ($kakou_zenkai_mokuri_dt->updated !== $this->request->getPost("updated")) {
            $this->flash->error("他のプロセスから前回加工時申し送りデータが変更されたため更新を中止しました。"
                . $id . ",uid=" . $kakou_zenkai_mokuri_dt->kousin_user_id . " tb=" . $kakou_zenkai_mokuri_dt->updated ." pt=" . $this->request->getPost("updated"));

            $this->dispatcher->forward(array(
                'controller' => "kakou_zenkai_mokuri_dts",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $post_flds = [];
        $post_flds = ["cd",
            "name",
            "hacchuu_dt_id",
            "hiduke",
            "tantou_mr_cd",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        $chg_flg = 0;
        foreach ($post_flds as $post_fld) {
            if ((array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld)) !== $kakou_zenkai_mokuri_dt->$post_fld) {
                $chg_flg = 1;
                break;
            }
        }
        if ($chg_flg === 0) {
            $this->flash->error("変更がありません。" . $id);

            $this->dispatcher->forward(array(
                "controller" => "kakou_zenkai_mokuri_dts",
                "action" => "edit",
                "params" => array($kakou_zenkai_mokuri_dt->id)
            ));

            return;
        }

        $this->_bakOut($kakou_zenkai_mokuri_dt);

        foreach ($post_flds as $post_fld) {
            $kakou_zenkai_mokuri_dt->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$kakou_zenkai_mokuri_dt->save()) {

            foreach ($kakou_zenkai_mokuri_dt->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "kakou_zenkai_mokuri_dts",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $this->flash->success("前回加工時申し送りデータの情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "kakou_zenkai_mokuri_dts",
            'action' => 'edit',
            'params' => array($kakou_zenkai_mokuri_dt->id)
        ));
    }

    /**
     * Deletes a kakou_zenkai_mokuri_dt
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $kakou_zenkai_mokuri_dt = KakouZenkaiMokuriDts::findFirstByid($id);
        if (!$kakou_zenkai_mokuri_dt) {
            $this->flash->error("前回加工時申し送りデータが見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "kakou_zenkai_mokuri_dts",
                'action' => 'index'
            ));

            return;
        }

        $this->_bakOut($kakou_zenkai_mokuri_dt, 1);

        if (!$kakou_zenkai_mokuri_dt->delete()) {

            foreach ($kakou_zenkai_mokuri_dt->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "kakou_zenkai_mokuri_dts",
                'action' => 'search'
            ));

            return;
        }

        $this->flash->success("前回加工時申し送りデータの削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "kakou_zenkai_mokuri_dts",
            'action' => "index"
        ));
    }

    /**
     * Back Out a kakou_zenkai_mokuri_dt
     *
     * @param string $kakou_zenkai_mokuri_dt, $dlt_flg
     */
    public function _bakOut($kakou_zenkai_mokuri_dt, $dlt_flg = 0)
    {

        $bak_kakou_zenkai_mokuri_dt = new BakKakouZenkaiMokuriDts();
        foreach ($kakou_zenkai_mokuri_dt as $fld => $value) {
            $bak_kakou_zenkai_mokuri_dt->$fld = $kakou_zenkai_mokuri_dt->$fld;
        }
        $bak_kakou_zenkai_mokuri_dt->id = NULL;
        $bak_kakou_zenkai_mokuri_dt->id_moto = $kakou_zenkai_mokuri_dt->id;
        $bak_kakou_zenkai_mokuri_dt->hikae_dltflg = $dlt_flg;
        $bak_kakou_zenkai_mokuri_dt->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_kakou_zenkai_mokuri_dt->hikae_nichiji = date("Y-m-d H:i:s");
        if (!$bak_kakou_zenkai_mokuri_dt->save()) {
            foreach ($bak_kakou_zenkai_mokuri_dt->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
    }

}
