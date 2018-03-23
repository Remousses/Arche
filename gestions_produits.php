<?php
	session_start();
	$includeLevel = 1;
	
	if(isset($_SESSION['pseudoAdmin']) && $_SESSION['gestion'] == 'produits'){
?>
		<!DOCTYPE html>
		<html>
		<head>
		<?php require_once 'includes/head.php'; ?>
			</head>
			
			<body>
				<div>
					<?php 
					    require_once 'includes/fonctions/upload.inc.php';
                        require_once 'includes/btn_fixed.php';
					    require_once 'includes/menu.php';
                    ?>
				</div>
					
				<div class="titre">
					<h1><marquee scrollamount="5" width="40">&lt;&lt;&lt;</marquee> Gestions des produits <marquee scrollamount="5" direction="right" width="40">&gt;&gt;&gt;</marquee></h1> <br />
				</div>
				
				<div class="milieu">
					<?php 
						require_once 'includes/fonctions/fonction_gestions_produits.php';
						gestions_produits(1);
					?>
				</div>
			</body>
		</html>
<?php
	}else{
		header('Location: index.php');
	}
?>