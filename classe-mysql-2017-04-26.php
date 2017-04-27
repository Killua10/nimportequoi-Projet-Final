<?php
   /*
   |----------------------------------------------------------------------------------------|
   | class mysql
   |----------------------------------------------------------------------------------------|
   */
   class mysql {
      /*
      |----------------------------------------------------------------------------------|
      | Attributs
      |----------------------------------------------------------------------------------|
      */
      public $_cBD = null;                       /* Identifiant de connexion */
      public $_listeEnregistrements = null;      /* Liste des enregistrements retournés */
      public $_nomFichierInfosSensibles = "";    /* Nom du fichier 'InfosSensibles' */
      public $_nomBD = "";                       /* Nom de la base de données */
      public $_OK = false;                       /* Opération réussie ou non */
      public $_requete = "";                     /* Requête exécutée */
      public $_nbEnregistrements = 0;
      /*
      |----------------------------------------------------------------------------------|
      | __construct
      |----------------------------------------------------------------------------------|
      */
      function __construct($strNomBD, $strNomFichierInfosSensibles) {
          $this->_nomBD = $strNomBD;
          $this->_nomFichierInfosSensibles = $strNomFichierInfosSensibles;
          $this->connexion();
          $this->selectionneBD();
      }
      /*
      |----------------------------------------------------------------------------------|
      | connexion()
      |----------------------------------------------------------------------------------|
      */
      function connexion() {
          require($this->_nomFichierInfosSensibles);
          $this->_cBD = mysqli_connect("localhost", $strNomAdmin, $strMotPasseAdmin, $this->_nomBD); 
          if (mysqli_connect_errno()) {
              echo "<br />";
              echo "Problème de connexion... " . "Erreur no" . mysqli_connect_errno() . " (" . mysqli_connect_error() . ")";
              die();
          }
          
          return $this->_cBD;
      }
      /*
      |----------------------------------------------------------------------------------|
      | copieEnregistrements
      |----------------------------------------------------------------------------------|
      */
      function copieEnregistrements($strNomTableSource, $strListeChampsSource, $strNomTableCible, $strListeChampsCible, $strListeConditions="") {
         /* Réf.: www.lecoindunet.com/dupliquer-ou-copier-des-lignes-d-une-table-vers-une-autre-avec-mysql-175 */
         if (empty($strListeChampsCible)) {
             $strListeChampsCible = $strListeChampsSource;
         }
          $this->_requete  = "INSERT INTO $strNomTableCible (";
          $this->_requete .= $strListeChampsCible . ") SELECT " . $strListeChampsSource;
          
          $this->_requete .= " FROM $strNomTableSource";
          
          if (strcasecmp($strListeConditions,"") != 0) {
             $this->_requete .= " WHERE $strListeConditions"; 
          }
          
          var_dump($this->_requete);
          
          $this->_OK = mysqli_query($this->_cBD, $this->_requete);
          
          return $this->_OK;
      }
      /*
      |----------------------------------------------------------------------------------|
      | creeTable
      |----------------------------------------------------------------------------------|
      */
      function creeTable($strNomTable) {
          $this->_requete  = "CREATE TABLE $strNomTable (";
          for ($i=1; $i <= func_num_args() - 1 ; $i+=2){
              
              if ($i == func_num_args() - 1) {
                 $this->_requete  .= func_get_arg($i);
              }  else {
                  $strNom = func_get_arg($i);
                  $strType = func_get_arg($i+1);
                  $this->_requete  .= $strNom . " " . $strType . ", ";
              }
              
          }
          //$this->_requete  = "CREATE TABLE $strNomTable (";
          $this->_requete .= ") ENGINE=InnoDB";
          $this->_OK = mysqli_query($this->_cBD, $this->_requete);
          
          return $this->_OK;
      }
      /*
      |----------------------------------------------------------------------------------|
      | creeTableGenerique()
      |----------------------------------------------------------------------------------|
      */
      function creeTableGenerique($strNomTable, $strDefinitions, $strCles) {
          $this->_requete  = "CREATE TABLE $strNomTable (";
          $tabDefinitions = array();
          $tabDefinitions = explode( ';', $strDefinitions);
          //var_dump($tabDefinitions);
          $tabDefinitions2 = array();

          for ($i = 0; $i < count($tabDefinitions) ; $i++){
              $tabDefinitions2[$i] = explode( ',', $tabDefinitions[$i]);
          }
         // var_dump($tabDefinitions2);
          
          for ($i = 0; $i < count($tabDefinitions2); $i++) {
              for ($j = 0; $j < count($tabDefinitions2[$i]); $j+=2) {
                  $strType = $tabDefinitions2[$i][$j];
                  $strNom = $tabDefinitions2[$i][$j+1];
                  //var_dump($tabDefinitions2[$i][$j+1]);
                  //echo $strNom;
                  
                 
                  //var_dump(substr($strType,0,1));
                  switch (substr($strType,0,1)) {
                      case "B":
                          $strType = "BOOL";

                          break;
                      case "C":
                           //var_dump(substr($strType, -(strlen($strType))));
                          //var_dump(str_replace(".",",",substr($strType, 1)));
                          $strType = "DECIMAL(" . str_replace(".",",",substr($strType, 1)) . ")";

                          break;
                      case "D":
                          $strType = "DATE";

                          break;
                      case "E":
                          $strType = "INT";

                          break;
                      case "F":
                          $strType = "CHAR(" . substr($strType, 1) . ")";

                          break;
                      case "M":
                           //$strType = "DECIMAL(" . str_replace(".",",",substr($strType, 1)) . ")";
                          $strType = "DECIMAL(10,2)";

                          break;
                      case "N":
                          $strType = "INT NOT NULL";

                          break;
                      case "V":
                          $strType = "VARCHAR(" . substr($strType, 1) . ")";

                          break;
                      

                      default:
                          break;
                  }
                  $this->_requete  .= $strNom . " " . $strType . ", ";
              }
          }
          if ($strCles != "") {
              $this->_requete .= "PRIMARY KEY($strCles)";
          }
          $this->_requete .= ") ENGINE=InnoDB";
          $this->_OK = mysqli_query($this->_cBD, $this->_requete);
         // var_dump($this->_requete);
          return $this->_OK;
      }
      /*
      |----------------------------------------------------------------------------------|
      | deconnexion
      |----------------------------------------------------------------------------------|
      */
      function deconnexion() {
          $this->_OK = mysqli_close($this->_cBD);
      }
      /*
      |----------------------------------------------------------------------------------|
      | insereEnregistrement
      |----------------------------------------------------------------------------------|
      */
      function insereEnregistrement($strNomTable) {
          $this->_requete  = "INSERT INTO $strNomTable VALUES (";
          for ($i=1; $i<= func_num_args() - 1 ; $i++){
              //var_dump(func_get_arg($i));
              //var_dump(strcasecmp(func_get_arg($i), 'true') == 0);
              if (gettype(func_get_arg($i)) == "string" && (strcasecmp(func_get_arg($i), 'true') != 0 ||strcasecmp(func_get_arg($i), 'true') != 0 ) && strcasecmp(substr(func_get_arg($i), 0,1),"\"") != 0) {
                  $this->_requete  .= "'" . str_replace("'", "\'", func_get_arg($i)) . "'";
              } elseif (is_null(func_get_arg($i))) {
                  $this->_requete  .= "NULL";
              } elseif (strcasecmp(func_get_arg($i), 'true') == 0) {
                  $this->_requete  .= "1";
              } elseif (strcasecmp(func_get_arg($i), 'false') == 0) {
                  $this->_requete  .= "0";
              } elseif (strcasecmp(substr(func_get_arg($i), 0,1),"\"") == 0) {
                  $this->_requete  .= "'" . func_get_arg($i) . "'";
              } else {
                  $this->_requete  .= func_get_arg($i);
              }
              
              if ($i != func_num_args() - 1) {
                   $this->_requete  .= ", ";
              }
              //$this->_requete  .= func_get_arg($i) . ", ";
          }
          $this->_requete  .= ")";
          $this->_OK = mysqli_query($this->_cBD, $this->_requete);
          //var_dump($this->_requete);
          return $this->_OK;
      }
      /*
      |----------------------------------------------------------------------------------|
      | modifieChamp
      |----------------------------------------------------------------------------------|
      */
      function modifieChamp($strNomTable, $strNomChamp, $strNouvelleDefinition) {
          $this->_requete = "ALTER TABLE $strNomTable CHANGE $strNomChamp $strNouvelleDefinition";
          
          $this->_OK = mysqli_query($this->_cBD, $this->_requete);
          //var_dump($this->_requete);
          return $this->_OK;
      }
      /*
      |----------------------------------------------------------------------------------|
      | selectionneBD()
      |----------------------------------------------------------------------------------|
      */
      function selectionneBD() {
          
          //$this->_nomBD = $strNomBD;
          $this->_OK = mysqli_select_db($this->_cBD, $this->_nomBD);
          
          return $this->_OK;
      }
      /*
      |----------------------------------------------------------------------------------|
      | supprimeEnregistrements
      |----------------------------------------------------------------------------------|
      */
      function supprimeEnregistrements($strNomTable, $strListeConditions="") {
          if (strcasecmp($strListeConditions, "") == 0) {
              $this->_requete = "DELETE FROM $strNomTable";
          } else {
              $this->_requete = "DELETE FROM $strNomTable WHERE $strListeConditions";
          }
          
          
          $this->_OK = mysqli_query($this->_cBD, $this->_requete);
          //var_dump($this->_requete);
          return $this->_OK;
      }
      /*
      |----------------------------------------------------------------------------------|
      | supprimeTable()
      |----------------------------------------------------------------------------------|
      */
      function supprimeTable($strNomTable) {
          $this->_requete = "DROP TABLE $strNomTable";
          $this->_OK = mysqli_query($this->_cBD, $this->_requete);
          
          return $this->_OK;
      }
      
            
      function tableExiste($strNomTable) {
        $Verdict = null;
        if ($result = mysqli_query($this->_cBD, "SHOW TABLES LIKE '" . $strNomTable . "'")) {
            if ($result->num_rows == 1) {
                $Verdict = true;
            }
        } else {
            $Verdict = false;
            echo "Table does not exist";
        }

        return $Verdict;
    }

    function selectionneEnregistrements($strNomTable) {
        /************************************* A VERIFIER *************************************/
        $this->_requete  = "SELECT * FROM $strNomTable ";
          for ($i=1; $i<= func_num_args() - 1 ; $i++){
              
              if (substr(func_get_arg($i), 0, 1) == "C") {
                  $this->_requete  .= "WHERE " . substr(func_get_arg($i), 2, strlen(func_get_arg($i)));
              }else if (substr(func_get_arg($i), 0, 1) == "D") {
                  $this->_requete  .= " GROUP BY " . substr(func_get_arg($i), 2, strlen(func_get_arg($i)));
              }else if (substr(func_get_arg($i), 0, 1) == "T") {
                  $this->_requete  .= " ORDER BY " . substr(func_get_arg($i), 2, strlen(func_get_arg($i)));
              }
          }
          
        $this->_listeEnregistrements = mysqli_query($this->_cBD, $this->_requete);
        $this->_nbEnregistrements = mysqli_num_rows(mysqli_query($this->_cBD, $this->_requete));

        if ($this->_listeEnregistrements == null) {
            $this->_nbEnregistrements = -1;
        }
        
        //var_dump(mysqli_query($this->_cBD, $this->_requete));
        //var_dump($this->_requete);
        //var_dump($this->_nbEnregistrements);
        return $this->_nbEnregistrements;
    }
    
    function contenuChamp($intNo,$strNomChamp) {
        /************************************* A VERIFIER *************************************/
        $valeurChamp = null;
        if ($this->_listeEnregistrements != null) {
            
            $valeurChamp = $this->mysqli_result($this->_listeEnregistrements, $intNo, $strNomChamp);
        }
        
        return $valeurChamp;
    }
    
    /*********** Fonction que jai creer *********************/
    function majEnregistrement($strNomTable,$strDefinitions,$strListeConditions="") {
        $this->_requete  = "UPDATE $strNomTable ";
        $this->_requete  .= "SET $strDefinitions ";
        $this->_requete  .= "WHERE $strListeConditions;";
        
        $this->_OK = mysqli_query($this->_cBD, $this->_requete);
          
        //var_dump($this->_requete);
        return $this->_OK;
    }
    
    function getNextID($strNomTable, $strNomChamp) {
    $strRangee = mysqli_fetch_array(mysqli_query($this->_cBD, "SELECT $strNomChamp FROM $strNomTable ORDER BY $strNomChamp DESC LIMIT 1"));
    $intNo = $strRangee[$strNomChamp];
    $intNo++;
    return $intNo;
}
    
   /*
   |-------------------------------------------------------------------------------------|
   | mysqli_result
   | Réf.: http://php.net/manual/fr/class.mysqli-result.php User Contributed Notes (Marc17)
   |
   | Exemple d'appel : echo mysqli_result($ListeEnregistrements, 0, "TotalVentes");
   |                   Affiche le champ "TotalVentes" du 1er enregistrement de la liste
   |                   d'enregistrements.
   |-------------------------------------------------------------------------------------|
   */
   function mysqli_result($result, $row, $field=0) {
      if ($result === false) return false;
      if ($row >= mysqli_num_rows($result)) return false;
      if (is_string($field) && !(strpos($field, ".")===false)) {
         $t_field = explode(".", $field);
         $field = -1;
         $t_fields = mysqli_fetch_fields($result);
         for ($id=0; $id < mysqli_num_fields($result); $id++) {
            if ($t_fields[$id]->table == $t_field[0] && $t_fields[$id]->name == $t_field[1]) {
               $field=$id;
               break;
            }
         }
         if ($field == -1) return false;
      }
      mysqli_data_seek($result,$row);
      $line = mysqli_fetch_array($result);
      return isset($line[$field]) ? $line[$field] : false;
   }
      
        
      /*
      |----------------------------------------------------------------------------------|
      | afficheInformationsSurBD()
      | Affiche la structure et le contenu de chaque table de la base de données recherchée
      |----------------------------------------------------------------------------------|
      */
      function afficheInformationsSurBD(){
      /* Si applicable, récupération du nom de la table recherchée */
      $strNomTableRecherchee = "";
      if (func_num_args() == 1) {
         $strNomTableRecherchee = func_get_arg(0);
      }
      
      /* Variables de base pour les styles */
      $strTable = "border-collapse:collapse;";
      $strCommande = "font-family:verdana; font-size:12pt; font-weight:bold; color:black; border:solid 1px black; padding:3px;";
      $strMessage = "font-family:verdana; font-size:10pt; font-weight:bold; color:red;";
      $strBorduresMessage = "border:solid 1px red; padding:3px;";
      $strContenu = "font-family:verdana; font-size:10pt; color:blue;";
      $strBorduresContenu = "border:solid 1px red; padding:3px;";
      $strTypeADefinir = "color:red;font-weight:bold;";
      $strDetails = "color:magenta;";
      
      /* Application des styles */
      $sTable = "style=\"$strTable\"";
      $sCommande = "style=\"$strCommande\"";
      $sMessage = "style=\"$strMessage\"";
      $sMessageAvecBordures = "style=\"$strMessage $strBorduresMessage\"";
      $sContenu = "style=\"$strContenu\"";
      $sContenuAvecBordures = "style=\"$strContenu $strBorduresContenu\"";
      $sTypeADefinir = "style=\"$strTypeADefinir\"";
      $sDetails = "style=\"$strDetails\"";

      /* --- Entreposage des noms de table --- */
      $ListeTablesBD = array_column(mysqli_fetch_all(mysqli_query($this->_cBD, 'SHOW TABLES')),0);
      $intNbTables = count($ListeTablesBD);
      
      /* Version alternative en attendant que mon site personnel soit fonctionnel */
      //$intNbTables = get_tables($cBD, $ListeTablesBD);

      /* --- Parcours de chacune des tables --- */
      echo "<span $sCommande>Informations sur " . (!empty($strNomTableRecherchee) ? "la table '$strNomTableRecherchee' de " : "") . "la base de données '$this->_nomBD'</span><br />";
      $binTablePresente = false;
      for ($i=0; $i<$intNbTables; $i++)
      {
         /* Récupération du nom de la table courante */
         $strNomTable = $ListeTablesBD[$i];
         if (empty($strNomTableRecherchee) || strtolower($strNomTable) == strtolower($strNomTableRecherchee)) {
            $binTablePresente = true;
            echo "<p $sMessage>Table no ".strval($i+1)." : ".$strNomTable."</p>";
         
            /* Récupération des enregistrements de la table courante */
            $ListeEnregistrements = mysqli_query($this->_cBD, "SELECT * FROM $strNomTable");

            /* Décompte du nombre de champs et d'enregistrements de la table courante */
            $NbChamps = mysqli_field_count($this->_cBD);
            $NbEnregistrements = mysqli_num_rows($ListeEnregistrements);
            echo "<p $sContenu>$NbChamps champs ont été détectés dans la table.<br />";
            echo "    $NbEnregistrements enregistrements ont été détectés dans la table.</p>";
            
            /* Affichage de la structure de table courante */
            echo "<p $sContenu>";
            $j=0;
            $tabNomChamp = array();
            while ($champCourant = $ListeEnregistrements->fetch_field()) {
               $intDivAjustement = 1;
               $tabNomChamp[$j] = $champCourant->name;
               $strType = $champCourant->type;
               switch ($strType) {
                  case 1   : $strType = "BOOL"; break;
                  case 3   : $strType = "INTEGER"; break;
                  case 10  : $strType = "DATE"; break;
                  case 12  : $strType = "DATETIME"; break;
                  case 246 : $strType = "DECIMAL"; break;
                  case 253 : $strType = "VARCHAR"; 
                             /* Ajustement temporaire */
                             if ($_SERVER["SERVER_NAME"] == "lmbrousseau.ca") { $intDivAjustement = 3; }
                             break;
                  case 254 : $strType = "CHAR"; break;
                  default  : $strType = "<span $sTypeADefinir>$strType à définir</span>"; break;
               }
               $strLongueur = intval($champCourant->length) / $intDivAjustement;
               $intDetails = $champCourant->flags;
               $strDetails = "";
               if ($intDetails & 1     ) $strDetails .= "[NOT_NULL] ";
               if ($intDetails & 2     ) $strDetails .= "<span style=\"font-weight:bold;\">[PRI_KEY]</span> ";
               if ($intDetails & 4     ) $strDetails .= "[UNIQUE_KEY] ";
               if ($intDetails & 16    ) $strDetails .= "[BLOB] ";
               if ($intDetails & 32    ) $strDetails .= "[UNSIGNED] ";
               if ($intDetails & 64    ) $strDetails .= "[ZEROFILL] ";
               if ($intDetails & 128   ) $strDetails .= "[BINARY] ";
               if ($intDetails & 256   ) $strDetails .= "[ENUM] ";
               if ($intDetails & 512   ) $strDetails .= "[AUTO_INCREMENT] ";
               if ($intDetails & 1024  ) $strDetails .= "[TIMESTAMP] ";
               if ($intDetails & 2048  ) $strDetails .= "[SET] ";
               if ($intDetails & 32768 ) $strDetails .= "[NUM] ";
               if ($intDetails & 16384 ) $strDetails .= "[PART_KEY] ";
               if ($intDetails & 32768 ) $strDetails .= "[GROUP] "; 
               if ($intDetails & 65536 ) $strDetails .= "[UNIQUE] ";
               echo ($j+1).". $tabNomChamp[$j], $strType($strLongueur) <span $sDetails>$strDetails</span><br />";
               $j++;
            }
            echo "</p>";

            /* Affichage des enregistrements composant la table courante */
            echo "<table $sTable>";
            echo "<tr>";
            for ($k=0; $k<$NbChamps; $k++)
               echo "<td $sMessageAvecBordures>" . $tabNomChamp[$k] . "</td>";
            echo "</tr>";               
            if (empty($NbEnregistrements)) {
               echo "<tr>";
               echo "<td $sContenuAvecBordures colspan=\"$NbChamps\">";
               echo " Aucun enregistrement";
               echo "</td>";
               echo "</tr>";
            }
            while ($listeChampsEnregistrement = $ListeEnregistrements->fetch_row()) {
               echo "<tr>";
               echo "<tr>";
               for ($j=0; $j<count($listeChampsEnregistrement); $j++)
                  echo "      <td $sContenuAvecBordures>" . $listeChampsEnregistrement[$j] . "</td>";
               echo "   </tr>";
            }
            echo "</table>";
            $ListeEnregistrements->free();
         }
      }
      if (!$binTablePresente)
         echo "<p $sMessage>Aucune table !</p>";
      }

   }
?>