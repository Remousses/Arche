<?php
	session_start();
?>

<!DOCTYPE html>
<html lang="fr">
	<head>
		<?php 
			require_once 'includes/head.php';
			verificationIdGroupe('index.php'); 
		?>
	</head>
	
	<body class="fixed-nav sticky-footer bg-dark" id="page-top">
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
					<li class="breadcrumb-item active">Arche de Noé</li>
				</ol>
				<div class="row">
					<div class="col-12">
						<h1>Qui Sommes Nous ?</h1>
						<br>
						<div class="text-center">
							<img class="image_accueil" src="images/imgage_accueil.jpeg"/>
						</div>
						<br><br>

						<p>Notre histoire est née il y a 20 ans sur un campus de France de la volonté de quelques amis dépités par l’incapacité de nos gouvernants à prendre les décisions pour limiter les effets néfastes de l’activité humaine sur l’environnement de vie sur terre. Et devant l’urgence et la criticité de la situation et en dignes héritiers de la pensée colibri, ils ont pensé un ambitieux programme de sauvetage d’espèces vivantes menacées de disparition : L’arche de Noé. Ils ont réussi le challenge de rallier à leur cause un grand nombre de personnes. Ils ont pu imaginer et valider un processus citoyen pour secourir les espèces menacées. La levée de fonds qui a suivi a été un franc succès. L’association dispose aujourd’hui d’un réseau d’entreprises, sponsors financiers de leurs projets, d’un réseau d’adhérents volontaires pour la réalisation opérationnelle sur différents terrains du monde et d’un réseau d’experts dans le domaine du vivant et dans celui de l’expérimentation scientifique pour encadrer et conseiller.</p>
						<p>La menace qui pèse sur l’existence des espèces animales et végétales est associée grandement à l’homme. La surpopulation, la détérioration de l’environnement de vie, l’industrialisation galopante, la mondialisation de l’économie, l’exploitation irraisonnée des ressources, la pollution industrielle, le réchauffement climatique, … sont autant de réalités qui menacent la vie sur terre. </p>
					</div>
				</div>
			</div>
			<?php 
				require_once 'includes/footer.php';
			?>
		</div>
	</body>
</html>