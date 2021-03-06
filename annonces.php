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
          <script>

            /* Pour passer plusieurs formes en GET */
            soumetFrm = function(){
                /* Chercher le formulaire par le nom */
                document.forms["ddlAnnoncesParPage"].submit();
                document.forms["ddlTri"].submit();
                document.forms["champRecherche"].submit();
                document.forms["contenuRecherche"].submit();
                document.forms["dateDepuis"].submit();
                document.forms["dateJusqua"].submit();
            }

          </script>
        <div class="trietrecherche">
            <form id="frmDivRecherche" method="get" action="">
          <select class="tri" id="ddlAnnoncesParPage" name='ddlAnnoncesParPage' onchange="soumetFrm()">
           <option disabled selected hidden> # Annonces</option>
           <option value="5">5 par page</option>
           <option value="10">10 par page</option>
           <option value="15">15 par page</option>
           <option value="20">20 par page</option>
          </select>


          <select class="tri" id="ddlTri" name="ddlTri" onchange="soumetFrm()">
           <option disabled selected hidden> Trié par</option>
           <option value="DateParutionCroissant">Date Parution - Croissant</option>
           <option value="DateParutionDecroissant">Date Parution - Déroissant</option>
           <option value="CategorieCroissant">Catégorie - Croissant</option>
           <option value="CategorieDecroissant">Catégorie - Déroissant</option>
           <option value="DescriptionAbregeeCroissant">Description Abrégée - Croissant</option>
           <option value="DescriptionAbregeeDecroissant">Description Abrégée - Déroissant</option>
          </select>
            <br />

           <input id="cbAuteur" name="cbAuteur" type="checkbox" name="Auteur" value="Auteur">Auteur<br>
           <input id="cbCategorie" name="cbCategorie" type="checkbox" name="Categorie" value="Categorie">Catégorie<br>
           <input id="cbDescription" name="cbDescription" type="checkbox" name="Description" value="Description">Description<br>

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
            <input class="sInput" type="date" value="" placeholder="Depuis" id="dateDepuis" name="dateDepuis" onchange="soumetFrm()">
            <input class="sInput" type="date" value="" placeholder="Jusqu'à" id="dateJusqua" name="dateJusqua" onchange="soumetFrm()"><br>

            <input class="recherche" id="contenuRechercheAuteur" name="contenuRecherche" placeholder="Entrez votre recherche ici..." onchange="soumetFrm()"></input>
            <input class="recherche" id="contenuRechercheCategorie" name="contenuRechercheCategorie" placeholder="Entrez votre recherche ici..." onchange="soumetFrm()"></input>
            <input class="recherche" id="contenuRechercheDescription" name="contenuRechercheDescription" placeholder="Entrez votre recherche ici..." onchange="soumetFrm()"></input>
          <button type="submit" class="btn" id="recherche" name="recherche">Recherche</button>
          </form>
      </div>

        <h1>Liste des annonces</h1>
        <?php
        $InstructionWhere = "C=Etat=1";
        if (get('ddlAnnoncesParPage') == null) {
            $getDDL = 10;
        } else {
            $getDDL = get('ddlAnnoncesParPage');
        }

         /* Le tri par colonnes */
        switch (get('ddlTri')) {
            case 'DateParutionCroissant':
                $Tri = "T=Parution ASC";
                $pagination = afficherPagination($oBD, $getDDL, $Tri, $InstructionWhere);
            break;
            case 'DateParutionDecroissant':
                $Tri = "T=Parution DESC";
                $pagination = afficherPagination($oBD, $getDDL, $Tri, $InstructionWhere);
            break;
            case 'CategorieCroissant':
                $Tri = "T=Categorie ASC";
                $pagination = afficherPagination($oBD, $getDDL, $Tri, $InstructionWhere);
            break;
            case 'CategorieDecroissant':
                $Tri = "T=Categorie DESC";
                $pagination = afficherPagination($oBD, $getDDL, $Tri, $InstructionWhere);
            break;
            case 'DescriptionAbregeeCroissant':
                $Tri = "T=DescriptionAbregee ASC";
                $pagination = afficherPagination($oBD, $getDDL, $Tri, $InstructionWhere);
            break;
            case 'DescriptionAbregeeDecroissant':
                $Tri = "T=DescriptionAbregee DESC";
                $pagination = afficherPagination($oBD, $getDDL, $Tri, $InstructionWhere);
            break;
            default:
                 /* La recherche par champ */
                $contenuRechercheAuteur = get('contenuRechercheAuteur');
                $contenuRechercheCategorie = get('contenuRechercheCategorie');
                $contenuRechercheDescription = get('contenuRechercheDescription');
                $cbAuteur = get('cbAuteur');
                $cbCategorie = get('cbCategorie');
                $cbDescription = get('cbDescription');
                $tabCheck = array($cbAuteur, $cbCategorie, $cbDescription);
                $tabContenu = array($contenuRechercheAuteur, $contenuRechercheCategorie, $contenuRechercheDescription);
                //var_dump($tabCheck);
                rechercheParChamp($oBD, $tabCheck, $tabContenu);
                    default :
                        $pagination = afficherPagination($oBD,$getDDL,"",$InstructionWhere);
                        break;
            break;
        }

        //$pagination = afficherPagination($oBD,$getDDL,"",$InstructionWhere);


        $nbrAnnonces = ($oBD->_nbEnregistrements == -1 ?  0 :  $oBD->_nbEnregistrements);
        //var_dump($nbrAnnonces);
        //var_dump($pagination);?>
        <h3> <?php echo ($oBD->_nbEnregistrements == -1 ?  0 :  $oBD->_nbEnregistrements);?> annonces ont été générées. Listez votre annonce dès aujourd'hui!</h3>

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
                                ?> </p>

            <?php $oBD->selectionneEnregistrements($strNomTableUtilisateurs,"C=NoUtilisateur=" . $row[$j]["NoUtilisateurs"]);

            $row3 = mysqli_fetch_all($oBD->_listeEnregistrements, MYSQLI_ASSOC);
            ?>
            <p class="nom"><?php echo $row3[0]["Nom"] . ', ' . $row3[0]["Prenom"]?></p>

            <?php $oBD->selectionneEnregistrements($strNomTableCategories);
            $row2 = mysqli_fetch_all($oBD->_listeEnregistrements, MYSQLI_ASSOC);
            ?>
            <p class="categorie">Categorie: <?php echo $row2[$row[$j]["Categorie"]-1]["Description"] ?></p>
            <?php $oBD->selectionneEnregistrements($strNomTableAnnonces); ?>
          </div>

          <div id="right">
              <p class="seq-number" id="noAnnonce" name="noAnnonce" >№ <?php echo ajouteZeros($row[$j]["NoAnnonce"], 4) ?></p>
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
            </form>

        <?php //var_dump($_SESSION);
        if ($_SESSION["Status"] == 1 || $row[$j]["NoUtilisateurs"] == $_SESSION["NoUtilisateur"]) {?>
        <form name="frmBtnAnnonces" id="frmBtnAnnonces" method="get" action="">
            <div id="admin">
                <?php

                ?>

                <button id="btnModifier" name="btnModifier" class="btn" type="submit" value="Modifier<?php echo $row[$j]["NoAnnonce"]?>" onclick="window.location = 'modifier-annonce.php';">Modifier</button></br>

                <button id="btnModifier" name="btnModifier" class="btn" type="submit" value="Modifier<?php echo $row[$j]["NoAnnonce"]?>" class="btn">Supprimer</button></br>

                <button id="btnActiver" name="btnActiver" type="submit" value="Activer<?php echo $row[$j]["NoAnnonce"]?>" class="btn">Activer</button>
            </div>
        </form>
        <?php }

            ?>

        <?php }?>

	<?php


		/*while($row = mysql_fetch_array($tabResultatFonction[0])){
                    echo "meow";
		}*/
	?>

<?=$pagination ?>

         <!-- <div class="pagination">
            <form id="frmAnnonces" method="get" action="">
                <a href="#">❮❮</a>
                <a href="#">❮</a>
                <input type="number" id='lstPagination' name="lstPagination" value="1" min="1">
                <a href="#">❯</a>
                <a href="#">❯❯</a>
            </form>
          </div>-->
        <?php }

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
