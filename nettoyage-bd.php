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
    </head>

    <body>

<header style="background-color: 000;background-image: url('img/nq-bg2.jpg');background-size: cover;width: 100%;height: auto;">
  <img src="img/nq-logo2.png" alt="Smiley face" height="150px" width="auto">


<?php require_once 'navigation.php';?>

</header>
      <main>

        <h1>Nettoyage de la base de données:</h1>

        <div id="content2">
          <form>
           
                
                <div >
                    <h4>Envoyer un courriel</h4>
                    <p>Envoi d'un courriel à chaque utilisateur inscrit depuis plus d'un mois
                       qui n'a pas ecore confirmé son enregistrement.</p>
                    <input type="submit" class="btn" style="width: 17em; margin-top: 2em;" value="Envoyer un courriel" onclick="window.location = 'annonces.php';">
                    <hr style="height:2px; margin:60px 0 50px 0; background:rgb(96, 131, 193);">
                </div>
                <div>
                    <h4>Supprimer des utilisateurs</h4>
                    <p>Suppression physique des utilisateurs qui se sont inscrits il y a plus de trois mois et qui n'ont pas
                       encore confirmé leur enregistrement. Un courriel serait envoyé systématiquement à chacun d'eux pour les
                       avertir que leur dossier a été supprimé.</p>
                    <input type="submit" class="btn" style="width: 17em; margin-top: 2em;" value="Supprimer utilisateurs" onclick="window.location = 'annonces.php';">
                    <hr style="height:2px; margin:60px 0 50px 0; background:rgb(96, 131, 193);">
                </div>
                <div>
                    <h4>Supprimer des annonces</h4>
                    <p>Suppression physique des annonces supprimées.</p>
                    <input type="submit" class="btn" style="width: 17em; margin-top: 2em;" value="Supprimer annonces" onclick="window.location = 'annonces.php';">
                    
                   
                </div>
               
            

          </form>
        </div>
      </main>
      <footer>2017 Ariel Sashcov</footer>

    </body>
</html>
