<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class ProjectSubMrsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'ProjectSubMrs', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = [];
        }
        $parameters["order"] = "id";

        $project_sub_mrs = ProjectSubMrs::find($parameters);
        if (count($project_sub_mrs) == 0) {
            $this->flash->notice("The search did not find any project_sub_mrs");

            $this->dispatcher->forward([
                "controller" => "project_sub_mrs",
                "action" => "index"
            ]);

            return;
        }

        $paginator = new Paginator([
            'data' => $project_sub_mrs,
            'limit'=> 10,
            'page' => $numberPage
        ]);

        $this->view->page = $paginator->getPaginate();
    }

    /**
     * Searches for project_sub_mrs
     */
    public function searchAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Displays the creation form
     */
    public function newAction()
    {

    }

    /**
     * Edits a project_sub_mr
     *
     * @param string $id
     */
    public function editAction($id)
    {
        if (!$this->request->isPost()) {

            $project_sub_mr = ProjectSubMrs::findFirstByid($id);
            if (!$project_sub_mr) {
                $this->flash->error("project_sub_mr was not found");

                $this->dispatcher->forward([
                    'controller' => "project_sub_mrs",
                    'action' => 'index'
                ]);

                return;
            }

            $this->view->id = $project_sub_mr->id;
            $this->tag->setDefault("id", $project_sub_mr->id);
            $this->tag->setDefault("project_id", $project_sub_mr->project_id);
            $this->tag->setDefault("cd", $project_sub_mr->cd);
            $this->tag->setDefault("name", $project_sub_mr->name);
            $this->tag->setDefault("uriage_yosan", $project_sub_mr->uriage_yosan);
            $this->tag->setDefault("kaishibi", $project_sub_mr->kaishibi);
            $this->tag->setDefault("shuuryoubi", $project_sub_mr->shuuryoubi);
            $this->tag->setDefault("status", $project_sub_mr->status);
            $this->tag->setDefault("memo", $project_sub_mr->memo);
        }
    }

    /**
     * Creates a new project_sub_mr
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "project_sub_mrs",
                'action' => 'index'
            ]);

            return;
        }

        $project_sub_mr = new ProjectSubMrs();
        $project_sub_mr->project_id = (int)$this->request->getPost("project_id");
        $project_sub_mr->cd = $this->request->getPost("cd");
        $project_sub_mr->name = $this->request->getPost("name");
        $project_sub_mr->uriage_yosan = $this->request->getPost("uriage_yosan");
        $project_sub_mr->kaishibi = $this->request->getPost("kaishibi");
        $project_sub_mr->shuuryoubi = $this->request->getPost("shuuryoubi");
        $project_sub_mr->status = $this->request->getPost("status");
        $project_sub_mr->memo = $this->request->getPost("memo");

        if (!$project_sub_mr->save()) {
            foreach ($project_sub_mr->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "project_sub_mrs",
                'action' => 'new'
            ]);

            return;
        }

        $this->flash->success("project_sub_mr was created successfully");

        $this->dispatcher->forward([
            'controller' => "project_sub_mrs",
            'action' => 'index'
        ]);
    }

    /**
     * Saves a project_sub_mr edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "project_sub_mrs",
                'action' => 'index'
            ]);

            return;
        }

        $id = $this->request->getPost("id");
        $project_sub_mr = ProjectSubMrs::findFirstByid($id);

        if (!$project_sub_mr) {
            $this->flash->error("project_sub_mr does not exist " . $id);

            $this->dispatcher->forward([
                'controller' => "project_sub_mrs",
                'action' => 'index'
            ]);

            return;
        }

        $project_sub_mr->project_id = (int)$this->request->getPost("project_id");
        $project_sub_mr->cd = $this->request->getPost("cd");
        $project_sub_mr->name = $this->request->getPost("name");
        $project_sub_mr->uriage_yosan = $this->request->getPost("uriage_yosan");
        $project_sub_mr->kaishibi = $this->request->getPost("kaishibi");
        $project_sub_mr->shuuryoubi = $this->request->getPost("shuuryoubi");
        $project_sub_mr->status = $this->request->getPost("status");
        $project_sub_mr->memo = $this->request->getPost("memo");

        if (!$project_sub_mr->save()) {

            foreach ($project_sub_mr->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "project_sub_mrs",
                'action' => 'edit',
                'params' => [$project_sub_mr->id]
            ]);

            return;
        }

        $this->flash->success("project_sub_mr was updated successfully");

        $this->dispatcher->forward([
            'controller' => "project_sub_mrs",
            'action' => 'index'
        ]);
    }

    /**
     * Deletes a project_sub_mr
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $project_sub_mr = ProjectSubMrs::findFirstByid($id);
        if (!$project_sub_mr) {
            $this->flash->error("project_sub_mr was not found");

            $this->dispatcher->forward([
                'controller' => "project_sub_mrs",
                'action' => 'index'
            ]);

            return;
        }

        if (!$project_sub_mr->delete()) {

            foreach ($project_sub_mr->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "project_sub_mrs",
                'action' => 'search'
            ]);

            return;
        }

        $this->flash->success("project_sub_mr was deleted successfully");

        $this->dispatcher->forward([
            'controller' => "project_sub_mrs",
            'action' => "index"
        ]);
    }

}
