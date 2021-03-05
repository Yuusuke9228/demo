<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class SeisanTantouVwsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for seisan_tantou_vws
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'SeisanTantouVws', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = [];
        }
        $parameters["order"] = "bangou";

        $seisan_tantou_vws = SeisanTantouVws::find($parameters);
        if (count($seisan_tantou_vws) == 0) {
            $this->flash->notice("The search did not find any seisan_tantou_vws");

            $this->dispatcher->forward([
                "controller" => "seisan_tantou_vws",
                "action" => "index"
            ]);

            return;
        }

        $paginator = new Paginator([
            'data' => $seisan_tantou_vws,
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
     * Edits a seisan_tantou_vw
     *
     * @param string $bangou
     */
    public function editAction($bangou)
    {
        if (!$this->request->isPost()) {

            $seisan_tantou_vw = SeisanTantouVws::findFirstBybangou($bangou);
            if (!$seisan_tantou_vw) {
                $this->flash->error("seisan_tantou_vw was not found");

                $this->dispatcher->forward([
                    'controller' => "seisan_tantou_vws",
                    'action' => 'index'
                ]);

                return;
            }

            $this->view->bangou = $seisan_tantou_vw->bangou;

            $this->tag->setDefault("bangou", $seisan_tantou_vw->bangou);
            $this->tag->setDefault("name", $seisan_tantou_vw->name);
            
        }
    }

    /**
     * Creates a new seisan_tantou_vw
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "seisan_tantou_vws",
                'action' => 'index'
            ]);

            return;
        }

        $seisan_tantou_vw = new SeisanTantouVws();
        $seisan_tantou_vw->Bangou = $this->request->getPost("bangou");
        $seisan_tantou_vw->Name = $this->request->getPost("name");
        

        if (!$seisan_tantou_vw->save()) {
            foreach ($seisan_tantou_vw->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "seisan_tantou_vws",
                'action' => 'new'
            ]);

            return;
        }

        $this->flash->success("seisan_tantou_vw was created successfully");

        $this->dispatcher->forward([
            'controller' => "seisan_tantou_vws",
            'action' => 'index'
        ]);
    }

    /**
     * Saves a seisan_tantou_vw edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "seisan_tantou_vws",
                'action' => 'index'
            ]);

            return;
        }

        $bangou = $this->request->getPost("bangou");
        $seisan_tantou_vw = SeisanTantouVws::findFirstBybangou($bangou);

        if (!$seisan_tantou_vw) {
            $this->flash->error("seisan_tantou_vw does not exist " . $bangou);

            $this->dispatcher->forward([
                'controller' => "seisan_tantou_vws",
                'action' => 'index'
            ]);

            return;
        }

        $seisan_tantou_vw->Bangou = $this->request->getPost("bangou");
        $seisan_tantou_vw->Name = $this->request->getPost("name");
        

        if (!$seisan_tantou_vw->save()) {

            foreach ($seisan_tantou_vw->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "seisan_tantou_vws",
                'action' => 'edit',
                'params' => [$seisan_tantou_vw->bangou]
            ]);

            return;
        }

        $this->flash->success("seisan_tantou_vw was updated successfully");

        $this->dispatcher->forward([
            'controller' => "seisan_tantou_vws",
            'action' => 'index'
        ]);
    }

    /**
     * Deletes a seisan_tantou_vw
     *
     * @param string $bangou
     */
    public function deleteAction($bangou)
    {
        $seisan_tantou_vw = SeisanTantouVws::findFirstBybangou($bangou);
        if (!$seisan_tantou_vw) {
            $this->flash->error("seisan_tantou_vw was not found");

            $this->dispatcher->forward([
                'controller' => "seisan_tantou_vws",
                'action' => 'index'
            ]);

            return;
        }

        if (!$seisan_tantou_vw->delete()) {

            foreach ($seisan_tantou_vw->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "seisan_tantou_vws",
                'action' => 'search'
            ]);

            return;
        }

        $this->flash->success("seisan_tantou_vw was deleted successfully");

        $this->dispatcher->forward([
            'controller' => "seisan_tantou_vws",
            'action' => "index"
        ]);
    }

}
