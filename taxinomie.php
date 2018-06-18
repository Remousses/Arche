<?php
    session_start();
?>
<!DOCTYPE html>
  <html lang="fr">
    <head>
        <?php
            require_once 'includes/head.php';
            verificationIdGroupe('taxinomie.php');
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
        <li class="breadcrumb-item active">Taxinomie du vivant</li>
      </ol>
      
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Liste des espèces et leurs Taxinomie
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered table-hover-cells" id="dataTableTaxinomie" width="100%" cellspacing="0">
              <?php
                getTaxinomie();
              ?>
            </table>
          </div>
        </div>
      </div>
    </div>
			<?php 
				require_once 'includes/footer.php';
			?>
		</div>
	</body>
</html>