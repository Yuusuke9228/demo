<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class ShimegrpKbnsController extends ControllerBase
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
            $query = Criteria::fromInput($this->di, 'ShimegrpKbns', $_POST);
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
            $numberPage = ShimegrpKbns::count($parameters1) / 10 + 1;
        }

        $shimegrp_kbns = ShimegrpKbns::find($parameters);
        if (count($shimegrp_kbns) == 0) {
            $this->flash->notice("検索の結果、締グループ区分は０件でした。");
        }

        $paginator = new Paginator(array(
            'data' => $shimegrp_kbns,
            'limit'=> 10,
            'page' => $numberPage
        ));

        $this->view->page = $paginator->getPaginate();
    }

    /**
     * Searches for shimegrp_kbns
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
     * Edits a shimegrp_kbn
     *
     * @param string $id
     */
    public function editAction($id)
    {
        if (!$this->request->isPost()) {

            $shimegrp_kbn = ShimegrpKbns::findFirstByid($id);
            if (!$shimegrp_kbn) {
                $this->flash->error("締グループ区分が見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "shimegrp_kbns",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->id = $shimegrp_kbn->id;

            $this->tag->setDefault("id", $shimegrp_kbn->id);
            $this->tag->setDefault("cd", $shimegrp_kbn->cd);
            $this->tag->setDefault("name", $shimegrp_kbn->name);
            $this->tag->setDefault("id_moto", $shimegrp_kbn->id_moto);
            $this->tag->setDefault("hikae_dltflg", $shimegrp_kbn->hikae_dltflg);
            $this->tag->setDefault("hikae_user_id", $shimegrp_kbn->hikae_user_id);
            $this->tag->setDefault("hikae_nichiji", $shimegrp_kbn->hikae_nichiji);
            $this->tag->setDefault("sakusei_user_id", $shimegrp_kbn->sakusei_user_id);
            $this->tag->setDefault("created", $shimegrp_kbn->created);
            $this->tag->setDefault("kousin_user_id", $shimegrp_kbn->kousin_user_id);
            $this->tag->setDefault("updated", $shimegrp_kbn->updated);
            
        }
    }

    /**
     * Creates a new shimegrp_kbn
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "shimegrp_kbns",
                'action' => 'index'
            ));

            return;
        }

        $shimegrp_kbn = new ShimegrpKbns();
        $post_flds = ["cd","name","updated",];
        foreach ($post_flds as $post_fld) {
            $shimegrp_kbn->$post_fld = $this->request->getPost($post_fld);
        }
        

        if (!$shimegrp_kbn->save()) {
            foreach ($shimegrp_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "shimegrp_kbns",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("締グループ区分の作成が完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "shimegrp_kbns",
            'action' => 'edit',
            'params' => array($shimegrp_kbn->id)
        ));
    }

    /**
     * Saves a shimegrp_kbn edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "shimegrp_kbns",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $shimegrp_kbn = ShimegrpKbns::findFirstByid($id);

        if (!$shimegrp_kbn) {
            $this->flash->error("締グループ区分が見つからなくなりました。" . $id);

            $this->dispatcher->forward(array(
                'controller' => "shimegrp_kbns",
                'action' => 'index'
            ));

            return;
        }

        $post_flds = ["cd","name","updated",];
        $chg_flg = 0;
        foreach ($post_flds as $post_fld) {
            if ($shimegrp_kbn->$post_fld != $this->request->getPost($post_fld)) {$chg_flg = 1; break;}
        }
        if ($chg_flg === 0) {
            $this->flash->error("変更がありません。" . $id);

            $this->dispatcher->forward(array(
                "controller" => "shimegrp_kbns",
                "action" => "edit",
                "params" => array($shimegrp_kbn->id)
            ));

            return;
        }

        $this->_bakOut($shimegrp_kbn);

        foreach ($post_flds as $post_fld) {
            $shimegrp_kbn->$post_fld = $this->request->getPost($post_fld);
        }
        

        if (!$shimegrp_kbn->save()) {

            foreach ($shimegrp_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "shimegrp_kbns",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $this->flash->success("締グループ区分の情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "shimegrp_kbns",
            'action' => 'edit',
            'params' => array($shimegrp_kbn->id)
        ));
    }

    /**
     * Deletes a shimegrp_kbn
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $shimegrp_kbn = ShimegrpKbns::findFirstByid($id);
        if (!$shimegrp_kbn) {
            $this->flash->error("締グループ区分が見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "shimegrp_kbns",
                'action' => 'index'
            ));

            return;
        }

        if (!$shimegrp_kbn->delete()) {

            foreach ($shimegrp_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "shimegrp_kbns",
                'action' => 'search'
            ));

            return;
        }

        $this->_bakOut($shimegrp_kbn, 1);

        $this->flash->success("締グループ区分の削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "shimegrp_kbns",
            'action' => "index"
        ));
    }

    /**
     * Back Out a shimegrp_kbn
     *
     * @param string $shimegrp_kbn, $dlt_flg
     */
    public function _bakOut($shimegrp_kbn, $dlt_flg = 0)
    {

        $bak_shimegrp_kbn = new BakShimegrpKbns();
        foreach ($shimegrp_kbn as $fld => $value) {
            $bak_shimegrp_kbn->$fld = $shimegrp_kbn->$fld;
        }
        $bak_shimegrp_kbn->id = NULL;
        $bak_shimegrp_kbn->id_moto = $shimegrp_kbn->id;
        $bak_shimegrp_kbn->hikae_dltflg = $dlt_flg;
        $bak_shimegrp_kbn->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_shimegrp_kbn->hikae_nichiji = date("Y-m-d H:i:s");
        if (!$bak_shimegrp_kbn->save()) {
            foreach ($bak_shimegrp_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
    }

}
