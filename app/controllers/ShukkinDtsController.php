<?php

class ShukkinDtsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        ControllerBase::indexCd("ShukkinDts", "出金伝票"); //簡易検索付き一覧表示
    }

    /**
     * モーダル
     */
    public function modalAction()
    {
        ControllerBase::indexCd("ShukkinDts", "出金伝票", "shukkinbi DESC");
    }

    /**
     * Searches for shukkin_dts
     */
    public function searchAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Displays the creation form
     */
    public function newAction($id = null, $dataname = "ShukkinDts")
    {
        $this->view->imax = 0;

        if ($id) {
            $nameDts = $dataname;
            $shukkin_dt = $nameDts::findFirstByid($id);
            if (!$shukkin_dt) {
                $this->flash->error("出金伝票が見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "shukkin_dts",
                    'action' => 'index'
                ));

                return;
            }
            $this->_setDefault($shukkin_dt, "new", $dataname);
            $this->tag->setDefault("id", null);
            $this->tag->setDefault("cd", null);
        }
        $this->tag->setDefault("shukkinbi", date("Y-m-d"));
        $this->tag->setDefault("sakusei_user_name", $this->getDI()->getSession()->get('auth')['name']);
        $this->tag->setDefault("updated", null);

    }

    /**
     * 修正画面から「次へ」ボタンを押したら次のコードの修正画面になる。
     */
    public function nextAction($id)
    {
        ControllerBase::nextCd($id, "shukkin_dts", "ShukkinDts", "出金伝票");
    }

    /**
     * 修正画面から「前へ」ボタンを押したら前のコードの修正画面になる。
     */
    public function prevAction($id)
    {
        ControllerBase::prevCd($id, "shukkin_dts", "ShukkinDts", "出金伝票");
    }

    /**
     * Edits a shukkin_dt
     *
     * @param string $id
     */
    public function editAction($id)
    {
//        if (!$this->request->isPost()) {

        $shukkin_dt = ShukkinDts::findFirstByid($id);
        if (!$shukkin_dt) {
            $this->flash->error("出金伝票が見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "shukkin_dts",
                'action' => 'index'
            ));

            return;
        }

        $this->view->id = $shukkin_dt->id;

        $this->_setDefault($shukkin_dt, "edit");
//        }
        $readonly_ctlr = new ReadonlyFieldKbnsController();
        $this->view->readonlys = $readonly_ctlr->setFormFieldReadonlys('ShukkinDts', 'inputfields');
    }

    /**
     * 画面に表示するデータをセットする
     */
    public function _setDefault($shukkin_dt, $action = "edit", $meisai = "ShukkinMeisaiDts")
    {
        $setdts = ["id",
            "cd",
            "nendo",
            "name",
            "shukkinbi",
            "shiiresaki_mr_cd",
            "tantou_mr_cd",
            "zenkai_kesikomi_gaku",
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
            if (property_exists($shukkin_dt, $setdt)) {
                $this->tag->setDefault($setdt, $shukkin_dt->$setdt);
            }
        }
        $this->tag->setDefault("sakusei_user_name", $shukkin_dt->SakuseiUsers->name);
        $this->tag->setDefault("shiiresaki_mr_name", $shukkin_dt->ShiiresakiMrs->name);
        $this->tag->setDefault("harai_houhou_kbn_cd", $shukkin_dt->ShiiresakiMrs->harai_houhou_kbn_cd);
        $this->tag->setDefault("harai_saikuru_kbn_cd", $shukkin_dt->ShiiresakiMrs->harai_saikuru_kbn_cd);
        $this->tag->setDefault("haraibi", $shukkin_dt->ShiiresakiMrs->haraibi);
        $this->tag->setDefault("tesuuryou_hutan_kbn_cd", $shukkin_dt->ShiiresakiMrs->tesuuryou_hutan_kbn_cd);
        $this->tag->setDefault("shimegrp_kbn_cd", $shukkin_dt->ShiiresakiMrs->shimegrp_kbn_cd);
        $this->tag->setDefault("zenkai_kesikomi_gaku", number_format($shukkin_dt->zenkai_kesikomi_gaku));
        $this->tag->setDefault("konkai_kesikomi_kei", 0);
        // ここから入金明細
        $setmss = ["id", "cd", "name", "shiharai_kbn_cd", "bikou", "updated"];
        $i = 0;
        foreach ($shukkin_dt->$meisai as $meisai_dt) {
            foreach ($setmss as $setms) {
                $this->tag->setDefault("data[shukkin_meisai_dts][" . $i . "][" . $setms . "]", $meisai_dt->$setms);
            }
            if ($action == "new") {
                $this->tag->setDefault("data[shukkin_meisai_dts][" . $i . "][id]", null);
            }
            $this->tag->setDefault("data[shukkin_meisai_dts][" . $i . "][cd]", $i + 1);//行番を振りなおす
            $this->tag->setDefault("data[shukkin_meisai_dts][" . $i . "][tegata_kijitu]", ($meisai_dt->tegata_kijitu == "0000-00-00") ? "" : $meisai_dt->tegata_kijitu);
            $this->tag->setDefault("data[shukkin_meisai_dts][" . $i . "][kingaku]", number_format($meisai_dt->kingaku));
            $i++;
        }
        $this->view->imax = $i;
    }

    /**
     * Creates a new shukkin_dt
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "shukkin_dts",
                'action' => 'index'
            ));

            return;
        }

        $shukkin_dt = new ShukkinDts();

        $post_flds = [];
        $post_flds = ["cd",
            "nendo",
            "name",
            "shukkinbi",
            "shiiresaki_mr_cd",
            "tantou_mr_cd",
            "zenkai_kesikomi_gaku",
            "updated",
        ];

        $meisai_flds = ["cd",
            "shiharai_kbn_cd",
            "name",
            "tegata_kijitu",
            "kingaku",
            "bikou",
        ];

        $meisai_nums = ["kingaku"];

        $thisPost = []; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        $thisPost["zenkai_kesikomi_gaku"] = str_replace(',', '', $this->request->getPost("konkai_kesikomi_kei"));
        foreach ($post_flds as $post_fld) {
            $shukkin_dt->$post_fld = array_key_exists($post_fld, $thisPost) ? $thisPost[$post_fld] : $this->request->getPost($post_fld);
        }

        $meisai = $this->request->getPost("data");

        $meisaicnv = array();
        $shukkin_dt->ShukkinMeisaiDts = array();
        $ShukkinMeisaiDts = array();
        $i = 0;

        foreach ($meisai["shukkin_meisai_dts"] as $shukkin_meisai_dt) {
            if ($shukkin_meisai_dt["cd"] !== '' && $shukkin_meisai_dt["cd"] !== '0' && $shukkin_meisai_dt["shiharai_kbn_cd"] !== '') {
                $meisaicnv[$i] = [];
                foreach ($meisai_nums as $meisai_num) {
                    $meisaicnv[$i][$meisai_num] = str_replace(',', '', $shukkin_meisai_dt[$meisai_num]);//カンマ除去
                }
                $meisaicnv[$i]['tegata_kijitu'] = $shukkin_meisai_dt['tegata_kijitu'] === '' ? '0000-00-00 00:00:00' : $shukkin_meisai_dt['tegata_kijitu'];//手形期日なしの時に'0000-00-00'
                $ShukkinMeisaiDts[$i] = new ShukkinMeisaiDts();
                foreach ($meisai_flds as $meisai_fld) {
                    $ShukkinMeisaiDts[$i]->$meisai_fld = array_key_exists($meisai_fld, $meisaicnv[$i]) ? $meisaicnv[$i][$meisai_fld] : $shukkin_meisai_dt[$meisai_fld] ?? '';
                    //更新日時や更新者はModelに定義してある
                }
                $i++;
            }
        }
        $shukkin_dt->ShukkinMeisaiDts = $ShukkinMeisaiDts;

        /* 伝票番号付番または再設定 */
        $den_ban_ctrl = new DenpyouBangouMrsController(); //伝票番号マスタコントローラ
        $nendo_ban = $den_ban_ctrl->countup('shukkin', $shukkin_dt->cd, $shukkin_dt->shukkinbi);
        if (!$nendo_ban['nendo']) {
            $this->flash->error("エラー:年度が未登録（日付が今年か昨年以外は不可）。" . $shukkin_dt->shukkinbi);
            $this->dispatcher->forward(array(
                'controller' => "shukkin_dts",
                'action' => 'edit',
                'params' => array($shukkin_dt->id)
            ));
        }
        $shukkin_dt->cd = $nendo_ban['bangou'];
        $shukkin_dt->nendo = $nendo_ban['nendo'];

        if (!$shukkin_dt->save()) {
            foreach ($shukkin_dt->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "shukkin_dts",
                'action' => 'new'
            ));

            return;
        }
        $this->_kesikomi($meisai["kesikomi"], $this->request->getPost('meisai_flg'));

        $this->flash->success("出金伝票の作成が完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "shukkin_dts",
            'action' => 'new',
//            'action' => 'edit',
//            'params' => array($shukkin_dt->id)
        ));
    }

    /**
     * Saves a shukkin_dt edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "shukkin_dts",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $shukkin_dt = ShukkinDts::findFirstByid($id);

        if (!$shukkin_dt) {
            $this->flash->error("出金伝票が見つからなくなりました。" . $id);

            $this->dispatcher->forward(array(
                'controller' => "shukkin_dts",
                'action' => 'index'
            ));

            return;
        }

        if ($shukkin_dt->updated !== $this->request->getPost("updated")) {
            $this->flash->error("他のプロセスから出金伝票が変更されたため更新を中止しました。"
                . $id . ",uid=" . $shukkin_dt->kousin_user_id . " tb=" . $shukkin_dt->updated . " pt=" . $this->request->getPost("updated"));

            $this->dispatcher->forward(array(
                'controller' => "shukkin_dts",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $post_flds = ["cd",
            "nendo",
            "name",
            "shukkinbi",
            "shiiresaki_mr_cd",
            "tantou_mr_cd",
            "zenkai_kesikomi_gaku",
            "updated",
        ];

        $meisai_flds = ["cd",
            "shiharai_kbn_cd",
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
        foreach ($meisai["shukkin_meisai_dts"] as $shukkin_meisai_dt) {
            if ((int)$shukkin_meisai_dt["id"] !== 0) {
                if ((int)$shukkin_dt->ShukkinMeisaiDts[$i]->id !== (int)$shukkin_meisai_dt["id"] ||
                    $shukkin_dt->ShukkinMeisaiDts[$i]->updated !== $shukkin_meisai_dt["updated"]) {
                    $this->flash->error("他のプロセスから売上伝票明細が変更されたため中止しました。"
                        . $id . ",id=" . $shukkin_dt->ShukkinMeisaiDts[$i]->id . ",uid=" . $shukkin_dt->ShukkinMeisaiDts[$i]->kousin_user_id
                        . " tb=" . $shukkin_dt->ShukkinMeisaiDts[$i]->updated . " pt=" . $shukkin_meisai_dt["updated"]);

                    $this->dispatcher->forward(array(
                        'controller' => "shukkin_dts",
                        'action' => 'index'
                    ));

                    return;
                }
            }
            $i++;
        }

        $chg_flg = 0;
        foreach ($post_flds as $post_fld) {
            if ((array_key_exists($post_fld, $thisPost) ? $thisPost[$post_fld] : $this->request->getPost($post_fld)) !== $shukkin_dt->$post_fld) {
                $chg_flg = 1;
                break;
            }
        }

        $meisaicnv = array();
        $chg_flgs = array();
        $i = 0;
        foreach ($meisai["shukkin_meisai_dts"] as $shukkin_meisai_dt) {
            $meisaicnv[$i] = [];
            foreach ($meisai_nums as $meisai_num) {
                $meisaicnv[$i][$meisai_num] = (double)str_replace(',', '', $shukkin_meisai_dt[$meisai_num]);//カンマ除去
            }
            $meisaicnv[$i]['tegata_kijitu'] = $shukkin_meisai_dt['tegata_kijitu'] === '' ? '0000-00-00 00:00:00' : $shukkin_meisai_dt['tegata_kijitu'];//手形期日なしの時に'0000-00-00'
            $chg_flgs[$i] = 0;//変更ないかも
            if (((int)$shukkin_meisai_dt["cd"] === 0) && (int)$shukkin_meisai_dt["id"] !== 0) { // 削除の条件
                $chg_flg = 1;
                $chg_flgs[$i] = 2;//削除
            } else if ((int)$shukkin_meisai_dt["id"] === 0) { // echo ($shukkin_meisai_dt["id"] === "")?"null":"0";//nullの伝わり方
                if ((int)$shukkin_meisai_dt["kingaku"] !== 0) {
                    $chg_flg = 1;
                    $chg_flgs[$i] = 1;
                }
            } else if ((int)$shukkin_meisai_dt["cd"] !== 0) {
                foreach ($meisai_flds as $meisai_fld) {
                    if ((array_key_exists($meisai_fld, $meisaicnv[$i]) ? $meisaicnv[$i][$meisai_fld] : $shukkin_meisai_dt[$meisai_fld]) . '' !== $shukkin_dt->ShukkinMeisaiDts[$i]->$meisai_fld) {
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
                "controller" => "shukkin_dts",
                "action" => "edit",
                "params" => array($shukkin_dt->id)
            ));

            return;
        }

        $this->_bakOut($shukkin_dt);

        foreach ($post_flds as $post_fld) {
            $shukkin_dt->$post_fld = array_key_exists($post_fld, $thisPost) ? $thisPost[$post_fld] : $this->request->getPost($post_fld);
        }
        /* 伝票番号付番または再設定 */
        $den_ban_ctrl = new DenpyouBangouMrsController(); //伝票番号マスタコントローラ
        $nendo_ban = $den_ban_ctrl->countup('shukkin', $shukkin_dt->cd, $shukkin_dt->shukkinbi, $shukkin_dt->nendo);
        if (!$nendo_ban['nendo']) {
            $this->flash->error("エラー:年度が未登録（日付が今年か昨年以外は不可）。" . $shukkin_dt->shukkinbi);
            $this->dispatcher->forward(array(
                'controller' => "shukkin_dts",
                'action' => 'edit',
                'params' => array($id)
            ));
        }
        $shukkin_dt->cd = $nendo_ban['bangou'];
        $shukkin_dt->nendo = $nendo_ban['nendo'];
        $i = 0;
        foreach ($meisai["shukkin_meisai_dts"] as $shukkin_meisai_dt) {
            if ($chg_flgs[$i] === 2) { // 削除でないとき
                $meisai_ctlr = new ShukkinMeisaiDtsController();
                $meisai_ctlr->deleteAction($shukkin_meisai_dt["id"]);
            } else {
                if ((int)$shukkin_meisai_dt["id"] !== 0) {
                    $ShukkinMeisaiDts[$i] = $shukkin_dt->ShukkinMeisaiDts[$i];
                }
                if ($chg_flgs[$i] === 1) { // 更新なら
                    if ((int)$shukkin_meisai_dt["id"] === 0) {
                        $ShukkinMeisaiDts[$i] = new ShukkinMeisaiDts();
                    } else {
                        $meisai_ctlr = new ShukkinMeisaiDtsController();
                        $meisai_ctlr->_bakOut($ShukkinMeisaiDts[$i]);
                    }
                    foreach ($meisai_flds as $meisai_fld) {
                        $ShukkinMeisaiDts[$i]->$meisai_fld = array_key_exists($meisai_fld, $meisaicnv[$i]) ? $meisaicnv[$i][$meisai_fld] : $shukkin_meisai_dt[$meisai_fld] ?? '';
                        //更新日時や更新者はModelに定義してある
                    }
                }
            }
            $i++;
        }
        $shukkin_dt->ShukkinMeisaiDts = $ShukkinMeisaiDts; // 明細データをドッキング

        if (!$shukkin_dt->save()) {

            foreach ($shukkin_dt->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "shukkin_dts",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }
        $this->_kesikomi($meisai["kesikomi"], $this->request->getPost("meisai_flg"));

        $this->flash->success("出金伝票の情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "shukkin_dts",
            'action' => 'edit',
            'params' => array($shukkin_dt->id)
        ));
    }

    private function _kesikomi($kesikomi, $meisai_flg = 0)
    {
//        echo '<pre>',var_dump($kesikomi), '</pre>';
//        exit;
        if ($meisai_flg == 0) { // 伝票毎
            foreach ($kesikomi as $id) {
                $shiire_dt = ShiireDts::findFirstByid($id["chk"]);
                foreach ($shiire_dt->ShiireMeisaiDts as $shiire_meisai_dt) {
                    if (!$shiire_meisai_dt->ShukkinKesikomiDts->id && (float)$shiire_meisai_dt->zeinukigaku + (float)$shiire_meisai_dt->zeigaku !== 0) { // 新規
                        $shukkin_kesikomi_dt = new ShukkinKesikomiDts();
                        $shukkin_kesikomi_dt->shiire_meisai_dt_id = $shiire_meisai_dt->id;
                        $shukkin_kesikomi_dt->kesikomi_gaku = $shiire_meisai_dt->zeinukigaku + $shiire_meisai_dt->zeigaku;
                        if (!$shukkin_kesikomi_dt->save()) {
                            foreach ($shukkin_kesikomi_dt->getMessages() as $message) {
                                $this->flash->error($message);
                            }
                        }
                    } else if ($shiire_meisai_dt->ShukkinKesikomiDts->kesikomi_gaku !== (float)$shiire_meisai_dt->zeinukigaku + (float)$shiire_meisai_dt->zeigaku) { // 変更
                        $shukkin_kesikomi_dt = $shiire_meisai_dt->ShukkinKesikomiDts;
                        $shukkin_kesikomi_dt->kesikomi_gaku = $shiire_meisai_dt->zeinukigaku + $shiire_meisai_dt->zeigaku;
                        if (!$shukkin_kesikomi_dt->save()) {
                            foreach ($shukkin_kesikomi_dt->getMessages() as $message) {
                                $this->flash->error($message);
                            }
                        }
                    }
                }
            }
        } else { // 伝票明細毎
            foreach ($kesikomi as $id) {
                $shiire_meisai_dt = ShiireMeisaiDts::findFirstByid($id["chk"]);
                if ($shiire_meisai_dt) {
                    if (!$shiire_meisai_dt->ShukkinKesikomiDts->id && (float)$shiire_meisai_dt->zeinukigaku + (float)$shiire_meisai_dt->zeigaku !== 0) { // 新規
                        $shukkin_kesikomi_dt = new ShukkinKesikomiDts();
                        $shukkin_kesikomi_dt->shiire_meisai_dt_id = $shiire_meisai_dt->id;
                        $shukkin_kesikomi_dt->kesikomi_gaku = $shiire_meisai_dt->zeinukigaku + $shiire_meisai_dt->zeigaku;
                        if (!$shukkin_kesikomi_dt->save()) {
                            foreach ($shukkin_kesikomi_dt->getMessages() as $message) {
                                $this->flash->error($message);
                            }
                        }
                    } else if ($shiire_meisai_dt->ShukkinKesikomiDts->kesikomi_gaku !== (float)$shiire_meisai_dt->zeinukigaku + (float)$shiire_meisai_dt->zeigaku) { // 変更
                        $shukkin_kesikomi_dt = $shiire_meisai_dt->ShukkinKesikomiDts;
                        $shukkin_kesikomi_dt->kesikomi_gaku = $shiire_meisai_dt->zeinukigaku + $shiire_meisai_dt->zeigaku;
                        if (!$shukkin_kesikomi_dt->save()) {
                            foreach ($shukkin_kesikomi_dt->getMessages() as $message) {
                                $this->flash->error($message);
                            }
                        }
                    }
                }
            }
        }
    }

    /**
     * Deletes a shukkin_dt
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $shukkin_dt = ShukkinDts::findFirstByid($id);
        if (!$shukkin_dt) {
            $this->flash->error("出金伝票が見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "shukkin_dts",
                'action' => 'index'
            ));

            return;
        }

        $this->_bakOut($shukkin_dt, 1);

        if (!$shukkin_dt->delete()) {

            foreach ($shukkin_dt->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "shukkin_dts",
                'action' => 'search'
            ));

            return;
        }

        $this->flash->success("出金伝票の削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "shukkin_dts",
            'action' => "index"
        ));
    }

    /**
     * Back Out a shukkin_dt
     *
     * @param string $shukkin_dt , $dlt_flg
     */
    public function _bakOut($shukkin_dt, $dlt_flg = 0)
    {

        $bak_shukkin_dt = new BakShukkinDts();
        foreach ($shukkin_dt as $fld => $value) {
            $bak_shukkin_dt->$fld = $shukkin_dt->$fld;
        }
        $bak_shukkin_dt->id = NULL;
        $bak_shukkin_dt->id_moto = $shukkin_dt->id;
        $bak_shukkin_dt->hikae_dltflg = $dlt_flg;
        $bak_shukkin_dt->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_shukkin_dt->hikae_nichiji = date("Y-m-d H:i:s");
        if (!$bak_shukkin_dt->save()) {
            foreach ($bak_shukkin_dt->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
    }

    public function ajaxGetAction()
    {
        $this->view->disable();
        $response = new \Phalcon\Http\Response();

        // 年度取得
        $nendo = Konnnenndo::findFirst(["kikan_from <= ?0 AND kikan_to >= ?0", "bind" => [0 => $this->request->getPost('shukkinbi')]]);
        $shukkin_dts = ShukkinDts::find([
            'order' => 'id desc',
            'conditions' => ' cd = ?1 AND nendo = ?2',
            'bind' => [1 => $this->request->getPost('cd'), 2 => (int)$nendo->cd]
        ]);
        $res_flds = [
            "id",
            "cd",
            "nendo",
            "name",
            "shukkinbi",
            "shiiresaki_mr_cd",
            "tantou_mr_cd",
            "sakusei_user_id",
            "created",
            "kousin_user_id",
            "updated",
        ];
        $meisai_flds = [
            "shiharai_kbn_cd",
            "name",
            "tegata_kijitu",
            "kingaku",
            "zeiritu_mr_cd",
            "bikou",
        ];
        $resData = array();
        foreach ($shukkin_dts as $shukkin_dt) {
            $resAdata = array();
            foreach ($res_flds as $res_fld) {
                $resAdata[$res_fld] = $shukkin_dt->$res_fld;
            }
            foreach ($shukkin_dt->ShukkinMeisaiDts as $shukkin_meisai_dt) {
                foreach ($meisai_flds as $meisai_fld) {
                    $resAdata["meisai"][$shukkin_meisai_dt->cd][$meisai_fld] = $shukkin_meisai_dt->$meisai_fld;
                }
            }
            $resData[] = $resAdata;
        }
        $response->setContent(json_encode($resData));
        return $response;
    }

    /*
     * 買いかけ残高一覧表 Add By Nishiyama
     */
    public function kaikake_zandakaAction()
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
            $setdts["junjo_kbn_cd"] = "4502"; // 仕入先
            $setdts["koujun_flg"] = 0;
            $setdts["kikan_sitei_kbn_cd"] = "4507"; // 今月
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
            case '4502':    //仕入先
                $where .= "s.cd BETWEEN '" . $setdts['hanni_from'] . "' AND '" . $setdts['hanni_to'] . "'";
                break;
            case '4503':    //仕入先分類1
                $where .= "s.shiiresaki_bunrui1_kbn_cd BETWEEN '" . $setdts['hanni_from'] . "' AND '" . $setdts['hanni_to'] . "'";
                break;
            case '4504':    //仕入先分類2
                $where .= "s.shiiresaki_bunrui2_kbn_cd BETWEEN '" . $setdts['hanni_from'] . "' AND '" . $setdts['hanni_to'] . "'";
                break;
            case '4505':    //仕入先分類3
                $where .= "s.shiiresaki_bunrui3_kbn_cd BETWEEN '" . $setdts['hanni_from'] . "' AND '" . $setdts['hanni_to'] . "'";
                break;
            case '4506':    //仕入先分類4
                $where .= "s.shiiresaki_bunrui4_kbn_cd BETWEEN '" . $setdts['hanni_from'] . "' AND '" . $setdts['hanni_to'] . "'";
                break;
            case '4507':    //仕入先分類5
                $where .= "s.shiiresaki_bunrui5_kbn_cd BETWEEN '" . $setdts['hanni_from'] . "' AND '" . $setdts['hanni_to'] . "'";
                break;
            case '4508':    //仕入先主担当
                $where .= "s.tantou_mr_cd BETWEEN '" . $setdts['hanni_from'] . "' AND '" . $setdts['hanni_to'] . "'";
                break;
        }

        if ($setdts['koujun_flg'] !== '1') {
            $order = " ORDER BY s.cd ASC";
        } else {
            $order = " ORDER BY s.cd DESC";
        }

        $gessho = $setdts["kikan_from"];
        $getsumatsu = $setdts["kikan_to"];
        $phql = "
            SELECT
                s.cd AS shiiresaki_mr_cd, s.name AS name,
                s.shiiresaki_bunrui1_kbn_cd AS bunrui1, s.shiiresaki_bunrui2_kbn_cd AS bunrui2, 
                s.shiiresaki_bunrui3_kbn_cd AS bunrui3, s.shiiresaki_bunrui4_kbn_cd AS bunrui4, 
                s.shiiresaki_bunrui5_kbn_cd AS bunrui5, s.tantou_mr_cd AS tantou_mr_cd,
                COALESCE(sm_zeinukigaku, 0) AS sm_zeinukigaku,
                COALESCE(sm_zeigaku, 0) AS sm_zeigaku, 
                COALESCE(sm_tou_zeinukigaku, 0) AS sm_tou_zeinukigaku,
                COALESCE(sm_tou_zeigaku, 0) AS sm_tou_zeigaku,
                COALESCE(shm_shukkingaku, 0) AS shm_shukkingaku, 
                COALESCE(shm_tou_shukkingaku, 0) AS shm_tou_shukkingaku, 
                COALESCE(shm_genkin, 0) AS shm_genkin, 
                COALESCE(shm_hurikomi, 0) AS shm_hurikomi, 
                COALESCE(shm_tesuuryou, 0) AS shm_tesuuryou, 
                COALESCE(shm_tegata, 0) AS shm_tegata, 
                COALESCE(shm_sonota, 0) AS shm_sonota
            FROM shiiresaki_mrs AS s
            LEFT JOIN 
            (
                SELECT 
                    s.shiiresaki_mr_cd, 
                    SUM(IF(s.shiirebi >= '{$gessho}' ,sm.zeinukigaku, 0)) AS sm_tou_zeinukigaku, 
                    SUM(IF(s.shiirebi >= '{$gessho}' ,sm.zeigaku, 0)) AS sm_tou_zeigaku,
                    SUM(sm.zeinukigaku) AS sm_zeinukigaku,
                    SUM(sm.zeigaku) AS sm_zeigaku
                FROM shiire_dts AS s
                LEFT JOIN shiire_meisai_dts AS sm ON sm.shiire_dt_id = s.id
                WHERE s.shiirebi <= '{$getsumatsu}'
                GROUP BY s.shiiresaki_mr_cd
            ) AS smt ON smt.shiiresaki_mr_cd = s.cd
            LEFT JOIN 
            (
                SELECT 
                    sh.shiiresaki_mr_cd, 
                    SUM(IF(sh.shukkinbi >= '{$gessho}' ,shm.kingaku, 0)) AS shm_tou_shukkingaku,
                    SUM(CASE WHEN shm.shiharai_kbn_cd  LIKE '1%' THEN 
                        (CASE WHEN sh.shukkinbi >= '{$gessho}' THEN shm.kingaku ELSE 0 END) 
                        ELSE 0 END) AS shm_genkin,
                    SUM(CASE WHEN shm.shiharai_kbn_cd  LIKE '2%' THEN 
                        (CASE WHEN sh.shukkinbi >= '{$gessho}' THEN shm.kingaku ELSE 0 END) 
                        ELSE 0 END) AS shm_hurikomi,
                    SUM(CASE WHEN shm.shiharai_kbn_cd  LIKE '3%' THEN
                        (CASE WHEN sh.shukkinbi >= '{$gessho}' THEN shm.kingaku ELSE 0 END) 
                        ELSE 0 END) AS shm_tesuuryou,
                    SUM(CASE WHEN shm.shiharai_kbn_cd  LIKE '4%' THEN 
                        (CASE WHEN sh.shukkinbi >= '{$gessho}' THEN shm.kingaku ELSE 0 END) 
                        ELSE 0 END) AS shm_tegata,
                    SUM(CASE WHEN shm.shiharai_kbn_cd  LIKE '5%' THEN 
                        (CASE WHEN sh.shukkinbi >= '{$gessho}' THEN shm.kingaku ELSE 0 END) 
                        ELSE 0 END) AS shm_sonota,
                    sum(shm.kingaku) AS shm_shukkingaku
                FROM shukkin_dts AS sh
                LEFT JOIN shukkin_meisai_dts AS shm ON shm.shukkin_dt_id = sh.id
                WHERE sh.shukkinbi <= '{$getsumatsu}'
                GROUP BY sh.shiiresaki_mr_cd
            ) AS shmt ON shmt.shiiresaki_mr_cd = s.cd
            {$where} {$order} 
        ";

        $stmt = $db->prepare($phql);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        for ($i = 0; $i < count($rows); $i++) {
            $rows[$i]['zengetsumatsu_zan'] =
                (((int)$rows[$i]['sm_zeinukigaku'] + (int)$rows[$i]['sm_zeigaku']) -
                    ((int)$rows[$i]['sm_tou_zeinukigaku'] + (int)$rows[$i]['sm_tou_zeigaku'])) -
                ((int)$rows[$i]['shm_shukkingaku'] - (int)$rows[$i]['shm_tou_shukkingaku']);
            $rows[$i]['tougetsumatsu_zan'] =
                ((int)$rows[$i]['sm_zeinukigaku'] + (int)$rows[$i]['sm_zeigaku']) - (int)$rows[$i]['shm_shukkingaku'];
            $rows[$i]['tougetu_kakeuriage'] =
                (int)$rows[$i]['sm_tou_zeinukigaku'] + (int)$rows[$i]['sm_tou_zeigaku'];
        }

        //@TODO 現在条件保存は行っていないが一応使える様にしておく
        $jouken_kaikake_zandakas = JoukenKaikakeZandakas::find(["order" => "cd, sakusei_user_id"
            , "conditions" => "sakusei_user_id IN(0, ?0)"
            , "bind" => [0 => $this->getDI()->getSession()->get('auth')['id']]
        ]);
        $joukens = [];
        foreach ($jouken_kaikake_zandakas as $jouken_kaikake_zandaka) {
            $joukens[$jouken_kaikake_zandaka->cd] = $jouken_kaikake_zandaka->name;
        }

        $this->view->rows = $rows;
        $this->view->joukens = $joukens;
        return;
    }
}
