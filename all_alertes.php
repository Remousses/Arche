<?php 
	session_start();
?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<?php require_once 'includes/head.php'; ?>
		<style>
			#modal{
				width: 600px;
			}
		</style>
	</head>
	
	<body class="fixed-nav sticky-footer bg-dark <?php /*echo !(isset($_SESSION['Id_groupe'])) ? 'sidenav-toggled' : '';*/ ?>" id="page-top">
		<?php 
            require_once 'includes/menu.php';
		?>
	
		<div class="content-wrapper">
			<div class="container-fluid">
				<?php
					if(isset($_GET['message'])){
						message();
					}
				?>
				<ol class="breadcrumb">
					<li class="breadcrumb-item">
					<a href="./">Accueil</a>
					</li>
					<li class="breadcrumb-item active">Alertes</li>
				</ol>
				  
				<?php
					// Création d'une alerte
					if(isset($_SESSION['Id_groupe'])){
						if($_SESSION['Id_groupe'] == getIdGroupeSentinelle()){
							creerAlerte();
						}
					}
				?>

				<br>
				<?php
					getAllAlertes();
				?>
			</div>

			<?php 
				require_once 'includes/footer.php';
			?>
		</div>
	</body>
</html>