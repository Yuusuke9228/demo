<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class KakouJoukenMeisaiController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for kakou_jouken_meisai
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'KakouJoukenMeisai', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = [];
        }
        $parameters["order"] = "id";

        $kakou_jouken_meisai = KakouJoukenMeisai::find($parameters);
        if (count($kakou_jouken_meisai) == 0) {
            $this->flash->notice("The search did not find any kakou_jouken_meisai");

            $this->dispatcher->forward([
                "controller" => "kakou_jouken_meisai",
                "action" => "index"
            ]);

            return;
        }

        $paginator = new Paginator([
            'data' => $kakou_jouken_meisai,
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
     * Edits a kakou_jouken_meisai
     *
     * @param string $id
     */
    public function editAction($id)
    {
        if (!$this->request->isPost()) {

            $kakou_jouken_meisai = KakouJoukenMeisai::findFirstByid($id);
            if (!$kakou_jouken_meisai) {
                $this->flash->error("kakou_jouken_meisai was not found");

                $this->dispatcher->forward([
                    'controller' => "kakou_jouken_meisai",
                    'action' => 'index'
                ]);

                return;
            }

            $this->view->id = $kakou_jouken_meisai->id;

            $this->tag->setDefault("id", $kakou_jouken_meisai->id);
            $this->tag->setDefault("cd", $kakou_jouken_meisai->cd);
            $this->tag->setDefault("shouhin_mr_cd", $kakou_jouken_meisai->shouhin_mr_cd);
            $this->tag->setDefault("kakou_jouken_midashi_cd", $kakou_jouken_meisai->kakou_jouken_midashi_cd);
            $this->tag->setDefault("kakou_jouken_kbn_cd", $kakou_jouken_meisai->kakou_jouken_kbn_cd);
            $this->tag->setDefault("naiyou", $kakou_jouken_meisai->naiyou);
            $this->tag->setDefault("version", $kakou_jouken_meisai->version);
            $this->tag->setDefault("hikae_dltflg", $kakou_jouken_meisai->hikae_dltflg);
            $this->tag->setDefault("hikae_user_id", $kakou_jouken_meisai->hikae_user_id);
            $this->tag->setDefault("hikae_nichiji", $kakou_jouken_meisai->hikae_nichiji);
            $this->tag->setDefault("sakusei_user_id", $kakou_jouken_meisai->sakusei_user_id);
            $this->tag->setDefault("created", $kakou_jouken_meisai->created);
            $this->tag->setDefault("kousin_user_id", $kakou_jouken_meisai->kousin_user_id);
            $this->tag->setDefault("updated", $kakou_jouken_meisai->updated);
            
        }
    }

    /**
     * Creates a new kakou_jouken_meisai
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "kakou_jouken_meisai",
                'action' => 'index'
            ]);

            return;
        }

        $kakou_jouken_meisai = new KakouJoukenMeisai();
        $kakou_jouken_meisai->cd = $this->request->getPost("cd");
        $kakou_jouken_meisai->shouhinMrCd = $this->request->getPost("shouhin_mr_cd");
        $kakou_jouken_meisai->kakouJoukenMidashiCd = $this->request->getPost("kakou_jouken_midashi_cd");
        $kakou_jouken_meisai->kakouJoukenKbnCd = $this->request->getPost("kakou_jouken_kbn_cd");
        $kakou_jouken_meisai->naiyou = $this->request->getPost("naiyou");
        $kakou_jouken_meisai->version = $this->request->getPost("version");
        $kakou_jouken_meisai->hikaeDltflg = $this->request->getPost("hikae_dltflg");
        $kakou_jouken_meisai->hikaeUserId = $this->request->getPost("hikae_user_id");
        $kakou_jouken_meisai->hikaeNichiji = $this->request->getPost("hikae_nichiji");
        $kakou_jouken_meisai->sakuseiUserId = $this->request->getPost("sakusei_user_id");
        $kakou_jouken_meisai->created = $this->request->getPost("created");
        $kakou_jouken_meisai->kousinUserId = $this->request->getPost("kousin_user_id");
        $kakou_jouken_meisai->updated = $this->request->getPost("updated");
        

        if (!$kakou_jouken_meisai->save()) {
            foreach ($kakou_jouken_meisai->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "kakou_jouken_meisai",
                'action' => 'new'
            ]);

            return;
        }

        $this->flash->success("kakou_jouken_meisai was created successfully");

        $this->dispatcher->forward([
            'controller' => "kakou_jouken_meisai",
            'action' => 'index'
        ]);
    }

    /**
     * Saves a kakou_jouken_meisai edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "kakou_jouken_meisai",
                'action' => 'index'
            ]);

            return;
        }

        $id = $this->request->getPost("id");
        $kakou_jouken_meisai = KakouJoukenMeisai::findFirstByid($id);

        if (!$kakou_jouken_meisai) {
            $this->flash->error("kakou_jouken_meisai does not exist " . $id);

            $this->dispatcher->forward([
                'controller' => "kakou_jouken_meisai",
                'action' => 'index'
            ]);

            return;
        }

        $kakou_jouken_meisai->cd = $this->request->getPost("cd");
        $kakou_jouken_meisai->shouhinMrCd = $this->request->getPost("shouhin_mr_cd");
        $kakou_jouken_meisai->kakouJoukenMidashiCd = $this->request->getPost("kakou_jouken_midashi_cd");
        $kakou_jouken_meisai->kakouJoukenKbnCd = $this->request->getPost("kakou_jouken_kbn_cd");
        $kakou_jouken_meisai->naiyou = $this->request->getPost("naiyou");
        $kakou_jouken_meisai->version = $this->request->getPost("version");
        $kakou_jouken_meisai->hikaeDltflg = $this->request->getPost("hikae_dltflg");
        $kakou_jouken_meisai->hikaeUserId = $this->request->getPost("hikae_user_id");
        $kakou_jouken_meisai->hikaeNichiji = $this->request->getPost("hikae_nichiji");
        $kakou_jouken_meisai->sakuseiUserId = $this->request->getPost("sakusei_user_id");
        $kakou_jouken_meisai->created = $this->request->getPost("created");
        $kakou_jouken_meisai->kousinUserId = $this->request->getPost("kousin_user_id");
        $kakou_jouken_meisai->updated = $this->request->getPost("updated");
        

        if (!$kakou_jouken_meisai->save()) {

            foreach ($kakou_jouken_meisai->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "kakou_jouken_meisai",
                'action' => 'edit',
                'params' => [$kakou_jouken_meisai->id]
            ]);

            return;
        }

        $this->flash->success("kakou_jouken_meisai was updated successfully");

        $this->dispatcher->forward([
            'controller' => "kakou_jouken_meisai",
            'action' => 'index'
        ]);
    }

    /**
     * Deletes a kakou_jouken_meisai
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $kakou_jouken_meisai = KakouJoukenMeisai::findFirstByid($id);
        if (!$kakou_jouken_meisai) {
            $this->flash->error("kakou_jouken_meisai was not found");

            $this->dispatcher->forward([
                'controller' => "kakou_jouken_meisai",
                'action' => 'index'
            ]);

            return;
        }

        if (!$kakou_jouken_meisai->delete()) {

            foreach ($kakou_jouken_meisai->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "kakou_jouken_meisai",
                'action' => 'search'
            ]);

            return;
        }

        $this->flash->success("kakou_jouken_meisai was deleted successfully");

        $this->dispatcher->forward([
            'controller' => "kakou_jouken_meisai",
            'action' => "index"
        ]);
    }

}
