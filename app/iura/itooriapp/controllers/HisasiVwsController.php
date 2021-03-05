<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class HisasiVwsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for hisasi_vws
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'HisasiVws', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = [];
        }
        $parameters["order"] = "seikei_no";

        $hisasi_vws = HisasiVws::find($parameters);
        if (count($hisasi_vws) == 0) {
            $this->flash->notice("The search did not find any hisasi_vws");

            $this->dispatcher->forward([
                "controller" => "hisasi_vws",
                "action" => "index"
            ]);

            return;
        }

        $paginator = new Paginator([
            'data' => $hisasi_vws,
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
     * Edits a hisasi_vw
     *
     * @param string $seikei_no
     */
    public function editAction($seikei_no)
    {
        if (!$this->request->isPost()) {

            $hisasi_vw = HisasiVws::findFirstByseikei_no($seikei_no);
            if (!$hisasi_vw) {
                $this->flash->error("hisasi_vw was not found");

                $this->dispatcher->forward([
                    'controller' => "hisasi_vws",
                    'action' => 'index'
                ]);

                return;
            }

            $this->view->seikei_no = $hisasi_vw->seikei_no;

            $this->tag->setDefault("seikei_no", $hisasi_vw->seikei_no);
            $this->tag->setDefault("bunkai_no", $hisasi_vw->bunkai_no);
            $this->tag->setDefault("sasizu_jun", $hisasi_vw->sasizu_jun);
            $this->tag->setDefault("sasizu_no", $hisasi_vw->sasizu_no);
            $this->tag->setDefault("bikou", $hisasi_vw->bikou);
            $this->tag->setDefault("winder_kbn", $hisasi_vw->winder_kbn);
            $this->tag->setDefault("bobin_iro", $hisasi_vw->bobin_iro);
            $this->tag->setDefault("kanryou_kbn", $hisasi_vw->kanryou_kbn);
            $this->tag->setDefault("kakutei_kbn", $hisasi_vw->kakutei_kbn);
            $this->tag->setDefault("kishu", $hisasi_vw->kishu);
            $this->tag->setDefault("koujou", $hisasi_vw->koujou);
            $this->tag->setDefault("itoshu", $hisasi_vw->itoshu);
            $this->tag->setDefault("ito_code", $hisasi_vw->ito_code);
            $this->tag->setDefault("seisan_kaishi", $hisasi_vw->seisan_kaishi);
            $this->tag->setDefault("seisan_kanryou", $hisasi_vw->seisan_kanryou);
            $this->tag->setDefault("tyokuyori_kbn", $hisasi_vw->tyokuyori_kbn);
            $this->tag->setDefault("irotuke", $hisasi_vw->irotuke);
            $this->tag->setDefault("shinkuu_set", $hisasi_vw->shinkuu_set);
            $this->tag->setDefault("sasizu_no2", $hisasi_vw->sasizu_no2);
            $this->tag->setDefault("sasizu_honsuu", $hisasi_vw->sasizu_honsuu);
            $this->tag->setDefault("goukaku_honsuu", $hisasi_vw->goukaku_honsuu);
            $this->tag->setDefault("kodama_honsuu", $hisasi_vw->kodama_honsuu);
            $this->tag->setDefault("nouhin_honsuu", $hisasi_vw->nouhin_honsuu);
            $this->tag->setDefault("winder_yuki", $hisasi_vw->winder_yuki);
            $this->tag->setDefault("kodama_ryou", $hisasi_vw->kodama_ryou);
            $this->tag->setDefault("sasizu_ryou", $hisasi_vw->sasizu_ryou);
            $this->tag->setDefault("seisan_ryou", $hisasi_vw->seisan_ryou);
            $this->tag->setDefault("nouhin_ryou", $hisasi_vw->nouhin_ryou);
            $this->tag->setDefault("sakizukuri", $hisasi_vw->sakizukuri);
            $this->tag->setDefault("free_haraidasi_ryou", $hisasi_vw->free_haraidasi_ryou);
            $this->tag->setDefault("zaiko_tyousei_ryou", $hisasi_vw->zaiko_tyousei_ryou);
            $this->tag->setDefault("kuuhaku", $hisasi_vw->kuuhaku);
            
        }
    }

    /**
     * Creates a new hisasi_vw
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "hisasi_vws",
                'action' => 'index'
            ]);

            return;
        }

        $hisasi_vw = new HisasiVws();
        $hisasi_vw->Seikei_no = $this->request->getPost("seikei_no");
        $hisasi_vw->Bunkai_no = $this->request->getPost("bunkai_no");
        $hisasi_vw->Sasizu_jun = $this->request->getPost("sasizu_jun");
        $hisasi_vw->Sasizu_no = $this->request->getPost("sasizu_no");
        $hisasi_vw->Bikou = $this->request->getPost("bikou");
        $hisasi_vw->Winder_kbn = $this->request->getPost("winder_kbn");
        $hisasi_vw->Bobin_iro = $this->request->getPost("bobin_iro");
        $hisasi_vw->Kanryou_kbn = $this->request->getPost("kanryou_kbn");
        $hisasi_vw->Kakutei_kbn = $this->request->getPost("kakutei_kbn");
        $hisasi_vw->Kishu = $this->request->getPost("kishu");
        $hisasi_vw->Koujou = $this->request->getPost("koujou");
        $hisasi_vw->Itoshu = $this->request->getPost("itoshu");
        $hisasi_vw->Ito_code = $this->request->getPost("ito_code");
        $hisasi_vw->Seisan_kaishi = $this->request->getPost("seisan_kaishi");
        $hisasi_vw->Seisan_kanryou = $this->request->getPost("seisan_kanryou");
        $hisasi_vw->Tyokuyori_kbn = $this->request->getPost("tyokuyori_kbn");
        $hisasi_vw->Irotuke = $this->request->getPost("irotuke");
        $hisasi_vw->Shinkuu_set = $this->request->getPost("shinkuu_set");
        $hisasi_vw->Sasizu_no2 = $this->request->getPost("sasizu_no2");
        $hisasi_vw->Sasizu_honsuu = $this->request->getPost("sasizu_honsuu");
        $hisasi_vw->Goukaku_honsuu = $this->request->getPost("goukaku_honsuu");
        $hisasi_vw->Kodama_honsuu = $this->request->getPost("kodama_honsuu");
        $hisasi_vw->Nouhin_honsuu = $this->request->getPost("nouhin_honsuu");
        $hisasi_vw->Winder_yuki = $this->request->getPost("winder_yuki");
        $hisasi_vw->Kodama_ryou = $this->request->getPost("kodama_ryou");
        $hisasi_vw->Sasizu_ryou = $this->request->getPost("sasizu_ryou");
        $hisasi_vw->Seisan_ryou = $this->request->getPost("seisan_ryou");
        $hisasi_vw->Nouhin_ryou = $this->request->getPost("nouhin_ryou");
        $hisasi_vw->Sakizukuri = $this->request->getPost("sakizukuri");
        $hisasi_vw->Free_haraidasi_ryou = $this->request->getPost("free_haraidasi_ryou");
        $hisasi_vw->Zaiko_tyousei_ryou = $this->request->getPost("zaiko_tyousei_ryou");
        $hisasi_vw->Kuuhaku = $this->request->getPost("kuuhaku");
        

        if (!$hisasi_vw->save()) {
            foreach ($hisasi_vw->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "hisasi_vws",
                'action' => 'new'
            ]);

            return;
        }

        $this->flash->success("hisasi_vw was created successfully");

        $this->dispatcher->forward([
            'controller' => "hisasi_vws",
            'action' => 'index'
        ]);
    }

    /**
     * Saves a hisasi_vw edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "hisasi_vws",
                'action' => 'index'
            ]);

            return;
        }

        $seikei_no = $this->request->getPost("seikei_no");
        $hisasi_vw = HisasiVws::findFirstByseikei_no($seikei_no);

        if (!$hisasi_vw) {
            $this->flash->error("hisasi_vw does not exist " . $seikei_no);

            $this->dispatcher->forward([
                'controller' => "hisasi_vws",
                'action' => 'index'
            ]);

            return;
        }

        $hisasi_vw->Seikei_no = $this->request->getPost("seikei_no");
        $hisasi_vw->Bunkai_no = $this->request->getPost("bunkai_no");
        $hisasi_vw->Sasizu_jun = $this->request->getPost("sasizu_jun");
        $hisasi_vw->Sasizu_no = $this->request->getPost("sasizu_no");
        $hisasi_vw->Bikou = $this->request->getPost("bikou");
        $hisasi_vw->Winder_kbn = $this->request->getPost("winder_kbn");
        $hisasi_vw->Bobin_iro = $this->request->getPost("bobin_iro");
        $hisasi_vw->Kanryou_kbn = $this->request->getPost("kanryou_kbn");
        $hisasi_vw->Kakutei_kbn = $this->request->getPost("kakutei_kbn");
        $hisasi_vw->Kishu = $this->request->getPost("kishu");
        $hisasi_vw->Koujou = $this->request->getPost("koujou");
        $hisasi_vw->Itoshu = $this->request->getPost("itoshu");
        $hisasi_vw->Ito_code = $this->request->getPost("ito_code");
        $hisasi_vw->Seisan_kaishi = $this->request->getPost("seisan_kaishi");
        $hisasi_vw->Seisan_kanryou = $this->request->getPost("seisan_kanryou");
        $hisasi_vw->Tyokuyori_kbn = $this->request->getPost("tyokuyori_kbn");
        $hisasi_vw->Irotuke = $this->request->getPost("irotuke");
        $hisasi_vw->Shinkuu_set = $this->request->getPost("shinkuu_set");
        $hisasi_vw->Sasizu_no2 = $this->request->getPost("sasizu_no2");
        $hisasi_vw->Sasizu_honsuu = $this->request->getPost("sasizu_honsuu");
        $hisasi_vw->Goukaku_honsuu = $this->request->getPost("goukaku_honsuu");
        $hisasi_vw->Kodama_honsuu = $this->request->getPost("kodama_honsuu");
        $hisasi_vw->Nouhin_honsuu = $this->request->getPost("nouhin_honsuu");
        $hisasi_vw->Winder_yuki = $this->request->getPost("winder_yuki");
        $hisasi_vw->Kodama_ryou = $this->request->getPost("kodama_ryou");
        $hisasi_vw->Sasizu_ryou = $this->request->getPost("sasizu_ryou");
        $hisasi_vw->Seisan_ryou = $this->request->getPost("seisan_ryou");
        $hisasi_vw->Nouhin_ryou = $this->request->getPost("nouhin_ryou");
        $hisasi_vw->Sakizukuri = $this->request->getPost("sakizukuri");
        $hisasi_vw->Free_haraidasi_ryou = $this->request->getPost("free_haraidasi_ryou");
        $hisasi_vw->Zaiko_tyousei_ryou = $this->request->getPost("zaiko_tyousei_ryou");
        $hisasi_vw->Kuuhaku = $this->request->getPost("kuuhaku");
        

        if (!$hisasi_vw->save()) {

            foreach ($hisasi_vw->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "hisasi_vws",
                'action' => 'edit',
                'params' => [$hisasi_vw->seikei_no]
            ]);

            return;
        }

        $this->flash->success("hisasi_vw was updated successfully");

        $this->dispatcher->forward([
            'controller' => "hisasi_vws",
            'action' => 'index'
        ]);
    }

    /**
     * Deletes a hisasi_vw
     *
     * @param string $seikei_no
     */
    public function deleteAction($seikei_no)
    {
        $hisasi_vw = HisasiVws::findFirstByseikei_no($seikei_no);
        if (!$hisasi_vw) {
            $this->flash->error("hisasi_vw was not found");

            $this->dispatcher->forward([
                'controller' => "hisasi_vws",
                'action' => 'index'
            ]);

            return;
        }

        if (!$hisasi_vw->delete()) {

            foreach ($hisasi_vw->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "hisasi_vws",
                'action' => 'search'
            ]);

            return;
        }

        $this->flash->success("hisasi_vw was deleted successfully");

        $this->dispatcher->forward([
            'controller' => "hisasi_vws",
            'action' => "index"
        ]);
    }

}
