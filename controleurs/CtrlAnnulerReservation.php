<?php
// Projet Réservations M2L - version web mobile
// Fonction du contrôleur CtrlAnnulerReservation.php : traiter la demande d'annulation d'une réservation
// Ecrit le 03/11/2015 par MrJ

if ( ! isset ($_POST ["numReservation"]) == true) {
	// si les données n'ont pas été postées, c'est le premier appel du formulaire : affichage de la vue sans message d'erreur
	$msgFooter = 'Annuler une réservation';
	$themeFooter = $themeNormal;
	include_once ('vues/VueAnnulerReservation.php');
}
else 
{
	// récupération des données postées
	if ( empty ($_POST ["numReservation"]) == true)  $numReservation = "";  else   $numReservation = $_POST ["numReservation"];
			
	if ($numReservation == '') 
	{
		// si les données sont incomplètes, réaffichage de la vue avec un message explicatif
		$msgFooter = 'Données incomplètes !';
		$themeFooter = $themeProbleme;
		include_once ('vues/VueAnnulerReservation.php');
	}
	else 
	{
		// connexion du serveur web à la base MySQL
		include_once ('modele/DAO.class.php');
		$dao = new DAO();
		$dao->creerLesDigicodesManquants();
		// test de l'existence de la réservation
		// la méthode existeReservation de la classe DAO retourne true si $num existe, false s'il n'existe pas
		if ( ! $dao->existeReservation($numReservation) )  
		{
			// si le num n'existe pas, retour à la vue
			$msgFooter = "Numéro de réservation inexistant!";
			$themeFooter = $themeProbleme;
			include_once ('vues/VueAnnulerReservation.php');
		}
		
		else 
		{
			//test de l'auteur de la réservation
			//la méthode estLeCretaeur de la classe DAO retourne true si $_SESSION['nom'] est l'auteur, false s'il n'existe pas
			if ( ! $dao->estLeCreateur($_SESSION['nom'],$numReservation) )  
			{
				//si l'utilisateur n'est pas l'auteur retour à la vue
				$msgFooter = "Vous n'êtes pas l'auteur de cette réservation !";
				$themeFooter = $themeProbleme;
				include_once ('vues/VueAnnulerReservation.php');
			}
			else
			{
				//test de l'état de la réservation
				//la méthode getReservation de la classe DAO retourne la réservation à partir de son numéro
				if($dao->getReservation($numReservation)->getStart_time() < time())
				{
					$msgFooter = "Cette réservation est déjà passée !";
					$themeFooter = $themeProbleme;
					include_once ('vues/VueAnnulerReservation.php');
				}
				else
				{
					// redéclaration des données globales utilisées dans la fonction
					
					global $dao, $numReservation;
					global $ADR_MAIL_EMETTEUR;
					$ADR_MAIL_EMETTEUR='adresse@bidon.nf';
					// supprime la réservation dans la base de données
					$dao->annulerReservation($numReservation);
					
					// recherche de l'adresse mail
					$adrMail = $dao->getUtilisateur($_SESSION['nom'])->getEmail();
					
					// envoie un mail de confirmation de l'enregistrement
					$sujet = "Suppression de réservation";
					$message = "Nous avons bien enregistré la suppression de la réservation N° " . $numReservation ;
					$ok = Outils::envoyerMail ($adrMail, $sujet, $message, $ADR_MAIL_EMETTEUR);
					if($ok)
					{
						$themeFooter = $themeNormal;
						$msgFooter = "Enregistrement effectué.<br>Vous allez recevoir un mail de confirmation.";
						include_once ('vues/VueAnnulerReservation.php');
						
					}
					else 
					{
						$msgFooter = 'Enregistrement effectué.<br>L\'envoi du mail de confirmation a rencontré un problème. ';
						$themeFooter = $themeProbleme;
						include_once ('vues/VueAnnulerReservation.php');
						
					}
				}
					
			}
 		}
	}
		unset($dao);		// fermeture de la connexion à MySQL
}
