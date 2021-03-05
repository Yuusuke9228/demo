<?php

class ReportZaikoVwsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexxAction()
    {
        ControllerBase::indexCd("ReportZaikoVws", "VIEW", "shouhin_mr_cd"); //簡易検索付き一覧表示
    }

    /**
     * Searches for report_zaiko_vws
     */
    public function searchAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Displays the creation form
     */
    public function newAction($id = null, $dataname = "ReportZaikoVws")
    {
        $this->view->imax = 0;

        if ($id) {
            $nameDts = $dataname;
            $report_zaiko_vw = $nameDts::findFirstByid($id);
            if (!$report_zaiko_vw) {
                $this->flash->error("VIEWが見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "report_zaiko_vws",
                    'action' => 'index'
                ));

                return;
            }
            $this->_setDefault($report_zaiko_vw, "new", $dataname);
            $this->tag->setDefault("shouhin_mr_cd", null);
            $this->tag->setDefault("cd", null);
        }

    }

    /**
     * 修正画面から「次へ」ボタンを押したら次のコードの修正画面になる。
     */
    public function nextAction($id)
    {
        ControllerBase::nextCd($id, "report_zaiko_vws", "ReportZaikoVws", "VIEW");
    }

    /**
     * 修正画面から「前へ」ボタンを押したら前のコードの修正画面になる。
     */
    public function prevAction($id)
    {
        ControllerBase::prevCd($id, "report_zaiko_vws", "ReportZaikoVws", "VIEW");
    }

    /**
     * Edits a report_zaiko_vw
     *
     * @param string $shouhin_mr_cd
     */
    public function editAction($shouhin_mr_cd)
    {
        $report_zaiko_vw = ReportZaikoVws::findFirstByshouhin_mr_cd($shouhin_mr_cd);
        if (!$report_zaiko_vw) {
            $this->flash->error("VIEWが見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "report_zaiko_vws",
                'action' => 'index'
            ));

            return;
        }

        $this->view->shouhin_mr_cd = $report_zaiko_vw->shouhin_mr_cd;

        $this->_setDefault($report_zaiko_vw, "edit");
//        }
    }

    /**
     * 画面に表示するデータをセットする
     */
    public function _setDefault($report_zaiko_vw, $action = "edit", $meisai = "ReportZaikoVws")
    {
        $setdts = ["shouhin_mr_cd",
            "tantou_mr_cd",
            "tanni_mr1_cd",
            "tanni_mr2_cd",
            "lot",
            "kobetucd",
            "hinsitu_kbn_cd",
            "souko_mr_cd",
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
            "nyuukobis",
            "shukkobis",
            "nyuushukkobi",
            "nyuushukkoym",
            "denpyou_mr_cd",
            "oya_id",
            "oya_cd",
            "gyou_cd",
            "utiwake_kbn_cd",
            "torihikisaki_cd",
            "bikou",
            "hinsitu_hyouka_kbn_cd",
        ];

        foreach ($setdts as $setdt) {
            if (property_exists($report_zaiko_vw, $setdt)) {
                $this->tag->setDefault($setdt, $report_zaiko_vw->$setdt);
            }
        }
    }

    /**
     * 在庫一覧表
     */
    public function indexAction()
    {
        $post_flds = [
            'id',
            'cd',
            'name',
            'kikan_tuki',
            'junjo_kbn_cd',
            'hanni_from',
            'hanni_from_name',
            'hanni_to',
            'hanni_to_name',
            'junjo2_kbn_cd',
            'hanni2_from',
            'hanni2_from_name',
            'hanni2_to',
            'hanni2_to_name',
            'koujun_flg',
            'zaiko0_flg',
            'torihikiari_flg',
            'torihikinasi_flg',
            'meisaigyou_flg',
            'soukohyouji_flg',
            'goukeigyou_flg',
        ];
        $setdts = []; // データーの中継変数
        $thisPost = []; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        $thisPost['id'] = $this->request->getPost('id') ?? 1; // あれば、それ、でなければ=1
        $thisFind = [];
        $jouken = JoukenZaikoItirans::findFirstByid($thisPost['id']);
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
        $setdts['kikan_tuki'] = ($setdts['kikan_tuki'] && $setdts['kikan_tuki'] != '0000-00-00') ? $setdts['kikan_tuki'] : date('Y-m-t');

        foreach ($setdts as $fld => $setdt) { // postデータをそのまま返す。
            $this->tag->setDefault($fld, $setdt);
        }

        $condition1 = 'shouhin_mr_cd';
        $condition2 = 'souko_mr_cd';
        $join1tbl = '';
        $join2tbl = 'souko_mrs';
        switch ($setdts['junjo_kbn_cd']) {
            case '1302': // 商品
                $condition1 = 'shouhin_mr_cd';
                $join1tbl = '';
                break;
            case '1303': // 商品分類１
                $condition1 = 'p1a.shouhin_bunrui1_kbn_cd';
                $join1tbl = 'shouhin_bunrui1_kbns';
                break;
            case '1304': // 商品分類２
                $condition1 = 'p1a.shouhin_bunrui2_kbn_cd';
                $join1tbl = 'shouhin_bunrui2_kbns';
                break;
            case '1305': // 商品分類３
                $condition1 = 'p1a.shouhin_bunrui3_kbn_cd';
                $join1tbl = 'shouhin_bunrui3_kbns';
                break;
            case '1306': // 商品分類４
                $condition1 = 'p1a.shouhin_bunrui4_kbn_cd';
                $join1tbl = 'shouhin_bunrui4_kbns';
                break;
            case '1307': // 商品分類５
                $condition1 = 'p1a.shouhin_bunrui5_kbn_cd';
                $join1tbl = 'shouhin_bunrui5_kbns';
                break;
            case '1308': // 主仕入先
                $condition1 = 'p1a.shu_shiiresaki_mr_cd';
                $join1tbl = 'shiiresaki_mrs';
                break;
            case '1309': // 倉庫
                $condition1 = 'souko_mr_cd';
                $join1tbl = 'souko_mrs';
                break;
        }
        switch ($setdts['junjo2_kbn_cd']) {
            case '1302': // 商品
                $condition2 = 'shouhin_mr_cd';
                $join2tbl = '';
                break;
            case '1303': // 商品分類１
                $condition2 = 'p1a.shouhin_bunrui1_kbn_cd';
                $join2tbl = 'shouhin_bunrui1_kbns';
                break;
            case '1304': // 商品分類２
                $condition2 = 'p1a.shouhin_bunrui2_kbn_cd';
                $join2tbl = 'shouhin_bunrui2_kbns';
                break;
            case '1305': // 商品分類３
                $condition2 = 'p1a.shouhin_bunrui3_kbn_cd';
                $join2tbl = 'shouhin_bunrui3_kbns';
                break;
            case '1306': // 商品分類４
                $condition2 = 'p1a.shouhin_bunrui4_kbn_cd';
                $join2tbl = 'shouhin_bunrui4_kbns';
                break;
            case '1307': // 商品分類５
                $condition2 = 'p1a.shouhin_bunrui5_kbn_cd';
                $join2tbl = 'shouhin_bunrui5_kbns';
                break;
            case '1308': // 主仕入先
                $condition2 = 'p1a.shu_shiiresaki_mr_cd';
                $join2tbl = 'shiiresaki_mrs';
                break;
            case '1309': // 倉庫
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
            "kyou" => date('Y-m-d', strtotime($setdts['kikan_tuki'])), // 指定日の在庫を再現する2019/02/21修正…井浦
            "groupby" => [
                "hinsitu_hyouka_kbn_cd",
                "shouhin_mr_cd",
                "nyuushukkoym",
                ($setdts['soukohyouji_flg'] == 1 || $condition1 == 'souko_mr_cd') ? "souko_mr_cd" : "",
            ],
            "joins" => "LEFT JOIN zaiko_hyouka_kbns p1b ON p1b.cd = p1a.zaiko_hyouka_kbn_cd
						LEFT JOIN tanni_mrs p1c ON p1c.cd = p1.tanni_mr1_cd
						LEFT JOIN tanni_mrs p1d ON p1d.cd = p1.tanni_mr2_cd
			" . ($join1tbl ? "LEFT JOIN " . $join1tbl . " bk1 ON bk1.cd = " . $condition1 : "") . "
			" . ($join2tbl ? "LEFT JOIN " . $join2tbl . " bk2 ON bk2.cd = " . $condition2 : ""),
            "fields" => ", p1a.name
						, CASE hinsitu_hyouka_kbn_cd
							WHEN 1 THEN p1a.hyoujun_genka
							WHEN 2 THEN p1a.hyoukasage_genka
							ELSE 0
							END AS hyoujun_genka
						, p1a.suu_shousuu
						, p1a.tanka_shousuu
						, p1a.tanka_kbn
						, p1a.zaiko_hyouka_kbn_cd
						, if(p1a.tanka_kbn=1,p1a.tanni_mr1_cd,p1a.tanni_mr2_cd) shouhin_tanni_cd
						, p1b.name AS zaiko_hyouka_name
						, p1c.name AS tanni_mr_name1
						, p1d.name AS tanni_mr_name2
						, " . $condition1 . " AS bkey
						, " . $condition2 . " AS bkey2
						, " . ($join1tbl ? "bk1.name" : "''") . " AS bk1name
						, " . ($join2tbl ? "bk2.name" : "''") . " AS bk2name",
            "conditions" => "p1a.zaikokanri = 1	AND " . $condition1 . " >= :c1 AND " . $condition1 . " <= :c2 AND " . $condition2 . " >= :c3 AND " . $condition2 . " <= :c4" . ($this->request->isPost() ? "" : " AND FALSE")
            ,
            "bind" => ["c1" => $setdts['hanni_from'], "c2" => $setdts['hanni_to'], "c3" => $setdts['hanni2_from'], "c4" => $setdts['hanni2_to']],
            "orderby" => "hinsitu_hyouka_kbn_cd" . ($setdts['koujun_flg'] == 1 ? " DESC" : "") .
                "," . $condition1 . ($setdts['koujun_flg'] == 1 ? " DESC" : "") .
                (($condition2 == 'souko_mr_cd') ? "" : ("," . $condition2 . ($setdts['koujun_flg'] == 1 ? " DESC" : ""))) .
                ",shouhin_mr_cd" . ($setdts['koujun_flg'] == 1 ? " DESC" : "") .
                ($setdts['soukohyouji_flg'] == 1 && $condition2 == 'souko_mr_cd' ? ("," . $condition2 . ($setdts['koujun_flg'] == 1 ? " DESC" : "")) : "") .
                ",nyuushukkoym",
        ]);

        $t_rows = ZaikoKakuninAzukariVws::findZaikos([
            "kyou" => date('Y-m-d', strtotime($setdts['kikan_tuki'])), // 指定日の在庫を再現する2019/02/21修正…井浦
            "groupby" => [
                "tanka_tanni_mr_cd",
                "shouhin_mr_cd",
                "nyuushukkoym",
            ],
            "joins" => "LEFT JOIN zaiko_hyouka_kbns p1b ON p1b.cd = p1a.zaiko_hyouka_kbn_cd",
            "fields" => ", p1a.hyoujun_genka AS hyoujun_genka
						 , p1a.zaiko_hyouka_kbn_cd",
            "conditions" => ($condition1 != "souko_mr_cd" ? $condition1 . " >= :c1 AND " . $condition1 . " <= :c2" : $condition2 . " >= :c3 AND " . $condition2 . " <= :c4 ")
                . " AND hinsitu_hyouka_kbn_cd = 1 AND zaiko_hyouka_kbn_cd > 1", // 標準原価法の商品を除く
            "bind" => $binda,
            "orderby" => "tanka_tanni_mr_cd, shouhin_mr_cd, nyuushukkoym",
        ]);

        $kikan_ym = date('Ym', strtotime($setdts['kikan_tuki']));
        $t_ary = []; // 単価配列 [単価単位コード][商品コード][0=今月,1=前月]
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
                    $t_ary[$tanni_cd][$shouhin_cd][0] = floatval(substr($t_row['shiirebi_tanka'], 10)); // [0]は当月、[1]は前月
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

        $jouken_zaiko_itirans = JoukenZaikoItirans::find(["order" => "cd, sakusei_user_id"
            , "conditions" => "sakusei_user_id IN(0, ?0)"
            , "bind" => [0 => $this->getDI()->getSession()->get('auth')['id']]
        ]);
        $joukens = [];
        foreach ($jouken_zaiko_itirans as $jouken_zaiko_itiran) {
            $joukens[$jouken_zaiko_itiran->cd] = $jouken_zaiko_itiran->name;
        }

        $this->view->joukens = $joukens;
        $this->view->rows = $rows;
        $this->view->t_ary = $t_ary;
        $this->view->setdts = $setdts;
        return;
    }

    /*
     * 在庫一覧Excel出力
     */
    public function indexxlsxAction()
    {
        // MemoryLimitを超えるため、JQueryで出力する。
        // report_zaiko_itirans.js: $('#dl-xlsx').on('click', function () {}
    }

    /**
     * 在庫一覧表:簡易
     */
    public function index_2Action()
    {
        $post_flds = [
            'id',
            'cd',
            'name',
            'kikan_tuki',
            'junjo_kbn_cd',
            'hanni_from',
            'hanni_from_name',
            'hanni_to',
            'hanni_to_name',
            'junjo2_kbn_cd',
            'hanni2_from',
            'hanni2_from_name',
            'hanni2_to',
            'hanni2_to_name',
            'koujun_flg',
            'zaiko0_flg',
            'torihikiari_flg',
            'torihikinasi_flg',
            'meisaigyou_flg',
            'soukohyouji_flg',
            'goukeigyou_flg',
        ];
        $setdts = []; // データーの中継変数
        $thisPost = []; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        $thisPost['id'] = $this->request->getPost('id') ?? 1; // あれば、それ、でなければ=1
        $thisFind = [];
        $jouken = JoukenZaikoItirans::findFirstByid($thisPost['id']);
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
        $setdts['kikan_tuki'] = ($setdts['kikan_tuki'] && $setdts['kikan_tuki'] != '0000-00-00') ? $setdts['kikan_tuki'] : date('Y-m-t');

        foreach ($setdts as $fld => $setdt) {
            $this->tag->setDefault($fld, $setdt);
        }
        $condition1 = 'shouhin_mr_cd';
        $condition2 = 'souko_mr_cd';
        $join1tbl = '';
        $join2tbl = 'souko_mrs';
        switch ($setdts['junjo_kbn_cd']) {
            case '1302': // 商品
                $condition1 = 'shouhin_mr_cd';
                $join1tbl = '';
                break;
            case '1303': // 商品分類１
                $condition1 = 'p1a.shouhin_bunrui1_kbn_cd';
                $join1tbl = 'shouhin_bunrui1_kbns';
                break;
            case '1304': // 商品分類２
                $condition1 = 'p1a.shouhin_bunrui2_kbn_cd';
                $join1tbl = 'shouhin_bunrui2_kbns';
                break;
            case '1305': // 商品分類３
                $condition1 = 'p1a.shouhin_bunrui3_kbn_cd';
                $join1tbl = 'shouhin_bunrui3_kbns';
                break;
            case '1306': // 商品分類４
                $condition1 = 'p1a.shouhin_bunrui4_kbn_cd';
                $join1tbl = 'shouhin_bunrui4_kbns';
                break;
            case '1307': // 商品分類５
                $condition1 = 'p1a.shouhin_bunrui5_kbn_cd';
                $join1tbl = 'shouhin_bunrui5_kbns';
                break;
            case '1308': // 主仕入先
                $condition1 = 'p1a.shu_shiiresaki_mr_cd';
                $join1tbl = 'shiiresaki_mrs';
                break;
            case '1309': // 倉庫
                $condition1 = 'souko_mr_cd';
                $join1tbl = 'souko_mrs';
                break;
        }
        switch ($setdts['junjo2_kbn_cd']) {
            case '1302': // 商品
                $condition2 = 'shouhin_mr_cd';
                $join2tbl = '';
                break;
            case '1303': // 商品分類１
                $condition2 = 'p1a.shouhin_bunrui1_kbn_cd';
                $join2tbl = 'shouhin_bunrui1_kbns';
                break;
            case '1304': // 商品分類２
                $condition2 = 'p1a.shouhin_bunrui2_kbn_cd';
                $join2tbl = 'shouhin_bunrui2_kbns';
                break;
            case '1305': // 商品分類３
                $condition2 = 'p1a.shouhin_bunrui3_kbn_cd';
                $join2tbl = 'shouhin_bunrui3_kbns';
                break;
            case '1306': // 商品分類４
                $condition2 = 'p1a.shouhin_bunrui4_kbn_cd';
                $join2tbl = 'shouhin_bunrui4_kbns';
                break;
            case '1307': // 商品分類５
                $condition2 = 'p1a.shouhin_bunrui5_kbn_cd';
                $join2tbl = 'shouhin_bunrui5_kbns';
                break;
            case '1308': // 主仕入先
                $condition2 = 'p1a.shu_shiiresaki_mr_cd';
                $join2tbl = 'shiiresaki_mrs';
                break;
            case '1309': // 倉庫
                $condition2 = 'souko_mr_cd';
                $join2tbl = 'souko_mrs';
                break;
        }

        if ($condition1 != "souko_mr_cd") {
            $binda = ["c1" => $setdts['hanni_from'], "c2" => $setdts['hanni_to']];
        } else {
            $binda = ["c3" => $setdts['hanni2_from'], "c4" => $setdts['hanni2_to']];
        }
        // shouhin_tanni_cd を追加2019/6/21井浦
        $rows = ZaikoKakuninAzukariVws::findZaikos([
            "kyou" => date('Y-m-t', strtotime($setdts['kikan_tuki'])),
            "groupby" => [
                "hinsitu_hyouka_kbn_cd",
                "shouhin_mr_cd",
                "nyuushukkoym",
                ($setdts['soukohyouji_flg'] == 1 || $condition1 == 'souko_mr_cd') ? "souko_mr_cd" : "",
            ],
            "joins" => "LEFT JOIN zaiko_hyouka_kbns p1b ON p1b.cd = p1a.zaiko_hyouka_kbn_cd
						LEFT JOIN tanni_mrs p1c ON p1c.cd = p1.tanni_mr1_cd
						LEFT JOIN tanni_mrs p1d ON p1d.cd = p1.tanni_mr2_cd
			" . ($join1tbl ? "LEFT JOIN " . $join1tbl . " bk1 ON bk1.cd = " . $condition1 : "") . "
			" . ($join2tbl ? "LEFT JOIN " . $join2tbl . " bk2 ON bk2.cd = " . $condition2 : ""),
            "fields" => ", p1a.name
						, CASE hinsitu_hyouka_kbn_cd
							WHEN 1 THEN p1a.hyoujun_genka
							WHEN 2 THEN p1a.hyoukasage_genka
							ELSE 0
							END AS hyoujun_genka
						, p1a.suu_shousuu
						, p1a.tanka_shousuu
						, p1a.tanka_kbn
						, p1a.zaiko_hyouka_kbn_cd
						, if(p1a.tanka_kbn=1,p1a.tanni_mr1_cd,p1a.tanni_mr2_cd) shouhin_tanni_cd
						, p1b.name AS zaiko_hyouka_name
						, p1c.name AS tanni_mr_name1
						, p1d.name AS tanni_mr_name2
						, " . $condition1 . " AS bkey
						, " . $condition2 . " AS bkey2
						, " . ($join1tbl ? "bk1.name" : "''") . " AS bk1name
						, " . ($join2tbl ? "bk2.name" : "''") . " AS bk2name",
            "conditions" => "p1a.zaikokanri = 1	AND " . $condition1 . " >= :c1 AND " . $condition1 . " <= :c2 AND " . $condition2 . " >= :c3 AND " . $condition2 . " <= :c4" . ($this->request->isPost() ? "" : " AND FALSE")
            ,
            "bind" => ["c1" => $setdts['hanni_from'], "c2" => $setdts['hanni_to'], "c3" => $setdts['hanni2_from'], "c4" => $setdts['hanni2_to']],
            "orderby" => "hinsitu_hyouka_kbn_cd" . ($setdts['koujun_flg'] == 1 ? " DESC" : "") .
                "," . $condition1 . ($setdts['koujun_flg'] == 1 ? " DESC" : "") .
                (($condition2 == 'souko_mr_cd') ? "" : ("," . $condition2 . ($setdts['koujun_flg'] == 1 ? " DESC" : ""))) .
                ",shouhin_mr_cd" . ($setdts['koujun_flg'] == 1 ? " DESC" : "") .
                ($setdts['soukohyouji_flg'] == 1 && $condition2 == 'souko_mr_cd' ? ("," . $condition2 . ($setdts['koujun_flg'] == 1 ? " DESC" : "")) : "") .
                ",nyuushukkoym",
        ]);
        $t_rows = ZaikoKakuninAzukariVws::findZaikos([
            "kyou" => date('Y-m-t', strtotime($setdts['kikan_tuki'])),
            "groupby" => [
                "tanka_tanni_mr_cd",
                "shouhin_mr_cd",
                "nyuushukkoym",
            ],
            "joins" => "LEFT JOIN zaiko_hyouka_kbns p1b ON p1b.cd = p1a.zaiko_hyouka_kbn_cd",
            "fields" => ", p1a.hyoujun_genka AS hyoujun_genka
						 , p1a.zaiko_hyouka_kbn_cd",
            "conditions" => ($condition1 != "souko_mr_cd" ? $condition1 . " >= :c1 AND " . $condition1 . " <= :c2" : $condition2 . " >= :c3 AND " . $condition2 . " <= :c4 ")
                . " AND hinsitu_hyouka_kbn_cd = 1 AND zaiko_hyouka_kbn_cd > 1", // 標準原価法の商品を除く
            "bind" => $binda,
            "orderby" => "tanka_tanni_mr_cd, shouhin_mr_cd, nyuushukkoym",
        ]);
        $kikan_ym = date('Ym', strtotime($setdts['kikan_tuki']));
        $t_ary = []; // 単価配列
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
                    $t_ary[$tanni_cd][$shouhin_cd][0] = floatval(substr($t_row['shiirebi_tanka'], 10)); // [0]は当月、[1]は前月
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

        $jouken_zaiko_itirans = JoukenZaikoItirans::find(["order" => "cd, sakusei_user_id"
            , "conditions" => "sakusei_user_id IN(0, ?0)"
            , "bind" => [0 => $this->getDI()->getSession()->get('auth')['id']]
        ]);
        $joukens = [];
        foreach ($jouken_zaiko_itirans as $jouken_zaiko_itiran) {
            $joukens[$jouken_zaiko_itiran->cd] = $jouken_zaiko_itiran->name;
        }

        $this->view->joukens = $joukens;
        $this->view->rows = $rows;
        $this->view->t_ary = $t_ary;
        $this->view->setdts = $setdts;
        return;
    }

    /**
     * 入出庫明細書
     */
    public function nyuushukkoAction()
    {
        $post_flds = [
            'cd',
            'souko_mr_cd',
            'hyouji_flg',
            'kikan_from',
            'kikan_to',
        ];
        $setdts = []; // データーの中継変数
        $thisPost = []; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        foreach ($post_flds as $post_fld) {
            $setdts[$post_fld] = array_key_exists($post_fld, $thisPost) ? $thisPost[$post_fld] : $this->request->getPost($post_fld);
        }
        $setdts['hyouji_flg'] = is_null($setdts['hyouji_flg']) ? "1" : $setdts['hyouji_flg'];
        $setdts['kikan_from'] = $setdts['kikan_from'] ?? ($setdts['hyouji_flg'] !== '1' ? '2018-11-01' : date('Y-m-d', strtotime('first day of previous month')));
        $setdts['kikan_to'] = $setdts['kikan_to'] ?? date('Y-m-t');
        $shouhin_mr = ShouhinMrs::findFirst(["conditions" => "cd = ?1", "bind" => [1 => $setdts['cd']]]);
        $setdts['name'] = $shouhin_mr ? $shouhin_mr->name : '>>エラー:未登録';

        foreach ($setdts as $fld => $setdt) { // postデータをそのまま返す。
            $this->tag->setDefault($fld, $setdt);
        }

        $to_midasi = [];
        $toviews = [];

        $and_where = $setdts["souko_mr_cd"] ? " AND souko_mr_cd = '" . $setdts["souko_mr_cd"] . "'" : "";
        if ($setdts["hyouji_flg"] == 1) { // 明細表
            //並べ替え条件変更 Add By Nishiyama 2019/3/26
            $rows = ZaikoKakuninAzukariVws::findZaikos([
                "conditions" => "p1a.cd = '" . $setdts['cd'] . "'" . $and_where,
                "kyou" => $setdts['kikan_to'],
                "groupby" => [
                    "shouhin_mr_cd",
                    "nyuushukkobi",
                    "denpyou_mr_cd",
                    "cd",
                    "meisai_cd",
                    "souko_mr_cd",
                    "iro",
                    "iromei",
                    "lot",
                    "hinsitu_kbn_cd",
                ],
                "orderby" => "nyuushukkobi,created,cd,denpyou_mr_cd,utiwake_name",
                "joins" => "LEFT JOIN tokuisaki_mrs p1b ON p1b.cd = p1.torihikisaki_cd
							LEFT JOIN shiiresaki_mrs p1c ON p1c.cd = p1.torihikisaki_cd
							LEFT JOIN denpyou_mrs p1d ON p1d.cd = p1.denpyou_mr_cd
							LEFT JOIN utiwake_kbns p1e ON p1e.cd = p1.utiwake_kbn_cd
							LEFT JOIN tanni_mrs p1f ON p1f.cd = p1.tanni_mr1_cd
							LEFT JOIN tanni_mrs p1g ON p1g.cd = p1.tanni_mr2_cd
							LEFT JOIN hinsitu_kbns p1h ON p1h.cd = p1.hinsitu_kbn_cd
							LEFT JOIN tanni_mrs p1i ON p1i.cd = p1.tanka_tanni_mr_cd
							LEFT JOIN souko_mrs p1j ON p1j.cd = p1.souko_mr_cd",
                "fields" => ", p1a.name
							, p1a.tanka_kbn
							, p1b.name AS tokuisaki_name
							, p1c.name AS shiiresaki_name
							, p1d.name AS denpyou_name
							, p1e.name AS utiwake_name
							, p1f.name AS tanni1_name
							, p1g.name AS tanni2_name
							, p1h.name AS hinsitu_name
							, p1i.name AS tanka_tanni_name
							, p1j.name AS souko_name",
            ]);
        } else {
            $rows = ZaikoKakuninAzukariVws::findZaikos([
                "conditions" => "p1a.cd = '" . $setdts['cd'] . "'" . $and_where,
                "kyou" => $setdts['kikan_to'],
                "groupby" => [
                    "shouhin_mr_cd",
                    "nyuushukkoym",
                    "iro",
                    "iromei",
                    "lot",
                    "tanni_mr1_cd",
                    "tanni_mr2_cd",
                ],
                "orderby" => "nyuushukkobi,created,cd,denpyou_mr_cd,utiwake_name",
                "joins" => "LEFT JOIN tanni_mrs p1f ON p1f.cd = p1.tanni_mr1_cd
							LEFT JOIN tanni_mrs p1g ON p1g.cd = p1.tanni_mr2_cd
							LEFT JOIN hinsitu_kbns p1h ON p1h.cd = p1.hinsitu_kbn_cd",
                "fields" => ", p1a.tanka_kbn
							, p1f.name AS tanni1_name
							, p1g.name AS tanni2_name
							, p1h.name AS hinsitu_name",
            ]);
        }

        $this->view->rows = $rows;
        $this->view->setdts = $setdts;
        return;
    }

    /**
     * 入出庫2明細書:預り非表示 Add By Nishiyama 2018/11/27
     */
    public function nyuushukko_2Action()
    {
        $post_flds = [
            'cd',
            'souko_mr_cd',
            'hyouji_flg',
            'kikan_from',
            'kikan_to',
        ];
        $setdts = []; // データーの中継変数
        $thisPost = []; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        foreach ($post_flds as $post_fld) {
            $setdts[$post_fld] = array_key_exists($post_fld, $thisPost) ? $thisPost[$post_fld] : $this->request->getPost($post_fld);
        }
        $setdts['hyouji_flg'] = is_null($setdts['hyouji_flg']) ? "1" : $setdts['hyouji_flg'];
        $setdts['kikan_from'] = $setdts['kikan_from'] ?? ($setdts['hyouji_flg'] !== '1' ? '2016-01-01' : date('Y-m-01'));
        $setdts['kikan_to'] = $setdts['kikan_to'] ?? date('Y-m-t');
        $shouhin_mr = ShouhinMrs::findFirst(["conditions" => "cd = ?1", "bind" => [1 => $setdts['cd']]]);
        $setdts['name'] = $shouhin_mr->name ?? "";

        foreach ($setdts as $fld => $setdt) { // postデータをそのまま返す。
            $this->tag->setDefault($fld, $setdt);
        }

        $to_midasi = [];
        $toviews = [];
        $and_where = $setdts["souko_mr_cd"] ? " AND souko_mr_cd = '" . $setdts["souko_mr_cd"] . "'" : "";
        if ($setdts["hyouji_flg"] == 1) { // 明細表
            $rows = ZaikoKakuninAzukariVws::findZaikos([
                "conditions" => "p1a.cd = '" . $setdts['cd'] . "'" . $and_where,
                "kyou" => $setdts['kikan_to'],
                "groupby" => [
                    "shouhin_mr_cd",
                    "nyuushukkobi",
                    "denpyou_mr_cd",
                    "cd",
                    "meisai_cd",
                    "souko_mr_cd",
                    "iro",
                    "iromei",
                    "lot",
                    "hinsitu_kbn_cd",
                ],
                "orderby" => "nyuushukkobi,cd,denpyou_mr_cd,utiwake_name",
                "joins" => "LEFT JOIN tokuisaki_mrs p1b ON p1b.cd = p1.torihikisaki_cd
							LEFT JOIN shiiresaki_mrs p1c ON p1c.cd = p1.torihikisaki_cd
							LEFT JOIN denpyou_mrs p1d ON p1d.cd = p1.denpyou_mr_cd
							LEFT JOIN utiwake_kbns p1e ON p1e.cd = p1.utiwake_kbn_cd
							LEFT JOIN tanni_mrs p1f ON p1f.cd = p1.tanni_mr1_cd
							LEFT JOIN tanni_mrs p1g ON p1g.cd = p1.tanni_mr2_cd
							LEFT JOIN hinsitu_kbns p1h ON p1h.cd = p1.hinsitu_kbn_cd
							LEFT JOIN tanni_mrs p1i ON p1i.cd = p1.tanka_tanni_mr_cd
							LEFT JOIN souko_mrs p1j ON p1j.cd = p1.souko_mr_cd",
                "fields" => ", p1a.name
							, p1a.tanka_kbn
							, p1b.name AS tokuisaki_name
							, p1c.name AS shiiresaki_name
							, p1d.name AS denpyou_name
							, p1e.name AS utiwake_name
							, p1f.name AS tanni1_name
							, p1g.name AS tanni2_name
							, p1h.name AS hinsitu_name
							, p1i.name AS tanka_tanni_name
							, p1j.name AS souko_name",
            ]);
            $this->tag->setDefault("name", $rows ? $rows[0]["name"] : "");
        } else {
            $rows = ZaikoKakuninAzukariVws::findZaikos([
                "conditions" => "p1a.cd = '" . $setdts['cd'] . "'" . $and_where,
                "kyou" => $setdts['kikan_to'],
                "groupby" => [
                    "shouhin_mr_cd",
                    "nyuushukkoym",
                    "iro",
                    "iromei",
                    "lot",
                    "tanni_mr1_cd",
                    "tanni_mr2_cd",
                ],
                "orderby" => "nyuushukkobi,cd,denpyou_mr_cd,utiwake_name",
                "joins" => "LEFT JOIN tanni_mrs p1f ON p1f.cd = p1.tanni_mr1_cd
							LEFT JOIN tanni_mrs p1g ON p1g.cd = p1.tanni_mr2_cd
							LEFT JOIN hinsitu_kbns p1h ON p1h.cd = p1.hinsitu_kbn_cd",
                "fields" => ", p1a.tanka_kbn
							, p1f.name AS tanni1_name
							, p1g.name AS tanni2_name
							, p1h.name AS hinsitu_name",
            ]);
        }

        $this->view->rows = $rows;
        $this->view->setdts = $setdts;
        return;
    }

    /**
     * Lot集計したモダールを表示: 伝票のロット入力欄ダブルクリックで表示(在庫一覧からも使用)
     * Add By Nishiyama 2019/8/12
     */
    public function lot_summaryAction()
    {
        $di = \Phalcon\DI::getDefault();
        $mgr = $di->get('modelsManager');
        $shouhin_mr_cd = $this->request->getQuery('cd');
        $phql = "
            SELECT
            a.souko_mr_cd as souko_cd,
            f.name as souko_name,
            a.shouhin_mr_cd as shouhin_mr_cd,
            b.name as shouhin_name,
            a.lot as lot,
            a.iro as iro,
            a.iromei as iromei,
            a.hinsitu_kbn_cd as hinsitu_kbn_cd,
            g.name as hinsitu_name,
            SUM(a.zaiko_ryou1s) as zaiko_ryou1,
            c.name as tanni1_name, 
            SUM(a.zaiko_ryou2s) as zaiko_ryou2,
            d.name as tanni2_name, 
            SUM(a.hacchuuzan_ryou1) AS hacchuuzan_ryou1,
		    SUM(a.hacchuuzan_ryou2) AS hacchuuzan_ryou2,
            b.uri_genka AS cost 
            FROM ZaikoKakuninAzukariVws AS a 
            LEFT JOIN ShouhinMrs AS b ON b.cd = a.shouhin_mr_cd
            LEFT JOIN TanniMrs AS c ON c.cd = b.tanni_mr1_cd 
            LEFT JOIN TanniMrs AS d ON d.cd = b.tanni_mr2_cd 
            LEFT JOIN SoukoMrs AS f ON f.cd = a.souko_mr_cd 
            LEFT JOIN HinsituKbns AS g ON g.cd = a.hinsitu_kbn_cd 
            WHERE a.shouhin_mr_cd = :shouhin_mr_cd:
            group by a.souko_mr_cd,a.shouhin_mr_cd,a.lot,a.iro,g.name
            order by a.souko_mr_cd,a.lot
        ";
        $rows = $mgr->executeQuery($phql, [
            "shouhin_mr_cd" => $shouhin_mr_cd,
        ]);
        $this->view->rows = $rows->toArray();
        return;
    }

    //========================================================================================================

    /**
     * 伝票検索モーダル
     */
    public function den_modalAction()
    {
        ControllerBase::indexCd("ReportZaikoVws", "各伝票", "updated DESC,oya_cd,gyou_cd"); //簡易検索付き一覧表示
        $parameters = $this->persistent->parameters;
        $this->tag->setDefault("denpyoubi", $parameters["bind"]["denpyoubi"] ?? "");
        $this->tag->setDefault("oya_cd", $parameters["bind"]["oyacd"] ?? "");
        $this->tag->setDefault("shouhin_mr_cd", substr($parameters["bind"]["shouhin_mr_cd"], 1, -1) ?? "");
        $this->tag->setDefault("souko_mr_cd", substr($parameters["bind"]["souko_mr_cd"], 1, -1) ?? "");
        $this->tag->setDefault("kousin_user_id", $parameters["bind"]["kousin_user_id"] ?? "");
        $this->tag->setDefault("denpyou_mr_cd", substr($parameters["bind"]["denpyou_mr_cd"], 1, -1) ?? "");
    }

    /**
     * ロット別在庫モーダル
     */
    public function lot_modalAction()
    {
        $wherecd = "";
        $orgkey = "cd";
        if ($this->request->isPost()) {
            $wherecd = $this->request->getPost($orgkey);
        } else {
            $wherecd = $this->request->getQuery($orgkey);
        }
        $scode = '';
        $skey = "souko_mr_cd";
        if ($this->request->isPost()) {
            $scode = $this->request->getPost($skey);
        } else {
            $scode = $this->request->getQuery($skey);
        }

        $rows = ZaikoKakuninAzukariVws::findZaikos([
            "conditions" => "shouhin_mr_cd = :cd",
            "groupby" => ["lot", "denpyou_mr_cd", "cd", "iro", "iromei", "hinsitu_kbn_cd", "souko_mr_cd",],
            "fields" => ", p1a.name,t1.name t1_name,t2.name t2_name,t3.name t3_name,p1b.name AS tokuisaki_name,p1c.name AS shiiresaki_name",
            "bind" => ["cd" => $wherecd],
            "orderby" => "nyuushukkobi,denpyou_mr_cd,cd,meisai_cd",
            "joins" => "INNER JOIN tanni_mrs t1 ON t1.cd = p1.tanni_mr1_cd 
						INNER JOIN tanni_mrs t2 ON t2.cd = p1.tanni_mr2_cd
						LEFT JOIN tokuisaki_mrs p1b ON p1b.cd = p1.torihikisaki_cd
						LEFT JOIN shiiresaki_mrs p1c ON p1c.cd = p1.torihikisaki_cd 
						INNER JOIN tanni_mrs t3 ON t3.cd = p1.tanka_tanni_mr_cd",
        ]);
        $this->view->rows = $rows;
    }

    /**
     * 個別在庫モーダル
     */
    public function kobetu_modalAction()
    {
        $wherecd = "";
        $orgkey = "cd";
        if ($this->request->isPost()) {
            $wherecd = $this->request->getPost($orgkey);
        } else {
            $wherecd = $this->request->getQuery($orgkey);
        }
        echo "\n" . $wherecd . "\n";
        $rows = ZaikoKakuninAzukariVws::findZaikos([
            "conditions" => "shouhin_mr_cd = :cd",
            "groupby" => ["kobetucd", "tanni_mr1_cd", "tanni_mr2_cd", "hinsitu_kbn_cd"],
            "joins" => "LEFT JOIN tanni_mrs p1b ON p1b.cd = p1.tanni_mr1_cd
						LEFT JOIN tanni_mrs p1c ON p1c.cd = p1.tanni_mr2_cd
						LEFT JOIN hinsitu_kbns p1d ON p1d.cd = p1.hinsitu_kbn_cd
						LEFT JOIN souko_mrs p1e ON p1e.cd = p1.souko_mr_cd",
            "fields" => ", p1a.name, p1b.name name1, p1c.name name2, p1d.name name3, p1e.name name4",
            "bind" => ["cd" => $wherecd],
        ]);
        $this->view->rows = $rows;
    }

    /*
     * lot_modalAction 改 Add By Nishiyama 2018/12/26
     * 倉庫、商品コードでロット絞込
     */
    public function lot_modal_2Action()
    {
        $wherecd = "";
        $orgkey = "cd";

        if ($this->request->isPost()) {
            $wherecd = $this->request->getPost($orgkey);
        } else {
            $wherecd = $this->request->getQuery($orgkey);
        }

        $scode = '';
        $skey = "souko_mr_cd";
        if ($this->request->isPost()) {
            $scode = $this->request->getPost($skey);
        } else {
            $scode = $this->request->getQuery($skey);
        }

        $rows = ZaikoKakuninAzukariVws::findSoukoZaiko([
            "conditions" => ["shouhin_mr_cd = :cd", "souko_mr_cd = :souko_mr_cd",],
            "groupby" => ["lot", "denpyou_mr_cd", "cd", "iro", "iromei", "hinsitu_kbn_cd", "souko_mr_cd",],
            "fields" => ", p1a.name,t1.name t1_name,t2.name t2_name,t3.name t3_name",
            "bind" => ["cd" => $wherecd, "souko_mr_cd" => $scode],
            "orderby" => "nyuushukkobi,denpyou_mr_cd,cd,meisai_cd",
            "joins" => "INNER JOIN tanni_mrs t1 ON t1.cd = p1.tanni_mr1_cd 
						INNER JOIN tanni_mrs t2 ON t2.cd = p1.tanni_mr2_cd 
						INNER JOIN tanni_mrs t3 ON t3.cd = p1.tanka_tanni_mr_cd",
        ]);

        $this->view->rows = $rows;
    }

    /*
	 * lot_modalAction 改 Add By Nishiyama 2018/12/26
	 * 倉庫、商品コードでロット絞込
     * 条件ロット追加  Add By Nishiyama 2019/2/13
	 */
    public function lot_zaikoAction()
    {
        $wherecd = "";
        $orgkey = "cd";

        if ($this->request->isPost()) {
            $wherecd = $this->request->getPost($orgkey);
        } else {
            $wherecd = $this->request->getQuery($orgkey);
        }
        $scode = '';
        $skey = "souko_mr_cd";
        if ($this->request->isPost()) {
            $scode = $this->request->getPost($skey);
        } else {
            $scode = $this->request->getQuery($skey);
        }

        $lot = '';
        $lotkey = 'lot';
        if ($this->request->isPost()) {
            $lot = $this->request->getPost($lotkey);
        } else {
            $lot = $this->request->getQuery($lotkey);
        }

        if ($lot === '') {
            $rows = ZaikoKakuninAzukariVws::findSoukoZaiko([
                "conditions" => ["shouhin_mr_cd = :cd", "souko_mr_cd = :souko_mr_cd",],
                "groupby" => ["lot", "cd", "iro", "iromei", "hinsitu_kbn_cd", "souko_mr_cd",],
                "fields" => ",p1a.name,t1.name t1_name,t2.name t2_name,t3.name t3_name,p1b.name AS tokuisaki_name,p1c.name AS shiiresaki_name",
                "bind" => ["cd" => $wherecd, "souko_mr_cd" => $scode],
                "orderby" => "nyuushukkobi,denpyou_mr_cd,cd,meisai_cd",
                "joins" => "INNER JOIN tanni_mrs t1 ON t1.cd = p1.tanni_mr1_cd 
						INNER JOIN tanni_mrs t2 ON t2.cd = p1.tanni_mr2_cd 
						LEFT JOIN tokuisaki_mrs p1b ON p1b.cd = p1.torihikisaki_cd
                        LEFT JOIN shiiresaki_mrs p1c ON p1c.cd = p1.torihikisaki_cd
						INNER JOIN tanni_mrs t3 ON t3.cd = p1.tanka_tanni_mr_cd",
            ]);
        } else {
            $rows = ZaikoKakuninAzukariVws::findSoukoZaiko([
                "conditions" => ["shouhin_mr_cd = :cd", "souko_mr_cd = :souko_mr_cd", "p1.lot = :lot"],
                "groupby" => ["lot", "cd", "iro", "iromei", "hinsitu_kbn_cd", "souko_mr_cd",],
                "fields" => ",p1a.name,t1.name t1_name,t2.name t2_name,t3.name t3_name,p1b.name AS tokuisaki_name,p1c.name AS shiiresaki_name",
                "bind" => ["cd" => $wherecd, "souko_mr_cd" => $scode, "lot" => $lot],
                "orderby" => "nyuushukkobi,denpyou_mr_cd,cd,meisai_cd",
                "joins" => "INNER JOIN tanni_mrs t1 ON t1.cd = p1.tanni_mr1_cd 
						INNER JOIN tanni_mrs t2 ON t2.cd = p1.tanni_mr2_cd 
						LEFT JOIN tokuisaki_mrs p1b ON p1b.cd = p1.torihikisaki_cd
                        LEFT JOIN shiiresaki_mrs p1c ON p1c.cd = p1.torihikisaki_cd 
						INNER JOIN tanni_mrs t3 ON t3.cd = p1.tanka_tanni_mr_cd",
            ]);
        }

        $this->view->rows = $rows;
    }

//============================================================================================

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
        $wherecd = $this->request->getPost('cd');
        $scode = $this->request->getPost('souko');
        $di = \Phalcon\DI::getDefault();
        $mgr = $di->get('modelsManager');

        if ($scode === '') {
            $phql = "
                SELECT shouhin_mr_cd, 
                       SUM(zaiko_ryou1s) AS zaiko_ryou1,
                       SUM(zaiko_ryou2s) AS zaiko_ryou2,
                       SUM(azukari_zan2s) AS azukari_zan2
                FROM ZaikoKakuninAzukariVws
                WHERE shouhin_mr_cd = :shouhin_mr_cd:
                GROUP BY shouhin_mr_cd
            ";
            $condition = ['shouhin_mr_cd' => $wherecd];
        } else {
            $phql = "
                SELECT shouhin_mr_cd, souko_mr_cd,
                       SUM(zaiko_ryou1s) AS zaiko_ryou1,
                       SUM(zaiko_ryou2s) AS zaiko_ryou2,
                       SUM(azukari_zan2s) AS azukari_zan2
                FROM ZaikoKakuninAzukariVws
                WHERE shouhin_mr_cd = :shouhin_mr_cd: AND souko_mr_cd = :souko_mr_cd:
                GROUP BY shouhin_mr_cd, souko_mr_cd
            ";
            $condition = ['shouhin_mr_cd' => $wherecd, 'souko_mr_cd' => $scode];
        }
        $zaikos = $mgr->executeQuery($phql, $condition);

        $resData = [];
        //出入が一度もない商品の在庫を参照するとエラーになるので、例外処理にはさむ
        try {
            $resData[0] = $zaikos ? round($zaikos[0]["zaiko_ryou2"], 3) : "";
            $resData[1] = $zaikos ? round($zaikos[0]["zaiko_ryou1"], 3) : "";
            $resData[2] = $zaikos ? round($zaikos[0]["azukari_zan2"], 3) : "";
        } catch (Exception $e) {
            $resData[0] = 0;
            $resData[1] = 0;
            $resData[2] = 0;
        }
        $response->setContent(json_encode($resData));
        return $response;
    }

    //在庫確認
    public function ajaxZaikoCheckAction()
    {
        $this->view->disable();
        $den_mr_cd = $this->request->getPost('den_mr_cd');
        $den_id = $this->request->getPost('den_id');
        $suuryoutable = $this->request->getPost('zaikotable');
        //SQL組立
        $bind = [];
        $conditions = 'cd in (';
        $i = 0; //バインドパラメータに附番する
        foreach ($suuryoutable as $key => $keys) {
            $conditions .= ":shouhin_cd${i}:,";
            $bind += ["shouhin_cd${i}" => $keys[0],];
            $i++;
        }
        $conditions .= "'')";

        $shouhin_mrs = ShouhinMrs::find(["conditions" => $conditions, "bind" => $bind, "columns" => "cd, zaikokanri", "group" => "cd"]);
        $zaikokanris = [];
        foreach ($shouhin_mrs as $shouhin_mr) {
            $zaikokanris[$shouhin_mr->cd] = $shouhin_mr->zaikokanri;
        }

        $condition = [];
        $where = 'WHERE ';
        if (!is_null($den_id)) {
            $where .= "NOT(a.denpyou_mr_cd = :den_mr_cd: AND a.id = :den_id:) AND ";
            $condition += ["den_mr_cd" => $den_mr_cd, "den_id" => $den_id,];
        }
        $where .= "( 0 ";
        $i = 0; //バインドパラメータに附番する
        foreach ($suuryoutable as $key => $keys) {
            $where .= "OR (a.shouhin_mr_cd = :shouhin_cd${i}: AND a.lot = :lot${i}: AND a.souko_mr_cd = :souko_cd${i}: AND a.hinsitu_kbn_cd = :hinshitu${i}: AND a.iro = :iro${i}: AND a.iromei = :iromei${i}:) ";
            $condition += ["shouhin_cd${i}" => $keys[0], "lot${i}" => $keys[1], "souko_cd${i}" => $keys[2], "hinshitu${i}" => $keys[3], "iro${i}" => $keys[4], "iromei${i}" => $keys[5],];
            $i++;
        }
        $where .= ')';
        $di = \Phalcon\DI::getDefault();
        $mgr = $di->get('modelsManager');
        $phql = "
			SELECT
                a.shouhin_mr_cd,
                a.lot,
			    a.iro,
			    a.iromei,
                a.souko_mr_cd,
                a.hinsitu_kbn_cd,
				SUM(a.zaiko_ryou1s) as zaikoryou1,
				SUM(a.zaiko_ryou2s) as zaikoryou2
			FROM ZaikoKakuninAzukariVws AS a
            " . $where . "
            GROUP BY a.shouhin_mr_cd, a.lot,a.iro,a.iromei,a.souko_mr_cd,a.hinsitu_kbn_cd
        ";
        $zaiko_data = $mgr->executeQuery($phql, $condition);
        $ret_msg = 'OK';
        //在庫比較
        $zaiko_keys = [];
        $i = 0;
        foreach ($zaiko_data as $genzaiko) {
            $zaiko_keys[$genzaiko['shouhin_mr_cd'] . ',' .
            $genzaiko['lot'] . ',' .
            $genzaiko['souko_mr_cd'] . ',' .
            $genzaiko['hinsitu_kbn_cd'] . ',' .
            $genzaiko['iro'] . ',' .
            $genzaiko['iromei']] = [$i, $genzaiko['zaikoryou1'], $genzaiko['zaikoryou2']]; // row番号
            $i++;
        }
        foreach ($suuryoutable as $key => $suuryou) {
            if (!array_key_exists($key, $zaiko_keys)) {
                $zaiko_keys[$key] = [$i, 0.00, 0.00];
                $i++;
            }
            if ($zaikokanris[$suuryou[0]] == 1 && round((float)$suuryou[6], 3) + round((float)$zaiko_keys[$key][1], 3) < 0) {
                $ret_msg = $key . '在庫1が、マイナスです。現在庫1: ' . round((float)$zaiko_keys[$key][1], 3);
                break;
            }
            if ($zaikokanris[$suuryou[0]] == 1 && round((float)$suuryou[7], 3) + round((float)$zaiko_keys[$key][2], 3) < 0) {
                $ret_msg = $key . '在庫2が、マイナスです。現在庫2: ' . round((float)$zaiko_keys[$key][2], 3);
                break;
            }
        }
        //return json_encode($zaiko_keys);
        return json_encode($ret_msg);
    }

    /*
     * 各伝票の預りチェック用在庫を渡す。 Add By Nishiyama
     */
    public function ajax_azukaricheckAction()
    {
        $this->view->disable();
        $den_mr_cd = $this->request->getPost('den_mr_cd');
        $den_id = $this->request->getPost('den_id');
        $suuryoutable = $this->request->getPost('azukari_meisai');
        $condition = [];
        $where = 'WHERE ';
        if (!is_null($den_id)) {
            $where .= "NOT(a.denpyou_mr_cd = :den_mr_cd: AND a.id = :den_id:) AND ";
            $condition += ["den_mr_cd" => $den_mr_cd, "den_id" => $den_id,];
        }
        //仕入伝票の場合、関連得意先を使用するため取得する。
        if ($den_mr_cd === 'shiire') {
            foreach ($suuryoutable as $key => $azukari_suuryou_table) {
                $buff = ShiiresakiMrs::find(["cd ='" . $azukari_suuryou_table[1] . "'"]);
                $buff = $buff->toArray();
                $suuryoutable[$key][1] = $buff[0]['tokuisaki_mr_cd'];
            }
        }
        $where .= "( 0 ";
        $i = 0;     //バインドパラメータに附番する  "torihikisaki_cd${i}" => $keys[1],
        foreach ($suuryoutable as $key => $keys) {
            $where .= "OR (a.shouhin_mr_cd = :shouhin_cd${i}:) ";
            $condition += ["shouhin_cd${i}" => $keys[0], "torihikisaki_cd" => $keys[1],];
            $i++;
        }

        $where .= ')';
        $di = \Phalcon\DI::getDefault();
        $mgr = $di->get('modelsManager');
        $phql = "
            SELECT
            a.shouhin_mr_cd AS shouhin_mr_cd,
            IF(a.denpyou_mr_cd='shiire',b.tokuisaki_mr_cd,a.torihikisaki_cd) AS torihikisaki1_cd,
            SUM(azukari_zan1s) AS azukari_zan1,
            SUM(azukari_zan2s) as azukari_zan2
            FROM ZaikoKakuninAzukariVws AS a     
            LEFT JOIN ShiiresakiMrs AS b ON b.cd = a.torihikisaki_cd 
            " . $where . "
            GROUP BY a.shouhin_mr_cd,torihikisaki1_cd 
            HAVING (azukari_zan2 <> 0 OR azukari_zan1 <> 0) AND (torihikisaki1_cd  = :torihikisaki_cd:)
        ";
        $azukari_data = $mgr->executeQuery($phql, $condition);
        $ret_msg = 'OK';
        //比較
        $azukari_keys = [];
        $i = 0;
        foreach ($azukari_data as $azukari) {
            $azukari_keys[$azukari['shouhin_mr_cd']] = [$i, $azukari['azukari_zan1'], $azukari['azukari_zan2']]; // row番号
            $i++;
        }
        foreach ($suuryoutable as $key => $suuryou) {
            if (!array_key_exists($key, $azukari_keys)) {
                $azukari_keys[$key] = [$i, 0.00, 0.00];
                $i++;
            }
            if (round((float)$suuryou[2], 3) + round((float)$azukari_keys[$key][1], 3) < 0) {
                $ret_msg = $key . '預り在庫1が、マイナスです。現預り在庫１: ' . round((float)$azukari_keys[$key][1], 3);
                break;
            }
            if (round((float)$suuryou[3], 3) + round((float)$azukari_keys[$key][2], 3) < 0) {
                $ret_msg = $key . '預り在庫2が、マイナスです。現預り在庫2: ' . round((float)$azukari_keys[$key][2], 3);
                break;
            }
        }
        return json_encode($ret_msg);
    }

    /*
     * all_column_zaikoより表示: modal Add By Nishiyama 2019/4/10
     */
    public function shouhin_lot_modalAction()
    {
        $di = \Phalcon\DI::getDefault();
        $mgr = $di->get('modelsManager');
        if (!$this->request->isPost()) {
            $param = $this->request->getQuery();
            $where = " WHERE (a.shouhin_mr_cd = :cd: AND b.zaikokanri = 1)";
            $phql = "
			SELECT
				a.souko_mr_cd,
				f.name as souko_name,
				a.lot,
                a.iro,
                a.iromei,
				a.kobetucd,
                g.name AS hinshitu_name,
                SUM(a.zaiko_ryou1s) AS zaikoryou1,
                c.name AS tanni1,
                SUM(a.zaiko_ryou2s) AS zaikoryou2,
                d.name AS tanni2,
                MAX(a.nyuushukkobi) AS saisyuudeiri
            FROM ZaikoKakuninAzukariVws AS a
            LEFT JOIN ShouhinMrs AS b ON b.cd = a.shouhin_mr_cd
            LEFT JOIN TanniMrs AS c ON c.cd = b.tanni_mr1_cd
            LEFT JOIN TanniMrs AS d ON d.cd = b.tanni_mr2_cd
            LEFT JOIN UriageMeisaiDts AS e ON e.id = a.meisai_id
            LEFT JOIN SoukoMrs AS f ON f.cd = a.souko_mr_cd
            LEFT JOIN HinsituKbns AS g ON g.cd = a.hinsitu_kbn_cd
			" . $where . "
			GROUP BY a.souko_mr_cd , a.lot,a.iro,a.kobetucd,a.hinsitu_kbn_cd 
			ORDER BY a.souko_mr_cd
            ";
            $rows = $mgr->executeQuery($phql, [
                "cd" => $param['cd'],
            ]);
            $this->view->shouhin_cd = $param['cd'];
            $this->view->shouhin_name = $param['name'];
            $this->view->rows = $rows;
        }
    }

    /*
    * 全商品全倉庫の在庫を表示 Add By Nishiyama 2019/4/10
    */
    public function all_column_zaikoAction()
    {
        $db = \Phalcon\DI::getDefault()->get('db');
        if ($this->request->isPost()) {
            $param = $this->request->getPost();
            $condition = [];    //bindパラメーターを動的に組み立てる
            $where = "WHERE (b.zaikokanri = 1) AND (nyuushukkobi BETWEEN :kikan_from AND :kikan_to) ";
            //ブックフラグ(like)
            switch ($param['book_flg']) {
                case '0':   //ブックを除く
                    $where .= "AND (b.shouhin_bunrui3_kbn_cd = '') ";
                    break;
                case '1':   //ブック
                    $where .= "AND (b.shouhin_bunrui3_kbn_cd <> '') ";
                    break;
                case '2':   //全て
                    break;
            }
            //倉庫コード(like)
            if ($param['souko_cd_from'] != '') {
                $where .= "AND (a.souko_mr_cd LIKE :souko_cd_from) ";
                $condition += ["souko_cd_from" => '%' . $param['souko_cd_from'] . '%',];
            }
            //倉庫名称(like)
            if ($param['souko_name_from'] != '') {
                $where .= "AND f.name LIKE :souko_name_from ";
                $condition += ["souko_name_from" => '%' . $param['souko_name_from'] . '%',];
            }
            //担当コード(like)test2019/8/21
            if ($param['tantou_cd_from'] != '') {
                $where .= "AND (a.tantou_mr_cd LIKE :tantou_cd_from) ";
                $condition += ["tantou_cd_from" => '%' . $param['tantou_cd_from'] . '%',];
            }
            //担当名称(like)
            if ($param['tantou_name_from'] != '') {
                $where .= "AND h.name LIKE :tantou_name ";
                $condition += ["tantou_name" => '%' . $param['tantou_name_from'] . '%',];
            }
            //商品コード(like)
            if ($param['shouhin_cd_from'] != '') {
                $where .= "AND (a.shouhin_mr_cd LIKE :shouhin_cd_from) ";
                $condition += ["shouhin_cd_from" => $param['shouhin_cd_from'] . '%',];
            }
            //商品名称(like)
            if ($param['shouhin_name_from'] != '') {
                $where .= "AND b.name LIKE :shouhin_name_from ";
                $condition += ["shouhin_name_from" => '%' . $param['shouhin_name_from'] . '%',];
            }
            //lot(like)
            if ($param['lot_from'] != '') {
                $where .= "AND a.lot LIKE :lot_from ";
                $condition += ["lot_from" => '%' . $param['lot_from'] . '%',];
            }
            //iro(like)
            if ($param['iro_from'] != '') {
                $where .= "AND a.iro LIKE :iro_from ";
                $condition += ["iro_from" => '%' . $param['iro_from'] . '%',];
            }
            //iromei(like)
            if ($param['iromei_from'] != '') {
                $where .= "AND a.iromei LIKE :iromei_from ";
                $condition += ["iromei_from" => '%' . $param['iromei_from'] . '%',];
            }
            //kobetucd(like)
            if ($param['kobetucd_from'] != '') {
                $where .= "AND a.kobetucd LIKE :kobetucd_from ";
                $condition += ["kobetucd_from" => '%' . $param['kobetucd_from'] . '%',];
            }
            //hinshitu_name(like)
            if ($param['hinshitu_from'] != '') {
                $where .= "AND g.name LIKE :hinshitu_from ";
                $condition += ["hinshitu_from" => '%' . $param['hinshitu_from'] . '%',];
            }
            $having = "";
            //在庫1
            if ($param['zaiko1_from'] != '') {
                if ($param['zaiko1_to'] == '') {   //在庫は範囲検索する
                    $param['zaiko1_to'] = 9999999999.99;
                }
                $having .= "HAVING (zaikoryou1 BETWEEN :zaiko1_from AND :zaiko1_to) ";
                $condition += ["zaiko1_from" => $param['zaiko1_from'], "zaiko1_to" => $param['zaiko1_to'],];
            }
            //在庫2
            if ($param['zaiko2_from'] != '') {
                if ($param['zaiko2_to'] == '') {   //在庫は範囲検索する
                    $param['zaiko2_to'] = 9999999999.99;
                }
                if (isset($condition['zaiko1_from'])) {
                    $having .= "AND (zaikoryou2 BETWEEN :zaiko2_from AND :zaiko2_to) ";
                } else {
                    $having .= "HAVING (zaikoryou2 BETWEEN :zaiko2_from AND :zaiko2_to) ";
                }
                $condition += ["zaiko2_from" => $param['zaiko2_from'], "zaiko2_to" => $param['zaiko2_to'],];
            }

            //在庫期間を指定する
            $param['kikan_from'] = '2000-01-01';
            $condition += ["kikan_from" => $param['kikan_from'], "kikan_to" => trim($param['kikan_to']),];
            //動的にselect項目とグループ項目を生成
            $select = "SELECT ";
            $group = ""; //デフォルト
            if (isset($param['souko_group'])) {
                $select .= "a.souko_mr_cd,f.name as souko_name";
                $group .= "GROUP BY a.souko_mr_cd";
            }
            if (isset($param['tantou_group'])) {
                if ($group !== '') {
                    $select .= ",a.tantou_mr_cd,h.name as tantou_name";
                    $group .= ",a.tantou_mr_cd";
                } else {
                    $select .= "a.tantou_mr_cd,h.name as tantou_name";
                    $group .= "GROUP BY a.tantou_mr_cd";
                }
            }
            if (isset($param['shouhin_group'])) {
                if ($group !== '') {
                    $select .= ",a.shouhin_mr_cd,b.name as shouhin_name,b.tanka_kbn as tanka_kbn";
                    $group .= ",a.shouhin_mr_cd";
                } else {
                    $select .= "a.shouhin_mr_cd,b.name as shouhin_name,b.tanka_kbn as tanka_kbn";
                    $group .= "GROUP BY a.shouhin_mr_cd";
                }
            }
            if (isset($param['lot_group'])) {
                if ($group !== '') {
                    $select .= ",a.lot";
                    $group .= ",a.lot";
                } else {
                    $select .= "a.lot";
                    $group .= "GROUP BY a.lot";
                }
            }
            if (isset($param['iro_group'])) {
                if ($group !== '') {
                    $select .= ",a.iro,a.iromei";
                    $group .= ",a.iro";
                } else {
                    $select .= "a.iro,a.iromei";
                    $group .= "GROUP BY a.iro";
                }
            }
            if (isset($param['kobetsucd_group'])) {
                if ($group !== '') {
                    $select .= ",a.kobetucd";
                    $group .= ",a.kobetucd";
                } else {
                    $select .= "a.kobetucd";
                    $group .= "GROUP BY a.kobetucd";
                }
            }
            if (isset($param['hinsitsu_group'])) {
                if ($group !== '') {
                    $select .= ",g.name AS hinshitu_name";
                    $group .= ",a.hinsitu_kbn_cd";
                } else {
                    $select .= "g.name AS hinshitu_name";
                    $group .= "GROUP BY a.hinsitu_kbn_cd";
                }
            }
            //平均を原価登録するように変更したので商品台帳より取得 2019/8/12
            if ($select === "SELECT ") {
                if (isset($param['shouhin_group'])) {
                    $select .= "
                    ROUND(SUM(a.zaiko_ryou1s), 3) as zaikoryou1,c.name as tanni1,
                    ROUND(SUM(a.zaiko_ryou2s), 3) as zaikoryou2,d.name as tanni2,
                    b.uri_genka AS cost";
                } else {
                    $select .= "
                    ROUND(SUM(a.zaiko_ryou1s), 3) as zaikoryou1,c.name as tanni1,
                    ROUND(SUM(a.zaiko_ryou2s), 3) as zaikoryou2,d.name as tanni2,
                    b.uri_genka AS cost";
                }
            } else {
                if (isset($param['shouhin_group'])) {
                    $select .= "
                    ,ROUND(SUM(a.zaiko_ryou1s), 3) as zaikoryou1,c.name as tanni1,
                    ROUND(SUM(a.zaiko_ryou2s), 3) as zaikoryou2,d.name as tanni2,
                    b.uri_genka AS cost";
                } else {
                    $select .= "
                    ,ROUND(SUM(a.zaiko_ryou1s), 3) as zaikoryou1,c.name as tanni1,
                    ROUND(SUM(a.zaiko_ryou2s), 3) as zaikoryou2,d.name as tanni2,
                    b.uri_genka  AS cost";
                }
            }

            $phql = $select . "
                FROM test_zaiko_kakunin_azukari AS a
                LEFT JOIN shouhin_mrs AS b ON b.cd = a.shouhin_mr_cd
                LEFT JOIN tanni_mrs AS c ON c.cd = b.tanni_mr1_cd
                LEFT JOIN tanni_mrs AS d ON d.cd = b.tanni_mr2_cd
                LEFT JOIN souko_mrs AS f ON f.cd = a.souko_mr_cd
                LEFT JOIN hinsitu_kbns AS g ON g.cd = a.hinsitu_kbn_cd
                LEFT JOIN tantou_mrs AS h ON h.cd = a.tantou_mr_cd
                " . $where . "
                " . $group . "
                " . $having . "
                ORDER BY a.souko_mr_cd,a.shouhin_mr_cd
            ";

            $make_table = "
                CREATE TEMPORARY TABLE test_zaiko_kakunin_azukari
                    as 
                    (select *
                    from zaiko_kakunin_azukari_vws)
                 ";
            $stmt = $db->prepare($make_table);
            $stmt->execute();
            $stmt = $db->prepare($phql);
            $stmt->execute($condition);

            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $this->view->rows = $rows;
        } else {   //倉庫在庫を表示
            $month = date('Y-m');
            $firstDate = '2000-01-01';
            $lastDate = date('Y-m-d', strtotime('last day of ' . $month));
            $whe = "WHERE (a.nyuushukkobi BETWEEN '${firstDate}' AND '${lastDate}') AND b.zaikokanri = 1 ";
            $phql = "
			SELECT
			        a.souko_mr_cd,
			        f.name as souko_name,
                    SUM(a.zaiko_ryou1s) as zaikoryou1,
                    c.name as tanni1,
				    SUM(a.zaiko_ryou2s) as zaikoryou2,
				    d.name as tanni2
                FROM test_zaiko_kakunin_azukari AS a
                LEFT JOIN shouhin_mrs AS b ON b.cd = a.shouhin_mr_cd
                LEFT JOIN tanni_mrs AS c ON c.cd = b.tanni_mr1_cd
                LEFT JOIN tanni_mrs AS d ON d.cd = b.tanni_mr2_cd
                LEFT JOIN souko_mrs AS f ON f.cd = a.souko_mr_cd
                " . $whe . "
                GROUP BY a.souko_mr_cd
                HAVING zaikoryou1 <> 0.00 AND zaikoryou2 <> 0.00
                ORDER BY a.souko_mr_cd
            ";

            $make_table = "
                CREATE TEMPORARY TABLE test_zaiko_kakunin_azukari
                    as 
                    (select *
                    from zaiko_kakunin_azukari_vws)
                 ";
            $stmt = $db->prepare($make_table);
            $stmt->execute();
            $stmt = $db->prepare($phql);
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $this->view->rows = $rows;
        }
    }

    /*
	 * 在庫順位表 Add By Nishiyama 2019/8/30
     *
     */
    public function juniAction()
    {
        $db = \Phalcon\DI::getDefault()->get('db'); //union使用の為
        $post_flds = [
            "cd",
            "hyouji_kbn",
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
        $setdts = []; // データーの中継変数
        $thisPost = []; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        $select = "SELECT ";
        $union_select = "
                UNION ALL SELECT '総計','',
                SUM(z.zaiko_ryou1s) AS sou_suuryou1,
                SUM(z.zaiko_ryou2s) AS sou_suuryou2
                FROM zaiko_kakunin_azukari_vws AS z
                LEFT JOIN shouhin_mrs AS xz ON xz.cd = z.shouhin_mr_cd
                WHERE xz.zaikokanri = 1
                ";
        $from = " FROM zaiko_kakunin_azukari_vws AS b
                  LEFT JOIN shouhin_mrs AS c ON c.cd = b.shouhin_mr_cd
                  LEFT JOIN	souko_mrs AS d ON d.cd = b.souko_mr_cd
                  ";
        $where = " WHERE ";
        $group = " GROUP BY ";
        $order = " ORDER BY suuryou2 DESC";
        if (!$this->request->isPost()) {
            foreach ($post_flds as $post_fld) {
                $setdts[$post_fld] = "";
            }
            $setdts["cd"] = "01"; // 日別
            $setdts["hyouji_kbn"] = '0';
            $setdts["junjo_kbn_cd"] = "2702"; // 倉庫別
            $setdts["koujun_flg"] = 0;
            $setdts['kikan_from'] = '';   //在庫集計は全ての期間見る必要があるため
            $setdts["kikan_to"] = date('Y-m-t');
            $setdts["hanni_from"] = '0000';
            $setdts["hanni_to"] = '9999';
            $setdts["zeikomi_flg"] = 0;
            $setdts["meisaigyou_flg"] = 1;
            $setdts["goukeigyou_flg"] = 0;
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
        foreach ($setdts as $fld => $setdt) { // postデータをそのまま返す。
            $this->tag->setDefault($fld, $setdt);
        }
        //@TODO 必要なら増やす
        switch ($setdts["junjo_kbn_cd"]) {
            case '2702':    //倉庫別
                $select .= "b.souko_mr_cd AS '集計キー',d.name AS 'キー名称',";
                $group .= "b.souko_mr_cd,d.name";
                $where .= "b.souko_mr_cd BETWEEN '" . $setdts['hanni_from'] . "' AND '" . $setdts['hanni_to'] . "'";
                break;
            case '2710':    //商品別
                $select .= "b.shouhin_mr_cd AS '集計キー',c.name AS 'キー名称',";
                $group .= "b.shouhin_mr_cd,c.name";
                $where .= "b.shouhin_mr_cd BETWEEN '" . $setdts['hanni_from'] . "' AND '" . $setdts['hanni_to'] . "'";
                break;
        }
        if ($setdts['koujun_flg'] === '1') {
            $order = " ORDER BY suuryou2 ASC";
        } else {
            $order = " ORDER BY suuryou2 DESC";
        }
        switch ($setdts['hyouji_kbn']) {
            case '0':   //在庫数量２
                $select .= "
                    SUM(b.zaiko_ryou1s) AS suuryou1,
                    sum(b.zaiko_ryou2s) AS suuryou2
                ";
                break;
        }

        if ($where === '') {
            $where = "WHERE c.zaikokanri = 1 AND (b.nyuushukkobi BETWEEN '" . $setdts['kikan_from'] . "' AND '" . $setdts['kikan_to'] . "')";
        } else {
            $where .= " AND c.zaikokanri = 1 AND (b.nyuushukkobi BETWEEN '" . $setdts['kikan_from'] . "' AND '" . $setdts['kikan_to'] . "')";
        }
        $stmt = $db->prepare($select . $from . $where . $group . $union_select . $order);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->view->rows = $rows;

        $jouken_shiire_junis = JoukenShiireJunis::find(["order" => "cd, sakusei_user_id"
            , "conditions" => "sakusei_user_id IN(0, ?0)"
            , "bind" => [0 => $this->getDI()->getSession()->get('auth')['id']]
        ]);
        $joukens = [];
        foreach ($jouken_shiire_junis as $jouken_shiire_juni) {
            $joukens[$jouken_shiire_juni->cd] = $jouken_shiire_juni->name;
        }
        $this->view->joukens = $joukens;
        return;
    }

    /*
     * 在庫推移作成開始 Add By Nishiyama 2019/8/29
     */
    public function suiiAction()
    {
        ini_set('display_errors', 'on');
        error_reporting(E_ALL | E_NOTICE);
        $db = \Phalcon\DI::getDefault()->get('db'); //pivot展開するSQLはモデルマネージャーでは実行出来ない。
        $post_flds = [
            "cd",
            "hyouji_kbn",
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
            $setdts["cd"] = "01"; // 日別
            $setdts["hyouji_kbn"] = '2';
            $setdts["junjo_kbn_cd"] = "3702"; // 倉庫別
            $setdts["koujun_flg"] = 0;
            $setdts["kikan_sitei_kbn_cd"] = "2602"; // 2019年度 仕入推移のものを使用
            $setdts["kikan_from"] = date('Y-m-01', strtotime("-1 year"));    //年度は-1
            $setdts["kikan_to"] = date('Y-m-t');
            $setdts["hanni_from"] = '0000';
            $setdts["hanni_to"] = '9999';
            $setdts["zeikomi_flg"] = 0;
            $setdts["meisaigyou_flg"] = 1;
            $setdts["goukeigyou_flg"] = 0;
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
        list($year, $month, $day) = explode('-', $setdts["kikan_from"]);    //年だけ使用する
        $junjo_kbn = JunjoKbns::findFirst(["conditions" => "cd = ?1", "bind" => ["1" => $setdts["junjo_kbn_cd"]]]);
        foreach ($setdts as $fld => $setdt) { // postデータをそのまま返す。
            $this->tag->setDefault($fld, $setdt);
        }
        //SQL組立
        $select = "SELECT ";
        $from = " FROM test_zaiko_kakunin_azukari AS a
                LEFT JOIN shouhin_mrs AS d ON d.cd = a.shouhin_mr_cd
                LEFT JOIN souko_mrs AS e ON e.cd = a.souko_mr_cd";
        $where = " WHERE ";
        $group = " GROUP BY ";
        $order = "";
        switch ($setdts["junjo_kbn_cd"]) {
            case '3701':    //商品別
                $select .= "a.shouhin_mr_cd AS '集計キー',d.name AS 'キー名称',";
                $group .= "a.shouhin_mr_cd,d.name";
                $where .= "a.shouhin_mr_cd BETWEEN '" . $setdts['hanni_from'] . "' AND '" . $setdts['hanni_to'] . "'";
                if ($setdts['koujun_flg'] === '1') {
                    $order = " ORDER BY a.shouhin_mr_cd DESC";
                } else {
                    $order = " ORDER BY a.shouhin_mr_cd ASC";
                }
                break;
            case '3702':    //倉庫別
                $select .= "a.souko_mr_cd AS '集計キー',e.name AS 'キー名称',";
                $group .= "a.souko_mr_cd,e.name";
                $where .= "a.souko_mr_cd BETWEEN '" . $setdts['hanni_from'] . "' AND '" . $setdts['hanni_to'] . "'";
                if ($setdts['koujun_flg'] === '1') {
                    $order = " ORDER BY a.souko_mr_cd DESC";
                } else {
                    $order = " ORDER BY a.souko_mr_cd ASC";
                }
                break;
        }

        switch ($setdts['hyouji_kbn']) {
            case '0':   //在庫数１
                switch ($setdts["junjo_kbn_cd"]) {
                    case '3701':    //商品別
                        $shuukei_key = 'shouhin_mr_cd';
                        $select = "select distinct a.shouhin_mr_cd AS '集計キー',d.name AS 'キー名称',";
                        break;
                    case '3702':    //倉庫別
                        $shuukei_key = 'souko_mr_cd';
                        $select = "select distinct a.souko_mr_cd AS '集計キー',e.name AS 'キー名称',";
                        break;
                }
                $select .= "
                    (select sum(b.zaiko_ryou1s) from test_zaiko_kakunin_azukari  as b
                      left join shouhin_mrs as z on z.cd = b.shouhin_mr_cd
                      where b." . $shuukei_key . " = a." . $shuukei_key . "
                        and z.zaikokanri = 1
                        and b.nyuushukkoym <='" . $year . "11') as '11月',
                    (select sum(b.zaiko_ryou1s) from test_zaiko_kakunin_azukari as b
                      left join shouhin_mrs as z on z.cd = b.shouhin_mr_cd
                      where b." . $shuukei_key . " = a." . $shuukei_key . "
                        and z.zaikokanri = 1
                        and b.nyuushukkoym <='" . $year . "12') as '12月',
                    (select sum(b.zaiko_ryou1s) from test_zaiko_kakunin_azukari as b
                      left join shouhin_mrs as z on z.cd = b.shouhin_mr_cd
                      where b." . $shuukei_key . " = a." . $shuukei_key . "
                        and z.zaikokanri = 1
                        and b.nyuushukkoym <='" . ((int)$year + 1) . "01') as '1月',
                    (select sum(b.zaiko_ryou1s) from test_zaiko_kakunin_azukari as b
                      left join shouhin_mrs as z on z.cd = b.shouhin_mr_cd
                      where b." . $shuukei_key . " = a." . $shuukei_key . "
                        and z.zaikokanri = 1
                        and b.nyuushukkoym <='" . ((int)$year + 1) . "02') as '2月',
                    (select sum(b.zaiko_ryou1s) from test_zaiko_kakunin_azukari as b
                      left join shouhin_mrs as z on z.cd = b.shouhin_mr_cd
                      where b." . $shuukei_key . " = a." . $shuukei_key . "
                        and z.zaikokanri = 1
                        and b.nyuushukkoym <='" . ((int)$year + 1) . "03') as '3月',
                    (select sum(b.zaiko_ryou1s) from test_zaiko_kakunin_azukari as b
                      left join shouhin_mrs as z on z.cd = b.shouhin_mr_cd
                      where b." . $shuukei_key . " = a." . $shuukei_key . "
                        and z.zaikokanri = 1
                        and b.nyuushukkoym <='" . ((int)$year + 1) . "04') as '4月',
                    (select sum(b.zaiko_ryou1s) from test_zaiko_kakunin_azukari as b
                      left join shouhin_mrs as z on z.cd = b.shouhin_mr_cd
                      where b." . $shuukei_key . " = a." . $shuukei_key . "
                        and z.zaikokanri = 1
                        and b.nyuushukkoym <='" . ((int)$year + 1) . "05') as '5月',
                    (select sum(b.zaiko_ryou1s) from test_zaiko_kakunin_azukari as b
                      left join shouhin_mrs as z on z.cd = b.shouhin_mr_cd
                      where b." . $shuukei_key . " = a." . $shuukei_key . "
                        and z.zaikokanri = 1
                        and b.nyuushukkoym <='" . ((int)$year + 1) . "06') as '6月',
                    (select sum(b.zaiko_ryou1s) from test_zaiko_kakunin_azukari as b
                      left join shouhin_mrs as z on z.cd = b.shouhin_mr_cd
                      where b." . $shuukei_key . " = a." . $shuukei_key . "
                        and z.zaikokanri = 1
                        and b.nyuushukkoym <='" . ((int)$year + 1) . "07') as '7月',
                    (select sum(b.zaiko_ryou1s) from test_zaiko_kakunin_azukari as b
                      left join shouhin_mrs as z on z.cd = b.shouhin_mr_cd
                      where b." . $shuukei_key . " = a." . $shuukei_key . "
                        and z.zaikokanri = 1
                        and b.nyuushukkoym <='" . ((int)$year + 1) . "08') as '8月',
                    (select sum(b.zaiko_ryou1s) from test_zaiko_kakunin_azukari as b
                      left join shouhin_mrs as z on z.cd = b.shouhin_mr_cd
                      where b." . $shuukei_key . " = a." . $shuukei_key . "
                        and z.zaikokanri = 1
                        and b.nyuushukkoym <='" . ((int)$year + 1) . "09') as '9月',
                    (select sum(b.zaiko_ryou1s) from test_zaiko_kakunin_azukari as b
                      left join shouhin_mrs as z on z.cd = b.shouhin_mr_cd
                      where b." . $shuukei_key . " = a." . $shuukei_key . "
                        and z.zaikokanri = 1
                        and b.nyuushukkoym <='" . ((int)$year + 1) . "10') as '10月'
                ";
                $group = '';
                break;
            case '1':   //在庫数2
                switch ($setdts["junjo_kbn_cd"]) {
                    case '3701':    //商品別
                        $shuukei_key = 'shouhin_mr_cd';
                        $select = "select distinct a.shouhin_mr_cd AS '集計キー',d.name AS 'キー名称',";
                        break;
                    case '3702':    //倉庫別
                        $shuukei_key = 'souko_mr_cd';
                        $select = "select distinct a.souko_mr_cd AS '集計キー',e.name AS 'キー名称',";
                        break;
                }
                $select .= "
                    (select sum(b.zaiko_ryou2s) from test_zaiko_kakunin_azukari  as b
                      left join shouhin_mrs as z on z.cd = b.shouhin_mr_cd
                      where b." . $shuukei_key . " = a." . $shuukei_key . "
                        and z.zaikokanri = 1
                        and b.nyuushukkoym <='" . $year . "11') as '11月',
                    (select sum(b.zaiko_ryou2s) from test_zaiko_kakunin_azukari as b
                      left join shouhin_mrs as z on z.cd = b.shouhin_mr_cd
                      where b." . $shuukei_key . " = a." . $shuukei_key . "
                        and z.zaikokanri = 1
                        and b.nyuushukkoym <='" . $year . "12') as '12月',
                    (select sum(b.zaiko_ryou2s) from test_zaiko_kakunin_azukari as b
                      left join shouhin_mrs as z on z.cd = b.shouhin_mr_cd
                      where b." . $shuukei_key . " = a." . $shuukei_key . "
                        and z.zaikokanri = 1
                        and b.nyuushukkoym <='" . ((int)$year + 1) . "01') as '1月',
                    (select sum(b.zaiko_ryou2s) from test_zaiko_kakunin_azukari as b
                      left join shouhin_mrs as z on z.cd = b.shouhin_mr_cd
                      where b." . $shuukei_key . " = a." . $shuukei_key . "
                        and z.zaikokanri = 1
                        and b.nyuushukkoym <='" . ((int)$year + 1) . "02') as '2月',
                    (select sum(b.zaiko_ryou2s) from test_zaiko_kakunin_azukari as b
                      left join shouhin_mrs as z on z.cd = b.shouhin_mr_cd
                      where b." . $shuukei_key . " = a." . $shuukei_key . "
                        and z.zaikokanri = 1
                        and b.nyuushukkoym <='" . ((int)$year + 1) . "03') as '3月',
                    (select sum(b.zaiko_ryou2s) from test_zaiko_kakunin_azukari as b
                      left join shouhin_mrs as z on z.cd = b.shouhin_mr_cd
                      where b." . $shuukei_key . " = a." . $shuukei_key . "
                        and z.zaikokanri = 1
                        and b.nyuushukkoym <='" . ((int)$year + 1) . "04') as '4月',
                    (select sum(b.zaiko_ryou2s) from test_zaiko_kakunin_azukari as b
                      left join shouhin_mrs as z on z.cd = b.shouhin_mr_cd
                      where b." . $shuukei_key . " = a." . $shuukei_key . "
                        and z.zaikokanri = 1
                        and b.nyuushukkoym <='" . ((int)$year + 1) . "05') as '5月',
                    (select sum(b.zaiko_ryou2s) from test_zaiko_kakunin_azukari as b
                      left join shouhin_mrs as z on z.cd = b.shouhin_mr_cd
                      where b." . $shuukei_key . " = a." . $shuukei_key . "
                        and z.zaikokanri = 1
                        and b.nyuushukkoym <='" . ((int)$year + 1) . "06') as '6月',
                    (select sum(b.zaiko_ryou2s) from test_zaiko_kakunin_azukari as b
                      left join shouhin_mrs as z on z.cd = b.shouhin_mr_cd
                      where b." . $shuukei_key . " = a." . $shuukei_key . "
                        and z.zaikokanri = 1
                        and b.nyuushukkoym <='" . ((int)$year + 1) . "07') as '7月',
                    (select sum(b.zaiko_ryou2s) from test_zaiko_kakunin_azukari as b
                      left join shouhin_mrs as z on z.cd = b.shouhin_mr_cd
                      where b." . $shuukei_key . " = a." . $shuukei_key . "
                        and z.zaikokanri = 1
                        and b.nyuushukkoym <='" . ((int)$year + 1) . "08') as '8月',
                    (select sum(b.zaiko_ryou2s) from test_zaiko_kakunin_azukari as b
                      left join shouhin_mrs as z on z.cd = b.shouhin_mr_cd
                      where b." . $shuukei_key . " = a." . $shuukei_key . "
                        and z.zaikokanri = 1
                        and b.nyuushukkoym <='" . ((int)$year + 1) . "09') as '9月',
                    (select sum(b.zaiko_ryou2s) from test_zaiko_kakunin_azukari as b
                      left join shouhin_mrs as z on z.cd = b.shouhin_mr_cd
                      where b." . $shuukei_key . " = a." . $shuukei_key . "
                        and z.zaikokanri = 1
                        and b.nyuushukkoym <='" . ((int)$year + 1) . "10') as '10月'
                ";
                $group = '';
                break;
            case '2':   //入出庫数1
                $select .= "
                    SUM(if (date_format(a.nyuushukkobi, '%Y%m')='" . $year . "11', a.zaiko_ryou1s, 0)) AS '11月',
                    SUM(if (date_format(a.nyuushukkobi, '%Y%m')='" . $year . "12', a.zaiko_ryou1s, 0)) AS '12月',
                    SUM(if (date_format(a.nyuushukkobi, '%Y%m')='" . ((int)$year + 1) . "01', a.zaiko_ryou1s, 0)) AS '1月',
                    SUM(if (date_format(a.nyuushukkobi, '%Y%m')='" . ((int)$year + 1) . "02', a.zaiko_ryou1s, 0)) AS '2月',
                    SUM(if (date_format(a.nyuushukkobi, '%Y%m')='" . ((int)$year + 1) . "03', a.zaiko_ryou1s, 0)) AS '3月',
                    SUM(if (date_format(a.nyuushukkobi, '%Y%m')='" . ((int)$year + 1) . "04', a.zaiko_ryou1s, 0)) AS '4月',
                    SUM(if (date_format(a.nyuushukkobi, '%Y%m')='" . ((int)$year + 1) . "05', a.zaiko_ryou1s, 0)) AS '5月',
                    SUM(if (date_format(a.nyuushukkobi, '%Y%m')='" . ((int)$year + 1) . "06', a.zaiko_ryou1s, 0)) AS '6月',
                    SUM(if (date_format(a.nyuushukkobi, '%Y%m')='" . ((int)$year + 1) . "07', a.zaiko_ryou1s, 0)) AS '7月',
                    SUM(if (date_format(a.nyuushukkobi, '%Y%m')='" . ((int)$year + 1) . "08', a.zaiko_ryou1s, 0)) AS '8月',
                    SUM(if (date_format(a.nyuushukkobi, '%Y%m')='" . ((int)$year + 1) . "09', a.zaiko_ryou1s, 0)) AS '9月',
                    SUM(if (date_format(a.nyuushukkobi, '%Y%m')='" . ((int)$year + 1) . "10', a.zaiko_ryou1s, 0)) AS '10月'
                ";
                break;
            case '3':   //入出庫数2
                $select .= "
                    SUM(if (date_format(a.nyuushukkobi, '%Y%m')='" . $year . "11', a.zaiko_ryou2s, 0)) AS '11月',
                    SUM(if (date_format(a.nyuushukkobi, '%Y%m')='" . $year . "12', a.zaiko_ryou2s, 0)) AS '12月',
                    SUM(if (date_format(a.nyuushukkobi, '%Y%m')='" . ((int)$year + 1) . "01', a.zaiko_ryou2s, 0)) AS '1月',
                    SUM(if (date_format(a.nyuushukkobi, '%Y%m')='" . ((int)$year + 1) . "02', a.zaiko_ryou2s, 0)) AS '2月',
                    SUM(if (date_format(a.nyuushukkobi, '%Y%m')='" . ((int)$year + 1) . "03', a.zaiko_ryou2s, 0)) AS '3月',
                    SUM(if (date_format(a.nyuushukkobi, '%Y%m')='" . ((int)$year + 1) . "04', a.zaiko_ryou2s, 0)) AS '4月',
                    SUM(if (date_format(a.nyuushukkobi, '%Y%m')='" . ((int)$year + 1) . "05', a.zaiko_ryou2s, 0)) AS '5月',
                    SUM(if (date_format(a.nyuushukkobi, '%Y%m')='" . ((int)$year + 1) . "06', a.zaiko_ryou2s, 0)) AS '6月',
                    SUM(if (date_format(a.nyuushukkobi, '%Y%m')='" . ((int)$year + 1) . "07', a.zaiko_ryou2s, 0)) AS '7月',
                    SUM(if (date_format(a.nyuushukkobi, '%Y%m')='" . ((int)$year + 1) . "08', a.zaiko_ryou2s, 0)) AS '8月',
                    SUM(if (date_format(a.nyuushukkobi, '%Y%m')='" . ((int)$year + 1) . "09', a.zaiko_ryou2s, 0)) AS '9月',
                    SUM(if (date_format(a.nyuushukkobi, '%Y%m')='" . ((int)$year + 1) . "10', a.zaiko_ryou2s, 0)) AS '10月'
                ";
                break;
        }
        $make_table = "
            CREATE TEMPORARY TABLE test_zaiko_kakunin_azukari
                (index shouhin_mr_cd(shouhin_mr_cd),
                 index souko_mr_cd(souko_mr_cd),
                 index nyuushukkoym(nyuushukkoym))
                as 
                (select shouhin_mr_cd,souko_mr_cd,nyuushukkoym,
                zaiko_ryou1s,zaiko_ryou2s,nyuushukkobi
                from zaiko_kakunin_azukari_vws)
                ";
        $stmt = $db->prepare($make_table);
        $stmt->execute();
        $stmt = $db->prepare($select . $from . $where . $group . $order);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $this->view->rows = $rows;

        $jouken_zaiko_suiis = JoukenZaikoSuiis::find(["order" => "cd, sakusei_user_id"
            , "conditions" => "sakusei_user_id IN(0, ?0)"
            , "bind" => [0 => $this->getDI()->getSession()->get('auth')['id']]
        ]);
        $joukens = [];
        foreach ($jouken_zaiko_suiis as $jouken_zaiko_suii) {
            $joukens[$jouken_zaiko_suii->cd] = $jouken_zaiko_suii->name;
        }
        $this->view->joukens = $joukens;
        return;
    }
}
