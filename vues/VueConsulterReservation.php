<?php
	// Projet Réservations M2L - version web mobile
	// Fonction de la vue VueConsulterReservation.php : visualiser la vue de consultation des réservations
	// Ecrit le 17/11/2015 par MrJ
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
				<h4 style="text-align: center; margin-top: 10px; margin-bottom: 10px;">Consulter mes réservations</h4>
				<ul data-role="listview" data-inset="true" data-theme="c">
				<!-- Pour chaque réservation de la collection lesRéservations faire -->
				<?php foreach ($lesReservations as $Reservation)
				{
					// 	Appel de Outils.php
					include_once ('modele/Outils.class.php');
					?>
					<li>
					<h4>
					Réserv.<?php echo $Reservation->getId();?>
					<br>
					Digicode <?php echo $Reservation->getDigicode();?>
					</h4>
					<br>
					Passée le <?php echo Outils::convertirEnDateFR(substr($Reservation->getTimestamp(),0,10));?>
					<br>
					Début : <?php echo Outils::corrigerDate(date('d-m-Y',$Reservation->getStart_time()));?>
					<br>
					Fin : <?php echo Outils::corrigerDate(date('d-m-Y',$Reservation->getEnd_time()));?>
					<br>
					Salle : <?php echo $Reservation->getRoom_name();?>
					<br>
					Etat : 
					<?php 
						if($Reservation->getStatus() == 0) echo 'confirmée';
						if($Reservation->getStatus() == 4)echo 'provisoire';
						if($Reservation->getStatus() =='')echo 'inconnu';?>
					</li>
					<?php 	
				}
					
				?>
				</ul>
				
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