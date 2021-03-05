<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class PropHikiateVwsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for prop_hikiate_vws
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'PropHikiateVws', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = [];
        }
        $parameters["order"] = "sasizu_no";

        $prop_hikiate_vws = PropHikiateVws::find($parameters);
        if (count($prop_hikiate_vws) == 0) {
            $this->flash->notice("The search did not find any prop_hikiate_vws");

            $this->dispatcher->forward([
                "controller" => "prop_hikiate_vws",
                "action" => "index"
            ]);

            return;
        }

        $paginator = new Paginator([
            'data' => $prop_hikiate_vws,
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
     * Edits a prop_hikiate_vw
     *
     * @param string $sasizu_no
     */
    public function editAction($sasizu_no)
    {
        if (!$this->request->isPost()) {

            $prop_hikiate_vw = PropHikiateVws::findFirstBysasizu_no($sasizu_no);
            if (!$prop_hikiate_vw) {
                $this->flash->error("prop_hikiate_vw was not found");

                $this->dispatcher->forward([
                    'controller' => "prop_hikiate_vws",
                    'action' => 'index'
                ]);

                return;
            }

            $this->view->sasizu_no = $prop_hikiate_vw->sasizu_no;

            $this->tag->setDefault("sasizu_no", $prop_hikiate_vw->sasizu_no);
            $this->tag->setDefault("sasizu_eda", $prop_hikiate_vw->sasizu_eda);
            $this->tag->setDefault("kakou_no", $prop_hikiate_vw->kakou_no);
            $this->tag->setDefault("kakou_no1", $prop_hikiate_vw->kakou_no1);
            $this->tag->setDefault("tanka", $prop_hikiate_vw->tanka);
            $this->tag->setDefault("tanni", $prop_hikiate_vw->tanni);
            $this->tag->setDefault("itomei", $prop_hikiate_vw->itomei);
            $this->tag->setDefault("itomei2", $prop_hikiate_vw->itomei2);
            $this->tag->setDefault("lot", $prop_hikiate_vw->lot);
            $this->tag->setDefault("bikou", $prop_hikiate_vw->bikou);
            $this->tag->setDefault("shukka_saki", $prop_hikiate_vw->shukka_saki);
            $this->tag->setDefault("juusho", $prop_hikiate_vw->juusho);
            $this->tag->setDefault("tel", $prop_hikiate_vw->tel);
            $this->tag->setDefault("label_keisiki", $prop_hikiate_vw->label_keisiki);
            
        }
    }

    /**
     * Creates a new prop_hikiate_vw
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "prop_hikiate_vws",
                'action' => 'index'
            ]);

            return;
        }

        $prop_hikiate_vw = new PropHikiateVws();
        $prop_hikiate_vw->Sasizu_no = $this->request->getPost("sasizu_no");
        $prop_hikiate_vw->Sasizu_eda = $this->request->getPost("sasizu_eda");
        $prop_hikiate_vw->Kakou_no = $this->request->getPost("kakou_no");
        $prop_hikiate_vw->Kakou_no1 = $this->request->getPost("kakou_no1");
        $prop_hikiate_vw->Tanka = $this->request->getPost("tanka");
        $prop_hikiate_vw->Tanni = $this->request->getPost("tanni");
        $prop_hikiate_vw->Itomei = $this->request->getPost("itomei");
        $prop_hikiate_vw->Itomei2 = $this->request->getPost("itomei2");
        $prop_hikiate_vw->Lot = $this->request->getPost("lot");
        $prop_hikiate_vw->Bikou = $this->request->getPost("bikou");
        $prop_hikiate_vw->Shukka_saki = $this->request->getPost("shukka_saki");
        $prop_hikiate_vw->Juusho = $this->request->getPost("juusho");
        $prop_hikiate_vw->Tel = $this->request->getPost("tel");
        $prop_hikiate_vw->Label_keisiki = $this->request->getPost("label_keisiki");
        

        if (!$prop_hikiate_vw->save()) {
            foreach ($prop_hikiate_vw->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "prop_hikiate_vws",
                'action' => 'new'
            ]);

            return;
        }

        $this->flash->success("prop_hikiate_vw was created successfully");

        $this->dispatcher->forward([
            'controller' => "prop_hikiate_vws",
            'action' => 'index'
        ]);
    }

    /**
     * Saves a prop_hikiate_vw edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "prop_hikiate_vws",
                'action' => 'index'
            ]);

            return;
        }

        $sasizu_no = $this->request->getPost("sasizu_no");
        $prop_hikiate_vw = PropHikiateVws::findFirstBysasizu_no($sasizu_no);

        if (!$prop_hikiate_vw) {
            $this->flash->error("prop_hikiate_vw does not exist " . $sasizu_no);

            $this->dispatcher->forward([
                'controller' => "prop_hikiate_vws",
                'action' => 'index'
            ]);

            return;
        }

        $prop_hikiate_vw->Sasizu_no = $this->request->getPost("sasizu_no");
        $prop_hikiate_vw->Sasizu_eda = $this->request->getPost("sasizu_eda");
        $prop_hikiate_vw->Kakou_no = $this->request->getPost("kakou_no");
        $prop_hikiate_vw->Kakou_no1 = $this->request->getPost("kakou_no1");
        $prop_hikiate_vw->Tanka = $this->request->getPost("tanka");
        $prop_hikiate_vw->Tanni = $this->request->getPost("tanni");
        $prop_hikiate_vw->Itomei = $this->request->getPost("itomei");
        $prop_hikiate_vw->Itomei2 = $this->request->getPost("itomei2");
        $prop_hikiate_vw->Lot = $this->request->getPost("lot");
        $prop_hikiate_vw->Bikou = $this->request->getPost("bikou");
        $prop_hikiate_vw->Shukka_saki = $this->request->getPost("shukka_saki");
        $prop_hikiate_vw->Juusho = $this->request->getPost("juusho");
        $prop_hikiate_vw->Tel = $this->request->getPost("tel");
        $prop_hikiate_vw->Label_keisiki = $this->request->getPost("label_keisiki");
        

        if (!$prop_hikiate_vw->save()) {

            foreach ($prop_hikiate_vw->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "prop_hikiate_vws",
                'action' => 'edit',
                'params' => [$prop_hikiate_vw->sasizu_no]
            ]);

            return;
        }

        $this->flash->success("prop_hikiate_vw was updated successfully");

        $this->dispatcher->forward([
            'controller' => "prop_hikiate_vws",
            'action' => 'index'
        ]);
    }

    /**
     * Deletes a prop_hikiate_vw
     *
     * @param string $sasizu_no
     */
    public function deleteAction($sasizu_no)
    {
        $prop_hikiate_vw = PropHikiateVws::findFirstBysasizu_no($sasizu_no);
        if (!$prop_hikiate_vw) {
            $this->flash->error("prop_hikiate_vw was not found");

            $this->dispatcher->forward([
                'controller' => "prop_hikiate_vws",
                'action' => 'index'
            ]);

            return;
        }

        if (!$prop_hikiate_vw->delete()) {

            foreach ($prop_hikiate_vw->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "prop_hikiate_vws",
                'action' => 'search'
            ]);

            return;
        }

        $this->flash->success("prop_hikiate_vw was deleted successfully");

        $this->dispatcher->forward([
            'controller' => "prop_hikiate_vws",
            'action' => "index"
        ]);
    }

}
