<?php
 


class MitumoriDtsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        ControllerBase::indexCd("MitumoriDts", "見積伝票", "mitumoribi DESC"); //簡易検索付き一覧表示
    }

    /**
     * モーダル
     */
    public function modalAction()
    {
		ControllerBase::indexCd("MitumoriDts", "見積伝票", "mitumoribi DESC");
    }

    /**
     * Searches for mitumori_dts
     */
    public function searchAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Displays the creation form
     */
    public function newAction($id=null, $dataname="Mitumori")
    {
        $this->view->imax = 0;
        $zeiritu_mrs = ZeirituMrs::find(['order'=>'kazei_kbn_cd, kijunbi DESC']);
        $this->view->zeiritu_mrs = $zeiritu_mrs;

        $tanka_shurui_kbns = TankaShuruiKbns::find(['order'=>'cd', 'conditions'=>'uriage_flg = 1']);
        $this->view->tanka_shurui_kbns = $tanka_shurui_kbns;

        if ($id) {
            $nameDts = $dataname . "Dts";
            $mitumori_dt = $nameDts::findFirstByid($id);
            if (!$mitumori_dt) {
                $this->flash->error("見積データが見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "mitumori_dts",
                    'action' => 'index'
                ));

                return;
            }
            $this->_setDefault($mitumori_dt, "new", $dataname);
            $this->tag->setDefault("id", null);
            $this->tag->setDefault("cd", null);
        }
        $this->tag->setDefault("mitumoribi", date("Y-m-d"));
        $this->tag->setDefault("sakusei_user_name", $this->getDI()->getSession()->get('auth')['name']);
        $this->tag->setDefault("updated", null);

		$readonly_ctlr = new ReadonlyFieldKbnsController();
		$this->view->readonlys = $readonly_ctlr->setFormFieldReadonlys('MitumoriDts','inputfields');
		$rewidth_ctlr = new RewidthFieldMrsController();
		$this->view->rewidths = $rewidth_ctlr->setFormFieldRewidths('MitumoriDts','inputfields');
    }

    /**
     * 修正画面から「次へ」ボタンを押したら次のコードの修正画面になる。
     */
    public function nextAction($id)
    {
        ControllerBase::nextCd($id, "mitumori_dts", "MitumoriDts", "見積データ");
    }

    /**
     * 修正画面から「前へ」ボタンを押したら前のコードの修正画面になる。
     */
    public function prevAction($id = 0)
    {
        ControllerBase::prevCd($id, "mitumori_dts", "MitumoriDts", "見積データ");
    }

    /**
     * Edits a mitumori_dt
     *
     * @param string $id
     */
    public function editAction($id)
    {
        $zeiritu_mrs = ZeirituMrs::find(['order'=>'kazei_kbn_cd, kijunbi DESC']);
        $this->view->zeiritu_mrs = $zeiritu_mrs;

        $tanka_shurui_kbns = TankaShuruiKbns::find(['order'=>'cd', 'conditions'=>'uriage_flg = 1']);
        $this->view->tanka_shurui_kbns = $tanka_shurui_kbns;

//        if (!$this->request->isPost()) {

            $mitumori_dt = MitumoriDts::findFirstByid($id);
            if (!$mitumori_dt) {
                $this->flash->error("見積データが見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "mitumori_dts",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->id = $mitumori_dt->id;

            $this->_setDefault($mitumori_dt, "edit");
//        }
		$readonly_ctlr = new ReadonlyFieldKbnsController();
		$this->view->readonlys = $readonly_ctlr->setFormFieldReadonlys('MitumoriDts','inputfields');
		$rewidth_ctlr = new RewidthFieldMrsController();
		$this->view->rewidths = $rewidth_ctlr->setFormFieldRewidths('MitumoriDts','inputfields');
    }

    /**
     * 画面に表示するデータをセットする
     */
    public function _setDefault($mitumori_dt, $action="edit", $meisai="Mitumori")
    {
        $setdts = ["id",
            "cd",
            "nendo",
            "tekiyou",
            "mitumoribi",
            "stamp",
            "zeiritu_tekiyoubi",
            "tokuisaki_mr_cd",
            "gotantousha",
            "keishou",
            "tel",
            "fax",
            "torihiki_kbn_cd",
            "zei_tenka_kbn_cd",
            "tantou_mr_cd",
            "nounyuu_kijitu",
            "nounyuusaki_mr_cd",
            "chokusousaki_kbn_cd",
            "kenmei",
            "nounyuu_kigen",
            "nounyuu_basho",
            "torihiki_houhou",
            "yuukou_kigen",
            "kingaku_meishou",
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
            if (property_exists($mitumori_dt, $setdt)) {
                $this->tag->setDefault($setdt, $mitumori_dt->$setdt);
            }
        }
		if (property_exists($mitumori_dt, "zeiritu_tekiyoubi")) {$this->tag->setDefault("zeiritu_tekiyoubi", ($mitumori_dt->zeiritu_tekiyoubi == "0000-00-00")?"":$mitumori_dt->zeiritu_tekiyoubi);}
		if (property_exists($mitumori_dt, "nounyuu_kijitu")) {$this->tag->setDefault("nounyuu_kijitu", ($mitumori_dt->nounyuu_kijitu == "0000-00-00")?"":$mitumori_dt->nounyuu_kijitu);}
		if (property_exists($mitumori_dt, "tokuisaki_mr_cd")) {
			$this->tag->setDefault("tokuisaki_mr_zandaka", number_format($mitumori_dt->TokuisakiMrs->kake_zandaka));
			$this->tag->setDefault("tokuisaki_mr_name", $mitumori_dt->TokuisakiMrs->name);
			$this->tag->setDefault("tanka_shurui_kbn_name", $mitumori_dt->TokuisakiMrs->TankaShuruiKbns->name);
			$this->tag->setDefault("tanka_shurui_kbn_koumokumei", $mitumori_dt->TokuisakiMrs->TankaShuruiKbns->koumokumei);
			$this->tag->setDefault("kakeritu", $mitumori_dt->TokuisakiMrs->kakeritu);
			$this->tag->setDefault("seikyuusaki_name", $mitumori_dt->TokuisakiMrs->SeikyuusakiMrs->name);
			$this->tag->setDefault("gaku_hasuu_shori_kbn_cd", $mitumori_dt->TokuisakiMrs->gaku_hasuu_shori_kbn_cd);//端数処理設定用
			$this->tag->setDefault("zei_hasuu_shori_kbn_cd", $mitumori_dt->TokuisakiMrs->zei_hasuu_shori_kbn_cd);//端数処理設定用
		}
		if (property_exists($mitumori_dt, "nounyuusaki_mr_cd")) {$this->tag->setDefault("nounyuusaki_mr_name", $mitumori_dt->nounyuusaki_mr_cd == ''?'':$mitumori_dt->NounyuusakiMrs->name);}
		$this->tag->setDefault("sakusei_user_name", $mitumori_dt->SakuseiUsers->name);

		$meisai_dts = $meisai."MeisaiDts";
		$setmss = [
			"id",
			"utiwake_kbn_cd",
			"kousei",
			"shukka_kbn_cd",
			"shouhin_mr_cd",
			"tanni_mr2_cd",
			"tanni_mr1_cd",
			"tanka_kbn",
			"suuryou",
			"keisu",
			"irisuu",
			"suuryou1",
			"tekiyou",
			"lot",
			"kobetucd",
			"hinsitu_kbn_cd",
			"iro",
			"iromei",
			"size",
			"souko_mr_cd",
			"project_mr_cd",
			"zeiritu_mr_cd",
			"bikou",
			"updated"
		];
		$i = 0;
		foreach ($mitumori_dt->$meisai_dts as $mitumori_meisai_dt) {
			foreach ($setmss as $setms) {
				if (property_exists($mitumori_meisai_dt, $setms)) {
					$this->tag->setDefault("data[mitumori_meisai_dts][".$i."][".$setms."]", $mitumori_meisai_dt->$setms);
				}
			}
			if ($action == "new") {
				$this->tag->setDefault("data[mitumori_meisai_dts][".$i."][id]", null);
			}
			$this->tag->setDefault("data[mitumori_meisai_dts][".$i."][cd]", $i+1);//行番を振りなおす
			if (property_exists($mitumori_meisai_dt, "shouhin_mr_cd")) {
				if (property_exists($mitumori_meisai_dt, "suuryou")) {$this->tag->setDefault("data[mitumori_meisai_dts][".$i."][suuryou]", number_format($mitumori_meisai_dt->suuryou,$mitumori_meisai_dt->ShouhinMrs->suu_shousuu));}
				if (property_exists($mitumori_meisai_dt, "suuryou1")) {$this->tag->setDefault("data[mitumori_meisai_dts][".$i."][suuryou1]", number_format($mitumori_meisai_dt->suuryou1,$mitumori_meisai_dt->ShouhinMrs->suu1_shousuu));}
				if (property_exists($mitumori_meisai_dt, "suuryou2")) {$this->tag->setDefault("data[mitumori_meisai_dts][".$i."][suuryou2]", number_format($mitumori_meisai_dt->suuryou2,$mitumori_meisai_dt->ShouhinMrs->suu2_shousuu));}
				if (property_exists($mitumori_meisai_dt, "gentanka")) {$this->tag->setDefault("data[mitumori_meisai_dts][".$i."][gentanka]", number_format($mitumori_meisai_dt->gentanka,$mitumori_meisai_dt->ShouhinMrs->tanka_shousuu));}
				if (property_exists($mitumori_meisai_dt, "tanka")) {$this->tag->setDefault("data[mitumori_meisai_dts][".$i."][tanka]", number_format($mitumori_meisai_dt->tanka,$mitumori_meisai_dt->ShouhinMrs->tanka_shousuu));}
				if (property_exists($mitumori_meisai_dt, "kingaku")) {$this->tag->setDefault("data[mitumori_meisai_dts][".$i."][kingaku]", number_format($mitumori_meisai_dt->kingaku));}
				$this->tag->setDefault("data[mitumori_meisai_dts][".$i."][suu_shousuu]", $mitumori_meisai_dt->ShouhinMrs->suu_shousuu);//桁数設定用
				$this->tag->setDefault("data[mitumori_meisai_dts][".$i."][suu1_shousuu]", $mitumori_meisai_dt->ShouhinMrs->suu1_shousuu);//桁数設定用
				$this->tag->setDefault("data[mitumori_meisai_dts][".$i."][suu2_shousuu]", $mitumori_meisai_dt->ShouhinMrs->suu2_shousuu);//桁数設定用
				$this->tag->setDefault("data[mitumori_meisai_dts][".$i."][tanka_shousuu]", $mitumori_meisai_dt->ShouhinMrs->tanka_shousuu);//桁数設定用
				$this->tag->setDefault("data[mitumori_meisai_dts][".$i."][zaiko_kbn]", $mitumori_meisai_dt->ShouhinMrs->zaiko_kbn);// 在庫区分
				$this->tag->setDefault("data[mitumori_meisai_dts][".$i."][moto_tanni_mr2_cd]", $mitumori_meisai_dt->ShouhinMrs->tanni_mr2_cd);//桁数設定用
				$this->tag->setDefault("data[mitumori_meisai_dts][".$i."][kazei_kbn_cd]", $mitumori_meisai_dt->ShouhinMrs->kazei_kbn_cd);//税率計算用
			}
			$i++;
		}
		$this->view->imax = $i;
    }

    /**
     * Creates a new mitumori_dt
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "mitumori_dts",
                'action' => 'index'
            ));

            return;
        }

        $mitumori_dt = new MitumoriDts();

        $post_flds = [];
        $post_flds = ["cd",
            "nendo",
            "tekiyou",
            "mitumoribi",
            "stamp",
            "zeiritu_tekiyoubi",
            "tokuisaki_mr_cd",
            "gotantousha",
            "keishou",
            "tel",
            "fax",
            "torihiki_kbn_cd",
            "zei_tenka_kbn_cd",
            "tantou_mr_cd",
            "nounyuu_kijitu",
            "nounyuusaki_mr_cd",
            "chokusousaki_kbn_cd",
            "kenmei",
            "nounyuu_kigen",
            "nounyuu_basho",
            "torihiki_houhou",
            "yuukou_kigen",
            "kingaku_meishou",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        foreach ($post_flds as $post_fld) {
            $mitumori_dt->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        $meisai_flds = [
			"cd",
			"utiwake_kbn_cd",
			"kousei",
			"shouhin_mr_cd",
			"tanni_mr2_cd",
			"tanni_mr1_cd",
			"suuryou",
			"keisu",
			"irisuu",
			"suuryou1",
			"tekiyou",
			"lot",
			"kobetucd",
			"hinsitu_kbn_cd",
			"souko_mr_cd",
			"iro",
			"iromei",
			"size",
			"suuryou2",
			"tanka_kbn",
			"gentanka",
			"tanka",
			"kingaku",
			"genkagaku",
			"zeinukigaku",
			"zeigaku",
			"project_mr_cd",
			"zeiritu_mr_cd",
			"bikou",
			"hacchuurendou_flg",
		];

        $meisai_nums = [
			"suuryou",
			"keisu",
			"irisuu",
			"suuryou1",
			"suuryou2",
			"gentanka",
			"tanka",
			"kingaku",
			"genkagaku",
			"zeinukigaku",
			"zeigaku"
		]; // 税抜額と税額は調整計算用

        $thisPost=[];
        $thisPost["zeiritu_tekiyoubi"] = ($this->request->getPost("zeiritu_tekiyoubi") == "")?"0000-00-00":$this->request->getPost("zeiritu_tekiyoubi");
        $thisPost["nounyuu_kijitu"] = ($this->request->getPost("zeiritu_tekiyoubi") == "")?"0000-00-00":$this->request->getPost("nounyuu_kijitu");

        foreach ($post_flds as $post_fld) {
            $mitumori_dt->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }
        
        $meisai = $this->request->getPost("data");
        
		$zeinuki_chousei_gaku = $this->request->getPost("zeinuki_chousei_gaku"); // 消費税調整と税抜額調整が必要な場合はする
		if ($zeinuki_chousei_gaku < 0) {$zeinuki_chousei_muki = -1;} else {$zeinuki_chousei_muki = 1;}
		$zei_chousei_gaku = $this->request->getPost("zei_chousei_gaku");
		if ($zei_chousei_gaku < 0) {$zei_chousei_muki = -1;} else {$zei_chousei_muki = 1;}

        $meisaicnv = array();
        $mitumori_dt->MitumoriMeisaiDts = array();
        $MitumoriMeisaiDts = array();
        $i = 0;

        foreach ($meisai["mitumori_meisai_dts"] as $mitumori_meisai_dt) {
            if ($mitumori_meisai_dt["shouhin_mr_cd"] !== '' && $mitumori_meisai_dt["cd"] !== '' && $mitumori_meisai_dt["cd"] !== '0'  && $mitumori_meisai_dt["utiwake_kbn_cd"] !== '') {
                $meisaicnv[$i] = [];
                foreach ($meisai_nums as $meisai_num) {
                    $meisaicnv[$i][$meisai_num]=(double)str_replace(',','',$mitumori_meisai_dt[$meisai_num]);//カンマ除去
                }
	            if ($zeinuki_chousei_gaku != 0) { // 消費税調整と税抜額調整が必要な場合はする
	            	$meisaicnv[$i]["zeinukigaku"] += $zeinuki_chousei_muki;
	            	$zeinuki_chousei_gaku -= $zeinuki_chousei_muki;
	            }
	            if ($zei_chousei_gaku != 0) {
	            	$meisaicnv[$i]["zeigaku"] += $zei_chousei_muki;
	            	$zei_chousei_gaku -= $zei_chousei_muki;
	            }
                $MitumoriMeisaiDts[$i] = new MitumoriMeisaiDts();
                foreach ($meisai_flds as $meisai_fld) {
                    $MitumoriMeisaiDts[$i]->$meisai_fld = array_key_exists($meisai_fld, $meisaicnv[$i])?$meisaicnv[$i][$meisai_fld]:$mitumori_meisai_dt[$meisai_fld]??'';
                    //更新日時や更新者はModelに定義してある
                }
                $i++;
            }
        }
        $mitumori_dt->MitumoriMeisaiDts = $MitumoriMeisaiDts;

		/* 伝票番号付番または再設定 */
		$den_ban_ctrl = new DenpyouBangouMrsController(); //伝票番号マスタコントローラ
		$nendo_ban = $den_ban_ctrl->countup('mitumori', $mitumori_dt->cd, $mitumori_dt->mitumoribi);
		if (!$nendo_ban['nendo']) {
            $this->flash->error("エラー:年度が未登録（日付が今年か昨年以外は不可）。" . $mitumori_dt->mitumoribi);
            $this->dispatcher->forward(array(
                'controller' => "mitumori_dts",
                'action' => 'edit',
                'params' => array($id)
            ));
		}
		$mitumori_dt->cd = $nendo_ban['bangou'];
		$mitumori_dt->nendo = $nendo_ban['nendo'];

        if (!$mitumori_dt->save()) {
            foreach ($mitumori_dt->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "mitumori_dts",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("見積データの作成が完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "mitumori_dts",
            'action' => 'edit',
            'params' => array($mitumori_dt->id)
        ));
    }

    /**
     * Saves a mitumori_dt edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "mitumori_dts",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $mitumori_dt = MitumoriDts::findFirstByid($id);

        if (!$mitumori_dt) {
            $this->flash->error("見積データが見つからなくなりました。" . $id);

            $this->dispatcher->forward(array(
                'controller' => "mitumori_dts",
                'action' => 'index'
            ));

            return;
        }

        if ($mitumori_dt->updated !== $this->request->getPost("updated")) {
            $this->flash->error("他のプロセスから見積データが変更されたため更新を中止しました。"
                . $id . ",uid=" . $mitumori_dt->kousin_user_id . " tb=" . $mitumori_dt->updated ." pt=" . $this->request->getPost("updated"));

            $this->dispatcher->forward(array(
                'controller' => "mitumori_dts",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $post_flds = [];
        $post_flds = ["cd",
            "tekiyou",
            "mitumoribi",
            "stamp",
            "zeiritu_tekiyoubi",
            "tokuisaki_mr_cd",
            "gotantousha",
            "keishou",
            "tel",
            "fax",
            "torihiki_kbn_cd",
            "zei_tenka_kbn_cd",
            "tantou_mr_cd",
            "nounyuu_kijitu",
            "nounyuusaki_mr_cd",
            "chokusousaki_kbn_cd",
            "kenmei",
            "nounyuu_kigen",
            "nounyuu_basho",
            "torihiki_houhou",
            "yuukou_kigen",
            "kingaku_meishou",
            "updated",
            ];
        
        $meisai_flds = [
			"id",
			"cd",
			"utiwake_kbn_cd",
			"kousei",
			"shouhin_mr_cd",
			"tanni_mr2_cd",
			"tanni_mr1_cd",
			"suuryou",
			"keisu",
			"irisuu",
			"suuryou1",
			"tekiyou",
			"lot",
			"kobetucd",
			"hinsitu_kbn_cd",
			"souko_mr_cd",
			"iro",
			"iromei",
			"size",
			"suuryou2",
			"tanka_kbn",
			"gentanka",
			"tanka",
			"kingaku",
			"genkagaku",
			"zeinukigaku",
			"zeigaku",
			"project_mr_cd",
			"zeiritu_mr_cd",
			"bikou",
			"hacchuurendou_flg",
		];

        $meisai_nums = [
			"suuryou",
			"keisu",
			"irisuu",
			"suuryou1",
			"suuryou2",
			"gentanka",
			"tanka",
			"kingaku",
			"genkagaku",
			"zeinukigaku",
			"zeigaku"
		]; // 税抜額と税額は調整計算用

        if ($mitumori_dt->updated !== $this->request->getPost("updated")) {
            $this->flash->error("他のプロセスから売上伝票が変更されたため更新を中止しました。"
                . $id . ",uid=" . $mitumori_dt->kousin_user_id . " tb=" . $mitumori_dt->updated ." pt=" . $this->request->getPost("updated"));

            $this->dispatcher->forward(array(
                'controller' => "mitumori_dts",
                'action' => 'index'
            ));

            return;
        }

        $meisai = $this->request->getPost("data");
        $i = 0;
        foreach ($meisai["mitumori_meisai_dts"] as $mitumori_meisai_dt) {
            if ((int)$mitumori_meisai_dt["id"] !== 0) {
                if ((int)$mitumori_dt->MitumoriMeisaiDts[$i]->id !== (int)$mitumori_meisai_dt["id"] ||
                    $mitumori_dt->MitumoriMeisaiDts[$i]->updated !== $mitumori_meisai_dt["updated"]) {
                    $this->flash->error("他のプロセスから売上伝票明細が変更されたため中止しました。"
                        . $id . ",id=" . $mitumori_dt->MitumoriMeisaiDts[$i]->id . ",uid=" . $mitumori_dt->MitumoriMeisaiDts[$i]->kousin_user_id
                        . " tb=" . $mitumori_dt->MitumoriMeisaiDts[$i]->updated ." pt=" . $mitumori_meisai_dt["updated"]);

                    $this->dispatcher->forward(array(
                        'controller' => "mitumori_dts",
                        'action' => 'index'
                    ));

                    return;
                }
            }
            $i++;
        }

        $thisPost=[];
        $thisPost["zeiritu_tekiyoubi"] = ($this->request->getPost("zeiritu_tekiyoubi") == "")?"0000-00-00":$this->request->getPost("zeiritu_tekiyoubi");
        $thisPost["nounyuu_kijitu"] = ($this->request->getPost("nounyuu_kijitu") == "")?"0000-00-00":$this->request->getPost("nounyuu_kijitu");

        $chg_flg = 0;
        foreach ($post_flds as $post_fld) {
            if ((array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld)) !== $mitumori_dt->$post_fld) {
//                echo $post_fld.'/'.$this->request->getPost($post_fld).'/'.(array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld)). '!=' . $mitumori_dt->$post_fld;//型不明のため試行錯誤
                $chg_flg = 1;
                break;
            }
        }

		$zeinuki_chousei_gaku = $this->request->getPost("zeinuki_chousei_gaku"); // 消費税調整と税抜額調整が必要な場合はする
		if ($zeinuki_chousei_gaku < 0) {$zeinuki_chousei_muki = -1;} else {$zeinuki_chousei_muki = 1;}
		$zei_chousei_gaku = $this->request->getPost("zei_chousei_gaku");
		if ($zei_chousei_gaku < 0) {$zei_chousei_muki = -1;} else {$zei_chousei_muki = 1;}

        $meisaicnv = array();
        $chg_flgs = array();
        $i = 0;
        foreach ($meisai["mitumori_meisai_dts"] as $mitumori_meisai_dt) {
            $meisaicnv[$i] = [];
            foreach ($meisai_nums as $meisai_num) {
                $meisaicnv[$i][$meisai_num]=(double)str_replace(',','',$mitumori_meisai_dt[$meisai_num]);//カンマ除去
            }
            if ((int)$mitumori_meisai_dt["cd"] !== 0) { // 消費税調整と税抜額調整が必要な場合はする
	            if ($zeinuki_chousei_gaku != 0) {
	            	$meisaicnv[$i]["zeinukigaku"] += $zeinuki_chousei_muki;
	            	$zeinuki_chousei_gaku -= $zeinuki_chousei_muki;
	            }
	            if ($zei_chousei_gaku != 0) {
	            	$meisaicnv[$i]["zeigaku"] += $zei_chousei_muki;
	            	$zei_chousei_gaku -= $zei_chousei_muki;
	            }
	        }
            $chg_flgs[$i] = 0;//変更ないかも
            if ((int)$mitumori_meisai_dt["cd"] === 0 && (int)$mitumori_meisai_dt["id"] !== 0) { // 削除の条件
                $chg_flg = 1;
                $chg_flgs[$i] = 2;//削除
            } else if ((int)$mitumori_meisai_dt["id"] === 0) { // echo ($mitumori_meisai_dt["id"] === "")?"null":"0";//nullの伝わり方
                if ((double)$mitumori_meisai_dt["suuryou2"] !== 0.0) {
                    $chg_flg = 1;
                    $chg_flgs[$i] = 1;
                }
            } else if ((int)$mitumori_meisai_dt["cd"] !== 0) {
                foreach ($meisai_flds as $meisai_fld) {
                    if ((array_key_exists($meisai_fld, $meisaicnv[$i])?$meisaicnv[$i][$meisai_fld]:$mitumori_meisai_dt[$meisai_fld]).'' !== $mitumori_dt->MitumoriMeisaiDts[$i]->$meisai_fld) {
//							echo $meisai_fld.'/'.$mitumori_meisai_dt[$meisai_fld].'/'.(array_key_exists($meisai_fld, $meisaicnv[$i])?$meisaicnv[$i][$meisai_fld]:$mitumori_meisai_dt[$meisai_fld]).'!=='.$mitumori_dt->MitumoriMeisaiDts[$i]->$meisai_fld;//型不明のため試行錯誤
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
                "controller" => "mitumori_dts",
                "action" => "edit",
                "params" => array($mitumori_dt->id)
            ));

            return;
        }
        $this->_bakOut($mitumori_dt, 0, $chg_flgs);

        foreach ($post_flds as $post_fld) {
            $mitumori_dt->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }
		/* 伝票番号付番または再設定 */
		$den_ban_ctrl = new DenpyouBangouMrsController(); //伝票番号マスタコントローラ
		$nendo_ban = $den_ban_ctrl->countup('mitumori', $mitumori_dt->cd, $mitumori_dt->mitumoribi, $mitumori_dt->nendo);
		if (!$nendo_ban['nendo']) {
            $this->flash->error("エラー:年度が未登録（日付が今年か昨年以外は不可）。" . $mitumori_dt->mitumoribi);
            $this->dispatcher->forward(array(
                'controller' => "mitumori_dts",
                'action' => 'edit',
                'params' => array($id)
            ));
		}
		$mitumori_dt->cd = $nendo_ban['bangou'];
		$mitumori_dt->nendo = $nendo_ban['nendo'];
        $i = 0;
        foreach ($meisai["mitumori_meisai_dts"] as $mitumori_meisai_dt) {
            if ($chg_flgs[$i] === 2) { // 削除でないとき
                $meisai_ctlr = new MitumoriMeisaiDtsController();
                $meisai_ctlr->deleteAction($mitumori_meisai_dt["id"]);
            } else {
                if ((int)$mitumori_meisai_dt["id"] !== 0) {
                    $MitumoriMeisaiDts[$i] = $mitumori_dt->MitumoriMeisaiDts[$i];
                }
                if ($chg_flgs[$i] === 1) { // 更新なら
                    if ((int)$mitumori_meisai_dt["id"] === 0) {
                        $MitumoriMeisaiDts[$i] = new MitumoriMeisaiDts();
                    }
                    foreach ($meisai_flds as $meisai_fld) {
                        $MitumoriMeisaiDts[$i]->$meisai_fld = array_key_exists($meisai_fld, $meisaicnv[$i])?$meisaicnv[$i][$meisai_fld]:$mitumori_meisai_dt[$meisai_fld]??'';
                        //更新日時や更新者はModelに定義してある
                    }
                }
            }
            $i++;
        }
        $mitumori_dt->MitumoriMeisaiDts = $MitumoriMeisaiDts; // 明細データをドッキング
/** デバッグ
 echo "<pre>";
 var_dump($mitumori_dt->cd);
 echo "</pre>";
 return;
*/

        if (!$mitumori_dt->save()) {

            foreach ($mitumori_dt->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "mitumori_dts",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $this->flash->success("見積伝票の情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "mitumori_dts",
            'action' => 'edit',
            'params' => array($mitumori_dt->id)
        ));
    }

    /**
     * Deletes a mitumori_dt
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $mitumori_dt = MitumoriDts::findFirstByid($id);
        if (!$mitumori_dt) {
            $this->flash->error("見積データが見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "mitumori_dts",
                'action' => 'index'
            ));

            return;
        }

        $this->_bakOut($mitumori_dt, 1);

        if (!$mitumori_dt->delete()) {

            foreach ($mitumori_dt->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "mitumori_dts",
                'action' => 'search'
            ));

            return;
        }

        $this->flash->success("見積データの削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "mitumori_dts",
            'action' => "index"
        ));
    }

    /**
     * Back Out a mitumori_dt
     *
     * @param string $mitumori_dt, $dlt_flg
     */
    public function _bakOut($mitumori_dt, $dlt_flg = 0)
    {

        $bak_mitumori_dt = new BakMitumoriDts();
        foreach ($mitumori_dt as $fld => $value) {
            $bak_mitumori_dt->$fld = $mitumori_dt->$fld;
        }
        $bak_mitumori_dt->id = NULL;
        $bak_mitumori_dt->id_moto = $mitumori_dt->id;
        $bak_mitumori_dt->hikae_dltflg = $dlt_flg;
        $bak_mitumori_dt->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_mitumori_dt->hikae_nichiji = date("Y-m-d H:i:s");
        if (!$bak_mitumori_dt->save()) {
            foreach ($bak_mitumori_dt->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
    }

/**
 * 伝票イメージでエクセル出力する。
**/
	public function denpyouAction($id = null){
		//DBのデータを読み込む
        $mitumori_dt = MitumoriDts::findFirstByid($id);
        if (!$mitumori_dt) {
            $this->flash->error("見積伝票が見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "mitumori_dts",
                'action' => 'index'
            ));

            return;
        }
		// Excel出力用ライブラリ
        include __DIR__ . '/../vendor/PHPExcel/Classes/PHPExcel.php';
        include __DIR__ . '/../vendor/PHPExcel/Classes/PHPExcel/Writer/Excel5.php';
        include __DIR__ . '/../vendor/PHPExcel/Classes/PHPExcel/Writer/Excel2007.php';
        include __DIR__ . '/../vendor/PHPExcel/Classes/PHPExcel/IOFactory.php'; //Include PHPExcel_IOFactory
        $objReader = PHPExcel_IOFactory::createReader("Excel2007");

		//テンプレートファイルパス
		$temp_dir = __DIR__ . '/temp/';
		$temp_path = $temp_dir . "mitsumori_temp.xlsx";
		$PHPExcel = $objReader->load($temp_path);
		
		//配列に設定
		//	項目名,項目ID,数0文字1日付2,参照テーブルID,参照テーブルID,…
		$flds = [
			['id','id',0,],
			['伝票番号','cd',0,],
			['摘要','tekiyou',1,],
			['見積り日','mitumoribi',2,],
			['スタンプ','stamp',0,],
			['税率適用日','zeiritu_tekiyoubi',2,],
			['得意先','tokuisaki_mr_cd',1,],
			['ご担当者','gotantousha',1,],
			['敬称','keishou',1,],
			['TEL','tel',1,],
			['FAX','fax',1,],
			['取引区分','torihiki_kbn_cd',0,],
			['税転嫁','zei_tenka_kbn_cd',0,],
			['担当者','tantou_mr_cd',1,],
			['締切','shimekiri_flg',0,],
			['件名','kenmei',1,],
			['納入期限','nounyuu_kigen',1,],
			['納入場所','nounyuu_basho',1,],
			['取引方法','torihiki_houhou',1,],
			['有効期限','yuukou_kigen',1,],
			['合計金額名称','kingaku_meishou',1,],
			['作成者','sakusei_user_id',0,],
			['作成日時','created',2,],
			['更新者','kousin_user_id',0,],
			['更新日時','updated',2,],
			['得意先名','name',1,'TokuisakiMrs',],
			['住所１','juusho1',1,'TokuisakiMrs',],
			['住所２','juusho2',1,'TokuisakiMrs',],
			['単価種類区分','tanka_shurui_kbn_cd',0,'TokuisakiMrs',],
			['単価種類名','name',0,'TokuisakiMrs','TankaShuruiKbns',],
			['掛率','kakeritu',0,'TokuisakiMrs',],
			['掛残高','kake_zandaka',0,'TokuisakiMrs',],
			['与信限度額','yoshin_gendogaku',0,'TokuisakiMrs',],
			['額端数処理区分','gaku_hasuu_shori_kbn_cd',0,'TokuisakiMrs',],
			['額端数処理名','name',0,'TokuisakiMrs','HasuuShoriKbns',],
			['税端数処理区分','zei_hasuu_shori_kbn_cd',0,'TokuisakiMrs',],
			['税端数処理名','name',0,'TokuisakiMrs','HasuuShoriKbns',],
			['取引区分名','name',1,'TorihikiKbns',],
			['税転嫁名','name',1,'ZeiTenkaKbns',],
			['担当者名','name',1,'TantouMrs',],
			['作成者','name',1,'SakuseiUsers',],
		];
		$meisai_flds = [
			['id','id',0,],
			['行番','cd',0,],
			['内訳','utiwake_kbn_cd',1,],
			['構造','kousei',1,],
			['商品コード','shouhin_mr_cd',1,],
			['ロット','lot',1,],
			['商品名/摘要','tekiyou',1,],
			['個別コード','kobetucd',1,],
			['品質コード','hinsitu_kbn_cd',1,],
			['規格型番','kikaku',1,],
			['色','iro',1,],
			['色名','iromei',1,],
			['サイズ','size',1,],
			['単位1','tanni_mr1_cd',1,],
			['単位2','tanni_mr2_cd',1,],
			['元数量','suuryou',0,],
			['係数','keisu',0,],
			['入数','irisuu',0,],
			['数量1','suuryou1',0,],
			['数量2','suuryou2',0,],
			['単価区分','tanka_kbn',0,],
			['原単価','gentanka',0,],
			['単価','tanka',0,],
			['金額','kingaku',0,],
			['原価額','genkagaku',0,],
			['税抜額','zeinukigaku',0,],
			['税額','zeigaku',0,],
			['プロジェクトコード','project_mr_cd',1,],
			['税率コード','zeiritu_mr_cd',0,],
			['備考','bikou',1,],
			['作成者','sakusei_user_id',0,],
			['作成日時','created',2,],
			['更新者','kousin_user_id',0,],
			['更新日時','updated',2,],
			['内訳名','name',1,'UtiwakeKbns',],
			['数量小数桁','suu_shousuu',0,'ShouhinMrs',],
			['数量1小数桁','suu1_shousuu',0,'ShouhinMrs',],
			['数量2小数桁','suu2_shousuu',0,'ShouhinMrs',],
			['単価小数桁','tanka_shousuu',0,'ShouhinMrs',],
			['在庫管理','zaikokanri',0,'ShouhinMrs',],
			['単位名','name',1,'TanniMrs',],
			['数単位名','name',1,'SuuTanniMrs',],
			['税率名','name',1,'ZeirituMrs',],
			['税率','zeiritu',0,'ZeirituMrs',],
		];
		
		//シートの設定
		$PHPExcel->setActiveSheetIndex(1);  //1はDATA(DATAのシート)
		$sheet = $PHPExcel->getActiveSheet();
		$gyou = 1;
		$retu = 0;
		foreach ($flds as $fld) {
			$sheet->setCellValueByColumnAndRow($retu, $gyou, $fld[0]);
			$tbl = $mitumori_dt;
			for ( $i=3 ; array_key_exists($i, $fld) && $fld[$i] != '' ; $i++) {
				$tbl = $tbl->{$fld[$i]};
			}
			if ($fld[2] == 1) {
				$sheet->getStyleByColumnAndRow($retu, $gyou + 1)->getNumberFormat()->setFormatCode('@');
				$sheet->setCellValueByColumnAndRow($retu, $gyou + 1, $tbl->{$fld[1]});
			} else if ($fld[2] == 2) {
				$sheet->getStyleByColumnAndRow($retu, $gyou + 1)->getNumberFormat()->setFormatCode('yyyy/m/d');
				if ($tbl->{$fld[1]} != '0000-00-00') {
					$sheet->setCellValueByColumnAndRow($retu, $gyou + 1, PHPExcel_Shared_Date::PHPToExcel(new DateTime($tbl->{$fld[1]})));
				}
			} else {
				$sheet->setCellValueByColumnAndRow($retu, $gyou + 1, $tbl->{$fld[1]});
			}
			$retu++;
		}
		//合計金額等転記用
		$sekisangaku = 0;
		$goukeigaku = 0;
		$genkagoukei = 0;
		$zeinukigaku = 0;
		$zeigaku = 0;
		foreach($mitumori_dt->MitumoriMeisaiDts as $mitumori_meisai_dt) {
			if ($mitumori_meisai_dt->utiwake_kbn_cd == 30) {
				$sekisangaku += $mitumori_meisai_dt->kingaku;
			} else {
				$goukeigaku += $mitumori_meisai_dt->kingaku;
				$genkagoukei += $mitumori_meisai_dt->genkagaku;
				$zeinukigaku += $mitumori_meisai_dt->zeinukigaku;
				$zeigaku += $mitumori_meisai_dt->zeigaku;
			}
		}
		$sheet->setCellValueByColumnAndRow($retu, $gyou, '合計金額');
		$sheet->setCellValueByColumnAndRow($retu++, $gyou + 1, $goukeigaku);
		$sheet->setCellValueByColumnAndRow($retu, $gyou, '原価合計');
		$sheet->setCellValueByColumnAndRow($retu++, $gyou + 1, $genkagoukei);
		$sheet->setCellValueByColumnAndRow($retu, $gyou, '積算額合計');
		$sheet->setCellValueByColumnAndRow($retu++, $gyou + 1, $sekisangaku);
		$sheet->setCellValueByColumnAndRow($retu, $gyou, '税抜額合計');
		$sheet->setCellValueByColumnAndRow($retu++, $gyou + 1, $zeinukigaku);
		$sheet->setCellValueByColumnAndRow($retu, $gyou, '税額合計');
		$sheet->setCellValueByColumnAndRow($retu++, $gyou + 1, $zeigaku);
		//ここから明細行
		$gyou = 11;
		$retu = 0;
		foreach ($meisai_flds as $fld) {
			$sheet->setCellValueByColumnAndRow($retu, $gyou, $fld[0]);
			$retu++;
		}
		foreach($mitumori_dt->MitumoriMeisaiDts as $mitumori_meisai_dt) {
			$gyou++;
			$retu = 0;
			foreach ($meisai_flds as $fld) {
				$tbl = $mitumori_meisai_dt;
				for ( $i=3 ; array_key_exists($i, $fld) && $fld[$i] != '' ; $i++) {
					$tbl = $tbl->{$fld[$i]};
				}
//echo "<br>\n".$fld[1];
				if ($fld[2] == 1) {
					$sheet->getStyleByColumnAndRow($retu, $gyou)->getNumberFormat()->setFormatCode('@');
					$sheet->setCellValueByColumnAndRow($retu, $gyou, $tbl->{$fld[1]});
				} else if ($fld[2] == 2) {
					$sheet->getStyleByColumnAndRow($retu, $gyou)->getNumberFormat()->setFormatCode('yyyy/m/d');
					$sheet->setCellValueByColumnAndRow($retu, $gyou, PHPExcel_Shared_Date::PHPToExcel(new DateTime($tbl->{$fld[1]})));
				} else {
					$sheet->setCellValueByColumnAndRow($retu, $gyou, $tbl->{$fld[1]});
				}
				$retu++;
			}
		}
//return;
		// Excelファイルの保存 ------------------------------------------  
		$PHPExcel->setActiveSheetIndex(0);  //0は印刷用のシート)
		
		//保存ファイル名
		$filename = uniqid("mitumori_".$mitumori_dt->cd."_", true) . '.xlsx';
		
		// 保存ファイルパス
		$upload = __DIR__ . '/temp/';
		$path = $upload . $filename;

        $objWriter = PHPExcel_IOFactory::createWriter($PHPExcel, 'Excel2007');
		$objWriter->save( $path );
		
		// Excelファイルをクライアントに出力 ----------------------------
        $response = new \Phalcon\Http\Response(); // Redirect output to a client's web browser (Excel2005)
        $response->setHeader('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		$response->setHeader('Content-Disposition', 'attachment;filename="' . $filename . '"');
        $response->setHeader('Cache-Control', 'max-age=0');
        $response->setHeader('Cache-Control', 'max-age=1'); // If you're serving to IE 9, then the following may be needed
        $response->setContent(file_get_contents($path)); //Set the content of the response
        unlink($path); // delete temp file
        return $response; //Return the response
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

	    $mitumori_dts = MitumoriDts::find(array(
//	        'columns' => array('cd, name'), 全項目とする
		    'order' => 'cd, id DESC',
		    'conditions' => ' cd LIKE ?1 ',
		    'bind' => array(1 => $this->request->getPost('cd').'%')
		));
		$res_flds = [
			"id",
			"cd",
			"nendo",
			"tekiyou",
			"mitumoribi",
			"stamp",
			"zeiritu_tekiyoubi",
			"tokuisaki_mr_cd",
			"gotantousha",
			"keishou",
			"tel",
			"fax",
			"torihiki_kbn_cd",
			"zei_tenka_kbn_cd",
			"tantou_mr_cd",
			"nounyuu_kijitu",
			"nounyuusaki_mr_cd",
			"chokusousaki_kbn_cd",
			"kenmei",
			"nounyuu_kigen",
			"nounyuu_basho",
			"torihiki_houhou",
			"yuukou_kigen",
			"kingaku_meishou",
			"sakusei_user_id",
			"created",
			"kousin_user_id",
			"updated",
		];
		$meisai_flds = [
			"utiwake_kbn_cd",
			"kousei",
			"shouhin_mr_cd",
			"tekiyou",
			"lot",
			"kobetucd",
			"souko_mr_cd",
			"hinsitu_kbn_cd",
			"iro",
			"iromei",
			"size",
			"suuryou",
			"keisu",
			"irisuu",
			"suuryou1",
			"tanni_mr2_cd",
			"tanni_mr1_cd",
			"tanka_kbn",
			"tanka",
			"gentanka",
			"suuryou2",
			"kingaku",
			"zeiritu_mr_cd",
			"bikou",
		];
		$resData = array();
		foreach ($mitumori_dts as $mitumori_dt) {
		    $resAdata = array();
		    foreach ($res_flds as $res_fld) {
		        $resAdata[$res_fld] = $mitumori_dt->$res_fld;
		    }
		    foreach ($mitumori_dt->MitumoriMeisaiDts as $mitumori_meisai_dt) {
		        foreach ($meisai_flds as $meisai_fld) {
		            $resAdata["meisai"][$mitumori_meisai_dt->cd][$meisai_fld] = $mitumori_meisai_dt->$meisai_fld;
		        }
		        $resAdata["meisai"][$mitumori_meisai_dt->cd]['moto_tanni_mr2_cd'] = $mitumori_meisai_dt->ShouhinMrs->tanni_mr2_cd;
		        $resAdata["meisai"][$mitumori_meisai_dt->cd]['suu_shousuu'] = $mitumori_meisai_dt->ShouhinMrs->suu_shousuu;
		        $resAdata["meisai"][$mitumori_meisai_dt->cd]['suu1_shousuu'] = $mitumori_meisai_dt->ShouhinMrs->suu1_shousuu;
		        $resAdata["meisai"][$mitumori_meisai_dt->cd]['suu2_shousuu'] = $mitumori_meisai_dt->ShouhinMrs->suu2_shousuu;
		        $resAdata["meisai"][$mitumori_meisai_dt->cd]['tanka_shousuu'] = $mitumori_meisai_dt->ShouhinMrs->tanka_shousuu;
		        $resAdata["meisai"][$mitumori_meisai_dt->cd]['zaiko_kbn'] = $mitumori_meisai_dt->ShouhinMrs->zaiko_kbn;
				
		    }
//	        $resAdata["seikyuusaki_name"] = $mitumori_dt->SeikyuusakiMrs->name;
	        $resData[] = $resAdata;//array('cd' => $mitumori_dt->cd, 'name' => $mitumori_dt->name);
	    }

	    //Set the content of the response
	    $response->setContent(json_encode($resData));

	    //Return the response
	    return $response;
	}

}
