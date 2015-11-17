<?php
// Projet Réservations M2L - version web mobile
// Fonction du contrôleur CtrlSupprimerUtilisateur.php : traiter la demande de suppresion d'utilisateur
// Ecrit le 11/11/2015 par MrJ

if ( ! isset ($_POST["nom"]) == true ) {
	// si les données n'ont pas été postées, c'est le premier appel du formulaire : affichage de la vue sans message d'erreur
	$msgFooter = 'Supprimer un utilisateur';
	$themeFooter = $themeNormal;
	include_once ('vues/VueSupprimerUtilisateur.php');
}
else {
	// récupération des données postées
	if ( empty ($_POST["nom"]) == true)  $nom = "";  else   $nom = $_POST["nom"];
		
	if ($nom == '' ) 
	{
		// si les données sont incomplètes, réaffichage de la vue avec un message explicatif
		$msgFooter = 'Données incomplètes !';
		$themeFooter = $themeProbleme;
		include_once ('vues/VueSupprimerUtilisateur.php');
	}
	else 
	{
		
		
		// connexion du serveur web à la base MySQL ("include_once" peut être remplacé par "require_once")
		include_once ('modele/DAO.class.php');
		$dao = new DAO();
		
// 		vérifier si l'utilisateur existe
		if (  $dao->existeUtilisateur($nom) == false)
		{	// si l'utilisateur n'existe pas
			$msgFooter = "Nom d'utilisateur inexistant!";
			$themeFooter = $themeProbleme;
			include_once ('vues/VueSupprimerUtilisateur.php');
		}
		else
		{	
 			
			// rechercher si cet utilisateur a passé des réservations à venir
			if ( $dao->aPasseDesReservations($nom) )
			{	
				$msgFooter = 'Cet utilisateur a passé des réservations à venir !';
				$themeFooter = $themeProbleme;
				include_once ('vues/VueSupprimerUtilisateur.php');
			}
			else
 			{	
 			$ok = $dao->supprimerUtilisateur($nom);
				if ( ! $ok )
				{ 
					$msgFooter = 'Problème lors de la suppression de l\'utilisateur !';
					$themeFooter = $themeProbleme;
					include_once ('vues/VueSupprimerUtilisateur.php');
				}
				else 
				{	// envoie un mail de confirmation de la suppression
					$sujet = "Suppression de votre compte dans le système de réservation de M2L";
					$message = "L'administrateur du système de réservations de la M2L vient de supprimer votre compte utilisateur.\n";
					
					$ok = Outils::envoyerMail($email, $sujet, $message, $ADR_MAIL_EMETTEUR);
					if ( ! $ok )
					{
						$msgFooter = 'Suppression effectuée.<br>L\'envoi du mail à l\'utilisateur a rencontré un problème !';
						$themeFooter = $themeProbleme;
						include_once ('vues/VueSupprimerUtilisateur.php');
					}
					else
					{
						$msgFooter = 'Suppression effectuée.<br>Un mail va être envoyé à l\'utilisateur !';
						$themeFooter = $themeNormal;
						include_once ('vues/VueSupprimerUtilisateur.php');
					}
				}
					unset($dao);		// fermeture de la connexion à MySQL
			}		
		}
 	
	}
}

