<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class LoadKoumokuMrsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'LoadKoumokuMrs', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = array();
        }
        $parameters["order"] = "cd";

        $load_koumoku_mrs = LoadKoumokuMrs::find($parameters);
        if (count($load_koumoku_mrs) == 0) {
            $this->flash->notice("検索の結果、ロード項目マスタは０件でした。");
        }

        $paginator = new Paginator(array(
            'data' => $load_koumoku_mrs,
            'limit'=> 10,
            'page' => $numberPage
        ));

        $this->view->page = $paginator->getPaginate();
    }

    /**
     * Searches for load_koumoku_mrs
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
     * Edits a load_koumoku_mr
     *
     * @param string $id
     */
    public function editAction($id)
    {
        if (!$this->request->isPost()) {

            $load_koumoku_mr = LoadKoumokuMrs::findFirstByid($id);
            if (!$load_koumoku_mr) {
                $this->flash->error("ロード項目マスタが見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "load_koumoku_mrs",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->id = $load_koumoku_mr->id;

            $this->tag->setDefault("id", $load_koumoku_mr->id);
            $this->tag->setDefault("cd", $load_koumoku_mr->cd);
            $this->tag->setDefault("name", $load_koumoku_mr->name);
            $this->tag->setDefault("load_mr_cd", $load_koumoku_mr->load_mr_cd);
            $this->tag->setDefault("jun", $load_koumoku_mr->jun);
            $this->tag->setDefault("koumoku_mr_cd", $load_koumoku_mr->koumoku_mr_cd);
            $this->tag->setDefault("keys", $load_koumoku_mr->keys);
            $this->tag->setDefault("fusiyou_kbn", $load_koumoku_mr->fusiyou_kbn);
            $this->tag->setDefault("id_moto", $load_koumoku_mr->id_moto);
            $this->tag->setDefault("hikae_dltflg", $load_koumoku_mr->hikae_dltflg);
            $this->tag->setDefault("hikae_user_id", $load_koumoku_mr->hikae_user_id);
            $this->tag->setDefault("hikae_nichiji", $load_koumoku_mr->hikae_nichiji);
            $this->tag->setDefault("sakusei_user_id", $load_koumoku_mr->sakusei_user_id);
            $this->tag->setDefault("created", $load_koumoku_mr->created);
            $this->tag->setDefault("kousin_user_id", $load_koumoku_mr->kousin_user_id);
            $this->tag->setDefault("updated", $load_koumoku_mr->updated);
            
        }
    }

    /**
     * Creates a new load_koumoku_mr
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "load_koumoku_mrs",
                'action' => 'index'
            ));

            return;
        }

        $load_koumoku_mr = new LoadKoumokuMrs();
        $post_flds = ["cd","name","load_mr_cd","jun","koumoku_mr_cd","keys","fusiyou_kbn","updated",];
        foreach ($post_flds as $post_fld) {
            $load_koumoku_mr->$post_fld = $this->request->getPost($post_fld);
        }
        

        if (!$load_koumoku_mr->save()) {
            foreach ($load_koumoku_mr->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "load_koumoku_mrs",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("ロード項目マスタの作成が完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "load_koumoku_mrs",
            'action' => 'edit',
            'params' => array($load_koumoku_mr->id)
        ));
    }

    /**
     * Saves a load_koumoku_mr edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "load_koumoku_mrs",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $load_koumoku_mr = LoadKoumokuMrs::findFirstByid($id);

        if (!$load_koumoku_mr) {
            $this->flash->error("ロード項目マスタが見つからなくなりました。" . $id);

            $this->dispatcher->forward(array(
                'controller' => "load_koumoku_mrs",
                'action' => 'index'
            ));

            return;
        }

        $post_flds = ["cd","name","load_mr_cd","jun","koumoku_mr_cd","keys","fusiyou_kbn","updated",];
        $chg_flg = 0;
        foreach ($post_flds as $post_fld) {
            if ($load_koumoku_mr->$post_fld != $this->request->getPost($post_fld)) {$chg_flg = 1; break;}
        }
        if ($chg_flg === 0) {
            $this->flash->error("変更がありません。" . $id);

            $this->dispatcher->forward(array(
                "controller" => "load_koumoku_mrs",
                "action" => "edit",
                "params" => array($load_koumoku_mr->id)
            ));

            return;
        }

        $this->_bakOut($load_koumoku_mr);

        foreach ($post_flds as $post_fld) {
            $load_koumoku_mr->$post_fld = $this->request->getPost($post_fld);
        }
        

        if (!$load_koumoku_mr->save()) {

            foreach ($load_koumoku_mr->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "load_koumoku_mrs",
                'action' => 'edit',
                'params' => array($load_koumoku_mr->id)
            ));

            return;
        }

        $this->flash->success("ロード項目マスタの情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "load_koumoku_mrs",
            'action' => 'edit',
            'params' => array($load_koumoku_mr->id)
        ));
    }

    /**
     * Deletes a load_koumoku_mr
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $load_koumoku_mr = LoadKoumokuMrs::findFirstByid($id);
        if (!$load_koumoku_mr) {
            $this->flash->error("ロード項目マスタが見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "load_koumoku_mrs",
                'action' => 'index'
            ));

            return;
        }

        if (!$load_koumoku_mr->delete()) {

            foreach ($load_koumoku_mr->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "load_koumoku_mrs",
                'action' => 'search'
            ));

            return;
        }

        $this->_bakOut($load_koumoku_mr, 1);

        $this->flash->success("ロード項目マスタの削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "load_koumoku_mrs",
            'action' => "index"
        ));
    }

    /**
     * Back Out a load_koumoku_mr
     *
     * @param string $load_koumoku_mr, $dlt_flg
     */
    public function _bakOut($load_koumoku_mr, $dlt_flg = 0)
    {

        $bak_load_koumoku_mr = new BakLoadKoumokuMrs();
        foreach ($load_koumoku_mr as $fld => $value) {
            $bak_load_koumoku_mr->$fld = $load_koumoku_mr->$fld;
        }
        $bak_load_koumoku_mr->id = NULL;
        $bak_load_koumoku_mr->id_moto = $load_koumoku_mr->id;
        $bak_load_koumoku_mr->hikae_dltflg = $dlt_flg;
        $bak_load_koumoku_mr->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_load_koumoku_mr->hikae_nichiji = date("Y-m-d H:i:s");
        if (!$bak_load_koumoku_mr->save()) {
            foreach ($bak_load_koumoku_mr->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
    }


    /**
     * Autogens a load_koumoku_mr
     *
     */
    public function autogenAction($id)
    {
        $load_mr = LoadMrs::findFirstByid($id);
        $koumoku_mrs = KoumokuMrs::find(array("table_mr_cd = '".$load_mr->table_mr_cd."'", "order"=>"jun"));
        foreach ($koumoku_mrs as $koumoku_mr) {
            $load_koumoku_mr = LoadKoumokuMrs::findfirst(array("load_mr_cd = '".$load_mr->cd."' AND koumoku_mr_cd = '".$koumoku_mr->cd."'",));
            if (!$load_koumoku_mr) {
                $load_koumoku_mr = new LoadKoumokuMrs();
                $load_koumoku_mr->koumoku_mr_cd = $koumoku_mr->cd;
            }
            $load_koumoku_mr->cd = $koumoku_mr->cd;
            $load_koumoku_mr->name = $koumoku_mr->name;
            $load_koumoku_mr->load_mr_cd = $load_mr->cd;
            $load_koumoku_mr->jun = $koumoku_mr->jun;
            $load_koumoku_mr->keys = 0;
            $load_koumoku_mr->fusiyou_kbn = 0;
            if (!$load_koumoku_mr->save()) {
                foreach ($load_koumoku_mr->getMessages() as $message) {
                    $this->flash->error($message);
                }
            }
        }
        
        $this->flash->success("ロードマスタの自動登録を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "load_mrs",
            'action' => "edit",
            'params' => array($id)
        ));
    }
}
