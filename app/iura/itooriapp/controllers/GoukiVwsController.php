<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class GoukiVwsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for gouki_vws
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'GoukiVws', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = [];
        }
        $parameters["order"] = "koutei_kbn";

        $gouki_vws = GoukiVws::find($parameters);
        if (count($gouki_vws) == 0) {
            $this->flash->notice("The search did not find any gouki_vws");

            $this->dispatcher->forward([
                "controller" => "gouki_vws",
                "action" => "index"
            ]);

            return;
        }

        $paginator = new Paginator([
            'data' => $gouki_vws,
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
     * Edits a gouki_vw
     *
     * @param string $koutei_kbn
     */
    public function editAction($koutei_kbn)
    {
        if (!$this->request->isPost()) {

            $gouki_vw = GoukiVws::findFirstBykoutei_kbn($koutei_kbn);
            if (!$gouki_vw) {
                $this->flash->error("gouki_vw was not found");

                $this->dispatcher->forward([
                    'controller' => "gouki_vws",
                    'action' => 'index'
                ]);

                return;
            }

            $this->view->koutei_kbn = $gouki_vw->koutei_kbn;

            $this->tag->setDefault("koutei_kbn", $gouki_vw->koutei_kbn);
            $this->tag->setDefault("kishu", $gouki_vw->kishu);
            $this->tag->setDefault("kishu_yobi", $gouki_vw->kishu_yobi);
            $this->tag->setDefault("koujou", $gouki_vw->koujou);
            $this->tag->setDefault("gouki", $gouki_vw->gouki);
            $this->tag->setDefault("gouki_eda", $gouki_vw->gouki_eda);
            $this->tag->setDefault("kai", $gouki_vw->kai);
            $this->tag->setDefault("suisuu", $gouki_vw->suisuu);
            $this->tag->setDefault("bikou", $gouki_vw->bikou);
            
        }
    }

    /**
     * Creates a new gouki_vw
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "gouki_vws",
                'action' => 'index'
            ]);

            return;
        }

        $gouki_vw = new GoukiVws();
        $gouki_vw->Koutei_kbn = $this->request->getPost("koutei_kbn");
        $gouki_vw->Kishu = $this->request->getPost("kishu");
        $gouki_vw->Kishu_yobi = $this->request->getPost("kishu_yobi");
        $gouki_vw->Koujou = $this->request->getPost("koujou");
        $gouki_vw->Gouki = $this->request->getPost("gouki");
        $gouki_vw->Gouki_eda = $this->request->getPost("gouki_eda");
        $gouki_vw->Kai = $this->request->getPost("kai");
        $gouki_vw->Suisuu = $this->request->getPost("suisuu");
        $gouki_vw->Bikou = $this->request->getPost("bikou");
        

        if (!$gouki_vw->save()) {
            foreach ($gouki_vw->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "gouki_vws",
                'action' => 'new'
            ]);

            return;
        }

        $this->flash->success("gouki_vw was created successfully");

        $this->dispatcher->forward([
            'controller' => "gouki_vws",
            'action' => 'index'
        ]);
    }

    /**
     * Saves a gouki_vw edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "gouki_vws",
                'action' => 'index'
            ]);

            return;
        }

        $koutei_kbn = $this->request->getPost("koutei_kbn");
        $gouki_vw = GoukiVws::findFirstBykoutei_kbn($koutei_kbn);

        if (!$gouki_vw) {
            $this->flash->error("gouki_vw does not exist " . $koutei_kbn);

            $this->dispatcher->forward([
                'controller' => "gouki_vws",
                'action' => 'index'
            ]);

            return;
        }

        $gouki_vw->Koutei_kbn = $this->request->getPost("koutei_kbn");
        $gouki_vw->Kishu = $this->request->getPost("kishu");
        $gouki_vw->Kishu_yobi = $this->request->getPost("kishu_yobi");
        $gouki_vw->Koujou = $this->request->getPost("koujou");
        $gouki_vw->Gouki = $this->request->getPost("gouki");
        $gouki_vw->Gouki_eda = $this->request->getPost("gouki_eda");
        $gouki_vw->Kai = $this->request->getPost("kai");
        $gouki_vw->Suisuu = $this->request->getPost("suisuu");
        $gouki_vw->Bikou = $this->request->getPost("bikou");
        

        if (!$gouki_vw->save()) {

            foreach ($gouki_vw->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "gouki_vws",
                'action' => 'edit',
                'params' => [$gouki_vw->koutei_kbn]
            ]);

            return;
        }

        $this->flash->success("gouki_vw was updated successfully");

        $this->dispatcher->forward([
            'controller' => "gouki_vws",
            'action' => 'index'
        ]);
    }

    /**
     * Deletes a gouki_vw
     *
     * @param string $koutei_kbn
     */
    public function deleteAction($koutei_kbn)
    {
        $gouki_vw = GoukiVws::findFirstBykoutei_kbn($koutei_kbn);
        if (!$gouki_vw) {
            $this->flash->error("gouki_vw was not found");

            $this->dispatcher->forward([
                'controller' => "gouki_vws",
                'action' => 'index'
            ]);

            return;
        }

        if (!$gouki_vw->delete()) {

            foreach ($gouki_vw->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "gouki_vws",
                'action' => 'search'
            ]);

            return;
        }

        $this->flash->success("gouki_vw was deleted successfully");

        $this->dispatcher->forward([
            'controller' => "gouki_vws",
            'action' => "index"
        ]);
    }

}
