<nav>
  <ul class="menuHaut">
      <?php session_start();?>
    <li><a onclick="window.location = 'annonces.php';">Annonces</a></li>
    <li ><a onclick="window.location = 'mon-compte.php';">Mon compte</a></li>
    <?php if ($_SESSION["Status"] != 1) {?>
    <li ><a onclick="window.location = 'mes-annonces.php';">Mes annonces</a></li>
    <?php }?>
    <li ><a onclick="window.location = 'nouvelle-annonce.php';">Nouvelle annonce</a></li>
    <?php if ($_SESSION["Status"] == 1) {?>
    <li><a onclick="window.location = 'gestion-annonce.php';"><u>Gestion d'annonces</u></a></li>
    <li><a onclick="window.location = 'nettoyage-bd.php';"><u>Nettoyage de la BD</u></a></li>
    <li ><a onclick="window.location = 'utilisateurs.php';"><u>Gestion d'utilisateurs</u></a></li>
    <?php }?>
    <li style="float:right; margin-left:1em"><a  onclick="window.location = 'connexion.php';">Déconnexion</a></li>

  </ul>
</nav>