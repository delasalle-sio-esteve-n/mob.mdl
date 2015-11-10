<?php
// Projet Réservations M2L - version web mobile
// Fonction du contrôleur CtrlChangerDeMdp.php : traiter la demande d'envoi d'un nouveau mot de passe
// Ecrit le 3/11/2015 par MrJ

if ( ! isset ($_POST ["mdp"]) == true && ! isset ($_POST ["nom"]) == true && ! isset ($_POST ["choix"]) == true) {
	// si les données n'ont pas été postées, c'est le premier appel du formulaire : affichage de la vue sans message d'erreur
	$msgFooter = 'Créer un utilisateur';
	$themeFooter = $themeNormal;
	include_once ('vues/VueCreerUtilisateur.php');
}
else 
{
	// récupération des données postées
	if ( empty ($_POST ["mdp"]) == true)  $mdp = "";  else   $mdp = $_POST ["mdp"];
	if ( empty ($_POST ["nom"]) == true)  $nom = "";  else   $nom = $_POST ["nom"];
	if ( empty ($_POST ["choix"]) == true)  $nom = "";  else   $choix = $_POST ["choix"];
	
	if ($mdp == '' || $nom  == "") {
		// si les données sont incomplètes, réaffichage de la vue avec un message explicatif
		$msgFooter = 'Données incomplètes !';
		$themeFooter = $themeProbleme;
		include_once ('vues/VueCreerUtilisateur.php');
	}
	else 
	{
		
			if ( $choix != "0" && $choix != "1" && $choix != "2" )
			{	
				$msgFooter = 'Données incomplètes !';
				$themeFooter = $themeProbleme;
				include_once ('vues/VueCreerUtilisateur.php');
			}
			else
			{
				// connexion du serveur web à la base MySQL ("include_once" peut être remplacé par "require_once")
				include_once ('../modele/DAO.class.php');
				$dao = new DAO();
		
				if ( $dao->getNiveauUtilisateur($nomAdmin, $mdpAdmin) != "administrateur" )
					TraitementAnormal("Erreur : authentification incorrecte.");
				else
				{
					if ( $dao->existeUtilisateur($name) )
						
					{	
						$msgFooter = 'Nom d\'utilisateur déjà existant !';
						$themeFooter = $themeProbleme;
						include_once ('vues/VueCreerUtilisateur.php');						
					}
					else
					{	// création d'un mot de passe aléatoire de 8 caractères
						$password = Outils::creerMdp();
						// enregistre l'utilisateur dans la bdd
						$ok = $dao->enregistrerUtilisateur($name, $level, $password, $email);
						if ( ! $ok )
							TraitementAnormal("Erreur : problème lors de l'enregistrement du nouveau utilisateur.");
						else
							TraitementNormal();
					}
				}
				// ferme la connexion à MySQL :
				unset($dao);
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
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
						include_once ('vues/VueCreerUtilisateur.php');
					}
					else 
					{
						$themeFooter = $themeProbleme;
						$msgFooter = "Enregistrement effectué.<br>Vous allez recevoir un mail de confirmation.";
						include_once ('vues/VueCreerUtilisateur.php');
					}
					unset($dao);		// fermeture de la connexion à MySQL
		}
		
	}
}