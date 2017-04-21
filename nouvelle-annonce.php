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


<nav>
  <ul class="menuHaut">

    <li><a onclick="window.location = 'annonces.html';">Annonces</a></li>
    <li ><a onclick="window.location = 'mon-compte.php';">Mon compte</a></li>
    <li ><a onclick="window.location = 'mes-annonces.php';">Mes annonces</a></li>
    <li ><a onclick="window.location = 'nouvelle-annonce.html';">Nouvelle annonce</a></li>
    <li><a onclick="window.location = 'gestionAnnonces.php';">Géstion d'annonces</a></li>
    <li ><a onclick="window.location = 'utilisateurs.html';">Géstion d'utilisateurs</a></li>
    <li style="float:right" "margin-left:1em"><a  onclick="window.location = 'connexion.html';">Déconnexion</a></li>

  </ul>
</nav>


</header>
      <main>

        <h1>Inscription d'une nouvelle annonce:</h1>

      <div id="content2">

        <form>
                        <table  width="40%" cellpadding="10" bgcolor="#FFFFFF">

                            <tr>
                                <td style="font-weight: bold;font-size: 110%">Categorie</td>
                                <td >
                                    <select class="annonces" name="Categorie">
                                        <option value="volvo">Categorie 1</option>
                                        <option value="saab">Categorie 2</option>
                                        <option value="fiat">Categorie 3</option>
                                        <option value="audi">Categorie 4 Test</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td style="font-weight: bold;font-size: 110%">Description abregee</td>
                                <td>
                                    <input type="text" name="DescAbregee" height="10" style="height: 20px;width: 100%;">
                                </td>
                            </tr>
                            <tr>
                                <td style="font-weight: bold;font-size: 110%">Description Complete</td>
                                <td>
                                    <textarea name="DescComplete" rows="10" cols="50"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td style="font-weight: bold;font-size: 110%">Prix</td>
                                <td>
                                    <input type="number" name="Prix" min="1" step="any" ><label>$</label>
                                </td>
                            </tr>
                            <tr>
                                <td style="font-weight: bold;font-size: 110%">Image</td>
                                <td>
                                    <input type="file" name="img">
                                </td>
                            </tr>
                            <tr>
                                <td style="font-weight: bold;font-size: 110%">Etat</td>
                                <td>
                                    <input type="radio" name="Etat" value="Actif" checked> Actif<br>
                                    <input type="radio" name="Etat" value="Inactif"> Inactif<br>
                                </td>
                            </tr>
                            <tr>
                        </table>
                    </form>

                    <input type="submit" class="btn" value="Inscrire nouvelle annonce" onclick="window.location = 'annonces.php';">


      </div>



       </main>

           <footer>2017 Ariel Sashcov</footer>

    </body>
</html>
