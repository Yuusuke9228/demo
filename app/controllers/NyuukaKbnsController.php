<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class NyuukaKbnsController extends ControllerBase
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
            $query = Criteria::fromInput($this->di, 'NyuukaKbns', $_POST);
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
            $numberPage = NyuukaKbns::count($parameters1) / 10 + 1;
        }

        $nyuuka_kbns = NyuukaKbns::find($parameters);
        if (count($nyuuka_kbns) == 0) {
            $this->flash->notice("検索の結果、入荷区分は０件でした。");
        }

        $paginator = new Paginator(array(
            'data' => $nyuuka_kbns,
            'limit'=> 10,
            'page' => $numberPage
        ));

        $this->view->page = $paginator->getPaginate();
    }

    /**
     * Searches for nyuuka_kbns
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
     * Edits a nyuuka_kbn
     *
     * @param string $id
     */
    public function editAction($id)
    {
        if (!$this->request->isPost()) {

            $nyuuka_kbn = NyuukaKbns::findFirstByid($id);
            if (!$nyuuka_kbn) {
                $this->flash->error("入荷区分が見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "nyuuka_kbns",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->id = $nyuuka_kbn->id;

            $this->tag->setDefault("id", $nyuuka_kbn->id);
            $this->tag->setDefault("cd", $nyuuka_kbn->cd);
            $this->tag->setDefault("name", $nyuuka_kbn->name);
            $this->tag->setDefault("id_moto", $nyuuka_kbn->id_moto);
            $this->tag->setDefault("hikae_dltflg", $nyuuka_kbn->hikae_dltflg);
            $this->tag->setDefault("hikae_user_id", $nyuuka_kbn->hikae_user_id);
            $this->tag->setDefault("hikae_nichiji", $nyuuka_kbn->hikae_nichiji);
            $this->tag->setDefault("sakusei_user_id", $nyuuka_kbn->sakusei_user_id);
            $this->tag->setDefault("created", $nyuuka_kbn->created);
            $this->tag->setDefault("kousin_user_id", $nyuuka_kbn->kousin_user_id);
            $this->tag->setDefault("updated", $nyuuka_kbn->updated);
            
        }
    }

    /**
     * Creates a new nyuuka_kbn
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "nyuuka_kbns",
                'action' => 'index'
            ));

            return;
        }

        $nyuuka_kbn = new NyuukaKbns();
        $post_flds = ["cd","name","updated",];
        foreach ($post_flds as $post_fld) {
            $nyuuka_kbn->$post_fld = $this->request->getPost($post_fld);
        }
        

        if (!$nyuuka_kbn->save()) {
            foreach ($nyuuka_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "nyuuka_kbns",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("入荷区分の作成が完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "nyuuka_kbns",
            'action' => 'edit',
            'params' => array($nyuuka_kbn->id)
        ));
    }

    /**
     * Saves a nyuuka_kbn edited
     *
     */
    public function saveAction()
    {
        ini_set('display_errors','on');
        error_reporting(E_ALL|E_NOTICE);
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "nyuuka_kbns",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $nyuuka_kbn = NyuukaKbns::findFirstByid($id);

        if (!$nyuuka_kbn) {
            $this->flash->error("入荷区分が見つからなくなりました。" . $id);

            $this->dispatcher->forward(array(
                'controller' => "nyuuka_kbns",
                'action' => 'index'
            ));

            return;
        }

        $post_flds = ["cd","name","updated",];
        $chg_flg = 0;
        foreach ($post_flds as $post_fld) {
            if ($nyuuka_kbn->$post_fld != $this->request->getPost($post_fld)) {$chg_flg = 1; break;}
        }
        if ($chg_flg === 0) {
            $this->flash->error("変更がありません。" . $id);

            $this->dispatcher->forward(array(
                "controller" => "nyuuka_kbns",
                "action" => "edit",
                "params" => array($nyuuka_kbn->id)
            ));

            return;
        }

        $this->_bakOut($nyuuka_kbn);

        foreach ($post_flds as $post_fld) {
            $nyuuka_kbn->$post_fld = $this->request->getPost($post_fld);
        }
        

        if (!$nyuuka_kbn->save()) {

            foreach ($nyuuka_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "nyuuka_kbns",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $this->flash->success("入荷区分の情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "nyuuka_kbns",
            'action' => 'edit',
            'params' => array($nyuuka_kbn->id)
        ));
    }

    /**
     * Deletes a nyuuka_kbn
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $nyuuka_kbn = NyuukaKbns::findFirstByid($id);
        if (!$nyuuka_kbn) {
            $this->flash->error("入荷区分が見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "nyuuka_kbns",
                'action' => 'index'
            ));

            return;
        }

        if (!$nyuuka_kbn->delete()) {

            foreach ($nyuuka_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "nyuuka_kbns",
                'action' => 'search'
            ));

            return;
        }

        $this->_bakOut($nyuuka_kbn, 1);

        $this->flash->success("入荷区分の削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "nyuuka_kbns",
            'action' => "index"
        ));
    }

    /**
     * Back Out a nyuuka_kbn
     *
     * @param string $nyuuka_kbn, $dlt_flg
     */
    public function _bakOut($nyuuka_kbn, $dlt_flg = 0)
    {

        $bak_nyuuka_kbn = new BakNyuukaKbns();
        foreach ($nyuuka_kbn as $fld => $value) {
            $bak_nyuuka_kbn->$fld = $nyuuka_kbn->$fld;
        }
        $bak_nyuuka_kbn->id = NULL;
        $bak_nyuuka_kbn->id_moto = $nyuuka_kbn->id;
        $bak_nyuuka_kbn->hikae_dltflg = $dlt_flg;
        $bak_nyuuka_kbn->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_nyuuka_kbn->hikae_nichiji = date("Y-m-d H:i:s");
        if (!$bak_nyuuka_kbn->save()) {
            foreach ($bak_nyuuka_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
    }

}
