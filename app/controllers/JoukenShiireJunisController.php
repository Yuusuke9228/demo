<?php

use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class JoukenShiireJunisController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for jouken_shiire_junis
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'JoukenShiireJunis', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = [];
        }
        $parameters["order"] = "id";

        $jouken_shiire_junis = JoukenShiireJunis::find($parameters);
        if (count($jouken_shiire_junis) == 0) {
            $this->flash->notice("The search did not find any jouken_shiire_junis");

            $this->dispatcher->forward([
                "controller" => "jouken_shiire_junis",
                "action" => "index"
            ]);

            return;
        }

        $paginator = new Paginator([
            'data' => $jouken_shiire_junis,
            'limit' => 10,
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
     * Edits a jouken_shiire_juni
     *
     * @param string $id
     */
    public function editAction($id)
    {
        if (!$this->request->isPost()) {

            $jouken_shiire_juni = JoukenShiireJunis::findFirstByid($id);
            if (!$jouken_shiire_juni) {
                $this->flash->error("jouken_shiire_juni was not found");

                $this->dispatcher->forward([
                    'controller' => "jouken_shiire_junis",
                    'action' => 'index'
                ]);

                return;
            }

            $this->view->id = $jouken_shiire_juni->id;

            $this->tag->setDefault("id", $jouken_shiire_juni->id);
            $this->tag->setDefault("cd", $jouken_shiire_juni->cd);
            $this->tag->setDefault("name", $jouken_shiire_juni->name);
            $this->tag->setDefault("junjo_kbn_cd", $jouken_shiire_juni->junjo_kbn_cd);
            $this->tag->setDefault("koujun_flg", $jouken_shiire_juni->koujun_flg);
            $this->tag->setDefault("hanni_from", $jouken_shiire_juni->hanni_from);
            $this->tag->setDefault("hanni_to", $jouken_shiire_juni->hanni_to);
            $this->tag->setDefault("kikan_sitei_kbn_cd", $jouken_shiire_juni->kikan_sitei_kbn_cd);
            $this->tag->setDefault("kikan_from", $jouken_shiire_juni->kikan_from);
            $this->tag->setDefault("kikan_to", $jouken_shiire_juni->kikan_to);
            $this->tag->setDefault("zeikomi_flg", $jouken_shiire_juni->zeikomi_flg);
            $this->tag->setDefault("meisaigyou_flg", $jouken_shiire_juni->meisaigyou_flg);
            $this->tag->setDefault("goukeigyou_flg", $jouken_shiire_juni->goukeigyou_flg);
            $this->tag->setDefault("torihikiari_flg", $jouken_shiire_juni->torihikiari_flg);
            $this->tag->setDefault("torihikinasi_flg", $jouken_shiire_juni->torihikinasi_flg);
            $this->tag->setDefault("hokakei_flg", $jouken_shiire_juni->hokakei_flg);
            $this->tag->setDefault("zennnen_flg", $jouken_shiire_juni->zennnen_flg);
            $this->tag->setDefault("id_moto", $jouken_shiire_juni->id_moto);
            $this->tag->setDefault("hikae_dltflg", $jouken_shiire_juni->hikae_dltflg);
            $this->tag->setDefault("hikae_user_id", $jouken_shiire_juni->hikae_user_id);
            $this->tag->setDefault("hikae_nichiji", $jouken_shiire_juni->hikae_nichiji);
            $this->tag->setDefault("sakusei_user_id", $jouken_shiire_juni->sakusei_user_id);
            $this->tag->setDefault("created", $jouken_shiire_juni->created);
            $this->tag->setDefault("kousin_user_id", $jouken_shiire_juni->kousin_user_id);
            $this->tag->setDefault("updated", $jouken_shiire_juni->updated);

        }
    }

    /**
     * Creates a new jouken_shiire_juni
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "jouken_shiire_junis",
                'action' => 'index'
            ]);

            return;
        }

        $jouken_shiire_juni = new JoukenShiireJunis();
        $jouken_shiire_juni->cd = $this->request->getPost("cd");
        $jouken_shiire_juni->name = $this->request->getPost("name");
        $jouken_shiire_juni->junjoKbnCd = $this->request->getPost("junjo_kbn_cd");
        $jouken_shiire_juni->koujunFlg = $this->request->getPost("koujun_flg");
        $jouken_shiire_juni->hanniFrom = $this->request->getPost("hanni_from");
        $jouken_shiire_juni->hanniTo = $this->request->getPost("hanni_to");
        $jouken_shiire_juni->kikanSiteiKbnCd = $this->request->getPost("kikan_sitei_kbn_cd");
        $jouken_shiire_juni->kikanFrom = $this->request->getPost("kikan_from");
        $jouken_shiire_juni->kikanTo = $this->request->getPost("kikan_to");
        $jouken_shiire_juni->zeikomiFlg = $this->request->getPost("zeikomi_flg");
        $jouken_shiire_juni->meisaigyouFlg = $this->request->getPost("meisaigyou_flg");
        $jouken_shiire_juni->goukeigyouFlg = $this->request->getPost("goukeigyou_flg");
        $jouken_shiire_juni->torihikiariFlg = $this->request->getPost("torihikiari_flg");
        $jouken_shiire_juni->torihikinasiFlg = $this->request->getPost("torihikinasi_flg");
        $jouken_shiire_juni->hokakeiFlg = $this->request->getPost("hokakei_flg");
        $jouken_shiire_juni->zennnenFlg = $this->request->getPost("zennnen_flg");
        $jouken_shiire_juni->idMoto = $this->request->getPost("id_moto");
        $jouken_shiire_juni->hikaeDltflg = $this->request->getPost("hikae_dltflg");
        $jouken_shiire_juni->hikaeUserId = $this->request->getPost("hikae_user_id");
        $jouken_shiire_juni->hikaeNichiji = $this->request->getPost("hikae_nichiji");
        $jouken_shiire_juni->sakuseiUserId = $this->request->getPost("sakusei_user_id");
        $jouken_shiire_juni->created = $this->request->getPost("created");
        $jouken_shiire_juni->kousinUserId = $this->request->getPost("kousin_user_id");
        $jouken_shiire_juni->updated = $this->request->getPost("updated");


        if (!$jouken_shiire_juni->save()) {
            foreach ($jouken_shiire_juni->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "jouken_shiire_junis",
                'action' => 'new'
            ]);

            return;
        }

        $this->flash->success("jouken_shiire_juni was created successfully");

        $this->dispatcher->forward([
            'controller' => "jouken_shiire_junis",
            'action' => 'index'
        ]);
    }

    /**
     * Saves a jouken_shiire_juni edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "jouken_shiire_junis",
                'action' => 'index'
            ]);

            return;
        }

        $id = $this->request->getPost("id");
        $jouken_shiire_juni = JoukenShiireJunis::findFirstByid($id);

        if (!$jouken_shiire_juni) {
            $this->flash->error("jouken_shiire_juni does not exist " . $id);

            $this->dispatcher->forward([
                'controller' => "jouken_shiire_junis",
                'action' => 'index'
            ]);

            return;
        }

        $jouken_shiire_juni->cd = $this->request->getPost("cd");
        $jouken_shiire_juni->name = $this->request->getPost("name");
        $jouken_shiire_juni->junjoKbnCd = $this->request->getPost("junjo_kbn_cd");
        $jouken_shiire_juni->koujunFlg = $this->request->getPost("koujun_flg");
        $jouken_shiire_juni->hanniFrom = $this->request->getPost("hanni_from");
        $jouken_shiire_juni->hanniTo = $this->request->getPost("hanni_to");
        $jouken_shiire_juni->kikanSiteiKbnCd = $this->request->getPost("kikan_sitei_kbn_cd");
        $jouken_shiire_juni->kikanFrom = $this->request->getPost("kikan_from");
        $jouken_shiire_juni->kikanTo = $this->request->getPost("kikan_to");
        $jouken_shiire_juni->zeikomiFlg = $this->request->getPost("zeikomi_flg");
        $jouken_shiire_juni->meisaigyouFlg = $this->request->getPost("meisaigyou_flg");
        $jouken_shiire_juni->goukeigyouFlg = $this->request->getPost("goukeigyou_flg");
        $jouken_shiire_juni->torihikiariFlg = $this->request->getPost("torihikiari_flg");
        $jouken_shiire_juni->torihikinasiFlg = $this->request->getPost("torihikinasi_flg");
        $jouken_shiire_juni->hokakeiFlg = $this->request->getPost("hokakei_flg");
        $jouken_shiire_juni->zennnenFlg = $this->request->getPost("zennnen_flg");
        $jouken_shiire_juni->idMoto = $this->request->getPost("id_moto");
        $jouken_shiire_juni->hikaeDltflg = $this->request->getPost("hikae_dltflg");
        $jouken_shiire_juni->hikaeUserId = $this->request->getPost("hikae_user_id");
        $jouken_shiire_juni->hikaeNichiji = $this->request->getPost("hikae_nichiji");
        $jouken_shiire_juni->sakuseiUserId = $this->request->getPost("sakusei_user_id");
        $jouken_shiire_juni->created = $this->request->getPost("created");
        $jouken_shiire_juni->kousinUserId = $this->request->getPost("kousin_user_id");
        $jouken_shiire_juni->updated = $this->request->getPost("updated");


        if (!$jouken_shiire_juni->save()) {

            foreach ($jouken_shiire_juni->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "jouken_shiire_junis",
                'action' => 'edit',
                'params' => [$jouken_shiire_juni->id]
            ]);

            return;
        }

        $this->flash->success("jouken_shiire_juni was updated successfully");

        $this->dispatcher->forward([
            'controller' => "jouken_shiire_junis",
            'action' => 'index'
        ]);
    }

    /**
     * Deletes a jouken_shiire_juni
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $jouken_shiire_juni = JoukenShiireJunis::findFirstByid($id);
        if (!$jouken_shiire_juni) {
            $this->flash->error("jouken_shiire_juni was not found");

            $this->dispatcher->forward([
                'controller' => "jouken_shiire_junis",
                'action' => 'index'
            ]);

            return;
        }

        if (!$jouken_shiire_juni->delete()) {

            foreach ($jouken_shiire_juni->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "jouken_shiire_junis",
                'action' => 'search'
            ]);

            return;
        }

        $this->flash->success("jouken_shiire_juni was deleted successfully");

        $this->dispatcher->forward([
            'controller' => "jouken_shiire_junis",
            'action' => "index"
        ]);
    }

    /**
     * 条件設定モーダル
     */
    public function modalAction($id = 0)
    {
        if ($id != 0) {
            $jouken_shiire_junis = JoukenShiireJunis::findFirstByid($id);
            if (!$jouken_shiire_junis) {
                $this->flash->error("条件が見つからなくなりました。");
                $this->dispatcher->forward(array(
                    'controller' => "jouken_shiire_junis",
                    'action' => 'modal'
                ));
                return;
            }
            $this->_setDefault($jouken_shiire_junis, "edit");
        }
        $jouken_shiire_junis = JoukenShiireJunis::find(["order" => "cd, sakusei_user_id"
            , "conditions" => "sakusei_user_id IN(0, ?0)"
            , "bind" => [0 => $this->getDI()->getSession()->get('auth')['id']]
        ]);
        $joukens = [];
        foreach ($jouken_shiire_junis as $jouken_shiire_juni) {
            $joukens[$jouken_shiire_juni->cd] = $jouken_shiire_juni->name;
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
                'controller' => "jouken_shiire_junis",
                'action' => 'index'
            ));
            return;
        }
        if ($this->request->getPost("cd")) {
            $cd = $this->request->getPost("cd");
            $jouken_shiire_junis = JoukenShiireJunis::findFirst(["conditions" => "cd = ?0 AND sakusei_user_id = ?1"
                , "bind" => [0 => $cd, 1 => $this->getDI()->getSession()->get('auth')['id']]
            ]);
        } else {
            $lastcd = JoukenShiireJunis::findFirst(["order" => "cd DESC"
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
        if ($this->request->getPost("cd") && $jouken_shiire_junis) {
            foreach ($post_flds as $post_fld) {
                if ((array_key_exists($post_fld, $thisPost) ? $thisPost[$post_fld] : $this->request->getPost($post_fld)) !== $jouken_shiire_junis->$post_fld) {
                    $chg_flg = 1;
                    break;
                }
            }
            if ($chg_flg === 0) {
                $this->flash->error("変更がありません。" . $jouken_shiire_junis->$id);
                $this->dispatcher->forward(array(
                    "controller" => "jouken_shiire_junis",
                    "action" => "modal",
                    "params" => array($jouken_shiire_junis->id)
                ));
                return;
            }
            $this->_bakOut($jouken_shiire_junis);
        } else {
            $jouken_shiire_junis = new JoukenShiireJunis();
            $jouken_shiire_junis->cd = $cd;
        }
        foreach ($post_flds as $post_fld) {
            $jouken_shiire_junis->$post_fld = array_key_exists($post_fld, $thisPost) ? $thisPost[$post_fld] : $this->request->getPost($post_fld);
        }
        if (!$jouken_shiire_junis->save()) {
            foreach ($jouken_shiire_junis->getMessages() as $message) {
                $this->flash->error($message);
            }
            $this->dispatcher->forward(array(
                'controller' => "jouken_shiire_junis",
                'action' => 'modal'
            ));
            return;
        }
        $this->flash->success("条件を更新しました。");
        $this->dispatcher->forward(array(
            'controller' => "jouken_shiire_junis",
            'action' => 'modal',
            'params' => array($jouken_shiire_junis->id)
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
                'controller' => "jouken_shiire_junis",
                'action' => 'modal'
            ));
            return;
        }
        $jouken_shiire_junis = JoukenShiireJunis::findFirst(["conditions" => "cd = ?0 AND sakusei_user_id = ?1"
            , "bind" => [0 => $cd, 1 => $this->getDI()->getSession()->get('auth')['id']]
        ]);
        if (!$jouken_shiire_junis) {
            $this->flash->error("削除する条件が見つかりません。");

            $this->dispatcher->forward(array(
                'controller' => "jouken_shiire_junis",
                'action' => 'modal'
            ));
            return;
        }
        $this->_bakOut($jouken_shiire_junis, 1);
        if (!$jouken_shiire_junis->delete()) {
            foreach ($jouken_shiire_junis->getMessages() as $message) {
                $this->flash->error($message);
            }
            $this->dispatcher->forward(array(
                'controller' => "jouken_shiire_junis",
                'action' => 'modal'
            ));
            return;
        }
        $this->flash->success("条件の削除を完了しました。");
        $this->dispatcher->forward(array(
            'controller' => "jouken_shiire_junis",
            'action' => "modal"
        ));
    }

    /**
     * 条件設定データ呼び出し
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
        $jouken_shiire_junis = JoukenShiireJunis::find(array(
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
            "zennnen_flg",
        ];
        $resData = array();
        foreach ($jouken_shiire_junis as $jouken_shiire_juni) {
            $resAdata = array();
            foreach ($res_flds as $res_fld) {
                $resAdata[$res_fld] = $jouken_shiire_juni->$res_fld;
            }
            $resAdata["junjo_kbn_table"] = $jouken_shiire_juni->JunjoKbns->table;
            $resData[] = $resAdata;
        }
        $response->setContent(json_encode($resData));
        return $response;
    }
}
