<?php

class Application_Form_Login extends Zend_Form { 
    
    public function init() { 
        $this->setName('Login'); 
        $userName = new Zend_Form_Element_Text('username'); 
        $userName->setLabel('Nom: ') 
                 ->setRequired();
        $password = new Zend_Form_Element_Password('password'); 
        $password->setLabel('Mot de passe:') 
                 ->setRequired(); 
        $login = new Zend_Form_Element_Submit('login'); 
        $login->setAttrib("class", "ui submit primary button");
        $login->setLabel('Envoyer'); 
        $this->addElements(array($userName, $password, $login));
    } 
    
} 