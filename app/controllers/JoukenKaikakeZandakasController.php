<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class JoukenKaikakeZandakasController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for jouken_kaikake_zandakas
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'JoukenKaikakeZandakas', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = [];
        }
        $parameters["order"] = "id";

        $jouken_kaikake_zandakas = JoukenKaikakeZandakas::find($parameters);
        if (count($jouken_kaikake_zandakas) == 0) {
            $this->flash->notice("The search did not find any jouken_kaikake_zandakas");

            $this->dispatcher->forward([
                "controller" => "jouken_kaikake_zandakas",
                "action" => "index"
            ]);

            return;
        }

        $paginator = new Paginator([
            'data' => $jouken_kaikake_zandakas,
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
     * Edits a jouken_kaikake_zandaka
     *
     * @param string $id
     */
    public function editAction($id)
    {
        if (!$this->request->isPost()) {

            $jouken_kaikake_zandaka = JoukenKaikakeZandakas::findFirstByid($id);
            if (!$jouken_kaikake_zandaka) {
                $this->flash->error("jouken_kaikake_zandaka was not found");

                $this->dispatcher->forward([
                    'controller' => "jouken_kaikake_zandakas",
                    'action' => 'index'
                ]);

                return;
            }

            $this->view->id = $jouken_kaikake_zandaka->id;

            $this->tag->setDefault("id", $jouken_kaikake_zandaka->id);
            $this->tag->setDefault("cd", $jouken_kaikake_zandaka->cd);
            $this->tag->setDefault("name", $jouken_kaikake_zandaka->name);
            $this->tag->setDefault("junjo_kbn_cd", $jouken_kaikake_zandaka->junjo_kbn_cd);
            $this->tag->setDefault("koujun_flg", $jouken_kaikake_zandaka->koujun_flg);
            $this->tag->setDefault("hanni_from", $jouken_kaikake_zandaka->hanni_from);
            $this->tag->setDefault("hanni_to", $jouken_kaikake_zandaka->hanni_to);
            $this->tag->setDefault("kikan_sitei_kbn_cd", $jouken_kaikake_zandaka->kikan_sitei_kbn_cd);
            $this->tag->setDefault("kikan_from", $jouken_kaikake_zandaka->kikan_from);
            $this->tag->setDefault("kikan_to", $jouken_kaikake_zandaka->kikan_to);
            $this->tag->setDefault("zeikomi_flg", $jouken_kaikake_zandaka->zeikomi_flg);
            $this->tag->setDefault("meisaigyou_flg", $jouken_kaikake_zandaka->meisaigyou_flg);
            $this->tag->setDefault("goukeigyou_flg", $jouken_kaikake_zandaka->goukeigyou_flg);
            $this->tag->setDefault("torihikiari_flg", $jouken_kaikake_zandaka->torihikiari_flg);
            $this->tag->setDefault("torihikinasi_flg", $jouken_kaikake_zandaka->torihikinasi_flg);
            $this->tag->setDefault("hokakei_flg", $jouken_kaikake_zandaka->hokakei_flg);
            $this->tag->setDefault("zennnen_flg", $jouken_kaikake_zandaka->zennnen_flg);
            $this->tag->setDefault("id_moto", $jouken_kaikake_zandaka->id_moto);
            $this->tag->setDefault("hikae_dltflg", $jouken_kaikake_zandaka->hikae_dltflg);
            $this->tag->setDefault("hikae_user_id", $jouken_kaikake_zandaka->hikae_user_id);
            $this->tag->setDefault("hikae_nichiji", $jouken_kaikake_zandaka->hikae_nichiji);
            $this->tag->setDefault("sakusei_user_id", $jouken_kaikake_zandaka->sakusei_user_id);
            $this->tag->setDefault("created", $jouken_kaikake_zandaka->created);
            $this->tag->setDefault("kousin_user_id", $jouken_kaikake_zandaka->kousin_user_id);
            $this->tag->setDefault("updated", $jouken_kaikake_zandaka->updated);
            
        }
    }

    /**
     * Creates a new jouken_kaikake_zandaka
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "jouken_kaikake_zandakas",
                'action' => 'index'
            ]);

            return;
        }

        $jouken_kaikake_zandaka = new JoukenKaikakeZandakas();
        $jouken_kaikake_zandaka->cd = $this->request->getPost("cd");
        $jouken_kaikake_zandaka->name = $this->request->getPost("name");
        $jouken_kaikake_zandaka->junjoKbnCd = $this->request->getPost("junjo_kbn_cd");
        $jouken_kaikake_zandaka->koujunFlg = $this->request->getPost("koujun_flg");
        $jouken_kaikake_zandaka->hanniFrom = $this->request->getPost("hanni_from");
        $jouken_kaikake_zandaka->hanniTo = $this->request->getPost("hanni_to");
        $jouken_kaikake_zandaka->kikanSiteiKbnCd = $this->request->getPost("kikan_sitei_kbn_cd");
        $jouken_kaikake_zandaka->kikanFrom = $this->request->getPost("kikan_from");
        $jouken_kaikake_zandaka->kikanTo = $this->request->getPost("kikan_to");
        $jouken_kaikake_zandaka->zeikomiFlg = $this->request->getPost("zeikomi_flg");
        $jouken_kaikake_zandaka->meisaigyouFlg = $this->request->getPost("meisaigyou_flg");
        $jouken_kaikake_zandaka->goukeigyouFlg = $this->request->getPost("goukeigyou_flg");
        $jouken_kaikake_zandaka->torihikiariFlg = $this->request->getPost("torihikiari_flg");
        $jouken_kaikake_zandaka->torihikinasiFlg = $this->request->getPost("torihikinasi_flg");
        $jouken_kaikake_zandaka->hokakeiFlg = $this->request->getPost("hokakei_flg");
        $jouken_kaikake_zandaka->zennnenFlg = $this->request->getPost("zennnen_flg");
        $jouken_kaikake_zandaka->idMoto = $this->request->getPost("id_moto");
        $jouken_kaikake_zandaka->hikaeDltflg = $this->request->getPost("hikae_dltflg");
        $jouken_kaikake_zandaka->hikaeUserId = $this->request->getPost("hikae_user_id");
        $jouken_kaikake_zandaka->hikaeNichiji = $this->request->getPost("hikae_nichiji");
        $jouken_kaikake_zandaka->sakuseiUserId = $this->request->getPost("sakusei_user_id");
        $jouken_kaikake_zandaka->created = $this->request->getPost("created");
        $jouken_kaikake_zandaka->kousinUserId = $this->request->getPost("kousin_user_id");
        $jouken_kaikake_zandaka->updated = $this->request->getPost("updated");
        

        if (!$jouken_kaikake_zandaka->save()) {
            foreach ($jouken_kaikake_zandaka->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "jouken_kaikake_zandakas",
                'action' => 'new'
            ]);

            return;
        }

        $this->flash->success("jouken_kaikake_zandaka was created successfully");

        $this->dispatcher->forward([
            'controller' => "jouken_kaikake_zandakas",
            'action' => 'index'
        ]);
    }

    /**
     * Saves a jouken_kaikake_zandaka edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "jouken_kaikake_zandakas",
                'action' => 'index'
            ]);

            return;
        }

        $id = $this->request->getPost("id");
        $jouken_kaikake_zandaka = JoukenKaikakeZandakas::findFirstByid($id);

        if (!$jouken_kaikake_zandaka) {
            $this->flash->error("jouken_kaikake_zandaka does not exist " . $id);

            $this->dispatcher->forward([
                'controller' => "jouken_kaikake_zandakas",
                'action' => 'index'
            ]);

            return;
        }

        $jouken_kaikake_zandaka->cd = $this->request->getPost("cd");
        $jouken_kaikake_zandaka->name = $this->request->getPost("name");
        $jouken_kaikake_zandaka->junjoKbnCd = $this->request->getPost("junjo_kbn_cd");
        $jouken_kaikake_zandaka->koujunFlg = $this->request->getPost("koujun_flg");
        $jouken_kaikake_zandaka->hanniFrom = $this->request->getPost("hanni_from");
        $jouken_kaikake_zandaka->hanniTo = $this->request->getPost("hanni_to");
        $jouken_kaikake_zandaka->kikanSiteiKbnCd = $this->request->getPost("kikan_sitei_kbn_cd");
        $jouken_kaikake_zandaka->kikanFrom = $this->request->getPost("kikan_from");
        $jouken_kaikake_zandaka->kikanTo = $this->request->getPost("kikan_to");
        $jouken_kaikake_zandaka->zeikomiFlg = $this->request->getPost("zeikomi_flg");
        $jouken_kaikake_zandaka->meisaigyouFlg = $this->request->getPost("meisaigyou_flg");
        $jouken_kaikake_zandaka->goukeigyouFlg = $this->request->getPost("goukeigyou_flg");
        $jouken_kaikake_zandaka->torihikiariFlg = $this->request->getPost("torihikiari_flg");
        $jouken_kaikake_zandaka->torihikinasiFlg = $this->request->getPost("torihikinasi_flg");
        $jouken_kaikake_zandaka->hokakeiFlg = $this->request->getPost("hokakei_flg");
        $jouken_kaikake_zandaka->zennnenFlg = $this->request->getPost("zennnen_flg");
        $jouken_kaikake_zandaka->idMoto = $this->request->getPost("id_moto");
        $jouken_kaikake_zandaka->hikaeDltflg = $this->request->getPost("hikae_dltflg");
        $jouken_kaikake_zandaka->hikaeUserId = $this->request->getPost("hikae_user_id");
        $jouken_kaikake_zandaka->hikaeNichiji = $this->request->getPost("hikae_nichiji");
        $jouken_kaikake_zandaka->sakuseiUserId = $this->request->getPost("sakusei_user_id");
        $jouken_kaikake_zandaka->created = $this->request->getPost("created");
        $jouken_kaikake_zandaka->kousinUserId = $this->request->getPost("kousin_user_id");
        $jouken_kaikake_zandaka->updated = $this->request->getPost("updated");
        

        if (!$jouken_kaikake_zandaka->save()) {

            foreach ($jouken_kaikake_zandaka->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "jouken_kaikake_zandakas",
                'action' => 'edit',
                'params' => [$jouken_kaikake_zandaka->id]
            ]);

            return;
        }

        $this->flash->success("jouken_kaikake_zandaka was updated successfully");

        $this->dispatcher->forward([
            'controller' => "jouken_kaikake_zandakas",
            'action' => 'index'
        ]);
    }

    /**
     * Deletes a jouken_kaikake_zandaka
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $jouken_kaikake_zandaka = JoukenKaikakeZandakas::findFirstByid($id);
        if (!$jouken_kaikake_zandaka) {
            $this->flash->error("jouken_kaikake_zandaka was not found");

            $this->dispatcher->forward([
                'controller' => "jouken_kaikake_zandakas",
                'action' => 'index'
            ]);

            return;
        }

        if (!$jouken_kaikake_zandaka->delete()) {

            foreach ($jouken_kaikake_zandaka->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "jouken_kaikake_zandakas",
                'action' => 'search'
            ]);

            return;
        }

        $this->flash->success("jouken_kaikake_zandaka was deleted successfully");

        $this->dispatcher->forward([
            'controller' => "jouken_kaikake_zandakas",
            'action' => "index"
        ]);
    }

    /**
     * 条件設定モーダル
     */
    public function modalAction($id = 0)
    {
        if ($id != 0) {
            $jouken_kaikake_zandakas = JoukenKaikakeZandakas::findFirstByid($id);
            if (!$jouken_kaikake_zandakas) {
                $this->flash->error("条件が見つからなくなりました。");
                $this->dispatcher->forward(array(
                    'controller' => "jouken_kaikake_zandakas",
                    'action' => 'modal'
                ));
                return;
            }
            $this->_setDefault($jouken_kaikake_zandakas, "edit");
        }
        $jouken_kaikake_zandakas = JoukenKaikakeZandakas::find(["order" => "cd, sakusei_user_id"
            , "conditions" => "sakusei_user_id IN(0, ?0)"
            , "bind" => [0 => $this->getDI()->getSession()->get('auth')['id']]
        ]);
        $joukens = [];
        foreach ($jouken_kaikake_zandakas as $jouken_kaikake_zandaka) {
            $joukens[$jouken_kaikake_zandaka->cd] = $jouken_kaikake_zandaka->name;
        }
        $this->view->joukens = $joukens;
    }

    /**
     * モーダルからSave
     *
     */
    public function modalsaveAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "jouken_kaikake_zandakas",
                'action' => 'index'
            ));
            return;
        }
        if ($this->request->getPost("cd")) {
            $cd = $this->request->getPost("cd");
            $jouken_kaikake_zandakas = JoukenKaikakeZandakas::findFirst(["conditions" => "cd = ?0 AND sakusei_user_id = ?1"
                , "bind" => [0 => $cd, 1 => $this->getDI()->getSession()->get('auth')['id']]
            ]);
        } else {
            $lastcd = JoukenKaikakeZandakas::findFirst(["order" => "cd DESC"
                , "conditions" => "sakusei_user_id IN(0, ?0)"
                , "bind" => [0 => $this->getDI()->getSession()->get('auth')['id']]
            ]);
            $cd = "" . ((int)$lastcd->cd + 1);
        }
        $post_flds = [];
        $post_flds = [
            "name",
            "junjo_kbn_cd",
            "koujun_flg",
            "hanni_from",
            "hanni_to",
            "kikan_sitei_kbn_cd",
            "kikan_from",
            "kikan_to",
            "zeikomi_flg",
            "meisaigyou_flg",
            "goukeigyou_flg",
            "torihikiari_flg",
            "torihikinasi_flg",
            "hokakei_flg",
            "zennnen_flg",
            "updated",
        ];
        $thisPost = [];
        $chg_flg = 0;
        if ($this->request->getPost("cd") && $jouken_kaikake_zandakas) {
            foreach ($post_flds as $post_fld) {
                if ((array_key_exists($post_fld, $thisPost) ? $thisPost[$post_fld] : $this->request->getPost($post_fld)) !== $jouken_kaikake_zandakas->$post_fld) {
                    $chg_flg = 1;
                    break;
                }
            }
            if ($chg_flg === 0) {
                $this->flash->error("変更がありません。" . $jouken_kaikake_zandakas->id);
                $this->dispatcher->forward(array(
                    "controller" => "jouken_uriage_suiiss",
                    "action" => "modal",
                    "params" => array($jouken_kaikake_zandakas->id)
                ));
                return;
            }
            $this->_bakOut($jouken_kaikake_zandakas);
        } else {
            $jouken_kaikake_zandakas = new JoukenKaikakeZandakas();
            $jouken_kaikake_zandakas->cd = $cd;
        }
        foreach ($post_flds as $post_fld) {
            $jouken_kaikake_zandakas->$post_fld = array_key_exists($post_fld, $thisPost) ? $thisPost[$post_fld] : $this->request->getPost($post_fld);
        }
        if (!$jouken_kaikake_zandakas->save()) {
            foreach ($jouken_kaikake_zandakas->getMessages() as $message) {
                $this->flash->error($message);
            }
            $this->dispatcher->forward(array(
                'controller' => "jouken_kaikake_zandakas",
                'action' => 'modal'
            ));
            return;
        }
        $this->flash->success("条件の情報を更新しました");
        $this->dispatcher->forward(array(
            'controller' => "jouken_kaikake_zandakas",
            'action' => 'modal',
            'params' => array($jouken_kaikake_zandakas->id)
        ));
    }

    /**
     * モーダルDelete
     */
    public function modaldelAction($cd)
    {
        if (!$cd) {
            $this->flash->error("削除する条件がありません。");
            $this->dispatcher->forward(array(
                'controller' => "jouken_kaikake_zandakas",
                'action' => 'modal'
            ));
            return;
        }
        $jouken_kaikake_zandakas = JoukenKaikakeZandakas::findFirst(["conditions" => "cd = ?0 AND sakusei_user_id = ?1"
            , "bind" => [0 => $cd, 1 => $this->getDI()->getSession()->get('auth')['id']]
        ]);
        if (!$jouken_kaikake_zandakas) {
            $this->flash->error("削除する条件が見つかりません。");
            $this->dispatcher->forward(array(
                'controller' => "jouken_kaikake_zandakas",
                'action' => 'modal'
            ));
            return;
        }
        $this->_bakOut($jouken_kaikake_zandakas, 1);
        if (!$jouken_kaikake_zandakas->delete()) {
            foreach ($jouken_kaikake_zandakas->getMessages() as $message) {
                $this->flash->error($message);
            }
            $this->dispatcher->forward(array(
                'controller' => "jouken_kaikake_zandakas",
                'action' => 'modal'
            ));
            return;
        }
        $this->flash->success("条件の削除を完了しました。");
        $this->dispatcher->forward(array(
            'controller' => "jouken_kaikake_zandakas",
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
        $jouken_kaikake_zandakas = JoukenKaikakeZandakas::find(array(
            'order' => 'sakusei_user_id DESC',
            'conditions' => 'cd = ?0 AND sakusei_user_id IN(0, ?1)',
            'bind' => array(0 => $this->request->getPost('cd'), 1 => $this->getDI()->getSession()->get('auth')['id'])
        ));
        $res_flds = [
            "cd",
            "name",
            "junjo_kbn_cd",
            "koujun_flg",
            "hanni_from",
            "hanni_to",
            "kikan_sitei_kbn_cd",
            "kikan_from",
            "kikan_to",
            "zeikomi_flg",
            "meisaigyou_flg",
            "goukeigyou_flg",
            "torihikiari_flg",
            "torihikinasi_flg",
            "hokakei_flg",
        ];
        $resData = array();
        foreach ($jouken_kaikake_zandakas as $jouken_kaikake_zandaka) {
            $resAdata = array();
            foreach ($res_flds as $res_fld) {
                $resAdata[$res_fld] = $jouken_kaikake_zandaka->$res_fld;
            }
            $resAdata["junjo_kbn_table"] = $jouken_kaikake_zandaka->JunjoKbns->table;
            $resData[] = $resAdata;
        }
        $response->setContent(json_encode($resData));
        return $response;
    }
}
