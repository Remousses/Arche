<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="./">Arche de Noé</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
       
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <?php
        if(!empty($_SESSION)){
      ?>
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Alertes">
          <a class="nav-link" href="all_alertes.php">
            <i class="fa fa-fw fa-bell"></i>
            <span class="nav-link-text">Alertes</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Profil">
          <a class="nav-link nav-link"  href="profil.php">
            <i class="fa fa-fw fa-file"></i>
            <span class="nav-link-text">Profil</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Salariés">
          <a class="nav-link" href="salaries.php">
            <i class="fa fa-fw fa-table"></i>
            <span class="nav-link-text">Salariés</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Gestion des utilisateurs">
          <a class="nav-link nav-link" href="gestion_utilisateurs.php">
            <i class="fa fa-fw fa-wrench"></i>
            <span class="nav-link-text">Gestion des utilisateurs</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Sites de stockages">
          <a class="nav-link nav-link" href="site_stockages.php" >
            <i class="fa fa-fw fa-sitemap"></i>
            <span class="nav-link-text">Sites de stockages</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Lots">
          <a class="nav-link" href="lots.php">
            <i class="fa fa-fw fa-link"></i>
            <span class="nav-link-text">Lots</span>
          </a>
        </li>
      </ul>
        
      <?php
          }
        ?>
      <ul class="navbar-nav sidenav-toggler" style="<?php echo !(isset($_SESSION['Id_groupe'])) ? 'display: none;' : ''; ?>">
        <li class="nav-item">
          <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
          </a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle mr-lg-2" id="toggleNavColor" href="#">
            <span class="fa-lg">
              <i class="fa fa-fw fa-lightbulb-o"></i>
          </span>
          </a>
        </li>
        <?php
          if(!isset($_SESSION['Id_groupe'])){
        ?>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Alertes">
        <a class="nav-link" href="all_alertes.php">
          <i class="fa fa-fw fa-bell"></i>
          <span class="nav-link-text">Alertes</span>
        </a>
        </li>
        <?php
          }else if(isset($_SESSION['Id_groupe'])){
            if($_SESSION['Id_groupe'] == getIdGroupeComite()){
        ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle mr-lg-2" id="messagesDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fa fa-fw fa-envelope"></i>
              <span class="fa-lg">
                e
                <span class="indicator text-primary d-none d-lg-block">
                  <i class="fa fa-fw fa-circle"></i>
                </span>
              </span>
            </a>
            <div class="dropdown-menu" aria-labelledby="messagesDropdown">
              <h6 class="dropdown-header">Nouvelles candidatures:</h6>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">
                <strong>David Miller</strong>
                <span class="small float-right text-muted">11:21 AM</span>
                <div class="dropdown-message small">Hey there! This new version of SB Admin is pretty awesome! These messages clip off when they reach the end of the box so they don't overflow over to the sides!</div>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">
                <strong>Jane Smith</strong>
                <span class="small float-right text-muted">11:21 AM</span>
                <div class="dropdown-message small">I was wondering if you could meet for an appointment at 3:00 instead of 4:00. Thanks!</div>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">
                <strong>John Doe</strong>
                <span class="small float-right text-muted">11:21 AM</span>
                <div class="dropdown-message small">I've sent the final files over to you for review. When you're able to sign off of them let me know and we can discuss distribution.</div>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item small" href="#">Voir les candidatures</a>
            </div>
          </li>
          <?php
              nouvellesAlertes();
          ?>
        <?php
            }
          }
        ?>
        <li class="nav-item">
          <form class="form-inline my-2 my-lg-0 mr-lg-2">
            <div class="input-group">
              <input class="form-control" type="text" placeholder="Search for..." disabled>
              <span class="input-group-append">
                <button class="btn btn-primary" type="button" disabled>
                  <i class="fa fa-search"></i>
                </button>
              </span>
            </div>
          </form>
        </li>

<?php
        if(!empty($_SESSION)){
?>
            <li class="nav-item">
                <a class="nav-link" data-toggle="modal" data-target="#deconnexion"><i class="fa fa-fw fa-sign-out"></i>Se déconnecter</a>
            </li>
<?php
        }else{
?>
            <li class="nav-item">
                <a class="nav-link" href="connexion.php"><i class="fa fa-fw fa-sign-out"></i>Se connecter</a>
            </li>
<?php
        }
?>
      </ul>
    </div>
</nav>