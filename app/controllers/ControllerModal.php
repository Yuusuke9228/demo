<?php

use Phalcon\Mvc\Controller;

class ControllerModal extends Controller
{
    protected function initialize()
    {
        $this->view->setTemplateAfter('modal');
    }

    protected function forward($uri)
    {
        $uriParts = explode('/', $uri);
        $params = array_slice($uriParts, 2);
    	return $this->dispatcher->forward(
    		array(
    			'controller' => $uriParts[0],
    			'action' => $uriParts[1],
                'params' => $params
    		)
    	);
    }

}
