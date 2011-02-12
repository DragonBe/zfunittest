<?php

class IndexController extends Zend_Controller_Action
{
    protected $_session;
    
    public function init()
    {
        $this->_session = new Zend_Session_Namespace('twoauth');
    }

    public function indexAction()
    {
        /** don't do anything here **/
    }

}







