<?php

use Phalcon\Paginator\Adapter\Model as Paginator;

class ShouhinMrsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        ControllerBase::indexCd("ShouhinMrs", "商品台帳");
    }

    /**
     * Searches for shouhin_mrs
     */
    public function searchAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Displays the creation form
     */
    public function newAction($id = null)
    {
        if ($id) {
            $nameDts = "ShouhinMrs";
            $shouhin_mr = $nameDts::findFirstByid($id);
            if (!$shouhin_mr) {
                $this->flash->error("商品台帳が見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "shouhin_mrs",
                    'action' => 'index'
                ));
                return;
            }
            $this->_setDefault($shouhin_mr);
            $this->tag->setDefault("id", null);
            $this->tag->setDefault("cd", "-" . $shouhin_mr->cd);
        } else {
            $this->tag->setDefault("suu_shousuu", 2);
            $this->tag->setDefault("suu1_shousuu", 2);
            $this->tag->setDefault("suu2_shousuu", 2);
            $this->tag->setDefault("tanka_shousuu", 2);
            $this->tag->setDefault("kazei_kbn_cd", 1);
            $this->tag->setDefault("zaikokanri", 1);
            $this->tag->setDefault("zaiko_hyouka_kbn_cd", 2);
            $this->tag->setDefault("hacchuu_rendou", 1);
            $this->tag->setDefault("tanka_kbn", 2);
            $this->tag->setDefault("zaiko_kbn", 2);
            $this->tag->setDefault("sanshou_hyouji", 1);
        }
    }

    /**
     * 修正画面から「次へ」ボタンを押したら次のコードの修正画面になる。
     */
    public function nextAction($id)
    {
        ControllerBase::nextCd($id, "shouhin_mrs", "ShouhinMrs", "商品台帳");
    }

    /**
     * 修正画面から「前へ」ボタンを押したら前のコードの修正画面になる。
     */
    public function prevAction($id = 0)
    {
        ControllerBase::prevCd($id, "shouhin_mrs", "ShouhinMrs", "商品台帳");
    }

    /**
     * Edits a shouhin_mr
     *
     * @param string $id
     */
    public function editAction($id)
    {
        $shouhin_mr = ShouhinMrs::findFirstByid($id);
        if (!$shouhin_mr) {
            $this->flash->error("商品台帳が見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "shouhin_mrs",
                'action' => 'index'
            ));

            return;
        }
        $this->view->id = $shouhin_mr->id;

        $this->_setDefault($shouhin_mr);

        $this->tag->setDefault("sakusei_user_id", $shouhin_mr->sakusei_user_id);
        $this->tag->setDefault("created", $shouhin_mr->created);
        $this->tag->setDefault("kousin_user_id", $shouhin_mr->kousin_user_id);
        $this->tag->setDefault("updated", $shouhin_mr->updated);
    }

    /**
     * 画面に表示するデータをセットする
     */
    public function _setDefault($shouhin_mr)
    {
        $this->tag->setDefault("id", $shouhin_mr->id);
        $this->tag->setDefault("cd", $shouhin_mr->cd);
        $this->tag->setDefault("name", $shouhin_mr->name);
        $this->tag->setDefault("kana", $shouhin_mr->kana);
        $this->tag->setDefault("tanni_mr1_cd", $shouhin_mr->tanni_mr1_cd);
        $this->tag->setDefault("tanni_mr2_cd", $shouhin_mr->tanni_mr2_cd);
        $this->tag->setDefault("tanka_kbn", $shouhin_mr->tanka_kbn);
        $this->tag->setDefault("zaiko_kbn", $shouhin_mr->zaiko_kbn);
        $this->tag->setDefault("irisuu", $shouhin_mr->irisuu);
        $this->tag->setDefault("kikaku", $shouhin_mr->kikaku);
        $this->tag->setDefault("iro", $shouhin_mr->iro);
        $this->tag->setDefault("iromei", $shouhin_mr->iromei);
        $this->tag->setDefault("size", $shouhin_mr->size);
        $this->tag->setDefault("lot", $shouhin_mr->lot);
        $this->tag->setDefault("hinsitu_kbn_cd", $shouhin_mr->hinsitu_kbn_cd);
        $this->tag->setDefault("suu_shousuu", $shouhin_mr->suu_shousuu);
        $this->tag->setDefault("suu1_shousuu", $shouhin_mr->suu1_shousuu);
        $this->tag->setDefault("suu2_shousuu", $shouhin_mr->suu2_shousuu);
        $this->tag->setDefault("tanka_shousuu", $shouhin_mr->tanka_shousuu);
        $this->tag->setDefault("kazei_kbn_cd", $shouhin_mr->kazei_kbn_cd);
        $this->tag->setDefault("zaikokanri", $shouhin_mr->zaikokanri);
        $this->tag->setDefault("hacchuu_lot", $shouhin_mr->hacchuu_lot);
        $this->tag->setDefault("lead_time", $shouhin_mr->lead_time);
        $this->tag->setDefault("zaiko_tekisei", $shouhin_mr->zaiko_tekisei);
        $this->tag->setDefault("zaiko_hyouka_kbn_cd", $shouhin_mr->zaiko_hyouka_kbn_cd);
        $this->tag->setDefault("shu_shiiresaki_mr_cd", $shouhin_mr->shu_shiiresaki_mr_cd);
        $this->tag->setDefault("shu_souko_mr_cd", $shouhin_mr->shu_souko_mr_cd);
        $this->tag->setDefault("hacchuu_rendou", $shouhin_mr->hacchuu_rendou);
        $this->tag->setDefault("joudai", $shouhin_mr->joudai);
        $this->tag->setDefault("uri_tanka1", $shouhin_mr->uri_tanka1);
        $this->tag->setDefault("uri_tanka2", $shouhin_mr->uri_tanka2);
        $this->tag->setDefault("uri_tanka3", $shouhin_mr->uri_tanka3);
        $this->tag->setDefault("uri_tanka4", $shouhin_mr->uri_tanka4);
        $this->tag->setDefault("uri_genka", $shouhin_mr->uri_genka);
        $this->tag->setDefault("shiire_tanka", $shouhin_mr->shiire_tanka);
        $this->tag->setDefault("hyoujun_genka", $shouhin_mr->hyoujun_genka);
        $this->tag->setDefault("hyoukasage_genka", $shouhin_mr->hyoukasage_genka);
        $this->tag->setDefault("shouhin_bunrui1_kbn_cd", $shouhin_mr->shouhin_bunrui1_kbn_cd);
        $this->tag->setDefault("shouhin_bunrui2_kbn_cd", $shouhin_mr->shouhin_bunrui2_kbn_cd);
        $this->tag->setDefault("shouhin_bunrui3_kbn_cd", $shouhin_mr->shouhin_bunrui3_kbn_cd);
        $this->tag->setDefault("shouhin_bunrui4_kbn_cd", $shouhin_mr->shouhin_bunrui4_kbn_cd);
        $this->tag->setDefault("shouhin_bunrui5_kbn_cd", $shouhin_mr->shouhin_bunrui5_kbn_cd);
        $this->tag->setDefault("sanshou_hyouji", $shouhin_mr->sanshou_hyouji);
        $this->tag->setDefault("memo", $shouhin_mr->memo);
        $this->tag->setDefault("id_moto", $shouhin_mr->id_moto);
        $this->tag->setDefault("hikae_dltflg", $shouhin_mr->hikae_dltflg);
        $this->tag->setDefault("hikae_user_id", $shouhin_mr->hikae_user_id);
        $this->tag->setDefault("hikae_nichiji", $shouhin_mr->hikae_nichiji);

        //在庫・最終入庫日・最終出庫日を正しく表示 Nishiyama 2019/10/30
        $zaikos = ZaikoKakuninAzukariVws::findZaikos(["conditions" => "p1a.cd = '" . $shouhin_mr->cd . "'", "groupby" => ["shouhin_mr_cd"]]);
        if ($zaikos) {
            if ($shouhin_mr->zaiko_kbn === '1') {
                $this->tag->setDefault("gen_zaiko", isset($zaikos[0]['zaiko_ryou1']) ? round($zaikos[0]["zaiko_ryou1"], 3) : 0);
            } else {
                $this->tag->setDefault("gen_zaiko", isset($zaikos[0]['zaiko_ryou2']) ? round($zaikos[0]["zaiko_ryou2"], 3) : 0);
            }
            $this->tag->setDefault("last_shukko_date", isset($zaikos[0]['shukkobi']) ? $zaikos[0]["shukkobi"] : '');
            $this->tag->setDefault("last_nyuuko_date", isset($zaikos[0]['nyuukobi']) ? $zaikos[0]["nyuukobi"] : '');
        }
    }

    /**
     * Creates a new shouhin_mr
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "shouhin_mrs",
                'action' => 'index'
            ));

            return;
        }
        $shouhin_mr = new ShouhinMrs();
        $post_flds = [
            "cd",
            "name",
            "kana",
            "tanni_mr_cd",
            "kousei",
            "tanni_mr1_cd",
            "tanni_mr2_cd",
            "tanka_kbn",
            "zaiko_kbn",
            "irisuu",
            "kikaku",
            "iro",
            "iromei",
            "size",
            "lot",
            "hinsitu_kbn_cd",
            "suu1_shousuu",
            "suu2_shousuu",
            "tanka_shousuu",
            "kazei_kbn_cd",
            "zaikokanri",
            "hacchuu_lot",
            "lead_time",
            "zaiko_tekisei",
            "zaiko_hyouka_kbn_cd",
            "shu_shiiresaki_mr_cd",
            "shu_souko_mr_cd",
            "hacchuu_rendou",
            "gen_zaiko",
            "joudai",
            "uri_tanka1",
            "uri_tanka2",
            "uri_tanka3",
            "uri_tanka4",
            "uri_genka",
            "shiire_tanka",
            "hyoujun_genka",
            "hyoukasage_genka",
            "shouhin_bunrui1_kbn_cd",
            "shouhin_bunrui2_kbn_cd",
            "shouhin_bunrui3_kbn_cd",
            "shouhin_bunrui4_kbn_cd",
            "shouhin_bunrui5_kbn_cd",
            "sanshou_hyouji",
            "memo",
            "updated",
        ];
        foreach ($post_flds as $post_fld) {
            $shouhin_mr->$post_fld = $this->request->getPost($post_fld);
        }
        $shouhin_mr->suu_shousuu = $this->request->getPost('suu2_shousuu');

        if (!$shouhin_mr->save()) {
            foreach ($shouhin_mr->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "shouhin_mrs",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("商品台帳の作成が完了しました。");
        $this->dispatcher->forward(array(
            'controller' => "shouhin_mrs",
            "action" => "edit",
            "params" => array($shouhin_mr->id)
        ));
    }

    /**
     * Saves a shouhin_mr edited
     *
     */
    public function saveAction()
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

        $post_flds = [
            "cd",
            "name",
            "kana",
            "tanni_mr_cd",
            "kousei",
            "tanni_mr1_cd",
            "tanni_mr2_cd",
            "tanka_kbn",
            "zaiko_kbn",
            "irisuu",
            "kikaku",
            "iro",
            "iromei",
            "size",
            "lot",
            "hinsitu_kbn_cd",
            "suu1_shousuu",
            "suu2_shousuu",
            "tanka_shousuu",
            "kazei_kbn_cd",
            "zaikokanri",
            "hacchuu_lot",
            "lead_time",
            "zaiko_tekisei",
            "zaiko_hyouka_kbn_cd",
            "shu_shiiresaki_mr_cd",
            "shu_souko_mr_cd",
            "hacchuu_rendou",
            "gen_zaiko",
            "joudai",
            "uri_tanka1",
            "uri_tanka2",
            "uri_tanka3",
            "uri_tanka4",
            "uri_genka",
            "shiire_tanka",
            "hyoujun_genka",
            "hyoukasage_genka",
            "shouhin_bunrui1_kbn_cd",
            "shouhin_bunrui2_kbn_cd",
            "shouhin_bunrui3_kbn_cd",
            "shouhin_bunrui4_kbn_cd",
            "shouhin_bunrui5_kbn_cd",
            "sanshou_hyouji",
            "memo",
            "updated",
        ];
        $chg_flg = 0;
        foreach ($post_flds as $post_fld) {
            if ($shouhin_mr->$post_fld != $this->request->getPost($post_fld)) {
                $chg_flg = 1;
                break;
            }
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

        $this->_bakOut($shouhin_mr);

        foreach ($post_flds as $post_fld) {
            $shouhin_mr->$post_fld = $this->request->getPost($post_fld);
        }
        $shouhin_mr->suu_shousuu = $this->request->getPost('suu2_shousuu');

        if (!$shouhin_mr->save()) {

            foreach ($shouhin_mr->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "shouhin_mrs",
                'action' => 'edit',
                'params' => array($shouhin_mr->id)
            ));

            return;
        }

        $this->flash->success("商品台帳の情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => 'shouhin_mrs',
            'action' => 'edit',
            'params' => array($id)
        ));
    }

    /**
     * Deletes a shouhin_mr
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $shouhin_mr = ShouhinMrs::findFirstByid($id);
        if (!$shouhin_mr) {
            $this->flash->error("商品台帳が見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "shouhin_mrs",
                'action' => 'index'
            ));

            return;
        }

        if (!$shouhin_mr->delete()) {

            foreach ($shouhin_mr->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "shouhin_mrs",
                'action' => 'search'
            ));

            return;
        }

        $this->_bakOut($shouhin_mr, 1);

        $this->flash->success("商品台帳の削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "shouhin_mrs",
            'action' => "index"
        ));
    }

    /**
     * Back Out a shouhin_mr
     *
     * @param string $shouhin_mr , $dlt_flg
     */
    public function _bakOut($shouhin_mr, $dlt_flg = 0)
    {

        $bak_shouhin_mr = new BakShouhinMrs();
        foreach ($shouhin_mr as $fld => $value) {
            $bak_shouhin_mr->$fld = $shouhin_mr->$fld;
        }
        $bak_shouhin_mr->id = NULL;
        $bak_shouhin_mr->id_moto = $shouhin_mr->id;
        $bak_shouhin_mr->hikae_dltflg = $dlt_flg;
        $bak_shouhin_mr->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_shouhin_mr->hikae_nichiji = date("Y-m-d H:i:s");
        if (!$bak_shouhin_mr->save()) {
            foreach ($bak_shouhin_mr->getMessages() as $message) {
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

    /**
     * 品質区分変更によるコストを取得
     *
     * @return \Phalcon\Http\Response
     */
    public function ajaxHinsituChangeAction ()
    {
        $this->view->disable();
        $response = new \Phalcon\Http\Response();
        $db = \Phalcon\DI::getDefault()->get('db');

        $hinsituKbn = HinsituKbns::find([
            'order' => 'cd',
            'conditions' => ' cd = ?1 ',
            'bind' => [1 => $this->request->getPost('hinsitu_kbn_cd')]
        ]);
        $hinsituHyoukaKbn = $hinsituKbn[0]->hinsitu_hyouka_kbn_cd;
        $shouhin_mr_cd = $this->request->getPost('shouhin_mr_cd');

        switch ($hinsituHyoukaKbn) {
            case 1:
                $phql = "
                    SELECT
                    cd, shiire_tanka AS cost
                    FROM shouhin_mrs
                    WHERE cd = '{$shouhin_mr_cd}'
                 ";
                break;
            case 2:
                $phql = "
                    SELECT
                    cd, hyoukasage_genka AS cost
                    FROM shouhin_mrs
                    WHERE cd = '{$shouhin_mr_cd}'
                 ";
                break;
            case 3:
                $phql = '';
                break;
            default:
                $phql = "";
                break;
        }
        if ($phql === '') {
            $response->setContent(json_encode(['cost' => 0]));
            return $response;
        } else {
            $stmt = $db->prepare($phql);
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $response->setContent(json_encode($rows));
            return $response;
        }
    }


    public function ajaxGetAction()
    {
        $this->view->disable();
        $response = new \Phalcon\Http\Response();

        if (!$this->request->isAjax()) {
            echo "is not Ajax ! ";
        }
        if (!$this->request->isPost()) {
            echo "is not Post ! ";
        }

        $shouhin_mrs = ShouhinMrs::find(array(
            'order' => 'cd',
            'conditions' => ' cd LIKE ?1 ',
            'bind' => array(1 => $this->request->getPost('cd') . '%')
        ));
        $resData = array();
        foreach ($shouhin_mrs as $shouhin_mr) {
            $resData[] = array('id' => $shouhin_mr->id,
                'cd' => $shouhin_mr->cd,
                'name' => $shouhin_mr->name,
                'tanni_mr1_cd' => $shouhin_mr->tanni_mr1_cd,
                'tanni_mr1_name' => $shouhin_mr->TanniMr1s->name,
                'tanni_mr2_cd' => $shouhin_mr->tanni_mr2_cd,
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
                'hyoukasage_genka' => $shouhin_mr->hyoukasage_genka,
                'uri_genka' => $shouhin_mr->uri_genka,
                'joudai' => $shouhin_mr->joudai,
                'uri_tanka1' => $shouhin_mr->uri_tanka1,
                'uri_tanka2' => $shouhin_mr->uri_tanka2,
                'uri_tanka3' => $shouhin_mr->uri_tanka3,
                'uri_tanka4' => $shouhin_mr->uri_tanka4,
                'shiire_tanka' => $shouhin_mr->shiire_tanka,
                'kazei_kbn_cd' => $shouhin_mr->kazei_kbn_cd,
                'zaikokanri' => $shouhin_mr->zaikokanri,
                'shouhin_bunrui1_kbn_cd' => $shouhin_mr->shouhin_bunrui1_kbn_cd,
                'shouhin_bunrui2_kbn_cd' => $shouhin_mr->shouhin_bunrui2_kbn_cd,
                'shouhin_bunrui3_kbn_cd' => $shouhin_mr->shouhin_bunrui3_kbn_cd,
                'shouhin_bunrui4_kbn_cd' => $shouhin_mr->shouhin_bunrui4_kbn_cd,
                'shouhin_bunrui5_kbn_cd' => $shouhin_mr->shouhin_bunrui5_kbn_cd,
                'joukenhyou_cnt' => count($shouhin_mr->JoukenhyouMrs),
                'kousei_buhin_cnt' => count($shouhin_mr->KouseiBuhinMrs),
            );
        }

        //Set the content of the response
        $response->setContent(json_encode($resData));

        //Return the response
        return $response;
    }

    public function grp1Action()
    {
        $criteria = ShouhinMrs::query();
        $criteria->columns(['substr(cd,3,3) as key1', 'max(substr(cd,6,3)) as key2']);
        $criteria->orderBy('substr(cd,3,3)');
        $criteria->groupBy('key1');
        $shouhin_grps = $criteria->execute();
        $this->view->shouhin_grps = $shouhin_grps;

    }

    /**
     * 商品リスト
     */
    public function index_2Action()
    {
        ControllerBase::indexCd("ShouhinMrs", "商品台帳");

    }

    /**
     * 商品リストから更新処理
     *
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
        $post_flds = [
            "cd",
            "name",
            "kana",
            "tanni_mr_cd",
            "kousei",
            "tanni_mr1_cd",
            "tanni_mr2_cd",
            "tanka_kbn",
            "zaiko_kbn",
            "irisuu",
            "kikaku",
            "iro",
            "iromei",
            "size",
            "lot",
            "hinsitu_kbn_cd",
            "suu1_shousuu",
            "suu2_shousuu",
            "tanka_shousuu",
            "kazei_kbn_cd",
            "zaikokanri",
            "hacchuu_lot",
            "lead_time",
            "zaiko_tekisei",
            "zaiko_hyouka_kbn_cd",
            "shu_shiiresaki_mr_cd",
            "shu_souko_mr_cd",
            "hacchuu_rendou",
            "gen_zaiko",
            "joudai",
            "uri_tanka1",
            "uri_tanka2",
            "uri_tanka3",
            "uri_tanka4",
            "uri_genka",
            "shiire_tanka",
            "hyoujun_genka",
            "hyoukasage_genka",
            "shouhin_bunrui1_kbn_cd",
            "shouhin_bunrui2_kbn_cd",
            "shouhin_bunrui3_kbn_cd",
            "shouhin_bunrui4_kbn_cd",
            "shouhin_bunrui5_kbn_cd",
            "sanshou_hyouji",
            "memo",
            "updated",
        ];
        $chg_flg = 0;

        $obj = $this->request->getPost();
        $id = $obj['id'];

        $shouhin_mr = ShouhinMrs::findFirstByid($id);
        if (!$shouhin_mr) {
            $response->setContents(json_encode('Error: 商品マスタが見つからなくなりました。'));
            return $response;
        }

        foreach ($post_flds as $post_fld) {
            if ($shouhin_mr->$post_fld != $this->request->getPost($post_fld)) {
                $chg_flg = 1;
                break;
            }
        }
        if ($chg_flg === 0) {
            $response->setContents(json_encode('Error: no change...'));
            return $response;
        }

        foreach ($post_flds as $post_fld) {
            $shouhin_mr->$post_fld = $this->request->getPost($post_fld);
        }
        $shouhin_mr->suu_shousuu = $this->request->getPost('suu2_shousuu');
        if (!$shouhin_mr->save()) {
            $response->setContents(json_encode($shouhin_mr->getMessage()));
            return $response;
        }

        $response->setContent(json_encode($id));
        return $response;
    }

    /**
     * 商品一覧表モーダル
     *     在庫表示を高速にするため改良 2019/4/3井浦
     */
    public function modalAction()
    {
        //在庫管理しないものの、在庫集計しないよう変更 一時テーブルを使用 2019/9/18 西山
        $this->summaryCd("ZaikoKakuninTbl", "商品", "shouhin_cd", "
        	b.id AS id,
        	b.cd AS shouhin_cd,
        	b.name AS shouhin_name,
        	IF(b.zaikokanri=1,SUM(IF(b.zaiko_kbn=1,zaiko_ryou1s,zaiko_ryou2s)),0) AS sum_zaiko,
        	IF(b.zaiko_kbn=1,c1.name,c2.name) as tanni_name,
        	b.memo AS shouhin_memo,
        	b.updated AS shouhin_updated
        ");
    }

    /**
     * 簡易検索付き一覧表。共通部分
     * メモ欄での抽出追加
     */
    protected function summaryCd($TableId, $table_name, $orgkey = "cd", $columns = "cd", $conditions = "1 ", $having = "") // 例：ControllerBase::indexCd("UriageDts", "売上伝票", $query) 標準キーがcdで無いとき指定できる
    {
        $numberPage = 1;
        $sort = $orgkey;
        $group = 'b.cd';
        $order = "ASC";
        $addlimit = ""; // postからの場合TableSortの機能ではlimitを付加してくれないため、自前で付加する。→view\common\indexsort.phtml
        if ($this->request->isPost()) {
            $pagelimit = $this->request->getPost("pagelimit");
            if ($pagelimit !== 20) {
                $addlimit = "&limit=" . $pagelimit;
            }
        } else {
            $sort = $this->request->getQuery("sort") ?? $sort;
            $sort .= ' ' . $this->request->getQuery("order") ?? $order;
            $numberPage = $this->request->getQuery("page", "int");
            $wherecd = $this->request->getQuery('cd');
            $pagelimit = $this->request->getQuery("limit", "int");
            if (count($this->request->getQuery()) > 2) {
                $parameters = $this->persistent->parameters; // ここへ移動2019/3/29井浦
            } else {
                if ($wherecd) { /* 現在のコードのページを開く */
                    $parameters1 = [];
                    $parameters1["conditions"] = "cd < ?1";
                    $parameters1["bind"] = [1 => $wherecd];
                    $numberPage = ShouhinMrs::count($parameters1) / 20 + 1;
                }
            }
        }
        if (!$pagelimit) {
            $pagelimit = 20;
        }
        if (isset($parameters) && !is_array($parameters)) {
            $parameters = array();
        }
        if ($this->request->getPost("cd")) {
            $parameters["bind"]["shouhin_cd"] = $this->request->getPost("cd") . "%";
        }
        if ($this->request->getPost("name")) {
            $parameters["bind"]["shouhin_name"] = "%" . $this->request->getPost("name") . "%";
        }
        if ($this->request->getPost("zaiko") != '') {
            $parameters["bind"]["zaiko"] = $this->request->getPost("zaiko");
        }
        if ($this->request->getPost("memo") != '') {
            $parameters["bind"]["memo"] = "%" . $this->request->getPost("memo") . "%";
        }
        $parameters["order"] = $sort;
        $parameters["group"] = $group;
        $parameters["columns"] = $columns;
        $parameters["conditions"] = $conditions;

        $this->persistent->parameters = $parameters; // これが無いと次頁などで検索条件が引き継がれない。2019/3/28井浦
        $criteria = $TableId::query();
        $criteria->where($conditions);
        if (isset($parameters['bind']) && $parameters['bind']) {
            foreach ($parameters['bind'] as $whkey => $whval) {
                if ($whkey == "zaiko") {
                    $criteria->having("sum_zaiko-0.0005 > :zaiko:");
                } else {
                    $whkey1 = $whkey == 'shouhin_cd' ? 'b.cd' : $whkey;
                    $whkey1 = $whkey1 == 'shouhin_name' ? 'b.name' : $whkey1;
                    if ($whkey === 'memo') {
                        $whkey2 = $whkey;
                    }
                    $criteria->andWhere($whkey1 . " LIKE :" . $whkey . ":");
                    if (isset($whkey2)) {
                        $criteria->andWhere($whkey2 . " LIKE :" . $whkey2 . ":");
                    }
                    $criteria->andWhere('sanshou_hyouji = 1'); //参照表示するものだけ表示
                }
            }
            $criteria->bind($parameters["bind"]);
        }
        $criteria->orderBy($sort);
        $criteria->groupBy($group);
        $criteria->rightJoin('ShouhinMrs', 'b.cd = shouhin_mr_cd', 'b');
        $criteria->leftJoin('TanniMrs', 'c1.cd = b.tanni_mr1_cd', 'c1');
        $criteria->leftJoin('TanniMrs', 'c2.cd = b.tanni_mr2_cd', 'c2');
        $criteria->columns($columns);
        $tblrows = $criteria->execute();

        if (count($tblrows) == 0) {
            $this->flash->notice("検索の結果、" . $table_name . "は0件でした。");
        }
        $this->view->parasort = $this->request->getQuery("sort") ? '&sort=' . $this->request->getQuery("sort") : '';
        $this->view->parasort .= $this->request->getQuery("order") ? '&order=' . $this->request->getQuery("order") : '';
        $this->view->parasort .= $pagelimit !== 20 ? '&limit=' . $pagelimit : '';
        $this->view->addlimit = $addlimit;

        $paginator = new Paginator(array(
            'data' => $tblrows,
            'limit' => $pagelimit,
            'page' => $numberPage
        ));
        $this->view->page = $paginator->getPaginate();
        $this->tag->setDefault("pagelimit", $pagelimit);
    }
}
