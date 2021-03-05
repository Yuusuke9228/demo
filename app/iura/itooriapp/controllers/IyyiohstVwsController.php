<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class IyyiohstVwsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for iyyiohst_vws
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'IyyiohstVws', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = [];
        }
        $parameters["order"] = "nyuuryoku_date";

        $iyyiohst_vws = IyyiohstVws::find($parameters);
        if (count($iyyiohst_vws) == 0) {
            $this->flash->notice("The search did not find any iyyiohst_vws");

            $this->dispatcher->forward([
                "controller" => "iyyiohst_vws",
                "action" => "index"
            ]);

            return;
        }

        $paginator = new Paginator([
            'data' => $iyyiohst_vws,
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
     * Edits a iyyiohst_vw
     *
     * @param string $nyuuryoku_date
     */
    public function editAction($nyuuryoku_date)
    {
        if (!$this->request->isPost()) {

            $iyyiohst_vw = IyyiohstVws::findFirstBynyuuryoku_date($nyuuryoku_date);
            if (!$iyyiohst_vw) {
                $this->flash->error("iyyiohst_vw was not found");

                $this->dispatcher->forward([
                    'controller' => "iyyiohst_vws",
                    'action' => 'index'
                ]);

                return;
            }

            $this->view->nyuuryoku_date = $iyyiohst_vw->nyuuryoku_date;

            $this->tag->setDefault("nyuuryoku_date", $iyyiohst_vw->nyuuryoku_date);
            $this->tag->setDefault("itiren_no", $iyyiohst_vw->itiren_no);
            $this->tag->setDefault("denpyou_date", $iyyiohst_vw->denpyou_date);
            $this->tag->setDefault("shiiresaki", $iyyiohst_vw->shiiresaki);
            $this->tag->setDefault("nyuushukko_kbn", $iyyiohst_vw->nyuushukko_kbn);
            $this->tag->setDefault("denpyou_no", $iyyiohst_vw->denpyou_no);
            $this->tag->setDefault("denpyou_eda", $iyyiohst_vw->denpyou_eda);
            $this->tag->setDefault("rec_kbn", $iyyiohst_vw->rec_kbn);
            $this->tag->setDefault("itoshu", $iyyiohst_vw->itoshu);
            $this->tag->setDefault("ito_code", $iyyiohst_vw->ito_code);
            $this->tag->setDefault("bobin", $iyyiohst_vw->bobin);
            $this->tag->setDefault("itoryou", $iyyiohst_vw->itoryou);
            $this->tag->setDefault("tanni", $iyyiohst_vw->tanni);
            $this->tag->setDefault("tanka", $iyyiohst_vw->tanka);
            $this->tag->setDefault("kingaku", $iyyiohst_vw->kingaku);
            $this->tag->setDefault("zaiko_ryou", $iyyiohst_vw->zaiko_ryou);
            $this->tag->setDefault("haraidasi_saki", $iyyiohst_vw->haraidasi_saki);
            $this->tag->setDefault("chuumon_no", $iyyiohst_vw->chuumon_no);
            $this->tag->setDefault("hako_suu", $iyyiohst_vw->hako_suu);
            $this->tag->setDefault("hon1hako", $iyyiohst_vw->hon1hako);
            
        }
    }

    /**
     * Creates a new iyyiohst_vw
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "iyyiohst_vws",
                'action' => 'index'
            ]);

            return;
        }

        $iyyiohst_vw = new IyyiohstVws();
        $iyyiohst_vw->Nyuuryoku_date = $this->request->getPost("nyuuryoku_date");
        $iyyiohst_vw->Itiren_no = $this->request->getPost("itiren_no");
        $iyyiohst_vw->Denpyou_date = $this->request->getPost("denpyou_date");
        $iyyiohst_vw->Shiiresaki = $this->request->getPost("shiiresaki");
        $iyyiohst_vw->Nyuushukko_kbn = $this->request->getPost("nyuushukko_kbn");
        $iyyiohst_vw->Denpyou_no = $this->request->getPost("denpyou_no");
        $iyyiohst_vw->Denpyou_eda = $this->request->getPost("denpyou_eda");
        $iyyiohst_vw->Rec_kbn = $this->request->getPost("rec_kbn");
        $iyyiohst_vw->Itoshu = $this->request->getPost("itoshu");
        $iyyiohst_vw->Ito_code = $this->request->getPost("ito_code");
        $iyyiohst_vw->Bobin = $this->request->getPost("bobin");
        $iyyiohst_vw->Itoryou = $this->request->getPost("itoryou");
        $iyyiohst_vw->Tanni = $this->request->getPost("tanni");
        $iyyiohst_vw->Tanka = $this->request->getPost("tanka");
        $iyyiohst_vw->Kingaku = $this->request->getPost("kingaku");
        $iyyiohst_vw->Zaiko_ryou = $this->request->getPost("zaiko_ryou");
        $iyyiohst_vw->Haraidasi_saki = $this->request->getPost("haraidasi_saki");
        $iyyiohst_vw->Chuumon_no = $this->request->getPost("chuumon_no");
        $iyyiohst_vw->Hako_suu = $this->request->getPost("hako_suu");
        $iyyiohst_vw->Hon1hako = $this->request->getPost("hon1hako");
        

        if (!$iyyiohst_vw->save()) {
            foreach ($iyyiohst_vw->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "iyyiohst_vws",
                'action' => 'new'
            ]);

            return;
        }

        $this->flash->success("iyyiohst_vw was created successfully");

        $this->dispatcher->forward([
            'controller' => "iyyiohst_vws",
            'action' => 'index'
        ]);
    }

    /**
     * Saves a iyyiohst_vw edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "iyyiohst_vws",
                'action' => 'index'
            ]);

            return;
        }

        $nyuuryoku_date = $this->request->getPost("nyuuryoku_date");
        $iyyiohst_vw = IyyiohstVws::findFirstBynyuuryoku_date($nyuuryoku_date);

        if (!$iyyiohst_vw) {
            $this->flash->error("iyyiohst_vw does not exist " . $nyuuryoku_date);

            $this->dispatcher->forward([
                'controller' => "iyyiohst_vws",
                'action' => 'index'
            ]);

            return;
        }

        $iyyiohst_vw->Nyuuryoku_date = $this->request->getPost("nyuuryoku_date");
        $iyyiohst_vw->Itiren_no = $this->request->getPost("itiren_no");
        $iyyiohst_vw->Denpyou_date = $this->request->getPost("denpyou_date");
        $iyyiohst_vw->Shiiresaki = $this->request->getPost("shiiresaki");
        $iyyiohst_vw->Nyuushukko_kbn = $this->request->getPost("nyuushukko_kbn");
        $iyyiohst_vw->Denpyou_no = $this->request->getPost("denpyou_no");
        $iyyiohst_vw->Denpyou_eda = $this->request->getPost("denpyou_eda");
        $iyyiohst_vw->Rec_kbn = $this->request->getPost("rec_kbn");
        $iyyiohst_vw->Itoshu = $this->request->getPost("itoshu");
        $iyyiohst_vw->Ito_code = $this->request->getPost("ito_code");
        $iyyiohst_vw->Bobin = $this->request->getPost("bobin");
        $iyyiohst_vw->Itoryou = $this->request->getPost("itoryou");
        $iyyiohst_vw->Tanni = $this->request->getPost("tanni");
        $iyyiohst_vw->Tanka = $this->request->getPost("tanka");
        $iyyiohst_vw->Kingaku = $this->request->getPost("kingaku");
        $iyyiohst_vw->Zaiko_ryou = $this->request->getPost("zaiko_ryou");
        $iyyiohst_vw->Haraidasi_saki = $this->request->getPost("haraidasi_saki");
        $iyyiohst_vw->Chuumon_no = $this->request->getPost("chuumon_no");
        $iyyiohst_vw->Hako_suu = $this->request->getPost("hako_suu");
        $iyyiohst_vw->Hon1hako = $this->request->getPost("hon1hako");
        

        if (!$iyyiohst_vw->save()) {

            foreach ($iyyiohst_vw->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "iyyiohst_vws",
                'action' => 'edit',
                'params' => [$iyyiohst_vw->nyuuryoku_date]
            ]);

            return;
        }

        $this->flash->success("iyyiohst_vw was updated successfully");

        $this->dispatcher->forward([
            'controller' => "iyyiohst_vws",
            'action' => 'index'
        ]);
    }

    /**
     * Deletes a iyyiohst_vw
     *
     * @param string $nyuuryoku_date
     */
    public function deleteAction($nyuuryoku_date)
    {
        $iyyiohst_vw = IyyiohstVws::findFirstBynyuuryoku_date($nyuuryoku_date);
        if (!$iyyiohst_vw) {
            $this->flash->error("iyyiohst_vw was not found");

            $this->dispatcher->forward([
                'controller' => "iyyiohst_vws",
                'action' => 'index'
            ]);

            return;
        }

        if (!$iyyiohst_vw->delete()) {

            foreach ($iyyiohst_vw->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "iyyiohst_vws",
                'action' => 'search'
            ]);

            return;
        }

        $this->flash->success("iyyiohst_vw was deleted successfully");

        $this->dispatcher->forward([
            'controller' => "iyyiohst_vws",
            'action' => "index"
        ]);
    }

}
