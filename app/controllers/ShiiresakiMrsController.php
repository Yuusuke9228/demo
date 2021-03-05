<?php

class ShiiresakiMrsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
		ControllerBase::indexCd("ShiiresakiMrs", "仕入先台帳");
    }

    /**
     * モーダル
     */
    public function modalAction()
    {
		ControllerBase::indexCd("ShiiresakiMrs", "仕入先台帳");
    }

    /**
     * Searches for shiiresaki_mrs
     */
    public function searchAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * 修正画面から「次へ」ボタンを押したら次のコードの修正画面になる。
     */
    public function nextAction($id)
    {
		ControllerBase::nextCd($id, "shiiresaki_mrs", "ShiiresakiMrs", "仕入先台帳");
    }

    /**
     * 修正画面から「前へ」ボタンを押したら前のコードの修正画面になる。
     */
    public function prevAction($id = 0)
    {
		ControllerBase::prevCd($id, "shiiresaki_mrs", "ShiiresakiMrs", "仕入先台帳");
    }

    /**
     * Displays the creation form
     */
    public function newAction($id=null, $dataname="Shiiresaki")
    {

        if ($id) {
        	$nameMrs = $dataname."Mrs";
            $shiiresaki_mr = $nameMrs::findFirstByid($id);
            if (!$shiiresaki_mr) {
                $this->flash->error($dataname."台帳が見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "shiiresaki_mrs",
                    'action' => 'index'
                ));

                return;
            }
            $this->_setDefault($shiiresaki_mr, "new", $dataname);
            $this->tag->setDefault("id", null);
            $this->tag->setDefault("cd", "?".$shiiresaki_mr->cd);
            $this->tag->setDefault("kake_zandaka", 0);
            $this->tag->setDefault("sakusei_user_id", null);
            $this->tag->setDefault("created", null);
            $this->tag->setDefault("kousin_user_id", null);
            $this->tag->setDefault("updated", null);
        } else {
            $this->tag->setDefault("torihiki_kbn_cd", 1);
            $this->tag->setDefault("tanka_shurui_kbn_cd", 7);
            $this->tag->setDefault("zei_hasuu_shori_kbn_cd", 1);
            $this->tag->setDefault("gaku_hasuu_shori_kbn_cd", 1);
            $this->tag->setDefault("zei_tenka_kbn_cd", 10);
            $this->tag->setDefault("sanshou_hyouji", 1);
        }
		$this->tag->setDefault("kouza_kankei_kbn_cd", 3);

    }

    /**
     * Edits a shiiresaki_mr
     *
     * @param string $id
     */
    public function editAction($id)
    {
//        if (!$this->request->isPost()) {

            $shiiresaki_mr = ShiiresakiMrs::findFirstByid($id);
            if (!$shiiresaki_mr) {
                $this->flash->error("仕入先マスタが見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "shiiresaki_mrs",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->id = $shiiresaki_mr->id;

            $this->_setDefault($shiiresaki_mr, "edit");
//        }
    }


    /**
     * 画面に表示するデータをセットする
     */
    public function _setDefault($shiiresaki_mr, $action="edit", $meisai="Shiiresaki")
    {
		$setdts = [
			"id",
			"cd",
			"name",
			"kana",
			"ryakushou",
			"yuubin_bangou",
			"juusho1",
			"juusho2",
			"bushomei",
			"yakushoku",
			"gotantousha",
			"keishou",
			"tel",
			"fax",
			"email",
			"homepage",
			"tantou_mr_cd",
			"torihiki_kbn_cd",
			"tanka_shurui_kbn_cd",
			"kakeritu",
			"tokuisaki_mr_cd",
			"shimegrp_kbn_cd",
			"gaku_hasuu_shori_kbn_cd",
			"zei_hasuu_shori_kbn_cd",
			"zei_tenka_kbn_cd",
			"kake_zandaka",
			"harai_houhou_kbn_cd",
			"harai2_houhou_kbn_cd",
			"yoshin_gendogaku",
			"wakekata",
			"harai_saikuru_kbn_cd",
			"haraibi",
			"tegata_sight",
			"ginkou_bangou",
			"ginkou_mei",
			"ginkoumei_kana",
			"shiten_bangou",
			"honshiten_mei",
			"shitenmei_kana",
			"kouza_kankei_kbn_cd",
			"yokin_shurui_kbn_cd",
			"kouza_bangou",
			"kouza_meigi",
			"kouza_meigi_kana",
			"kokyaku_code1",
			"kokyaku_code2",
			"shiiresaki_bunrui1_kbn_cd",
			"shiiresaki_bunrui2_kbn_cd",
			"shiiresaki_bunrui3_kbn_cd",
			"shiiresaki_bunrui4_kbn_cd",
			"shiiresaki_bunrui5_kbn_cd",
			"sanshou_hyouji",
			"memo",
			"id_moto",
			"hikae_dltflg",
			"hikae_user_id",
			"hikae_nichiji",
			"sakusei_user_id",
			"created",
			"kousin_user_id",
			"updated"
		];
		foreach ($setdts as $setdt) {
			if (property_exists($shiiresaki_mr, $setdt)) {
				$this->tag->setDefault($setdt, $shiiresaki_mr->$setdt);
			}
			if (property_exists($shiiresaki_mr, "kake_zandaka") && $meisai=="Shiiresaki") {
				$kaikake_zandaka = $shiiresaki_mr->kake_zandaka
								+ $this->shiire_ruikeigaku($shiiresaki_mr->cd)
								- $this->shukkin_ruikeigaku($shiiresaki_mr->cd); //ShiiresakiMrs->shiiresaki_mr_cdは無い Nishiyama
				$this->tag->setDefault("kaikake_zandaka",  number_format($kaikake_zandaka));
			}
		}
        if (property_exists($shiiresaki_mr, "tokuisaki_mr_cd")) {
            $this->tag->setDefault("tokuisaki_mr_name", $shiiresaki_mr->tokuisaki_mr_cd == '' ? '' : $shiiresaki_mr->TokuisakiMrs->name);
        }
	}

    /**
     * Creates a new shiiresaki_mr
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "shiiresaki_mrs",
                'action' => 'index'
            ));

            return;
        }

        $shiiresaki_mr = new ShiiresakiMrs();
        $post_flds = [
			"cd",
			"name",
			"kana",
			"ryakushou",
			"yuubin_bangou",
			"juusho1",
			"juusho2",
			"bushomei",
			"yakushoku",
			"gotantousha",
			"keishou",
			"tel",
			"fax",
			"email",
			"homepage",
			"tantou_mr_cd",
			"torihiki_kbn_cd",
			"tanka_shurui_kbn_cd",
			"kakeritu",
			"tokuisaki_mr_cd",
			"shimegrp_kbn_cd",
			"gaku_hasuu_shori_kbn_cd",
			"zei_hasuu_shori_kbn_cd",
			"zei_tenka_kbn_cd",
			"kake_zandaka",
			"harai_houhou_kbn_cd",
			"harai2_houhou_kbn_cd",
			"yoshin_gendogaku",
			"wakekata",
			"harai_saikuru_kbn_cd",
			"haraibi",
			"tegata_sight",
			"ginkou_bangou",
			"ginkou_mei",
			"ginkoumei_kana",
			"shiten_bangou",
			"honshiten_mei",
			"shitenmei_kana",
			"kouza_kankei",
			"yokin_shu",
			"kouza_bangou",
			"kouza_meigi",
			"kouza_meigi_kana",
			"kokyaku_code1",
			"kokyaku_code2",
			"shiiresaki_bunrui1_kbn_cd",
			"shiiresaki_bunrui2_kbn_cd",
			"shiiresaki_bunrui3_kbn_cd",
			"shiiresaki_bunrui4_kbn_cd",
			"shiiresaki_bunrui5_kbn_cd",
			"sanshou_hyouji",
			"memo","updated",
			];
        foreach ($post_flds as $post_fld) {
            $shiiresaki_mr->$post_fld = $this->request->getPost($post_fld);
        }


        if (!$shiiresaki_mr->save()) {
            foreach ($shiiresaki_mr->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "shiiresaki_mrs",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("仕入先マスタの作成が完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "shiiresaki_mrs",
            'action' => 'edit',
            'params' => array($shiiresaki_mr->id)
        ));
    }

    /**
     * Saves a shiiresaki_mr edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "shiiresaki_mrs",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $shiiresaki_mr = ShiiresakiMrs::findFirstByid($id);

        if (!$shiiresaki_mr) {
            $this->flash->error("仕入先マスタが見つからなくなりました。" . $id);

            $this->dispatcher->forward(array(
                'controller' => "shiiresaki_mrs",
                'action' => 'index'
            ));

            return;
        }

        $post_flds = [
			"cd",
			"name",
			"kana",
			"ryakushou",
			"yuubin_bangou",
			"juusho1",
			"juusho2",
			"bushomei",
			"yakushoku",
			"gotantousha",
			"keishou",
			"tel",
			"fax",
			"email",
			"homepage",
			"tantou_mr_cd",
			"torihiki_kbn_cd",
			"tanka_shurui_kbn_cd",
			"kakeritu",
			"tokuisaki_mr_cd",
			"shimegrp_kbn_cd",
			"gaku_hasuu_shori_kbn_cd",
			"zei_hasuu_shori_kbn_cd",
			"zei_tenka_kbn_cd",
			"kake_zandaka",
			"harai_houhou_kbn_cd",
			"harai2_houhou_kbn_cd",
			"yoshin_gendogaku",
			"wakekata",
			"harai_saikuru_kbn_cd",
			"haraibi",
			"tegata_sight",
			"ginkou_bangou",
			"ginkou_mei",
			"ginkoumei_kana",
			"shiten_bangou",
			"honshiten_mei",
			"shitenmei_kana",
			"kouza_kankei_kbn_cd",
			"yokin_shurui_kbn_cd",
			"kouza_bangou",
			"kouza_meigi",
			"kouza_meigi_kana",
			"kokyaku_code1",
			"kokyaku_code2",
			"shiiresaki_bunrui1_kbn_cd",
			"shiiresaki_bunrui2_kbn_cd",
			"shiiresaki_bunrui3_kbn_cd",
			"shiiresaki_bunrui4_kbn_cd",
			"shiiresaki_bunrui5_kbn_cd",
			"sanshou_hyouji",
			"memo",
			"updated",
			];
        $chg_flg = 0;
        foreach ($post_flds as $post_fld) {
            if ($shiiresaki_mr->$post_fld != $this->request->getPost($post_fld)) {$chg_flg = 1; break;}
        }
        if ($chg_flg === 0) {
            $this->flash->error("変更がありません。" . $id);

            $this->dispatcher->forward(array(
                "controller" => "shiiresaki_mrs",
                "action" => "edit",
                "params" => array($shiiresaki_mr->id)
            ));

            return;
        }

        $this->_bakOut($shiiresaki_mr);

        foreach ($post_flds as $post_fld) {
            if ($shiiresaki_mr->$post_fld != $this->request->getPost($post_fld)) {
                $shiiresaki_mr->$post_fld = $this->request->getPost($post_fld);
            }
        }


        if (!$shiiresaki_mr->save()) {

            foreach ($shiiresaki_mr->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "shiiresaki_mrs",
                'action' => 'edit',
                'params' => array($shiiresaki_mr->id)
            ));

            return;
        }

        $this->flash->success("仕入先マスタの情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "shiiresaki_mrs",
            'action' => 'edit',
            'params' => array($id)
        ));
    }

    /**
     * Deletes a shiiresaki_mr
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $shiiresaki_mr = ShiiresakiMrs::findFirstByid($id);
        if (!$shiiresaki_mr) {
            $this->flash->error("仕入先マスタが見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "shiiresaki_mrs",
                'action' => 'index'
            ));

            return;
        }

        if (!$shiiresaki_mr->delete()) {

            foreach ($shiiresaki_mr->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "shiiresaki_mrs",
                'action' => 'search'
            ));

            return;
        }

        $this->_bakOut($shiiresaki_mr, 1);

        $this->flash->success("仕入先マスタの削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "shiiresaki_mrs",
            'action' => "index"
        ));
    }

    /**
     * Back Out a shiiresaki_mr
     *
     * @param string $shiiresaki_mr, $dlt_flg
     */
    public function _bakOut($shiiresaki_mr, $dlt_flg = 0)
    {

        $bak_shiiresaki_mr = new BakShiiresakiMrs();
        foreach ($shiiresaki_mr as $fld => $value) {
            $bak_shiiresaki_mr->$fld = $value;
        }
        $bak_shiiresaki_mr->id = NULL;
        $bak_shiiresaki_mr->id_moto = $shiiresaki_mr->id;
        $bak_shiiresaki_mr->hikae_dltflg = $dlt_flg;
        $bak_shiiresaki_mr->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_shiiresaki_mr->hikae_nichiji = date("Y-m-d H:i:s");
        if (!$bak_shiiresaki_mr->save()) {
            foreach ($bak_shiiresaki_mr->getMessages() as $message) {
                $this->flash->error($message . '--bak');
            }
        }
    }

    /*
     * カナを取得 Add By Nishiyama 2019-10-23
     */
    public function ajaxGetHuriganaAction()
    {
        $this->view->disable();
        $response = new \Phalcon\Http\Response();
        if (!$this->request->isAjax()) echo "Request is not Ajax!";
        if (!$this->request->isPost()) echo "Request is not Post!";
        $mecab = \Phalcon\DI::getDefault()->get('mecab');
        $input_data = $this->request->getPost('input');
        $res = $mecab->mecab_parse($input_data);
        $yomi = $mecab->return_kana($res);
        $res_data = ['kana' => $yomi];
        $response->setContent(json_encode($res_data));
        return $response;
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

	    $shiiresaki_mrs = ShiiresakiMrs::find(array(
//	        'columns' => array('cd, name'), 全項目とする
	        'order' => 'cd',
	        'conditions' => ' cd LIKE ?1 ',
	        'bind' => array(1 => $this->request->getPost('cd').'%')
	    ));
        $res_flds = ["id","cd","name","ryakushou","bushomei","yakushoku","gotantousha","keishou","tantou_mr_cd","torihiki_kbn_cd"
        		,"tanka_shurui_kbn_cd","kakeritu","tokuisaki_mr_cd","shimegrp_kbn_cd","gaku_hasuu_shori_kbn_cd"
        		,"zei_hasuu_shori_kbn_cd","zei_tenka_kbn_cd","kake_zandaka","harai_houhou_kbn_cd"
        		,"harai_saikuru_kbn_cd","haraibi","tesuuryou_hutan_kbn_cd","memo",];
	    $resData = array();
	    foreach ($shiiresaki_mrs as $shiiresaki_mr) {
	        $resAdata = array();
	        foreach ($res_flds as $res_fld) {
	            $resAdata[$res_fld] = $shiiresaki_mr->$res_fld;
	        }
	        $resAdata["tanka_shurui_kbn_name"] = $shiiresaki_mr->TankaShuruiKbns->name;
	        $resAdata["tanka_shurui_kbn_koumokumei"] = $shiiresaki_mr->TankaShuruiKbns->koumokumei;
	        $resAdata["simezumibi"] = count($shiiresaki_mr->ShiiresakiSimeDts)?$shiiresaki_mr->ShiiresakiSimeDts[0]->sime_hiduke:"0000-00-00";// 最終締日
	        $resData[] = $resAdata;//array('cd' => $shiiresaki_mr->cd, 'name' => $shiiresaki_mr->name);
	    }

        if ($shiiresaki_mrs && $tougetu = $this->request->getPost('tougetu')) { // 当月がある場合、各累計を集計
            $tougetu = substr($this->request->getPost('tougetu'), 0, 7);
            $shiiresaki_mr_cd = $shiiresaki_mrs[0]->cd;
            // 仕入額累計
            $resData[0]["shiire_ruikeigaku"] = $this->shiire_ruikeigaku($shiiresaki_mr_cd);
            // 出金額累計
            $resData[0]["shukkin_ruikeigaku"] = $this->shukkin_ruikeigaku($shiiresaki_mr_cd);
            // 出金額当月計
            $resData[0]["shukkin_tougetugaku"] = $this->shukkin_ruikeigaku($shiiresaki_mr_cd, $tougetu);
        }

	    //Set the content of the response
	    $response->setContent(json_encode($resData));

	    //Return the response
	    return $response;
	}

	public function name_ajaxGetAction()
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

	    $shiiresaki_mrs = ShiiresakiMrs::find(array(
//	        'columns' => array('cd, name'), 全項目とする
	        'order' => 'cd',
	        'conditions' => ' name LIKE ?1 ',
	        'bind' => array(1 => '%'.$this->request->getPost('name').'%'),
	        'limit' => 20
	    ));
        $res_flds = ["id","cd","name","ryakushou","bushomei","yakushoku","gotantousha","keishou","tantou_mr_cd","torihiki_kbn_cd"
        		,"tanka_shurui_kbn_cd","kakeritu","tokuisaki_mr_cd","shimegrp_kbn_cd","gaku_hasuu_shori_kbn_cd"
        		,"zei_hasuu_shori_kbn_cd","zei_tenka_kbn_cd","kake_zandaka","harai_houhou_kbn_cd"
        		,"harai_saikuru_kbn_cd","haraibi","tesuuryou_hutan_kbn_cd","memo",];
	    $resData = array();
	    foreach ($shiiresaki_mrs as $shiiresaki_mr) {
	        $resAdata = array();
	        foreach ($res_flds as $res_fld) {
	            $resAdata[$res_fld] = $shiiresaki_mr->$res_fld;
	        }
	        $resAdata["tanka_shurui_kbn_name"] = $shiiresaki_mr->TankaShuruiKbns->name;
	        $resAdata["tanka_shurui_kbn_koumokumei"] = $shiiresaki_mr->TankaShuruiKbns->koumokumei;
	        $resData[] = $resAdata;//array('cd' => $shiiresaki_mr->cd, 'name' => $shiiresaki_mr->name);
	    }

	    //Set the content of the response
	    $response->setContent(json_encode($resData));

	    //Return the response
	    return $response;
	}

	public function shiire_ruikeigaku($shiiresaki_mr_cd) // 仕入額累計
	{
		$criteria = $this->modelsManager->createBuilder();
		$criteria->addFrom("ShiireMeisaiDts","t0");
		$criteria->columns([
			"sum(t0.zeinukigaku + t0.zeigaku) as ruikeigaku"
		]);
		$criteria->leftJoin("ShiireDts","t1.id = t0.shiire_dt_id","t1");
		$criteria->where("t1.shiiresaki_mr_cd = ?0",[0=>$shiiresaki_mr_cd]);
		$shiire_rows = $criteria->getQuery()->execute();
		$shiire_ruikeigaku = $shiire_rows?$shiire_rows[0]->ruikeigaku:0;
		return $shiire_ruikeigaku;
	}

	public function shukkin_ruikeigaku($shiiresaki_mr_cd, $tougetu=null) // 支払額累計、当月パラメタがある時、当月計
	{
		$criteria = $this->modelsManager->createBuilder();
		$criteria->addFrom("ShukkinMeisaiDts","t0");
		$criteria->columns([
			"sum(t0.kingaku) as tougetugaku"
		]);
		$criteria->leftJoin("ShukkinDts","t1.id = t0.shukkin_dt_id","t1");
		$criteria->where("t1.shiiresaki_mr_cd = ?0",[0=>$shiiresaki_mr_cd]);
		if ($tougetu) {
			$criteria->andWhere("DATE_FORMAT(t1.shukkinbi, '%Y-%m') = ?1",[1=>$tougetu]);
		}
		$shukkin_rows = $criteria->getQuery()->execute();
		$shukkin_tougetugaku = $shukkin_rows?$shukkin_rows[0]->tougetugaku:0;
		return $shukkin_tougetugaku;
	}

    /**
     * 元帳 action
     */
	public function motochouAction()
	{
        $post_flds = [
			'shiiresaki_mr_cd',
			'hyouji_flg',
			'shouhin_mr_cd',
			'to_shouhin_mr_cd',
			'shouhin_tekiyou',
			'kikan_sitei_kbn_cd',
			'kikan_from',
			'kikan_to',
            'to_excel',
		];
		$setdts = []; // データーの中継変数
		$thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
		foreach ($post_flds as $post_fld) {
			$setdts[$post_fld] = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
		}
		$setdts['hyouji_flg'] = $setdts['hyouji_flg']??3;
		$setdts['kikan_sitei_kbn_cd'] = $setdts['kikan_sitei_kbn_cd']??1213; // 任意の期間
		$setdts['kikan_from'] = $setdts['kikan_from']??'2019-01-01'; // ($setdts['hyouji_flg']==0?'2016-01-01':date('Y-m-01', strtotime(date('Y-m-1') . '-1 month')));
		$setdts['kikan_to'] = $setdts['kikan_to']??date('Y-m-t');
		if ($setdts['shiiresaki_mr_cd']) {
			$shiiresaki_mr = ShiiresakiMrs::findFirst(["conditions"=>"cd = ?1", "bind"=>[1=>$setdts['shiiresaki_mr_cd']]]);
			$setdts['shiiresaki_mr_name'] = $shiiresaki_mr->name??"？見つかりません！";
		} else {$setdts['shiiresaki_mr_name'] = "";}

		foreach ($setdts as $fld => $setdt) { // postデータをそのまま返す。
			$this->tag->setDefault($fld, $setdt);
		}
		$this->view->setdts = $setdts;
		$this->view->shiiresaki_mr = $shiiresaki_mr;

		$criteria = $this->modelsManager->createBuilder();
		$criteria->addFrom("ShiireMeisaiDts","t0");
		$criteria->columns([
			"t0.id as id",
			"t0.shiire_dt_id as shiire_dt_id",
			"t1.shiiresaki_mr_cd as shiiresaki_cd",
			"t1.shiirebi as denpyoubi",
			"t1.cd as denpyou_bangou",
			"t1.torihiki_kbn_cd as torihiki_kbn_cd",
			"t5.shiire_name as torihiki_kbn_name",
			"t0.utiwake_kbn_cd as utiwake_kbn_cd",
			"t6.name as utiwake_kbn_name",
			"t0.shouhin_mr_cd as shouhin_mr_cd",
			"t0.tekiyou",
			"t0.zeiritu_mr_cd as zeiritu_mr_cd",
			"t1.zei_tenka_kbn_cd as zei_tenka_kbn_cd",
			"t9.name as zei_tenka_kbn_name",
			"concat(t7.ryakushou,t7.zeiritu,'%') as zeiritu_mr_name",
			"t0.tanni_mr_cd as tanni_mr_cd",
			"if(t0.tanka_kbn=1,t81.name,t82.name) as tanni_mr_name",
			"if(t0.tanka_kbn=1,t0.suuryou1,t0.suuryou2) as suuryou",
			"t0.tanka as tanka",
			"t0.zeinukigaku as zeinukigaku",
			"t0.zeigaku as zeigaku",
			"ifnull(t4.kesikomi_gaku, 0) as kesikomi_gaku",
            "t4.id as kesi_id",
			"t0.bikou as bikou",
            "t1.shimekiri_flg as shimekiri_flg",
		]);
		$criteria->leftJoin("ShiireDts","t1.id = t0.shiire_dt_id","t1");
//		$criteria->leftJoin("ShiiresakiMrs", "t2.cd = t1.shiiresaki_mr_cd","t2");
		$criteria->leftJoin("ShukkinKesikomiDts", "t4.shiire_meisai_dt_id = t0.id","t4");
		$criteria->leftJoin("TorihikiKbns", "t5.cd = t1.torihiki_kbn_cd","t5");
		$criteria->leftJoin("UtiwakeKbns", "t6.cd = t0.utiwake_kbn_cd","t6");
		$criteria->leftJoin("ZeirituMrs", "t7.cd = t0.zeiritu_mr_cd","t7");
		$criteria->leftJoin("TanniMrs", "t81.cd = t0.tanni_mr1_cd","t81");
		$criteria->leftJoin("TanniMrs", "t82.cd = t0.tanni_mr2_cd","t82");
		$criteria->leftJoin("ZeitenkaKbns", "t9.cd = t1.zei_tenka_kbn_cd","t9");
		$criteria->orderBy("shiirebi, t1.cd, t0.cd");
		$criteria->where("t1.shiiresaki_mr_cd = ?0",[0=>$setdts["shiiresaki_mr_cd"]]);
		if ($setdts["shouhin_mr_cd"]) {
			$criteria->andWhere("t0.shouhin_mr_cd LIKE ?2",[2=>$setdts["shouhin_mr_cd"]."%"]);
		}
		if ($setdts["to_shouhin_mr_cd"]) {
			$criteria->andWhere("t0.shouhin_mr_cd <= ?3",[3=>$setdts["to_shouhin_mr_cd"]]);
		}
		if ($setdts["shouhin_tekiyou"]) {
			$criteria->andWhere("t0.tekiyou LIKE ?4",[4=>"%".$setdts["shouhin_tekiyou"]."%"]);
		}
		$criteria->andWhere('t0.utiwake_kbn_cd < 15');
        $criteria->andWhere("t6.yayoi_kbn IS NOT NULL");
/*
echo '<pre>';
var_dump ($criteria);
echo '</pre>';
*/
		$shiire_rows = $criteria->getQuery()->execute();
		if (count($shiire_rows) == 0) {
			$this->flash->notice("検索の結果、仕入伝票は０件でした。");
		}
		$this->view->shiire_rows = $shiire_rows;

		$criteria = $this->modelsManager->createBuilder();
		$criteria->addFrom("ShukkinMeisaiDts","t0");
		$criteria->columns([
			"t0.shukkin_dt_id as shukkin_dt_id",
			"t1.shiiresaki_mr_cd as shiiresaki_cd",
			"t1.shukkinbi as denpyoubi",
			"t1.cd as denpyou_bangou",
			"t0.shiharai_kbn_cd as shiharai_kbn_cd",
			"t0.name as tekiyou",
			"t0.tegata_kijitu as tegata_kijitu",
			"t0.kingaku as kingaku",
			"t1.zenkai_kesikomi_gaku as zenkai_kesikomi_gaku",
			"t0.bikou as bikou",
		]);
		$criteria->leftJoin("ShukkinDts","t1.id = t0.shukkin_dt_id","t1");
		$criteria->orderBy("t1.shukkinbi, t1.cd, t0.cd");
		$criteria->where("t1.shiiresaki_mr_cd = ?0",[0=>$setdts["shiiresaki_mr_cd"]]);
		$shukkin_rows = $criteria->getQuery()->execute();
		$this->view->shukkin_rows = $shukkin_rows;
//echo "\n<pre>";print_r($shukkin_rows);echo "</pre>";
        if ($setdts['shiiresaki_mr_cd'] && $setdts['to_excel']) { // EXCEL出力
        	$this->view->disable();
        	return $this->motochou2xls($shiire_rows, $shukkin_rows, $setdts, $shiiresaki_mr);
        }
    }


/**
 * 元帳をエクセル出力する。
**/

	private function motochou2xls($shiire_rows = null, $shukkin_rows = null, $setdts = null, $seikyuusaki_mr = null) {
		$count1_rows = count($shiire_rows);
		$count2_rows = count($shukkin_rows);
		$count_rows = $count1_rows + $count2_rows;
		$shiiregaku = $shiiresaki_mr->kake_zandaka;
		for ($i1 = 0; $i1 < $count1_rows && $shiire_rows[$i1]["denpyoubi"] < $setdts["kikan_from"]; $i1++) {
			$shiiregaku += $shiire_rows[$i1]["zeinukigaku"]+$shiire_rows[$i1]["zeigaku"];
		}
		$shukkingaku = 0;
		for ($i2 = 0; $i2 < $count2_rows && $shukkin_rows[$i2]["denpyoubi"] < $setdts["kikan_from"]; $i2++) {
			$shukkingaku += $shukkin_rows[$i2]["kingaku"];
		}
		$zandaka = $shiiregaku - $shukkingaku;
		$shiiregaku = 0;
		for ($i1a = $i1; $i1a < $count1_rows && $shiire_rows[$i1a]["denpyoubi"] <= $setdts["kikan_to"]; $i1a++) {
			$shiiregaku += $shiire_rows[$i1a]["zeinukigaku"]+$shiire_rows[$i1a]["zeigaku"];
		}
		$shukkingaku = 0;
		for ($i2a = $i2; $i2a < $count2_rows && $shukkin_rows[$i2a]["denpyoubi"] <= $setdts["kikan_to"]; $i2a++) {
			$shukkingaku += $shukkin_rows[$i2a]["kingaku"];
		}
		$count1_rows = $i1a;
		$count2_rows = $i2a;
		$count_rows = $count1_rows + $count2_rows;
		$kesi_txt1 = ["","一部消込","消込済"];
		// Excel出力用ライブラリ
		include __DIR__ . '/../vendor/PHPExcel/Classes/PHPExcel.php';
		include __DIR__ . '/../vendor/PHPExcel/Classes/PHPExcel/Writer/Excel5.php';
	//		include __DIR__ . '/../vendor/PHPExcel/Classes/PHPExcel/Writer/Excel2007.php';
		include __DIR__ . '/../vendor/PHPExcel/Classes/PHPExcel/IOFactory.php'; //Include PHPExcel_IOFactory

		//PHPExcelオブジェクトの作成
		//新規の場合
		//$PHPExcel = new PHPExcel();

		//テンプレートの読み込み
		//PHPExcel_Settings::setZipClass(PHPExcel_Settings::PCLZIP);
		$objReader = PHPExcel_IOFactory::createReader('Excel5');
		$objReader->setIncludeCharts(TRUE);
		//テンプレートファイルパス
		$temp_dir = __DIR__ . '/temp/'; // テンプレート
		$temp_path = $temp_dir . 'shi_mot.xls';
		$PHPExcel = $objReader->load($temp_path);

		//シートの設定
		$PHPExcel->setActiveSheetIndex(0);  // 0は最初のシート
		$sheet = $PHPExcel->getActiveSheet();
		$gyou = 6;
		$i0 = $gyou - $i1 - $i2; // 明細は6行目スタート
		$sheet->setCellValueByColumnAndRow(6, 2, $shiiresaki_mr->cd);
		$sheet->setCellValueByColumnAndRow(7, 2, $shiiresaki_mr->name);
		$sheet->setCellValueByColumnAndRow(7, 2, $shiiresaki_mr->name);
		$sheet->setCellValueByColumnAndRow(0, $gyou - 4, $setdts["kikan_from"]);
		$sheet->setCellValueByColumnAndRow(0, $gyou - 3, $setdts["kikan_to"]);
		$sheet->setCellValueByColumnAndRow(6, $gyou - 3, $setdts["shouhin_mr_cd"]);
		$sheet->setCellValueByColumnAndRow(7, $gyou - 3, $setdts["shouhin_tekiyou"]);
		$sheet->setCellValueByColumnAndRow(17, $gyou - 4, $zandaka);
		$sheet->setCellValueByColumnAndRow(13, $gyou - 3, $shiiregaku);
		$sheet->setCellValueByColumnAndRow(15, $gyou - 3, $shukkingaku);
		$sheet->setCellValueByColumnAndRow(17, $gyou - 3, $zandaka + $shiiregaku - $shukkingaku);
		$sheet->setCellValueByColumnAndRow(7, $gyou - 1, '　繰越');
		$sheet->setCellValueByColumnAndRow(17, $gyou - 1, $zandaka);
		for (; $i1 + $i2 < $count_rows;) {
			$gyou = $i0 + $i1 + $i2;
			if ($i2 >= $count2_rows ||
				$i1 < $count1_rows && $shiire_rows[$i1]["denpyoubi"] <= $shukkin_rows[$i2]["denpyoubi"]) {
				$gyou = $i0 + $i1 + $i2;
                $zandaka += $shiire_rows[$i1]["zeinukigaku"] + $shiire_rows[$i1]["zeigaku"];
                $kesi_kbn = $shiire_rows[$i1]["kesikomi_gaku"] == 0 ? 0 : (($shiire_rows[$i1]["kesikomi_gaku"] == $shiire_rows[$i1]["zeinukigaku"] + $shiire_rows[$i1]["zeigaku"]) ? 2 : 1); // 0=未,1=一部,2=済
				// 伝票日付
			//	$sheet->getStyleByColumnAndRow(0, $gyou)->getNumberFormat()->setFormatCode('yyyy/m/d');
			//	$sheet->getStyleByColumnAndRow(0, $gyou)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				if ($shiire_rows[$i1]["denpyoubi"] == $denpyoubi) {
					$sheet->getStyleByColumnAndRow(0, $gyou)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_YELLOW);
				}
				$sheet->setCellValueByColumnAndRow(0, $gyou, PHPExcel_Shared_Date::PHPToExcel(new DateTime($shiire_rows[$i1]["denpyoubi"])));
				// 伝票番号
			//	$sheet->getStyleByColumnAndRow(1, $gyou)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				if ($shiire_rows[$i1]["denpyou_bangou"] == $denpyou_bangou) {
					$sheet->getStyleByColumnAndRow(1, $gyou)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_YELLOW);
				}
				$sheet->setCellValueByColumnAndRow(1, $gyou, $shiire_rows[$i1]["denpyou_bangou"]);
				// 取引区分名
			//	$sheet->getStyleByColumnAndRow(2, $gyou)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$sheet->setCellValueByColumnAndRow(2, $gyou, $shiire_rows[$i1]["torihiki_kbn_name"]);
				// 伝票状態
			//	$sheet->getStyleByColumnAndRow(3, $gyou)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$sheet->setCellValueByColumnAndRow(3, $gyou, $shiire_rows[$i1]["shimekiri_flg"]==1?"次回":"");
				// 内訳
			//	$sheet->getStyleByColumnAndRow(4, $gyou)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$sheet->setCellValueByColumnAndRow(4, $gyou, $shiire_rows[$i1]["utiwake_kbn_name"]);
				// 消込状態
			//	$sheet->getStyleByColumnAndRow(5, $gyou)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$sheet->setCellValueByColumnAndRow(5, $gyou, ["", "一部消込", "消込済"][$kesi_kbn]);
				// 商品コード
			//	$sheet->getStyleByColumnAndRow(6, $gyou)->getNumberFormat()->setFormatCode('@');
				$sheet->setCellValueByColumnAndRow(6, $gyou, $shiire_rows[$i1]["shouhin_mr_cd"]);
				// 商品/摘要
			//	$sheet->getStyleByColumnAndRow(7, $gyou)->getNumberFormat()->setFormatCode('@');
				$sheet->setCellValueByColumnAndRow(7, $gyou, $shiire_rows[$i1]["tekiyou"]);
				// 課税区分=税率台帳+税転嫁区分
				$sheet->setCellValueByColumnAndRow(8, $gyou, $shiire_rows[$i1]["zeiritu_mr_name"] . mb_substr($shiire_rows[$i1]["zei_tenka_kbn_name"], 0, 1));
				// 出金
				// 数量
			//	$sheet->getStyleByColumnAndRow(10, $gyou)->getNumberFormat()->setFormatCode('#,##0.00;[赤]-#,##0.0');
				$sheet->setCellValueByColumnAndRow(10, $gyou, $shiire_rows[$i1]["suuryou"]);
				// 単位
			//	$sheet->getStyleByColumnAndRow(11, $gyou)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$sheet->setCellValueByColumnAndRow(11, $gyou, $shiire_rows[$i1]["tanni_mr_name"]);
				// 単価
			//	$sheet->getStyleByColumnAndRow(12, $gyou)->getNumberFormat()->setFormatCode('#,##0.00;[赤]-#,##0.0');
				$sheet->setCellValueByColumnAndRow(12, $gyou, $shiire_rows[$i1]["tanka"]);
				// 仕入税抜額
			//	$sheet->getStyleByColumnAndRow(13, $gyou)->getNumberFormat()->setFormatCode('#,##0;[赤]-#,##0');
				$sheet->setCellValueByColumnAndRow(13, $gyou, $shiire_rows[$i1]["zeinukigaku"]);
				// 税額
				$sheet->setCellValueByColumnAndRow(14, $gyou, $shiire_rows[$i1]["zeigaku"]);
				// 消込
			//	$sheet->getStyleByColumnAndRow(14, $gyou)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$sheet->setCellValueByColumnAndRow(15, $gyou, ["","△","＊"][$kesi_kbn]);
				// 出金
				// 出金
				// 残高
			//	$sheet->getStyleByColumnAndRow(17, $gyou)->getNumberFormat()->setFormatCode('#,##0;[赤]-#,##0');
				$sheet->setCellValueByColumnAndRow(18, $gyou, $zandaka);
				// 備考
			//	$sheet->getStyleByColumnAndRow(18, $gyou)->getNumberFormat()->setFormatCode('@');
				$sheet->setCellValueByColumnAndRow(19, $gyou, $shiire_rows[$i1]["bikou"]);

				$denpyoubi = str_replace('-', '/', $shiire_rows[$i1]["denpyoubi"]);
				$denpyou_bangou = $shiire_rows[$i1]["denpyou_bangou"];
				$i1++;
			} else {
				// 出金明細
				$zandaka -= $shukkin_rows[$i2]["kingaku"];
				// 伝票日付
				if ($shukkin_rows[$i2]["denpyoubi"] == $denpyoubi) {
					$sheet->getStyleByColumnAndRow(0, $gyou)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_YELLOW);
				}
				$sheet->setCellValueByColumnAndRow(0, $gyou, PHPExcel_Shared_Date::PHPToExcel(new DateTime($shukkin_rows[$i2]["denpyoubi"])));
				// 伝票番号
				if ($shukkin_rows[$i2]["denpyou_bangou"] == $denpyou_bangou) {
					$sheet->getStyleByColumnAndRow(1, $gyou)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_YELLOW);
				}
				$sheet->setCellValueByColumnAndRow(1, $gyou, $shukkin_rows[$i2]["denpyou_bangou"]);
				// 摘要
				$sheet->setCellValueByColumnAndRow(7, $gyou, $shukkin_rows[$i2]["tekiyou"]);
				// 手形期日
				$sheet->setCellValueByColumnAndRow(9, $gyou, PHPExcel_Shared_Date::PHPToExcel(new DateTime($shukkin_rows[$i2]["tegata_kijitu"])));
				// 出金額
				$sheet->setCellValueByColumnAndRow(16, $gyou, $shukkin_rows[$i2]["kingaku"]);
				// 出金消込
				$sheet->setCellValueByColumnAndRow(15, $gyou, $shukkin_rows[$i2]["zenkai_kesikomi_gaku"] == 0 ? "" : "＊");
				// 残高
				$sheet->setCellValueByColumnAndRow(18, $gyou, $zandaka);
				// 備考
				$sheet->setCellValueByColumnAndRow(19, $gyou, $shukkin_rows[$i2]["bikou"]);

				$denpyoubi =  str_replace('-', '/', $shukkin_rows[$i2]["denpyoubi"]);
				$denpyou_bangou = $shukkin_rows[$i2]["denpyou_bangou"];
				$i2++;
			}
		}
//return;
		// Excelファイルの保存 ------------------------------------------
		$PHPExcel->setActiveSheetIndex(0);  //0は印刷用のシート)

		//保存ファイル名
		$filename = uniqid("shi_mot_".$seikyuusaki_mr->cd."_", true) . '.xls'; // ユニーク
		$filename1 = "shi_mot_" . $seikyuusaki_mr->cd . '.xls'; // ユニークの必要はない

		// 保存ファイルパス
		$upload = __DIR__ . '/temp/';
		$path = $upload . $filename;

		$objWriter = PHPExcel_IOFactory::createWriter($PHPExcel, 'Excel5'); //2007形式で保存
		$objWriter->setIncludeCharts(TRUE);
		$objWriter->save( $path );

		// Excelファイルをクライアントに出力 ----------------------------
		$response = new \Phalcon\Http\Response(); // Redirect output to a client's web browser (Excel2005)
		$response->setHeader('Content-Type', 'application/octet-stream'); //vnd.ms-excel');
		$response->setHeader('Content-Disposition', 'attachment;filename="' . $filename1 . '"');
		$response->setHeader('Cache-Control', 'max-age=0');
		$response->setHeader('Cache-Control', 'max-age=1'); // If you're serving to IE 9, then the following may be needed
		$response->setContent(file_get_contents($path)); //Set the content of the response
		unlink($path); // delete temp file
		return $response; //Return the response
    }
    /**
     * 締めグループごとの最終締日取得
     * 面倒なので適当
     */
    public function ajax_last_shimebiAction()
    {
        $this->view->disable();
        $response = new \Phalcon\Http\Response();
        $db = \Phalcon\DI::getDefault()->get('db');
        $phql = "
        select
            a.shimegrp_kbn_cd,
            a.cd,
            b.sime_hiduke
        from shiiresaki_mrs as a 
        left join shiiresaki_sime_dts as b on b.shiiresaki_mr_cd = a.cd
        where a.shimegrp_kbn_cd = {$this->request->getPost('grp_kbn')}
        order by b.sime_hiduke desc
        ";
        $stmt = $db->prepare($phql);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $responseString = $rows[0]['sime_hiduke'];
        $response->setContent(json_encode(['sime_hiduke' => $responseString]));

        return $response;
    }
}
