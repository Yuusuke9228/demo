<?php

class JoukenZaikoItiransController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        ControllerBase::indexCd("JoukenZaikoItirans", "条件在庫一覧"); //簡易検索付き一覧表示
    }

    /**
     * Searches for jouken_zaiko_itirans
     */
    public function searchAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Displays the creation form
     */
    public function newAction($id = null, $dataname = "JoukenZaikoItirans")
    {
        $this->view->imax = 0;

        if ($id) {
            $nameDts = $dataname;
            $jouken_zaiko_itirans = $nameDts::findFirstByid($id);
            if (!$jouken_zaiko_itirans) {
                $this->flash->error("条件が見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "jouken_zaiko_itirans",
                    'action' => 'index'
                ));

                return;
            }
            $this->_setDefault($jouken_zaiko_itirans, "new", $dataname);
            $this->tag->setDefault("id", null);
            $this->tag->setDefault("cd", null);
        }

    }

    /**
     * 修正画面から「次へ」ボタンを押したら次のコードの修正画面になる。
     */
    public function nextAction($id)
    {
        ControllerBase::nextCd($id, "jouken_zaiko_itirans", "JoukenZaikoItirans", "条件在庫一覧");
    }

    /**
     * 修正画面から「前へ」ボタンを押したら前のコードの修正画面になる。
     */
    public function prevAction($id)
    {
        ControllerBase::prevCd($id, "jouken_zaiko_itirans", "JoukenZaikoItirans", "条件在庫一覧");
    }

    /**
     * Edits a jouken_zaiko_itirans
     *
     * @param string $id
     */
    public function editAction($id)
    {
        $jouken_zaiko_itiran = JoukenZaikoItirans::findFirstByid($id);
        if (!$jouken_zaiko_itiran) {
            $this->flash->error("条件が見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "jouken_zaiko_itirans",
                'action' => 'index'
            ));

            return;
        }

        $this->view->id = $jouken_zaiko_itiran->id;

        $this->_setDefault($jouken_zaiko_itiran, "edit");
    }

    /**
     * 画面に表示するデータをセットする
     */
    public function _setDefault($jouken_zaiko_itiran, $action = "edit", $meisai = "JoukenZaikoItirans")
    {
        $setdts = ["id",
            "cd",
            "name",
            "junjo_kbn_cd",
            "hanni_from",
            "hanni_to",
            "junjo2_kbn_cd",
            "hanni2_from",
            "hanni2_to",
            "koujun_flg",
            "kikan_tuki",
            "zaiko0_flg",
            "torihikiari_flg",
            "torihikinasi_flg",
            "meisaigyou_flg",
            "soukohyouji_flg",
            "goukeigyou_flg",
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
            if (property_exists($jouken_zaiko_itiran, $setdt)) {
                $this->tag->setDefault($setdt, $jouken_zaiko_itiran->$setdt);
            }
        }
    }

    /**
     * Creates a new jouken_zaiko_itirans
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "jouken_zaiko_itirans",
                'action' => 'index'
            ));
            return;
        }

        $jouken_zaiko_itiran = new JoukenZaikoItirans();

        $post_flds = [];
        $post_flds = ["cd",
            "name",
            "junjo_kbn_cd",
            "hanni_from",
            "hanni_to",
            "junjo2_kbn_cd",
            "hanni2_from",
            "hanni2_to",
            "koujun_flg",
            "kikan_tuki",
            "zaiko0_flg",
            "torihikiari_flg",
            "torihikinasi_flg",
            "meisaigyou_flg",
            "soukohyouji_flg",
            "goukeigyou_flg",
            "updated",
        ];

        $thisPost = []; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        foreach ($post_flds as $post_fld) {
            $jouken_zaiko_itiran->$post_fld = array_key_exists($post_fld, $thisPost) ? $thisPost[$post_fld] : $this->request->getPost($post_fld);
        }

        if (!$jouken_zaiko_itiran->save()) {
            foreach ($jouken_zaiko_itiran->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "jouken_zaiko_itirans",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("条件の作成が完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "jouken_zaiko_itirans",
            'action' => 'edit',
            'params' => array($jouken_zaiko_itiran->id)
        ));
    }

    /**
     * Saves
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "jouken_zaiko_itirans",
                'action' => 'index'
            ));
            return;
        }

        $id = $this->request->getPost("id");
        $jouken_zaiko_itiran = JoukenZaikoItirans::findFirstByid($id);

        if (!$jouken_zaiko_itiran) {
            $this->flash->error("条件が見つからなくなりました。" . $id);

            $this->dispatcher->forward(array(
                'controller' => "jouken_zaiko_itirans",
                'action' => 'index'
            ));

            return;
        }

        if ($jouken_zaiko_itiran->updated !== $this->request->getPost("updated")) {
            $this->flash->error("他のプロセスから条件が変更されたため更新を中止しました。"
                . $id . ",uid=" . $jouken_zaiko_itiran->kousin_user_id . " tb=" . $jouken_zaiko_itiran->updated . " pt=" . $this->request->getPost("updated"));

            $this->dispatcher->forward(array(
                'controller' => "jouken_zaiko_itirans",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $post_flds = [];
        $post_flds = ["cd",
            "name",
            "junjo_kbn_cd",
            "hanni_from",
            "hanni_to",
            "junjo2_kbn_cd",
            "hanni2_from",
            "hanni2_to",
            "koujun_flg",
            "kikan_tuki",
            "zaiko0_flg",
            "torihikiari_flg",
            "torihikinasi_flg",
            "meisaigyou_flg",
            "soukohyouji_flg",
            "goukeigyou_flg",
            "updated",
        ];

        $thisPost = []; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        $chg_flg = 0;
        foreach ($post_flds as $post_fld) {
            if ((array_key_exists($post_fld, $thisPost) ? $thisPost[$post_fld] : $this->request->getPost($post_fld)) !== $jouken_zaiko_itiran->$post_fld) {
                $chg_flg = 1;
                break;
            }
        }
        if ($chg_flg === 0) {
            $this->flash->error("変更がありません。" . $id);

            $this->dispatcher->forward(array(
                "controller" => "jouken_zaiko_itirans",
                "action" => "edit",
                "params" => array($jouken_zaiko_itiran->id)
            ));
            return;
        }

        $this->_bakOut($jouken_zaiko_itiran);

        foreach ($post_flds as $post_fld) {
            $jouken_zaiko_itiran->$post_fld = array_key_exists($post_fld, $thisPost) ? $thisPost[$post_fld] : $this->request->getPost($post_fld);
        }
        if (!$jouken_zaiko_itiran->save()) {
            foreach ($jouken_zaiko_itiran->getMessages() as $message) {
                $this->flash->error($message);
            }
            $this->dispatcher->forward(array(
                'controller' => "jouken_zaiko_itirans",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $this->flash->success("条件を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "jouken_zaiko_itirans",
            'action' => 'edit',
            'params' => array($jouken_zaiko_itiran->id)
        ));
    }

    /**
     * Deletes a jouken_zaiko_itirans
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $jouken_zaiko_itiran = JoukenZaikoItirans::findFirstByid($id);
        if (!$jouken_zaiko_itiran) {
            $this->flash->error("条件が見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "jouken_zaiko_itirans",
                'action' => 'index'
            ));
            return;
        }

        $this->_bakOut($jouken_zaiko_itiran, 1);
        if (!$jouken_zaiko_itiran->delete()) {
            foreach ($jouken_zaiko_itiran->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "jouken_zaiko_itirans",
                'action' => 'search'
            ));
            return;
        }

        $this->flash->success("条件の削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "jouken_zaiko_itirans",
            'action' => "index"
        ));
    }

    /**
     * Back Out a jouken_zaiko_itirans
     *
     * @param string $jouken_zaiko_itiran , $dlt_flg
     */
    public function _bakOut($jouken_zaiko_itiran, $dlt_flg = 0)
    {

        $bak_jouken_zaiko_itiran = new BakJoukenZaikoItirans();
        foreach ($jouken_zaiko_itiran as $fld => $value) {
            $bak_jouken_zaiko_itiran->$fld = $jouken_zaiko_itiran->$fld;
        }
        $bak_jouken_zaiko_itiran->id = NULL;
        $bak_jouken_zaiko_itiran->id_moto = $jouken_zaiko_itiran->id;
        $bak_jouken_zaiko_itiran->hikae_dltflg = $dlt_flg;
        $bak_jouken_zaiko_itiran->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_jouken_zaiko_itiran->hikae_nichiji = date("Y-m-d H:i:s");
        if (!$bak_jouken_zaiko_itiran->save()) {
            foreach ($bak_jouken_zaiko_itiran->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
    }

    /**
     * 条件設定モーダル画面
     */
    public function modalAction($id = 0)
    {
        if ($id != 0) {
            $jouken_zaiko_itiran = JoukenZaikoItirans::findFirstByid($id);
            if (!$jouken_zaiko_itiran) {
                $this->flash->error("条件が見つからなくなりました。");
                $this->dispatcher->forward(array(
                    'controller' => "jouken_zaiko_itirans",
                    'action' => 'modal'
                ));
                return;
            }
            $this->_setDefault($jouken_zaiko_itiran, "edit");
        }
        $jouken_zaiko_itirans = JoukenZaikoItirans::find(["order" => "cd, sakusei_user_id"
            , "conditions" => "sakusei_user_id IN(0, ?0)"
            , "bind" => [0 => $this->getDI()->getSession()->get('auth')['id']]
        ]);
        $joukens = [];
        foreach ($jouken_zaiko_itirans as $jouken_zaiko_itiran) {
            $joukens[$jouken_zaiko_itiran->cd] = $jouken_zaiko_itiran->name;
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
                'controller' => "jouken_zaiko_itirans",
                'action' => 'index'
            ));
            return;
        }
        if ($this->request->getPost("cd")) { // "cd"が有る=上書き保存、"cd"がない=名前を付けて保存
            $cd = $this->request->getPost("cd");
            $jouken_zaiko_itiran = JoukenZaikoItirans::findFirst(["conditions" => "cd = ?0 AND sakusei_user_id = ?1"
                , "bind" => [0 => $cd, 1 => $this->getDI()->getSession()->get('auth')['id']]
            ]);
        } else {
            $lastcd = JoukenZaikoItirans::findFirst(["order" => "cd DESC"
                , "conditions" => "sakusei_user_id IN(0, ?0)"
                , "bind" => [0 => $this->getDI()->getSession()->get('auth')['id']]
            ]);
            $tmp_cd = $lastcd->cd;
            $cd = "" . ((int)$tmp_cd + 1);  //最新番号取得
        }
        $post_flds = [];
        $post_flds = [
            "name",
            "junjo_kbn_cd",
            "hanni_from",
            "hanni_to",
            "junjo2_kbn_cd",
            "hanni2_from",
            "hanni2_to",
            "koujun_flg",
            "kikan_tuki",
            "zaiko0_flg",
            "torihikiari_flg",
            "torihikinasi_flg",
            "meisaigyou_flg",
            "soukohyouji_flg",
            "goukeigyou_flg",
            "id_moto",
            "hikae_dltflg",
            "hikae_user_id",
            "hikae_nichiji",
            "sakusei_user_id",
            "created",
            "kousin_user_id",
            "updated",
        ];
        $thisPost = []; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        $chg_flg = 0;
        if ($this->request->getPost("cd") && $jouken_zaiko_itiran) {
            foreach ($post_flds as $post_fld) {
                if ((array_key_exists($post_fld, $thisPost) ? $thisPost[$post_fld] : $this->request->getPost($post_fld)) !== $jouken_zaiko_itiran->$post_fld) {
                    $chg_flg = 1;
                    break;
                }
            }
            if ($chg_flg === 0) {
                $this->flash->error("変更がありません。" . '$id');

                $this->dispatcher->forward(array(
                    "controller" => "jouken_zaiko_itirans",
                    "action" => "modal",
                    "params" => array($jouken_zaiko_itiran->id)
                ));

                return;
            }
            $this->_bakOut($jouken_zaiko_itiran);
        } else {
            $jouken_zaiko_itiran = new JoukenZaikoItirans();
            $jouken_zaiko_itiran->cd = $cd;
        }

        foreach ($post_flds as $post_fld) {
            $jouken_zaiko_itiran->$post_fld = array_key_exists($post_fld, $thisPost) ? $thisPost[$post_fld] : $this->request->getPost($post_fld);
        }
        if (!$jouken_zaiko_itiran->save()) {
            foreach ($jouken_zaiko_itiran->getMessages() as $message) {
                $this->flash->error($message);
            }
            $this->dispatcher->forward(array(
                'controller' => "jouken_zaiko_itirans",
                'action' => 'modal'
            ));

            return;
        }

        $this->flash->success("条件を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "jouken_zaiko_itirans",
            'action' => 'modal',
            'params' => array($jouken_zaiko_itiran->id)
        ));
    }

    /**
     * モーダルDeletes
     */
    public function modaldelAction()
    {
        if (!$this->request->getQuery('cd')) {
            $this->flash->error("削除する条件がありません。");
            $this->dispatcher->forward(array(
                'controller' => "jouken_zaiko_itirans",
                'action' => 'modal'
            ));

            return;
        }
        $cd = $this->request->getQuery('cd');
        $jouken_zaiko_itiran = JoukenZaikoItirans::findFirst(["conditions" => "cd = ?0 AND sakusei_user_id = ?1"
            , "bind" => [0 => $cd, 1 => $this->getDI()->getSession()->get('auth')['id']]
        ]);
        if (!$jouken_zaiko_itiran) {
            $this->flash->error("削除する条件が見つかりません。");
            $this->dispatcher->forward(array(
                'controller' => "jouken_zaiko_itirans",
                'action' => 'modal'
            ));

            return;
        }
        $this->_bakOut($jouken_zaiko_itiran, 1);
        if (!$jouken_zaiko_itiran->delete()) {
            foreach ($jouken_zaiko_itiran->getMessages() as $message) {
                $this->flash->error($message);
            }
            $this->dispatcher->forward(array(
                'controller' => "jouken_zaiko_itirans",
                'action' => 'modal'
            ));
            return;
        }
        $this->flash->success("条件の削除を完了しました。");
        $this->dispatcher->forward(array(
            'controller' => "jouken_zaiko_itirans",
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
        $jouken_zaiko_itirans = JoukenZaikoItirans::find(array(
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
            "koujun_flg",
            "kikan_tuki",
            "zaiko0_flg",
            "torihikiari_flg",
            "torihikinasi_flg",
            "meisaigyou_flg",
            "soukohyouji_flg",
            "goukeigyou_flg",
        ];
        $resData = array();
        foreach ($jouken_zaiko_itirans as $jouken_zaiko_itiran) {
            $resAdata = array();
            foreach ($res_flds as $res_fld) {
                $resAdata[$res_fld] = $jouken_zaiko_itiran->$res_fld;
            }
            $resAdata['kikan_tuki'] = date("Y-m-d");
            $resAdata["junjo_kbn_table"] = $jouken_zaiko_itiran->JunjoKbns->table;
            $resData[] = $resAdata;
        }
        $response->setContent(json_encode($resData));
        return $response;
    }

}
