<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class KakouJoukenMidashiMrsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for kakou_jouken_midashi_mrs
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'KakouJoukenMidashiMrs', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = [];
        }
        $parameters["order"] = "id";

        $kakou_jouken_midashi_mrs = KakouJoukenMidashiMrs::find($parameters);
        if (count($kakou_jouken_midashi_mrs) == 0) {
            $this->flash->notice("The search did not find any kakou_jouken_midashi_mrs");

            $this->dispatcher->forward([
                "controller" => "kakou_jouken_midashi_mrs",
                "action" => "index"
            ]);

            return;
        }

        $paginator = new Paginator([
            'data' => $kakou_jouken_midashi_mrs,
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
     * Edits a kakou_jouken_midashi_mr
     *
     * @param string $id
     */
    public function editAction($id)
    {
        if (!$this->request->isPost()) {

            $kakou_jouken_midashi_mr = KakouJoukenMidashiMrs::findFirstByid($id);
            if (!$kakou_jouken_midashi_mr) {
                $this->flash->error("kakou_jouken_midashi_mr was not found");

                $this->dispatcher->forward([
                    'controller' => "kakou_jouken_midashi_mrs",
                    'action' => 'index'
                ]);

                return;
            }

            $this->view->id = $kakou_jouken_midashi_mr->id;

            $this->tag->setDefault("id", $kakou_jouken_midashi_mr->id);
            $this->tag->setDefault("cd", $kakou_jouken_midashi_mr->cd);
            $this->tag->setDefault("name", $kakou_jouken_midashi_mr->name);
            $this->tag->setDefault("suuti_flg", $kakou_jouken_midashi_mr->suuti_flg);
            $this->tag->setDefault("kakou_jouken_kbn_cd", $kakou_jouken_midashi_mr->kakou_jouken_kbn_cd);
            $this->tag->setDefault("hikae_dltflg", $kakou_jouken_midashi_mr->hikae_dltflg);
            $this->tag->setDefault("hikae_user_id", $kakou_jouken_midashi_mr->hikae_user_id);
            $this->tag->setDefault("hikae_nichiji", $kakou_jouken_midashi_mr->hikae_nichiji);
            $this->tag->setDefault("sakusei_user_id", $kakou_jouken_midashi_mr->sakusei_user_id);
            $this->tag->setDefault("created", $kakou_jouken_midashi_mr->created);
            $this->tag->setDefault("kousin_user_id", $kakou_jouken_midashi_mr->kousin_user_id);
            $this->tag->setDefault("updated", $kakou_jouken_midashi_mr->updated);
            
        }
    }

    /**
     * Creates a new kakou_jouken_midashi_mr
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "kakou_jouken_midashi_mrs",
                'action' => 'index'
            ]);

            return;
        }

        $kakou_jouken_midashi_mr = new KakouJoukenMidashiMrs();
        $kakou_jouken_midashi_mr->cd = $this->request->getPost("cd");
        $kakou_jouken_midashi_mr->name = $this->request->getPost("name");
        $kakou_jouken_midashi_mr->suutiFlg = $this->request->getPost("suuti_flg");
        $kakou_jouken_midashi_mr->kakouJoukenKbnCd = $this->request->getPost("kakou_jouken_kbn_cd");
        $kakou_jouken_midashi_mr->hikaeDltflg = $this->request->getPost("hikae_dltflg");
        $kakou_jouken_midashi_mr->hikaeUserId = $this->request->getPost("hikae_user_id");
        $kakou_jouken_midashi_mr->hikaeNichiji = $this->request->getPost("hikae_nichiji");
        $kakou_jouken_midashi_mr->sakuseiUserId = $this->request->getPost("sakusei_user_id");
        $kakou_jouken_midashi_mr->created = $this->request->getPost("created");
        $kakou_jouken_midashi_mr->kousinUserId = $this->request->getPost("kousin_user_id");
        $kakou_jouken_midashi_mr->updated = $this->request->getPost("updated");
        

        if (!$kakou_jouken_midashi_mr->save()) {
            foreach ($kakou_jouken_midashi_mr->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "kakou_jouken_midashi_mrs",
                'action' => 'new'
            ]);

            return;
        }

        $this->flash->success("kakou_jouken_midashi_mr was created successfully");

        $this->dispatcher->forward([
            'controller' => "kakou_jouken_midashi_mrs",
            'action' => 'index'
        ]);
    }

    /**
     * Saves a kakou_jouken_midashi_mr edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "kakou_jouken_midashi_mrs",
                'action' => 'index'
            ]);

            return;
        }

        $id = $this->request->getPost("id");
        $kakou_jouken_midashi_mr = KakouJoukenMidashiMrs::findFirstByid($id);

        if (!$kakou_jouken_midashi_mr) {
            $this->flash->error("kakou_jouken_midashi_mr does not exist " . $id);

            $this->dispatcher->forward([
                'controller' => "kakou_jouken_midashi_mrs",
                'action' => 'index'
            ]);

            return;
        }

        $kakou_jouken_midashi_mr->cd = $this->request->getPost("cd");
        $kakou_jouken_midashi_mr->name = $this->request->getPost("name");
        $kakou_jouken_midashi_mr->suutiFlg = $this->request->getPost("suuti_flg");
        $kakou_jouken_midashi_mr->kakouJoukenKbnCd = $this->request->getPost("kakou_jouken_kbn_cd");
        $kakou_jouken_midashi_mr->hikaeDltflg = $this->request->getPost("hikae_dltflg");
        $kakou_jouken_midashi_mr->hikaeUserId = $this->request->getPost("hikae_user_id");
        $kakou_jouken_midashi_mr->hikaeNichiji = $this->request->getPost("hikae_nichiji");
        $kakou_jouken_midashi_mr->sakuseiUserId = $this->request->getPost("sakusei_user_id");
        $kakou_jouken_midashi_mr->created = $this->request->getPost("created");
        $kakou_jouken_midashi_mr->kousinUserId = $this->request->getPost("kousin_user_id");
        $kakou_jouken_midashi_mr->updated = $this->request->getPost("updated");
        

        if (!$kakou_jouken_midashi_mr->save()) {

            foreach ($kakou_jouken_midashi_mr->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "kakou_jouken_midashi_mrs",
                'action' => 'edit',
                'params' => [$kakou_jouken_midashi_mr->id]
            ]);

            return;
        }

        $this->flash->success("kakou_jouken_midashi_mr was updated successfully");

        $this->dispatcher->forward([
            'controller' => "kakou_jouken_midashi_mrs",
            'action' => 'index'
        ]);
    }

    /**
     * Deletes a kakou_jouken_midashi_mr
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $kakou_jouken_midashi_mr = KakouJoukenMidashiMrs::findFirstByid($id);
        if (!$kakou_jouken_midashi_mr) {
            $this->flash->error("kakou_jouken_midashi_mr was not found");

            $this->dispatcher->forward([
                'controller' => "kakou_jouken_midashi_mrs",
                'action' => 'index'
            ]);

            return;
        }

        if (!$kakou_jouken_midashi_mr->delete()) {

            foreach ($kakou_jouken_midashi_mr->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "kakou_jouken_midashi_mrs",
                'action' => 'search'
            ]);

            return;
        }

        $this->flash->success("kakou_jouken_midashi_mr was deleted successfully");

        $this->dispatcher->forward([
            'controller' => "kakou_jouken_midashi_mrs",
            'action' => "index"
        ]);
    }

    /*
     *
     */
    public function ajaxGetAction()
    {
        $this->view->disable();
        $response = new \Phalcon\Http\Response();
        if (!$this->request->isAjax()) {
            echo "is not Ajax ! ";
        }
        if (!$this->request->isPost()) {
            echo "is not Post ! ";
        }
        $kakou_jouken_midasis = KakouJoukenMidashiMrs::find([
            'order' => 'id',
            'conditions' => 'kakou_jouken_kbn_cd = ?0',
            'bind' => [0 => $this->request->getPost('cd')]
        ]);
        $res_flds = [
            "cd",
            "name",
            "suuti_flg",
            "kakou_jouken_kbn_cd",
        ];
        $resData = array();
        foreach ($kakou_jouken_midasis as $kakou_jouken_midasi) {
            $resAdata = [];
            foreach ($res_flds as $res_fld) {
                $resAdata[$res_fld] = $kakou_jouken_midasi->$res_fld;
            }
            $resData[] = $resAdata;
        }
        $response->setContent(json_encode($resData));
        return $response;
    }
}
