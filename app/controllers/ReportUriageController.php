<?php

class ReportUriageController extends ControllerBase
{
    /**
     * 売上明細書
     */
    public function indexAction()
    {
        $post_flds =
            [
                'cd'
                , 'name'
                , 'junjo_kbn_cd'
                , 'koujun_flg'
                , 'hanni_from'
                , 'hanni_to'
                , 'tokuisaki_mr_cd'
                , 'shouhin_mr_cd'
                , 'tantou_mr_cd'
                , 'souko_mr_cd'
                , 'project_mr_cd'
                , 'project_sub_cd'
                , 'kikan_sitei_kbn_cd'
                , 'kikan_from'
                , 'kikan_to'
                , 'cd_from'
                , 'cd_to'
                , 'simekiri_kbn'
                , 'tuujou_flg'
                , 'henpin_flg'
                , 'nebiki_flg'
                , 'shokeihi_flg'
                , 'urisikiri_flg'
                , 'seisan_flg'
                , 'shouhi_flg'
                , 'azukari_flg'
                , 'kakousikiri_flg'
                , 'tekiyou_flg'
                , 'memo_flg'
                , 'shouhizei_flg'
                , 'jinyuuryoku_flg'
                , 'keitekiyou_flg'
                , 'goukeigyou_flg'
            ];
        $setdts = []; // データーの中継変数
        $thisPost = []; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        foreach ($post_flds as $post_fld) {
            $setdts[$post_fld] = "";
        }
        $setdts["cd"] = "01"; // 日別
        $setdts["junjo_kbn_cd"] = "1201"; // 日別
        $setdts["koujun_flg"] = 0;
        $setdts["kikan_sitei_kbn_cd"] = "1201"; // 今日
        $setdts["kikan_from"] = date('Y-m-d'); // 今日2019/3/19井浦
        $setdts["kikan_to"] = date('Y-m-d');
        $setdts["simekiri_kbn"] = 0;
        $setdts["tuujou_flg"] = 1;
        $setdts["henpin_flg"] = 1;
        $setdts["nebiki_flg"] = 1;
        $setdts["shokeihi_flg"] = 1;
        $setdts["urisikiri_flg"] = 1;
        $setdts["seisan_flg"] = 1;
        $setdts["shouhi_flg"] = 1;
        $setdts["azukari_flg"] = 1;
        $setdts["kakousikiri_flg"] = 1;
        $setdts["tekiyou_flg"] = 1;
        $setdts["memo_flg"] = 1;
        $setdts["shouhizei_flg"] = 1;
        $setdts["jinyuuryoku_flg"] = 0;
        $setdts["keitekiyou_flg"] = 1;
        $setdts["goukeigyou_flg"] = 0;
        $setdts["hanni_from"] = "";
        $setdts["hanni_to"] = "zzzz";
        if ($this->request->isPost()) {
            foreach ($post_flds as $post_fld) {
                if (array_key_exists($post_fld, $_POST)) {
                    $setdts[$post_fld] = array_key_exists($post_fld, $thisPost) ? $thisPost[$post_fld] : $this->request->getPost($post_fld);
                }
            }
        }

        $junjo_kbn = JunjoKbns::findFirst(["conditions" => "cd = ?1", "bind" => ["1" => $setdts["junjo_kbn_cd"]]]);

        foreach ($setdts as $fld => $setdt) { // postデータをそのまま返す。
            $this->tag->setDefault($fld, $setdt);
        }

        $to_midasi = [];
        $toviews = [];
        $di = \Phalcon\DI::getDefault();
        $mgr = $di->get('modelsManager');
        if ($setdts["koujun_flg"] == 1) {
            $desc = " DESC";
        } else {
            $desc = "";
        }
        $and_where = "";
        $where_para = [0 => $setdts["kikan_from"], 1 => $setdts["kikan_to"]];
        switch (substr($setdts["junjo_kbn_cd"], -2)) {
            case "01": // 入力順の場合
                $order_txt = "UriageDts.cd" . $desc . ", UriageMeisaiDts.cd" . $desc;
                break;
            case "02": // 日付順の場合
                $order_txt = "UriageDts.uriagebi" . $desc . ", UriageDts.cd" . $desc . ", UriageMeisaiDts.cd" . $desc;
                break;
            case "03": // 得意先順の場合
                $and_where = " AND UriageDts.tokuisaki_mr_cd BETWEEN ?2 AND ?3";
                $where_para += [2 => $setdts["hanni_from"], 3 => $setdts["hanni_to"]];
                $order_txt = "TokuisakiMrs.cd" . $desc . ", UriageDts.cd" . $desc . ", UriageMeisaiDts.cd" . $desc;
                break;
            case "04": // 商品順の場合
                $and_where = " AND UriageMeisaiDts.shouhin_mr_cd BETWEEN ?2 AND ?3";
                $where_para += [2 => $setdts["hanni_from"], 3 => $setdts["hanni_to"]];
                $order_txt = "ShouhinMrs.cd" . $desc . ", UriageDts.uriagebi" . $desc . ", UriageDts.cd" . $desc . ", UriageMeisaiDts.cd" . $desc;
                break;
            case "05": // 担当者順の場合
                $and_where = " AND UriageDts.tantou_mr_cd BETWEEN ?2 AND ?3";
                $where_para += [2 => $setdts["hanni_from"], 3 => $setdts["hanni_to"]];
                $order_txt = "TantouMrs.cd" . $desc . ", UriageDts.uriagebi" . $desc . ", UriageDts.cd" . $desc . ", UriageMeisaiDts.cd" . $desc;
                break;
            case "06": // 納入先順の場合
                $and_where = " AND UriageDts.nounyuusaki_mr_cd BETWEEN ?2 AND ?3";
                $where_para += [2 => $setdts["hanni_from"], 3 => $setdts["hanni_to"]];
                $order_txt = "NounyuusakiMrs.cd" . $desc . ", UriageDts.uriagebi" . $desc . ", UriageDts.cd" . $desc . ", UriageMeisaiDts.cd" . $desc;
                break;
            case "07": // プロジェクト順の場合
                $and_where = " AND UriageMeisaiDts.project_mr_cd BETWEEN ?2 AND ?3";
                $where_para += [2 => $setdts["hanni_from"], 3 => $setdts["hanni_to"]];
                $order_txt = "UriageMeisaiDts.project_mr_cd" . $desc . ", UriageDts.uriagebi" . $desc . ", UriageDts.cd" . $desc . ", UriageMeisaiDts.cd" . $desc;
                break;
        }
        $and_where .= $setdts["jinyuuryoku_flg"] == 1 ? " AND u.creator = " . $this->getDI()->getSession()->get('auth')['id'] : "";
        $and_where .= $setdts["tokuisaki_mr_cd"] ? " AND UriageDts.tokuisaki_mr_cd = '" . $setdts['tokuisaki_mr_cd'] . "'" : "";
        $and_where .= $setdts["tantou_mr_cd"] ? " AND UriageDts.tantou_mr_cd = '" . $setdts['tantou_mr_cd'] . "'" : "";
        $and_where .= $setdts["souko_mr_cd"] ? " AND UriageMeisaiDts.souko_mr_cd = '" . $setdts['souko_mr_cd'] . "'" : "";
        $and_where .= $setdts["project_mr_cd"] ? " AND UriageMeisaiDts.project_mr_cd = '" . $setdts['project_mr_cd'] . "'" : "";
        $and_where .= $setdts["tuujou_flg"] == 0 ? " AND UriageMeisaiDts.utiwake_kbn_cd <> '10'" : "";
        $and_where .= $setdts["henpin_flg"] == 0 ? " AND UriageMeisaiDts.utiwake_kbn_cd <> '11'" : "";
        $and_where .= $setdts["nebiki_flg"] == 0 ? " AND UriageMeisaiDts.utiwake_kbn_cd <> '12'" : "";
        $and_where .= $setdts["shokeihi_flg"] == 0 ? " AND UriageMeisaiDts.utiwake_kbn_cd <> '13'" : "";
        $and_where .= $setdts["urisikiri_flg"] == 0 ? " AND UriageMeisaiDts.utiwake_kbn_cd <> '14'" : "";
        $and_where .= $setdts["seisan_flg"] == 0 ? " AND UriageMeisaiDts.utiwake_kbn_cd <> '20'" : "";
        $and_where .= $setdts["shouhi_flg"] == 0 ? " AND UriageMeisaiDts.utiwake_kbn_cd <> '21'" : "";
        $and_where .= $setdts["azukari_flg"] == 0 ? " AND UriageMeisaiDts.utiwake_kbn_cd <> '23'" : "";
        $and_where .= $setdts["kakousikiri_flg"] == 0 ? " AND UriageMeisaiDts.utiwake_kbn_cd <> '24'" : "";
        $and_where .= $setdts["tekiyou_flg"] == 0 ? " AND UriageMeisaiDts.utiwake_kbn_cd <> '40'" : "";
        $and_where .= $setdts["memo_flg"] == 0 ? " AND UriageMeisaiDts.utiwake_kbn_cd <> '41'" : "";
        $and_where .= $setdts["shouhizei_flg"] == 0 ? " AND UriageMeisaiDts.utiwake_kbn_cd <> '90'" : "";

        $phql = "
			SELECT *, UriageDts.*,
				TorihikiKbns.name,
				TokuisakiMrs.name,
				NounyuusakiMrs.name,
				TantouMrs.name,
				ZeitenkaKbns.name,
				UtiwakeKbns.name,
				TanniMrs.name,
				SoukoMrs.name,
				concat(ZeirituMrs.ryakushou , ZeirituMrs.zeiritu , '%') as zeiritu_name,
				ProjectMrs.name
			FROM UriageMeisaiDts
			LEFT JOIN UriageDts ON uriage_dt_id = UriageDts.id
			LEFT JOIN TokuisakiMrs ON UriageDts.tokuisaki_mr_cd = TokuisakiMrs.cd
			LEFT JOIN NounyuusakiMrs ON UriageDts.nounyuusaki_mr_cd = NounyuusakiMrs.cd
			LEFT JOIN TantouMrs ON UriageDts.tantou_mr_cd = TantouMrs.cd
			LEFT JOIN TorihikiKbns ON UriageDts.torihiki_kbn_cd = TorihikiKbns.cd
			LEFT JOIN ZeitenkaKbns ON UriageDts.zei_tenka_kbn_cd = ZeitenkaKbns.cd
			LEFT JOIN UtiwakeKbns ON utiwake_kbn_cd = UtiwakeKbns.cd
			LEFT JOIN TanniMrs ON tanni_mr_cd = TanniMrs.cd
			LEFT JOIN SoukoMrs ON souko_mr_cd = SoukoMrs.cd
			LEFT JOIN ZeirituMrs ON zeiritu_mr_cd = ZeirituMrs.cd
			LEFT JOIN ProjectMrs ON project_mr_cd = ProjectMrs.cd
			WHERE UriageDts.uriagebi >= ?0 AND UriageDts.uriagebi <= ?1" . $and_where . "
			ORDER BY " . $order_txt . "
		";
        $rows = $mgr->executeQuery($phql, $where_para);

        $jouken_uriage_meisais = JoukenUriageMeisais::find([
            "order" => "cd, sakusei_user_id",
            "conditions" => "sakusei_user_id IN(0, ?0)",
            "bind" => [0 => $this->getDI()->getSession()->get('auth')['id']]
        ]);
        $joukens = [];
        foreach ($jouken_uriage_meisais as $jouken_uriage_meisai) {
            $joukens[$jouken_uriage_meisai->cd] = $jouken_uriage_meisai->name;
        }
        $this->view->joukens = $joukens;
        $this->view->setdts = $setdts;

        $this->view->rows = $rows;
        return;
    }

    /**
     * 売上明細EXCEL 2019/10/31 Nishiyama
     */
    public function indexxlsAction()
    {
        $post_flds =
            [
                'cd'
                , 'name'
                , 'junjo_kbn_cd'
                , 'koujun_flg'
                , 'hanni_from'
                , 'hanni_to'
                , 'tokuisaki_mr_cd'
                , 'shouhin_mr_cd'
                , 'tantou_mr_cd'
                , 'souko_mr_cd'
                , 'project_mr_cd'
                , 'project_sub_cd'
                , 'kikan_sitei_kbn_cd'
                , 'kikan_from'
                , 'kikan_to'
                , 'cd_from'
                , 'cd_to'
                , 'simekiri_kbn'
                , 'tuujou_flg'
                , 'henpin_flg'
                , 'nebiki_flg'
                , 'shokeihi_flg'
                , 'urisikiri_flg'
                , 'seisan_flg'
                , 'shouhi_flg'
                , 'azukari_flg'
                , 'kakousikiri_flg'
                , 'tekiyou_flg'
                , 'memo_flg'
                , 'shouhizei_flg'
                , 'jinyuuryoku_flg'
                , 'keitekiyou_flg'
                , 'goukeigyou_flg'
            ];
        $setdts = []; // データーの中継変数
        $thisPost = []; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        foreach ($post_flds as $post_fld) {
            $setdts[$post_fld] = "";
        }
        $setdts["cd"] = "01"; // 日別
        $setdts["junjo_kbn_cd"] = "1201"; // 日別
        $setdts["koujun_flg"] = 0;
        $setdts["kikan_sitei_kbn_cd"] = "1201"; // 今日
        $setdts["kikan_from"] = date('Y-m-d'); // 今日
        $setdts["kikan_to"] = date('Y-m-d');
        $setdts["simekiri_kbn"] = 0;
        $setdts["tuujou_flg"] = 1;
        $setdts["henpin_flg"] = 1;
        $setdts["nebiki_flg"] = 1;
        $setdts["shokeihi_flg"] = 1;
        $setdts["urisikiri_flg"] = 1;
        $setdts["seisan_flg"] = 1;
        $setdts["shouhi_flg"] = 1;
        $setdts["azukari_flg"] = 1;
        $setdts["kakousikiri_flg"] = 1;
        $setdts["tekiyou_flg"] = 1;
        $setdts["memo_flg"] = 1;
        $setdts["shouhizei_flg"] = 1;
        $setdts["jinyuuryoku_flg"] = 0;
        $setdts["keitekiyou_flg"] = 1;
        $setdts["goukeigyou_flg"] = 0;
        $setdts["hanni_from"] = "";
        $setdts["hanni_to"] = "zzzz";
        if ($this->request->isPost()) {
            foreach ($post_flds as $post_fld) {
                if (array_key_exists($post_fld, $_POST)) {
                    $setdts[$post_fld] = array_key_exists($post_fld, $thisPost) ? $thisPost[$post_fld] : $this->request->getPost($post_fld);
                }
            }
        }
        $junjo_kbn = JunjoKbns::findFirst(["conditions" => "cd = ?1", "bind" => ["1" => $setdts["junjo_kbn_cd"]]]);

        foreach ($setdts as $fld => $setdt) {
            $this->tag->setDefault($fld, $setdt);
        }

        $di = \Phalcon\DI::getDefault();
        $mgr = $di->get('modelsManager');
        if ($setdts["koujun_flg"] == 1) {
            $desc = " DESC";
        } else {
            $desc = "";
        }
        $and_where = "";
        $where_para = [0 => $setdts["kikan_from"], 1 => $setdts["kikan_to"]];
        switch (substr($setdts["junjo_kbn_cd"], -2)) {
            case "01": // 入力順の場合
                $order_txt = "b.cd" . $desc . ", a.cd" . $desc;
                break;
            case "02": // 日付順の場合
                $order_txt = "b.uriagebi" . $desc . ", b.cd" . $desc . ", a.cd" . $desc;
                break;
            case "03": // 得意先順の場合
                $and_where = " AND b.tokuisaki_mr_cd BETWEEN ?2 AND ?3";
                $where_para += [2 => $setdts["hanni_from"], 3 => $setdts["hanni_to"]];
                $order_txt = "b.tokuisaki_mr_cd" . $desc . ", b.cd" . $desc . ", a.cd" . $desc;
                break;
            case "04": // 商品順の場合
                $and_where = " AND a.shouhin_mr_cd BETWEEN ?2 AND ?3";
                $where_para += [2 => $setdts["hanni_from"], 3 => $setdts["hanni_to"]];
                $order_txt = "b.shouhin_mr_cd" . $desc . ", a.uriagebi" . $desc . ", b.cd" . $desc . ", a.cd" . $desc;
                break;
            case "05": // 担当者順の場合
                $and_where = " AND a.tantou_mr_cd BETWEEN ?2 AND ?3";
                $where_para += [2 => $setdts["hanni_from"], 3 => $setdts["hanni_to"]];
                $order_txt = "a.tantou_mr_cd" . $desc . ", a.uriagebi" . $desc . ", a.cd" . $desc . ", b.cd" . $desc;
                break;
            case "06": // 納入先順の場合
                $and_where = " AND b.nounyuusaki_mr_cd BETWEEN ?2 AND ?3";
                $where_para += [2 => $setdts["hanni_from"], 3 => $setdts["hanni_to"]];
                $order_txt = "a.nounyuusaki_mr_cd" . $desc . ", a.uriagebi" . $desc . ", a.cd" . $desc . ", b.cd" . $desc;
                break;
            case "07": // プロジェクト順の場合
                $and_where = " AND a.project_mr_cd BETWEEN ?2 AND ?3";
                $where_para += [2 => $setdts["hanni_from"], 3 => $setdts["hanni_to"]];
                $order_txt = "b.project_mr_cd" . $desc . ", a.uriagebi" . $desc . ", b.cd" . $desc . ", a.cd" . $desc;
                break;
        }
        $and_where .= $setdts["jinyuuryoku_flg"] == 1 ? " AND u.creator = " . $this->getDI()->getSession()->get('auth')['id'] : "";
        $and_where .= $setdts["tokuisaki_mr_cd"] ? " AND b.tokuisaki_mr_cd = '" . $setdts['tokuisaki_mr_cd'] . "'" : "";
        $and_where .= $setdts["tantou_mr_cd"] ? " AND b.tantou_mr_cd = '" . $setdts['tantou_mr_cd'] . "'" : "";
        $and_where .= $setdts["souko_mr_cd"] ? " AND a.souko_mr_cd = '" . $setdts['souko_mr_cd'] . "'" : "";
        $and_where .= $setdts["project_mr_cd"] ? " AND a.project_mr_cd = '" . $setdts['project_mr_cd'] . "'" : "";
        $and_where .= $setdts["tuujou_flg"] == 0 ? " AND a.utiwake_kbn_cd <> '10'" : "";
        $and_where .= $setdts["henpin_flg"] == 0 ? " AND a.utiwake_kbn_cd <> '11'" : "";
        $and_where .= $setdts["nebiki_flg"] == 0 ? " AND a.utiwake_kbn_cd <> '12'" : "";
        $and_where .= $setdts["shokeihi_flg"] == 0 ? " AND a.utiwake_kbn_cd <> '13'" : "";
        $and_where .= $setdts["urisikiri_flg"] == 0 ? " AND a.utiwake_kbn_cd <> '14'" : "";
        $and_where .= $setdts["seisan_flg"] == 0 ? " AND a.utiwake_kbn_cd <> '20'" : "";
        $and_where .= $setdts["shouhi_flg"] == 0 ? " AND a.utiwake_kbn_cd <> '21'" : "";
        $and_where .= $setdts["azukari_flg"] == 0 ? " AND a.utiwake_kbn_cd <> '23'" : "";
        $and_where .= $setdts["kakousikiri_flg"] == 0 ? " AND a.utiwake_kbn_cd <> '24'" : "";
        $and_where .= $setdts["tekiyou_flg"] == 0 ? " AND a.utiwake_kbn_cd <> '40'" : "";
        $and_where .= $setdts["memo_flg"] == 0 ? " AND a.utiwake_kbn_cd <> '41'" : "";
        $and_where .= $setdts["shouhizei_flg"] == 0 ? " AND a.utiwake_kbn_cd <> '90'" : "";

        $phql = "
			SELECT
			    b.nendo AS nendo,
			    b.uriagebi AS uriagebi,
			    b.cd AS den_cd,
			    f.name AS torihiki_kbn_name,
			    b.tokuisaki_mr_cd AS tokuisaki_cd,
				c.name AS tokuisaki_name,
				b.tantou_mr_cd AS tantou_cd,
				e.name AS tantou_name,
				b.nounyuusaki_mr_cd AS nounyuusaki_cd,
				d.name AS nounyuusaki_name,
				b.kidukesaki_mr_cd AS kiduke_cd,
			    b.kiduke AS kiduke,
			    b.saki_hacchuu_cd as user_order,
			    h.name AS utiwake_name,
			    a.shouhin_mr_cd AS shouhin_cd,
			    IF(a.shukka_kbn_cd <> '', '完', '') AS shukka_kbn,
			    a.tekiyou AS tekiyou,
			    a.lot AS lot,
			    a.iro AS iro,
			    a.iromei AS iromei,
			    a.kobetucd AS kobetucd,
			    a.souko_mr_cd AS souko_cd,
			    j.name AS souko_name,
			    a.kikaku AS kikaku,
			    a.size AS size,
			    IF(a.tanka_kbn = 1, a.suuryou1, a.suuryou2) AS uri_ryou,
			    IF(a.tanka_kbn = 1, i.name, m.name) AS tanka_tani,
			    a.tanka AS tanka,
			    a.gentanka AS cost,
			    a.zeinukigaku AS zeinukigaku,
			    a.zeigaku AS zeigaku,
			    a.zeinukigaku + a.zeigaku AS kingaku,
			    a.genkagaku AS genkagaku,
			    a.zeinukigaku - a.genkagaku AS arari,
			    l.name AS project_name,
			    g.name AS zeitenka_name,
			    CONCAT(k.ryakushou , k.zeiritu , '%') AS zeiritu_name,
			    b.zeiritu_tekiyoubi AS zeiritu_tekiyoubi,
			    a.bikou AS meisai_bikou,
			    IF(b.shimekiri_flg=0, '今回', '次回') AS sime_flg,
			    b.kaishuu_yoteibi AS kaishuu_yoteibi,
			    b.keshikomi_flg AS keshikomi_flg,
			    b.nounyuu_kijitu AS nouki,
			    b.shukkabi AS shukkabi,  
				b.tekiyou AS den_tekiyou	
			FROM UriageMeisaiDts AS a
			LEFT JOIN UriageDts AS b ON a.uriage_dt_id = b.id  
			LEFT JOIN TokuisakiMrs AS c ON b.tokuisaki_mr_cd = c.cd
			LEFT JOIN NounyuusakiMrs AS d ON b.nounyuusaki_mr_cd = d.cd
			LEFT JOIN TantouMrs AS e ON b.tantou_mr_cd = e.cd
			LEFT JOIN TorihikiKbns AS f ON b.torihiki_kbn_cd = f.cd
			LEFT JOIN ZeitenkaKbns AS g ON b.zei_tenka_kbn_cd = g.cd
			LEFT JOIN UtiwakeKbns AS h ON a.utiwake_kbn_cd = h.cd
			LEFT JOIN TanniMrs AS i ON a.tanni_mr1_cd = i.cd
			LEFT JOIN TanniMrs AS m ON a.tanni_mr2_cd = i.cd
			LEFT JOIN SoukoMrs AS j ON a.souko_mr_cd = j.cd
			LEFT JOIN ZeirituMrs AS k ON a.zeiritu_mr_cd = k.cd
			LEFT JOIN ProjectMrs AS l ON a.project_mr_cd = l.cd
			WHERE b.uriagebi >= ?0 AND b.uriagebi <= ?1" . $and_where . "
			ORDER BY " . $order_txt . "
		";
        $rows = $mgr->executeQuery($phql, $where_para);
        $rows = $rows->toArray();

        $data_title = [];
        $data_title[0] = [
            "nendo" => "年度",
            "uriagebi" => "売上日",
            "den_cd" => "伝票番号",
            "torihiki_kbn_name" => "取引区分",
            "tokuisaki_cd" => "得意先コード",
            "tokuisaki_name" => "得意先",
            "tantou_cd" => "担当コード",
            "tantou_name" => "担当",
            "nounyuusaki_cd" => "納入先コード",
            "nounyuusaki_name" => "納入先",
            "kiduke_cd" => "気付先コード",
            "kiduke" => "気付",
            "user_order" => "ユーザーオーダーナンバー",
            "utiwake_name" => "内訳区分",
            "shouhin_cd" => "商品コード",
            "shukka_kbn" => "出荷区分",
            "tekiyou" => "摘要",
            "lot" => "lot",
            "iro" => "色番",
            "iromei" => "色名",
            "kobetucd" => "個別コード",
            "souko_cd" => "倉庫コード",
            "souko_name" => "倉庫名",
            "kikaku" => "規格",
            "size" => "サイズ",
            "uri_ryou" => "数量",
            "tanka_tani" => "単位",
            "tanka" => "単価",
            "cost" => "原単価",
            "zeinukigaku" => "税抜額",
            "zeigaku" => "税額",
            "kingaku" => "金額",
            "genkagaku" => "原価額",
            "arari" => "粗利",
            "project_name" => "プロジェクト名",
            "zeitenka_name" => "税転嫁",
            "zeiritu_name" => "税率",
            "zeiritu_tekiyoubi" => "税率適用日",
            "meisai_bikou" => "備考",
            "sime_flg" => "締めフラグ",
            "kaishuu_yoteibi" => "回収予定日",
            "keshikomi_flg" => "消込フラグ",
            "nouki" => "納期",
            "shukkabi" => "出荷日",
            "den_tekiyou" => "伝票摘要",
        ];
        $data_sets = array_merge($data_title, $rows); //見出しとデータのマージ

        include __DIR__ . '/../vendor/PHPExcel/Classes/PHPExcel.php';
        include __DIR__ . '/../vendor/PHPExcel/Classes/PHPExcel/Writer/Excel2007.php';
        include __DIR__ . '/../vendor/PHPExcel/Classes/PHPExcel/IOFactory.php';
        $PHPExcel = new PHPExcel();
        $sheet = $PHPExcel->getActiveSheet();
        $sheet->fromArray($data_sets, null, 'A1');

        // 保存
        $filename = uniqid("uridt", true) . '';
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
     * 売上日報
     */
    public function nippouAction()
    {
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
            "simekiri_kbn",
            "meisaigyou_flg",
            "goukeigyou_flg",
            "jinyuuryoku_flg",
            "torihikiari_flg",
            "torihikinasi_flg",
        ];
        $setdts = []; // データーの中継変数
        $thisPost = []; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        if (!$this->request->isPost()) {
            foreach ($post_flds as $post_fld) {
                $setdts[$post_fld] = "";
            }
            $setdts["cd"] = "01"; // 日別
            $setdts["torihiki_kbn_betu_flg"] = 0;
            $setdts["junjo_kbn_cd"] = "1201"; // 日別
            $setdts["koujun_flg"] = 0;
            $setdts["kikan_sitei_kbn_cd"] = "1207"; // 今月
            $setdts["kikan_from"] = date('Y-m-01');
            $setdts["kikan_to"] = date('Y-m-t');
            $setdts["simekiri_kbn"] = 0;
            $setdts["meisaigyou_flg"] = 1;
            $setdts["goukeigyou_flg"] = 0;
            $setdts["jinyuuryoku_flg"] = 0;
            $setdts["torihikiari_flg"] = 1;
            $setdts["torihikinasi_flg"] = 0;
        } else {
            foreach ($post_flds as $post_fld) {
                $setdts[$post_fld] = array_key_exists($post_fld, $thisPost) ? $thisPost[$post_fld] : $this->request->getPost($post_fld);
            }
        }

        $junjo_kbn = JunjoKbns::findFirst(["conditions" => "cd = ?1", "bind" => ["1" => $setdts["junjo_kbn_cd"]]]);

        foreach ($setdts as $fld => $setdt) { // postデータをそのまま返す。
            $this->tag->setDefault($fld, $setdt);
        }

        $to_midasi = [];
        $toviews = [];
        $shousuus = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]; //金額なら0とりあえず14個
        $di = \Phalcon\DI::getDefault();
        $mgr = $di->get('modelsManager');
        if ($setdts["torihiki_kbn_betu_flg"]) { // 取引区分別の場合
            $phql = "
				SELECT tm.cd as tm_cd, tm.name as tm_name, SUM(um.zeinukigaku) as kingaku_kei, SUM(um.zeinukigaku - um.genkagaku) as arari, tr.cd as tr_cd, tr.name as tr_name
				FROM TorihikiKbnMidasis AS tm
				LEFT JOIN UriageDts AS u ON tm.torihiki_kbn_cd = u.torihiki_kbn_cd
				LEFT JOIN UriageMeisaiDts AS um ON um.uriage_dt_id = u.id AND tm.utiwake_kbn_cd = um.utiwake_kbn_cd
				LEFT JOIN TorihikiKbns AS tr ON tm.torihiki_kbn_cd = tr.cd
				WHERE u.uriagebi >= ?0 AND u.uriagebi <= ?1 OR u.uriagebi IS NULL
				GROUP BY tm.cd
			";
            $rows = $mgr->executeQuery($phql, [0 => $setdts["kikan_from"], 1 => $setdts["kikan_to"]]);
            $to_midasi = ["区分", "取引内容", "金額"];
            $junurigaku = 0; // 純売上額
            $ararieki = 0; // 粗利益
            foreach ($rows as $rw) {
                if ($rw->tm_cd != "50") {
                    $toviews[] = ["【" . $rw->tr_name . "】", $rw->tm_name, $rw->kingaku_kei];
                    $junurigaku += $rw->kingaku_kei;
                    $ararieki += $rw->arari;
                } else {
                    $sample = $rw; // サンプル数レコードを控えて置く
                }
            }
            $toviews[] = ["【合計】", "純売上額", $junurigaku];
            $toviews[] = ["【合計】", "粗利益", $ararieki];
            $toviews[] = ["【合計】", "粗利率(%)", round(100 * $ararieki / $junurigaku, 0)];
            $shousuus[count($rows) + 3] = 1;

            $zphql = "
				SELECT zt.cd as zt_cd, zt.name as zt_name, SUM(um.zeigaku) as kingaku_kei
				FROM ZeitenkaKbns AS zt
				LEFT JOIN UriageDts AS u ON zt.cd = u.zei_tenka_kbn_cd
				LEFT JOIN UriageMeisaiDts AS um ON um.uriage_dt_id = u.id
				WHERE u.uriagebi >= ?0 AND u.uriagebi <= ?1 OR u.uriagebi IS NULL
				GROUP BY zt.cd
			";
            $zrows = $mgr->executeQuery($zphql, [0 => $setdts["kikan_from"], 1 => $setdts["kikan_to"]]);
            $zeikei = 0; // 消費税合計
            foreach ($zrows as $zr) {
                $toviews[] = ["【消 費 税】", $zr->zt_name, $zr->kingaku_kei];
                $zeikei += $zr->kingaku_kei;
            }
            $toviews[] = ["【消 費 税】", "合計", $zeikei];
            $toviews[] = ["【" . $sample->tr_name . "】", $sample->tm_name, $sample->kingaku_kei];

        } else if (substr($setdts["junjo_kbn_cd"], -2) == "01") { // 日付順の場合
            $phql = "
				SELECT SUM(um.zeinukigaku) as um_kingaku, SUM(um.zeinukigaku - um.genkagaku) as arari, u.uriagebi as u_uriagebi, um.utiwake_kbn_cd as um_utiwake_kbn_cd
				FROM UriageMeisaiDts AS um
				LEFT JOIN UriageDts AS u ON um.uriage_dt_id = u.id
				WHERE u.uriagebi >= ?0 AND u.uriagebi <= ?1
				GROUP BY u.uriagebi, um.utiwake_kbn_cd
				ORDER BY u.uriagebi" . ($setdts["koujun_flg"] == 1 ? " DESC" : "") . ", um.utiwake_kbn_cd
			";
            $rows = $mgr->executeQuery($phql, [0 => $setdts["kikan_from"], 1 => $setdts["kikan_to"]]);
            $to_midasi = ["", "日付", "総売上額", "返品額", "返品率", "値引額", "値引率", "その他", "純売上額", "粗利益", "粗利率"];
            $utiwake_kbn_retu = ["10" => 2, "11" => 3, "12" => 5, "13" => 7, "14" => 8, "15" => 7, "20" => 7, "21" => 7, "23" => 7, "24" => 8, "30" => 7, "40" => 7, "41" => 7, "90" => 7]; // 加算する列番号を決める
            $junurigaku = 0; // 純売上額
            $ararieki = 0; // 粗利益
            $toviews[0][0] = "";
            $toviews[0][1] = "《総合計》"; // 日付
            for ($i = 2; $i <= 10; $i++) {
                $toviews[0][$i] = 0;
            } // 合計行クリア
            $i = 0;
            foreach ($rows as $rw) {
                if ($rw->u_uriagebi != $toviews[$i][1]) {
                    $toviews[$i][8] = $toviews[$i][2] + $toviews[$i][3] + $toviews[$i][5] + $toviews[$i][7]; // 純売上額
                    if ($toviews[$i][2] != 0) {
                        $toviews[$i][4] = round(-100 * $toviews[$i][3] / $toviews[$i][2], 1); // 返品率
                        $toviews[$i][6] = round(-100 * $toviews[$i][5] / $toviews[$i][2], 1); // 値引率
                    }
                    if ($toviews[$i][8] != 0) {
                        $toviews[$i][10] = round(100 * $toviews[$i][9] / $toviews[$i][8], 1); // 粗利率
                    }
                    $i++;
                    $toviews[$i][1] = $rw->u_uriagebi; // 日付
                    $toviews[$i][0] = ""; // colspan
                    $toviews[$i][2] = 0; // 総売上額
                    $toviews[$i][3] = 0; // 返品額
                    $toviews[$i][4] = 0; // 返品率
                    $toviews[$i][5] = 0; // 値引額
                    $toviews[$i][6] = 0; // 値引率
                    $toviews[$i][7] = 0; // その他
                    $toviews[$i][8] = 0; // 純売上額
                    $toviews[$i][9] = 0; // 粗利益
                    $toviews[$i][10] = 0; // 粗利率
                }
                $toviews[$i][$utiwake_kbn_retu[$rw->um_utiwake_kbn_cd]] += $rw->um_kingaku;
                $toviews[$i][9] += $rw->arari;
                $toviews[0][$utiwake_kbn_retu[$rw->um_utiwake_kbn_cd]] += $rw->um_kingaku;
                $toviews[0][9] += $rw->arari;
// echo "\n<br>".$rw->u_uriagebi." ".$rw->um_utiwake_kbn_cd." ".$utiwake_kbn_retu[$rw->um_utiwake_kbn_cd];
            }
            $toviews[$i][8] = $toviews[$i][2] + $toviews[$i][3] + $toviews[$i][5] + $toviews[$i][7]; // 純売上額
            if ($toviews[$i][2] != 0) { // 最終行
                $toviews[$i][4] = round(-100 * $toviews[$i][3] / $toviews[$i][2], 1); // 返品率
                $toviews[$i][6] = round(-100 * $toviews[$i][5] / $toviews[$i][2], 1); // 値引率
            }
            if ($toviews[$i][8] != 0) { // 最終行
                $toviews[$i][10] = round(100 * $toviews[$i][9] / $toviews[$i][8], 1); // 粗利率
            }
            $toviews[0][8] = $toviews[0][2] + $toviews[0][3] + $toviews[0][5] + $toviews[0][7]; // 純売上額
            if ($toviews[0][2] != 0) { // 合計行
                $toviews[0][4] = round(-100 * $toviews[0][3] / $toviews[0][2], 1); // 返品率
                $toviews[0][6] = round(-100 * $toviews[0][5] / $toviews[0][2], 1); // 値引率
            }
            if ($toviews[0][8] != 0) { // 合計行
                $toviews[0][10] = round(100 * $toviews[0][9] / $toviews[0][8], 1); // 粗利率
            }
            $shousuus[10] = 1;

        } else if (substr($setdts["junjo_kbn_cd"], -2) == "02") { // 得意先順の場合
            $phql = "
				SELECT SUM(um.zeinukigaku) as um_kingaku, SUM(um.zeinukigaku - um.genkagaku) as arari, t.cd as t_cd, t.name as t_name, um.utiwake_kbn_cd as um_utiwake_kbn_cd
				FROM TokuisakiMrs AS t
				LEFT JOIN UriageDts AS u ON t.cd = u.tokuisaki_mr_cd
				LEFT JOIN UriageMeisaiDts AS um ON u.id = um.uriage_dt_id
				WHERE (u.uriagebi >= ?0 AND u.uriagebi <= ?1" . ($setdts["torihikinasi_flg"] == 1 ? " OR u.uriagebi IS NULL" : "") . ")
					AND t.cd >= ?2 AND t.cd <= ?3" . ($setdts["jinyuuryoku_flg"] == 1 ? " AND u.creator = " . $this->getDI()->getSession()->get('auth')['id'] : "") . "
				GROUP BY t.cd, um.utiwake_kbn_cd
				ORDER BY t.cd" . ($setdts["koujun_flg"] == 1 ? " DESC" : "") . ", um.utiwake_kbn_cd
			";
            $rows = $mgr->executeQuery($phql, [0 => $setdts["kikan_from"], 1 => $setdts["kikan_to"], 2 => $setdts["hanni_from"], 3 => $setdts["hanni_to"]]);
            $to_midasi = ["得意先コード", "得意先名", "総売上額", "返品額", "返品率", "値引額", "値引率", "その他", "純売上額", "粗利益", "粗利率"];
            $utiwake_kbn_retu = ["10" => 2, "11" => 3, "12" => 5, "13" => 7, "14" => 8, "15" => 7, "20" => 7, "21" => 7, "23" => 7, "24" => 8, "30" => 7, "40" => 7, "41" => 7, "90" => 7]; // 加算する列番号を決める
            $junurigaku = 0; // 純売上額
            $ararieki = 0; // 粗利益
            $toviews[0][0] = "　";
            $toviews[0][1] = "《総合計》";
            for ($i = 2; $i <= 10; $i++) {
                $toviews[0][$i] = 0;
            } // 合計行クリア
            $i = 0;
            foreach ($rows as $rw) {
                if ($rw->t_cd != $toviews[$i][0]) {
                    $toviews[$i][8] = $toviews[$i][2] + $toviews[$i][3] + $toviews[$i][5] + $toviews[$i][7]; // 純売上額
                    if ($toviews[$i][2] != 0) {
                        $toviews[$i][4] = round(-100 * $toviews[$i][3] / $toviews[$i][2], 1); // 返品率
                        $toviews[$i][6] = round(-100 * $toviews[$i][5] / $toviews[$i][2], 1); // 値引率
                    }
                    if ($toviews[$i][8] != 0) {
                        $toviews[$i][10] = round(100 * $toviews[$i][9] / $toviews[$i][8], 1); // 粗利率
                    }
                    if ($setdts["torihikiari_flg"] == 0
                        && $toviews[$i][2] == 0
                        && $toviews[$i][3] == 0
                        && $toviews[$i][5] == 0
                        && $toviews[$i][7] == 0
                        && $toviews[$i][9] == 0) { // 取引有を除くなら、この行を潰す
                    } else {
                        $i++;
                    }
                    $toviews[$i][0] = $rw->t_cd; // 得意先コード
                    $toviews[$i][1] = $rw->t_name; // 得意先名
                    $toviews[$i][2] = 0; // 総売上額
                    $toviews[$i][3] = 0; // 返品額
                    $toviews[$i][4] = 0; // 返品率
                    $toviews[$i][5] = 0; // 値引額
                    $toviews[$i][6] = 0; // 値引率
                    $toviews[$i][7] = 0; // その他
                    $toviews[$i][8] = 0; // 純売上額
                    $toviews[$i][9] = 0; // 粗利益
                    $toviews[$i][10] = 0; // 粗利率
                }
                if ($rw->um_utiwake_kbn_cd) {
//echo "\n<br>".$rw->um_utiwake_kbn_cd." ".$utiwake_kbn_retu[$rw->um_utiwake_kbn_cd]." ".$rw->um_kingaku;
                    $toviews[$i][$utiwake_kbn_retu[$rw->um_utiwake_kbn_cd]] += $rw->um_kingaku;
                    if ($setdts["torihikiari_flg"] != 0) { // 取引有を除くなら加算しない
                        $toviews[0][$utiwake_kbn_retu[$rw->um_utiwake_kbn_cd]] += $rw->um_kingaku;
                    }
                }
                $toviews[$i][9] += $rw->arari;
                if ($setdts["torihikiari_flg"] != 0) { // 取引有を除くなら加算しない
                    $toviews[0][9] += $rw->arari;
                }
            }
            $toviews[$i][8] = $toviews[$i][2] + $toviews[$i][3] + $toviews[$i][5] + $toviews[$i][7]; // 純売上額
            if ($toviews[$i][2] != 0) { // 最終行
                $toviews[$i][4] = round(-100 * $toviews[$i][3] / $toviews[$i][2], 1); // 返品率
                $toviews[$i][6] = round(-100 * $toviews[$i][5] / $toviews[$i][2], 1); // 値引率
            }
            if ($toviews[$i][8] != 0) { // 最終行
                $toviews[$i][10] = round(100 * $toviews[$i][9] / $toviews[$i][8], 1); // 粗利率
            }
            if ($toviews[0][2] != 0) { // 合計行
                $toviews[0][4] = round(-100 * $toviews[0][3] / $toviews[0][2], 1); // 返品率
                $toviews[0][6] = round(-100 * $toviews[0][5] / $toviews[0][2], 1); // 値引率
                $toviews[0][8] = $toviews[0][2] + $toviews[0][3] + $toviews[0][5] + $toviews[0][7]; // 純売上額
            }
            if ($toviews[0][8] != 0) { // 合計行
                $toviews[0][10] = round(100 * $toviews[0][9] / $toviews[0][8], 1); // 粗利率
            }
            $shousuus[10] = 1;

        }
        $jouken_uriage_nippous = JoukenUriageNippous::find(["order" => "cd, sakusei_user_id"
            , "conditions" => "sakusei_user_id IN(0, ?0)"
            , "bind" => [0 => $this->getDI()->getSession()->get('auth')['id']]
        ]);
        $joukens = [];
        foreach ($jouken_uriage_nippous as $jouken_uriage_nippou) {
            $joukens[$jouken_uriage_nippou->cd] = $jouken_uriage_nippou->name;
        }
        $this->view->joukens = $joukens;

        $this->view->to_midasi = $to_midasi;
        $this->view->toviews = $toviews;
        $this->view->shousuus = $shousuus;
        return;

    }

    /**
     * 売上月報
     *
     * @return void
     */
    public function geppouAction()
    {
        $post_flds = ["cd", "torihiki_kbn_betu_flg", "junjo_kbn_cd", "koujun_flg", "hanni_from", "hanni_to", "kikan_sitei_kbn_cd", "kikan_from", "kikan_to", "zeikomi_flg", "meisaigyou_flg", "goukeigyou_flg", "jinyuuryoku_flg", "torihikiari_flg", "torihikinasi_flg", "hokakei_flg", "zennnen_flg"];
        $setdts = [];
        $thisPost = [];
        if (!$this->request->isPost()) {
            foreach ($post_flds as $post_fld) {
                $setdts[$post_fld] = "";
            }
            $setdts["cd"] = "01"; // 日別
            $setdts["torihiki_kbn_betu_flg"] = 0;
            $setdts["junjo_kbn_cd"] = "1501"; // 月別
            $setdts["koujun_flg"] = 0;
            $setdts["kikan_sitei_kbn_cd"] = "1507"; // 今月
            $setdts["kikan_from"] = date('Y-m-01');
            $setdts["kikan_to"] = date('Y-m-t');
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
        $to_midasi = [];
        $toviews = [];
        $shousuus = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]; //金額なら0とりあえず14個
        $db = \Phalcon\DI::getDefault()->get('db');
        $kikanFrom = $setdts['kikan_from'];
        $kikanTo = $setdts['kikan_to'];
        $hanniFrom = $setdts['hanni_from'];
        $hanniTo = $setdts['hanni_to'];

        if (substr($setdts["junjo_kbn_cd"], -2) == "01") { // 月度順の場合
            if ((int)$setdts["torihikinasi_flg"] !== 1) {
                // 月度別（取引有りのみ）
                $where = " where u.uriagebi between '{$kikanFrom}' and '{$kikanTo}' ";
            } else {
                // 月度別（取引無しのみ）
                $where = " where (u.uriagebi between '{$kikanFrom}' and '{$kikanTo}') or (u.uriagebi IS NULL) ";
            }
            // 自入力のみの場合
            if ((int)$setdts["jinyuuryoku_flg"] === 1) {
                $creator = $this->getDI()->getSession()->get('auth')['id'];
                $where .= " and u.sakusei_user_id = {$creator} ";
            }
            if ((int)$setdts["koujun_flg"] === 1) {
                $order = " order by DATE_FORMAT(u.uriagebi,'%Y%m') DESC, um.utiwake_kbn_cd ";
            } else {
                $order = " order by DATE_FORMAT(u.uriagebi,'%Y%m'), um.utiwake_kbn_cd ";
            }
            $phql = "
                    select 
                       sum(um.zeinukigaku) as um_kingaku, sum(um.zeinukigaku - um.genkagaku) as arari, DATE_FORMAT(u.uriagebi,'%Y-%m') as name, '' as cd, um.utiwake_kbn_cd as um_utiwake_kbn_cd, sum(um.zeigaku) as zeigaku
                    from uriage_meisai_dts as um
                    left JOIN uriage_dts as u on um.uriage_dt_id = u.id
                    {$where}
                    group by DATE_FORMAT(u.uriagebi,'%Y%m'), um.utiwake_kbn_cd
                    {$order}
                ";
            $stmt = $db->prepare($phql);
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $to_midasi = ["", "日付", "総売上額", "返品額", "返品率", "値引額", "値引率", "その他", "純売上額", "粗利益", "粗利率", "税込額"];
            $utiwake_kbn_retu = ["10" => 2, "11" => 3, "12" => 5, "13" => 7, "14" => 8, "15" => 7, "20" => 7, "21" => 7, "23" => 7, "24" => 8, "30" => 7, "40" => 7, "41" => 7, "90" => 7]; // 加算する列番号を決める
            $shousuus[10] = 1;
            $toviews = [];
            $zeigaku = 0;
            $toviews[0][0] = "";
            $toviews[0][1] = "《総合計》"; // 日付
            for ($i = 2; $i < count($to_midasi); $i++) {

                $toviews[0][$i] = 0;
            }
            $i = 0;
            foreach ($rows as $rw) {
                if ($rw['name'] != $toviews[$i][1]) {
                    $toviews[$i][8] = $toviews[$i][2] + $toviews[$i][3] + $toviews[$i][5] + $toviews[$i][7]; // 純売上額
                    $toviews[$i][11] = $toviews[$i][8] + $zeigaku; // 税込
                    if ($toviews[$i][2] != 0) {
                        $toviews[$i][4] = round(-100 * $toviews[$i][3] / $toviews[$i][2], 1); // 返品率
                        $toviews[$i][6] = round(-100 * $toviews[$i][5] / $toviews[$i][2], 1); // 値引率
                    }
                    if ($toviews[$i][8] != 0) {
                        $toviews[$i][10] = round(100 * $toviews[$i][9] / $toviews[$i][8], 1); // 粗利率
                    }
                    $i++;
                    $toviews[$i][1] = $rw['name'] ; // 日付
                    $toviews[$i][0] = $rw['cd'];
                    $toviews[$i][2] = 0; // 総売上額
                    $toviews[$i][3] = 0; // 返品額
                    $toviews[$i][4] = 0; // 返品率
                    $toviews[$i][5] = 0; // 値引額
                    $toviews[$i][6] = 0; // 値引率
                    $toviews[$i][7] = 0; // その他
                    $toviews[$i][8] = 0; // 純売上額
                    $toviews[$i][9] = 0; // 粗利益
                    $toviews[$i][10] = 0; // 粗利率
                    $toviews[$i][11] = 0; // 税込売上額
                    $zeigaku = 0;
                }
                $toviews[$i][$utiwake_kbn_retu[$rw['um_utiwake_kbn_cd']]] += $rw['um_kingaku'];
                $toviews[$i][9] += $rw['arari'];
                $toviews[0][$utiwake_kbn_retu[$rw['um_utiwake_kbn_cd']]] += $rw['um_kingaku'];
                $toviews[0][9] += $rw['arari'];
                $zeigaku += $rw['zeigaku'];
            }
            $toviews[$i][8] = $toviews[$i][2] + $toviews[$i][3] + $toviews[$i][5] + $toviews[$i][7]; // 純売上額
            $toviews[$i][11] = $toviews[$i][8] + $zeigaku;
            if ($toviews[$i][2] != 0) { // 最終行
                $toviews[$i][4] = round(-100 * $toviews[$i][3] / $toviews[$i][2], 1); // 返品率
                $toviews[$i][6] = round(-100 * $toviews[$i][5] / $toviews[$i][2], 1); // 値引率
            }
            if ($toviews[$i][8] != 0) { // 最終行
                $toviews[$i][10] = round(100 * $toviews[$i][9] / $toviews[$i][8], 1); // 粗利率
            }
            $toviews[0][8] = $toviews[0][2] + $toviews[0][3] + $toviews[0][5] + $toviews[0][7]; // 純売上額
            $toviews[0][11] = $toviews[0][8] + array_sum(array_column($rows, 'zeigaku'));
            if ($toviews[0][2] != 0) { // 合計行
                $toviews[0][4] = round(-100 * $toviews[0][3] / $toviews[0][2], 1); // 返品率
                $toviews[0][6] = round(-100 * $toviews[0][5] / $toviews[0][2], 1); // 値引率
            }
            if ($toviews[0][8] != 0) { // 合計行
                $toviews[0][10] = round(100 * $toviews[0][9] / $toviews[0][8], 1); // 粗利率
            }
            $shousuus[10] = 1;
        } else if (substr($setdts["junjo_kbn_cd"], -2) == "02") { // 得意先順の場合
            if ((int)$setdts["torihikinasi_flg"] !== 1) {
                // 得意先別（取引有りのみ）
                $where = " where u.uriagebi between '{$kikanFrom}' and '{$kikanTo}' and t.cd between '{$hanniFrom}' and '{$hanniTo}'";
                // 自入力のみの場合
                if ((int)$setdts["jinyuuryoku_flg"] === 1) {
                    $creator = $this->getDI()->getSession()->get('auth')['id'];
                    $where .= " and u.sakusei_user_id = {$creator} ";
                }
                if ((int)$setdts["koujun_flg"] === 1) {
                    $order = " order by t.cd DESC, um.utiwake_kbn_cd ";
                } else {
                    $order = " order by t.cd, um.utiwake_kbn_cd ";
                }
                $phql = "
                    select 
                        sum(um.zeinukigaku) as um_kingaku, sum(um.zeinukigaku - um.genkagaku) as arari, t.cd as cd, t.name as name, um.utiwake_kbn_cd as um_utiwake_kbn_cd, sum(um.zeigaku) as zeigaku
                    from tokuisaki_mrs as t
                    left join uriage_dts as u on t.cd = u.tokuisaki_mr_cd
                    left join uriage_meisai_dts as um on u.id = um.uriage_dt_id
                    {$where}
                    group by t.cd, um.utiwake_kbn_cd
                    {$order}
                ";
                $stmt = $db->prepare($phql);
                $stmt->execute();
                $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $to_midasi = ["得意先コード", "得意先名", "総売上額", "返品額", "返品率", "値引額", "値引率", "その他", "純売上額", "粗利益", "粗利率", "税込額"];
                $utiwake_kbn_retu = ["10" => 2, "11" => 3, "12" => 5, "13" => 7, "14" => 8, "15" => 7, "20" => 7, "21" => 7, "23" => 7, "24" => 8, "30" => 7, "40" => 7, "41" => 7, "90" => 7]; // 加算する列番号を決める
                $shousuus[10] = 1;
                $toviews = $this->_makeMonthlyReport($to_midasi, $utiwake_kbn_retu, $rows, (int)$setdts['torihikiari_flg']);
            } else {
                // 得意先別（取引無し含む）
                $where = " where bb.uriagebi between '{$kikanFrom}' and '{$kikanTo}' and aa.cd between '{$hanniFrom}' and '{$hanniTo}'";
                // 自入力のみの場合
                if ((int)$setdts["jinyuuryoku_flg"] === 1) {
                    $creator = $this->getDI()->getSession()->get('auth')['id'];
                    $where .= " and bb.sakusei_user_id = {$creator} ";
                }
                if ((int)$setdts["koujun_flg"] === 1) {
                    $order = " order by t.cd DESC ";
                } else {
                    $order = " order by t.cd ";
                }
                $phql = "
                    select 
                        um_kingaku, arari, t.cd as cd, t.name as name, um_utiwake_kbn_cd, zeigaku
                    from tokuisaki_mrs as t
                    left join (
                        select
                            sum(cc.zeinukigaku) as um_kingaku, 
                            sum(cc.zeinukigaku - cc.genkagaku) as arari, 
                            aa.cd as t_cd, aa.name as t_name,
                            cc.utiwake_kbn_cd as um_utiwake_kbn_cd,
                            sum(cc.zeigaku) as zeigaku
                        from tokuisaki_mrs as aa
                        left join uriage_dts as bb on aa.cd = bb.tokuisaki_mr_cd  
                        left join uriage_meisai_dts as cc on bb.id = cc.uriage_dt_id
                            {$where}
                            group by aa.cd, cc.utiwake_kbn_cd
                            order by aa.cd, cc.utiwake_kbn_cd
                        ) as sub on sub.t_cd = t.cd
                    {$order}
                ";
                $stmt = $db->prepare($phql);
                $stmt->execute();
                $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $to_midasi = ["得意先コード", "得意先名", "総売上額", "返品額", "返品率", "値引額", "値引率", "その他", "純売上額", "粗利益", "粗利率", "税込額"];
                $utiwake_kbn_retu = ["10" => 2, "11" => 3, "12" => 5, "13" => 7, "14" => 8, "15" => 7, "20" => 7, "21" => 7, "23" => 7, "24" => 8, "30" => 7, "40" => 7, "41" => 7, "90" => 7]; // 加算する列番号を決める
                $shousuus[10] = 1;
                $toviews = $this->_makeMonthlyReport($to_midasi, $utiwake_kbn_retu, $rows, (int)$setdts['torihikiari_flg']);
            }
        } else if (substr($setdts["junjo_kbn_cd"], -2) == "10") { // 商品順の場合
            if ((int)$setdts["torihikinasi_flg"] !== 1) {
                // 商品別（取引有りのみ）
                $where = " where u.uriagebi between '{$kikanFrom}' and '{$kikanTo}' and t.cd between '{$hanniFrom}' and '{$hanniTo}'";
                // 自入力のみの場合
                if ((int)$setdts["jinyuuryoku_flg"] === 1) {
                    $creator = $this->getDI()->getSession()->get('auth')['id'];
                    $where .= " and u.sakusei_user_id = {$creator} ";
                }
                if ((int)$setdts["koujun_flg"] === 1) {
                    $order = " order by t.cd DESC, um.utiwake_kbn_cd ";
                } else {
                    $order = " order by t.cd, um.utiwake_kbn_cd ";
                }
                $phql = "
                    select 
                        sum(um.zeinukigaku) as um_kingaku, sum(um.zeinukigaku - um.genkagaku) as arari, t.cd as cd, t.name as name, um.utiwake_kbn_cd as um_utiwake_kbn_cd, sum(um.zeigaku) as zeigaku
                    from shouhin_mrs as t
                    left join uriage_meisai_dts as um on t.cd = um.shouhin_mr_cd
                    left join uriage_dts as u on u.id = um.uriage_dt_id
                    {$where}
                    group by t.cd, um.utiwake_kbn_cd
                    {$order}
                ";
                $stmt = $db->prepare($phql);
                $stmt->execute();
                $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $to_midasi = ["商品コード", "商品名", "総売上額", "返品額", "返品率", "値引額", "値引率", "その他", "純売上額", "粗利益", "粗利率", "税込額"];
                $utiwake_kbn_retu = ["10" => 2, "11" => 3, "12" => 5, "13" => 7, "14" => 8, "15" => 7, "20" => 7, "21" => 7, "23" => 7, "24" => 8, "30" => 7, "40" => 7, "41" => 7, "90" => 7];
                $shousuus[10] = 1;
                $toviews = $this->_makeMonthlyReport($to_midasi, $utiwake_kbn_retu, $rows, (int)$setdts['torihikiari_flg']);
            } else {
                // 商品別（取引無し含む）
                $where = " where bb.uriagebi between '{$kikanFrom}' and '{$kikanTo}' and aa.cd between '{$hanniFrom}' and '{$hanniTo}'";
                // 自入力のみの場合
                if ((int)$setdts["jinyuuryoku_flg"] === 1) {
                    $creator = $this->getDI()->getSession()->get('auth')['id'];
                    $where .= " and bb.sakusei_user_id = {$creator} ";
                }
                if ((int)$setdts["koujun_flg"] === 1) {
                    $order = " order by t.cd DESC ";
                } else {
                    $order = " order by t.cd ";
                }
                $phql = "
                    select 
                        um_kingaku, arari, t.cd as cd, t.name as name, um_utiwake_kbn_cd, zeigaku
                    from shouhin_mrs as t
                    left join (
                        select
                            sum(cc.zeinukigaku) as um_kingaku, 
                            sum(cc.zeinukigaku - cc.genkagaku) as arari, 
                            aa.cd as t_cd, aa.name as t_name,
                            cc.utiwake_kbn_cd as um_utiwake_kbn_cd,
                            sum(cc.zeigaku) as zeigaku
                        from shouhin_mrs as aa
                        left join uriage_meisai_dts as cc on aa.cd = cc.shouhin_mr_cd  
                        left join uriage_dts as bb on bb.id = cc.uriage_dt_id
                            {$where}
                            group by aa.cd, cc.utiwake_kbn_cd
                            order by aa.cd, cc.utiwake_kbn_cd
                        ) as sub on sub.t_cd = t.cd
                    {$order}
                ";
                $stmt = $db->prepare($phql);
                $stmt->execute();
                $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $to_midasi = ["商品コード", "商品名", "総売上額", "返品額", "返品率", "値引額", "値引率", "その他", "純売上額", "粗利益", "粗利率", "税込額"];
                $utiwake_kbn_retu = ["10" => 2, "11" => 3, "12" => 5, "13" => 7, "14" => 8, "15" => 7, "20" => 7, "21" => 7, "23" => 7, "24" => 8, "30" => 7, "40" => 7, "41" => 7, "90" => 7];
                $shousuus[10] = 1;
                $toviews = $this->_makeMonthlyReport($to_midasi, $utiwake_kbn_retu, $rows, (int)$setdts['torihikiari_flg']);
            }
        } else if (substr($setdts["junjo_kbn_cd"], -2) == "16") { // 担当順の場合
            if ((int)$setdts["torihikinasi_flg"] !== 1) {
                // 担当別（取引有りのみ）
                $where = " where u.uriagebi between '{$kikanFrom}' and '{$kikanTo}' and t.cd between '{$hanniFrom}' and '{$hanniTo}'";
                // 自入力のみの場合
                if ((int)$setdts["jinyuuryoku_flg"] === 1) {
                    $creator = $this->getDI()->getSession()->get('auth')['id'];
                    $where .= " and u.sakusei_user_id = {$creator} ";
                }
                if ((int)$setdts["koujun_flg"] === 1) {
                    $order = " order by t.cd DESC, um.utiwake_kbn_cd ";
                } else {
                    $order = " order by t.cd, um.utiwake_kbn_cd ";
                }
                $phql = "
                    select 
                       sum(um.zeinukigaku) as um_kingaku, sum(um.zeinukigaku - um.genkagaku) as arari, t.cd as cd, t.name as name, um.utiwake_kbn_cd as um_utiwake_kbn_cd,sum(um.zeigaku) as zeigaku
                    from tantou_mrs as t
                    left join uriage_dts as u on t.cd = u.tantou_mr_cd
                    left join uriage_meisai_dts as um on u.id = um.uriage_dt_id
                    {$where}
                    group by t.cd, um.utiwake_kbn_cd
                    {$order}
                ";
                $stmt = $db->prepare($phql);
                $stmt->execute();
                $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $to_midasi = ["担当コード", "担当名", "総売上額", "返品額", "返品率", "値引額", "値引率", "その他", "純売上額", "粗利益", "粗利率", "税込額"];
                $utiwake_kbn_retu = ["10" => 2, "11" => 3, "12" => 5, "13" => 7, "14" => 8, "15" => 7, "20" => 7, "21" => 7, "23" => 7, "24" => 8, "30" => 7, "40" => 7, "41" => 7, "90" => 7];
                $shousuus[10] = 1;
                $toviews = $this->_makeMonthlyReport($to_midasi, $utiwake_kbn_retu, $rows, (int)$setdts['torihikiari_flg']);
            } else {
                // 担当別（取引無し含む）
                $where = " where bb.uriagebi between '{$kikanFrom}' and '{$kikanTo}' and aa.cd between '{$hanniFrom}' and '{$hanniTo}'";
                // 自入力のみの場合
                if ((int)$setdts["jinyuuryoku_flg"] === 1) {
                    $creator = $this->getDI()->getSession()->get('auth')['id'];
                    $where .= " and bb.sakusei_user_id = {$creator} ";
                }
                if ((int)$setdts["koujun_flg"] === 1) {
                    $order = " order by t.cd DESC ";
                } else {
                    $order = " order by t.cd ";
                }
                $phql = "
                    select 
                        um_kingaku, arari, t.cd as cd, t.name as name, um_utiwake_kbn_cd, zeigaku
                    from tantou_mrs as t
                    left join (
                        select
                            sum(cc.zeinukigaku) as um_kingaku, 
                            sum(cc.zeinukigaku - cc.genkagaku) as arari, 
                            aa.cd as t_cd, aa.name as t_name,
                            cc.utiwake_kbn_cd as um_utiwake_kbn_cd,
                            sum(cc.zeigaku) as zeigaku
                        from tantou_mrs as aa
                        left join uriage_dts as bb on aa.cd = bb.tantou_mr_cd  
                        left join uriage_meisai_dts as cc on bb.id = cc.uriage_dt_id
                            {$where}
                            group by aa.cd, cc.utiwake_kbn_cd
                            order by aa.cd, cc.utiwake_kbn_cd
                        ) as sub on sub.t_cd = t.cd
                    {$order}
                ";
                $stmt = $db->prepare($phql);
                $stmt->execute();
                $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $to_midasi = ["担当コード", "担当名", "総売上額", "返品額", "返品率", "値引額", "値引率", "その他", "純売上額", "粗利益", "粗利率", "税込額"];
                $utiwake_kbn_retu = ["10" => 2, "11" => 3, "12" => 5, "13" => 7, "14" => 8, "15" => 7, "20" => 7, "21" => 7, "23" => 7, "24" => 8, "30" => 7, "40" => 7, "41" => 7, "90" => 7];
                $shousuus[10] = 1;
                $toviews = $this->_makeMonthlyReport($to_midasi, $utiwake_kbn_retu, $rows, (int)$setdts['torihikiari_flg']);
            }
        }

        $jouken_uriage_geppous = JoukenUriageGeppous::find(["order" => "cd, sakusei_user_id"
            , "conditions" => "sakusei_user_id IN(0, ?0)"
            , "bind" => [0 => $this->getDI()->getSession()->get('auth')['id']]]);
        $joukens = [];
        foreach ($jouken_uriage_geppous as $jouken_uriage_geppou) {
            $joukens[$jouken_uriage_geppou->cd] = $jouken_uriage_geppou->name;
        }
        $this->view->joukens = $joukens;
        $this->view->to_midasi = $to_midasi;
        $this->view->toviews = $toviews;
        $this->view->shousuus = $shousuus;

        return;
    }

    /**
     * 売上月報View表示様配列を作成
     *
     * @param array $to_midasi
     * @param array $utiwake_kbn_retu
     * @param array $rows
     * @param int $torihikiariFlg
     * @return array $toViews;
     */
    private function _makeMonthlyReport(array $to_midasi, array $utiwake_kbn_retu, array $rows, int $torihikiariFlg)
    {
//        echo '<pre>';
//        var_dump($rows);
//        echo '</pre>';
        $zeigaku = 0;
        $toviews = []; // 返却用配列
        $toviews[0][0] = "　";
        $toviews[0][1] = "《総合計》";
        for ($i = 2; $i < count($to_midasi); $i++) {
            $toviews[0][$i] = 0;
        }
        $i = 0;
        foreach ($rows as $rw) {
            if ($rw['cd'] != $toviews[$i][0]) {
                $toviews[$i][8] = $toviews[$i][2] + $toviews[$i][3] + $toviews[$i][5] + $toviews[$i][7]; // 純売上額
                $toviews[$i][11] = $toviews[$i][8] + $zeigaku; // 税込
                if ($toviews[$i][2] != 0) {
                    $toviews[$i][4] = round(-100 * $toviews[$i][3] / $toviews[$i][2], 1); // 返品率
                    $toviews[$i][6] = round(-100 * $toviews[$i][5] / $toviews[$i][2], 1); // 値引率
                }
                if ($toviews[$i][8] != 0) {
                    $toviews[$i][10] = round(100 * $toviews[$i][9] / $toviews[$i][8], 1); // 粗利率
                }
                if ($torihikiariFlg === 0
                    && $toviews[$i][2] == 0
                    && $toviews[$i][3] == 0
                    && $toviews[$i][5] == 0
                    && $toviews[$i][7] == 0
                    && $toviews[$i][9] == 0) { // 取引有を除くならこの行を潰す
                } else {
                    $i++;
                }
                $toviews[$i][0] = $rw['cd']; // コード
                $toviews[$i][1] = $rw['name']; // 名
                $toviews[$i][2] = 0; // 総売上額
                $toviews[$i][3] = 0; // 返品額
                $toviews[$i][4] = 0; // 返品率
                $toviews[$i][5] = 0; // 値引額
                $toviews[$i][6] = 0; // 値引率
                $toviews[$i][7] = 0; // その他
                $toviews[$i][8] = 0; // 純売上額
                $toviews[$i][9] = 0; // 粗利益
                $toviews[$i][10] = 0; // 粗利率
                $toviews[$i][11] = 0; // 税込仕入額
                $zeigaku = 0;
            }
            if ($rw['um_utiwake_kbn_cd']) {
                $toviews[$i][$utiwake_kbn_retu[$rw['um_utiwake_kbn_cd']]] += $rw['um_kingaku'];
                if ($torihikiariFlg !== 0) { // 取引有を除くなら加算しない
                    $toviews[0][$utiwake_kbn_retu[$rw['um_utiwake_kbn_cd']]] += $rw['um_kingaku'];
                }
            }
            $toviews[$i][9] += $rw['arari'];
            $zeigaku += $rw['zeigaku'];
            if ($torihikiariFlg !== 0) { // 取引有を除くなら加算しない
                $toviews[0][9] += $rw['arari'];
            }
        }
        $toviews[$i][8] = $toviews[$i][2] + $toviews[$i][3] + $toviews[$i][5] + $toviews[$i][7]; // 純売上額
        $toviews[$i][11] = $toviews[$i][8] + $zeigaku;
        if ($toviews[$i][2] != 0) { // 最終行
            $toviews[$i][4] = round(-100 * $toviews[$i][3] / $toviews[$i][2], 1); // 返品率
            $toviews[$i][6] = round(-100 * $toviews[$i][5] / $toviews[$i][2], 1); // 値引率
        }
        if ($toviews[$i][8] != 0) { // 最終行
            $toviews[$i][10] = round(100 * $toviews[$i][9] / $toviews[$i][8], 1); // 粗利率
        }
        if ($toviews[0][2] != 0) { // 合計行
            $toviews[0][4] = round(-100 * $toviews[0][3] / $toviews[0][2], 1); // 返品率
            $toviews[0][6] = round(-100 * $toviews[0][5] / $toviews[0][2], 1); // 値引率
            $toviews[0][8] = $toviews[0][2] + $toviews[0][3] + $toviews[0][5] + $toviews[0][7]; // 純売上額
            $toviews[0][11] = $toviews[0][8] + array_sum(array_column($rows, 'zeigaku'));
        }
        if ($toviews[0][8] != 0) { // 合計行
            $toviews[0][10] = round(100 * $toviews[0][9] / $toviews[0][8], 1); // 粗利率
        }

        return $toviews;
    }


    /*
     * 売上推移表
    */
    public
    function suiiAction()
    {
        $db = \Phalcon\DI::getDefault()->get('db');
        $post_flds = [
            "cd",
            "hyouji_kbn",
            "junjo_kbn_cd",
            "koujun_flg",
            "zennen_flg",
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
        ];
        $setdts = [];
        $thisPost = [];
        if (!$this->request->isPost()) {
            foreach ($post_flds as $post_fld) {
                $setdts[$post_fld] = "";
            }
            $setdts["cd"] = "01";
            $setdts["hyouji_kbn"] = '0';
            $setdts["junjo_kbn_cd"] = "1602"; // 得意先
            $setdts["koujun_flg"] = 0;
            $setdts["zennen_flg"] = '0';
            $setdts["kikan_sitei_kbn_cd"] = "";
            $setdts["zeikomi_flg"] = 0;
            $setdts["meisaigyou_flg"] = 1;
            $setdts["goukeigyou_flg"] = 0;
            $setdts["jinyuuryoku_flg"] = 0;
            $setdts["torihikiari_flg"] = 1;
            $setdts["torihikinasi_flg"] = 0;
            $setdts["hokakei_flg"] = 0;
            $setdts['hanni_from'] = TokuisakiMrs::minimum(["column" => "cd",]);
            $setdts['hanni_to'] = TokuisakiMrs::maximum(["column" => "cd",]);
            $konnnend = Konnnenndo::findFirst('touki_flg = 1');
            $setdts["kikan_from"] = $konnnend->kikan_from;
            $setdts["kikan_to"] = $konnnend->kikan_to;
        } else {
            foreach ($post_flds as $post_fld) {
                $setdts[$post_fld] = array_key_exists($post_fld, $thisPost) ? $thisPost[$post_fld] : $this->request->getPost($post_fld);
            }
        }
        list($year, $month, $day) = explode('-', $setdts["kikan_from"]);
        $junjo_kbn = JunjoKbns::findFirst(["conditions" => "cd = ?1", "bind" => ["1" => $setdts["junjo_kbn_cd"]]]);
        foreach ($setdts as $fld => $setdt) {
            $this->tag->setDefault($fld, $setdt);
        }
        $select = "SELECT ";
        $from = " FROM uriage_meisai_dts AS a
                RIGHT JOIN uriage_dts AS b ON b.id = a.uriage_dt_id
                RIGHT JOIN tokuisaki_mrs AS c ON c.cd = b.tokuisaki_mr_cd
                RIGHT JOIN shouhin_mrs AS d ON d.cd = a.shouhin_mr_cd
                RIGHT JOIN tantou_mrs AS e ON e.cd = b.tantou_mr_cd";
        $where = " WHERE ";
        $group = " GROUP BY ";
        $order = "";
        switch ($setdts["junjo_kbn_cd"]) {
            case '1601':    //年度別
                $select .= "b.nendo AS 'key',null AS 'key_name',";
                $group .= "b.nendo";
                $where = '';
                break;
            case '1602':    //得意先別
                $select .= "b.tokuisaki_mr_cd AS 'key',c.name AS 'key_name',";
                $group .= "b.tokuisaki_mr_cd,c.name";
                $where .= "b.tokuisaki_mr_cd BETWEEN '" . $setdts['hanni_from'] . "' AND '" . $setdts['hanni_to'] . "'";
                if ($setdts['koujun_flg'] === '1') {
                    $order = " ORDER BY b.tokuisaki_mr_cd DESC";
                } else {
                    $order = " ORDER BY b.tokuisaki_mr_cd ASC";
                }
                break;
            case '1609':    //請求先
                $select .= "c.seikyuusaki_mr_cd AS 'key',c.name AS 'key_name',";
                $group .= "c.seikyuusaki_mr_cd,c.name";
                $where .= "c.seikyuusaki_mr_cd BETWEEN '" . $setdts['hanni_from'] . "' AND '" . $setdts['hanni_to'] . "'";
                if ($setdts['koujun_flg'] === '1') {
                    $order = " ORDER BY c.seikyuusaki_mr_cd DESC";
                } else {
                    $order = " ORDER BY c.seikyuusaki_mr_cd ASC";
                }
                break;
            case '1610':    //商品別
                $select .= "a.shouhin_mr_cd AS 'key',d.name AS 'key_name',";
                $group .= "a.shouhin_mr_cd,d.name";
                $where .= "a.shouhin_mr_cd BETWEEN '" . $setdts['hanni_from'] . "' AND '" . $setdts['hanni_to'] . "'";
                if ($setdts['koujun_flg'] === '1') {
                    $order = " ORDER BY a.shouhin_mr_cd DESC";
                } else {
                    $order = " ORDER BY a.shouhin_mr_cd ASC";
                }
                break;
            case '1616':    //担当者別
                $select .= "b.tantou_mr_cd AS 'key',e.name AS 'key_name',";
                $group .= "b.tantou_mr_cd,e.name";
                $where .= "b.tantou_mr_cd BETWEEN '" . $setdts['hanni_from'] . "' AND '" . $setdts['hanni_to'] . "'";
                if ($setdts['koujun_flg'] === '1') {
                    $order = " ORDER BY b.tantou_mr_cd DESC";
                } else {
                    $order = " ORDER BY b.tantou_mr_cd ASC";
                }
                break;
        }

        switch ($setdts['hyouji_kbn']) {
            case '0':   //順売上金額
                $select .= "
                    SUM(if (date_format(b.uriagebi, '%Y%m')='" . $year . sprintf('%02d', $month) . "', a.kingaku, 0)) AS '1',
                    SUM(if (date_format(b.uriagebi, '%Y%m')='" . (((int)$month + 1 > 12) ? ((int)$year + 1) : $year) . sprintf('%02d', (((int)$month + 1 > 12) ? ((int)$month + 1 - 12) : ((int)$month + 1))) . "', a.kingaku, 0)) AS '2',
                    SUM(if (date_format(b.uriagebi, '%Y%m')='" . (((int)$month + 2 > 12) ? ((int)$year + 1) : $year) . sprintf('%02d', (((int)$month + 2 > 12) ? ((int)$month + 2 - 12) : ((int)$month + 2))) . "', a.kingaku, 0)) AS '3',
                    SUM(if (date_format(b.uriagebi, '%Y%m')='" . (((int)$month + 3 > 12) ? ((int)$year + 1) : $year) . sprintf('%02d', (((int)$month + 3 > 12) ? ((int)$month + 3 - 12) : ((int)$month + 3))) . "', a.kingaku, 0)) AS '4',
                    SUM(if (date_format(b.uriagebi, '%Y%m')='" . (((int)$month + 4 > 12) ? ((int)$year + 1) : $year) . sprintf('%02d', (((int)$month + 4 > 12) ? ((int)$month + 4 - 12) : ((int)$month + 4))) . "', a.kingaku, 0)) AS '5',
                    SUM(if (date_format(b.uriagebi, '%Y%m')='" . (((int)$month + 5 > 12) ? ((int)$year + 1) : $year) . sprintf('%02d', (((int)$month + 5 > 12) ? ((int)$month + 5 - 12) : ((int)$month + 5))) . "', a.kingaku, 0)) AS '6',
                    SUM(if (date_format(b.uriagebi, '%Y%m')='" . (((int)$month + 6 > 12) ? ((int)$year + 1) : $year) . sprintf('%02d', (((int)$month + 6 > 12) ? ((int)$month + 6 - 12) : ((int)$month + 6))) . "', a.kingaku, 0)) AS '7',
                    SUM(if (date_format(b.uriagebi, '%Y%m')='" . (((int)$month + 7 > 12) ? ((int)$year + 1) : $year) . sprintf('%02d', (((int)$month + 7 > 12) ? ((int)$month + 7 - 12) : ((int)$month + 7))) . "', a.kingaku, 0)) AS '8',
                    SUM(if (date_format(b.uriagebi, '%Y%m')='" . (((int)$month + 8 > 12) ? ((int)$year + 1) : $year) . sprintf('%02d', (((int)$month + 8 > 12) ? ((int)$month + 8 - 12) : ((int)$month + 8))) . "', a.kingaku, 0)) AS '9',
                    SUM(if (date_format(b.uriagebi, '%Y%m')='" . (((int)$month + 9 > 12) ? ((int)$year + 1) : $year) . sprintf('%02d', (((int)$month + 9 > 12) ? ((int)$month + 9 - 12) : ((int)$month + 9))) . "', a.kingaku, 0)) AS '10',
                    SUM(if (date_format(b.uriagebi, '%Y%m')='" . (((int)$month + 10 > 12) ? ((int)$year + 1) : $year) . sprintf('%02d', (((int)$month + 10 > 12) ? ((int)$month + 10 - 12) : ((int)$month + 11))) . "', a.kingaku, 0)) AS '11',
                    SUM(if (date_format(b.uriagebi, '%Y%m')='" . (((int)$month + 11 > 12) ? ((int)$year + 1) : $year) . sprintf('%02d', (((int)$month + 11 > 12) ? ((int)$month + 11 - 12) : ((int)$month + 11))) . "', a.kingaku, 0)) AS '12'
                ";
                break;
            case '1':   //粗利益
                $select .= "
                    SUM(if (date_format(b.uriagebi, '%Y%m')='" . $year . sprintf('%02d', $month) . "', a.zeinukigaku, 0)) - SUM(if (date_format(b.uriagebi, '%Y%m')='" . $year . sprintf('%02d', $month) . "', a.genkagaku, 0)) AS '1',
                    SUM(if (date_format(b.uriagebi, '%Y%m')='" . (((int)$month + 1 > 12) ? ((int)$year + 1) : $year) . sprintf('%02d', (((int)$month + 1 > 12) ? ((int)$month + 1 - 12) : ((int)$month + 1))) . "', a.zeinukigaku, 0)) - SUM(if (date_format(b.uriagebi, '%Y%m')='" . (((int)$month + 1 > 12) ? ((int)$year + 1) : $year) . sprintf('%02d', (((int)$month + 1 > 12) ? ((int)$month + 1 - 12) : ((int)$month + 1))) . "', a.genkagaku, 0)) AS  '2',
                    SUM(if (date_format(b.uriagebi, '%Y%m')='" . (((int)$month + 2 > 12) ? ((int)$year + 1) : $year) . sprintf('%02d', (((int)$month + 2 > 12) ? ((int)$month + 2 - 12) : ((int)$month + 2))) . "', a.zeinukigaku, 0)) - SUM(if (date_format(b.uriagebi, '%Y%m')='" . (((int)$month + 2 > 12) ? ((int)$year + 1) : $year) . sprintf('%02d', (((int)$month + 2 > 12) ? ((int)$month + 2 - 12) : ((int)$month + 2))) . "', a.genkagaku, 0)) AS  '3',
                    SUM(if (date_format(b.uriagebi, '%Y%m')='" . (((int)$month + 3 > 12) ? ((int)$year + 1) : $year) . sprintf('%02d', (((int)$month + 3 > 12) ? ((int)$month + 3 - 12) : ((int)$month + 3))) . "', a.zeinukigaku, 0)) - SUM(if (date_format(b.uriagebi, '%Y%m')='" . (((int)$month + 3 > 12) ? ((int)$year + 1) : $year) . sprintf('%02d', (((int)$month + 3 > 12) ? ((int)$month + 3 - 12) : ((int)$month + 3))) . "', a.genkagaku, 0)) AS  '4',
                    SUM(if (date_format(b.uriagebi, '%Y%m')='" . (((int)$month + 4 > 12) ? ((int)$year + 1) : $year) . sprintf('%02d', (((int)$month + 4 > 12) ? ((int)$month + 4 - 12) : ((int)$month + 4))) . "', a.zeinukigaku, 0)) - SUM(if (date_format(b.uriagebi, '%Y%m')='" . (((int)$month + 4 > 12) ? ((int)$year + 1) : $year) . sprintf('%02d', (((int)$month + 4 > 12) ? ((int)$month + 4 - 12) : ((int)$month + 4))) . "', a.genkagaku, 0)) AS  '5',
                    SUM(if (date_format(b.uriagebi, '%Y%m')='" . (((int)$month + 5 > 12) ? ((int)$year + 1) : $year) . sprintf('%02d', (((int)$month + 5 > 12) ? ((int)$month + 5 - 12) : ((int)$month + 5))) . "', a.zeinukigaku, 0)) - SUM(if (date_format(b.uriagebi, '%Y%m')='" . (((int)$month + 5 > 12) ? ((int)$year + 1) : $year) . sprintf('%02d', (((int)$month + 5 > 12) ? ((int)$month + 5 - 12) : ((int)$month + 5))) . "', a.genkagaku, 0)) AS  '6',
                    SUM(if (date_format(b.uriagebi, '%Y%m')='" . (((int)$month + 6 > 12) ? ((int)$year + 1) : $year) . sprintf('%02d', (((int)$month + 6 > 12) ? ((int)$month + 6 - 12) : ((int)$month + 6))) . "', a.zeinukigaku, 0)) - SUM(if (date_format(b.uriagebi, '%Y%m')='" . (((int)$month + 6 > 12) ? ((int)$year + 1) : $year) . sprintf('%02d', (((int)$month + 6 > 12) ? ((int)$month + 6 - 12) : ((int)$month + 6))) . "', a.genkagaku, 0)) AS  '7',
                    SUM(if (date_format(b.uriagebi, '%Y%m')='" . (((int)$month + 7 > 12) ? ((int)$year + 1) : $year) . sprintf('%02d', (((int)$month + 7 > 12) ? ((int)$month + 7 - 12) : ((int)$month + 7))) . "', a.zeinukigaku, 0)) - SUM(if (date_format(b.uriagebi, '%Y%m')='" . (((int)$month + 7 > 12) ? ((int)$year + 1) : $year) . sprintf('%02d', (((int)$month + 7 > 12) ? ((int)$month + 7 - 12) : ((int)$month + 7))) . "', a.genkagaku, 0)) AS  '8',
                    SUM(if (date_format(b.uriagebi, '%Y%m')='" . (((int)$month + 8 > 12) ? ((int)$year + 1) : $year) . sprintf('%02d', (((int)$month + 8 > 12) ? ((int)$month + 8 - 12) : ((int)$month + 8))) . "', a.zeinukigaku, 0)) - SUM(if (date_format(b.uriagebi, '%Y%m')='" . (((int)$month + 8 > 12) ? ((int)$year + 1) : $year) . sprintf('%02d', (((int)$month + 8 > 12) ? ((int)$month + 8 - 12) : ((int)$month + 8))) . "', a.genkagaku, 0)) AS  '9',
                    SUM(if (date_format(b.uriagebi, '%Y%m')='" . (((int)$month + 9 > 12) ? ((int)$year + 1) : $year) . sprintf('%02d', (((int)$month + 9 > 12) ? ((int)$month + 9 - 12) : ((int)$month + 9))) . "', a.zeinukigaku, 0)) - SUM(if (date_format(b.uriagebi, '%Y%m')='" . (((int)$month + 9 > 12) ? ((int)$year + 1) : $year) . sprintf('%02d', (((int)$month + 9 > 12) ? ((int)$month + 9 - 12) : ((int)$month + 9))) . "', a.genkagaku, 0)) AS  '10',
                    SUM(if (date_format(b.uriagebi, '%Y%m')='" . (((int)$month + 10 > 12) ? ((int)$year + 1) : $year) . sprintf('%02d', (((int)$month + 10 > 12) ? ((int)$month + 10 - 12) : ((int)$month + 10))) . "', a.zeinukigaku, 0)) - SUM(if (date_format(b.uriagebi, '%Y%m')='" . (((int)$month + 10 > 12) ? ((int)$year + 1) : $year) . sprintf('%02d', (((int)$month + 10 > 12) ? ((int)$month + 10 - 12) : ((int)$month + 10))) . "', a.genkagaku, 0)) AS  '11',
                    SUM(if (date_format(b.uriagebi, '%Y%m')='" . (((int)$month + 11 > 12) ? ((int)$year + 1) : $year) . sprintf('%02d', (((int)$month + 11 > 12) ? ((int)$month + 11 - 12) : ((int)$month + 11))) . "', a.zeinukigaku, 0)) - SUM(if (date_format(b.uriagebi, '%Y%m')='" . (((int)$month + 11 > 12) ? ((int)$year + 1) : $year) . sprintf('%02d', (((int)$month + 11 > 12) ? ((int)$month + 11 - 12) : ((int)$month + 11))) . "', a.genkagaku, 0)) AS  '12'
                ";
                break;
            case '2':   //販売数
                $select .= "
                    SUM(if (date_format(b.uriagebi, '%Y%m')='" . $year . sprintf('%02d', $month) . "', a.suuryou, 0)) AS '1',
                    SUM(if (date_format(b.uriagebi, '%Y%m')='" . (((int)$month + 1 > 12) ? ((int)$year + 1) : $year) . sprintf('%02d', (((int)$month + 1 > 12) ? ((int)$month + 1 - 12) : ((int)$month + 1))) . "', a.suuryou, 0)) AS '2',
                    SUM(if (date_format(b.uriagebi, '%Y%m')='" . (((int)$month + 2 > 12) ? ((int)$year + 1) : $year) . sprintf('%02d', (((int)$month + 2 > 12) ? ((int)$month + 2 - 12) : ((int)$month + 2))) . "', a.suuryou, 0)) AS '3',
                    SUM(if (date_format(b.uriagebi, '%Y%m')='" . (((int)$month + 3 > 12) ? ((int)$year + 1) : $year) . sprintf('%02d', (((int)$month + 3 > 12) ? ((int)$month + 3 - 12) : ((int)$month + 3))) . "', a.suuryou, 0)) AS '4',
                    SUM(if (date_format(b.uriagebi, '%Y%m')='" . (((int)$month + 4 > 12) ? ((int)$year + 1) : $year) . sprintf('%02d', (((int)$month + 4 > 12) ? ((int)$month + 4 - 12) : ((int)$month + 4))) . "', a.suuryou, 0)) AS '5',
                    SUM(if (date_format(b.uriagebi, '%Y%m')='" . (((int)$month + 5 > 12) ? ((int)$year + 1) : $year) . sprintf('%02d', (((int)$month + 5 > 12) ? ((int)$month + 5 - 12) : ((int)$month + 5))) . "', a.suuryou, 0)) AS '6',
                    SUM(if (date_format(b.uriagebi, '%Y%m')='" . (((int)$month + 6 > 12) ? ((int)$year + 1) : $year) . sprintf('%02d', (((int)$month + 6 > 12) ? ((int)$month + 6 - 12) : ((int)$month + 6))) . "', a.suuryou, 0)) AS '7',
                    SUM(if (date_format(b.uriagebi, '%Y%m')='" . (((int)$month + 7 > 12) ? ((int)$year + 1) : $year) . sprintf('%02d', (((int)$month + 7 > 12) ? ((int)$month + 7 - 12) : ((int)$month + 7))) . "', a.suuryou, 0)) AS '8',
                    SUM(if (date_format(b.uriagebi, '%Y%m')='" . (((int)$month + 8 > 12) ? ((int)$year + 1) : $year) . sprintf('%02d', (((int)$month + 8 > 12) ? ((int)$month + 8 - 12) : ((int)$month + 8))) . "', a.suuryou, 0)) AS '9',
                    SUM(if (date_format(b.uriagebi, '%Y%m')='" . (((int)$month + 9 > 12) ? ((int)$year + 1) : $year) . sprintf('%02d', (((int)$month + 9 > 12) ? ((int)$month + 9 - 12) : ((int)$month + 9))) . "', a.suuryou, 0)) AS '10',
                    SUM(if (date_format(b.uriagebi, '%Y%m')='" . (((int)$month + 10 > 12) ? ((int)$year + 1) : $year) . sprintf('%02d', (((int)$month + 10 > 12) ? ((int)$month + 10 - 12) : ((int)$month + 10))) . "', a.suuryou, 0)) AS '11',
                    SUM(if (date_format(b.uriagebi, '%Y%m')='" . (((int)$month + 11 > 12) ? ((int)$year + 1) : $year) . sprintf('%02d', (((int)$month + 11 > 12) ? ((int)$month + 11 - 12) : ((int)$month + 11))) . "', a.suuryou, 0)) AS '12'
                ";
                break;
            case '3':   //販売量
                $select .= "
                    SUM(if (date_format(b.uriagebi, '%Y%m')='" . $year . sprintf('%02d', $month) . "', a.suuryou, 0)) AS '1',
                    SUM(if (date_format(b.uriagebi, '%Y%m')='" . (((int)$month + 1 > 12) ? ((int)$year + 1) : $year) . sprintf('%02d', (((int)$month + 1 > 12) ? ((int)$month + 1 - 12) : ((int)$month + 1))) . "', a.suuryou2, 0)) AS '2',
                    SUM(if (date_format(b.uriagebi, '%Y%m')='" . (((int)$month + 2 > 12) ? ((int)$year + 1) : $year) . sprintf('%02d', (((int)$month + 2 > 12) ? ((int)$month + 2 - 12) : ((int)$month + 2))) . "', a.suuryou2, 0)) AS '3',
                    SUM(if (date_format(b.uriagebi, '%Y%m')='" . (((int)$month + 3 > 12) ? ((int)$year + 1) : $year) . sprintf('%02d', (((int)$month + 3 > 12) ? ((int)$month + 3 - 12) : ((int)$month + 3))) . "', a.suuryou2, 0)) AS '4',
                    SUM(if (date_format(b.uriagebi, '%Y%m')='" . (((int)$month + 4 > 12) ? ((int)$year + 1) : $year) . sprintf('%02d', (((int)$month + 4 > 12) ? ((int)$month + 4 - 12) : ((int)$month + 4))) . "', a.suuryou2, 0)) AS '5',
                    SUM(if (date_format(b.uriagebi, '%Y%m')='" . (((int)$month + 5 > 12) ? ((int)$year + 1) : $year) . sprintf('%02d', (((int)$month + 5 > 12) ? ((int)$month + 5 - 12) : ((int)$month + 5))) . "', a.suuryou2, 0)) AS '6',
                    SUM(if (date_format(b.uriagebi, '%Y%m')='" . (((int)$month + 6 > 12) ? ((int)$year + 1) : $year) . sprintf('%02d', (((int)$month + 6 > 12) ? ((int)$month + 6 - 12) : ((int)$month + 6))) . "', a.suuryou2, 0)) AS '7',
                    SUM(if (date_format(b.uriagebi, '%Y%m')='" . (((int)$month + 7 > 12) ? ((int)$year + 1) : $year) . sprintf('%02d', (((int)$month + 7 > 12) ? ((int)$month + 7 - 12) : ((int)$month + 7))) . "', a.suuryou2, 0)) AS '8',
                    SUM(if (date_format(b.uriagebi, '%Y%m')='" . (((int)$month + 8 > 12) ? ((int)$year + 1) : $year) . sprintf('%02d', (((int)$month + 8 > 12) ? ((int)$month + 8 - 12) : ((int)$month + 8))) . "', a.suuryou2, 0)) AS '9',
                    SUM(if (date_format(b.uriagebi, '%Y%m')='" . (((int)$month + 9 > 12) ? ((int)$year + 1) : $year) . sprintf('%02d', (((int)$month + 9 > 12) ? ((int)$month + 9 - 12) : ((int)$month + 9))) . "', a.suuryou2, 0)) AS '10',
                    SUM(if (date_format(b.uriagebi, '%Y%m')='" . (((int)$month + 10 > 12) ? ((int)$year + 1) : $year) . sprintf('%02d', (((int)$month + 10 > 12) ? ((int)$month + 10 - 12) : ((int)$month + 10))) . "', a.suuryou2, 0)) AS '11',
                    SUM(if (date_format(b.uriagebi, '%Y%m')='" . (((int)$month + 11 > 12) ? ((int)$year + 1) : $year) . sprintf('%02d', (((int)$month + 11 > 12) ? ((int)$month + 11 - 12) : ((int)$month + 11))) . "', a.suuryou2, 0)) AS '12'
                ";
                break;
        }

        $stmt = $db->prepare($select . $from . $where . $group . $order);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($setdts['zennen_flg'] === '1') {
            $union_year = (int)$year - 1;
            $union_select = str_replace((int)$year + 1, (int)$union_year + 1, $select);
            $tmp = $year . $month;
            // 12月が前年とダブるので暫定処置
            $union_select = preg_replace("/$tmp/", $union_year . $month, $union_select, 1);
            $tmp = $year . (int)$month + 1;
            $union_select = preg_replace("/$tmp/", $union_year . (int)$month + 1, $union_select, 1);

            $stmt = $db->prepare($union_select . $from . $where . $group . $order);

            $stmt->execute();
            $union_rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            //前年・当年の月小計
            $zennen_kei = ['1' => 0, '2' => 0, '3' => 0, '4' => 0, '5' => 0, '6' => 0, '7' => 0, '8' => 0, '9' => 0, '10' => 0, '11' => 0, '12' => 0,];
            $tounen_kei = ['1' => 0, '2' => 0, '3' => 0, '4' => 0, '5' => 0, '6' => 0, '7' => 0, '8' => 0, '9' => 0, '10' => 0, '11' => 0, '12' => 0,];
            $wariai = ['1' => 0, '2' => 0, '3' => 0, '4' => 0, '5' => 0, '6' => 0, '7' => 0, '8' => 0, '9' => 0, '10' => 0, '11' => 0, '12' => 0,];
            for ($i = 0; $i < count($rows); $i++) {
                $tounen_kei['1'] += (int)$rows[$i]['1'];
                $tounen_kei['2'] += (int)$rows[$i]['2'];
                $tounen_kei['3'] += (int)$rows[$i]['3'];
                $tounen_kei['4'] += (int)$rows[$i]['4'];
                $tounen_kei['5'] += (int)$rows[$i]['5'];
                $tounen_kei['6'] += (int)$rows[$i]['6'];
                $tounen_kei['7'] += (int)$rows[$i]['7'];
                $tounen_kei['8'] += (int)$rows[$i]['8'];
                $tounen_kei['9'] += (int)$rows[$i]['9'];
                $tounen_kei['10'] += (int)$rows[$i]['10'];
                $tounen_kei['11'] += (int)$rows[$i]['11'];
                $tounen_kei['12'] += (int)$rows[$i]['12'];
            }
            for ($i = 0; $i < count($union_rows); $i++) {
                $zennen_kei['1'] += (int)$union_rows[$i]['1'];
                $zennen_kei['2'] += (int)$union_rows[$i]['2'];
                $zennen_kei['3'] += (int)$union_rows[$i]['3'];
                $zennen_kei['4'] += (int)$union_rows[$i]['4'];
                $zennen_kei['5'] += (int)$union_rows[$i]['5'];
                $zennen_kei['6'] += (int)$union_rows[$i]['6'];
                $zennen_kei['7'] += (int)$union_rows[$i]['7'];
                $zennen_kei['8'] += (int)$union_rows[$i]['8'];
                $zennen_kei['9'] += (int)$union_rows[$i]['9'];
                $zennen_kei['10'] += (int)$union_rows[$i]['10'];
                $zennen_kei['11'] += (int)$union_rows[$i]['11'];
                $zennen_kei['12'] += (int)$union_rows[$i]['12'];
            }
            for ($i = 1; $i <= 12; $i++) {
                try {
                    $wariai[(string)$i] = round($tounen_kei[(int)$i] / $zennen_kei[(int)$i] * 100, 1);
                } catch (Exception $e) {
                    $wariai[(string)$i] = 0.0;
                }
            }
//            $data = [];
            $buff = []; // 割合月の配列
            $row = 0;
            for ($i = 0; $i < count($rows); $i++) {
                for ($j = 0; $j < count($union_rows); $j++) {
                    if ($rows[$i]['key'] === $union_rows[$j]['key']) {
//                        $data[$row] = $rows[$i];
                        $buff[$row] = $rows[$i];
                        $row++;
//                        $data[$row] = $union_rows[$j];
                        $buff[$row] = $union_rows[$j];
                        $row++;
                        // 割当計算
                        $buff[$row]['key'] = $rows[$i]['key'] . '_hiritu';
                        $buff[$row]['key_name'] = $rows[$i]['key_name'];
                        for ($c = 1; $c <= 12; $c++) {
                            if ((int)$rows[$i][(string)$c] !== 0 && (int) $union_rows[$j][(string)$c] !== 0) {
                                $buff[$row][(string)$c] = round(((int)$rows[$i][(string)$c] / (int)$union_rows[$j][(string)$c] * 100), 1);
                            } else {
                                $buff[$row][(string)$c] = 0.0;
                            }
                        }
                        $row++;
                        break;
                    }
                }
            }
//            $rows = $data;

            $this->view->tounen_kei = $tounen_kei;
            $this->view->zennen_kei = $zennen_kei;
            $this->view->wariai = $wariai;
            $this->view->buff = $buff;
        }

        $this->view->month = $month;
        $this->view->rows = $rows;
        $this->view->setdts = $setdts;

        $jouken_uriage_suiiss = JoukenUriageSuiiss::find(["order" => "cd, sakusei_user_id"
            , "conditions" => "sakusei_user_id IN(0, ?0)"
            , "bind" => [0 => $this->getDI()->getSession()->get('auth')['id']]
        ]);
        $joukens = [];
        foreach ($jouken_uriage_suiiss as $jouken_uriage_suii) {
            $joukens[$jouken_uriage_suii->cd] = $jouken_uriage_suii->name;
        }
        $this->view->joukens = $joukens;
        return;
    }

    /**
     * 売上順位表
     *
     * @return void
     */
    public
    function juniAction()
    {
        $db = \Phalcon\DI::getDefault()->get('db');
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
            "zennen_flg"
        ];
        $setdts = [];
        $thisPost = [];
        $select = "SELECT ";
        $union_select = "
                UNION ALL SELECT '総計','',
                SUM(z.kingaku) as soukei,
                SUM(z.zeinukigaku) - SUM(z.genkagaku) AS sou_arari,
                IF(z.utiwake_kbn_cd = '15',SUM(z.kingaku),0) AS sou_henpin,
                IF(z.utiwake_kbn_cd = '12',SUM(z.kingaku),0) AS sou_nebiki
                FROM uriage_meisai_dts AS z
                RIGHT JOIN uriage_dts AS zz ON zz.id = z.uriage_dt_id
                RIGHT JOIN shouhin_mrs AS xx ON xx.cd = z.shouhin_mr_cd
                RIGHT JOIN tokuisaki_mrs AS yy ON yy.cd = zz.tokuisaki_mr_cd
                RIGHT JOIN tantou_mrs AS ww ON ww.cd = zz.tantou_mr_cd
                ";
        $from = " FROM uriage_dts AS a
                  RIGHT JOIN uriage_meisai_dts AS b ON b.uriage_dt_id = a.id
                  RIGHT JOIN shouhin_mrs AS c ON c.cd = b.shouhin_mr_cd
                  RIGHT JOIN tokuisaki_mrs AS d ON d.cd = a.tokuisaki_mr_cd
                  RIGHT JOIN tantou_mrs AS e ON e.cd = a.tantou_mr_cd
                  ";
        $where = " WHERE ";
        $union_where = " WHERE ";
        $group = " GROUP BY ";
        $order = " ORDER BY kingaku DESC";
        if (!$this->request->isPost()) {
            foreach ($post_flds as $post_fld) {
                $setdts[$post_fld] = "";
            }
            $setdts["cd"] = "01";
            $setdts["hyouji_kbn"] = '0';
            $setdts["junjo_kbn_cd"] = "1502"; // 得意先別
            $setdts["koujun_flg"] = 0;
            $setdts["kikan_from"] = date('Y-m-01');
            $setdts["kikan_to"] = date('Y-m-t');
            $setdts["zeikomi_flg"] = 0;
            $setdts["meisaigyou_flg"] = 1;
            $setdts["goukeigyou_flg"] = 0;
            $setdts["jinyuuryoku_flg"] = 0;
            $setdts["torihikiari_flg"] = 1;
            $setdts["torihikinasi_flg"] = 0;
            $setdts["hokakei_flg"] = 0;
            $setdts["zennen_flg"] = '0';

            $setdts['hanni_from'] = TokuisakiMrs::minimum(["column" => "cd",]);
            $setdts['hanni_to'] = TokuisakiMrs::maximum(["column" => "cd",]);
        } else {
            foreach ($post_flds as $post_fld) {
                $setdts[$post_fld] = array_key_exists($post_fld, $thisPost) ? $thisPost[$post_fld] : $this->request->getPost($post_fld);
            }
        }
        $junjo_kbn = JunjoKbns::findFirst(["conditions" => "cd = ?1", "bind" => ["1" => $setdts["junjo_kbn_cd"]]]);
        foreach ($setdts as $fld => $setdt) {
            $this->tag->setDefault($fld, $setdt);
        }
        switch ($setdts["junjo_kbn_cd"]) {
            case '1501':    //月度別
                $select .= "DATE_FORMAT(a.uriagebi,'%Y-%m') as u_uriagebi AS 'key',null AS 'key_name',";
                $group .= "DATE_FORMAT(a.uriagebi,'%Y-%m')";
                $where = '';
                $union_where = '';
                break;
            case '1502':    //得意先別
                $select .= "a.tokuisaki_mr_cd AS 'key',d.name AS 'key_name',";
                $group .= "a.tokuisaki_mr_cd,d.name";
                $where .= "a.tokuisaki_mr_cd BETWEEN '" . $setdts['hanni_from'] . "' AND '" . $setdts['hanni_to'] . "'";
                $union_where .= "zz.tokuisaki_mr_cd BETWEEN '" . $setdts['hanni_from'] . "' AND '" . $setdts['hanni_to'] . "'";
                break;
            case '1509':    //請求先
                $select .= "d.seikyuusaki_mr_cd AS 'key',d.name AS 'key_name',";
                $group .= "d.seikyuusaki_mr_cd,d.name";
                $where .= "d.seikyuusaki_mr_cd BETWEEN ('" . $setdts['hanni_from'] . "' AND '" . $setdts['hanni_to'] . "')";
                $union_where .= "zz.seikyuusaki_mr_cd BETWEEN ('" . $setdts['hanni_from'] . "' AND '" . $setdts['hanni_to'] . "')";
                break;
            case '1510':    //商品別
                $select .= "b.shouhin_mr_cd AS 'key',c.name AS 'key_name',";
                $group .= "b.shouhin_mr_cd,c.name";
                $where .= "b.shouhin_mr_cd BETWEEN '" . $setdts['hanni_from'] . "' AND '" . $setdts['hanni_to'] . "'";
                $union_where .= "z.shouhin_mr_cd BETWEEN '" . $setdts['hanni_from'] . "' AND '" . $setdts['hanni_to'] . "'";
                break;
            case '1516':    //担当者別
                $select .= "a.tantou_mr_cd AS 'key',e.name AS 'key_name',";
                $group .= "a.tantou_mr_cd,e.name";
                $where .= "a.tantou_mr_cd BETWEEN '" . $setdts['hanni_from'] . "' AND '" . $setdts['hanni_to'] . "'";
                $union_where .= "zz.tantou_mr_cd BETWEEN '" . $setdts['hanni_from'] . "' AND '" . $setdts['hanni_to'] . "'";
                break;
        }
        if ($setdts['koujun_flg'] === '1') {
            $order = " ORDER BY kingaku ASC";
        } else {
            $order = " ORDER BY kingaku DESC";
        }
        switch ($setdts['hyouji_kbn']) {
            case '0':   //順売上金額
                $select .= "
                    SUM(b.kingaku) AS kingaku,
                    SUM(b.zeinukigaku) - SUM(b.genkagaku) AS arari,
                    IF(b.utiwake_kbn_cd = '15',SUM(b.kingaku),0) AS henpin,
                    IF(b.utiwake_kbn_cd = '12',SUM(b.kingaku),0) AS nebiki
                ";
                break;
        }
        if ($where === '') {
            $where = "WHERE (a.uriagebi BETWEEN '" . $setdts['kikan_from'] . "' AND '" . $setdts['kikan_to'] . "')";
            $union_where = "WHERE (zz.uriagebi BETWEEN '" . $setdts['kikan_from'] . "' AND '" . $setdts['kikan_to'] . "')";
        } else {
            $where .= " AND (a.uriagebi BETWEEN '" . $setdts['kikan_from'] . "' AND '" . $setdts['kikan_to'] . "')";
            $union_where .= " AND (zz.uriagebi BETWEEN '" . $setdts['kikan_from'] . "' AND '" . $setdts['kikan_to'] . "')";
        }

        $stmt = $db->prepare($select . $from . $where . $group . $union_select . $union_where . $order);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($setdts['zennen_flg'] === '1') {
            $zennen_from = new DateTime($setdts['kikan_from']);
            $zennen_to = new DateTime($setdts['kikan_to']);
            $zennen_from = $zennen_from->modify('-1 year')->format('Y-m-d');
            $zennen_to = $zennen_to->modify('-1 year')->format('Y-m-d');
            $where = str_replace($setdts['kikan_from'], $zennen_from, $where);
            $where = str_replace($setdts['kikan_to'], $zennen_to, $where);
            $stmt = $db->prepare($select . $from . $where . $group);
            $stmt->execute();
            $zennen_rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (count($zennen_rows) !== 0) {
                $data = [];
                $row = 0;
                $zennen_kingaku = 0;
                $zennen_arari = 0;
                $zennen_henpin = 0;
                $zennen_nebiki = 0;
                for ($i = 0; $i < count($rows); $i++) {
                    if ($rows[$i]['key'] === '総計') {
                        $data[$row] = $rows[$i];
                        $row++;
                        continue;
                    }
                    for ($j = 0; $j < count($zennen_rows); $j++) {
                        if ($rows[$i]['key'] === $zennen_rows[$j]['key']) {
                            $data[$row] = $rows[$i];
                            $row++;
                            $data[$row] = $zennen_rows[$j];
                            $zennen_kingaku += (int)$zennen_rows[$j]['kingaku'];
                            $zennen_arari += (int)$zennen_rows[$j]['arari'];
                            $zennen_henpin += (int)$zennen_rows[$j]['henpin'];
                            $zennen_nebiki += (int)$zennen_rows[$j]['nebiki'];
                            $row++;
                            break;
                        }
                    }
                }
                $rows = $data;
                $this->view->zennen_kingaku = $zennen_kingaku;
                $this->view->zennen_arari = $zennen_arari;
                $this->view->zennen_henpin = $zennen_henpin;
                $this->view->zennen_nebiki = $zennen_nebiki;
            } else {
                $this->view->zennen_nasi = count($zennen_rows);
            }
        }
        $this->view->rows = $rows;
        $this->view->setdts = $setdts;

        $jouken_uriage_junis = JoukenUriageJunis::find(["order" => "cd, sakusei_user_id"
            , "conditions" => "sakusei_user_id IN(0, ?0)"
            , "bind" => [0 => $this->getDI()->getSession()->get('auth')['id']]
        ]);
        $joukens = [];
        foreach ($jouken_uriage_junis as $jouken_uriage_juni) {
            $joukens[$jouken_uriage_juni->cd] = $jouken_uriage_juni->name;
        }
        $this->view->joukens = $joukens;
        return;
    }

    /*
    * 売上分析表
    */
    public function bunsekiAction()
    {
        $db = \Phalcon\DI::getDefault()->get('db');
        $post_flds = [
            'cd',
            'hyouji_kbn',
            'kikan_from',
            'kikan_to',
            'id',
            'name',
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
            'kikan_sitei_kbn_cd',
            'koujun_flg',
            'meisaigyou_flg',
            'goukeigyou_flg',
            'torihikiari_flg',
            'torihikinashi_flg',
        ];
        $setdts = [];
        $thisPost = [];
        if (!$this->request->isPost()) {
            foreach ($post_flds as $post_fld) {
                $setdts[$post_fld] = "";
            }
            $setdts['cd'] = '01';
            $setdts['hyouji_kbn'] = '0';
            $setdts["kikan_from"] = date('Y-m-01');
            $setdts["kikan_to"] = date('Y-m-t');
            $setdts['junjo_kbn_cd'] = '1802';   //得意先
            $setdts['hanni_from'] = TokuisakiMrs::minimum(["column" => "cd",]);
            $setdts['hanni_to'] = TokuisakiMrs::maximum(["column" => "cd",]);
            $setdts['junjo2_kbn_cd'] = '1810';  //商品コード
            $setdts['hanni2_from'] = ShouhinMrs::minimum(["column" => "cd",]);
            $setdts['hanni2_to'] = ShouhinMrs::maximum(["column" => "cd",]);
            $setdts['koujun_flg'] = '0';
            $setdts['meisaigyou_flg'] = '1';
            $setdts['goukeigyou_flg'] = '0';
            $setdts['torihikiari_flg'] = '1';
            $setdts['torihikinashi_flg'] = '1';
        } else {
            foreach ($post_flds as $post_fld) {
                $setdts[$post_fld] = array_key_exists($post_fld, $thisPost) ? $thisPost[$post_fld] : $this->request->getPost($post_fld);
            }
        }
        if ($setdts['hanni_from'] === '') {
            $setdts['junjo_kbn_cd'] = '1802';   //得意先
            $setdts['hanni_from'] = TokuisakiMrs::minimum(["column" => "cd",]);
            $setdts['hanni_to'] = TokuisakiMrs::maximum(["column" => "cd",]);
            $setdts['junjo2_kbn_cd'] = '1810';  //商品コード
            $setdts['hanni2_from'] = ShouhinMrs::minimum(["column" => "cd",]);
            $setdts['hanni2_to'] = ShouhinMrs::maximum(["column" => "cd",]);
            $setdts['koujun_flg'] = '0';
            $setdts['meisaigyou_flg'] = '1';
            $setdts['goukeigyou_flg'] = '0';
            $setdts['torihikiari_flg'] = '1';
            $setdts['torihikinashi_flg'] = '0';
        }
        if ($setdts['junjo_kbn_cd'] === $setdts['junjo2_kbn_cd']) $this->view->rows = [];
        $where = " WHERE (b.uriagebi BETWEEN '{$setdts['kikan_from']}' AND '{$setdts['kikan_to']}') ";
        switch ($setdts['junjo_kbn_cd']) {
            case '1802': //得意先
                $select = "SELECT b.tokuisaki_mr_cd AS key1,c.name AS key1name,";
                if ($this->request->getPost('junjo2_kbn_cd') === '1816') {
                    $select .= "a.iro AS iro,";
                }
                $join1 = " LEFT OUTER JOIN tokuisaki_mrs AS c ON c.cd = b.tokuisaki_mr_cd ";
                $where .= " AND (b.tokuisaki_mr_cd BETWEEN '{$setdts['hanni_from']}' AND '{$setdts['hanni_to']}') ";
                break;
            case '1803': //得意先分類１
                $select = "SELECT zz.cd AS key1,zz.name AS key1name,";
                $join1 = " LEFT OUTER JOIN tokuisaki_mrs AS c ON c.cd = b.tokuisaki_mr_cd
                           LEFT OUTER JOIN tokuisaki_bunrui1_kbns AS zz ON zz.cd = c.tokuisaki_bunrui1_kbn_cd ";
                $where .= " AND (zz.cd BETWEEN '{$setdts['hanni_from']}' AND '{$setdts['hanni_to']}') ";
                break;
            case '1804': //得意先分類2
                $select = "SELECT zz.cd AS key1,zz.name AS key1name,";
                $join1 = " LEFT OUTER JOIN tokuisaki_mrs AS c ON c.cd = b.tokuisaki_mr_cd
                           LEFT OUTER JOIN tokuisaki_bunrui2_kbns AS zz ON zz.cd = c.tokuisaki_bunrui2_kbn_cd ";
                $where .= " AND (zz.cd BETWEEN '{$setdts['hanni_from']}' AND '{$setdts['hanni_to']}') ";
                break;
            case '1805': //得意先分類3
                $select = "SELECT zz.cd AS key1,zz.name AS key1name,";
                $join1 = " LEFT OUTER JOIN tokuisaki_mrs AS c ON c.cd = b.tokuisaki_mr_cd
                           LEFT OUTER JOIN tokuisaki_bunrui3_kbns AS zz ON zz.cd = c.tokuisaki_bunrui3_kbn_cd ";
                $where .= " AND (zz.cd BETWEEN '{$setdts['hanni_from']}' AND '{$setdts['hanni_to']}') ";
                break;
            case '1806': //得意先分類4
                $select = "SELECT zz.cd AS key1,zz.name AS key1name,";
                $join1 = " LEFT OUTER JOIN tokuisaki_mrs AS c ON c.cd = b.tokuisaki_mr_cd
                           LEFT OUTER JOIN tokuisaki_bunrui4_kbns AS zz ON zz.cd = c.tokuisaki_bunrui4_kbn_cd ";
                $where .= " AND (zz.cd BETWEEN '{$setdts['hanni_from']}' AND '{$setdts['hanni_to']}') ";
                break;
            case '1807': //得意先分類5
                $select = "SELECT zz.cd AS key1,zz.name AS key1name,";
                $join1 = " LEFT OUTER JOIN tokuisaki_mrs AS c ON c.cd = b.tokuisaki_mr_cd
                           LEFT OUTER JOIN tokuisaki_bunrui5_kbns AS zz ON zz.cd = c.tokuisaki_bunrui5_kbn_cd ";
                $where .= " AND (zz.cd BETWEEN '{$setdts['hanni_from']}' AND '{$setdts['hanni_to']}') ";
                break;
            case '1808': //担当者
                $select = "SELECT b.tantou_mr_cd AS key1,c.name AS key1name,";
                $join1 = " LEFT OUTER JOIN tantou_mrs AS c ON c.cd = b.tantou_mr_cd ";
                $where .= " AND (b.tantou_mr_cd BETWEEN '{$setdts['hanni_from']}' AND '{$setdts['hanni_to']}') ";
                break;
            case '1809': //請求先
                $select = "SELECT c.seikyuusaki_mr_cd AS key1,c.name AS key1name,";
                $join1 = " LEFT OUTER JOIN tokuisaki_mrs AS c ON c.cd = b.tokuisaki_mr_cd ";
                $where .= " AND (c.seikyuusaki_mr_cd BETWEEN '{$setdts['hanni_from']}' AND '{$setdts['hanni_to']}') ";
                break;
            case '1810': //商品
                $select = "SELECT a.shouhin_mr_cd AS key1,c.name AS key1name,a.iro AS iro,";
                $join1 = " LEFT OUTER JOIN shouhin_mrs AS c ON c.cd = a.shouhin_mr_cd ";
                $where .= " AND (a.shouhin_mr_cd BETWEEN '{$setdts['hanni_from']}' AND '{$setdts['hanni_to']}') ";
                break;
            case '1811': //商品分類１
                $select = "SELECT zz.cd AS key1,zz.name AS key1name,";
                $join1 = " LEFT OUTER JOIN shouhin_mrs AS c ON c.cd = a.shouhin_mr_cd
                           LEFT OUTER JOIN shouhin_bunrui1_kbns AS zz ON zz.cd = c.shouhin_bunrui1_kbn_cd ";
                $where .= " AND (zz.cd BETWEEN '{$setdts['hanni_from']}' AND '{$setdts['hanni_to']}') ";
                break;
            case '1812': //商品分類2
                $select = "SELECT zz.cd AS key1,zz.name AS key1name,";
                $join1 = " LEFT OUTER JOIN shouhin_mrs AS c ON c.cd = a.shouhin_mr_cd
                           LEFT OUTER JOIN shouhin_bunrui2_kbns AS zz ON zz.cd = c.shouhin_bunrui2_kbn_cd ";
                $where .= " AND (zz.cd BETWEEN '{$setdts['hanni_from']}' AND '{$setdts['hanni_to']}') ";
                break;
            case '1813': //商品分類3
                $select = "SELECT zz.cd AS key1,zz.name AS key1name,";
                $join1 = " LEFT OUTER JOIN shouhin_mrs AS c ON c.cd = a.shouhin_mr_cd
                           LEFT OUTER JOIN shouhin_bunrui3_kbns AS zz ON zz.cd = c.shouhin_bunrui3_kbn_cd ";
                $where .= " AND (zz.cd BETWEEN '{$setdts['hanni_from']}' AND '{$setdts['hanni_to']}') ";
                break;
            case '1814': //商品分類4
                $select = "SELECT zz.cd AS key1,zz.name AS key1name,";
                $join1 = " LEFT OUTER JOIN shouhin_mrs AS c ON c.cd = a.shouhin_mr_cd
                           LEFT OUTER JOIN shouhin_bunrui4_kbns AS zz ON zz.cd = c.shouhin_bunrui4_kbn_cd ";
                $where .= " AND (zz.cd BETWEEN '{$setdts['hanni_from']}' AND '{$setdts['hanni_to']}') ";
                break;
            case '1815': //商品分類5
                $select = "SELECT zz.cd AS key1,zz.name AS key1name,";
                $join1 = " LEFT OUTER JOIN shouhin_mrs AS c ON c.cd = a.shouhin_mr_cd
                           LEFT OUTER JOIN shouhin_bunrui5_kbns AS zz ON zz.cd = c.shouhin_bunrui5_kbn_cd ";
                $where .= " AND (zz.cd BETWEEN '{$setdts['hanni_from']}' AND '{$setdts['hanni_to']}') ";
                break;
            case '1816': //プロジェクトコード
                $select = "SELECT zz.cd AS key1,zz.name AS key1name,a.iro AS iro,";
                $join1 = " LEFT OUTER JOIN project_mrs AS zz ON zz.cd = a.project_mr_cd ";
                $where .= " AND (zz.cd BETWEEN '{$setdts['hanni_from']}' AND '{$setdts['hanni_to']}') ";
                break;
        }
        switch ($setdts['junjo2_kbn_cd']) {
            case '1802': //得意先
                $field = "b.tokuisaki_mr_cd AS key2,d.name AS key2name,";
                $join2 = " LEFT OUTER JOIN tokuisaki_mrs AS d ON d.cd = b.tokuisaki_mr_cd ";
                $where .= " AND (b.tokuisaki_mr_cd BETWEEN '{$setdts['hanni2_from']}' AND '{$setdts['hanni2_to']}') ";
                break;
            case '1803': //得意先分類１
                $field = "yy.cd AS key2,yy.name AS key2name,";
                $join2 = " LEFT OUTER JOIN tokuisaki_mrs AS d ON d.cd = b.tokuisaki_mr_cd
                           LEFT OUTER JOIN tokuisaki_bunrui1_kbns AS yy ON yy.cd = d.tokuisaki_bunrui1_kbn_cd ";
                $where .= " AND (yy.cd BETWEEN '{$setdts['hanni2_from']}' AND '{$setdts['hanni2_to']}') ";
                break;
            case '1804': //得意先分類2
                $field = "yy.cd AS key2,yy.name AS key2name,";
                $join2 = " LEFT OUTER JOIN tokuisaki_mrs AS d ON d.cd = b.tokuisaki_mr_cd
                           LEFT OUTER JOIN tokuisaki_bunrui2_kbns AS yy ON yy.cd = d.tokuisaki_bunrui2_kbn_cd ";
                $where .= " AND (yy.cd BETWEEN '{$setdts['hanni2_from']}' AND '{$setdts['hanni2_to']}') ";
                break;
            case '1805': //得意先分類3
                $field = "yy.cd AS key2,yy.name AS key2name,";
                $join2 = " LEFT OUTER JOIN tokuisaki_mrs AS d ON d.cd = b.tokuisaki_mr_cd
                           LEFT OUTER JOIN tokuisaki_bunrui3_kbns AS yy ON yy.cd = d.tokuisaki_bunrui3_kbn_cd ";
                $where .= " AND (yy.cd BETWEEN '{$setdts['hanni2_from']}' AND '{$setdts['hanni2_to']}') ";
                break;
            case '1806': //得意先分類4
                $field = "yy.cd AS key2,yy.name AS key2name,";
                $join2 = " LEFT OUTER JOIN tokuisaki_mrs AS d ON d.cd = b.tokuisaki_mr_cd
                           LEFT OUTER JOIN tokuisaki_bunrui4_kbns AS yy ON yy.cd = d.tokuisaki_bunrui4_kbn_cd ";
                $where .= " AND (yy.cd BETWEEN '{$setdts['hanni2_from']}' AND '{$setdts['hanni2_to']}') ";
                break;
            case '1807': //得意先分類5
                $field = "yy.cd AS key2,yy.name AS key2name,";
                $join2 = " LEFT OUTER JOIN tokuisaki_mrs AS d ON d.cd = b.tokuisaki_mr_cd
                           LEFT OUTER JOIN tokuisaki_bunrui5_kbns AS yy ON yy.cd = d.tokuisaki_bunrui5_kbn_cd ";
                $where .= " AND (yy.cd BETWEEN '{$setdts['hanni2_from']}' AND '{$setdts['hanni2_to']}') ";
                break;
            case '1808': //担当者
                $field = "b.tantou_mr_cd AS key2,d.name AS key2name,";
                $join2 = " LEFT OUTER JOIN tantou_mrs AS d ON d.cd = b.tantou_mr_cd ";
                $where .= " AND (b.tantou_mr_cd BETWEEN '{$setdts['hanni2_from']}' AND '{$setdts['hanni2_to']}') ";
                break;
            case '1809': //請求先
                $field = "d.seikyuusaki_mr_cd AS key2,d.name AS key2name,";
                $join2 = " LEFT OUTER JOIN tokuisaki_mrs AS d ON d.cd = b.tokuisaki_mr_cd ";
                $where .= " AND (d.seikyuusaki_mr_cd BETWEEN '{$setdts['hanni2_from']} AND {$setdts['hanni2_to']}') ";
                break;
            case '1810': //商品
                $field = "a.shouhin_mr_cd AS key2,d.name AS key2name,a.iro AS iro,";
                $join2 = " LEFT OUTER JOIN shouhin_mrs AS d ON d.cd = a.shouhin_mr_cd ";
                $where .= " AND (a.shouhin_mr_cd BETWEEN '{$setdts['hanni2_from']}' AND '{$setdts['hanni2_to']}') ";
                break;
            case '1811': //商品分類１
                $field = "yy.cd AS key2,yy.name AS key2name,";
                $join2 = " LEFT OUTER JOIN shouhin_mrs AS d ON d.cd = a.shouhin_mr_cd
                           LEFT OUTER JOIN shouhin_bunrui1_kbns AS yy ON yy.cd = d.shouhin_bunrui1_kbn_cd ";
                $where .= " AND (yy.cd BETWEEN '{$setdts['hanni2_from']}' AND '{$setdts['hanni2_to']}') ";
                break;
            case '1812': //商品分類2
                $field = "yy.cd AS key2,yy.name AS key2name,";
                $join2 = " LEFT OUTER JOIN shouhin_mrs AS d ON d.cd = a.shouhin_mr_cd
                           LEFT OUTER JOIN shouhin_bunrui2_kbns AS yy ON yy.cd = d.shouhin_bunrui2_kbn_cd ";
                $where .= " AND (yy.cd BETWEEN '{$setdts['hanni2_from']}' AND '{$setdts['hanni2_to']}') ";
                break;
            case '1813': //商品分類3
                $field = "yy.cd AS key2,yy.name AS key2name,";
                $join2 = " LEFT OUTER JOIN shouhin_mrs AS d ON d.cd = a.shouhin_mr_cd
                           LEFT OUTER JOIN shouhin_bunrui3_kbns AS yy ON yy.cd = d.shouhin_bunrui3_kbn_cd ";
                $where .= " AND (yy.cd BETWEEN '{$setdts['hanni2_from']}' AND '{$setdts['hanni2_to']}') ";
                break;
            case '1814': //商品分類4
                $field = "yy.cd AS key2,yy.name AS key2name,";
                $join2 = " LEFT OUTER JOIN shouhin_mrs AS d ON d.cd = a.shouhin_mr_cd
                           LEFT OUTER JOIN shouhin_bunrui4_kbns AS yy ON yy.cd = d.shouhin_bunrui4_kbn_cd ";
                $where .= " AND (yy.cd BETWEEN '{$setdts['hanni2_from']}' AND '{$setdts['hanni2_to']}') ";
                break;
            case '1815': //商品分類5
                $field = "yy.cd AS key2,yy.name AS key2name,";
                $join2 = " LEFT OUTER JOIN shouhin_mrs AS d ON d.cd = a.shouhin_mr_cd
                           LEFT OUTER JOIN shouhin_bunrui5_kbns AS yy ON yy.cd = d.shouhin_bunrui5_kbn_cd ";
                $where .= " AND (yy.cd BETWEEN '{$setdts['hanni2_from']}' AND '{$setdts['hanni2_to']}') ";
                break;
            case '1816': //プロジェクトコード
                $field = "yy.cd AS key2,yy.name AS key2name,";
                $join2 = " LEFT OUTER JOIN project_mrs AS yy ON yy.cd = a.project_mr_cd ";
                $where .= " AND (yy.cd BETWEEN '{$setdts['hanni2_from']}' AND '{$setdts['hanni2_to']}') ";
                break;
        }
        $group = " GROUP BY key1,key2 ";

        if ($this->request->getPost('junjo_kbn_cd') === '1816' || $this->request->getPost('junjo2_kbn_cd') === '1816') {
            $group .= ', a.iro ';
        }

        if ($setdts["koujun_flg"] === '0') {
            $order = " ORDER BY key1,key2";
        } else {
            $order = " ORDER BY key1 DESC,key2 DESC";
        }
        if ($setdts['torihikiari_flg'] === '0') {
            $having = " HAVING suuryou <> 0 ";
        } else {
            $having = '';
        }
        $phql = "
            {$select}{$field}
                SUM(a.kingaku) AS junuriage,
                SUM(CASE WHEN a.tanka_kbn = '1' THEN a.suuryou1 WHEN a.tanka_kbn = '2' THEN a.suuryou2 ELSE 0 END) AS suuryou,
                SUM(a.kingaku) - SUM(a.genkagaku) AS arari
            FROM uriage_meisai_dts AS a
            LEFT OUTER JOIN uriage_dts AS b ON b.id = a.uriage_dt_id
            {$join1}{$join2}{$where}{$group}{$having}{$order}
        ";

        $stmt = $db->prepare($phql);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        //配列の集計
        $shoukei_uriage = 0;
        $shoukei_suuryou = 0;
        $shoukei_arari = 0;
        $soukei = 0;
        $soukeiArray = ['junuriage' => 0, 'suuryou' => 0, 'arari' => 0];
        $j = 0;
        $view_datas = [];
        $sumarry_counter = 0;
        for ($i = 0; $i < count($rows); $i++) {
            if ($i === 0) {
                $view_datas[$j]['key'] = '≪ ' . $rows[$i]['key1'] . ' ≫';
                $view_datas[$j]['name'] = '≪ ' . $rows[$i]['key1name'] . ' ≫';
                $view_datas[$j]['junuriage'] = '';
                $view_datas[$j]['suuryou'] = '';
                $view_datas[$j]['arari'] = '';
                $j++;
                $view_datas[$j]['key'] = $rows[$i]['key2'];
                $view_datas[$j]['name'] = $rows[$i]['key2name'];
                if (isset($rows[$i]['iro'])) {
                    $view_datas[$j]['iro'] = $rows[$i]['iro'];
                }
                $view_datas[$j]['junuriage'] = $rows[$i]['junuriage'];
                $view_datas[$j]['suuryou'] = $rows[$i]['suuryou'];
                $view_datas[$j]['arari'] = $rows[$i]['arari'];
                $shoukei_uriage += (float)$rows[$i]['junuriage'];
                $shoukei_suuryou += (float)$rows[$i]['suuryou'];
                $shoukei_arari += (float)$rows[$i]['arari'];
            } else {
                if ($rows[$i]['key1'] === $rows[$i - 1]['key1']) {
                    $view_datas[$j]['key'] = $rows[$i]['key2'];
                    $view_datas[$j]['name'] = $rows[$i]['key2name'];
                    if (isset($rows[$i]['iro'])) {
                        $view_datas[$j]['iro'] = $rows[$i]['iro'];
                    }
                    $view_datas[$j]['junuriage'] = $rows[$i]['junuriage'];
                    $view_datas[$j]['suuryou'] = $rows[$i]['suuryou'];
                    $view_datas[$j]['arari'] = $rows[$i]['arari'];

                    $shoukei_uriage += (float)$rows[$i]['junuriage'];
                    $shoukei_suuryou += (float)$rows[$i]['suuryou'];
                    $shoukei_arari += (float)$rows[$i]['arari'];
                    $j++;
                } else {
                    $view_datas[$j]['key'] = $rows[$i - 1]['key1'] . ' 計';
                    $view_datas[$j]['name'] = '...' . $rows[$i - 1]['key1name'] . ' 計:';
                    $view_datas[$j]['junuriage'] = $shoukei_uriage;
                    $view_datas[$j]['suuryou'] = $shoukei_suuryou;
                    $view_datas[$j]['arari'] = $shoukei_arari;
                    // 総計行用
                    $soukeiArray['junuriage'] = $soukeiArray['junuriage'] + $shoukei_uriage;
                    $soukeiArray['suuryou'] = $soukeiArray['suuryou'] + $shoukei_suuryou;
                    $soukeiArray['arari'] = $soukeiArray['arari'] + $shoukei_arari;
                    $shoukei_uriage = 0;
                    $shoukei_suuryou = 0;
                    $shoukei_arari = 0;
                    $j++;

                    $view_datas[$j]['key'] = '≪ ' . $rows[$i]['key1'] . ' ≫';
                    $view_datas[$j]['name'] = '≪ ' . $rows[$i]['key1name'] . ' ≫';
                    $view_datas[$j]['junuriage'] = '';
                    $view_datas[$j]['suuryou'] = '';
                    $view_datas[$j]['arari'] = '';
                    $j++;

                    $view_datas[$j]['key'] = $rows[$i]['key2'];
                    $view_datas[$j]['name'] = $rows[$i]['key2name'];
                    if (isset($rows[$i]['iro'])) {
                        $view_datas[$j]['iro'] = $rows[$i]['iro'];
                    }
                    $view_datas[$j]['junuriage'] = $rows[$i]['junuriage'];
                    $view_datas[$j]['suuryou'] = $rows[$i]['suuryou'];
                    $view_datas[$j]['arari'] = $rows[$i]['arari'];

                    $shoukei_uriage += (float)$rows[$i]['junuriage'];
                    $shoukei_suuryou += (float)$rows[$i]['suuryou'];
                    $shoukei_arari += (float)$rows[$i]['arari'];
                }
            }
            $soukei += $shoukei_uriage;
            $j++;
        }
        if ($sumarry_counter === 0) {
            $view_datas[$j]['key'] = $rows[$i - 1]['key1'] . ' 計';
            $view_datas[$j]['name'] = '...' . $rows[$i - 1]['key1name'] . ' 計:';
            $view_datas[$j]['junuriage'] = $shoukei_uriage;
            $view_datas[$j]['suuryou'] = $shoukei_suuryou;
        }
        $this->view->soukei = $soukei;
        $this->view->rows = $view_datas;
        $this->view->soukeiArray = $soukeiArray;

        $this->tag->setDefault('kikan_sitei_kbn_cd', $this->request->getPost('kikan_sitei_kbn_cd'));
        $this->tag->setDefault('kikan_from', $this->request->getPost('kikan_from'));
        $this->tag->setDefault('kikan_to', $this->request->getPost('kikan_to'));

        //現在複数条件は作成していないので、意味が無いが将来使用するかもしれない
        $jouken_uriage_bunsekis = JoukenUriageBunsekis::find(["order" => "cd, sakusei_user_id"
            , "conditions" => "sakusei_user_id IN(0, ?0)"
            , "bind" => [0 => $this->getDI()->getSession()->get('auth')['id']]
        ]);
        $joukens = [];
        foreach ($jouken_uriage_bunsekis as $jouken_uriage_bunseki) {
            $joukens[$jouken_uriage_bunseki->cd] = $jouken_uriage_bunseki->name;
        }
        $this->view->joukens = $joukens;
        return;
    }
}
