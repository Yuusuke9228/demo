<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class ItomeiVwsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for itomei_vws
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'ItomeiVws', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = [];
        }
        $parameters["order"] = "itoshu";

        $itomei_vws = ItomeiVws::find($parameters);
        if (count($itomei_vws) == 0) {
            $this->flash->notice("The search did not find any itomei_vws");

            $this->dispatcher->forward([
                "controller" => "itomei_vws",
                "action" => "index"
            ]);

            return;
        }

        $paginator = new Paginator([
            'data' => $itomei_vws,
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
     * Edits a itomei_vw
     *
     * @param string $itoshu
     */
    public function editAction($itoshu)
    {
        if (!$this->request->isPost()) {

            $itomei_vw = ItomeiVws::findFirstByitoshu($itoshu);
            if (!$itomei_vw) {
                $this->flash->error("itomei_vw was not found");

                $this->dispatcher->forward([
                    'controller' => "itomei_vws",
                    'action' => 'index'
                ]);

                return;
            }

            $this->view->itoshu = $itomei_vw->itoshu;

            $this->tag->setDefault("itoshu", $itomei_vw->itoshu);
            $this->tag->setDefault("ito_code", $itomei_vw->ito_code);
            $this->tag->setDefault("itomei1", $itomei_vw->itomei1);
            $this->tag->setDefault("itomei2", $itomei_vw->itomei2);
            $this->tag->setDefault("itomei3", $itomei_vw->itomei3);
            $this->tag->setDefault("koushin_kbn", $itomei_vw->koushin_kbn);
            $this->tag->setDefault("kousin_date", $itomei_vw->kousin_date);
            
        }
    }

    /**
     * Creates a new itomei_vw
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "itomei_vws",
                'action' => 'index'
            ]);

            return;
        }

        $itomei_vw = new ItomeiVws();
        $itomei_vw->Itoshu = $this->request->getPost("itoshu");
        $itomei_vw->Ito_code = $this->request->getPost("ito_code");
        $itomei_vw->Itomei1 = $this->request->getPost("itomei1");
        $itomei_vw->Itomei2 = $this->request->getPost("itomei2");
        $itomei_vw->Itomei3 = $this->request->getPost("itomei3");
        $itomei_vw->Koushin_kbn = $this->request->getPost("koushin_kbn");
        $itomei_vw->Kousin_date = $this->request->getPost("kousin_date");
        

        if (!$itomei_vw->save()) {
            foreach ($itomei_vw->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "itomei_vws",
                'action' => 'new'
            ]);

            return;
        }

        $this->flash->success("itomei_vw was created successfully");

        $this->dispatcher->forward([
            'controller' => "itomei_vws",
            'action' => 'index'
        ]);
    }

    /**
     * Saves a itomei_vw edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "itomei_vws",
                'action' => 'index'
            ]);

            return;
        }

        $itoshu = $this->request->getPost("itoshu");
        $itomei_vw = ItomeiVws::findFirstByitoshu($itoshu);

        if (!$itomei_vw) {
            $this->flash->error("itomei_vw does not exist " . $itoshu);

            $this->dispatcher->forward([
                'controller' => "itomei_vws",
                'action' => 'index'
            ]);

            return;
        }

        $itomei_vw->Itoshu = $this->request->getPost("itoshu");
        $itomei_vw->Ito_code = $this->request->getPost("ito_code");
        $itomei_vw->Itomei1 = $this->request->getPost("itomei1");
        $itomei_vw->Itomei2 = $this->request->getPost("itomei2");
        $itomei_vw->Itomei3 = $this->request->getPost("itomei3");
        $itomei_vw->Koushin_kbn = $this->request->getPost("koushin_kbn");
        $itomei_vw->Kousin_date = $this->request->getPost("kousin_date");
        

        if (!$itomei_vw->save()) {

            foreach ($itomei_vw->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "itomei_vws",
                'action' => 'edit',
                'params' => [$itomei_vw->itoshu]
            ]);

            return;
        }

        $this->flash->success("itomei_vw was updated successfully");

        $this->dispatcher->forward([
            'controller' => "itomei_vws",
            'action' => 'index'
        ]);
    }

    /**
     * Deletes a itomei_vw
     *
     * @param string $itoshu
     */
    public function deleteAction($itoshu)
    {
        $itomei_vw = ItomeiVws::findFirstByitoshu($itoshu);
        if (!$itomei_vw) {
            $this->flash->error("itomei_vw was not found");

            $this->dispatcher->forward([
                'controller' => "itomei_vws",
                'action' => 'index'
            ]);

            return;
        }

        if (!$itomei_vw->delete()) {

            foreach ($itomei_vw->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "itomei_vws",
                'action' => 'search'
            ]);

            return;
        }

        $this->flash->success("itomei_vw was deleted successfully");

        $this->dispatcher->forward([
            'controller' => "itomei_vws",
            'action' => "index"
        ]);
    }

}
