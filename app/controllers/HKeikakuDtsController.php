<?php

class HKeikakuDtsController extends ControllerBase
{
    private $g1 = []; // jsとデータ交換
    private $mugen_sosi = []; // 無限ループ阻止の配列、同じ行は再計算しない。

    /**
     * Index action
     */
    public function editAction($id = null)
    {
        $denpyou_mr = DenpyouMrs::findFirst(['conditions' => 'cd = "h_keikaku"']); // 伝票IDが重要
        $this->view->denpyou_mr = $denpyou_mr;
        $user_id = (int)$this->session->get('auth')['id']; // 各ユーザの設定を呼ぶため
        $this->view->readonlys = ReadonlyFieldKbns::getForm('HKeikakuDts', 'index', $user_id); // 読込専用項目
        $this->view->rewidths = RewidthFieldMrs::getForm('HKeikakuDts', 'index', $user_id); // 明細の各列幅
        $this->tag->setDefault("id", $id);
    }

    /**
     * モーダルでテーブルを触らず親画面のデータだけを変更する。
     */
    public function modal1Action()
    {
    }

    /**
     * 新規F2
     */
    public function newAction()
    {
        $this->response->redirect('h_keikaku_dts/edit');
    }


    /**
     * モーダル
     */
    public function modalAction()
    {
        if ($this->request->isGet()) {
            //リクエストがgetのときの処理
            $shouhin_mr_cd = $this->request->getQuery("shouhin_mr_cd");
            echo("<br><br>isGet:" . $shouhin_mr_cd);
        } else if ($this->request->isPost()) {
            //リクエストがpostのときの処理
            $shouhin_mr_cd = $this->request->getPost("shouhin_mr_cd");
            echo("<br><br>isPost:" . $shouhin_mr_cd);
        } else {
            $this->dispatcher->forward([
                'controller' => "g_keikaku_dts",
                'action' => 'index'
            ]);

            return;
        }
        $denpyou_mr = DenpyouMrs::findFirst(['conditions' => 'cd = "h_keikaku"']); // 伝票IDが重要
        $denpyou_mr_id = $denpyou_mr->id;

        $di = \Phalcon\DI::getDefault();
        $mgr = $di->get('modelsManager');
        $phql = "
            SELECT
                b.cd cd
              , b.tekiyou tekiyou
              , b.hakkoubi
              , a.kaisi_hiduke
              , a.shuuryou_hiduke
              , b.tantou_mr_cd
              , a.shouhin_mr_cd
              , a.tekiyou shouhin_name
              , a.lot
              , a.bikou
              , a.keikaku_ryou1
              , d1.name tanni_name1
              , a.keikaku_ryou2
              , d2.name tanni_name2
            FROM GyoumuMeisaiDts a
            LEFT JOIN GyoumuDts b ON b.id = a.gyoumu_dt_id
            LEFT JOIN TanniMrs d1 ON d1.cd = a.tanni_mr1_cd
            LEFT JOIN TanniMrs d2 ON d2.cd = a.tanni_mr2_cd
            WHERE a.shouhin_mr_cd = :shouhin_mr_cd:
              AND b.denpyou_mr_id = :denpyou_mr_id:
            ORDER BY a.kaisi_hiduke DESC, b.cd DESC, a.cd
        ";
        $rows = $mgr->executeQuery($phql, [
            "shouhin_mr_cd" => $shouhin_mr_cd,
            "denpyou_mr_id" => $denpyou_mr_id,
        ]);
        $this->view->rows = $rows;
        return;
    }

    /**
     * Searches for h_keikaku_dts
     */
    public function searchAction()
    {
    }

    /**
     * 登録画面から呼び出される
     * データー表示用
     * 2018/8/7 井浦
     */
    public function ajaxAnyDoAction()
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

        $todo = $this->request->getPost('todo');
        $this->g1 = $this->request->getPost('g1');
        $on_row = (int)$this->g1['on_row'];
        $this->g1['loopcnt'] = 0;

        $this->g1['point_1'] = [];
        switch ($todo) {
            case 'HEAD_CHECK':
                $this->HeadCheck();
                break;
            case 'HEAD_BACK':
                $this->HeadBack();
                break;
            case 'BODY_CHECK':
                $this->BodyCheck();
                break;
            case 'TAIL_NEXT':
                $this->TailNext();
                break;
            case 'TAIL_BACK':
                $this->TailBack();
                break;
            case 'TAIL_CHECK':
                $this->TailCheck();
                break;
            case 'id':
                $this->Sub_id();
                break;
            case '[shouhin_mr_cd]':
                $this->Sub_shouhin_mr_cd($on_row);
                break;
            case '[h_kishu_mr_cd]':
                $this->Sub_h_kishu_mr_cd($on_row);
                break;
            case '[oya_meisai_cd]':
                $this->Sub_oya_meisai_cd($on_row);
                break;
            case '[keisu]':
                $this->Sub_keisu($on_row);
                break;
            case '[moto_juch_ryou]':
                $this->Sub_moto_juch_ryou($on_row);
                break;
            case '[zaikoseisan_ryou]':
                $this->Sub_zaikoseisan_ryou($on_row);
                break;
            case '[zaikosiyou_ryou]':
                $this->Sub_zaikosiyou_ryou($on_row);
                break;
            case '[loss_ryou]':
                $this->Sub_loss_ryou($on_row);
                break;
            case '[deme_ryou]':
                $this->Sub_deme_ryou($on_row);
                break;
            case '[kouritu]':
                $this->Sub_kouritu($on_row);
                break;
            case '[heiretu_suu]':
                $this->Sub_heiretu_suu($on_row);
                break;
            case '[kaisi_hiduke]':
                $this->Sub_kaisi_hiduke($on_row);
                break;
            case '[shuuryou_hiduke]':
                $this->Sub_shuuryou_hiduke($on_row);
                break;
            case 'TAN_TENKAI':
                $this->Sub_tenkai($on_row, 1);
                break;
            case 'ZEN_TENKAI':
                $this->Sub_tenkai($on_row, 0);
                break;
        }
        $response->setContent(json_encode($this->g1)); // json変換 g1
        return $response;  // javascriptへ戻り値 g1
    }

    // *****************************************************************
    private function Sub_id()
    { // idで読込 …Id-Read
        $this->g1['point_1'][] = "id-Read";
        // *----------------------------------------------------------------
        $dt = GyoumuDts::findFirstByid($this->g1['id']);
        if (!$dt) {
            $this->g1['emsg'] = "計画データがありません。" . $this->g1['id'];
            $this->g1['errflg'] = 1;
            return;
        }
        $this->TblRead($dt);
    }

    // *****************************************************************
    private function HeadCheck()
    { // ヘッドチェック …HeadCheck
        $this->g1['point_1'][] = "H-CHECK";
        // *----------------------------------------------------------------
        $dt = GyoumuDts::findFirst([
            'conditions' => 'denpyou_mr_id=?0 AND cd=?1',
            'order' => 'id DESC',
            'bind' => [0 => $this->g1['denpyou_mr_id'], 1 => $this->g1['cd'],],
        ]);
        if (!$dt) {
            $this->g1['emsg'] = "計画番号がありません。" . $this->g1['cd'];
            $this->g1['errflg'] = 1;
            return;
        }
        $this->TblRead($dt);
        $this->g1['emsg'] = "修正入力しますか？";
    }

    // *****************************************************************
    private function TblRead($dt)
    { // テーブル読込
        $this->g1['point_1'][] = "T-READ";
        // *----------------------------------------------------------------
        $main_flds = [
            "id",
            "cd",
            "nendo",
            "tekiyou",
            "hakkoubi",
            "hacchuu_dt_id",    //発注と紐づける為、取得
            "shiiresaki_mr_cd", // 発注と紐づける
            "tantou_mr_cd",
            "nounyuu_kijitu",
            "created",
            "updated",
        ];

        $meisai_flds = [
            "id",
            "cd",
//			"utiwake_kbn_cd",
            "kousei",
            "kaisou",
            "gouki",
            "oya_meisai_cd",
            "shouhin_mr_cd",
            "tanni_mr2_cd",
            "tanni_mr1_cd",
            "tekiyou",
            "lot",
            "iro",
            "iromei",
            "kobetucd",
            "hinsitu_kbn_cd",
            "h_kishu_mr_cd",
            "tantou_mr_cd",
            "suuryou",
            "keisu",
            "irisuu",
            "zaiko_kbn",
            "kagi",
            "kouritu",
            "kouritu_tanni",
            "heiretu_suu",
            "kadou_nissuu",
            "kaisi_hiduke",
            "shuuryou_hiduke",
            "shouhin_kakou_cd",
            "bikou",
            "updated",
        ];
        foreach ($main_flds as $fld) {
            $this->g1[$fld] = $dt->$fld;
        }
        $this->g1['sakusei_user_name'] = $dt->SakuseiUsers->name;
        $this->g1['kousin_user_name'] = $dt->KousinUsers->name;
        $this->g1['hacchuu_dt_id'] = $dt->hacchuu_dt_id;    // 発注と紐づける
        $this->g1['dummy_hacchuu_no'] = $dt->HacchuuDts->cd;    //発注と紐づける 表示用発注ナンバー
        $this->g1['shiiresaki_mr_cd'] = $dt->HacchuuDts->shiiresaki_mr_cd;    //発注と紐づける 発注先コード

        foreach ($dt->GyoumuMeisaiDts as $i => $meisai_dt) {
            foreach ($meisai_flds as $fld) {
                $this->g1['h_keikaku_meisai_dts'][$i][$fld] = $meisai_dt->$fld;
            }
            $this->g1['h_keikaku_meisai_dts'][$i]['hituyou_ryou'] = round($this->g1['h_keikaku_meisai_dts'][$i]['suuryou'] * $this->g1['h_keikaku_meisai_dts'][$i]['keisu'], 4);
            $this->g1['h_keikaku_meisai_dts'][$i]['suu1_shousuu'] = $meisai_dt->ShouhinMrs->suu1_shousuu;
            $this->g1['h_keikaku_meisai_dts'][$i]['suu2_shousuu'] = $meisai_dt->ShouhinMrs->suu2_shousuu;
            $z = $meisai_dt->ShouhinMrs->zaiko_kbn;
            $this->g1['h_keikaku_meisai_dts'][$i]['suu_shousuu'] = $this->g1['h_keikaku_meisai_dts'][$i]['suu' . $z . '_shousuu'];
            $tanniMrs = 'TanniMr' . $z . 's';
            $this->g1['h_keikaku_meisai_dts'][$i]['zaiko_tanni'] = $meisai_dt->$tanniMrs->name;
            $moto_juch_ryou = 'moto_juch_ryou' . $z;
            $this->g1['h_keikaku_meisai_dts'][$i]['moto_juch_ryou'] = $meisai_dt->$moto_juch_ryou;
            $zaikoseisan_ryou = 'zaikoseisan_ryou' . $z;
            if ($meisai_dt->$zaikoseisan_ryou > 0) {
                $this->g1['h_keikaku_meisai_dts'][$i]['zaikoseisan_ryou'] = $meisai_dt->$zaikoseisan_ryou;
                $this->g1['h_keikaku_meisai_dts'][$i]['zaikosiyou_ryou'] = 0;
            } else {
                $this->g1['h_keikaku_meisai_dts'][$i]['zaikoseisan_ryou'] = 0;
                $this->g1['h_keikaku_meisai_dts'][$i]['zaikosiyou_ryou'] = 0 - $meisai_dt->$zaikoseisan_ryou;
            }
            $loss_ryou = 'loss_ryou' . $z;
            if ($meisai_dt->$loss_ryou > 0) {
                $this->g1['h_keikaku_meisai_dts'][$i]['loss_ryou'] = $meisai_dt->$loss_ryou;
                $this->g1['h_keikaku_meisai_dts'][$i]['deme_ryou'] = 0;
            } else {
                $this->g1['h_keikaku_meisai_dts'][$i]['loss_ryou'] = 0;
                $this->g1['h_keikaku_meisai_dts'][$i]['deme_ryou'] = 0 - $meisai_dt->$loss_ryou;
            }
            $keikaku_ryou = 'keikaku_ryou' . $z;
            $this->g1['h_keikaku_meisai_dts'][$i]['keikaku_ryou'] = $meisai_dt->$keikaku_ryou;
            if ($meisai_dt->HKishuMrs) {
                $this->g1['h_keikaku_meisai_dts'][$i]['h_kishu_mr_name'] = $meisai_dt->HKishuMrs->name;
                $this->g1['h_keikaku_meisai_dts'][$i]['h_kishu_mr_irowake'] = $meisai_dt->HKishuMrs->irowake;
                $this->g1['h_keikaku_meisai_dts'][$i]['h_calendar_patan_dt_cd'] = $meisai_dt->HKishuMrs->h_calendar_patan_dt_cd;
            }
        }
    }

    // *****************************************************************
    private function BodyCheck()
    { // ボディチェック …BodyCheck
        $this->g1['point_1'][] = "B-CHECK";
        // *----------------------------------------------------------------
        if ($this->g1['created']) {
            $d0 = new DateTime($this->g1['created']);
        } else {
            $d0 = new DateTime();
        }
        //発行日チェック
        if (!strptime($this->g1['hakkoubi'], '%Y-%m-%d')) {
            $this->g1['errflg'] = 1;
            $this->g1['emsg'] = "発行日を正しくしてください。" . $this->g1['hakkoubi'];
            $this->g1['errfld'] = 'Hakkoubi';
            return;
        }
        $aryA = explode('-', $this->g1['hakkoubi']);
        if (!checkdate($aryA[1], $aryA[2], $aryA[0])) {
            $this->g1['errflg'] = 1;
            $this->g1['emsg'] = "発行日の日付を正しくしてください。" . $this->g1['hakkoubi'];
            $this->g1['errfld'] = 'Hakkoubi';
            return;
        }
        $d1 = new DateTime($this->g1['hakkoubi']);
        $df = $d0->diff($d1);
        if ($df->invert && $df->days > 60 || !$df->invert && $df->days > 5) {
            $this->g1['errflg'] = 1;
            $this->g1['emsg'] = "発行日を登録日の60日前から7日先以内で入力してください。" . $df->days;
            $this->g1['errfld'] = 'Hakkoubi';
            return;
        }
        // 納入期日チェック
        if ($this->g1['nounyuu_kijitu'] && $this->g1['nounyuu_kijitu'] != '0000-00-00') {
            if (!strptime($this->g1['nounyuu_kijitu'], '%Y-%m-%d')) {
                $this->g1['errflg'] = 1;
                $this->g1['emsg'] = "納入期日を正しくしてください。" . $this->g1['nounyuu_kijitu'];
                $this->g1['errfld'] = 'NounyuuKijitu';
                return;
            }
            $aryA = explode('-', $this->g1['nounyuu_kijitu']);
            if (!checkdate($aryA[1], $aryA[2], $aryA[0])) {
                $this->g1['errflg'] = 1;
                $this->g1['emsg'] = "納入期日の日付を正しくしてください。" . $this->g1['nounyuu_kijitu'];
                $this->g1['errfld'] = 'NounyuuKijitu';
                return;
            }
            $d1 = new DateTime($this->g1['nounyuu_kijitu']);
            $df = $d0->diff($d1);
            if ($df->invert && $df->days > 30 || !$df->invert && $df->days > 600) {
                $this->g1['errflg'] = 1;
                $this->g1['emsg'] = "納入期日を登録日の30日前から600日先以内で入力してください。" . $df->days;
                $this->g1['errfld'] = 'NounyuuKijitu';
                return;
            }
        }
        $cnt = 0;
        foreach ($this->g1['h_keikaku_meisai_dts'] as $i => $meisai_dt) {
            if ($meisai_dt['shouhin_mr_cd'] && (int)$meisai_dt['cd'] != 0) {
                // 商品コードチェック
                $shouhin_mr = ShouhinMrs::findFirst([
                    'conditions' => 'cd = ?1',
                    'bind' => [1 => $meisai_dt['shouhin_mr_cd']],
                ]);
                if (!$shouhin_mr) {
                    $this->g1['errflg'] = 1;
                    $this->g1['emsg'] = "商品コードは未登録です。" . ($i + 1) . "行目。" . $meisai_dt['shouhin_mr_cd'];
                    $this->g1['errfld'] = 'HKeikakuMeisaiDts' . $i . 'ShouhinMrCd';
                    return;
                }
                // 機種チェック
                $cnt++;
            }
        }
        if ($cnt == 0) {
            $this->g1['errflg'] = 1;
            $this->g1['emsg'] = "明細を入力してください。" . $cnt;
            $this->g1['errfld'] = 'HKeikakuMeisaiDts0ShouhinMrCd';
            return;
        }

        $this->g1['emsg'] = "更新します。確認してください。";
    }

    // *****************************************************************
    private function HeadBack()
    { // ヘッド前へ …HeadBack
        $this->g1['point_1'][] = "H-BACK";
        // *----------------------------------------------------------------
        $dt = GyoumuDts::findFirst([
            'conditions' => 'denpyou_mr_id=?0',
            'order' => 'id DESC',
            'bind' => [0 => $this->g1['denpyou_mr_id'],],
        ]);
        if (!$dt) {
            $this->g1['emsg'] = "計画がありません。" . $this->g1['denpyou_mr_id'];
            $this->g1['errflg'] = 1;
            return;
        }
        $this->TblRead($dt);
    }

    // *****************************************************************
    private function TailBack()
    { // テール前へ …TailBack
        $this->g1['point_1'][] = "T-BACK";
        // *----------------------------------------------------------------
        $dt = GyoumuDts::findFirst([
            'conditions' => 'denpyou_mr_id=?0 AND cd<?1',
            'order' => 'cd DESC, id DESC',
            'bind' => [0 => $this->g1['denpyou_mr_id'], 1 => $this->g1['cd'],],
        ]);
        if (!$dt) {
            $this->g1['emsg'] = "最初の計画番号です。" . $this->g1['cd'];
            $this->g1['errflg'] = 1;
            return;
        }
        $this->TblRead($dt);
    }

    // *****************************************************************
    private function TailNext()
    { // テール次へ …TailNext
        $this->g1['point_1'][] = "T-NEXT";
        // *----------------------------------------------------------------
        $dt = GyoumuDts::findFirst([
            'conditions' => 'denpyou_mr_id=?0 AND cd>?1',
            'order' => 'cd ASC, id DESC',
            'bind' => [0 => $this->g1['denpyou_mr_id'], 1 => $this->g1['cd'],],
        ]);
        if (!$dt) {
            $this->g1['emsg'] = "最後の計画番号です。" . $this->g1['cd'];
            $this->g1['errflg'] = 1;
            return;
        }
        $this->TblRead($dt);
    }

    // *****************************************************************
    private function TailCheck()
    { // テールチェック …TailCheck
        $this->g1['point_1'][] = "T-CHECK";
        // *----------------------------------------------------------------
        if (!$this->g1['id']) {
            $dt = new GyoumuDts();
        } else {
            $dt = GyoumuDts::findFirstByid($this->g1['id']);
            if (!$dt) {
                $this->g1['emsg'] = "計画データが見つからなくなりました。" . $this->g1['id'];
                $this->g1['errflg'] = 1;
                return;
            }
            if ($dt->updated !== $this->g1['updated']) {
                $this->g1['emsg'] = "他のプロセスから計画データが変更されたため更新を中止しました。"
                    . $this->g1['id'] . ",uid=" . $dt->kousin_user_id . " tb=" . $dt->updated . " pt=" . $this->g1['updated'];
                $this->g1['errflg'] = 1;
                return;
            }
            foreach ($this->g1['h_keikaku_meisai_dts'] as $i => $meisai_dt) {
                if ((int)$meisai_dt["id"] !== 0) {
                    if ((int)$dt->GyoumuMeisaiDts[$i]->id !== (int)$meisai_dt["id"] ||
                        $dt->GyoumuMeisaiDts[$i]->updated !== $meisai_dt["updated"]) {
                        $this->g1['emsg'] = "他のプロセスから計画明細が変更されたため中止しました。"
                            . $meisai_dt["id"] . ",id=" . $dt->GyoumuMeisaiDts[$i]->id . ",uid=" . $dt->GyoumuMeisaiDts[$i]->kousin_user_id
                            . " tb=" . $dt->GyoumuMeisaiDts[$i]->updated . " pt=" . $meisai_dt["updated"];
                        $this->g1['errflg'] = 1;
                        return;
                    }
                }
            }

        }
        $main_flds = [
            "denpyou_mr_id",
            "tekiyou",
            "hakkoubi",
            "hacchuu_dt_id", //発注と紐づける為
            "shiiresaki_mr_cd", //発注と紐づけの為
            "tantou_mr_cd",
            "nounyuu_kijitu",
            "updated",
        ];

        $meisai_flds = [
            "cd",
//			"utiwake_kbn_cd",
            "kousei",
            "kaisou",
            "gouki",
            "oya_meisai_cd",
            "shouhin_mr_cd",
            "tanni_mr2_cd",
            "tanni_mr1_cd",
            "tekiyou",
            "lot",
            "iro",
            "iromei",
            "kobetucd",
            "hinsitu_kbn_cd",
            "h_kishu_mr_cd",
            "tantou_mr_cd",
            "suuryou",
            "keisu",
            "irisuu",
            "moto_juch_ryou1",
            "moto_juch_ryou2",
            "zaikoseisan_ryou1",
            "zaikoseisan_ryou2",
            "loss_ryou1",
            "loss_ryou2",
            "keikaku_ryou1",
            "keikaku_ryou2",
            "zaiko_kbn",
            "kagi",
            "kouritu",
            "kouritu_tanni",
            "heiretu_suu",
            "kadou_nissuu",
            "kaisi_hiduke",
            "shuuryou_hiduke",
            "shouhin_kakou_cd",
            "bikou",
        ];

        $chg_flg = 0;
        if (!$this->g1['nounyuu_kijitu']) $this->g1['nounyuu_kijitu'] = '0000-00-00';
        foreach ($main_flds as $main_fld) {
            if ('' . $this->g1[$main_fld] !== '' . $dt->$main_fld) {
                $chg_flg = 1;
                break;
            }
        }

        $chg_flgs = [];
        foreach ($this->g1['h_keikaku_meisai_dts'] as $i => $meisai_dt) {
            $this->g1['h_keikaku_meisai_dts'][$i]['tantou_mr_cd'] = $this->g1['tantou_mr_cd'];
            $z = $this->g1['h_keikaku_meisai_dts'][$i]['zaiko_kbn']; // 在庫区分
            $this->g1['h_keikaku_meisai_dts'][$i]['moto_juch_ryou' . $z] = (double)$this->g1['h_keikaku_meisai_dts'][$i]['moto_juch_ryou'] ?? 0;
            $this->g1['h_keikaku_meisai_dts'][$i]['zaikoseisan_ryou' . $z] = (double)$this->g1['h_keikaku_meisai_dts'][$i]['zaikoseisan_ryou'] ?? 0
                - (double)$this->g1['h_keikaku_meisai_dts'][$i]['zaikosiyou_ryou'] ?? 0; // 備蓄使用量を引く
            $this->g1['h_keikaku_meisai_dts'][$i]['loss_ryou' . $z] = (double)$this->g1['h_keikaku_meisai_dts'][$i]['loss_ryou'] ?? 0
                - (double)$this->g1['h_keikaku_meisai_dts'][$i]['deme_ryou'] ?? 0; // 出目予定量を引く
            $this->g1['h_keikaku_meisai_dts'][$i]['keikaku_ryou' . $z] = (double)$this->g1['h_keikaku_meisai_dts'][$i]['keikaku_ryou'] ?? 0;
            if ($z == 1) { // 在庫区分=1 なら
                $irisuu = $this->g1['h_keikaku_meisai_dts'][$i]['irisuu'] ?? 0;
                $this->g1['h_keikaku_meisai_dts'][$i]['moto_juch_ryou2'] = $irisuu * $this->g1['h_keikaku_meisai_dts'][$i]['moto_juch_ryou1'];
                $this->g1['h_keikaku_meisai_dts'][$i]['zaikoseisan_ryou2'] = $irisuu * $this->g1['h_keikaku_meisai_dts'][$i]['zaikoseisan_ryou1'];
                $this->g1['h_keikaku_meisai_dts'][$i]['loss_ryou2'] = $irisuu * $this->g1['h_keikaku_meisai_dts'][$i]['loss_ryou1'];
                $this->g1['h_keikaku_meisai_dts'][$i]['keikaku_ryou2'] = $irisuu * $this->g1['h_keikaku_meisai_dts'][$i]['keikaku_ryou1'];
            } else { // 在庫区分=2 なら
                $irisuu = 0;
                $this->g1['h_keikaku_meisai_dts'][$i]['moto_juch_ryou1'] = 0;
                $this->g1['h_keikaku_meisai_dts'][$i]['zaikoseisan_ryou1'] = 0;
                $this->g1['h_keikaku_meisai_dts'][$i]['loss_ryou1'] = 0;
                $this->g1['h_keikaku_meisai_dts'][$i]['keikaku_ryou1'] = 0;
            }
            $chg_flgs[$i] = 0;//変更ないかも
            if (((int)$meisai_dt["cd"] == 0 || $meisai_dt["shouhin_mr_cd"] == '') && (int)$meisai_dt["id"] != 0) { // 削除の条件
                $chg_flg = 1;
                $chg_flgs[$i] = 2;//削除
            } else if (!isset($meisai_dt["id"]) || (int)$meisai_dt["id"] == 0) { // 新規行
                if ((int)$meisai_dt["cd"] != 0 && $meisai_dt["shouhin_mr_cd"] != '') { // 新規行で行番号ありなら変化ありとして更新へ
                    $chg_flg = 1;
                    $chg_flgs[$i] = 1;
                }
            } else { // 既存行で行番あり&&商品あり
                foreach ($meisai_flds as $meisai_fld) {
                    if ('' . $this->g1['h_keikaku_meisai_dts'][$i][$meisai_fld] !== '' . $dt->GyoumuMeisaiDts[$i]->$meisai_fld) {
                        $chg_flg = 1;
                        $chg_flgs[$i] = 1;
                        break;
                    }
                }
            }
        }
        if ($this->g1['id']) {
            if ($chg_flg === 0) {
                $this->g1['emsg'] = "変更がありません。" . $this->g1['id'];
                $this->g1['errflg'] = 1;
                return;
            }
        }

        // 伝票番号付番または再設定
        $den_ban_ctrl = new DenpyouBangouMrsController(); //伝票番号マスタコントローラ
        $nendo_ban = $den_ban_ctrl->countup('h_keikaku', $this->g1['cd'], $this->g1['hakkoubi'], $dt->nendo);
        if (!$nendo_ban['nendo']) {
            $this->g1['emsg'] = "エラー:年度が未登録（日付が今年か昨年以外は不可）。" . $this->g1['hakkoubi'];
            $this->g1['errflg'] = 1;
            return;
        }
        if ($this->g1['id']) $dt->backOut(); // bak_へセーブ

        foreach ($main_flds as $main_fld) {
            $dt->$main_fld = $this->g1[$main_fld];
        }

        $this->g1['cd'] = $nendo_ban['bangou'];
        $dt->cd = $nendo_ban['bangou'];
        $dt->nendo = $nendo_ban['nendo'];

        $MeisaiDts = [];
        foreach ($this->g1['h_keikaku_meisai_dts'] as $i => $meisai_dt) {
            if ($chg_flgs[$i] === 2) { // 削除のとき
                $dt->GyoumuMeisaiDts[$i]->backOut(1);
                $dt->GyoumuMeisaiDts[$i]->delete();
            } else {
                if (isset($meisai_dt["id"]) && (int)$meisai_dt["id"] > 0) {
                    $MeisaiDts[$i] = $dt->GyoumuMeisaiDts[$i];
                }
                if ($chg_flgs[$i] === 1) { // 更新なら
                    if (isset($meisai_dt["id"]) && (int)$meisai_dt["id"] > 0) {
                        $dt->GyoumuMeisaiDts[$i]->backOut();
                    } else {
                        $MeisaiDts[$i] = new GyoumuMeisaiDts();
                    }
                    foreach ($meisai_flds as $meisai_fld) {
                        $MeisaiDts[$i]->$meisai_fld = $meisai_dt[$meisai_fld] ?? '';
                        //更新日時や更新者はModelに定義してある
                    }
                }
            }
        }
        $dt->GyoumuMeisaiDts = $MeisaiDts; // 明細データをドッキング

        if (!$dt->save()) {
            $this->g1['emsg'] = "登録失敗！";
            foreach ($dt->getMessages() as $message) {
                $this->g1['emsg'] .= "<br>" . $message;
            }
            $this->g1['errflg'] = 1;
            return;
        }

        $this->g1['emsg'] = "計画データの情報を更新しました。";
    }

    // *****************************************************************
    private function Sub_shouhin_mr_cd($on_row = 0)
    { // 商品情報
        $this->g1['point_1'][] = "subShouhin";
        // *----------------------------------------------------------------
        $this->g1['h_keikaku_meisai_dts'][$on_row]['tekiyou'] = '';
        $shouhin_mrs = ShouhinMrs::find([
            'conditions' => 'cd like ?1',
            'bind' => [1 => $this->g1['h_keikaku_meisai_dts'][$on_row]['shouhin_mr_cd'] . '%',],
            'order' => 'cd',
            'limit' => '10',
        ]);
        if (count($shouhin_mrs) == 0) {
            $this->g1['errflg'] = 1;
            $this->g1['emsg'] = "商品コードが未登録です。" . (1 + $on_row) . "行目";
            $this->g1['errfld'] = 'HKeikakuMeisaiDts' . $on_row . 'ShouhinMrCd';
            return;
        }
        $this->g1['shouhin_option'] = [];
        foreach ($shouhin_mrs as $shouhin_mr) {
            $this->g1['shouhin_option'][$shouhin_mr->cd] = $shouhin_mr->cd . ':' . $shouhin_mr->name;
        }
        if (count($shouhin_mrs) > 1 && $shouhin_mrs[0]->cd !== $this->g1['h_keikaku_meisai_dts'][$on_row]['shouhin_mr_cd']) {
            $this->g1['errflg'] = 1;
            $this->g1['emsg'] = "商品コードをクリックして選択してください。";
            $this->g1['errfld'] = 'HKeikakuMeisaiDts' . $on_row . 'ShouhinMrCd';
            return;
        }
        $this->g1['h_keikaku_meisai_dts'][$on_row]['shouhin_mr_cd'] = $shouhin_mrs[0]->cd;
        $this->g1['h_keikaku_meisai_dts'][$on_row]['tekiyou'] = $shouhin_mrs[0]->name;
        $z = $shouhin_mrs[0]->zaiko_kbn;
        $this->g1['h_keikaku_meisai_dts'][$on_row]['zaiko_kbn'] = $z;
        $this->g1['h_keikaku_meisai_dts'][$on_row]['tanni_mr1_cd'] = $shouhin_mrs[0]->tanni_mr1_cd;
        $this->g1['h_keikaku_meisai_dts'][$on_row]['tanni_mr2_cd'] = $shouhin_mrs[0]->tanni_mr2_cd;
        $tanniMrs = 'TanniMr' . $z . 's';
        $this->g1['h_keikaku_meisai_dts'][$on_row]['zaiko_tanni'] = $shouhin_mrs[0]->$tanniMrs->name;
        $suu_shousuu = 'suu' . $z . '_shousuu';
        $this->g1['h_keikaku_meisai_dts'][$on_row]['suu_shousuu'] = $shouhin_mrs[0]->$suu_shousuu;
    }

    // *****************************************************************
    private function Sub_h_kishu_mr_cd($on_row = 0)
    { // 機種情報
        $this->g1['point_1'][] = "subKishu";
        // *----------------------------------------------------------------
        $this->g1['h_keikaku_meisai_dts'][$on_row]['h_kishu_mr_name'] = '';
        $h_kishu_mrs = HKishuMrs::find([
            'conditions' => 'cd like ?1',
            'bind' => [1 => $this->g1['h_keikaku_meisai_dts'][$on_row]['h_kishu_mr_cd'] . '%',],
            'order' => 'cd',
            'limit' => '10',
        ]);
        if (count($h_kishu_mrs) == 0) {
            $this->g1['errflg'] = 1;
            $this->g1['emsg'] = "機種コードが未登録です。" . (1 + $on_row) . "行目";
            $this->g1['errfld'] = 'HKeikakuMeisaiDts' . $on_row . 'HKishuMrCd';
            return;
        }
        $this->g1['h_kishu_option'] = [];
        foreach ($h_kishu_mrs as $h_kishu_mr) {
            $this->g1['h_kishu_option'][$h_kishu_mr->cd] = $h_kishu_mr->cd . ':' . $h_kishu_mr->name;
        }
        if (count($h_kishu_mrs) > 1 && $h_kishu_mrs[0]->cd !== $this->g1['h_keikaku_meisai_dts'][$on_row]['h_kishu_mr_cd']) {
            $this->g1['errflg'] = 1;
            $this->g1['emsg'] = "機種コードをクリックして選択してください。";
            $this->g1['errfld'] = 'HKeikakuMeisaiDts' . $on_row . 'HKishuMrCd';
            return;
        }
        $this->g1['h_keikaku_meisai_dts'][$on_row]['h_kishu_mr_cd'] = $h_kishu_mrs[0]->cd;
        $this->g1['h_keikaku_meisai_dts'][$on_row]['h_kishu_mr_name'] = $h_kishu_mrs[0]->name;
    }

    // *****************************************************************
    private function Sub_oya_meisai_cd($on_row = 0)
    {        // 親行
        $this->g1['point_1'][] = "Sub_oya_meisai_cd";
        // *----------------------------------------------------------------
    }

    // *****************************************************************
    private function Sub_keisu($on_row = 0)
    {                // 係数
        $this->g1['point_1'][] = "Sub_keisu";
        // *----------------------------------------------------------------
        $this->Sub1_suu_keisu_change($on_row);
    }

    // *****************************************************************
    private function Sub_moto_juch_ryou($on_row = 0)
    {    // 受注量
        $this->g1['point_1'][] = "Sub_moto_juch_ryou";
        // *----------------------------------------------------------------
        $this->Sub1_gyou_keisan($on_row);
    }

    // *****************************************************************
    private function Sub_zaikoseisan_ryou($on_row = 0)
    {    // 備蓄生産量
        $this->g1['point_1'][] = "Sub_zaikoseisan_ryou";
        // *----------------------------------------------------------------
        $this->Sub1_gyou_keisan($on_row);
    }

    // *****************************************************************
    private function Sub_loss_ryou($on_row = 0)
    {            // ロス量
        $this->g1['point_1'][] = "Sub_loss_ryou";
        // *----------------------------------------------------------------
        $this->Sub1_gyou_keisan($on_row);
    }

    // *****************************************************************
    private function Sub_deme_ryou($on_row = 0)
    {            // 出目量
        $this->g1['point_1'][] = "Sub_deme_ryou";
        // *----------------------------------------------------------------
        $this->Sub1_gyou_keisan($on_row);
    }

    // *****************************************************************
    private function Sub_zaikosiyou_ryou($on_row = 0)
    {    // 備蓄使用量
        $this->g1['point_1'][] = "Sub_zaikosiyou_ryou";
        // *----------------------------------------------------------------
        $this->Sub1_gyou_keisan($on_row);
    }

    // *****************************************************************
    private function Sub_kouritu($on_row = 0)
    {            // 効率
        $this->g1['point_1'][] = "Sub_kouritu";
        // *----------------------------------------------------------------
    }

    // *****************************************************************
    private function Sub_heiretu_suu($on_row = 0)
    {        // 錘数
        $this->g1['point_1'][] = "Sub_heiretu_suu";
        // *----------------------------------------------------------------
        $this->Sub1_nissuu_keisan($on_row);
        $this->Sub1_kaisibi_keisan($on_row);
    }

    // *****************************************************************
    private function Sub_kaisi_hiduke($on_row = 0)
    {        // 開始日
        $this->g1['point_1'][] = "Sub_kaisi_hiduke";
        // *----------------------------------------------------------------
        $this->Sub1_shuuryoubi_keisan($on_row);
    }

    // *****************************************************************
    private function Sub_shuuryou_hiduke($on_row = 0)
    {        // 終了日
        $this->g1['point_1'][] = "Sub_shuuryou_hiduke";
        // *----------------------------------------------------------------
        $this->Sub1_kaisibi_keisan($on_row);
    }

    // *****************************************************************
    private function Sub_tenkai($on_row = 0, $tan = 0)
    { // 展開
        $this->g1['point_1'][] = "subTenkai/" . $tan;
        // *----------------------------------------------------------------
        $shouhin_mr_cd = $this->g1['h_keikaku_meisai_dts'][$on_row]['shouhin_mr_cd'];
        $shouhin_mr = ShouhinMrs::findFirst([
            'conditions' => 'cd = ?0',
            'bind' => ['0' => $shouhin_mr_cd],
        ]);
        $fullo = 1;
        $buhin_ctrl = new KouseiBuhinMrsController();
        $resData = $buhin_ctrl->_tenkai(
            $shouhin_mr, 1.0, $shouhin_mr->tanni_mr1_cd, $tan, 1, '', $fullo
        );
        $resSum = [];
        foreach ($resData as $resData1) {
            $new_flg = 1;
            if ($new_flg == 1) {
                $resSum[] = [
                    'gen_shouhin_mr_cd' => $resData1['gen_shouhin_mr_cd'],
                    'kaisou' => $resData1['kaisou'],
                    'kousei' => $resData1['kousei'],
                    'irisuu' => $resData1['irisuu'],
                    'suuryou' => $resData1['suuryou'],
                    'koutin_flg' => $resData1['koutin_flg'],
                    'gen_hyouji_jun' => $resData1['gen_hyouji_jun'],
                    'gen_shouhin_mr' => $resData1['gen_shouhin_mr']
                ];
            }
        }

        $this->g1['h_keikaku_meisai_dts'][$on_row]['kousei'] = '┬';
        $this->g1['h_keikaku_meisai_dts'][$on_row]['kaisou'] = 0;
        $zaiko_kbn = $this->g1['h_keikaku_meisai_dts'][$on_row]['zaiko_kbn'];
        $suuryou = $this->g1['h_keikaku_meisai_dts'][$on_row]['keikaku_ryou'];
        $ko_row = $on_row;
        //製品行は変更されないので保持しておく
        $kanseihin_row = $on_row;
        $kaisou_ary = [];
        $kaisou_ary[0] = $ko_row;
        foreach ($resSum as $key => $value) {
            if ($value['gen_shouhin_mr']['zaikokanri'] != 1) {
                if ($value['gen_shouhin_mr']['shouhin_bunrui1_kbn_cd'] != 'E') {
                    if (($this->g1['h_keikaku_meisai_dts'][$ko_row]['shouhin_kakou_cd'] ?? '') !== $value['gen_shouhin_mr_cd']) {
                        $this->g1['h_keikaku_meisai_dts'][$ko_row]['heiretu_suu'] = 0;
                    }
//                    $this->g1['h_keikaku_meisai_dts'][$ko_row]['shouhin_kakou_cd'] = $value['gen_shouhin_mr_cd'];
                    $this->g1['h_keikaku_meisai_dts'][$kanseihin_row]['shouhin_kakou_cd'] = $value['gen_shouhin_mr_cd'];
                    $this->Sub1_kishu_set($kanseihin_row);
                }
            } else {
                $ko_row += 1;
                $kaisou_ary[$value['kaisou']] = $ko_row;
                $this->g1['h_keikaku_meisai_dts'][$ko_row]['cd'] = $ko_row + 1;
                $this->g1['h_keikaku_meisai_dts'][$ko_row]['kousei'] = $value['kousei'];
                $this->g1['h_keikaku_meisai_dts'][$ko_row]['kaisou'] = $value['kaisou'];
                $this->g1['h_keikaku_meisai_dts'][$ko_row]['oya_meisai_cd'] = $kaisou_ary[$value['kaisou'] - 1] + 1; // cd行番は1から
                $this->g1['h_keikaku_meisai_dts'][$ko_row]['shouhin_mr_cd'] = $value['gen_shouhin_mr_cd'];
                $this->g1['h_keikaku_meisai_dts'][$ko_row]['keisu'] = $value['suuryou'];
                $this->g1['h_keikaku_meisai_dts'][$ko_row]['tekiyou'] = $value['gen_shouhin_mr']['name'];
                $this->g1['h_keikaku_meisai_dts'][$ko_row]['lot'] = $value['gen_shouhin_mr']['lot'];
                $this->g1['h_keikaku_meisai_dts'][$ko_row]['tanni_mr1_cd'] = $value['gen_shouhin_mr']['tanni_mr1_cd'];
                $this->g1['h_keikaku_meisai_dts'][$ko_row]['tanni_mr2_cd'] = $value['gen_shouhin_mr']['tanni_mr2_cd'];
                $z = $value['gen_shouhin_mr']['zaiko_kbn'];
                $this->g1['h_keikaku_meisai_dts'][$ko_row]['zaiko_kbn'] = $z;
                $this->g1['h_keikaku_meisai_dts'][$ko_row]['zaiko_tanni'] = $value['gen_shouhin_mr']['tanni_mr' . $z . '_name'];
                $this->g1['h_keikaku_meisai_dts'][$ko_row]['suu_shousuu'] = $value['gen_shouhin_mr']['suu' . $z . '_shousuu'];
            }
        }
        $this->mugen_sosi = []; // 無限ループ阻止
        $this->Sub1_gyou_keisan($on_row);
        if ($this->g1['nounyuu_kijitu'] == '0000-00-00' || $this->g1['nounyuu_kijitu'] == '') {
            $this->Sub1_saitan_after(); // 日付計算
        } else {
            $this->Sub1_saitan_befor(); // 日付計算
        }
    }

    // *****************************************************************
    private function Sub1_kishu_set($ko_row = 0)
    { // 機種設定
        $this->g1['point_1'][] = "subKishuSet/" . $ko_row;
        // *----------------------------------------------------------------
        $shouhin_kakou_cd = $this->g1['h_keikaku_meisai_dts'][$ko_row]['shouhin_kakou_cd'];
        $this->g1['h_keikaku_meisai_dts'][$ko_row]['h_kishu_mr_cd'] = '';
        $this->g1['h_keikaku_meisai_dts'][$ko_row]['kouritu'] = 0;
        $this->g1['h_keikaku_meisai_dts'][$ko_row]['kouritu_tanni'] = '';
        $this->g1['h_keikaku_meisai_dts'][$ko_row]['h_kishu_mr_irowake'] = '000000';
//		$this->g1['h_keikaku_meisai_dts'][$ko_row]['heiretu_suu'] = 1;
        $this->g1['h_keikaku_meisai_dts'][$ko_row]['h_calendar_patan_dt_cd'] = '';
        $h_shouhin_jouken_mr = HShouhinJoukenMrs::findFirst([
            'conditions' => 'shouhin_mr_cd = ?1 AND h_jouken_midasi_mr_id = 1', // 1=優先順位
            'bind' => [1 => $shouhin_kakou_cd],
            'order' => 'jouken', // 優先順
        ]);
        if ($h_shouhin_jouken_mr) {
            $this->g1['h_keikaku_meisai_dts'][$ko_row]['h_kishu_mr_cd'] = $h_shouhin_jouken_mr->h_kishu_mr_cd;
            $this->g1['h_keikaku_meisai_dts'][$ko_row]['h_kishu_mr_name'] = $h_shouhin_jouken_mr->HKishuMrs->name;
            $this->g1['h_keikaku_meisai_dts'][$ko_row]['h_kishu_mr_irowake'] = $h_shouhin_jouken_mr->HKishuMrs->irowake;
            $this->g1['h_keikaku_meisai_dts'][$ko_row]['h_calendar_patan_dt_cd'] = $h_shouhin_jouken_mr->HKishuMrs->h_calendar_patan_dt_cd;
            if ($this->g1['h_keikaku_meisai_dts'][$ko_row]['heiretu_suu'] == 0)
                $this->g1['h_keikaku_meisai_dts'][$ko_row]['heiretu_suu'] = round($h_shouhin_jouken_mr->HKishuMrs->sou_suisuu / $h_shouhin_jouken_mr->HKishuMrs->daisuu);
            if ($this->g1['h_keikaku_meisai_dts'][$ko_row]['heiretu_suu'] == 0)
                $this->g1['h_keikaku_meisai_dts'][$ko_row]['heiretu_suu'] = 1;
            $h_jouken_midasi_mrs = HShouhinJoukenMrs::query()
                ->leftJoin('HJoukenMidasiMrs', 'HShouhinJoukenMrs.h_jouken_midasi_mr_id = b.id', 'b')
                ->where('HShouhinJoukenMrs.shouhin_mr_cd = ?1 AND '
                    . 'HShouhinJoukenMrs.h_kishu_mr_cd = ?2 AND '
                    . 'b.yuuikey = "kouritu"',
                    [1 => $shouhin_kakou_cd, 2 => $h_shouhin_jouken_mr->h_kishu_mr_cd])
                ->columns([
                    "HShouhinJoukenMrs.jouken",
                    "b.tanni_mr_cd",
                ])
                ->execute();
            if ($h_jouken_midasi_mrs && count($h_jouken_midasi_mrs) > 0) {
                $this->g1['h_keikaku_meisai_dts'][$ko_row]['kouritu'] = $h_jouken_midasi_mrs[0]->jouken;
                $this->g1['h_keikaku_meisai_dts'][$ko_row]['kouritu_tanni'] = $h_jouken_midasi_mrs[0]->tanni_mr_cd;
            }
        }
    }

    // *****************************************************************
    private function Sub1_suu_keisu_change($on_row = 0)
    { //元数量か係数が変更された時の共通処理
        $this->g1['point_1'][] = "subSuuKeisuuChange";
        // *----------------------------------------------------------------
        $suuryou = $this->g1['h_keikaku_meisai_dts'][$on_row]['suuryou'];
        $keisu = $this->g1['h_keikaku_meisai_dts'][$on_row]['keisu'];
        $this->g1['h_keikaku_meisai_dts'][$on_row]['hituyou_ryou'] = round($keisu * $suuryou, 4); // 丸め小数４桁
        $this->Sub1_gyou_keisan($on_row);
    }

    // *****************************************************************
    private function Sub1_gyou_keisan($on_row = 0)
    { // 行内数量計算
        $this->g1['point_1'][] = "subGyouKeisan";
        // *----------------------------------------------------------------
        if (!isset($this->g1['h_keikaku_meisai_dts'][$on_row]['hituyou_ryou'])) $this->g1['h_keikaku_meisai_dts'][$on_row]['hituyou_ryou'] = 0;
        if (!isset($this->g1['h_keikaku_meisai_dts'][$on_row]['moto_juch_ryou'])) $this->g1['h_keikaku_meisai_dts'][$on_row]['moto_juch_ryou'] = 0;
        if (!isset($this->g1['h_keikaku_meisai_dts'][$on_row]['zaikoseisan_ryou'])) $this->g1['h_keikaku_meisai_dts'][$on_row]['zaikoseisan_ryou'] = 0;
        if (!isset($this->g1['h_keikaku_meisai_dts'][$on_row]['loss_ryou'])) $this->g1['h_keikaku_meisai_dts'][$on_row]['loss_ryou'] = 0;
        if (!isset($this->g1['h_keikaku_meisai_dts'][$on_row]['deme_ryou'])) $this->g1['h_keikaku_meisai_dts'][$on_row]['deme_ryou'] = 0;
        if (!isset($this->g1['h_keikaku_meisai_dts'][$on_row]['zaikosiyou_ryou'])) $this->g1['h_keikaku_meisai_dts'][$on_row]['zaikosiyou_ryou'] = 0;
        $keikaku_ryou = 0
            + (double)$this->g1['h_keikaku_meisai_dts'][$on_row]['hituyou_ryou']
            + (double)$this->g1['h_keikaku_meisai_dts'][$on_row]['moto_juch_ryou']
            + (double)$this->g1['h_keikaku_meisai_dts'][$on_row]['zaikoseisan_ryou']
            + (double)$this->g1['h_keikaku_meisai_dts'][$on_row]['loss_ryou']
            - (double)$this->g1['h_keikaku_meisai_dts'][$on_row]['deme_ryou']
            - (double)$this->g1['h_keikaku_meisai_dts'][$on_row]['zaikosiyou_ryou'];
        $this->g1['h_keikaku_meisai_dts'][$on_row]['keikaku_ryou'] = round($keikaku_ryou, 4); // 丸め小数４桁
        $this->Sub1_eikyou_keisan($on_row);
        $this->Sub1_nissuu_keisan($on_row);
        $this->Sub1_kaisibi_keisan($on_row);
    }

    // *****************************************************************
    private function Sub1_nissuu_keisan($on_row = 0)
    { // 日数計算
        $this->g1['point_1'][] = "Sub1_nissuu_keisan";
        // *----------------------------------------------------------------
        $meisai = $this->g1['h_keikaku_meisai_dts'][$on_row];
        $suisuu = isset($meisai['heiretu_suu']) ? (int)$meisai['heiretu_suu'] : 0; // 錘数
        if ($suisuu == 0) {
            $suisuu = 1;
        } // 0錘なら1錘
        $nissuu = 0;
        if (isset($meisai['kouritu']) && (double)$meisai['kouritu'] > 0) {
            $nissuu = ceil(1 * $meisai['keikaku_ryou'] / $meisai['kouritu'] / $suisuu);
        }
        $this->g1['h_keikaku_meisai_dts'][$on_row]['kadou_nissuu'] = $nissuu;
    }

    // *****************************************************************
    private function Sub1_eikyou_keisan($on_row = 0)
    { // 計画数変化による影響
        $this->g1['point_1'][] = "subEikyouKeisan";
        // *----------------------------------------------------------------
        $this->mugen_sosi[$on_row] = 1; // 自己ループ阻止
        $cd = $this->g1['h_keikaku_meisai_dts'][$on_row]['cd'];
        $ryou = $this->g1['h_keikaku_meisai_dts'][$on_row]['keikaku_ryou'];
        foreach ($this->g1['h_keikaku_meisai_dts'] as $i => $meisai) {
            if ($cd == $meisai['oya_meisai_cd'] && !isset($this->mugen_sosi[$i])) {
                $this->mugen_sosi[$i] = 1; // 無限ループ阻止
                $this->g1['h_keikaku_meisai_dts'][$i]['suuryou'] = $ryou;
                $this->Sub1_suu_keisu_change($i);
            }
        }
    }

    // *****************************************************************
    private function Sub1_shuuryoubi_keisan($on_row = 0)
    { // 終了日計算
        $this->g1['point_1'][] = "Sub1_shuuryoubi_keisan:" . $on_row;
        // *----------------------------------------------------------------
        // 日時形式にしたので、日付けと時刻を分ける
        if ($this->g1['h_keikaku_meisai_dts'][$on_row]['kaisi_hiduke'] !== date('Y-m-d H:i:s', strtotime($this->g1['h_keikaku_meisai_dts'][$on_row]['kaisi_hiduke']))) {
            $this->g1['h_keikaku_meisai_dts'][$on_row]['shuuryou_hiduke'] = '0000-00-00 00:00:00';
            $this->g1['emsg'] = "開始日時の形式が不正です。";
            $this->g1['errflg'] = 2; // ワーニング
            return;
        }
        $kaisi_hiduke = date('Y-m-d', strtotime($this->g1['h_keikaku_meisai_dts'][$on_row]['kaisi_hiduke']));
        $tmpTime = date('H:i:s', strtotime($this->g1['h_keikaku_meisai_dts'][$on_row]['kaisi_hiduke']));

        $this->g1['test_kaishibi'] = $kaisi_hiduke;
        $this->g1['test_kaishi_jikan'] = $tmpTime;

        $nissuu = (int)$this->g1['h_keikaku_meisai_dts'][$on_row]['kadou_nissuu'];
        if ($nissuu == 0) {
            $this->g1['h_keikaku_meisai_dts'][$on_row]['shuuryou_hiduke'] = $kaisi_hiduke;
            return;
        }
        $h_calendar_dts = HCalendarDts::find([
            'conditions' => 'hiduke >= ?1 AND cd = ?2 AND kadou_flg = 1', // カレンダパタン一致の稼働日
            'bind' => [
                1 => $kaisi_hiduke,
                2 => $this->g1['h_keikaku_meisai_dts'][$on_row]['h_calendar_patan_dt_cd'],
            ],
            'order' => 'hiduke', // 日付順
            'limit' => 1 + $nissuu,
        ]);
        if ($h_calendar_dts && count($h_calendar_dts) == 1 + $nissuu) {
            $this->g1['h_keikaku_meisai_dts'][$on_row]['shuuryou_hiduke'] = $h_calendar_dts[$nissuu]->hiduke . ' ' . $tmpTime;
        } else {
            $this->g1['h_keikaku_meisai_dts'][$on_row]['shuuryou_hiduke'] = $kaisi_hiduke . ' ' . $tmpTime;
            $this->g1['emsg'] = "カレンダーが未登録期間のため終了日が計算できません。";
            $this->g1['errflg'] = 2; // ワーニング
        }
    }

    // *****************************************************************
    private function Sub1_kaisibi_keisan($on_row = 0)
    { // 開始日計算
        $this->g1['point_1'][] = "Sub1_kaisibi_keisan:" . $on_row;
        // *----------------------------------------------------------------
        $shuuryou_hiduke = $this->g1['h_keikaku_meisai_dts'][$on_row]['shuuryou_hiduke'] ?? '0000-00-00 00:00:00';
        // 日時形式にしたので、日付けと時刻を分ける

        // 日時の妥当性チェック
        if ($shuuryou_hiduke !== date('Y-m-d H:i:s', strtotime($shuuryou_hiduke))) {
            $this->g1['h_keikaku_meisai_dts'][$on_row]['kaisi_hiduke'] = '0000-00-00 00:00:00';
            $this->g1['emsg'] = "終了日時の形式が不正です。";
            $this->g1['errflg'] = 2; // ワーニング
            return;
        }
        $kaisi_hiduke = date('Y-m-d', strtotime($shuuryou_hiduke));
        $tmpTime = date('H:i:s', strtotime($shuuryou_hiduke));

        $nissuu = (int)$this->g1['h_keikaku_meisai_dts'][$on_row]['kadou_nissuu'];
        if ($nissuu == 0) {
            $this->g1['h_keikaku_meisai_dts'][$on_row]['kaisi_hiduke'] = $shuuryou_hiduke . ' ' . $tmpTime;
            return;
        }
        $h_calendar_dts = HCalendarDts::find([
            'conditions' => 'hiduke <= ?1 AND cd = ?2 AND kadou_flg = 1', // カレンダパタン一致の稼働日
            'bind' => [
                1 => $shuuryou_hiduke,
                2 => $this->g1['h_keikaku_meisai_dts'][$on_row]['h_calendar_patan_dt_cd'],
            ],
            'order' => 'hiduke DESC', // 日付順
            'limit' => 1 + $nissuu,
        ]);
        if ($h_calendar_dts && count($h_calendar_dts) == 1 + $nissuu) {
            $this->g1['h_keikaku_meisai_dts'][$on_row]['kaisi_hiduke'] = $h_calendar_dts[$nissuu]->hiduke . ' ' . $tmpTime;
        } else {
            $this->g1['h_keikaku_meisai_dts'][$on_row]['kaisi_hiduke'] = $shuuryou_hiduke . ' ' . $tmpTime;
            $this->g1['emsg'] = "カレンダーが未登録期間のため開始日が計算できません。";
            $this->g1['errflg'] = 2; // ワーニング
        }
    }

    // *****************************************************************
    private function Sub1_saitan_after()
    { // 今日以降最短日程
        $this->g1['point_1'][] = "Sub1_saitan_after";
        // *----------------------------------------------------------------
        $today1 = date("Y-m-d");
        $max_kaisou = 0;
        foreach ($this->g1['h_keikaku_meisai_dts'] as $i => $meisai) { // 全てに今日
            if ($meisai['shouhin_mr_cd'] != '') {
                $this->g1['h_keikaku_meisai_dts'][$i]['kaisi_hiduke'] = $today1;
                $this->g1['h_keikaku_meisai_dts'][$i]['shuuryou_hiduke'] = $today1;
                if ((int)$this->g1['h_keikaku_meisai_dts'][$i]['kaisou'] > $max_kaisou) {
                    $max_kaisou = (int)$this->g1['h_keikaku_meisai_dts'][$i]['kaisou'];
                }
            }
        }
        for ($i_kaisou = $max_kaisou; $i_kaisou >= 0; $i_kaisou--) {
            foreach ($this->g1['h_keikaku_meisai_dts'] as $i => $meisai) {
                if ($i_kaisou == (int)$meisai['kaisou'] && $meisai['shouhin_mr_cd'] != '') {
                    $suisuu = isset($meisai['heiretu_suu']) ? (int)$meisai['heiretu_suu'] : 0; // 錘数
                    if ($suisuu == 0) {
                        $suisuu = 1;
                    } // 0錘なら1錘
                    $nissuu = 0;
                    if (isset($meisai['kouritu']) && (double)$meisai['kouritu'] > 0) {
                        $nissuu = ceil(1 * $meisai['keikaku_ryou'] / $meisai['kouritu'] / $suisuu);
                    }
                    $this->g1['h_keikaku_meisai_dts'][$i]['kadou_nissuu'] = $nissuu;
                    $this->Sub1_shuuryoubi_keisan($i); // 終了日計算
                    $datez = $this->g1['h_keikaku_meisai_dts'][$i]['shuuryou_hiduke'];
                    if ($i_kaisou > 0) {
                        $i_oya = $meisai['oya_meisai_cd'] - 1;
                        if ($this->g1['h_keikaku_meisai_dts'][$i_oya]['kaisi_hiduke'] < $datez) {
                            $this->g1['h_keikaku_meisai_dts'][$i_oya]['kaisi_hiduke'] = $datez;
                        }
                    } else {
                        if ($this->g1['nounyuu_kijitu'] < $datez) {
                            $this->g1['nounyuu_kijitu'] = $datez;
                        }
                    }
                }
            }
        }
        $this->Sub1_saitan_befor(); // 納期以前最短日程
    }

    // *****************************************************************
    private function Sub1_saitan_befor()
    { // 納期以前最短日程
        $this->g1['point_1'][] = "Sub1_saitan_befor";
        // *----------------------------------------------------------------
        $max_kaisou = 0;
        foreach ($this->g1['h_keikaku_meisai_dts'] as $i => $meisai) { // 階層最大算出
            $this->g1['h_keikaku_meisai_dts'][$i]['kaisi_hiduke'] = ''; // 開始日クリア
            $this->g1['h_keikaku_meisai_dts'][$i]['shuuryou_hiduke'] = '';
            if ((int)$meisai['kaisou'] > $max_kaisou) {
                $max_kaisou = (int)$meisai['kaisou'];
            }
        }
        for ($i_kaisou = 0; $i_kaisou <= $max_kaisou; $i_kaisou++) {
            foreach ($this->g1['h_keikaku_meisai_dts'] as $i => $meisai) {
                if ($i_kaisou == $meisai['kaisou'] && $meisai['shouhin_mr_cd'] != '') {
                    if ($i_kaisou > 0) {
                        $i_oya = $meisai['oya_meisai_cd'] - 1;
                        if ($meisai['shuuryou_hiduke'] == ''
                            || $this->g1['h_keikaku_meisai_dts'][$i_oya]['kaisi_hiduke'] < $meisai['shuuryou_hiduke']) {
                            $this->g1['h_keikaku_meisai_dts'][$i]['shuuryou_hiduke'] = $this->g1['h_keikaku_meisai_dts'][$i_oya]['kaisi_hiduke'];
                        }
                    } else {
                        $this->g1['h_keikaku_meisai_dts'][$i]['shuuryou_hiduke'] = $this->g1['nounyuu_kijitu'];
                    }
                    $suisuu = isset($meisai['heiretu_suu']) ? (int)$meisai['heiretu_suu'] : 0; // 錘数
                    if ($suisuu == 0) {
                        $suisuu = 1;
                    } // 0錘なら1錘
                    $nissuu = 0;
                    if (isset($meisai['kouritu']) && (double)$meisai['kouritu'] > 0) {
                        $nissuu = ceil((double)$meisai['keikaku_ryou'] / (double)$meisai['kouritu'] / $suisuu);
                    }
                    $this->g1['h_keikaku_meisai_dts'][$i]['kadou_nissuu'] = $nissuu;
                    $this->Sub1_kaisibi_keisan($i); // 開始日計算
                }
            }
        }
    }

    /**
     * ProductionPlanByModelへ機種別の計画をJSONで返却する
     *
     * @return \Phalcon\Http\Response|\Phalcon\Http\ResponseInterface
     */
    public function getModelPlanAction()
    {
        header("Content-type: application/json; charset=UTF-8");
        $this->view->disable();
        $response = new \Phalcon\Http\Response();
        $db = \Phalcon\DI::getDefault()->get('db');

        $model_cd = $this->request->getPost('model_cd'); // 機種コード
        $start_date = $this->request->getPost('start_date'); // クエリ範囲開始日
        $end_date = $this->request->getPost('end_date'); // クエリ範囲終了日
        $supplier = $this->request->getPost('supplier'); // 発注先コード
        $today = date('Y-m-d');

        $phql = "
            SELECT
                c.cd AS hacchuu_no,
                b.h_kishu_mr_cd AS kishu_mei,
                b.kaisi_hiduke AS start_date,
                b.shuuryou_hiduke AS end_date,
                b.shouhin_mr_cd AS shouhin_mr_cd,
                b.tekiyou AS tekiyou,
                b.gouki AS gouki,
                d.irowake AS pColor,
                '' AS pLink,
                '' AS pMile,
                b.shouhin_mr_cd AS shouhin_mr_cd,
                '' AS pComp,
                '0' AS pGroup,
                '' AS pParent,
                '0' AS pOpen,
                '' AS pDepend, 
                b.heiretu_suu AS pCaption
            FROM gyoumu_dts AS a
            LEFT JOIN gyoumu_meisai_dts AS b on a.id = b.gyoumu_dt_id
            LEFT JOIN hacchuu_dts AS c ON c.id = a.hacchuu_dt_id
            LEFT JOIN h_kishu_mrs AS d ON d.cd = b.h_kishu_mr_cd
            WHERE b.h_kishu_mr_cd = '${model_cd}' AND c.shiiresaki_mr_cd = '${supplier}' AND (b.kaisi_hiduke BETWEEN '${today}' AND '9999-12-31')
            ORDER BY b.shouhin_mr_cd
        ";
        $stmt = $db->prepare($phql);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $response->setContent(json_encode($rows));
    }

    /**
     * 生産計画一覧 ※基本的にJSONデータをやり取りするので、ビューを返すだけ
     */
    public function listAction()
    {
        return;
    }

    /**
     * 計画情報を返却する
     *
     * @return \Phalcon\Http\Response|\Phalcon\Http\ResponseInterface
     */
    public function ajaxGetAction()
    {
        header("Content-type: text/plain; charset=UTF-8");
        $this->view->disable();
        $response = new \Phalcon\Http\Response();
        $db = \Phalcon\DI::getDefault()->get('db');

        $hacchuu_dt_cd = $this->request->getPost('hacchuu_dt_cd');
        $gyoumu_dt_cd = $this->request->getPost('gyoumu_dt_cd');

        $where = " WHERE a.cd = ${hacchuu_dt_cd} AND c.h_kishu_mr_cd <> '' ";
        if ($gyoumu_dt_cd !== '') {
            $where .= "AND b.cd = ${gyoumu_dt_cd} ";
        }

        // 計画詳細
        $phql = "
            SELECT 
                a.id AS hacchuu_dt_id,
                b.id AS gyoumu_dt_id,
                b.cd AS gyoumu_dt_cd,
                c.shouhin_mr_cd AS shouhin_mr_cd,
                c.tekiyou AS tekiyou,
                c.lot AS lot,
                c.iro AS iro,
                c.keikaku_ryou1 AS keikakusuu,
                c.keikaku_ryou2 AS keikakuryou,
                d.name AS model_name,
                c.heiretu_suu AS sui_suu,
                c.kaisi_hiduke AS start_date,
                c.shuuryou_hiduke AS end_date,
                e.name AS tanni1,
                f.name AS tanni2
            FROM hacchuu_dts AS a
            LEFT JOIN gyoumu_dts AS b ON b.hacchuu_dt_id = a.id
            LEFT JOIN gyoumu_meisai_dts AS c ON c.gyoumu_dt_id = b.id
            LEFT JOIN h_kishu_mrs AS d ON c.h_kishu_mr_cd = d.cd
            LEFT JOIN tanni_mrs AS e ON e.cd = c.tanni_mr1_cd
            LEFT JOIN tanni_mrs AS f ON f.cd = c.tanni_mr2_cd
            ${where}
            ORDER BY b.id DESC
            LIMIT 1
        ";
        $stmt = $db->prepare($phql);
        $stmt->execute();
        $keikaku_rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $gyoumu_dt_id = $keikaku_rows[0]['gyoumu_dt_id'];

        // 計画に紐づく実績を取得
        $phql = "
            SELECT
                a.id AS jisseki_id,
                a.cd AS jisseki_cd,
                b.name AS jisseki_hinsitu_kbn,
                a.jissekibi AS jissekibi,
                a.jisseki_suu AS jissekisuu,
                a.jisseki_ryou AS jissekiryou,
                a.memo AS memo,
                a.kanryou_flg AS kanryou_flg
            FROM g_jisseki AS a
            LEFT JOIN hinsitu_kbns AS b ON b.cd = a.hinsitsu_kbn_cd
            WHERE a.gyoumu_dt_id = ${gyoumu_dt_id}
            ORDER BY a.jissekibi
        ";

        $stmt = $db->prepare($phql);
        $stmt->execute();
        $jisseki_rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $rows['keikaku_rows'] = $keikaku_rows;
        $rows['jisseki_rows'] = $jisseki_rows;

        return $response->setContent(json_encode($rows));
    }

    /**
     * 生産計画ガントチャート用のJSONを返却する
     *
     * @return \Phalcon\Http\Response|\Phalcon\Http\ResponseInterface
     */
    public function productionsPlanningChartAction()
    {
        header("Content-type: application/json; charset=UTF-8");
        $this->view->disable();
        $response = new \Phalcon\Http\Response();
        // post data
        $db = \Phalcon\DI::getDefault()->get('db');
        $model_cd = $this->request->getPost('model_cd');
        $supplier = $this->request->getPost('supplier');
        $start_date = $this->request->getPost('start_date');
        $end_date = $this->request->getPost('end_date');

        if ($model_cd === '') {
            $where_model_cd = '';
        } else {
            $where_model_cd = " AND b.h_kishu_mr_cd = '${$model_cd} '";
        }
        // TODO 実績のデータを入力する様になったら、完了率を表示出来るようにSQLも変更する
        $phql = "
            SELECT
                c.cd AS hacchuu_no,
                d.name AS kishu_mei,
                b.kaisi_hiduke AS start_date,
                b.shuuryou_hiduke AS end_date,
                b.shouhin_mr_cd AS shouhin_mr_cd,
                b.tekiyou AS tekiyou,
                d.irowake AS pColor,
                b.gouki AS gouki,
                '' AS pLink,
                '' AS pMile,
                b.shouhin_mr_cd AS shouhin_mr_cd,
                '' AS pComp,
                '0' AS pGroup,
                '' AS pParent,
                '0' AS pOpen,
                '' AS pDepend, 
                b.heiretu_suu AS pCaption
            FROM gyoumu_dts AS a
            LEFT JOIN gyoumu_meisai_dts AS b on a.id = b.gyoumu_dt_id
            LEFT JOIN hacchuu_dts AS c ON c.id = a.hacchuu_dt_id
            LEFT JOIN h_kishu_mrs AS d ON d.cd = b.h_kishu_mr_cd
            WHERE c.shiiresaki_mr_cd = '${supplier}' AND (b.kaisi_hiduke BETWEEN '${start_date}' AND '${end_date}')
            ${where_model_cd}
            AND b.h_kishu_mr_cd <> ''
            ORDER BY b.h_kishu_mr_cd
        ";

        $stmt = $db->prepare($phql);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $response->setContent(json_encode($rows));
    }


    /**
     * Excel出力
     *
     */
    public function chart_output_excelAction()
    {
        // post data
        $db = \Phalcon\DI::getDefault()->get('db');
        $model_cd = $this->request->getPost('model_cd');
        $supplier = $this->request->getPost('supplier');
        $start_date = $this->request->getPost('startDate');
        $end_date = $this->request->getPost('endDate');

        if ($model_cd === '') {
            $where_model_cd = '';
        } else {
            $where_model_cd = " AND b.h_kishu_mr_cd = '${$model_cd} '";
        }
        // TODO 実績のデータを入力する様になったら、完了率を表示出来るようにSQLも変更する
        $phql = "
                SELECT
                    c.cd AS hacchuu_no,
                    d.name AS kishu_mei,
                    b.kaisi_hiduke AS start_date,
                    b.shuuryou_hiduke AS end_date,
                    b.shouhin_mr_cd AS shouhin_mr_cd,
                    b.tekiyou AS tekiyou,
                    d.irowake AS pColor,
                    '' AS pLink,
                    '' AS pMile,
                    b.shouhin_mr_cd AS shouhin_mr_cd,
                    '' AS pComp,
                    '0' AS pGroup,
                    '' AS pParent,
                    '0' AS pOpen,
                    '' AS pDepend, 
                    b.heiretu_suu AS pCaption
                FROM gyoumu_dts AS a
                LEFT JOIN gyoumu_meisai_dts AS b on a.id = b.gyoumu_dt_id
                LEFT JOIN hacchuu_dts AS c ON c.id = a.hacchuu_dt_id
                LEFT JOIN h_kishu_mrs AS d ON d.cd = b.h_kishu_mr_cd
                WHERE c.shiiresaki_mr_cd = '${supplier}' AND (b.kaisi_hiduke BETWEEN '${start_date}' AND '${end_date}')
                ${where_model_cd}
                AND b.h_kishu_mr_cd <> ''
                ORDER BY b.h_kishu_mr_cd
            ";

        $stmt = $db->prepare($phql);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Excel出力用ライブラリ
        include __DIR__ . '/../vendor/PHPExcel/Classes/PHPExcel.php';
        include __DIR__ . '/../vendor/PHPExcel/Classes/PHPExcel/Writer/Excel5.php';
        include __DIR__ . '/../vendor/PHPExcel/Classes/PHPExcel/IOFactory.php';

        //テンプレート
        $objReader = PHPExcel_IOFactory::createReader('Excel5');
        $objReader->setIncludeCharts(TRUE);
        $temp_dir = __DIR__ . '/temp/'; // テンプレート
        $temp_path = $temp_dir . 'ganttChart.xls';
        $PHPExcel = $objReader->load($temp_path);

        $PHPExcel->setActiveSheetIndex(0);  // 0は最初のシート
        $sheet = $PHPExcel->getActiveSheet();
        $gyou = 2;
        $sheet->setCellValueByColumnAndRow(0, $gyou, '発注ナンバー');
        $sheet->setCellValueByColumnAndRow(1, $gyou, '機種名');
        $sheet->setCellValueByColumnAndRow(2, $gyou, '開始日');
        $sheet->setCellValueByColumnAndRow(3, $gyou, '終了日');
        $sheet->setCellValueByColumnAndRow(4, $gyou, '商品コード');
        $sheet->setCellValueByColumnAndRow(5, $gyou, '摘要');
        $sheet->setCellValueByColumnAndRow(6, $gyou, '色');
        $sheet->setCellValueByColumnAndRow(7, $gyou, 'リンク');
        $sheet->setCellValueByColumnAndRow(8, $gyou, 'マイルすとーん');
        $sheet->setCellValueByColumnAndRow(9, $gyou, '完了率');
        $sheet->setCellValueByColumnAndRow(10, $gyou, 'グループ');
        $sheet->setCellValueByColumnAndRow(11, $gyou, '親');
        $sheet->setCellValueByColumnAndRow(12, $gyou, 'オープンフラグ');
        $sheet->setCellValueByColumnAndRow(13, $gyou, 'タスクが依存するid');
        $sheet->setCellValueByColumnAndRow(14, $gyou, '錘数');

        for ($i = 1; $i < count($rows) + 1; $i++) {
            $sheet->setCellValueByColumnAndRow(0, $i + $gyou, $rows[$i -1]['hacchuu_no']);
            $sheet->setCellValueByColumnAndRow(1, $i + $gyou, $rows[$i -1]['kishu_mei']);
            $sheet->setCellValueByColumnAndRow(2, $i + $gyou, $rows[$i -1]['start_date']);
            $sheet->setCellValueByColumnAndRow(3, $i + $gyou, $rows[$i -1]['end_date']);
            $sheet->setCellValueByColumnAndRow(4, $i + $gyou, $rows[$i -1]['shouhin_mr_cd']);
            $sheet->setCellValueByColumnAndRow(5, $i + $gyou, $rows[$i -1]['tekiyou']);
            $sheet->setCellValueByColumnAndRow(6, $i + $gyou, $rows[$i -1]['pColor']);
            $sheet->setCellValueByColumnAndRow(7, $i + $gyou, $rows[$i -1]['pLink']);
            $sheet->setCellValueByColumnAndRow(8, $i + $gyou, $rows[$i -1]['pMile']);
            $sheet->setCellValueByColumnAndRow(9, $i + $gyou, $rows[$i -1]['pComp']);
            $sheet->setCellValueByColumnAndRow(10, $i + $gyou, $rows[$i -1]['pGroup']);
            $sheet->setCellValueByColumnAndRow(11, $i + $gyou, $rows[$i -1]['pParent']);
            $sheet->setCellValueByColumnAndRow(12, $i + $gyou, $rows[$i -1]['pOpen']);
            $sheet->setCellValueByColumnAndRow(13, $i + $gyou, $rows[$i -1]['pDepend']);
            $sheet->setCellValueByColumnAndRow(14, $i + $gyou, $rows[$i -1]['pCaption']);
        }

        // Excelファイルの保存 ------------------------------------------
        $PHPExcel->setActiveSheetIndex(1);  //1は印刷用のシート)

        //保存ファイル名
        $filename = uniqid("gantt_", true) . '.xls'; // ユニーク
        $filename1 = "gantt_" . '.xls'; // ユニークの必要はない

        // 保存ファイルパス
        $upload = __DIR__ . '/temp/';
        $path = $upload . $filename;

        $objWriter = PHPExcel_IOFactory::createWriter($PHPExcel, 'Excel5'); //2007形式で保存
        $objWriter->setIncludeCharts(TRUE);
        $objWriter->save($path);

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
}
