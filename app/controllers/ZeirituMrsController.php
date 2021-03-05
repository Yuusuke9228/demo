<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class ZeirituMrsController extends ControllerBase
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
            $query = Criteria::fromInput($this->di, 'ZeirituMrs', $_POST);
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
            $numberPage = ZeirituMrs::count($parameters1) / 10 + 1;
        }

        $zeiritu_mrs = ZeirituMrs::find($parameters);
        if (count($zeiritu_mrs) == 0) {
            $this->flash->notice("検索の結果、税率マスタは０件でした。");
        }

        $paginator = new Paginator(array(
            'data' => $zeiritu_mrs,
            'limit'=> 10,
            'page' => $numberPage
        ));

        $this->view->page = $paginator->getPaginate();
    }

    /**
     * Searches for zeiritu_mrs
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
     * Edits a zeiritu_mr
     *
     * @param string $id
     */
    public function editAction($id)
    {
        if (!$this->request->isPost()) {

            $zeiritu_mr = ZeirituMrs::findFirstByid($id);
            if (!$zeiritu_mr) {
                $this->flash->error("税率マスタが見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "zeiritu_mrs",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->id = $zeiritu_mr->id;

            $this->tag->setDefault("id", $zeiritu_mr->id);
            $this->tag->setDefault("cd", $zeiritu_mr->cd);
            $this->tag->setDefault("name", $zeiritu_mr->name);
            $this->tag->setDefault("ryakushou", $zeiritu_mr->ryakushou);
            $this->tag->setDefault("kazei_kbn_cd", $zeiritu_mr->kazei_kbn_cd);
            $this->tag->setDefault("zeiritu", $zeiritu_mr->zeiritu);
            $this->tag->setDefault("kijunbi", $zeiritu_mr->kijunbi);
            $this->tag->setDefault("id_moto", $zeiritu_mr->id_moto);
            $this->tag->setDefault("hikae_dltflg", $zeiritu_mr->hikae_dltflg);
            $this->tag->setDefault("hikae_user_id", $zeiritu_mr->hikae_user_id);
            $this->tag->setDefault("hikae_nichiji", $zeiritu_mr->hikae_nichiji);
            $this->tag->setDefault("sakusei_user_id", $zeiritu_mr->sakusei_user_id);
            $this->tag->setDefault("created", $zeiritu_mr->created);
            $this->tag->setDefault("kousin_user_id", $zeiritu_mr->kousin_user_id);
            $this->tag->setDefault("updated", $zeiritu_mr->updated);
            
        }
    }

    /**
     * Creates a new zeiritu_mr
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "zeiritu_mrs",
                'action' => 'index'
            ));

            return;
        }

        $zeiritu_mr = new ZeirituMrs();
        $post_flds = ["cd","name","ryakushou","kazei_kbn_cd","zeiritu","kijunbi","updated",];
        foreach ($post_flds as $post_fld) {
            $zeiritu_mr->$post_fld = $this->request->getPost($post_fld);
        }
        

        if (!$zeiritu_mr->save()) {
            foreach ($zeiritu_mr->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "zeiritu_mrs",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("税率マスタの作成が完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "zeiritu_mrs",
            'action' => 'edit',
            'params' => array($zeiritu_mr->id)
        ));
    }

    /**
     * Saves a zeiritu_mr edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "zeiritu_mrs",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $zeiritu_mr = ZeirituMrs::findFirstByid($id);

        if (!$zeiritu_mr) {
            $this->flash->error("税率マスタが見つからなくなりました。" . $id);

            $this->dispatcher->forward(array(
                'controller' => "zeiritu_mrs",
                'action' => 'index'
            ));

            return;
        }

        $post_flds = ["cd","name","ryakushou","kazei_kbn_cd","zeiritu","kijunbi","updated",];
        $chg_flg = 0;
        foreach ($post_flds as $post_fld) {
            if ($zeiritu_mr->$post_fld != $this->request->getPost($post_fld)) {$chg_flg = 1; break;}
        }
        if ($chg_flg === 0) {
            $this->flash->error("変更がありません。" . $id);

            $this->dispatcher->forward(array(
                "controller" => "zeiritu_mrs",
                "action" => "edit",
                "params" => array($zeiritu_mr->id)
            ));

            return;
        }

        $this->_bakOut($zeiritu_mr);

        foreach ($post_flds as $post_fld) {
            $zeiritu_mr->$post_fld = $this->request->getPost($post_fld);
        }
        

        if (!$zeiritu_mr->save()) {

            foreach ($zeiritu_mr->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "zeiritu_mrs",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $this->flash->success("税率マスタの情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "zeiritu_mrs",
            'action' => 'edit',
            'params' => array($zeiritu_mr->id)
        ));
    }

    /**
     * Deletes a zeiritu_mr
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $zeiritu_mr = ZeirituMrs::findFirstByid($id);
        if (!$zeiritu_mr) {
            $this->flash->error("税率マスタが見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "zeiritu_mrs",
                'action' => 'index'
            ));

            return;
        }

        if (!$zeiritu_mr->delete()) {

            foreach ($zeiritu_mr->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "zeiritu_mrs",
                'action' => 'search'
            ));

            return;
        }

        $this->_bakOut($zeiritu_mr, 1);

        $this->flash->success("税率マスタの削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "zeiritu_mrs",
            'action' => "index"
        ));
    }

    /**
     * Back Out a zeiritu_mr
     *
     * @param string $zeiritu_mr, $dlt_flg
     */
    public function _bakOut($zeiritu_mr, $dlt_flg = 0)
    {

        $bak_zeiritu_mr = new BakZeirituMrs();
        foreach ($zeiritu_mr as $fld => $value) {
            $bak_zeiritu_mr->$fld = $zeiritu_mr->$fld;
        }
        $bak_zeiritu_mr->id = NULL;
        $bak_zeiritu_mr->id_moto = $zeiritu_mr->id;
        $bak_zeiritu_mr->hikae_dltflg = $dlt_flg;
        $bak_zeiritu_mr->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_zeiritu_mr->hikae_nichiji = date("Y-m-d H:i:s");
        if (!$bak_zeiritu_mr->save()) {
            foreach ($bak_zeiritu_mr->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
    }

}
