<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="./">Arche de Noé</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
       
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Alertes">
          <a class="nav-link" href="all_alertes.php">
            <i class="fa fa-fw fa-bell"></i>
            <span class="nav-link-text">Alertes</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Livres de sauvetage">
          <a class="nav-link" href="livre.php">
            <i class="fa fa-fw fa-book"></i>
            <span class="nav-link-text">Livres de sauvetage</span>
          </a>
        </li>
        <?php
          if(!empty($_SESSION)){
            if($_SESSION['Id_groupe'] == getIdGroupeMissionnaire() || $_SESSION['Id_groupe'] == getIdGroupeNarrateur()){
        ?>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Profil">
          <a class="nav-link nav-link"  href="profil.php">
            <i class="fa fa-fw fa-file"></i>
            <span class="nav-link-text">Profil</span>
          </a>
        </li>
        <?php
            }

            if($_SESSION['Id_groupe'] == getIdGroupeRessourcesHumaines()){
        ?>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Salariés">
          <a class="nav-link" href="salaries.php">
            <i class="fa fa-fw fa-table"></i>
            <span class="nav-link-text">Salariés</span>
          </a>
        </li>
        <?php
            }

            if($_SESSION['Id_groupe'] == getIdGroupePersonnelPermanent() || $_SESSION['Id_groupe'] == getIdGroupeMissionnaire() || $_SESSION['Id_groupe'] == getIdGroupeComite()){
        ?>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Sites de stockages">
          <a class="nav-link nav-link" href="site_stockages.php" >
            <i class="fa fa-fw fa-sitemap"></i>
            <span class="nav-link-text">Sites de stockages</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Gestion des lots">
          <a class="nav-link" href="lots.php">
            <i class="fa fa-fw fa-link"></i>
            <span class="nav-link-text">Gestion des lots</span>
          </a>
        </li>
        <?php
            }

            if($_SESSION['Id_groupe'] == getIdGroupeAdministrateur() || $_SESSION['Id_groupe'] == getIdGroupeComite()){
        ?>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Gestion des utilisateurs">
          <a class="nav-link nav-link" href="gestion_utilisateurs.php">
            <i class="fa fa-fw fa-wrench"></i>
            <span class="nav-link-text">Gestion des utilisateurs</span>
          </a>
        </li>
        <?php
            }
        ?>
        <?php
          }
        ?>
      </ul>

      <ul class="navbar-nav sidenav-toggler">
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
          if(isset($_SESSION['Id_groupe'])){
            if($_SESSION['Id_groupe'] == getIdGroupeComite()){
              nouvellesCandidatures();
              nouvellesAlertes();
            }
          }
        ?>
        <li class="nav-item">
          <form class="form-inline my-2 my-lg-0 mr-lg-2">
            <div class="input-group">
              <input class="form-control" type="text" placeholder="Recherche ..." disabled>
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