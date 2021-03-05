<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class ShiteiSeikyuushoKbnsController extends ControllerBase
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
            $query = Criteria::fromInput($this->di, 'ShiteiSeikyuushoKbns', $_POST);
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
            $numberPage = ShiteiSeikyuushoKbns::count($parameters1) / 10 + 1;
        }

        $shitei_seikyuusho_kbns = ShiteiSeikyuushoKbns::find($parameters);
        if (count($shitei_seikyuusho_kbns) == 0) {
            $this->flash->notice("検索の結果、指定請求書区分は０件でした。");
        }

        $paginator = new Paginator(array(
            'data' => $shitei_seikyuusho_kbns,
            'limit'=> 10,
            'page' => $numberPage
        ));

        $this->view->page = $paginator->getPaginate();
    }

    /**
     * Searches for shitei_seikyuusho_kbns
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
     * Edits a shitei_seikyuusho_kbn
     *
     * @param string $id
     */
    public function editAction($id)
    {
        if (!$this->request->isPost()) {

            $shitei_seikyuusho_kbn = ShiteiSeikyuushoKbns::findFirstByid($id);
            if (!$shitei_seikyuusho_kbn) {
                $this->flash->error("指定請求書区分が見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "shitei_seikyuusho_kbns",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->id = $shitei_seikyuusho_kbn->id;

            $this->tag->setDefault("id", $shitei_seikyuusho_kbn->id);
            $this->tag->setDefault("cd", $shitei_seikyuusho_kbn->cd);
            $this->tag->setDefault("name", $shitei_seikyuusho_kbn->name);
            $this->tag->setDefault("id_moto", $shitei_seikyuusho_kbn->id_moto);
            $this->tag->setDefault("hikae_dltflg", $shitei_seikyuusho_kbn->hikae_dltflg);
            $this->tag->setDefault("hikae_user_id", $shitei_seikyuusho_kbn->hikae_user_id);
            $this->tag->setDefault("hikae_nichiji", $shitei_seikyuusho_kbn->hikae_nichiji);
            $this->tag->setDefault("sakusei_user_id", $shitei_seikyuusho_kbn->sakusei_user_id);
            $this->tag->setDefault("created", $shitei_seikyuusho_kbn->created);
            $this->tag->setDefault("kousin_user_id", $shitei_seikyuusho_kbn->kousin_user_id);
            $this->tag->setDefault("updated", $shitei_seikyuusho_kbn->updated);
            
        }
    }

    /**
     * Creates a new shitei_seikyuusho_kbn
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "shitei_seikyuusho_kbns",
                'action' => 'index'
            ));

            return;
        }

        $shitei_seikyuusho_kbn = new ShiteiSeikyuushoKbns();
        $post_flds = ["cd","name","updated",];
        foreach ($post_flds as $post_fld) {
            $shitei_seikyuusho_kbn->$post_fld = $this->request->getPost($post_fld);
        }
        

        if (!$shitei_seikyuusho_kbn->save()) {
            foreach ($shitei_seikyuusho_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "shitei_seikyuusho_kbns",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("指定請求書区分の作成が完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "shitei_seikyuusho_kbns",
            'action' => 'edit',
            'params' => array($shitei_seikyuusho_kbn->id)
        ));
    }

    /**
     * Saves a shitei_seikyuusho_kbn edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "shitei_seikyuusho_kbns",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $shitei_seikyuusho_kbn = ShiteiSeikyuushoKbns::findFirstByid($id);

        if (!$shitei_seikyuusho_kbn) {
            $this->flash->error("指定請求書区分が見つからなくなりました。" . $id);

            $this->dispatcher->forward(array(
                'controller' => "shitei_seikyuusho_kbns",
                'action' => 'index'
            ));

            return;
        }

        $post_flds = ["cd","name","updated",];
        $chg_flg = 0;
        foreach ($post_flds as $post_fld) {
            if ($shitei_seikyuusho_kbn->$post_fld != $this->request->getPost($post_fld)) {$chg_flg = 1; break;}
        }
        if ($chg_flg === 0) {
            $this->flash->error("変更がありません。" . $id);

            $this->dispatcher->forward(array(
                "controller" => "shitei_seikyuusho_kbns",
                "action" => "edit",
                "params" => array($shitei_seikyuusho_kbn->id)
            ));

            return;
        }

        $this->_bakOut($shitei_seikyuusho_kbn);

        foreach ($post_flds as $post_fld) {
            $shitei_seikyuusho_kbn->$post_fld = $this->request->getPost($post_fld);
        }
        

        if (!$shitei_seikyuusho_kbn->save()) {

            foreach ($shitei_seikyuusho_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "shitei_seikyuusho_kbns",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $this->flash->success("指定請求書区分の情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "shitei_seikyuusho_kbns",
            'action' => 'edit',
            'params' => array($shitei_seikyuusho_kbn->id)
        ));
    }

    /**
     * Deletes a shitei_seikyuusho_kbn
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $shitei_seikyuusho_kbn = ShiteiSeikyuushoKbns::findFirstByid($id);
        if (!$shitei_seikyuusho_kbn) {
            $this->flash->error("指定請求書区分が見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "shitei_seikyuusho_kbns",
                'action' => 'index'
            ));

            return;
        }

        if (!$shitei_seikyuusho_kbn->delete()) {

            foreach ($shitei_seikyuusho_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "shitei_seikyuusho_kbns",
                'action' => 'search'
            ));

            return;
        }

        $this->_bakOut($shitei_seikyuusho_kbn, 1);

        $this->flash->success("指定請求書区分の削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "shitei_seikyuusho_kbns",
            'action' => "index"
        ));
    }

    /**
     * Back Out a shitei_seikyuusho_kbn
     *
     * @param string $shitei_seikyuusho_kbn, $dlt_flg
     */
    public function _bakOut($shitei_seikyuusho_kbn, $dlt_flg = 0)
    {

        $bak_shitei_seikyuusho_kbn = new BakShiteiSeikyuushoKbns();
        foreach ($shitei_seikyuusho_kbn as $fld => $value) {
            $bak_shitei_seikyuusho_kbn->$fld = $shitei_seikyuusho_kbn->$fld;
        }
        $bak_shitei_seikyuusho_kbn->id = NULL;
        $bak_shitei_seikyuusho_kbn->id_moto = $shitei_seikyuusho_kbn->id;
        $bak_shitei_seikyuusho_kbn->hikae_dltflg = $dlt_flg;
        $bak_shitei_seikyuusho_kbn->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_shitei_seikyuusho_kbn->hikae_nichiji = date("Y-m-d H:i:s");
        if (!$bak_shitei_seikyuusho_kbn->save()) {
            foreach ($bak_shitei_seikyuusho_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
    }

}
