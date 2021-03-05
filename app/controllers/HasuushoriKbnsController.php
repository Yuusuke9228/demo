<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class HasuushoriKbnsController extends ControllerBase
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
            $query = Criteria::fromInput($this->di, 'HasuushoriKbns', $_POST);
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
            $numberPage = HasuushoriKbns::count($parameters1) / 10 + 1;
        }

        $hasuushori_kbns = HasuushoriKbns::find($parameters);
        if (count($hasuushori_kbns) == 0) {
            $this->flash->notice("検索の結果、端数処理区分は０件でした。");
        }

        $paginator = new Paginator(array(
            'data' => $hasuushori_kbns,
            'limit'=> 10,
            'page' => $numberPage
        ));

        $this->view->page = $paginator->getPaginate();
    }

    /**
     * Searches for hasuushori_kbns
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
     * Edits a hasuushori_kbn
     *
     * @param string $id
     */
    public function editAction($id)
    {
        if (!$this->request->isPost()) {

            $hasuushori_kbn = HasuushoriKbns::findFirstByid($id);
            if (!$hasuushori_kbn) {
                $this->flash->error("端数処理区分が見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "hasuushori_kbns",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->id = $hasuushori_kbn->id;

            $this->tag->setDefault("id", $hasuushori_kbn->id);
            $this->tag->setDefault("cd", $hasuushori_kbn->cd);
            $this->tag->setDefault("name", $hasuushori_kbn->name);
            $this->tag->setDefault("id_moto", $hasuushori_kbn->id_moto);
            $this->tag->setDefault("hikae_dltflg", $hasuushori_kbn->hikae_dltflg);
            $this->tag->setDefault("hikae_user_id", $hasuushori_kbn->hikae_user_id);
            $this->tag->setDefault("hikae_nichiji", $hasuushori_kbn->hikae_nichiji);
            $this->tag->setDefault("sakusei_user_id", $hasuushori_kbn->sakusei_user_id);
            $this->tag->setDefault("created", $hasuushori_kbn->created);
            $this->tag->setDefault("kousin_user_id", $hasuushori_kbn->kousin_user_id);
            $this->tag->setDefault("updated", $hasuushori_kbn->updated);
            
        }
    }

    /**
     * Creates a new hasuushori_kbn
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "hasuushori_kbns",
                'action' => 'index'
            ));

            return;
        }

        $hasuushori_kbn = new HasuushoriKbns();
        $post_flds = ["cd","name","updated",];
        foreach ($post_flds as $post_fld) {
            $hasuushori_kbn->$post_fld = $this->request->getPost($post_fld);
        }
        

        if (!$hasuushori_kbn->save()) {
            foreach ($hasuushori_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "hasuushori_kbns",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("端数処理区分の作成が完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "hasuushori_kbns",
            'action' => 'edit',
            'params' => array($hasuushori_kbn->id)
        ));
    }

    /**
     * Saves a hasuushori_kbn edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "hasuushori_kbns",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $hasuushori_kbn = HasuushoriKbns::findFirstByid($id);

        if (!$hasuushori_kbn) {
            $this->flash->error("端数処理区分が見つからなくなりました。" . $id);

            $this->dispatcher->forward(array(
                'controller' => "hasuushori_kbns",
                'action' => 'index'
            ));

            return;
        }

        $post_flds = ["cd","name","updated",];
        $chg_flg = 0;
        foreach ($post_flds as $post_fld) {
            if ($hasuushori_kbn->$post_fld != $this->request->getPost($post_fld)) {$chg_flg = 1; break;}
        }
        if ($chg_flg === 0) {
            $this->flash->error("変更がありません。" . $id);

            $this->dispatcher->forward(array(
                "controller" => "hasuushori_kbns",
                "action" => "edit",
                "params" => array($hasuushori_kbn->id)
            ));

            return;
        }

        $this->_bakOut($hasuushori_kbn);

        foreach ($post_flds as $post_fld) {
            $hasuushori_kbn->$post_fld = $this->request->getPost($post_fld);
        }
        

        if (!$hasuushori_kbn->save()) {

            foreach ($hasuushori_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "hasuushori_kbns",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $this->flash->success("端数処理区分の情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "hasuushori_kbns",
            'action' => 'edit',
            'params' => array($hasuushori_kbn->id)
        ));
    }

    /**
     * Deletes a hasuushori_kbn
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $hasuushori_kbn = HasuushoriKbns::findFirstByid($id);
        if (!$hasuushori_kbn) {
            $this->flash->error("端数処理区分が見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "hasuushori_kbns",
                'action' => 'index'
            ));

            return;
        }

        if (!$hasuushori_kbn->delete()) {

            foreach ($hasuushori_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "hasuushori_kbns",
                'action' => 'search'
            ));

            return;
        }

        $this->_bakOut($hasuushori_kbn, 1);

        $this->flash->success("端数処理区分の削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "hasuushori_kbns",
            'action' => "index"
        ));
    }

    /**
     * Back Out a hasuushori_kbn
     *
     * @param string $hasuushori_kbn, $dlt_flg
     */
    public function _bakOut($hasuushori_kbn, $dlt_flg = 0)
    {

        $bak_hasuushori_kbn = new BakHasuushoriKbns();
        foreach ($hasuushori_kbn as $fld => $value) {
            $bak_hasuushori_kbn->$fld = $hasuushori_kbn->$fld;
        }
        $bak_hasuushori_kbn->id = NULL;
        $bak_hasuushori_kbn->id_moto = $hasuushori_kbn->id;
        $bak_hasuushori_kbn->hikae_dltflg = $dlt_flg;
        $bak_hasuushori_kbn->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_hasuushori_kbn->hikae_nichiji = date("Y-m-d H:i:s");
        if (!$bak_hasuushori_kbn->save()) {
            foreach ($bak_hasuushori_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
    }

}
