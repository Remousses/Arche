<?php
  session_start();
?>
<!DOCTYPE html>
  <html lang="fr">
    <head>
        <?php
            require_once 'includes/head.php';
            verificationIdGroupe('lots.php');
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
        <li class="breadcrumb-item active">Salariés</li>
      </ol>
      
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Liste des salariés</div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Nom</th>
                  <th>Casier</th>
                  <th>Salle</th>
                  <th>Site</th>
                  <th class="d-none"></th>
                  <th class="d-none"></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Architecte syteme</td>
                  <td>Annecy</td>
                  <td></td>
                  <td></td>
                  <td class="text-center"><a href="#"><i class="fa fa-edit"></i></a></td>
                  <td class="text-center"><a href="#"><i class="fa fa-trash"></i></a></td>
                </tr>
                <tr>
                  <td>Comptable</td>
                  <td>Dax</td>
                  <td></td>
                  <td></td>
                  <td class="text-center"><a href="#"><i class="fa fa-edit"></i></a></td>
                  <td class="text-center"><a href="#"><i class="fa fa-trash"></i></a></td>
                </tr>
                <tr>
                  <td>Assistant de gestion</td>
                  <td>Lille</td>
                  <td></td>
                  <td></td>
                  <td class="text-center"><a href="#"><i class="fa fa-edit"></i></a></td>
                  <td class="text-center"><a href="#"><i class="fa fa-trash"></i></a></td>
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