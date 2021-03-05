<?php
 


class RewidthFieldMrsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        ControllerBase::indexCd("RewidthFieldMrs", "項目幅制御"); //簡易検索付き一覧表示
    }

    /**
     * Searches for rewidth_field_mrs
     */
    public function searchAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Displays the creation form
     */
    public function newAction($id=null, $dataname="RewidthFieldMrs")
    {
        $this->view->imax = 0;

        if ($id) {
            $nameDts = $dataname;
            $rewidth_field_mr = $nameDts::findFirstByid($id);
            if (!$rewidth_field_mr) {
                $this->flash->error("項目幅制御が見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "rewidth_field_mrs",
                    'action' => 'index'
                ));

                return;
            }
            $this->_setDefault($rewidth_field_mr, "new", $dataname);
            $this->tag->setDefault("id", null);
            $this->tag->setDefault("cd", null);
        }

    }

    /**
     * 修正画面から「次へ」ボタンを押したら次のコードの修正画面になる。
     */
    public function nextAction($id)
    {
        ControllerBase::nextCd($id, "rewidth_field_mrs", "RewidthFieldMrs", "項目幅制御");
    }

    /**
     * 修正画面から「前へ」ボタンを押したら前のコードの修正画面になる。
     */
    public function prevAction($id)
    {
        ControllerBase::prevCd($id, "rewidth_field_mrs", "RewidthFieldMrs", "項目幅制御");
    }

    /**
     * Edits a rewidth_field_mr
     *
     * @param string $id
     */
    public function editAction($id)
    {
//        if (!$this->request->isPost()) {

            $rewidth_field_mr = RewidthFieldMrs::findFirstByid($id);
            if (!$rewidth_field_mr) {
                $this->flash->error("項目幅制御が見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "rewidth_field_mrs",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->id = $rewidth_field_mr->id;

            $this->_setDefault($rewidth_field_mr, "edit");
//        }
    }

    /**
     * 画面に表示するデータをセットする
     */
    public function _setDefault($rewidth_field_mr, $action="edit", $meisai="RewidthFieldMrs")
    {
        $setdts = ["id",
            "cd",
            "name",
            "controller_cd",
            "gamen_cd",
            "riyou_user_id",
            "field_cd",
            "haba",
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
            if (property_exists($rewidth_field_mr, $setdt)) {
                $this->tag->setDefault($setdt, $rewidth_field_mr->$setdt);
            }
        }
    }

    /**
     * Creates a new rewidth_field_mr
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "rewidth_field_mrs",
                'action' => 'index'
            ));

            return;
        }

        $rewidth_field_mr = new RewidthFieldMrs();

        $post_flds = [];
        $post_flds = ["cd",
            "name",
            "controller_cd",
            "gamen_cd",
            "riyou_user_id",
            "field_cd",
            "haba",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        foreach ($post_flds as $post_fld) {
            $rewidth_field_mr->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$rewidth_field_mr->save()) {
            foreach ($rewidth_field_mr->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "rewidth_field_mrs",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("項目幅制御の作成が完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "rewidth_field_mrs",
            'action' => 'edit',
            'params' => array($rewidth_field_mr->id)
        ));
    }

    /**
     * Saves a rewidth_field_mr edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "rewidth_field_mrs",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $rewidth_field_mr = RewidthFieldMrs::findFirstByid($id);

        if (!$rewidth_field_mr) {
            $this->flash->error("項目幅制御が見つからなくなりました。" . $id);

            $this->dispatcher->forward(array(
                'controller' => "rewidth_field_mrs",
                'action' => 'index'
            ));

            return;
        }

        if ($rewidth_field_mr->updated !== $this->request->getPost("updated")) {
            $this->flash->error("他のプロセスから項目幅制御が変更されたため更新を中止しました。"
                . $id . ",uid=" . $rewidth_field_mr->kousin_user_id . " tb=" . $rewidth_field_mr->updated ." pt=" . $this->request->getPost("updated"));

            $this->dispatcher->forward(array(
                'controller' => "rewidth_field_mrs",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $post_flds = [];
        $post_flds = ["cd",
            "name",
            "controller_cd",
            "gamen_cd",
            "riyou_user_id",
            "field_cd",
            "haba",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        $chg_flg = 0;
        foreach ($post_flds as $post_fld) {
            if ((array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld)) !== $rewidth_field_mr->$post_fld) {
                $chg_flg = 1;
                break;
            }
        }
        if ($chg_flg === 0) {
            $this->flash->error("変更がありません。" . $id);

            $this->dispatcher->forward(array(
                "controller" => "rewidth_field_mrs",
                "action" => "edit",
                "params" => array($rewidth_field_mr->id)
            ));

            return;
        }

        $this->_bakOut($rewidth_field_mr);

        foreach ($post_flds as $post_fld) {
            $rewidth_field_mr->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$rewidth_field_mr->save()) {

            foreach ($rewidth_field_mr->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "rewidth_field_mrs",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $this->flash->success("項目幅制御の情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "rewidth_field_mrs",
            'action' => 'edit',
            'params' => array($rewidth_field_mr->id)
        ));
    }

    /**
     * Deletes a rewidth_field_mr
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $rewidth_field_mr = RewidthFieldMrs::findFirstByid($id);
        if (!$rewidth_field_mr) {
            $this->flash->error("項目幅制御が見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "rewidth_field_mrs",
                'action' => 'index'
            ));

            return;
        }

        $this->_bakOut($rewidth_field_mr, 1);

        if (!$rewidth_field_mr->delete()) {

            foreach ($rewidth_field_mr->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "rewidth_field_mrs",
                'action' => 'search'
            ));

            return;
        }

        $this->flash->success("項目幅制御の削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "rewidth_field_mrs",
            'action' => "index"
        ));
    }

    /**
     * Back Out a rewidth_field_mr
     *
     * @param string $rewidth_field_mr, $dlt_flg
     */
    public function _bakOut($rewidth_field_mr, $dlt_flg = 0)
    {

        $bak_rewidth_field_mr = new BakRewidthFieldMrs();
        foreach ($rewidth_field_mr as $fld => $value) {
            $bak_rewidth_field_mr->$fld = $rewidth_field_mr->$fld;
        }
        $bak_rewidth_field_mr->id = NULL;
        $bak_rewidth_field_mr->id_moto = $rewidth_field_mr->id;
        $bak_rewidth_field_mr->hikae_dltflg = $dlt_flg;
        $bak_rewidth_field_mr->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_rewidth_field_mr->hikae_nichiji = date("Y-m-d H:i:s");
        if (!$bak_rewidth_field_mr->save()) {
            foreach ($bak_rewidth_field_mr->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
    }

    /**
     * 画面に項目幅をセットする
     */
    public function setFormFieldRewidths($controller_cd, $gamen_cd, $riyou_user_id=null)
    {
    	if (!$riyou_user_id) {
    		$riyou_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
    	}
		$rewidth_field_mrs = RewidthFieldMrs::find(["conditions"=>"controller_cd = ?1 AND gamen_cd = ?2 AND riyou_user_id = ?3", "bind"=>[1=>$controller_cd, 2=>$gamen_cd, 3=>$riyou_user_id]]);
		$rewidths=[];
		foreach ($rewidth_field_mrs as $rewidth_field_mr) {
			$rewidths[$rewidth_field_mr->field_cd]=$rewidth_field_mr->haba;
		}
		return $rewidths;
    }

}
