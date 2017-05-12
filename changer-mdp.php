<!doctype html>
<?php

    require_once 'classe-mysql-2017-04-26.php';
    require_once 'classe-fichier-2017-04-26.php';
    require_once 'librairies-communes-2017-04-07.php';
    require_once 'connexion-bd.php';
    require_once "variable-session-init.php";
    
    $alerteEnregistrement = 0; // 1 = avertisement 2 = Attention 3 = Succès
    
    $getChangeMDP = get('confirmerMDP');
    
    $getMDPActuel = get('motPasseActuel');
    $getNvMDP1 = get('NvMotPasse1');
    $getNvMDP2 = get('NvMotPasse2');
    
    if(isset($getChangeMDP)){
        $oBD->selectionneEnregistrements($strNomTableUtilisateurs,"C=NoUtilisateur=" . $_SESSION["NoUtilisateur"]);
        $row = mysqli_fetch_all($oBD->_listeEnregistrements, MYSQLI_ASSOC);
        if ($getMDPActuel == "") {
            $alerteEnregistrement = 1;
            $strMsgAlerteEnregistrement = "Veuillez inscrire votre mot de passe actuel.";
        }
        elseif (password_verify($getMDPActuel, $row[0]["MotDePasse"])) {
            if (!preg_match('/^((?=.*[a-z])(?=.*[A-Z])(?=.*\d)){5,15}^/', $getNvMDP1)){
                $alerteEnregistrement = 1;
                $strMsgAlerteEnregistrement = "Le mot de passe doit contenir 5 à 15 caractères, au moins 1 lettre et 1 chiffre.";
            }
            elseif ($getNvMDP1 == "") {
                $alerteEnregistrement = 1;
                $strMsgAlerteEnregistrement = "Le champs du mot de passe est vide !";
            
            }
            elseif ($getNvMDP1 != $getNvMDP2) {
                $alerteEnregistrement = 1;
                $strMsgAlerteEnregistrement = "Le mot de passe n\'a pas été confirmé correctement";
            }
            else {
                $alerteEnregistrement = 3;
                $strMsgAlerteEnregistrement = "Nouveau mot de passe enregistré";
                
                $oBD->majEnregistrement($strNomTableUtilisateurs, "MotDePasse='" . password_hash($getNvMDP1, PASSWORD_DEFAULT) . "'", "NoUtilisateur=" . $_SESSION["NoUtilisateur"]);

            }
            
        }
        
    }
    
    /*$strMethode = get('MAJ');
    
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
        else {
            

       }
    }*/
   
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
        <link rel="stylesheet" href="css/alertboxes.css">
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
                           <input class="sInput" id="motPasseActuel" type="password" name="motPasseActuel" value="" >
                       </td>
                   </tr>
                   <tr>
                       <td style="font-weight: bold;font-size: 110%"><strong style="color: red;"> * </strong>Nouveau mot de passe</td>
                       <td>
                           <input class="sInput" id="NvMotPasse1" type="password" name="NvMotPasse1" value="" >
                       </td>
                   </tr>
                    <tr>
                       <td style="font-weight: bold;font-size: 110%"><strong style="color: red;"> * </strong>Confirmer nouveau mot de passe</td>
                       <td>
                           <input class="sInput" id="NvMotPasse2" type="password" name="NvMotPasse2" value="" >
                       </td>
                   </tr>
                   <tr>
                       <td>
                           <button name="confirmerMDP" id="confirmerMDP" name='confirmerMDP' class="btn" type="submit" value="confirmerMDP" >Confirmer</button>
                       </td>
                       <td>
                            <div style="margin-bottom: 10px;">
                            <?php if ($alerteEnregistrement == 1) { ?>
                            <div class="alert-box warning">
                                    <h4>Avertissement! <span><?php echo $strMsgAlerteEnregistrement;?></span></h4>
                            </div>
                            <?php } elseif($alerteEnregistrement == 2){?>
                            <div class="alert-box attention">
                                    <h4>Attention! <span><?php echo $strMsgAlerteEnregistrement;?></span></h4>
                            </div>
                            <?php } elseif($alerteEnregistrement == 3){?>
                            <div class="alert-box done">
                                    <h4>Succès! <span><?php echo $strMsgAlerteEnregistrement;?></span></h4>
                            </div>
                            <?php }?>
                            </div>
                       </td>
                   </tr>
               </table>
            <strong style="color: red;"> * </strong>: Indique les champs obligatoires.
           </form>

       </main>

            <?php require_once "pied-de-page.php"?>

    </body>
</html>