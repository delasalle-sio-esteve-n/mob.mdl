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
			<div data-role="header" data-theme="a">
				<h4>M2L-GRR</h4>
			</div>
			
			<form name="form1" id="form1" action="index.php?action=/controleurs/CtrlCreerUtilisateur" method="post">
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
					

			
			</div>
			<div data-role="footer" data-position="fixed" data-theme="b">
				<h4>Menu</h4>
			</div>
		
	</body>
</html>