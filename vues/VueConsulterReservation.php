<?php
// Projet Réservations M2L - version web mobile
// Fonction de la vue VueDemanderMdp.php : visualiser la vue de demande d'envoi d'un nouveau mot de passe
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
				<a href="index.php?action=Deconnecter">Deconnexion</a>
			</div>
			<div data-role="content">
			<form name="form1" id="form1" action="index.php?action=ConsulterReservation" method="post">
					<div data-role="fieldcontain" class="ui-hide-label">
						<label for="numéro">Utilisateur :</label>
						
					</div>

					
			</form>
			
			
			
			
			
			<div data-role="footer" data-position="fixed" data-theme="a"<?php echo $themeFooter; ?>">
				<h4><?php echo $msgFooter; ?></h4>
			</div>
		</div>
	</body>
</html>