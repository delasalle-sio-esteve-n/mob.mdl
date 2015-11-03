<?php
	// Projet Réservations M2L - version web mobile
	// Fonction de la vue VueConnecter.php : visualiser la vue de connexion
	// Ecrit le 12/10/2015 par Jim
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
			</div>
			
			<form>
			<label for="nom">Utilisateur :</label>
			<input type="text" name="nom" id="nom" data-mini="true" placeholder="Entrez votre nom d'utilisateur" value="<?php echo $nom; ?>" >
			<label for="mdp">Mot de passe :</label>
			<input type="<?php if ($afficherMdp == 'off') echo 'password'; else echo 'text'; ?>" name="mdp" id="mdp" data-mini="true" placeholder="Entrez votre mot de passe" value="<?php echo $mdp; ?>" >
			<ul data-role="listview" data-inset="true">>
					<li><a href="">Invité</a></li>
					<li><a href="">Utilisateur</a></li>
					<li><a href="">Administrateur</a></li>
			</ul>
			
			</form>
					<input type="submit" name="CeerUtilisateur" id="CeerUtilisateur" value="Créer utilisateur">

			
			</div>
			<div data-role="footer" data-position="fixed" data-theme="<?php echo $themeNormal; ?>">
				<h4>Menu</h4>
			</div>
		</div>
	</body>
</html>