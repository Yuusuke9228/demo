<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class TesuuryouHutanKbnsController extends ControllerBase
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
            $query = Criteria::fromInput($this->di, 'TesuuryouHutanKbns', $_POST);
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
            $numberPage = TesuuryouHutanKbns::count($parameters1) / 10 + 1;
        }

        $tesuuryou_hutan_kbns = TesuuryouHutanKbns::find($parameters);
        if (count($tesuuryou_hutan_kbns) == 0) {
            $this->flash->notice("検索の結果、手数料負担区分は０件でした。");
        }

        $paginator = new Paginator(array(
            'data' => $tesuuryou_hutan_kbns,
            'limit'=> 10,
            'page' => $numberPage
        ));

        $this->view->page = $paginator->getPaginate();
    }

    /**
     * Searches for tesuuryou_hutan_kbns
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
     * Edits a tesuuryou_hutan_kbn
     *
     * @param string $id
     */
    public function editAction($id)
    {
        if (!$this->request->isPost()) {

            $tesuuryou_hutan_kbn = TesuuryouHutanKbns::findFirstByid($id);
            if (!$tesuuryou_hutan_kbn) {
                $this->flash->error("手数料負担区分が見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "tesuuryou_hutan_kbns",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->id = $tesuuryou_hutan_kbn->id;

            $this->tag->setDefault("id", $tesuuryou_hutan_kbn->id);
            $this->tag->setDefault("cd", $tesuuryou_hutan_kbn->cd);
            $this->tag->setDefault("name", $tesuuryou_hutan_kbn->name);
            $this->tag->setDefault("id_moto", $tesuuryou_hutan_kbn->id_moto);
            $this->tag->setDefault("hikae_dltflg", $tesuuryou_hutan_kbn->hikae_dltflg);
            $this->tag->setDefault("hikae_user_id", $tesuuryou_hutan_kbn->hikae_user_id);
            $this->tag->setDefault("hikae_nichiji", $tesuuryou_hutan_kbn->hikae_nichiji);
            $this->tag->setDefault("sakusei_user_id", $tesuuryou_hutan_kbn->sakusei_user_id);
            $this->tag->setDefault("created", $tesuuryou_hutan_kbn->created);
            $this->tag->setDefault("kousin_user_id", $tesuuryou_hutan_kbn->kousin_user_id);
            $this->tag->setDefault("updated", $tesuuryou_hutan_kbn->updated);
            
        }
    }

    /**
     * Creates a new tesuuryou_hutan_kbn
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "tesuuryou_hutan_kbns",
                'action' => 'index'
            ));

            return;
        }

        $tesuuryou_hutan_kbn = new TesuuryouHutanKbns();
        $post_flds = ["cd","name","updated",];
        foreach ($post_flds as $post_fld) {
            $tesuuryou_hutan_kbn->$post_fld = $this->request->getPost($post_fld);
        }
        

        if (!$tesuuryou_hutan_kbn->save()) {
            foreach ($tesuuryou_hutan_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "tesuuryou_hutan_kbns",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("手数料負担区分の作成が完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "tesuuryou_hutan_kbns",
            'action' => 'edit',
            'params' => array($tesuuryou_hutan_kbn->id)
        ));
    }

    /**
     * Saves a tesuuryou_hutan_kbn edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "tesuuryou_hutan_kbns",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $tesuuryou_hutan_kbn = TesuuryouHutanKbns::findFirstByid($id);

        if (!$tesuuryou_hutan_kbn) {
            $this->flash->error("手数料負担区分が見つからなくなりました。" . $id);

            $this->dispatcher->forward(array(
                'controller' => "tesuuryou_hutan_kbns",
                'action' => 'index'
            ));

            return;
        }

        $post_flds = ["cd","name","updated",];
        $chg_flg = 0;
        foreach ($post_flds as $post_fld) {
            if ($tesuuryou_hutan_kbn->$post_fld != $this->request->getPost($post_fld)) {$chg_flg = 1; break;}
        }
        if ($chg_flg === 0) {
            $this->flash->error("変更がありません。" . $id);

            $this->dispatcher->forward(array(
                "controller" => "tesuuryou_hutan_kbns",
                "action" => "edit",
                "params" => array($tesuuryou_hutan_kbn->id)
            ));

            return;
        }

        $this->_bakOut($tesuuryou_hutan_kbn);

        foreach ($post_flds as $post_fld) {
            $tesuuryou_hutan_kbn->$post_fld = $this->request->getPost($post_fld);
        }
        

        if (!$tesuuryou_hutan_kbn->save()) {

            foreach ($tesuuryou_hutan_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "tesuuryou_hutan_kbns",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $this->flash->success("手数料負担区分の情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "tesuuryou_hutan_kbns",
            'action' => 'edit',
            'params' => array($tesuuryou_hutan_kbn->id)
        ));
    }

    /**
     * Deletes a tesuuryou_hutan_kbn
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $tesuuryou_hutan_kbn = TesuuryouHutanKbns::findFirstByid($id);
        if (!$tesuuryou_hutan_kbn) {
            $this->flash->error("手数料負担区分が見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "tesuuryou_hutan_kbns",
                'action' => 'index'
            ));

            return;
        }

        if (!$tesuuryou_hutan_kbn->delete()) {

            foreach ($tesuuryou_hutan_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "tesuuryou_hutan_kbns",
                'action' => 'search'
            ));

            return;
        }

        $this->_bakOut($tesuuryou_hutan_kbn, 1);

        $this->flash->success("手数料負担区分の削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "tesuuryou_hutan_kbns",
            'action' => "index"
        ));
    }

    /**
     * Back Out a tesuuryou_hutan_kbn
     *
     * @param string $tesuuryou_hutan_kbn, $dlt_flg
     */
    public function _bakOut($tesuuryou_hutan_kbn, $dlt_flg = 0)
    {

        $bak_tesuuryou_hutan_kbn = new BakTesuuryouHutanKbns();
        foreach ($tesuuryou_hutan_kbn as $fld => $value) {
            $bak_tesuuryou_hutan_kbn->$fld = $tesuuryou_hutan_kbn->$fld;
        }
        $bak_tesuuryou_hutan_kbn->id = NULL;
        $bak_tesuuryou_hutan_kbn->id_moto = $tesuuryou_hutan_kbn->id;
        $bak_tesuuryou_hutan_kbn->hikae_dltflg = $dlt_flg;
        $bak_tesuuryou_hutan_kbn->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_tesuuryou_hutan_kbn->hikae_nichiji = date("Y-m-d H:i:s");
        if (!$bak_tesuuryou_hutan_kbn->save()) {
            foreach ($bak_tesuuryou_hutan_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
    }

}
