<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class ShiireTorihikiKbnsController extends ControllerBase
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
            $query = Criteria::fromInput($this->di, 'ShiireTorihikiKbns', $_POST);
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
            $numberPage = ShiireTorihikiKbns::count($parameters1) / 10 + 1;
        }

        $shiire_torihiki_kbns = ShiireTorihikiKbns::find($parameters);
        if (count($shiire_torihiki_kbns) == 0) {
            $this->flash->notice("検索の結果、仕入取引区分は０件でした。");
        }

        $paginator = new Paginator(array(
            'data' => $shiire_torihiki_kbns,
            'limit'=> 10,
            'page' => $numberPage
        ));

        $this->view->page = $paginator->getPaginate();
    }

    /**
     * Searches for shiire_torihiki_kbns
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
     * Edits a shiire_torihiki_kbn
     *
     * @param string $id
     */
    public function editAction($id)
    {
        if (!$this->request->isPost()) {

            $shiire_torihiki_kbn = ShiireTorihikiKbns::findFirstByid($id);
            if (!$shiire_torihiki_kbn) {
                $this->flash->error("仕入取引区分が見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "shiire_torihiki_kbns",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->id = $shiire_torihiki_kbn->id;

            $this->tag->setDefault("id", $shiire_torihiki_kbn->id);
            $this->tag->setDefault("cd", $shiire_torihiki_kbn->cd);
            $this->tag->setDefault("name", $shiire_torihiki_kbn->name);
            $this->tag->setDefault("id_moto", $shiire_torihiki_kbn->id_moto);
            $this->tag->setDefault("hikae_dltflg", $shiire_torihiki_kbn->hikae_dltflg);
            $this->tag->setDefault("hikae_user_id", $shiire_torihiki_kbn->hikae_user_id);
            $this->tag->setDefault("hikae_nichiji", $shiire_torihiki_kbn->hikae_nichiji);
            $this->tag->setDefault("sakusei_user_id", $shiire_torihiki_kbn->sakusei_user_id);
            $this->tag->setDefault("created", $shiire_torihiki_kbn->created);
            $this->tag->setDefault("kousin_user_id", $shiire_torihiki_kbn->kousin_user_id);
            $this->tag->setDefault("updated", $shiire_torihiki_kbn->updated);
            
        }
    }

    /**
     * Creates a new shiire_torihiki_kbn
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "shiire_torihiki_kbns",
                'action' => 'index'
            ));

            return;
        }

        $shiire_torihiki_kbn = new ShiireTorihikiKbns();
        $post_flds = ["cd","name","updated",];
        foreach ($post_flds as $post_fld) {
            $shiire_torihiki_kbn->$post_fld = $this->request->getPost($post_fld);
        }
        

        if (!$shiire_torihiki_kbn->save()) {
            foreach ($shiire_torihiki_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "shiire_torihiki_kbns",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("仕入取引区分の作成が完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "shiire_torihiki_kbns",
            'action' => 'edit',
            'params' => array($shiire_torihiki_kbn->id)
        ));
    }

    /**
     * Saves a shiire_torihiki_kbn edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "shiire_torihiki_kbns",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $shiire_torihiki_kbn = ShiireTorihikiKbns::findFirstByid($id);

        if (!$shiire_torihiki_kbn) {
            $this->flash->error("仕入取引区分が見つからなくなりました。" . $id);

            $this->dispatcher->forward(array(
                'controller' => "shiire_torihiki_kbns",
                'action' => 'index'
            ));

            return;
        }

        $post_flds = ["cd","name","updated",];
        $chg_flg = 0;
        foreach ($post_flds as $post_fld) {
            if ($shiire_torihiki_kbn->$post_fld != $this->request->getPost($post_fld)) {$chg_flg = 1; break;}
        }
        if ($chg_flg === 0) {
            $this->flash->error("変更がありません。" . $id);

            $this->dispatcher->forward(array(
                "controller" => "shiire_torihiki_kbns",
                "action" => "edit",
                "params" => array($shiire_torihiki_kbn->id)
            ));

            return;
        }

        $this->_bakOut($shiire_torihiki_kbn);

        foreach ($post_flds as $post_fld) {
            $shiire_torihiki_kbn->$post_fld = $this->request->getPost($post_fld);
        }
        

        if (!$shiire_torihiki_kbn->save()) {

            foreach ($shiire_torihiki_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "shiire_torihiki_kbns",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $this->flash->success("仕入取引区分の情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "shiire_torihiki_kbns",
            'action' => 'edit',
            'params' => array($shiire_torihiki_kbn->id)
        ));
    }

    /**
     * Deletes a shiire_torihiki_kbn
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $shiire_torihiki_kbn = ShiireTorihikiKbns::findFirstByid($id);
        if (!$shiire_torihiki_kbn) {
            $this->flash->error("仕入取引区分が見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "shiire_torihiki_kbns",
                'action' => 'index'
            ));

            return;
        }

        if (!$shiire_torihiki_kbn->delete()) {

            foreach ($shiire_torihiki_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "shiire_torihiki_kbns",
                'action' => 'search'
            ));

            return;
        }

        $this->_bakOut($shiire_torihiki_kbn, 1);

        $this->flash->success("仕入取引区分の削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "shiire_torihiki_kbns",
            'action' => "index"
        ));
    }

    /**
     * Back Out a shiire_torihiki_kbn
     *
     * @param string $shiire_torihiki_kbn, $dlt_flg
     */
    public function _bakOut($shiire_torihiki_kbn, $dlt_flg = 0)
    {

        $bak_shiire_torihiki_kbn = new BakShiireTorihikiKbns();
        foreach ($shiire_torihiki_kbn as $fld => $value) {
            $bak_shiire_torihiki_kbn->$fld = $shiire_torihiki_kbn->$fld;
        }
        $bak_shiire_torihiki_kbn->id = NULL;
        $bak_shiire_torihiki_kbn->id_moto = $shiire_torihiki_kbn->id;
        $bak_shiire_torihiki_kbn->hikae_dltflg = $dlt_flg;
        $bak_shiire_torihiki_kbn->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_shiire_torihiki_kbn->hikae_nichiji = date("Y-m-d H:i:s");
        if (!$bak_shiire_torihiki_kbn->save()) {
            foreach ($bak_shiire_torihiki_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
    }

}
