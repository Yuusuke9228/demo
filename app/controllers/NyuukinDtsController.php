<?php

class NyuukinDtsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        ControllerBase::indexCd("NyuukinDts", "入金伝票"); //簡易検索付き一覧表示
    }

    /**
     * モーダル
     */
    public function modalAction()
    {
        ControllerBase::indexCd("NyuukinDts", "入金伝票", "nyuukinbi DESC");
    }

    /**
     * Searches for nyuukin_dts
     */
    public function searchAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Displays the creation form
     */
    public function newAction($id = null, $dataname = "NyuukinDts")
    {
        $this->view->imax = 0;

        if ($id) {
            $nameDts = $dataname;
            $nyuukin_dt = $nameDts::findFirstByid($id);
            if (!$nyuukin_dt) {
                $this->flash->error("入金伝票が見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "nyuukin_dts",
                    'action' => 'index'
                ));

                return;
            }
            $this->_setDefault($nyuukin_dt, "new", $dataname);
            $this->tag->setDefault("id", null);
            $this->tag->setDefault("cd", null);
        }
        $readonly_ctlr = new ReadonlyFieldKbnsController();
        $this->view->readonlys = $readonly_ctlr->setFormFieldReadonlys('NyuukinDts', 'inputfields');
        $this->tag->setDefault("nyuukinbi", date("Y-m-d"));
        $this->tag->setDefault("sakusei_user_name", $this->getDI()->getSession()->get('auth')['name']);
        $this->tag->setDefault("updated", null);

    }

    /**
     * 修正画面から「次へ」ボタンを押したら次のコードの修正画面になる。
     */
    public function nextAction($id)
    {
        ControllerBase::nextCd($id, "nyuukin_dts", "NyuukinDts", "入金伝票");
    }

    /**
     * 修正画面から「前へ」ボタンを押したら前のコードの修正画面になる。
     */
    public function prevAction($id)
    {
        ControllerBase::prevCd($id, "nyuukin_dts", "NyuukinDts", "入金伝票");
    }

    /**
     * Edits a nyuukin_dt
     *
     * @param string $id
     */
    public function editAction($id)
    {
//        if (!$this->request->isPost()) {

        $nyuukin_dt = NyuukinDts::findFirstByid($id);
        if (!$nyuukin_dt) {
            $this->flash->error("入金伝票が見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "nyuukin_dts",
                'action' => 'index'
            ));

            return;
        }

        $readonly_ctlr = new ReadonlyFieldKbnsController();
        $this->view->readonlys = $readonly_ctlr->setFormFieldReadonlys('NyuukinDts', 'inputfields');
        $this->view->id = $nyuukin_dt->id;

        $this->_setDefault($nyuukin_dt, "edit");
//        }
    }

    /**
     * 画面に表示するデータをセットする
     */
    public function _setDefault($nyuukin_dt, $action = "edit", $meisai = "NyuukinMeisaiDts")
    {
        $setdts = ["id",
            "cd",
            "nendo",
            "name",
            "nyuukinbi",
            "seikyuusaki_mr_cd",
            "tantou_mr_cd",
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
            if (property_exists($nyuukin_dt, $setdt)) {
                $this->tag->setDefault($setdt, $nyuukin_dt->$setdt);
            }
        }
        $this->tag->setDefault("sakusei_user_name", $nyuukin_dt->SakuseiUsers->name);
        $this->tag->setDefault("seikyuusaki_mr_name", $nyuukin_dt->SeikyuusakiMrs->name);
        $this->tag->setDefault("harai_houhou_kbn_cd", $nyuukin_dt->SeikyuusakiMrs->harai_houhou_kbn_cd);
        $this->tag->setDefault("harai_saikuru_kbn_cd", $nyuukin_dt->SeikyuusakiMrs->harai_saikuru_kbn_cd);
        $this->tag->setDefault("haraibi", $nyuukin_dt->SeikyuusakiMrs->haraibi);
        $this->tag->setDefault("tesuuryou_hutan_kbn_cd", $nyuukin_dt->SeikyuusakiMrs->tesuuryou_hutan_kbn_cd);
        $this->tag->setDefault("shimegrp_kbn_cd", $nyuukin_dt->SeikyuusakiMrs->shimegrp_kbn_cd);
        $this->tag->setDefault("zenkai_kesikomi_gaku", number_format($nyuukin_dt->zenkai_kesikomi_gaku));
        $this->tag->setDefault("konkai_kesikomi_kei", 0);
        // ここから入金明細
        $setmss = ["id", "cd", "name", "nyuukin_kbn_cd", "bikou", "updated"];
        $i = 0;
        foreach ($nyuukin_dt->$meisai as $meisai_dt) {
            foreach ($setmss as $setms) {
                $this->tag->setDefault("data[nyuukin_meisai_dts][" . $i . "][" . $setms . "]", $meisai_dt->$setms);
            }
            if ($action == "new") {
                $this->tag->setDefault("data[nyuukin_meisai_dts][" . $i . "][id]", null);
            }
            $this->tag->setDefault("data[nyuukin_meisai_dts][" . $i . "][cd]", $i + 1);//行番を振りなおす
            $this->tag->setDefault("data[nyuukin_meisai_dts][" . $i . "][tegata_kijitu]", ($meisai_dt->tegata_kijitu == "0000-00-00") ? "" : $meisai_dt->tegata_kijitu);
            $this->tag->setDefault("data[nyuukin_meisai_dts][" . $i . "][kingaku]", number_format($meisai_dt->kingaku));
            $i++;
        }
        $this->view->imax = $i;
    }

    /**
     * Creates a new nyuukin_dt
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "nyuukin_dts",
                'action' => 'index'
            ));

            return;
        }

        $nyuukin_dt = new NyuukinDts();

        $post_flds = [
            "cd",
            "nendo",
            "name",
            "nyuukinbi",
            "seikyuusaki_mr_cd",
            "tantou_mr_cd",
            "zenkai_kesikomi_gaku",
        ];

        $meisai_flds = [
            "cd",
            "nyuukin_kbn_cd",
            "name",
            "tegata_kijitu",
            "kingaku",
            "bikou",
        ];

        $meisai_nums = ["kingaku"];

        $thisPost = []; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        $thisPost["zenkai_kesikomi_gaku"] = str_replace(',', '', $this->request->getPost("konkai_kesikomi_kei"));
        foreach ($post_flds as $post_fld) {
            $nyuukin_dt->$post_fld = array_key_exists($post_fld, $thisPost) ? $thisPost[$post_fld] : $this->request->getPost($post_fld);
        }

        $meisai = $this->request->getPost("data");

        $meisaicnv = array();
        $nyuukin_dt->NyuukinMeisaiDts = array();
        $NyuukinMeisaiDts = array();
        $i = 0;

        foreach ($meisai["nyuukin_meisai_dts"] as $nyuukin_meisai_dt) {
            if ($nyuukin_meisai_dt["cd"] !== '' && $nyuukin_meisai_dt["cd"] !== '0' && $nyuukin_meisai_dt["nyuukin_kbn_cd"] !== '') {
                $meisaicnv[$i] = [];
                foreach ($meisai_nums as $meisai_num) {
                    $meisaicnv[$i][$meisai_num] = str_replace(',', '', $nyuukin_meisai_dt[$meisai_num]);//カンマ除去
                }
                $meisaicnv[$i]['tegata_kijitu'] = $nyuukin_meisai_dt['tegata_kijitu'] == '' ? '0000-00-00' : $nyuukin_meisai_dt['tegata_kijitu'];//手形期日なしの時に'0000-00-00'
                $NyuukinMeisaiDts[$i] = new NyuukinMeisaiDts();
                foreach ($meisai_flds as $meisai_fld) {
                    $NyuukinMeisaiDts[$i]->$meisai_fld = array_key_exists($meisai_fld, $meisaicnv[$i]) ? $meisaicnv[$i][$meisai_fld] : $nyuukin_meisai_dt[$meisai_fld] ?? '';
                    //更新日時や更新者はModelに定義してある
                }


                $i++;
            }
        }
        $nyuukin_dt->NyuukinMeisaiDts = $NyuukinMeisaiDts;

        /* 伝票番号付番または再設定 */
        $den_ban_ctrl = new DenpyouBangouMrsController(); //伝票番号マスタコントローラ
        $nendo_ban = $den_ban_ctrl->countup('nyuukin', $nyuukin_dt->cd, $nyuukin_dt->nyuukinbi);
        if (!$nendo_ban['nendo']) {
            $this->flash->error("エラー:年度が未登録（日付が今年か昨年以外は不可）。" . $nyuukin_dt->nyuukinbi);
            $this->dispatcher->forward(array(
                'controller' => "nyuukin_dts",
                'action' => 'edit',
                'params' => array($nyuukin_dt->id)
            ));
        }

        $nyuukin_dt->cd = $nendo_ban['bangou'];
        $nyuukin_dt->nendo = $nendo_ban['nendo'];

        if (!$nyuukin_dt->save()) {
            foreach ($nyuukin_dt->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "nyuukin_dts",
                'action' => 'new'
            ));

            return;
        }

        $this->_kesikomi($meisai["kesikomi"], $this->request->getPost('meisai_flg'));

        $this->flash->success("入金伝票の作成が完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "nyuukin_dts",
            'action' => 'new',
            //'params' => array($nyuukin_dt->id)
        ));
    }

    /**
     * Saves a nyuukin_dt edited
     *
     */
    public function saveAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "nyuukin_dts",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $nyuukin_dt = NyuukinDts::findFirstByid($id);

        if (!$nyuukin_dt) {
            $this->flash->error("入金伝票が見つからなくなりました。" . $id);

            $this->dispatcher->forward(array(
                'controller' => "nyuukin_dts",
                'action' => 'index'
            ));

            return;
        }

        if ($nyuukin_dt->updated !== $this->request->getPost("updated")) {
            $this->flash->error("他のプロセスから入金伝票が変更されたため更新を中止しました。"
                . $id . ",uid=" . $nyuukin_dt->kousin_user_id . " tb=" . $nyuukin_dt->updated . " pt=" . $this->request->getPost("updated"));

            $this->dispatcher->forward(array(
                'controller' => "nyuukin_dts",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $post_flds = [
            "cd",
            "name",
            "nyuukinbi",
            "seikyuusaki_mr_cd",
            "tantou_mr_cd",
            "zenkai_kesikomi_gaku",
        ];

        $meisai_flds = [
            "cd",
            "nyuukin_kbn_cd",
            "name",
            "tegata_kijitu",
            "kingaku",
            "bikou",
        ];

        $meisai_nums = ["kingaku"];

        $thisPost = []; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        $thisPost["zenkai_kesikomi_gaku"] = (int)str_replace(',', '', $this->request->getPost("zenkai_kesikomi_gaku")) + (int)str_replace(',', '', $this->request->getPost("konkai_kesikomi_kei"));
        $meisai = $this->request->getPost("data");

        $i = 0;
        foreach ($meisai["nyuukin_meisai_dts"] as $nyuukin_meisai_dt) {
            if ((int)$nyuukin_meisai_dt["id"] !== 0) {
                if ((int)$nyuukin_dt->NyuukinMeisaiDts[$i]->id !== (int)$nyuukin_meisai_dt["id"] ||
                    $nyuukin_dt->NyuukinMeisaiDts[$i]->updated !== $nyuukin_meisai_dt["updated"]) {
                    $this->flash->error("他のプロセスから売上伝票明細が変更されたため中止しました。"
                        . $id . ",id=" . $nyuukin_dt->NyuukinMeisaiDts[$i]->id . ",uid=" . $nyuukin_dt->NyuukinMeisaiDts[$i]->kousin_user_id
                        . " tb=" . $nyuukin_dt->NyuukinMeisaiDts[$i]->updated . " pt=" . $nyuukin_meisai_dt["updated"]);

                    $this->dispatcher->forward(array(
                        'controller' => "nyuukin_dts",
                        'action' => 'index'
                    ));

                    return;
                }
            }
            $i++;
        }

        $chg_flg = 0;
        foreach ($post_flds as $post_fld) {
            if ((array_key_exists($post_fld, $thisPost) ? $thisPost[$post_fld] : $this->request->getPost($post_fld)) !== $nyuukin_dt->$post_fld) {
                $chg_flg = 1;
                break;
            }
        }
        echo
        $meisaicnv = array();
        $chg_flgs = array();
        $i = 0;
        foreach ($meisai["nyuukin_meisai_dts"] as $nyuukin_meisai_dt) {
            $meisaicnv[$i] = [];
            foreach ($meisai_nums as $meisai_num) {
                $meisaicnv[$i][$meisai_num] = (double)str_replace(',', '', $nyuukin_meisai_dt[$meisai_num]);//カンマ除去
            }
            $meisaicnv[$i]['tegata_kijitu'] = $nyuukin_meisai_dt['tegata_kijitu'] == '' ? '0000-00-00' : $nyuukin_meisai_dt['tegata_kijitu'];//手形期日なしの時に'0000-00-00'
            $chg_flgs[$i] = 0;//変更ないかも
            if (((int)$nyuukin_meisai_dt["cd"] === 0) && (int)$nyuukin_meisai_dt["id"] !== 0) { // 削除の条件
                $chg_flg = 1;
                $chg_flgs[$i] = 2;//削除
            } else if ((int)$nyuukin_meisai_dt["id"] === 0) { // echo ($nyuukin_meisai_dt["id"] === "")?"null":"0";//nullの伝わり方
                if ((int)$nyuukin_meisai_dt["kingaku"] !== 0) {
                    $chg_flg = 1;
                    $chg_flgs[$i] = 1;
                }
            } else if ((int)$nyuukin_meisai_dt["cd"] !== 0) {
                foreach ($meisai_flds as $meisai_fld) {
                    if ((array_key_exists($meisai_fld, $meisaicnv[$i]) ? $meisaicnv[$i][$meisai_fld] : $nyuukin_meisai_dt[$meisai_fld]) . '' !== $nyuukin_dt->NyuukinMeisaiDts[$i]->$meisai_fld) {
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
                "controller" => "nyuukin_dts",
                "action" => "edit",
                "params" => array($nyuukin_dt->id)
            ));

            return;
        }
        $this->_bakOut($nyuukin_dt);

        foreach ($post_flds as $post_fld) {
            $nyuukin_dt->$post_fld = array_key_exists($post_fld, $thisPost) ? $thisPost[$post_fld] : $this->request->getPost($post_fld);
        }
        /* 伝票番号付番または再設定 */
        $den_ban_ctrl = new DenpyouBangouMrsController(); //伝票番号マスタコントローラ
        $nendo_ban = $den_ban_ctrl->countup('nyuukin', $nyuukin_dt->cd, $nyuukin_dt->nyuukinbi, $nyuukin_dt->nendo);
        if (!$nendo_ban['nendo']) {
            $this->flash->error("エラー:年度が未登録（日付が今年か昨年以外は不可）。" . $nyuukin_dt->nyuukinbi);
            $this->dispatcher->forward(array(
                'controller' => "nyuukin_dts",
                'action' => 'edit',
                'params' => array($id)
            ));
        }
        $nyuukin_dt->cd = $nendo_ban['bangou'];
        $nyuukin_dt->nendo = $nendo_ban['nendo'];
        $i = 0;
        foreach ($meisai["nyuukin_meisai_dts"] as $nyuukin_meisai_dt) {
            if ($chg_flgs[$i] === 2) { // 削除でないとき
                $meisai_ctlr = new NyuukinMeisaiDtsController();
                $meisai_ctlr->deleteAction($nyuukin_meisai_dt["id"]);
            } else {
                if ((int)$nyuukin_meisai_dt["id"] !== 0) {
                    $NyuukinMeisaiDts[$i] = $nyuukin_dt->NyuukinMeisaiDts[$i];
                }
                if ($chg_flgs[$i] === 1) { // 更新なら
                    if ((int)$nyuukin_meisai_dt["id"] === 0) {
                        $NyuukinMeisaiDts[$i] = new NyuukinMeisaiDts();
                    } else {
                        $meisai_ctlr = new NyuukinMeisaiDtsController();
                        $meisai_ctlr->_bakOut($NyuukinMeisaiDts[$i], 0, $chg_flgs);
                    }
                    foreach ($meisai_flds as $meisai_fld) {
                        $NyuukinMeisaiDts[$i]->$meisai_fld = array_key_exists($meisai_fld, $meisaicnv[$i]) ? $meisaicnv[$i][$meisai_fld] : $nyuukin_meisai_dt[$meisai_fld] ?? '';
                        //更新日時や更新者はModelに定義してある
                    }
                }
            }
            $i++;
        }
        $nyuukin_dt->NyuukinMeisaiDts = $NyuukinMeisaiDts; // 明細データをドッキング

        if (!$nyuukin_dt->save()) {

            foreach ($nyuukin_dt->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "nyuukin_dts",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }
        //echo "\n<br><pre>";print_r($meisai["kesikomi"]);echo "</pre>";return;
        $this->_kesikomi($meisai["kesikomi"], $this->request->getPost("meisai_flg"));

        $this->flash->success("入金伝票の情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "nyuukin_dts",
            'action' => 'edit',
            'params' => array($nyuukin_dt->id)
        ));
    }

    private function _kesikomi($kesikomi, $meisai_flg)
    {
        if ($meisai_flg === '0') { // 伝票毎
            foreach ($kesikomi as $id) {
                $uriage_dt = UriageDts::findFirstByid($id["chk"]);
                foreach ($uriage_dt->UriageMeisaiDts as $uriage_meisai_dt) {

                    if (!$uriage_meisai_dt->NyuukinKesikomiDts->id && (float)$uriage_meisai_dt->zeinukigaku + (float)$uriage_meisai_dt->zeigaku !== 0) { // 新規
                        $nyuukin_kesikomi_dt = new NyuukinKesikomiDts();
                        $nyuukin_kesikomi_dt->uriage_meisai_dt_id = $uriage_meisai_dt->id;
                        $nyuukin_kesikomi_dt->kesikomi_gaku = $uriage_meisai_dt->zeinukigaku + $uriage_meisai_dt->zeigaku;
                        if (!$nyuukin_kesikomi_dt->save()) {
                            foreach ($nyuukin_kesikomi_dt->getMessages() as $message) {
                                $this->flash->error($message);
                            }
                        }
                    } else if ($uriage_meisai_dt->NyuukinKesikomiDts->kesikomi_gaku !== (float)$uriage_meisai_dt->zeinukigaku + (float)$uriage_meisai_dt->zeigaku) { // 変更
                        $nyuukin_kesikomi_dt = $uriage_meisai_dt->NyuukinKesikomiDts;

                        $nyuukin_kesikomi_dt->kesikomi_gaku = $uriage_meisai_dt->zeinukigaku + $uriage_meisai_dt->zeigaku;
                        if (!$nyuukin_kesikomi_dt->save()) {
                            foreach ($nyuukin_kesikomi_dt->getMessages() as $message) {
                                $this->flash->error($message);
                            }
                        }
                    }
                }
            }
        } else { // 伝票明細毎
            foreach ($kesikomi as $id) {
                $uriage_meisai_dt = UriageMeisaiDts::findFirstByid($id['chk']);
                $nyuukin_kesikomi_dt = new NyuukinKesikomiDts();
                if ($uriage_meisai_dt) {
                    if (!$uriage_meisai_dt->NyuukinKesikomiDts->id && (float)$uriage_meisai_dt->zeinukigaku + (float)$uriage_meisai_dt->zeigaku !== 0) { // 新規
                        //$nyuukin_kesikomi_dt = new NyuukinKesikomiDts();
                        $nyuukin_kesikomi_dt->uriage_meisai_dt_id = $uriage_meisai_dt->id;
                        $nyuukin_kesikomi_dt->kesikomi_gaku = (float)$uriage_meisai_dt->zeinukigaku + (float)$uriage_meisai_dt->zeigaku;
                        if (!$nyuukin_kesikomi_dt->save()) {
                            foreach ($nyuukin_kesikomi_dt->getMessages() as $message) {
                                $this->flash->error($message);
                            }
                        }
                    } else if ($nyuukin_kesikomi_dt->kesikomi_gaku !== $uriage_meisai_dt->zeinukigaku + $uriage_meisai_dt->zeigaku) { // 変更
                        $nyuukin_kesikomi_dt = $uriage_meisai_dt->NyuukinKesikomiDts;
                        $nyuukin_kesikomi_dt->kesikomi_gaku = $uriage_meisai_dt->zeinukigaku + $uriage_meisai_dt->zeigaku;
                        if (!$nyuukin_kesikomi_dt->save()) {
                            foreach ($nyuukin_kesikomi_dt->getMessages() as $message) {
                                $this->flash->error($message);
                            }
                        }
                    }
                }
            }
        }
    }

    /**
     * Deletes a nyuukin_dt
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $nyuukin_dt = NyuukinDts::findFirstByid($id);
        if (!$nyuukin_dt) {
            $this->flash->error("入金伝票が見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "nyuukin_dts",
                'action' => 'index'
            ));

            return;
        }

        $this->_bakOut($nyuukin_dt, 1);

        if (!$nyuukin_dt->delete()) {

            foreach ($nyuukin_dt->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "nyuukin_dts",
                'action' => 'search'
            ));

            return;
        }

        $this->flash->success("入金伝票の削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "nyuukin_dts",
            'action' => "index"
        ));
    }

    /**
     * Back Out a nyuukin_dt
     *
     * @param array $nyuukin_dt
     * @param integer $dlt_flg
     * @param array $chg_flgs
     */
    public function _bakOut($nyuukin_dt, $dlt_flg = 0, $chg_flgs = [])
    {
        $bak_nyuukin_dt = new BakNyuukinDts();
        foreach ($nyuukin_dt as $fld => $value) {
            $bak_nyuukin_dt->$fld = $nyuukin_dt->$fld;
        }
        $bak_nyuukin_dt->id = NULL;
        $bak_nyuukin_dt->id_moto = $nyuukin_dt->id;
        $bak_nyuukin_dt->hikae_dltflg = $dlt_flg;
        $bak_nyuukin_dt->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_nyuukin_dt->hikae_nichiji = date("Y-m-d H:i:s");
        if (!$bak_nyuukin_dt->save()) {
            foreach ($bak_nyuukin_dt->getMessages() as $message) {
                $this->flash->error($message);
            }
        }

        $meisai_ctlr = new NyuukinMeisaiDtsController();
        $i = 0;
        foreach ($nyuukin_dt->NyuukinMeisaiDts as $nyuukin_meisai_dt) {
            if ($dlt_flg === 1 || $chg_flgs[$i] === 1) { // 更新なしは不要、削除は別に出ている、親から削除のときはここで出す
                $meisai_ctlr->_bakOut($nyuukin_meisai_dt, $dlt_flg);
            }
            $i++;
        }
    }

    public function ajaxGetAction()
    {
        $this->view->disable();

        //Create a response instance
        $response = new \Phalcon\Http\Response();
        // 年度取得
        $nendo = Konnnenndo::findFirst(["kikan_from <= ?0 AND kikan_to >= ?0", "bind" => [0 => $this->request->getPost('nyuukinbi')]]);
        $nyuukin_dts = NyuukinDts::find(array(
            'order' => 'id desc',
            'conditions' => ' cd = ?1 AND nendo = ?2 ',
            'bind' => [1 => $this->request->getPost('cd'), 2 => (int)$nendo->cd]
        ));
        return $response->setContent(json_encode($nyuukin_dts));
        $res_flds = [
            "id",
            "cd",
            "nendo",
            "name",
            "nyuukinbi",
            "seikyuusaki_mr_cd",
            "tantou_mr_cd",
            "sakusei_user_id",
            "created",
            "kousin_user_id",
            "updated",
        ];
        $meisai_flds = [
            "nyuukin_kbn_cd",
            "name",
            "tegata_kijitu",
            "kingaku",
            "zeiritu_mr_cd",
            "bikou",
        ];
        $resData = array();
        foreach ($nyuukin_dts as $nyuukin_dt) {
            $resAdata = array();
            foreach ($res_flds as $res_fld) {
                $resAdata[$res_fld] = $nyuukin_dt->$res_fld;
            }
            foreach ($nyuukin_dt->NyuukinMeisaiDts as $nyuukin_meisai_dt) {
                foreach ($meisai_flds as $meisai_fld) {
                    $resAdata["meisai"][$nyuukin_meisai_dt->cd][$meisai_fld] = $nyuukin_meisai_dt->$meisai_fld;
                }
            }
            $resData[] = $resAdata;
        }

        //Set the content of the response
        $response->setContent(json_encode($resData));

        //Return the response
        return $response;
    }

    /*
     * 売掛残高一覧表 Add By Nishiyama
     */
    public function urikake_zandakaAction()
    {
        $db = \Phalcon\DI::getDefault()->get('db');
        $post_flds = [
            "cd",
            "torihiki_kbn_betu_flg",
            "junjo_kbn_cd",
            "koujun_flg",
            "hanni_from",
            "hanni_to",
            "kikan_sitei_kbn_cd",
            "kikan_from",
            "kikan_to",
            "zeikomi_flg",
            "meisaigyou_flg",
            "goukeigyou_flg",
            "jinyuuryoku_flg",
            "torihikiari_flg",
            "torihikinasi_flg",
            "hokakei_flg",
            "zennnen_flg"
        ];
        $setdts = [];
        $thisPost = [];
        if (!$this->request->isPost()) {
            foreach ($post_flds as $post_fld) {
                $setdts[$post_fld] = "";
            }
            $setdts["cd"] = "01";
            $setdts["torihiki_kbn_betu_flg"] = 0;
            $setdts["junjo_kbn_cd"] = "3502"; // 請求先(得意先)
            $setdts["koujun_flg"] = 0;
            $setdts["kikan_sitei_kbn_cd"] = "3507"; // 今月
            $setdts["kikan_from"] = date('Y-m-01');
            $setdts["kikan_to"] = date('Y-m-t');
            $setdts["zeikomi_flg"] = 0;
            $setdts["meisaigyou_flg"] = 1;
            $setdts["goukeigyou_flg"] = 1;
            $setdts["jinyuuryoku_flg"] = 0;
            $setdts["torihikiari_flg"] = 1;
            $setdts["torihikinasi_flg"] = 0;
            $setdts["hokakei_flg"] = 0;
            $setdts["zennnen_flg"] = 0;
        } else {
            foreach ($post_flds as $post_fld) {
                $setdts[$post_fld] = array_key_exists($post_fld, $thisPost) ? $thisPost[$post_fld] : $this->request->getPost($post_fld);
            }
        }

        $junjo_kbn = JunjoKbns::findFirst(["conditions" => "cd = ?1", "bind" => ["1" => $setdts["junjo_kbn_cd"]]]);
        foreach ($setdts as $fld => $setdt) {
            $this->tag->setDefault($fld, $setdt);
        }

        $where = " WHERE ";
        if ($setdts['hanni_from'] === '') {
            $setdts["hanni_from"] = '0000';
        }
        if ($setdts['hanni_to'] === '') {
            $setdts['hanni_to'] = 'ZZZZ';
        }
        switch ($setdts["junjo_kbn_cd"]) {
            case '3502':    //請求先
                $where .= "t.cd BETWEEN '" . $setdts['hanni_from'] . "' AND '" . $setdts['hanni_to'] . "'";
                break;
            case '3503':    //請求先分類1
                $where .= "t.tokuisaki_bunrui1_kbn_cd BETWEEN '" . $setdts['hanni_from'] . "' AND '" . $setdts['hanni_to'] . "'";
                break;
            case '3504':    //請求先分類2
                $where .= "t.tokuisaki_bunrui2_kbn_cd BETWEEN '" . $setdts['hanni_from'] . "' AND '" . $setdts['hanni_to'] . "'";
                break;
            case '3505':    //請求先分類3
                $where .= "t.tokuisaki_bunrui3_kbn_cd BETWEEN '" . $setdts['hanni_from'] . "' AND '" . $setdts['hanni_to'] . "'";
                break;
            case '3506':    //請求先分類4
                $where .= "t.tokuisaki_bunrui4_kbn_cd BETWEEN '" . $setdts['hanni_from'] . "' AND '" . $setdts['hanni_to'] . "'";
                break;
            case '3507':    //請求先分類5
                $where .= "t.tokuisaki_bunrui5_kbn_cd BETWEEN '" . $setdts['hanni_from'] . "' AND '" . $setdts['hanni_to'] . "'";
                break;
            case '3508':    //請求先主担当
                $where .= "t.tantou_mr_cd BETWEEN '" . $setdts['hanni_from'] . "' AND '" . $setdts['hanni_to'] . "'";
                break;
        }

        if ($setdts['koujun_flg'] !== '1') {
            $order = " ORDER BY t.cd ASC";
        } else {
            $order = " ORDER BY t.cd DESC";
        }

        $gessho = $setdts["kikan_from"];
        $getsumatsu = $setdts["kikan_to"];

        $phql = "
            SELECT
                t.cd AS tokuisaki_mr_cd, t.name AS name,
                t.tokuisaki_bunrui1_kbn_cd AS bunrui1, t.tokuisaki_bunrui2_kbn_cd AS bunrui2, 
                t.tokuisaki_bunrui3_kbn_cd AS bunrui3, t.tokuisaki_bunrui4_kbn_cd AS bunrui4, 
                t.tokuisaki_bunrui5_kbn_cd AS bunrui5, t.tantou_mr_cd AS tantou_mr_cd,
                COALESCE(um_zeinukigaku, 0) AS um_zeinukigaku,
                COALESCE(um_zeigaku, 0) AS um_zeigaku, 
                COALESCE(um_tou_zeinukigaku, 0) AS um_tou_zeinukigaku,
                COALESCE(um_tou_zeigaku, 0) AS um_tou_zeigaku,
                COALESCE(nm_nyuukingaku, 0) AS nm_nyuukingaku, 
                COALESCE(nm_tou_nyuukingaku, 0) AS nm_tou_nyuukingaku, 
                COALESCE(nm_genkin, 0) AS nm_genkin, 
                COALESCE(nm_hurikomi, 0) AS nm_hurikomi, 
                COALESCE(nm_tesuuryou, 0) AS nm_tesuuryou, 
                COALESCE(nm_tegata, 0) AS nm_tegata, 
                COALESCE(nm_sonota, 0) AS nm_sonota
            FROM tokuisaki_mrs AS t
            LEFT JOIN 
            (
                SELECT 
                    u.tokuisaki_mr_cd, 
                    SUM(IF(u.uriagebi >= '{$gessho}' ,um.zeinukigaku, 0)) AS um_tou_zeinukigaku, 
                    SUM(IF(u.uriagebi >= '{$gessho}' ,um.zeigaku, 0)) AS um_tou_zeigaku,
                    SUM(um.zeinukigaku) AS um_zeinukigaku,
                    SUM(um.zeigaku) AS um_zeigaku
                FROM uriage_dts AS u
                LEFT JOIN uriage_meisai_dts AS um ON um.uriage_dt_id = u.id
                WHERE u.uriagebi <= '{$getsumatsu}'
                GROUP BY u.tokuisaki_mr_cd
            ) AS umt ON umt.tokuisaki_mr_cd = t.cd
            LEFT JOIN 
            (
                SELECT 
                    n.seikyuusaki_mr_cd, 
                    SUM(IF(n.nyuukinbi >= '{$gessho}' ,nm.kingaku, 0)) AS nm_tou_nyuukingaku,
                    SUM(CASE WHEN nm.nyuukin_kbn_cd LIKE '1%' THEN 
                        (CASE WHEN n.nyuukinbi >= '{$gessho}' THEN nm.kingaku ELSE 0 END) 
                        ELSE 0 END) AS nm_genkin,
                    SUM(CASE WHEN nm.nyuukin_kbn_cd LIKE '2%' THEN 
                        (CASE WHEN n.nyuukinbi >= '{$gessho}' THEN nm.kingaku ELSE 0 END) 
                        ELSE 0 END) AS nm_hurikomi,
                    SUM(CASE WHEN nm.nyuukin_kbn_cd LIKE '3%' THEN
                        (CASE WHEN n.nyuukinbi >= '{$gessho}' THEN nm.kingaku ELSE 0 END) 
                        ELSE 0 END) AS nm_tesuuryou,
                    SUM(CASE WHEN nm.nyuukin_kbn_cd LIKE '4%' THEN 
                        (CASE WHEN n.nyuukinbi >= '{$gessho}' THEN nm.kingaku ELSE 0 END) 
                        ELSE 0 END) AS nm_tegata,
                    SUM(CASE WHEN nm.nyuukin_kbn_cd LIKE '5%' THEN 
                        (CASE WHEN n.nyuukinbi >= '{$gessho}' THEN nm.kingaku ELSE 0 END) 
                        ELSE 0 END) AS nm_sonota,
                    sum(nm.kingaku) AS nm_nyuukingaku
                FROM nyuukin_dts AS n
                LEFT JOIN nyuukin_meisai_dts AS nm ON nm.nyuukin_dt_id = n.id
                WHERE n.nyuukinbi <= '{$getsumatsu}'
                GROUP BY n.seikyuusaki_mr_cd
            ) AS nmt ON nmt.seikyuusaki_mr_cd = t.seikyuusaki_mr_cd
            {$where} {$order} 
        ";
        $stmt = $db->prepare($phql);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        for ($i = 0; $i < count($rows); $i++) {
            $rows[$i]['zengetsumatsu_zan'] =
                (((int)$rows[$i]['um_zeinukigaku'] + (int)$rows[$i]['um_zeigaku']) -
                    ((int)$rows[$i]['um_tou_zeinukigaku'] + (int)$rows[$i]['um_tou_zeigaku'])) -
                ((int)$rows[$i]['nm_nyuukingaku'] - (int)$rows[$i]['nm_tou_nyuukingaku']);
            $rows[$i]['tougetsumatsu_zan'] =
                ((int)$rows[$i]['um_zeinukigaku'] + (int)$rows[$i]['um_zeigaku']) - (int)$rows[$i]['nm_nyuukingaku'];
            $rows[$i]['tougetu_kakeuriage'] =
                (int)$rows[$i]['um_tou_zeinukigaku'] + (int)$rows[$i]['um_tou_zeigaku'];
        }

        // 現在条件保存は行っていないが一応使える様にしておく
        $jouken_urikake_zandakas = JoukenUrikakeZandakas::find(["order" => "cd, sakusei_user_id"
            , "conditions" => "sakusei_user_id IN(0, ?0)"
            , "bind" => [0 => $this->getDI()->getSession()->get('auth')['id']]
        ]);
        $joukens = [];
        foreach ($jouken_urikake_zandakas as $jouken_urikake_zandaka) {
            $joukens[$jouken_urikake_zandaka->cd] = $jouken_urikake_zandaka->name;
        }

        $this->view->rows = $rows;
        $this->view->joukens = $joukens;
        return;
    }
}
