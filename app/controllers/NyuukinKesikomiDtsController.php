<?php


class NyuukinKesikomiDtsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        ControllerBase::indexCd("NyuukinKesikomiDts", "入金消込", "uriage_meisai_dt_id"); //簡易検索付き一覧表示
    }

    /**
     * Searches for nyuukin_kesikomi_dts
     */
    public function searchAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Displays the creation form
     */
    public function newAction($id = null, $dataname = "NyuukinKesikomiDts")
    {
        $this->view->imax = 0;

        if ($id) {
            $nameDts = $dataname;
            $nyuukin_kesikomi_dt = $nameDts::findFirstByid($id);
            if (!$nyuukin_kesikomi_dt) {
                $this->flash->error("入金消込が見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "nyuukin_kesikomi_dts",
                    'action' => 'index'
                ));

                return;
            }
            $this->_setDefault($nyuukin_kesikomi_dt, "new", $dataname);
            $this->tag->setDefault("id", null);
            $this->tag->setDefault("cd", null);
        }

    }

    /**
     * 修正画面から「次へ」ボタンを押したら次のコードの修正画面になる。
     */
    public function nextAction($id)
    {
        ControllerBase::nextCd($id, "nyuukin_kesikomi_dts", "NyuukinKesikomiDts", "入金消込", "uriage_meisai_dt_id");
    }

    /**
     * 修正画面から「前へ」ボタンを押したら前のコードの修正画面になる。
     */
    public function prevAction($id)
    {
        ControllerBase::prevCd($id, "nyuukin_kesikomi_dts", "NyuukinKesikomiDts", "入金消込", "uriage_meisai_dt_id");
    }

    /**
     * Edits a nyuukin_kesikomi_dt
     *
     * @param string $id
     */
    public function editAction($id)
    {
//        if (!$this->request->isPost()) {

        $nyuukin_kesikomi_dt = NyuukinKesikomiDts::findFirstByid($id);
        if (!$nyuukin_kesikomi_dt) {
            $this->flash->error("入金消込が見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "nyuukin_kesikomi_dts",
                'action' => 'index'
            ));

            return;
        }

        $this->view->id = $nyuukin_kesikomi_dt->id;

        $this->_setDefault($nyuukin_kesikomi_dt, "edit");
//        }
    }

    /**
     * 画面に表示するデータをセットする
     */
    public function _setDefault($nyuukin_kesikomi_dt, $action = "edit", $meisai = "NyuukinKesikomiDts")
    {
        $setdts = ["id",
            "uriage_meisai_dt_id",
            "kesikomi_gaku",
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
            if (property_exists($nyuukin_kesikomi_dt, $setdt)) {
                $this->tag->setDefault($setdt, $nyuukin_kesikomi_dt->$setdt);
            }
        }
    }

    /**
     * Creates a new nyuukin_kesikomi_dt
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "nyuukin_kesikomi_dts",
                'action' => 'index'
            ));

            return;
        }

        $nyuukin_kesikomi_dt = new NyuukinKesikomiDts();

        $post_flds = [];
        $post_flds = ["uriage_meisai_dt_id",
            "kesikomi_gaku",
            "updated",
        ];


        $thisPost = []; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        foreach ($post_flds as $post_fld) {
            $nyuukin_kesikomi_dt->$post_fld = array_key_exists($post_fld, $thisPost) ? $thisPost[$post_fld] : $this->request->getPost($post_fld);
        }

        if (!$nyuukin_kesikomi_dt->save()) {
            foreach ($nyuukin_kesikomi_dt->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "nyuukin_kesikomi_dts",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("入金消込の作成が完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "nyuukin_kesikomi_dts",
            'action' => 'edit',
            'params' => array($nyuukin_kesikomi_dt->id)
        ));
    }

    /**
     * Saves a nyuukin_kesikomi_dt edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "nyuukin_kesikomi_dts",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $nyuukin_kesikomi_dt = NyuukinKesikomiDts::findFirstByid($id);

        if (!$nyuukin_kesikomi_dt) {
            $this->flash->error("入金消込が見つからなくなりました。" . $id);

            $this->dispatcher->forward(array(
                'controller' => "nyuukin_kesikomi_dts",
                'action' => 'index'
            ));

            return;
        }

        if ($nyuukin_kesikomi_dt->updated !== $this->request->getPost("updated")) {
            $this->flash->error("他のプロセスから入金消込が変更されたため更新を中止しました。"
                . $id . ",uid=" . $nyuukin_kesikomi_dt->kousin_user_id . " tb=" . $nyuukin_kesikomi_dt->updated . " pt=" . $this->request->getPost("updated"));

            $this->dispatcher->forward(array(
                'controller' => "nyuukin_kesikomi_dts",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $post_flds = [];
        $post_flds = ["uriage_meisai_dt_id",
            "kesikomi_gaku",
            "updated",
        ];


        $thisPost = []; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        $chg_flg = 0;
        foreach ($post_flds as $post_fld) {
            if ((array_key_exists($post_fld, $thisPost) ? $thisPost[$post_fld] : $this->request->getPost($post_fld)) !== $nyuukin_kesikomi_dt->$post_fld) {
                $chg_flg = 1;
                break;
            }
        }
        if ($chg_flg === 0) {
            $this->flash->error("変更がありません。" . $id);

            $this->dispatcher->forward(array(
                "controller" => "nyuukin_kesikomi_dts",
                "action" => "edit",
                "params" => array($nyuukin_kesikomi_dt->id)
            ));

            return;
        }

        $this->_bakOut($nyuukin_kesikomi_dt);

        foreach ($post_flds as $post_fld) {
            $nyuukin_kesikomi_dt->$post_fld = array_key_exists($post_fld, $thisPost) ? $thisPost[$post_fld] : $this->request->getPost($post_fld);
        }

        if (!$nyuukin_kesikomi_dt->save()) {

            foreach ($nyuukin_kesikomi_dt->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "nyuukin_kesikomi_dts",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $this->flash->success("入金消込の情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "nyuukin_kesikomi_dts",
            'action' => 'edit',
            'params' => array($nyuukin_kesikomi_dt->id)
        ));
    }

    /**
     * Deletes a nyuukin_kesikomi_dt
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $nyuukin_kesikomi_dt = NyuukinKesikomiDts::findFirstByid($id);
        if (!$nyuukin_kesikomi_dt) {
            $this->flash->error("入金消込が見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "nyuukin_kesikomi_dts",
                'action' => 'index'
            ));

            return;
        }

        $this->_bakOut($nyuukin_kesikomi_dt, 1);

        if (!$nyuukin_kesikomi_dt->delete()) {

            foreach ($nyuukin_kesikomi_dt->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "nyuukin_kesikomi_dts",
                'action' => 'search'
            ));

            return;
        }

        $this->flash->success("入金消込の削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "nyuukin_kesikomi_dts",
            'action' => "index"
        ));
    }

    /**
     * Back Out a nyuukin_kesikomi_dt
     *
     * @param string $nyuukin_kesikomi_dt , $dlt_flg
     */
    public function _bakOut($nyuukin_kesikomi_dt, $dlt_flg = 0)
    {

        $bak_nyuukin_kesikomi_dt = new BakNyuukinKesikomiDts();
        foreach ($nyuukin_kesikomi_dt as $fld => $value) {
            $bak_nyuukin_kesikomi_dt->$fld = $nyuukin_kesikomi_dt->$fld;
        }
        $bak_nyuukin_kesikomi_dt->id = NULL;
        $bak_nyuukin_kesikomi_dt->id_moto = $nyuukin_kesikomi_dt->id;
        $bak_nyuukin_kesikomi_dt->hikae_dltflg = $dlt_flg;
        $bak_nyuukin_kesikomi_dt->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_nyuukin_kesikomi_dt->hikae_nichiji = date("Y-m-d H:i:s");
        if (!$bak_nyuukin_kesikomi_dt->save()) {
            foreach ($bak_nyuukin_kesikomi_dt->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
    }

    public function ajaxSetAction()
    {
        $this->view->disable();
        $response = new \Phalcon\Http\Response();

        if (!$this->request->isAjax()) {
            echo "is not Ajax ! ";
        }
        if (!$this->request->isPost()) {
            echo "is not Post ! ";
        }
        $henka_gaku = 0;
        $error_count = 0;
        $error_message = [];

        $uriage_meisai_dt = UriageMeisaiDts::findFirstByid($this->request->getPost('id'));
        if ($this->request->getPost('kesi_flg') == 1) { // 消し込むとき
            if ($uriage_meisai_dt->NyuukinKesikomiDts) { // 存在する
                $nyuukin_kesikomi_dt = $uriage_meisai_dt->NyuukinKesikomiDts;
                $henka_gaku -= $nyuukin_kesikomi_dt->kesikomi_gaku;
                $this->_bakOut($nyuukin_kesikomi_dt);
            } else {
                $nyuukin_kesikomi_dt = new NyuukinKesikomiDts();
                $nyuukin_kesikomi_dt->uriage_meisai_dt_id = $uriage_meisai_dt->id;
            }
            $nyuukin_kesikomi_dt->kesikomi_gaku = $uriage_meisai_dt->zeinukigaku + $uriage_meisai_dt->zeigaku;
            $henka_gaku += $nyuukin_kesikomi_dt->kesikomi_gaku;
            if (!$nyuukin_kesikomi_dt->save()) {
                $error_count++;
                foreach ($nyuukin_kesikomi_dt->getMessages() as $message) {
                    $error_message[] = $message;
                }
            }
        } else { // 消込の取消
            if ($uriage_meisai_dt->NyuukinKesikomiDts) { // 存在する
                $nyuukin_kesikomi_dt = $uriage_meisai_dt->NyuukinKesikomiDts;
                $henka_gaku -= $nyuukin_kesikomi_dt->kesikomi_gaku;
                $this->_bakOut($nyuukin_kesikomi_dt, 1);
                if (!$nyuukin_kesikomi_dt->delete()) {
                    $error_count++;
                    foreach ($nyuukin_kesikomi_dt->getMessages() as $message) {
                        $error_message[] = $message;
                    }
                }
            } else {
                $error_count++;
                $error_message[] = "取消すべき消込情報が見つからなくなりました。";
            }
        }
        $resData = ['henka_gaku' => $henka_gaku, 'error_count' => $error_count, 'error_message' => $error_message];
        $response->setContent(json_encode($resData));

        return $response;
    }
    /**
     * 伝票計での消込
     *
     * @return \Phalcon\Http\Response
     */
    public function ajaxAllSetAction()
    {
        $this->view->disable();
        $response = new \Phalcon\Http\Response();
        if (!$this->request->isAjax()) {
            echo "is not Ajax ! ";
        }
        if (!$this->request->isPost()) {
            echo "is not Post ! ";
        }
        // 売上IDから、明細情報を取得し、明細１行ずつの状態を調べ消し込みする
        $kesikomi = $this->request->getPost('id');
        $kesiFlg = $this->request->getPost('kesi_flg');
        $error_message = [];
        $uriage_dt = UriageDts::findFirstByid($kesikomi);
        foreach ($uriage_dt->UriageMeisaiDts as $uriage_meisai_dt) {
            if (!$uriage_meisai_dt->NyuukinKesikomiDts->id && (float)$uriage_meisai_dt->zeinukigaku + (float)$uriage_meisai_dt->zeigaku !== 0) { // 新規
                $nyuukin_kesikomi_dt = new NyuukinKesikomiDts();
                $nyuukin_kesikomi_dt->uriage_meisai_dt_id = $uriage_meisai_dt->id;
                $nyuukin_kesikomi_dt->kesikomi_gaku = $uriage_meisai_dt->zeinukigaku + $uriage_meisai_dt->zeigaku;
                if (!$nyuukin_kesikomi_dt->save()) {
                    foreach ($nyuukin_kesikomi_dt->getMessages() as $message) {
                        $this->flash->error($message);
                    }
                }
            } else if ($uriage_meisai_dt->NyuukinKesikomiDts->kesikomi_gaku !== (float)$uriage_meisai_dt->zeinukigaku + (float)$uriage_meisai_dt->zeigaku) { // 変更
                if ($kesiFlg == 1) {
                    $nyuukin_kesikomi_dt = $uriage_meisai_dt->NyuukinKesikomiDts;
                    $nyuukin_kesikomi_dt->kesikomi_gaku = $uriage_meisai_dt->zeinukigaku + $uriage_meisai_dt->zeigaku;
                    if (!$nyuukin_kesikomi_dt->save()) {
                        foreach ($nyuukin_kesikomi_dt->getMessages() as $message) {
                            $this->flash->error($message);
                        }
                    }
                } else {
                    $nyuukin_kesikomi_dt = $uriage_meisai_dt->NyuukinKesikomiDts;
                    if (!$nyuukin_kesikomi_dt->delete()) {
                        foreach ($nyuukin_kesikomi_dt->getMessages() as $message) {
                            $error_message[] = $message;
                        }
                    }
                }
            }
        }

        $resData = ['OK:'=> 'OK', 'error_message'=>$error_message];
        $response->setContent(json_encode($resData));
        return $response;
    }
}
