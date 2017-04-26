<?php

function creeTableUtilisateurs($oBD,$strNomTableUtilisateurs){
    $strDefinitions = "N,NoUtilisateur;" . "V50,Courriel;" . "V50,MotDePasse;" . "D,Creation;" . 
            "E,NbConnexions;" . "E,Status;" . "N,NoEmpl;". "V25,Nom;" . "V20,Prenom;" . 
            "V16,NoTelMaison;" . "V22,NoTelTravail;" . "V16,NoTelCellulaire;" . "D,Modification;" . "V50,AutresInfos";
    $strCles = "NoUtilisateur";
    
    $oBD->creeTableGenerique($strNomTableUtilisateurs, $strDefinitions, $strCles);
}

function creeTableConnexions($oBD,$strNomTableConnexions){
    $strDefinitions = "N,NoConnexion;" . "N,NoUtilisateurs;" . "D,Connexion;" . "D,Deconnexion";
    $strCles = "NoConnexion";
    
    $oBD->creeTableGenerique($strNomTableConnexions, $strDefinitions, $strCles);
}

function creeTableAnnonces($oBD,$strNomTableAnnonces){
    $strDefinitions = "N,NoAnnonce;" . "N,NoUtilisateurs;" . "D,Parution;" . "N,Categorie;" ;
    $strCles = "NoConnexion";
    
    $oBD->creeTableGenerique($strNomTableAnnonces, $strDefinitions, $strCles);
}
?>
