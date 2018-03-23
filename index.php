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
			var_dump($_SESSION['Id_groupe']);
        ?>
            
		<div class="titre">
			<h1><marquee scrollamount="5" width="40">&lt;&lt;&lt;</marquee> Accueil <marquee scrollamount="5" direction="right" width="40">&gt;&gt;&gt;</marquee></h1> <br />
		</div>
		<div class="milieu">
            Contenu page accueil
		</div>
		
	</body>
</html>