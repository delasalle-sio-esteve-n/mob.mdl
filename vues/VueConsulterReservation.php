<?php
	// Projet Réservations M2L - version web mobile
	// Fonction de la vue VueAnnulerReservation.php : visualiser la vue de l'annulation de la réservation
	// Ecrit le 03/11/2015 par MrJ
?>
<!doctype html>
<html>
	<head>
		<?php include_once ('vues/head.php'); ?>
	</head> 
	<body>
		<div data-role="page">
			<div data-role="header" data-theme="<?php echo $themeNormal; ?>">
				<h4>M2L-GRR</h4>
				<a href="index.php?action=Menu">Retour au menu</a>
			</div>
			<div data-role="content">
				<h4 style="text-align: center; margin-top: 10px; margin-bottom: 10px;">Annuler une réservation</h4>
				<form name="form1" id="form1" action="index.php?action=ConsulterReservation" method="post">
					<div data-role="fieldcontain" class="ui-hide-label">
						<label for="num">Utilisateur :</label>
						<input type="text" name="numReservation" id="numReservation" placeholder="Entrez le numéro de réservation" value="<?php  ?>" >
					</div>

					<div data-role="fieldcontain">
						<input type="submit" name="annulerReservation" id="annulerReservation" value="Annuler la réservation">
					</div>
				</form>
				
				<?php if($debug == true) {
					// en mise au point, on peut afficher certaines variables dans la page
					echo "<p>SESSION['nom'] = " . $_SESSION['nom'] . "</p>";
					echo "<p>SESSION['mdp'] = " . $_SESSION['mdp'] . "</p>";
					echo "<p>SESSION['niveauUtilisateur'] = " . $_SESSION['niveauUtilisateur'] . "</p>";
				} ?>
			</div>
			<div data-role="footer" data-position="fixed" data-theme="<?php echo $themeFooter; ?>">
				<h4><?php echo $msgFooter; ?></h4>
			</div>
		</div>
	</body>
</html>