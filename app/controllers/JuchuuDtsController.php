<?php

use Phalcon\Paginator\Adapter\Model as PaginatorModel;

class JuchuuDtsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        ControllerBase::indexCd("JuchuuDts", "受注伝票", "juchuubi DESC"); //簡易検索付き一覧表示
    }

    /**
     * モーダル
     */
    public function modalAction()
    {
        ControllerBase::indexCd("JuchuuDts", "受注伝票", "juchuubi DESC");
    }

    /**
     * Searches for juchuu_dts
     */
    public function searchAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Displays the creation form
     */
    public function newAction($id = null, $dataname = "Juchuu")
    {
        $this->view->imax = 0;
        $zeiritu_mrs = ZeirituMrs::find(['order' => 'kazei_kbn_cd, kijunbi DESC']);
        $this->view->zeiritu_mrs = $zeiritu_mrs;

        $tanka_shurui_kbns = TankaShuruiKbns::find(['order' => 'cd', 'conditions' => 'uriage_flg = 1']);
        $this->view->tanka_shurui_kbns = $tanka_shurui_kbns;

        if ($id) {
            $nameDts = $dataname . "Dts";
            $juchuu_dt = $nameDts::findFirstByid($id);
            if (!$juchuu_dt) {
                $this->flash->error("受注データが見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "juchuu_dts",
                    'action' => 'index'
                ));

                return;
            }
            $this->_setDefault($juchuu_dt, "new", $dataname);
            $this->tag->setDefault("id", null);
            $this->tag->setDefault("cd", null);
        }
        $this->tag->setDefault("juchuubi", date("Y-m-d"));
        $this->tag->setDefault("sakusei_user_name", $this->getDI()->getSession()->get('auth')['name']);
        $this->tag->setDefault("updated", null);

        $readonly_ctlr = new ReadonlyFieldKbnsController();
        $this->view->readonlys = $readonly_ctlr->setFormFieldReadonlys('JuchuuDts', 'inputfields');
        $rewidth_ctlr = new RewidthFieldMrsController();
        $this->view->rewidths = $rewidth_ctlr->setFormFieldRewidths('JuchuuDts', 'inputfields');
    }

    /**
     * 修正画面から「次へ」ボタンを押したら次のコードの修正画面になる。
     */
    public function nextAction($id)
    {
        ControllerBase::nextCd($id, "juchuu_dts", "JuchuuDts", "受注データ");
    }

    /**
     * 修正画面から「前へ」ボタンを押したら前のコードの修正画面になる。
     */
    public function prevAction($id = 0)
    {
        ControllerBase::prevCd($id, "juchuu_dts", "JuchuuDts", "受注データ");
    }

    /**
     * Edits a juchuu_dt
     *
     * @param string $id
     */
    public function editAction($id)
    {
        $zeiritu_mrs = ZeirituMrs::find(['order' => 'kazei_kbn_cd, kijunbi DESC']);
        $this->view->zeiritu_mrs = $zeiritu_mrs;

        $tanka_shurui_kbns = TankaShuruiKbns::find(['order' => 'cd', 'conditions' => 'uriage_flg = 1']);
        $this->view->tanka_shurui_kbns = $tanka_shurui_kbns;

//        if (!$this->request->isPost()) {

        $juchuu_dt = JuchuuDts::findFirstByid($id);
        if (!$juchuu_dt) {
            $this->flash->error("受注データが見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "juchuu_dts",
                'action' => 'index'
            ));

            return;
        }

        $this->view->id = $juchuu_dt->id;

        $this->_setDefault($juchuu_dt, "edit");
//        }
        $readonly_ctlr = new ReadonlyFieldKbnsController();
        $this->view->readonlys = $readonly_ctlr->setFormFieldReadonlys('JuchuuDts', 'inputfields');
        $rewidth_ctlr = new RewidthFieldMrsController();
        $this->view->rewidths = $rewidth_ctlr->setFormFieldRewidths('JuchuuDts', 'inputfields');
    }

    /**
     * 画面に表示するデータをセットする
     */
    public function _setDefault($juchuu_dt, $action = "edit", $meisai = "Juchuu")
    {
        $setdts = [
            "id",
            "cd",
            "nendo",
            "tekiyou",
            "juchuubi",
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
            "chokusousaki_kbn_cd",
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
            if (property_exists($juchuu_dt, $setdt)) {
                $this->tag->setDefault($setdt, $juchuu_dt->$setdt);
            }
        }
        if ($meisai == "Mitumori") {
            $this->tag->setDefault("mitumori_dt_id", $juchuu_dt->id);
            $this->tag->setDefault("mitumori_dt_cd", $juchuu_dt->cd);
        } else {
            if (property_exists($juchuu_dt, "mitumori_dt_id")) {
                $this->tag->setDefault("mitumori_dt_cd", isset($juchuu_dt->MitumoriDts->cd) ? $juchuu_dt->MitumoriDts->cd : '');
            }
        }
        if (property_exists($juchuu_dt, "zeiritu_tekiyoubi")) {
            $this->tag->setDefault("zeiritu_tekiyoubi", ($juchuu_dt->zeiritu_tekiyoubi == "0000-00-00") ? "" : $juchuu_dt->zeiritu_tekiyoubi);
        }
        if (property_exists($juchuu_dt, "nounyuu_kijitu")) {
            $this->tag->setDefault("nounyuu_kijitu", ($juchuu_dt->nounyuu_kijitu == "0000-00-00") ? "" : $juchuu_dt->nounyuu_kijitu);
        }
        if (property_exists($juchuu_dt, "tokuisaki_mr_cd")) {
            $this->tag->setDefault("tokuisaki_mr_zandaka", number_format($juchuu_dt->TokuisakiMrs->kake_zandaka));
            $this->tag->setDefault("tokuisaki_mr_name", $juchuu_dt->TokuisakiMrs->name);
            $this->tag->setDefault("tanka_shurui_kbn_name", $juchuu_dt->TokuisakiMrs->TankaShuruiKbns->name);
            $this->tag->setDefault("tanka_shurui_kbn_koumokumei", $juchuu_dt->TokuisakiMrs->TankaShuruiKbns->koumokumei);
            $this->tag->setDefault("kakeritu", $juchuu_dt->TokuisakiMrs->kakeritu);
            $this->tag->setDefault("seikyuusaki_name", $juchuu_dt->TokuisakiMrs->SeikyuusakiMrs->name);
            $this->tag->setDefault("gaku_hasuu_shori_kbn_cd", $juchuu_dt->TokuisakiMrs->gaku_hasuu_shori_kbn_cd);//端数処理設定用
            $this->tag->setDefault("zei_hasuu_shori_kbn_cd", $juchuu_dt->TokuisakiMrs->zei_hasuu_shori_kbn_cd);//端数処理設定用
        }
//		if (property_exists($juchuu_dt, "nounyuusaki_mr_cd")) {$this->tag->setDefault("nounyuusaki_mr_name", $juchuu_dt->nounyuusaki_mr_cd == ''?'':$juchuu_dt->NounyuusakiMrs->name);}
        $this->tag->setDefault("sakusei_user_name", $juchuu_dt->SakuseiUsers->name);

        $juchuu_zan = [];
        if ($juchuu_dt->id) {
            $di = \Phalcon\DI::getDefault();
            $mgr = $di->get('modelsManager');
            $phql = "
                SELECT shouhin_mr_cd, iro as iro, sum(juchuuzan_ryou1) AS zan_ryou1, sum(juchuuzan_ryou2) AS zan_ryou2
				FROM ZaikoKakuninAzukariVws
				WHERE juchuu_dt_id = :id:
				GROUP BY shouhin_mr_cd, iro
				";
            $rows = $mgr->executeQuery($phql, ['id' => $juchuu_dt->id]);
            foreach ($rows as $row) {
                $juchuu_zan[$row->shouhin_mr_cd][$row->iro] = ['zan_ryou1' => $row->zan_ryou1, 'zan_ryou2' => $row->zan_ryou2, 'shukka_kbn_cd' => 0];
            }
            $phql = "
                SELECT a.shouhin_mr_cd,a.iro, max(a.shukka_kbn_cd) AS shukka_kbn_cd_max
				FROM UriageMeisaiDts a
				left join UriageDts b on b.id = a.uriage_dt_id
				WHERE b.juchuu_dt_id = :id:
				GROUP BY shouhin_mr_cd, iro
				";
            $rows = $mgr->executeQuery($phql, ['id' => $juchuu_dt->id]);
            foreach ($rows as $row) {
                $juchuu_zan[$row->shouhin_mr_cd][$row->iro]['shukka_kbn_cd'] = $row->shukka_kbn_cd_max;
            }
        }

        $meisai_dts = $meisai . "MeisaiDts";
        $setmss = [
            "id",
            "utiwake_kbn_cd",
            "kousei",
            "shukka_kbn_cd",
            "shouhin_mr_cd",
            "tanni_mr2_cd",
            "tanni_mr1_cd",
            "tanka_kbn",
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
            "souko_mr_cd",
            "project_mr_cd",
            "zeiritu_mr_cd",
            "bikou",
            "nouki",
            "updated"
        ];
        $i = 0;
        foreach ($juchuu_dt->$meisai_dts as $juchuu_meisai_dt) {
            foreach ($setmss as $setms) {
                if (property_exists($juchuu_meisai_dt, $setms)) {
                    $this->tag->setDefault("data[juchuu_meisai_dts][" . $i . "][" . $setms . "]", $juchuu_meisai_dt->$setms);
                }
            }
            if ($action == "new") {
                $this->tag->setDefault("data[juchuu_meisai_dts][" . $i . "][id]", null);
            }
            $this->tag->setDefault("data[juchuu_meisai_dts][" . $i . "][cd]", $i + 1);//行番を振りなおす
            if (property_exists($juchuu_meisai_dt, "shouhin_mr_cd")) {
                if (property_exists($juchuu_meisai_dt, "suuryou")) {
                    $this->tag->setDefault("data[juchuu_meisai_dts][" . $i . "][suuryou]", number_format($juchuu_meisai_dt->suuryou, $juchuu_meisai_dt->ShouhinMrs->suu_shousuu));
                }
                if (property_exists($juchuu_meisai_dt, "suuryou1")) {
                    $this->tag->setDefault("data[juchuu_meisai_dts][" . $i . "][suuryou1]", number_format($juchuu_meisai_dt->suuryou1, $juchuu_meisai_dt->ShouhinMrs->suu1_shousuu));
                }
                if (property_exists($juchuu_meisai_dt, "suuryou2")) {
                    $this->tag->setDefault("data[juchuu_meisai_dts][" . $i . "][suuryou2]", number_format($juchuu_meisai_dt->suuryou2, $juchuu_meisai_dt->ShouhinMrs->suu2_shousuu));
                }
                if (property_exists($juchuu_meisai_dt, "gentanka")) {
                    $this->tag->setDefault("data[juchuu_meisai_dts][" . $i . "][gentanka]", number_format($juchuu_meisai_dt->gentanka, $juchuu_meisai_dt->ShouhinMrs->tanka_shousuu));
                }
                if (property_exists($juchuu_meisai_dt, "tanka")) {
                    $this->tag->setDefault("data[juchuu_meisai_dts][" . $i . "][tanka]", number_format($juchuu_meisai_dt->tanka, $juchuu_meisai_dt->ShouhinMrs->tanka_shousuu));
                }
                if (property_exists($juchuu_meisai_dt, "kingaku")) {
                    $this->tag->setDefault("data[juchuu_meisai_dts][" . $i . "][kingaku]", number_format($juchuu_meisai_dt->kingaku));
                }
                $this->tag->setDefault("data[juchuu_meisai_dts][" . $i . "][suu_shousuu]", $juchuu_meisai_dt->ShouhinMrs->suu_shousuu);//桁数設定用
                $this->tag->setDefault("data[juchuu_meisai_dts][" . $i . "][suu1_shousuu]", $juchuu_meisai_dt->ShouhinMrs->suu1_shousuu);//桁数設定用
                $this->tag->setDefault("data[juchuu_meisai_dts][" . $i . "][suu2_shousuu]", $juchuu_meisai_dt->ShouhinMrs->suu2_shousuu);//桁数設定用
                $this->tag->setDefault("data[juchuu_meisai_dts][" . $i . "][tanka_shousuu]", $juchuu_meisai_dt->ShouhinMrs->tanka_shousuu);//桁数設定用
                $this->tag->setDefault("data[juchuu_meisai_dts][" . $i . "][zaiko_kbn]", $juchuu_meisai_dt->ShouhinMrs->zaiko_kbn);//桁数設定用
                $this->tag->setDefault("data[juchuu_meisai_dts][" . $i . "][moto_tanni_mr2_cd]", $juchuu_meisai_dt->ShouhinMrs->tanni_mr2_cd);//桁数設定用
                $this->tag->setDefault("data[juchuu_meisai_dts][" . $i . "][kazei_kbn_cd]", $juchuu_meisai_dt->ShouhinMrs->kazei_kbn_cd);//税率計算用
            }
            $tk = $juchuu_meisai_dt->tanka_kbn; // 注残の為の単価区分
            $sho = 'suu' . $tk . '_shousuu'; // 注残の為の数量小数桁数項目名
            @$this->tag->setDefault("data[juchuu_meisai_dts][" . $i . "][juchuuzan]", number_format($juchuu_zan[$juchuu_meisai_dt->shouhin_mr_cd][$juchuu_meisai_dt->iro]['zan_ryou' . $tk], $juchuu_meisai_dt->ShouhinMrs->$sho));
            @$this->tag->setDefault("data[juchuu_meisai_dts][" . $i . "][shukka_kbn_cd]", $juchuu_zan[$juchuu_meisai_dt->shouhin_mr_cd][$juchuu_meisai_dt->iro]['shukka_kbn_cd']);
            $i++;
        }
        $this->view->imax = $i;
    }

    /**
     * Creates a new juchuu_dt
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "juchuu_dts",
                'action' => 'index'
            ));

            return;
        }

        $juchuu_dt = new JuchuuDts();

        $post_flds = [];
        $post_flds = [
            "cd",
            "nendo",
            "tekiyou",
            "juchuubi",
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
            "chokusousaki_kbn_cd",
            "updated",
        ];

        $thisPost = []; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        foreach ($post_flds as $post_fld) {
            $juchuu_dt->$post_fld = array_key_exists($post_fld, $thisPost) ? $thisPost[$post_fld] : $this->request->getPost($post_fld);
        }

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
            "gentanka",
            "tanka",
            "tanka_kbn",
            "kingaku",
            "genkagaku",
            "zeinukigaku",
            "zeigaku",
            "project_mr_cd",
            "zeiritu_mr_cd",
            "bikou",
            "nouki",
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

        $thisPost = [];
        $thisPost["zeiritu_tekiyoubi"] = ($this->request->getPost("zeiritu_tekiyoubi") == "") ? "0000-00-00" : $this->request->getPost("zeiritu_tekiyoubi");
        $thisPost["nounyuu_kijitu"] = ($this->request->getPost("nounyuu_kijitu") == "") ? "0000-00-00" : $this->request->getPost("nounyuu_kijitu");

        foreach ($post_flds as $post_fld) {
            $juchuu_dt->$post_fld = array_key_exists($post_fld, $thisPost) ? $thisPost[$post_fld] : $this->request->getPost($post_fld);
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
        $juchuu_dt->JuchuuMeisaiDts = array();
        $JuchuuMeisaiDts = array();
        $i = 0;

        foreach ($meisai["juchuu_meisai_dts"] as $juchuu_meisai_dt) {
            if ($juchuu_meisai_dt["shouhin_mr_cd"] !== '' && $juchuu_meisai_dt["cd"] !== '' && $juchuu_meisai_dt["cd"] !== '0' && $juchuu_meisai_dt["utiwake_kbn_cd"] !== '') {
//            if ($juchuu_meisai_dt["shouhin_mr_cd"] != '') {
                $meisaicnv[$i] = [];
                foreach ($meisai_nums as $meisai_num) {
                    $meisaicnv[$i][$meisai_num] = str_replace(',', '', $juchuu_meisai_dt[$meisai_num]);//カンマ除去
                }
                $juchuu_meisai_dt["nouki"] = ($juchuu_meisai_dt["nouki"] == "") ? "0000-00-00" : $juchuu_meisai_dt["nouki"];
                if ($zeinuki_chousei_gaku != 0) { // 消費税調整と税抜額調整が必要な場合はする
                    $meisaicnv[$i]["zeinukigaku"] += $zeinuki_chousei_muki;
                    $zeinuki_chousei_gaku -= $zeinuki_chousei_muki;
                }
                if ($zei_chousei_gaku != 0) {
                    $meisaicnv[$i]["zeigaku"] += $zei_chousei_muki;
                    $zei_chousei_gaku -= $zei_chousei_muki;
                }
                $JuchuuMeisaiDts[$i] = new JuchuuMeisaiDts();
                foreach ($meisai_flds as $meisai_fld) {
                    // $JuchuuMeisaiDts[$i]->$meisai_fld = array_key_exists($meisai_fld, $meisaicnv[$i])?$meisaicnv[$i][$meisai_fld]:$juchuu_meisai_dt[$meisai_fld]??'';
                    if (array_key_exists($meisai_fld, $meisaicnv[$i])) { // エラーするので展開2019/8/20井浦
                        $JuchuuMeisaiDts[$i]->$meisai_fld = $meisaicnv[$i][$meisai_fld];
                    } else {
                        if (!is_null($juchuu_meisai_dt[$meisai_fld])) {
                            $JuchuuMeisaiDts[$i]->$meisai_fld = $juchuu_meisai_dt[$meisai_fld];
                        }
                    }
                    //更新日時や更新者はModelに定義してある
                }
                $i++;
            }
        }
        $juchuu_dt->JuchuuMeisaiDts = $JuchuuMeisaiDts;
        /* 伝票番号付番または再設定 */
        $den_ban_ctrl = new DenpyouBangouMrsController(); //伝票番号マスタコントローラ
        $nendo_ban = $den_ban_ctrl->countup('juchuu', 0, $juchuu_dt->juchuubi); // 新規なので$uriage_dt->cd使わない2019/6/11井浦
        if (!$nendo_ban['nendo']) {
            $this->flash->error("エラー:年度が未登録（日付が今年か昨年以外は不可）。" . $juchuu_dt->juchuubi);
            $this->dispatcher->forward(array(
                'controller' => "juchuu_dts",
                'action' => 'edit',
                'params' => array($id)
            ));
        }
        $juchuu_dt->cd = $nendo_ban['bangou'];
        $juchuu_dt->nendo = $nendo_ban['nendo'];

        if (!$juchuu_dt->save()) {
            foreach ($juchuu_dt->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "juchuu_dts",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("受注データの作成が完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "juchuu_dts",
            'action' => 'edit',
            'params' => array($juchuu_dt->id)
        ));
    }

    /**
     * Saves a juchuu_dt edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "juchuu_dts",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $juchuu_dt = JuchuuDts::findFirstByid($id);

        if (!$juchuu_dt) {
            $this->flash->error("受注データが見つからなくなりました。" . $id);

            $this->dispatcher->forward(array(
                'controller' => "juchuu_dts",
                'action' => 'index'
            ));

            return;
        }

        if ($juchuu_dt->updated !== $this->request->getPost("updated")) {
            $this->flash->error("他のプロセスから受注データが変更されたため更新を中止しました。"
                . $id . ",uid=" . $juchuu_dt->kousin_user_id . " tb=" . $juchuu_dt->updated . " pt=" . $this->request->getPost("updated"));

            $this->dispatcher->forward(array(
                'controller' => "juchuu_dts",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $post_flds = [];
        $post_flds = [
            "cd",
            "tekiyou",
            "juchuubi",
            "zeiritu_tekiyoubi",
            "tokuisaki_mr_cd",
            "torihiki_kbn_cd",
            "zei_tenka_kbn_cd",
            "tantou_mr_cd",
            "shimekiri_flg",
            "nounyuu_kijitu",
            "mitumori_dt_id",
            "saki_hacchuu_cd",
            "nounyuusaki_mr_cd",
            "nounyuusaki",
            "kidukesaki_mr_cd",
            "kiduke",
            "chokusousaki_kbn_cd",
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
            "gentanka",
            "tanka",
            "tanka_kbn",
            "kingaku",
            "genkagaku",
            "zeinukigaku",
            "zeigaku",
            "project_mr_cd",
            "zeiritu_mr_cd",
            "bikou",
            "nouki",
            "hacchuurendou_flg",
        ];

        $meisai_nums = [
            "suuryou",
            "keisu",
            "irisuu",
            "suuryou1",
            "suuryou2",
            "tanka_kbn",
            "gentanka",
            "tanka",
            "kingaku",
            "genkagaku",
            "zeinukigaku",
            "zeigaku"
        ]; // 税抜額と税額は調整計算用

        if ($juchuu_dt->updated !== $this->request->getPost("updated")) {
            $this->flash->error("他のプロセスから受注伝票が変更されたため更新を中止しました。"
                . $id . ",uid=" . $juchuu_dt->kousin_user_id . " tb=" . $juchuu_dt->updated . " pt=" . $this->request->getPost("updated"));

            $this->dispatcher->forward(array(
                'controller' => "juchuu_dts",
                'action' => 'index'
            ));

            return;
        }

        $meisai = $this->request->getPost("data");
        $i = 0;
        foreach ($meisai["juchuu_meisai_dts"] as $juchuu_meisai_dt) {
            if ((int)$juchuu_meisai_dt["id"] !== 0) {
                if ((int)$juchuu_dt->JuchuuMeisaiDts[$i]->id !== (int)$juchuu_meisai_dt["id"] ||
                    $juchuu_dt->JuchuuMeisaiDts[$i]->updated !== $juchuu_meisai_dt["updated"]) {
                    $this->flash->error("他のプロセスから受注伝票明細が変更されたため中止しました。"
                        . $id . ",id=" . $juchuu_dt->JuchuuMeisaiDts[$i]->id . ",uid=" . $juchuu_dt->JuchuuMeisaiDts[$i]->kousin_user_id
                        . " tb=" . $juchuu_dt->JuchuuMeisaiDts[$i]->updated . " pt=" . $juchuu_meisai_dt["updated"]);

                    $this->dispatcher->forward(array(
                        'controller' => "juchuu_dts",
                        'action' => 'index'
                    ));

                    return;
                }
            }
            $i++;
        }

        $thisPost = [];
        $thisPost["zeiritu_tekiyoubi"] = ($this->request->getPost("zeiritu_tekiyoubi") == "") ? "0000-00-00" : $this->request->getPost("zeiritu_tekiyoubi");
        $thisPost["nounyuu_kijitu"] = ($this->request->getPost("nounyuu_kijitu") == "") ? "0000-00-00" : $this->request->getPost("nounyuu_kijitu");

        $chg_flg = 0;
        foreach ($post_flds as $post_fld) {
            if ((array_key_exists($post_fld, $thisPost) ? $thisPost[$post_fld] : $this->request->getPost($post_fld)) !== $juchuu_dt->$post_fld) {
//                echo $post_fld.'/'.$this->request->getPost($post_fld).'/'.(array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld)). '!=' . $juchuu_dt->$post_fld;//型不明のため試行錯誤
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
        foreach ($meisai["juchuu_meisai_dts"] as $juchuu_meisai_dt) {
            $meisaicnv[$i] = [];
            foreach ($meisai_nums as $meisai_num) {
                $meisaicnv[$i][$meisai_num] = (double)str_replace(',', '', $juchuu_meisai_dt[$meisai_num]);//カンマ除去
            }
            $juchuu_meisai_dt["nouki"] = ($juchuu_meisai_dt["nouki"] == "") ? "0000-00-00" : $juchuu_meisai_dt["nouki"];
            if ((int)$juchuu_meisai_dt["cd"] !== 0) { // 消費税調整と税抜額調整が必要な場合はする
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
            if ((int)$juchuu_meisai_dt["cd"] === 0 && (int)$juchuu_meisai_dt["id"] !== 0) { // 削除の条件
                $chg_flg = 1;
                $chg_flgs[$i] = 2;//削除
            } else if ((int)$juchuu_meisai_dt["id"] === 0) { // echo ($juchuu_meisai_dt["id"] === "")?"null":"0";//nullの伝わり方
                if ((int)$juchuu_meisai_dt["cd"] !== 0 && (int)$juchuu_meisai_dt["utiwake_kbn_cd"] !== 0) {
                    $chg_flg = 1;
                    $chg_flgs[$i] = 1;
                }
            } else if ((int)$juchuu_meisai_dt["cd"] !== 0) {
                foreach ($meisai_flds as $meisai_fld) {
                    if ((array_key_exists($meisai_fld, $meisaicnv[$i]) ? $meisaicnv[$i][$meisai_fld] : $juchuu_meisai_dt[$meisai_fld]) . '' !== $juchuu_dt->JuchuuMeisaiDts[$i]->$meisai_fld) {
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
                "controller" => "juchuu_dts",
                "action" => "edit",
                "params" => array($juchuu_dt->id)
            ));

            return;
        }
        $this->_bakOut($juchuu_dt, 0, $chg_flgs);

        foreach ($post_flds as $post_fld) {
            $juchuu_dt->$post_fld = array_key_exists($post_fld, $thisPost) ? $thisPost[$post_fld] : $this->request->getPost($post_fld);
        }
        /* 伝票番号付番または再設定 */
        $den_ban_ctrl = new DenpyouBangouMrsController(); //伝票番号マスタコントローラ
        $nendo_ban = $den_ban_ctrl->countup('juchuu', $juchuu_dt->cd, $juchuu_dt->juchuubi, $juchuu_dt->nendo);
        if (!$nendo_ban['nendo']) {
            $this->flash->error("エラー:年度が未登録（日付が今年か昨年以外は不可）。" . $juchuu_dt->juchuubi);
            $this->dispatcher->forward(array(
                'controller' => "juchuu_dts",
                'action' => 'edit',
                'params' => array($id)
            ));
        }
        $juchuu_dt->cd = $nendo_ban['bangou'];
        $juchuu_dt->nendo = $nendo_ban['nendo'];
        $i = 0;
        foreach ($meisai["juchuu_meisai_dts"] as $juchuu_meisai_dt) {
            if ($chg_flgs[$i] === 2) { // 削除でないとき
                $meisai_ctlr = new JuchuuMeisaiDtsController();
                $meisai_ctlr->deleteAction($juchuu_meisai_dt["id"]);
            } else {
                if ((int)$juchuu_meisai_dt["id"] !== 0) {
                    $JuchuuMeisaiDts[$i] = $juchuu_dt->JuchuuMeisaiDts[$i];
                }
                if ($chg_flgs[$i] === 1) { // 更新なら
                    if ((int)$juchuu_meisai_dt["id"] === 0) {
                        $JuchuuMeisaiDts[$i] = new JuchuuMeisaiDts();
                    }

                    foreach ($meisai_flds as $meisai_fld) {
                        if (array_key_exists($meisai_fld, $meisaicnv[$i])) { // エラーするので展開2019/8/20井浦
                            $JuchuuMeisaiDts[$i]->$meisai_fld = $meisaicnv[$i][$meisai_fld];
                        } else {
                            if (!is_null($juchuu_meisai_dt[$meisai_fld])) {
                                $JuchuuMeisaiDts[$i]->$meisai_fld = $juchuu_meisai_dt[$meisai_fld];
                            }
                        }
                        //更新日時や更新者はModelに定義してある
                    }
                }
            }
            $i++;
        }
        $juchuu_dt->JuchuuMeisaiDts = $JuchuuMeisaiDts; // 明細データをドッキング
        if (!$juchuu_dt->save()) {

            foreach ($juchuu_dt->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "juchuu_dts",
                'action' => 'edit',
                'params' => array($id)
            ));
            return;
        }

        $this->flash->success("受注伝票の情報を更新しました。");
        $this->dispatcher->forward(array(
            'controller' => "juchuu_dts",
            'action' => 'edit',
            'params' => array($juchuu_dt->id)
        ));
    }

    /**
     * Deletes a juchuu_dt
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $juchuu_dt = JuchuuDts::findFirstByid($id);
        if (!$juchuu_dt) {
            $this->flash->error("受注データが見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "juchuu_dts",
                'action' => 'index'
            ));

            return;
        }

        foreach ($juchuu_dt->JuchuuMeisaiDts as $juchuu_meisai_dt) { // 2019/5/9 追加 井浦
            $meisai_ctlr = new JuchuuMeisaiDtsController();
            $meisai_ctlr->deleteAction($juchuu_meisai_dt->id);
        }

        $this->_bakOut($juchuu_dt, 1);

        if (!$juchuu_dt->delete()) {

            foreach ($juchuu_dt->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "juchuu_dts",
                'action' => 'search'
            ));

            return;
        }

        $this->flash->success("受注データの削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "juchuu_dts",
            'action' => "index"
        ));
    }

    /**
     * Back Out a juchuu_dt
     *
     * @param string $juchuu_dt , $dlt_flg
     */
    public function _bakOut($juchuu_dt, $dlt_flg = 0, $chg_flgs = array())
    {

        $bak_juchuu_dt = new BakJuchuuDts();
        foreach ($juchuu_dt as $fld => $value) {
            $bak_juchuu_dt->$fld = $value;
        }
        $bak_juchuu_dt->id = NULL;
        $bak_juchuu_dt->id_moto = $juchuu_dt->id;
        $bak_juchuu_dt->hikae_dltflg = $dlt_flg;
        $bak_juchuu_dt->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_juchuu_dt->hikae_nichiji = date("Y-m-d H:i:s");

        if (!$bak_juchuu_dt->save()) {
            foreach ($bak_juchuu_dt->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
        $meisai_ctlr = new JuchuuMeisaiDtsController();
        $i = 0;
        foreach ($juchuu_dt->JuchuuMeisaiDts as $juchuu_meisai_dt) {
            if ($dlt_flg === 1 || $chg_flgs[$i] === 1) { // 更新なしは不要、削除は別に出ている、親から削除のときはここで出す
                $meisai_ctlr->_bakOut($juchuu_meisai_dt, $dlt_flg);
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
        $juchuu_dt = JuchuuDts::findFirstByid($id);
        if (!$juchuu_dt) {
            $this->flash->error("受注伝票が見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "juchuu_dts",
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
        $temp_path = $temp_dir . "juchuuden.xls";
        $PHPExcel = $objReader->load($temp_path);

        //配列に設定
        //	項目名,項目ID,数0文字1日付2,参照テーブルID,参照テーブルID,…
        $flds = [
            ['id', 'id', 0,],
            ['伝票番号', 'cd', 0,],
            ['摘要', 'tekiyou', 1,],
            ['受注日', 'juchuubi', 2,],
            ['税率適用日', 'zeiritu_tekiyoubi', 2,],
            ['得意先', 'tokuisaki_mr_cd', 1,],
            ['取引区分', 'torihiki_kbn_cd', 0,],
            ['税転嫁', 'zei_tenka_kbn_cd', 0,],
            ['担当者', 'tantou_mr_cd', 1,],
            ['納入期日', 'nounyuu_kijitu', 2,],
            ['見積id', 'mitumori_dt_id', 0,],
            ['得意先発注CD', 'saki_hacchuu_cd', 1,],
            ['納入先', 'nounyuusaki_mr_cd', 1,],
            ['納入先名', 'nounyuusaki', 1,],
            ['気付先', 'kidukesaki_mr_cd', 1,],
            ['気付', 'kiduke', 1,],
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
            ['納入先枚', 'name', 1, 'NounyuusakiMrs',],
            ['作成者', 'name', 1, 'SakuseiUsers',],
        ];
        $meisai_flds = [
            ['id', 'id', 0,],
            ['行番', 'cd', 0,],
            ['内訳', 'utiwake_kbn_cd', 1,],
            ['構造', 'kousei', 1,],
            ['商品コード', 'shouhin_mr_cd', 1,],
            ['ロット', 'lot', 1,],
            ['商品名/摘要', 'tekiyou', 1,],
            ['色', 'iro', 1,],
            ['色名', 'iromei', 1,],
            ['個別コード', 'kobetucd', 1,],
            ['品質コード', 'hinsitu_kbn_cd', 1,],
            ['倉庫', 'souko_mr_cd', 1,],
            ['サイズ', 'size', 1,],
            ['規格型番', 'kikaku', 1,],
            ['元数量', 'suuryou', 0,],
            ['係数', 'keisu', 0,],
            ['入数', 'irisuu', 0,],
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
            ['納期', 'nouki', 1,],
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
        $PHPExcel->setActiveSheetIndex(1);  //1はDATA(DATAのシート)
        $sheet = $PHPExcel->getActiveSheet();
        $gyou = 1;
        $retu = 0;
        foreach ($flds as $fld) {
            $sheet->setCellValueByColumnAndRow($retu, $gyou, $fld[0]);
            $tbl = $juchuu_dt;
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
        foreach ($juchuu_dt->JuchuuMeisaiDts as $juchuu_meisai_dt) {
            if ($juchuu_meisai_dt->utiwake_kbn_cd == 30) {
                $sekisangaku += $juchuu_meisai_dt->kingaku;
            } else {
                $goukeigaku += $juchuu_meisai_dt->kingaku;
                $genkagoukei += $juchuu_meisai_dt->genkagaku;
                $zeinukigaku += $juchuu_meisai_dt->zeinukigaku;
                $zeigaku += $juchuu_meisai_dt->zeigaku;
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
        foreach ($juchuu_dt->JuchuuMeisaiDts as $juchuu_meisai_dt) {
            $gyou++;
            $retu = 0;
            foreach ($meisai_flds as $fld) {
                $tbl = $juchuu_meisai_dt;
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
        $filename = uniqid("juchuu_" . $juchuu_dt->cd . "_", true) . '.xls';

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

        $juchuu_dts = JuchuuDts::find(array(
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
            "juchuubi",
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
            "chokusousaki_kbn_cd",
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
            "iro",
            "iromei",
            "kobetucd",
            "souko_mr_cd",
            "hinsitu_kbn_cd",
            "souko_mr_cd",
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
            "nouki",
        ];
        $resData = array();
        foreach ($juchuu_dts as $juchuu_dt) {
            $resAdata = array();
            foreach ($res_flds as $res_fld) {
                $resAdata[$res_fld] = $juchuu_dt->$res_fld;
            }
            $resAdata["tokuisaki_mr_name"] = $juchuu_dt->TokuisakiMrs->name;
            $resAdata["shiiresaki_mr_cd"] = $juchuu_dt->TokuisakiMrs->ShiiresakiMrs[0]->cd;
            foreach ($juchuu_dt->JuchuuMeisaiDts as $juchuu_meisai_dt) {
                foreach ($meisai_flds as $meisai_fld) {
                    $resAdata["meisai"][$juchuu_meisai_dt->cd][$meisai_fld] = $juchuu_meisai_dt->$meisai_fld;
                }
                $resAdata["meisai"][$juchuu_meisai_dt->cd]['moto_tanni_mr2_cd'] = $juchuu_meisai_dt->ShouhinMrs->tanni_mr2_cd;
                $resAdata["meisai"][$juchuu_meisai_dt->cd]['suu_shousuu'] = $juchuu_meisai_dt->ShouhinMrs->suu_shousuu;
                $resAdata["meisai"][$juchuu_meisai_dt->cd]['suu1_shousuu'] = $juchuu_meisai_dt->ShouhinMrs->suu1_shousuu;
                $resAdata["meisai"][$juchuu_meisai_dt->cd]['suu2_shousuu'] = $juchuu_meisai_dt->ShouhinMrs->suu2_shousuu;
                $resAdata["meisai"][$juchuu_meisai_dt->cd]['tanka_shousuu'] = $juchuu_meisai_dt->ShouhinMrs->tanka_shousuu;
                $resAdata["meisai"][$juchuu_meisai_dt->cd]['zaiko_kbn'] = $juchuu_meisai_dt->ShouhinMrs->zaiko_kbn;
                $resAdata["meisai"][$juchuu_meisai_dt->cd]['souko_mr_name'] = $juchuu_meisai_dt->SoukoMrs->name;
                $resAdata["meisai"][$juchuu_meisai_dt->cd]['zaikokanri'] = $juchuu_meisai_dt->ShouhinMrs->zaikokanri;
                $resAdata["meisai"][$juchuu_meisai_dt->cd]['kazei_kbn_cd'] = $juchuu_meisai_dt->ShouhinMrs->kazei_kbn_cd;
                $resAdata["meisai"][$juchuu_meisai_dt->cd]['soukko_mr_cd'] = $juchuu_meisai_dt->SoukoMrs->cd;

            }
            $resData[] = $resAdata;
        }
        $response->setContent(json_encode($resData));
        return $response;
    }

    /*
     * 受注一覧データ
    */
    public function summaryAction()
    {
        $db = \Phalcon\DI::getDefault()->get('db');
        if ($this->request->isPost()) {
            $param = $this->request->getPost();
            $having = "";
            switch ($param['kanryou_flg']) {
                case '':    //受注未完了
                case '0':
                    $having = " HAVING shukka_kbn <> '完' ";
                    break;
                case '3':    //受注完了
                    $having = " HAVING shukka_kbn = '完' ";
                    break;
                case '4':   //全受注
                    $having = '';
                    break;
            }
            $where_sub = " WHERE jms.utiwake_kbn_cd NOT IN ('40','41','12','13','22','30') "; //sub_query
            //受注ナンバー
            if (isset($param['query_juchu_no']) && $param['query_juchu_no'] != '') {
                $where_sub .= "AND (jds.cd = " . $param['query_juchu_no'] . ") ";
            }
            //期間(Between)
            if ($param['kikan_from'] != '') {
                if ($param['kikan_to'] == '') {
                    $param['kikan_to'] = '9999-12-31';
                }
                $where_sub .= "AND (jds.juchuubi BETWEEN '" . $param['kikan_from'] . "' AND '" . $param['kikan_to'] . "') ";
            } else {
                if ($param['kikan_to'] != '') {
                    $param['kikan_from'] = '2015-01-01';
                }
                $where_sub .= "AND (jds.juchuubi BETWEEN '" . $param['kikan_from'] . "' AND '" . $param['kikan_to'] . "') ";
            }
            if ($where_sub === " WHERE jms.utiwake_kbn_cd NOT IN ('40','41') ") {
                $firstDay = date("Y-m-01");
                $lastDay = date("Y-m-t");
                $where_sub .= "AND (jds.juchuubi BETWEEN '" . $firstDay . "' AND '" . $lastDay . "') ";
            }

            switch ($param['zero_flg']) {
                case '0':   //0円のみ
                    $where_sub .= "AND (jms.tanka = 0) ";
                    break;
                case '1':   //全て
                    break;
            }

            $where = "";
            //担当コード(=)
            if ($param['tantou_cd'] != '') {
                if ($where === '') {
                    $where = "WHERE (j_tbl.tantou_mr_cd = '" . $param['tantou_cd'] . "') ";
                } else {
                    $where .= "AND (j_tbl.tantou_mr_cd = '" . $param['tantou_cd'] . "') ";
                }
            }
            //商品コード(like)
            if ($param['shouhin_cd'] != '') {
                if ($where === '') {
                    $where = "WHERE (j_tbl.j_tbl_shouhin_mr_cd LIKE '" . $param['shouhin_cd'] . "%') ";
                } else {
                    $where .= "AND (j_tbl.j_tbl_shouhin_mr_cd LIKE '" . $param['shouhin_cd'] . "%') ";
                }

            }
            //得意先コード
            if ($param['tokuisaki_cd'] != '') {
                if ($where === '') {
                    $where = "WHERE (j_tbl_tokuisaki LIKE '" . $param['tokuisaki_cd'] . "%') ";
                } else {
                    $where .= "AND (j_tbl_tokuisaki LIKE '" . $param['tokuisaki_cd'] . "%') ";
                }

            }
            //得意先発注№
            if ($param['saki_hacchuu_no'] != '') {
                if ($where === '') {
                    $where = "WHERE (j_tbl_saki_hacchuu_cd LIKE '" . $param['saki_hacchuu_no'] . "%') ";
                } else {
                    $where .= "AND (j_tbl_saki_hacchuu_cd LIKE '%" . $param['saki_hacchuu_no'] . "%') ";
                }

            }
            //商品名(like)
            if ($param['tekiyou'] != '') {
                if ($where === '') {
                    $where = "WHERE (j_tbl.j_tbl_tekiyou LIKE '%" . $param['tekiyou'] . "%') ";
                } else {
                    $where .= " AND (j_tbl.j_tbl_tekiyou LIKE '%" . $param['tekiyou'] . "%') ";
                }
            }
            //色番(like)
            if ($param['iroban'] != '') {
                if ($where === '') {
                    $where = "WHERE (j_tbl.j_tbl_iro LIKE '%" . $param['iroban'] . "%') ";
                } else {
                    $where .= "AND (j_tbl.j_tbl_iro LIKE '%" . $param['iroban'] . "%') ";
                }
            }
            //納期(Between)
            if ($param['nouki'] != '') {
                if ($where === '') {
                    $where = "WHERE (j_tbl.j_tbl_nouki BETWEEN '" . $param['nouki'] . "' AND '9999-12-31') ";
                } else {
                    $where .= "AND (j_tbl.j_tbl_nouki BETWEEN '" . $param['nouki'] . "' AND '9999-12-31') ";
                }
            }
            //得意先名称(like)
            if ($param['tokuisaki_name'] != '') {
                if ($where === '') {
                    $where = "WHERE (i.name LIKE '%" . $param['tokuisaki_name'] . "%') ";
                } else {
                    $where .= "AND (i.name LIKE '%" . $param['tokuisaki_name'] . "%') ";
                }
            }
            if ($param['nounyuu_saki'] != '') {
                if ($where === '') {
                    $where = "WHERE (j_tbl.nounyuusaki LIKE '%" . $param['nounyuu_saki'] . "%') ";
                } else {
                    $where .= "AND (j_tbl.nounyuusaki LIKE '%" . $param['nounyuu_saki'] . "%') ";
                }
            }
            //担当名称(like)
            if ($param['tantou_name'] != '') {
                $where .= "AND (l.name LIKE '%" . $param['tantou_name'] . "%') ";
            }

            $phql = "
                SELECT 
                    IF(MAX(shukka_kbn) = '4','完','') AS shukka_kbn, 
                    j_tbl.juchuu_suu1 - u_tbl_suuryou1 AS zan1, 
                    j_tbl.juchuu_suu2 - u_tbl_suuryou2 AS zan2,
                    j_tbl.j_tbl_id AS juchuu_id, 
                    j_tbl.j_tbl_cd AS juchuu_no, 
                    j_tbl.j_tbl_saki_hacchuu_cd AS saki_hacchuu_no,
                    j_tbl.tantou_mr_cd AS tantou_cd,
                    l.name AS tantou_name,
                    j_tbl.nounyuusaki AS nounyuusaki,
                    j_tbl.kiduke AS kiduke,
                    j_tbl.j_tbl_juchuubi AS juchuubi, 
                    j_tbl.j_tbl_nouki AS nouki, 
                    j_tbl_tokuisaki AS tokuisaki_cd,
                    i.name AS tokuisaki_name,
                    j_tbl.j_tbl_shouhin_mr_cd AS shouhin_mr_cd, 
                    j_tbl.j_tbl_tekiyou AS tekiyou1, 
                    j_tbl.j_tbl_iro AS iroban, 
                    j_tbl.juchuu_suu1 AS juchuusuu, 
                    d.name AS tanni1,
                    j_tbl.juchuu_suu2 AS juchuuryou,
                    e.name AS tanni2,
                    j_tbl.j_tbl_tanka AS tanka,
                    j_tbl.j_tbl_hacchuu_tanka AS hacchuu_tanka,
                    u_tbl.u_tbl_id AS uriage_id,
                    u_tbl.u_tbl_cd AS uriage_no
                FROM (
                    SELECT
                        jds.id AS j_tbl_id,
                        jds.cd AS j_tbl_cd,
                        jds.saki_hacchuu_cd AS j_tbl_saki_hacchuu_cd,
                        jds.juchuubi AS j_tbl_juchuubi,
                        jds.nounyuu_kijitu AS j_tbl_nouki,
                        jds.tantou_mr_cd AS tantou_mr_cd,
                        jds.nounyuusaki AS nounyuusaki,
                        jds.kiduke AS kiduke,
                        jds.tokuisaki_mr_cd AS j_tbl_tokuisaki,
                        jms.shouhin_mr_cd AS j_tbl_shouhin_mr_cd,
                        jms.tekiyou AS j_tbl_tekiyou,
                        jms.iro AS j_tbl_iro,
                        jms.souko_mr_cd AS j_tbl_souko,
                        jms.tanni_mr1_cd AS j_tbl_tan1,
                        jms.tanni_mr2_cd AS j_tbl_tan2,
                        jms.gentanka AS j_tbl_hacchuu_tanka,
                        jms.tanka AS j_tbl_tanka,
                        SUM(jms.suuryou1) AS juchuu_suu1,
                        SUM(jms.suuryou2) AS juchuu_suu2
                    FROM juchuu_dts AS jds
                    LEFT JOIN juchuu_meisai_dts AS jms ON jms.juchuu_dt_id = jds.id
                    " . $where_sub . "
                    GROUP BY jds.id, jds.cd, jms.shouhin_mr_cd, jms.iro
                ) AS j_tbl
                LEFT JOIN (
                        SELECT 
                        MAX(b.id) AS u_tbl_id,
                        MAX(b.cd) AS u_tbl_cd,
                        b.juchuu_dt_id AS u_tbl_juchuu_dt_id,
                        MAX(c.shukka_kbn_cd) AS shukka_kbn,
                        c.shouhin_mr_cd AS u_tbl_shouhin_mr_cd,
                        c.iro AS u_tbl_iro,
                        SUM(c.suuryou1) AS u_tbl_suuryou1,
                        SUM(c.suuryou2) AS u_tbl_suuryou2
                        FROM uriage_dts AS b
                        LEFT JOIN uriage_meisai_dts AS c ON c.uriage_dt_id = b.id
                        GROUP BY b.juchuu_dt_id,c.shouhin_mr_cd,c.iro
                ) AS u_tbl ON j_tbl.j_tbl_id = u_tbl.u_tbl_juchuu_dt_id AND j_tbl.j_tbl_shouhin_mr_cd = u_tbl.u_tbl_shouhin_mr_cd AND j_tbl.j_tbl_iro = u_tbl.u_tbl_iro
                LEFT JOIN tanni_mrs AS d ON d.cd = j_tbl.j_tbl_tan1
                LEFT JOIN tanni_mrs AS e ON e.cd = j_tbl.j_tbl_tan2
				LEFT JOIN souko_mrs AS f ON f.cd = j_tbl.j_tbl_souko
				LEFT JOIN tokuisaki_mrs AS i ON i.cd = j_tbl.j_tbl_tokuisaki
				LEFT JOIN tantou_mrs AS l ON l.cd = j_tbl.tantou_mr_cd
				" . $where . "
                GROUP BY j_tbl.j_tbl_id,j_tbl.j_tbl_cd, j_tbl.j_tbl_shouhin_mr_cd, 
                         j_tbl.j_tbl_iro, j_tbl.juchuu_suu1, j_tbl.juchuu_suu2
                " . $having . "
                ORDER BY j_tbl.j_tbl_id DESC
            ";

            $stmt = $db->prepare($phql);
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $this->view->rows = $rows;
        } else {
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
            echo "Error: Not Ajax ";
        }

        $uriage_dt_id = $this->request->getPost('uriage_dt_id');
        $shouhin_mr_cd = $this->request->getPost('shouhin_mr_cd');
        $iro = "";
        $shukka_kbn = $this->request->getPost('shukka_kbn');
        if ($this->request->getPost('iro') !== '') {
            $iro = $this->request->getPost('iro');
        }
        if ($iro === "") {
            $uriage_meisai = UriageMeisaiDts::findFirst("uriage_dt_id = {$uriage_dt_id} AND shouhin_mr_cd = '{$shouhin_mr_cd}'");
        } else {
            $uriage_meisai = UriageMeisaiDts::findFirst("uriage_dt_id = {$uriage_dt_id} AND shouhin_mr_cd = '{$shouhin_mr_cd}' AND iro = '{$iro}'");
        }
        $uriage_meisai = $uriage_meisai->toArray();
        $db = \Phalcon\DI::getDefault()->get('db');
        if ($shukka_kbn === 'NULL') {
            $shukka_kbn = "''";
        }
        $phql = "UPDATE uriage_meisai_dts SET shukka_kbn_cd = {$shukka_kbn} WHERE id = {$uriage_meisai['id']}";
        $stmt = $db->prepare($phql);
        $stmt->execute();
        $response->setContent(json_encode($uriage_meisai['id']));
        return $response;
    }
}
