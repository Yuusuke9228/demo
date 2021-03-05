<?php

class JuchuuMeisaiDtsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        ControllerBase::indexCd("JuchuuMeisaiDts", "受注明細データ"); //簡易検索付き一覧表示
    }

    /**
     * Searches for juchuu_meisai_dts
     */
    public function searchAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Displays the creation form
     */
    public function newAction($id=null, $dataname="JuchuuMeisaiDts")
    {
        $this->view->imax = 0;

        if ($id) {
            $nameDts = $dataname;
            $juchuu_meisai_dt = $nameDts::findFirstByid($id);
            if (!$juchuu_meisai_dt) {
                $this->flash->error("受注明細データが見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "juchuu_meisai_dts",
                    'action' => 'index'
                ));

                return;
            }
            $this->_setDefault($juchuu_meisai_dt, "new", $dataname);
            $this->tag->setDefault("id", null);
            $this->tag->setDefault("cd", null);
        }

    }

    /**
     * 修正画面から「次へ」ボタンを押したら次のコードの修正画面になる。
     */
    public function nextAction($id)
    {
        ControllerBase::nextCd($id, "juchuu_meisai_dts", "JuchuuMeisaiDts", "受注明細データ");
    }

    /**
     * 修正画面から「前へ」ボタンを押したら前のコードの修正画面になる。
     */
    public function prevAction($id)
    {
        ControllerBase::prevCd($id, "juchuu_meisai_dts", "JuchuuMeisaiDts", "受注明細データ");
    }

    /**
     * Edits a juchuu_meisai_dt
     *
     * @param string $id
     */
    public function editAction($id)
    {
//        if (!$this->request->isPost()) {

            $juchuu_meisai_dt = JuchuuMeisaiDts::findFirstByid($id);
            if (!$juchuu_meisai_dt) {
                $this->flash->error("受注明細データが見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "juchuu_meisai_dts",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->id = $juchuu_meisai_dt->id;

            $this->_setDefault($juchuu_meisai_dt, "edit");
//        }
    }

    /**
     * 画面に表示するデータをセットする
     */
    public function _setDefault($juchuu_meisai_dt, $action="edit", $meisai="JuchuuMeisaiDts")
    {
        $setdts = ["id",
            "cd",
            "utiwake_kbn_cd",
            "juchuu_dt_id",
            "shouhin_mr_cd",
            "tanni_mr_cd",
            "kousei",
            "irisuu",
            "keisu",
            "tekiyou",
            "lot",
            "kobetucd",
            "hinsitu_kbn_cd",
            "souko_mr_cd",
            "kikaku",
            "iro",
            "iromei",
            "size",
            "suuryou",
            "gentanka",
            "tanka",
            "kingaku",
            "genkagaku",
            "zeinukigaku",
            "zeigaku",
            "project_mr_cd",
            "zeiritu_mr_cd",
            "bikou",
            "nouki",
            "hacchuurendou_flg",
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
            if (property_exists($juchuu_meisai_dt, $setdt)) {
                $this->tag->setDefault($setdt, $juchuu_meisai_dt->$setdt);
            }
        }
    }

    /**
     * Creates a new juchuu_meisai_dt
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "juchuu_meisai_dts",
                'action' => 'index'
            ));

            return;
        }

        $juchuu_meisai_dt = new JuchuuMeisaiDts();

        $post_flds = [];
        $post_flds = ["cd",
            "utiwake_kbn_cd",
            "juchuu_dt_id",
            "shouhin_mr_cd",
            "tanni_mr_cd",
            "kousei",
            "irisuu",
            "keisu",
            "tekiyou",
            "lot",
            "kobetucd",
            "hinsitu_kbn_cd",
            "souko_mr_cd",
            "kikaku",
            "iro",
            "iromei",
            "size",
            "suuryou",
            "gentanka",
            "tanka",
            "kingaku",
            "genkagaku",
            "zeinukigaku",
            "zeigaku",
            "project_mr_cd",
            "zeiritu_mr_cd",
            "bikou",
            "nouki",
            "hacchuurendou_flg",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        foreach ($post_flds as $post_fld) {
            $juchuu_meisai_dt->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$juchuu_meisai_dt->save()) {
            foreach ($juchuu_meisai_dt->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "juchuu_meisai_dts",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("受注明細データの作成が完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "juchuu_meisai_dts",
            'action' => 'edit',
            'params' => array($juchuu_meisai_dt->id)
        ));
    }

    /**
     * Saves a juchuu_meisai_dt edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "juchuu_meisai_dts",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $juchuu_meisai_dt = JuchuuMeisaiDts::findFirstByid($id);

        if (!$juchuu_meisai_dt) {
            $this->flash->error("受注明細データが見つからなくなりました。" . $id);

            $this->dispatcher->forward(array(
                'controller' => "juchuu_meisai_dts",
                'action' => 'index'
            ));

            return;
        }

        if ($juchuu_meisai_dt->updated !== $this->request->getPost("updated")) {
            $this->flash->error("他のプロセスから受注明細データが変更されたため更新を中止しました。"
                . $id . ",uid=" . $juchuu_meisai_dt->kousin_user_id . " tb=" . $juchuu_meisai_dt->updated ." pt=" . $this->request->getPost("updated"));

            $this->dispatcher->forward(array(
                'controller' => "juchuu_meisai_dts",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $post_flds = [];
        $post_flds = ["cd",
            "utiwake_kbn_cd",
            "juchuu_dt_id",
            "shouhin_mr_cd",
            "tanni_mr_cd",
            "kousei",
            "irisuu",
            "keisu",
            "tekiyou",
            "lot",
            "kobetucd",
            "hinsitu_kbn_cd",
            "souko_mr_cd",
            "kikaku",
            "iro",
            "iromei",
            "size",
            "suuryou",
            "gentanka",
            "tanka",
            "kingaku",
            "genkagaku",
            "zeinukigaku",
            "zeigaku",
            "project_mr_cd",
            "zeiritu_mr_cd",
            "bikou",
            "nouki",
            "hacchuurendou_flg",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        $chg_flg = 0;
        foreach ($post_flds as $post_fld) {
            if ((array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld)) !== $juchuu_meisai_dt->$post_fld) {
                $chg_flg = 1;
                break;
            }
        }
        if ($chg_flg === 0) {
            $this->flash->error("変更がありません。" . $id);

            $this->dispatcher->forward(array(
                "controller" => "juchuu_meisai_dts",
                "action" => "edit",
                "params" => array($juchuu_meisai_dt->id)
            ));

            return;
        }

        $this->_bakOut($juchuu_meisai_dt);

        foreach ($post_flds as $post_fld) {
            $juchuu_meisai_dt->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$juchuu_meisai_dt->save()) {

            foreach ($juchuu_meisai_dt->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "juchuu_meisai_dts",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $this->flash->success("受注明細データの情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "juchuu_meisai_dts",
            'action' => 'edit',
            'params' => array($juchuu_meisai_dt->id)
        ));
    }

    /**
     * Deletes a juchuu_meisai_dt
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $juchuu_meisai_dt = JuchuuMeisaiDts::findFirstByid($id);
        if (!$juchuu_meisai_dt) {
            $this->flash->error("受注明細データが見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "juchuu_meisai_dts",
                'action' => 'index'
            ));

            return;
        }

        $this->_bakOut($juchuu_meisai_dt, 1);

        if (!$juchuu_meisai_dt->delete()) {

            foreach ($juchuu_meisai_dt->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "juchuu_meisai_dts",
                'action' => 'search'
            ));

            return;
        }

        $this->flash->success("受注明細データの削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "juchuu_meisai_dts",
            'action' => "index"
        ));
    }

    /**
     * Back Out a juchuu_meisai_dt
     *
     * @param string $juchuu_meisai_dt, $dlt_flg
     */
    public function _bakOut($juchuu_meisai_dt, $dlt_flg = 0)
    {

        $bak_juchuu_meisai_dt = new BakJuchuuMeisaiDts();
        foreach ($juchuu_meisai_dt as $fld => $value) {
            $bak_juchuu_meisai_dt->$fld = $juchuu_meisai_dt->$fld;
        }
        $bak_juchuu_meisai_dt->id = NULL;
        $bak_juchuu_meisai_dt->id_moto = $juchuu_meisai_dt->id;
        $bak_juchuu_meisai_dt->hikae_dltflg = $dlt_flg;
        $bak_juchuu_meisai_dt->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_juchuu_meisai_dt->hikae_nichiji = date("Y-m-d H:i:s");
        if (!$bak_juchuu_meisai_dt->save()) {
            foreach ($bak_juchuu_meisai_dt->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
    }

    /**
     * 単価の履歴を確認するためのアクション
     * Add By Nishiyama 2019/5/9
     */
    public function historyAction()
    {
        $di = \Phalcon\DI::getDefault();
        $mgr = $di->get('modelsManager');
        $cd = $this->request->getQuery('cd');
        $tokuisaki = $this->request->getQuery('tokuisaki');
        $where = " WHERE (a.shouhin_mr_cd = :cd: AND b.tokuisaki_mr_cd = :tokuisaki:)";
        $phql = "
        SELECT
            a.juchuu_dt_id AS juchuu_dt_id,
            a.shouhin_mr_cd AS shouhin_mr_cd,
            a.tekiyou AS tekiyou,
            a.souko_mr_cd AS souko_mr_cd,
            a.kikaku AS kikaku,
            a.iro AS iro,
            a.size AS size,
            a.suuryou AS suuryou,
            a.tanka AS tanka,
            a.kingaku AS kingaku,
            a.bikou AS bikou,
            a.updated AS updated
        FROM JuchuuMeisaiDts AS a
        LEFT JOIN JuchuuDts AS b ON b.id = a.juchuu_dt_id
        " . $where . "
        ORDER BY a.updated DESC
        ";
        $juchuu_meisai_dts = $mgr->executeQuery($phql, [
            "cd" => $cd,
            "tokuisaki" => $tokuisaki,
        ]);
        $this->view->juchuu_meisai_dts = $juchuu_meisai_dts;
    }
}
