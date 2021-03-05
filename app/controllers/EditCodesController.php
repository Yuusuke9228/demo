<?php
 
use Phalcon\Mvc\Controller;

class EditCodesController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
    }

    /**
     * List action
     */
    public function listAction($dirname)
    {
        $this->view->setVar('codesDir', $dirname);
    }

    /**
     * Edit Model
     *
     * @param string $fileName Model Name
     *
     * @return mixed
     */
    public function editAction($dirname, $fileName)
    {
        if (!file_exists('../app/' . $dirname . '/' . $fileName)) {
            $this->flash->error(sprintf('View %s could not be found.', '../app/' . $dirname . '/' . $fileName));

            $this->dispatcher->forward(array(
                'controller' => 'edit_views',
                'action' => 'list',
                'params' => array($dirname)
            ));
        }

        $this->tag->setDefault('code', file_get_contents('../app/' . $dirname . '/' . $fileName));
        $this->tag->setDefault('name', $dirname . '/' . $fileName);
        $this->view->setVar('name', $dirname . '/' . $fileName);
    }

    public function saveAction()
    {
        if ($this->request->isPost()) {
            $fileName = $this->request->getPost('name', 'string');
            $dirNames = explode("/", $fileName);

            if (!file_exists('../app/' . $fileName)) {
                $this->flash->error('View could not be found.');

                $this->dispatcher->forward(array(
                    'controller' => 'edit_codes',
                    'action' => 'list',
                    'params' => array($dirNames[0])
                ));

                return;
            }

            if (!is_writable('../app/' . $fileName)) {
                $this->flash->error('code file does not has write access.');

                $this->dispatcher->forward(array(
                    'controller' => 'edit_codes',
                    'action' => 'list',
                    'params' => array($dirNames[0])
                ));

                return;
            }

            file_put_contents('../app/' . $fileName, $this->request->getPost('code'));

            $message = sprintf('The code "%s" was saved successfully.', $fileName);
            $this->flash->success($message);
        }

        $this->dispatcher->forward(array(
            'controller' => 'edit_codes',
            'action' => 'edit',
            'params' => array($dirNames[0], $dirNames[1])
        ));
    }

}