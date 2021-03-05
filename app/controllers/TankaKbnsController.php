<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class TankaKbnsController extends ControllerBase
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
            $query = Criteria::fromInput($this->di, 'TankaKbns', $_POST);
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
            $numberPage = TankaKbns::count($parameters1) / 10 + 1;
        }

        $tanka_kbns = TankaKbns::find($parameters);
        if (count($tanka_kbns) == 0) {
            $this->flash->notice("検索の結果、単価種類は０件でした。");
        }

        $paginator = new Paginator(array(
            'data' => $tanka_kbns,
            'limit'=> 10,
            'page' => $numberPage
        ));

        $this->view->page = $paginator->getPaginate();
    }

    /**
     * Searches for tanka_kbns
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
     * Edits a tanka_kbn
     *
     * @param string $id
     */
    public function editAction($id)
    {
        if (!$this->request->isPost()) {

            $tanka_kbn = TankaKbns::findFirstByid($id);
            if (!$tanka_kbn) {
                $this->flash->error("単価種類が見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "tanka_kbns",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->id = $tanka_kbn->id;

            $this->tag->setDefault("id", $tanka_kbn->id);
            $this->tag->setDefault("cd", $tanka_kbn->cd);
            $this->tag->setDefault("name", $tanka_kbn->name);
            $this->tag->setDefault("id_moto", $tanka_kbn->id_moto);
            $this->tag->setDefault("hikae_dltflg", $tanka_kbn->hikae_dltflg);
            $this->tag->setDefault("hikae_user_id", $tanka_kbn->hikae_user_id);
            $this->tag->setDefault("hikae_nichiji", $tanka_kbn->hikae_nichiji);
            $this->tag->setDefault("sakusei_user_id", $tanka_kbn->sakusei_user_id);
            $this->tag->setDefault("created", $tanka_kbn->created);
            $this->tag->setDefault("kousin_user_id", $tanka_kbn->kousin_user_id);
            $this->tag->setDefault("updated", $tanka_kbn->updated);
            
        }
    }

    /**
     * Creates a new tanka_kbn
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "tanka_kbns",
                'action' => 'index'
            ));

            return;
        }

        $tanka_kbn = new TankaKbns();
        $post_flds = ["cd","name","updated",];
        foreach ($post_flds as $post_fld) {
            $tanka_kbn->$post_fld = $this->request->getPost($post_fld);
        }
        

        if (!$tanka_kbn->save()) {
            foreach ($tanka_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "tanka_kbns",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("単価種類の作成が完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "tanka_kbns",
            'action' => 'edit',
            'params' => array($tanka_kbn->id)
        ));
    }

    /**
     * Saves a tanka_kbn edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "tanka_kbns",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $tanka_kbn = TankaKbns::findFirstByid($id);

        if (!$tanka_kbn) {
            $this->flash->error("単価種類が見つからなくなりました。" . $id);

            $this->dispatcher->forward(array(
                'controller' => "tanka_kbns",
                'action' => 'index'
            ));

            return;
        }

        $post_flds = ["cd","name","updated",];
        $chg_flg = 0;
        foreach ($post_flds as $post_fld) {
            if ($tanka_kbn->$post_fld != $this->request->getPost($post_fld)) {$chg_flg = 1; break;}
        }
        if ($chg_flg === 0) {
            $this->flash->error("変更がありません。" . $id);

            $this->dispatcher->forward(array(
                "controller" => "tanka_kbns",
                "action" => "edit",
                "params" => array($tanka_kbn->id)
            ));

            return;
        }

        $this->_bakOut($tanka_kbn);

        foreach ($post_flds as $post_fld) {
            $tanka_kbn->$post_fld = $this->request->getPost($post_fld);
        }
        

        if (!$tanka_kbn->save()) {

            foreach ($tanka_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "tanka_kbns",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $this->flash->success("単価種類の情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "tanka_kbns",
            'action' => 'edit',
            'params' => array($tanka_kbn->id)
        ));
    }

    /**
     * Deletes a tanka_kbn
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $tanka_kbn = TankaKbns::findFirstByid($id);
        if (!$tanka_kbn) {
            $this->flash->error("単価種類が見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "tanka_kbns",
                'action' => 'index'
            ));

            return;
        }

        if (!$tanka_kbn->delete()) {

            foreach ($tanka_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "tanka_kbns",
                'action' => 'search'
            ));

            return;
        }

        $this->_bakOut($tanka_kbn, 1);

        $this->flash->success("単価種類の削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "tanka_kbns",
            'action' => "index"
        ));
    }

    /**
     * Back Out a tanka_kbn
     *
     * @param string $tanka_kbn, $dlt_flg
     */
    public function _bakOut($tanka_kbn, $dlt_flg = 0)
    {

        $bak_tanka_kbn = new BakTankaKbns();
        foreach ($tanka_kbn as $fld => $value) {
            $bak_tanka_kbn->$fld = $tanka_kbn->$fld;
        }
        $bak_tanka_kbn->id = NULL;
        $bak_tanka_kbn->id_moto = $tanka_kbn->id;
        $bak_tanka_kbn->hikae_dltflg = $dlt_flg;
        $bak_tanka_kbn->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_tanka_kbn->hikae_nichiji = date("Y-m-d H:i:s");
        if (!$bak_tanka_kbn->save()) {
            foreach ($bak_tanka_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
    }

}
