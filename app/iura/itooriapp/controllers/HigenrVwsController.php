<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class HigenrVwsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for higenr_vws
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'HigenrVws', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = [];
        }
        $parameters["order"] = "sasizu_no";

        $higenr_vws = HigenrVws::find($parameters);
        if (count($higenr_vws) == 0) {
            $this->flash->notice("The search did not find any higenr_vws");

            $this->dispatcher->forward([
                "controller" => "higenr_vws",
                "action" => "index"
            ]);

            return;
        }

        $paginator = new Paginator([
            'data' => $higenr_vws,
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
     * Edits a higenr_vw
     *
     * @param string $sasizu_no
     */
    public function editAction($sasizu_no)
    {
        if (!$this->request->isPost()) {

            $higenr_vw = HigenrVws::findFirstBysasizu_no($sasizu_no);
            if (!$higenr_vw) {
                $this->flash->error("higenr_vw was not found");

                $this->dispatcher->forward([
                    'controller' => "higenr_vws",
                    'action' => 'index'
                ]);

                return;
            }

            $this->view->sasizu_no = $higenr_vw->sasizu_no;

            $this->tag->setDefault("sasizu_no", $higenr_vw->sasizu_no);
            $this->tag->setDefault("genryou_jun", $higenr_vw->genryou_jun);
            $this->tag->setDefault("itoshu", $higenr_vw->itoshu);
            $this->tag->setDefault("itocode", $higenr_vw->itocode);
            $this->tag->setDefault("gentanni", $higenr_vw->gentanni);
            $this->tag->setDefault("chokuyori_kbn", $higenr_vw->chokuyori_kbn);
            $this->tag->setDefault("chokuyori_sasizu_no", $higenr_vw->chokuyori_sasizu_no);
            $this->tag->setDefault("ukeire_sasizu", $higenr_vw->ukeire_sasizu);
            $this->tag->setDefault("ukeire_zumi", $higenr_vw->ukeire_zumi);
            $this->tag->setDefault("free_ukeire_sasizu", $higenr_vw->free_ukeire_sasizu);
            $this->tag->setDefault("free_ukeire_zumi", $higenr_vw->free_ukeire_zumi);
            $this->tag->setDefault("shouhi_chousei_sasizu", $higenr_vw->shouhi_chousei_sasizu);
            $this->tag->setDefault("shouhi_chousei_zumi", $higenr_vw->shouhi_chousei_zumi);
            $this->tag->setDefault("shouhi_zumi", $higenr_vw->shouhi_zumi);
            $this->tag->setDefault("kanryou_kbn", $higenr_vw->kanryou_kbn);
            $this->tag->setDefault("kuuhaku", $higenr_vw->kuuhaku);
            
        }
    }

    /**
     * Creates a new higenr_vw
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "higenr_vws",
                'action' => 'index'
            ]);

            return;
        }

        $higenr_vw = new HigenrVws();
        $higenr_vw->Sasizu_no = $this->request->getPost("sasizu_no");
        $higenr_vw->Genryou_jun = $this->request->getPost("genryou_jun");
        $higenr_vw->Itoshu = $this->request->getPost("itoshu");
        $higenr_vw->Itocode = $this->request->getPost("itocode");
        $higenr_vw->Gentanni = $this->request->getPost("gentanni");
        $higenr_vw->Chokuyori_kbn = $this->request->getPost("chokuyori_kbn");
        $higenr_vw->Chokuyori_sasizu_no = $this->request->getPost("chokuyori_sasizu_no");
        $higenr_vw->Ukeire_sasizu = $this->request->getPost("ukeire_sasizu");
        $higenr_vw->Ukeire_zumi = $this->request->getPost("ukeire_zumi");
        $higenr_vw->Free_ukeire_sasizu = $this->request->getPost("free_ukeire_sasizu");
        $higenr_vw->Free_ukeire_zumi = $this->request->getPost("free_ukeire_zumi");
        $higenr_vw->Shouhi_chousei_sasizu = $this->request->getPost("shouhi_chousei_sasizu");
        $higenr_vw->Shouhi_chousei_zumi = $this->request->getPost("shouhi_chousei_zumi");
        $higenr_vw->Shouhi_zumi = $this->request->getPost("shouhi_zumi");
        $higenr_vw->Kanryou_kbn = $this->request->getPost("kanryou_kbn");
        $higenr_vw->Kuuhaku = $this->request->getPost("kuuhaku");
        

        if (!$higenr_vw->save()) {
            foreach ($higenr_vw->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "higenr_vws",
                'action' => 'new'
            ]);

            return;
        }

        $this->flash->success("higenr_vw was created successfully");

        $this->dispatcher->forward([
            'controller' => "higenr_vws",
            'action' => 'index'
        ]);
    }

    /**
     * Saves a higenr_vw edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "higenr_vws",
                'action' => 'index'
            ]);

            return;
        }

        $sasizu_no = $this->request->getPost("sasizu_no");
        $higenr_vw = HigenrVws::findFirstBysasizu_no($sasizu_no);

        if (!$higenr_vw) {
            $this->flash->error("higenr_vw does not exist " . $sasizu_no);

            $this->dispatcher->forward([
                'controller' => "higenr_vws",
                'action' => 'index'
            ]);

            return;
        }

        $higenr_vw->Sasizu_no = $this->request->getPost("sasizu_no");
        $higenr_vw->Genryou_jun = $this->request->getPost("genryou_jun");
        $higenr_vw->Itoshu = $this->request->getPost("itoshu");
        $higenr_vw->Itocode = $this->request->getPost("itocode");
        $higenr_vw->Gentanni = $this->request->getPost("gentanni");
        $higenr_vw->Chokuyori_kbn = $this->request->getPost("chokuyori_kbn");
        $higenr_vw->Chokuyori_sasizu_no = $this->request->getPost("chokuyori_sasizu_no");
        $higenr_vw->Ukeire_sasizu = $this->request->getPost("ukeire_sasizu");
        $higenr_vw->Ukeire_zumi = $this->request->getPost("ukeire_zumi");
        $higenr_vw->Free_ukeire_sasizu = $this->request->getPost("free_ukeire_sasizu");
        $higenr_vw->Free_ukeire_zumi = $this->request->getPost("free_ukeire_zumi");
        $higenr_vw->Shouhi_chousei_sasizu = $this->request->getPost("shouhi_chousei_sasizu");
        $higenr_vw->Shouhi_chousei_zumi = $this->request->getPost("shouhi_chousei_zumi");
        $higenr_vw->Shouhi_zumi = $this->request->getPost("shouhi_zumi");
        $higenr_vw->Kanryou_kbn = $this->request->getPost("kanryou_kbn");
        $higenr_vw->Kuuhaku = $this->request->getPost("kuuhaku");
        

        if (!$higenr_vw->save()) {

            foreach ($higenr_vw->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "higenr_vws",
                'action' => 'edit',
                'params' => [$higenr_vw->sasizu_no]
            ]);

            return;
        }

        $this->flash->success("higenr_vw was updated successfully");

        $this->dispatcher->forward([
            'controller' => "higenr_vws",
            'action' => 'index'
        ]);
    }

    /**
     * Deletes a higenr_vw
     *
     * @param string $sasizu_no
     */
    public function deleteAction($sasizu_no)
    {
        $higenr_vw = HigenrVws::findFirstBysasizu_no($sasizu_no);
        if (!$higenr_vw) {
            $this->flash->error("higenr_vw was not found");

            $this->dispatcher->forward([
                'controller' => "higenr_vws",
                'action' => 'index'
            ]);

            return;
        }

        if (!$higenr_vw->delete()) {

            foreach ($higenr_vw->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "higenr_vws",
                'action' => 'search'
            ]);

            return;
        }

        $this->flash->success("higenr_vw was deleted successfully");

        $this->dispatcher->forward([
            'controller' => "higenr_vws",
            'action' => "index"
        ]);
    }

}
