<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Open+Sans:600'>
        <link rel="stylesheet" href="css/connexion.css">

        <title>Changement mot de passe</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <div class="login-wrap">
            <div class="login-html" >
              <img src="img/nq-logo2.png" alt="logo" height="150px" width="auto" style="margin-bottom: 2em">
                <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Mot de passe oublié</label>
                <input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab"></label>
                <div class="login-form">
                    <div class="sign-in-htm">
                        <div class="group">
                            <label for="user" class="label">Adresse courriel</label>
                            <input id="user" type="text" class="input" required autofocus>
                        </div>

                        <div class="group" style="padding-top: 2em;">
                            <input type="submit" class="button" value="Envoyer le courriel de récupération" onclick="window.location = 'connexion.php';">
                        </div>

                        <div class="hr"></div>
                        <div class="foot-lnk">
                            <a href="connexion.php">Retour à la page de connexion</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
