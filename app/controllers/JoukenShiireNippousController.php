<?php
 


class JoukenShiireNippousController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        ControllerBase::indexCd("JoukenShiireNippous", "条件仕入日報"); //簡易検索付き一覧表示
    }

    /**
     * Searches for jouken_shiire_nippous
     */
    public function searchAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Displays the creation form
     */
    public function newAction($id=null, $dataname="JoukenShiireNippous")
    {
        $this->view->imax = 0;

        if ($id) {
            $nameDts = $dataname;
            $jouken_shiire_nippou = $nameDts::findFirstByid($id);
            if (!$jouken_shiire_nippou) {
                $this->flash->error("条件仕入日報が見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "jouken_shiire_nippous",
                    'action' => 'index'
                ));

                return;
            }
            $this->_setDefault($jouken_shiire_nippou, "new", $dataname);
            $this->tag->setDefault("id", null);
            $this->tag->setDefault("cd", null);
        }

    }

    /**
     * 修正画面から「次へ」ボタンを押したら次のコードの修正画面になる。
     */
    public function nextAction($id)
    {
        ControllerBase::nextCd($id, "jouken_shiire_nippous", "JoukenShiireNippous", "条件仕入日報");
    }

    /**
     * 修正画面から「前へ」ボタンを押したら前のコードの修正画面になる。
     */
    public function prevAction($id)
    {
        ControllerBase::prevCd($id, "jouken_shiire_nippous", "JoukenShiireNippous", "条件仕入日報");
    }

    /**
     * Edits a jouken_shiire_nippou
     *
     * @param string $id
     */
    public function editAction($id)
    {
//        if (!$this->request->isPost()) {

            $jouken_shiire_nippou = JoukenShiireNippous::findFirstByid($id);
            if (!$jouken_shiire_nippou) {
                $this->flash->error("条件仕入日報が見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "jouken_shiire_nippous",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->id = $jouken_shiire_nippou->id;

            $this->_setDefault($jouken_shiire_nippou, "edit");
//        }
    }

    /**
     * 画面に表示するデータをセットする
     */
    public function _setDefault($jouken_shiire_nippou, $action="edit", $meisai="JoukenShiireNippous")
    {
        $setdts = ["id",
            "cd",
            "name",
            "torihiki_kbn_betu_flg",
            "junjo_kbn_cd",
            "koujun_flg",
            "hanni_from",
            "hanni_to",
            "kikan_sitei_kbn_cd",
            "kikan_from",
            "kikan_to",
            "simekiri_kbn",
            "meisaigyou_flg",
            "goukeigyou_flg",
            "jinyuuryoku_flg",
            "torihikiari_flg",
            "torihikinasi_flg",
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
            if (property_exists($jouken_shiire_nippou, $setdt)) {
                $this->tag->setDefault($setdt, $jouken_shiire_nippou->$setdt);
            }
        }
    }

    /**
     * Creates a new jouken_shiire_nippou
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "jouken_shiire_nippous",
                'action' => 'index'
            ));

            return;
        }

        $jouken_shiire_nippou = new JoukenShiireNippous();

        $post_flds = [];
        $post_flds = ["cd",
            "name",
            "torihiki_kbn_betu_flg",
            "junjo_kbn_cd",
            "koujun_flg",
            "hanni_from",
            "hanni_to",
            "kikan_sitei_kbn_cd",
            "kikan_from",
            "kikan_to",
            "simekiri_kbn",
            "meisaigyou_flg",
            "goukeigyou_flg",
            "jinyuuryoku_flg",
            "torihikiari_flg",
            "torihikinasi_flg",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        foreach ($post_flds as $post_fld) {
            $jouken_shiire_nippou->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$jouken_shiire_nippou->save()) {
            foreach ($jouken_shiire_nippou->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "jouken_shiire_nippous",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("条件仕入日報の作成が完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "jouken_shiire_nippous",
            'action' => 'edit',
            'params' => array($jouken_shiire_nippou->id)
        ));
    }

    /**
     * Saves a jouken_shiire_nippou edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "jouken_shiire_nippous",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $jouken_shiire_nippou = JoukenShiireNippous::findFirstByid($id);

        if (!$jouken_shiire_nippou) {
            $this->flash->error("条件仕入日報が見つからなくなりました。" . $id);

            $this->dispatcher->forward(array(
                'controller' => "jouken_shiire_nippous",
                'action' => 'index'
            ));

            return;
        }

        if ($jouken_shiire_nippou->updated !== $this->request->getPost("updated")) {
            $this->flash->error("他のプロセスから条件仕入日報が変更されたため更新を中止しました。"
                . $id . ",uid=" . $jouken_shiire_nippou->kousin_user_id . " tb=" . $jouken_shiire_nippou->updated ." pt=" . $this->request->getPost("updated"));

            $this->dispatcher->forward(array(
                'controller' => "jouken_shiire_nippous",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $post_flds = [];
        $post_flds = ["cd",
            "name",
            "torihiki_kbn_betu_flg",
            "junjo_kbn_cd",
            "koujun_flg",
            "hanni_from",
            "hanni_to",
            "kikan_sitei_kbn_cd",
            "kikan_from",
            "kikan_to",
            "simekiri_kbn",
            "meisaigyou_flg",
            "goukeigyou_flg",
            "jinyuuryoku_flg",
            "torihikiari_flg",
            "torihikinasi_flg",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        $chg_flg = 0;
        foreach ($post_flds as $post_fld) {
            if ((array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld)) !== $jouken_shiire_nippou->$post_fld) {
                $chg_flg = 1;
                break;
            }
        }
        if ($chg_flg === 0) {
            $this->flash->error("変更がありません。" . $id);

            $this->dispatcher->forward(array(
                "controller" => "jouken_shiire_nippous",
                "action" => "edit",
                "params" => array($jouken_shiire_nippou->id)
            ));

            return;
        }

        $this->_bakOut($jouken_shiire_nippou);

        foreach ($post_flds as $post_fld) {
            $jouken_shiire_nippou->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$jouken_shiire_nippou->save()) {

            foreach ($jouken_shiire_nippou->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "jouken_shiire_nippous",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $this->flash->success("条件仕入日報の情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "jouken_shiire_nippous",
            'action' => 'edit',
            'params' => array($jouken_shiire_nippou->id)
        ));
    }

    /**
     * Deletes a jouken_shiire_nippou
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $jouken_shiire_nippou = JoukenShiireNippous::findFirstByid($id);
        if (!$jouken_shiire_nippou) {
            $this->flash->error("条件仕入日報が見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "jouken_shiire_nippous",
                'action' => 'index'
            ));

            return;
        }

        $this->_bakOut($jouken_shiire_nippou, 1);

        if (!$jouken_shiire_nippou->delete()) {

            foreach ($jouken_shiire_nippou->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "jouken_shiire_nippous",
                'action' => 'search'
            ));

            return;
        }

        $this->flash->success("条件仕入日報の削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "jouken_shiire_nippous",
            'action' => "index"
        ));
    }

    /**
     * Back Out a jouken_shiire_nippou
     *
     * @param string $jouken_shiire_nippou, $dlt_flg
     */
    public function _bakOut($jouken_shiire_nippou, $dlt_flg = 0)
    {

        $bak_jouken_shiire_nippou = new BakJoukenShiireNippous();
        foreach ($jouken_shiire_nippou as $fld => $value) {
            $bak_jouken_shiire_nippou->$fld = $jouken_shiire_nippou->$fld;
        }
        $bak_jouken_shiire_nippou->id = NULL;
        $bak_jouken_shiire_nippou->id_moto = $jouken_shiire_nippou->id;
        $bak_jouken_shiire_nippou->hikae_dltflg = $dlt_flg;
        $bak_jouken_shiire_nippou->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_jouken_shiire_nippou->hikae_nichiji = date("Y-m-d H:i:s");
        if (!$bak_jouken_shiire_nippou->save()) {
            foreach ($bak_jouken_shiire_nippou->getMessages() as $message) {
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
            $jouken_shiire_nippou = JoukenShiireNippous::findFirstByid($id);
            if (!$jouken_shiire_nippou) {
                $this->flash->error("条件仕入日報が見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "jouken_shiire_nippous",
                    'action' => 'modal'
                ));

                return;
            }

            $this->_setDefault($jouken_shiire_nippou, "edit");
        }
        $jouken_shiire_nippous = JoukenShiireNippous::find(["order"=>"cd, sakusei_user_id"
        												, "conditions" => "sakusei_user_id IN(0, ?0)"
        												, "bind"=>[0=>$this->getDI()->getSession()->get('auth')['id']]
        												]);
        $joukens = [];
        foreach ($jouken_shiire_nippous as $jouken_shiire_nippou) {
            $joukens[$jouken_shiire_nippou->cd] = $jouken_shiire_nippou->name;
        }
        $this->view->joukens = $joukens;
    }

    /**
     * モーダルからSaves a jouken_shiire_nippou edited
     *
     */
    public function modalsaveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "jouken_shiire_nippous",
                'action' => 'index'
            ));

            return;
        }

		if ($this->request->getPost("cd")) { // "cd"が有る=上書き保存、"cd"がない=名前を付けて保存
            $cd = $this->request->getPost("cd");
            $jouken_shiire_nippou = JoukenShiireNippous::findFirst(["conditions"=>"cd = ?0 AND sakusei_user_id = ?1"
            													, "bind" => [0 => $cd, 1 => $this->getDI()->getSession()->get('auth')['id']]
            													]);
        } else {
            $lastcd = JoukenShiireNippous::findFirst(["order"=>"cd DESC"
            										, "conditions"=>"sakusei_user_id IN(0, ?0)"
            										, "bind" => [0 => $this->getDI()->getSession()->get('auth')['id']]
            										]);
            $cd = "".((int)$lastcd->cd + 1);
        }

        $post_flds = [];
        $post_flds = [
            "name",
            "torihiki_kbn_betu_flg",
            "junjo_kbn_cd",
            "koujun_flg",
            "hanni_from",
            "hanni_to",
            "kikan_sitei_kbn_cd",
            "kikan_from",
            "kikan_to",
            "simekiri_kbn",
            "meisaigyou_flg",
            "goukeigyou_flg",
            "jinyuuryoku_flg",
            "torihikiari_flg",
            "torihikinasi_flg",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        $chg_flg = 0;
        if ($this->request->getPost("cd") && $jouken_shiire_nippou) {
            foreach ($post_flds as $post_fld) {
                if ((array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld)) !== $jouken_shiire_nippou->$post_fld) {
                    $chg_flg = 1;
                    break;
                }
            }
            if ($chg_flg === 0) {
                $this->flash->error("変更がありません。" . $id);

                $this->dispatcher->forward(array(
                    "controller" => "jouken_shiire_nippous",
                    "action" => "modal",
                    "params" => array($jouken_shiire_nippou->id)
                ));

                return;
            }
            $this->_bakOut($jouken_shiire_nippou);
        } else {
            $jouken_shiire_nippou = new JoukenShiireNippous();
            $jouken_shiire_nippou->cd = $cd;
        }

        foreach ($post_flds as $post_fld) {
            $jouken_shiire_nippou->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$jouken_shiire_nippou->save()) {

            foreach ($jouken_shiire_nippou->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "jouken_shiire_nippous",
                'action' => 'modal'
            ));

            return;
        }

        $this->flash->success("条件仕入日報の情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "jouken_shiire_nippous",
            'action' => 'modal',
            'params' => array($jouken_shiire_nippou->id)
        ));
    }

    /**
     * モーダルDeletes a jouken_shiire_nippou
     */
    public function modaldelAction($cd)
    {
		if (!$cd) { // $cdがないとやめる
            $this->flash->error("削除する条件仕入日報がありません。");

            $this->dispatcher->forward(array(
                'controller' => "jouken_shiire_nippous",
                'action' => 'modal'
            ));

            return;
		}
        $jouken_shiire_nippou = JoukenShiireNippous::findFirst(["conditions"=>"cd = ?0 AND sakusei_user_id = ?1"
        													, "bind" => [0 => $cd, 1 => $this->getDI()->getSession()->get('auth')['id']]
        													]);
        if (!$jouken_shiire_nippou) {
            $this->flash->error("削除する条件仕入日報が見つかりません。");

            $this->dispatcher->forward(array(
                'controller' => "jouken_shiire_nippous",
                'action' => 'modal'
            ));

            return;
        }

        $this->_bakOut($jouken_shiire_nippou, 1);

        if (!$jouken_shiire_nippou->delete()) {

            foreach ($jouken_shiire_nippou->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "jouken_shiire_nippous",
                'action' => 'modal'
            ));

            return;
        }

        $this->flash->success("条件仕入日報の削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "jouken_shiire_nippous",
            'action' => "modal"
        ));
    }

    /**
     * 条件設定データ呼び出し
     */
	public function ajaxGetAction()
	{
	    $this->view->disable();

	    //Create a response instance
	    $response = new \Phalcon\Http\Response();

        if (!$this->request->isAjax()) {
            echo "is not Ajax ! ";
        //    return;
        }
        if (!$this->request->isPost()) {
            echo "is not Post ! ";
        //    return;
        }

	    $jouken_shiire_nippous = JoukenShiireNippous::find(array(
	        'order' => 'sakusei_user_id DESC',
	        'conditions' => 'cd = ?0 AND sakusei_user_id IN(0, ?1)',
	        'bind' => array(0 => $this->request->getPost('cd'), 1 => $this->getDI()->getSession()->get('auth')['id'])
	    ));
        $res_flds = [
            "cd",
            "name",
            "torihiki_kbn_betu_flg",
            "junjo_kbn_cd",
            "koujun_flg",
            "hanni_from",
            "hanni_to",
            "kikan_sitei_kbn_cd",
            "kikan_from",
            "kikan_to",
            "simekiri_kbn",
            "meisaigyou_flg",
            "goukeigyou_flg",
            "jinyuuryoku_flg",
            "torihikiari_flg",
            "torihikinasi_flg",
            ];
	    $resData = array();
	    foreach ($jouken_shiire_nippous as $jouken_shiire_nippou) {
	        $resAdata = array();
	        foreach ($res_flds as $res_fld) {
	            $resAdata[$res_fld] = $jouken_shiire_nippou->$res_fld;
	        }
		    $resAdata["junjo_kbn_table"] = $jouken_shiire_nippou->JunjoKbns->table;
//            "hanni_from_name",
//            "hanni_to_name",
	        $resData[] = $resAdata;
	    }

	    //Set the content of the response
	    $response->setContent(json_encode($resData));

	    //Return the response
	    return $response;
	}

}
