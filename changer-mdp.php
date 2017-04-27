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
        else if($intNoEmpl == ""){
            echo '<script language="javascript">';
            echo 'alert("Numéro d\'employé absent")';
            echo '</script>';
        }
        else if(!is_numeric($intNoEmpl)){
            echo '<script language="javascript">';
            echo 'alert("Numéro d\'employé invalide.")';
            echo '</script>';
        }
        else if(!dansIntervalle($intNoEmpl, 1, 9999)){
            echo '<script language="javascript">';
            echo 'alert("Numéro d\'employé hors plage (1-9999)")';
            echo '</script>';
        }
        else if(strlen($strPrenom) == 0){
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

        <h1>Mon compte ➧ Changer mot de passe</h1>

      <div id="content3">

        <form id="frmSaisie"  method="get" action="" >
               <table width="50%" cellpadding="80" style="align: center;">
                   <caption style="font-weight: bold;font-variant: small-caps;font-size: 150%;height:40px;line-height: 40px; margin-bottom: 2em;" ><a>Mise à jour de mon mot de passe</a></caption>
                   
                    <tr>
                       <td style="font-weight: bold;font-size: 110%"><strong style="color: red;"> * </strong>Mot de passe actuel</td>
                       <td>
                           <input class="sInput" id="motPasse" type="password" name="motPasse" value="" >
                       </td>
                   </tr>
                   <tr>
                       <td style="font-weight: bold;font-size: 110%"><strong style="color: red;"> * </strong>Nouveau mot de passe</td>
                       <td>
                           <input class="sInput" id="motPasse" type="password" name="motPasse" value="" >
                       </td>
                   </tr>
                    <tr>
                       <td style="font-weight: bold;font-size: 110%"><strong style="color: red;"> * </strong>Confirmer nouveau mot de passe</td>
                       <td>
                           <input class="sInput" id="motPasse" type="password" name="motPasse" value="" >
                       </td>
                   </tr>
                   <tr>
                       <td>
                           <button name="confirmerMDP" id="confirmerMDP" class="btn" type="submit" value="confirmerMDP" >Confirmer</button>
                       </td>
                   </tr>
               </table>
            <strong style="color: red;"> * </strong>: Indique les champs obligatoires.
           </form>

       </main>

           <footer>2017 Ariel Sashcov</footer>

    </body>
</html>