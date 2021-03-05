<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class ShukkaKbnsController extends ControllerBase
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
            $query = Criteria::fromInput($this->di, 'ShukkaKbns', $_POST);
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
            $numberPage = ShukkaKbns::count($parameters1) / 10 + 1;
        }

        $shukka_kbns = ShukkaKbns::find($parameters);
        if (count($shukka_kbns) == 0) {
            $this->flash->notice("検索の結果、出荷区分は０件でした。");
        }

        $paginator = new Paginator(array(
            'data' => $shukka_kbns,
            'limit'=> 10,
            'page' => $numberPage
        ));

        $this->view->page = $paginator->getPaginate();
    }

    /**
     * Searches for shukka_kbns
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
     * Edits a shukka_kbn
     *
     * @param string $id
     */
    public function editAction($id)
    {
        if (!$this->request->isPost()) {

            $shukka_kbn = ShukkaKbns::findFirstByid($id);
            if (!$shukka_kbn) {
                $this->flash->error("出荷区分が見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "shukka_kbns",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->id = $shukka_kbn->id;

            $this->tag->setDefault("id", $shukka_kbn->id);
            $this->tag->setDefault("cd", $shukka_kbn->cd);
            $this->tag->setDefault("name", $shukka_kbn->name);
            $this->tag->setDefault("id_moto", $shukka_kbn->id_moto);
            $this->tag->setDefault("hikae_dltflg", $shukka_kbn->hikae_dltflg);
            $this->tag->setDefault("hikae_user_id", $shukka_kbn->hikae_user_id);
            $this->tag->setDefault("hikae_nichiji", $shukka_kbn->hikae_nichiji);
            $this->tag->setDefault("sakusei_user_id", $shukka_kbn->sakusei_user_id);
            $this->tag->setDefault("created", $shukka_kbn->created);
            $this->tag->setDefault("kousin_user_id", $shukka_kbn->kousin_user_id);
            $this->tag->setDefault("updated", $shukka_kbn->updated);
            
        }
    }

    /**
     * Creates a new shukka_kbn
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "shukka_kbns",
                'action' => 'index'
            ));

            return;
        }

        $shukka_kbn = new ShukkaKbns();
        $post_flds = ["cd","name","updated",];
        foreach ($post_flds as $post_fld) {
            $shukka_kbn->$post_fld = $this->request->getPost($post_fld);
        }
        

        if (!$shukka_kbn->save()) {
            foreach ($shukka_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "shukka_kbns",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("出荷区分の作成が完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "shukka_kbns",
            'action' => 'edit',
            'params' => array($shukka_kbn->id)
        ));
    }

    /**
     * Saves a shukka_kbn edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "shukka_kbns",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $shukka_kbn = ShukkaKbns::findFirstByid($id);

        if (!$shukka_kbn) {
            $this->flash->error("出荷区分が見つからなくなりました。" . $id);

            $this->dispatcher->forward(array(
                'controller' => "shukka_kbns",
                'action' => 'index'
            ));

            return;
        }

        $post_flds = ["cd","name","updated",];
        $chg_flg = 0;
        foreach ($post_flds as $post_fld) {
            if ($shukka_kbn->$post_fld != $this->request->getPost($post_fld)) {$chg_flg = 1; break;}
        }
        if ($chg_flg === 0) {
            $this->flash->error("変更がありません。" . $id);

            $this->dispatcher->forward(array(
                "controller" => "shukka_kbns",
                "action" => "edit",
                "params" => array($shukka_kbn->id)
            ));

            return;
        }

        $this->_bakOut($shukka_kbn);

        foreach ($post_flds as $post_fld) {
            $shukka_kbn->$post_fld = $this->request->getPost($post_fld);
        }
        

        if (!$shukka_kbn->save()) {

            foreach ($shukka_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "shukka_kbns",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $this->flash->success("出荷区分の情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "shukka_kbns",
            'action' => 'edit',
            'params' => array($shukka_kbn->id)
        ));
    }

    /**
     * Deletes a shukka_kbn
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $shukka_kbn = ShukkaKbns::findFirstByid($id);
        if (!$shukka_kbn) {
            $this->flash->error("出荷区分が見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "shukka_kbns",
                'action' => 'index'
            ));

            return;
        }

        if (!$shukka_kbn->delete()) {

            foreach ($shukka_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "shukka_kbns",
                'action' => 'search'
            ));

            return;
        }

        $this->_bakOut($shukka_kbn, 1);

        $this->flash->success("出荷区分の削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "shukka_kbns",
            'action' => "index"
        ));
    }

    /**
     * Back Out a shukka_kbn
     *
     * @param string $shukka_kbn, $dlt_flg
     */
    public function _bakOut($shukka_kbn, $dlt_flg = 0)
    {

        $bak_shukka_kbn = new BakShukkaKbns();
        foreach ($shukka_kbn as $fld => $value) {
            $bak_shukka_kbn->$fld = $shukka_kbn->$fld;
        }
        $bak_shukka_kbn->id = NULL;
        $bak_shukka_kbn->id_moto = $shukka_kbn->id;
        $bak_shukka_kbn->hikae_dltflg = $dlt_flg;
        $bak_shukka_kbn->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_shukka_kbn->hikae_nichiji = date("Y-m-d H:i:s");
        if (!$bak_shukka_kbn->save()) {
            foreach ($bak_shukka_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
    }

}
