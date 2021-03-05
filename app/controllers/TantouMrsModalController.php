<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class TantouMrsModalController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'TantouMrs', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = array();
        }
        if (!array_key_exists('order',$_POST)) {//更新から戻ったときは検索クリア
            $parameters = array();
        }
        $parameters["order"] = "id";

        $tantou_mrs = TantouMrs::find($parameters);
        if (count($tantou_mrs) == 0) {
            $this->flash->notice("検索の結果、担当者マスタは０件でした。");

            $this->dispatcher->forward(array(
                "controller" => "tantou_mrs",
                "action" => "new"
            ));

            return;
        }

        $paginator = new Paginator(array(
            'data' => $tantou_mrs,
            'limit'=> 10,
            'page' => $numberPage
        ));

        $this->view->page = $paginator->getPaginate();
    }

    /**
     * Searches for tantou_mrs
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
     * Edits a tantou_mr
     *
     * @param string $id
     */
    public function editAction($id)
    {
        if (!$this->request->isPost()) {

            $tantou_mr = TantouMrs::findFirstByid($id);
            if (!$tantou_mr) {
                $this->flash->error("担当者マスタが見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "tantou_mrs",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->id = $tantou_mr->id;

            $this->tag->setDefault("id", $tantou_mr->id);
            $this->tag->setDefault("cd", $tantou_mr->cd);
            $this->tag->setDefault("name", $tantou_mr->name);
            $this->tag->setDefault("kana_mei", $tantou_mr->kana_mei);
            $this->tag->setDefault("bumon_mr_cd", $tantou_mr->bumon_mr_cd);
            $this->tag->setDefault("id_moto", $tantou_mr->id_moto);
            $this->tag->setDefault("hikae_dltflg", $tantou_mr->hikae_dltflg);
            $this->tag->setDefault("hikae_user_id", $tantou_mr->hikae_user_id);
            $this->tag->setDefault("hikae_nichiji", $tantou_mr->hikae_nichiji);
            $this->tag->setDefault("sakusei_user_id", $tantou_mr->sakusei_user_id);
            $this->tag->setDefault("created", $tantou_mr->created);
            $this->tag->setDefault("kousin_user_id", $tantou_mr->kousin_user_id);
            $this->tag->setDefault("updated", $tantou_mr->updated);
            
        }
    }

    /**
     * Creates a new tantou_mr
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "tantou_mrs",
                'action' => 'index'
            ));

            return;
        }

        $tantou_mr = new TantouMrs();
        $post_flds = ["cd","name","kana_mei","bumon_mr_cd","updated",];
        foreach ($post_flds as $post_fld) {
            $tantou_mr->$post_fld = $this->request->getPost($post_fld);
        }
        

        if (!$tantou_mr->save()) {
            foreach ($tantou_mr->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "tantou_mrs",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("担当者マスタの作成が完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "tantou_mrs",
            'action' => 'index'
        ));
    }

    /**
     * Saves a tantou_mr edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "tantou_mrs",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $tantou_mr = TantouMrs::findFirstByid($id);

        if (!$tantou_mr) {
            $this->flash->error("担当者マスタが見つからなくなりました。" . $id);

            $this->dispatcher->forward(array(
                'controller' => "tantou_mrs",
                'action' => 'index'
            ));

            return;
        }

        $post_flds = ["cd","name","kana_mei","bumon_mr_cd","updated",];
        $chg_flg = 0;
        foreach ($post_flds as $post_fld) {
            if ($tantou_mr->$post_fld != $this->request->getPost($post_fld)) {$chg_flg = 1; break;}
        }
        if ($chg_flg === 0) {
            $this->flash->error("変更がありません。" . $id);

            $this->dispatcher->forward(array(
                "controller" => "tantou_mrs",
                "action" => "edit",
                "params" => array($tantou_mr->id)
            ));

            return;
        }

        $this->_bakOut($tantou_mr);

        foreach ($post_flds as $post_fld) {
            $tantou_mr->$post_fld = $this->request->getPost($post_fld);
        }
        

        if (!$tantou_mr->save()) {

            foreach ($tantou_mr->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "tantou_mrs",
                'action' => 'edit',
                'params' => array($tantou_mr->id)
            ));

            return;
        }

        $this->flash->success("担当者マスタの情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "tantou_mrs",
            'action' => 'index'
        ));
    }

    /**
     * Deletes a tantou_mr
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $tantou_mr = TantouMrs::findFirstByid($id);
        if (!$tantou_mr) {
            $this->flash->error("担当者マスタが見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "tantou_mrs",
                'action' => 'index'
            ));

            return;
        }

        if (!$tantou_mr->delete()) {

            foreach ($tantou_mr->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "tantou_mrs",
                'action' => 'search'
            ));

            return;
        }

        $this->_bakOut($tantou_mr, 1);

        $this->flash->success("担当者マスタの削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "tantou_mrs",
            'action' => "index"
        ));
    }

    /**
     * Back Out a tantou_mr
     *
     * @param string $tantou_mr, $dlt_flg
     */
    public function _bakOut($tantou_mr, $dlt_flg = 0)
    {

        $bak_tantou_mr = new BakTantouMrs();
        foreach ($tantou_mr as $fld => $value) {
            $bak_tantou_mr->$fld = $tantou_mr->$fld;
        }
        $bak_tantou_mr->id = NULL;
        $bak_tantou_mr->id_moto = $tantou_mr->id;
        $bak_tantou_mr->hikae_dltflg = $dlt_flg;
        $bak_tantou_mr->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_tantou_mr->hikae_nichiji = date("Y-m-d H:i:s");
        if (!$bak_tantou_mr->save()) {
            foreach ($bak_tantou_mr->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
    }

}
