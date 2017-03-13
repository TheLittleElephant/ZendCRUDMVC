<?php

class Application_Model_DbTable_LangueVisiteur extends Zend_Db_Table_Abstract
{

    protected $_name = 'languevisiteur';
    protected $_primary = array('idVisiteur', 'idLangue');
    protected $_rowClass = 'Application_Model_DbTable_VisiteurRow';
    
    protected $_referenceMap = array(
        'Visiteur' => array(
            'columns' => array('idVisiteur'),
            'refTableClass' => 'Application_Model_DbTable_Visiteur',
            'refColumns' => array('id')
        ),
        'Langue' => array(
            'columns' => array('idLangue'),
            'refTableClass' => 'Application_Model_DbTable_Langue',
            'refColumns' => array('id')
        )
    );



}

