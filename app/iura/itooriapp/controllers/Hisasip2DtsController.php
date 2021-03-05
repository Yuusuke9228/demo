<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class Hisasip2DtsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for hisasip2_dts
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'Hisasip2Dts', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = [];
        }
        $parameters["order"] = "指図番号2";

        $hisasip2_dts = Hisasip2Dts::find($parameters);
        if (count($hisasip2_dts) == 0) {
            $this->flash->notice("The search did not find any hisasip2_dts");

            $this->dispatcher->forward([
                "controller" => "hisasip2_dts",
                "action" => "index"
            ]);

            return;
        }

        $paginator = new Paginator([
            'data' => $hisasip2_dts,
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
     * Edits a hisasip2_dt
     *
     * @param string $指図番号2
     */
    public function editAction($指図番号2)
    {
        if (!$this->request->isPost()) {

            $hisasip2_dt = Hisasip2Dts::findFirstBy指図番号2($指図番号2);
            if (!$hisasip2_dt) {
                $this->flash->error("hisasip2_dt was not found");

                $this->dispatcher->forward([
                    'controller' => "hisasip2_dts",
                    'action' => 'index'
                ]);

                return;
            }

            $this->view->指図番号2 = $hisasip2_dt->指図番号2;

            $this->tag->setDefault("指図番号2", $hisasip2_dt->指図番号2);
            $this->tag->setDefault("指図本数", $hisasip2_dt->指図本数);
            $this->tag->setDefault("合格本数", $hisasip2_dt->合格本数);
            $this->tag->setDefault("小玉本数", $hisasip2_dt->小玉本数);
            $this->tag->setDefault("納品本数", $hisasip2_dt->納品本数);
            $this->tag->setDefault("ワインダ行", $hisasip2_dt->ワインダ行);
            $this->tag->setDefault("小玉量", $hisasip2_dt->小玉量);
            $this->tag->setDefault("指図量", $hisasip2_dt->指図量);
            $this->tag->setDefault("生産量", $hisasip2_dt->生産量);
            $this->tag->setDefault("納品量", $hisasip2_dt->納品量);
            $this->tag->setDefault("先造り指図分", $hisasip2_dt->先造り指図分);
            $this->tag->setDefault("フリー払出量", $hisasip2_dt->フリー払出量);
            $this->tag->setDefault("在庫調整量", $hisasip2_dt->在庫調整量);
            $this->tag->setDefault("空白", $hisasip2_dt->空白);
            
        }
    }

    /**
     * Creates a new hisasip2_dt
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "hisasip2_dts",
                'action' => 'index'
            ]);

            return;
        }

        $hisasip2_dt = new Hisasip2Dts();
        $hisasip2_dt->指図番号2 = $this->request->getPost("指図番号2");
        $hisasip2_dt->指図本数 = $this->request->getPost("指図本数");
        $hisasip2_dt->合格本数 = $this->request->getPost("合格本数");
        $hisasip2_dt->小玉本数 = $this->request->getPost("小玉本数");
        $hisasip2_dt->納品本数 = $this->request->getPost("納品本数");
        $hisasip2_dt->ワインダ行 = $this->request->getPost("ワインダ行");
        $hisasip2_dt->小玉量 = $this->request->getPost("小玉量");
        $hisasip2_dt->指図量 = $this->request->getPost("指図量");
        $hisasip2_dt->生産量 = $this->request->getPost("生産量");
        $hisasip2_dt->納品量 = $this->request->getPost("納品量");
        $hisasip2_dt->先造り指図分 = $this->request->getPost("先造り指図分");
        $hisasip2_dt->フリー払出量 = $this->request->getPost("フリー払出量");
        $hisasip2_dt->在庫調整量 = $this->request->getPost("在庫調整量");
        $hisasip2_dt->空白 = $this->request->getPost("空白");
        

        if (!$hisasip2_dt->save()) {
            foreach ($hisasip2_dt->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "hisasip2_dts",
                'action' => 'new'
            ]);

            return;
        }

        $this->flash->success("hisasip2_dt was created successfully");

        $this->dispatcher->forward([
            'controller' => "hisasip2_dts",
            'action' => 'index'
        ]);
    }

    /**
     * Saves a hisasip2_dt edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "hisasip2_dts",
                'action' => 'index'
            ]);

            return;
        }

        $指図番号2 = $this->request->getPost("指図番号2");
        $hisasip2_dt = Hisasip2Dts::findFirstBy指図番号2($指図番号2);

        if (!$hisasip2_dt) {
            $this->flash->error("hisasip2_dt does not exist " . $指図番号2);

            $this->dispatcher->forward([
                'controller' => "hisasip2_dts",
                'action' => 'index'
            ]);

            return;
        }

        $hisasip2_dt->指図番号2 = $this->request->getPost("指図番号2");
        $hisasip2_dt->指図本数 = $this->request->getPost("指図本数");
        $hisasip2_dt->合格本数 = $this->request->getPost("合格本数");
        $hisasip2_dt->小玉本数 = $this->request->getPost("小玉本数");
        $hisasip2_dt->納品本数 = $this->request->getPost("納品本数");
        $hisasip2_dt->ワインダ行 = $this->request->getPost("ワインダ行");
        $hisasip2_dt->小玉量 = $this->request->getPost("小玉量");
        $hisasip2_dt->指図量 = $this->request->getPost("指図量");
        $hisasip2_dt->生産量 = $this->request->getPost("生産量");
        $hisasip2_dt->納品量 = $this->request->getPost("納品量");
        $hisasip2_dt->先造り指図分 = $this->request->getPost("先造り指図分");
        $hisasip2_dt->フリー払出量 = $this->request->getPost("フリー払出量");
        $hisasip2_dt->在庫調整量 = $this->request->getPost("在庫調整量");
        $hisasip2_dt->空白 = $this->request->getPost("空白");
        

        if (!$hisasip2_dt->save()) {

            foreach ($hisasip2_dt->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "hisasip2_dts",
                'action' => 'edit',
                'params' => [$hisasip2_dt->指図番号2]
            ]);

            return;
        }

        $this->flash->success("hisasip2_dt was updated successfully");

        $this->dispatcher->forward([
            'controller' => "hisasip2_dts",
            'action' => 'index'
        ]);
    }

    /**
     * Deletes a hisasip2_dt
     *
     * @param string $指図番号2
     */
    public function deleteAction($指図番号2)
    {
        $hisasip2_dt = Hisasip2Dts::findFirstBy指図番号2($指図番号2);
        if (!$hisasip2_dt) {
            $this->flash->error("hisasip2_dt was not found");

            $this->dispatcher->forward([
                'controller' => "hisasip2_dts",
                'action' => 'index'
            ]);

            return;
        }

        if (!$hisasip2_dt->delete()) {

            foreach ($hisasip2_dt->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "hisasip2_dts",
                'action' => 'search'
            ]);

            return;
        }

        $this->flash->success("hisasip2_dt was deleted successfully");

        $this->dispatcher->forward([
            'controller' => "hisasip2_dts",
            'action' => "index"
        ]);
    }

}
