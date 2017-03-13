<?php

class AuthController extends Zend_Controller_Action {

    public function indexAction() {
        $db = $this->_getParam('db');

        $form = new Application_Form_Login();
        $this->view->form = $form;
        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                $db = new Zend_Db_Adapter_Pdo_Mysql(array(
                    'host ' => 'localhost',
                    'username' => 'root',
                    'password' => '',
                    'dbname' => 'gsbv2'
                ));
                $authAdapter = new Zend_Auth_Adapter_DbTable($db);
                $authAdapter->setTableName('comptable')
                        ->setIdentityColumn('login')
                        ->setCredentialColumn('mdp');
                $authAdapter->setIdentity($form->getValue("username"))
                        ->setCredential($form->getValue("password"));
                $auth = Zend_Auth::getInstance();
                $result = $auth->authenticate($authAdapter);
                if($result->isValid()) {
                    $this->_helper->redirector->gotoUrl("/visiteur");
                }
            } 
        }
    }
    
    public function logoutAction() {
        $auth = Zend_Auth::getInstance();
        $auth->clearIdentity();
        $this->_helper->redirector("index");
    }

}
