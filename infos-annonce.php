<?php 
    require_once "variable-session-init.php";
    require_once "librairies-communes-2017-04-07.php";
    require_once 'connexion-bd.php';
    $NumAnnonce = get('NoAnnonceClick');
    preg_match_all('!\d+!', $NumAnnonce, $NumAnnonce);
    $NumAnnonce = $NumAnnonce[0][0];


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

        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/main.css">
        <script src="js/vendor/modernizr-2.8.3.min.js"></script>
        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script>
    </head>

    <body>

<header style="background-color: 000;background-image: url('img/nq-bg3.jpg');background-size: cover;width: 100%;height: auto;">
  <img src="img/nq-logo2.png" alt="Smil ey face" height="150px" width="auto">


<?php require_once 'navigation.php';?>


</header>
      <main>

        <h1>Informations sur une annonce:</h1>
        
        <?php 
            $oBD->selectionneEnregistrements($strNomTableAnnonces,"C=NoAnnonce=$NumAnnonce");
            $row = mysqli_fetch_all($oBD->_listeEnregistrements, MYSQLI_ASSOC);
        ?>


      <div id="content2">

          <img src="img/<?php echo $row[0]["Photo"] === "default.png" ? "default2.png" :  $row[0]["Photo"] ;?>" alt="Aucune image" height="500px" width="500px">
          <div id="left2">
            <h2><?php echo $row[0]["DescriptionAbregee"] ?></h2>
            
             <?php $oBD->selectionneEnregistrements($strNomTableCategories,"C=NoCategorie=" . $row[0]["Categorie"]);
            $row2 = mysqli_fetch_all($oBD->_listeEnregistrements, MYSQLI_ASSOC);
            ?>
            <p class="categorie2">Categorie: <?php echo $row2[0]["Description"]?></p>

            <p class="desc"><?php 
                                if($row[0]["DescriptionComplete"] == "") {   
                                   echo "Aucune description."; 
                               }
                               else {  
                                   echo $row[0]["DescriptionComplete"]; 
                               }
                                ?> </p>
            
             <?php $oBD->selectionneEnregistrements($strNomTableUtilisateurs,"C=NoUtilisateur=" . $row[0]["NoUtilisateurs"]);
            $row3 = mysqli_fetch_all($oBD->_listeEnregistrements, MYSQLI_ASSOC);
            ?>
            <p class="nom"><?php echo $row3[0]["Nom"] . ', ' . $row3[0]["Prenom"]?></p>
            <a class="nom" href=""><?php echo $row3[0]["Courriel"] ?></a>
          </div>

          <div id="right2">
              <p class="price"><?php 
                  if ($row[0]["Prix"] == 0) {
                      echo "Gratuit";
                  } else {
                      echo str_replace(".", ",", $row[0]["Prix"]) . "$";
                  }
              ?></p>
              <p class="seq-number">№ <?php echo ajouteZeros($row[0]["NoAnnonce"], 4) ?></p>
              <p class="date"><?php echo substr($row[0]["Parution"], 0, 10) ?></p>
              <p class="heure"><?php echo substr($row[0]["Parution"], 11,15) ?></p>
          </div>


        </div>
        
        <?php //var_dump($_SESSION); 
        if ($_SESSION["Status"] == 1 || $row[0]["NoUtilisateurs"] == $_SESSION["NoUtilisateur"]) {?>

        <div id="admin2">
           <button class="btn" onclick="window.location = 'modifier-annonce.php';">Modifier</button>
            <button class="btn">Supprimer</button>
            <button class="btn">Activer</button>
        </div>
        <?php }?>





       </main>

            <?php require_once "pied-de-page.php"?>

    </body>
</html>
