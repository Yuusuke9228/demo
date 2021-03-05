<?php

class UriageDtsController extends ControllerBase
{
    /*
	 * 受注一覧より、受注に紐づいた売上明細を表示
	 */
    public function uriage_listAction()
    {
        $di = \Phalcon\DI::getDefault();
        $mgr = $di->get('modelsManager');
        $juchuu_id = $this->request->getQuery('juchuu_id');
        $shouhin_mr_cd = $this->request->getQuery('shouhin_mr_cd');
        $iro = $this->request->getQuery('iro');
        $phql = "
            SELECT
                a.id AS id,
                a.cd AS uriage_no,
                a.juchuu_dt_id AS uriage_juchuu_no,
                b.shouhin_mr_cd AS uriage_shouhin_mr_cd,
                c.name AS shouhin_name,
                b.suuryou1 AS uriage_suu,
                d.name AS uriage_tanni1,
                b.suuryou2 AS uriage_ryou,
                e.name AS uriage_tanni2,
				b.tanka AS uriage_tanka,
                b.shukka_kbn_cd AS shukka_kbn_cd,
                a.uriagebi AS uriagebi,
                f.name AS shukka_kbn
            FROM UriageDts AS a
            LEFT JOIN UriageMeisaiDts AS b ON b.uriage_dt_id = a.id
            LEFT JOIN ShouhinMrs AS c ON c.cd = b.shouhin_mr_cd
            LEFT JOIN TanniMrs AS d ON d.cd = b.tanni_mr1_cd
            LEFT JOIN TanniMrs AS e ON e.cd = b.tanni_mr2_cd
            LEFT JOIN ShukkaKbns AS f ON f.cd = b.shukka_kbn_cd 
            WHERE NOT (b.utiwake_kbn_cd = '40' OR b.utiwake_kbn_cd = '41') AND (a.juchuu_dt_id = :juchuu_id:) AND (b.shouhin_mr_cd = :shouhin_mr_cd:) AND (b.iro = :iro:)
            ORDER BY b.id DESC
        ";
        $rows = $mgr->executeQuery($phql, ['juchuu_id' => $juchuu_id, 'shouhin_mr_cd' => $shouhin_mr_cd, 'iro' => $iro,]);
        $this->view->rows = $rows;
    }

    /**
     * Index action
     */
    public function indexAction()
    {
        ControllerBase::indexCd("UriageDts", "売上伝票", "uriagebi DESC"); //初期表示は伝票番号の降順
    }

    /**
     * モーダル
     */
    public function modalAction()
    {
        ControllerBase::indexCd("UriageDts", "売上伝票", "uriagebi DESC");
    }

    /**
     * Searches for uriage_dts
     */
    public function searchAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Displays the creation form
     */
    public function newAction($id = null, $dataname = "Uriage")
    {
        $this->view->imax = 0;
        $zeiritu_mrs = ZeirituMrs::find(['order' => 'kazei_kbn_cd, kijunbi DESC']);
        $this->view->zeiritu_mrs = $zeiritu_mrs;

        $tanka_shurui_kbns = TankaShuruiKbns::find(['order' => 'cd', 'conditions' => 'uriage_flg = 1']);
        $this->view->tanka_shurui_kbns = $tanka_shurui_kbns;

        if ($id) {
            if (substr($dataname, 0, 1) == '-') { // 赤伝発行機能追加2019/03/16井浦
                $nameDts = substr($dataname, 1) . "Dts";
            } else {
                $nameDts = $dataname . "Dts";
            }
            $uriage_dt = $nameDts::findFirstByid($id);
            if (!$uriage_dt) {
                $this->flash->error($dataname . "伝票が見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "uriage_dts",
                    'action' => 'index'
                ));

                return;
            }
            $this->_setDefault($uriage_dt, "new", $dataname);
            $this->tag->setDefault("id", null);
            $this->tag->setDefault("cd", null);
            $this->tag->setDefault("uriagebi", null);
        }
        $this->tag->setDefault("uriagebi", date("Y-m-d"));
        $this->tag->setDefault("sakusei_user_name", $this->getDI()->getSession()->get('auth')['name']);
        $this->tag->setDefault("updated", null);

        $readonly_ctlr = new ReadonlyFieldKbnsController();
        $this->view->readonlys = $readonly_ctlr->setFormFieldReadonlys('UriageDts', 'inputfields');
        $rewidth_ctlr = new RewidthFieldMrsController();
        $this->view->rewidths = $rewidth_ctlr->setFormFieldRewidths('UriageDts', 'inputfields');
    }

    /**
     * 修正画面から「次へ」ボタンを押したら次のコードの修正画面になる。
     */
    public function nextAction($id)
    {
        ControllerBase::nextCd($id, "uriage_dts", "UriageDts", "売上伝票");
    }

    /**
     * 修正画面から「前へ」ボタンを押したら前のコードの修正画面になる。
     */
    public function prevAction($id = 0)
    {
        ControllerBase::prevCd($id, "uriage_dts", "UriageDts", "売上伝票");
    }

    /**
     * Edits a uriage_dt
     *
     * @param string $id
     */
    public function editAction($id, $exp = null)
    {
//        if (!$this->request->isPost()) {

        $uriage_dt = UriageDts::findFirstByid($id);
        if (!$uriage_dt) {
            $this->flash->error("売上伝票が見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "uriage_dts",
                'action' => 'index'
            ));

            return;
        }

        $url = new Phalcon\Mvc\Url();

        $this->view->id = $uriage_dt->id;
        if (!empty($exp)) { // 伝票印刷やexcel出力するとき $exp=帳票ID=$chouhyou_mr_id
            $this->view->exp = $this->url->get('uriage_dts/denpyou/' . $id . '/' . $exp); //作成・更新後にedit画面が出たときにExcelをexportする←createAction最後・saveAction最後→app/views/index.volt
        }

        $this->_setDefault($uriage_dt, "edit");

        $zeiritu_mrs = ZeirituMrs::find(['order' => 'kazei_kbn_cd, kijunbi DESC']);
        $this->view->zeiritu_mrs = $zeiritu_mrs;

        $tanka_shurui_kbns = TankaShuruiKbns::find(['order' => 'cd', 'conditions' => 'uriage_flg = 1']);
        $this->view->tanka_shurui_kbns = $tanka_shurui_kbns;

        if (count($uriage_dt->TokuisakiMrs->TokuisakiSimeDts) > 0) {
            $this->view->simezumibi = $uriage_dt->TokuisakiMrs->TokuisakiSimeDts[0]->sime_hiduke; // 最終締日
        }
//        }
        $readonly_ctlr = new ReadonlyFieldKbnsController();
        $this->view->readonlys = $readonly_ctlr->setFormFieldReadonlys('UriageDts', 'inputfields');
        $rewidth_ctlr = new RewidthFieldMrsController();
        $this->view->rewidths = $rewidth_ctlr->setFormFieldRewidths('UriageDts', 'inputfields');
    }

    /**
     * 画面に表示するデータをセットする
     */
    public function _setDefault($uriage_dt, $action = "edit", $meisai = "Uriage")
    {
        $sgn = 1;
        if (substr($meisai, 0, 1) == '-') { // 赤伝発行機能追加2019/03/16井浦
            $sgn = -1;
            $meisai = substr($meisai, 1);
        }
        $setdts = [
            "id",
            "cd",
            "nendo",
            "tekiyou",
            "uriagebi",
            "juchuu_dt_id",
            "mitumori_dt_id",
            "saki_hacchuu_cd",
            "shounin_joutai_flg",
            "shounin_sha_mr_cd",
            "zeiritu_tekiyoubi",
            "tokuisaki_mr_cd",
            "torihiki_kbn_cd",
            "zei_tenka_kbn_cd",
            "nounyuusaki_mr_cd",
            "nounyuusaki",
            "kidukesaki_mr_cd",
            "kiduke",
            "shukkabi",
            "tantou_mr_cd",
            "shimekiri_flg",
            "tanka_shurui_kbn_cd",
            "seikyuusho_dt_cd",
            "keshikomi_flg",
            "nounyuu_kijitu",
            "bunrui_cd",
            //	"denpyou_kbn",
            //	"sakusei_user_id",
            "created",
            "updated",
        ];
        foreach ($setdts as $setdt) {
            if (property_exists($uriage_dt, $setdt)) {
                $this->tag->setDefault($setdt, $uriage_dt->$setdt);
            }
        }
        if ($meisai == "Juchuu") {
            $this->tag->setDefault("juchuu_dt_id", $uriage_dt->id);
            $this->tag->setDefault("juchuu_dt_cd", $uriage_dt->cd);
        } else if ($meisai == "Shiire") {
            $this->tag->setDefault("juchuu_dt_cd", $uriage_dt->HacchuuDts->juchuu_dt_cd);
            if (count($uriage_dt->HacchuuDts->JuchuuDts) > 0) {
                $this->tag->setDefault("juchuu_dt_id", $uriage_dt->HacchuuDts->JuchuuDts[0]->id);
            }
        } else {
            if (property_exists($uriage_dt, "juchuu_dt_id")) {
                $this->tag->setDefault("juchuu_dt_cd", $uriage_dt->JuchuuDts->cd);
            }
        }
        if ($meisai == "Mitumori") {
            $this->tag->setDefault("mitumori_dt_id", $uriage_dt->id);
            $this->tag->setDefault("mitumori_dt_cd", $uriage_dt->cd);
        } else {
            if (property_exists($uriage_dt, "mitumori_dt_id")) {
                $this->tag->setDefault("mitumori_dt_cd", $uriage_dt->MitumoriDts->cd);
            }
        }
        if (property_exists($uriage_dt, "zeiritu_tekiyoubi")) {
            $this->tag->setDefault("zeiritu_tekiyoubi", ($uriage_dt->zeiritu_tekiyoubi == "0000-00-00") ? "" : $uriage_dt->zeiritu_tekiyoubi);
        }
        if (property_exists($uriage_dt, "kaishuu_yoteibi")) {
            $this->tag->setDefault("kaishuu_yoteibi", ($uriage_dt->kaishuu_yoteibi == "0000-00-00") ? "" : $uriage_dt->kaishuu_yoteibi);
        }
        $this->tag->setDefault("simezumibi", "0000-00-00");// 最終締日
        if (property_exists($uriage_dt, "tokuisaki_mr_cd")) {
            $this->tag->setDefault("tokuisaki_mr_zandaka", number_format($uriage_dt->TokuisakiMrs->kake_zandaka));
            $this->tag->setDefault("tokuisaki_mr_name", $uriage_dt->TokuisakiMrs->name);
            $this->tag->setDefault("seikyuusaki_name", $uriage_dt->TokuisakiMrs->SeikyuusakiMrs->name);
            $this->tag->setDefault("gaku_hasuu_shori_kbn_cd", $uriage_dt->TokuisakiMrs->gaku_hasuu_shori_kbn_cd);//端数処理設定用
            $this->tag->setDefault("zei_hasuu_shori_kbn_cd", $uriage_dt->TokuisakiMrs->zei_hasuu_shori_kbn_cd);//端数処理設定用
            $this->tag->setDefault("kakeritu", number_format($uriage_dt->TokuisakiMrs->kakeritu, 1));
            $this->tag->setDefault("simezumibi", count($uriage_dt->TokuisakiMrs->TokuisakiSimeDts) ? $uriage_dt->TokuisakiMrs->TokuisakiSimeDts[0]->sime_hiduke : "0000-00-00");// 最終締日
        }
//		if (property_exists($uriage_dt, "nounyuusaki_mr_cd")) {$this->tag->setDefault("nounyuusaki_mr_name", $uriage_dt->nounyuusaki_mr_cd == ''?'':$uriage_dt->NounyuusakiMrs->name);}
        $this->tag->setDefault("sakusei_user_name", $uriage_dt->SakuseiUsers->name);
        $this->tag->setDefault("chouhyou_mr_id_org", $uriage_dt->TokuisakiMrs->shitei_uriden_kbn_cd);
        // $this->tag->setDefault("chouhyou_mr_id", 0);

        $juchuu_zan = [];
        if ($uriage_dt->juchuu_dt_id) { // 受注残量取得 2019/10/08 色番も注残対象
            $di = \Phalcon\DI::getDefault();
            $mgr = $di->get('modelsManager');
            $phql = "SELECT shouhin_mr_cd, iro, sum(juchuuzan_ryou1) AS zan_ryou1, sum(juchuuzan_ryou2) AS zan_ryou2
				FROM ZaikoKakuninAzukariVws
				WHERE juchuu_dt_id = :id:
				GROUP BY shouhin_mr_cd,iro";
            $rows = $mgr->executeQuery($phql, ['id' => $uriage_dt->juchuu_dt_id]);
            foreach ($rows as $row) {
                $juchuu_zan[$row->shouhin_mr_cd][$row->iro] = ['zan_ryou1' => $row->zan_ryou1, 'zan_ryou2' => $row->zan_ryou2];
            }
        }

        $meisai_dts = $meisai . "MeisaiDts";
        $setmss = [
            "id",
            "utiwake_kbn_cd",
            "kousei",
            "shukka_kbn_cd",
            "shouhin_mr_cd",
            "tanni_mr_cd",
            "kousei",
            "tanni_mr1_cd",
            "tanni_mr2_cd",
            "tanka_kbn",
            "irisuu",
            "keisu",
            "tekiyou",
            "lot",
            "iro",
            "iromei",
            "kobetucd",
            "hinsitu_kbn_cd",
            "souko_mr_cd",
            "project_mr_cd",
            "zeiritu_mr_cd",
            "bikou",
            "zeinukigaku",
            "zeigaku",
            "updated"
        ];
        $i = 0;
        foreach ($uriage_dt->$meisai_dts as $uriage_meisai_dt) {
            foreach ($setmss as $setms) {
                if (property_exists($uriage_meisai_dt, $setms)) {
                    $this->tag->setDefault("data[uriage_meisai_dts][" . $i . "][" . $setms . "]", $uriage_meisai_dt->$setms);
                }
            }
            if ($action == "new") {
                $this->tag->setDefault("data[uriage_meisai_dts][" . $i . "][id]", null);
                $this->tag->setDefault("data[uriage_meisai_dts][" . $i . "][shukka_kbn_cd]", null);
            }
            $this->tag->setDefault("data[uriage_meisai_dts][" . $i . "][cd]", $i + 1);//行番を振りなおす
            if (property_exists($uriage_meisai_dt, "shouhin_mr_cd")) {
                if (property_exists($uriage_meisai_dt, "suuryou")) {
                    $this->tag->setDefault("data[uriage_meisai_dts][" . $i . "][suuryou]", number_format($sgn * $uriage_meisai_dt->suuryou, $uriage_meisai_dt->ShouhinMrs->suu_shousuu));
                }
                if (property_exists($uriage_meisai_dt, "suuryou1")) {
                    $this->tag->setDefault("data[uriage_meisai_dts][" . $i . "][suuryou1]", number_format($sgn * $uriage_meisai_dt->suuryou1, $uriage_meisai_dt->ShouhinMrs->suu1_shousuu));
                }
                if (property_exists($uriage_meisai_dt, "suuryou2")) {
                    $this->tag->setDefault("data[uriage_meisai_dts][" . $i . "][suuryou2]", number_format($sgn * $uriage_meisai_dt->suuryou2, $uriage_meisai_dt->ShouhinMrs->suu2_shousuu));
                }
                if (property_exists($uriage_meisai_dt, "gentanka")) {
                    $this->tag->setDefault("data[uriage_meisai_dts][" . $i . "][gentanka]", number_format($uriage_meisai_dt->gentanka, $uriage_meisai_dt->ShouhinMrs->tanka_shousuu));
                }
                if (property_exists($uriage_meisai_dt, "tanka")) {
                    $this->tag->setDefault("data[uriage_meisai_dts][" . $i . "][tanka]", number_format($uriage_meisai_dt->tanka, $uriage_meisai_dt->ShouhinMrs->tanka_shousuu));
                }
                if (property_exists($uriage_meisai_dt, "kingaku")) {
                    $this->tag->setDefault("data[uriage_meisai_dts][" . $i . "][kingaku]", number_format($sgn * $uriage_meisai_dt->kingaku));
                }
                $this->tag->setDefault("data[uriage_meisai_dts][" . $i . "][suu_shousuu]", $uriage_meisai_dt->ShouhinMrs->suu_shousuu);//桁数設定用
                $this->tag->setDefault("data[uriage_meisai_dts][" . $i . "][suu1_shousuu]", $uriage_meisai_dt->ShouhinMrs->suu1_shousuu);//桁数設定用
                $this->tag->setDefault("data[uriage_meisai_dts][" . $i . "][suu2_shousuu]", $uriage_meisai_dt->ShouhinMrs->suu2_shousuu);//桁数設定用
                $this->tag->setDefault("data[uriage_meisai_dts][" . $i . "][tanka_shousuu]", $uriage_meisai_dt->ShouhinMrs->tanka_shousuu);//桁数設定用
                $this->tag->setDefault("data[uriage_meisai_dts][" . $i . "][zaiko_kbn]", $uriage_meisai_dt->ShouhinMrs->zaiko_kbn);//桁数設定用
                $this->tag->setDefault("data[uriage_meisai_dts][" . $i . "][moto_tanni_mr_cd]", $uriage_meisai_dt->ShouhinMrs->tanni_mr_cd);//桁数設定用
                $this->tag->setDefault("data[uriage_meisai_dts][" . $i . "][kazei_kbn_cd]", $uriage_meisai_dt->ShouhinMrs->kazei_kbn_cd);//税率計算用
            }
            if ($uriage_dt->juchuu_dt_id) {
                $tk = $uriage_meisai_dt->ShouhinMrs->tanka_kbn; // 注残の為の単価区分
                $sho = 'suu' . $tk . '_shousuu'; // 注残の為の数量小数桁数項目名
                $this->tag->setDefault("data[uriage_meisai_dts][" . $i . "][juchuuzan]", number_format($juchuu_zan[$uriage_meisai_dt->shouhin_mr_cd][$uriage_meisai_dt->iro]['zan_ryou' . $tk], $uriage_meisai_dt->ShouhinMrs->$sho));
            }

            $i++;
        }
        $this->view->imax = $i;
    }

    /**
     * Creates a new uriage_dt
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "uriage_dts",
                'action' => 'index'
            ));

            return;
        }

        $uriage_dt = new UriageDts();
        $post_flds = [
            "cd",
            "nendo",
            "tekiyou",
            "uriagebi",
            "juchuu_dt_id",
            "mitumori_dt_id",
            "saki_hacchuu_cd",
            "shounin_joutai_flg",
            "shounin_sha_mr_cd",
            "zeiritu_tekiyoubi",
            "tokuisaki_mr_cd",
            "torihiki_kbn_cd",
            "zei_tenka_kbn_cd",
            "nounyuusaki_mr_cd",
            "nounyuusaki",
            "kidukesaki_mr_cd",
            "kiduke",
            "shukkabi",
            "tantou_mr_cd",
            "shimekiri_flg",
            "tanka_shurui_kbn_cd",
            "kaishuu_yoteibi",
            "seikyuusho_dt_cd",
            "keshikomi_flg",
            "nounyuu_kijitu",
            //	"bunrui_cd",
            //	"denpyou_kbn",
            "updated",
        ];

        $meisai_flds = [
            "cd",
            "utiwake_kbn_cd",
            "kousei",
            "shukka_kbn_cd",
            "shouhin_mr_cd",
            "tanni_mr_cd",
            "kousei",
            "tanni_mr1_cd",
            "tanni_mr2_cd",
            "tanka_kbn",
            "irisuu",
            "keisu",
            "tekiyou",
            "lot",
            "iro",
            "iromei",
            "kobetucd",
            "hinsitu_kbn_cd",
            "souko_mr_cd",
            "suuryou",
            "suuryou1",
            "suuryou2",
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
        $thisPost["zeiritu_tekiyoubi"] = ($this->request->getPost("zeiritu_tekiyoubi") == "") ? "0000-00-00" : $this->request->getPost("zeiritu_tekiyoubi");
        $thisPost["kaishuu_yoteibi"] = ($this->request->getPost("kaishuu_yoteibi") == "") ? "0000-00-00" : $this->request->getPost("kaishuu_yoteibi");
        $thisPost["shukkabi"] = ($this->request->getPost("shukkabi") == "") ? "0000-00-00" : $this->request->getPost("shukkabi");

        foreach ($post_flds as $post_fld) {
            $uriage_dt->$post_fld = array_key_exists($post_fld, $thisPost) ? $thisPost[$post_fld] : $this->request->getPost($post_fld);
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
        $uriage_dt->UriageMeisaiDts = array();
        $UriageMeisaiDts = array();
        $i = 0;

        foreach ($meisai["uriage_meisai_dts"] as $uriage_meisai_dt) {
            if ($uriage_meisai_dt["shouhin_mr_cd"] !== ''
                && $uriage_meisai_dt["cd"] !== ''
                && $uriage_meisai_dt["cd"] !== '0'
                && $uriage_meisai_dt["utiwake_kbn_cd"] !== '') {
//            if ($uriage_meisai_dt["shouhin_mr_cd"] != '') {
                $meisaicnv[$i] = [];
                foreach ($meisai_nums as $meisai_num) {
                    $meisaicnv[$i][$meisai_num] = str_replace(',', '', $uriage_meisai_dt[$meisai_num]);//カンマ除去
                }
                if ($zeinuki_chousei_gaku != 0
                    && $uriage_meisai_dt["zeiritu_mr_cd"] < '80') { // 消費税調整と税抜額調整が必要な場合はする
                    $meisaicnv[$i]["zeinukigaku"] += $zeinuki_chousei_muki;
                    $zeinuki_chousei_gaku -= $zeinuki_chousei_muki;
                }
                if ($zei_chousei_gaku != 0
                    && $uriage_meisai_dt["zeiritu_mr_cd"] < '80') {
                    $meisaicnv[$i]["zeigaku"] += $zei_chousei_muki;
                    $zei_chousei_gaku -= $zei_chousei_muki;
                }
                $UriageMeisaiDts[$i] = new UriageMeisaiDts();
                foreach ($meisai_flds as $meisai_fld) {
                    $UriageMeisaiDts[$i]->$meisai_fld = array_key_exists($meisai_fld, $meisaicnv[$i]) ? $meisaicnv[$i][$meisai_fld] : $uriage_meisai_dt[$meisai_fld] ?? '';
                    //更新日時や更新者はModelに定義してある
                }
                $i++;
            }
        }
        $uriage_dt->UriageMeisaiDts = $UriageMeisaiDts;

        /* 伝票番号付番または再設定 */
        $den_ban_ctrl = new DenpyouBangouMrsController(); //伝票番号マスタコントローラ
        $nendo_ban = $den_ban_ctrl->countup('uriage', 0, $uriage_dt->uriagebi); // 新規なので$uriage_dt->cd使わない2019/03/16井浦
        if (!$nendo_ban['nendo']) {
            $this->flash->error("エラー:年度が未登録（日付が今年か昨年以外は不可）。" . $uriage_dt->uriagebi);
            $this->dispatcher->forward(array(
                'controller' => "uriage_dts",
                'action' => 'edit',
                'params' => array($id)
            ));
        }
        $uriage_dt->cd = $nendo_ban['bangou'];
        $uriage_dt->nendo = $nendo_ban['nendo'];

        if (!$uriage_dt->save()) {
            foreach ($uriage_dt->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "uriage_dts",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("売上伝票の作成が完了しました。");

        $chouhyou_mr_id = $this->request->getPost('chouhyou_mr_id'); // 帳票マスタのid

        $this->dispatcher->forward(array(
            'controller' => "uriage_dts",
            'action' => 'edit',
            'params' => array($uriage_dt->id, $chouhyou_mr_id)
        ));
    }

    /**
     * Saves a uriage_dt edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "uriage_dts",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $uriage_dt = UriageDts::findFirstByid($id);

        if (!$uriage_dt) {
            $this->flash->error("売上伝票が見つからなくなりました。" . $id);

            $this->dispatcher->forward(array(
                'controller' => "uriage_dts",
                'action' => 'index'
            ));

            return;
        }

        $post_flds = [
            "cd",
            "tekiyou",
            "uriagebi",
            "juchuu_dt_id",
            "mitumori_dt_id",
            "saki_hacchuu_cd",
            "shounin_joutai_flg",
            "shounin_sha_mr_cd",
            "zeiritu_tekiyoubi",
            "tokuisaki_mr_cd",
            "torihiki_kbn_cd",
            "zei_tenka_kbn_cd",
            "nounyuusaki_mr_cd",
            "nounyuusaki",
            "kidukesaki_mr_cd",
            "kiduke",
            "shukkabi",
            "tantou_mr_cd",
            "shimekiri_flg",
            "tanka_shurui_kbn_cd",
            "kaishuu_yoteibi",
            "seikyuusho_dt_cd",
            "keshikomi_flg",
            "nounyuu_kijitu",
            //	"bunrui_cd",
            //	"denpyou_kbn",
            "updated",
        ];

        $meisai_flds = [
            "id",
            "cd",
            "utiwake_kbn_cd",
            "kousei",
            "shukka_kbn_cd",
            "shouhin_mr_cd",
            "tanni_mr_cd",
            "kousei",
            "tanni_mr1_cd",
            "tanni_mr2_cd",
            "tanka_kbn",
            "irisuu",
            "keisu",
            "tekiyou",
            "lot",
            "iro",
            "iromei",
            "kobetucd",
            "hinsitu_kbn_cd",
            "souko_mr_cd",
            "suuryou",
            "suuryou1",
            "suuryou2",
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

        if ($uriage_dt->updated !== $this->request->getPost("updated")) {
            $this->flash->error("他のプロセスから売上伝票が変更されたため更新を中止しました。"
                . $id . ",uid=" . $uriage_dt->kousin_user_id . " tb=" . $uriage_dt->updated . " pt=" . $this->request->getPost("updated"));

            $this->dispatcher->forward(array(
                'controller' => "uriage_dts",
                'action' => 'index'
            ));

            return;
        }

        $meisai = $this->request->getPost("data");
        $i = 0;
        foreach ($meisai["uriage_meisai_dts"] as $uriage_meisai_dt) {
            if ((int)$uriage_meisai_dt["id"] !== 0) {
                if ((int)$uriage_dt->UriageMeisaiDts[$i]->id !== (int)$uriage_meisai_dt["id"] ||
                    $uriage_dt->UriageMeisaiDts[$i]->updated !== $uriage_meisai_dt["updated"]) {
                    $this->flash->error("他のプロセスから売上伝票明細が変更されたため中止しました。"
                        . $id . ",id=" . $uriage_dt->UriageMeisaiDts[$i]->id . ",uid=" . $uriage_dt->UriageMeisaiDts[$i]->kousin_user_id
                        . " tb=" . $uriage_dt->UriageMeisaiDts[$i]->updated . " pt=" . $uriage_meisai_dt["updated"]);

                    $this->dispatcher->forward(array(
                        'controller' => "uriage_dts",
                        'action' => 'index'
                    ));

                    return;
                }
            }
            $i++;
        }

        $thisPost = [];
        $thisPost["zeiritu_tekiyoubi"] = ($this->request->getPost("zeiritu_tekiyoubi") == "") ? "0000-00-00" : $this->request->getPost("zeiritu_tekiyoubi");
        $thisPost["kaishuu_yoteibi"] = ($this->request->getPost("kaishuu_yoteibi") == "") ? "0000-00-00" : $this->request->getPost("kaishuu_yoteibi");
        $thisPost["shukkabi"] = ($this->request->getPost("shukkabi") == "") ? "0000-00-00" : $this->request->getPost("shukkabi");

        $chg_flg = 0;
        foreach ($post_flds as $post_fld) {
            if ((array_key_exists($post_fld, $thisPost) ? $thisPost[$post_fld] : $this->request->getPost($post_fld)) !== $uriage_dt->$post_fld) {
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
        foreach ($meisai["uriage_meisai_dts"] as $uriage_meisai_dt) {
            $meisaicnv[$i] = [];
            foreach ($meisai_nums as $meisai_num) {
                $meisaicnv[$i][$meisai_num] = (double)str_replace(',', '', $uriage_meisai_dt[$meisai_num]);//カンマ除去
            }
            if ((int)$uriage_meisai_dt["cd"] !== 0
                && $uriage_meisai_dt["zeiritu_mr_cd"] < '80') { // 消費税調整と税抜額調整が必要な場合はする
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
            if ((int)$uriage_meisai_dt["cd"] === 0 && (int)$uriage_meisai_dt["id"] !== 0) { // 削除の条件
                $chg_flg = 1;
                $chg_flgs[$i] = 2;//削除
            } else if ((int)$uriage_meisai_dt["id"] === 0) { // echo ($uriage_meisai_dt["id"] === "")?"null":"0";//nullの伝わり方
                if ((int)$uriage_meisai_dt["id"] !== 0 || (int)$uriage_meisai_dt["utiwake_kbn_cd"] !== 0) {
                    $chg_flg = 1;
                    $chg_flgs[$i] = 1;
                }
            } else if ((int)$uriage_meisai_dt["cd"] !== 0) {
                foreach ($meisai_flds as $meisai_fld) {
                    if ((array_key_exists($meisai_fld, $meisaicnv[$i]) ? $meisaicnv[$i][$meisai_fld] : $uriage_meisai_dt[$meisai_fld]) . '' !== $uriage_dt->UriageMeisaiDts[$i]->$meisai_fld) {
                        $chg_flg = 1;
                        $chg_flgs[$i] = 1;
                        break;
                    }
                }
            }
            $i++;
        }

        $chouhyou_mr_id = $this->request->getPost('chouhyou_mr_id'); // 帳票マスタのid
        if ($chg_flg === 0 || $chouhyou_mr_id) {
            if ($chouhyou_mr_id) {
                $chouhyou_id = $chouhyou_mr_id;
                $this->tag->setDefault('chouhyou_mr_id', ''); //帳票Idをクリアしてやらないと毎回印刷しか出来ない。
                $this->denpyouAction($id, $chouhyou_id); //印刷イメージ作成
                $this->dispatcher->forward(array(
                    "controller" => "uriage_dts",
                    "action" => "edit",
                    "params" => array($id, $chouhyou_id)
                ));

                return;
            } else {
                $this->flash->error("変更がありません。" . $id);

                $this->dispatcher->forward(array(
                    "controller" => "uriage_dts",
                    "action" => "edit",
                    "params" => array($uriage_dt->id)
                ));

                return;
            }
        }
        $this->_bakOut($uriage_dt, 0, $chg_flgs);

        foreach ($post_flds as $post_fld) {
            $uriage_dt->$post_fld = array_key_exists($post_fld, $thisPost) ? $thisPost[$post_fld] : $this->request->getPost($post_fld);
        }
        /* 伝票番号付番または再設定 */
        $den_ban_ctrl = new DenpyouBangouMrsController(); //伝票番号マスタコントローラ
        $nendo_ban = $den_ban_ctrl->countup('uriage', $uriage_dt->cd, $uriage_dt->uriagebi, $uriage_dt->nendo);
        if (!$nendo_ban['nendo']) {
            $this->flash->error("エラー:年度が未登録（日付が今年か昨年以外は不可）。" . $uriage_dt->uriagebi);
            $this->dispatcher->forward(array(
                'controller' => "uriage_dts",
                'action' => 'edit',
                'params' => array($id)
            ));
        }
        $uriage_dt->cd = $nendo_ban['bangou'];
        $uriage_dt->nendo = $nendo_ban['nendo'];
        $i = 0;
        foreach ($meisai["uriage_meisai_dts"] as $uriage_meisai_dt) {
            if ($chg_flgs[$i] === 2) { // 削除でないとき
                $meisai_ctlr = new UriageMeisaiDtsController();
                $meisai_ctlr->deleteAction($uriage_meisai_dt["id"]);
            } else {
                if ((int)$uriage_meisai_dt["id"] !== 0) {
                    $UriageMeisaiDts[$i] = $uriage_dt->UriageMeisaiDts[$i];
                }
                if ($chg_flgs[$i] === 1) { // 更新なら
                    if ((int)$uriage_meisai_dt["id"] === 0) {
                        $UriageMeisaiDts[$i] = new UriageMeisaiDts();
                    }
                    foreach ($meisai_flds as $meisai_fld) {
                        $UriageMeisaiDts[$i]->$meisai_fld = array_key_exists($meisai_fld, $meisaicnv[$i]) ? $meisaicnv[$i][$meisai_fld] : $uriage_meisai_dt[$meisai_fld] ?? '';
                        //更新日時や更新者はModelに定義してある
                    }
                }
                // 消込データがあれば併せて削除する
                $nyuukin_kesikomi_dts = NyuukinKesikomiDts::find('uriage_meisai_dt_id = ' . $uriage_meisai_dt['id']);
                if ($nyuukin_kesikomi_dts !== false) {
                    if ($nyuukin_kesikomi_dts->delete() === false) {
                        $this->flash->error('Keshikomi Delete: Error');
                    }
                }
            }
            $i++;
        }
        $uriage_dt->UriageMeisaiDts = $UriageMeisaiDts; // 明細データをドッキング

        if (!$uriage_dt->save()) {

            foreach ($uriage_dt->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "uriage_dts",
                'action' => 'edit',
                'params' => array($uriage_dt->id)
            ));

            return;
        }

        $this->flash->success("売上伝票の情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "uriage_dts",
            'action' => 'edit',
            'params' => array($uriage_dt->id)
        ));
    }

    /**
     * Deletes a uriage_dt
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $uriage_dt = UriageDts::findFirstByid($id);
        if (!$uriage_dt) {
            $this->flash->error("売上伝票が見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "uriage_dts",
                'action' => 'index'
            ));

            return;
        }

        foreach ($uriage_dt->UriageMeisaiDts as $uriage_meisai_dt) {
            $meisai_ctlr = new UriageMeisaiDtsController();
            $meisai_ctlr->deleteAction($uriage_meisai_dt->id);
            // 消込データがあれば併せて削除する
            $nyuukin_kesikomi_dts = NyuukinKesikomiDts::find('uriage_meisai_dt_id = ' . $uriage_meisai_dt->id);
            if ($nyuukin_kesikomi_dts !== false) {
                if ($nyuukin_kesikomi_dts->delete() === false) {
                    $this->flash->error('Keshikomi Delete: Error');
                }
            }
        }
        if (!$uriage_dt->delete()) {

            foreach ($uriage_dt->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "uriage_dts",
                'action' => 'search'
            ));

            return;
        }

        $this->_bakOut($uriage_dt, 1);

        $this->flash->success("売上伝票の削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "uriage_dts",
            'action' => "index"
        ));
    }

    /**
     * Back Out a uriage_dt
     *
     * @param string $uriage_dt , $dlt_flg
     */
    public function _bakOut($uriage_dt, $dlt_flg = 0, $chg_flgs = array())
    {

        $bak_uriage_dt = new BakUriageDts();
        foreach ($uriage_dt as $fld => $value) {
            $bak_uriage_dt->$fld = $value;
        }
        $bak_uriage_dt->id = NULL;
        $bak_uriage_dt->id_moto = $uriage_dt->id;
        $bak_uriage_dt->hikae_dltflg = $dlt_flg;
        $bak_uriage_dt->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_uriage_dt->hikae_nichiji = date("Y-m-d H:i:s");
        if (!$bak_uriage_dt->save()) {
            foreach ($bak_uriage_dt->getMessages() as $message) {
                $this->flash->error($message);
            }
        }

        $meisai_ctlr = new UriageMeisaiDtsController();
        $i = 0;
        foreach ($uriage_dt->UriageMeisaiDts as $uriage_meisai_dt) {
            if ($dlt_flg === 1 || $chg_flgs[$i] === 1) { // 更新なしは不要、削除は別に出ている、親から削除のときはここで出す
                $meisai_ctlr->_bakOut($uriage_meisai_dt, $dlt_flg);
            }
            $i++;
        }
    }


    /**
     * 伝票イメージで出力する。
     **/
    public function denpyouAction($id = null, $frmid = 6)
    { // $frmid = 6:売上伝票
        //DBのデータを読み込む
        $uriage_dt = UriageDts::findFirstByid($id);
        if (!$uriage_dt) {
            $this->flash->error("売上伝票が見つからなくなりました。id=$id");

            $this->dispatcher->forward(array(
                'controller' => "uriage_dts",
                'action' => 'index'
            ));

            return;
        }
        $chouhyou_mr = ChouhyouMrs::findFirstByid($frmid);
        if (!$chouhyou_mr) {
            $this->flash->error("帳票idが見つからなくなりました。id=$frmid");

            $this->dispatcher->forward(array(
                'controller' => "uriage_dts",
                'action' => 'edit',
                'params' => [$id]
            ));

            return;
        }
        if ($chouhyou_mr->ChouhyouToolKbns->name == 'EXCEL') {
            return $this->_denpyou_excel($uriage_dt, $chouhyou_mr);
        } else if ($chouhyou_mr->ChouhyouToolKbns->name == 'PDF') {
            return $this->_denpyou_pdf($uriage_dt, $chouhyou_mr);
        }
    }

    public function _denpyou_excel($uriage_dt, $chouhyou_mr)
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
            ['摘要', 'tekiyou', 1,],
            ['受注日', 'uriagebi', 2,],
            ['税率適用日', 'zeiritu_tekiyoubi', 2,],
            ['得意先', 'tokuisaki_mr_cd', 1,],
            ['取引区分', 'torihiki_kbn_cd', 0,],
            ['税転嫁', 'zei_tenka_kbn_cd', 0,],
            ['担当者', 'tantou_mr_cd', 1,],
            ['納入期日', 'nounyuu_kijitu', 2,],
            ['受注id', 'juchuu_dt_id', 0,],
            ['見積id', 'mitumori_dt_id', 0,],
            ['得意先発注番号', 'saki_hacchuu_cd', 0,],
            ['納入先', 'nounyuusaki_mr_cd', 1,],
            ['納入先名', 'nounyuusaki', 1,],
            ['住所１', 'juusho1', 1, 'NounyuusakiMrs',],
            ['住所２', 'juusho2', 1, 'NounyuusakiMrs',],
            ['ご担当者', 'gotantousha', 1, 'NounyuusakiMrs',],
            ['敬称', 'keishou', 1, 'NounyuusakiMrs',],
            ['TEL', 'tel', 1, 'NounyuusakiMrs',],
            ['気付先', 'kidukesaki_mr_cd', 1,],
            ['気付', 'kiduke', 1,],
            ['出荷日', 'shukkabi', 2,],
            ['直送先', 'chokusousaki_kbn_cd', 1,],
            ['取引方法', 'torihiki_houhou', 1,],
            ['合計金額名称', 'kingaku_meishou', 1,],
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
            ['取引区分名', 'name', 1, 'TorihikiKbns',],
            ['税転嫁名', 'name', 1, 'ZeiTenkaKbns',],
            ['担当者名', 'name', 1, 'TantouMrs',],
            ['納入先名', 'name', 1, 'NounyuusakiMrs',],
            ['作成者', 'name', 1, 'SakuseiUsers',],
            ['郵便番号', 'yuubin_bangou', 1, 'NounyuusakiMrs',],
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
            $tbl = $uriage_dt;
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
        foreach ($uriage_dt->UriageMeisaiDts as $uriage_meisai_dt) {
            if ($uriage_meisai_dt->utiwake_kbn_cd == 30) {
                $sekisangaku += $uriage_meisai_dt->kingaku;
            } else {
                $goukeigaku += $uriage_meisai_dt->kingaku;
                $genkagoukei += $uriage_meisai_dt->genkagaku;
                $zeinukigaku += $uriage_meisai_dt->zeinukigaku;
                $zeigaku += $uriage_meisai_dt->zeigaku;
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
        foreach ($uriage_dt->UriageMeisaiDts as $uriage_meisai_dt) {
            $gyou++;
            $retu = 0;
            foreach ($meisai_flds as $fld) {
                $tbl = $uriage_meisai_dt;
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
        $filename = uniqid("uriage_" . $uriage_dt->cd . "_", true) . '';

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
        $response->setHeader('Content-Disposition', 'attachment;filename="' . "uriage_" . $uriage_dt->cd . '"');
        $response->setHeader('Cache-Control', 'max-age=0');
        $response->setHeader('Cache-Control', 'max-age=1'); // If you're serving to IE 9, then the following may be needed
        $response->setContent(file_get_contents($path)); //Set the content of the response
        unlink($path); // delete temp file
        return $response; //Return the response
    }

    public function _denpyou_pdf($uriage_dt, $chouhyou_mr, $pdf = null)
    {
        require_once(__DIR__ . '/../vendor/tcpdf/tcpdf.php'); // 参考 http://www.t-net.ne.jp/~cyfis/tcpdf/ http://tcpdf.penlabo.net/method/c/Cell.html
        require_once(__DIR__ . '/../vendor/tcpdf/fpdi.php');

        $kihon_mr = KihonMrs::findFirstByid(1);
        $goukeis = [];
        $goukeis['zeinukigaku'] = 0;
        $goukeis['zeigaku'] = 0;
        $goukeis['meisai_cnt'] = 0;
        foreach ($uriage_dt->UriageMeisaiDts as $meisai) {
            $goukeis['zeinukigaku'] += $meisai->zeinukigaku;
            $goukeis['zeigaku'] += $meisai->zeigaku;
            if ($chouhyou_mr->meisai_lvl == 0 ||
                $meisai->kingaku != 0 ||
                $meisai->utiwake_kbn_cd == 10 ||
                $meisai->utiwake_kbn_cd == 11 ||
                $meisai->utiwake_kbn_cd == 12 ||
                $meisai->utiwake_kbn_cd == 13 ||
                $meisai->utiwake_kbn_cd == 40 ||
                $meisai->utiwake_kbn_cd == 90 ||
                $meisai->utiwake_kbn_cd == 23
            ) { // 2019/2/15追加　井浦　預り出荷は0円請求書発行する。
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
                if ($zokusei->kmk_table == 'uriage_meisai_dts') {
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
                     $gyou < $gyousuu
                     && $page * $gyousuu - $gyousuu + $gyou < $goukeis['meisai_cnt']
                     && $zokusei->kmk_table == 'uriage_meisai_dts'
                     && substr($zokusei->kmk_shuushoku, 0, 3) != 'fx_'
                     || $gyou < 1
                ; $gyou++) {
                    $suu1 = 0;
                    $suu2 = 0;
                    if ($zokusei->kmk_table == 'kihon_mrs') {
                        $target = $kihon_mr;
                    } else if ($zokusei->kmk_table == 'uriage_dts') {
                        $target = $uriage_dt;
                    } else if ($zokusei->kmk_table == 'uriage_meisai_dts' && substr($zokusei->kmk_shuushoku, 0, 3) == 'fx_') { // 追加2019/5/13井浦
                        for ($dtgyou = 0;
                             $chouhyou_mr->meisai_lvl != 0 &&
                             $dtgyou < count($uriage_dt->UriageMeisaiDts) &&
                             !($uriage_dt->UriageMeisaiDts[$dtgyou]->utiwake_kbn_cd == 41 && // メモに限る
                                 'fx_' . $uriage_dt->UriageMeisaiDts[$dtgyou]->shouhin_mr_cd == $zokusei->kmk_shuushoku); // fx_商品コードと一致なら
                             $dtgyou++) {
                        }
                        if ($dtgyou < count($uriage_dt->UriageMeisaiDts)) {
                            $target = $uriage_dt->UriageMeisaiDts[$dtgyou];
                        } else {
                            $target = new UriageMeisaiDts();
                        }
                    } else if ($zokusei->kmk_table == 'uriage_meisai_dts') {
                        for ($dtgyou = $dtgyou1;
                             $chouhyou_mr->meisai_lvl != 0 &&
                             $dtgyou < count($uriage_dt->UriageMeisaiDts) &&
                             $uriage_dt->UriageMeisaiDts[$dtgyou]->kingaku == 0 &&
                             $uriage_dt->UriageMeisaiDts[$dtgyou]->utiwake_kbn_cd != 10 &&
                             $uriage_dt->UriageMeisaiDts[$dtgyou]->utiwake_kbn_cd != 11 &&
                             $uriage_dt->UriageMeisaiDts[$dtgyou]->utiwake_kbn_cd != 12 &&
                             $uriage_dt->UriageMeisaiDts[$dtgyou]->utiwake_kbn_cd != 13 &&
                             $uriage_dt->UriageMeisaiDts[$dtgyou]->utiwake_kbn_cd != 40 &&
                             $uriage_dt->UriageMeisaiDts[$dtgyou]->utiwake_kbn_cd != 90 &&
                             $uriage_dt->UriageMeisaiDts[$dtgyou]->utiwake_kbn_cd != 23; // 2019/2/15追加　井浦　預り出荷は0円請求書発行する。
                             $dtgyou++) {
                        }
                        $dtgyou1 = $dtgyou + 1;
                        $target = $uriage_dt->UriageMeisaiDts[$dtgyou];
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
            $filename = uniqid("uriage_" . $uriage_dt->cd . "_", false) . '.pdf';

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
            $response->setHeader('Content-Disposition', 'attachment;filename="' . "uriage_" . $uriage_dt->cd . '"');
            $response->setHeader('Cache-Control', 'max-age=0');
            $response->setHeader('Cache-Control', 'max-age=1'); // If you're serving to IE 9, then the following may be needed
            $response->setContent(file_get_contents($path)); //Set the content of the response
            unlink($path); // delete temp file
            $this->flash->success("売上伝票の印刷PDFを出力しました。");
            return $response; //Return the response
        }
    }

    public function renzoku_denpyou_pdf($uriage_dt_ids, $chouhyou_mr)
    {
        require_once(__DIR__ . '/../vendor/tcpdf/tcpdf.php'); // 参考 http://www.t-net.ne.jp/~cyfis/tcpdf/ http://tcpdf.penlabo.net/method/c/Cell.html
        require_once(__DIR__ . '/../vendor/tcpdf/fpdi.php');
        $pdf = new FPDI($chouhyou_mr->yousi_houkou, 'mm', $chouhyou_mr->yousi_size, true, 'UTF-8'); // "P", "mm", "A4", true, "UTF-8"
        foreach ($uriage_dt_ids as $uriage_dt_id) {
//echo "\n<br>".$uriage_dt_id['sentaku_chk'];
            $uriage_dt = UriageDts::findFirstByid($uriage_dt_id['sentaku_chk']);
//if ($uriage_dt) {echo "\n<br>".$uriage_dt->cd;}else{echo "\n<br>ERROR";}
            $this->_denpyou_pdf($uriage_dt, $chouhyou_mr, $pdf);
        }
        //保存ファイル名
        $filename = uniqid("uriage_", false) . '.pdf';

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

    /**
     * 伝票生データでエクセル出力する。
     **/
    public function exportAction($id = null)
    {
        //DBのデータを読み込む
        $uriage_dt = UriageDts::findFirstByid($id);
        if (!$uriage_dt) {
            $this->flash->error("売上伝票が見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "uriage_dts",
                'action' => 'index'
            ));

            return;
        }
        // Excel出力用ライブラリ
        include __DIR__ . '/../vendor/PHPExcel/Classes/PHPExcel.php';
        include __DIR__ . '/../vendor/PHPExcel/Classes/PHPExcel/Writer/Excel5.php';
//		include __DIR__ . '/../vendor/PHPExcel/Classes/PHPExcel/Writer/Excel2007.php';
        include __DIR__ . '/../vendor/PHPExcel/Classes/PHPExcel/IOFactory.php'; //Include PHPExcel_IOFactory

        //PHPExcelオブジェクトの作成
        //新規の場合
        $PHPExcel = new PHPExcel();
        $sheet = $PHPExcel->getActiveSheet();

        $shu_titles = ["id", "伝票番号", "年度", "摘要", "売上日", "受注番号", "見積番号", "承認状態", "承認者", "税率適用日"
            , "得意先", "取引区分", "税転嫁", "納入先", "担当者", "締切", "単価種類", "回収予定日", "請求書番号"
            , "消込状態", "納入期日", "分類コード", "伝票区分", "元ID", "控え時削除フラグ", "控え操作者"
            , "控え日付", "作成者", "作成日時", "更新者", "更新日時"];
        $shu_nums = [1, 1, 1, 0, 0, 1, 1, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,]; //1=数値,0=文字列
        $shu_flds = ["id", "cd", "nendo", "tekiyou", "uriagebi", "juchuu_dt_id", "mitumori_dt_id", "saki_hacchuu_cd", "shounin_joutai_flg", "shounin_sha_mr_cd", "zeiritu_tekiyoubi"
            , "tokuisaki_mr_cd", "torihiki_kbn_cd", "zei_tenka_kbn_cd", "nounyuusaki_mr_cd", "nounyuusaki", "kidukesaki_mr_cd", "kiduke", "shukkabi", "tantou_mr_cd", "shimekiri_flg", "tanka_shurui_kbn_cd", "kaishuu_yoteibi", "seikyuusho_dt_cd"
            , "keshikomi_flg", "nounyuu_kijitu", "bunrui_cd", "denpyou_kbn", "id_moto", "hikae_dltflg", "hikae_user_id"
            , "hikae_nichiji", "sakusei_user_id", "created", "kousin_user_id", "updated"];
        $meisai_titles = ["id", "行番", "内訳", "売上データID", "出荷", "商品コード", "単位", "数単位"
            , "入数", "ケース", "商品名/摘要", "ロット", "個別コード", "倉庫コード", "棚コード", "規格型番", "色", "色名", "サイズ", "数量", "原単価", "単価"
            , "金額", "原価額", "プロジェクトコード", "課税区分", "備考", "元ID", "控え時削除フラグ", "控え操作者"
            , "控え日付", "作成者", "作成日時", "更新者", "更新日時"];
        $meisai_nums = [1, 1, 0, 0, 0, 0, 0, 0, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 0, 1, 0, 1, 1, 1, 1, 1, 0, 0, 0, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,]; //1=数値,0=文字列
        $meisai_flds = ["id", "cd", "utiwake_kbn_cd", "uriage_dt_id", "shukka_kbn_cd", "shouhin_mr_cd", "tanni_mr_cd", "kousei"
            , "irisuu", "keisu", "tekiyou", "lot", "kobetucd", "hinsitu_kbn_cd", "souko_mr_cd", "kikaku", "iro", "iromei", "size", "suuryou", "suuryou1", "tanni_mr1_cd", "suuryou2", "tanni_mr2_cd", "tanka_kbn", "gentanka", "tanka"
            , "kingaku", "genkagaku", "project_mr_cd", "zeiritu_mr_cd", "bikou", "id_moto", "hikae_dltflg", "hikae_user_id"
            , "hikae_nichiji", "sakusei_user_id", "created", "kousin_user_id", "updated"];
        $sakuin_titles = ["得意先名", "得意先部署名", "得意先役職", "得意先ご担当", "得意先敬称", "得意先郵便番", "得意先住所1", "得意先住所2", "得意先売掛金"
            , "納入先名", "納入先部署名", "納入先役職", "納入先ご担当", "納入先敬称", "納入先郵便番", "納入先住所1", "納入先住所2", "納入先カナ"
            , "取引区分", "税転嫁", "担当者", "単価種類", "承認者", "作成者", "更新者"];
        $sakuin_nums = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,]; //1=数値,0=文字列
        $sakuin_flds = [["TokuisakiMrs", "name"], ["TokuisakiMrs", "bushomei"], ["TokuisakiMrs", "yakushoku"], ["TokuisakiMrs", "gotantousha"], ["TokuisakiMrs", "keishou"], ["TokuisakiMrs", "yuubin_bangou"], ["TokuisakiMrs", "juusho1"], ["TokuisakiMrs", "juusho2"], ["TokuisakiMrs", "kake_zandaka"]
            , ["NounyuusakiMrs", "name"], ["NounyuusakiMrs", "bushomei"], ["NounyuusakiMrs", "yakushoku"], ["NounyuusakiMrs", "gotantousha"], ["NounyuusakiMrs", "keishou"], ["NounyuusakiMrs", "yuubin_bangou"], ["NounyuusakiMrs", "juusho1"], ["NounyuusakiMrs", "juusho2"], ["NounyuusakiMrs", "kana"]
            , ["TorihikiKbns", "name"], ["ZeitenkaKbns", "name"], ["TantouMrs", "name"], ["TankaShuruiKbns", "name"], ["Users", "name"], ["SakuseiUsers", "name"], ["KousinUsers", "name"]];
        $meisaku_titles = ["内訳", "商品名", "単位", "数単位", "倉庫", "課税区分", "税率"];
        $meisaku_nums = [0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0,]; //1=数値,0=文字列
        $meisaku_flds = [["UtiwakeKbns", "name"], ["ShouhinMrs", "name"], ["TanniMrs", "name"], ["SuuTanniMrs", "name"], ["SoukoMrs", "name"], ["ZeirituMrs", "name"], ["ZeirituMrs", "zeiritu"]];

        $row = 1;
        $col = 0;
        foreach ($shu_titles as $shu_title) {
            $sheet->setCellValueByColumnAndRow($col++, $row, $shu_title);
        }
        foreach ($meisai_titles as $meisai_title) {
            $sheet->setCellValueByColumnAndRow($col++, $row, $meisai_title);
        }
        foreach ($sakuin_titles as $sakuin_title) {
            $sheet->setCellValueByColumnAndRow($col++, $row, $sakuin_title);
        }
        foreach ($meisaku_titles as $meisaku_title) {
            $sheet->setCellValueByColumnAndRow($col++, $row, $meisaku_title);
        }
        $row++;
        foreach ($uriage_dt->UriageMeisaiDts as $uriage_meisai_dt) {
            $col = 0;
            $i = 0;
            foreach ($shu_flds as $shu_fld) {
                if ($shu_nums[$i++] == 1) {
                    $sheet->setCellValueByColumnAndRow($col++, $row, $uriage_dt->$shu_fld);
                } else {
                    $sheet->setCellValueExplicitByColumnAndRow($col++, $row, $uriage_dt->$shu_fld);
                }
            }
            $i = 0;
            foreach ($meisai_flds as $meisai_fld) {
                if ($meisai_nums[$i++] == 1) {
                    $sheet->setCellValueByColumnAndRow($col++, $row, $uriage_meisai_dt->$meisai_fld);
                } else {
                    $sheet->setCellValueExplicitByColumnAndRow($col++, $row, $uriage_meisai_dt->$meisai_fld);
                }
            }
            $i = 0;
            foreach ($sakuin_flds as $sakuin_fld) {
                if ($sakuin_nums[$i++] == 1) {
                    switch (count($sakuin_fld)) {
                        case 2:
                            $sheet->setCellValueByColumnAndRow($col, $row, $uriage_dt->$sakuin_fld[0]->$sakuin_fld[1]);
                            break;
                        case 3:
                            $sheet->setCellValueByColumnAndRow($col, $row, $uriage_dt->$sakuin_fld[0]->$sakuin_fld[1]->$sakuin_fld[2]);
                            break;
                    }
                } else {
                    switch (count($sakuin_fld)) {
                        case 2:
                            $sheet->setCellValueExplicitByColumnAndRow($col, $row, $uriage_dt->$sakuin_fld[0]->$sakuin_fld[1]);
                            break;
                        case 3:
                            $sheet->setCellValueExplicitByColumnAndRow($col, $row, $uriage_dt->$sakuin_fld[0]->$sakuin_fld[1]->$sakuin_fld[2]);
                            break;
                    }
                }
                $col++;
            }
            $i = 0;
            foreach ($meisaku_flds as $meisaku_fld) {
                if ($meisaku_nums[$i++] == 1) {
                    switch (count($meisaku_fld)) {
                        case 2:
                            $sheet->setCellValueByColumnAndRow($col, $row, $uriage_meisai_dt->$meisaku_fld[0]->$meisaku_fld[1]);
                            break;
                        case 3:
                            $sheet->setCellValueByColumnAndRow($col, $row, $uriage_meisai_dt->$meisaku_fld[0]->$meisaku_fld[1]->$meisaku_fld[2]);
                            break;
                    }
                } else {
                    switch (count($meisaku_fld)) {
                        case 2:
                            $sheet->setCellValueExplicitByColumnAndRow($col, $row, $uriage_meisai_dt->$meisaku_fld[0]->$meisaku_fld[1]);
                            break;
                        case 3:
                            $sheet->setCellValueExplicitByColumnAndRow($col, $row, $uriage_meisai_dt->$meisaku_fld[0]->$meisaku_fld[1]->$meisaku_fld[2]);
                            break;
                    }
                }
                $col++;
            }
            $row++;
        }//end foreach

        // Excelファイルの保存 ------------------------------------------

        //保存ファイル名
        $filename = uniqid("uridt", true) . '.xls';

        // 保存ファイルパス
        $upload = __DIR__ . '/temp/';
        $path = $upload . $filename;

        $objWriter = new PHPExcel_Writer_Excel5($PHPExcel);   //2003形式で保存
        $objWriter->save($path);

        // Excelファイルをクライアントに出力 ----------------------------
        $response = new \Phalcon\Http\Response(); // Redirect output to a client's web browser (Excel2005)
        $response->setHeader('Content-Type', 'application/vnd.ms-excel');
        $response->setHeader('Content-Disposition', 'attachment;filename="' . $filename . '"');
        $response->setHeader('Cache-Control', 'max-age=0');
        $response->setHeader('Cache-Control', 'max-age=1'); // If you're serving to IE 9, then the following may be needed
        $response->setContent(file_get_contents($path)); //Set the content of the response
        unlink($path); // delete temp file
        return $response; //Return the response
    }

    /**
     * 弥生（売上明細表）からインポート
     *        伝票順にソートしておく必要があります
     */
    public function impoyayoiAction()
    {
        $load_mr = LoadMrs::findFirst(['conditions' => 'cd = ?1', 'bind' => [1 => 'uriage_dts']]);
        $load_mr_ms = LoadMrs::findFirst(['conditions' => 'cd = ?1', 'bind' => [1 => 'uriage_meisai_dts']]); // 明細用

        if (!$load_mr) {
            $this->flash->error("テーブルマスタが見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "load_mrs",
                'action' => 'index'
            ));

            return;
        }
        if (!$load_mr_ms) {
            $this->flash->error("明細用テーブルマスタが見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "load_mrs",
                'action' => 'index'
            ));

            return;
        }

        // 上書きキー項目印
        $keys = [];
        foreach ($load_mr->LoadKoumokuMrs as $load_koumoku_mr) {
            if ($load_koumoku_mr->keys != null && $load_koumoku_mr->keys == 1) {
                $keys[$load_koumoku_mr->jun] = $load_koumoku_mr->koumoku_mr_cd;
                $cd_jun = $load_koumoku_mr->jun; //税額再計算のところで使う
            }
        }

        // 変換配列作成
        $henkan = [];
        foreach ($load_mr->LoadHenkanMrs as $load_henkan_mr) {
            $henkan[$load_henkan_mr->LoadKoumokuMrs->koumoku_mr_cd][$load_henkan_mr->name] = $load_henkan_mr->cd;
        }

        // 明細の変換配列作成
        $henkan_ms = [];
        foreach ($load_mr_ms->LoadHenkanMrs as $load_henkan_mr) {
            $henkan_ms[$load_henkan_mr->LoadKoumokuMrs->koumoku_mr_cd][$load_henkan_mr->name] = $load_henkan_mr->cd;
        }
        /*
         echo "<pre>";
         var_dump($henkan);
         echo "</pre>";
         return;
        */

        // ファイル取得

        $filepath = "files/" . mb_convert_encoding($load_mr->file_name, "SJIS-win", "utf-8");
        $file = new SplFileObject($filepath);
        $file->setFlags(SplFileObject::READ_CSV);

        // ファイル内のデータループ
        foreach ($file as $key => $line) {
            foreach ($line as $str) {
                $records[$key][] = mb_convert_encoding($str, "utf-8", "SJIS-win");
            }
        }

        $classname = str_replace(' ', '', ucwords(str_replace('_', ' ', strtolower($load_mr->table_mr_cd)))); // ShiireMrs
        $classname_ms = str_replace(' ', '', ucwords(str_replace('_', ' ', strtolower($load_mr_ms->table_mr_cd)))); //ShiireMeisaiMrs
        $requi_mae = ''; // 伝票番号が前の行と違うかチェック用
        $id_mae = 0;
        $i = 0;
        foreach ($records as $record) {
            if ($i >= $load_mr->skip && $i < $load_mr->skip + 800) { // 800件以上は30秒タイムアウトする
                $requi = "";
                $where = "";
                foreach ($keys as $jun => $koumoku_cd) {
                    if ($where != "") {
                        $where .= " AND ";
                    }
                    $where .= $koumoku_cd . " = '" . current(array_slice($record, $jun, 1)) . "'";
                    $requi .= current(array_slice($record, $jun, 1));
                }
                if ($requi == '') {
                    continue;
                } // 伝票番号が無ければスキップする
                if ($requi != $requi_mae) { // 伝票番号が前の行と違うときだけ登録または更新する（同じなら明細だけ処理する）
                    $target_row = $classname::findfirst($where);
                    if (!$target_row) {
                        $target_row = new $classname();
                        foreach ($keys as $jun => $koumoku_cd) {
                            $target_row->$koumoku_cd = current(array_slice($record, $jun, 1));
                        }
                    } else if ($load_mr->uwagaki != 1) {
                        continue;
                    }
                    foreach ($load_mr->LoadKoumokuMrs as $load_koumoku_mr) {
                        if ($load_koumoku_mr->keys != 1 && $load_koumoku_mr->fusiyou_kbn != 1) {
                            $koumoku_cd = $load_koumoku_mr->koumoku_mr_cd;
                            $koumoku_data = current(array_slice($record, $load_koumoku_mr->jun, 1));
                            if (array_key_exists($koumoku_cd, $henkan) && $koumoku_data != "") {
                                $koumoku_data = $henkan[$koumoku_cd][$koumoku_data];
                            } else if (strpos($load_koumoku_mr->KoumokuMrs->data_kata, "int(") !== false
                                || $load_koumoku_mr->KoumokuMrs->data_kata == "double") {
                                $koumoku_data = trim(str_replace(',', '', $koumoku_data));
                            } else if (strpos($load_koumoku_mr->KoumokuMrs->data_kata, "date") !== false) {
                                $koumoku_data = trim(str_replace(['年', '月', '日', '/'], ['-', '-', ' ', '-'], $koumoku_data));
                            }
                            $target_row->$koumoku_cd = $koumoku_data;
                        }
                    }
                    /* if($i == 2){
                     echo "<pre>";
                     var_dump($target_row);
                     echo "</pre>";
                     return;
                    } */
                    if (!$target_row->save()) {
                        foreach ($target_row->getMessages() as $message) {
                            $this->flash->error($message);
                        }
                        $this->dispatcher->forward(array(
                            'controller' => "load_mrs",
                            'action' => 'edit',
                            'params' => array($load_mr->id)
                        ));
                        return;
                    }
                    $zei_hasuu_shori_kbn_cd = $target_row->TokuisakiMrs->zei_hasuu_shori_kbn_cd;
                    $zei_tenka_kbn_cd = $target_row->zei_tenka_kbn_cd;
                    $shouhizeigaku = 0;
                    $ritubetugaku = [];

                    $id_mae = $target_row->id;
                    $ms_cd = 0;
                } else {
                    $ms_cd++;
                }
                $requi_mae = $requi; // 伝票番号を控える

                // ここから明細の処理
                $target_row = $classname_ms::findfirst(['conditions' => 'uriage_dt_id = ?1 AND cd = ?2', 'bind' => [1 => $id_mae, 2 => $ms_cd]]); // ms_cd=行番号
                if (!$target_row) {
                    $target_row = new $classname_ms();
                    $target_row->uriage_dt_id = $id_mae;
                    $target_row->cd = $ms_cd;
//					foreach ($keys as $jun => $koumoku_cd) {
//						$target_row->$koumoku_cd = current(array_slice($record, $jun, 1));
//					}
//				} else if ($load_mr->uwagaki !== 1) { 上書き禁止で親が無く子が有ることはない
//					continue;
                }
                foreach ($load_mr_ms->LoadKoumokuMrs as $load_koumoku_mr) {
                    if ($load_koumoku_mr->keys != 1 && $load_koumoku_mr->fusiyou_kbn != 1) {
                        $koumoku_cd = $load_koumoku_mr->koumoku_mr_cd;
                        $koumoku_data = current(array_slice($record, $load_koumoku_mr->jun, 1));
                        if (array_key_exists($koumoku_cd, $henkan_ms) && $koumoku_data != "") {
                            $koumoku_data = $henkan_ms[$koumoku_cd][$koumoku_data];
                        } else if (strpos($load_koumoku_mr->KoumokuMrs->data_kata, "int(") !== false
                            || $load_koumoku_mr->KoumokuMrs->data_kata == "double") {
                            $koumoku_data = trim(str_replace(',', '', $koumoku_data));
                        } else if (strpos($load_koumoku_mr->KoumokuMrs->data_kata, "date") !== false) {
                            $koumoku_data = trim(str_replace(['年', '月', '日', '/'], ['-', '-', ' ', '-'], $koumoku_data));
                        }
                        $target_row->$koumoku_cd = $koumoku_data;
                    }
                }
                // 税項目計算
                $zeirutu_mrs = ZeirituMrs::findfirst(["conditions" => "cd = ?1", "bind" => [1 => $target_row->zeiritu_mr_cd]]);
                $zeiritu = 0.01 * $zeirutu_mrs->zeiritu;
                if (substr($zei_tenka_kbn_cd, 0, 1) == "2") { //内税
                    switch ($zei_hasuu_shori_kbn_cd) {
                        case "1":
                            $target_row->zeigaku = floor($target_row->kingaku / (1 + $zeiritu) * $zeiritu);
                            break;//切り捨て
                        case "2":
                            $target_row->zeigaku = ceil($target_row->kingaku / (1 + $zeiritu) * $zeiritu);
                            break;//切り上げ
                        default :
                            $target_row->zeigaku = round($target_row->kingaku / (1 + $zeiritu) * $zeiritu);
                            break;//四捨五入
                    }
                    $target_row->zeinukigaku = $target_row->kingaku - $target_row->zeigaku;
                } else if ($zei_tenka_kbn_cd == "40") { // 税額手入力なら
                    if ($target_row->utiwake == "7") { // 消費税手入力行なら
                        $target_row->zeigaku = $target_row->kingaku; // 金額を全て消費税にする…税抜額が０円になる
                        $target_row->zeinukigaku = 0;
                    } else {
                        $target_row->zeigaku = 0;
                        $target_row->zeinukigaku = $target_row->kingaku;
                    }
                } else {                                        //外税など
                    switch ($zei_tenka_kbn_cd) {
                        case "1":
                            $target_row->zeigaku = floor($target_row->kingaku * $zeiritu);
                            break;//切り捨て
                        case "2":
                            $target_row->zeigaku = ceil($target_row->kingaku * $zeiritu);
                            break;//切り上げ
                        default :
                            $target_row->zeigaku = round($target_row->kingaku * $zeiritu);
                            break;//四捨五入
                    }
                    $target_row->zeinukigaku = $target_row->kingaku;
                }
                $shouhizeigaku += $target_row->zeigaku;
                if (!array_key_exists($target_row->zeiritu_mr_cd, $ritubetugaku)) {
                    $ritubetugaku[$target_row->zeiritu_mr_cd] = 0;
                }
                $ritubetugaku[$target_row->zeiritu_mr_cd] += $target_row->kingaku; // 合計額に加算
                if ($zei_tenka_kbn_cd != "20" && $zei_tenka_kbn_cd != "30" && $zei_tenka_kbn_cd != "40"
                    && ($i >= count($records) - 1 || $records[$i + 1][$cd_jun] != $record[$cd_jun])) {
                    $shouhizeigaku2 = 0;
                    if (substr($zei_tenka_kbn_cd, 0, 1) == "2") { //内税(総額など)
                        foreach ($ritubetugaku as $ritukey => $betugaku) {
                            $zeirutu_mrs = ZeirituMrs::findfirst(["conditions" => "cd = ?1", "bind" => [1 => $ritukey]]);
                            $zeiritu = 0.01 * $zeirutu_mrs->zeiritu;
                            switch ($zei_hasuu_shori_kbn_cd) {
                                case "1":
                                    $zeigaku = floor($betugaku / (1 + $zeiritu) * $zeiritu);
                                    break;//切り捨て
                                case "2":
                                    $zeigaku = ceil($betugaku / (1 + $zeiritu) * $zeiritu);
                                    break;//切り上げ
                                default :
                                    $zeigaku = round($betugaku / (1 + $zeiritu) * $zeiritu);
                                    break;//四捨五入
                            }
                            $shouhizeigaku2 += $zeigaku;
                        }
                        $target_row->zeinukigaku -= $shouhizeigaku2 - $shouhizeigaku;
                        $target_row->zeigaku += $shouhizeigaku2 - $shouhizeigaku;
                    } else {                                        //外税
                        foreach ($ritubetugaku as $ritukey => $betugaku) {
                            $zeirutu_mrs = ZeirituMrs::findfirst(["conditions" => "cd = ?1", "bind" => [1 => $ritukey]]);
                            $zeiritu = 0.01 * $zeirutu_mrs->zeiritu;
                            switch ($zei_hasuu_shori_kbn_cd) {
                                case "1":
                                    $zeigaku = floor($betugaku * $zeiritu);
                                    break;//切り捨て
                                case "2":
                                    $zeigaku = ceil($betugaku * $zeiritu);
                                    break;//切り上げ
                                default :
                                    $zeigaku = round($betugaku * $zeiritu);
                                    break;//四捨五入
                            }
                            $shouhizeigaku2 += $zeigaku;
                        }
                        $target_row->zeigaku += $shouhizeigaku2 - $shouhizeigaku;
                    }
                }
                /* if($i == 2){
                echo "<pre>";
                var_dump($target_row);
                echo "</pre>";
                return;
                } */
                if (!$target_row->save()) {
                    foreach ($target_row->getMessages() as $message) {
                        $this->flash->error($message);
                    }
                    $this->dispatcher->forward(array(
                        'controller' => "load_mrs",
                        'action' => 'edit',
                        'params' => array($load_mr_ms->id)
                    ));
                    return;
                }
            }
            $i++;
        }
        $this->dispatcher->forward(array(
            'controller' => $load_mr->table_mr_cd,
            'action' => 'index'
        ));
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

        $uriage_dts = UriageDts::find(array(
//	        'columns' => array('cd, name'), 全項目とする
            'order' => 'cd',
            'conditions' => ' cd LIKE ?1 ',
            'bind' => array(1 => $this->request->getPost('cd') . '%')
        ));
        $res_flds = [
            "id",
            "cd",
            "nendo",
            "tekiyou",
            "uriagebi",
            "zeiritu_tekiyoubi",
            "tokuisaki_mr_cd",
            "torihiki_kbn_cd",
            "zei_tenka_kbn_cd",
            "tantou_mr_cd",
            "nounyuu_kijitu",
            "mitumori_dt_id",
            "saki_hacchuu_cd",
            "nounyuusaki_mr_cd",
            "nounyuusaki",
            "kidukesaki_mr_cd",
            "kiduke",
            "shukkabi",
            "sakusei_user_id",
            "created",
            "kousin_user_id",
            "updated",
        ];
        $meisai_flds = [
            "utiwake_kbn_cd",
            "shouhin_mr_cd",
            "tekiyou",
            "lot",
            "kobetucd",
            "souko_mr_cd",
            "hinsitu_kbn_cd",
            "irisuu",
            "keisu",
            "tanni_mr_cd",
            "kousei",
            "tanka",
            "gentanka",
            "suuryou",
            "suuryou1",
            "tanni_mr1_cd",
            "suuryou2",
            "tanni_mr2_cd",
            "tanka_kbn",
            "kingaku",
            "zeiritu_mr_cd",
            "bikou",
        ];
        $resData = array();
        foreach ($uriage_dts as $uriage_dt) {
            $resAdata = array();
            foreach ($res_flds as $res_fld) {
                $resAdata[$res_fld] = $uriage_dt->$res_fld;
            }
            foreach ($uriage_dt->UriageMeisaiDts as $uriage_meisai_dt) {
                foreach ($meisai_flds as $meisai_fld) {
                    $resAdata["meisai"][$uriage_meisai_dt->cd][$meisai_fld] = $uriage_meisai_dt->$meisai_fld;
                }
                $resAdata["meisai"][$uriage_meisai_dt->cd]['moto_tanni_mr_cd'] = $uriage_meisai_dt->ShouhinMrs->tanni_mr_cd;
                $resAdata["meisai"][$uriage_meisai_dt->cd]['suu_shousuu'] = $uriage_meisai_dt->ShouhinMrs->suu_shousuu;
                $resAdata["meisai"][$uriage_meisai_dt->cd]['suu1_shousuu'] = $uriage_meisai_dt->ShouhinMrs->suu1_shousuu;
                $resAdata["meisai"][$uriage_meisai_dt->cd]['suu2_shousuu'] = $uriage_meisai_dt->ShouhinMrs->suu2_shousuu;
                $resAdata["meisai"][$uriage_meisai_dt->cd]['tanka_shousuu'] = $uriage_meisai_dt->ShouhinMrs->tanka_shousuu;

            }
//	        $resAdata["seikyuusaki_name"] = $uriage_dt->SeikyuusakiMrs->name;
            $resData[] = $resAdata;//array('cd' => $uriage_dt->cd, 'name' => $uriage_dt->name);
        }

        //Set the content of the response
        $response->setContent(json_encode($resData));

        //Return the response
        return $response;
    }

    public function ajaxRenzokuAction()
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

        $get_hanni_flg = $this->request->getPost('hanni_flg');
        $get_nyuuryokusha_flg = $this->request->getPost('nyuuryokusha_flg');
        $get_uriagebi_from = $this->request->getPost('uriagebi_from');
        $get_uriagebi_to = $this->request->getPost('uriagebi_to');
        $get_denpyou_cd_from = $this->request->getPost('denpyou_cd_from');
        $get_denpyou_cd_to = $this->request->getPost('denpyou_cd_to');
        $get_id_de = $this->request->getPost('id_de');
        $get_id = $this->request->getPost('id');
        $get_tantou_mr_cd = $this->request->getPost('tantou_mr_cd');
        $get_tokuisaki_mr_cd = $this->request->getPost('tokuisaki_mr_cd');
        $get_nounyuusaki_mr_cd = $this->request->getPost('nounyuusaki_mr_cd');
        $get_torihiki_kbn1 = $this->request->getPost('torihiki_kbn1');
        $get_torihiki_kbn2 = $this->request->getPost('torihiki_kbn2');
        $get_torihiki_kbn3 = $this->request->getPost('torihiki_kbn3');
        $get_torihiki_kbn4 = $this->request->getPost('torihiki_kbn4');
        $get_sakusei_users_order = $this->request->getPost('sakusei_users_order');
        $get_tokuisaki_mrs_order = $this->request->getPost('tokuisaki_mrs_order');

        $binds = [];
        if ($get_nyuuryokusha_flg) {
            $binds['sakusei_user_id'] = $this->getDI()->getSession()->get('auth')['id'];
        }
        if ($get_uriagebi_from) {
            $binds['uriagebi_from'] = $get_uriagebi_from;
        }
        if ($get_uriagebi_to) {
            $binds['uriagebi_to'] = $get_uriagebi_to;
        }
        if ($get_denpyou_cd_from) {
            $binds['denpyou_cd_from'] = $get_denpyou_cd_from;
        }
        if ($get_denpyou_cd_to) {
            $binds['denpyou_cd_to'] = $get_denpyou_cd_to;
        }
        if ($get_tantou_mr_cd) {
            $binds['tantou_mr_cd'] = $get_tantou_mr_cd;
        }
        if ($get_tokuisaki_mr_cd) {
            $binds['tokuisaki_mr_cd'] = $get_tokuisaki_mr_cd;
        }
        if ($get_nounyuusaki_mr_cd) {
            $binds['nounyuusaki_mr_cd'] = $get_nounyuusaki_mr_cd;
        }

        $order = '';
        if ($get_sakusei_users_order) $order .= 'sakusei_user_id,';
        if ($get_tokuisaki_mrs_order) $order .= 'tokuisaki_mr_cd,';

        $uriage_dts = UriageDts::find(array(
//	        'columns' => array('uriagebi', 'cd', 'tokuisaki_mr_cd'), 全項目とする
            'order' => $order . 'cd',
            'conditions' => ''
                . ($get_nyuuryokusha_flg ? 'sakusei_user_id = :sakusei_user_id: AND ' : '')
                . ($get_uriagebi_from ? 'uriagebi >= :uriagebi_from: AND ' : '')
                . ($get_uriagebi_to ? 'uriagebi <= :uriagebi_to: AND ' : '')
                . ($get_denpyou_cd_from ? 'cd >= :denpyou_cd_from: AND ' : '')
                . ($get_denpyou_cd_to ? 'cd <= :denpyou_cd_to: AND ' : '')
//				.($get_id_de?'shitei_uriden_kbn_cd = :id: AND ':'')
                . ($get_tantou_mr_cd ? 'tantou_mr_cd = :tantou_mr_cd: AND ' : '')
                . ($get_tokuisaki_mr_cd ? 'tokuisaki_mr_cd = :tokuisaki_mr_cd: AND ' : '')
                . ($get_nounyuusaki_mr_cd ? 'nounyuusaki_mr_cd = :nounyuusaki_mr_cd: AND ' : '')
                . '('
                . ($get_torihiki_kbn1 ? 'torihiki_kbn_cd = "1" OR ' : '')
                . ($get_torihiki_kbn2 ? 'torihiki_kbn_cd = "2" OR ' : '')
                . ($get_torihiki_kbn3 ? 'torihiki_kbn_cd = "3" OR ' : '')
                . ($get_torihiki_kbn4 ? 'torihiki_kbn_cd = "4" OR ' : '')
                . 'FALSE)',
            'bind' => $binds
        ));
        $resData = array();
        foreach ($uriage_dts as $uriage_dt) {
            if ($get_id_de == 0 || $uriage_dt->TokuisakiMrs->shitei_uriden_kbn_cd == $get_id) {
                $resAdata = array();
                $resAdata['id'] = $uriage_dt->id;
                $resAdata['uriagebi'] = $uriage_dt->uriagebi;
                $resAdata['cd'] = $uriage_dt->cd;
                $resAdata['tokuisaki_mr_cd'] = $uriage_dt->tokuisaki_mr_cd;
                $resAdata['tokuisaki_mr_name'] = $uriage_dt->TokuisakiMrs->name;
                $resAdata['meisai_kensuu'] = count($uriage_dt->UriageMeisaiDts);
                $resAdata['sakusei_user_id'] = $uriage_dt->sakusei_user_id;
                $resAdata['sakusei_user_name'] = $uriage_dt->SakuseiUsers->name;
                $resData[] = $resAdata;//array('cd' => $uriage_dt->cd, 'name' => $uriage_dt->name);
            }
        }

        //Set the content of the response
        $response->setContent(json_encode($resData));

        //Return the response
        return $response;
    }
}
