<?php
  require_once 'param/infos_id_groupe.php';
  session_start();

  if(isset($_SESSION['Id_groupe']) && $_SESSION['Id_groupe'] == getIdGroupePersonnelPermanent() 
  || $_SESSION['Id_groupe'] == getIdGroupeMissionnaire() || $_SESSION['Id_groupe'] == getIdGroupeComite()){
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
            <?php
              if(isset($_GET['message'])){
                message();
              }
            ?>
        
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="#">Accueil</a>
              </li>
              <li class="breadcrumb-item active">Lots de semence</li>
            </ol>
            
            <div class="card mb-3">
              <div class="card-header">
                <i class="fa fa-table"></i> Gestion des lots
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-bordered" id="dataTableLots" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th>Espece</th>
                        <th>Type de lot</th>
                        <th>Numero de casier</th>
                        <th>Salle</th>
                        <th>Site de stockage</th>
                        <th>Quantité</th>
					              <th>Entrée</th>
                        <th>Sortie</th>
                        <th class="d-none"></th>
                        <th class="d-none"></th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="vertical_align">Le gecko à queue feuillue</td>
                        <td class="vertical_align">Oeufs</td>
                        <td class="vertical_align">27</td>
                        <td class="vertical_align">Curie</td>
                        <td class="vertical_align">Dax</td>
                        <td class="vertical_align">30</td>
                        <td class="vertical_align">40</td>
                        <td class="vertical_align">10</td>
                        <td class="vertical_align"><a href="#"><i class="fa fa-edit"></i></a></td>
                        <td class="vertical_align"><a href="#"><i class="fa fa-trash"></i></a></td>
                      </tr>
                      <tr>
                        <td class="vertical_align">Le loup rouge</td>
                        <td class="vertical_align">Ovule</td>
                        <td class="vertical_align">13</td>
                        <td class="vertical_align">Newton</td>
                        <td class="vertical_align">Annecy</td>
                        <td class="vertical_align">1</td>
                        <td class="vertical_align">1</td>
                        <td class="vertical_align">0</td>
                        <td class="vertical_align"><a href="#"><i class="fa fa-edit"></i></a></td>
                        <td class="vertical_align"><a href="#"><i class="fa fa-trash"></i></a></td>
                      </tr>
                      <tr>
                        <td class="vertical_align">L'écrevisse à pattes blanches</td>
                        <td class="vertical_align">Semence</td>
                        <td class="vertical_align">34</td>
                        <td class="vertical_align">Einstein</td>
                        <td class="vertical_align">Annecy</td>
                        <td class="vertical_align">3</td>
                        <td class="vertical_align">4</td>
                        <td class="vertical_align">1</td>
                        <td class="vertical_align"><a href="#"><i class="fa fa-edit"></i></a></td>
                        <td class="vertical_align"><a href="#"><i class="fa fa-trash"></i></a></td>
                      </tr>
                      <tr>
                        <td class="vertical_align">Phoque moine</td>
                        <td class="vertical_align">Embryon</td>
                        <td class="vertical_align">4</td>
                        <td class="vertical_align">Kepler</td>
                        <td class="vertical_align">Lille</td>
                        <td class="vertical_align">1</td>
                        <td class="vertical_align">2</td>
                        <td class="vertical_align">1</td>
                        <td class="vertical_align"><a href="#"><i class="fa fa-edit"></i></a></td>
                        <td class="vertical_align"><a href="#"><i class="fa fa-trash"></i></a></td>
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
  <?php
    }else{
      header('Location: index.php?message=erreurPage');
    }
?>