<?php
 


class DenpyouBangouMrsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        ControllerBase::indexCd("DenpyouBangouMrs", "伝票番号マスタ", "denpyou_mr_cd"); //簡易検索付き一覧表示
    }

    /**
     * Searches for denpyou_bangou_mrs
     */
    public function searchAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Displays the creation form
     */
    public function newAction($id=null, $dataname="DenpyouBangouMrs")
    {
        $this->view->imax = 0;

        if ($id) {
            $nameDts = $dataname;
            $denpyou_bangou_mr = $nameDts::findFirstByid($id);
            if (!$denpyou_bangou_mr) {
                $this->flash->error("伝票番号マスタが見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "denpyou_bangou_mrs",
                    'action' => 'index'
                ));

                return;
            }
            $this->_setDefault($denpyou_bangou_mr, "new", $dataname);
            $this->tag->setDefault("id", null);
            $this->tag->setDefault("cd", null);
        }

    }

    /**
     * 修正画面から「次へ」ボタンを押したら次のコードの修正画面になる。
     */
    public function nextAction($id)
    {
        ControllerBase::nextCd($id, "denpyou_bangou_mrs", "DenpyouBangouMrs", "伝票番号マスタ", "denpyou_mr_cd");
    }

    /**
     * 修正画面から「前へ」ボタンを押したら前のコードの修正画面になる。
     */
    public function prevAction($id)
    {
        ControllerBase::prevCd($id, "denpyou_bangou_mrs", "DenpyouBangouMrs", "伝票番号マスタ", "denpyou_mr_cd");
    }

    /**
     * Edits a denpyou_bangou_mr
     *
     * @param string $id
     */
    public function editAction($id)
    {
//        if (!$this->request->isPost()) {

            $denpyou_bangou_mr = DenpyouBangouMrs::findFirstByid($id);
            if (!$denpyou_bangou_mr) {
                $this->flash->error("伝票番号マスタが見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "denpyou_bangou_mrs",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->id = $denpyou_bangou_mr->id;

            $this->_setDefault($denpyou_bangou_mr, "edit");
//        }
    }

    /**
     * 画面に表示するデータをセットする
     */
    public function _setDefault($denpyou_bangou_mr, $action="edit", $meisai="DenpyouBangouMrs")
    {
        $setdts = ["id",
            "denpyou_mr_cd",
            "nendo",
            "saishuu_bangou",
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
            if (property_exists($denpyou_bangou_mr, $setdt)) {
                $this->tag->setDefault($setdt, $denpyou_bangou_mr->$setdt);
            }
        }
    }

    /**
     * Creates a new denpyou_bangou_mr
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "denpyou_bangou_mrs",
                'action' => 'index'
            ));

            return;
        }

        $denpyou_bangou_mr = new DenpyouBangouMrs();

        $post_flds = [];
        $post_flds = ["denpyou_mr_cd",
            "nendo",
            "saishuu_bangou",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        foreach ($post_flds as $post_fld) {
            $denpyou_bangou_mr->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$denpyou_bangou_mr->save()) {
            foreach ($denpyou_bangou_mr->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "denpyou_bangou_mrs",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("伝票番号マスタの作成が完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "denpyou_bangou_mrs",
            'action' => 'edit',
            'params' => array($denpyou_bangou_mr->id)
        ));
    }

    /**
     * Saves a denpyou_bangou_mr edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "denpyou_bangou_mrs",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $denpyou_bangou_mr = DenpyouBangouMrs::findFirstByid($id);

        if (!$denpyou_bangou_mr) {
            $this->flash->error("伝票番号マスタが見つからなくなりました。" . $id);

            $this->dispatcher->forward(array(
                'controller' => "denpyou_bangou_mrs",
                'action' => 'index'
            ));

            return;
        }

        if ($denpyou_bangou_mr->updated !== $this->request->getPost("updated")) {
            $this->flash->error("他のプロセスから伝票番号マスタが変更されたため更新を中止しました。"
                . $id . ",uid=" . $denpyou_bangou_mr->kousin_user_id . " tb=" . $denpyou_bangou_mr->updated ." pt=" . $this->request->getPost("updated"));

            $this->dispatcher->forward(array(
                'controller' => "denpyou_bangou_mrs",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $post_flds = [];
        $post_flds = ["denpyou_mr_cd",
            "nendo",
            "saishuu_bangou",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        $chg_flg = 0;
        foreach ($post_flds as $post_fld) {
            if ((array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld)) !== $denpyou_bangou_mr->$post_fld) {
                $chg_flg = 1;
                break;
            }
        }
        if ($chg_flg === 0) {
            $this->flash->error("変更がありません。" . $id);

            $this->dispatcher->forward(array(
                "controller" => "denpyou_bangou_mrs",
                "action" => "edit",
                "params" => array($denpyou_bangou_mr->id)
            ));

            return;
        }

        $this->_bakOut($denpyou_bangou_mr);

        foreach ($post_flds as $post_fld) {
            $denpyou_bangou_mr->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$denpyou_bangou_mr->save()) {

            foreach ($denpyou_bangou_mr->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "denpyou_bangou_mrs",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $this->flash->success("伝票番号マスタの情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "denpyou_bangou_mrs",
            'action' => 'edit',
            'params' => array($denpyou_bangou_mr->id)
        ));
    }

    /**
     * Deletes a denpyou_bangou_mr
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $denpyou_bangou_mr = DenpyouBangouMrs::findFirstByid($id);
        if (!$denpyou_bangou_mr) {
            $this->flash->error("伝票番号マスタが見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "denpyou_bangou_mrs",
                'action' => 'index'
            ));

            return;
        }

        $this->_bakOut($denpyou_bangou_mr, 1);

        if (!$denpyou_bangou_mr->delete()) {

            foreach ($denpyou_bangou_mr->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "denpyou_bangou_mrs",
                'action' => 'search'
            ));

            return;
        }

        $this->flash->success("伝票番号マスタの削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "denpyou_bangou_mrs",
            'action' => "index"
        ));
    }

    /**
     * カウントアップ  伝票番号
     *
     * @param string $denpyou_bangou_mr, $dlt_flg
     */

    public function _countup($denpyou_cd, $denpyou_no = 0, $denpyou_bi = "0000-00-00")
    {
		$konnnenndo = Konnnenndo::findFirst(["conditions"=>"touki_flg = 1"]);
/*		if ($denpyou_bi > $konnnenndo->kikan_to) {
			$konnnenndo = Konnnenndo::findFirst(["conditions"=>"cd > ?0", "bind"=>[0=>$konnnenndo->cd], "order"=>"cd"]);
		}
*/		$conditions = "nendo = :nendo: AND denpyou_mr_cd = :denpyou_mr_cd:"; // where条件
		$bind = array("nendo"=>$konnnenndo->cd, "denpyou_mr_cd"=>$denpyou_cd); // 条件の値
		$denpyou_bangou_mr = DenpyouBangouMrs::findFirst(["conditions" => $conditions, "bind" => $bind]);
		if ($denpyou_no == 0) { // 通常の付番
			$denpyou_no = $denpyou_bangou_mr->saishuu_bangou + 1;
		}
		$denpyou_bangou_mr->saishuu_bangou = $denpyou_no; // 通常付番も手入力付番も伝票番号マスタに更新する。
        if (!$denpyou_bangou_mr->save()) {
            foreach ($denpyou_bangou_mr->getMessages() as $message) {
                $this->flash->error($message);
            }
            $denpyou_no = 0; // 失敗の印として伝票番号=0を返す
		}
		return $denpyou_no; // 付けた伝票番号を返す。
    }

    /**
     * 正カウントアップ  伝票番号
     *
     * @param string $denpyou_bangou_mr, $dlt_flg
     */

    public function countup($denpyou_cd, $denpyou_no = 0, $denpyou_bi = "0000-00-00", $nendo0 = 0)
    {
		if ($denpyou_bi == '0000-00-00') {$denpyou_bi = date('Y-mm-dd');}
		$konnnenndo = Konnnenndo::findFirst(["kikan_from <= ?0 AND kikan_to >= ?0", "bind"=>[0=>$denpyou_bi]]);
		if (!$konnnenndo) {
			return ['nendo' => 0, 'bangou' => 0];//エラー:年度が未登録（日付が今年か昨年以外は不可）
		}
		if ($nendo0 == $konnnenndo->cd) {
			return ['nendo' => $nendo0, 'bangou' => $denpyou_no]; // 年度チェックOK正常で帰る
		} else if ($nendo0 != 0) { // 更新処理で年度が変ったら新規採番するため
			$denpyou_no = 0; // 一旦伝票番号を０にする
		}
		$nendo = $konnnenndo->cd;
		$conditions = "(nendo = :nendo: OR nendo = 9999) AND denpyou_mr_cd = :denpyou_mr_cd:"; // where条件
		$bind = array("nendo"=>$nendo, "denpyou_mr_cd"=>$denpyou_cd); // 条件の値
		$denpyou_bangou_mr = DenpyouBangouMrs::findFirst(["conditions" => $conditions, "bind" => $bind]);
		if (!$denpyou_bangou_mr) {
			$denpyou_bangou_mr = new DenpyouBangouMrs();
			$denpyou_bangou_mr->denpyou_mr_cd = $denpyou_cd;
			$denpyou_bangou_mr->nendo = $nendo;
			$denpyou_bangou_mr->saishuu_bangou = 0;
		}
		if ($denpyou_no == 0) { // 通常の付番
			$denpyou_no = $denpyou_bangou_mr->saishuu_bangou + 1;
		}
		$denpyou_bangou_mr->saishuu_bangou = $denpyou_no; // 通常付番も手入力付番も伝票番号マスタに更新する。
        if (!$denpyou_bangou_mr->save()) {
            foreach ($denpyou_bangou_mr->getMessages() as $message) {
                $this->flash->error($message);
            }
            $denpyou_no = 0; // 失敗の印として伝票番号=0を返す
		}
		$nendo_ban = ['nendo' => $nendo, 'bangou' => $denpyou_no];
		return $nendo_ban; // 年度と付けた伝票番号を返す。
    }

    /**
     * Back Out a denpyou_bangou_mr
     *
     * @param string $denpyou_bangou_mr, $dlt_flg
     */
    public function _bakOut($denpyou_bangou_mr, $dlt_flg = 0)
    {

        $bak_denpyou_bangou_mr = new BakDenpyouBangouMrs();
        foreach ($denpyou_bangou_mr as $fld => $value) {
            $bak_denpyou_bangou_mr->$fld = $denpyou_bangou_mr->$fld;
        }
        $bak_denpyou_bangou_mr->id = NULL;
        $bak_denpyou_bangou_mr->id_moto = $denpyou_bangou_mr->id;
        $bak_denpyou_bangou_mr->hikae_dltflg = $dlt_flg;
        $bak_denpyou_bangou_mr->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_denpyou_bangou_mr->hikae_nichiji = date("Y-m-d H:i:s");
        if (!$bak_denpyou_bangou_mr->save()) {
            foreach ($bak_denpyou_bangou_mr->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
    }

}
