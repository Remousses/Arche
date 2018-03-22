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
		
		<div class="titre">
			<h1><marquee scrollamount="5" width="40">&lt;&lt;&lt;</marquee> Boutiques <marquee scrollamount="5" direction="right" width="40">&gt;&gt;&gt;</marquee></h1> <br />
		</div>
		
		<div class="milieu">
			<?php
				require 'includes/fonctions/connexionDB.php';
				require 'includes/fonctions/tab_boutiques.php';
			?>
		</div>
		<br />
	</body>
</html>