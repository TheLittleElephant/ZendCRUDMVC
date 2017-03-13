<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GSB_Visiteur_Helper_Anciennete
 *
 * @author Jonathan
 */
class Application_View_Helper_Anciennete extends Zend_View_Helper_Abstract {
    
    public function anciennete($date) {
        $dateEmbauche = new DateTime($date);
        $dateActuelle = new DateTime();
        $anciennete = $dateEmbauche->diff($dateActuelle)->format("%y");
        return ($anciennete > 1 ? "$anciennete ans" : "$anciennete an");
    }
}
