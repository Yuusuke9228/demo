<?php

class ReportShiireController extends ControllerBase
{
    /**
     * 仕入明細書
     */
    public function indexAction()
    {
        $post_flds =
            [
                'cd', 'name', 'junjo_kbn_cd', 'koujun_flg', 'hanni_from', 'hanni_to', 'shiiresaki_mr_cd', 'shouhin_mr_cd', 'tantou_mr_cd', 'souko_mr_cd', 'project_mr_cd', 'project_sub_cd', 'kikan_sitei_kbn_cd', 'kikan_from', 'kikan_to', 'cd_from', 'cd_to', 'simekiri_kbn', 'tuujou_flg', 'henpin_flg', 'nebiki_flg', 'shokeihi_flg', 'seisan_flg', 'shouhi_flg', 'sikyuu_flg', 'azukari_flg', 'tekiyou_flg', 'memo_flg', 'shouhizei_flg', 'jinyuuryoku_flg', 'keitekiyou_flg', 'goukeigyou_flg'
            ];
        $setdts = []; // データーの中継変数
        $thisPost = []; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        $setdts["cd"] = "01"; // 日別
        $setdts["junjo_kbn_cd"] = "2201"; // 日別
        $setdts["koujun_flg"] = 0;
        $setdts["kikan_sitei_kbn_cd"] = "2201"; // 今日
        $setdts["kikan_from"] = date('Y-m-d'); // 今日を指定2019/3/19井浦
        $setdts["kikan_to"] = date('Y-m-d');
        $setdts["simekiri_kbn"] = 0;
        $setdts["tuujou_flg"] = 1;
        $setdts["henpin_flg"] = 1;
        $setdts["nebiki_flg"] = 1;
        $setdts["shokeihi_flg"] = 1;
        $setdts["seisan_flg"] = 1;
        $setdts["shouhi_flg"] = 1;
        $setdts["sikyuu_flg"] = 1;
        $setdts["azukari_flg"] = 1;
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
        $order_txt = "ShiireDts.cd" . $desc . ", ShiireMeisaiDts.cd" . $desc;
        switch (substr($setdts["junjo_kbn_cd"], -2)) {
            case "01": // 入力順の場合
                $order_txt = "ShiireDts.cd" . $desc . ", ShiireMeisaiDts.cd" . $desc;
                break;
            case "02": // 日付順の場合
                $order_txt = "ShiireDts.shiirebi" . $desc . ", ShiireDts.cd" . $desc . ", ShiireMeisaiDts.cd" . $desc;
                break;
            case "03": // 仕入先順の場合
                $and_where = " AND ShiireDts.shiiresaki_mr_cd BETWEEN ?2 AND ?3";
                $where_para += [2 => $setdts["hanni_from"], 3 => $setdts["hanni_to"]];
                $order_txt = "ShiireDts.shiiresaki_mr_cd" . $desc . ", ShiireDts.cd" . $desc . ", ShiireMeisaiDts.cd" . $desc;
                break;
            case "04": // 商品順の場合
                $and_where = " AND ShiireMeisaiDts.shouhin_mr_cd BETWEEN ?2 AND ?3";
                $where_para += [2 => $setdts["hanni_from"], 3 => $setdts["hanni_to"]];
                $order_txt = "ShiireMeisaiDts.shouhin_mr_cd" . $desc . ", ShiireDts.shiirebi" . $desc . ", ShiireDts.cd" . $desc . ", ShiireMeisaiDts.cd" . $desc;
                break;
            case "05": // 担当者順の場合
                $and_where = " AND ShiireDts.tantou_mr_cd BETWEEN ?2 AND ?3";
                $where_para += [2 => $setdts["hanni_from"], 3 => $setdts["hanni_to"]];
                $order_txt = "ShiireDts.tantou_mr_cd" . $desc . ", ShiireDts.shiirebi" . $desc . ", ShiireDts.cd" . $desc . ", ShiireMeisaiDts.cd" . $desc;
                break;
            case "06": // 倉庫順の場合
                $and_where = " AND ShiireMeisaiDts.souko_mr_cd BETWEEN ?2 AND ?3";
                $where_para += [2 => $setdts["hanni_from"], 3 => $setdts["hanni_to"]];
                $order_txt = "ShiireMeisaiDts.souko_mr_cd" . $desc . ", ShiireDts.shiirebi" . $desc . ", ShiireDts.cd" . $desc . ", ShiireMeisaiDts.cd" . $desc;
                break;
            case "07": // プロジェクト順の場合
                $and_where = " AND ShiireMeisaiDts.project_mr_cd BETWEEN ?2 AND ?3";
                $where_para += [2 => $setdts["hanni_from"], 3 => $setdts["hanni_to"]];
                $order_txt = "ShiireMeisaiDts.project_mr_cd" . $desc . ", ShiireDts.shiirebi" . $desc . ", ShiireDts.cd" . $desc . ", ShiireMeisaiDts.cd" . $desc;
                break;
        }
        $and_where .= $setdts["jinyuuryoku_flg"] == 1 ? " AND u.creator = " . $this->getDI()->getSession()->get('auth')['id'] : "";
        $and_where .= $setdts["shiiresaki_mr_cd"] ? " AND ShiireDts.shiiresaki_mr_cd = '" . $setdts['shiiresaki_mr_cd'] . "'" : "";
        $and_where .= $setdts["tantou_mr_cd"] ? " AND ShiireDts.tantou_mr_cd = '" . $setdts['tantou_mr_cd'] . "'" : "";
        $and_where .= $setdts["souko_mr_cd"] ? " AND ShiireMeisaiDts.souko_mr_cd = '" . $setdts['souko_mr_cd'] . "'" : "";
        $and_where .= $setdts["project_mr_cd"] ? " AND ShiireMeisaiDts.project_mr_cd = '" . $setdts['project_mr_cd'] . "'" : "";
        $and_where .= $setdts["tuujou_flg"] == 0 ? " AND ShiireMeisaiDts.utiwake_kbn_cd <> '10'" : "";
        $and_where .= $setdts["henpin_flg"] == 0 ? " AND ShiireMeisaiDts.utiwake_kbn_cd <> '11'" : "";
        $and_where .= $setdts["nebiki_flg"] == 0 ? " AND ShiireMeisaiDts.utiwake_kbn_cd <> '12'" : "";
        $and_where .= $setdts["shokeihi_flg"] == 0 ? " AND ShiireMeisaiDts.utiwake_kbn_cd <> '13'" : "";
        $and_where .= $setdts["seisan_flg"] == 0 ? " AND ShiireMeisaiDts.utiwake_kbn_cd <> '20'" : "";
        $and_where .= $setdts["shouhi_flg"] == 0 ? " AND ShiireMeisaiDts.utiwake_kbn_cd <> '21'" : "";
        $and_where .= $setdts["sikyuu_flg"] == 0 ? " AND ShiireMeisaiDts.utiwake_kbn_cd <> '22'" : "";
        $and_where .= $setdts["azukari_flg"] == 0 ? " AND ShiireMeisaiDts.utiwake_kbn_cd <> '23'" : "";
        $and_where .= $setdts["tekiyou_flg"] == 0 ? " AND ShiireMeisaiDts.utiwake_kbn_cd <> '40'" : "";
        $and_where .= $setdts["memo_flg"] == 0 ? " AND ShiireMeisaiDts.utiwake_kbn_cd <> '41'" : "";
        $and_where .= $setdts["shouhizei_flg"] == 0 ? " AND ShiireMeisaiDts.utiwake_kbn_cd <> '90'" : "";
        $phql = "
			SELECT *, ShiireDts.*,
				TorihikiKbns.name,
				ShiiresakiMrs.name,
				TantouMrs.name,
				ZeitenkaKbns.name,
				UtiwakeKbns.name,
				TanniMrs.name,
				SoukoMrs.name,
				concat(ZeirituMrs.ryakushou , ZeirituMrs.zeiritu , '%') as zeiritu_name,
				ProjectMrs.name
			FROM ShiireMeisaiDts
			LEFT JOIN ShiireDts ON shiire_dt_id = ShiireDts.id
			LEFT JOIN ShiiresakiMrs ON ShiireDts.shiiresaki_mr_cd = ShiiresakiMrs.cd
			LEFT JOIN TantouMrs ON ShiireDts.tantou_mr_cd = TantouMrs.cd
			LEFT JOIN TorihikiKbns ON ShiireDts.torihiki_kbn_cd = TorihikiKbns.cd
			LEFT JOIN ZeitenkaKbns ON ShiireDts.zei_tenka_kbn_cd = ZeitenkaKbns.cd
			LEFT JOIN UtiwakeKbns ON utiwake_kbn_cd = UtiwakeKbns.cd
			LEFT JOIN TanniMrs ON tanni_mr_cd = TanniMrs.cd
			LEFT JOIN SoukoMrs ON souko_mr_cd = SoukoMrs.cd
			LEFT JOIN ZeirituMrs ON zeiritu_mr_cd = ZeirituMrs.cd
			LEFT JOIN ProjectMrs ON project_mr_cd = ProjectMrs.cd
			WHERE ShiireDts.shiirebi >= ?0 AND ShiireDts.shiirebi <= ?1" . $and_where . "
			ORDER BY " . $order_txt . "
		";
        // echo '<p><br><p><br>'.$phql;
        $rows = $mgr->executeQuery($phql, $where_para);

        $jouken_shiire_meisais = JoukenShiireMeisais::find([
            "order" => "cd, sakusei_user_id",
            "conditions" => "sakusei_user_id IN(0, ?0)",
            "bind" => [0 => $this->getDI()->getSession()->get('auth')['id']]
        ]);
        $joukens = [];
        foreach ($jouken_shiire_meisais as $jouken_shiire_meisai) {
            $joukens[$jouken_shiire_meisai->cd] = $jouken_shiire_meisai->name;
        }
        $this->view->joukens = $joukens;
        $this->view->setdts = $setdts;

        $this->view->rows = $rows;
        return;
    }

    /**
     * 仕入明細EXCEL 2019/10/31 Nishiyama
     */
    public function indexxlsAction()
    {
        $post_flds =
            [
                'cd', 'name', 'junjo_kbn_cd', 'koujun_flg', 'hanni_from', 'hanni_to', 'shiiresaki_mr_cd', 'shouhin_mr_cd', 'tantou_mr_cd', 'souko_mr_cd', 'project_mr_cd', 'project_sub_cd', 'kikan_sitei_kbn_cd', 'kikan_from', 'kikan_to', 'cd_from', 'cd_to', 'simekiri_kbn', 'tuujou_flg', 'henpin_flg', 'nebiki_flg', 'shokeihi_flg', 'seisan_flg', 'shouhi_flg', 'sikyuu_flg', 'azukari_flg', 'tekiyou_flg', 'memo_flg', 'shouhizei_flg', 'jinyuuryoku_flg', 'keitekiyou_flg', 'goukeigyou_flg'
            ];
        $setdts = []; // データーの中継変数
        $thisPost = []; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        $setdts["cd"] = "01"; // 日別
        $setdts["junjo_kbn_cd"] = "2201"; // 日別
        $setdts["koujun_flg"] = 0;
        $setdts["kikan_sitei_kbn_cd"] = "2201"; // 今日
        $setdts["kikan_from"] = date('Y-m-d');
        $setdts["kikan_to"] = date('Y-m-d');
        $setdts["simekiri_kbn"] = 0;
        $setdts["tuujou_flg"] = 1;
        $setdts["henpin_flg"] = 1;
        $setdts["nebiki_flg"] = 1;
        $setdts["shokeihi_flg"] = 1;
        $setdts["seisan_flg"] = 1;
        $setdts["shouhi_flg"] = 1;
        $setdts["sikyuu_flg"] = 1;
        $setdts["azukari_flg"] = 1;
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
        $order_txt = "b.cd" . $desc . ", a.cd" . $desc;
        switch (substr($setdts["junjo_kbn_cd"], -2)) {
            case "01": // 入力順の場合
                $order_txt = "b.cd" . $desc . ", a.cd" . $desc;
                break;
            case "02": // 日付順の場合
                $order_txt = "b.shiirebi" . $desc . ", b.cd" . $desc . ", a.cd" . $desc;
                break;
            case "03": // 仕入先順の場合
                $and_where = " AND b.shiiresaki_mr_cd BETWEEN ?2 AND ?3";
                $where_para += [2 => $setdts["hanni_from"], 3 => $setdts["hanni_to"]];
                $order_txt = "b.shiiresaki_mr_cd" . $desc . ", b.cd" . $desc . ", a.cd" . $desc;
                break;
            case "04": // 商品順の場合
                $and_where = " AND a.shouhin_mr_cd BETWEEN ?2 AND ?3";
                $where_para += [2 => $setdts["hanni_from"], 3 => $setdts["hanni_to"]];
                $order_txt = "a.shouhin_mr_cd" . $desc . ", b.shiirebi" . $desc . ", b.cd" . $desc . ", a.cd" . $desc;
                break;
            case "05": // 担当者順の場合
                $and_where = " AND b.tantou_mr_cd BETWEEN ?2 AND ?3";
                $where_para += [2 => $setdts["hanni_from"], 3 => $setdts["hanni_to"]];
                $order_txt = "b.tantou_mr_cd" . $desc . ", b.shiirebi" . $desc . ", b.cd" . $desc . ", a.cd" . $desc;
                break;
            case "06": // 倉庫順の場合
                $and_where = " AND ShiireMeisaiDts.souko_mr_cd BETWEEN ?2 AND ?3";
                $where_para += [2 => $setdts["hanni_from"], 3 => $setdts["hanni_to"]];
                $order_txt = "a.souko_mr_cd" . $desc . ", b.shiirebi" . $desc . ", b.cd" . $desc . ", a.cd" . $desc;
                break;
            case "07": // プロジェクト順の場合
                $and_where = " AND ShiireMeisaiDts.project_mr_cd BETWEEN ?2 AND ?3";
                $where_para += [2 => $setdts["hanni_from"], 3 => $setdts["hanni_to"]];
                $order_txt = "a.project_mr_cd" . $desc . ", b.shiirebi" . $desc . ", b.cd" . $desc . ", a.cd" . $desc;
                break;
        }
        $and_where .= $setdts["jinyuuryoku_flg"] == 1 ? " AND u.creator = " . $this->getDI()->getSession()->get('auth')['id'] : "";
        $and_where .= $setdts["shiiresaki_mr_cd"] ? " AND a.shiiresaki_mr_cd = '" . $setdts['shiiresaki_mr_cd'] . "'" : "";
        $and_where .= $setdts["tantou_mr_cd"] ? " AND b.tantou_mr_cd = '" . $setdts['tantou_mr_cd'] . "'" : "";
        $and_where .= $setdts["souko_mr_cd"] ? " AND a.souko_mr_cd = '" . $setdts['souko_mr_cd'] . "'" : "";
        $and_where .= $setdts["project_mr_cd"] ? " AND a.project_mr_cd = '" . $setdts['project_mr_cd'] . "'" : "";
        $and_where .= $setdts["tuujou_flg"] == 0 ? " AND a.utiwake_kbn_cd <> '10'" : "";
        $and_where .= $setdts["henpin_flg"] == 0 ? " AND a.utiwake_kbn_cd <> '11'" : "";
        $and_where .= $setdts["nebiki_flg"] == 0 ? " AND a.utiwake_kbn_cd <> '12'" : "";
        $and_where .= $setdts["shokeihi_flg"] == 0 ? " AND a.utiwake_kbn_cd <> '13'" : "";
        $and_where .= $setdts["seisan_flg"] == 0 ? " AND a.utiwake_kbn_cd <> '20'" : "";
        $and_where .= $setdts["shouhi_flg"] == 0 ? " AND a.utiwake_kbn_cd <> '21'" : "";
        $and_where .= $setdts["sikyuu_flg"] == 0 ? " AND a.utiwake_kbn_cd <> '22'" : "";
        $and_where .= $setdts["azukari_flg"] == 0 ? " AND a.utiwake_kbn_cd <> '23'" : "";
        $and_where .= $setdts["tekiyou_flg"] == 0 ? " AND a.utiwake_kbn_cd <> '40'" : "";
        $and_where .= $setdts["memo_flg"] == 0 ? " AND a.utiwake_kbn_cd <> '41'" : "";
        $and_where .= $setdts["shouhizei_flg"] == 0 ? " AND a.utiwake_kbn_cd <> '90'" : "";
        $phql = "
			SELECT
			    b.nendo AS nendo,
			    b.shiirebi AS shiirebi,
			    b.cd AS den_cd,
			    f.name AS torihiki_kbn_name,
			    b.shiiresaki_mr_cd AS shiiresaki_cd,
				c.name AS shiiresaki_name,
				b.tantou_mr_cd AS tantou_cd,
				e.name AS tantou_name,
			    h.name AS utiwake_name,
			    a.shouhin_mr_cd AS shouhin_cd,
			    IF(a.nyuuka_kbn_cd <> '', '完', '') AS shukka_kbn,
			    a.tekiyou AS tekiyou,
			    a.lot AS lot,
			    a.iro AS iro,
			    a.iromei AS iromei,
			    a.kobetucd AS kobetucd,
			    a.souko_mr_cd AS souko_cd,
			    j.name AS souko_name,
			    a.size AS size,
			    IF(a.tanka_kbn = 1, a.suuryou1, a.suuryou2) AS shiire_ryou,
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
				b.tekiyou AS den_tekiyou	
			FROM ShiireMeisaiDts AS a
			LEFT JOIN ShiireDts AS b ON a.shiire_dt_id = b.id  
			LEFT JOIN ShiiresakiMrs AS c ON b.shiiresaki_mr_cd = c.cd
			LEFT JOIN TantouMrs AS e ON b.tantou_mr_cd = e.cd
			LEFT JOIN TorihikiKbns AS f ON b.torihiki_kbn_cd = f.cd
			LEFT JOIN ZeitenkaKbns AS g ON b.zei_tenka_kbn_cd = g.cd
			LEFT JOIN UtiwakeKbns AS h ON a.utiwake_kbn_cd = h.cd
			LEFT JOIN TanniMrs AS i ON a.tanni_mr1_cd = i.cd
			LEFT JOIN TanniMrs AS m ON a.tanni_mr2_cd = i.cd
			LEFT JOIN SoukoMrs AS j ON a.souko_mr_cd = j.cd
			LEFT JOIN ZeirituMrs AS k ON a.zeiritu_mr_cd = k.cd
			LEFT JOIN ProjectMrs AS l ON a.project_mr_cd = l.cd
			WHERE b.shiirebi >= ?0 AND b.shiirebi <= ?1" . $and_where . "
			ORDER BY " . $order_txt . "
		";
        $rows = $mgr->executeQuery($phql, $where_para);
        $rows = $rows->toArray();

        $data_title = [];
        $data_title[0] = [
            "nendo" => "年度",
            "shiirebi" => "仕入日",
            "den_cd" => "伝票番号",
            "torihiki_kbn_name" => "取引区分",
            "shiiresaki_cd" => "仕入先コード",
            "shiiresaki_name" => "仕入先",
            "tantou_cd" => "担当コード",
            "tantou_name" => "担当",
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
            "size" => "サイズ",
            "shiire_ryou" => "数量",
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
            "den_tekiyou" => "伝票摘要",
        ];
        $data_sets = array_merge($data_title, $rows); //見出しとデータのマージ

        include __DIR__ . '/../vendor/PHPExcel/Classes/PHPExcel.php';
        include __DIR__ . '/../vendor/PHPExcel/Classes/PHPExcel/Writer/Excel2007.php';
        include __DIR__ . '/../vendor/PHPExcel/Classes/PHPExcel/IOFactory.php';

        $PHPExcel = new PHPExcel();
        $sheet = $PHPExcel->getActiveSheet();
        $PHPExcel = new PHPExcel();
        $sheet = $PHPExcel->getActiveSheet();
        $sheet->fromArray($data_sets, null, 'A1');
        // 保存
        $filename = uniqid("shiiredt", true) . '';
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
     * 仕入日報
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
            $setdts["junjo_kbn_cd"] = "2201"; // 日別
            $setdts["koujun_flg"] = 0;
            $setdts["kikan_sitei_kbn_cd"] = "2207"; // 今月
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
				LEFT JOIN ShiireDts AS u ON tm.torihiki_kbn_cd = u.torihiki_kbn_cd
				LEFT JOIN ShiireMeisaiDts AS um ON um.shiire_dt_id = u.id AND tm.utiwake_kbn_cd = um.utiwake_kbn_cd
				LEFT JOIN TorihikiKbns AS tr ON tm.torihiki_kbn_cd = tr.cd
				WHERE u.shiirebi >= ?0 AND u.shiirebi <= ?1 OR u.shiirebi IS NULL
				GROUP BY tm.cd
			";
            $rows = $mgr->executeQuery($phql, [0 => $setdts["kikan_from"], 1 => $setdts["kikan_to"]]);
            $to_midasi = ["区分", "取引内容", "金額"];
            $junshiiregaku = 0; // 純仕入額
            $ararieki = 0; // 粗利益
            foreach ($rows as $rw) {
                if ($rw->tm_cd != "50") {
                    $toviews[] = ["【" . $rw->tr_name . "】", $rw->tm_name, $rw->kingaku_kei];
                    $junshiiregaku += $rw->kingaku_kei;
                    $ararieki += $rw->arari;
                } else {
                    $sample = $rw; // サンプル数レコードを控えて置く
                }
            }
            $toviews[] = ["【合計】", "純仕入額", $junshiiregaku];
            //$toviews[] = ["【合計】","粗利益",$ararieki];
            //$toviews[] = ["【合計】","粗利率(%)",round(100 * $ararieki / $junshiiregaku, 0)];
            $shousuus[count($rows) + 3] = 1;

            $zphql = "
				SELECT zt.cd as zt_cd, zt.name as zt_name, SUM(um.zeigaku) as kingaku_kei
				FROM ZeitenkaKbns AS zt
				LEFT JOIN ShiireDts AS u ON zt.cd = u.zei_tenka_kbn_cd
				LEFT JOIN ShiireMeisaiDts AS um ON um.shiire_dt_id = u.id
				WHERE u.shiirebi >= ?0 AND u.shiirebi <= ?1 OR u.shiirebi IS NULL
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
				SELECT SUM(um.zeinukigaku) as um_kingaku, SUM(um.zeinukigaku - um.genkagaku) as arari, u.shiirebi as u_shiirebi, um.utiwake_kbn_cd as um_utiwake_kbn_cd
				FROM ShiireMeisaiDts AS um
				LEFT JOIN ShiireDts AS u ON um.shiire_dt_id = u.id
				WHERE u.shiirebi >= ?0 AND u.shiirebi <= ?1
				GROUP BY u.shiirebi, um.utiwake_kbn_cd
				ORDER BY u.shiirebi" . ($setdts["koujun_flg"] == 1 ? " DESC" : "") . ", um.utiwake_kbn_cd
			";
            $rows = $mgr->executeQuery($phql, [0 => $setdts["kikan_from"], 1 => $setdts["kikan_to"]]);
            $to_midasi = ["", "日付", "総仕入額", "返品額", "返品率", "値引額", "値引率", "その他", "純仕入額"];
            $utiwake_kbn_retu = ["10" => 2, "11" => 3, "12" => 5, "13" => 7, "14" => 8, "20" => 7, "21" => 7, "22" => 7, "23" => 7, "24" => 8, "30" => 7, "40" => 7, "41" => 7, "90" => 7]; // 加算する列番号を決める
            $junshiiregaku = 0; // 純仕入額
            $ararieki = 0; // 粗利益
            $toviews[0][0] = "";
            $toviews[0][1] = "《総合計》"; // 日付
            for ($i = 2; $i <= 8; $i++) {
                $toviews[0][$i] = 0;
            } // 合計行クリア
            $i = 0;
            foreach ($rows as $rw) {
                if ($rw->u_shiirebi != $toviews[$i][1]) {
                    $toviews[$i][8] = $toviews[$i][2] + $toviews[$i][3] + $toviews[$i][5] + $toviews[$i][7]; // 純仕入額
                    if ($toviews[$i][2] != 0) {
                        $toviews[$i][4] = round(-100 * $toviews[$i][3] / $toviews[$i][2], 1); // 返品率
                        $toviews[$i][6] = round(-100 * $toviews[$i][5] / $toviews[$i][2], 1); // 値引率
                    }
                    //if ($toviews[$i][8] != 0) {
                    //	$toviews[$i][10] = round(100 * $toviews[$i][9] / $toviews[$i][8], 1); // 粗利率
                    //}
                    $i++;
                    $toviews[$i][1] = $rw->u_shiirebi; // 日付
                    $toviews[$i][0] = ""; // colspan
                    $toviews[$i][2] = 0; // 総仕入額
                    $toviews[$i][3] = 0; // 返品額
                    $toviews[$i][4] = 0; // 返品率
                    $toviews[$i][5] = 0; // 値引額
                    $toviews[$i][6] = 0; // 値引率
                    $toviews[$i][7] = 0; // その他
                    $toviews[$i][8] = 0; // 純仕入額
                    //$toviews[$i][9] = 0; // 粗利益
                    //$toviews[$i][10] = 0; // 粗利率
                }
                $toviews[$i][$utiwake_kbn_retu[$rw->um_utiwake_kbn_cd]] += $rw->um_kingaku;
                //$toviews[$i][9] += $rw->arari;
                $toviews[0][$utiwake_kbn_retu[$rw->um_utiwake_kbn_cd]] += $rw->um_kingaku;
                if (!$utiwake_kbn_retu[$rw->um_utiwake_kbn_cd]) {
                    echo $rw->um_utiwake_kbn_cd . " ";
                }
                //$toviews[0][9] += $rw->arari;
                // echo "\n<br>".$rw->u_shiirebi." ".$rw->um_utiwake_kbn_cd." ".$utiwake_kbn_retu[$rw->um_utiwake_kbn_cd];
            }
            $toviews[$i][8] = $toviews[$i][2] + $toviews[$i][3] + $toviews[$i][5] + $toviews[$i][7]; // 純仕入額
            if ($toviews[$i][2] != 0) { // 最終行
                $toviews[$i][4] = round(-100 * $toviews[$i][3] / $toviews[$i][2], 1); // 返品率
                $toviews[$i][6] = round(-100 * $toviews[$i][5] / $toviews[$i][2], 1); // 値引率
            }
            //if ($toviews[$i][8] != 0) { // 最終行
            //	$toviews[$i][10] = round(100 * $toviews[$i][9] / $toviews[$i][8], 1); // 粗利率
            //}
            $toviews[0][8] = $toviews[0][2] + $toviews[0][3] + $toviews[0][5] + $toviews[0][7]; // 純仕入額
            if ($toviews[0][2] != 0) { // 合計行
                $toviews[0][4] = round(-100 * $toviews[0][3] / $toviews[0][2], 1); // 返品率
                $toviews[0][6] = round(-100 * $toviews[0][5] / $toviews[0][2], 1); // 値引率
            }
            //if ($toviews[0][8] != 0) { // 合計行
            //	$toviews[0][10] = round(100 * $toviews[0][9] / $toviews[0][8], 1); // 粗利率
            //}
            //$shousuus[10]=1;

            //echo "\n<br>";print_r($toviews[0]);


        } else if (substr($setdts["junjo_kbn_cd"], -2) == "02") { // 仕入先順の場合
            $phql = "
				SELECT SUM(um.zeinukigaku) as um_kingaku, SUM(um.zeinukigaku - um.genkagaku) as arari, t.cd as t_cd, t.name as t_name, um.utiwake_kbn_cd as um_utiwake_kbn_cd
				FROM ShiiresakiMrs AS t
				LEFT JOIN ShiireDts AS u ON t.cd = u.shiiresaki_mr_cd
				LEFT JOIN ShiireMeisaiDts AS um ON u.id = um.shiire_dt_id
				WHERE (u.shiirebi >= ?0 AND u.shiirebi <= ?1" . ($setdts["torihikinasi_flg"] == 1 ? " OR u.shiirebi IS NULL" : "") . ")
					AND t.cd >= ?2 AND t.cd <= ?3" . ($setdts["jinyuuryoku_flg"] == 1 ? " AND u.creator = " . $this->getDI()->getSession()->get('auth')['id'] : "") . "
				GROUP BY t.cd, um.utiwake_kbn_cd
				ORDER BY t.cd" . ($setdts["koujun_flg"] == 1 ? " DESC" : "") . ", um.utiwake_kbn_cd
			";
            $rows = $mgr->executeQuery($phql, [0 => $setdts["kikan_from"], 1 => $setdts["kikan_to"], 2 => $setdts["hanni_from"], 3 => $setdts["hanni_to"]]);
            $to_midasi = ["仕入先コード", "仕入先名", "総仕入額", "返品額", "返品率", "値引額", "値引率", "その他", "純仕入額"];
            $utiwake_kbn_retu = ["10" => 2, "11" => 3, "12" => 5, "13" => 7, "14" => 8, "20" => 7, "21" => 7, "22" => 7, "23" => 7, "24" => 8, "30" => 7, "40" => 7, "41" => 7, "90" => 7]; // 加算する列番号を決める
            $junshiiregaku = 0; // 純仕入額
            $ararieki = 0; // 粗利益
            $toviews[0][0] = "　";
            $toviews[0][1] = "《総合計》";
            for ($i = 2; $i <= 8; $i++) {
                $toviews[0][$i] = 0;
            } // 合計行クリア
            $i = 0;
            foreach ($rows as $rw) {
                if ($rw->t_cd != $toviews[$i][0]) {
                    $toviews[$i][8] = $toviews[$i][2] + $toviews[$i][3] + $toviews[$i][5] + $toviews[$i][7]; // 純仕入額
                    if ($toviews[$i][2] != 0) {
                        $toviews[$i][4] = round(-100 * $toviews[$i][3] / $toviews[$i][2], 1); // 返品率
                        $toviews[$i][6] = round(-100 * $toviews[$i][5] / $toviews[$i][2], 1); // 値引率
                    }
                    //if ($toviews[$i][8] != 0) {
                    //	$toviews[$i][10] = round(100 * $toviews[$i][9] / $toviews[$i][8], 1); // 粗利率
                    //}
                    if (
                        $setdts["torihikiari_flg"] == 0
                        && $toviews[$i][2] == 0
                        && $toviews[$i][3] == 0
                        && $toviews[$i][5] == 0
                        && $toviews[$i][7] == 0
                    ) { // 取引有を除くなら、この行を潰す
                    } else {
                        $i++;
                    }
                    $toviews[$i][0] = $rw->t_cd; // 仕入先コード
                    $toviews[$i][1] = $rw->t_name; // 仕入先名
                    $toviews[$i][2] = 0; // 総仕入額
                    $toviews[$i][3] = 0; // 返品額
                    $toviews[$i][4] = 0; // 返品率
                    $toviews[$i][5] = 0; // 値引額
                    $toviews[$i][6] = 0; // 値引率
                    $toviews[$i][7] = 0; // その他
                    $toviews[$i][8] = 0; // 純仕入額
                    //$toviews[$i][9] = 0; // 粗利益
                    //$toviews[$i][10] = 0; // 粗利率
                }
                if ($rw->um_utiwake_kbn_cd) {
                    $toviews[$i][$utiwake_kbn_retu[$rw->um_utiwake_kbn_cd]] += $rw->um_kingaku;
                    if ($setdts["torihikiari_flg"] != 0) { // 取引有を除くなら加算しない
                        $toviews[0][$utiwake_kbn_retu[$rw->um_utiwake_kbn_cd]] += $rw->um_kingaku;
                    }
                }
                //$toviews[$i][9] += $rw->arari;
                //if ($setdts["torihikiari_flg"]!=0) { // 取引有を除くなら加算しない
                //	$toviews[0][9] += $rw->arari;
                //}
            }
            $toviews[$i][8] = $toviews[$i][2] + $toviews[$i][3] + $toviews[$i][5] + $toviews[$i][7]; // 純仕入額
            if ($toviews[$i][2] != 0) { // 最終行
                $toviews[$i][4] = round(-100 * $toviews[$i][3] / $toviews[$i][2], 1); // 返品率
                $toviews[$i][6] = round(-100 * $toviews[$i][5] / $toviews[$i][2], 1); // 値引率
            }
            //if ($toviews[$i][8] != 0) { // 最終行
            //	$toviews[$i][10] = round(100 * $toviews[$i][9] / $toviews[$i][8], 1); // 粗利率
            //}
            if ($toviews[0][2] != 0) { // 合計行
                $toviews[0][4] = round(-100 * $toviews[0][3] / $toviews[0][2], 1); // 返品率
                $toviews[0][6] = round(-100 * $toviews[0][5] / $toviews[0][2], 1); // 値引率
                $toviews[0][8] = $toviews[0][2] + $toviews[0][3] + $toviews[0][5] + $toviews[0][7]; // 純仕入額
            }
            //if ($toviews[0][8] != 0) { // 合計行
            //	$toviews[0][10] = round(100 * $toviews[0][9] / $toviews[0][8], 1); // 粗利率
            //}
            //$shousuus[10]=1;

        }
        $jouken_shiire_nippous = JoukenShiireNippous::find([
            "order" => "cd, sakusei_user_id", "conditions" => "sakusei_user_id IN(0, ?0)", "bind" => [0 => $this->getDI()->getSession()->get('auth')['id']]
        ]);
        $joukens = [];
        foreach ($jouken_shiire_nippous as $jouken_shiire_nippou) {
            $joukens[$jouken_shiire_nippou->cd] = $jouken_shiire_nippou->name;
        }
        $this->view->joukens = $joukens;

        $this->view->to_midasi = $to_midasi;
        $this->view->toviews = $toviews;
        $this->view->shousuus = $shousuus;
        return;
    }

    /**
     * 仕入月報
     */
    public function geppouAction()
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
        foreach ($setdts as $fld => $setdt) {
            $this->tag->setDefault($fld, $setdt);
        }

        $to_midasi = [];
        $toviews = [];
        $shousuus = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]; //金額なら0とりあえず14個
        $di = \Phalcon\DI::getDefault();
        $mgr = $di->get('modelsManager');

        if (substr($setdts["junjo_kbn_cd"], -2) == "01") { // 月度順の場合
            $phql = "
				SELECT SUM(um.zeinukigaku) as um_kingaku, SUM(um.zeinukigaku - um.genkagaku) as arari, DATE_FORMAT(u.shiirebi,'%Y-%m') as u_shiirebi, um.utiwake_kbn_cd as um_utiwake_kbn_cd,SUM(um.zeigaku) as zeigaku
				FROM ShiireMeisaiDts AS um
				LEFT JOIN ShiireDts AS u ON um.shiire_dt_id = u.id
				WHERE u.shiirebi >= ?0 AND u.shiirebi <= ?1
				GROUP BY DATE_FORMAT(u.shiirebi,'%Y%m'), um.utiwake_kbn_cd
				ORDER BY DATE_FORMAT(u.shiirebi,'%Y%m')" . ($setdts["koujun_flg"] == 1 ? " DESC" : "") . ", um.utiwake_kbn_cd
			";
            $rows = $mgr->executeQuery($phql, [0 => $setdts["kikan_from"], 1 => $setdts["kikan_to"]]);
            $to_midasi = ["", "日付", "総仕入額", "返品額", "返品率", "値引額", "値引率", "その他", "純仕入額", "税込額"];
            $utiwake_kbn_retu = ["10" => 2, "11" => 3, "12" => 5, "13" => 7, "14" => 8, "20" => 7, "21" => 7, "22" => 7, "23" => 7, "24" => 8, "30" => 7, "40" => 7, "41" => 7, "90" => 7]; // 加算する列番号を決める
            $zeigaku = 0;
            $toviews[0][0] = "";
            $toviews[0][1] = "《総合計》"; // 日付
            for ($i = 2; $i < count($to_midasi); $i++) {
                $toviews[0][$i] = 0;
            } // 合計行クリア
            $i = 0;
            foreach ($rows as $rw) {
                if ($rw->u_shiirebi != $toviews[$i][1]) {
                    $toviews[$i][8] = $toviews[$i][2] + $toviews[$i][3] + $toviews[$i][5] + $toviews[$i][7]; // 純仕入額
                    $toviews[$i][9] = $toviews[$i][8] + $zeigaku; // 税込
                    if ($toviews[$i][2] != 0) {
                        $toviews[$i][4] = round(-100 * $toviews[$i][3] / $toviews[$i][2], 1); // 返品率
                        $toviews[$i][6] = round(-100 * $toviews[$i][5] / $toviews[$i][2], 1); // 値引率
                    }
                    $i++;
                    $toviews[$i][1] = $rw->u_shiirebi; // 日付
                    $toviews[$i][0] = ""; // colspan
                    $toviews[$i][2] = 0; // 総仕入額
                    $toviews[$i][3] = 0; // 返品額
                    $toviews[$i][4] = 0; // 返品率
                    $toviews[$i][5] = 0; // 値引額
                    $toviews[$i][6] = 0; // 値引率
                    $toviews[$i][7] = 0; // その他
                    $toviews[$i][8] = 0; // 純仕入額
                    $toviews[$i][9] = 0; // 税込仕入額
                    $zeigaku = 0;
                }
                $toviews[$i][$utiwake_kbn_retu[$rw->um_utiwake_kbn_cd]] += $rw->um_kingaku;
                $toviews[0][$utiwake_kbn_retu[$rw->um_utiwake_kbn_cd]] += $rw->um_kingaku;
                $zeigaku += $rw->zeigaku;
            }
            $toviews[$i][8] = $toviews[$i][2] + $toviews[$i][3] + $toviews[$i][5] + $toviews[$i][7]; // 純仕入額
            $toviews[$i][9] = $toviews[$i][8] + $zeigaku;
            if ($toviews[$i][2] != 0) { // 最終行
                $toviews[$i][4] = round(-100 * $toviews[$i][3] / $toviews[$i][2], 1); // 返品率
                $toviews[$i][6] = round(-100 * $toviews[$i][5] / $toviews[$i][2], 1); // 値引率
            }
            $toviews[0][8] = $toviews[0][2] + $toviews[0][3] + $toviews[0][5] + $toviews[0][7]; // 純仕入額
            $toviews[0][9] = $toviews[0][8] + array_sum(array_column($rows->toArray(), 'zeigaku'));
            if ($toviews[0][2] != 0) { // 合計行
                $toviews[0][4] = round(-100 * $toviews[0][3] / $toviews[0][2], 1); // 返品率
                $toviews[0][6] = round(-100 * $toviews[0][5] / $toviews[0][2], 1); // 値引率
            }
        } else if (substr($setdts["junjo_kbn_cd"], -2) == "02") { // 仕入先順の場合
            $phql = "
				SELECT SUM(um.zeinukigaku) as um_kingaku, SUM(um.zeinukigaku - um.genkagaku) as arari, t.cd as t_cd, t.name as t_name, um.utiwake_kbn_cd as um_utiwake_kbn_cd,SUM(um.zeigaku) as zeigaku
				FROM ShiiresakiMrs AS t
				LEFT JOIN ShiireDts AS u ON t.cd = u.shiiresaki_mr_cd
				LEFT JOIN ShiireMeisaiDts AS um ON u.id = um.shiire_dt_id
				WHERE (u.shiirebi >= ?0 AND u.shiirebi <= ?1" . ($setdts["torihikinasi_flg"] == 1 ? " OR u.shiirebi IS NULL" : "") . ")
					AND t.cd >= ?2 AND t.cd <= ?3" . ($setdts["jinyuuryoku_flg"] == 1 ? " AND u.creator = " . $this->getDI()->getSession()->get('auth')['id'] : "") . "
				GROUP BY t.cd, um.utiwake_kbn_cd
				ORDER BY t.cd" . ($setdts["koujun_flg"] == 1 ? " DESC" : "") . ", um.utiwake_kbn_cd
			";
            $rows = $mgr->executeQuery($phql, [0 => $setdts["kikan_from"], 1 => $setdts["kikan_to"], 2 => $setdts["hanni_from"], 3 => $setdts["hanni_to"]]);
            $to_midasi = ["仕入先コード", "仕入先名", "総仕入額", "返品額", "返品率", "値引額", "値引率", "その他", "純仕入額", "税込額"];
            $utiwake_kbn_retu = ["10" => 2, "11" => 3, "12" => 5, "13" => 7, "14" => 8, "20" => 7, "21" => 7, "22" => 7, "23" => 7, "24" => 8, "30" => 7, "40" => 7, "41" => 7, "90" => 7]; // 加算する列番号を決める
            $zeigaku = 0;
            $toviews[0][0] = "　";
            $toviews[0][1] = "《総合計》";
            for ($i = 2; $i < count($to_midasi); $i++) {
                $toviews[0][$i] = 0;
            } // 合計行クリア
            $i = 0;
            foreach ($rows as $rw) {
                if ($rw->t_cd != $toviews[$i][0]) {
                    $toviews[$i][8] = $toviews[$i][2] + $toviews[$i][3] + $toviews[$i][5] + $toviews[$i][7]; // 純仕入額
                    $toviews[$i][9] = $toviews[$i][8] + $zeigaku; // 税込
                    if ($toviews[$i][2] != 0) {
                        $toviews[$i][4] = round(-100 * $toviews[$i][3] / $toviews[$i][2], 1); // 返品率
                        $toviews[$i][6] = round(-100 * $toviews[$i][5] / $toviews[$i][2], 1); // 値引率
                    }
                    if (
                        $setdts["torihikiari_flg"] == 0
                        && $toviews[$i][2] == 0
                        && $toviews[$i][3] == 0
                        && $toviews[$i][5] == 0
                        && $toviews[$i][7] == 0
                    ) { // 取引有を除くなら、この行を潰す
                    } else {
                        $i++;
                    }
                    $toviews[$i][0] = $rw->t_cd; // 仕入先コード
                    $toviews[$i][1] = $rw->t_name; // 仕入先名
                    $toviews[$i][2] = 0; // 総仕入額
                    $toviews[$i][3] = 0; // 返品額
                    $toviews[$i][4] = 0; // 返品率
                    $toviews[$i][5] = 0; // 値引額
                    $toviews[$i][6] = 0; // 値引率
                    $toviews[$i][7] = 0; // その他
                    $toviews[$i][8] = 0; // 純仕入額
                    $toviews[$i][9] = 0; // 税込仕入額
                    $zeigaku = 0;
                }
                if ($rw->um_utiwake_kbn_cd) {
                    $zeigaku += $rw->zeigaku;
                    $toviews[$i][$utiwake_kbn_retu[$rw->um_utiwake_kbn_cd]] += $rw->um_kingaku;
                    if ($setdts["torihikiari_flg"] != 0) { // 取引有を除くなら加算しない
                        $toviews[0][$utiwake_kbn_retu[$rw->um_utiwake_kbn_cd]] += $rw->um_kingaku;
                    }
                }
            }
            $toviews[$i][8] = $toviews[$i][2] + $toviews[$i][3] + $toviews[$i][5] + $toviews[$i][7]; // 純仕入額
            $toviews[$i][9] = $toviews[$i][8] + $zeigaku;
            if ($toviews[$i][2] != 0) { // 最終行
                $toviews[$i][4] = round(-100 * $toviews[$i][3] / $toviews[$i][2], 1); // 返品率
                $toviews[$i][6] = round(-100 * $toviews[$i][5] / $toviews[$i][2], 1); // 値引率
            }
            if ($toviews[0][2] != 0) { // 合計行
                $toviews[0][4] = round(-100 * $toviews[0][3] / $toviews[0][2], 1); // 返品率
                $toviews[0][6] = round(-100 * $toviews[0][5] / $toviews[0][2], 1); // 値引率
                $toviews[0][8] = $toviews[0][2] + $toviews[0][3] + $toviews[0][5] + $toviews[0][7]; // 純仕入額
                $toviews[0][9] = $toviews[0][8] + array_sum(array_column($rows->toArray(), 'zeigaku'));
            }
        } else if (substr($setdts["junjo_kbn_cd"], -2) == "10") { // 商品順の場合
            $phql = "
				SELECT SUM(um.zeinukigaku) as um_kingaku, SUM(um.zeinukigaku - um.genkagaku) as arari, t.cd as t_cd, t.name as t_name, um.utiwake_kbn_cd as um_utiwake_kbn_cd,SUM(um.zeigaku) as zeigaku
				FROM ShouhinMrs AS t
				LEFT JOIN ShiireMeisaiDts AS um ON t.cd = um.shouhin_mr_cd
				LEFT JOIN ShiireDts AS u ON u.id = um.shiire_dt_id
				WHERE (u.shiirebi >= ?0 AND u.shiirebi <= ?1" . ($setdts["torihikinasi_flg"] == 1 ? " OR u.shiirebi IS NULL" : "") . ")
					AND t.cd >= ?2 AND t.cd <= ?3" . ($setdts["jinyuuryoku_flg"] == 1 ? " AND u.creator = " . $this->getDI()->getSession()->get('auth')['id'] : "") . "
				GROUP BY t.cd, um.utiwake_kbn_cd
				ORDER BY t.cd" . ($setdts["koujun_flg"] == 1 ? " DESC" : "") . ", um.utiwake_kbn_cd
			";
            $rows = $mgr->executeQuery($phql, [0 => $setdts["kikan_from"], 1 => $setdts["kikan_to"], 2 => $setdts["hanni_from"], 3 => $setdts["hanni_to"]]);
            $to_midasi = ["商品コード", "商品名", "総仕入額", "返品額", "返品率", "値引額", "値引率", "その他", "純仕入額", "税込額"];
            $utiwake_kbn_retu = ["10" => 2, "11" => 3, "12" => 5, "13" => 7, "14" => 8, "20" => 7, "21" => 7, "22" => 7, "23" => 7, "24" => 8, "30" => 7, "40" => 7, "41" => 7, "90" => 7]; // 加算する列番号を決める
            $zeigaku = 0;
            $toviews[0][0] = "　";
            $toviews[0][1] = "《総合計》";
            for ($i = 2; $i < count($to_midasi); $i++) {
                $toviews[0][$i] = 0;
            } // 合計行クリア
            $i = 0;
            foreach ($rows as $rw) {
                if ($rw->t_cd != $toviews[$i][0]) {
                    $toviews[$i][8] = $toviews[$i][2] + $toviews[$i][3] + $toviews[$i][5] + $toviews[$i][7]; // 純仕入額
                    $toviews[$i][9] = $toviews[$i][8] + $zeigaku; // 税込
                    if ($toviews[$i][2] != 0) {
                        $toviews[$i][4] = round(-100 * $toviews[$i][3] / $toviews[$i][2], 1); // 返品率
                        $toviews[$i][6] = round(-100 * $toviews[$i][5] / $toviews[$i][2], 1); // 値引率
                    }
                    if (
                        $setdts["torihikiari_flg"] == 0
                        && $toviews[$i][2] == 0
                        && $toviews[$i][3] == 0
                        && $toviews[$i][5] == 0
                        && $toviews[$i][7] == 0
                    ) { // 取引有を除くなら、この行を潰す
                    } else {
                        $i++;
                    }
                    $toviews[$i][0] = $rw->t_cd; // 商品コード
                    $toviews[$i][1] = $rw->t_name; // 商品名
                    $toviews[$i][2] = 0; // 総仕入額
                    $toviews[$i][3] = 0; // 返品額
                    $toviews[$i][4] = 0; // 返品率
                    $toviews[$i][5] = 0; // 値引額
                    $toviews[$i][6] = 0; // 値引率
                    $toviews[$i][7] = 0; // その他
                    $toviews[$i][8] = 0; // 純仕入額
                    $toviews[$i][9] = 0; // 税込仕入額
                    $zeigaku = 0;
                }
                if ($rw->um_utiwake_kbn_cd) {
                    $zeigaku += $rw->zeigaku;
                    $toviews[$i][$utiwake_kbn_retu[$rw->um_utiwake_kbn_cd]] += $rw->um_kingaku;
                    if ($setdts["torihikiari_flg"] != 0) { // 取引有を除くなら加算しない
                        $toviews[0][$utiwake_kbn_retu[$rw->um_utiwake_kbn_cd]] += $rw->um_kingaku;
                    }
                }
            }
            $toviews[$i][8] = $toviews[$i][2] + $toviews[$i][3] + $toviews[$i][5] + $toviews[$i][7]; // 純仕入額
            $toviews[$i][9] = $toviews[$i][8] + $zeigaku;
            if ($toviews[$i][2] != 0) { // 最終行
                $toviews[$i][4] = round(-100 * $toviews[$i][3] / $toviews[$i][2], 1); // 返品率
                $toviews[$i][6] = round(-100 * $toviews[$i][5] / $toviews[$i][2], 1); // 値引率
            }
            if ($toviews[0][2] != 0) { // 合計行
                $toviews[0][4] = round(-100 * $toviews[0][3] / $toviews[0][2], 1); // 返品率
                $toviews[0][6] = round(-100 * $toviews[0][5] / $toviews[0][2], 1); // 値引率
                $toviews[0][8] = $toviews[0][2] + $toviews[0][3] + $toviews[0][5] + $toviews[0][7]; // 純仕入額
            }
        } else if (substr($setdts["junjo_kbn_cd"], -2) === "16") { // 担当順の場合
            if ($setdts["torihikinasi_flg"] != 1) {
                $phql = "
                    SELECT SUM(um.zeinukigaku) as um_kingaku, SUM(um.zeinukigaku - um.genkagaku) as arari, t.cd as t_cd, t.name as t_name, um.utiwake_kbn_cd as um_utiwake_kbn_cd,SUM(um.zeigaku) as zeigaku
                    FROM TantouMrs AS t
                    LEFT JOIN ShiireDts AS u ON t.cd = u.tantou_mr_cd
                    LEFT JOIN ShiireMeisaiDts AS um ON u.id = um.shiire_dt_id
                    WHERE (u.shiirebi >= ?0 AND u.shiirebi <= ?1" . ($setdts["torihikinasi_flg"] == 1 ? " OR u.shiirebi IS NULL" : "") . ")
                        AND t.cd >= ?2 AND t.cd <= ?3" . ($setdts["jinyuuryoku_flg"] == 1 ? " AND u.creator = " . $this->getDI()->getSession()->get('auth')['id'] : "") . "
                    GROUP BY t.cd, um.utiwake_kbn_cd
                    ORDER BY t.cd" . ($setdts["koujun_flg"] == 1 ? " DESC" : "") . ", um.utiwake_kbn_cd
                ";
                $rows = $mgr->executeQuery($phql, [0 => $setdts["kikan_from"], 1 => $setdts["kikan_to"], 2 => $setdts["hanni_from"], 3 => $setdts["hanni_to"]]);
            } else {
                // 期間内に取引が無い物を取得出来ていなかったため
                $db = \Phalcon\DI::getDefault()->get('db');
                $kikanFrom = $setdts['kikan_from'];
                $kikanTo = $setdts['kikan_to'];
                $hanniFrom = $setdts['hanni_from'];
                $hanniTo = $setdts['hanni_to'];
                $phql = "
                    select 
                        um_kingaku, 
                        arari, 
                        t.cd as t_cd, t.name as name,
                        um_utiwake_kbn_cd,
                        zeigaku
                    from tantou_mrs as t
                    left join (
                        select
                            sum(cc.zeinukigaku) as um_kingaku, 
                            sum(cc.zeinukigaku - cc.genkagaku) as arari, 
                            aa.cd as t_cd, aa.name as t_name,
                            cc.utiwake_kbn_cd as um_utiwake_kbn_cd,
                            sum(cc.zeigaku) as zeigaku
                        from tantou_mrs as aa
                        left join shiire_dts as bb on aa.cd = bb.tantou_mr_cd  
                        left join shiire_meisai_dts as cc on bb.id = cc.shiire_dt_id
                            where bb.shiirebi between '{$kikanFrom}' and '{$kikanTo}'
                            and aa.cd between '{$hanniFrom}' and '{$hanniTo}'
                            group by aa.cd, cc.utiwake_kbn_cd
                            order by aa.cd, cc.utiwake_kbn_cd
                        ) as sub on sub.t_cd = t.cd
                    ";
                $stmt = $db->prepare($phql);
                $stmt->execute();
                $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $to_midasi = ["担当コード", "担当者名", "総仕入額", "返品額", "返品率", "値引額", "値引率", "その他", "純仕入額", "税込額"];
                $utiwake_kbn_retu = ["10" => 2, "11" => 3, "12" => 5, "13" => 7, "14" => 8, "20" => 7, "21" => 7, "22" => 7, "23" => 7, "24" => 8, "30" => 7, "40" => 7, "41" => 7, "90" => 7, null => 2,]; // 加算する列番号を決める
                $zeigaku = 0;
                $toviews[0][0] = "　";
                $toviews[0][1] = "《総合計》";
                for ($i = 2; $i < count($to_midasi); $i++) {
                    $toviews[0][$i] = 0;
                }
                $i = 0;
                foreach ($rows as $rw) {
                    if ($rw['t_cd'] != $toviews[$i][0]) {
                        $toviews[$i][8] = $toviews[$i][2] + $toviews[$i][3] + $toviews[$i][5] + $toviews[$i][7];
                        $toviews[$i][9] = $toviews[$i][8] + $zeigaku; // 税込
                        if ($toviews[$i][2] != 0) {
                            $toviews[$i][4] = round(-100 * $toviews[$i][3] / $toviews[$i][2], 1);
                            $toviews[$i][6] = round(-100 * $toviews[$i][5] / $toviews[$i][2], 1);
                        }
                        if (
                            $setdts["torihikiari_flg"] == 0
                            && $toviews[$i][2] == 0
                            && $toviews[$i][3] == 0
                            && $toviews[$i][5] == 0
                            && $toviews[$i][7] == 0
                        ) {
                        } else {
                            $i++;
                        }
                        $toviews[$i][0] = $rw['t_cd'];
                        $toviews[$i][1] = $rw['name'];
                        $toviews[$i][2] = 0;
                        $toviews[$i][3] = 0;
                        $toviews[$i][4] = 0;
                        $toviews[$i][5] = 0;
                        $toviews[$i][6] = 0;
                        $toviews[$i][7] = 0;
                        $toviews[$i][8] = 0;
                        $toviews[$i][9] = 0; // 税込仕入額
                        $zeigaku = 0;
                    }
                    if ($rw['um_utiwake_kbn_cd']) {
                        $zeigaku += $rw->zeigaku;
                        $toviews[$i][$utiwake_kbn_retu[$rw->um_utiwake_kbn_cd]] += $rw['um_kingaku'];
                        if ($setdts["torihikiari_flg"] != 0) {
                            $toviews[0][$utiwake_kbn_retu[$rw['um_utiwake_kbn_cd']]] += $rw['um_kingaku'];
                        }
                    }
                }
                $toviews[$i][8] = $toviews[$i][2] + $toviews[$i][3] + $toviews[$i][5] + $toviews[$i][7];
                $toviews[$i][9] = $toviews[$i][8] + $zeigaku;
                if ($toviews[$i][2] != 0) { // 最終行
                    $toviews[$i][4] = round(-100 * $toviews[$i][3] / $toviews[$i][2], 1);
                    $toviews[$i][6] = round(-100 * $toviews[$i][5] / $toviews[$i][2], 1);
                }

                if ($toviews[0][2] != 0) { // 合計行
                    $toviews[0][4] = round(-100 * $toviews[0][3] / $toviews[0][2], 1);
                    $toviews[0][6] = round(-100 * $toviews[0][5] / $toviews[0][2], 1);
                    $toviews[0][8] = $toviews[0][2] + $toviews[0][3] + $toviews[0][5] + $toviews[0][7];
                }
                $jouken_shiire_geppous = JoukenShiireGeppous::find([
                    "order" => "cd, sakusei_user_id", "conditions" => "sakusei_user_id IN(0, ?0)", "bind" => [0 => $this->getDI()->getSession()->get('auth')['id']]
                ]);
                $joukens = [];
                foreach ($jouken_shiire_geppous as $jouken_shiire_geppou) {
                    $joukens[$jouken_shiire_geppou->cd] = $jouken_shiire_geppou->name;
                }
                $this->view->joukens = $joukens;
                $this->view->to_midasi = $to_midasi;
                $this->view->toviews = $toviews;
                $this->view->shousuus = $shousuus;
                return;
            }

            $to_midasi = ["担当コード", "担当者名", "総仕入額", "返品額", "返品率", "値引額", "値引率", "その他", "純仕入額", "税込額"];
            $utiwake_kbn_retu = ["10" => 2, "11" => 3, "12" => 5, "13" => 7, "14" => 8, "20" => 7, "21" => 7, "22" => 7, "23" => 7, "24" => 8, "30" => 7, "40" => 7, "41" => 7, "90" => 7]; // 加算する列番号を決める
            $zeigaku = 0;
            $toviews[0][0] = "　";
            $toviews[0][1] = "《総合計》";
            for ($i = 2; $i < count($to_midasi); $i++) {
                $toviews[0][$i] = 0;
            }
            $i = 0;
            foreach ($rows as $rw) {
                if ($rw->t_cd != $toviews[$i][0]) {
                    $toviews[$i][8] = $toviews[$i][2] + $toviews[$i][3] + $toviews[$i][5] + $toviews[$i][7];
                    $toviews[$i][9] = $toviews[$i][8] + $zeigaku; // 税込
                    if ($toviews[$i][2] != 0) {
                        $toviews[$i][4] = round(-100 * $toviews[$i][3] / $toviews[$i][2], 1);
                        $toviews[$i][6] = round(-100 * $toviews[$i][5] / $toviews[$i][2], 1);
                    }
                    if (
                        $setdts["torihikiari_flg"] == 0
                        && $toviews[$i][2] == 0
                        && $toviews[$i][3] == 0
                        && $toviews[$i][5] == 0
                        && $toviews[$i][7] == 0
                    ) {
                    } else {
                        $i++;
                    }
                    $toviews[$i][0] = $rw->t_cd;
                    $toviews[$i][1] = $rw->t_name;
                    $toviews[$i][2] = 0;
                    $toviews[$i][3] = 0;
                    $toviews[$i][4] = 0;
                    $toviews[$i][5] = 0;
                    $toviews[$i][6] = 0;
                    $toviews[$i][7] = 0;
                    $toviews[$i][8] = 0;
                    $toviews[$i][9] = 0; // 税込仕入額
                    $zeigaku = 0;
                }
                if ($rw->um_utiwake_kbn_cd) {
                    $zeigaku += $rw->zeigaku;
                    $toviews[$i][$utiwake_kbn_retu[$rw->um_utiwake_kbn_cd]] += $rw->um_kingaku;
                    if ($setdts["torihikiari_flg"] != 0) {
                        $toviews[0][$utiwake_kbn_retu[$rw->um_utiwake_kbn_cd]] += $rw->um_kingaku;
                    }
                }
            }
            $toviews[$i][8] = $toviews[$i][2] + $toviews[$i][3] + $toviews[$i][5] + $toviews[$i][7];
            $toviews[$i][9] = $toviews[$i][8] + $zeigaku;
            if ($toviews[$i][2] != 0) { // 最終行
                $toviews[$i][4] = round(-100 * $toviews[$i][3] / $toviews[$i][2], 1);
                $toviews[$i][6] = round(-100 * $toviews[$i][5] / $toviews[$i][2], 1);
            }

            if ($toviews[0][2] != 0) { // 合計行
                $toviews[0][4] = round(-100 * $toviews[0][3] / $toviews[0][2], 1);
                $toviews[0][6] = round(-100 * $toviews[0][5] / $toviews[0][2], 1);
                $toviews[0][8] = $toviews[0][2] + $toviews[0][3] + $toviews[0][5] + $toviews[0][7];
            }
        }
        $jouken_shiire_geppous = JoukenShiireGeppous::find([
            "order" => "cd, sakusei_user_id", "conditions" => "sakusei_user_id IN(0, ?0)", "bind" => [0 => $this->getDI()->getSession()->get('auth')['id']]
        ]);
        $joukens = [];
        foreach ($jouken_shiire_geppous as $jouken_shiire_geppou) {
            $joukens[$jouken_shiire_geppou->cd] = $jouken_shiire_geppou->name;
        }
        $this->view->joukens = $joukens;

        $this->view->to_midasi = $to_midasi;
        $this->view->toviews = $toviews;
        $this->view->shousuus = $shousuus;
        return;
    }

    /*
     * 仕入推移表
    */
    public function suiiAction()
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
            $setdts["junjo_kbn_cd"] = "2602"; // 仕入先別
            $setdts["koujun_flg"] = 0;
            $setdts["kikan_sitei_kbn_cd"] = "";
            $setdts["zeikomi_flg"] = 0;
            $setdts["meisaigyou_flg"] = 1;
            $setdts["goukeigyou_flg"] = 0;
            $setdts["jinyuuryoku_flg"] = 0;
            $setdts["torihikiari_flg"] = 1;
            $setdts["torihikinasi_flg"] = 0;
            $setdts["hokakei_flg"] = 0;
            $setdts["zennnen_flg"] = '0';

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
        $this->view->setdts = $setdts;

        list($year, $month, $day) = explode('-', $setdts["kikan_from"]);
        $junjo_kbn = JunjoKbns::findFirst(["conditions" => "cd = ?1", "bind" => ["1" => $setdts["junjo_kbn_cd"]]]);
        foreach ($setdts as $fld => $setdt) {
            $this->tag->setDefault($fld, $setdt);
        }
        $select = "SELECT ";
        $from = " FROM shiire_meisai_dts AS a
                LEFT JOIN shiire_dts AS b ON b.id = a.shiire_dt_id
                LEFT JOIN shiiresaki_mrs AS c ON c.cd = b.shiiresaki_mr_cd
                LEFT JOIN shouhin_mrs AS d ON d.cd = a.shouhin_mr_cd
                LEFT JOIN tantou_mrs AS e ON e.cd = b.tantou_mr_cd";
        $where = " WHERE ";
        $group = " GROUP BY ";
        $order = "";
        switch ($setdts["junjo_kbn_cd"]) {
            case '2601':    //年度別
                $select .= "b.nendo AS 'key',null AS 'key_name',";
                $group .= "b.nendo";
                $where = '';
                break;
            case '2602':    //仕入先別
                $select .= "b.shiiresaki_mr_cd AS 'key',c.name AS 'key_name',";
                $group .= "b.shiiresaki_mr_cd,c.name";
                $where .= "b.shiiresaki_mr_cd BETWEEN '" . $setdts['hanni_from'] . "' AND '" . $setdts['hanni_to'] . "'";
                if ($setdts['koujun_flg'] === '1') {
                    $order = " ORDER BY b.shiiresaki_mr_cd DESC";
                } else {
                    $order = " ORDER BY b.shiiresaki_mr_cd ASC";
                }
                break;
            case '2603':    //商品別
                $select .= "a.shouhin_mr_cd AS 'key',d.name AS 'key_name',";
                $group .= "a.shouhin_mr_cd,d.name";
                $where .= "a.shouhin_mr_cd BETWEEN '" . $setdts['hanni_from'] . "' AND '" . $setdts['hanni_to'] . "'";
                if ($setdts['koujun_flg'] === '1') {
                    $order = " ORDER BY a.shouhin_mr_cd DESC";
                } else {
                    $order = " ORDER BY a.shouhin_mr_cd ASC";
                }
                break;
            case '2604':    //担当者別
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
            case '0':   //順仕入額
                $select .= "
                    SUM(if (date_format(b.shiirebi, '%Y%m')='" . $year . sprintf('%02d', $month) . "', a.kingaku, 0)) AS '1',
                    SUM(if (date_format(b.shiirebi, '%Y%m')='" . (((int)$month + 1 > 12) ? ((int)$year + 1) : $year) . sprintf('%02d', (((int)$month + 1 > 12) ? ((int)$month + 1 - 12) : ((int)$month + 1))) . "', a.kingaku, 0)) AS '2',
                    SUM(if (date_format(b.shiirebi, '%Y%m')='" . (((int)$month + 2 > 12) ? ((int)$year + 1) : $year) . sprintf('%02d', (((int)$month + 2 > 12) ? ((int)$month + 2 - 12) : ((int)$month + 2))) . "', a.kingaku, 0)) AS '3',
                    SUM(if (date_format(b.shiirebi, '%Y%m')='" . (((int)$month + 3 > 12) ? ((int)$year + 1) : $year) . sprintf('%02d', (((int)$month + 3 > 12) ? ((int)$month + 3 - 12) : ((int)$month + 3))) . "', a.kingaku, 0)) AS '4',
                    SUM(if (date_format(b.shiirebi, '%Y%m')='" . (((int)$month + 4 > 12) ? ((int)$year + 1) : $year) . sprintf('%02d', (((int)$month + 4 > 12) ? ((int)$month + 4 - 12) : ((int)$month + 4))) . "', a.kingaku, 0)) AS '5',
                    SUM(if (date_format(b.shiirebi, '%Y%m')='" . (((int)$month + 5 > 12) ? ((int)$year + 1) : $year) . sprintf('%02d', (((int)$month + 5 > 12) ? ((int)$month + 5 - 12) : ((int)$month + 5))) . "', a.kingaku, 0)) AS '6',
                    SUM(if (date_format(b.shiirebi, '%Y%m')='" . (((int)$month + 6 > 12) ? ((int)$year + 1) : $year) . sprintf('%02d', (((int)$month + 6 > 12) ? ((int)$month + 6 - 12) : ((int)$month + 6))) . "', a.kingaku, 0)) AS '7',
                    SUM(if (date_format(b.shiirebi, '%Y%m')='" . (((int)$month + 7 > 12) ? ((int)$year + 1) : $year) . sprintf('%02d', (((int)$month + 7 > 12) ? ((int)$month + 7 - 12) : ((int)$month + 7))) . "', a.kingaku, 0)) AS '8',
                    SUM(if (date_format(b.shiirebi, '%Y%m')='" . (((int)$month + 8 > 12) ? ((int)$year + 1) : $year) . sprintf('%02d', (((int)$month + 8 > 12) ? ((int)$month + 8 - 12) : ((int)$month + 8))) . "', a.kingaku, 0)) AS '9',
                    SUM(if (date_format(b.shiirebi, '%Y%m')='" . (((int)$month + 9 > 12) ? ((int)$year + 1) : $year) . sprintf('%02d', (((int)$month + 9 > 12) ? ((int)$month + 9 - 12) : ((int)$month + 9))) . "', a.kingaku, 0)) AS '10',
                    SUM(if (date_format(b.shiirebi, '%Y%m')='" . (((int)$month + 10 > 12) ? ((int)$year + 1) : $year) . sprintf('%02d', (((int)$month + 10 > 12) ? ((int)$month + 10 - 12) : ((int)$month + 11))) . "', a.kingaku, 0)) AS '11',
                    SUM(if (date_format(b.shiirebi, '%Y%m')='" . (((int)$month + 11 > 12) ? ((int)$year + 1) : $year) . sprintf('%02d', (((int)$month + 11 > 12) ? ((int)$month + 11 - 12) : ((int)$month + 11))) . "', a.kingaku, 0)) AS '12'
                ";
                break;
            case '2':   //仕入数
                $select .= "
                    SUM(if (date_format(b.shiirebi, '%Y%m')='" . $year . sprintf('%02d', $month) . "', a.suuryou, 0)) AS '1',
                    SUM(if (date_format(b.shiirebi, '%Y%m')='" . (((int)$month + 1 > 12) ? ((int)$year + 1) : $year) . sprintf('%02d', (((int)$month + 1 > 12) ? ((int)$month + 1 - 12) : ((int)$month + 1))) . "', a.suuryou, 0)) AS '2',
                    SUM(if (date_format(b.shiirebi, '%Y%m')='" . (((int)$month + 2 > 12) ? ((int)$year + 1) : $year) . sprintf('%02d', (((int)$month + 2 > 12) ? ((int)$month + 2 - 12) : ((int)$month + 2))) . "', a.suuryou, 0)) AS '3',
                    SUM(if (date_format(b.shiirebi, '%Y%m')='" . (((int)$month + 3 > 12) ? ((int)$year + 1) : $year) . sprintf('%02d', (((int)$month + 3 > 12) ? ((int)$month + 3 - 12) : ((int)$month + 3))) . "', a.suuryou, 0)) AS '4',
                    SUM(if (date_format(b.shiirebi, '%Y%m')='" . (((int)$month + 4 > 12) ? ((int)$year + 1) : $year) . sprintf('%02d', (((int)$month + 4 > 12) ? ((int)$month + 4 - 12) : ((int)$month + 4))) . "', a.suuryou, 0)) AS '5',
                    SUM(if (date_format(b.shiirebi, '%Y%m')='" . (((int)$month + 5 > 12) ? ((int)$year + 1) : $year) . sprintf('%02d', (((int)$month + 5 > 12) ? ((int)$month + 5 - 12) : ((int)$month + 5))) . "', a.suuryou, 0)) AS '6',
                    SUM(if (date_format(b.shiirebi, '%Y%m')='" . (((int)$month + 6 > 12) ? ((int)$year + 1) : $year) . sprintf('%02d', (((int)$month + 6 > 12) ? ((int)$month + 6 - 12) : ((int)$month + 6))) . "', a.suuryou, 0)) AS '7',
                    SUM(if (date_format(b.shiirebi, '%Y%m')='" . (((int)$month + 7 > 12) ? ((int)$year + 1) : $year) . sprintf('%02d', (((int)$month + 7 > 12) ? ((int)$month + 7 - 12) : ((int)$month + 7))) . "', a.suuryou, 0)) AS '8',
                    SUM(if (date_format(b.shiirebi, '%Y%m')='" . (((int)$month + 8 > 12) ? ((int)$year + 1) : $year) . sprintf('%02d', (((int)$month + 8 > 12) ? ((int)$month + 8 - 12) : ((int)$month + 8))) . "', a.suuryou, 0)) AS '9',
                    SUM(if (date_format(b.shiirebi, '%Y%m')='" . (((int)$month + 9 > 12) ? ((int)$year + 1) : $year) . sprintf('%02d', (((int)$month + 9 > 12) ? ((int)$month + 9 - 12) : ((int)$month + 9))) . "', a.suuryou, 0)) AS '10',
                    SUM(if (date_format(b.shiirebi, '%Y%m')='" . (((int)$month + 10 > 12) ? ((int)$year + 1) : $year) . sprintf('%02d', (((int)$month + 10 > 12) ? ((int)$month + 10 - 12) : ((int)$month + 10))) . "', a.suuryou, 0)) AS '11',
                    SUM(if (date_format(b.shiirebi, '%Y%m')='" . (((int)$month + 11 > 12) ? ((int)$year + 1) : $year) . sprintf('%02d', (((int)$month + 11 > 12) ? ((int)$month + 11 - 12) : ((int)$month + 11))) . "', a.suuryou, 0)) AS '12'
                ";
                break;
            case '3':   //仕入量
                $select .= "
                    SUM(if (date_format(b.shiirebi, '%Y%m')='" . $year . sprintf('%02d', $month) . "', a.suuryou, 0)) AS '1',
                    SUM(if (date_format(b.shiirebi, '%Y%m')='" . (((int)$month + 1 > 12) ? ((int)$year + 1) : $year) . sprintf('%02d', (((int)$month + 1 > 12) ? ((int)$month + 1 - 12) : ((int)$month + 1))) . "', a.suuryou2, 0)) AS '2',
                    SUM(if (date_format(b.shiirebi, '%Y%m')='" . (((int)$month + 2 > 12) ? ((int)$year + 1) : $year) . sprintf('%02d', (((int)$month + 2 > 12) ? ((int)$month + 2 - 12) : ((int)$month + 2))) . "', a.suuryou2, 0)) AS '3',
                    SUM(if (date_format(b.shiirebi, '%Y%m')='" . (((int)$month + 3 > 12) ? ((int)$year + 1) : $year) . sprintf('%02d', (((int)$month + 3 > 12) ? ((int)$month + 3 - 12) : ((int)$month + 3))) . "', a.suuryou2, 0)) AS '4',
                    SUM(if (date_format(b.shiirebi, '%Y%m')='" . (((int)$month + 4 > 12) ? ((int)$year + 1) : $year) . sprintf('%02d', (((int)$month + 4 > 12) ? ((int)$month + 4 - 12) : ((int)$month + 4))) . "', a.suuryou2, 0)) AS '5',
                    SUM(if (date_format(b.shiirebi, '%Y%m')='" . (((int)$month + 5 > 12) ? ((int)$year + 1) : $year) . sprintf('%02d', (((int)$month + 5 > 12) ? ((int)$month + 5 - 12) : ((int)$month + 5))) . "', a.suuryou2, 0)) AS '6',
                    SUM(if (date_format(b.shiirebi, '%Y%m')='" . (((int)$month + 6 > 12) ? ((int)$year + 1) : $year) . sprintf('%02d', (((int)$month + 6 > 12) ? ((int)$month + 6 - 12) : ((int)$month + 6))) . "', a.suuryou2, 0)) AS '7',
                    SUM(if (date_format(b.shiirebi, '%Y%m')='" . (((int)$month + 7 > 12) ? ((int)$year + 1) : $year) . sprintf('%02d', (((int)$month + 7 > 12) ? ((int)$month + 7 - 12) : ((int)$month + 7))) . "', a.suuryou2, 0)) AS '8',
                    SUM(if (date_format(b.shiirebi, '%Y%m')='" . (((int)$month + 8 > 12) ? ((int)$year + 1) : $year) . sprintf('%02d', (((int)$month + 8 > 12) ? ((int)$month + 8 - 12) : ((int)$month + 8))) . "', a.suuryou2, 0)) AS '9',
                    SUM(if (date_format(b.shiirebi, '%Y%m')='" . (((int)$month + 9 > 12) ? ((int)$year + 1) : $year) . sprintf('%02d', (((int)$month + 9 > 12) ? ((int)$month + 9 - 12) : ((int)$month + 9))) . "', a.suuryou2, 0)) AS '10',
                    SUM(if (date_format(b.shiirebi, '%Y%m')='" . (((int)$month + 10 > 12) ? ((int)$year + 1) : $year) . sprintf('%02d', (((int)$month + 10 > 12) ? ((int)$month + 10 - 12) : ((int)$month + 10))) . "', a.suuryou2, 0)) AS '11',
                    SUM(if (date_format(b.shiirebi, '%Y%m')='" . (((int)$month + 11 > 12) ? ((int)$year + 1) : $year) . sprintf('%02d', (((int)$month + 11 > 12) ? ((int)$month + 11 - 12) : ((int)$month + 11))) . "', a.suuryou2, 0)) AS '12'
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

        $jouken_shiire_suiis = JoukenShiireSuiis::find([
            "order" => "cd, sakusei_user_id", "conditions" => "sakusei_user_id IN(0, ?0)", "bind" => [0 => $this->getDI()->getSession()->get('auth')['id']]
        ]);
        $joukens = [];
        foreach ($jouken_shiire_suiis as $jouken_shiire_suii) {
            $joukens[$jouken_shiire_suii->cd] = $jouken_shiire_suii->name;
        }
        $this->view->joukens = $joukens;
        return;
    }

    /*
     * 仕入順位表
     */
    public function juniAction()
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
                SUM(z.suuryou1) AS sou_suuryou1,
                SUM(z.suuryou2) AS sou_suuryou2
                FROM shiire_meisai_dts AS z
                WHERE z.utiwake_kbn_cd <> '21'
                ";
        $from = " FROM shiire_dts AS a
                  LEFT JOIN	shiire_meisai_dts AS b ON b.shiire_dt_id = a.id
                  LEFT JOIN shouhin_mrs AS c ON c.cd = b.shouhin_mr_cd
                  LEFT JOIN	shiiresaki_mrs AS d ON d.cd = a.shiiresaki_mr_cd
                  LEFT JOIN tantou_mrs AS e ON e.cd = a.tantou_mr_cd
                  ";
        $where = " WHERE ";
        $group = " GROUP BY ";
        $order = " ORDER BY kingaku DESC";
        if (!$this->request->isPost()) {
            foreach ($post_flds as $post_fld) {
                $setdts[$post_fld] = "";
            }
            $setdts["cd"] = "01";
            $setdts["hyouji_kbn"] = '0';
            $setdts["junjo_kbn_cd"] = "2702"; // 仕入先別
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
            $setdts['hanni_from'] = ShiiresakiMrs::minimum(["column" => "cd",]);
            $setdts['hanni_to'] = ShiiresakiMrs::maximum(["column" => "cd",]);
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
            case '2701':    //月度別
                $select .= "DATE_FORMAT(a.shiirebi,'%Y-%m') as s_shiirebi AS 'key',null AS 'key_name',";
                $group .= "DATE_FORMAT(a.shiirebi,'%Y-%m')";
                $where = '';
                break;
            case '2702':    //仕入先別
                $select .= "a.shiiresaki_mr_cd AS 'key',d.name AS 'key_name',";
                $group .= "a.shiiresaki_mr_cd,d.name";
                $where .= "a.shiiresaki_mr_cd BETWEEN '" . $setdts['hanni_from'] . "' AND '" . $setdts['hanni_to'] . "'";
                break;
            case '2710':    //商品別
                $select .= "b.shouhin_mr_cd AS 'key',c.name AS 'key_name',";
                $group .= "b.shouhin_mr_cd,c.name";
                $where .= "b.shouhin_mr_cd BETWEEN '" . $setdts['hanni_from'] . "' AND '" . $setdts['hanni_to'] . "'";
                break;
            case '2716':    //担当者別
                $select .= "a.tantou_mr_cd AS 'key',e.name AS 'key_name',";
                $group .= "a.tantou_mr_cd,e.name";
                $where .= "a.tantou_mr_cd BETWEEN '" . $setdts['hanni_from'] . "' AND '" . $setdts['hanni_to'] . "'";
                break;
        }
        if ($setdts['koujun_flg'] === '1') {
            $order = " ORDER BY kingaku ASC";
        } else {
            $order = " ORDER BY kingaku DESC";
        }
        switch ($setdts['hyouji_kbn']) {
            case '0':   //順仕入金額
                $select .= "
                    SUM(b.kingaku) AS kingaku,
                    SUM(b.suuryou1) AS suuryou1,
                    sum(b.suuryou2) AS suuryou2
                ";
                break;
        }
        if ($where === '') {
            $where = "WHERE b.utiwake_kbn_cd <> '21' AND (a.shiirebi BETWEEN '" . $setdts['kikan_from'] . "' AND '" . $setdts['kikan_to'] . "')";
        } else {
            $where .= " AND b.utiwake_kbn_cd <> '21' AND (a.shiirebi BETWEEN '" . $setdts['kikan_from'] . "' AND '" . $setdts['kikan_to'] . "')";
        }
        $stmt = $db->prepare($select . $from . $where . $group . $union_select . $order);
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
                $zennen_suuryou1 = 0;
                $zennen_suuryou2 = 0;
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
                            $zennen_suuryou1 += (int)$zennen_rows[$j]['suuryou1'];
                            $zennen_suuryou2 += (int)$zennen_rows[$j]['suuryou2'];
                            $row++;
                            break;
                        }
                    }
                }
                $rows = $data;
                $this->view->zennen_kingaku = $zennen_kingaku;
                $this->view->zennen_suuryou1 = $zennen_suuryou1;
                $this->view->zennen_suuryou2 = $zennen_suuryou2;
            } else {
                $this->view->zennen_nasi = count($zennen_rows);
            }
        }

        $this->view->rows = $rows;
        $this->view->setdts = $setdts;

        $jouken_shiire_junis = JoukenShiireJunis::find([
            "order" => "cd, sakusei_user_id", "conditions" => "sakusei_user_id IN(0, ?0)", "bind" => [0 => $this->getDI()->getSession()->get('auth')['id']]
        ]);
        $joukens = [];
        foreach ($jouken_shiire_junis as $jouken_shiire_juni) {
            $joukens[$jouken_shiire_juni->cd] = $jouken_shiire_juni->name;
        }
        $this->view->joukens = $joukens;
        return;
    }

    /*
    * 売上分析表 Add By Nishiyama
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
            $setdts['junjo_kbn_cd'] = '2802';   //仕入先
            $setdts['hanni_from'] = ShiiresakiMrs::minimum(["column" => "cd",]);
            $setdts['hanni_to'] = ShiiresakiMrs::maximum(["column" => "cd",]);
            $setdts['junjo2_kbn_cd'] = '2810';  //商品コード
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
        if ($setdts['junjo_kbn_cd'] === '') {
            $setdts['junjo_kbn_cd'] = '2802';   //仕入先
            $setdts['hanni_from'] = ShiiresakiMrs::minimum(["column" => "cd",]);
            $setdts['hanni_to'] = ShiiresakiMrs::maximum(["column" => "cd",]);
            $setdts['junjo2_kbn_cd'] = '2810';  //商品コード
            $setdts['hanni2_from'] = ShouhinMrs::minimum(["column" => "cd",]);
            $setdts['hanni2_to'] = ShouhinMrs::maximum(["column" => "cd",]);
            $setdts['koujun_flg'] = '0';
            $setdts['meisaigyou_flg'] = '1';
            $setdts['goukeigyou_flg'] = '0';
            $setdts['torihikiari_flg'] = '1';
            $setdts['torihikinashi_flg'] = '1';
        }

        if ($setdts['junjo_kbn_cd'] === $setdts['junjo2_kbn_cd']) $this->view->rows = [];
        $where = " WHERE (b.shiirebi BETWEEN '{$setdts['kikan_from']}' AND '{$setdts['kikan_to']}') ";
        switch ($setdts['junjo_kbn_cd']) {
            case '2802': //仕入先
                $select = "SELECT b.shiiresaki_mr_cd AS key1,c.name AS key1name,";
                $join1 = " LEFT OUTER JOIN shiiresaki_mrs AS c ON c.cd = b.shiiresaki_mr_cd ";
                $where .= " AND (b.shiiresaki_mr_cd BETWEEN '{$setdts['hanni_from']}' AND '{$setdts['hanni_to']}') ";
                break;
            case '2803': //仕入先分類１
                $select = "SELECT zz.cd AS key1,zz.name AS key1name,";
                $join1 = " LEFT OUTER JOIN shiiresaki_mrs AS c ON c.cd = b.shiiresaki_mr_cd
                           LEFT OUTER JOIN shiiresaki_bunrui1_kbns AS zz ON zz.cd = c.shiiresaki_bunrui1_kbn_cd ";
                $where .= " AND (zz.cd BETWEEN '{$setdts['hanni_from']}' AND '{$setdts['hanni_to']}') ";
                break;
            case '2804': //仕入先分類2
                $select = "SELECT zz.cd AS key1,zz.name AS key1name,";
                $join1 = " LEFT OUTER JOIN shiiresaki_mrs AS c ON c.cd = b.shiiresaki_mr_cd
                           LEFT OUTER JOIN shiiresaki_bunrui2_kbns AS zz ON zz.cd = c.shiiresaki_bunrui2_kbn_cd ";
                $where .= " AND (zz.cd BETWEEN '{$setdts['hanni_from']}' AND '{$setdts['hanni_to']}') ";
                break;
            case '2805': //仕入先分類3
                $select = "SELECT zz.cd AS key1,zz.name AS key1name,";
                $join1 = " LEFT OUTER JOIN shiiresaki_mrs AS c ON c.cd = b.shiiresaki_mr_cd
                           LEFT OUTER JOIN shiiresaki_bunrui3_kbns AS zz ON zz.cd = c.shiiresaki_bunrui3_kbn_cd ";
                $where .= " AND (zz.cd BETWEEN '{$setdts['hanni_from']}' AND '{$setdts['hanni_to']}') ";
                break;
            case '2806': //仕入先分類4
                $select = "SELECT zz.cd AS key1,zz.name AS key1name,";
                $join1 = " LEFT OUTER JOIN shiiresaki_mrs AS c ON c.cd = b.shiiresaki_mr_cd
                           LEFT OUTER JOIN shiiresaki_bunrui4_kbns AS zz ON zz.cd = c.shiiresaki_bunrui4_kbn_cd ";
                $where .= " AND (zz.cd BETWEEN '{$setdts['hanni_from']}' AND '{$setdts['hanni_to']}') ";
                break;
            case '2807': //仕入先分類5
                $select = "SELECT zz.cd AS key1,zz.name AS key1name,";
                $join1 = " LEFT OUTER JOIN shiiresaki_mrs AS c ON c.cd = b.shiiresaki_mr_cd
                           LEFT OUTER JOIN shiiresaki_bunrui5_kbns AS zz ON zz.cd = c.shiiresaki_bunrui5_kbn_cd ";
                $where .= " AND (zz.cd BETWEEN '{$setdts['hanni_from']}' AND '{$setdts['hanni_to']}') ";
                break;
            case '2808': //担当者
                $select = "SELECT b.tantou_mr_cd AS key1,c.name AS key1name,";
                $join1 = " LEFT OUTER JOIN tantou_mrs AS c ON c.cd = b.tantou_mr_cd ";
                $where .= " AND (b.tantou_mr_cd BETWEEN '{$setdts['hanni_from']}' AND '{$setdts['hanni_to']}') ";
                break;
            case '2810': //商品
                $select = "SELECT a.shouhin_mr_cd AS key1,c.name AS key1name,";
                $join1 = " LEFT OUTER JOIN shouhin_mrs AS c ON c.cd = a.shouhin_mr_cd ";
                $where .= " AND (a.shouhin_mr_cd BETWEEN '{$setdts['hanni_from']}' AND '{$setdts['hanni_to']}') ";
                break;
            case '2811': //商品分類１
                $select = "SELECT zz.cd AS key1,zz.name AS key1name,";
                $join1 = " LEFT OUTER JOIN shouhin_mrs AS c ON c.cd = a.shouhin_mr_cd
                           LEFT OUTER JOIN shouhin_bunrui1_kbns AS zz ON zz.cd = c.shouhin_bunrui1_kbn_cd ";
                $where .= " AND (zz.cd BETWEEN '{$setdts['hanni_from']}' AND '{$setdts['hanni_to']}') ";
                break;
            case '2812': //商品分類2
                $select = "SELECT zz.cd AS key1,zz.name AS key1name,";
                $join1 = " LEFT OUTER JOIN shouhin_mrs AS c ON c.cd = a.shouhin_mr_cd
                           LEFT OUTER JOIN shouhin_bunrui2_kbns AS zz ON zz.cd = c.shouhin_bunrui2_kbn_cd ";
                $where .= " AND (zz.cd BETWEEN '{$setdts['hanni_from']}' AND '{$setdts['hanni_to']}') ";
                break;
            case '2813': //商品分類3
                $select = "SELECT zz.cd AS key1,zz.name AS key1name,";
                $join1 = " LEFT OUTER JOIN shouhin_mrs AS c ON c.cd = a.shouhin_mr_cd
                           LEFT OUTER JOIN shouhin_bunrui3_kbns AS zz ON zz.cd = c.shouhin_bunrui3_kbn_cd ";
                $where .= " AND (zz.cd BETWEEN '{$setdts['hanni_from']}' AND '{$setdts['hanni_to']}') ";
                break;
            case '2814': //商品分類4
                $select = "SELECT zz.cd AS key1,zz.name AS key1name,";
                $join1 = " LEFT OUTER JOIN shouhin_mrs AS c ON c.cd = a.shouhin_mr_cd
                           LEFT OUTER JOIN shouhin_bunrui4_kbns AS zz ON zz.cd = c.shouhin_bunrui4_kbn_cd ";
                $where .= " AND (zz.cd BETWEEN '{$setdts['hanni_from']}' AND '{$setdts['hanni_to']}') ";
                break;
            case '2815': //商品分類5
                $select = "SELECT zz.cd AS key1,zz.name AS key1name,";
                $join1 = " LEFT OUTER JOIN shouhin_mrs AS c ON c.cd = a.shouhin_mr_cd
                           LEFT OUTER JOIN shouhin_bunrui5_kbns AS zz ON zz.cd = c.shouhin_bunrui5_kbn_cd ";
                $where .= " AND (zz.cd BETWEEN '{$setdts['hanni_from']}' AND '{$setdts['hanni_to']}') ";
                break;
            case '2816': //プロジェクトコード
                $select = "SELECT zz.cd AS key1,zz.name AS key1name,a.iro AS iro,";
                $join1 = " LEFT OUTER JOIN project_mrs AS zz ON zz.cd = a.project_mr_cd ";
                $where .= " AND (zz.cd BETWEEN '{$setdts['hanni_from']}' AND '{$setdts['hanni_to']}') ";
                break;
        }
        switch ($setdts['junjo2_kbn_cd']) {
            case '2802': //仕入先
                $field = "b.shiiresaki_mr_cd AS key2,d.name AS key2name,";
                $join2 = " LEFT OUTER JOIN shiiresaki_mrs AS d ON d.cd = b.shiiresaki_mr_cd ";
                $where .= " AND (b.shiiresaki_mr_cd BETWEEN '{$setdts['hanni2_from']}' AND '{$setdts['hanni2_to']}') ";
                break;
            case '2803': //仕入先分類１
                $field = "yy.cd AS key2,yy.name AS key2name,";
                $join2 = " LEFT OUTER JOIN shiiresaki_mrs AS d ON d.cd = b.shiiresaki_mr_cd
                           LEFT OUTER JOIN shiiresaki_bunrui1_kbns AS yy ON yy.cd = d.shiiresaki_bunrui1_kbn_cd ";
                $where .= " AND (yy.cd BETWEEN '{$setdts['hanni2_from']}' AND '{$setdts['hanni2_to']}') ";
                break;
            case '2804': //仕入先分類2
                $field = "yy.cd AS key2,yy.name AS key2name,";
                $join2 = " LEFT OUTER JOIN shiiresaki_mrs AS d ON d.cd = b.shiiresaki_mr_cd
                           LEFT OUTER JOIN shiiresaki_bunrui2_kbns AS yy ON yy.cd = d.shiiresaki_bunrui2_kbn_cd ";
                $where .= " AND (yy.cd BETWEEN '{$setdts['hanni2_from']}' AND '{$setdts['hanni2_to']}') ";
                break;
            case '2805': //仕入先分類3
                $field = "yy.cd AS key2,yy.name AS key2name,";
                $join2 = " LEFT OUTER JOIN shiiresaki_mrs AS d ON d.cd = b.shiiresaki_mr_cd
                           LEFT OUTER JOIN shiiresaki_bunrui3_kbns AS yy ON yy.cd = d.shiiresaki_bunrui3_kbn_cd ";
                $where .= " AND (yy.cd BETWEEN '{$setdts['hanni2_from']}' AND '{$setdts['hanni2_to']}') ";
                break;
            case '2806': //仕入先分類4
                $field = "yy.cd AS key2,yy.name AS key2name,";
                $join2 = " LEFT OUTER JOIN shiiresaki_mrs AS d ON d.cd = b.shiiresaki_mr_cd
                           LEFT OUTER JOIN shiiresaki_bunrui4_kbns AS yy ON yy.cd = d.shiiresaki_bunrui4_kbn_cd ";
                $where .= " AND (yy.cd BETWEEN '{$setdts['hanni2_from']}' AND '{$setdts['hanni2_to']}') ";
                break;
            case '2807': //仕入先分類5
                $field = "yy.cd AS key2,yy.name AS key2name,";
                $join2 = " LEFT OUTER JOIN shiiresaki_mrs AS d ON d.cd = b.shiiresaki_mr_cd
                           LEFT OUTER JOIN shiiresaki_bunrui5_kbns AS yy ON yy.cd = d.shiiresaki_bunrui5_kbn_cd ";
                $where .= " AND (yy.cd BETWEEN '{$setdts['hanni2_from']}' AND '{$setdts['hanni2_to']}') ";
                break;
            case '2808': //担当者
                $field = "b.tantou_mr_cd AS key2,d.name AS key2name,";
                $join2 = " LEFT OUTER JOIN tantou_mrs AS d ON d.cd = b.tantou_mr_cd ";
                $where .= " AND (b.tantou_mr_cd BETWEEN '{$setdts['hanni2_from']}' AND '{$setdts['hanni2_to']}') ";
                break;
            case '2810': //商品
                $field = "a.shouhin_mr_cd AS key2,d.name AS key2name,";
                $join2 = " LEFT OUTER JOIN shouhin_mrs AS d ON d.cd = a.shouhin_mr_cd ";
                $where .= " AND (a.shouhin_mr_cd BETWEEN '{$setdts['hanni2_from']}' AND '{$setdts['hanni2_to']}') ";
                break;
            case '2811': //商品分類１
                $field = "yy.cd AS key2,yy.name AS key2name,";
                $join2 = " LEFT OUTER JOIN shouhin_mrs AS d ON d.cd = a.shouhin_mr_cd
                           LEFT OUTER JOIN shouhin_bunrui1_kbns AS yy ON zz.cd = d.shouhin_bunrui1_kbn_cd ";
                $where .= " AND (yy.cd BETWEEN '{$setdts['hanni2_from']}' AND '{$setdts['hanni2_to']}') ";
                break;
            case '2812': //商品分類2
                $field = "yy.cd AS key2,yy.name AS key2name,";
                $join2 = " LEFT OUTER JOIN shouhin_mrs AS d ON d.cd = a.shouhin_mr_cd
                           LEFT OUTER JOIN shouhin_bunrui2_kbns AS yy ON yy.cd = d.shouhin_bunrui2_kbn_cd ";
                $where .= " AND (yy.cd BETWEEN '{$setdts['hanni2_from']}' AND '{$setdts['hanni2_to']}') ";
                break;
            case '2813': //商品分類3
                $field = "yy.cd AS key2,yy.name AS key2name,";
                $join2 = " LEFT OUTER JOIN shouhin_mrs AS d ON d.cd = a.shouhin_mr_cd
                           LEFT OUTER JOIN shouhin_bunrui3_kbns AS yy ON yy.cd = d.shouhin_bunrui3_kbn_cd ";
                $where .= " AND (yy.cd BETWEEN '{$setdts['hanni2_from']}' AND '{$setdts['hanni2_to']}') ";
                break;
            case '2814': //商品分類4
                $field = "yy.cd AS key2,yy.name AS key2name,";
                $join2 = " LEFT OUTER JOIN shouhin_mrs AS d ON d.cd = a.shouhin_mr_cd
                           LEFT OUTER JOIN shouhin_bunrui4_kbns AS yy ON yy.cd = d.shouhin_bunrui4_kbn_cd ";
                $where .= " AND (yy.cd BETWEEN '{$setdts['hanni2_from']}' AND '{$setdts['hanni2_to']}') ";
                break;
            case '2815': //商品分類5
                $field = "yy.cd AS key2,yy.name AS key2name,";
                $join2 = " LEFT OUTER JOIN shouhin_mrs AS d ON d.cd = a.shouhin_mr_cd
                           LEFT OUTER JOIN shouhin_bunrui5_kbns AS yy ON yy.cd = d.shouhin_bunrui5_kbn_cd ";
                $where .= " AND (yy.cd BETWEEN '{$setdts['hanni2_from']}' AND '{$setdts['hanni2_to']}') ";
                break;
            case '2816': //プロジェクトコード
                $field = "yy.cd AS key2,yy.name AS key2name,";
                $join2 = " LEFT OUTER JOIN project_mrs AS yy ON yy.cd = a.project_mr_cd ";
                $where .= " AND (yy.cd BETWEEN '{$setdts['hanni2_from']}' AND '{$setdts['hanni2_to']}') ";
                break;
        }
        $group = " GROUP BY key1,key2 ";
        if ($this->request->getPost('junjo_kbn_cd') === '2816' || $this->request->getPost('junjo2_kbn_cd') === '2816') {
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
                SUM(a.kingaku) AS junshiire,
                SUM(CASE WHEN a.tanka_kbn = '1' THEN a.suuryou1 WHEN a.tanka_kbn = '2' THEN a.suuryou2 ELSE 0 END) AS suuryou
            FROM shiire_meisai_dts AS a
            LEFT OUTER JOIN shiire_dts AS b ON b.id = a.shiire_dt_id
            {$join1}{$join2}{$where}{$group}{$having}{$order}
        ";
        $stmt = $db->prepare($phql);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        //配列の集計
        $shoukei_shiire = 0;
        $shoukei_suuryou = 0;
        $soukeiArray = ['junshiire' => 0, 'suuryou' => 0];
        $soukei = 0;
        $j = 0;
        $view_datas = [];
        $sumarry_counter = 0;
        for ($i = 0; $i < count($rows); $i++) {
            if ($i === 0) {
                $view_datas[$j]['key'] = '≪ ' . $rows[$i]['key1'] . ' ≫';
                $view_datas[$j]['name'] = '≪ ' . $rows[$i]['key1name'] . ' ≫';
                $view_datas[$j]['junshiire'] = '';
                $view_datas[$j]['suuryou'] = '';
                $j++;
                $view_datas[$j]['key'] = $rows[$i]['key2'];
                $view_datas[$j]['name'] = $rows[$i]['key2name'];
                if (isset($rows[$i]['iro'])) {
                    $view_datas[$j]['iro'] = $rows[$i]['iro'];
                }
                $view_datas[$j]['junshiire'] = $rows[$i]['junshiire'];
                $view_datas[$j]['suuryou'] =  $rows[$i]['suuryou'];
                $shoukei_shiire += (float)$rows[$i]['junshiire'];
                $shoukei_suuryou += (float)$rows[$i]['suuryou'];
            } else {
                if ($rows[$i]['key1'] === $rows[$i - 1]['key1']) {
                    $view_datas[$j]['key'] = $rows[$i]['key2'];
                    $view_datas[$j]['name'] = $rows[$i]['key2name'];
                    if (isset($rows[$i]['iro'])) {
                        $view_datas[$j]['iro'] = $rows[$i]['iro'];
                    }
                    $view_datas[$j]['junshiire'] = $rows[$i]['junshiire'];
                    $view_datas[$j]['suuryou'] = $rows[$i]['suuryou'];

                    $shoukei_shiire += (float)$rows[$i]['junshiire'];
                    $shoukei_suuryou += (float)$rows[$i]['suuryou'];
                    $j++;
                } else {
                    $view_datas[$j]['key'] = $rows[$i - 1]['key1'] . ' 計';
                    $view_datas[$j]['name'] = '...' . $rows[$i - 1]['key1name'] . ' 計:';
                    $view_datas[$j]['junshiire'] = $shoukei_shiire;
                    $view_datas[$j]['suuryou'] = $shoukei_suuryou;
                    // 総計行用
                    $soukeiArray['junshiire'] = $soukeiArray['junuriage'] + $shoukei_shiire;
                    $soukeiArray['suuryou'] = $soukeiArray['suuryou'] + $shoukei_suuryou;
                    $shoukei_shiire = 0;
                    $shoukei_suuryou = 0;
                    $sumarry_counter++;
                    $j++;

                    $view_datas[$j]['key'] = '≪ ' . $rows[$i]['key1'] . ' ≫';
                    $view_datas[$j]['name'] = '≪ ' . $rows[$i]['key1name'] . ' ≫';
                    $view_datas[$j]['junshiire'] = '';
                    $view_datas[$j]['suuryou'] = '';
                    $j++;

                    $view_datas[$j]['key'] = $rows[$i]['key2'];
                    $view_datas[$j]['name'] = $rows[$i]['key2name'];
                    if (isset($rows[$i]['iro'])) {
                        $view_datas[$j]['iro'] = $rows[$i]['iro'];
                    }
                    $view_datas[$j]['junshiire'] = $rows[$i]['junshiire'];
                    $view_datas[$j]['suuryou'] =  $rows[$i]['suuryou'];

                    $shoukei_shiire += (float)$rows[$i]['junshiire'];
                    $shoukei_suuryou += (float)$rows[$i]['suuryou'];
                }
            }
            $soukei += (float)$shoukei_shiire;
            $j++;
        }
        if ($sumarry_counter === 0) {
            $view_datas[$j]['key'] = $rows[$i - 1]['key1'] . ' 計';
            $view_datas[$j]['name'] = '...' . $rows[$i - 1]['key1name'] . ' 計:';
            $view_datas[$j]['junshiire'] = $shoukei_shiire;
            $view_datas[$j]['suuryou'] = $shoukei_suuryou;
        }
        $this->view->soukei = $soukei;
        $this->view->rows = $view_datas;
        $this->view->soukeiArray = $soukeiArray;

        $this->tag->setDefault('kikan_sitei_kbn_cd', $this->request->getPost('kikan_sitei_kbn_cd'));
        $this->tag->setDefault('kikan_from', $this->request->getPost('kikan_from'));
        $this->tag->setDefault('kikan_to', $this->request->getPost('kikan_to'));

        //現在複数条件は作成していないので、意味が無いが将来使用するかもしれない
        $jouken_shiire_bunsekis = JoukenShiireBunsekis::find([
            "order" => "cd, sakusei_user_id", "conditions" => "sakusei_user_id IN(0, ?0)", "bind" => [0 => $this->getDI()->getSession()->get('auth')['id']]
        ]);
        $joukens = [];
        foreach ($jouken_shiire_bunsekis as $jouken_shiire_bunseki) {
            $joukens[$jouken_shiire_bunseki->cd] = $jouken_shiire_bunseki->name;
        }
        $this->view->joukens = $joukens;
        return;
    }
}
