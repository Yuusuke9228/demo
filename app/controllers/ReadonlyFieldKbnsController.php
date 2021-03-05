<?php

class ReadonlyFieldKbnsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        ControllerBase::indexCd("ReadonlyFieldKbns", "読取専用項目制御"); //簡易検索付き一覧表示
    }

    /**
     * Searches for readonly_field_kbns
     */
    public function searchAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Displays the creation form
     */
    public function newAction($id=null, $dataname="ReadonlyFieldKbns")
    {
        $this->view->imax = 0;

        if ($id) {
            $nameDts = $dataname;
            $readonly_field_kbn = $nameDts::findFirstByid($id);
            if (!$readonly_field_kbn) {
                $this->flash->error("読取専用項目制御が見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "readonly_field_kbns",
                    'action' => 'index'
                ));

                return;
            }
            $this->_setDefault($readonly_field_kbn, "new", $dataname);
            $this->tag->setDefault("id", null);
            $this->tag->setDefault("cd", null);
        }

    }

    /**
     * 修正画面から「次へ」ボタンを押したら次のコードの修正画面になる。
     */
    public function nextAction($id)
    {
        ControllerBase::nextCd($id, "readonly_field_kbns", "ReadonlyFieldKbns", "読取専用項目制御");
    }

    /**
     * 修正画面から「前へ」ボタンを押したら前のコードの修正画面になる。
     */
    public function prevAction($id)
    {
        ControllerBase::prevCd($id, "readonly_field_kbns", "ReadonlyFieldKbns", "読取専用項目制御");
    }

    /**
     * Edits a readonly_field_kbn
     *
     * @param string $id
     */
    public function editAction($id)
    {
//        if (!$this->request->isPost()) {

            $readonly_field_kbn = ReadonlyFieldKbns::findFirstByid($id);
            if (!$readonly_field_kbn) {
                $this->flash->error("読取専用項目制御が見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "readonly_field_kbns",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->id = $readonly_field_kbn->id;

            $this->_setDefault($readonly_field_kbn, "edit");
//        }
    }

    /**
     * 画面に表示するデータをセットする
     */
    public function _setDefault($readonly_field_kbn, $action="edit", $meisai="ReadonlyFieldKbns")
    {
        $setdts = ["id",
            "cd",
            "name",
            "controller_cd",
            "gamen_cd",
            "riyou_user_id",
            "field_cd",
            "readonly_flg",
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
            if (property_exists($readonly_field_kbn, $setdt)) {
                $this->tag->setDefault($setdt, $readonly_field_kbn->$setdt);
            }
        }
    }

    /**
     * Creates a new readonly_field_kbn
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "readonly_field_kbns",
                'action' => 'index'
            ));

            return;
        }

        $readonly_field_kbn = new ReadonlyFieldKbns();

        $post_flds = [];
        $post_flds = ["cd",
            "name",
            "controller_cd",
            "gamen_cd",
            "riyou_user_id",
            "field_cd",
            "readonly_flg",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        foreach ($post_flds as $post_fld) {
            $readonly_field_kbn->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$readonly_field_kbn->save()) {
            foreach ($readonly_field_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "readonly_field_kbns",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("読取専用項目制御の作成が完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "readonly_field_kbns",
            'action' => 'edit',
            'params' => array($readonly_field_kbn->id)
        ));
    }

    /**
     * Saves a readonly_field_kbn edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "readonly_field_kbns",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $readonly_field_kbn = ReadonlyFieldKbns::findFirstByid($id);

        if (!$readonly_field_kbn) {
            $this->flash->error("読取専用項目制御が見つからなくなりました。" . $id);

            $this->dispatcher->forward(array(
                'controller' => "readonly_field_kbns",
                'action' => 'index'
            ));

            return;
        }

        if ($readonly_field_kbn->updated !== $this->request->getPost("updated")) {
            $this->flash->error("他のプロセスから読取専用項目制御が変更されたため更新を中止しました。"
                . $id . ",uid=" . $readonly_field_kbn->kousin_user_id . " tb=" . $readonly_field_kbn->updated ." pt=" . $this->request->getPost("updated"));

            $this->dispatcher->forward(array(
                'controller' => "readonly_field_kbns",
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
            "user_id",
            "field_cd",
            "readonly_flg",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        $chg_flg = 0;
        foreach ($post_flds as $post_fld) {
            if ((array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld)) !== $readonly_field_kbn->$post_fld) {
                $chg_flg = 1;
                break;
            }
        }
        if ($chg_flg === 0) {
            $this->flash->error("変更がありません。" . $id);

            $this->dispatcher->forward(array(
                "controller" => "readonly_field_kbns",
                "action" => "edit",
                "params" => array($readonly_field_kbn->id)
            ));

            return;
        }

        $this->_bakOut($readonly_field_kbn);

        foreach ($post_flds as $post_fld) {
            $readonly_field_kbn->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$readonly_field_kbn->save()) {

            foreach ($readonly_field_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "readonly_field_kbns",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $this->flash->success("読取専用項目制御の情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "readonly_field_kbns",
            'action' => 'edit',
            'params' => array($readonly_field_kbn->id)
        ));
    }

    /**
     * Deletes a readonly_field_kbn
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $readonly_field_kbn = ReadonlyFieldKbns::findFirstByid($id);
        if (!$readonly_field_kbn) {
            $this->flash->error("読取専用項目制御が見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "readonly_field_kbns",
                'action' => 'index'
            ));

            return;
        }

        $this->_bakOut($readonly_field_kbn, 1);

        if (!$readonly_field_kbn->delete()) {

            foreach ($readonly_field_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "readonly_field_kbns",
                'action' => 'search'
            ));

            return;
        }

        $this->flash->success("読取専用項目制御の削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "readonly_field_kbns",
            'action' => "index"
        ));
    }

    /**
     * Back Out a readonly_field_kbn
     *
     * @param string $readonly_field_kbn, $dlt_flg
     */
    public function _bakOut($readonly_field_kbn, $dlt_flg = 0)
    {

        $bak_readonly_field_kbn = new BakReadonlyFieldKbns();
        foreach ($readonly_field_kbn as $fld => $value) {
            $bak_readonly_field_kbn->$fld = $readonly_field_kbn->$fld;
        }
        $bak_readonly_field_kbn->id = NULL;
        $bak_readonly_field_kbn->id_moto = $readonly_field_kbn->id;
        $bak_readonly_field_kbn->hikae_dltflg = $dlt_flg;
        $bak_readonly_field_kbn->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_readonly_field_kbn->hikae_nichiji = date("Y-m-d H:i:s");
        if (!$bak_readonly_field_kbn->save()) {
            foreach ($bak_readonly_field_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
    }

    /**
     * 画面に読込専用項目をセットする
     */
    public function setFormFieldReadonlys($controller_cd, $gamen_cd, $riyou_user_id=null)
    {
    	if (!$riyou_user_id) {
    		$riyou_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
    	}
		$readonly_field_kbns = ReadonlyFieldKbns::find(["conditions"=>"controller_cd = ?1 AND gamen_cd = ?2 AND riyou_user_id = ?3", "bind"=>[1=>$controller_cd, 2=>$gamen_cd, 3=>$riyou_user_id]]);
		$readonlys=[];
		foreach ($readonly_field_kbns as $readonly_field_kbn) {
			$readonlys[$readonly_field_kbn->field_cd]=$readonly_field_kbn->readonly_flg;
		}
		return $readonlys;
    }

	public function ajaxSaveAction()
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

		$error_kensuu = 0;
		$riyou_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
		$readonly_field_kbns = ReadonlyFieldKbns::find([
			"conditions"=>"controller_cd = ?1 AND gamen_cd = ?2 AND riyou_user_id = ?3",
			"bind"=>[
				1=>$this->request->getPost('controller_cd'),
				2=>$this->request->getPost('gamen_cd'),
				3=>(int)$this->getDI()->getSession()->get('auth')['id']
			]
		]);
		$readonlys = $this->request->getPost('readonlys');
		$updated_readonlys=[];
		foreach ($readonly_field_kbns as $readonly_field_kbn) {
			if (array_key_exists($readonly_field_kbn->field_cd, $readonlys)) {
				$readonly_field_kbn->readonly_flg = $readonlys[$readonly_field_kbn->field_cd] !== 'false';
				if (!$readonly_field_kbn->save()) {$error_kensuu++;}
				$updated_readonlys[] = $readonly_field_kbn->field_cd;
			} else {
				if (!$readonly_field_kbn->delete()) {$error_kensuu++;}
			}
		}
		foreach ($readonlys as $field_cd=>$readonly_flg) {
			if (!in_array($field_cd, $updated_readonlys)) {
				$readonly_field_kbn = new ReadonlyFieldKbns();
				$readonly_field_kbn->cd = $this->request->getPost('controller_cd').'/'.$this->request->getPost('gamen_cd').'/'.$riyou_user_id.'/'.$field_cd;
				$readonly_field_kbn->name = $field_cd;
				$readonly_field_kbn->controller_cd = $this->request->getPost('controller_cd');
				$readonly_field_kbn->gamen_cd = $this->request->getPost('gamen_cd');
				$readonly_field_kbn->riyou_user_id = $riyou_user_id;
				$readonly_field_kbn->field_cd = $field_cd;
				$readonly_field_kbn->readonly_flg = $readonly_flg !== 'false';
				if (!$readonly_field_kbn->save()) {$error_kensuu++;}
			}
		}
//		テーブル項目幅
		$rewidth_field_mrs = RewidthFieldMrs::find([
			"conditions"=>"controller_cd = ?1 AND gamen_cd = ?2 AND riyou_user_id = ?3",
			"bind"=>[
				1=>$this->request->getPost('controller_cd'),
				2=>$this->request->getPost('gamen_cd'),
				3=>(int)$this->getDI()->getSession()->get('auth')['id']
			]
		]);
		$rewidths = $this->request->getPost('rewidths');
		$updated_rewidths=[];
		foreach ($rewidth_field_mrs as $rewidth_field_mr) {
			if (array_key_exists($rewidth_field_mr->field_cd, $rewidths)) {
				$rewidth_field_mr->haba = $rewidths[$rewidth_field_mr->field_cd];
				if (!$rewidth_field_mr->save()) {$error_kensuu++;}
				$updated_rewidths[] = $rewidth_field_mr->field_cd;
			} else {
				if (!$rewidth_field_mr->delete()) {$error_kensuu++;}
			}
		}
		foreach ($rewidths as $field_cd=>$haba) {
			if (!in_array($field_cd, $updated_rewidths)) {
				$rewidth_field_mr = new RewidthFieldMrs();
				$rewidth_field_mr->cd = $this->request->getPost('controller_cd').'/'.$this->request->getPost('gamen_cd').'/'.$riyou_user_id.'/'.$field_cd;
				$rewidth_field_mr->name = $field_cd;
				$rewidth_field_mr->controller_cd = $this->request->getPost('controller_cd');
				$rewidth_field_mr->gamen_cd = $this->request->getPost('gamen_cd');
				$rewidth_field_mr->riyou_user_id = $riyou_user_id;
				$rewidth_field_mr->field_cd = $field_cd;
				$rewidth_field_mr->haba = $haba;
				if (!$rewidth_field_mr->save()) {$error_kensuu++;}
			}
		}
	    //Set the content of the response
	    $response->setContent(json_encode($error_kensuu));

	    //Return the response
	    return $response;
	}

}
