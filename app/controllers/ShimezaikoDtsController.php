<?php

class ShimezaikoDtsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        ControllerBase::indexCd("ShimezaikoDts", "締在庫データ"); //簡易検索付き一覧表示
    }

    /**
     * テスト action
     */
    public function testAction()
    {
        $rows = ShouhinMrs::findZaikos();//"tantou_mr_cd = :shouhin_cd",["shouhin_cd"=>"B"]);
        echo "<br><br>";
        echo "<table border='1'><tr><th>商品</th><th>担当</th><th>単位</th><th>数単位</th><th>ロット</th><th>個別CD</th><th>品質</th><th>倉庫</th><th>在庫量</th><th>在庫数</th><th>仕入量</th><th>仕入数</th><th>他入庫量</th><th>他入庫数</th><th>売上量</th><th>売上数</th><th>他出庫量</th><th>他出庫数</th><th>最終入庫日</th><th>最終出庫日</th><th>最終入出庫日</th><th>伝票区分</th><th>伝票番号</th><th>内訳区分</th></tr>";
		$cols=["shouhin_mr_cd","tantou_mr_cd","tanni_mr_cd","suu_tanni_mr_cd","lot","kobetucd","hinsitu_kbn_cd","souko_mr_cd","zaiko_ryou","zaiko_suu","shiire_ryou","shiire_suu","hokanyuuko_ryou","hokanyuuko_suu","uriage_ryou","uriage_suu","hokashukko_ryou","hokashukko_suu","nyuukobi","shukkobi","nyuushukkobi","denpyou_mr_cd","oya_cd","utiwake_kbn_cd"];
		foreach ($rows as $row) {
			echo "<tr>";
			foreach ($cols as $col) {
				$dsp=$row[$col];
				$align="right";
				if (substr($col,-4)=='_suu') {$dsp=round($dsp,1);}else if (substr($col,-5)=='_ryou') {$dsp=round($dsp,3);} else {$align="center";}
				echo "<td align='$align'>".$dsp."</td>";
			}
			echo "</tr>";
		}
		echo "</table>";
return;
    }

    /**
     * テスト action
     */
    public function gakuAction()
    {
        $rows = ShimezaikoDts::findGaku();
        echo "<br><br>";
        echo "<table border='1'><tr><th>商品</th><th>単位</th><th>前在量</th><th>前在数</th><th>在庫量</th><th>在庫数</th><th>仕入量</th><th>仕入数</th><th>他入庫量</th><th>他入庫数</th><th>売上量</th><th>売上数</th><th>他出庫量</th><th>他出庫数</th><th>最終入庫日</th><th>最終出庫日</th><th>前単価</th><th>単価</th><th>前評価額</th><th>評価額</th></tr>";
		$cols=["shouhin_mr_cd","tanni_mr_cd","mae_ryou","mae_suu","zaiko_ryou","zaiko_suu","shiire_ryou","shiire_suu","hokanyuuko_ryou","hokanyuuko_suu","uriage_ryou","uriage_suu","hokashukko_ryou","hokashukko_suu","nyuukobi","shukkobi","mae_tanka","genka"];
		foreach ($rows as $row) {
			echo "<tr>";
			foreach ($cols as $col) {
				$dsp=$row[$col];
				$align="right";
				if (substr($col,-4)=='_suu') {$dsp=round($dsp,1);}else if (substr($col,-5)=='_ryou') {$dsp=round($dsp,3);} else {$align="center";}
				echo "<td align='$align'>".$dsp."</td>";
			}
			echo "<td align='center'>".$row["mae_tanka"]*$row["mae_ryou"]."</td>";
			echo "<td align='center'>".$row["genka"]*$row["zaiko_ryou"]."</td></tr>";
		}
		echo "</table>";
return;
    }

    /**
     * Searches for shimezaiko_dts
     */
    public function searchAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Displays the creation form
     */
    public function newAction($id=null, $dataname="ShimezaikoDts")
    {
        $this->view->imax = 0;

        if ($id) {
            $nameDts = $dataname;
            $shimezaiko_dt = $nameDts::findFirstByid($id);
            if (!$shimezaiko_dt) {
                $this->flash->error("締在庫データが見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "shimezaiko_dts",
                    'action' => 'index'
                ));

                return;
            }
            $this->_setDefault($shimezaiko_dt, "new", $dataname);
            $this->tag->setDefault("id", null);
            $this->tag->setDefault("cd", null);
        }

    }

    /**
     * 修正画面から「次へ」ボタンを押したら次のコードの修正画面になる。
     */
    public function nextAction($id)
    {
        ControllerBase::nextCd($id, "shimezaiko_dts", "ShimezaikoDts", "締在庫データ");
    }

    /**
     * 修正画面から「前へ」ボタンを押したら前のコードの修正画面になる。
     */
    public function prevAction($id)
    {
        ControllerBase::prevCd($id, "shimezaiko_dts", "ShimezaikoDts", "締在庫データ");
    }

    /**
     * Edits a shimezaiko_dt
     *
     * @param string $id
     */
    public function editAction($id)
    {
//        if (!$this->request->isPost()) {

            $shimezaiko_dt = ShimezaikoDts::findFirstByid($id);
            if (!$shimezaiko_dt) {
                $this->flash->error("締在庫データが見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "shimezaiko_dts",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->id = $shimezaiko_dt->id;

            $this->_setDefault($shimezaiko_dt, "edit");
//        }
    }

    /**
     * 画面に表示するデータをセットする
     */
    public function _setDefault($shimezaiko_dt, $action="edit", $meisai="ShimezaikoDts")
    {
        $setdts = ["id",
            "cd",
            "name",
            "shouhin_mr_cd",
            "tantou_mr_cd",
            "tanni_mr_cd",
            "zaiko_ryou",
            "suu_tanni_mr_cd",
            "zaiko_suu",
            "simebi",
            "lot",
            "kobetucd",
            "hinsitu_kbn_cd",
            "souko_mr_cd",
            "nyuukobi",
            "shukkobi",
            "tanka",
            "zaiko_hyouka_kbn_cd",
            "shiire_ryou",
            "hokanyuuko_ryou",
            "uriage_ryou",
            "hokashukko_ryou",
            "shiire_suu",
            "hokanyuuko_suu",
            "uriage_suu",
            "hokashukko_suu",
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
            if (property_exists($shimezaiko_dt, $setdt)) {
                $this->tag->setDefault($setdt, $shimezaiko_dt->$setdt);
            }
        }
    }

    /**
     * Creates a new shimezaiko_dt
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "shimezaiko_dts",
                'action' => 'index'
            ));

            return;
        }

        $shimezaiko_dt = new ShimezaikoDts();

        $post_flds = [];
        $post_flds = ["cd",
            "name",
            "shouhin_mr_cd",
            "tantou_mr_cd",
            "tanni_mr_cd",
            "zaiko_ryou",
            "suu_tanni_mr_cd",
            "zaiko_suu",
            "simebi",
            "lot",
            "kobetucd",
            "hinsitu_kbn_cd",
            "souko_mr_cd",
            "nyuukobi",
            "shukkobi",
            "tanka",
            "zaiko_hyouka_kbn_cd",
            "shiire_ryou",
            "hokanyuuko_ryou",
            "uriage_ryou",
            "hokashukko_ryou",
            "shiire_suu",
            "hokanyuuko_suu",
            "uriage_suu",
            "hokashukko_suu",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        foreach ($post_flds as $post_fld) {
            $shimezaiko_dt->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$shimezaiko_dt->save()) {
            foreach ($shimezaiko_dt->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "shimezaiko_dts",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("締在庫データの作成が完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "shimezaiko_dts",
            'action' => 'edit',
            'params' => array($shimezaiko_dt->id)
        ));
    }

    /**
     * Saves a shimezaiko_dt edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "shimezaiko_dts",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $shimezaiko_dt = ShimezaikoDts::findFirstByid($id);

        if (!$shimezaiko_dt) {
            $this->flash->error("締在庫データが見つからなくなりました。" . $id);

            $this->dispatcher->forward(array(
                'controller' => "shimezaiko_dts",
                'action' => 'index'
            ));

            return;
        }

        if ($shimezaiko_dt->updated !== $this->request->getPost("updated")) {
            $this->flash->error("他のプロセスから締在庫データが変更されたため更新を中止しました。"
                . $id . ",uid=" . $shimezaiko_dt->kousin_user_id . " tb=" . $shimezaiko_dt->updated ." pt=" . $this->request->getPost("updated"));

            $this->dispatcher->forward(array(
                'controller' => "shimezaiko_dts",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $post_flds = [];
        $post_flds = ["cd",
            "name",
            "shouhin_mr_cd",
            "tantou_mr_cd",
            "tanni_mr_cd",
            "zaiko_ryou",
            "suu_tanni_mr_cd",
            "zaiko_suu",
            "simebi",
            "lot",
            "kobetucd",
            "hinsitu_kbn_cd",
            "souko_mr_cd",
            "nyuukobi",
            "shukkobi",
            "tanka",
            "zaiko_hyouka_kbn_cd",
            "shiire_ryou",
            "hokanyuuko_ryou",
            "uriage_ryou",
            "hokashukko_ryou",
            "shiire_suu",
            "hokanyuuko_suu",
            "uriage_suu",
            "hokashukko_suu",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        $chg_flg = 0;
        foreach ($post_flds as $post_fld) {
            if ((array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld)) !== $shimezaiko_dt->$post_fld) {
                $chg_flg = 1;
                break;
            }
        }
        if ($chg_flg === 0) {
            $this->flash->error("変更がありません。" . $id);

            $this->dispatcher->forward(array(
                "controller" => "shimezaiko_dts",
                "action" => "edit",
                "params" => array($shimezaiko_dt->id)
            ));

            return;
        }

        $this->_bakOut($shimezaiko_dt);

        foreach ($post_flds as $post_fld) {
            $shimezaiko_dt->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$shimezaiko_dt->save()) {

            foreach ($shimezaiko_dt->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "shimezaiko_dts",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $this->flash->success("締在庫データの情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "shimezaiko_dts",
            'action' => 'edit',
            'params' => array($shimezaiko_dt->id)
        ));
    }

    /**
     * Deletes a shimezaiko_dt
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $shimezaiko_dt = ShimezaikoDts::findFirstByid($id);
        if (!$shimezaiko_dt) {
            $this->flash->error("締在庫データが見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "shimezaiko_dts",
                'action' => 'index'
            ));

            return;
        }

        $this->_bakOut($shimezaiko_dt, 1);

        if (!$shimezaiko_dt->delete()) {

            foreach ($shimezaiko_dt->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "shimezaiko_dts",
                'action' => 'search'
            ));

            return;
        }

        $this->flash->success("締在庫データの削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "shimezaiko_dts",
            'action' => "index"
        ));
    }

    /**
     * Back Out a shimezaiko_dt
     *
     * @param string $shimezaiko_dt, $dlt_flg
     */
    public function _bakOut($shimezaiko_dt, $dlt_flg = 0)
    {

        $bak_shimezaiko_dt = new BakShimezaikoDts();
        foreach ($shimezaiko_dt as $fld => $value) {
            $bak_shimezaiko_dt->$fld = $shimezaiko_dt->$fld;
        }
        $bak_shimezaiko_dt->id = NULL;
        $bak_shimezaiko_dt->id_moto = $shimezaiko_dt->id;
        $bak_shimezaiko_dt->hikae_dltflg = $dlt_flg;
        $bak_shimezaiko_dt->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_shimezaiko_dt->hikae_nichiji = date("Y-m-d H:i:s");
        if (!$bak_shimezaiko_dt->save()) {
            foreach ($bak_shimezaiko_dt->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
    }

}
