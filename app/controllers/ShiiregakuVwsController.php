<?php


class ShiiregakuVwsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        ControllerBase::indexCd("ShiiregakuVws", "VIEW"); //簡易検索付き一覧表示
    }

    /**
     * Searches for shiiregaku_vws
     */
    public function searchAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Displays the creation form
     */
    public function newAction($id = null, $dataname = "ShiiregakuVws")
    {
        $this->view->imax = 0;

        if ($id) {
            $nameDts = $dataname;
            $shiiregaku_vw = $nameDts::findFirstByid($id);
            if (!$shiiregaku_vw) {
                $this->flash->error("VIEWが見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "shiiregaku_vws",
                    'action' => 'index'
                ));

                return;
            }
            $this->_setDefault($shiiregaku_vw, "new", $dataname);
            $this->tag->setDefault("shiire_dt_id", null);
            $this->tag->setDefault("cd", null);
        }

    }

    /**
     * 修正画面から「次へ」ボタンを押したら次のコードの修正画面になる。
     */
    public function nextAction($id)
    {
        ControllerBase::nextCd($id, "shiiregaku_vws", "ShiiregakuVws", "VIEW");
    }

    /**
     * 修正画面から「前へ」ボタンを押したら前のコードの修正画面になる。
     */
    public function prevAction($id)
    {
        ControllerBase::prevCd($id, "shiiregaku_vws", "ShiiregakuVws", "VIEW");
    }

    /**
     * Edits a shiiregaku_vw
     *
     * @param string $shiire_dt_id
     */
    public function editAction($shiire_dt_id)
    {
//        if (!$this->request->isPost()) {

        $shiiregaku_vw = ShiiregakuVws::findFirstByshiire_dt_id($shiire_dt_id);
        if (!$shiiregaku_vw) {
            $this->flash->error("VIEWが見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "shiiregaku_vws",
                'action' => 'index'
            ));

            return;
        }

        $this->view->shiire_dt_id = $shiiregaku_vw->shiire_dt_id;

        $this->_setDefault($shiiregaku_vw, "edit");
//        }
    }

    /**
     * 画面に表示するデータをセットする
     */
    public function _setDefault($shiiregaku_vw, $action = "edit", $meisai = "ShiiregakuVws")
    {
        $setdts = ["shiire_dt_id",
            "kingaku",
            "kesikomi_gaku",
            "shiiresaki_mr_cd",
            "shiirebi",
            "cd",
        ];

        foreach ($setdts as $setdt) {
            if (property_exists($shiiregaku_vw, $setdt)) {
                $this->tag->setDefault($setdt, $shiiregaku_vw->$setdt);
            }
        }
    }

    /**
     * Creates a new shiiregaku_vw
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "shiiregaku_vws",
                'action' => 'index'
            ));

            return;
        }

        $shiiregaku_vw = new ShiiregakuVws();

        $post_flds = [];
        $post_flds = ["shiire_dt_id",
            "kingaku",
            "kesikomi_gaku",
            "shiiresaki_mr_cd",
            "shiirebi",
            "cd",
        ];


        $thisPost = []; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        foreach ($post_flds as $post_fld) {
            $shiiregaku_vw->$post_fld = array_key_exists($post_fld, $thisPost) ? $thisPost[$post_fld] : $this->request->getPost($post_fld);
        }

        if (!$shiiregaku_vw->save()) {
            foreach ($shiiregaku_vw->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "shiiregaku_vws",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("VIEWの作成が完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "shiiregaku_vws",
            'action' => 'edit',
            'params' => array($shiiregaku_vw->shiire_dt_id)
        ));
    }

    /**
     * Saves a shiiregaku_vw edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "shiiregaku_vws",
                'action' => 'index'
            ));

            return;
        }

        $shiire_dt_id = $this->request->getPost("shiire_dt_id");
        $shiiregaku_vw = ShiiregakuVws::findFirstByshiire_dt_id($shiire_dt_id);

        if (!$shiiregaku_vw) {
            $this->flash->error("VIEWが見つからなくなりました。" . $shiire_dt_id);

            $this->dispatcher->forward(array(
                'controller' => "shiiregaku_vws",
                'action' => 'index'
            ));

            return;
        }

        if ($shiiregaku_vw->updated !== $this->request->getPost("updated")) {
            $this->flash->error("他のプロセスからVIEWが変更されたため更新を中止しました。"
                . $shiire_dt_id . ",uid=" . $shiiregaku_vw->kousin_user_id . " tb=" . $shiiregaku_vw->updated . " pt=" . $this->request->getPost("updated"));

            $this->dispatcher->forward(array(
                'controller' => "shiiregaku_vws",
                'action' => 'edit',
                'params' => array($shiire_dt_id)
            ));

            return;
        }

        $post_flds = [];
        $post_flds = ["shiire_dt_id",
            "kingaku",
            "kesikomi_gaku",
            "shiiresaki_mr_cd",
            "shiirebi",
            "cd",
        ];


        $thisPost = []; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        $chg_flg = 0;
        foreach ($post_flds as $post_fld) {
            if ((array_key_exists($post_fld, $thisPost) ? $thisPost[$post_fld] : $this->request->getPost($post_fld)) !== $shiiregaku_vw->$post_fld) {
                $chg_flg = 1;
                break;
            }
        }
        if ($chg_flg === 0) {
            $this->flash->error("変更がありません。" . $shiire_dt_id);

            $this->dispatcher->forward(array(
                "controller" => "shiiregaku_vws",
                "action" => "edit",
                "params" => array($shiiregaku_vw->shiire_dt_id)
            ));

            return;
        }

        $this->_bakOut($shiiregaku_vw);

        foreach ($post_flds as $post_fld) {
            $shiiregaku_vw->$post_fld = array_key_exists($post_fld, $thisPost) ? $thisPost[$post_fld] : $this->request->getPost($post_fld);
        }

        if (!$shiiregaku_vw->save()) {

            foreach ($shiiregaku_vw->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "shiiregaku_vws",
                'action' => 'edit',
                'params' => array($shiire_dt_id)
            ));

            return;
        }

        $this->flash->success("VIEWの情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "shiiregaku_vws",
            'action' => 'edit',
            'params' => array($shiiregaku_vw->shiire_dt_id)
        ));
    }

    /**
     * Deletes a shiiregaku_vw
     *
     * @param string $shiire_dt_id
     */
    public function deleteAction($shiire_dt_id)
    {
        $shiiregaku_vw = ShiiregakuVws::findFirstByshiire_dt_id($shiire_dt_id);
        if (!$shiiregaku_vw) {
            $this->flash->error("VIEWが見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "shiiregaku_vws",
                'action' => 'index'
            ));

            return;
        }

        $this->_bakOut($shiiregaku_vw, 1);

        if (!$shiiregaku_vw->delete()) {

            foreach ($shiiregaku_vw->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "shiiregaku_vws",
                'action' => 'search'
            ));

            return;
        }

        $this->flash->success("VIEWの削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "shiiregaku_vws",
            'action' => "index"
        ));
    }

    /**
     * Back Out a shiiregaku_vw
     *
     * @param string $shiiregaku_vw , $dlt_flg
     */
    public function _bakOut($shiiregaku_vw, $dlt_flg = 0)
    {

        $bak_shiiregaku_vw = new BakShiiregakuVws();
        foreach ($shiiregaku_vw as $fld => $value) {
            $bak_shiiregaku_vw->$fld = $shiiregaku_vw->$fld;
        }
        $bak_shiiregaku_vw->shiire_dt_id = NULL;
        $bak_shiiregaku_vw->moto_shiire_dt_id = $shiiregaku_vw->shiire_dt_id;
        $bak_shiiregaku_vw->hikae_dltflg = $dlt_flg;
        $bak_shiiregaku_vw->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_shiiregaku_vw->hikae_nichiji = date("Y-m-d H:i:s");
        if (!$bak_shiiregaku_vw->save()) {
            foreach ($bak_shiiregaku_vw->getMessages() as $message) {
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
        $shiiregaku_vws = ShiiregakuVws::find([
            'order' => 'shiirebi, cd',
            'conditions' => 'shiiresaki_mr_cd = ?1',
            'bind' => [1 => $this->request->getPost('cd')]
        ]);

        $meisai_flg = $this->request->getPost('meisai_flg') ?? 0; // 明細で渡すか？
        $resData = [];
        foreach ($shiiregaku_vws as $shiiregaku_dt) {
            if ($meisai_flg == 0) {
                $resAdata = [];
                $resAdata["id"] = $shiiregaku_dt->shiire_dt_id;
                $resAdata["cd"] = $shiiregaku_dt->cd;
                $resAdata["shiirebi"] = $shiiregaku_dt->shiirebi;
                $resAdata["torihiki_kbn_name"] = $shiiregaku_dt->ShiireDts->TorihikiKbns->name;
                $resAdata["kingaku"] = $shiiregaku_dt->kingaku;
                $resAdata["kesikomi_gaku"] = $shiiregaku_dt->kesikomi_gaku;
                $resAdata["kesikomi_id"] = $shiiregaku_dt->kesikomi_id;
                $resData[] = $resAdata;
            } else {
                $gyouban = 0;
                foreach ($shiiregaku_dt->ShiireDts->ShiireMeisaiDts as $meisai_dt) {
                    $resAdata = [];
                    $resAdata["id"] = $meisai_dt->id;
                    $resAdata["cd"] = $shiiregaku_dt->cd . sprintf("%'.4d", ++$gyouban);
                    $resAdata["shiirebi"] = $shiiregaku_dt->shiirebi;
                    $resAdata["torihiki_kbn_name"] = $shiiregaku_dt->ShiireDts->TorihikiKbns->name . "-" . $meisai_dt->UtiwakeKbns->name;
                    $resAdata["kingaku"] = $meisai_dt->zeinukigaku + $meisai_dt->zeigaku;
                    $resAdata["kesikomi_gaku"] = $meisai_dt->ShukkinKesikomiDts->kesikomi_gaku;
                    $resAdata['kesikomi_id'] = $meisai_dt->ShukkinKesikomiDts->id;
                    $resData[] = $resAdata;
                }
            }
        }

        $response->setContent(json_encode($resData));
        return $response;
    }

}
