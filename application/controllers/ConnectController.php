<?php

class ConnectController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }

    public function newsAction()
    {
        $feed = new My_News_Feed('http://www.phpdeveloper.org/feed');
        $this->view->feed = $feed->getNews();
    }


}



