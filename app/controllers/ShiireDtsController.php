<?php

class ShiireDtsController extends ControllerBase
{
    /*
	 * 発注一覧より、発注に紐づいた仕入明細を表示
	 */
    public function shiire_listAction()
    {
        $di = \Phalcon\DI::getDefault();
        $mgr = $di->get('modelsManager');
        $hacchuu_id = $this->request->getQuery('hacchuu_id');
        $shouhin_mr_cd = $this->request->getQuery('shouhin_mr_cd');
        $iro = $this->request->getQuery('iro');
        $souko_cd = $this->request->getQuery('souko_cd');
        $phql = "
            SELECT
                a.id AS id,
                a.cd AS shiire_no,
                a.hacchuu_dt_id AS shiire_hacchuu_dt_id,
                b.shouhin_mr_cd AS shiire_shouhin_mr_cd,
                c.name AS shouhin_name,
                b.suuryou1 AS shiire_suu,
                d.name AS shiire_tanni1,
                b.suuryou2 AS shiire_ryou,
                e.name AS shiire_tanni2,
                b.tanka AS shiire_tanka,
                b.nyuuka_kbn_cd AS nyuuka_kbn_cd,
                a.shiirebi AS shiirebi, 
                g.name AS souko_name,
                f.name AS nyuuka_kbn
            FROM ShiireDts AS a
            LEFT JOIN ShiireMeisaiDts AS b ON b.shiire_dt_id = a.id
            LEFT JOIN ShouhinMrs AS c ON c.cd = b.shouhin_mr_cd
            LEFT JOIN TanniMrs AS d ON d.cd = b.tanni_mr1_cd
            LEFT JOIN TanniMrs AS e ON e.cd = b.tanni_mr2_cd
            LEFT JOIN NyuukaKbns AS f ON f.cd = b.nyuuka_kbn_cd
            LEFT JOIN SoukoMrs AS g on g.cd = b.souko_mr_cd
            WHERE NOT (b.utiwake_kbn_cd = '40' OR b.utiwake_kbn_cd = '41') AND (a.hacchuu_dt_id = :hacchuu_id:) 
            AND (b.shouhin_mr_cd = :shouhin_mr_cd:) AND (b.iro = :iro:)
            ORDER BY b.id DESC
        ";
        $rows = $mgr->executeQuery($phql, ['hacchuu_id' => $hacchuu_id,'shouhin_mr_cd' => $shouhin_mr_cd, 'iro' => $iro,]);
        $this->view->rows = $rows;
    }

    /**
     * Index action
     */
    public function indexAction()
    {
        ControllerBase::indexCd("ShiireDts", "仕入伝票", "shiirebi DESC");
    }

    /**
     * モーダル
     */
    public function modalAction()
    {
        ControllerBase::indexCd("ShiireMeisaiDts", "仕入明細", "updated DESC");
    }

    /**
     * Searches for shiire_dts
     */
    public function searchAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Displays the creation form
     */
    public function newAction($id = null, $dataname = "Shiire")
    {
        $this->view->imax = 0;
        $zeiritu_mrs = ZeirituMrs::find(['order' => 'kazei_kbn_cd, kijunbi DESC']);
        $this->view->zeiritu_mrs = $zeiritu_mrs;

        if ($id) {
            if (substr($dataname, 0, 1) == '-') {
                $nameDts = substr($dataname, 1) . "Dts";
            } else {
                $nameDts = $dataname . "Dts";
            }
            $shiire_dt = $nameDts::findFirstByid($id);
            if (!$shiire_dt) {
                $this->flash->error($dataname . "伝票が見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "shiire_dts",
                    'action' => 'index'
                ));

                return;
            }
            $this->_setDefault($shiire_dt, "new", $dataname);
            $this->tag->setDefault("id", null);
            $this->tag->setDefault("cd", null);
            $this->tag->setDefault("nendo", null);
            $this->tag->setDefault("shiirebi", date("Y-m-d"));
            $this->tag->setDefault("shounin_joutai_flg", 0);
            $this->tag->setDefault("shounin_sha_mr_cd", null);
            $this->tag->setDefault("sakusei_user_name", null);
            $this->tag->setDefault("sakusei_user_id", null);
            $this->tag->setDefault("cleated", null);
            $this->tag->setDefault("kousin_user_id", null);
            $this->tag->setDefault("updated", null);
        }
        $this->tag->setDefault("shiirebi", date("Y-m-d"));
        $this->tag->setDefault("sakusei_user_name", $this->getDI()->getSession()->get('auth')['name']);
        $this->tag->setDefault("updated", null);

        $readonly_ctlr = new ReadonlyFieldKbnsController();
        $this->view->readonlys = $readonly_ctlr->setFormFieldReadonlys('ShiireDts', 'inputfields');
        $rewidth_ctlr = new RewidthFieldMrsController();
        $this->view->rewidths = $rewidth_ctlr->setFormFieldRewidths('ShiireDts', 'inputfields');
    }

    /**
     * 修正画面から「次へ」ボタンを押したら次のコードの修正画面になる。
     */
    public function nextAction($id)
    {
        ControllerBase::nextCd($id, "shiire_dts", "ShiireDts", "仕入伝票");
    }

    /**
     * 修正画面から「前へ」ボタンを押したら前のコードの修正画面になる。
     */
    public function prevAction($id = 0)
    {
        ControllerBase::prevCd($id, "shiire_dts", "ShiireDts", "仕入伝票");
    }

    /**
     * Edits a shiire_dt
     *
     * @param string $id
     */
    public function editAction($id, $exp = null)
    {

//        if (!$this->request->isPost()) {

        $shiire_dt = ShiireDts::findFirstByid($id);
        if (!$shiire_dt) {
            $this->flash->error("仕入伝票が見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "shiire_dts",
                'action' => 'index'
            ));

            return;
        }

        $url = new Phalcon\Mvc\Url();

        $this->view->id = $id;
        if (!empty($exp)) {
            $this->view->exp = $this->url->get('shiire_dts/' . $exp . '/' . $id); //作成・更新後にedit画面が出たときにExcelをexportする←createAction最後・saveAction最後→app/views/index.volt
        }

        $this->_setDefault($shiire_dt, "edit");

        $zeiritu_mrs = ZeirituMrs::find(['order' => 'kazei_kbn_cd, kijunbi DESC']);
        $this->view->zeiritu_mrs = $zeiritu_mrs;

        if (count($shiire_dt->ShiiresakiMrs->ShiiresakiSimeDts) > 0) {
            $this->view->simezumibi = $shiire_dt->ShiiresakiMrs->ShiiresakiSimeDts[0]->sime_hiduke; // 最終締日
        }

//        }
        $readonly_ctlr = new ReadonlyFieldKbnsController();
        $this->view->readonlys = $readonly_ctlr->setFormFieldReadonlys('ShiireDts', 'inputfields');
        $rewidth_ctlr = new RewidthFieldMrsController();
        $this->view->rewidths = $rewidth_ctlr->setFormFieldRewidths('ShiireDts', 'inputfields');
    }

    /**
     * 画面に表示するデータをセットする
     */
    public function _setDefault($shiire_dt, $action = "edit", $meisai = "Shiire")
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
            "shiirebi",
            "hacchuu_dt_id",
            "juchuu_dt_cd",
            "shounin_joutai_flg",
            "shounin_sha_mr_cd",
            "zeiritu_tekiyoubi",
            "shiiresaki_mr_cd",
            "torihiki_kbn_cd",
            "zei_tenka_kbn_cd",
            "tantou_mr_cd",
            "shimekiri_flg",
            "id_moto",
            "hikae_dltflg",
            "hikae_user_id",
            "hikae_nichiji",
            "sakusei_user_name",
            "created",
            "kousin_user_id",
            "updated",
            "shiiresaki_mr_zandaka"
        ];
        foreach ($setdts as $setdt) {
            if (property_exists($shiire_dt, $setdt)) {
                $this->tag->setDefault($setdt, $shiire_dt->$setdt);
            }
        }
        if ($meisai == "Hacchuu") {
            $this->tag->setDefault("hacchuu_dt_cd", $shiire_dt->cd);
            $this->tag->setDefault("hacchuu_dt_id", $shiire_dt->id);
        } else {
            if (property_exists($shiire_dt, "hacchuu_dt_id")) {
                $this->tag->setDefault("hacchuu_dt_cd", $shiire_dt->HacchuuDts->cd);
            }
        }
        if (property_exists($shiire_dt, "zeiritu_tekiyoubi")) {
            $this->tag->setDefault("zeiritu_tekiyoubi", ($shiire_dt->zeiritu_tekiyoubi == "0000-00-00") ? "" : $shiire_dt->zeiritu_tekiyoubi);
        }
        if (property_exists($shiire_dt, "kaishuu_yoteibi")) {
            $this->tag->setDefault("kaishuu_yoteibi", ($shiire_dt->kaishuu_yoteibi == "0000-00-00") ? "" : $shiire_dt->kaishuu_yoteibi);
        }
        if (property_exists($shiire_dt, "shiiresaki_mr_cd")) {
            $this->tag->setDefault("shiiresaki_mr_zandaka", number_format($shiire_dt->ShiiresakiMrs->kake_zandaka));
            $this->tag->setDefault("shiiresaki_mr_name", $shiire_dt->ShiiresakiMrs->name);
            $this->tag->setDefault("tanka_shurui_kbn_name", $shiire_dt->ShiiresakiMrs->TankaShuruiKbns->name);
            $this->tag->setDefault("tanka_shurui_kbn_koumokumei", $shiire_dt->ShiiresakiMrs->TankaShuruiKbns->koumokumei);
            $this->tag->setDefault("gaku_hasuu_shori_kbn_cd", $shiire_dt->ShiiresakiMrs->gaku_hasuu_shori_kbn_cd);//端数処理設定用
            $this->tag->setDefault("zei_hasuu_shori_kbn_cd", $shiire_dt->ShiiresakiMrs->zei_hasuu_shori_kbn_cd);//端数処理設定用
            $this->tag->setDefault("simezumibi", count($shiire_dt->ShiiresakiMrs->ShiiresakiSimeDts) ? $shiire_dt->ShiiresakiMrs->ShiiresakiSimeDts[0]->sime_hiduke : "0000-00-00");// 最終締日
        }
        if (property_exists($shiire_dt, "nounyuusaki_mr_cd")) {
            $this->tag->setDefault("nounyuusaki_mr_name", $shiire_dt->NounyuusakiMrs->name);
        }
        $this->tag->setDefault("sakusei_user_name", $shiire_dt->SakuseiUsers->name);

        $meisai_dts = $meisai . "MeisaiDts";
        $setmss = [
            "id",
            "cd",
            "utiwake_kbn_cd",
            "kousei",
            "nyuuka_kbn_cd",
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
            "iro",
            "iromei",
            "size",
            "souko_mr_cd",
            "suuryou2",
            "tanka_kbn",
            "gentanka",
            "tanka",
            "kingaku",
            "genkagaku",
            "project_mr_cd",
            "zeiritu_mr_cd",
            "bikou",
            "updated"
        ];
        $i = 0;
        foreach ($shiire_dt->$meisai_dts as $shiire_meisai_dt) {
            foreach ($setmss as $setms) {
                if (property_exists($shiire_meisai_dt, $setms)) {
                    $this->tag->setDefault("data[shiire_meisai_dts][" . $i . "][" . $setms . "]", $shiire_meisai_dt->$setms);
                }
            }
            if ($action == "new") {
                $this->tag->setDefault("data[shiire_meisai_dts][" . $i . "][id]", null);
                $this->tag->setDefault("data[shiire_meisai_dts][" . $i . "][nyuuka_kbn_cd]", null);
            }
            $this->tag->setDefault("data[shiire_meisai_dts][" . $i . "][cd]", $i + 1);//行番を振りなおす
            if (property_exists($shiire_meisai_dt, "shouhin_mr_cd")) {
                if (property_exists($shiire_meisai_dt, "suuryou")) {
                    $this->tag->setDefault("data[shiire_meisai_dts][" . $i . "][suuryou]", number_format($sgn * $shiire_meisai_dt->suuryou, $shiire_meisai_dt->ShouhinMrs->suu_shousuu));
                }
                if (property_exists($shiire_meisai_dt, "suuryou1")) {
                    $this->tag->setDefault("data[shiire_meisai_dts][" . $i . "][suuryou1]", number_format($sgn * $shiire_meisai_dt->suuryou1, $shiire_meisai_dt->ShouhinMrs->suu1_shousuu));
                }
                if (property_exists($shiire_meisai_dt, "suuryou2")) {
                    $this->tag->setDefault("data[shiire_meisai_dts][" . $i . "][suuryou2]", number_format($sgn * $shiire_meisai_dt->suuryou2, $shiire_meisai_dt->ShouhinMrs->suu2_shousuu));
                }
                if (property_exists($shiire_meisai_dt, "gentanka")) {
                    $this->tag->setDefault("data[shiire_meisai_dts][" . $i . "][gentanka]", number_format($shiire_meisai_dt->gentanka, $shiire_meisai_dt->ShouhinMrs->tanka_shousuu));
                }
                if (property_exists($shiire_meisai_dt, "tanka")) {
                    $this->tag->setDefault("data[shiire_meisai_dts][" . $i . "][tanka]", number_format($shiire_meisai_dt->tanka, $shiire_meisai_dt->ShouhinMrs->tanka_shousuu));
                }
                if (property_exists($shiire_meisai_dt, "kingaku")) {
                    $this->tag->setDefault("data[shiire_meisai_dts][" . $i . "][kingaku]", number_format($sgn * $shiire_meisai_dt->kingaku));
                }
                $this->tag->setDefault("data[shiire_meisai_dts][" . $i . "][suu_shousuu]", $shiire_meisai_dt->ShouhinMrs->suu_shousuu);//桁数設定用
                $this->tag->setDefault("data[shiire_meisai_dts][" . $i . "][suu1_shousuu]", $shiire_meisai_dt->ShouhinMrs->suu1_shousuu);//桁数設定用
                $this->tag->setDefault("data[shiire_meisai_dts][" . $i . "][suu2_shousuu]", $shiire_meisai_dt->ShouhinMrs->suu2_shousuu);//桁数設定用
                $this->tag->setDefault("data[shiire_meisai_dts][" . $i . "][tanka_shousuu]", $shiire_meisai_dt->ShouhinMrs->tanka_shousuu);//桁数設定用
                $this->tag->setDefault("data[shiire_meisai_dts][" . $i . "][zaiko_kbn]", $shiire_meisai_dt->ShouhinMrs->zaiko_kbn);//桁数設定用
                $this->tag->setDefault("data[shiire_meisai_dts][" . $i . "][moto_tanni_mr2_cd]", $shiire_meisai_dt->ShouhinMrs->tanni_mr2_cd);//桁数設定用
                $this->tag->setDefault("data[shiire_meisai_dts][" . $i . "][kazei_kbn_cd]", $shiire_meisai_dt->ShouhinMrs->kazei_kbn_cd);//税率計算用
            }
            if ($shiire_dt->hacchuu_dt_id > 0) {
                $zan_vw = ZaikoKakuninAzukariVws::sum([
                    "column" => "hacchuuzan_ryou" . $shiire_meisai_dt->tanka_kbn,
                    "conditions" => "hacchuu_dt_id=?1 AND shouhin_mr_cd=?2 AND iro=?3",
                    "bind" => [1 => $shiire_dt->hacchuu_dt_id, 2 => $shiire_meisai_dt->shouhin_mr_cd,3 => $shiire_meisai_dt->iro,]
                ]);
                $this->tag->setDefault("data[shiire_meisai_dts][" . $i . "][hacchuuzan]", number_format($zan_vw, $shiire_meisai_dt->ShouhinMrs->suu_shousuu));
            }
            $i++;
        }
        $this->view->imax = $i;
    }

    /**
     * Creates a new shiire_dt
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "shiire_dts",
                'action' => 'index'
            ));

            return;
        }

        $shiire_dt = new ShiireDts();
        $post_flds = [
            "cd",
            "nendo",
            "tekiyou",
            "shiirebi",
            "hacchuu_dt_id",
            "juchuu_dt_cd",
            "shounin_joutai_flg",
            "shounin_sha_mr_cd",
            "zeiritu_tekiyoubi",
            "shiiresaki_mr_cd",
            "torihiki_kbn_cd",
            "zei_tenka_kbn_cd",
            "tantou_mr_cd",
            "shimekiri_flg",
            "updated",
        ];

        $meisai_flds = [
            "cd",
            "utiwake_kbn_cd",
            "kousei",
            "nyuuka_kbn_cd",
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
            "iro",
            "iromei",
            "size",
            "souko_mr_cd",
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

        $meisai_nums = ["suuryou1",
            "irisuu",
            "keisu",
            "suuryou",
            "suuryou1",
            "suuryou2",
            "tanka",
            "gentanka",
            "kingaku",
            "genkagaku",
            "zeinukigaku",
            "zeigaku"]; // 税抜額と税額は調整計算用

        $thisPost = [];
        $thisPost["zeiritu_tekiyoubi"] = ($this->request->getPost("zeiritu_tekiyoubi") == "") ? "0000-00-00" : $this->request->getPost("zeiritu_tekiyoubi");

        foreach ($post_flds as $post_fld) {
            $shiire_dt->$post_fld = array_key_exists($post_fld, $thisPost) ? $thisPost[$post_fld] : $this->request->getPost($post_fld);
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
        $shiire_dt->ShiireMeisaiDts = array();
        $ShiireMeisaiDts = array();
        $i = 0;

        foreach ($meisai["shiire_meisai_dts"] as $shiire_meisai_dt) {
            if ($shiire_meisai_dt["shouhin_mr_cd"] !== ''
                && $shiire_meisai_dt["cd"] !== ''
                && $shiire_meisai_dt["cd"] !== '0'
                && $shiire_meisai_dt["utiwake_kbn_cd"] !== '') {
//            if ($shiire_meisai_dt["shouhin_mr_cd"] != '') {
                $meisaicnv[$i] = [];
                foreach ($meisai_nums as $meisai_num) {
                    $meisaicnv[$i][$meisai_num] = str_replace(',', '', $shiire_meisai_dt[$meisai_num]);//カンマ除去
                }
                if ($zeinuki_chousei_gaku != 0 && $shiire_meisai_dt["zeiritu_mr_cd"] < '80') { // 消費税調整と税抜額調整が必要な場合はする
                    $meisaicnv[$i]["zeinukigaku"] += $zeinuki_chousei_muki;
                    $zeinuki_chousei_gaku -= $zeinuki_chousei_muki;
                }
                if ($zei_chousei_gaku != 0 && $shiire_meisai_dt["zeiritu_mr_cd"] < '80') {
                    $meisaicnv[$i]["zeigaku"] += $zei_chousei_muki;
                    $zei_chousei_gaku -= $zei_chousei_muki;
                }
                $ShiireMeisaiDts[$i] = new ShiireMeisaiDts();
                foreach ($meisai_flds as $meisai_fld) {
                    $ShiireMeisaiDts[$i]->$meisai_fld = array_key_exists($meisai_fld, $meisaicnv[$i]) ? $meisaicnv[$i][$meisai_fld] : $shiire_meisai_dt[$meisai_fld] ?? '';
                    //更新日時や更新者はModelに定義してある
                }
                $i++;
            }
        }
        $shiire_dt->ShiireMeisaiDts = $ShiireMeisaiDts;

        /* 伝票番号付番または再設定 */
        $den_ban_ctrl = new DenpyouBangouMrsController(); //伝票番号マスタコントローラ
        $nendo_ban = $den_ban_ctrl->countup('shiire', 0, $shiire_dt->shiirebi); // 新規なので$shiire_dt->cd使わない2019/03/16井浦
        if (!$nendo_ban['nendo']) {
            $this->flash->error("エラー:年度が未登録（日付が今年か昨年以外は不可）。" . $shiire_dt->shiirebi);
            $this->dispatcher->forward(array(
                'controller' => "shiire_dts",
                'action' => 'edit',
                'params' => array($id)
            ));
        }
        $shiire_dt->cd = $nendo_ban['bangou'];
        $shiire_dt->nendo = $nendo_ban['nendo'];

        if (!$shiire_dt->save()) {
            foreach ($shiire_dt->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "shiire_dts",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("仕入伝票の作成が完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "shiire_dts",
            'action' => 'edit',
            'params' => array($shiire_dt->id/*, 'denpyou'*/) //伝票Excel出力
        ));
    }

    /**
     * Saves a shiire_dt edited
     *
     */
    public function saveAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "shiire_dts",
                'action' => 'index'
            ));
            return;
        }

        $id = $this->request->getPost("id");
        $shiire_dt = ShiireDts::findFirstByid($id);

        if (!$shiire_dt) {
            $this->flash->error("仕入伝票が見つからなくなりました。" . $id);

            $this->dispatcher->forward(array(
                'controller' => "shiire_dts",
                'action' => 'index'
            ));

            return;
        }

        $post_flds = [
            "cd",
            "tekiyou",
            "shiirebi",
            "hacchuu_dt_id",
            "juchuu_dt_cd",
            "shounin_joutai_flg",
            "shounin_sha_mr_cd",
            "zeiritu_tekiyoubi",
            "shiiresaki_mr_cd",
            "torihiki_kbn_cd",
            "zei_tenka_kbn_cd",
            "tantou_mr_cd",
            "shimekiri_flg",
            "updated",
        ];

        $meisai_flds = [
            "id",
            "cd",
            "utiwake_kbn_cd",
            "kousei",
            "nyuuka_kbn_cd",
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
            "iro",
            "iromei",
            "size",
            "souko_mr_cd",
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
            "irisuu",
            "keisu",
            "suuryou",
            "suuryou1",
            "suuryou2",
            "gentanka",
            "tanka",
            "kingaku",
            "genkagaku",
            "zeinukigaku",
            "zeigaku"]; // 税抜額と税額は調整計算用

        if ($shiire_dt->updated !== $this->request->getPost("updated")) {
            $this->flash->error("他のプロセスから仕入伝票が変更されたため失敗しました。"
                . $id . ",uid=" . $shiire_dt->kousin_user_id);

            $this->dispatcher->forward(array(
                'controller' => "shiire_dts",
                'action' => 'index'
            ));

            return;
        }
        $meisai = $this->request->getPost("data");

        $i = 0;
        foreach ($meisai["shiire_meisai_dts"] as $shiire_meisai_dt) {
            if ((int)$shiire_meisai_dt["id"] !== 0) {
                if ((int)$shiire_dt->ShiireMeisaiDts[$i]->id !== (int)$shiire_meisai_dt["id"] ||
                    $shiire_dt->ShiireMeisaiDts[$i]->updated !== $shiire_meisai_dt["updated"]) {
                    $this->flash->error("他のプロセスから仕入伝票明細が変更されたため失敗しました。"
                        . $id . ",id=" . $shiire_dt->ShiireMeisaiDts[$i]->id . ",uid=" . $shiire_dt->ShiireMeisaiDts[$i]->kousin_user_id);

                    $this->dispatcher->forward(array(
                        'controller' => "shiire_dts",
                        'action' => 'index'
                    ));

                    return;
                }
            }
            $i++;
        }

        $thisPost = [];
        $thisPost["zeiritu_tekiyoubi"] = ($this->request->getPost("zeiritu_tekiyoubi") == "") ? "0000-00-00" : $this->request->getPost("zeiritu_tekiyoubi");

        $chg_flg = 0;
        foreach ($post_flds as $post_fld) {
            if ((array_key_exists($post_fld, $thisPost) ? $thisPost[$post_fld] : $this->request->getPost($post_fld)) !== $shiire_dt->$post_fld) {
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
        foreach ($meisai["shiire_meisai_dts"] as $shiire_meisai_dt) {
            $meisaicnv[$i] = [];
            foreach ($meisai_nums as $meisai_num) {
                $meisaicnv[$i][$meisai_num] = (double)str_replace(',', '', $shiire_meisai_dt[$meisai_num]);//カンマ除去
            }
            if ((int)$shiire_meisai_dt["cd"] !== 0 && $shiire_meisai_dt["zeiritu_mr_cd"] < '80') { // 消費税調整と税抜額調整が必要な場合はする
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
            if ((int)$shiire_meisai_dt["cd"] === 0 && (int)$shiire_meisai_dt["id"] !== 0) { // 削除の条件
                $chg_flg = 1;
                $chg_flgs[$i] = 2;//削除
            } else if ((int)$shiire_meisai_dt["id"] === 0) { // echo ($shiire_meisai_dt["id"] === "")?"null":"0";//nullの伝わり方
                if ((int)$shiire_meisai_dt["id"] !== 0 || (int)$shiire_meisai_dt["utiwake_kbn_cd"] !== 0) {
                    $chg_flg = 1;
                    $chg_flgs[$i] = 1;
                }
            } else if ((int)$shiire_meisai_dt["cd"] !== 0) {
                foreach ($meisai_flds as $meisai_fld) {
                    if ((array_key_exists($meisai_fld, $meisaicnv[$i]) ? $meisaicnv[$i][$meisai_fld] : $shiire_meisai_dt[$meisai_fld]) . '' !== $shiire_dt->ShiireMeisaiDts[$i]->$meisai_fld) {
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
                "controller" => "shiire_dts",
                "action" => "edit",
                "params" => array($shiire_dt->id)
            ));

            return;
        }
        /** デバッグ
         * echo "<pre>";
         * var_dump($chg_flgs);
         * echo "</pre>";
         * return;
         */
        $this->_bakOut($shiire_dt, $chg_flg, $chg_flgs);

        foreach ($post_flds as $post_fld) {
            $shiire_dt->$post_fld = array_key_exists($post_fld, $thisPost) ? $thisPost[$post_fld] : $this->request->getPost($post_fld);
        }
        /* 伝票番号付番または再設定 */
        $den_ban_ctrl = new DenpyouBangouMrsController(); //伝票番号マスタコントローラ
        $nendo_ban = $den_ban_ctrl->countup('shiire', $shiire_dt->cd, $shiire_dt->shiirebi, $shiire_dt->nendo);
        if (!$nendo_ban['nendo']) {
            $this->flash->error("エラー:年度が未登録（日付が今年か昨年以外は不可）。" . $shiire_dt->shiirebi);
            $this->dispatcher->forward(array(
                'controller' => "shiire_dts",
                'action' => 'edit',
                'params' => array($id)
            ));
        }
        $shiire_dt->cd = $nendo_ban['bangou'];
        $shiire_dt->nendo = $nendo_ban['nendo'];
        $i = 0;
        foreach ($meisai["shiire_meisai_dts"] as $shiire_meisai_dt) {
            if ($chg_flgs[$i] === 2) { // 削除でないとき
                $meisai_ctlr = new ShiireMeisaiDtsController();
                $meisai_ctlr->deleteAction($shiire_meisai_dt["id"]);
            } else {
                if ((int)$shiire_meisai_dt["id"] !== 0) {
                    $ShiireMeisaiDts[$i] = $shiire_dt->ShiireMeisaiDts[$i];
                }
                if ($chg_flgs[$i] === 1) { // 更新なら
                    if ((int)$shiire_meisai_dt["id"] === 0) {
                        $ShiireMeisaiDts[$i] = new ShiireMeisaiDts();
                    }
                    foreach ($meisai_flds as $meisai_fld) {
                        $ShiireMeisaiDts[$i]->$meisai_fld = array_key_exists($meisai_fld, $meisaicnv[$i]) ? $meisaicnv[$i][$meisai_fld] : $shiire_meisai_dt[$meisai_fld] ?? '';
                        //更新日時や更新者はModelに定義してある
                    }
                }
                // 消込データがあれば併せて削除する
                $shukkin_kesikomi_dts = ShukkinKesikomiDts::find('shiire_meisai_dt_id = ' . $shiire_meisai_dt['id']);
                if ($shukkin_kesikomi_dts !== false) {
                    if ($shukkin_kesikomi_dts->delete() === false) {
                        $this->flash->error('Keshikomi Delete: Error');
                    }
                }
            }
            $i++;
        }
        $shiire_dt->ShiireMeisaiDts = $ShiireMeisaiDts;

        if (!$shiire_dt->save()) {

            foreach ($shiire_dt->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "shiire_dts",
                'action' => 'edit',
                'params' => array($shiire_dt->id)
            ));

            return;
        }

        $this->flash->success("仕入伝票の情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "shiire_dts",
            'action' => 'edit',
            'params' => array($shiire_dt->id)
        ));
    }

    /**
     * Deletes a shiire_dt
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $shiire_dt = ShiireDts::findFirstByid($id);
        if (!$shiire_dt) {
            $this->flash->error("仕入伝票が見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "shiire_dts",
                'action' => 'index'
            ));

            return;
        }

        foreach ($shiire_dt->ShiireMeisaiDts as $shiire_meisai_dt) { // 2019/5/9 追加 井浦
            $meisai_ctlr = new ShiireMeisaiDtsController();
            $meisai_ctlr->deleteAction($shiire_meisai_dt->id);
            // 消込データがあれば併せて削除する
            $shukkin_kesikomi_dts = ShukkinKesikomiDts::find('shiire_meisai_dt_id = ' . $shiire_meisai_dt->id);
            if ($shukkin_kesikomi_dts !== false) {
                if ($shukkin_kesikomi_dts->delete() === false) {
                    $this->flash->error('Keshikomi Delete: Error');
                }
            }
        }

        if (!$shiire_dt->delete()) {

            foreach ($shiire_dt->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "shiire_dts",
                'action' => 'search'
            ));

            return;
        }

        $this->_bakOut($shiire_dt, 1);

        $this->flash->success("仕入伝票の削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "shiire_dts",
            'action' => "index"
        ));
    }

    /**
     * Back Out a shiire_dt
     *
     * @param string $shiire_dt , $dlt_flg
     */
    public function _bakOut($shiire_dt, $dlt_flg = 0, $chg_flgs = array())
    {
        $bak_shiire_dt = new BakShiireDts();
        foreach ($shiire_dt as $fld => $value) {
            $bak_shiire_dt->$fld = $shiire_dt->$fld;
        }
        $bak_shiire_dt->id = NULL;
        $bak_shiire_dt->id_moto = $shiire_dt->id;
        $bak_shiire_dt->hikae_dltflg = $dlt_flg;
        $bak_shiire_dt->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_shiire_dt->hikae_nichiji = date("Y-m-d H:i:s");
        if (!$bak_shiire_dt->save()) {
            foreach ($bak_shiire_dt->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
        $meisai_ctlr = new ShiireMeisaiDtsController();
        $i = 0;
        foreach ($shiire_dt->ShiireMeisaiDts as $shiire_meisai_dt) {
            if ($dlt_flg === 1 || $chg_flgs[$i] === 1) { // 更新なしは不要、削除は別に出ている、親から削除のときはここで出す
                $meisai_ctlr->_bakOut($shiire_meisai_dt, $dlt_flg);
            }
            $i++;
        }
    }

    /**
     * 伝票イメージでエクセル出力する。
     **/
    public function denpyouAction($id = null)
    {
        //DBのデータを読み込む
        $shiire_dt = ShiireDts::findFirstByid($id);
        if (!$shiire_dt) {
            $this->flash->error("売上伝票が見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "shiire_dts",
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
        //$PHPExcel = new PHPExcel();

        //テンプレートの読み込み
        $objReader = PHPExcel_IOFactory::createReader("Excel5");
        //テンプレートファイルパス
        $temp_dir = __DIR__ . '/temp/';
        $temp_path = $temp_dir . "shiireden.xls";
        $PHPExcel = $objReader->load($temp_path);

        //表紙への入力
        //シートの設定
        $PHPExcel->setActiveSheetIndex(0);  //0はsheet1(一番左のシート)
        $sheet = $PHPExcel->getActiveSheet();
        $sheet->setCellValue('AV2', '_' . $shiire_dt->cd . '_'); //伝票№
        $sheet->setCellValue('A2', $shiire_dt->ShiiresakiMrs->name); //宛先名称
        $sheet->setCellValue('A3', $shiire_dt->ShiiresakiMrs->bushomei . ' ' . $shiire_dt->ShiiresakiMr->yakushoku . ' ' . $shiire_dt->ShiiresakiMr->gotantousha . ' ' . $shiire_dt->ShiiresakiMr->keishou); //宛先名称
        $sheet->setCellValue('A4', '〒 ' . $shiire_dt->ShiiresakiMrs->yuubin_bangou); //宛先〒番号
        $sheet->setCellValue('A5', $shiire_dt->ShiiresakiMrs->juusho1); //宛先住所
        $sheet->setCellValue('A6', $shiire_dt->ShiiresakiMrs->juusho2); //宛先住所2
        $sheet->setCellValue('A7', 'TEL ' . $shiire_dt->ShiiresakiMrs->tel . '  FAX ' . $shiire_dt->ShiiresakiMr->fax); //宛先TEL+FAX
        $sheet->setCellValue('Z8', substr($shiire_dt->shiirebi, 0, 4)); //依頼年
        $sheet->setCellValue('AC8', substr($shiire_dt->shiirebi, 5, 2)); //依頼月
        $sheet->setCellValue('AE8', substr($shiire_dt->shiirebi, 8, 2)); //依頼日
        $sheet->setCellValue('AU8', $shiire_dt->tantouMrs->name); //担当者名
        $sheet->setCellValue('B31', $shiire_dt->bikou); //備考
        $i = 12; //EXCELの明細開始行
        foreach ($shiire_dt->ShiireMeisaiDts as $shiire_meisai_dt) {
            $sheet->setCellValue('A' . $i, $shiire_meisai_dt->tekiyou); //品目名/摘要
            $sheet->setCellValue('M' . $i, $shiire_meisai_dt->bikou); //ロット（備考）
            $sheet->setCellValue('R' . $i, $shiire_meisai_dt->suuryou2 . $shiire_meisai_dt->TanniMrs->name); //数量
            $sheet->setCellValue('V' . $i, $shiire_meisai_dt->suuryou1 . $shiire_meisai_dt->SuuTanniMr->name); //数量2
            $sheet->setCellValue('AW' . $i, substr($shiire_dt->shiirebi, 5, 2) . '/' . substr($shiire_dt->shiirebi, 8, 2)); //納期
            $i += 3;
        }//end foreach

        // Excelファイルの保存 ------------------------------------------

        //保存ファイル名
        $filename = uniqid("shiireden", true) . '.xls';

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
     * 伝票生データでエクセル出力する。
     **/
    public function exportAction($id = null)
    {
        //DBのデータを読み込む
        $shiire_dt = ShiireDts::findFirstByid($id);
        if (!$shiire_dt) {
            $this->flash->error("売上伝票が見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "shiire_dts",
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
            , "仕入先", "取引区分", "税転嫁", "担当者", "締切"
            , "分類コード", "伝票区分", "元ID", "控え時削除フラグ", "控え操作者"
            , "控え日付", "作成者", "作成日時", "更新者", "更新日時"];
        $shu_nums = [1, 1, 1, 0, 0, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,]; //1=数値,0=文字列
        $shu_flds = ["id", "cd", "nendo", "tekiyou", "shiirebi", "juchuu_cd", "mitumori_cd", "shounin_joutai_flg", "shounin_sha_mr_cd", "zeiritu_tekiyoubi"
            , "shiiresaki_mr_cd", "torihiki_kbn_cd", "zei_tenka_kbn_cd", "tantou_mr_cd", "shimekiri_flg"
            , "bunrui_cd", "denpyou_kbn", "id_moto", "hikae_dltflg", "hikae_user_id"
            , "hikae_nichiji", "sakusei_user_id", "created", "kousin_user_id", "updated"];
        $meisai_titles = ["id", "行番", "内訳", "構造", "仕入伝票ID", "入荷", "商品コード", "単位", "数単位", "元数量", "係数"
            , "入数", "ケース", "商品名/摘要", "ロット", "個別コード", "倉庫コード", "棚コード", "規格型番", "色", "色名", "サイズ", "数量", "単価"
            , "金額", "プロジェクトコード", "課税区分", "備考", "元ID", "控え時削除フラグ", "控え操作者"
            , "控え日付", "作成者", "作成日時", "更新者", "更新日時"];
        $meisai_nums = [1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 1, 1, 1, 0, 0, 0, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,]; //1=数値,0=文字列
        $meisai_flds = ["id", "cd", "utiwake_kbn_cd", "kousei", "shiire_dt_id", "shukka_kbn_cd", "shouhin_mr_cd", "tanni_mr2_cd", "tanni_mr1_cd", "suuryou", "keisu"
            , "irisuu", "suuryou1", "tekiyou", "lot", "kobetucd", "hinsitu_kbn_cd", "souko_mr_cd", "kikaku", "iro", "iromei", "size", "suuryou2", "tanka_kbn", "gentanka", "tanka"
            , "kingaku", "genkagaku", "project_mr_cd", "zeiritu_mr_cd", "bikou", "id_moto", "hikae_dltflg", "hikae_user_id"
            , "hikae_nichiji", "sakusei_user_id", "created", "kousin_user_id", "updated"];
        $sakuin_titles = ["仕入先名", "仕入先部署名", "仕入先役職", "仕入先ご担当", "仕入先敬称", "仕入先郵便番", "仕入先住所1", "仕入先住所2", "仕入先売掛金"
            , "取引区分", "税転嫁", "担当者", "単価種類", "承認者", "作成者", "更新者"];
        $sakuin_nums = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,]; //1=数値,0=文字列
        $sakuin_flds = [["ShiiresakiMrs", "name"], ["ShiiresakiMrs", "bushomei"], ["ShiiresakiMrs", "yakushoku"], ["ShiiresakiMrs", "gotantousha"], ["ShiiresakiMrs", "keishou"], ["ShiiresakiMrs", "yuubin_bangou"], ["ShiiresakiMrs", "juusho1"], ["ShiiresakiMrs", "juusho2"], ["ShiiresakiMrs", "kake_zandaka"]
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
        foreach ($shiire_dt->ShiireMeisaiDts as $shiire_meisai_dt) {
            $col = 0;
            $i = 0;
            foreach ($shu_flds as $shu_fld) {
                if ($shu_nums[$i++] == 1) {
                    $sheet->setCellValueByColumnAndRow($col++, $row, $shiire_dt->$shu_fld);
                } else {
                    $sheet->setCellValueExplicitByColumnAndRow($col++, $row, $shiire_dt->$shu_fld);
                }
            }
            $i = 0;
            foreach ($meisai_flds as $meisai_fld) {
                if ($meisai_nums[$i++] == 1) {
                    $sheet->setCellValueByColumnAndRow($col++, $row, $shiire_meisai_dt->$meisai_fld);
                } else {
                    $sheet->setCellValueExplicitByColumnAndRow($col++, $row, $shiire_meisai_dt->$meisai_fld);
                }
            }
            $i = 0;
            foreach ($sakuin_flds as $sakuin_fld) {
                if ($sakuin_nums[$i++] == 1) {
                    switch (count($sakuin_fld)) {
                        case 2:
                            $sheet->setCellValueByColumnAndRow($col, $row, $shiire_dt->$sakuin_fld[0]->$sakuin_fld[1]);
                            break;
                        case 3:
                            $sheet->setCellValueByColumnAndRow($col, $row, $shiire_dt->$sakuin_fld[0]->$sakuin_fld[1]->$sakuin_fld[2]);
                            break;
                    }
                } else {
                    switch (count($sakuin_fld)) {
                        case 2:
                            $sheet->setCellValueExplicitByColumnAndRow($col, $row, $shiire_dt->$sakuin_fld[0]->$sakuin_fld[1]);
                            break;
                        case 3:
                            $sheet->setCellValueExplicitByColumnAndRow($col, $row, $shiire_dt->$sakuin_fld[0]->$sakuin_fld[1]->$sakuin_fld[2]);
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
                            $sheet->setCellValueByColumnAndRow($col, $row, $shiire_meisai_dt->$meisaku_fld[0]->$meisaku_fld[1]);
                            break;
                        case 3:
                            $sheet->setCellValueByColumnAndRow($col, $row, $shiire_meisai_dt->$meisaku_fld[0]->$meisaku_fld[1]->$meisaku_fld[2]);
                            break;
                    }
                } else {
                    switch (count($meisaku_fld)) {
                        case 2:
                            $sheet->setCellValueExplicitByColumnAndRow($col, $row, $shiire_meisai_dt->$meisaku_fld[0]->$meisaku_fld[1]);
                            break;
                        case 3:
                            $sheet->setCellValueExplicitByColumnAndRow($col, $row, $shiire_meisai_dt->$meisaku_fld[0]->$meisaku_fld[1]->$meisaku_fld[2]);
                            break;
                    }
                }
                $col++;
            }
            $row++;
        }//end foreach

        // Excelファイルの保存 ------------------------------------------

        //保存ファイル名
        $filename = uniqid("shiiredt", true) . '.xls';

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
     * 弥生（仕入明細表）からインポート
     *        伝票順にソートしておく必要があります
     */
    public function impoyayoiAction()
    {
        $load_mr = LoadMrs::findFirst(['conditions' => 'cd = ?1', 'bind' => [1 => 'shiire_dts']]);
        $load_mr_ms = LoadMrs::findFirst(['conditions' => 'cd = ?1', 'bind' => [1 => 'shiire_meisai_dts']]); // 明細用

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
                    $zei_hasuu_shori_kbn_cd = $target_row->ShiiresakiMrs->zei_hasuu_shori_kbn_cd;
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
                $target_row = $classname_ms::findfirst(['conditions' => 'shiire_dt_id = ?1 AND cd = ?2', 'bind' => [1 => $id_mae, 2 => $ms_cd]]); // ms_cd=行番号
                if (!$target_row) {
                    $target_row = new $classname_ms();
                    $target_row->shiire_dt_id = $id_mae;
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

        $shiire_dts = ShiireDts::find(array(
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
            "shiirebi",
            "zeiritu_tekiyoubi",
            "shiiresaki_mr_cd",
            "torihiki_kbn_cd",
            "zei_tenka_kbn_cd",
            "tantou_mr_cd",
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
            "gentanka",
            "tanka",
            "suuryou2",
            "kingaku",
            "genkagaku",
            "zeiritu_mr_cd",
            "bikou",
        ];
        $resData = array();
        foreach ($shiire_dts as $shiire_dt) {
            $resAdata = array();
            foreach ($res_flds as $res_fld) {
                $resAdata[$res_fld] = $shiire_dt->$res_fld;
            }
            foreach ($shiire_dt->ShiireMeisaiDts as $shiire_meisai_dt) {
                foreach ($meisai_flds as $meisai_fld) {
                    $resAdata["meisai"][$shiire_meisai_dt->cd][$meisai_fld] = $shiire_meisai_dt->$meisai_fld;
                }
                $resAdata["meisai"][$shiire_meisai_dt->cd]['moto_tanni_mr2_cd'] = $shiire_meisai_dt->ShouhinMrs->tanni_mr2_cd;
                $resAdata["meisai"][$shiire_meisai_dt->cd]['suu_shousuu'] = $shiire_meisai_dt->ShouhinMrs->suu_shousuu;
                $resAdata["meisai"][$shiire_meisai_dt->cd]['suu1_shousuu'] = $shiire_meisai_dt->ShouhinMrs->suu1_shousuu;
                $resAdata["meisai"][$shiire_meisai_dt->cd]['suu2_shousuu'] = $shiire_meisai_dt->ShouhinMrs->suu2_shousuu;
                $resAdata["meisai"][$shiire_meisai_dt->cd]['tanka_shousuu'] = $shiire_meisai_dt->ShouhinMrs->tanka_shousuu;

            }
//	        $resAdata["seikyuusaki_name"] = $shiire_dt->SeikyuusakiMrs->name;
            $resData[] = $resAdata;//array('cd' => $shiire_dt->cd, 'name' => $shiire_dt->name);
        }

        //Set the content of the response
        $response->setContent(json_encode($resData));

        //Return the response
        return $response;
    }


    /**
     * Edits a shiire_dt
     *
     * @param string $id 在庫チェックテスト（終わったら消す。
     */
    public function edit2Action($id, $exp = null)
    {
//        if (!$this->request->isPost()) {

        $shiire_dt = ShiireDts::findFirstByid($id);
        if (!$shiire_dt) {
            $this->flash->error("仕入伝票が見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "shiire_dts",
                'action' => 'index'
            ));

            return;
        }

        $url = new Phalcon\Mvc\Url();

        $this->view->id = $id;
        if (!empty($exp)) {
            $this->view->exp = $this->url->get('shiire_dts/' . $exp . '/' . $id); //作成・更新後にedit画面が出たときにExcelをexportする←createAction最後・saveAction最後→app/views/index.volt
        }

        $this->_setDefault($shiire_dt, "edit");

        $zeiritu_mrs = ZeirituMrs::find(['order' => 'kazei_kbn_cd, kijunbi DESC']);
        $this->view->zeiritu_mrs = $zeiritu_mrs;

        if (count($shiire_dt->ShiiresakiMrs->ShiiresakiSimeDts) > 0) {
            $this->view->simezumibi = $shiire_dt->ShiiresakiMrs->ShiiresakiSimeDts[0]->sime_hiduke; // 最終締日
        }

//        }
        $readonly_ctlr = new ReadonlyFieldKbnsController();
        $this->view->readonlys = $readonly_ctlr->setFormFieldReadonlys('ShiireDts', 'inputfields');
        $rewidth_ctlr = new RewidthFieldMrsController();
        $this->view->rewidths = $rewidth_ctlr->setFormFieldRewidths('ShiireDts', 'inputfields');
    }

}
