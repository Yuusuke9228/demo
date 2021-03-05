<?php
 


class KikanSiteiKbnsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        ControllerBase::indexCd("KikanSiteiKbns", "期間指定区分"); //簡易検索付き一覧表示
    }

    /**
     * Searches for kikan_sitei_kbns
     */
    public function searchAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Displays the creation form
     */
    public function newAction($id=null, $dataname="KikanSiteiKbns")
    {
        $this->view->imax = 0;

        if ($id) {
            $nameDts = $dataname;
            $kikan_sitei_kbn = $nameDts::findFirstByid($id);
            if (!$kikan_sitei_kbn) {
                $this->flash->error("期間指定区分が見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "kikan_sitei_kbns",
                    'action' => 'index'
                ));

                return;
            }
            $this->_setDefault($kikan_sitei_kbn, "new", $dataname);
            $this->tag->setDefault("id", null);
            $this->tag->setDefault("cd", null);
        }

    }

    /**
     * 修正画面から「次へ」ボタンを押したら次のコードの修正画面になる。
     */
    public function nextAction($id)
    {
        ControllerBase::nextCd($id, "kikan_sitei_kbns", "KikanSiteiKbns", "期間指定区分");
    }

    /**
     * 修正画面から「前へ」ボタンを押したら前のコードの修正画面になる。
     */
    public function prevAction($id)
    {
        ControllerBase::prevCd($id, "kikan_sitei_kbns", "KikanSiteiKbns", "期間指定区分");
    }

    /**
     * Edits a kikan_sitei_kbn
     *
     * @param string $id
     */
    public function editAction($id)
    {
//        if (!$this->request->isPost()) {

            $kikan_sitei_kbn = KikanSiteiKbns::findFirstByid($id);
            if (!$kikan_sitei_kbn) {
                $this->flash->error("期間指定区分が見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "kikan_sitei_kbns",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->id = $kikan_sitei_kbn->id;

            $this->_setDefault($kikan_sitei_kbn, "edit");
//        }
    }

    /**
     * 画面に表示するデータをセットする
     */
    public function _setDefault($kikan_sitei_kbn, $action="edit", $meisai="KikanSiteiKbns")
    {
        $setdts = ["id",
            "cd",
            "name",
            "yobidasi_tbl",
            "script_from",
            "script_to",
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
            if (property_exists($kikan_sitei_kbn, $setdt)) {
                $this->tag->setDefault($setdt, $kikan_sitei_kbn->$setdt);
            }
        }
    }

    /**
     * Creates a new kikan_sitei_kbn
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "kikan_sitei_kbns",
                'action' => 'index'
            ));

            return;
        }

        $kikan_sitei_kbn = new KikanSiteiKbns();

        $post_flds = [];
        $post_flds = ["cd",
            "name",
            "yobidasi_tbl",
            "script_from",
            "script_to",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        foreach ($post_flds as $post_fld) {
            $kikan_sitei_kbn->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$kikan_sitei_kbn->save()) {
            foreach ($kikan_sitei_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "kikan_sitei_kbns",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("期間指定区分の作成が完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "kikan_sitei_kbns",
            'action' => 'edit',
            'params' => array($kikan_sitei_kbn->id)
        ));
    }

    /**
     * Saves a kikan_sitei_kbn edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "kikan_sitei_kbns",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $kikan_sitei_kbn = KikanSiteiKbns::findFirstByid($id);

        if (!$kikan_sitei_kbn) {
            $this->flash->error("期間指定区分が見つからなくなりました。" . $id);

            $this->dispatcher->forward(array(
                'controller' => "kikan_sitei_kbns",
                'action' => 'index'
            ));

            return;
        }

        if ($kikan_sitei_kbn->updated !== $this->request->getPost("updated")) {
            $this->flash->error("他のプロセスから期間指定区分が変更されたため更新を中止しました。"
                . $id . ",uid=" . $kikan_sitei_kbn->kousin_user_id . " tb=" . $kikan_sitei_kbn->updated ." pt=" . $this->request->getPost("updated"));

            $this->dispatcher->forward(array(
                'controller' => "kikan_sitei_kbns",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $post_flds = [];
        $post_flds = ["cd",
            "name",
            "yobidasi_tbl",
            "script_from",
            "script_to",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        $chg_flg = 0;
        foreach ($post_flds as $post_fld) {
            if ((array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld)) !== $kikan_sitei_kbn->$post_fld) {
                $chg_flg = 1;
                break;
            }
        }
        if ($chg_flg === 0) {
            $this->flash->error("変更がありません。" . $id);

            $this->dispatcher->forward(array(
                "controller" => "kikan_sitei_kbns",
                "action" => "edit",
                "params" => array($kikan_sitei_kbn->id)
            ));

            return;
        }

        $this->_bakOut($kikan_sitei_kbn);

        foreach ($post_flds as $post_fld) {
            $kikan_sitei_kbn->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$kikan_sitei_kbn->save()) {

            foreach ($kikan_sitei_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "kikan_sitei_kbns",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $this->flash->success("期間指定区分の情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "kikan_sitei_kbns",
            'action' => 'edit',
            'params' => array($kikan_sitei_kbn->id)
        ));
    }

    /**
     * Deletes a kikan_sitei_kbn
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $kikan_sitei_kbn = KikanSiteiKbns::findFirstByid($id);
        if (!$kikan_sitei_kbn) {
            $this->flash->error("期間指定区分が見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "kikan_sitei_kbns",
                'action' => 'index'
            ));

            return;
        }

        if (!$kikan_sitei_kbn->delete()) {

            foreach ($kikan_sitei_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "kikan_sitei_kbns",
                'action' => 'search'
            ));

            return;
        }

        $this->_bakOut($kikan_sitei_kbn, 1);

        $this->flash->success("期間指定区分の削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "kikan_sitei_kbns",
            'action' => "index"
        ));
    }

    /**
     * Back Out a kikan_sitei_kbn
     *
     * @param string $kikan_sitei_kbn, $dlt_flg
     */
    public function _bakOut($kikan_sitei_kbn, $dlt_flg = 0)
    {

        $bak_kikan_sitei_kbn = new BakKikanSiteiKbns();
        foreach ($kikan_sitei_kbn as $fld => $value) {
            $bak_kikan_sitei_kbn->$fld = $kikan_sitei_kbn->$fld;
        }
        $bak_kikan_sitei_kbn->id = NULL;
        $bak_kikan_sitei_kbn->id_moto = $kikan_sitei_kbn->id;
        $bak_kikan_sitei_kbn->hikae_dltflg = $dlt_flg;
        $bak_kikan_sitei_kbn->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_kikan_sitei_kbn->hikae_nichiji = date("Y-m-d H:i:s");
        if (!$bak_kikan_sitei_kbn->save()) {
            foreach ($bak_kikan_sitei_kbn->getMessages() as $message) {
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

		switch (substr($this->request->getPost('cd'),-2)) { // 渡された期間区分によって…
		case "01": // 本日
			$kikan_from = date("Y-m-d");
			$kikan_to = date("Y-m-d");
			break;
		case "02": // 昨日
			$kikan_from = date("Y-m-d",strtotime("-1 day"));
			$kikan_to = date("Y-m-d",strtotime("-1 day"));
			break;
		case "03": // 一昨日
			$kikan_from = date("Y-m-d",strtotime("-2 day"));
			$kikan_to = date("Y-m-d",strtotime("-2 day"));
			break;
		case "04": // 今週
			$w = date("w");
			$kikan_from = date("Y-m-d",strtotime("-{$w} day"));
			$w = 6 - $w;
			$kikan_to = date("Y-m-d",strtotime("+{$w} day"));
			break;
		case "05": // 先週
			$w = date("w") + 7;
			$kikan_from = date("Y-m-d",strtotime("-{$w} day"));
			$w -= 6;
			$kikan_to = date("Y-m-d",strtotime("-{$w} day"));
			break;
		case "06": // 先々週
			$w = date("w") + 14;
			$kikan_from = date("Y-m-d",strtotime("-{$w} day"));
			$w -= 6;
			$kikan_to = date("Y-m-d",strtotime("-{$w} day"));
			break;
		case "07": // 今月度
			$kikan_from = date('Y-m-01');
			$kikan_to = date('Y-m-t');
			break;
		case "08": // 前月度
			$kikan_from = date('Y-m-d', strtotime(date('Y-m-1') . '-1 month'));
			$kikan_to = date('Y-m-t', strtotime(date('Y-m-1') . '-1 month'));
			break;
		case "09": // 前々月度
			$kikan_from = date('Y-m-d', strtotime(date('Y-m-1') . '-2 month'));
			$kikan_to = date('Y-m-t', strtotime(date('Y-m-1') . '-2 month'));
			break;
		case "10": // 過去2日間
			$kikan_from = date("Y-m-d",strtotime("-2 day"));
			$kikan_to = date("Y-m-d");
			break;
		case "11": // 過去3日間
			$kikan_from = date("Y-m-d",strtotime("-3 day"));
			$kikan_to = date("Y-m-d");
			break;
		case "12": // 過去2ヶ月間
			$kikan_from = date('Y-m-d', strtotime(date('Y-m-1') . '-2 month'));
			$kikan_to = date('Y-m-t', strtotime(date('Y-m-1') . '-1 month'));
			break;
		case "13": // 過去3ヶ月間
			$kikan_from = date('Y-m-d', strtotime(date('Y-m-1') . '-3 month'));
			$kikan_to = date('Y-m-t', strtotime(date('Y-m-1') . '-1 month'));
			break;
		case "14": // 当会計年度
			$konnnenndo = Konnnenndo::findfirst(["conditions"=>"touki_flg = 1"]);
			$kikan_from = $konnnenndo->kikan_from;
			$kikan_to = $konnnenndo->kikan_to;
			break;
		case "15": // 前会計年度
			$konnnenndo = Konnnenndo::findfirst(["conditions"=>"touki_flg = 1"]);
			$zennnenndo = Konnnenndo::findfirst(["conditions"=>"cd = ?1", "bind"=>[1=>$konnnenndo->cd - 1]]);
			$kikan_from = $zennnenndo?$zennnenndo->kikan_from:date('Y-m-d', strtotime($konnnenndo->kikan_from . '-1 year'));
			$kikan_to = $zennnenndo?$zennnenndo->kikan_to:date('Y-m-d', strtotime($konnnenndo->$kikan_from . '-1 day'));
			break;
		case "16": // すべての会計年度
			$shonenndo = Konnnenndo::findfirst(["order"=>"cd"]);
			$kikan_from = $shonenndo->kikan_from;
			$kikan_to = date("Y-m-t");
			break;
		default; // 任意の期間
			$kikan_from = "0000-00-00";
			$kikan_to = "0000-00-00";
			break;
		}

		$resData = array();
		$resData["kikan_from"] = $kikan_from;
		$resData["kikan_to"] = $kikan_to;

	    //Set the content of the response
	    $response->setContent(json_encode($resData));

	    //Return the response
	    return $response;
	}

}
