<!DOCTYPE html>
    <?php
        require_once 'classe-mysql-2017-04-26.php';
        require_once 'classe-fichier-2017-04-26.php';
        require_once 'librairies-communes-2017-04-07.php';
        
        $courriel = get('courielMPoublie');
        $getRecuperation = get('recuperationMP');
        $alerte = 0;        
        
        if (isset($getRecuperation)){
            if ($courriel != "" && filter_var($courriel, FILTER_VALIDATE_EMAIL)) {
                $alerte = 1;
            } else {
                $alerte = 2;
            }
        }
        
        var_dump($alerte);
        var_dump($getRecuperation)
    ?>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Open+Sans:600'>
        <link rel="stylesheet" href="css/connexion.css">
        <link rel="stylesheet" href="css/alertboxes.css">

        <title>Changement mot de passe</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <script>
            function verificationCourriel(){
                
                var courriel = document.getElementById(courielMPoublie).value;
                document.getElementById('frmSaisie').submit();
                //document.location=document.location.pathname;
            }
        </script>
        
    </head>
    <body>
        <div class="login-wrap">
            <div class="login-html" >
              <img src="img/nq-logo2.png" alt="logo" height="150px" width="auto" style="margin-bottom: 2em">
                <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Mot de passe oublié</label>
                <input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab"></label>
                <div class="login-form">
                    <div class="sign-in-htm">
                        <form id="frmSaisie"  method="get" action="">
                        <div class="group">
                            <label for="user" class="label">Adresse courriel</label>
                            <input id="courielMPoublie" name="courielMPoublie" type="email" class="input" required autofocus>
                        </div>
                        <div>
                            <?php if ($alerte == 2) {?>
                            <div class="alert-box attention">
                                <h4>Attention! <span>format du courriel invalide!</span></h4>
                            </div>
                            
                            <?php } else if($alerte == 1) {                                   
                                ?>  
                            <div class="alert-box done">
                                <h4>Hourra! <span>un courriel de recuperation a été envoyé. </span></h4>
                            </div>
                            <?php }?>
                            
                                                            
                                
                        </div>

                        <div class="group" style="padding-top: 2em;">
                            <input id="recuperationMP" type="submit" name="recuperationMP" class="button" value="Envoyer le courriel de récupération" onclick="verificationCourriel()">
                        </div>

                        <div class="hr"></div>
                        <div class="foot-lnk">
                            <a href="connexion.php">Retour à la page de connexion</a>
                        </div>
                        
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
