<?php require_once "librairies-communes-2017-04-07.php";
    require_once "fonctions-specifiques-projet-final.php";?>
<nav>
  <ul class="menuHaut">
      <?php session_start();?>
      <?php if ($_SESSION["Courriel"] == '' ) {
                echo '<script language="javascript">';
                echo 'alert("Session expirée")';
                echo '</script>';?>
          <script>window.location = 'connexion.php';</script>
      <?php }?>
    <li><a onclick="window.location = 'annonces.php';">Annonces</a></li>
    <li ><a onclick="window.location = 'mon-compte.php';">Mon compte</a></li>
    <?php if ($_SESSION["Status"] != 1) {?>
    <li ><a onclick="window.location = 'mes-annonces.php';">Mes annonces</a></li>
    <li ><a onclick="window.location = 'nouvelle-annonce.php';">Nouvelle annonce</a></li>
    <?php }?>
    <?php if ($_SESSION["Status"] == 1) {?>
    <li><a onclick="window.location = 'gestion-annonce.php';"><u>Gestion d'annonces</u></a></li>
    <li><a onclick="window.location = 'nettoyage-bd.php';"><u>Nettoyage de la BD</u></a></li>
    <li ><a onclick="window.location = 'utilisateurs.php';"><u>Gestion d'utilisateurs</u></a></li>
    <?php }?>
    <li style="float:right; margin-left:1em"><a  onclick="window.location = 'connexion.php';">Déconnexion</a></li>

  </ul>
</nav>