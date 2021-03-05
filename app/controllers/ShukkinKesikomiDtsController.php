<?php
 


class ShukkinKesikomiDtsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        ControllerBase::indexCd("ShukkinKesikomiDts", "出金消込"); //簡易検索付き一覧表示
    }

    /**
     * Searches for shukkin_kesikomi_dts
     */
    public function searchAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Displays the creation form
     */
    public function newAction($id=null, $dataname="ShukkinKesikomiDts")
    {
        $this->view->imax = 0;

        if ($id) {
            $nameDts = $dataname;
            $shukkin_kesikomi_dt = $nameDts::findFirstByid($id);
            if (!$shukkin_kesikomi_dt) {
                $this->flash->error("出金消込が見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "shukkin_kesikomi_dts",
                    'action' => 'index'
                ));

                return;
            }
            $this->_setDefault($shukkin_kesikomi_dt, "new", $dataname);
            $this->tag->setDefault("id", null);
            $this->tag->setDefault("cd", null);
        }

    }

    /**
     * 修正画面から「次へ」ボタンを押したら次のコードの修正画面になる。
     */
    public function nextAction($id)
    {
        ControllerBase::nextCd($id, "shukkin_kesikomi_dts", "ShukkinKesikomiDts", "出金消込");
    }

    /**
     * 修正画面から「前へ」ボタンを押したら前のコードの修正画面になる。
     */
    public function prevAction($id)
    {
        ControllerBase::prevCd($id, "shukkin_kesikomi_dts", "ShukkinKesikomiDts", "出金消込");
    }

    /**
     * Edits a shukkin_kesikomi_dt
     *
     * @param string $id
     */
    public function editAction($id)
    {
//        if (!$this->request->isPost()) {

            $shukkin_kesikomi_dt = ShukkinKesikomiDts::findFirstByid($id);
            if (!$shukkin_kesikomi_dt) {
                $this->flash->error("出金消込が見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "shukkin_kesikomi_dts",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->id = $shukkin_kesikomi_dt->id;

            $this->_setDefault($shukkin_kesikomi_dt, "edit");
//        }
    }

    /**
     * 画面に表示するデータをセットする
     */
    public function _setDefault($shukkin_kesikomi_dt, $action="edit", $meisai="ShukkinKesikomiDts")
    {
        $setdts = ["id",
            "shiire_meisai_dt_id",
            "kesikomi_gaku",
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
            if (property_exists($shukkin_kesikomi_dt, $setdt)) {
                $this->tag->setDefault($setdt, $shukkin_kesikomi_dt->$setdt);
            }
        }
    }

    /**
     * Creates a new shukkin_kesikomi_dt
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "shukkin_kesikomi_dts",
                'action' => 'index'
            ));

            return;
        }

        $shukkin_kesikomi_dt = new ShukkinKesikomiDts();

        $post_flds = [];
        $post_flds = ["shiire_meisai_dt_id",
            "kesikomi_gaku",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        foreach ($post_flds as $post_fld) {
            $shukkin_kesikomi_dt->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$shukkin_kesikomi_dt->save()) {
            foreach ($shukkin_kesikomi_dt->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "shukkin_kesikomi_dts",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("出金消込の作成が完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "shukkin_kesikomi_dts",
            'action' => 'edit',
            'params' => array($shukkin_kesikomi_dt->id)
        ));
    }

    /**
     * Saves a shukkin_kesikomi_dt edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "shukkin_kesikomi_dts",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $shukkin_kesikomi_dt = ShukkinKesikomiDts::findFirstByid($id);

        if (!$shukkin_kesikomi_dt) {
            $this->flash->error("出金消込が見つからなくなりました。" . $id);

            $this->dispatcher->forward(array(
                'controller' => "shukkin_kesikomi_dts",
                'action' => 'index'
            ));

            return;
        }

        if ($shukkin_kesikomi_dt->updated !== $this->request->getPost("updated")) {
            $this->flash->error("他のプロセスから出金消込が変更されたため更新を中止しました。"
                . $id . ",uid=" . $shukkin_kesikomi_dt->kousin_user_id . " tb=" . $shukkin_kesikomi_dt->updated ." pt=" . $this->request->getPost("updated"));

            $this->dispatcher->forward(array(
                'controller' => "shukkin_kesikomi_dts",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $post_flds = [];
        $post_flds = ["shiire_meisai_dt_id",
            "kesikomi_gaku",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        $chg_flg = 0;
        foreach ($post_flds as $post_fld) {
            if ((array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld)) !== $shukkin_kesikomi_dt->$post_fld) {
                $chg_flg = 1;
                break;
            }
        }
        if ($chg_flg === 0) {
            $this->flash->error("変更がありません。" . $id);

            $this->dispatcher->forward(array(
                "controller" => "shukkin_kesikomi_dts",
                "action" => "edit",
                "params" => array($shukkin_kesikomi_dt->id)
            ));

            return;
        }

        $this->_bakOut($shukkin_kesikomi_dt);

        foreach ($post_flds as $post_fld) {
            $shukkin_kesikomi_dt->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$shukkin_kesikomi_dt->save()) {

            foreach ($shukkin_kesikomi_dt->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "shukkin_kesikomi_dts",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $this->flash->success("出金消込の情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "shukkin_kesikomi_dts",
            'action' => 'edit',
            'params' => array($shukkin_kesikomi_dt->id)
        ));
    }

    /**
     * Deletes a shukkin_kesikomi_dt
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $shukkin_kesikomi_dt = ShukkinKesikomiDts::findFirstByid($id);
        if (!$shukkin_kesikomi_dt) {
            $this->flash->error("出金消込が見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "shukkin_kesikomi_dts",
                'action' => 'index'
            ));

            return;
        }

        $this->_bakOut($shukkin_kesikomi_dt, 1);

        if (!$shukkin_kesikomi_dt->delete()) {

            foreach ($shukkin_kesikomi_dt->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "shukkin_kesikomi_dts",
                'action' => 'search'
            ));

            return;
        }

        $this->flash->success("出金消込の削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "shukkin_kesikomi_dts",
            'action' => "index"
        ));
    }

    /**
     * Back Out a shukkin_kesikomi_dt
     *
     * @param string $shukkin_kesikomi_dt, $dlt_flg
     */
    public function _bakOut($shukkin_kesikomi_dt, $dlt_flg = 0)
    {

        $bak_shukkin_kesikomi_dt = new BakShukkinKesikomiDts();
        foreach ($shukkin_kesikomi_dt as $fld => $value) {
            $bak_shukkin_kesikomi_dt->$fld = $shukkin_kesikomi_dt->$fld;
        }
        $bak_shukkin_kesikomi_dt->id = NULL;
        $bak_shukkin_kesikomi_dt->id_moto = $shukkin_kesikomi_dt->id;
        $bak_shukkin_kesikomi_dt->hikae_dltflg = $dlt_flg;
        $bak_shukkin_kesikomi_dt->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_shukkin_kesikomi_dt->hikae_nichiji = date("Y-m-d H:i:s");
        if (!$bak_shukkin_kesikomi_dt->save()) {
            foreach ($bak_shukkin_kesikomi_dt->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
    }

	public function ajaxSetAction()
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
		$henka_gaku = 0;
		$error_count = 0;
		$error_message = [];

	    $shiire_meisai_dt = ShiireMeisaiDts::findFirstByid($this->request->getPost('id'));
		if ($this->request->getPost('kesi_flg') == 1) { // 消し込むとき
			if ($shiire_meisai_dt->ShukkinKesikomiDts) { // 存在する
				$shukkin_kesikomi_dt = $shiire_meisai_dt->ShukkinKesikomiDts;
				$henka_gaku -= $shukkin_kesikomi_dt->kesikomi_gaku;
				$this->_bakOut($shukkin_kesikomi_dt);
			} else {
				$shukkin_kesikomi_dt = new ShukkinKesikomiDts();
				$shukkin_kesikomi_dt->shiire_meisai_dt_id = $shiire_meisai_dt->id;
			}
			$shukkin_kesikomi_dt->kesikomi_gaku = $shiire_meisai_dt->zeinukigaku + $shiire_meisai_dt->zeigaku;
			$henka_gaku += $shukkin_kesikomi_dt->kesikomi_gaku;
			if (!$shukkin_kesikomi_dt->save()) {
				$error_count++;
				foreach ($shukkin_kesikomi_dt->getMessages() as $message) {
					$error_message[] = $message;
				}
			}
		} else { // 消込の取消
			if ($shiire_meisai_dt->ShukkinKesikomiDts) { // 存在する
				$shukkin_kesikomi_dt = $shiire_meisai_dt->ShukkinKesikomiDts;
				$henka_gaku -= $shukkin_kesikomi_dt->kesikomi_gaku;
				$this->_bakOut($shukkin_kesikomi_dt, 1);
				if (!$shukkin_kesikomi_dt->delete()) {
					$error_count++;
					foreach ($shukkin_kesikomi_dt->getMessages() as $message) {
						$error_message[] = $message;
					}
				}
			} else {
				$error_count++;
				$error_message[]= "取消すべき消込情報が見つからなくなりました。";
			}
		}
	    $resData = ['henka_gaku'=>$henka_gaku, 'error_count'=>$error_count, 'error_message'=>$error_message];

	    //Set the content of the response
	    $response->setContent(json_encode($resData));

	    //Return the response
	    return $response;
	}

    /**
     * 伝票計での消込
     *
     * @return \Phalcon\Http\Response
     */
    public function ajaxAllSetAction()
    {
        $this->view->disable();
        $response = new \Phalcon\Http\Response();
        if (!$this->request->isAjax()) {
            echo "is not Ajax ! ";
        }
        if (!$this->request->isPost()) {
            echo "is not Post ! ";
        }
        // 仕入IDから、明細情報を取得し、明細１行ずつの状態を調べ消し込みする
        $kesikomi = $this->request->getPost('id');
        $kesiFlg = $this->request->getPost('kesi_flg');
        $error_message = [];
        $shiire_dt = ShiireDts::findFirstByid($kesikomi);
        foreach ($shiire_dt->ShiireMeisaiDts as $shiire_meisai_dt) {
            if (!$shiire_meisai_dt->ShukkinKesikomiDts->id && (float)$shiire_meisai_dt->zeinukigaku + (float)$shiire_meisai_dt->zeigaku !== 0) { // 新規
                $shukkin_kesikomi_dt = new ShukkinKesikomiDts();
                $shukkin_kesikomi_dt->shiire_meisai_dt_id = $shiire_meisai_dt->id;
                $shukkin_kesikomi_dt->kesikomi_gaku = $shiire_meisai_dt->zeinukigaku + $shiire_meisai_dt->zeigaku;
                if (!$shukkin_kesikomi_dt->save()) {
                    foreach ($shukkin_kesikomi_dt->getMessages() as $message) {
                        $error_message[] = $message;
                    }
                }
            } else if ($shiire_meisai_dt->ShukkinKesikomiDts->kesikomi_gaku !== (float)$shiire_meisai_dt->zeinukigaku + (float)$shiire_meisai_dt->zeigaku) { // 変更
                if ($kesiFlg == 1) {
                    $shukkin_kesikomi_dt = $shiire_meisai_dt->ShukkinKesikomiDts;
                    $shukkin_kesikomi_dt->kesikomi_gaku = $shiire_meisai_dt->zeinukigaku + $shiire_meisai_dt->zeigaku;
                    if (!$shukkin_kesikomi_dt->save()) {
                        foreach ($shukkin_kesikomi_dt->getMessages() as $message) {
                            $error_message[] = $message;
                        }
                    }
                } else {
                    $shukkin_kesikomi_dt = $shiire_meisai_dt->ShukkinKesikomiDts;
                    if (!$shukkin_kesikomi_dt->delete()) {
                        foreach ($shukkin_kesikomi_dt->getMessages() as $message) {
                            $error_message[] = $message;
                        }
                    }
                }
            }
        }

        $resData = ['OK:'=> 'OK', 'error_message'=>$error_message];
        $response->setContent(json_encode($resData));
        return $response;
    }
}
