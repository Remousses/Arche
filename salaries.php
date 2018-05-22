<?php
  session_start();
?>
<!DOCTYPE html>
  <html lang="fr">
    <head>
        <?php require_once 'includes/head.php'; ?>
    </head>
    
    <body class="fixed-nav sticky-footer bg-dark" id="page-top">
        <?php 
            require_once 'includes/menu.php';
        ?>
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Accueil</a>
        </li>
        <li class="breadcrumb-item active">Salariés</li>
      </ol>
      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Liste des salariés</div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Nom</th>
                  <th>Prénom</th>
                  <th>Poste</th>
                  <th>Bureau</th>
                  <th class="d-none"></th>
                  <th class="d-none"></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Gerek</td>
		              <td>Elsa</td>	
                  <td>Architecte syteme</td>
                  <td>Annecy</td>
                  <td class="text-center"><a href="#"><i class="fa fa-check"></i></a></td>
                  <td class="text-center"><a href="#"><i class="fa fa-close"></i></a></td>
                </tr>
                <tr>
                  <td>Martin</td>
		              <td>François</td>
                  <td>Comptable</td>
                  <td>Dax</td>
                  <td class="text-center"><a href="#"><i class="fa fa-check"></i></a></td>
                  <td class="text-center"><a href="#"><i class="fa fa-close"></i></a></td>
                </tr>
                <tr>
                  <td>Duval</td>
		              <td>Léo</td>
                  <td>Assistant de gestion</td>
                  <td>Lille</td>
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