<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class HostMemoController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for host_memo
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'HostMemo', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = [];
        }
        $parameters["order"] = "id";

        $host_memo = HostMemo::find($parameters);
        if (count($host_memo) == 0) {
            $this->flash->notice("The search did not find any host_memo");

            $this->dispatcher->forward([
                "controller" => "host_memo",
                "action" => "index"
            ]);

            return;
        }

        $paginator = new Paginator([
            'data' => $host_memo,
            'limit'=> 100,
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
     * Edits a host_memo
     *
     * @param string $id
     */
    public function editAction($id)
    {
        if (!$this->request->isPost()) {

            $host_memo = HostMemo::findFirstByid($id);
            if (!$host_memo) {
                $this->flash->error("host_memo was not found");

                $this->dispatcher->forward([
                    'controller' => "host_memo",
                    'action' => 'index'
                ]);

                return;
            }

            $this->view->id = $host_memo->id;

            $this->tag->setDefault("id", $host_memo->id);
            $this->tag->setDefault("memo", $host_memo->memo);
            
        }
    }

    /**
     * Creates a new host_memo
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "host_memo",
                'action' => 'index'
            ]);

            return;
        }

        $host_memo = new HostMemo();
        $host_memo->Id = $this->request->getPost("id");
        $host_memo->Memo = $this->request->getPost("memo");
        

        if (!$host_memo->save()) {
            foreach ($host_memo->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "host_memo",
                'action' => 'new'
            ]);

            return;
        }

        $this->flash->success("host_memo was created successfully");

        $this->dispatcher->forward([
            'controller' => "host_memo",
            'action' => 'index'
        ]);
    }

    /**
     * Saves a host_memo edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "host_memo",
                'action' => 'index'
            ]);

            return;
        }

        $id = $this->request->getPost("id");
        $host_memo = HostMemo::findFirstByid($id);

        if (!$host_memo) {
            $this->flash->error("host_memo does not exist " . $id);

            $this->dispatcher->forward([
                'controller' => "host_memo",
                'action' => 'index'
            ]);

            return;
        }

        $host_memo->Id = $this->request->getPost("id");
        $host_memo->Memo = $this->request->getPost("memo");
        

        if (!$host_memo->save()) {

            foreach ($host_memo->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "host_memo",
                'action' => 'edit',
                'params' => [$host_memo->id]
            ]);

            return;
        }

        $this->flash->success("host_memo was updated successfully");

        $this->dispatcher->forward([
            'controller' => "host_memo",
            'action' => 'index'
        ]);
    }

    /**
     * Deletes a host_memo
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $host_memo = HostMemo::findFirstByid($id);
        if (!$host_memo) {
            $this->flash->error("host_memo was not found");

            $this->dispatcher->forward([
                'controller' => "host_memo",
                'action' => 'index'
            ]);

            return;
        }

        if (!$host_memo->delete()) {

            foreach ($host_memo->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "host_memo",
                'action' => 'search'
            ]);

            return;
        }

        $this->flash->success("host_memo was deleted successfully");

        $this->dispatcher->forward([
            'controller' => "host_memo",
            'action' => "index"
        ]);
    }

}
