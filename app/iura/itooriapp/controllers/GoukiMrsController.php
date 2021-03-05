<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class GoukiMrsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for gouki_mrs
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'GoukiMrs', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = [];
        }
        $parameters["order"] = "koutei_kbn";

        $gouki_mrs = GoukiMrs::find($parameters);
        if (count($gouki_mrs) == 0) {
            $this->flash->notice("The search did not find any gouki_mrs");

            $this->dispatcher->forward([
                "controller" => "gouki_mrs",
                "action" => "index"
            ]);

            return;
        }

        $paginator = new Paginator([
            'data' => $gouki_mrs,
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
     * Edits a gouki_mr
     *
     * @param string $koutei_kbn
     */
    public function editAction($koutei_kbn)
    {
        if (!$this->request->isPost()) {

            $gouki_mr = GoukiMrs::findFirstBykoutei_kbn($koutei_kbn);
            if (!$gouki_mr) {
                $this->flash->error("gouki_mr was not found");

                $this->dispatcher->forward([
                    'controller' => "gouki_mrs",
                    'action' => 'index'
                ]);

                return;
            }

            $this->view->koutei_kbn = $gouki_mr->koutei_kbn;

            $this->tag->setDefault("koutei_kbn", $gouki_mr->koutei_kbn);
            $this->tag->setDefault("kishu", $gouki_mr->kishu);
            $this->tag->setDefault("kishu_yobi", $gouki_mr->kishu_yobi);
            $this->tag->setDefault("koujou", $gouki_mr->koujou);
            $this->tag->setDefault("gouki", $gouki_mr->gouki);
            $this->tag->setDefault("gouki_eda", $gouki_mr->gouki_eda);
            $this->tag->setDefault("kai", $gouki_mr->kai);
            $this->tag->setDefault("suisuu", $gouki_mr->suisuu);
            $this->tag->setDefault("bikou", $gouki_mr->bikou);
            
        }
    }

    /**
     * Creates a new gouki_mr
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "gouki_mrs",
                'action' => 'index'
            ]);

            return;
        }

        $gouki_mr = new GoukiMrs();
        $gouki_mr->Koutei_kbn = $this->request->getPost("koutei_kbn");
        $gouki_mr->Kishu = $this->request->getPost("kishu");
        $gouki_mr->Kishu_yobi = $this->request->getPost("kishu_yobi");
        $gouki_mr->Koujou = $this->request->getPost("koujou");
        $gouki_mr->Gouki = $this->request->getPost("gouki");
        $gouki_mr->Gouki_eda = $this->request->getPost("gouki_eda");
        $gouki_mr->Kai = $this->request->getPost("kai");
        $gouki_mr->Suisuu = $this->request->getPost("suisuu");
        $gouki_mr->Bikou = $this->request->getPost("bikou");
        

        if (!$gouki_mr->save()) {
            foreach ($gouki_mr->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "gouki_mrs",
                'action' => 'new'
            ]);

            return;
        }

        $this->flash->success("gouki_mr was created successfully");

        $this->dispatcher->forward([
            'controller' => "gouki_mrs",
            'action' => 'index'
        ]);
    }

    /**
     * Saves a gouki_mr edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "gouki_mrs",
                'action' => 'index'
            ]);

            return;
        }

        $koutei_kbn = $this->request->getPost("koutei_kbn");
        $gouki_mr = GoukiMrs::findFirstBykoutei_kbn($koutei_kbn);

        if (!$gouki_mr) {
            $this->flash->error("gouki_mr does not exist " . $koutei_kbn);

            $this->dispatcher->forward([
                'controller' => "gouki_mrs",
                'action' => 'index'
            ]);

            return;
        }

        $gouki_mr->Koutei_kbn = $this->request->getPost("koutei_kbn");
        $gouki_mr->Kishu = $this->request->getPost("kishu");
        $gouki_mr->Kishu_yobi = $this->request->getPost("kishu_yobi");
        $gouki_mr->Koujou = $this->request->getPost("koujou");
        $gouki_mr->Gouki = $this->request->getPost("gouki");
        $gouki_mr->Gouki_eda = $this->request->getPost("gouki_eda");
        $gouki_mr->Kai = $this->request->getPost("kai");
        $gouki_mr->Suisuu = $this->request->getPost("suisuu");
        $gouki_mr->Bikou = $this->request->getPost("bikou");
        

        if (!$gouki_mr->save()) {

            foreach ($gouki_mr->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "gouki_mrs",
                'action' => 'edit',
                'params' => [$gouki_mr->koutei_kbn]
            ]);

            return;
        }

        $this->flash->success("gouki_mr was updated successfully");

        $this->dispatcher->forward([
            'controller' => "gouki_mrs",
            'action' => 'index'
        ]);
    }

    /**
     * Deletes a gouki_mr
     *
     * @param string $koutei_kbn
     */
    public function deleteAction($koutei_kbn)
    {
        $gouki_mr = GoukiMrs::findFirstBykoutei_kbn($koutei_kbn);
        if (!$gouki_mr) {
            $this->flash->error("gouki_mr was not found");

            $this->dispatcher->forward([
                'controller' => "gouki_mrs",
                'action' => 'index'
            ]);

            return;
        }

        if (!$gouki_mr->delete()) {

            foreach ($gouki_mr->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "gouki_mrs",
                'action' => 'search'
            ]);

            return;
        }

        $this->flash->success("gouki_mr was deleted successfully");

        $this->dispatcher->forward([
            'controller' => "gouki_mrs",
            'action' => "index"
        ]);
    }

}
