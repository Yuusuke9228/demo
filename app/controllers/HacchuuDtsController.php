<?php

class HacchuuDtsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        ControllerBase::indexCd("HacchuuDts", "発注データ", "hacchuubi DESC"); //簡易検索付き一覧表示
    }

    /**
     * モーダル
     */
    public function modalAction()
    {
        ControllerBase::indexCd("HacchuuDts", "発注伝票", "hacchuubi DESC");
    }

    /**
     * Searches for hacchuu_dts
     */
    public function searchAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Displays the creation form
     */
    public function newAction($id = null, $dataname = "Hacchuu")
    {
        $this->view->imax = 0;
        $zeiritu_mrs = ZeirituMrs::find(['order' => 'kazei_kbn_cd, kijunbi DESC']);
        $this->view->zeiritu_mrs = $zeiritu_mrs;

        $tanka_shurui_kbns = TankaShuruiKbns::find(['order' => 'cd', 'conditions' => 'shiire_flg = 1']);
        $this->view->tanka_shurui_kbns = $tanka_shurui_kbns;

        $hassousaki_kbns = HassousakiKbns::find(['order' => 'cd']);
        $this->view->hassousaki_kbns = $hassousaki_kbns;


        if ($id) {
            $nameDts = $dataname . "Dts";
            $hacchuu_dt = $nameDts::findFirstByid($id);
            if (!$hacchuu_dt) {
                $this->flash->error("発注データが見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "hacchuu_dts",
                    'action' => 'index'
                ));

                return;
            }
            $this->_setDefault($hacchuu_dt, "new", $dataname);
            $this->tag->setDefault("id", null);
            $this->tag->setDefault("cd", null);
        } else {
            if ($this->request->isPost()) { // ポストは在庫確認からつながってくる
                $hacchuu_dt = new HacchuuDts();
                //		$hacchuu_dt->HacchuuMeisaiDts = array();
                $HacchuuMeisaiDts = array();
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
                $setshrs = [
                    "torihiki_kbn_cd",
                    "zei_tenka_kbn_cd",
                    "kakeritu"
                ];
                $i = 0;
                foreach ($this->request->getPost() as $postid => $postdt) {
                    if ($postid == 'data') {
                        foreach ($postdt as $meisaitb => $meisairws) {
                            foreach ($meisairws as $meisaiid => $meisaidts) {
                                $HacchuuMeisaiDts[$i] = new HacchuuMeisaiDts();
                                $HacchuuMeisaiDts[$i]->utiwake_kbn_cd = 10;
                                foreach ($meisaidts as $meisaifd => $meisaidt) {
                                    $HacchuuMeisaiDts[$i]->cd = $i + 1;
                                    $HacchuuMeisaiDts[$i]->$meisaifd = $meisaidt;
                                    if ($i == 0 && $meisaifd == "shouhin_mr_cd") {
                                        $shouhin_mr = ShouhinMrs::findFirst([
                                            "conditions" => "cd = ?1",
                                            "bind" => [1 => $meisaidt]
                                        ]);
                                        if ($shouhin_mr) {
                                            $HacchuuMeisaiDts[$i]->tekiyou = $shouhin_mr->name;
                                            $hacchuu_dt->tantou_mr_cd = $shouhin_mr->shouhin_bunrui3_kbn_cd;
                                            foreach ($setshns as $setshn) { // 商品関連項目設定
                                                $HacchuuMeisaiDts[$i]->$setshn = $shouhin_mr->$setshn;
                                            }
                                            if ($meisaiid == 0) {
                                                $hacchuu_dt->shiiresaki_mr_cd = $shouhin_mr->ShiiresakiMrs->cd;
                                                foreach ($setshrs as $setshr) { // 仕入先関連項目設定
                                                    $hacchuu_dt->$setshr = $shouhin_mr->ShiiresakiMrs->$setshr;
                                                }
                                            }
                                        }
                                    }
                                }
                                $i++;
                            }
                        }
                    } else {
                        $hacchuu_dt->$postid = $postdt;
                    }
                }
                //				$hacchuu_dt->HacchuuMeisaiDts = $HacchuuMeisaiDts;
                //echo "<br>".count($hacchuu_dt->HacchuuMeisaiDts);
                $this->_setDefault($hacchuu_dt, "new", $HacchuuMeisaiDts);
            }
        }
        $this->tag->setDefault("hacchuubi", date("Y-m-d"));
        $this->tag->setDefault("sakusei_user_name", $this->getDI()->getSession()->get('auth')['name']);
        $this->tag->setDefault("updated", null);

        $readonly_ctlr = new ReadonlyFieldKbnsController();
        $this->view->readonlys = $readonly_ctlr->setFormFieldReadonlys('HacchuuDts', 'inputfields');
        //print_r($this->view->readonlys);
        $rewidth_ctlr = new RewidthFieldMrsController();
        $this->view->rewidths = $rewidth_ctlr->setFormFieldRewidths('HacchuuDts', 'inputfields');
    }

    /**
     * 修正画面から「次へ」ボタンを押したら次のコードの修正画面になる。
     */
    public function nextAction($id)
    {
        ControllerBase::nextCd($id, "hacchuu_dts", "HacchuuDts", "発注データ");
    }

    /**
     * 修正画面から「前へ」ボタンを押したら前のコードの修正画面になる。
     */
    public function prevAction($id = 0)
    {
        ControllerBase::prevCd($id, "hacchuu_dts", "HacchuuDts", "発注データ");
    }

    /**
     * Edits a hacchuu_dt
     *
     * @param string $id
     */
    public function editAction($id, $exp = null)
    {
        $hacchuu_dt = HacchuuDts::findFirstByid($id);
        if (!$hacchuu_dt) {
            $this->flash->error("発注データが見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "hacchuu_dts",
                'action' => 'index'
            ));

            return;
        }

        $this->view->id = $hacchuu_dt->id;
        if (!empty($exp)) { // 伝票印刷やexcel出力するとき $exp=帳票ID=$chouhyou_mr_id
            $this->view->exp = $this->url->get('hacchuu_dts/denpyou/' . $id . '/' . $exp); //作成・更新後にedit画面が出たときにExcelをexportする←createAction最後・saveAction最後→app/views/index.volt
        }

        $this->_setDefault($hacchuu_dt, "edit");

        $zeiritu_mrs = ZeirituMrs::find(['order' => 'kazei_kbn_cd, kijunbi DESC']);
        $this->view->zeiritu_mrs = $zeiritu_mrs;

        $tanka_shurui_kbns = TankaShuruiKbns::find(['order' => 'cd', 'conditions' => 'shiire_flg = 1']);
        $this->view->tanka_shurui_kbns = $tanka_shurui_kbns;

        $hassousaki_kbns = HassousakiKbns::find(['order' => 'cd']);
        $this->view->hassousaki_kbns = $hassousaki_kbns;

        $readonly_ctlr = new ReadonlyFieldKbnsController();
        $this->view->readonlys = $readonly_ctlr->setFormFieldReadonlys('HacchuuDts', 'inputfields');
        $rewidth_ctlr = new RewidthFieldMrsController();
        $this->view->rewidths = $rewidth_ctlr->setFormFieldRewidths('HacchuuDts', 'inputfields');
    }

    /**
     * 画面に表示するデータをセットする
     */
    public function _setDefault($hacchuu_dt, $action = "edit", $meisai = "Hacchuu")
    {
        $setdts = [
            "id",
            "cd",
            "nendo",
            "tekiyou",
            "hacchuubi",
            "nounyuu_kijitu",
            "juchuu_dt_cd",
            "zeiritu_tekiyoubi",
            "shiiresaki_mr_cd",
            "torihiki_kbn_cd",
            "zei_tenka_kbn_cd",
            "kakeritu",
            "tantou_mr_cd",
            "hassousaki_kbn_cd",
            "hassousaki_mr_cd",
            "hassousaki_mr_name",
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

        foreach ($setdts as $setdt) {
            if (property_exists($hacchuu_dt, $setdt)) {
                $this->tag->setDefault($setdt, $hacchuu_dt->$setdt);
            }
        }
        if ($meisai == 'Juchuu') {
            $this->tag->setDefault('juchuu_dt_cd', $hacchuu_dt->cd);
            $this->tag->setDefault('hassousaki_kbn_cd', 3);
            $this->tag->setDefault('hassousaki_mr_cd', $hacchuu_dt->nounyuusaki_mr_cd);
            $this->tag->setDefault('hassousaki_mr_name', $hacchuu_dt->nounyuusaki);
        }
        if (property_exists($hacchuu_dt, "zeiritu_tekiyoubi")) {
            $this->tag->setDefault("zeiritu_tekiyoubi", ($hacchuu_dt->zeiritu_tekiyoubi == "0000-00-00") ? "" : $hacchuu_dt->zeiritu_tekiyoubi);
        }
        if (property_exists($hacchuu_dt, "nounyuu_kijitu")) {
            $this->tag->setDefault("nounyuu_kijitu", ($hacchuu_dt->nounyuu_kijitu == "0000-00-00") ? "" : $hacchuu_dt->nounyuu_kijitu);
        }
        if (property_exists($hacchuu_dt, "shiiresaki_mr_cd")) {
            $this->tag->setDefault("shiiresaki_mr_zandaka", number_format($hacchuu_dt->ShiiresakiMrs->kake_zandaka));
            $this->tag->setDefault("shiiresaki_mr_name", $hacchuu_dt->ShiiresakiMrs->name);
            $this->tag->setDefault("tanka_shurui_kbn_name", $hacchuu_dt->ShiiresakiMrs->TankaShuruiKbns->name);
            $this->tag->setDefault("tanka_shurui_kbn_koumokumei", $hacchuu_dt->ShiiresakiMrs->TankaShuruiKbns->koumokumei);
            $this->tag->setDefault("gaku_hasuu_shori_kbn_cd", $hacchuu_dt->ShiiresakiMrs->gaku_hasuu_shori_kbn_cd); //端数処理設定用
            $this->tag->setDefault("zei_hasuu_shori_kbn_cd", $hacchuu_dt->ShiiresakiMrs->zei_hasuu_shori_kbn_cd); //端数処理設定用
        }
        if (property_exists($hacchuu_dt, "nounyuusaki_mr_cd")) {
            $this->tag->setDefault("nounyuusaki_mr_name", $hacchuu_dt->nounyuusaki_mr_cd == '' ? '' : $hacchuu_dt->NounyuusakiMrs->name);
        }
        $this->tag->setDefault("sakusei_user_name", $hacchuu_dt->SakuseiUsers->name);

        $hacchuu_zan = [];
        if ($hacchuu_dt->id) { // 受注残量取得
            $di = \Phalcon\DI::getDefault();
            $mgr = $di->get('modelsManager');
            $phql = "SELECT shouhin_mr_cd, iro, sum(hacchuuzan_ryou1) AS zan_ryou1, sum(hacchuuzan_ryou2) AS zan_ryou2
				FROM ZaikoKakuninAzukariVws
				WHERE hacchuu_dt_id = :id:
				GROUP BY shouhin_mr_cd, iro";
            $rows = $mgr->executeQuery($phql, ['id' => $hacchuu_dt->id]);
            foreach ($rows as $row) {
                $hacchuu_zan[$row->shouhin_mr_cd][$row->iro] = ['zan_ryou1' => $row->zan_ryou1, 'zan_ryou2' => $row->zan_ryou2, 'nyuuka_kbn_cd' => 0];
            }

            //sql間違えていたので修正 2019/10/8
            $phql = "SELECT a.shouhin_mr_cd, iro, max(a.nyuuka_kbn_cd) AS nyuuka_kbn_cd_max
                FROM ShiireMeisaiDts a
                left join ShiireDts b on b.id = a.shiire_dt_id
                WHERE b.hacchuu_dt_id = :id:
                GROUP BY shouhin_mr_cd, iro";
            $rows = $mgr->executeQuery($phql, ['id' => $hacchuu_dt->id]);
            foreach ($rows as $row) {
                $hacchuu_zan[$row->shouhin_mr_cd][$row->iro]['nyuuka_kbn_cd'] = $row->nyuuka_kbn_cd_max;
            }
        }

        if (is_array($meisai)) { // 配列は在庫確認からつながってくる
            $meisai_dts = $meisai;
        } else {
            $meisai .= "MeisaiDts";
            $meisai_dts = $hacchuu_dt->$meisai;
        }
        $setmss = [
            "id",
            "utiwake_kbn_cd",
            "kousei",
            "shouhin_mr_cd",
            "tanni_mr2_cd",
            "tanni_mr1_cd",
            "keisu",
            "irisuu",
            "tekiyou",
            "lot",
            "kobetucd",
            "hinsitu_kbn_cd",
            "souko_mr_cd",
            "iro",
            "iromei",
            "size",
            "tanka_kbn",
            "genkagaku",
            "zeinukigaku",
            "zeigaku",
            "project_mr_cd",
            "zeiritu_mr_cd",
            "bikou",
            "nouki",
            "updated"
        ];
        $i = 0;
        foreach ($meisai_dts as $hacchuu_meisai_dt) {
            foreach ($setmss as $setms) {
                if (property_exists($hacchuu_meisai_dt, $setms)) {
                    $this->tag->setDefault("data[hacchuu_meisai_dts][" . $i . "][" . $setms . "]", $hacchuu_meisai_dt->$setms);
                }
            }
            //			$this->tag->setDefault("data[hacchuu_meisai_dts][".$i."][souko_mr_cd]", $hacchuu_meisai_dt->ShouhinMrs->shu_souko_mr_cd);
            if ($action == "new") {
                $this->tag->setDefault("data[hacchuu_meisai_dts][" . $i . "][id]", null);
            }
            $this->tag->setDefault("data[hacchuu_meisai_dts][" . $i . "][cd]", $i + 1); //行番を振りなおす
            if (property_exists($hacchuu_meisai_dt, "shouhin_mr_cd")) {
                if (property_exists($hacchuu_meisai_dt, "suuryou")) {
                    $this->tag->setDefault("data[hacchuu_meisai_dts][" . $i . "][suuryou]", number_format($hacchuu_meisai_dt->suuryou, $hacchuu_meisai_dt->ShouhinMrs->suu_shousuu));
                }
                if (property_exists($hacchuu_meisai_dt, "suuryou1")) {
                    $this->tag->setDefault("data[hacchuu_meisai_dts][" . $i . "][suuryou1]", number_format($hacchuu_meisai_dt->suuryou1, $hacchuu_meisai_dt->ShouhinMrs->suu1_shousuu));
                }
                if (property_exists($hacchuu_meisai_dt, "suuryou2")) {
                    $this->tag->setDefault("data[hacchuu_meisai_dts][" . $i . "][suuryou2]", number_format($hacchuu_meisai_dt->suuryou2, $hacchuu_meisai_dt->ShouhinMrs->suu2_shousuu));
                }
                if (property_exists($hacchuu_meisai_dt, "gentanka")) {
                    $this->tag->setDefault("data[hacchuu_meisai_dts][" . $i . "][gentanka]", number_format($hacchuu_meisai_dt->gentanka, $hacchuu_meisai_dt->ShouhinMrs->tanka_shousuu));
                } else {
                    $this->tag->setDefault("data[hacchuu_meisai_dts][" . $i . "][gentanka]", number_format($hacchuu_meisai_dt->ShouhinMrs->shiire_tanka, $hacchuu_meisai_dt->ShouhinMrs->tanka_shousuu));
                }
                if (property_exists($hacchuu_meisai_dt, "tanka") && ($meisai == 'HacchuuMeisaiDts' || $meisai == 'ShiireMeisaiDts')) {
                    $tanka = $hacchuu_meisai_dt->tanka;
                } else {
                    $koumokumei = $hacchuu_dt->ShiiresakiMrs->TankaShuruiKbns->koumokumei;
                    $tanka = $hacchuu_meisai_dt->ShouhinMrs->$koumokumei;
                }
                $this->tag->setDefault("data[hacchuu_meisai_dts][" . $i . "][tanka]", number_format($tanka, $hacchuu_meisai_dt->ShouhinMrs->tanka_shousuu));
                if (property_exists($hacchuu_meisai_dt, "kingaku")) {
                    $this->tag->setDefault("data[hacchuu_meisai_dts][" . $i . "][kingaku]", number_format($hacchuu_meisai_dt->kingaku));
                } else {
                    $this->tag->setDefault("data[hacchuu_meisai_dts][" . $i . "][kingaku]", number_format($tanka * $hacchuu_meisai_dt->suuryou2));
                }
                $this->tag->setDefault("data[hacchuu_meisai_dts][" . $i . "][suu_shousuu]", $hacchuu_meisai_dt->ShouhinMrs->suu_shousuu); //桁数設定用
                $this->tag->setDefault("data[hacchuu_meisai_dts][" . $i . "][suu1_shousuu]", $hacchuu_meisai_dt->ShouhinMrs->suu1_shousuu); //桁数設定用
                $this->tag->setDefault("data[hacchuu_meisai_dts][" . $i . "][suu2_shousuu]", $hacchuu_meisai_dt->ShouhinMrs->suu2_shousuu); //桁数設定用
                $this->tag->setDefault("data[hacchuu_meisai_dts][" . $i . "][tanka_shousuu]", $hacchuu_meisai_dt->ShouhinMrs->tanka_shousuu); //桁数設定用
                $this->tag->setDefault("data[hacchuu_meisai_dts][" . $i . "][zaiko_kbn]", $hacchuu_meisai_dt->ShouhinMrs->zaiko_kbn); //桁数設定用
                $this->tag->setDefault("data[hacchuu_meisai_dts][" . $i . "][moto_tanni_mr2_cd]", $hacchuu_meisai_dt->ShouhinMrs->tanni_mr2_cd); //桁数設定用
                $this->tag->setDefault("data[hacchuu_meisai_dts][" . $i . "][kazei_kbn_cd]", $hacchuu_meisai_dt->ShouhinMrs->kazei_kbn_cd); //税率計算用

                //                if ($meisai=="HacchuuMeisaiDts") {
                //                    $zan_vw = ZaikoKakuninVws::sum([
                //                        "column"=>"hacchuuzan_ryou".$hacchuu_meisai_dt->tanka_kbn,
                //                        "conditions"=>"hacchuu_dt_id=?1 AND shouhin_mr_cd=?2 AND iro=?3",
                //                        "bind"=>[1=>$hacchuu_dt->id,2=>$hacchuu_meisai_dt->shouhin_mr_cd,3=>$hacchuu_meisai_dt->iro]
                //                    ]);
                //                    $this->tag->setDefault("data[hacchuu_meisai_dts][".$i."][hacchuuzan]",number_format($zan_vw,$hacchuu_meisai_dt->ShouhinMrs->suu_shousuu));
                //                }

            }
            $tk = $hacchuu_meisai_dt->tanka_kbn; // 注残の為の単価区分
            $sho = 'suu' . $tk . '_shousuu'; // 注残の為の数量小数桁数項目名
            $this->tag->setDefault("data[hacchuu_meisai_dts][" . $i . "][hacchuuzan]", number_format($hacchuu_zan[$hacchuu_meisai_dt->shouhin_mr_cd][$hacchuu_meisai_dt->iro]['zan_ryou' . $tk], $hacchuu_meisai_dt->ShouhinMrs->$sho));
            $this->tag->setDefault("data[hacchuu_meisai_dts][" . $i . "][nyuuka_kbn_cd]", $hacchuu_zan[$hacchuu_meisai_dt->shouhin_mr_cd][$hacchuu_meisai_dt->iro]['nyuuka_kbn_cd']);
            $i++;
        }
        $this->view->imax = $i;
    }

    /**
     * Creates a new hacchuu_dt
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "hacchuu_dts",
                'action' => 'index'
            ));

            return;
        }

        $hacchuu_dt = new HacchuuDts();

        $post_flds = [];
        $post_flds = [
            "cd",
            "tekiyou",
            "hacchuubi",
            "nounyuu_kijitu",
            "juchuu_dt_cd",
            "zeiritu_tekiyoubi",
            "shiiresaki_mr_cd",
            "torihiki_kbn_cd",
            "tanka_shurui_kbn_cd",
            "zei_tenka_kbn_cd",
            "kakeritu",
            "tantou_mr_cd",
            "hassousaki_kbn_cd",
            "hassousaki_mr_cd",
            "hassousaki_mr_name",
            "shounin_joutai_flg",
            "shounin_sha_mr_cd",
            "updated",
        ];

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
            "nouki",
        ];

        $meisai_nums = [
            "keisu",
            "irisuu",
            "suuryou",
            "suuryou1",
            "suuryou2",
            "gentanka",
            "tanka",
            "kingaku",
            "genkagaku",
            "zeinukigaku",
            "zeigaku"
        ]; // 税抜額と税額は調整計算用

        $thisPost = [];
        $thisPost["nounyuu_kijitu"] = ($this->request->getPost("nounyuu_kijitu") == "") ? "0000-00-00" : $this->request->getPost("nounyuu_kijitu");
        $thisPost["zeiritu_tekiyoubi"] = ($this->request->getPost("zeiritu_tekiyoubi") == "") ? "0000-00-00" : $this->request->getPost("zeiritu_tekiyoubi");

        foreach ($post_flds as $post_fld) {
            $hacchuu_dt->$post_fld = array_key_exists($post_fld, $thisPost) ? $thisPost[$post_fld] : $this->request->getPost($post_fld);
        }

        $meisai = $this->request->getPost("data");
        $zeinuki_chousei_gaku = $this->request->getPost("zeinuki_chousei_gaku"); // 消費税調整と税抜額調整が必要な場合はする
        if ($zeinuki_chousei_gaku < 0) {
            $zeinuki_chousei_muki = -1;
        } else {
            $zeinuki_chousei_muki = 1;
        }
        $zei_chousei_gaku = $this->request->getPost("zei_chousei_gaku");
        if ($zei_chousei_gaku < 0) {
            $zei_chousei_muki = -1;
        } else {
            $zei_chousei_muki = 1;
        }

        $meisaicnv = array();
        $hacchuu_dt->HacchuuMeisaiDts = array();
        $HacchuuMeisaiDts = array();
        $i = 0;

        foreach ($meisai["hacchuu_meisai_dts"] as $hacchuu_meisai_dt) {
            if ($hacchuu_meisai_dt["shouhin_mr_cd"] !== '' && $hacchuu_meisai_dt["cd"] !== '' && $hacchuu_meisai_dt["cd"] !== '0' && $hacchuu_meisai_dt["utiwake_kbn_cd"] !== '') {
                //            if ($hacchuu_meisai_dt["shouhin_mr_cd"] != '') {
                $meisaicnv[$i] = [];
                foreach ($meisai_nums as $meisai_num) {
                    $meisaicnv[$i][$meisai_num] = str_replace(',', '', $hacchuu_meisai_dt[$meisai_num]); //カンマ除去
                }
                $hacchuu_meisai_dt["nouki"] = ($hacchuu_meisai_dt["nouki"] == "") ? "0000-00-00" : $hacchuu_meisai_dt["nouki"];
                if ($zeinuki_chousei_gaku != 0) { // 消費税調整と税抜額調整が必要な場合はする
                    $meisaicnv[$i]["zeinukigaku"] += $zeinuki_chousei_muki;
                    $zeinuki_chousei_gaku -= $zeinuki_chousei_muki;
                }
                if ($zei_chousei_gaku != 0) {
                    $meisaicnv[$i]["zeigaku"] += $zei_chousei_muki;
                    $zei_chousei_gaku -= $zei_chousei_muki;
                }
                $HacchuuMeisaiDts[$i] = new HacchuuMeisaiDts();
                foreach ($meisai_flds as $meisai_fld) {
                    $HacchuuMeisaiDts[$i]->$meisai_fld = array_key_exists($meisai_fld, $meisaicnv[$i]) ? $meisaicnv[$i][$meisai_fld] : $hacchuu_meisai_dt[$meisai_fld] ?? '';
                    //更新日時や更新者はModelに定義してある
                }
                $i++;
            }
        }
        $hacchuu_dt->HacchuuMeisaiDts = $HacchuuMeisaiDts;

        /* 伝票番号付番または再設定 */
        $den_ban_ctrl = new DenpyouBangouMrsController(); //伝票番号マスタコントローラ
        $nendo_ban = $den_ban_ctrl->countup('hacchuu', 0, $hacchuu_dt->hacchuubi); // 新規なので$hacchuu_dt->cd使わない2019/6/11井浦
        if (!$nendo_ban['nendo']) {
            $this->flash->error("エラー:年度が未登録（日付が今年か昨年以外は不可）。" . $hacchuu_dt->hacchuubi);
            $this->dispatcher->forward(array(
                'controller' => "hacchuu_dts",
                'action' => 'edit',
                'params' => array($hacchuu_dt->id)
            ));
        }
        $hacchuu_dt->cd = $nendo_ban['bangou'];
        $hacchuu_dt->nendo = $nendo_ban['nendo'];

        if (!$hacchuu_dt->save()) {
            foreach ($hacchuu_dt->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "hacchuu_dts",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("発注伝票の作成が完了しました。");

        $chouhyou_mr_id = $this->request->getPost('chouhyou_mr_id'); // 帳票マスタのid

        $this->dispatcher->forward(array(
            'controller' => "hacchuu_dts",
            'action' => 'edit',
            'params' => array($hacchuu_dt->id, $chouhyou_mr_id)
        ));
    }

    /**
     * Saves a hacchuu_dt edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "hacchuu_dts",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $hacchuu_dt = HacchuuDts::findFirstByid($id);

        if (!$hacchuu_dt) {
            $this->flash->error("発注データが見つからなくなりました。" . $id);

            $this->dispatcher->forward(array(
                'controller' => "hacchuu_dts",
                'action' => 'index'
            ));

            return;
        }

        if ($hacchuu_dt->updated !== $this->request->getPost("updated")) {
            $this->flash->error("他のプロセスから発注データが変更されたため更新を中止しました。"
                . $id . ",uid=" . $hacchuu_dt->kousin_user_id . " tb=" . $hacchuu_dt->updated . " pt=" . $this->request->getPost("updated"));

            $this->dispatcher->forward(array(
                'controller' => "hacchuu_dts",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $post_flds = [
            "cd",
            "tekiyou",
            "hacchuubi",
            "nounyuu_kijitu",
            "juchuu_dt_cd",
            "zeiritu_tekiyoubi",
            "shiiresaki_mr_cd",
            "torihiki_kbn_cd",
            "zei_tenka_kbn_cd",
            "kakeritu",
            "tantou_mr_cd",
            "hassousaki_kbn_cd",
            "hassousaki_mr_cd",
            "hassousaki_mr_name",
            "shounin_joutai_flg",
            "shounin_sha_mr_cd",
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

        if ($hacchuu_dt->updated !== $this->request->getPost("updated")) {
            $this->flash->error("他のプロセスから発注伝票が変更されたため更新を中止しました。"
                . $id . ",uid=" . $hacchuu_dt->kousin_user_id . " tb=" . $hacchuu_dt->updated . " pt=" . $this->request->getPost("updated"));

            $this->dispatcher->forward(array(
                'controller' => "hacchuu_dts",
                'action' => 'index'
            ));

            return;
        }

        $meisai = $this->request->getPost("data");
        $i = 0;
        foreach ($meisai["hacchuu_meisai_dts"] as $hacchuu_meisai_dt) {
            if ((int)$hacchuu_meisai_dt["id"] !== 0) {
                if (
                    (int)$hacchuu_dt->HacchuuMeisaiDts[$i]->id !== (int)$hacchuu_meisai_dt["id"] ||
                    $hacchuu_dt->HacchuuMeisaiDts[$i]->updated !== $hacchuu_meisai_dt["updated"]
                ) {
                    $this->flash->error("他のプロセスから発注伝票明細が変更されたため中止しました。"
                        . $id . ",id=" . $hacchuu_dt->HacchuuMeisaiDts[$i]->id . ",uid=" . $hacchuu_dt->HacchuuMeisaiDts[$i]->kousin_user_id
                        . " tb=" . $hacchuu_dt->HacchuuMeisaiDts[$i]->updated . " pt=" . $hacchuu_meisai_dt["updated"]);

                    $this->dispatcher->forward(array(
                        'controller' => "hacchuu_dts",
                        'action' => 'index'
                    ));

                    return;
                }
                $i++;
            }
        }

        $thisPost = [];
        $thisPost["nounyuu_kijitu"] = ($this->request->getPost("nounyuu_kijitu") == "") ? "0000-00-00" : $this->request->getPost("nounyuu_kijitu");
        $thisPost["zeiritu_tekiyoubi"] = ($this->request->getPost("zeiritu_tekiyoubi") == "") ? "0000-00-00" : $this->request->getPost("zeiritu_tekiyoubi");

        $chg_flg = 0;
        foreach ($post_flds as $post_fld) {
            if ((array_key_exists($post_fld, $thisPost) ? $thisPost[$post_fld] : $this->request->getPost($post_fld)) !== $hacchuu_dt->$post_fld) {
                $chg_flg = 1;
                break;
            }
        }

        $zeinuki_chousei_gaku = $this->request->getPost("zeinuki_chousei_gaku"); // 消費税調整と税抜額調整が必要な場合はする
        if ($zeinuki_chousei_gaku < 0) {
            $zeinuki_chousei_muki = -1;
        } else {
            $zeinuki_chousei_muki = 1;
        }
        $zei_chousei_gaku = $this->request->getPost("zei_chousei_gaku");
        if ($zei_chousei_gaku < 0) {
            $zei_chousei_muki = -1;
        } else {
            $zei_chousei_muki = 1;
        }

        $meisaicnv = array();
        $chg_flgs = array();
        $i = 0;
        $j = 0;
        try {
            foreach ($meisai["hacchuu_meisai_dts"] as $hacchuu_meisai_dt) {
                $meisaicnv[$i] = [];
                foreach ($meisai_nums as $meisai_num) {
                    $meisaicnv[$i][$meisai_num] = (float)str_replace(',', '', $hacchuu_meisai_dt[$meisai_num]); //カンマ除去
                }
                $hacchuu_meisai_dt["nouki"] = ($hacchuu_meisai_dt["nouki"] == "") ? "0000-00-00" : $hacchuu_meisai_dt["nouki"];
                if ((int)$hacchuu_meisai_dt["cd"] !== 0) { // 消費税調整と税抜額調整が必要な場合はする
                    if ($zeinuki_chousei_gaku != 0) {
                        $meisaicnv[$i]["zeinukigaku"] += $zeinuki_chousei_muki;
                        $zeinuki_chousei_gaku -= $zeinuki_chousei_muki;
                    }
                    if ($zei_chousei_gaku != 0) {
                        $meisaicnv[$i]["zeigaku"] += $zei_chousei_muki;
                        $zei_chousei_gaku -= $zei_chousei_muki;
                    }
                }
                $chg_flgs[$i] = 0; //変更ないかも
                if ((int)$hacchuu_meisai_dt["cd"] === 0 && (int)$hacchuu_meisai_dt["id"] !== 0) {
                    $chg_flg = 1;
                    $chg_flgs[$i] = 2; //削除
                } else if ((int)$hacchuu_meisai_dt["id"] === 0) {
                    if ((int)$hacchuu_meisai_dt["cd"] !== 0 && (int)$hacchuu_meisai_dt["utiwake_kbn_cd"] !== 0) {
                        $chg_flg = 1;
                        $chg_flgs[$i] = 1;
                    }
                } else if ((int)$hacchuu_meisai_dt["cd"] !== 0) {
                    foreach ($meisai_flds as $meisai_fld) {
                        if ((array_key_exists($meisai_fld, $meisaicnv[$i]) ? $meisaicnv[$i][$meisai_fld] : $hacchuu_meisai_dt[$meisai_fld]) . '' !== $hacchuu_dt->HacchuuMeisaiDts[$j]->$meisai_fld) {
                            $chg_flg = 1;
                            $chg_flgs[$i] = 1;
                            $j++;
                            break;
                        }
                    }
                }
                $i++;
            }
        } catch (Exception $e) {
            echo $i, PHP_EOL;
            echo $e->getMessage();
            exit;
        }

        $chouhyou_mr_id = $this->request->getPost('chouhyou_mr_id'); // 帳票マスタのid
        if ($chg_flg === 0 || $chouhyou_mr_id) {
            if ($chouhyou_mr_id) {
                $chohyou_id = $chouhyou_mr_id;
                $this->flash->success("印刷データを出力します。" . $id);
                $this->tag->setDefault('chouhyou_mr_id', ''); //帳票Idをクリアしてやらないと毎回印刷しか出来ない。
                $this->dispatcher->forward(array(
                    "controller" => "hacchuu_dts",
                    "action" => "edit",
                    "params" => array($hacchuu_dt->id, $chohyou_id)
                ));

                return;
            }

            $this->flash->error("変更がありません。" . $id);

            $this->dispatcher->forward(array(
                "controller" => "hacchuu_dts",
                "action" => "edit",
                "params" => array($hacchuu_dt->id)
            ));

            return;
        }

        $this->_bakOut($hacchuu_dt, 0, $chg_flgs);

        foreach ($post_flds as $post_fld) {
            $hacchuu_dt->$post_fld = array_key_exists($post_fld, $thisPost) ? $thisPost[$post_fld] : $this->request->getPost($post_fld);
        }
        /* 伝票番号付番または再設定 */
        $den_ban_ctrl = new DenpyouBangouMrsController(); //伝票番号マスタコントローラ
        $nendo_ban = $den_ban_ctrl->countup('hacchuu', $hacchuu_dt->cd, $hacchuu_dt->hacchuubi, $hacchuu_dt->nendo);
        if (!$nendo_ban['nendo']) {
            $this->flash->error("エラー:年度が未登録（日付が今年か昨年以外は不可）。" . $hacchuu_dt->hacchuubi);
            $this->dispatcher->forward(array(
                'controller' => "hacchuu_dts",
                'action' => 'edit',
                'params' => array($id)
            ));
        }
        $hacchuu_dt->cd = $nendo_ban['bangou'];
        $hacchuu_dt->nendo = $nendo_ban['nendo'];

        $i = 0;
        $j = 0;
        foreach ($meisai["hacchuu_meisai_dts"] as $hacchuu_meisai_dt) {
            if ($chg_flgs[$i] === 2) { // 削除でないとき
                $meisai_ctlr = new HacchuuMeisaiDtsController();
                $meisai_ctlr->deleteAction($hacchuu_meisai_dt["id"]);
            } else {
                if ((int)$hacchuu_meisai_dt["id"] !== 0) {
                    $HacchuuMeisaiDts[$i] = $hacchuu_dt->HacchuuMeisaiDts[$j];
                    $j++;
                }
                if ($chg_flgs[$i] === 1) { // 更新なら
                    if ((int)$hacchuu_meisai_dt["id"] === 0) {
                        $HacchuuMeisaiDts[$i] = new HacchuuMeisaiDts();
                    }
                    foreach ($meisai_flds as $meisai_fld) {
                        $HacchuuMeisaiDts[$i]->$meisai_fld = array_key_exists($meisai_fld, $meisaicnv[$i]) ? $meisaicnv[$i][$meisai_fld] : $hacchuu_meisai_dt[$meisai_fld] ?? '';
                        //更新日時や更新者はModelに定義してある
                    }
                }
            }
            $i++;
        }
        $hacchuu_dt->HacchuuMeisaiDts = $HacchuuMeisaiDts; // 明細データをドッキング

        if (!$hacchuu_dt->save()) {

            foreach ($hacchuu_dt->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "hacchuu_dts",
                'action' => 'edit',
                'params' => array($hacchuu_dt->id)
            ));

            return;
        }

        $this->flash->success("発注伝票の情報を更新しました。" . $chouhyou_mr_id);

        $this->dispatcher->forward(array(
            'controller' => "hacchuu_dts",
            'action' => 'edit',
            'params' => array($hacchuu_dt->id)
        ));
    }

    /**
     * Deletes a hacchuu_dt
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $hacchuu_dt = HacchuuDts::findFirstByid($id);
        if (!$hacchuu_dt) {
            $this->flash->error("発注データが見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "hacchuu_dts",
                'action' => 'index'
            ));

            return;
        }

        foreach ($hacchuu_dt->HacchuuMeisaiDts as $hacchuu_meisai_dt) { // 2019/5/9 追加 井浦
            $meisai_ctlr = new HacchuuMeisaiDtsController();
            $meisai_ctlr->deleteAction($hacchuu_meisai_dt->id);
        }

        $this->_bakOut($hacchuu_dt, 1);

        if (!$hacchuu_dt->delete()) {

            foreach ($hacchuu_dt->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "hacchuu_dts",
                'action' => 'search'
            ));

            return;
        }

        $this->flash->success("発注データの削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "hacchuu_dts",
            'action' => "index"
        ));
    }

    /**
     * Back Out a hacchuu_dt
     *
     * @param string $hacchuu_dt , $dlt_flg
     */
    public function _bakOut($hacchuu_dt, $dlt_flg = 0)
    {

        $bak_hacchuu_dt = new BakHacchuuDts();
        foreach ($hacchuu_dt as $fld => $value) {
            $bak_hacchuu_dt->$fld = $hacchuu_dt->$fld;
        }
        $bak_hacchuu_dt->id = NULL;
        $bak_hacchuu_dt->id_moto = $hacchuu_dt->id;
        $bak_hacchuu_dt->hikae_dltflg = $dlt_flg;
        $bak_hacchuu_dt->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_hacchuu_dt->hikae_nichiji = date("Y-m-d H:i:s");
        if (!$bak_hacchuu_dt->save()) {
            foreach ($bak_hacchuu_dt->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
    }

    /**
     * 伝票イメージで出力する。
     **/
    public function denpyouAction($id = null, $frmid = 4)
    { // $frmid = 4:注文書
        //DBのデータを読み込む
        $hacchuu_dt = HacchuuDts::findFirstByid($id);
        if (!$hacchuu_dt) {
            $this->flash->error("発注伝票が見つからなくなりました。id=$id");

            $this->dispatcher->forward(array(
                'controller' => "hacchuu_dts",
                'action' => 'index'
            ));

            return;
        }
        $chouhyou_mr = ChouhyouMrs::findFirstByid($frmid);
        if (!$chouhyou_mr) {
            $this->flash->error("帳票idが見つからなくなりました。id=$frmid");

            $this->dispatcher->forward(array(
                'controller' => "hacchuu_dts",
                'action' => 'edit',
                'params' => [$id]
            ));

            return;
        }
        if ($chouhyou_mr->ChouhyouToolKbns->name == 'EXCEL') {
            return $this->_denpyou_excel($hacchuu_dt, $chouhyou_mr);
        } else if ($chouhyou_mr->ChouhyouToolKbns->name == 'PDF') {
            return $this->_denpyou_pdf($hacchuu_dt, $chouhyou_mr);
        }
    }

    public function _denpyou_excel($hacchuu_dt, $chouhyou_mr)
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
            ['発注番号', 'cd', 0,],
            ['摘要', 'tekiyou', 1,],
            ['発注日', 'hacchuubi', 2,],
            ['納入期日', 'nounyuu_kijitu', 2,],
            ['受注番号', 'juchuu_dt_cd', 0,],
            ['税率適用日', 'zeiritu_tekiyoubi', 2,],
            ['仕入先', 'shiiresaki_mr_cd', 1,],
            ['取引区分', 'torihiki_kbn_cd', 0,],
            ['税転嫁', 'zei_tenka_kbn_cd', 0,],
            ['担当者', 'tantou_mr_cd', 1,],
            ['発送先区分', 'hassousaki_kbn_cd', 0,],
            ['発送先コード', 'hassousaki_mr_cd', 1,],
            ['発送先名', 'hassousaki_mr_name', 1,],
            ['住所１', 'juusho1', 1, 'HassousakiMrs',],
            ['住所２', 'juusho2', 1, 'HassousakiMrs',],
            ['ご担当者', 'gotantousha', 1, 'HassousakiMrs',],
            ['敬称', 'keishou', 1, 'HassousakiMrs',],
            ['TEL', 'tel', 1, 'HassousakiMrs',],
            ['作成者', 'sakusei_user_id', 0,],
            ['作成日時', 'created', 2,],
            ['更新者', 'kousin_user_id', 0,],
            ['更新日時', 'updated', 2,],
            ['仕入先名', 'name', 1, 'ShiiresakiMrs',],
            ['住所１', 'juusho1', 1, 'ShiiresakiMrs',],
            ['住所２', 'juusho2', 1, 'ShiiresakiMrs',],
            ['ご担当者', 'gotantousha', 1, 'ShiiresakiMrs',],
            ['敬称', 'keishou', 1, 'ShiiresakiMrs',],
            ['TEL', 'tel', 1, 'ShiiresakiMrs',],
            ['FAX', 'fax', 1, 'ShiiresakiMrs',],
            ['単価種類区分', 'tanka_shurui_kbn_cd', 0, 'ShiiresakiMrs',],
            ['単価種類名', 'name', 0, 'ShiiresakiMrs', 'TankaShuruiKbns',],
            ['掛率', 'kakeritu', 0, 'ShiiresakiMrs',],
            ['締グループ', 'shimegrp_kbn_cd', 0, 'ShiiresakiMrs',],
            ['額端数処理区分', 'gaku_hasuu_shori_kbn_cd', 0, 'ShiiresakiMrs',],
            ['額端数処理名', 'name', 0, 'ShiiresakiMrs', 'HasuuShoriKbns',],
            ['税端数処理区分', 'zei_hasuu_shori_kbn_cd', 0, 'ShiiresakiMrs',],
            ['税端数処理名', 'name', 0, 'ShiiresakiMrs', 'HasuuShoriKbns',],
            ['取引区分名', 'name', 1, 'TorihikiKbns',],
            ['税転嫁名', 'name', 1, 'ZeiTenkaKbns',],
            ['担当者名', 'name', 1, 'TantouMrs',],
            ['作成者', 'name', 1, 'SakuseiUsers',],
            ['郵便番号', 'yuubin_bangou', 1, 'HassousakiMrs',],
        ];
        $meisai_flds = [
            ['id', 'id', 0,],
            ['行番', 'cd', 0,],
            ['内訳', 'utiwake_kbn_cd', 1,],
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
            ['単価', 'tanka', 0,],
            ['金額', 'kingaku', 0,],
            ['原価額', 'genkagaku', 0,],
            ['税抜額', 'zeinukigaku', 0,],
            ['税額', 'zeigaku', 0,],
            ['プロジェクトコード', 'project_mr_cd', 1,],
            ['税率コード', 'zeiritu_mr_cd', 0,],
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
            ['税率名', 'name', 1, 'ZeirituMrs',],
            ['税率', 'zeiritu', 0, 'ZeirituMrs',],
        ];

        //シートの設定
        //        $PHPExcel->setActiveSheetIndex(1);  //1はDATA(DATAのシート)
        $sheet = $PHPExcel->getSheetByName("DATA");
        $gyou = 1;
        $retu = 0;
        foreach ($flds as $fld) {
            $sheet->setCellValueByColumnAndRow($retu, $gyou, $fld[0]);
            $tbl = $hacchuu_dt;
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
        foreach ($hacchuu_dt->HacchuuMeisaiDts as $hacchuu_meisai_dt) {
            if ($hacchuu_meisai_dt->utiwake_kbn_cd == 30) {
                $sekisangaku += $hacchuu_meisai_dt->kingaku;
            } else {
                $goukeigaku += $hacchuu_meisai_dt->kingaku;
                $genkagoukei += $hacchuu_meisai_dt->genkagaku;
                $zeinukigaku += $hacchuu_meisai_dt->zeinukigaku;
                $zeigaku += $hacchuu_meisai_dt->zeigaku;
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
        foreach ($hacchuu_dt->HacchuuMeisaiDts as $hacchuu_meisai_dt) {
            $gyou++;
            $retu = 0;
            foreach ($meisai_flds as $fld) {
                $tbl = $hacchuu_meisai_dt;
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
        $filename = uniqid("hacchuu_" . $hacchuu_dt->cd . "_", true) . '';

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
        $response->setHeader('Content-Disposition', 'attachment;filename="' . "hacchuu_" . $hacchuu_dt->cd . '"');
        $response->setHeader('Cache-Control', 'max-age=0');
        $response->setHeader('Cache-Control', 'max-age=1'); // If you're serving to IE 9, then the following may be needed
        $response->setContent(file_get_contents($path)); //Set the content of the response
        unlink($path); // delete temp file
        return $response; //Return the response
    }

    public function _denpyou_pdf($hacchuu_dt, $chouhyou_mr, $pdf = null)
    {
        require_once(__DIR__ . '/../vendor/tcpdf/tcpdf.php'); // 参考 http://www.t-net.ne.jp/~cyfis/tcpdf/ http://tcpdf.penlabo.net/method/c/Cell.html
        require_once(__DIR__ . '/../vendor/tcpdf/fpdi.php');

        $kihon_mr = KihonMrs::findFirstByid(1);
        $goukeis = [];
        $goukeis['zeinukigaku'] = 0;
        $goukeis['zeigaku'] = 0;
        $goukeis['meisai_cnt'] = 0;
        foreach ($hacchuu_dt->HacchuuMeisaiDts as $meisai) {
            $goukeis['zeinukigaku'] += $meisai->zeinukigaku;
            $goukeis['zeigaku'] += $meisai->zeigaku;
            if ($chouhyou_mr->meisai_lvl == 0 || $meisai->kingaku != 0 || $meisai->utiwake_kbn_cd == 40 || $meisai->utiwake_kbn_cd == 10) { // 2019/6/27追加　井浦　通常0円発注書発行する。
                $goukeis['meisai_cnt']++;
            }
        }
        $goukeis['kingaku'] = $goukeis['zeinukigaku'] + $goukeis['zeigaku'];
        $goukeis['maxpage'] = (ceil($goukeis['meisai_cnt'] / $chouhyou_mr->meisai_pp)) ?? 1;
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

        for ($page = 1; $page <= $goukeis['maxpage']; $page++) {
            // echo '<br>A '.$page;
            $pdf->SetFont('ipamp', '', 11); // 'kozminproregular'
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
                if ($zokusei->kmk_table == 'hacchuu_meisai_dts') {
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
                for (
                    $gyou = 0;
                    $gyou < $gyousuu
                        && $page * $gyousuu - $gyousuu + $gyou < $goukeis['meisai_cnt']
                        && $zokusei->kmk_table == 'hacchuu_meisai_dts'
                        && substr($zokusei->kmk_shuushoku, 0, 3) != 'fx_'
                        || $gyou < 1;
                    $gyou++
                ) {
                    //echo '<br>F '.$gyou;
                    $suu1 = 0;
                    $suu2 = 0;
                    if ($zokusei->kmk_table == 'kihon_mrs') {
                        $target = $kihon_mr;
                    } else if ($zokusei->kmk_table == 'hacchuu_dts') {
                        $target = $hacchuu_dt;
                    } else if ($zokusei->kmk_table == 'hacchuu_meisai_dts' && substr($zokusei->kmk_shuushoku, 0, 3) == 'fx_') { // 追加2019/5/13井浦
                        for (
                            $dtgyou = 0;
                            $chouhyou_mr->meisai_lvl != 0 &&
                                $dtgyou < count($hacchuu_dt->HacchuuMeisaiDts) &&
                                !($hacchuu_dt->HacchuuMeisaiDts[$dtgyou]->utiwake_kbn_cd == 41 && // メモに限る
                                    'fx_' . $hacchuu_dt->HacchuuMeisaiDts[$dtgyou]->shouhin_mr_cd == $zokusei->kmk_shuushoku); // fx_商品コードと一致なら
                            $dtgyou++
                        ) {
                        }
                        if ($dtgyou < count($hacchuu_dt->HacchuuMeisaiDts)) {
                            $target = $hacchuu_dt->HacchuuMeisaiDts[$dtgyou];
                        } else {
                            $target = new HacchuuMeisaiDts();
                        }
                    } else if ($zokusei->kmk_table == 'hacchuu_meisai_dts') {
                        for (
                            $dtgyou = $dtgyou1;
                            $chouhyou_mr->meisai_lvl != 0 &&
                                $dtgyou < count($hacchuu_dt->HacchuuMeisaiDts) &&
                                $hacchuu_dt->HacchuuMeisaiDts[$dtgyou]->kingaku == 0 &&
                                $hacchuu_dt->HacchuuMeisaiDts[$dtgyou]->utiwake_kbn_cd != 40 &&
                                $hacchuu_dt->HacchuuMeisaiDts[$dtgyou]->utiwake_kbn_cd != 10; // 2019/6/27追加　井浦　通常0円発注書発行する。
                            $dtgyou++
                        ) {
                        }
                        $dtgyou1 = $dtgyou + 1;
                        $target = $hacchuu_dt->HacchuuMeisaiDts[$dtgyou];
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
                                $belong = 'Hassousaki' . $target->hassousaki_kbn_cd . 'Mrs';
                                $target = $target->$belong;
                            }
                        } else {
                            if ($belong) {
                                $target = $target->$belong;
                            }
                        }
                    }
                    $pdf->SetXY($zokusei->yoko_zahyou + $gyou * $chouhyou_mr->meisai_yokokan, $zokusei->tate_zahyou + $gyou * $chouhyou_mr->meisai_tatekan);
                    $text = $target->$kmk_cd;

                    if ($zokusei->kmk_shuushoku == 'nengappi') {
                        $text = $text == '0000-00-00' ? '' : date('Y年 n月 j日', strtotime($text));
                    } else if ($zokusei->kmk_shuushoku == 'keishou') {
                        $text = $text . ' ' . $target->keishou;
                    } else if ($zokusei->kmk_shuushoku == 'if_suu1') {
                        $text = $suu1 == 0 ? '' : $text;
                    } else if ($zokusei->kmk_shuushoku == 'if_suu2') {
                        $text = $suu2 == 0 ? '' : $text;
                    } else if ($zokusei->kmk_shuushoku == 'for_tank') {
                        $text = $target->tanka_kbn == 1 ? $target->suuryou1 : $target->suuryou2;
                    } else if ($zokusei->kmk_shuushoku == 'tankatan') {
                        $text = $text == '1' ? ($target->suuryou1 == 0 ? '' : $target->TanniMr1s->name) : ($target->suuryou2 == 0 ? '' : $target->TanniMr2s->name);
                    } else if ($zokusei->kmk_shuushoku == 'ptankatn') {
                        $text = $text == '1' ? ($target->suuryou1 == 0 ? '' : '/' . $target->TanniMr1s->name) : ($target->suuryou2 == 0 ? '' : '/' . $target->TanniMr2s->name);
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
                            '',
                            '',
                            $zokusei->waku_haba,
                            $zokusei->waku_taka,
                            '',
                            '',
                            '',
                            true
                        );
                    }
                    if ($zokusei->suu_comma || $zokusei->suu_shousuuketa) {
                        if ($zokusei->suu_zero == 0 && (float)$text == 0) {
                            $text = '';
                        } else {
                            $text = number_format((float)$text, $zokusei->suu_shousuuketa, $zokusei->suu_shousuuten ? '.' : '', $zokusei->suu_comma ? ',' : ''); // number_format(値,小数点何位まで,小数点の表示形式,千区切りの表示形式)
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
                        $zokusei->nuri_iro == '' ? 0 : 1,
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

        if (!$renzoku) {
            //保存ファイル名
            $filename = uniqid("hacchuu_" . $hacchuu_dt->cd . "_", false) . '.pdf';

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
            $response->setHeader('Content-Disposition', 'attachment;filename="' . "hacchuu_" . $hacchuu_dt->cd . '.pdf');
            $response->setHeader('Cache-Control', 'max-age=0');
            $response->setHeader('Cache-Control', 'max-age=1'); // If you're serving to IE 9, then the following may be needed
            $response->setContent(file_get_contents($path)); //Set the content of the response
            unlink($path); // delete temp file
            $this->flash->success("発注伝票の印刷PDFを出力しました。");
            return $response; //Return the response
        }
        // echo '<br>K ';
    }

    public function renzoku_denpyou_pdf($hacchuu_dt_ids, $chouhyou_mr)
    {
        require_once(__DIR__ . '/../vendor/tcpdf/tcpdf.php'); // 参考 http://www.t-net.ne.jp/~cyfis/tcpdf/ http://tcpdf.penlabo.net/method/c/Cell.html
        require_once(__DIR__ . '/../vendor/tcpdf/fpdi.php');
        $pdf = new FPDI($chouhyou_mr->yousi_houkou, 'mm', $chouhyou_mr->yousi_size, true, 'UTF-8'); // "P", "mm", "A4", true, "UTF-8"
        foreach ($hacchuu_dt_ids as $hacchuu_dt_id) {
            //echo "\n<br>".$hacchuu_dt_id['sentaku_chk'];
            $hacchuu_dt = HacchuuDts::findFirstByid($hacchuu_dt_id['sentaku_chk']);
            //if ($hacchuu_dt) {echo "\n<br>".$hacchuu_dt->cd;}else{echo "\n<br>ERROR";}
            $this->_denpyou_pdf($hacchuu_dt, $chouhyou_mr, $pdf);
        }
        //保存ファイル名
        $filename = uniqid("hacchuu_", false) . '.pdf';

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

        $hacchuu_dts = HacchuuDts::find(array(
            //	        'columns' => array('cd, name'), 全項目とする
            'order' => 'cd, id DESC',
            'conditions' => ' cd = ?1 ',
            'bind' => array(1 => $this->request->getPost('cd') . '%')
        ));
        $res_flds = [
            "id",
            "cd",
            "nendo",
            "tekiyou",
            "hacchuubi",
            "nounyuu_kijitu",
            "juchuu_dt_id",
            "juchuu_dt_cd",
            "zeiritu_tekiyoubi",
            "shiiresaki_mr_cd",
            "torihiki_kbn_cd",
            "zei_tenka_kbn_cd",
            "tantou_mr_cd",
            "hassousaki_kbn_cd",
            "hassousaki_mr_cd",
            "hassousaki_mr_name",
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
            "hinsitu_kbn_cd",
            "souko_mr_cd",
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
            "gentanka",
            "tanka",
            "suuryou2",
            "kingaku",
            "genkagaku",
            "zeinukigaku",
            "zeigaku",
            "zeiritu_mr_cd",
            "bikou",
            "nouki",
        ];
        $resData = array();
        foreach ($hacchuu_dts as $hacchuu_dt) {
            $resAdata = array();
            foreach ($res_flds as $res_fld) {
                $resAdata[$res_fld] = $hacchuu_dt->$res_fld;
            }
            $resAdata['shiiresaki_mr_name'] = $hacchuu_dt->ShiiresakiMrs->name;
            if (count($hacchuu_dt->JuchuuDts) > 0) {
                $resAdata['juchuu_tokuisaki_mr_cd'] = $hacchuu_dt->JuchuuDts[0]->tokuisaki_mr_cd;
                $resAdata['juchuu_tokuisaki_mr_name'] = $hacchuu_dt->JuchuuDts[0]->TokuisakiMrs->name;
                $resAdata['juchuu_dt_id'] = $hacchuu_dt->JuchuuDts[0]->id; //Add by Nishiyama 2019/10/29
            }
            if ($hacchuu_dts->hassousaki_kbn_cd == 1) {
                $target = KihonMrs::findFirstByid(1);
            } else {
                $belong = 'Hassousaki' . $hacchuu_dt->hassousaki_kbn_cd . 'Mrs';
                $target = $hacchuu_dt->$belong;
            }
            $resAdata['hassousaki_mr_name'] = $target->name;
            foreach ($hacchuu_dt->HacchuuMeisaiDts as $hacchuu_meisai_dt) {
                foreach ($meisai_flds as $meisai_fld) {
                    $resAdata["meisai"][$hacchuu_meisai_dt->cd][$meisai_fld] = $hacchuu_meisai_dt->$meisai_fld;
                }
                $resAdata["meisai"][$hacchuu_meisai_dt->cd]['moto_tanni_mr2_cd'] = $hacchuu_meisai_dt->ShouhinMrs->tanni_mr2_cd;
                $resAdata["meisai"][$hacchuu_meisai_dt->cd]['suu_shousuu'] = $hacchuu_meisai_dt->ShouhinMrs->suu_shousuu;
                $resAdata["meisai"][$hacchuu_meisai_dt->cd]['suu1_shousuu'] = $hacchuu_meisai_dt->ShouhinMrs->suu1_shousuu;
                $resAdata["meisai"][$hacchuu_meisai_dt->cd]['suu2_shousuu'] = $hacchuu_meisai_dt->ShouhinMrs->suu2_shousuu;
                $resAdata["meisai"][$hacchuu_meisai_dt->cd]['tanka_shousuu'] = $hacchuu_meisai_dt->ShouhinMrs->tanka_shousuu;
                $resAdata["meisai"][$hacchuu_meisai_dt->cd]['zaiko_kbn'] = $hacchuu_meisai_dt->ShouhinMrs->zaiko_kbn;
                $resAdata["meisai"][$hacchuu_meisai_dt->cd]['zaikokanri'] = $hacchuu_meisai_dt->ShouhinMrs->zaikokanri;
                $resAdata["meisai"][$hacchuu_meisai_dt->cd]['souko_mr_name'] = $hacchuu_meisai_dt->SoukoMrs->name; // 発注明細の倉庫2019/06/11井浦
                $resAdata["meisai"][$hacchuu_meisai_dt->cd]['kazei_kbn_cd'] = $hacchuu_meisai_dt->ShouhinMrs->kazei_kbn_cd;
            }
            //	        $resAdata["seikyuusaki_name"] = $hacchuu_dt->SeikyuusakiMrs->name;
            $resData[] = $resAdata; //array('cd' => $hacchuu_dt->cd, 'name' => $hacchuu_dt->name);
        }

        //Set the content of the response
        $response->setContent(json_encode($resData));

        //Return the response
        return $response;
    }


    /*
     * 発注一覧データ
     * ./hacchuu_dts/summary 2019/10/09
    */
    public function summaryAction()
    {
        $db = \Phalcon\DI::getDefault()->get('db');
        if ($this->request->isPost()) {
            $param = $this->request->getPost();
            $having = "";
            switch ($param['kanryou_flg']) {
                case '0':   //未完了
                    $having = " HAVING nyuuka_kbn <> '完' ";
                    break;
                case '':    //全発注
                case '1':
                    $having = '';
                    break;
                case '2':    //完了
                    $having = " HAVING nyuuka_kbn = '完' ";
                    break;
            }

            $where_sub = " WHERE hms.utiwake_kbn_cd NOT IN ('40','41','12','13','22','30') "; //sub_query
            $where = "";
            //発注ナンバー
            if ($param['query_hacchu_no'] != '') {
                $where_sub .= "AND (hds.cd = " . $param['query_hacchu_no'] . ") ";
            }
            switch ($param['hyouji_flg']) {
                case '0': //明細表示
                    // これまでと同じなので何もしない
                    break;
                case '1': //製品のみ
                    $where_sub .= "AND (hms.utiwake_kbn_cd = '20') AND (hsh.zaikokanri = 1) ";
                    break;
                case '2': //部品のみ
                    $where_sub .= "AND (hms.utiwake_kbn_cd = '10') AND (hsh.zaikokanri = 1)  ";
                    break;
            }
            //仕入先コード
            if ($param['shiire_cd'] != '') {
                $where_sub .= "AND (hds.shiiresaki_mr_cd LIKE '" . $param['shiire_cd'] . "%') ";
            }
            //仕入先名称(like)
            if ($param['shiire_name'] != '') {
                if ($where === '') {
                    $where = "WHERE (i.name LIKE '%" . $param['shiire_name'] . "%') ";
                } else {
                    $where .= "AND (i.name LIKE '%" . $param['shiire_name'] . "%') ";
                }
            }
            //倉庫コード
            if ($param['souko_cd'] != '') {
                $where_sub .= "AND (hms.souko_mr_cd LIKE '" . $param['souko_cd'] . "%') ";
            }

            //倉庫名(like)
            if ($param['souko_name'] != '') {
                if ($where === '') {
                    $where = "WHERE (f.name LIKE '%" . $param['souko_name'] . "%') ";
                } else {
                    $where .= "AND (f.name LIKE '%" . $param['souko_name'] . "%') ";
                }
            }
            //商品コード(like)
            if ($param['shouhin_cd'] != '') {
                $where_sub .= "AND (hms.shouhin_mr_cd LIKE '" . $param['shouhin_cd'] . "%') ";
            }
            //商品名(like)
            if ($param['tekiyou'] != '') {
                $where_sub .= "AND (hms.tekiyou LIKE '%" . $param['tekiyou'] . "%') ";
            }
            //担当コード(=)
            if ($param['tantou_cd'] != '') {
                if ($where_sub === '') {
                    $where_sub = "WHERE (hds.tantou_mr_cd = '" . $param['tantou_cd'] . "') ";
                } else {
                    $where_sub .= "AND (hds.tantou_mr_cd = '" . $param['tantou_cd'] . "') ";
                }
            }
            //納期(Between)
            if ($param['nouki'] != '') {
                $param['nouki_to'] = '9999-12-31';
                $where_sub .= "AND (hds.nounyuu_kijitu BETWEEN '" . $param['nouki'] . "' AND '" . $param['nouki_to'] . "') ";
            }
            //期間(Between)
            if ($param['kikan_from'] != '') {
                if ($param['kikan_to'] == '') {
                    $param['kikan_to'] = '9999-12-31';
                }
                $where_sub .= "AND (hds.hacchuubi BETWEEN '" . $param['kikan_from'] . "' AND '" . $param['kikan_to'] . "') ";
            } else {
                if ($param['kikan_to'] != '') {
                    $param['kikan_from'] = '2012-01-01';
                }
                $where_sub .= "AND (hds.hacchuubi BETWEEN '" . $param['kikan_from'] . "' AND '" . $param['kikan_to'] . "') ";
            }
            $phql = "
                SELECT 
                    case when s_tbl.nyuuka_kbn = '5' then '完' when s_tbl.nyuuka_kbn = '8' then 'ｷｬﾝｾﾙ' else '' end as nyuuka_kbn,
                    h_tbl.hacchuu_suu1 - s_tbl.s_tbl_suuryou1 AS zan1, 
                    h_tbl.hacchuu_suu2 - s_tbl.s_tbl_suuryou2 AS zan2,
                    h_tbl.h_tbl_id AS hacchuu_id, 
                    h_tbl.h_tbl_cd AS hacchuu_no, 
                    h_tbl.h_tbl_tantou_mr_cd AS tantou_cd,
                    l.name AS tantou_name,
                    h_tbl.h_tbl_hacchuubi AS hacchuubi, 
                    h_tbl.h_tbl_nouki AS nouki, 
                    h_tbl_shiiresaki AS shiiresaki_mr_cd,
                    i.name AS shiiresaki_name,
                    h_tbl.h_tbl_shouhin_mr_cd AS shouhin_mr_cd, 
                    h_tbl.h_tbl_tekiyou AS tekiyou1, 
                    h_tbl.h_tbl_iro AS iroban, 
                    h_tbl.h_tbl_souko AS souko_mr_cd, 
                    f.name AS souko_name,
                    h_tbl.hacchuu_suu1 AS hacchuusuu, 
                    d.name AS tanni1,
                    h_tbl.hacchuu_suu2 AS hacchuuryou,
                    e.name AS tanni2,
                    h_tbl.h_tbl_tanka AS tanka,
                    s_tbl.s_tbl_id AS shiire_id,
                   	s_tbl.s_tbl_cd AS shiire_no
                FROM (
                    SELECT
                        hds.id AS h_tbl_id,
                        hds.cd AS h_tbl_cd,
                        hds.tantou_mr_cd AS h_tbl_tantou_mr_cd,
                        hds.hacchuubi AS h_tbl_hacchuubi,
                        hds.nounyuu_kijitu AS h_tbl_nouki,
                        hds.shiiresaki_mr_cd AS h_tbl_shiiresaki,
                        hms.shouhin_mr_cd AS h_tbl_shouhin_mr_cd,
                        hms.tekiyou AS h_tbl_tekiyou,
                        hms.iro AS h_tbl_iro,
                        hms.souko_mr_cd AS h_tbl_souko,
                        hms.tanni_mr1_cd AS h_tbl_tan1,
                        hms.tanni_mr2_cd AS h_tbl_tan2,
                        hms.gentanka AS h_tbl_tanka,
                        SUM(hms.suuryou1) AS hacchuu_suu1,
                        SUM(hms.suuryou2) AS hacchuu_suu2
                    FROM hacchuu_dts AS hds
                    LEFT JOIN hacchuu_meisai_dts AS hms ON hms.hacchuu_dt_id = hds.id
                    LEFT JOIN shouhin_mrs AS hsh ON hms.shouhin_mr_cd = hsh.cd
                    " . $where_sub . "
                    GROUP BY hds.id, hds.cd, hds.hacchuubi, hds.nounyuu_kijitu, 
                             hds.shiiresaki_mr_cd, hms.shouhin_mr_cd, hms.iro, hms.souko_mr_cd
               ) AS h_tbl
               LEFT JOIN (
                    SELECT 
                    MAX(b.id) AS s_tbl_id,
                    MAX(b.cd) AS s_tbl_cd,
                    b.hacchuu_dt_id AS s_tbl_hacchuu_dt_id,
                    MAX(c.nyuuka_kbn_cd) AS nyuuka_kbn,
                    c.shouhin_mr_cd AS s_tbl_shouhin_mr_cd,
                    c.iro AS s_tbl_iro,
                    c.souko_mr_cd AS s_tbl_souko_mr_cd,
                    SUM(c.suuryou1) AS s_tbl_suuryou1,
                    SUM(c.suuryou2) AS s_tbl_suuryou2
                    FROM shiire_dts AS b
                    LEFT JOIN shiire_meisai_dts AS c ON c.shiire_dt_id = b.id
                    GROUP BY b.hacchuu_dt_id,c.shouhin_mr_cd,c.iro, c.souko_mr_cd
                ) AS s_tbl ON h_tbl.h_tbl_id = s_tbl.s_tbl_hacchuu_dt_id AND h_tbl.h_tbl_shouhin_mr_cd = s_tbl.s_tbl_shouhin_mr_cd AND h_tbl.h_tbl_iro = s_tbl.s_tbl_iro AND h_tbl.h_tbl_souko = s_tbl.s_tbl_souko_mr_cd
                LEFT JOIN tanni_mrs AS d ON d.cd = h_tbl.h_tbl_tan1
                LEFT JOIN tanni_mrs AS e ON e.cd = h_tbl.h_tbl_tan2
				LEFT JOIN souko_mrs AS f ON f.cd = h_tbl.h_tbl_souko
				LEFT JOIN shiiresaki_mrs AS i ON i.cd = h_tbl.h_tbl_shiiresaki
				LEFT JOIN tantou_mrs AS l ON l.cd = h_tbl.h_tbl_tantou_mr_cd
				" . $where . "
                GROUP BY h_tbl.h_tbl_id, h_tbl.h_tbl_cd, h_tbl.h_tbl_shouhin_mr_cd, 
                         h_tbl.h_tbl_iro, h_tbl.hacchuu_suu1, h_tbl.hacchuu_suu2, h_tbl_souko
                " . $having . "
                ORDER BY h_tbl.h_tbl_id DESC
            ";
            $stmt = $db->prepare($phql);
            //            echo '<pre>';
            //            echo($phql);
            //            echo '</pre>';
            //
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $this->view->rows = $rows;
        } else {
            //初回表示
            $rows = [];
            return $this->view->rows = $rows;   //空配列を返す(何も表示しない)
        }
    }

    /*
     * Ajaxで完了・未完了切替 Add By Nishiyama
     */
    public function saveAjaxAction()
    {
        header("Content-type: text/plain; charset=UTF-8");
        $this->view->disable();
        $response = new \Phalcon\Http\Response();
        if (!$this->request->isAjax()) {
            echo "is not Ajax !! ";
        }
        if (!$this->request->isPost()) {
            echo "is not Post !! ";
        }
        $shiire_dt_id = $this->request->getPost('shiire_dt_id');
        $shouhin_mr_cd = $this->request->getPost('shouhin_mr_cd');
        $iro = "";
        $nyuuka_kbn = $this->request->getPost('nyuuka_kbn');
        if ($this->request->getPost('iro') !== '') {
            $iro = $this->request->getPost('iro');
        }
        if ($iro === "") {
            $shiire_meisai = ShiireMeisaiDts::findFirst("shiire_dt_id = {$shiire_dt_id} AND shouhin_mr_cd = '{$shouhin_mr_cd}'");
        } else {
            $shiire_meisai = ShiireMeisaiDts::findFirst("shiire_dt_id = {$shiire_dt_id} AND shouhin_mr_cd = '{$shouhin_mr_cd}' AND iro = '{$iro}'");
        }
        $shiire_meisai = $shiire_meisai->toArray();
        $db = \Phalcon\DI::getDefault()->get('db');
        if ($nyuuka_kbn === 'NULL') {
            $nyuuka_kbn = "''";
        }
        $phql = "UPDATE shiire_meisai_dts SET nyuuka_kbn_cd = {$nyuuka_kbn} WHERE id = {$shiire_meisai['id']}";
        $stmt = $db->prepare($phql);
        $stmt->execute();
        $response->setContent(json_encode($shiire_meisai['id']));
        return $response;
    }

    /**
     * 計画用に未完了かつ、未配台の発注データを返却する
     *
     * @return \Phalcon\Http\Response|\Phalcon\Http\ResponseInterface
     */
    public function getOrderDataAction()
    {
        header("Content-type: text/plain; charset=UTF-8");
        $this->view->disable();
        $supplier = $this->request->getPost('cd');
        $response = new \Phalcon\Http\Response();
        $db = \Phalcon\DI::getDefault()->get('db');

        // 未完了発注データを取得（発注先指定）
        $where_sub =
            " WHERE hms.utiwake_kbn_cd NOT IN ('40','41') AND (hms.utiwake_kbn_cd = '20') AND (hsh.zaikokanri = 1) "; //sub_query
        $where_sub .= "AND (hds.shiiresaki_mr_cd = '{$supplier}') ";
        $phql = "
            SELECT 
                IF(s_tbl.nyuuka_kbn = '5','完','') AS nyuuka_kbn, 
                h_tbl.h_tbl_id AS hacchuu_id, 
                h_tbl.h_tbl_cd AS hacchuu_no, 
                tantou_name AS tantou_name,
                h_tbl.h_tbl_nouki AS nounyuu_kijitu, 
                h_tbl_shiiresaki AS shiiresaki_mr_cd,
                h_tbl.h_tbl_shouhin_mr_cd AS shouhin_mr_cd, 
                h_tbl.h_tbl_tekiyou AS tekiyou1, 
                bikou AS bikou,
                h_tbl.tanka_kbn AS h_tanka_kbn,
               IF(h_tbl.tanka_kbn = 1, h_tbl.hacchuu_suu1, h_tbl.hacchuu_suu2) AS num
            FROM (
                SELECT
                    hds.id AS h_tbl_id,
                    hds.cd AS h_tbl_cd,
                    tan.name AS tantou_name,
                    hds.nounyuu_kijitu AS h_tbl_nouki,
                    hds.shiiresaki_mr_cd AS h_tbl_shiiresaki,
                    hms.bikou AS bikou,
                    hms.shouhin_mr_cd AS h_tbl_shouhin_mr_cd,
                    hms.tekiyou AS h_tbl_tekiyou,
                    hsh.tanka_kbn AS tanka_kbn,
                    SUM(hms.suuryou1) AS hacchuu_suu1,
                    SUM(hms.suuryou2) AS hacchuu_suu2
                FROM hacchuu_dts AS hds
                LEFT JOIN hacchuu_meisai_dts AS hms ON hms.hacchuu_dt_id = hds.id
                LEFT JOIN shouhin_mrs AS hsh ON hms.shouhin_mr_cd = hsh.cd
                LEFT JOIN tantou_mrs AS tan ON tan.cd = hds.tantou_mr_cd
                " . $where_sub . "
                GROUP BY hds.id, hds.cd, hds.hacchuubi, hds.nounyuu_kijitu, hds.shiiresaki_mr_cd, hms.shouhin_mr_cd
           ) AS h_tbl
           LEFT JOIN (
                    SELECT 
                    MAX(b.id) AS s_tbl_id,
                    MAX(b.cd) AS s_tbl_cd,
                    b.hacchuu_dt_id AS s_tbl_hacchuu_dt_id,
                    MAX(c.nyuuka_kbn_cd) AS nyuuka_kbn,
                    c.shouhin_mr_cd AS s_tbl_shouhin_mr_cd
                    FROM shiire_dts AS b
                    LEFT JOIN shiire_meisai_dts AS c ON c.shiire_dt_id = b.id
                    GROUP BY b.hacchuu_dt_id, c.shouhin_mr_cd
            ) AS s_tbl ON h_tbl.h_tbl_id = s_tbl.s_tbl_hacchuu_dt_id AND h_tbl.h_tbl_shouhin_mr_cd = s_tbl.s_tbl_shouhin_mr_cd
            LEFT JOIN shiiresaki_mrs AS i ON i.cd = h_tbl.h_tbl_shiiresaki
            GROUP BY h_tbl.h_tbl_id, h_tbl.h_tbl_cd, h_tbl.h_tbl_shouhin_mr_cd,  h_tbl.hacchuu_suu1, h_tbl.hacchuu_suu2
            HAVING nyuuka_kbn <> '完'
            ORDER BY h_tbl.h_tbl_id DESC
        ";
        $stmt = $db->prepare($phql);
        $stmt->execute();
        $hacchuu_rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // 計画済みデータの取得
        $phql = "
            SELECT
                a.hacchuu_dt_id AS hacchuu_id,
                a.shiiresaki_mr_cd AS shiiresaki_mr_cd,
                b.shouhin_mr_cd AS shouhin_mr_cd,
                SUM(b.keikaku_ryou1) AS keikaku_sumi_ryou1,
                SUM(b.keikaku_ryou2) AS keikaku_sumi_ryou2
            FROM gyoumu_dts AS a
            LEFT JOIN gyoumu_meisai_dts AS b ON a.id = b.gyoumu_dt_id
            WHERE a.shiiresaki_mr_cd = '{$supplier}'
            GROUP BY a.id, a.shiiresaki_mr_cd, b.shouhin_mr_cd
        ";
        $stmt = $db->prepare($phql);
        $stmt->execute();
        $keikaku_rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $rows = []; // viewへ渡す配列

        if (count($keikaku_rows) !== 0) {
            $counter = 0;
            for ($i = 0; $i < count($hacchuu_rows); $i++) {
                $flg = false;
                $key = $hacchuu_rows[$i]['shouhin_mr_cd'];
                $hacchuu_id = (int)$hacchuu_rows[$i]['hacchuu_id'];
                for ($j = 0; $j < count($keikaku_rows); $j++) {
                    if ($hacchuu_id === (int)$keikaku_rows[$j]['hacchuu_id'] && $key === $keikaku_rows[$j]['shouhin_mr_cd']) {
                        // 単価区分でどちらの単位で計画されているか判定する
                        if ($hacchuu_rows[$i]['h_tanka_kbn'] === '1') {
                            $num = (float)$hacchuu_rows[$i]['num'] - (float)$keikaku_rows[$j]['keikaku_sumi_ryou1'];
                        } else {
                            $num = (float)$hacchuu_rows[$i]['num'] - (float)$keikaku_rows[$j]['keikaku_sumi_ryou2'];
                        }
                        // 発注数量 - 計画数量  < 0 の場合は、配台済みと判定しスキップする
                        if ($num <= 0) {
                            continue 2;
                        }

                        // jsへ渡す変数へ代入
                        $rows[$counter]['num'] = $num;
                        $rows[$counter]['hacchuu_id'] = $hacchuu_rows[$i]['hacchuu_id'];
                        $rows[$counter]['hacchuu_no'] = $hacchuu_rows[$i]['hacchuu_no'];
                        $rows[$counter]['shouhin_mr_cd'] = $hacchuu_rows[$i]['shouhin_mr_cd'];
                        $rows[$counter]['tantou_name'] = $hacchuu_rows[$i]['tantou_name'];
                        $rows[$counter]['nounyuu_kijitu'] = $hacchuu_rows[$i]['nounyuu_kijitu'];
                        $rows[$counter]['shiiresaki_mr_cd'] = $hacchuu_rows[$i]['shiiresaki_mr_cd'];
                        $rows[$counter]['tekiyou1'] = $hacchuu_rows[$i]['tekiyou1'];
                        $rows[$counter]['bikou'] = $hacchuu_rows[$i]['bikou'];

                        $counter++;
                        $flg = true;
                        break;
                    }
                }
                if (!$flg) {
                    $rows[$counter] = $hacchuu_rows[$i];
                    $counter++;
                }
            }
        } else {
            $rows = $hacchuu_rows;
        }

        return $response->setContent(json_encode($rows));
    }
}
