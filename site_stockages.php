<?php
  session_start();
?>
<!DOCTYPE html>
  <html lang="fr">
    <head>
        <?php
          require_once 'includes/head.php';
          verificationIdGroupe('site_stockages.php');
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
        <li class="breadcrumb-item active">Sites de stockages</li>
      </ol>
      
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Liste des sites de stockages</div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Nom</th>
                  <th>Rue</th>
                  <th>Code postal</th>
                  <th>Commune</th>
                  <th>Pays</th>
                  <th class="d-none"></th>
                  <th class="d-none"></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Site d'Annecy</td>
		              <td>Avenue de Novel</td>	
                  <td>74000</td>
                  <td>Annecy</td>
                  <td>France</td>
                  <td class="text-center"><a href="#"><i class="fa fa-check"></i></a></td>
                  <td class="text-center"><a href="#"><i class="fa fa-close"></i></a></td>
                </tr>
                <tr>
                  <td>Site de Dax</td>
		              <td>Rue des Fleurs</td>
                  <td>40100</td>
                  <td>Dax</td>
                  <td>France</td>
                  <td class="text-center"><a href="#"><i class="fa fa-check"></i></a></td>
                  <td class="text-center"><a href="#"><i class="fa fa-close"></i></a></td>
                </tr>
                <tr>
                  <td>Site de Lille</td>
		              <td>Rue de l'Entrepot</td>
                  <td>59160</td>
                  <td>Lille</td>
                  <td>France</td>
                  <td class="text-center"><a href="#"><i class="fa fa-check"></i></a></td>
                  <td class="text-center"><a href="#"><i class="fa fa-close"></i></a></td>
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