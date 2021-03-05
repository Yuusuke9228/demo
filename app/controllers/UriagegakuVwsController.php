<?php


class UriagegakuVwsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        ControllerBase::indexCd("UriagegakuVws", "VIEW", "uriage_dt_id"); //簡易検索付き一覧表示
    }

    /**
     * Searches for uriagegaku_vws
     */
    public function searchAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Displays the creation form
     */
    public function newAction($id = null, $dataname = "UriagegakuVws")
    {
        $this->view->imax = 0;

        if ($id) {
            $nameDts = $dataname;
            $uriagegaku_vw = $nameDts::findFirstByid($id);
            if (!$uriagegaku_vw) {
                $this->flash->error("VIEWが見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "uriagegaku_vws",
                    'action' => 'index'
                ));

                return;
            }
            $this->_setDefault($uriagegaku_vw, "new", $dataname);
            $this->tag->setDefault("uriage_dt_id", null);
            $this->tag->setDefault("cd", null);
        }

    }

    /**
     * 修正画面から「次へ」ボタンを押したら次のコードの修正画面になる。
     */
    public function nextAction($id)
    {
        ControllerBase::nextCd($id, "uriagegaku_vws", "UriagegakuVws", "売上額", "uriage_dt_id");
    }

    /**
     * 修正画面から「前へ」ボタンを押したら前のコードの修正画面になる。
     */
    public function prevAction($id)
    {
        ControllerBase::prevCd($id, "uriagegaku_vws", "UriagegakuVws", "売上額", "uriage_dt_id");
    }

    /**
     * Edits a uriagegaku_vw
     *
     * @param string $uriage_dt_id
     */
    public function editAction($uriage_dt_id)
    {
//        if (!$this->request->isPost()) {

        $uriagegaku_vw = UriagegakuVws::findFirstByuriage_dt_id($uriage_dt_id);
        if (!$uriagegaku_vw) {
            $this->flash->error("VIEWが見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "uriagegaku_vws",
                'action' => 'index'
            ));

            return;
        }

        $this->view->uriage_dt_id = $uriagegaku_vw->uriage_dt_id;

        $this->_setDefault($uriagegaku_vw, "edit");
//        }
    }

    /**
     * 画面に表示するデータをセットする
     */
    public function _setDefault($uriagegaku_vw, $action = "edit", $meisai = "UriagegakuVws")
    {
        $setdts = ["uriage_dt_id",
            "kingaku",
            "kesikomi_gaku",
            "seikyuusaki_mr_cd",
            "uriadebi",
            "cd",
        ];

        foreach ($setdts as $setdt) {
            if (property_exists($uriagegaku_vw, $setdt)) {
                $this->tag->setDefault($setdt, $uriagegaku_vw->$setdt);
            }
        }
    }

    /**
     * Creates a new uriagegaku_vw
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "uriagegaku_vws",
                'action' => 'index'
            ));

            return;
        }

        $uriagegaku_vw = new UriagegakuVws();

        $post_flds = [];
        $post_flds = ["uriage_dt_id",
            "kingaku",
            "kesikomi_gaku",
        ];


        $thisPost = []; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        foreach ($post_flds as $post_fld) {
            $uriagegaku_vw->$post_fld = array_key_exists($post_fld, $thisPost) ? $thisPost[$post_fld] : $this->request->getPost($post_fld);
        }

        if (!$uriagegaku_vw->save()) {
            foreach ($uriagegaku_vw->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "uriagegaku_vws",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("VIEWの作成が完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "uriagegaku_vws",
            'action' => 'edit',
            'params' => array($uriagegaku_vw->uriage_dt_id)
        ));
    }

    /**
     * Saves a uriagegaku_vw edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "uriagegaku_vws",
                'action' => 'index'
            ));

            return;
        }

        $uriage_dt_id = $this->request->getPost("uriage_dt_id");
        $uriagegaku_vw = UriagegakuVws::findFirstByuriage_dt_id($uriage_dt_id);

        if (!$uriagegaku_vw) {
            $this->flash->error("VIEWが見つからなくなりました。" . $uriage_dt_id);

            $this->dispatcher->forward(array(
                'controller' => "uriagegaku_vws",
                'action' => 'index'
            ));

            return;
        }

        if ($uriagegaku_vw->updated !== $this->request->getPost("updated")) {
            $this->flash->error("他のプロセスからVIEWが変更されたため更新を中止しました。"
                . $uriage_dt_id . ",uid=" . $uriagegaku_vw->kousin_user_id . " tb=" . $uriagegaku_vw->updated . " pt=" . $this->request->getPost("updated"));

            $this->dispatcher->forward(array(
                'controller' => "uriagegaku_vws",
                'action' => 'edit',
                'params' => array($uriage_dt_id)
            ));

            return;
        }

        $post_flds = [];
        $post_flds = ["uriage_dt_id",
            "kingaku",
            "kesikomi_gaku",
        ];


        $thisPost = []; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        $chg_flg = 0;
        foreach ($post_flds as $post_fld) {
            if ((array_key_exists($post_fld, $thisPost) ? $thisPost[$post_fld] : $this->request->getPost($post_fld)) !== $uriagegaku_vw->$post_fld) {
                $chg_flg = 1;
                break;
            }
        }
        if ($chg_flg === 0) {
            $this->flash->error("変更がありません。" . $uriage_dt_id);

            $this->dispatcher->forward(array(
                "controller" => "uriagegaku_vws",
                "action" => "edit",
                "params" => array($uriagegaku_vw->uriage_dt_id)
            ));

            return;
        }

        $this->_bakOut($uriagegaku_vw);

        foreach ($post_flds as $post_fld) {
            $uriagegaku_vw->$post_fld = array_key_exists($post_fld, $thisPost) ? $thisPost[$post_fld] : $this->request->getPost($post_fld);
        }

        if (!$uriagegaku_vw->save()) {

            foreach ($uriagegaku_vw->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "uriagegaku_vws",
                'action' => 'edit',
                'params' => array($uriage_dt_id)
            ));

            return;
        }

        $this->flash->success("VIEWの情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "uriagegaku_vws",
            'action' => 'edit',
            'params' => array($uriagegaku_vw->uriage_dt_id)
        ));
    }

    /**
     * Deletes a uriagegaku_vw
     *
     * @param string $uriage_dt_id
     */
    public function deleteAction($uriage_dt_id)
    {
        $uriagegaku_vw = UriagegakuVws::findFirstByuriage_dt_id($uriage_dt_id);
        if (!$uriagegaku_vw) {
            $this->flash->error("VIEWが見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "uriagegaku_vws",
                'action' => 'index'
            ));

            return;
        }

        $this->_bakOut($uriagegaku_vw, 1);

        if (!$uriagegaku_vw->delete()) {

            foreach ($uriagegaku_vw->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "uriagegaku_vws",
                'action' => 'search'
            ));

            return;
        }

        $this->flash->success("VIEWの削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "uriagegaku_vws",
            'action' => "index"
        ));
    }

    /**
     * Back Out a uriagegaku_vw
     *
     * @param string $uriagegaku_vw , $dlt_flg
     */
    public function _bakOut($uriagegaku_vw, $dlt_flg = 0)
    {

        $bak_uriagegaku_vw = new BakUriagegakuVws();
        foreach ($uriagegaku_vw as $fld => $value) {
            $bak_uriagegaku_vw->$fld = $uriagegaku_vw->$fld;
        }
        $bak_uriagegaku_vw->uriage_dt_id = NULL;
        $bak_uriagegaku_vw->moto_uriage_dt_id = $uriagegaku_vw->uriage_dt_id;
        $bak_uriagegaku_vw->hikae_dltflg = $dlt_flg;
        $bak_uriagegaku_vw->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_uriagegaku_vw->hikae_nichiji = date("Y-m-d H:i:s");
        if (!$bak_uriagegaku_vw->save()) {
            foreach ($bak_uriagegaku_vw->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
    }

    public function ajaxGetAction()
    {
        $this->view->disable();
        $response = new \Phalcon\Http\Response();

        if (!$this->request->isAjax()) {
            echo "is not Ajax ! ";
        }
        if (!$this->request->isPost()) {
            echo "is not Post ! ";
        }

        //消込データの取得が出来ていなかったので以下データ受け渡し部分変更
        $uriagegaku_vws = UriagegakuVws::find([
            'order' => 'uriagebi,cd',
            'conditions' => 'seikyuusaki_mr_cd = ?1',
            'bind' => [1 => $this->request->getPost('cd')],
        ]);

        $meisai_flg = $this->request->getPost('meisai_flg') ?? 0; // 明細で渡すか？
        $resData = [];
        foreach ($uriagegaku_vws as $uriagegaku_dt) {
            if ($meisai_flg == 0) {
                $resAdata = [];
                $resAdata["id"] = $uriagegaku_dt->uriage_dt_id;
                $resAdata["cd"] = $uriagegaku_dt->cd;
                $resAdata["uriagebi"] = $uriagegaku_dt->uriagebi;
                $resAdata["torihiki_kbn_name"] = $uriagegaku_dt->UriageDts->TorihikiKbns->name;
                $resAdata["kingaku"] = $uriagegaku_dt->kingaku;
                $resAdata["kesikomi_gaku"] = $uriagegaku_dt->kesikomi_gaku;
                $resAdata['kesikomi_id'] = $uriagegaku_dt->kesikomi_id;
                $resData[] = $resAdata;
            } else {
                $gyouban = 0;
                foreach ($uriagegaku_dt->UriageDts->UriageMeisaiDts as $meisai_dt) {
                    $resAdata = [];
                    $resAdata["id"] = $meisai_dt->id;
                    $resAdata["cd"] = $uriagegaku_dt->cd . sprintf("%'.4d", ++$gyouban);
                    $resAdata["uriagebi"] = $uriagegaku_dt->uriagebi;
                    $resAdata["torihiki_kbn_name"] = $uriagegaku_dt->UriageDts->TorihikiKbns->name . "-" . $meisai_dt->UtiwakeKbns->name;
                    $resAdata["kingaku"] = $meisai_dt->zeinukigaku + $meisai_dt->zeigaku;
                    $resAdata["kesikomi_gaku"] = $meisai_dt->NyuukinKesikomiDts->kesikomi_gaku;
                    $resAdata['kesikomi_id'] = $meisai_dt->NyuukinKesikomiDts->id;
                    $resData[] = $resAdata;
                }
            }
        }

        $response->setContent(json_encode($resData));
        return $response;
    }

}
