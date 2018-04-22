<?php
    function statuerAlerte($idAlerte){
        echo'<a href="includes/fonctions/fonction_validation.php?approuverAlerte=' . $idAlerte . '">V</a>
            <a href="includes/fonctions/fonction_validation.php?archiverAlerte=' . $idAlerte . '">X</a><br>';
    }

    function gestionParticipantProjet($nbParticipant){
        echo'<a href="includes/fonctions/gestions/fonction_gestions_projets.php?nbParticipantProjet=' . $nbParticipant . '">V</a>';
    }

    function nouvellesAlertes(){
        ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle mr-lg-2" id="alertsDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fa fa-fw fa-bell"></i>
                      <span>
        <?php
                        nbNouvellesAlertes();
        ?>
                      </span>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="alertsDropdown">
                      <h6 class="dropdown-header">Nouvelles alertes:</h6>
 <?php
                        voirNouvellesAlertes();                   
?>
                      <a class="dropdown-item small" href="all_alertes.php">Voir toutes les alertes</a>
                    </div>
                  </li>
<?php
            }
?>