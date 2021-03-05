<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class ShimeTankasDtsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for shime_tankas_dts
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'ShimeTankasDts', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = [];
        }
        $parameters["order"] = "id";

        $shime_tankas_dts = ShimeTankasDts::find($parameters);
        if (count($shime_tankas_dts) == 0) {
            $this->flash->notice("The search did not find any shime_tankas_dts");

            $this->dispatcher->forward([
                "controller" => "shime_tankas_dts",
                "action" => "index"
            ]);

            return;
        }

        $paginator = new Paginator([
            'data' => $shime_tankas_dts,
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
     * Edits a shime_tankas_dt
     *
     * @param string $id
     */
    public function editAction($id)
    {
        if (!$this->request->isPost()) {

            $shime_tankas_dt = ShimeTankasDts::findFirstByid($id);
            if (!$shime_tankas_dt) {
                $this->flash->error("shime_tankas_dt was not found");

                $this->dispatcher->forward([
                    'controller' => "shime_tankas_dts",
                    'action' => 'index'
                ]);

                return;
            }

            $this->view->id = $shime_tankas_dt->id;

            $this->tag->setDefault("id", $shime_tankas_dt->id);
            $this->tag->setDefault("nyuushukkoym", $shime_tankas_dt->nyuushukkoym);
            $this->tag->setDefault("shouhin_mr_cd", $shime_tankas_dt->shouhin_mr_cd);
            $this->tag->setDefault("zengetsu_tanka", $shime_tankas_dt->zengetsu_tanka);
            $this->tag->setDefault("tougetsu_tanka", $shime_tankas_dt->tougetsu_tanka);
            $this->tag->setDefault("tanka_kbn", $shime_tankas_dt->tanka_kbn);
            $this->tag->setDefault("zaiko_hyouka_kbn_cd", $shime_tankas_dt->zaiko_hyouka_kbn_cd);
            
        }
    }

    /**
     * Creates a new shime_tankas_dt
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "shime_tankas_dts",
                'action' => 'index'
            ]);

            return;
        }

        $shime_tankas_dt = new ShimeTankasDts();
        $shime_tankas_dt->nyuushukkoym = $this->request->getPost("nyuushukkoym");
        $shime_tankas_dt->shouhinMrCd = $this->request->getPost("shouhin_mr_cd");
        $shime_tankas_dt->zengetsuTanka = $this->request->getPost("zengetsu_tanka");
        $shime_tankas_dt->tougetsuTanka = $this->request->getPost("tougetsu_tanka");
        $shime_tankas_dt->tankaKbn = $this->request->getPost("tanka_kbn");
        $shime_tankas_dt->zaikoHyoukaKbnCd = $this->request->getPost("zaiko_hyouka_kbn_cd");
        

        if (!$shime_tankas_dt->save()) {
            foreach ($shime_tankas_dt->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "shime_tankas_dts",
                'action' => 'new'
            ]);

            return;
        }

        $this->flash->success("shime_tankas_dt was created successfully");

        $this->dispatcher->forward([
            'controller' => "shime_tankas_dts",
            'action' => 'index'
        ]);
    }

    /**
     * Saves a shime_tankas_dt edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "shime_tankas_dts",
                'action' => 'index'
            ]);

            return;
        }

        $id = $this->request->getPost("id");
        $shime_tankas_dt = ShimeTankasDts::findFirstByid($id);

        if (!$shime_tankas_dt) {
            $this->flash->error("shime_tankas_dt does not exist " . $id);

            $this->dispatcher->forward([
                'controller' => "shime_tankas_dts",
                'action' => 'index'
            ]);

            return;
        }

        $shime_tankas_dt->nyuushukkoym = $this->request->getPost("nyuushukkoym");
        $shime_tankas_dt->shouhinMrCd = $this->request->getPost("shouhin_mr_cd");
        $shime_tankas_dt->zengetsuTanka = $this->request->getPost("zengetsu_tanka");
        $shime_tankas_dt->tougetsuTanka = $this->request->getPost("tougetsu_tanka");
        $shime_tankas_dt->tankaKbn = $this->request->getPost("tanka_kbn");
        $shime_tankas_dt->zaikoHyoukaKbnCd = $this->request->getPost("zaiko_hyouka_kbn_cd");
        

        if (!$shime_tankas_dt->save()) {

            foreach ($shime_tankas_dt->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "shime_tankas_dts",
                'action' => 'edit',
                'params' => [$shime_tankas_dt->id]
            ]);

            return;
        }

        $this->flash->success("shime_tankas_dt was updated successfully");

        $this->dispatcher->forward([
            'controller' => "shime_tankas_dts",
            'action' => 'index'
        ]);
    }

    /**
     * Deletes a shime_tankas_dt
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $shime_tankas_dt = ShimeTankasDts::findFirstByid($id);
        if (!$shime_tankas_dt) {
            $this->flash->error("shime_tankas_dt was not found");

            $this->dispatcher->forward([
                'controller' => "shime_tankas_dts",
                'action' => 'index'
            ]);

            return;
        }

        if (!$shime_tankas_dt->delete()) {

            foreach ($shime_tankas_dt->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "shime_tankas_dts",
                'action' => 'search'
            ]);

            return;
        }

        $this->flash->success("shime_tankas_dt was deleted successfully");

        $this->dispatcher->forward([
            'controller' => "shime_tankas_dts",
            'action' => "index"
        ]);
    }

}
