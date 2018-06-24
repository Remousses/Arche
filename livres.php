<?php
  require_once 'param/infos_id_groupe.php';
  session_start();
?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <?php
      require_once 'includes/head.php';
      verificationIdGroupe('livres.php');
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
          <li class="breadcrumb-item active">Livre de sauvetage</li>
        </ol>
        <?php
          if(isset($_SESSION['Id_groupe']) && $_SESSION['Id_groupe'] == getIdGroupeNarrateur()){
            redigerLivreSauvetage();
          }
        
          getAllLivre();
        ?>
      </div>
			<?php 
				require_once 'includes/footer.php';
			?>
		</div>
	</body>
</html>