<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class LoadHenkanMrsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'LoadHenkanMrs', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = array();
        }
/*        if (!array_key_exists('order',$_POST)) {//更新から戻ったときは検索クリア
            $parameters = array();
        }
*/
        $parameters["order"] = array("load_mr_cd","cd");

        $load_henkan_mrs = LoadHenkanMrs::find($parameters);
        if (count($load_henkan_mrs) == 0) {
            $this->flash->notice("検索の結果、ロード変換マスタは０件でした。");
        }

        $paginator = new Paginator(array(
            'data' => $load_henkan_mrs,
            'limit'=> 10,
            'page' => $numberPage
        ));

        $this->view->page = $paginator->getPaginate();
    }

    /**
     * Searches for load_henkan_mrs
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
     * Edits a load_henkan_mr
     *
     * @param string $id
     */
    public function editAction($id)
    {
        if (!$this->request->isPost()) {

            $load_henkan_mr = LoadHenkanMrs::findFirstByid($id);
            if (!$load_henkan_mr) {
                $this->flash->error("ロード変換マスタが見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "load_henkan_mrs",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->id = $load_henkan_mr->id;

            $this->tag->setDefault("id", $load_henkan_mr->id);
            $this->tag->setDefault("cd", $load_henkan_mr->cd);
            $this->tag->setDefault("name", $load_henkan_mr->name);
            $this->tag->setDefault("load_mr_cd", $load_henkan_mr->load_mr_cd);
            $this->tag->setDefault("load_koumoku_mr_cd", $load_henkan_mr->load_koumoku_mr_cd);
            $this->tag->setDefault("id_moto", $load_henkan_mr->id_moto);
            $this->tag->setDefault("hikae_dltflg", $load_henkan_mr->hikae_dltflg);
            $this->tag->setDefault("hikae_user_id", $load_henkan_mr->hikae_user_id);
            $this->tag->setDefault("hikae_nichiji", $load_henkan_mr->hikae_nichiji);
            $this->tag->setDefault("sakusei_user_id", $load_henkan_mr->sakusei_user_id);
            $this->tag->setDefault("created", $load_henkan_mr->created);
            $this->tag->setDefault("kousin_user_id", $load_henkan_mr->kousin_user_id);
            $this->tag->setDefault("updated", $load_henkan_mr->updated);
            
        }
    }

    /**
     * Creates a new load_henkan_mr
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "load_henkan_mrs",
                'action' => 'index'
            ));

            return;
        }

        $load_henkan_mr = new LoadHenkanMrs();
        $post_flds = ["cd","name","load_mr_cd","load_koumoku_mr_cd","updated",];
        foreach ($post_flds as $post_fld) {
            $load_henkan_mr->$post_fld = $this->request->getPost($post_fld);
        }
        

        if (!$load_henkan_mr->save()) {
            foreach ($load_henkan_mr->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "load_henkan_mrs",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("ロード変換マスタの作成が完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "load_henkan_mrs",
            'action' => 'edit',
            'params' => array($load_henkan_mr->id)
        ));
    }

    /**
     * Saves a load_henkan_mr edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "load_henkan_mrs",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $load_henkan_mr = LoadHenkanMrs::findFirstByid($id);

        if (!$load_henkan_mr) {
            $this->flash->error("ロード変換マスタが見つからなくなりました。" . $id);

            $this->dispatcher->forward(array(
                'controller' => "load_henkan_mrs",
                'action' => 'index'
            ));

            return;
        }

        $post_flds = ["cd","name","load_mr_cd","load_koumoku_mr_cd","updated",];
        $chg_flg = 0;
        foreach ($post_flds as $post_fld) {
            if ($load_henkan_mr->$post_fld != $this->request->getPost($post_fld)) {$chg_flg = 1; break;}
        }
        if ($chg_flg === 0) {
            $this->flash->error("変更がありません。" . $id);

            $this->dispatcher->forward(array(
                "controller" => "load_henkan_mrs",
                "action" => "edit",
                "params" => array($load_henkan_mr->id)
            ));

            return;
        }

        $this->_bakOut($load_henkan_mr);

        foreach ($post_flds as $post_fld) {
            $load_henkan_mr->$post_fld = $this->request->getPost($post_fld);
        }
        

        if (!$load_henkan_mr->save()) {

            foreach ($load_henkan_mr->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "load_henkan_mrs",
                'action' => 'edit',
                'params' => array($load_henkan_mr->id)
            ));

            return;
        }

        $this->flash->success("ロード変換マスタの情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "load_henkan_mrs",
            'action' => 'edit',
            'params' => array($id)
        ));
    }

    /**
     * Deletes a load_henkan_mr
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $load_henkan_mr = LoadHenkanMrs::findFirstByid($id);
        if (!$load_henkan_mr) {
            $this->flash->error("ロード変換マスタが見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "load_henkan_mrs",
                'action' => 'index'
            ));

            return;
        }

        if (!$load_henkan_mr->delete()) {

            foreach ($load_henkan_mr->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "load_henkan_mrs",
                'action' => 'search'
            ));

            return;
        }

        $this->_bakOut($load_henkan_mr, 1);

        $this->flash->success("ロード変換マスタの削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "load_henkan_mrs",
            'action' => "index"
        ));
    }

    /**
     * Back Out a load_henkan_mr
     *
     * @param string $load_henkan_mr, $dlt_flg
     */
    public function _bakOut($load_henkan_mr, $dlt_flg = 0)
    {

        $bak_load_henkan_mr = new BakLoadHenkanMrs();
        foreach ($load_henkan_mr as $fld => $value) {
            $bak_load_henkan_mr->$fld = $load_henkan_mr->$fld;
        }
        $bak_load_henkan_mr->id = NULL;
        $bak_load_henkan_mr->id_moto = $load_henkan_mr->id;
        $bak_load_henkan_mr->hikae_dltflg = $dlt_flg;
        $bak_load_henkan_mr->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_load_henkan_mr->hikae_nichiji = date("Y-m-d H:i:s");
        if (!$bak_load_henkan_mr->save()) {
            foreach ($bak_load_henkan_mr->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
    }

}
