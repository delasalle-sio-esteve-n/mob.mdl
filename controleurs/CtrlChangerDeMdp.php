<?php
// Projet Réservations M2L - version web mobile
// Fonction du contrôleur CtrlChangerDeMdp.php : traiter la demande d'envoi d'un nouveau mot de passe
// Ecrit le 3/11/2015 par MrJ

if ( ! isset ($_POST ["nouveauMdp"]) == true || ! isset ($_POST ["confirmationMdp"]) == true) {
	// si les données n'ont pas été postées, c'est le premier appel du formulaire : affichage de la vue sans message d'erreur
	$msgFooter = 'Changer mon mot de passe';
	$themeFooter = $themeNormal;
	include_once ('vues/VueChangerDeMdp.php');
}
else {
	// récupération des données postées
	if ( empty ($_POST ["nouveauMdp"]) == true)  $nouveauMdp = "";  else   $nouveauMdp = $_POST ["nouveauMdp"];
	if ( empty ($_POST ["confirmationMdp"]) == true)  $confirmationMdp = "";  else   $confirmationMdp = $_POST ["confirmationMdp"];
	
	if ($nouveauMdp == '' || $confirmationMdp == "") {
		// si les données sont incomplètes, réaffichage de la vue avec un message explicatif
		$msgFooter = 'Données incomplètes !';
		$themeFooter = $themeProbleme;
		include_once ('vues/VueChangerDeMdp.php');
	}
	else 
	{
		
		// test des deux mot de passes
		// si le $nouvMdp est égale à $confirmationMdp, sinon message d'erreur
		if ( $nouveauMdp != $confirmationMdp )  
		{
			// si les mots de passe sont différents
			$msgFooter = "Le nouveau mot de passe et<br>sa confirmation sont différents !";
			$themeFooter = $themeProbleme;
			include_once ('vues/VueChangerDeMdp.php');
		}
		else 
		{
			// connexion du serveur web à la base MySQL
			include_once ('modele/DAO.class.php');
			$dao = new DAO();
			// enregistre le nouveau mot de passe de l'utilisateur dans la bdd après l'avoir codé en MD5
			$dao->modifierMdpUser ($nom, $nouveauMdp);
	
			// envoie un mail à l'utilisateur avec son nouveau mot de passe 
			$ok = $dao->envoyerMdp ($_SESSION['nom'], $nouveauMdp);
			if($ok)
					{
						
						$msgFooter = 'Enregistrement effectué.<br>L\'envoi du mail de confirmation a rencontré un problème. ';
						$themeFooter = $themeNormal;
						include_once ('vues/VueChangerDeMdp.php');
					}
					else 
					{
						$themeFooter = $themeProbleme;
						$msgFooter = "Enregistrement effectué.<br>Vous allez recevoir un mail de confirmation.";
						include_once ('vues/VueChangerDeMdp.php');
					}
					unset($dao);		// fermeture de la connexion à MySQL
		}
		
	}
}