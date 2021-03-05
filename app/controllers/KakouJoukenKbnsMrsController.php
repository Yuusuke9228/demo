<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class KakouJoukenKbnsMrsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for kakou_jouken_kbns_mrs
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'KakouJoukenKbnsMrs', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = [];
        }
        $parameters["order"] = "id";

        $kakou_jouken_kbns_mrs = KakouJoukenKbnsMrs::find($parameters);
        if (count($kakou_jouken_kbns_mrs) == 0) {
            $this->flash->notice("The search did not find any kakou_jouken_kbns_mrs");

            $this->dispatcher->forward([
                "controller" => "kakou_jouken_kbns_mrs",
                "action" => "index"
            ]);

            return;
        }

        $paginator = new Paginator([
            'data' => $kakou_jouken_kbns_mrs,
            'limit'=> 10,
            'page' => $numberPage
        ]);

        $this->view->page = $paginator->getPaginate();
    }

    /**
     * Displays the creation form
     */
    public function newAction($id = null, $dataname = "KakouJoukenKbns")
    {
        $this->view->imax = 0;

        if ($id) {
            $nameDts = $dataname . "Mrs";
            $kakoujouken_kbns = $nameDts::findFirstByid($id);
            if (!$kakoujouken_kbns) {
                $this->flash->error("加工条件区分が見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "kakou_jouken_kbns_mrs",
                    'action' => 'index'
                ));
                return;
            }
            $this->_setDefault($kakoujouken_kbns, "new", $dataname);
            $this->tag->setDefault("id", null);
            $this->tag->setDefault("cd", null);
        } else {
            if ($this->request->isPost()) {
                $kakoujouken_kbns = new KakouJoukenKbnsMrs();
                $kakoujouken_midasis = [];

                $i = 0;
                foreach ($this->request->getPost() as $postid => $postdt) {
                    if ($postid == 'data') {
                        foreach ($postdt as $meisaitb => $meisairws) {
                            foreach ($meisairws as $meisaiid => $meisaidts) {
                                $kakoujouken_midasis[$i] = new KakouJoukenMidashiMrs();
                                foreach ($meisaidts as $meisaifd => $meisaidt) {
                                    $kakoujouken_midasis[$i]->cd = $i + 1;
                                    $kakoujouken_midasis[$i]->$meisaifd = $meisaidt;
                                }
                                $i++;
                            }
                        }
                    }
                }
                $this->_setDefault($kakoujouken_kbns, "new", $kakoujouken_midasis);
            }
        }

        $this->tag->setDefault("sakusei_user_name", $this->getDI()->getSession()->get('auth')['name']);
        $this->tag->setDefault("updated", null);
    }

    /**
     * Edits a kakou_jouken_kbns_mr
     *
     * @param string $id
     */
    public function editAction($id)
    {
        if (!$this->request->isPost()) {

            $kakou_jouken_kbns_mr = KakouJoukenKbnsMrs::findFirstByid($id);
            if (!$kakou_jouken_kbns_mr) {
                $this->flash->error("kakou_jouken_kbns_mr was not found");

                $this->dispatcher->forward([
                    'controller' => "kakou_jouken_kbns_mrs",
                    'action' => 'index'
                ]);

                return;
            }

            $this->view->id = $kakou_jouken_kbns_mr->id;

            $this->tag->setDefault("id", $kakou_jouken_kbns_mr->id);
            $this->tag->setDefault("cd", $kakou_jouken_kbns_mr->cd);
            $this->tag->setDefault("name", $kakou_jouken_kbns_mr->name);
            $this->tag->setDefault("hikae_dltflg", $kakou_jouken_kbns_mr->hikae_dltflg);
            $this->tag->setDefault("hikae_user_id", $kakou_jouken_kbns_mr->hikae_user_id);
            $this->tag->setDefault("hikae_nichiji", $kakou_jouken_kbns_mr->hikae_nichiji);
            $this->tag->setDefault("sakusei_user_id", $kakou_jouken_kbns_mr->sakusei_user_id);
            $this->tag->setDefault("created", $kakou_jouken_kbns_mr->created);
            $this->tag->setDefault("kousin_user_id", $kakou_jouken_kbns_mr->kousin_user_id);
            $this->tag->setDefault("updated", $kakou_jouken_kbns_mr->updated);
            
        }
    }

    /**
     * Creates a new kakou_jouken_kbns_mr
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "kakou_jouken_kbns_mrs",
                'action' => 'index'
            ]);

            return;
        }

        $kakou_jouken_kbns_mr = new KakouJoukenKbnsMrs();
        $kakou_jouken_kbns_mr->cd = $this->request->getPost("cd");
        $kakou_jouken_kbns_mr->name = $this->request->getPost("name");
        $kakou_jouken_kbns_mr->hikaeDltflg = $this->request->getPost("hikae_dltflg");
        $kakou_jouken_kbns_mr->hikaeUserId = $this->request->getPost("hikae_user_id");
        $kakou_jouken_kbns_mr->hikaeNichiji = $this->request->getPost("hikae_nichiji");
        $kakou_jouken_kbns_mr->sakuseiUserId = $this->request->getPost("sakusei_user_id");
        $kakou_jouken_kbns_mr->created = $this->request->getPost("created");
        $kakou_jouken_kbns_mr->kousinUserId = $this->request->getPost("kousin_user_id");
        $kakou_jouken_kbns_mr->updated = $this->request->getPost("updated");
        

        if (!$kakou_jouken_kbns_mr->save()) {
            foreach ($kakou_jouken_kbns_mr->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "kakou_jouken_kbns_mrs",
                'action' => 'new'
            ]);

            return;
        }

        $this->flash->success("kakou_jouken_kbns_mr was created successfully");

        $this->dispatcher->forward([
            'controller' => "kakou_jouken_kbns_mrs",
            'action' => 'index'
        ]);
    }

    /**
     * Saves a kakou_jouken_kbns_mr edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "kakou_jouken_kbns_mrs",
                'action' => 'index'
            ]);

            return;
        }

        $id = $this->request->getPost("id");
        $kakou_jouken_kbns_mr = KakouJoukenKbnsMrs::findFirstByid($id);

        if (!$kakou_jouken_kbns_mr) {
            $this->flash->error("kakou_jouken_kbns_mr does not exist " . $id);

            $this->dispatcher->forward([
                'controller' => "kakou_jouken_kbns_mrs",
                'action' => 'index'
            ]);

            return;
        }

        $kakou_jouken_kbns_mr->cd = $this->request->getPost("cd");
        $kakou_jouken_kbns_mr->name = $this->request->getPost("name");
        $kakou_jouken_kbns_mr->hikaeDltflg = $this->request->getPost("hikae_dltflg");
        $kakou_jouken_kbns_mr->hikaeUserId = $this->request->getPost("hikae_user_id");
        $kakou_jouken_kbns_mr->hikaeNichiji = $this->request->getPost("hikae_nichiji");
        $kakou_jouken_kbns_mr->sakuseiUserId = $this->request->getPost("sakusei_user_id");
        $kakou_jouken_kbns_mr->created = $this->request->getPost("created");
        $kakou_jouken_kbns_mr->kousinUserId = $this->request->getPost("kousin_user_id");
        $kakou_jouken_kbns_mr->updated = $this->request->getPost("updated");
        

        if (!$kakou_jouken_kbns_mr->save()) {

            foreach ($kakou_jouken_kbns_mr->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "kakou_jouken_kbns_mrs",
                'action' => 'edit',
                'params' => [$kakou_jouken_kbns_mr->id]
            ]);

            return;
        }

        $this->flash->success("kakou_jouken_kbns_mr was updated successfully");

        $this->dispatcher->forward([
            'controller' => "kakou_jouken_kbns_mrs",
            'action' => 'index'
        ]);
    }

    /**
     * Deletes a kakou_jouken_kbns_mr
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $kakou_jouken_kbns_mr = KakouJoukenKbnsMrs::findFirstByid($id);
        if (!$kakou_jouken_kbns_mr) {
            $this->flash->error("kakou_jouken_kbns_mr was not found");

            $this->dispatcher->forward([
                'controller' => "kakou_jouken_kbns_mrs",
                'action' => 'index'
            ]);

            return;
        }

        if (!$kakou_jouken_kbns_mr->delete()) {

            foreach ($kakou_jouken_kbns_mr->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "kakou_jouken_kbns_mrs",
                'action' => 'search'
            ]);

            return;
        }

        $this->flash->success("kakou_jouken_kbns_mr was deleted successfully");

        $this->dispatcher->forward([
            'controller' => "kakou_jouken_kbns_mrs",
            'action' => "index"
        ]);
    }

}
