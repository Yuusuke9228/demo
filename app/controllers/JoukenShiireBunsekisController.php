<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class JoukenShiireBunsekisController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for jouken_shiire_bunsekis
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'JoukenShiireBunsekis', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = [];
        }
        $parameters["order"] = "id";

        $jouken_shiire_bunsekis = JoukenShiireBunsekis::find($parameters);
        if (count($jouken_shiire_bunsekis) == 0) {
            $this->flash->notice("The search did not find any jouken_shiire_bunsekis");

            $this->dispatcher->forward([
                "controller" => "jouken_shiire_bunsekis",
                "action" => "index"
            ]);

            return;
        }

        $paginator = new Paginator([
            'data' => $jouken_shiire_bunsekis,
            'limit'=> 10,
            'page' => $numberPage
        ]);

        $this->view->page = $paginator->getPaginate();
    }

    /**
     * Displays the creation form
     */
    public function newAction()
    {

    }

    /**
     * Edits a jouken_shiire_bunseki
     *
     * @param string $id
     */
    public function editAction($id)
    {
        if (!$this->request->isPost()) {

            $jouken_shiire_bunseki = JoukenShiireBunsekis::findFirstByid($id);
            if (!$jouken_shiire_bunseki) {
                $this->flash->error("jouken_shiire_bunseki was not found");

                $this->dispatcher->forward([
                    'controller' => "jouken_shiire_bunsekis",
                    'action' => 'index'
                ]);

                return;
            }

            $this->view->id = $jouken_shiire_bunseki->id;

            $this->tag->setDefault("id", $jouken_shiire_bunseki->id);
            $this->tag->setDefault("cd", $jouken_shiire_bunseki->cd);
            $this->tag->setDefault("name", $jouken_shiire_bunseki->name);
            $this->tag->setDefault("junjo_kbn_cd", $jouken_shiire_bunseki->junjo_kbn_cd);
            $this->tag->setDefault("hanni_from", $jouken_shiire_bunseki->hanni_from);
            $this->tag->setDefault("hanni_to", $jouken_shiire_bunseki->hanni_to);
            $this->tag->setDefault("junjo2_kbn_cd", $jouken_shiire_bunseki->junjo2_kbn_cd);
            $this->tag->setDefault("hanni2_from", $jouken_shiire_bunseki->hanni2_from);
            $this->tag->setDefault("hanni2_to", $jouken_shiire_bunseki->hanni2_to);
            $this->tag->setDefault("kikan_sitei_kbn_cd", $jouken_shiire_bunseki->kikan_sitei_kbn_cd);
            $this->tag->setDefault("kikan_from", $jouken_shiire_bunseki->kikan_from);
            $this->tag->setDefault("kikan_to", $jouken_shiire_bunseki->kikan_to);
            $this->tag->setDefault("koujun_flg", $jouken_shiire_bunseki->koujun_flg);
            $this->tag->setDefault("meisaigyou_flg", $jouken_shiire_bunseki->meisaigyou_flg);
            $this->tag->setDefault("goukeigyou_flg", $jouken_shiire_bunseki->goukeigyou_flg);
            $this->tag->setDefault("torihikiari_flg", $jouken_shiire_bunseki->torihikiari_flg);
            $this->tag->setDefault("torihikinashi_flg", $jouken_shiire_bunseki->torihikinashi_flg);
            $this->tag->setDefault("id_moto", $jouken_shiire_bunseki->id_moto);
            $this->tag->setDefault("hikae_dltflg", $jouken_shiire_bunseki->hikae_dltflg);
            $this->tag->setDefault("hikae_user_id", $jouken_shiire_bunseki->hikae_user_id);
            $this->tag->setDefault("hikae_nichiji", $jouken_shiire_bunseki->hikae_nichiji);
            $this->tag->setDefault("sakusei_user_id", $jouken_shiire_bunseki->sakusei_user_id);
            $this->tag->setDefault("created", $jouken_shiire_bunseki->created);
            $this->tag->setDefault("kousin_user_id", $jouken_shiire_bunseki->kousin_user_id);
            $this->tag->setDefault("updated", $jouken_shiire_bunseki->updated);
            
        }
    }

    /**
     * Creates a new jouken_shiire_bunseki
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "jouken_shiire_bunsekis",
                'action' => 'index'
            ]);

            return;
        }

        $jouken_shiire_bunseki = new JoukenShiireBunsekis();
        $jouken_shiire_bunseki->cd = $this->request->getPost("cd");
        $jouken_shiire_bunseki->name = $this->request->getPost("name");
        $jouken_shiire_bunseki->junjoKbnCd = $this->request->getPost("junjo_kbn_cd");
        $jouken_shiire_bunseki->hanniFrom = $this->request->getPost("hanni_from");
        $jouken_shiire_bunseki->hanniTo = $this->request->getPost("hanni_to");
        $jouken_shiire_bunseki->junjo2KbnCd = $this->request->getPost("junjo2_kbn_cd");
        $jouken_shiire_bunseki->hanni2From = $this->request->getPost("hanni2_from");
        $jouken_shiire_bunseki->hanni2To = $this->request->getPost("hanni2_to");
        $jouken_shiire_bunseki->kikanSiteiKbnCd = $this->request->getPost("kikan_sitei_kbn_cd");
        $jouken_shiire_bunseki->kikanFrom = $this->request->getPost("kikan_from");
        $jouken_shiire_bunseki->kikanTo = $this->request->getPost("kikan_to");
        $jouken_shiire_bunseki->koujunFlg = $this->request->getPost("koujun_flg");
        $jouken_shiire_bunseki->meisaigyouFlg = $this->request->getPost("meisaigyou_flg");
        $jouken_shiire_bunseki->goukeigyouFlg = $this->request->getPost("goukeigyou_flg");
        $jouken_shiire_bunseki->torihikiariFlg = $this->request->getPost("torihikiari_flg");
        $jouken_shiire_bunseki->torihikinashiFlg = $this->request->getPost("torihikinashi_flg");
        $jouken_shiire_bunseki->idMoto = $this->request->getPost("id_moto");
        $jouken_shiire_bunseki->hikaeDltflg = $this->request->getPost("hikae_dltflg");
        $jouken_shiire_bunseki->hikaeUserId = $this->request->getPost("hikae_user_id");
        $jouken_shiire_bunseki->hikaeNichiji = $this->request->getPost("hikae_nichiji");
        $jouken_shiire_bunseki->sakuseiUserId = $this->request->getPost("sakusei_user_id");
        $jouken_shiire_bunseki->created = $this->request->getPost("created");
        $jouken_shiire_bunseki->kousinUserId = $this->request->getPost("kousin_user_id");
        $jouken_shiire_bunseki->updated = $this->request->getPost("updated");
        

        if (!$jouken_shiire_bunseki->save()) {
            foreach ($jouken_shiire_bunseki->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "jouken_shiire_bunsekis",
                'action' => 'new'
            ]);

            return;
        }

        $this->flash->success("jouken_shiire_bunseki was created successfully");

        $this->dispatcher->forward([
            'controller' => "jouken_shiire_bunsekis",
            'action' => 'index'
        ]);
    }

    /**
     * Saves a jouken_shiire_bunseki edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "jouken_shiire_bunsekis",
                'action' => 'index'
            ]);

            return;
        }

        $id = $this->request->getPost("id");
        $jouken_shiire_bunseki = JoukenShiireBunsekis::findFirstByid($id);

        if (!$jouken_shiire_bunseki) {
            $this->flash->error("jouken_shiire_bunseki does not exist " . $id);

            $this->dispatcher->forward([
                'controller' => "jouken_shiire_bunsekis",
                'action' => 'index'
            ]);

            return;
        }

        $jouken_shiire_bunseki->cd = $this->request->getPost("cd");
        $jouken_shiire_bunseki->name = $this->request->getPost("name");
        $jouken_shiire_bunseki->junjoKbnCd = $this->request->getPost("junjo_kbn_cd");
        $jouken_shiire_bunseki->hanniFrom = $this->request->getPost("hanni_from");
        $jouken_shiire_bunseki->hanniTo = $this->request->getPost("hanni_to");
        $jouken_shiire_bunseki->junjo2KbnCd = $this->request->getPost("junjo2_kbn_cd");
        $jouken_shiire_bunseki->hanni2From = $this->request->getPost("hanni2_from");
        $jouken_shiire_bunseki->hanni2To = $this->request->getPost("hanni2_to");
        $jouken_shiire_bunseki->kikanSiteiKbnCd = $this->request->getPost("kikan_sitei_kbn_cd");
        $jouken_shiire_bunseki->kikanFrom = $this->request->getPost("kikan_from");
        $jouken_shiire_bunseki->kikanTo = $this->request->getPost("kikan_to");
        $jouken_shiire_bunseki->koujunFlg = $this->request->getPost("koujun_flg");
        $jouken_shiire_bunseki->meisaigyouFlg = $this->request->getPost("meisaigyou_flg");
        $jouken_shiire_bunseki->goukeigyouFlg = $this->request->getPost("goukeigyou_flg");
        $jouken_shiire_bunseki->torihikiariFlg = $this->request->getPost("torihikiari_flg");
        $jouken_shiire_bunseki->torihikinashiFlg = $this->request->getPost("torihikinashi_flg");
        $jouken_shiire_bunseki->idMoto = $this->request->getPost("id_moto");
        $jouken_shiire_bunseki->hikaeDltflg = $this->request->getPost("hikae_dltflg");
        $jouken_shiire_bunseki->hikaeUserId = $this->request->getPost("hikae_user_id");
        $jouken_shiire_bunseki->hikaeNichiji = $this->request->getPost("hikae_nichiji");
        $jouken_shiire_bunseki->sakuseiUserId = $this->request->getPost("sakusei_user_id");
        $jouken_shiire_bunseki->created = $this->request->getPost("created");
        $jouken_shiire_bunseki->kousinUserId = $this->request->getPost("kousin_user_id");
        $jouken_shiire_bunseki->updated = $this->request->getPost("updated");
        

        if (!$jouken_shiire_bunseki->save()) {

            foreach ($jouken_shiire_bunseki->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "jouken_shiire_bunsekis",
                'action' => 'edit',
                'params' => [$jouken_shiire_bunseki->id]
            ]);

            return;
        }

        $this->flash->success("jouken_shiire_bunseki was updated successfully");

        $this->dispatcher->forward([
            'controller' => "jouken_shiire_bunsekis",
            'action' => 'index'
        ]);
    }

    /**
     * Deletes a jouken_shiire_bunseki
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $jouken_shiire_bunseki = JoukenShiireBunsekis::findFirstByid($id);
        if (!$jouken_shiire_bunseki) {
            $this->flash->error("jouken_shiire_bunseki was not found");

            $this->dispatcher->forward([
                'controller' => "jouken_shiire_bunsekis",
                'action' => 'index'
            ]);

            return;
        }

        if (!$jouken_shiire_bunseki->delete()) {

            foreach ($jouken_shiire_bunseki->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "jouken_shiire_bunsekis",
                'action' => 'search'
            ]);

            return;
        }

        $this->flash->success("jouken_shiire_bunseki was deleted successfully");

        $this->dispatcher->forward([
            'controller' => "jouken_shiire_bunsekis",
            'action' => "index"
        ]);
    }

    /**
     * 条件設定モーダル
     */
    public function modalAction($id = 0)
    {
        if ($id != 0) {
            $jouken_shiire_bunsekis = JoukenShiireBunsekis::findFirstByid($id);
            if (!$jouken_shiire_bunsekis) {
                $this->flash->error("条件が見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "jouken_shiire_bunsekis",
                    'action' => 'modal'
                ));
                return;
            }
            $this->_setDefault($jouken_shiire_bunsekis, "edit");
        }
        $jouken_shiire_bunsekis = JoukenShiireBunsekis::find(["order" => "cd, sakusei_user_id"
            , "conditions" => "sakusei_user_id IN(0, ?0)"
            , "bind" => [0 => $this->getDI()->getSession()->get('auth')['id']]
        ]);
        $joukens = [];
        foreach ($jouken_shiire_bunsekis as $jouken_shiire_bunseki) {
            $joukens[$jouken_shiire_bunseki->cd] = $jouken_shiire_bunseki->name;
        }
        $this->view->joukens = $joukens;
    }

    /**
     * モーダルからSaves
     *
     */
    public function modalsaveAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "jouken_shiire_bunsekis",
                'action' => 'index'
            ));
            return;
        }
        if ($this->request->getPost("cd")) {
            $cd = $this->request->getPost("cd");
            $jouken_shiire_bunsekis = JoukenShiireBunsekis::findFirst(["conditions" => "cd = ?0 AND sakusei_user_id = ?1"
                , "bind" => [0 => $cd, 1 => $this->getDI()->getSession()->get('auth')['id']]
            ]);
        } else {
            $lastcd = JoukenShiireBunsekis::findFirst(["order" => "cd DESC"
                , "conditions" => "sakusei_user_id IN(0, ?0)"
                , "bind" => [0 => $this->getDI()->getSession()->get('auth')['id']]
            ]);
            $cd = "" . ((int)$lastcd->cd + 1);
        }
        $post_flds = [
            "id",
            "cd",
            "name",
            "junjo_kbn_cd",
            "hanni_from",
            "hanni_to",
            "junjo2_kbn_cd",
            "hanni2_from",
            "hanni2_to",
            "koujun_flg",
            "meisaigyou_flg",
            "goukeigyou_flg",
            "torihikiari_flg",
            "torihikinashi_flg",
            "id_moto",
            "hikae_dltflg",
            "hikae_user_id",
            "hikae_nichiji",
            "sakusei_user_id",
            "created",
            "kousin_user_id",
            "updated",
        ];
        $thisPost = [];
        $chg_flg = 0;
        if ($this->request->getPost("cd") && $jouken_shiire_bunsekis) {
            foreach ($post_flds as $post_fld) {
                if ((array_key_exists($post_fld, $thisPost) ? $thisPost[$post_fld] : $this->request->getPost($post_fld)) !== $jouken_uriage_bunsekis->$post_fld) {
                    $chg_flg = 1;
                    break;
                }
            }
            if ($chg_flg === 0) {
                $this->flash->error("変更がありません。" . $jouken_shiire_bunsekis->id);
                $this->dispatcher->forward(array(
                    "controller" => "jouken_uriage_bunsekis",
                    "action" => "modal",
                    "params" => array($jouken_shiire_bunsekis->id)
                ));
                return;
            }
            $this->_bakOut($jouken_shiire_bunsekis);
        } else {
            $jouken_shiire_bunsekis = new JoukenUriageBunsekis();
            $jouken_shiire_bunsekis->cd = $cd;
        }
        foreach ($post_flds as $post_fld) {
            $jouken_shiire_bunsekis->$post_fld = array_key_exists($post_fld, $thisPost) ? $thisPost[$post_fld] : $this->request->getPost($post_fld);
        }
        if (!$jouken_shiire_bunsekis->save()) {
            foreach ($jouken_shiire_bunsekis->getMessages() as $message) {
                $this->flash->error($message);
            }
            $this->dispatcher->forward(array(
                'controller' => "jouken_shiire_bunsekis",
                'action' => 'modal'
            ));
            return;
        }
        $this->flash->success("条件情報を更新しました。");
        $this->dispatcher->forward(array(
            'controller' => "jouken_shiire_bunsekis",
            'action' => 'modal',
            'params' => array($jouken_shiire_bunsekis->id)
        ));
    }

    /**
     * モーダルDeletes
     */
    public function modaldelAction($cd)
    {
        if (!$cd) {
            $this->flash->error("削除する条件がありません。");

            $this->dispatcher->forward(array(
                'controller' => "jouken_shiire_bunsekis",
                'action' => 'modal'
            ));
            return;
        }
        $jouken_shiire_bunsekis = JoukenShiireBunsekis::findFirst(["conditions" => "cd = ?0 AND sakusei_user_id = ?1"
            , "bind" => [0 => $cd, 1 => $this->getDI()->getSession()->get('auth')['id']]
        ]);
        if (!$jouken_shiire_bunsekis) {
            $this->flash->error("削除する条件が見つかりません。");

            $this->dispatcher->forward(array(
                'controller' => "jouken_uriage_bunsekis",
                'action' => 'modal'
            ));
            return;
        }
        $this->_bakOut($jouken_shiire_bunsekis, 1);
        if (!$jouken_shiire_bunsekis->delete()) {
            foreach ($jouken_shiire_bunsekis->getMessages() as $message) {
                $this->flash->error($message);
            }
            $this->dispatcher->forward(array(
                'controller' => "jouken_shiire_bunsekis",
                'action' => 'modal'
            ));
            return;
        }

        $this->flash->success("条件の削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "jouken_shiire_bunsekis",
            'action' => "modal"
        ));
    }

    /**
     * 条件設定データ
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
        $jouken_shiire_bunsekis = JoukenShiireBunsekis::find(array(
            'order' => 'sakusei_user_id DESC',
            'conditions' => 'cd = ?0 AND sakusei_user_id IN(0, ?1)',
            'bind' => array(0 => $this->request->getPost('cd'), 1 => $this->getDI()->getSession()->get('auth')['id'])
        ));
        $res_flds = [
            "cd",
            "name",
            "junjo_kbn_cd",
            "hanni_from",
            "hanni_to",
            "junjo2_kbn_cd",
            "hanni2_from",
            "hanni2_to",
            "kikan_sitei_kbn_cd",
            "koujun_flg",
            "meisaigyou_flg",
            "goukeigyou_flg",
            "torihikiari_flg",
            "torihikinashi_flg",
        ];
        $resData = array();
        foreach ($jouken_shiire_bunsekis as $jouken_shiire_bunseki) {
            $resAdata = array();
            foreach ($res_flds as $res_fld) {
                $resAdata[$res_fld] = $jouken_shiire_bunseki->$res_fld;
            }
            $resAdata["junjo_kbn_table"] = $jouken_shiire_bunseki->JunjoKbns->table;
            $resData[] = $resAdata;
        }
        $response->setContent(json_encode($resData));
        return $response;
    }
}
