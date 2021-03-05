<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class YokinShuruiKbnsController extends ControllerBase
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
            $query = Criteria::fromInput($this->di, 'YokinShuruiKbns', $_POST);
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
            $numberPage = YokinShuruiKbns::count($parameters1) / 10 + 1;
        }

        $yokin_shurui_kbns = YokinShuruiKbns::find($parameters);
        if (count($yokin_shurui_kbns) == 0) {
            $this->flash->notice("検索の結果、預金種類区分は０件でした。");
        }

        $paginator = new Paginator(array(
            'data' => $yokin_shurui_kbns,
            'limit'=> 10,
            'page' => $numberPage
        ));

        $this->view->page = $paginator->getPaginate();
    }

    /**
     * Searches for yokin_shurui_kbns
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
     * Edits a yokin_shurui_kbn
     *
     * @param string $id
     */
    public function editAction($id)
    {
        if (!$this->request->isPost()) {

            $yokin_shurui_kbn = YokinShuruiKbns::findFirstByid($id);
            if (!$yokin_shurui_kbn) {
                $this->flash->error("預金種類区分が見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "yokin_shurui_kbns",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->id = $yokin_shurui_kbn->id;

            $this->tag->setDefault("id", $yokin_shurui_kbn->id);
            $this->tag->setDefault("cd", $yokin_shurui_kbn->cd);
            $this->tag->setDefault("name", $yokin_shurui_kbn->name);
            $this->tag->setDefault("id_moto", $yokin_shurui_kbn->id_moto);
            $this->tag->setDefault("hikae_dltflg", $yokin_shurui_kbn->hikae_dltflg);
            $this->tag->setDefault("hikae_user_id", $yokin_shurui_kbn->hikae_user_id);
            $this->tag->setDefault("hikae_nichiji", $yokin_shurui_kbn->hikae_nichiji);
            $this->tag->setDefault("sakusei_user_id", $yokin_shurui_kbn->sakusei_user_id);
            $this->tag->setDefault("created", $yokin_shurui_kbn->created);
            $this->tag->setDefault("kousin_user_id", $yokin_shurui_kbn->kousin_user_id);
            $this->tag->setDefault("updated", $yokin_shurui_kbn->updated);
            
        }
    }

    /**
     * Creates a new yokin_shurui_kbn
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "yokin_shurui_kbns",
                'action' => 'index'
            ));

            return;
        }

        $yokin_shurui_kbn = new YokinShuruiKbns();
        $post_flds = ["cd","name","updated",];
        foreach ($post_flds as $post_fld) {
            $yokin_shurui_kbn->$post_fld = $this->request->getPost($post_fld);
        }
        

        if (!$yokin_shurui_kbn->save()) {
            foreach ($yokin_shurui_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "yokin_shurui_kbns",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("預金種類区分の作成が完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "yokin_shurui_kbns",
            'action' => 'edit',
            'params' => array($yokin_shurui_kbn->id)
        ));
    }

    /**
     * Saves a yokin_shurui_kbn edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "yokin_shurui_kbns",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $yokin_shurui_kbn = YokinShuruiKbns::findFirstByid($id);

        if (!$yokin_shurui_kbn) {
            $this->flash->error("預金種類区分が見つからなくなりました。" . $id);

            $this->dispatcher->forward(array(
                'controller' => "yokin_shurui_kbns",
                'action' => 'index'
            ));

            return;
        }

        $post_flds = ["cd","name","updated",];
        $chg_flg = 0;
        foreach ($post_flds as $post_fld) {
            if ($yokin_shurui_kbn->$post_fld != $this->request->getPost($post_fld)) {$chg_flg = 1; break;}
        }
        if ($chg_flg === 0) {
            $this->flash->error("変更がありません。" . $id);

            $this->dispatcher->forward(array(
                "controller" => "yokin_shurui_kbns",
                "action" => "edit",
                "params" => array($yokin_shurui_kbn->id)
            ));

            return;
        }

        $this->_bakOut($yokin_shurui_kbn);

        foreach ($post_flds as $post_fld) {
            $yokin_shurui_kbn->$post_fld = $this->request->getPost($post_fld);
        }
        

        if (!$yokin_shurui_kbn->save()) {

            foreach ($yokin_shurui_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "yokin_shurui_kbns",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $this->flash->success("預金種類区分の情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "yokin_shurui_kbns",
            'action' => 'edit',
            'params' => array($yokin_shurui_kbn->id)
        ));
    }

    /**
     * Deletes a yokin_shurui_kbn
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $yokin_shurui_kbn = YokinShuruiKbns::findFirstByid($id);
        if (!$yokin_shurui_kbn) {
            $this->flash->error("預金種類区分が見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "yokin_shurui_kbns",
                'action' => 'index'
            ));

            return;
        }

        if (!$yokin_shurui_kbn->delete()) {

            foreach ($yokin_shurui_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "yokin_shurui_kbns",
                'action' => 'search'
            ));

            return;
        }

        $this->_bakOut($yokin_shurui_kbn, 1);

        $this->flash->success("預金種類区分の削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "yokin_shurui_kbns",
            'action' => "index"
        ));
    }

    /**
     * Back Out a yokin_shurui_kbn
     *
     * @param string $yokin_shurui_kbn, $dlt_flg
     */
    public function _bakOut($yokin_shurui_kbn, $dlt_flg = 0)
    {

        $bak_yokin_shurui_kbn = new BakYokinShuruiKbns();
        foreach ($yokin_shurui_kbn as $fld => $value) {
            $bak_yokin_shurui_kbn->$fld = $yokin_shurui_kbn->$fld;
        }
        $bak_yokin_shurui_kbn->id = NULL;
        $bak_yokin_shurui_kbn->id_moto = $yokin_shurui_kbn->id;
        $bak_yokin_shurui_kbn->hikae_dltflg = $dlt_flg;
        $bak_yokin_shurui_kbn->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_yokin_shurui_kbn->hikae_nichiji = date("Y-m-d H:i:s");
        if (!$bak_yokin_shurui_kbn->save()) {
            foreach ($bak_yokin_shurui_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
    }

}
