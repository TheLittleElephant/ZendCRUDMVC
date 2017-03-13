<?php

class GSB_Medecin_Rest_Server {

    /*public function getMedecinsV1() {
        $medecin = new Application_Model_DbTable_Medecin;
        $sql = $medecin->select()->from($medecin, "nom");
        return $medecin->fetchAll($sql)->toArray();
    }

    public function getMedecinsV2() {
        $medecin = new Application_Model_DbTable_Medecin;
        $sql = $medecin->select()->from($medecin, "nom");
        $lesMedecins = $medecin->fetchAll($sql)->toArray();
        $lesMeds = array();
        foreach ($lesMedecins as $unMed) {
            $lesMeds[] = htmlentities($unMed["nom"], ENT_SUBSTITUTE, "UTF-8");
        }
        return $lesMeds;
    }

    public function getMedecinsV3() {
        $medecin = new Application_Model_DbTable_Medecin;
        $sql = $medecin->select()->from($medecin, "nom");
        $lesMedecins = $medecin->fetchAll($sql)->toArray();
        array_walk($lesMedecins, function(&$unMed, $key) {
            $unMed["nom"] = htmlentities($unMed["nom"], ENT_SUBSTITUTE, "UTF-8");
        });
        return $lesMedecins;
    }
    
    public function getMedecinsV4() {
        $xml = simplexml_load_string("<lesMedecins/>");
        $medecin = new Application_Model_DbTable_Medecin;
        $sql = $medecin->select()->from($medecin, "nom");
        $lesMedecins = $medecin->fetchAll($sql)->toArray();
        foreach ($lesMedecins as $unMed) {
            $medXML = $xml->addChild("medecin");
            $medXML->addChild("nom", htmlspecialchars($unMed["nom"]));
        }
        return $xml;
    }*/
    
    public function getMedecinsParDepartement($departement) {
        $xml = simplexml_load_string("<Medecins/>");
        $medecin = new Application_Model_DbTable_Medecin;
        $sql = $medecin->select()->from($medecin, array("nom", "prenom", "adresse", "tel", "specialiteComplementaire", "departement"))->where("departement = $departement");
        $lesMedecins = $medecin->fetchAll($sql)->toArray();
        foreach ($lesMedecins as $unMed) {
            $medXML = $xml->addChild("Medecin");
            $medXML->addChild("nom", htmlspecialchars($unMed["nom"], ENT_SUBSTITUTE, "UTF-8"));
            $medXML->addChild("prenom", htmlspecialchars($unMed["prenom"], ENT_SUBSTITUTE, "UTF-8"));
            $medXML->addChild("adresse", $unMed["adresse"]);
            $medXML->addChild("tel", htmlspecialchars($unMed["tel"], ENT_SUBSTITUTE, "UTF-8"));
            $medXML->addChild("specialite", htmlspecialchars($unMed["specialiteComplementaire"], ENT_SUBSTITUTE, "UTF-8"));
        }
        return $xml;
    }
    
    public function getMedecinParId($id) {
        $xml = simplexml_load_string("<Medecins/>");
        $medecin = new Application_Model_DbTable_Medecin;
        $sql = $medecin->select()->from($medecin, array("nom", "departement"))->where("id = $id");
        $lesMedecins = $medecin->fetchAll($sql)->toArray();
        foreach ($lesMedecins as $unMed) {
            $medXML = $xml->addChild("Medecin");
            $medXML->addChild("nom", htmlspecialchars($unMed["nom"], ENT_SUBSTITUTE, "UTF-8"));
            $medXML->addChild("prenom", htmlspecialchars($unMed["prenom"], ENT_SUBSTITUTE, "UTF-8"));
            $medXML->addChild("adresse", htmlspecialchars($unMed["adresse"], ENT_SUBSTITUTE, "UTF-8"));
            $medXML->addChild("tel", htmlspecialchars($unMed["tel"], ENT_SUBSTITUTE, "UTF-8"));
            $medXML->addChild("specialite", htmlspecialchars($unMed["specialiteComplementaire"], ENT_SUBSTITUTE, "UTF-8"));
            $medXML->addChild("departement", htmlspecialchars($unMed["departement"], ENT_SUBSTITUTE, "UTF-8"));
        }
        return $xml;
    }
    
    public function getDepartements() {
        $xml = simplexml_load_string("<Departements/>");
        $medecin = new Application_Model_DbTable_Medecin;
        $sql = $medecin->select()->distinct()->from($medecin, array("departement"));
        $lesDeps = $medecin->fetchAll($sql)->toArray();
        foreach ($lesDeps as $unDep) {
            $depXML = $xml->addChild("Departement");
            $depXML->addChild("num", htmlentities($unDep["departement"], ENT_SUBSTITUTE, "UTF-8"));
        }
        return $xml;
    }
    
    public function getLanguesParlees($id) {
        $xml = simplexml_load_string("<LanguesParlees/>");
        $visiteur = new Application_Model_DbTable_Visiteur();
        $visiteurRow = $visiteur->find($id)->current();
        $lesLangues = $visiteurRow->getLanguesParlees();
        foreach ($lesLangues as $uneLangue) {
            $lngXML = $xml->addChild("Langue");
            $lngXML->addChild("libelle", htmlentities($uneLangue["libelle"], ENT_SUBSTITUTE, "UTF-8"));
        }
        return $xml;
    }
    
    
    public function getLanguesParlees2($id) {
        $langues = array();
        $visiteur = new Application_Model_DbTable_Visiteur();
        $visiteurRow = $visiteur->find($id)->current();
        $lesLangues = $visiteurRow->getLanguesParlees();
        foreach ($lesLangues as $uneLangue) {
            $langues["langues"][] = htmlentities($uneLangue["libelle"], ENT_SUBSTITUTE, "UTF-8");
        }
        return json_encode($langues);
    }
    
    
}
