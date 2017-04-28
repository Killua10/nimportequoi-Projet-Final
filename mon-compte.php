<!doctype html>
<?php

    require_once "classe-fichier-2017-04-26.php";
    require_once "classe-mysql-2017-04-26.php";
    require_once "librairies-communes-2017-04-07.php";
    require_once "fonctions-specifiques-projet-final.php";
    require_once "connexion-bd.php";
    
    $strMethode = get('MAJ');
    
    $intNoEmpl = get('NoEmpl');
    $strPrenom = get('Prenom');
    $strNomFamille = get('NomFamille');
    $strCourriel = get('Courriel');
    $strMotPasse = get('MotPasse');
    
    if(isset($strMethode)){
        if(strlen($strPrenom) == 0){
            echo '<script language="javascript">';
            echo 'alert("Prénom absent")';
            echo '</script>';
        }
        else if(strlen($strNomFamille) == 0){
            echo '<script language="javascript">';
            echo 'alert("Nom de famille absent")';
            echo '</script>';
        }
    }
   
?>

<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <!-- Place favicon.ico in the root directory -->

        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/main.css">
        <script src="js/vendor/modernizr-2.8.3.min.js"></script>
        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script>
    </head>

    <body>

<header style="background-color: 000;background-image: url('img/nq-bg2.jpg');background-size: cover;width: 100%;height: auto;">
  <img src="img/nq-logo2.png" alt="Smiley face" height="150px" width="auto">


<?php require_once 'navigation.php';?>


</header>
      <main>

        <h1>Mon compte</h1>

      <div id="content3">

        <form id="frmSaisie"  method="get" action="" >
               <table width="80%" cellpadding="100" style="align: center;">
                   <caption style="font-weight: bold;font-variant: small-caps;font-size: 150%;height:40px;line-height: 40px; margin-bottom: 2em;" ><a>Mise à jour de vos informations</a></caption>
                   <tr>
                       <td style="font-weight: bold;font-size: 110%"><strong style="color: red;"> * </strong>Statut d'employé</td>
                       <td>
                           <select class="annonces" id="Statut" name="Statut" disabled>
                               <?php 
                                    $tabStrName = array("EtatAttente", "EtatConfirme", "EtatAdministrateur", "EtatCadre", "EtatEmpSoutien", "EtatEnseignant", "EtatProfessionnel");
                                    $tabValue = array(0, 9, 1, 2, 3, 4, 5);
                                    $tabLabel = array("En attente", "Confirmé", "Administrateur", "Cadre", "Employé de soutien", "Enseignant", "Professionnel");
                                    $echo = "";
                                    $statut = 4;
                                    
                                    for($i = 0; $i < count($tabLabel); $i++){
                                        $echo = '<option ';
                                        if($tabValue[$i] == $statut){
                                            $echo .= 'selected';
                                        }
                                        $echo .= "name='$tabStrName[$i]' ";
                                        $echo .= "value='$tabValue[$i]'>";
                                        $echo .= $tabLabel[$i];
                                        $echo .= "</option>";
                                        echo $echo;
                                    }
                               ?>`
                          </select>
                       </td>
                   </tr>
                   <tr>
                       <td style="font-weight: bold;font-size: 110%"><strong style="color: red;"> * </strong>Numéro d'employé</td>
                       <td>
                           <input class="sInput" id="NoEmpl" type="text" name="NoEmpl" disabled>
                       </td>
                   </tr>
                   <tr>
                       <td style="font-weight: bold;font-size: 110%"><strong style="color: red;"> * </strong>Nom de famille</td>
                       <td>
                           <input class="sInput" id="NomFamille" type="text" name="NomFamille" >
                       </td>
                   </tr>
                   <tr>
                       <td style="font-weight: bold;font-size: 110%"><strong style="color: red;"> * </strong>Prénom</td>
                       <td>
                           <input class="sInput" id="Prenom" type="text" name="Prenom" >
                       </td>
                   </tr>
                   <tr>
                       <td style="font-weight: bold;font-size: 110%"><strong style="color: red;"> * </strong>Courriel</td>
                       <td>
                           <input class="sInput" id="Courriel" type="email" name="Courriel" value="" disabled>
                       </td>
                   </tr>
                   <tr>
                       <td style="font-weight: bold;font-size: 110%"><strong style="color: orange;"> ** </strong>Téléphone maison</td>
                       <td>
                           <input class="sInput" id="telephonemaison" type="text" name="telephonemaison" >
                       </td>
                   </tr>
                   <tr>
                       <td style="font-weight: bold;font-size: 110%"><strong style="color: orange;"> ** </strong>Téléphone (et poste) au travail</td>
                       <td>
                           <input class="sInput" id="telephonetravail" type="text" name="telephonetravail" >
                       </td>
                   </tr>
                   <tr>
                       <td style="font-weight: bold;font-size: 110%"><strong style="color: orange;"> ** </strong>Téléphone cellulaire</td>
                       <td>
                           <input class="sInput" id="telephonecellulaire" type="text" name="telephonecellulaire" >
                       </td>
                   </tr>
                   <tr>
                       <td style="font-weight: bold;font-size: 110%"></td>
                       <td>
                           <strong style="color: orange;"> ** </strong><input class="sInput" type="checkbox" id="public" name="public" min="1" step="any" ><label>Rendre mes informations publiques</label>
                       </td>
                   </tr>
                   <tr>
                       <td style="font-weight: bold;font-size: 110%"></td>
                       <td>
                           <button name="MAJ" id="MAJ" class="btn" type="submit" value="MAJ" >Mise à jour</button>
                       </td>
                       
                   </tr>
                   
                   
               </table>
            
                   <strong style="color: red;"> * </strong>: Indique les champs obligatoires.<br />
                   <strong style="color: orange;"> ** </strong>: Indique les champs facultatifs. Cochez l'option "Rendre mes informations publiques" pour que vos numéros de téléphone(s) soient visible au public.<br /><br />
                   
           </form>
          <button class="btn" value="changerMDP" onclick="window.location = 'changer-mdp.php'" >Changer mot de passe</button>

       </main>

            <?php require_once "pied-de-page.php"?>

    </body>
</html>