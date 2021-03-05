<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class NyuukinnKbnsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'NyuukinnKbns', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = array();
        }
        $parameters["order"] = "cd";

        $nyuukinn_kbns = NyuukinnKbns::find($parameters);
        if (count($nyuukinn_kbns) == 0) {
            $this->flash->notice("検索の結果、入金区分は０件でした。");
        }

        $paginator = new Paginator(array(
            'data' => $nyuukinn_kbns,
            'limit'=> 10,
            'page' => $numberPage
        ));

        $this->view->page = $paginator->getPaginate();
    }

    /**
     * Searches for nyuukinn_kbns
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
     * Edits a nyuukinn_kbn
     *
     * @param string $id
     */
    public function editAction($id)
    {
        if (!$this->request->isPost()) {

            $nyuukinn_kbn = NyuukinnKbns::findFirstByid($id);
            if (!$nyuukinn_kbn) {
                $this->flash->error("入金区分が見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "nyuukinn_kbns",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->id = $nyuukinn_kbn->id;

            $this->tag->setDefault("id", $nyuukinn_kbn->id);
            $this->tag->setDefault("cd", $nyuukinn_kbn->cd);
            $this->tag->setDefault("name", $nyuukinn_kbn->name);
            $this->tag->setDefault("id_moto", $nyuukinn_kbn->id_moto);
            $this->tag->setDefault("hikae_dltflg", $nyuukinn_kbn->hikae_dltflg);
            $this->tag->setDefault("hikae_user_id", $nyuukinn_kbn->hikae_user_id);
            $this->tag->setDefault("hikae_nichiji", $nyuukinn_kbn->hikae_nichiji);
            $this->tag->setDefault("sakusei_user_id", $nyuukinn_kbn->sakusei_user_id);
            $this->tag->setDefault("created", $nyuukinn_kbn->created);
            $this->tag->setDefault("kousin_user_id", $nyuukinn_kbn->kousin_user_id);
            $this->tag->setDefault("updated", $nyuukinn_kbn->updated);
            
        }
    }

    /**
     * Creates a new nyuukinn_kbn
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "nyuukinn_kbns",
                'action' => 'index'
            ));

            return;
        }

        $nyuukinn_kbn = new NyuukinnKbns();
        $post_flds = ["cd","name","updated",];
        foreach ($post_flds as $post_fld) {
            $nyuukinn_kbn->$post_fld = $this->request->getPost($post_fld);
        }
        

        if (!$nyuukinn_kbn->save()) {
            foreach ($nyuukinn_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "nyuukinn_kbns",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("入金区分の作成が完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "nyuukinn_kbns",
            'action' => 'edit',
            'params' => array($nyuukinn_kbn->id)
        ));
    }

    /**
     * Saves a nyuukinn_kbn edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "nyuukinn_kbns",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $nyuukinn_kbn = NyuukinnKbns::findFirstByid($id);

        if (!$nyuukinn_kbn) {
            $this->flash->error("入金区分が見つからなくなりました。" . $id);

            $this->dispatcher->forward(array(
                'controller' => "nyuukinn_kbns",
                'action' => 'index'
            ));

            return;
        }

        $post_flds = ["cd","name","updated",];
        $chg_flg = 0;
        foreach ($post_flds as $post_fld) {
            if ($nyuukinn_kbn->$post_fld != $this->request->getPost($post_fld)) {$chg_flg = 1; break;}
        }
        if ($chg_flg === 0) {
            $this->flash->error("変更がありません。" . $id);

            $this->dispatcher->forward(array(
                "controller" => "nyuukinn_kbns",
                "action" => "edit",
                "params" => array($nyuukinn_kbn->id)
            ));

            return;
        }

        $this->_bakOut($nyuukinn_kbn);

        foreach ($post_flds as $post_fld) {
            $nyuukinn_kbn->$post_fld = $this->request->getPost($post_fld);
        }
        

        if (!$nyuukinn_kbn->save()) {

            foreach ($nyuukinn_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "nyuukinn_kbns",
                'action' => 'edit',
                'params' => array($nyuukinn_kbn->id)
            ));

            return;
        }

        $this->flash->success("入金区分の情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "nyuukinn_kbns",
            'action' => 'edit',
            'params' => array($id)
        ));
    }

    /**
     * Deletes a nyuukinn_kbn
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $nyuukinn_kbn = NyuukinnKbns::findFirstByid($id);
        if (!$nyuukinn_kbn) {
            $this->flash->error("入金区分が見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "nyuukinn_kbns",
                'action' => 'index'
            ));

            return;
        }

        if (!$nyuukinn_kbn->delete()) {

            foreach ($nyuukinn_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "nyuukinn_kbns",
                'action' => 'search'
            ));

            return;
        }

        $this->_bakOut($nyuukinn_kbn, 1);

        $this->flash->success("入金区分の削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "nyuukinn_kbns",
            'action' => "index"
        ));
    }

    /**
     * Back Out a nyuukinn_kbn
     *
     * @param string $nyuukinn_kbn, $dlt_flg
     */
    public function _bakOut($nyuukinn_kbn, $dlt_flg = 0)
    {

        $bak_nyuukinn_kbn = new BakNyuukinnKbns();
        foreach ($nyuukinn_kbn as $fld => $value) {
            $bak_nyuukinn_kbn->$fld = $nyuukinn_kbn->$fld;
        }
        $bak_nyuukinn_kbn->id = NULL;
        $bak_nyuukinn_kbn->id_moto = $nyuukinn_kbn->id;
        $bak_nyuukinn_kbn->hikae_dltflg = $dlt_flg;
        $bak_nyuukinn_kbn->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_nyuukinn_kbn->hikae_nichiji = date("Y-m-d H:i:s");
        if (!$bak_nyuukinn_kbn->save()) {
            foreach ($bak_nyuukinn_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
    }

}
