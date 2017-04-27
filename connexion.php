<!DOCTYPE html>
<?php 
    require_once "classe-fichier-2017-04-26.php";
    require_once "classe-mysql-2017-04-26.php";
    require_once "librairies-communes-2017-04-07.php";
    require_once "fonctions-specifiques-projet-final.php";
    
    
   $strLocalHost = "localhost";
   $strNomBD = "annonces_nimportequoi";
   
   
   
    // Détéction du serveur
    $strMonIP = "";
    $strIPServeur = "";
    $strNomServeur = "";
    $strInfosSensibles = ""; //424w-cgodin-qc-ca.php -- LM
    detecteServeur($strMonIP, $strIPServeur, $strNomServeur, $strInfosSensibles);
   
    $oBD =  new mysql($strNomBD, $strInfosSensibles);
    
    
    $strNomTableUtilisateurs ="utilisateurs";
   
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
    
    
    if($oBD->tableExiste($strNomTableUtilisateurs) == false){
        creeTableUtilisateurs($oBD, $strNomTableUtilisateurs);
        $oBD->insereEnregistrement($strNomTableUtilisateurs,1,"admin@nq.com",password_hash('admin', PASSWORD_DEFAULT), "2017-04-26", "11", "1", "901", "Nom", "Prenom", "N (514) 123-1234", "N (514) 123-1234 #9999", "N (514) 123-1234", "2017-04-26", "Admin");
    }
        
    //$oBD->selectionneEnregistrements($strNomTableUtilisateurs);
    

    $alerte = 0; // 1 = Succès 2 = Attention 
    $alerteEnregistrement = 0; // 1 = avertisement 2 = Attention 3 = Succès
    $strMsgAlerteEnregistrement = "";
    
    //var_dump($getConnexion);
    
    //var_dump($getEnregistrement);
    
    var_dump($alerte);
    /*****************************************************PROBLEME AVEC LE BOUTON SE CONNECTER NE SAFFICHE PAS DANS LA BARRE D'ADRESSE*****************************************************************/
    if (isset($getConnexion)){
        
        /*$oBD->selectionneEnregistrements($strNomTableUtilisateurs,"C=Courriel='$adresseConnexion'");
        echo $oBD->contenuChamp(0, 'MotDePasse');*/
        
        var_dump(password_verify($motPasseConnexion, $oBD->contenuChamp(0, 'MotDePasse')));
         var_dump(password_verify('1asd123', $oBD->contenuChamp(0, 'MotDePasse')));
        
        $intSelectTrouver = $oBD->selectionneEnregistrements($strNomTableUtilisateurs,"C=Courriel='$adresseConnexion'");
        if(password_verify($motPasseConnexion, $oBD->contenuChamp(0, 'MotDePasse'))){
            echo "password good";
            $intSelectTrouver = $oBD->selectionneEnregistrements($strNomTableUtilisateurs,"C=Courriel='$adresseConnexion'");
            
            if ($intSelectTrouver == 1) {
                $alerte = 1;
            } else {
                $alerte = 2;
            }
            
        } else {
            $alerte = 2;
            echo "password bad";
        }
        
    }
    
    if (isset($getEnregistrement)){
        $binEnregistrement = true;
        if ($adresseInscription!="" && $confirmeAdresseInscription!="" && $motPasseInscription!="" && $confirmemotPasseInscription!=""){
        
        if ($adresseInscription != $confirmeAdresseInscription){
           /* echo '<script language="javascript">';
            echo 'alert("L\'adresse de courriel n\'a pas Ã©tÃ© confirmÃ© correctement")';
            echo '</script>';*/
            
            $alerteEnregistrement = 1;
            $strMsgAlerteEnregistrement = "L\'adresse de courriel n\'a pas été confirmé correctement";
        }
        else if (strlen ($adresseInscription) > 50 ){
            /*echo '<script language="javascript">';
            echo 'alert("L\'adresse de courriel ne doit pas dÃ©passer 50 caractÃ¨res")';
            echo '</script>';*/
            
            $alerteEnregistrement = 1;
            $strMsgAlerteEnregistrement = "L\'adresse de courriel ne doit pas dépasser 50 caractères";
        }
        else if (!filter_var($adresseInscription, FILTER_VALIDATE_EMAIL)){
            /*echo '<script language="javascript">';
            echo 'alert("L\'adresse de courriel saisie est invalide, veuillez respecter le format")';
            echo '</script>';*/
            
            $alerteEnregistrement = 1;
            $strMsgAlerteEnregistrement = "L\'adresse de courriel saisie est invalide, veuillez respecter le format";
        }
       else if ($motPasseInscription != $confirmemotPasseInscription){
            /*echo '<script language="javascript">';
            echo 'alert("Le mot de passe n\'a pas Ã©tÃ© confirmÃ© correctement")';
            echo '</script>';*/
            
            $alerteEnregistrement = 1;
            $strMsgAlerteEnregistrement = "Le mot de passe n\'a pas été confirmé correctement";
        }
        else if (strlen ($motPasseInscription) > 50 ){
            /*echo '<script language="javascript">';
            echo 'alert("Le mot de passe ne doit pas dÃ©passer 50 caractÃ¨res")';
            echo '</script>';*/
            
            $alerteEnregistrement = 1;
            $strMsgAlerteEnregistrement = "Le mot de passe ne doit pas dépasser 50 caractères";
        }
        else{
            $intSelectTrouverUtilisateur = $oBD->selectionneEnregistrements($strNomTableUtilisateurs,"C=Courriel='$adresseInscription'");
            var_dump("Ronaldo" . $intSelectTrouverUtilisateur);
            if ($intSelectTrouverUtilisateur == 0) {
                $row2 = mysqli_fetch_all($oBD->_listeEnregistrements,MYSQLI_ASSOC);
                $strNoUtilisateur= '$NoUtilisateur';
                $resultat = mysqli_fetch_array(mysqli_query($oBD->_cBD, "SELECT $strNoUtilisateur FROM $strNomTableUtilisateurs ORDER BY $strNoUtilisateur DESC LIMIT 1"));
                var_dump($resultat);
                $NoUtilisateur = ($resultat[$strNoUtilisateur])+1;
                $date = date("Y-m-d H:i:s");

                $oBD->insereEnregistrement($strNomTableUtilisateurs,$NoUtilisateur,$adresseInscription,$motPasseInscription,$date);
                echo $oBD->_requete;
                $alerteEnregistrement = 3;
                $strMsgAlerteEnregistrement = "utilisateur enregistré.";
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

                        <div >
                            <?php if ($alerteEnregistrement == 1) { ?>
                                <div class="alert-box attention">
                                    <h4>Erreur! <span>courriel ou mot de passe incorrect</span></h4>
                                </div>

                            <?php } else if ($alerte == 1 ) {
                                $intNbrConnexion = $row[0]['NbConnexions'] + 1;
                                $intNoUtilisateur = $row[0]['NoUtilisateur'];
                                $oBD->majEnregistrement($strNomTableUtilisateurs, "NbConnexions=$intNbrConnexion","NoUtilisateur=$intNoUtilisateur");
                                if($row[0]['NbConnexions'] != 0){
                                    
                                ?>  
                                <script>window.location = 'annonces.php';</script>
                                <?php }
                                elseif($row[0]['NbConnexions'] == 0){ 
                                ?>
                                <script>window.location = 'mon-compte.php';</script>
                                <?php }} ?>
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
                                    <h4>Well Done! <span><?php echo $strMsgAlerteEnregistrement;?></span></h4>
                            </div>
                            <?php }?>
                        </div>
                        <div class="group">
                            <input id="Enregistrement" name="Enregistrement" type="submit" class="button" value="Enregistrement" for="tab-2" onclick="verificationEnregistrement()">
                        </div>
                        <div class="hr"></div>
                        <div class="foot-lnk">
                            <label for="tab-1">Déjà membre?</label>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php afficher?>


    </body>
</html>
