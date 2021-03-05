<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class TanniMrsController extends ControllerBase
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
            $query = Criteria::fromInput($this->di, 'TanniMrs', $_POST);
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
            $numberPage = TanniMrs::count($parameters1) / 10 + 1;
        }

        $tanni_mrs = TanniMrs::find($parameters);
        if (count($tanni_mrs) == 0) {
            $this->flash->notice("検索の結果、単位マスタは０件でした。");
        }

        $paginator = new Paginator(array(
            'data' => $tanni_mrs,
            'limit'=> 10,
            'page' => $numberPage
        ));

        $this->view->page = $paginator->getPaginate();
    }

    /**
     * Searches for tanni_mrs
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
     * Edits a tanni_mr
     *
     * @param string $id
     */
    public function editAction($id)
    {
        if (!$this->request->isPost()) {

            $tanni_mr = TanniMrs::findFirstByid($id);
            if (!$tanni_mr) {
                $this->flash->error("単位マスタが見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "tanni_mrs",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->id = $tanni_mr->id;

            $this->tag->setDefault("id", $tanni_mr->id);
            $this->tag->setDefault("cd", $tanni_mr->cd);
            $this->tag->setDefault("name", $tanni_mr->name);
            $this->tag->setDefault("bikou", $tanni_mr->bikou);
            $this->tag->setDefault("id_moto", $tanni_mr->id_moto);
            $this->tag->setDefault("hikae_dltflg", $tanni_mr->hikae_dltflg);
            $this->tag->setDefault("hikae_user_id", $tanni_mr->hikae_user_id);
            $this->tag->setDefault("hikae_nichiji", $tanni_mr->hikae_nichiji);
            $this->tag->setDefault("sakusei_user_id", $tanni_mr->sakusei_user_id);
            $this->tag->setDefault("created", $tanni_mr->created);
            $this->tag->setDefault("kousin_user_id", $tanni_mr->kousin_user_id);
            $this->tag->setDefault("updated", $tanni_mr->updated);
            
        }
    }

    /**
     * Creates a new tanni_mr
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "tanni_mrs",
                'action' => 'index'
            ));

            return;
        }

        $tanni_mr = new TanniMrs();
        $post_flds = ["cd","name","bikou","updated",];
        foreach ($post_flds as $post_fld) {
            $tanni_mr->$post_fld = $this->request->getPost($post_fld);
        }
        

        if (!$tanni_mr->save()) {
            foreach ($tanni_mr->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "tanni_mrs",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("単位マスタの作成が完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "tanni_mrs",
            'action' => 'edit',
            'params' => array($tanni_mr->id)
        ));
    }

    /**
     * Saves a tanni_mr edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "tanni_mrs",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $tanni_mr = TanniMrs::findFirstByid($id);

        if (!$tanni_mr) {
            $this->flash->error("単位マスタが見つからなくなりました。" . $id);

            $this->dispatcher->forward(array(
                'controller' => "tanni_mrs",
                'action' => 'index'
            ));

            return;
        }

        $post_flds = ["cd","name","bikou","updated",];
        $chg_flg = 0;
        foreach ($post_flds as $post_fld) {
            if ($tanni_mr->$post_fld != $this->request->getPost($post_fld)) {$chg_flg = 1; break;}
        }
        if ($chg_flg === 0) {
            $this->flash->error("変更がありません。" . $id);

            $this->dispatcher->forward(array(
                "controller" => "tanni_mrs",
                "action" => "edit",
                "params" => array($tanni_mr->id)
            ));

            return;
        }

        $this->_bakOut($tanni_mr);

        foreach ($post_flds as $post_fld) {
            $tanni_mr->$post_fld = $this->request->getPost($post_fld);
        }
        

        if (!$tanni_mr->save()) {

            foreach ($tanni_mr->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "tanni_mrs",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $this->flash->success("単位マスタの情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "tanni_mrs",
            'action' => 'edit',
            'params' => array($tanni_mr->id)
        ));
    }

    /**
     * Deletes a tanni_mr
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $tanni_mr = TanniMrs::findFirstByid($id);
        if (!$tanni_mr) {
            $this->flash->error("単位マスタが見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "tanni_mrs",
                'action' => 'index'
            ));

            return;
        }

        if (!$tanni_mr->delete()) {

            foreach ($tanni_mr->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "tanni_mrs",
                'action' => 'search'
            ));

            return;
        }

        $this->_bakOut($tanni_mr, 1);

        $this->flash->success("単位マスタの削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "tanni_mrs",
            'action' => "index"
        ));
    }

    /**
     * Back Out a tanni_mr
     *
     * @param string $tanni_mr, $dlt_flg
     */
    public function _bakOut($tanni_mr, $dlt_flg = 0)
    {

        $bak_tanni_mr = new BakTanniMrs();
        foreach ($tanni_mr as $fld => $value) {
            $bak_tanni_mr->$fld = $tanni_mr->$fld;
        }
        $bak_tanni_mr->id = NULL;
        $bak_tanni_mr->id_moto = $tanni_mr->id;
        $bak_tanni_mr->hikae_dltflg = $dlt_flg;
        $bak_tanni_mr->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_tanni_mr->hikae_nichiji = date("Y-m-d H:i:s");
        if (!$bak_tanni_mr->save()) {
            foreach ($bak_tanni_mr->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
    }

}
