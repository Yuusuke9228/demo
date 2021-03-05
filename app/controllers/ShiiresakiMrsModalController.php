<?php

class ShiiresakiMrsModalController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('ModalDialog');
//        $this->view->modal = true;
    }
    /**
     * Index action
     */
    public function indexAction()
    {
		ControllerBase::indexCd("ShiiresakiMrs", "d“üæ‘ä’ ");
    }

    /**
     * Searches for shiiresaki_mrs
     */
    public function searchAction()
    {
        $this->persistent->parameters = null;
    }

}
