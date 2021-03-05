<?php


class KouseiBuhinMrsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        ControllerBase::indexCd("KouseiBuhinMrs", "構成部品マスタ", "shouhin_mr_cd"); //簡易検索付き一覧表示
    }

    /**
     * Searches for kousei_buhin_mrs
     */
    public function searchAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Displays the creation form
     */
    public function newAction($id = 0)
    {
        if ($id === 0) { // 新規として
            $this->dispatcher->forward(array(
                'controller' => "kousei_buhin_mrs",
                'action' => 'buhin',
            ));
        } else { // 複写として
            $this->dispatcher->forward(array(
                'controller' => "kousei_buhin_mrs",
                'action' => 'buhin',
                'params' => array($id, 'new')
            ));
        }
    }

    /**
     * Displays the creation form
     */
    public function new1Action($id = null, $dataname = "KouseiBuhinMrs")
    {
        $this->view->imax = 0;

        if ($id) {
            $nameDts = $dataname;
            $kousei_buhin_mr = $nameDts::findFirstByid($id);
            if (!$kousei_buhin_mr) {
                $this->flash->error("構成部品マスタが見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "kousei_buhin_mrs",
                    'action' => 'index'
                ));

                return;
            }
            $this->_setDefault($kousei_buhin_mr, "new", $dataname);
            $this->tag->setDefault("id", null);
            $this->tag->setDefault("cd", null);
        }

    }

    /**
     * 修正画面から「次へ」ボタンを押したら次のコードの修正画面になる。
     */
    public function nextAction($id)
    {
        ControllerBase::nextCd($id, "kousei_buhin_mrs", "KouseiBuhinMrs", "構成部品マスタ", "shouhin_mr_cd");
    }

    /**
     * 修正画面から「前へ」ボタンを押したら前のコードの修正画面になる。
     */
    public function prevAction($id = 0)
    {
        ControllerBase::prevCd($id, "kousei_buhin_mrs", "KouseiBuhinMrs", "構成部品マスタ", "shouhin_mr_cd");
    }

    /**
     * Edits a kousei_buhin_mr
     *
     * @param string $id
     */
    public function edit1Action($id)
    {
//        if (!$this->request->isPost()) {

        $kousei_buhin_mr = KouseiBuhinMrs::findFirstByid($id);
        if (!$kousei_buhin_mr) {
            $this->flash->error("構成部品マスタが見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "kousei_buhin_mrs",
                'action' => 'index'
            ));

            return;
        }

        $this->view->id = $kousei_buhin_mr->id;

        $this->_setDefault($kousei_buhin_mr, "edit");
//        }
    }

    /**
     * 画面に表示するデータをセットする
     */
    public function _setDefault($kousei_buhin_mr, $action = "edit", $meisai = "KouseiBuhinMrs")
    {
        $setdts = [
            "id",
            "cd",
            "shouhin_mr_cd",
            "gen_shouhin_mr_cd",
            "tanni_mr_cd",
            "suuryou",
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
            if (property_exists($kousei_buhin_mr, $setdt)) {
                $this->tag->setDefault($setdt, $kousei_buhin_mr->$setdt);
            }
        }
    }

    /**
     * Creates a new kousei_buhin_mr
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "kousei_buhin_mrs",
                'action' => 'index'
            ));

            return;
        }

        $kousei_buhin_mr = new KouseiBuhinMrs();

        $post_flds = [];
        $post_flds = [
            "cd",
            "shouhin_mr_cd",
            "gen_shouhin_mr_cd",
            "tanni_mr_cd",
            "suuryou",
            "updated",
        ];


        $thisPost = []; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        foreach ($post_flds as $post_fld) {
            $kousei_buhin_mr->$post_fld = array_key_exists($post_fld, $thisPost) ? $thisPost[$post_fld] : $this->request->getPost($post_fld);
        }

        if (!$kousei_buhin_mr->save()) {
            foreach ($kousei_buhin_mr->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "kousei_buhin_mrs",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("構成部品マスタの作成が完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "kousei_buhin_mrs",
            'action' => 'edit',
            'params' => array($kousei_buhin_mr->id)
        ));
    }

    /**
     * Saves a kousei_buhin_mr edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "kousei_buhin_mrs",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $kousei_buhin_mr = KouseiBuhinMrs::findFirstByid($id);

        if (!$kousei_buhin_mr) {
            $this->flash->error("構成部品マスタが見つからなくなりました。" . $id);

            $this->dispatcher->forward(array(
                'controller' => "kousei_buhin_mrs",
                'action' => 'index'
            ));

            return;
        }

        if ($kousei_buhin_mr->updated !== $this->request->getPost("updated")) {
            $this->flash->error("他のプロセスから構成部品マスタが変更されたため更新を中止しました。"
                . $id . ",uid=" . $kousei_buhin_mr->kousin_user_id . " tb=" . $kousei_buhin_mr->updated . " pt=" . $this->request->getPost("updated"));

            $this->dispatcher->forward(array(
                'controller' => "kousei_buhin_mrs",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $post_flds = [];
        $post_flds = ["cd",
            "shouhin_mr_cd",
            "gen_shouhin_mr_cd",
            "tanni_mr_cd",
            "suuryou",
            "updated",
        ];


        $thisPost = []; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        $chg_flg = 0;
        foreach ($post_flds as $post_fld) {
            if ((array_key_exists($post_fld, $thisPost) ? $thisPost[$post_fld] : $this->request->getPost($post_fld)) !== $kousei_buhin_mr->$post_fld) {
                $chg_flg = 1;
                break;
            }
        }
        if ($chg_flg === 0) {
            $this->flash->error("変更がありません。" . $id);

            $this->dispatcher->forward(array(
                "controller" => "kousei_buhin_mrs",
                "action" => "edit",
                "params" => array($kousei_buhin_mr->id)
            ));

            return;
        }

        $this->_bakOut($kousei_buhin_mr);

        foreach ($post_flds as $post_fld) {
            $kousei_buhin_mr->$post_fld = array_key_exists($post_fld, $thisPost) ? $thisPost[$post_fld] : $this->request->getPost($post_fld);
        }

        if (!$kousei_buhin_mr->save()) {

            foreach ($kousei_buhin_mr->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "kousei_buhin_mrs",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $this->flash->success("構成部品マスタの情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "kousei_buhin_mrs",
            'action' => 'edit',
            'params' => array($kousei_buhin_mr->id)
        ));
    }

    /**
     * 構成部品修正（新規）画面
     *
     * $id は構成部品台帳のID
     */
    public function editAction($id = 0)
    {
        if ($id == 0) {
            $this->dispatcher->forward(array(
                'controller' => "kousei_buhin_mrs",
                'action' => 'buhin'
            ));

            return;
        }
        $row = KouseiBuhinMrs::findFirstByid($id);
        if (!$row) {
            $this->flash->error("構成部品台帳に見つかりません。");

            $this->dispatcher->forward(array(
                'controller' => "kousei_buhin_mrs",
                'action' => 'index'
            ));

            return;
        }
        $this->dispatcher->forward(array(
            'controller' => "kousei_buhin_mrs",
            'action' => 'buhin',
            'params' => [$row->ShouhinMrs->id]
        ));

        return;
    }

    /**
     * 構成部品修正（新規）画面
     *
     * $id は商品台帳のID
     */
    public function buhinAction($id = 0, $new = "")
    {
        $i = 0;
        $id0 = 0;//構成部品マスター内のid
        if ($id !== 0) {
            $shouhin_mr = ShouhinMrs::findFirstByid($id);
            if (!$shouhin_mr) {
                $this->flash->error("商品マスタが見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "shouhin_mrs",
                    'action' => 'index'
                ));

                return;
            }
//echo '<br><br><br><br>'.$id;
            if ($new !== "new") {
                $this->view->id = $shouhin_mr->id;

                $this->tag->setDefault("id", $shouhin_mr->id);
                $this->tag->setDefault("shouhin_mr_cd", $shouhin_mr->cd);
                $this->tag->setDefault("shouhin_mr_name", $shouhin_mr->name);
                $this->tag->setDefault("tanni_mr_name", $shouhin_mr->zaiko_kbn == 1 ? $shouhin_mr->tanni_mr1_cd : $shouhin_mr->tanni_mr2_cd);
                $this->tag->setDefault("hyoujun_genka", number_format($shouhin_mr->hyoujun_genka, $shouhin_mr->tanka_shousuu));
                $this->tag->setDefault("shiire_tanka", number_format($shouhin_mr->shiire_tanka, $shouhin_mr->tanka_shousuu));
                $this->tag->setDefault("uri_genka", number_format($shouhin_mr->uri_genka, $shouhin_mr->tanka_shousuu));
                $this->tag->setDefault("tanka_shousuu", $shouhin_mr->tanka_shousuu);
            }
            $this->tag->setDefault("data[kousei_buhin_mrs][0][id]", null);
            $i = 0;
            foreach ($shouhin_mr->KouseiBuhinMrs as $kousei_buhin_mr) {
                foreach (["id", "gen_shouhin_mr_cd", "tanni_mr_cd", "updated"] as $setms) {
                    $this->tag->setDefault("data[kousei_buhin_mrs][" . $i . "][" . $setms . "]", $kousei_buhin_mr->$setms);
                }
                if ($kousei_buhin_mr->GenShouhinMrs->tanka_kbn == 1) {
                    if ($kousei_buhin_mr->GenShouhinMrs->tanni_mr2_cd == $kousei_buhin_mr->tanni_mr_cd) {
                        $irisuu = 1 / $kousei_buhin_mr->GenShouhinMrs->irisuu;
                    }
                } else {
                    if ($kousei_buhin_mr->GenShouhinMrs->tanni_mr1_cd == $kousei_buhin_mr->tanni_mr_cd) {
                        $irisuu = $kousei_buhin_mr->GenShouhinMrs->irisuu;
                    }
                }
                $tanka_kbn = $kousei_buhin_mr->GenShouhinMrs->tanka_kbn;
                $suu_shousuu_mei = 'suu' . $tanka_kbn . '_shousuu';
                $this->tag->setDefault("data[kousei_buhin_mrs][" . $i . "][gen_shouhin_mr_id]", $kousei_buhin_mr->GenShouhinMrs->id);
                $this->tag->setDefault("data[kousei_buhin_mrs][" . $i . "][gen_shouhin_mr_name]", $kousei_buhin_mr->GenShouhinMrs->name);
                $this->tag->setDefault("data[kousei_buhin_mrs][" . $i . "][cd]", $i + 1);//行番を振りなおす
                $this->tag->setDefault("data[kousei_buhin_mrs][" . $i . "][suuryou]", number_format($kousei_buhin_mr->suuryou, $kousei_buhin_mr->GenShouhinMrs->$suu_shousuu_mei));
                $this->tag->setDefault("data[kousei_buhin_mrs][" . $i . "][suu_shousuu]", $kousei_buhin_mr->GenShouhinMrs->$suu_shousuu_mei);//桁数設定用
                $this->tag->setDefault("data[kousei_buhin_mrs][" . $i . "][suu1_shousuu]", $kousei_buhin_mr->GenShouhinMrs->suu1_shousuu);//桁数設定用
                $this->tag->setDefault("data[kousei_buhin_mrs][" . $i . "][suu2_shousuu]", $kousei_buhin_mr->GenShouhinMrs->suu2_shousuu);//桁数設定用
                $this->tag->setDefault("data[kousei_buhin_mrs][" . $i . "][hyoujun_genka]", $kousei_buhin_mr->GenShouhinMrs->hyoujun_genka);
                $this->tag->setDefault("data[kousei_buhin_mrs][" . $i . "][shiire_tanka]", $kousei_buhin_mr->GenShouhinMrs->shiire_tanka);
                $this->tag->setDefault("data[kousei_buhin_mrs][" . $i . "][uri_genka]", $kousei_buhin_mr->GenShouhinMrs->uri_genka);
                $this->tag->setDefault("data[kousei_buhin_mrs][" . $i . "][hyoujun_genkagaku]", number_format($kousei_buhin_mr->GenShouhinMrs->hyoujun_genka * $kousei_buhin_mr->suuryou, $kousei_buhin_mr->ShouhinMrs->tanka_shousuu));
                $this->tag->setDefault("data[kousei_buhin_mrs][" . $i . "][shiire_tankagaku]", number_format($kousei_buhin_mr->GenShouhinMrs->shiire_tanka * $kousei_buhin_mr->suuryou, $kousei_buhin_mr->ShouhinMrs->tanka_shousuu));
                $this->tag->setDefault("data[kousei_buhin_mrs][" . $i . "][uri_genkagaku]", number_format($kousei_buhin_mr->GenShouhinMrs->uri_genka * $kousei_buhin_mr->suuryou, $kousei_buhin_mr->ShouhinMrs->tanka_shousuu));
                if ($i == 0) {
                    $id0 = $kousei_buhin_mr->id;
                }
                $i++;
            }
        }
        $this->view->imax = $i;
        $this->view->id = $id;
        $this->view->id0 = $id0;
    }

    /**
     * 構成部品修正（新規）更新
     *
     * $id は商品台帳のID
     */
    public function buhin_saveAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "shouhin_mrs",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");

        $shouhin_mr = ShouhinMrs::findFirstByid($id);

        if (!$shouhin_mr) {
            $this->flash->error("商品台帳が見つからなくなりました。" . $id);

            $this->dispatcher->forward(array(
                'controller' => "shouhin_mrs",
                'action' => 'index'
            ));

            return;
        }

        $post_flds = [];

        $meisai_flds = ["id", "cd", "gen_shouhin_mr_cd", "tanni_mr_cd", "suuryou",];

        $meisai_nums = ["suuryou"];

        $meisai = $this->request->getPost("data");
        $i = 0;
        foreach ($meisai["kousei_buhin_mrs"] as $kousei_buhin_mr1) {
            if ((int)$kousei_buhin_mr1["id"] !== 0) {
                if ((int)$shouhin_mr->KouseiBuhinMrs[$i]->id !== (int)$kousei_buhin_mr1["id"] ||
                    $shouhin_mr->KouseiBuhinMrs[$i]->updated !== $kousei_buhin_mr1["updated"]) {
                    $this->flash->error("他のプロセスから商品台帳明細が変更されたため中止しました。"
                        . $id . ",id=" . $shouhin_mr->KouseiBuhinMrs[$i]->id . ",uid=" . $shouhin_mr->KouseiBuhinMrs[$i]->kousin_user_id
                        . " tb=" . $shouhin_mr->KouseiBuhinMrs[$i]->updated . " pt=" . $kousei_buhin_mr1["updated"]);

                    $this->dispatcher->forward(array(
                        'controller' => "shouhin_mrs",
                        'action' => 'index'
                    ));

                    return;
                }
            }
            $i++;
        }

        $thisPost = [];

        $chg_flg = 0;

        $meisaicnv = array();
        $chg_flgs = array();
        $i = 0;
        foreach ($meisai["kousei_buhin_mrs"] as $kousei_buhin_mr1) {
            $meisaicnv[$i] = [];
            foreach ($meisai_nums as $meisai_num) {
                $meisaicnv[$i][$meisai_num] = str_replace(',', '', $kousei_buhin_mr1[$meisai_num]);//カンマ除去
            }
            $chg_flgs[$i] = 0;//変更ないかも
            if (((int)$kousei_buhin_mr1["cd"] === 0 || $kousei_buhin_mr1["gen_shouhin_mr_cd"] == '') && (int)$kousei_buhin_mr1["id"] !== 0) { // 削除の条件
                $chg_flg = 1;
                $chg_flgs[$i] = 2;//削除
            } else if ((int)$kousei_buhin_mr1["id"] === 0) { // echo ($kousei_buhin_mr1["id"] === "")?"null":"0";//nullの伝わり方
                if ((double)$kousei_buhin_mr1["suuryou"] !== 0.0) {
                    $chg_flg = 1;
                    $chg_flgs[$i] = 1;
                }
            } else if ((int)$kousei_buhin_mr1["cd"] !== 0) {
                foreach ($meisai_flds as $meisai_fld) {
                    if ((array_key_exists($meisai_fld, $meisaicnv[$i]) ? $meisaicnv[$i][$meisai_fld] : $kousei_buhin_mr1[$meisai_fld]) . '' !== $shouhin_mr->KouseiBuhinMrs[$i]->$meisai_fld) {
                        $chg_flg = 1;
                        $chg_flgs[$i] = 1;
                        break;
                    }
                }
                if ($this->request->getPost("shouhin_mr_cd") !== $shouhin_mr->KouseiBuhinMrs[$i]->shouhin_mr_cd) {
                    $chg_flg = 1;
                    $chg_flgs[$i] = 1;
                    break;
                }
            }
            $i++;
        }
        if ($chg_flg === 0) {
            $this->flash->error("変更がありません。" . $id);

            $this->dispatcher->forward(array(
                "controller" => "shouhin_mrs",
                "action" => "edit",
                "params" => array($shouhin_mr->id)
            ));

            return;
        }
//        $this->_bakOut($shouhin_mr, 0, $chg_flgs);

        /*        foreach ($post_flds as $post_fld) {
                    $shouhin_mr->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
                }
        */
        $i = 0;
        foreach ($meisai["kousei_buhin_mrs"] as $kousei_buhin_mr1) {
            if ($chg_flgs[$i] === 2) { // 削除のとき
                $this->deleteAction($kousei_buhin_mr1["id"]);
            } else {
                if ($chg_flgs[$i] === 1) { // 更新なら
                    if ((int)$kousei_buhin_mr1["id"] === 0) {
                        $kousei_buhin_mr = new KouseiBuhinMrs();
                    } else {
                        $kousei_buhin_mr = KouseiBuhinMrs::findFirstByid($kousei_buhin_mr1["id"]);
                        $this->_bakOut($kousei_buhin_mr);
                    }
                    $kousei_buhin_mr->shouhin_mr_cd = $this->request->getPost("shouhin_mr_cd");
                    foreach ($meisai_flds as $meisai_fld) {
                        $kousei_buhin_mr->$meisai_fld = array_key_exists($meisai_fld, $meisaicnv[$i]) ? $meisaicnv[$i][$meisai_fld] : $kousei_buhin_mr1[$meisai_fld] ?? '';
                        //更新日時や更新者はModelに定義してある
                    }
                    if (!$kousei_buhin_mr->save()) {

                        foreach ($kousei_buhin_mr->getMessages() as $message) {
                            $this->flash->error($message);
                        }

                        $this->dispatcher->forward(array(
                            'controller' => "kousei_buhin_mrs",
                            'action' => 'edit',
                            'params' => array($id)
                        ));

                        return;
                    }
                }
            }
            $i++;
        }

        $this->flash->success("構成部品台帳の情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "kousei_buhin_mrs",
            'action' => 'buhin',
            'params' => array($id)
        ));
    }

    /**
     * 構成部品削除
     *
     * $id は商品台帳のID
     */
    public function buhin_deleteAction($id)
    {
        $shouhin_mr = ShouhinMrs::findFirstByid($id);

        if (!$shouhin_mr) {
            $this->flash->error("商品台帳が見つからなくなりました。" . $id);

            $this->dispatcher->forward(array(
                'controller' => "shouhin_mrs",
                'action' => 'index'
            ));

            return;
        }
        foreach ($shouhin_mr->KouseiBuhinMrs as $kousei_buhin_mr1) {
            $this->deleteAction($kousei_buhin_mr1->id);
        }
        $this->flash->success("構成部品台帳の情報を削除しました。");

        $this->dispatcher->forward(array(
            'controller' => "kousei_buhin_mrs",
            'action' => 'buhin',
            'params' => array($id)
        ));
    }

    /**
     * Deletes a kousei_buhin_mr
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $kousei_buhin_mr = KouseiBuhinMrs::findFirstByid($id);
        if (!$kousei_buhin_mr) {
            $this->flash->error("構成部品マスタが見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "kousei_buhin_mrs",
                'action' => 'index'
            ));

            return;
        }

        $this->_bakOut($kousei_buhin_mr, 1);

        if (!$kousei_buhin_mr->delete()) {

            foreach ($kousei_buhin_mr->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "kousei_buhin_mrs",
                'action' => 'search'
            ));

            return;
        }

        $this->flash->success("構成部品１件の削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "kousei_buhin_mrs",
            'action' => "index"
        ));
    }

    /**
     * Back Out a kousei_buhin_mr
     *
     * @param string $kousei_buhin_mr , $dlt_flg
     */
    public function _bakOut($kousei_buhin_mr, $dlt_flg = 0)
    {

        $bak_kousei_buhin_mr = new BakKouseiBuhinMrs();
        foreach ($kousei_buhin_mr as $fld => $value) {
            $bak_kousei_buhin_mr->$fld = $kousei_buhin_mr->$fld;
        }
        $bak_kousei_buhin_mr->id = NULL;
        $bak_kousei_buhin_mr->id_moto = $kousei_buhin_mr->id;
        $bak_kousei_buhin_mr->hikae_dltflg = $dlt_flg;
        $bak_kousei_buhin_mr->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_kousei_buhin_mr->hikae_nichiji = date("Y-m-d H:i:s");
        if (!$bak_kousei_buhin_mr->save()) {
            foreach ($bak_kousei_buhin_mr->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
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

        if ($this->request->getPost('shouhin_mr_id') == 0) {
            $shouhin_mr = ShouhinMrs::findFirst(['conditions' => 'cd = ?0', 'bind' => ['0' => $this->request->getPost('shouhin_mr_cd')]]);
        } else {
            $shouhin_mr = ShouhinMrs::findFirstByid($this->request->getPost('shouhin_mr_id'));
        }
        $resData = array();
        foreach ($shouhin_mr->KouseiBuhinMrs as $kousei_buhin_mr) {
            $shouhin_mr = $kousei_buhin_mr->GenShouhinMrs;
            $resData[] = array(
                'id' => $kousei_buhin_mr->id,
                'cd' => $kousei_buhin_mr->cd,
                'shouhin_mr_cd' => $kousei_buhin_mr->shouhin_mr_cd,
                'gen_shouhin_mr_cd' => $kousei_buhin_mr->gen_shouhin_mr_cd,
                'tanni_mr_cd' => $kousei_buhin_mr->tanni_mr_cd,
                'suuryou' => $kousei_buhin_mr->suuryou,
                'gen_shouhin_mr' => array(
                    'name' => $shouhin_mr->name,
                    'tanni_mr_cd' => $shouhin_mr->tanni_mr_cd,
                    'tanni_mr1_cd' => $shouhin_mr->tanni_mr1_cd,
                    'tanni_mr2_cd' => $shouhin_mr->tanni_mr2_cd,
                    'tanka_kbn' => $shouhin_mr->tanka_kbn,
                    'zaiko_kbn' => $shouhin_mr->zaiko_kbn,
                    'irisuu' => $shouhin_mr->irisuu,
                    'suu_shousuu' => $shouhin_mr->suu_shousuu,
                    'suu1_shousuu' => $shouhin_mr->suu1_shousuu,
                    'suu2_shousuu' => $shouhin_mr->suu2_shousuu,
                    'tanka_shousuu' => $shouhin_mr->tanka_shousuu,
                    'shu_souko_mr_cd' => $shouhin_mr->shu_souko_mr_cd,
                    'lot' => $shouhin_mr->lot,
                    'hinsitu_kbn_cd' => $shouhin_mr->hinsitu_kbn_cd,
                    'hyoujun_genka' => $shouhin_mr->hyoujun_genka,
                    'uri_genka' => $shouhin_mr->uri_genka,
                    'joudai' => $shouhin_mr->joudai,
                    'uri_tanka1' => $shouhin_mr->uri_tanka1,
                    'uri_tanka2' => $shouhin_mr->uri_tanka2,
                    'uri_tanka3' => $shouhin_mr->uri_tanka3,
                    'uri_tanka4' => $shouhin_mr->uri_tanka4,
                    'shiire_tanka' => $shouhin_mr->shiire_tanka,
                    'kazei_kbn_cd' => $shouhin_mr->kazei_kbn_cd
                )
            );
        }
        //Set the content of the response
        $response->setContent(json_encode($resData));

        //Return the response
        return $response;
    }

    public function ajaxTenkaiAction()
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
//
        if ($this->request->getPost('shouhin_mr_id') == 0) {
            $shouhin_mr = ShouhinMrs::findFirst(['conditions' => 'cd = ?0', 'bind' => ['0' => $this->request->getPost('shouhin_mr_cd')]]);
        } else {
            $shouhin_mr = ShouhinMrs::findFirstByid($this->request->getPost('shouhin_mr_id'));
        }

        $only1 = $this->request->getPost('only1') ?? 0;
        $resData = $this->_tenkai($shouhin_mr, 1.0, $this->request->getPost('tanni_mr_cd'), $only1, '');
//return;
        $resSum = array();
        foreach ($resData as $resData1) {
            $new_flg = 1;
            if ($new_flg == 1) {
                $resSum[] = [
                    'gen_shouhin_mr_cd' => $resData1['gen_shouhin_mr_cd'],
                    'kousei' => $resData1['kousei'],
                    'irisuu' => $resData1['irisuu'],
                    'koutin_flg' => $resData1['koutin_flg'],
                    'gen_hyouji_jun' => $resData1['gen_hyouji_jun'],
                    'gen_shouhin_mr' => $resData1['gen_shouhin_mr']
                ];
            }
        }

        foreach ($resSum as $key => $value) {
            $sort[$key] = $value['gen_hyouji_jun'];
            $sort1[$key] = $value['shouhin_mr_cd'];
        }
//		array_multisort($sort, SORT_DESC, SORT_NUMERIC, $sort1, SORT_ASC, $resSum);
        //Set the content of the response
        $response->setContent(json_encode($resSum));

        //Return the response
        return $response;
    }

    /**
     * @param $shouhin_mr
     * @param $suuryou
     * @param $tanni_mr_cd
     * @param $only1
     * @param $kaisou
     * @param string $kousei0
     * @param int $fullo
     * @return array
     */
    public function _tenkai($shouhin_mr, $suuryou, $tanni_mr_cd, $only1, $kaisou, $kousei0 = '', $fullo = 0)
    {
//echo "\n<br>".$shouhin_mr->cd.":".$shouhin_mr->tanni_mr_cd.":".$shouhin_mr->suu_tanni_mr_cd.":".$shouhin_mr->irisuu.":".$suuryou.":".$tanni_mr_cd;
        $keisu_b = 1;
        $keisu_c = 1;
        if ($shouhin_mr->zaiko_kbn == 1) {
            if ($shouhin_mr->tanni_mr2_cd == $tanni_mr_cd) {
                $keisu_b = $shouhin_mr->irisuu ?? 1;
            }
        } else {
            if ($shouhin_mr->tanni_mr1_cd == $tanni_mr_cd) {
                $keisu_c = $shouhin_mr->irisuu ?? 1;
            }
        }
        $suuryou = $suuryou * $keisu_c / $keisu_b;
        $resData = array();
        $resData1 = array();
        $kbmcnt = count($shouhin_mr->KouseiBuhinMrs); // KouseiBuhinMrs件数
        $kbmi = 0; // KouseiBuhinMrs計数
        foreach ($shouhin_mr->KouseiBuhinMrs as $kousei_buhin_mr) {
            $kbmi++;
            $kousei = $kousei0;
            $keisu_b = 1;
            $keisu_c = 1;
            if ($kousei_buhin_mr->GenShouhinMrs->zaiko_kbn == 1) {
                if ($kousei_buhin_mr->GenShouhinMrs->tanni_mr2_cd == $kousei_buhin_mr->tanni_mr_cd) {
                    $keisu_b = $kousei_buhin_mr->GenShouhinMrs->irisuu;
                    if (!$keisu_b) {
                        $keisu_b = 1;
                    }
                }
            } else {
                if ($kousei_buhin_mr->GenShouhinMrs->tanni_mr1_cd == $kousei_buhin_mr->tanni_mr_cd) {
                    $keisu_c = $kousei_buhin_mr->GenShouhinMrs->irisuu;
                    if (!$keisu_c) {
                        $keisu_c = 1;
                    }
                }
            }
            if ($kbmi == 1 && $fullo == 0) {
                if (mb_substr($kousei, -1) == '　') {
                    $kousei = mb_substr($kousei, 0, -1) . '└';
                }
//				else if (mb_substr($kousei,-1)=='├'){$kousei=mb_substr($kousei,0,-1).'│';}
            } else {
                if (mb_substr($kousei, -1) == '└') {
                    $kousei = mb_substr($kousei, 0, -1) . '　';
                } else if (mb_substr($kousei, -1) == '├') {
                    $kousei = mb_substr($kousei, 0, -1) . '│';
                }
            }
            if ($only1 != 1) {
                $resData1 = $this->_tenkai(
                    $kousei_buhin_mr->GenShouhinMrs,
                    $kousei_buhin_mr->suuryou * $suuryou,
                    $kousei_buhin_mr->tanni_mr_cd,
                    $only1 - 1,
                    $kaisou + 1,
                    $kousei . ($kbmi == $kbmcnt ? '└' : '├'),
                    $fullo
                );//echo "\n<br>".$kousei_buhin_mr->id;
            }
            if ($only1 == 1 || count($resData1) == 0 || $fullo == 1) {
                $shouhin_mr = $kousei_buhin_mr->GenShouhinMrs;
                $zaiko_kbn = $shouhin_mr->zaiko_kbn;
                $suu_shousuu_mei = 'suu' . $zaiko_kbn . '_shousuu';
                $resData[] = array(
                    'id' => $kousei_buhin_mr->id,
                    'cd' => $kousei_buhin_mr->cd,
                    'kaisou' => $kaisou,
                    'kousei' => $kousei . ($kbmi > 1 || $kousei == '' || $fullo == 1 ? ($kbmi == $kbmcnt ? '└' : '├') . (count($resData1) > 0 ? '┬' : '') : ($kbmi == $kbmcnt ? '─' : '┬')),
                    'shouhin_mr_cd' => $kousei_buhin_mr->shouhin_mr_cd,
                    'gen_shouhin_mr_cd' => $kousei_buhin_mr->gen_shouhin_mr_cd,
                    'suuryou' => $kousei_buhin_mr->suuryou,
                    'tanni_mr_cd' => $kousei_buhin_mr->tanni_mr_cd,
                    'irisuu' => $kousei_buhin_mr->suuryou * $suuryou * $keisu_c / $keisu_b,
                    'koutin_flg' => $kousei_buhin_mr->GenShouhinMrs->ShouhinBunrui1Kbns->koutin_flg,
                    'gen_hyouji_jun' => $kousei_buhin_mr->GenShouhinMrs->ShouhinBunrui1Kbns->hyouji_jun,
                    'gen_shouhin_mr' => array(
                        'name' => $shouhin_mr->name,
                        'tanni_mr_cd' => $shouhin_mr->tanni_mr_cd,
                        'tanni_mr1_cd' => $shouhin_mr->tanni_mr1_cd,
                        'tanni_mr1_name' => $shouhin_mr->TanniMr1s->name,
                        'tanni_mr2_cd' => $shouhin_mr->tanni_mr2_cd,
                        'tanni_mr2_name' => $shouhin_mr->TanniMr2s->name,
                        'tanka_kbn' => $shouhin_mr->tanka_kbn,
                        'zaiko_kbn' => $shouhin_mr->zaiko_kbn,
                        'zaikokanri' => $shouhin_mr->zaikokanri,
                        'irisuu' => $shouhin_mr->irisuu,
                        'suu_shousuu' => $shouhin_mr->$suu_shousuu_mei,
                        'suu1_shousuu' => $shouhin_mr->suu1_shousuu,
                        'suu2_shousuu' => $shouhin_mr->suu2_shousuu,
                        'tanka_shousuu' => $shouhin_mr->tanka_shousuu,
                        'shu_souko_mr_cd' => $shouhin_mr->shu_souko_mr_cd,
                        'lot' => $shouhin_mr->lot,
                        'hinsitu_kbn_cd' => $shouhin_mr->hinsitu_kbn_cd,
                        'hyoujun_genka' => $shouhin_mr->hyoujun_genka,
                        'uri_genka' => $shouhin_mr->uri_genka,
                        'joudai' => $shouhin_mr->joudai,
                        'uri_tanka1' => $shouhin_mr->uri_tanka1,
                        'uri_tanka2' => $shouhin_mr->uri_tanka2,
                        'uri_tanka3' => $shouhin_mr->uri_tanka3,
                        'uri_tanka4' => $shouhin_mr->uri_tanka4,
                        'shiire_tanka' => $shouhin_mr->shiire_tanka,
                        'kazei_kbn_cd' => $shouhin_mr->kazei_kbn_cd,
                        'shouhin_bunrui1_kbn_cd' => $shouhin_mr->shouhin_bunrui1_kbn_cd,
                    )
                );
            }
            if ($only1 != 1 && count($resData1) > 0) {
                $resData = array_merge($resData, $resData1);
            }
        }
        return $resData;
    }

    public function ajaxOyaAction()
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

        $kousei_buhin_mrs = KouseiBuhinMrs::find([
            'conditions' => 'gen_shouhin_mr_cd = ?0',
            'bind' => ['0' => $this->request->getPost('gen_shouhin_mr_cd')],
            'order' => 'shouhin_mr_cd',
            'limit' => 20,
        ]);
        $resData = array();
        foreach ($kousei_buhin_mrs as $kousei_buhin_mr) {
            $shouhin_mr = $kousei_buhin_mr->ShouhinMrs;
            $resData[] = array(
                'shouhin_mr_cd' => $kousei_buhin_mr->shouhin_mr_cd,
                'suuryou' => $kousei_buhin_mr->suuryou,
                'shouhin_mr' => array(
                    'id' => $shouhin_mr->id,
                    'name' => $shouhin_mr->name,
                    'kana' => $shouhin_mr->kana,
                    'tanni_mr_cd' => $shouhin_mr->tanni_mr_cd,
                    'tanni_mr1_cd' => $shouhin_mr->tanni_mr1_cd,
                    'tanni_mr2_cd' => $shouhin_mr->tanni_mr2_cd,
                    'tanni_mr1_name' => $shouhin_mr->TanniMr1s->name,
                    'tanni_mr2_name' => $shouhin_mr->TanniMr2s->name,
                    'tanka_kbn' => $shouhin_mr->tanka_kbn,
                    'zaiko_kbn' => $shouhin_mr->zaiko_kbn,
                    'irisuu' => $shouhin_mr->irisuu,
                    'suu_shousuu' => $shouhin_mr->suu_shousuu,
                    'suu1_shousuu' => $shouhin_mr->suu1_shousuu,
                    'suu2_shousuu' => $shouhin_mr->suu2_shousuu,
                    'tanka_shousuu' => $shouhin_mr->tanka_shousuu,
                    'shu_souko_mr_cd' => $shouhin_mr->shu_souko_mr_cd,
                    'lot' => $shouhin_mr->lot,
                    'hinsitu_kbn_cd' => $shouhin_mr->hinsitu_kbn_cd,
                    'hyoujun_genka' => $shouhin_mr->hyoujun_genka,
                    'uri_genka' => $shouhin_mr->uri_genka,
                    'joudai' => $shouhin_mr->joudai,
                    'uri_tanka1' => $shouhin_mr->uri_tanka1,
                    'uri_tanka2' => $shouhin_mr->uri_tanka2,
                    'uri_tanka3' => $shouhin_mr->uri_tanka3,
                    'uri_tanka4' => $shouhin_mr->uri_tanka4,
                    'shiire_tanka' => $shouhin_mr->shiire_tanka,
                    'kazei_kbn_cd' => $shouhin_mr->kazei_kbn_cd
                )
            );
        }
        $resData0 = array();
        if (count($kousei_buhin_mrs) > 0) {
            foreach ($kousei_buhin_mrs[0]->ShouhinMrs->KouseiBuhinMrs as $kousei_buhin_mr) {
                $shouhin_mr = $kousei_buhin_mr->GenShouhinMrs;
                $resData0[] = array(
                    'id' => $kousei_buhin_mr->id,
                    'cd' => $kousei_buhin_mr->cd,
                    'shouhin_mr_cd' => $kousei_buhin_mr->shouhin_mr_cd,
                    'gen_shouhin_mr_cd' => $kousei_buhin_mr->gen_shouhin_mr_cd,
                    'tanni_mr_cd' => $kousei_buhin_mr->tanni_mr_cd,
                    'tanni_mr_name' => $kousei_buhin_mr->TanniMrs->name,
                    'suuryou' => $kousei_buhin_mr->suuryou,
                    'gen_shouhin_mr' => array(
                        'name' => $shouhin_mr->name,
                        'kana' => $shouhin_mr->kana,
                        'tanni_mr_cd' => $shouhin_mr->tanni_mr_cd,
                        'tanni_mr1_cd' => $shouhin_mr->tanni_mr1_cd,
                        'tanni_mr2_cd' => $shouhin_mr->tanni_mr2_cd,
                        'tanka_kbn' => $shouhin_mr->tanka_kbn,
                        'zaiko_kbn' => $shouhin_mr->zaiko_kbn,
                        'irisuu' => $shouhin_mr->irisuu,
                        'suu_shousuu' => $shouhin_mr->suu_shousuu,
                        'suu1_shousuu' => $shouhin_mr->suu1_shousuu,
                        'suu2_shousuu' => $shouhin_mr->suu2_shousuu,
                        'tanka_shousuu' => $shouhin_mr->tanka_shousuu,
                        'shu_souko_mr_cd' => $shouhin_mr->shu_souko_mr_cd,
                        'lot' => $shouhin_mr->lot,
                        'hinsitu_kbn_cd' => $shouhin_mr->hinsitu_kbn_cd,
                        'hyoujun_genka' => $shouhin_mr->hyoujun_genka,
                        'uri_genka' => $shouhin_mr->uri_genka,
                        'joudai' => $shouhin_mr->joudai,
                        'uri_tanka1' => $shouhin_mr->uri_tanka1,
                        'uri_tanka2' => $shouhin_mr->uri_tanka2,
                        'uri_tanka3' => $shouhin_mr->uri_tanka3,
                        'uri_tanka4' => $shouhin_mr->uri_tanka4,
                        'shiire_tanka' => $shouhin_mr->shiire_tanka,
                        'kazei_kbn_cd' => $shouhin_mr->kazei_kbn_cd,
                        'shouhin_bunrui1_cd' => $shouhin_mr->shouhin_bunrui1_kbn_cd,
                    )
                );
            }
            $resData[0]['kousei0'] = $resData0;
        }
        //Set the content of the response
        $response->setContent(json_encode($resData));

        //Return the response
        return $response;
    }
//					'gen_kazei_kbn_cd' => $kousei_buhin_mr->GenShouhinMrs->kazei_kbn_cd,
//					'gen_suu_shousuu' => $kousei_buhin_mr->GenShouhinMrs->suu_shousuu,
//					'gen_tanka_shousuu' => $kousei_buhin_mr->GenShouhinMrs->tanka_shousuu,

}
