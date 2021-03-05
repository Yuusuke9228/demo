<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class ZeitenkaKbnsController extends ControllerBase
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
            $query = Criteria::fromInput($this->di, 'ZeitenkaKbns', $_POST);
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
            $numberPage = ZeitenkaKbns::count($parameters1) / 10 + 1;
        }

        $zeitenka_kbns = ZeitenkaKbns::find($parameters);
        if (count($zeitenka_kbns) == 0) {
            $this->flash->notice("検索の結果、税転嫁区分は０件でした。");
        }

        $paginator = new Paginator(array(
            'data' => $zeitenka_kbns,
            'limit'=> 10,
            'page' => $numberPage
        ));

        $this->view->page = $paginator->getPaginate();
    }

    /**
     * Searches for zeitenka_kbns
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
     * Edits a zeitenka_kbn
     *
     * @param string $id
     */
    public function editAction($id)
    {
        if (!$this->request->isPost()) {

            $zeitenka_kbn = ZeitenkaKbns::findFirstByid($id);
            if (!$zeitenka_kbn) {
                $this->flash->error("税転嫁区分が見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "zeitenka_kbns",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->id = $zeitenka_kbn->id;

            $this->tag->setDefault("id", $zeitenka_kbn->id);
            $this->tag->setDefault("cd", $zeitenka_kbn->cd);
            $this->tag->setDefault("name", $zeitenka_kbn->name);
            $this->tag->setDefault("yayoi_kbn", $zeitenka_kbn->yayoi_kbn);
            $this->tag->setDefault("id_moto", $zeitenka_kbn->id_moto);
            $this->tag->setDefault("hikae_dltflg", $zeitenka_kbn->hikae_dltflg);
            $this->tag->setDefault("hikae_user_id", $zeitenka_kbn->hikae_user_id);
            $this->tag->setDefault("hikae_nichiji", $zeitenka_kbn->hikae_nichiji);
            $this->tag->setDefault("sakusei_user_id", $zeitenka_kbn->sakusei_user_id);
            $this->tag->setDefault("created", $zeitenka_kbn->created);
            $this->tag->setDefault("kousin_user_id", $zeitenka_kbn->kousin_user_id);
            $this->tag->setDefault("updated", $zeitenka_kbn->updated);
            
        }
    }

    /**
     * Creates a new zeitenka_kbn
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "zeitenka_kbns",
                'action' => 'index'
            ));

            return;
        }

        $zeitenka_kbn = new ZeitenkaKbns();
        $post_flds = ["cd","name","yayoi_kbn","updated",];
        foreach ($post_flds as $post_fld) {
            $zeitenka_kbn->$post_fld = $this->request->getPost($post_fld);
        }
        

        if (!$zeitenka_kbn->save()) {
            foreach ($zeitenka_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "zeitenka_kbns",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("税転嫁区分の作成が完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "zeitenka_kbns",
            'action' => 'edit',
            'params' => array($zeitenka_kbn->id)
        ));
    }

    /**
     * Saves a zeitenka_kbn edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "zeitenka_kbns",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $zeitenka_kbn = ZeitenkaKbns::findFirstByid($id);

        if (!$zeitenka_kbn) {
            $this->flash->error("税転嫁区分が見つからなくなりました。" . $id);

            $this->dispatcher->forward(array(
                'controller' => "zeitenka_kbns",
                'action' => 'index'
            ));

            return;
        }

        $post_flds = ["cd","name","yayoi_kbn","updated",];
        $chg_flg = 0;
        foreach ($post_flds as $post_fld) {
            if ($zeitenka_kbn->$post_fld != $this->request->getPost($post_fld)) {$chg_flg = 1; break;}
        }
        if ($chg_flg === 0) {
            $this->flash->error("変更がありません。" . $id);

            $this->dispatcher->forward(array(
                "controller" => "zeitenka_kbns",
                "action" => "edit",
                "params" => array($zeitenka_kbn->id)
            ));

            return;
        }

        $this->_bakOut($zeitenka_kbn);

        foreach ($post_flds as $post_fld) {
            $zeitenka_kbn->$post_fld = $this->request->getPost($post_fld);
        }
        

        if (!$zeitenka_kbn->save()) {

            foreach ($zeitenka_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "zeitenka_kbns",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $this->flash->success("税転嫁区分の情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "zeitenka_kbns",
            'action' => 'edit',
            'params' => array($zeitenka_kbn->id)
        ));
    }

    /**
     * Deletes a zeitenka_kbn
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $zeitenka_kbn = ZeitenkaKbns::findFirstByid($id);
        if (!$zeitenka_kbn) {
            $this->flash->error("税転嫁区分が見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "zeitenka_kbns",
                'action' => 'index'
            ));

            return;
        }

        if (!$zeitenka_kbn->delete()) {

            foreach ($zeitenka_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "zeitenka_kbns",
                'action' => 'search'
            ));

            return;
        }

        $this->_bakOut($zeitenka_kbn, 1);

        $this->flash->success("税転嫁区分の削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "zeitenka_kbns",
            'action' => "index"
        ));
    }

    /**
     * Back Out a zeitenka_kbn
     *
     * @param string $zeitenka_kbn, $dlt_flg
     */
    public function _bakOut($zeitenka_kbn, $dlt_flg = 0)
    {

        $bak_zeitenka_kbn = new BakZeitenkaKbns();
        foreach ($zeitenka_kbn as $fld => $value) {
            $bak_zeitenka_kbn->$fld = $zeitenka_kbn->$fld;
        }
        $bak_zeitenka_kbn->id = NULL;
        $bak_zeitenka_kbn->id_moto = $zeitenka_kbn->id;
        $bak_zeitenka_kbn->hikae_dltflg = $dlt_flg;
        $bak_zeitenka_kbn->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_zeitenka_kbn->hikae_nichiji = date("Y-m-d H:i:s");
        if (!$bak_zeitenka_kbn->save()) {
            foreach ($bak_zeitenka_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
    }

}
