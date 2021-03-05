<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class ItomeiMrsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for itomei_mrs
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'ItomeiMrs', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = [];
        }
        $parameters["order"] = "糸種";

        $itomei_mrs = ItomeiMrs::find($parameters);
        if (count($itomei_mrs) == 0) {
            $this->flash->notice("The search did not find any itomei_mrs");

            $this->dispatcher->forward([
                "controller" => "itomei_mrs",
                "action" => "index"
            ]);

            return;
        }

        $paginator = new Paginator([
            'data' => $itomei_mrs,
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
     * Edits a itomei_mr
     *
     * @param string $糸種
     */
    public function editAction($糸種)
    {
        if (!$this->request->isPost()) {

            $itomei_mr = ItomeiMrs::findFirstBy糸種($糸種);
            if (!$itomei_mr) {
                $this->flash->error("itomei_mr was not found");

                $this->dispatcher->forward([
                    'controller' => "itomei_mrs",
                    'action' => 'index'
                ]);

                return;
            }

            $this->view->糸種 = $itomei_mr->糸種;

            $this->tag->setDefault("糸種", $itomei_mr->糸種);
            $this->tag->setDefault("糸コード", $itomei_mr->糸コード);
            $this->tag->setDefault("糸名１", $itomei_mr->糸名１);
            $this->tag->setDefault("糸名２", $itomei_mr->糸名２);
            $this->tag->setDefault("糸名３", $itomei_mr->糸名３);
            $this->tag->setDefault("更新区分", $itomei_mr->更新区分);
            $this->tag->setDefault("更新日付", $itomei_mr->更新日付);
            
        }
    }

    /**
     * Creates a new itomei_mr
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "itomei_mrs",
                'action' => 'index'
            ]);

            return;
        }

        $itomei_mr = new ItomeiMrs();
        $itomei_mr->糸種 = $this->request->getPost("糸種");
        $itomei_mr->糸コード = $this->request->getPost("糸コード");
        $itomei_mr->糸名１ = $this->request->getPost("糸名１");
        $itomei_mr->糸名２ = $this->request->getPost("糸名２");
        $itomei_mr->糸名３ = $this->request->getPost("糸名３");
        $itomei_mr->更新区分 = $this->request->getPost("更新区分");
        $itomei_mr->更新日付 = $this->request->getPost("更新日付");
        

        if (!$itomei_mr->save()) {
            foreach ($itomei_mr->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "itomei_mrs",
                'action' => 'new'
            ]);

            return;
        }

        $this->flash->success("itomei_mr was created successfully");

        $this->dispatcher->forward([
            'controller' => "itomei_mrs",
            'action' => 'index'
        ]);
    }

    /**
     * Saves a itomei_mr edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "itomei_mrs",
                'action' => 'index'
            ]);

            return;
        }

        $糸種 = $this->request->getPost("糸種");
        $itomei_mr = ItomeiMrs::findFirstBy糸種($糸種);

        if (!$itomei_mr) {
            $this->flash->error("itomei_mr does not exist " . $糸種);

            $this->dispatcher->forward([
                'controller' => "itomei_mrs",
                'action' => 'index'
            ]);

            return;
        }

        $itomei_mr->糸種 = $this->request->getPost("糸種");
        $itomei_mr->糸コード = $this->request->getPost("糸コード");
        $itomei_mr->糸名１ = $this->request->getPost("糸名１");
        $itomei_mr->糸名２ = $this->request->getPost("糸名２");
        $itomei_mr->糸名３ = $this->request->getPost("糸名３");
        $itomei_mr->更新区分 = $this->request->getPost("更新区分");
        $itomei_mr->更新日付 = $this->request->getPost("更新日付");
        

        if (!$itomei_mr->save()) {

            foreach ($itomei_mr->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "itomei_mrs",
                'action' => 'edit',
                'params' => [$itomei_mr->糸種]
            ]);

            return;
        }

        $this->flash->success("itomei_mr was updated successfully");

        $this->dispatcher->forward([
            'controller' => "itomei_mrs",
            'action' => 'index'
        ]);
    }

    /**
     * Deletes a itomei_mr
     *
     * @param string $糸種
     */
    public function deleteAction($糸種)
    {
        $itomei_mr = ItomeiMrs::findFirstBy糸種($糸種);
        if (!$itomei_mr) {
            $this->flash->error("itomei_mr was not found");

            $this->dispatcher->forward([
                'controller' => "itomei_mrs",
                'action' => 'index'
            ]);

            return;
        }

        if (!$itomei_mr->delete()) {

            foreach ($itomei_mr->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "itomei_mrs",
                'action' => 'search'
            ]);

            return;
        }

        $this->flash->success("itomei_mr was deleted successfully");

        $this->dispatcher->forward([
            'controller' => "itomei_mrs",
            'action' => "index"
        ]);
    }

}
