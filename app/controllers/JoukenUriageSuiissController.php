<?php

class JoukenUriageSuiissController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        ControllerBase::indexCd("JoukenUriageSuiiss", "条件売上日報"); //簡易検索付き一覧表示
    }

    /**
     * Searches for jouken_uriage_suiiss
     */
    public function searchAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Displays the creation form
     */
    public function newAction($id=null, $dataname="JoukenUriageSuiiss")
    {
        $this->view->imax = 0;

        if ($id) {
            $nameDts = $dataname;
            $jouken_uriage_suiis = $nameDts::findFirstByid($id);
            if (!$jouken_uriage_suiis) {
                $this->flash->error("条件売上日報が見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "jouken_uriage_suiiss",
                    'action' => 'index'
                ));

                return;
            }
            $this->_setDefault($jouken_uriage_suiis, "new", $dataname);
            $this->tag->setDefault("id", null);
            $this->tag->setDefault("cd", null);
        }

    }

    /**
     * 修正画面から「次へ」ボタンを押したら次のコードの修正画面になる。
     */
    public function nextAction($id)
    {
        ControllerBase::nextCd($id, "jouken_uriage_suiiss", "JoukenUriageSuiiss", "条件売上日報");
    }

    /**
     * 修正画面から「前へ」ボタンを押したら前のコードの修正画面になる。
     */
    public function prevAction($id)
    {
        ControllerBase::prevCd($id, "jouken_uriage_suiiss", "JoukenUriageSuiiss", "条件売上日報");
    }

    /**
     * Edits a jouken_uriage_suiis
     *
     * @param string $id
     */
    public function editAction($id)
    {
//        if (!$this->request->isPost()) {

            $jouken_uriage_suiis = JoukenUriageSuiiss::findFirstByid($id);
            if (!$jouken_uriage_suiis) {
                $this->flash->error("条件売上日報が見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "jouken_uriage_suiiss",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->id = $jouken_uriage_suiis->id;

            $this->_setDefault($jouken_uriage_suiis, "edit");
//        }
    }

    /**
     * 画面に表示するデータをセットする
     */
    public function _setDefault($jouken_uriage_suiis, $action="edit", $meisai="JoukenUriageSuiiss")
    {
        $setdts = ["id",
            "cd",
            "name",
            "junjo_kbn_cd",
            "koujun_flg",
            "hanni_from",
            "hanni_to",
            "kikan_sitei_kbn_cd",
            "kikan_from",
            "kikan_to",
            "zeikomi_flg",
            "meisaigyou_flg",
            "goukeigyou_flg",
            "torihikiari_flg",
            "torihikinasi_flg",
            "hokakei_flg",
            "zennnen_flg",
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
            if (property_exists($jouken_uriage_suiis, $setdt)) {
                $this->tag->setDefault($setdt, $jouken_uriage_suiis->$setdt);
            }
        }
    }

    /**
     * Creates a new jouken_uriage_suiis
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "jouken_uriage_suiiss",
                'action' => 'index'
            ));

            return;
        }

        $jouken_uriage_suiis = new JoukenUriageSuiiss();

        $post_flds = [];
        $post_flds = ["cd",
            "name",
            "junjo_kbn_cd",
            "koujun_flg",
            "hanni_from",
            "hanni_to",
            "kikan_sitei_kbn_cd",
            "kikan_from",
            "kikan_to",
            "zeikomi_flg",
            "meisaigyou_flg",
            "goukeigyou_flg",
            "torihikiari_flg",
            "torihikinasi_flg",
            "hokakei_flg",
            "zennnen_flg",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        foreach ($post_flds as $post_fld) {
            $jouken_uriage_suiis->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$jouken_uriage_suiis->save()) {
            foreach ($jouken_uriage_suiis->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "jouken_uriage_suiiss",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("条件売上日報の作成が完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "jouken_uriage_suiiss",
            'action' => 'edit',
            'params' => array($jouken_uriage_suiis->id)
        ));
    }

    /**
     * Saves a jouken_uriage_suiis edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "jouken_uriage_suiiss",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $jouken_uriage_suiis = JoukenUriageSuiiss::findFirstByid($id);

        if (!$jouken_uriage_suiis) {
            $this->flash->error("条件売上日報が見つからなくなりました。" . $id);

            $this->dispatcher->forward(array(
                'controller' => "jouken_uriage_suiiss",
                'action' => 'index'
            ));

            return;
        }

        if ($jouken_uriage_suiis->updated !== $this->request->getPost("updated")) {
            $this->flash->error("他のプロセスから条件売上日報が変更されたため更新を中止しました。"
                . $id . ",uid=" . $jouken_uriage_suiis->kousin_user_id . " tb=" . $jouken_uriage_suiis->updated ." pt=" . $this->request->getPost("updated"));

            $this->dispatcher->forward(array(
                'controller' => "jouken_uriage_suiiss",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $post_flds = [];
        $post_flds = ["cd",
            "name",
            "junjo_kbn_cd",
            "koujun_flg",
            "hanni_from",
            "hanni_to",
            "kikan_sitei_kbn_cd",
            "kikan_from",
            "kikan_to",
            "zeikomi_flg",
            "meisaigyou_flg",
            "goukeigyou_flg",
            "torihikiari_flg",
            "torihikinasi_flg",
            "hokakei_flg",
            "zennnen_flg",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        $chg_flg = 0;
        foreach ($post_flds as $post_fld) {
            if ((array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld)) !== $jouken_uriage_suiis->$post_fld) {
                $chg_flg = 1;
                break;
            }
        }
        if ($chg_flg === 0) {
            $this->flash->error("変更がありません。" . $id);

            $this->dispatcher->forward(array(
                "controller" => "jouken_uriage_suiiss",
                "action" => "edit",
                "params" => array($jouken_uriage_suiis->id)
            ));

            return;
        }

        $this->_bakOut($jouken_uriage_suiis);

        foreach ($post_flds as $post_fld) {
            $jouken_uriage_suiis->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$jouken_uriage_suiis->save()) {

            foreach ($jouken_uriage_suiis->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "jouken_uriage_suiiss",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $this->flash->success("条件売上日報の情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "jouken_uriage_suiiss",
            'action' => 'edit',
            'params' => array($jouken_uriage_suiis->id)
        ));
    }

    /**
     * Deletes a jouken_uriage_suiis
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $jouken_uriage_suiis = JoukenUriageSuiiss::findFirstByid($id);
        if (!$jouken_uriage_suiis) {
            $this->flash->error("条件売上日報が見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "jouken_uriage_suiiss",
                'action' => 'index'
            ));

            return;
        }

        $this->_bakOut($jouken_uriage_suiis, 1);

        if (!$jouken_uriage_suiis->delete()) {

            foreach ($jouken_uriage_suiis->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "jouken_uriage_suiiss",
                'action' => 'search'
            ));

            return;
        }

        $this->flash->success("条件売上日報の削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "jouken_uriage_suiiss",
            'action' => "index"
        ));
    }

    /**
     * Back Out a jouken_uriage_suiis
     *
     * @param string $jouken_uriage_suiis, $dlt_flg
     */
    public function _bakOut($jouken_uriage_suiis, $dlt_flg = 0)
    {

        $bak_jouken_uriage_suiis = new BakJoukenUriageSuiiss();
        foreach ($jouken_uriage_suiis as $fld => $value) {
            $bak_jouken_uriage_suiis->$fld = $jouken_uriage_suiis->$fld;
        }
        $bak_jouken_uriage_suiis->id = NULL;
        $bak_jouken_uriage_suiis->moto_id = $jouken_uriage_suiis->id;
        $bak_jouken_uriage_suiis->hikae_dltflg = $dlt_flg;
        $bak_jouken_uriage_suiis->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_jouken_uriage_suiis->hikae_nitiji = date("Y-m-d H:i:s");
        if (!$bak_jouken_uriage_suiis->save()) {
            foreach ($bak_jouken_uriage_suiis->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
    }

    /**
     * 条件設定モーダル
     */
    public function modalAction($id = 0)
    {
        if ($id != 0) {
            $jouken_uriage_suiiss = JoukenUriageSuiiss::findFirstByid($id);
            if (!$jouken_uriage_suiiss) {
                $this->flash->error("条件が見つからなくなりました。");
                $this->dispatcher->forward(array(
                    'controller' => "jouken_uriage_suiiss",
                    'action' => 'modal'
                ));
                return;
            }
            $this->_setDefault($jouken_uriage_suiiss, "edit");
        }
        $jouken_uriage_suiiss = JoukenUriageSuiiss::find(["order"=>"cd, sakusei_user_id"
            , "conditions" => "sakusei_user_id IN(0, ?0)"
            , "bind"=>[0=>$this->getDI()->getSession()->get('auth')['id']]
        ]);
        $joukens = [];
        foreach ($jouken_uriage_suiiss as $jouken_uriage_suii) {
            $joukens[$jouken_uriage_suii->cd] = $jouken_uriage_suii->name;
        }
        $this->view->joukens = $joukens;
    }

    /**
     * モーダルからSave
     *
     */
    public function modalsaveAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "jouken_uriage_suiiss",
                'action' => 'index'
            ));
            return;
        }
        if ($this->request->getPost("cd")) {
            $cd = $this->request->getPost("cd");
            $jouken_uriage_suiiss = JoukenUriageSuiiss::findFirst(["conditions"=>"cd = ?0 AND sakusei_user_id = ?1"
                , "bind" => [0 => $cd, 1 => $this->getDI()->getSession()->get('auth')['id']]
            ]);
        } else {
            $lastcd = JoukenUriageSuiiss::findFirst(["order"=>"cd DESC"
                , "conditions"=>"sakusei_user_id IN(0, ?0)"
                , "bind" => [0 => $this->getDI()->getSession()->get('auth')['id']]
            ]);
            $cd = "".((int)$lastcd->cd + 1);
        }
        $post_flds = [];
        $post_flds = [
            "name",
            "junjo_kbn_cd",
            "koujun_flg",
            "hanni_from",
            "hanni_to",
            "kikan_sitei_kbn_cd",
            "kikan_from",
            "kikan_to",
            "zeikomi_flg",
            "meisaigyou_flg",
            "goukeigyou_flg",
            "torihikiari_flg",
            "torihikinasi_flg",
            "hokakei_flg",
            "zennnen_flg",
            "updated",
        ];
        $thisPost=[];
        $chg_flg = 0;
        if ($this->request->getPost("cd") && $jouken_uriage_suiiss) {
            foreach ($post_flds as $post_fld) {
                if ((array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld)) !== $jouken_uriage_suiiss->$post_fld) {
                    $chg_flg = 1;
                    break;
                }
            }
            if ($chg_flg === 0) {
                $this->flash->error("変更がありません。" . $jouken_uriage_suiiss->id);
                $this->dispatcher->forward(array(
                    "controller" => "jouken_uriage_suiiss",
                    "action" => "modal",
                    "params" => array($jouken_uriage_suiiss->id)
                ));
                return;
            }
            $this->_bakOut($jouken_uriage_suiiss);
        } else {
            $jouken_uriage_suiiss = new JoukenUriageSuiiss();
            $jouken_uriage_suiiss->cd = $cd;
        }
        foreach ($post_flds as $post_fld) {
            $jouken_uriage_suiiss->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }
        if (!$jouken_uriage_suiiss->save()) {
            foreach ($jouken_uriage_suiiss->getMessages() as $message) {
                $this->flash->error($message);
            }
            $this->dispatcher->forward(array(
                'controller' => "jouken_uriage_suiiss",
                'action' => 'modal'
            ));
            return;
        }
        $this->flash->success("条件の情報を更新しました");
        $this->dispatcher->forward(array(
            'controller' => "jouken_uriage_suiiss",
            'action' => 'modal',
            'params' => array($jouken_uriage_suiiss->id)
        ));
    }

    /**
     * モーダルDelete
     */
    public function modaldelAction($cd)
    {
        if (!$cd) {
            $this->flash->error("削除する条件がありません。");
            $this->dispatcher->forward(array(
                'controller' => "jouken_uriage_suiiss",
                'action' => 'modal'
            ));
            return;
        }
        $jouken_uriage_suiiss = JoukenUriageSuiiss::findFirst(["conditions"=>"cd = ?0 AND sakusei_user_id = ?1"
            , "bind" => [0 => $cd, 1 => $this->getDI()->getSession()->get('auth')['id']]
        ]);
        if (!$jouken_uriage_suiiss) {
            $this->flash->error("削除する条件が見つかりません。");
            $this->dispatcher->forward(array(
                'controller' => "jouken_uriage_suiiss",
                'action' => 'modal'
            ));
            return;
        }
        $this->_bakOut($jouken_uriage_suiiss, 1);
        if (!$jouken_uriage_suiiss->delete()) {
            foreach ($jouken_uriage_suiiss->getMessages() as $message) {
                $this->flash->error($message);
            }
            $this->dispatcher->forward(array(
                'controller' => "jouken_uriage_suiiss",
                'action' => 'modal'
            ));
            return;
        }
        $this->flash->success("条件の削除を完了しました。");
        $this->dispatcher->forward(array(
            'controller' => "jouken_uriage_suiiss",
            'action' => "modal"
        ));
    }

    /**
     * 条件設定データ
     */
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
        $jouken_uriage_suiiss = JoukenUriageSuiiss::find(array(
            'order' => 'sakusei_user_id DESC',
            'conditions' => 'cd = ?0 AND sakusei_user_id IN(0, ?1)',
            'bind' => array(0 => $this->request->getPost('cd'), 1 => $this->getDI()->getSession()->get('auth')['id'])
        ));
        $res_flds = [
            "cd",
            "name",
            "junjo_kbn_cd",
            "koujun_flg",
            "hanni_from",
            "hanni_to",
            "kikan_sitei_kbn_cd",
            "kikan_from",
            "kikan_to",
            "zeikomi_flg",
            "meisaigyou_flg",
            "goukeigyou_flg",
            "torihikiari_flg",
            "torihikinasi_flg",
            "hokakei_flg",
            "zennnen_flg",
        ];
        $resData = array();
        foreach ($jouken_uriage_suiiss as $jouken_uriage_suii) {
            $resAdata = array();
            foreach ($res_flds as $res_fld) {
                $resAdata[$res_fld] = $jouken_uriage_suii->$res_fld;
            }
            $resAdata["junjo_kbn_table"] = $jouken_uriage_suii->JunjoKbns->table;
            $resData[] = $resAdata;
        }
        $response->setContent(json_encode($resData));
        return $response;
    }
}

