<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class KaishuuSaikuruKbnsController extends ControllerBase
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
            $query = Criteria::fromInput($this->di, 'KaishuuSaikuruKbns', $_POST);
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
            $numberPage = KaishuuSaikuruKbns::count($parameters1) / 10 + 1;
        }

        $kaishuu_saikuru_kbns = KaishuuSaikuruKbns::find($parameters);
        if (count($kaishuu_saikuru_kbns) == 0) {
            $this->flash->notice("検索の結果、回収サイクルは０件でした。");
        }

        $paginator = new Paginator(array(
            'data' => $kaishuu_saikuru_kbns,
            'limit'=> 10,
            'page' => $numberPage
        ));

        $this->view->page = $paginator->getPaginate();
    }

    /**
     * Searches for kaishuu_saikuru_kbns
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
     * Edits a kaishuu_saikuru_kbn
     *
     * @param string $id
     */
    public function editAction($id)
    {
        if (!$this->request->isPost()) {

            $kaishuu_saikuru_kbn = KaishuuSaikuruKbns::findFirstByid($id);
            if (!$kaishuu_saikuru_kbn) {
                $this->flash->error("回収サイクルが見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "kaishuu_saikuru_kbns",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->id = $kaishuu_saikuru_kbn->id;

            $this->tag->setDefault("id", $kaishuu_saikuru_kbn->id);
            $this->tag->setDefault("cd", $kaishuu_saikuru_kbn->cd);
            $this->tag->setDefault("name", $kaishuu_saikuru_kbn->name);
            $this->tag->setDefault("id_moto", $kaishuu_saikuru_kbn->id_moto);
            $this->tag->setDefault("hikae_dltflg", $kaishuu_saikuru_kbn->hikae_dltflg);
            $this->tag->setDefault("hikae_user_id", $kaishuu_saikuru_kbn->hikae_user_id);
            $this->tag->setDefault("hikae_nichiji", $kaishuu_saikuru_kbn->hikae_nichiji);
            $this->tag->setDefault("sakusei_user_id", $kaishuu_saikuru_kbn->sakusei_user_id);
            $this->tag->setDefault("created", $kaishuu_saikuru_kbn->created);
            $this->tag->setDefault("kousin_user_id", $kaishuu_saikuru_kbn->kousin_user_id);
            $this->tag->setDefault("updated", $kaishuu_saikuru_kbn->updated);
            
        }
    }

    /**
     * Creates a new kaishuu_saikuru_kbn
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "kaishuu_saikuru_kbns",
                'action' => 'index'
            ));

            return;
        }

        $kaishuu_saikuru_kbn = new KaishuuSaikuruKbns();
        $post_flds = ["cd","name","updated",];
        foreach ($post_flds as $post_fld) {
            $kaishuu_saikuru_kbn->$post_fld = $this->request->getPost($post_fld);
        }
        

        if (!$kaishuu_saikuru_kbn->save()) {
            foreach ($kaishuu_saikuru_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "kaishuu_saikuru_kbns",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("回収サイクルの作成が完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "kaishuu_saikuru_kbns",
            'action' => 'edit',
            'params' => array($kaishuu_saikuru_kbn->id)
        ));
    }

    /**
     * Saves a kaishuu_saikuru_kbn edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "kaishuu_saikuru_kbns",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $kaishuu_saikuru_kbn = KaishuuSaikuruKbns::findFirstByid($id);

        if (!$kaishuu_saikuru_kbn) {
            $this->flash->error("回収サイクルが見つからなくなりました。" . $id);

            $this->dispatcher->forward(array(
                'controller' => "kaishuu_saikuru_kbns",
                'action' => 'index'
            ));

            return;
        }

        $post_flds = ["cd","name","updated",];
        $chg_flg = 0;
        foreach ($post_flds as $post_fld) {
            if ($kaishuu_saikuru_kbn->$post_fld != $this->request->getPost($post_fld)) {$chg_flg = 1; break;}
        }
        if ($chg_flg === 0) {
            $this->flash->error("変更がありません。" . $id);

            $this->dispatcher->forward(array(
                "controller" => "kaishuu_saikuru_kbns",
                "action" => "edit",
                "params" => array($kaishuu_saikuru_kbn->id)
            ));

            return;
        }

        $this->_bakOut($kaishuu_saikuru_kbn);

        foreach ($post_flds as $post_fld) {
            $kaishuu_saikuru_kbn->$post_fld = $this->request->getPost($post_fld);
        }
        

        if (!$kaishuu_saikuru_kbn->save()) {

            foreach ($kaishuu_saikuru_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "kaishuu_saikuru_kbns",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $this->flash->success("回収サイクルの情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "kaishuu_saikuru_kbns",
            'action' => 'edit',
            'params' => array($kaishuu_saikuru_kbn->id)
        ));
    }

    /**
     * Deletes a kaishuu_saikuru_kbn
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $kaishuu_saikuru_kbn = KaishuuSaikuruKbns::findFirstByid($id);
        if (!$kaishuu_saikuru_kbn) {
            $this->flash->error("回収サイクルが見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "kaishuu_saikuru_kbns",
                'action' => 'index'
            ));

            return;
        }

        if (!$kaishuu_saikuru_kbn->delete()) {

            foreach ($kaishuu_saikuru_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "kaishuu_saikuru_kbns",
                'action' => 'search'
            ));

            return;
        }

        $this->_bakOut($kaishuu_saikuru_kbn, 1);

        $this->flash->success("回収サイクルの削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "kaishuu_saikuru_kbns",
            'action' => "index"
        ));
    }

    /**
     * Back Out a kaishuu_saikuru_kbn
     *
     * @param string $kaishuu_saikuru_kbn, $dlt_flg
     */
    public function _bakOut($kaishuu_saikuru_kbn, $dlt_flg = 0)
    {

        $bak_kaishuu_saikuru_kbn = new BakKaishuuSaikuruKbns();
        foreach ($kaishuu_saikuru_kbn as $fld => $value) {
            $bak_kaishuu_saikuru_kbn->$fld = $kaishuu_saikuru_kbn->$fld;
        }
        $bak_kaishuu_saikuru_kbn->id = NULL;
        $bak_kaishuu_saikuru_kbn->id_moto = $kaishuu_saikuru_kbn->id;
        $bak_kaishuu_saikuru_kbn->hikae_dltflg = $dlt_flg;
        $bak_kaishuu_saikuru_kbn->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_kaishuu_saikuru_kbn->hikae_nichiji = date("Y-m-d H:i:s");
        if (!$bak_kaishuu_saikuru_kbn->save()) {
            foreach ($bak_kaishuu_saikuru_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
    }

}
