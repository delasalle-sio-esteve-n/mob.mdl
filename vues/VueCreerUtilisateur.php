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
				<h4 style="text-align: center; margin-top: 10px; margin-bottom: 10px;">Creer un compte utilisateur</h4>
				<form name="form1" id="form1" action="index.php?action=CreerUtilisateur" method="post">
			<label for="nom">Utilisateur :</label>
			<input type="text" name="nom" id="nom" placeholder="Entrez un nom d'utilisateur" value="" >
			<label for="mail">Adresse mail :</label>
			<input type="text" name="mail" id="mail" placeholder="Entrez une adresse mail" value="" >
			<table>
				<tr>
					<td>Invité</td>
					<td><input type="radio" name="choix" value="0"></td>
					
				</tr>
				<tr>
					<td>Utilisateur</td>
			    	<td><input type="radio" name="choix" value="1"></td>
			    	
		    	</tr>
		    	<tr>
		    		<td>Administrateur</td>
			    	<td><input type="radio" name="choix" value="2"></td>
			    	
		    	</tr>
	    	</table>
			</ul>
			<input type="submit" name="CeerUtilisateur" id="CeerUtilisateur" value="Créer utilisateur">
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