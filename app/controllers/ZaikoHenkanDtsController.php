<?php

class ZaikoHenkanDtsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        ControllerBase::indexCd("ZaikoHenkanDts", "在庫変換データ", "cd DESC"); //簡易検索付き一覧表示
    }

    /**
     * モーダル
     */
    public function modalAction()
    {
		ControllerBase::indexCd("ZaikoHenkanDts", "在庫変換伝票");
    }

    /**
     * Searches for zaiko_henkan_dts
     */
    public function searchAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Displays the creation form
     */
    public function newAction($id=null, $dataname="ZaikoHenkan")
    {
        $this->view->imax = 0;

		if($this->request->isGet()){
			$kbn = $this->request->getQuery("kbn", "int", 2);
			$this->tag->setDefault("zaiko_henkan_kbn_cd", $kbn);
		}
        if ($id) {
            $nameDts = $dataname."Dts";
            $zaiko_henkan_dt = $nameDts::findFirstByid($id);
            if (!$zaiko_henkan_dt) {
                $this->flash->error("在庫変換データが見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "zaiko_henkan_dts",
                    'action' => 'index'
                ));

                return;
            }
            $this->_setDefault($zaiko_henkan_dt, "new", $dataname);
            $this->tag->setDefault("id", null);
            $this->tag->setDefault("cd", null);
        }
		$kihon_mr = KihonMrs::findFirstByid(1);
		$this->tag->setDefault("simezumibi", count($kihon_mr->ShiiresakiMrs->ShiiresakiSimeDts) ? $kihon_mr->ShiiresakiMrs->ShiiresakiSimeDts[0]->sime_hiduke : "0000-00-00");// 最終締日
        $this->tag->setDefault("henkanbi", date("Y-m-d"));
		$readonly_ctlr = new ReadonlyFieldKbnsController();
		$this->view->readonlys = $readonly_ctlr->setFormFieldReadonlys('ZaikoHenkanDts','inputfields');
		$rewidth_ctlr = new RewidthFieldMrsController();
		$this->view->rewidths = $rewidth_ctlr->setFormFieldRewidths('ZaikoHenkanDts','inputfields');

    }

    /**
     * 修正画面から「次へ」ボタンを押したら次のコードの修正画面になる。
     */
    public function nextAction($id)
    {
        $this->nextCd($id, "zaiko_henkan_dts", "ZaikoHenkanDts", "在庫変換データ");
    }

    /**
     * 修正画面から「前へ」ボタンを押したら前のコードの修正画面になる。
     */
    public function prevAction($id = 0)
    {
        $this->prevCd($id, "zaiko_henkan_dts", "ZaikoHenkanDts", "在庫変換データ");
    }


    /**
     * 修正画面から「次へ」ボタンを押したら次のコードの修正画面になる。共通部分
     */
    protected function nextCd($id, $table_id, $TableId, $table_name, $key = 'cd') // 例：ControllerBase::nextCd($id, "uriage_dts", "UriageDts", "売上伝票")
    {
        if (!$this->request->isPost()) {
            $tblrow = $TableId::findFirstByid($id);
            if (!$tblrow) {
                $this->flash->error($table_name."が見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => $table_id,
                    'action' => 'index'
                ));

                return;
            }
            $tblrow = $TableId::findFirst([$key." > :cd: AND zaiko_henkan_kbn_cd = :kbn:", "bind"=>["cd"=>$tblrow->$key, "kbn"=>$tblrow->zaiko_henkan_kbn_cd], "order"=>$key]);
            if (!$tblrow) {
                $this->flash->warning($table_name."の最後です。");

                $this->dispatcher->forward(array(
                    'controller' => $table_id,
                    'action' => 'edit',
                    'params' => array($id)
                ));

                return;
            }
            $this->response->redirect($table_id.'/edit/'.$tblrow->id);
        }
    }

    /**
     * 修正画面から「前へ」ボタンを押したら前のコードの修正画面になる。共通部分
     */
    protected function prevCd($id, $table_id, $TableId, $table_name, $key = 'cd') // 例：ControllerBase::prevCd($id, "uriage_dts", "UriageDts", "売上伝票")
    {
        if (!$this->request->isPost()) {
            if ($id) {
                $tblrow = $TableId::findFirstByid($id);
                if (!$tblrow) {
                    $this->flash->error($table_name."が見つからなくなりました。");

                    $this->dispatcher->forward(array(
                        'controller' => $table_id,
                        'action' => 'index'
                    ));

                    return;
                }
                $tblrow = $TableId::findFirst([$key." < :cd: AND zaiko_henkan_kbn_cd = :kbn:", "bind"=>["cd"=>$tblrow->$key, "kbn"=>$tblrow->zaiko_henkan_kbn_cd], "order"=>$key." DESC"]);
            } else {
                $tblrow = $TableId::findFirst(["order"=>$key." DESC"]);
            }
            if (!$tblrow) {
                $this->flash->warning($table_name."の最初です。");

                $this->dispatcher->forward(array(
                    'controller' => $table_id,
                    'action' => 'edit',
                    'params' => array($id)
                ));

                return;
            }
            $this->response->redirect($table_id.'/edit/'.$tblrow->id);
        }
    }


    /**
     * Edits a zaiko_henkan_dt
     *
     * @param string $id
     */
    public function editAction($id)
    {
//        if (!$this->request->isPost()) {

            $zaiko_henkan_dt = ZaikoHenkanDts::findFirstByid($id);
            if (!$zaiko_henkan_dt) {
                $this->flash->error("在庫変換データが見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "zaiko_henkan_dts",
                    'action' => 'index'
                ));

                return;
            }

            $url = new Phalcon\Mvc\Url();

            $this->view->id = $id;
            if(!empty($exp)) {
                $this->view->exp = $this->url->get('zeiko_henkan_dts/'.$exp.'/'.$id); //作成・更新後にedit画面が出たときにExcelをexportする←createAction最後・saveAction最後→app/views/index.volt
            }

            $this->view->id = $zaiko_henkan_dt->id;
            $this->view->denpyou_mr_cd = $zaiko_henkan_dt->ZaikoHenkanKbns->denpyou_mr_cd;

            $this->_setDefault($zaiko_henkan_dt, "edit");
//        }
		$kihon_mr = KihonMrs::findFirstByid(1);
		$this->tag->setDefault("simezumibi", count($kihon_mr->ShiiresakiMrs->ShiiresakiSimeDts) ? $kihon_mr->ShiiresakiMrs->ShiiresakiSimeDts[0]->sime_hiduke : "0000-00-00");// 最終締日
		$readonly_ctlr = new ReadonlyFieldKbnsController();
		$this->view->readonlys = $readonly_ctlr->setFormFieldReadonlys('ZaikoHenkanDts','inputfields');
		$rewidth_ctlr = new RewidthFieldMrsController();
		$this->view->rewidths = $rewidth_ctlr->setFormFieldRewidths('ZaikoHenkanDts','inputfields');
    }

    /**
     * 画面に表示するデータをセットする
     */
    public function _setDefault($zaiko_henkan_dt, $action="edit", $meisai="ZaikoHenkan")
    {
        $setdts = ["id",
            "cd",
            "nendo",
            "name",
            "henkanbi",
            "tantou_mr_cd",
            "zaiko_henkan_kbn_cd",
            "sasizu_dt_cd",
            "souko_mr_cd",
            "tokuisaki_mr_cd",
            "moto_souko_mr_cd",
            "moto_tantou_mr_cd",
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
            if (property_exists($zaiko_henkan_dt, $setdt)) {
                $this->tag->setDefault($setdt, $zaiko_henkan_dt->$setdt);
            }
        }
		if (property_exists($zaiko_henkan_dt, "tokuisaki_mr_cd")) {
			if ($zaiko_henkan_dt->tokuisaki_mr_cd) {
				$this->tag->setDefault("tokuisaki_mr_name", $zaiko_henkan_dt->TokuisakiMrs->name);
			}
		}
		$this->tag->setDefault("sakusei_user_name", $zaiko_henkan_dt->SakuseiUsers->name);

		$meisai_dts = $meisai."MeisaiDts";
		$setmss = [
			"id",
			"henkansaki_flg",
			"shouhin_mr_cd",
			"tanni_mr2_cd",
			"tanni_mr1_cd",
			"irisuu",
			"suuryou1",
			"tekiyou",
			"iro",
			"iromei",
			"lot",
			"kobetucd",
			"hinsitu_kbn_cd",
			"kousei_suuryou",
			"suuryou2",
			"tanka",
			"tanka_kbn",
			"kingaku",
			"bikou",
			"updated"
		];
		$i = 0;
		foreach ($zaiko_henkan_dt->$meisai_dts as $zaiko_henkan_meisai_dt) {
			foreach ($setmss as $setms) {
				if (property_exists($zaiko_henkan_meisai_dt, $setms)) {
					$this->tag->setDefault("data[zaiko_henkan_meisai_dts][".$i."][".$setms."]", $zaiko_henkan_meisai_dt->$setms);
				}
			}
			if ($action == "new") {
				$this->tag->setDefault("data[zaiko_henkan_meisai_dts][".$i."][id]", null);
			}
			$this->tag->setDefault("data[zaiko_henkan_meisai_dts][".$i."][cd]", $i+1);//行番を振りなおす
			if (property_exists($zaiko_henkan_meisai_dt, "shouhin_mr_cd")) {
				if (property_exists($zaiko_henkan_meisai_dt, "kousei_suuryou")) {$this->tag->setDefault("data[zaiko_henkan_meisai_dts][".$i."][kousei_suuryou]", number_format($zaiko_henkan_meisai_dt->kousei_suuryou,$zaiko_henkan_meisai_dt->ShouhinMrs->suu_shousuu));}
				if (property_exists($zaiko_henkan_meisai_dt, "suuryou1")) {$this->tag->setDefault("data[zaiko_henkan_meisai_dts][".$i."][suuryou1]", number_format($zaiko_henkan_meisai_dt->suuryou1,$zaiko_henkan_meisai_dt->ShouhinMrs->suu1_shousuu));}
				if (property_exists($zaiko_henkan_meisai_dt, "suuryou2")) {$this->tag->setDefault("data[zaiko_henkan_meisai_dts][".$i."][suuryou2]", number_format($zaiko_henkan_meisai_dt->suuryou2,$zaiko_henkan_meisai_dt->ShouhinMrs->suu2_shousuu));}
				if (property_exists($zaiko_henkan_meisai_dt, "tanka")) {$this->tag->setDefault("data[zaiko_henkan_meisai_dts][".$i."][tanka]", number_format($zaiko_henkan_meisai_dt->tanka,$zaiko_henkan_meisai_dt->ShouhinMrs->tanka_shousuu));}
				if (property_exists($zaiko_henkan_meisai_dt, "kingaku")) {$this->tag->setDefault("data[zaiko_henkan_meisai_dts][".$i."][kingaku]", number_format($zaiko_henkan_meisai_dt->kingaku));}
			//	$this->tag->setDefault("data[zaiko_henkan_meisai_dts][".$i."][tanka_kbn]", $zaiko_henkan_meisai_dt->ShouhinMrs->tanka_kbn);//単価区分
				$this->tag->setDefault("data[zaiko_henkan_meisai_dts][".$i."][suu_shousuu]", $zaiko_henkan_meisai_dt->ShouhinMrs->suu_shousuu);//桁数設定用
				$this->tag->setDefault("data[zaiko_henkan_meisai_dts][".$i."][suu1_shousuu]", $zaiko_henkan_meisai_dt->ShouhinMrs->suu1_shousuu);//桁数設定用
				$this->tag->setDefault("data[zaiko_henkan_meisai_dts][".$i."][suu2_shousuu]", $zaiko_henkan_meisai_dt->ShouhinMrs->suu2_shousuu);//桁数設定用
				$this->tag->setDefault("data[zaiko_henkan_meisai_dts][".$i."][tanka_shousuu]", $zaiko_henkan_meisai_dt->ShouhinMrs->tanka_shousuu);//桁数設定用
				$this->tag->setDefault("data[zaiko_henkan_meisai_dts][".$i."][moto_tanni_mr2_cd]", $zaiko_henkan_meisai_dt->ShouhinMrs->tanni_mr2_cd);//桁数設定用
				$this->tag->setDefault("data[zaiko_henkan_meisai_dts][".$i."][zaiko_kbn]", $zaiko_henkan_meisai_dt->ShouhinMrs->zaiko_kbn);//展開計算用在庫区分
			}
			$i++;
		}
		$this->view->imax = $i;
    }

    /**
     * Creates a new zaiko_henkan_dt
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "zaiko_henkan_dts",
                'action' => 'index'
            ));

            return;
        }

        $zaiko_henkan_dt = new ZaikoHenkanDts();

        $post_flds = [];
        $post_flds = ["cd",
            "nendo",
            "name",
            "henkanbi",
            "tantou_mr_cd",
            "zaiko_henkan_kbn_cd",
            "sasizu_dt_cd",
            "souko_mr_cd",
            "tokuisaki_mr_cd",
            "moto_souko_mr_cd",
            "moto_tantou_mr_cd",
            "updated",
            ];
        
        $meisai_flds = ["cd","henkansaki_flg","shouhin_mr_cd","tanni_mr2_cd","tanni_mr1_cd","irisuu","suuryou1","tekiyou","iro","iromei","lot","kobetucd","hinsitu_kbn_cd"
					,"kousei_suuryou","suuryou2","tanka","tanka_kbn","kingaku","bikou"];

        $meisai_nums = ["kousei_suuryou","suuryou1","suuryou2","tanka","kingaku"];

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        foreach ($post_flds as $post_fld) {
            $zaiko_henkan_dt->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        $meisai = $this->request->getPost("data");
        
        $meisaicnv = array();
        $zaiko_henkan_dt->ZaikoHenkanMeisaiDts = array();
        $ZaikoHenkanMeisaiDts = array();
        $i = 0;

        foreach ($meisai["zaiko_henkan_meisai_dts"] as $zaiko_henkan_meisai_dt) {
            if ($zaiko_henkan_meisai_dt["shouhin_mr_cd"] != ''
                && $zaiko_henkan_meisai_dt["cd"] !== ''
                && $zaiko_henkan_meisai_dt["cd"] !== '0'
                && $zaiko_henkan_meisai_dt["henkansaki_flg"] !== '') {
                $meisaicnv[$i] = [];
                foreach ($meisai_nums as $meisai_num) {
                    $meisaicnv[$i][$meisai_num]=str_replace(',','',$zaiko_henkan_meisai_dt[$meisai_num]);//カンマ除去
                }
                $ZaikoHenkanMeisaiDts[$i] = new ZaikoHenkanMeisaiDts();
                foreach ($meisai_flds as $meisai_fld) {
                    $ZaikoHenkanMeisaiDts[$i]->$meisai_fld = array_key_exists($meisai_fld, $meisaicnv[$i])?$meisaicnv[$i][$meisai_fld]:$zaiko_henkan_meisai_dt[$meisai_fld]??'';
                    //更新日時や更新者はModelに定義してある
                }
                $i++;
            }
        }
        $zaiko_henkan_dt->ZaikoHenkanMeisaiDts = $ZaikoHenkanMeisaiDts;

		/* 伝票番号付番または再設定 */
		$zai_hen_kb = ZaikoHenkanKbns::findfirst(["conditions"=>"cd = ?0","bind"=>[0=>$zaiko_henkan_dt->zaiko_henkan_kbn_cd]]); //在庫変換区分参照
		$den_ban_ctrl = new DenpyouBangouMrsController(); //伝票番号マスタコントローラ
		$nendo_ban = $den_ban_ctrl->countup($zai_hen_kb->denpyou_mr_cd, 0, $zaiko_henkan_dt->henkanbi); // 新規なので$zaiko_henkan_dt->cd使わない2019/03/29井浦
		if (!$nendo_ban['nendo']) {
            $this->flash->error("エラー:年度が未登録（日付が今年か昨年以外は不可）。" . $zaiko_henkan_dt->zaiko_henkanbi);
            $this->dispatcher->forward(array(
                'controller' => "zaiko_henkan_dts",
                'action' => 'edit',
                'params' => array($id)
            ));
		}
		$zaiko_henkan_dt->cd = $nendo_ban['bangou'];
		$zaiko_henkan_dt->nendo = $nendo_ban['nendo'];

        if (!$zaiko_henkan_dt->save()) {
            foreach ($zaiko_henkan_dt->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "zaiko_henkan_dts",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("在庫変換データの作成が完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "zaiko_henkan_dts",
            'action' => 'edit',
            'params' => array($zaiko_henkan_dt->id)
        ));
    }

    /**
     * Saves a zaiko_henkan_dt edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "zaiko_henkan_dts",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $zaiko_henkan_dt = ZaikoHenkanDts::findFirstByid($id);

        if (!$zaiko_henkan_dt) {
            $this->flash->error("在庫変換データが見つからなくなりました。" . $id);

            $this->dispatcher->forward(array(
                'controller' => "zaiko_henkan_dts",
                'action' => 'index'
            ));

            return;
        }

        if ($zaiko_henkan_dt->updated !== $this->request->getPost("updated")) {
            $this->flash->error("他のプロセスから在庫変換データが変更されたため更新を中止しました。"
                . $id . ",uid=" . $zaiko_henkan_dt->kousin_user_id . " tb=" . $zaiko_henkan_dt->updated ." pt=" . $this->request->getPost("updated"));

            $this->dispatcher->forward(array(
                'controller' => "zaiko_henkan_dts",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $post_flds = [];
        $post_flds = ["cd",
            "name",
            "henkanbi",
            "tantou_mr_cd",
            "zaiko_henkan_kbn_cd",
            "sasizu_dt_cd",
            "souko_mr_cd",
            "tokuisaki_mr_cd",
            "moto_souko_mr_cd",
            "moto_tantou_mr_cd",
            "updated",
            ];
        
        $meisai_flds = [
        	"id",
        	"cd",
        	"henkansaki_flg",
        	"shouhin_mr_cd",
        	"tanni_mr2_cd",
        	"tanni_mr1_cd",
        	"irisuu",
        	"suuryou1",
        	"tekiyou",
        	"iro",
        	"iromei",
        	"lot",
        	"kobetucd",
        	"hinsitu_kbn_cd",
        	"kousei_suuryou",
        	"suuryou2",
        	"tanka",
        	"tanka_kbn",
        	"kingaku",
        	"bikou"
        	];

        $meisai_nums = [
        	"kousei_suuryou",
        	"suuryou1",
        	"suuryou2",
        	"tanka",
        	"kingaku"
        	];


        if ($zaiko_henkan_dt->updated !== $this->request->getPost("updated")) {
            $this->flash->error("他のプロセスから在庫変換伝票が変更されたため更新を中止しました。"
                . $id . ",uid=" . $zaiko_henkan_dt->kousin_user_id . " tb=" . $zaiko_henkan_dt->updated ." pt=" . $this->request->getPost("updated"));

            $this->dispatcher->forward(array(
                'controller' => "zaiko_henkan_dts",
                'action' => 'index'
            ));

            return;
        }

        $meisai = $this->request->getPost("data");
        $i = 0;
        foreach ($meisai["zaiko_henkan_meisai_dts"] as $zaiko_henkan_meisai_dt) {
            if ((int)$zaiko_henkan_meisai_dt["id"] !== 0) {
                if ((int)$zaiko_henkan_dt->ZaikoHenkanMeisaiDts[$i]->id !== (int)$zaiko_henkan_meisai_dt["id"] ||
                    $zaiko_henkan_dt->ZaikoHenkanMeisaiDts[$i]->updated !== $zaiko_henkan_meisai_dt["updated"]) {
                    $this->flash->error("他のプロセスから在庫変換伝票明細が変更されたため中止しました。"
                        . $id . ",id=" . $zaiko_henkan_dt->ZaikoHenkanMeisaiDts[$i]->id . ",uid=" . $zaiko_henkan_dt->ZaikoHenkanMeisaiDts[$i]->kousin_user_id
                        . " tb=" . $zaiko_henkan_dt->ZaikoHenkanMeisaiDts[$i]->updated ." pt=" . $zaiko_henkan_meisai_dt["updated"]);

                    $this->dispatcher->forward(array(
                        'controller' => "zaiko_henkan_dts",
                        'action' => 'index'
                    ));

                    return;
                }
            }
            $i++;
        }

        $thisPost=[];

        $chg_flg = 0;
        foreach ($post_flds as $post_fld) {
            if ((array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld)) !== $zaiko_henkan_dt->$post_fld) {
//                echo $post_fld.'/'.$this->request->getPost($post_fld).'/'.(array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld)). '!=' . $zaiko_henkan_dt->$post_fld;//型不明のため試行錯誤
                $chg_flg = 1;
                break;
            }
        }

        $meisaicnv = array();
        $chg_flgs = array();
        $i = 0;
        foreach ($meisai["zaiko_henkan_meisai_dts"] as $zaiko_henkan_meisai_dt) {
            $meisaicnv[$i] = [];
            foreach ($meisai_nums as $meisai_num) {
                $meisaicnv[$i][$meisai_num]=(double)str_replace(',','',$zaiko_henkan_meisai_dt[$meisai_num]);//カンマ除去
            }
            $chg_flgs[$i] = 0;//変更ないかも
            if ((int)$zaiko_henkan_meisai_dt["cd"] === 0 && (int)$zaiko_henkan_meisai_dt["id"] !== 0) { // 削除の条件
                $chg_flg = 1;
                $chg_flgs[$i] = 2;//削除
            } else if ((int)$zaiko_henkan_meisai_dt["cd"] !== 0 && (int)$zaiko_henkan_meisai_dt["id"] === 0) { // echo ($zaiko_henkan_meisai_dt["id"] === "")?"null":"0";//nullの伝わり方
                if ((double)$zaiko_henkan_meisai_dt["suuryou2"] !== 0.0 || (double)$zaiko_henkan_meisai_dt["suuryou1"] !== 0.0) { // 数量1条件追加2019/03/16井浦 この分岐条件を入れると削除するために2度登録必要なためコメントアウト Nishiyama
                    $chg_flg = 1;
                    $chg_flgs[$i] = 1;
                }
            } else if ((int)$zaiko_henkan_meisai_dt["cd"] !== 0) {
                foreach ($meisai_flds as $meisai_fld) {
// if($this->request->getPost("cd")==5021) {echo "\n<br>".$meisai_fld.'/'.$zaiko_henkan_meisai_dt[$meisai_fld].'/'.(array_key_exists($meisai_fld, $meisaicnv[$i])?$meisaicnv[$i][$meisai_fld]:$zaiko_henkan_meisai_dt[$meisai_fld]).'!=='.$zaiko_henkan_dt->ZaikoHenkanMeisaiDts[$i]->$meisai_fld;}
                    if ((array_key_exists($meisai_fld, $meisaicnv[$i])?$meisaicnv[$i][$meisai_fld]:$zaiko_henkan_meisai_dt[$meisai_fld]).'' !== $zaiko_henkan_dt->ZaikoHenkanMeisaiDts[$i]->$meisai_fld) {
//							echo $meisai_fld.'/'.$zaiko_henkan_meisai_dt[$meisai_fld].'/'.(array_key_exists($meisai_fld, $meisaicnv[$i])?$meisaicnv[$i][$meisai_fld]:$zaiko_henkan_meisai_dt[$meisai_fld]).'!=='.$zaiko_henkan_dt->ZaikoHenkanMeisaiDts[$i]->$meisai_fld;//型不明のため試行錯誤
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
                "controller" => "zaiko_henkan_dts",
                "action" => "edit",
                "params" => array($zaiko_henkan_dt->id)
            ));

            return;
        }
        $this->_bakOut($zaiko_henkan_dt, 0, $chg_flgs);

        foreach ($post_flds as $post_fld) {
            $zaiko_henkan_dt->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }
		/* 伝票番号付番または再設定 */
		$zai_hen_kb = ZaikoHenkanKbns::findfirst(["conditions"=>"cd = ?0","bind"=>[0=>$zaiko_henkan_dt->zaiko_henkan_kbn_cd]]); //在庫変換区分参照
		$den_ban_ctrl = new DenpyouBangouMrsController(); //伝票番号マスタコントローラ
		$nendo_ban = $den_ban_ctrl->countup($zai_hen_kb->denpyou_mr_cd, $zaiko_henkan_dt->cd, $zaiko_henkan_dt->henkanbi, $zaiko_henkan_dt->nendo);
		if (!$nendo_ban['nendo']) {
            $this->flash->error("エラー:年度が未登録（日付が今年か昨年以外は不可）。" . $zaiko_henkan_dt->zaiko_henkanbi);
            $this->dispatcher->forward(array(
                'controller' => "zaiko_henkan_dts",
                'action' => 'edit',
                'params' => array($id)
            ));
		}
		$zaiko_henkan_dt->cd = $nendo_ban['bangou'];
		$zaiko_henkan_dt->nendo = $nendo_ban['nendo'];
        $i = 0;
        foreach ($meisai["zaiko_henkan_meisai_dts"] as $zaiko_henkan_meisai_dt) {
            if ($chg_flgs[$i] === 2) { // 削除でないとき
                $meisai_ctlr = new ZaikoHenkanMeisaiDtsController();
                $meisai_ctlr->deleteAction($zaiko_henkan_meisai_dt["id"]);
            } else {
                if ((int)$zaiko_henkan_meisai_dt["id"] !== 0) {
                    $ZaikoHenkanMeisaiDts[$i] = $zaiko_henkan_dt->ZaikoHenkanMeisaiDts[$i];
                }
                if ($chg_flgs[$i] === 1) { // 更新なら
                    if ((int)$zaiko_henkan_meisai_dt["id"] === 0) {
                        $ZaikoHenkanMeisaiDts[$i] = new ZaikoHenkanMeisaiDts();
                    }
                    foreach ($meisai_flds as $meisai_fld) {
                        $ZaikoHenkanMeisaiDts[$i]->$meisai_fld = array_key_exists($meisai_fld, $meisaicnv[$i])?$meisaicnv[$i][$meisai_fld]:$zaiko_henkan_meisai_dt[$meisai_fld]??'';
                        //更新日時や更新者はModelに定義してある
                    }
                }
            }
            $i++;
        }
        $zaiko_henkan_dt->ZaikoHenkanMeisaiDts = $ZaikoHenkanMeisaiDts; // 明細データをドッキング
/** デバッグ
 echo "<pre>";
 var_dump($zaiko_henkan_dt->cd);
 echo "</pre>";
 return;
*/

        if (!$zaiko_henkan_dt->save()) {

            foreach ($zaiko_henkan_dt->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "zaiko_henkan_dts",
                'action' => 'edit',
                'params' => array($zaiko_henkan_dt->id)
            ));

            return;
        }

        $this->flash->success("在庫変換データの情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "zaiko_henkan_dts",
            'action' => 'edit',
            'params' => array($zaiko_henkan_dt->id)
        ));
    }

    /**
     * Deletes a zaiko_henkan_dt
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $zaiko_henkan_dt = ZaikoHenkanDts::findFirstByid($id);
        if (!$zaiko_henkan_dt) {
            $this->flash->error("在庫変換データが見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "zaiko_henkan_dts",
                'action' => 'index'
            ));

            return;
        }

        foreach ($zaiko_henkan_dt->ZaikoHenkanMeisaiDts as $zaiko_henkan_meisai_dt) { // 2019/11/15 追加 井浦
            $meisai_ctlr = new ZaikoHenkanMeisaiDtsController();
            $meisai_ctlr->deleteAction($zaiko_henkan_meisai_dt->id);
        }

        $this->_bakOut($zaiko_henkan_dt, 1);

        if (!$zaiko_henkan_dt->delete()) {

            foreach ($zaiko_henkan_dt->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "zaiko_henkan_dts",
                'action' => 'search'
            ));

            return;
        }

        $this->flash->success("在庫変換データの削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "zaiko_henkan_dts",
            'action' => "index"
        ));
    }

    /**
     * Back Out a zaiko_henkan_dt
     *
     * @param string $zaiko_henkan_dt, $dlt_flg
     */
    public function _bakOut($zaiko_henkan_dt, $dlt_flg = 0)
    {

        $bak_zaiko_henkan_dt = new BakZaikoHenkanDts();
        foreach ($zaiko_henkan_dt as $fld => $value) {
            $bak_zaiko_henkan_dt->$fld = $zaiko_henkan_dt->$fld;
        }
        $bak_zaiko_henkan_dt->id = NULL;
        $bak_zaiko_henkan_dt->id_moto = $zaiko_henkan_dt->id;
        $bak_zaiko_henkan_dt->hikae_dltflg = $dlt_flg;
        $bak_zaiko_henkan_dt->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_zaiko_henkan_dt->hikae_nichiji = date("Y-m-d H:i:s");
        if (!$bak_zaiko_henkan_dt->save()) {
            foreach ($bak_zaiko_henkan_dt->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
    }

// *************************************************************************************
    /**
     * 伝票イメージで出力する。
     **/
    public function denpyouAction($id = null, $frmid = 20)
    { // $frmid = 20:移動出荷伝票
        //DBのデータを読み込む
        $zaiko_henkan_dt = ZaikoHenkanDts::findFirstByid($id);
        if (!$zaiko_henkan_dt) {
            $this->flash->error("在庫移動伝票が見つからなくなりました。id=$id");

            $this->dispatcher->forward(array(
                'controller' => "zaiko_henkan_dts",
                'action' => 'index'
            ));

            return;
        }
        $chouhyou_mr = ChouhyouMrs::findFirstByid($frmid);
        if (!$chouhyou_mr) {
            $this->flash->error("帳票idが見つからなくなりました。id=$frmid");

            $this->dispatcher->forward(array(
                'controller' => "zaiko_henkan_dts",
                'action' => 'edit',
                'params' => [$id]
            ));

            return;
        }
        if ($chouhyou_mr->ChouhyouToolKbns->name == 'EXCEL') {
            return $this->_denpyou_excel($zaiko_henkan_dt, $chouhyou_mr);
        } else if ($chouhyou_mr->ChouhyouToolKbns->name == 'PDF') {
            return $this->_denpyou_pdf($zaiko_henkan_dt, $chouhyou_mr);
        }
    }

    public function _denpyou_excel($zaiko_henkan_dt, $chouhyou_mr)
    {
        // Excel出力用ライブラリ
        include __DIR__ . '/../vendor/PHPExcel/Classes/PHPExcel.php';
        include __DIR__ . '/../vendor/PHPExcel/Classes/PHPExcel/Writer/Excel5.php';
		include __DIR__ . '/../vendor/PHPExcel/Classes/PHPExcel/Writer/Excel2007.php';
        include __DIR__ . '/../vendor/PHPExcel/Classes/PHPExcel/IOFactory.php'; //Include PHPExcel_IOFactory

        //PHPExcelオブジェクトの作成
        //新規の場合
        //$PHPExcel = new PHPExcel();

        //テンプレートの読み込み
        $objReader = PHPExcel_IOFactory::createReader("Excel2007");
        //テンプレートファイルパス
        $temp_dir = __DIR__ . '/temp/';
        $temp_path = $temp_dir . $chouhyou_mr->hinagata;
        $PHPExcel = $objReader->load($temp_path);

        //配列に設定
        //	項目名,項目ID,数0文字1日付2,参照テーブルID,参照テーブルID,…
        $flds = [
            ['id', 'id', 0,],
            ['伝票番号', 'cd', 0,],
            ['摘要', 'name', 1,],
            ['出荷日', 'henkanbi', 2,],
            ['x税率適用日', 'zeiritu_tekiyoubi', 2,],
            ['得意先', 'tokuisaki_mr_cd', 1,],
            ['在庫変換区分', 'zaiko_henkan_kbn_cd', 0,],
            ['x税転嫁', 'zei_tenka_kbn_cd', 0,],
            ['担当者', 'tantou_mr_cd', 1,],
            ['x納入期日', 'nounyuu_kijitu', 2,],
            ['指図番号', 'sasizu_dt_cd', 0,],
            ['x見積id', 'mitumori_dt_id', 0,],
            ['x得意先発注番号','saki_hacchuu_cd',0,],
            ['出荷先', 'souko_mr_cd', 1,],
            ['出荷先名', 'name', 1,'SoukoMrs',],
            ['住所１', 'juusho1', 1, 'SoukoMrs',],
            ['住所２', 'juusho2', 1, 'SoukoMrs',],
            ['ご担当者', 'gotantousha', 1, 'SoukoMrs',],
            ['敬称', 'keishou', 1, 'SoukoMrs',],
            ['TEL', 'tel', 1, 'SoukoMrs',],
            ['出荷元', 'moto_souko_mr_cd', 1,],
            ['x摘要', 'name', 1,],
            ['x出荷日', 'shukkabi', 2,],
            ['x直送先', 'chokusousaki_kbn_cd', 1,],
            ['x取引方法', 'torihiki_houhou', 1,],
            ['x合計金額名称', 'kingaku_meishou', 1,],
            ['作成者', 'sakusei_user_id', 0,],
            ['作成日時', 'created', 2,],
            ['更新者', 'kousin_user_id', 0,],
            ['更新日時', 'updated', 2,],
            ['得意先名', 'name', 1, 'TokuisakiMrs',],
            ['住所１', 'juusho1', 1, 'TokuisakiMrs',],
            ['住所２', 'juusho2', 1, 'TokuisakiMrs',],
            ['ご担当者', 'gotantousha', 1, 'TokuisakiMrs',],
            ['敬称', 'keishou', 1, 'TokuisakiMrs',],
            ['TEL', 'tel', 1, 'TokuisakiMrs',],
            ['FAX', 'fax', 1, 'TokuisakiMrs',],
            ['単価種類区分', 'tanka_shurui_kbn_cd', 0, 'TokuisakiMrs',],
            ['単価種類名', 'name', 0, 'TokuisakiMrs', 'TankaShuruiKbns',],
            ['掛率', 'kakeritu', 0, 'TokuisakiMrs',],
            ['掛残高', 'kake_zandaka', 0, 'TokuisakiMrs',],
            ['与信限度額', 'yoshin_gendogaku', 0, 'TokuisakiMrs',],
            ['額端数処理区分', 'gaku_hasuu_shori_kbn_cd', 0, 'TokuisakiMrs',],
            ['額端数処理名', 'name', 0, 'TokuisakiMrs', 'HasuuShoriKbns',],
            ['税端数処理区分', 'zei_hasuu_shori_kbn_cd', 0, 'TokuisakiMrs',],
            ['税端数処理名', 'name', 0, 'TokuisakiMrs', 'HasuuShoriKbns',],
            ['在庫変換区分名', 'name', 1, 'ZaikoHenkanKbns',],
            ['x元担当', 'moto_tantou_mr_cd', 1,],
            ['担当者名', 'name', 1, 'TantouMrs',],
            ['x納入先名', 'moto_souko_mr_cd', 1,],
            ['作成者', 'name', 1, 'SakuseiUsers',],
            ['郵便番号', 'yuubin_bangou', 1, 'SoukoMrs',],
        ];
        $meisai_flds = [
            ['id', 'id', 0,],
            ['行番', 'cd', 0,],
            ['内訳', 'henkansaki_flg', 1,],
            ['商品コード', 'shouhin_mr_cd', 1,],
            ['単位', 'tanni_mr_cd', 1,],
            ['構成', 'kousei', 1,],
            ['入数', 'irisuu', 0,],
            ['ケース', 'keisu', 0,],
            ['商品名/摘要', 'tekiyou', 1,],
            ['ロット', 'lot', 1,],
            ['個別コード', 'kobetucd', 1,],
            ['品質コード', 'hinsitu_kbn_cd', 1,],
            ['規格型番', 'kikaku', 1,],
            ['色', 'iro', 1,],
            ['色名', 'iromei', 1,],
            ['サイズ', 'size', 1,],
            ['数量', 'suuryou', 0,],
            ['数量1', 'suuryou1', 0,],
            ['単位1', 'tanni_mr1_cd', 1,],
            ['数量2', 'suuryou2', 0,],
            ['単位2', 'tanni_mr2_cd', 1,],
            ['単価区分', 'tanka_kbn', 0,],
            ['x原単価', 'gentanka', 0,],
            ['単価', 'tanka', 0,],
            ['金額', 'kingaku', 0,],
            ['x原価額', 'genkagaku', 0,],
            ['x税抜額', 'zeinukigaku', 0,],
            ['x税額', 'zeigaku', 0,],
            ['xプロジェクトコード', 'project_mr_cd', 1,],
            ['x税率コード', 'zeiritu_mr_cd', 0,],
            ['備考', 'bikou', 1,],
            ['作成者', 'sakusei_user_id', 0,],
            ['作成日時', 'created', 2,],
            ['更新者', 'kousin_user_id', 0,],
            ['更新日時', 'updated', 2,],
            ['x内訳名', 'henkansaki_flg', 1,],
            ['数量小数桁', 'suu_shousuu', 0, 'ShouhinMrs',],
            ['数量1小数桁', 'suu1_shousuu', 0, 'ShouhinMrs',],
            ['数量2小数桁', 'suu2_shousuu', 0, 'ShouhinMrs',],
            ['単価小数桁', 'tanka_shousuu', 0, 'ShouhinMrs',],
            ['在庫管理', 'zaikokanri', 0, 'ShouhinMrs',],
            ['単位名', 'name', 1, 'TanniMr2s',],
            ['数単位名', 'name', 1, 'TanniMr1s',],
            ['x税率名', 'name', 1,],
            ['x税率', 'zeiritu', 0,],
        ];

        //シートの設定
//        $PHPExcel->setActiveSheetIndex(1);  //1はDATA(DATAのシート)
        $sheet = $PHPExcel->getSheetByName("DATA");
        $gyou = 1;
        $retu = 0;
        foreach ($flds as $fld) {
            $sheet->setCellValueByColumnAndRow($retu, $gyou, $fld[0]);
            $tbl = $zaiko_henkan_dt;
            for ($i = 3; array_key_exists($i, $fld) && $fld[$i] != ''; $i++) {
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
        foreach ($zaiko_henkan_dt->ZaikoHenkanMeisaiDts as $zaiko_henkan_meisai_dt) {
            if ($zaiko_henkan_meisai_dt->henkansaki_flg == 0) {
                $genkagoukei += $zaiko_henkan_meisai_dt->kingaku;
            } else if ($zaiko_henkan_meisai_dt->henkansaki_flg == 1) {
                $goukeigaku += $zaiko_henkan_meisai_dt->kingaku;
            } else {
                $genkagoukei += $zaiko_henkan_meisai_dt->kingaku;
                $goukeigaku += $zaiko_henkan_meisai_dt->kingaku;
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
        foreach ($zaiko_henkan_dt->ZaikoHenkanMeisaiDts as $zaiko_henkan_meisai_dt) {
            $gyou++;
            $retu = 0;
            foreach ($meisai_flds as $fld) {
                $tbl = $zaiko_henkan_meisai_dt;
                for ($i = 3; array_key_exists($i, $fld) && $fld[$i] != ''; $i++) {
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
        $filename = uniqid("zaiko_henkan_" . $zaiko_henkan_dt->cd . "_", true) . '';

        // 保存ファイルパス
        $upload = __DIR__ . '/temp/';
        $path = $upload . $filename;

        // $objWriter = new PHPExcel_Writer_Excel5($PHPExcel);   //2003形式で保存
        $objWriter = PHPExcel_IOFactory::createWriter($PHPExcel, 'Excel2007');   //2007形式で保存
        $objWriter->save($path);

        // Excelファイルをクライアントに出力 ----------------------------
        $response = new \Phalcon\Http\Response(); // Redirect output to a client's web browser (Excel2005)
        // $response->setHeader('Content-Type', 'application/vnd.ms-excel');
        $response->setHeader('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        $response->setHeader('Content-Disposition', 'attachment;filename="' . "zaiko_henkan_" . $zaiko_henkan_dt->cd . '"');
        $response->setHeader('Cache-Control', 'max-age=0');
        $response->setHeader('Cache-Control', 'max-age=1'); // If you're serving to IE 9, then the following may be needed
        $response->setContent(file_get_contents($path)); //Set the content of the response
        unlink($path); // delete temp file
        return $response; //Return the response
    }

    public function _denpyou_pdf($zaiko_henkan_dt, $chouhyou_mr, $pdf = null)
    {
        require_once(__DIR__ . '/../vendor/tcpdf/tcpdf.php'); // 参考 http://www.t-net.ne.jp/~cyfis/tcpdf/ http://tcpdf.penlabo.net/method/c/Cell.html
        require_once(__DIR__ . '/../vendor/tcpdf/fpdi.php');

        $kihon_mr = KihonMrs::findFirstByid(1);
        $goukeis = [];
        $goukeis['kingaku'] = 0;
        $goukeis['genkagaku'] = 0;
        $goukeis['meisai_cnt'] = 0;
        foreach ($zaiko_henkan_dt->ZaikoHenkanMeisaiDts as $meisai) {
            $goukeis['kingaku'] += $meisai->kingaku * ($meisai->henkansaki_flg==0?0:1);
            $goukeis['genkagaku'] += $meisai->kingaku * ($meisai->henkansaki_flg==1?0:1);
            if ($chouhyou_mr->meisai_lvl == 0 // ||
//                $meisai->kingaku != 0 ||
//                $meisai->utiwake_kbn_cd == 10 ||
//                $meisai->utiwake_kbn_cd == 11 ||
//                $meisai->utiwake_kbn_cd == 12 ||
//                $meisai->utiwake_kbn_cd == 13 ||
//                $meisai->utiwake_kbn_cd == 40 ||
//                $meisai->utiwake_kbn_cd == 90 ||
//                $meisai->utiwake_kbn_cd == 23
            ) { // 2019/2/15追加　井浦　預り出荷は0円請求書発行する。
                $goukeis['meisai_cnt']++;
            }
        }
//        $goukeis['kingaku'] = $goukeis['zeinukigaku'] + $goukeis['zeigaku'];
        $goukeis['maxpage'] = (ceil($goukeis['meisai_cnt'] / $chouhyou_mr->meisai_pp)) ?? 1;
//        	$font = new TCPDF_FONTS();
//            $f = $font->addTTFfont(__DIR__ . '/../vendor/tcpdf/fonts/IPAfont00303/ipag.ttf'); // 保存したフォントファイルを指定
//            $f = $font->addTTFfont(__DIR__ . '/../vendor/tcpdf/fonts/IPAfont00303/ipagp.ttf'); // 保存したフォントファイルを指定
//            $f = $font->addTTFfont(__DIR__ . '/../vendor/tcpdf/fonts/IPAfont00303/ipam.ttf'); // 保存したフォントファイルを指定
//            $f = $font->addTTFfont(__DIR__ . '/../vendor/tcpdf/fonts/IPAfont00303/ipamp.ttf'); // 保存したフォントファイルを指定
        
        if ($pdf) {
            $renzoku = true;
        } else {
            $renzoku = false;
            $pdf = new FPDI($chouhyou_mr->yousi_houkou, 'mm', $chouhyou_mr->yousi_size, true, 'UTF-8'); // "P", "mm", "A4", true, "UTF-8"
        }
        $pgdtgyou = 0;
        for ($page = 1; $page <= $goukeis['maxpage']; $page++) {
            $pdf->SetFont('ipamp', '', 11); // 'kozminproregular'
            //$pdf->SetMargins(5,5,5);
            //$pdf->setFooterMargin(5);
            $pdf->SetAutoPageBreak(false);
            $pdf->setPrintHeader(false);
            $pdf->setPrintFooter(false);
            $pdf->AddPage();
            if ($chouhyou_mr->hinagata) {
                $pdf->setSourceFile(__DIR__ . '/../../public/img/' . $chouhyou_mr->hinagata);
                $tplIdx = $pdf->importPage(1);
                $pdf->useTemplate($tplIdx, null, null, null, null, true);
            }
            foreach ($chouhyou_mr->ChouhyouTextZokuseiMrs as $zokusei) {
                $endflg = 0;
                $gyousuu = 1;
                if ($zokusei->kmk_table == 'zaiko_henkan_meisai_dts') {
                    $gyousuu = $chouhyou_mr->meisai_pp;
                }
                $dtgyou1 = $pgdtgyou;
                $kmk_cd = $zokusei->kmk_cd;
                $belongs = explode('/', $zokusei->sanshou);
                $cols = $this->tcpdfcols($zokusei->moji_iro);
                $pdf->SetTextColor($cols[0], $cols[1], $cols[2], $cols[3]);
                $cols = $this->tcpdfcols($zokusei->nuri_iro);
                $pdf->SetFillColor($cols[0], $cols[1], $cols[2], $cols[3]);
                $cols = $this->tcpdfcols($zokusei->waku_iro);
                $pdf->SetDrawColor($cols[0], $cols[1], $cols[2], $cols[3]);
                $pdf->SetLineWidth($zokusei->waku_huto);
                $pdf->SetFont($zokusei->FontKbns->cd, $zokusei->font_style, $zokusei->font_size);
                for ($gyou = 0;
                     $gyou < $gyousuu && $page * $gyousuu - $gyousuu + $gyou < $goukeis['meisai_cnt'] && $zokusei->kmk_table == 'zaiko_henkan_meisai_dts'
                     || $gyou < 1
                ; $gyou++) {
                    $suu1 = 0;
                    $suu2 = 0;
                    if ($zokusei->kmk_table == 'kihon_mrs') {
                        $target = $kihon_mr;
                    } else if ($zokusei->kmk_table == 'zaiko_henkan_dts') {
                        $target = $zaiko_henkan_dt;
                    } else if ($zokusei->kmk_table == 'zaiko_henkan_meisai_dts') {
                        for ($dtgyou = $dtgyou1;
                             $chouhyou_mr->meisai_lvl != 0 &&
                             $dtgyou < count($zaiko_henkan_dt->ZaikoHenkanMeisaiDts); // &&
//                             $zaiko_henkan_dt->ZaikoHenkanMeisaiDts[$dtgyou]->kingaku == 0 &&
//                             $zaiko_henkan_dt->ZaikoHenkanMeisaiDts[$dtgyou]->utiwake_kbn_cd != 10 &&
//                             $zaiko_henkan_dt->ZaikoHenkanMeisaiDts[$dtgyou]->utiwake_kbn_cd != 11 &&
//                             $zaiko_henkan_dt->ZaikoHenkanMeisaiDts[$dtgyou]->utiwake_kbn_cd != 12 &&
//                             $zaiko_henkan_dt->ZaikoHenkanMeisaiDts[$dtgyou]->utiwake_kbn_cd != 13 &&
//                             $zaiko_henkan_dt->ZaikoHenkanMeisaiDts[$dtgyou]->utiwake_kbn_cd != 40 &&
//                             $zaiko_henkan_dt->ZaikoHenkanMeisaiDts[$dtgyou]->utiwake_kbn_cd != 90 &&
//                             $zaiko_henkan_dt->ZaikoHenkanMeisaiDts[$dtgyou]->utiwake_kbn_cd != 23; // 2019/2/15追加　井浦　預り出荷は0円請求書発行する。
                             $dtgyou++) {
                        }
                        $dtgyou1 = $dtgyou + 1;
                        $target = $zaiko_henkan_dt->ZaikoHenkanMeisaiDts[$dtgyou];
                        $suu1 = $target->suuryou1;
                        $suu2 = $target->suuryou2;
                    } else { // kmk_table = '' にした場合
                        $target = $zokusei;
                        if ($kmk_cd !== 'name') {
                            $target->name = $goukeis[$kmk_cd];
                            $kmk_cd = 'name';
                        }
                    }
                    foreach ($belongs as $belong) {
                        if ($belong) {
                            $target = $target->$belong;
                        }
                    }
                    $pdf->SetXY($zokusei->yoko_zahyou + $gyou * $chouhyou_mr->meisai_yokokan, $zokusei->tate_zahyou + $gyou * $chouhyou_mr->meisai_tatekan);
                    $text = $target->$kmk_cd;
                    if ($zokusei->kmk_shuushoku == 'nengappi') {
                        $text = date('Y年 n月 j日', strtotime($text));
                    } else if ($zokusei->kmk_shuushoku == 'keishou') {
                        if ($target->gotantousha || $target->yakushoku) {
                            if ($kmk_cd == 'gotantousha') {
                                $text = $target->yakushoku . ' ' . $text . ' ' . $target->keishou;
                            }
                        } else if ($target->bushomei) {
                            if ($kmk_cd == 'bushomei') {
                                $text = $text . ' ' . $target->keishou;
                            }
                        } else if ($target->name) {
                            if ($kmk_cd == 'name') {
                                $text = $text . ' ' . $target->keishou;
                            }
                        }
                    } else if ($zokusei->kmk_shuushoku == 'if_suu1') {
                        $text = $suu1 == 0 ? '' : $text;
                    } else if ($zokusei->kmk_shuushoku == 'if_suu2') {
                        $text = $suu2 == 0 ? '' : $text;
                    } else if ($zokusei->kmk_shuushoku == 'for_tank') {
                        $text = $target->tanka_kbn == 1 ? $target->suuryou1 : $target->suuryou2;
                    } else if ($zokusei->kmk_shuushoku == 'tankatan') {
                        $text = $text == '2' ? $target->TanniMr2s->name : $target->TanniMr1s->name;
                    } else if ($zokusei->kmk_shuushoku == 'jipagehe') {
                        $text = $page < $goukeis['maxpage'] ? $text : ''; // 最終ページなら空白、それ以下はkmk_cd通り…通常nameで示す
                    } else if ($zokusei->kmk_shuushoku == 'saishuup') {
                        $text = $page == $goukeis['maxpage'] ? $text : ''; // 最終ページなら表示、それ以下は空白
                    } else if ($zokusei->kmk_shuushoku == 'page') {
                        $text = $page; // ページ
                    } else if ($zokusei->kmk_shuushoku == 'maxpage') {
                        $text = $maxpage; // 最終ページ
                    } else if ($zokusei->kmk_shuushoku == 'image') {
                        $text = '';
                        $pdf->Image(
                            __DIR__ . '/../../public/' . $zokusei->sanshou . '/' . $zokusei->kmk_cd,
                            '', '',
                            $zokusei->waku_haba,
                            $zokusei->waku_taka,
                            '', '', '', true
                        );
                    }
                    if ($zokusei->suu_comma || $zokusei->suu_shousuuketa) {
                        if ($zokusei->suu_zero == 0 && (double)$text == 0) {
                            $text = '';
                        } else {
                            $text = number_format((double)$text, $zokusei->suu_shousuuketa, $zokusei->suu_shousuuten ? '.' : '', $zokusei->suu_comma ? ',' : ''); // number_format(値,小数点何位まで,小数点の表示形式,千区切りの表示形式)
                            if ($zokusei->suu_shousuuketa) {
                                $text = substr(preg_replace('/\.?0+$/', '', $text) . '     ', 0, strlen($text));
                            }
                        }
                    } else if ($zokusei->suu_zero) {
                        $text = str_pad($text, $zokusei->suu_seisuuketa, 0, STR_PAD_LEFT);
                    }
                    $pdf->Cell(
                        $zokusei->waku_haba,
                        $zokusei->waku_taka,
                        $text,
                        $zokusei->waku,
                        0,
                        $zokusei->align,
                        $zokusei->nuri_iro == '' ? 0 : 1,
                        '', //[mixed $link = '']
                        $zokusei->stretch,
                        false, //[boolean $ignore_min_height = false]
                        $zokusei->calign,
                        $zokusei->valign
                    );
                }
            }
            $pgdtgyou = $dtgyou + 1;
        }
        if (!$renzoku) {
            //保存ファイル名
            $filename = uniqid("zaiko_henkan_" . $zaiko_henkan_dt->cd . "_", false) . '.pdf';

            // 保存ファイルパス
            $path = __DIR__ . '/temp/' . $filename;

            $pdf->Output($path, 'F');
            //	I: ブラウザに出力する(既定)、保存時のファイル名が$nameで指定した名前になる。
            //	D: ブラウザで(強制的に)ダウンロードする。
            //	F: ローカルファイルとして保存する。
            //	S: PDFドキュメントの内容を文字列として出力する。

            // PDFファイルをクライアントに出力 ----------------------------
            $response = new \Phalcon\Http\Response(); // Redirect output to a client's web browser (PDF)
            $response->setHeader('Content-Type', 'application/pdf');
            $response->setHeader('Content-Disposition', 'attachment;filename="' . "zaiko_henkan_" . $zaiko_henkan_dt->cd . '"');
            $response->setHeader('Cache-Control', 'max-age=0');
            $response->setHeader('Cache-Control', 'max-age=1'); // If you're serving to IE 9, then the following may be needed
            $response->setContent(file_get_contents($path)); //Set the content of the response
            unlink($path); // delete temp file
            $this->flash->success("在庫移動伝票の印刷PDFを出力しました。");
            return $response; //Return the response
        }
    }

    public function renzoku_denpyou_pdf($zaiko_henkan_dt_ids, $chouhyou_mr)
    {
        require_once(__DIR__ . '/../vendor/tcpdf/tcpdf.php'); // 参考 http://www.t-net.ne.jp/~cyfis/tcpdf/ http://tcpdf.penlabo.net/method/c/Cell.html
        require_once(__DIR__ . '/../vendor/tcpdf/fpdi.php');
        $pdf = new FPDI($chouhyou_mr->yousi_houkou, 'mm', $chouhyou_mr->yousi_size, true, 'UTF-8'); // "P", "mm", "A4", true, "UTF-8"
        foreach ($zaiko_henkan_dt_ids as $zaiko_henkan_dt_id) {
//echo "\n<br>".$zaiko_henkan_dt_id['sentaku_chk'];
            $zaiko_henkan_dt = ZaikoHenkanDts::findFirstByid($zaiko_henkan_dt_id['sentaku_chk']);
//if ($zaiko_henkan_dt) {echo "\n<br>".$zaiko_henkan_dt->cd;}else{echo "\n<br>ERROR";}
            $this->_denpyou_pdf($zaiko_henkan_dt, $chouhyou_mr, $pdf);
        }
        //保存ファイル名
        $filename = uniqid("zaiko_henkan_", false) . '.pdf';

        // 保存ファイルパス
        $path = __DIR__ . '/temp/' . $filename;

        $pdf->Output($path, 'F');
        //	I: ブラウザに出力する(既定)、保存時のファイル名が$nameで指定した名前になる。
        //	D: ブラウザで(強制的に)ダウンロードする。
        //	F: ローカルファイルとして保存する。
        //	S: PDFドキュメントの内容を文字列として出力する。
        return $path;
    }

    public function tcpdfcols($iro)
    {
        $cols = [0, -1, -1, -1];
        if (strlen($iro) > 0) {
            $col[0] = hexdec(substr($iro, 0, 2));
        }
        if (strlen($iro) > 2) {
            $col[1] = hexdec(substr($iro, 2, 2));
        }
        if (strlen($iro) > 4) {
            $col[2] = hexdec(substr($iro, 4, 2));
        }
        if (strlen($iro) > 6) {
            $col[3] = hexdec(substr($iro, 6, 2));
        }
        return $cols;
    }
// *************************************************************************************

	public function ajaxGetAction()
	{
	    $this->view->disable();
	    $response = new \Phalcon\Http\Response();

        if (!$this->request->isAjax()) {
            echo "is not Ajax ! ";
        }
        if (!$this->request->isPost()) {
            echo "is not Post ! ";
        }

	    $zaiko_henkan_dts = ZaikoHenkanDts::find(array(
//	        'columns' => array('cd, name'), 全項目とする
	        'order' => 'cd',
	        'conditions' => ' cd LIKE ?1 AND zaiko_henkan_kbn_cd = ?2',
	        'bind' => array(1 => $this->request->getPost('cd').'%', 2 => $this->request->getPost('zaiko_henkan_kbn_cd'))
	    ));
        $res_flds = [
            "id",
            "cd",
            "nendo",
            "name",
            "henkanbi",
            "tantou_mr_cd",
            "zaiko_henkan_kbn_cd",
            "sasizu_dt_cd",
            "souko_mr_cd",
            "tokuisaki_mr_cd",
            "moto_souko_mr_cd",
            "moto_tantou_mr_cd",
            "id_moto",
            "hikae_dltflg",
            "hikae_user_id",
            "hikae_nichiji",
            "sakusei_user_id",
            "created",
            "kousin_user_id",
            "updated",
		];
        $meisai_flds = [
			"id",
			"henkansaki_flg",
			"shouhin_mr_cd",
			"tanni_mr2_cd",
			"tanni_mr1_cd",
			"irisuu",
			"suuryou1",
			"tekiyou",
			"iro",
			"iromei",
			"lot",
			"kobetucd",
			"hinsitu_kbn_cd",
			"kousei_suuryou",
			"suuryou2",
			"tanka",
			"tanka_kbn",
			"kingaku",
			"bikou",
			"updated"
        ];
	    $resData = array();
	    foreach ($zaiko_henkan_dts as $zaiko_henkan_dt) {
	        $resAdata = array();
	        foreach ($res_flds as $res_fld) {
	            $resAdata[$res_fld] = $zaiko_henkan_dt->$res_fld;
	        }
	        foreach ($zaiko_henkan_dt->ZaikoHenkanMeisaiDts as $zaiko_henkan_meisai_dt) {
		        foreach ($meisai_flds as $meisai_fld) {
		            $resAdata["meisai"][$zaiko_henkan_meisai_dt->cd][$meisai_fld] = $zaiko_henkan_meisai_dt->$meisai_fld;
		        }
		        $resAdata["meisai"][$zaiko_henkan_meisai_dt->cd]['moto_tanni_mr2_cd'] = $zaiko_henkan_meisai_dt->ShouhinMrs->tanni_mr2_cd;
		        $resAdata["meisai"][$zaiko_henkan_meisai_dt->cd]['suu_shousuu'] = $zaiko_henkan_meisai_dt->ShouhinMrs->suu_shousuu;
		        $resAdata["meisai"][$zaiko_henkan_meisai_dt->cd]['suu1_shousuu'] = $zaiko_henkan_meisai_dt->ShouhinMrs->suu1_shousuu;
		        $resAdata["meisai"][$zaiko_henkan_meisai_dt->cd]['suu2_shousuu'] = $zaiko_henkan_meisai_dt->ShouhinMrs->suu2_shousuu;
		        $resAdata["meisai"][$zaiko_henkan_meisai_dt->cd]['tanka_shousuu'] = $zaiko_henkan_meisai_dt->ShouhinMrs->tanka_shousuu;
				
	        }
	        $resAdata["seikyuusaki_name"] = $zaiko_henkan_dt->SeikyuusakiMrs->name;
	        $resData[] = $resAdata;//array('cd' => $zaiko_henkan_dt->cd, 'name' => $zaiko_henkan_dt->name);
	    }
//		print_r($resData);return;
	    //Set the content of the response
	    $response->setContent(json_encode($resData));

	    //Return the response
	    return $response;
	}

}
