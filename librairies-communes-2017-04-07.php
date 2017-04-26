<?php
setlocale(LC_MONETARY, 'en_CA');

   /*
   |-------------------------------------------------------------------------------------|
   | afficheTrace
   | Affichage un trace d'exécution de l'application
   |-------------------------------------------------------------------------------------|
   */
   function afficheTrace($strRequete, $binTrace, $strMessage, $binOK) {
      echo "<p class=\"sCommande\">$strRequete<br />";
      if ($binTrace) {
         echo "<span class=\"sMessage\">";
         echo $strMessage;
         if ($binOK) echo " confirmée"; else echo " impossible";
         echo "</span>";
      }
      echo "</p>";
   }
   
function ajouteZeros($numValeur, $intLargeur) {
    $strFormat = "%0" . $intLargeur . "d";
    return sprintf($strFormat, $numValeur);
}

function aujourdhui($binAAAMMJJ = true) {
    if ($binAAAMMJJ == true) {
        return date("Y-m-d");
    } else {
        return date("d-m-Y");
    }
}

function bissextile($intAnnee) {
    /* Entrez le code ici */
    return !date("L", mktime(0, 0, 0, 0, 0, $intAnnee));
}

function convertitSousChaineEnEntier($strChaine, $intDepart, $intLongeur) {
    $intEntier = intval(substr($strChaine, $intDepart, $intLongeur));
    return $intEntier;
}

function dansIntervalle($numValeur, $intMin, $intMax) {
    $blnValide = "";
    if ($numValeur >= $intMin && $numValeur <= $intMax) {
        $blnValide = true;
    } else {
        $blnValide = false;
    }

    return $blnValide;
}

function dateValide($strDate) {
    $intJourSemaine = 0;
    $intJour = 0;
    $intMois = 0;
    $intAnnee = 0;
    extraitJSJJMMAAAAv2($intJourSemaine, $intJour, $intMois, $intAnnee, $strDate);
    if (checkdate($intMois, $intJour, $intAnnee)) {
        return true;
    } else {
        return false;
    }
}

function decomposeURL($strURL,&$strChemin,&$strNom,&$strSuffixe) {
    $path_parts = pathinfo($strURL);
    
    $strChemin = $path_parts['dirname'];
    $strNom = $path_parts['basename'];
    $strSuffixe = $path_parts['extension'];
}

   /*
   |-------------------------------------------------------------------------------------|
   | detecteServeur (2017-03-18)
   |-------------------------------------------------------------------------------------|
   */
   function detecteServeur(&$strMonIP, &$strIPServeur, &$strNomServeur, &$strInfosSensibles) {
      $strMonIP = $_SERVER["REMOTE_ADDR"];
      $strIPServeur = $_SERVER["SERVER_ADDR"];
      $strNomServeur = $_SERVER["SERVER_NAME"];
      $strInfosSensibles = str_replace(".", "-", $strNomServeur) . ".php";
   }

function droite($strChaine, $intLargeur) {

    return substr($strChaine, -1 * $intLargeur);
}

function ecrit($strChaine, $intNbrBR = 0) {
    echo $strChaine;
    for ($i = 0; $i < $intNbrBR; $i++) {
        echo "<br />";
    }
}

function encadre($strChaine, $strCaracteres) {

    if (strlen($strCaracteres) == 1) {
        return $strCaracteres . $strChaine . $strCaracteres;
    } else {
        return substr($strCaracteres, 0, 1) . $strChaine . substr($strCaracteres, -1);
    }
}

function er($intEntier, $binExposant = true) {

    $strEntier = "N/A";

    if ($intEntier == 1 && $binExposant == false) {
        $strEntier = $intEntier . "er";
    } else {
        $strEntier = $intEntier . "<sup>er</sup>";
    }

    return $strEntier;
}

function estNumerique($strValeur) {
    return is_numeric($strValeur);
}

function etatCivilValide($chrEtat, $chrSexe, &$strEtatCivil) {
    if (strcasecmp($chrEtat, 'c') == 0 || strcasecmp($chrEtat, 'f') == 0 || strcasecmp($chrEtat, 'm') == 0 || strcasecmp($chrEtat, 's') == 0 || strcasecmp($chrEtat, 'd') == 0 || strcasecmp($chrEtat, 'v') == 0) {
        switch ($strEtatCivil) {
            case strcasecmp($chrEtat, 'c') == 0:

                $strEtatCivil = "Célibataire";
                break;

            case strcasecmp($chrEtat, 'f') == 0:

                if (strcasecmp($chrSexe, 'h') == 0) {
                    $strEtatCivil = "Conjoint de fait";
                } elseif (strcasecmp($chrSexe, 'f') == 0) {
                    $strEtatCivil = "Conjointe de fait";
                }
                break;

            case strcasecmp($chrEtat, 'm') == 0:

                if (strcasecmp($chrSexe, 'h') == 0) {
                    $strEtatCivil = "Marié";
                } elseif (strcasecmp($chrSexe, 'f') == 0) {
                    $strEtatCivil = "Mariée";
                }
                break;

            case strcasecmp($chrEtat, 's') == 0:

                if (strcasecmp($chrSexe, 'h') == 0) {
                    $strEtatCivil = "Séparé";
                } elseif (strcasecmp($chrSexe, 'f') == 0) {
                    $strEtatCivil = "Séparée";
                }
                break;

            case strcasecmp($chrEtat, 'd') == 0:

                if (strcasecmp($chrSexe, 'h') == 0) {
                    $strEtatCivil = "Divorcé";
                } elseif (strcasecmp($chrSexe, 'f') == 0) {
                    $strEtatCivil = "Divorcée";
                }
                break;

            case strcasecmp($chrEtat, 'v') == 0:

                if (strcasecmp($chrSexe, 'h') == 0) {
                    $strEtatCivil = "Veuve";
                } elseif (strcasecmp($chrSexe, 'f') == 0) {
                    $strEtatCivil = "Veuf";
                }
                break;

            default:
                break;
        }
        return true;
    } else {
        return false;
    }
}

function extraitJJMMAAAA(&$intJour, &$intMois, &$intAnnee) {
    /* Par défaut, l'extraction s'effectue à partir de la date courante;
     * autrement elle s'effectue à partir du 4e arguemnt spécifié à l'appel
     */
    if (func_num_args() == 3) {
        /* Récuperation de la date courante */
        $strDate = date("d-m-Y");
    } else {
        /* Récuperation du 4e argument */
        $strDate = func_get_arg(3);
    }

    $intJour = intval(substr($strDate, 0, 2));
    $intMois = intval(substr($strDate, 3, 2));
    $intAnnee = intval(substr($strDate, 6, 4));
}

function extraitJSJJMMAAAA(&$intJourSemaine, &$intJour, &$intMois, &$intAnnee) {
    if (func_num_args() == 4) {
        $strDate = date("d=m-Y");
        $intJourSemaine = date("N");
    } else {
        $strDate = func_get_arg(4);
        $intJourSemaine = date("N", strtotime($strDate));
    }
    $intJour = intval(substr($strDate, 0, 2));
    $intMois = intval(substr($strDate, 3, 2));
    $intAnnee = intval(substr($strDate, 6, 4));
}

function extraitJSJJMMAAAAv2(&$intJourSemaine, &$intJour, &$intMois, &$intAnnee) {
    $strDate = func_num_args() == 4 ? date("d-m-Y") : func_get_arg(4);
    $intJourSemaine = func_num_args() == 4 ? date("N") : date("N", strtotime(func_get_arg(4)));
    if (strpos($strDate, "-") == 2) {
        $intJour = intVal(substr($strDate, 0, 2));
        $intAnnee = intVal(substr($strDate, 6, 4));
        $intMois = intVal(substr($strDate, 3, 2));
    } else {
        $intJour = intVal(substr($strDate, 8, 2));
        $intAnnee = intVal(substr($strDate, 0, 4));
        $intMois = intVal(substr($strDate, 5, 2));
    }
}

/*
 * -------------------------------------------------------------------------------------------------
 * get(aaaa-mm-jj)
 * Scénario: get($strNomparamtre) retourne la valeur du paramètre ou NULL
 * --------------------------------------------------------------------------------------------------
 */

function get($strNomParametre) {
    return isset($_GET[$strNomParametre]) ? $_GET[$strNomParametre] : null;
}

function gauche($strChaine, $intLargeur) {

    return substr($strChaine, $intLargeur);
}

function JJMMAAAA($intJour, $intMois, $intAnnee) {
    $intAnnee = $intAnnee <= 20 ? 2000 + $intAnnee : ($intAnnee <= 99 ? 1900 + $intAnnee : $intAnnee);

    /* La date retournée doit avoir le format 0J-0M-AAAA */
    return ajouteZeros($intJour, 2) . "-" .
            ajouteZeros($intMois, 2) . "-" .
            ajouteZeros($intAnnee, 4);
}

function jourSemaineEnLitteral($intNoJour, $binMajuscule = false) {
    /* Par défaut, la première lettre du mois s'affiche en minuscule ($binMajuscule=false)
     * Si un deuxième argument est saisi, il déterminera si la première lettre doit 
     * s'afficher en majuscule ou non
     */
    $strNoJour = "N/A";
    switch ($intNoJour) {
        case 1 : $strNoJour = "lundi";
            break;
        case 2 : $strNoJour = "mardi";
            break;
        case 3 : $strNoJour = "mercredi";
            break;
        case 4 : $strNoJour = "jeudi";
            break;
        case 5 : $strNoJour = "vendredi";
            break;
        case 6 : $strNoJour = "samedi";
            break;
        case 7 : $strNoJour = "dimanche";
            break;
    }

    $strNoJour = $binMajuscule ? ucfirst($strNoJour) : $strNoJour;

    return $strNoJour;
}

function majuscules($strChaine) {
    return strtoupper($strChaine);
}

function minuscules($strChaine) {
    return strtolower($strChaine);
}

function moisEnLitteral($intMois, $binMajuscule = false) {
    /* Par défaut, la première lettre du mois s'affiche en minuscule ($binMajuscule=false)
     * Si un deuxième argument est saisi, il déterminera si la première lettre doit 
     * s'afficher en majuscule ou non
     */
    $strMois = "N/A";
    switch ($intMois) {
        case 1 : $strMois = "janvier";
            break;
        case 2 : $strMois = "f&eacute;vrier";
            break;
        case 3 : $strMois = "mars";
            break;
        case 4 : $strMois = "avril";
            break;
        case 5 : $strMois = "mai";
            break;
        case 6 : $strMois = "juin";
            break;
        case 7 : $strMois = "juillet";
            break;
        case 8 : $strMois = "ao&ucirc;t";
            break;
        case 9 : $strMois = "septembre";
            break;
        case 10 : $strMois = "octobre";
            break;
        case 11 : $strMois = "novembre";
            break;
        case 12 : $strMois = "d&eacute;cembre";
            break;
    }
    /* if ($binMajuscule)
     *  $strMois = ucfirst($strMois);
     */
    $strMois = $binMajuscule ? ucfirst($strMois) : $strMois;

    return $strMois;
}

function formatFloat($strMontant) {
    $fltMontant = floatval($strMontant);
    
    return $fltMontant;
}

function formaterArgent ($fltMontant){
    return number_format($fltMontant,2,","," ") . " $";
}

function nombreJoursAnnee($intAnnee) {
    /* Entrez le code ici */
    if (bissextile($intAnnee) == true) {
        return "366";
    } else if (bissextile($intAnnee) == false) {
        return "365";
    }
}

function nombreJoursEntreDeuxDates($strDate1, $strDate2) {
    $strDate1 = strtotime($strDate1); // or your date as well
    $strDate2 = strtotime($strDate2);

    return round(($strDate2 - $strDate1) / (60 * 60 * 24));
}

function nombreJoursMois($intMois, $intAnnee) {
    /* Entrez le code ici */
    return date('t', mktime(0, 0, 0, $intMois, 1, $intAnnee));
}

/*
 * ------------------------------------------------------------------------------
 * post (aaaa-mm-jj)
 * Scénario: post($strnomParametre) retourne la valeur du paramètre ou NULL
 * ------------------------------------------------------------------------------
 */

function post($strNomParametre) {
    return isset($_POST[$strNomParametre]) ? $_POST[$strNomParametre] : null;
}

function request($strNomParametre) {
    return isset($_REQUEST[$strNomParametre]) ? $_REQUEST[$strNomParametre] : null;
}
?>
