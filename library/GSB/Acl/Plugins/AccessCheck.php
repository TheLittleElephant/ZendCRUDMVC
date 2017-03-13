<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AccessCheck
 *
 * @author Jonathan
 */
class GSB_Acl_Plugin_AccessCheck extends Zend_Controller_Plugin_Abstract {
   
    private $acl;
    private $auth;
    
    function __construct(Zend_Acl $acl, Zend_Auth $auth) {
        $this->acl = $acl;
        $this->auth = $auth;
    }

    public function preDispatch(Zend_Controller_Request_Abstract $request) {
        $resource = $request->getControllerName();
        $action = $request->getActionName();
        if($this->auth->hasIdentity()) {
            $role = $this->auth->getStorage()->read()->role;
            if(!$this->acl->isAllowed($role, $resource, $action)) {
                $request->setControllerName("auth");
                $request->setActionName("login");
            }
        } else {
            $request->setControllerName("auth");
            $request->setActionName("login");
        }
    }

}
