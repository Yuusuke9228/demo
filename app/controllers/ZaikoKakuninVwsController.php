<?php
 


class ZaikoKakuninVwsController extends ControllerBase
{
    /**
     * テスト action
     */
    public function testAction()
    {
        $rows = ZaikoKakuninVws::findZaikos([
        	"orderby"=>"kabusoku_ryou2",
        	"fields"=>""]);//"tantou_mr_cd = :shouhin_cd",["shouhin_cd"=>"B"]);
        echo "<br><br>";
        echo "<table border='1'><tr><th>商品</th><th>在庫量</th><th>在庫数</th><th>発注残量</th><th>発注残数</th><th>受注残量</th><th>受注残数</th><th>在庫適正量</th><th>過不足</th></tr>";
		$cols=["shouhin_mr_cd","zaiko_ryou1","zaiko_ryou2","hacchuuzan_ryou1","hacchuuzan_ryou2","juchuuzan_ryou1","juchuuzan_ryou2","zaiko_tekisei_ryou2","kabusoku_ryou2"];
		foreach ($rows as $row) {
			echo "<tr>";
			foreach ($cols as $col) {
				$dsp=$row[$col];
				$align="right";
				if (substr($col,-6)=='_ryou1') {$dsp=number_format($dsp,1);}else if (substr($col,-6)=='_ryou2') {$dsp=number_format($dsp,2);} else {$align="center";}
				echo "<td align='$align'>".$dsp."</td>";
			}
			echo "</tr>";
		}
		echo "</table>";
return;
    }

	/**
	 * 在庫確認
	 */
	public function summaryXAction() // 使わない2019/4/15井浦
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
		];
		$setdts = []; // データーの中継変数
		$thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
		$thisPost['id'] = $this->request->getPost('id')??1; // あれば、それ、でなければ=1
		$thisFind=[];
		$jouken = JoukenZaikoKakunins::findFirstByid($thisPost['id']);
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
		//取得view変更 Edit By Nishiyama
		$rows = ZaikoKakuninAzukariVws::findZaikos([
			"groupby" => [
				($setdts['soukohyouji_flg']==1 || $condition1 == 'souko_mr_cd')?"souko_mr_cd":"shouhin_mr_cd",
			],
			"joins" => "LEFT JOIN tanni_mrs p1c ON p1c.cd = p1.tanni_mr1_cd
						LEFT JOIN tanni_mrs p1d ON p1d.cd = p1.tanni_mr2_cd
			".($join1tbl?"LEFT JOIN ".$join1tbl." bk1 ON bk1.cd = ".$condition1:"")."
			".($join2tbl?"LEFT JOIN ".$join2tbl." bk2 ON bk2.cd = ".$condition2:""),
			"fields" => ", p1a.name
						, p1a.suu_shousuu
						, p1a.zaiko_tekisei as zaiko_tekisei_ryou
						, p1c.name AS tanni_mr_name1
						, p1d.name AS tanni_mr_name2
						, p1a.tanka_kbn as tanka_kbn
						, p1a.shiire_tanka as shiire_tanka
						, p1a.hacchuu_lot as hacchuu_lot
						, p1a.lead_time as lead_time
						, ".$condition1." AS bkey
						, ".$condition2." AS bkey2
						, ".($join1tbl?"bk1.name":"''")." AS bk1name
						, ".($join2tbl?"bk2.name":"''")." AS bk2name",
			//"conditions" => $condition1." >= :c1 AND ".$condition1." <= :c2 AND ".$condition2." >= :c3 AND ".$condition2." <= :c4 "
            "conditions" => "p1a.zaikokanri = 1	AND " . $condition1 . " >= :c1 AND " . $condition1 . " <= :c2 AND " . $condition2 . " >= :c3 AND " . $condition2 . " <= :c4" . ($this->request->isPost() ? "" : " AND FALSE")
				,
			"bind" => ["c1" => $setdts['hanni_from'], "c2" => $setdts['hanni_to'], "c3" => $setdts['hanni2_from'], "c4" => $setdts['hanni2_to']],
			"orderby" => "hinsitu_hyouka_kbn_cd".($setdts['koujun_flg']==1?" DESC":"").
						",".$condition1.($setdts['koujun_flg']==1?" DESC":"").
						(($condition2 == 'souko_mr_cd')?"":(",".$condition2.($setdts['koujun_flg']==1?" DESC":""))).
						",shouhin_mr_cd".($setdts['koujun_flg']==1?" DESC":"").
						($setdts['soukohyouji_flg']==1 && $condition2 == 'souko_mr_cd'?(",".$condition2.($setdts['koujun_flg']==1?" DESC":"")):"")
		]);
		$this->view->rows = $rows;
		$this->view->setdts = $setdts;
		return;
	}

    /**
     * 明細一覧 action
     */
    public function indexAction()
    {
        ControllerBase::indexCd("ZaikoKakuninVws", "VIEW"); //簡易検索付き一覧表示
    }

    /**
     * Searches for zaiko_kakunin_vws
     */
    public function searchAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Displays the creation form
     */
    public function newAction($id=null, $dataname="ZaikoKakuninVws")
    {
        $this->view->imax = 0;

        if ($id) {
            $nameDts = $dataname;
            $zaiko_kakunin_vw = $nameDts::findFirstByid($id);
            if (!$zaiko_kakunin_vw) {
                $this->flash->error("VIEWが見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "zaiko_kakunin_vws",
                    'action' => 'index'
                ));

                return;
            }
            $this->_setDefault($zaiko_kakunin_vw, "new", $dataname);
            $this->tag->setDefault("shouhin_mr_cd", null);
            $this->tag->setDefault("cd", null);
        }

    }

    /**
     * 修正画面から「次へ」ボタンを押したら次のコードの修正画面になる。
     */
    public function nextAction($id)
    {
        ControllerBase::nextCd($id, "zaiko_kakunin_vws", "ZaikoKakuninVws", "VIEW");
    }

    /**
     * 修正画面から「前へ」ボタンを押したら前のコードの修正画面になる。
     */
    public function prevAction($id)
    {
        ControllerBase::prevCd($id, "zaiko_kakunin_vws", "ZaikoKakuninVws", "VIEW");
    }

    /**
     * Edits a zaiko_kakunin_vw
     *
     * @param string $shouhin_mr_cd
     */
    public function editAction($shouhin_mr_cd)
    {
//        if (!$this->request->isPost()) {

            $zaiko_kakunin_vw = ZaikoKakuninVws::findFirstByshouhin_mr_cd($shouhin_mr_cd);
            if (!$zaiko_kakunin_vw) {
                $this->flash->error("VIEWが見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "zaiko_kakunin_vws",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->shouhin_mr_cd = $zaiko_kakunin_vw->shouhin_mr_cd;

            $this->_setDefault($zaiko_kakunin_vw, "edit");
//        }
    }

    /**
     * 画面に表示するデータをセットする
     */
    public function _setDefault($zaiko_kakunin_vw, $action="edit", $meisai="ZaikoKakuninVws")
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
            "zaiko_ryou1",
            "zaiko_ryou2",
            "hacchuuzan_ryou1",
            "hacchuuzan_ryou2",
            "juchuuzan_ryou1",
            "juchuuzan_ryou2",
            "denpyou_mr_cd",
            "meisai_id",
            "meisai_cd",
            "utiwake_kbn_cd",
            "id",
            "cd",
            "tokuisaki_mr_cd",
            "shiiresaki_mr_cd",
            "nounyuu_kijitu",
            "nouki",
            "hacchuu_dt_id",
            "juchuu_dt_id",
            ];
            
        foreach ($setdts as $setdt) {
            if (property_exists($zaiko_kakunin_vw, $setdt)) {
                $this->tag->setDefault($setdt, $zaiko_kakunin_vw->$setdt);
            }
        }
    }

    /**
     * Creates a new zaiko_kakunin_vw
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "zaiko_kakunin_vws",
                'action' => 'index'
            ));

            return;
        }

        $zaiko_kakunin_vw = new ZaikoKakuninVws();

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
            "zaiko_ryou1",
            "zaiko_ryou2",
            "hacchuuzan_ryou1",
            "hacchuuzan_ryou2",
            "juchuuzan_ryou1",
            "juchuuzan_ryou2",
            "denpyou_mr_cd",
            "meisai_id",
            "meisai_cd",
            "utiwake_kbn_cd",
            "id",
            "cd",
            "tokuisaki_mr_cd",
            "shiiresaki_mr_cd",
            "nounyuu_kijitu",
            "nouki",
            "hacchuu_dt_id",
            "juchuu_dt_id",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        foreach ($post_flds as $post_fld) {
            $zaiko_kakunin_vw->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$zaiko_kakunin_vw->save()) {
            foreach ($zaiko_kakunin_vw->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "zaiko_kakunin_vws",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("VIEWの作成が完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "zaiko_kakunin_vws",
            'action' => 'edit',
            'params' => array($zaiko_kakunin_vw->shouhin_mr_cd)
        ));
    }

    /**
     * Saves a zaiko_kakunin_vw edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "zaiko_kakunin_vws",
                'action' => 'index'
            ));

            return;
        }

        $shouhin_mr_cd = $this->request->getPost("shouhin_mr_cd");
        $zaiko_kakunin_vw = ZaikoKakuninVws::findFirstByshouhin_mr_cd($shouhin_mr_cd);

        if (!$zaiko_kakunin_vw) {
            $this->flash->error("VIEWが見つからなくなりました。" . $shouhin_mr_cd);

            $this->dispatcher->forward(array(
                'controller' => "zaiko_kakunin_vws",
                'action' => 'index'
            ));

            return;
        }

        if ($zaiko_kakunin_vw->updated !== $this->request->getPost("updated")) {
            $this->flash->error("他のプロセスからVIEWが変更されたため更新を中止しました。"
                . $shouhin_mr_cd . ",uid=" . $zaiko_kakunin_vw->kousin_user_id . " tb=" . $zaiko_kakunin_vw->updated ." pt=" . $this->request->getPost("updated"));

            $this->dispatcher->forward(array(
                'controller' => "zaiko_kakunin_vws",
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
            "zaiko_ryou1",
            "zaiko_ryou2",
            "hacchuuzan_ryou1",
            "hacchuuzan_ryou2",
            "juchuuzan_ryou1",
            "juchuuzan_ryou2",
            "denpyou_mr_cd",
            "meisai_id",
            "meisai_cd",
            "utiwake_kbn_cd",
            "id",
            "cd",
            "tokuisaki_mr_cd",
            "shiiresaki_mr_cd",
            "nounyuu_kijitu",
            "nouki",
            "hacchuu_dt_id",
            "juchuu_dt_id",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        $chg_flg = 0;
        foreach ($post_flds as $post_fld) {
            if ((array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld)) !== $zaiko_kakunin_vw->$post_fld) {
                $chg_flg = 1;
                break;
            }
        }
        if ($chg_flg === 0) {
            $this->flash->error("変更がありません。" . $shouhin_mr_cd);

            $this->dispatcher->forward(array(
                "controller" => "zaiko_kakunin_vws",
                "action" => "edit",
                "params" => array($zaiko_kakunin_vw->shouhin_mr_cd)
            ));

            return;
        }

        $this->_bakOut($zaiko_kakunin_vw);

        foreach ($post_flds as $post_fld) {
            $zaiko_kakunin_vw->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$zaiko_kakunin_vw->save()) {

            foreach ($zaiko_kakunin_vw->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "zaiko_kakunin_vws",
                'action' => 'edit',
                'params' => array($shouhin_mr_cd)
            ));

            return;
        }

        $this->flash->success("VIEWの情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "zaiko_kakunin_vws",
            'action' => 'edit',
            'params' => array($zaiko_kakunin_vw->shouhin_mr_cd)
        ));
    }

    /**
     * Deletes a zaiko_kakunin_vw
     *
     * @param string $shouhin_mr_cd
     */
    public function deleteAction($shouhin_mr_cd)
    {
        $zaiko_kakunin_vw = ZaikoKakuninVws::findFirstByshouhin_mr_cd($shouhin_mr_cd);
        if (!$zaiko_kakunin_vw) {
            $this->flash->error("VIEWが見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "zaiko_kakunin_vws",
                'action' => 'index'
            ));

            return;
        }

        $this->_bakOut($zaiko_kakunin_vw, 1);

        if (!$zaiko_kakunin_vw->delete()) {

            foreach ($zaiko_kakunin_vw->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "zaiko_kakunin_vws",
                'action' => 'search'
            ));

            return;
        }

        $this->flash->success("VIEWの削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "zaiko_kakunin_vws",
            'action' => "index"
        ));
    }

    /**
     * Back Out a zaiko_kakunin_vw
     *
     * @param string $zaiko_kakunin_vw, $dlt_flg
     */
    public function _bakOut($zaiko_kakunin_vw, $dlt_flg = 0)
    {

        $bak_zaiko_kakunin_vw = new BakZaikoKakuninVws();
        foreach ($zaiko_kakunin_vw as $fld => $value) {
            $bak_zaiko_kakunin_vw->$fld = $zaiko_kakunin_vw->$fld;
        }
        $bak_zaiko_kakunin_vw->shouhin_mr_cd = NULL;
        $bak_zaiko_kakunin_vw->moto_shouhin_mr_cd = $zaiko_kakunin_vw->shouhin_mr_cd;
        $bak_zaiko_kakunin_vw->hikae_dltflg = $dlt_flg;
        $bak_zaiko_kakunin_vw->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_zaiko_kakunin_vw->hikae_nichiji = date("Y-m-d H:i:s");
        if (!$bak_zaiko_kakunin_vw->save()) {
            foreach ($bak_zaiko_kakunin_vw->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
    }

}
