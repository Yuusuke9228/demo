<?php

class TokuisakiMrsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        ControllerBase::indexCd("TokuisakiMrs", "得意先台帳");
    }

    /**
     * モーダル
     */
    public function modalAction()
    {
        ControllerBase::indexCd("TokuisakiMrs", "得意先台帳");
    }

    /**
     * Searches for tokuisaki_mrs
     */
    public function searchAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * 修正画面から「次へ」ボタンを押したら次のコードの修正画面になる。
     */
    public function nextAction($id)
    {
        ControllerBase::nextCd($id, "tokuisaki_mrs", "TokuisakiMrs", "得意先台帳");
    }

    /**
     * 修正画面から「前へ」ボタンを押したら前のコードの修正画面になる。
     */
    public function prevAction($id = 0)
    {
        ControllerBase::prevCd($id, "tokuisaki_mrs", "TokuisakiMrs", "得意先台帳");
    }

    /**
     * Displays the creation form
     */
    public function newAction($id = null, $dataname = "Tokuisaki")
    {

        if ($id) {
            $nameMrs = $dataname . "Mrs";
            $tokuiksaki_mr = $nameMrs::findFirstByid($id);
            if (!$tokuiksaki_mr) {
                $this->flash->error($dataname . "台帳が見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "tokuiksaki_mrs",
                    'action' => 'index'
                ));

                return;
            }
            $this->_setDefault($tokuiksaki_mr, "new", $dataname);
            $this->tag->setDefault("id", null);
            $this->tag->setDefault("cd", "?" . $tokuiksaki_mr->cd);   //変数名間違え訂正 西山 3/22
            $this->tag->setDefault("kake_zandaka", 0);
            $this->tag->setDefault("sakusei_user_id", null);
            $this->tag->setDefault("created", null);
            $this->tag->setDefault("kousin_user_id", null);
            $this->tag->setDefault("updated", null);
        } else {
            $this->tag->setDefault("kakeritu", 100); // 掛率=100%
            $this->tag->setDefault("torihiki_kbn_cd", 1); // 取引区分=掛売上
            $this->tag->setDefault("tanka_shurui_kbn_cd", 1); // 単価種類=上代
            $this->tag->setDefault("gaku_hasuu_shori_kbn_cd", 1); // 金額端数処理=切り捨て
            $this->tag->setDefault("zei_hasuu_shori_kbn_cd", 1); // 税端数処理=切り捨て
            $this->tag->setDefault("zei_tenka_kbn_cd", 10); // 税転嫁=外税/伝票計
            $this->tag->setDefault("harai_saikuru_kbn_cd", 1); // 回収サイクル=当月
            $this->tag->setDefault("tesuuryou_hutan_kbn_cd", 1); // 手数料負担区分=当方負担
        }
    }

    /**
     * Edits a tokuisaki_mr
     *
     * @param string $id
     */
    public function editAction($id)
    {
        if (!$this->request->isPost()) {

            $tokuisaki_mr = TokuisakiMrs::findFirstByid($id);
            if (!$tokuisaki_mr) {
                $this->flash->error("得意先マスタが見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "tokuisaki_mrs",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->id = $tokuisaki_mr->id;

            $this->_setDefault($tokuisaki_mr, "edit");
        }
    }

    /**
     * 画面に表示するデータをセットする
     */
    public function _setDefault($tokuisaki_mr, $action = "edit", $meisai = "Tokuisaki")
    {
        $setdts = [
            "id",
            "cd",
            "name",
            "kana",
            "ryakushou",
            "shiiresaki_mr_cd",
            "yuubin_bangou",
            "juusho1",
            "juusho2",
            "bushomei",
            "yakushoku",
            "gotantousha",
            "keishou",
            "tel",
            "fax",
            "email",
            "homepage",
            "tantou_mr_cd",
            "torihiki_kbn_cd",
            "tanka_shurui_kbn_cd",
            "kakeritu",
            "seikyuusaki_mr_cd",
            "shimegrp_kbn_cd",
            "gaku_hasuu_shori_kbn_cd",
            "zei_hasuu_shori_kbn_cd",
            "zei_tenka_kbn_cd",
            "yoshin_gendogaku",
            "kake_zandaka",
            "harai_houhou_kbn_cd",
            "harai_saikuru_kbn_cd",
            "haraibi",
            "tesuuryou_hutan_kbn_cd",
            "tegata_sight",
            "shitei_uriden_kbn_cd",
            "shitei_seikyuusho_kbn_cd",
            "atena_lavel",
            "kigyou_code",
            "seikyuusho_gassan_mr_cd",
            "tokuisaki_bunrui1_kbn_cd",
            "tokuisaki_bunrui2_kbn_cd",
            "tokuisaki_bunrui3_kbn_cd",
            "tokuisaki_bunrui4_kbn_cd",
            "tokuisaki_bunrui5_kbn_cd",
            "sanshou_hyouji",
            "memo",
            "id_moto",
            "hikae_dltflg",
            "hikae_user_id",
            "hikae_nichiji",
            "sakusei_user_id",
            "created",
            "kousin_user_id",
            "updated"
        ];
        foreach ($setdts as $setdt) {
            if (property_exists($tokuisaki_mr, $setdt)) {
                $this->tag->setDefault($setdt, $tokuisaki_mr->$setdt);
            }
        }
        if (property_exists($tokuisaki_mr, "seikyuusaki_mr_cd")) {
            $this->tag->setDefault("seikyuusaki_mr_name", $tokuisaki_mr->seikyuusaki_mr_cd == '' ? '' : $tokuisaki_mr->SeikyuusakiMrs->name);
        }
        if (property_exists($tokuisaki_mr, "seikyuusaki_mr_cd") && $tokuisaki_mr->seikyuusaki_mr_cd == $tokuisaki_mr->cd) {
            $urikake_zandaka = $tokuisaki_mr->kake_zandaka
                + $this->uriage_ruikeigaku($tokuisaki_mr->seikyuusaki_mr_cd)
                - $this->nyuukin_ruikeigaku($tokuisaki_mr->seikyuusaki_mr_cd);
            $this->tag->setDefault("urikake_zandaka", number_format($urikake_zandaka));
        }
    }

    /**
     * Creates a new tokuisaki_mr
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "tokuisaki_mrs",
                'action' => 'index'
            ));

            return;
        }

        $tokuisaki_mr = new TokuisakiMrs();
        $post_flds = [
            "cd", "name", "kana", "ryakushou", "shiiresaki_mr_cd", "yuubin_bangou", "juusho1", "juusho2", "bushomei", "yakushoku", "gotantousha", "keishou", "tel", "fax", "email", "homepage", "tantou_mr_cd", "torihiki_kbn_cd", "tanka_shurui_kbn_cd", "kakeritu", "seikyuusaki_mr_cd", "shimegrp_kbn_cd", "gaku_hasuu_shori_kbn_cd", "zei_hasuu_shori_kbn_cd", "zei_tenka_kbn_cd", "yoshin_gendogaku", "kake_zandaka", "harai_houhou_kbn_cd", "harai_saikuru_kbn_cd", "haraibi", "tesuuryou_hutan_flg", "tegata_sight", "shitei_uriden_kbn_cd", "shitei_seikyuusho_kbn_cd", "atena_lavel", "kigyou_code", "seikyuusho_gassan_mr_cd", "tokuisaki_bunrui1_kbn_cd", "tokuisaki_bunrui2_kbn_cd", "tokuisaki_bunrui3_kbn_cd", "tokuisaki_bunrui4_kbn_cd", "tokuisaki_bunrui5_kbn_cd", "sanshou_hyouji", "memo", "updated",
        ];
        foreach ($post_flds as $post_fld) {
            $tokuisaki_mr->$post_fld = $this->request->getPost($post_fld);
        }
        if (!$this->request->getPost('seikyuusaki_mr_cd')) { // 請求先がないと得意先元帳に表示されないので追加2019/3/29井浦
            $tokuisaki_mr->seikyuusaki_mr_cd = $this->request->getPost('cd');
        }


        if (!$tokuisaki_mr->save()) {
            foreach ($tokuisaki_mr->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "tokuisaki_mrs",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("得意先マスタの作成が完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "tokuisaki_mrs",
            'action' => 'edit',
            'params' => array($tokuisaki_mr->id)
        ));
    }

    /**
     * Saves a tokuisaki_mr edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "tokuisaki_mrs",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $tokuisaki_mr = TokuisakiMrs::findFirstByid($id);

        if (!$tokuisaki_mr) {
            $this->flash->error("得意先マスタが見つからなくなりました。" . $id);

            $this->dispatcher->forward(array(
                'controller' => "tokuisaki_mrs",
                'action' => 'index'
            ));

            return;
        }

        $post_flds = [
            "cd", "name", "kana", "ryakushou", "shiiresaki_mr_cd", "yuubin_bangou", "juusho1", "juusho2", "bushomei", "yakushoku", "gotantousha", "keishou", "tel", "fax", "email", "homepage", "tantou_mr_cd", "torihiki_kbn_cd", "tanka_shurui_kbn_cd", "kakeritu", "seikyuusaki_mr_cd", "shimegrp_kbn_cd", "gaku_hasuu_shori_kbn_cd", "zei_hasuu_shori_kbn_cd", "zei_tenka_kbn_cd", "yoshin_gendogaku", "kake_zandaka", "harai_houhou_kbn_cd", "harai_saikuru_kbn_cd", "haraibi", "tesuuryou_hutan_flg", "tegata_sight", "shitei_uriden_kbn_cd", "shitei_seikyuusho_kbn_cd", "atena_lavel", "kigyou_code", "seikyuusho_gassan_mr_cd", "tokuisaki_bunrui1_kbn_cd", "tokuisaki_bunrui2_kbn_cd", "tokuisaki_bunrui3_kbn_cd", "tokuisaki_bunrui4_kbn_cd", "tokuisaki_bunrui5_kbn_cd", "sanshou_hyouji", "memo", "updated",
        ];
        $chg_flg = 0;
        foreach ($post_flds as $post_fld) {
            if ($tokuisaki_mr->$post_fld != $this->request->getPost($post_fld)) {
                $chg_flg = 1;
                break;
            }
        }
        if ($chg_flg === 0) {
            $this->flash->error("変更がありません。" . $id);

            $this->dispatcher->forward(array(
                "controller" => "tokuisaki_mrs",
                "action" => "edit",
                "params" => array($tokuisaki_mr->id)
            ));

            return;
        }

        $this->_bakOut($tokuisaki_mr);

        foreach ($post_flds as $post_fld) {
            $tokuisaki_mr->$post_fld = $this->request->getPost($post_fld);
        }


        if (!$tokuisaki_mr->save()) {

            foreach ($tokuisaki_mr->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "tokuisaki_mrs",
                'action' => 'edit',
                'params' => array($tokuisaki_mr->id)
            ));

            return;
        }

        $this->flash->success("得意先マスタの情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "tokuisaki_mrs",
            'action' => 'edit',
            'params' => array($id)
        ));
    }

    /**
     * Deletes a tokuisaki_mr
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $tokuisaki_mr = TokuisakiMrs::findFirstByid($id);
        if (!$tokuisaki_mr) {
            $this->flash->error("得意先マスタが見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "tokuisaki_mrs",
                'action' => 'index'
            ));

            return;
        }

        if (!$tokuisaki_mr->delete()) {

            foreach ($tokuisaki_mr->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "tokuisaki_mrs",
                'action' => 'search'
            ));

            return;
        }

        $this->_bakOut($tokuisaki_mr, 1);

        $this->flash->success("得意先マスタの削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "tokuisaki_mrs",
            'action' => "index"
        ));
    }

    /**
     * Back Out a tokuisaki_mr
     *
     * @param string $tokuisaki_mr , $dlt_flg
     */
    public function _bakOut($tokuisaki_mr, $dlt_flg = 0)
    {

        $bak_tokuisaki_mr = new BakTokuisakiMrs();
        foreach ($tokuisaki_mr as $fld => $value) {
            $bak_tokuisaki_mr->$fld = $tokuisaki_mr->$fld;
        }
        $bak_tokuisaki_mr->id = NULL;
        $bak_tokuisaki_mr->id_moto = $tokuisaki_mr->id;
        $bak_tokuisaki_mr->hikae_dltflg = $dlt_flg;
        $bak_tokuisaki_mr->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_tokuisaki_mr->hikae_nichiji = date("Y-m-d H:i:s");
        if (!$bak_tokuisaki_mr->save()) {
            foreach ($bak_tokuisaki_mr->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
    }

    /*
     * カナを取得 Add By Nishiyama 2019-10-23
     */
    public function ajaxGetHuriganaAction()
    {
        $this->view->disable();
        $response = new \Phalcon\Http\Response();
        if (!$this->request->isAjax()) echo "Request is not Ajax!";
        if (!$this->request->isPost()) echo "Request is not Post!";
        $mecab = \Phalcon\DI::getDefault()->get('mecab');
        $input_data = $this->request->getPost('input');
        $res = $mecab->mecab_parse($input_data);
        $yomi = $mecab->return_kana($res);
        $res_data = ['kana' => $yomi];
        $response->setContent(json_encode($res_data));
        return $response;
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

        $seikyuusaki_flg = $this->request->getPost('seikyuusaki_flg') ?? 0;
        $tokuisaki_mrs = TokuisakiMrs::find(array(
            //	        'columns' => array('cd, name'), 全項目とする
            'order' => 'cd',
            'conditions' => $seikyuusaki_flg == 0 ? ' cd LIKE ?1 ' : ' seikyuusaki_mr_cd LIKE ?1 ',
            'bind' => array(1 => $this->request->getPost('cd') . '%')
        ));
        $res_flds = [
            "id", "cd", "name", "ryakushou", "shiiresaki_mr_cd", "bushomei", "yakushoku", "gotantousha", "keishou", "tel", "fax", "tantou_mr_cd", "torihiki_kbn_cd", "tanka_shurui_kbn_cd", "kakeritu", "seikyuusaki_mr_cd", "shimegrp_kbn_cd", "gaku_hasuu_shori_kbn_cd", "zei_hasuu_shori_kbn_cd", "zei_tenka_kbn_cd", "yoshin_gendogaku", "kake_zandaka", "harai_houhou_kbn_cd", "harai_saikuru_kbn_cd", "haraibi", "tesuuryou_hutan_kbn_cd", "tegata_sight", "seikyuusho_gassan_mr_cd", "memo",
        ];
        $resData = array();
        foreach ($tokuisaki_mrs as $tokuisaki_mr) {
            $resAdata = array();
            foreach ($res_flds as $res_fld) {
                @$resAdata[$res_fld] = $tokuisaki_mr->$res_fld;
            }
            $resAdata["tanka_shurui_kbn_name"] = $tokuisaki_mr->TankaShuruiKbns->name;
            $resAdata["tanka_shurui_kbn_koumokumei"] = $tokuisaki_mr->TankaShuruiKbns->koumokumei;
            $resAdata["seikyuusaki_name"] = $tokuisaki_mr->SeikyuusakiMrs->name;
            $resAdata["simezumibi"] = count($tokuisaki_mr->TokuisakiSimeDts) ? $tokuisaki_mr->TokuisakiSimeDts[0]->sime_hiduke : "0000-00-00"; // 最終締日
            $resData[] = $resAdata; //array('cd' => $tokuisaki_mr->cd, 'name' => $tokuisaki_mr->name);
        }

        if ($tokuisaki_mrs && $tougetu = $this->request->getPost('tougetu')) { // 当月がある場合、各累計を集計
            $tougetu = substr($this->request->getPost('tougetu'), 0, 7); // 2017-05
            $seikyuusaki_mr_cd = $tokuisaki_mrs[0]->seikyuusaki_mr_cd;
            // 売上額累計
            $resData[0]["uriage_ruikeigaku"] = $this->uriage_ruikeigaku($seikyuusaki_mr_cd);
            // 入金額累計
            $resData[0]["nyuukin_ruikeigaku"] = $this->nyuukin_ruikeigaku($seikyuusaki_mr_cd);
            // 入金額当月計
            $resData[0]["nyuukin_tougetugaku"] = $this->nyuukin_ruikeigaku($seikyuusaki_mr_cd, $tougetu);
        }

        //Set the content of the response
        $response->setContent(json_encode($resData));

        //Return the response
        return $response;
    }

    public function uriage_ruikeigaku($seikyuusaki_mr_cd) // 売上額累計
    {
        $criteria = $this->modelsManager->createBuilder();
        $criteria->addFrom("UriageMeisaiDts", "t0");
        $criteria->columns([
            "sum(t0.zeinukigaku + t0.zeigaku) as ruikeigaku"
        ]);
        $criteria->leftJoin("UriageDts", "t1.id = t0.uriage_dt_id", "t1");
        $criteria->leftJoin("TokuisakiMrs", "t2.cd = t1.tokuisaki_mr_cd", "t2");
        $criteria->where("t2.seikyuusaki_mr_cd = ?0", [0 => $seikyuusaki_mr_cd]);
        $uriage_rows = $criteria->getQuery()->execute();
        $uriage_ruikeigaku = $uriage_rows ? $uriage_rows[0]->ruikeigaku : 0;
        return $uriage_ruikeigaku;
    }

    public function nyuukin_ruikeigaku($seikyuusaki_mr_cd, $tougetu = null) // 入金額累計、当月パラメタがある時、当月計
    {
        $criteria = $this->modelsManager->createBuilder();
        $criteria->addFrom("NyuukinMeisaiDts", "t0");
        $criteria->columns([
            "sum(t0.kingaku) as tougetugaku"
        ]);
        $criteria->leftJoin("NyuukinDts", "t1.id = t0.nyuukin_dt_id", "t1");
        $criteria->where("t1.seikyuusaki_mr_cd = ?0", [0 => $seikyuusaki_mr_cd]);
        if ($tougetu) {
            $criteria->andWhere("DATE_FORMAT(t1.nyuukinbi, '%Y-%m') = ?1", [1 => $tougetu]);
        }
        $nyuukin_rows = $criteria->getQuery()->execute();
        $nyuukin_tougetugaku = $nyuukin_rows ? $nyuukin_rows[0]->tougetugaku : 0;
        return $nyuukin_tougetugaku;
    }

    /**
     * 元帳 action
     */
    public function motochouAction()
    {
        $post_flds = [
            'seikyuusaki_mr_cd',
            'tokuisaki_mr_cd',
            'hyouji_flg',
            'shouhin_mr_cd',
            'to_shouhin_mr_cd',
            'shouhin_tekiyou',
            'kikan_sitei_kbn_cd',
            'keshikomi_joutai',
            'kikan_from',
            'kikan_to',
            'to_excel',
        ];
        $setdts = []; // データーの中継変数
        $thisPost = []; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        foreach ($post_flds as $post_fld) {
            $setdts[$post_fld] = array_key_exists($post_fld, $thisPost) ? $thisPost[$post_fld] : $this->request->getPost($post_fld);
        }
        $setdts['hyouji_flg'] = $setdts['hyouji_flg'] ?? 3;
        $setdts['kikan_sitei_kbn_cd'] = $setdts['kikan_sitei_kbn_cd'] ?? 1213; // 任意の期間
        $setdts['kikan_from'] = $setdts['kikan_from'] ?? ($setdts['hyouji_flg'] == 0 ? '2016-01-01' : date('Y-m-01', strtotime(date('Y-m-1') . '-1 month')));
        $setdts['kikan_to'] = $setdts['kikan_to'] ?? date('Y-m-t');
        // $this->tag->setDefault($setdts['keshikomi_joutai']);
        if ($setdts['seikyuusaki_mr_cd']) {
            $seikyuusaki_mr = TokuisakiMrs::findFirst(["conditions" => "cd = ?1", "bind" => [1 => $setdts['seikyuusaki_mr_cd']]]);
            $setdts['seikyuusaki_mr_name'] = $seikyuusaki_mr->name ?? "？見つかりません！";
        } else {
            $setdts['seikyuusaki_mr_name'] = "";
        }
        if ($setdts['tokuisaki_mr_cd']) {
            $tokuisaki_mr = TokuisakiMrs::findFirst(["conditions" => "cd = ?1", "bind" => [1 => $setdts['tokuisaki_mr_cd']]]);
            $setdts['tokuisaki_mr_name'] = $tokuisaki_mr->name ?? "？見つかりません！";
        } else {
            $setdts['tokuisaki_mr_name'] = "";
        }

        foreach ($setdts as $fld => $setdt) { // postデータをそのまま返す。
            $this->tag->setDefault($fld, $setdt);
        }
        $this->view->setdts = $setdts;
        $this->view->seikyuusaki_mr = $seikyuusaki_mr;

        $criteria = $this->modelsManager->createBuilder();
        $criteria->addFrom("UriageMeisaiDts", "t0");
        $criteria->columns([
            "t0.id as id",
            "t0.uriage_dt_id as uriage_dt_id",
            "t2.seikyuusaki_mr_cd as seikyuusaki_cd",
            "t1.uriagebi as denpyoubi",
            "t1.cd as denpyou_bangou",
            "t1.torihiki_kbn_cd as torihiki_kbn_cd",
            "t5.name as torihiki_kbn_name",
            "t0.utiwake_kbn_cd as utiwake_kbn_cd",
            "t6.name as utiwake_kbn_name",
            "t0.shouhin_mr_cd as shouhin_mr_cd",
            "t0.tekiyou",
            "t0.zeiritu_mr_cd as zeiritu_mr_cd",
            "t1.zei_tenka_kbn_cd as zei_tenka_kbn_cd",
            "t9.name as zei_tenka_kbn_name",
            "concat(t7.ryakushou,t7.zeiritu,'%') as zeiritu_mr_name",
            "t0.tanni_mr1_cd as tanni_mr_cd",
            "t8.name as tanni_mr1_name",
            "t10.name as tanni_mr2_name",
            "t0.tanka_kbn as tanka_kbn",
            "t0.suuryou1 as suuryou",
            "t0.suuryou1 as suuryou1",
            "t0.suuryou2 as suuryou2",
            "t0.tanka as tanka",
            "t0.zeinukigaku as zeinukigaku",
            "t0.zeigaku as zeigaku",
            "ifnull(t4.kesikomi_gaku, 0) as kesikomi_gaku",
            "t4.id as kesi_id",
            "t0.bikou as bikou",
            "t1.shimekiri_flg as shimekiri_flg",
        ]);
        $criteria->leftJoin("UriageDts", "t1.id = t0.uriage_dt_id", "t1");
        $criteria->leftJoin("TokuisakiMrs", "t2.cd = t1.tokuisaki_mr_cd", "t2");
        $criteria->leftJoin("TokuisakiMrs", "t3.cd = t2.seikyuusaki_mr_cd", "t3");
        $criteria->leftJoin("NyuukinKesikomiDts", "t4.uriage_meisai_dt_id = t0.id", "t4");
        $criteria->leftJoin("TorihikiKbns", "t5.cd = t1.torihiki_kbn_cd", "t5");
        $criteria->leftJoin("UtiwakeKbns", "t6.cd = t0.utiwake_kbn_cd", "t6");
        $criteria->leftJoin("ZeirituMrs", "t7.cd = t0.zeiritu_mr_cd", "t7");
        $criteria->leftJoin("TanniMrs", "t8.cd = t0.tanni_mr1_cd", "t8");
        $criteria->leftJoin("TanniMrs", "t10.cd = t0.tanni_mr2_cd", "t10");
        $criteria->leftJoin("ZeitenkaKbns", "t9.cd = t1.zei_tenka_kbn_cd", "t9");
        $criteria->orderBy("uriagebi, t1.cd, t0.cd");
        $criteria->where("t2.seikyuusaki_mr_cd = ?0", [0 => $setdts["seikyuusaki_mr_cd"]]);

        if ($setdts["tokuisaki_mr_cd"]) {
            $criteria->andWhere("t1.tokuisaki_mr_cd = ?1", [1 => $setdts["tokuisaki_mr_cd"]]);
        }
        if ($setdts["shouhin_mr_cd"]) {
            $criteria->andWhere("t0.shouhin_mr_cd LIKE ?2", [2 => $setdts["shouhin_mr_cd"] . "%"]);
        }
        if ($setdts["to_shouhin_mr_cd"]) {
            $criteria->andWhere("t0.shouhin_mr_cd <= ?3", [3 => $setdts["to_shouhin_mr_cd"]]);
        }
        if ($setdts["shouhin_tekiyou"]) {
            $criteria->andWhere("t0.tekiyou LIKE ?4", [4 => "%" . $setdts["shouhin_tekiyou"] . "%"]);
        }

        $criteria->andWhere("t6.yayoi_kbn IS NOT NULL");

        $uriage_rows = $criteria->getQuery()->execute();
        if (count($uriage_rows) == 0) {
            $this->flash->notice("検索の結果、売上伝票は０件でした。");
        }
        $this->view->uriage_rows = $uriage_rows;

        $criteria = $this->modelsManager->createBuilder();
        $criteria->addFrom("NyuukinMeisaiDts", "t0");
        $criteria->columns([
            "t0.nyuukin_dt_id as nyuukin_dt_id",
            "t1.seikyuusaki_mr_cd as seikyuusaki_cd",
            "t1.nyuukinbi as denpyoubi",
            "t1.cd as denpyou_bangou",
            "t0.nyuukin_kbn_cd as nyuukin_kbn_cd",
            "t0.name as tekiyou",
            "t0.tegata_kijitu as tegata_kijitu",
            "t0.kingaku as kingaku",
            "t1.zenkai_kesikomi_gaku as zenkai_kesikomi_gaku",
            "t0.bikou as bikou",
        ]);
        $criteria->leftJoin("NyuukinDts", "t1.id = t0.nyuukin_dt_id", "t1");
        $criteria->orderBy("t1.nyuukinbi, t1.cd, t0.cd");
        $criteria->where("t1.seikyuusaki_mr_cd = ?0", [0 => $setdts["seikyuusaki_mr_cd"]]);
        $nyuukin_rows = $criteria->getQuery()->execute();
        $this->view->nyuukin_rows = $nyuukin_rows;

        if ($setdts['seikyuusaki_mr_cd'] && $setdts['to_excel']) { // EXCEL出力
            $this->view->disable();
            return $this->motochou2xls($uriage_rows, $nyuukin_rows, $setdts, $seikyuusaki_mr);
        }

        //        echo "\n<pre>";print_r($nyuukin_rows);echo "</pre>";
    }


    /**
     * 元帳をエクセル出力する。
     **/

    private function motochou2xls($uriage_rows = null, $nyuukin_rows = null, $setdts = null, $seikyuusaki_mr = null)
    {
        $count1_rows = count($uriage_rows);
        $count2_rows = count($nyuukin_rows);
        $count_rows = $count1_rows + $count2_rows;
        $uriagegaku = $seikyuusaki_mr->kake_zandaka;
        for ($i1 = 0; $i1 < $count1_rows && $uriage_rows[$i1]["denpyoubi"] < $setdts["kikan_from"]; $i1++) {
            $uriagegaku += $uriage_rows[$i1]["zeinukigaku"] + $uriage_rows[$i1]["zeigaku"];
        }
        $nyuukingaku = 0;
        for ($i2 = 0; $i2 < $count2_rows && $nyuukin_rows[$i2]["denpyoubi"] < $setdts["kikan_from"]; $i2++) {
            $nyuukingaku += $nyuukin_rows[$i2]["kingaku"];
        }
        $zandaka = $uriagegaku - $nyuukingaku;
        $uriagegaku = 0;
        for ($i1a = $i1; $i1a < $count1_rows && $uriage_rows[$i1a]["denpyoubi"] <= $setdts["kikan_to"]; $i1a++) {
            $uriagegaku += $uriage_rows[$i1a]["zeinukigaku"] + $uriage_rows[$i1a]["zeigaku"];
        }
        $nyuukingaku = 0;
        for ($i2a = $i2; $i2a < $count2_rows && $nyuukin_rows[$i2a]["denpyoubi"] <= $setdts["kikan_to"]; $i2a++) {
            $nyuukingaku += $nyuukin_rows[$i2a]["kingaku"];
        }
        $count1_rows = $i1a;
        $count2_rows = $i2a;
        $count_rows = $count1_rows + $count2_rows;
        $kesi_txt1 = ["", "一部消込", "消込済"];
        // Excel出力用ライブラリ
        include __DIR__ . '/../vendor/PHPExcel/Classes/PHPExcel.php';
        include __DIR__ . '/../vendor/PHPExcel/Classes/PHPExcel/Writer/Excel5.php';
        //		include __DIR__ . '/../vendor/PHPExcel/Classes/PHPExcel/Writer/Excel2007.php';
        include __DIR__ . '/../vendor/PHPExcel/Classes/PHPExcel/IOFactory.php'; //Include PHPExcel_IOFactory

        //PHPExcelオブジェクトの作成
        //新規の場合
        //$PHPExcel = new PHPExcel();

        //テンプレートの読み込み
        //PHPExcel_Settings::setZipClass(PHPExcel_Settings::PCLZIP);
        $objReader = PHPExcel_IOFactory::createReader('Excel5');
        $objReader->setIncludeCharts(TRUE); // ここがポイント
        //テンプレートファイルパス
        $temp_dir = __DIR__ . '/temp/'; // テンプレート
        $temp_path = $temp_dir . 'tok_mot.xls';
        $PHPExcel = $objReader->load($temp_path);

        //シートの設定
        $PHPExcel->setActiveSheetIndex(0);  // 0は最初のシート
        $sheet = $PHPExcel->getActiveSheet();
        $gyou = 6;
        $i0 = $gyou - $i1 - $i2; // 明細は6行目スタート
        $sheet->setCellValueByColumnAndRow(6, 1, $seikyuusaki_mr->cd);
        $sheet->setCellValueByColumnAndRow(7, 1, $seikyuusaki_mr->name);
        $sheet->setCellValueByColumnAndRow(6, 2, $tokuisaki_mr->cd);
        $sheet->setCellValueByColumnAndRow(7, 2, $tokuisaki_mr->name);
        $sheet->setCellValueByColumnAndRow(7, 2, $tokuisaki_mr->name);
        $sheet->setCellValueByColumnAndRow(0, $gyou - 4, $setdts["kikan_from"]);
        $sheet->setCellValueByColumnAndRow(0, $gyou - 3, $setdts["kikan_to"]);
        $sheet->setCellValueByColumnAndRow(6, $gyou - 3, $setdts["shouhin_mr_cd"]);
        $sheet->setCellValueByColumnAndRow(7, $gyou - 3, $setdts["shouhin_tekiyou"]);
        $sheet->setCellValueByColumnAndRow(18, $gyou - 4, $zandaka);
        $sheet->setCellValueByColumnAndRow(13, $gyou - 3, $uriagegaku);
        $sheet->setCellValueByColumnAndRow(15, $gyou - 3, $nyuukingaku);
        $sheet->setCellValueByColumnAndRow(18, $gyou - 3, $zandaka + $uriagegaku - $nyuukingaku);
        $sheet->setCellValueByColumnAndRow(7, $gyou - 1, '　繰越');
        $sheet->setCellValueByColumnAndRow(18, $gyou - 1, $zandaka);
        for (; $i1 + $i2 < $count_rows;) {
            $gyou = $i0 + $i1 + $i2;
            if (
                $i2 >= $count2_rows ||
                $i1 < $count1_rows && $uriage_rows[$i1]["denpyoubi"] <= $nyuukin_rows[$i2]["denpyoubi"]
            ) {
                $gyou = $i0 + $i1 + $i2;
                $zandaka += $uriage_rows[$i1]["zeinukigaku"] + $uriage_rows[$i1]["zeigaku"];
                $kesi_kbn = $uriage_rows[$i1]["kesikomi_gaku"] == 0 ? 0 : (($uriage_rows[$i1]["kesikomi_gaku"] == $uriage_rows[$i1]["zeinukigaku"] + $uriage_rows[$i1]["zeigaku"]) ? 2 : 1); // 0=未,1=一部,2=済
                // 伝票日付
                //	$sheet->getStyleByColumnAndRow(0, $gyou)->getNumberFormat()->setFormatCode('yyyy/m/d');
                //	$sheet->getStyleByColumnAndRow(0, $gyou)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                if ($uriage_rows[$i1]["denpyoubi"] == $denpyoubi) {
                    $sheet->getStyleByColumnAndRow(0, $gyou)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_YELLOW);
                }
                $sheet->setCellValueByColumnAndRow(0, $gyou, PHPExcel_Shared_Date::PHPToExcel(new DateTime($uriage_rows[$i1]["denpyoubi"])));
                // 伝票番号
                //	$sheet->getStyleByColumnAndRow(1, $gyou)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                if ($uriage_rows[$i1]["denpyou_bangou"] == $denpyou_bangou) {
                    $sheet->getStyleByColumnAndRow(1, $gyou)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_YELLOW);
                }
                $sheet->setCellValueByColumnAndRow(1, $gyou, $uriage_rows[$i1]["denpyou_bangou"]);
                // 取引区分名
                //	$sheet->getStyleByColumnAndRow(2, $gyou)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $sheet->setCellValueByColumnAndRow(2, $gyou, $uriage_rows[$i1]["torihiki_kbn_name"]);
                // 伝票状態
                //	$sheet->getStyleByColumnAndRow(3, $gyou)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $sheet->setCellValueByColumnAndRow(3, $gyou, $uriage_rows[$i1]["shimekiri_flg"] == 1 ? "次回" : "");
                // 内訳
                //	$sheet->getStyleByColumnAndRow(4, $gyou)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $sheet->setCellValueByColumnAndRow(4, $gyou, $uriage_rows[$i1]["utiwake_kbn_name"]);
                // 消込状態
                //	$sheet->getStyleByColumnAndRow(5, $gyou)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $sheet->setCellValueByColumnAndRow(5, $gyou, ["", "一部消込", "消込済"][$kesi_kbn]);
                // 商品コード
                //	$sheet->getStyleByColumnAndRow(6, $gyou)->getNumberFormat()->setFormatCode('@');
                $sheet->setCellValueByColumnAndRow(6, $gyou, $uriage_rows[$i1]["shouhin_mr_cd"]);
                // 商品/摘要
                //	$sheet->getStyleByColumnAndRow(7, $gyou)->getNumberFormat()->setFormatCode('@');
                $sheet->setCellValueByColumnAndRow(7, $gyou, $uriage_rows[$i1]["tekiyou"]);
                // 課税区分=税率台帳+税転嫁区分
                $sheet->setCellValueByColumnAndRow(8, $gyou, $uriage_rows[$i1]["zeiritu_mr_name"] . mb_substr($uriage_rows[$i1]["zei_tenka_kbn_name"], 0, 1));
                // 入金
                // 数量
                //	$sheet->getStyleByColumnAndRow(10, $gyou)->getNumberFormat()->setFormatCode('#,##0.00;[赤]-#,##0.0');
                $sheet->setCellValueByColumnAndRow(10, $gyou, $uriage_rows[$i1]["suuryou" . $uriage_rows[$i1]["tanka_kbn"]]);
                // 単位
                //	$sheet->getStyleByColumnAndRow(11, $gyou)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $sheet->setCellValueByColumnAndRow(11, $gyou, $uriage_rows[$i1]["tanni_mr" . ($uriage_rows[$i1]["tanka_kbn"] ?? "2") . "_name"]);
                // 単価
                //	$sheet->getStyleByColumnAndRow(12, $gyou)->getNumberFormat()->setFormatCode('#,##0.00;[赤]-#,##0.0');
                $sheet->setCellValueByColumnAndRow(12, $gyou, $uriage_rows[$i1]["tanka"]);
                // 売上税抜額
                //	$sheet->getStyleByColumnAndRow(13, $gyou)->getNumberFormat()->setFormatCode('#,##0;[赤]-#,##0');
                $sheet->setCellValueByColumnAndRow(13, $gyou, $uriage_rows[$i1]["zeinukigaku"]);
                // 税額
                $sheet->setCellValueByColumnAndRow(14, $gyou, $uriage_rows[$i1]["zeigaku"]);
                // 消込
                //	$sheet->getStyleByColumnAndRow(14, $gyou)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $sheet->setCellValueByColumnAndRow(15, $gyou, ["", "△", "＊"][$kesi_kbn]);
                // 入金
                // 入金
                // 残高
                //	$sheet->getStyleByColumnAndRow(17, $gyou)->getNumberFormat()->setFormatCode('#,##0;[赤]-#,##0');
                $sheet->setCellValueByColumnAndRow(18, $gyou, $zandaka);
                // 備考
                //	$sheet->getStyleByColumnAndRow(18, $gyou)->getNumberFormat()->setFormatCode('@');
                $sheet->setCellValueByColumnAndRow(19, $gyou, $uriage_rows[$i1]["bikou"]);

                $denpyoubi = str_replace('-', '/', $uriage_rows[$i1]["denpyoubi"]);
                $denpyou_bangou = $uriage_rows[$i1]["denpyou_bangou"];
                $i1++;
            } else {
                // 入金明細
                $zandaka -= $nyuukin_rows[$i2]["kingaku"];
                // 伝票日付
                if ($nyuukin_rows[$i2]["denpyoubi"] == $denpyoubi) {
                    $sheet->getStyleByColumnAndRow(0, $gyou)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_YELLOW);
                }
                $sheet->setCellValueByColumnAndRow(0, $gyou, PHPExcel_Shared_Date::PHPToExcel(new DateTime($nyuukin_rows[$i2]["denpyoubi"])));
                // 伝票番号
                if ($nyuukin_rows[$i2]["denpyou_bangou"] == $denpyou_bangou) {
                    $sheet->getStyleByColumnAndRow(1, $gyou)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_YELLOW);
                }
                $sheet->setCellValueByColumnAndRow(1, $gyou, $nyuukin_rows[$i2]["denpyou_bangou"]);
                // 摘要
                $sheet->setCellValueByColumnAndRow(7, $gyou, $nyuukin_rows[$i2]["tekiyou"]);
                // 手形期日
                $sheet->setCellValueByColumnAndRow(9, $gyou, PHPExcel_Shared_Date::PHPToExcel(new DateTime($nyuukin_rows[$i2]["tegata_kijitu"])));
                // 入金額
                $sheet->setCellValueByColumnAndRow(16, $gyou, $nyuukin_rows[$i2]["kingaku"]);
                // 入金消込
                $sheet->setCellValueByColumnAndRow(15, $gyou, $nyuukin_rows[$i2]["zenkai_kesikomi_gaku"] == 0 ? "" : "＊");
                // 残高
                $sheet->setCellValueByColumnAndRow(18, $gyou, $zandaka);
                // 備考
                $sheet->setCellValueByColumnAndRow(19, $gyou, $nyuukin_rows[$i2]["bikou"]);

                $denpyoubi = str_replace('-', '/', $nyuukin_rows[$i2]["denpyoubi"]);
                $denpyou_bangou = $nyuukin_rows[$i2]["denpyou_bangou"];
                $i2++;
            }
        }
        //return;
        // Excelファイルの保存 ------------------------------------------
        $PHPExcel->setActiveSheetIndex(0);  //0は印刷用のシート)

        //保存ファイル名
        $filename = uniqid("tok_mot_" . $seikyuusaki_mr->cd . "_", true) . '.xls'; // ユニーク
        $filename1 = "tok_mot_" . $seikyuusaki_mr->cd . '.xls'; // ユニークの必要はない

        // 保存ファイルパス
        $upload = __DIR__ . '/temp/';
        $path = $upload . $filename;

        $objWriter = PHPExcel_IOFactory::createWriter($PHPExcel, 'Excel5'); //2007形式で保存
        $objWriter->setIncludeCharts(TRUE); // ここがポイント
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

    /**
     * 締めグループごとの最終締日取得
     * 面倒なので適当
     */
    public function ajax_last_shimebiAction()
    {
        $this->view->disable();
        $response = new \Phalcon\Http\Response();
        $db = \Phalcon\DI::getDefault()->get('db');
        $phql = "
        select
            a.shimegrp_kbn_cd,
            a.cd,
            b.sime_hiduke
        from tokuisaki_mrs as a 
        left join tokuisaki_sime_dts as b on b.tokuisaki_mr_cd = a.cd
        where a.shimegrp_kbn_cd = {$this->request->getPost('grp_kbn')}
        order by b.sime_hiduke desc
        ";
        $stmt = $db->prepare($phql);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $responseString = $rows[0]['sime_hiduke'];
        $response->setContent(json_encode(['sime_hiduke' => $responseString]));

        return $response;
    }
}
