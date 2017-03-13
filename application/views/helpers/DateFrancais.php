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
class Application_View_Helper_DateFrancais extends Zend_View_Helper_Abstract {
    
    public function dateFrancais($date) {
        return (new DateTime($date))->format("d/m/Y");
    }
}
