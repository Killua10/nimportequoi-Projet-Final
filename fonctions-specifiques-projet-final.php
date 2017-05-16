<?php

/* --- creeTableGenerique ---
* 
* Type, Nom -> B = BOOLEAN          B,Nom       -> Nom BOOL
*              C = DECIMAL          C99.99,Nom  -> Nom DECIMAL(99,99)
*              D = DATE             D,Nom       -> Nom DATE
*              E = ENTIER           E,Nom       -> Nom INT
*              F = CHAINE FIXE      F999,Nom    -> Nom CHAR(999)
*              M = MONETAIRE        M,Nom       -> Nom DECIMAL(10,2)
*              N = ENTIER NON NUL   N,Nom       -> Nom INT NOT NULL
*              V = CHAINE VARIABLE  V999,Nom    -> Nom VARCHAR(999)
*/

function creeTableUtilisateurs($oBD,$strNomTableUtilisateurs){
    $strDefinitions = "N,NoUtilisateur;" . "V50,Courriel;" . "V255,MotDePasse;" . "T,Creation;" . 
            "E,NbConnexions;" . "E,Status;" . "N,NoEmpl;". "V25,Nom;" . "V20,Prenom;" . 
            "V16,NoTelMaison;" . "V22,NoTelTravail;" . "V16,NoTelCellulaire;" . "T,Modification;" . "V50,AutresInfos";
    $strCles = "NoUtilisateur";
    
    $oBD->creeTableGenerique($strNomTableUtilisateurs, $strDefinitions, $strCles);
}

function remplitTableUtilisateurs($oBD,$strNomTableUtilisateurs,$strNomFichierUtilisateurs) {
    $fichierUtilisateurs = new fichier($strNomFichierUtilisateurs);
    
    if ($fichierUtilisateurs->existe()) {
        $fichierUtilisateurs->ouvre();
        while (!$fichierUtilisateurs->detecteFin()) {
            $fichierUtilisateurs->litDonneesligne($tValeurs, ";", "NoUtilisateur", "Courriel", "MotDePasse", "Creation","NbConnexions","Status","NoEmpl","Nom","Prenom"
                                                    ,"NoTelMaison","NoTelTravail","NoTelCellulaire","Modification","AutresInfos");
            $oBD->insereEnregistrement($strNomTableUtilisateurs,$tValeurs["NoUtilisateur"],$tValeurs["Courriel"],password_hash($tValeurs["MotDePasse"], PASSWORD_DEFAULT),date('Y/m/d h:i:s',strtotime($tValeurs["Creation"])),$tValeurs["NbConnexions"]
                                                                ,$tValeurs["Status"],$tValeurs["NoEmpl"],$tValeurs["Nom"],$tValeurs["Prenom"],$tValeurs["NoTelMaison"],$tValeurs["NoTelTravail"]
                                                                ,$tValeurs["NoTelCellulaire"],date('Y/m/d h:i:s',strtotime($tValeurs["Modification"])),$tValeurs["AutresInfos"]);
        }
    }
    
}

function creeTableConnexions($oBD,$strNomTableConnexions){
    $strDefinitions = "N,NoConnexion;" . "N,NoUtilisateur;" . "T,Connexion;" . "T,Deconnexion";
    $strCles = "NoConnexion";
    
    $oBD->creeTableGenerique($strNomTableConnexions, $strDefinitions, $strCles);
}

function remplitTableConnexions($oBD,$strNomTableConnexions,$strNomFichierConnexions) {
    $fichierConnexions = new fichier($strNomFichierConnexions);
    
    if ($fichierConnexions->existe()) {
        $fichierConnexions->ouvre();
        while (!$fichierConnexions->detecteFin()) {
            $fichierConnexions->litDonneesligne($tValeurs, ";", "NoConnexion", "NoUtilisateur", "Connexion", "Deconnexion");
            $oBD->insereEnregistrement($strNomTableConnexions,$tValeurs["NoConnexion"],$tValeurs["NoUtilisateur"],date('Y/m/d h:i:s',strtotime($tValeurs["Connexion"])),date('Y/m/d h:i:s',strtotime($tValeurs["Deconnexion"])));
        }
    }
    
}

function creeTableAnnonces($oBD,$strNomTableAnnonces){
    $strDefinitions = "N,NoAnnonce;" . "N,NoUtilisateurs;" . "T,Parution;" . "N,Categorie;" . 
            "V50,DescriptionAbregee;" . "V250,DescriptionComplete;" . "M,Prix;" . "V50,Photo;" . "T,MiseAJour;" . 
            "N,Etat";
    $strCles = "NoAnnonce";
    
    $oBD->creeTableGenerique($strNomTableAnnonces, $strDefinitions, $strCles);
}

function remplitTableAnnonces($oBD,$strNomTableAnnonces,$strNomFichierAnnonces) {
    $fichierAnnonces = new fichier($strNomFichierAnnonces);
    
    if ($fichierAnnonces->existe()) {
        $fichierAnnonces->ouvre();
        while (!$fichierAnnonces->detecteFin()) {
            $fichierAnnonces->litDonneesligne($tValeurs, ";", "NoAnnonce", "NoUtilisateur", "Parution", "Categorie","DescriptionAbregee","DescriptionComplete","Prix","Photo","MiseAJour"
                                                    ,"Etat");
            $oBD->insereEnregistrement($strNomTableAnnonces,$tValeurs["NoAnnonce"],$tValeurs["NoUtilisateur"],date('Y/m/d h:i',strtotime($tValeurs["Parution"])),$tValeurs["Categorie"],$tValeurs["DescriptionAbregee"]
                                                                ,$tValeurs["DescriptionComplete"],$tValeurs["Prix"],$tValeurs["Photo"],date('Y/m/d h:i:s',strtotime($tValeurs["MiseAJour"]. ":00")),$tValeurs["Etat"]);
                                                        var_dump(date('d/m/Y h:i:s',strtotime($tValeurs["MiseAJour"]. ":00")));
        }
    }
    
}

function creeTableCategorie($oBD,$strNomTableCategorie){
    $strDefinitions = "N,NoCategorie;" . "V20,Description";
    $strCles = "NoCategorie";
    
    $oBD->creeTableGenerique($strNomTableCategorie, $strDefinitions, $strCles);
}

function remplitTableCategorie($oBD,$strNomTableCategorie,$strNomFichierCategorie) {
    $fichierCategorie = new fichier($strNomFichierCategorie);
    
    if ($fichierCategorie->existe()) {
        $fichierCategorie->ouvre();
        while (!$fichierCategorie->detecteFin()) {
            $fichierCategorie->litDonneesligne($tValeurs, ";", "NoCategorie", "Description");
            $oBD->insereEnregistrement($strNomTableCategorie,$tValeurs["NoCategorie"],$tValeurs["Description"]);
        }
    }
    
}

function envoyerCourrielAuxUtilisateursNonActives($oBD, $strNomTableUtilisateurs){
    $strDestinataires = "";
    $strMessage = "<br />Bonjour,<br /><br /> vous êtes inscrites à N'importeQuoi depuis plus d'un mois et vous n'avez pas ecore confirmé votre enregistrement."
                . "<br /> Cliquez sur le lien qui suit pour confirmer votre enregistrement: -lien-";
    
    $intEnregistrements = $oBD->selectionneEnregistrements($strNomTableUtilisateurs);
    for($i=0; $i < $intEnregistrements; $i++){
        $strDestinataires .= $oBD->contenuChamp($i,'Courriel') . ';';
        //var_dump($oBD->contenuChamp($i,'Courriel'));
    }
    
    echo $strDestinataires;
    
    echo $strMessage;
}

function supprimerUtilisateurs(){
    
}

function supprimerAnnonces(){
    
}

?>
