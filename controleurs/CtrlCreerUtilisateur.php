<?php
// Projet Réservations M2L - version web mobile
// Fonction du contrôleur CtrlChangerDemail.php : traiter la demande d'envoi d'un nouveau mot de passe
// Ecrit le 3/11/2015 par MrJ

if ( ! isset ($_POST ["mail"]) == true && ! isset ($_POST ["nom"]) == true && ! isset ($_POST ["choix"]) == true) {
	// si les données n'ont pas été postées, c'est le premier appel du formulaire : affichage de la vue sans message d'erreur
	$msgFooter = 'Créer un utilisateur';
	$themeFooter = $themeNormal;
	include_once ('vues/VueCreerUtilisateur.php');
}
else 
{
	// récupération des données postées
	if ( empty ($_POST ["mail"]) == true)  $mail = "";  else   $mail = $_POST ["mail"];
	if ( empty ($_POST ["nom"]) == true)  $nom = "";  else   $nom = $_POST ["nom"];
	if ( empty ($_POST ["choix"]) == true)  $nom = "";  else   $choix = $_POST ["choix"];
	
	if ($mail == '' || $nom  == "") {
		// si les données sont incomplètes, réaffichage de la vue avec un message explicatif
		$msgFooter = 'Données incomplètes !';
		$themeFooter = $themeProbleme;
		include_once ('vues/VueCreerUtilisateur.php');
	}
	else 
	{
				// connexion du serveur web à la base MySQL ("include_once" peut être remplacé par "require_once")
				include_once ('../modele/DAO.class.php');
				include_once ('../modele/Outils.class.php');
				$dao = new DAO();

					if ( $dao->existeUtilisateur($nom) )
						
					{	
						$msgFooter = 'Nom d\'utilisateur déjà existant !';
						$themeFooter = $themeProbleme;
						include_once ('vues/VueCreerUtilisateur.php');						
					}
					else
					{	// création d'un mot de passe aléatoire de 8 caractères
					
						$mdp = Outils::creermdp();
						// enregistre l'utilisateur dans la bdd
						$ok = $dao->enregistrerUtilisateur($nom, $choix, $mdp, $email);
						if ( ! $ok )
							TraitementAnormal("Erreur : problème lors de l'enregistrement du nouveau utilisateur.");
						else
							TraitementNormal();
					}
				}
				// ferme la connexion à MySQL :
				unset($dao);
				

			// connexion du serveur web à la base MySQL
				include_once ('../modele/Outils.class.php');
			// envoie un mail à l'utilisateur avec son mot de passe 
			$message = "Votre mot de passe d'accès au service Réservations M2L a été Crée.\n\n";
			$message = $message.$Mdp;
			$ok =Outils::envoyerMail($mail,'Mot de passe M2L', $message, 'delasalle.sio.esteve.n@gmail.com');
			if($ok)
					{
						
						$msgFooter = 'Enregistrement effectué.<br>L\'envoi du mail de confirmation a rencontré un problème. ';
						$themeFooter = $themeNormal;
						include_once ('vues/VueCreerUtilisateur.php');
					}
					else 
					{
						$themeFooter = $themeProbleme;
						$msgFooter = "Enregistrement effectué.<br>Vous allez recevoir un mail de confirmation contenant votre mot de passe.";
						include_once ('vues/VueCreerUtilisateur.php');
					}
					unset($dao);		// fermeture de la connexion à MySQL
		}
		
	

