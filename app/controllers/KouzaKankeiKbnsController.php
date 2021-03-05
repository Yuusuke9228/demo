<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class KouzaKankeiKbnsController extends ControllerBase
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
            $query = Criteria::fromInput($this->di, 'KouzaKankeiKbns', $_POST);
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
            $numberPage = KouzaKankeiKbns::count($parameters1) / 10 + 1;
        }

        $kouza_kankei_kbns = KouzaKankeiKbns::find($parameters);
        if (count($kouza_kankei_kbns) == 0) {
            $this->flash->notice("検索の結果、口座関係区分は０件でした。");
        }

        $paginator = new Paginator(array(
            'data' => $kouza_kankei_kbns,
            'limit'=> 10,
            'page' => $numberPage
        ));

        $this->view->page = $paginator->getPaginate();
    }

    /**
     * Searches for kouza_kankei_kbns
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
     * Edits a kouza_kankei_kbn
     *
     * @param string $id
     */
    public function editAction($id)
    {
        if (!$this->request->isPost()) {

            $kouza_kankei_kbn = KouzaKankeiKbns::findFirstByid($id);
            if (!$kouza_kankei_kbn) {
                $this->flash->error("口座関係区分が見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "kouza_kankei_kbns",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->id = $kouza_kankei_kbn->id;

            $this->tag->setDefault("id", $kouza_kankei_kbn->id);
            $this->tag->setDefault("cd", $kouza_kankei_kbn->cd);
            $this->tag->setDefault("name", $kouza_kankei_kbn->name);
            $this->tag->setDefault("id_moto", $kouza_kankei_kbn->id_moto);
            $this->tag->setDefault("hikae_dltflg", $kouza_kankei_kbn->hikae_dltflg);
            $this->tag->setDefault("hikae_user_id", $kouza_kankei_kbn->hikae_user_id);
            $this->tag->setDefault("hikae_nichiji", $kouza_kankei_kbn->hikae_nichiji);
            $this->tag->setDefault("sakusei_user_id", $kouza_kankei_kbn->sakusei_user_id);
            $this->tag->setDefault("created", $kouza_kankei_kbn->created);
            $this->tag->setDefault("kousin_user_id", $kouza_kankei_kbn->kousin_user_id);
            $this->tag->setDefault("updated", $kouza_kankei_kbn->updated);
            
        }
    }

    /**
     * Creates a new kouza_kankei_kbn
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "kouza_kankei_kbns",
                'action' => 'index'
            ));

            return;
        }

        $kouza_kankei_kbn = new KouzaKankeiKbns();
        $post_flds = ["cd","name","updated",];
        foreach ($post_flds as $post_fld) {
            $kouza_kankei_kbn->$post_fld = $this->request->getPost($post_fld);
        }
        

        if (!$kouza_kankei_kbn->save()) {
            foreach ($kouza_kankei_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "kouza_kankei_kbns",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("口座関係区分の作成が完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "kouza_kankei_kbns",
            'action' => 'edit',
            'params' => array($kouza_kankei_kbn->id)
        ));
    }

    /**
     * Saves a kouza_kankei_kbn edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "kouza_kankei_kbns",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $kouza_kankei_kbn = KouzaKankeiKbns::findFirstByid($id);

        if (!$kouza_kankei_kbn) {
            $this->flash->error("口座関係区分が見つからなくなりました。" . $id);

            $this->dispatcher->forward(array(
                'controller' => "kouza_kankei_kbns",
                'action' => 'index'
            ));

            return;
        }

        $post_flds = ["cd","name","updated",];
        $chg_flg = 0;
        foreach ($post_flds as $post_fld) {
            if ($kouza_kankei_kbn->$post_fld != $this->request->getPost($post_fld)) {$chg_flg = 1; break;}
        }
        if ($chg_flg === 0) {
            $this->flash->error("変更がありません。" . $id);

            $this->dispatcher->forward(array(
                "controller" => "kouza_kankei_kbns",
                "action" => "edit",
                "params" => array($kouza_kankei_kbn->id)
            ));

            return;
        }

        $this->_bakOut($kouza_kankei_kbn);

        foreach ($post_flds as $post_fld) {
            $kouza_kankei_kbn->$post_fld = $this->request->getPost($post_fld);
        }
        

        if (!$kouza_kankei_kbn->save()) {

            foreach ($kouza_kankei_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "kouza_kankei_kbns",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $this->flash->success("口座関係区分の情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "kouza_kankei_kbns",
            'action' => 'edit',
            'params' => array($kouza_kankei_kbn->id)
        ));
    }

    /**
     * Deletes a kouza_kankei_kbn
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $kouza_kankei_kbn = KouzaKankeiKbns::findFirstByid($id);
        if (!$kouza_kankei_kbn) {
            $this->flash->error("口座関係区分が見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "kouza_kankei_kbns",
                'action' => 'index'
            ));

            return;
        }

        if (!$kouza_kankei_kbn->delete()) {

            foreach ($kouza_kankei_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "kouza_kankei_kbns",
                'action' => 'search'
            ));

            return;
        }

        $this->_bakOut($kouza_kankei_kbn, 1);

        $this->flash->success("口座関係区分の削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "kouza_kankei_kbns",
            'action' => "index"
        ));
    }

    /**
     * Back Out a kouza_kankei_kbn
     *
     * @param string $kouza_kankei_kbn, $dlt_flg
     */
    public function _bakOut($kouza_kankei_kbn, $dlt_flg = 0)
    {

        $bak_kouza_kankei_kbn = new BakKouzaKankeiKbns();
        foreach ($kouza_kankei_kbn as $fld => $value) {
            $bak_kouza_kankei_kbn->$fld = $kouza_kankei_kbn->$fld;
        }
        $bak_kouza_kankei_kbn->id = NULL;
        $bak_kouza_kankei_kbn->id_moto = $kouza_kankei_kbn->id;
        $bak_kouza_kankei_kbn->hikae_dltflg = $dlt_flg;
        $bak_kouza_kankei_kbn->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_kouza_kankei_kbn->hikae_nichiji = date("Y-m-d H:i:s");
        if (!$bak_kouza_kankei_kbn->save()) {
            foreach ($bak_kouza_kankei_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
    }

}
