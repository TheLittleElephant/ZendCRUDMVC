<?php

class Application_Model_DbTable_Visiteur extends Zend_Db_Table_Abstract
{

    protected $_name = 'visiteur';
    protected $_rowClass = 'Application_Model_DbTable_VisiteurRow';

    public function ajouterVisiteur($id, $nom, $prenom, $login, $mdp, $adresse, $cp, $ville, $dateEmb) {
        $this->insert(array("id" => $id, 
                            "nom" => $nom, 
                            "prenom" => $prenom, 
                            "login" => $login,
                            "mdp" => $mdp,
                            "adresse" => $adresse,
                            "cp" => $cp,
                            "ville" => $ville,
                            "dateEmbauche" => $dateEmb));
    }
    
    public function obtenirVisiteur($id) {
        $row = $this->fetchRow("id ='" . $id. "'");
        if(!$row) {
            throw new Exception("Enregistrement $id introuvable");
        }
        return $row->toArray();
    }
    
    public function modifierVisiteur($id, $nom, $prenom, $login, $mdp, $adresse, $cp, $ville, $dateEmb) {
      $this->update(array("id" => $id, 
                            "nom" => $nom, 
                            "prenom" => $prenom, 
                            "login" => $login,
                            "mdp" => $mdp,
                            "adresse" => $adresse,
                            "cp" => $cp,
                            "ville" => $ville,
                            "dateEmbauche" => $dateEmb), "id = $id");  
    }
    
    public function idEstUnique($id) {
        return ($this->fetchRow("id ='" . $id. "'") == null) ? true : false;
    }
    
    public function supprimerVisiteur($id) {
        $this->delete("id = '".$id."'");
    }
}

