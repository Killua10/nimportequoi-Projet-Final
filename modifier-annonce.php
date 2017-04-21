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

        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/main.css">
        <script src="js/vendor/modernizr-2.8.3.min.js"></script>
        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script>
    </head>

    <body>

<header style="background-color: 000;background-image: url('img/nq-bg1.jpg');background-size: cover;width: 100%;height: auto;">
  <img src="img/nq-logo2.png" alt="Smiley face" height="150px" width="auto">


<?php require_once 'navigation.php';?>

</header>
      <main>

        <h1>Modification de l'annonce:</h1>
        <h3>php: nom de l'annonce</h3>


      <div id="content2">

        <table>
        <tr>
        <td><img src="img/default2.png" alt="Aucune image" height="auto" width="400px"></td>
        <td style="padding-left: 3em; padding-top: 24em;">Choisir image:</td>
        </tr>
        <tr>
        <td style="padding-left: 1em;">

          <h2>Titre: </h2><input required=""></input>
          <p>Categorie:</p><input required=""></input>

          <p>Description: </p><textarea rows="4" cols="50" style="resize: none"></textarea>
          <p>Nom de l'auteur: John, Doe</p>

       </td>
        <td style="padding-left: 3em; padding-bottom: 9em;">

          <h2>Prix:</h2><input type="number" min="1"></input>
          <p>Numéro d'annonce: 078657</p>
          <p>Date de modification: 12/04/2017</p>
          <p>Heure de modification: 3:45 EST</p>

        </td>
        </tr>
        </table>


        </div>

        <div id="admin2">
            <button class="btn">Enregistrer</button>
            <button class="btn">Supprimer</button>
            <button class="btn">Activer</button>
        </div>





       </main>

           <footer>2017 Ariel Sashcov</footer>

    </body>
</html>
