<?php 
	session_start();
    $includeLevel = 1;
?>
<!DOCTYPE html>
<html>
	<head>
		<?php require 'includes/head.php'; ?>
	</head>
	
	<body>
		<?php 
            require_once 'param/id.php';
            require 'includes/btn_fixed.php';
            require 'includes/menu.php';
        ?>
		<div class="milieu">

			<br><br><br>
			
			<?php
				require 'includes/fonctions/fonction_gestions_alertes.php';
				
				// Affichage de toutes les alertes
				$nbPage = get_all_alertes(1);
				echo '<br><br><br>' . $nbPage;
			?>

			<br><br><br>
			<!-- Création d'une alerte -->
			<form action="includes/fonctions/fonction_creation" method="post">
				<label for="nomAlerte">Nom de l'alerte</label>
				<input type="text" name="nomAlerte" id="nomAlerte" value="<?php echo isset($_GET['nomAlerte']) ? $_GET['nomAlerte'] : ''; ?>" required autofocus><br>
				<label for="informationsAlerte">Informations sur l'alerte</label>
				<input type="text" name="informationsAlerte" value="<?php echo isset($_GET['informationsAlerte']) ? $_GET['informationsAlerte'] : ''; ?>" required>
				<input type="hidden" name="dateAlerte" id="dateAlerte">
				<button type="submit" name="creerAlerte">Créer une alerte</button>
			</form>
			<br />
		</div>
		<br><br><br>

		<script>
			var maintenant = new Date();
			var jour = maintenant.getDate();
			var mois = maintenant.getMonth() + 1;
			var an = maintenant.getFullYear();
			
			document.getElementById('dateAlerte').value = an + "-" + mois + "-" + jour;
		</script>
	</body>
</html>