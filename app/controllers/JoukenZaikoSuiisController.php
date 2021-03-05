<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class JoukenZaikoSuiisController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for jouken_zaiko_suiis
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'JoukenZaikoSuiis', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = [];
        }
        $parameters["order"] = "id";

        $jouken_zaiko_suiis = JoukenZaikoSuiis::find($parameters);
        if (count($jouken_zaiko_suiis) == 0) {
            $this->flash->notice("The search did not find any jouken_zaiko_suiis");

            $this->dispatcher->forward([
                "controller" => "jouken_zaiko_suiis",
                "action" => "index"
            ]);

            return;
        }

        $paginator = new Paginator([
            'data' => $jouken_zaiko_suiis,
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
     * Edits a jouken_zaiko_suii
     *
     * @param string $id
     */
    public function editAction($id)
    {
        if (!$this->request->isPost()) {

            $jouken_zaiko_suii = JoukenZaikoSuiis::findFirstByid($id);
            if (!$jouken_zaiko_suii) {
                $this->flash->error("jouken_zaiko_suii was not found");

                $this->dispatcher->forward([
                    'controller' => "jouken_zaiko_suiis",
                    'action' => 'index'
                ]);

                return;
            }

            $this->view->id = $jouken_zaiko_suii->id;

            $this->tag->setDefault("id", $jouken_zaiko_suii->id);
            $this->tag->setDefault("cd", $jouken_zaiko_suii->cd);
            $this->tag->setDefault("name", $jouken_zaiko_suii->name);
            $this->tag->setDefault("junjo_kbn_cd", $jouken_zaiko_suii->junjo_kbn_cd);
            $this->tag->setDefault("koujun_flg", $jouken_zaiko_suii->koujun_flg);
            $this->tag->setDefault("hanni_from", $jouken_zaiko_suii->hanni_from);
            $this->tag->setDefault("hanni_to", $jouken_zaiko_suii->hanni_to);
            $this->tag->setDefault("kikan_sitei_kbn_cd", $jouken_zaiko_suii->kikan_sitei_kbn_cd);
            $this->tag->setDefault("kikan_from", $jouken_zaiko_suii->kikan_from);
            $this->tag->setDefault("kikan_to", $jouken_zaiko_suii->kikan_to);
            $this->tag->setDefault("zeikomi_flg", $jouken_zaiko_suii->zeikomi_flg);
            $this->tag->setDefault("meisaigyou_flg", $jouken_zaiko_suii->meisaigyou_flg);
            $this->tag->setDefault("goukeigyou_flg", $jouken_zaiko_suii->goukeigyou_flg);
            $this->tag->setDefault("torihikiari_flg", $jouken_zaiko_suii->torihikiari_flg);
            $this->tag->setDefault("torihikinasi_flg", $jouken_zaiko_suii->torihikinasi_flg);
            $this->tag->setDefault("hokakei_flg", $jouken_zaiko_suii->hokakei_flg);
            $this->tag->setDefault("zennnen_flg", $jouken_zaiko_suii->zennnen_flg);
            $this->tag->setDefault("id_moto", $jouken_zaiko_suii->id_moto);
            $this->tag->setDefault("hikae_dltflg", $jouken_zaiko_suii->hikae_dltflg);
            $this->tag->setDefault("hikae_user_id", $jouken_zaiko_suii->hikae_user_id);
            $this->tag->setDefault("hikae_nichiji", $jouken_zaiko_suii->hikae_nichiji);
            $this->tag->setDefault("sakusei_user_id", $jouken_zaiko_suii->sakusei_user_id);
            $this->tag->setDefault("created", $jouken_zaiko_suii->created);
            $this->tag->setDefault("kousin_user_id", $jouken_zaiko_suii->kousin_user_id);
            $this->tag->setDefault("updated", $jouken_zaiko_suii->updated);
            
        }
    }

    /**
     * Creates a new jouken_zaiko_suii
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "jouken_zaiko_suiis",
                'action' => 'index'
            ]);

            return;
        }

        $jouken_zaiko_suii = new JoukenZaikoSuiis();
        $jouken_zaiko_suii->cd = $this->request->getPost("cd");
        $jouken_zaiko_suii->name = $this->request->getPost("name");
        $jouken_zaiko_suii->junjoKbnCd = $this->request->getPost("junjo_kbn_cd");
        $jouken_zaiko_suii->koujunFlg = $this->request->getPost("koujun_flg");
        $jouken_zaiko_suii->hanniFrom = $this->request->getPost("hanni_from");
        $jouken_zaiko_suii->hanniTo = $this->request->getPost("hanni_to");
        $jouken_zaiko_suii->kikanSiteiKbnCd = $this->request->getPost("kikan_sitei_kbn_cd");
        $jouken_zaiko_suii->kikanFrom = $this->request->getPost("kikan_from");
        $jouken_zaiko_suii->kikanTo = $this->request->getPost("kikan_to");
        $jouken_zaiko_suii->zeikomiFlg = $this->request->getPost("zeikomi_flg");
        $jouken_zaiko_suii->meisaigyouFlg = $this->request->getPost("meisaigyou_flg");
        $jouken_zaiko_suii->goukeigyouFlg = $this->request->getPost("goukeigyou_flg");
        $jouken_zaiko_suii->torihikiariFlg = $this->request->getPost("torihikiari_flg");
        $jouken_zaiko_suii->torihikinasiFlg = $this->request->getPost("torihikinasi_flg");
        $jouken_zaiko_suii->hokakeiFlg = $this->request->getPost("hokakei_flg");
        $jouken_zaiko_suii->zennnenFlg = $this->request->getPost("zennnen_flg");
        $jouken_zaiko_suii->idMoto = $this->request->getPost("id_moto");
        $jouken_zaiko_suii->hikaeDltflg = $this->request->getPost("hikae_dltflg");
        $jouken_zaiko_suii->hikaeUserId = $this->request->getPost("hikae_user_id");
        $jouken_zaiko_suii->hikaeNichiji = $this->request->getPost("hikae_nichiji");
        $jouken_zaiko_suii->sakuseiUserId = $this->request->getPost("sakusei_user_id");
        $jouken_zaiko_suii->created = $this->request->getPost("created");
        $jouken_zaiko_suii->kousinUserId = $this->request->getPost("kousin_user_id");
        $jouken_zaiko_suii->updated = $this->request->getPost("updated");
        

        if (!$jouken_zaiko_suii->save()) {
            foreach ($jouken_zaiko_suii->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "jouken_zaiko_suiis",
                'action' => 'new'
            ]);

            return;
        }

        $this->flash->success("jouken_zaiko_suii was created successfully");

        $this->dispatcher->forward([
            'controller' => "jouken_zaiko_suiis",
            'action' => 'index'
        ]);
    }

    /**
     * Saves a jouken_zaiko_suii edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "jouken_zaiko_suiis",
                'action' => 'index'
            ]);

            return;
        }

        $id = $this->request->getPost("id");
        $jouken_zaiko_suii = JoukenZaikoSuiis::findFirstByid($id);

        if (!$jouken_zaiko_suii) {
            $this->flash->error("jouken_zaiko_suii does not exist " . $id);

            $this->dispatcher->forward([
                'controller' => "jouken_zaiko_suiis",
                'action' => 'index'
            ]);

            return;
        }

        $jouken_zaiko_suii->cd = $this->request->getPost("cd");
        $jouken_zaiko_suii->name = $this->request->getPost("name");
        $jouken_zaiko_suii->junjoKbnCd = $this->request->getPost("junjo_kbn_cd");
        $jouken_zaiko_suii->koujunFlg = $this->request->getPost("koujun_flg");
        $jouken_zaiko_suii->hanniFrom = $this->request->getPost("hanni_from");
        $jouken_zaiko_suii->hanniTo = $this->request->getPost("hanni_to");
        $jouken_zaiko_suii->kikanSiteiKbnCd = $this->request->getPost("kikan_sitei_kbn_cd");
        $jouken_zaiko_suii->kikanFrom = $this->request->getPost("kikan_from");
        $jouken_zaiko_suii->kikanTo = $this->request->getPost("kikan_to");
        $jouken_zaiko_suii->zeikomiFlg = $this->request->getPost("zeikomi_flg");
        $jouken_zaiko_suii->meisaigyouFlg = $this->request->getPost("meisaigyou_flg");
        $jouken_zaiko_suii->goukeigyouFlg = $this->request->getPost("goukeigyou_flg");
        $jouken_zaiko_suii->torihikiariFlg = $this->request->getPost("torihikiari_flg");
        $jouken_zaiko_suii->torihikinasiFlg = $this->request->getPost("torihikinasi_flg");
        $jouken_zaiko_suii->hokakeiFlg = $this->request->getPost("hokakei_flg");
        $jouken_zaiko_suii->zennnenFlg = $this->request->getPost("zennnen_flg");
        $jouken_zaiko_suii->idMoto = $this->request->getPost("id_moto");
        $jouken_zaiko_suii->hikaeDltflg = $this->request->getPost("hikae_dltflg");
        $jouken_zaiko_suii->hikaeUserId = $this->request->getPost("hikae_user_id");
        $jouken_zaiko_suii->hikaeNichiji = $this->request->getPost("hikae_nichiji");
        $jouken_zaiko_suii->sakuseiUserId = $this->request->getPost("sakusei_user_id");
        $jouken_zaiko_suii->created = $this->request->getPost("created");
        $jouken_zaiko_suii->kousinUserId = $this->request->getPost("kousin_user_id");
        $jouken_zaiko_suii->updated = $this->request->getPost("updated");
        

        if (!$jouken_zaiko_suii->save()) {

            foreach ($jouken_zaiko_suii->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "jouken_zaiko_suiis",
                'action' => 'edit',
                'params' => [$jouken_zaiko_suii->id]
            ]);

            return;
        }

        $this->flash->success("jouken_zaiko_suii was updated successfully");

        $this->dispatcher->forward([
            'controller' => "jouken_zaiko_suiis",
            'action' => 'index'
        ]);
    }

    /**
     * Deletes a jouken_zaiko_suii
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $jouken_zaiko_suii = JoukenZaikoSuiis::findFirstByid($id);
        if (!$jouken_zaiko_suii) {
            $this->flash->error("jouken_zaiko_suii was not found");

            $this->dispatcher->forward([
                'controller' => "jouken_zaiko_suiis",
                'action' => 'index'
            ]);

            return;
        }

        if (!$jouken_zaiko_suii->delete()) {

            foreach ($jouken_zaiko_suii->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "jouken_zaiko_suiis",
                'action' => 'search'
            ]);

            return;
        }

        $this->flash->success("jouken_zaiko_suii was deleted successfully");

        $this->dispatcher->forward([
            'controller' => "jouken_zaiko_suiis",
            'action' => "index"
        ]);
    }

}
