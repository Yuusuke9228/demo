<?php

use Phalcon\Paginator\Adapter\Model as Paginator;
use Phalcon\Mvc\Model\Criteria;

class ZaikoKakuninAzukariVwsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        ControllerBase::indexCd("ZaikoKakuninAzukariVws", "VIEW"); //簡易検索付き一覧表示
    }

    /**
     * Searches for zaiko_kakunin_azukari_vws
     */
    public function searchAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Displays the creation form
     */
    public function newAction($id = null, $dataname = "ZaikoKakuninAzukariVws")
    {
        $this->view->imax = 0;

        if ($id) {
            $nameDts = $dataname;
            $zaiko_kakunin_azukari_vw = $nameDts::findFirstByid($id);
            if (!$zaiko_kakunin_azukari_vw) {
                $this->flash->error("VIEWが見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "zaiko_kakunin_azukari_vws",
                    'action' => 'index'
                ));
                return;
            }
            $this->_setDefault($zaiko_kakunin_azukari_vw, "new", $dataname);
            $this->tag->setDefault("shouhin_mr_cd", null);
            $this->tag->setDefault("cd", null);
        }
    }

    /**
     * 修正画面から「次へ」ボタンを押したら次のコードの修正画面になる。
     */
    public function nextAction($id)
    {
        ControllerBase::nextCd($id, "zaiko_kakunin_azukari_vws", "ZaikoKakuninAzukariVws", "VIEW");
    }

    /**
     * 修正画面から「前へ」ボタンを押したら前のコードの修正画面になる。
     */
    public function prevAction($id)
    {
        ControllerBase::prevCd($id, "zaiko_kakunin_azukari_vws", "ZaikoKakuninAzukariVws", "VIEW");
    }

    /**
     * Edits a zaiko_kakunin_azukari_vw
     *
     * @param string $shouhin_mr_cd
     */
    public function editAction($shouhin_mr_cd)
    {
//        if (!$this->request->isPost()) {

        $zaiko_kakunin_azukari_vw = ZaikoKakuninAzukariVws::findFirstByshouhin_mr_cd($shouhin_mr_cd);
        if (!$zaiko_kakunin_azukari_vw) {
            $this->flash->error("VIEWが見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "zaiko_kakunin_azukari_vws",
                'action' => 'index'
            ));

            return;
        }

        $this->view->shouhin_mr_cd = $zaiko_kakunin_azukari_vw->shouhin_mr_cd;

        $this->_setDefault($zaiko_kakunin_azukari_vw, "edit");
//        }
    }

    /**
     * 画面に表示するデータをセットする
     */
    public function _setDefault($zaiko_kakunin_azukari_vw, $action = "edit", $meisai = "ZaikoKakuninAzukariVws")
    {
        $setdts = ["shouhin_mr_cd",
            "tantou_mr_cd",
            "tanni_mr1_cd",
            "tanni_mr2_cd",
            "iro",
            "iromei",
            "lot",
            "kobetucd",
            "hinsitu_kbn_cd",
            "hinsitu_hyouka_kbn_cd",
            "souko_mr_cd",
            "nyuukobis",
            "shukkobis",
            "nyuushukkobi",
            "nyuushukkoym",
            "denpyou_mr_cd",
            "id",
            "cd",
            "meisai_id",
            "meisai_cd",
            "utiwake_kbn_cd",
            "torihikisaki_cd",
            "bikou",
            "zaiko_ryou1s",
            "zaiko_ryou2s",
            "shiirebi_tankas",
            "shiire_gakus",
            "shiire_ryou1s",
            "shiire_ryou2s",
            "hokanyuuko_ryou1s",
            "hokanyuuko_ryou2s",
            "uriage_ryou1s",
            "uriage_ryou2s",
            "hokashukko_ryou1s",
            "hokashukko_ryou2s",
            "shiiresaki_mr_cd",
            "tokuisaki_mr_cd",
            "nounyuu_kijitu",
            "nouki",
            "hacchuu_dt_id",
            "juchuu_dt_id",
            "hacchuuzan_ryou1",
            "hacchuuzan_ryou2",
            "juchuuzan_ryou1",
            "juchuuzan_ryou2",
            "azukari_zan1s",
            "azukari_zan2s",
            "azukari_tasi1s",
            "azukari_tasi2s",
            "azukari_hiki1s",
            "azukari_hiki2s",
            "sakusei_user_id",
            "created",
            "kousin_user_id",
            "updated",
        ];

        foreach ($setdts as $setdt) {
            if (property_exists($zaiko_kakunin_azukari_vw, $setdt)) {
                $this->tag->setDefault($setdt, $zaiko_kakunin_azukari_vw->$setdt);
            }
        }
    }

    /**
     * Creates a new zaiko_kakunin_azukari_vw
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "zaiko_kakunin_azukari_vws",
                'action' => 'index'
            ));
            return;
        }

        $zaiko_kakunin_azukari_vw = new ZaikoKakuninAzukariVws();

        $post_flds = [];
        $post_flds = ["shouhin_mr_cd",
            "tantou_mr_cd",
            "tanni_mr1_cd",
            "tanni_mr2_cd",
            "iro",
            "iromei",
            "lot",
            "kobetucd",
            "hinsitu_kbn_cd",
            "hinsitu_hyouka_kbn_cd",
            "souko_mr_cd",
            "nyuukobis",
            "shukkobis",
            "nyuushukkobi",
            "nyuushukkoym",
            "denpyou_mr_cd",
            "id",
            "cd",
            "meisai_id",
            "meisai_cd",
            "utiwake_kbn_cd",
            "torihikisaki_cd",
            "bikou",
            "zaiko_ryou1s",
            "zaiko_ryou2s",
            "shiirebi_tankas",
            "shiire_gakus",
            "shiire_ryou1s",
            "shiire_ryou2s",
            "hokanyuuko_ryou1s",
            "hokanyuuko_ryou2s",
            "uriage_ryou1s",
            "uriage_ryou2s",
            "hokashukko_ryou1s",
            "hokashukko_ryou2s",
            "shiiresaki_mr_cd",
            "tokuisaki_mr_cd",
            "nounyuu_kijitu",
            "nouki",
            "hacchuu_dt_id",
            "juchuu_dt_id",
            "hacchuuzan_ryou1",
            "hacchuuzan_ryou2",
            "juchuuzan_ryou1",
            "juchuuzan_ryou2",
            "azukari_zan1s",
            "azukari_zan2s",
            "azukari_tasi1s",
            "azukari_tasi2s",
            "azukari_hiki1s",
            "azukari_hiki2s",
            "sakusei_user_id",
            "created",
            "kousin_user_id",
            "updated",
        ];

        $thisPost = []; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        foreach ($post_flds as $post_fld) {
            $zaiko_kakunin_azukari_vw->$post_fld = array_key_exists($post_fld, $thisPost) ? $thisPost[$post_fld] : $this->request->getPost($post_fld);
        }
        if (!$zaiko_kakunin_azukari_vw->save()) {
            foreach ($zaiko_kakunin_azukari_vw->getMessages() as $message) {
                $this->flash->error($message);
            }
            $this->dispatcher->forward(array(
                'controller' => "zaiko_kakunin_azukari_vws",
                'action' => 'new'
            ));
            return;
        }
        $this->flash->success("VIEWの作成が完了しました。");
        $this->dispatcher->forward(array(
            'controller' => "zaiko_kakunin_azukari_vws",
            'action' => 'edit',
            'params' => array($zaiko_kakunin_azukari_vw->shouhin_mr_cd)
        ));
    }

    /**
     * Saves a zaiko_kakunin_azukari_vw edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "zaiko_kakunin_azukari_vws",
                'action' => 'index'
            ));
            return;
        }
        $shouhin_mr_cd = $this->request->getPost("shouhin_mr_cd");
        $zaiko_kakunin_azukari_vw = ZaikoKakuninAzukariVws::findFirstByshouhin_mr_cd($shouhin_mr_cd);

        if (!$zaiko_kakunin_azukari_vw) {
            $this->flash->error("VIEWが見つからなくなりました。" . $shouhin_mr_cd);

            $this->dispatcher->forward(array(
                'controller' => "zaiko_kakunin_azukari_vws",
                'action' => 'index'
            ));
            return;
        }

        if ($zaiko_kakunin_azukari_vw->updated !== $this->request->getPost("updated")) {
            $this->flash->error("他のプロセスからVIEWが変更されたため更新を中止しました。"
                . $shouhin_mr_cd . ",uid=" . $zaiko_kakunin_azukari_vw->kousin_user_id . " tb=" . $zaiko_kakunin_azukari_vw->updated . " pt=" . $this->request->getPost("updated"));

            $this->dispatcher->forward(array(
                'controller' => "zaiko_kakunin_azukari_vws",
                'action' => 'edit',
                'params' => array($shouhin_mr_cd)
            ));

            return;
        }

        $post_flds = [];
        $post_flds = ["shouhin_mr_cd",
            "tantou_mr_cd",
            "tanni_mr1_cd",
            "tanni_mr2_cd",
            "iro",
            "iromei",
            "lot",
            "kobetucd",
            "hinsitu_kbn_cd",
            "hinsitu_hyouka_kbn_cd",
            "souko_mr_cd",
            "nyuukobis",
            "shukkobis",
            "nyuushukkobi",
            "nyuushukkoym",
            "denpyou_mr_cd",
            "id",
            "cd",
            "meisai_id",
            "meisai_cd",
            "utiwake_kbn_cd",
            "torihikisaki_cd",
            "bikou",
            "zaiko_ryou1s",
            "zaiko_ryou2s",
            "shiirebi_tankas",
            "shiire_gakus",
            "shiire_ryou1s",
            "shiire_ryou2s",
            "hokanyuuko_ryou1s",
            "hokanyuuko_ryou2s",
            "uriage_ryou1s",
            "uriage_ryou2s",
            "hokashukko_ryou1s",
            "hokashukko_ryou2s",
            "shiiresaki_mr_cd",
            "tokuisaki_mr_cd",
            "nounyuu_kijitu",
            "nouki",
            "hacchuu_dt_id",
            "juchuu_dt_id",
            "hacchuuzan_ryou1",
            "hacchuuzan_ryou2",
            "juchuuzan_ryou1",
            "juchuuzan_ryou2",
            "azukari_zan1s",
            "azukari_zan2s",
            "azukari_tasi1s",
            "azukari_tasi2s",
            "azukari_hiki1s",
            "azukari_hiki2s",
            "sakusei_user_id",
            "created",
            "kousin_user_id",
            "updated",
        ];

        $thisPost = []; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        $chg_flg = 0;
        foreach ($post_flds as $post_fld) {
            if ((array_key_exists($post_fld, $thisPost) ? $thisPost[$post_fld] : $this->request->getPost($post_fld)) !== $zaiko_kakunin_azukari_vw->$post_fld) {
                $chg_flg = 1;
                break;
            }
        }
        if ($chg_flg === 0) {
            $this->flash->error("変更がありません。" . $shouhin_mr_cd);

            $this->dispatcher->forward(array(
                "controller" => "zaiko_kakunin_azukari_vws",
                "action" => "edit",
                "params" => array($zaiko_kakunin_azukari_vw->shouhin_mr_cd)
            ));
            return;
        }

        $this->_bakOut($zaiko_kakunin_azukari_vw);

        foreach ($post_flds as $post_fld) {
            $zaiko_kakunin_azukari_vw->$post_fld = array_key_exists($post_fld, $thisPost) ? $thisPost[$post_fld] : $this->request->getPost($post_fld);
        }

        if (!$zaiko_kakunin_azukari_vw->save()) {

            foreach ($zaiko_kakunin_azukari_vw->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "zaiko_kakunin_azukari_vws",
                'action' => 'edit',
                'params' => array($shouhin_mr_cd)
            ));
            return;
        }

        $this->flash->success("VIEWの情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "zaiko_kakunin_azukari_vws",
            'action' => 'edit',
            'params' => array($zaiko_kakunin_azukari_vw->shouhin_mr_cd)
        ));
    }

    /**
     * Deletes a zaiko_kakunin_azukari_vws
     * @param string $shouhin_mr_cd
     */
    public function deleteAction($shouhin_mr_cd)
    {
        $zaiko_kakunin_azukari_vw = ZaikoKakuninAzukariVws::findFirstByshouhin_mr_cd($shouhin_mr_cd);
        if (!$zaiko_kakunin_azukari_vw) {
            $this->flash->error("VIEWが見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "zaiko_kakunin_azukari_vws",
                'action' => 'index'
            ));
            return;
        }

        $this->_bakOut($zaiko_kakunin_azukari_vw, 1);

        if (!$zaiko_kakunin_azukari_vw->delete()) {

            foreach ($zaiko_kakunin_azukari_vw->getMessages() as $message) {
                $this->flash->error($message);
            }
            $this->dispatcher->forward(array(
                'controller' => "zaiko_kakunin_azukari_vws",
                'action' => 'search'
            ));
            return;
        }
        $this->flash->success("VIEWの削除を完了しました。");
        $this->dispatcher->forward(array(
            'controller' => "zaiko_kakunin_azukari_vws",
            'action' => "index"
        ));
    }

    /**
     * Back Out a zaiko_kakunin_azukari_vw
     *
     * @param string $zaiko_kakunin_azukari_vw , $dlt_flg
     */
    public function _bakOut($zaiko_kakunin_azukari_vw, $dlt_flg = 0)
    {

        $bak_zaiko_kakunin_azukari_vw = new BakZaikoKakuninAzukariVws();
        foreach ($zaiko_kakunin_azukari_vw as $fld => $value) {
            $bak_zaiko_kakunin_azukari_vw->$fld = $zaiko_kakunin_azukari_vw->$fld;
        }
        $bak_zaiko_kakunin_azukari_vw->shouhin_mr_cd = NULL;
        $bak_zaiko_kakunin_azukari_vw->moto_shouhin_mr_cd = $zaiko_kakunin_azukari_vw->shouhin_mr_cd;
        $bak_zaiko_kakunin_azukari_vw->hikae_dltflg = $dlt_flg;
        $bak_zaiko_kakunin_azukari_vw->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_zaiko_kakunin_azukari_vw->hikae_nichiji = date("Y-m-d H:i:s");
        if (!$bak_zaiko_kakunin_azukari_vw->save()) {
            foreach ($bak_zaiko_kakunin_azukari_vw->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
    }

    /**
     * 在庫確認
     */
    public function summaryAction()
    {
        $post_flds = [
            "id",
            "cd",
            "name",
            "junjo_kbn_cd",
            "hanni_from",
            "hanni_to",
            "junjo2_kbn_cd",
            "hanni2_from",
            "hanni2_to",
            "koujun_flg",
            "meisaigyou_flg",
            "soukohyouji_flg",
            "goukeigyou_flg",
            "zaikoari_flg",
            "zaikonasi_flg",
            "kabusoku_check_flg",
            "kajou_ryou",
            "husoku_ryou",
            "kijunika_ryou",
        ];
        $setdts = []; // データーの中継変数
        $thisPost = []; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        $thisPost['id'] = $this->request->getPost('id') ?? 1; // あれば、それ、でなければ=1
        $thisFind = [];
        $jouken = JoukenZaikoKakunins::findFirstByid($thisPost['id']);
        if ($jouken) {
            $thisFind['hanni_from_name'] = '';
            $thisFind['hanni_to_name'] = '';
            $thisFind['hanni2_from_name'] = '';
            $thisFind['hanni2_to_name'] = '';
        }
        foreach ($post_flds as $post_fld) {
            $setdts[$post_fld] = array_key_exists($post_fld, $thisPost) ? $thisPost[$post_fld] : $this->request->getPost($post_fld);
            if ($jouken && $setdts[$post_fld] == "") {
                $setdts[$post_fld] = array_key_exists($post_fld, $thisFind) ? $thisFind[$post_fld] : $jouken->$post_fld;
            }
        }
        foreach ($setdts as $fld => $setdt) { // postデータをそのまま返す。
            $this->tag->setDefault($fld, $setdt);
        }

        $condition1 = 'shouhin_mr_cd';
        $condition2 = 'souko_mr_cd';
        $join1tbl = '';
        $join2tbl = 'souko_mrs';
        switch ($setdts['junjo_kbn_cd']) {
            case '1402': // 商品
                $condition1 = 'shouhin_mr_cd';
                $join1tbl = '';
                break;
            case '1403': // 商品分類１
                $condition1 = 'p1a.shouhin_bunrui1_kbn_cd';
                $join1tbl = 'shouhin_bunrui1_kbns';
                break;
            case '1404': // 商品分類２
                $condition1 = 'p1a.shouhin_bunrui2_kbn_cd';
                $join1tbl = 'shouhin_bunrui2_kbns';
                break;
            case '1405': // 商品分類３
                $condition1 = 'p1a.shouhin_bunrui3_kbn_cd';
                $join1tbl = 'shouhin_bunrui3_kbns';
                break;
            case '1406': // 商品分類４
                $condition1 = 'p1a.shouhin_bunrui4_kbn_cd';
                $join1tbl = 'shouhin_bunrui4_kbns';
                break;
            case '1407': // 商品分類５
                $condition1 = 'p1a.shouhin_bunrui5_kbn_cd';
                $join1tbl = 'shouhin_bunrui5_kbns';
                break;
            case '1408': // 主仕入先
                $condition1 = 'p1a.shu_shiiresaki_mr_cd';
                $join1tbl = 'shiiresaki_mrs';
                break;
            case '1409': // 倉庫
                $condition1 = 'souko_mr_cd';
                $join1tbl = 'souko_mrs';
                break;
        }
        switch ($setdts['junjo2_kbn_cd']) {
            case '1402': // 商品
                $condition2 = 'shouhin_mr_cd';
                $join2tbl = '';
                break;
            case '1403': // 商品分類１
                $condition2 = 'p1a.shouhin_bunrui1_kbn_cd';
                $join2tbl = 'shouhin_bunrui1_kbns';
                break;
            case '1404': // 商品分類２
                $condition2 = 'p1a.shouhin_bunrui2_kbn_cd';
                $join2tbl = 'shouhin_bunrui2_kbns';
                break;
            case '1405': // 商品分類３
                $condition2 = 'p1a.shouhin_bunrui3_kbn_cd';
                $join2tbl = 'shouhin_bunrui3_kbns';
                break;
            case '1406': // 商品分類４
                $condition2 = 'p1a.shouhin_bunrui4_kbn_cd';
                $join2tbl = 'shouhin_bunrui4_kbns';
                break;
            case '1407': // 商品分類５
                $condition2 = 'p1a.shouhin_bunrui5_kbn_cd';
                $join2tbl = 'shouhin_bunrui5_kbns';
                break;
            case '1408': // 主仕入先
                $condition2 = 'p1a.shu_shiiresaki_mr_cd';
                $join2tbl = 'shiiresaki_mrs';
                break;
            case '1409': // 倉庫
                $condition2 = 'souko_mr_cd';
                $join2tbl = 'souko_mrs';
                break;
        }

        if ($condition1 != "souko_mr_cd") {
            $binda = ["c1" => $setdts['hanni_from'], "c2" => $setdts['hanni_to']];
        } else {
            $binda = ["c3" => $setdts['hanni2_from'], "c4" => $setdts['hanni2_to']];
        }
        $rows = ZaikoKakuninAzukariVws::findZaikos([
            "groupby" => [
                ($condition1 == 'souko_mr_cd') ? "souko_mr_cd,shouhin_mr_cd" : "shouhin_mr_cd,souko_mr_cd",
            ],
            "joins" => "LEFT JOIN tanni_mrs p1c ON p1c.cd = p1.tanni_mr1_cd
						LEFT JOIN tanni_mrs p1d ON p1d.cd = p1.tanni_mr2_cd
			" . ($join1tbl ? "LEFT JOIN " . $join1tbl . " bk1 ON bk1.cd = " . $condition1 : "") . "
			" . ($join2tbl ? "LEFT JOIN " . $join2tbl . " bk2 ON bk2.cd = " . $condition2 : ""),
            "fields" => ", p1a.name
						, p1a.suu_shousuu
						, p1a.zaiko_tekisei as zaiko_tekisei_ryou
						, p1c.name AS tanni_mr_name1
						, p1d.name AS tanni_mr_name2
						, p1a.tanka_kbn as tanka_kbn
						, p1a.shiire_tanka as shiire_tanka
						, p1a.hacchuu_lot as hacchuu_lot
						, p1a.lead_time as lead_time
						, " . $condition1 . " AS bkey
						, " . $condition2 . " AS bkey2
						, " . ($join1tbl ? "bk1.name" : "''") . " AS bk1name
						, " . ($join2tbl ? "bk2.name" : "''") . " AS bk2name",
            "conditions" => "p1a.zaikokanri = 1	AND " . $condition1 . " >= :c1 AND " . $condition1 . " <= :c2 AND " . $condition2 . " >= :c3 AND " . $condition2 . " <= :c4" . ($this->request->isPost() ? "" : " AND FALSE")
            ,
            "kyou" => '9999-12-31',
            "bind" => ["c1" => $setdts['hanni_from'], "c2" => $setdts['hanni_to'], "c3" => $setdts['hanni2_from'], "c4" => $setdts['hanni2_to']],
            "orderby" => "hinsitu_hyouka_kbn_cd" . ($setdts['koujun_flg'] == 1 ? " DESC" : "") .
                "," . $condition1 . ($setdts['koujun_flg'] == 1 ? " DESC" : "") .
                (($condition2 == 'souko_mr_cd') ? "" : ("," . $condition2 . ($setdts['koujun_flg'] == 1 ? " DESC" : ""))) .
                ",shouhin_mr_cd" . ($setdts['koujun_flg'] == 1 ? " DESC" : "") .
                ($setdts['soukohyouji_flg'] == 1 && $condition2 == 'souko_mr_cd' ? ("," . $condition2 . ($setdts['koujun_flg'] == 1 ? " DESC" : "")) : "")
        ]);

        $jouken_zaiko_kakunins = JoukenZaikoKakunins::find(["order" => "cd, sakusei_user_id"
            , "conditions" => "sakusei_user_id IN(0, ?0)"
            , "bind" => [0 => $this->getDI()->getSession()->get('auth')['id']]
        ]);
        $joukens = [];
        foreach ($jouken_zaiko_kakunins as $jouken_zaiko_kakunin) {
            $joukens[$jouken_zaiko_kakunin->cd] = $jouken_zaiko_kakunin->name;
        }
        $this->view->joukens = $joukens;
        $this->view->rows = $rows;
        $this->view->setdts = $setdts;
        return;
    }

    /**
     * 預り集計表
     *     仕入の場合、仕入先マスタの関連得意先コードを取引先として集計するように変更 2019/3/28井浦
     */
    public function azukariAction()
    {
        $this->summaryCd("ZaikoKakuninAzukariVws", "預り", "torihikisaki1_cd, shouhin_mr_cd", "
        	if(denpyou_mr_cd='shiire',p1d.tokuisaki_mr_cd,torihikisaki_cd) torihikisaki1_cd,
        	if(denpyou_mr_cd='shiire',p1d.name,p1b.name) as torihikisaki_name,
        	shouhin_mr_cd,
        	p1a.name as shouhin_name,
        	SUM(azukari_zan1s) AS azukari_zan1,
        	SUM(if(tanka_kbn=1,azukari_zan1s,azukari_zan2s)) AS azukari_zan2,
        	p1c.name AS tanni_name2
        ", "
        	azukari_zan2s<>0 or azukari_zan1s<>0
        "); //簡易検索付き表示
    }

    /**
     * 簡易検索付き集計表。共通部分
     */
    protected function summaryCd($TableId, $table_name, $orgkey = "cd", $columns = "cd", $conditions = "") // 例：ControllerBase::indexCd("UriageDts", "売上伝票", $query) 標準キーがcdで無いとき指定できる
    {
        $numberPage = 1;
        $sort = $orgkey;
        $group = $orgkey;
        $order = "ASC";
        $wherecd = "";
        $addlimit = ""; // postからの場合TableSortの機能ではlimitを付加してくれないため、自前で付加する。→view\common\indexsort.phtml
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, $TableId, $_POST);
            $this->persistent->parameters = $query->getParams();
            $pagelimit = $this->request->getPost("pagelimit");
            $simebi = $this->request->getPost("simebi");

            if ($pagelimit !== 20) {
                $addlimit = "&limit=" . $pagelimit;
            }

        } else {
            $sort = $this->request->getQuery("sort") ?? $sort;
            $sort .= ' ' . $this->request->getQuery("order") ?? $order;
            $numberPage = $this->request->getQuery("page", "int");
            $wherecd = $this->request->getQuery($orgkey);
            $pagelimit = $this->request->getQuery("limit", "int");
            $simebi = $this->request->getQuery("date");
            if (count($this->request->getQuery()) > 1) {
                $parameters = $this->persistent->parameters; // ここへ移動2019/3/29井浦
            }
        }
        if (!$pagelimit) {
            $pagelimit = 20;
        }
        if (!$simebi) {
            $simebi = date("Y-m-d");
        }
        // $parameters = $this->persistent->parameters; ここはだめ2019/3/29井浦
        if (!is_array($parameters)) {
            $parameters = array();
        }
        if ($this->request->getPost("torihikisaki_cd")) {
            $parameters["bind"]["torihikisaki_cd"] = $this->request->getPost("torihikisaki_cd") . "%";
        }
        if ($this->request->getPost("torihikisaki_name")) {
            $parameters["bind"]["torihikisaki_name"] = "%" . $this->request->getPost("torihikisaki_name") . "%";
        }
        if ($this->request->getPost("shouhin_mr_cd")) {
            $parameters["bind"]["shouhin_mr_cd"] = $this->request->getPost("shouhin_mr_cd") . "%";
        }
        if ($this->request->getPost("shouhin_name")) {
            $parameters["bind"]["shouhin_name"] = "%" . $this->request->getPost("shouhin_name") . "%";
        }
        if ($this->request->getPost("simebi")) {
            $parameters["bind"]["simebi"] = $simebi;
        }
        $parameters["order"] = $sort;
        $parameters["group"] = $group;
        $parameters["columns"] = $columns;
        $parameters["conditions"] = $conditions;

        $this->persistent->parameters = $parameters; // これが無いと次頁などで検索条件が引き継がれない。2019/3/28井浦

        /*
                if ($wherecd) { // 現在のコードのページを開く
                    $parameters1 = $parameters;
                    $parameters1["conditions"] = "cd < '". $wherecd ."'";
                    $numberPage = $TableId::count($parameters1) / 10 + 1;
                }
        */
        /* * デバッグ
         echo "<pre>";
         var_dump($parameters);
         echo "</pre>";
         return;
        */
        $criteria = $TableId::query();
        $criteria->where($conditions);
        if ($parameters["bind"]) {
            foreach ($parameters["bind"] as $whkey => $whval) {
                $whkey1 = $whkey == 'torihikisaki_cd' ? 'if(denpyou_mr_cd="shiire",p1d.tokuisaki_mr_cd,torihikisaki_cd)' : $whkey;
                $whkey1 = $whkey == 'torihikisaki_name' ? 'if(denpyou_mr_cd="shiire",p1d.name,p1b.name)' : $whkey;
                $whkey1 = $whkey1 == 'shouhin_name' ? 'p1a.name' : $whkey1;
                $whkey1 = $whkey1 == 'simebi' ? 'nyuushukkobi' : $whkey1;
                $criteria->andWhere($whkey1 . ($whkey == 'simebi' ? " <= :" : " LIKE :") . $whkey . ":");
            }
            $criteria->bind($parameters["bind"]);
        }
        $criteria->orderBy($sort);
        $criteria->groupBy($group);
        $criteria->leftJoin('ShouhinMrs', 'p1a.cd = shouhin_mr_cd', 'p1a');
        $criteria->leftJoin('TokuisakiMrs', 'p1b.cd = torihikisaki_cd', 'p1b');
        $criteria->leftJoin('TanniMrs', 'p1c.cd = if(p1a.tanka_kbn=1,p1a.tanni_mr1_cd,p1a.tanni_mr2_cd)', 'p1c');
        $criteria->leftJoin('ShiiresakiMrs', 'p1d.cd = torihikisaki_cd', 'p1d');
        $criteria->columns($columns);
        $tblrows = $criteria->execute();

        if (count($tblrows) == 0) {
            $this->flash->notice("検索の結果、" . $table_name . "は0件でした。");
        }

        $this->view->parasort = $this->request->getQuery("sort") ? '&sort=' . $this->request->getQuery("sort") : '';
        $this->view->parasort .= $this->request->getQuery("order") ? '&order=' . $this->request->getQuery("order") : '';
        $this->view->parasort .= $pagelimit !== 20 ? '&limit=' . $pagelimit : '';
        $this->view->parasort .= '&date=' . $simebi;
        $this->view->addlimit = $addlimit;

        $paginator = new Paginator(array(
            'data' => $tblrows,
            'limit' => $pagelimit,
            'page' => $numberPage
        ));
        $this->view->page = $paginator->getPaginate();
        $this->tag->setDefault("pagelimit", $pagelimit);
        $this->tag->setDefault("simebi", $simebi);
    }

    /*
     * 売上仕入比較表
     * Add By Nishiyama 2019/4/4
     *
     */
    public function uri_shiire_hikakuAction()
    {
        $di = \Phalcon\DI::getDefault();
        $mgr = $di->get('modelsManager');
        $condition = [];
        if ($this->request->getPost()) {
            $param = $this->request->getPost();
            $where = " WHERE (a.nyuushukkobi BETWEEN :kikan1: AND :kikan2:)";
            if ($param['shouhin_mr_cd'] !== '') {
                if ($param['name'] !== '') {
                    $where .= " AND (a.shouhin_mr_cd LIKE :cd:) AND (b.name LIKE :name:) ";
                    $condition += ["cd" => $param['shouhin_mr_cd'] . '%', "name" => '%' . $param['name'] . '%',];
                } else {
                    $where .= " AND (a.shouhin_mr_cd LIKE :cd:) ";
                    $condition += ["cd" => $param['shouhin_mr_cd'] . '%',];
                }
            } else {
                if ($param['name'] !== '') {
                    $where .= " AND (b.name LIKE :name:) ";
                    $condition += ["name" => '%' . $param['name'] . '%',];
                }
            }
            $condition += ["kikan1" => trim($param['kikan_from']), "kikan2" => trim($param['kikan_from']),];
            $phql = "
			SELECT
                    a.shouhin_mr_cd,
                    b.name as shouhin_name,
                    COALESCE(SUM(a.uriage_ryou2s),0) as uriage_ryou2,
                    COALESCE(SUM(a.shiire_ryou2s),0) as shiire_ryou2,
                    (COALESCE(SUM(a.uriage_ryou2s),0) - COALESCE(SUM(a.shiire_ryou2s),0)) as zaiko_sabun,
                    COALESCE(SUM(e.zeinukigaku),0) as uriage_gaku,
                    COALESCE(SUM(a.shiire_gakus),0) as shiire_gaku,
                    (COALESCE(SUM(e.zeinukigaku),0) - COALESCE(SUM(a.shiire_gakus),0)) as kingaku_sabun
                FROM ZaikoKakuninAzukariVws AS a
                LEFT JOIN ShouhinMrs AS b ON b.cd = a.shouhin_mr_cd
                LEFT JOIN TanniMrs AS c ON c.cd = b.tanni_mr1_cd
                LEFT JOIN TanniMrs AS d ON d.cd = b.tanni_mr2_cd
                LEFT JOIN UriageMeisaiDts AS e ON e.id = a.meisai_id
                " . $where . "
                GROUP BY a.shouhin_mr_cd   
                ORDER BY a.shouhin_mr_cd
            ";

            $rows = $mgr->executeQuery($phql, $condition);
            $this->view->rows = $rows;
        } else {
            $phql = "
			SELECT
				a.shouhin_mr_cd,
				b.name as shouhin_name,
				COALESCE(SUM(a.uriage_ryou2s),0) as uriage_ryou2,
				COALESCE(SUM(a.shiire_ryou2s),0) as shiire_ryou2,
				(COALESCE(SUM(a.uriage_ryou2s),0) - COALESCE(SUM(a.shiire_ryou2s),0)) as zaiko_sabun,
				COALESCE(SUM(e.zeinukigaku),0) as uriage_gaku,
				COALESCE(SUM(a.shiire_gakus),0) as shiire_gaku,
				(COALESCE(SUM(e.zeinukigaku),0) - COALESCE(SUM(a.shiire_gakus),0)) as kingaku_sabun
			FROM ZaikoKakuninAzukariVws AS a
			LEFT JOIN ShouhinMrs AS b ON b.cd = a.shouhin_mr_cd
			LEFT JOIN TanniMrs AS c ON c.cd = b.tanni_mr1_cd
			LEFT JOIN TanniMrs AS d ON d.cd = b.tanni_mr2_cd
			LEFT JOIN UriageMeisaiDts AS e ON e.id = a.meisai_id
			WHERE (a.nyuushukkobi BETWEEN :kikan1: AND :kikan2:)
			GROUP BY a.shouhin_mr_cd
			ORDER BY a.shouhin_mr_cd
		    ";
            $month = null;
            $firstDate = date('Y-m-d', strtotime('first day of ' . $month));
            $lastDate = date('Y-m-d', strtotime('last day of ' . $month));
            $rows = $mgr->executeQuery($phql, [
                "kikan1" => $firstDate,
                "kikan2" => $lastDate
            ]);
            $this->view->rows = $rows;
        }
    }

    /**
     * 伝票検索モーダル
     */
    public function den_modalAction()
    {
        ControllerBase::indexCd("ZaikoKakuninAzukariVws", "各伝票", "updated DESC,cd,meisai_cd"); //簡易検索付き一覧表示
        $parameters = $this->persistent->parameters;
        @$this->tag->setDefault("nyuushukkobi", $parameters["bind"]["nyuushukkobi"] ?? "");
        @$this->tag->setDefault("cd", $parameters["bind"]["cd"] ?? "");
        @$this->tag->setDefault("shouhin_mr_cd", substr($parameters["bind"]["shouhin_mr_cd"], 1, -1) ?? "");
        @$this->tag->setDefault("souko_mr_cd", substr($parameters["bind"]["souko_mr_cd"], 1, -1) ?? "");
        @$this->tag->setDefault("kousin_user_id", $parameters["bind"]["kousin_user_id"] ?? "");
        @$this->tag->setDefault("denpyou_mr_cd", substr($parameters["bind"]["denpyou_mr_cd"], 1, -1) ?? "");
    }

    /**
     * 伝票検索モーダル
     */
    public function den_modal1Action()
    {
        ControllerBase::indexCd("ZaikoKakuninAzukariVws", "各伝票", "updated DESC,cd,meisai_cd"); //簡易検索付き一覧表示
        $parameters = $this->persistent->parameters;
        @$this->tag->setDefault("nyuushukkobi", $parameters["bind"]["nyuushukkobi"] ?? "");
        @$this->tag->setDefault("cd", $parameters["bind"]["cd"] ?? "");
        @$this->tag->setDefault("shouhin_mr_cd", substr($parameters["bind"]["shouhin_mr_cd"], 1, -1) ?? "");
        @$this->tag->setDefault("souko_mr_cd", substr($parameters["bind"]["souko_mr_cd"], 1, -1) ?? "");
        @$this->tag->setDefault("kousin_user_id", $parameters["bind"]["kousin_user_id"] ?? "");
        @$this->tag->setDefault("denpyou_mr_cd", substr($parameters["bind"]["denpyou_mr_cd"], 1, -1) ?? "");
    }

    /*
     * @TODO 在庫締め 10/10 Yuusuke Nishiyama
     */
    public function zaiko_shimeAction()
    {
        $shime_date = '2019-09-30'; //program test
        $kikan_ym = date('Ym', strtotime($shime_date)); //nyuushukkoym
        $binda = ["nyuushukkoym" => $kikan_ym];
        //現時点での在庫単価を取得する
        $t_rows = ZaikoKakuninAzukariVws::findZaikos([
            "kyou" => date('Y-m-d', strtotime($shime_date)), //
            "groupby" => [
                "tanka_tanni_mr_cd",
                "shouhin_mr_cd",
                "nyuushukkoym",
            ],
            "joins" => "LEFT JOIN zaiko_hyouka_kbns p1b ON p1b.cd = p1a.zaiko_hyouka_kbn_cd",
            "fields" => ", p1a.hyoujun_genka AS hyoujun_genka
						 , p1a.zaiko_hyouka_kbn_cd
						 , p1a.tanka_kbn",
            "conditions" => "hinsitu_hyouka_kbn_cd = 1 AND zaiko_hyouka_kbn_cd > 1",// 標準原価法の商品を除く
            "bind" => '',
            "orderby" => "tanka_tanni_mr_cd, shouhin_mr_cd, nyuushukkoym",
        ]);


        $t_ary = []; // 単価配列 [単価単位コード][商品コード][0=今月,1=前月]
        $tanni_cd = '';
        $shouhin_cd = '';
        $shime_tankas = []; //Model配列
        $idx = 0;
        foreach ($t_rows as $t_row) {
            if ($t_row['tanka_tanni_mr_cd'] != $tanni_cd) {
                $tanni_cd = $t_row['tanka_tanni_mr_cd'];
                $t_ary[$tanni_cd] = [];
            }
            if ($t_row['shouhin_mr_cd'] != $shouhin_cd) {
                $shouhin_cd = $t_row['shouhin_mr_cd'];
                $t_ary[$tanni_cd][$shouhin_cd] = [];
                $t_ary[$tanni_cd][$shouhin_cd][1] = $t_ary[$tanni_cd][$shouhin_cd][0] = $t_row['hyoujun_genka'];
                $zengetu_gaku = $zengetu_zaiko = 0;
            }
            if ($t_row['zaiko_hyouka_kbn_cd'] == 2) { // 最終仕入原価法
                if ($t_row['shiirebi_tanka'] != '0000-00-000') {
                    $t_ary[$tanni_cd][$shouhin_cd][0] = floatval(substr($t_row['shiirebi_tanka'], 10));
                }
                if ($t_row['nyuushukkoym'] < $kikan_ym) {
                    $t_ary[$tanni_cd][$shouhin_cd][1] = $t_ary[$tanni_cd][$shouhin_cd][0];
                }
            } else { // 月別総平均法
                if ($zengetu_zaiko + $t_row['shiire_ryou' . ($t_row['tanka_tanni_mr_cd'] == $t_row['tanni_mr1_cd'] ? '1' : '2')] != 0) {
                    $t_ary[$tanni_cd][$shouhin_cd][0] = ($zengetu_gaku + $t_row['shiire_gaku'])
                        / ($zengetu_zaiko + $t_row['shiire_ryou' . ($t_row['tanka_tanni_mr_cd'] == $t_row['tanni_mr1_cd'] ? '1' : '2')]
                            + $t_row['hokanyuuko_ryou' . ($t_row['tanka_tanni_mr_cd'] == $t_row['tanni_mr1_cd'] ? '1' : '2')]);
                }
                if ($t_row['nyuushukkoym'] < $kikan_ym) {
                    $t_ary[$tanni_cd][$shouhin_cd][1] = $t_ary[$tanni_cd][$shouhin_cd][0];
                    $zengetu_zaiko += $t_row['zaiko_ryou' . ($t_row['tanka_tanni_mr_cd'] == $t_row['tanni_mr1_cd'] ? '1' : '2')];
                    $zengetu_gaku = $t_ary[$tanni_cd][$shouhin_cd][1] * $zengetu_zaiko;
                }

            }
            //shime_tanka_dtsへの保存データを作る
            if ($t_row['nyuushukkoym'] === $kikan_ym) {
                $shime_tankas[$idx]['nyuushukkoym'] = $kikan_ym;
                $shime_tankas[$idx]['shouhin_mr_cd'] = $t_row['shouhin_mr_cd'];
                $shime_tankas[$idx]['zengetsu_tanka'] = round((float)$t_ary[$tanni_cd][$shouhin_cd][0], 4);
                $shime_tankas[$idx]['tougetsu_tanka'] = round((float)$t_ary[$tanni_cd][$shouhin_cd][1], 4);
                $shime_tankas[$idx]['tanka_kbn'] = $t_row['tanka_kbn'];
                $shime_tankas[$idx]['zaiko_hyouka_kbn_cd'] = $t_row['zaiko_hyouka_kbn_cd'];

                $idx++;
            }
        }

        $shimezumi_tanka_count = ShimeTankasDts::count('nyuushukkoym = ' . $kikan_ym);

        if ($shimezumi_tanka_count === 0) {
            //取得単価データ保存
            foreach ($shime_tankas as $shime_tanka) {
                $zaiko_tanka = new ShimeTankasDts($shime_tanka);
                if ($zaiko_tanka->create() === false) {
                    foreach ($zaiko_tanka->getMessages() as $message) {
                        echo $message, "\n";
                    }
                }
            }
        } else {
            echo '指定された月度は既に締切り処理が行われています', PHP_EOL;
            exit;   //取り敢えずテストなのでexit;
        }

        //月次データ作成
        $shime_row = ZaikoKakuninAzukariVws::find('nyuushukkoym = ' . $kikan_ym);
        $shimezumi_data_count = TestZaikoShime::count('nyuushukkoym = ' . $kikan_ym);
        if ($shimezumi_data_count === 0) {
            //取得データ保存
            foreach ($shime_row->toArray() as $zaiko) {
                $zaiko_shime = new TestZaikoShime($zaiko);
                if ($zaiko_shime->create() === false) {
                    foreach ($zaiko_shime->getMessages() as $message) {
                        echo $message, "\n";
                    }
                }
            }
        } else {
            echo '指定された月度は既に締切り処理が行われています', PHP_EOL;
            exit;   //取り敢えずテストなのでexit;
        }
        echo 'OK';
        exit;
    }

    /*
     * Excel出力 2019/11/01 Nishiyama
     */
    public function indexxlsxAction()
    {
        $post_flds = [
            "id",
            "cd",
            "name",
            "junjo_kbn_cd",
            "hanni_from",
            "hanni_to",
            "junjo2_kbn_cd",
            "hanni2_from",
            "hanni2_to",
            "koujun_flg",
            "meisaigyou_flg",
            "soukohyouji_flg",
            "goukeigyou_flg",
            "zaikoari_flg",
            "zaikonasi_flg",
            "kabusoku_check_flg",
            "kajou_ryou",
            "husoku_ryou",
            "kijunika_ryou",
        ];
        $setdts = []; // データーの中継変数
        $thisPost = []; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        $thisPost['id'] = $this->request->getPost('id') ?? 1; // あれば、それ、でなければ=1
        $thisFind = [];
        $jouken = JoukenZaikoKakunins::findFirstByid($thisPost['id']);
        if ($jouken) {
            $thisFind['hanni_from_name'] = '';
            $thisFind['hanni_to_name'] = '';
            $thisFind['hanni2_from_name'] = '';
            $thisFind['hanni2_to_name'] = '';
        }
        foreach ($post_flds as $post_fld) {
            $setdts[$post_fld] = array_key_exists($post_fld, $thisPost) ? $thisPost[$post_fld] : $this->request->getPost($post_fld);
            if ($jouken && $setdts[$post_fld] == "") {
                $setdts[$post_fld] = array_key_exists($post_fld, $thisFind) ? $thisFind[$post_fld] : $jouken->$post_fld;
            }
        }

        foreach ($setdts as $fld => $setdt) { // postデータをそのまま返す。
            $this->tag->setDefault($fld, $setdt);
        }

        $condition1 = 'shouhin_mr_cd';
        $condition2 = 'souko_mr_cd';
        $join1tbl = '';
        $join2tbl = 'souko_mrs';
        switch ($setdts['junjo_kbn_cd']) {
            case '1402': // 商品
                $condition1 = 'shouhin_mr_cd';
                $join1tbl = '';
                break;
            case '1403': // 商品分類１
                $condition1 = 'p1a.shouhin_bunrui1_kbn_cd';
                $join1tbl = 'shouhin_bunrui1_kbns';
                break;
            case '1404': // 商品分類２
                $condition1 = 'p1a.shouhin_bunrui2_kbn_cd';
                $join1tbl = 'shouhin_bunrui2_kbns';
                break;
            case '1405': // 商品分類３
                $condition1 = 'p1a.shouhin_bunrui3_kbn_cd';
                $join1tbl = 'shouhin_bunrui3_kbns';
                break;
            case '1406': // 商品分類４
                $condition1 = 'p1a.shouhin_bunrui4_kbn_cd';
                $join1tbl = 'shouhin_bunrui4_kbns';
                break;
            case '1407': // 商品分類５
                $condition1 = 'p1a.shouhin_bunrui5_kbn_cd';
                $join1tbl = 'shouhin_bunrui5_kbns';
                break;
            case '1408': // 主仕入先
                $condition1 = 'p1a.shu_shiiresaki_mr_cd';
                $join1tbl = 'shiiresaki_mrs';
                break;
            case '1409': // 倉庫
                $condition1 = 'souko_mr_cd';
                $join1tbl = 'souko_mrs';
                break;
        }
        switch ($setdts['junjo2_kbn_cd']) {
            case '1402': // 商品
                $condition2 = 'shouhin_mr_cd';
                $join2tbl = '';
                break;
            case '1403': // 商品分類１
                $condition2 = 'p1a.shouhin_bunrui1_kbn_cd';
                $join2tbl = 'shouhin_bunrui1_kbns';
                break;
            case '1404': // 商品分類２
                $condition2 = 'p1a.shouhin_bunrui2_kbn_cd';
                $join2tbl = 'shouhin_bunrui2_kbns';
                break;
            case '1405': // 商品分類３
                $condition2 = 'p1a.shouhin_bunrui3_kbn_cd';
                $join2tbl = 'shouhin_bunrui3_kbns';
                break;
            case '1406': // 商品分類４
                $condition2 = 'p1a.shouhin_bunrui4_kbn_cd';
                $join2tbl = 'shouhin_bunrui4_kbns';
                break;
            case '1407': // 商品分類５
                $condition2 = 'p1a.shouhin_bunrui5_kbn_cd';
                $join2tbl = 'shouhin_bunrui5_kbns';
                break;
            case '1408': // 主仕入先
                $condition2 = 'p1a.shu_shiiresaki_mr_cd';
                $join2tbl = 'shiiresaki_mrs';
                break;
            case '1409': // 倉庫
                $condition2 = 'souko_mr_cd';
                $join2tbl = 'souko_mrs';
                break;
        }

        $db = \Phalcon\DI::getDefault()->get('db');
        $hann1_from = "'" . $setdts['hanni_from'] . "'";
        $hann1_to = "'" . $setdts['hanni_to'] . "'";
        $hann2_from = "'" . $setdts['hanni2_from'] . "'";
        $hann2_to = "'" . $setdts['hanni2_to'] . "'";
        $phql = "
            SELECT p1s.name as k_name
                , p1c.name as k2_name
                , p1.shouhin_mr_cd AS shouhin_mr_cd
                , p1.tanni_mr1_cd
                , p1.tanni_mr2_cd
                , ROUND(SUM(p1.zaiko_ryou1s),2) AS zaiko_ryou1
                , ROUND(SUM(p1.zaiko_ryou2s),2) AS zaiko_ryou2
                , ROUND(SUM(p1.hacchuuzan_ryou1) - SUM(CASE WHEN p1.utiwake_kbn_cd = '21' THEN p1.hacchuuzan_ryou1 ELSE 0 END),2) AS hacchuuzan_ryou1
                , ROUND(SUM(CASE WHEN p1.utiwake_kbn_cd = '21' THEN p1.hacchuuzan_ryou1 ELSE 0 END),2) AS hikiate_ryou1
                , ROUND(SUM(p1.hacchuuzan_ryou2) - SUM(CASE WHEN p1.utiwake_kbn_cd = '21' THEN p1.hacchuuzan_ryou2 ELSE 0 END),2) AS hacchuuzan_ryou2
                , ROUND(SUM(CASE WHEN p1.utiwake_kbn_cd = '21' THEN p1.hacchuuzan_ryou2 ELSE 0 END),2) AS hikiate_ryou2
                , ROUND(SUM(p1.juchuuzan_ryou1),2) AS juchuuzan_ryou1
                , ROUND(SUM(p1.juchuuzan_ryou2),2) AS juchuuzan_ryou2
            FROM zaiko_kakunin_azukari_vws AS p1
			LEFT JOIN shouhin_mrs p1a ON p1a.cd = p1.shouhin_mr_cd
			LEFT JOIN $join1tbl p1s ON p1s.cd = $condition1
			LEFT JOIN $join2tbl p1c ON p1c.cd = $condition2
			WHERE $condition1 BETWEEN  $hann1_from AND $hann1_to
			AND $condition2 BETWEEN  $hann2_from AND $hann2_to
			GROUP BY p1a.cd, p1.tanni_mr1_cd, p1.tanni_mr2_cd,$condition1, $condition2
		";
        $stmt = $db->prepare($phql);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $data_title = [];
        $data_title[0] = [
            "k_name" => "キー1名称",
            "k2_name" => "キー2名称",
            "shouhin_mr_cd" => "商品コード",
            "tanni_mr1_cd" => "単位1",
            "tanni_mr2_cd" => "単位2",
            "zaiko_ryou1" => "在庫1",
            "zaiko_ryou2" => "在庫2",
            "hacchuuzan_ryou1" => "発注残1",
            "hikiate_ryou1" => "引き当て量1",
            "hacchuuzan_ryou2" => "発注残2",
            "hikiate_ryou2" => "引き当て2",
            "juchuuzan_ryou1" => "受注残1",
            "juchuuzan_ryou2" => "受注残2",
        ];
        $data_sets = array_merge($data_title, $rows); //見出しとデータのマージ

        include __DIR__ . '/../vendor/PHPExcel/Classes/PHPExcel.php';
        include __DIR__ . '/../vendor/PHPExcel/Classes/PHPExcel/Writer/Excel2007.php';
        include __DIR__ . '/../vendor/PHPExcel/Classes/PHPExcel/IOFactory.php';
        $PHPExcel = new PHPExcel();
        $sheet = $PHPExcel->getActiveSheet();
        $sheet->fromArray($data_sets, null, 'A1');

        $filename = uniqid("zaiko_kakunindt", true) . '';
        $upload = __DIR__ . '/temp/';
        $path = $upload . $filename;
        $objWriter = PHPExcel_IOFactory::createWriter($PHPExcel, 'Excel2007');
        $objWriter->save($path);

        $response = new \Phalcon\Http\Response();
        $response->setHeader('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        $response->setHeader('Content-Disposition', 'attachment;filename="' . $filename . '"');
        $response->setHeader('Cache-Control', 'max-age=0');
        $response->setHeader('Cache-Control', 'max-age=1');
        $response->setContent(file_get_contents($path));
        unlink($path);
        return $response;
    }

    /**
     * 構成部品在庫照会
     */
    public function kouseibuhin_zaikoAction()
    {
        $rows = [];
        if ($this->request->isPost()) {
            $shouhin_cd = $this->request->getPost('shouhin_mr_cd');
            $db = \Phalcon\DI::getDefault()->get('db');
            $condition = ["shouhin_mr_cd" => $shouhin_cd,];

            $phql = "
                SELECT
                    a.cd,
                    a.gen_shouhin_mr_cd AS genryou_cd,
                    c.name AS genryou_name,
                    d.name AS tanni,
                    a.suuryou AS kousei_suuryou,
                    c.zaiko_kbn AS zaiko_kbn,
                    SUM(b.zaiko_ryou1s) AS zaiko1,
                    SUM(b.zaiko_ryou2s) AS zaiko2,
                    SUM(b.hacchuuzan_ryou1) - SUM(CASE WHEN b.utiwake_kbn_cd = '21' THEN b.hacchuuzan_ryou1 ELSE 0 END) AS hacchuuzan1,
                    SUM(CASE WHEN b.utiwake_kbn_cd = '21' THEN b.hacchuuzan_ryou1 ELSE 0 END) AS hikiate1, 
                    SUM(b.hacchuuzan_ryou2) - SUM(CASE WHEN b.utiwake_kbn_cd = '21' THEN b.hacchuuzan_ryou2 ELSE 0 END) AS hacchuuzan2, 
                    SUM(CASE WHEN b.utiwake_kbn_cd = '21' THEN b.hacchuuzan_ryou2 ELSE 0 END) AS hikiate2, 
                    SUM(b.juchuuzan_ryou1) AS juchuuzan1, 
                    SUM(b.juchuuzan_ryou2) AS juchuuzan2
                    FROM kousei_buhin_mrs AS a
                    LEFT JOIN zaiko_kakunin_azukari_vws AS b ON b.shouhin_mr_cd = a.gen_shouhin_mr_cd
                    LEFT JOIN shouhin_mrs AS c ON c.cd = a.gen_shouhin_mr_cd
                    LEFT JOIN tanni_mrs AS d on d.cd = a.tanni_mr_cd
                    WHERE a.shouhin_mr_cd = :shouhin_mr_cd
                    GROUP BY a.cd, a.shouhin_mr_cd,a.gen_shouhin_mr_cd 
                    ORDER BY a.cd
            ";
            $stmt = $db->prepare($phql);
            $stmt->execute($condition);
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        $this->view->rows = $rows;
        return;
    }

    /*
     * 滞留商品一覧表
     */
    public function tairyuu_shouhinAction()
    {
        $rows = [];
        if ($this->request->isPost()) {
            $last_nyuuko_date = $this->request->getPost('last_nyuuko');
            $last_shukko_date = $this->request->getPost('last_shukko');
            if ($last_shukko_date === '') {
                $last_shukko_date = '9999-12-31 23:59:59';
            }
            if ($last_nyuuko_date === '') {
                $last_nyuuko_date = $last_shukko_date;
            }
            $min_suuryou = $this->request->getPost('suuryou');
            $db = \Phalcon\DI::getDefault()->get('db');
            $conditions = ['last_nyuuko_date' => $last_nyuuko_date,'last_shukko_date' => $last_shukko_date, 'min_suuryou' => $min_suuryou];

            $phql = "
                SELECT
                    a.shouhin_mr_cd AS shouhin_mr_cd,
                    b.name AS shouhin_name,
                    a.souko_mr_cd AS souko_mr_cd,
                    c.name AS souko_name,
                    b.tanka_kbn AS tanka_kbn,
                    f.name AS zaiko_hyouka_kbn_cd,
                    SUM(a.zaiko_ryou1s) AS zaiko1,
                    d.name AS tanni1,
                    SUM(a.zaiko_ryou2s) AS zaiko2,
                    e.name AS tanni2,
                    MAX(a.nyuukobis) AS last_nyuuko,
                    MAX(a.shukkobis) AS last_shukko
                FROM zaiko_kakunin_azukari_vws AS a
                LEFT JOIN shouhin_mrs AS b ON b.cd = a.shouhin_mr_cd
                LEFT JOIN souko_mrs AS c ON c.cd = a.souko_mr_cd
                LEFT JOIN tanni_mrs AS d ON d.cd = a.tanni_mr1_cd
                LEFT JOIN tanni_mrs AS e ON e.cd = a.tanni_mr2_cd
                LEFT JOIN zaiko_hyouka_kbns AS f ON f.cd = b.zaiko_hyouka_kbn_cd
                WHERE b.zaikokanri = 1
                GROUP BY a.shouhin_mr_cd, a.souko_mr_cd
                HAVING (zaiko1 >= :min_suuryou OR zaiko2 >= :min_suuryou) AND last_shukko <= :last_shukko_date AND last_nyuuko <= :last_nyuuko_date
                ORDER BY a.shouhin_mr_cd, a.souko_mr_cd
            ";
            $stmt = $db->prepare($phql);
            $stmt->execute($conditions);
            $zaiko_rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $today = date('Y-m-d');
            $t_rows = ZaikoKakuninAzukariVws::findZaikos([
                "kyou" => date('Y-m-d', strtotime($today)),
                "groupby" => [
                    "tanka_tanni_mr_cd",
                    "shouhin_mr_cd",
                    "nyuushukkoym",
                ],
                "joins" => "LEFT JOIN zaiko_hyouka_kbns p1b ON p1b.cd = p1a.zaiko_hyouka_kbn_cd",
                "fields" => ", p1a.hyoujun_genka AS hyoujun_genka
						 , p1a.zaiko_hyouka_kbn_cd
						 , p1a.tanka_kbn",
                "conditions" => "hinsitu_hyouka_kbn_cd = 1 AND zaiko_hyouka_kbn_cd > 1",
                "bind" => '',
                "orderby" => "tanka_tanni_mr_cd, shouhin_mr_cd, nyuushukkoym",
            ]);
            $kikan_ym = date('Ym', strtotime($today));
            $t_ary = [];
            $tanni_cd = '';
            $shouhin_cd = '';
            foreach ($t_rows as $t_row) {
                if ($t_row['tanka_tanni_mr_cd'] != $tanni_cd) {
                    $tanni_cd = $t_row['tanka_tanni_mr_cd'];
                    $t_ary[$tanni_cd] = [];
                }
                if ($t_row['shouhin_mr_cd'] != $shouhin_cd) {
                    $shouhin_cd = $t_row['shouhin_mr_cd'];
                    $t_ary[$tanni_cd][$shouhin_cd] = [];
                    $t_ary[$tanni_cd][$shouhin_cd][1] = $t_ary[$tanni_cd][$shouhin_cd][0] = $t_row['hyoujun_genka'];
                    $zengetu_gaku = $zengetu_zaiko = 0;
                }
                if ($t_row['zaiko_hyouka_kbn_cd'] == 2) { // 最終仕入原価法
                    if ($t_row['shiirebi_tanka'] != '0000-00-000') {
                        $t_ary[$tanni_cd][$shouhin_cd][0] = floatval(substr($t_row['shiirebi_tanka'], 10));
                    }
                    if ($t_row['nyuushukkoym'] < $kikan_ym) {
                        $t_ary[$tanni_cd][$shouhin_cd][1] = $t_ary[$tanni_cd][$shouhin_cd][0];
                    }
                } else { // 月別総平均法
                    if ($zengetu_zaiko + $t_row['shiire_ryou' . ($t_row['tanka_tanni_mr_cd'] == $t_row['tanni_mr1_cd'] ? '1' : '2')] != 0) {
                        $t_ary[$tanni_cd][$shouhin_cd][0] = ($zengetu_gaku + $t_row['shiire_gaku'])
                            / ($zengetu_zaiko + $t_row['shiire_ryou' . ($t_row['tanka_tanni_mr_cd'] == $t_row['tanni_mr1_cd'] ? '1' : '2')]
                                + $t_row['hokanyuuko_ryou' . ($t_row['tanka_tanni_mr_cd'] == $t_row['tanni_mr1_cd'] ? '1' : '2')]);
                    }
                    if ($t_row['nyuushukkoym'] < $kikan_ym) {
                        $t_ary[$tanni_cd][$shouhin_cd][1] = $t_ary[$tanni_cd][$shouhin_cd][0];
                        $zengetu_zaiko += $t_row['zaiko_ryou' . ($t_row['tanka_tanni_mr_cd'] == $t_row['tanni_mr1_cd'] ? '1' : '2')];
                        $zengetu_gaku = $t_ary[$tanni_cd][$shouhin_cd][1] * $zengetu_zaiko;
                    }
                }
            }
            // 単価配列 [単価単位コード][商品コード][0=今月,1=前月]
            for ($i = 0; $i < count($zaiko_rows); $i++) {
                foreach ($t_ary as $tankas) {
                    foreach ($tankas as $key => $tanka) {
                        if ($zaiko_rows[$i]['shouhin_mr_cd'] === (string)$key) {
                            $zaiko_rows[$i]['tanka'] = $tanka[0];
                            $zaiko_rows[$i]['kingaku'] = $zaiko_rows[$i]['tanka_kbn'] === '1' ? (int)$zaiko_rows[$i]['tanka'] * (int)$zaiko_rows[$i]['zaiko1'] : (int)$zaiko_rows[$i]['tanka'] * (int)$zaiko_rows[$i]['zaiko2'];
                            break;
                        }
                    }
                }
            }
            $rows = $zaiko_rows;
        }
        $this->view->rows = $rows;
    }
}
