<?php

class ChouhyouMrsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        ControllerBase::indexCd("ChouhyouMrs", "帳票レイアウト名"); //簡易検索付き一覧表示
    }

    /**
     * Searches for chouhyou_mrs
     */
    public function searchAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Displays the creation form
     */
    public function newAction($id=null, $dataname="ChouhyouMrs")
    {
        $this->view->imax = 0;

        if ($id) {
            $nameDts = $dataname;
            $chouhyou_mr = $nameDts::findFirstByid($id);
            if (!$chouhyou_mr) {
                $this->flash->error("帳票レイアウト名が見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "chouhyou_mrs",
                    'action' => 'index'
                ));

                return;
            }
            $this->_setDefault($chouhyou_mr, "new", $dataname);
            $this->tag->setDefault("id", null);
            $this->tag->setDefault("cd", null);
        }

    }

    /**
     * 修正画面から「次へ」ボタンを押したら次のコードの修正画面になる。
     */
    public function nextAction($id)
    {
        ControllerBase::nextCd($id, "chouhyou_mrs", "ChouhyouMrs", "帳票レイアウト名");
    }

    /**
     * 修正画面から「前へ」ボタンを押したら前のコードの修正画面になる。
     */
    public function prevAction($id)
    {
        ControllerBase::prevCd($id, "chouhyou_mrs", "ChouhyouMrs", "帳票レイアウト名");
    }

    /**
     * Edits a chouhyou_mr
     *
     * @param string $id
     */
    public function editAction($id)
    {
//        if (!$this->request->isPost()) {

            $chouhyou_mr = ChouhyouMrs::findFirstByid($id);
            if (!$chouhyou_mr) {
                $this->flash->error("帳票レイアウト名が見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "chouhyou_mrs",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->id = $chouhyou_mr->id;
            $this->view->zokusei_mrs = $chouhyou_mr->ChouhyouTextZokuseiMrs;

            $this->_setDefault($chouhyou_mr, "edit");
//        }
    }

    /**
     * 画面に表示するデータをセットする
     */
    public function _setDefault($chouhyou_mr, $action="edit", $meisai="ChouhyouMrs")
    {
        $setdts = ["id",
            "cd",
            "name",
            "chouhyou_kbn_cd",
            "chouhyou_tool_kbn_cd",
            "hinagata",
            "yousi_size",
            "yousi_houkou",
            "meisai_pp",
            "meisai_yokokan",
            "meisai_tatekan",
            "meisai_lvl",
            "comment",
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
            if (property_exists($chouhyou_mr, $setdt)) {
                $this->tag->setDefault($setdt, $chouhyou_mr->$setdt);
            }
        }
    }

    /**
     * Creates a new chouhyou_mr
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "chouhyou_mrs",
                'action' => 'index'
            ));

            return;
        }

        $chouhyou_mr = new ChouhyouMrs();

        $post_flds = [];
        $post_flds = ["cd",
            "name",
            "chouhyou_kbn_cd",
            "chouhyou_tool_kbn_cd",
            "hinagata",
            "yousi_size",
            "yousi_houkou",
            "meisai_pp",
            "meisai_yokokan",
            "meisai_tatekan",
            "meisai_lvl",
            "comment",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        foreach ($post_flds as $post_fld) {
            $chouhyou_mr->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$chouhyou_mr->save()) {
            foreach ($chouhyou_mr->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "chouhyou_mrs",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("帳票レイアウト名の作成が完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "chouhyou_mrs",
            'action' => 'edit',
            'params' => array($chouhyou_mr->id)
        ));
    }

    /**
     * Saves a chouhyou_mr edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "chouhyou_mrs",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $chouhyou_mr = ChouhyouMrs::findFirstByid($id);

        if (!$chouhyou_mr) {
            $this->flash->error("帳票レイアウト名が見つからなくなりました。" . $id);

            $this->dispatcher->forward(array(
                'controller' => "chouhyou_mrs",
                'action' => 'index'
            ));

            return;
        }

        if ($chouhyou_mr->updated !== $this->request->getPost("updated")) {
            $this->flash->error("他のプロセスから帳票レイアウト名が変更されたため更新を中止しました。"
                . $id . ",uid=" . $chouhyou_mr->kousin_user_id . " tb=" . $chouhyou_mr->updated ." pt=" . $this->request->getPost("updated"));

            $this->dispatcher->forward(array(
                'controller' => "chouhyou_mrs",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

		$post_flds = [
			"cd",
			"name",
			"chouhyou_kbn_cd",
			"chouhyou_tool_kbn_cd",
			"hinagata",
			"yousi_size",
			"yousi_houkou",
			"meisai_pp",
			"meisai_yokokan",
			"meisai_tatekan",
			"meisai_lvl",
			"comment",
			"updated",
		];
        
		$meisai_flds = [
			"id",
			"cd",
			"name",
			"shurui_kbn",
			"kmk_table",
            "sanshou",
            "kmk_cd",
            "yoko_zahyou",
            "tate_zahyou",
            "waku_haba",
            "waku_taka",
            "align",
            "valign",
            "stretch",
            "calign",
            "font_kbn_id",
            "font_style",
            "font_size",
            "inji_houkou",
            "moji_iro",
            "nuri_iro",
            "waku_iro",
            "waku_huto",
            "waku",
            "kmk_shuushoku",
            "suu_minus",
            "suu_comma",
            "suu_zero",
            "suu_shousuuten",
            "suu_percent",
            "suu_yen",
            "suu_seisuuketa",
            "suu_shousuuketa",
			"updated",
		];

		$meisai_nums = [
		];

        $meisai = $this->request->getPost("data");
// echo "<br><br><br>\n<pre>";print_r($meisai);echo "</pre>\n";
		$i = 1;
		$checkcnt = 0;
		$matchary = array();
        foreach ($meisai["zokusei_mrs"] as $zokusei_mr) {
//echo "\n<br>if:".$i.":".$zokusei_mr["id"].":".$zokusei_mr["cd"];
            if ((int)$zokusei_mr["id"] !== 0) {
                $checkcnt++;
                for ($j=0; $j < count($chouhyou_mr->ChouhyouTextZokuseiMrs) && (int)$chouhyou_mr->ChouhyouTextZokuseiMrs[$j]->id !== (int)$zokusei_mr["id"]; $j++) {}
                $matchary[$i] = $j;
                if ((int)$chouhyou_mr->ChouhyouTextZokuseiMrs[$j]->id !== (int)$zokusei_mr["id"] ||
                    $chouhyou_mr->ChouhyouTextZokuseiMrs[$j]->updated !== $zokusei_mr["updated"]) {
                    $this->flash->error("他のプロセスから帳票テキスト属性が変更されたため中止しました。"
                        . $id . ",id=" . $chouhyou_mr->ChouhyouTextZokuseiMrs[$j]->id . ",uid=" . $chouhyou_mr->ChouhyouTextZokuseiMrs[$j]->kousin_user_id
                        . " tb=" . $chouhyou_mr->ChouhyouTextZokuseiMrs[$j]->updated ." pt=" . $zokusei_mr["updated"]);

                    $this->dispatcher->forward(array(
                        'controller' => "chouhyou_mrs",
                        'action' => 'edit',
                        'params' => [$id]
                    ));

                    return;
                }
            }
            $i++;
        }
        if ($checkcnt < count($chouhyou_mr->ChouhyouTextZokuseiMrs)) {
            $this->flash->error("他のプロセスから帳票テキスト属性が追加されたため中止しました。"
                . $id . ",checkcnt=" . $checkcnt . "<" . count($chouhyou_mr->ChouhyouTextZokuseiMrs) ."=count(zokusei_mrs)");

            $this->dispatcher->forward(array(
                'controller' => "chouhyou_mrs",
                'action' => 'edit',
                'params' => [$id]
            ));

            return;
        }


        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        $chg_flg = 0;
        foreach ($post_flds as $post_fld) {
            if ((array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld)) !== $chouhyou_mr->$post_fld) {
                $chg_flg = 1;
                break;
            }
        }
        $meisaicnv = array();
        $chg_flgs = array();
        $i = 1;
        foreach ($meisai["zokusei_mrs"] as $zokusei_mr) {
//echo "\n<br>if:".$i.":".$zokusei_mr["cd"];
            $meisaicnv[$i] = [];
            foreach ($meisai_nums as $meisai_num) {
                $meisaicnv[$i][$meisai_num]=str_replace(',','',$zokusei_mr[$meisai_num]);//カンマ除去
            }
            $chg_flgs[$i] = 0;//変更ないかも
            if ($zokusei_mr["cd"] === "" && (int)$zokusei_mr["id"] !== 0) { // 削除の条件
                $chg_flg = 1;
                $chg_flgs[$i] = 2;//削除
            } else if ((int)$zokusei_mr["id"] === 0) { // echo ($zokusei_mr["id"] === "")?"null":"0";//nullの伝わり方
                    $chg_flg = 1;
                    $chg_flgs[$i] = 1;
            } else if ($zokusei_mr["cd"] !== "") {
                $j = $matchary[$i];
                foreach ($meisai_flds as $meisai_fld) {
                    if ((array_key_exists($meisai_fld, $meisaicnv[$i])?$meisaicnv[$i][$meisai_fld]:$zokusei_mr[$meisai_fld]).'' !== $chouhyou_mr->ChouhyouTextZokuseiMrs[$j]->$meisai_fld) {
                        $chg_flg = 1;
                        $chg_flgs[$i] = 1;
                        break;
                    }
                }
            }
            $i++;
        }
        if ($chg_flg === 0) {
            $this->flash->error("変更がありません。" . $id);

            $this->dispatcher->forward(array(
                "controller" => "chouhyou_mrs",
                "action" => "edit",
                "params" => array($chouhyou_mr->id)
            ));

            return;
        }

        $this->_bakOut($chouhyou_mr);

        foreach ($post_flds as $post_fld) {
            $chouhyou_mr->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }
        $i = 1;
        foreach ($meisai["zokusei_mrs"] as $zokusei_mr) {
//echo "\n<br>".$i.":".$zokusei_mr["cd"].":".$zokusei_mr["id"];
            if ($chg_flgs[$i] === 2) { // 削除とき
                $meisai_ctlr = new ChouhyouTextZokuseiMrsController();
                $meisai_ctlr->deleteAction($zokusei_mr["id"]);
            } else {
                if ((int)$zokusei_mr["id"] !== 0) {
                    $j = $matchary[$i];
                    $ChouhyouTextZokuseiMrs[$j] = $chouhyou_mr->ChouhyouTextZokuseiMrs[$j];
                }
                if ($chg_flgs[$i] === 1 && $zokusei_mr["cd"] !== '') { // 更新なら
                    if ((int)$zokusei_mr["id"] === 0) {
                        $j = $checkcnt++;
                        $ChouhyouTextZokuseiMrs[$j] = new ChouhyouTextZokuseiMrs();
                    }
                    foreach ($meisai_flds as $meisai_fld) {
                        $ChouhyouTextZokuseiMrs[$j]->$meisai_fld = array_key_exists($meisai_fld, $meisaicnv[$i])?$meisaicnv[$i][$meisai_fld]:$zokusei_mr[$meisai_fld]??'';
                        //更新日時や更新者はModelに定義してある
                    }
                }
            }
            $i++;
        }
        $chouhyou_mr->ChouhyouTextZokuseiMrs = $ChouhyouTextZokuseiMrs; // 明細データをドッキング

        if (!$chouhyou_mr->save()) {

            foreach ($chouhyou_mr->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "chouhyou_mrs",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $this->flash->success("帳票レイアウト名の情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "chouhyou_mrs",
            'action' => 'edit',
            'params' => array($chouhyou_mr->id)
        ));
    }

    /**
     * Deletes a chouhyou_mr
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $chouhyou_mr = ChouhyouMrs::findFirstByid($id);
        if (!$chouhyou_mr) {
            $this->flash->error("帳票レイアウト名が見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "chouhyou_mrs",
                'action' => 'index'
            ));

            return;
        }
        foreach ($chouhyou_mr->ChouhyouTextZokuseiMrs as $zokusei_mr) {
            $zokusei_ctlr = new ChouhyouTextZokuseiMrsController();
            $zokusei_ctlr->deleteAction($zokusei_mr->id);
        }

        $this->_bakOut($chouhyou_mr, 1);

        if (!$chouhyou_mr->delete()) {

            foreach ($chouhyou_mr->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "chouhyou_mrs",
                'action' => 'search'
            ));

            return;
        }

        $this->flash->success("帳票レイアウト名の削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "chouhyou_mrs",
            'action' => "index"
        ));
    }

    /**
     * Back Out a chouhyou_mr
     *
     * @param string $chouhyou_mr, $dlt_flg
     */
    public function _bakOut($chouhyou_mr, $dlt_flg = 0)
    {

        $bak_chouhyou_mr = new BakChouhyouMrs();
        foreach ($chouhyou_mr as $fld => $value) {
            $bak_chouhyou_mr->$fld = $chouhyou_mr->$fld;
        }
        $bak_chouhyou_mr->id = NULL;
        $bak_chouhyou_mr->id_moto = $chouhyou_mr->id;
        $bak_chouhyou_mr->hikae_dltflg = $dlt_flg;
        $bak_chouhyou_mr->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_chouhyou_mr->hikae_nichiji = date("Y-m-d H:i:s");
        if (!$bak_chouhyou_mr->save()) {
            foreach ($bak_chouhyou_mr->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
    }

	/**
	 * 伝票印刷実行モーダル
	 *
	 * @param string $chouhyou_kbn_cd
	 */
	public function modalAction($denpyou_mr_cd)
	{
		$chouhyou_kbn = ChouhyouKbns::findfirst([
			"conditions"=>"denpyou_mr_cd = ?1",
			"order"=>"jun",
			"bind"=>[
				1=>$denpyou_mr_cd
			]
		]);
		$this->tag->setDefault("denpyou_mr_cd", $denpyou_mr_cd);
		$this->tag->setDefault("chouhyou_kbn_cd", $chouhyou_kbn->cd);
	}

    /**
     * 連続印刷フォーム
     *
     * @param string $id
     */
    public function renzokuAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "chouhyou_mrs",
                'action' => 'index'
            ));
            $id = $this->request->getPost("id"); // 帳票区分：6=売上伝票 とか 請求明細書 とか
            $chouhyou_mr = ChouhyouMrs::findFirstByid($id);
            if (!$chouhyou_mr) {
                $this->flash->error("帳票レイアウト名が見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "chouhyou_mrs",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->title = $chouhyou_mr->name;
            $this->view->chouhyou_kbn_cd = $this->request->getPost("chouhyou_kbn_cd"); // 帳票区分：売上伝票 とか 請求明細書 とか
            $this->tag->setDefault("id", $id);
            $this->tag->setDefault("nyuushokusha_flg", 0);
            $this->tag->setDefault("uriagebi_from", date("Y-mm-dd"));
            $this->tag->setDefault("uriagebi_to", date("Y-mm-dd"));
            $this->tag->setDefault("denpyou_cd_from", 0);
            $this->tag->setDefault("denpyou_cd_to", 99999999);

            return;
        }
	}

    /**
     * 連続印刷実行
     *
     * @param string $id
     */
    public function renzokugoAction()
    {
		$this->view->disable();

// echo "\n<br>chouhyou_mr_id = ".$this->request->getPost('chouhyou_mr_id');
//echo "\n<br><pre>";print_r($this->request->getPost('data'));echo "</pre>\n";

        if (!$this->request->isPost()) {
            echo "is not Post ! ";
        //    return;
        }

		$chouhyou_mr_id = $this->request->getPost('id');
		$data = $this->request->getPost('data');

        $chouhyou_mr = ChouhyouMrs::findFirstByid($chouhyou_mr_id);
        if (!$chouhyou_mr) {
            $this->flash->error("帳票idが見つからなくなりました。id=$frmid");

            $this->dispatcher->forward(array(
                'controller' => "uriage_dts",
                'action' => 'edit',
                'params' => [$id]
            ));

            return;
        }

//echo "\n<br>".$chouhyou_mr_id;
		if ($chouhyou_mr->ChouhyouToolKbns->name == 'EXCEL') {
echo "EXCELでの連続印刷が指定されましたが、現在この機能はありません。ブラウザの戻る機能と再試行でやり直してください。";
		} else if ($chouhyou_mr->ChouhyouToolKbns->name == 'PDF') {
	        $uriage_ctlr = new UriageDtsController();
	    	$path = $uriage_ctlr->renzoku_denpyou_pdf($data['uriage_dts'], $chouhyou_mr);
	    	$flnames = explode('/',$path);
	//echo "\n<br>".$path;
	//echo "\n<br>".$flnames[count($flnames)-1];

			// PDFファイルをクライアントに出力 ----------------------------
			$response = new \Phalcon\Http\Response(); // Redirect output to a client's web browser (PDF) 
			$response->setHeader('Content-Type', 'application/pdf'); 
			$response->setHeader('Content-Disposition', 'attachment;filename="' . $flnames[count($flnames)-1] . '"'); 
			$response->setHeader('Cache-Control', 'max-age=0');
			$response->setHeader('Cache-Control', 'max-age=1'); // If you're serving to IE 9, then the following may be needed 
			$response->setContent(file_get_contents($path)); //Set the content of the response 
			unlink($path); // delete temp file 
			return $response; //Return the response 
		}
	}

    /**
     * 連続印刷実行
     *
     * @param string $id
     */
    public function ajaxRenzokugoAction()
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

		$chouhyou_mr_id = $this->request->getPost('chouhyou_mr_id');
		$uriage_dt_ids = $this->request->getPost('uriage_dt_ids');

        $chouhyou_mr = ChouhyouMrs::findFirstByid($chouhyou_mr_id);
        if (!$chouhyou_mr) {
            $this->flash->error("帳票idが見つからなくなりました。id=$frmid");

            $this->dispatcher->forward(array(
                'controller' => "uriage_dts",
                'action' => 'edit',
                'params' => [$id]
            ));

            return;
        }

        $uriage_ctlr = new UriageDtsController();
    	$uriage_ctlr->renzoku_denpyou_pdf($uriage_dt_ids, $chouhyou_mr);

	    $resData = array();

	    //Set the content of the response
	    $response->setContent(json_encode($resData));

	    //Return the response
//	    return $response;
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

	    $chouhyou_mrs = ChouhyouMrs::find(array(
//	        'columns' => array('cd, name'), 全項目とする
	        'order' => 'id',
	        'conditions' => 'chouhyou_kbn_cd = ?1',
	        'bind' => array(1 => $this->request->getPost('chouhyou_kbn_cd'))
	    ));
        $res_flds = [
            "id",
            "name",
        ];
	    $resData = array();
	    foreach ($chouhyou_mrs as $chouhyou_mr) {
	        $resAdata = array();
	        foreach ($res_flds as $res_fld) {
	            $resAdata[$res_fld] = $chouhyou_mr->$res_fld;
	        }
	        $resData[] = $resAdata;//array('cd' => $chouhyou_mr->cd, 'name' => $chouhyou_mr->name);
	    }

	    //Set the content of the response
	    $response->setContent(json_encode($resData));

	    //Return the response
	    return $response;
	}

}
