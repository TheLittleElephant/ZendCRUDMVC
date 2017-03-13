<?php

class StatsController extends Zend_Controller_Action
{

    public function init()
    {
        $auth = Zend_Auth::getInstance();
        if(!$auth->hasIdentity()) {
            $this->_helper->redirector->gotoUrl("/auth"); 
        }
    }
    
    public function stats1Action() {

        $db = Zend_Db_Table::getDefaultAdapter();
        $query = "select idVisiteur,mois,count(*) 
                as nbFiches,sum(montantValide) as total 
              from ficheFrais 
              group by idVisiteur,mois 
              order by idVisiteur,mois";

        $lesStats = $db->fetchAll($query);
        $this->view->lesStats = $lesStats;
    }

    public function stats2Action() {
        $query = "select idVisiteur, mois, 
sum(case idFraisForfait when 'ETP' then (quantite*montant) end) as 'ETP',
sum(case idFraisForfait when 'KM' then (quantite*montant)  end) as 'KM',
sum(case idFraisForfait when 'NUI' then (quantite*montant) end) as 'NUI', 
sum(case idFraisForfait when 'REP' then (quantite*montant) end) as 'REP'
from fraisforfait
join lignefraisforfait on idFraisForfait = fraisforfait.id
group by idVisiteur, mois
order by idVisiteur, mois, idFraisForfait";
        $db = Zend_Db_Table::getDefaultAdapter();
        $lesStats = $db->fetchAll($query);
        $this->view->lesStats = $lesStats;
    }

}

