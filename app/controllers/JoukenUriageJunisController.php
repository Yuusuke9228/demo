<?php


class JoukenUriageJunisController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        ControllerBase::indexCd("JoukenUriageJunis", "条件売上順位"); //簡易検索付き一覧表示
    }

    /**
     * Searches for jouken_uriage_junis
     */
    public function searchAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Displays the creation form
     */
    public function newAction($id = null, $dataname = "JoukenUriageJunis")
    {
        $this->view->imax = 0;
        if ($id) {
            $nameDts = $dataname;
            $jouken_uriage_juni = $nameDts::findFirstByid($id);
            if (!$jouken_uriage_juni) {
                $this->flash->error("条件が見つからなくなりました。");
                $this->dispatcher->forward(array(
                    'controller' => "jouken_uriage_junis",
                    'action' => 'index'
                ));
                return;
            }
            $this->_setDefault($jouken_uriage_juni, "new", $dataname);
            $this->tag->setDefault("id", null);
            $this->tag->setDefault("cd", null);
        }
    }

    /**
     * 修正画面から「次へ」ボタンを押したら次のコードの修正画面になる。
     */
    public function nextAction($id)
    {
        ControllerBase::nextCd($id, "jouken_uriage_junis", "JoukenUriageJunis", "条件売上日報");
    }

    /**
     * 修正画面から「前へ」ボタンを押したら前のコードの修正画面になる。
     */
    public function prevAction($id)
    {
        ControllerBase::prevCd($id, "jouken_uriage_junis", "JoukenUriageJunis", "条件売上日報");
    }

    /**
     * Edits a jouken_uriage_juni
     *
     * @param string $id
     */
    public function editAction($id)
    {
        $jouken_uriage_juni = JoukenUriageJunis::findFirstByid($id);
        if (!$jouken_uriage_juni) {
            $this->flash->error("条件売上日報が見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "jouken_uriage_junis",
                'action' => 'index'
            ));

            return;
        }
        $this->view->id = $jouken_uriage_juni->id;
        $this->_setDefault($jouken_uriage_juni, "edit");
    }

    /**
     * 画面に表示するデータをセットする
     */
    public function _setDefault($jouken_uriage_juni, $action = "edit", $meisai = "JoukenUriageJunis")
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
            if (property_exists($jouken_uriage_juni, $setdt)) {
                $this->tag->setDefault($setdt, $jouken_uriage_juni->$setdt);
            }
        }
    }

    /**
     * Creates a new jouken_uriage_juni
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "jouken_uriage_junis",
                'action' => 'index'
            ));
            return;
        }

        $jouken_uriage_juni = new JoukenUriageJunis();
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
        $thisPost = [];
        foreach ($post_flds as $post_fld) {
            $jouken_uriage_juni->$post_fld = array_key_exists($post_fld, $thisPost) ? $thisPost[$post_fld] : $this->request->getPost($post_fld);
        }

        if (!$jouken_uriage_juni->save()) {
            foreach ($jouken_uriage_juni->getMessages() as $message) {
                $this->flash->error($message);
            }
            $this->dispatcher->forward(array(
                'controller' => "jouken_uriage_junis",
                'action' => 'new'
            ));
            return;
        }
        $this->flash->success("条件の作成が完了しました。");
        $this->dispatcher->forward(array(
            'controller' => "jouken_uriage_junis",
            'action' => 'edit',
            'params' => array($jouken_uriage_juni->id)
        ));
    }

    /**
     * Saves
     *
     */
    public function saveAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "jouken_uriage_junis",
                'action' => 'index'
            ));
            return;
        }
        $id = $this->request->getPost("id");
        $jouken_uriage_juni = JoukenUriageJunis::findFirstByid($id);
        if (!$jouken_uriage_juni) {
            $this->flash->error("条件が見つからなくなりました。" . $id);
            $this->dispatcher->forward(array(
                'controller' => "jouken_uriage_junis",
                'action' => 'index'
            ));
            return;
        }
        if ($jouken_uriage_juni->updated !== $this->request->getPost("updated")) {
            $this->flash->error("他のプロセスから条件が変更されたため更新を中止しました。"
                . $id . ",uid=" . $jouken_uriage_juni->kousin_user_id . " tb=" . $jouken_uriage_juni->updated . " pt=" . $this->request->getPost("updated"));

            $this->dispatcher->forward(array(
                'controller' => "jouken_uriage_junis",
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
        $thisPost = [];
        $chg_flg = 0;
        foreach ($post_flds as $post_fld) {
            if ((array_key_exists($post_fld, $thisPost) ? $thisPost[$post_fld] : $this->request->getPost($post_fld)) !== $jouken_uriage_juni->$post_fld) {
                $chg_flg = 1;
                break;
            }
        }
        if ($chg_flg === 0) {
            $this->flash->error("変更がありません。" . $id);
            $this->dispatcher->forward(array(
                "controller" => "jouken_uriage_junis",
                "action" => "edit",
                "params" => array($jouken_uriage_juni->id)
            ));
            return;
        }
        $this->_bakOut($jouken_uriage_juni);
        foreach ($post_flds as $post_fld) {
            $jouken_uriage_juni->$post_fld = array_key_exists($post_fld, $thisPost) ? $thisPost[$post_fld] : $this->request->getPost($post_fld);
        }
        if (!$jouken_uriage_juni->save()) {
            foreach ($jouken_uriage_juni->getMessages() as $message) {
                $this->flash->error($message);
            }
            $this->dispatcher->forward(array(
                'controller' => "jouken_uriage_junis",
                'action' => 'edit',
                'params' => array($id)
            ));
            return;
        }

        $this->flash->success("条件を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "jouken_uriage_junis",
            'action' => 'edit',
            'params' => array($jouken_uriage_juni->id)
        ));
    }

    /**
     * Deletes a jouken_uriage_juni
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $jouken_uriage_juni = JoukenUriageJunis::findFirstByid($id);
        if (!$jouken_uriage_juni) {
            $this->flash->error("条件が見つからなくなりました。");
            $this->dispatcher->forward(array(
                'controller' => "jouken_uriage_junis",
                'action' => 'index'
            ));
            return;
        }
        $this->_bakOut($jouken_uriage_juni, 1);
        if (!$jouken_uriage_juni->delete()) {
            foreach ($jouken_uriage_juni->getMessages() as $message) {
                $this->flash->error($message);
            }
            $this->dispatcher->forward(array(
                'controller' => "jouken_uriage_junis",
                'action' => 'search'
            ));
            return;
        }
        $this->flash->success("条件の削除を完了しました。");
        $this->dispatcher->forward(array(
            'controller' => "jouken_uriage_junis",
            'action' => "index"
        ));
    }

    /**
     * Back Out a jouken_uriage_juni
     *
     * @param string $jouken_uriage_juni , $dlt_flg
     */
    public function _bakOut($jouken_uriage_juni, $dlt_flg = 0)
    {
        $bak_jouken_uriage_juni = new BakJoukenUriageJunis();
        foreach ($jouken_uriage_juni as $fld => $value) {
            $bak_jouken_uriage_juni->$fld = $jouken_uriage_juni->$fld;
        }
        $bak_jouken_uriage_juni->id = NULL;
        $bak_jouken_uriage_juni->moto_id = $jouken_uriage_juni->id;
        $bak_jouken_uriage_juni->hikae_dltflg = $dlt_flg;
        $bak_jouken_uriage_juni->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_jouken_uriage_juni->hikae_nitiji = date("Y-m-d H:i:s");
        if (!$bak_jouken_uriage_juni->save()) {
            foreach ($bak_jouken_uriage_juni->getMessages() as $message) {
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
            $jouken_uriage_junis = JoukenUriageJunis::findFirstByid($id);
            if (!$jouken_uriage_junis) {
                $this->flash->error("条件が見つからなくなりました。");
                $this->dispatcher->forward(array(
                    'controller' => "jouken_uriage_junis",
                    'action' => 'modal'
                ));
                return;
            }
            $this->_setDefault($jouken_uriage_junis, "edit");
        }
        $jouken_uriage_junis = JoukenUriageJunis::find(["order" => "cd, sakusei_user_id"
            , "conditions" => "sakusei_user_id IN(0, ?0)"
            , "bind" => [0 => $this->getDI()->getSession()->get('auth')['id']]
        ]);
        $joukens = [];
        foreach ($jouken_uriage_junis as $jouken_uriage_juni) {
            $joukens[$jouken_uriage_juni->cd] = $jouken_uriage_juni->name;
        }
        $this->view->joukens = $joukens;
    }

    /**
     * モーダルからSaves
     *
     */
    public function modalsaveAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "jouken_uriage_junis",
                'action' => 'index'
            ));
            return;
        }

        if ($this->request->getPost("cd")) {
            $cd = $this->request->getPost("cd");
            $jouken_uriage_junis = JoukenUriageJunis::findFirst(["conditions" => "cd = ?0 AND sakusei_user_id = ?1"
                , "bind" => [0 => $cd, 1 => $this->getDI()->getSession()->get('auth')['id']]
            ]);
        } else {
            $lastcd = JoukenUriageJunis::findFirst(["order" => "cd DESC"
                , "conditions" => "sakusei_user_id IN(0, ?0)"
                , "bind" => [0 => $this->getDI()->getSession()->get('auth')['id']]
            ]);
            $cd = "" . ((int)$lastcd->cd + 1);
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
        $thisPost = [];
        $chg_flg = 0;
        if ($this->request->getPost("cd") && $jouken_uriage_junis) {
            foreach ($post_flds as $post_fld) {
                if ((array_key_exists($post_fld, $thisPost) ? $thisPost[$post_fld] : $this->request->getPost($post_fld)) !== $jouken_uriage_junis->$post_fld) {
                    $chg_flg = 1;
                    break;
                }
            }
            if ($chg_flg === 0) {
                $this->flash->error("変更がありません。" . $jouken_uriage_junis->id);
                $this->dispatcher->forward(array(
                    "controller" => "jouken_uriage_junis",
                    "action" => "modal",
                    "params" => array($jouken_uriage_junis->id)
                ));

                return;
            }
            $this->_bakOut($jouken_uriage_junis);
        } else {
            $jouken_uriage_junis = new JoukenUriageJunis();
            $jouken_uriage_junis->cd = $cd;
        }
        foreach ($post_flds as $post_fld) {
            $jouken_uriage_junis->$post_fld = array_key_exists($post_fld, $thisPost) ? $thisPost[$post_fld] : $this->request->getPost($post_fld);
        }
        if (!$jouken_uriage_junis->save()) {
            foreach ($jouken_uriage_junis->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "jouken_uriage_junis",
                'action' => 'modal'
            ));
            return;
        }
        $this->flash->success("条件を更新しました。");
        $this->dispatcher->forward(array(
            'controller' => "jouken_uriage_junis",
            'action' => 'modal',
            'params' => array($jouken_uriage_junis->id)
        ));
    }

    /**
     * モーダルDeletes
     */
    public function modaldelAction($cd)
    {
        if (!$cd) {
            $this->flash->error("削除する条件がありません。");
            $this->dispatcher->forward(array(
                'controller' => "jouken_uriage_junis",
                'action' => 'modal'
            ));
            return;
        }
        $jouken_uriage_junis = JoukenUriageJunis::findFirst(["conditions" => "cd = ?0 AND sakusei_user_id = ?1"
            , "bind" => [0 => $cd, 1 => $this->getDI()->getSession()->get('auth')['id']]
        ]);
        if (!$jouken_uriage_junis) {
            $this->flash->error("削除する条件が見つかりません。");
            $this->dispatcher->forward(array(
                'controller' => "jouken_uriage_junis",
                'action' => 'modal'
            ));
            return;
        }
        $this->_bakOut($jouken_uriage_junis, 1);
        if (!$jouken_uriage_junis->delete()) {
            foreach ($jouken_uriage_junis->getMessages() as $message) {
                $this->flash->error($message);
            }
            $this->dispatcher->forward(array(
                'controller' => "jouken_uriage_junis",
                'action' => 'modal'
            ));
            return;
        }
        $this->flash->success("条件の削除を完了しました。");
        $this->dispatcher->forward(array(
            'controller' => "jouken_uriage_junis",
            'action' => "modal"
        ));
    }

    /**
     * 条件設定データ呼び出し
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
        $jouken_uriage_junis = JoukenUriageJunis::find(array(
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
        foreach ($jouken_uriage_junis as $jouken_uriage_juni) {
            $resAdata = array();
            foreach ($res_flds as $res_fld) {
                $resAdata[$res_fld] = $jouken_uriage_juni->$res_fld;
            }
            $resAdata["junjo_kbn_table"] = $jouken_uriage_juni->JunjoKbns->table;
            $resData[] = $resAdata;
        }
        $response->setContent(json_encode($resData));
        return $response;
    }
}

