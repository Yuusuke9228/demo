<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class Hisasip1DtsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for hisasip1_dts
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'Hisasip1Dts', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = [];
        }
        $parameters["order"] = "整経番号";

        $hisasip1_dts = Hisasip1Dts::find($parameters);
        if (count($hisasip1_dts) == 0) {
            $this->flash->notice("The search did not find any hisasip1_dts");

            $this->dispatcher->forward([
                "controller" => "hisasip1_dts",
                "action" => "index"
            ]);

            return;
        }

        $paginator = new Paginator([
            'data' => $hisasip1_dts,
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
     * Edits a hisasip1_dt
     *
     * @param string $整経番号
     */
    public function editAction($整経番号)
    {
        if (!$this->request->isPost()) {

            $hisasip1_dt = Hisasip1Dts::findFirstBy整経番号($整経番号);
            if (!$hisasip1_dt) {
                $this->flash->error("hisasip1_dt was not found");

                $this->dispatcher->forward([
                    'controller' => "hisasip1_dts",
                    'action' => 'index'
                ]);

                return;
            }

            $this->view->整経番号 = $hisasip1_dt->整経番号;

            $this->tag->setDefault("整経番号", $hisasip1_dt->整経番号);
            $this->tag->setDefault("分解番号", $hisasip1_dt->分解番号);
            $this->tag->setDefault("指図順", $hisasip1_dt->指図順);
            $this->tag->setDefault("指図番号", $hisasip1_dt->指図番号);
            $this->tag->setDefault("備考", $hisasip1_dt->備考);
            $this->tag->setDefault("ワインダ区分", $hisasip1_dt->ワインダ区分);
            $this->tag->setDefault("ボビン色", $hisasip1_dt->ボビン色);
            $this->tag->setDefault("完了区分", $hisasip1_dt->完了区分);
            $this->tag->setDefault("確定指図区分", $hisasip1_dt->確定指図区分);
            $this->tag->setDefault("糸機種", $hisasip1_dt->糸機種);
            $this->tag->setDefault("工場", $hisasip1_dt->工場);
            $this->tag->setDefault("糸種", $hisasip1_dt->糸種);
            $this->tag->setDefault("コード", $hisasip1_dt->コード);
            $this->tag->setDefault("生産開始", $hisasip1_dt->生産開始);
            $this->tag->setDefault("生産完了", $hisasip1_dt->生産完了);
            $this->tag->setDefault("直撚り区分", $hisasip1_dt->直撚り区分);
            $this->tag->setDefault("色付け", $hisasip1_dt->色付け);
            $this->tag->setDefault("真空セット", $hisasip1_dt->真空セット);
            
        }
    }

    /**
     * Creates a new hisasip1_dt
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "hisasip1_dts",
                'action' => 'index'
            ]);

            return;
        }

        $hisasip1_dt = new Hisasip1Dts();
        $hisasip1_dt->整経番号 = $this->request->getPost("整経番号");
        $hisasip1_dt->分解番号 = $this->request->getPost("分解番号");
        $hisasip1_dt->指図順 = $this->request->getPost("指図順");
        $hisasip1_dt->指図番号 = $this->request->getPost("指図番号");
        $hisasip1_dt->備考 = $this->request->getPost("備考");
        $hisasip1_dt->ワインダ区分 = $this->request->getPost("ワインダ区分");
        $hisasip1_dt->ボビン色 = $this->request->getPost("ボビン色");
        $hisasip1_dt->完了区分 = $this->request->getPost("完了区分");
        $hisasip1_dt->確定指図区分 = $this->request->getPost("確定指図区分");
        $hisasip1_dt->糸機種 = $this->request->getPost("糸機種");
        $hisasip1_dt->工場 = $this->request->getPost("工場");
        $hisasip1_dt->糸種 = $this->request->getPost("糸種");
        $hisasip1_dt->コード = $this->request->getPost("コード");
        $hisasip1_dt->生産開始 = $this->request->getPost("生産開始");
        $hisasip1_dt->生産完了 = $this->request->getPost("生産完了");
        $hisasip1_dt->直撚り区分 = $this->request->getPost("直撚り区分");
        $hisasip1_dt->色付け = $this->request->getPost("色付け");
        $hisasip1_dt->真空セット = $this->request->getPost("真空セット");
        

        if (!$hisasip1_dt->save()) {
            foreach ($hisasip1_dt->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "hisasip1_dts",
                'action' => 'new'
            ]);

            return;
        }

        $this->flash->success("hisasip1_dt was created successfully");

        $this->dispatcher->forward([
            'controller' => "hisasip1_dts",
            'action' => 'index'
        ]);
    }

    /**
     * Saves a hisasip1_dt edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "hisasip1_dts",
                'action' => 'index'
            ]);

            return;
        }

        $整経番号 = $this->request->getPost("整経番号");
        $hisasip1_dt = Hisasip1Dts::findFirstBy整経番号($整経番号);

        if (!$hisasip1_dt) {
            $this->flash->error("hisasip1_dt does not exist " . $整経番号);

            $this->dispatcher->forward([
                'controller' => "hisasip1_dts",
                'action' => 'index'
            ]);

            return;
        }

        $hisasip1_dt->整経番号 = $this->request->getPost("整経番号");
        $hisasip1_dt->分解番号 = $this->request->getPost("分解番号");
        $hisasip1_dt->指図順 = $this->request->getPost("指図順");
        $hisasip1_dt->指図番号 = $this->request->getPost("指図番号");
        $hisasip1_dt->備考 = $this->request->getPost("備考");
        $hisasip1_dt->ワインダ区分 = $this->request->getPost("ワインダ区分");
        $hisasip1_dt->ボビン色 = $this->request->getPost("ボビン色");
        $hisasip1_dt->完了区分 = $this->request->getPost("完了区分");
        $hisasip1_dt->確定指図区分 = $this->request->getPost("確定指図区分");
        $hisasip1_dt->糸機種 = $this->request->getPost("糸機種");
        $hisasip1_dt->工場 = $this->request->getPost("工場");
        $hisasip1_dt->糸種 = $this->request->getPost("糸種");
        $hisasip1_dt->コード = $this->request->getPost("コード");
        $hisasip1_dt->生産開始 = $this->request->getPost("生産開始");
        $hisasip1_dt->生産完了 = $this->request->getPost("生産完了");
        $hisasip1_dt->直撚り区分 = $this->request->getPost("直撚り区分");
        $hisasip1_dt->色付け = $this->request->getPost("色付け");
        $hisasip1_dt->真空セット = $this->request->getPost("真空セット");
        

        if (!$hisasip1_dt->save()) {

            foreach ($hisasip1_dt->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "hisasip1_dts",
                'action' => 'edit',
                'params' => [$hisasip1_dt->整経番号]
            ]);

            return;
        }

        $this->flash->success("hisasip1_dt was updated successfully");

        $this->dispatcher->forward([
            'controller' => "hisasip1_dts",
            'action' => 'index'
        ]);
    }

    /**
     * Deletes a hisasip1_dt
     *
     * @param string $整経番号
     */
    public function deleteAction($整経番号)
    {
        $hisasip1_dt = Hisasip1Dts::findFirstBy整経番号($整経番号);
        if (!$hisasip1_dt) {
            $this->flash->error("hisasip1_dt was not found");

            $this->dispatcher->forward([
                'controller' => "hisasip1_dts",
                'action' => 'index'
            ]);

            return;
        }

        if (!$hisasip1_dt->delete()) {

            foreach ($hisasip1_dt->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "hisasip1_dts",
                'action' => 'search'
            ]);

            return;
        }

        $this->flash->success("hisasip1_dt was deleted successfully");

        $this->dispatcher->forward([
            'controller' => "hisasip1_dts",
            'action' => "index"
        ]);
    }

}
