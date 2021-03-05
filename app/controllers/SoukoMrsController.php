<?php
 


class SoukoMrsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        ControllerBase::indexCd("SoukoMrs", "倉庫マスタ"); //簡易検索付き一覧表示
    }

    /**
     * モーダル
     */
    public function modalAction()
    {
		ControllerBase::indexCd("SoukoMrs", "倉庫台帳");
    }

    /**
     * Searches for souko_mrs
     */
    public function searchAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Displays the creation form
     */
    public function newAction($id=null, $dataname="SoukoMrs")
    {
        $this->view->imax = 0;

        if ($id) {
            $nameDts = $dataname;
            $souko_mr = $nameDts::findFirstByid($id);
            if (!$souko_mr) {
                $this->flash->error("倉庫マスタが見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "souko_mrs",
                    'action' => 'index'
                ));

                return;
            }
            $this->_setDefault($souko_mr, "new", $dataname);
            $this->tag->setDefault("id", null);
            $this->tag->setDefault("cd", null);
        }

    }

    /**
     * 修正画面から「次へ」ボタンを押したら次のコードの修正画面になる。
     */
    public function nextAction($id)
    {
        ControllerBase::nextCd($id, "souko_mrs", "SoukoMrs", "倉庫マスタ");
    }

    /**
     * 修正画面から「前へ」ボタンを押したら前のコードの修正画面になる。
     */
    public function prevAction($id = 0)
    {
        ControllerBase::prevCd($id, "souko_mrs", "SoukoMrs", "倉庫マスタ");
    }

    /**
     * Edits a souko_mr
     *
     * @param string $id
     */
    public function editAction($id)
    {
//        if (!$this->request->isPost()) {

            $souko_mr = SoukoMrs::findFirstByid($id);
            if (!$souko_mr) {
                $this->flash->error("倉庫マスタが見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "souko_mrs",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->id = $souko_mr->id;

            $this->_setDefault($souko_mr, "edit");
//        }
    }

    /**
     * 画面に表示するデータをセットする
     */
    public function _setDefault($souko_mr, $action="edit", $meisai="SoukoMrs")
    {
        $setdts = ["id",
            "cd",
            "name",
            "yuubin_bangou",
            "juusho1",
            "juusho2",
            "tantou_mr_cd",
            "tel",
            "fax",
            "memo",
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
            if (property_exists($souko_mr, $setdt)) {
                $this->tag->setDefault($setdt, $souko_mr->$setdt);
            }
        }
    }

    /**
     * Creates a new souko_mr
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "souko_mrs",
                'action' => 'index'
            ));

            return;
        }

        $souko_mr = new SoukoMrs();

        $post_flds = [];
        $post_flds = ["cd",
            "name",
            "yuubin_bangou",
            "juusho1",
            "juusho2",
            "tantou_mr_cd",
            "tel",
            "fax",
            "memo",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        foreach ($post_flds as $post_fld) {
            $souko_mr->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$souko_mr->save()) {
            foreach ($souko_mr->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "souko_mrs",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("倉庫マスタの作成が完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "souko_mrs",
            'action' => 'edit',
            'params' => array($souko_mr->id)
        ));
    }

    /**
     * Saves a souko_mr edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "souko_mrs",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $souko_mr = SoukoMrs::findFirstByid($id);

        if (!$souko_mr) {
            $this->flash->error("倉庫マスタが見つからなくなりました。" . $id);

            $this->dispatcher->forward(array(
                'controller' => "souko_mrs",
                'action' => 'index'
            ));

            return;
        }

        if ($souko_mr->updated !== $this->request->getPost("updated")) {
            $this->flash->error("他のプロセスから倉庫マスタが変更されたため更新を中止しました。"
                . $id . ",uid=" . $souko_mr->kousin_user_id . " tb=" . $souko_mr->updated ." pt=" . $this->request->getPost("updated"));

            $this->dispatcher->forward(array(
                'controller' => "souko_mrs",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $post_flds = [];
        $post_flds = ["cd",
            "name",
            "yuubin_bangou",
            "juusho1",
            "juusho2",
            "tantou_mr_cd",
            "tel",
            "fax",
            "memo",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        $chg_flg = 0;
        foreach ($post_flds as $post_fld) {
            if ((array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld)) !== $souko_mr->$post_fld) {
                $chg_flg = 1;
                break;
            }
        }
        if ($chg_flg === 0) {
            $this->flash->error("変更がありません。" . $id);

            $this->dispatcher->forward(array(
                "controller" => "souko_mrs",
                "action" => "edit",
                "params" => array($souko_mr->id)
            ));

            return;
        }

        $this->_bakOut($souko_mr);

        foreach ($post_flds as $post_fld) {
            $souko_mr->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$souko_mr->save()) {

            foreach ($souko_mr->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "souko_mrs",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $this->flash->success("倉庫マスタの情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "souko_mrs",
            'action' => 'edit',
            'params' => array($souko_mr->id)
        ));
    }

    /**
     * Deletes a souko_mr
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $souko_mr = SoukoMrs::findFirstByid($id);
        if (!$souko_mr) {
            $this->flash->error("倉庫マスタが見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "souko_mrs",
                'action' => 'index'
            ));

            return;
        }

        $this->_bakOut($souko_mr, 1);

        if (!$souko_mr->delete()) {

            foreach ($souko_mr->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "souko_mrs",
                'action' => 'search'
            ));

            return;
        }

        $this->flash->success("倉庫マスタの削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "souko_mrs",
            'action' => "index"
        ));
    }

    /**
     * Back Out a souko_mr
     *
     * @param string $souko_mr, $dlt_flg
     */
    public function _bakOut($souko_mr, $dlt_flg = 0)
    {

        $bak_souko_mr = new BakSoukoMrs();
        foreach ($souko_mr as $fld => $value) {
            $bak_souko_mr->$fld = $souko_mr->$fld;
        }
        $bak_souko_mr->id = NULL;
        $bak_souko_mr->id_moto = $souko_mr->id;
        $bak_souko_mr->hikae_dltflg = $dlt_flg;
        $bak_souko_mr->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_souko_mr->hikae_nichiji = date("Y-m-d H:i:s");
        if (!$bak_souko_mr->save()) {
            foreach ($bak_souko_mr->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
    }

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

	    $souko_mrs = SoukoMrs::find(array(
//	        'columns' => array('cd, name'), 全項目とする
	        'order' => 'cd',
	        'conditions' => ' cd LIKE ?1 ',
	        'bind' => array(1 => $this->request->getPost('cd').'%')
	    ));
        $res_flds = ["id","cd","name","yuubin_bangou","juusho1","juusho2","tantou_mr_cd","tel","fax","memo",];
	    $resData = array();
	    foreach ($souko_mrs as $souko_mr) {
	        $resAdata = array();
	        foreach ($res_flds as $res_fld) {
	            $resAdata[$res_fld] = $souko_mr->$res_fld;
	        }
	        $resData[] = $resAdata;//array('cd' => $souko_mr->cd, 'name' => $souko_mr->name);
	    }

	    //Set the content of the response
	    $response->setContent(json_encode($resData));

	    //Return the response
	    return $response;
	}
}
