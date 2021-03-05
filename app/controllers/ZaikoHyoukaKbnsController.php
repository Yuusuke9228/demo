<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class ZaikoHyoukaKbnsController extends ControllerBase
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
            $query = Criteria::fromInput($this->di, 'ZaikoHyoukaKbns', $_POST);
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
            $numberPage = ZaikoHyoukaKbns::count($parameters1) / 10 + 1;
        }

        $zaiko_hyouka_kbns = ZaikoHyoukaKbns::find($parameters);
        if (count($zaiko_hyouka_kbns) == 0) {
            $this->flash->notice("検索の結果、在庫評価方法は０件でした。");
        }

        $paginator = new Paginator(array(
            'data' => $zaiko_hyouka_kbns,
            'limit'=> 10,
            'page' => $numberPage
        ));

        $this->view->page = $paginator->getPaginate();
    }

    /**
     * Searches for zaiko_hyouka_kbns
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
     * Edits a zaiko_hyouka_kbn
     *
     * @param string $id
     */
    public function editAction($id)
    {
        if (!$this->request->isPost()) {

            $zaiko_hyouka_kbn = ZaikoHyoukaKbns::findFirstByid($id);
            if (!$zaiko_hyouka_kbn) {
                $this->flash->error("在庫評価方法が見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "zaiko_hyouka_kbns",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->id = $zaiko_hyouka_kbn->id;

            $this->tag->setDefault("id", $zaiko_hyouka_kbn->id);
            $this->tag->setDefault("cd", $zaiko_hyouka_kbn->cd);
            $this->tag->setDefault("name", $zaiko_hyouka_kbn->name);
            $this->tag->setDefault("id_moto", $zaiko_hyouka_kbn->id_moto);
            $this->tag->setDefault("hikae_dltflg", $zaiko_hyouka_kbn->hikae_dltflg);
            $this->tag->setDefault("hikae_user_id", $zaiko_hyouka_kbn->hikae_user_id);
            $this->tag->setDefault("hikae_nichiji", $zaiko_hyouka_kbn->hikae_nichiji);
            $this->tag->setDefault("sakusei_user_id", $zaiko_hyouka_kbn->sakusei_user_id);
            $this->tag->setDefault("created", $zaiko_hyouka_kbn->created);
            $this->tag->setDefault("kousin_user_id", $zaiko_hyouka_kbn->kousin_user_id);
            $this->tag->setDefault("updated", $zaiko_hyouka_kbn->updated);
            
        }
    }

    /**
     * Creates a new zaiko_hyouka_kbn
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "zaiko_hyouka_kbns",
                'action' => 'index'
            ));

            return;
        }

        $zaiko_hyouka_kbn = new ZaikoHyoukaKbns();
        $post_flds = ["cd","name","updated",];
        foreach ($post_flds as $post_fld) {
            $zaiko_hyouka_kbn->$post_fld = $this->request->getPost($post_fld);
        }
        

        if (!$zaiko_hyouka_kbn->save()) {
            foreach ($zaiko_hyouka_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "zaiko_hyouka_kbns",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("在庫評価方法の作成が完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "zaiko_hyouka_kbns",
            'action' => 'edit',
            'params' => array($zaiko_hyouka_kbn->id)
        ));
    }

    /**
     * Saves a zaiko_hyouka_kbn edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "zaiko_hyouka_kbns",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $zaiko_hyouka_kbn = ZaikoHyoukaKbns::findFirstByid($id);

        if (!$zaiko_hyouka_kbn) {
            $this->flash->error("在庫評価方法が見つからなくなりました。" . $id);

            $this->dispatcher->forward(array(
                'controller' => "zaiko_hyouka_kbns",
                'action' => 'index'
            ));

            return;
        }

        $post_flds = ["cd","name","updated",];
        $chg_flg = 0;
        foreach ($post_flds as $post_fld) {
            if ($zaiko_hyouka_kbn->$post_fld != $this->request->getPost($post_fld)) {$chg_flg = 1; break;}
        }
        if ($chg_flg === 0) {
            $this->flash->error("変更がありません。" . $id);

            $this->dispatcher->forward(array(
                "controller" => "zaiko_hyouka_kbns",
                "action" => "edit",
                "params" => array($zaiko_hyouka_kbn->id)
            ));

            return;
        }

        $this->_bakOut($zaiko_hyouka_kbn);

        foreach ($post_flds as $post_fld) {
            $zaiko_hyouka_kbn->$post_fld = $this->request->getPost($post_fld);
        }
        

        if (!$zaiko_hyouka_kbn->save()) {

            foreach ($zaiko_hyouka_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "zaiko_hyouka_kbns",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $this->flash->success("在庫評価方法の情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "zaiko_hyouka_kbns",
            'action' => 'edit',
            'params' => array($zaiko_hyouka_kbn->id)
        ));
    }

    /**
     * Deletes a zaiko_hyouka_kbn
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $zaiko_hyouka_kbn = ZaikoHyoukaKbns::findFirstByid($id);
        if (!$zaiko_hyouka_kbn) {
            $this->flash->error("在庫評価方法が見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "zaiko_hyouka_kbns",
                'action' => 'index'
            ));

            return;
        }

        if (!$zaiko_hyouka_kbn->delete()) {

            foreach ($zaiko_hyouka_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "zaiko_hyouka_kbns",
                'action' => 'search'
            ));

            return;
        }

        $this->_bakOut($zaiko_hyouka_kbn, 1);

        $this->flash->success("在庫評価方法の削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "zaiko_hyouka_kbns",
            'action' => "index"
        ));
    }

    /**
     * Back Out a zaiko_hyouka_kbn
     *
     * @param string $zaiko_hyouka_kbn, $dlt_flg
     */
    public function _bakOut($zaiko_hyouka_kbn, $dlt_flg = 0)
    {

        $bak_zaiko_hyouka_kbn = new BakZaikoHyoukaKbns();
        foreach ($zaiko_hyouka_kbn as $fld => $value) {
            $bak_zaiko_hyouka_kbn->$fld = $zaiko_hyouka_kbn->$fld;
        }
        $bak_zaiko_hyouka_kbn->id = NULL;
        $bak_zaiko_hyouka_kbn->id_moto = $zaiko_hyouka_kbn->id;
        $bak_zaiko_hyouka_kbn->hikae_dltflg = $dlt_flg;
        $bak_zaiko_hyouka_kbn->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_zaiko_hyouka_kbn->hikae_nichiji = date("Y-m-d H:i:s");
        if (!$bak_zaiko_hyouka_kbn->save()) {
            foreach ($bak_zaiko_hyouka_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
    }

}
