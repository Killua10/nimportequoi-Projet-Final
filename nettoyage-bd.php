<?php require_once "variable-session-init.php";

    require_once "classe-fichier-2017-04-26.php";
    require_once "classe-mysql-2017-04-26.php";
    require_once "librairies-communes-2017-04-07.php";
    require_once "fonctions-specifiques-projet-final.php";
    require_once "connexion-bd.php";
    
    $alerte = 0; // 1 = Succès 2 = Attention  3 = Avertisement
    $strMsgAlerteEnregistrement = "";
    
    $alerte2 = 0;
    $strMsgAlerteEnregistrement2 = "";
    
    $alerte3 = 0;
    $strMsgAlerteEnregistrement3 = "";
?>
<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <!-- Place favicon.ico in the root directory -->

        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/alertboxes.css">
    </head>

    <body>

<header style="background-color: 000;background-image: url('img/nq-bg2.jpg');background-size: cover;width: 100%;height: auto;">
  <img src="img/nq-logo2.png" alt="Smiley face" height="150px" width="auto">


<?php require_once 'navigation.php';?>


</header>
      <main>

        <h1>Nettoyage de la base de données:</h1>

        <div id="content2">
            <form id="frmNettoyageBD" method="get">
           
            <?php 
            
                /* ------------------ BOUTTON ENVOYER COURRIEL ----------------- */
                $btnEnvoyer = "Envoyer courriel";
                $intCompteurBoutton = 0;
                $binDesactivee = false;
                
               if(null !== (get('EnvoyerCourriel'))){
                 
                 if($intCompteurBoutton < 2){
                     $intCompteurBoutton++;
                     $btnEnvoyer = "Confirmer Envoi !";
                     $alerte = 1;
                     $strMsgAlerteEnregistrement = "Cliquez une deuxième fois pour confirmer!";
                    
                     if(get('EnvoyerCourriel') == 'Confirmer Envoi !'){
                         $alerte = 3;
                         $strMsgAlerteEnregistrement = "Les courriels ont été envoyés!";
                         
                         envoyerCourrielAuxUtilisateursNonActives($oBD, 'utilisateurs');
                     }
                 }
               }
               /* -------------------------------------------------------------- */
               
                 /* ------------------ BOUTTON SUPPRIMER UTILS ----------------- */
                $btnSupprimerUtilisateurs = "Supprimer utilisateurs";
                $intCompteurBouttonSupprimerUtilisateurs = 0;
                
               if(null !== (get('SupprimerUtilisateurs'))){
                 
                 if($intCompteurBouttonSupprimerUtilisateurs < 2){
                     $intCompteurBouttonSupprimerUtilisateurs++;
                     $btnSupprimerUtilisateurs = "Confirmer Suppression !";
                     $alerte2 = 1;
                     $strMsgAlerteEnregistrement2 = "Cliquez une deuxième fois pour confirmer!";
                    
                     if(get('SupprimerUtilisateurs') == 'Confirmer Suppression !'){
                         $alerte2 = 3;
                         $strMsgAlerteEnregistrement2 = "Les utilisateurs ont été supprimés!";
                     }
                 }
               }
               /* -------------------------------------------------------------- */
               
               /* ------------------ BOUTTON SUPPRIMER UTILS ----------------- */
                $btnSupprimerAnnonces = "Supprimer annonces";
                $intCompteurBouttonSupprimerAnnonces = 0;
                
                
               if(null !== (get('SupprimerAnnonces'))){
                 
                 if($intCompteurBouttonSupprimerAnnonces < 2){
                     $intCompteurBouttonSupprimerAnnonces++;
                     $btnSupprimerAnnonces = "Confirmer Suppression !";
                     $alerte3 = 1;
                     $strMsgAlerteEnregistrement3 = "Cliquez une deuxième fois pour confirmer!";
                    
                     if(get('SupprimerAnnonces') == 'Confirmer Suppression !'){
                         $alerte3 = 3;
                         $strMsgAlerteEnregistrement3 = "Les annonces ont été supprimés!";
                     }
                 }
               }
               /* -------------------------------------------------------------- */
                
               
                
            ?>
                <div >
                    
                    <h4>Envoyer un courriel</h4>
                    <p>Envoi d'un courriel à chaque utilisateur inscrit depuis plus d'un mois
                       qui n'a pas ecore confirmé son enregistrement.</p>
                    <input type="submit" class="btn" style="width: 17em; margin-top: 2em;" id="EnvoyerCourriel" name="EnvoyerCourriel" value="<?=$btnEnvoyer?>" >
                    
                    <div style="margin-bottom: 10px; width: 40%;">
                            <?php if ($alerte == 1) { ?>
                            <div class="alert-box warning">
                                    <h4>Avertissement! <span><?php echo $strMsgAlerteEnregistrement;?></span></h4>
                            </div>
                            <?php } elseif($alerte == 2){?>
                            <div class="alert-box attention">
                                    <h4>Attention! <span><?php echo $strMsgAlerteEnregistrement;?></span></h4>
                            </div>
                            <?php } elseif($alerte == 3){?>
                            <div class="alert-box done">
                                    <h4>Succès! <span><?php echo $strMsgAlerteEnregistrement;?></span></h4>
                            </div>
                            <?php }?>
                      </div>
                    
                    <hr style="height:2px; margin:60px 0 50px 0; background:rgb(96, 131, 193);">
                    
                </div>
                <div>
                    <h4>Supprimer des utilisateurs</h4>
                    <p>Suppression physique des utilisateurs qui se sont inscrits il y a plus de trois mois et qui n'ont pas
                       encore confirmé leur enregistrement. Un courriel serait envoyé systématiquement à chacun d'eux pour les
                       avertir que leur dossier a été supprimé.</p>
                    <input type="submit" class="btn" style="width: 17em; margin-top: 2em;" id="SupprimerUtilisateurs" name="SupprimerUtilisateurs" value="<?=$btnSupprimerUtilisateurs?>" >
                    
                    <div style="margin-bottom: 10px; width: 40%;">
                            <?php if ($alerte2 == 1) { ?>
                            <div class="alert-box warning">
                                    <h4>Avertissement! <span><?php echo $strMsgAlerteEnregistrement2;?></span></h4>
                            </div>
                            <?php } elseif($alerte2 == 2){?>
                            <div class="alert-box attention">
                                    <h4>Attention! <span><?php echo $strMsgAlerteEnregistrement2;?></span></h4>
                            </div>
                            <?php } elseif($alerte2 == 3){?>
                            <div class="alert-box done">
                                    <h4>Succès! <span><?php echo $strMsgAlerteEnregistrement2;?></span></h4>
                            </div>
                            <?php }?>
                      </div>
                                        
                    <hr style="height:2px; margin:60px 0 50px 0; background:rgb(96, 131, 193);">
                </div>
                <div>
                    <h4>Supprimer des annonces</h4>
                    <p>Suppression physique des annonces supprimées.</p>
                    <input type="submit" class="btn" style="width: 17em; margin-top: 2em;" id="SupprimerAnnonces" name="SupprimerAnnonces" value="<?=$btnSupprimerAnnonces?>" >
                    
                    <div style="margin-bottom: 10px; width: 40%;">
                            <?php if ($alerte3 == 1) { ?>
                            <div class="alert-box warning">
                                    <h4>Avertissement! <span><?php echo $strMsgAlerteEnregistrement3;?></span></h4>
                            </div>
                            <?php } elseif($alerte3 == 2){?>
                            <div class="alert-box attention">
                                    <h4>Attention! <span><?php echo $strMsgAlerteEnregistrement3;?></span></h4>
                            </div>
                            <?php } elseif($alerte3 == 3){?>
                            <div class="alert-box done">
                                    <h4>Succès! <span><?php echo $strMsgAlerteEnregistrement3;?></span></h4>
                            </div>
                            <?php }?>
                      </div>
                </div>
               
            

          </form>
        </div>
      </main>
       <?php require_once "pied-de-page.php"?>

    </body>
</html>
