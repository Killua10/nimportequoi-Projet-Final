<?php

/* --- creeTableGenerique ---
* 
* Type, Nom -> B = BOOLEAN          B,Nom       -> Nom BOOL
*              C = DECIMAL          C99.99,Nom  -> Nom DECIMAL(99,99)
*              D = DATE             D,Nom       -> Nom DATE
*              E = ENTIER           E,Nom       -> Nom INT
*              F = CHAINE FIXE      F999,Nom    -> Nom CHAR(999)
*              M = MONETAIRE        M,Nom       -> Nom DECIMAL(10,2)
*              N = ENTIER NON NUL   N,Nom       -> Nom INT NOT NULL
*              V = CHAINE VARIABLE  V999,Nom    -> Nom VARCHAR(999)
*/

function creeTableUtilisateurs($oBD,$strNomTableUtilisateurs){
    $strDefinitions = "N,NoUtilisateur;" . "V50,Courriel;" . "V255,MotDePasse;" . "T,Creation;" . 
            "E,NbConnexions;" . "E,Status;" . "N,NoEmpl;". "V25,Nom;" . "V20,Prenom;" . 
            "V16,NoTelMaison;" . "V22,NoTelTravail;" . "V16,NoTelCellulaire;" . "T,Modification;" . "V50,AutresInfos";
    $strCles = "NoUtilisateur";
    
    $oBD->creeTableGenerique($strNomTableUtilisateurs, $strDefinitions, $strCles);
}

function remplitTableUtilisateurs($oBD,$strNomTableUtilisateurs,$strNomFichierUtilisateurs) {
    $fichierUtilisateurs = new fichier($strNomFichierUtilisateurs);
    
    if ($fichierUtilisateurs->existe()) {
        $fichierUtilisateurs->ouvre();
        while (!$fichierUtilisateurs->detecteFin()) {
            $fichierUtilisateurs->litDonneesligne($tValeurs, ";", "NoUtilisateur", "Courriel", "MotDePasse", "Creation","NbConnexions","Status","NoEmpl","Nom","Prenom"
                                                    ,"NoTelMaison","NoTelTravail","NoTelCellulaire","Modification","AutresInfos");
            $oBD->insereEnregistrement($strNomTableUtilisateurs,$tValeurs["NoUtilisateur"],$tValeurs["Courriel"],password_hash($tValeurs["MotDePasse"], PASSWORD_DEFAULT),date('Y/m/d h:i:s',strtotime($tValeurs["Creation"])),$tValeurs["NbConnexions"]
                                                                ,$tValeurs["Status"],$tValeurs["NoEmpl"],$tValeurs["Nom"],$tValeurs["Prenom"],$tValeurs["NoTelMaison"],$tValeurs["NoTelTravail"]
                                                                ,$tValeurs["NoTelCellulaire"],date('Y/m/d h:i:s',strtotime($tValeurs["Modification"])),$tValeurs["AutresInfos"]);
        }
    }
    
}

function creeTableConnexions($oBD,$strNomTableConnexions){
    $strDefinitions = "N,NoConnexion;" . "N,NoUtilisateur;" . "T,Connexion;" . "T,Deconnexion";
    $strCles = "NoConnexion";
    
    $oBD->creeTableGenerique($strNomTableConnexions, $strDefinitions, $strCles);
}

function remplitTableConnexions($oBD,$strNomTableConnexions,$strNomFichierConnexions) {
    $fichierConnexions = new fichier($strNomFichierConnexions);
    
    if ($fichierConnexions->existe()) {
        $fichierConnexions->ouvre();
        while (!$fichierConnexions->detecteFin()) {
            $fichierConnexions->litDonneesligne($tValeurs, ";", "NoConnexion", "NoUtilisateur", "Connexion", "Deconnexion");
            $oBD->insereEnregistrement($strNomTableConnexions,$tValeurs["NoConnexion"],$tValeurs["NoUtilisateur"],date('Y/m/d h:i:s',strtotime($tValeurs["Connexion"])),date('Y/m/d h:i:s',strtotime($tValeurs["Deconnexion"])));
        }
    }
    
}

function creeTableAnnonces($oBD,$strNomTableAnnonces){
    $strDefinitions = "N,NoAnnonce;" . "N,NoUtilisateurs;" . "T,Parution;" . "N,Categorie;" . 
            "V50,DescriptionAbregee;" . "V250,DescriptionComplete;" . "M,Prix;" . "V50,Photo;" . "T,MiseAJour;" . 
            "N,Etat";
    $strCles = "NoAnnonce";
    
    $oBD->creeTableGenerique($strNomTableAnnonces, $strDefinitions, $strCles);
}

function remplitTableAnnonces($oBD,$strNomTableAnnonces,$strNomFichierAnnonces) {
    $fichierAnnonces = new fichier($strNomFichierAnnonces);
    
    if ($fichierAnnonces->existe()) {
        $fichierAnnonces->ouvre();
        while (!$fichierAnnonces->detecteFin()) {
            $fichierAnnonces->litDonneesligne($tValeurs, ";", "NoAnnonce", "NoUtilisateur", "Parution", "Categorie","DescriptionAbregee","DescriptionComplete","Prix","Photo","MiseAJour"
                                                    ,"Etat");
            $oBD->insereEnregistrement($strNomTableAnnonces,$tValeurs["NoAnnonce"],$tValeurs["NoUtilisateur"],date('Y/m/d h:i',strtotime($tValeurs["Parution"])),$tValeurs["Categorie"],$tValeurs["DescriptionAbregee"]
                                                                ,$tValeurs["DescriptionComplete"],$tValeurs["Prix"],$tValeurs["Photo"],date('Y/m/d h:i:s',strtotime($tValeurs["MiseAJour"]. ":00")),$tValeurs["Etat"]);
                                                        var_dump(date('d/m/Y h:i:s',strtotime($tValeurs["MiseAJour"]. ":00")));
        }
    }
    
}

function creeTableCategorie($oBD,$strNomTableCategorie){
    $strDefinitions = "N,NoCategorie;" . "V20,Description";
    $strCles = "NoCategorie";
    
    $oBD->creeTableGenerique($strNomTableCategorie, $strDefinitions, $strCles);
}

function remplitTableCategorie($oBD,$strNomTableCategorie,$strNomFichierCategorie) {
    $fichierCategorie = new fichier($strNomFichierCategorie);
    
    if ($fichierCategorie->existe()) {
        $fichierCategorie->ouvre();
        while (!$fichierCategorie->detecteFin()) {
            $fichierCategorie->litDonneesligne($tValeurs, ";", "NoCategorie", "Description");
            $oBD->insereEnregistrement($strNomTableCategorie,$tValeurs["NoCategorie"],$tValeurs["Description"]);
        }
    }
    
}

function envoyerCourrielAuxUtilisateursNonActives($oBD, $strNomTableUtilisateurs){
    $strDestinataires = "";
    $strMessage = "<br />Bonjour,<br /><br /> vous êtes inscrites à N'importeQuoi depuis plus d'un mois et vous n'avez pas ecore confirmé votre enregistrement."
                . "<br /> Cliquez sur le lien qui suit pour confirmer votre enregistrement: -lien-";
    
    $intEnregistrements = $oBD->selectionneEnregistrements($strNomTableUtilisateurs, 'C=creation <= (NOW() - INTERVAL 1 MONTH) AND status = 0');
    for($i=0; $i < $intEnregistrements; $i++){
        $strDestinataires .= $oBD->contenuChamp($i,'Courriel') . ';';
        //var_dump($oBD->contenuChamp($i,'Courriel'));
    }
    
    echo $strDestinataires;
    
    echo $strMessage;
}

function supprimerUtilisateurs($oBD){
    $strComptes = "";
    $intNbUtils = $oBD->selectionneEnregistrements('utilisateurs', 'C=creation <= (NOW() - INTERVAL 3 MONTH) AND status = 0');
    
    for($i=0; $i<$intNbUtils; $i++){
        $strComptes .= $oBD->contenuChamp($i, 'Courriel') . ';';
    }
    
    
    
    $oBD->supprimeEnregistrements('utilisateurs', 'creation <= (NOW() - INTERVAL 3 MONTH) AND status = 0');
    return $intNbUtils . ';' . $strComptes;
}

function supprimerAnnonces($oBD){
   
    $intNbAnnonces = $oBD->selectionneEnregistrements('annonces', 'C=Etat=3');
         
    $oBD->supprimeEnregistrements('utilisateurs', 'Etat=3');
    return $intNbAnnonces;
}

function rechercheParChamp($oBD, $champ, $contenuRecherche){
    
    switch ($champ) {
        case 'Auteur':
            $oBD->_requete = "SELECT * FROM annonces join utilisateurs on annonces.noutilisateurs = utilisateurs.noutilisateur "
                . "where annonces.etat=1 AND nom='$contenuRecherche' OR prenom='$contenuRecherche'";
            break;
        
        case 'Categorie':
            $oBD->_requete = "SELECT * FROM annonces join categories on annonces.categorie = categories.nocategorie "
                . "where annonces.etat=1 and categories.description = '$contenuRecherche'";
            break;
        
        case 'Description':
            $oBD->_requete = "SELECT * FROM annonces where etat=1 AND descriptionabregee like '%$contenuRecherche%' or descriptioncomplete like '%$contenuRecherche%'";
            break;
       
    }
    
    
   /* $oBD->_listeEnregistrements = mysqli_query($oBD->_cBD, $oBD->_requete);
    var_dump($oBD->_requete);*/
    
    $oBD->_listeEnregistrements = mysqli_query($oBD->_cBD, $oBD->_requete);
        if ($oBD->_listeEnregistrements != false) {
            $oBD->_nbEnregistrements = mysqli_num_rows(mysqli_query($oBD->_cBD, $oBD->_requete));
        }
        
        if ($oBD->_listeEnregistrements == null || $oBD->_listeEnregistrements == false) {
            $oBD->_nbEnregistrements = -1;
        }
        
        
        //var_dump(mysqli_query($this->_cBD, $this->_requete));
        //var_dump($this->_requete);
        //var_dump($this->_nbEnregistrements);
        //var_dump($this->_listeEnregistrements);
        return $oBD->_nbEnregistrements;
}

//Réference : http://www.phpeasystep.com/phptu/29.html
function afficherPagination($oBD,$nbrItemParPage)
{
        $strNomTableAnnonces="annonces";
	$nbInput = 3;
        
        $nbPages = $oBD->selectionneEnregistrements($strNomTableAnnonces);
	
	/* Setup vars for query. */
	$pageDestination = "annonces.php";          //your file name  (the name of this file)
	$limiteNbPagesParPage = $nbrItemParPage; 				//how many items to show per page
	$noPageActuelle = get('page');
        
	if ($noPageActuelle) 
		$debut = ($noPageActuelle - 1) * $limiteNbPagesParPage;
	else
		$debut = 0;				
	
	/* Get data. */
        $oBD->selectionneEnregistrements($strNomTableAnnonces,"C=Etat=1","L=$debut, $limiteNbPagesParPage");
	/*$oBD->_requete = "SELECT NoAnnonce FROM $strNomTableAnnonces WHERE Etat=1 LIMIT $debut, $limiteNbPagesParPage";
	$oBD->_listeEnregistrements = mysqli_query($oBD->_cBD,$oBD->_requete);
        
        if ($oBD->_listeEnregistrements != false) {
            $oBD->_nbEnregistrements = mysqli_num_rows(mysqli_query($this->_cBD, $this->_requete));
        }
        
        if ($oBD->_listeEnregistrements == null || $oBD->_listeEnregistrements == false) {
            $oBD->_nbEnregistrements = -1;
        }*/
        
        
        //var_dump(mysqli_query($this->_cBD, $this->_requete));
        //var_dump($this->_requete);
        //var_dump($this->_nbEnregistrements);
        //var_dump($this->_listeEnregistrements);
        //return $this->_nbEnregistrements;
	
	/* Setup page vars for display. */
	if ($noPageActuelle == 0){
            $noPageActuelle = 1;	
        }
        
	$noPagePrecedante = $noPageActuelle - 1;							
	$noPageSuivante = $noPageActuelle + 1;							
	$noDernierePage = ceil($nbPages/$limiteNbPagesParPage);	
	$NoAvantDernierePage = $noDernierePage - 1;						

	$pagination = "";
	if($noDernierePage > 1)
	{	
		$pagination .= "<div class=\"pagination\">";

                //previous button
		if ($noPageActuelle > 1) 
			$pagination.= "<a href=\"$pageDestination?page=$noPagePrecedante\">← précédent</a>";
		else
			$pagination.= "<span class=\"disabled\">← précédent</span>";	
		
		//pages	
		if ($noDernierePage < 7 + ($nbInput * 2))	//not enough pages to bother breaking it up
		{	
			for ($counter = 1; $counter <= $noDernierePage; $counter++)
			{
				if ($counter == $noPageActuelle)
					$pagination.= "<span class=\"current\">$counter</span>";
				else
					$pagination.= "<a href=\"$pageDestination?page=$counter\">$counter</a>";					
			}
		}
		else if($noDernierePage > 5 + ($nbInput * 2))	//enough pages to hide some
		{
			//close to beginning; only hide later pages
			if($noPageActuelle < 1 + ($nbInput * 2))		
			{
				for ($counter = 1; $counter < 4 + ($nbInput * 2); $counter++)
				{
					if ($counter == $noPageActuelle)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a href=\"$pageDestination?page=$counter\">$counter</a>";					
				}
				$pagination.= "...";
				$pagination.= "<a href=\"$pageDestination?page=$NoAvantDernierePage\">$NoAvantDernierePage</a>";
				$pagination.= "<a href=\"$pageDestination?page=$noDernierePage\">$noDernierePage</a>";		
			}
			//in middle; hide some front and some back
			elseif($noDernierePage - ($nbInput * 2) > $noPageActuelle && $noPageActuelle > ($nbInput * 2))
			{
				$pagination.= "<a href=\"$pageDestination?page=1\">1</a>";
				$pagination.= "<a href=\"$pageDestination?page=2\">2</a>";
				$pagination.= "...";
				for ($counter = $noPageActuelle - $nbInput; $counter <= $noPageActuelle + $nbInput; $counter++)
				{
					if ($counter == $noPageActuelle)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a href=\"$pageDestination?page=$counter\">$counter</a>";					
				}
				$pagination.= "...";
				$pagination.= "<a href=\"$pageDestination?page=$NoAvantDernierePage\">$NoAvantDernierePage</a>";
				$pagination.= "<a href=\"$pageDestination?page=$noDernierePage\">$noDernierePage</a>";		
			}
			//close to end; only hide early pages
			else
			{
				$pagination.= "<a href=\"$pageDestination?page=1\">1</a>";
				$pagination.= "<a href=\"$pageDestination?page=2\">2</a>";
				$pagination.= "...";
				for ($counter = $noDernierePage - (2 + ($nbInput * 2)); $counter <= $noDernierePage; $counter++)
				{
					if ($counter == $noPageActuelle)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a href=\"$pageDestination?page=$counter\">$counter</a>";					
				}
			}
		}
                
                //next button
		if ($noPageActuelle < $counter - 1) 
			$pagination.= "<a href=\"$pageDestination?page=$noPageSuivante\">suivant →</a>";
		else
			$pagination.= "<span class=\"disabled\">suivant →</span>";
		$pagination.= "</div>\n";
                $tabReturn = array();
                /*$tabReturn[0]=$oBD->_listeEnregistrements;
                $tabReturn[1]=$pagination;*/
                return $pagination;
	}

}

?>
