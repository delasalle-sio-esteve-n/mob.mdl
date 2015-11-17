<?php
// Projet Réservations M2L - version web mobile
// Fonction du contrôleur CtrlConsulterReservation.php : traiter la demande de consultation des réservations
// Ecrit le 17/11/2015 par MrJ

if ( ! isset ($_SESSION['nom'] ) == true) {
	// si les données l'utilisateur n'a de nom	
}
else 
{
	include_once ('/modele/DAO.class.php');
	$dao = new DAO();
	
	// mise à jour de la table mrbs_entry_digicode (si besoin) pour créer les digicodes manquants
	$dao->creerLesDigicodesManquants();
		
	// récupération des réservations à venir créées par l'utilisateur
	$lesReservations = $dao->listeReservations($nom);
	$nbReponses = sizeof($lesReservations);
	
	if ($nbReponses == 0)
	{
		$msgFooter = "Vous n'avez aucune réservation !";
		$themeFooter = $themeProbleme;
		include_once ('vues/VueConsulterReservation.php');		
	}
	else
	{
		$msgFooter = "Vous avez " . $nbReponses ." réservation(s) !";
	$themeFooter = $themeNormal;
	include_once ('vues/VueConsulterReservation.php');
	}
	unset($dao);
	
}
