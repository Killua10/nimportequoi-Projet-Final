<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * 
 */

session_start();
var_dump($_SESSION["Courriel"]);

 if (!isset($_SESSION["Courriel"]) || $_SESSION["Courriel"] == '') {
          echo '<script language="javascript">';
          echo 'alert("Session expirée")';
          echo '</script>';?>
    <script>window.location = 'connexion.php';</script>
    <?php }?>

