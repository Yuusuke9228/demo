<?php

class JoukenUriageBunsekisController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        ControllerBase::indexCd("JoukenUriageBunsekis", "条件売上分析"); //簡易検索付き一覧表示
    }

    /**
     * Searches for jouken_uriage_bunsekis
     */
    public function searchAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Displays the creation form
     */
    public function newAction($id = null, $dataname = "JoukenUriageBunsekis")
    {
        $this->view->imax = 0;

        if ($id) {
            $nameDts = $dataname;
            $jouken_uriage_bunseki = $nameDts::findFirstByid($id);
            if (!$jouken_uriage_bunseki) {
                $this->flash->error("条件が見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "jouken_uriage_bunsekis",
                    'action' => 'index'
                ));

                return;
            }
            $this->_setDefault($jouken_uriage_bunseki, "new", $dataname);
            $this->tag->setDefault("id", null);
            $this->tag->setDefault("cd", null);
        }

    }

    /**
     * 修正画面から「次へ」ボタンを押したら次のコードの修正画面になる。
     */
    public function nextAction($id)
    {
        ControllerBase::nextCd($id, "jouken_uriage_bunsekis", "JoukenUriageBunsekis", "条件売上分析");
    }

    /**
     * 修正画面から「前へ」ボタンを押したら前のコードの修正画面になる。
     */
    public function prevAction($id)
    {
        ControllerBase::prevCd($id, "jouken_uriage_bunsekis", "JoukenUriageBunsekis", "条件売上分析");
    }

    /**
     * Edits a jouken_uriage_bunseki
     *
     * @param string $id
     */
    public function editAction($id)
    {
        $jouken_uriage_bunseki = JoukenUriageBunsekis::findFirstByid($id);
        if (!$jouken_uriage_bunseki) {
            $this->flash->error("条件が見つからなくなりました。");
            $this->dispatcher->forward(array(
                'controller' => "jouken_uriage_bunsekis",
                'action' => 'index'
            ));
            return;
        }
        $this->view->id = $jouken_uriage_bunseki->id;
        $this->_setDefault($jouken_uriage_bunseki, "edit");
    }

    /**
     * 画面に表示するデータをセットする
     */
    public function _setDefault($jouken_uriage_bunseki, $action = "edit", $meisai = "JoukenUriageBunsekis")
    {
        $setdts = [
            "id",
            "cd",
            "name",
            "junjo_kbn_cd",
            "hanni_from",
            "hanni_to",
            "junjo2_kbn_cd",
            "hanni2_from",
            "hanni2_to",
            "koujun_flg",
            "meisaigyou_flg",
            "goukeigyou_flg",
            "torihikiari_flg",
            "torihikinashi_flg",
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
            if (property_exists($jouken_uriage_bunseki, $setdt)) {
                $this->tag->setDefault($setdt, $jouken_uriage_bunseki->$setdt);
            }
        }
    }

    /**
     * Creates a new jouken_uriage_bunseki
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "jouken_uriage_bunsekis",
                'action' => 'index'
            ));

            return;
        }

        $jouken_uriage_bunseki = new JoukenUriageBunsekis();
        $post_flds = [
            "id",
            "cd",
            "name",
            "junjo_kbn_cd",
            "hanni_from",
            "hanni_to",
            "junjo2_kbn_cd",
            "hanni2_from",
            "hanni2_to",
            "koujun_flg",
            "meisaigyou_flg",
            "goukeigyou_flg",
            "torihikiari_flg",
            "torihikinashi_flg",
            "id_moto",
            "hikae_dltflg",
            "hikae_user_id",
            "hikae_nichiji",
            "sakusei_user_id",
            "created",
            "kousin_user_id",
            "updated",
        ];
        $thisPost = [];
        foreach ($post_flds as $post_fld) {
            $jouken_uriage_bunseki->$post_fld = array_key_exists($post_fld, $thisPost) ? $thisPost[$post_fld] : $this->request->getPost($post_fld);
        }
        if (!$jouken_uriage_bunseki->save()) {
            foreach ($jouken_uriage_bunseki->getMessages() as $message) {
                $this->flash->error($message);
            }
            $this->dispatcher->forward(array(
                'controller' => "jouken_uriage_bunsekis",
                'action' => 'new'
            ));
            return;
        }
        $this->flash->success("条件の作成が完了しました。");
        $this->dispatcher->forward(array(
            'controller' => "jouken_uriage_bunsekis",
            'action' => 'edit',
            'params' => array($jouken_uriage_bunseki->id)
        ));
    }

    /**
     * Saves a jouken_uriage_bunseki edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "jouken_uriage_bunsekis",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $jouken_uriage_bunseki = JoukenUriageBunsekis::findFirstByid($id);

        if (!$jouken_uriage_bunseki) {
            $this->flash->error("条件が見つからなくなりました。" . $id);

            $this->dispatcher->forward(array(
                'controller' => "jouken_uriage_bunsekis",
                'action' => 'index'
            ));

            return;
        }

        if ($jouken_uriage_bunseki->updated !== $this->request->getPost("updated")) {
            $this->flash->error("他のプロセスから条件が変更されたため更新を中止しました。"
                . $id . ",uid=" . $jouken_uriage_bunseki->kousin_user_id . " tb=" . $jouken_uriage_bunseki->updated . " pt=" . $this->request->getPost("updated"));

            $this->dispatcher->forward(array(
                'controller' => "jouken_uriage_bunsekis",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $post_flds = [
            "id",
            "cd",
            "name",
            "junjo_kbn_cd",
            "hanni_from",
            "hanni_to",
            "junjo2_kbn_cd",
            "hanni2_from",
            "hanni2_to",
            "koujun_flg",
            "meisaigyou_flg",
            "goukeigyou_flg",
            "torihikiari_flg",
            "torihikinashi_flg",
            "id_moto",
            "hikae_dltflg",
            "hikae_user_id",
            "hikae_nichiji",
            "sakusei_user_id",
            "created",
            "kousin_user_id",
            "updated",
        ];
        $thisPost = [];
        $chg_flg = 0;
        foreach ($post_flds as $post_fld) {
            if ((array_key_exists($post_fld, $thisPost) ? $thisPost[$post_fld] : $this->request->getPost($post_fld)) !== $jouken_uriage_bunseki->$post_fld) {
                $chg_flg = 1;
                break;
            }
        }
        if ($chg_flg === 0) {
            $this->flash->error("変更がありません。" . $id);
            $this->dispatcher->forward(array(
                "controller" => "jouken_uriage_bunsekis",
                "action" => "edit",
                "params" => array($jouken_uriage_bunseki->id)
            ));
            return;
        }
        $this->_bakOut($jouken_uriage_bunseki);
        foreach ($post_flds as $post_fld) {
            $jouken_uriage_bunseki->$post_fld = array_key_exists($post_fld, $thisPost) ? $thisPost[$post_fld] : $this->request->getPost($post_fld);
        }
        if (!$jouken_uriage_bunseki->save()) {
            foreach ($jouken_uriage_bunseki->getMessages() as $message) {
                $this->flash->error($message);
            }
            $this->dispatcher->forward(array(
                'controller' => "jouken_uriage_bunsekis",
                'action' => 'edit',
                'params' => array($id)
            ));
            return;
        }
        $this->flash->success("条件の情報を更新しました。");
        $this->dispatcher->forward(array(
            'controller' => "jouken_uriage_bunsekis",
            'action' => 'edit',
            'params' => array($jouken_uriage_bunseki->id)
        ));
    }

    /**
     * Deletes a jouken_uriage_bunseki
     */
    public function deleteAction($id)
    {
        $jouken_uriage_bunseki = JoukenUriageBunsekis::findFirstByid($id);
        if (!$jouken_uriage_bunseki) {
            $this->flash->error("条件が見つからなくなりました。");
            $this->dispatcher->forward(array(
                'controller' => "jouken_uriage_bunsekis",
                'action' => 'index'
            ));
            return;
        }
        $this->_bakOut($jouken_uriage_bunseki, 1);
        if (!$jouken_uriage_bunseki->delete()) {
            foreach ($jouken_uriage_bunseki->getMessages() as $message) {
                $this->flash->error($message);
            }
            $this->dispatcher->forward(array(
                'controller' => "jouken_uriage_bunsekis",
                'action' => 'search'
            ));
            return;
        }
        $this->flash->success("条件の削除を完了しました。");
        $this->dispatcher->forward(array(
            'controller' => "jouken_uriage_bunsekis",
            'action' => "index"
        ));
    }

    /**
     * Back Out a jouken_uriage_bunseki
     */
    public function _bakOut($jouken_uriage_bunseki, $dlt_flg = 0)
    {
        $bak_jouken_uriage_bunseki = new BakJoukenUriageBunsekis();
        foreach ($jouken_uriage_bunseki as $fld => $value) {
            $bak_jouken_uriage_bunseki->$fld = $jouken_uriage_bunseki->$fld;
        }
        $bak_jouken_uriage_bunseki->id = NULL;
        $bak_jouken_uriage_bunseki->moto_id = $jouken_uriage_bunseki->id;
        $bak_jouken_uriage_bunseki->hikae_dltflg = $dlt_flg;
        $bak_jouken_uriage_bunseki->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_jouken_uriage_bunseki->hikae_nitiji = date("Y-m-d H:i:s");
        if (!$bak_jouken_uriage_bunseki->save()) {
            foreach ($bak_jouken_uriage_bunseki->getMessages() as $message) {
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
            $jouken_uriage_bunsekis = JoukenUriageBunsekis::findFirstByid($id);
            if (!$jouken_uriage_bunsekis) {
                $this->flash->error("条件が見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "jouken_uriage_bunsekis",
                    'action' => 'modal'
                ));
                return;
            }
            $this->_setDefault($jouken_uriage_bunsekis, "edit");
        }
        $jouken_uriage_bunsekis = JoukenUriageBunsekis::find(["order" => "cd, sakusei_user_id"
            , "conditions" => "sakusei_user_id IN(0, ?0)"
            , "bind" => [0 => $this->getDI()->getSession()->get('auth')['id']]
        ]);
        $joukens = [];
        foreach ($jouken_uriage_bunsekis as $jouken_uriage_bunseki) {
            $joukens[$jouken_uriage_bunseki->cd] = $jouken_uriage_bunseki->name;
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
                'controller' => "jouken_uriage_bunsekis",
                'action' => 'index'
            ));
            return;
        }
        if ($this->request->getPost("cd")) {
            $cd = $this->request->getPost("cd");
            $jouken_uriage_bunsekis = JoukenUriageBunsekis::findFirst(["conditions" => "cd = ?0 AND sakusei_user_id = ?1"
                , "bind" => [0 => $cd, 1 => $this->getDI()->getSession()->get('auth')['id']]
            ]);
        } else {
            $lastcd = JoukenUriageBunsekis::findFirst(["order" => "cd DESC"
                , "conditions" => "sakusei_user_id IN(0, ?0)"
                , "bind" => [0 => $this->getDI()->getSession()->get('auth')['id']]
            ]);
            $cd = "" . ((int)$lastcd->cd + 1);
        }
        $post_flds = [
            "id",
            "cd",
            "name",
            "junjo_kbn_cd",
            "hanni_from",
            "hanni_to",
            "junjo2_kbn_cd",
            "hanni2_from",
            "hanni2_to",
            "koujun_flg",
            "meisaigyou_flg",
            "goukeigyou_flg",
            "torihikiari_flg",
            "torihikinashi_flg",
            "id_moto",
            "hikae_dltflg",
            "hikae_user_id",
            "hikae_nichiji",
            "sakusei_user_id",
            "created",
            "kousin_user_id",
            "updated",
        ];
        $thisPost = [];
        $chg_flg = 0;
        if ($this->request->getPost("cd") && $jouken_uriage_bunsekis) {
            foreach ($post_flds as $post_fld) {
                if ((array_key_exists($post_fld, $thisPost) ? $thisPost[$post_fld] : $this->request->getPost($post_fld)) !== $jouken_uriage_bunsekis->$post_fld) {
                    $chg_flg = 1;
                    break;
                }
            }
            if ($chg_flg === 0) {
                $this->flash->error("変更がありません。" . $jouken_uriage_bunsekis->id);
                $this->dispatcher->forward(array(
                    "controller" => "jouken_uriage_bunsekis",
                    "action" => "modal",
                    "params" => array($jouken_uriage_bunsekis->id)
                ));
                return;
            }
            $this->_bakOut($jouken_uriage_bunsekis);
        } else {
            $jouken_uriage_bunsekis = new JoukenUriageBunsekis();
            $jouken_uriage_bunsekis->cd = $cd;
        }
        foreach ($post_flds as $post_fld) {
            $jouken_uriage_bunsekis->$post_fld = array_key_exists($post_fld, $thisPost) ? $thisPost[$post_fld] : $this->request->getPost($post_fld);
        }
        if (!$jouken_uriage_bunsekis->save()) {
            foreach ($jouken_uriage_bunsekis->getMessages() as $message) {
                $this->flash->error($message);
            }
            $this->dispatcher->forward(array(
                'controller' => "jouken_uriage_bunsekis",
                'action' => 'modal'
            ));
            return;
        }
        $this->flash->success("条件情報を更新しました。");
        $this->dispatcher->forward(array(
            'controller' => "jouken_uriage_bunsekis",
            'action' => 'modal',
            'params' => array($jouken_uriage_bunsekis->id)
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
                'controller' => "jouken_uriage_bunsekis",
                'action' => 'modal'
            ));
            return;
        }
        $jouken_uriage_bunsekis = JoukenUriageBunsekis::findFirst(["conditions" => "cd = ?0 AND sakusei_user_id = ?1"
            , "bind" => [0 => $cd, 1 => $this->getDI()->getSession()->get('auth')['id']]
        ]);
        if (!$jouken_uriage_bunsekis) {
            $this->flash->error("削除する条件が見つかりません。");

            $this->dispatcher->forward(array(
                'controller' => "jouken_uriage_bunsekis",
                'action' => 'modal'
            ));
            return;
        }
        $this->_bakOut($jouken_uriage_bunsekis, 1);
        if (!$jouken_uriage_bunsekis->delete()) {
            foreach ($jouken_uriage_bunsekis->getMessages() as $message) {
                $this->flash->error($message);
            }
            $this->dispatcher->forward(array(
                'controller' => "jouken_uriage_bunsekis",
                'action' => 'modal'
            ));
            return;
        }

        $this->flash->success("条件の削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "jouken_uriage_bunsekis",
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
        $jouken_uriage_bunsekis = JoukenUriageBunsekis::find(array(
            'order' => 'sakusei_user_id DESC',
            'conditions' => 'cd = ?0 AND sakusei_user_id IN(0, ?1)',
            'bind' => array(0 => $this->request->getPost('cd'), 1 => $this->getDI()->getSession()->get('auth')['id'])
        ));
        $res_flds = [
            "cd",
            "name",
            "junjo_kbn_cd",
            "hanni_from",
            "hanni_to",
            "junjo2_kbn_cd",
            "hanni2_from",
            "hanni2_to",
            "kikan_sitei_kbn_cd",
            "koujun_flg",
            "meisaigyou_flg",
            "goukeigyou_flg",
            "torihikiari_flg",
            "torihikinashi_flg",
        ];
        $resData = array();
        foreach ($jouken_uriage_bunsekis as $jouken_uriage_bunseki) {
            $resAdata = array();
            foreach ($res_flds as $res_fld) {
                $resAdata[$res_fld] = $jouken_uriage_bunseki->$res_fld;
            }
            $resAdata["junjo_kbn_table"] = $jouken_uriage_bunseki->JunjoKbns->table;
            $resData[] = $resAdata;
        }
        $response->setContent(json_encode($resData));
        return $response;
    }
}
