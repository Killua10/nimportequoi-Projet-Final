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
    $strDefinitions = "N,NoUtilisateur;" . "V50,Courriel;" . "V255,MotDePasse;" . "D,Creation;" . 
            "E,NbConnexions;" . "E,Status;" . "N,NoEmpl;". "V25,Nom;" . "V20,Prenom;" . 
            "V16,NoTelMaison;" . "V22,NoTelTravail;" . "V16,NoTelCellulaire;" . "D,Modification;" . "V50,AutresInfos";
    $strCles = "NoUtilisateur";
    
    $oBD->creeTableGenerique($strNomTableUtilisateurs, $strDefinitions, $strCles);
}

function creeTableConnexions($oBD,$strNomTableConnexions){
    $strDefinitions = "N,NoConnexion;" . "N,NoUtilisateur;" . "D,Connexion;" . "D,Deconnexion";
    $strCles = "NoConnexion";
    
    $oBD->creeTableGenerique($strNomTableConnexions, $strDefinitions, $strCles);
}



function creeTableAnnonces($oBD,$strNomTableAnnonces){
    $strDefinitions = "N,NoAnnonce;" . "N,NoUtilisateurs;" . "D,Parution;" . "N,Categorie;" . 
            "V50,DescriptionAbregee;" . "V250,DescriptionComplete;" . "M,Prix;" . "V50,Photo;" . "D,MiseAJour;" . 
            "N,Etat";
    $strCles = "NoAnnonce";
    
    $oBD->creeTableGenerique($strNomTableAnnonces, $strDefinitions, $strCles);
}

function creeTableCategorie($oBD,$strNomTableCategorie){
    $strDefinitions = "N,NoCategorie;" . "V20,Description";
    $strCles = "NoCategorie";
    
    $oBD->creeTableGenerique($strNomTableCategorie, $strDefinitions, $strCles);
}



?>
