<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class JoukenShiireSuiisController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for jouken_shiire_suiis
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'JoukenShiireSuiis', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = [];
        }
        $parameters["order"] = "id";

        $jouken_shiire_suiis = JoukenShiireSuiis::find($parameters);
        if (count($jouken_shiire_suiis) == 0) {
            $this->flash->notice("The search did not find any jouken_shiire_suiis");

            $this->dispatcher->forward([
                "controller" => "jouken_shiire_suiis",
                "action" => "index"
            ]);

            return;
        }

        $paginator = new Paginator([
            'data' => $jouken_shiire_suiis,
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
     * Edits a jouken_shiire_suii
     *
     * @param string $id
     */
    public function editAction($id)
    {
        if (!$this->request->isPost()) {

            $jouken_shiire_suii = JoukenShiireSuiis::findFirstByid($id);
            if (!$jouken_shiire_suii) {
                $this->flash->error("jouken_shiire_suii was not found");

                $this->dispatcher->forward([
                    'controller' => "jouken_shiire_suiis",
                    'action' => 'index'
                ]);

                return;
            }

            $this->view->id = $jouken_shiire_suii->id;

            $this->tag->setDefault("id", $jouken_shiire_suii->id);
            $this->tag->setDefault("cd", $jouken_shiire_suii->cd);
            $this->tag->setDefault("name", $jouken_shiire_suii->name);
            $this->tag->setDefault("junjo_kbn_cd", $jouken_shiire_suii->junjo_kbn_cd);
            $this->tag->setDefault("koujun_flg", $jouken_shiire_suii->koujun_flg);
            $this->tag->setDefault("hanni_from", $jouken_shiire_suii->hanni_from);
            $this->tag->setDefault("hanni_to", $jouken_shiire_suii->hanni_to);
            $this->tag->setDefault("kikan_sitei_kbn_cd", $jouken_shiire_suii->kikan_sitei_kbn_cd);
            $this->tag->setDefault("kikan_from", $jouken_shiire_suii->kikan_from);
            $this->tag->setDefault("kikan_to", $jouken_shiire_suii->kikan_to);
            $this->tag->setDefault("zeikomi_flg", $jouken_shiire_suii->zeikomi_flg);
            $this->tag->setDefault("meisaigyou_flg", $jouken_shiire_suii->meisaigyou_flg);
            $this->tag->setDefault("goukeigyou_flg", $jouken_shiire_suii->goukeigyou_flg);
            $this->tag->setDefault("torihikiari_flg", $jouken_shiire_suii->torihikiari_flg);
            $this->tag->setDefault("torihikinasi_flg", $jouken_shiire_suii->torihikinasi_flg);
            $this->tag->setDefault("hokakei_flg", $jouken_shiire_suii->hokakei_flg);
            $this->tag->setDefault("zennnen_flg", $jouken_shiire_suii->zennnen_flg);
            $this->tag->setDefault("id_moto", $jouken_shiire_suii->id_moto);
            $this->tag->setDefault("hikae_dltflg", $jouken_shiire_suii->hikae_dltflg);
            $this->tag->setDefault("hikae_user_id", $jouken_shiire_suii->hikae_user_id);
            $this->tag->setDefault("hikae_nichiji", $jouken_shiire_suii->hikae_nichiji);
            $this->tag->setDefault("sakusei_user_id", $jouken_shiire_suii->sakusei_user_id);
            $this->tag->setDefault("created", $jouken_shiire_suii->created);
            $this->tag->setDefault("kousin_user_id", $jouken_shiire_suii->kousin_user_id);
            $this->tag->setDefault("updated", $jouken_shiire_suii->updated);
            
        }
    }

    /**
     * Creates a new jouken_shiire_suii
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "jouken_shiire_suiis",
                'action' => 'index'
            ]);

            return;
        }

        $jouken_shiire_suii = new JoukenShiireSuiis();
        $jouken_shiire_suii->cd = $this->request->getPost("cd");
        $jouken_shiire_suii->name = $this->request->getPost("name");
        $jouken_shiire_suii->junjoKbnCd = $this->request->getPost("junjo_kbn_cd");
        $jouken_shiire_suii->koujunFlg = $this->request->getPost("koujun_flg");
        $jouken_shiire_suii->hanniFrom = $this->request->getPost("hanni_from");
        $jouken_shiire_suii->hanniTo = $this->request->getPost("hanni_to");
        $jouken_shiire_suii->kikanSiteiKbnCd = $this->request->getPost("kikan_sitei_kbn_cd");
        $jouken_shiire_suii->kikanFrom = $this->request->getPost("kikan_from");
        $jouken_shiire_suii->kikanTo = $this->request->getPost("kikan_to");
        $jouken_shiire_suii->zeikomiFlg = $this->request->getPost("zeikomi_flg");
        $jouken_shiire_suii->meisaigyouFlg = $this->request->getPost("meisaigyou_flg");
        $jouken_shiire_suii->goukeigyouFlg = $this->request->getPost("goukeigyou_flg");
        $jouken_shiire_suii->torihikiariFlg = $this->request->getPost("torihikiari_flg");
        $jouken_shiire_suii->torihikinasiFlg = $this->request->getPost("torihikinasi_flg");
        $jouken_shiire_suii->hokakeiFlg = $this->request->getPost("hokakei_flg");
        $jouken_shiire_suii->zennnenFlg = $this->request->getPost("zennnen_flg");
        $jouken_shiire_suii->idMoto = $this->request->getPost("id_moto");
        $jouken_shiire_suii->hikaeDltflg = $this->request->getPost("hikae_dltflg");
        $jouken_shiire_suii->hikaeUserId = $this->request->getPost("hikae_user_id");
        $jouken_shiire_suii->hikaeNichiji = $this->request->getPost("hikae_nichiji");
        $jouken_shiire_suii->sakuseiUserId = $this->request->getPost("sakusei_user_id");
        $jouken_shiire_suii->created = $this->request->getPost("created");
        $jouken_shiire_suii->kousinUserId = $this->request->getPost("kousin_user_id");
        $jouken_shiire_suii->updated = $this->request->getPost("updated");
        

        if (!$jouken_shiire_suii->save()) {
            foreach ($jouken_shiire_suii->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "jouken_shiire_suiis",
                'action' => 'new'
            ]);

            return;
        }

        $this->flash->success("jouken_shiire_suii was created successfully");

        $this->dispatcher->forward([
            'controller' => "jouken_shiire_suiis",
            'action' => 'index'
        ]);
    }

    /**
     * Saves a jouken_shiire_suii edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "jouken_shiire_suiis",
                'action' => 'index'
            ]);

            return;
        }

        $id = $this->request->getPost("id");
        $jouken_shiire_suii = JoukenShiireSuiis::findFirstByid($id);

        if (!$jouken_shiire_suii) {
            $this->flash->error("jouken_shiire_suii does not exist " . $id);

            $this->dispatcher->forward([
                'controller' => "jouken_shiire_suiis",
                'action' => 'index'
            ]);

            return;
        }

        $jouken_shiire_suii->cd = $this->request->getPost("cd");
        $jouken_shiire_suii->name = $this->request->getPost("name");
        $jouken_shiire_suii->junjoKbnCd = $this->request->getPost("junjo_kbn_cd");
        $jouken_shiire_suii->koujunFlg = $this->request->getPost("koujun_flg");
        $jouken_shiire_suii->hanniFrom = $this->request->getPost("hanni_from");
        $jouken_shiire_suii->hanniTo = $this->request->getPost("hanni_to");
        $jouken_shiire_suii->kikanSiteiKbnCd = $this->request->getPost("kikan_sitei_kbn_cd");
        $jouken_shiire_suii->kikanFrom = $this->request->getPost("kikan_from");
        $jouken_shiire_suii->kikanTo = $this->request->getPost("kikan_to");
        $jouken_shiire_suii->zeikomiFlg = $this->request->getPost("zeikomi_flg");
        $jouken_shiire_suii->meisaigyouFlg = $this->request->getPost("meisaigyou_flg");
        $jouken_shiire_suii->goukeigyouFlg = $this->request->getPost("goukeigyou_flg");
        $jouken_shiire_suii->torihikiariFlg = $this->request->getPost("torihikiari_flg");
        $jouken_shiire_suii->torihikinasiFlg = $this->request->getPost("torihikinasi_flg");
        $jouken_shiire_suii->hokakeiFlg = $this->request->getPost("hokakei_flg");
        $jouken_shiire_suii->zennnenFlg = $this->request->getPost("zennnen_flg");
        $jouken_shiire_suii->idMoto = $this->request->getPost("id_moto");
        $jouken_shiire_suii->hikaeDltflg = $this->request->getPost("hikae_dltflg");
        $jouken_shiire_suii->hikaeUserId = $this->request->getPost("hikae_user_id");
        $jouken_shiire_suii->hikaeNichiji = $this->request->getPost("hikae_nichiji");
        $jouken_shiire_suii->sakuseiUserId = $this->request->getPost("sakusei_user_id");
        $jouken_shiire_suii->created = $this->request->getPost("created");
        $jouken_shiire_suii->kousinUserId = $this->request->getPost("kousin_user_id");
        $jouken_shiire_suii->updated = $this->request->getPost("updated");
        

        if (!$jouken_shiire_suii->save()) {

            foreach ($jouken_shiire_suii->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "jouken_shiire_suiis",
                'action' => 'edit',
                'params' => [$jouken_shiire_suii->id]
            ]);

            return;
        }

        $this->flash->success("jouken_shiire_suii was updated successfully");

        $this->dispatcher->forward([
            'controller' => "jouken_shiire_suiis",
            'action' => 'index'
        ]);
    }

    /**
     * Deletes a jouken_shiire_suii
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $jouken_shiire_suii = JoukenShiireSuiis::findFirstByid($id);
        if (!$jouken_shiire_suii) {
            $this->flash->error("jouken_shiire_suii was not found");

            $this->dispatcher->forward([
                'controller' => "jouken_shiire_suiis",
                'action' => 'index'
            ]);

            return;
        }

        if (!$jouken_shiire_suii->delete()) {

            foreach ($jouken_shiire_suii->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "jouken_shiire_suiis",
                'action' => 'search'
            ]);

            return;
        }

        $this->flash->success("jouken_shiire_suii was deleted successfully");

        $this->dispatcher->forward([
            'controller' => "jouken_shiire_suiis",
            'action' => "index"
        ]);
    }
    /**
     * 条件設定モーダル画面
     */
    public function modalAction($id = 0)
    {
        if ($id != 0) {
            $jouken_shiire_suiis = JoukenShiireSuiis::findFirstByid($id);
            if (!$jouken_shiire_suiis) {
                $this->flash->error("条件仕入推移が見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "jouken_shiire_suiis",
                    'action' => 'modal'
                ));

                return;
            }

            $this->_setDefault($jouken_shiire_suiis, "edit");
        }
        $jouken_shiire_suiis = JoukenShiireSuiis::find(["order"=>"cd, sakusei_user_id"
            , "conditions" => "sakusei_user_id IN(0, ?0)"
            , "bind"=>[0=>$this->getDI()->getSession()->get('auth')['id']]
        ]);
        $joukens = [];
        foreach ($jouken_shiire_suiis as $jouken_shiire_suii) {
            $joukens[$jouken_shiire_suii->cd] = $jouken_shiire_suii->name;
        }
        $this->view->joukens = $joukens;
    }
}
