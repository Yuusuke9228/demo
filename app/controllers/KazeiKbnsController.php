<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class KazeiKbnsController extends ControllerBase
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
            $query = Criteria::fromInput($this->di, 'KazeiKbns', $_POST);
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
            $numberPage = KazeiKbns::count($parameters1) / 10 + 1;
        }

        $kazei_kbns = KazeiKbns::find($parameters);
        if (count($kazei_kbns) == 0) {
            $this->flash->notice("検索の結果、課税区分は０件でした。");
        }

        $paginator = new Paginator(array(
            'data' => $kazei_kbns,
            'limit'=> 10,
            'page' => $numberPage
        ));

        $this->view->page = $paginator->getPaginate();
    }

    /**
     * Searches for kazei_kbns
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
     * Edits a kazei_kbn
     *
     * @param string $id
     */
    public function editAction($id)
    {
        if (!$this->request->isPost()) {

            $kazei_kbn = KazeiKbns::findFirstByid($id);
            if (!$kazei_kbn) {
                $this->flash->error("課税区分が見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "kazei_kbns",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->id = $kazei_kbn->id;

            $this->tag->setDefault("id", $kazei_kbn->id);
            $this->tag->setDefault("cd", $kazei_kbn->cd);
            $this->tag->setDefault("name", $kazei_kbn->name);
            $this->tag->setDefault("hyouji_jun", $kazei_kbn->hyouji_jun);
            $this->tag->setDefault("id_moto", $kazei_kbn->id_moto);
            $this->tag->setDefault("hikae_dltflg", $kazei_kbn->hikae_dltflg);
            $this->tag->setDefault("hikae_user_id", $kazei_kbn->hikae_user_id);
            $this->tag->setDefault("hikae_nichiji", $kazei_kbn->hikae_nichiji);
            $this->tag->setDefault("sakusei_user_id", $kazei_kbn->sakusei_user_id);
            $this->tag->setDefault("created", $kazei_kbn->created);
            $this->tag->setDefault("kousin_user_id", $kazei_kbn->kousin_user_id);
            $this->tag->setDefault("updated", $kazei_kbn->updated);
            
        }
    }

    /**
     * Creates a new kazei_kbn
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "kazei_kbns",
                'action' => 'index'
            ));

            return;
        }

        $kazei_kbn = new KazeiKbns();
        $post_flds = ["cd","name","hyouji_jun","updated",];
        foreach ($post_flds as $post_fld) {
            $kazei_kbn->$post_fld = $this->request->getPost($post_fld);
        }
        

        if (!$kazei_kbn->save()) {
            foreach ($kazei_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "kazei_kbns",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("課税区分の作成が完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "kazei_kbns",
            'action' => 'edit',
            'params' => array($kazei_kbn->id)
        ));
    }

    /**
     * Saves a kazei_kbn edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "kazei_kbns",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $kazei_kbn = KazeiKbns::findFirstByid($id);

        if (!$kazei_kbn) {
            $this->flash->error("課税区分が見つからなくなりました。" . $id);

            $this->dispatcher->forward(array(
                'controller' => "kazei_kbns",
                'action' => 'index'
            ));

            return;
        }

        $post_flds = ["cd","name","hyouji_jun","updated",];
        $chg_flg = 0;
        foreach ($post_flds as $post_fld) {
            if ($kazei_kbn->$post_fld != $this->request->getPost($post_fld)) {$chg_flg = 1; break;}
        }
        if ($chg_flg === 0) {
            $this->flash->error("変更がありません。" . $id);

            $this->dispatcher->forward(array(
                "controller" => "kazei_kbns",
                "action" => "edit",
                "params" => array($kazei_kbn->id)
            ));

            return;
        }

        $this->_bakOut($kazei_kbn);

        foreach ($post_flds as $post_fld) {
            $kazei_kbn->$post_fld = $this->request->getPost($post_fld);
        }
        

        if (!$kazei_kbn->save()) {

            foreach ($kazei_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "kazei_kbns",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $this->flash->success("課税区分の情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "kazei_kbns",
            'action' => 'edit',
            'params' => array($kazei_kbn->id)
        ));
    }

    /**
     * Deletes a kazei_kbn
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $kazei_kbn = KazeiKbns::findFirstByid($id);
        if (!$kazei_kbn) {
            $this->flash->error("課税区分が見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "kazei_kbns",
                'action' => 'index'
            ));

            return;
        }

        if (!$kazei_kbn->delete()) {

            foreach ($kazei_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "kazei_kbns",
                'action' => 'search'
            ));

            return;
        }

        $this->_bakOut($kazei_kbn, 1);

        $this->flash->success("課税区分の削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "kazei_kbns",
            'action' => "index"
        ));
    }

    /**
     * Back Out a kazei_kbn
     *
     * @param string $kazei_kbn, $dlt_flg
     */
    public function _bakOut($kazei_kbn, $dlt_flg = 0)
    {

        $bak_kazei_kbn = new BakKazeiKbns();
        foreach ($kazei_kbn as $fld => $value) {
            $bak_kazei_kbn->$fld = $kazei_kbn->$fld;
        }
        $bak_kazei_kbn->id = NULL;
        $bak_kazei_kbn->id_moto = $kazei_kbn->id;
        $bak_kazei_kbn->hikae_dltflg = $dlt_flg;
        $bak_kazei_kbn->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_kazei_kbn->hikae_nichiji = date("Y-m-d H:i:s");
        if (!$bak_kazei_kbn->save()) {
            foreach ($bak_kazei_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
    }

}
