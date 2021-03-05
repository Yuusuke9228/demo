<?php
 


class JunjoKbnsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        ControllerBase::indexCd("JunjoKbns", "順序区分"); //簡易検索付き一覧表示
    }

    /**
     * Searches for junjo_kbns
     */
    public function searchAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Displays the creation form
     */
    public function newAction($id=null, $dataname="JunjoKbns")
    {
        $this->view->imax = 0;

        if ($id) {
            $nameDts = $dataname;
            $junjo_kbn = $nameDts::findFirstByid($id);
            if (!$junjo_kbn) {
                $this->flash->error("順序区分が見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "junjo_kbns",
                    'action' => 'index'
                ));

                return;
            }
            $this->_setDefault($junjo_kbn, "new", $dataname);
            $this->tag->setDefault("id", null);
            $this->tag->setDefault("cd", null);
        }

    }

    /**
     * 修正画面から「次へ」ボタンを押したら次のコードの修正画面になる。
     */
    public function nextAction($id)
    {
        ControllerBase::nextCd($id, "junjo_kbns", "JunjoKbns", "順序区分");
    }

    /**
     * 修正画面から「前へ」ボタンを押したら前のコードの修正画面になる。
     */
    public function prevAction($id)
    {
        ControllerBase::prevCd($id, "junjo_kbns", "JunjoKbns", "順序区分");
    }

    /**
     * Edits a junjo_kbn
     *
     * @param string $id
     */
    public function editAction($id)
    {
//        if (!$this->request->isPost()) {

            $junjo_kbn = JunjoKbns::findFirstByid($id);
            if (!$junjo_kbn) {
                $this->flash->error("順序区分が見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "junjo_kbns",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->id = $junjo_kbn->id;

            $this->_setDefault($junjo_kbn, "edit");
//        }
    }

    /**
     * 画面に表示するデータをセットする
     */
    public function _setDefault($junjo_kbn, $action="edit", $meisai="JunjoKbns")
    {
        $setdts = ["id",
            "cd",
            "name",
            "tablecd",
            "yobidasi_tbl",
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
            if (property_exists($junjo_kbn, $setdt)) {
                $this->tag->setDefault($setdt, $junjo_kbn->$setdt);
            }
        }
    }

    /**
     * Creates a new junjo_kbn
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "junjo_kbns",
                'action' => 'index'
            ));

            return;
        }

        $junjo_kbn = new JunjoKbns();

        $post_flds = [];
        $post_flds = ["cd",
            "name",
            "tablecd",
            "yobidasi_tbl",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        foreach ($post_flds as $post_fld) {
            $junjo_kbn->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$junjo_kbn->save()) {
            foreach ($junjo_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "junjo_kbns",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("順序区分の作成が完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "junjo_kbns",
            'action' => 'edit',
            'params' => array($junjo_kbn->id)
        ));
    }

    /**
     * Saves a junjo_kbn edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "junjo_kbns",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $junjo_kbn = JunjoKbns::findFirstByid($id);

        if (!$junjo_kbn) {
            $this->flash->error("順序区分が見つからなくなりました。" . $id);

            $this->dispatcher->forward(array(
                'controller' => "junjo_kbns",
                'action' => 'index'
            ));

            return;
        }

        if ($junjo_kbn->updated !== $this->request->getPost("updated")) {
            $this->flash->error("他のプロセスから順序区分が変更されたため更新を中止しました。"
                . $id . ",uid=" . $junjo_kbn->kousin_user_id . " tb=" . $junjo_kbn->updated ." pt=" . $this->request->getPost("updated"));

            $this->dispatcher->forward(array(
                'controller' => "junjo_kbns",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $post_flds = [];
        $post_flds = ["cd",
            "name",
            "tablecd",
            "yobidasi_tbl",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        $chg_flg = 0;
        foreach ($post_flds as $post_fld) {
            if ((array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld)) !== $junjo_kbn->$post_fld) {
                $chg_flg = 1;
                break;
            }
        }
        if ($chg_flg === 0) {
            $this->flash->error("変更がありません。" . $id);

            $this->dispatcher->forward(array(
                "controller" => "junjo_kbns",
                "action" => "edit",
                "params" => array($junjo_kbn->id)
            ));

            return;
        }

        $this->_bakOut($junjo_kbn);

        foreach ($post_flds as $post_fld) {
            $junjo_kbn->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$junjo_kbn->save()) {

            foreach ($junjo_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "junjo_kbns",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $this->flash->success("順序区分の情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "junjo_kbns",
            'action' => 'edit',
            'params' => array($junjo_kbn->id)
        ));
    }

    /**
     * Deletes a junjo_kbn
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $junjo_kbn = JunjoKbns::findFirstByid($id);
        if (!$junjo_kbn) {
            $this->flash->error("順序区分が見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "junjo_kbns",
                'action' => 'index'
            ));

            return;
        }

        if (!$junjo_kbn->delete()) {

            foreach ($junjo_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "junjo_kbns",
                'action' => 'search'
            ));

            return;
        }

        $this->_bakOut($junjo_kbn, 1);

        $this->flash->success("順序区分の削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "junjo_kbns",
            'action' => "index"
        ));
    }

    /**
     * Back Out a junjo_kbn
     *
     * @param string $junjo_kbn, $dlt_flg
     */
    public function _bakOut($junjo_kbn, $dlt_flg = 0)
    {

        $bak_junjo_kbn = new BakJunjoKbns();
        foreach ($junjo_kbn as $fld => $value) {
            $bak_junjo_kbn->$fld = $junjo_kbn->$fld;
        }
        $bak_junjo_kbn->id = NULL;
        $bak_junjo_kbn->id_moto = $junjo_kbn->id;
        $bak_junjo_kbn->hikae_dltflg = $dlt_flg;
        $bak_junjo_kbn->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_junjo_kbn->hikae_nichiji = date("Y-m-d H:i:s");
        if (!$bak_junjo_kbn->save()) {
            foreach ($bak_junjo_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
    }

    //  レポート作成時、得意先別の最初と最後のコードを返す
	public function ajaxHanniAction()
	{
		$this->view->disable();
		$response = new \Phalcon\Http\Response();//Create a response instance
		if (!$this->request->isAjax()) {echo "is not Ajax ! "; /* return; */ }
		if (!$this->request->isPost()) {echo "is not Post ! "; /* return; */ }
		$cd = $this->request->getPost('cd');
		// 等価演算子は厳密に比較しないと'1'も一致してしまい、エラーが発生する
		if (!$cd || substr($cd,-2) === "01") { // $cdが指定されたときだけ && "01"=日付でないときだけ
			return;
		}
		$junjo_kbn = JunjoKbns::findFirst(["conditions"=>"cd = ?0","bind"=>[0=>$cd]]);
		if (!$junjo_kbn) {
			return;
		}
		$classname = str_replace(' ', '', ucwords(str_replace('_', ' ', strtolower($junjo_kbn->tablecd))));
		$resData = array();
		$target_row = $classname::findFirst(['columns' => array('cd', 'name'), 'order' => 'cd']);
		$resData['from'] = $target_row->cd;
		$resData['from_name'] = $target_row->name;
		$target_row = $classname::findFirst(['columns' => array('cd', 'name'), 'order' => 'cd DESC']);
		$resData['to'] = $target_row->cd;
		$resData['to_name'] = $target_row->name;
		$resData['junjo_kbn_table'] = $junjo_kbn->tablecd;
		$response->setContent(json_encode($resData)); //Set the content of the response
		return $response;
	}

//  レポート作成時、得意先別などコードを返す
	public function ajaxGetAction()
	{
		$this->view->disable();
		$response = new \Phalcon\Http\Response();//Create a response instance
		if (!$this->request->isAjax()) {echo "is not Ajax ! "; /* return; */ }
		if (!$this->request->isPost()) {echo "is not Post ! "; /* return; */ }
		$target = $this->request->getPost('target_cd');
		if (!$target || substr($target,-2) == "01") { // $targetが指定されたときだけ && "01"=日付でないときだけ
			return;
		}
		$junjo_kbn = JunjoKbns::findFirst(["conditions"=>"cd = ?0","bind"=>[0=>$target]]);
		if (!$junjo_kbn) {
			return;
		}
		$controller_name = str_replace(' ', '', ucwords(str_replace('_', ' ', strtolower($junjo_kbn->tablecd)))).'Controller';
//		$resData = array();
//		$resData[] = ["name"=>$classname];
//		$response->setContent(json_encode($resData)); //Set the content of the response
//		return $response;
		$table_ctlr = new $controller_name();
		return $table_ctlr->ajaxGetAction();
	}


}
