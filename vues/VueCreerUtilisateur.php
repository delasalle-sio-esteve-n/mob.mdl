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
			
			<form name="form1" id="form1" action="index.php?action=CreerUtilisateur" method="post">
			<label for="nom">Utilisateur :</label>
			<input type="text" name="nom" id="nom" data-mini="true" placeholder="Entrez votre nom d'utilisateur" value="<?php echo $nom; ?>" >
			<label for="mdp">Mot de passe :</label>
			<input type="<?php if ($afficherMdp == 'off') echo 'password'; else echo 'text'; ?>" name="mdp" id="mdp" data-mini="true" placeholder="Entrez votre mot de passe" value="<?php echo $mdp; ?>" >
			
			<input type="checkbox" name="choix" value="1"> Invite<br>
	    	<input type="checkbox" name="choix" value="2"> Utilisateur<br>
	    	<input type="checkbox" name="choix" value="3"> Administrateur<br>
			</ul>
			
			</form>
					<input type="submit" name="CeerUtilisateur" id="CeerUtilisateur" value="Créer utilisateur">

			
			</div>
			<div data-role="footer" data-position="fixed" data-theme="<?php echo $themeNormal; ?>">
				<h4>Menu</h4>
			</div>
		
	</body>
</html>