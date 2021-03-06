<!doctype html>
<?php

    require_once "classe-fichier-2017-04-26.php";
    require_once "classe-mysql-2017-04-26.php";
    require_once "librairies-communes-2017-04-07.php";
    require_once "fonctions-specifiques-projet-final.php";
    require_once "connexion-bd.php";
    require_once "variable-session-init.php";
    
    $strMethode = get('MAJ');
    
    $tabChampsTableUtil = array("NoUtilisateur","Courriel","MotDePasse","Creation","NbConnexions","Status","NoEmpl","Nom","Prenom","NoTelMaison","NoTelTravail","NoTelCellulaire","Modification","AutresInfos");
    
    $intNoEmpl = get('NoEmpl');
    $strPrenom = get('Prenom');
    $strNomFamille = get('NomFamille');
    $strCourriel = get('Courriel');
    $strMotPasse = get('MotPasse');
    $strTelMaison = get('TelMaison');
    $strTelTravail = get('TelTravail');
    $strTelCellulaire = get('TelCellulaire');
    $cbTelephone = get("public");
    var_dump($cbTelephone);
    
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


<?php require_once 'navigation.php';
    
    $alerteEnregistrement = 0; // 1 = avertisement 2 = Attention 3 = Succès
    $strMsgAlerteEnregistrement = "";
    
    if(isset($strMethode)){
            if(strlen($strPrenom) == 0){
                $alerteEnregistrement = 1;
                $strMsgAlerteEnregistrement = "Prénom absent !";
            }
            else if(strlen($strNomFamille) == 0){
                $alerteEnregistrement = 1;
                $strMsgAlerteEnregistrement = "Nom de famille absent !";
            } else {
                $alerteEnregistrement = 3;
                
                if ($cbTelephone == "on") {
                    if ($strTelMaison != "") {
                        if (preg_match('/^\(?[0-9]{3}\)?|[0-9]{3}[-. ]? [0-9]{3}[-. ]?[0-9]{4}$/', $strTelMaison)) {
                            $strTelMaison = "P " . $strTelMaison;
                            $alerteEnregistrement = 3;
                        }
                        else {
                        $alerteEnregistrement = 1;
                        $strMsgAlerteEnregistrement = "Le numéro de téléphone de la maison ne respecte pas le format demandé (###) ###-####";
                        }
                    } 
                    
                    if ($strTelTravail != "") {
                        $strTelTravail = "P " . $strTelTravail;
                        $alerteEnregistrement = 3;
                    } /*else {
                        $alerteEnregistrement = 1;
                        $strMsgAlerteEnregistrement = "Le numéro de téléphone du travail ne respecte pas le format demandé (###) ###-####";
                    }*/
                    
                    if ($strTelCellulaire != "") {
                        if (preg_match('/^\(?[0-9]{3}\)?|[0-9]{3}[-. ]? [0-9]{3}[-. ]?[0-9]{4}$/', $strTelCellulaire)) {
                            $strTelCellulaire = "P " . $strTelCellulaire;
                            $alerteEnregistrement = 3;
                        }
                        else {
                            $alerteEnregistrement = 1;
                            $strMsgAlerteEnregistrement = "Le numéro de téléphone cellulaire ne respecte pas le format demandé (###) ###-####";
                        }
                    } 
                    
                }  else {
                    
                    if ($strTelMaison != "") {
                        var_dump("Ronaldo Test");
                        if (preg_match('/^\(?[0-9]{3}\)?|[0-9]{3}[-. ]? [0-9]{3}[-. ]?[0-9]{4}$/', $strTelMaison)) {
                            $strTelMaison = "N " . $strTelMaison;
                            $alerteEnregistrement = 3;
                        }
                        else {
                            $alerteEnregistrement = 1;
                            $strMsgAlerteEnregistrement = "Le numéro de téléphone de la maison ne respecte pas le format demandé (###) ###-####";
                        } 
                    } 
                    
                    if ($strTelTravail != "") {
                        $strTelTravail = "N " . $strTelTravail;
                    }/* else {
                        $alerteEnregistrement = 1;
                        $strMsgAlerteEnregistrement = "Le numéro de téléphone du travail ne respecte pas le format demandé (###) ###-####";
                    }*/
                    
                    if ($strTelCellulaire != "") {
                        if (preg_match('/^\(?[0-9]{3}\)?|[0-9]{3}[-. ]? [0-9]{3}[-. ]?[0-9]{4}$/', $strTelCellulaire)) {
                            $strTelCellulaire = "N " . $strTelCellulaire;
                            $alerteEnregistrement = 3;
                        }
                        else {
                            $alerteEnregistrement = 1;
                            $strMsgAlerteEnregistrement = "Le numéro de téléphone cellulaire ne respecte pas le format demandé (###) ###-####";
                        }
                        
                    } 
                    
                    
                    
                }
                
                if ($alerteEnregistrement == 3) {
                    $strMsgAlerteEnregistrement = "La mise à jour a été effectuée.";
                    $oBD->majEnregistrement($strNomTableUtilisateurs,"Prenom='$strPrenom', Nom='$strNomFamille', NoTelMaison='$strTelMaison', NoTelTravail='$strTelTravail', NoTelCellulaire='$strTelCellulaire', Modification=" . "'" . date("Y-m-d H:i:s") . "'"
                        ,"NoUtilisateur=" . $_SESSION['NoUtilisateur']);
                    
                    $_SESSION['Nom'] = $strNomFamille;
                    $_SESSION['Prenom'] = $strPrenom;
                    $_SESSION['NoTelMaison'] = $strTelMaison;
                    $_SESSION['NoTelTravail'] = $strTelTravail;
                    $_SESSION['NoTelCellulaire'] = $strTelCellulaire;
                    
                }
                
                
                var_dump($alerteEnregistrement);
            }
        }
?>


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

                           <select class="annonces" id="Statut" name="Statut" disabled="true">
                             <option name="EtatAttente" <?php if($_SESSION['Status'] == 0){echo 'selected';}?> value="0">En attente</option>
                             <option name="EtatConfirme" <?php if($_SESSION['Status'] == 9){echo 'selected';}?> value="9">Confirmé</option>
                             <option name="EtatAdministrateur" <?php if($_SESSION['Status'] == 1){echo 'selected';}?> value="1">Administrateur</option>
                             <option name="EtatCadre"  <?php if($_SESSION['Status'] == 2){echo 'selected';}?> value="2">Cadre</option>
                             <option name="EtatEmpSoutien"  <?php if($_SESSION['Status'] == 3){echo 'selected';}?> value="3">Employé de soutien</option>
                             <option name="EtatEnseignant"  <?php if($_SESSION['Status'] == 4){echo 'selected';}?> value="4">Enseignant</option>
                             <option name="EtatProfessionnel" <?php if($_SESSION['Status'] == 5){echo 'selected';}?>  value="5">Professionnel</option>
                           </select>
                       </td>
                   </tr>
                   <tr>
                       <td style="font-weight: bold;font-size: 110%"><strong style="color: red;"> * </strong>Numéro d'employé</td>
                       <td>
                           <input class="sInput" id="NoEmpl" type="text" name="NoEmpl" value='<?php echo $_SESSION['NoEmpl']?>' disabled>
                       </td>
                   </tr>
                   <tr>
                       <td style="font-weight: bold;font-size: 110%"><strong style="color: red;"> * </strong>Nom de famille</td>
                       <td>
                           <input class="sInput" id="NomFamille" type="text" name="NomFamille"  value='<?php echo $_SESSION['Nom']?>'>
                       </td>
                   </tr>
                   <tr>
                       <td style="font-weight: bold;font-size: 110%"><strong style="color: red;"> * </strong>Prénom</td>
                       <td>
                           <input class="sInput" id="Prenom" type="text" name="Prenom" value='<?php echo $_SESSION['Prenom']?>'>
                       </td>
                   </tr>
                   <tr>
                       <td style="font-weight: bold;font-size: 110%"><strong style="color: red;"> * </strong>Courriel</td>
                       <td>
                           <input class="sInput" id="Courriel" type="email" name="Courriel" value='<?php echo $_SESSION['Courriel']?>' disabled>
                       </td>
                   </tr>
                   <tr>
                       <td style="font-weight: bold;font-size: 110%"><strong style="color: orange;"> ** </strong>Téléphone maison</td>
                       <td>
                           <input class="sInput" id="telephonemaison" type="text" name="TelMaison" value='<?php echo droite($_SESSION['NoTelMaison'], 14)?>'>
                       </td>
                   </tr>
                   <tr>
                       <td style="font-weight: bold;font-size: 110%"><strong style="color: orange;"> ** </strong>Téléphone (et poste) au travail</td>
                       <td>
                           <input class="sInput" id="telephonetravail" type="text" name="TelTravail" value='<?php echo droite($_SESSION['NoTelTravail'], 20)?>'>
                       </td>
                   </tr>
                   <tr>
                       <td style="font-weight: bold;font-size: 110%"><strong style="color: orange;"> ** </strong>Téléphone cellulaire</td>
                       <td>
                           <input class="sInput" id="telephonecellulaire" type="text" name="TelCellulaire" value='<?php echo droite($_SESSION['NoTelCellulaire'],14)?>'>
                       </td>
                   </tr>
                   <tr>
                       <td style="font-weight: bold;font-size: 110%"></td>
                       <td>
                           <strong style="color: orange;"> ** </strong><input class="sInput" type="checkbox" id="public" name="public" min="1" step="any" ><label>Rendre mes informations publiques</label>
                       </td>
                   </tr>
                   <tr>
                       <td style="font-weight: bold;font-size: 110%"> 
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