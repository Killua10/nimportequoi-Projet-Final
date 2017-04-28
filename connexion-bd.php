<?php
    require_once "424w-cgodin-qc-ca.php";

    $strLocalHost = "localhost";
   $strNomBD = "annonces_nimportequoi";
   
   
   
    // Détéction du serveur
   /* $strMonIP = "";
    $strIPServeur = "";
    $strNomServeur = "";
    $strInfosSensibles = ""; //424w-cgodin-qc-ca.php -- LM
    detecteServeur($strMonIP, $strIPServeur, $strNomServeur, $strInfosSensibles);*/
   
    $oBD =  new mysql($strNomBD, "424w-cgodin-qc-ca.php");
    
    $strNomTableUtilisateurs ="utilisateurs";
    $strNomTableConnexions ="connexions";
    $strNomTableCategories ="categories";
    $strNomTableAnnonces ="annonces";

