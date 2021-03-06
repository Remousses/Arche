<?php
	session_start();
	if(isset($_SESSION['Id_groupe']) && !empty($_GET['idAlerte']) && !empty($_GET['idEspece'])){
?>
	<!DOCTYPE html>
	<html lang="fr">
		<head>
			<?php
				require_once 'includes/head.php';
				verificationUrlProjet($_GET['idAlerte'], $_GET['idEspece']);
				verificationIdGroupe('voir_projets.php');
			?>
		</head>
		
		<body class="fixed-nav sticky-footer bg-dark" id="page-top">
			<?php 
				require_once 'includes/menu.php';
			?>
		
			<div class="content-wrapper">
				<div class="container-fluid">
					<ol class="breadcrumb">
						<li class="breadcrumb-item">
							<a href="./">Accueil</a>
						</li>
						<li class="breadcrumb-item">
							<a href="all_alertes.php">Alertes</a>
						</li>
						<li class="breadcrumb-item active"><?php echo $_GET['nomAlerte']; ?></li>
					</ol>
					
					<?php
						if(isset($_SESSION['Id_groupe'])){
							if($_SESSION['Id_groupe'] == getIdGroupeComite()){
								creerProjet();
							}

							if(isset($_GET['message'])){
								message();
							}
							
							getAllProjetParAlerte();
						}

						require_once 'includes/footer.php';
					?>
				</div>
			</div>
		</body>
	</html>
<?php
    }else{
        header('Location: all_alertes.php?message=erreurPageAlerte');
    }
?>