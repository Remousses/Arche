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
            verificationIdGroupe('sites_stockage.php');
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
              <li class="breadcrumb-item active">Sites de stockage</li>
            </ol>
          
            <div class="card mb-3">
              <div class="card-header">
                <i class="fa fa-table"></i> Liste des sites de stockage</div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-bordered" id="dataTableSiteStockage" width="100%" cellspacing="0">
                    <?php
                      getSiteStockage();
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
<?php
  }else{
    header('Location: index.php?message=erreurPage');
  }
?>
