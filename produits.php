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
			<?php
				require 'includes/fonctions/fonction_page_produits.php';
				gestion_page_produits(1);
			?>
			<br />
		</div>
	</body>
</html>