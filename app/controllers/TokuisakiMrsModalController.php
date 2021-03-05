<?php
 
class TokuisakiMrsModalController extends ControllerBase
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
		ControllerBase::indexCd("TokuisakiMrs", "得意先台帳");
    }

    /**
     * Searches for tokuisaki_mrs
     */
    public function searchAction()
    {
        $this->persistent->parameters = null;
    }

}
