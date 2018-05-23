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
          <a href="#">Accueil</a>
        </li>
        <li class="breadcrumb-item active">Taxinomie du vivant</li>
      </ol>
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Liste des espèces est leurs Taxinomie</div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Règne</th>
                  <th>Embranchement</th>
                  <th>Classe</th>
                  <th>Ordre</th>
                  <th>Famille</th>
                  <th>Genre</th>
                  <th>Espèce</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Règne des animaux</td>
		              <td>Cordés</td>	
                  <td>Mammifères</td>
                  <td>Carnivores</td>
                  <td>Canidés</td>
                  <td>Canis</td>
                  <td>Loup rouge</td>
                </tr>
                <tr>
                  <td>Règne des animaux</td>
		              <td>Cordés</td>
                  <td>Reptiles</td>
                  <td>Testudines</td>
                  <td>Carettochelyidés</td>
                  <td>Carettochelys</td>
                  <td>Tortue à nez de cochon</td>
                </tr>
              </tbody>
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