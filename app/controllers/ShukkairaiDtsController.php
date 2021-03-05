<?php
 


class ShukkairaiDtsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        ControllerBase::indexCd("ShukkairaiDts", "出荷依頼データ"); //簡易検索付き一覧表示
    }

    /**
     * モーダル
     */
    public function modalAction()
    {
		ControllerBase::indexCd("ShukkairaiDts", "出荷依頼伝票", "iraibi DESC");
    }

    /**
     * Searches for shukkairai_dts
     */
    public function searchAction()
    {
        $this->persistent->parameters = null;
    }

    /*
     * 出荷依頼一覧表 Add By Nishiyama 2019/6/28
     * 取り敢えずの項目で実装するので、必要になれば追加する
     */
    public function listAction()
    {
        $db = \Phalcon\DI::getDefault()->get('db');
        if ($this->request->isPost()) {
            $param = $this->request->getPost();
            $where = "WHERE (a.utiwake_kbn_cd <> '40' AND a.utiwake_kbn_cd <> '41' AND a.utiwake_kbn_cd <> 23) ";
            //完了フラグ
            switch ($param['kanryou_flg']) {
                case '0':   //全て
                    break;
                case '1':   //完了のみ
                    $where .= "AND (a.shukka_kbn_cd = 4) ";
                    break;
                case '2':   //未完了のみ
                    $where .= "AND (a.shukka_kbn_cd = '') ";
                    break;
            }
            //受注no
            if ($param['juchuu_no'] != '') {
                $where .= "AND (c.cd = " . (int)$param['juchuu_no'] .") ";
            }
            //発注no
            if ($param['hacchuu_no'] != '') {
                $where .= "AND (n.cd = " . (int)$param['hacchuu_no'] .") ";
            }
            //依頼先コード
            if ($param['iraisaki_cd'] != '') {
                $where .= "AND (b.souko_mr_cd LIKE '${param['iraisaki_cd']}%') ";
            }
            //依頼先名称(like)
            if ($param['iraisaki_mei'] != '') {
                $where .= "AND (f.name LIKE '%${param['iraisaki_mei']}%') ";
            }
            //起票者(like)
            if ($param['user_mei'] != '') {
                $where .= "AND (i.name LIKE '%${param['user_mei']}%') ";
            }
            //商品コード(like)
            if ($param['shouhin_mr_cd'] != '') {
                $where .= "AND (a.shouhin_mr_cd LIKE '${param['shouhin_mr_cd']}%') ";
            }
            //商品名称(like)
            if ($param['shouhin_mei'] != '') {
                $where .= "AND (a.tekiyou LIKE '%${param['shouhin_mei']}%') ";
            }
            //発送先(like)
            if ($param['hassousaki'] != '') {
                $where .= "AND (b.hassousaki LIKE '%${param['hassousaki']}%') ";
            }
            //売り先(like)
            if ($param['urisaki'] != '') {
                $where .= "AND (d.name LIKE '%${param['urisaki']}%') ";
            }
            //期間を指定
            if ($param['kikan_from'] != '') {
                if ($param['kikan_to'] != '') {
                    $where .= "AND (b.iraibi BETWEEN '${param['kikan_from']}' AND '${param['kikan_to']}') ";
                }
            }
            $phql = "
			SELECT
                g.name AS shukka_kbns,b.id AS shukka_id,b.cd AS shukka_cd,b.juchuu_dt_id AS juchuu_id,b.hacchuu_dt_id AS hacchuu_id,
                c.cd AS juchuu_no,n.cd AS hacchuu_no,
                b.iraibi AS iraibi,b.souko_mr_cd AS iraisaki_cd,
                f.name AS iraisaki_mei,i.name AS user_mei,a.shouhin_mr_cd AS shouhin_mr_cd,
                a.tekiyou AS shouhin_mei,a.iro AS iroban,a.suuryou1 AS suuryou1,
                j.name AS tani1,a.suuryou2 AS suuryou2,k.name AS tani2,
                (CASE WHEN b.hassousaki_kbn_cd = 2 THEN d.name
                    WHEN b.hassousaki_kbn_cd = 3 THEN e.name
                    WHEN b.hassousaki_kbn_cd = 4 THEN f.name
                    ELSE NULL END) AS hassousaki,
                b.shukkabi AS shukkabi,a.bikou AS bikou,
                (CASE WHEN o.tanka_kbn = 1 THEN sum(m.juchuuzan_ryou1)
                      WHEN o.tanka_kbn = 2 THEN sum(m.juchuuzan_ryou2)
                      ELSE NULL END) AS juchuuzan,
                o.tanka_kbn AS taniflg,
                IF (b.juchuu_dt_id <> '',d.name,NULL) AS urisaki
                FROM shukkairai_meisai_dts AS a
                LEFT JOIN shukkairai_dts AS b ON b.id = a.shukkairai_dt_id
                LEFT JOIN juchuu_dts AS c ON c.id = b.juchuu_dt_id
                LEFT JOIN tokuisaki_mrs AS d ON d.cd = c.tokuisaki_mr_cd
                LEFT JOIN nounyuusaki_mrs AS e ON e.cd = b.hassousaki_mr_cd
                LEFT JOIN souko_mrs AS f ON f.cd = b.souko_mr_cd
                LEFT JOIN shukka_kbns AS g ON g.cd = a.shukka_kbn_cd
                LEFT JOIN tantou_mrs AS h ON h.cd = b.tantou_mr_cd
                LEFT JOIN users AS i ON i.id = b.sakusei_user_id
                LEFT JOIN tanni_mrs AS j ON j.cd = a.tanni_mr1_cd
                LEFT JOIN tanni_mrs AS k ON k.cd = a.tanni_mr2_cd
                LEFT JOIN hassousaki_kbns AS l ON l.cd = b.hassousaki_kbn_cd
                LEFT JOIN hacchuu_dts AS n ON n.id = b.hacchuu_dt_id
                left JOIN zaiko_kakunin_azukari_vws AS m on m.juchuu_dt_id = b.juchuu_dt_id AND m.shouhin_mr_cd = a.shouhin_mr_cd AND m.iro = a.iro
                right JOIN shouhin_mrs AS o ON o.cd = a.shouhin_mr_cd
                " . $where . "
                group by a.cd,a.shouhin_mr_cd,a.shukkairai_dt_id,m.juchuu_dt_id,b.hacchuu_dt_id,a.lot,a.hinsitu_kbn_cd,a.iro,b.shukkabi
                ORDER BY b.id DESC,a.cd ASC
                
            ";

            $stmt = $db->prepare($phql);
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $this->view->rows = $rows;
        } else {
            $firstDay=date("Y-m-01");
            $lastDay=date("Y-m-t");
            $where = "WHERE (a.utiwake_kbn_cd <> '40' AND a.utiwake_kbn_cd <> '41' AND a.utiwake_kbn_cd <> 23) AND (b.iraibi BETWEEN '${firstDay}' AND '${lastDay}') ";
            $phql = "
			SELECT
                g.name AS shukka_kbns,b.id AS shukka_id,b.cd AS shukka_cd,b.juchuu_dt_id AS juchuu_id,b.hacchuu_dt_id AS hacchuu_id,
                c.cd AS juchuu_no,n.cd AS hacchuu_no,
                b.iraibi AS iraibi,b.souko_mr_cd AS iraisaki_cd,
                f.name AS iraisaki_mei,i.name AS user_mei,a.shouhin_mr_cd AS shouhin_mr_cd,
                a.tekiyou AS shouhin_mei,a.iro AS iroban,a.suuryou1 AS suuryou1,
                j.name AS tani1,a.suuryou2 AS suuryou2,k.name AS tani2,
                (CASE WHEN b.hassousaki_kbn_cd = 2 THEN d.name
                    WHEN b.hassousaki_kbn_cd = 3 THEN e.name
                    WHEN b.hassousaki_kbn_cd = 4 THEN f.name
                    ELSE NULL END) AS hassousaki,
                b.shukkabi AS shukkabi,a.bikou AS bikou,
                IF (b.juchuu_dt_id <> '',d.name,NULL) AS urisaki
                FROM shukkairai_meisai_dts AS a
                LEFT JOIN shukkairai_dts AS b ON b.id = a.shukkairai_dt_id
                LEFT JOIN juchuu_dts AS c ON c.id = b.juchuu_dt_id
                LEFT JOIN tokuisaki_mrs AS d ON d.cd = c.tokuisaki_mr_cd
                LEFT JOIN nounyuusaki_mrs AS e ON e.cd = b.hassousaki_mr_cd
                LEFT JOIN souko_mrs AS f ON f.cd = b.souko_mr_cd
                LEFT JOIN shukka_kbns AS g ON g.cd = a.shukka_kbn_cd
                LEFT JOIN tantou_mrs AS h ON h.cd = b.tantou_mr_cd
                LEFT JOIN users AS i ON i.id = b.sakusei_user_id
                LEFT JOIN tanni_mrs AS j ON j.cd = a.tanni_mr1_cd
                LEFT JOIN tanni_mrs AS k ON k.cd = a.tanni_mr2_cd
                LEFT JOIN hassousaki_kbns AS l ON l.cd = b.hassousaki_kbn_cd
                LEFT JOIN hacchuu_dts AS n ON n.id = b.hacchuu_dt_id
                " . $where . "
                ORDER BY b.id DESC,a.cd ASC
            ";
            $stmt = $db->prepare($phql);
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $this->view->rows = $rows;
        }
    }

    /**
     * Displays the creation form
     */
    public function newAction($id=null, $dataname="Shukkairai")
    {
        $this->view->imax = 0;
        $hassousaki_kbns = HassousakiKbns::find(['order'=>'cd']);
        $this->view->hassousaki_kbns = $hassousaki_kbns;

        if ($id) {
            $nameDts = $dataname."Dts";
            $shukkairai_dt = $nameDts::findFirstByid($id);
            if (!$shukkairai_dt) {
                $this->flash->error("出荷依頼データが見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "shukkairai_dts",
                    'action' => 'index'
                ));

                return;
            }
            $this->_setDefault($shukkairai_dt, "new", $dataname);
            $this->tag->setDefault("id", null);
            $this->tag->setDefault("cd", null);
        } else {
			if ($this->request->isPost()) { // ポストは在庫確認からつながってくる
				$shukkairai_dt = new ShukkairaiDts();
		//		$shukkairai_dt->ShukkairaiMeisaiDts = array();
				$ShukkairaiMeisaiDts = array();
				$setshns = [
					"tanni_mr2_cd",
					"tanni_mr1_cd",
					"irisuu",
					"suuryou1",
					"lot",
					"hinsitu_kbn_cd",
					"souko_mr_cd",
					"iro",
					"iromei",
					"size"
				];
				$i = 0;
				foreach ($this->request->getPost() as $postid=>$postdt) {
					if ($postid == 'data') {
						foreach ($postdt as $meisaitb=>$meisairws ) {
							foreach ($meisairws as $meisaiid=>$meisaidts) {
								$ShukkairaiMeisaiDts[$i] = new ShukkairaiMeisaiDts();
								$ShukkairaiMeisaiDts[$i]->utiwake_kbn_cd = 10;
								foreach ($meisaidts as $meisaifd=>$meisaidt) {
									$ShukkairaiMeisaiDts[$i]->cd = $i+1;
									$ShukkairaiMeisaiDts[$i]->$meisaifd = $meisaidt;
									if ($i == 0 && $meisaifd == "shouhin_mr_cd") {
										$shouhin_mr = ShouhinMrs::findFirst(["conditions"=>"cd = ?1",
			"bind"=>[1=>$meisaidt]]);
										if ($shouhin_mr) {
											$ShukkairaiMeisaiDts[$i]->tekiyou = $shouhin_mr->name;
											$shukkairai_dt->tantou_mr_cd = $shouhin_mr->shouhin_bunrui3_kbn_cd;
											foreach ($setshns as $setshn) { // 商品関連項目設定
												$ShukkairaiMeisaiDts[$i]->$setshn = $shouhin_mr->$setshn;
											}
											if ($meisaiid == 0) {
												$shukkairai_dt->souko_mr_cd = $shouhin_mr->SoukoMrs->cd;
											}
										}
									}
								}
								$i++;
							}
						}
					} else {
						$shukkairai_dt->$postid = $postdt;
					}
				}
//				$shukkairai_dt->ShukkairaiMeisaiDts = $ShukkairaiMeisaiDts;
//echo "<br>".count($shukkairai_dt->ShukkairaiMeisaiDts);
				$this->_setDefault($shukkairai_dt, "new", $ShukkairaiMeisaiDts);
			}
        }
		$this->tag->setDefault("iraibi", date("Y-m-d"));
        $this->tag->setDefault("sakusei_user_name", $this->getDI()->getSession()->get('auth')['name']);
        $this->tag->setDefault("updated", null);

		$readonly_ctlr = new ReadonlyFieldKbnsController();
		$this->view->readonlys = $readonly_ctlr->setFormFieldReadonlys('ShukkairaiDts','inputfields');
//print_r($this->view->readonlys);
		$rewidth_ctlr = new RewidthFieldMrsController();
		$this->view->rewidths = $rewidth_ctlr->setFormFieldRewidths('ShukkairaiDts','inputfields');
    }

    /**
     * Displays the creation form
     */
    public function new0Action($id=null, $dataname="ShukkairaiDts")
    {
        $this->view->imax = 0;

        if ($id) {
            $nameDts = $dataname;
            $shukkairai_dt = $nameDts::findFirstByid($id);
            if (!$shukkairai_dt) {
                $this->flash->error("出荷依頼データが見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "shukkairai_dts",
                    'action' => 'index'
                ));

                return;
            }
            $this->_setDefault($shukkairai_dt, "new", $dataname);
            $this->tag->setDefault("id", null);
            $this->tag->setDefault("cd", null);
        }

    }

    /**
     * 修正画面から「次へ」ボタンを押したら次のコードの修正画面になる。
     */
    public function nextAction($id)
    {
        ControllerBase::nextCd($id, "shukkairai_dts", "ShukkairaiDts", "出荷依頼データ");
    }

    /**
     * 修正画面から「前へ」ボタンを押したら前のコードの修正画面になる。
     */
    public function prevAction($id = 0)
    {
        ControllerBase::prevCd($id, "shukkairai_dts", "ShukkairaiDts", "出荷依頼データ");
    }

    /**
     * Edits a shukkairai_dt
     *
     * @param string $id
     */
    public function editAction($id, $exp=null)
    {
//        if (!$this->request->isPost()) {

            $shukkairai_dt = ShukkairaiDts::findFirstByid($id);
            if (!$shukkairai_dt) {
                $this->flash->error("出荷依頼データが見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "shukkairai_dts",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->id = $shukkairai_dt->id;

            if(!empty($exp)) { // 伝票印刷やexcel出力するとき $exp=帳票ID=$chouhyou_mr_id
                $this->view->exp = $this->url->get('shukkairai_dts/denpyou/'.$id.'/'.$exp); //作成・更新後にedit画面が出たときにExcelをexportする←createAction最後・saveAction最後→app/views/index.volt
            }

            $this->_setDefault($shukkairai_dt, "edit");

            $hassousaki_kbns = HassousakiKbns::find(['order'=>'cd']);
            $this->view->hassousaki_kbns = $hassousaki_kbns;
            
//        }
		$readonly_ctlr = new ReadonlyFieldKbnsController();
		$this->view->readonlys = $readonly_ctlr->setFormFieldReadonlys('ShukkairaiDts','inputfields');
		$rewidth_ctlr = new RewidthFieldMrsController();
		$this->view->rewidths = $rewidth_ctlr->setFormFieldRewidths('ShukkairaiDts','inputfields');
    }

    /**
     * Edits a shukkairai_dt
     *
     * @param string $id
     */
    public function edit0Action($id)
    {
//        if (!$this->request->isPost()) {

            $shukkairai_dt = ShukkairaiDts::findFirstByid($id);
            if (!$shukkairai_dt) {
                $this->flash->error("出荷依頼データが見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "shukkairai_dts",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->id = $shukkairai_dt->id;

            $this->_setDefault($shukkairai_dt, "edit");
//        }
    }

    /**
     * 画面に表示するデータをセットする
     */
    public function _setDefault($shukkairai_dt, $action="edit", $meisai="Shukkairai")
    {
        $setdts = ["id",
            "cd",
            "tekiyou",
            "nendo",
            "iraibi",
            "irai_kbn_cd",
            "juchuu_dt_id",
            "hacchuu_dt_id",
            "souko_mr_cd",
            "gotantou",
            "hassousaki_kbn_cd",
            "hassousaki_mr_cd",
            "hassousaki",
            "kidukesaki_mr_cd",
            "kiduke",
            "shukkabi",
            "nouki_memo",
            "tantou_mr_cd",
            "assistant",
            "shounin_joutai_flg",
            "shounin_sha_mr_cd",
            "id_moto",
            "hikae_dltflg",
            "hikae_user_id",
            "hikae_nichiji",
            "sakusei_user_id",
            "created",
            "kousin_user_id",
            "updated",
            ];
            
		$hassousaki_n_mrs = "Hassousaki".$shukkairai_dt->hassousaki_kbn_cd."Mrs";
		$this->tag->setDefault("hassousaki", $shukkairai_dt->$hassousaki_n_mrs->name);
        foreach ($setdts as $setdt) {
            if (property_exists($shukkairai_dt, $setdt)) {
                $this->tag->setDefault($setdt, $shukkairai_dt->$setdt);
            }
        }
        if ($meisai == 'Juchuu') {
        	@$this->tag->setDefault('juchuu_dt_id', $shukkairai_dt->id);
        	@$this->tag->setDefault('juchuu_dt_cd', $shukkairai_dt->cd);
        } else {
        	@$this->tag->setDefault('juchuu_dt_cd', $shukkairai_dt->JuchuuDts->cd);
        }
        if ($meisai == 'Hacchuu') {
        	@$this->tag->setDefault('hacchuu_dt_id', $shukkairai_dt->id);
        	@$this->tag->setDefault('hacchuu_dt_cd', $shukkairai_dt->cd);
        	@$this->tag->setDefault('juchuu_dt_cd', $shukkairai_dt->juchuu_dt_cd);
        	if (count($shukkairai_dt->JuchuuDts)>0) $this->tag->setDefault('juchuu_dt_id', $shukkairai_dt->JuchuuDts[0]->id);
        } else {
        	@$this->tag->setDefault('hacchuu_dt_cd', $shukkairai_dt->HacchuuDts->cd);
        }
		if (property_exists($shukkairai_dt, "nounyuu_kijitu")) {$this->tag->setDefault("shukkabi", ($shukkairai_dt->nounyuu_kijitu == "0000-00-00")?"":$shukkairai_dt->nounyuu_kijitu);}
		if (property_exists($shukkairai_dt, "shukkabi")) {$this->tag->setDefault("shukkabi", ($shukkairai_dt->shukkabi == "0000-00-00")?"":$shukkairai_dt->shukkabi);}
		if (property_exists($shukkairai_dt, "nounyuusaki_mr_cd")) {
			@$this->tag->setDefault("hassousaki_kbn_cd", 3); // 3=納入先
			@$this->tag->setDefault("hassousaki_mr_cd", $shukkairai_dt->nounyuusaki_mr_cd);
			@$this->tag->setDefault("hassousaki", $shukkairai_dt->nounyuusaki);
		}
		@$this->tag->setDefault("tokuisaki_mr_cd", $shukkairai_dt->JuchuuDts->tokuisaki_mr_cd);
		@$this->tag->setDefault("tokuisaki_mr_name", $shukkairai_dt->JuchuuDts->TokuisakiMrs->name);
		@$this->tag->setDefault("souko_mr_name", $shukkairai_dt->SoukoMrs->name);
		if ($shukkairai_dt->hassousaki_kbn_cd == 1) {
			$target = KihonMrs::findFirstByid(1);
		} else {
			$belong = 'Hassousaki'.$shukkairai_dt->hassousaki_kbn_cd.'Mrs';
			$target = $shukkairai_dt->$belong;
		}
		$this->tag->setDefault("hassousaki_mr_name", $target->name);
		$this->tag->setDefault("sakusei_user_name", $shukkairai_dt->SakuseiUsers->name);

		//$shukkairai_zan = []; //未使用

		if (is_array($meisai)) { // 配列は在庫確認からつながってくる
			$meisai_dts = $meisai;
		} else {
			$meisai.="MeisaiDts";
			$meisai_dts = $shukkairai_dt->$meisai;
		}
		$setmss = [
			"id",
            "utiwake_kbn_cd",
            "shukka_kbn_cd",
            "shouhin_mr_cd",
            "tanni_mr_cd",
            "irisuu",
            "keisu",
            "tekiyou",
            "lot",
            "kobetucd",
            "hinsitu_kbn_cd",
            "souko_mr_cd",
            "kikaku",
            "iro",
            "iromei",
            "size",
            "suuryou",
            "suuryou1",
            "tanni_mr1_cd",
            "suuryou2",
            "tanni_mr2_cd",
            "tanka_kbn",
            "gentanka",
            "genkagaku",
            "nouki",
            "bikou",
            "updated",
		];
		$i = 0;
		foreach ($meisai_dts as $shukkairai_meisai_dt) {
			foreach ($setmss as $setms) {
				if (property_exists($shukkairai_meisai_dt, $setms)) {
					$this->tag->setDefault("data[shukkairai_meisai_dts][".$i."][".$setms."]", $shukkairai_meisai_dt->$setms);
				}
			}
//			$this->tag->setDefault("data[shukkairai_meisai_dts][".$i."][souko_mr_cd]", $shukkairai_meisai_dt->ShouhinMrs->shu_souko_mr_cd);
			if ($action == "new") {
				$this->tag->setDefault("data[shukkairai_meisai_dts][".$i."][id]", null);
				$this->tag->setDefault("data[shukkairai_meisai_dts][".$i."][shukka_kbn_cd]", null);
			}
			$this->tag->setDefault("data[shukkairai_meisai_dts][".$i."][cd]", $i+1);//行番を振りなおす
			if (property_exists($shukkairai_meisai_dt, "shouhin_mr_cd")) {
				if (property_exists($shukkairai_meisai_dt, "suuryou")) {$this->tag->setDefault("data[shukkairai_meisai_dts][".$i."][suuryou]", number_format($shukkairai_meisai_dt->suuryou,$shukkairai_meisai_dt->ShouhinMrs->suu_shousuu));}
				if (property_exists($shukkairai_meisai_dt, "suuryou1")) {$this->tag->setDefault("data[shukkairai_meisai_dts][".$i."][suuryou1]", number_format($shukkairai_meisai_dt->suuryou1,$shukkairai_meisai_dt->ShouhinMrs->suu1_shousuu));}
				if (property_exists($shukkairai_meisai_dt, "suuryou2")) {$this->tag->setDefault("data[shukkairai_meisai_dts][".$i."][suuryou2]", number_format($shukkairai_meisai_dt->suuryou2,$shukkairai_meisai_dt->ShouhinMrs->suu2_shousuu));}
				if (property_exists($shukkairai_meisai_dt, "gentanka")) {
					$this->tag->setDefault("data[shukkairai_meisai_dts][".$i."][gentanka]", number_format($shukkairai_meisai_dt->gentanka,$shukkairai_meisai_dt->ShouhinMrs->tanka_shousuu));
				} else {
				 	$this->tag->setDefault("data[shukkairai_meisai_dts][".$i."][gentanka]", number_format($shukkairai_meisai_dt->ShouhinMrs->shiire_tanka,$shukkairai_meisai_dt->ShouhinMrs->tanka_shousuu));
				}
				$this->tag->setDefault("data[shukkairai_meisai_dts][".$i."][suu_shousuu]", $shukkairai_meisai_dt->ShouhinMrs->suu_shousuu);//桁数設定用
				$this->tag->setDefault("data[shukkairai_meisai_dts][".$i."][suu1_shousuu]", $shukkairai_meisai_dt->ShouhinMrs->suu1_shousuu);//桁数設定用
				$this->tag->setDefault("data[shukkairai_meisai_dts][".$i."][suu2_shousuu]", $shukkairai_meisai_dt->ShouhinMrs->suu2_shousuu);//桁数設定用
				$this->tag->setDefault("data[shukkairai_meisai_dts][".$i."][tanka_shousuu]", $shukkairai_meisai_dt->ShouhinMrs->tanka_shousuu);//桁数設定用
				$this->tag->setDefault("data[shukkairai_meisai_dts][".$i."][zaiko_kbn]", $shukkairai_meisai_dt->ShouhinMrs->zaiko_kbn);//桁数設定用
				$this->tag->setDefault("data[shukkairai_meisai_dts][".$i."][moto_tanni_mr2_cd]", $shukkairai_meisai_dt->ShouhinMrs->tanni_mr2_cd);//桁数設定用
			}
			$i++;
		}
		$this->view->imax = $i;
    }

    /**
     * Creates a new shukkairai_dt
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "shukkairai_dts",
                'action' => 'index'
            ));

            return;
        }

        $shukkairai_dt = new ShukkairaiDts();

        $post_flds = [];
        $post_flds = ["cd",
            "tekiyou",
            "iraibi",
            "irai_kbn_cd",
            "juchuu_dt_id",
            "hacchuu_dt_id",
            "souko_mr_cd",
            "gotantou",
            "hassousaki_kbn_cd",
            "hassousaki_mr_cd",
            "hassousaki",
            "kidukesaki_mr_cd",
            "kiduke",
            "shukkabi",
            "nouki_memo",
            "tantou_mr_cd",
            "assistant",
            "shounin_joutai_flg",
            "shounin_sha_mr_cd",
            "updated",
            ];
        
		$meisai_flds = ["cd",
            "utiwake_kbn_cd",
            "shukka_kbn_cd",
            "shouhin_mr_cd",
            "tanni_mr_cd",
            "irisuu",
            "keisu",
            "tekiyou",
            "lot",
            "kobetucd",
            "hinsitu_kbn_cd",
            "souko_mr_cd",
            "kikaku",
            "iro",
            "iromei",
            "size",
            "suuryou",
            "suuryou1",
            "tanni_mr1_cd",
            "suuryou2",
            "tanni_mr2_cd",
            "tanka_kbn",
            "gentanka",
            "genkagaku",
            "nouki",
            "bikou",
		];

		$meisai_nums = [
			"irisuu",
			"suuryou1",
			"suuryou2",
			"gentanka",
			"tanka",
			"genkagaku",
		];

        $thisPost=[];

        foreach ($post_flds as $post_fld) {
            $shukkairai_dt->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }
        
        $meisai = $this->request->getPost("data");
        
		$zeinuki_chousei_gaku = $this->request->getPost("zeinuki_chousei_gaku"); // 消費税調整と税抜額調整が必要な場合はする
		if ($zeinuki_chousei_gaku < 0) {$zeinuki_chousei_muki = -1;} else {$zeinuki_chousei_muki = 1;}
		$zei_chousei_gaku = $this->request->getPost("zei_chousei_gaku");
		if ($zei_chousei_gaku < 0) {$zei_chousei_muki = -1;} else {$zei_chousei_muki = 1;}

        $meisaicnv = array();
        $shukkairai_dt->ShukkairaiMeisaiDts = array();
        $ShukkairaiMeisaiDts = array();
        $i = 0;

        foreach ($meisai["shukkairai_meisai_dts"] as $shukkairai_meisai_dt) {
            if ($shukkairai_meisai_dt["shouhin_mr_cd"] !== '' && $shukkairai_meisai_dt["cd"] !== '' && $shukkairai_meisai_dt["cd"] !== '0'  && $shukkairai_meisai_dt["utiwake_kbn_cd"] !== '') {
//            if ($shukkairai_meisai_dt["shouhin_mr_cd"] != '') {
                $meisaicnv[$i] = [];
                foreach ($meisai_nums as $meisai_num) {
                    $meisaicnv[$i][$meisai_num]=str_replace(',','',$shukkairai_meisai_dt[$meisai_num]);//カンマ除去
                }
	            if ($zeinuki_chousei_gaku != 0) { // 消費税調整と税抜額調整が必要な場合はする
	            	$meisaicnv[$i]["zeinukigaku"] += $zeinuki_chousei_muki;
	            	$zeinuki_chousei_gaku -= $zeinuki_chousei_muki;
	            }
	            if ($zei_chousei_gaku != 0) {
	            	$meisaicnv[$i]["zeigaku"] += $zei_chousei_muki;
	            	$zei_chousei_gaku -= $zei_chousei_muki;
	            }
                $ShukkairaiMeisaiDts[$i] = new ShukkairaiMeisaiDts();
                foreach ($meisai_flds as $meisai_fld) {
                    $ShukkairaiMeisaiDts[$i]->$meisai_fld = array_key_exists($meisai_fld, $meisaicnv[$i])?$meisaicnv[$i][$meisai_fld]:$shukkairai_meisai_dt[$meisai_fld]??'';
                    //更新日時や更新者はModelに定義してある
                }
                $i++;
            }
        }
        $shukkairai_dt->ShukkairaiMeisaiDts = $ShukkairaiMeisaiDts;

		/* 伝票番号付番または再設定 */
		$den_ban_ctrl = new DenpyouBangouMrsController(); //伝票番号マスタコントローラ
		$nendo_ban = $den_ban_ctrl->countup('shukkairai', 0, $shukkairai_dt->iraibi); // 新規なので$shukkairai_dt->cd使わない
		if (!$nendo_ban['nendo']) {
            $this->flash->error("エラー:年度が未登録（日付が今年か昨年以外は不可）。" . $shukkairai_dt->iraibi);
            $this->dispatcher->forward(array(
                'controller' => "shukkairai_dts",
                'action' => 'edit',
                'params' => array($id)
            ));
		}
		$shukkairai_dt->cd = $nendo_ban['bangou'];
		$shukkairai_dt->nendo = $nendo_ban['nendo'];

        if (!$shukkairai_dt->save()) {
            foreach ($shukkairai_dt->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "shukkairai_dts",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("出荷依頼伝票の作成が完了しました。");

        $chouhyou_mr_id=$this->request->getPost('chouhyou_mr_id'); // 帳票マスタのid

        $this->dispatcher->forward(array(
            'controller' => "shukkairai_dts",
            'action' => 'edit',
            'params' => array($shukkairai_dt->id, $chouhyou_mr_id)
        ));
    }

    /**
     * Saves a shukkairai_dt edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "shukkairai_dts",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $shukkairai_dt = ShukkairaiDts::findFirstByid($id);

        if (!$shukkairai_dt) {
            $this->flash->error("出荷依頼データが見つからなくなりました。" . $id);

            $this->dispatcher->forward(array(
                'controller' => "shukkairai_dts",
                'action' => 'index'
            ));

            return;
        }

        if ($shukkairai_dt->updated !== $this->request->getPost("updated")) {
            $this->flash->error("他のプロセスから出荷依頼データが変更されたため更新を中止しました。"
                . $id . ",uid=" . $shukkairai_dt->kousin_user_id . " tb=" . $shukkairai_dt->updated ." pt=" . $this->request->getPost("updated"));

            $this->dispatcher->forward(array(
                'controller' => "shukkairai_dts",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $post_flds = [];
        $post_flds = ["cd",
            "tekiyou",
            "iraibi",
            "irai_kbn_cd",
            "juchuu_dt_id",
            "hacchuu_dt_id",
            "souko_mr_cd",
            "gotantou",
            "hassousaki_kbn_cd",
            "hassousaki_mr_cd",
            "hassousaki",
            "kidukesaki_mr_cd",
            "kiduke",
            "shukkabi",
            "nouki_memo",
            "tantou_mr_cd",
            "assistant",
            "shounin_joutai_flg",
            "shounin_sha_mr_cd",
            "updated",
            ];

		$meisai_flds = [
			"id",
            "cd",
            "utiwake_kbn_cd",
            "shukka_kbn_cd",
            "shouhin_mr_cd",
            "tanni_mr_cd",
            "irisuu",
            "keisu",
            "tekiyou",
            "lot",
            "kobetucd",
            "hinsitu_kbn_cd",
            "souko_mr_cd",
            "kikaku",
            "iro",
            "iromei",
            "size",
            "suuryou",
            "suuryou1",
            "tanni_mr1_cd",
            "suuryou2",
            "tanni_mr2_cd",
            "tanka_kbn",
            "gentanka",
            "genkagaku",
            "nouki",
            "bikou",
		];

		$meisai_nums = [
			"irisuu",
			"suuryou1",
			"suuryou2",
			"gentanka",
			"genkagaku",
		];

        if ($shukkairai_dt->updated !== $this->request->getPost("updated")) {
            $this->flash->error("他のプロセスから出荷依頼伝票が変更されたため更新を中止しました。"
                . $id . ",uid=" . $shukkairai_dt->kousin_user_id . " tb=" . $shukkairai_dt->updated ." pt=" . $this->request->getPost("updated"));

            $this->dispatcher->forward(array(
                'controller' => "shukkairai_dts",
                'action' => 'index'
            ));

            return;
        }

        $meisai = $this->request->getPost("data");
        $i = 0;
        foreach ($meisai["shukkairai_meisai_dts"] as $shukkairai_meisai_dt) {
            if ((int)$shukkairai_meisai_dt["id"] !== 0) {
                if ((int)$shukkairai_dt->ShukkairaiMeisaiDts[$i]->id !== (int)$shukkairai_meisai_dt["id"] ||
                    $shukkairai_dt->ShukkairaiMeisaiDts[$i]->updated !== $shukkairai_meisai_dt["updated"]) {
                    $this->flash->error("他のプロセスから出荷依頼伝票明細が変更されたため中止しました。"
                        . $id . ",id=" . $shukkairai_dt->ShukkairaiMeisaiDts[$i]->id . ",uid=" . $shukkairai_dt->ShukkairaiMeisaiDts[$i]->kousin_user_id
                        . " tb=" . $shukkairai_dt->ShukkairaiMeisaiDts[$i]->updated ." pt=" . $shukkairai_meisai_dt["updated"]);

                    $this->dispatcher->forward(array(
                        'controller' => "shukkairai_dts",
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
            if ((array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld)) !== $shukkairai_dt->$post_fld) {
//                echo $post_fld.'/'.$this->request->getPost($post_fld).'/'.(array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld)). '!=' . $shukkairai_dt->$post_fld;//型不明のため試行錯誤
                $chg_flg = 1;
                break;
            }
        }

        $meisaicnv = array();
        $chg_flgs = array();
        $i = 0;
        foreach ($meisai["shukkairai_meisai_dts"] as $shukkairai_meisai_dt) {
            $meisaicnv[$i] = [];
            foreach ($meisai_nums as $meisai_num) {
                $meisaicnv[$i][$meisai_num]=(double)str_replace(',','',$shukkairai_meisai_dt[$meisai_num]);//カンマ除去
            }
            $chg_flgs[$i] = 0;//変更ないかも
            if ((int)$shukkairai_meisai_dt["cd"] === 0 && (int)$shukkairai_meisai_dt["id"] !== 0) { // 削除の条件
                $chg_flg = 1;
                $chg_flgs[$i] = 2;//削除
            } else if ((int)$shukkairai_meisai_dt["id"] === 0) { // echo ($shukkairai_meisai_dt["id"] === "")?"null":"0";//nullの伝わり方
                if ((int)$shukkairai_meisai_dt["cd"] !== 0 && (int)$shukkairai_meisai_dt["utiwake_kbn_cd"] !== 0) {
                    $chg_flg = 1;
                    $chg_flgs[$i] = 1;
// $this->flash->error("追加！" . $i);
                }
            } else if ((int)$shukkairai_meisai_dt["cd"] !== 0) {
                foreach ($meisai_flds as $meisai_fld) {
                    if ((array_key_exists($meisai_fld, $meisaicnv[$i])?$meisaicnv[$i][$meisai_fld]:$shukkairai_meisai_dt[$meisai_fld]).'' !== $shukkairai_dt->ShukkairaiMeisaiDts[$i]->$meisai_fld) {
//							echo $meisai_fld.'/'.$shukkairai_meisai_dt[$meisai_fld].'/'.(array_key_exists($meisai_fld, $meisaicnv[$i])?$meisaicnv[$i][$meisai_fld]:$shukkairai_meisai_dt[$meisai_fld]).'!=='.$shukkairai_dt->ShukkairaiMeisaiDts[$i]->$meisai_fld;//型不明のため試行錯誤
                        $chg_flg = 1;
                        $chg_flgs[$i] = 1;
// $this->flash->error("変化！" . $i.' '.$meisai_fld);
                        break;
                    }
                }
            }
            $i++;
        }

        $chouhyou_mr_id=$this->request->getPost('chouhyou_mr_id'); // 帳票マスタのid

        if ($chg_flg === 0) {
        	if ($chouhyou_mr_id) {
                $this->flash->success("印刷データを出力します。" . $id);
	            $this->dispatcher->forward(array(
	                "controller" => "shukkairai_dts",
	                "action" => "edit",
	                "params" => array($shukkairai_dt->id, $chouhyou_mr_id)
	            ));

	            return;
	        }

            $this->flash->error("変更がありません。" . $id);

            $this->dispatcher->forward(array(
                "controller" => "shukkairai_dts",
                "action" => "edit",
                "params" => array($shukkairai_dt->id)
            ));

            return;
        }

		$this->_bakOut($shukkairai_dt, 0, $chg_flgs);

        foreach ($post_flds as $post_fld) {
            $shukkairai_dt->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }
		/* 伝票番号付番または再設定 */
		$den_ban_ctrl = new DenpyouBangouMrsController(); //伝票番号マスタコントローラ
		$nendo_ban = $den_ban_ctrl->countup('shukkairai', $shukkairai_dt->cd, $shukkairai_dt->iraibi, $shukkairai_dt->nendo);
		if (!$nendo_ban['nendo']) {
            $this->flash->error("エラー:年度が未登録（日付が今年か昨年以外は不可）。" . $shukkairai_dt->iraibi);
            $this->dispatcher->forward(array(
                'controller' => "shukkairai_dts",
                'action' => 'edit',
                'params' => array($id)
            ));
		}
		$shukkairai_dt->cd = $nendo_ban['bangou'];
		$shukkairai_dt->nendo = $nendo_ban['nendo'];

        $i = 0;
        foreach ($meisai["shukkairai_meisai_dts"] as $shukkairai_meisai_dt) {
            if ($chg_flgs[$i] === 2) { // 削除でないとき
                $meisai_ctlr = new ShukkairaiMeisaiDtsController();
                $meisai_ctlr->deleteAction($shukkairai_meisai_dt["id"]);
            } else {
                if ((int)$shukkairai_meisai_dt["id"] !== 0) {
                    $ShukkairaiMeisaiDts[$i] = $shukkairai_dt->ShukkairaiMeisaiDts[$i];
                }
                if ($chg_flgs[$i] === 1) { // 更新なら
                    if ((int)$shukkairai_meisai_dt["id"] === 0) {
                        $ShukkairaiMeisaiDts[$i] = new ShukkairaiMeisaiDts();
                    }
                    foreach ($meisai_flds as $meisai_fld) {
                        $ShukkairaiMeisaiDts[$i]->$meisai_fld = array_key_exists($meisai_fld, $meisaicnv[$i])?$meisaicnv[$i][$meisai_fld]:$shukkairai_meisai_dt[$meisai_fld]??'';
                        //更新日時や更新者はModelに定義してある
                    }
                }
            }
            $i++;
        }
        $shukkairai_dt->ShukkairaiMeisaiDts = $ShukkairaiMeisaiDts; // 明細データをドッキング
/** デバッグ
 echo "<pre>";
 var_dump($shukkairai_dt->cd);
 echo "</pre>";
 return;
*/
        //2019/9/13 発注番号idが残ると発注番号を引っ張るため
        if ($this->request->getPost('hacchuu_dt_cd') === '') {
            $shukkairai_dt->hacchuu_dt_id = '';
        }
        if (!$shukkairai_dt->save()) {

            foreach ($shukkairai_dt->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "shukkairai_dts",
                'action' => 'edit',
                'params' => array($shukkairai_dt->id)
            ));

            return;
        }

        $this->flash->success("出荷依頼伝票の情報を更新しました。".$chouhyou_mr_id);

        $this->dispatcher->forward(array(
            'controller' => "shukkairai_dts",
            'action' => 'edit',
            'params' => array($shukkairai_dt->id, $chouhyou_mr_id)
        ));
    }

    /**
     * Deletes a shukkairai_dt
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $shukkairai_dt = ShukkairaiDts::findFirstByid($id);
        if (!$shukkairai_dt) {
            $this->flash->error("出荷依頼データが見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "shukkairai_dts",
                'action' => 'index'
            ));

            return;
        }

        foreach ($shukkairai_dt->HacchuuMeisaiDts as $shukkairai_meisai_dt) {
            $meisai_ctlr = new HacchuuMeisaiDtsController();
            $meisai_ctlr->deleteAction($shukkairai_meisai_dt->id);
        }

        $this->_bakOut($shukkairai_dt, 1);

        if (!$shukkairai_dt->delete()) {

            foreach ($shukkairai_dt->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "shukkairai_dts",
                'action' => 'search'
            ));

            return;
        }

        $this->flash->success("出荷依頼データの削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "shukkairai_dts",
            'action' => "index"
        ));
    }

    /**
     * Back Out a shukkairai_dt
     *
     * @param string $shukkairai_dt, $dlt_flg
     */
    public function _bakOut($shukkairai_dt, $dlt_flg = 0)
    {

        $bak_shukkairai_dt = new BakShukkairaiDts();
        foreach ($shukkairai_dt as $fld => $value) {
            $bak_shukkairai_dt->$fld = $shukkairai_dt->$fld;
        }
        $bak_shukkairai_dt->id = NULL;
        $bak_shukkairai_dt->moto_id = $shukkairai_dt->id;
        $bak_shukkairai_dt->hikae_dltflg = $dlt_flg;
        $bak_shukkairai_dt->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_shukkairai_dt->hikae_nitiji = date("Y-m-d H:i:s");
        if (!$bak_shukkairai_dt->save()) {
            foreach ($bak_shukkairai_dt->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
    }

/**
 * 伝票イメージで出力する。
**/
	public function denpyouAction($id = null,$frmid = 16){ // $frmid = 16:出荷依頼
		//DBのデータを読み込む
// echo "<br>A1";
        $shukkairai_dt = ShukkairaiDts::findFirstByid($id);
        if (!$shukkairai_dt) {
            $this->flash->error("出荷依頼伝票が見つからなくなりました。id=$id");

            $this->dispatcher->forward(array(
                'controller' => "shukkairai_dts",
                'action' => 'index'
            ));

            return;
        }
// echo "<br>A2";
        $chouhyou_mr = ChouhyouMrs::findFirstByid($frmid);
        if (!$chouhyou_mr) {
            $this->flash->error("帳票idが見つからなくなりました。id=$frmid");

            $this->dispatcher->forward(array(
                'controller' => "shukkairai_dts",
                'action' => 'edit',
                'params' => [$id]
            ));

            return;
        }
// echo "<br>A3 ".$chouhyou_mr->name;
// echo "<br>A3 ".$chouhyou_mr->ChouhyouToolKbns->name;
		if ($chouhyou_mr->ChouhyouToolKbns->name == 'EXCEL') {
// echo "<br>A31";
			return $this->_denpyou_excel($shukkairai_dt, $chouhyou_mr);
		} else if ($chouhyou_mr->ChouhyouToolKbns->name == 'PDF') {
// echo "<br>A32";
			return $this->_denpyou_pdf($shukkairai_dt, $chouhyou_mr);
		}
	}

    public function _denpyou_excel($shukkairai_dt, $chouhyou_mr)
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
            ['依頼番号', 'cd', 0,],
            ['摘要', 'tekiyou', 1,],
            ['依頼日', 'iraibi', 2,],
            ['依頼区分', 'irai_kbn_cd', 0,],
            ['受注id', 'juchuu_dt_id', 0,],
            ['発注id', 'hacchuu_dt_id', 0,],
            ['依頼先倉庫', 'souko_mr_cd', 1,],
            ['ご担当者', 'gotantou', 1,],
            ['発送先区分', 'hassousaki_kbn_cd', 0,],
            ['発送先', 'hassousaki_mr_cd', 1,],
            ['発送先名', 'hassousaki', 1,],
            ['郵便番号', 'yuubin_bangou', 1, 'HassousakiMrs',],
            ['住所１', 'juusho1', 1, 'HassousakiMrs',],
            ['住所２', 'juusho2', 1, 'HassousakiMrs',],
            ['敬称', 'keishou', 1, 'HassousakiMrs',],
            ['TEL', 'tel', 1, 'HassousakiMrs',],
            ['気付先', 'kidukesaki_mr_cd', 1,],
            ['気付', 'kiduke', 1,],
            ['出荷日', 'shukkabi', 2,],
            ['納期メモ', 'nouki_memo', 1,],
            ['担当者', 'tantou_mr_cd', 1,],
            ['アシスタント', 'assistant', 1,],
            ['作成者', 'sakusei_user_id', 0,],
            ['作成日時', 'created', 2,],
            ['更新者', 'kousin_user_id', 0,],
            ['更新日時', 'updated', 2,],
            ['TEL', 'tel', 1, 'SoukoMrs',],
            ['FAX', 'fax', 1, 'SoukoMrs',],
            ['作成者', 'name', 1, 'SakuseiUsers',],
        ];
        $meisai_flds = [
            ['id', 'id', 0,],
            ['行番', 'cd', 0,],
            ['内訳', 'utiwake_kbn_cd', 1,],
            ['出荷区分', 'shukka_kbn_cd', 1,],
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
            ['原単価', 'gentanka', 0,],
            ['原価額', 'genkagaku', 0,],
            ['備考', 'bikou', 1,],
            ['作成者', 'sakusei_user_id', 0,],
            ['作成日時', 'created', 2,],
            ['更新者', 'kousin_user_id', 0,],
            ['更新日時', 'updated', 2,],
            ['内訳名', 'name', 1, 'UtiwakeKbns',],
            ['数量小数桁', 'suu_shousuu', 0, 'ShouhinMrs',],
            ['数量1小数桁', 'suu1_shousuu', 0, 'ShouhinMrs',],
            ['数量2小数桁', 'suu2_shousuu', 0, 'ShouhinMrs',],
            ['単価小数桁', 'tanka_shousuu', 0, 'ShouhinMrs',],
            ['在庫管理', 'zaikokanri', 0, 'ShouhinMrs',],
            ['単位名', 'name', 1, 'TanniMrs',],
            ['数単位名', 'name', 1, 'SuuTanniMrs',],
        ];

        //シートの設定
//        $PHPExcel->setActiveSheetIndex(1);  //1はDATA(DATAのシート)
        $sheet = $PHPExcel->getSheetByName("DATA");
        $gyou = 1;
        $retu = 0;
        foreach ($flds as $fld) {
            $sheet->setCellValueByColumnAndRow($retu, $gyou, $fld[0]);
            $tbl = $shukkairai_dt;
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
        foreach ($shukkairai_dt->ShukkairaiMeisaiDts as $shukkairai_meisai_dt) {
            if ($shukkairai_meisai_dt->utiwake_kbn_cd == 30) {
                $sekisangaku += $shukkairai_meisai_dt->kingaku;
            } else {
                $goukeigaku += $shukkairai_meisai_dt->kingaku;
                $genkagoukei += $shukkairai_meisai_dt->genkagaku;
                $zeinukigaku += $shukkairai_meisai_dt->zeinukigaku;
                $zeigaku += $shukkairai_meisai_dt->zeigaku;
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
        foreach ($shukkairai_dt->ShukkairaiMeisaiDts as $shukkairai_meisai_dt) {
            $gyou++;
            $retu = 0;
            foreach ($meisai_flds as $fld) {
                $tbl = $shukkairai_meisai_dt;
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
        $filename = uniqid("shukkairai_" . $shukkairai_dt->cd . "_", true) . '';

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
        $response->setHeader('Content-Disposition', 'attachment;filename="' . "shukkairai_" . $shukkairai_dt->cd . '"');
        $response->setHeader('Cache-Control', 'max-age=0');
        $response->setHeader('Cache-Control', 'max-age=1'); // If you're serving to IE 9, then the following may be needed
        $response->setContent(file_get_contents($path)); //Set the content of the response
        unlink($path); // delete temp file
        return $response; //Return the response
    }

	public function _denpyou_pdf($shukkairai_dt, $chouhyou_mr, $pdf=null){
		require_once(__DIR__ . '/../vendor/tcpdf/tcpdf.php'); // 参考 http://www.t-net.ne.jp/~cyfis/tcpdf/ http://tcpdf.penlabo.net/method/c/Cell.html
		require_once(__DIR__ . '/../vendor/tcpdf/fpdi.php');
// echo "<br>A4";

		$kihon_mr = KihonMrs::findFirstByid(1);
		$goukeis = [];
		$goukeis['meisai_cnt'] = 0;
		foreach ($shukkairai_dt->ShukkairaiMeisaiDts as $meisai) {
			if ($chouhyou_mr->meisai_lvl == 0 || $meisai->utiwake_kbn_cd != 41) {
				$goukeis['meisai_cnt']++;
			}
		}
// echo "<br>A5";
		$goukeis['maxpage'] = (ceil($goukeis['meisai_cnt'] / $chouhyou_mr->meisai_pp))??1;
		/*	$font = new TCPDF_FONTS();
			$f = $font->addTTFfont(__DIR__ . '/../vendor/tcpdf/fonts/IPAfont00303/ipag.ttf'); // 保存したフォントファイルを指定
			$f = $font->addTTFfont(__DIR__ . '/../vendor/tcpdf/fonts/IPAfont00303/ipagp.ttf'); // 保存したフォントファイルを指定
			$f = $font->addTTFfont(__DIR__ . '/../vendor/tcpdf/fonts/IPAfont00303/ipam.ttf'); // 保存したフォントファイルを指定
			$f = $font->addTTFfont(__DIR__ . '/../vendor/tcpdf/fonts/IPAfont00303/ipamp.ttf'); // 保存したフォントファイルを指定
		*/
		if ($pdf) {
			$renzoku = true;
		} else {
			$renzoku = false;
			$pdf = new FPDI($chouhyou_mr->yousi_houkou, 'mm', $chouhyou_mr->yousi_size, true, 'UTF-8'); // "P", "mm", "A4", true, "UTF-8"
		}
		$pgdtgyou = 0;
// echo "<br>A6";

		for ($page = 1; $page <= $goukeis['maxpage']; $page++){
// echo '<br>A '.$page;
			$pdf->SetFont('ipamp','',11); // 'kozminproregular'
			//$pdf->SetMargins(5,5,5);
			//$pdf->setFooterMargin(5);
			$pdf->SetAutoPageBreak(false);
			$pdf->setPrintHeader(false);
			$pdf->setPrintFooter(false);
			$pdf->AddPage();
// echo '<br>B ';
			if ($chouhyou_mr->hinagata) {
// echo '<br>C ';
				$pdf->setSourceFile(__DIR__ . '/../../public/img/' . $chouhyou_mr->hinagata);
				$tplIdx = $pdf->importPage(1);
				$pdf->useTemplate($tplIdx, null, null, null, null, true);
			}
			foreach ($chouhyou_mr->ChouhyouTextZokuseiMrs as $zokusei) {
// echo '<br>D '.$zokusei->kmk_cd;
				$endflg = 0;
				$gyousuu = 1;
				if ($zokusei->kmk_table == 'shukkairai_meisai_dts') {
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
// echo '<br>E ';
				for ($gyou = 0;
					$gyou < $gyousuu
				 && $page * $gyousuu - $gyousuu + $gyou < $goukeis['meisai_cnt']
				 && $zokusei->kmk_table == 'shukkairai_meisai_dts'
				 && substr($zokusei->kmk_shuushoku,0,3) != 'fx_'
				 || $gyou < 1
				 ;	$gyou++) {
// echo '<br>F '.$gyou;
					$suu1 = 0;
					$suu2 = 0;
					if ($zokusei->kmk_table == 'kihon_mrs') {
						$target = $kihon_mr;
					} else if ($zokusei->kmk_table == 'shukkairai_dts') {
						$target = $shukkairai_dt;
					} else if ($zokusei->kmk_table == 'shukkairai_meisai_dts' && substr($zokusei->kmk_shuushoku,0,3) == 'fx_') { // 追加2019/5/13井浦
						for ($dtgyou = 0;
							$chouhyou_mr->meisai_lvl != 0 &&
							$dtgyou < count($shukkairai_dt->ShukkairaiMeisaiDts) &&
							!($shukkairai_dt->ShukkairaiMeisaiDts[$dtgyou]->utiwake_kbn_cd == 41 && // メモに限る
								'fx_'.$shukkairai_dt->ShukkairaiMeisaiDts[$dtgyou]->shouhin_mr_cd == $zokusei->kmk_shuushoku); // fx_商品コードと一致なら
							$dtgyou++) {}
						if ($dtgyou < count($shukkairai_dt->ShukkairaiMeisaiDts)) {
							$target = $shukkairai_dt->ShukkairaiMeisaiDts[$dtgyou];
						} else {
							$target = new ShukkairaiMeisaiDts();
						}
					} else if ($zokusei->kmk_table == 'shukkairai_meisai_dts') {
						for ($dtgyou = $dtgyou1;
							$chouhyou_mr->meisai_lvl != 0 &&
							$dtgyou < count($shukkairai_dt->ShukkairaiMeisaiDts) &&
							$shukkairai_dt->ShukkairaiMeisaiDts[$dtgyou]->utiwake_kbn_cd == 41;
							$dtgyou++) {}
						$dtgyou1 = $dtgyou + 1;
						$target = $shukkairai_dt->ShukkairaiMeisaiDts[$dtgyou];
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
						if ($belong == 'Hassousaki') {
							if ($target->hassousaki_kbn_cd == 1) {
								$target = $kihon_mr;
							} else {
								$belong = 'Hassousaki'.$target->hassousaki_kbn_cd.'Mrs';
								$target = $target->$belong;
							}
						} else {
							if ($belong) {$target = $target->$belong;}
						}
					}
					$pdf->SetXY($zokusei->yoko_zahyou + $gyou * $chouhyou_mr->meisai_yokokan, $zokusei->tate_zahyou + $gyou * $chouhyou_mr->meisai_tatekan);
					$text = $target->$kmk_cd;
					if ($zokusei->kmk_shuushoku == 'nengappi') {
						$text = $text=='0000-00-00'||$text==''?'':date('Y年 n月 j日', strtotime($text));
					} else if ($zokusei->kmk_shuushoku == 'keishou') {
						$text = $text.' '.$target->keishou;
					} else if ($zokusei->kmk_shuushoku == 'if_suu1') {
						$text = $suu1==0?'':$text;
					} else if ($zokusei->kmk_shuushoku == 'if_suu2') {
						$text = $suu2==0?'':$text;
					} else if ($zokusei->kmk_shuushoku == 'for_tank') {
						$text = $target->tanka_kbn==1?$target->suuryou1:$target->suuryou2;
					} else if ($zokusei->kmk_shuushoku == 'tankatan') {
						$text = $text=='1'?($target->suuryou1==0?'':$target->TanniMr1s->name):($target->suuryou2==0?'':$target->TanniMr2s->name);
					} else if ($zokusei->kmk_shuushoku == 'jipagehe') {
						$text = $page < $goukeis['maxpage']?$text:''; // 最終ページなら空白、それ以下はkmk_cd通り…通常nameで示す
					} else if ($zokusei->kmk_shuushoku == 'saishuup') {
						$text = $page == $goukeis['maxpage']?$text:''; // 最終ページなら表示、それ以下は空白
					} else if ($zokusei->kmk_shuushoku == 'page') {
						$text = $page; // ページ
					} else if ($zokusei->kmk_shuushoku == 'maxpage') {
						$text = $maxpage; // 最終ページ
					} else if ($zokusei->kmk_shuushoku == 'image') {
						$text = '';
						$pdf->Image(
							__DIR__ . '/../../public/'.$zokusei->sanshou.'/'.$zokusei->kmk_cd,
							'','',
							$zokusei->waku_haba,
							$zokusei->waku_taka,
							'','','',true
						);
					}
					if ($zokusei->suu_comma || $zokusei->suu_shousuuketa) {
						if ($zokusei->suu_zero == 0 && (double)$text == 0) {
							$text = '';
						} else {
							$text = number_format((double)$text,$zokusei->suu_shousuuketa,$zokusei->suu_shousuuten?'.':'',$zokusei->suu_comma?',':''); // number_format(値,小数点何位まで,小数点の表示形式,千区切りの表示形式)
							if ($zokusei->suu_shousuuketa) {
							    $text = substr(preg_replace('/\.?0+$/', '', $text) . '     ', 0, strlen($text));
							}
						}
					} else if ($zokusei->suu_zero) {
						$text = str_pad($text, $zokusei->suu_seisuuketa, 0, STR_PAD_LEFT);
					}
// echo '<br>G '.$text;
					$pdf->Cell(
						$zokusei->waku_haba,
						$zokusei->waku_taka,
						$text,
						$zokusei->waku,
						0,
						$zokusei->align,
						$zokusei->nuri_iro==''?0:1,
						'', //[mixed $link = '']
						$zokusei->stretch,
						false, //[boolean $ignore_min_height = false]
						$zokusei->calign,
						$zokusei->valign
					);
// echo '<br>H '.$gyou;
				}
			}
			$pgdtgyou = $dtgyou + 1;
// echo '<br>I ';
		}
// echo '<br>J ';
// return;
		if (!$renzoku) {
			//保存ファイル名
			$filename = uniqid("shukkairai_".$shukkairai_dt->cd."_", false) . '.pdf';
			
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
			$response->setHeader('Content-Disposition', 'attachment;filename="' . "shukkairai_".$shukkairai_dt->cd . '.pdf');
			$response->setHeader('Cache-Control', 'max-age=0');
			$response->setHeader('Cache-Control', 'max-age=1'); // If you're serving to IE 9, then the following may be needed 
			$response->setContent(file_get_contents($path)); //Set the content of the response 
			unlink($path); // delete temp file 
	        $this->flash->success("出荷依頼伝票の印刷PDFを出力しました。");
			return $response; //Return the response 
		}
 echo '<br>K ';
	}

	public function renzoku_denpyou_pdf($shukkairai_dt_ids, $chouhyou_mr) {
		require_once(__DIR__ . '/../vendor/tcpdf/tcpdf.php'); // 参考 http://www.t-net.ne.jp/~cyfis/tcpdf/ http://tcpdf.penlabo.net/method/c/Cell.html
		require_once(__DIR__ . '/../vendor/tcpdf/fpdi.php');
		$pdf = new FPDI($chouhyou_mr->yousi_houkou, 'mm', $chouhyou_mr->yousi_size, true, 'UTF-8'); // "P", "mm", "A4", true, "UTF-8"
		foreach ($shukkairai_dt_ids as $shukkairai_dt_id) {
//echo "\n<br>".$shukkairai_dt_id['sentaku_chk'];
			$shukkairai_dt = ShukkairaiDts::findFirstByid($shukkairai_dt_id['sentaku_chk']);
//if ($shukkairai_dt) {echo "\n<br>".$shukkairai_dt->cd;}else{echo "\n<br>ERROR";}
			$this->_denpyou_pdf($shukkairai_dt, $chouhyou_mr, $pdf);
		}
		//保存ファイル名
		$filename = uniqid("shukkairai_", false) . '.pdf';
		
		// 保存ファイルパス
		$path = __DIR__ . '/temp/' . $filename;
		
		$pdf->Output($path, 'F');
					//	I: ブラウザに出力する(既定)、保存時のファイル名が$nameで指定した名前になる。
					//	D: ブラウザで(強制的に)ダウンロードする。
					//	F: ローカルファイルとして保存する。
					//	S: PDFドキュメントの内容を文字列として出力する。
		return $path;
	}

	public function tcpdfcols($iro) {
		$cols=[0,-1,-1,-1];
		if (strlen($iro)>0) {$col[0]=hexdec(substr($iro,0,2));}
		if (strlen($iro)>2) {$col[1]=hexdec(substr($iro,2,2));}
		if (strlen($iro)>4) {$col[2]=hexdec(substr($iro,4,2));}
		if (strlen($iro)>6) {$col[3]=hexdec(substr($iro,6,2));}
		return $cols;
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

	    $shukkairai_dts = ShukkairaiDts::find(array(
//	        'columns' => array('cd, name'), 全項目とする
	        'order' => 'cd, id DESC',
	        'conditions' => ' cd LIKE ?1 ',
	        'bind' => array(1 => $this->request->getPost('cd').'%')
		));
		$res_flds = [
			"id",
			"cd",
            "tekiyou",
            "nendo",
            "iraibi",
            "irai_kbn_cd",
            "juchuu_dt_id",
            "hacchuu_dt_id",
            "souko_mr_cd",
            "gotantou",
            "hassousaki_kbn_cd",
            "hassousaki_mr_cd",
            "hassousaki",
            "kidukesaki_mr_cd",
            "kiduke",
            "shukkabi",
            "nouki_memo",
            "tantou_mr_cd",
            "assistant",
            "shounin_joutai_flg",
            "shounin_sha_mr_cd",
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
            "cd",
            "utiwake_kbn_cd",
            "shukkairai_dt_id",
            "shukka_kbn_cd",
            "shouhin_mr_cd",
            "tanni_mr_cd",
            "irisuu",
            "keisu",
            "tekiyou",
            "lot",
            "kobetucd",
            "hinsitu_kbn_cd",
            "souko_mr_cd",
            "kikaku",
            "iro",
            "iromei",
            "size",
            "suuryou",
            "suuryou1",
            "tanni_mr1_cd",
            "suuryou2",
            "tanni_mr2_cd",
            "tanka_kbn",
            "gentanka",
            "genkagaku",
            "nouki",
            "bikou",
		];
		$resData = array();
		foreach ($shukkairai_dts as $shukkairai_dt) {
	        $resAdata = array();
	        foreach ($res_flds as $res_fld) {
	            $resAdata[$res_fld] = $shukkairai_dt->$res_fld;
	        }
			if ($shukkairai_dts->hassousaki_kbn_cd == 1) {
				$target = KihonMrs::findFirstByid(1);
			} else {
				$belong = 'Hassousaki'.$shukkairai_dt->hassousaki_kbn_cd.'Mrs';
				$target = $shukkairai_dt->$belong;
			}
			$resAdata['hassousaki_mr_name'] = $target->name;
	        foreach ($shukkairai_dt->ShukkairaiMeisaiDts as $shukkairai_meisai_dt) {
		        foreach ($meisai_flds as $meisai_fld) {
		            $resAdata["meisai"][$shukkairai_meisai_dt->cd][$meisai_fld] = $shukkairai_meisai_dt->$meisai_fld;
		        }
		        $resAdata["meisai"][$shukkairai_meisai_dt->cd]['moto_tanni_mr2_cd'] = $shukkairai_meisai_dt->ShouhinMrs->tanni_mr2_cd;
		        $resAdata["meisai"][$shukkairai_meisai_dt->cd]['suu_shousuu'] = $shukkairai_meisai_dt->ShouhinMrs->suu_shousuu;
		        $resAdata["meisai"][$shukkairai_meisai_dt->cd]['suu1_shousuu'] = $shukkairai_meisai_dt->ShouhinMrs->suu1_shousuu;
		        $resAdata["meisai"][$shukkairai_meisai_dt->cd]['suu2_shousuu'] = $shukkairai_meisai_dt->ShouhinMrs->suu2_shousuu;
		        $resAdata["meisai"][$shukkairai_meisai_dt->cd]['tanka_shousuu'] = $shukkairai_meisai_dt->ShouhinMrs->tanka_shousuu;
		        $resAdata["meisai"][$shukkairai_meisai_dt->cd]['zaiko_kbn'] = $shukkairai_meisai_dt->ShouhinMrs->zaiko_kbn;
		        $resAdata["meisai"][$shukkairai_meisai_dt->cd]['souko_mr_cd'] = $shukkairai_meisai_dt->ShouhinMrs->shu_souko_mr_cd; // 出荷依頼明細にはまだ倉庫がない
				
	        }
//	        $resAdata["seikyuusaki_name"] = $shukkairai_dt->SeikyuusakiMrs->name;
	        $resData[] = $resAdata;//array('cd' => $shukkairai_dt->cd, 'name' => $shukkairai_dt->name);
	    }

	    //Set the content of the response
	    $response->setContent(json_encode($resData));

	    //Return the response
	    return $response;
	}

}
