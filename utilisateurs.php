<!doctype html>
    <?php
        require_once "classe-fichier-2017-04-26.php";
        require_once "classe-mysql-2017-04-26.php";
        require_once "librairies-communes-2017-04-07.php";
        require_once "fonctions-specifiques-projet-final.php";
        require_once "connexion-bd.php";
        
        $strNomBD = "bdh17_cherifi";
        
        //var_dump($_SESSION);
        
        $strNomTableUtilisateurs ="utilisateurs";
        $strNomTableConnexions ="connexions";
        $strNomTableCategories ="categories";
        $strNomTableAnnonces ="annonces";
        
        //$oBD2 = new mysql($strNomBD, "424w-cgodin-qc-ca.php");
        
        
        $tabChampsTableUtil = array("NoUtilisateur","Courriel","MotDePasse","Creation","NbConnexions","Status","NoEmpl","Nom","Prenom","NoTelMaison","NoTelTravail","NoTelCellulaire","Modification","AutresInfos");

    ?>
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
<?php
        //session_start();
        

    ?>

</header>
      <main>

        <h1>Liste de tous les utilisateurs:</h1>

      <div id="content3">

        <table border="1px" class="sTable">
          <tr>
              <th>No.</th>
              <th>Courriel</th>
              <th>Nom</th>
              <th>Prénom</th>
              <th>Numéro d'employé</th>
              <th>Téléphone maison</th>
              <th>Téléphone travail</th>
              <th>Téléphone cellulaire</th>
              <th>*Annonces A / I / S</th>
              <th>Nombre de connexions</th>
              <th>Statut</th>
              <th>Date de création</th>
              <th>Derniêre modification</th>
              <th>5 dernières connexions</th>
              <th>Autres infos</th>
          </tr>
          

          <?php for ($i = 0; $i < $oBD->selectionneEnregistrements($strNomTableUtilisateurs); $i++) {
                  $row = mysqli_fetch_all($oBD->_listeEnregistrements, MYSQLI_ASSOC);
<<<<<<< HEAD
                  

           ?>
=======
                  //var_dump($_SESSION['objBD']->selectionneEnregistrements($strNomTableUtilisateurs));
              ?>
>>>>>>> origin/master
          <tr style="font-size: 70%">

              <td><?php echo $row[$i]['NoUtilisateur']?></td>
              <td><?php echo $row[$i]['Courriel']?></td>
                <td><?php echo $row[$i]['Nom']?></td>
                <td><?php echo $row[$i]['Prenom']?></td>
                <td><?php echo $row[$i]['NoEmpl']?></td>
                <td><?php echo $row[$i]['NoTelMaison']?></td>
                <td><?php echo $row[$i]['NoTelTravail']?></td>
                <td><?php echo $row[$i]['NoTelCellulaire']?></td>
                <td>007 / 005 / 002</td>
                <td><?php echo ajouteZeros($row[$i]['NbConnexions'], 3)?></td>
                <td ><?php 
                        if ($row[$i]['Status'] == 0) {
                            echo "(" . $row[$i]['Status'] . ") En attente"; 
                        } elseif ($row[$i]['Status'] == 9) {
                            echo "(" . $row[$i]['Status'] . ") Confirmé"; 
                        } elseif ($row[$i]['Status'] == 1) {
                            echo "(" . $row[$i]['Status'] . ") Administrateur"; 
                        } elseif ($row[$i]['Status'] == 2) {
                            echo "(" . $row[$i]['Status'] . ") Cadre"; 
                        } elseif ($row[$i]['Status'] == 3) {
                            echo "(" . $row[$i]['Status'] . ") Employé de soutien"; 
                        } elseif ($row[$i]['Status'] == 4) {
                            echo "(" . $row[$i]['Status'] . ") Enseignant"; 
                        } elseif ($row[$i]['Status'] == 5) {
                            echo "(" . $row[$i]['Status'] . ") Professionnel"; 
                        }
                        ?></td>
                <td><?php echo $row[$i]['Creation']?></td>
                <td><?php echo $row[$i]['Modification']?></td>
                <td style="font-size: 75%; font-weight:bold; text-align:center;">• 17-04-2017 18:32:03</br>
                    • 17-04-2017 18:32:03</br>
                    • 17-04-2017 18:32:03</br>
                    • 17-04-2017 18:32:03</br>
                    • 17-04-2017 18:32:03</td>
               <td><?php echo $row[$i]['AutresInfos']?></td>
          </tr>
          <?php }?>

      </table>

        <p style="font-size: 60%">*A : Annonce(s) active(s)</br>
                          *I : Annonce(s) inactive(s)</br>
                          *S : Annonce(s) supprimé(s)</p>
        <div id="admin2">
            <button class="btn" onClick="window.location.reload()">Actualiser</button>
        </div>

       </main>

            <?php require_once "pied-de-page.php"?>

    </body>
</html>
