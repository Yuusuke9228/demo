<?php
 


class HacchuuMeisaiDtsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        ControllerBase::indexCd("HacchuuMeisaiDts", "発注明細データ"); //簡易検索付き一覧表示
    }

    /**
     * Searches for hacchuu_meisai_dts
     */
    public function searchAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Displays the creation form
     */
    public function newAction($id=null, $dataname="HacchuuMeisaiDts")
    {
        $this->view->imax = 0;

        if ($id) {
            $nameDts = $dataname;
            $hacchuu_meisai_dt = $nameDts::findFirstByid($id);
            if (!$hacchuu_meisai_dt) {
                $this->flash->error("発注明細データが見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "hacchuu_meisai_dts",
                    'action' => 'index'
                ));

                return;
            }
            $this->_setDefault($hacchuu_meisai_dt, "new", $dataname);
            $this->tag->setDefault("id", null);
            $this->tag->setDefault("cd", null);
        }

    }

    /**
     * 修正画面から「次へ」ボタンを押したら次のコードの修正画面になる。
     */
    public function nextAction($id)
    {
        ControllerBase::nextCd($id, "hacchuu_meisai_dts", "HacchuuMeisaiDts", "発注明細データ");
    }

    /**
     * 修正画面から「前へ」ボタンを押したら前のコードの修正画面になる。
     */
    public function prevAction($id)
    {
        ControllerBase::prevCd($id, "hacchuu_meisai_dts", "HacchuuMeisaiDts", "発注明細データ");
    }

    /**
     * Edits a hacchuu_meisai_dt
     *
     * @param string $id
     */
    public function editAction($id)
    {
//        if (!$this->request->isPost()) {

            $hacchuu_meisai_dt = HacchuuMeisaiDts::findFirstByid($id);
            if (!$hacchuu_meisai_dt) {
                $this->flash->error("発注明細データが見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "hacchuu_meisai_dts",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->id = $hacchuu_meisai_dt->id;

            $this->_setDefault($hacchuu_meisai_dt, "edit");
//        }
    }

    /**
     * 画面に表示するデータをセットする
     */
    public function _setDefault($hacchuu_meisai_dt, $action="edit", $meisai="HacchuuMeisaiDts")
    {
        $setdts = ["id",
            "cd",
            "tekiyou",
            "hacchuu_dt_id",
            "utiwake_kbn_cd",
            "shouhin_mr_cd",
            "tanni_mr_cd",
            "kousei",
            "irisuu",
            "keisu",
            "lot",
            "kobetucd",
            "hinsitu_kbn_cd",
            "souko_mr_cd",
            "kikaku",
            "genkagaku",
            "zeinukigaku",
            "zeigaku",
            "iro",
            "iromei",
            "size",
            "suuryou",
            "gentanka",
            "tanka",
            "kingaku",
            "project_mr_cd",
            "zeiritu_mr_cd",
            "bikou",
            "nouki",
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
            if (property_exists($hacchuu_meisai_dt, $setdt)) {
                $this->tag->setDefault($setdt, $hacchuu_meisai_dt->$setdt);
            }
        }
    }

    /**
     * Creates a new hacchuu_meisai_dt
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "hacchuu_meisai_dts",
                'action' => 'index'
            ));

            return;
        }

        $hacchuu_meisai_dt = new HacchuuMeisaiDts();

        $post_flds = [];
        $post_flds = ["cd",
            "tekiyou",
            "hacchuu_dt_id",
            "utiwake_kbn_cd",
            "shouhin_mr_cd",
            "tanni_mr_cd",
            "kousei",
            "irisuu",
            "keisu",
            "lot",
            "kobetucd",
            "hinsitu_kbn_cd",
            "souko_mr_cd",
            "kikaku",
            "genkagaku",
            "zeinukigaku",
            "zeigaku",
            "iro",
            "iromei",
            "size",
            "suuryou",
            "gentanka",
            "tanka",
            "kingaku",
            "project_mr_cd",
            "zeiritu_mr_cd",
            "bikou",
            "nouki",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        foreach ($post_flds as $post_fld) {
            $hacchuu_meisai_dt->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$hacchuu_meisai_dt->save()) {
            foreach ($hacchuu_meisai_dt->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "hacchuu_meisai_dts",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("発注明細データの作成が完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "hacchuu_meisai_dts",
            'action' => 'edit',
            'params' => array($hacchuu_meisai_dt->id)
        ));
    }

    /**
     * Saves a hacchuu_meisai_dt edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "hacchuu_meisai_dts",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $hacchuu_meisai_dt = HacchuuMeisaiDts::findFirstByid($id);

        if (!$hacchuu_meisai_dt) {
            $this->flash->error("発注明細データが見つからなくなりました。" . $id);

            $this->dispatcher->forward(array(
                'controller' => "hacchuu_meisai_dts",
                'action' => 'index'
            ));

            return;
        }

        if ($hacchuu_meisai_dt->updated !== $this->request->getPost("updated")) {
            $this->flash->error("他のプロセスから発注明細データが変更されたため更新を中止しました。"
                . $id . ",uid=" . $hacchuu_meisai_dt->kousin_user_id . " tb=" . $hacchuu_meisai_dt->updated ." pt=" . $this->request->getPost("updated"));

            $this->dispatcher->forward(array(
                'controller' => "hacchuu_meisai_dts",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $post_flds = [];
        $post_flds = ["cd",
            "tekiyou",
            "hacchuu_dt_id",
            "utiwake_kbn_cd",
            "shouhin_mr_cd",
            "tanni_mr_cd",
            "kousei",
            "irisuu",
            "keisu",
            "lot",
            "kobetucd",
            "hinsitu_kbn_cd",
            "souko_mr_cd",
            "kikaku",
            "genkagaku",
            "zeinukigaku",
            "zeigaku",
            "iro",
            "iromei",
            "size",
            "suuryou",
            "gentanka",
            "tanka",
            "kingaku",
            "project_mr_cd",
            "zeiritu_mr_cd",
            "bikou",
            "nouki",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        $chg_flg = 0;
        foreach ($post_flds as $post_fld) {
            if ((array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld)) !== $hacchuu_meisai_dt->$post_fld) {
                $chg_flg = 1;
                break;
            }
        }
        if ($chg_flg === 0) {
            $this->flash->error("変更がありません。" . $id);

            $this->dispatcher->forward(array(
                "controller" => "hacchuu_meisai_dts",
                "action" => "edit",
                "params" => array($hacchuu_meisai_dt->id)
            ));

            return;
        }

        $this->_bakOut($hacchuu_meisai_dt);

        foreach ($post_flds as $post_fld) {
            $hacchuu_meisai_dt->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$hacchuu_meisai_dt->save()) {

            foreach ($hacchuu_meisai_dt->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "hacchuu_meisai_dts",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $this->flash->success("発注明細データの情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "hacchuu_meisai_dts",
            'action' => 'edit',
            'params' => array($hacchuu_meisai_dt->id)
        ));
    }

    /**
     * Deletes a hacchuu_meisai_dt
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $hacchuu_meisai_dt = HacchuuMeisaiDts::findFirstByid($id);
        if (!$hacchuu_meisai_dt) {
            $this->flash->error("発注明細データが見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "hacchuu_meisai_dts",
                'action' => 'index'
            ));

            return;
        }

        $this->_bakOut($hacchuu_meisai_dt, 1);

        if (!$hacchuu_meisai_dt->delete()) {

            foreach ($hacchuu_meisai_dt->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "hacchuu_meisai_dts",
                'action' => 'search'
            ));

            return;
        }

        $this->flash->success("発注明細データの削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "hacchuu_meisai_dts",
            'action' => "index"
        ));
    }

    /**
     * Back Out a hacchuu_meisai_dt
     *
     * @param string $hacchuu_meisai_dt, $dlt_flg
     */
    public function _bakOut($hacchuu_meisai_dt, $dlt_flg = 0)
    {

        $bak_hacchuu_meisai_dt = new BakHacchuuMeisaiDts();
        foreach ($hacchuu_meisai_dt as $fld => $value) {
            $bak_hacchuu_meisai_dt->$fld = $hacchuu_meisai_dt->$fld;
        }
        $bak_hacchuu_meisai_dt->id = NULL;
        $bak_hacchuu_meisai_dt->id_moto = $hacchuu_meisai_dt->id;
        $bak_hacchuu_meisai_dt->hikae_dltflg = $dlt_flg;
        $bak_hacchuu_meisai_dt->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_hacchuu_meisai_dt->hikae_nichiji = date("Y-m-d H:i:s");
        if (!$bak_hacchuu_meisai_dt->save()) {
            foreach ($bak_hacchuu_meisai_dt->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
    }

    /**
     * 単価の履歴を確認するためのアクション
     * Add By Nishiyama 2019/1/9
     */
    public function historyAction()
    {
        $di = \Phalcon\DI::getDefault();
        $mgr = $di->get('modelsManager');
        $cd = $this->request->getQuery('cd');
        $shiiresaki = $this->request->getQuery('shiiresaki');
        $where = " WHERE (a.shouhin_mr_cd = :cd: AND b.shiiresaki_mr_cd = :shiiresaki:)";
        $phql = "
        SELECT
            a.hacchuu_dt_id AS hacchuu_dt_id,
            a.shouhin_mr_cd AS shouhin_mr_cd,
            a.tekiyou AS tekiyou,
            a.souko_mr_cd AS souko_mr_cd,
            a.lot AS lot,
            a.suuryou2 AS suuryou2,
            a.tanka AS tanka,
            a.kingaku AS kingaku,
            a.bikou AS bikou,
            a.updated AS updated
        FROM HacchuuMeisaiDts AS a
        LEFT JOIN HacchuuDts AS b ON b.id = a.hacchuu_dt_id
        " . $where . "
        ORDER BY a.updated DESC
        ";
        $hacchuu_meisai_dts = $mgr->executeQuery($phql, [
            "cd" => $cd,
            "shiiresaki" => $shiiresaki,
        ]);
        //var_dump($hacchuu_meisai_dts);
        $this->view->hacchuu_meisai_dts = $hacchuu_meisai_dts;
    }

}
