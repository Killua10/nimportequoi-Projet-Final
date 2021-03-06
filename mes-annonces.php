<?php require_once "variable-session-init.php";
require_once 'connexion-bd.php';?>
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
  
    <script language="JavaScript" type="text/javascript">

    function getsupport ( selectedtype )
    {
      document.frmAnnonces.NoAnnonceClick.value = selectedtype ;
      document.frmAnnonces.submit() ;
    }

    </script>

<?php require_once 'navigation.php';?>


</header>
      <main>
        <div class="trietrecherche">
            <form id="frmDivRecherche" method="get" action="">
          <select class="annonces" id="ddlAnnoncesParPage" name='ddlAnnoncesParPage' onchange="form.submit()">
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
          <button class="btn" id="recherche" name='recherche'>Recherche</button>
          </form>
      </div>

        <h1>Liste des mes annonces</h1>
        
        <?php 
        $InstructionWhere = "C=NoUtilisateurs=" . $_SESSION['NoUtilisateur'];
        if (get('ddlAnnoncesParPage') == null) {
            $getDDL = 10;
        } else {
            $getDDL = get('ddlAnnoncesParPage');
        }
        
        $pagination = afficherPagination($oBD,$getDDL,"",$InstructionWhere);
        //$oBD->selectionneEnregistrements($strNomTableAnnonces,"C=NoUtilisateurs=" . $_SESSION['NoUtilisateur']);
        $nbrAnnonces = ($oBD->_nbEnregistrements == -1 ?  0 :  $oBD->_nbEnregistrements);
        ?>
        
        <h3>Vous avez <?php echo ($oBD->_nbEnregistrements == -1 ?  0 :  $oBD->_nbEnregistrements); ?> annonces.</h3>
        <form name="frmAnnonces" id="frmAnnonces" method="get" action="infos-annonce.php">
            <input type="hidden" name="NoAnnonceClick" />


        <?php
            //var_dump( mysqli_fetch_all($oBD->_listeEnregistrements,MYSQLI_ASSOC));
        if ($nbrAnnonces != 0) {
                $row = mysqli_fetch_all($oBD->_listeEnregistrements, MYSQLI_ASSOC);
                for ($j = 0; $j < ($nbrAnnonces < $getDDL ? $nbrAnnonces : $getDDL); $j++) {
                    
                //var_dump($row);
                //if ($row['Statut'] == 1) 
                         ?>
          <div id="content">
            <a href="javascript:getsupport('annonce<?php echo $row[$j]["NoAnnonce"] ?>')" id='annonce<?php echo $row[$j]["NoAnnonce"] ?>' name='annonce<?php echo $row[$j]["NoAnnonce"] ?>'>
            <div id="fix"></div>
            <p class="number"><?php echo ajouteZeros($j+1, 3) ?></p>

          <img src="img/<?php echo $row[$j]["Photo"]?>" alt="Aucune image" height="144px" width="144px">
          <h2><?php echo $row[$j]["DescriptionAbregee"] ?></h2>
          <div id="left">
            <p class="desc"><?php 
                               if (strlen($row[$j]["DescriptionComplete"]) > 40) {
                                   echo substr($row[$j]["DescriptionComplete"], 0, 40) . "...";
                               }
                               elseif($row[$j]["DescriptionComplete"] == "") {   
                                   echo "Aucune description."; 
                               }
                               else {  
                                   echo $row[$j]["DescriptionComplete"]; 
                               }
                                ?></p>
            
            <?php $oBD->selectionneEnregistrements($strNomTableUtilisateurs,"C=NoUtilisateur=" . $_SESSION['NoUtilisateur']);
            $row3 = mysqli_fetch_all($oBD->_listeEnregistrements, MYSQLI_ASSOC);
            //var_dump($row3);
            ?>
            <p class="nom"><?php echo $row3[0]["Nom"] . ', ' . $row3[0]["Prenom"]?></p>
            
            <?php $oBD->selectionneEnregistrements($strNomTableCategories);
            $row2 = mysqli_fetch_all($oBD->_listeEnregistrements, MYSQLI_ASSOC);
            ?>
            <p class="categorie">Categorie: <?php echo $row2[$row[$j]["Categorie"]-1]["Description"] ?></p>
            <?php $oBD->selectionneEnregistrements($strNomTableAnnonces); ?>
          </div>

          <div id="right">
              <p class="seq-number">№ <?php echo ajouteZeros($row[$j]["NoAnnonce"], 4) ?></p>
              <p class="date"><?php echo substr($row[$j]["Parution"], 0, 10) ?></p>
              <p class="heure"><?php echo substr($row[$j]["Parution"], 11,15) ?></p>
              <p class="price"><?php 
                  if ($row[$j]["Prix"] == 0) {
                      echo "Gratuit";
                  } else {
                      echo str_replace(".", ",", $row[$j]["Prix"]) . "$";
                  }
              ?></p>
          </div>
          </a>
        </div>
        
        <form name="frmBtnAnnonces" id="frmBtnAnnonces" method="get" action="">
            <div id="admin">
                
                <button id="btnModifier" name="btnModifier" class="btn" type="submit" value="Modifier<?php echo $row[$j]["NoAnnonce"]?>" onclick="window.location = 'modifier-annonce.php';">Modifier</button></br>

                <button id="btnSupprimer" name="btnSupprimer" type="submit" value="Supprimer<?php echo $row[$j]["NoAnnonce"]?>" class="btn">Supprimer</button></br>
                
                <button id="btnActiver" name="btnActiver" type="submit" value="Activer<?php echo $row[$j]["NoAnnonce"]?>" class="btn">Activer</button>
            </div>
        </form>
        
        <?php }?>
            
            

         <?php }?>
            </form>
        
        <?=$pagination ?>
        
         <?php
        
            $btnModifier = get("btnModifier");
            $btnSupprimer = get("btnSupprimer");
            $btnActiver = get("btnActiver");
        
            if (isset($btnModifier) ) {
                preg_match_all('!\d+!', $btnModifier, $btnModifier);
                $btnModifier = $btnModifier[0][0];

            }

            if (isset($btnSupprimer)) {
                preg_match_all('!\d+!', $btnSupprimer, $btnSupprimer);
                $btnSupprimer = $btnSupprimer[0][0];
                $oBD->majEnregistrement($strNomTableAnnonces,"Etat=2" ,"NoAnnonce=" . $btnSupprimer);
            }

            if (isset($btnActiver)) {
                preg_match_all('!\d+!', $btnActiver, $btnActiver);
                $btnActiver = $btnActiver[0][0];
                $oBD->majEnregistrement($strNomTableAnnonces,"Etat=1" ,"NoAnnonce=" . $btnActiver);
            }?>

       </main>


            <?php require_once "pied-de-page.php"?>

    </body>
</html>
