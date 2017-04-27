<!DOCTYPE html>
<?php 
    require_once "classe-fichier-2017-04-26.php";
    require_once "classe-mysql-2017-04-26.php";
    require_once "librairies-communes-2017-04-07.php";
    require_once "fonctions-specifiques-projet-final.php";
    require_once "connexion-bd.php";
    
    session_start();
    
  
    
    
    $strNomTableUtilisateurs ="utilisateurs";
    $strNomTableConnexions ="connexions";
    $strNomTableCategories ="categories";
    $strNomTableAnnonces ="annonces";
    
    if($oBD->tableExiste($strNomTableUtilisateurs) == false){
        creeTableUtilisateurs($oBD, $strNomTableUtilisateurs);
        $oBD->insereEnregistrement($strNomTableUtilisateurs,1,"admin@nq.com",password_hash('admin', PASSWORD_DEFAULT), "2017-04-26", "11", "1", "901", "Nom", "Prenom", "N (514) 123-1234", "N (514) 123-1234 #9999", "N (514) 123-1234", "2017-04-26", "Admin");
    }
    
    if($oBD->tableExiste($strNomTableConnexions) == false){
        creeTableUtilisateurs($oBD, $strNomTableConnexions);
        
    }
    
    if($oBD->tableExiste($strNomTableCategories) == false){
        creeTableUtilisateurs($oBD, $strNomTableCategories);
        
    }
    
    if($oBD->tableExiste($strNomTableAnnonces) == false){
        creeTableUtilisateurs($oBD, $strNomTableAnnonces);
        
    }
   
    //Pour la connexion
    $adresseConnexion= get('adresseConnexion');
    $motPasseConnexion = get('motPasseConnexion');
   
    //Pour l'inscription
    $adresseInscription = get('adresseInscription');
    $confirmeAdresseInscription = get('confirmeAdresseInscription');
    $motPasseInscription = get('motPasseInscription');
    $confirmemotPasseInscription = get('confirmeMotPasseInscription');
    
    $getConnexion = get('btnConnexion');
    $getEnregistrement = get('Enregistrement');
    
    $binEnregistrement = false;
    
    
    
        
    

    $alerte = 0; // 1 = Succès 2 = Attention  3 = Avertisement
    $alerteEnregistrement = 0; // 1 = avertisement 2 = Attention 3 = Succès
    $strMsgAlerteEnregistrement = "";
    $tabChampsTableUtil = array("NoUtilisateur","Courriel","MotDePasse","Creation","NbConnexions","Status","NoEmpl","Nom","Prenom","NoTelMaison","NoTelTravail","NoTelCellulaire","Modification","AutresInfos");

    
    /*****************************************************PROBLEME AVEC LE BOUTON SE CONNECTER NE SAFFICHE PAS DANS LA BARRE D'ADRESSE*****************************************************************/
    if (isset($getConnexion)){
        
        /*$oBD->selectionneEnregistrements($strNomTableUtilisateurs,"C=Courriel='$adresseConnexion'");
        echo $oBD->contenuChamp(0, 'MotDePasse');*/
        
        $intSelectTrouver = $oBD->selectionneEnregistrements($strNomTableUtilisateurs,"C=Courriel='$adresseConnexion'");
        if(password_verify($motPasseConnexion, $oBD->contenuChamp(0, 'MotDePasse'))){
            //echo "password good";
            $intSelectTrouver = $oBD->selectionneEnregistrements($strNomTableUtilisateurs,"C=Courriel='$adresseConnexion'");
            $row = mysqli_fetch_all($oBD->_listeEnregistrements,MYSQLI_ASSOC);
            if ($intSelectTrouver == 1) {
                
                for ($i = 0; $i < count($row[0]); $i++) {
                    if ($tabChampsTableUtil[$i] != "MotDePasse") {
                        $_SESSION[$tabChampsTableUtil[$i]] = $row[0][$tabChampsTableUtil[$i]];
                    }
                }
                
                if ($row[0]['Status'] != 0) {
                    $alerte = 1;
                } else {
                    $alerte = 3;
                }
                
            } else {
                $alerte = 2;
            }
            
        } else {
            $alerte = 2;
            //echo "password bad";
        }
        
    }
    
    if (isset($getEnregistrement)){
        $binEnregistrement = true;
        if ($adresseInscription!="" && $confirmeAdresseInscription!="" && $motPasseInscription!="" && $confirmemotPasseInscription!=""){
        
        if ($adresseInscription != $confirmeAdresseInscription){
           
            $alerteEnregistrement = 1;
            $strMsgAlerteEnregistrement = "L\'adresse de courriel n\'a pas été confirmé correctement";
        }
        else if (strlen ($adresseInscription) > 50 ){
           
            $alerteEnregistrement = 1;
            $strMsgAlerteEnregistrement = "L\'adresse de courriel ne doit pas dépasser 50 caractères";
        }
        else if (!filter_var($adresseInscription, FILTER_VALIDATE_EMAIL)){
            
            $alerteEnregistrement = 1;
            $strMsgAlerteEnregistrement = "L\'adresse de courriel saisie est invalide, veuillez respecter le format";
        }
       else if ($motPasseInscription != $confirmemotPasseInscription){
            
            $alerteEnregistrement = 1;
            $strMsgAlerteEnregistrement = "Le mot de passe n\'a pas été confirmé correctement";
        }
        else if (strlen ($motPasseInscription) > 50 ){
            
            $alerteEnregistrement = 1;
            $strMsgAlerteEnregistrement = "Le mot de passe ne doit pas dépasser 50 caractères";
        }
        else if (!preg_match('"^(?=.[A-Za-z])(?=.\d)[A-Za-z\d]{5,15}$"', $motPasseInscription)){
            $alerteEnregistrement = 1;
            $strMsgAlerteEnregistrement = "Le mot de passe doit contenir 5 à 15 caractères, au moins 1 lettre et 1 chiffre.";
        }
        else{
            $intSelectTrouverUtilisateur = $oBD->selectionneEnregistrements($strNomTableUtilisateurs,"C=Courriel='$adresseInscription'");
            if ($intSelectTrouverUtilisateur == 0) {
                $row2 = mysqli_fetch_all($oBD->_listeEnregistrements,MYSQLI_ASSOC);
                $strNoUtilisateur= '$NoUtilisateur';
                $resultat = $oBD->selectionneEnregistrements($strNomTableUtilisateurs,"D=NoUtilisateur","T=NoUtilisateur DESC");
                $row3 = mysqli_fetch_all($oBD->_listeEnregistrements,MYSQLI_ASSOC);
                //$resultat = mysqli_fetch_array(mysqli_query($oBD->_cBD, "SELECT $strNoUtilisateur FROM $strNomTableUtilisateurs ORDER BY $strNoUtilisateur DESC LIMIT 1"));
                $NoUtilisateur = ($row3[0]['NoUtilisateur'])+1;
                $date = date("Y-m-d H:i:s");

                $oBD->insereEnregistrement($strNomTableUtilisateurs,$NoUtilisateur,$adresseInscription,password_hash($motPasseInscription, PASSWORD_DEFAULT),$date,0,0,'','','','','','','','N/A');
                echo $oBD->_requete;
                $alerteEnregistrement = 3;
                $strMsgAlerteEnregistrement = "Utilisateur enregistré. Courriel de confirmation envoyé.";
            } else {
                $alerteEnregistrement = 2;
                $strMsgAlerteEnregistrement = "Adresse courriel existe dejà!";
            }
            
        }
     }
     else{
         /*echo '<script language="javascript">';
            echo 'alert("Attention, il faut remplir tous les champs!")';
            echo '</script>';*/
            
            $alerteEnregistrement = 1;
            $strMsgAlerteEnregistrement = "Attention, il faut remplir tous les champs!";
     }
   }
   
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Page d'authentification</title>


        <link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Open+Sans:600'>

        <link rel="stylesheet" href="css/connexion.css">
        <link rel="stylesheet" href="css/alertboxes.css">

        <script>
        function verificationConnexion(){
            
            //document.getElementById('frmSaisie1').submit();
            //window.location = 'annonces.php';
            
        }
        
        function verificationEnregistrement(){
            //document.getElementById('frmSaisie2').submit();
            //window.location = 'connexion.php';
        }
        </script>
    </head>

    <body>
        
           
        <div class="login-wrap">
            <div class="login-html">
                <img src="img/nq-logo2.png" alt="logo" height="150px" width="auto" style="margin-bottom: 2em">
                <input id="tab-1" type="radio" name="tab" class="sign-in" <?php if(!$binEnregistrement){?> checked <?php } else{}?>><label for="tab-1" class="tab">Connexion</label>
                <input id="tab-2" type="radio" name="tab" class="sign-up" <?php if($binEnregistrement){?> checked <?php } else{}?>><label for="tab-2" class="tab">Inscription</label>
                <div class="login-form">
                    <div class="sign-in-htm">
                        <form id="frmSaisie1"  method="get" action="">
                        <div class="group">
                            <label for="user" class="label">Adresse courriel</label>
                            <input id="adresseConnexion" name="adresseConnexion" type="email" class="input" required autofocus>
                        </div>
                        <div class="group">
                            <label for="pass" class="label">Mot de passe</label>
                            <input id="motPasseConnexion" name="motPasseConnexion" type="password" class="input" data-type="password" required>
                        </div>

                        <div style="margin-bottom: 10px;">
                            <?php if ($alerte == 2) { ?>
                                <div class="alert-box attention">
                                    <h4>Erreur! <span>courriel ou mot de passe incorrect</span></h4>
                                </div>

                            <?php } else if ($alerte == 1 ) {
                                $intNbrConnexion = $row[0]['NbConnexions'] + 1;
                                $intNoUtilisateur = $row[0]['NoUtilisateur'];
                                $oBD->majEnregistrement($strNomTableUtilisateurs, "NbConnexions=$intNbrConnexion","NoUtilisateur=$intNoUtilisateur");
                                $_SESSION[$tabChampsTableUtil[4]] = $intNbrConnexion;
                                if($row[0]['NbConnexions'] != 0){
                                    
                                ?>  
                                <script>window.location = 'annonces.php';</script>
                                <?php }
                                elseif($row[0]['NbConnexions'] == 0){ 
                                ?>
                                <script>window.location = 'mon-compte.php';</script>
                            <?php }} elseif($alerte == 3){  ?>
                                    <div class="alert-box warning">
                                        <h4>Avertissement! <span>Vous devez activer votre compte par courriel.</span></h4>
                                    </div>
                                <?php }?>
                        </div>
                            
                        <div class="group">
                            <input id="checkConnexion" name="checkConnexion" type="checkbox" class="check" checked>
                            <label for="check"><span class="icon"></span> Se souvenir de moi</label>
                        </div>
                        <div class="group">
                            <input id="btnConnexion" name="btnConnexion" type="submit" class="button" value="Se connecter"  onclick="verificationConnexion()">
                        </div>
                        <div class="group">
                            <button class="button" onclick="window.location = 'annonces.php'" >Connection directe</button>
                        </div>
                        <div class="hr"></div>
                        <div class="foot-lnk">
                            <a href="oublie-mot-de-passe.php">Mot de passe oublié?</a>
                        </div>
                      </form>

                    </div>
                    
                    <div class="sign-up-htm">
                         <form id="frmSaisie2" method="get" action="">
                        <div class="group">
                            <label for="user" class="label">Adresse courriel</label>
                            <input id="adresseInscription" name="adresseInscription" type="email" class="input">
                        </div>
                        <div class="group">
                            <label for="user" class="label">Confirmation de l'adresse courriel</label>
                            <input id="confirmeAdresseInscription" name="confirmeAdresseInscription" type="email" class="input">
                        </div>
                        <div class="group">
                            <label for="pass" class="label">Mot de passe</label>
                            <input id="motPasseInscription" name="motPasseInscription" type="password" class="input" data-type="password">
                        </div>
                        <div class="group">
                            <label for="pass" class="label">Confirmation du mot de passe</label>
                            <input id="confirmeMotPasseInscription" name="confirmeMotPasseInscription" type="password" class="input" data-type="password">
                        </div>
                             
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
                        <div class="group">
                            <input id="Enregistrement" name="Enregistrement" type="submit" class="button" value="Enregistrement" for="tab-2" onclick="verificationEnregistrement()">
                        </div>
                        <div class="hr"></div>
                        <div class="foot-lnk">
                            <label for="tab-1">Retourner au menu connexion</label>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php $oBD->afficheInformationsSurBD();
        //$_SESSION['objBD'] = $oBD;
                $oBD->deconnexion();
        ?>


    </body>
</html>
