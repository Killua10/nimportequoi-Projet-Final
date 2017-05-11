<?php
    require_once "424w-cgodin-qc-ca.php";
    require_once "classe-mysql-2017-04-26.php";

    $strLocalHost = "localhost";
   $strNomBD = "annonces_nimportequoi";
   
   
   
    // Détéction du serveur
   /* $strMonIP = "";
    $strIPServeur = "";
    $strNomServeur = "";
    $strInfosSensibles = ""; //424w-cgodin-qc-ca.php -- LM
    detecteServeur($strMonIP, $strIPServeur, $strNomServeur, $strInfosSensibles);*/
   
    $oBD =  new mysql($strNomBD, "424w-cgodin-qc-ca.php");
    
    $strNomTableUtilisateurs = "utilisateurs";
    $strNomFichierUtilisateurs =        "FichierTxt/utilisateurs.txt";
    $strNomTableConnexions = "connexions";
    $strNomFichierConnexions =        "FichierTxt/connexions.txt";
    $strNomTableCategories = "categories";
    $strNomFichierCategories =        "FichierTxt/categories.txt";
    $strNomTableAnnonces = "annonces";
    $strNomFichierAnnonces =        "FichierTxt/annonces.txt";
    

