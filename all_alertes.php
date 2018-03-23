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
			<?php
				if(isset($_SESSION['Id_sentinelle'])){
					require 'includes/fonctions/vues/admin/fonction_vue_admin_sentinelle.php';
					creerAlerte();
				}

				phpinfo();
			?>
			<br />
		</div>
		<br><br><br>
	</body>
</html>