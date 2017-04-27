<!doctype html>
<?php

    require_once 'classe-mysql-2017-04-26.php';
    require_once 'classe-fichier-2017-04-26.php';
    require_once 'librairies-communes-2017-04-07.php';
    
    $strMethode = get('MAJ');
    
    $strStatut = get('Statut');
    $intNoEmpl = get('NoEmpl');
    $strPrenom = get('Prenom');
    $strNomFamille = get('NomFamille');
    $strCourriel = get('Courriel');
    $strMotPasse = get('MotPasse');
    
    if(isset($strMethode)){
        if($strStatut==""){
            echo '<script language="javascript">';
            echo 'alert("Statut non valide")';
            echo '</script>';
        }
        else if(!estNumerique($intNoEmpl)){
            echo '<script language="javascript">';
            echo "alert('Numéro d''employé invalide.')";
            echo '</script>';
        }
        else if(dansIntervalle($intNoEmpl, 1, 9999)){
            echo '<script language="javascript">';
            echo "alert('Numéro d'employé hors plage (1-9999)";
            echo '</script>';
        }
        else if(strlen($strPrenom) == 0){
            echo '<script language="javascript">';
            echo "alert('Prénom absent')";
            echo '</script>';
        }
        else if(strlen($strNomFamille) == 0){
            echo '<script language="javascript">';
            echo "alert('Nom de famille absent')";
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
                   <caption style="font-weight: bold;font-variant: small-caps;font-size: 150%;height:40px;line-height: 40px; margin-bottom: 5px;" ><a>Mise à jour de vos informations</a></caption>
                   <tr>
                       <td style="font-weight: bold;font-size: 110%">Statut d'employé</td>
                       <td>

                           <select class="annonces" id="Statut" name="Statut">
                             <option disabled selected hidden>Statut</option>
                             <option name="EtatActif" value="1">Actif</option>
                             <option name="EtatInactif" value="0">Inactif</option>
                          </select>
                       </td>
                   </tr>
                   <tr>
                       <td style="font-weight: bold;font-size: 110%">Numéro d'employé</td>
                       <td>
                           <input class="sInput" id="NoEmpl" type="text" name="NoEmpl">
                       </td>
                   </tr>
                   <tr>
                       <td style="font-weight: bold;font-size: 110%">Prénom</td>
                       <td>
                           <input class="sInput" id="Prenom" type="text" name="Prenom" >
                       </td>
                   </tr>
                   <tr>
                       <td style="font-weight: bold;font-size: 110%">Nom de famille</td>
                       <td>
                           <input class="sInput" id="NomFamille" type="text" name="NomFamille" >
                       </td>
                   </tr>
                   <tr>
                       <td style="font-weight: bold;font-size: 110%">Courriel</td>
                       <td>
                           <input class="sInput" id="Courriel" type="email" name="Courriel" value="alainabboud@bell.net" disabled="">
                       </td>
                   </tr>
                   <tr>
                       <td style="font-weight: bold;font-size: 110%">Mot de passe</td>
                       <td>
                           <input class="sInput" id="motPasse" type="password" name="motPasse" value="6249613" disabled="">
                       </td>

                   </tr>
                   <tr>
                       <td style="font-weight: bold;font-size: 110%"></td>
                       <td>
                           <input class="sInput" type="checkbox" id="public" name="public" min="1" step="any" ><label>Rendre mes informations publiques</label>
                       </td>
                   </tr>
                   <tr>
                       <td style="font-weight: bold;font-size: 110%"></td>
                       <td>
                           <button name="MAJ" id="MAJ" class="btn" type="submit" value="MAJ" >Mise à jour</button>
                       </td>
                   </tr>
               </table>
           </form>


        

       </main>

           <footer>2017 Ariel Sashcov</footer>

    </body>
</html>