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

        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script>
    </head>
    <body>

<header style="background-color: 000;background-image: url('img/nq-bg1.jpg');background-size: cover;width: 100%;height: auto;">
  <img src="img/nq-logo2.png" alt="Smiley face" height="150px" width="auto">
  
<?php require_once 'navigation.php';?>


</header>
      <main>
        <div class="trietrecherche">
          <select class="annonces">
           <option disabled selected hidden> # Annonces</option>
           <option value="5">5 par page</option>
           <option value="10">10 par page</option>
           <option value="15">15 par page</option>
           <option value="20">20 par page</option>
          </select>

          <select class="tri">
           <option disabled selected hidden> Trié par</option>
           <option value="DateParutionCroissant">Date Parution - Croissant</option>
           <option value="DateParutionDecroissant">Date Parution - Déroissant</option>
           <option value="CategorieCroissant">Catégorie - Croissant</option>
           <option value="CategorieDecroissant">Catégorie - Déroissant</option>
           <option value="DescriptionAbregeeCroissant">Description Abrégée - Croissant</option>
           <option value="DescriptionAbregeeDecroissant">Description Abrégée - Déroissant</option>
          </select>

          <input class="recherche" id="contenuRecherche" placeholder="Entrez votre recherche ici..."></input>
          <button class="btn" id="recherche">Recherche</button>
      </div>

        <h1>Liste des annonces</h1>
        <h3>Listez votre annonce dès aujourd'hui!</h3>


      <a onclick="window.location = 'infos-annonce.php';"><div id="content">
          <div id="fix"></div>
          <p class="number">001</p>

          <img src="img/default.png" alt="Aucune image" height="144px" width="144px">
          <h2>Lorem Ipsum</h2>
          <div id="left">
            <p class="desc">Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>
            <p class="nom">John, Doe</p>
            <p class="categorie">Categorie: voitures</p>
          </div>

          <div id="right">
              <p class="seq-number">№ 078657</p>
              <p class="date">12/04/2017</p>
              <p class="heure">3:45 EST</p>
              <p class="price">$400.00</p>
          </div>


        </div></a>

        <div id="admin">
            <button class="btn" onclick="window.location = 'modifier-annonce.php';">Modifier</button></br>
            <button class="btn">Supprimer</button></br>
            <button class="btn">Activer</button>
        </div>

        <a onclick="window.location = 'infos-annonce.php';"><div id="content">
            <div id="fix"></div>
            <p class="number">002</p>

            <img src="img/default.png" alt="Aucune image" height="144px" width="144px">
            <h2>Lorem Ipsum</h2>
            <div id="left">
              <p class="desc">Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>
              <p class="nom">John, Doe</p>
              <p class="categorie">Categorie: voitures</p>
            </div>

            <div id="right">
                <p class="seq-number">№ 078657</p>
                <p class="date">12/04/2017</p>
                <p class="heure">3:45 EST</p>
                <p class="price">$400.00</p>
            </div>


          </div></a>

          <div id="admin">
              <button class="btn" onclick="window.location = 'modifier-annonce.php';">Modifier</button></br>
              <button class="btn">Supprimer</button></br>
              <button class="btn">Activer</button>
          </div>





          <div class="pagination">
            <a href="#">❮❮</a>
            <a href="#">❮</a>
            <input type="number" name="" value="1" min="1">
            <a href="#">❯</a>
            <a href="#">❯❯</a>
          </div>
       </main>

            <?php require_once "pied-de-page.php"?>

    </body>
</html>
