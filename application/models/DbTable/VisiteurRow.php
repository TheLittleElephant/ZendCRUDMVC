<?php

class Application_Model_DbTable_VisiteurRow extends Zend_Db_Table_Row_Abstract
{

    public function getLanguesParlees() {
        return $this->findManyToManyRowset('Application_Model_DbTable_Langue', 'Application_Model_DbTable_LangueVisiteur');
    } 
    
    public function getNombreDeLanguesParlees() {
        return count($this->findManyToManyRowset('Application_Model_DbTable_Langue', 'Application_Model_DbTable_LangueVisiteur'));
    } 
    
    
}

