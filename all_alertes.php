<?php 
	session_start();
    $includeLevel = 1;
?>
<!DOCTYPE html>
<html>
	<head>
		<?php require_once 'includes/head.php'; ?>
	</head>
	
	<body>
		<?php 
            require_once 'includes/btn_fixed.php';
            require_once 'includes/menu.php';
        ?>
		<div class="milieu">
			<br>		
			<?php
				require_once 'includes/fonctions/fonction_gestions_alertes.php';
				
				// Affichage de toutes les alertes
				/*$nbPage = */get_all_alertes(1);
				echo '<br><br><br>'/* . $nbPage*/;
			?>

			<!-- Création d'une alerte -->
			<?php
				if(isset($_SESSION['Id_groupe'])){
					if($_SESSION['Id_groupe'] == 7){
						require_once 'includes/fonctions/vues/admin/fonction_vue_admin_sentinelle.php';
						creerAlerte();
					}
				}
			?>
			<br />
		</div>
		<br><br><br>
	</body>
</html>