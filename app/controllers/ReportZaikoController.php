<?php

class ReportZaikoController extends ControllerBase
{
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
			'soukohyoujji_flg',
			'goukeigyou_flg',
		];
		$setdts = []; // データーの中継変数
		$thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
		$thisPost['id'] = $this->request->getPost('id')??1; // あれば、それ、でなければ=1
		$thisFind=[];
		$jouken = JoukenZaikoItirans::findFirstByid($thisPost['id']);
		if ($jouken) {
			$thisFind['hanni_from_name'] = '';
			$thisFind['hanni_to_name'] = '';
			$thisFind['hanni2_from_name'] = '';
			$thisFind['hanni2_to_name'] = '';
		}
		foreach ($post_flds as $post_fld) {
			$setdts[$post_fld] = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
			if ($jouken && $setdts[$post_fld]=="") {$setdts[$post_fld] = array_key_exists($post_fld, $thisFind)?$thisFind[$post_fld]:$jouken->$post_fld;}
		}
		$setdts['kikan_tuki'] = ($setdts['kikan_tuki'] && $setdts['kikan_tuki'] != '0000-00-00')?$setdts['kikan_tuki']:date('Y-m-d');

		foreach ($setdts as $fld => $setdt) { // postデータをそのまま返す。
			$this->tag->setDefault($fld, $setdt);
		}

		$condition1 = 'shouhin_mr_cd';
		$condition2 = 'p1.souko_mr_cd';
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
				$condition1 = 'p1.souko_mr_cd';
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
				$condition2 = 'p1.souko_mr_cd';
				$join2tbl = 'souko_mrs';
			break;
		}

		$rows = ShouhinMrs::findZaikos([
			"kyou" => date('Y-m-t', strtotime($setdts['kikan_tuki'])),
			"groupby" => [
				"hinsitu_hyouka_kbn_cd",
				"shouhin_mr_cd",
				"nyuushukkoym",
			],
			"joins" => "LEFT JOIN zaiko_hyouka_kbns p1b ON p1b.cd = p1a.zaiko_hyouka_kbn_cd
						LEFT JOIN tanni_mrs p1c ON p1c.cd = p1.tanni_mr_cd
			".($join1tbl?"LEFT JOIN ".$join1tbl." bk1 ON bk1.cd = ".$condition1:"")."
			".($join2tbl?"LEFT JOIN ".$join2tbl." bk2 ON bk2.cd = ".$condition2:""),
			"fields" => ", p1a.name
						, CASE hinsitu_hyouka_kbn_cd
							WHEN 1 THEN p1a.hyoujun_genka
							WHEN 2 THEN p1a.hyoukasage_genka
							ELSE 0
							END AS hyoujun_genka
						, p1a.suu_shousuu
						, p1a.tanka_shousuu
						, p1a.zaiko_hyouka_kbn_cd
						, p1b.name AS zaiko_hyouka_name
						, p1c.name AS tanni_mr_name
						, ".$condition1." AS bkey
						, ".$condition2." AS bkey2
						, ".($join1tbl?"bk1.name":"''")." AS bk1name
						, ".($join2tbl?"bk2.name":"''")." AS bk2name",
			"conditions" => $condition1." >= :c1 AND ".$condition1." <= :c2 AND ".$condition2." >= :c3 AND ".$condition2." <= :c4"
				,
			"bind" => ["c1" => $setdts['hanni_from'], "c2" => $setdts['hanni_to'], "c3" => $setdts['hanni2_from'], "c4" => $setdts['hanni2_to']],
			"orderby" => $condition1.($setdts['koujun_flg']==1?" DESC":"").",".$condition2.($setdts['koujun_flg']==1?" DESC":"").",shouhin_mr_cd".($setdts['koujun_flg']==1?" DESC":""),
		]);

		$this->view->rows = $rows;
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
		$thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
		foreach ($post_flds as $post_fld) {
			$setdts[$post_fld] = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
		}
		$setdts['kikan_from'] = $setdts['kikan_from']??($setdts['hyouji_flg']!=='1'?'2016-01-01':date('Y-m-01'));
		$setdts['kikan_to'] = $setdts['kikan_to']??date('Y-m-t');
		$shouhin_mr = ShouhinMrs::findFirst(["conditions"=>"cd = ?1", "bind"=>[1=>$setdts['cd']]]);
		$setdts['name'] = $shouhin_mr->name??"";

		foreach ($setdts as $fld => $setdt) { // postデータをそのまま返す。
			$this->tag->setDefault($fld, $setdt);
		}

		$to_midasi = [];
		$toviews = [];
//		$di   = \Phalcon\DI::getDefault();
//		$mgr  = $di->get('modelsManager');
		$and_where = $setdts["souko_mr_cd"]?" AND souko_mr_cd = '".$setdts["souko_mr_cd"]."'":"";
		if ($setdts["hyouji_flg"] == 1) { // 明細表
			$rows = ShouhinMrs::findZaikos([
				"conditions" => "p1a.cd = '".$setdts['cd']."'".$and_where,
				"kyou" => $setdts['kikan_to'],
				"groupby" => [
					"shouhin_mr_cd",
					"nyuushukkobi",
					"denpyou_mr_cd",
					"oya_cd",
					"gyou_cd",
				],
				"joins" => "LEFT JOIN tokuisaki_mrs p1b ON p1b.cd = p1.torihikisaki_cd
							LEFT JOIN shiiresaki_mrs p1c ON p1c.cd = p1.torihikisaki_cd
							LEFT JOIN denpyou_mrs p1d ON p1d.cd = p1.denpyou_mr_cd
							LEFT JOIN utiwake_kbns p1e ON p1e.cd = p1.utiwake_kbn_cd
							LEFT JOIN tanni_mrs p1f ON p1f.cd = p1.tanni_mr_cd
							LEFT JOIN tanni_mrs p1g ON p1g.cd = p1.suu_tanni_mr_cd",
				"fields" => ", p1a.name
							, p1b.name AS tokuisaki_name
							, p1c.name AS shiiresaki_name
							, p1d.name AS denpyou_name
							, p1e.name AS utiwake_name
							, p1f.name AS tanni_name
							, p1g.name AS suu_tanni_name",
			]);
			$this->tag->setDefault("name", $rows?$rows[0]["name"]:"");
		} else {
			$rows = ShouhinMrs::findZaikos([
				"conditions" => "p1a.cd = '".$setdts['cd']."'".$and_where,
				"kyou" => $setdts['kikan_to'],
				"groupby" => [
					"shouhin_mr_cd",
					"nyuushukkoym",
					"lot",
					"tanni_mr_cd",
					"suu_tanni_mr_cd",
				],
				"joins" => "LEFT JOIN tanni_mrs p1f ON p1f.cd = p1.tanni_mr_cd
							LEFT JOIN tanni_mrs p1g ON p1g.cd = p1.suu_tanni_mr_cd",
				"fields" => ", p1f.name AS tanni_name
							, p1g.name AS suu_tanni_name",
			]);
		}

		$this->view->rows = $rows;
		$this->view->setdts = $setdts;
		return;
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
		$rows = ShouhinMrs::findZaikos([
			"conditions" => "shouhin_mr_cd = :cd",
			"groupby" => ["lot"],
			"fields" => ", p1a.name",
			"bind" => ["cd"=>$wherecd],
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
		$rows = ShouhinMrs::findZaikos([
			"conditions" => "shouhin_mr_cd = :cd",
			"groupby" => ["kobetucd"],
			"fields" => ", p1a.name",
			"bind" => ["cd"=>$wherecd],
		]);
		$this->view->rows = $rows;
	}

}

