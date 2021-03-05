<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class ShiiresakiBunrui1KbnsController extends ControllerBase
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
            $query = Criteria::fromInput($this->di, 'ShiiresakiBunrui1Kbns', $_POST);
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
            $numberPage = ShiiresakiBunrui1Kbns::count($parameters1) / 10 + 1;
        }

        $shiiresaki_bunrui1_kbns = ShiiresakiBunrui1Kbns::find($parameters);
        if (count($shiiresaki_bunrui1_kbns) == 0) {
            $this->flash->notice("検索の結果、仕入先分類１は０件でした。");
        }

        $paginator = new Paginator(array(
            'data' => $shiiresaki_bunrui1_kbns,
            'limit'=> 10,
            'page' => $numberPage
        ));

        $this->view->page = $paginator->getPaginate();
    }

    /**
     * Searches for shiiresaki_bunrui1_kbns
     */
    public function searchAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Displays the creation form
     */
    public function newAction($id=null, $dataname="ShiiresakiBunrui1Kbns")
    {
        $this->view->imax = 0;
        if ($id) {
            $nameDts = $dataname;
            $shiiresaki_bunrui1_kbn = $nameDts::findFirstByid($id);
            if (!$shiiresaki_bunrui1_kbn) {
                $this->flash->error("仕入先分類１が見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "shiiresaki_bunrui1_kbns",
                    'action' => 'index'
                ));

                return;
            }
            $this->_setDefault($shiiresaki_bunrui1_kbn, "new", $dataname);
            $this->tag->setDefault("id", null);
            $this->tag->setDefault("cd", null);
        }

    }

    /**
     * モーダル 2019/11/12 Nishiyama
     */
    public function modalAction()
    {
        ControllerBase::indexCd("ShiiresakiBunrui1Kbns", "仕入先分類1台帳");
    }

    /*
     * Ajax 2019/11/12 Nishiyama
     */
    public function ajaxGetAction()
    {
        $this->view->disable();
        $response = new \Phalcon\Http\Response();
        if (!$this->request->isAjax()) {
            echo "is not Ajax ! ";
        }
        if (!$this->request->isPost()) {
            echo "is not Post ! ";
        }
        $shiiresaki_bunrui1 = ShiiresakiBunrui1Kbns::find(array(
            'order' => 'cd',
            'conditions' => ' cd LIKE ?1 ',
            'bind' => array(1 => $this->request->getPost('cd').'%')
        ));
        $res_flds = ["id","cd","name",];
        $resData = array();
        foreach ($shiiresaki_bunrui1 as $bunrui1) {
            $resAdata = array();
            foreach ($res_flds as $res_fld) {
                $resAdata[$res_fld] = $bunrui1->$res_fld;
            }
            $resData[] = $resAdata;
        }
        $response->setContent(json_encode($resData));
        return $response;
    }

    /**
     * Edits a shiiresaki_bunrui1_kbn
     *
     * @param string $id
     */
    public function editAction($id)
    {
        if (!$this->request->isPost()) {

            $shiiresaki_bunrui1_kbn = ShiiresakiBunrui1Kbns::findFirstByid($id);
            if (!$shiiresaki_bunrui1_kbn) {
                $this->flash->error("仕入先分類１が見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "shiiresaki_bunrui1_kbns",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->id = $shiiresaki_bunrui1_kbn->id;

            $this->tag->setDefault("id", $shiiresaki_bunrui1_kbn->id);
            $this->tag->setDefault("cd", $shiiresaki_bunrui1_kbn->cd);
            $this->tag->setDefault("name", $shiiresaki_bunrui1_kbn->name);
            $this->tag->setDefault("id_moto", $shiiresaki_bunrui1_kbn->id_moto);
            $this->tag->setDefault("hikae_dltflg", $shiiresaki_bunrui1_kbn->hikae_dltflg);
            $this->tag->setDefault("hikae_user_id", $shiiresaki_bunrui1_kbn->hikae_user_id);
            $this->tag->setDefault("hikae_nichiji", $shiiresaki_bunrui1_kbn->hikae_nichiji);
            $this->tag->setDefault("sakusei_user_id", $shiiresaki_bunrui1_kbn->sakusei_user_id);
            $this->tag->setDefault("created", $shiiresaki_bunrui1_kbn->created);
            $this->tag->setDefault("kousin_user_id", $shiiresaki_bunrui1_kbn->kousin_user_id);
            $this->tag->setDefault("updated", $shiiresaki_bunrui1_kbn->updated);
            
        }
    }

    /**
     * Creates a new shiiresaki_bunrui1_kbn
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "shiiresaki_bunrui1_kbns",
                'action' => 'index'
            ));

            return;
        }

        $shiiresaki_bunrui1_kbn = new ShiiresakiBunrui1Kbns();
        $post_flds = ["cd","name","updated",];
        foreach ($post_flds as $post_fld) {
            $shiiresaki_bunrui1_kbn->$post_fld = $this->request->getPost($post_fld);
        }
        

        if (!$shiiresaki_bunrui1_kbn->save()) {
            foreach ($shiiresaki_bunrui1_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "shiiresaki_bunrui1_kbns",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("仕入先分類１の作成が完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "shiiresaki_bunrui1_kbns",
            'action' => 'edit',
            'params' => array($shiiresaki_bunrui1_kbn->id)
        ));
    }

    /**
     * Saves a shiiresaki_bunrui1_kbn edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "shiiresaki_bunrui1_kbns",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $shiiresaki_bunrui1_kbn = ShiiresakiBunrui1Kbns::findFirstByid($id);

        if (!$shiiresaki_bunrui1_kbn) {
            $this->flash->error("仕入先分類１が見つからなくなりました。" . $id);

            $this->dispatcher->forward(array(
                'controller' => "shiiresaki_bunrui1_kbns",
                'action' => 'index'
            ));

            return;
        }

        $post_flds = ["cd","name","updated",];
        $chg_flg = 0;
        foreach ($post_flds as $post_fld) {
            if ($shiiresaki_bunrui1_kbn->$post_fld != $this->request->getPost($post_fld)) {$chg_flg = 1; break;}
        }
        if ($chg_flg === 0) {
            $this->flash->error("変更がありません。" . $id);

            $this->dispatcher->forward(array(
                "controller" => "shiiresaki_bunrui1_kbns",
                "action" => "edit",
                "params" => array($shiiresaki_bunrui1_kbn->id)
            ));

            return;
        }

        $this->_bakOut($shiiresaki_bunrui1_kbn);

        foreach ($post_flds as $post_fld) {
            $shiiresaki_bunrui1_kbn->$post_fld = $this->request->getPost($post_fld);
        }
        

        if (!$shiiresaki_bunrui1_kbn->save()) {

            foreach ($shiiresaki_bunrui1_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "shiiresaki_bunrui1_kbns",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $this->flash->success("仕入先分類１の情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "shiiresaki_bunrui1_kbns",
            'action' => 'edit',
            'params' => array($shiiresaki_bunrui1_kbn->id)
        ));
    }

    /**
     * Deletes a shiiresaki_bunrui1_kbn
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $shiiresaki_bunrui1_kbn = ShiiresakiBunrui1Kbns::findFirstByid($id);
        if (!$shiiresaki_bunrui1_kbn) {
            $this->flash->error("仕入先分類１が見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "shiiresaki_bunrui1_kbns",
                'action' => 'index'
            ));

            return;
        }

        if (!$shiiresaki_bunrui1_kbn->delete()) {

            foreach ($shiiresaki_bunrui1_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "shiiresaki_bunrui1_kbns",
                'action' => 'search'
            ));

            return;
        }

        $this->_bakOut($shiiresaki_bunrui1_kbn, 1);

        $this->flash->success("仕入先分類１の削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "shiiresaki_bunrui1_kbns",
            'action' => "index"
        ));
    }

    /**
     * Back Out a shiiresaki_bunrui1_kbn
     *
     * @param string $shiiresaki_bunrui1_kbn, $dlt_flg
     */
    public function _bakOut($shiiresaki_bunrui1_kbn, $dlt_flg = 0)
    {

        $bak_shiiresaki_bunrui1_kbn = new BakShiiresakiBunrui1Kbns();
        foreach ($shiiresaki_bunrui1_kbn as $fld => $value) {
            $bak_shiiresaki_bunrui1_kbn->$fld = $shiiresaki_bunrui1_kbn->$fld;
        }
        $bak_shiiresaki_bunrui1_kbn->id = NULL;
        $bak_shiiresaki_bunrui1_kbn->id_moto = $shiiresaki_bunrui1_kbn->id;
        $bak_shiiresaki_bunrui1_kbn->hikae_dltflg = $dlt_flg;
        $bak_shiiresaki_bunrui1_kbn->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_shiiresaki_bunrui1_kbn->hikae_nichiji = date("Y-m-d H:i:s");
        if (!$bak_shiiresaki_bunrui1_kbn->save()) {
            foreach ($bak_shiiresaki_bunrui1_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
    }

}
