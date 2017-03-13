<?php

class Application_Form_Visiteur extends Zend_Form
{

    public function init()
    {
        $validateurIdentifiant = new Zend_Validate_Regex("#^[a-z]{1}[0-9]{1,4}$#");
        $validateurIdentifiant->setMessage("1 lettre minuscule et au plus 4 chiffres");
        $validateurNomPrenom = new Zend_Validate_Regex("#^[A-Z]#");
        $validateurNomPrenom->setMessage("Le nom et le prénom doivent commencer par une majuscule");
        $validateurMotDePasse = new Zend_Validate_Regex("#^[a-z]{4}[0-9]{1}$#");
        $validateurMotDePasse->setMessage("Le mot de passe doit être composé de 4 lettres et d'un seul chiffre");
        $validateurMotDePasseIdentique = new Zend_Validate_Identical("mdp");
        $validateurMotDePasseIdentique->setMessage("Les deux mots de passe doivent être identiques");
        
        $this->setName("visiteur");
        $id = new Zend_Form_Element_Text("id");
        $id->setLabel("Identifiant : ");
        $id->addFilter("StripTags");
        $id->addFilter("StringTrim");
        $id->setRequired();
        $id->addValidator("NotEmpty");
        $id->addValidator($validateurIdentifiant);
        
        $nom = new Zend_Form_Element_Text("nom");
        $nom->setLabel("Nom : ");
        $nom->addFilter("StripTags");
        $nom->addFilter("StringTrim");
        $nom->addValidator("NotEmpty");
        $nom->setRequired();
        $nom->addValidator($validateurNomPrenom);
        
        $prenom = new Zend_Form_Element_Text("prenom");
        $prenom->setLabel("Prénom : ");
        $prenom->addFilter("StripTags");
        $prenom->addFilter("StringTrim");
        $prenom->addValidator("NotEmpty");
        $prenom->setRequired();
        $prenom->addValidator($validateurNomPrenom);
        
        $login = new Zend_Form_Element_Text("login");
        $login->setLabel("Login : ");
        $login->addFilter("StripTags");
        $login->addFilter("StringTrim");
        $login->addValidator("NotEmpty");
        
        $mdp = new Zend_Form_Element_Password("mdp");
        $mdp->setLabel("Mdp : ");
        $mdp->addFilter("StripTags");
        $mdp->addFilter("StringTrim");
        $mdp->addValidator("NotEmpty");
        $mdp->addValidator($validateurMotDePasse);
        
        $mdpConfirmation = new Zend_Form_Element_Password("mdpConfirmation");
        $mdpConfirmation->setLabel("Mot de passe (confirmation) : ");
        $mdpConfirmation->setRequired();
        $mdpConfirmation->addValidator($validateurMotDePasseIdentique);
        $mdpConfirmation->addValidator($validateurMotDePasse);
        
        $adresse = new Zend_Form_Element_Text("adresse");
        $adresse->setLabel("Adresse : ");
        $adresse->addFilter("StripTags");
        $adresse->addFilter("StringTrim");
        $adresse->addValidator("NotEmpty");
        
        $cp = new Zend_Form_Element_Text("cp");
        $cp->setLabel("CP : ");
        $cp->addFilter("StripTags");
        $cp->addFilter("StringTrim");
        $cp->addValidator("NotEmpty");
        
        $ville = new Zend_Form_Element_Text("ville");
        $ville->setLabel("Ville : ");
        $ville->addFilter("StripTags");
        $ville->addFilter("StringTrim");
        $ville->addValidator("NotEmpty");
        
        $dateEmbauche = new Zend_Form_Element_Text("dateEmbauche");
        $dateEmbauche->setLabel("Date d'embauche : ");
        $dateEmbauche->addFilter("StripTags");
        $dateEmbauche->addFilter("StringTrim");
        $dateEmbauche->addValidator("NotEmpty");
        
        $envoyer = new Zend_Form_Element_Submit("envoyer");
        $envoyer->setAttrib("id", "boutonenvoyer");
        $envoyer->setAttrib("class", "ui submit primary button");
        $this->addElements(array($id, $nom, $prenom, $login, $mdp, $mdpConfirmation, $adresse, $cp, $ville, $dateEmbauche, $envoyer));
    }
}

