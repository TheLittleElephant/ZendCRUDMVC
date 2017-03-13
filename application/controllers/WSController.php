<?php

class WSController extends Zend_Controller_Action
{
    private $server;
    
    public function init()
    {
        $this->_helper->viewRenderer->setNoRender(true);
        $this->_helper->layout->disableLayout();
        $this->getResponse()->setHeader("Content-type", "text/xml");
        $this->getResponse()->setHeader("Charset", "utf-8");
    }

    public function indexAction()
    {
        $this->server = new Zend_Rest_Server();
        $this->server->setClass("GSB_Medecin_Rest_Server");
        $this->server->setEncoding("UTF-8");
        $this->server->handle();
    }
 
}

