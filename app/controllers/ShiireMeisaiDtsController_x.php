<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class ShiireMeisaiDtsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $numberPage = 1;
        $sort = "cd";
        $order = "ASC";
        $wherecd = "";
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'ShiireMeisaiDts', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $sort = $this->request->getQuery("sort") ?? $sort;
            $sort .= ' ' . $this->request->getQuery("order") ?? $order;
            $numberPage = $this->request->getQuery("page", "int");
            $wherecd = $this->request->getQuery("cd");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = array();
        }
        $parameters["order"] = $sort;

        if ($wherecd) { /* 現在のコードのページを開く */
            $parameters1 = $parameters;
            $parameters1["conditions"] = "cd < '". $wherecd ."'";
            $numberPage = ShiireMeisaiDts::count($parameters1) / 10 + 1;
        }

        $shiire_meisai_dts = ShiireMeisaiDts::find($parameters);
        if (count($shiire_meisai_dts) == 0) {
            $this->flash->notice("検索の結果、仕入明細データは０件でした。");
        }

        $paginator = new Paginator(array(
            'data' => $shiire_meisai_dts,
            'limit'=> 10,
            'page' => $numberPage
        ));

        $this->view->page = $paginator->getPaginate();
    }

    /**
     * Searches for shiire_meisai_dts
     */
    public function searchAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Displays the creation form
     */
    public function newAction()
    {

    }

    /**
     * Edits a shiire_meisai_dt
     *
     * @param string $id
     */
    public function editAction($id)
    {
        if (!$this->request->isPost()) {

            $shiire_meisai_dt = ShiireMeisaiDts::findFirstByid($id);
            if (!$shiire_meisai_dt) {
                $this->flash->error("仕入明細データが見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "shiire_meisai_dts",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->id = $shiire_meisai_dt->id;

            $this->tag->setDefault("id", $shiire_meisai_dt->id);
            $this->tag->setDefault("cd", $shiire_meisai_dt->cd);
            $this->tag->setDefault("utiwake_kbn_cd", $shiire_meisai_dt->utiwake_kbn_cd);
            $this->tag->setDefault("shiire_dt_id", $shiire_meisai_dt->shiire_dt_id);
            $this->tag->setDefault("nyuuka_kbn_cd", $shiire_meisai_dt->nyuuka_kbn_cd);
            $this->tag->setDefault("shouhin_mr_cd", $shiire_meisai_dt->shouhin_mr_cd);
            $this->tag->setDefault("tanni_mr_cd", $shiire_meisai_dt->tanni_mr_cd);
            $this->tag->setDefault("irisuu", $shiire_meisai_dt->irisuu);
            $this->tag->setDefault("keisu", $shiire_meisai_dt->keisu);
            $this->tag->setDefault("tekiyou", $shiire_meisai_dt->tekiyou);
            $this->tag->setDefault("souko_mr_cd", $shiire_meisai_dt->souko_mr_cd);
            $this->tag->setDefault("suuryou", $shiire_meisai_dt->suuryou);
            $this->tag->setDefault("tanka", $shiire_meisai_dt->tanka);
            $this->tag->setDefault("kingaku", $shiire_meisai_dt->kingaku);
            $this->tag->setDefault("project_mr_cd", $shiire_meisai_dt->project_mr_cd);
            $this->tag->setDefault("kazei_kbn_cd", $shiire_meisai_dt->kazei_kbn_cd);
            $this->tag->setDefault("bikou", $shiire_meisai_dt->bikou);
            $this->tag->setDefault("id_moto", $shiire_meisai_dt->id_moto);
            $this->tag->setDefault("hikae_dltflg", $shiire_meisai_dt->hikae_dltflg);
            $this->tag->setDefault("hikae_user_id", $shiire_meisai_dt->hikae_user_id);
            $this->tag->setDefault("hikae_nichiji", $shiire_meisai_dt->hikae_nichiji);
            $this->tag->setDefault("sakusei_user_id", $shiire_meisai_dt->sakusei_user_id);
            $this->tag->setDefault("created", $shiire_meisai_dt->created);
            $this->tag->setDefault("kousin_user_id", $shiire_meisai_dt->kousin_user_id);
            $this->tag->setDefault("updated", $shiire_meisai_dt->updated);
            
        }
    }

    /**
     * Creates a new shiire_meisai_dt
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "shiire_meisai_dts",
                'action' => 'index'
            ));

            return;
        }

        $shiire_meisai_dt = new ShiireMeisaiDts();
        $post_flds = ["cd","utiwake_kbn_cd","shiire_dt_id","nyuuka_kbn_cd","shouhin_mr_cd","tanni_mr_cd","irisuu","keisu","tekiyou","souko_mr_cd","suuryou","tanka","kingaku","project_mr_cd","kazei_kbn_cd","bikou","updated",];
        foreach ($post_flds as $post_fld) {
            $shiire_meisai_dt->$post_fld = $this->request->getPost($post_fld);
        }
        

        if (!$shiire_meisai_dt->save()) {
            foreach ($shiire_meisai_dt->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "shiire_meisai_dts",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("仕入明細データの作成が完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "shiire_meisai_dts",
            'action' => 'edit',
            'params' => array($shiire_meisai_dt->id)
        ));
    }

    /**
     * Saves a shiire_meisai_dt edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "shiire_meisai_dts",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $shiire_meisai_dt = ShiireMeisaiDts::findFirstByid($id);

        if (!$shiire_meisai_dt) {
            $this->flash->error("仕入明細データが見つからなくなりました。" . $id);

            $this->dispatcher->forward(array(
                'controller' => "shiire_meisai_dts",
                'action' => 'index'
            ));

            return;
        }

        $post_flds = ["cd","utiwake_kbn_cd","shiire_dt_id","nyuuka_kbn_cd","shouhin_mr_cd","tanni_mr_cd","irisuu","keisu","tekiyou","souko_mr_cd","suuryou","tanka","kingaku","project_mr_cd","kazei_kbn_cd","bikou","updated",];
        $chg_flg = 0;
        foreach ($post_flds as $post_fld) {
            if ($shiire_meisai_dt->$post_fld != $this->request->getPost($post_fld)) {$chg_flg = 1; break;}
        }
        if ($chg_flg === 0) {
            $this->flash->error("変更がありません。" . $id);

            $this->dispatcher->forward(array(
                "controller" => "shiire_meisai_dts",
                "action" => "edit",
                "params" => array($shiire_meisai_dt->id)
            ));

            return;
        }

        $this->_bakOut($shiire_meisai_dt);

        foreach ($post_flds as $post_fld) {
            $shiire_meisai_dt->$post_fld = $this->request->getPost($post_fld);
        }
        

        if (!$shiire_meisai_dt->save()) {

            foreach ($shiire_meisai_dt->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "shiire_meisai_dts",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $this->flash->success("仕入明細データの情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "shiire_meisai_dts",
            'action' => 'edit',
            'params' => array($shiire_meisai_dt->id)
        ));
    }

    /**
     * Deletes a shiire_meisai_dt
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $shiire_meisai_dt = ShiireMeisaiDts::findFirstByid($id);
        if (!$shiire_meisai_dt) {
            $this->flash->error("仕入明細データが見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "shiire_meisai_dts",
                'action' => 'index'
            ));

            return;
        }

        if (!$shiire_meisai_dt->delete()) {

            foreach ($shiire_meisai_dt->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "shiire_meisai_dts",
                'action' => 'search'
            ));

            return;
        }

        $this->_bakOut($shiire_meisai_dt, 1);

        $this->flash->success("仕入明細データの削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "shiire_meisai_dts",
            'action' => "index"
        ));
    }

    /**
     * Back Out a shiire_meisai_dt
     *
     * @param string $shiire_meisai_dt, $dlt_flg
     */
    public function _bakOut($shiire_meisai_dt, $dlt_flg = 0)
    {

        $bak_shiire_meisai_dt = new BakShiireMeisaiDts();
        foreach ($shiire_meisai_dt as $fld => $value) {
            $bak_shiire_meisai_dt->$fld = $shiire_meisai_dt->$fld;
        }
        $bak_shiire_meisai_dt->id = NULL;
        $bak_shiire_meisai_dt->id_moto = $shiire_meisai_dt->id;
        $bak_shiire_meisai_dt->hikae_dltflg = $dlt_flg;
        $bak_shiire_meisai_dt->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_shiire_meisai_dt->hikae_nichiji = date("Y-m-d H:i:s");
        if (!$bak_shiire_meisai_dt->save()) {
            foreach ($bak_shiire_meisai_dt->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
    }

}
