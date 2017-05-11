<?php require_once 'connexion-bd.php';?>
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
            <form id="frmDivRecherche" method="get" action="">
            <select class="tri" id="ddlAnnoncesParPage" name='ddlAnnoncesParPage' onchange="this.form.submit()">
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
            <br />
          <select class="tri">
           <option disabled selected hidden> Champ de recherche</option>
           <option value="ChampRecherche.Auteur">Auteur</option>
           <option value="ChampRecherche.Categorie">Catégorie</option>
           <option value="ChampRecherche.Description">Description</option>
          </select>
            
            <style> input[type="date"]:before {
                        content: attr(placeholder) !important;
                        color: #aaa;
                        margin-right: 0.5em;
                      }
                      input[type="date"]:focus:before,
                      input[type="date"]:valid:before {
                        content: "";
                      } *       
            </style>
            <input class="sInput" type="date" value="" placeholder="Depuis">
            <input class="sInput" type="date" value="" placeholder="Jusqu'à">
            
          <input class="recherche" id="contenuRecherche" placeholder="Entrez votre recherche ici..."></input>
          <button class="btn" id="recherche">Recherche</button>
          </form>
      </div>

        <h1>Liste des annonces</h1>
        <?php 
        if (get('ddlAnnoncesParPage') == null) {
            $getDDL = 10;
        } else {
            $getDDL = get('ddlAnnoncesParPage');
        }
        
        //var_dump($getDDL);
        $oBD->selectionneEnregistrements($strNomTableAnnonces);?>
        <h3> <?php echo $oBD->_nbEnregistrements;?> annonces ont été générées. Listez votre annonce dès aujourd'hui!</h3>

         <?php
            //var_dump( mysqli_fetch_all($oBD->_listeEnregistrements,MYSQLI_ASSOC));
                $row = mysqli_fetch_all($oBD->_listeEnregistrements, MYSQLI_ASSOC);
                for ($j = 0; $j < $getDDL; $j++) {
                    
                //var_dump($row);
                //if ($row['Statut'] == 1) 
                         ?>
        
          <div id="content">
              <form id="frmAnnonces" method="get" action="">
            <a id='annonce' name='annonce' onclick="window.location='infos-annonce.php';this.form.submit();">
            <div id="fix"></div>
            <p class="number"><?php echo ajouteZeros($row[$j]["NoAnnonce"], 3) ?></p>

          <img src="img/default.png" alt="Aucune image" height="144px" width="144px">
          <h2><?php echo $row[$j]["DescriptionAbregee"] ?></h2>
          <div id="left">
            <p class="desc">Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>
            
            <?php $oBD->selectionneEnregistrements($strNomTableUtilisateurs);
            $row3 = mysqli_fetch_all($oBD->_listeEnregistrements, MYSQLI_ASSOC);
            ?>
            <p class="nom"><?php echo $row3[$row[$j]["NoUtilisateurs"]]["Nom"] . ', ' . $row3[$row[$j]["NoUtilisateurs"]]["Prenom"]?></p>
            
            <?php $oBD->selectionneEnregistrements($strNomTableCategories);
            $row2 = mysqli_fetch_all($oBD->_listeEnregistrements, MYSQLI_ASSOC);
            ?>
            <p class="categorie">Categorie: <?php echo $row2[$row[$j]["Categorie"]-1]["Description"] ?></p>
            <?php $oBD->selectionneEnregistrements($strNomTableAnnonces); ?>
          </div>

          <div id="right">
              <p class="seq-number">№ 078657</p>
              <p class="date"><?php echo substr($row[$j]["Parution"], 0, 10) ?></p>
              <p class="heure"><?php echo substr($row[$j]["Parution"], 11,15) ?></p>
              <p class="price">$<?php 
                  if ($row[$j]["Prix"] == 0) {
                      echo "Gratuit";
                  } else {
                      echo $row[$j]["Prix"];
                  }
              ?></p>
          </div>
          </a>
             </form>
        </div>

        <?php //var_dump($_SESSION);
        if ($_SESSION["Status"] == 1) {?>
        <div id="admin">
            <button class="btn" onclick="window.location = 'modifier-annonce.php';">Modifier</button></br>

            <button class="btn">Supprimer</button></br>
            <button class="btn">Activer</button>
        </div>
        <?php }?>

        <?php }?>





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
