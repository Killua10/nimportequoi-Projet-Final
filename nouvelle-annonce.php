<?php require_once "variable-session-init.php";?>
<!doctype html>
<?php

    require_once 'classe-mysql-2017-04-26.php';
    require_once 'classe-fichier-2017-04-26.php';
    require_once 'librairies-communes-2017-04-07.php';
    require_once 'connexion-bd.php';
    
    $getBtnNvAnnonce = get('btnNvAnnonce');
    $getCategorie = get('Categorie');
    $getDescAbregee = get('DescAbregee');
    $getDescComplete = get('DescComplete');
    $getCbPrix = get('cbPrix');
    $getPrix = get('Prix');
    $getImg = get('img');
    $getEtat = get('ddlEtat');
    
    $alerteEnregistrement = 0; // 1 = avertisement 2 = Attention 3 = Succès
    var_dump($getEtat);
    if (isset($getBtnNvAnnonce)){
        if ($getCategorie == null || $getCategorie == '') {
            $alerteEnregistrement = 1;
            $strMsgAlerteEnregistrement = "Veuillez entrer une catégorie.";
        }
        elseif ($getDescAbregee == '') {
            $alerteEnregistrement = 1;
            $strMsgAlerteEnregistrement = "Veuillez inscrire une description abrégée.";
        }
        elseif ($getDescComplete == '') {
            $alerteEnregistrement = 1;
            $strMsgAlerteEnregistrement = "Veuillez inscrire une description complète.";
        }
        elseif ($getEtat == null || $getEtat == -1) {
            $alerteEnregistrement = 1;
            $strMsgAlerteEnregistrement = "Veuillez séléctionnée un etat.";
        }
        elseif ($getCbPrix == null) {
            $alerteEnregistrement = 1;
            $strMsgAlerteEnregistrement = "Veuillez séléctionner un prix.";
        }
        elseif ($getCbPrix == "PAYANT") {
            if ($getPrix == '') {
                $alerteEnregistrement = 1;
                $strMsgAlerteEnregistrement = "Veuillez inscrire un prix.";
            }
        }
        
        if($alerteEnregistrement == 0) {
            $alerteEnregistrement = 3;
            $strMsgAlerteEnregistrement = "Succès! Nouvelle annonce enregistrée.";
            
            $oBD->selectionneEnregistrements($strNomTableUtilisateurs,"C=NoUtilisateur=" . $_SESSION["NoUtilisateur"]);
            $row2 = mysqli_fetch_all($oBD->_listeEnregistrements, MYSQLI_ASSOC);
            
            $resultat = $oBD->selectionneEnregistrements($strNomTableAnnonces,"D=NoAnnonce","T=NoAnnonce DESC");
            $row3 = mysqli_fetch_all($oBD->_listeEnregistrements,MYSQLI_ASSOC);
            $NoAnnonce = $row3[0]["NoAnnonce"]+1;
            $date = date("Y-m-d H:i:s");
            
            if ($getCbPrix == "PAYANT") {
                $Prix = $getPrix;
            }
            elseif ($getCbPrix == "GRATUIT") {
                $Prix = 0;
            }
            
            if ($getImg == "" || $getImg == null) {
                $Img = "default.png";
            }
            else {
                $Img = $getImg;
            }
            
            $oBD->insereEnregistrement($strNomTableAnnonces,$NoAnnonce,intval($_SESSION["NoUtilisateur"]),$date,$getCategorie,$getDescAbregee,$getDescComplete,$Prix,$Img,$date,intval($getEtat));
    
        }
        var_dump($alerteEnregistrement);
    }
    
    
    
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
        <link rel="stylesheet" href="css/alertboxes.css">
    </head>

    <body>

<header style="background-color: 000;background-image: url('img/nq-bg2.jpg');background-size: cover;width: 100%;height: auto;">
  <img src="img/nq-logo2.png" alt="Smiley face" height="150px" width="auto">


<?php require_once 'navigation.php';?>

</header>
      <main>

        <h1>Inscription d'une nouvelle annonce:</h1>

      <div id="content2">

                    <form id="frmSaisie"  method="get" action="">
                        <table  width="100%" cellpadding="10" bgcolor="#FFFFFF">

                            <tr>
                                <td style="font-weight: bold;font-size: 110%">Categorie</td>
                                <td >
                                    <select class="annonces" id='Categorie' name="Categorie">
                                        <?php 
                                            for ($i = 0; $i < $oBD->selectionneEnregistrements($strNomTableCategories); $i++) {
                                                $row = mysqli_fetch_all($oBD->_listeEnregistrements, MYSQLI_ASSOC);
                                        ?>
                                            <option value="<?php echo $row[$i]["NoCategorie"]?>"><?php echo $row[$i]["Description"]?></option>
                                        <?php }?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td style="font-weight: bold;font-size: 110%">Description abregee</td>
                                <td>
                                    <input class="sInput" type="text" id='DescAbregee' name="DescAbregee" height="10" value='<?php echo ($getDescAbregee == '' ? '' : $getDescAbregee)?>'>
                                </td>
                            </tr>
                            <tr>
                                <td style="font-weight: bold;font-size: 110%">Description Complete</td>
                                <td>
                                    <textarea class="sInput" id='DescComplete' name="DescComplete" rows="10" cols="50" ><?php echo ($getDescComplete == '' ? '' : $getDescComplete)?></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td style="font-weight: bold;font-size: 110%">Prix</td>
                                <td>
                                    <script>
                                    if (document.getElementById('payant').checked == false) {
                                        document.getElementById('inputPrix').disabled = true;
    
                                    }
                                    </script>
                                    <input id="payant" name="cbPrix" type="radio" value="PAYANT" /><label style="font-weight: bold;font-size: 110%; padding-left: 1em;">$</label><input id="inputPrix" class="sInput" type="number" name="Prix" min="1" step="any" ><br />
                                    <input id="gratuit"  name="cbPrix" type="radio"  value="GRATUIT"/><label style="font-weight: bold;font-size: 110%; padding-left: 1em;">Gratuit</label><br />
                                </td>
                            </tr>
                            <tr>
                                <td style="font-weight: bold;font-size: 110%">Image</td>
                                <td>
                                    <input class="sInput" type="file" id='img' name="img" accept="image/*">
                                </td>
                            </tr>
                            <tr>
                                <td style="font-weight: bold;font-size: 110%">Etat</td>
                                <td>
                                    <select class="annonces" id="ddlEtat" name="ddlEtat">
                                     <option disabled selected hidden id='EtatNull' name="EtatNull" value="-1">Etat</option>
                                     <option id='EtatActif' name="EtatActif" value="1">Actif</option>
                                     <option id='EtatInactif' name="EtatInactif" value="0">Inactif</option>
                                  </select>

                                </td>
                            </tr>
                            
                            <tr>
                                <td>
                                    <input type="submit" id="btnNvAnnonce" name="btnNvAnnonce" class="btn" style="width: 17em; margin-top: 2em;" value="Inscrire nouvelle annonce" onclick="window.location = 'annonces.php';">
                                </td>
                                <td>
                                    <div style="margin-bottom: 10px;">
                                    <?php if ($alerteEnregistrement == 1) { ?>
                                    <div class="alert-box warning">
                                            <h4>Avertissement! <span><?php echo $strMsgAlerteEnregistrement;?></span></h4>
                                    </div>
                                    <?php } elseif($alerteEnregistrement == 2){?>
                                    <div class="alert-box attention">
                                            <h4>Attention! <span><?php echo $strMsgAlerteEnregistrement;?></span></h4>
                                    </div>
                                    <?php } elseif($alerteEnregistrement == 3){ ?>
                                    <div class="alert-box done">
                                            <h4>Succès! <span><?php echo $strMsgAlerteEnregistrement;?></span></h4>
                                    </div>
                                    <?php $alerteEnregistrement = 0;}?>
                                    </div>
                                 </td>
                            </tr>
                        </table>
          
          </form>


      </div>


       </main>

           <?php require_once "pied-de-page.php"?>

    </body>
</html>