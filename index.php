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
            
		<div class="titre">
			<h1><marquee scrollamount="5" width="40">&lt;&lt;&lt;</marquee> Accueil <marquee scrollamount="5" direction="right" width="40">&gt;&gt;&gt;</marquee></h1> <br />
		</div>
		<div class="milieu">
            Contenu page accueil
		</div>
		
	</body>
</html>