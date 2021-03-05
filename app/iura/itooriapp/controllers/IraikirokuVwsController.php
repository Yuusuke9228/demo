<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class IraikirokuVwsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for iraikiroku_vws
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'IraikirokuVws', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = [];
        }
        $parameters["order"] = "kakou_no";

        $iraikiroku_vws = IraikirokuVws::find($parameters);
        if (count($iraikiroku_vws) == 0) {
            $this->flash->notice("The search did not find any iraikiroku_vws");

            $this->dispatcher->forward([
                "controller" => "iraikiroku_vws",
                "action" => "index"
            ]);

            return;
        }

        $paginator = new Paginator([
            'data' => $iraikiroku_vws,
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
     * Edits a iraikiroku_vw
     *
     * @param string $kakou_no
     */
    public function editAction($kakou_no)
    {
        if (!$this->request->isPost()) {

            $iraikiroku_vw = IraikirokuVws::findFirstBykakou_no($kakou_no);
            if (!$iraikiroku_vw) {
                $this->flash->error("iraikiroku_vw was not found");

                $this->dispatcher->forward([
                    'controller' => "iraikiroku_vws",
                    'action' => 'index'
                ]);

                return;
            }

            $this->view->kakou_no = $iraikiroku_vw->kakou_no;

            $this->tag->setDefault("kakou_no", $iraikiroku_vw->kakou_no);
            $this->tag->setDefault("hakkou_date", $iraikiroku_vw->hakkou_date);
            $this->tag->setDefault("kaisha_mei", $iraikiroku_vw->kaisha_mei);
            $this->tag->setDefault("sf_tantou", $iraikiroku_vw->sf_tantou);
            $this->tag->setDefault("tantou", $iraikiroku_vw->tantou);
            $this->tag->setDefault("agari_hinmei", $iraikiroku_vw->agari_hinmei);
            $this->tag->setDefault("siyousi", $iraikiroku_vw->siyousi);
            $this->tag->setDefault("kakouo_suuryou", $iraikiroku_vw->kakouo_suuryou);
            $this->tag->setDefault("tanni", $iraikiroku_vw->tanni);
            $this->tag->setDefault("seihin_lot", $iraikiroku_vw->seihin_lot);
            $this->tag->setDefault("tanni1", $iraikiroku_vw->tanni1);
            $this->tag->setDefault("nouki", $iraikiroku_vw->nouki);
            $this->tag->setDefault("shukkasaki", $iraikiroku_vw->shukkasaki);
            $this->tag->setDefault("juusho", $iraikiroku_vw->juusho);
            $this->tag->setDefault("tel", $iraikiroku_vw->tel);
            $this->tag->setDefault("naiyou1", $iraikiroku_vw->naiyou1);
            $this->tag->setDefault("naiyou2", $iraikiroku_vw->naiyou2);
            $this->tag->setDefault("naiyou3", $iraikiroku_vw->naiyou3);
            $this->tag->setDefault("naiyou4", $iraikiroku_vw->naiyou4);
            $this->tag->setDefault("naiyou5", $iraikiroku_vw->naiyou5);
            $this->tag->setDefault("naiyou6", $iraikiroku_vw->naiyou6);
            $this->tag->setDefault("naiyou7", $iraikiroku_vw->naiyou7);
            $this->tag->setDefault("naiyou8", $iraikiroku_vw->naiyou8);
            $this->tag->setDefault("naiyou9", $iraikiroku_vw->naiyou9);
            $this->tag->setDefault("naiyou10", $iraikiroku_vw->naiyou10);
            $this->tag->setDefault("naiyou11", $iraikiroku_vw->naiyou11);
            $this->tag->setDefault("bikou1", $iraikiroku_vw->bikou1);
            $this->tag->setDefault("bikou2", $iraikiroku_vw->bikou2);
            $this->tag->setDefault("urisaki", $iraikiroku_vw->urisaki);
            $this->tag->setDefault("urine", $iraikiroku_vw->urine);
            $this->tag->setDefault("shukkameisai", $iraikiroku_vw->shukkameisai);
            $this->tag->setDefault("kanryou", $iraikiroku_vw->kanryou);
            $this->tag->setDefault("gensi_nyuukasaki", $iraikiroku_vw->gensi_nyuukasaki);
            $this->tag->setDefault("sofina_kakoutin", $iraikiroku_vw->sofina_kakoutin);
            $this->tag->setDefault("tanni2", $iraikiroku_vw->tanni2);
            $this->tag->setDefault("seisan_koujoumei", $iraikiroku_vw->seisan_koujoumei);
            $this->tag->setDefault("kishumei", $iraikiroku_vw->kishumei);
            $this->tag->setDefault("bikou", $iraikiroku_vw->bikou);
            
        }
    }

    /**
     * Creates a new iraikiroku_vw
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "iraikiroku_vws",
                'action' => 'index'
            ]);

            return;
        }

        $iraikiroku_vw = new IraikirokuVws();
        $iraikiroku_vw->Kakou_no = $this->request->getPost("kakou_no");
        $iraikiroku_vw->Hakkou_date = $this->request->getPost("hakkou_date");
        $iraikiroku_vw->Kaisha_mei = $this->request->getPost("kaisha_mei");
        $iraikiroku_vw->Sf_tantou = $this->request->getPost("sf_tantou");
        $iraikiroku_vw->Tantou = $this->request->getPost("tantou");
        $iraikiroku_vw->Agari_hinmei = $this->request->getPost("agari_hinmei");
        $iraikiroku_vw->Siyousi = $this->request->getPost("siyousi");
        $iraikiroku_vw->Kakouo_suuryou = $this->request->getPost("kakouo_suuryou");
        $iraikiroku_vw->Tanni = $this->request->getPost("tanni");
        $iraikiroku_vw->Seihin_lot = $this->request->getPost("seihin_lot");
        $iraikiroku_vw->Tanni1 = $this->request->getPost("tanni1");
        $iraikiroku_vw->Nouki = $this->request->getPost("nouki");
        $iraikiroku_vw->Shukkasaki = $this->request->getPost("shukkasaki");
        $iraikiroku_vw->Juusho = $this->request->getPost("juusho");
        $iraikiroku_vw->Tel = $this->request->getPost("tel");
        $iraikiroku_vw->Naiyou1 = $this->request->getPost("naiyou1");
        $iraikiroku_vw->Naiyou2 = $this->request->getPost("naiyou2");
        $iraikiroku_vw->Naiyou3 = $this->request->getPost("naiyou3");
        $iraikiroku_vw->Naiyou4 = $this->request->getPost("naiyou4");
        $iraikiroku_vw->Naiyou5 = $this->request->getPost("naiyou5");
        $iraikiroku_vw->Naiyou6 = $this->request->getPost("naiyou6");
        $iraikiroku_vw->Naiyou7 = $this->request->getPost("naiyou7");
        $iraikiroku_vw->Naiyou8 = $this->request->getPost("naiyou8");
        $iraikiroku_vw->Naiyou9 = $this->request->getPost("naiyou9");
        $iraikiroku_vw->Naiyou10 = $this->request->getPost("naiyou10");
        $iraikiroku_vw->Naiyou11 = $this->request->getPost("naiyou11");
        $iraikiroku_vw->Bikou1 = $this->request->getPost("bikou1");
        $iraikiroku_vw->Bikou2 = $this->request->getPost("bikou2");
        $iraikiroku_vw->Urisaki = $this->request->getPost("urisaki");
        $iraikiroku_vw->Urine = $this->request->getPost("urine");
        $iraikiroku_vw->Shukkameisai = $this->request->getPost("shukkameisai");
        $iraikiroku_vw->Kanryou = $this->request->getPost("kanryou");
        $iraikiroku_vw->Gensi_nyuukasaki = $this->request->getPost("gensi_nyuukasaki");
        $iraikiroku_vw->Sofina_kakoutin = $this->request->getPost("sofina_kakoutin");
        $iraikiroku_vw->Tanni2 = $this->request->getPost("tanni2");
        $iraikiroku_vw->Seisan_koujoumei = $this->request->getPost("seisan_koujoumei");
        $iraikiroku_vw->Kishumei = $this->request->getPost("kishumei");
        $iraikiroku_vw->Bikou = $this->request->getPost("bikou");
        

        if (!$iraikiroku_vw->save()) {
            foreach ($iraikiroku_vw->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "iraikiroku_vws",
                'action' => 'new'
            ]);

            return;
        }

        $this->flash->success("iraikiroku_vw was created successfully");

        $this->dispatcher->forward([
            'controller' => "iraikiroku_vws",
            'action' => 'index'
        ]);
    }

    /**
     * Saves a iraikiroku_vw edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "iraikiroku_vws",
                'action' => 'index'
            ]);

            return;
        }

        $kakou_no = $this->request->getPost("kakou_no");
        $iraikiroku_vw = IraikirokuVws::findFirstBykakou_no($kakou_no);

        if (!$iraikiroku_vw) {
            $this->flash->error("iraikiroku_vw does not exist " . $kakou_no);

            $this->dispatcher->forward([
                'controller' => "iraikiroku_vws",
                'action' => 'index'
            ]);

            return;
        }

        $iraikiroku_vw->Kakou_no = $this->request->getPost("kakou_no");
        $iraikiroku_vw->Hakkou_date = $this->request->getPost("hakkou_date");
        $iraikiroku_vw->Kaisha_mei = $this->request->getPost("kaisha_mei");
        $iraikiroku_vw->Sf_tantou = $this->request->getPost("sf_tantou");
        $iraikiroku_vw->Tantou = $this->request->getPost("tantou");
        $iraikiroku_vw->Agari_hinmei = $this->request->getPost("agari_hinmei");
        $iraikiroku_vw->Siyousi = $this->request->getPost("siyousi");
        $iraikiroku_vw->Kakouo_suuryou = $this->request->getPost("kakouo_suuryou");
        $iraikiroku_vw->Tanni = $this->request->getPost("tanni");
        $iraikiroku_vw->Seihin_lot = $this->request->getPost("seihin_lot");
        $iraikiroku_vw->Tanni1 = $this->request->getPost("tanni1");
        $iraikiroku_vw->Nouki = $this->request->getPost("nouki");
        $iraikiroku_vw->Shukkasaki = $this->request->getPost("shukkasaki");
        $iraikiroku_vw->Juusho = $this->request->getPost("juusho");
        $iraikiroku_vw->Tel = $this->request->getPost("tel");
        $iraikiroku_vw->Naiyou1 = $this->request->getPost("naiyou1");
        $iraikiroku_vw->Naiyou2 = $this->request->getPost("naiyou2");
        $iraikiroku_vw->Naiyou3 = $this->request->getPost("naiyou3");
        $iraikiroku_vw->Naiyou4 = $this->request->getPost("naiyou4");
        $iraikiroku_vw->Naiyou5 = $this->request->getPost("naiyou5");
        $iraikiroku_vw->Naiyou6 = $this->request->getPost("naiyou6");
        $iraikiroku_vw->Naiyou7 = $this->request->getPost("naiyou7");
        $iraikiroku_vw->Naiyou8 = $this->request->getPost("naiyou8");
        $iraikiroku_vw->Naiyou9 = $this->request->getPost("naiyou9");
        $iraikiroku_vw->Naiyou10 = $this->request->getPost("naiyou10");
        $iraikiroku_vw->Naiyou11 = $this->request->getPost("naiyou11");
        $iraikiroku_vw->Bikou1 = $this->request->getPost("bikou1");
        $iraikiroku_vw->Bikou2 = $this->request->getPost("bikou2");
        $iraikiroku_vw->Urisaki = $this->request->getPost("urisaki");
        $iraikiroku_vw->Urine = $this->request->getPost("urine");
        $iraikiroku_vw->Shukkameisai = $this->request->getPost("shukkameisai");
        $iraikiroku_vw->Kanryou = $this->request->getPost("kanryou");
        $iraikiroku_vw->Gensi_nyuukasaki = $this->request->getPost("gensi_nyuukasaki");
        $iraikiroku_vw->Sofina_kakoutin = $this->request->getPost("sofina_kakoutin");
        $iraikiroku_vw->Tanni2 = $this->request->getPost("tanni2");
        $iraikiroku_vw->Seisan_koujoumei = $this->request->getPost("seisan_koujoumei");
        $iraikiroku_vw->Kishumei = $this->request->getPost("kishumei");
        $iraikiroku_vw->Bikou = $this->request->getPost("bikou");
        

        if (!$iraikiroku_vw->save()) {

            foreach ($iraikiroku_vw->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "iraikiroku_vws",
                'action' => 'edit',
                'params' => [$iraikiroku_vw->kakou_no]
            ]);

            return;
        }

        $this->flash->success("iraikiroku_vw was updated successfully");

        $this->dispatcher->forward([
            'controller' => "iraikiroku_vws",
            'action' => 'index'
        ]);
    }

    /**
     * Deletes a iraikiroku_vw
     *
     * @param string $kakou_no
     */
    public function deleteAction($kakou_no)
    {
        $iraikiroku_vw = IraikirokuVws::findFirstBykakou_no($kakou_no);
        if (!$iraikiroku_vw) {
            $this->flash->error("iraikiroku_vw was not found");

            $this->dispatcher->forward([
                'controller' => "iraikiroku_vws",
                'action' => 'index'
            ]);

            return;
        }

        if (!$iraikiroku_vw->delete()) {

            foreach ($iraikiroku_vw->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "iraikiroku_vws",
                'action' => 'search'
            ]);

            return;
        }

        $this->flash->success("iraikiroku_vw was deleted successfully");

        $this->dispatcher->forward([
            'controller' => "iraikiroku_vws",
            'action' => "index"
        ]);
    }

}
