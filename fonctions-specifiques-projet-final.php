<?php

function creeTableUtilisateurs($oBD,$strNomTableUtilisateurs){
    $strDefinitions = "N,NoUtilisateur;" . "V50,Courriel;" . "V50,MotDePasse;" . "D,Creation;" . 
            "E,NbConnexions;" . "E,Status;" . "E,NoEmpl;". "V25,Nom;" . "V20,Prenom;" . 
            "V16,NoTelMaison;" . "V22,NoTelTravail;" . "V16,NoTelCellulaire;" . "D,Modification;" . "V50,AutresInfos";
    $strCles = "NoUtilisateur";
    
    $oBD->creeTableGenerique($strNomTableTypesLivraison, $strDefinitions, $strCles);
}

function creeTableConnexions($oBD,$strNomTableConnexions){
    $strDefinitions = "N,NoUtilisateur;" . "V50,Courriel;" . "V50,MotDePasse;" . "D,Creation;" . 
            "E,NbConnexions;" . "E,Status;" . "E,NoEmpl;". "V25,Nom;" . "V20,Prenom;" . 
            "V16,NoTelMaison;" . "V22,NoTelTravail;" . "V16,NoTelCellulaire;" . "D,Modification;" . "V50,AutresInfos";
    $strCles = "NoUtilisateur";
    
    $oBD->creeTableGenerique($strNomTableTypesLivraison, $strDefinitions, $strCles);
}
?>
