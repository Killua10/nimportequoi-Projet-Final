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

<header style="background-color: 000;background-image: url('img/nq-bg2.jpg');background-size: cover;width: 100%;height: auto;">
  <img src="img/nq-logo2.png" alt="Smiley face" height="150px" width="auto">


<?php require_once 'navigation.php';?>


</header>
      <main>

        <h1>Liste de tous les utilisateurs:</h1>

      <div id="content3">

        <table border="1px" class="sTable">
          <tr>
              <td>No.</td>
              <td>Courriel</td>
              <td>Nom</td>
              <td>Prénom</td>
              <td>Numéro d'employé</td>
              <td>Téléphone maison</td>
              <td>Téléphone travail</td>
              <td>Téléphone cellulaire</td>
              <td>*Annonces A / I / S</td>
              <td>Nombre de connexions</td>
              <td>Statut</td>
              <td>Date de création</td>
              <td>Dernier modification</td>
              <td>5 dernières connexions</td>
              <td>Autres infos</td>
          </tr>
          <tr style="font-size: 70%">

              <td>0001</td>
              <td>a.sashcov@cgodin.qc.ca</td>
                <td>Sashcov</td>
                <td>Ariel</td>
                <td>909</td>
                <td>(514) 972-7296</td>
                <td>(514) 779-2314</td>
                <td>(514) 332-7296</td>
                <td>007 / 005 / 002</td>
                <td>032</td>
                <td >(1)Administrateur</td>
                <td>15-04-2017 22:45:00</td>
                <td>17-04-2017 20:45:00</td>
                <td style="font-size: 75%; font-weight:bold; text-align:center;">• 17-04-2017 18:32:03</br>
                    • 17-04-2017 18:32:03</br>
                    • 17-04-2017 18:32:03</br>
                    • 17-04-2017 18:32:03</br>
                    • 17-04-2017 18:32:03</td>
               <td>N/A</td>
          </tr>

      </table>

        <p style="font-size: 60%">*A : Annonce(s) active(s)</br>
                          *I : Annonce(s) inactive(s)</br>
                          *S : Annonce(s) supprimé(s)</p>
        <div id="admin2">
            <button class="btn" onClick="window.location.reload()">Actualiser</button>
        </div>





       </main>

           <footer>2017 Ariel Sashcov</footer>

    </body>
</html>
