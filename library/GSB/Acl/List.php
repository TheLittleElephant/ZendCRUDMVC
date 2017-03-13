<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GSB_Acl_Model
 *
 * @author Jonathan
 */
class GSB_Acl_List extends Zend_Acl {
    
    function __construct() {
        $this->addRole(new Zend_Acl_Role("user"));
        $this->addRole(new Zend_Acl_Role("admin"), "user");
        
        $this->addResource(new Zend_Acl_Resource("auth"));
        $this->addResource(new Zend_Acl_Resource("visiteur"));
        $this->addResource(new Zend_Acl_Resource("stats"));
        
        $this->addResource(new Zend_Acl_Resource("login"), "auth");
        $this->addResource(new Zend_Acl_Resource("logout"), "auth");
        
        $this->addResource(new Zend_Acl_Resource("index"), "visiteur");
        $this->addResource(new Zend_Acl_Resource("ajouter"), "visiteur");
        $this->addResource(new Zend_Acl_Resource("modifier"), "visiteur");
        $this->addResource(new Zend_Acl_Resource("supprimer"), "visiteur");
        
        $this->addResource(new Zend_Acl_Resource("stats1"), "stats");
        $this->addResource(new Zend_Acl_Resource("stats2"), "stats");
        
        $this->allow("user", null, array("login", "index", "logout"));
        $this->allow("admin");
        
    }

}
