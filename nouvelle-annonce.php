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
    </head>

    <body>

<header style="background-color: 000;background-image: url('img/nq-bg2.jpg');background-size: cover;width: 100%;height: auto;">
  <img src="img/nq-logo2.png" alt="Smiley face" height="150px" width="auto">


<?php require_once 'navigation.php';?>

</header>
      <main>

        <h1>Inscription d'une nouvelle annonce:</h1>

      <div id="content2">

        <form>
                        <table  width="100%" cellpadding="10" bgcolor="#FFFFFF">

                            <tr>
                                <td style="font-weight: bold;font-size: 110%">Categorie</td>
                                <td >
                                    <select class="annonces" name="Categorie">
                                        <option value="">Voitures</option>
                                        <option value="">Accéssoires</option>
                                        <option value="">Électronique</option>
                                        <option value="">Vêtements</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td style="font-weight: bold;font-size: 110%">Description abregee</td>
                                <td>
                                    <input class="sInput" type="text" name="DescAbregee" height="10">
                                </td>
                            </tr>
                            <tr>
                                <td style="font-weight: bold;font-size: 110%">Description Complete</td>
                                <td>
                                    <textarea class="sInput" name="DescComplete" rows="10" cols="50"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td style="font-weight: bold;font-size: 110%">Prix</td>
                                <td>
                                    <input id="gratuit" name="payant" type="radio" value="PAYANT" checked="checked"/><label style="font-weight: bold;font-size: 110%; padding-left: 1em;">$</label>
                                    <input class="sInput" type="number" name="Prix" min="1" step="any" ><br />
                                    <input id="gratuit" name="gratuit" type="radio" value="GRATUIT"/><label style="font-weight: bold;font-size: 110%; padding-left: 1em;">Gratuit</label><br />
                                    <input id="gratuit" name="echange" type="radio" value="ECHANGE"/><label style="font-weight: bold;font-size: 110%; padding-left: 1em;">Échange</label><br />
                                    <input id="gratuit" name="contacter" type="radio" value="CONTACTER"/><label style="font-weight: bold;font-size: 110%; padding-left: 1em;">Contacter</label><br />
                                </td>
                            </tr>
                            <tr>
                                <td style="font-weight: bold;font-size: 110%">Image</td>
                                <td>
                                    <input class="sInput" type="file" name="img">
                                </td>
                            </tr>
                            <tr>
                                <td style="font-weight: bold;font-size: 110%">Etat</td>
                                <td>
                                  <select class="annonces">
                                     <option disabled selected hidden>Statut</option>
                                     <option name="EtatActif" value="1">Actif</option>
                                     <option name="EtatInactif" value="0">Inactif</option>
                                  </select>

                                </td>
                            </tr>
                            <tr>
                        </table>
                    </form>

                    <input type="submit" class="btn" style="width: 17em; margin-top: 2em;" value="Inscrire nouvelle annonce" onclick="window.location = 'annonces.php';">


      </div>


       </main>

           <?php require_once "pied-de-page.php"?>

    </body>
</html>