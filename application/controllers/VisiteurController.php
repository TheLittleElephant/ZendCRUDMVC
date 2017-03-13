<?php

class VisiteurController extends Zend_Controller_Action
{

    public function init()
    {
        $auth = Zend_Auth::getInstance();
        if(!$auth->hasIdentity()) {
            $this->_helper->redirector->gotoUrl("/auth"); 
        }
    }

    public function indexAction()
    {
        $lesVisiteurs = new Application_Model_DbTable_Visiteur();
        //$this->view->lesVisiteurs = $lesVisiteurs->fetchAll();
        $paginator = Zend_Paginator::factory($lesVisiteurs->fetchAll());
        $paginator->setItemCountPerPage(5); //Au lieu de 2
        $paginator->setCurrentPageNumber($this->getRequest()->getParam('page') ? $this->getRequest()->getParam('page') : 1);
        Zend_Layout::getMvcInstance()->assign("titre", "Liste des visiteurs");
        $this->view->lesVisiteurs = $paginator;
        
    }

    public function ajouterAction()
    {
        $form = new Application_Form_Visiteur();
        Zend_Layout::getMvcInstance()->assign("titre", "Ajouter un visiteur");
        $this->view->form = $form;
        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                $lesVisiteurs = new Application_Model_DbTable_Visiteur();
                if($lesVisiteurs->idEstUnique($form->getValue("id"))) {
                     $lesVisiteurs->ajouterVisiteur($form->getValue("id"), $form->getValue("nom"), $form->getValue("prenom"), $form->getValue("login"), $form->getValue("mdp"), $form->getValue("adresse"), $form->getValue("cp"), $form->getValue("ville"), $this->dateAnglais($form->getValue("dateEmb")));
                     $this->_helper->redirector("index");  
                } 
            } else {
                $form->populate($formData);
            }
        } 
    }

    public function modifierAction()
    {
        $form = new Application_Form_Visiteur();
        Zend_Layout::getMvcInstance()->assign("titre", "Modifier un visiteur");
        $this->view->form = $form;
        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                $lesVisiteurs = new Application_Model_DbTable_Visiteur();
                $lesVisiteurs->ajouterVisiteur($form->getValue("id"), $form->getValue("nom"), $form->getValue("prenom"), $form->getValue("login"), $form->getValue("mdp"), $form->getValue("adresse"), $form->getValue("cp"), $form->getValue("ville"), $form->getValue("dateEmb"));
                $this->_helper->redirector("index");
            } else {
                $form->populate($formData);
            }
        } else {
            $id = $this->_getParam("id", 0);
            $lesVisiteurs = new Application_Model_DbTable_Visiteur();
            $form->populate($lesVisiteurs->obtenirVisiteur($id));
        }
    }

    public function supprimerAction()
    {
        /*if($this->getRequest()->isPost()) {
            $supprimer = $this->getRequest()->getPost("supprimer");
            if($supprimer == "Oui") {
                $id = $this->getRequest()->getPost("id");
                $lesVisiteurs = new Application_Model_DbTable_Visiteur();
                $lesVisiteurs->supprimerVisiteur($id);
                
            } 
             $this->_helper->redirector("/visiteur");
        }
        else {
                $id = $this->_getParam("id", 0);
                $lesVisiteurs = new Application_Model_DbTable_Visiteur();
                $this->view->visiteur = $lesVisiteurs->obtenirVisiteur($id);
        }*/
        $id = $this->getRequest()->getParam("id");
        $lesVisiteurs = new Application_Model_DbTable_Visiteur();
        $lesVisiteurs->supprimerVisiteur($id);
        $this->_helper->redirector("index");
    }
    
    private function dateAnglais($date) {
        return (new DateTime($date))->format("Y-m-d");
    }


}
