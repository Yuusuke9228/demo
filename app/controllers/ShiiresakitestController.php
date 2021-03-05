<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

/**
 * ShiiresakitestController
 *
 * Allows to authenticate users
 */
class ShiiresakitestController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Sign Up/Sign In');
//        parent::initialize();
    }

    public function indexAction()
    {
        if (!$this->request->isPost()) {
            $this->tag->setDefault('cd', 'demo');
            $this->tag->setDefault('password', 'phalcon');
        }
    }
}
